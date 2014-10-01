<div class="alert alert-<?=$alert_type?>">
	<?php if(!isset($no_icon) || !$no_icon):?>
	<div class="alert-icon">
		<div class="icons"></div>
	</div>
	<?php endif?>
	<div class="alert-content">
		<?=$alert_html?>
	</div>
	
</div>
