<?php if($admin):?>
<div class="right admin-controls padding-equal border-radius" style="position:absolute;right:-93px;bottom:0px;background-color: #F1EDED;border: 2px solid black;width: 93px;">
	
	<?php if(isset($comment)):?>
		<?php if(!$comment->hidden):?>
		<div>
			<a style='display:block;' href="javascript:void(0)" onclick="delete_comment_admin(this,<?=$comment->id?>)">Delete</a>
			<?php if($comment->helpful!=1 && $comment->helpful!=2):?>
			<a style='display:block;' class="helpful" href="javascript:void(0)" onclick="mark_as_helpful(this,1,<?=$comment->id?>,<?=$comment->userid?>)">Helpful</a>
			<a style='display:block;' class="helpful" href="javascript:void(0)" onclick="mark_as_helpful(this,2,<?=$comment->id?>,<?=$comment->userid?>)">Super Helpful</a>
			<?php endif?>
			
			<div class="helpful-text" style="color:green">
				<?php if($comment->helpful==1):?>
					Helpful!
				<?php elseif($comment->helpful==2):?>
					Super Helpful!
				<?php endif?>
			</div>
		</div>
		<?php endif?>
	<?php elseif(isset($topic)):?>
			<?php if($topic->good!=1):?>
			<a style='display:block;' class="helpful" href="javascript:void(0)" onclick="mark_as_good_topic(this,<?=$topic->id?>,<?=$topic->userid?>)">Good Topic</a>
			<?php endif?>
			
			<div class="goodtopic-text" style="color:green">
				<?php if($topic->good==1):?>
					Good Topic!
				<?php endif?>
			</div>
		
	
	<?php endif?>
</div>
<?php endif?>
