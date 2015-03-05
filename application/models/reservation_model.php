<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();		
	}
		
	public function count($event_id=''){
		$count_reservations = $this->db->from('reservations')						
						->where('event_id', $event_id)
						->get()
						->num_rows();
		return $count_reservations;				
	
	}	
	
	public function delete($reservation_id){
		return $this->db->delete('reservations', array('id' => $reservation_id)) ? true : false; 
	}
	
	public function get($reservation_id){
		$reservation = $this->db->select('*')
						->from('reservations')
						->where('id',$reservation_id)						
						->get()
						->row_array();						
		return $reservation;				
	}
	
	public function get_by_event_id($event_id=''){
		$reservations = $this->db->select('*')
						->from('reservations')
						->where('event_id',$event_id)						
						->get()
						->result_array();						
		return $reservations;				
	}
	
	public function get_by_artist_id($artist_id){
		$reservations = $this->db
					->select('reservations.*,
					stage.company as stage_company, stage.city as stage_city, stage.country as stage_country, stage.web_address as stage_web_address, stage.username as stage_username, stage.avatar as stage_avatar,
					events.id as event_id, events.artist_id as event_artist_id, events.date_start as start, events.date_end as end, events.status, events.reservation, events.genre_id, events.date_modified,
					events.payment_type, events.payment_amount, events.percent_drink, events.percent_entry, events.refund_fees, events.entry')
					->from('reservations, users as stage, events')
					->where('reservations.event_id = events.id', NULL, FALSE)
					->where('events.stage_id = stage.id', NULL, FALSE)
					->where('reservations.artist_id', $artist_id)					
					->order_by('events.date_start', 'desc')					
					->get()
					->result_array();
						
		return $reservations;				
		/*$pending_reservations = array();
		$accepted_reservations = array();
		$close_reservations = array();
		
		foreach($reservations as $reservation){		
			switch($reservation['status']){
				case 'pending' : array_push($pending_reservations, $reservation);break;
				case 'accepted' :
					//si artist_id = artist_event_id, sinon gardé status pending
					if($reservation['artist_id'] == $reservation['event_artist_id'])
						array_push($accepted_reservations, $reservation);
					else
						array_push($pending_reservations, $reservation);
					break;
				case 'close' : array_push($close_reservations, $reservation);break;
				default : break;
			}	
		}		
		return array($pending_reservations, $accepted_reservations, $close_reservations);*/
	}
	
	public function request($event_id){
		
		$event = $this->db->select('events.*, stage.company as stage_company')
						->from('events, users as stage')
						->where('events.stage_id = stage.id', NULL, FALSE)
						->where('events.id', $event_id)
						->get()
						->row_array();	
		
		$event['genres'] = array();
		$genres_ids = explode('|', $event['genre_id']);
		//Determine row name depending on lang loaded
		if($this->session->userdata('lang_loaded') == "french"){$rowname = '';}
		else {
			foreach($this->config->item('lang_counts') as $key => $value){
				if($this->session->userdata('lang_loaded') == $value["name"]){
					$rowname = '_'.$value["id"];
				}
			}
		}
		$query = $this->db->select('name'.$rowname)
							->from('musical_genres')
							->where_in('id', $genres_ids)
							->get();
		foreach ($query->result_array() as $row)
			array_push($event['genres'],ucfirst($row['name'.$rowname]));
		
		$event['payment'] = array();
		switch($event['payment_type']){
			case 1 : 
				array_push($event['payment'],lang("payment_notset"));
				break;
			case 2 :
				array_push($event['payment'],lang("users_calendar_create_non_renum"));
				break;
			case 3 :
				if($event['payment_amount'] > 0)
					array_push($event['payment'], lang("users_calendar_create_cachet").' '.round($event['payment_amount'],2).' €');
				if($event['percent_drink'] > 0)
					array_push($event['payment'], round($event['percent_drink'],2).'€ '.lang("users_calendar_create_conso"));
				if($event['percent_entry'] > 0)
					array_push($event['payment'], round($event['percent_entry'],2).'% '.lang("users_calendar_create_tickets"));
				if($event['refund_fees'] > 0)
					array_push($event['payment'], lang("users_calendar_create_remb"));
				break;
			default : break;
		}			
		
		return $event;	
		
	}
	
	
	public function send($event, $stage, $artist){		
		//add reservation request
		$this->db->set('event_id', $event['id']);
		$this->db->set('stage_id', $stage['id']);
		$this->db->set('artist_id', $artist['id']);
		$this->db->set('date_created', date('c'));		
		if($this->db->insert('reservations')){			
			$reservation_id = $this->db->insert_id();					
			$this->db->where('id', $event['id']);
			if($this->db->update('events', array('status'	=> 'pending')))
				return $reservation_id;
			else
				return null;
		}else
			return null;		
	}
	
	public function cancel($reservation_id, $event_id, $event_status, $reservation_artist_id, $event_artist_id){	
		try {		
			//delete reservation		
			switch($event_status){				
				case 'pending' :
					//cas normal on supprime
					if(!$this->db->delete('reservations', array('id' => $reservation_id)))
						throw new Exception('ERROR');				
					//modification de l'evenement					
					$nb_reservations = $this->db->from('reservations')->where('event_id', $event_id)->count_all_results();
					$status = ($nb_reservations == 0) ? 'open' : 'pending';
					$this->db->set('status',$status);
					$this->db->set('date_modified', date('c'));	
					
				break;
				case 'accepted' :
					//cas normal on supprime
					if(!$this->db->delete('reservations', array('id' => $reservation_id)))
						throw new Exception('ERROR');				
					//modification de l'evenement					
					$nb_reservations = $this->db->from('reservations')->where('event_id', $event_id)->count_all_results();
					$status = ($nb_reservations == 0) ? 'open' : 'pending';
					$this->db->set('status',$status);
					$this->db->set('date_modified', date('c'));
					$this->db->set('artist_id', 0);
				break;
				case 'close' :
					if(!$this->db->delete('reservations', array('id' => $reservation_id)))
						throw new Exception('ERROR');
					
					/*$date_time_start = new DateTime($date_start);
					$date_time_now = new DateTime('now');
					$interval = $date_time_now->diff($date_time_start);
					$days = $interval->format('%a');
					if($days < 2)*/
					
					//modification de l'evenement					
					$nb_reservations = $this->db->from('reservations')->where('event_id', $event_id)->count_all_results();
					$status = ($nb_reservations == 0) ? 'open' : 'pending';
					$this->db->set('status',$status);
					$this->db->set('date_modified', date('c'));
					$this->db->set('artist_id', 0);				
				break;
				default : break;
			}	
		
			//update event
			$this->db->where('id', $event_id);
			if(!$this->db->update('events'))
				throw new Exception('ERROR');
				
			return true;	
		}catch (Exception $e) {
			switch($e->getMessage()){
				case 'ERROR' : return false;break;
				default : break;
			}
		}		
	}	
	
	public function warning_msg($event_status, $event_artist_id, $reservation_artist_id, $date_start){
		switch($event_status){
			case 'pending' :
				$msg = lang("users_rese_cancel_conf");
				break;
			case 'accepted' : 
				//si event_artist_id = reservation_artist_id
				if($event_artist_id == $reservation_artist_id)					
					$msg = lang("users_rese_cancel_txt1");
				else
					$msg = lang("users_rese_cancel_conf");					
				break;
			case 'close' : 
				$date_time_start = new DateTime($date_start);
				$date_time_now = new DateTime('now');
				$interval = $date_time_now->diff($date_time_start);
				$days = $interval->format('%a');					
				
				//si annule avant 2 semaines ou 15 jours
				if($days > 15)
					$msg = lang("users_rese_cancel_txt2");
				else if(($days <= 15) && ($days >= 2))
					$msg = lang("users_rese_cancel_txt3");
				else if($days < 2)
					$msg = lang("users_rese_cancel_txt4");								
				break;
			default : break;	
		}
		return $msg;
	}		
	
	public function valid($reservation){		
		$event = array(
			'artist_id'		=> $reservation['artist_id'],
			'status'		=> 'accepted',
			'date_modified'	=> date('c')	
		);
		if($this->db->where('id',$reservation['event_id'])->update('events', $event))
			return true;
		else
			return false;
	}
	
	public function close($event_id){
		$data = array(
			'status'		=> 'close',
			'date_modified'	=> date('c')
		);

		if($this->db->where('id', $event_id)->update('events', $data))	
			return true;
		else
			return false;
	}
	
}