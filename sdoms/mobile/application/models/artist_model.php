<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artist_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/**********GET ALL STAGES**********/
	public function get($artist_id=''){

		$this->db
			->from('users, groups, users_groups')
			->where('users.id = users_groups.user_id', NULL, false)
			->where('groups.id = users_groups.group_id', NULL, false)
			->where('groups.name', 'artist');

		if($artist_id)
			$this->db->where('id', $artist_id);

		$stages = $this->db->get()->result_array();

		return $stages	;
	}


}