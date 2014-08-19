<style type="text/css">

.userlist-container table{
	width:100%;
}

.userlist-container table th{
	cursor:pointer;
}

.userlist-container table td{
	padding:10px 5px;
	border:1px solid #AFAFAF;
	background-color:white;
}
	
.userlist-container table td.editable{
	cursor:pointer;
}	
	
.userlist-container table td.editable:hover{
	background-color:#E9C692;
}
		
	

	
</style>
<title>Users Managing | AhgongAdmin</title>
<script src="javascript/admin/sorttable.js" type="text/javascript"></script>	

<div class="container">
	<div class="row">
				
		<div class="col-xs-12">
			
			<h4>
				Users Managing
			</h4>
			
			<div class="userlist-container">
				<table class="sortable">
					<thead>
						<tr class="header-row">
						    <th class="">ID</th>
						    <th class="">Username</th>
						    <th class="">Phone</th>
						    <th class="text-center">Role Level</th>
						    <th class="text-center">Level</th>
						</tr>
					</thead>
	 				<tbody>
	 					<?foreach($users as $user):?>
	  					<tr>
	  						<td class=""><?=$user->id?></td>
	  						<td class=""><?=generate_username_control($user->id,$user->username,true,$user->isonline)?></td>
	  						<td class="editable" onclick="change_phone_number(this,<?=$user->id?>)"><?=$user->phone?></td>
	  						<td class="text-center editable" onclick="change_role_level(this,<?=$user->id?>)"><?=$user->max_role_level?></td>
	  						<td class="text-center transformers" style="color:red"><?=$user->level?></td>
	  					</tr>
	  					<?php endforeach?>
	  
	     			</tbody>
	     		 </table>
			</div>
			
			
			
			
		</div>
		
	</div>
</div>






<script type="text/javascript">
	
	function change_phone_number(td,userid){
		var oldphone=$(td).html();
		var newphone=prompt("Input the new phone number",oldphone);
		if($.trim(newphone)!=""){
				$.post("admin/user_manage/change_phone_number/",{userid:userid,newphone:newphone},function(result){
					if(result==1){
						$(td).html(newphone);
					}
					else{
						alert("Phone number is already exist");
					}
					
				})
		}
	}
	
	function change_role_level(td,userid){
		var tolevel=prompt("To what level? (0:Ahgong,.......4:Common Users)");
		if($.trim(tolevel)!="" && isNumeric(tolevel)){
				$.post("admin/user_manage/change_role_level/",{userid:userid,tolevel:tolevel},function(result){
					$(td).html(tolevel);
				})
		}
	}
		
	
	
	
	

</script>



