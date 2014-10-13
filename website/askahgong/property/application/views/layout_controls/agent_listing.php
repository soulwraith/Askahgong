

<?php if(!isset($data_only)):?>
<div class="AGENT_LISTING white-container">
	
	
	<div class="list-header slate-line">
		Agents List
		<img class="list-header-shadow top" src="image/discussion_shadow_top.png">
		<div class="fade-separator">

		</div>
	</div>
	
	
	<div class="list">
		
	
<?php endif?>	
	<?php foreach($agents as $agent):?>
	
	<div class="row agent transition" onclick="show_agent_details(<?=$agent->id?>)" agent_id="<?=$agent->id?>">
		<div class="col-xs-3">
			<img class="img-responsive inline-block" src="<?=get_user_profile_pic($agent->id)?>" style='max-height:86px;'>
		</div>
		<div class="col-xs-9 no-paddingleft">
			<div class="vertical-bottom icons inline-block user-status user-state <?php if($agent->isonline) echo "online"; else echo "offline";?>" userid="<?=$agent->id?>" style="margin-right:0px">
			</div>
			<strong class="text2"><?=$agent->username?></strong>
			
			<div class="text1 transition">
				<?=$agent->role?> 
				<?php if($agent->agency!=""):?>
					(<?=$agent->agency?>) 
				<?php endif?>
			</div>
			
			<div class="<?php if(!$agent->my_request_rejected>0) echo "hidden-object"?>">
				<span class="label label-yellow">Request Rejected</span>
			</div>
			
			<div class="green request-sent <?php if(!$agent->my_request>0 || $agent->my_request_rejected!="0") echo "hidden-object"?>">
				<span class="label label-green">Request Sent</span>
			</div>
			
			<div class="red <?php if(!$agent->agent_request>0) echo "hidden-object"?>">
				<span class="label label-red">Waiting your response</span>
			</div>
			
		</div>
		
	</div>
	<div class="fade-separator">
			
	</div>
	
	
	<?php endforeach?>
	
	
	<?php if(count($agents)<=0 && isset($start) && ($start==0)):?>	
		
			<div class="col-xs-12 padding">
				<small>No agent found.</small>
			</div>
		
	<?php endif?>	
	
<?php if(!isset($data_only)):?>	
	</div>
	
	<div class="fade-separator">
			
	</div>
	
	<div class="searchbox-container">
		<form>
			<input onkeyup="keydown_find_agent(this)" name="agent_keyword" type="text" placeholder="Search for agents.." class="form-control">
			
			<a class="submit-button icons right" onclick="keydown_find_agent($(this).prev('input'));"></a>
			
		</form>
	</div>
	
</div>
<?php endif?>	
