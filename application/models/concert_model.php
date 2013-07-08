<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Concert_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function get_last($limit = 5){
	
		$concerts = $this->db->select(
			'events.*, 
			stage.company as stage_company, stage.city as stage_city, stage.country as stage_country, stage.web_address as stage_web_address, stage.username as stage_username,stage.avatar as stage_avatar,
			artist.country as artist_country, artist.web_address as artist_web_address, artist.company as artist_company, artist.username as artist_username, artist.avatar as artist_avatar')
			->from('events, users as stage, users as artist')
			->where('events.stage_id = stage.id', NULL, FALSE)
			->where('events.artist_id = artist.id', NULL, FALSE)
			->where('events.date_start >',date('c'))
			->where('events.status', 'close')
			->limit($limit)
			->order_by('events.date_start', 'ASC')
			->get()
			->result_array();
			
		return $concerts;	
	}
	
	
	public function get($event_id){
	
		$concert = $this->db->select('
			events.*,
			stage.company as stage_company, stage.avatar as stage_avatar, stage.city as stage_city, stage.address as stage_address, stage.zip as stage_zip, stage.country as stage_country, stage.web_address as stage_web_address, stage.username as stage_username,
			artist.avatar as artist_avatar, artist.city as artist_city, artist.country as artist_country, artist.web_address as artist_web_address, artist.company as artist_company, artist.username as artist_username, artist.website as artist_website, artist.description as artist_description, artist.facebook as artist_facebook, artist.twitter as artist_twitter, artist.myspace as artist_myspace, artist.google_plus as artist_google_plus')
			->from('events, users as stage, users as artist')
			->where('events.stage_id = stage.id', NULL, FALSE)
			->where('events.artist_id = artist.id', NULL, FALSE)
			->where('events.id', $event_id)
			->get()
			->row_array();
		
		//get musical genre	
		$concert['genres'] = array();
		$genres_ids = explode('|', $concert['genre_id']);
		$query = $this->db->select('name')
							->from('musical_genres')
							->where_in('id', $genres_ids)
							->get();
		foreach ($query->result_array() as $row)
			array_push($concert['genres'], ucfirst($row['name']));			
		
		
		//get artist members
		$concert['members'] = array();
		$query = $this->db->select('*')->from('members')->where('user_id', $concert['artist_id'])->get();
		foreach($query->result_array() as $row){
			array_push($concert['members'], $row);
		}
		
		//get artist tracks
		$concert['tracks'] = array();
		$query = $this->db->select('*')->from('tracks')->where('user_id', $concert['artist_id'])->limit(5)->get();
		foreach($query->result_array() as $row){
			array_push($concert['tracks'], $row);
		}
		
		return $concert;
	}
	
	public function get_by_user_id($user_id, $user_group){
		
		$this->db->start_cache();
		
		$this->db->select('events.*,
			users.company, users.web_address, users.address, users.city, users.country, users.avatar, users.cover, users.username')
			->from('events, users')			
			->where('events.status','close')
			->where('events.date_start >',date('c'))
			->order_by('events.date_start', 'ASC');			
			
		$this->db->stop_cache();
		
		switch($user_group){
			case 'artist':
				$concerts = $this->db->where('events.stage_id = users.id', NULL, false)
					->where('events.artist_id', $user_id)
					->get()
					->result_array();			
			break;
			case 'stage' :
				$concerts = $this->db->where('events.artist_id = users.id', NULL, false)
					->where('events.stage_id', $user_id)
					->get()
					->result_array();
			break;
			default : break;		
		}
			
		$this->db->flush_cache();	
			
		return $concerts;
	}
	

	
}	