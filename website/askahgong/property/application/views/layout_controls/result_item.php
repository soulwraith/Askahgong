
<div class="row">
	<div class="col-xs-12">
		<div class="result-item"  itemid="<?=$item->id?>">
			
			<?php if($item->pending=="1"):?>
				<a target="blank" href="pending_item/id/<?=$item->id?>">
					<div class="pending-overlay">
							<img src="image/pending.png" class="full-width vertical-center">
					</div>
				</a>
			<?php elseif($item->removed=="1"):?>
				<a target="blank" href="<?=$item->url?>">
					<div class="pending-overlay">
							<img src="image/deleted.png" class="full-width vertical-center">
					</div>
				</a>
			
			<?php endif?>	
			
			
			
			<?php if(isset($counter)):?>
				<div class="visible-lg">
					<div class="icons counter">
						<?=$counter?>
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
					<div class="loading-dot">
						
					</div>
				</div>
			<?php endif?>	
				
			<?php if(isset($item->userid) && $item->userid==get_userid()) $type="own"?>
			<?php if(isset($type) && $type=="own"):?>
				<div class="manage-controls">
					
					<a href ="posting/edit/<?=$item->id?>" target="_blank">
						<div class="icons edit" data-toggle="tooltip" title="Edit This Item">
						</div>
					</a>	
					
					<div class="icons delete" data-toggle="tooltip" title="Delete This Item" onclick="delete_item(<?=$item->id?>)">
					</div>
				</div>	
			<?php else:?>
				<div class="manage-controls" style="width:70px;">
					
					<div class="icons <?php if($item->isshortlist) echo "shortlisted"; else echo "not-shortlisted"?>" onclick="handle_shortlist(this,<?=$item->id?>)">
						
					</div>
	     	  	</div>	
				
			
			<?php endif?>
			
			<div class="visible-xs col-xs-12 small-screen">
				<div class="row">
					<div class="left" style="padding:0px 15px;">
						<img class="img-responsive" src="<?=get_user_profile_pic($item->userid)?>" style="max-height:40px;">
					</div>
					<div class="left" style="padding-top:3px;">
						<div class="row">
							<div class="col-xs-12">
								<strong><?=generate_username_control($item->userid,$item->username,false,$item->isonline,10)?> </strong>
								<span>posted this item</span>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 posttime" style="color:#B4B4B4;">
								<em><?=ago($item-> posttime)?></em>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="hidden-xs col-xs-12 col-sm-5 col-md-4 col-lg-5 position-relative text-center img-container-parent" style="padding:15px 15px 0px 15px;">
				<div class="top-img-container">
			
					<div class="img-container">
						<a href="<?=$item->url?>" target="_blank">
							
							<?php 	
									$image_type="";
									if($item->hasFile){
												
										list($width, $height, $image_type, $attr) = getimagesize($item->firstFile);
										
										if($width>$height){
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
						
							<img alt="" class="picture img-responsive <?=$image_type?>" src="<?=$item->firstFile?>">
							
						</a>
					</div>
						
				</div>
				<?php if($item->type==0 && count($item->filearr)>0):?>
				<div class="total-photo">
					<div class="inner-text">
					Total <?=concat_if_plural(" photo","s",count($item->filearr))?> 
					</div>
				</div>		
				<?php endif?>
			</div>
			<div class="col-sm-7 col-md-8 col-lg-7 col-xs-12 details-container" style="padding-right:0px;padding-left:0px;">
					<div class="row">
					
					<div class="col-xs-12 col-sm-12">
						<div class="title overflow-ellipsis">
							
							<a href="<?=$item->url?>" target="_blank"><?=$item->actiontext?> <?=$item->paddingname?></a>
						</div>
						<div class="sub-title overflow-ellipsis">
							<?=$item->areanametoshow?>
						</div>
						<div class="details overflow-ellipsis">
							<strong>&#x25cf;&nbsp;<?php if($item->type==0) echo "Selling Price"; else echo "Buying Budget"?>:&nbsp;&nbsp;&nbsp;&nbsp;</strong>
							<span class="price"><?=$item->pricetoshow?></span>
						</div>
					</div>
					<div class="clear"></div>
					
					
					<div class="col-xs-12 col-sm-12">
						<div class="details overflow-ellipsis" style="padding-top:1px;">
							<strong>&#x25cf;<?php if($item->type==1) echo "Req. "?>
								<?php if($item->builtup!="" || ($item->builtup=="" && $item->land_area=="")):?>
								Built-up:
								<?php else:?>
								Land area:
								<?php endif?>
								&nbsp;&nbsp;&nbsp;&nbsp;
							</strong>
							<span>
								<?=$item->sizetoshow?> 
								<?php if($item->builtup!=""):?>
								(<?=$item->psftoshow?>)
								<?php endif?>
							</span>
						</div>
					</div>
	
															
					<div class="clear"></div>
					<div class="col-xs-12 col-md-12">
						
						<?php 
							$hasfeature=false;
							$hasfacility=false;
						
							foreach($item->allfeatures as $key => $value){
								if($value=="1"){
									$hasfeature=true;
								}
								else if($value=="2"){
									$hasfacility=true;
								}
								
							}
							
							
						?>
							
							
						
						
						<div class="features lightorange">
							<?php if(!$hasfeature):?>
								<span class="no-item">
								<?php if($item->type==1):?>
									No request on facility
								<?php else:?>
									No feature specified
								<?php endif?>	
								</span>
							<?php endif?>
							
							<?php if(isset($item->allfeatures)):?>
								<?php foreach($item->allfeatures as $key => $value):?>
									<?php if($value=="1"):?>
										<div class="item">
											<?=$key?>
										</div>
									<?php endif?>
								<?php endforeach?>	
							<?php endif?>
							
							
								
							<div class="clear"></div>
						</div>
						
						
						
						<div class="features darkorange">
							
							<?php if(!$hasfacility):?>
								<span class="no-item">
								<?php if($item->type==1):?>
									No request on feature
								<?php else:?>
									No facility specified
								<?php endif?>	
								
								</span>
							<?php endif?>
							
							<?php if(isset($item->allfeatures)):?>
								<?php foreach($item->allfeatures as $key => $value):?>
									<?php if($value=="2"):?>
										<div class="item">
											<?=$key?>
										</div>
									<?php endif?>
								<?php endforeach?>	
							<?php endif?>
							<div class="clear"></div>
						</div>
						
						
						<div class="usermessage hidden-xs">
							<div class="left icons left-quote">
								
							</div>
							<div class="col-xs-9 overflow-ellipsis" style="padding:8px 2px 0px 2px;">
								<?=$item-> description_original?>
							</div>
							<div class="right icons right-quote">
								
							</div>
							<div class="clear"></div>
						</div>
						
						
						<div class="usermessage-small-screen visible-xs">
							<div class="col-xs-12">
								<?=cutofftext($item-> description_original,180,"...")?>
							</div>
								
						
						</div>
						
						<div class="photo-small-screen visible-xs">
							<div class="col-xs-12 text-center">
								<img class="img-responsive" src="<?=$item->firstFile?>">
							</div>
							<div class="col-xs-12 text-center">
								<?php if($item->type==0 && count($item->filearr)>0):?>
										<strong>Total <?=concat_if_plural(" photo","s",count($item->filearr))?> </strong>
								<?php endif?>
							</div>	
						
						</div>
						
						<a>
							<div class="tail-bar-small-screen visible-xs border-radius-bottomhalf">
								<div class="col-xs-12 text-center">
									<a href="<?=$item->url?>" target="_blank">
										Read More
									</a>
									
								</div>
								
							
							</div>
						</a>
						
						<div class="tail-bar hidden-xs">
							<div class="posttime col-sm-9 col-xs-12 overflow-ellipsis">
								<?php if(!empty($item->original_ownerid)):?>
									Took over
								<?php else:?>
									Posted
								<?php endif?>
								
								<?php
									$append_username=""; 
									if($item->canseephone){
										$append_username = "(+".$item->phone.")";
									}
								?>
								<?=ago($item-> posttime)?> by <?=generate_username_control($item->userid,$item->username,true,$item->isonline,20,false,false,false,$append_username)?>
								
							</div>
							<div class="col-sm-3 col-xs-12 buttons" style="padding-right:0px;padding-bottom:5px;">
								
								<a href="<?=$item->url?>" target="_blank">
									<button class="btn btn-light-grey right switching">
										<div class="text-to-switch">Read More</div>
										<div class="readmore icons image-to-switch"></div>
									</button>
								</a>
							</div>							
							<div class="clear"></div>
						</div>
					</div>
					</div>
			</div>
			
			<img class="hidden-xs" src="image/right_shadow.png" style="position:absolute;right:-10px;width:10px;height:100%;">
			<div class="clear"></div>
		</div>
	</div>
	
	
</div>


<script type="text/javascript">
	JQUERY_CALLBACK.push(function(){
		house_keeping_item($.parseJSON('<?=addslashes(json_encode($item))?>'));
	})
	
</script>



