<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	private $footer = array();

	function __construct(){
		parent::__construct();
		//var user
		$this->user = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row_array() : null;

		
		$this->load->library('parser');
		$this->load->model('member_model');
		$this->load->model('media_model');
		$this->load->model('user_model');
		$this->load->model('contact_model');
		$this->load->model('event_model');
		$this->load->model('genre_model');
		$this->load->model('reservation_model');
		$this->load->model('notification_model');
		$this->load->library('session');
		$this->lang_counts = $this->config->item('lang_counts');

		//init vars
		if($this->ion_auth->logged_in()){
			$user = $this->user;
			$user_group = $this->ion_auth->in_group('stage') ? 'stage' : 'artist';
			$user_link = ($this->user['web_address']) ? site_url($this->user['web_address']) : site_url('page/'.$this->user['username']);
			$notifications = $this->notification_model->get($this->user['id']);
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

	}

	//index function
	function index(){

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
		else
		{
			/*****HEADER*****/
			$this->header['doctype'] = 'html5';
			$this->header['title'] = lang("user_home_title");
			$this->header['description'] = lang("user_home_desc");			
			
			//$this->header['genres'] = $this->genre_model->get_all();

			/*****DATA*****/
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');			
			
			/*****ALL DATA FORM*****/
			$this->data['attrs_label'] = array('class' => 'grey fs-12 bold pl-2');
			
			/*username*/
			$this->data['label_username'] = lang("users_home_username_txt");
			$this->data['input_username'] = array(
				'id'			=> 'input-username',
				'name'			=> 'input-username',
				'class'			=> 'input ui-corner-all fs-13 grey mr-10'
			);
			  			  
			/*password*/
			//old password
			$this->data['label_old_password'] = lang("users_home_passwrod_old");
			$this->data['old_password'] = array(
				'class'		=> 'input ui-corner-all fs-13 grey',
				'name'		=> 'old-password',
				'id'		=> 'old-password'
			);

			//new password
			$this->data['label_new_password'] = lang("users_home_passwrod_new");
			$this->data['new_password'] = array(
				'class'		=> 'input ui-corner-all fs-13 grey',
				'name'		=> 'new-password',
				'id'		=> 'new-password'
				//'pattern'	=> '^.{'.$this->data['min_password_length'].'}.*$'
			);

			//new password confirm
			$this->data['label_new_confirm_password'] = lang("users_home_passwrod_conf");
			$this->data['new_confirm_password'] = array(
				'class'		=> 'input ui-corner-all fs-13 grey',
				'name'		=> 'new-password-confirm',
				'id'		=> 'new-password-confirm'
				//'pattern'	=> '^.{'.$this->data['min_password_length'].'}.*$'
			);

			/*company*/
			$this->data['label_company'] = lang("users_home_input_artist_name");
			$this->data['input_company'] = array(
				'id'			=> 'input-company',
				'name'			=> 'input-company',
				'class'			=> 'input ui-corner-all fs-13 grey mr-10'
			);
			
			/*url profil*/
			$this->data['label_url_profil'] = lang("users_home_url");
			$this->data['label_prefix_url_profil'] = site_url();
			$this->data['input_url_profil'] = array(
				'id'			=> 'input-url-profil',
				'name'			=> 'input-url-profil',
				'class'			=> 'input ui-corner-all fs-13 grey ml-5 mr-10'
			);
			
			/*if($this->user['active'])
			{
				$this->data['url_activate'] = site_url('user/ajax_deactivate');
				$this->data['text_activate'] = 'Désactiver le compte';
			}
			else
			{
				$this->data['url_activate'] = site_url('user/ajax_activate');
				$this->data['text_activate'] = 'Activer le compte';
			}*/

			$this->footer['scripts'] = array('js/jquery.validate.min.js','js/main-user.js');

			$this->load->view('_header',$this->header);
			$this->load->view('user/account_menu');
			$this->load->view('user/general', $this->data);
			$this->load->view('_footer', $this->footer);
		}
	}

		


	//login
	function login($continue=''){	
			
		//var header
		$this->header['doctype'] = 'html5';
		$this->header['title'] = $this->lang->line('signin_title');
		$this->header['description'] = lang("user_signin_desc");
		
		$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all fs-12 bold p-5 mt-10">', '</div>');
		$this->form_validation->set_rules('identity', lang("users_home_email"), 'required');
		$this->form_validation->set_rules('password', lang("password"), 'required');

		if ($this->form_validation->run() == true)
		{			
			$remember = (bool) $this->input->post('remember');			
		
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				if($continue)
					redirect(urldecode($continue),'refresh');
				else					
					redirect('user','refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());				
				redirect('login', 'refresh');
			}
		}
		else
		{
			//url action
			$this->data['url_action'] = $continue ? site_url('login/'.$continue) : site_url('login');
			
			//title
			$this->data['title'] = $this->lang->line('signin_title');

			//error message
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//attributs label
			$this->data['attrs_label'] = array(
				'class'		=> 'fs-12 grey bold pl-2'
			);

			//identity = email
			$this->data['identity'] = array(
				'name'		=> 'identity',
				'class'		=> 'input ui-corner-all fs-13 grey',
				'id'		=> 'identity',
				'value'		=> $this->form_validation->set_value('identity')
			);

			//password
			$this->data['password'] = array(
				'name'		=> 'password',
				'class'		=> 'input ui-corner-all fs-13 grey',
				'id'		=> 'password'
			);
			//submit signin form
			$this->data['submit'] = array(
				'name'		=> 'submit-signin',
				'class'		=> 'ui-purple',
				'id'		=> 'submit-signin',
				'value'		=> 'Connexion'
			);

			$this->footer['scripts'] = array('js/main-signin.js');

			$this->load->view('_header',$this->header);
			$this->load->view('user/auth/login', $this->data);
			$this->load->view('_footer',$this->footer);
		}
	}

	//log the user out
	function logout(){		
		$logout = $this->ion_auth->logout();
		redirect('login', 'refresh');
	}

	//signup choice
	function signup_choice(){
		if ($this->ion_auth->logged_in()){
			redirect('user', 'refresh');
		}else{
			$header = array(		
				'title'			=> lang("signup_choice_title"),
				'description'	=> lang("signup_choice_desc")
			);		
			$footer['scripts'] = array('js/main-signup-choice.js');

			//load views
			$this->load->view('_header', $header);
			$this->load->view('user/auth/signup_choice');		
			$this->load->view('_footer',$footer);		
		}	
	}
	
	function signup_stage($step_value = 1){
	
		$step['step'] = $step_value;
			switch($step_value)
			{
				//step 1: signup
				case 1:
					if ($this->ion_auth->logged_in()){
						redirect('user', 'refresh');
					}else{
						$header = array(		
							'title'			=> lang("signup_stage_title"),
							'description'	=> lang("signup_stage_desc")
						);		
						
						
						$step['title'] = lang("signup_stage_step_1_title");
						$step['align_title'] = 'ta-l';
						
						$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all fs-12 bold p-5 mt-10">', '</div>');			
						$this->form_validation->set_rules('company', lang("signup_stage_step_1_form_field1"), 'trim|required');			
						$this->form_validation->set_rules('email', 'lang:identity', 'trim|required|valid_email|is_unique[users.email]');
						$this->form_validation->set_rules('terms_of_services', 'lang:terms_of_services', 'callback_terms_of_services');			
						
						if ($this->form_validation->run() == true){		

							$email = $this->input->post('email');		
							$company = $this->input->post('company');		
							$tel = $this->input->post('tel');		
							
							$data = array();
							//send email to stage											
							$html_message = $this->parser->parse('user/email/confirm_pre_inscription', $data, TRUE);				
							$this->email->from('contact@b-onstage.com', 'b-onstage');
							$this->email->to($email);							
							$this->email->subject(lang("signup_stage_email_subject"));
							$this->email->message($html_message);
							$this->email->send();
													
							//envoi du mail à scenes@mybandonstage.com
							$pre_inscription_lang = $this->session->userdata('lang_loaded');
							$data = array(
								'email'		=> $email,
								'company'	=> $company,
								'tel'		=> $tel,
								'lang'		=> $pre_inscription_lang
							);	
							
							$html_message = $this->parser->parse('user/email/send_pre_inscription', $data, TRUE);				
							$this->email->from($email, $company);
							$this->email->to('contact@b-onstage.com');	// 	PROD : scenes@mybandonstage.com  TEST : contact@b-onstage.com			
							$this->email->subject('Demande d\'inscription | b-onstage');
							$this->email->message($html_message);
							$this->email->send();
							
							redirect('registration_completed_stage', 'refresh');
						
						}else{
							//var data
							//set message
							$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
							
							//attrs label
							$data['attrs_label'] = array(
								'class'		=> 'fs-12 grey bold pl-2'
							);

							//company
							$data['company'] = array(						
								'title'		=> lang("signup_stage_step_1_form_field1_title"),
								'name'		=> 'company',
								'class'		=> 'input ui-corner-all fs-13 grey',
								'id'		=> 'company',
								'value'		=> $this->form_validation->set_value('company')
							);
							
							//email
							$data['email'] = array(
								'name'		=> 'email',
								'title'		=> lang("signup_stage_step_1_form_field2_title"),
								'class'		=> 'input ui-corner-all fs-13 grey',
								'id'		=> 'email',
								'value'		=> $this->form_validation->set_value('email')
							);

							//tel
							$data['tel'] = array(
								'name'		=> 'tel',
								'title'		=> lang("signup_stage_step_1_form_field3_title"),
								'class'		=> 'input ui-corner-all fs-13 grey',
								'id'		=> 'tel',
								'value'		=> $this->input->post('tel')
							);
							
							//terms of services
							$data['terms_of_services'] = array(
								'name'		=> 'terms_of_services',
								'id'		=> 'terms_of_services',
								'value'		=> 'yes',
								'checked'	=> false,
								'class'		=> 'left mt-2'
							);

							$data['text_terms_of_services'] = lang("signup_form_accept");				
							
							//submit signup form
							$data['submit'] = array(
								'name'		=> 'button-register',
								'class'		=> 'ui-purple',
								'id'		=> 'submit-signup',
								'value'		=> lang("signup_stage_step_1_form_submit")
							);
								
							$footer['scripts'] = array('js/main-signup-stage.js');

							//load views
							$this->load->view('_header', $header);
							$this->load->view('user/auth/signup_steps_stage',$step);
							$this->load->view('user/auth/signup_stage', $data);		
							$this->load->view('_footer',$footer);		
						}
					}	
				break;	
				
				//signup stage fini
				case 2 :
					if ($this->ion_auth->logged_in()){
						redirect('user', 'refresh');
					}else{	
						//var header
						$header['doctype'] = 'html5';
						$header['title'] = lang("signup_stage_step2_title");
						$header['description'] = lang("signup_stage_step2_desc");

						//var step
						$step['title'] = lang("signup_stage_step_2_title");
						$step['align_title'] = 'ta-c';
						
						$footer['scripts'] = array('js/main-signup-stage.js');
							
						$this->load->view('_header', $header);
						$this->load->view('user/auth/signup_steps_stage',$step);
						$this->load->view('user/auth/terminate_stage', $footer);						
						$this->load->view('_footer');
					}	
					break;
			default : break;
		}		
	}
	
	function signup_stage_ref($step_value = 1){
	
		$step['step'] = $step_value;
		switch($step_value)
		{
			//step 1: signup
			case 1:
				if ($this->ion_auth->logged_in()){
					redirect('user', 'refresh');
				}else{
					$header = array(
							'title'			=> lang("signup_stage_title_ref"),
							'description'	=> lang("signup_stage_desc_ref")
					);
	
	
					$step['title'] = lang("signup_stage_step_1_title");
					$step['align_title'] = 'ta-l';
	
					$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all fs-12 bold p-5 mt-10">', '</div>');
					
					$this->form_validation->set_rules('ambassador', 'lang:identity', 'trim|required|valid_email');
					$this->form_validation->set_rules('company', lang("signup_stage_step_1_form_field1"), 'trim|required');
					$this->form_validation->set_rules('email', 'lang:identity', 'trim|required|valid_email|is_unique[users.email]');
					$this->form_validation->set_rules('terms_of_services', 'lang:terms_of_services', 'callback_terms_of_services');
	
					if ($this->form_validation->run() == true){
	
						$ambassador = $this->input->post('email');
						$email = $this->input->post('email');
						$company = $this->input->post('company');
						$tel = $this->input->post('tel');
							
						$data = array();
						//send email to stage
						$html_message = $this->parser->parse('user/email/confirm_pre_inscription', $data, TRUE);
						$this->email->from('contact@b-onstage.com', 'b-onstage');
						$this->email->to($email);
						$this->email->subject(lang("signup_stage_email_subject"));
						$this->email->message($html_message);
						$this->email->send();
							
						//envoi du mail à scenes@mybandonstage.com
						$pre_inscription_lang = $this->session->userdata('lang_loaded');
						$data = array(
								'email'		=> $email,
								'company'	=> $company,
								'tel'		=> $tel,
								'lang'		=> $pre_inscription_lang
						);
							
						$html_message = $this->parser->parse('user/email/send_pre_inscription', $data, TRUE);
						$this->email->from($email, $company);
						$this->email->to('contact@b-onstage.com');	// 	PROD : scenes@mybandonstage.com  TEST : contact@b-onstage.com
						$this->email->subject('Demande d\'inscription | b-onstage');
						$this->email->message($html_message);
						$this->email->send();
							
						redirect('registration_completed_stage_ref', 'refresh');
	
					}else{
						//var data
						//set message
						$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
							
						//attrs label
						$data['attrs_label'] = array(
								'class'		=> 'fs-12 grey bold pl-2'
						);
	
						//ambassador
						$data['ambassador'] = array(
								'title'		=> lang("signup_stage_step_1_form_field0_title"),
								'name'		=> 'ambassador',
								'class'		=> 'input ui-corner-all fs-13 grey',
								'id'		=> 'ambassador',
								'value'		=> $this->form_validation->set_value('ambassador')
						);
						
						//company
						$data['company'] = array(
								'title'		=> lang("signup_stage_step_1_form_field1_title"),
								'name'		=> 'company',
								'class'		=> 'input ui-corner-all fs-13 grey',
								'id'		=> 'company',
								'value'		=> $this->form_validation->set_value('company')
						);
							
						//email
						$data['email'] = array(
								'name'		=> 'email',
								'title'		=> lang("signup_stage_step_1_form_field2_title"),
								'class'		=> 'input ui-corner-all fs-13 grey',
								'id'		=> 'email',
								'value'		=> $this->form_validation->set_value('email')
						);
	
						//tel
						$data['tel'] = array(
								'name'		=> 'tel',
								'title'		=> lang("signup_stage_step_1_form_field3_title"),
								'class'		=> 'input ui-corner-all fs-13 grey',
								'id'		=> 'tel',
								'value'		=> $this->input->post('tel')
						);
							
						//terms of services
						$data['terms_of_services'] = array(
								'name'		=> 'terms_of_services',
								'id'		=> 'terms_of_services',
								'value'		=> 'yes',
								'checked'	=> false,
								'class'		=> 'left mt-2'
						);
	
						$data['text_terms_of_services'] = lang("signup_form_accept");
							
						//submit signup form
						$data['submit'] = array(
								'name'		=> 'button-register',
								'class'		=> 'ui-purple',
								'id'		=> 'submit-signup',
								'value'		=> lang("signup_stage_step_1_form_submit")
						);
	
						$footer['scripts'] = array('js/main-signup-stage.js');
	
						//load views
						$this->load->view('_header', $header);
						$this->load->view('user/auth/signup_steps_stage',$step);
						$this->load->view('user/auth/signup_stage_ref', $data);
						$this->load->view('_footer',$footer);
					}
				}
				break;
	
				//signup stage fini
			case 2 :
				if ($this->ion_auth->logged_in()){
					redirect('user', 'refresh');
				}else{
					//var header
					$header['doctype'] = 'html5';
					$header['title'] = lang("signup_stage_step2_title");
					$header['description'] = lang("signup_stage_step2_desc");
	
					//var step
					$step['title'] = lang("signup_stage_step_2_title");
					$step['align_title'] = 'ta-c';
	
					$footer['scripts'] = array('js/main-signup-stage.js');
						
					$this->load->view('_header', $header);
					$this->load->view('user/auth/signup_steps_stage',$step);
					$this->load->view('user/auth/terminate_stage_ref', $footer);
					$this->load->view('_footer');
				}
				break;
			default : break;
		}
	}
	
	
	
	//signup function (signup artist)
	//step 1: valid signup form
	//step 2: account activation
	//step 3: first step
	function signup($step = 1){	
		$this->step['step'] = $step;


		switch($step)
		{

			//step 1: signup
			case 1:
				if ($this->ion_auth->logged_in()){
					redirect('user', 'refresh');
				}else{	
					//var header
					$this->header['doctype'] = 'html5';
					$this->header['title'] = $this->lang->line('signup_title');
					$this->header['description'] = $this->lang->line('signup_title');

					//var step
					$this->step['title'] = lang("signup_header");
					$this->step['align_title'] = 'ta-l';
					
					$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all fs-12 bold p-5 mt-10">', '</div>');
					//$this->form_validation->set_rules('groups_menu','lang:groups_menu', 'required|callback_groups_menu');
//					$this->form_validation->set_rules('company', lang("signup_form_artist_name"), 'trim|required|is_unique[users.company]');
//					$this->form_validation->set_rules('username', 'lang:username', 'trim|required|xss_clean||min_length[5]|max_length[25]|is_unique[users.username]|is_unique[users.web_address]');
					$this->form_validation->set_rules('email', 'lang:identity', 'trim|required|valid_email|is_unique[users.email]');
					$this->form_validation->set_rules('password', 'lang:password', 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth'));
//					$this->form_validation->set_rules('password_confirm', 'lang:password_confirm', 'trim|required');
//					$this->form_validation->set_rules('terms_of_services', 'lang:terms_of_services', 'callback_terms_of_services');

					
					if ($this->form_validation->run() == true)
					{
						
						$email = $this->input->post('email');
						$password = $this->input->post('password');
                        $temp_email = explode( "@" , $email);
                        //$groups = $this->input->post('groups_menu');
						$groups = array('2');//groupe artist
						
                        $username = preg_replace("/[^a-zA-Z0-9]+/", "", $temp_email[0]);
						$additional_data = array(
							'company'		=> $temp_email[0],
							'web_address'	=> $this->input->post('username')
						);	
						/*$additional_data = array('first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name')
						);*/

						/*if(strtolower($groups) == 'stage')
							$groups = array('3');//groupe stage
						else
							$groups = array('2');//groupe artist*/
					}

					
					if ( ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data,$groups))) //|| $GLOBALS['log_fb'] )
					{

						$this->session->set_flashdata('email', $email);
						$this->session->set_flashdata('message', "User Created");
						
/*							if ( isset($GLOBALS['log_fb']) ) 
							{redirect('activate'. "?n=" . $GLOBALS['name_fb'] . "&u=" . $username = $GLOBALS['username_fb'] . "&e=" . $GLOBALS['email_fb'] . "&p=" . $GLOBALS['password_fb'] . "&fb=TRUE", 'refresh');}
							else 
*/							redirect('activate', 'refresh');
					}
					else
					{
						//var data
						//set message
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

						//attributs label
						$this->data['attrs_label'] = array(
							'class'		=> 'fs-12 grey bold pl-2'
						);

						//groups menu
						/*$this->data['groups_menu'] = array(
							'name'		=> 'groups_menu',
							'options'	=> array(
								'error'		=> 'Je suis un ...',
								'artist'	=> 'Artiste / Groupe',
								'stage'		=> 'Scène / Etablissement'
							),
							'selected'	=> $this->form_validation->set_value('groups_menu'),
							'js'		=> 'id="groups-menu"'
						);*/
						
						//company
						$this->data['company'] = array(						
							'title'		=> lang("signup_form_title1"),
							'name'		=> 'company',
							'class'		=> 'input ui-corner-all fs-13 grey',
							'id'		=> 'company',
							'value'		=> $this->form_validation->set_value('company')
						);
						
						//username
						$this->data['username'] = array(
							'title'		=> lang("signup_form_title2"),
							'name'		=> 'username',
							'class'		=> 'input ui-corner-all fs-13 grey',
							'id'		=> 'username',
							'value'		=> $this->form_validation->set_value('username')
						);

						//email
						$this->data['email'] = array(
							'name'		=> 'email',
							'title'		=> lang("signup_form_title3"),
							'class'		=> 'input ui-corner-all fs-13 grey',
							'id'		=> 'email',
							'value'		=> $this->form_validation->set_value('email')
						);

						//password
						$this->data['password'] = array(
							'name'		=> 'password',
							'title'		=> lang("signup_form_title4"),
							'class'		=> 'input ui-corner-all fs-13 grey',
							'id'		=> 'password',
							'value'		=> $this->form_validation->set_value('password')
						);

						//password confirm
						$this->data['password_confirm'] = array(
							'title'		=> lang("signup_form_title5"),
							'name'		=> 'password_confirm',							
							'class'		=> 'input ui-corner-all fs-13 grey',
							'id'		=> 'password_confirm',
							'value'		=> $this->form_validation->set_value('password_confirm')
						);

						//terms of services
						$this->data['terms_of_services'] = array(
							'name'		=> 'terms_of_services',
							'id'		=> 'terms_of_services',
							'value'		=> 'yes',
							'checked'	=> false,
							'class'		=> 'left mt-2'
						);

						$this->data['text_terms_of_services'] = lang("signup_form_accept");

						//submit signup form
						$this->data['submit'] = array(
							'name'		=> 'button-register',
							'class'		=> 'ui-purple',
							'id'		=> 'submit-signup',
							'value'		=> lang("signup_form_next")
						);

						$this->footer['scripts'] = array('js/main-signup.js');

						//load views
						$this->load->view('_header', $this->header);
						$this->load->view('user/auth/signup_steps_artist',$this->step);
						$this->load->view('user/auth/signup', $this->data);
						$this->load->view('_footer',$this->footer);
						
					}
				}	
				break;

				//step 2: account activation
				case 2:
					
/*					if ( isset($GLOBALS['log_fb']))
						{
						$username = $GLOBALS['username_fb'];
						$email = $GLOBALS['email_fb'];
						$password = $GLOBALS['password_fb'];
						//$groups = $this->input->post('groups_menu');
						$groups = array('2');//groupe artist
						
						$additional_data = array(
							'company'		=> $GLOBALS['name_fb'],
							'web_address'	=> $GLOBALS['username_fb']
												);
						}
					
					$GLOBALS['id']=$this->ion_auth->register($username, $password, $email, $additional_data, $groups);
*/
					if (!$this->ion_auth->email_check($this->session->flashdata('email'))) //&& !$GLOBALS['log_fb'])
						{
						die(print_r("redirect to sign up", true ));
						redirect('signup');
						}

					else
					{
						//var header
						$this->header['doctype'] = 'html5';
						$this->header['title'] = lang("signup_active_title");
						$this->header['description'] = lang("signup_active_desc");

						//var step
						$this->step['title'] = lang("signup_active_title");
						$this->step['align_title'] = 'ta-c';
						$this->footer['scripts'] = array('js/main-activate.js');
							
						$this->load->view('_header', $this->header);
						$this->load->view('user/auth/signup_steps_artist',$this->step);
						$this->load->view('user/auth/activate', $this->footer);						
						$this->load->view('_footer');
						$to = "faical.allou@mybandonstage.com";
						mail ($to, 'user activate', "a user reached the activate page");
					
  					}					

					break;

				//etape 3 first step
				case 3:

					if(!$this->ion_auth->login_remembered_user())
						redirect('signup');
					else
					{
						$id = $this->user['id'];
						//create users/id directory
						directory_copy('users/default','users/'.$id);

						//update avatar and cover path
						$url_avatar = 'users/'.$id.'/img/avatar.jpg';
						$url_cover = 'users/'.$id.'/img/cover.jpg';
						$update_data = array(
							'avatar'	=> $url_avatar ,
							'cover'		=> $url_cover
						);
						$this->ion_auth->update($id, $update_data);						
						$this->user['avatar'] = $url_avatar;						
						$this->header['terminate_avatar'] = $url_avatar;
						
						//var header
						$this->header['doctype'] = 'html5';
						$this->header['title'] = $this->lang->line('signup_terminate_title');
						$this->header['description'] = lang("signup_terminate_desc");						

						//var step
						$this->step['title'] = $this->lang->line('signup_terminate_title');
						$this->step['align_title'] = 'ta-r';						
						
						$this->footer['scripts'] = array('js/main-terminate.js');
						
						$this->load->view('_header', $this->header);
						$this->load->view('user/auth/signup_steps_artist',$this->step);
						$this->load->view('user/auth/terminate', array('user' => $this->user));
						$this->load->view('_footer', $this->footer);
						$to = "faical.allou@mybandonstage.com";
						mail ($to, 'registration complete', "a user completed the registration");
					}
					break;
			default:break;
		}			
	}

	//activate the user
	function activate($id, $code=false){
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);

		if ($activation)
		{
			$this->ion_auth->remember_user($id);			
			$this->session->set_flashdata('message', $this->ion_auth->messages());			
			redirect('registration_completed', 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("user/forgot_password", 'refresh');
		}
	}

		//activate user
	function ajax_activate(){
		if ($this->ion_auth->logged_in())
			$this->ion_auth->activate($this->session->userdata('user_id'));
	}

	//deactivate the user
	function ajax_deactivate(){
		if ($this->ion_auth->logged_in())
			$this->ion_auth->deactivate($this->session->userdata('user_id'));
	}

	//change password
	public function change_password(){
		try{
			if(!IS_AJAX) throw new Exception('NOT_AJAX');
			if (!$this->ion_auth->logged_in()) throw new Exception('LOGIN');			
			
			$old_password = $_POST['old_password'];
			$new_password = $_POST['new_password'];			
			if(!$this->ion_auth->change_password($this->session->userdata($this->config->item('identity', 'ion_auth')), $old_password, $new_password))
				throw new Exception('BD_ERROR');
			
			echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_home_passwrod_success")));						
			//$this->logout();							
		
		} catch (Exception $e) {
			switch($e->getMessage()){				
				case 'BD_ERROR'			: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("error_retry")));break;								
				case 'NOT_AJAX' 		: show_404();break;
				case 'LOGIN'			: redirect('login', 'refresh');break;
				default					: break;
			}						
		}
	}

	//forgot password
	function forgot_password(){
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);
			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('user/forgot_password', $this->data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("user/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("user/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code){
		$reset = $this->ion_auth->forgotten_password_complete($code);

		if ($reset)
		{  //if the reset worked then send them to the login page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("user/login", 'refresh');
		}
		else
		{ //if the reset didnt work then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("user/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	/*function deactivate($id = NULL)
	{
		// no funny business, force to integer
		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->load->view('user/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('user', 'refresh');
		}
	}*/

	function delete_user(){
		if(!$this->ion_auth->logged_in())
		{
			$this->load->view('user/delete_user');
		}
		else
		{
			$id = $this->session->userdata('user_id');
			$this->ion_auth->logout();
			$this->ion_auth->delete_user($id);
			$this->session->set_flashdata('message', $this->ion_auth->messages());
		}
	}

	function _get_csrf_nonce(){
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce(){
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	//update email
	function update_email(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
		else{
			$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all dib fs-12 bold p-5 mt-10">', '</div>');
			$this->form_validation->set_rules('old', 'Votre E-mail', 'required');
			$this->form_validation->set_rules('new', 'Nouvel E-mail', 'required|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'Vérification du nouvel E-mail', 'required|valid_email');

			if ($this->form_validation->run() == false)
			{
				//var header
				$this->header['doctype'] = 'html5';
				$this->header['title'] = 'Modifier adresse électronique';
				$this->header['description'] = 'Recherchez des sc�nes o� jouer. Trouvez des groupes et artistes pour vos soir�es. D�couvrez les concerts sur Paris, Montr�al, Berlin, Los Angeles.';				
				
				//var message
				$this->data['message'] =($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'));

				//attrs label
				$this->data['attrs_label'] = array(
					'class'		=> 'fs-12 grey bold pl-2'
				);

				//old email
				$this->data['old_email'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'old',
					'id'		=> 'old',
					'value'		=> $this->form_validation->set_value('old')
				);

				//new email
				$this->data['new_email'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'new',
					'id'		=> 'new',
					'value'		=> $this->form_validation->set_value('new')
				);

				//confirm new email
				$this->data['new_email_confirm'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'new_confirm',
					'id'		=> 'new_confirm',
					'value'		=> $this->form_validation->set_value('new_confirm')
				);

				//user id
				$this->data['user_id'] = array(
					'name'		=> 'user_id',
					'id'		=> 'user_id',
					'value'		=> $this->user['id'],
					'type'		=> 'hidden'
				);

				$this->footer['scripts'] = array('js/main-update-email.js');

				$this->load->view('_header', $this->header);
				$this->load->view('user/update_email', $this->data);
				$this->load->view('_footer', $this->footer);
			}
			else
			{
				$email = $this->input->post('new');
				if(!$this->ion_auth->email_check($email) && ($this->input->post('old') == $this->user['email'])){

					$update = $this->ion_auth->update($this->input->post('user_id'), array('email' => $email));

					if($update)
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect('user', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('user/update_email', 'refresh');
					}
				}
				else{
					$this->session->set_flashdata('message','L\'adresse E-mail est déjà utilisée ou une erreur est survenue, veuillez réessayer.');
					redirect('user/update_email', 'refresh');
				}

			}
		}
	}
	
	public function update_company(){
		try{
			if(!IS_AJAX) throw new Exception('NOT_AJAX');
			if (!$this->ion_auth->logged_in()) throw new Exception('LOGIN');			
			
			$company = $_POST['company'];						
			
			$exist = ($this->db->from('users')->where('LOWER(company)', strtolower($company))->count_all_results() > 0);
			if($exist)
				throw new Exception('EXIST');
			
			$this->db->where('id', $this->user['id']);
			if(!$this->db->update('users', array('company' => $company)))
				throw new Exception('BD_ERROR');
					
			echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_home_input_artist_name_success")));						
		
		} catch (Exception $e) {
			switch($e->getMessage()){				
				case 'EXIST'			: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("users_home_input_artist_name_error1")));break;								
				case 'BD_ERROR'			: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("error_retry")));break;				
				case 'NOT_AJAX' 		: show_404();break;
				case 'LOGIN'			: redirect('login', 'refresh');break;
				default					: break;
			}						
		}		
	}
	
	//update username
	public function update_username(){

		try{
			if(!IS_AJAX) throw new Exception('NOT_AJAX');
			if (!$this->ion_auth->logged_in()) throw new Exception('LOGIN');			
			
			$username = $_POST['username'];
			
			if(!preg_match('/^[a-zA-Z0-9]*_?[a-zA-Z0-9]*$/',$_POST['username']))			
				throw new Exception('USERNAME_ERROR');			
			
			if ($this->ion_auth->username_check($username))
				throw new Exception('EXIST');
			
			$this->db->where('id', $this->user['id']);
			if(!$this->db->update('users', array('username' => $username)))
				throw new Exception('BD_ERROR');
					
			echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_home_username_success")));						
		
		} catch (Exception $e) {
			switch($e->getMessage()){				
				case 'EXIST'			: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("users_home_username_error1")));break;								
				case 'BD_ERROR'			: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("users_home_username_error2")));break;
				case 'USERNAME_ERROR'	: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("users_home_username_error3")));break;
				case 'NOT_AJAX' 		: show_404();break;
				case 'LOGIN'			: redirect('login', 'refresh');break;
				default					: break;
			}						
		}			
		
	}
	
	//update url profil
	public function update_url_profil(){
		try{
			if(!IS_AJAX) throw new Exception('NOT_AJAX');
			if (!$this->ion_auth->logged_in()) throw new Exception('LOGIN');			
			
			$web_address = $_POST['web_address'];
			
			if(!preg_match('/^[a-zA-Z0-9]*_?[a-zA-Z0-9]*$/',$_POST['web_address']))			
				throw new Exception('URL_PROFIL_ERROR');			
			
			$exist = ($this->db->from('users')->where('LOWER(web_address)', strtolower($web_address))->count_all_results() > 0) || in_array(strtolower($web_address),$this->config->item('reserved_url'));
			if($exist)
				throw new Exception('EXIST');		
						
			$this->db->where('id', $this->user['id']);
			if(!$this->db->update('users', array('web_address' => $web_address)))
				throw new Exception('BD_ERROR');
					
			echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_home_url_success")));						
		
		} catch (Exception $e) {
			switch($e->getMessage()){				
				case 'EXIST'			: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("users_home_url_error1")));break;								
				case 'BD_ERROR'			: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("error_retry")));break;
				case 'URL_PROFIL_ERROR'	: echo json_encode(array('status' => $e->getMessage(), 'msg' => lang("users_home_username_error3")));break;
				case 'NOT_AJAX' 		: show_404();break;
				case 'LOGIN'			: redirect('login', 'refresh');break;
				default					: break;
			}						
		}
	}
	
	//update information(coordonnées)
	function update_information(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
		else {

			$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all dib fs-12 bold p-5 mt-10">', '</div>');
			$this->form_validation->set_rules('first_name', lang("first_name"));
			$this->form_validation->set_rules('last_name', lang("last_name"));
			$this->form_validation->set_rules('address', lang("address"));
			$this->form_validation->set_rules('zip', lang("postalcode"));
			$this->form_validation->set_rules('city', lang("city"));
			$this->form_validation->set_rules('country', lang("country"));
			$this->form_validation->set_rules('phone', lang("phone"));

			if ($this->form_validation->run() == false)
			{
				//var header
				$this->header['doctype'] = 'html5';
				$this->header['title'] = lang("user_update_information_title");
				$this->header['description'] = lang("user_update_information_desc");
				
				//var message
				$this->data['message'] =($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'));

				//attrs label
				$this->data['attrs_label'] = array(
					'class'		=> 'fs-12 grey bold pl-2'
				);

				//first name
				$this->data['first_name'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'first_name',
					'id'		=> 'first_name',
					'value'		=> !empty($this->user['first_name']) ? $this->user['first_name'] : $this->form_validation->set_value('first_name'),
					'type'		=> 'text'
				);

				//last name
				$this->data['last_name'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'last_name',
					'id'		=> 'last_name',
					'value'		=> !empty($this->user['last_name']) ? $this->user['last_name'] : $this->form_validation->set_value('last_name'),
					'type'		=> 'text'
				);

				//address
				$this->data['address'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'address',
					'id'		=> 'address',
					'value'		=> !empty($this->user['address']) ? $this->user['address'] : $this->form_validation->set_value('address')
				);

				//city
				$this->data['city'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'city',
					'id'		=> 'city',
					'value'		=> !empty($this->user['city']) ? $this->user['city'] : $this->form_validation->set_value('city')
				);

				//zip
				$this->data['zip'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'zip',
					'id'		=> 'zip',
					'value'		=> !empty($this->user['zip']) ? $this->user['zip'] : $this->form_validation->set_value('first_name')
				);

				//country
				$this->data['country'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'country',
					'id'		=> 'country',
					'value'		=> !empty($this->user['country']) ? $this->user['country'] : $this->form_validation->set_value('country')
				);

				//téléphone
				$this->data['phone'] = array(
					'class'		=> 'input ui-corner-all fs-13 grey',
					'name'		=> 'phone',
					'id'		=> 'phone',
					'value'		=> !empty($this->user['phone']) ? $this->user['phone'] : $this->form_validation->set_value('phone')
				);

				//user id
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'value' => $this->user['id'],
					'type' => 'hidden'
				);

				$this->footer['scripts'] = array('js/main-update-info.js');
				$this->load->view('_header', $this->header);
				$this->load->view('user/account_menu');
				$this->load->view('user/update_information', $this->data);
				$this->load->view('_footer', $this->footer);
			}
			else
			{
				$info = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'zip' => $this->input->post('zip'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone')
				);

				$update = $this->ion_auth->update($this->input->post('user_id'), $info);

				if($update)
				{
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('user', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('user/update_information', 'refresh');
				}
			}
		}
	}


	//fonction qui va mettre à jour la table users
	function ajax_update(){
		if(IS_AJAX){
			if (!$this->ion_auth->logged_in())
			{
				redirect('login', 'refresh');
			}
			else
			{
				$user_id = $this->input->get('user_id');
				$id_info = $this->input->get('id_info');
				$val = $this->input->get('val');
				$data = array($id_info => $val);

				$result = (	$this->ion_auth->update($user_id, $data)) ? true: false;

				echo json_encode(array('status'=>$result));
			}
		}	
	}

	function dialog_upload_cover(){
		if(IS_AJAX){
			$data = array('session_id' => $this->session->userdata('session_id'));
			echo $this->load->view('page/tpl_upload_cover', $data, true);		
		}
	}
	
	
	//update cover
	function update_cover(){
		if (IS_AJAX)
		{
			$user_id = $this->user['id'];
			$targ_w = 880;
			$targ_h = 300;
			$quality = 100;
			$src = 'temp/'.$_POST['filename'];
			$path = pathinfo($src);
			$ext = strtolower($path['extension']);
			$dest = 'users/'.$user_id.'/img/cover.'.$ext;
			$crop_img = ImageCreateTrueColor( $targ_w, $targ_h );

			switch($ext){
				case 'jpg':
					$img = imagecreatefromjpeg($src);
					imagecopyresampled($crop_img,$img,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
					$valid = imagejpeg($crop_img, $dest,$quality);
					break;
				case 'png':
					$img = imagecreatefrompng($src);
					imagecopyresampled($crop_img,$img,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
					$valid = imagepng($crop_img, $dest);
					break;
				case 'gif':
					$img = imagecreatefromgif($src);
					imagecopyresampled($crop_img,$img,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
					$valid = imagegif($crop_img, $dest);
					break;
				default:break;
			}

			if($valid){
				unlink($src);
				$update_data = array('cover' => $dest);
				$this->ion_auth->update($user_id, $update_data);
				echo json_encode(array('status' => 'OK', 'file' => site_url($dest), 'msg' => lang("users_page_modpic_success")));
			}
			else
				echo json_encode(array('status' => 'ERROR', 'msg' => lang("error_retry")));
		}
		else
			show_404('error_general');

	}
	
	function dialog_upload_avatar(){
		if(IS_AJAX){
			$data = array('session_id' => $this->session->userdata('session_id'));
			echo $this->load->view('page/tpl_upload_avatar', $data, true);		
		}
	}
	
	//update avatar
	function update_avatar(){
		if (IS_AJAX)
		{
			$user_id = $this->user['id'];
			$targ_w = 240;
			$targ_h = 240;
			$quality = 100;
			$src = 'temp/'.$_POST['filename'];
			$path = pathinfo($src);
			$ext = strtolower($path['extension']);
			$dest = 'users/'.$user_id.'/img/avatar.'.$ext;
			$crop_img = ImageCreateTrueColor( $targ_w, $targ_h );

			switch($ext){
				case 'jpg':
					$img = imagecreatefromjpeg($src);
					imagecopyresampled($crop_img,$img,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
					$valid = imagejpeg($crop_img, $dest,$quality);
					break;
				case 'png':
					$img = imagecreatefrompng($src);
					imagecopyresampled($crop_img,$img,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
					$valid = imagepng($crop_img, $dest);
					break;
				case 'gif':
					$img = imagecreatefromgif($src);
					imagecopyresampled($crop_img,$img,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
					$valid = imagegif($crop_img, $dest);
					break;
				default:break;
			}

			if($valid){
				unlink($src);
				$update_data = array('avatar' => $dest);
				$this->ion_auth->update($user_id, $update_data);
				echo json_encode(array('status' => 'OK', 'file' => site_url($dest), 'msg' => lang("users_page_modava_success")));
			}
			else
				echo json_encode(array('status' => 'ERROR', 'msg' => lang("error_retry")));
		}
		else
			show_404('error_general');
	}

	///////////////////////function reservation//////////////////
	public function reservations(){
		if (!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}
		else{
			$this->header['title'] = lang("user_rese_title");
			$this->header['description'] = lang("user_rese_desc");			
			
			$reservations = $this->reservation_model->get_by_artist_id($this->user['id']);
			$pending_reservations = '';
			$accepted_reservations = '';
			$close_reservations = '';
			$nb_pending = 0;
			$nb_accepted = 0;
			$nb_close = 0;
			foreach($reservations as $reservation){
				//payment type
				$payment_type = array();				
				switch($reservation['payment_type']){
					case 1 :
						array_push($payment_type, lang("payment_notset"));
						break;
					case 2 :
						array_push($payment_type, lang("users_calendar_create_non_renum"));
						break;
					case 3 :
						if($reservation['payment_amount'] > 0)
							array_push($payment_type,lang("users_calendar_create_cachet").' '.round($reservation['payment_amount'],2));
						if($reservation['percent_drink'] > 0)
							array_push($payment_type, round($reservation['percent_drink'],2).lang("users_calendar_create_conso"));
						if($reservation['percent_entry'] > 0)
							array_push($payment_type,round($reservation['percent_entry'],2).'% '.lang("users_calendar_create_tickets"));
						if($reservation['refund_fees'])
							array_push($payment_type,lang("users_calendar_create_remb"));
						break;
					default : break;
				}
				//musical genre
				//Determine row name depending on lang loaded
				if($this->session->userdata('lang_loaded') == "french"){$rowname = 'name';}
				else {
					foreach($this->lang_counts as $key => $value){
						if($this->session->userdata('lang_loaded') == $value["name"]){
							$rowname = 'name_'.$value["id"];
						}
					}
				}
				$musical_genre = array();
				$genres_ids = explode('|', $reservation['genre_id']);
				$query = $this->db->select($rowname)
							->from('musical_genres')
							->where_in('id', $genres_ids)
							->get();
				foreach ($query->result_array() as $row)
					array_push($musical_genre, ucfirst($row[$rowname]));
					
				//data
				$data = array(					
					'reservation'		=> $reservation,					
					'start'				=> date_create($reservation['start']),
					'end'				=> date_create($reservation['end']),
					'is_past'			=> ($reservation['start'] < date('Y-m-d H:i:s')),
					'is_expired'		=> (strtotime("+2 day", strtotime($reservation['date_modified'])) < time()),
					'location'			=> $reservation['stage_city'].', '.$reservation['stage_country'],
					'payment_type'		=> implode(' + ', $payment_type),
					'musical_genre'		=> implode(', ', $musical_genre),
					'entry'				=> ($reservation['entry'] == 0) ? '0' : round($reservation['entry'], 2),
					'stage_link'		=> !empty($reservation['stage_web_address']) ?  site_url($reservation['stage_web_address']) : site_url('page/'.$reservation['stage_username'])
				);				
				
				switch($reservation['status']){
					case 'pending' :						
						$pending_reservations .= $this->load->view('reservation/tpl_pending', $data, true);
						$nb_pending++;
						break;
					case 'accepted' : 
						if($reservation['artist_id'] == $reservation['event_artist_id']){							
							$accepted_reservations .= $this->load->view('reservation/tpl_accepted', $data, true);
							$nb_accepted++;
						}else{
							$pending_reservations .= $this->load->view('reservation/tpl_pending', $data, true);
							$nb_pending++;
						}	
						break;
					case 'close' :
						if($reservation['artist_id'] == $reservation['event_artist_id']){
							$close_reservations .= $this->load->view('reservation/tpl_close', $data, true);
							$nb_close++;
						}	
						break;
					default : break;		
				}		
			}		

			$this->data = array(
				'user_group' 	=> $this->ion_auth->in_group('stage') ? 'stage' : 'artist',
				'pending_reservations'	=> $pending_reservations,
				'nb_pending'			=> $nb_pending,
				'accepted_reservations'	=> $accepted_reservations,
				'nb_accepted'			=> $nb_accepted,
				'close_reservations'	=> $close_reservations,
				'nb_close'				=> $nb_close
			);

			$this->footer['scripts'] = array(							
				'js/countdown/jquery.countdown.min.js',
				'js/main-reservation.js'
			);
			$this->load->view('_header', $this->header);
			$this->load->view('user/account_menu');
			$this->load->view('user/reservations',$this->data);
			$this->load->view('_footer', $this->footer);
		}
	}

	



	///////////////////////function calendar/////////////////////
	function calendar(){
		if (!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}
		else{

			//variable header
			$this->header['doctype'] = 'html5';
			$this->header['title'] = lang("user_calendar_title");
			$this->header['description'] = lang("user_calendar_desc");			

			//variable data
			
			//url feed
			$this->data['url_feed'] = site_url('user/events_feed');

			//button add event
			$user_group = $this->ion_auth->in_group('stage') ? 'stage' : 'artist';
			$this->data['button_create_event'] = ($user_group == 'stage') ? anchor(site_url('event/create'),lang("users_calendar_addevent"), array('class' => 'ui-red', 'id' => 'button-create-event')) : '';

			//filtres
			list($events_open, $events_pending, $events_accepted, $events_close) = $this->event_model->get_events('','', $this->user['id']);

			$this->data['filter_open'] = array(
				'id'			=> 'filter-open',
				'title'			=> lang("users_calendar_open_txt"),
				'counter'		=> count($events_open),
				'color'			=> 'blue',
				'checkbox'		=> array(
					'id'			=> 'checkbox-open',
					'name'			=> 'checkbox-open',
					'value'			=> 'open',
					'ckecked'		=> FALSE
					),
				'label'			=> lang("open")
			);

			$this->data['filter_pending'] = array(
				'id'			=> 'filter-pending',
				'title'			=> lang("users_calendar_req_inprocess_txt"),
				'counter'		=> count($events_pending),
				'color'			=> 'yellow',
				'checkbox'		=> array(
					'id'			=> 'checkbox-pending',
					'name'			=> 'checkbox-pending',
					'value'			=> 'pending',
					'ckecked'		=> FALSE
					),
				'label'			=> lang("req_inprocess")
			);

			$this->data['filter_accepted'] = array(
				'id'			=> 'filter-accepted',
				'title'			=> lang("users_calendar_awaiting_txt"),
				'counter'		=> count($events_accepted),
				'color'			=> 'orange',
				'checkbox'		=> array(
					'id'			=> 'checkbox-accepted',
					'name'			=> 'checkbox-accepted',
					'value'			=> 'accepted',
					'ckecked'		=> FALSE
					),
				'label'			=> lang("awaiting")
			);

			$this->data['filter_close'] = array(
				'id'			=> 'filter-close',
				'title'			=> lang("users_calendar_confirmed_txt"),
				'counter'		=> count($events_close),
				'color'			=> 'green',
				'checkbox'		=> array(
					'id'			=> 'checkbox-close',
					'name'			=> 'checkbox-close',
					'value'			=> 'close',
					'ckecked'		=> FALSE
					),
				'label'			=> lang("confirmed")
			);

			//switch
			$this->data['switch_grid'] = array(
				'name'		=> 'switch-calendar',
				'id'		=> 'switch-grid',
				'checked'	=> TRUE
			);
			$this->data['switch_list'] = array(
				'name'	=> 'switch-calendar',
				'id'	=> 'switch-list',
				'checked'	=> FALSE
			);

			/*****EVENT LIST*****/
			$events = $this->event_model->get_by_user_id($this->user['id']);
			$tmpl_ev_list = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" class="table-event-list">');
			$this->table->set_template($tmpl_ev_list);
			$this->table->set_heading(array(lang("date"), lang("schedule"), lang("infos"), lang("action")));

			foreach($events as $event){
				/*****EVENT STATUS*****/
				$status = $event['status'];

				/*****EVENT DATE*****/
				$date_start = date_create($event['date_start']);
				$date_end = date_create($event['date_end']);
				$event_date = date_format($date_start,'D. j M. Y');
				$schedule = date_format($date_start, 'H:i').' - '.date_format($date_end, 'H:i');

				/*****EVENT INFOS*****/

				/*****TITLE*****/
				$title = $event['title'];

				/*****MUSICAL GENRES*****/
				//Determine row name depending on lang loaded
				if($this->session->userdata('lang_loaded') == "french"){$rowname = 'name';}
				else {
					foreach($this->lang_counts as $key => $value){
						if($this->session->userdata('lang_loaded') == $value["name"]){
							$rowname = 'name_'.$value["id"];
						}
					}
				}
				$tabs_genre = explode('|', $event['genre_id']);
				$musical_genres = '';
				foreach($tabs_genre as $genre_id){
					if($genre_id != ''){
						$musical_genre = $this->genre_model->get_by_id($genre_id);
						$musical_genres .= $musical_genre[$rowname].', ';
					}
				}

				/*****PAYMENT TYPE*****/
				$payment_type = '';
				switch($event['payment_type']){
					case 1 :
						$payment_type = lang("payment_notset");
						break;
					case 2 :
						$payment_type = lang("users_calendar_create_non_renum");
						break;
					case 3 :
						$payment_type.= ($event['payment_amount'] > 0) ? lang("users_calendar_create_cachet").' '.round($event['payment_amount'],2).' + ' : '';
						$payment_type.= ($event['percent_drink'] > 0) ? round($event['percent_drink'],2).' '.lang("users_calendar_create_conso").' + ' : '';
						$payment_type.= ($event['percent_entry'] > 0) ? round($event['percent_entry'],2).'% '.lang("users_calendar_create_tickets").' + ' : '';
						$payment_type.= ($event['refund_fees'] > 0) ? lang("users_calendar_create_remb") : '';
						break;
					default : break;
				}

				/*****EVENT RESERVATION*****/
				$reservation = round($event['reservation'],2);

				/*****EVENT ENTRY*****/
				$entry = round($event['entry'],2);


				switch($status){
					case 'open':
						$this->table->add_row(
							array(
								'data'			=> anchor(site_url('event/edit/'.$event['id']), $event_date, array('class' => 'blue')),
								'data-status'	=> $status,
								'data-color'	=> 'blue'
							),
							$schedule,
							'<a href="javascript:void(0)" class="blue link-more-info"><span aria-hidden="true" class="fs-8 mr-5 icon-plus"></span>'.$title.'</a>'.
							'<div class="normal grey hidden">'.
								'<p><strong>'.lang("users_calendar_genre").' : </strong>'.$musical_genres.'</p>'.
								'<p><strong>'.lang("users_calendar_create_payment").' : </strong>'.$payment_type.'</p>'.
								'<p><strong>'.lang("users_calendar_create_book").' : </strong>'.$reservation.'</p>'.
								'<p><strong>'.lang("users_calendar_create_price").' : </strong>'.$entry.'</p>'.
							'</div>',
							'<div class="link-action">'.
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 mr-10 icon-pencil"></span>').
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 icon-remove-3"></span>').
							'</div>'

						);
					break;
					case 'pending':
						$count_reservations = $this->reservation_model->count($event['id']);
						$this->table->add_row(
							array(
								'data'			=> anchor(site_url('event/edit/'.$event['id']), $event_date, array('class' => 'yellow')),
								'data-status'	=> $status,
								'data-color'	=> 'yellow'
							),
							$schedule,
							'<a href="javascript:void(0)" class="yellow link-more-info"><span aria-hidden="true" class="fs-8 mr-5 icon-plus"></span>'.$title.'</a>'.
							'<div class="normal grey hidden">'.
							'<p><strong>'.lang("users_rese_amount").' : </strong>'.$count_reservations.'</p>'.
							'<p><strong>'.lang("users_calendar_genre").' : </strong>'.$musical_genres.'</p>'.
							'<p><strong>'.lang("users_calendar_create_payment").' : </strong>'.$payment_type.'</p>'.
							'<p><strong>'.lang("users_calendar_create_book").' : </strong>'.$reservation.'</p>'.
							'<p><strong>'.lang("users_calendar_create_price").' : </strong>'.$entry.'</p>'.
							'</div>',
							'<div class="link-action">'.
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 mr-10 icon-pencil"></span>').
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 icon-remove-3"></span>').
							'</div>'
						);
					break;
					case 'accepted':
						$artist = $this->user_model->get($event['artist_id']);
						$artist_name = (!empty($artist['company'])) ? $artist['company'] : $artist['username'];
						$this->table->add_row(
							array(
								'data'			=> anchor(site_url('event/edit/'.$event['id']), $event_date, array('class' => 'orange')),
								'data-status'	=> $status,
								'data-color'	=> 'orange'
							),
							$schedule,
							'<a href="javascript:void(0)" class="orange link-more-info"><span aria-hidden="true" class="fs-8 mr-5 icon-plus"></span>'.$title.'</a>'.
							'<div class="normal grey hidden">'.
							'<p><strong>'.lang("users_rese_status1_a").' : </strong>'.$artist_name.'</p>'.
							'<p><strong>'.lang("users_calendar_genre").' : </strong>'.$musical_genres.'</p>'.
							'<p><strong>'.lang("users_calendar_create_payment").' : </strong>'.$payment_type.'</p>'.
							'<p><strong>'.lang("users_calendar_create_book").' : </strong>'.$reservation.'</p>'.
							'<p><strong>'.lang("users_calendar_create_price").' : </strong>'.$entry.'</p>'.
							'</div>',
							'<div class="link-action">'.
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 mr-10 icon-pencil"></span>').
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 icon-remove-3"></span>').
							'</div>'
						);
					break;
					case 'close':
						$artist = $this->user_model->get($event['artist_id']);
						$artist_name = (!empty($artist['company'])) ? $artist['company'] : $artist['username'];
						$this->table->add_row(
							array(
								'data'			=> anchor(site_url('event/edit/'.$event['id']), $event_date, array('class' => 'green')),
								'data-status'	=> $status,
								'data-color'	=> 'green'
							),
							$schedule,
							'<a href="javascript:void(0)" class="green link-more-info"><span aria-hidden="true" class="fs-8 mr-5 icon-plus"></span>'.$title.'</a>'.
							'<div class="normal grey hidden">'.
							'<p><strong>'.lang("users_rese_status1_a").' : </strong>'.$artist_name.'</p>'.
							'<p><strong>'.lang("users_calendar_genre").' : </strong>'.$musical_genres.'</p>'.
							'<p><strong>'.lang("users_calendar_create_payment").' : </strong>'.$payment_type.'</p>'.
							'<p><strong>'.lang("users_calendar_create_book").' : </strong>'.$reservation.'</p>'.
							'<p><strong>'.lang("users_calendar_create_price").' : </strong>'.$entry.'</p>'.
							'</div>',
							'<div class="link-action">'.
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 mr-10 icon-pencil"></span>').
							anchor(site_url('event/edit/'.$event['id']), '<span aria-hidden="true" class="fs-13 icon-remove-3"></span>').
							'</div>'
						);

					break;
					default:break;
				}
			}

			$this->data['event_list'] = $this->table->generate();

			$this->footer['scripts'] = array('js/fullcalendar.min.js', 'js/datatable/jquery.dataTables.min.js', 'js/calendar.js', 'js/main-calendar.js');

			//show calendar
			$this->load->view('_header',$this->header);
			$this->load->view('user/account_menu');
			$this->load->view('user/calendar', $this->data);
			$this->load->view('_footer', $this->footer);
		}
	}

	function events_feed(){
		if (IS_AJAX){
		
			$now = new DateTime('now');
			$start = unix_to_human($_POST['start'], TRUE, 'eu');
			$end = unix_to_human($_POST['end'], TRUE, 'eu');

			list($events_open, $events_pending, $events_accepted, $events_close) = $this->event_model->get_events($start, $end, $this->user['id']);

			$feed = array();

			//events open

			foreach($events_open as $open){
				$start = new DateTime($open['date_start']);
				if($start < $now)
					$class_name = 'event-open ui-blue ui-state-default ui-corner-all';
				else
					$class_name = 'event-open ui-blue ui-state-default ui-corner-all';

				array_push(
					$feed,
					array(
						'id' => $open['id'],
						'title' => $open['title'],
						'start' => human_to_unix($open['date_start']),
						'end' => human_to_unix($open['date_end']),
						'allDay' => false,
						'className'	=> $class_name
					)
				);
			}

			//events pending
			foreach($events_pending as $pending){
				$start = new DateTime($pending['date_start']);
				if($start < $now)
					$class_name = 'event-pending ui-state-default ui-corner-all';
				else
					$class_name = 'event-pending ui-yellow ui-state-default ui-corner-all';
				array_push(
					$feed,
					array(
						'id' => $pending['id'],
						'title' => $pending['title'],
						'start' => human_to_unix($pending['date_start']),
						'end' => human_to_unix($pending['date_end']),
						'allDay' => false,
						'className'	=> $class_name
					)
				);
			}

			//events pending
			foreach($events_accepted as $accepted){
				$start = new DateTime($accepted['date_start']);
				if($start < $now)
					$class_name = 'event-accepted ui-state-default ui-corner-all';
				else
					$class_name = 'event-accepted ui-orange ui-state-default ui-corner-all';

				array_push(
					$feed,
					array(
						'id' => $accepted['id'],
						'title' => $accepted['title'],
						'start' => human_to_unix($accepted['date_start']),
						'end' => human_to_unix($accepted['date_end']),
						'allDay' => false,
						'className'	=> $class_name
					)
				);
			}

			//events close
			foreach($events_close as $close){
				$start = new DateTime($close['date_start']);
				if($start < $now)
					$class_name = 'event-close ui-state-default ui-corner-all';
				else
					$class_name = 'event-close ui-green ui-state-default ui-corner-all';

				array_push(
					$feed,
					array(
						'id' => $close['id'],
						'title' => $close['title'],
						'start' => human_to_unix($close['date_start']),
						'end' => human_to_unix($close['date_end']),
						'allDay' => false,
						'className'	=> $class_name
					)
				);
			}
			echo json_encode($feed);
		}
	}

	///////////////////////function contact/////////////////////
	function contact(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
		else{
			$contacts = array();
			
			foreach($this->contact_model->get_all($this->user['id']) as $contact){
			
				array_push($contacts, array(
					'contact_id'		=> $contact['contact_id'],
					'contact_name'		=> (empty($contact['company'])) ? $contact['username'] : $contact['company'],
					'contact_email'		=> $contact['email'],
					'contact_location'	=> $contact['city'].', '.$contact['country'],
					'contact_link'		=> empty($contact['web_address']) ? site_url('page/'.$contact['username']) : site_url($contact['web_address']),
					'contact_type'		=> $this->ion_auth->in_group('stage', $contact['user_contact']) ? 'scène' : 'artiste', 
					'contact_avatar'	=> img(array('src'=>$contact['avatar'], 'width' =>'120px')),
					'web_address'		=> $contact['web_address']
				));	
			}
			
			//variable header
			$this->header['doctype'] = 'html5';
			$this->header['title'] = $this->data['title'] = lang("user_contact_title");
			$this->header['description'] = lang("user_contact_desc");
			
			$this->data['contacts'] = $contacts;

			$this->footer['scripts'] = array('js/main-contact.js');

			$this->load->view('_header',$this->header);
			$this->load->view('user/account_menu');
			$this->load->view('user/contact', $this->data);
			$this->load->view('_footer', $this->footer);
		}
	}

	function add_contact(){
		echo json_encode($this->contact_model->add($this->user['id'], $_POST['user_contact']));
	}
	
	function delete_contact(){
		if(IS_AJAX){
			$contact_id = $_POST['contact_id'];
			echo json_encode($this->contact_model->delete($contact_id));
		}	
	}

	///////////////////////notifications/////////////////////
	function read_notifications(){
		if (!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}
		else{
			$this->user_model->read_notifications($this->user['id']);
		}
	}

	function notifications($offset=0){
		if (!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}
		else{
			$notifications = $this->user_model->get_notifications($this->user['id'], 10, $offset);

			//variable header
			$this->header['doctype'] = 'html5';
			$this->header['title'] = $this->data['title'] = lang("user_notifs_title");
			$this->header['description'] = lang("user_notifs_desc");		

			//var data			
			$this->data['notifications'] = $notifications['notifications'];
			$this->data['hasmore'] = $notifications['hasmore'];
			$this->data['offset'] = $offset;

			$this->footer['scripts'] = array('js/main-notifications.js');

			if($offset)
				$this->load->view('user/notifications_sub', $this->data);
			else{
				$this->load->view('_header',$this->header);
				$this->load->view('user/notifications', $this->data);
				$this->load->view('_footer', $this->footer);
			}
		}
	}

	///////////////////////function members/////////////////////

	function ajax_add_member()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
		else{
			$user_id = $this->input->get('user_id');
			$name = $this->input->get('name');
			$instrument = $this->input->get('instrument');

			$member_id = $this->member_model->add($user_id, $name, $instrument);
			echo json_encode(array('member_id'=>$member_id));
		}
	}

	function ajax_delete_member($member_id){
		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
		else{
			$result = (	$this->member_model->delete($member_id)) ? true : false;
			echo json_encode(array('status'=>$result));
		}
	}

	/**********YOUTUBE**********/	
	//add youtube video
	public function add_yt_video(){		
		if(IS_AJAX){			
			$user_id = $_POST['user_id'];
			$type = $_POST['type'];
			$url = $_POST['url'];
			$result = $this->media_model->add_yt_video($user_id,$type, $url);
			echo json_encode($result);
		}
	}

	//add youtube video
	public function add_yt_flux(){		
		if(IS_AJAX){
			$user_id = $_POST['user_id'];
			$type = $_POST['type'];
			$url = $_POST['url'];
			$result = $this->media_model->add_yt_flux($user_id, $type, $url);
			echo json_encode($result);
		}
	}
	
	//delete yt video
	public function delete_yt_video(){
		if(IS_AJAX){
			$id = $_POST['id'];
			$result = $this->media_model->delete_yt_video($id);
			echo json_encode($result);
		}
	}
	
	public function delete_yt_feed(){
		if(IS_AJAX){
			$id = $_POST['id'];
			$result = $this->media_model->delete_yt_feed($id);
			echo json_encode($result);
		}
	}
	
	
	/*****SOUND*****/
	//sound
	function dialog_add_tracks(){
		if(IS_AJAX){
			//$this->load->library('getid3/getid3');
			//$ThisFileInfo		= $this->getid3->analyze('users/146/sound/GameJAM-bitcheeeezz.mp3');
			$data = array('session_id' => $this->session->userdata('session_id')
			//,'ThisFileInfo' => $ThisFileInfo
			);
			$result = $this->load->view('sound/tpl_dialog_add', $data, true);
			echo $result;
		}
	}

	function upload_track(){
		if(IS_AJAX){
			$data = array('file_id' => $_POST['file_id']);
			$result = $this->load->view('sound/tpl_upload_track', $data, true);
			echo $result;
		}
	}

	function add_track(){
		if(IS_AJAX){
			//get metadata (duration, etc..)
			$this->load->library('mp3file', array('file_name' => './temp/'.$_POST['file_name']));
			$this->load->library('getid3/getid3');
			$data = array(
				'user_id' 		=> $this->user['id'],
				'playlist_id'	=> 0,
				'title'			=> $_POST['title'],
				'file_name'		=> $_POST['file_name'],
				'url'			=> '/users/'.$this->user['id'].'/sound/'.$_POST['file_name'],
//			'metadata'		=> serialize($this->mp3file->get_metadata())
			'metadata'		=> serialize($this->getid3->analyze('./temp/'.$_POST['file_name']))

			);
			$result = $this->media_model->add_track($data);
			echo json_encode($result);
		}
	}

	function delete_track(){
		if(IS_AJAX){
			$data = array(
				'id'	=> $_POST['track_id'],
				'url'	=> $_POST['track_url']
			);
			$result = $this->media_model->delete_track($data);
			echo json_encode($result);
		}
	}

	//soundcloud
	function redirect_sc(){
		echo '<html lang="en">
			<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<title>Connect with SoundCloud</title>
			</head>
			<body onload="window.opener.setTimeout(window.opener.SC.connectCallback, 1)">
				<b style="width: 100%; text-align: center;">This popup should automatically close in a few seconds</b>
			</body>
			</html>';
	}

	function add_sc(){
		if(IS_AJAX){
			$data = array(
				'sc_user'		=> json_decode($_POST['sc_user'], true),
				'sc_playlists'	=> json_decode($_POST['sc_playlists'], true),
				'sc_tracks'		=> json_decode($_POST['sc_tracks'], true)
			);

			$result = $this->media_model->add_sc($this->user['id'], $data);
			echo json_encode($result);
		}
	}

	function dialog_add_sc(){
		if(IS_AJAX){
			echo $this->load->view('soundcloud/tpl_dialog_add', json_decode($_POST['sc_user'], true), true);
		}
	}

	function show_add_sc(){
		if(IS_AJAX){
			$data = array(
				'sc_user'		=> json_decode($_POST['sc_user'], true),
				'sc_playlists'	=> json_decode($_POST['sc_playlists'], true),
				'sc_tracks'		=> json_decode($_POST['sc_tracks'], true)
			);
			echo $this->load->view('soundcloud/tpl_add', $data, true);
		}
	}

	function delete_sc(){
		if(IS_AJAX){
			$result = $this->media_model->delete_sc($this->user['id'], $_POST['sc_user_id']);
			echo json_encode($result);
		}
	}

	function exist_sc(){
		if(IS_AJAX){
			$user_id = $this->user['id'];
			$sc_id = $_POST['sc_id'];

			$result = $this->media_model->exist_sc($user_id, $sc_id);
			echo json_encode($result);
		}
	}

	function update_visibility_track_sc(){
		if(IS_AJAX){
			$result = $this->media_model->update_visibility_track_sc($_POST['track_id'], $_POST['visible']);
			echo json_encode($result);
		}
	}

	/********** PHOTOS **********/
	function dialog_add_photos(){
		if (IS_AJAX){
			//title album
			$data['title_album_photo'] = array(
				'name'			=> 'title-album-photo',
				'id'			=> 'title-album-photo',
				'style'			=> 'width:250px;',
				'value'			=> '',
				'class'			=> 'input grey ui-corner-all fs-13 bold',
				'placeholder'	=> 'Saisir un titre d\'album'
			);
			$all_albums_photos = $this->media_model->get_albums_photos($this->user['id']);
			$exist_title_album_photo = new ArrayObject();
			$exist_title_album_photo->offsetSet( 'no', 'Ajouter dans un album existant');
			foreach($all_albums_photos as $ap){
				$exist_title_album_photo->offsetSet($ap['id'], $ap['title']);
			}
			$data['title_albums_photos'] = array(
				'name'			=> 'title-albums-photos',
				'options'		=> $exist_title_album_photo,
				'selected'		=> '0',
				'js'			=> 'id="title-albums-photos"'
			);
			echo $this->load->view('photo/tpl_add', $data, true);
		}
	}

	function add_album_photo(){
		if (IS_AJAX){
			$user_id = $this->user['id'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$count_photo = $_POST['count_photo'];

			$data = array(
				'user_id'		=> $user_id,
				'title'			=> $title,
				'created_on'	=> date('c'),
				'description'	=> $description,
				'count_photo'	=> $count_photo
			);

			$result = $this->media_model->add_album_photo($data);
			echo json_encode($result);
		}
	}

	function update_album_count_photo(){
		if(IS_AJAX){
			$data = array(
				'album_id'		=> $_POST['album_id'],
				'count_photo'	=> $_POST['count_photo']
			);
			$result = $this->media_model->update_count_photo($data);
			echo json_encode($result);
		}
	}

	function show_album_photo(){

		if(IS_AJAX){
			$album_id = $_POST['album_id'];
			$album = $this->media_model->get_album_photo($album_id);
			$album_photo = array(
					'id'			=> $album['id'],
					'title'			=> $album['title'],
					'description'	=> $album['description'],
					'count_photo'	=> $album['count_photo'],
					'thumb_url'		=> site_url($this->media_model->get_thumb_album_photo($album_id))
				);
			echo json_encode(array('status' => true, 'text' => $this->load->view('page/template_album_photo', $album_photo, true)));
		}
	}

	function add_photo(){
		if (IS_AJAX){
			$user_id = $this->user['id'];
			$img_name = $_POST['img_name'];
			$thumb_name = $_POST['thumb_name'];
			$album_id = $_POST['album_id'];
			$data = array(
				'user_id'		=> $user_id,
				'temp_url'		=> 'temp/'.$img_name,
				'temp_thumb_url'=> 'temp/'.$thumb_name,
				'photo' => array(
					'album_id'		=> $album_id,
					'url'			=> '/users/'.$user_id.'/photo/'.$album_id.'/'.$img_name,
					'thumb_url' 	=> '/users/'.$user_id.'/photo/'.$album_id.'/'.$thumb_name
				)
			);
			$result = $this->media_model->add_photo($data);
			echo json_encode($result);
		}
	}

	function json_feed_photo(){
		if(IS_AJAX){
			$album_id = $_POST['album_id'];
			$photos = $this->media_model->get_photos($album_id);
			echo json_encode(array('photos' => $photos));
		}
	}

	/********** PICASA ***********/
	function add_pi_user(){
		if(IS_AJAX){
			$user_id = $_POST['user_id'];
			$type = 'user';
			$url = $_POST['url'];
			$result = $this->media_model->add_pi_user($user_id, $type, $url);
			echo json_encode($result);
		}	

	}

	public function delete_pi_user(){
		if(IS_AJAX){
			$id = $_POST['id'];	
			$result = $this->media_model->delete_pi_user($id);
			echo json_encode($result);
		}
	}
	
	public function show_pi_user(){
		if(IS_AJAX){
			$pi_user = array(
				'id'		=> $_POST['id'],
				'name'		=> $_POST['name'],
				'link'		=> $_POST['link'],
				'thumbnail'	=> $_POST['thumbnail'],
				'entry'		=> isset($_POST['entry']) ? $_POST['entry'] : null		
			);				
				
			echo $this->load->view('picasa/tpl_edit', $pi_user, true);			
		}	
	}
	
	/**********VIDEOS**********/
	function add_video(){
		if (IS_AJAX){
			$user_id = $this->user['id'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$url = $_POST['url'];
			$temp_url = $_POST['temp_url'];
			$data = array(
				'user_id'		=> $user_id,
				'title'			=> $title,
				'description'	=> $description,
				'url'			=> $url,
				'temp_url'		=> $temp_url,
				'created_on'	=> date('c')
			);
			$result = $this->media_model->add_video($data);
			echo json_encode($result);
		}
	}

	
	/////////////EMAIL////////////////////////////
	public function tpl_send_email(){
		if(IS_AJAX){			
			echo $this->load->view('contact/form_contact','', true);			
		}	
	}
	
	
	public function send_email(){
	
		if(IS_AJAX){			
			$data = array(
				'name'		=> $_POST['name'],
				'from' 		=> $_POST['from'],
				'to'		=> $_POST['to'],
				'subject_1'	=> $_POST['subject_1'],
				'subject_2'	=> $_POST['subject_2'],
				'message'	=> $_POST['message']
			);
			//send email
			$html_message = $this->parser->parse('user/email/send_email', $data, TRUE);				
			$this->email->from($data['from'], 'b-onstage');
			$this->email->to($data['to']);			
			$this->email->subject('Formulaire contact | '.$data['subject_1'].' | '.$data['subject_2']);
			$this->email->message($html_message);
			if($this->email->send())
				echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("contactus_email_success")));
			else
				echo json_encode(array('status' => 'ERROR', 'msg' => lang("contactus_email_error")));		
		}
	}
	
	public function tpl_send_msg(){
		if(IS_AJAX){
			echo $this->load->view('contact/form_msg','', true);
		}
	}
	
	public function send_msg(){
	
		if(IS_AJAX){
				
			$data = array(
				'from'		=> $this->user['email'],
				'to'		=> $_POST['to'],
				'subject'	=> $_POST['subject'],
				'message'	=> $_POST['message']
			);	
			
			$html_message = $this->parser->parse('user/email/send_msg', $data, TRUE);				
			$this->email->from($data['from'], $this->user['username'].' | b-onstage.com');
			$this->email->to($data['to']);			
			$this->email->subject($data['subject']);
			$this->email->message($html_message);
			if($this->email->send())		
				echo json_encode(array('status' => 'SUCCESS', 'msg' => lang("users_contact_send_success")));
			else
				echo json_encode(array('status' => 'ERROR', 'msg' => lang("error_retry")));		
		}
	}
	
	
	////////////////////////CALLBACKS/////////////////////////
	function terms_of_services($str) {
		if($str !== 'yes') {
			return false;
		} else {
			return true;
		}
	}

	function groups_menu($str){
		if($str == 'error') {
			//$this->form_validation->set_message('groups_menu', 'Sélectionnez un type de compte');
			return false;
		} else {
			return true;
		}

	}
}