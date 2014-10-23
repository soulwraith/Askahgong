


<?php 
	$previous = array(
		 'My Posting' => 'posting/view',
		 $item->actiontext." ".$item->paddingnamewithareatoshow => "posting/edit/".$item->id
		);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Pick an agent'))?>

<div class="container PAGE_PENDING_ITEM">
	<div class="white-container pending-item-container">
		
		<div class="manage-controls">
					
			<a href="posting/edit/<?=$item->id?>" target="_blank">
				<div class="icons edit" data-toggle="tooltip" title="" data-original-title="Edit This Item">
				</div>
			</a>	
			
			<div class="icons delete" data-toggle="tooltip" title="Delete This Item" onclick="cancel_post_item()">
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-3 col-sm-4">
				<h4 style="margin-top:3px;">
					You need an agent
				</h4>
				<div class="introduction" style="color:#a7a7a7;">
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
			<div class="col-lg-9 col-sm-8">
				<h4 class="underline" style="margin-top:0px;">
					Your Property Details
				</h4>
				<div class="row details">
					
					
					
					
					<div class="col-lg-4 col-sm-12 col-md-4">
						<img alt="" class="img-responsive" src="<?=$item->firstFile?>">
					</div>
					
					<div class="margin-top hidden-md-lg">
						
					</div>
					
					<div class="col-lg-8 col-sm-12 col-md-8">
						<div class="overflow-ellipsis title">
							<a href="<?=$item->url?>" class="">
								<strong>
									<?=$item->actiontext?> <?=$item->paddingnamewithareatoshow?>
								</strong>
							</a>
						</div>
						
						<div class="row">
							<div class="col-lg-3 col-sm-4 sub-title col-xs-12">
								<span class="left">Selling price</span>
								<span class="right hidden-xs">:</span>
								<div class="clear"></div>
							</div>
							<div class="col-lg-9 col-sm-8 sub-content col-xs-12">
								<?=$item->pricetoshow?>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-lg-3 col-sm-4 sub-title col-xs-12">
								<span class="left">Built-up</span>
								<span class="right hidden-xs">:</span>
								<div class="clear"></div>
							</div>
							<div class="col-lg-9 col-sm-8 sub-content col-xs-12">
								<?=$item->builtuptoshow?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-3 col-sm-4 sub-title col-xs-12">
								<span class="left">Land area</span>
								<span class="right hidden-xs">:</span>
								<div class="clear"></div>
							</div>
							<div class="col-lg-9 col-sm-8 sub-content col-xs-12">
								<?=$item->land_areatoshow?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-3 col-sm-4 sub-title col-xs-12">
								<span class="left">Features</span>
								<span class="right hidden-xs">:</span>
								<div class="clear"></div>
							</div>
							<div class="col-lg-9 col-sm-8 sub-content col-xs-12">
								<?=$item->feature_comma_separated?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-3 col-sm-4 sub-title col-xs-12">
								<span class="left">Facilities</span>
								<span class="right hidden-xs">:</span>
								<div class="clear"></div>
							</div>
							<div class="col-lg-9 col-sm-8 sub-content col-xs-12">
								<?=$item->facility_comma_separated?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-3 col-sm-4 sub-title col-xs-12">
								<span class="left">Message</span>
								<span class="right hidden-xs">:</span>
								<div class="clear"></div>
							</div>
							<div class="col-lg-9 col-sm-8 sub-content col-xs-12">
								<?=cutofftext($item->descriptiontoshow,200)?>
							</div>
						</div>
						
					
						
						
						
					</div>
				</div>
				 
				
			</div>
		</div>
	</div>
	
	
	
	<div class="row margin-top">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<?=$this->load->view("layout_controls/agent_listing")?>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
			
			<div class="visible-xs margin-top">
				
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					<span class="pick-agent-message">
						
						
						<div class="red"><span class="label label-red"><i class="icon-agent vertical-top" style="font-size:17px;"></i> Agents <?=$propose_count?>/10</span> requested to be your agent for this transaction</div> 
						
						<div class="green" style="margin-top:10px;">You have invited <span class="label label-green"><i class="icon-agent vertical-top" style="font-size:17px;"></i> Agents <span class="agent-count"><?=$request_count?></span>/10</span> to represent you for this transaction</div>
						
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




