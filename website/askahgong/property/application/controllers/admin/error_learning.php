<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_learning extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		$this->load->model("error_model");
		$this->load->model("points_model");
	}

	public function index()
	{
		admin_validated();
		
		$this->render_page('admin/page_error_learning',true,"admin","no-banner");
	}

	
	public function get_pending_error($id=0){
		if($id) $this->error_model->get_errorsdata_by_id($id);
		else $this->error_model->get_errorsdata();
		
		commitTasks();
		GLOBAL $data;
		$this->load->view("layout_controls/error_listing",$data);
	}
	
	public function set_handling($id){
		$username=$this->input->post("username");
		$this->error_model->set_handling($id,$username);
		commitTasks();
	}
	
	
	public function retry_learning(){
		$processid=$this->input->post("processid");
		$smsorweb=$this->input->post("smsorweb");
		
		if(!$this->error_model->check_in_learning($processid)) echo 0;
		
		$this->error_model->retry_learning($processid,$smsorweb);
		$this->error_model->set_to_notify($processid);
		commitTasks();
		echo 1;
	}
	
	public function delete_learning(){
		$processid=$this->input->post("processid");
		if(!$this->error_model->check_in_learning($processid)) echo 0;
		$this->error_model->delete_learning($processid);
		echo 1;
	}
		
	public function reject_learning(){
		$processid=$this->input->post("processid");
		$reason=$this->input->post("reason");
		if(!$this->error_model->check_in_learning($processid)) echo 0;
		$this->error_model->reject_learning($processid,$reason);
		echo 1;
	}	
	
	public function update_learning(){
		$processid=$this->input->post("processid");
		$reason=$this->input->post("reason");
		$waitingCode=$this->input->post("waitingcode");
		if(!$this->error_model->check_in_learning($processid)) echo 0;
		$this->error_model->update_learning($processid,$reason,$waitingCode);
		echo 1;
	}	
	
	public function award_from_learning(){
		$processid=$this->input->post("processid");
		$userid=$this->input->post("userid");
		$type=$this->input->post("type");
		$word=$this->input->post("word");
		$points_type;
		if($type=="facility"){
			$points_type=8;
			$this->error_model->mark_facility_awarded($processid);
		}
		else if($type=="location"){
			$points_type=7;
			$this->error_model->mark_location_awarded($processid);
		}
		
		$this->points_model->add_points($userid,$points_type,$word);
		commitTasks();
	}
	
	public function add_new_learning(){
		$text=$this->input->post("text");
		$userid=get_userid();
		$this->error_model->add_new_learning($text,$userid);	
		commitTasks();
	}
	
	public function change_user_text(){
		$processid=$this->input->post("processid");
		$text=$this->input->post("text");
		$this->error_model->update_user_text($processid,$text);	
		commitTasks();
	}
	
	

}	