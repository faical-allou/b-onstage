<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Event extends CI_Controller {

	function __construct()
	{
		parent::__construct();			
		$this->load->model('member_model');		
		$this->load->model('genre_model');
		$this->load->model('event_model');
		$this->load->model('reservation_model');
		$this->load->model('user_model');
		$this->load->model('concert_model');
		
		//var user
		$this->user = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row_array() : null;	
		
		//init vars
		if($this->ion_auth->logged_in()){
			$user = $this->user;
			$user_group = $this->ion_auth->in_group('stage') ? 'stage' : 'artist';
			$user_link = ($this->user['web_address']) ? site_url($this->user['web_address']) : site_url('page/'.$this->user['username']);
			$notifications = $this->user_model->get_notifications($this->user['id']);
			$this->load->vars(array('user' => $user));
			$this->load->vars(array('user_group' => $user_group));
			$this->load->vars(array('user_link' => $user_link));
			$this->load->vars(array('notifications' => $notifications));
		}
		
		//init search bar								
		if( ! $search = $this->session->userdata('concertsearch')){	
			$search['search-status'] = 'open';
			$search['search-date-start'] = date('Y-m-d');			
			$search['search-date-end'] = date('Y-m-d', strtotime("+3 months"));		
			$search['search-city'] = null;
		}
		$cities = $this->event_model->get_stage_cities();	
		$this->load->vars(array('search' => $search));	
		$this->load->vars(array('cities' => $cities));	
		
	}
	
	/**********EVENT MODE READ**********/
	/*** A METTRE ICI OU DANS LE CONTROLLER CONCERT A VOIR***/
	
	public function index($event_id){
		
		$concert = $this->concert_model->get($event_id);	
		
		$header['title'] = $concert['title'];
		$header['description'] = $concert['description'];							
		
		$time_start = strtotime($concert['date_start']);
		$time_end = strtotime($concert['date_end']);		
		$data = array(
			'concert'				=> $concert,
			'location'				=> $concert['stage_address'].', '.$concert['stage_zip'].' '.$concert['stage_city'].', '.$concert['stage_country'],
			'date'					=> date('j', $time_start).' '.get_month(date('n', $time_start)),
			'schedule'				=> date('G\hi',$time_start).' à '.date('G\hi', $time_end),
			'title_infos'			=> 'Infos concert',
			'title_artist'			=> 'Infos groupe / artiste',
			'stage_link'			=> empty($concert['stage_web_address']) ? site_url('page/'.$concert['stage_username']) : site_url($concert['stage_web_address']),
			'artist_link'			=> empty($concert['artist_web_address']) ? site_url('page/'.$concert['artist_username']) : site_url($concert['artist_web_address']),
			'artist_website'		=> empty($concert['artist_website']) ? '<i class="fs-12">Pas de site officiel</i>' : anchor($concert['artist_website'], preg_replace('#^https?://#', '', $concert['artist_website']), array('class' => 'purple bold')),
			'artist_facebook'		=> empty($concert['artist_facebook']) ? '' : anchor($concert['artist_facebook'],'<span aria-hidden="true" class="icon-facebook fs-24 grey mr-5"></span>'),
			'artist_twitter'		=> empty($concert['artist_twitter']) ? '' : anchor($concert['artist_twitter'],'<span aria-hidden="true" class="icon-twitter fs-24 grey mr-5"></span>'),
			'artist_google_plus'	=> empty($concert['artist_google_plus']) ? '' : anchor($concert['artist_google_plus'],'<span aria-hidden="true" class="icon-google-plus fs-24 grey mr-5"></span>'),
			'artist_description'	=> empty($concert['artist_description']) ? '<i class="fs-12">Aucune description</i>' : $concert['artist_description'],
			'tracks'				=> $this->load->view('sound/tpl_read',array('tracks' => $concert['tracks']), true),
			'nb_tracks'				=> count($concert['tracks']),
			'genres'				=> implode(', ',$concert['genres']),
			'members'				=> $concert['members'],
			'nb_members'			=> count($concert['members'])	
		);
		
		$footer['scripts'] = array(
			'js/jplayer/jquery.jplayer.min.js',
			'js/jplayer/jplayer.playlist.min.js',
			'js/main-read-event.js'
		);
		
		$this->load->view('_header', $header);
		$this->load->view('event/read', $data);
		$this->load->view('_footer', $footer);		
	}
	
	
	
	
	
	/**********CREATE**********/	
	function create(){	
		if (!$this->ion_auth->logged_in())
		{		
			redirect('login', 'refresh');
		}		
		else{
			//variable $this->header
			$this->header['doctype'] = 'html5';
			$this->header['title'] = 'Créer un évènement';
			$this->header['description'] = 'Mettre une description';								
			
			/**********DATA**********/
			$this->data['add_url'] = site_url('event/add');
			$this->data['success_url'] = site_url('user/calendar');
			$this->data['success_message'] = 'Evènement enregistré avec succès';
			$this->data['error_message'] = "Erreur détéctée, veuillez réessayer...";
			
			/*****USER*****/
			$this->data['user'] = $this->user;		
			
			/*****FORM ID*****/
			$this->data['form_create_event'] = array(
				'id'			=> 'form-create-event'
			);
			$this->data['form_payment_type'] = array(
				'id'			=> 'form-payment-type'
			);	
			/*****TITLE*****/
			$this->data['title'] = array(
				'name'			=> 'ev-title',
				'id'			=> 'ev-title',
				'value'			=> '',
				'placeholder'	=> 'Saisir un titre',				
				'size'			=> 50,
				'class' 		=> 'input fs-16 bold grey ui-corner-all',
				'data-default'	=> 'Concert au '.$this->user['company']
			);					
		
			/*****START DATE*****/
			$this->data['date_start'] = array(
				'name'			=> 'ev-date-start',
				'id'			=> 'ev-date-start',
				'value'			=> date('d/m/Y'),
				'size'			=> 10,
				'maxlength'		=> 10,
				'class' 		=> 'input fs-13 grey ui-corner-all mr-5 required'
			);			
			
			/*****SCHEDULE START*****/
			$this->data['schedule_start'] = array(
				'name'			=> 'ev-schedule-start',
				'id'			=> 'ev-schedule-start',
				'value'			=> date('H:i'),
				'class' 		=> 'time input fs-13 grey ui-corner-all required',
				'size'			=> 5,
				'maxlength'		=> 5
			);				
			
			/*****END DATE*****/
			$this->data['date_end'] = array(
				'name'			=> 'ev-date-end',
				'id'			=> 'ev-date-end',
				'value'			=> date('d/m/Y'),
				'size'			=> 10,
				'maxlength'		=> 10,
				'class' 		=> 'input fs-13 grey ui-corner-all required'
			);
			
			/*****SCHEDULE END*****/
			$this->data['schedule_end'] = array(
				'name'			=> 'ev-schedule-end',
				'id'			=> 'ev-schedule-end',
				'value'			=> date('H:i'),
				'class' 		=> 'time input fs-13 grey ui-corner-all mr-5 required',
				'size'			=> 5,
				'maxlength'		=> 5
			);
			
			/*****RECCURENCE*****/
			$this->data['label_reccurence'] = 'Récurrence...';
			$this->data['reccurence'] = array(
				'name'			=> 'ev-reccurence',
				'id'			=> 'ev-reccurence',			
				'value'			=> 'checked',
				'checked'		=> false,
				'style'		=> 'vertical-align:middle;margin-top:-2px;'	
			);		
			
			/**********EVENT DETAILS**********/
			/*****DETAIL TITLE*****/
			$this->data['ev_details_title'] ='Détails de l\'évènement';
			
			/*****LOACTION*****/
			$this->data['label_location'] = 'Lieu';
			$this->data['location'] = array(
				'name'			=> 'ev-location',
				'id'			=> 'ev-location',
				'value'			=> $this->user['address'].', '.$this->user['zip'].' '.$this->user['city'].', '.$this->user['country']
			);
			
			/*****MUSICAL GENRE*****/
			$musical_genre = $this->genre_model->get_all();	
			$this->data['label_musical_genre'] = 'Genre musical recherché';
			$this->data['musical_genre'] = array(						
				'id'		=> 'ev-musical-genre',
				'name'		=> 'ev-musical-genre',				
				'selected'	=> '',
				'js'		=> 'style="width:300px" class="ui-corner-all" id="ev-musical-genre" multiple data-placeholder="Choisissez un genre musical"',
				'options'	=> $musical_genre
			);			
			
			/*****RESERVATION*****/
			$this->data['label_reservation'] = 'Montant de la réservation';
			$this->data['reservation'] = array(
				'name'			=> 'ev-reservation',
				'id'			=> 'ev-reservation',
				'placeholder'	=> 50,
				'value'			=> '',				
				'size'			=> 4,
				'class'			=> 'input fs-13 grey ui-corner-all required number'
			);			
			
			/*****PAYMENT TYPE*****/
			$this->data['label_payment_type'] = 'Rémunération de l\'artiste';
			$this->data['payment_type'] = array(
				'id'				=> 'ev-payment-type',
				'value'					=> '',					
				'data-value'			=> 0,
				'data-payment-amount'	=> 0,
				'data-percent-drink'	=> 0,
				'data-percent-entry'	=> 0,
				'data-refund-fees'		=> 0,
				'data-resume'			=> ''			
			);			
			$this->data['attrs_label_payment_type'] = array(
				'class'		=> 'fs-13 grey normal ml-5'				
			);
			//non rémunéré
			$this->data['label_payment_type_1'] = 'Non rémunéré';
			$this->data['payment_type_1'] = array(
				'name'		=> 'payment-type-1',
				'id'		=> 'payment-type-1',
				'value'		=> 'checked',				
				'checked'	=> FALSE,
				'style'		=> 'vertical-align:middle;margin-top:-3px;'	
			);
			//payment amount
			$this->data['label_payment_type_2'] = 'Cachet de';
			$this->data['payment_type_2'] = array(
				'name'		=> 'payment-type-2',
				'id'		=> 'payment-type-2',
				'value'		=> 'checked',
				'checked'	=> FALSE,
				'style'		=> 'vertical-align:middle;margin-top:-3px;'	
			);
			$this->data['input_payment_type_2'] = array(
				'name'		=> 'input-payment-type-2',
				'id'		=> 'input-payment-type-2',
				'value'		=> '',
				'class' 	=> 'input grey ui-corner-all mr-5 number',
				'size'		=> 4				
			);
			//percent drink
			$this->data['label_payment_type_3'] = '% des consommations vendues';
			$this->data['payment_type_3'] = array(
				'name'		=> 'payment-type-3',
				'id'		=> 'payment-type-3',
				'value'		=> 'checked',
				'checked'	=> FALSE,
				'style'		=> 'vertical-align:middle;margin-top:-3px;'
			);
			$this->data['input_payment_type_3'] = array(
				'name'		=> 'input-payment-type-3',
				'id'		=> 'input-payment-type-3',
				'value'			=> '',
				'class' 		=> 'input grey ui-corner-all ml-5 number',
				'size'			=> 2
			);
			//percent entry
			$this->data['label_payment_type_4'] = '% sur la billeterie';
			$this->data['payment_type_4'] = array(
				'name'		=> 'payment-type-4',
				'id'		=> 'payment-type-4',
				'value'		=> 'checked',
				'checked'	=> FALSE,
				'style'		=> 'vertical-align:middle;margin-top:-3px;'
			);
			$this->data['input_payment_type_4'] = array(
				'name'		=> 'input-payment-type-4',
				'id'		=> 'input-payment-type-4',
				'value'			=> '',
				'class' 		=> 'input grey ui-corner-all ml-5 number',
				'size'			=> 2
			);
			//refund fees
			$this->data['label_payment_type_5'] = 'Remboursement des frais de réservation';
			$this->data['payment_type_5'] = array(
				'name'		=> 'payment-type-5',
				'id'		=> 'payment-type-5',
				'value'		=> 'checked',
				'checked'	=> FALSE,
				'style'		=> 'vertical-align:middle;margin-top:-3px;'	
			);		
			/*****ENTRY*****/
			$this->data['label_entry'] = 'Prix des entrées';	
			$this->data['entry'] = array(
				'name'			=> 'ev-entry',
				'id'			=> 'ev-entry',
				'value'			=> '',
				'placeholder'	=> 0,
				'size'			=> 4,
				'class'			=> 'input fs-13 grey ui-corner-all required number'
			);					
			
			/*****DESCRIPTION*****/	
			$this->data['label_description'] = 'Description';	
			$this->data['description'] = array(						
				'id' => 'ev-description',
				'value' => ''				
			);
			
			
			$this->footer['scripts'] = array('js/event.js','js/main-create-event.js');
			
			$this->load->view('_header', $this->header);
			$this->load->view('event/create', $this->data);
			$this->load->view('_footer', $this->footer);
		}	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*****EDIT*****/
	function edit($event_id){
		
		if (!$this->ion_auth->logged_in())
		{		
			redirect('login', 'refresh');
		}		
		else{	
		
			/**********VARS**********/
			$event = $this->event_model->get($event_id);				
						
			//$user_state = 1 si connecté et sur son évènement, 0 si connecté et pas sur son évènement
			$user_state = ($this->ion_auth->logged_in() && ($this->user['id'] == $event['stage_id'])) ? 1 : 0;
				
			if($user_state == 1){
				$date_start = date_create($event['date_start']);
				$date_end = date_create($event['date_end']);
				$user = $this->user;
				
				/**********HEADER**********/
				$this->header['doctype'] = 'html5';
				$this->header['title'] = $event['title'];
				$this->header['description'] = 'Mettre une description';										
				
				/**********INIT DATA**********/
				/*****EVENT*****/
				$this->data['event'] = $event;
				
				/******URL ET MSG*****/
				$this->data['update_url'] = site_url('event/update');
				$this->data['success_url'] = site_url('user/calendar');
				$this->data['success_message'] = 'Evènement modifié avec succès';
				$this->data['error_message'] = "Erreur détéctée, veuillez réessayer...";
				
				/*****LABEL TITLE*****/
				$this->data['ev_details_title'] = 'Détails de l\'évènement';
				
				/*****LABELS DETAILS*****/
				$this->data['label_location'] = 'Lieu';
				$this->data['label_musical_genre'] = 'Genre musical recherché';
				$this->data['label_reservation'] = 'Montant de la réservation';
				$this->data['label_payment_type'] = 'Rémunération de l\'artiste';
				$this->data['label_entry'] = 'Prix des entrées';
				$this->data['label_description'] = 'Description';
				
				switch($event['status']){
					case 'open' :											
				
						/*****FORM ID*****/
						$this->data['form_edit_event'] = array(
							'id'			=> 'form-edit-event'
						);
						$this->data['form_payment_type'] = array(
							'id'			=> 'form-payment-type'
						);	
						/*****TITLE*****/
						$this->data['title'] = array(
							'name'			=> 'ev-title',
							'id'			=> 'ev-title',
							'value'			=> $event['title'],					
							'placeholder'	=> 'Saisir un titre',
							'size'			=> 50,
							'class' 		=> 'input fs-16 bold grey ui-corner-all',
							'data-default'	=> 'Concert au '.$this->user['company']
						);					
			
						/*****START DATE*****/
						$this->data['date_start'] = array(
							'name'			=> 'ev-date-start',
							'id'			=> 'ev-date-start',
							'value'			=> date_format($date_start,'d/m/Y'),
							'size'			=> 10,
							'maxlength'		=> 10,
							'class' 		=> 'input fs-13 grey ui-corner-all mr-5 required'
						);			
						
						/*****SCHEDULE START*****/
						$this->data['schedule_start'] = array(
							'name'			=> 'ev-schedule-start',
							'id'			=> 'ev-schedule-start',
							'value'			=> date_format($date_start, 'H:i'),
							'class' 		=> 'time input fs-13 grey ui-corner-all required',
							'size'			=> 5,
							'maxlength'		=> 5
						);				
						
						/*****END DATE*****/
						$this->data['date_end'] = array(
							'name'			=> 'ev-date-end',
							'id'			=> 'ev-date-end',
							'value'			=> date_format($date_end,'d/m/Y'),
							'size'			=> 10,
							'maxlength'		=> 10,
							'class' 		=> 'input fs-13 grey ui-corner-all required'
						);
						
						/*****SCHEDULE END*****/
						$this->data['schedule_end'] = array(
							'name'			=> 'ev-schedule-end',
							'id'			=> 'ev-schedule-end',
							'value'			=> date_format($date_end, 'H:i'),
							'class' 		=> 'time input fs-13 grey ui-corner-all mr-5 required',
							'size'			=> 5,
							'maxlength'		=> 5
						);
				
						/*****RECCURENCE*****/
						$this->data['label_reccurence'] = 'Récurrence...';
						$this->data['reccurence'] = array(
							'name'			=> 'ev-reccurence',
							'id'			=> 'ev-reccurence',			
							'value'			=> 'checked',
							'checked'		=> false,
							'style'		=> 'vertical-align:middle;margin-top:-2px;'	
						);			
				
						/**********EVENT DETAILS**********/					
						/*****LOCATION*****/						
						$this->data['location'] = array(
							'name'			=> 'ev-location',
							'id'			=> 'ev-location',
							'value'			=> $user['address'].', '.$user['zip'].' '.$user['city'].', '.$user['country']
						);
				
						/*****MUSICAL GENRE*****/
						$musical_genre = $this->genre_model->get_all();	
						$selected = explode('|', $event['genre_id']);			
						$musical_genre_selected = array();
						foreach($selected as $genre_id)
							array_push($musical_genre_selected, $genre_id);							
						
						$this->data['musical_genre'] = array(						
							'id'		=> 'ev-musical-genre',
							'name'		=> 'ev-musical-genre',
							'js'		=> 'style="width:300px" class="ui-corner-all required" id="ev-musical-genre" multiple data-placeholder="Choisissez un genre musical"',
							'options'	=> $musical_genre, 
							'selected'	=> $musical_genre_selected
						);			
						
						/*****RESERVATION*****/						
						$this->data['reservation'] = array(
							'name'			=> 'ev-reservation',
							'id'			=> 'ev-reservation',					
							'value'			=> round($event['reservation'],2),				
							'size'			=> 4,
							'class'			=> 'input fs-13 grey ui-corner-all required number'
						);			
						
						/*****PAYMENT TYPE*****/										
						$this->data['payment_type'] = array(
							'id'					=> 'ev-payment-type',
							'value'					=> '',					
							'data-value'			=> $event['payment_type'],
							'data-payment-amount'	=> round($event['payment_amount'],2),
							'data-percent-drink'	=> round($event['percent_drink'],1),
							'data-percent-entry'	=> round($event['percent_entry'],1),
							'data-refund-fees'		=> $event['refund_fees'],
							'data-resume'			=> ''
						);			
						$this->data['attrs_label_payment_type'] = array(
							'class'		=> 'fs-13 grey normal ml-5'				
						);
						//non rémunéré
						$this->data['label_payment_type_1'] = 'Non rémunéré';
						$this->data['payment_type_1'] = array(
							'name'		=> 'payment-type-1',
							'id'		=> 'payment-type-1',
							'value'		=> 'checked',				
							'checked'	=> ($event['payment_type'] == 2) ? TRUE : FALSE,
							'style'		=> 'vertical-align:middle;margin-top:-3px;'	
						);
						//payment amount
						$this->data['label_payment_type_2'] = 'Cachet de';
						$this->data['payment_type_2'] = array(
							'name'		=> 'payment-type-2',
							'id'		=> 'payment-type-2',
							'value'		=> 'checked',
							'checked'	=> ($event['payment_amount'] != 0) ? TRUE : FALSE ,
							'style'		=> 'vertical-align:middle;margin-top:-3px;'	
						);
						$this->data['input_payment_type_2'] = array(
							'name'		=> 'input-payment-type-2',
							'id'		=> 'input-payment-type-2',
							'value'		=> round($event['payment_amount'],2),
							'class' 	=> 'input grey ui-corner-all mr-5 number',
							'size'		=> 4				
						);
						//percent drink
						$this->data['label_payment_type_3'] = '% des consommations vendues';
						$this->data['payment_type_3'] = array(
							'name'		=> 'payment-type-3',
							'id'		=> 'payment-type-3',
							'value'		=> 'checked',
							'checked'	=> ($event['percent_drink'] != 0) ? TRUE : FALSE,					
							'style'		=> 'vertical-align:middle;margin-top:-3px;'
						);
						$this->data['input_payment_type_3'] = array(
							'name'		=> 'input-payment-type-3',
							'id'		=> 'input-payment-type-3',
							'value'		=> round($event['percent_drink'],1),
							'class' 	=> 'input grey ui-corner-all ml-5 number',
							'size'		=> 2
						);
						//percent entry
						$this->data['label_payment_type_4'] = '% sur la billeterie';
						$this->data['payment_type_4'] = array(
							'name'		=> 'payment-type-4',
							'id'		=> 'payment-type-4',
							'value'		=> 'checked',
							'checked'	=> ($event['percent_entry'] != 0) ? TRUE : FALSE,
							'style'		=> 'vertical-align:middle;margin-top:-3px;'
						);
						$this->data['input_payment_type_4'] = array(
							'name'		=> 'input-payment-type-4',
							'id'		=> 'input-payment-type-4',
							'value'		=> round($event['percent_entry'],1),
							'class'		=> 'input grey ui-corner-all ml-5 number',
							'size'		=> 2
						);
						//refund fees
						$this->data['label_payment_type_5'] = 'Remboursement des frais de réservation';
						$this->data['payment_type_5'] = array(
							'name'		=> 'payment-type-5',
							'id'		=> 'payment-type-5',
							'value'		=> 'checked',
							'checked'	=> ($event['refund_fees'] != 0) ? TRUE : FALSE,
							'style'		=> 'vertical-align:middle;margin-top:-3px;'	
						);		
						
						/*****ENTRY*****/							
						$this->data['entry'] = array(
							'name'			=> 'ev-entry',
							'id'			=> 'ev-entry',
							'value'			=> round($event['entry'],2),					
							'size'			=> 4,
							'class'			=> 'input fs-13 grey ui-corner-all required number'
						);					
				
						/*****DESCRIPTION*****/								
						$this->data['description'] = array(						
							'id' 			=> 'ev-description',
							'value' 		=> $event['description']				
						);
					break;
					default : 
						/*****TITLE*****/
						$this->data['title'] = heading($event['title'],1, 'class="fs-28 title"');
						
						/*****START DATE*****/
						$ds = date_format($date_start,'d/m/Y');
						
						/*****SCHEDULE START*****/
						$ss = date_format($date_start, 'H:i');			
						
						/*****END DATE*****/
						$de = date_format($date_end,'d/m/Y');
						
						/*****SCHEDULE END*****/
						$se = date_format($date_end, 'H:i');						
						
						$event_date = ($ds == $de) ? $ds.' de '.$ss.' à '.$se : 'Le '.$ds.' à '.$ss.' au '.$de.' à '.$se; 
						
						$this->data['event_date'] =  heading('<span aria-hidden="true" class="icon-calendar fs-16 grey ml-5 mr-5"></span>'.$event_date,2,'class="fs-18 title grey"');
						
						/*****LOCATION*****/						
						$this->data['location'] = array(
							'name'			=> 'ev-location',
							'id'			=> 'ev-location',
							'value'			=> $user['address'].', '.$user['zip'].' '.$user['city'].', '.$user['country']													
						);
						
						/*****MUSICAL GENRES*****/
						$musical_genres = array();
						$genres_ids = explode('|', $event['genre_id']);
						$query = $this->db->select('name')
										->from('musical_genres')
										->where_in('id', $genres_ids)
										->get();
						foreach ($query->result_array() as $row)
							array_push($musical_genres, ucfirst($row['name']));
						$this->data['musical_genres'] = implode(', ', $musical_genres);				
						
							
						/*****PAYMENT TYPE*****/	
						$payment_type = array();
						switch($event['payment_type']){
							case 1 : array_push($payment_type, 'Non renseigné'); break;
							case 2 : array_push($payment_type, 'Non remunéré'); break;				
							case 3 : 
								if($event['payment_amount'] > 0)
									array_push($payment_type, 'Chachet de '.round($event['payment_amount'],2).' €');
								if($event['percent_drink'] > 0)
									array_push($payment_type, round($event['percent_drink'],2).'% sur les consommations');
								if($event['percent_entry'] > 0)
									array_push($payment_type, round($event['percent_entry'],2).'% sur la billeterie');
								if($event['refund_fees'] > 0)
									array_push($payment_type, 'Remboursement des frais de réservation');
								break;
							default : break;
						}
						
						$this->data['payment_type'] = implode(', ',$payment_type);					
						
						/*****RESERVATION*****/
						$this->data['reservation'] = round($event['reservation'],2).' €';
						
						/******ENTRY*****/
						$this->data['entry'] = round($event['entry'],2).' €';
						
						/*****DESCRIPTION*****/
						$this->data['description'] = $event['description'];					
					break;
				}					
				
				
				
				/*****EVENT INFOS*****/					
				switch($event['status']){
					case 'open' : 
						$this->footer['scripts'] = array('js/datatable/jquery.dataTables.min.js','js/event.js','js/main-edit-event.js');
					break;					
					
					case 'pending':																
						$tmpl_ev_reservations = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" class="table-reservations">');
						$this->table->set_template($tmpl_ev_reservations); 
						$this->table->set_heading(array('Nom', 'Ville', 'Genre musical', 'Action'));
						$reservations = $this->reservation_model->get_by_event_id($event['id']);																			
						foreach($reservations as $reservation){										
							$artist = $this->user_model->get($reservation['artist_id']);														
							$artist_name = (!empty($artist['company'])) ? $artist['company'] : $artist['username'];
							$artist_city = (!empty($artist['city'])) ? $artist['city'] : 'Non renseigné';						
							$artist_url_link = (!empty($artist['web_address'])) ? site_url($artist['web_address']) : site_url('page/'.$artist['username']);
							$artist_avatar = site_url($artist['avatar']); 
							$musical_genre = 'Jazz';								
							$artist_link = anchor($artist_url_link,'<span aria-hidden="true" class="icon-user fs-13 ts-white"></span>', array('class' => 'button-user-link mr-20', 'title' => 'voir profil'));
							$valid_artist = '<a href="javascript:void(0);" class="button-valid-artist mr-20" data-reservation-id="'.$reservation['id'].'" title="valider"><span aria-hidden="true" class="icon-checkmark fs-13 ts-white"></span></a>';								
							$delete_artist = '<a href="javascript:void(0)" class="button-delete-artist" data-reservation-id="'.$reservation['id'].'" title="refuser"><span aria-hidden="true" class="icon-cancel fs-11 ts-white"></span></a>';																					
							$this->table->add_row(
								anchor($artist_url_link, img(array('src' => $artist_avatar, 'width' => '32px', 'class' => 'mr-10')).$artist_name, array('class' => 'grey')),
								$artist_city,
								$musical_genre,								
								'<div>'.$artist_link.$valid_artist.$delete_artist.'</div>'								
							);		
						}
						$this->data['ev_reservations_title'] = 'Demandes de réservation ('.count($reservations).')';	
						$this->data['ev_reservations'] = $this->table->generate();		

						$this->footer['scripts'] = array('js/datatable/jquery.dataTables.min.js','js/event.js','js/main-edit-event.js');
						break;
						
					case 'accepted':																	
						$tmpl_ev_reservations = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" class="table-reservations">');
						$this->table->set_template($tmpl_ev_reservations); 
						$this->table->set_heading(array('Nom', 'Ville', 'Genre musical', 'Etat'));						
					
						$valid_artist = $this->user_model->get($event['artist_id']);
						$valid_artist_name = (!empty($valid_artist['company'])) ? $valid_artist['company'] : $valid_artist['username'];
						$valid_artist_city = (!empty($valid_artist['city'])) ? $valid_artist['city'] : 'Non renseigné';						
						$valid_artist_link = (!empty($valid_artist['web_address'])) ? site_url($valid_artist['web_address']) : site_url('page/'.$valid_artist['username']);
						$valid_artist_avatar = site_url($valid_artist['avatar']); 
						$musical_genre = 'Jazz';														
						$this->table->add_row(
							anchor($valid_artist_link, img(array('src' => $valid_artist_avatar, 'width' => '32px', 'class' => 'mr-10')).$valid_artist_name, array('class' => 'grey')),
							$valid_artist_city,
							$musical_genre,
							'En attente de paiement'
						);				
												
						$reservations = $this->reservation_model->get_by_event_id($event['id']);
						foreach($reservations as $reservation){							
							$artist = $this->user_model->get($reservation['artist_id']);														
							$artist_name = (!empty($artist['company'])) ? $artist['company'] : $artist['username'];
							$artist_city = (!empty($artist['city'])) ? $artist['city'] : 'Non renseigné';						
							$artist_link = (!empty($artist['web_address'])) ? site_url($artist['web_address']) : site_url('page/'.$artist['username']);
							$artist_avatar = site_url($artist['avatar']); 
							$musical_genre = 'Jazz';															
							$this->table->add_row(
								anchor($artist_link, img(array('src' => $artist_avatar, 'width' => '32px', 'class' => 'mr-10')).$artist_name, array('class' => 'purple')),
								$artist_city,
								$musical_genre,
								'En liste d\'attente'
							);		
						}
						$this->data['ev_reservations_title'] = 'Réservation en attente de paiement';	
						$this->data['ev_reservations'] = $this->table->generate();	

						$this->footer['scripts'] = array('js/datatable/jquery.dataTables.min.js','js/event.js','js/main-edit-event.js');
								
						break;												
						
					case 'close':			
						$this->data['ev_artist_title'] = 'Détails sur l\'artiste / groupe';
						$artist = $this->user_model->get($event['artist_id']);												
						$artist_avatar = img(array('src' => site_url($artist['avatar']),'class' => 'db', 'width' => '164px'));
						$artist_link = (!empty($artist['web_address'])) ? site_url($artist['web_address']) : site_url('page/'.$artist['username']);
						$artist_button_link = anchor($artist_link, 'Voir le profil', array('id' => 'button-artist-link', 'class' => 'ui-green'));
						$artist_name = (!empty($artist['company'])) ? $artist['company'] : $artist['username'];
						$artist_city = (!empty($artist['city'])) ? $artist['city'] : 'Non renseigné';
						$artist_country = (!empty($artist['country'])) ? $artist['country'] : '';						
						$artist_location = '<p class="grey fs-12 pl-2"><strong>Originaire de : </strong>'.$artist_city.', '.$artist_country.'</p>';																		
						$artist_musical_genre = '<p class="grey fs-12 pl-2"><strong>Genre musical : </strong>Rumba congolaise</p>';
						$artist_website = (!empty($artist['website'])) ? '<p class="grey fs-12 pl-2"><strong>Site officiel : </strong>'.anchor($artist['website'], parse_url($artist['website'],  PHP_URL_HOST), array('class' => 'fs-12 green bold')).'</p>' : '';						
						$artist_facebook = (!empty($artist['facebook'])) ? anchor($artist['facebook'],'<span aria-hidden="true" class="icon-facebook"></span>', array('class'=>'m-10 fs-42')): '';
						$artist_twitter = (!empty($artist['twitter'])) ? anchor($artist['twitter'],'<span aria-hidden="true" class="icon-twitter"></span>', array('class'=>'m-10 fs-42')) : '';
						$artist_myspace = (!empty($artist['myspace'])) ? anchor($artist['myspace'],'myspace', array('class'=>'m-10')): '';
						$artist_google_plus = (!empty($artist['google_plus'])) ? anchor($artist['google_plus'],'<span aria-hidden="true" class="icon-google-plus"></span>', array('class'=>'fs-42 m-10')): '';						
						$artist_social_link = (!empty($artist_facebook) || !empty($artist_twitter) || !empty($artist_myspace) || !empty($artist_google_plus)) ? true : false;
						$artist_social_link_title = 'Liens sociaux';
						$artist_description_title = 'Description';
						$artist_description = $artist['description'];							
						$members = $this->member_model->get_all($artist['id']);
						$members_title = 'Les membres du groupe ('.count($members).')';										
						
						$this->data['artist'] = array(
							'avatar'			=> $artist_avatar,
							'link'				=> $artist_link,
							'button_link'		=> $artist_button_link,
							'name'				=> $artist_name,
							'city'				=> $artist_city,
							'country'			=> $artist_country,
							'location'			=> $artist_location,
							'musical_genre'		=> $artist_musical_genre,
							'website'			=> $artist_website,							
							'social_link'		=> $artist_social_link,
							'social_link_title'	=> $artist_social_link_title,
							'facebook'			=> $artist_facebook,
							'twitter'			=> $artist_twitter,
							'myspace'			=> $artist_myspace,
							'google_plus'		=> $artist_google_plus,
							'description_title'	=> $artist_description_title,
							'description'		=> $artist_description,
							'members'			=> $members,
							'members_title'		=> $members_title
						);
						
						$this->footer['scripts'] = array('js/datatable/jquery.dataTables.min.js','js/event.js','js/main-edit-event.js');
						
						break;				
						
					default:break;				
				}
		
				$this->load->view('_header', $this->header);
				$this->load->view('event/'.$event['status'], $this->data);
				$this->load->view('_footer', $this->footer);
			}
			else
				redirect('user/calendar','refresh');
		}	
	}
	
	
	/***********AJAX FUNCTIONS**********/
	/*function add event*/
	function add(){
		if(IS_AJAX){	
			$event = array(
				'stage_id'		=> $this->user['id'],
				'title'			=> $_POST['ev_title'],					
				'date_start'	=> $_POST['ev_date_start'],
				'date_end'		=> $_POST['ev_date_end'],
				'status'		=> 'open',
				'reservation'	=> $_POST['ev_reservation'],
				'entry'			=> $_POST['ev_entry'],
				'description'	=> $_POST['ev_description'],
				'genre_id'		=> $_POST['ev_musical_genre'],
				'payment_type'	=> $_POST['ev_payment_type'],
				'payment_amount'=> $_POST['ev_payment_amount'],
				'percent_drink'	=> $_POST['ev_percent_drink'],
				'percent_entry'	=> $_POST['ev_percent_entry'],
				'refund_fees'	=> $_POST['ev_refund_fees']					
			);
			
			$result = $this->event_model->add($event);
			echo json_encode($result);
		}
		else
			show_404('error_general');				
	}
	
	/*function update event*/
	function update(){
		if(IS_AJAX){	
			$event = array(
				'id'			=> $_POST['ev_id'],
				'stage_id'		=> $this->user['id'],
				'title'			=> $_POST['ev_title'],					
				'date_start'	=> $_POST['ev_date_start'],
				'date_end'		=> $_POST['ev_date_end'],
				'status'		=> $_POST['ev_status'],
				'reservation'	=> $_POST['ev_reservation'],
				'entry'			=> $_POST['ev_entry'],
				'description'	=> $_POST['ev_description'],
				'genre_id'		=> $_POST['ev_musical_genre'],
				'payment_type'	=> $_POST['ev_payment_type'],
				'payment_amount'=> $_POST['ev_payment_amount'],
				'percent_drink'	=> $_POST['ev_percent_drink'],
				'percent_entry'	=> $_POST['ev_percent_entry'],
				'refund_fees'	=> $_POST['ev_refund_fees']	
			);
			
			$result = $this->event_model->update($event);
			echo json_encode($result);
		}
		else
			show_404('error_general');	
	}
	
	/*function delete event*/
	public function delete(){
		if(IS_AJAX){
			$event_id = $_POST['event_id'];
			$event_status = $_POST['event_status'];
			echo $this->event_model->delete($event_id,$this->user['id'],$event_status);
		}
		else
			show_404('error_general');		
	}
	
	//popover event
	function popover($event_id)
	{	
		if(IS_AJAX){
			/*****EVENT*****/
			$event = $this->event_model->get($event_id);							
			$event_status = $event['status'];			
			
			/*****EVENT DATE*****/			
			$date_start = date_create($event['date_start']);
			$date_end = date_create($event['date_end']);
			
			$ds = date_format($date_start,'d/m/Y');			
			$ss = date_format($date_start, 'H:i');	
			$de = date_format($date_end,'d/m/Y');
			$se = date_format($date_end, 'H:i');
			$event_date = ($ds == $de) ? $ds.' de '.$ss.' à '.$se : 'Le '.$ds.' à '.$ss.' au '.$de.' à '.$se; 
			
			/*****MUSICAL GENRES*****/
			$musical_genres = array();
			$genres_ids = explode('|', $event['genre_id']);
			$query = $this->db->select('name')
							->from('musical_genres')
							->where_in('id', $genres_ids)
							->get();
			foreach ($query->result_array() as $row)
				array_push($musical_genres, ucfirst($row['name']));			
			
			
			/*****PAYMENT TYPE*****/
			$payment_type = array();
			switch($event['payment_type']){
				case 1 : array_push($payment_type, 'Non renseigné'); break;
				case 2 : array_push($payment_type, 'Non remunéré'); break;				
				case 3 : 
					if($event['payment_amount'] > 0)
						array_push($payment_type, 'Chachet de '.round($event['payment_amount'],2).' €');
					if($event['percent_drink'] > 0)
						array_push($payment_type, round($event['percent_drink'],2).'% sur les consommations');
					if($event['percent_entry'] > 0)
						array_push($payment_type, round($event['percent_entry'],2).'% sur la billeterie');
					if($event['refund_fees'] > 0)
						array_push($payment_type, 'Remboursement des frais de réservation');
					break;
				default : break;
			}		
			
			switch($event_status){
				case 'open' : 				
					$this->load->view('event/popover_open', array('event' => $event, 'event_date' => $event_date, 'musical_genres' => implode(', ',$musical_genres), 'payment_type' => implode(' + ',$payment_type)));				
					break;
				case 'pending' :			
					$count_reservations = $this->reservation_model->count($event_id); 		
					$this->load->view('event/popover_pending', array('event' => $event, 'event_date' => $event_date, 'musical_genres' => implode(', ',$musical_genres),'count_reservations' => $count_reservations, 'payment_type' => implode(' + ',$payment_type)));
					break;			
				case 'accepted':
					$artist = ($event['artist_id']!= 0) ? $this->ion_auth->user($event['artist_id'])->row_array() : '';
					$artist_name = (!empty($artist['company'])) ? $artist['company'] : $artist['username'];
					$artist_link = (!empty($artist['web_address'])) ? site_url($artist['web_address']) : site_url('page/'.$artist['username']);				
					$this->load->view('event/popover_accepted', array('event' => $event, 'event_date' => $event_date, 'artist_name' => $artist_name, 'musical_genres' => implode(', ',$musical_genres), 'artist_link' => $artist_link, 'payment_type' => implode(' + ',$payment_type)));
					break;
				case 'close' :				
					$artist = $this->ion_auth->user($event['artist_id'])->row_array();
					$artist_name = (!empty($artist['company'])) ? $artist['company'] : $artist['username'];
					$artist_link = (!empty($artist['web_address'])) ? site_url($artist['web_address']) : site_url('page/'.$artist['username']);				
					$this->load->view('event/popover_close', array('event' => $event, 'event_date' => $event_date, 'musical_genres' => implode(', ',$musical_genres), 'artist_name' => $artist_name, 'artist_link' => $artist_link, 'payment_type' => implode(' + ',$payment_type)));
					break;
				default:break;
			}
		}
		else
			show_404('error_general');		
	}	
}