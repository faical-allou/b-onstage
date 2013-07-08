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
			return array('status' => true, 'msg' => 'Contact ajouté avec succès');
		else if ($doublon > 0)
			return array('status' => false, 'msg' => 'Ce contact est déjà présent dans vos contacts');
		else
			return array('status' => false, 'msg' => 'Une erreur s\'est produite, veuillez réessayer');	
		
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
			return array('status' => 'SUCCESS', 'msg' => 'Contact supprimé avec succès');
		else	
			return array('status' => 'SUCCESS', 'msg' => 'Une erreur s\'est produite, veuillez réessayer plus tard.');
	}
}