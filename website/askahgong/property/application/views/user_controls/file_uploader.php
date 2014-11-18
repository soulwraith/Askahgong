


<script type="text/javascript">

var CONTROL_CONTACT_FILE_UPLOADER_uploader;

JQUERY_CALLBACK.push(function(){
	CONTROL_CONTACT_FILE_UPLOADER_uploader = new plupload.Uploader({
		runtimes : 'gears,html5,silverlight,flash,browserplus,html4',
		browse_button : 'pickfiles',
		container : 'filecontainer',
		max_file_size : '10mb',
		chunk_size : '1mb',
		url : global_baseurl+'uploader/upload',
		flash_swf_url : 'http://askahgong.com/property/javascript/plupload/plupload.flash.swf',
		silverlight_xap_url : 'http://askahgong.com/property/javascript/plupload/plupload.silverlight.xap',
		filters : [
			{title : "Image files", extensions : "jpg,gif,png,jpeg"}
		],
		resize : {width : 800, height : 600, quality : 50}
	});




	CONTROL_CONTACT_FILE_UPLOADER_uploader.bind('Init', function(up, params) {
		//alert(params.runtime);
		//$('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
	});


	CONTROL_CONTACT_FILE_UPLOADER_uploader.init();

	CONTROL_CONTACT_FILE_UPLOADER_uploader.bind('FilesAdded', function(up, files) {
		handle_sample_photo(true);
		$.each(files, function(i, file) {
			$('#filelist').append(generate_thumbnail(file.id,"temp"));
			CONTROL_CONTACT_FILE_UPLOADER_uploader.start();
		});

		up.refresh(); // Reposition Flash/Silverlight
	});

	CONTROL_CONTACT_FILE_UPLOADER_uploader.bind('UploadProgress', function(up, file) {
		$('#' + file.id).find(".progress-text").html(file.percent + "%");
	});

	CONTROL_CONTACT_FILE_UPLOADER_uploader.bind('Error', function(up, err) {
		alert(err.message);

		up.refresh(); // Reposition Flash/Silverlight
	});
	
	CONTROL_CONTACT_FILE_UPLOADER_uploader.bind('BeforeUpload', function(up, file) {
		$('#' + file.id).find("a").addClass("disabled");

	});
	

	CONTROL_CONTACT_FILE_UPLOADER_uploader.bind('FileUploaded', function(up, file,Response) {
		var obj=$.parseJSON(Response.response);
		$('#' + file.id).find(".thumbnail-image").attr("src","upload/"+obj.result);
		$('#' + file.id).find(".thumbnail-image").attr("filename",obj.result);
		$('#' + file.id).find(".progress-text").html("");
		$('#' + file.id).find(".thumb-img-container").hide();
		$('#' + file.id).find(".thumb-img-container").removeClass("thumb-loading");
		$('#' + file.id).find("a").removeClass("disabled");
		$('#' + file.id).attr("type","saved");
		edit_input();
	});

})
</script>


<div id="filecontainer">
	
	<?php if(isset($buttonhtml)):?>
		<?= $buttonhtml?>
	<?php else:?>
		<a style="line-height:20px;" id="pickfiles" class="btn btn-amber btn-lg btn-block">Add Photo<br><small style="font-size:0.6em;">You may add multiple photos and select the display photo by clicking on it</small></a>
	<?php endif?>
	
	<div id="filelist" style="width:105%"></div>
	<img id="sample-photo" class="img-responsive" src="image/sample_photo.png" style="margin-top:5px;">
</div>

<input id="real_file_name" name="real_file_name" type="text" style="display:none"/>

<script type="text/javascript">
JQUERY_CALLBACK.push(function(){
	<?php if (isset($filearr)):?>
		
		var unique=1;
		<?php foreach($filearr as $file):?>

			<?php if (strpos($file, 'ahgongpresetfile') == false):?>
			var $thumb = $(generate_thumbnail(unique,"saved","<?=$file?>"));
			<?php $temp = explode("/",$file)?>
			<?php if(strtolower($first_file)==end($temp)):?>
				$thumb.addClass("selected");
			<?php endif?>
			
			$('#filelist').append($thumb);
			
			
			unique++;
			<?php endif?>
		<?php endforeach?>
	<?php endif?>
	
	handle_sample_photo();
})
		
</script>

