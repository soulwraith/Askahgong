<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		$this->load->model("error_model");
	}


	
	public function index()
	{
		
	}
	
	public function get_admin_html(){
		$this->error_model->get_errorsdata_totalcount();
		commitTasks();
		GLOBAL $data;
		$this->load->view("admin/controls/admin_door",$data);
	}
	
	
	
	
	
	
	
}	