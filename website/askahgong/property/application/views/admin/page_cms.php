<style type="text/css">
ul{
	list-style-type:none;
	padding:0px;
}

ul.anchorlist li{
	padding:5px;
	background-color:#F7ECDC;
	border:1px solid black;
	cursor:pointer;
}

ul.anchorlist li.selected{
	font-weight:bold;
	color:white;
	background-color:#050080;
}

.footer{
	display:none;
}
	
</style>

<script type="text/javascript" src="javascript/admin/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="javascript/admin/bootbox.min.js"></script>

<title>CMS | AhgongAdmin</title>


<div class="container">
	<h4>CMS anchors list</h4>
	
	<div class="row">
		<div class="col-xs-4">
			
			<div>
				<button class="btn btn-xs btn-default" onclick="new_anchor()">New</button>
				<button class="btn btn-xs btn-default" onclick="delete_anchor()">Delete</button>
				<button class="btn btn-xs btn-default" onclick="edit_anchor()">Edit</button>
				<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal">
				  Upload
				</button>
				<button class="btn btn-xs btn-primary" onclick="save_content()">Save</button>
			</div>
			<br>
			<ul class="anchorlist reset-margin">
				
			</ul>	
		</div>
		<div class="col-xs-8">
			<textarea id='edit-textarea' style="display:none;"></textarea>
		</div>
	</div>
	
	
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Upload Image</h4>
      </div>
      <div class="modal-body">
         <?=$this->load->view("admin/controls/image_uploader")?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script type="text/javascript">
	
	function edit_anchor(){
		
		var id=$(".anchorlist").find(".selected").attr("anchorid");
		if(id!=undefined && id!=""){
			var title=prompt("What is the new link title?");
			if($.trim(title)==""){
				alert("Blank title is not allowed");
				return;
			}
			else{
				$.post("admin/cms/edit_anchor",{title:title,id:id},function(result){
					$(".anchorlist").find(".selected").html(title);
				})
			}
		}
		else{
			alert("No anchor selected");
		}
	}
	
	function new_anchor(){
		var title=prompt("What is the link title?");
		if($.trim(title)==""){
			alert("Blank title is not allowed");
			return;
		}
		else{
			$.post("admin/cms/create_anchor",{title:title},function(result){
				$(".anchorlist").append(create_anchor(title,result));
			})
		}
	}
	
	function delete_anchor(){
		var id=$(".anchorlist").find(".selected").attr("anchorid");
		if(id!=undefined && id!=""){
			$.post("admin/cms/delete_anchor",{id:id},function(){
				$(".anchorlist").find(".selected").remove();
			})
		}
		else{
			alert("No anchor selected");
		}
	}
	
	function create_anchor(title,id){
		var html=""
		html    +="<li anchorid='"+id+"' onclick='select_anchor(this)'>";
		html    +="   <small>"+title+"</small>";
		html    +="</li>"
		return html;
	}
	
	var xhr;
	
	function select_anchor(control){
		
		if(ready==false){
			alert("Please wait..")
			return;
		}
		
		if(saving==true){
			alert("Saving..Please wait.")
			return;
		}
		
			if(isDirty==true){
				var r=confirm("Are you sure you want to switch without save?");
				if (!r) return;	
			}
	
		isDirty=false;
		
		$(".anchorlist").find("li").removeClass("selected");
		$(control).addClass("selected");
		if (!tinymce_initiated) initiate_tinymce();
		var id=$(control).attr("anchorid");
		if(xhr!=undefined) xhr.abort();
		ready=false;
		xhr=$.post("admin/cms/get_anchor_content",{id:id},function(result){
			ready=true;
			tinyMCE.get('edit-textarea').setContent(result);
		})
		
	}
	

	
	var isDirty=false;
	var tinymce_initiated=false;
	function initiate_tinymce(){
		
		var textarea=$("#edit-textarea");
		textarea.show();
		tinymce_initiated=true;
		
		tinyMCE.init({
		        // General options
		        mode : "textareas",
		        convert_urls : false,
		        height :500,
		        width:780,
		        save_onsavecallback: save_content,
		        forced_root_block : 'div',
		        theme : "advanced",
		        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
				 setup : function(ed) {
					          ed.onChange.add(function(ed, l) {
					                  isDirty=true;
					          });
					  },
						
				
		        // Theme options
		        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
		        theme_advanced_toolbar_location : "top",
		        theme_advanced_toolbar_align : "left",
		        theme_advanced_statusbar_location : "bottom",
		        theme_advanced_resizing : true,
		
		   		document_base_url : "<?=base_url();?>"
				
				
				
				
				
				
		});


	}
	
	var saving=false;
	var ready=true;

	function save_content(){
		saving=true;
		var content=tinyMCE.get('edit-textarea').getContent();
		var id=$(".anchorlist").find(".selected").attr("anchorid");
		$.post("admin/cms/save_content",{anchorid:id,content:content},function(result){
			isDirty=false;
			saving=false;
			alert("Saved");
		});
		return false;
	}
	
	
	
	function upload_image(){
		
		$('#upload-modal').modal().modal('show');
	}
	
	
	window.onbeforeunload = function() {
		if(isDirty==true){
			return "You have not saved your edit!";
		}
		
	    
	}
	
	JQUERY_CALLBACK.push(function(){
		<?php foreach($anchors as $anchor):?>
			$(".anchorlist").append(create_anchor("<?=$anchor->title?>","<?=$anchor->id?>"));
		<?php endforeach?>
		var uploadhtml=$(".upload").html();
		$(".upload").remove();
	});
	
</script>

