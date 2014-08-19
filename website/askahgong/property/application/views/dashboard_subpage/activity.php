

<div class="activities-listing-container">
	<div class="header">
		
		<?php if($user->id==get_userid()):?>
			My Activity
		<?php else:?>
			<?=$user->username?>'s Activity
		<?php endif?>	

		<div class="right icons activity-pen">
			
		</div>
	</div>
	
	<div class="activities-listing">
		<?=$this->load->view("layout_controls/activities_listing")?>
		<img class="activity-shadow bottom" src="image/discussion_shadow_bottom.png">
	</div>
	
	<?php if(count($activities)>=$limit):?>
	<div class="text-center position-relative">
		<a class="load-more border-radius" href="javascript:void(0)" onclick="more_activity(<?=$user->id?>)">
			Load More Activities
		</a>
	</div>
	<?php endif?>
</div>




