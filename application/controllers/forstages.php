<?php
class Forstages extends CI_Controller {
	
	public $user;
	
	function __construct()
	{
		parent::__construct();
		$this->user = $this->ion_auth->user()->row_array();	
		
		$this->load->model('event_model');
		
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
		$city_by_country = $this->event_model->get_stage_cities_by_countries();	
		$this->load->vars(array('search' => $search));	
		$this->load->vars(array('cities' => $cities));
		$this->load->vars(array('city_by_country' => $city_by_country));
	
	}
	
	public function index()
	{
		$this->header['title'] = lang("forstages_title");
		$this->header['description'] = lang("forstages_desc");		
		$this->footer['scripts'] = array('js/main-home.js');
		
		$this->load->view('_header',$this->header);				
		$this->load->view('forstages');
		$this->load->view('_footer', $this->footer);		
	}
	
		
		
}
