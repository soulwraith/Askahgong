<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

    }
   
    function index(){
    	GLOBAL $data;
		$data["type"]="error";
		$data["reserved"]="500";
		$data["active"]="";
		$data["attrs"]="no-banner";
		$this->load->view('obj_header', $data);
   		$this->load->view('page_redirect',$data);
	
  		$this->load->view('obj_footer', $data);
		
    }
	
} 