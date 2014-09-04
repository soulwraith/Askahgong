


<div class="AGENT_DETAILS">
	<div class="row">
		<div class="col-lg-3">
			<img class="img-responsive" src="<?=get_user_profile_pic($user->id)?>">
			
			<div>
				<div class="padding-equal grey-bg margin-top">
					<button onclick="open_circle(true,<?=$user->id?>,'<?=$user->username?>','open',event)" class="btn btn-lg btn-white btn-block" type="button">Message</button>
				</div>	
				
				<?php if($user->agent_request>0):?>
					
					<div class="padding-equal grey-bg margin-top">
						<button onclick="accept_agent_propose(<?=$user->id?>)" class="btn btn-lg btn-block btn-light-orange" type="button">Accept</button>
					</div>
					<div class="">
						<span class="red">This agent proposed to be your agent.</span>
					</div>
				<?php elseif($user->my_request>0):?>
					<div class="margin-top">
						<span class="green">Request sent. You will be notified once the agent has accepted your request.</span>
					</div>
					
				<?php else:?>		
					<div class="padding-equal grey-bg margin-top">
						<button onclick="agent_request(<?=$user->id?>)" class="btn btn-lg btn-block btn-light-orange" type="button">Be My Agent</button>
					</div>
				
				<?php endif?>
				
			</div>
			
			
			
			
		</div>
		<div class="col-lg-9">
			<h3>
				<?=generate_username_control($user->id,$user->username,false)?>
			</h3>
			
			<div class="row details-row">
				<div class="col-lg-3">
					Review(s)
				</div>
				<div class="col-lg-9">
					<?=$this->load->view("user_controls/comment_total_number")?>
				</div>
			</div>
			
			
			<div class="row details-row">
				<div class="col-lg-3">
					Reputation
				</div>
				<div class="col-lg-9">
					<span class="">Level</span> <span class="level"><?=$user->level?></span>
					<br>
					<div class="row">
						<div class="col-lg-5">
							<?=$this->load->view("wrapper/user_experience_bar")?>
						</div>
					</div>
					
				</div>
			</div>
			
					
			<div class="row details-row">
				<div class="col-lg-3">
					Role
				</div>
				<div class="col-lg-9">
					<?=$user->role?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3">
					Status
				</div>
				<div class="col-lg-9">
					<div class="vertical-bottom icons inline-block user-status user-state <?php if($user->isonline) echo "online"; else echo "offline";?>" userid="<?=$user->id?>" style="margin-right:0px">
					</div>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3">
					Agency
				</div>
				<div class="col-lg-9">
					<?=empty($user->agency) ? "-" : $user->agency ?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3">
					Member Since
				</div>
				<div class="col-lg-9">
					<?=date('d/m/Y  g:i A',strtotime($user->registerdate));?>
				</div>
			</div>
			
			<div class="row details-row">
				<div class="col-lg-3">
					Total Posting(s)
				</div>
				<div class="col-lg-9">
					<a target="_blank" href="posting/view/<?=$user->id?>" data-toggle="tooltip" data-placement="top" title="Click to see all <?=$user->username?>&apos;s posting"><strong><?=concat_if_plural(" Posting","s",$user->postcount)?></strong></a>
				</div>
			</div>
			
			
			
			<div class="row details-row">
				<div class="col-lg-3">
					Phone
				</div>
				<div class="col-lg-9">
					<?php if($user->canseephone):?>
              	 	 	<span><?=$user->phone?> <?=empty($user->alternatephone) ? "" : " / ".$user->alternatephone ?></span>
              	 	 <?php else:?>
              	 	 	<span><em>Hidden</em></span>	
          	 	 	<?php endif?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3">
					Email
				</div>
				<div class="col-lg-9">
					<?=empty($user->email) ? "-" : $user->email ?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3">
					Contact Method
				</div>
				<div class="col-lg-9">
					<?=($user->contactmethod)?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3">
					Working Hour
				</div>
				<div class="col-lg-9">
					<?=($user->workingfrom) ."-". ($user->workingto)?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3">
					Description
				</div>
				<div class="col-lg-9">
					<?=empty($user->description) ? "-" : $user->description?>
				</div>
			</div>
			
			
			
		</div>
	</div>
</div>
