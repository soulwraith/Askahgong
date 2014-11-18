


<?php 
	$previous = array();
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Login/Register'))?>

<div class="container padding-equal-20 white-trans border-radius margin-top position-relative main-page PAGE_LOGIN">
	
	<div class="row">
		<div class="col-xs-12">
			
			<?=$this->load->view("layout_controls/alert",Array("alert_type"=>"info",
					"alert_html"=>"<strong>Q: Why do we register your number?</strong> Ask Ah Gong needs your number to notify you of property opportunities based on your request and user’s message. 
									<br><strong>Q: Will we spam you?</strong> No. In fact, it is default that we don’t send you anything unless you request for it.  
									<br><strong>Q: Will we compromise your number?</strong> No. Your privacy is our utmost concern."))
				?>
			
			
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-6 col-sm-12">
			
			<form class="customform selected" id="loginform" method="post" onsubmit="login();return false;">	
				<div class="form-container">
					<img class="form-bg border-radius" src="image/loginform_bg.jpg">
					<div class="form-title">LOGIN</div>	
					<div id="loginalert" style="position:relative;">
					  	 
					</div>
					
					 <div class="form-group clearfix">
	
				 		<label for="selectCountry1" class="col-xs-3 control-label">Country</label>
					    <div class="col-xs-9 form-control-container">
					      <div class="styled-select"> 
						      <select class="form-control" id="selectCountry1" name="country" onchange="document.getElementById('countrycode1').value=this.value;document.getElementById('countrycodespan').innerHTML=this.value;">
								<option value="+60">Malaysia</option>
								<option value="+65">Singapore</option>
							  </select>
						  </div>
					    </div>
	
					  </div>
					  
					  <div class="form-group clearfix">
	
				 		<label for="countrycode1" class="col-xs-3 control-label">Phone</label>
					    <div class="col-xs-9 form-control-container">
					      <div class="col-xs-4 col-sm-2 col-md-3 col-lg-2 form-control-container">
					      	   <input type="text" class="countrycode form-control" name="countrycode" id="countrycode1" disabled="disabled" value="+60"> 
					      </div>
					      <div class="col-sm-1 phone-seperator hidden-xs">
					      	-
					      </div>
					      <div class="col-xs-8 col-sm-9 col-md-8 col-lg-9 form-control-container">
					      	    <input class="form-control" type="text" name="phone" id="phone1" autocomplete="off">
					      </div>
					    </div>
	
					  </div>
		
					  
					  
					  <div class="form-group clearfix">
	
				 		<label for="password1" class="col-xs-3 control-label">Password</label>
					    <div class="col-xs-9 form-control-container">
					      <input class="form-control" type="password" name="password" id="password1">
					    </div>
	
					  </div>
				</div>
				
				  
				
				  <div class="col-xs-12 col-sm-6 margin-top">
				  	<label class="forcheckbox"><input class="checkbox-orange" id="remember" type="checkbox" value="remember"> <label class="forcheckbox icons" for="remember">Remember Me</label></label>
				  </div>
				  
				  
				  	
				  <div class="right text-center">
				  
						<input class="btn-orange grey-bg" type="submit" value="Login" id='submitlogin'>
						<br>
						<a href="about/title/website#faq-acc_lost" target="_blank" class="no-underline">
							<div class="icons question-hover" data-toggle="tooltip" title="Account lost? Click to get more details" data-placement="left"></div>
						</a>
						
						<a class="forgotpassword" href="javascript:void(0);" onclick="$(this).prev('a').remove();$(this).remove();$('div.forgotpassword').show();">Forgot Password</a>
				  	
				  </div>
				  <div class="clear"></div>
				  <div class="right">
				  
						<div  class="forgotpassword hidden-object" style="width:215px;">
				  			Please pick the preferred method to reset your password.
				  			<div class="reset-method" data-toggle="modal" data-target="#emailreset">
				  				<div class="icons email" data-toggle="tooltip" title="By Email" data-placement="bottom">
				  				
				  				</div>
				  			</div>
				  			<div class="reset-method" data-toggle="modal" data-target="#smsreset">
				  				<div class="icons sms" data-toggle="tooltip" title="By SMS" data-placement="bottom">
				  				
				  				</div>
				  			</div>
				  			
				  		</div>
				 </div>
			
				<div class="clear"></div>
			</form>
		</div>
		
		<div class="or-circle-outer grain-bg visible-lg">
			
		</div>
		<div class="or-circle visible-lg">
			OR
		</div>
		
		<div class="col-md-6 col-sm-12 position-relative">
			
			
			<form id="registerform" name="registerform" method="post" class="customform" onsubmit="register();return false;">
				<div class="form-container">
					<img class="form-bg border-radius" src="image/loginform_bg.jpg">
					<div class="form-title">REGISTER</div>	
					<div id="registeralert" style="position:relative;">
				  	 
				    </div>
					
					 <div class="form-group clearfix">
	
				 		<label for="selectCountry2" class="col-xs-3 control-label">Country</label>
					    <div class="col-xs-9 form-control-container">
					      <div class="styled-select"> 
						      <select class="form-control" id="selectCountry2" name="country" onchange="document.getElementById('countrycode2').value=this.value;">
								<option value="+60">Malaysia</option>
								<option value="+65">Singapore</option>
							  </select>
						  </div>
					    </div>
	
					  </div>
					  
					  <div class="form-group clearfix">
	
				 		<label for="countrycode2" class="col-xs-3 control-label">Phone</label>
					    <div class="col-xs-9 form-control-container">
					      <div class="col-xs-4 col-sm-2 col-md-3 col-lg-2 form-control-container">
					      	   <input type="text" class="countrycode form-control" name="countrycode" id="countrycode2" disabled="disabled" value="+60"> 
					      </div>
					      <div class="col-xs-1 phone-seperator hidden-xs">
					      	-
					      </div>
					      <div class="col-xs-8 col-sm-9 col-md-8 col-lg-9 form-control-container">
					      	    <input class="form-control" type="text" name="phone" id="phone2" autocomplete="off">
					      </div>
					    </div>
	
					  </div>
		
					  
					  
					  <div class="form-group clearfix">
	
				 		<label for="password2" class="col-xs-3 control-label">Password</label>
					    <div class="col-xs-9 form-control-container">
					      <input class="form-control" type="password" name="password" id="password2">
					    </div>
	
					  </div>
					  
					  
					  <div class="form-group clearfix">
	
				 		<label for="retypeuserpassword" class="col-xs-3 control-label" style="padding-top:11px;">Retype Password</label>
					    <div class="col-xs-9 form-control-container">
					      <input class="form-control" id="retypeuserpassword" name="retypeuserpassword" type="password">
					    </div>
	
					  </div>		  
					  
					  
				</div>
				
				  
				
				  <div class="col-xs-12 margin-top">
				  	<label class="forcheckbox"><input class="checkbox-orange" id="terms" name="terms" type="checkbox"> <label class="forcheckbox icons" for="terms">I have read and accepted the <a href="terms">User Agreement</a> and the terms and policies incorporated by reference.</label></label>
				  </div>
				  
				  
				  	
				  <div class="right text-center">
				  		
				  		<input id="submituser" class="btn-orange grey-bg" type="submit" value="Register">
				  	
				  </div>
				  
				
				
		
				
				<div class="clear"></div>
			</form>
			
			<form class="otpform customform hidden-object" onsubmit="otp_matching();return false;">
			  <div class="form-title" style="color:white;">Please input the OTP value that will be sent to your phone.</div>	
			  <div class="form-group clearfix">
	
		 		<label for="otp" class="col-xs-3 control-label">OTP</label>
			    <div class="col-xs-9 form-control-container">
			      <input class="form-control" id="otp" name="otp" type="text">
			    </div>

			  </div>
				
		   	   <div class="text-center">
		   	     	<input class="btn btn-default btn-lg" type="submit" value="Submit">
		   	   </div> 
		   	    
		   	    
			</form>
			
			
		</div>
		
		
		
	</div>
	
	
	<!-- Modal -->
	<div class="modal reset-method-modal fade hidden-object" id="emailreset" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<div class="icons email">
	      		
	      	</div>
	        <span class="modal-title">Password Reset</span>
	      </div>
	      <div class="modal-body">
	      	<div id="resetpasswordalert" class="">
						  	 
		    </div>
	      	<form class="customform resetform" onsubmit="submit_reset();return false;">	
	         <div class="form-group clearfix">

		 		<label for="selectCountry3" class="col-xs-3 control-label">Country</label>
			    <div class="col-xs-9 form-control-container">
			      <div class="styled-select"> 
				      <select class="form-control" id="selectCountry3" name="country" onchange="document.getElementById('countrycode3').value=this.value;">
						<option value="+60">Malaysia</option>
						<option value="+65">Singapore</option>
					  </select>
				  </div>
			    </div>

			  </div>
			  
			  <div class="form-group clearfix">

		 		<label for="countrycode3" class="col-xs-3 control-label">Phone</label>
			    <div class="col-xs-9 form-control-container">
			      <div class="col-xs-4 col-sm-3 form-control-container">
			      	   <input type="text" class="countrycode form-control" name="countrycode" id="countrycode3" disabled="disabled" value="+60"> 
			      </div>
			      <div class="col-xs-1 phone-seperator hidden-xs">
			      	-
			      </div>
			      <div class="col-xs-8 col-sm-8 form-control-container">
			      	    <input class="form-control" type="text" name="phone" id="phone3" autocomplete="off">
			      </div>
			    </div>

			  </div>
			  
			  <div class="form-group clearfix">

		 		<label for="email3" class="col-xs-3 control-label">Email</label>
			    <div class="col-xs-9 form-control-container">
			      <input class="form-control" type="email" name="email" id="email3">
			    </div>

			  </div>
			  
			  <div class="form-group" style="margin-bottom:0px;">
			  	
			      <div class="col-xs-12 col-sm-6">
			  	  	 <button type="button" class="btn btn-gradient-orange btn-block" onclick="$('#emailreset').modal('hide')">
			  	  	 	<div class="icons"></div>
			  	  	 	<span>Back</span>
			  	  	 </button>
			  	  </div>
			  	
			  	  <div class="col-xs-12 col-sm-6 text-center">
			  	  	 <button type="submit" class="btn btn-green btn-block">
			  	  	 	<div class="icons"></div>
			  	  	 	<span>Reset Password</span>
			  	  	 </button>
			  	  </div>
			  	  
			  	 
	       		  <div class="clear"></div>
			  </div>
			  
			
			 </form> 
	      </div>

	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- Modal -->
	<div class="modal reset-method-modal fade hidden-object" id="smsreset" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<div class="icons sms">
	      		
	      	</div>
	        <span class="modal-title">Password Reset</span>
	      </div>
	      <div class="modal-body text-center">
			
			<span class="text1">Please send</span><br> 
			<span class="text2">"resetpw" </span><br> 
			<span class="text1">to </span><br> 
			<span class="text2">+60178761590 </span><br> 
			<span class="text1">using your phone number.</span><br> 
			
			
			
	      	<form class="customform resetform" style="margin-top:15px;">	
	        	
			  <div class="form-group" style="margin-bottom:0px;">
			  	  
			  	  <div class="col-xs-12 text-center">
			  	  	 <button type="button" class="btn btn-gradient-orange btn-block" onclick="$('#smsreset').modal('hide')">
			  	  	 	<div class="icons"></div>
			  	  	 	<span>Back</span>
			  	  	 </button>
			  	  </div>
	       		  <div class="clear"></div>
			  </div>
			  
			
			 </form> 
	      </div>

	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
</div>





