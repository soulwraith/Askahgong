

<?php if(is_verified_agent($user)):?>

<a class="comment-total-container" href="agent_comment/view/<?=$user->id?>" target="_blank">
	<span class="label label-warning"><?=$user->good_comment_count?> <i class="icon-smile-o lh-17"></i></span>
	<span class="label label-warning"><?=$user->bad_comment_count?> <i class="icon-frown-o lh-17"></i></span>
</a>

<?php endif?>
