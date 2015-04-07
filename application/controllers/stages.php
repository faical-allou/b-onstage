<?php

class Stages extends CI_Controller {

	

	public $user;

	

	function __construct()

	{

		parent::__construct();

		$this->user = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row_array() : null;			
		$this->load->model('stage_model');		
		$this->load->model('event_model');		
		$this->load->model('social_model');
		
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
			$search['search-city'] = '';
		}				

		$this->load->vars(array('search' => $search));	

	}

	

	public function index($page)

	{

		//header vars

		$header = array(

			'title' => lang("user_stage_title"),
			'description' => lang("user_stage_desc")

		);	

		

		$per_page = 20;		
		$stages = $this->stage_model->get_all('','',$per_page,$page);
		$stages_list = '';
		$stages_formap = $this->stage_model->get_all_formap();
		
		if($stages['nb_stages'] > 0) {

			foreach($stages['stages'] as $sta){							

				$stage_link = $sta['web_address'] ? site_url($sta['web_address']) : site_url('page/'.$sta['username']);				
				$stage_state = ($this->ion_auth->logged_in() && ($sta['id'] != $this->session->userdata('user_id'))) ? 1 : 0;				

				$stage = array(										

					'stage_state'	=> $stage_state,
					'stage_id'		=> $sta['id'],
					'stage_email'	=> $sta['email'],
					'stage_company'	=> $sta['company'],
					'stage_location'=> $sta['country'].', '.$sta['city'],
					'avatar_link'	=> anchor($stage_link, img(array('src' => site_url($sta['avatar']), 'width' => '120px', 'class' => 'ui-corner-all')), array('class' => 'mr-20')),
					'stage_link'	=> $stage_link,
					//'facebook_link'	=> (!empty($sta['facebook'])) ? anchor($sta['facebook'],'<span aria-hidden="true" class="icon-facebook fs-28 grey"></span>') : false,
					//'twitter_link'	=> (!empty($sta['twitter'])) ? anchor($sta['twitter'],'<span aria-hidden="true" class="icon-twitter fs-28 grey"></span>') : false,				
					//'nb_members'		=> count($art['members']),
					//'members'			=> $art['members'],
					//'nb_concerts'		=> count($art['concerts']),
					//'concerts'		=> $art['concerts'],
					//'nb_tracks'		=> count($art['tracks']),
					//'tracks'			=> $art['tracks']		

				);					

				$stages_list .= $this->load->view('stage/tpl_stage', $stage, true);

			}

		} else 

			$stages_list = '<div class="p-20 bg-white ui-corner-bottom">'.heading(lang("noresultfound"), 2, 'class="title grey fs-18 normal"').'</div>';

		

		//nb pages

		$nb_pages = ceil($stages['nb_stages'] / $per_page);

		//filter name		

		$filter_name = array(

			'name'			=> 'filter-name',
			'id'			=> 'filter-name',
			'class'			=> 'input ui-corner-all fs-16',				
			'placeholder'	=> lang("stages_searchby")		

		);

		//filter location		

		$filter_location = array(

			'name'			=> 'filter-location',
			'id'			=> 'filter-location',
			'class'			=> 'input ui-corner-all fs-16',				
			'placeholder'	=> lang("artists_searchbycity")		

		);

		

		//filter musical genre

		/*****GET SOCIAL INFOS*****/
		$social_sidebar = $this->social_model->get_all();
		$social_sidebar = $this->load->view('social/tpl_sidebar', $social_sidebar, true);

		$data = array(						

			'filter_name'		=> $filter_name,
			'filter_location'	=> $filter_location,
			'stages_list'		=> $stages_list,
			'nb_pages'			=> $nb_pages,
			'per_page'			=> $per_page,
			'page'				=> $page,
			'social_sidebar'	=> $social_sidebar,
			'stages_formap'		=> $stages_formap				

		);

		

		//footer vars

		$footer['scripts'] = array('js/stage.js', 'js/main-stage.js');

		//show page

		$this->load->view('_header', $header);
		$this->load->view('stage/index',$data);
		$this->load->view('_footer', $footer);
	}	

	

	public function show(){

	if(IS_AJAX){

			$stages_list = '';
			$per_page = $_POST['per_page'];
			$page = $_POST['page'];
			$location = $_POST['location'];
			$name = $_POST['name'];

			//musical genre

			$stages = $this->stage_model->get_all($name,$location,$per_page, $page);

			

			if($stages['nb_stages'] > 0) {

				foreach($stages['stages'] as $sta){												

					$stage_link = $sta['web_address'] ? site_url($sta['web_address']) : site_url('page/'.$sta['username']);
					$stage_state = ($this->ion_auth->logged_in() && ($sta['id'] != $this->session->userdata('user_id'))) ? 1 : 0;
					$stage = array(						

						'stage_state'	=> $stage_state,
						'stage_id'		=> $sta['id'],
						'stage_email'	=> $sta['email'],
						'stage_company'	=> $sta['company'],
						'stage_location'=> $sta['country'].', '.$sta['city'],
						'avatar_link'	=> anchor($stage_link, img(array('src' => site_url($sta['avatar']), 'width' => '120px', 'class' => 'ui-corner-all')), array('class' => 'mr-20')),
						'stage_link'	=> $stage_link
						//'facebook_link'	=> (!empty($sta['facebook'])) ? anchor($sta['facebook'],'<span aria-hidden="true" class="icon-facebook fs-28 grey"></span>') : false,
						//'twitter_link'	=> (!empty($sta['twitter'])) ? anchor($sta['twitter'],'<span aria-hidden="true" class="icon-twitter fs-28 grey"></span>') : false,				
						//'nb_members'	=> count($art['members']),
						//'members'		=> $art['members'],
						//'nb_concerts'	=> count($art['concerts']),
						//'concerts'		=> $art['concerts'],
						//'nb_tracks'		=> count($art['tracks']),
						//'tracks'		=> $art['tracks']		

					);						

					$stages_list .= $this->load->view('stage/tpl_stage', $stage, true);

				}			

			} else

				$stages_list = '<div class="p-20 bg-white ui-corner-bottom">'.heading(lang("noresultfound"), 2, 'class="title grey fs-18 normal"').'</div>';

			$show_more = ($stages['nb_stages'] <= ($page * $per_page)) ? 0 : 1;

			echo json_encode(array('text' => $stages_list, 'show_more' => $show_more));

		}	

	}

	

	public function get_location(){

		if(IS_AJAX){

			$term = $_GET['term'];
			$result = array();
			$locations = $this->stage_model->get_location($term);

			foreach($locations as $location){				

				if(empty($location['city'])) continue;				
				array_push($result,array('value'=>$location['city']));

			}

			echo json_encode($result);		

		}	

	}

	

	public function get_name(){

		if(IS_AJAX){

			$term = $_GET['term'];
			$result = array();
			$names = $this->stage_model->get_name($term);

			foreach($names as $name){

				if(empty($name['name'])) continue;
				array_push($result, array('value'=>$name['name']));	

			}

			echo json_encode($result);

		}	

	}

	

	private function _get_data($json_url=''){

		$json_data = file_get_contents($json_url);

		return json_decode($json_data);		

	}

	

}

