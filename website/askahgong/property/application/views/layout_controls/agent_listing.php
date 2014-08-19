

<?php if(!isset($data_only)):?>
<div class="AGENT_LISTING white-container">
	
	<div class="row">
		<div class="col-xs-12">
			<h5>
				Agents List
			</h5>
		</div>
		
	</div>
	<div class="list">
		
	
<?php endif?>	
	<?php foreach($agents as $agent):?>
	
	<div class="row agent transition" onclick="show_agent_details(<?=$agent->id?>)" agent_id="<?=$agent->id?>">
		<div class="col-xs-3">
			<img class="img-responsive inline-block" src="<?=get_user_profile_pic($agent->id)?>" style='max-height:86px;'>
		</div>
		<div class="col-xs-9">
			<div class="vertical-bottom icons inline-block user-status user-state <?php if($agent->isonline) echo "online"; else echo "offline";?>" userid="<?=$agent->id?>" style="margin-right:0px">
			</div>
			<strong><?=$agent->username?></strong>
			
			<div class="text1 transition">
				<?=$agent->role?> 
				<?php if($agent->agency!=""):?>
					(<?=$agent->agency?>) 
				<?php endif?>
			</div>
			
			<div class="green request-sent <?php if(!$agent->my_request>0) echo "hidden-object"?>">
				<strong>Request Sent</strong>
			</div>
			
			<div class="red <?php if(!$agent->agent_request>0) echo "hidden-object"?>">
				<strong>Waiting your response</strong>
			</div>
			
		</div>
		
	</div>
	<div class="fade-separator">
			
	</div>
	
	
	<?php endforeach?>
<?php if(!isset($data_only)):?>	
	</div>
	
	<div>
		<form>
			<input onkeyup="keydown_find_agent(this)" name="agent_keyword" type="text" placeholder="Search for agents.." class="form-control">
		</form>
	</div>
	
</div>
<?php endif?>	
