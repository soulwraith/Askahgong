<?php   
        
    class Area_model extends CI_Model { // Our Cart_model class extends the Model class  
             

		
  		function get_count_area_not_support_by_keyword($keyword){
  			$keyword_no_space=str_replace(" ","",$keyword);
			
			$sql="SELECT 
					count(id)
				  FROM
				  	askahgong.wordtype
				  WHERE
				  	(word=? OR REPLACE(word,' ','')=?) AND wordtype='NOT SUPPORT'";
					
			push_task("count","scalar",$sql,array($keyword,$keyword_no_space));	 
  		}
		
		function get_area_level($areaquery){
			$sql="SELECT getarealevel(?)";
			push_task("area_level","scalar",$sql,array($areaquery));	 
		}
		
		function get_areas_by_query($areaquery,$maxarealevel){
			$sql="call askahgong.getAreaByQuery(?,".$maxarealevel.")";
			push_task("areas","json",$sql,array($areaquery));	 
		}
		
		function get_locations_by_keyword($keyword){
			$keyword='%'.$keyword.'%';
			$sql="SELECT * 
				  FROM 
				  	askahgong.area
				  WHERE
				  	residence LIKE ? OR 
				  	street LIKE ? OR 
				  	area LIKE ? OR 
				  	town LIKE ? OR 
				  	state LIKE ? OR 
				  	country LIKE ? OR 
				  	district LIKE ?";
			push_task("locations","json_no_mod",$sql,array($keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword));	 
		}
		
		function get_area_by_id_and_level($areaid,$arealevel){
			$query="call askahgong.getAreaByIDAndLevel('".$areaid."','".$arealevel."')";
			 $wsResult = getResultInJsonDecodeArray($query);
		
			return $wsResult;
		
		   
		}
		
		function get_coordinates_by_areaid($areaid){
			$query="select latitude,longitude from askahgong.area where id='".$areaid."'";
			$wsResult = getResultInJsonDecodeArray($query);
			return $wsResult;
		}
		
		function get_landmark($lat1,$lnt1,$lat2,$lnt2,$landmark_type){
			$query="select id,name,category,latitude,longitude from askahgong.landmark where find_in_set(category,'".$landmark_type."') and (latitude>=".$lat1." and latitude<=".$lat2.") and (longitude>=".$lnt1." and longitude<=".$lnt2.") order by category asc";
		
			$wsResult = getResultInJsonDecodeArray($query);
			return $wsResult;
		}
		
		function get_landmark_within($lat1,$lnt1,$range){
			$query="select id,name,category,latitude,longitude,getdirectdistance(latitude,longitude,".$lat1.",".$lnt1.") as distance from askahgong.landmark where getdirectdistance(latitude,longitude,".$lat1.",".$lnt1.")<".$range."";
		
			$wsResult = getResultInJsonDecodeArray($query);
			return $wsResult;
		}
		
		function get_nearest_landmark($lat1,$lnt1,$landmark_type){
			$query="SELECT
					     land.id,land.name,land.category,land.latitude,land.longitude,SQ.dist as distance   
					FROM
					     askahgong.landmark land
					INNER JOIN
					     (
					          SELECT
					               category,
					               MIN(getdirectdistance(latitude,longitude,".$lat1.",".$lnt1.")) AS dist
					          FROM
					               askahgong.landmark
					          WHERE
					          	    find_in_set(category,'".$landmark_type."')  
					          GROUP BY
					               category
					     ) AS SQ ON
					     SQ.category = land.category and SQ.dist=getdirectdistance(latitude,longitude,".$lat1.",".$lnt1.")";
					     
 
			$wsResult = getResultInJsonDecodeArray($query);
			return $wsResult;
		}
		
		
		function insert_area($residence,$street,$area,$town,$district,$state,$country,$latitude,$longitude){
       		$query="insert into askahgong.area (residence,street,area,town,district,state,country,latitude,longitude) values(?,?,?,?,?,?,?,?,?);SELECT LAST_INSERT_ID();";									
        	$result= ExecuteScalarSafe($query,Array($residence,$street,$area,$town,$district,$state,$country,$latitude,$longitude));
			return $result;
	    }    
		 function update_area($residence,$street,$area,$town,$district,$state,$country,$latitude,$longitude,$areaid){
       		$query="update askahgong.area set residence=?,street=?,area=?,town=?,district=?,state=?,country=?,latitude=?,longitude=? where id=?";									
        	$result= ExecuteScalarSafe($query,Array($residence,$street,$area,$town,$district,$state,$country,$latitude,$longitude,$areaid));
			return 1;
	    }   
	    
		function update_area_text($column,$value,$areaid){
       		$sql="update askahgong.area set ".$column."=? where id=?";									
 			push_task("","nonquery",$sql,array($value,$areaid));	 
	    }     

		function get_areas($lat1,$lnt1,$lat2,$lnt2){
			$sql="select * from askahgong.area where (latitude>=".$lat1." and latitude<=".$lat2.") and (longitude>=".$lnt1." and longitude<=".$lnt2.")";
			push_task("areas","json",$sql,array());	 
		}
		

		function check_contain_area($street,$area,$residence){
			
			$build="";
			$arr=array();
			if($residence!=""){
				$build.=" residence=? and ";
				array_push($arr,$residence);
			}
			if($area!=""){
				$build.=" area=? and ";
				array_push($arr,$area);
			}
			if($street!=""){
				$build.=" street=? ";
				array_push($arr,$street);
			}
			$build = rtrim($build, "and ");
			
			$query="select count(id) from askahgong.area where (".$build.")";
			$result= ExecuteScalarSafe($query,$arr);
			if($result>0) return true;
			else return false;
		}
		
		function delete_area_by_id($id){
			$query="delete from askahgong.area where id='".$id."'";
			ExecuteNonQuery($query);
		}
		
		
    }  