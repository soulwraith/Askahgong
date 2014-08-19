
<?php 
	if($type=="shortlist"){
		$title="You have not shortlisted any item yet.";
		$content="<a href='".url("about_feature","#faq_shortlist")."' target='_blank'>Learn More About Shortlist</a>";
	}
	elseif($type=="posting"){
		
		if($user->id==get_userid()){
			$title="You have not posted any request yet.";
			$content="<a href='".url("newpost")."' target='_blank'>Post A New Request Now</a>";
		}
		else{
			$title="This user has not posted any request yet.";
			$content="";
		}
		
		
	}
	elseif($type=="notification_all"){
		$title="You have no notification recorded. ";
		$content="<a href='".url("about_website","#faq-notification")."' target='_blank'>Learn More About Notification</a>";
	}	
	elseif($type=="notification_discussion"){
		$title="You have no notification recorded. ";
		$content="<a href='".url("discussion")."' target='_blank'>Join Our Discussion <br>Community Now</a>";
	}
	elseif($type=="notification_item"){
		$title="You have no item alert recorded. ";
		$content="<a href='".url("settings","#notification-settings")."' target='_blank'>Add A New Item Alert <br>Setting Now</a>";
	}	
	elseif($type=="no_item_matched"){
		$title='There is no item matching this posting. You may view "similar item" to get relevant posting. ';
		$content="<a href='javascript:void(0);' onclick='scroll_to_similar_items()'>View Similar Item Now</a>";
	}	
	elseif($type=="agent_review"){
		$title='No review found for this agent. ';
		$content="<a href='javascript:void(0);'>Learn More About Review</a>";
	}						
?>	




<div class="col-xs-12 info-box text-center">

		<img class="inline-block vertical-middle" src="image/ahgong/thinking.png">
		<div class="text-container inline-block vertical-middle">
			<div class="text1">
				<?=$title?>
			</div>
			<div class="text2">
				<?=$content?>
			</div>
		</div>

	<div class="clear"></div>
</div>
