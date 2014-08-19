<style type="text/css">
.treeview{
	max-height:500px;
	overflow:auto;
}	
	
</style>


	<script src="javascript/admin/jstree/jquery.jstree.js" type="text/javascript"></script>	
																														
	<div class="col-xs-4">
		<h4 class="reset-margin">Category</h4>
		<select class="margin-top categoryselect form-control" onchange="category_selected_change()">
			<?php foreach($categorydata as $category):?>
				<option value="<?=$category->id?>"><?=$category->word?></option>
			<?php endforeach?>
		</select>
		<div>
			<label for="normal" class="radio feature radio-default"><input type="radio" name="nodetype" id="normal" value="normal" style="margin-top:3px;" checked>Can search/insert, show on new post</input></label>
			
			<label for="xp" class="radio feature"><input type="radio" name="nodetype" id="xp" value="xp" style="margin-top:3px;">Can search/insert, not show on new post(XP,Eg. dog house)</input></label>
			 
			<label class="feature radio" for="xixp"><input type="radio" name="nodetype" id="xixp" value="xixp" style="margin-top:3px;">Can search, can't insert, not show on new post(XIXP,Eg.Subroot)</input></label>
			 			
			<label for="xsxixp" class="radio feature"><input type="radio" name="nodetype" id="xsxixp" class="left"  value="xsxixp">Can't search/insert, not show on new post(XSXIXP,Eg.Root)</input></label>
				     	
	    	<!--
			<label class="left house radio" for="xsupport"><input type="radio" name="nodetype" id="xsupport" value="xsupport" class="left">Not Support(will return error to user)</input></label>
						-->
				
	    		
			<button class="margin-top btn btn-primary" type="button" onclick='$("#tree1").jstree("create");'>Create New Node</button>
			<button class="margin-top btn btn-primary" type="button" onclick='$("#tree1").jstree("rename");'>Rename Node</button>
			<button class="margin-top btn btn-primary" type="button" onclick='if(!confirm("Are you sure you want to delete this node and its child?")) return false; $("#tree1").jstree("remove");'>Remove Selected Node</button>
		</div>
	</div>
	
	<div class="col-xs-8">
		<div class="treeview">
			<div id="tree1" class="span5">
				
			</div>
				
		</div>

	</div>
	



<script type="text/javascript">
	
	
	$(".treeview").mouseWheelFix();
	
	$(function () {
		$("#tree1").jstree({ 
			"dnd" : {
				"drag_check" : function (data) {
					if(data.r.attr("id") == "phtml_1") {
						return false;
					}
					return { 
						after : false, 
						before : false, 
						inside : true 
					};
				}
			},
			"ui" : {
				"select_limit" : 1,
				"select_multiple_modifier" : "alt",
				"selected_parent_close" : "select_parent",
			},
			"plugins" : [ "themes", "html_data", "ui", "dnd", "crrm"  ]
		});
		
		 $("#tree1").bind("move_node.jstree", function (event, data){ 
		 	var id=$(data.rslt.o[0]).attr("categoryid");
		 	var newparentid=$(data.rslt.np[0]).attr("categoryid")
		 	$.get("admin/category/update_category_parent/"+id+"/"+newparentid)
	
		 });
	
		 $("#tree1").bind("remove.jstree", function (event, data){ 
		 	
			var idstring=$(data.rslt.obj[0]).attr("categoryid")
			$(data.rslt.obj[0]).find('[categoryid]').each(function(index){
			 	  idstring+=","+$(this).attr("categoryid");
			});
			$.post("admin/category/delete_category/",{categoryidstring:idstring})
			
		 });
		
		 $("#tree1").bind("create.jstree", function (event, data){ 
		 	var radiotype=$('input:radio[name=nodetype]:checked').val();
		 	var supportstate;
		 	if(radiotype=="xixp") supportstate=1;
		 	else if(radiotype=="xsxixp") supportstate=-1;
		 	else if(radiotype=="normal") supportstate=0;
		 	else if(radiotype=="xp") supportstate=2;
		 	
		 	var parentcategoryid=$(data.rslt.parent[0]).attr("categoryid");
		 	$.post("admin/category/create_category/"+parentcategoryid,{category:data.rslt.name,supportstate:supportstate},function(id){
		 		data.rslt.obj.attr("categoryid",id);
		 		var category=data.rslt.name;
		 		category+=get_type_text(supportstate);
		 		data.rslt.obj.html(data.rslt.obj.html().replace(data.rslt.name,category));
		 	})
		});
		
		 $("#tree1").bind("rename_node.jstree", function (event, data){ 
		 	var id=$(data.rslt.obj[0]).attr("categoryid")
		 	var word=data.rslt.name;
			var contains = (word.indexOf('||') > -1);
			var wordarr=[];
			if(contains){
				wordarr=word.split("||");
				word=$.trim(wordarr[0]);
			}
			
		 	$.post("admin/category/update_category/"+id,{word:word})
		
	
		 });
		
		
		
		
	});

	
	function category_selected_change(){
		var category=$(".categoryselect option:selected").text();
		$(".radio").hide();
		$("."+category).show();
		$(".radio-default").attr('checked', 'checked');
		refresh_tree($(".categoryselect").val());
	}

	function refresh_tree(rootid){
		
		$.get("admin/category/get_category_all_child/"+rootid,function(result){
			$("#tree1 ul").html("");	
			var objlist=$.parseJSON(result);
		
			var index=0;
			for(y in objlist){
				if(objlist[y].id==rootid){
					index=y;
					break;
				}
			}
			element = objlist[index];
		    objlist.splice(index,1);
		    objlist.splice(0,0,element);
	
			for(x in objlist){
				id=objlist[x].id;
				if(id==rootid){
					$("#tree1").find("ul").append(generate_design_node(id,objlist[x].word,true,objlist[x].supportstate))
				}	
	
				var results = $.grep(objlist, function(e) { 
	           		return (e.parentcategoryid==id && e.id!=id);
	       		});
	       		
	       		var ul=$("<ul></ul>")
	       		
	       		$(results).each(function(i){
	       			var containchild=($.grep(objlist, function(q) { 
						           		return (q.parentcategoryid==results[i].id && q.id!=results[i].id);
						       		 }).length>=1);
	       			
	       			
	       			ul.append(generate_design_node(results[i].id,results[i].word,containchild,results[i].supportstate))
	       		})
	       		
	       		
				$("#node"+id).append(ul);
				$("ul li:last-child").addClass("jstree-last");
			}
		})		
	}

	
	function get_type_text(supportstate){
		if(supportstate==-1) return " || XSXIXP";
		else if(supportstate==1) return " || XIXP";
		else if(supportstate==2) return " || XP";
		else return "";
	}

	
	function generate_design_node(id,word,containchild,supportstate){
		var nodeclass="jstree-open";
		if(containchild==false){
			nodeclass="jstree-leaf";
		}
		var supporttext=get_type_text(supportstate);
		var html="<li class='"+nodeclass+"' id='node"+id+"' categoryid='"+id+"'><ins class='jstree-icon'>&nbsp;</ins><a><ins class='jstree-icon'>&nbsp;</ins>"+word+supporttext+"</a></li>"
		return html;
	}
	
	category_selected_change();
</script>