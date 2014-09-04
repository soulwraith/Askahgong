<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAzjElo8TqEjCpH3jQrYCi8DP_kWNPhQWQ&libraries=places&sensor=true" type="text/javascript"></script>
<script src="javascript/infobox.js" type="text/javascript"></script>	






<?php 
	$previous = array();
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Search Your Interest'))?>

<?php 
	if(isset($_GET["pricemin"])) $_GET["pricemin"]=str_replace(",","",$_GET["pricemin"]);
	if(isset($_GET["pricemax"])) $_GET["pricemax"]=str_replace(",","",$_GET["pricemax"]);
	if(isset($_GET["builtup"])) $_GET["builtup"]=str_replace(",","",$_GET["builtup"]);



?>

<div class="">
	<div class="container margin-top PAGE_SEARCH">
		<form class="white-trans" id="searchform" name="searchform" searchtype="simple" onsubmit="return validate_search();" action="search" method="get">
		
				<div class="search-title left">
					You Want To
				</div>
				<div class="btn-actions search-action left">
					 <a href="javascript:void(0)" onclick="switch_type('buy')">
					  <div class="text-center icons buybutton actionbutton <?php if(((isset($_GET["action"]) && $_GET["action"]=="1"))||!isset($_GET["action"])) echo "selected"?>" data-toggle="tooltip" title="Searching For Properties">BUY</div>
					 </a>
					 <a href="javascript:void(0)" onclick="switch_type('sell')">
					  <div class="text-center icons sellbutton actionbutton <?php if((isset($_GET["action"]) && $_GET["action"]=="0")) echo "selected"?>" data-toggle="tooltip" title="Searching For Buying Requests">SELL</div>
					 </a> 
				</div>
				<input name="action" type="text" value="1" style="display:none;">
				
				<div class="visible-lg right icons postnow-button" data-toggle="tooltip" title="Post This Request With Current Criteria" onclick="post_now()">
					Post Now
				</div>
				<div class="clear"></div>
				
				<div class="row">
					<div class="col-lg-5 col-sm-12 primary">
						
						<div class="right-border visible-lg">
							
						</div>
						
						<input type="hidden" name="sorttype" value="<?php if(isset($_GET["sorttype"])) echo $_GET["sorttype"];?>">
						
						<div class="form-group">
					      <label for="input_area">Area</label>
					      <div class="icons question-hover" data-toggle="tooltip" title="You can specify further with road name, e.g. Jalan Merah" data-placement="right"></div>
					      <input class="form-control" id="input_area" type="text">
					    </div>
					    <div class="row">
					    	<div class="col-sm-6 col-xs-12" style="padding-right:0px">
					    		<div class="form-group">
							      <label for="itemname">Unit Type</label>
							      <div class="styled-select"> 
							      	<select id="itemname" name="itemname" class="selectpicker form-control">
										<?php foreach ($propertylist as $item):?>
											<?php 
												$fake_name=$item;
												if(strtolower($item)=="house"){
													$fake_name="All Properties";
												}
												else if(strtolower($item)=="semi detached house"){
													$fake_name="Semi-D";
												}
											?>
											<option value="<?=$item?>" <?php if(isset($_GET["itemname"]) && strtolower($_GET["itemname"])==strtolower($item)) echo "selected"?>><?=$fake_name?></option>
										
										<?php endforeach;?>							
									</select>	
							      </div>
							      
							      
							      
							    </div>
					    	</div>
					    	<div class="col-sm-6 col-xs-12" style="padding-left:3px">
					    		<div class="form-group">
							      <label for="size">Size(Sqft.)</label>
							      	<a href="about/title/website#faq-builtup" target="_blank">
				      					<div class="icons question-hover" data-toggle="tooltip" title="Click to learn about &apos;Built-up&apos;" data-placement="right">
				      					</div>
				      				</a>
							      <input class="number-only form-control watermark" mark="" type="text" autocomplete="off" name="builtup" value="<?php if(isset($_GET["builtup"])) echo $_GET["builtup"]?>" id="size">
							    </div>
					    	</div>
					    	<div class="col-sm-6 col-xs-12" style="padding-right:0px">
					    		<div class="form-group">
							      	<label for="pricemin" buytext="Budget Min(RM)" selltext="Price Min(RM)">Price Min(RM)</label>
							      		<div class="icons question-hover hidden-if-buy" style="display:none" data-html="true" data-toggle="tooltip" title="Result beyond this price range will be eliminated." id="ttip_pricemin" data-placement="top">
										</div>	
										<div class="icons question-hover hidden-if-sell" style="display:none" data-html="true" data-toggle="tooltip" title="Result beyond this budget range will be eliminated." id="ttip_pricemin" data-placement="top">
										</div>
							      	<input class="number-only form-control watermark" mark="" type="text" autocomplete="off" id="pricemin" name="pricemin" value="<?php if(isset($_GET["pricemin"])) echo $_GET["pricemin"]?>">
							    </div>
					    	</div>
					    	<div class="col-sm-6 col-xs-12"  style="padding-left:3px">
					    		<div class="form-group">
							      	<label for="pricemax" buytext="Budget Max(RM)" selltext="Price Max(RM)">Price Max(RM)</label>
							      		<div class="icons question-hover hidden-if-buy" style="display:none" data-html="true" data-toggle="tooltip" title="Result beyond this price range will be eliminated." id="ttip_pricemin" data-placement="top">
										</div>	
										<div class="icons question-hover hidden-if-sell" style="display:none" data-html="true" data-toggle="tooltip" title="Result beyond this budget range will be eliminated." id="ttip_pricemin" data-placement="top">
										</div>
							      	<input class="number-only form-control watermark" mark="" type="text" autocomplete="off" id="pricemax" name="pricemax" value="<?php if(isset($_GET["pricemax"])) echo $_GET["pricemax"]?>">
							    </div>
					    	</div>
					    </div>
				    	<div class="col-xs-12 visible-lg text-center">
				    		<div style="display:inline-block">
				    			
				    		
					    		<div class="left icons rightarrow">
					    			
					    		</div>
					    		<div class="left" style="padding:5px 7px 0px 7px;">
					    			<button type="submit" class="btn-orange">Search</button>
					    		</div>
					    		<div class="left icons leftarrow">
					    			
					    		</div>
				    		</div>
					    	
					    </div>
					</div>
					<div class="features-container col-lg-7 features-list visible-lg" style="margin-top:5px;padding-top:13px;padding-left:40px;">
						
						<?php foreach($featuresdict as $key=>$value):?>
							<div class="clear"></div>
							<div class="col-sm-2 features-group">
								<div class="feature-type">
									<div class="feature-type-arrow icons">
										
									</div>
									<div class="feature-type-inner ">
										<?=$key?>
									</div>
								</div>
							</div>
							
							<div class="col-sm-9 <?=$key?>" style="padding:0px;">
								<?php foreach($value as $k=>$v):?>
									<?php 
										$tip="";
										if(strtolower($k)=="malay reserved land")
										{
											$tip="Land that cannot be sold to other races, even foreigners, other than Malays or Bumiputras.";
										}
										else if(strtolower($k)=="freehold")
										{
											$tip="Ownership tenure is for life.";
										}
										else if(strtolower($k)=="leasehold")
										{
											$tip="Ownership tenure depends on government regulation and can span around 30, 60 or 90 years at the onset.";
										}
										
										
									?>
									<?php 
										foreach($facilities as $key=>$value){
											if($key==$k){
												$tip=implode("<br>",$value);
											}
										}
									
									
									
									?>
									
									
									<div class="feature-item" data-toggle="tooltip" data-html="true" title="<?=$tip ?>">
										<div class="feature-item-arrow icons">
										
										</div>
										<div class="feature-item-inner" value="<?=$k?>">
											<?=$v?>
										</div>
									</div>
								<?php endforeach?>	
							</div>
						<?php endforeach?>	
						
					
						
		
					</div>
					<div class="features-container features-list-mobile panel-group col-xs-12 hidden-lg" id="accordion" style="margin:15px 0px;padding-top:25px;border-top:1px dashed black;">
				      	
					  <?php $count=1?>	
					  <?php foreach($featuresdict as $key=>$value):?>	
					   <?php $count++;?>
					  <div class="panel features-group">
					  	 <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$count?>">
						    <div class="panel-heading">
						              <div class="panel-title"><?=$key?><small class="selected-count"></small>
						              	<div class="panel-arrow icons"></div>
						              </div>
						    </div>
					    </a>
					    <div id="collapse<?=$count?>" class="panel-collapse collapse" style="height:0px">
					      <div class="panel-body">
					      	<?php foreach($value as $k=>$v):?>
					      	<div class="feature-item">
								<div class="feature-item-inner" value="<?=$k?>">
									<?=$v?>
								</div>
								<div class="feature-item-checkbox icons">
									
								</div>
								
							  </div>
					      		
					      		
					      	<?php endforeach?>		
					      </div>
					    </div>
					   </div>
					   <?php endforeach?>	
					</div>
					
					
					<input type="text" name="feature" class="forfeatures" style="display:none;">
					
					
					<div class="col-xs-12 hidden-lg text-center">
				    		<div style="display:inline-block">
				    			
				    		
					    		<div class="left icons rightarrow">
					    			
					    		</div>
					    		<div class="right icons leftarrow">
					    			
					    		</div>
					    		<div class="left">
					    			<button type="submit" class="btn-orange">Search</button>
					    		</div>
					    		
				    		</div>
					    	<div class="my-font"><strong>Or</strong></div>
					    	<br>
					    	<div class="icons postnow-button" onclick="post_now()" style="display:inline-block">
								Post Now
							</div>
					    </div>
			
			</div>
			</form>
			
		
			
			<div class="row" style="margin-top:30px;">
				<div class="col-lg-4 visible-lg left-bar" style="position:inherit;">
					<div class="scroll-fix">
						<div class="" style="z-index:500">
							
							<div class="col-xs-12 criteria-container border-radius">
								<div class="criteria overflow-ellipsis">
									<div class="icons"></div>
									Showing result(s) of 
									<?php if(((isset($_GET["action"]) && $_GET["action"]=="1"))||!isset($_GET["action"])) echo "Selling";
										  else echo "Buying"?> 
									<?php if(!isset($_GET["itemname"]) || strtolower($_GET["itemname"])=="house"):?>
										All Properties
									<?php else:?>
										<?php if(strtolower($_GET["itemname"])=="semi detached house"):?>
											Semi-D
										<?php else:?>	
											<?=ucwords($_GET["itemname"])?>
										<?php endif?>	
										
									<?php endif?>		
								</div>
								
								<div class="criteria overflow-ellipsis">
									<div class="icons"></div>
									<?php if(!isset($_GET["area"]) || $_GET["area"]==""):?>
										Any Location
									<?php else:?>
										<?=str_replace(","," &nbsp;OR&nbsp; ",$_GET["area"])?>
									<?php endif?>		
								</div>
								
								<div class="criteria overflow-ellipsis">
									<div class="icons"></div>
									<?php if(!isset($_GET["pricemin"]) || $_GET["pricemin"]==""):?>
										RM0
									<?php else:?>
										RM<?=number_format($_GET["pricemin"])?>
									<?php endif?> - 
									<?php if(!isset($_GET["pricemax"]) || $_GET["pricemax"]==""):?>
										RM999,999,999
									<?php else:?>
										RM<?=number_format($_GET["pricemax"])?>
									<?php endif?>	
									<?php if(!isset($_GET["builtup"]) || $_GET["builtup"]==""):?>
										
									<?php else:?>
										 , <?=number_format($_GET["builtup"])?>sqft.
									<?php endif?>	
										
								</div>
								
							
							</div>
							<div id="map_container" class="left" style="position:absolute;width:360px;z-index:100;height:290px;">
								<div class="zoom-text">
									<div class="zoom-dot"></div><span class="inner-text">Zooming in</span>
								</div>
								<div id="my_map" class="left" style="width:inherit;height:100%;width:100%;border:1px solid #868686;border-bottom:0px;">
									
								</div>
								
								
							</div>
							<div class="map-tail-bar" style="padding-top:290px;">
								<div class="search-map-label">
									MouseOver The Map To Enlarge
								</div>
								<div class="left icons leftshadow">
									
								</div>
								<div class="right icons rightshadow">
									
								</div>
								<div class="clear"></div>
							</div>
							
						
							<div class="left-bar-postnow icons" onclick="post_now()">
								<div class="inner-text">
									to let others contact you
								</div>
								<div class="icons bubble medium slower run" style="left:-30px;">
									
								</div>
								<div class="icons bubble tiny quick run" style="left:20px;">
									
								</div>
								<div class="icons bubble small slow run" style="left:20px;">
									
								</div>
								<div class="icons bubble big slower run" style="left:70px;">
									
								</div>
								<div class="icons bubble medium quick run" style="left:150px;">
									
								</div>
								<div class="icons bubble tiny slower run" style="left:160px;">
									
								</div>
								<div class="icons bubble tiny slow run" style="left:200px;">
									
								</div>
								<div class="icons bubble big slow run" style="left:230px;">
									
								</div>
								<div class="icons bubble medium slower run" style="left:290px;">
									
								</div>
								<div class="icons bubble tiny fast run" style="left:290px;">
									
								</div>
								<div class="icons bubble tiny slow run" style="left:310px;">
									
								</div>
								<div class="icons bubble small quick run" style="left:340px;">
									
								</div>
							</div>
							<div class="left icons leftshadow">
									
							</div>
							<div class="right icons rightshadow">
								
							</div>	
						</div>
					</div>
					
					
				</div>
		
				<div class="col-lg-8 col-sm-12" id="results">
					<div class="search-result-controls my-font bold text-center">
						
						<div class="col-sm-4 control-box">
							<div class="control-box-inner">
								<div class="result-count"><?=$totalcount?> </div>
								<div class="common-text"><?=concat_if_plural("Result","s",$totalcount,false)?> Found</div>
							</div>
						</div>
						
					
						<div class="col-sm-4 control-box">
							<div class="control-box-inner">
								<div class="common-text">
									Search By:
									<a href="about/title/website#faq-exact_match" target="_blank">
										<div class="icons question-hover" data-toggle="tooltip" data-html="true" title="Click to learn more about <br>&apos;Exact Match&apos;." data-placement="top">
										</div>
									</a>
								</div>
								
								<div class="exact-match icons selected toggle" data-toggle="tooltip" title="Turning off this search mode may yield more results." data-container="body">
									Exact Match
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="col-sm-4 control-box">
							<div class="control-box-inner">
								
								<div class="common-text">
									Sort By:
								</div>
							
								<form class="form-horizontal">
								 
  
								    <div class="styled-select"> 
								    	<?php if(((isset($_GET["action"]) && $_GET["action"]=="1"))||!isset($_GET["action"])) $sort="Price";
										  else $sort="Budget"?> 
								    	<?php
								    		if ($sorttype=="price asc")
												$showfiltertooltip="Showing Lower Price First";
											else if ($sorttype=="price desc")
												$showfiltertooltip="Showing Higher Price First";
											else 
												$showfiltertooltip="Showing Latest Post First";
										?>	
									     <select class="form-control" id="sortby" onchange="sorting_item(this.value);" data-container="body" data-toggle="tooltip" title="<?=$showfiltertooltip?>">

									  	 	<option value="date desc" <?php if(isset($_GET["sorttype"]) && $_GET["sorttype"]=="date desc") echo "selected='selected'"?>>Latest</option>
									  	 	<option value="price desc" <?php if(isset($_GET["sorttype"]) && $_GET["sorttype"]=="price desc") echo "selected='selected'"?>><?=$sort?> ++</option>
									  	 	<option value="price asc" <?php if(isset($_GET["sorttype"]) && $_GET["sorttype"]=="price asc") echo "selected='selected'"?>><?=$sort?> --</option>

									   	</select>
								   	</div> 
						
								  
								</form>
							</div>
							
						</div>
							
					</div>	
					<div class="clear"></div>
					<div class="result-item-container">
						
						<?php
							$count=0;
							foreach($itemsdata as $item){
								$count++;
								$this->load->view("layout_controls/result_item",Array("item"=>$item,"counter"=>$count));
							}
						?>
						
						
						
					</div>
					<?php if($totalcount>0):?>
					<div class="text-center page-links" style="margin-top:20px;">
						<?php echo $pagination; ?>
					</div>
					<div class="text-center" style="margin-top:20px;">
						<?= $this->load->view("user_controls/results_count",Array("start"=>$start,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>"Posting"));?>
					</div>
					<?php endif?>
					
					<?php if($count==0):?>
					<div class="no-result-container">
						
						<div class="row">
						    <div class="col-sm-3 visible-lg" style="padding-right:0px;padding-left:30px;">
								<img class="img-responsive" src="image/ahgong/thinking.png">
							</div>
							<div class="col-xs-12 col-lg-9">
								
								<div class="row">
									<div class="col-xs-12 title">
										Can't find any result?
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 sub-title">
										You are advised to
									</div>
		
								</div>
								
								<div class="row">
									
									
									<div class="col-sm-12 text-center">
										<div class="no-result-button icons adjust-criteria" data-toggle="tooltip" data-html="true" title="Lower Down Min. Price or <br>Increase Max. Budget or<br>Deselect Some Facilities" data-placement="bottom">
											<div class="icons-bg" onclick="scroll_to_search()">
												Adjust Search Criteria
												<div class="icons">
												
												</div>
											</div>
											
										</div>
										<div class="title hidden-inline-xs" style="line-height:180px;font-size:1.7em;padding:0px 5px;">
											or
										</div>
										<div class="no-result-button icons post-now" data-toggle="tooltip" data-html="true" title="Post With Current Criteria, <br> Letting Others To Know" data-placement="bottom">
											<div class="icons-bg" onclick="post_now()">
												Post Now
												<br>
												<div class="icons">
												
												</div>
											</div>
											
											
										</div>
									</div>
								</div>
								
									
							</div>
							
							

						</div>
						
						
						
						
						
					</div>
					<?php endif?>
					
				</div>
				
			</div>
			

			
	</div>
	

	
</div>

<script type="text/javascript">

var PAGE_SEARCH_gmap,
    PAGE_SEARCH_return_timer,
    PAGE_SEARCH_map_minimize_timer,
    PAGE_SEARCH_did_search,
    PAGE_SEARCH_infowindow_closetimer,
    PAGE_SEARCH_can_marker_hover_select,
    PAGE_SEARCH_bounds,
    PAGE_SEARCH_itemcount,
    PAGE_SEARCH_totalcount,
    PAGE_SEARCH_processid,
    PAGE_SEARCH_skip_validation,
    PAGE_SEARCH_current_overlay;


	<?php if(isset($_GET["itemname"]) || (isset($pagestart) && ($pagestart!=0))):?>
		PAGE_SEARCH_did_search=true;
	<?php endif?>
	PAGE_SEARCH_itemcount=<?=$count?>;
	PAGE_SEARCH_totalcount=<?=$totalcount?>;
	PAGE_SEARCH_can_marker_hover_select=true;
	PAGE_SEARCH_skip_validation=false;
</script>







	
			










