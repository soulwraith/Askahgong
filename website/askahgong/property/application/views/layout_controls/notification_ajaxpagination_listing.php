<!--ignore-->
<!--notificaiton layout for notification PAGE AJAX PART ONLY!-->

<style>
.monthyear-group{
		color:#db6409;
		font-size:1em;
		font-weight:bold;
		margin-bottom:5px;
}
</style>

<div class="row">
	<div class="col-xs-12 col-sm-10 col-md-8 col-lg-7" style="padding-left:25px;">
		<div class="styled-select">
				<select class="notification-type form-control" onchange="switch_notification_page(this)">
					<option value="_">All</option>
					<option value="newItem" <?php if($filtertype=='newItem') echo "selected"?>>Item that may interest you</option>
					<option value="replyYourTopic" <?php if($filtertype=='replyYourTopic') echo "selected"?>>Reply to the topic you start</option>
					<option value="replyTopic" <?php if($filtertype=='replyTopic') echo "selected"?>>Reply to the topic you are in</option>
					
				</select>
		</div>
	</div>
	
</div>

<div class="row margin-top">
		<div class="col-xs-12">
				<?php	
					$lastmonth="";
					$lastyear="";
				?>
				<?php foreach($notifications as $notification):?>
					<?php 
						$arr=explode(" ",$notification->dateandtime);
						$arr2=explode("/",$arr[0]);
						$month=$arr2[0];
						$year=$arr2[2];
								
					?>
					
					<?php if($lastmonth!=$month || $lastyear!=$year):?>
							
						<?php	
							$lastmonth=$month;
							$lastyear=$year;
						?>
						<div class="row">
							<div class="col-xs-12 text-center monthyear-group">
								<?=convert_int_month_to_text($lastmonth)?>  <?=$lastyear?>
							</div>
						</div>
					<?php endif?>	
					
					
						
					<?=$this->load->view("layout_controls/notification_layout",Array("notification"=>$notification))?>
			
				<?php endforeach?>
		</div>
		<?php if(count($notifications)<=0):?>
			<?php 
				if($filtertype=="newItem"){
					$info['type']="notification_item";
				}
				else if($filtertype=="replyYourTopic" || $filtertype=="replyTopic"){
					$info['type']="notification_discussion";
				}
				else{
					$info['type']="notification_all";
				}
				
			?>
			<?=$this->load->view("layout_controls/no_result_info_text",$info)?>
		<?php endif?>	
</div>

<div class="row">
	<div class="col-xs-12 text-center page-links">
		<?php echo $pagination; ?>
	</div>
	
	<?php if($totalcount>0):?>
	<div class="col-xs-12 text-center" style="margin-top:20px;">
		<?= $this->load->view("user_controls/results_count",Array("start"=>$start,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>"Notification"));?>
	</div>
	<?php endif?>
	
</div>






