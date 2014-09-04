<?php   
		
    class Result_item_model extends CI_Model { // Our Cart_model class extends the Model class  
         
        function __construct(){
      		parent::__construct();
    	}    
      
	  	function sorting($processid,$type){
	  	
			SortItems($processid, $type);
		
	  	}
	  	
	  
        function get_all_search_result_processid_and_total($userid,$content_string){
        
			$var = NewSearchWithContentString($userid, $content_string);
			return explode("(%2)",$var);

        }    
		
		function get_search_processid_and_total_by_itemid($userid,$itemid){
        
			$var = NewSearchWithItemID($userid, $itemid);
			return explode("(%2)",$var);

        }    
		
		function get_itemsdata_with_totalcount_by_search($content_string,$userid,$sorttype,$start,$limit){
			push_task("itemsdata_with_totalcount","search",$content_string,array($userid,$sorttype,$start,$limit));
		}
		
		
		function get_itemsdata_by_process_id($processid,$start,$limit,$userid){
			$sql="call askahgong.getItems(".$processid.",".$start.",".$limit.",".$userid.",NULL,0,0)";
			push_task("itemsdata","json",$sql,array());
		}
		
		function get_itemsdata_by_action($action,$start,$limit,$sorttype,$userid){
			if($action==0) $getting_action=1;
			else $getting_action=0;
			if($sorttype=="date%20desc" || $sorttype==""){
				$sorttype="id desc";
			}
			else{
				$sorttype=str_replace("%20"," ",$sorttype);
			}
			
			$sql2="SELECT 
					GROUP_CONCAT(id) 
				  FROM 
				  	(SELECT 
				  		DISTINCT info.id 
				  	FROM 
				  		askahgong.item_info info 
				  	INNER JOIN 
				  		askahgong.transaction_record trans
				  		ON info.id=trans.itemid
				  	WHERE
				  		info.type=0 and trans.removed=0 and info.pending=0
				  	ORDER BY 
				  		".$sorttype." 
				  	LIMIT 
				  		".$limit." 
				  	OFFSET 
				  		".$start.")t";
			$sql="call askahgong.getItems(0,0,".$limit.",".$userid.",NULL,0,(".$sql2."))";
			push_task("itemsdata","json",$sql,array());
		}
		
		function get_userid_by_itemid($item_id){
			$sql ="SELECT
					 userid
				   from
				   	 askahgong.transaction_record
				   where itemid=?";
			push_task("userid","scalar",$sql,array($item_id));	   
		}
		
		function check_item_is_pending($item_id){
			$sql="select pending from item_info where id='".$item_id."'";
			push_task("is_pending","scalar",$sql,array());
		}
		
		function get_totalcount_by_action($action){
			if($action==0) $getting_action=1;
			else $getting_action=0;
			$sql="SELECT
					    count(DISTINCT info.id)
				  FROM
				 	    askahgong.item_info info
				  INNER JOIN 
				        askahgong.transaction_record trans
				     	ON info.id=trans.itemid
				  WHERE
				  	    info.type=".$getting_action." and trans.removed=0 and info.pending=0";
				  	    
			push_task("totalcount","scalar",$sql,array());
		}
		
		function get_item_full_data($itemid,$userid=0){
			$sql="call askahgong.getItems(0,0,100,'".$userid."',NULL,1,'".$itemid."')";	
			push_task("item","json_single",$sql,array());
		}
		
		function get_itemsdata_of_userposting_by_userid($userid,$start,$limit,$sorttype,$ownuserid,$append_restrict="",$show_pending=1,$show_related=0){
			
			$sortting="";
			if($sorttype!=""){
				$sortting="order by ".$sorttype;
			}
			else{
				$sortting="order by info.pending desc,trans.posttime desc";
			}			
			
			if($sorttype=="posttime desc"){
				$sortting="order by info.pending desc,trans.posttime desc";
			}
			
			$user_restrict;
			if($show_related==0){
				$user_restrict = "trans.userid='".$userid."'";
			}
			else{
				$user_restrict = "(trans.userid='".$userid."' or trans.original_owner='".$userid."')";
			}
						
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$ownuserid.",NULL,".$show_pending.",
				  (select group_concat(info.id ".$sortting.") from askahgong.item_info info inner join
				  askahgong.transaction_record trans ON info.id=trans.itemid where ".$user_restrict." and removed=0 ".$append_restrict."))";
	
			push_task("itemsdata","json",$sql,array());
		}
		
		function get_itemsdata_of_userposting_by_userid_and_type($userid,$start,$limit,$sorttype,$type,$ownuserid,$append_restrict="",$show_pending=1,$show_related=0){
			
			$sortting="";
			if($sorttype!=""){
				$sortting="order by ".$sorttype;
			}
			else{
				$sortting="order by posttime desc";
			}			
			
			if($show_related==0){
				$user_restrict = "trans.userid='".$userid."'";
			}
			else{
				$user_restrict = "(trans.userid='".$userid."' or trans.original_owner='".$userid."')";
			}
			
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$ownuserid.",NULL,".$show_pending.",
				  (select group_concat(info.id ".$sortting.") from askahgong.item_info info inner join
				  askahgong.transaction_record trans ON info.id=trans.itemid where ".$user_restrict." and removed=0 
				  AND
				  info.type=".$type." ".$append_restrict.")
				  )";	
			push_task("itemsdata","json",$sql,array());
		}
		
		
		
		function get_itemsdata_of_friends_by_userid($userid,$start,$limit){
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$userid.",'friends',0,0)";	
			push_task("itemsdata","json",$sql,array());
		}
		
		function get_friends_post_totalcount($userid){
			$sql="SELECT 
					count(trans.id) 
				 FROM 
				 	askahgong.transaction_record trans 
				 INNER JOIN
				 	askahgong.item_info info 
				 	ON trans.itemid=info.id
				 INNER JOIN 
				 	askahgong.contact con 
				 	ON trans.userid=con.targetuserid 
				 WHERE con.fromuserid='".$userid."' and info.pending=0";
			push_task("totalcount","scalar",$sql,array());
		}
		
		function get_totalcount_of_posting(){
		
			$sql="SELECT 
					count(trans.id) 
				  FROM 
				  	askahgong.transaction_record trans 
				  WHERE trans.removed=0";
			push_task("totalcount","scalar",$sql,array());
	
		}
		
		function get_totalcount_buy_or_sell_post($userid,$type,$append_restrict="",$show_related=0){
				
			if($show_related==0){
				$user_restrict = "trans.userid='".$userid."'";
			}
			else{
				$user_restrict = "(trans.userid='".$userid."' or trans.original_owner='".$userid."')";
			}
				
			$sql="SELECT 
						count(trans.id) 
				  FROM 
				  		askahgong.transaction_record trans 
				  INNER JOIN 
				  		askahgong.item_info info 
				  		ON trans.itemid=info.id 
				  WHERE 
				  		trans.removed=0 and ".$user_restrict." and info.type='".$type."' ".$append_restrict."";
			push_task("totalcount","scalar",$sql,array());
		}
		
		
		function get_totalcount_of_posting_by_userid($userid,$append_restrict="",$show_related=0){
			if($show_related==0){
				$user_restrict = "trans.userid='".$userid."'";
			}
			else{
				$user_restrict = "(trans.userid='".$userid."' or trans.original_owner='".$userid."')";
			}
			
			$sql="SELECT 
					count(info.id) 
				  FROM 
				  	askahgong.item_info info,askahgong.transaction_record trans 
				  WHERE trans.removed=0 and info.id=trans.itemid and ".$user_restrict." ".$append_restrict."";
			push_task("totalcount","scalar",$sql,array());
	
		}
		
		function get_itemsdata_of_popular_post_by_userid($userid,$start,$limit){
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$userid.",'popular',0,0)";	
			push_task("itemsdata","json",$sql,array());
		}
		
		function get_itemsdata_by_idstrings($userid,$itemid,$force_taskname="itemsdata"){
			$sql="call askahgong.getItems(0,0,999,".$userid.",NULL,1,'".$itemid."')";
			push_task($force_taskname,"json",$sql,array());
		}
	
	
		function convert_input_to_result_model(){
			$result_model=new result_item_model();
			$result_model->type=$this->input->post("action");
			$result_model->name=$this->input->post("itemname");
			$result_model->price=$this->input->post("pricemin");
			$result_model->builtup=$this->input->post("size");
			$result_model->tenure=$this->input->post("tenure");
			$result_model->renovation=$this->input->post("renovated");
			$result_model->storey=$this->input->post("storey");
			$result_model->corner=$this->input->post("corner");
			$result_model->description=$this->input->post("description");
			$result_model->areanamearr=explode(",",$this->input->post("as_values_area"));
			$result_model->areaidlevelstring=$this->input->post("as_values_area_extra");
			$result_model->featurearr=explode(",",$this->input->post("as_values_feature"));
			$result_model->filearr=array();
			$result_model->id=0;
			return $result_model;
		}
     
	    function insert_edit_post($userid,$content_string, $edit_id, $handleFileUrl){
	    	try {
				$result = NewInsertEditWithContentString($userid, '', $content_string, $edit_id, $handleFileUrl);
				return $result;
				
			} catch (Exception $e) {
				//return $e;
				return "Operation failed,pls try again.";
			}
	    	
	    }
	 
	 	function delete_post($itemid,$userid){
	 		$sql="UPDATE 
	 				askahgong.transaction_record 
	 			  SET 
	 			  	removed=1 
	 			  WHERE 
	 			  	itemid='".$itemid."' and userid='".$userid."'";
	 		push_task("","nonquery",$sql,array());
	 	}
	 
	
   
   		function submit_view_counter($itemid,$userid){
   			
   			$sql="UPDATE 
   					askahgong.transaction_record 
   				  SET 
   				  	viewscounter=viewscounter+1 
   				  WHERE 
   				  	itemid=? and userid<>?";
   			push_task("","nonquery",$sql,array($itemid,$userid));
   		
		}
   	
   		function get_random_facts($itemid,$areaid,$arealevel,$categoryid){
   			return GetRandomFactsInJSONForm($itemid,$areaid,$arealevel,$categoryid);
   		}
  
  		function get_shortlist_items($userid){
  			$sql="call askahgong.getItems(0,0,9999,".$userid.",'shortlist',0,0)";	
  			return getResultInJsonDecodeArray($sql);
  		}
  		
  		
  		
  		function get_related_items($type,$start,$limit,$itemid){
  			$query="call askahgong.getItems(0,".$start.",".$limit.",0,'',0,(select askahgong.getRelatedItems('".$type."',".$itemid.")))";
			return getResultInJsonDecodeArray($query);
  		}
    
		function get_related_items_meta($itemid){
			$sql="SELECT 
						askahgong.getRelatedItems('',".$itemid.")";
			push_task("related_items_meta","scalar",$sql,array());
		}

		function get_item_lastseen($itemid,$userid){
			$sql="SELECT 
						IFNULL(lastseen,'2010-01-01 10:00:00') 
					FROM 
						askahgong.transaction_record 
					WHERE
						 itemid='".$itemid."' and userid='".$userid."';";
			push_task("item_lastseen","scalar",$sql,array());
		}
		
		function update_item_lastseen($itemid,$userid){
			$sql="UPDATE 
						askahgong.transaction_record 
					SET 
						lastseen=NOW()
				     WHERE itemid='".$itemid."' and userid='".$userid."';";
			push_task("","nonquery",$sql,array());
		}
		
		function get_item_agent_request_count($fromuserid,$itemid){
			$sql = "SELECT 
						count(id)
					FROM
						askahgong.agent_request
					where 
						fromuserid=".$fromuserid."
						AND itemid=".$itemid."";
			push_task("request_count","scalar",$sql,array());
		}
		
		function get_item_agent_propose_count($userid,$itemid){
			$sql = "SELECT 
						count(id)
					FROM
						askahgong.agent_request
					where 
						targetuserid=".$userid."
						AND itemid=".$itemid."";
			push_task("propose_count","scalar",$sql,array());
		}
		
		function get_agent_request_id($userid1,$userid2,$itemid){
			$sql = "SELECT 
						id as agent_request_id
					FROM
						askahgong.agent_request
					where 
						((targetuserid=".$userid1."
						and fromuserid=".$userid2.") OR
						targetuserid=".$userid2."
						and fromuserid=".$userid1."
						)
						AND itemid=".$itemid."";
			push_task("agent_request_id","scalar",$sql,array());
		}
		
		
		function get_agent_request_count($fromuserid,$itemid){
			$sql = "SELECT 
						count(id)
					FROM
						askahgong.agent_request
					where 
						fromuserid=".$fromuserid."
						AND itemid=".$itemid."";
			push_task("count","scalar",$sql,array());
		}
		
		function get_agent_propose_count($itemid){
			$sql = "SELECT 
						count(req.id)
					FROM
						askahgong.agent_request req
					LEFT JOIN
						askahgong.transaction_record trans
					ON 
						req.itemid=trans.itemid
					where 
						req.targetuserid=trans.userid
						AND req.itemid=".$itemid."";
			push_task("count","scalar",$sql,array());
		}
		
		function add_new_agent_request_return_request_id($fromuserid,$targetuserid,$itemid){
			$sql = "INSERT INTO
						askahgong.agent_request
					(fromuserid,targetuserid,itemid,dateandtime)
						values
					(".$fromuserid.",".$targetuserid.",".$itemid.",NOW());
					SELECT LAST_INSERT_ID() AS request_id;";
			push_task("request_id","scalar",$sql,array());
		}
		
		
		function update_item_ownership($userid,$agent_id,$item_id){
			$sql = "UPDATE
						askahgong.transaction_record
					SET
						userid=?,original_owner=?,posttime=NOW() 
					WHERE
						itemid=".$item_id."";
			push_task("","nonquery",$sql,array($agent_id,$userid));
			
			$sql = "UPDATE
						askahgong.item_info
					SET
						pending=0
					WHERE
						id=".$item_id."";
			push_task("","nonquery",$sql,array());
			
		}
		
		function get_itemsdata_of_agent_requests_type($type,$userid,$start,$limit,$name="itemsdata",$single_item_id=0){
			if($type=="pending"){
				$append="=0";
			}
			else if ($type=="waitingYourResponse"){
				$append=">0";
			}
			else{
				$append="<=100";
			}
			
			$id_restrict = "";
			if($single_item_id!=0){
				$id_restrict = "and info.id=".$single_item_id;
				
			}
						
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$userid.",NULL,1,
				  (select group_concat(info.id order by info.id desc) from askahgong.item_info info inner join
				  askahgong.transaction_record trans ON info.id=trans.itemid where info.pending=1
				   and (select count(req.id) from askahgong.agent_request req where req.fromuserid=trans.userid and req.targetuserid=".$userid." and req.itemid=info.id) ".$append."
				   and trans.removed=0 ".$id_restrict."))";	
			push_task($name,"json",$sql,array());
		}
		
		
		
		function get_count_of_agent_requests_type($type,$userid,$name="count"){
			if($type=="pending"){
				$append="=0";
			}
			else if ($type=="waitingYourResponse"){
				$append=">0";
			}
			else{
				$append="<=100";
			}
			
			
						
			$sql="select count(info.id) from askahgong.item_info info inner join
				  askahgong.transaction_record trans ON info.id=trans.itemid where info.pending=1
				   and (select count(req.id) from askahgong.agent_request req where req.fromuserid=trans.userid and req.targetuserid=".$userid." and req.itemid=info.id) ".$append."
				   and trans.removed=0";	
			push_task($name,"scalar",$sql,array());
		}
		
		function delete_all_agent_request_by_item_id($itemid){
			$sql = "delete from askahgong.agent_request where itemid=?";
			push_task("","nonquery",$sql,array($itemid));
		}
		
		
		
}  