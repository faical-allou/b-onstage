<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

	function __construct($options=null) {
		parent::__construct(); 		
		
	}
	
	function do_upload($session_id){		
		
		session_id($session_id);
		session_start();
		
		$config['upload_path'] = './temp';
        $config['allowed_types'] = '*';
        $config['max_size']    = '1000000000'; //large size
        $config['max_width']  = '102400';
        $config['max_height']  = '76800';
        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload('uploadfile')){
            echo $this->upload->display_errors();           
        }else{
            echo $this->upload->data();
        } 
		
	}
	
	//function upload cover
	function cover($session_id){
		
		session_id($session_id);
		session_start();
		
		$config['upload_path'] = './temp';
        $config['allowed_types'] = '*';
        $config['max_size']    = '1000000000'; //large size        
        $this->load->library('upload', $config);
		
        if(!$this->upload->do_upload('uploadfile')){
			echo $this->upload->display_errors();           
        }else{
			$datafile = $this->upload->data();	
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['overwrite'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['master_dim'] = 'width';
			$config['width'] = 880;			
			$config['height'] = 300;			
			$this->load->library('image_lib',$config); 			
			if ($this->image_lib->resize())						
				echo json_encode($datafile);			
			else
				 echo $this->image_lib->display_errors();				
        }
	}
	
	//avatar
	function avatar($session_id){
		
		session_id($session_id);
		session_start();
		
		$config['upload_path'] = './temp';
        $config['allowed_types'] = '*';
        $config['max_size']    = '1000000000'; //large size        
        $this->load->library('upload', $config);
		
        if(!$this->upload->do_upload('uploadfile')){
			echo $this->upload->display_errors();           
        }else{
			$datafile = $this->upload->data();	
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['overwrite'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['master_dim'] = 'width';
			$config['width'] = 240;
			$config['height'] = 240;			
			$this->load->library('image_lib',$config); 			
			
			if ($this->image_lib->resize())						
				echo json_encode($datafile);			
			else
				 echo $this->image_lib->display_errors();				
        }
	}
	//sound
	function track($session_id){	
		
		session_id($session_id);
		session_start();
		
		$config['upload_path'] = './temp';
        $config['allowed_types'] = '*';
        $config['max_size']    = '1000000000'; //large size        
        $this->load->library('upload', $config);
		
        if(!$this->upload->do_upload('uploadfile')){
			echo $this->upload->display_errors();           
        }
		else{
			$datafile = $this->upload->data();
			echo json_encode($datafile);			
		}	
	}
	
	
	//photos
	function photo($session_id){
		
		session_id($session_id);
		session_start();
		
		$config['upload_path'] = './temp';
        $config['allowed_types'] = '*';
        $config['max_size']    = '1000000000'; //large size        
        $this->load->library('upload', $config);
		
        if(!$this->upload->do_upload('uploadfile')){
			echo $this->upload->display_errors();           
        }
		else{
			$datafile = $this->upload->data();			
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 144;
			$config['height'] = 144;

			$this->load->library('image_lib', $config);

			if ($this->image_lib->resize())
				echo json_encode($datafile);			
			else
				 echo $this->image_lib->display_errors();			
        }
	}
	
	//vidéo
	function video($session_id){
		
		session_id($session_id);
		session_start();
		
		$config['upload_path'] = './temp';
        $config['allowed_types'] = '*';
        $config['max_size']    = '1000000000'; //large size        
        $this->load->library('upload', $config);
		
        if(!$this->upload->do_upload('uploadfile')){
			echo $this->upload->display_errors();           
        }else{
			$datafile = $this->upload->data();	
			echo json_encode($datafile);						
        }
	}
}