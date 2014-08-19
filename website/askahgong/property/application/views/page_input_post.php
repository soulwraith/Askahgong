<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAzjElo8TqEjCpH3jQrYCi8DP_kWNPhQWQ&libraries=places&sensor=true" type="text/javascript"></script>




<?php 
	$previous = array();
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'New Posting'))?>


<?php 
	if(isset($_GET["action"])){
		if($_GET["action"]=="0"){
			$item->type=0;
		}
		else{
			$item->type=1;
		}
	}
	
	
?>

<div class="PAGE_NEWPOST">
	

	<div class="container  margin-top">
		
		<?php if(!is_verified_agent($user)):?>
		
		<div class="row">
			<div class="hidden-in-buy">
				<div class="alert alert-warning">
					You are not an agent, selling item must be assigned to an agent, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen 
				</div>
			</div>
		</div>
		
		<?php endif?>
		
		<div id="inputalert"></div>
		
		<div class="compulsory">
			<span class="asterisk2">*</span> fields are compulsory to be filled.
		</div>
		
		<form id="inputform" class="" onsubmit="if(!validate_submit()) return false;" action="posting/submit/<?php if(isset($item->id)) echo $item->id?>" method="post">
			
			
			<div class="row white-trans inputform-container border-radius">
				<div class="col-sm-5 left-container">
					<div class="row">
						<div class="post-title col-lg-6 col-sm-12">
							You Want To
						</div>
						<input id="action" name="action" type="hidden" value="<?php if(isset($item) && $item->type=="0") echo "sell"; else echo "buy"?>">
						<div class="post-action col-lg-6 col-sm-12 clearfix btn-actions">
							 <a onclick="buysell_change('buy',false)" href="javascript:void(0)">
							 	<div class="text-center icons buybutton actionbutton <?php if(isset($item) && $item->type=="1") echo "selected"?>">BUY</div>
							 </a>
							  
							 <a onclick="buysell_change('sell',false)" href="javascript:void(0)">
							 	 <div class="text-center icons sellbutton actionbutton <?php if(isset($item) && $item->type=="0") echo "selected"?>">SELL</div>
							 </a>
							 
							  
						</div>
					</div>
					
					
					
					<div class="clear"></div>
					
									
					<div class="form-group margin-top">
					      <label for="itemname">Unit Type</label> 
					      <div class="styled-select"> 
					      							
							<select id="itemname" name="itemname" class="form-control buy sell">
								<option class="hidden-object" value="" selected>Select Unit Type</option>
								<?php foreach ($propertylist as $prop):?>
									<?php if($prop=="House"):?>
										<!--<option class="houseoption hidden-in-sell" value="house" <?php if(isset($item) && $item->name=="house" && $item->type!=0) echo "selected"?>>All Properties</option>-->
									<?php else:?>
										<option value="<?=$prop?>" <?php if(isset($item) && strtolower($item->name)==strtolower($prop)) echo "selected"?>><?=$prop?></option>
									<?php endif?>
								<?php endforeach;?>
								
							</select>
							
							
					      </div>
				   </div>
				   	
				   	<div class="form-group">
				      <label for="input_area">Area</label> <div class="icons question-hover" data-toggle="tooltip" title="You can specify further with road name, e.g. Jalan Biru" data-placement="right"></div>
				    
				      <input class="form-control" id="input_area" type="text">
				      <input type="text" style="display:none" name="coordinates" id="coordinates" value="">
				      <input type="text" name="area_unknown" style="display:none;">
				      <input type="text" name="moved_marker" value="<?php if(isset($item->moved_marker)) echo $item->moved_marker?>" style="display:none;">
				    </div>
				   	
				   <div class="form-group">
				      <label for="price" class="pricelabel">Price (RM)</label> <div class="icons question-hover hidden-in-sell" data-toggle="tooltip" title="You can specify the maximum price that you are willing to pay." data-placement="right"></div>
				      <input type="text" class="number-only sell buy form-control watermark" mark="" autocomplete="off" id="price" name="price" value="<?php if(isset($item)) echo $item->price;?>">
				    </div>	
				   	
				   		 		   
				   <div class="form-group">
				      <label for="builtup">Built-up (Sqft.)</label> 
				      	<a href="about/title/website#faq-builtup" target="_blank">
				      		<div class="icons question-hover" data-toggle="tooltip" title="Click to learn about &apos;Built-up&apos;" data-placement="right">
				      		</div>
				      	</a>
				      <input type="text" id="builtup" name="builtup" autocomplete="off" class="number-only sell form-control watermark" mark="" value="<?php if(isset($item)) echo $item->builtup;?>">
				    </div>
				   
					
					
					
							
						
							
				</div>
				<div class="col-sm-7 clearfix padding-equal">
					<div class="map-container" style="background-color:white;padding:10px;height:350px;">
						<div style="background-color:#e5e5e5;padding:5px;height:100%">
								<div id="googlemap" tabindex="-1" style="width:inherit;height:100%;width:100%;;">
											
								</div>
							<div class="clear"></div>
						</div>
						
						<div class="map-advice">
							<img class="sell-marker" src="image/ahgong/sell_move_marker.png">
							<img class="buy-marker" src="image/ahgong/buy_move_marker.png">
						</div>
						
					</div>
				</div>
				
				
				
		
			</div>
			
			<div class="row">
				
					<div class="features-list-mobile panel-group margin-top" id="accordion">
				      	
					  <?php $count=1?>	
					  <?php foreach($featuresdict as $key=>$value):?>	
					   <?php $count++;?>
					   <?php 
					   		if($key=="Facility")
					   		continue;
					   ?>
					   <div class="clearfix col-lg-4 col-sm-6 features-container <?=strtolower($key)?> <?php if(strtolower($key)=="tenure" || strtolower($key)=="storey") echo "sell"?>">
						  <div class="panel features-group">
						  	 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$count?>">
							    <?php if($key=="Feature"):?>
							    	<div class='margin-top visible-xs'></div>
							    <?php elseif($key=="Storey"):?>
							    	<div class='margin-top hidden-lg'></div>
							    <?php endif?>	
							    <div class="panel-heading" style="background-color:white;color:#DB6409;">
							              <div class="panel-title"><?=$key?><small class="selected-count"></small>
							              	<?php if(strtolower($key)=="tenure"):?>
							              	
							              		<div class="icons question-hover pointer-cursor" onclick="direct_to_url('about/title/website#faq-tenure','_blank');" data-toggle="tooltip" title="Click to learn about &apos;Tenure&apos;" data-placement="right">
							              			
							              		</div>
							              	
							              	<?php endif?>
							              	<div class="panel-arrow icons">
							              	
							              	</div>
							              	
							              </div>
							   			
							    </div>
							   
						    </a>
						    <div id="collapse<?=$count?>" class="panel-collapse in" style="height:auto">
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
					   </div>
					   <?php endforeach?>	
					</div>
			</div>

  <!--essential for features-->
