<!--notificaiton layout for notification PAGE ONLY!-->

<div class="row">
	<div class="col-xs-12">
		<div class="notification-container">
			<div class="vertical-center-parent">
				
			
			<div class="notf-icon vertical-center-child" style="width:10%">
				<div>
					<div class="notification-icon icons <?=strtolower($notification->action)?>"></div>
				</div>
				
			</div>		
			
			<div class="notf-content vertical-center-child" style="width:75%">
				
		<?php switch($notification->action): 
		case "replyYourTopic": case "replyTopic": ?>
			
			
			    <strong><?=generate_username_control($notification->userid,$notification->username,true)?></strong>
				<?php if($notification->unreadcount>1):?>
		   			and <strong><?=$notification->unreadcount-1?></strong>
					other users have <strong>replied</strong> 
				<?php endif?>
				
				<?php if($notification->unreadcount<=1):?>
					has <strong>replied</strong>  
						<strong>"<?=cutofftext(strip_tags($notification->resulttext2,'<img>'),100,'...')?>"</strong>
					
				<?php endif?>
				
				in 
				<?php if($notification->action=="replyYourTopic"):?>
				your 
				<?php endif?>
				topic <strong><a href="discussion/topic/<?=$notification->targetid?>/<?=$notification->start?>/<?=$notification->lastcommentid?>"><?=$notification->resulttext?></a></strong>
				
			
		<?php break;?>
		<?php case "newItem": ?>
	
		  
		    <strong><?=generate_username_control($notification->item->userid,$notification->item->username,true)?></strong>
		    has <strong>posted a new item</strong> <strong><a href="item/id/<?=$notification->item->id?>"><?=$notification->item->actiontext?> <?=$notification->item->paddingnamewithareatoshow?></a></strong>
			that may interest you
			
		<?php break;?>		
		<?php endswitch;?>
				
			</div>
		  	<div class="vertical-center-child notf-datetime">
		  		<?=ago($notification->dateandtime,false)?> <br> ago
		  		
		  	</div>	  	
				
				
			</div>
		</div>
	</div>
	
</div>
