<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redirect extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
		$this->load->model('user_model');
	}

	public function index()
	{
	

	}
	
	public function directto($type,$reserved=0,$reserved2=0){
		GLOBAL $data;
		$data['type']=$type;
		$data['reserved']=$reserved;
		$data['reserved2']=$reserved2;
		$this->render_page('page_redirect',false,"","no-banner no-index");
	}
	
	
	public function cannot_access(){
		$this->render_page('page_cannot_access',false,"");
	}
	
	public function login_redirect(){
		$this->user_model->get_has_update_profile_by_userid(get_userid());
		commitTasks();
		GLOBAL $data;
		if(!$data['has_update_profile']){
			redirect("profile");
		}
		else{
			redirect("activity");
		}
	}
	
	
}

