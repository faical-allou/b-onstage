<?php
class Admin extends CI_Controller {
		
	function __construct()
	{
		parent::__construct();				
	}
	
	public function index(){						
		
		if(!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')){		
			redirect('', 'refresh');
		} else {		
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
	
	/**********LOGOUT*********/
	public function logout(){		
		$logout = $this->ion_auth->logout();
		redirect('', 'refresh');
	}
	
}	