<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shortlist extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
		 $this->load->model('user_model');
		 $this->load->model('shortlist_model');
		  $this->load->model('result_item_model');
		   $this->load->model('activity_model');
	}

	public function index()
	{
		
	}
	
	public function view($userid=0,$filter="all",$sorttype="posttime%20desc",$start=0){
	
		GLOBAL $data;	
		$limit=5;
		
		$userid=get_userid();		
		
		$data['sorttype']=urldecode($sorttype);
		$data['limit']=$limit;
		$data["filter"]=$filter;
		$data["dashboard_page"]="shortlist";
		$data["posting_userid"]=0;
		$data["start"]=$start;
		
		$this->user_model->get_user_by_userid($userid,$userid);
		
		if($filter=="all"){
			$this->shortlist_model->get_totalcount_of_shortlist($userid);
			$this->shortlist_model->get_itemsdata_of_shortlist_by_userid($userid,$start,$limit,$data['sorttype']);
		}
		else if($filter=="buy"){
			$this->shortlist_model->get_totalcount_buy_or_sell_shortlist($userid,1);
			$this->shortlist_model->get_itemsdata_of_shortlist_by_userid_and_type($userid,$start,$limit,$data['sorttype'],1);
		}
		else{
			$this->shortlist_model->get_totalcount_buy_or_sell_shortlist($userid,0);
			$this->shortlist_model->get_itemsdata_of_shortlist_by_userid_and_type($userid,$start,$limit,$data['sorttype'],0);
		}
		
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				$data['pagination'] = generate_pagination('/shortlist/view/0/'.$data["filter"]."/".$data['sorttype'],
															6,$data['totalcount'],$data['limit'],"","");
				$data['itemsdata']=handle_item_array($data['itemsdata']);
		});
		
		$this->render_page('page_dashboard',true,"profile");
		
		
		
		
	}


	public function get_shortlist_html(){
		GLOBAL $data;	
		precheck_login_before_db();	
		
		$userid=get_userid();
		
		$this->shortlist_model->get_shortlist_modified_meta($userid);
		$this->shortlist_model->get_itemsdata_of_shortlist($userid,"(%task0,itemid%)");
	
		
		GLOBAL $tasksCompletedCallBack;
		array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				$data['itemsdata']=handle_item_array($data['itemsdata']);
				foreach($data["shortlist_modified_meta"] as $meta){
					foreach($data['itemsdata'] as $item){
						if($meta->itemid==$item->id){
							$item->shortlist_datetime=$meta->resultdatetime;
							$item->action_datetime=$meta->modified_datetime;
							$item->modified_type=$meta->action;
							$item->unread=$meta->new;
						}
						
					}
				}
												

		});
	
			
		commitTasks();
		
		$this->load->view("layout_controls/shortlist_popup_listing",$data);
		
	}

	public function update_lastseen_shortlist(){
		precheck_login_before_db();		
		$userid=get_userid();	

		$this->user_model->update_lastseen_shortlist($userid);
		commitTasks();
		
	}
	


	public function delete_shortlist(){
		precheck_login_before_db();	
		$userid=get_userid();
		$itemid=$this->input->post("itemid");
		$this->shortlist_model->delete_shortlist($userid,$itemid);
		commitTasks();
		
	}
	
	public function add_shortlist(){
		precheck_login_before_db();	
				
		$userid=get_userid();
		$itemid=$this->input->post("itemid");
		$this->shortlist_model->add_shortlist($userid,$itemid);
		$this->activity_model->insert_activity(3,$userid,$itemid);
		commitTasks();
	}

	
	
}

