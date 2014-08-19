<?php


class MY_Controller extends CI_Controller {

  
  
  function __construct() {
    parent::__construct();
	$this->load->model("user_model");
	$this->load->model("message_model");
	$this->load->model("notification_model");
	$this->load->model("shortlist_model");
	$this->load->model("points_model");
	$this->load->helper("error_helper");
	user_validated();
  }
	
  function premature_check_properuri($data){
	  	if(isset($data['proper_uri']) && $data['proper_uri']!=""){
	    	$proper_uri=$data['proper_uri'];
		    $current_uri = current_full_url();

		    if ($current_uri != $proper_uri) {
		        redirect($proper_uri,'location', 301);
				return;
		    }
	    }
  }	
	
	
	

	
	
  function render_page($view,$forcelogin,$header_title,$attributes="") {
    //do this to don't repeat in all controllers...
    
    try{
    	GLOBAL $data;
     	$data['userlogin'] = user_validated($forcelogin,uri_string());
		$data['active'] = $header_title;
		$data['attrs'] = $attributes;
	   	$userid=get_userid();
		
		if($data['userlogin']){
			$this->user_model->get_contacts($userid);
			$this->user_model->get_username_by_userid($userid);
			$this->user_model->get_user_by_userid($userid,$userid,"","myDetails");
			$this->user_model->get_role_level_by_userid($userid);
			$this->notification_model->get_new_notifications_count($userid);
			$this->shortlist_model->get_shortlist_modified_totalcount($userid);	
			$this->shortlist_model->get_totalcount_of_shortlist($userid,"shortlist_totalcount");
			$this->points_model->add_points($userid,1,0);
			$this->points_model->get_unread_points_id($userid);
			$this->user_model->update_lastseen($userid);
		}	
		else{
			$data["isAgent"] = false;
		}
		

		
		commitTasks();
		
	
		if(isset($data["myDetails"]) && is_verified_agent($data["myDetails"])){
			$data["isAgent"] = true;
		}
		else{
			$data["isAgent"] = false;
		}
		
		if(isset($data["role_level"]) && $data["role_level"]<=2) $data["admin"]=true;
		else $data["admin"]=false;

		if(isset($data["404"]) && $data["404"]){
				
			show_custom404();
			return;
		}
		
		
		$this->load->view('obj_header', $data);
	    $this->load->view($view, $data);
		
	    $this->load->view('obj_footer', $data);
    }
	catch(Exception $ex){
		GLOBAL $data;
		$data['userlogin'] = false;
       	show_custom500($ex);
    }
	
  }


	

}
?>