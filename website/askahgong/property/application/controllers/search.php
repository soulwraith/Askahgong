<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	 	$this->load->model('property_model');
		$this->load->model('dictionary_model');
		$this->load->model('area_model');
		$this->load->model('result_item_model');
		$this->load->helper('itemdata_helper');
	}

	public function index($start = 0)
	{
		GLOBAL $data;
		$query_string=$this->input->server('QUERY_STRING');
		$userid=get_userid();
		$limit=10;
		GLOBAL $tasksCompletedCallBack;
		
		if(!isset($_GET["sorttype"])) $sorttype="";
		else $sorttype=$_GET["sorttype"];
		
		$data['sorttype']=$sorttype;
		$data['pagestart']=$start;
		$data['limit']=$limit;
		$data['query_string']=$query_string;
		$data['start']=$start;
		
		
		$this->property_model->get_all_features(1);
		
		
		if($query_string==""){	//default search page
		
			$this->result_item_model->get_totalcount_by_action(1);
			$this->result_item_model->get_itemsdata_by_action(1,$start,$limit,$sorttype,$userid);
		
		
		}
		
		else{	//search page with query
			 
			
			$content_string=convert_post_data_to_content_string();
			$this->result_item_model->get_itemsdata_with_totalcount_by_search($content_string,$userid,$sorttype,$start,$limit);
			
			array_push($tasksCompletedCallBack,function(){
				GLOBAL $data;
				$meta=explode("(%separator3)",$data['itemsdata_with_totalcount']);
				$data['itemsdata']=strip_redundant(json_decode($meta[0]));
				$data["totalcount"]=$meta[1];
			});			
		
		}
		
		$this->property_model->get_propertylist();
		$this->dictionary_model->get_facilities_include_subcategory();
		array_push($tasksCompletedCallBack,function(){
			GLOBAL $data;
			$data['itemsdata']=handle_item_array($data['itemsdata']);
			$data['propertylist']=handle_propertylist($data['propertylist']);
			$data['featuresdict']=handle_features($data);
			$data['facilities']=handle_facilities($data['facilities']);
			
			$data['pagination'] = generate_pagination('/search/',2,$data['totalcount'],$data['limit'],"?".$data['query_string']);
		});
		
								
		$this->render_page('page_search',false,"search");
	}
	
	
	

	
	
}

	