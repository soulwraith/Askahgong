

<div class="SUBPAGE_AGENT_COMMENT">
	<div class="header">
		<?php if($user->id==get_userid()):?>
			My Review
		<?php else:?>
			<?=$user->username?>'s Review
		<?php endif?>
		<div class="right icons profile-icon">
		</div>
	</div>
	
	<div class="alert alert-warning" style="margin:10px 0px;">
		<?php if($user->id==get_userid()):?>
			 Your reputation score shows how much you have contributed to building the Ask Ah Gong community, and making it easier for buyers or sellers to complete the transactions through your service.
			 <br>
			 Normally,<strong> agents with high reputation will get more requests from users without agent representative.</strong>
			<br>
			<a>How can I improve my reputation score?</a>
		<?php else:?>
			Your review will help to improve on <?=$user->username?> score, and help <?=$user->username?> to build his business. You can also let <?=$user->username?> know how he can improve on his service. 
		<?php endif?>
	</div>
	
	
	<?php if($agent_id!=get_userid()):?>
	<div class="row">
		<div class="col-xs-12">
			<div class="comment-container">
				<button type="button" onclick="show_comment_container('commend')" class="btn btn-primary btn-xs"><i class="icon-smile-o lh-17"></i> Commend This Agent</button>
				<button type="button" onclick="show_comment_container('report')" class="btn btn-primary btn-xs"><i class="icon-frown-o lh-17"></i> Report This Agent</button>
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
				
			
				<div class="details-label">&#x25cf; <?=$user->username?>'s Reputation
				</div>
				
				<div class="details">
					
					<div class="col-xs-12 col-lg-6">
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
				
				
			
				
				
				<div class="clear"></div>
			</div>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="sub-details">
				<span class="title">&bull; Total Posting(s) :</span>
				<span class="content"><a href="posting/view/<?=$user->id?>" target="_blank"><?=$user->postcount?></a></span>
			</div>
			
			<div class="sub-details">
				<span class="title">&bull; Total Discussion Topic(s) :</span>
				<span class="content"><?=$total_topic_count?></span>
			</div>
			
			<div class="sub-details">
				<span class="title">&bull; Total Discussion Reply(s) :</span>
				<span class="content"><?=$total_comment_count?></span>
			</div>
			
			<div class="sub-details">
				<span class="title">&bull; Total Review(s) :</span>
				<button type="button" onclick="switch_review_page(this,'good',<?=$agent_id?>)" class="btn btn-amber btn-sm review-switch"><?=$good_count?> <span class="icon-smile-o lh-18"></span></button>
				<button type="button" onclick="switch_review_page(this,'bad',<?=$agent_id?>)" class="btn btn-amber btn-sm review-switch"><?=$bad_count?> <span class="icon-frown-o lh-18"></span></button>
			</div>
			
		</div>
	</div>
	<div class="agent-comments-container">
		<?=$this->load->view("layout_controls/agent_comment_thread")?>
	</div>
	
	
	
</div>




