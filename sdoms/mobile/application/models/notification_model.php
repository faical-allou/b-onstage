<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function add($user_id, $text, $priority=3){
		if($this->db->set('user_id', $user_id)
					->set('description', $text)
					->set('priority', $priority)
					->set('stamp', 'NOW()', FALSE)
					->insert('notifications'))
			return true;
		else
			return false;
	}
}	