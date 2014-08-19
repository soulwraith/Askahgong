<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		$this->load->model("cms_model");
	}


	
	public function index()
	{
		admin_validated();
		$this->cms_model->get_anchors();
		$this->render_page('admin/page_cms',true,"admin","no-banner");
	}
	
	public function create_anchor(){
		$title=$this->input->post("title");
		echo $this->cms_model->create_anchor($title);
	}
	
	public function edit_anchor(){
		$title=$this->input->post("title");
		$id=$this->input->post("id");
		$this->cms_model->edit_anchor($title,$id);
	}
	
	public function delete_anchor(){
		$id=$this->input->post("id");
		$this->cms_model->delete_anchor($id);
	}
	
	public function get_anchor_content(){
		$id=$this->input->post("id");
		$results=$this->cms_model->get_anchor_content_by_id($id);
		if(count($results)==0) echo "";
		else echo $results[0];
	}
	
	public function save_content(){
		$anchorid=$this->input->post("anchorid");
		$content=$this->input->post("content");
		$this->cms_model->save_anchor_content($anchorid,$content);
	}
	
	
}	