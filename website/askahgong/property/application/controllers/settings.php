<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		 $this->load->model('user_model');
		 $this->load->model('notification_model');
		 $this->load->model('property_model');
		 $this->load->model('activity_model');
	}

	public function index()
	{
		GLOBAL $data;	
		$userid=get_userid();
		$data["dashboard_page"]="settings";
		
		$this->user_model->get_user_by_userid($userid,$userid);
		$this->property_model->get_propertylist_with_id();
		$this->notification_model->get_notification_settings($userid);
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['propertylist_with_id']=handle_propertylist_with_id($data['propertylist_with_id']);
		});
		
		$this->render_page('page_dashboard',true,"profile");
	}
	
	
	public function changepassword(){
		precheck_login_before_db();	
		$userid=get_userid();
		$this->activity_model->insert_activity(7,$userid,$userid);
		commitTasks();
		echo $this->user_model->submit_password($this->session->userdata('userid'),$this->input->post('password'),$this->input->post('originalpassword'));
		
	}

	
	
	
}

