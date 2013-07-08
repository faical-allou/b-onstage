<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sound_model extends CI_Model
{	
	public function __construct(){
		parent::__construct();
		$this->load->database();

	}
	
	public function get($user_id){		
		$sound = array();
		
		$sound['tracks'] = $this->db->from('tracks')
						->where('user_id', $user_id)
						->get()
						->result_array();
		
		return $sound;	
	}	
}	
