<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get($user_id){

		$user = $this->db->from('users')->where('id',$user_id)->get()->row_array();
		return $user;
	}

	public function add_notification($user_id, $text, $priority=3){
		if($this->db->set('user_id', $user_id)
					->set('description', $text)
					->set('priority', $priority)
					->set('stamp', 'NOW()', FALSE)
					->insert('notifications'))
			return true;
		else
			return false;
	}

	public function read_notifications($user_id){
		$this->db	->set('read', 1)
					->where('user_id',$user_id)
					->update('notifications');
	}

	public function get_notifications($user_id, $limit=10, $start=0){
		$notifications = $this->db->from('notifications')
						->where('user_id',$user_id)
						->limit($limit, $start)
						->order_by('read asc, stamp desc, priority asc')
						->get()->result_array();
		$total = $this->db->from('notifications')
						->where('user_id',$user_id)
						->get()->num_rows();

		$topPriority= 0;
		$nbUnread	= 0;
		$hasmore	= $total - ($start + count($notifications));

		foreach ($notifications as $notification) {
			if($notification['read'])
				continue;
			$nbUnread++;
			if($notification['priority'] > $topPriority){
				$topPriority = $notification['priority'];
			}
		}

		return array(
			'topPriority'	=> $topPriority,
			'nbUnread'		=> $nbUnread,
			'notifications' => $notifications,
			'hasmore'		=> $hasmore
		);
	}
	
	public function send_email($from,$from_name,$to, $cc, $subject, $msg){	
		$this->email->from($from,$from_name);
		$this->email->to($to);
		$this->email->cc($cc);
		$this->email->subject($subject);
		$this->email->message($msg);
		if($this->email->send())
			return true;
		else
			return false;
	}
	
	
	
}