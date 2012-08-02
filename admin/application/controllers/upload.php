<?php

class Upload extends CI_Controller {
    
       private $imagesFolder;
       private $imagesURL;
       
       private $thumbFolder;
       public $config =    array(); 
       public $configImg = array();
	
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
                $this->load->model('post_model');
                $data['post'] = $this->post_model->get_all();
                //if post is set load data to the form
                $this->load->view( 'upload_form', $data );
	}

	function do_upload( $thumbSize = 75)
	{   
                
                
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000000';
		$config['max_width']  = '4048';
		$config['max_height']  = '4048';
                
		$this->load->library('upload', $config);
                
                $this->upload->initialize($config);

		if ( ! $this->upload->do_upload() )
		{
                          $this->load->model('post_model');  
			  $this->post_model->insert();
                          $this->load->view('upload_success');;
                        
		}
		else
		{
			 $imgData = $this->upload->data();
                         
                         // for bottom containers generate smaller icons
                         
                         if( (int)$_POST['id'] >= 2){
                             $thumbSize = 22;
                         }
                                                      
                        //Image and thumbnail config
                        $this->configImg['source_image']  =       $imgData['full_path'];
                        $this->configImg['new_image']  =          $imgData['file_path'];
                        $this->configImg['thumb_marker']=         '_thumb';  
                        $this->configImg['create_thumb'] =        TRUE;
                        $this->configImg['maintain_ratio'] =      TRUE;
                        $this->configImg['width']	 =        $thumbSize;
                        $this->configImg['height']	=         $thumbSize;
                     

                        $this->load->library('image_lib',$this->configImg);

                        if ( ! $this->image_lib->resize() )
                        {
                             $error = $this->image_lib->display_errors();
                             return $error;
                        }
                        else{
                            //save the data to the database
                            $this->load->model('post_model');
                            $this->imagesURL    =  $imgData['file_path'];//path described by URL  
                            //construct path to the thumbnail  for ex. ./uploadsfloder/imagename_thumbprefix.jpg
                            $adminPath = $config['upload_path'].$imgData['raw_name'].$this->configImg['thumb_marker'].$imgData['file_ext'];
                            $this->post_model->insert( $adminPath );
                            $this->load->view('upload_success');
                                             
                         
                        }
                    }
            }
	
}
?>