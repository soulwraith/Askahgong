<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	 	$this->load->model('area_model');
	}

	public function index()
	{
		
		
	}
	
	public function get_design(){
		$this->load->view("admin/subpage/area");
	}
	
	public function get_area($lat1,$lnt1,$lat2,$lnt2){
		$this->area_model->get_areas($lat1,$lnt1,$lat2,$lnt2);
		commitTasks();
		GLOBAL $data;
		echo (json_encode($data["areas"]));

	}
	
	public function get_area_html_by_keyword(){
		$keyword=$this->input->post("keyword");
		$this->area_model->get_locations_by_keyword($keyword);
		commitTasks();
		GLOBAL $data;
		
		$html="";
		foreach($data["locations"] as $location){
			$html.= "<tr><td class='areaid'>".$location->id."</td>";
			$html.= "<td class='residence'>".$location->residence."</td>";
			$html.= "<td class='street'>".$location->street."</td>";
			$html.= "<td class='area'>".$location->area."</td>";
			$html.= "<td class='town'>".$location->town."</td>";
			$html.= "<td class='district'>".$location->district."</td>";
			$html.= "<td class='state'>".$location->state."</td>";
			$html.= "<td class='country'>".$location->country."</td>";
			$html.= "<td><a href='javascript:void(0)' onclick='delete_location(".$location->id.",true,this);'>Del</a></td></tr>";
		}
		echo $html;

	}
	
	
	public function submit_area(){
		$residence=$this->input->post('residence');
		$street=$this->input->post('street');
		$area=$this->input->post('area');
		$town=$this->input->post('town');
		$district=$this->input->post('district');
		$state=$this->input->post('state');
		$country=$this->input->post('country');
		$latitude=$this->input->post('latitude');
		$longitude=$this->input->post('longitude');
		
		if($this->area_model->check_contain_area($street,$area,$residence) || ($street=="" && $residence=="")){
			echo "Fail";
		}
		else{
			echo $this->area_model->insert_area($residence,$street,$area,$town,$district,$state,$country,$latitude,$longitude);
		}
	


	}
	
	public function update_area_text(){
		$column=$this->input->post('column');
		$value=$this->input->post('value');
		$areaid=$this->input->post('areaid');
		$this->area_model->update_area_text($column,$value,$areaid);
		commitTasks();
	}

	
	public function update_area(){
		$residence=$this->input->post('residence');
		$street=$this->input->post('street');
		$area=$this->input->post('area');
		$town=$this->input->post('town');
		$district=$this->input->post('district');
		$state=$this->input->post('state');
		$country=$this->input->post('country');
		$latitude=$this->input->post('latitude');
		$longitude=$this->input->post('longitude');
		$areaid = $this->input->post('areaid');
		if(!$this->area_model->check_contain_area($street,$area,$residence)){
			echo $this->area_model->update_area($residence,$street,$area,$town,$district,$state,$country,$latitude,$longitude,$areaid);
		}
		else{
			echo "Fail";
		}
	}
	

	public function delete_area(){
		$id=$this->input->post("id");
		$this->area_model->delete_area_by_id($id);
	}

}	