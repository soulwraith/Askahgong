

<div class="result-item-container">
	

<?php foreach($itemsdata as $item):?>
	<div class="row result-item-simple">
		
		<div class="col-xs-12 ">
			<div class="content">
				<div class="col-xs-3">
					<img class="img-responsive" src="<?=$item->firstFile?>">
				</div>
				<div class="col-xs-9">
					 <div>
					 	<strong>
					 		<a href="<?=$item->url?>" target="_blank"><?=$item->actiontext?> <?=$item->paddingname?> @ <?=$item->areanametoshow?></a>
					 	</strong>
					 </div>
					 <div class="text1">
					 	<?=$item->pricetoshow?> / <?=$item->sizetoshow?> 
					 </div>
					 <div class="text2">
					 	<?=$item->feature_comma_separated?>
					 </div>
					 
					 <div class="text4">
					 	<?php if($type=="askForAccept"):?>
					 		<span class="red">This user wants you to represent him/her in this transaction.</span>
					 	<?php else:?>
					 		<?=concat_if_plural("agent","s",$item->request_count)?> propose to represent for this property.
					 	<?php endif?>
					 </div>
					 
					 <div class="row">
					 	<div class="col-xs-9">
					 		 <div class="text3">
							 	<strong>Posted <?=ago($item-> posttime)?> by </strong><?=generate_username_control($item->userid,$item->username,true,$item->isonline,20)?>
							 </div>
					 	</div>
					 	<div class="col-xs-3">
					 		<?php if($type=="askForAccept"):?>
					 			<button type="button" onclick="accept_customer_request(this,<?=$item->userid?>,<?=$item->id?>)" class="btn btn-success btn-xs right">Accept</button>
					 			<span class="accepted green hidden-object right underline"><strong>Accepted</strong></span>
					 		<?php else:?>
					 			<?php if($item->request_count>=10):?>
					 				<span class="red right underline"><strong>Full</strong></span>
					 			<?php elseif($item->my_agent_request>0):?>
					 				<span class="blue right underline"><strong>Proposed</strong></span>
					 			<?php else:?>
					 				<button type="button" onclick="propose_to_customer(this,<?=$item->id?>,<?=$item->userid?>)" class="btn btn-primary btn-xs right">Propose</button>
					 			<?php endif?>	
					 		<?php endif?>
					 	</div>
					 </div>
					 
					
					 
					 
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	
<?php endforeach?>
</div>


<?php if(count($itemsdata)==0):?>
	<div class="col-xs-12">
		No request available at this moment.
	</div>
<?php else:?>
	<?php if(!empty($pagination)):?>
	<div class="row">
		<div class="col-xs-12 text-center page-links" style="margin-top:20px;">
			<?php echo $pagination; ?>
		</div>
	</div>	
	<?php endif?>
	
	<div class="col-xs-12 text-center" style="margin-top:20px;">
		<?= $this->load->view("user_controls/results_count",Array("start"=>$start,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>"Item"));?>
	</div>
	
	
<?php endif?>	



	
