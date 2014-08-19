<?php   
        
    class Message_model extends CI_Model { // Our Cart_model class extends the Model class  
        
        function send_message($touserid,$fromuserid,$message,$bysms) {
          	$sql="INSERT INTO 
          			askahgong.message 
          			(message,touserid,fromuserid,dateandtime,sms) 
          			VALUES 
          			(?,".$touserid.",".$fromuserid.",NOW(),".$bysms.");
          			SELECT LAST_INSERT_ID() AS message_id;";
      		push_task("message_id","scalar",$sql,array($message));
	    }    
		
		function append_message($id,$msg) {
          	$sql="UPDATE
          			askahgong.message 
          		  SET
          		  	message = CONCAT(message,?)
          		  WHERE
          		  	id = ".$id."";
      		push_task("","nonquery",$sql,array($msg));
	    }    
		
		
		function send_sms($touserid,$message){
			SendSMS($touserid,$message);			
		}
      
        function get_unread_message_from_contact($userid,$targetuserid){
        	
			$sql="SELECT 
					count(id) 
				  FROM 
				  	askahgong.message 
				  WHERE 
				  	touserid='".$userid."' and fromuserid='".$targetuserid."' and newmessage='1'";
      		push_task("unread","scalar",$sql,array());
        }    
		
				
		function get_conversations($userid){
			$sql="call getPastConversationList(".$userid.")";
			push_task("conversations","json",$sql,array());
			 
		}
		
		function get_inbox_messages($userid){
			 $sql = "select * from askahgong.message msg,askahgong.user_info user1 where user1.id=msg.fromuserid and msg.touserid='$userid' and msg.touserdeleted='0' order by msg.newmessage desc";
			 $wsResult = getResultInJsonDecodeArray($sql);
		     return $wsResult;
		}
		
		function get_unread_users($userid){
			$sql = "SELECT 
						msg.fromuserid,info.username,count(msg.id) as unreadcount
					FROM 
						askahgong.message msg 
					INNER JOIN 
						askahgong.user_info info 
						ON msg.fromuserid=info.id 
					WHERE 
						msg.touserid=? and msg.newmessage='1'
					GROUP BY 
						msg.fromuserid";
			 push_task("unread_users","json_no_mod",$sql,array($userid));	
		}
		
		
		function get_all_targetuser_messagedata($targetuserid,$userid,$start,$limit){
			$sql =     "(SELECT 
				 			msg.*,user1.username 
				 		FROM 
				 			askahgong.message msg,askahgong.user_info user1 
				 		WHERE user1.id=msg.fromuserid and msg.touserid='$userid' 
				 		      and msg.fromuserid='$targetuserid')
			 	    UNION 
				 	    (SELECT 
				 	    	msg.*,user1.username 
				 	    FROM 
				 	    	askahgong.message msg,askahgong.user_info user1 
				 	    WHERE 
				 	     	user1.id=msg.fromuserid and msg.touserid='$targetuserid'
				 	    	and msg.fromuserid='$userid')
			 	     ORDER BY 
			 	     	id DESC 
			 	     LIMIT ".$start.",".$limit;
			 push_task("messagedata","json",$sql,array());
		}
		
		function mark_all_message_as_read($userid,$targetuserid){
			ExecuteNonQuery("update askahgong.message set newmessage='0' where touserid='".$userid."' and fromuserid='".$targetuserid."'");
		}
		
		function get_max_message_id($userid){
			$id=getExecuteScalar("select IFNULL(max(id),0) from askahgong.message where touserid='".$userid."'");
			return $id;
		}
		
		function check_cannot_sms_result($userid,$targetuserid){
			$sql="select checkCannotSMS(".$userid.",".$targetuserid.")";
			push_task("result","scalar",$sql,array());
		}
		
    }  