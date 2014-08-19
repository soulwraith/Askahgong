<div class="breadcrumbs-container hidden-xs" <?php if(contain_string($attrs,"no-responsive")) echo "style='min-width:1170px;'"?>>
	<div class="breadcrumbs">
		<div class="inner">
			<a href="#"><div class="crumb home"><div class="icons home-icon"></div><div class="separator icons"></div></div></a>
		  <?php foreach($previous as $key=>$value):?>
		  	 <a href="<?=$value?>"><div class="crumb"><?=$key?><div class="separator icons"></div></div></a>
		  <?php endforeach?>
		  
		  <a class="selected" href="<?=uri_string()?>"><div class="crumb selected"><?=$current?></div></a>
		  <div class="clear"></div>
		</div>
	 	<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
