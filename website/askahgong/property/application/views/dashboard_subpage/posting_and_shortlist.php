

<?php 
if($dashboard_page=="posting")
	$text="Posting";
else $text="Shortlist";	
?>
	
	

<div class="posting-container SUBPAGE_POSTING">
	<div class="header">
		<?php if($user->id==get_userid()):?>
			My <?=$text?>
		<?php else:?>
			<?=$user->username?>'s <?=$text?>
		<?php endif?>	
		<div class="right icons <?=strtolower($text)?>-icon">
			
		</div>
	</div>
	
	<div class="my-font bold margin-top">
		<div class="col-sm-12 col-md-4 control-box">
			<div class="control-box-inner">
				<div class="result-count"><?=$totalcount?> </div>
				<div class="common-text"><?=concat_if_plural($text,"s",$totalcount,false)?> Found</div>
			</div>
		</div>
		
		<div class="col-sm-12 col-md-3 control-box">
			<div class="control-box-inner">
				<a class="filter-type <?php if($filter=="all") echo "selected"?>" data-toggle="tooltip" title ="Show All Item" href="<?=$dashboard_page?>/view/<?=$user->id?>/all/<?=$sorttype?>/0">All</a>
				<a class="filter-type <?php if($filter=="buy") echo "selected"?>" data-toggle="tooltip" title ="Show Buying Item Only" href="<?=$dashboard_page?>/view/<?=$user->id?>/buy/<?=$sorttype?>/0">Buy</a>
				<a class="filter-type <?php if($filter=="sell") echo "selected"?>" data-toggle="tooltip" title ="Show Selling Item Only" href="<?=$dashboard_page?>/view/<?=$user->id?>/sell/<?=$sorttype?>/0">Sell</a>
							
			</div>
					
		</div>
		
		<div class="col-sm-12 col-md-5 control-box">
			<div class="control-box-inner">
				
				<div class="common-text">
					Sort By:
				</div>					
								
				<form class="form-horizontal">
				  
				    
				    <div class="styled-select"> 	
				    	<?php
				    		if ($sorttype=="posttime desc")
								$showfiltertooltip="Showing Latest Post First";
							else if ($sorttype=="price desc")
								$showfiltertooltip="Showing Higher Price First";
							else 
								$showfiltertooltip="Showing Lower Price First";
							?>
					     <select class="form-control" id="sortby" onchange="sorting_posting(this.value);" data-container="body" data-toggle="tooltip" title="<?=$showfiltertooltip?>">
					  	 	<option value="posttime desc" <?php if($sorttype=="posttime desc") echo "selected='selected'"?>>Latest</option>
					  	 	<option value="price asc" <?php if($sorttype=="price asc") echo "selected='selected'"?>>Price ++</option>
					  	 	<option value="price desc" <?php if($sorttype=="price desc") echo "selected='selected'"?>>Price --</option>
					   	</select>
				   	</div> 
				  
				</form>
			</div>
		
		</div>
		
	</div>
	
	<div class="clear"></div>
	
	<div>

		<?php
			foreach($itemsdata as $item){
				
				$this->load->view("layout_controls/result_item",Array("item"=>$item,"size"=>"slim"));
			}
		?>
		
		<?php if(count($itemsdata)<=0):?>
			<div class="margin-top border-radius">
				
				<?php 
					if($dashboard_page=="posting"){
						$info['type']="posting";
					}
					else{
						$info['type']="shortlist";
					}
					
				?>
				<?=$this->load->view("layout_controls/no_result_info_text",$info)?>
			</div>
			
			
		<?php endif?>
	</div>	
	
	<div class="col-xs-12 text-center page-links" style="margin-top:40px;">
			<?php echo $pagination; ?>
	</div>
	
	<?php if($totalcount>0):?>
	<div class="col-xs-12 text-center" style="margin-top:20px;">
		<?= $this->load->view("user_controls/results_count",Array("start"=>$start,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>$text));?>
	</div>
	<?php endif?>

	
</div>

<script type="text/javascript">

var SUBPAGE_POSTING_resizing,
    SUBPAGE_POSTING_dashboard_page,
    SUBPAGE_POSTING_posting_userid,
    SUBPAGE_POSTING_filter;


	var SUBPAGE_POSTING_dashboard_page="<?=$dashboard_page?>";
    var SUBPAGE_POSTING_posting_userid="<?=$posting_userid?>";
    var SUBPAGE_POSTING_filter="<?=$filter?>";
</script>



