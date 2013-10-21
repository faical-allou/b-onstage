<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**********GET ALL STAGES**********/
	/*public function get($stage_id=''){	
		
		$this->db			
			->from('users, groups, users_groups')
			->where('users.id = users_groups.user_id', NULL, false)					
			->where('groups.id = users_groups.group_id', NULL, false)
			->where('groups.name', 'stage');
		
		if($stage_id)
			$this->db->where('id', $stage_id);
		
		$stages = $this->db->get()->result_array();

		return $stages	;
	}*/
	
	public function duplicate_event(){	
		
		$event_id	= $this->input->post('event-id');
		$date_start	= $this->input->post('date-start');
		$date_end	= $this->input->post('date-end');
		$event_days	= $this->input->post('event-days');
		
		$event = $this->db	->from('events')
							->where('id', $event_id)
							->get()->row_array();
		
		if( ! is_array($event))
			return 0;
		$time_start = substr($event['date_start'], -9);
		$time_end = substr($event['date_end'], -9);
		
		$new_event = $event;
		$new_date_start = $date_start . $time_start;
		$new_date_end = $date_start . $time_end;
		$new_event['id'] = '';
		
		$i=0;
		while ($new_date_start <= $date_end . $time_start) {
			if(in_array(date('N', strtotime($new_date_end)), $event_days)){
				$i++;
				$new_event['date_start'] = $new_date_start;
				$new_event['date_end'] = $new_date_end;
				//echo '<pre>'.print_r($new_event, 1).'</pre>'; //insert
				$this->db->insert('events', $new_event);
			}
			$new_date_start = date('Y-m-d H:i:s', strtotime($new_date_start . ' + 1 day'));		
			$new_date_end = date('Y-m-d H:i:s', strtotime($new_date_end . ' + 1 day'));
			if($i == 2000)
				break;
		}
		return $i;
	}
	
	
}	