<div class="features-container features-list" style="display:none;">
						
<?php foreach($featuresdict as $key=>$value):?>
<?php 
	if($key=="Facility")
   		continue;
?>
<div class="clear"></div>
<div class="col-sm-2 features-group">
	<div class="feature-type">
		
		<div class="feature-type-inner ">
			<?=$key?>
		</div>
	</div>
</div>
<div class="col-sm-9 <?=strtolower($key)?>" style="padding:0px;">
	<?php foreach($value as $k=>$v):?>
		<div class="feature-item">
			
			<div class="feature-item-inner" value="<?=$k?>">
				<?=$v?>
			</div>
		</div>
	<?php endforeach?>	
</div>
<?php endforeach?>	






</div>
	<!--END essential for features-->


			<div class="row margin-top features-list fullwidth facility-list">
				<div class="col-sm-4 margin-top">
					<div class="features-group">
						<div class="feature-type">
							<div class="icons feature-type-arrow">
			
							</div>
							<div class="feature-type-inner ">
								<span buytext="Required Facility" selltext="Facility">Facility</span>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<?php foreach($featuresdict["Facility"] as $key=>$value):?>	
					<div class="col-sm-4">
							<div class="feature-item">
								<div class="icons feature-item-arrow">
					
								</div>
								<div class="feature-item-inner" value="<?=$key?>">
									<?=$value?>
								</div>
							</div>
					</div>
				<?php endforeach?>	
				
				<div class="clear"></div>
				<div class="col-sm-4">
					<div class="features-group">
						<div class="feature-type">
							<div class="feature-type-arrow icons">
								
							</div>
							<div class="feature-type-inner ">
								<span buytext="Other Required Facilities" selltext="Other Facilities">Other Facilities</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="form-group">
						<input type="text" class="otherfacilityinput form-control watermark" mark="Input other facility here, separated by &quot;,&quot;"> 
					</div>
					
				</div>
				<input type="text" name="feature" style="display:none;"/>
				<input type="text" name="feature_unknown" style="display:none;"/>
			</div>
			
			<div class="row white-trans border-radius padding-equal-15" style="padding-top:25px">
				<div class="col-sm-6 file-upload-container">
					<div class="rowitem" style="margin-bottom:11px;">
						<?php $data=Array()?>
						<?php if(isset($item->id)){
							$data['filearr']=$item->filearr;
							$data['itemid']=$item->id;
						}?>
						<?= $this->load->view("user_controls/file_uploader",$data)?>
						
					</div>
					
					
				</div>
				<div class="clear visible-xs" style="padding-top:15px;"></div>
				
				<div class="col-sm-6 your-message-container">
				
					<div class="form-group">
				      <label for="description">Your Message</label>
				      <textarea class="form-control watermark" mark="" name="description" id="description" style="height:199px"><?php if(isset($item->id)) echo $item->description_original_edit;?></textarea>
				      
				    </div>
					
						
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 text-center">
					<input type="submit" class="btn-orange grey-bg" value="Submit">
				</div>
			</div>
			
		</form>
		
			
	</div>
