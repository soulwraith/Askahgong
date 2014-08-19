


<div class="dashboard-notifications-container SUBPAGE_NOTIFICATIONS">
	<div class="header">
		My Notification
		<div class="right icons notification-icon">
			
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			
			<h5 class="margin-top" style="padding-left:10px;">
				<span class="underline">New Notification(s)</span>
				<a href="about/title/website#faq-notification" target="_blank">
					<div class="icons question-hover" data-toggle="tooltip" title="Click to learn how notification mechanism works." data-placement="bottom">
					</div>
				</a>
			</h5>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<?php if(count($new_notifications)<=0):?>
					<div class="margin-bottom padding-left" style="padding-left:11px;"><em>No New Notification Found.</em></div>
			<?php endif?>	
			<?php foreach($new_notifications as $notification):?>
					<?=$this->load->view("layout_controls/notification_layout",Array("notification"=>$notification))?>
			<?php endforeach?>
		</div>
	</div>
	
	
	<div class="padding-equal grey-bg inline-block">
		<button class="btn btn-light-orange btn-lg btn-show-history" type="button" onclick="$('.notification-history').show();$(this).remove();">Show History</button>
	</div>

	<div class="notification-history hidden-object">
		<div class="row">
			<div class="col-xs-12">
				<h5 class="underline" style="padding-left:10px;">
					Notification History
				</h5>
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 history-notification-container">
				<?=$this->load->view("layout_controls/notification_ajaxpagination_listing")?>
			</div>
		</div>
	</div>
	
	
	
</div>




