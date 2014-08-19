

<?php
	$breadcrumb_name;
	switch($dashboard_page){
	case "home":
		$breadcrumb_name="Activity";
	break;
	case "profile":
		$breadcrumb_name="Profile";
	break;
	case "posting":
		$breadcrumb_name="Posting";
	break;
	case "shortlist":
		$breadcrumb_name="Shortlist";
	break;
	case "notification":
		$breadcrumb_name="Notification";
	break;
	case "settings":
		$breadcrumb_name="Settings";
	break;
	case "pending_item":
		$breadcrumb_name="Agent Requests";
	break;
	case "agent_comment":
		$breadcrumb_name="Agent Comments";
	break;
}
?>


<?php if($user->id==get_userid()):?>

<?php 
	$previous = array(
	 'My Dashboard' => 'activity'
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>$breadcrumb_name))?>

<?php else:?>
	

<?php 
	$previous = array(
	 $user->username.'&apos;s Dashboard' =>'activity/id/'.$user->id
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>$breadcrumb_name))?>

<?php endif?>

<div class="container margin-top dashboard-container PAGE_DASHBOARD">
	<div class="row">
		<div class="col-md-4 col-sm-5 col-lg-3">
			<?=$this->load->view("layout_controls/dashboard_details")?>
		</div>
		<div class="col-md-8 col-sm-7 col-lg-6">
			<div class="dashboard-menu-container hidden-xs">
				<div class="menu-arrow previous icons" onclick="switch_dashboard_menu_page('prev')"></div>
				<div class="menu-arrow next icons" onclick="switch_dashboard_menu_page('next')"></div>
				<?=$this->load->view("layout_controls/dashboard_menu",Array("type"=>"normal"))?>
			</div>
			<div class="position-relative content-container">
				<div class="visible-xs">
					<div class="row dashboard-menu-select-container">
						<div class="col-xs-12">
							<?=$this->load->view("layout_controls/dashboard_menu",Array("type"=>"smallscreen"))?>
						</div>
					</div>
					
				</div>
			
				<div class="inner">
					<?php
						switch($dashboard_page){
						case "home":
							echo $this->load->view("dashboard_subpage/activity");
						break;
						case "profile":
							echo $this->load->view("dashboard_subpage/profile");
						break;
						case "posting":
							echo $this->load->view("dashboard_subpage/posting_and_shortlist");
						break;
						case "shortlist":
							echo $this->load->view("dashboard_subpage/posting_and_shortlist");
						break;
						case "notification":
							echo $this->load->view("dashboard_subpage/notification");
						break;
						case "settings":
							echo $this->load->view("dashboard_subpage/settings");
						break;
						case "pending_item":
							echo $this->load->view("dashboard_subpage/pending_item");
						break;
						case "agent_comment":
							echo $this->load->view("dashboard_subpage/agent_comment");
						break;
					}
					?>
				</div>
			</div>
		</div>
		
		
		<div class="clear hidden-lg" style="height:50px;"></div>
		<div class="col-md-4 col-sm-5 col-lg-3 hidden-xs">
			<?php if($user->id==$this->session->userdata("userid")):?>
			<div class="grey-box">
				<div class="header">
					Latest Post(s) By Your Contact(s)
				</div>
				
				<div class="fade-separator">
					<img class="fade-shadow" src="image/discussion_shadow_top.png">
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="item-listing-vertical-container contacts-post">
							<img class="margin-left" src="image/loading3.gif"/>
						</div>
						
					</div>
				</div>
				
			</div>
			
			
			<div class="grey-box margin-top">
				<div class="header">
					Most Popular Posts
				</div>
				
				<div class="fade-separator">
					<img class="fade-shadow" src="image/discussion_shadow_top.png">
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="item-listing-vertical-container popular-post">
							<img class="margin-left" src="image/loading3.gif"/>
						</div>
						
					</div>
				</div>
			</div>
			<?php else:?>
			<div class="grey-box">
				<div class="header">
					Lastest Post(s) By <div class="overflow-ellipsis vertical-bottom inline-block" style="width:100px;"><?=$user->username?></div>
				</div>
				
				<div class="fade-separator">
					<img class="fade-shadow" src="image/discussion_shadow_top.png">
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="item-listing-vertical-container user-post">
							<img class="margin-left" src="image/loading3.gif"/>
						</div>
						
					</div>
				</div>
			</div>
			<?php endif?>	
		</div>
	</div>
</div>


<script type="text/javascript">
	var PAGE_DASHBOARD_userid="<?=$user->id?>";
	var dMenuGroup = [];
</script>





