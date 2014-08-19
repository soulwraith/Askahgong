<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
		$this->load->model('user_model');
		$this->load->model('activity_model');
	    $this->load->model('result_item_model');
		$this->load->helper('itemdata_helper');
		$this->load->helper('image_helper');
	}

	public function id($itemid){
		GLOBAL $data;
		$userid=get_userid();
		
		if($itemid==0) $itemid = -1;

		$this->result_item_model->get_item_full_data($itemid,$userid);
		$this->result_item_model->submit_view_counter($itemid,$userid);
		$this->result_item_model->get_item_lastseen($itemid,$userid);
		$this->user_model->get_user_by_userid($userid,"(%task0,userid%)");
		$this->result_item_model->get_related_items_meta($itemid);
		$this->result_item_model->update_item_lastseen($itemid,$userid);
		$this->user_model->get_user_by_userid($userid,$userid,"","myuser");
		
		
		generate_item_thumbnail($itemid);
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			
			if($data['item']==""){
				$data["404"] = true;
				return;
			} 
			
			$data['item']=handle_item_data($data['item']);
			
			$userid=get_userid();
			
		
			if($data['item']->pending=="1" && $data['item']->userid==$userid){
				redirect("pending_item/id/".$data["item"]->id);
			}
			else if($data['item']->pending=="1" && !is_verified_agent($data["myuser"])){
				redirect("redirect/cannot_access");
			}
			
			
			
			$related_items_result_arr=explode(",",$data["related_items_meta"]);
			$data['b_a']=$related_items_result_arr[0];
			$data['b_p']=$related_items_result_arr[1];
			$data['s_a']=$related_items_result_arr[2];
			$data['s_p']=$related_items_result_arr[3];
			$data['b_pa']=$related_items_result_arr[4];
			$data['s_pa']=$related_items_result_arr[5];
			
			if($data['item']->userid==$userid){
				$CI =& get_instance();
				$arr=$CI->result_item_model->get_search_processid_and_total_by_itemid($userid,$data['item']->id);
				$data['processid']=$arr[0];
				$data['totalcount']=$arr[1];
			}
			
		});
		
		$this->render_page('page_item',false,"");
	}
	
	
	
	
	
	
	
	public function get_related($type,$start,$itemid){
		$items=handle_item_array($this->result_item_model->get_related_items($type,$start,10,$itemid));
		 foreach($items as $item){
		 	$result["item"]=$item;
			$result["item_type"]=$type;
		 	$this->load->view("layout_controls/item_listing_horizontal",$result);
		 }
		
	}
	
	public function get_matched_items($firstload,$user_lastseen,$processid,$total,$start){
		precheck_login_before_db();
		$limit=5;
		$userid=get_userid();
		GLOBAL $data;
		$this->result_item_model->get_itemsdata_by_process_id($processid,$start,$limit,$userid);
		$data["user_lastseen"]=date("Y-m-d H:i:s", $user_lastseen);
		$data['list_type']="latest";
		$data['limit']=$limit;
		$data['start']=$start;
		$data['totalcount']=$total;
		$data['base_url']="item/get_matched_items/1/".strtotime($data["user_lastseen"])."/".$processid."/".$total."/";
		$data['itempage']=true;
		
		if($firstload==0) $data['setpagination']=1;
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['itemsdata']=handle_item_array($data['itemsdata']);
		});
		commitTasks();
		$this->load->view("layout_controls/item_listing_vertical",$data);
	}
	
	
}
