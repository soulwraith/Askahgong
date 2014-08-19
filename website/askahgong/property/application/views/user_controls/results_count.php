
<?php if($totalcount>0):?>
<span class="pagination-total-count">
	Showing <?=$start+1?> - <?php if(($start+$limit)<$totalcount) echo $start+$limit; else echo $totalcount;?> 
	of <?=concat_if_plural(" ".$type,"s",$totalcount)?>
</span>
<?php endif?>
