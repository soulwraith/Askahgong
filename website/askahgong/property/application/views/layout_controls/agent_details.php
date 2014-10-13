


<div class="AGENT_DETAILS">
	
	<div class="row">
		<div class="col-xs-12">
			<div class="title">
				
				<?=generate_username_control($user->id,$user->username,false,"unknown",999,false,true)?>
			
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-sm-4 col-md-3">
			<img class="img-responsive profile" src="<?=get_user_profile_pic($user->id)?>">
			
			<div>
				<div class="padding-equal grey-bg margin-top">
					<button onclick="open_circle(true,<?=$user->id?>,'<?=$user->username?>','open',event)" class="btn btn-lg btn-light-orange btn-block" type="button">Message</button>
				</div>	
			</div>
			
			
			
			
		</div>
		<div class="col-lg-9 col-sm-8 col-md-9">
			
			<div class="row">
				<div class="col-xs-12">
					
					<?php 
						$html = "";
						$type = "info";
						if($user->agent_request>0){
							$type = "danger";
							$html = 'This agent proposed to be your agent, you can either accept or ignore it.<br>
									<div class="padding-equal grey-bg inline-block margin-top">
										<button onclick="accept_agent_propose('.$user->id.')" class="btn btn-red" type="button">Accept</button>
									</div>';
						}
						elseif($user->my_request_rejected>0){
							$type = "info";
							$html = 'This agent has rejected your request.';
						}
						elseif($user->my_request>0){
							$type = "success";
							$html = '<span class="green">Request sent. You will be notified once the agent has accepted your request.</span>';
						}
						else{
							$html = 'After this agent accepted your request, he/she will take fully in charge of your property request. However, this property request will be automatically stored inside your <a href="shortlist/view" target="blank">shortlist</a> hence you will be alerted at the first moment this property agent make any changes of your property.<br>
									<div class="padding-equal grey-bg inline-block margin-top">
										<button onclick="agent_request('.$user->id.')" class="btn btn-green" type="button">Request</button>
									</div>';
						}
					?>
					
					
					
					
					<?=$this->load->view("layout_controls/alert",Array("alert_type"=>$type,
						"alert_html"=>$html))
					?>
				</div>
			</div>
			
			
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Review(s)
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<div class="comment-total">
						<?=$this->load->view("user_controls/comment_total_number",Array("userID"=>$user->id,"commend"=>$user->good_comment_count,"report"=>$user->bad_comment_count))?>
					</div>
				</div>
			</div>
			
			
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
						<div class="hidden-sm-xs" style="margin-top:17px;">
							
						</div>
						Reputation
					
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					
					<span class="transformers level-font">&nbsp;<span class="text inline-block">Level</span><span class="count" style="margin-top:0px"><?=$user->level?></span></span>
					
					
					<br>
					<div class="row">
						<div class="col-lg-5">
							<?=$this->load->view("wrapper/user_experience_bar")?>
						</div>
					</div>
					
				</div>
			</div>
			
					
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Role
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?=$user->role?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Status
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<div class="vertical-bottom icons inline-block user-status user-state <?php if($user->isonline) echo "online"; else echo "offline";?>" userid="<?=$user->id?>" style="margin-right:0px">
					</div>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Agency
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?=empty($user->agency) ? "-" : $user->agency ?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Member Since
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?=date('d/m/Y  g:i A',strtotime($user->registerdate));?>
				</div>
			</div>
			
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Total Posting(s)
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<a target="_blank" href="posting/view/<?=$user->id?>" data-toggle="tooltip" data-placement="top" title="Click to see all <?=$user->username?>&apos;s posting"><strong><?=concat_if_plural(" Posting","s",$user->postcount)?></strong></a>
				</div>
			</div>
			
			
			
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Phone
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?php if($user->canseephone):?>
              	 	 	<span><?=$user->phone?> <?=empty($user->alternatephone) ? "" : " / ".$user->alternatephone ?></span>
              	 	 <?php else:?>
              	 	 	<span><em>Hidden</em></span>	
          	 	 	<?php endif?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Email
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?=empty($user->email) ? "-" : $user->email ?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Contact Method
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?=($user->contactmethod)?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Working Hour
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?=($user->workingfrom) ."-". ($user->workingto)?>
				</div>
			</div>
			<div class="row details-row">
				<div class="col-lg-3 col-md-3 col-xs-12">
					Description
				</div>
				<div class="col-lg-9 col-md-9 col-xs-12">
					<?=empty($user->description) ? "-" : $user->description?>
				</div>
			</div>
			
			
			
		</div>
	</div>
</div>
