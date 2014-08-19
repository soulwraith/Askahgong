

<?php 
	$nextlevel_exp = str_replace(",","",$nextlevel_exp);
	$current_exp = str_replace(",","",$current_exp)
?>


<div class="experience-bar">
	<div class="next-level <?php if(isset($animated)) echo "uplevel-change";?>">
		<?=$level+1?>
	</div>
	
	
	
	<?php 
	  	$percentage=(($current_exp)/($nextlevel_exp)) * 100
	  ?>
	  <?php 
	  	if(!isset($added_points)) $added_points=0;
		
		
	  ?>
	
	  
	 <div class="inner-bar-container">
	 	<div class="inner-bar icons" style="width: <?=round($percentage)?>%;">
			<div class="glow icons">
				
			</div>
			<div class="current-percentage icons">
				<?=round($percentage)?>%
			</div>
			
			<div class="current-level hidden-object uplevel-change">
				<?=$level?>
			</div>
		</div>
		<div class="level-up myriad green">
			Level Up
		</div>
		<div class="level-drop myriad red">
			Level Drop
		</div>
	 </div>
	
	

</div>





