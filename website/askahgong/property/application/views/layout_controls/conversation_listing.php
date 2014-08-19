
	<?php foreach($conversations as $conversation):?>
	<div class="conversation-parent-container">
		
		
		<div class="conversation-container clearfix" userid="<?=$conversation->targetuserid?>">
			<div class="col-xs-3">
				<div class="user-image-container">
					<img class="user-image" onerror="this.src='image/usernoimage.png'" src="<?=get_user_profile_pic($conversation->targetuserid)?>">
				</div>
			</div>
			<div class="col-xs-1" style="padding-left:0px;">
				<div class="icons user-status user-state <?php if($conversation->isonline) echo "online"; else echo "offline";?>" userid="<?=$conversation->targetuserid?>">
					
				</div>
				<div class="replied-indicator icons <?php if($conversation->lastmessageowner!=$this->session->userdata("userid")) echo "hidden-object"?>">
					
				</div>
			</div>
			<div class="col-xs-6" style="padding-left:5px;">
				<div class="username overflow-ellipsis">
					<?=$conversation->username?>
				</div>
				<div class="message overflow-ellipsis">
					<?=$conversation->message?>
				</div>
			</div>
			<div class="col-xs-1 pull-right">
				<div class="row">
					<div class="message-new-count icons notification-count white <?php if($conversation->newmessage<=0) echo "hidden-object"?>">
						<?=$conversation->newmessage?>
					</div>
				</div>
				
				
			</div>
			
		</div>
		<div class="fade-separator">
		
		</div>
	
	</div>
	<?php endforeach?>

