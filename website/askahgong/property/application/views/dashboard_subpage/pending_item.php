

<div class="pending-listing-container SUBPAGE_PENDING">
	<div class="header">
		My Sales Lead
		<div class="right icons sales-lead-icon">
		</div>
	</div>
	
	<div class="row margin-top">
		<div class="col-xs-12">
			
			
			<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"info",
					"alert_html"=>'Here are requests from users for you to represent them as their agent. 
								<br>
								Keep that reputation score up for more requests! '))
				?>
			
			

		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<h5>
				Request(s) For You To Be Their Agent
			</h5>
		</div>
	</div>
	
	
	
	<div class="result-items-container">
		<?php $data["type"] = "askForAccept"?>
		<?php $data["itemsdata"] = $waitingResponseItemsData?>
		<?php $data["start"] = $start?>
		<?php $data["limit"] = $limit?>
		<?php $data["totalcount"] = $waitingResponseCount?>
		<?php $data["pagination"] = $pagination2?>
		<?=$this->load->view("layout_controls/result_item_sales_lead",$data)?>
		
		
		
		
		
		
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="separator">
				<img class="discussion-shadow bottom" src="image/discussion_shadow_bottom.png">
			</div>
			
		</div>
	</div>
	
	<div class="row margin-top">
		<div class="col-xs-12">
			
			
			<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"info",
					"alert_html"=>'You can request to be a user\'s agent here, but take note maximum 10 agent requests for each sales item each time. 
									So be fast and only target those within your expertise. '))
				?>
			
			

		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="pending-container">
				<h5>
					 All Sales Leads
				</h5>
			</div>
			
		</div>
	</div>
	
	
	
	<div class="result-items-container">
		<?php $data["type"] = "normal"?>
		<?php $data["itemsdata"] = $itemsdata?>
		<?php $data["start"] = $start?>
		<?php $data["limit"] = $limit?>
		<?php $data["totalcount"] = $pendingCount?>
		<?php $data["pagination"] = $pagination?>
		<?=$this->load->view("layout_controls/result_item_sales_lead",$data)?>
	</div>
	
	
	
</div>




