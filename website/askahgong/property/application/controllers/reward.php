<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reward extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	    $this->load->model('points_model');
		$this->load->model('result_item_model');
	}

	function get_experience_panel_by_points_id(){
		$id=$this->input->post("points_id");
		$userid=get_userid();
		$this->points_model->get_unread_points_details_by_points_id($id);
		$this->result_item_model->get_itemsdata_by_idstrings($userid,"(%task0,reason_id=10,reserved%)");
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				if(count($data["itemsdata"])>0){
					$items=handle_item_array($data["itemsdata"]);
					$data["unread_points_details"]->item=$items[0];
				}
		});
		
		commitTasks();
		
		GLOBAL $data;
		$data["queue_count"]=$this->input->post("count");
		$this->load->view("layout_controls/experience_panel",$data);
	}
	
	function get_experience_content_by_points_id(){
		$id=$this->input->post("points_id");
		$userid=get_userid();
		$this->points_model->get_unread_points_details_by_points_id($id);
		$this->result_item_model->get_itemsdata_by_idstrings($userid,"(%task0,reason_id=10,reserved%)");
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				if(count($data["itemsdata"])>0){
					$items=handle_item_array($data["itemsdata"]);
					$data["unread_points_details"]->item=$items[0];
				}
		});
		
		commitTasks();
		
		GLOBAL $data;
		$data["queue_count"]=$this->input->post("count");
		$this->load->view("layout_controls/experience_panel_inner",$data);
	}
	
	function get_up_level_required_exp(){
		$level=$this->input->post("level");
		$this->points_model->get_next_level_required_exp($level);
		commitTasks();
		GLOBAL $data;
		echo $data["exp"];
	}
	
	function mark_reward_as_read()
	{
		$id=$this->input->post("points_id");
		$this->points_model->mark_points_as_read($id);
		commitTasks();
	}
	
	function mark_all_reward_as_read(){
		$userid=get_userid();
		$this->points_model->mark_all_points_as_read($userid);
		commitTasks();
	}
	
	
}

