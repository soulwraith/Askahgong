<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	 	$this->load->model('activity_model');
		 $this->load->model('user_model');
	}

	public function index($userid=0)
	{
		
		GLOBAL $data;
		
		$forcelogin=false;
		
		$ownuserid=get_userid();
		if(($userid==$ownuserid && $ownuserid!=0) || ($userid==0 && $ownuserid!=0) || ($userid==0 && $ownuserid==0)) {
			$userid=$ownuserid;
			$data["type"]="my";
			$forcelogin=true;
		}
		else{
			$data["type"]="others";
		}
		

		$this->user_model->get_user_by_userid($ownuserid,$userid);	
		
		if($data["type"]=="my"){
			$data["limit"]=5;
			$this->activity_model->get_activities_of_mine(0,$userid,$data["limit"]);
		}
		else if($data["type"]="others"){
			$data["limit"]=10;
			$this->activity_model->get_activities_of_others(0,$ownuserid,$userid,$data["limit"]);
		}
		
		
		$data["dashboard_page"]="home";

		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			if($data['user']==""){
				$data["404"] = true;
				return;
			} 
			$data['activities']=handle_activity_array($data['activities'],$data["type"]);
		});
				
		$this->render_page('page_dashboard',$forcelogin,"profile");
	
	}
	
	

	
	public function get_more_my_acitivity($lastid){
		precheck_login_before_db();
		GLOBAL $data;
		$userid=get_userid();
		
		$data["limit"]=10;
		$this->activity_model->get_activities_of_mine($lastid,$userid,$data["limit"]);
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['activities']=handle_activity_array($data['activities'],"my");
		
		});
		commitTasks();
		
		$this->load->view("layout_controls/activities_listing",$data);
	}
	
	public function get_more_people_acitivity($targetid,$lastid){
		$userid=get_userid();
		
		if($lastid=="") echo "";
		
		GLOBAL $data;
		$data["limit"]=10;
		$this->activity_model->get_activities_of_others($lastid,$userid,$targetid,$data["limit"]);
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['activities']=handle_activity_array($data['activities'],"others");
		
		});
		commitTasks();
		
		$this->load->view("layout_controls/activities_listing",$data);
	}
	
	
	
}

