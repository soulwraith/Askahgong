<style type="text/css">
.PAGE_REDIRECT{
	position:relative;
	background:url("image/redirect-bg.jpg");
	margin-bottom:-60px;
}

.PAGE_REDIRECT .container{
	min-height:490px;
}

.PAGE_REDIRECT .bg-image{
	position:absolute;
	top:0px;
	left:0px;
	width:100%;
	height:100%;
	z-index:-1;
}

#body{
	padding-bottom:0px !important;
}

body{
	padding-top:60px;
}


.PAGE_REDIRECT .ahgong-img{
	max-height:310px;
}

.PAGE_REDIRECT .title{
	text-align:center;
	color:white;
	font-size:3.0em;
	font-weight:bold;
	letter-spacing:4px;
	line-height:1.1em;
}

@media screen and (max-width: 480px) {
.PAGE_REDIRECT .title{
	font-size:2em;
}
}


.PAGE_REDIRECT .content{
	text-align:center;
	color:white;
	font-size:1.2em;
	margin-top:10px;
	min-height:20px;
}

.PAGE_REDIRECT .content a{
	color:rgb(63, 63, 63);
}

.PAGE_REDIRECT .link-container{
	width:100%;
	text-align:center;
	line-height:4px;
	margin-top:50px;
}

.PAGE_REDIRECT .link-container a:hover .inner{
	text-decoration:underline;
}

.PAGE_REDIRECT .link-container .link{
	background-color: rgb(255, 255, 255);
    background-color: rgba(255, 255, 255, .5);
    border-radius:6px 6px 0px 0px;
	-moz-border-radius:6px 6px 0px 0px;
	-webkit-border-radius:6px 6px 0px 0px;
	padding:10px 10px 0px 10px;
	width:280px;
	height:50px;
	display:inline-block;
	margin-right:30px;
    
}

.PAGE_REDIRECT .link-container a:last-child .link{
	margin-right:0px;
}




.PAGE_REDIRECT .link-container .inner{
	height:100%;
	width:100%;
	background-color: #f7f7f7;
	border-radius:6px 6px 0px 0px;
	-moz-border-radius:6px 6px 0px 0px;
	-webkit-border-radius:6px 6px 0px 0px;
    color: #db6409;
    font-weight: bold;
    line-height: 40px;
    font-size: 1.5em;
}

@media screen and (max-width: 1000px){
	
	.PAGE_REDIRECT .link-container{
		margin-top:50px;
	}
	
	.PAGE_REDIRECT .link-container .link{
		 border-radius:6px;
		-moz-border-radius:6px;
		-webkit-border-radius:6px;
		padding:10px;
		height:60px;
		margin-bottom:5px;
		margin-right:0px;
	}
	
	.PAGE_REDIRECT .link-container .inner{
		 border-radius:6px;
		-moz-border-radius:6px;
		-webkit-border-radius:6px;
	}
	
}


</style>



<?php if($type=="successpost"):?>
    <?php 
    
    	if($reserved2=="0"){
   			$title="Post Success!";
			$img="happy_glow";
			$content="Pssst, now that your item is posted, you can 
				<br><br>
					<ul style='
					    list-style-type: disc;
					    list-style: initial;
					    text-align: left;
					    display: inline-block;
					    line-height:25px;'>
					    <li><a style='color: white;text-decoration: underline;' href='settings#notification-settings' target='blank'>Check how you will want to be notified of new matched items at notification settings</a></li>
						<li>Stay online so interested parties can instant message you</li>
						<li><a style='color: white;text-decoration: underline;' href='profile#profile-box' target='blank'>Set your available hours</a></li>
						<li><a style='color: white;text-decoration: underline;' href='profile#profile-box' target='blank'>Check that you have revealed your number for others to contact you</a></li>
					</ul>
					";
			$link_arr=array("posting/newpost" => "Post New Item",
							"item/id/".$reserved => "See This Posting",
							"posting/view" => "See All My Postings");
   		}
		else if($reserved2=="1"){
			$title="Your Item Has Been Updated!";
			$img="happy_glow";
			$content="";
			$link_arr=array("posting/newpost" => "Post New Item",
							"item/id/".$reserved => "See This Posting",
							"posting/view" => "See All My Postings");
		}
    
    
		
	
	?>
<?php elseif($type=="warningpost"):?>
   <?php 
   		if($reserved==="RUDE_EXCEPTION"){
   			$title="Rude Word Found!";
			$img="facepalm_glow";
			$content="This posting contains rude word.";
			$link_arr=array("posting/newpost" => "Post New Item");
   		}
		else if($reserved==="LEARNING_EXCEPTION"){
   			$title="Handling Your Item!";
			$img="thinking_glow";
			$content="This posting contains suggested area/facility which is not recognized by Ah Gong and needs special handling,<br>Ahgong will get back to you as soon as possible after verification.";
			$link_arr=array("posting/newpost" => "Post New Item");
   		}
		else{
			$general_error=true;
		}
		
	
	?>
<?php elseif($type=="successtopic"):?>
	<?php 
		$title="Topic Added!";
		$img="happy_glow";
		$content="<div class='margin-top'></div>Thank you for contributing to our growing Ask Ah Gong community,
				  <br>Look out for the <span class='hidden-inline-xs'>notification<img style='margin:10px;width:50px;' src='image/notification_example.png'>on the top right corner</span><a class='visible-inline-xs'  href='notification'> notification page</a> when your topic is answered! ";
		$link_arr=array("discussion/listing/".$reserved => "Back To Topic List",
						"discussion/topic/".$reserved2 => "See My Topic");
	
	?>
<?php elseif($type=="edittopic"):?>
	<?php 
		$title="Topic Edited!";
		$img="happy_glow";
		$content="Your topic has been updated.";
		$link_arr=array("discussion/listing/".$reserved => "Back To Topic List",
						"discussion/topic/".$reserved2 => "See My Topic");
	
	?>	
<?php elseif($type=="error"):?>
   <?php 
   		if($reserved==="404"){
   			$title="Page Not Found!";
			$img="facepalm_glow";
			$content="Cannot find this page.";
			$link_arr=array();
   		}
		else{
			$general_error=true;
		}
		
	
	?>	
<?php elseif($type=="agent_under_verify"):?>
   <?php 
		$title="Verifying agent identity";
		$img="thinking_glow";
		$content="We are currently verifying your agent identity. We will inform you once you can start posting. ";
		$link_arr=array();
	?>
<?php endif?>


<?php 
	if(isset($general_error)){
		$title="Opps, something bad happened!";
		$img="facepalm_glow";
		$content="There is some error occured, please try again later.";
		$link_arr=array();
	}



?>
	
	






<div class="PAGE_REDIRECT">
	
	 <div class="container">
		<div class="row margin-top">
			<div class="col-xs-12 text-center">
				<img class="ahgong-img" src="image/ahgong/<?=$img?>.png">
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 text-center">
				 <div class="title">
			     	<?=$title?>
			     </div>
			</div>
		</div>
		
		
		
		<div class="row">
			<div class="col-xs-12 text-center">
				 <div class="content">
				 	<?php if(isset($content) && $content!=""):?>
			     		<?=$content?>
			     	<?php endif?>
			     </div>
			</div>
		</div>
		
		
		
	
	    
	     
	     <div class="link-container">
	     	
	     	<?php foreach($link_arr as $key=>$value):?>
	     	<a href="<?=$key?>">
		     	<div class="link">
		     		<div class="inner">
		     			<?=$value?>
		     		</div>
		     	</div>
	     	</a>
	     	<?php endforeach?>
	     </div>
     </div>
</div>






