<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_manage extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		
	}


	
	public function index()
	{
		$this->user_model->get_all_users();
		commitTasks();
		GLOBAL $data;
		$this->render_page('admin/page_user_manage',true,"admin","no-banner");
	}
	
	public function change_role_level(){
		$userid=$this->input->post("userid");
		$tolevel=$this->input->post("tolevel");
		$this->user_model->update_role_level($userid,$tolevel);
		commitTasks();
	}
	
	public function change_phone_number(){
		$userid=$this->input->post("userid");
		$newphone=$this->input->post("newphone");
		
		if($this->user_model->check_phone_exist($newphone)){
			echo "0";
		}
		else{
			$this->user_model->update_phone($userid,$newphone);
			commitTasks();
			echo "1";
		}
		
		
	}
	
	
}	