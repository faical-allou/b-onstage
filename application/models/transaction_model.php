<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();		
	}
		
	public function init($data){
		if($this->db->insert('transactions', $data))
			return true;
		else
			return false;
	}
	
	public function update($data){		
		if($this->db->where('token', $data['token'])->update('transactions', $data))
			return true;
		else
			return false;
	}
	
	public function cancel($event_id){
		if($this->db->delete('transactions', array('event_id' => $event_id)))
			return true;
		else 
			return false;
	}
}	