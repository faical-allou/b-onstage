<?php

class Main extends CI_Controller {

		

	function __construct()

	{

		parent::__construct();		

		

		//load model

		$this->load->model('event_model');

		$this->load->model('concert_model');

		$this->load->model('artist_model');

		$this->load->model('stage_model');

		

		//var user

		$this->user = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row_array() : null;		

		

		//init vars

		if($this->ion_auth->logged_in()){

			$user = $this->user;

			$user_group = $this->ion_auth->in_group('stage') ? 'stage' : 'artist';

			$user_link = ($this->user['web_address']) ? site_url($this->user['web_address']) : site_url('page/'.$this->user['username']);

			$notifications = $this->user_model->get_notifications($this->user['id']);

			$this->load->vars(array('user' => $user));

			$this->load->vars(array('user_group' => $user_group));

			$this->load->vars(array('user_link' => $user_link));

			$this->load->vars(array('notifications' => $notifications));

		}

		//init search bar								

		if( ! $search = $this->session->userdata('concertsearch')){	

			$search['search-status'] = 'open';

			$search['search-date-start'] = date('Y-m-d');			

			$search['search-date-end'] = date('Y-m-d', strtotime("+3 months"));		

			$search['search-city'] = null;

		}

		$cities = $this->event_model->get_stage_cities();	

		$this->load->vars(array('search' => $search));	

		$this->load->vars(array('cities' => $cities));			

		

	}

	

	public function index()

	{				

		//var header

		$header['doctype'] = 'html5';

		$header['title'] = lang("home_title");

		$header['description'] = lang("home_desc");		

		

		//var home		

		$home['artists'] = array();

		$artists = $this->artist_model->get_all('','','',5,1);

		asort($artists['artists']);

		foreach($artists['artists'] as $artist){

			$data = array(

				'link'		=> ($artist['web_address']) ? site_url($artist['web_address']) : site_url('page/'.$artist['username']),

				'location'	=> $artist['country'].', '.$artist['city'],

				'name'		=> $artist['company'],

				'avatar'	=> site_url($artist['avatar'])

			);

			array_push($home['artists'], $data);

		}	

		

		$home['stages'] = array();

		$stages = $this->stage_model->get_all('','',5,1);

		foreach($stages['stages'] as $stage){

			$data = array(

				'link'		=> ($stage['web_address']) ? site_url($stage['web_address']) : site_url('page/'.$stage['username']),

				'location'	=> $stage['country'].', '.$stage['city'],

				'name'		=> $stage['company'],

				'avatar'	=> site_url($stage['avatar'])

			);

			array_push($home['stages'], $data);

		}		

		

		$home['concerts'] = array();

		$concerts = $this->concert_model->get_last();

		foreach($concerts as $concert){

			$time_start = strtotime($concert['date_start']);

			$time_end = strtotime($concert['date_end']);			

			$data = array(				

				'date'			=> date('j', $time_start).' '.get_month(date('n', $time_start)),

				'schedule'		=> date('G\hi',$time_start),

				'link'			=> site_url('event/'.$concert['id']),

				'location'		=> $concert['stage_country'].', '.$concert['stage_city'],

				'stage_avatar'	=> site_url($concert['stage_avatar']),

				'stage_name'	=> $concert['stage_company'],

				'stage_link'	=> ($concert['stage_web_address']) ? site_url($concert['stage_web_address']) : site_url('page/'.$concert['stage_username']),

				'artist_avatar'	=> site_url($concert['artist_avatar']),

				'artist_name'	=> $concert['artist_company'],

				'artist_link'	=> ($concert['artist_web_address']) ? site_url($concert['artist_web_address']) : site_url('page/'.$concert['artist_username'])

			);

			array_push($home['concerts'], $data);	

		}

		$home['title_concert'] = lang("home_title_concert");

		$home['title_stage'] = lang("home_title_stage");

		$home['title_artist'] = lang("home_title_artist");

		

		//var footer

		$footer['scripts'] = array('js/royalslider/jquery.royalslider.min.js','js/royalslider/jquery.easing-1.3.js','js/main-home.js');

		

		$this->load->view('_header',$header);		

		$this->load->view('home',$home);

		$this->load->view('_footer', $footer);

	}

	

	public function legal(){

		//var header

		$this->header['doctype'] = 'html5';

		$this->header['title'] = lang("legal_title");

		$this->header['description'] = lang("legal_desc");
	

		

		//var footer

		$this->footer['scripts'] = array('js/main-legal.js');

		

		$this->load->view('_header',$this->header);		

		$this->load->view('legal');

		$this->load->view('_footer', $this->footer);

	}

	

	public function terms_of_services(){

		//var header

		$this->header['doctype'] = 'html5';

		$this->header['title'] = lang("terms_of_services_title");

		$this->header['description'] = lang("terms_of_services_desc");		

		

		//var footer

		$this->footer['scripts'] = array('js/main-terms.js');

		

		$this->load->view('_header',$this->header);		

		$this->load->view('terms_of_services');

		$this->load->view('_footer', $this->footer);

	}

}