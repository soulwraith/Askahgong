<style type="text/css">
.actions,.actions-header{
	list-style-type:none;
	padding:0px;
}	

.actions li,.actions-header li{
	display:inline;
	float:left;
	line-height:19px;
}


.actions li input{
	height:20px;
	font-size:9px;
	width:76px;
	text-align:center;
	border-radius:0px;
	border:1px solid black;
	margin-bottom:0px;
}	

.actions-header li{
	height:18px;
	font-size:11px;
	width:76px;
	border-radius:0px;
	border:1px solid black;
	text-align:center;
	background-color:#6B6666;
	color:white;
}	

.green{
	color:green;
}

.red{
	color:red;
}

input.status{
	background-color:#EEE;
	cursor:pointer;
}

.map-view{
	position:relative;
}

.geocode-form{
	position:absolute;
	top:5px;
	right:5px;
	z-index:50;
}

.geocode-form #address{
	width:175px;
	float:right;
}

.geocode-form .click-address{
	width:295px;
	font-weight:bold;
	background-color:white;
	padding:5px;
}


.list-view .table-container{
	height:440px;
	overflow-y:auto;
	overflow-x:hidden;
}

.list-view table{
	font-size:70%;

}


.list-view table td,.list-view table th{
	text-align:center;
	cursor:pointer;
}
	
.list-view table td{
	border:1px solid #C7C2C2;
	padding:5px 5px;
	line-height:13px;
}	
	
</style>

	<script src="javascript/admin/sorttable.js" type="text/javascript"></script>	

	<div class="">
		<h4 class="left reset-margin">Insert Area</h4>
		<small>
			<a class="right margin-right" href="javascript:void(0)" onclick="switch_sub_page('map-view')">Map View</a>
			<a class="right margin-right" href="javascript:void(0)" onclick="switch_sub_page('list-view')">List View</a>
			
		</small>
		
		<div class="clear"></div>
		
		<div class="list-view">
			
			<div class="margin-top">
				<form onsubmit="find_locations();return false;">
					<input class="form-control" placeholder="Keyword..." name="location_keyword">
					<input type="submit" value="Submit" style="position:absolute;top:-9999px;">
				</form>
			</div>
			
			<div class="table-container">
				<table class="sortable">
					<thead>
						<tr>
						    <th class="">ID</th>
						    <th class="">Residence</th>
						    <th class="">Street</th>
						    <th class="">Area</th>
						    <th class="">Town</th>
						    <th class="">District</th>
						    <th class="">State</th>
						    <th class="">Country</th>
						    <th></th>
						</tr>
					</thead>
	 				<tbody>
	  					
	  
	  
	     			</tbody>
	     		 </table>
			</div>
			
			
		</div>
		
		
		<div class="map-view" style="display:none;">
			
			<form class="geocode-form" onsubmit="reverse_geocoding();return false;">
				<input class="form-control" type="text" id="address" placeholder="Geocode"></input>
				<input class="btn btn-default btn-sm hidden-object" type="submit" value="Geocode" style="margin-top:-9px;"></button>
				<div class="click-address right hidden-object">
					
				</div>
			</form>
			
			<div id="googlemap" class="margin-top" style="height:420px;width:100%;">
			
			</div>
			
			<div style="width:625px;height:65px;overflow:auto;">
				<ul class="reset-margin actions-header">
					<li>Residence</li>
					<li>Street</li>
					<li>Area</li>
					<li>Town</li>
					<li>District</li>
					<li>State</li>
					<li>Country</li>
					<li>Status</li>
				</ul>
				<ul class="reset-margin actions">
					
				</ul>
			</div>
		</div>
		
		
		
		
	</div>
	


