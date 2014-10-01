<?php if($user->id==$this->session->userdata("userid")):?>

	<?php if($type=="normal"):?>
	
	<div class="dashboard-menu">
		
		
		
		
		<a href="activity">
			<div class="menu-item-container <?php if($dashboard_page=="home") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons activity"></div></div>
				<div class="menu-item ">
					Activity
				</div>
			</div>
		</a>
		
		<?php if($isAgent):?>
		<a href="agent_comment/view">
			<div class="menu-item-container <?php if($dashboard_page=="agent_comment") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons review"></div></div>
				<div class="menu-item ">
					Review
				</div>
			</div>
		</a>
		<?php endif?>
		
		<a href="profile">
			<div class="menu-item-container <?php if($dashboard_page=="profile") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons profile"></div></div>
				<div class="menu-item ">
					Profile
				</div>
			</div>
		</a>
		
		<?php if($isAgent):?>
		<a href="pending_item/listing">
			<div class="menu-item-container <?php if($dashboard_page=="pending_item") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons sales-lead"></div></div>
				<div class="menu-item ">
					Sales Lead
				</div>
			</div>
		</a>
		<?php endif?>
		
		<a href="posting/view">
			<div class="menu-item-container <?php if($dashboard_page=="posting") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons postings"></div></div>
				<div class="menu-item">
					Posting
				</div>
			</div>
		</a>
		
		
		
		<a href="settings">
			<div class="menu-item-container <?php if($dashboard_page=="settings") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons settings"></div></div>
				<div class="menu-item ">
					Settings
				</div>
			</div>
		</a>
		
		<a href="shortlist/view">
			<div class="menu-item-container <?php if($dashboard_page=="shortlist") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons shortlist"></div></div>
				<div class="menu-item ">
					Shortlist
				</div>
			</div>
		</a>
		
		<a href="notification">
			<div class="menu-item-container <?php if($dashboard_page=="notification") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons notifications"></div></div>
				<div class="menu-item ">
					Notification
				</div>
			</div>
		</a>
		
		<div class="clear"></div>
	</div>
	
	<?php elseif($type=="smallscreen"):?>
	<div>
		<form>
			<div class="styled-select"> 
				<select class="form-control dashboard-menu-select" onchange="window.location=$(this).val()">
					<option value="activity" <?php if($dashboard_page=="home") echo "selected"?>>Activity</option>
					<?php if($isAgent):?>
					<option value="agent_comment/view" <?php if($dashboard_page=="agent_comment") echo "selected"?>>Review</option>
					<?php endif?>
					<option value="profile" <?php if($dashboard_page=="profile") echo "selected"?>>Profile</option>
					<?php if($isAgent):?>
					<option value="pending_item/listing" <?php if($dashboard_page=="pending_item") echo "selected"?>>Sales Lead</option>
					<?php endif?>
					<option value="posting/view" <?php if($dashboard_page=="posting") echo "selected"?>>Posting</option>
					<option value="settings" <?php if($dashboard_page=="settings") echo "selected"?>>Settings</option>
					<option value="shortlist/view" <?php if($dashboard_page=="shortlist") echo "selected"?>>Shortlist</option>
					<option value="notification" <?php if($dashboard_page=="notification") echo "selected"?>>Notification</option>
					
				</select>
			</div>
		</form>
	</div>
	
	<?php endif?>

<?php else:?>
	
	<?php if($type=="normal"):?>
	
	<div class="dashboard-menu">
		
		<?php if(is_verified_agent($user)):?>
		<a href="agent_comment/view/<?=$user->id?>">
			<div class="menu-item-container <?php if($dashboard_page=="agent_comment") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons profile"></div></div>
				<div class="menu-item ">
					Review
				</div>
			</div>
		</a>
		<?php endif?>
		
		
		<a href="activity/id/<?=$user->id?>">
			<div class="menu-item-container <?php if($dashboard_page=="home") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons activity"></div></div>
				<div class="menu-item ">
					Activity
				</div>
			</div>
		</a>
		
			
		<a href="posting/view/<?=$user->id?>">
			<div class="menu-item-container <?php if($dashboard_page=="posting") echo "selected"?>">
				<div class="menu-image-container"><div class="menu-image icons postings"></div></div>
				<div class="menu-item">
					Posting
				</div>
			</div>
		</a>
		
		
		<div class="clear"></div>
	</div>
	
	<?php elseif($type=="smallscreen"):?>
	<div>
		<form>
			<div class="styled-select"> 
				<select class="form-control dashboard-menu-select" onchange="window.location=$(this).val()">
					<?php if($isAgent):?>
					<option value="agent_comment/view/<?=$user->id?>" <?php if($dashboard_page=="agent_comment") echo "selected"?>>Review</option>
					<?php endif?>
					<option value="activity/id/<?=$user->id?>" <?php if($dashboard_page=="home") echo "selected"?>>Activity</option>
					<option value="posting/view/<?=$user->id?>" <?php if($dashboard_page=="posting") echo "selected"?>>Posting</option>

				</select>
			</div>
		</form>
	</div>
	
	<?php endif?>
	
		
	
<?php endif?>


