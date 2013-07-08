<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function add($user_id, $text, $link, $avatar, $priority=3){
		if($this->db->set('user_id', $user_id)
					->set('description', $text)
					->set('link', $link)
					->set('avatar', $avatar)
					->set('priority', $priority)
					->set('stamp', 'NOW()', FALSE)
					->insert('notifications'))
			return true;
		else
			return false;
	}
	
	
	
	public function get($user_id, $limit=5, $start=0){
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

}