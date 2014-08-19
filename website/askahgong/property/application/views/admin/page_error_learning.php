<style type="text/css">
.tabbutton{
	height:30px;
	position:absolute;
	top:-31px;
	border:1px solid black;
	background:red;
	border-bottom:none;
	border-radius:3px 3px 0px 0px;
	-moz-border-radius: 3px 3px 0px 0px;
	-webkit-border-radius: 3px 3px 0px 0px;
	padding:5px 10px 5px 10px;
	text-align:center;
	cursor:pointer;
}	

.tabbutton.selected{
	background:green;
	color:white;
}	

.box-style{
	-webkit-box-shadow: #020304 3px 3px 5px 2px;
	box-shadow: #020304 3px 3px 5px 2px;
	padding:20px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	background-color:#F8F3D1;
	height:550px;
	position:fixed;
	width:650px;
	top:110px;
}

.word 
{
   border-top: 1px solid #96d1f8;
   background: #65a9d7;
   background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
   background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
   background: -moz-linear-gradient(top, #3e779d, #65a9d7);
   background: -ms-linear-gradient(top, #3e779d, #65a9d7);
   background: -o-linear-gradient(top, #3e779d, #65a9d7);
   padding: 5.5px 11px;
   -webkit-border-radius: 3px;
   -moz-border-radius: 3px;
   border-radius: 3px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 18px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   margin-right:15px;
   margin-bottom:15px;
   float:left;
}

.postag{
	position: absolute;
    margin-top: -38px;
    margin-left: -10px;
    font-size: 10px;
    font-weight: bold;
    color: red;
}

.error-list{
	
}

.error-item{
	background-color:white;
	border:1px solid black;
	padding:5px 10px;
	border-radius:6px;
	margin-bottom:10px;
	position:relative;
}

.error-item .handling-username{
	position:absolute;
	padding:1px 5px;
	background-color:#795D4C;
	color:white;
	font-weight:bold;
	top:-15px;
	left:-15px;
	display:none;
	border:2px solid black;
	font-size:0.8em;
	border-radius:6px;
}


.error-item.handling{
	background-color:#F7DFAC;
}

.error-item.handling .handling-username{
	display:block;
	cursor:pointer;
}

.error-item .tokens{
	margin:10px 0px;
	border-bottom:1px solid black;
	padding-bottom:10px;
}

#body{
	min-height:595px;
}

.footer{
	display:none;
}

#googlemap img { max-width: none; }

	
</style>
<title>Error Handling | AhgongAdmin</title>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAzjElo8TqEjCpH3jQrYCi8DP_kWNPhQWQ&libraries=places&sensor=true" type="text/javascript"></script>


<div class="container margin-top PAGE_ERROR">
	<div class="row">
		<div class="col-xs-5">
			<div class="error-list">
				
			</div>
		</div>
		
		<div class="col-xs-7">
			<div class="box-style">
				<div class="tabbutton dictionary" onclick="switch_interface(this,'dictionary')" style="left:10px;"><h4 class="reset-margin">Dictionary</h4></div>
				<div class="tabbutton" onclick="switch_interface(this,'area')" style="left:140px"><h4 class="reset-margin">Area</h4></div>
				<div class="tabbutton" onclick="switch_interface(this,'category')" style="left:220px"><h4 class="reset-margin">Category</h4></div>
				<div class="subpage"></div>
			</div>
		</div>
		
	</div>
</div>





<div class="dictionaryhtml"></div>

<script type="text/javascript">
	
	
	
	
	
	
	
	
	
	var xhr;
	
	function accept_report_agent_review(control,userid,agent_id,thread_id){
		if(confirm("Are you sure you want to delete the reported comment?")){
			$.post("agent_comment/delete_previous_thread",{userid:userid,agent_id:agent_id,admin_delete:"true"},function(result){
				$.post("admin/error_learning/delete_learning",{processid:$(control).attr("processid")});
			});
			me_handled_error($(control).attr("processid"));
			$(control).parents(".error-item").remove();
		}
	}
	
	function reject_report_agent_review(control,userid,agent_id,thread_id){
		if(confirm("Are you sure you want to mark this reported comment as safe?")){
			$.post("agent_comment/unreport_agent_thread",{thread_id:thread_id},function(result){
				$.post("admin/error_learning/delete_learning",{processid:$(control).attr("processid")});
			});
			
			me_handled_error($(control).attr("processid"));
			$(control).parents(".error-item").remove();
		}
	}
	
	
	function retry_learning(control){
		$.post("admin/error_learning/retry_learning",{processid:$(control).attr("processid"),smsorweb:$(control).attr("smsorweb")},function(result){
			if(!result){
				alert("Action ignored, this record is already not in learning state.")
			}
		});
		me_handled_error($(control).attr("processid"));
		$(control).parents(".error-item").remove();
	}
	
	function update_learning(control,type,msg,waiting_code){
		if(type=="prompt"){
			var reason=prompt(msg);
			if($.trim(reason)!=""){
				$.post("admin/error_learning/update_learning",{processid:$(control).attr("processid"),reason:reason,waitingcode:waiting_code},function(result){
					if(!result){
						alert("Action ignored, this record is already not in learning state.")
					}
				});
				me_handled_error($(control).attr("processid"));
				$(control).parents(".error-item").remove();
			}
			else{
				alert("Input a reason!")
			}
		}
		else if(type=="confirm"){
			if(confirm(msg)){
				$.post("admin/error_learning/update_learning",{processid:$(control).attr("processid"),waitingcode:waiting_code},function(result){
					if(!result){
						alert("Action ignored, this record is already not in learning state.")
					}
				});
				me_handled_error($(control).attr("processid"));
				$(control).parents(".error-item").remove();
			}
		}
		
	}
	
	function reject_learning(control){
		var reason=prompt("Tell the user the reason you reject his item.");
		if($.trim(reason)!=""){
			$.post("admin/error_learning/reject_learning",{processid:$(control).attr("processid"),reason:reason},function(result){
				if(!result){
					alert("Action ignored, this record is already not in learning state.")
				}
			});
			me_handled_error($(control).attr("processid"));
			$(control).parents(".error-item").remove();
		}
		else{
			alert("Input a reason!")
		}
	}
	
	function delete_learning(control){
		var r=confirm("Are you sure you want to delete this error without inform user?")
		if(r){
			$.post("admin/error_learning/delete_learning",{processid:$(control).attr("processid")},function(result){
				if(!result){
					alert("Action ignored, this record is already not in learning state.")
				}		
			});
			me_handled_error($(control).attr("processid"));
			$(control).parents(".error-item").remove();
		}
	}
	
	function award_from_learning(userid,processid,type,control){
		var word=prompt("What "+type+ " this user has taught Ahgong?");
		if($.trim(word)!=""){
			$.post("admin/error_learning/award_from_learning",{type:type,userid:userid,processid:processid,word:word});
			$(control).remove();
		}
		else{
			alert("Type Something!");
		}
		
	}
	
	function update_user_text(id,textarea){
		$textarea=$(textarea);
		$.post("admin/error_learning/change_user_text",{processid:id,text:$textarea.val()});
	}
	
	function update_learnqueue(){
		var maximum = 0;

		$('.error-item').each(function() {
		  var value = parseFloat($(this).attr('learnqueue'));
		  maximum = (value > maximum) ? value : maximum;
		});
		
		learnqueue_counter=maximum;
		
	}
	
	function switch_interface(control,to){
		$(".tabbutton").removeClass("selected");
		$(control).addClass("selected");
		if(xhr) xhr.abort();
		switch(to){
			
			case "dictionary":
				xhr=$.get("admin/dictionary/get_design",function(html){
					$(".subpage").html(html);
				})
			break;
			case "area":
				xhr=$.get("admin/area/get_design",function(html){
					$(".subpage").html(html);
				
				})
			break;
			case "category":
				xhr=$.get("admin/category/get_design",function(html){
					$(".subpage").html(html);
				})
			break;
			
		}
		
	}
	
	function handle_move_location(control,error_id){
		var coord = prompt("Enter new coordinates separated by comma.","");
		var re = /^[0-9]+(\.[0-9]+)\,[0-9]+(\.[0-9]+)?$/;
		if (isTrue(coord) && re.test(coord))
		{
			
			var tmp = coord.split(",");
			var regex=/latitude: [0-9]+(\.[0-9]+)?/;
			var html = $(control).parents(".error-item").find(".all-details").html();
			html = html.replace(regex,"latitude: "+tmp[0]);
			var regex2=/longitude: [0-9]+(\.[0-9]+)?/;
			html = html.replace(regex2,"longitude: "+tmp[1]);
		 	$(control).parents(".error-item").find(".all-details").html(html); 

		 	var original = $(control).find(".sentence").html();
		 	var regex3=/latitude\(%1\) [0-9]+(\.[0-9]+)/g;
		 	original = original.replace(regex3,"latitude(%1) "+tmp[0]);
		 	var regex4=/longitude\(%1\) [0-9]+(\.[0-9]+)/g;
		 	original = original.replace(regex4,"longitude(%1) "+tmp[1]);
		 	$(control).find(".sentence").html(original);
		 	$.post("admin/error_learning/change_user_text",{processid:error_id,text:original});
		}
		else{
			alert("Wrong format.")
		}
		
	}
	
	JQUERY_CALLBACK.push(function(){
		 $.post("admin/error_learning/get_pending_error",function(result){
			$(".error-list").append(result);
			
		})	
		switch_interface($(".dictionary"),"dictionary");
	});
	 
	
	
</script>


