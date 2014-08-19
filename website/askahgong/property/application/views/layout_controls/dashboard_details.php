



								
							
							





<div class="LAYOUT_DASHBOARD_DETAILS">
	<div class="grey-box user-details-container-small <?php if(!isset($smallonly) || !$smallonly) echo "visible-xs"?>">
		<div class="row">
			<div class="col-xs-12">
				
			
				<div class="header">
					<div class="left">
						<div class="icons inline-block user-status user-state <?php if($user->isonline) echo "online"; else echo "offline";?>" userid="<?=$user->id?>">
						</div>
						<?=cutofftext($user->username,100,"..")?>
					</div>
					
					<div class="manage-user-controls right">
						<?=$this->load->view("layout_controls/dashboard_details_button")?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="fade-separator">
					<img class="fade-shadow" src="image/discussion_shadow_top.png">
				</div>
				
			</div>
			
			
			<div class="col-xs-3" style="padding:10px 0px 0px 25px;">
				<div class="image-container">
					<img class="img-responsive" src="<?=get_user_profile_pic($user->id)?>">
				</div>
				
			</div>
			<div class="col-xs-9" style="padding-top:10px;line-height:22px;">
				<div class="row" style="margin-right:0px;">
					<div class="col-xs-12 overflow-ellipsis">
						<div class="left">
							<strong>Role : </strong>
						</div>
						<div class="left">
							 &nbsp;<?=$user->role?>
						</div>
					</div>
					
					
					<div class="col-xs-12">
						<strong>User Message : </strong>
						&nbsp;<?=cutofftext($user->description,50,"...")?>
	
						<div class="clear"></div>
					</div>
					
					<div class="col-xs-12">
						<div class="left">
							<strong>Reputation : </strong>
						</div>
						<div class="left" style="margin-top:-7px;">
							<span class="transformers level-font">&nbsp;<span class="text inline-block">Level</span><span class="count"><?=$user->level?></span></span>
						</div>
						<div class="clear"></div>
					</div>
					
					<?php if(!isset($smallonly) || !$smallonly):?>
					<div class="col-xs-12 padding-equal">
						
						<a class="right" href="javascript:void(0)" onclick="show_all_details()"><small>More</small></a>
						
					</div>
					<?php endif?>
				</div>
				
			</div>
		
			
			
		</div>
		
	</div>
	
	<?php if(!isset($smallonly) || !$smallonly):?>
	
	<div class="grey-box user-details-container hidden-xs">
		<div>
			<div class="header">
				<div class="left">
					User Details
				</div>
				
				<div class="manage-user-controls right">
					<?=$this->load->view("layout_controls/dashboard_details_button")?>
		
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="fade-separator">
				<img class="fade-shadow" src="image/discussion_shadow_top.png">
			</div>
			
			
			<div class="image-container">
				<a href="<?php if($user->id==get_userid()) echo "profile"; else echo "activity/id/".$user->id?>" target="_blank">
					<img src="<?=get_user_profile_pic($user->id)?>"></img>
				</a>
				<div class="clear"></div>
			</div>
			
			<div class="fade-separator">
				
			</div>
			
			<div class="details grey-part border-radius">
				
				<div>
					<strong>Username</strong>
				</div>
				<div>
					<?=$user->username?>
				</div>
				<div class="margin-top">
					<strong>Role</strong>
				</div>
				<div>
					<?=$user->role?>
				</div>
				
				
				<?php if($user->role=="Agent"):?>
				<div class="margin-top">
					<strong>Agency</strong>
				</div>
				<div>
					<?=$user->agency?>
				</div>
				<?php endif?>
				
				<div class="margin-top">
					<strong>Status</strong>
				</div>
				<div>
					
					<div class="icons user-status user-state <?php if($user->isonline) echo "online"; else echo "offline";?> inline-block" userid="<?=$user->id?>"></div>
					<span class="lastseen">(last seen <?=ago($user->lastseen)?>)</span>
				</div>
				
				<?php if($user->id!=$this->session->userdata("userid")):?>
				<div class="margin-top">
					<strong>User Message</strong>
				</div>
				<div class="word-wrap user-message" <?php if(strlen($user->description)>80) echo "title='".$user->description."'"?>>
					<?=is_empty_default(cutofftext($user->description,80,"..."))?>
					
				</div>
				
				<?php endif?>
				
				
				
				<div class="margin-top">
					<strong>Reputation</strong>
					<a href="about/title/website#faq-reputation" target="_blank">
						<div class="icons question-hover" data-toggle="tooltip" title="Click to learn how this reputation mechanism works." data-placement="right">
				      	</div>
					</a>
				</div>
				<div style="margin-top:-5px;">
					<span class="transformers level-font"><span class="text inline-block">Level</span><span class="count"><?=$user->level?></span></span>
					<?=$this->load->view("user_controls/comment_total_number")?>
					
					<?=$this->load->view("wrapper/user_experience_bar")?>
				</div>
				<div class="clear"></div>
				<div class="current-points">
					<?=$user->current_exp?>/<?=$user->nextlevel_exp?> Points
				</div>
							
				<div class="clear"></div>
				
				
				
				
				
				
				<div class="hidden-details hidden-object">
					<div class="margin-top">
						<strong>Phone Number</strong>
					</div>
					<div>
						
						<?php if(!$user->canseephone):?>
							<em>Phone number is hidden</em>
						<?php else:?>
							<?=$user->phone?>
						<?php endif?>	
					</div>
					
					<div class="margin-top">
						<strong>Alternate Phone Number</strong>
					</div>
					<div>
						<?php if(!$user->canseephone):?>
							<em>Phone number is hidden</em>
						<?php else:?>
							<?=is_empty_default($user->alternatephone)?>
						<?php endif?>	
					</div>
					
					<div class="margin-top">
						<strong>Email</strong>
					</div>
					<div>
						<?=is_empty_default_email($user->email)?>
					</div>
					
					<div class="margin-top">
						<strong>Contact Method</strong>
					</div>
					<div>
						<?=$user->contactmethod?>
					</div>
					
					<div class="margin-top">
						<strong>Available Hour</strong>
					</div>
					<div>
						<?php if($user->workingfrom=="Any" || $user->workingto=="Any"):?>
							Any
						<?php else:?>
							<?=$user->workingfrom?> - <?=$user->workingto?>
						<?php endif?>		
						
					</div>
					
					<div class="margin-top">
						<strong>Member Since</strong>
					</div>
					<div>
						<?=date('d/m/Y  g:i A',strtotime($user->registerdate));?>
					</div>
				</div>
				
				<div class="icons show-hidden-details not-shown hidden-details-control hidden-xs">
				
				</div>
			
			<!--hidden part ,show on mouseover-->
			<div class="grey-box hidden-details-box hidden-details-control">
				<div>
					<strong>Phone Number</strong>
				</div>
				<div>
					<?php if(!$user->canseephone):?>
						<em>Phone number is hidden</em>
					<?php else:?>
						<?=$user->phone?>
					<?php endif?>	
				</div>
				
				<div class="margin-top">
					<strong>Alternate Phone Number</strong>
				</div>
				<div>
					<?php if(!$user->canseephone):?>
						<em>Phone number is hidden</em>
					<?php else:?>
						<?=is_empty_default($user->alternatephone)?>
					<?php endif?>	
				</div>
				
				<div class="margin-top">
					<strong>Email</strong>
				</div>
				<div>
					<?=is_empty_default_email($user->email)?>
				</div>
				
				<div class="margin-top">
					<strong>Contact Method</strong>
				</div>
				<div>
					<?=$user->contactmethod?>
				</div>
				
				<div class="margin-top">
					<strong>Available Hour</strong>
				</div>
				<div>
					<?php if($user->workingfrom=="Any" || $user->workingto=="Any"):?>
						Any
					<?php else:?>
						<?=$user->workingfrom?> - <?=$user->workingto?>
					<?php endif?>	
				</div>
				
				<div class="margin-top">
					<strong>Member Since</strong>
				</div>
				<div>
					<?=date('d/m/Y  g:i A',strtotime($user->registerdate));?>
				</div>
			</div>
				
				
				
				
			</div>
		
			<?php if($user->id==$this->session->userdata("userid")):?>
			<div class="description">
				<form action="" method="post" onsubmit="update_description(this);return false;">
					<textarea rows="3" class="description watermark" mark="Introduce more about yourself to this community." name="description" type="text"><?=$user->description?></textarea>
					<input type="submit" class="btn btn-light-grey" value="Submit">
		
				</form>
			</div>
			
			<?php endif?>
			
			
			<div class="show-all" onclick="$('.hidden-details-control').remove();$('.hidden-details').removeClass('hidden-object');$(this).remove();">
				Show More Details
			</div>
			
		</div>	
			
		
	</div>
</div>
<?php endif?>


<div class="visible-xs" style="margin-top:20px;"></div>	




