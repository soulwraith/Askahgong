<?php 
	$previous = array();
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>'Password Reset'))?>

<div class="container page-min-height">
	<div class="row">
		<div class="col-xs-12">
			<h3>
				Password Reset
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div>
				Your password has been reset to '<strong><?=$password?></strong>'
				<br>
				You may now <a href="user/login" target="_blank">login</a> using the new password.
			</div>
		</div>
	</div>
</div>





