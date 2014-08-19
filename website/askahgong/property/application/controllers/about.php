<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	 	$this->load->model("cms_model");
	}

	public function index()
	{
		redirect("about/title");
	
	}
	
	

	
	public function title($title="introduction"){
		GLOBAL $data;
		$this->cms_model->get_anchors();
		$this->cms_model->get_anchor_content($title);
		if($title=="sms") $title="SMS";
		$data['title']=$title;
		
	
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			if($data['anchor_content']==""){
				$data["404"] = true;
				return;
			} 
			
			
		});
		
		
		$data["page_width"] = 1170;
		$this->render_page('page_about',false,"about","no-responsive");


	}
	
	
	
}

