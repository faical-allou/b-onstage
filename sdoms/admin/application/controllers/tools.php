<?php
class Tools extends CI_Controller {
		
	function __construct()
	{
		parent::__construct();	
		$this->load->database();	
		$this->load->model('tools_model');
		$this->load->model('notification_model');
			
	}
	/********** ADD STAGE **********/
	public function index(){						
		
		if(!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')){		
			redirect('', 'refresh');
		} else {		
			//header		
			$header['title'] = 'Tools | b-onstage';
			$header['description'] = 'Tools b-onstage';		
			
			//menu
			$menu['menu_id'] = '#stage-tools';
			
			//data
			$data = array(
				'message' => $this->session->flashdata('message') ? $this->session->flashdata('message') : '',
			);
			/*$stages = $this->tools_model->get();
			$data['stages'] = $stages;*/
			
			//footer
			$footer = array();
			/*$footer['scripts'] = array(
				'js/datatable/js/jquery.dataTables.min.js',
				'js/main-stage.js');	*/
			if($this->input->post('event-id'))
				$data['nb_events'] = $this->tools_model->duplicate_event();
			
			$this->load->view('_header',$header);
			$this->load->view('_menu',$menu);
			$this->load->view('tools/index', $data);				
			$this->load->view('_footer',$footer);	
		}
		
	}
	
}	