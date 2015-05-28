<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_model extends CI_Model
{
	var $table;
	
	public function __construct(){
		parent::__construct();
		$this->load->database();

	}
	
	public function get_all($user_id){
	
		$medias = array();		
		
		/********** SC SOUNDS **********/
		$sc_sounds = $this->db->from('sc_sounds')
						->where('user_id', $user_id)						
						->get()
						->result_array();
		$medias['sc_sounds'] = $sc_sounds;				
	
	
		/********** YT VIDEOS **********/			
		$medias['yt_medias'] = $this->db->from('yt_medias')->where('user_id', $user_id)->get()->result_array();	
	
	
		/********** PI PHOTOS **********/				
		$this->db->select('*')		
			->from('pi_photos')				 					
			->where('user_id', $user_id);	
		$query = $this->db->get();
		$medias['pi_photos'] = $query->result_array();		
		
		return $medias;
	}
		
	/**********SOUND**********/
	function add_track($data){
		try{
			if(!rename('./temp/'.$data['file_name'], '.'.$data['url'])){
				$error = 'ERROR_FILE';
				throw new Exception($error);
			}
			
			if(!$this->db->insert('tracks', $data)){
				$error = 'ERROR_BD';
				throw new Exception($error);
			}			
			
			$metadata = unserialize($data['metadata']);
			$min_duration = floor($metadata['playtime_seconds'] / 60);
				$sec_duration = $metadata['playtime_seconds'] % 60;
				$duration = (($min_duration < 10) ? '0'.$min_duration : $min_duration).':'.(($sec_duration < 10) ? '0'.$sec_duration : $sec_duration);
				
			$add = array(
				'id'		=> $this->db->insert_id(),
				'title'		=> $data['title'],
				'url'		=> $data['url'],
				'duration'  => $duration
			);
			
			return array('status' => true, 'msg' => 'Piste ajouté', 'html' => $this->load->view('sound/tpl_add', $add, true));
			
		}catch(Exception $e){			
			return array('status' => false, 'msg' => $e->getMessage());
		}
	}
	
	function delete_track($data){
		try{
			if(!$this->db->where('id', $data['id'])->delete('tracks')){ 
				$error = 'ERROR_BD';
				throw new Exception($error);
			}			
			
			if(!unlink('.'.$data['url'])){ 
				$error = 'ERROR_FILE';
				throw new Exception($error);
			}			
			
			return array('status' => true, 'msg' => 'Piste supprimé');
			
		}catch(Exception $e){			
			return array('status' => false, 'msg' => $e->getMessage());
		}
	}
	
	/**********SOUNDCLOUD**********/
	function add_sc($user_id,$data){	
		
		try{	
			//insert user 
			$sc_user = $data['sc_user'];
			$insert_data = array('user_id' => $user_id, 'sc_id' => $sc_user['id'], 'sc_user_id' => $sc_user['id'], 'type' => 'user', 'data' => serialize($sc_user), 'visible' => 1);
			if(!$this->_add_sc_user($insert_data)){ 
				$error = 'ERROR_BD';
				throw new Exception($error);
			}
			
			//insert playlists
			$sc_playlists = $data['sc_playlists'];
			foreach($sc_playlists as $sc_playlist){	
				$insert_data = array('user_id' => $user_id, 'sc_id' => $sc_playlist['id'], 'sc_user_id' => $sc_user['id'],'type' => 'playlist', 'data' => serialize($sc_playlist), 'visible' => 1);
				if(!$this->_add_sc_playlist($insert_data)){ 
					$error = 'ERROR_BD';
					throw new Exception($error);
				}	
			}
			
			//insert tracks
			$sc_tracks = $data['sc_tracks'];
			foreach($sc_tracks as $sc_track){
				$insert_data = array('user_id' => $user_id, 'sc_id' => $sc_track['id'], 'sc_user_id' => $sc_user['id'],'type' => 'track', 'data' => serialize($sc_track), 'visible' => 1);
				if(!$this->_add_sc_track($insert_data)){ 
					$error = 'ERROR_BD';
					throw new Exception($error);
				}
			}
			
			return array('status' => true, 'msg' => 'ok');
			
		}catch(Exception $e){			
			return array('status' => false, 'msg' => $e->getMessage());
		}
	}	
	
	function delete_sc($user_id,$sc_user_id){
		$result = ($this->db->where('user_id', $user_id)->where('sc_user_id', $sc_user_id)->delete('sc_sounds')) ? true : false; 
		return array('status' => $result);
	}
	
	function exist_sc($user_id, $sc_id){		
		$exist = ($this->db->from('sc_sounds')->where('user_id', $user_id)->where('sc_id', $sc_id)->where('type','user')->count_all_results() > 0 ) ? true : false;
		return array('exist' => $exist);
	}
	
	function update_visibility_track_sc($track_id, $visible){	
		$result = ($this->db->where('sc_id', $track_id)->update('sc_sounds', array('visible' => $visible))) ? true : false; 
		return array('status' => $result);
	}
	
	//private
	function _add_sc_user($data){
		return ($this->db->insert('sc_sounds',$data)) ? true : false;
	}
	
	function _add_sc_playlist($data){
		return ($this->db->insert('sc_sounds',$data)) ? true : false;
	}
	
	function _add_sc_track($data){
		return ($this->db->insert('sc_sounds',$data)) ? true : false;
	}
	
	/**********PHOTOS**********/
	function get_albums_photos($user_id){		
		
		$albums_photos = $this->db->from('albums_photos')
								->where('user_id', $user_id)									
								->order_by('created_on', 'desc')
								->get()
								->result_array();																		
		return $albums_photos;
		
	}
	
	function get_album_photo($album_id){
	
		$album_photo = $this->db->from('albums_photos')
								->where('id', $album_id)																	
								->get()
								->row_array();																		
		return $album_photo;
	
	}
	
	function get_thumb_album_photo($album_id){
		$thumb = $this->db->select('thumb_url')
						->from('photos')
						->where('album_id', $album_id)
						->limit(1)
						->get()
						->row_array();
		return $thumb['thumb_url'];				
	}
	
	function add_album_photo($data){
		
		try{
			//insert bd
			if(!$this->db->insert('albums_photos', $data)){
				$error = 'ERROR_BD';
				throw new Exception($error);
			}
			
			//last insert id
			$id = $this->db->insert_id();			
			
			//create repertory
			if(!mkdir('./users/'.$data['user_id'].'/photo/'.$id)){
				$error = 'ERROR_REPERTORY';
				throw new Exception($error);
			}			
			return array('status' => true, 'id' => $id, 'title' => $data['title']);
			
		}catch(Exception $e){			
			return array('status' => false, 'msg' => $e->getMessage());
		}
	}
	
	function update_count_photo($data){
		try{
			//updata bd
			if(!$this->db->set('count_photo','count_photo+'.$data['count_photo'], false)->where('id', $data['album_id'])->update('albums_photos')){
				$error = 'ERROR_BD';
				throw new Exception($error);
			}
				
			return array('status' => true, 'id' => $data['album_id']);
			
		}catch(Exception $e){			
			return array('status' => false, 'msg' => $e->getMessage());
		}
	}
	
	function get_photos($album_id){
		$photos = $this->db->from('photos')
							  ->where('album_id', $album_id)				
							  ->get()
							  ->result_array();
		return $photos;
	}
	
	function add_photo($data){
		
		try{
			$photo = $data['photo'];
			if((!rename('./'.$data['temp_url'], '.'.$photo['url'])) ||	(!rename('./'.$data['temp_thumb_url'], '.'.$photo['thumb_url']))){
				$error = 'ERROR_FILE';
				throw new Exception($error);
			}
			
			if(!$this->db->insert('photos', $photo)){
				$error = 'ERROR_BD';
				throw new Exception($error);
			}
			
			return array('status' => true);
			
		}catch(Exception $e){			
			return array('status' => false, 'msg' => $e->getMessage());
		}	
	}	
	
	/**********PI PHOTOS**********/
	function add_pi_user($user_id, $type, $url){
	
		try{
			$data = array(
			   'user_id'	=> $user_id ,
			   'type'		=> $type ,
			   'url'		=> $url
			);			
			
			if($this->db->from('pi_photos')->where('user_id', $user_id)->where('url', $url)->count_all_results() > 0 ){
				$error = 'EXIST';
				throw new Exception($error);
			}
			
			if(!$this->db->insert('pi_photos', $data)){							
				$error = 'ERROR_BD';
				throw new Exception($error);
			}	
				
			$result = array('msg' => lang("users_page_picasa_add_success"), 'status' => 'SUCCESS', 'id' => $this->db->insert_id());			
			
			return $result;	
		}catch(Exception $e){			
			switch($e->getMessage()){
				case 'ERROR_BD'	: return array('status' => $e->getMessage(), 'msg' => lang("error_retry")); break;
				case 'EXIST'	: return array('status' => $e->getMessage(), 'msg' => lang("users_page_picasa_add_error1")); break;
				default			: break;
			}	
		}	
	}
	
	function delete_pi_user($id){
		
		if($this->db->delete('pi_photos', array('id' => $id)))
			$result = array('msg' => lang("users_page_picasa_deleted"), 'status' => 'SUCCESS');
		else
			$result = array('msg' => lang("error_retry"), 'status' => 'ERROR');		
			
		return $result;
	}
	
	/**********VIDEOS**********/
	
	//add yt video
	public function add_yt_video($user_id,$type, $url, $yt_id){
		
		try {
			$data = array(
			   'user_id' => $user_id ,
			   'type' => $type ,
			   'url' => $url ,
				'yt_id'	=> $yt_id
			);		
			
			if($this->db->from('yt_medias')->where('user_id', $user_id)->where('url', $url)->count_all_results() > 0 ){
				$error = 'EXIST';
				throw new Exception($error);
			}
			
			if(!$this->db->insert('yt_medias', $data)){
				$error = 'ERROR_BD';
				throw new Exception($error);
			}
			
			$insert_id = $this->db->insert_id();	
			
			//get html
			$video = $this->_get_data($url.'?alt=json', true);	
			$entry = $video['entry'];
			$data = array(
				'id'			=> $insert_id,
				'title'			=> $entry['media$group']['media$title']['$t'],
				'view_count'	=> $entry['yt$statistics']['viewCount'],											
				'thumbnail_url'	=> $entry['media$group']['media$thumbnail'][0]['url'],							
				'player_url'	=> $entry['media$group']['media$content'][0]['url'],
				'link_url'		=> $entry['link'][0]['href'],
				'description'	=> ellipsize($entry['media$group']['media$description']['$t'],200,1),
				'yt_id'			=> $yt_id
			);		
			$html = $this->load->view('page/tpl_yt_video', $data ,true);
			
			return array('status' => 'SUCCESS', 'msg' => lang("users_page_media_add_success"), 'html' => $html);
			
		}catch(Exception $e){			
			switch($e->getMessage()){
				case 'ERROR_BD'	: return array('status' => $e->getMessage(), 'msg' => lang("error_retry")); break;
				case 'EXIST'	: return array('status' => $e->getMessage(), 'msg' => lang("users_page_media_add_error1")); break;
				default			: break;
			}	
		}
	}
	
	//add yt flux
	public function add_yt_flux($user_id, $type, $url){
		try {
			$data = array(
			   'user_id' => $user_id ,
			   'type' => $type ,
			   'url' => $url
			);
			
			if($this->db->from('yt_medias')->where('user_id', $user_id)->where('url', $url)->count_all_results() > 0 ){
				$error = 'EXIST';
				throw new Exception($error);
			}
						
			if(!$this->db->insert('yt_medias', $data)){
				$error = 'ERROR_BD';
				throw new Exception($error);
			}
			
			$insert_id = $this->db->insert_id();
			
			//get html
			$flux = $this->_get_data($url.'?alt=json', true);
			$entry = $flux['entry'];
			$yt_feed_url = $entry['gd$feedLink'][4]['href'].'?alt=json&max-results=10';
			$yt_feed_videos = $this->_get_data($yt_feed_url, true);				
			$feed = '';				
			foreach($yt_feed_videos['feed']['entry'] as $yt_feed_video){					
				$data = array(			
					'id'			=> '',
					'title'			=> $yt_feed_video['media$group']['media$title']['$t'],
					'view_count'	=> $yt_feed_video['yt$statistics']['viewCount'],											
					'thumbnail_url'	=> $yt_feed_video['media$group']['media$thumbnail'][0]['url'],							
					'link_url'		=> $yt_feed_video['link'][0]['href'],
					'player_url'	=> $yt_feed_video['media$group']['media$content'][0]['url'],
					'description'	=> ellipsize($yt_feed_video['media$group']['media$description']['$t'],200,1)
				);		
				$feed .= $this->load->view('page/tpl_yt_video', $data ,true);
			}				
			
			$data = array(
				'id'			=> $insert_id,
				'username' 		=> $entry['yt$username']['$t'],					
				'feed_count'	=> $entry['gd$feedLink'][4]['countHint'],
				'feed_title'	=> $entry['title']['$t'],
				'feed_url'		=> $entry['link'][0]['href'],
				'avatar_url'	=> $entry['media$thumbnail']['url'],				
				'feed'			=> $feed		
			);
			
			$html= $this->load->view('page/tpl_yt_feed', $data ,true);
			
			return array('status' => 'SUCCESS', 'msg' => lang("users_page_media_add_success"), 'html' => $html);
			
		}catch(Exception $e){			
			switch($e->getMessage()){
				case 'ERROR_BD'	: return array('status' => $e->getMessage(), 'msg' => lang("error_retry")); break;
				case 'EXIST'	: return array('status' => $e->getMessage(), 'msg' => lang("users_page_media_add_error1")); break;
				default			: break;
			}	
		}			
	}
	
	public function delete_yt_video($id){
		if($this->db->delete('yt_medias', array('id' => $id)))
			return array('status' => 'SUCCESS', 'msg' => lang("users_page_videos_deleted"));
		else
			return array('status' => 'ERROR', 'msg' => lang("error_retry"));	
	}
	
	public function delete_yt_feed($id){
		if($this->db->delete('yt_medias', array('id' => $id)))
			return array('status' => 'SUCCESS', 'msg' => lang("users_page_flux_deleted"));
		else
			return array('status' => 'ERROR', 'msg' => lang("error_retry"));	
	}
	
	private function _get_data($json_url='',$array = false){
		$json_data = file_get_contents($json_url);
		return json_decode($json_data, $array);		
	}	
}