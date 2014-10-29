<!--notificaiton layout for all notifications popup (shortlist)!-->

<div class="notifications-listing">
	
		<?php foreach($itemsdata as $item):?>
			
			<?php $modified_type="";
				
				if($item->action_datetime>$item->shortlist_datetime){
					if(isset($item->modified_type)){
						if($item->modified_type=="editItem"){
							$modified_type="edit";
						}
					}
				}
				
				
				if(isset($item->modified_type)){
					if($item->modified_type=="deleteItem"){
						$modified_type="delete";
					}
						
				}
				
				
			
			?>
			
			
			<div class="notification-item <?=$modified_type?> <?php if($item->unread) echo "new"?>" >
				<a class="no-underline" href="<?=$item->url?>" target="_blank" onclick="close_all_topmenu_popup()">			
					<div class="img-container">
						<img class="img-responsive" src="<?=$item->firstFile?>">
					</div>
					
					<div class="content-container">
						<span class="text1"><?=$item->pricetoshow?></span>
						<br>
						<span class="text1"><?=$item->actiontext?> <?=$item->name?> @ <?=$item->areanameshort?></span>
						<br>
						<span class="text3">
								<?php if(!empty($item->original_ownerid)):?>
									Takenover
								<?php else:?>
									Posted
								<?php endif?>
								By <?=generate_username_control($item->userid,$item->username,true,$item->isonline,15,true)?></span>
						<div>
							<span class="text2">Shortlisted - <?=ago($item->shortlist_datetime,true,true)?></span>
							<div class="right icons delete-button shortlisted" data-toggle="tooltip" title="Delete From Shortlist" onclick="event.preventDefault();eventStopPropagation(event);handle_shortlist(this,<?=$item->id?>,$(this).parents('.notification-item'))">
								
							</div>
						</div>
						
					</div>	
				
					<div class="clear"></div>
							
						
						
					
					<div class="edit-indicator indicator icons" title="Edited <?=ago($item->action_datetime)?>"></div>
					
					<div class="delete-indicator indicator icons" title="Deleted <?=ago($item->action_datetime)?>"></div>
				</a>	
				<div class="fade-separator"></div>
			</div>
			
			
			
		<?php endforeach?>
		
		<?php if(count($itemsdata)<=0):?>
			<?php $data["type"] = "shortlist"?>
			<?=$this->load->view("layout_controls/popup_no_result",$data)?>
		<?php endif?>	
</div>