</div>




<script type="text/javascript">

var PAGE_NEWPOST_onpage,
    PAGE_NEWPOST_AREANAME,
    PAGE_NEWPOST_AREA_ID_LEVEL_STRING,
    PAGE_NEWPOST_LATITUDE,
    PAGE_NEWPOST_LONGITUDE,
    PAGE_NEWPOST_FEATURE,
    PAGE_NEWPOST_infowindow,
    PAGE_NEWPOST_gmap,
    PAGE_NEWPOST_area_supportxhr=null,
    PAGE_NEWPOST_POSTNOW,
    PAGE_NEWPOST_EDITING,
    PAGE_NEWPOST_SUBMITTING;



		PAGE_NEWPOST_onpage=true;
	<?php if((isset($item->latitude))):?>
		PAGE_NEWPOST_AREANAME="<?=$item->areaname?>",
		PAGE_NEWPOST_AREA_ID_LEVEL_STRING="<?=$item->areaidlevelstring?>",
		PAGE_NEWPOST_LATITUDE="<?=$item->latitude?>",
		PAGE_NEWPOST_LONGITUDE="<?=$item->longitude?>";
	<?php endif?>	
	<?php if(($item->name)):?>
		PAGE_NEWPOST_FEATURE="<?=$item->feature?>";
		PAGE_NEWPOST_POSTNOW=true;
	<?php endif?>
	<?php if(isset($item->id)):?>
		PAGE_NEWPOST_EDITING=true;
	<?php endif?>
		PAGE_NEWPOST_SUBMITTING=false;
	
	
</script>

















