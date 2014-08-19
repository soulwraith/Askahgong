<style type="text/css">
.dictionary-listing li.selected{
	background-color:#000080;
	color:white;
	font-weight:bold;
}
	
.dictionary-listing{
	border:2px solid lightGrey;
	height:350px;
	overflow:auto;
	background-color:white;
	padding:0px;
	margin-top:10px;
	border-radius:6px;
}	

.dictionary-listing li{
	padding:10px;
	cursor:pointer;
}

.dictionary-listing li:hover:not(.selected){
	background-color:#ECECF5;
}


	
</style>

	<div class="page-container">
		<small>
			<a class="right margin-right" href="javascript:void(0)" onclick="switch_sub_page('unitconversion')">Unit Conversion</a>
			<a class="right margin-right" href="javascript:void(0)" onclick="switch_sub_page('wordtype')">Word Type</a>
			<a class="right margin-right" href="javascript:void(0)" onclick="switch_sub_page('wordconversion')">Word Conversion</a>
			
		</small>
		<div class="wordconversion paging">
			<h4 class="reset-margin">Word Conversion</h4>
			<div class="margin-top">
				<form method="post" action="" onsubmit="insert_synonyms();return false;">
					<label>ConvertFrom:</label>
					<input class="form-control" type="text" name="convertfrom">
				
					<label>ConvertTo:</label>
					<input class="form-control" type="text" name="convertto">

					
					<input type="submit" class="btn btn-default" value="Insert Synonyms" style="position: absolute; left: -9999px">
				</form>
			</div>
			<div class="clear"></div>
			<ul class="dictionary-listing reset-margin">
				<?php foreach($synonyms as $item):?>
					<li class="" onmouseup="select_li(this)" oncontextmenu="delete_synonyms(<?=$item->id?>,this);return false;">
						<?=$item->convertfrom?> -> <?=$item->convertto?>
					</li>
				<?php endforeach?>
			</ul>
		</div>
		
		<div class="wordtype paging" style="display:none;">
			<h4 class="reset-margin">Word Type</h4>
			<div class="margin-top">
				<form method="post" action="" onsubmit="insert_wordtype();return false;">
					
					<label>Word Type(CD,NN,VB....):</label>
					<select class="form-control" name="wordtype" onchange="get_word_type_listing()">
						<option value="NOT SUPPORT" selected>NOT SUPPORT</option>
						<option value="IGNORE">IGNORE</option>
						<option value="RUDE">RUDE</option>
						<option value="CHAR">CHAR</option>
						<option value="NN">NN</option>
						<option value="NN_STREET">NN_STREET</option>
						<option value="NN_AREA">NN_AREA</option>
						<option value="CD">CD</option>
						<option value="VB">VB</option>
					</select>
					
					<label>Word:</label>
					<input class="form-control" type="text" name="word">
					
					
					
					
					<input type="submit" class="btn right" value="Insert WordType" style="position: absolute; left: -9999px">
				</form>
			</div>
			<div class="clear"></div>
			<ul class="dictionary-listing reset-margin">

			</ul>
		</div>
		
		<div class="unitconversion paging" style="display:none;">
			<h4 class="reset-margin">Unit Conversion</h4>
			<div class="margin-top">
				<form method="post" action="" onsubmit="insert_unit();return false;">
					<label>Unit:</label>
					<input class="form-control" type="text" name="unit">
					
					<div class="row">
						
						<div class="col-xs-6">
							<label>Column:</label>
							<select class="form-control" name="column">
								<option value="price">Price</option>
								<option value="builtup">BuiltUp</option>
								<option value="psf">Psf</option>
						   </select>
						</div>
						
						<div class="col-xs-6">
							<label>Relation(eg.*2.432):</label>
							<input class="form-control" type="text" name="convertmethod">
						</div>
						
						
					</div>
					
					

					
					<input type="submit" class="btn right" value="Insert Unit" style="position: absolute; left: -9999px">
				</form>
			</div>
			<div class="clear"></div>
			<ul class="dictionary-listing reset-margin">
				<?php foreach($units_conversion as $unit):?>
					<li class="" onmouseup="select_li(this)" oncontextmenu="delete_unit(<?=$unit->id?>,this);return false;">
						<?=$unit->unit?>  <?=$unit->convertmethod?> -- <?=$unit->column?>
					</li>
				<?php endforeach?>
			</ul>
		</div>
				
	</div>

	


