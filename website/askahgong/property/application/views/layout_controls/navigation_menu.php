<?php 
	
	
	function push_menu(&$menu_list,$name,$url,$img,$alias,$icon=null){
		$menu = new stdClass();
		$menu -> name = $name;
		$menu -> url = $url;
		$menu -> img = $img;
		$menu -> alias = $alias;
		if(isset($icon)) $menu -> icon = $icon;
		array_push($menu_list , $menu);
		return $menu;
	}
	
	function push_submenu(&$menu_list,&$menu,$name,$url,$icon=null){
		$sub_menu = new stdClass();
		$sub_menu -> name = $name;
		$sub_menu -> url = $url;
		if(isset($icon)) $sub_menu -> icon = $icon;
		if(!isset($menu -> submenus)) $menu -> submenus = Array();
		array_push($menu -> submenus , $sub_menu);
	}


	

	
		$menu_list = Array();
		
		if((isset($userlogin) && ($userlogin)==true)){
			$menu = push_menu($menu_list,"Dashboard","activity","dashboard.png","profile");
			
			
			
			push_submenu($menu_list,$menu,"My Activity","activity","activity-icon");
			if($isAgent){
				push_submenu($menu_list,$menu,"My Review","agent_comment/view","profile-icon");
			}
			push_submenu($menu_list,$menu,"My Profile","profile","profile-icon");
			if($isAgent){
				push_submenu($menu_list,$menu,"My Sales Lead","pending_item/listing","profile-icon");
			}
			push_submenu($menu_list,$menu,"My Posting","posting/view","mypostings-icon");
			
			push_submenu($menu_list,$menu,"My Settings","settings","mysettings-icon");
			push_submenu($menu_list,$menu,"My Shortlist","shortlist/view","myshortlists-icon");
			push_submenu($menu_list,$menu,"My Notification","notification","mynotifications-icon");
		}
		
		
		
		if((isset($userlogin) && ($userlogin)==true)){
			$menu = push_menu($menu_list,"Contacts","contact/messaging?focus=".rand()."#contact","contact.png","contact");
			push_submenu($menu_list,$menu,"Messaging","contact/messaging?focus=".rand()."#contact","messaging-icon");
		}
		else{
			$menu = push_menu($menu_list,"Contacts","contact/agents","contact.png","contact");
		}
		push_submenu($menu_list,$menu,"Find An Agent","contact/agents","agent-icon");
		
		
		
		
		$menu = push_menu($menu_list,"Search","search","search.png","search","search-icon");
		push_submenu($menu_list,$menu,"Buying","search");
		push_submenu($menu_list,$menu,"Selling","search?action=0");
		
		$menu = push_menu($menu_list,"Discussion","discussion","discussion.png","discussion","discussion-icon");
		push_submenu($menu_list,$menu,"General","discussion/listing/2");
		push_submenu($menu_list,$menu,"Feedback","discussion/listing/1");
		push_submenu($menu_list,$menu,"New Topic","discussion/newtopic");
	
		
		$menu = push_menu($menu_list,"New Post","posting/newpost","newpost.png","inputpost","newpost-icon");
		push_submenu($menu_list,$menu,"Selling","posting/newpost?action=0");
		push_submenu($menu_list,$menu,"Buying","posting/newpost?action=1");
		
		
		$menu = push_menu($menu_list,"About Us","about","about.png","about","about-icon");
		push_submenu($menu_list,$menu,"Introduction","about/title/introduction");
		push_submenu($menu_list,$menu,"Features","about/title/features");
		push_submenu($menu_list,$menu,"Website","about/title/website");
		push_submenu($menu_list,$menu,"SMS/Whatsapp","about/title/sms");
		
		if((isset($userlogin) && ($userlogin)==true)){
			$menu = push_menu($menu_list,"Logout","user/submit_logout","logout.png","logout","logout-icon");	
		}
		else{
			$menu = push_menu($menu_list,"Login/Register","user/login","login.png","login","login-icon");	
		}
			
		
	



?>

		  	

	<div class="content left visible-lg col-lg-8" style="padding-left:6px;">
		
			
		
		
		
	  	<ul class="nav navbar-nav">
	  		<?php foreach($menu_list as $menu):?>
	  			
	  			<li class="<?php if($active==$menu -> alias) echo "active"?>">
	  				
	  					  				
					<a href="<?=$menu -> url?>">
						<div><?=$menu -> name?></div><img src="image/<?=$menu -> img?>">
					</a>
					
					<?php if(isset($menu->submenus)):?>
	  				<div class="sub-menu">
	  					<?php foreach($menu->submenus as $submenu):?>
	  						<a href="<?=$submenu->url?>">
								<div class="menu-item">
									<?=$submenu->name?>
								</div>
							</a>
	  					<?php endforeach?>
	  				</div>
	  				<?php endif?>	
	  				
	  			</li>	
	  			

  				<div class="icons separator-dot left">
  					
  				</div>
	  			
	
	  		<?php endforeach?>	
	  	</ul>
	 </div><!-- /.content -->
	 
	 <div class="left hidden-lg col-xs-7 col-md-5 col-sm-4">
	 	<button class="btn button-goto btn-block">
	 		<div class="inline-block">
	 				<div class="icons"></div>
	 				<div class="text left hidden-xs">Go To</div>
	 		</div>
	 	
	 	</button>
	 </div>
	 
	 <div class="phone-style-menu">
	 	<div class="content">
	 		
	 	
	 		
	 		<?php foreach($menu_list as $menu):?>
	 			<?php if(isset($menu->icon)):?>
	 	
	 			<a href="<?=$menu->url?>">
				  <div class="menu-item">
				  		<div class="icons <?=$menu->icon?>">
						</div>
					    <div class="text">
						 	<?=$menu->name?>
					    </div>
				  </div>
				</a>
	 			<?php endif?>
	 			<?php if(isset($menu->submenus)):?>
	  					<?php foreach($menu->submenus as $submenu):?>
	  						<?php if(isset($submenu->icon)):?>
				 			<a href="<?=$submenu->url?>">
							  <div class="menu-item">
							  		<div class="icons <?=$submenu->icon?>">
									</div>
								    <div class="text">
									 	<?=$submenu->name?>
								    </div>
							  </div>
							</a>
				 			<?php endif?>
	  					<?php endforeach?>
	  				<?php endif?>	
	 		<?php endforeach?>	
	 		
	 	
		</div>
	 </div>	
	 










