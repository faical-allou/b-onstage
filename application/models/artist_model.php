<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artist_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_all($name='',$musical_genre='', $location='',$per_page = 25, $page = 1){
	
		$start = ($page-1) * $per_page;
		
		$this->db->start_cache();
		//cache artist
		$this->db->select('artist.*')
				->from('users as artist, groups, users_groups')									
				->where('artist.id = users_groups.user_id', NULL, false)					
				->where('groups.id = users_groups.group_id', NULL, false)
				->where('groups.name', 'artist')					
				->like('artist.company', $name, 'after')
				->like('artist.city', $location, 'after')	
				->order_by('artist.created_on', 'desc');
				
		//if musical genre			
		
		$this->db->stop_cache();									
				
		//get nb artists
		$nb_artists = $this->db->count_all_results();
		
		//get artists
		$this->db->limit($per_page, $start);		
		$artists = $this->db->get()->result_array(); 	
		
		$this->db->flush_cache();
		
		//others infos				
		/*foreach($artists as $key => $artist){		
			//get 3 last concerts
			$artists[$key]['concerts'] = array();
			$concerts = $this->db->select('events.*, users.company, users.web_address, users.address, users.city, users.country, users.avatar, users.username')					
					->from('events, users')			
					->where('events.stage_id = users.id', NULL, false)
					->where('events.artist_id', $artist['id'])
					->where('events.status','close')					
					->order_by('events.date_start', 'ASC')
					->limit(3)
					->get()
					->result_array();
			$artists[$key]['concerts'] = $concerts;
			//get 5 members
			/*$artists[$key]['members'] = array();
			$members = $this->db->select('members.*')
					->from('members, users')
					->where('members.user_id = users.id', NULL, false)
					->where('users.id',$artist['id'])
					->limit(5)
					->get()					
					->result_array();		
			$artists[$key]['members'] = $members;			
			//get 10 tracks
			$artist[$key]['tracks'] = array();
			$tracks = $this->db->select('tracks.*')
					->from('tracks, users')
					->where('tracks.user_id = users.id', NULL, false)
					->where('users.id',$artist['id'])
					->limit(5)
					->get()
					->result_array();		
			$artists[$key]['tracks'] = $tracks;
		}*/		
		
		return array('nb_artists' => $nb_artists, 'artists' => $artists);	
	}
	
	public function get_feature($name='',$musical_genre='', $location='',$per_page = 25, $page = 1){
	
		$start = ($page-1) * $per_page;
	
		$this->db->start_cache();
		//cache artist
		$this->db->select('artist.*')
		->from('users as artist, groups, users_groups')
		->where('artist.id = users_groups.user_id', NULL, false)
		->where('groups.id = users_groups.group_id', NULL, false)
		->where('feature', 1)
		->where('groups.name', 'artist')
		->like('artist.company', $name, 'after')
		->like('artist.city', $location, 'after')
		->order_by('artist.created_on', 'desc');
	
		//if musical genre
	
		$this->db->stop_cache();
	
		//get nb artists
		$nb_artists = $this->db->count_all_results();
	
		//get artists
		$this->db->limit($per_page, $start);
		$artists = $this->db->get()->result_array();
	
		$this->db->flush_cache();

	
			return array('nb_artists' => $nb_artists, 'artists' => $artists);
			}
	
	
	public function get_location($location = ''){
		$this->db->select('country, city, COUNT( users.id ) AS nb')
					->from('users, groups, users_groups')
					->where('users.id = users_groups.user_id', NULL, false)
					->where('groups.id = users_groups.group_id', NULL, false)
					->where('groups.name', 'artist')		
					->like('city', $location, 'after')					
					->order_by('nb','desc')
					->limit(10);
			
		return $this->db->get()->result_array();
	}
	
	
	public function get_name($name = ''){
		$this->db->select('company as name')
					->from('users, groups, users_groups')
					->where('users.id=user_id', NULL, false)
					->where('groups.id=group_id', NULL, false)
					->where('groups.name', 'artist')
					->like('company', $name, 'after')
					->order_by('name')	
					->limit(10);		
		
		return $this->db->get()->result_array();		
	}
}