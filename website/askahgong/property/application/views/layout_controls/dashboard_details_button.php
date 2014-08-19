<?php if($user->id!=get_userid()):?>
	<div class="message-contact icons control" data-toggle="tooltip" title="Message User" onclick="open_circle(true,<?=$user->id?>,'<?=$user->username?>','open',event)"> 
		
	</div>
		
	<div class="<?php if($user->isfriend) echo "delete-contact"; else echo "add-contact"?> icons control" onclick="handle_contact(this,<?=$user->id?>,true,event,true,true);"></div>
	
		
	
<?php else:?>
	<a href="profile" target="_blank">	
		<div class="edit-profile icons control" data-toggle="tooltip" title="Edit Your Personal Details"> 
		</div>
	</a>
	
	
	
<?php endif?>



<?php if(isset($in_page) && $in_page=="item"):?>

	<a class="icons control see-profile" data-toggle="tooltip" title="View Profile" href="activity/id/<?=$user->id?>" target="blank">
		
	</a>
<?php endif?>	

