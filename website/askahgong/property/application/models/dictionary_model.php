<?php   
 
    class Dictionary_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
      	function get_rude_words(){
      		 $sql = "select word from askahgong.wordtype where wordtype='RUDE'";
			 $results=getResultOfSingleFieldInArray($sql);
		     return $results;
      	}
      
		
		function get_facilities_include_subcategory(){
			 $sql = "SELECT 
			 			cat.word as main, cat2.word as sub 
			 		FROM 
			 			askahgong.category cat 
			 		LEFT JOIN 
			 			askahgong.category cat2 
			 		ON 
			 			find_in_set(cat.id,askahgong.gettopcategoryalongtheway(cat2.id)) 
			 		WHERE 
			 			cat.supportstate=1 and cat.word<>cat2.word
			 		ORDER BY
			 			cat.word,cat2.word;";
			 push_task("facilities","json_no_mod",$sql,array());	    	
		}
		
	  function get_units_conversion(){
      	$sql="select * from askahgong.unitconversion order by unit";
		push_task("units_conversion","json_no_mod",$sql,array());	    	
      }  
	  
	  function get_wordtype(){
      	$query="select * from askahgong.wordtype order by word";
		$wsresult=getResultInJsonDecodeArrayWithoutModify($query);
		return $wsresult;
      }            

	  function get_synonyms(){
      	$sql="select * from askahgong.synonyms order by convertfrom";
		push_task("synonyms","json_no_mod",$sql,array());	    	
      }  
      

	  function get_word_types($wordtype){
	  	$sql="select * from askahgong.wordtype where wordtype=? order by word desc";
		push_task("word_types","json_no_mod",$sql,array($wordtype));	    		
	  }
	
	  function insert_unit($unit,$convertmethod,$column){
  	
	  	$id=ExecuteScalarSafe("insert into askahgong.unitconversion (unit,convertmethod,`column`) values (?,?,?);select LAST_INSERT_ID();", Array($unit,$convertmethod,$column));
	  	return $id;
	  }
	
	  function delete_unit($id){
  	
	  	ExecuteNonQuery("delete from askahgong.unitconversion where id='".$id."'");
	  }
	
	
	  function insert_wordtype($word,$wordtype){
  	
	  	$id=ExecuteScalarSafe("insert into askahgong.wordtype (word,wordtype) values (?,?);select LAST_INSERT_ID();", Array($word,$wordtype));
	  	return $id;
	  }
	
	  function delete_wordtype($id){
  	
	  	ExecuteNonQuery("delete from askahgong.wordtype where id='".$id."'");
	  }

	  function insert_synonyms($convertfrom,$convertto){
  	
	  	$id=ExecuteScalarSafe("insert into askahgong.synonyms (convertfrom,convertto) values (?,?);select LAST_INSERT_ID();", Array($convertfrom,$convertto));
	  	return $id;
	  }
	
	  function delete_synonyms($id){
  	
	  	ExecuteNonQuery("delete from askahgong.synonyms where id='".$id."'");
	  }
		
}  