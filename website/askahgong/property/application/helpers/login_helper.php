<?php
	 function user_validated($forcelogin=false,$loginurl=""){
		
		$CI =& get_instance();
		$CI->load->model('user_model');
		$userid="";
		
		if(get_userid()!=0) return true;
		
		if (get_cookie('remembertoken')!=false){
			
			$token=get_cookie('remembertoken');
			
			$userid=$CI->user_model->get_userid_by_remembertoken($token);
			if($userid!=""){
				  $CI->session->set_userdata("userid",$userid);
			}	
			else{
				delete_cookie("remembertoken");
				$CI->session->unset_userdata('userid');
				if($forcelogin==true){
			
					redirect("user/login?&login=".$loginurl);
				}	
				else{
					return false;
				}
          	
			}
		}
		else{
			if ($CI->session->userdata('userid')==false){
				if($forcelogin==true){

					redirect("user/login?&login=".$loginurl);
				}	
				else{
					return false;
				}
					
			
			}
		}

    	
		return true;
		
	}
	 
	 
	function precheck_login_before_db(){
		if(get_userid()!=0) return true;
		else redirect("user/asklogin");
	} 
	
	function admin_validated(){
		$userid=get_userid();
		$CI =& get_instance();
		$CI->user_model->check_is_admin_by_userid($userid);
		commitTasks();
		GLOBAL $data;
		if(!$data["is_admin"]) redirect("");
	}
	
	
	 
 
?>