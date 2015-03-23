<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Musical_genre_model extends CI_Model{	
	public function __construct(){
		parent::__construct();
		$this->load->database();		
	}
	
	public function get($show_sub_genre = 0, $separator = ''){	
		
		
		
		if($show_sub_genre){
		
		
		
		} else {
			//return array of all genres
			$genres = $this->db->from('musical_genres')->order_by('id')->get()->result_array();					
			return $genres;	
		}
		if($separator){
		}		
		
		return $genres;	
			
	}	
}