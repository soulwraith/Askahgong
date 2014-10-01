


<div class="profile-container SUBPAGE_PROFILE">
	<form class="form-horizontal dashboard-form" role="form" method="post" action="profile/updateusersettings" onsubmit="return validate_update_profile();">
	
		<div class="header">
			My Profile
			<div class="right icons profile-icon">
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				
				
			</div>
		</div>
		
		
		<div class="row margin-top">
			<div class="col-xs-12">
				<div id="profilealert" class="position-relative">
						  	 
		   	    </div>
			</div>
			
			<?php if(!$user->completed_profile):?>
			<div class="col-xs-12">
				
				<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"info",
					"alert_html"=>"Please complete your profile to get additional reputation point."))
				?>
				
			
			</div>
			<?php endif?>
			
			<div class="col-md-4 col-sm-12 profile-box-container" style="padding-right:0px;">
				<div class="image-box text-center profile-box">
					<div class="image-container">
						<img class="img-responsive inline-block" src="<?=get_user_profile_pic($user->id)?>">
					</div>
					
					<div class="upload-button grey-bg position-relative" id="container">
						<button id="fileinput" class="btn btn-block btn-white trigger-file-input switching" type="button">
							<div class="image-to-switch icons"></div>
							<span class="text-to-switch">Change Picture</span>
						</button>
					</div>	
					
				</div>
			</div>
			<div class="col-md-8 col-sm-12">
				<div class="profile-box uneditable-box position-relative">
					<div class="dot-circle-outer grain-bg">
						<div class="dot-circle">
							
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-lg-12"><strong>Member Since</strong></div>
					</div>
					<div class="row">
						<div class="col-lg-12"><?=date('d/m/Y  g:i a',strtotime($user->registerdate));?></div>
					</div>
					<div class="row margin-top">
						<div class="col-lg-12"><strong>Contact</strong>
							<a href="javascript:void(0)" onclick="open_circle(true,25,'Ahgong','open',event);">
				      			<div class="icons question-hover" data-toggle="tooltip" title="Click to contact Ah Gong for contact changing." data-container="body" data-placement="right">
				      			</div>
				      		</a>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12"><?=$user->phone?></div>
					</div>
					
					<div class="row margin-top">
						<div class="col-lg-12"><strong>Alternative Contact</strong></div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<input class="form-control border-radius-important watermark" mark="Input optional contact number." type="text" name="alternatephone" value="<?=$user->alternatephone?>">
						</div>
						
					</div>
				</div>
			</div>
			
		</div>
	
	
		<div class="row margin-top">
			<div class="col-xs-12">
				<div class="profile-box editable-box" id="profile-box">
					
					<div class="compulsory">
						<span class="asterisk">*</span> fields are compulsory to be filled.
					</div>		
					<div id="profileerror" class="position-relative">
							  	 
				    </div>
					
					
					  <div class="form-group" id="contact_method">

					    <label for="username" class="col-md-4 col-sm-12 control-label">Username<span class="asterisk">*</span>
					    	<div class="icons question-hover" data-toggle="tooltip" title="This will be displayed as your profile name." data-container="body" data-placement="top">
				      			</div>
					    </label>
					    <div class="col-md-8 col-sm-12">

					      <input type="text" mark="Input your profile name." class="form-control required watermark" id="username" name="username" value="<?=$user->username?>">
					    </div>
					  </div>
					 <?php if($user->verified_agent==0 && $user->roleid=="5"):?>
					 <div class="row">
					 	<div class="col-xs-12">
					 		
					 		<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"info",
								"alert_html"=>"We are verifying your change to agent status. We will let you know when you can starting posting!
												<br>
												<a>What is agent verification?</a>"))
							?>
					 		
					 		
							
						</div>
					 </div>
					 <?php elseif($user->verified_agent==-1 && $user->roleid=="5"):?>
					 <div class="row">
					 	<div class="col-xs-12">
							<div class="alert alert-danger">
								Your agent identity verification has failed.
								
							</div>
						</div>
					 </div>
					 <?php endif?>
					 
					 <div class="form-group">
					
					    <label for="roleid" class="col-md-4 col-sm-12 control-label">Role<span class="asterisk">*</span>
					    	<a href="terms" target="_blank">
				      			<div class="icons question-hover" data-toggle="tooltip" data-html="true" title="Please only choose the agent option if you have an agent license. Click for more details." data-placement="top">
				      			</div>
				      		</a>
					    </label>
					    <div class="col-md-8 col-sm-12">

					      <div class="styled-select"> 
						      <select name="roleid" class="form-control required" id="roleid" onchange="role_changed()">
								<?php $have_role=false?>
								<?php foreach($available_roles as $role):?>
									<option value="<?=$role->id?>" <?php if($role->id==$user->roleid) {$have_role=true;echo "selected";}?>><?=$role->role?></option>
								<?php endforeach?>	
								
								<?php if($have_role==false):?>
									<option value="" class="hidden-object" selected>Select Your Role</option>
								<?php endif?>	
							  </select>
						  </div>
					    </div>
					  </div>
					 
					 <div class="form-group agency">
					    <label for="agency" class="col-md-4 col-sm-12 control-label">Agency
					    	<a href="terms" target="_blank">
				      			<div class="icons question-hover" data-toggle="tooltip" data-html="true" title="Please make sure your agency is legit. Click for more details." data-placement="top">
				      			</div>
				      		</a>
					    </label>
					    <div class="col-md-8 col-sm-12">
					      <input type="text" mark="Input your attached property agency."class="form-control watermark" id="agency" name="agency" value="<?=$user->agency?>">
					    </div>
					  </div>
					 
					 
					 
					 <div class="form-group">
					    <label for="email" class="col-md-4 col-sm-12 control-label">Email
				      			<div class="icons question-hover" data-toggle="tooltip" data-html="true" title="Please enter valid Email address as you can reset password using this." data-placement="top">
				      			</div>
					    </label>
					    <div class="col-md-8 col-sm-12">

					      <input type="text" mark ="Input your Email address."class="form-control watermark" id="email" name="email" value="<?=$user->email?>">
					    </div>
					  </div>
					 
					 <div class="form-group">
					    <label for="phonevisibility" class="col-md-6 col-sm-12 control-label">Reveal Phone Number
					    	<a href="about/title/website#faq-contact_method" target="_blank">
				      			<div class="icons question-hover" data-toggle="tooltip" data-html="true" title="To whom you want to show your contact number? Click for more details." data-placement="top">
				      			</div>
				      		</a>
					    </label>
					    <div class="col-md-6 col-sm-12">
					      <div class="styled-select"> 
						      <select name="phonevisibility" class="form-control" id="phonevisibility">
								<option value="0" <?php if($user->phone_visibility==0) echo "selected"?>>
									To Everyone
								</option>
								<option value="1" <?php if($user->phone_visibility==1) echo "selected"?>>
									To My Contact(s) Only
								</option>
								<option value="2" <?php if($user->phone_visibility==2) echo "selected"?>>
									Nobody
								</option>
							  </select>
						  </div>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="contactmethod" class="col-md-6 col-sm-12 control-label">Contact Method
					    		<div class="icons question-hover" data-toggle="tooltip" title="Select the preferable way you will like to be contacted." data-placement="top">
				      			</div>	
					    </label>
					    <div class="col-md-6 col-sm-12">
					      <div class="styled-select"> 
						      <select name="contactmethod" class="form-control" id="contactmethod">
						      	<option value="Web Msg/Call/SMS" <?php if($user->contactmethod=="Web Msg/Call/SMS") echo "selected='selected'"?>>Web Msg/Call/SMS</option>
						    	<option value="Web Msg/SMS" <?php if($user->contactmethod=="Web Msg/SMS") echo "selected='selected'"?>>Web Msg/SMS</option>
						    	<option value="Web Msg Only" <?php if($user->contactmethod=="Web Msg Only") echo "selected='selected'"?>>Web Msg Only</option>
							  </select>
						  </div>
					    </div>
					  </div>
					  
					  <div class="form-group">
					  	<div>
					  		<strong class = "black-font">
					  			Available Hour
					  		</strong>
					  	
					  		<div class="icons question-hover" data-toggle="tooltip" title="Select the period you will like to be notified/contacted by our users." data-placement="top">
				      		</div>
				      	</div>
					  </div>
					  
					 <div class="form-group">
					    <label for="workingform" class="col-md-2 col-sm-12 control-label">From</label>
					    <div class="col-md-4 col-sm-12">
					      <div class="styled-select"> 
						      <select name="workingfrom" class="form-control" id="workingfrom">
										<option value="Any" <?php if($user->workingfrom=="Any") echo "selected='selected'"?>>Any</option>
										<option value="12 AM" <?php if($user->workingfrom=="12 AM") echo "selected='selected'"?>>12 AM</option>
										<option value="1 AM" <?php if($user->workingfrom=="1 AM") echo "selected='selected'"?>>1 AM</option>
										<option value="2 AM" <?php if($user->workingfrom=="2 AM") echo "selected='selected'"?>>2 AM</option>
										<option value="3 AM" <?php if($user->workingfrom=="3 AM") echo "selected='selected'"?>>3 AM</option>
										<option value="4 AM" <?php if($user->workingfrom=="4 AM") echo "selected='selected'"?>>4 AM</option>
										<option value="5 AM" <?php if($user->workingfrom=="5 AM") echo "selected='selected'"?>>5 AM</option>
										<option value="6 AM" <?php if($user->workingfrom=="6 AM") echo "selected='selected'"?>>6 AM</option>
										<option value="7 AM" <?php if($user->workingfrom=="7 AM") echo "selected='selected'"?>>7 AM</option>
										<option value="8 AM" <?php if($user->workingfrom=="8 AM") echo "selected='selected'"?>>8 AM</option>
										<option value="9 AM" <?php if($user->workingfrom=="9 AM") echo "selected='selected'"?>>9 AM</option>
										<option value="10 AM" <?php if($user->workingfrom=="10 AM") echo "selected='selected'"?>>10 AM</option>
										<option value="11 AM" <?php if($user->workingfrom=="11 AM") echo "selected='selected'"?>>11 AM</option>
										<option value="12 PM" <?php if($user->workingfrom=="12 PM") echo "selected='selected'"?>>12 PM</option>
										<option value="1 PM" <?php if($user->workingfrom=="1 PM") echo "selected='selected'"?>>1 PM</option>
										<option value="2 PM" <?php if($user->workingfrom=="2 PM") echo "selected='selected'"?>>2 PM</option>
										<option value="3 PM" <?php if($user->workingfrom=="3 PM") echo "selected='selected'"?>>3 PM</option>
										<option value="4 PM" <?php if($user->workingfrom=="4 PM") echo "selected='selected'"?>>4 PM</option>
										<option value="5 PM" <?php if($user->workingfrom=="5 PM") echo "selected='selected'"?>>5 PM</option>
										<option value="6 PM" <?php if($user->workingfrom=="6 PM") echo "selected='selected'"?>>6 PM</option>
										<option value="7 PM" <?php if($user->workingfrom=="7 PM") echo "selected='selected'"?>>7 PM</option>
										<option value="8 PM" <?php if($user->workingfrom=="8 PM") echo "selected='selected'"?>>8 PM</option>
										<option value="9 PM" <?php if($user->workingfrom=="9 PM") echo "selected='selected'"?>>9 PM</option>
										<option value="10 PM" <?php if($user->workingfrom=="10 PM") echo "selected='selected'"?>>10 PM</option>
										<option value="11 PM" <?php if($user->workingfrom=="11 PM") echo "selected='selected'"?>>11 PM</option>
							  </select>
						  </div>
					    </div>
					    
					    <label for="workingto" class="col-md-2 col-sm-12 control-label">To</label>
					    <div class="col-md-4 col-sm-12">
					      <div class="styled-select"> 
						      <select name="workingto" class="form-control" id="workingto">
										<option value="Any" <?php if($user->workingto=="Any") echo "selected='selected'"?>>Any</option>
										<option value="12 AM" <?php if($user->workingto=="12 AM") echo "selected='selected'"?>>12 AM</option>
										<option value="1 AM" <?php if($user->workingto=="1 AM") echo "selected='selected'"?>>1 AM</option>
										<option value="2 AM" <?php if($user->workingto=="2 AM") echo "selected='selected'"?>>2 AM</option>
										<option value="3 AM" <?php if($user->workingto=="3 AM") echo "selected='selected'"?>>3 AM</option>
										<option value="4 AM" <?php if($user->workingto=="4 AM") echo "selected='selected'"?>>4 AM</option>
										<option value="5 AM" <?php if($user->workingto=="5 AM") echo "selected='selected'"?>>5 AM</option>
										<option value="6 AM" <?php if($user->workingto=="6 AM") echo "selected='selected'"?>>6 AM</option>
										<option value="7 AM" <?php if($user->workingto=="7 AM") echo "selected='selected'"?>>7 AM</option>
										<option value="8 AM" <?php if($user->workingto=="8 AM") echo "selected='selected'"?>>8 AM</option>
										<option value="9 AM" <?php if($user->workingto=="9 AM") echo "selected='selected'"?>>9 AM</option>
										<option value="10 AM" <?php if($user->workingto=="10 AM") echo "selected='selected'"?>>10 AM</option>
										<option value="11 AM" <?php if($user->workingto=="11 AM") echo "selected='selected'"?>>11 AM</option>
										<option value="12 PM" <?php if($user->workingto=="12 PM") echo "selected='selected'"?>>12 PM</option>
										<option value="1 PM" <?php if($user->workingto=="1 PM") echo "selected='selected'"?>>1 PM</option>
										<option value="2 PM" <?php if($user->workingto=="2 PM") echo "selected='selected'"?>>2 PM</option>
										<option value="3 PM" <?php if($user->workingto=="3 PM") echo "selected='selected'"?>>3 PM</option>
										<option value="4 PM" <?php if($user->workingto=="4 PM") echo "selected='selected'"?>>4 PM</option>
										<option value="5 PM" <?php if($user->workingto=="5 PM") echo "selected='selected'"?>>5 PM</option>
										<option value="6 PM" <?php if($user->workingto=="6 PM") echo "selected='selected'"?>>6 PM</option>
										<option value="7 PM" <?php if($user->workingto=="7 PM") echo "selected='selected'"?>>7 PM</option>
										<option value="8 PM" <?php if($user->workingto=="8 PM") echo "selected='selected'"?>>8 PM</option>
										<option value="9 PM" <?php if($user->workingto=="9 PM") echo "selected='selected'"?>>9 PM</option>
										<option value="10 PM" <?php if($user->workingto=="10 PM") echo "selected='selected'"?>>10 PM</option>
										<option value="11 PM" <?php if($user->workingto=="11 PM") echo "selected='selected'"?>>11 PM</option>	>
							  </select>
						  </div>
					    </div>
					    
					  </div>
				
					  <div class="form-group">
					    <label for="description" class="col-md-3 col-sm-12 control-label description">Description</label>
					    <div class="col-md-9 col-sm-12">
							<textarea id="description" mark="Introduce more about yourself to this community." name="description" class="form-control watermark" rows="5" type="text"><?=$user->description?></textarea>
					    </div>
					  </div>
					
					 
					  
					
					
				</div>
			</div>
		</div>
		
		<div class="row margin-top">
			<div class="col-lg-12 text-center">
				<div class="padding-equal grey-bg inline-block">
					<button class="btn btn-light-orange btn-lg" type="submit">Update Info</button>
				</div>
			</div>
		 	
		 </div>
		
		
     </form>
</div>

<script type="text/javascript">
	var SUBPAGE_PROFILE_success="<?=$success?>";
</script>



