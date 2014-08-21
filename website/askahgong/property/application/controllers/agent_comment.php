<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_comment extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
		$this->load->model('result_item_model');
		$this->load->model('user_model');
		$this->load->model('points_model');
		$this->load->model('activity_model');
		$this->load->model('agent_comment_model');
		$this->load->model('discussion_model');
		$this->load->model('error_model');
	}
	
	public function index(){
		redirect("agent_comment/view");
	}
	
	
	public function view($agent_id=0,$null='',$start=0){
		
		if($agent_id==0){
			$agent_id=get_userid();
		}

		$userid=get_userid();
		GLOBAL $data;
		$data["dashboard_page"]="agent_comment";
		$limit = 5;
		$data["limit"] = $limit;
		$data["start"] = $start;
		$data["agent_id"] = $agent_id;
		$this->user_model->get_user_by_userid($userid,$agent_id);
		$this->points_model->get_all_review_feedbacks("good","good_feedbacks");
		$this->points_model->get_all_review_feedbacks("bad","bad_feedbacks");
		$this->agent_comment_model->get_all_comment_threads($agent_id,$limit,$start,$userid);
		$this->agent_comment_model->get_comment_replies_by_thread_ids("(%task3,main_id%)");
		$this->agent_comment_model->get_all_comment_threads_count($agent_id);
		$this->agent_comment_model->get_all_comment_threads_count($agent_id,"good","good_count");
		$this->agent_comment_model->get_all_comment_threads_count($agent_id,"bad","bad_count");
		$this->discussion_model->get_total_topic_count_by_userid($agent_id);
		$this->discussion_model->get_total_topic_comment_count_by_userid($agent_id);
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			if(!is_verified_agent($data["user"])){
				$data["404"] = true;
				return;
			}
			
			$data["comment_threads"] = handle_agent_replies_thread($data["comment_threads"],$data["comment_replies"]);
			$data['pagination'] = generate_pagination('/agent_comment/get_agent_comment_threads/'.$data["agent_id"].'/any/',5,$data['comment_threads_count'],$data['limit'],"","ajax");
			
		});
		
		$this->render_page('page_dashboard',false,"");
		
	}
	
	function get_agent_comment_threads($agent_id,$type="any",$start=0){
		$limit = 5;
		GLOBAL $data;
		$data["limit"] = $limit;
		$data["start"] = $start;
		$data["agent_id"] = $agent_id;
		$userid=get_userid();
		$this->agent_comment_model->get_all_comment_threads($agent_id,$limit,$start,$userid,$type);
		$this->agent_comment_model->get_comment_replies_by_thread_ids("(%task0,main_id%)");
		$this->agent_comment_model->get_all_comment_threads_count($agent_id,$type);
		commitTasks();
		$data["comment_threads"] = handle_agent_replies_thread($data["comment_threads"],$data["comment_replies"]);
		$data['pagination'] = generate_pagination('/agent_comment/get_agent_comment_threads/'.$data["agent_id"].'/'.$type.'/',5,$data['comment_threads_count'],$data['limit'],"","ajax");
		$this->load->view("layout_controls/agent_comment_thread",$data);
	}
	
	
	function get_all_agent_comment_replies(){
		$thread_id = $this->input->post("thread_id");
		$max_id = $this->input->post("max_id");
		$this->agent_comment_model->get_all_comment_replies_by_thread_id($thread_id,$max_id);
		commitTasks();
		GLOBAL $data;
		$data["comments"] = $data["comment_replies"];
		$this->load->view("layout_controls/agent_comment_reply_listing",$data);
	}
	
	function submit_agent_comment_reply(){
		$thread_id = $this->input->post("thread_id");
		$content = $this->input->post("content");
		$userid = get_userid();
		$this->agent_comment_model->insert_thread_reply_get_reply_id($thread_id,$userid,$content);
		$this->agent_comment_model->get_comment_replies_by_comment_id("(%task0,reply_id%)");
		$this->activity_model->insert_activity(16,$userid,"(%task0,reply_id%)");
		commitTasks();
		GLOBAL $data;
		$data["comments"] = $data["comment_replies"];
		$this->load->view("layout_controls/agent_comment_reply_listing",$data);
	}
	
	function insert_new_agent_thread(){
		$userid = get_userid();
		$agent_id = $this->input->post("agent_id");
		$content = $this->input->post("content");
		$reason_id = $this->input->post("reason_id");
		$this->points_model->get_points_by_reason_id($reason_id);
		$this->agent_comment_model->insert_thread_get_thread_id($agent_id,$userid,$content,$reason_id,"(%task0,award%)");
		$this->activity_model->insert_activity(15,$userid,"(%task1,thread_id%)");
		$this->points_model->add_points($agent_id,$reason_id,"");
		commitTasks();
	
	}
	
	function report_agent_thread(){
		$thread_id = $this->input->post("thread_id");
		$this->agent_comment_model->get_thread_start_offset($thread_id);
		$this->agent_comment_model->get_thread_userid($thread_id);
		commitTasks();
		$this->agent_comment_model->report_agent_comment_thread($thread_id);
		GLOBAL $data;
		$url = $data["thread_userid"]."(%2)".get_userid()."(%2)".$thread_id."(%2)agent_comment/view/".get_userid()."/thread/".(floor($data["offset"] / 5)*5)."#".$thread_id;
		$this->error_model->add_new_agent_review_report($url,$data["thread_userid"]);
		commitTasks();
	}
	
	function unreport_agent_thread(){
		$thread_id = $this->input->post("thread_id");
		$this->agent_comment_model->unreport_agent_comment_thread($thread_id);
		commitTasks();
	}
	
	function has_previous_comment(){
		$userid = get_userid();
		$agent_id = $this->input->post("agent_id");
		$this->agent_comment_model->get_user_previous_agent_comment_thread_count($userid,$agent_id);
		commitTasks();
		GLOBAL $data;
		echo $data["count"];
	}
	
	function delete_previous_thread(){
		$admin_delete = $this->input->post("admin_delete");
		if(isset($admin_delete) && $admin_delete!=""){
			$userid = $this->input->post("userid");
		}
		else{
			$userid = get_userid();
		}
		$agent_id = $this->input->post("agent_id");
		$this->agent_comment_model->get_previous_agent_comment_thread($agent_id,$userid);
		commitTasks();
		GLOBAL $data;
		
		if(!empty($data["thread"])){
	
			$this->points_model->add_points($data["thread"]->agent_id,"REVOKED",$data["thread"]->point);
			$this->agent_comment_model->delete_previous_agent_comment_thread($agent_id,$userid);
			commitTasks();
		}
		else{
			echo print_r($data["thread"]);
		}
		
		
	}

}

