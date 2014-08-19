

<div class="pending-listing-container SUBPAGE_PENDING">
	<div class="header">
		Agent Request List
		<div class="right icons profile-icon">
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<h4>
				&bull; Request For You To Be Agent
			</h4>
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




