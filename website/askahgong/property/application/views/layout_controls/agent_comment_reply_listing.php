<?php foreach($comments as $comment):?>
	<div class="row">
		
		<div class="col-xs-12">
			
		
			<div class="reply-container" reply_id="<?=$comment->id?>">
				<div class="col-lg-1_5 col-xs-2">
					<img class="img-responsive" src="<?=get_user_profile_pic($comment->userid)?>">
				</div>
				<div class="col-lg-10_5 col-xs-10" style="padding-left:0px;">
					<?=generate_username_control($comment->userid,$comment->username,false,$comment->isonline,20)?> 
					<span class="datetime">replied <?=ago($comment->dateandtime)?></span>
					
					<br>
					<?= $comment->content?>
				</div>
				<br class="clear">
				
			</div>
		</div>
	</div>
	
<?php endforeach?>	

