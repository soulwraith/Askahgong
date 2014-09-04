

<?php $gotfriendlist_before=false?>
<?php $gototherslist_before=false?>
<div class="LAYOUT_CONTACT_LISTING">
	
	<?php 
	
		$no_result = false;
		if(count($contacts)<=0){
			$no_result = true;
		}
		
	?>
	
	<?php 
		$dummy=new stdClass();
		$dummy->isfriend=false;
		array_push($contacts,$dummy);
	?>

	<div class="contact-list">
		
		<?php if($no_result):?>
			<div class="padding">
				<small>No user found.</small>
			</div>
			
		<?php endif?>
		
		<?php foreach($contacts as $contact):?>
		
		<?php if(!$gotfriendlist_before):?>
			<div class="list-header slate-line your-contact <?php if(!$contact->isfriend) echo "hidden-object"?>">
				Contact(s)
				<img class="list-header-shadow top" src="image/discussion_shadow_top.png">
				<div class="fade-separator">
		
				</div>
			</div>
			
			<?php $gotfriendlist_before=true?>
		<?php endif?>
		
		<?php if(!$gototherslist_before && !$contact->isfriend):?>
			<div class="list-header slate-line not-your-contact <?php if(!isset($contact->targetuserid)) echo "hidden-object"?>">
				Non-Contact(s)
				<img class="list-header-shadow top" src="image/discussion_shadow_top.png">
				<div class="fade-separator">
		
				</div>
			</div>
			
			<?php $gototherslist_before=true?>
		<?php endif?>
		<?php if(!isset($contact->targetuserid)) break;?>
		<div class="contact-container-parent">
			<div class="contact-container clearfix" userid="<?=$contact->targetuserid?>" width="100%" style="display:table;width:100%;">
				<div class="cell-one" style="display:table-cell;padding:0px 10px 0px 15px;width:65px;vertical-align:middle;">
					<div class="user-image-container">
						<img class="user-image" onerror="this.src='image/usernoimage.png'" src="<?=get_user_profile_pic($contact->targetuserid)?>">
					</div>
				</div>
				<div class="cell-two" style="display:table-cell;padding-right:10px;width:25px;vertical-align:middle;">
					<div class="icons inline-block user-status user-state <?php if($contact->isonline) echo "online"; else echo "offline";?>" userid="<?=$contact->targetuserid?>">
						
					</div>
					
				</div>
				<div class="cell-three " style="display:table-cell;max-width:100px;vertical-align:middle;">
					<div class="username overflow-ellipsis" style="">
						<?=$contact->username?>
					</div>
					
					<div class="user-state <?php if($contact->isonline) echo "online"; else echo "offline";?>" userid="<?=$contact->targetuserid?>">
						<div class="timeago" userid="<?=$contact->targetuserid?>" title="<?=$contact->lastseen?>"></div>
					    <div class="onlinenow">Online Now</div>
					</div>
					
					
					
					
				</div>
			
				<div class="cell-four contact-controls" style="display:table-cell;width:70px;vertical-align:middle;padding-right:8px;">
	
				 	  <a onclick="eventStopPropagation(event);" target="_blank" href="user/id/<?=$contact->targetuserid?>">
						<div class="icons hide-overflow-tooltip see-profile right" data-toggle="tooltip" title="View Profile" data-content="Profile">
							
						</div>
					  </a>
					  <div class="icons hide-overflow-tooltip <?php if($contact->isfriend) echo "delete-contact"; else echo "add-contact" ?> right" onclick="handle_contact(this,<?=$contact->targetuserid?>,false,event,true,false);">
							
					  </div>
				
				  
					
				</div>
				
			</div>
			<div class="fade-separator">
			
			</div>		
		</div>	
		
	
		<?php endforeach?>
	
	</div>
</div>



