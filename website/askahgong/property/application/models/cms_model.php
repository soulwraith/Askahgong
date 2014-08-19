<?php   
        
    class Cms_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
    	function get_anchors(){
    		$sql=  "SELECT 
    					* 
    				FROM 
    					askahgong.cms_anchor";
			push_task("anchors","json_no_mod",$sql,array());
    	}
		
		

		function create_anchor($title){
			$query="insert into askahgong.cms_anchor (title) values (?);SELECT LAST_INSERT_ID();";
			$id=ExecuteScalarSafe($query,Array($title));
			return $id;
		}
		
		function delete_anchor($id){
			$query="delete from askahgong.cms_anchor where id='".$id."'";
			ExecuteNonQuery($query);
		}
		
		function edit_anchor($title,$id){
			$query="update askahgong.cms_anchor set title=? where id='".$id."'";
			ExecuteNonQuerySafe($query,Array($title));
		}
		
		function get_anchor_content_by_id($id){
			$query="select html from askahgong.cms_content where anchorid='".$id."'";
			$wsresult=getResultOfSingleFieldInArray($query);
			return $wsresult;
		}
		
		function save_anchor_content($anchorid,$content){
			$query="select id from askahgong.cms_content where anchorid='".$anchorid."'";
			$anchorcontentid=getExecuteScalar($query);
			if($anchorcontentid==""){
				$sql="insert into askahgong.cms_content (anchorid,html) values ('".$anchorid."',?)";
			}
			else{
				$sql="update askahgong.cms_content set html=? where id='".$anchorcontentid."'";
			}
			ExecuteNonQuerySafe($sql,Array($content));
		}

		function get_anchor_content($title){
			$title=str_replace("%20"," ",$title);
			$sql   ="SELECT 
						con.html 
					FROM 
						askahgong.cms_content con 
					LEFT JOIN
						 askahgong.cms_anchor anc 
						 ON con.anchorid=anc.id
					WHERE
					 	 anc.title='".$title."'";
			push_task("anchor_content","scalar",$sql,array());
			
		}
		
	
		
		
    }  