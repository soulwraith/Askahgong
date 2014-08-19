<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dictionary extends CI_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		$this->load->model("dictionary_model");
	}


	
	public function index()
	{
		
	}
	
	public function get_design(){
		$this->dictionary_model->get_units_conversion();
		$this->dictionary_model->get_synonyms();
		commitTasks();
		GLOBAL $data;
		$this->load->view("admin/subpage/dictionary",$data);
	}
	
	
	public function get_word_type_listing(){
		
		$this->dictionary_model->get_word_types($this->input->post("wordtype"));
		GLOBAL $data;
		commitTasks();
		echo json_encode($data["word_types"]);
		
	}
	
	public function add_unit(){
		echo $this->dictionary_model->insert_unit($this->input->post("unit"),$this->input->post("convertmethod"),$this->input->post("column"));
	}
	
	public function delete_unit(){
		$this->dictionary_model->delete_unit($this->input->post("id"));
	}
	
	public function add_wordtype(){
		echo $this->dictionary_model->insert_wordtype($this->input->post("word"),strtoupper($this->input->post("wordtype")));
	}
	
	public function delete_wordtype(){
		$this->dictionary_model->delete_wordtype($this->input->post("id"));
	}
	
	
	public function add_synonyms(){
		echo $this->dictionary_model->insert_synonyms($this->input->post("convertfrom"),$this->input->post("convertto"));
	}
	
	public function delete_synonyms(){
		$this->dictionary_model->delete_synonyms($this->input->post("id"));
	}
	
	
	
	
	
	
	
}	