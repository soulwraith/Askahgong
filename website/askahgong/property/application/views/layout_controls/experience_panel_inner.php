<div class="content">
	<div style="margin-bottom:15px;">
		<span class="text1">Welcome to Askahgong.com</span>
	</div>
	<div>
		<span class="text2">For</span> <br>
		<?php $exp_title = $unread_points_details->title?>
		<?php if($unread_points_details->reason_id==7 || $unread_points_details->reason_id==8):?>
			<?php $exp_title.= ", ".$unread_points_details->reserved?>
		<?php endif?>	
		<?php if($unread_points_details->agent_review==1):?>
			<?php $exp_title = "ABC"?>
		<?php endif?>	
		<span class="text3">"<?=$exp_title?>"<span>
	</div>
	
	<?php if($unread_points_details->reason_id==1):?> <!--login reward-->
	<div class="login-award hidden-xs">
		<?php for($i=1;$i<=7;$i++):?>
			<div class="day-count <?php if($i<=$unread_points_details->reserved) echo "received"?>">
				<span class="number-of-day">Day <?=$i?></span><br>
				<span class="points-added">+<?=$i*2?></span>
				<?php if($i==$unread_points_details->reserved):?>
				<div class="bigger icons">
					<div class="inner">
						<span class="number-of-day">Day <?=$i?></span><br>
						<span class="points-added">+<?=$i*2?></span>
					</div>
					
				</div>
				<?php endif?>
			</div>
		<?php endfor?>	
		
		
		<div class="clear"></div>
	</div>
	<?php endif?>
	
	<span class="text3" style="font-style:normal;">
	
	
	<?php if($unread_points_details->reason_id==4 || $unread_points_details->reason_id==5):?>
		<?php 
			$tmparr=explode("(%2)",$unread_points_details->extra);
			$topic_id=$tmparr[0];
			$comment_id=$tmparr[1];
			$comment_page=$tmparr[2];
			$topic_title=$tmparr[3];
		?>
		<a target="_blank" href="discussion/topic/<?=$topic_id?>/<?=$comment_page?>/<?=$comment_id?>">[View Here]</a>
	<?php endif?>	
	
	
	<?php if($unread_points_details->reason_id==9):?>
		<?php 
			$tmparr=explode("(%2)",$unread_points_details->extra);
			$topic_id=$tmparr[0];
			$topic_title=$tmparr[1];
		?>
		<a target="_blank" href="discussion/topic/<?=$topic_id?>">[View Here]</a>
	<?php endif?>	
	
	<?php if($unread_points_details->reason_id==10):?>
		<a target="_blank" href="<?=$unread_points_details->item->url?>">[View Here]</a>
	<?php endif?>	
	
	<?php if($unread_points_details->agent_review==1):?>
		<a target="_blank" href="agent_comment/view">[View Here]</a>
	<?php endif?>	
	
	</span>
	<div>
		<span class="text2">You 
			<?php if($unread_points_details->points_awarded > 0):?>
				are awarded
			<?php else:?>
				have lost
			<?php endif?>
		</span>
	</div>
	<div style="margin:20px 0px 10px 0px;">
		<span class="text4"><?=$unread_points_details->points_awarded?></span>
	</div>
	<div>
		<span class="text5">Reputation point<?php if(abs($unread_points_details->points_awarded)>1) echo "s"?></span>
	</div>
	<a href="about/title/website#faq-reputation" target="_blank">
	<div>
		<span class="text6">Get more reputation points!</span>
	</div>
	</a>
</div>
<div class="lower-content">
	<div>
		<span class="text1">Reputation : </span><span class="transformers text2">Level</span>&nbsp;&nbsp;<span class="transformers text3 uplevel-change"><?=$unread_points_details->level?></span>
	</div>
	<div style="padding:0px 15px;height:20px;">
		
				
		
		<?php $exp_bar["level"]=$unread_points_details->level?>
		<?php $exp_bar["points"]=$unread_points_details->current_points?>
		<?php $exp_bar["added_points"]=$unread_points_details->points_awarded?>
		<?php $exp_bar["nextlevel_exp"]=$unread_points_details->nextlevelpoints?>
		<?php $exp_bar["current_exp"]=$unread_points_details->current_points?>
		<?php $exp_bar["animated"] = true?>
		<?=$this->load->view("user_controls/experience_bar",$exp_bar)?>
	</div>
	<div class="clear"></div>
	<div class="text-center">
		<span class="text4 inline-block">
			<span class="currentpoints" changed_points="<?=$unread_points_details->points_awarded?>">
				<?=$unread_points_details->current_points?>
			</span>
			/
			<span class="nextlevelpoints">
				<?=$unread_points_details->nextlevelpoints?>
			</span> Points
		</span>
		<span class="text5 inline-block vertical-bottom <?php if($unread_points_details->points_awarded>0) echo "green"; else echo "red";?>"> 
			<?php if($unread_points_details->points_awarded>0) echo "+";?><?=$unread_points_details->points_awarded?>
		</span>
	</div>
	<div class="">
		<button class="btn btn-white ok-button" onclick="remove_experience_panel(this)"><?php if($queue_count>0) echo "Next"; else echo "OK"?> (<span class="countdown">10</span>)</button>
	</div>
	<?php if($queue_count>0):?>
	<div class="text6">
		<?=concat_if_plural(" more reward","s",$queue_count)?> 
		<a href="javascript:void(0)" onclick="mark_all_reward_read();remove_experience_panel(this);">(Skip All)</a>
	</div>
	<?php endif?>
</div>
