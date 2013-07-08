<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model
{
	var $table;
	
	public function __construct(){
		parent::__construct();
		$this->load->database();

	}
	
	public function get($user_id){
	
		$this->db->select('name, description')		
				 ->from('groups')				 
				 ->join('users_groups', 'users_groups.group_id = groups.id')
				 ->where('users_groups.user_id', $user_id);

		$query = $this->db->get();
		return $query->first_row('array');
	}
}