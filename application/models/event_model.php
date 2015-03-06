<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	
	

	public function add($event){
		$status = ($this->db->insert('events', $event)) ? true : false ;

		return array('status' => $status);
	}

	
	
	
	public function update($event){

		$status = ($this->db->where('id',$event['id'])->update('events', $event)) ? true : false;

		return array('status' => $status);
	}

	
	
	
	public function get($event_id){
		$event = $this->db->select('events.*, musical_genres.name as musical_genre')
						->from('events,musical_genres')
						->where('musical_genres.id = events.genre_id', NULL, false)
						->where('events.id', $event_id)
						->get()
						->row_array();
		return $event;
	}
	
	
	
	
	public function get_by_id($event_id){
		$event = $this->db->select('events.*')
						->from('events')
						->where('id', $event_id)
						->get()
						->row_array();
		return $event;	
	}	
	
	
	public function get_all($status='', $date_from='', $date_to='', $city='', $user_id='',$per_page=25, $page = 1){
		$start = ($page-1) * $per_page;
		
		$this->db->start_cache();
		$this->db->select('events.*,
					stage.username as stage_username, stage.company as stage_company, stage.avatar as stage_avatar,
					stage.state as stage_state, stage.city as stage_city, stage.country as stage_country,stage.web_address as stage_web_address,
					stage.website as stage_website, stage.facebook as stage_facebook, stage.twitter as stage_twitter, stage.google_plus as stage_google_plus, stage.myspace as stage_myspace')
					->from('events, users as stage')
					->where('events.stage_id = stage.id', NULL, false)
					->where('date_start >=', $date_from)
					->where('date_start <=', $date_to)					
					->like('events.stage_id',$user_id)
					->order_by('date_start', 'asc')
					->limit($per_page, $start);		
		$this->db->stop_cache();		
		
		if($city)
			$this->db->where_in('stage.city',$city );
		
		if($status == 'open'){			
			$this->db->where_in('events.status', array('open', 'pending'));										
			$events = $this->db->get()->result_array();
		}
		if($status == 'close'){		
			$this->db->select('artist.username as artist_username, artist.company as artist_company, artist.avatar as artist_avatar,artist.cover as artist_cover,
							artist.web_address as artist_web_address, artist.country as artist_country, artist.city as artist_city, artist.avatar as artist_avatar');
			$this->db->from('users as artist');	
			$this->db->where('artist_id=artist.id', NULL, false);			
			$this->db->where('events.status', 'close');		
			$events = $this->db->get()->result_array();
		}
		$this->db->flush_cache();	
		
		//add reservation list of artist id
		if($status == 'open'){
			foreach ($events as $key => $event){
				$events[$key]['reservations_artist_id'] = array();
				$query = $this->db->select('reservations.artist_id')->from('reservations')->where('reservations.event_id', $event['id'])->get();
				foreach($query->result_array() as $row)
					$events[$key]['reservations_artist_id'][] = $row['artist_id'];
			}	
		}		
		
		// Add music genres to the event
		//Determine row name depending on lang loaded
		if($this->session->userdata('lang_loaded') == "french"){$rowname = '';}
		else {
			foreach($this->config->item('lang_counts') as $key => $value){
				if($this->session->userdata('lang_loaded') == $value["name"]){
					$rowname = '_'.$value["id"];
				}
			}
		}
		foreach ($events as $key => $event) {
			$events[$key]['genres'] = array();
			$genres_ids = explode('|', $event['genre_id']);
			$query = $this->db->select('name'.$rowname)
								->from('musical_genres')
								->where_in('id', $genres_ids)
								->get();
			foreach ($query->result_array() as $row)
				array_push($events[$key]['genres'],ucfirst($row['name'.$rowname]));
		}
		
		return $events;
	}	
	
	
	
	
	
	public function filter($status='', $date_from='', $date_to='', $city='', $user_id='',$payment_type='', $genres='', $schedule_min='', $schedule_max='', $reservation_min='', $reservation_max='', $entry_min='', $entry_max='', $per_page=25, $page = 1, $order_by=''){
		$start = ($page-1) * $per_page;		
		$this->db->start_cache();
		$this->db->select('events.*,					 
					stage.id as stage_id, stage.username as stage_username, stage.company as stage_company, stage.avatar as stage_avatar,
					stage.state as stage_state, stage.city as stage_city, stage.country as stage_country,stage.web_address as stage_web_address,
					stage.website as stage_website, stage.facebook as stage_facebook, stage.twitter as stage_twitter, stage.google_plus as stage_google_plus, stage.myspace as stage_myspace')
					->from('events, users as stage')
					->where('events.stage_id = stage.id', NULL, false)
					->where('date_start >=', $date_from)
					->where('date_start <=', $date_to)
					->where('DATE_FORMAT(date_start, "%T") >=', $schedule_min)
					->where('DATE_FORMAT(date_end, "%T") <=', $schedule_max)
					->where('reservation >=', $reservation_min)
					->where('reservation <=', $reservation_max)				
					->where('entry >=', $entry_min)
					->where('entry <=', $entry_max)					
					->like('stage_id',$user_id)
					->order_by($order_by, 'asc')
					->limit($per_page, $start);
		
		if($genres){
			$this->db->where_in('genre_id', explode('|',$genres));				
		}
		
		if($city)
			$this->db->where_in('stage.city', $city);
		
		$this->db->stop_cache();				
		
		if($status == 'open'){
			
			if($payment_type['payment_amount'])
			$this->db->where('payment_amount >', 0);				
			
			if($payment_type['percent_drink'])
				$this->db->where('percent_drink >', 0);			
				
			if($payment_type['percent_entry'])
				$this->db->where('percent_entry >', 0);						
			
			if($payment_type['refund_fees'])
				$this->db->where('refund_fees', 1);			
				
			if($payment_type['remuneration'])
				$this->db->where('payment_type', 2);
		
			$this->db->where_in('events.status', array('open', 'pending'));					
			$events = $this->db->get()->result_array();
		}
		
		if($status == 'close'){		
			$this->db->select('artist.username as artist_username, artist.company as artist_company, artist.avatar as artist_avatar, artist.cover as artist_cover,
							artist.web_address as artist_web_address, artist.country as artist_country, artist.city as artist_city, artist.avatar as artist_avatar');
			$this->db->from('users as artist');		
			$this->db->where('artist_id=artist.id', NULL, false);						
			$this->db->where('events.status', 'close');		
			$events = $this->db->get()->result_array();
		}
		$this->db->flush_cache();					
		
		//add reservation list of artist id
		if($status == 'open'){
			foreach ($events as $key => $event){
				$events[$key]['reservations_artist_id'] = array();
				$query = $this->db->select('reservations.artist_id')->from('reservations')->where('reservations.event_id', $event['id'])->get();
				foreach($query->result_array() as $row)
					$events[$key]['reservations_artist_id'][] = $row['artist_id'];
			}	
		}		
		
		// Add music genres to the event
		foreach ($events as $key => $event) {
			$events[$key]['genres'] = array();
			$genres_ids = explode('|', $event['genre_id']);
			$query = $this->db->select('name')
								->from('musical_genres')
								->where_in('id', $genres_ids)
								->get();
			foreach ($query->result_array() as $row)
				$events[$key]['genres'][] = ucfirst($row['name']);
		}
		return $events;
	}
	
	
	
	
	
	public function get_filter_infos($date_from, $date_to){
		$min = $this->db->select_min('reservation')
						->select_min('entry')
						->from('events')
						->where('date_start >=', $date_from)
						->where('date_start <=', $date_to)
						->get()
						->row_array();
		
		$max = $this->db->select_max('reservation')
						->select_max('entry')	
						->from('events')
						->where('date_start >=', $date_from)
						->where('date_start <=', $date_to)
						->get()
						->row_array();
		return array($min, $max);				
	}
	
	
	
	
	
	public function count_events($status, $date_from='', $date_to=''){
		$this->db->from('events')
				->where('date_start >=', $date_from)
				->where('date_start <=', $date_to)
				->where_in('status', $status);
		return $this->db->count_all_results();			
	}
	
	
	
	
	
	
	public function get_events($date_from='', $date_to='', $stage_id='', $limit=50){

		$this->db->start_cache();
		
		if(!empty($stage_id)){
			$this->db->from('events')->where('stage_id', $stage_id);
		}
			
		if(!empty($date_from)){
			$this->db->where('date_start >=', $date_from)->order_by('date_start', 'asc');									
		}
		
		if(!empty($date_to)){
			$this->db->where('date_start <=', $date_to)->order_by('date_start', 'asc');
		}		
		
		$this->db->stop_cache();
		
		$events_open = $this->db->where('status', 'open')->get()->result_array();
		$events_pending = $this->db->where('status', 'pending')->get()->result_array();
		$events_accepted = $this->db->where('status', 'accepted')->get()->result_array();
		$events_close = $this->db->where('status', 'close')->get()->result_array();		
		
		$this->db->flush_cache();
		return array($events_open, $events_pending, $events_accepted, $events_close);
	}
	
	
	
	public function get_by_user_id($user_id){

		return $this->db->select('events.*')
					->from('events')
					->like('stage_id',$user_id)
					->order_by('date_start','asc')
					->get()
					->result_array();
	}	
	
	public function delete($event_id, $stage_id, $status){
		try{
			//on verifie qu'il s'agit bien de l'utilisateur			
			$result = $this->db->select('stage_id')->from('events')->where('id', $event_id)->get()->row_array();
			if($stage_id != $result['stage_id'])
				throw new Exception('ACCESS_DENIED');
			
			switch($status){
				case 'open' :			
					if(!$this->db->delete('events', array('id' => $event_id)))
						throw new Exception('ERROR');
					break;
				default: break;
			}
			
			return json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_calendar_event_del_success")));	
		
		}catch (Exception $e) {
			switch($e->getMessage()){
				case 'ERROR' :
					return json_encode(array('status' => 'ERROR', 'msg' => lang("error_retry")));	
					break;
				case 'ACCESS_DENIED' :
					return json_encode(array('status' => 'ERROR', 'msg' => lang("users_calendar_event_del_error1")));	
					break;	
				default : break;
			}
		}		
		
	
	
	}
	
	
	public function get_stage_cities($city = ''){
	
		//no limit
		$this->db->select('city, COUNT( users.id ) AS nb')
					->from('users, groups, users_groups, events')
					->where('users.id=user_id', NULL, false)
					->where('groups.id=group_id', NULL, false)
					->where('events.stage_id = users.id', NULL, false)
					->where('groups.name', 'stage')
					->group_by('city')
					->order_by('city');
							
		if($city)
			$this->db->like('city', $city, 'after');
			
		return $this->db->get()->result_array();
	}
		
	
	public function get_stage_countries($country = ''){
	
		//no limit
		$this->db->select('country, COUNT( users.id ) AS nb')
					->from('users, groups, users_groups, events')
					->where('users.id=user_id', NULL, false)
					->where('groups.id=group_id', NULL, false)
					->where('events.stage_id = users.id', NULL, false)
					->where('groups.name', 'stage')
					->group_by('country')
					->order_by('nb','desc');
					
		if($country)
			$this->db->like('country', $country, 'after');
			
		return $this->db->get()->result_array();
	}
	
	public function get_stage_cities_by_countries($city_by_country = ''){
	
		//no limit
		$this->db->select('city,country, COUNT( users.id ) AS nb')
					->from('users, groups, users_groups, events')
					->where('users.id=user_id', NULL, false)
					->where('groups.id=group_id', NULL, false)
					->where('events.stage_id = users.id', NULL, false)
					->where('groups.name', 'stage')
					->group_by('city')
					->order_by('nb','desc');
					
		if($city_by_country)
			$this->db->like('country', $city_by_country, 'after');
			
		return $this->db->get()->result_array();
	}
	
	
	
	
	public function populate_events($nbrows){
		//$stages = array(77, 94, 99);
		$stages = array(77,95);
		$artist = array(0);
		$status = 'open';
		//$status = 'close';
		$titles = array(
			"Ruby Tour",
			"Street Band",
			"Stone Roses",
			"The Wall Live",
			"Stereophonics",
			"Couting Crows",
			"The House of Love",
			"Rudimental",
			"The Wanted",
			"Incognito",
			"Cowboy Junkies",
			"Stealing Sheep",
			"Ezio",
			"Hawkwind",
			"Rascal Flats"
		);
		
		for($i=0; $i<$nbrows; $i++){
			
			$rand_genre = rand(1,9);
			$rand_reservation = rand(50,200);
			$rand_payment_amount = rand(0,100);
			$payment_type = ($rand_payment_amount == 0) ? 2 : 3;
			$rand_entry = rand(0,50);
			$rand_percent_entry = rand(0, 20);
			
			$this->db->set('stage_id', $stages[array_rand($stages)])
					->set('artist_id', $artist[array_rand($artist)])
					->set('title', $titles[array_rand($titles)])
					->set('description', $titles[array_rand($titles)].' '.$titles[array_rand($titles)].' '.$titles[array_rand($titles)].' '.$titles[array_rand($titles)].' '.$titles[array_rand($titles)])
					->set('date_start', "NOW() + INTERVAL FLOOR(RAND() * 365) DAY", FALSE)
					->set('date_end', "date_start", FALSE)
					->set('status', $status)
					->set('genre_id', $rand_genre, FALSE)
					->set('reservation', $rand_reservation, FALSE)
					->set('payment_type', $payment_type, FALSE)
					->set('payment_amount', $rand_payment_amount, FALSE)
					->set('percent_entry', $rand_percent_entry, FALSE)
					->set('entry', $rand_entry, FALSE)
					->insert('events');
		}
	}
}