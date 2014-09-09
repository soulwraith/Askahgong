<?php   

    class Agent_comment_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
        function get_all_comment_threads($agent_id,$limit,$start,$user_id=0,$type="any"){
        	$append = "";
			if($type=="good"){
				$append.=" and reason.award>0";
			}
			else if($type=="bad"){
				$append.=" and reason.award<0";
			}
			
			
        	 $sql = "select thread.*,
        	 		thread.id as main_id,
        	 		reason.title,
        	 		agent_info.username as agent_username,
        	 		info.username as user_username,
        	 		getUserStatus(info.id) as user_isonline,
        	 		getUserStatus(agent_info.id) as agent_isonline,
        	 		(select count(id) from askahgong.agent_comment_reply where thread_id = thread.id) as replies_count,
        	 		IF(info.id=".$user_id.",1,0) as user_order
        	 		FROM 
        	 			askahgong.agent_comment_thread thread 
        	 		LEFT JOIN 
        	 		 	askahgong.user_info agent_info 
        	 		 	ON thread.agent_id=agent_info.id 	
        	 		LEFT JOIN 
        	 		 	askahgong.user_info info 
        	 		 	ON thread.userid=info.id 
        	 		LEFT JOIN 
        	 			askahgong.points_reason reason 
        	 			ON reason.id = thread.reason_id
        	 	    WHERE 
        	 	    	thread.agent_id=? and reason.agent_review=1 ".$append."
        	 	    ORDER BY 
        	 	    	user_order desc,thread.dateandtime DESC 
        	 	    LIMIT 
        	 	    	".$limit." 
        	 	    OFFSET 
        	 	    	".$start."";
        	 push_task("comment_threads","json_no_mod",$sql,array($agent_id));	    	
        }    
        
        function get_all_comment_threads_count($agent_id,$type="any",$name="comment_threads_count"){
        			
        	$sql = "select getAgentCommentTotalCount(".$agent_id.",'".$type."')";		
         	 push_task($name,"scalar",$sql,array());	
        }
        
          function get_thread_start_offset($thread_id){
        		 $sql = "select count(thread.id)
        	 		FROM 
        	 			askahgong.agent_comment_thread thread 
        	 		WHERE 
        	 	    	thread.id>=".$thread_id."";
        	 push_task("offset","scalar",$sql,array());	
        }
		
		 function get_thread_userid($thread_id){
		 	 $sql = "select userid
        	 		FROM 
        	 			askahgong.agent_comment_thread thread 
        	 		WHERE 
        	 	    	thread.id=".$thread_id."";
        	 push_task("thread_userid","scalar",$sql,array());	
		 }
		
		function get_all_comment_replies_by_thread_id($thread_id,$max_reply_id){
			$sql = "select reply.*,
						info.username as username,
						getUserStatus(info.id) as isonline
					 FROM 
					 	askahgong.agent_comment_reply reply
					 LEFT JOIN 
        	 		 	askahgong.user_info info 
        	 		 	ON reply.userid=info.id 
					 where 
					 	reply.thread_id = '".$thread_id."'
					 	AND reply.id<".$max_reply_id."";
			push_task("comment_replies","json_no_mod",$sql,array());	    	
		}
		
		
		function get_comment_replies_by_thread_ids($thread_ids){
			$sql = "select reply.*,
						info.username as username,
						getUserStatus(info.id) as isonline
					from askahgong.agent_comment_reply reply
					LEFT JOIN 
					        	 		 	askahgong.user_info info 
					        	 		 	ON reply.userid=info.id 
					where find_in_set(reply.thread_id,'".$thread_ids."') and (
					   select count(*) from askahgong.agent_comment_reply as f
					   where f.thread_id = reply.thread_id and f.id >= reply.id
					) <= 2;
					";
			push_task("comment_replies","json_no_mod",$sql,array());	    	
		}
		

		function get_comment_replies_by_comment_id($comment_id){
			$sql = "select reply.*,
						info.username as username,
						getUserStatus(info.id) as isonline
					 FROM 
					 	askahgong.agent_comment_reply reply
					 LEFT JOIN 
        	 		 	askahgong.user_info info 
        	 		 	ON reply.userid=info.id 
					 where 
					 	reply.id='".$comment_id."'";
			push_task("comment_replies","json_no_mod",$sql,array());	    	
		}
		
		function get_user_previous_agent_comment_thread_count($userid,$agent_id){
			$sql = "select 
						count(id)
					 FROM 
					 	askahgong.agent_comment_thread
					 where 
					 	userid=? and agent_id=?";
			push_task("count","scalar",$sql,array($userid,$agent_id));	    	
		}
		
		function insert_thread_get_thread_id($agent_id,$userid,$content,$reason_id,$point){
			$sql = "INSERT INTO
						askahgong.agent_comment_thread
					(userid,agent_id,reason_id,content,point,dateandtime)
						VALUES
						(?,?,?,?,'".$point."',NOW());
					SELECT LAST_INSERT_ID() AS thread_id;";
		     push_task("thread_id","scalar",$sql,array($userid,$agent_id,$reason_id,$content));
		}
		
		function insert_thread_reply_get_reply_id($thread_id,$userid,$content){
			$sql = "INSERT INTO
						askahgong.agent_comment_reply
					(userid,thread_id,content,dateandtime)
						VALUES
						(?,?,?,NOW());
					SELECT LAST_INSERT_ID() AS reply_id;";
		     push_task("reply_id","scalar",$sql,array($userid,$thread_id,$content));
		}
		
		function report_agent_comment_thread($thread_id){
			$sql = "UPDATE
						askahgong.agent_comment_thread
					SET reported=1
					WHERE id=?";
		     push_task("","nonquery",$sql,array($thread_id));
		}
		
		function unreport_agent_comment_thread($thread_id){
			$sql = "UPDATE
						askahgong.agent_comment_thread
					SET reported=0
					WHERE id=?";
		     push_task("","nonquery",$sql,array($thread_id));
		}
		
		function delete_previous_agent_comment_thread($agent_id,$userid){
			$sql = "DELETE from
						askahgong.agent_comment_thread
					WHERE agent_id=? and userid=?";
		     push_task("","nonquery",$sql,array($agent_id,$userid));
		}
	 	
	 	function get_previous_agent_comment_thread($agent_id,$userid){
			$sql = "SELECT * from
						askahgong.agent_comment_thread
					WHERE agent_id=? and userid=? LIMIT 1";
		     push_task("thread","json_single",$sql,array($agent_id,$userid));
		}
	 	
	 	
	 	function delete_all_agent_comment_activity($agent_id,$userid){
	 		$sql = "DELETE FROM
	 					askahgong.activity
	 				where 
	 					(action = 'agentReview' and reserved IN (select th.id from askahgong.agent_comment_thread th where th.userid='".$userid."' and th.agent_id='".$agent_id."'))
	 				OR
	 					(action = 'agentReviewReply' and reserved IN (select rp.id from askahgong.agent_comment_reply rp where rp.id IN (select id from askahgong.agent_comment_thread th where th.userid='".$userid."' and th.agent_id='".$agent_id."')))
	 				";
			 push_task("","nonquery",$sql,array());
	 	}
	 	
		
		
    }  