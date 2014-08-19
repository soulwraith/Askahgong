<?php   
        
    class Activity_model extends CI_Model { 
        
				
		function insert_activity($action,$userid,$targetid,$reserved=""){
      		$sql="call askahgong.add_activity(".$action.",".$userid.",".$targetid.",'".$reserved."')";
			push_task("","nonquery",$sql,array());
			
        }    
		
		
		function get_activities_of_mine($lastid=0,$userid,$limit){
			$sql="call askahgong.getMyActivity(".$lastid.",".$limit.",".$userid.");";
			push_task("activities","json",$sql,array());
		}
		
		function get_activities_of_others($lastid=0,$myuserid,$otherpeopleid,$limit){
			$sql="call askahgong.getPeopleActivity(".$lastid.",".$limit.",".$myuserid.",".$otherpeopleid.");";
			push_task("activities","json",$sql,array());
		}
		
   }  