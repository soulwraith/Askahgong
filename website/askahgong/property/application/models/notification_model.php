<?php   
        
    class Notification_model extends CI_Model { // Our Cart_model class extends the Model class  
        
     	
		//get all older notification by type
		function get_notifications($userid,$type,$start,$limit,$discard_part=''){
			$sql="call getAllNotifications(".$userid.",'".$type."',0,0,".$start.",".$limit.",'".$discard_part."',0)";
			
			push_task("notifications","json_no_mod",$sql,array());
		}
		
				
		function get_new_notifications_by_userid($userid,$discard_part=''){
			$sql="call getAllNotifications(".$userid.",'',0,1,0,999,'".$discard_part."',0)";
			
			push_task("new_notifications","json_no_mod",$sql,array());
		}
		
		//can discard not needed part , part 1 = replyYourTopic, part2 = replyTopic , part3= newItem 
		//to discard part1 and part2, input discard_part=1,2
		function get_new_notifications_by_userid_with_discardable($userid,$discard_part){
			$sql="call getAllNotifications(".$userid.",'',0,1,0,999,'".$discard_part."',0)";
			
			push_task("new_notifications","json_no_mod",$sql,array());
		}
		
		function get_itemsdata_of_notifications($userid,$itemid,$force_taskname="itemsdata"){
			$sql="call askahgong.getItems(0,0,999,".$userid.",NULL,1,'".$itemid."')";
			push_task($force_taskname,"json",$sql,array());
		}
		
		function get_item_modified_meta_of_notifications($userid,$itemid,$force_taskname="item_modified_meta"){
			$sql="SELECT
					trans.itemid,
					avt.action,
					avt.dateandtime as modified_datetime,
					if(info.lastseen_new_item<avt.dateandtime,(select 1),(select 0)) as new
				FROM 
					askahgong.transaction_record trans
				LEFT JOIN
					askahgong.activity avt
					ON avt.targetid=trans.itemid AND (avt.action='deleteItem' OR avt.action='editItem' OR avt.action='newItem')
				LEFT JOIN
					askahgong.user_info info
					ON info.id='".$userid."'
				WHERE
					FIND_IN_SET(trans.itemid,'".$itemid."')
				    AND
					(avt.dateandtime=(select max(dateandtime) from askahgong.activity avt2 where avt2.targetid=trans.itemid and (avt2.action='deleteItem' OR avt2.action='editItem' OR avt2.action='newItem')))
				";
			
			push_task($force_taskname,"json_no_mod",$sql,array());
				
		}
		
		
		//get older notification total count
		function get_notifications_totalcount($userid,$type,$discard_part=''){
			$sql="call getAllNotifications(".$userid.",'".$type."',1,0,0,0,'".$discard_part."',0)";
			push_task("totalcount","scalar",$sql,array());
		}
		
		//return in form replyyourTopic,replytopic,newitem
		function get_new_notifications_count($userid){
			$sql="call getAllNotifications(".$userid.",'',1,1,0,0,'',1)";
			push_task("new_notifications_count","json_single",$sql,array());
		}
		
		
	
		function get_notification_settings($userid){
			 $sql = "SELECT 
			 			*,askahgong.getAreaNameByIDAndLevel(notf.areaid,notf.arealevel) as result 
			 		 FROM 
			 		 	askahgong.notification notf 
			 		 WHERE 
			 		 	notf.userid='".$userid."'";
			push_task("notification_settings","json",$sql,array());		
		}

		function get_setting_by_notification_id($notf_id){
			 $sql = "SELECT 
			 			*,askahgong.getAreaNameByIDAndLevel(notf.areaid,notf.arealevel) as result 
			 		 FROM 
			 		 	askahgong.notification notf 
			 		 WHERE 
			 		 	notf.id='".$notf_id."'";
			push_task("setting","json_single",$sql,array());
		}
		
		function delete_notification_setting($id,$userid){
			 $sql = "delete from askahgong.notification where id='".$id."' and userid='".$userid."'";
			 ExecuteNonQuery($sql);
		}
		
		function update_lastseen_discussion_reply($userid){
			$sql="UPDATE
					askahgong.user_info info
				  SET
				  	info.lastseen_discussion_reply=NOW()
				  WHERE
				  	id=?";
			push_task("","nonquery",$sql,array($userid));
		}
		
		function update_lastseen_discussion_new_item($userid){
			$sql="UPDATE
					askahgong.user_info info
				  SET
				  	info.lastseen_new_item=NOW()
				  WHERE
				  	id=?";
			push_task("","nonquery",$sql,array($userid));
		}
		
		function insert_notification_read($userid,$action,$targetid){
			$sql="INSERT INTO
					askahgong.notification_read
				 	 (userid,action,targetid)
				  	VALUES
				  	 (?,?,?)";
			push_task("","nonquery",$sql,array($userid,$action,$targetid));
		}
		
		function add_notifications_settings_return_id($userid,$time,$method,$item,$type,$categoryid,$pricemin,$pricemax,$areaid,$arealevel){
			 $sql = "INSERT INTO 
			 			askahgong.notification (userid,time,method,item,type,categoryid,pricemin,pricemax,areaid,arealevel) 
			 		 VALUES 
			 		 	('".$userid."','".$time."','".$method."','".$item."','".$type."','".$categoryid."','".$pricemin."','".$pricemax."','".$areaid."','".$arealevel."');SELECT LAST_INSERT_ID() as id;";
			 push_task("id","scalar",$sql,array());
		}
		
		function update_notifications_settings($notification_id,$time,$method,$item,$type,$categoryid,$pricemin,$pricemax,$areaid,$arealevel){
			 $sql = "update askahgong.notification set time='".$time."',method='".$method."',item='".$item."',type='".$type."',categoryid='".$categoryid."',pricemin=".$pricemin.",pricemax=".$pricemax.",areaid='".$areaid."',arealevel='".$arealevel."' where id='".$notification_id."'";
			 ExecuteNonQuery($sql);
		}
		
	
		
		
    }  