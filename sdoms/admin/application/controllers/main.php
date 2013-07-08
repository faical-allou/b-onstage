<?php
class Main extends CI_Controller {
		
	function __construct()
	{
		parent::__construct();				
	}
	
	public function index()
	{				
		
		
		if(!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')){
		
			//envoi du formulaire de connexion
			$this->form_validation->set_error_delimiters('<div class="text-error mt-5">', '</div>');
			$this->form_validation->set_rules('identity', 'Identity', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == true){
				$remember = (bool) $this->input->post('remember');
				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember) && $this->ion_auth->is_admin()){
					$this->session->set_flashdata('message', $this->ion_auth->messages());				
					redirect('admin','refresh');
				}	
				else {
					$this->session->set_flashdata('message', $this->ion_auth->errors());				
					redirect('', 'refresh');
				}
			} else {
				//title
				$data['title'] = 'Login';

				//error message
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				//identity = email
				$data['identity'] = array(
					'name'		=> 'identity',					
					'id'		=> 'identity',
					'value'		=> $this->form_validation->set_value('identity')
				);

				//password
				$data['password'] = array(
					'name'		=> 'password',					
					'id'		=> 'password'
				);

				//var header		
				$header['title'] = 'Administration | b-onstage';
				$header['description'] = 'Administration b-onstage';		
				$this->load->view('_header',$header);
				$this->load->view('auth/login', $data);				
				$this->load->view('_footer');		
		
			}	
		// si connecté en tant qu'adminstrateur		
		} else {		
			redirect('admin','refresh');		
		}
		
	}	
}	