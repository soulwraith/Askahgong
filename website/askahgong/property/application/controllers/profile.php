<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		 $this->load->model('user_model');
		 $this->load->model('activity_model');
		  $this->load->model('error_model');
	}

	public function index($success=0)
	{
		GLOBAL $data;
		$userid=get_userid();
		
		$data["dashboard_page"]="profile";
		$data["success"]=$success;
		$this->user_model->get_user_by_userid($userid,$userid);	
		$this->user_model->get_available_roles($userid);	
		
		$this->render_page('page_dashboard',true,"profile");
	
	}
	
	public function updateusersettings(){
		user_validated(true,"profile");
		$userid=get_userid();
		
		$formValues = $this->input->post(NULL, TRUE);
		$completed=true;
		$setUnverified = false;
		
		GLOBAL $data;
		$this->user_model->get_user_by_userid($userid,$userid);
		commitTasks();
		$user = $data["user"];
		if(strtolower($user->agency)!=strtolower($formValues["agency"])){
			$setUnverified = true;
		}
		if($user->roleid != $formValues["roleid"]){
			$setUnverified = true;
		}
		
		if($setUnverified){
			$this->user_model->set_agent_unverified($userid);
			$this->error_model->delete_agent_verification($userid);
			if($formValues["roleid"]=="5"){
				$this->error_model->add_new_agent_verification($this->input->post('agency'),$userid);
			}
		}
		
		foreach($formValues as $key => $value) 
		{
			if(($value=="" || $value=="-") && $key != "alternatephone"){
				
				if($key=="agency"){
					if($formValues["roleid"]=="5"){
						$completed=false;
					}
				}
				else{
					$completed=false;
				}
			}
		}
		
		
		
		if(!file_exists("photo/profile/".$userid.".png")){
			$completed=false;
		}
		

		if($completed) $this->points_model->add_points($userid,6,0);
		
		
		
		$this->user_model->update_user_settings($userid,
												$this->input->post('alternatephone'),
												$this->input->post('roleid'),
												$this->input->post('agency'),
												$this->input->post('username'),
												$this->input->post('email'),
												$this->input->post('phonevisibility'),
												$this->input->post('contactmethod'),
												$this->input->post('workingfrom'),
												$this->input->post('workingto'),
												$this->input->post('description'));
		$this->activity_model->insert_activity(6,$userid,$userid);
		commitTasks();
		
		
		redirect("profile/index/1","refresh");	
		
	}
	
	public function updatedescription(){
		precheck_login_before_db();	
		$userid=get_userid();
		$this->user_model->update_description($this->input->post('description'),$userid);
		//$this->activity_model->insert_activity(6,$userid,$userid);
		commitTasks();
	}
	
	
	public function changepicture(){
		if (!file_exists('photo/')) {
		    mkdir('photo/', 0777, true);
		}
		if (!file_exists('photo/profile')) {
		    mkdir('photo/profile', 0777, true);
		}
		
		$this->load->helper("image_helper");
		$userid=get_userid();
	    $image = new SimpleImage();
        $image->load($_FILES['uploadedfile']['tmp_name']);
        $image->resizeToWidth(170);
		$image->save('photo/profile/'.$userid.'.png');
		redirect("profile/index/1","refresh");
	}
	
	public function set_profile_picture(){
		
		if (!file_exists('photo/')) {
		    mkdir('photo/', 0777, true);
		}
		if (!file_exists('photo/profile')) {
		    mkdir('photo/profile', 0777, true);
		}
		
		$userid=get_userid();
		$filename=$this->input->post("filename");
		
		$existpath = "";
		foreach (glob("photo/profile/".$userid."_*.png") as $file) {
		    $existpath = $file;
		}
		
		$number = 0;
		if($existpath!=""){
			$arr = explode("_",$existpath);
			$current_number = (int)str_replace(".png","",$arr[1]);
			$number = $current_number + 1;
			unlink($existpath);
		}
		
		$final_file = $userid."_".$number;
		
		rename($filename, 'photo/profile/'.$final_file.'.png');
		
	}
	
	
}

