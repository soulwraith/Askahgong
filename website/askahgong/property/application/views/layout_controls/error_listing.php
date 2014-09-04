<?php foreach($errorsdata as $error):?>
	<div class="error-item <?php if($error->handling) echo "handling"?>" error_id="<?=$error->id?>" onclick="me_handling_error(<?=$error->id?>)">
		
		<div class="handling-username" onclick="eventStopPropagation(event);me_cancel_handling_error(<?=$error->id?>)"><?=$error->handling?></div>
		
		<?php if($error->smsorweb=="4"):?>
		<div>
			<div>
				<h4 class="left">Agent Verification</h4>
				<div class="btn-toolbar right">
				  <div class="btn-group btn-group-xs">
				  	  <a class="btn btn-danger" onclick="update_learning(this,'prompt','Why reject?','12')" processid="<?=$error->id?>" smsorweb="<?=$error->smsorweb?>" href="javascript:void(0)"><strong>Reject</strong></a>
				  	  <a class="btn btn-success" onclick="update_learning(this,'confirm','Confirm accept?','13')" processid="<?=$error->id?>" smsorweb="<?=$error->smsorweb?>" href="javascript:void(0)"><strong>Accept</strong></a>
				  </div>
				  
				  
				  
				  
				</div>
				<div class="clear"></div>
			</div>
			<div>
				Agency : <textarea class="form-control" onchange="update_user_text(<?=$error->id?>,this)"><?=$error->text?></textarea>
			</div>
			<div class="margin-top">
				<?=generate_username_control($error->userid,$error->username,true)?>
			</div>
			
		</div>
		
		<?php elseif($error->smsorweb=="5"):?>
		<div>
			<?php $arr = explode("(%2)",$error->text)?>
			<div>
				<h4 class="left">Agent Review Report</h4>
				<div class="btn-toolbar right">
				  <div class="btn-group btn-group-xs">
				  	  <a class="btn btn-danger" onclick="reject_report_agent_review(this,<?=$arr[0]?>,<?=$arr[1]?>,<?=$arr[2]?>)" processid="<?=$error->id?>" smsorweb="<?=$error->smsorweb?>" href="javascript:void(0)"><strong>Reject</strong></a>
				  	  <a class="btn btn-success" onclick="accept_report_agent_review(this,<?=$arr[0]?>,<?=$arr[1]?>,<?=$arr[2]?>)" processid="<?=$error->id?>" smsorweb="<?=$error->smsorweb?>" href="javascript:void(0)"><strong>Delete Reported Comment</strong></a>
				  </div>
				  
				  
				  
				  
				</div>
				<div class="clear"></div>
			</div>
			<div>
				<a target="_blank" href="<?=$arr[3]?>">Link</a>
			</div>
			<div class="margin-top">
				Reported comment by <?=generate_username_control($error->userid,$error->username,true)?>
			</div>
			
		</div>
		
		
		<?php else:?>
		
		<div>
				
			
				<?php 
					$sentence=$error->text;
					if(isset($error->serverrespond) && $error->serverrespond!=""){
						$tmparr=explode("|",$error->serverrespond);
						$convertsentence=str_replace("convert->","",$tmparr[0]);
						$unknownnouns=str_replace("unknownnoun->","",$tmparr[1]);
						$unknownverbs=str_replace("unknownverb->","",$tmparr[2]);
						$lackedcolumn=str_replace("lacked->","",$tmparr[3]);
						$insertcolumn=str_replace("insertingcolumn->","",$tmparr[4]);
						$tokenizedarr=explode("(%2)",str_replace("tokenizedarr->","",$tmparr[5]));
						$postagarr=explode("(%2)",str_replace("postagarr->","",$tmparr[6]));
					
					}
				?>
				
				
				
				<div>
					<h4 class="left"><?php if($error->smsorweb==0) echo "SMS"; else if($error->smsorweb==1) echo "Website Insert"; else if($error->smsorweb==3) echo "Website Search Suggest";?></h4>
					<div class="btn-toolbar right">
					  <div class="btn-group btn-group-xs">
					  	<?php if($error->userid):?>
						  	<?php if(!$error->awarded_location):?>
						  	<a class="btn btn-primary" onclick="award_from_learning(<?=$error->userid?>,<?=$error->id?>,'location',this)" processid="<?=$error->id?>" href="javascript:void(0)"><strong>+Location</strong></a>
						  	<?php endif?>
						  	<?php if(!$error->awarded_facility):?>
						  	<a class="btn btn-primary" onclick="award_from_learning(<?=$error->userid?>,<?=$error->id?>,'facility',this)" processid="<?=$error->id?>" href="javascript:void(0)"><strong>+Facility</strong></a>
						    <?php endif?>
					    <?php endif?>
					    <?php if($error->smsorweb!=3):?>
					    <a class="btn btn-success" onclick="retry_learning(this)" processid="<?=$error->id?>" smsorweb="<?=$error->smsorweb?>" href="javascript:void(0)"><strong>Retry</strong></a>
					    <a class="btn btn-warning" onclick="reject_learning(this)" processid="<?=$error->id?>" smsorweb="<?=$error->smsorweb?>" href="javascript:void(0)"><strong>Reject</strong></a>
					    <?php endif?>
					    <a class="btn btn-danger" onclick="delete_learning(this)" processid="<?=$error->id?>" smsorweb="<?=$error->smsorweb?>" href="javascript:void(0)"><strong>Delete</strong></a>
					  </div>
					  
					  
					  
					</div>
					<div class="clear"></div>
				</div>
				
				
				
				<?php if(isset($tokenizedarr)):?>
				
				<div class="tokens">
					<?php for($i=0;$i<=count($tokenizedarr)-1;$i++):?>
						<?php if($tokenizedarr[$i]!=""):?>
							<div class="word">
								<div class="token"><?=$tokenizedarr[$i]?></div>
								<div class="postag"><?=$postagarr[$i]?></div>
							</div>
							
						<?php endif?>
					<?php endfor?>
					<div class="clear"></div>
				</div>
				
				<?php endif?>
				
				
				
				
				<div class="all-details">
					
					<?php if($error->smsorweb==1):?>
						<small><strong>Unknown Nouns: <?=$unknownnouns?></strong><br>
								<?=convert_content_string_to_html($sentence)?>
						</small>
						<div class="original-data">
							<a href="javascript:void(0)" onclick="$(this).parents('.original-data').find('.form-group').show()">Show original data</a>
							<div class="form-group hidden-object">
								<textarea onchange="update_user_text(<?=$error->id?>,this)" rows="10" class="form-control"><?=($sentence)?></textarea>
							</div>
						</div>
					<?php elseif($error->smsorweb==0):?>
						<small><strong>Unknown Nouns: <?=$unknownnouns?></strong><br>
								User SMS: (//ignore TEXT_TO_IGNORE ignore//)
								<textarea class="form-control" onchange="update_user_text(<?=$error->id?>,this)"><?=($sentence)?></textarea>
						</small>
						
						<br>
					<?php elseif($error->smsorweb==3):?>
						<small>
								Suggested Text: <?=($sentence)?>
						</small>
						<br>
					<?php endif?>
					
					<small><strong>Posted By: <?=generate_username_control($error->userid,$error->username,true)?></strong></small>
					
					
					
				</div>
				
				<?php if($error->smsorweb==1):?>
					<a class="move-location pointer-cursor" onclick="handle_move_location(this,<?=$error->id?>)">
						Edit location
						<span class="sentence hidden-object"><?=$sentence?></span>
					</a>
		
				<?php endif?>
			
			
		</div>
		
		<?php endif?>
		
	</div>

<?php endforeach?>







