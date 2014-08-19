<?php 
	$user->points=preg_replace('/[^\d]/', '', $user->points);

?>

<?php $exp_bar["level"]=$user->level?>
<?php $exp_bar["points"]=$user->points?>
<?php $exp_bar["nextlevel_exp"]=$user->nextlevel_exp?>
<?php $exp_bar["current_exp"]=$user->current_exp?>

<?=$this->load->view("user_controls/experience_bar",$exp_bar)?>
