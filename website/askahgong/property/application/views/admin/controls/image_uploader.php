<div>
	<div class="span5">
		<h4>Pick your file to upload and copy the returned link.</h4>
		<form id="iform" name="iform" target="upload_target" action="admin/file/upload" method="post" enctype="multipart/form-data">
		    <input id="uploadedfile" type="file" name="uploadedfile" onChange="upload(this)" /><br>
		    <input type="hidden" value="" name="div_id" />
		</form>
	</div>

	<div class="span6">
		<iframe src="" id="upload_target" name="upload_target" frameborder="0" style="height:75px;width:515px;"></iframe>
	</div>

</div>

<script>

	function upload(control){
		var ext = $(control).val().split(".").pop().toLowerCase();
		if($.inArray(ext, ["gif","png","jpg","jpeg"]) == -1) {
		    alert("Invalid File Chosen!");
		}
		else{
			$("#iform").submit();
		}
		
	}
</script>