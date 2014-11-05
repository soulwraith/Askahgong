<!DOCTYPE html>
<!--head-->
<head>
	

<base href="<?=base_url();?>">

<?=$this->load->view("user_controls/meta_generator")?>










<link href='http://fonts.googleapis.com/css?family=Archivo+Black' rel='stylesheet' type='text/css'>


	
	
	


	
	


		
		






	
	
		
		
	
	
	
	
		
	
	
	
	
	
	
	
	
	




<link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon" /> 
</head><link type="text/css" href="css/all_8_4.css" rel="stylesheet" media="screen"> 

  	


<nav class="navbar navbar-fixed-top" role="navigation">
  <div class="">
	  <div class="navbar-header col-lg-2 col-xs-5 col-md-3 col-sm-3">
	  	<a href="#" title="Ask Ah Gong Property">
		      <div class="logo icons">
		      	
		      	 <div class="grass icons hidden-xs">
		      	 	
		      	 </div>
		      	 
		      	 <div class="sun icons hidden-xs">
		      	 	
		     	 </div>
		      	 <div class="smoke one icons hidden-xs">
		      	
			      </div>
			      <div class="smoke two icons hidden-xs">
			      	
			      </div>
			      <div class="smoke three icons hidden-xs">
			      	
			      </div>
		      </div>
		     
		      
		    
		      <div class="separator icons hidden-xs">
		      	
		      </div>
	     </a> 
	      
	  </div>
	
	  <?=$this->load->view("layout_controls/navigation_menu")?>
	 
	 
	 <?php if((isset($userlogin) && ($userlogin)==true)): ?>
		 
	  <div class="col-lg-2 col-xs-4 col-md-4 col-sm-5 hidden-xs" style="padding:0px">
			 <div class="right notifications position-relative">
		  		<div class="background">
		  			
		  		</div>
		  		<div class="text-center inner pointer-cursor">
			  		<span class="welcome">Welcome</span>
			  		<br>
			  		<div class="inline-block">
			  			
			  			<div class="user-image-container">
			  				<img class="user-image" src="<?=get_user_profile_pic(get_userid(),"image/usernoimage2.png")?>">
			  			</div>
			  			
				  		<div class="notification-counter-container total-notification-counter">
				  			<div class="notification-counter animate icons">
					  			<div class="inner">
					  				0
					  			</div>
					  			
					  		</div>
				  		</div>
				  		
			  		</div>
			  		
			  		<br>
			  		<div class="welcome-container overflow-ellipsis inline-block">
			  			<span class="welcome">
				  			<?=$username?>
				  		</span>
			  		</div>
			  		
		  		</div>
		  		
		  		<div class="notification-menu hidden-object">
		  			<?php $arr=Array("discussion-reply"=>"Topic Reply","new-item"=>"Item Alert","agent-request"=>"Agent Request","agent-review"=>"Agent Review")?>
		  			<?php $arr_url=Array("notification#showall","notification#showitem")?>
		  			
		  			<?php if($isAgent):?>
		  				<?php array_push($arr_url,"pending_item/listing","agent_comment/view")?>
		  			<?php else:?>
		  				<?php array_push($arr_url,"posting/view","")?>
		  			<?php endif?>
		  			
		  			<?php $i=0;?>
		  			<?php foreach($arr as $x=>$x_value):?>
		  			<div class="item switching <?=$x?>" type="<?=$x?>">
		  				
		  				<div class="item-background"></div>
						
						<div class="pointing-arrow icons"></div>
						
	  					<div class="inner"><?=$x_value?></div>
	  					
	
		  				
		  				<div class="notification-counter-container" style="position:absolute;right:-2px;top:-1px;">
				  			<div class="notification-counter icons">
					  			<div class="inner">
					  				<?php if($x=="discussion-reply"):?>
					  				<?=$new_notifications_count->replyyourtopic+$new_notifications_count->replytopic?>
					  				<?php elseif($x=="agent-request"):?>
					  				<?=$new_notifications_count->agentRequest+$new_notifications_count->acceptAgent?>
					  				<?php elseif($x=="agent-review"):?>
					  				<?=$new_notifications_count->agentReview?>
					  				<?php else:?>
					  				<?=$new_notifications_count->newitem?>
					  				<?php endif?>
					  			</div>
					  			
					  		</div>
				  		</div>
				  		<div class="notification-popup">
					  			
				  			<div class="content">
				  				
				  			</div>
				  			
				  			<a href="<?=$arr_url[$i]?>" target="_blank">
					  			<div class="view-all">
						  			View All
						  		</div>
					  		</a>
				  			
				  		</div>
				  		
		  			</div>	
		  			<?php $i++;?>
		  			<?php endforeach?>	
		  			
		   		</div>
		  	</div>		
	  	    
	  	   
	 
	  		
	  	
		  	<div class="right shortlist-container hidden-xs">
		  		<div class="shortlist icons">
		  			
		  			<div class="notification-counter-container">
			  			<div class="notification-counter animate icons">
				  			<div class="inner">
				  				<?=$shortlist_modified_totalcount?>
				  			</div>
				  			
				  		</div>
			  		</div>
		  			
		  			<div class="shortlist-popup-container notification-popup-container">
			  			<div class="shortlist-popup notification-popup">
			  				<div class="content">
			  					
			  				</div>
			  				<a href="shortlist/view" target="_blank">
					  			<div class="view-all">
						  			View All
						  		</div>
					  		</a>
			  			</div>
			  		</div>
		  			
		  			<div class="total-shortlist">
			  			<?=$shortlist_totalcount?>
			  		</div>
		  		</div>
		  		
		  		<div class="separator icons" style="width:2px;">
		      	
		    	</div>
		  	</div>
	  	</div>
	 
	 <?php else:?>
	 	<div class="col-lg-2 hidden-xs" style="padding:0px;">
	 		<a href="<?=url("about_sms","#faq_post")?>" target="_blank">
	 			<div class="phone-box-container">
		 			<div class="phone-box icons">
		 				<div class="bg">
		 					
		 				</div>
		 			</div>
		 			<div class="separator icons">
		 				
		 			</div>
		 		</div>
	 		</a>
	 		
	 		
	 	</div>
	 
	 <?php endif?>
	 
	 
  </div>
  <img class="navbar-background" alt="topmenu" src="image/topmenubar.jpg">
