<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>





<?php 
	$previous = array(
	 'About' => 'about/title'
	);
	$this->load->view("user_controls/breadcrumbs",Array("previous"=>$previous,"current"=>ucfirst($title)))?>

<?php if(strtolower($title)=="features"):?>
<div class="PAGE_ABOUT" style="padding:0px 65px;width:1170px;">
<?php else:?>
<div class="PAGE_ABOUT" style="padding:0px 115px;width:1170px;">
<?php endif?>	
	<div>
		
			<div class="left">
				<h1>
					About
				</h1>
			</div>
			<div class="right">
				<div class="page-selector about-menu-bg margin-top">
					<?php $counter=1?>
					<?php foreach($anchors as $link):?>
						<div class="selector <?php if(str_replace("%20"," ",strtolower($title))==strtolower($link->title)) echo "selected"?>">
							<div class="left">
								<a href="about/title/<?=strtolower($link->title)?>"><?=$counter.". "?><?php if(strtolower($link->title)=="sms") echo "SMS"; else echo $link->title?></a>
							</div>
							<div class="next-arrow icons hidden-object"></div>
						</div>
						
					<?php $counter++?>
					<?php endforeach?>
				</div>
			</div>
			<div class="clear"></div>
	</div>
	
	
	<?php if(strtolower($title)=="features"):?>
		<div class="about1" style="margin-top:50px;">
			<div class="left" style="width:190px;">
				<div class="feature-buttons-container section-fixed">
					
				
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-425px -575px">
					</div>
					<div class="text">
						Fast & Easy
					</div>
					
					<div class="indicator icons">
						1
					</div>
				</div>
				
				
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-17px -575px">
					</div>
					<div class="text">
						Dashboard
					</div>
					
					<div class="indicator icons">
						2
					</div>
				</div>
				
				
				
				
				
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-375px -575px">
					</div>
					<div class="text">
						Instant Messaging
					</div>
					
					<div class="indicator icons">
						3
					</div>
				</div>
				
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-327px -575px">
					</div>
					<div class="text">
						Discussion
					</div>
					
					<div class="indicator icons">
						4
					</div>
				</div>
			
			
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-123px -575px">
					</div>
					<div class="text">
						Shortlist
					</div>
					
					<div class="indicator icons">
						5
					</div>
				</div>
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-280px -575px">
					</div>
					<div class="text">
						Buy & Sell
					</div>
					
					<div class="indicator icons">
						6
					</div>
				</div>
				
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-70px -575px;height:38px;">
					</div>
					<div class="text">
						Google Map
					</div>
					
					<div class="indicator icons">
						7
					</div>
				</div>
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-233px -575px">
					</div>
					<div class="text">
						Item Discovery
					</div>
					
					<div class="indicator icons">
						8
					</div>
				</div>	
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-178px -575px;top:10px;">
					</div>
					<div class="text">
						SMS
					</div>
					
					<div class="indicator icons">
						9
					</div>
				</div>	
				<div class="feature-button text-center">
					<div class="feature-icon icons" style="background-position:-471px -572px;top:10px;">
					</div>
					<div class="text">
						Notification
					</div>
					
					<div class="indicator icons">
						10
					</div>
				</div>	
				</div>
			</div>	
			
	
			<div class="right" style="width:750px;">
				<div class="about-container content">
					<?=$anchor_content?>
				</div>
			</div>
			
					
		</div>
	<?php elseif(strtolower($title)=="website" || strtolower($title)=="sms"):?>
		
		<div class="row margin-top page-min-height about2" style="margin-top:35px;">
			
			<?php if(strtolower($title)=="sms"):?>
			<div class="col-sm-12">
				<div class="row">
					<div class="col-xs-7">
						<iframe style="width:100%;height:250px;" src="//www.youtube.com/embed/8_hdW4GMwYM" frameborder="0" allowfullscreen></iframe>
					</div>	
					<div class="col-xs-5">
						<div>
							<span style="font-size:20px;font-weight:bold;">Looking for a dream home online</span>, but hate to run through endless online searches? Have a hot property to sell, but hate to fill in complicated online forms? Find out how you can use our SMS service to do that and start putting those requests in @ <strong style='color:#fd9c28'>6017-8761590</strong>
						</div>	
						<div class="margin-top">
							 <a onclick="focus_question('faq_post')" href="javascript:void(0)">Scroll below</a> for instructions and screenshots.
						</div>
							
					</div>	
				</div>
					
			</div>	
			<?php endif?>
			
			
			<div class="col-sm-12">
				<div class="about-container content">
					<?=replace_first("</div><h4","<h4",str_replace("</h4>","</h4><div class='answer'>",str_replace("<h4","</div><h4",$anchor_content)))."</div>"?>
				</div>
			</div>
		</div>
		
	
			
	<?php else:?>
		<div class="about3" style="margin-top:50px;">
				<div class="about-container content">
					<?=$anchor_content?>
				</div>
		</div>
	<?php endif?>
	
	
	
	
	
	<div class="clear"></div>
	
	
	
</div>





