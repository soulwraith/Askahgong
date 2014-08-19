<?php $lastuserid=0?>
<?php $lastdatetime=0?>
<?php $appendmessage=false?>
<?php if(count($messagedata)>0):?>
<?php $first=true?>
<div class="message-group">

<?php foreach($messagedata as $message):?>
	

		<?php if($lastuserid!=$message->fromuserid || convert_date_to_asia_format($message->dateandtime)!=convert_date_to_asia_format($lastdatetime)):?>
			<?php $appendmessage=false?>
			<?php if($first==false):?>
				
			</div> <!--End of message-container-->
			<div class="clear"></div>
			<div class="message-datetime">
				<?=convert_date_to_asia_format($lastdatetime)?>
			</div>
			<?php endif?>
			<?php $first=false?>
			<div class="clear"></div>
			
			<div class="message-container <?php if($message->fromuserid==get_userid()) echo "self"; else echo "other"?>">
	
				<div class="icons message-arrow">
						
				</div>
		<?php else:?>
			<?php $appendmessage=true?>
		<?php endif?>
			
				<div class="message-text <?php if($appendmessage) echo "append "?>" userid="<?=$message->fromuserid?>" title="Sent on <?=convert_date_to_asia_format($message->dateandtime)?>" dateandtime="<?=convert_date_to_asia_format($message->dateandtime)?>">
					
					<div class="message-username">
						<?php if($message->fromuserid==get_userid()):?>
							<a href="activity"><?=$message->username?></a>
						<?php else:?>
							<?=generate_username_control($message->fromuserid,$message->username,false)?>
						<?php endif?>
					</div>
					<span class="to-process"><?=($message->message)?></span>
					
				</div>
			
		<?php $lastuserid=$message->fromuserid?>
		<?php $lastdatetime=$message->dateandtime?>	
		
<?php endforeach?>		
		</div>	<!--End of message-container-->
		<div class="clear"></div>
		<div class="message-datetime">
			<?=convert_date_to_asia_format($lastdatetime)?>
		</div>
</div>
<?php endif?>
