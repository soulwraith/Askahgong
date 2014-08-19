



<?php 
	$previous = array(
	"Contact"=>"contact/messaging?focus=".rand()."#contact"
	
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Messaging'))?>


<div class="container margin-top PAGE_MESSAGING">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
			<div class="left-tabs-container border-radius">
				<div class="left-tabs-header">
					<div class="row position-relative">
						<div class="col-xs-6" style="padding-right:0px;">
							<div class="header selected border-radius-topleft conversation-header" onclick="switch_tab(this,'conversation')">
								<div class="inline-block">
									Conversations
								</div>
								
								<div class="conversation-new-count icons notification-count white inline-block vertical-top" style="display:none">
									0
								</div>
								<div class="clear"></div>
							</div>
							
						</div>
						<div class="col-xs-6" style="padding-left:0px;">
							<div class="header border-radius-topright contact-header" onclick="switch_tab(this,'contact')">
								<div class="inline-block">
									Contacts  
										<div class="icons user-status online inline-block vertical-top"></div> 
										( <span class="total-online">0</span> )
									
								</div>
							</div>
						</div>
						<img class="tabs-shadow top" src="image/discussion_shadow_top.png">
					</div>
				</div>
				
				<div class="fade-separator">
			
				</div>
				
				<div class="left-tabs-content">
					<div class="conversation-list conversation-list-container">
						<?=$this->load->view("layout_controls/conversation_listing")?>
						
					</div>
					
					<div class="contacts contacts-listing hidden-object">
						<?=$this->load->view("layout_controls/contact_listing_set")?>
					</div>
					
					
				</div>
				
				<div class="fade-separator">
			
				</div>
				
				<div class="conversation-list" style="margin-bottom:20px;">
							
				</div>
				
				
				<div class="contacts hidden-object padding-equal" style="margin-top:10px;">
					<?=$this->load->view("user_controls/contact_searchbox",Array("container"=>"left-tabs-content","child"=>"contacts-listing"))?>
				</div>
				
			</div>
			
		</div>
		
		
	
		
		
		<div class="col-lg-9 col-md-8 col-sm-7 hidden-xs non-modal">
			<div class="page-messaging-container border-radius messaging-list-parent">
				<div class="header">
					<div class="row">
						<div class="left" style="margin-left:28px;">
							<div class="image-container">
								<img src="" onerror="this.src='image/usernoimage.png'">
							</div>
						</div>
						<div class="left remove-class-modal" style="padding-right:0px;margin-left:10px;">
							<div class="status">
								<div class="icons inline-block user-status user-state big online">
				
								</div>
							</div>
							
						</div>
						<div class="left remove-class-modal" style="margin-left:10px;">
							<div class="username main-username overflow-ellipsis inline-block">
								<a href="javascript:void(0)" class="force-not-link" target="_blank">
									Pick One User To Start Chat With
								</a>
								
							</div>
							<div class="hidden-object adding-contact-only add-contact inline-block vertical-bottom icons remove-class-modal">
								
							</div>
						</div>
					
					</div>
					<img class="header-shadow top" src="image/discussion_shadow_top.png">
					<div class="fade-separator" style="margin-top:6px;">
						
					</div>
					
					
				</div>
				
				<div class="messaging">
					
				</div>
				
				
			</div>
		</div>
		
		
		  <!-- Modal -->
			  <div class="modal fade" id="messaging-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			      	
			      <div class="modal-content">
			      	<div class="modal-close">
				      	<a href="javascript:void(0)" class="icons close-button" onclick="$('#messaging-modal').modal('hide')"></a>
				     </div>
			        <div class="modal-body">
	
			        </div>
			      	
			      </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			  </div><!-- /.modal -->
		
		
		
	</div>
</div>



<script type="text/javascript">

var PAGE_MESSAGING_onpage,
    PAGE_MESSAGING_getisfriend_xhr=null,
    PAGE_MESSAGING_targetuserid,
    PAGE_MESSAGING_targetusername,
    PAGE_MESSAGING_messagelist;
    PAGE_MESSAGING_unique = 10;

	PAGE_MESSAGING_onpage=true;
	PAGE_MESSAGING_messagelist;
	<?php if(isset($targetuserid) && $targetuserid!=""):?>
	PAGE_MESSAGING_targetuserid="<?=$targetuserid?>";
	PAGE_MESSAGING_targetusername="<?=$targetusername?>";
	<?php endif?>
</script>




