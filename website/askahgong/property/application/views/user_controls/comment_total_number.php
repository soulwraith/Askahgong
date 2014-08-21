

<?php if(is_verified_agent($user)):?>

<a class="comment-total-container" href="agent_comment/view/<?=$user->id?>" target="_blank">
	<span class="label label-warning"><?=$user->good_comment_count?> <i class="fa fa-smile-o"></i></span>
	<span class="label label-warning"><?=$user->bad_comment_count?> <i class="fa fa-frown-o"></i></span>
</a>

<?php endif?>
