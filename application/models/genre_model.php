<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genre_model extends CI_Model
{
	var $table;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = 'musical_genres';
	}
	
	public function get_by_id($genre_id){		
		return $this->db->from($this->table)->where('id', $genre_id)->get()->row_array();		
	}
	
	public function get_all(){
		$result = new ArrayObject();		
		foreach( $this->db->get($this->table)->result_array() as $row)
			$result->offsetSet($row['id'], $row['name']);
			
		return $result;
	}
}