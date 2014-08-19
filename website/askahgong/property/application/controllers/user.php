<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	    $this->load->model('user_model');
		$this->load->model('activity_model');
		$this->load->model('message_model');

	}
	
	public function id($userid){
		GLOBAL $data;
		if(empty($userid)){
			$data["404"] = true;
			$this->render_page('page_reset_password',false,"no-index");
		}
		else{
			$this->user_model->get_user_by_userid($userid,$userid);
			commitTasks();
			if(is_verified_agent($data["user"])){
				redirect("agent_comment/view/".$userid);
			}
			else{
				redirect("activity/id/".$userid);
			}
		}
		
	}
	
	public function login(){
		
		if(user_validated()) redirect("activity");
		$this->render_page('page_login_register',false,"login");
	}
	
	public function resetpasswordtoken(){
		$token = $this->input->get("token");
		$this->user_model->get_userid_by_reset_password_token($token);
		commitTasks();
		GLOBAL $data;
		if(empty($data["user_id"]) || (empty($token))){
			$data["404"] = true;
		}
		else{
			$data["password"] = $this->user_model->reset_password_matched_token($data["user_id"]);
		}
		$this->render_page('page_reset_password',false,"no-index");
		
	}
	
	public function asklogin(){
		$this->load->view('layout_controls/ask_for_login');
	}
		
	public function get_user_details_html(){
		$ownuserid=get_userid();
		$getting_userid=$this->input->post("userid");
		$this->user_model->get_user_by_userid($ownuserid,$getting_userid);
		commitTasks();
		GLOBAL $data;
		echo $this->load->view("layout_controls/user_panel",$data);
	}
	
	public function submit_login($remember)
	{
		
		$result= $this->user_model->user_validate($this->input->post("phone"),$this->input->post("countrycode"),$this->input->post("password"));
		
		
		if (is_numeric($result)==true){
		
				if($remember=="yes"){
					while (true){
						$token = uniqid('token', true);
						if($this->user_model->check_exist_remembertoken($token)==false){
							$this->user_model->update_remembertoken($token,$result);
							$this->user_model->clear_reset_password_token($result);
							$this->session->set_userdata('userid', $result);
							$this->input->set_cookie("remembertoken", $token, (20 * 365 * 24 * 60 * 60));
							commitTasks();
							echo 1;
							break;
						}
					
					}
			
				}
				else{
					$this->user_model->clear_reset_password_token($result);
					commitTasks();
					$this->session->set_userdata('userid', $result);
					echo 1;
				}
				
				
		}
		else{
		
			echo $result;
		}
	}
	
	public function submit_logout($type="search"){
		$userid=get_userid();
		$this->activity_model->insert_activity(12,$userid,$userid);
		commitTasks();
		delete_cookie("remembertoken");
		$this->session->sess_destroy();
		if ($type=="search")
		redirect("search");
		else if ($type=="login")
		redirect("user/login#resetpassword");
	}
			
	public function submit_register()
	{
		echo $this->user_model->register($this->input->post("phone"),$this->input->post("countrycode"),$this->input->post("password"));
		
	}
	
	public function resetpassword(){
		
		echo $this->user_model->reset_password($this->input->post('phone'),$this->input->post('countrycode'),$this->input->post('email'));
		
	}
	

	
	public function check_otp_matched(){
		$otp=$this->input->post("otp");
		if(trim($otp)==""){
			echo 0;
			return;
		}
		$phone=$this->input->post("phone");
		$result= $this->user_model->check_otp_matched($otp,$phone);
		if($result==true){
			$this->user_model->clear_otp($phone);	
		}
		echo $result;
	}
	
	public function get_user_status($userid){
		$this->user_model->get_status_by_userid($userid);
		commitTasks();
		GLOBAL $data;
		echo $data["status"];
	}
	
	public function check_for_offline(){
		$userids=$this->input->post("userids");
		$this->user_model->check_for_offline_users($userids);
		commitTasks();
		GLOBAL $data;
		echo json_encode($data["offline_users"]);
		
	}
	
}
