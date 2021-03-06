<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		//var user connect
		$this->user = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row_array() : null;		
				
		$this->load->library('parser');
		
		$this->load->model('member_model');
		$this->load->model('event_model');		
		$this->load->model('concert_model');		
		$this->load->model('media_model');		
		$this->load->model('group_model');
		$this->load->model('genre_model');		
		$this->load->model('sound_model');		
		$this->load->model('social_model');

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

	function index($username = '', $tab = 'profil'){
	
		$tabs = array('profil', 'concert', 'sound', 'video', 'photo');
		
		if($username){
			$user_page = $this->ion_auth->user_by_username($username)->row_array();
			if($user_page){
				if($user_page['web_address']) redirect(site_url($user_page['web_address'].'/'.$tab));
				else if(!in_array($tab, $tabs))
					$tab = 'profil';	
			} else show_404('error_general');			
		} else {
			$web_address = $this->uri->segment(1);
			$tab = $this->uri->segment(2,'profil');
			$user_page = $this->ion_auth->user_by_web_address($web_address)->row_array();
			if(!$user_page) show_404('error_general');
			else if(!in_array($tab, $tabs))
				$tab = 'profil';	
		}
		
		//$user_group_page = stage pour les etablissements, = artist si artiste
		$user_group_page = $this->ion_auth->in_group('artist', $user_page['id']) ? 'artist' : 'stage';
		$active_menu_page = 'menu-page-'.$tab;
		
		//$user_state
		//si pas connecté
		if(!$this->ion_auth->logged_in())		
			$user_state = 0;				
		//si connecté mais pas sur sa fiche
		else if($this->ion_auth->logged_in() && !($user_page['id'] == $this->session->userdata('user_id')))
			$user_state = 1;				
		//si connecté et sur sa fiche
		else if($this->ion_auth->logged_in() && ($user_page['id'] == $this->session->userdata('user_id')))
			$user_state = 2;
				
		//get all infos
		$title_infos =lang("users_page_generalinfo");
		$title_equipement = lang("users_page_equipment_title");
		
		
		$infos = array(
			//company
			array(
				'id'			=> 'company',
				'title'			=> ($user_group_page == 'stage') ? lang("users_page_stage") : lang("users_page_band"),
				'val'			=> !empty($user_page['company']) ? $user_page['company'] : '',				
				'type'			=> 'text',
				'form_label'	=> ($user_group_page == 'stage') ? lang("signup_stage_step_1_form_field1_title") : lang("signup_form_title1"),
				'input_type'	=> 'text',
				'form_msg'		=> 'Ex: Wu tang clan, Manu chao ...',
				'msg'			=> ($user_group_page == 'stage') ? lang("signup_stage_step_1_form_field1_title") : lang("signup_form_title1")
			),
			//country
			array(
				'id'			=> 'country',
				'title'			=> lang("country"),
				'val'			=> !empty($user_page['country']) ? $user_page['country'] : '',
				'type'			=> 'text',
				'form_label'	=> lang("users_page_inputcountry"),
				'input_type'	=> 'text',
				'form_msg'		=> 'Ex: France, Canada ...',
				'msg'			=> lang("users_page_inputcountry")
			),
			//city
			array(
				'id'			=> 'city',
				'title'			=> lang("city"),
				'val'			=> !empty($user_page['city']) ? $user_page['city'] : '',
				'type'			=> 'text',
				'form_label'	=> lang("users_page_inputcity"),
				'input_type'	=> 'text',
				'form_msg'		=> 'Ex: Paris, Montréal ...',
				'msg'			=> lang("users_page_inputcity")
			),
			//website
			array(
				'id'			=> 'website',
				'title'			=> lang("users_page_website"),
				'val'			=> !empty($user_page['website']) ? $user_page['website'] : '',
				'type'			=> 'url',
				'form_label'	=> lang("users_page_inputwebsite"),				
				'input_type'	=> 'url',
				'form_msg'		=> 'Ex: http://www.mywebsite.com',
				'msg'			=> lang("users_page_inputwebsite")
			),
			);
			$equipment = array(
			//room_size
				array(
						'id'			=> 'room_size',
						'title'			=> lang("users_page_roomsize"),
						'val'			=> !empty($user_page['room_size']) ? $user_page['room_size'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputroomsize"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: 50',
						'msg'			=> lang("users_page_inputroomsize")
				),
				//stage_size
				array(
						'id'			=> 'stage_size',
						'title'			=> lang("users_page_stagesize"),
						'val'			=> !empty($user_page['stage_size']) ? $user_page['stage_size'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputstagesize"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: 4',
						'msg'			=> lang("users_page_inputstagesize")
				),
				//microphone
				array(
						'id'			=> 'microphone',
						'title'			=> lang("users_page_microphone"),
						'val'			=> !empty($user_page['microphone']) ? $user_page['microphone'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputequipment"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: 4',
						'msg'			=> lang("users_page_inputequipment")
				),
				//speakers
				array(
						'id'			=> 'speakers',
						'title'			=> lang("users_page_speakers"),
						'val'			=> !empty($user_page['speakers']) ? $user_page['speakers'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputequipment"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: 2 active speakers',
						'msg'			=> lang("users_page_inputequipment")
				),
				//amplification
				array(
						'id'			=> 'amplification',
						'title'			=> lang("users_page_amplification"),
						'val'			=> !empty($user_page['amplification']) ? $user_page['amplification'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputequipment"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: an 8 track console ',
						'msg'			=> lang("users_page_inputequipment")
				),
				//lights
				array(
						'id'			=> 'lights',
						'title'			=> lang("users_page_lights"),
						'val'			=> !empty($user_page['lights']) ? $user_page['lights'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputequipment"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: 8 track console ',
						'msg'			=> lang("users_page_inputequipment")
				),
				//other
				array(
						'id'			=> 'other',
						'title'			=> lang("users_page_otherequipment"),
						'val'			=> !empty($user_page['other']) ? $user_page['other'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputotherequipment"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: Full Drum Kit ',
						'msg'			=> lang("users_page_inputotherequipment")
				),
				//noise
				array(
						'id'			=> 'noise',
						'title'			=> lang("users_page_noise"),
						'val'			=> !empty($user_page['noise']) ? $user_page['noise'] : '',
						'type'			=> 'text',
						'form_label'	=> lang("users_page_inputnoise"),
						'input_type'	=> 'text',
						'form_msg'		=> 'ex: no Drums after 10pm ',
						'msg'			=> lang("users_page_inputnoise")
				),
		);	
			
		$empty_infos = empty($user_page['company']) && empty($user_page['country']) && empty($user_page['city']) && empty($user_page['website']);
		
		//social links
		$title_social_links = lang("users_page_socialmed");
		
		$social_links = array(
			array(
				'id'			=> 'facebook',
				'title'			=> 'Facebook',
				'logo'			=> '<span aria-hidden="true" class="fs-50 grey icon-facebook"></span>',
				'val' 			=> !empty($user_page['facebook']) ? $user_page['facebook'] : '',				
				'type'			=> 'logo',
				'form_label'	=> lang("users_page_inputsocialmed1"),
				'input_type'	=> 'url',
				'form_msg'		=> 'Ex: http://www.monfacebook.com',
				'msg'			=> lang("users_page_inputsocialmed1")
			),
			//twitter
			array(
				'id'			=> 'twitter',
				'title'			=> 'Twitter',
				'logo'			=> '<span aria-hidden="true" class="fs-50 grey icon-twitter"></span>',
				'val'			=> !empty($user_page['twitter']) ? $user_page['twitter'] : '',
				'type'			=> 'logo',
				'form_label'	=> lang("users_page_inputsocialmed3"),
				'input_type'	=> 'url',
				'form_msg'		=> 'Ex: http://www.montwitter.com',
				'msg'			=> lang("users_page_inputsocialmed3")
			),
			//google plus
			array(
				'id'			=> 'google_plus',
				'title'			=> 'Google +',
				'logo'			=> '<span aria-hidden="true" class=" fs-50 grey icon-google-plus"></span>',
				'val'			=> !empty($user_page['google_plus']) ? $user_page['google_plus'] : '',
				'type'			=> 'logo',
				'form_label'	=> lang("users_page_inputsocialmed4"),
				'input_type'	=> 'url',
				'form_msg'		=> 'Ex: http://www.mongoogleplus.com',
				'msg'			=> lang("users_page_inputsocialmed4")
			),
			//myspace
			array(
				'id'			=> 'myspace',
				'title'			=> 'Myspace',
				'logo'			=> '<span aria-hidden="true" class="fs-50 grey icon-link-2"></span>',
				'val'			=> !empty($user_page['myspace']) ? $user_page['myspace'] : '',
				'type'			=> 'logo',
				'form_label'	=> lang("users_page_inputsocialmed2"),
				'input_type'	=> 'url',
				'form_msg'		=> 'Ex: http://www.monmyspace.com',
				'msg'			=> lang("users_page_inputsocialmed2")
			),
		);	
		$empty_social_links = empty($user_page['facebook']) && empty($user_page['myspace']) && empty($user_page['twitter']) && empty($user_page['google_plus']);

		
		//description : biographie pour les groupes		
		$title_description = ($user_group_page == 'stage') ? lang("desc") : lang("bio");		
		$description = !empty($user_page['description']) ? $user_page['description'] : '';
			
		
		/********** CONCERTS **********/			
		$concerts = $this->concert_model->get_by_user_id($user_page['id'], $user_group_page);	
		$nb_concerts = count($concerts);	
		//list_open_concerts = liste des concerts à venir
		//list_close_concerts = liste des concerts passés, joués				
		$title_concerts = lang("users_page_shows_upcoming").' ('.$nb_concerts.')';	
		$list_concerts = '';				
				
		foreach($concerts as $concert){
			$date_concert = date_format(date_create($concert['date_start']), 'j').nbs();
			$date_concert .= get_month(date_format(date_create($concert['date_start']), 'n'));
			$date_concert .= nbs().'-'.nbs();
			$date_concert .= date_format(date_create($concert['date_start']), 'G\hi');		 
					
			$data = array(				
				'date_concert'			=> $date_concert,
				'title'					=> $concert['title'],
				'description'			=> empty($concert['description']) ? '<p class="grey fs-12"><i>'.lang("users_page_desc_notfound").'</i></p>' : $concert['description'],
				'rows_name'				=> array(
					($user_group_page == 'artist') ? lang("users_rese_scene_stage") : lang("users_rese_artist_band"),
					lang("users_calendar_create_price"),
					lang("otherinfos")
				),
				'cover_url'				=> site_url($concert['cover']),
				'avatar_url'			=> site_url($concert['avatar']),
				'title_company'			=> $user_group_page == 'artist' ? lang("scene") : lang("artist"),
				'company'				=> $concert['company'],
				'link_url'				=> empty($concert['web_address']) ? site_url($concert['web_address']) : site_url('page/'.$concert['username']),
				'location'				=> $concert['city'].', '.$concert['country'],
				'entry'					=> empty($concert['entry']) ? '0' : round($concert['entry'],2),
				'concert_url'			=> site_url('event/'.$concert['id'])				
			);

			$list_concerts .= $this->load->view('page/tpl_concert', $data, true);			
		}
		
		/********** Events **********/
		$date_start = date('Y-m-d 00:00:00',strtotime("+7 days"));
		$date_end = date('Y-m-d 23:59:59', strtotime("+1 month"));
		
		$events = $this->event_model->get_all('open', $date_start, $date_end, $user_page['city'], $user_page['id'],50, 1);
		$nb_events = count($events);
		$title_events = lang('availability');
		$list_events = '';
		
		foreach($events as $event){
			$date_event = date_format(date_create($event['date_start']), 'j').nbs();
			$date_event .= get_month(date_format(date_create($event['date_start']), 'n'));
			$date_event .= nbs().'-'.nbs();
			$date_event .= date_format(date_create($event['date_start']), 'G\hi');
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
			};
				
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
		
			$list_events .= $this->load->view('concerts/tpl_open_event_light', $data, true);
		}
		
		
		/********** MEDIAS **********/
		$medias = $this->media_model->get_all($user_page['id']);
		
		/**********SOUND**********/
		$title_sounds = heading('<span aria-hidden="true" class="icon-music fs-14"></span> '.lang("users_page_menu3"), 1 ,'class="title-page ui-corner-top"');
		$all_sound = $this->sound_model->get($user_page['id']);
		$sound = array();
		$sound['tracks'] = '';
		
		
		if(array_key_exists('tracks',$all_sound)){							
			foreach($all_sound['tracks'] as $track){
				$metadata = unserialize($track['metadata']);	
				$min_duration = floor($metadata['playtime_seconds'] / 60);
				$sec_duration = $metadata['playtime_seconds'] % 60;
				$duration = (($min_duration < 10) ? '0'.$min_duration : $min_duration).':'.(($sec_duration < 10) ? '0'.$sec_duration : $sec_duration);
			
				$data = array(
					'track'		=> $track,
					'duration'	=> $duration
				);	
				
				if($user_state == 2)
					//edit mode					
					$sound['tracks'].= $this->load->view('sound/tpl_edit',$data, true);						
				else	
					//read mode
					$sound['tracks'].= $this->load->view('sound/tpl_read',$data, true);						
			}	
			
			$sound['count_tracks'] = count($all_sound['tracks']);			
			
		} else {		
			$sound['count_tracks'] = 0;
			$sound['tracks'] .= '<p class="grey fs-15"><i>Aucune piste disponible pour le moment.</i></p>';
		}	
		
		
		
		/********* SOUNDCLOUD **********/
		$title_soundcloud = heading('<span aria-hidden="true" class="icon-soundcloud fs-14"></span> Soundcloud', 1 ,'class="title-page ui-corner-top"');					
				
		$sc_sounds = 'Aucun utilisateur enregistré';			
		if(array_key_exists('sc_sounds',$medias)){												
			$sc_users = array();
			$sc_tracks = array();			
			$sc_track_count = 0;	
			foreach($medias['sc_sounds'] as $sc_sound){					
				switch($sc_sound['type']){
					case 'user':
						array_push($sc_users, unserialize($sc_sound['data']));						
						break;
					case 'track':
						if($user_state == 2)
							array_push($sc_tracks, $sc_sound);						
						else if(($user_state != 2) && $sc_sound['visible']){
							$sc_track_count++;
							array_push($sc_tracks, $sc_sound);				
						}		
						break;
					default:break;						
				}
			}
			
			if($user_state == 2){
				$data = array(
					'sc_users' 	=> $sc_users,
					'sc_tracks'	=> $sc_tracks					
				);	
				$sc_sounds = $this->load->view('soundcloud/tpl_edit', $data, true);
			}else{
				$data = array(
					'sc_users' 			=> $sc_users,
					'sc_tracks'			=> $sc_tracks,
					'sc_track_count'	=> $sc_track_count	
				);
				$sc_sounds = $this->load->view('soundcloud/tpl_read', $data, true);
			}	
		}	
		
				
		/**********VIDEOS**********/		
		$title_videos = heading(lang("users_page_menu4"), 1 ,'class="title-page ui-corner-top"');							
		$videos = array();		
		
		$videos['yt_feed_count'] = 0;				
		$videos['yt_video_count'] = 0;
		$videos['yt_videos'] = '';
		$videos['yt_feeds'] = '';
		$yt_videos = array();
		$yt_feeds = array();
		
		if(array_key_exists('yt_medias',$medias)){				
			foreach($medias['yt_medias'] as $yt_media){				
				switch($yt_media['type']){
					case 'video':
						$yt_video['id'] = $yt_media['id'];
						$yt_video['yt_id'] = $yt_media['yt_id'];
						$yt_video['video'] = $this->_get_data($yt_media['url'].'?alt=json', true);
						array_push($yt_videos, $yt_video);
						$videos['yt_video_count']++;					
					break;
					case 'feed':
						$yt_feed['id'] = $yt_media['id'];
						$yt_feed['feed'] = $this->_get_data($yt_media['url'].'?alt=json', true);
						array_push($yt_feeds, $yt_feed);
						$videos['yt_feed_count']++;
						break;						
					default:break;
				}					
			}
			
			//yt videos			
			foreach($yt_videos as $yt_video){
				$id = $yt_video['id'];
				$entry = $yt_video['video']['entry'];
				$data = array(
					'id'			=> $id,
					'title'			=> $entry['media$group']['media$title']['$t'],
					'view_count'	=> $entry['yt$statistics']['viewCount'],											
					'thumbnail_url'	=> $entry['media$group']['media$thumbnail'][0]['url'],							
					'link_url'		=> $entry['link'][0]['href'],					
					'player_url'	=> $entry['media$group']['media$content'][0]['url'],
					'description'	=> ellipsize($entry['media$group']['media$description']['$t'],200,1),
					'yt_id'			=> $yt_video['yt_id']
				);		
				$videos['yt_videos'] .= $this->load->view('page/tpl_yt_video', $data ,true);
			}		
			
			//yt flux
			foreach($yt_feeds as $yt_feed){
				$id = $yt_feed['id'];
				$entry = $yt_feed['feed']['entry'];
				$yt_feed_url = $entry['gd$feedLink'][4]['href'].'?alt=json&max-results=10';
				$yt_feed_videos = $this->_get_data($yt_feed_url, true);				
				$feed = '';
				
				foreach($yt_feed_videos['feed']['entry'] as $yt_feed_video){					
					$data = array(
						'id'			=> '',
						'title'			=> $yt_feed_video['media$group']['media$title']['$t'],
						'view_count'	=> $yt_feed_video['yt$statistics']['viewCount'],											
						'thumbnail_url'	=> $yt_feed_video['media$group']['media$thumbnail'][0]['url'],							
						'link_url'		=> $yt_feed_video['link'][0]['href'],
						'player_url'	=> $yt_feed_video['media$group']['media$content'][0]['url'],
						'description'	=> ellipsize($yt_feed_video['media$group']['media$description']['$t'],200,1)
					);		
					$feed .= $this->load->view('page/tpl_yt_video', $data ,true);
				}				
				
				$data = array(
					'id'			=> $id,
					'username' 		=> $entry['yt$username']['$t'],					
					'feed_count'	=> $entry['gd$feedLink'][4]['countHint'],
					'feed_title'	=> $entry['title']['$t'],
					'feed_url'		=> $entry['link'][0]['href'],
					'avatar_url'	=> $entry['media$thumbnail']['url'],				
					'feed'			=> $feed		
				);
				
				$videos['yt_feeds'] .= $this->load->view('page/tpl_yt_feed', $data ,true);			
				
			}			
		}	

		
		
		
		/**********PHOTOS**********/
		//title
		$title_photos = heading('<span aria-hidden="true" class="icon-camera fs-14"></span> Photos', 1 ,'class="title-page ui-corner-top"');					
		
		$all_albums_photos = $this->media_model->get_albums_photos($user_page['id']);		
		$albums_photos = '';
		foreach($all_albums_photos as $ap){
			$album_photo = array(
				'id'			=> $ap['id'],
				'title'			=> $ap['title'],
				'description'	=> $ap['description'],
				'count_photo'	=> $ap['count_photo'],
				'thumb_url'		=> site_url($this->media_model->get_thumb_album_photo($ap['id']))				
			);
			$albums_photos .= $this->load->view('page/template_album_photo', $album_photo, true);
		}
		
		
		
		/*****PICASA*****/		
		$photos['pi_title'] = heading('<span aria-hidden="true" class="icon-picassa fs-14"></span> Picasa', 1 ,'class="title-page ui-corner-top"'); 
		$photos['pi_users_count'] = 0;
		$photos['pi_photos'] = '';						
		
		if(array_key_exists('pi_photos',$medias)){				
			foreach($medias['pi_photos'] as $pi){									
				$photos['pi_users_count']++;
				$pi_data = $this->_get_data($pi['url'].'?alt=json', true);
				$pi_user = array(
					'id'		=> $pi['id'],
					'name'		=> $pi_data['feed']['author'][0]['name']['$t'],
					'link'		=> $pi_data['feed']['author'][0]['uri']['$t'],
					'thumbnail'	=> $pi_data['feed']['gphoto$thumbnail']['$t'],
					'entry'		=> isset($pi_data['feed']['entry']) ? $pi_data['feed']['entry'] : null,
					'user_page'	=> $user_page
				);
				
				if($user_state == 2)
					$photos['pi_photos'] .= $this->load->view('picasa/tpl_edit', $pi_user, true);
				else	
					$photos['pi_photos'] .= $this->load->view('picasa/tpl_read', $pi_user, true);				
			}			
		}					
		
		
		
		
		
		/*****INSTAGRAM*****/
		$title_in_photos = heading('<span aria-hidden="true" class="icon-instagram fs-14"></span> Instagram', 1 ,'class="title-page ui-corner-top"');		
		
		
		/*****FLICKR*****/
		$title_fl_photos = heading('<span aria-hidden="true" class="icon-flickr fs-14"></span> Flickr', 1 ,'class="title-page ui-corner-top"');
		
		
		/*****GET SOCIAL INFOS*****/
//		$social_sidebar = $this->social_model->get_all();
//		$social_sidebar = $this->load->view('social/tpl_sidebar', $social_sidebar, true);
		
		//var header		
		$this->header['doctype'] = 'html5';
		$this->header['title'] = empty($user_page['company']) ? $username : $user_page['company']. ' | b-onstage';
		$this->header['description'] = lang("user_page_desc");		
		
		$data = array(			
			'user_page'					=> $user_page,
			'active_menu_page'			=> $active_menu_page,
			'user_group_page'			=> $user_group_page,
			'user_state'				=> $user_state,						
			'title_infos'				=> $title_infos,
			'infos'						=> $infos,
			'empty_infos'				=> $empty_infos,
			'title_social_links'		=> $title_social_links,
			'empty_social_links'		=> $empty_social_links,
			'social_links'				=> $social_links,
			'title_description'			=> $title_description,
			'description'				=> $description,						
			'title_concerts'			=> $title_concerts,			
			'list_concerts'				=> $list_concerts,
			'nb_concerts'				=> $nb_concerts,
			'title_sounds'				=> $title_sounds,
			'sound'						=> $sound,	
			'title_soundcloud'			=> $title_soundcloud,
			'sc_sounds'					=> $sc_sounds,			
			'title_videos'				=> $title_videos,			
			'videos'					=> $videos,			
			'title_photos'				=> $title_photos, 
			'albums_photos'				=> $albums_photos,									
			'photos'					=> $photos,						
			'title_in_photos'			=> $title_in_photos,
			'title_fl_photos'			=> $title_fl_photos,
			'list_events'				=> $list_events,
			'title_events'				=> $title_events,
			'nb_events'					=> $nb_events,
			'stage_microphone' 			=> $user_page['microphone'],
			'stage_size'				=> $user_page['stage_size'],
			'room_size'					=> $user_page['room_size'],
			'stage_speakers'			=> $user_page['speakers'],
			'stage_amplification'		=> $user_page['amplification'],
			'stage_lights'				=> $user_page['lights'],
			'stage_other'				=> $user_page['other'],
			'stage_noise'				=> $user_page['noise'],
					
			'title_equipment'			=> $title_equipement,
			'equipment'					=> $equipment,
			'lati'						=> $user_page['lati'],
			'longi'						=> $user_page['longi'],
					
		);
		
		$this->footer['scripts'] = array(
			'js/swfupload/swfupload.js',
			'js/swfupload/jquery.swfupload.js',
			'js/jplayer/jquery.jplayer.min.js',
			'js/jplayer/jplayer.playlist.min.js',
			'js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
			'js/fancybox/source/jquery.fancybox.pack.js',
			'js/fancybox/source/helpers/jquery.fancybox-buttons.js',
			'js/fancybox/source/helpers/jquery.fancybox-media.js',
			'js/fancybox/source/helpers/jquery.fancybox-thumbs.js',
			'js/jcrop/jquery.Jcrop.min.js',
			'js/media.js',
			'js/sound.js',
			'js/video.js',
			'js/photo.js',
			'js/page.js',
			'js/main-page.js'
		);
		
		
		$this->load->view('_header',$this->header);
		$this->load->view('page/index', $data);
		//$this->load->view('sidebar');
		$this->load->view('_footer', $this->footer);
	}

	function audio($id = 1){
		$this->load->view('page/audio', $data);
	}
	
	
	private function _get_data($json_url='',$array = false){
		$json_data = file_get_contents($json_url);
		return json_decode($json_data, $array);		
	}	
}

