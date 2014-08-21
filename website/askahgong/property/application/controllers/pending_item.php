<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pending_item extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
		$this->load->model('result_item_model');
		$this->load->model('user_model');
		$this->load->model('activity_model');
	}

	public function id($itemid){
		GLOBAL $data;
		$userid=get_userid();
		$this->result_item_model->get_item_full_data($itemid,$userid);
		
		$sql = "(SELECT count(id) from askahgong.agent_request where fromuserid='".$userid."' and targetuserid=info.id and itemid='".$itemid."') as my_request,
				(SELECT count(id) from askahgong.agent_request where targetuserid='".$userid."' and fromuserid=info.id and itemid='".$itemid."') as agent_request";
		$sort = "agent_request desc,my_request desc,isonline desc,info.points desc";
		$this->user_model->get_all_agents("",0,0,20,$userid,$sql,$sort);
		$this->result_item_model->get_item_agent_request_count($userid,$itemid);
		$this->result_item_model->get_item_agent_propose_count($userid,$itemid);
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			if($data['item']==""){
				$data["404"] = true;
				return;
			} 
			
			$data['item']=handle_item_data($data['item']);
			if(!empty($data["item"]->original_ownerid)){
				redirect($data["item"]->url);
			}
			
		});
		
		$this->render_page('page_pending_item',true,"profile");
		
	}
	
	public function listing(){
		$userid=get_userid();
		GLOBAL $data;
		$data["dashboard_page"]="pending_item";
		$limit = 5;
		$data["limit"] = $limit;
		$data["start"] = 0;
		$this->user_model->get_user_by_userid($userid,$userid);
		$this->result_item_model->get_itemsdata_of_agent_requests_type("pending",$userid,0,$limit);
		$this->result_item_model->get_itemsdata_of_agent_requests_type("waitingYourResponse",$userid,0,$limit,"waitingResponseItemsData");
		$this->result_item_model->get_count_of_agent_requests_type("pending",$userid,"pendingCount");
		$this->result_item_model->get_count_of_agent_requests_type("waitingYourResponse",$userid,"waitingResponseCount");
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			if(!is_verified_agent($data["user"])){
				redirect("redirect/cannot_access");
			}
			
			$data['itemsdata']=handle_item_array($data['itemsdata']);
			$data['waitingResponseItemsData']=handle_item_array($data['waitingResponseItemsData']);
			$data['pagination'] = generate_pagination('/pending_item/get_agent_requests_by_type/pending/',4,$data["pendingCount"],$data["limit"],"","ajax");
			$data['pagination2'] = generate_pagination('/pending_item/get_agent_requests_by_type/waitingYourResponse/',4,$data["waitingResponseCount"],$data["limit"],"","ajax");
			
		});
		
		$this->render_page('page_dashboard',true,"");
	}
	
	public function get_agent_requests_by_type($type,$start = 0){
		$userid=get_userid();
		GLOBAL $data;
		$limit = 5;
		$data["type"] = $type;
		$data["limit"] = $limit;
		$data["start"] = $start;
		$this->result_item_model->get_itemsdata_of_agent_requests_type($type,$userid,$start,$data["limit"]);
		$this->result_item_model->get_count_of_agent_requests_type($type,$userid,"totalcount");
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
	
			$data['itemsdata']=handle_item_array($data['itemsdata']);
			$data['pagination'] = generate_pagination('/pending_item/get_agent_requests_by_type/'.$data["type"].'/',4,$data["totalcount"],$data["limit"],"","ajax");
			
		});
		commitTasks();
		
		if($type=="waitingYourResponse"){
			$data["type"]= "askForAccept";
		}
		else{
			$data["type"] = $type;
		}
		
		$this->load->view("layout_controls/result_item_simple",$data);
	}
	
	
	public function get_single_pending_request_html(){
		$userid=get_userid();
		$item_id = $this->input->post("item_id");
		$this->user_model->get_user_by_userid($userid,$userid);
		$this->result_item_model->get_itemsdata_of_agent_requests_type("any",$userid,0,1,"itemsdata",$item_id);
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['itemsdata']=handle_item_array($data['itemsdata']);
		});
		commitTasks();
		GLOBAL $data;
		$data["type"] = "normal";
		$data["data_only"] = true;
		echo $this->load->view("layout_controls/result_item_simple",$data);
	}
	
	function find_agents(){
		$start = $this->input->post("start");
		$keyword = $this->input->post("keyword");
		$item_id = $this->input->post("item_id");
		$userid=get_userid();
		$sql = "(SELECT count(id) from askahgong.agent_request where fromuserid='".$userid."' and targetuserid=info.id and itemid='".$item_id."') as my_request,
				(SELECT count(id) from askahgong.agent_request where targetuserid='".$userid."' and fromuserid=info.id and itemid='".$item_id."') as agent_request";
		$sort = "agent_request desc,my_request desc,isonline desc,info.points desc";
		$this->user_model->get_all_agents($keyword,0,$start,20,$userid,$sql,$sort);
		commitTasks();
		GLOBAL $data;
		$data["data_only"] = true;
	 	echo $this->load->view("layout_controls/agent_listing",$data);
	}
	
	function get_agent_details($userid){
		$ownuserid = get_userid();
		$item_id = $this->input->post("item_id");
		$sql = "(SELECT count(id) from askahgong.agent_request where fromuserid='".$ownuserid."' and targetuserid='".$userid."' and itemid='".$item_id."') as my_request,
				(SELECT count(id) from askahgong.agent_request where targetuserid='".$ownuserid."' and fromuserid='".$userid."' and itemid='".$item_id."') as agent_request";
		$this->user_model->get_user_by_userid($ownuserid,$userid,$sql);
		commitTasks();
		GLOBAL $data;
	 	echo $this->load->view("layout_controls/agent_details",$data);
	}
	
	
	function request_agent(){
		$ownuserid = get_userid();
		$agent_id = $this->input->post("agent_id");
		$item_id = $this->input->post("item_id");
		GLOBAL $data;
		$this->result_item_model->get_agent_request_count($ownuserid,$item_id);
		commitTasks();
		if($data["count"]>9){
			echo "0";
		}
		else{
			$this->result_item_model->add_new_agent_request_return_request_id($ownuserid,$agent_id,$item_id);
			$this->activity_model->insert_activity(13,$ownuserid,$item_id,"(%task1,request_id%)");
			commitTasks();
			echo "1";
		}
	}
	
	function propose_be_agent(){
		$agent_id = get_userid();
		$customer_id = $this->input->post("customer_id");
		$item_id = $this->input->post("item_id");
		GLOBAL $data;
		$this->result_item_model->get_agent_propose_count($item_id);
		commitTasks();
		if($data["count"]>9){
			echo "0";
		}
		else{
			$this->result_item_model->add_new_agent_request_return_request_id($agent_id,$customer_id,$item_id);
			$this->activity_model->insert_activity(13,$agent_id,$item_id,"(%task1,request_id%)");
			commitTasks();
			echo "1";
		}
	}

	
	function accept_agent(){
		$userid = get_userid();
		$targetuserid = $this->input->post("targetuserid");
		$item_id = $this->input->post("item_id");
		$this->user_model->get_user_by_userid($userid,$userid);
		$this->user_model->get_user_by_userid($targetuserid,$targetuserid,"","target");
		$this->result_item_model->get_item_full_data($item_id,$targetuserid);
		
		commitTasks();
		GLOBAL $data;
		if(is_verified_agent($data["user"])){
			$agent_id = $userid;
			$customer_id = $targetuserid;
		}
		else if(is_verified_agent($data["target"])){
			$agent_id = $targetuserid;
			$customer_id = $userid;
		}
		else{
			echo "NOT_AGENT";
			return;
		}
		
		if(!empty(handle_item_data($data["item"])->original_ownerid)){
			echo "ALREADY_HAD_AGENT";
			return;
		}
		
		$this->result_item_model->get_agent_request_id($customer_id,$agent_id,$item_id);
		$this->activity_model->insert_activity(14,$userid,$item_id,"(%task3,agent_request_id%)");
		$this->result_item_model->update_item_ownership($customer_id,$agent_id,$item_id);
		$this->activity_model->insert_activity(0,$agent_id,$item_id);
		$this->result_item_model->get_item_full_data($item_id,$agent_id);
		$this->user_model->get_user_by_userid($userid,$agent_id,"","agent");
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			$data["item"]=handle_item_data($data['item']);
			
			
			
		});
		
		commitTasks();
		
		
		watermark_item_photos($item_id,$data["agent"]);
		
		
		echo $data["item"]->url;
		
		
	}
	
		
	
}

