<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
		
		$this->load->model("category_model");

	}

	public function get_design(){
		$this->category_model->get_all_top_parent_categorydata();
		commitTasks();
		GLOBAL $data;
		$this->load->view("admin/subpage/category",$data);
	}
	
	
	public function get_all_child_id($topcategoryid){
		echo (json_encode($this->category_model->get_all_child_id($topcategoryid)));
	}
	
	public function get_category_all_child($topcategoryid){
		echo (json_encode($this->category_model->get_all_child_data_by_idlist($this->category_model->get_all_child_id($topcategoryid))));
	}
	
	public function update_category_parent($categoryid,$parentcategoryid){
		$this->category_model->update_parent_category($categoryid,$parentcategoryid);
	}
	
	public function update_category($categoryid){
		$this->category_model->update_category($categoryid,$this->input->post("word"));
	}
	
	public function delete_category(){
		$this->category_model->delete_category($this->input->post("categoryidstring"));
	}
	
	public function create_category($parentcategoryid){
		echo $this->category_model->new_category($this->input->post("category"),$this->input->post("supportstate"),$parentcategoryid);
	
	}
	

	
	
}	