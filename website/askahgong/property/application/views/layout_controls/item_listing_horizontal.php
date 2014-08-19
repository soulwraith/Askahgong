
<div class="col-lg-4 col-md-6 col-sm-12 result">
	<?php list($width, $height, $type, $attr) = getimagesize($item->firstFile);
		if($item->hasFile){
			if($width>=$height){
				$image_type="horizontal";
			} 
			else{
				$image_type="vertical";
			}
		}
		else{
			$image_type="default";
		}		
	?>
	<div class="image-container">
		<img class="img-responsive picture <?=$image_type?>" src="<?=$item->firstFile?>">
	</div>
	
	<div class="criteria">
		<?php if($item_type=="s_a" || $item_type=="b_a"):?>
			<div class="overflow-ellipsis">
				<?=$item->areanameshort?>
			</div>
		
		<?php elseif($item_type=="s_p" || $item_type=="b_p"):?>
			<div class="overflow-ellipsis">
				<?=$item->pricetoshow?>
			</div>
			
		<?php elseif($item_type=="s_pa" || $item_type=="b_pa"):?>
			<div class="overflow-ellipsis" style="padding-bottom:0px;">
				<?=$item->pricetoshow?>
			</div>
			<div class="overflow-ellipsis">
				<?=$item->areanameshort?>
			</div>
			
		<?php endif?>		
		
		
	</div>
	
	<div class="details overflow-ellipsis one">
		&#x25cf;&nbsp; <?=$item->actiontext." ".$item->name?>
	</div>
	<div class="details overflow-ellipsis two">
		&#x25cf;&nbsp; <?=str_replace(","," @ ",$item->areanametoshow)?>
	</div>
	<div class="details overflow-ellipsis three">
		&#x25cf;&nbsp; <?=$item->pricetoshow?>
	</div>
	<div class="details overflow-ellipsis four">
		&#x25cf;&nbsp; Posted <?=ago($item->posttime)?>
	</div>
	<div class="details overflow-ellipsis five">
		&#x25cf;&nbsp; By <?=cutofftext($item->username,12)?>
		<a class="btn btn-light-grey right switching btn-read-more" href="<?=$item->url?>" target="_blank">
			<div class="text-to-switch">Details</div>
			<div class="readmore icons image-to-switch"></div>
		</a>
	</div>
</div>




