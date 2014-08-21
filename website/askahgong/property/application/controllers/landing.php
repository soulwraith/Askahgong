<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
		$this->load->model("user_model");
	}

	public function index()
	{
		GLOBAL $data;
		$data["page_width"] = 1310;
		$this->render_page('page_landing',false,"landing","no-responsive no-banner");
	}
	
	public function submit_email(){
		$email=$this->input->post("email");
		echo $this->user_model->submit_subscript_email($email);
		
	}
	
	public function test(){
		$user = new stdClass;
		$user->phone = "60167203425";
		$user->username="Andy";
		watermark_item_photos(72,$user);
		
		//watermark_image("photo/72/abc.png","test\ngogogogogoo","photo/72/abcd.jpg");
	}
	
	
}

