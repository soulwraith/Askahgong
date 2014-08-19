

<?php if(isset($unread_points_details) && $unread_points_details!=""):?>
<div class="experience-panel-container" points_id="<?=$unread_points_details->id?>">
	<div class="rope">
		<div class="rope-inner">
			
		</div>
	</div>
	
	<div class="experience-panel">
		
		<div class="clip clip-left icons">
			
		</div>
		<div class="clip clip-right icons">
			
		</div>
		<div class="panel-content">
			<?=$this->load->view("layout_controls/experience_panel_inner")?>
		</div>
		
	
	</div>
</div>
<?php endif?>

