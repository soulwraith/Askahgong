<!--notificaiton layout for all notifications popup (newitem/discussion_reply)!-->

<div class="notifications-listing">
	
		<?php foreach($notifications as $notification):?>
			
			<?php $modified_type="";
			
				if(isset($notification->modified_type)){
					if($notification->modified_type=="editItem"){
						$modified_type="edit";
					}
					else if($notification->modified_type=="deleteItem"){
						$modified_type="delete";
					}
					
				}
			
			?>
			
			<div class="notification-item <?php if($notification->new) echo "new"?> <?=$modified_type?>  <?php if(!$notification->hasread) echo "unread"?>">
				
				<?php switch($notification->action): 
				case "replyYourTopic": case "replyTopic": ?>
					
					<a oncontextmenu="mark_notification_as_read(this,<?=$notification->lastcommentid?>,'<?=$notification->action?>');" onclick="close_all_topmenu_popup();return mark_notification_as_read(this,<?=$notification->lastcommentid?>,'<?=$notification->action?>');" href="discussion/topic/<?=$notification->targetid?>/<?=$notification->start?>/<?=$notification->lastcommentid?>" target="_blank">
						<div class="img-container">
							<img class="img-responsive" src="<?=get_user_profile_pic($notification->userid)?>">
						</div>
						
						<div class="content-container">
							<span class="text1"><?=cutofftext($notification->username,30,"...")?></span>
							
							
							
							<?php if($notification->unreadcount>1):?>
					   			and <br><span class="text4"><?=concat_if_plural(" other user","s",$notification->unreadcount-1)?></span>
								have replied 
							<?php endif?>
							

							<?php if($notification->unreadcount<=1):?>
								has replied
								<br>
							    <span class="text4">"<?=cutofftext(strip_tags($notification->resulttext2,'<img>'),30,'...')?>"</span>
							    
							<?php endif?>
							<br>
							in 
							<?php if($notification->action=="replyYourTopic"):?>
							your 
							<?php endif?>
							topic <span class="text4">"<?=cutofftext($notification->resulttext,30,"...")?>"</span>
							<br>
							<span class="text2"> - <?=ago($notification->dateandtime,true,true)?></span>
						</div>	
					
						<div class="clear"></div>
					</a>	
					
					
				<?php break;?>
				<?php case "newItem": ?>
			
				  
					<a class="no-underline" oncontextmenu="mark_notification_as_read(this,<?=$notification->lastcommentid?>,'<?=$notification->action?>');" onclick="close_all_topmenu_popup();return mark_notification_as_read(this,<?=$notification->lastcommentid?>,'<?=$notification->action?>');" href="<?=$notification->item->url?>" target="_blank">
					
						<div class="img-container">
							<img class="img-responsive" src="<?=$notification->item->firstFile?>">
						</div>
						
						<div class="content-container">
							<span class="text1"><?=$notification->item->pricetoshow?></span>
							<br>
							<span class="text1"><?=$notification->item->actiontext?> <?=$notification->item->name?> @ <?=$notification->item->areanameshort?></span>
							<br>
							<span class="text3">
								<?php if(!empty($notification->item->original_ownerid)):?>
									Takenover
								<?php else:?>
									Posted
								<?php endif?>
								 By <?=generate_username_control($notification->item->userid,$notification->item->username,true,$notification->item->isonline,10,true)?></span>
							<br>
							<span class="text2"><?=ago($notification->dateandtime,true,true)?></span>
							<span class="text2">
								(
								<?php if($notification->resulttext=="custom"):?>
									Matched My Custom Criteria
								<?php elseif($notification->resulttext=="matched"):?>
									Matched My Postings
								<?php elseif($notification->resulttext=="allitem"):?>
									New Item Alert
								<?php endif?>	
								)
							</span>
							
						</div>	
					
						<div class="clear"></div>
						
					
					</a>
					
					
				<?php break;?>		
				
				
				<?php case "agentRequest": ?>
			
				  
					<a class="no-underline" oncontextmenu="mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" onclick="close_all_topmenu_popup();return mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" href="<?=$notification->item->url?><?php if(is_verified_agent($user)) echo "#request"?>" target="_blank">
					
						<div class="img-container">
							<img class="img-responsive" src="<?=$notification->item->firstFile?>">
						</div>
						
						
						
						<div class="content-container">
							<span class="text1"><?=generate_username_control($notification->userid,$notification->username,true,$notification->isonline,20,true)?></span>
							
						
							<?php if(!is_verified_agent($user)):?>						
								<?php if($notification->unreadcount>1):?>
						   			<span class="text1">and <?=concat_if_plural(" other agent","s",$notification->unreadcount-1)?></span>
									<br>
									have requested to be your agent
								
								<?php else:?>
									<br>
									has requested to be your agent
								
								<?php endif?>
								
								
							<?php else:?>
								<br>
								has requested you to be his/her agent
							<?php endif?>
							<br>
							<span class="text1"><?=$notification->item->actiontext?> <?=$notification->item->name?> @ <?=$notification->item->areanameshort?></span>
							<br>
							<span class="text2"><?=ago($notification->dateandtime,true,true)?></span>
							
							
						</div>	
					
						<div class="clear"></div>
					</a>
					
					
				<?php break;?>
				
				
				<?php case "acceptAgent": ?>
			
				  
					<a class="no-underline" oncontextmenu="mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" onclick="close_all_topmenu_popup();return mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" href="<?=$notification->item->url?>" target="_blank">
					
						<div class="img-container">
							<img class="img-responsive" src="<?=$notification->item->firstFile?>">
						</div>
						
						
						
						<div class="content-container">
							<span class="text1"><?=generate_username_control($notification->userid,$notification->username,true,$notification->isonline,20,true)?></span>
							<br>
							<?php if(!is_verified_agent($user)):?>	
								is now your representative for					
							<?php else:?>
								has accepted you to be his/her agent
							<?php endif?>
							<br>
							<span class="text1"><?=$notification->item->actiontext?> <?=$notification->item->name?> @ <?=$notification->item->areanameshort?></span>
							<br>
							<span class="text2"><?=ago($notification->dateandtime,true,true)?></span>
							
							
						</div>	
					
						<div class="clear"></div>
					</a>
					
					
				<?php break;?>
				<?php case "agentReview": ?>
			
				  
					<a class="no-underline" oncontextmenu="mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" onclick="close_all_topmenu_popup();return mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" href="agent_comment/view/<?=get_userid()?>/thread/<?=(floor(($notification->lastcommentpage+1) / 5)*5)?>#<?=$notification->lastcommentid?>" target="_blank">
						
						<div class="img-container">
							<img class="img-responsive" src="<?=get_user_profile_pic($notification->userid)?>">
						</div>
						
						
						
						<div class="content-container">
							<span class="text1"><?=generate_username_control($notification->userid,$notification->username,true,$notification->isonline,20,true)?></span>
								has 
								<?php if($notification->resulttext2>0):?>
									commended
								<?php else:?>
									reported
								<?php endif?> you
							<br>
							<span class="text4">"<?=cutofftext($notification->resulttext,30,'...')?>"</span>
							<br> 
							<span class="text1">in agent review section.</span>
							<br>
							<span class="text2"><?=ago($notification->dateandtime,true,true)?></span>
							
							
						</div>	
					
						<div class="clear"></div>
					</a>
				
				<?php break;?>
				<?php case "agentReviewReply": ?>
			
				  
					<a class="no-underline" oncontextmenu="mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" onclick="close_all_topmenu_popup();return mark_notification_as_read(this,<?=$notification->targetid?>,'<?=$notification->action?>');" href="agent_comment/view/<?=$notification->resulttext2?>/thread/<?=((($notification->lastcommentpage+1) % 5)*5)?>#<?=$notification->lastcommentid?>" target="_blank">
					
						<div class="img-container">
							<img class="img-responsive" src="<?=get_user_profile_pic($notification->userid)?>">
						</div>
						
						
						
						<div class="content-container">
							<span class="text1"><?=generate_username_control($notification->userid,$notification->username,true,$notification->isonline,20,true)?></span>
								has replied
							<br>
							<span class="text4">"<?=cutofftext($notification->resulttext,30,'...')?>"</span>
							<br> 
							<span class="text1">in agent review section.</span>
							<br>
							<span class="text2"><?=ago($notification->dateandtime,true,true)?></span>
							
							
						</div>	
					
						<div class="clear"></div>
					</a>
				
				
				<?php endswitch;?>
				
				<div class="new-indicator indicator icons"></div>
				
				<?php if(isset($notification->modified_datetime)):?>
				<div class="edit-indicator indicator icons" title="This posting has been edited <?=ago($notification->modified_datetime)?>"></div>
					
				<div class="delete-indicator indicator icons" title="This posting has been deleted <?=ago($notification->modified_datetime)?>"></div>
				<?php endif?>
			</div>
			
			<div class="fade-separator"></div>
			
		<?php endforeach?>
	
	
	<?php if(count($notifications)<=0 && $start==0):?>
			<?php 
				if($type=="discussion-reply"){
					$info['type']="notification_discussion";
				}
				else if($type=="new-item"){
					$info['type']="notification_item";
				}
				else if($type=="agent-request"){
					$info['type']="agent_request";
				}
				$info["no_offset"]=true;
				
			?>
			<?=$this->load->view("layout_controls/popup_no_result",$info)?>
	<?php endif?>	
	
</div>






