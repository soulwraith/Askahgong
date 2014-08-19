<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	}

	public function index()
	{
		
		$this->render_page('page_terms',false,"");
		
		
	}
	

	
	
}
