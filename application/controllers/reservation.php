<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Reservation extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->library('email');
		$this->load->library('parser');
		$this->load->model('user_model');	
		$this->load->model('event_model');	
		$this->load->model('reservation_model');		
		$this->load->model('notification_model');		
	}
		
		
	/**********AJAX FUNCTIONS**********/
	public function delete(){
		if(IS_AJAX){		
			$reservation_id = $_POST['reservation_id'];			
			$reservation = $this->reservation_model->get($reservation_id);
			$valid = $this->reservation_model->delete($reservation_id);
			if($valid){															
				$artist = $this->user_model->get($reservation['artist_id']);
				$stage = $this->user_model->get($reservation['stage_id']);			
				$event = $this->event_model->get($reservation['event_id']);
				$event_date = date_create($event['date_start']);
				$data = array(
					'pseudo'				=> $artist['username'],
					'reservation_id'		=> $reservation_id,
					'stage_name'			=> $stage['company'],
					'event_date'			=> date_format($event_date,'d/m/Y').' '.lang("to2").' '.date_format($event_date,'H:i'),  
					'url_profil'			=> (!empty($artist['web_address'])) ? site_url($artist['web_address']) : site_url('page/'.$artist['username']),
					'url_new_reservation'	=> site_url('concert')
				);
				$html_message = $this->parser->parse('user/email/delete_reservation', $data, TRUE);				
				$this->email->from('contact@b-onstage.com	', 'b-onstage');
				$this->email->to($artist['email']);
				$this->email->cc('contact@b-onstage.com');
				$this->email->subject(lang("users_rese_refuse_email_subject"));
				$this->email->message($html_message);
				$this->email->send();		
				echo json_encode(array('status' => true, 'msg' => lang("users_rese_refuse_success")));			
			}
			else{
				echo json_encode(array('status' => false, 'msg' => lang("error_retry")));
			}
		}
		else
			show_404('error_general');		
	}
	
	
	//valide une demande de réservation recu
	public function valid(){
		if(IS_AJAX){
			try{
				$reservation_id = $_POST['reservation_id'];
				$reservation = $this->reservation_model->get($reservation_id);
				$artist = $this->user_model->get($reservation['artist_id']);
				$stage = $this->user_model->get($reservation['stage_id']);	
				$stage_link = $stage['web_address'] ? site_url($stage['web_address']) : site_url('page/'.$stage['username']);				
				$event = $this->event_model->get($reservation['event_id']);
				$event_date = date_create($event['date_start']);
				
				//valid reservation
				$valid = $this->reservation_model->valid($reservation);
				
				if(!$valid)
					throw new Exception('ERROR');	
				
				//send email
				$from = 'contact@b-onstage.com';
				$from_name = 'b-onstage';
				$to = $artist['email'];
				$cc = 'contact@b-onstage.com';				
				$subject = lang("users_rese_accepted_email_subject");				
				$data = array(
					'pseudo'				=> $artist['username'],
					'reservation_id'		=> $reservation_id,					
					'stage_name'			=> $stage['company'],
					'event_date'			=> date_format($event_date,'d/m/Y').' '.lang("to2").' '.date_format($event_date,'H:i'),  
					'reservation'			=> round($event['reservation'],2),
					'url_account'			=> site_url('user/reservations')
				);
				$msg = $this->parser->parse('user/email/accept_reservation', $data, TRUE);				
				if(!$this->user_model->send_email($from, $from_name, $to, $cc, $subject, $msg))
					throw new Exception('ERROR_EMAIL');
						
				//add notification
		
				//add notification to stage		
				$text_notification = anchor($stage_link, $stage['company'], array('class' => 'purple')).' '.lang("notifs_4");
				$link_notification = '/user/reservations';
				$avatar_notification = $stage['avatar'];
				$priority_notification = 1;
				if(!$this->notification_model->add($artist['id'], $text_notification, $link_notification, $avatar_notification, $priority_notification))
					throw new Exception('ERROR_NOTIFICATION');								
						
				echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_rese_validate_success")));
				
			}catch (Exception $e) {
				echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("error_retry")));
			}
		}
		else
			show_404('error_general');		
	
	}	
	
	
	//annulation d'une réservation
	public function cancel(){
		if(IS_AJAX){
			$reservation_id = $_POST['reservation_id'];
			$event_id = $_POST['event_id'];
			$event_status = $_POST['event_status'];
			$reservation_artist_id = $_POST['reservation_artist_id'];
			$event_artist_id = $_POST['event_artist_id'];
			$date_start = $_POST['date_start'];
			if($this->reservation_model->cancel($reservation_id, $event_id, $event_status, $reservation_artist_id, $event_artist_id))
				echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_rese_cancel_success")));
			else
				echo json_encode(array('status' => 'ERROR', 'msg' => lang("error_retry")));
		}		
	}
	
	//message d'alerte en cas d'annulation d'une réservation
	public function warning_msg(){
		if(IS_AJAX){
			$reservation_id = $_POST['reservation_id'];
			$event_id = $_POST['event_id'];
			$event_status = $_POST['event_status'];
			$reservation_artist_id = $_POST['reservation_artist_id'];
			$event_artist_id = $_POST['event_artist_id'];
			$date_start = $_POST['date_start'];
			
			$msg = $this->reservation_model->warning_msg($event_status, $event_artist_id, $reservation_artist_id, $date_start);
			
			echo json_encode(array('msg' => $msg));			
		}	
	}
	
	
	
	//retourne le texte présent sur une page de demande de réservation
	public function request($event_id){	
		if(IS_AJAX){							
			try{
				if (!$this->ion_auth->logged_in())
					throw new Exception('<p class="title fs-16 grey">'.lang("book_error1").'</p><p class="title grey fs-16">'.anchor(site_url('login'),lang("connect"), array('class' => 'purple')).' '.lang("or").' '.anchor(site_url('signup_choice'),lang("aboutus_header3_aboutus"), array('class' => 'purple')).' '.lang("book_error1_1").'</p>');
				
				if(!$this->ion_auth->in_group('artist'))
					throw new Exception('<p class="title fs-16">'.lang("book_error2").'</p>');			
				
				$infos = $this->reservation_model->request($event_id);
				$time_start = strtotime($infos['date_start']);
				$time_end = strtotime($infos['date_end']);
				$data = array(
					'company'		=> $infos['stage_company'],
					'date'			=> date('j', $time_start).' '.get_month(date('n',$time_start)).' '.lang("de").' '.date('G\hi', $time_start).' '.lang("to2").' '.date('G\hi', $time_end),
					'genres'		=> implode(', ',$infos['genres']),
					'reservation'	=> round($infos['reservation'],2),
					'payment'		=> implode(', ', $infos['payment']),
					'checkbox'		=> array(
						'id'		=> 'accept-terms',
						'name'		=> 'accept-terms',
						'checked'	=> false,
						'style'		=> 'margin-top:-3px;vertical-align:middle;'
					)	
				);	
				echo json_encode(array('status'	=> 'SUCCESS', 'msg' => $this->load->view('reservation/tpl_request', $data, true)));				
		
			} catch (Exception $e) {			
				echo json_encode(array('status'	=> 'ERROR', 'msg' => $e->getMessage()));			
			}			
		}
	}
	
	//envoi d'une demande de réservation
	public function send($event_id, $stage_id){
		if(IS_AJAX){			
			try{
				$event = $this->event_model->get_by_id($event_id);
				$stage = $this->user_model->get($stage_id);
				$artist = $this->ion_auth->user()->row_array();
				$artist_link = $artist['web_address'] ? site_url($artist['web_address']) : site_url('page/'.$artist['username']);
				
				//send reservation
				$reservation_id = $this->reservation_model->send($event, $stage, $artist);								
				if(empty($reservation_id))
					throw new Exception('ERROR');
				
				//send email to artist
				$from = 'contact@b-onstage.com';
				$from_name = 'b-onstage';
				$to = $artist['email'];
				$cc = 'contact@b-onstage.com';				
				$subject = lang("book_req_email_artist_subject").$reservation_id;
				$data = array(
					'pseudo'	=> $artist['username'],
					'location'	=> $stage['company'],
					'date'		=> date('d/m/Y', strtotime($event['date_start'])),
					'schedule'	=> date('G\Hi', strtotime($event['date_start'])).' '.lang("to2").' '.date('G\Hi', strtotime($event['date_end']))
				);	
				$msg = $this->parser->parse('user/email/send_reservation', $data, TRUE);								
				if(!$this->user_model->send_email($from, $from_name, $to, $cc, $subject, $msg))
					throw new Exception('ERROR_EMAIL');
						
				//add notification to artist		
				$text_notification = lang("notifs_1");
				$link_notification = '/user/reservations';
				$avatar_notification = '/img/logo_128.png';
				$priority_notification = 2;
				if(!$this->notification_model->add($artist['id'], $text_notification, $link_notification, $avatar_notification, $priority_notification))
					throw new Exception('ERROR_NOTIFICATION');
				
				//send email to stage
				$to = $stage['email'];
				$subject = lang("book_req_email_stage_subject");
				$data = array(
					'pseudo'		=> $stage['username'],
					'pseudo_artist'	=> $artist['username'],
					'date'			=> date('d/m/Y', strtotime($event['date_start'])),
					'schedule'		=> date('G\Hi', strtotime($event['date_start']))
				);
				$msg = $this->parser->parse('user/email/received_reservation', $data, TRUE);
				if(!$this->user_model->send_email($from, $from_name, $to, $cc, $subject, $msg))
					throw new Exception('ERROR_EMAIL');
						
				//add notification to stage		
				$text_notification = lang("notifs_2").' '.anchor($artist_link, $artist['company'], array('class' => 'purple'));
				$link_notification = '/event/edit/'.$event['id'];
				$avatar_notification = $artist['avatar'];
				$priority_notification = 2;
				if(!$this->notification_model->add($stage['id'], $text_notification, $link_notification, $avatar_notification, $priority_notification))
					throw new Exception('ERROR_NOTIFICATION');
				
				echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("book_req_success")));			
				
			}catch (Exception $e) {
				echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("error_retry")));
			}			
		}
	}
	
	//payer les frais de réservation
	public function pay(){
		if(IS_AJAX){
			//on met a jour l'évènement
			$event_id = $_POST['event_id'];
			$this->db->set('date_modified', date('c'));
			$this->db->set('status', 'close');
			$this->db->where('id', $event_id);
			if($this->db->update('events'))
				echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_rese_paid")));
			else	
				echo json_encode(array('status' => 'ERROR', 'msg' => lang("users_rese_pay_error")));		
		}
	}
}