


<?php 
	$previous = array();
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Pick agent'))?>

<div class="container">
	<div class="white-container">
		<div class="row">
			<div class="col-lg-4">
				<h4 style="margin-top:0px;">
					You need an agent
				</h4>
				<div>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
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
								<strong>Features:</strong>
							</div>
							<div class="col-lg-8">
								<?=$item->feature_comma_separated?>
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
						<span class="green">You can still request <span class="agent-count"><?=concat_if_plural("agent","s",10-$request_count)?></span> to be your agent. </span>
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




