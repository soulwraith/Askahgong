<div onclick="eventStopPropagation(event)">
	<div class="row">
		<div class="col-xs-12">
			<div class="header">
				<div class="col-xs-7 overflow-ellipsis" style="padding-left:0px;">
					<span class="username">
						<div class="vertical-bottom icons inline-block user-status big user-state <?php if($user->isonline) echo "online"; else echo "offline";?>" userid="<?=$user->id?>" style="margin-right:0px">
						</div>
						<?=$user->username?>
						 
					</span>
				</div>
				<div class="col-xs-5" style="padding:0px;">
						<div class="contact-control <?php if($user->isfriend) echo "delete-contact"; else echo "add-contact"?> icons right" onclick="handle_contact(this,<?=$user->id?>,false,event,true,false);"></div>
						<div class="message-contact icons right" data-toggle="tooltip" title="Message This User" data-placement="auto" onclick="open_circle(true,<?=$user->id?>,'<?=$user->username?>','open',event)">
							
						</div>
						<a href="user/id/<?=$user->id?>" target="_blank">
						<div class="see-profile icons left-shadow right" data-toggle="tooltip" title="View Profile" data-placement="auto">
						</div>
						</a>
				</div>
				
				<div class="clear"></div>
			</div>
		</div>
		<div style="padding:0px 20px;">
			<div class="fade-separator">
				<img class="fade-shadow" src="image/discussion_shadow_top.png">
			</div>
		</div>
		
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			
		
			<div class="col-xs-12 content">
				<div class="col-xs-4" style="padding:0px;">
				
					
					<div class="text-center">
						<img class="img-responsive inline-block" src="<?=get_user_profile_pic($user->id)?>" style='max-height:86px;'>
					</div>
					<div class="role">
						<?=$user->role?>
					</div>
				</div>
				<div class="col-xs-8" style="padding-right:0px;padding-left:9px;">
					<div class="description" <?php if(strlen($user->description)>80) echo "title='".$user->description."'"?>>
						<?php if($user->description==""):?>
							This user is too lazy to write anything.
						<?php else:?>
							" <?=cutofftext($user->description,55,"...")?> "
						<?php endif?>
						<div class="icons description-tip"></div>
					</div>
					
					<div class="details overflow-ellipsis">
						<?php if(strtolower($user->role)=="agent"):?>
						<strong>Agency : </strong><?=is_empty_default($user->agency)?>
						<?php else:?>
						<strong>Con. Method : </strong><?=($user->contactmethod)?>
						<?php endif?>
					</div>
					
					
					<div class="details">
						<strong>Total Post : </strong>
						<a href="posting/view/<?=$user->id?>" data-toggle="tooltip" data-placement="top" title="Click to see all <?=$user->username?>&apos;s posting"><strong><?=concat_if_plural(" Posting","s",$user->postcount)?></strong></a>
					</div>
					
					
					
					
					<div class="details">
						<div class="col-xs-7 no-paddingleft no-paddingright">
							<strong>Reputation : </strong>
							<span class="transformers level-text">
								<span class="text">Level</span> <span class="level"><?=$user->level?></span>
							</span>
						</div>
						
						
						<div class="comment-parent col-xs-5 no-paddingleft no-paddingright">
							<?php if(is_verified_agent($user)):?>
							<?=$this->load->view("user_controls/comment_total_number",Array("userID"=>$user->id,"commend"=>$user->good_comment_count,"report"=>$user->bad_comment_count))?>
              	 			<?php endif?>
						</div>
						<div class="clear"></div>
					</div>
					
					
					
					
					<div class="details">
						
						<?=$this->load->view("wrapper/user_experience_bar")?>
					</div>
					
					
				
					
					
				</div>
				<div class="clear"></div>
			
				
				
			</div>
			<div class="clear"></div>
			
			
			
		</div>
		
	</div>
	
</div>
