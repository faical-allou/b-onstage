<?php
class Concerts extends CI_Controller {

	function __construct(){
		parent::__construct();	
		
		$this->user = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row_array() : null;	
		$this->load->model('event_model');
		$this->load->model('genre_model');	
		$this->load->model('musical_genre_model');	
		
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
	}

	public function index($page,$url_status){							


		if( ! $search = $this->session->userdata('concertsearch')){	
			$search['search-status'] = 'open';
			$search['search-date-start'] = date('Y-m-d', strtotime("+7 days"));			
			$search['search-date-end'] = date('Y-m-d', strtotime("+21 days"));		
			$search['search-city'] = null;
		}	
	
		$this->form_validation->set_rules('search-date-start', 'Date de début', 'required|validMysqlDate');
		$this->form_validation->set_rules('search-date-end', 'Date de fin', 'required|validMysqlDate');				
		
		$per_page = 25;	
				
		$post = $this->input->post();	
		
		if(isset($post['clear'])){
			$this->session->unset_userdata('concertsearch');
			$post=array();
		}
		
		//set session vars				
		if($post and $this->form_validation->run()){			
			foreach ($post as $key => $value) {
				if($value and in_array($key, array('search-date-start', 'search-date-end', 'search-country' , 'search-city', 'search-status')))
					if(is_array($value))
						$search[$key] = implode(',' , $value);
					else
						$search[$key] = $value;						
			}			
			if($search){				
				$this->session->set_userdata('concertsearch', $search);
			}
		}
		if($url_status)
			$search['search-status'] = ($url_status=='oujouer') ? 'open' : 'close';
		
		$date_start = isset($search['search-date-start']) ? $search['search-date-start'].' 00:00:00' : date('Y-m-d 00:00:00');
		$date_end = isset($search['search-date-end']) ? $search['search-date-end'].' 23:59:59' : date('Y-m-d 23:59:59', strtotime("+1 years"));  			
		$status = isset($search['search-status']) ? $search['search-status'] : 'open';				
		
		$cities = $this->event_model->get_stage_cities();
		$countries = $this->event_model->get_stage_countries();	
		$city_by_country = $this->event_model->get_stage_cities_by_countries();	
		//load vars
		$this->load->vars(array('search' => $search));				
		$this->load->vars(array('cities' => $cities));				
		$this->load->vars(array('countries' => $countries));			
		$this->load->vars(array('city_by_country' => $city_by_country));			
		
		//Get all musical genres	
		$genres = $this->musical_genre_model->get(0,'');		
		
		// Get events									
		if (isset($_GET['id'])) {
		$events = $this->event_model->get_one_by_id(
				$_GET['id'],
				$status,
				$date_start,
				$date_end,
				$this->input->post('search-city'),
				'',
				$per_page,
				$page				
				);
		}
		else {
		$events = $this->event_model->get_all(					
			$status,
			$date_start,
			$date_end,
			$this->input->post('search-city'),
			'',
			$per_page,
			$page
		);		
		};
		
		// Get min max reservation, entry
		list($min, $max) = $this->event_model->get_filter_infos($date_start, $date_end);	
		
		//load page						
		$events_list ='';
		switch($status){
			case 'open':		
				//var header			
				$this->header['title'] = lang("user_book_title");
				$this->header['description'] = lang("user_book_desc");
				
				//input filter
				$filter_remuneration = array(
					//payment amount
					'label_filter_payment_amount'	=> lang("users_calendar_create_cachet"),
					'input_filter_payment_amount'	=>array(
						'name'		=> 'filter-payment-amount',
						'id'		=> 'filter-payment-amount',
						'value'		=> 'checked',
						'checked'	=> FALSE,
						'style'		=> 'vertical-align:middle;margin-top:-3px;'
					),
					//percent drink
					'label_filter_percent_drink'	=> ' '.lang("users_calendar_create_conso"),
					'input_filter_percent_drink'	=>array(
						'name'		=> 'filter-percent-drink',
						'id'		=> 'filter-percent-drink',
						'value'		=> 'checked',
						'checked'	=> FALSE,
						'style'	=> 'vertical-align:middle;margin-top:-3px;'
					),
					//percent entry
					'label_filter_percent_entry'	=> '% '.lang("users_calendar_create_tickets"),
					'input_filter_percent_entry'	=>array(
						'name'		=> 'filter-percent-entry',
						'id'		=> 'filter-percent-entry',
						'value'		=> 'checked',
						'checked'	=> FALSE,
						'style'		=> 'vertical-align:middle;margin-top:-3px;'
					),
					//refund fees
					'label_filter_refund_fees'	=> lang("users_calendar_create_remb"),
					'input_filter_refund_fees'	=>array(
						'name'		=> 'filter-refund-fees',
						'id'		=> 'filter-refund-fees',
						'value'		=> 'checked',
						'checked'	=> FALSE,
						'style'		=> 'vertical-align:middle;margin-top:-3px;'
					),
					//non rémunéré
					'label_filter_remuneration'	=> lang("users_calendar_create_non_renum"),
					'input_filter_remuneration'	=>array(
						'name'		=> 'filter-remuneration',
						'id'		=> 'filter-remuneration',
						'value'		=> 'checked',
						'checked'	=> FALSE,
						'style'		=> 'vertical-align:middle;margin-top:-3px;'
					)		
				);
					
				$filter_sort = array(
					'label'		=> lang("sortby"),
					'name'		=> 'filter-sort',
					'options'	=> array(
						'date_start'	=> lang("date"),
						'reservation'	=> lang("users_rese_fees"),
						'entry'			=> lang("users_rese_enterprice")
					),
					'selected'	=> 'date_start',
					'js'		=> 'id="filter-sort"'
				);								
				
				foreach ($events as $event) {
					switch($event['payment_type']){
						case 1 : 
							$payment_type = lang("payment_notset");
							break;
						case 2 :
							$payment_type = lang("users_calendar_create_non_renum");
							break;
						case 3 :
							$payment_type = ($event['payment_amount'] > 0) ? lang("users_calendar_create_cachet").' '.round($event['payment_amount'],2).'€ '.br() : '';
							$payment_type .= ($event['percent_drink'] > 0) ? round($event['percent_drink'],2).' '.lang("users_calendar_create_conso").br() : '';
							$payment_type .= ($event['percent_entry'] > 0) ? round($event['percent_entry'],2).'% '.lang("users_calendar_create_tickets").br() : '';
							$payment_type .= ($event['refund_fees'] > 0) ? lang("users_calendar_create_remb") : '';
							break;
						default : break;
					}								
					$data = array(
						'event'				=> $event,
						'date_start'		=> date_create($event['date_start']),
						'date_end'			=> date_create($event['date_end']),
						'event_location'	=> $event['stage_city'].', '.$event['stage_country'],
						'event_genres'		=> implode(', ',$event['genres']),
						'entry'				=> !empty($event['entry']) ? round($event['entry'], 2).' ' : '0',	
						'payment_type'		=> $payment_type,
						'stage_link'		=> !empty($event['stage_web_address']) ?  site_url($event['stage_web_address']) : site_url('page/'.$event['stage_username']),
						'reserved'			=> in_array($this->user['id'], $event['reservations_artist_id']) ? true : false
					);						
					$events_list.= $this->load->view('concerts/tpl_open_event', $data, true);		
				}
				
				$count_events = $this->event_model->count_events(array('open','pending'), $date_start, $date_end);													
				
				$data = array(					
					'status'				=> $status,
					'events_list'			=> $events_list,			
					'count_events'			=> $count_events,
					'next_page'				=> $page + 1,
					'per_page'				=> $per_page,
					'reservation_min'		=> ceil($min['reservation']),
					'reservation_max'		=> floor($max['reservation']),
					'entry_min'				=> ceil($min['entry']),
					'entry_max'				=> floor($max['entry']),
					'genres'				=> $genres,
					'filter_sort'			=> $filter_sort,
					'filter_remuneration'	=> $filter_remuneration
				);							
				
				$this->footer['scripts'] = array('js/concert.js','js/main-concert.js');
				
				$this->load->view('_header', $this->header);	
				$this->load->view('concerts/open', $data);	
				$this->load->view('_footer', $this->footer);				
			break;
			case 'close' : 
				//var header			
				$this->header['title'] = lang("user_shows_title");
				$this->header['description'] = lang("user_shows_desc");
				
				//var input filter
				$filter_sort = array(
					'label'		=> lang("sortby"),
					'name'		=> 'filter-sort',
					'options'	=> array(
						'date_start'	=> lang("shows_sortby1"),					
						'entry'			=> lang("shows_sortby2")
					),
					'selected'	=> '',
					'js'		=> 'id="filter-sort"'
				);				
				
				foreach ($events as $event) {								
					$data = array(
						'event'				=> $event,
						'date_start'		=> date_create($event['date_start']),
						'date_end'			=> date_create($event['date_end']),
						'event_location'	=> $event['stage_city'].', '.$event['stage_country'],
						'event_genres'		=> implode(', ',$event['genres']),	
						'entry'				=> !empty($event['entry']) ? round($event['entry'], 2).' ' : '0',
						'stage_link'		=> !empty($event['stage_web_address']) ?  site_url($event['stage_web_address']) : site_url('page/'.$event['stage_username']),
						'artist_link'		=> !empty($event['artist_web_address']) ?  site_url($event['artist_web_address']) : site_url('page/'.$event['artist_username'])
					);
					$events_list.= $this->load->view('concerts/tpl_close_event', $data, true);		
				}
				
				$count_events = $this->event_model->count_events($status, $date_start, $date_end);									
				
				// Load the page
				$data = array(					
					'status'				=> $status,
					'events_list'			=> $events_list,			
					'count_events'			=> $count_events,
					'next_page'				=> $page + 1,
					'per_page'				=> $per_page,
					'reservation_min'		=> ceil($min['reservation']),
					'reservation_max'		=> floor($max['reservation']),	
					'entry_min'				=> ceil($min['entry']),
					'entry_max'				=> floor($max['entry']),
					'genres'				=> $genres,
					'filter_sort'			=> $filter_sort					
				);		
				
				$this->footer['scripts'] = array('js/concert.js','js/main-concert.js');
				
				$this->load->view('_header', $this->header);
				$this->load->view('concerts/close', $data);
				$this->load->view('_footer', $this->footer);	
			
			default : break;
		}		
	}
	
