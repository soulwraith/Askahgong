

<div class="SUBPAGE_AGENT_COMMENT">
	<div class="header">
		<?php if($user->id==get_userid()):?>
			My Review
		<?php else:?>
			<?=$user->username?>'s Review
		<?php endif?>
		<div class="right icons review-icon">
		</div>
	</div>
	
	
	
	
	
	<?php if($user->id==get_userid()):?>
		<?php $html = "Your reputation score shows how much you have contributed to building the Ask Ah Gong community, and making it easier for buyers or sellers to complete the transactions through your service.
						 <br>
						 Normally,<strong> agents with high reputation will get more requests from users without agent representative.</strong>
						<br>
						<a href='about/title/website#faq-reputation' target='blank'>How can I improve my reputation score?</a>"
		?>
		 
	<?php else:?>
		
		<?php $html = "Your review will help to improve on ".$user->username." score, and help ".$user->username." to build his business. You can also let ".$user->username." know how he can improve on his service."
		?>
		
		
	<?php endif?>
	
	<div class="row margin-top">
		<div class="col-xs-12">
			<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"info",
						"alert_html"=>$html))
					?>
		</div>
		
	</div>
	
	
	
	
	<?php if($agent_id!=get_userid()):?>
		
	<div class="row">
		<div class="col-xs-12">
			<div class="comment-container">
				
				<div class="row">
					<div class="col-xs-12 col-sm-6 text-center comment-type">
						<i class="icons commend pointer-cursor" onclick="show_comment_container('commend')">
							
						</i>
						
					</div>
					<div class="col-xs-12 col-sm-6 text-center comment-type">
						<i class="icons report pointer-cursor" onclick="show_comment_container('report')">
							
						</i>
					</div>
				</div>
				
				
			</div>
			
			
		</div>
		
	</div>	
		
		
	
	
	
	<div class="row commend-container hidden-object">
		<div class="col-xs-12">
			<div class="comment-input-container">
				<form action="agent_comment/insert_new_agent_thread" method="POST">
				<?php $i=0?>
				<?php foreach($good_feedbacks as $feedback):?>
					<div class="radio">
					  <label>
					    <input type="radio" name="reason_id" value="<?=$feedback->id?>" <?php if($i==0) echo "checked"?>>
					    <?=$feedback->title?>
					  </label>
					</div>
						
					<?php $i++?>
				<?php endforeach?>
				
					<input type="hidden" name="agent_id" value="<?=$agent_id?>">
					<div class="form-group">
						<textarea name="content" class="form-control" placeholder="Write your comment."></textarea>
					</div>
					
					<div class="form-group">
						<button class="btn btn-amber" type="button"  onclick="check_has_previous_comment(this,<?=$agent_id?>)">Submit</button>
					</div>
					
				
				</form>
			</div>
			
		</div>
	</div>
	
	<div class="row report-container hidden-object">
		<div class="col-xs-12">
			<div class="comment-input-container">
				<form action="agent_comment/insert_new_agent_thread" method="POST">
				<?php $i=0?>
				<?php foreach($bad_feedbacks as $feedback):?>
					<div class="radio">
					  <label>
					    <input type="radio" name="reason_id" value="<?=$feedback->id?>" <?php if($i==0) echo "checked"?>>
					    <?=$feedback->title?>
					  </label>
					</div>
						
					<?php $i++?>
				<?php endforeach?>
					<input type="hidden" name="agent_id" value="<?=$agent_id?>">
					<div class="form-group">
						<textarea name="content" class="form-control" placeholder="Write your comment."></textarea>
					</div>
					
					<div class="form-group">
						<button class="btn btn-amber" type="button" onclick="check_has_previous_comment(this,<?=$agent_id?>)">Submit</button>
					</div>
				
				</form>
			</div>
		</div>
	</div>
	<?php endif?>
	
	
	
	<div class="row">
		<div class="col-xs-12">
			<div class="reputation-container">
				
				<div class="col-xs-12 col-md-6 col-sm-5 level-container">
					<div class="details-label"><?=$user->username?>'s Reputation
					</div>
					
					<div class="details">
						
						
							<div>
								<span class="transformers level-font"><span class="text inline-block">Level</span><span class="count"> <?=$user->level?></span></span>
							</div>
							<div style="margin-top:-5px;">
								<?=$this->load->view("wrapper/user_experience_bar")?>
								<div class="current-points">
									<?=$user->current_exp?>/<?=$user->nextlevel_exp?> Points
								</div>
							</div>
					</div>
				</div>
				<div class="col-sm-7 col-xs-12 col-md-6 col-lg-6">
					<div class="sub-details">
						<span class="title">Total Posting(s) :</span>
						<span class="content"><a href="posting/view/<?=$user->id?>" target="_blank"><?=$user->postcount?></a></span>
					</div>
					
					<div class="sub-details">
						<span class="title">Total Discussion Topic(s) :</span>
						<span class="content"><?=$total_topic_count?></span>
					</div>
					
					<div class="sub-details">
						<span class="title">Total Discussion Reply(s) :</span>
						<span class="content"><?=$total_comment_count?></span>
					</div>
					
					<div class="sub-details">
						<span class="title">Total Review(s) :</span>
						<span class="content"><?=$this->load->view("user_controls/comment_total_number",Array("goodAction"=>'switch_review_page(this,"good",'.$agent_id.')',"badAction"=>'switch_review_page(this,"bad",'.$agent_id.')',"userID"=>$user->id,"commend"=>$good_count,"report"=>$bad_count))?></span>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
	</div>
	
	
	<div class="agent-comments-container">
		<?=$this->load->view("layout_controls/agent_comment_thread")?>
	</div>
	
	
	
</div>




