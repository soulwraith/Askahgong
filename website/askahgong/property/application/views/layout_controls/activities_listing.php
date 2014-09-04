


<div class="activities-items">

	
<?php foreach($activities as $activity):?>
 <div class="row">	
  <div class="activity col-xs-12" activityid="<?=$activity->id?>">
  
   <div class="image-container col-sm-2 col-xs-2 no-padding-xs">
   	  <img class="img-responsive" src="<?=get_user_profile_pic($activity->userid)?>"></img>
   </div>	

	<div class="col-sm-8 col-xs-8">
		
	 
<?php switch($activity->action): ?>
<?php case "sendMessageFirst": ?>
	<div class="title">New Conversation</div>
	<div class="content">
		<span>
			  A new <a target="_blank" href="message/user/<?=$activity->conversationtargetid?>">conversation</a> 
			  has been initiated between <?=generate_username_control(get_userid())?>
			  and <?=generate_username_control($activity->conversationtargetid,$activity->conversationtargetusername)?>.
		</span>
	</div>
	<?php $icontooltip="New Conversation With Others"?>
<?php break;?>
<?php case "sendMessageLast": ?>
	<div class="title">Last Spoken</div>
	<div class="content">
		<span>
			<?=generate_username_control(get_userid())?> have last 
			<a target="_blank" href="message/index/<?=$activity->conversationtargetid?>">spoken</a> 
			with <?=generate_username_control($activity->conversationtargetid,$activity->conversationtargetusername)?> 
			at <?=$activity->dateandtime?>
		</span>
	</div>
	<?php $icontooltip="Last Spoken With Others"?>
<?php break;?>

<?php case "newItem": ?>
	<?php if(isset($activity->original_userid)):?>
		<div class="title">Item Takeover</div>
		<div class="content">
			<span>
				<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> takenover <?=generate_username_control($activity->original_userid,$activity->original_username)?> item:<br>
	   			<a target="_blank" href="item/id/<?=$activity->targetid?>"><?php if(isset($activity->finaltext)) echo $activity->finaltext?></a>
			</span>
		</div>
		<?php $icontooltip="Item Takeover"?>
	<?php else:?>
		<div class="title">New Item</div>
		<div class="content">
			<span>
				<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> posted a new item:<br>
	   			<a target="_blank" href="item/id/<?=$activity->targetid?>"><?php if(isset($activity->finaltext)) echo $activity->finaltext?></a>
			</span>
		</div>
		<?php $icontooltip="New Item Posted"?>
	<?php endif?>
	
<?php break;?>
<?php case "editItem": ?>
	<div class="title">Edit Item</div>
	<div class="content">
   		<span>
   			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> modified an item:<br>
   			<a target="_blank" href="item/id/<?=$activity->targetid?>"><?=$activity->finaltext?></a>
   		</span>
   	</div>
   	<?php $icontooltip="Item Edited"?>
<?php break;?>
<?php case "deleteItem": ?>
	<div class="title">Delete Item</div>
	<div class="content">
		<span>
			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> deleted an item:<br>
   			<a target="_blank" href="item/id/<?=$activity->targetid?>"><?php if(isset($activity->finaltext)) echo $activity->finaltext?></a>
		</span>
   	</div>
   	<?php $icontooltip="Item Deleted"?>
<?php break;?>
<?php case "addShortlist": ?>
	<div class="title">Add Shortlist</div>
	<div class="content">
		<span>
			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> added 
			<?=generate_username_control($activity->itemuserid,$activity->itemusername)?>'s item into shortlist:<br>
   			<a target="_blank" href="item/id/<?=$activity->targetid?>"><?=$activity->finaltext?></a>
		</span>
   	</div>
   	<?php $icontooltip="Item Shortlisted"?>
<?php break;?>
<?php case "addContact": ?>
	<div class="title">Add Contact</div>
	<div class="content">
		<span>
			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> added 
			<?=generate_username_control($activity->targetid,$activity->result)?> into contact list.
		</span>
	</div>
	<?php $icontooltip="Contact Added"?>
<?php break;?>
<?php case "addTopic": ?>
	<div class="title">Add Topic</div>
	<div class="content">
		<span>
			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> created a new discussion topic:<br>
			<a href="discussion/topic/<?=$activity->targetid?>"><?=$activity->result?></a>
		</span>
	</div>
	<?php $icontooltip="New Discussion Topic Created"?>
<?php break;?>
<?php case "replyTopic": case "replyYourTopic":  ?>
	<div class="title">Reply Topic</div>
	<div class="content">
		<span>
			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> replied a discussion topic:<br>
   			<a href="discussion/topic/<?=$activity->targetid?>/0/<?=$activity->reserved?>"><?=$activity->result?></a>
		</span>
   	</div>
   	<?php $icontooltip="Discussion Topic Replied"?>
<?php break;?>
<?php case "updateProfile": ?>
	<div class="title">Update Profile</div>
	<div class="content">
		<span>
			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> updated profile.
 		</span>
   	</div>
   	<?php $icontooltip="Profile Updated"?>
<?php break;?>
<?php case "updateSettings": ?>
	<div class="title">Change Settings</div>
	<div class="content">
		<span>
			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> updated your settings.
 		</span>
   	</div>
   	<?php $icontooltip="Settings Changed"?>
<?php break;?>
<?php case "register": ?>
	<div class="title">Join AskAhgong</div>
	<div class="content">
   		<span>
   			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> joined AskAhgong.com!
   		</span>	
   	</div>
   	<?php $icontooltip="Begin Your Journey"?>
<?php break;?>
<?php case "agentReview": ?>
	<div class="title">Agent Review</div>
	<div class="content">
   		<span>
   			<?=generate_username_control($activity->userid,$activity->username)?> <?=changeifme('has','have',$activity->userid)?> reviewed <?=generate_username_control($activity->agent_id,$activity->agent_name)?> in <a href="<?=$activity->url?>">agent review section</a>.
   		</span>	
   	</div>
   	<?php $icontooltip="Begin Your Journey"?>
<?php break;?>
<?php endswitch;?>
	 <div class="time">
	 	<?=ago($activity->dateandtime)?>
	 </div>
	</div>	
	
	<div class="col-sm-2 col-xs-2" style="padding:10px;">
			<a class="activity-icon activity-icon-<?=strtolower($activity->action)?> icons right" data-toggle="tooltip" title="<?=$icontooltip?>" data-placement="top"></a>
	</div>

	
		<div class="clear"></div>
	  </div>
	</div>	
<?php endforeach?>
	
	
	
	
</div>



