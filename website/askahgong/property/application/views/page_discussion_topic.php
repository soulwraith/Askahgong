


<?php 
	$previous = array(
	 'Discussion' => 'discussion'
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>ucfirst($currentcategory->category)))?>



<div class="container PAGE_TOPIC">
	<div class="row topics-header">
		<div class="col-sm-8">
			<h1>
				Discussion
			</h1>
			<span class="category-text">&nbsp;<?=$currentcategory->text?></span>
		</div>
		<div class="col-sm-4">
			<div class="clearfix btn-actions right">
				<?php foreach($categories as $category):?>

				<a href="discussion/listing/<?=$category->id?>">
					<div class="text-center icons buybutton actionbutton <?php if($category->id==$currentcategory->id) echo "selected" ;?>" data-toggle="tooltip" title="<?=$category->text?>" data-container="body" data-placement="top">
						<?=$category->category?>
					</div>
				</a>
				<?php endforeach?>
				
			</div>
			<div class="clear visible-xs"></div>
			<div class="padding-equal grey-bg right new-topic-container" style="margin-right:35px;margin-top:15px;" data-toggle="tooltip" title="Create a new topic" data-placement="bottom">
				<a href="discussion/newtopic/<?=$currentcategory->id?>" class="btn btn-lg btn-amber">New Topic</a>
			</div>
		</div>
		
		
	</div>
	
	
		
	<div class="row topics-container">
		<div class="col-lg-12 position-relative">
			<img class="discussion-shadow top" src="image/discussion_shadow_top.png">
			<img class="discussion-shadow bottom" src="image/discussion_shadow_bottom.png">
			<table class="table table-condensed topics-table my-table">
              <thead>
                <tr class="header">
                  <th></th>
                  <th>Title</th>
                  <th class="text-center"></th>
                  <th class="text-center hidden-xs">Views</th>
                  <th class="text-center">Posts</th>
                  <th class="text-center visible-lg">Last Post</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($topics as $topic):?>
              	<tr class="transition" onclick="direct_to_url('discussion/topic/<?=$topic->id?>')">
              		
	              		<td class="text-center">
	              			<img class="user-image open-message user-state background <?php if($topic->isonline) echo "online"?>" src="<?=get_user_profile_pic($topic->userid)?>" userid="<?=$topic->userid?>">
	              		</td>
	              		<td class="topic-title">
	              			<a href="discussion/topic/<?=$topic->id?>"><?=$topic->topictitle?></a>
	              			<br>
	              			<small>by <span class="user"><?=generate_username_control($topic->userid,$topic->username)?></span></small>
	              		
	              		</td>
	              		<td class="text-center">
	              			<?php if($topic->good!=0):?>
              					<div class="icons great-topic inline-block" title="This topic has been marked as Great Topic." data-toggle="tooltip" data-container='body'></div>
              				<?php endif?>
	              			<?php if($topic->solved!=0):?>
              					<div class="icons solved inline-block" title="This topic has been closed." data-toggle="tooltip" data-container='body'></div>
              				<?php endif?>
	              			
	              		</td>
	              		<td class="text-center hidden-xs">
	              			<span class="counter-bubble-container border-radius" title="Number of <?=concat_if_plural('view','s',$topic->viewscount,false)?> of this topic" data-toggle="tooltip" data-container='body'>
	              				
	              				<?=$topic->viewscount?>
	              			</span>
	              		</td>
	              		
	              		<td class="">
	              			<div class="position-relative text-center">
	              				<span class="counter-bubble-container border-radius" title="Number of <?=concat_if_plural('reply','ies',$topic->postscount,false,1)?> of this topic" data-toggle="tooltip" data-container='body'>
	              				<?=$topic->postscount?>
		              				
		              			</span>
		              			<img style="position:absolute;top:22px;left:50%;margin-left:-7px;" src="image/post_count_tail.png">
	              			</div>
	              			
	              		</td>
	              		
	              		
	              		<td class="text-center last-reply visible-lg">
	              			<?php if(isset($topic->lastreplyusername) && $topic->lastreplyusername!=""):?>
	              				<div class="inline-block">
	              					
	              				
		              				<div class="left icons last-reply-icon">
		              					
		              				</div>
		              				<div class="text-left left">
		              					<a href="discussion/topic/<?=$topic->id?>/<?=(floor($topic->postscount/10))*10?>/<?=$topic->lastreplycommentid?>">
				              				<?=ago($topic->lastreplydateandtime)?><br>
				              				<?php if($topic->userid==get_userid()) $topic->lastreplyusername="You"?>
				              				by <span class="user"><?=cutofftext($topic->lastreplyusername,7,"...")?></span>
				              			</a>
		              				</div>
	              				</div>
		              			
		              		<?php else:?>
		              			<span>-</span><br><span>-</span>
	              			<?php endif?>
	              		</td>
              		
              	</tr>
              	<?php endforeach?>
                           	
              </tbody>
           </table> 
		 </div>
	  </div>
	<div class="row pagination-container">
		
		<div class="col-xs-12 text-center page-links">
			<?php echo $pagination; ?>
		</div>
		<div class="col-xs-12 text-center margin-top">
			<?= $this->load->view("user_controls/results_count",Array("start"=>$start,"limit"=>$limit,"totalcount"=>$totalcount,"type"=>"Topic"));?>
			
		</div>	
		
		
	</div>
	
</div>