</nav>


<?php 
	switch($active){
		
		case "contact":
			$banner="messaging";
		break;
		case "login":
			$banner="login";
		break;
		case "discussion":
			$banner="discussion";
		break;
		case "about":
			$banner="about";
		break;
		default:
			$banner="general";
		break;	
	}



?>

<?php if(!contain_string($attrs,"no-banner")):?>
<div class="visible-lg">
	<img class="page-banner" alt="search" src="image/banner/<?=$banner?>.jpg">
</div>
<?php endif?>

<?php if((isset($userlogin) && ($userlogin)==true)):?>
	
	<?php $onlinecount=0;$totalcontact=0?>
	<?php foreach($contacts as $contact):?>
		<?php 
			$totalcontact++;
			if($contact->isonline) $onlinecount++;
		?>
	<?php endforeach?>

	
	<div class="fixed-bottom-bar hidden-xs">
		<div class="fixed-contact-list">
			<div id="new-message-bubble" data-toggle="tooltip" title="You have unread offline messages, click to view.">
				
			</div>
			<div class="header">
			
				<span class="total-online"><?=$onlinecount?></span>/<span class="total-contact"><?=$totalcontact?></span>
			
				<div class="inline-block vertical-bottom icons user-status online" title="Your contacts list">
					
				</div>
			</div>
			
			<img class="contact-listing-shadow" src="image/discussion_shadow_bottom.png">
			<div class="contact-listing-container">
				<div class="contacts contacts-listing">
					<?=$this->load->view("layout_controls/contact_listing_set")?>
				</div>
				
			</div>
			
			<div class="contact-searchbox-container">
				<?=$this->load->view("user_controls/contact_searchbox",Array("container"=>"contact-listing-container","child"=>"contacts-listing"))?>
				<img class="contact-searchbox-shadow" src="image/discussion_shadow_top.png">
			</div>
			<img class="contact-shadow top" src="image/discussion_shadow_top.png">
		</div>	
		
		<div class="messaging-to-store" ready="0">
			<div class="fixed-messaging">
				
				
			</div>	
			
			<div class="fake-border">
						
			</div>
			
			<div class="more-circle-container transition hidden-object">
				<span onclick="toggle_more_circle(event)">	
					<div class="more-circle">
						<img src="image/more_circle.png">
					</div>
					<div class="notification-count amber more-circle-notification icons">0</div>
					<div class="username-box overflow-ellipsis">
						&lt;&lt; More<span class="more-circle-count"></span>
						<img class="username-shadow top" src="image/discussion_shadow_top.png">
						
					</div>
				</span>
				<div class="more-circle-menu hidden-object">
	
				</div>
			</div>
			
		
		</div>
			
	</div>

<?php endif?>	

		
<script type="text/javascript">
	var MY_USERID="<?=get_userid()?>"
	var global_baseurl = "<?php echo base_url(); ?>";
	var MY_USERNAME="<?php if(isset($username)) echo $username?>"
	var URI_STRING = "<?php echo uri_string()?>"
	var JQUERY_CALLBACK=[];
	var TAB_IDENTIFIER = Math.random().toString(36).slice(2);
	
	<?php if (defined('ENVIRONMENT')):?>
		  <?php if(ENVIRONMENT=="production" || ENVIRONMENT=="testing"):?>
		  	   var IN_PRODUCTION = true;
		  <?php elseif(ENVIRONMENT=="development"):?>
		  	var IN_PRODUCTION = false;
		  <?php endif?>
	<?php endif?>
	
	<?php if(isset($unread_points_id)):?>
		<?php foreach($unread_points_id as $model):?>
			JQUERY_CALLBACK.push(function(){
				queue_reward(<?=$model->id?>);
				
			})
		<?php endforeach?>
	<?php endif?>
	JQUERY_CALLBACK.push(function(){
		pop_reward();
		<?php if(isset($admin) && $admin):?>
		$.getScript("<?=base_url();?>/javascript/pubnub_related_admin.js", function(){
			$.getScript("<?=base_url();?>/javascript/admin/all_admin_script.js", function(){
			});
		});
		<?php endif?>
	})
</script>


<div id="body">
