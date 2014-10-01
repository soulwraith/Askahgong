

<div class="result-item-container">
	

<?php foreach($itemsdata as $item):?>
	<div class="row result-item-simple">
		<div class="content">
			<div class="col-lg-10 col-md-10 col-xs-12 no-paddingright">
				<div class="row">
					 <div class="col-xs-4 no-paddingright">
						<div class="img-container ">
							<img class="img-responsive vertical-center" src="<?=$item->firstFile?>">
						</div>
						
					</div>
					
					<div class="col-xs-8 no-paddingleft">
						<div class="content-container">
							<img class="left-shadow hidden-xs" src="image/left_shadow.png">
							<div class="upper">
								<div class="overflow-ellipsis">
								 	<strong>
								 		<a href="<?=$item->url?>" target="_blank"><?=$item->actiontext?> <?=$item->paddingname?> @ <?=$item->areanametoshow?></a>
								 	</strong>
								 </div>
								 <div class="overflow-ellipsis">
								 	<?=$item->pricetoshow?> / <?=$item->sizetoshow?> 
								 </div>
								 <div class="feature-container">
								 	<em><?=cutofftext($item->feature_comma_separated,80)?></em>
								 </div>
							</div>
							
							<div class="overflow-ellipsis">
								<?php if($type=="askForAccept"):?>
							 		<span class="text2"><i class="icon-exclaimation"></i> This user wants you to represent him/her in this txn</span>
							 	<?php else:?>
							 		<span class="text4">
							 		     <span class="label label-green" style="font-size:0.85em;"><i class="icon-agent vertical-middle" style="font-size:15px;"></i> Agents (<?=$item->request_count?>/10)</span>
							 		     propose to represent for this property.
							 		</span>	
							 		
							 	<?php endif?>
							</div>
							 <div>
							 	<div class="text3 overflow-ellipsis">
								 	Posted <?=ago($item-> posttime)?> by <?=generate_username_control($item->userid,$item->username,true,$item->isonline,20)?>
								 </div>
							 </div>
						</div>
				</div>
				
			</div>
			
			
			</div>
			<div class="col-lg-2 col-md-2 col-xs-12 col-sm-3 button-container text-center" style="padding-left:5px;">
				<?php if($type=="askForAccept"):?>
					<div class="vertical-center buttons">
						<div class="padding-equal grey-bg">
							<button type="button" onclick="accept_customer_request(this,<?=$item->userid?>,<?=$item->id?>)" class="btn btn-green btn-block">Accept</button>
						</div>
						
						<div class="padding-equal grey-bg margin-top">
							<button type="button" onclick="reject_customer_request(this,<?=$item->id?>)" class="btn btn-red btn-block">Decline</button>
							
						</div>
					</div>
		 			
					
		 			<div class="accepted green hidden-object vertical-center"><strong><i class="icon-tick"></i><br>Accepted</strong></div>
		 			
		 			<div class="rejected red hidden-object vertical-center"><strong><i class="icon-cross"></i><br>Rejected</strong></div>
		 			
		 		<?php else:?>
		 			<?php if($item->request_count>=10):?>
		 				<div class="red vertical-center"><strong><i class="icon-full"></i><br>Full</strong></div>
		 			<?php elseif($item->my_agent_request>0):?>
		 				<div class="green vertical-center"><strong><i class="icon-tick"></i><br>Proposed</strong></div>
		 			<?php else:?>
		 			
		 				<div class="vertical-center buttons">
							<div class="padding-equal grey-bg">
								<button type="button" onclick="propose_to_customer(this,<?=$item->id?>,<?=$item->userid?>)" class="btn btn-green btn-block">Propose</button>
							</div>
						</div>
		 			
		 				
		 			<?php endif?>	
		 		<?php endif?>
			</div>
		</div>
	</div>
	
	<div class="row hidden-md-lg">
		<div class="col-xs-12" style="border:1px solid #CCC;margin-bottom:15px;">
			
		</div>
	</div>
	
<?php endforeach?>
</div>


<?php if(count($itemsdata)==0):?>
	<div class="row">
		<div class="col-xs-12">
			No request available at this moment.
		</div>
	</div>
	
<?php else:?>
	<?php if(!empty($pagination)):?>
	<div class="row">
		<div class="col-xs-12 text-center page-links" style="margin-top:15px;">
			<?php echo $pagination; ?>
		</div>
	</div>	
	<?php endif?>
	
	<div class="col-xs-12 text-center" style="margin-top:15px;">
		<?= $this->load->view("user_controls/results_count",Array("start"=>$start,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>"Item"));?>
	</div>
	
	
<?php endif?>	



	
