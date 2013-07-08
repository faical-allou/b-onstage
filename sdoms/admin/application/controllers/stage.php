<?php
class Stage extends CI_Controller {
		
	function __construct()
	{
		parent::__construct();	
		$this->load->database();	
		$this->load->model('stage_model');
		$this->load->model('notification_model');
			
	}
	/********** ADD STAGE **********/
	public function index(){						
		
		if(!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')){		
			redirect('', 'refresh');
		} else {		
			//header		
			$header['title'] = 'Stages | b-onstage';
			$header['description'] = 'Stages b-onstage';		
			
			//menu
			$menu['menu_id'] = '#stage-menu';
			
			//data
			$stages = $this->stage_model->get();
			$data['message'] = $this->session->flashdata('message') ? $this->session->flashdata('message') : '';
			$data['stages'] = $stages;
			
			//footer
			$footer['scripts'] = array(
				'js/datatable/js/jquery.dataTables.min.js',
				'js/main-stage.js');			
			
			$this->load->view('_header',$header);
			$this->load->view('_menu',$menu);
			$this->load->view('stage/index', $data);				
			$this->load->view('_footer',$footer);	
		}
		
	}
	
	
	public function add(){								
		if(!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')){		
			redirect('', 'refresh');
		} else {		
			//header		
			$header['title'] = 'Add stage | b-onstage';
			$header['description'] = 'Add stage b-onstage';	
			
			//menu
			$menu['menu_id'] = '#stage-menu';
			
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');			
			
			$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean||min_length[5]|max_length[25]|is_unique[users.username]');
			$this->form_validation->set_rules('email', 'identity', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'confirm password', 'trim|required');
			
			$this->form_validation->set_rules('company', 'company', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');
			$this->form_validation->set_rules('zip', 'zip', 'trim|required');
			$this->form_validation->set_rules('city', 'city', 'trim|required');
			$this->form_validation->set_rules('country', 'country', 'trim|required');
			
			$this->form_validation->set_rules('first-name', 'first name', 'trim|required');
			$this->form_validation->set_rules('last-name', 'last name', 'trim|required');
			$this->form_validation->set_rules('phone', 'phone', 'trim|required');			
			
			if ($this->form_validation->run() == true){			
				
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = $this->input->post('password');							
						
				$additional_data = array(
					'company'	=> $this->input->post('company'),
					'address'	=> $this->input->post('address'),
					'zip'		=> $this->input->post('zip'),
					'city'		=> $this->input->post('city'),
					'country'	=> $this->input->post('country'),
					'first_name'=> $this->input->post('first-name'),
					'last_name'	=> $this->input->post('last-name'),
					'phone'		=> $this->input->post('phone'),
					
					
				);
				
				$groups = array('3');//stage
				
				//register
				$insert_id = $this->ion_auth->register($username, $password, $email, $additional_data,$groups);
				
				if($insert_id){								
					//update avatar and cover path
					directory_copy('../../users/default','../../users/'.$insert_id);						
					$url_avatar = 'users/'.$insert_id.'/img/avatar.jpg';
					$url_cover = 'users/'.$insert_id.'/img/cover.jpg';
					$update_data = array(
						'avatar'	=> $url_avatar ,
						'cover'		=> $url_cover
					);
					$this->ion_auth->update($insert_id, $update_data);	
					
					//send email to stage
					$data = array(
						'email'					=> $email,
						'pseudo'				=> $username,
						'password'				=> $password,
						'url_profil'			=> 'http://www.b-onstage.com/page/'.$username,
						'url_work'				=> 'http://www.b-onstage.com/how_does_this_work'
					);
					
					//add notification
					$this->notification_model->add($insert_id,'Bienvenue sur b-onstage',3);
					
					$html_message = $this->parser->parse('email/confirm_inscription', $data, TRUE);				
					$this->email->from('contact@b-onstage.com', 'b-onstage');
					$this->email->to($email);
					$this->email->cc('scenes@mybandonstage.com');
					$this->email->subject('Confirmation de votre inscription à b-onstage');
					$this->email->message($html_message);
					$this->email->send();
						
					$this->session->set_flashdata('message', "Stage created success");
					redirect('stage', 'refresh');
				}
				
			} else {							
				
				//set message
				$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

				/**********IDENTICATION**********/
				//username
				$data['label_username'] = 'Username';
				$data['username'] = array(						
					'name'		=> 'username',					
					'id'		=> 'username',
					'value'		=> $this->form_validation->set_value('username')
				);

				//email
				$data['label_email'] = 'Email';
				$data['email'] = array(
					'name'		=> 'email',					
					'id'		=> 'email',
					'value'		=> $this->form_validation->set_value('email')
				);

				//password
				$data['label_password'] = 'Password';
				$data['password'] = array(
					'name'		=> 'password',					
					'id'		=> 'password',
					'value'		=> $this->form_validation->set_value('password')
				);

				//password confirm
				$data['label_password_confirm'] = 'Confirm password';
				$data['password_confirm'] = array(					
					'name'		=> 'password_confirm',												
					'id'		=> 'password_confirm',
					'value'		=> $this->form_validation->set_value('password_confirm')
				);	

				
				/********** ADDITIONAL DATA ***********/
				//company
				$data['label_company'] = 'Company';
				$data['company'] = array(											
					'name'		=> 'company',					
					'id'		=> 'company',
					'value'		=> $this->form_validation->set_value('company')
				);
				
				//address
				$data['label_address'] = 'Address';
				$data['address'] = array(											
					'name'		=> 'address',					
					'id'		=> 'address',
					'value'		=> $this->form_validation->set_value('address')
				);
				
				//zip
				$data['label_zip'] = 'Zip';
				$data['zip'] = array(											
					'name'		=> 'zip',					
					'id'		=> 'zip',
					'value'		=> $this->form_validation->set_value('zip')
				);

				//city
				$data['label_city'] = 'City';
				$data['city'] = array(											
					'name'		=> 'city',					
					'id'		=> 'city',
					'value'		=> $this->form_validation->set_value('city')
				);
				
				//country
				$data['label_country'] = 'Country';
				$data['country'] = array(											
					'name'		=> 'country',					
					'id'		=> 'country',
					'value'		=> $this->form_validation->set_value('country')
				);
				
				//first name
				$data['label_first_name'] = 'First name';
				$data['first_name'] = array(											
					'name'		=> 'first-name',					
					'id'		=> 'first-name',
					'value'		=> $this->form_validation->set_value('first-name')
				);
						
				//last name
				$data['label_last_name'] = 'Last name';
				$data['last_name'] = array(											
					'name'		=> 'last-name',					
					'id'		=> 'last-name',
					'value'		=> $this->form_validation->set_value('last-name')
				);
				
				//phone
				$data['label_phone'] = 'Phone';
				$data['phone'] = array(											
					'name'		=> 'phone',					
					'id'		=> 'phone',
					'value'		=> $this->form_validation->set_value('phone')
				);			
			
				//footer
				$footer['scripts'] = array(					
					'js/main-add-stage.js');			
			
				//render page
				$this->load->view('_header',$header);
				$this->load->view('_menu',$menu);
				$this->load->view('stage/add', $data);				
				$this->load->view('_footer', $footer);	
			}	
		}		
	}	
	
	public function delete(){
		if(IS_AJAX){
		
			$id = $_POST['stage_id'];
			
			//users
			if(!$this->db->where('id', $id)->delete('users')){			
				echo json_encode(array('status' => 'ERROR'));
			}
			
			//users groups
			$this->db->where('user_id', $id)->delete('users_groups');
			
			//tracks
			$this->db->where('user_id', $id)->delete('tracks');
			
			//sc sound
			$this->db->where('user_id', $id)->delete('sc_sounds');
			
			//yt medias
			$this->db->where('user_id', $id)->delete('yt_medias');
			
			//albums photos			
			$this->db->where('user_id', $id)->delete('albums_photos');
			
			//photos
			
			//pi photos			
			$this->db->where('user_id', $id)->delete('pi_photos');
			
			//events
			$this->db->where('stage_id', $id)->delete('events');
			
			//notifications
			$this->db->where('user_id', $id)->delete('notifications');
			
			//reservations
			$this->db->where('stage_id', $id)->delete('reservations');
			
			//contact
			$this->db->where('user_id', $id)->or_where('user_contact', $id)->delete('contacts');
		
			
		
		}	
	}
}	