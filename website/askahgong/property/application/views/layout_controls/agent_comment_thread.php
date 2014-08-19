

<?php foreach($comment_threads as $thread):?>
<div class="row agent-comment-parent" thread_id="<?=$thread->id?>">
	<div class="col-xs-12">
		<div class="agent-comment-container">
			<div class="col-xs-2 col-lg-1_5">
				<img class="img-responsive" src="<?=get_user_profile_pic($thread->userid)?>">
			</div>
			<div class="col-xs-10 col-lg-10_5" style="padding-left:0px;">
				<?=generate_username_control($thread->userid,$thread->user_username,false,$thread->user_isonline,20)?> posted <span class="datetime"><?=ago($thread->dateandtime)?></span>
				<br>
				<em>
					<i class="fa fa-<?php if($thread->point>0) echo "smile"; else echo "frown";?>-o"></i> <?=$thread->title?> 
					<?php if($agent_id==get_userid()):?>
					<span class="<?php if($thread->point>0) echo "green"; else echo "red";?>"><?php if($thread->point>0) echo "+";?><?=$thread->point?> reputation points</span>
					<?php endif?>
				</em>
				<br>
				<?=$thread->content?>
				<br>
				<div class="controls">
						<?php if($agent_id==get_userid() || get_userid()==$thread->userid):?>
						<a href="javascript:void(0)" onclick="focus_agent_comment_reply_textarea(this)"><i class="fa fa-reply"></i> Reply</a> 
						<?php endif?>
						
						<?php if($agent_id==get_userid() && $thread->reported==0):?>
						<a href="javascript:void(0)" onclick="report_thread(this,<?=$thread->id?>)"><i class="fa fa-exclamation-triangle"></i> Report</a> 
						<?php endif?>
						
						<?php if($agent_id==get_userid()):?>
						<a class="underline report <?php if($thread->reported==0) echo "hidden-object"?>">Reported</a>
						<?php endif?>
						
						<?php if(get_userid()==$thread->userid):?>
						<a href="javascript:void(0)" onclick="delete_agent_comment_thread(this,<?=$agent_id?>)"><i class="fa fa-trash-o"></i> Delete</a>
						<?php endif?>
						
						<?php if($thread->replies_count>2):?>
						<a href="javascript:void(0)" onclick="get_all_agent_comment_replies(this,<?=$thread->id?>)"><i class="fa fa-caret-down"></i> See more replies(<?=$thread->replies_count-2?>)</a>
						<?php endif?>
						
				</div>
				
			</div>
			
			<div class="clear"></div>
			
			<div class="replies-container">
				<?php $comments["comments"] = $thread->comments?>
				<?= $this->load->view("layout_controls/agent_comment_reply_listing",$comments)?>
			</div>
			
			
			
			<div class="clear"></div>
			<?php if($agent_id==get_userid() || get_userid()==$thread->userid):?>
			<div class="write-reply col-xs-12">
				<textarea class="form-control" onkeydown="submit_agent_comment_reply(this,event,<?=$thread->id?>)" rows="1" placeholder="Write a comment, press enter to post."></textarea>
			</div>
			<?php endif?>
			
		</div>
		
	</div>
	
</div>
<?php endforeach?>



<?php if(count($comment_threads)==0):?>
	
		<div class="margin-top border-radius">
			
			<?php 
				$info['type']="agent_review";
			?>
			<?=$this->load->view("layout_controls/no_result_info_text",$info)?>
		</div>
			
			
	
<?php else:?>
	<?php if(!empty($pagination)):?>
	<div class="row">
		<div class="col-xs-12 text-center page-links" style="margin-top:20px;">
			<?php echo $pagination; ?>
		</div>
	</div>	
	<?php endif?>
	
	<div class="col-xs-12 text-center" style="margin-top:20px;">
		<?= $this->load->view("user_controls/results_count",Array("start"=>$start,"limit"=>$limit,"totalcount"=>$comment_threads_count,"type"=>"Review"));?>
	</div>
	
	
<?php endif?>	





