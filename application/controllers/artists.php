<?php

class Artists extends CI_Controller {

	public $user;

	function __construct()

	{
		parent::__construct();

		$this->load->model('artist_model');
		$this->load->model('social_model');
		$this->user = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row_array() : null;			
		
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
			'title' => lang("user_artist_title"),
			'description' => lang("user_artist_desc")
		);		

		

		$per_page = 20;		
		$artists = $this->artist_model->get_all('','','',$per_page,$page);
		$artists_list = '';	

		if($artists['nb_artists'] > 0) {

			foreach($artists['artists'] as $art){							

				

				$artist_link = $art['web_address'] ? site_url($art['web_address']) : site_url('page/'.$art['username']);
				$artist_state = ($this->ion_auth->logged_in() && ($art['id'] != $this->session->userdata('user_id'))) ? 1 : 0;
				$artist = array(					

					'artist_state'	=> $artist_state,
					'artist_id'		=> $art['id'],
					'artist_email'	=> $art['email'],
					'artist_company'=> $art['company'],
					'artist_location'=> $art['country'].', '.$art['city'],
					'avatar_link'	=> anchor($artist_link, img(array('src' => site_url($art['avatar']), 'width' => '120px', 'class' => 'ui-corner-all')), array('class' => 'mr-20')),
					'artist_link'	=> $artist_link
					//'facebook_link'	=> (!empty($art['facebook'])) ? anchor($art['facebook'],'<span aria-hidden="true" class="icon-facebook fs-28 grey"></span>') : false,
					//'twitter_link'	=> (!empty($art['twitter'])) ? anchor($art['twitter'],'<span aria-hidden="true" class="icon-twitter fs-28 grey"></span>') : false,				
					//'nb_members'	=> count($art['members']),
					//'members'		=> $art['members'],
					//'nb_concerts'	=> count($art['concerts']),
					//'concerts'		=> $art['concerts'],
					//'nb_tracks'		=> count($art['tracks']),
					//'tracks'		=> $art['tracks']		

				);					

				$artists_list .= $this->load->view('artist/tpl_artist', $artist, true);

			}

		} else 

			$artists_list = '<div class="p-20 bg-white ui-corner-bottom">'.heading(lang("noresultfound"), 2, 'class="title grey fs-18 normal"').'</div>';			

		//nb pages

		$nb_pages = ceil($artists['nb_artists'] / $per_page);

		
		//filter name		

		$filter_name = array(

			'name'			=> 'filter-name',
			'id'			=> 'filter-name',
			'class'			=> 'input ui-corner-all fs-16',				
			'placeholder'	=> lang("artists_searchby")			

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
		

		// DATA
		$data = array(						

			'filter_name'		=> $filter_name,
			'filter_location'	=> $filter_location,
			'artists_list'		=> $artists_list,
			'nb_pages'			=> $nb_pages,
			'per_page'			=> $per_page,
			'page'				=> $page,
			'social_sidebar'	=> $social_sidebar			

		);

		

		//footer vars

		$footer['scripts'] = array('js/artist.js', 'js/main-artist.js');

		

		//show page

		$this->load->view('_header', $header);
		$this->load->view('artist/index',$data);
		$this->load->view('_footer', $footer);

	}		

	

	

	public function show(){

		if(IS_AJAX){

			$artists_list = '';
			$per_page = $_POST['per_page'];
			$page = $_POST['page'];
			$name = $_POST['name'];
			$location = $_POST['location'];

			//musical genre

			$artists = $this->artist_model->get_all($name,'',$location,$per_page, $page);
			
			if($artists['nb_artists'] > 0) {

				foreach($artists['artists'] as $art){						

					$artist_link = $art['web_address'] ? site_url($art['web_address']) : site_url('page/'.$art['username']);
					$artist_state = ($this->ion_auth->logged_in() && ($art['id'] != $this->session->userdata('user_id'))) ? 1 : 0;

					$artist = array(					

						'artist_state'	=> $artist_state,
						'artist_id'		=> $art['id'],
						'artist_email'	=> $art['email'],
						'artist_company'=> $art['company'],
						'artist_location'=> $art['country'].', '.$art['city'],
						'avatar_link'	=> anchor($artist_link, img(array('src' => site_url($art['avatar']), 'width' => '120px', 'class' => 'ui-corner-all')), array('class' => 'mr-20')),
						'artist_link'	=> $artist_link
						//'facebook_link'	=> (!empty($art['facebook'])) ? anchor($art['facebook'],'<span aria-hidden="true" class="icon-facebook fs-24 grey"></span>') : false,
						//'twitter_link'	=> (!empty($art['twitter'])) ? anchor($art['twitter'],'<span aria-hidden="true" class="icon-twitter fs-24 grey"></span>') : false				
						//'nb_members'	=> count($art['members']),
						//'members'		=> $art['members'],
						//'nb_concerts'	=> count($art['concerts']),
						//'concerts'		=> $art['concerts'],
						//'nb_tracks'		=> count($art['tracks']),
						//'tracks'		=> $art['tracks']		

					);	

					$artists_list .= $this->load->view('artist/tpl_artist', $artist, true);

				}			

			} else

				$artists_list = '<div class="p-20 bg-white ui-corner-bottom">'.heading(lang("noresultfound"), 2, 'class="title grey fs-18 normal"').'</div>';			

			$show_more = ($artists['nb_artists'] <= ($page * $per_page)) ? 0 : 1;

			echo json_encode(array('text' => $artists_list, 'show_more' => $show_more));

		}	

	}

	

	public function get_location(){

		if(IS_AJAX){

			$term = $_GET['term'];
			$result = array();
			$locations = $this->artist_model->get_location($term);

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
			$names = $this->artist_model->get_name($term);

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

