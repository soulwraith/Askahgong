

<div class="pending-listing-container SUBPAGE_PENDING">
	<div class="header">
		My Sales Lead
		<div class="right icons profile-icon">
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<h4>
				&bull; Request(s) For You To Be Their Agent
			</h4>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-warning">
				Here are requests from users for you to represent them as their agent. 
				<br>
				Keep that reputation score up for more requests! 
			</div>

		</div>
	</div>
	
	<div class="result-items-container">
		<?php $data["type"] = "askForAccept"?>
		<?php $data["itemsdata"] = $waitingResponseItemsData?>
		<?php $data["start"] = $start?>
		<?php $data["limit"] = $limit?>
		<?php $data["totalcount"] = $waitingResponseCount?>
		<?php $data["pagination"] = $pagination2?>
		<?=$this->load->view("layout_controls/result_item_simple",$data)?>
		
		
		
		
		
		
	</div>
	
	
	
	
	<div class="row">
		<div class="col-xs-12">
			<div class="pending-container">
				<h4>
					 &bull; All Requests
				</h4>
			</div>
			
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-warning">
				You can request to be a user's agent here, but take note maximum 10 agent requests for each sales item each time. 
				So be fast and only target those within your expertise. 
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
		<?=$this->load->view("layout_controls/result_item_simple",$data)?>
	</div>
	
	
	
</div>




