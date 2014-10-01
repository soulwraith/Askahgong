

<div class="settings-container SUBPAGE_SETTINGS">
	<div class="header">
		My Settings
		<div class="right icons settings-icon">
			
		</div>
	</div>
	
	<div class="row margin-top">
		<div class="col-xs-12">
			<form class="dashboard-form form-horizontal" id="changepassword" onsubmit="submit_password();return false;">
				<div class="white-container">
					
					<div class="form-group">
						<div>
							<h4>
								Change Your Password
							</h4>
							
						</div>
						
					</div>
					
					<div id="change-password-alert" class="">
						
					</div>
										
					
					<div class="form-group">
					    <label for="useroriginalpassword" class="col-md-6 col-sm-12 control-label">Original Password
					    	<a href="user/submit_logout/login">
					    		<div class="icons question-hover" data-toggle="tooltip" title="Click here if you forget your original password." data-placement="top">
								</div>	
					    	</a>
					    </label>
					    
					    <div class="col-md-6 col-sm-12">
					      <input type="password" class="form-control" id="useroriginalpassword" name="useroriginalpassword">
					    </div>
					</div>
					
					<div class="form-group">
					    <label for="userpassword" class="col-md-6 col-sm-12 control-label">New Password</label>
					    <div class="col-md-6 col-sm-12">
					      <input type="password" class="form-control" id="userpassword" name="userpassword">
					    </div>
					</div>
					
					<div class="form-group">
					    <label for="retypeuserpassword" class="col-md-6 col-sm-12 control-label">Retype New Password</label>
					    <div class="col-md-6 col-sm-12">
					      <input type="password" class="form-control" name="retypeuserpassword" id="retypeuserpassword">
					    </div>
					</div>
					
					<div class="col-xs-12 text-center">
						<button type="submit" id="passwordsubmit" class="btn btn-amber">Update Password</button>
					</div>
				
				   			
				</div>
			  	  		
			  	</form>
		</div>
	</div>
	
	
	<div class="row margin-top">
		<div class="col-xs-12">
			<form class="dashboard-form form-horizontal notification-settings-form" id="notification-settings">
				<div class="white-container">
					
					<div class="form-group">
						<div>
							<h4>
								Add Your SMS/Web Notification
								<a href="about/title/features#item-notification" target="_blank">
									<div class="icons question-hover" data-toggle="tooltip" title="Add new notification to be instantly notified of certain new items. Click to see how this feature may help you." data-placement="top">
									</div>
								</a>
							</h4>
						</div>
						
					</div>
					
					<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"info",
								"alert_html"=>'Allow you to decide when, how or what you want to be notified on, with the settings below. Points to note, 
										<ul style="list-style:disc">
											<li>
												Remember to change your <span data-toggle="tooltip" title="Click to customize your working hour."><a href="profile#workingfrom" target="_blank">working hours</a></span> to suit your need. 
											</li>
											<li>
												 You might read very fast but it is not advisable to choose to be notified for all new posting(s). This is so that you don’t get all the notifications that you do not want <strong>(It is not fun to receive 200 SMS-es per day!)</strong>. 
											</li>
											<li>
												You can select <strong>multiple</strong> types of notifications by adding settings with different criteria. 
											</li>
										</ul>'))
							?>
					
					
				
					
								
					<div class="form-group">
						<div>
							<strong>Current Notification(s)</strong>
						</div>
						<div id="notification-alert">
							
						</div>
					</div>
					
					<?php if(count($notification_settings)==0):?>
					
						<div class="margin-bottom never-insert">
							<small>You do not have any notification currently, add one below!</small>
						</div>			
								
					<?php endif?>	
					
					
					<div class="table-responsive notf-settings-container <?php if(count($notification_settings)==0) echo "hidden-object"?>">
				        <table class="table table-bordered">
				          <thead>
				            <tr>
				              <th>When</th>
				              <th>How</th>
				              <th>What</th>
				              <th>Criteria</th>
				              <th></th>
				            </tr>
				          </thead>
				          <tbody>
				      	    <?php foreach($notification_settings as $setting):?>
								<?=$this->load->view("layout_controls/notification_settings",Array("setting"=>$setting))?>
							<?php endforeach?>
				          </tbody>
				        </table>
				      </div>
					
					
					
					
					<div class="form-group">
						<div>
							<strong>Add New Notification</strong>
						</div>
					</div>
					
							    
			
					<div class="form-group">
					    <label for="method" class="col-md-4 col-sm-12 control-label">How?
					    	<div class="icons question-hover" data-toggle="tooltip" title="What method do you prefer to receive notification?" data-placement="top">
							</div>	
					    </label>
					    <div class="col-md-8 col-sm-12">
					    	<div class="styled-select">
					    		<select class="form-control" name="method" id="method" onchange="notification_type_changed(this)">
										<option value="2">By Web Notification Only</option>
										<option value="1">By SMS And Web Notification</option>
								</select>
					    	</div>
					    </div>
					</div>	
					
					<div class="form-group time-container hidden-object">

					    <label for="time" class="col-md-4 col-sm-12 control-label">When?
					    	<div class="icons question-hover" data-toggle="tooltip" title="When would you like to receive notification?" data-placement="top">
							</div>
						</label>
					    <div class="col-md-8 col-sm-12">
					    	<div class="styled-select">
					    		<select class="form-control" name="time" id="time">
					    			<option value="1">Anytime</option>
									<option value="0">Working Hour Only</option>
									
								</select>
					    	</div>
					    </div>
					</div>	
					
					
					<div class="form-group">
					    <label for="item" class="col-md-4 col-sm-12 control-label">What?
					    	<div class="icons question-hover" data-toggle="tooltip" title="What kind of notification do you like to add?" data-placement="top">
							</div>	
					    </label>
					    <div class="col-md-8 col-sm-12">
					    	<div class="styled-select">
					    		<select name="item" id="item" class="form-control" onchange="item_type_changed(this)">
									<option value="0">Any New Item</option>
									<option value="1">Any New Item Matching My Posting(s)</option>
									<option value="2">Any New Item Matching My Criteria</option>
									<?php if($isAgent):?>
									<option value="3">Any Bad Agent Review</option>
									<?php endif?>
								</select>
					    	</div>
					    </div>
					</div>	
					
					<div class="criteria" style="display:none;">
						<div class="form-group">

						    <label for="type" class="col-md-4 col-sm-12 control-label">I Want To Find
						    	<div class="icons question-hover" data-html="true" data-toggle="tooltip" title="Select &apos;Selling&apos; if you want to buy, <br>Select &apos;Buying&apos; if you want to sell. " data-placement="top">
								</div>	
						    </label>
						    <div class="col-md-8 col-sm-12">
						    	<div class="styled-select">
						    		<select name="type" class="form-control" id="type" onchange="settings_buy_sell_difference()">
										<option value="0">Selling</option>
										<option value="1">Buying</option>
									</select>
						    	</div>
						    </div>
						</div>	
						
						
						<div class="form-group">

						    <label for="categoryid" class="col-md-4 col-sm-12 control-label">Unit Type</label>
						    <div class="col-md-8 col-sm-12">
						    	<div class="styled-select">
						    		<select name="categoryid" class="form-control" id="categoryid">
										<?php foreach($propertylist_with_id as $property):?>
											<?php if(strtolower($property->word)=="house") $property->word="All Properties"?>
											<option value="<?=$property->id?>"><?=$property->word?></option>
										<?php endforeach?>
									</select>
						    	</div>
						    </div>
						</div>	
						
						<div class="form-group">
						    <label for="pricemin" class="pricelabel col-md-4 col-sm-12 control-label">Price Min.
						    	<div class="icons question-hover hidden-if-buy" data-html="true" data-toggle="tooltip" title="You will be notified with newly posted property only within this price range." id="ttip_pricemin" data-placement="top">
								</div>	
								<div class="icons question-hover hidden-if-sell" data-html="true" data-toggle="tooltip" title="You will be notified with new buying request only within this budget range." id="ttip_pricemin" data-placement="top">
								</div>	
						    </label>

						    <div class="col-md-8 col-sm-12">
						    	<input class="number-only form-control watermark" mark="Input min. price of your desired property." type="text" autocomplete="off" id="pricemin" name="pricemin">
						    </div>
						</div>	
						
						<div class="form-group">
						    <label for="pricemax" class="pricelabel col-md-4 col-sm-12 control-label">Price Max.
						    	<div class="icons question-hover hidden-if-buy" data-html="true" data-toggle="tooltip" title="You will be notified with newly posted property only within this price range." id="ttip_pricemin" data-placement="top">
								</div>	
								<div class="icons question-hover hidden-if-sell" data-html="true" data-toggle="tooltip" title="You will be notified with new buying request only within this budget range." id="ttip_pricemin" data-placement="top">
								</div>
						    </label>


						    <div class="col-md-8 col-sm-12">
						    	<input class="number-only form-control watermark" mark="Input max. price of your desired property." type="text" autocomplete="off" id="pricemax" name="pricemax">
						    </div>
						</div>	
						
						<div class="form-group area-form-group">
						    <label for="input_area" class="col-md-4 col-sm-12 control-label">Location
						    	<div class="icons question-hover" data-html="true" data-toggle="tooltip" title="You can specify further with road name, e.g. Jalan Permatang" data-placement="top">
								</div>
						    </label>
						    <div class="col-md-12 col-sm-12">
						    	<input class="" class="input_area" id="input_area" type="text">
						    </div>
						</div>	
												
						
					</div>
					
					<div class="col-xs-12 text-center">
						<button type="button" class="btn btn-amber" onclick="save_notification(this)">Add</button>
					</div>
				</div>
			  	  		
			  	</form>
		</div>
	</div>
	
	
	
	
</div>