<script type="text/javascript">
	
	function switch_sub_page(topage){
		$(".paging").hide();
		$("."+topage).show();
	}
	
	function insert_unit(){
		var unit=$.trim($("input[name=unit]").val());
		var convertmethod=$.trim($("input[name=convertmethod]").val());
		var column=$("select[name=column]").val();
		if($.trim(unit)=="" || $.trim(convertmethod)==""){
			alert("Please fill in all the field");
			return;
		}
		
		var text=unit+"  "+convertmethod+" -- "+column;
		if(check_ul_has_text($(".unitconversion").find("ul"),text)){
			alert("This item already existed");
			return;
		}
		
		
		
		$.post("admin/dictionary/add_unit",{unit:unit,convertmethod:convertmethod,column:column},function(result){
			var html="<li onmouseup='select_li(this)' oncontextmenu='delete_unit("+result+",this);return false;'>"+text+"</li>";
			$(".unitconversion").find("ul").prepend(html);
			$("input[name=unit]").val("").focus();
			$("input[name=convertmethod]").val("");
		})
	}
	
	
	
	function delete_unit(id,control){
		var deleteconfirm = confirm("Delete this unit?");
		if(deleteconfirm){
			$.post("admin/dictionary/delete_unit",{id:id});
			$(control).remove();
		}
	}

	function insert_synonyms(){
		var convertfrom=$.trim($("input[name=convertfrom]").val());
		var convertto=$.trim($("input[name=convertto]").val());
		if($.trim(convertfrom)=="" || $.trim(convertto)==""){
			alert("Please fill in all the field");
			return;
		}
		
		var text=convertfrom+" -> "+convertto;
		if(check_ul_has_text($(".wordconversion").find("ul"),text)){
			alert("This item already existed");
			return;
		}
		
		
		$.post("admin/dictionary/add_synonyms",{convertfrom:convertfrom,convertto:convertto},function(result){
			var html="<li onmouseup='select_li(this)' oncontextmenu='delete_synonyms("+result+",this);return false;'>"+text+"</li>";
			$(".wordconversion").find("ul").prepend(html);
			$("input[name=convertfrom]").val("").focus();
			$("input[name=convertto]").val("");
		})	
	}

	function delete_synonyms(id,control){
		var deleteconfirm = confirm("Delete this synonyms?");
		if(deleteconfirm){
			$.post("admin/dictionary/delete_synonyms",{id:id});
			$(control).remove();
		}
	}
	
	function insert_wordtype(){
		var word=$.trim($("input[name=word]").val());
		var wordtype=$.trim($("select[name=wordtype]").val());
		if($.trim(word)=="" || $.trim(wordtype)==""){
			alert("Please fill in all the field");
			return;
		}
		var text=word+" = "+wordtype;
		if(check_ul_has_text($(".wordtype").find("ul"),text)){
			alert("This item already existed");
			return;
		}
		
		$.post("admin/dictionary/add_wordtype",{word:word,wordtype:wordtype},function(result){
			var html="<li onmouseup='select_li(this)' oncontextmenu='delete_wordtype("+result+",this);return false;'>"+text+"</li>";
			$(".wordtype").find("ul").prepend(html);
			$("input[name=word]").val("");
		})
	}
	
	function get_word_type_listing(){
		var wordtype=$("select[name=wordtype]").val();
		$.post("admin/dictionary/get_word_type_listing",{wordtype:wordtype},function(result){
			$(".wordtype").find("ul").empty();
			var objlist=$.parseJSON(result);
			$(objlist).each(function(){
				var html="<li onmouseup='select_li(this)' oncontextmenu='delete_wordtype("+this.id+",this);return false;'>"+this.word+" = "+this.wordtype+"</li>";
				$(".wordtype").find("ul").prepend(html);
			})
		
		})
	}
	
	
	function delete_wordtype(id,control){
		var deleteconfirm = confirm("Delete this wordtype?");
		if(deleteconfirm){
			$.post("admin/dictionary/delete_wordtype",{id:id});
			$(control).remove();
		}
	}
	
	function check_ul_has_text($ul,text){
		var result=false;
		$ul.find("li").each(function(){
			if($.trim($(this).text().toLowerCase())==$.trim(text.toLowerCase())){
				result=true;
				return false;
			}
		});
		return result;
	}
	
	function select_li(control){
		$(control).parents("ul").find("li").removeClass("selected");
		$(control).addClass("selected");
	}
	
	
	$(".dictionary-listing").mouseWheelFix();	
	get_word_type_listing();
</script>



