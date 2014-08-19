<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		$this->load->model("message_model");
	 	$this->load->model("user_model");
		$this->load->model("activity_model");

	}
	
	function index(){
	
	}
	
	function agents($start=0){
		GLOBAL $data;	
		$limit=20;
				
		$keyword="";
		if (!empty($_GET['keyword'])) {
		    $keyword=$_GET["keyword"];
		}
		
		if (empty($_GET['showonline'])) {
		    $showonline=0;
		}
		else{
			$showonline=$_GET['showonline'];
		}
		
		$userid=get_userid();
		$data["query_string"]=$this->input->server('QUERY_STRING');
		$data["start"]=$start;
		$data["limit"]=$limit;
		
		$this->user_model->get_all_agents($keyword,$showonline,$start,$limit,$userid);
		$this->user_model->get_all_agents_totalcount($keyword,$showonline);
		
			
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['pagination'] = generate_pagination('/contact/agents/',3,$data['totalcount'],$data['limit'],'?'.$data["query_string"]);
			
		});
		
		$this->render_page('page_user_list',false,"contact");
	}
	
	
	function our_staffs(){
		$this->user_model->get_all_staffs(get_userid());
		$this->render_page('page_staffs',false,"");
	}
	
	
	function delete_contact($targetuserid){
		
		precheck_login_before_db();
		
		$userid=get_userid();
		$this->user_model->delete_contact($userid,$targetuserid);
		commitTasks();
	}
	
	function add_contact($targetuserid){
		
		precheck_login_before_db();
		
		$userid=get_userid();
		$result=$this->user_model->check_already_has_contact($userid,$targetuserid);
		if($result){
			return;
		}
		
		$this->user_model->add_contact($userid,$targetuserid);
		$this->activity_model->insert_activity(2,$userid,$targetuserid);
		commitTasks();
	}
	
	function find_contacts(){
		
		precheck_login_before_db();
		
		$keyword=$this->input->post("keyword");
		$userid=get_userid();
		if($keyword==""){
			$this->user_model->get_contacts($userid);
		}
		else{
			$this->user_model->find_contacts($keyword,$userid);
		}
		commitTasks();
		GLOBAL $data;
		$this->load->view("layout_controls/contact_listing",$data);
		
	}
	
	function check_is_in_contact($targetuserid){
		$userid=get_userid();
		if($userid==0) return 1;
		echo $this->user_model->check_already_has_contact($userid,$targetuserid);
		
	}
	
	
	//messaging part
	public function messaging($targetuserid=""){
		GLOBAL $data;
				
		$userid=get_userid();
		$data["ownuserid"]=$userid;
		$data["targetuserid"]=$targetuserid;
		
		$this->user_model->get_username_by_userid($userid,"ownusername");
		$this->user_model->get_username_by_userid($targetuserid,"targetusername");
		$this->message_model->get_conversations($userid);

		$this->render_page('page_messaging',true,"contact");
	
	}
	
	public function create_new_conversation(){
		$userid=$this->input->post("userid");
		$message=$this->input->post("message");
		$conversations=Array();
		$conversation=new stdClass();
		$conversation->id="0";
		
		$conversation->targetuserid=$userid;
		
		if($this->input->post("from")!="own"){
			$conversation->newmessage=1;
		}
		else{
			$conversation->newmessage=0;
		}
		
		$conversation->lastmessageowner=$userid;
		$conversation->message=$message;
		GLOBAL $data;
		$data["conversation"] = $conversation;
		$this->user_model->get_status_by_userid($userid);
		$this->user_model->get_username_by_userid($userid);
		
		GLOBAL $tasksCompletedCallBack;
		 array_push($tasksCompletedCallBack,function(){
			 GLOBAL $data;
			 $data["conversation"]->isonline=$data["status"];
			 $data["conversation"]->username = $data["username"];
 		
		 });
		commitTasks();
		array_push($conversations,$data["conversation"]);
		$data["conversations"]=$conversations;
		$this->load->view("layout_controls/conversation_listing",$data);
	}
	
	
	public function get_message_circle($targetuserid){
		 precheck_login_before_db();
		 $limit=15;
		 $userid=get_userid();
		 $this->user_model->get_user_by_userid($userid,$targetuserid);
		 $this->message_model->get_all_targetuser_messagedata($targetuserid,$userid,0,$limit);
		 $this->message_model->get_unread_message_from_contact($userid,$targetuserid);
		 GLOBAL $tasksCompletedCallBack;
		 array_push($tasksCompletedCallBack,function(){
			 GLOBAL $data;
			 $data["messagedata"]=array_reverse($data["messagedata"]);
 		
		 });
		 commitTasks();
		 GLOBAL $data;	
		 $this->load->view("layout_controls/messaging_circle",$data);
	}	
	
	public function get_more_message($targetuserid,$start){
		 GLOBAL $data;	
		 $limit=15;
		 if($start!=0) $limit = 30;
		 
		 precheck_login_before_db();
		 $userid=get_userid();
		 $data["ownuserid"]=$userid;
		 $data["targetuserid"]=$targetuserid;
	
		$this->message_model->get_all_targetuser_messagedata($targetuserid,$userid,$start,$limit);
		 GLOBAL $tasksCompletedCallBack;
		 array_push($tasksCompletedCallBack,function(){
			 GLOBAL $data;
			 $data["messagedata"]=array_reverse($data["messagedata"]);
 		
		 });
		 commitTasks();
		 $this->load->view("layout_controls/message_listing",$data);
	}
	
	public function mark_all_user_msg_read($targetuserid){
		precheck_login_before_db();
		$userid=get_userid();
		$this->message_model->mark_all_message_as_read($userid,$targetuserid);
	}
	
	
	
	public function get_unread_message_count($targetuserid){
		$userid=get_userid();
		$this->message_model->get_unread_message_from_contact($userid,$targetuserid);
		commitTasks();
		GLOBAL $data;
		echo $data["unread"];
	}
	
	public function get_unread_message_userids(){
		$userid=get_userid();
		$this->message_model->get_unread_users($userid);
		commitTasks();
		GLOBAL $data;
		echo json_encode($data["unread_users"]);
	}

	
	public function send_message_ajax($touserid)
	{
		
		precheck_login_before_db();
		$userid=get_userid();
		$message=$this->input->post("message");
		$messagetype=$this->input->post("messagetype");
		$username=$this->input->post("username");
		
		if($messagetype=="web"){
			
	        $message = nl2br($message);
			$this->message_model->send_message($touserid,$userid,$message,0);
			
			
		}
		else if($messagetype=="sms"){
			$resultmessage="Message from ".cutofftext($username,15,"...")." via askahgong.com, '".cutofftext(strip_tags($message),100,"...")."'";
			$this->message_model->send_sms($touserid,$resultmessage);
			$message=strip_tags($message,"<img>");
			$message=$message."<div class='sms-msg icons'></div>";
			$this->message_model->send_message($touserid,$userid,$message,1);
			
		}
		$this->activity_model->insert_activity(8,$userid,$touserid);
		commitTasks();
		GLOBAL $data;
		echo $data["message_id"];
	}
	
	public function append_message(){
		$id = $this->input->post("id");
		$msg = $this->input->post("msg");
		$this->message_model->append_message($id,$msg);
		commitTasks();
		
	}
	
	
	public function can_send_sms($touserid){
		if(!get_userid()){
			echo "5";			//no login error
			return;
		} 
		$userid=get_userid();
		$this->message_model->check_cannot_sms_result($userid,$touserid);
		commitTasks();
		GLOBAL $data;
		echo $data["result"];
	}
	
	
	
}

