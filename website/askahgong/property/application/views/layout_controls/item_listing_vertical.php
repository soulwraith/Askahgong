
<div class="item-listing-vertical">
	<div class="items">
		<?php if(count($itemsdata)<=0):?>
			<?php if(isset($itempage) && $itempage):?>
				
			
			<?=$this->load->view("layout_controls/no_result_info_text",Array("no_offset"=>true,"type"=>"no_item_matched"))?>
			
			<?php else:?>
			<div class="padding">
				<span class="small-font"><em>No item available.</em></span>
			</div>	
			<?php endif?>
		<?php endif?>
		
<?php foreach($itemsdata as $post):?>
	<?php $item_type=""?>
	<?php if(isset($user_lastseen)):?>
		<?php
			$post->posttime=try_convert_to_24_hr($post->posttime);
			$user_lastseen=try_convert_to_24_hr($user_lastseen);
			$datetime1 = new DateTime($user_lastseen); 
			$datetime2 = new DateTime($post->posttime); 
		?>
		
		<?php if($datetime1 < $datetime2):?>
			<?php $item_type="new"?>
		<?php endif?>
	<?php endif?>
	
	
	<div class="item-vertical <?=$item_type?>">
		
			<div class="image-container">
				
				<img src="<?=$post->firstFile?>"></img>
			
			</div>
			<div class="content-container">
				<div class="item-title">
					<a href="<?=$post->url?>" target="_blank"><?=$post->actiontext?> <?=$post->nametoshow?></a>
				</div>
				<div class="item-price">
					<?=$post->pricetoshow?>
				</div>
				<div class="item-area overflow-ellipsis">
					<?=str_replace(","," @ ",$post->areanametoshow)?>
				</div>
				<div class="item-meta">
					Posted <?=ago($post->posttime,true,true)?>
					
				</div>
				<div class="overflow-ellipsis item-username">
					<?=generate_username_control($post->userid,$post->username,true,$post->isonline,17)?>
				</div>
				
				<?php if($list_type=="popular"):?>
				<div class="item-views">
					<?=concat_if_plural(" View", "s", $post->viewscounter)?>
				</div>
				<?php endif?>
				
				<div class="read-more-container">
					<a class="btn btn-light-grey right switching btn-read-more" href="<?=$post->url?>" target="_blank">
						<div class="text-to-switch">Details</div>
						<div class="readmore icons image-to-switch"></div>
					</a>
				</div>
				
				
				
				
			</div>
			<div class="left">

				
				
				
			</div>
			<div class="clear"></div>
			<div class="fade-separator">
			
			</div>
			
		
			
			<div class="new-indicator icons">
			
			</div>
			
			
	  </div>
	
<?php endforeach?>
	</div>
</div>

<?php if(count($itemsdata)>0):?>
	<?php if(isset($setpagination) && $setpagination):?>
	<div class="paginations-container border-radius-bottomhalf ">
		<div class="text-center">
			
			<?php $totalpage=ceil(($totalcount)/$limit)?>
			<?php $currentpage=($start/$limit)+1?>
			<?php for($i=1;$i<=$totalpage;$i++):?>
				<div class="dot-paging icons <?php if($currentpage==$i) echo "selected"?>" onclick="change_page(this,'<?=$base_url.(($i-2)*$limit+$limit)?>')">
				
				</div>
			<?php endfor?>	
			
			
			
		</div>
	</div>
	<?php endif?>


<?php endif?>


