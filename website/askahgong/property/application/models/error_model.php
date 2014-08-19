<?php   
        
    class Error_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
    
		function mark_location_awarded($processid){
			$sql ="update
					 askahgong.processrecord 
				   SET
				     awarded_location=1
				   WHERE
				   	 id='".$processid."'";	
		   push_task("","nonquery",$sql,array());	 
		}
		
		function mark_facility_awarded($processid){
			$sql ="update
					 askahgong.processrecord 
				   SET
				     awarded_facility=1
				   WHERE
				   	 id='".$processid."'";	
		   push_task("","nonquery",$sql,array());	 
		}
		
		function get_errorsdata_totalcount(){
    		$sql  ="SELECT 
    					count(record.id) 
    				FROM 
    					askahgong.processrecord record
    				WHERE 
    					record.status='2'"
    				;
		   push_task("totalcount","scalar",$sql,array());	 
    	}
		
		function get_errorsdata(){
    		$sql  ="SELECT 
    					record.*,info.username 
    				FROM 
    					askahgong.processrecord record
    				LEFT JOIN
    					askahgong.user_info info
    				ON
    					record.userid=info.id
    				WHERE 
    					record.status='2'
    				ORDER BY
    					record.dateandtime
    			    DESC";
		   push_task("errorsdata","json_no_mod",$sql,array());	 
    	}
		
		function get_errorsdata_by_id($id){
    		$sql  ="SELECT 
    					record.*,info.username 
    				FROM 
    					askahgong.processrecord record
    				LEFT JOIN
    					askahgong.user_info info
    				ON
    					record.userid=info.id
    				WHERE 
    					record.status='2' and record.id='".$id."'
    				ORDER BY
    					record.dateandtime
    			    DESC";
		   push_task("errorsdata","json_no_mod",$sql,array());	 
    	}
		
		function set_handling($id,$username){
			$sql  ="UPDATE 
    					askahgong.processrecord record
    				SET
    					record.handling=?
    				WHERE 
						 record.id='".$id."'
    				";
		   push_task("","nonquery",$sql,array($username));	
		}
		
		
		function reject_learning($id,$reason){
			$query="update askahgong.processrecord set status='0',waitingcode='11',serverrespond='".$reason."' where id='".$id."'";
			ExecuteNonQuery($query);
		}
		
		function update_learning($id,$reason,$waitingcode){
			$query="update askahgong.processrecord set status='0',waitingcode='".$waitingcode."',serverrespond='".$reason."' where id='".$id."'";
			ExecuteNonQuery($query);
		}
		
		function delete_learning($id){
			$query="update askahgong.processrecord set status='5' where id='".$id."'";
			ExecuteNonQuery($query);
		}
		
		//type=smsorweb variable
		function retry_learning($id,$type){
			$sql="update askahgong.processrecord set status='0',waitingcode='10' where id='".$id."'";
			push_task("","nonquery",$sql,array());	 
		}
		
		function set_to_notify($id){
			
			$sql="update askahgong.processrecord set notified='0' where id='".$id."'";
			push_task("","nonquery",$sql,array());	 
		}
		
		function check_in_learning($id){
			$result=getExecuteScalar("select count(id) from askahgong.processrecord where status='2' and id='".$id."'");
			return $result;
		}
		
		function add_new_learning($text,$userid){
			$sql="insert into askahgong.processrecord (userid,text,smsorweb,status,dateandtime) values (?,?,3,2,NOW())";
			push_task("","nonquery",$sql,array($userid,$text));	 
		}
		
		function update_user_text($processid,$text){
			$sql="update askahgong.processrecord set text=? where id=?";
			push_task("","nonquery",$sql,array($text,$processid));	 
		}
		
		function delete_agent_verification($userid){
			$sql="update askahgong.processrecord set status=5 where smsorweb=4 and userid=?";
			push_task("","nonquery",$sql,array($userid));	
		}
		
		function add_new_agent_verification($agency,$userid){
			$sql="insert into askahgong.processrecord (userid,text,smsorweb,status,dateandtime) values (?,?,4,2,NOW())";
			push_task("","nonquery",$sql,array($userid,$agency));	 
		}
		
		function add_new_agent_review_report($text,$userid){
			$sql="insert into askahgong.processrecord (userid,text,smsorweb,status,dateandtime) values (?,?,5,2,NOW())";
			push_task("","nonquery",$sql,array($userid,$text));	 
		}
		
		
    }  