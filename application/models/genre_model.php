<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genre_model extends CI_Model
{
	var $table;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = 'musical_genres';
		$this->load->library('session');
		$this->lang_counts = $this->config->item('lang_counts');
		
	}
	
	public function get_by_id($genre_id){		
		return $this->db->from($this->table)->where('id', $genre_id)->get()->row_array();		
	}
	
	public function get_all(){
		$result = new ArrayObject();		
		//Determine row name depending on lang loaded
			if($this->session->userdata('lang_loaded') == "french"){$rowname = 'name';}
			else {
				foreach($this->lang_counts as $key => $value){
					if($this->session->userdata('lang_loaded') == $value["name"]){
						$rowname = 'name_'.$value["id"];
					}
				}
			}
		foreach( $this->db->get($this->table)->result_array() as $row)
			$result->offsetSet($row['id'], $row[$rowname]);
			
		return $result;
	}
}