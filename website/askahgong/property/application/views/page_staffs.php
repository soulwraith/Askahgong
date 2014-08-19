


<?php 
	$previous = array();
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Talk to us'))?>

<div class="container page-min-height PAGE_STAFF">
	<div class="row">
		<div class="col-xs-12">
			<h2>
				Talk to us
			</h2>
		</div>
	</div>
	
	<?php foreach($staffs as $staff):?>
	
	
	<div class="row">
		<div class="col-xs-12 col-lg-8 col-md-10 col-sm-11">
			<div class="white-container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
						<img class="img-responsive" src="<?=get_user_profile_pic($staff->id)?>">
					</div>
					<div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
						<div class="row detail">
							<div class="col-sm-2 col-xs-12 detail-title">
								Name
							</div>
							<div class="col-sm-10 col-xs-12 detail-content">
								 <?=generate_username_control($staff->id,$staff->username,false)?>
							</div>
						</div>
						<div class="row detail">
							<div class="col-sm-2 col-xs-12 detail-title">
								Position
							</div>
							<div class="col-sm-10 col-xs-12 detail-content">
								<?=$staff->role?>
							</div>
						</div>
						<div class="row detail">
							<div class="col-sm-2 col-xs-12 detail-title">
								Phone
							</div>
							<div class="col-sm-10 col-xs-12 detail-content">
								<?=$staff->phone?>
							</div>
						</div>
						<div class="row detail">
							<div class="col-sm-2 col-xs-12 detail-title">
								Email
							</div>
							<div class="col-sm-10 col-xs-12 detail-content">
								<a href="mailto:<?=$staff->email?>"><?=$staff->email?></a>
							</div>
						</div>
						<div class="row detail">
							<div class="col-sm-2 col-xs-12 detail-title">
								Status
							</div>
							<div class="col-sm-10 col-xs-12 detail-content">
								<div class="icons user-status user-state <?php if($staff->isonline) echo "online"; else echo "offline";?> inline-block" userid="<?=$staff->id?>"></div>
							</div>
						</div>
						<div class="row detail">
							<div class="col-sm-2 col-xs-12 detail-title">
								Message
							</div>
							<div class="col-sm-10 col-xs-12 detail-content">
								<?=$staff->description?>
							</div>
						</div>
						<div class="row detail">
							<div class="col-xs-12">
								<div class="contact-control <?php if($staff->isfriend) echo "delete-contact"; else echo "add-contact"?> icons right" onclick="handle_contact(this,<?=$staff->id?>,false,event,true,false);"></div>
								<div class="message-contact icons right margin-right" data-toggle="tooltip" title="Message This User" data-placement="auto" onclick="open_circle(true,<?=$staff->id?>,'<?=$staff->username?>','open',event)">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php endforeach?>
	
</div>





