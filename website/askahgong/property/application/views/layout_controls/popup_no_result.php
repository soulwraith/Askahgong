<?php 
	if($type=="shortlist"){
		$title="You have not shortlisted any item yet.";
		$content="<a href='".url("about_feature","#faq_shortlist")."' target='_blank'>Learn More About Shortlist</a>";
	}
	elseif($type=="notification_discussion"){
		$title="You have no notification recorded. ";
		$content="<a href='".url("discussion")."' target='_blank'>Join Our Discussion <br> Community Now</a>";
	}
	elseif($type=="notification_item"){
		$title="You have no item alert recorded. ";
		$content="<a href='".url("settings","#notification-settings")."' target='_blank'>Add A New Item Alert <br> Setting Now</a>";
	}	
	elseif($type=="agent_request"){
		$title="No agent request history recorded. ";
		$content="";
	}	
	elseif($type=="agent-review"){
		$title="No agent review history recorded. ";
		$content="";
	}						
?>	



<div class="no-result">
	<?php if($type=="shortlist"):?>
	<img class="bg" src="image/kolian.png">
	<img class="sit-ahgong" src="image/ahgong/sad.png">
	<?php else:?>
	<img class="tilt" src="image/ahgong/ahgongtilt.png">	
	
	<?php endif?>
	
	
	<div class="text-container">
		<div class="text1">
			<?=$title?>
		</div>
		
		<div class="text2">
			<?=$content?>
		</div>
	</div>
	
	
</div>
