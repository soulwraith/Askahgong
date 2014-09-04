


<?php 
	$previous = array(
		 'My Posting' => 'posting/view',
		 $item->actiontext." ".$item->paddingnamewithareatoshow => "item/id/".$item->id
		);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Pick an agent'))?>

<div class="container">
	<div class="white-container pending-item-container">
		<div class="row">
			<div class="col-lg-4">
				<h4 style="margin-top:0px;">
					You need an agent
				</h4>
				<div>
				Your are seeing this because you have no agent representative. 
				We want you to be represented by an agent when you are selling your properties, as there are many pitfalls that you can avoid by being represented by a professional. 
				<br><br>
				You can use the listing below to, 
				<br><br>
				<ol>
					<li>
							Accept an agent's request to represent your item of sale
					</li>
					<li>
							Request an agent to represent you
					</li>
				</ol>
			
				<br>
				
				</div>
			</div>
			<div class="col-lg-8">
				<h4 style="margin-top:0px;">
					Your Property Details
				</h4>
				<div class="row">
					
					<div class="col-lg-5">
						<img alt="" class="img-responsive" src="<?=$item->firstFile?>">
					</div>
					<div class="col-lg-7">
						<div>
							<h5 class="underline" style="color:rgb(138, 135, 135)">
								<?=$item->actiontext?> <?=$item->paddingnamewithareatoshow?>
							</h5>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">
								<strong>Price:</strong>
							</div>
							<div class="col-lg-8">
								<?=$item->pricetoshow?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">
								<strong>Built-up:</strong>
							</div>
							<div class="col-lg-8">
								<?=$item->builtuptoshow?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">
								<strong>Land area:</strong>
							</div>
							<div class="col-lg-8">
								<?=$item->land_areatoshow?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">
								<strong>Features:</strong>
							</div>
							<div class="col-lg-8">
								<?=$item->feature_comma_separated?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">
								<strong>Facilities:</strong>
							</div>
							<div class="col-lg-8">
								<?=$item->facility_comma_separated?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">
								<strong>User Message:</strong>
							</div>
							<div class="col-lg-8">
								<?=cutofftext($item->descriptiontoshow,200)?>
							</div>
						</div>
						
						<div class="row margin-top">
							<div class="col-lg-12 text-center">
								<a class="btn btn-amber" href="posting/edit/<?=$item->id?>">Edit Post</a>
								<button class="btn btn-amber" onclick="cancel_post_item()">Cancel Post</button>
							</div>
						</div>
						
					</div>
				</div>
				 
				
			</div>
		</div>
	</div>
	
	
	
	<div class="row margin-top">
		<div class="col-lg-3">
			<?=$this->load->view("layout_controls/agent_listing")?>
		</div>
		<div class="col-lg-9">
			
			
			<div class="row">
				<div class="col-xs-12">
					<span class="pick-agent-message">
						<span class="red"><?=concat_if_plural("agent","s",$propose_count)?> requested to be your agent</span> /
						<?php if($request_count<10):?>
						<span class="green">You can still invite <span class="agent-count"><?=concat_if_plural("agent","s",10-$request_count)?></span> to represent you. </span>
						<?php endif?>
						<span class="green <?php if($request_count<10) echo "hidden-object"?> full-agent-request">No more agent request allowed.</span>
					</span>
				</div>
			</div>
			
			<div class="agent-details-container margin-top">
				
			</div>
		</div>
	</div>
	
	
	
	
	
	
</div>

<script type="text/javascript">
	var PAGE_ITEM_ID = <?=$item->id?>;
</script>




