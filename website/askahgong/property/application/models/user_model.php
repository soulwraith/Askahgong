<?php   
         $userid="";
		 $username="";
    class User_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
      	function get_user_by_userid($ownuserid,$userid,$append_col="",$name="user"){
      		
			
			 if($append_col!="") $append_col = ",".$append_col;
			
      		 $sql = "SELECT 
      		 			IFNULL(con.id,0) as isfriend,checkCanSeePhoneNumber(".$ownuserid.",info.id) as canseephone,
      		 			info.id,info.points,info.phone_visibility,info.phone,info.roleid,info.agency,
      		 			info.completed_profile,
      		 			getUserRole(info.id,0) as role,getUserRole(info.id,1) as original_role,
      		 			getUserLevel(info.id) as level,
      		 			getRealNextLevelExpNeeded(getUserLevel(info.id)) as noedit_nextlevel_exp,
      		 			getAgentCommentTotalCount(info.id,'good') as good_comment_count,
      		 			getAgentCommentTotalCount(info.id,'bad') as bad_comment_count,
      		 			getUserCurrentRealExpPoints(info.id) as noedit_current_exp,
      		 			info.username,getUserStatus(info.id) as isonline,info.email,info.alternatephone,
      		 			info.contactmethod,info.workingfrom,info.workingto,info.description,info.registerdate,
      		 			info.lastseen,info.verified_agent,
      		 			getUserPostingCount(".$userid.") as postcount
      		 			".$append_col." 
      		 		FROM
      		 			 askahgong.user_info info
      		 		LEFT JOIN 
      		 			askahgong.contact con 
      		 			ON (con.targetuserid=info.id and con.fromuserid='".$ownuserid."') 
      		 		WHERE 
      		 			info.id='".$userid."'";
   
			 push_task($name,"json_single",$sql,array());
      	}
      	
      	function check_is_admin_by_userid($userid){
      		$sql=" SELECT
      				  IF(role.level<=2,1,0) as is_admin
      			   FROM
      			   	  askahgong.user_info info
      			   inner join
      			   	  askahgong.user_role role
      			   ON
      			   	  info.roleid=role.id
      			   WHERE
      			   	  info.id='".$userid."'";
      		push_task("is_admin","scalar",$sql,array());	  
      	}
		
	      	
      	function get_status_by_userid($userid){
      		 $sql = "SELECT 
      		 			getUserStatus(info.id) as isonline 
      		 		 FROM 
      		 		 	askahgong.user_info info 
      		 		 WHERE 
      		 		 	info.id='".$userid."'";
		     push_task("status","scalar",$sql,array());
      	}
	  
	  	function get_userphone_by_userid($userid){
	  		 $sql = "select phone from user_info where id=".$userid;
			return getExecuteScalar($sql);
	  	}
      
	   	function get_userid_by_userphone($userphone){
	  		 $sql = "select id from user_info where phone=".$userphone;
			return getExecuteScalar($sql);
	  	}
		
		function get_userid_by_reset_password_token($token){
	  		 $sql = "select id from user_info where reset_password_token=?";
	  		 push_task("user_id","scalar",$sql,array($token));
	  	}
	  	
	  	function get_has_update_profile_by_userid($userid){
	  		 $sql = "SELECT 
      		 			has_update_profile 
      		 		 FROM 
      		 		 	askahgong.user_info info 
      		 		 WHERE 
      		 		 	info.id='".$userid."'";
		     push_task("has_update_profile","scalar",$sql,array());
	  	}
	  	
	  
        function get_username_by_userid($userid,$force_taskname="username"){
        	  		
        	  if($userid==0 || $userid=="") {
        	  	 GLOBAL $data;
        	  	 $data[$force_taskname]="";
        	  	 return;
        	  }	
        	  
        	  $sql = "SELECT 
        	  			username
        	  		 FROM 
        	  		 	user_info 
        	  		 WHERE id=?";
        	  push_task($force_taskname,"scalar",$sql,array($userid));	  

        }    
		
		function get_role_level_by_userid($userid){
			$sql ="select 
					role.level
				   FROM
				   	askahgong.user_info info
				   inner join
				   	askahgong.user_role role
				   ON
				   	role.id=info.roleid
				   WHERE info.id='".$userid."'";
		   push_task("role_level","scalar",$sql,array());	  
		}
		
		
		function get_username_and_status_by_userid($userid){
			$sql = "select info.username,getUserStatus(info.id) as isonline from askahgong.user_info info where info.id='".$userid."'";
			 $wsResult = getResultInJsonDecodeArray($sql);
		     return $wsResult;
		}
		
		function get_all_users(){
			$sql="SELECT 
					info.id,info.username,info.phone,info.max_role_level,getUserLevel(info.id) as level,getUserStatus(info.id) as isonline
				  FROM 
				 	askahgong.user_info info";
			push_task("users","json",$sql,array());
		}
		
		function get_all_agents($keyword,$showonline,$start,$limit,$userid,$append_col="",$append_sort=""){
			$keyword_no_space=str_replace(" ","",$keyword);
			
			if($showonline==1){
				$onlinefilter="AND getUserStatus(info.id)=".$showonline."";
			}
			else{
				$onlinefilter="";
			}
			
			if($append_col!="") $append_col = ",".$append_col;
			
			if($append_sort==""){
				$sort = "info.points desc";
			}
			else{
				$sort = $append_sort;
			}
			
			$sql  ="SELECT 
						info.username,info.id,info.phone,info.agency,info.lastseen,getUserLevel(info.id) as level,
						getUserStatus(info.id) as isonline,
						getUserRole(info.id,0) as role,
						getAgentCommentTotalCount(info.id,'good') as good_comment_count,
      		 			getAgentCommentTotalCount(info.id,'bad') as bad_comment_count,
						(SELECT count(id) from askahgong.transaction_record where userid=info.id and removed=0) as totalpostings,
						checkCanSeePhoneNumber(".$userid.",info.id) as canseephone,
						info.verified_agent
						".$append_col."
					FROM 
						askahgong.user_info info 
					LEFT JOIN 
						askahgong.contact con ON info.id=con.targetuserid 
					INNER JOIN 
						askahgong.user_role role1 ON info.roleid=role1.id 
					WHERE role1.role='Agent' AND info.verified_agent>0 and info.agency<>''
					AND ((info.phone like ? or info.agency like ? or info.username like ? or REPLACE(info.username,' ','') like ?))
					".$onlinefilter."
					GROUP BY info.id
					ORDER BY ".$sort."
					LIMIT ".$start.", ".$limit."";
			
			push_task("agents","json",$sql,array("%".$keyword."%","%".$keyword."%","%".$keyword."%","%".$keyword_no_space."%"));	  

		}


		function get_all_agents_totalcount($keyword,$showonline){
			$keyword_no_space=str_replace(" ","",$keyword);
			
			if($showonline==1){
				$onlinefilter="AND getUserStatus(info.id)=".$showonline."";
			}
			else{
				$onlinefilter="";
			}
			
			$sql  ="SELECT 
						count(distinct info.id)
					FROM 
						askahgong.user_info info 
					LEFT JOIN 
						askahgong.contact con ON info.id=con.targetuserid 
					INNER JOIN 
						askahgong.user_role role ON info.roleid=role.id 
					WHERE role.role='Agent' AND info.verified_agent>0 and info.agency<>''
					AND ((info.phone like ? or info.agency like ? or info.username like ? or REPLACE(info.username,' ','') like ?))
					".$onlinefilter."";
					
	
			push_task("totalcount","scalar",$sql,array("%".$keyword."%","%".$keyword."%","%".$keyword."%","%".$keyword_no_space."%"));	  
			
		}
		
		function get_all_staffs($ownuserid){
			$sql="SELECT 
					IFNULL(con.id,0) as isfriend,info.*,getUserLevel(info.id) as level,getUserStatus(info.id) as isonline,role.role
				  FROM 
				 	askahgong.user_info info
				  LEFT JOIN
				  	askahgong.user_role role
				  ON info.roleid=role.id
				  LEFT JOIN 
      		 			askahgong.contact con 
	 			ON (con.targetuserid=info.id and con.fromuserid='".$ownuserid."') 
				  WHERE role.level<=3
				  ORDER BY role.level asc
				 ";
			push_task("staffs","json",$sql,array());
		}
		
		
		/*return 1 if success update,else return errormsg*/
		function submit_password($userid,$password,$originalpassword){
					
			try {
				$result = ChangePassword($userid, $password,$originalpassword);
				return $result;
				
				
			} catch (Exception $e) {
				return "Update Failed,please try again";
			}
						
		}
		
		/*return 1 if success register,else return errormsg*/
		function register($phone,$countrycode,$password){
		
			try {
				$result = NewUserRegistration($phone, $countrycode,$password);
				return $result;
				
			} catch (Exception $e) {
				return print_r($e);
			}
		}
		
		/*return userid if success validated,else return errormsg*/
		function user_validate($phone,$countrycode,$password){
			try {
				$result = UserLogin($phone, $countrycode,$password);
				return $result;
				
			} catch (Exception $e) {
				return $e;
				//return "Login failed,pls try again.";
			}
		}
		
		function update_user_settings($userid,$alternatephone,$roleid,$agency,$username,$email,$phonevisibility,$contactmethod,$workingfrom,$workingto,$description){

			$sql="UPDATE 
					askahgong.user_info 
				  SET 
				  	alternatephone=?,roleid='$roleid',agency=?,username=?,email=?,
				  	phone_visibility='$phonevisibility',contactmethod='$contactmethod',
				  	workingfrom='$workingfrom',workingto='$workingto',description=?,
				  	has_update_profile=1 
				  WHERE 
				    id='$userid'";
			
			push_task("","nonquery",$sql,array($alternatephone,$agency,$username,$email,$description));		
		
		}
	
     	function reset_password($phone,$countrycode,$email){
     		try {
				return ResetPassword($phone,$countrycode,$email);
					
			} catch (Exception $e) {
				return $e;
			
			}
     		
     	}
		
		function reset_password_matched_token($userID){
     		try {
				return ResetPasswordMatchedToken($userID);
					
			} catch (Exception $e) {
				return $e;
			
			}
     		
     	}
		
		
		
		
		
		function get_available_roles($userid){
			$sql="SELECT 
					role.* 
				  FROM 
				  	askahgong.user_info info 
				  INNER JOIN 
				  	askahgong.user_role role 
				  	ON info.max_role_level<=role.level 
				  WHERE 
				  	info.id='".$userid."'";
			push_task("available_roles","json",$sql,array());		
		}
		
		function check_exist_remembertoken($token){
			$query="select id from askahgong.user_info where remembertoken='".$token."'";
			if(getExecuteScalar($query)==""){
				return false;
			}
			else{
				return true;
			}
			
		}
		
		function update_remembertoken($token,$userid){
			$sql="update askahgong.user_info set remembertoken='".$token."' where id='".$userid."'";
			push_task("","nonquery",$sql,array());		
		}
		
		function get_userid_by_remembertoken($token){
			$query="select id from askahgong.user_info where remembertoken='".$token."'";
			return getExecuteScalar($query);
		}
		
		function get_recent_contacts($userid){
			$query="select info.id,info.username from askahgong.user_info info where info.id IN ((select touserid from askahgong.message where fromuserid='"+$userid+"') UNION (select fromuserid from askahgong.message where touserid='"+$userid+"')";
			return getResultInJsonDecodeArray($query);
		}
		
		function get_contacts($userid){
			$sql="SELECT
						 con.id,con.targetuserid,info.username,info.registerdate,info.lastseen,
						 askahgong.getUserStatus(info.id) as isonline,1 as isfriend 
					FROM
						 askahgong.user_info info,askahgong.contact con 
					WHERE 
						info.id=con.targetuserid 
					AND
						 con.fromuserid=?  
					ORDER BY
						 isonline DESC,username ASC";
			push_task("contacts","json_no_mod",$sql,array($userid));			 

		}
		
		function delete_contact($fromuserid,$targetuserid){
			$sql="delete from askahgong.contact where fromuserid='".$fromuserid."' and targetuserid='".$targetuserid."'";
			push_task("","nonquery",$sql,array());		
		}
		
		function add_contact($fromuserid,$targetuserid){
			$sql="insert into askahgong.contact (fromuserid,targetuserid) values ('".$fromuserid."','".$targetuserid."')";
			push_task("","nonquery",$sql,array());
			
			
		}
		
		function check_already_has_contact($fromuserid,$targetuserid){
			$query="select count(id) as result from askahgong.contact where fromuserid='".$fromuserid."' and targetuserid='".$targetuserid."'";
			$result=getExecuteScalar($query);
			return $result;
		}
		
		function find_contacts($keyword,$userid){
			
		    $keyword_no_space=str_replace(" ","",$keyword);
			$sql  ="SELECT 
						con.id,info.id as targetuserid,
						info.username,info.registerdate,getUserStatus(info.id) as isonline,info.lastseen,
						(SELECT 
							count(id) from askahgong.contact 
						WHERE fromuserid='".$userid."' and targetuserid=info.id) 
						as isfriend 
					FROM 
						askahgong.user_info info
					LEFT JOIN 
					 	askahgong.contact con 
					 	ON info.id=con.targetuserid 
					WHERE 
					 	(info.id<>'".$userid."' and 
					 	(info.username like ? or REPLACE(info.username,' ','') like ?))
				    GROUP BY 
				    	info.id
				    ORDER BY 
				    	isfriend desc,isonline desc,username asc";
			push_task("contacts","json_no_mod",$sql,array("%".$keyword."%","%".$keyword_no_space."%"));	

	
		}
		
		function update_description($description,$userid){
			$sql="UPDATE 
					askahgong.user_info
				 SET 
				 	description=? 
				 WHERE 
				 	id=".$userid;
			push_task("","nonquery",$sql,array($description));	
		}
    		
		function set_agent_unverified($userid){
			$sql="UPDATE 
					askahgong.user_info
				 SET 
				 	verified_agent=0 
				 WHERE 
				 	id=".$userid;
			push_task("","nonquery",$sql,array());	
		}		
			
		function submit_subscript_email($email){
			return SubscribeEmail($email);
		}
		
		function update_lastseen($userid){
			$sql="update askahgong.user_info set lastseen=NOW() where id='".$userid."'";
			push_task("","nonquery",$sql,array());		
		}
		
		function update_lastseen_shortlist($userid){
			$sql="update askahgong.user_info set lastseen_shortlist=NOW() where id='".$userid."'";
			push_task("","nonquery",$sql,array());
		}
		
		function update_lastseen_discussion_reply($userid){
			$sql="update askahgong.user_info set lastseen_discussion_reply=NOW() where id='".$userid."'";
			push_task("","nonquery",$sql,array());
		}
		
		function update_lastseen_agent_request($userid){
			$sql="update askahgong.user_info set lastseen_agent_request=NOW() where id='".$userid."'";
			push_task("","nonquery",$sql,array());
		}
		
		
		function update_lastseen_agent_review($userid){
			$sql="update askahgong.user_info set lastseen_agent_review=NOW() where id='".$userid."'";
			push_task("","nonquery",$sql,array());
		}
		
		
		function update_lastseen_new_item($userid){
			$sql="update askahgong.user_info set lastseen_new_item=NOW() where id='".$userid."'";
			push_task("","nonquery",$sql,array());	
		}
		
		function check_otp_matched($otp,$phone){
			$sql="select count(id) from askahgong.user_info where otp='".$otp."' and phone='".$phone."'";
			return getExecuteScalar($sql);
		}
		
		function clear_otp($phone){
			$sql="update askahgong.user_info set otp='' where phone='".$phone."'";
			ExecuteNonQuery($sql);
		}
		
		function update_role_level($userid,$tolevel){
			$sql="update askahgong.user_info set max_role_level='".$tolevel."' where id='".$userid."'";
			push_task("","nonquery",$sql,array());	
		}

		function update_phone($userid,$newphone){
			$sql="update askahgong.user_info set phone='".$newphone."' where id='".$userid."'";
			push_task("","nonquery",$sql,array());	
		}
		
		function check_phone_exist($phone){
			$sql="select count(id) from askahgong.user_info where phone='".$phone."'";
			return getExecuteScalar($sql);
		}
		
		function check_for_offline_users($userids){
			$sql="select 
					id,lastseen
				  from
				    askahgong.user_info 
				  where 
    				find_in_set(id,'".$userids."') and getUserStatus(id)=0";
			push_task("offline_users","json_no_mod",$sql,array());
		}
		
		function clear_reset_password_token($userid){
			$sql="update askahgong.user_info set reset_password_token='' where id='".$userid."'";
			push_task("","nonquery",$sql,array());	
		}
		
		
		
}  