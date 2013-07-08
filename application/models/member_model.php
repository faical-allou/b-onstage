<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model
{
	var $table;
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = 'members';
	}
	
	public function add($user_id, $name, $instrument){
		$data = array(
			'user_id' => $user_id,
			'name' => $name,
			'created_on' => time(),
			'instrument' => $instrument
		);

		return ($this->db->insert($this->table, $data)) ? $this->db->insert_id() :false; 
	}
	
	public function delete($member_id){
	
		return ($this->db->delete($this->table, array('id' => $member_id))) ? true : false; 
	}

	public function get_all($user_id){
		$query = $this->db->get_where($this->table, array('user_id' => $user_id));
		return $query->result_array();
	}
}