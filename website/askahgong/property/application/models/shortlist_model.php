<?php   
	
		
    class Shortlist_model extends CI_Model { // Our Cart_model class extends the Model class  
         
        function __construct(){
      		parent::__construct();
    	}    
      
		function get_shortlist_data_by_userid($userid,$start,$limit,$sorttype){
			
			$sortting="";
			if($sorttype!=""){
				$sortting="order by ".$sorttype;
			}
			else{
				$sortting="order by posttime desc";
			}			
			
		
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$userid.",NULL,0,
				  (select group_concat(info.id ".$sortting.") from askahgong.item_info info inner join
				  askahgong.shortlist short ON info.id=short.itemid inner join 
				  askahgong.transaction_record trans ON info.id=trans.itemid
				  where short.userid='".$userid."'))";	
			return getResultInJsonDecodeArray($sql);
		}
		
	
		
		function get_totalcount_of_shortlist($userid,$force_taskname="totalcount"){
			$sql="SELECT 
					count(short.id) 
				  FROM 
				  	askahgong.shortlist short 
				  INNER JOIN
				  	askahgong.item_info info
				  	ON short.itemid=info.id
				  WHERE userid='".$userid."'";
			push_task($force_taskname,"scalar",$sql,array());
		}
		
		function get_totalcount_buy_or_sell_shortlist($userid,$type){
			$sql="SELECT 
					count(short.id) 
				  FROM 
				  	askahgong.shortlist short 
				  INNER JOIN 
				  	askahgong.item_info info 
				  	ON short.itemid=info.id
				  WHERE 
				  	short.userid='".$userid."' and info.type='".$type."'";
			push_task("totalcount","scalar",$sql,array());
		}
		
		function get_itemsdata_of_shortlist_by_userid($userid,$start,$limit,$sorttype){
			
			$sortting="";
			if($sorttype!=""){
				$sortting="order by ".$sorttype;
			}
			else{
				$sortting="order by posttime desc";
			}			
			
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$userid.",NULL,0,
				  	(
				  		SELECT 
				  			group_concat(short.itemid ".$sortting.") 
				  		FROM 
				  			askahgong.shortlist short 
				  		INNER JOIN
				  			askahgong.item_info info
				  			ON info.id=short.itemid
				  		INNER JOIN
				  			askahgong.transaction_record trans
				  			ON trans.itemid=short.itemid
				  		WHERE
				  			short.userid='".$userid."'
				   	)
				  )";	
			push_task("itemsdata","json",$sql,array());
		}
		
		function get_itemsdata_of_shortlist_by_userid_and_type($userid,$start,$limit,$sorttype,$type){
			
			$sortting="";
			if($sorttype!=""){
				$sortting="order by ".$sorttype;
			}
			else{
				$sortting="order by posttime desc";
			}			
			
			$sql="call askahgong.getItems(0,".$start.",".$limit.",".$userid.",NULL,0,
				  	(
				  		SELECT 
				  			group_concat(short.itemid ".$sortting.") 
				  		FROM 
				  			askahgong.shortlist short 
				  		INNER JOIN
				  			askahgong.item_info info
				  			ON info.id=short.itemid
				  		INNER JOIN
				  			askahgong.transaction_record trans
				  			ON trans.itemid=short.itemid
				  		WHERE
				  			short.userid='".$userid."' and info.type='".$type."'
				   	)
				  )";	
			push_task("itemsdata","json",$sql,array());
		}

  		function get_shortlist_modified_meta($userid){
  			$sql="SELECT
					short.itemid,
					short.dateandtime as resultdatetime,
					avt.action,
					IFNULL(avt.dateandtime,short.dateandtime) as modified_datetime,
					if(info.lastseen_shortlist<avt.dateandtime and short.dateandtime<avt.dateandtime,(select 1),(select 0)) as new
				FROM 
					askahgong.shortlist short
				LEFT JOIN
					askahgong.activity avt
					ON avt.targetid=short.itemid AND (avt.action='deleteItem' OR avt.action='editItem' OR avt.action='newItem')
				INNER JOIN
					askahgong.user_info info
					ON info.id=short.userid
				WHERE
					short.userid=".$userid."
				    AND
					(avt.dateandtime=(select max(dateandtime) from askahgong.activity avt2 where avt2.targetid=short.itemid and (avt2.action='deleteItem' OR avt2.action='editItem' OR avt2.action='newItem')))
				ORDER BY modified_datetime DESC";
				
				
			push_task("shortlist_modified_meta","json_no_mod",$sql,array());
  		}
  		
  		function get_shortlist_modified_totalcount($userid){
			$sql="SELECT
					count(short.id)
				FROM 
					askahgong.shortlist short
				LEFT JOIN
					askahgong.activity avt
					ON avt.targetid=short.itemid AND (avt.action='deleteItem' OR avt.action='editItem')
				INNER JOIN
					askahgong.user_info info
					ON info.id=short.userid
				WHERE
					short.userid=".$userid."
				    AND
					avt.dateandtime>info.lastseen_shortlist";
			push_task("shortlist_modified_totalcount","scalar",$sql,array());			
  		}
  		
		
		function get_itemsdata_of_shortlist($userid,$itemid,$force_taskname="itemsdata"){
			$sql="call askahgong.getItems(0,0,999,".$userid.",'',0,'".$itemid."')";
			push_task($force_taskname,"json",$sql,array());
		}
  		
  		function delete_shortlist($userid,$itemid){
  			$sql="delete from askahgong.shortlist where userid='".$userid."' and itemid='".$itemid."'";
   			push_task("","nonquery",$sql,array());
  		}
  		
  		function add_shortlist($userid,$itemid){
			$sql = "INSERT INTO askahgong.shortlist (userid,itemid,dateandtime)
					SELECT * FROM (SELECT '".$userid."','".$itemid."',NOW()) AS tmp
					WHERE NOT EXISTS (
					    SELECT * FROM askahgong.shortlist WHERE userid='".$userid."' and itemid='".$itemid."'
					) LIMIT 1;";
		    push_task("","nonquery",$sql,array());
		
  		}
  		
 
		
		
}  