	public function show(){				
		
		if(IS_AJAX){
			$output 			= '';
			$status				= $_POST['status'];
			$per_page			= $_POST['per_page'];
			$page				= $_POST['page'];
			$payment_type		= $_POST['payment_type'];
			$genres				= $_POST['genres'];
			$schedule_min		= $_POST['schedule_min'];
			$schedule_max		= $_POST['schedule_max'];
			$reservation_min	= $_POST['reservation_min'];
			$reservation_max	= $_POST['reservation_max'];
			$entry_min			= $_POST['entry_min'];
			$entry_max			= $_POST['entry_max'];
			$order_by			= $_POST['order_by'];
			
			$search = $this->session->userdata('concertsearch');		
			$date_start = isset($search['search-date-start']) ? $search['search-date-start'].' 00:00:00' : date('Y-m-d 00:00:00');
			$date_end = isset($search['search-date-end']) ? $search['search-date-end'].' 23:59:59' : date('Y-m-d 23:59:59', strtotime("+1 years"));
			$city = isset($search['search-city']) ? explode(',',$search['search-city']) : '';								
							
			$events = $this->event_model->filter($status,$date_start,$date_end,$city,'',$payment_type, $genres, $schedule_min, $schedule_max, $reservation_min, $reservation_max, $entry_min, $entry_max, $per_page, $page,$order_by);
			
			switch($status){
				case 'open':		
					foreach($events as $event){				
						switch($event['payment_type']){
							case 1 : 
								$payment_type = lang("payment_notset");
								break;
							case 2 :
								$payment_type = lang("users_calendar_create_non_renum");
								break;
							case 3 :
								$payment_type = ($event['payment_amount'] > 0) ? lang("users_calendar_create_cachet").round($event['payment_amount'],2).'€ '.br() : '';
								$payment_type .= ($event['percent_drink'] > 0) ? round($event['percent_drink'],2).' '.lang("users_calendar_create_conso").br() : '';
								$payment_type .= ($event['percent_entry'] > 0) ? round($event['percent_entry'],2).'% '.lang("users_calendar_create_tickets").br() : '';
								$payment_type .= ($event['refund_fees'] > 0) ? lang("users_calendar_create_remb") : '';
								break;
							default : break;
						}			
						$data = array(
							'event'				=> $event,
							'date_start'		=> date_create($event['date_start']),
							'date_end'			=> date_create($event['date_end']),
							'payment_type'		=> $payment_type,
							'entry'				=> !empty($event['entry']) ? round($event['entry'], 2).' ' : '0',
							'event_location'	=> $event['stage_city'].', '.$event['stage_country'],
							'event_genres'		=> implode(', ',$event['genres']),
							'stage_link'		=> !empty($event['stage_web_address']) ?  site_url($event['stage_web_address']) : site_url('page/'.$event['stage_username']),
							'reserved'			=> in_array($this->user['id'], $event['reservations_artist_id']) ? true : false
						);			
						$output .= $this->load->view('concerts/tpl_open_event', $data, true);
					}				
					break;
				case 'close':
					foreach($events as $event){
						$data = array(
							'event'				=> $event,
							'date_start'		=> date_create($event['date_start']),
							'date_end'			=> date_create($event['date_end']),
							'event_location'	=> $event['stage_city'].', '.$event['stage_country'],
							'event_genres'		=> implode(', ',$event['genres']),
							'entry'				=> !empty($event['entry']) ? round($event['entry'], 2).' ' : '0',								
							'stage_link'		=> !empty($event['stage_web_address']) ?  site_url($event['stage_web_address']) : site_url('page/'.$event['stage_username']),
							'artist_link'		=> !empty($event['artist_web_address']) ?  site_url($event['artist_web_address']) : site_url('page/'.$event['artist_username'])
							);			
						$output .= $this->load->view('concerts/tpl_close_event', $data, true);						
					}
					break;	
				default : break;	
			}
			echo json_encode(array('text' => $output, 'count_event' => count($events)));	
		}	
	}
		
	public function popover_date_control(){
		if( ! $search = $this->session->userdata('concertsearch'))
			$search = array();
		$this->load->view('concerts/popover_date_control', array('search-date_start' => @$search['date-start'], 'search-date_end' => @$search['date-end']));
	}
	
	public function get_cities(){
		$term = $this->input->get('term');
		$result = array();
		$cities = $this->event_model->get_stage_cities($term);
		foreach($cities as $city){
			if(empty($city['city'])) continue;
			$result[] = array('value'=>$city['city'], 'text'=>$city['city'].' ('.$city['nb'].')');
		}
		echo json_encode($result);
	}
	
	public function populate_events( $nb_rows ){
		$this->event_model->populate_events($nb_rows);
		echo 'OK';
	}
	
	private function validMysqlDate( $date ){
		return preg_match( '#^(?P<year>\d{2}|\d{4})([- /.])(?P<month>\d{1,2})\2(?P<day>\d{1,2})$#', $date, $matches )
			&& checkdate($matches['month'],$matches['day'],$matches['year']);
	}
	

}
?>