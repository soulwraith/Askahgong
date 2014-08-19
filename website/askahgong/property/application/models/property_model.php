<?php   
        
    class Property_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
        function get_propertylist(){
        	
			$sql='SELECT 
					word 
				  FROM 
				  	askahgong.category 
				  WHERE
				    FIND_IN_SET(id,askahgong.getallcategory(4)) 
				  ORDER BY 
				  	word';
			
			push_task("propertylist","array",$sql,array());
			
	    }    
		
		function get_propertylist_with_id(){
			$sql="SELECT 
					id,word
				  FROM 
				  	askahgong.category 
				  WHERE 
				  	find_in_set(id,askahgong.getallcategory(4)) 
				  ORDER BY 
				  	word";
			push_task("propertylist_with_id","json",$sql,array());
		}
		
		
		function get_all_features($facilitySupportState = 1){
			$arr = Array("tenure","storey","others","unittype");
			foreach($arr as $item){
				$sql = "select * from askahgong.category where supportstate=0 and find_in_set(id, askahgong.getallcategory((select id from askahgong.category where word LIKE '".$item."-subroot%'))) order by word asc;";
				push_task("FEATURES_".$item,"json",$sql,array());
			}
			
			$sql = "select * from askahgong.category where supportstate=".$facilitySupportState." and find_in_set(id, askahgong.getallcategory((select id from askahgong.category where word LIKE 'facility-subroot%'))) order by word asc;";
			push_task("FEATURES_facility","json",$sql,array());
			
		}
	
		function get_facility(){
			 $sql = "call askahgong.getAllFacility()";  
			 push_task("facility","array",$sql,array());
		}
		
		function get_facility_child($facility){
			$sql="call askahgong.getCategoryChildWordByParentWord('".$facility."')";
			$wsResult = getResultOfSingleFieldInArray($sql);
			 return $wsResult;
		}
     
    }  