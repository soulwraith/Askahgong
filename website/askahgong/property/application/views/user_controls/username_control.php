
<?php if($showing_userid==get_userid()):?>
	<a href="activity">
	<?php if($possesive):?>
		Your
	<?php else:?>
		You
	<?php endif?>
	</a>
<?php else:?>
	<?php if($possesive):?>
		<?php $showing_username .= "'s"?>
	<?php endif?>
	<div user-panel-id="<?=$showing_userid?>" class="inline position-relative">
		<?php if($showing_pic):?>
		<img class="img-smallest" src="<?=get_user_profile_pic($showing_userid)?>" style="margin-top:-5px">
		<?php endif?>
		<?php if($no_link):?>
			<?=cutofftext($showing_username,$limit_count,"...")?>
		<?php else:?>
			<a <?php if($new_tab) echo "target='_blank'"?> href="user/id/<?=$showing_userid?>"><?=cutofftext($showing_username,$limit_count,"...")?></a>
		<?php endif?>
		
		<?php if($user_status!="unknown"):?>
		<div class="inline-block icons vertical-bottom user-state user-status <?=$user_status?>" userid="<?=$showing_userid?>"></div>
		<?php endif?>
	</div>	


<?php endif?>

