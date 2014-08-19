<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My404 extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	
	}

	public function index()
	{
		GLOBAL $data;
		$data["type"]="error";
		$data["reserved"]="404";
		header("HTTP/1.1 404 Not Found");
		$this->render_page('page_redirect',false,"","no-banner 404");
	}
	
	

	
	
	


	
}