<script type="text/javascript">
	$(".table-container").mouseWheelFix();
	
	$(".list-view").find("table").on("click","td",function(){
		var $tr=$(this).parents("tr");
		var id=$tr.find(".areaid").html();
		var $td=$(this);
		var col=$td.attr("class");
		if(!isTrue(col) || col==="areaid") return;
		
		var edit_to=prompt("Change To?",$td.html());
		
		
		if (edit_to!=null)
		  {
			  $td.html(edit_to);
			  $.post("admin/area/update_area_text",{areaid:id,column:col,value:edit_to});
		  }
	})
	
	function switch_sub_page(showing){
		$(".map-view").hide();
		$(".list-view").hide();
		$("."+showing).show();
		$('#googlemap').customGmap3("resize");
	}
	
	function find_locations(){
		var keyword=$("input[name=location_keyword]").val();
		$.post("admin/area/get_area_html_by_keyword",{keyword:keyword},function(results){
			$(".list-view table tbody").html(results);
		})
	}

	var new_area=function(lat,lng){
	        
        $("#googlemap").customGmap3("getAddressByCoord",{lat:lat,lng:lng,callBack:function(results){
        	 var content = results && results[0] ? results && results[0].formatted_address : "no address";
			 add_new_action(content,lat,lng);
        }});
        
	}
	
	function check_area(lat,lng){
			
        
        $("#googlemap").customGmap3("getAddressByCoord",{lat:lat,lng:lng,callBack:function(results){
        	 var content = results && results[0] ? results && results[0].formatted_address : "no address";
			 $(".click-address").html(content).show();
			 var $close =$("<a href='javascript:void(0)'>  close</a>");
			 $close.click(function(){
			 	$(".click-address").hide();
			 });
			 $(".click-address").append($close);
			 var $coord = $("<div style='color:orange;'>"+lat+","+lng+"</div>");
			 
			 $(".click-address").append($coord);
        }});
        
        
	}
	
	function reverse_geocoding(){
		var address=$("#address").val();
  		 var geocoder;
  		 geocoder = new google.maps.Geocoder();
  		 geocoder.geocode( { 'address': address}, function(results, status) {
			     if (status == google.maps.GeocoderStatus.OK) {
			     	var map = $('#googlemap').gmap3('get');
			     	var index=0;
			     	for(x in results){
			     		//alert(results[x].geometry.location.lat()+" AND "+mapobj.getCenter().lat())
			     		var coord1=results[x].geometry.location.lat()+","+results[x].geometry.location.lng();
			     		var coord2=map.getCenter().lat()+","+map.getCenter().lng();
			     		if(coord1==coord2){
			     			if(results.length>(parseInt(x)+1)){
			     				index=(parseInt(x)+1);
			     				break;
			     			}
			     			else{
			     				index=0;
			     				break;
			     			}
			     			
			     		}
	
		
				  	     		
			     	}
			     		// alert(results[0].geometry.location);
			     		
						  map.setCenter(results[index].geometry.location);
						//  alert(mapobj.getCenter())
						  map.setZoom(15);	

			      } 
			      else if (status === google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {    
				            setTimeout(function() {
				                geoCoding(address);
				            }, 200); 
           			 }
            	else {
			        alert("Geocode was not successful for the following reason: " + status);
			      }
	    	});
	    	
  	}
	
	
	
	var delay=function(lat,lnt){
		var delay = 300;            // 1 second
	
		setTimeout(function() { 
		  new_area(lat,lnt);
		}, delay);
	}
	
	var counter=0;
	var add_new_action=function(address,lat,lnt){
		
		
		
		var addr=address.split(",");
		if(addr.length<5){
			var residence="";
			var street=remove_number(addr[0]);
			var area="";
			var town=remove_number(addr[1]);
			var district="Johor Bahru";
			var state=remove_number(addr[2]);
			var country=remove_number(addr[3]);
		}
		else{
			var residence="";
			var street=remove_number(addr[0]);
			var area=remove_number(addr[1]);
			var town=remove_number(addr[2]);
			var district="Johor Bahru";
			var state=remove_number(addr[3]);
			var country=remove_number(addr[4]);
		}
		
		if(town.toLowerCase()==district.toLowerCase()) town="";
		
		
		var html="<li>";
		html+="<input class='custominput' name='residence' type='text' value></input>"
		html+="<input class='custominput street' name='street' type='text' value='"+street+"'></input>"
		html+="<input class='custominput' name='area' type='text' value='"+area+"'></input>"
		html+="<input class='custominput' name='town' type='text' value='"+town+"'></input>"
		html+="<input class='custominput' name='district' type='text' value='"+district+"'></input>"
		html+="<input class='custominput' name='state' type='text' value='"+state+"'></input>"
		html+="<input class='custominput' name='country' type='text' value='"+country+"'></input>"
		html+="<input id='status"+counter+"' statusid='"+counter+"' onclick='retry(this)' class='custominput text-center status' name='status' type='text' value=''></input>"
		html+="<input class='custominput' name='latitude' type='hidden' value='"+lat+"'></input>"
		html+="<input class='custominput' name='longitude' type='hidden' value='"+lnt+"'></input>"
		html+="</li>"
		html+="<div class='clear'></div>"
		$(".actions").prepend(html);
		$(".actions").parents("div").scrollTop(0);
		
		$(".actions").find("input:not(.status)").css("background-color","white").css("font-weight","normal");
		$(".actions").find("li:first").find("input:not(.status)").css("background-color","#F3F36F").css("font-weight","bold");
		
		
		insert_area_get_status(residence,street,area,town,district,state,country,lat,lnt,counter,update_input_status)
		counter++;
	}
	
	function retry(control){
		$(control).blur();
		var li=$(control).parent("li");
		var statusid=$(control).attr("statusid");
		var status=$(control).val();
		var residence=li.find("input[name=residence]").val();
		var street=li.find("input[name=street]").val();
		var area=li.find("input[name=area]").val();
		var town=li.find("input[name=town]").val();
		var district=li.find("input[name=district]").val();
		var state=li.find("input[name=state]").val();
		var country=li.find("input[name=country]").val();
		var lat=li.find("input[name=latitude]").val();
		var lnt=li.find("input[name=longitude]").val();
		var areaid=$(control).attr("areaid");
		if(areaid!=undefined && areaid!=""){
			$(control).val("Retrying..");
			$(control).css("color","black");
			update_area(residence,street,area,town,district,state,country,lat,lnt,statusid,$(control).attr("areaid"));
		}
		else{
			$(control).val("Retrying..");
			$(control).css("color","black");
			insert_area_get_status(residence,street,area,town,district,state,country,lat,lnt,statusid,update_input_status);
		}
		
	
		
	}
	
	function update_input_status(inputid,status,tooltip){

		if(isNumeric(status)){
			$("#status"+inputid).val("OK");
			$("#status"+inputid).attr("areaid",status);
			var latitude=$("#status"+inputid).next().val();
			var longitude=$("#status"+inputid).next().next().val();
			$("#status"+inputid).css("color","green");
			
			add_markers(status,latitude,longitude,tooltip);
			
		}
		else{
			$("#status"+inputid).val("Fail");
			$("#status"+inputid).css("color","red");
		}
	}
	
	
	function update_area(residence,street,area,town,district,state,country,lat,lnt,inputid,areaid){
		$.post("admin/area/update_area",{residence:residence.toLowerCase(),street:street.toLowerCase(),area:area.toLowerCase(),
									town:town.toLowerCase(),district:district.toLowerCase(),state:state.toLowerCase(),country:country.toLowerCase(),
									latitude:lat,longitude:lnt,areaid:areaid},function(status){
						if(isNumeric(status)){
							$("#status"+inputid).val("OK");
							$("#status"+inputid).css("color","green");
						}
						else{
							$("body").append(status);
							$("#status"+inputid).val("Fail");
							$("#status"+inputid).css("color","red");
						}
						
					})
	}
	
	
	function insert_area_get_status(residence,street,area,town,district,state,country,lat,lnt,inputid,callback){
		$.post("admin/area/submit_area",{residence:residence.toLowerCase(),street:street.toLowerCase(),area:area.toLowerCase(),
									town:town.toLowerCase(),district:district.toLowerCase(),state:state.toLowerCase(),country:country.toLowerCase(),
									latitude:lat,longitude:lnt},function(status){
						var tooltip=residence+", "+street+", "+area+", "+town+", "+district+", "+state+", "+country;
						callback(inputid,status,tooltip.toLowerCase());
						
					})
	}
	
	var xhrmap;
	function fill_areas(){
		if (xhrmap != null) {
            xhrmap.abort();
        }
       
		var boundary = $("#googlemap").customGmap3('getBoundary');
		
		xhrmap=$.post("admin/area/get_area/"+boundary.sw_lat+"/"+boundary.sw_lng+"/"+boundary.ne_lat+"/"+boundary.ne_lng,function(result){
			$('#googlemap').customGmap3("clearMarkerByTag","area");
		  	var objlist=$.parseJSON(result);
		  	var markersArr=[];
		  	$(objlist).each(function(){
		  		
		  		
		  		var tooltip=this.residence+", "+this.street+", "+this.area+", "+this.town+", "+this.district+", "+this.state+", "+this.country;
		  		
		  		add_markers(this.id,this.latitude,this.longitude,tooltip);
		  		
		 
		  		
		 
	
		  	});
		});
		
		
		
		
		
	}
	
 	$('#googlemap').customGmap3({
    							idleCallBack:fill_areas,
    							rightClickCallBack:function(map, event){
    								current = event;
							        var lat,lnt;
							        lat=current.latLng.k;
							        lnt=current.latLng.A;
							        delay(lat,lnt);
    							},
    							clickCallBack:function(map, event){
    								current = event;
							        var lat,lnt;
							        lat=current.latLng.k;
							        lnt=current.latLng.A;
					     		 	check_area(lat,lnt);
    							}
							});
	
	
	


	function add_markers(input_id,input_lat,input_lng,tooltip){
	  	$('#googlemap').customGmap3("addMarker",{
						width:34,
						height:34,
						extendBounds:false,
						path:"http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png",
						tag:"area",
						id:input_id,
						data:input_id,
						latitude:input_lat,
						longitude:input_lng,
						title:tooltip,
						rightClickCallBack:function(marker,event,context){
							var r=confirm("Are you sure you want to delete this marker?")
					      	if (!r) return;
					      	marker.setMap(null);
					      	delete_location(context.data,false);
						}
					});
	}



	function delete_location(id,reconfirm,control){
		if(reconfirm){
			var r=confirm("Are you sure you want to delete this location?");
			if (!r) return;
		}
		$.post("admin/area/delete_area",{id:id});
		
		if(isTrue(control)){
			var $control=$(control);
			$control.parents("tr").remove();
		}
		
	}


	
</script>

