<style type="text/css">


.topiclist-container table th{
	padding:5px 0px;
	border-bottom:1px solid black;
}

.topiclist-container table td{
	padding:5px 3px;
	border:1px solid black;
	font-size:0.8em;
	background-color:white;
}

.topiclist-container table tr{
	cursor:pointer;
}

.topiclist-container table tr:not(.header-row):hover > td{
	background-color:#FAEFEF;
	
}
	
</style>
<title>Discussion Managing | AhgongAdmin</title>
<script src="javascript/admin/sorttable.js" type="text/javascript"></script>	

<div class="container">
	<div class="row">
		<div class="col-xs-3">
			
			<h4>
				Discussion Managing
			</h4>
			
			<div>
				<button class="btn btn-xs btn-primary" onclick="new_category()">Add New Category</button>
			</div>
			
			<br>
			<div class="form-group reset-margin">
				<label>Category</label>
				<select class="form-control" onchange="switch_to_discussioncategory(this)">
					<?php foreach($categories as $category):?>
						<option value="<?=$category->id?>" <?php if($category->id==$currentcategoryid) echo "selected";?>>
							<?=$category->category?>
						</option>
						
					<?php endforeach?>
				</select>
			</div>
			
			
			<br>
			
			<form action="admin/discussion_manage/update_category/<?=$currentcategoryid?>" method="post">
				
				<div class="form-group">
					<label>Category Text</label>
					<input class="form-control" type="text" name="category" value="<?=$currentcategory->category?>">
				</div>
				
				
				<div class="form-group">
					<label>Sequence</label>
					<select class="form-control" name="newsequence">
						<?php for($x=1;$x<=count($categories);$x++):?>
						<option value="<?=$x?>" <?php if($currentcategory->sequence==$x) echo "selected"?>><?=$x?></option>
						<?php endfor?>
					</select>
				</div>
				
				<input type="text" style="display:none;" name="oldsequence" value="<?=$currentcategory->sequence?>">
				
				
				<div class="form-group">
					<label>Category Description</label>
					<textarea type="text" name="categorydescription" class="form-control" row="2"><?=$currentcategory->text?>
					</textarea>
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Submit"></input>
					<button type="button" class="btn btn-danger" onclick="delete_category()">Delete</button>
				</div>
				
			</form>
	
			
		</div>
		
		
		
		<div class="col-xs-9">
			<div class="topiclist-container">
				<table class="sortable">
					<thead>
						<tr class="header-row">
						    <th class="">Title</th>
						    <th class="text-center">Created By</th>
						    <th class="text-center">Created Date</th>
						    <th class="text-center">Closed</th>
						    <th></th>
						    <th></th>
						</tr>
					</thead>
	 				<tbody>
	 					<?foreach($topics as $topic):?>
	  					<tr>
	  						<td><a href="discussion/topic/<?=$topic->id?>" target="_blank"><?=$topic->topictitle?></a></td>
	  						<td class="text-center"><?=generate_username_control($topic->userid,$topic->username,true,$topic->isonline)?></td>
	  						<td class="text-center"><?=convert_date_to_asia_format($topic->dateandtime)?></td>
	  						<td class="text-center solved"><?=$topic->solved?></td>
	  						<td><a onclick="move_topic(this,<?=$topic->id?>)" href="javascript:void(0)">Move</a></td>
	  						<td><a onclick="toggle_topic_solved(this,<?=$topic->id?>)" href="javascript:void(0)">Closed(1)/Open(0)</a></td>
	  					</tr>
	  					<?php endforeach?>
	  
	     			</tbody>
	     		 </table>
			</div>
			
			
			
			
		</div>
		
	</div>
</div>






<script type="text/javascript">
	
	function switch_to_discussioncategory(select){
		var $select=$(select);
		direct_to_url('admin/discussion_manage/category/'+$select.val());
	}
	
	
	function toggle_topic_solved(control,topicid){
		var $row=$(control).parents("tr");
		var $solved=$row.find(".solved");
		if(isTrue($solved.html())) {
			$solved.html("0");
		}
		else {
			$solved.html("1");
		}
		$.post("admin/discussion_manage/toggle_topic_solved",{topicid:topicid},function(){
			
		})
		
	}
	
	function new_category(){
		var newcategory=prompt("What is the category?");
		if($.trim(newcategory)!=""){
			$.post("admin/discussion_manage/new_category",{newcategory:newcategory},function(){
				direct_to_url("admin/discussion_manage/category/<?=$currentcategoryid?>")
			})
		}
	}
	
	function delete_category(){
		var result=confirm("Are you sure you want to delete this category along with its topic?")
		if(result){
			$.post("admin/discussion_manage/delete_category/<?=$currentcategoryid?>",function(){
				direct_to_url("admin/discussion_manage")
			})	
			
		}
	}
	
	function move_topic(control,topicid){
		var tocategory=prompt("To which category?")
		if($.trim(tocategory)!=""){
				$.post("admin/discussion_manage/move_topic/"+topicid,{tocategory:tocategory},function(result){
				if(result=="0"){
					alert("Category '"+tocategory+"' doesn't exist.")
				}
				else{
					$(control).parents("tr").remove();
				}
			})
		}
		
	}

		
	
	
	
	

</script>



