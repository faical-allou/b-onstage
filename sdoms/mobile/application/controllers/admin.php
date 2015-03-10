<?php
class Admin extends CI_Controller {
		
	function __construct()
	{
		parent::__construct();				
	}
	
	public function index(){						
		
			//var header		
			$header['title'] = 'Dashboard | b-onstage';
			$header['description'] = 'Dashboard b-onstage';		
			$menu['menu_id'] = '#dashboard-menu';
			$footer['scripts'] = array('js/main-dashboard.js');
			$this->load->view('_header',$header);
			$this->load->view('_menu',$menu);
			$this->load->view('user/dashboard');				
			$this->load->view('_footer',$footer);			
			}
		
	}	
	
	
}	