<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posting extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	 	$this->load->model('property_model');
		$this->load->model('area_model');
		$this->load->model('user_model');
		$this->load->model('result_item_model');
		$this->load->model('activity_model');
		$this->load->helper('itemdata_helper');
		
	
		
		
		
	}

	public function index()
	{
		redirect("posting/newpost");
	
	}
	
	public function newpost(){
		GLOBAL $data;
		
		$data["item"]=convert_post_data_to_item();
		$data['type'] = "new";
		$this->property_model->get_propertylist();	
		$this->property_model->get_all_features(0);
		$this->user_model->get_user_by_userid(get_userid(),get_userid());
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['featuresdict']=handle_features($data);
			$user = $data["user"];
			if(is_agent($user) && $user->verified_agent==0){
				redirect("redirect/directto/agent_under_verify");
			}
		});
		
		$this->render_page('page_input_post',true,"inputpost");
		
	}
	
	public function view($userid=0,$filter="all",$sorttype="posttime%20desc",$start=0){
		GLOBAL $data;	
		$limit=10;
		$forcelogin=false;
		
		$ownuserid=get_userid();		
		if($userid==0) {
			$userid=get_userid();
			$forcelogin=true;
		}
		
		$data['sorttype']=urldecode($sorttype);
		$data['limit']=$limit;
		$data["filter"]=$filter;
		$data["dashboard_page"]="posting";
		$data["posting_userid"]=$userid;
		$data["start"]=$start;
		

		$this->user_model->get_user_by_userid($ownuserid,$userid);
		$pending_restrict = "";
		$show_related = 1;
		if($ownuserid!=$userid){
			$pending_restrict = " and info.pending=0";
			$show_related = 0;
		}

		
		if($filter=="all"){
			$this->result_item_model->get_totalcount_of_posting_by_userid($userid,$pending_restrict,$show_related);
			$this->result_item_model->get_itemsdata_of_userposting_by_userid($userid,$start,$limit,$data['sorttype'],$ownuserid,$pending_restrict,1,$show_related);
		}
		else if($filter=="buy"){
			$this->result_item_model->get_totalcount_buy_or_sell_post($userid,1,$pending_restrict,$show_related);
			$this->result_item_model->get_itemsdata_of_userposting_by_userid_and_type($userid,$start,$limit,$data['sorttype'],1,$ownuserid,$pending_restrict,1,$show_related);
		}
		else{
			$this->result_item_model->get_totalcount_buy_or_sell_post($userid,0,$pending_restrict,$show_related);
			$this->result_item_model->get_itemsdata_of_userposting_by_userid_and_type($userid,$start,$limit,$data['sorttype'],0,$ownuserid,$pending_restrict,1,$show_related);
		}
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				if($data['user']==""){
					$data["404"] = true;
					return;
				} 
				
				$data['pagination'] = generate_pagination('/posting/view/'.$data["posting_userid"]."/".$data["filter"]."/".$data['sorttype'],
															6,$data['totalcount'],$data['limit'],"","");
				$data['itemsdata']=handle_item_array($data['itemsdata']);
		});
		
		$this->render_page('page_dashboard',$forcelogin,"profile");
	}
	
	
	public function edit($itemid)
	{
		GLOBAL $data;
		
		$this->result_item_model->get_item_full_data($itemid);
		$this->property_model->get_propertylist();	
		$this->property_model->get_all_features(0);
		$userid = get_userid();
		$this->user_model->get_user_by_userid($userid,$userid);
		$data['type'] = "edit";
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			if($data['item']==""){
				$data["404"] = true;
				return;
			} 
				
			
			$data['featuresdict']=handle_features($data);
			$data['item']=handle_item_data($data['item']);
			
			if($data["item"]->userid!=get_userid()){
				redirect("redirect/cannot_access");
			}
			
		});

	    
		
		$this->render_page('page_input_post',true,"inputpost");
		
		
	}
	
		//edit_id=0->new post,else edit post
	public function submit($edit_id = 0)
	{
		$content_string=convert_post_data_to_content_string(null,$edit_id);
		$content_string .= " handle_url(%1) " . base_url("posting/handle_file_api");
		$content_string .= "(%3)";
		
		
		user_validated(true,"posting/newpost");
		$userid=get_userid();
		
		$result = $this->result_item_model->insert_edit_post($userid, $content_string, $edit_id, "");	
		$this->result_item_model->check_item_is_pending($result);	
		commitTasks();
		
		
		$edit=1;
		if (is_numeric($result)){
			if($edit_id==0){	//insert new item
				$edit=0;
			}
			GLOBAL $data;
			if($data["is_pending"]=="1"){
				redirect("item/id/".$result);
			}
			else{
				redirect('redirect/directto/successpost/'.$result."/".$edit, 'refresh');
			}
			
			
		}
		else{
			redirect('redirect/directto/warningpost/'.$result, 'refresh');
		}

	}
	
	
	public function handle_file_api(){
		$item_id = $this->input->post("item_id");
		$first_file = $this->input->post("first_file");
		$firstImage = handle_file($item_id,$first_file);
		$this->result_item_model->update_first_image($item_id,$firstImage);
		$this->result_item_model->get_userid_by_itemid($item_id);
		$this->user_model->get_user_by_userid(get_userid(),"(%task0,userid%)");
		$this->result_item_model->check_item_is_pending($item_id);	
		commitTasks();
		GLOBAL $data;
		if($data["is_pending"]!="1"){
			watermark_item_photos($item_id,$data["user"]);
		}
		
	}
	

	
	
	public function delete(){
		precheck_login_before_db();	
		$userid=get_userid();
		$id=$this->input->post("itemid");
		$this->result_item_model->delete_post($id,$userid);
		$this->result_item_model->delete_all_agent_request_by_item_id($id);
		$this->activity_model->insert_activity(9,$userid,$id);
		commitTasks();
	}


	public function get_contacts_latest_post($firstload,$total,$start){
		GLOBAL $data;	
		precheck_login_before_db();	
		$limit=3;
		$userid=get_userid();
		
		if($total==-1) $this->result_item_model->get_friends_post_totalcount($userid);
		$this->result_item_model->get_itemsdata_of_friends_by_userid($userid,$start,$limit);
		
		
		$data["totalcount"]=$total;
		$data['list_type']="latest";
		$data['limit']=$limit;
		$data['start']=$start;
		$data['base_url']="posting/get_contacts_latest_post/0/".$total."/";
		if($firstload) $data['setpagination']=1;
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			if($data["totalcount"]>15) $data["totalcount"]=15;
			$data['itemsdata']=handle_item_array($data['itemsdata']);
			
		
		});
			
		commitTasks();
		$this->load->view("layout_controls/item_listing_vertical",$data);
	}

	public function get_popular_post($firstload,$total,$start){
		
		GLOBAL $data;	
		precheck_login_before_db();	
		$limit=3;
		$userid=get_userid();
		
		if($total==-1) $this->result_item_model->get_totalcount_of_posting();
		$this->result_item_model->get_itemsdata_of_popular_post_by_userid($userid,$start,$limit);
		
		
		$data["totalcount"]=$total;
		$data['list_type']="popular";
		$data['limit']=$limit;
		$data['start']=$start;
		$data['base_url']="posting/get_popular_post/0/".$total."/";
		if($firstload) $data['setpagination']=1;
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			if($data["totalcount"]>15) $data["totalcount"]=15;
			$data['itemsdata']=handle_item_array($data['itemsdata']);
			
		
		});
			
		commitTasks();
		$this->load->view("layout_controls/item_listing_vertical",$data);
		
		
	}	

	public function get_user_latest_post($firstload,$userid,$total,$start){
		GLOBAL $data;	
		$limit=5;
		
		$ownuserid=get_userid();
		
		if($total==-1) $this->result_item_model->get_totalcount_of_posting_by_userid($userid," and info.pending<>1");
		$this->result_item_model->get_itemsdata_of_userposting_by_userid($userid,$start,$limit,"",$ownuserid,'',0);
		
		
		$data["totalcount"]=$total;
		$data['list_type']="latest";
		$data['limit']=$limit;
		$data['start']=$start;
		$data['base_url']="posting/get_user_latest_post/0/".$userid."/".$total."/";
		if($firstload) $data['setpagination']=1;
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			if($data["totalcount"]>25) $data["totalcount"]=25;
			$data['itemsdata']=handle_item_array($data['itemsdata']);
			
		
		});
			
		commitTasks();
		$this->load->view("layout_controls/item_listing_vertical",$data);
		
		
	}
	

}

