


<?php 
	$previous = array(
	"Contact"=>"contact/messaging?focus=".rand()."#contact"
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Find An Agent'))?>
	
<div class="container page-min-height margin-top PAGE_USER_LIST">
	<div class="row">
		<div class="col-lg-12">
			<h2>
				Find An Agent
			</h2>
			
			<div class="row">
				<div class="col-lg-6 col-xs-12 col-md-8 col-sm-9">
					<div class="white-trans border-radius keyword-container">
						<form action="contact/agents" method="get" onsubmit="validate_user_search()">
							<div class="row">
								<div class="col-lg-12">
									<strong>Keyword(s)</strong>
								</div>
		
								<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
										<input name="keyword" class="form-control watermark" type="text" mark="Search By Username/Contact No./Agency" value="<?php if(isset($_GET["keyword"])) echo $_GET["keyword"]?>">
								</div>
							</div>
							<div class="row margin-top">
								<div class="col-lg-9 col-sm-9">
									<label class="showonline"><input class="checkbox-orange" name="showonline" id="showonline" type="checkbox" value="1" <?php if(isset($_GET["showonline"]) && $_GET["showonline"]) echo "checked"?>> <label class="showonline icons" for="showonline">Show Online Agent Only</label></label>
								</div>
								
								
								<div class="col-lg-3 col-sm-3">
									<button type="submit" class="btn-amber btn btn-block btn-lg">
										Search
									</button>
								</div>
							</div>	
						</form>	
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<h2 style="margin-top:30px;margin-bottom:15px;">
				<small class="black-font">Found Agent(s)</small>
			</h2>
		</div>
		
		
	</div>

	
	<?php if(count($agents)>0):?>
	<div class="row users-container">
		
		<div class="col-lg-12 position-relative table-responsive">
			<img class="page-shadow top" src="image/discussion_shadow_top.png">
			<img class="page-shadow bottom" src="image/discussion_shadow_bottom.png">
			<table class="table table-condensed users-table my-table">
              <thead>
                <tr>
                  <th></th>
                  <th>Username</th>
                  <th>Agency</th>
                  <th class="text-center">Contact No.</th>
		          <th class="text-center">Total Posting(s)</th>
		          <th class="text-center">Review(s)</th>
		          <th class="text-center">Level</th>
		          <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
              	 <?php foreach($agents as $user):?>
              	   <tr>	 
              	 	 <td class="user-image">
              	 	 	<img src="<?=get_user_profile_pic($user->id)?>">
              	 	 </td>
              	 	 <td>
              	 	 	<strong><?=generate_username_control($user->id,$user->username,false,"unknown",999,false,true)?></strong>
              	 		<div class="user-status user-state icons inline-block vertical-bottom big <?php if($user->isonline) echo "online";else echo "offline"?>" userid="<?=$user->id?>"></div>
              	 	 
              	 	 </td>
              	 	 
              	 	
              	 	 
              	 	 
              	 	 <td class="bold">
              	 	 	<span><?=$user->agency?></span>
              	 	 </td>
              	 	 <td class="text-center">
              	 	 	<?php if($user->canseephone):?>
              	 	 	<span><?=$user->phone?></span>
              	 	 	<?php else:?>
              	 	 	<span><em>Hidden</em></span>	
              	 	 	<?php endif?>
              	 	 </td>
              	 	 <td class="text-center">
              	 	 	<a href="posting/view/<?=$user->id?>" target="_blank"
              	 	 		<span class="counter-bubble-container pointer-cursor" data-toggle="tooltip" title="Click to see all posting(s) by this agent."><?=$user->totalpostings?>
              	 	 		</span>
              	 	 	</a>
              	 	 </td>
              	 	 <td class="text-center">
              	 	 	
              	 	 	<?=$this->load->view("user_controls/comment_total_number",Array("userID"=>$user->id,"commend"=>$user->good_comment_count,"report"=>$user->bad_comment_count))?>
              	 	 	
              	 	 	
              	 	 </td>
              	 	 <td class="text-center transformers user-level">
              	 	 	<span><?=$user->level?></span>
              	 	 </td>
              	 	 <td class="text-center">
              	 	 	<div class="message-contact icons" data-toggle="tooltip" title="Message This User" onclick="open_circle(true,<?=$user->id?>,'<?=$user->username?>','open',event)"> 
						
						</div>
              	 	 </td>
              	   </tr>	 
              	 <?php endforeach?>	
                           	
              </tbody>
           </table> 
		 </div>
		
	 </div>
 	 <?php else:?>
		 <h4 style="padding-left:30px;">No result found....</h4>
	 <?php endif?>	
	<div class="row">
	
		<div class="col-xs-12 text-center page-links margin-top">
			<?php echo $pagination; ?>
			
			
			
		</div>
	</div>
	
	<div class="row">
	<?php if($totalcount>0):?>
		<div class="col-xs-12 text-center margin-top">
			<span class="total-count bold">
				Showing <?=$start+1?>-<?php if(($start+$limit)<$totalcount) echo $start+$limit; else echo $totalcount;?> of <?=concat_if_plural(" agent","s",$totalcount)?>
			</span>
		</div>
		
	<?php endif?>
	</div>
	
</div>




