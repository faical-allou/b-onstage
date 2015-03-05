<?php
class About extends CI_Controller {
	
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
		$this->load->vars(array('search' => $search));	
		$this->load->vars(array('cities' => $cities));
	
	}
	
	public function index()
	{
		$this->header['title'] = lang("aboutus_title");
		$this->header['description'] = lang("aboutus_desc");		
		$this->footer['scripts'] = array('js/main-about.js');
		
		$this->load->view('_header',$this->header);				
		//$this->load->view('about/menu');
		$this->load->view('about/index');
		$this->load->view('_footer', $this->footer);		
	}
	
	
	
	public function about_us()
	{
		$this->header['title'] = lang("whoweare_title");
		$this->header['description'] = lang("whoweare_desc");			
		$this->footer['scripts'] = array('js/main-about.js');
		
		$this->load->view('_header',$this->header);		
		//$this->load->view('about/menu');
		$this->load->view('about/about_us');
		$this->load->view('_footer', $this->footer);		
	}
	
	public function how_does_it_work(){
		$this->header['title'] = lang("howitworks_title");
		$this->header['description'] = lang("howitworks_desc");				
		$this->footer['scripts'] = array('js/main-about.js');
		
		$this->load->view('_header',$this->header);		
		//$this->load->view('about/menu');
		$this->load->view('about/work');
		$this->load->view('_footer', $this->footer);		
	}	
	public function how_i_make_money(){
		$this->header['title'] = lang("howimakemoney_title");
		$this->header['description'] = lang("howimakemoney_desc");				
		$this->footer['scripts'] = array('js/main-about.js');
		
		$this->load->view('_header',$this->header);		
		//$this->load->view('about/menu');
		$this->load->view('about/money');
		$this->load->view('_footer', $this->footer);		
	}	
		
}
