<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Uploader extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('plupload');
    }
    function upload()
    {
    	header('Access-Control-Allow-Origin: *');  
        echo $this->plupload->process_upload($_REQUEST,$_FILES);
    }
	
	function do_upload(){
		$config['upload_path'] = 'upload';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		
		$this->load->library('upload', $config);
		
		// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
		$this->upload->initialize($config);
		$this->upload->do_upload("Filedata");
	}
	
	
} 