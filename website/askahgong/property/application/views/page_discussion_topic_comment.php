



<?$topicid=0?>
<?$userid=0?>
<?php if(($topic)!=""):?>
	<?php $topicid=$topic->id?>
	<?php $userid=$topic->userid?>
<?php endif?>




<?php 
	$previous = array(
	 'Discussion' => 'discussion',
	 $currentcategory->category => 'discussion/listing/'.$currentcategory->id
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>$topic->topictitle))?>





<div class="container PAGE_COMMENT">
	<div class="row margin-top position-relative">
		<div class="col-xs-12">
		  <div class="topic-container">	
		  	<?php if($topic->userid==get_userid() && !$topic->solved):?>
			
		
				<div class="manage-controls">
					<div class="edit-topic icons" data-toggle="tooltip" title="Edit this topic"  onclick="direct_to_url('discussion/edittopic/<?=$topicid?>')">
						
					</div>
				</div>
				
			
			<?php endif?>
			
			<?=$this->load->view("layout_controls/admin_discussion_control",Array("topic"=>$topic))?>
			
		  	<div class="hidden-overflow">
		  		<div class="col-xs-2 text-center topic-owner-img-container">
					<a href="activity/id/<?=$topic->userid?>">
						<img userid="<?=$topic->userid?>"  style="max-height:160px;"  class="topic-owner-img img-responsive background open-message user-state <?php if($topic->isonline) echo "online"?>" alt="<?=$topic->username?>" src="<?=get_user_profile_pic($topic->userid)?>">
					</a>
				</div>
				
				<div class="col-xs-10">
					<div class="topic-details">
					
						<div class="row">
							<div class="col-xs-12">
								<div class="topic-title">
									<?=$topic->topictitle?>
									
									
									
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12">
								<div class="topic-owner-name">By <span class="user"><?=generate_username_control($topic->userid,$topic->username)?></span></div>
								<div class="topic-posted-datetime"> 
									<em>Posted <?=ago($topic->dateandtime)?></em>
								</div>
						
							</div>
							
						</div>
						
						<?php if($topic->good!=0 || $topic->solved!=0):?>
						
						<div class="row">
							
							<div class="col-xs-12">
								<?php if($topic->good!=0):?>
		          					<div class="icons great-topic inline-block" title="This topic has been marked as Great Topic." data-toggle="tooltip" data-container='body'></div>
		          				<?php endif?>
		              			<?php if($topic->solved!=0):?>
		          					<div class="icons solved inline-block" title="This topic has been closed." data-toggle="tooltip" data-container='body'></div>
		          				<?php endif?>
							</div>
						</div>
						
						<?php endif?>
						
						<div class="row">
							<div class="col-xs-12">
								<div class="topic-text">
									<div class="topic-separator">
							
									</div>
									
									<span class="to-process"><?=$topic->topictext?></span>
								</div>
							</div>
						</div>
							
							
							
							
						
						
						
						
						
						
						
					</div>
				</div>
				<div class="clear"></div>
		  	</div>
			
			
	      </div>
		</div>
		
		
			

		
	</div>
	
	
	<div class="row margin-top">
		<div class="col-sm-6 col-xs-12">
			<div class="padding-equal grey-bg left">
				<button class="btn-light-orange btn" <?php if($topic->solved) echo "disabled"?> onclick="scrollToReply()">Reply</button>
			</div>
			<div class="padding-equal grey-bg left margin-left">
				<a class="btn-light-orange btn" href="discussion/listing/<?=$currentcategory->id?>">Back To Topic List</a>
			</div>
			<div class="clear"></div>
		</div>
		
		
		<div class="col-sm-6 col-xs-12 text-right" style="padding-top:22px;">
			<?= $this->load->view("user_controls/results_count",Array("start"=>$offset,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>"Comment"));?>
		</div>
		
	</div>
	
	<div class="row comments-container margin-top position-relative">
		<img class="comments-shadow top" src="image/discussion_shadow_top.png">
		<img class="comments-shadow bottom" src="image/discussion_shadow_bottom.png">
		
		<div class="col-xs-12">
			
			<?php if(count($topic_comments)!=0):?>
				<?php $counter=1+$offset?>
				<?php foreach($topic_comments as $comment):?>
		
					
				<div id="comment<?=$comment->id?>" class="margin-top comment-container <?php if($counter%2!=0) echo "white";else echo "grey"?>">
					<div class="col-xs-12">
						<div class="row comment-details">
							<?php if($comment->userid==$this->session->userdata('userid') && !$comment->hidden && !$topic->solved):?>
								<div class="manage-controls">
									<div class="icons edit" onclick="edit_comment(<?=$comment->id?>)" data-toggle="tooltip" title="Edit Comment" data-placement="top">
							
									</div>
									<div class="icons delete" onclick="delete_comment(this,<?=$comment->id?>)" data-toggle="tooltip" title="Delete Comment" data-placement="top">
										
									</div>
								</div>
							<?php endif?>
							<?=$this->load->view("layout_controls/admin_discussion_control",Array("comment"=>$comment))?>
								
							
							<div class="hidden-overflow">
								<div class="col-xs-2 col-lg-1_5 col-sm-3 col-md-2">
									<div class="text-center comment-owner-img-container position-relative inline-block" style="z-index:2;">
										<a href="activity/id/<?=$comment->userid?>">
											<img class="inline-block comment-owner-img img-responsive background open-message user-state <?php if($comment->isonline) echo "online"?>"  alt="<?=$comment->username?>" userid="<?=$comment->userid?>" src="<?=get_user_profile_pic($comment->userid)?>">
										</a>
										<?php if($topic->userid==$comment->userid):?>
										<div class="post-owner-indicator hidden-xs">
												<div class="inner">
													Post Owner
												</div>
										</div>	
										<?php endif?>
											
									</div>
								</div>
								
								<div class="col-xs-10 col-lg-10_5 col-sm-9 col-md-10 no-padleft-xs">
									<div class="row">
										<div class="col-xs-8">
											<div class="comment-owner-name <?php if($comment->userid==get_userid()) echo "my-comment"?>"><?=$this->load->view("user_controls/username_control",Array("showing_pic"=>false,"showing_userid"=>$comment->userid,"showing_username"=>$comment->username))?></div>
										</div>
										<div class="col-xs-4">
											<div class="comment-counter">
												
												
												#<?=$counter?>
											</div>
										</div>
									</div>
									
									
									<div class="row position-relative">
										<div class="comment-separator"></div>
										<div class="comment-content">
											<div class="col-xs-9 col-sm-8 col-md-9">
												
													
														
													<div>
														<div class="comment<?=$comment->id?>">
															<?php if(!$comment->hidden):?>
																<span class="to-process"><?=$comment->comment?></span>
															<?php else:?>
																<em>This comment has been deleted.</em>
															<?php endif?>
														</div>
													</div>
												</div>
													
													
									
											
											<div class="col-xs-3 col-sm-4 col-md-3">
												<div class="">
													<div class="right text-right">
														<?=ago($comment->dateandtime)?>
													</div>
													<div class="clear"></div>
													<div class="comment-special">
							 							<?php if($comment->helpful==1):?>
								          					<div class="icons good-comment inline-block" title="This reply is helpful." data-toggle="tooltip" data-container='body'></div>
								          				<?php endif?>
								          				<?php if($comment->helpful==2):?>
								          					<div class="icons great-comment inline-block" title="This reply is super helpful." data-toggle="tooltip" data-container='body'></div>
								          				<?php endif?>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								
						
								
					
		
							</div>
							
							
							
							
						</div>	
					</div>
					
					
					
					
					
					
					
				</div>
				
				<?php $counter++?>
				<?php endforeach?>
			<?php else:?>
				<div class="text-center"><strong>No comment found. Be the first one to comment!</strong></div>
			<?php endif?>
			
			
		</div>
		
		
		
		
	</div>
	
	<div class="row">
		<div class="page-links col-xs-12 text-center margin-top">
			<?php echo $pagination; ?>
		</div>
		<div class="col-xs-12 text-center margin-top">
			<?= $this->load->view("user_controls/results_count",Array("start"=>$offset,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>"Comment"));?>
		</div>
		
		
		
	</div>
	
	
	<div class="row">
		<div class="col-xs-12" style="margin-top:20px;margin-bottom:15px;">
			<span class="bold big-font hidden-xs">Comment</span>
		</div>
		
		
		
	</div>
	
	<div class="row">
		
		<?php if($topic->solved==1):?>
			<div class="margin-bottom col-xs-12">
				This topic has been closed.
			</div>
		<?php elseif(user_validated()):?>
		  <div class="bold big-font col-xs-12 margin-bottom visible-xs">Comment</div> 	
		  <form id="commentform" class="commonform" method="post" onsubmit="if(!$('.comment').advancedTextArea('canSubmit')) return false;" action="discussion/submitcomment/<?=$topicid?>/<?=$currentcategory->id?>">	
			<div class="col-sm-12">
				
					<div class="comment"></div>

			</div>
			<div class="col-md-6 col-xs-12">
				<div class="leave-comment-container position-relative">
					<img class="leave-comment-image img-responsive left background online" src="<?=get_user_profile_pic($this->session->userdata('userid'))?>">
					<div class="icons leave-comment-tail"></div>
					<div class="leave-comment-text left">Leave a comment</div>
				</div>
				<div class="clear"></div>
					
			</div>
			
			
			<div class="col-md-6 margin-top col-xs-12">
				<div class="padding-equal grey-bg right margin-right editcomment-button hidden-object">
					<button onclick="cancel_edit_comment()" class="btn btn-lg btn-white" type="button">Cancel Edit Comment</button>
				</div>	
				<div class="padding-equal grey-bg right">
					<input class="btn btn-light-orange btn-lg" type="submit" value="Submit Comment">
				</div>
				
				<input name="commentid" type="hidden" class="commentid">
				
				
			</div>
		 </form>	
		<?php else:?>
			<div class="margin-bottom col-xs-12">
				Please <a id="logintocomment" href="user/login?&login=<?=uri_string()?>">login</a> first to comment.
			</div>
		<?php endif?>
	</div>
	
</div>

<script type="text/javascript">

var PAGE_COMMENT_categoryid,
    PAGE_COMMENT_topicid;

	   	PAGE_COMMENT_categoryid=<?=$currentcategory->id?>;
	    PAGE_COMMENT_topicid=<?=$topicid?>;
	    PAGE_COMMENT_focuscomment=<?=$focuscomment?>;
</script>








