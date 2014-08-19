<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discussion extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING

		$this->load->model('discussion_model');
		$this->load->model('activity_model');
		$this->load->helper('text');
	}

	public function index()
	{
		redirect("discussion/listing/");
		
	}
	
	public function listing($categoryid=2,$start=0){
			
		$limit=15;
		GLOBAL $data;
		$data['currentcategoryid']=$categoryid;
		$data['start']=$start;
		$data['limit']=$limit;
		
		$this->discussion_model->get_categories();
		$this->discussion_model->get_currentcategory_by_categoryid($categoryid);
		$this->discussion_model->get_topic($categoryid,$limit,$start);
		$this->discussion_model->get_total_topic_count($categoryid);
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			if($data['currentcategory']==""){
				$data["404"] = true;
				return;
			} 
			
			$data['pagination'] = generate_pagination('/discussion/listing/'.$data['currentcategoryid'],4,$data['totalcount'],$data['limit']);
		});
		
		$this->render_page('page_discussion_topic',false,"discussion");
	}
	
	public function topic($id,$start=0,$focuscomment=0){
		GLOBAL $data;
		$limit=10;
		
		$this->discussion_model->get_topic_by_id($id);	
		$this->discussion_model->get_currentcategory_by_topic_id($id);
		$this->discussion_model->get_topic_comments_by_topic_id($id,$start,$limit);		
		$this->discussion_model->topic_add_counter($id);
		
		$data["limit"]=$limit;
		$data["focuscomment"]=$focuscomment;	
		$data['offset'] = $start;
		$data['topicid'] = $id;
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			if($data['topic']==""){
				$data["404"] = true;
				return;
			} 
			
			$data['totalcount']=$data["topic"]->postscount;
			$data['pagination'] = generate_pagination('/discussion/topic/'.$data["topicid"],4,$data['totalcount'],$data['limit']);
		
			if(intval($data['totalcount'])<$data['limit']){
				$data['limit']=$data['totalcount'];
				
			}
			
		});
	
		
		$this->render_page('page_discussion_topic_comment',false,"discussion");
	}
	
	public function newtopic($categoryid=1){
	
		$this->discussion_model->get_categories();	
		$this->discussion_model->get_currentcategory_by_categoryid($categoryid);
		GLOBAL $data;
		$data["type"]="new";
		$this->render_page('page_new_topic',true,"discussion");
		
	}
	
	public function edittopic($topicid){
		
		$this->discussion_model->get_categories();	
		$this->discussion_model->get_currentcategory_by_topic_id($topicid);
		$this->discussion_model->get_topic_by_id($topicid);	
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			if($data['topic']==""){
				$data["404"] = true;
				return;
			} 
				
			if($data["topic"]->userid!=get_userid()){
				redirect("discussion/listing");
			}
		});
		GLOBAL $data;
		$data["type"]="edit";
		$this->render_page('page_new_topic',true,"discussion");
		
	}
	
	public function submittopic($topicid=0){

		
		
		if($topicid==0){
			user_validated(true,"discussion/newtopic");
			$userid=get_userid();
			$this->discussion_model->submit_topic_return_topic_id($this->input->post('category'),
															      $this->input->post('topictitle'),
																  $this->input->post('topictext'),$userid);	
			$this->activity_model->insert_activity(4,$userid,"(%task0,topic_id%)");
			$this->points_model->add_points($userid,11,"(%task0,topic_id%)");
			$type = "successtopic";
		}
		else{
			user_validated(true,"discussion/edittopic/".$topicid);
			$userid=get_userid();
			$this->discussion_model->edit_topic($this->input->post('category'),
											      $this->input->post('topictitle'),
												  $this->input->post('topictext'),$userid,$topicid);	
            GLOBAL $data;
			$data["topic_id"] = $topicid;
		    $type = "edittopic";
		}
		commitTasks();
		
		GLOBAL $data;
		redirect('redirect/directto/'.$type.'/'.$this->input->post('category')."/".$data["topic_id"], 'refresh');
	
	}
	
	public function submitcomment($topicid,$currentcategory){
		precheck_login_before_db();
		$comment=$this->input->post('comment');
		$userid=get_userid();
		$this->discussion_model->submit_comment_return_commentid($comment,$topicid,$userid);
		$this->discussion_model->get_comment_row_number("(%task0,commentid%)",$topicid);
		$this->activity_model->insert_activity(5,$userid,$topicid,"(%task0,commentid%)");
		$this->points_model->add_points($userid,3,"(%task0,commentid%)");
		
		commitTasks();
		
		GLOBAL $data;
		$start=get_start_pagination_by_row_number($data["comment_row_number"],10);
		redirect('discussion/topic/'.$topicid.'/'.$start.'/'.$data["commentid"], 'refresh');
	}
	
	public function editcomment($topicid,$currentcategory){
		precheck_login_before_db();
		
		$comment=$this->input->post('comment');
		$userid=get_userid();
		$commentid=$this->input->post('commentid');
		$this->discussion_model->edit_comment($comment,$topicid,$userid,$commentid);
		$this->discussion_model->get_comment_row_number($commentid,$topicid);
		commitTasks();
		
		GLOBAL $data;
		$start=get_start_pagination_by_row_number($data["comment_row_number"],10);
		redirect('discussion/topic/'.$topicid.'/'.$start.'/'.$commentid, 'refresh');
	}
	
	public function deletetopic($categoryid){
		precheck_login_before_db();
		$this->discussion_model->delete_topic($this->input->post("topicid"));	
		commitTasks();
			
	}
	
	public function deletecomment($categoryid){
		precheck_login_before_db();
		$userid=get_userid();
		$this->discussion_model->delete_comment($this->input->post("commentid"),$userid);	
		commitTasks();
	}
	
}