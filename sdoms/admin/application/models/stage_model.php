<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stage_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**********GET ALL STAGES**********/
	public function get($stage_id=''){	
		
		$this->db			
			->from('users, groups, users_groups')
			->where('users.id = users_groups.user_id', NULL, false)					
			->where('groups.id = users_groups.group_id', NULL, false)
			->where('groups.name', 'stage');
		
		if($stage_id)
			$this->db->where('id', $stage_id);
		
		$stages = $this->db->get()->result_array();

		return $stages	;
	}
	
	
}	