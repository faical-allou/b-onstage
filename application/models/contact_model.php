<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model
{
	var $table;
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = 'contacts';
	}
	
	public function add($user_id, $user_contact){
		$data = array(
			'user_id' => $user_id,
			'user_contact' => $user_contact
		);
		$doublon = $this->db
					->from($this->table)
					->where('user_id', $user_id)
					->where('user_contact', $user_contact)
					->count_all_results();			
		
		if (($doublon == 0) && ($this->db->insert($this->table, $data)))
			return array('status' => true, 'msg' => lang("users_contact_add_success"));
		else if ($doublon > 0)
			return array('status' => false, 'msg' => lang("users_contact_add_error1"));
		else
			return array('status' => false, 'msg' => lang("error_retry"));	
		
	}
	
	public function get_all($user_id){
		
		$contacts = $this->db
					->select('contacts.id as contact_id, user_contact, users.*')
					->from('contacts, users')
					->where('users.id = contacts.user_contact',NULL, false)
					->where('contacts.user_id', $user_id)					
					->get()
					->result_array();
		
		return $contacts;
	}
	
	public function delete($contact_id){
		if($this->db->delete($this->table, array('id' => $contact_id)))
			return array('status' => 'SUCCESS', 'msg' => lang("users_contact_del_success"));
		else	
			return array('status' => 'SUCCESS', 'msg' => lang("error_retry"));
	}
}