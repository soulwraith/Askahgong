<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
		$this->load->model("notification_model");
		$this->load->model("property_model");
	 	$this->load->model("user_model");
		$this->load->model("result_item_model");
		$this->load->model("activity_model");
		$this->load->helper("itemdata_helper");
	}

	public function index()
	{
		GLOBAL $data;
		$limit=20;
		$userid=get_userid();
		
		$data["limit"]=$limit;
		$data["dashboard_page"]="notification";	
		$data['filtertype']='';	
		$data['start']=0;	
		$this->user_model->get_user_by_userid($userid,$userid);
		
		$discard_part = "4,5,6";

		$this->notification_model->get_notifications_totalcount($userid,'',$discard_part);
		$this->notification_model->get_notifications($userid,'',0,$limit,$discard_part);
		$this->notification_model->get_itemsdata_of_notifications($userid,"(%task2,action=newItem,targetid%)");
		$this->notification_model->get_new_notifications_by_userid($userid,$discard_part);
		$this->notification_model->get_itemsdata_of_notifications($userid,"(%task4,action=newItem,targetid%)","itemsdata_new");
		$this->notification_model->update_lastseen_discussion_reply($userid);
		$this->notification_model->update_lastseen_discussion_new_item($userid);
				
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				$data['pagination'] = generate_pagination('/notification/notification_ajax/_/',4,$data['totalcount'],$data['limit'],"","ajax");
				$data['itemsdata']=handle_item_array($data['itemsdata']);
				$data['itemsdata_new']=handle_item_array($data['itemsdata_new']);
				
				$itemsdata=array_merge($data['itemsdata'],$data['itemsdata_new']);
				
				$data['notifications']=handle_notification_array($data['notifications'],$itemsdata,array());
				$data['new_notifications']=handle_notification_array($data['new_notifications'],$itemsdata,array());
				
			
		});
				
		$this->render_page('page_dashboard',true,"profile");
		
	}
	
	
	public function notification_ajax($type="_",$start=0){
		GLOBAL $data;
		$limit=20;
		precheck_login_before_db();
		
		$userid=get_userid();
		if($type=="_") $filtertype="";
		else $filtertype=$type;
		
		$data['filtertype']=$type;
		$data['limit']=$limit;
		$data['start']=$start;
		$discard_part = "4,5,6";
		$this->notification_model->get_notifications_totalcount($userid,$filtertype,$discard_part);
		$this->notification_model->get_notifications($userid,$filtertype,$start,$limit,$discard_part);
		$this->notification_model->get_itemsdata_of_notifications($userid,"(%task1,action=newItem,targetid%)");
		
				
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				$data['pagination'] = generate_pagination('/notification/notification_ajax/'.$data['filtertype'],4,$data['totalcount'],$data['limit'],"","ajax");
				$data['itemsdata']=handle_item_array($data['itemsdata']);
				
				$data['notifications']=handle_notification_array($data['notifications'],$data['itemsdata'],array());
								
		});
	
			
		commitTasks();
		
		$this->load->view("layout_controls/notification_ajaxpagination_listing",$data);
	}
	
	
	

	public function get_notifications_html_by_type($start=0){
		GLOBAL $data;	
		precheck_login_before_db();
		$userid=get_userid();
		$type=$this->input->post("type");
		
		if($type=="new-item"){
			$discard_part="1,2,4,5,6";
			$getting_type="newItem";
		}
		else if($type=="discussion-reply"){
			$discard_part="3,4,5,6";
			$getting_type="replyYourTopic,replyTopic";
		}
		else if($type=="agent-request"){
			$discard_part="1,2,3,6";
			$getting_type="agentRequest,acceptAgent";
		}
		else if($type=="agent-review"){
			$discard_part="1,2,3,4,5";
			$getting_type="agentReview,agentReviewReply";
		}
		
		$data["type"]=$type;
		$data["start"]=$start;
		
		$this->notification_model->get_notifications($userid,$getting_type,$start,10);
		$this->notification_model->get_itemsdata_of_notifications($userid,"(%task0,action=newItem || action=agentRequest || action=acceptAgent,targetid%)");
		$this->notification_model->get_item_modified_meta_of_notifications($userid,"(%task0,action=newItem || action=agentRequest || action=acceptAgent,targetid%)");
		$this->notification_model->get_new_notifications_by_userid_with_discardable($userid,$discard_part);
		$this->notification_model->get_itemsdata_of_notifications($userid,"(%task3,action=newItem || action=agentRequest || action=acceptAgent,targetid%)","itemsdata_new");
		$this->notification_model->get_item_modified_meta_of_notifications($userid,"(%task3,action=newItem || action=agentRequest || action=acceptAgent,targetid%)","item_modified_meta_new");
		$this->user_model->get_user_by_userid($userid,$userid);
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				$data['itemsdata']=handle_item_array($data['itemsdata']);
				$data['itemsdata_new']=handle_item_array($data['itemsdata_new']);
				$itemsdata=array_merge($data['itemsdata'],$data['itemsdata_new']);
				$item_modified_meta=array_merge($data['item_modified_meta'],$data['item_modified_meta_new']);				
				$data['notifications']=handle_notification_array($data['notifications'],$itemsdata,$item_modified_meta);
				$data['new_notifications']=handle_notification_array($data['new_notifications'],$itemsdata,$item_modified_meta,1);
				
				$data['notifications']=array_merge($data['new_notifications'],$data['notifications']);
				
				
				
		});
	
		
		commitTasks();
		
		$this->load->view("layout_controls/notification_popup_listing",$data);
		
	}
	
	public function mark_notification_seen(){
		precheck_login_before_db();	
		$userid=get_userid();	
		$action=$this->input->post("action");
		$targetid=$this->input->post("targetid");
		$this->notification_model->insert_notification_read($userid,$action,$targetid);
		commitTasks();
	}

	public function update_lastseen_notification(){
		precheck_login_before_db();	
		$userid=get_userid();	
		$type=$this->input->post("type");	
		if($type=="new-item"){
			$this->user_model->update_lastseen_new_item($userid);
		}
		else if($type=="discussion-reply"){
			$this->user_model->update_lastseen_discussion_reply($userid);
		}
		else if($type=="agent-request"){
			$this->user_model->update_lastseen_agent_request($userid);
		}
		else if($type=="agent-review"){
			$this->user_model->update_lastseen_agent_review($userid);
		}
		commitTasks();
		//$this->activity_model->insert_activity(11,$userid,$userid);
		
	}
	
	
	public function get_notification_design(){
		$data["propertylist"]=strip_redundant($this->property_model->get_property_type_with_id());
		$this->load->view("layout_controls/notification_settings",$data);
	}
	
	public function delete_notification_setting(){
		precheck_login_before_db();
		$userid=get_userid();
		$this->notification_model->delete_notification_setting($this->input->post("id"),$userid);
	}
	
	public function save_notification_setting(){
		precheck_login_before_db();
		$userid=$this->session->userdata('userid');
		
		$areaidlevel=$this->input->post("areaidlvl");
		$area_arr=explode("|",$areaidlevel);
		$areaid="";
		$arealevel="";

		
		if(count($area_arr)>1){
			$areaid=$area_arr[0];
			$arealevel=$area_arr[1];
		}
		
		
		if($this->input->post("pricemin")==""){
			$pricemin="0";
		}
		else{
			$pricemin=str_replace(',', '', $this->input->post("pricemin"));
		}
		
		if($this->input->post("pricemax")==""){
			$pricemax="999999999";
		}
		else{
			$pricemax=str_replace(',', '', $this->input->post("pricemax"));
		}

		$this->notification_model->add_notifications_settings_return_id($userid,$this->input->post("time"),
												$this->input->post("method"),$this->input->post("item"),
												$this->input->post("type"),$this->input->post("categoryid"),
												$pricemin,$pricemax,
												$areaid,$arealevel);
		
		$this->property_model->get_propertylist_with_id();
		$this->notification_model->get_setting_by_notification_id("(%task0,id%)");
		$this->user_model->get_user_by_userid($userid,$userid);
		commitTasks();	
		GLOBAL $data;
		$this->load->view("layout_controls/notification_settings",$data);
				
		
	}
	
	
	public function update_lastseen($type){
		precheck_login_before_db();
		$userid=get_userid();
		if($type=="all" || $type=="discussion_reply"){
			$this->notification_model->update_lastseen_discussion_reply($userid);
		}
		if($type=="all" || $type=="new_item"){
			$this->notification_model->update_lastseen_discussion_new_item($userid);
		}
		commitTasks();
	}
}

