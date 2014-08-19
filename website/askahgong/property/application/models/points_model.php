<?php   
        
    class Points_model extends CI_Model { 
        
				
		function add_points($userid,$type,$reserved){
			$sql="call askahgong.add_points ('".$userid."','".$type."','".$reserved."');";									
        
			push_task("","nonquery",$sql,array());
			
        }    
		
		function get_next_level_required_exp($level){
			$sql="select askahgong.getRealNextLevelExpNeeded(".$level.")";
			push_task("exp","scalar",$sql,array());
		}
		
		function get_points_by_reason_id($reason_id){
			$sql="select * from askahgong.points_reason where id='".$reason_id."'";
			push_task("points","json",$sql,array());
		}
		
		function get_unread_points_id($userid){
			$sql="select id from askahgong.points_log log where log.read=0 and log.userid='".$userid."'";									
			push_task("unread_points_id","json",$sql,array());
		}
		
		function get_unread_points_details_by_points_id($points_id){
			$sql="call askahgong.get_unread_points(".$points_id.")";									
			push_task("unread_points_details","json_single",$sql,array());
		}
		
		
		function mark_points_as_read($points_id){
			$sql="update askahgong.points_log log set log.read=1 where log.id=".$points_id."";									
			push_task("","nonquery",$sql,array());
		}
		
		function mark_all_points_as_read($userid){
			$sql="update askahgong.points_log log set log.read=1 where log.userid=".$userid."";									
			push_task("","nonquery",$sql,array());
		}
		
		function get_all_review_feedbacks($type,$name="review_feedbacks"){
			if($type=="good"){
				$sql="select * from askahgong.points_reason where award>0 and agent_review=1";		
			}
			else{
				$sql="select * from askahgong.points_reason where award<0 and agent_review=1";	
			}
			push_task($name,"json",$sql,array());
		}
		
		
		
    }  