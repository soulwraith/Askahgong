



<?php 
	$previous = array(
	 'Discussion' => 'discussion'
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>ucfirst($type).' Topic'))?>


<div class="container margin-top PAGE_NEWTOPIC">
	<div class="row">
		<div class="col-sm-12">
			<h2>
				<?=ucfirst($type)?> Topic
			</h2>


			<div category="dummy">
				Share your mind to others.
			</div>

			<?php foreach($categories as $category):?>
  			<div category="<?=$category->category?>" class="hidden-object">
  				<?=$category->text?>
  			</div>
      		<?php endforeach?>
		</div>
	</div>
	
	<div class="row form-container position-relative">
		<img class="container-shadow top" src="image/discussion_shadow_top.png">
		<img class="container-shadow bottom" src="image/discussion_shadow_bottom.png">
		<div class="form-bg border-radius"></div>
		<form class="newtopicform padding commonform" onsubmit="return validate_new_topic();" action="discussion/submittopic/<?php if(isset($topic)) echo $topic->id ?>" method="post">
			
			<div class="col-sm-4 col-xs-12" >
	    		<div class="form-group">
			      <label for="topictitle">Category</label>
			      <div id="category-alert"></div>
			      <div class="styled-select">
			      	<select class="form-control" name="category" onchange="switch_topic_category(this)">
			      		<option value="" selected class="hidden-object" disabled>Select Category</option>
			      		<?php foreach($categories as $category):?>
			      		<option value="<?=$category->id?>" <?php if(isset($topic) && $topic->categoryid==$category->id) echo "selected" ?>><?=$category->category?></option>
			      		<?php endforeach?>
			      		
			      	</select>
			      </div>
			      
			   
			    </div>
	    	</div>
			
			
			<div class="clear"></div>
			
			<div class="col-sm-4 col-xs-12" >
	    		<div class="form-group">
			      <label for="topictitle">Title</label>
			      <div id="title-alert"></div>
			      <input class="form-control" id="topictitle" type="text" name="topictitle" value="<?php if(isset($topic)) echo $topic->topictitle?>">
			    </div>
	    	</div>
	    	
	    	
	    	<div class="clear"></div>
	    	
	    	<div class="col-sm-12 col-xs-12" >
	    		<div class="form-group" style="margin-bottom:0px">
			      <label for="topictitle">Text</label>
			      <div class="topictext"><?php if(isset($topic)) echo $topic->topictext?></div>
			    </div>
	    	</div>
	    	
	    	<div class="col-sm-7 col-xs-12">
				<div class="leave-comment-container position-relative">
					<img class="leave-comment-image background online img-responsive left" src="<?=get_user_profile_pic($this->session->userdata('userid'))?>">
					<div class="icons leave-comment-tail"></div>
					<div class="leave-comment-text left">
						<?php if($type=="new"):?>
							Create a topic
						<?php else:?>
							Edit topic
						<?php endif?>		
					</div>
				</div>
				<div class="clear"></div>
					
			</div>
	    	
	    	<div class="col-sm-5 margin-top col-xs-12" style="margin-bottom:30px;">
				
				<div class="padding-equal grey-bg right">
					<button onclick="cancel_topic()" class="btn btn-lg btn-white" type="button">Cancel</button>
				</div>	
				
				<div class="padding-equal grey-bg right margin-right">
					<input class="btn btn-light-orange btn-lg" type="submit" value="Submit">
				</div>
				
				
				
			</div>
	    	
		</form>	
	</div>
	

	
</div>

<script type="text/javascript">

var PAGE_NEWTOPIC_currentcategoryid,
    PAGE_NEWTOPIC_submiting;


	PAGE_NEWTOPIC_currentcategoryid="<?=$currentcategory->id?>";
	PAGE_NEWTOPIC_submiting=false;
</script>






