


<a class="comment-total-container" <?php if(isset($goodAction)) echo "onclick='".$goodAction."' href='javascript:void(0);'"; else echo 'href="agent_comment/view/'.$userID.'" target="_blank"'?>>
	<span class="label commend"><i class="icons"></i>
		<span class="vertical-middle">
			<?=$commend?> 
		</span>
	</span>
</a>


<a class="comment-total-container" <?php if(isset($badAction)) echo "onclick='".$badAction."' href='javascript:void(0);'"; else echo 'href="agent_comment/view/'.$userID.'" target="_blank"'?>>
	<span class="label report"><i class="icons"></i>
		<span class="vertical-middle">
			<?=$report?> 
		</span>
	</span>
</a>




