<style type="text/css">
.image-container{
	border:1px solid red;
	background:white;
	text-align:center;
}
</style>


<div class="alert alert-error">
	<div class="border-radius image-container padding">
		<img src='image/error.jpg' class='img-circle img-medium'/>
	</div>
	
	<div class="padding margin-top">
		<p><strong>Post Failed</strong></p>
		<p><?=$message?></p>
	</div>
	<div class="padding">
		<a class="btn btn-inverse" href="posting">Post New Item</a>
		<a class="btn btn-inverse" href="message/user/25">Feedback To Us</a>
		<a class="btn btn-inverse" href="about/title/website#failpost">Why Did My Post Fail?</a>
	</div>
</div>
