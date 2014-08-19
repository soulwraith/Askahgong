<?php   
        
    class Category_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      function get_all_top_parent_categorydata(){
      	$sql="select id,word from askahgong.category where id=parentcategoryid";
		push_task("categorydata","json_no_mod",$sql,array());	    	
      }       
             
      function get_all_child_id($categoryid){
	  	$query="select id from askahgong.category where find_in_set(id,askahgong.getallcategory('".$categoryid ."'))";
		$resultidlist=getResultOfSingleFieldInArray($query);
		return $resultidlist;
	  }
	  
	  function get_all_child_data_by_idlist($idlist){
	  	$idstring="";	
	  	foreach($idlist as $id){
	  		$idstring.=$id.",";
	  	}
		$idstring=trim($idstring,",");
		$query="select * from askahgong.category where id IN (".$idstring.")";
		$wsresult=getResultInJsonDecodeArrayWithoutModify($query);
		return $wsresult;
	  }
	  
	  function update_parent_category($categoryid,$parentcategoryid){
	  	$query="update askahgong.category set parentcategoryid='".$parentcategoryid."' where id='".$categoryid."'";
		ExecuteNonQuery($query);
	  }
	  
	  function delete_category($categoryidstring){
	  	$query="delete from askahgong.category where id IN (".$categoryidstring.")";
		ExecuteNonQuery($query);
	  }
	  
	  function new_category($category,$supportstate,$parentcategoryid){
	  	$query="insert into askahgong.category (word,supportstate,parentcategoryid) values (?,'".$supportstate."','".$parentcategoryid."');SELECT LAST_INSERT_ID();";
		return ExecuteScalarSafe($query,Array($category));

	  }
	  
	  function update_category($categoryid,$newword){
	  	$query="update askahgong.category set word=? where id='".$categoryid."'";
		ExecuteScalarSafe($query,Array($newword));
	  }
	  

		
    }  