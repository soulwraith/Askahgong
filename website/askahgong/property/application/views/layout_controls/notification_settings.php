<tr>
	
			<td style="width:20%">
				<?php if($setting->time=="0"):?>
					Working Hour
					<br>(<?=$user->workingfrom?> - <?=$user->workingto?>)
				<?php elseif($setting->time=="1"):?>	
					Anytime
				<?php endif?>	
			</td>
			
			<td style="width:10%">
				<?php if($setting->method=="2"):?>
					Web
				<?php elseif($setting->method=="1"):?>	
					SMS + Web
				<?php endif?>	
			</td>
			
			
			<td style="width:15%">
				<?php if($setting->item=="0"):?>
					Any
				<?php elseif($setting->item=="1"):?>	
					Matching My Postings
				<?php elseif($setting->item=="2"):?>	
					Matching My Criteria
				<?php elseif($setting->item=="3"):?>	
					Bad Agent Review
				<?php endif?>	
			</td>
			
			<td style="width:30%">
				
				<?php if($setting->item=="2"):?>
					Notify me when
					<?php if($setting->type=="0"):?>
						selling
					<?php elseif($setting->type=="1"):?>	
						buying
					<?php endif?>	
					
					<?php foreach($propertylist_with_id as $property):?>
						<?php if($setting->categoryid==$property->id):?>
							<?=strtolower($property->word)?>
						<?php endif?>	
					<?php endforeach?>
					
					<?="RM".$setting->pricemin?> - 
					<?="RM".$setting->pricemax?>
					<?php if($setting->result==""):?>
						at any area
					<?php else:?>
						at <?=$setting->result?>
					<?php endif?>	
					become available.
				<?php else:?>
					-
				<?php endif?>	
			</td>
			
			
			<td class="text-center"  style="width:5%">
				<a onclick="delete_notification_settings(this,<?=$setting->id?>)" href="javascript:void(0);" data-toggle="tooltip" title="Delete This Notification"><img style="width:20px;" src="image/delete-icon.png"></a>
			</td>

</tr>


