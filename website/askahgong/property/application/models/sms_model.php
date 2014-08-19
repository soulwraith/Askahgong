
<?php   
 
    class Sms_model extends CI_Model { // Our Cart_model class extends the Model class  
             
      
      	function insert_sms($msg,$phone){
			$sql="insert into askahgong.sms (msg,phone,dateandtime) values (?,?,NOW())";
			push_task("","nonquery",$sql,array($msg,$phone));
		}
      
		
	
		
	
		
}  


