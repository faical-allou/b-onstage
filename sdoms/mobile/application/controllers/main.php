<?php
class Main extends CI_Controller {
		
	function __construct()
	{
		parent::__construct();				
	}
	
	public function index()
	{				

			$header['title'] = 'mobile | b-onstage';
			$header['description'] = 'mobile b-onstage';		
			$footer['scripts'] = array('js/main-dashboard.js');

			$this->load->view('_header',$header);
			$this->load->view('home');				
			$this->load->view('_footer',$footer);			

		
	}	
}	