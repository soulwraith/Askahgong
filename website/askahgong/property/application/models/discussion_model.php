<?php   

    class Discussion_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
        function get_topic($categoryid,$limit,$start){
        	 $sql = "select topic.*,(IFNULL(comment1.dateandtime,topic.dateandtime)) as realdatetime,
        	 		comment1.*,comment1.id as lastreplycommentid,
        	 		comment1.dateandtime as lastreplydateandtime,
        	 		comment1.userid as lastreplyuserid,info1.username as lastreplyusername,
        	 		getUserStatus(topic.userid) as isonline,
        	 		info.username,(select count(id) from askahgong.discussioncomment where topicid=topic.id) as postscount 
        	 		FROM 
        	 			askahgong.discussiontopic topic 
        	 		LEFT JOIN 
        	 		 	askahgong.user_info info 
        	 		 	ON topic.userid=info.id 
        	 		LEFT JOIN 
        	 			askahgong.discussioncomment comment1 
        	 			ON comment1.id=(select max(id) from askahgong.discussioncomment where topicid=topic.id)
        	 	    LEFT JOIN 
        	 	    	askahgong.user_info info1 
        	 	    	ON info1.id=comment1.userid 
        	 	    WHERE 
        	 	    	topic.categoryid=? 
        	 	    ORDER BY 
        	 	    	solved,realdatetime DESC 
        	 	    LIMIT 
        	 	    	".$limit." 
        	 	    OFFSET 
        	 	    	".$start."";
        	 push_task("topics","json",$sql,array($categoryid));	    	
        }    
		
		function submit_topic_return_topic_id($categoryid,$title,$text,$userid){
			 $sql="INSERT INTO 
			 			askahgong.discussiontopic 
			 			(userid,topictext,dateandtime,topictitle,categoryid) 
			 	   VALUES 
			 			(?,?,NOW(),?,?);
			 	   SELECT LAST_INSERT_ID() AS topic_id;";
		     push_task("topic_id","scalar",$sql,array($userid,$text,$title,$categoryid));
			
			
		}
		
		function edit_topic($categoryid,$title,$text,$userid,$topicid){
			 $sql="update 
			 			askahgong.discussiontopic 
			 			SET topictext=?,topictitle=?,categoryid=? 
			 	   WHERE 
			 			userid=? and id=?";
		     push_task("","nonquery",$sql,array($text,$title,$categoryid,$userid,$topicid));
			
			
		}
		
		function get_total_topic_count($categoryid){
			 $sql = "select count(id) from askahgong.discussiontopic where categoryid=?";
		     push_task("totalcount","scalar",$sql,array($categoryid));
		     
		}
		
		function get_total_topic_count_by_userid($userid){
			 $sql = "select count(id) from askahgong.discussiontopic where userid=?";
		     push_task("total_topic_count","scalar",$sql,array($userid));
		     
		}
		
		function get_total_topic_comment_count_by_userid($userid){
			 $sql = "select count(id) from askahgong.discussioncomment where userid=?";
		     push_task("total_comment_count","scalar",$sql,array($userid));
		     
		}
		
	    function get_topic_by_id($id){
 			 $sql = "SELECT 
 			 			topic.*,comment.*,comment.dateandtime as lastreplydateandtime,
 			 			comment.userid as lastreplyuserid,info1.username as lastreplyusername,
 			 			getUserStatus(topic.userid) as isonline,
 			 			info.username,(select count(id) from askahgong.discussioncomment where topicid='$id') as postscount 
 			 		 FROM 
 			 		 	askahgong.discussiontopic topic 
 			 		 LEFT JOIN 
 			 		 	askahgong.user_info info 
 			 		 	ON topic.userid=info.id
 			 		 LEFT JOIN 
 			 		 	askahgong.discussioncomment comment 
 			 		 	ON comment.id=(select max(id) from askahgong.discussioncomment where topicid='".$id."') 
 			 		 LEFT JOIN 
 			 		 	askahgong.user_info info1 
 			 		 	ON info1.id=comment.userid where topic.id='".$id."'";
			 push_task("topic","json_single",$sql,array());	    	
        }    	
		
	    function get_topic_comments_by_topic_id($topicid,$start,$limit){
 			 $sql = "SELECT 
 			 			*,
 			 			getUserStatus(info.id) as isonline
 			 		FROM 
 			 			askahgong.discussioncomment comment,askahgong.user_info info 
 			 		WHERE 
 			 			comment.userid=info.id and comment.topicid='$topicid' 
 			 		ORDER BY 
 			 			comment.dateandtime ASC 
 			 		LIMIT 
 			 			".$limit."
 			 		OFFSET 
 			 		 	".$start;
			 push_task("topic_comments","json",$sql,array());	
        }    	
        
        function get_comment_row_number($commentid,$topicid){
        	$sql="SELECT 
        				COUNT(id) 
        			FROM 
        				askahgong.discussioncomment 
        			WHERE id<'".$commentid."' and topicid='".$topicid."'";
        		push_task("comment_row_number","scalar",$sql,array());	
						
        }
	
		
        
        function get_categories(){
        	$sql="select * from askahgong.discussioncategory order by sequence asc";
        	push_task("categories","json_no_mod",$sql,array());
        }
        
        function get_currentcategory_by_topic_id($topicid){
        	$sql=  "SELECT 
        				cat.id,cat.category 
        			FROM 
        				askahgong.discussiontopic topic 
        			INNER JOIN 
        				askahgong.discussioncategory cat 
        			ON 
        				topic.categoryid=cat.id 
        			WHERE topic.id=?";
       		push_task("currentcategory","json_single",$sql,array($topicid));	    	
        }
        
        function get_currentcategory_by_categoryid($categoryid){
        	$sql=  "SELECT 
        				*
        			FROM 
        				askahgong.discussioncategory cat 
        			WHERE 
        				cat.id=?";
       		push_task("currentcategory","json_single",$sql,array($categoryid));	
        }
        
    
	 	function submit_comment_return_commentid($comment,$topicid,$userid){
			$sql="INSERT INTO 
						askahgong.discussioncomment (userid,topicid,comment,dateandtime) 
				  VALUES 
				  		(?,?,?,NOW());
				  SELECT LAST_INSERT_ID() AS commentid;"; 
			push_task("commentid","scalar",$sql,array($userid,$topicid,$comment));			
	 	}
	 	
	 	function edit_comment($comment,$topicid,$userid,$commentid){
   			$sql="UPDATE 
   					askahgong.discussioncomment 
   				  SET 
   				  	comment=?
   				  WHERE 
   				  	topicid=? and userid=? and id=?;";
			push_task("","nonquery",$sql,array($comment,$topicid,$userid,$commentid));		
	 	}
	 	 
	 	function delete_topic($topicid){
 			 $sql = "DELETE FROM 
 			 			askahgong.discussiontopic 
 			 		WHERE
 			 		     id='$topicid'";
			 push_task("","nonquery",$sql,array());		
		  	
	 	}
	 
	 	function delete_comment($commentid,$userid){
	 		 $sql = "UPDATE
	 		 			 askahgong.discussioncomment 
	 		 	     SET 
	 		 	     	 hidden='1' 
	 		 	     WHERE 
	 		 	     	 id='$commentid' and userid='".$userid."'";
			 push_task("","nonquery",$sql,array());		
	 	}
	 	
	 	function delete_comment_admin($commentid){
	 		 $sql = "UPDATE
	 		 			 askahgong.discussioncomment 
	 		 	     SET 
	 		 	     	 hidden='1' 
	 		 	     WHERE 
	 		 	     	 id='$commentid'";
			 push_task("","nonquery",$sql,array());		
	 	}
	 
	 
	 	function topic_add_counter($topicid){
	 		 $sql = "UPDATE 
	 		 			askahgong.discussiontopic
	 		 		SET 
	 		 			viewscount=(viewscount+1) 
	 		 		WHERE 
	 		 			id='$topicid'";
			 push_task("","nonquery",$sql,array());		
	 	}
		
	
		function get_categoryid_by_category($category){
    		$query="select id from askahgong.discussioncategory where category='".$category."'";
			$wsresult=getExecuteScalar($query);
			return $wsresult;
    	}

		
		function get_topic_comment($topicid){
			$query="select cmt.*,user.username from askahgong.discussioncomment cmt INNER JOIN askahgong.user_info user ON cmt.userid=user.id where topicid='".$topicid."'";
			$wsresult=getResultInJsonDecodeArrayWithoutModify($query);
			return $wsresult;
		}
		
		function update_topic_category($topicid,$categoryid){
			$query="update askahgong.discussiontopic set categoryid='".$categoryid."' where id='".$topicid."'";
			ExecuteNonQuery($query);
		}
		
		function add_category($category){
			ExecuteNonQuery("insert into askahgong.discussioncategory (category,sequence) select '".$category."',max(sequence)+1 from askahgong.discussioncategory;");

		}
		
		function delete_category($categoryid){
			ExecuteNonQuery("delete from askahgong.discussioncategory where id='".$categoryid."'");
		}
		
		function update_category($category,$categorydescription,$categoryid,$newsequence,$oldsequence){
			if($newsequence>$oldsequence){
				ExecuteNonQuery("update askahgong.discussioncategory set sequence=sequence-1 where sequence<='".$newsequence."'");
			}
			else if($newsequence<$oldsequence){
				ExecuteNonQuery("update askahgong.discussioncategory set sequence=sequence+1 where sequence<='".$oldsequence."'");
			}
			ExecuteNonQuerySafe("update askahgong.discussioncategory set category=?,text=?,sequence=? where id=?;", Array($category,$categorydescription,$newsequence,$categoryid));
			
		}
		
	
		
		function show_hide_comment($commentid,$hide){
			$query="update askahgong.discussioncomment cmt set hidden='".$hide."' where id='".$commentid."'";
			ExecuteNonQuery($query);
		}
		
		function toggle_topic_solved($topicid){
			$query="update askahgong.discussiontopic SET solved = 1 - solved where id='".$topicid."'";
			ExecuteNonQuery($query);
		}
		
		
		function mark_as_helpful($commentid,$type){
			$sql="update askahgong.discussioncomment set helpful='".$type."' where id='".$commentid."'";
			push_task("","nonquery",$sql,array());		
		}
	 	
	 	function mark_as_goodtopic($topicid){
			$sql="update askahgong.discussiontopic set good='1' where id='".$topicid."'";
			push_task("","nonquery",$sql,array());		
		}
	 	
    }  