<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discussion_manage extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		$this->load->model("discussion_model");
	}


	
	public function index()
	{
		$this->discussion_model->get_categories();
		commitTasks();
		GLOBAL $data;
		$results=$data["categories"];
		$categoryid=$results[0]->id;
		redirect("admin/discussion_manage/category/".$categoryid);
	}
	
	
	public function category($id=0){
		admin_validated();	
		$this->discussion_model->get_categories();
		GLOBAL $data;
		$data["currentcategoryid"]=$id;
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$results=$data["categories"];
			foreach($results as $result){
				if($result->id==$data["currentcategoryid"]){
					$data["currentcategory"]=$result;
					break;
				}
			}
			if(!isset($data["currentcategory"])) $data["currentcategory"]=$results[0];
		});
		
		
		$this->discussion_model->get_topic($id,999999,0);
		
		
		$this->render_page('admin/page_discussion_manage',true,"admin","no-banner");
		
	}

	public function delete_comment_admin(){
		admin_validated();	
		$commentid=$this->input->post("commentid");
		$this->discussion_model->delete_comment_admin($commentid);
		commitTasks();
	}
	
	public function move_topic($topicid){
		$tocategory=$this->input->post("tocategory");
		$categoryid=$this->discussion_model->get_categoryid_by_category($tocategory);
		if($categoryid==""){
			echo "0";
		}
		else{
			$this->discussion_model->update_topic_category($topicid,$categoryid);
			echo "1";
		}
	}
	
	public function toggle_topic_solved(){
		$topicid=$this->input->post("topicid");
		$this->discussion_model->toggle_topic_solved($topicid);
	}
	
	public function new_category(){
		$newcategory=$this->input->post("newcategory");
		$this->discussion_model->add_category($newcategory);
	}
	
	public function delete_category($categoryid){
		$this->discussion_model->delete_category($categoryid);
	}
	
	public function update_category($categoryid){
		$category=$this->input->post("category");
		$categorydescription=$this->input->post("categorydescription");
		$newsequence=$this->input->post("newsequence");
		$oldsequence=$this->input->post("oldsequence");
		$this->discussion_model->update_category($category,$categorydescription,$categoryid,$newsequence,$oldsequence);
		redirect("admin/discussion_manage/category/".$categoryid);
	}
	
	public function update_sequence($categoryid,$newsequence){
		$this->discussion_model->update_category_sequence($categoryid,$newsequence);
	}
	
	public function mark_as_helpful($type){
		admin_validated();	
		$commentid=$this->input->post("commentid");
		$userid=$this->input->post("userid");
		$this->discussion_model->mark_as_helpful($commentid,$type);
		$reward_type;
		if($type==1){
			$reward_type=4;
		}
		else if($type==2){
			$reward_type=5;
		}
		$this->points_model->add_points($userid,$reward_type,$commentid);
		commitTasks();
		
	}
	
	public function mark_as_goodtopic(){
		admin_validated();	
		$topicid=$this->input->post("topicid");
		$userid=$this->input->post("userid");
		$this->discussion_model->mark_as_goodtopic($topicid);
		$this->points_model->add_points($userid,9,$topicid);
		commitTasks();
		
	}
	
}	