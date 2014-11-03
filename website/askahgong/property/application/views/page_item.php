<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAzjElo8TqEjCpH3jQrYCi8DP_kWNPhQWQ&libraries=places&sensor=true" type="text/javascript"></script>




<?php if($item->userid==get_userid()):?>
<?php 
	$previous = array(
	 'My Posting' => 'posting/view'
	);?>
<?php else:?>
<?php
	$previous = array(
	 $user->username.'&apos;s Posting' => 'posting/view/'.$item->userid
	);?>
<?php endif?>
<?=$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>$item->actiontext." ".$item->paddingnamewithareatoshow))?>

<?php if($item->userid==get_userid()) $type="own"; else $type="other";?>

<div class="container margin-top PAGE_ITEM">
	
	<?php if($item->removed):?>
		<div class="item-removed col-xs-12">
			<img src="image/removeditem.png" class="img-responsive inline-block">
		</div>
	<?php endif?>
	<div class="row">
		<?php if($type=="other" && $item->pending==0):?>
		<div class="shortlist-button-container visible-lg">
			<div class="<?php if($item->isshortlist) echo "shortlisted"; else echo "not-shortlisted"?> icons hide-overflow-tooltip" onclick="handle_shortlist(this,<?=$item->id?>)">
				
			</div>
		</div>
		<?php endif?>
		
		
		<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12" style="position:static">
			<div class="buttons-container">
				<?php if($type=="own"):?>
					<div class="row">
						<div class="col-lg-12">
							<div class="grey-bg padding-equal col-lg-6">
								<button class="btn-amber btn btn-block bold" onclick="edit_item(<?=$item->id?>)">
									Edit <span class="visible-inline-xs">This Posting</span>
								</button>
							</div>
							<div class="grey-bg padding-equal col-lg-6">
								<button class="btn-amber btn btn-block bold" onclick="delete_item(<?=$item->id?>)">
									Delete <span class="visible-inline-xs">This Posting</span>
								</button>
							</div>
						</div>
					</div>
				<?php else:?>
					<?php if($item->pending==0):?>
					<div class="row margin-bottom hidden-lg">
						<div class="col-xs-12">
							<div class="grey-bg padding-equal">
								<button class="btn-amber btn btn-block bold <?php if($item->isshortlist) echo "shortlisted"; else echo "not-shortlisted"?>" onclick="handle_shortlist(this,<?=$item->id?>)">
									<span class="shortlisted-text <?php if(!$item->isshortlist) echo "hidden-object"?>">UnShortlist <span class="visible-inline-xs">This Posting</span></span>
									<span class="not-shortlisted-text <?php if($item->isshortlist) echo "hidden-object"?>">Shortlist <span class="visible-inline-xs">This Posting</span></span>
								</button>
							</div>
							
						</div>
						
					</div>
					<?php endif?>
				
				<?php endif?>
			</div>	
			<?php if(!empty($item->original_ownerid) && ($item->original_ownerid==get_userid() || $item->userid==get_userid())):?>
			<div class="row">
				<div class="col-xs-12">
					<div class="grey-box original-owner">
						<strong>Property owner</strong> : <?=generate_username_control($item->original_ownerid,$item->original_ownerusername,true)?> 
					</div>
				</div>
				
			</div>
			<?php endif?>
			
			<div class="row">
				<div class="col-lg-12" style="position:static">
					<div class="section-fixed <?=$type?>">
						
						<?php if($item->pending==1 && $item->removed==0):?>
							
							<?php 
								$html = "<strong>The seller is looking for an agent!</strong><br>";	
								
								if($item->owner_agent_request>0){
									$html .= "Property owner wants you to represent him/her in this transaction.";
								}
								else{
									$html .= '<span class="label label-green" style="font-size:0.85em;"><i class="icon-agent vertical-middle" style="font-size:15px;"></i> Agents ('.$item->request_count.'/10)</span>
							 		     propose to represent for this property. Submit your proposal now to request to represent his/her in this txn.';
								}
								
								$html .= "<div class='action'>";
								
								if($item->my_agent_request>0){
									$html .= '<div class="green vertical-center"><strong><i class="icon-tick"></i><br>Proposed</strong></div>';
								}
								else if($item->agent_reject_request>0){
									$html .= '<div class="red vertical-center"><strong><i class="icon-cross"></i><br>Declined</strong></div>';
								}
								else if($item->owner_agent_request>0){
									$html .= '<div class="vertical-center buttons">
												<div class="padding-equal grey-bg">
													<button type="button" onclick="accept_customer_request(this,'.$item->userid.','.$item->id.',true)" class="btn btn-green">Accept</button>
												</div>
												
												<div class="padding-equal grey-bg">
													<button type="button" onclick="reject_customer_request(this,'.$item->id.',true)" class="btn btn-red">Decline</button>
													
												</div>
											 </div>';
								}
								elseif($item->request_count<10){
									$html .= '<div class="padding-equal grey-bg"><button type="button" onclick="propose_to_customer(this,'.$item->id.','.$item->userid.',true)" class="btn btn-green">Propose</button></div>';
								}
								else{
									$html .= '<div class="red vertical-center"><strong><i class="icon-full"></i><br>Full</strong></div>';
								}
								
								$html .= "</div>";
								
							?>
							
							
							<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"success","no_icon"=>"true",
								"alert_html"=>$html))
							?>
							
							
						
							
						<?php endif?>	
						
						<?=$this->load->view("layout_controls/dashboard_details",array("in_page"=>"item"))?>
					</div>
					
				</div>
				
			</div>
			
			<div class="clear"></div>
			
			<?php if($type=="own"):?>
			<div class="row margin-top hidden-xs" style="margin-top:40px;">
				<div class="col-lg-12" style="position:static">
					<div class="grey-box items-matched" style="position:static">
						<div class="header">
							Items That Matched This Posting
						</div>
						
						<div class="fade-separator">
							<img class="fade-shadow" src="image/discussion_shadow_top.png">
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="item-listing-vertical-container matched-post">
									<img class="margin-left" src="image/loading3.gif"/>
								</div>
								<div class="load-more" style="position:absolute;left:90px;" onclick="scroll_to_similar_items();">
									View Similar Items
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif?>
		</div>
		
		
		<div class="col-lg-9 item-details col-md-8 col-sm-7 col-xs-12">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="main-title">
						<div class="icons action-image <?php if($item->type==1) echo "buy"?> col-lg-3 col-md-3 col-sm-4 col-xs-4">
							
						</div>
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 title">
							<?=$item->paddingnamewithareatoshow?>
						</div>
					</h2>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-6 img-container image-carousel col-xs-12">
					
					
						<img class="photo img-responsive <?php if(!$item->hasFile) echo "default"?>" src="<?=$item->firstFile?>">
						
						<?php if(count($item->filearr)>0):?>
									
						<div class="prev-button icons" onclick="move_slider_next_prev('prev')">
							
						</div>
						<div class="next-button icons" onclick="move_slider_next_prev('next')">
							
						</div>	
							
						<div class="img-slider transition">
							<div class="col-lg-1 white-box col-sm-1 col-xs-2 text-center pointer-cursor"  onclick="move_slider_next_prev('prev')">
								<div class="icons prev">
									
								</div>
								<div class="shadow-left icons">
									
								</div>
							</div>
							<div class="content col-sm-10 col-xs-8" style="overflow:hidden;">
								
								<div class="scroll" style="width:9999px;">
									
									
									<?php $index=0?>
									<?php foreach($item->thumbarr as $file):?>
										<div class="col-lg-1 col-sm-1 col-xs-1 pic white-box has-pic <?php if($index==0) echo "selected"?>">
											<img class="img-responsive" src="<?=$file?>" onclick="photo_clicked(this)">
											<div class="preview-pic">
							 					<img class="img-responsive" src="<?=$file?>" onclick="photo_clicked(this)">
											</div>	
										</div>
										<?php $index++?>
									<?php endforeach?>
									<?php for($i = $index ; $i<=10 ; $i++):?>
										<div class="col-xs-1 white-box pic">
										</div>	
									<?php endfor?>	
								</div>
							</div>
							
						
							<div class="col-lg-1 white-box col-sm-1 col-xs-2 text-center pointer-cursor" onclick="move_slider_next_prev('next')">
								<div class="icons next" >
									
								</div>
								<div class="shadow-right icons">
									
								</div>
							</div>
						</div>
						<?php endif?>
					</div>
				</div>
				
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 main-details-container">
					<div class="">
						<div class="main-details">
							<div class="details-title col-lg-4 col-md-5 col-sm-4 col-xs-12">
								<?php if($item->type==0):?>
								Price
								<?php else:?>
								Budget
								<?php endif?>	
							</div>
							<div class="details-content col-lg-8 col-md-7 col-sm-8 col-xs-12">
								<?=$item->pricetoshow?>
							</div>
						</div>
						<div class="main-details white <?php if($item->builtup!="") echo "two-line"?>">

							<div class="details-title col-lg-4 col-md-5 col-sm-4 col-xs-12">
								<?php if($item->type==1) echo "Req."?> Built-up

							</div>
							<div class="details-content col-lg-8 col-md-7 col-sm-8 col-xs-12">
								<?php if($item->builtup!=""):?>
								<?=$item->builtuptoshow?>
								<?php else:?>
									<small><small><?=$item->builtuptoshow?></small></small>
								<?php endif?>
								<?php if($item->builtup!=""):?>
								<br>
								<?=$item->psftoshow?>
								<?php endif?>
							</div>
						</div>
						
						<div class="main-details">

							<div class="details-title col-lg-4 col-md-5 col-sm-4 col-xs-12">
								<?php if($item->type==1) echo "Req."?> Land area

							</div>
							<div class="details-content col-lg-8 col-md-7 col-sm-8 col-xs-12">
								<?php if($item->land_area!=""):?>
									<?=$item->land_area_texttoshow?>
								<?php else:?>
									<small><small><?=$item->land_areatoshow?></small></small>
								<?php endif?>
							
							</div>
						</div>
						
						
						<div class="main-details white">
							<div class="details-title col-lg-4 col-md-5 col-sm-4 col-xs-12">
								View(s)
							</div>
							<div class="details-content col-lg-8 col-md-7 col-sm-8 col-xs-12">
								<?=$item->viewscounter?>
								 <i class="icons views-icon" data-toggle="tooltip" title="<?=$item->viewscounter?> people have shown an interest by viewing this page"></i>
							</div>
						</div>
						<div class="main-details two-line">
							<div class="details-title col-lg-4 col-md-5 col-sm-4 col-xs-12">
								Post Time
							</div>
							
							<div class="details-content col-lg-8 col-md-7 col-sm-8 col-xs-12">
								<?=preg_replace('/ /',' &nbsp;',convert_date_to_asia_format($item->posttime),1)?>
								<br>
								(<?=ago($item->posttime)?>)
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="secondary-details-container col-lg-12">
					<div class="secondary-details first">
						<div class="col-lg-2 details-title features col-md-4 col-xs-12">
							<?php if($item->type==1) echo "Req."?> FEATURES
							<div class="title-bg icons">
								
							</div>
						</div>
					
						<div class="col-lg-10 details-content features col-md-8 col-xs-12">
							<?php $hasfeature=false?>
							<?php foreach($item->allfeatures as $key=>$value):?>
								<?php if($value=="1"):?>
									<div class="token">
										<?=$key?>
									</div>
									<?php $hasfeature=true?>
								<?php endif?>
							<?php endforeach?>
							
							<?php if(!$hasfeature):?>
								<div style="padding-top:20px;"><em>
								<?php if($item->type==1):?>
									No request on feature
								<?php else:?>
									No feature specified
								<?php endif?>	
								</em></div>
							<?php endif?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			
			<div class="row secondary-details-container">
				<div class="secondary-details col-lg-12">
					<div class="col-lg-2 details-title facilities  col-md-4 col-xs-12">
						<?php if($item->type==1) echo "Req."?> FACILITIES
						<div class="title-bg icons">
							
						</div>
					</div>
				
					<div class="col-lg-10 details-content facilities  col-md-8 col-xs-12">
						<?php $hasfacility=false?>
						<?php foreach($item->allfeatures as $key=>$value):?>
							<?php if($value=="2"):?>
								<div class="token">
									<?=$key?>
								</div>
								<?php $hasfacility=true?>
							<?php endif?>
						<?php endforeach?>
						
						<?php if(!$hasfacility):?>
							<div style="padding-top:20px;"><em>
							<?php if($item->type==1):?>
								No request on facility
							<?php else:?>
								No facility specified
							<?php endif?>	
							</em></div>
							
						<?php endif?>
						
						
					</div>
					
									
					<div class="clear"></div>
				</div>
				
			</div>
			
			<div class="row secondary-details-container">
				<div class="secondary-details col-lg-12">
					<div class="col-lg-2 details-title message col-md-4 col-xs-12">
						USER MESSAGE
						<div class="title-bg icons">
							
						</div>
					</div>
				
					<div class="col-lg-10 details-content message col-md-8 col-xs-12">
						<span><?=$item->descriptiontoshow?></span>
					</div>
					
									
					<div class="clear"></div>
				</div>
				
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="maps-details-container">
		
						<div class="maps-details border-radius">
					
							<div class="map-texture">
								<div class="row">
								   <div class="col-lg-12">
									<div class="col-lg-2 details-title col-md-4 col-xs-12">
										LOCATION
										<div class="title-bg icons">
									
										</div>
										<button data-toggle="tooltip" title="Deselect/Select any landmark on the map" style="background-color:white;" class="btn btn-trans btn-default landmark-filter right hidden-md-lg" onclick="toggle_landmark_filter();eventStopPropagation(event);"><i class="icons"></i>Landmark Filter</button>
									</div>
									<div class="col-lg-6 details-content col-md-5 col-xs-12">
										<a onclick="return_to_item_position()" href="javascript:void(0)"><?=$item->areanametoshow?></a>
									</div>
									<div class="col-lg-4 col-md-3">
										<button data-toggle="tooltip" title="Deselect/Select any landmark on the map" class="btn btn-trans btn-default landmark-filter right hidden-sm-xs" onclick="toggle_landmark_filter();eventStopPropagation(event);"><i class="icons"></i>Landmark Filter</button>
									</div>
									<div class="col-lg-12">
										<div class="col-lg-12 landmark-filter-container hidden-object" onclick="eventStopPropagation(event)">
										 <div class="title">Deselect any type of landmark you do not want to see on the map. </div>
										 <?php $categoryArr=array("Bank","Bill Payment","Government Agency","Other Government Agency","Police And Fire Station","Post Office","Clinic","Dental","Hospital","Spa And Massage Center","Golf Club Resort","Tourist Location","Entertainment Center","Small Entertainment Center","Luxury Hotel","Pharmacy","TCM","Church","Custom","Petrol Station","Bus Station","Bus Terminal","Railway Terminal","Highway","Kuil","Mosque","Temple","Academic Center","Kindergarten","School","College","Library","Gym And Fitness Center","Sport Center","Sports Complex","Fast Food","Food Place","Big Shopping Mall","Medium Shopping Mall","Small Shopping Mall","Big Convenience Store","Convenience Store","Market")?>  
		 							   	 <?php $categoryarr_sequence=array("Bank","Bill Payment","Government Agency","Other Government Agency","Police And Fire Station","Post Office","Clinic","Dental","Hospital","Pharmacy","TCM","Spa And Massage Center","Golf Club Resort","Tourist Location","Entertainment Center","Small Entertainment Center","Luxury Hotel","Custom","Petrol Station","Bus Station","Bus Terminal","Railway Terminal","Highway","Church","Kuil","Mosque","Temple","Academic Center","Kindergarten","School","College","Library","Gym And Fitness Center","Sport Center","Sports Complex","Fast Food","Food Place","Big Shopping Mall","Medium Shopping Mall","Small Shopping Mall","Big Convenience Store","Convenience Store","Market")?>
		 							     <?php $magic_number=Array("1"=>"9","2"=>"9","3"=>"9","4"=>"8","5"=>"8");?>
											
											
											<?php $x=0?>
											<?php foreach($magic_number as $key=>$value):?>
												<div class="landmark-column">
													<?php $z=0?>
													<?php for($x=$x;$x<=(count($categoryArr)-1);$x++):?>
														<?php if($z>=$value) break;?>
														<label>
															<div class="left landmark-icon">
																<img class="" src="image/map_icon/<?=strtolower($categoryArr[$x])?>_small.png">
																<div class="icons landmark-shadow"></div>
															</div>
															<input name="category" type="checkbox" value="<?=strtolower($categoryArr[$x])?>" checked> 
															<div class="category-text"><span><?=$categoryArr[$x]?></span></div>
															<div class="clear"></div>
														</label>
														<?php $z++?>
													 <?php endfor?>
												</div>
											<?php endforeach?>	
		 							   
		 							   
		 							   
		 							   
		 							  
										  <div class="hidden-md-lg" style="margin-top:32px;"></div>
										 	<button class="btn btn-trans first btn-default" onclick="$('input[name=category]').prop('checked', true);">Select All</button>
											 <button class="btn btn-trans btn-default" onclick="$('input[name=category]').prop('checked', false);">Clear All</button>
											 <button class="btn btn-dark-grey" onclick="close_landmark_filter();">CONFIRM</button>
			
										 
									  </div>
									</div>
									
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-lg-12 map-container">
									<div class="col-lg-12">
										<div id="googlemap" tabindex="-1">
						
										</div>
										<div class="getting-tag left bold">Getting tagging data...</div>
										<div class="show-all-tag">
											<span class="count">2139</span>
											<span>&nbsp; taggings not shown at this zoom level</span>
											<br>
											<a href="javascript:void(0)" onclick="fill_landmark(true)">Show All</a>
										</div>
										<div class="text-muted text-center">
											<em>
												Click Landmark To Get Direction
											</em>
										</div>
									</div>
									
								</div>
								
							</div>
							
							
							
							
						
						</div>
					</div>
				</div>
				
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-12">
						<div class="direction-container">
						
						</div>
					</div>
					
				</div>
			</div>

			<div class="row range-filter details-parent">
				<div class="col-lg-12">
					<div class="col-lg-12 map-texture filter-box border-radius" style="background-position:0px -200px;">
						
							<div class="row" onclick="toggle_details_expand_state(this);">
								<div data-placement="left" data-toggle="tooltip" title="Filter by distance to see the landmark near this property" class="col-lg-12 title-container pointer-cursor">
									<div class="col-lg-1 col-sm-2 col-md-1 col-xs-2">
										<div class="row">
											<i class="icons"></i>
										</div>
										
									</div>
									<div class="col-lg-8 col-sm-9 col-md-10 col-xs-9">
										<div class="row">
											<div class="title">Range Filter</div>
										</div>
										
									</div>
									
									<div class="col-lg-3 pull-right col-sm-1 col-md-1 col-xs-1" style="padding:0px;">
										<div class="icons expand-button transition right"></div>
									</div>
									  
								</div>
								
							</div>
							<div class="row">
								<div class="range-results-container details-container">
									
									
									
									<div class="col-lg-12 range-results">
										<div class="left margin-right bold" style="padding-top:8px;">
											Find landmarks within 
										</div>
										
										<div class="styled-select left" style="width:110px;">
											<select class="form-control" name="range" onchange="range_change(this)" onclick="eventStopPropagation(event)">
												<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;------</option>
												<option value="1">&nbsp;&nbsp;&nbsp;&nbsp;1 KM</option>
												<option value="2">&nbsp;&nbsp;&nbsp;2 KM</option>	
												<option value="3">&nbsp;&nbsp;&nbsp;3 KM</option>
												<option value="4">&nbsp;&nbsp;&nbsp;4 KM</option>
												<option value="5">&nbsp;&nbsp;&nbsp;5 KM</option>
												<option value="10">&nbsp;10 KM</option>
												<option value="15">&nbsp;15 KM</option>
												<option value="30">30 KM</option>
											</select>
										  </div>
										  <div class="clear"></div>	
											
										  <div class="content margin-top">
										  	
										  </div>
										  
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-12">
						<div class="range-result-details">
						
						</div>
					</div>
					
				</div>
			</div>
			
			
			<div class="row nearest-filter details-parent">
				<div class="col-lg-12">
					<div class="col-lg-12 map-texture filter-box border-radius" style="background-position:80px -100px;">
					
						<div class="row pointer-cursor" data-placement="left" data-toggle="tooltip" title="Find the nearest landmarks of this property" onclick="toggle_details_expand_state(this);">
							<div class="col-lg-12 title-container">
								
								<div class="col-lg-1 col-sm-2 col-md-1 col-xs-2">
									<div class="row">
										<i class="icons"></i>
									</div>
									
								</div>
								<div class="col-lg-5 col-sm-6 col-md-5 col-xs-7">
									<div class="row">
										<div class="title">Find Me Nearest</div>
									</div>
									
								</div>
								

								<div class="col-lg-5 pull-right col-sm-3 col-md-5 col-xs-1" style="padding:0px;">
									<div class="icons expand-button transition right"></div>
								</div>
								
								
								
							
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-12 nearest-container details-container">
								<div class="">
																		
									
									<?php $x=0?>
									<?php foreach($magic_number as $key=>$value):?>
										<div class="landmark-column">
											<?php $z=0?>
											<?php for($x=$x;$x<=(count($categoryArr)-1);$x++):?>
												<?php if($z>=$value) break;?>
												<label>
													<div class="left landmark-icon">
														<img class="" src="image/map_icon/<?=strtolower($categoryArr[$x])?>_small.png">
														<div class="icons landmark-shadow"></div>
													</div>
													<input name="nearest-category" type="checkbox" value="<?=strtolower($categoryArr[$x])?>"> 
													<div class="category-text"><span><?=$categoryArr[$x]?></span></div>
													<div class="clear"></div>
												</label>
												<?php $z++?>
											 <?php endfor?>
										</div>
									<?php endforeach?>	
									
								
									 
									 
									 
									 
									 
									 	 <div class="hidden-md-lg" style="margin-top:32px;"></div>
									 	 
									 	 	 <button class="btn btn-trans btn-default first" onclick="$('input[name=nearest-category]').prop('checked', true);">Select All</button>
											 <button class="btn btn-trans btn-default" onclick="$('input[name=nearest-category]').prop('checked', false);">Clear All</button>
											 <button class="btn btn-dark-grey" data-trigger="manual" data-container="body" onclick="find_nearest(this)">FIND</button>
									 	 
									 	
	
									 <div class="clear"></div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-12">
						<div class="nearest-result-details">
						
						</div>
					</div>
				</div>
			</div>
			
			
			
			<div class="row hidden-xs">
				<div class="col-lg-12">
					<div class="col-lg-12 similar-items-container">
						<div class="row similar-sell similar">
							<div class="col-lg-3 control-pane col-md-4 col-sm-6">
								<div class="">
									<span class="text1">SIMILAR ITEMS</span><br>
									<span class="text2">SELLING</span><br>
									<span class="text1">AT</span>
									
									<div class="option" onclick="show_related(this,'s_p')" data-placement="left" data-toggle="tooltip" title="List of items selling around the price of current property" >
										THIS PRICE <span class="count">(<span id="s_p"><?=$s_p?></span>)</span>
									</div>
									<div class="option" onclick="show_related(this,'s_a')" data-placement="left" data-toggle="tooltip" title="List of items selling and are located near this property">
										THIS AREA <span class="count">(<span id="s_a"><?=$s_a?></span>)</span>
									</div>
									<div class="option" onclick="show_related(this,'s_pa')" data-placement="left" data-toggle="tooltip" title="List of items selling around the price and are located near this property">
										THIS AREA + PRICE <span class="count">(<span id="s_pa"><?=$s_pa?></span>)</span>
									</div>
								</div>
								<div class="arrow">
									
								</div>
							</div>
							<div class="col-lg-9 result-pane col-md-8 col-sm-6">
								<div class="row">
									
								</div>
								<div class="prev icons" onclick="similar_items_move('sell','left')">
									
								</div>
								<div class="next icons" onclick="similar_items_move('sell','right')">
									
								</div>
							</div>
						</div>
						
						
						<div class="row margin-top similar-buy similar">
							<div class="col-lg-3 control-pane col-md-4 col-sm-6">
								<div class="">
									<span class="text1">SIMILAR ITEMS</span><br>
									<span class="text2">BUYING</span><br>
									<span class="text1">AT</span>
									
									<div class="option" onclick="show_related(this,'b_p')" data-placement="left" data-toggle="tooltip" title="List of items people are looking for around the price of the current property">
										THIS PRICE <span class="count">(<span id="b_p"><?=$b_p?></span>)</span>
									</div>
									<div class="option" onclick="show_related(this,'b_a')" data-placement="left" data-toggle="tooltip" title="List of items people are looking and are located near to current property">
										THIS AREA <span class="count">(<span id="b_a"><?=$b_a?></span>)</span>
									</div>
									<div class="option" onclick="show_related(this,'b_pa')" data-placement="left" data-toggle="tooltip" title="List of items people are looking for around the price and are located near to current property">
										THIS AREA + PRICE <span class="count">(<span id="b_pa"><?=$b_pa?></span>)</span>
									</div>
								</div>
								<div class="arrow">
									
								</div>
							</div>
							<div class="col-lg-9 result-pane col-md-8 col-sm-6">
								<div class="row">
									
								</div>
								<div class="prev icons" onclick="similar_items_move('buy','left')">
									
								</div>
								<div class="next icons" onclick="similar_items_move('buy','right')">
									
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			
			
			
			<div class="row">
				
				<div id="fb-root"></div>
				<script type="text/javascript">
				
					window.fbAsyncInit = function() {
					      FB.init({appId: '1519171354993947', status: true, cookie: true,
					               xfbml: true});
					};
					
					(function (d, s, id) {
					         var js, fjs = d.getElementsByTagName(s)[0];
					         if (d.getElementById(id)) return;
					         js = d.createElement(s); js.id = id;
					         js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
					         fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				
				</script>
				
				<div class="col-xs-12">
					<div class="fb-share-button right" data-href="<?=current_url()?>"></div>
				</div>
			</div>
			
			
			
		</div>
		
		
	</div>
	
</div>

<script type="text/javascript">

var PAGE_ITEM_onpage,
    PAGE_ITEM_category_arr,
    PAGE_ITEM_xhr=null,
    PAGE_ITEM_item_lastseen,
    PAGE_ITEM_processid,
    PAGE_ITEM_totalcount,
    PAGE_ITEM_current_name,
    PAGE_ITEM_current_category,
    PAGE_ITEM_latitude,
    PAGE_ITEM_longitude,
    PAGE_ITEM_type,
    PAGE_ITEM_dict,
    PAGE_ITEM_landmark_timer,
    PAGE_ITEM_range_xhr=null,
    PAGE_ITEM_nearest_xhr=null,
    PAGE_ITEM_related_xhr=null,
    PAGE_ITEM_current_landmark_id;
    PAGE_ITEM_deleted = false;


	PAGE_ITEM_onpage=true;
	PAGE_ITEM_category_arr=[];
	<?php foreach($categoryarr_sequence as $category):?>
		PAGE_ITEM_category_arr.push("<?=$category?>");
	<?php endforeach?>
	
	PAGE_ITEM_id="<?=$item->id?>";
	PAGE_ITEM_userid="<?=$item->userid?>";
	PAGE_ITEM_original_ownerid="<?=$item->original_ownerid?>";
	PAGE_ITEM_type="<?=$item->type?>";
	PAGE_ITEM_latitude="<?=$item->latitude?>";
	PAGE_ITEM_longitude="<?=$item->longitude?>";
	<?php if(isset($item_lastseen) && $item_lastseen!=""):?>
	PAGE_ITEM_item_lastseen="<?=strtotime($item_lastseen)?>";
    PAGE_ITEM_processid=<?=$processid?>;
    PAGE_ITEM_totalcount=<?=$totalcount?>;
    <?php endif?>
    <?php if($item->removed):?>
    PAGE_ITEM_deleted=true;
    <?php endif?>

</script>







