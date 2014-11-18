<?php
	
 	
 	 function handle_item_data($item){

		$return_item= new stdClass();;
		if (isset($item->id)) $return_item->id=$item->id;
		if (isset($item->price)) $return_item->price=str_replace(",","",$item->price);
		if (isset($item->price)) $return_item->pricetoshow="RM ".$item->price;
		if (isset($item->type)) $return_item->type=$item->type; else $return_item->type="0";
		if (isset($item->smsorweb)) $return_item->smsorweb=$item->smsorweb;
		if (isset($item->name)) $return_item->name=$item->name;
		if (isset($item->username)) $return_item->username=$item->username;
		if (isset($item->feature) && $item->feature=="-") $item->feature="";
		if (isset($item->feature)) $return_item->feature=$item->feature;
		if (isset($item->feature)) $return_item->featuretoshow=$item->feature;
		if (isset($item->feature)) $return_item->featurearr=explode(",",$item->feature);
		if (isset($item->psf)) $return_item->psf=str_replace(",","",$item->psf);
		if (isset($item->psf)) $return_item->psftoshow="RM ".$item->psf."/sqft.";	
		if (isset($item->builtup) || $item->builtup==0 ) $return_item->builtup=str_replace(",","",$item->builtup);	
		if (isset($item->builtup) || $item->builtup==0 ) $return_item->builtuptoshow=$item->builtup." sqft.";	
		if (isset($item->land_area) || $item->land_area==0 ) $return_item->land_area=str_replace(",","",$item->land_area);	
		if (isset($item->land_area) || $item->land_area==0) $return_item->land_areatoshow=$item->land_area." sqft.";	
		if (isset($item->land_area_text)) $return_item->land_area_texttoshow=$item->land_area_text." sqft.";
		if (isset($item->land_area_text)) $return_item->land_area_text=$item->land_area_text;		
		if (isset($item->description)) $return_item->description=$item->description;	
		if (isset($item->posttime)) $return_item->posttime=$item->posttime;	
		if (isset($item->phone)) $return_item->phone=$item->phone;	
		if (isset($item->email)) $return_item->email=$item->email;	
		if (isset($item->userid)) $return_item->userid=$item->userid;	
		if (isset($item->areaname)) $return_item->areaname=$item->areaname;	
		if (isset($item->areaname)) $return_item->areanametoshow=$item->areaname;
		if (isset($item->user_defined_name)) $return_item->user_defined_name=$item->user_defined_name;	
		if (isset($item->latitude)) $return_item->latitude=$item->latitude;	
		if (isset($item->longitude)) $return_item->longitude=$item->longitude;	
		if (isset($item->filesname)) $return_item->filesname=$item->filesname;	
		if (isset($item->categoryid)) $return_item->categoryid=$item->categoryid;	
		if (isset($item->isonline)) $return_item->isonline=$item->isonline;	
		if (isset($item->viewscounter)) $return_item->viewscounter=$item->viewscounter;	
		if (isset($item->isshortlist)) $return_item->isshortlist=$item->isshortlist;	
		if (isset($item->moved_marker)) $return_item->moved_marker=$item->moved_marker;	
		if (isset($item->isfriend) || $item->isfriend==0) $return_item->isfriend=$item->isfriend;		
		if (isset($item->removed) || $item->removed==0) $return_item->removed=$item->removed;		
		if (isset($item->canseephone) || $item->canseephone==0) $return_item->canseephone=$item->canseephone;		
		if (isset($item->moved_marker) || $item->moved_marker==0) $return_item->moved_marker=$item->moved_marker;	
		if (isset($item->pending) || $item->pending==0) $return_item->pending=$item->pending;	
		if (isset($item->original_ownerid)) $return_item->original_ownerid=$item->original_ownerid;	
		if (isset($item->original_ownerusername)) $return_item->original_ownerusername=$item->original_ownerusername;	
		if (isset($item->request_count)) $return_item->request_count=$item->request_count;	
		if (isset($item->my_agent_request)) $return_item->my_agent_request=$item->my_agent_request;	
		if (isset($item->agent_reject_request)) $return_item->agent_reject_request=$item->agent_reject_request;	
		if (isset($item->owner_agent_request)) $return_item->owner_agent_request=$item->owner_agent_request;	
		if (isset($item->bedroom) || $item->bedroom==0) $return_item->bedroom=$item->bedroom;	
		if (isset($item->bathroom) || $item->bathroom==0) $return_item->bathroom=$item->bathroom;	
		if (isset($item->first_file)) $return_item->first_file=$item->first_file;	
		
		if (isset($item->name)) {
			if(strtolower($item->name)=="semi detached house"){
				$return_item->nametoshow="Semi-D";
			}
			else{
				$return_item->nametoshow=$item->name;
			}
			
		}
		
		if (isset($item->areaname)){
			$return_item->areanamearr=explode(",",$return_item-> areaname);
			for ($q=0;$q<count($return_item->areanamearr);$q++){
				if(strpos($return_item->areanamearr[$q],"(")){
					$return_item->areanamearr[$q]=substr($return_item->areanamearr[$q],0,count($return_item->areanamearr)-strpos($return_item->areanamearr[$q],"(")-1);
				}
			}
			

		}
		


		
		if (isset($item->feature))	$return_item->featurearr=explode(",",$return_item-> feature);
		
		
		if (isset($item->type)) {
			if (($return_item-> type)==0){
				$return_item->actiontext ="Selling";
				$return_item->actiontext2="Sell";
			} 
			else {
				$return_item->actiontext ="Buying";
				$return_item->actiontext2="Buy";
			}
		}
		
		$return_item->hasFile=false;
		if (isset($item->id)) {

			if(is_dir('photo/'.$return_item->id)){
				$return_item->filearr=getDirectoryList('photo/'.$return_item->id);
			}
			else $return_item->filearr=array();		
	 	  	
			$return_item->thumbarr= array(); 
			$return_item->filearr = array_filter($return_item->filearr);
			
			for($x=0;$x<=count($return_item->filearr)-1;$x++){
				if(is_dir("photo/".$return_item->id."/".$return_item->filearr[$x])){
					
					array_splice($return_item->filearr,$x,1);
				}	
				
			}
			
			for($x=0;$x<=count($return_item->filearr)-1;$x++){
				if($return_item->filearr[$x]==strtolower($return_item->first_file)){
					moveElement($return_item->filearr,$x,0);
				}	
				
			}
			
			
			$return_item->firstFile ="";
			if (count($return_item->filearr)>0){
				$return_item->firstFile = $return_item->filearr[0];	
				for($q=0;$q<=count($return_item->filearr)-1;$q++){
					array_push($return_item->thumbarr,"photo/".$return_item->id."/thumb/".$return_item->filearr[$q]);
					$return_item->filearr[$q]="photo/".$return_item->id."/".$return_item->filearr[$q];
					
				}
			}
				
			if ($return_item->firstFile!=""){
				$return_item->firstFile="photo/".$return_item->id."/".$return_item->firstFile;
				$return_item->hasFile=true;
			
			}
			else{
				$return_item->firstFile="image/property_image/".strtolower(str_replace(" ","_",$item->name."_".$return_item->actiontext2)).".png";
				
			}
		
		}	
	
	
	
		
	if (isset($item->price)){
		if(($return_item->price)==""){
			$return_item->pricetoshow="User did not specify price.";
		}
		$return_item->pricewithpsftoshow=$return_item->pricetoshow;
		if(($return_item->psf)!=""){
			$return_item->pricewithpsftoshow=$return_item->pricetoshow.' / '.$return_item->psftoshow;
		}
		
	}
	
	
	
	if (isset($item->land_area)){
		
		if($item->land_area=="0") $return_item->land_area = "";
		
		if(($return_item->land_area)==""){
			$return_item->land_areatoshow="User did not specify land area.";
			
		}
	}
	
	
	if (isset($item->builtup)){
			
		if($item->builtup=="0") $return_item->builtup = "";	
		
		if(($return_item->builtup)==""){
			$return_item->builtuptoshow="User did not specify builtup.";
			
		}
	}
	
	
	if($return_item->builtup!="" || ($return_item->builtup=="" && $return_item->land_area=="")){
		$return_item->sizetoshow = $return_item->builtuptoshow;
	}
	else{
		$return_item->sizetoshow = $return_item->land_area_texttoshow;
	}
	
	
	
	
	if (isset($item->feature)){
		if(($return_item->feature)==""){
			$return_item->featuretoshow="User did not specify feature.";
		}
	}	

		
	
		
	if (isset($item->areaname)){
		if(($return_item->areaname)==""){
			$return_item->areanametoshow="User did not specify area.";
		}
	}		
		
		
	if (isset($item->description)){
		$return_item->descriptiontoshow=$return_item->description;
		$return_item->description_original=str_replace('<br />',"",$item->description);
		$return_item->description_original_edit=str_replace('<br />',"",$item->description);
		if(($return_item->description)==""){
			$return_item->descriptiontoshow="User didn't leave any message.";
			$return_item->description_original="User didn't leave any message.";
		}
	}			
		
	if (isset($item->phone)){
		$return_item->fullcontact=$return_item->phone;
	}
		
	if (isset($item->username)){
		$return_item->fullcontact=$return_item-> phone." (".$return_item-> username.")";
	}
		
		
	

    $return_item->areaidlevelstring="";
	$return_item->areanametoshow="";
	if (isset($return_item->areaname)){
		$tmparr=explode(",",$return_item->areaname);
		$return_item->areaname="";
		foreach($tmparr as $e){
			if($e!=""){
				$tmparr2=explode("|",$e);
				
				if(!empty($return_item->user_defined_name)){
					$originalAreaArr = explode("@",$tmparr2[0]);
					$originalAreaArr[0] = ucwords($return_item->user_defined_name);
					$finalArea = implode("@",$originalAreaArr);
					$return_item->areanametoshow.=$finalArea."||";
					$return_item->areaname.=$finalArea.",";
				}
				else{
					$return_item->areanametoshow.=$tmparr2[0]."||";
					$return_item->areaname.=$tmparr2[0].",";
				}
				
				
				$return_item->areaidlevelstring.=$tmparr2[1]."|".$tmparr2[2].",";
			}
		}
		 $return_item->areanametoshow=rtrim($return_item->areanametoshow,"||");
		 $return_item->areaname=rtrim($return_item->areaname,",");
		 $return_item->areanametoshow=str_replace("@",", ",$return_item->areanametoshow);
		 $areanames=explode(",",$return_item->areanametoshow);
		 $return_item->areanameshort=$areanames[0];
		 $return_item->areaidlevelstring=rtrim($return_item->areaidlevelstring,",");

		 
	}
	
	$return_item->randomfactsarr=array();
	if(isset($item->randomfacts)){
		$return_item->randomfactsarr=explode("(%2)",$item->randomfacts);
	}


	if(isset($item->name)){
		$return_item->paddingname=$return_item -> name;
				
		$return_item->paddingnamewithareatoshow=$return_item->paddingname;
		if ($return_item->areanametoshow!=""){
			$return_item->paddingnamewithareatoshow.=" at ".$return_item->areanametoshow;
		}
	}
	else{
		$return_item->paddingname="";
	}


	 $return_item->shortprice="";
		if (isset($item->price)) {
			$return_item->shortprice="RM".abb_number(str_replace(",","",$item->price));
		}
		
	 $return_item->allfeatures=Array();
	 
	 	if(isset($return_item->bedroom) && $return_item->bedroom!=0){
			$return_item->allfeatures[$return_item->bedroom."<span data-toggle='tooltip' title='number of bedroom(s)' class='icon-bed17 margin-left-tiny lh-17'></span>"]="1";
		}
		
		
		if(isset($return_item->bathroom) && $return_item->bathroom!=0){
			$return_item->allfeatures[$return_item->bathroom."<span data-toggle='tooltip' title='number of bathroom(s)' class='icon-bathroom margin-left-tiny lh-17'></span>"]="1";
		}
	 	
		$facility_arr = Array();
		$feature_arr = Array();
		if (isset($return_item->featurearr)){
			
			foreach($return_item->featurearr as $feature){
				if($feature!=""){
					if (in_array($feature, array("Freehold","Leasehold","Malay Reserved Land","Renovated","Corner","End Lot","1 Storey","1.5 Storey","2 Storey","2.5 Storey","3 Storey"))) {
				  	   $return_item->allfeatures[$feature]="1";
						array_push($feature_arr,$feature);
					}
					else{
					   $return_item->allfeatures[$feature]="2";
						array_push($facility_arr,$feature);
					}
				}
			
			}
			$return_item->feature_comma_separated = implode(", ",$feature_arr);
			if(count($feature_arr)==0){
				$return_item->feature_comma_separated = "-";
			}
			$return_item->facility_comma_separated = implode(", ",$facility_arr);
			if(count($facility_arr)==0){
				$return_item->facility_comma_separated = "-";
			}
		}
		
		
		
		
		
		$return_item->url="item/id/".$return_item->id."/".url_title($return_item->actiontext."-".str_replace(Array("@",","),"-",$return_item->paddingnamewithareatoshow));
		
		return $return_item;
 	 }
	 
	 
	 function handle_item_array($itemarr){
	 	$finalresults=Array();	
	 	foreach ($itemarr as $u){
	 		array_push($finalresults,handle_item_data($u));
	 	}
		return $finalresults;
		
	 }
	 
	 
	 function handle_activity_data($activity,$type){
	 	if($activity->action=="newItem" || $activity->action=="editItem" || $activity->action=="addShortlist" || $activity->action=="deleteItem"){
	 		
	 		$temparr=explode("(%2)",$activity->result);
			if(count($temparr)>3){	
				$finaltext="";
				$activity->itemuserid=$temparr[0];
				$activity->itemusername=$temparr[1];
				if($temparr[2]=="0"){
					$finaltext.="Selling ";
				}
				else if($temparr[2]=="1"){
					$finaltext.="Buying ";
				}
				$finaltext.=$temparr[3]." ";
				if(count($temparr)>4){
					$locationarr=explode(",",$temparr[4]);
					$locationtext="";
					foreach($locationarr as $location){
						$eacharr=explode("|",$location);
						$finalarr=explode("@",$eacharr[0]);
						$locationtext.=",".$finalarr[0];
					}
					
					$locationtext=trim($locationtext,",");
					$finaltext.="at ".$locationtext;
				}
				$activity->finaltext=ucwords($finaltext);
				
				
				if(count($temparr)>5){
					
					$activity->original_userid=$temparr[5];
					$activity->original_username=$temparr[6];
				}
				
				
			}
			return $activity;
	 	}
		else if($activity->action=="sendMessage"){
			if($type=="my"){
				$activity->action=$activity->action."First";
			}
			else if($type=="others"){
				$activity->action=$activity->action."Last";
			}
			$temparr=explode("(%2)",$activity->result);
			$activity->conversationtargetid=$temparr[0];
			$activity->conversationtargetusername=$temparr[1];
			return $activity;
		}
		else if($activity->action=="agentReview"){
			$temparr=explode("(%2)",$activity->result);
			$activity->userid=$temparr[0];
			$activity->username=$temparr[1];
			$activity->agent_id=$temparr[2];
			$activity->agent_name=$temparr[3];
			$activity->url="agent_comment/view/".$activity->agent_id."/thread/".(floor(($temparr[4]+1) / 5)*5)."#".$activity->targetid;
			return $activity;
		}
		else{
			return $activity;
		}
	 }
	 
	 
	 function handle_activity_array($activityarr,$type="my"){
	 	$finalresults=Array();	
		foreach ($activityarr as $u){
	 		array_push($finalresults,handle_activity_data($u,$type));
	 	}
		return $finalresults;
	 }
	 
	 function handle_notification_data($notification,$itemsdata_arr,$item_modified_meta_arr){
	 	

		if($notification->action=="acceptAgent" || $notification->action=="agentRequest" || $notification->action=="editItem" || $notification->action=="deleteItem" || $notification->action=="newItem"){
			foreach($itemsdata_arr as $item){
				if($item->id==$notification->targetid){
					$notification->item=$item;
					break;
				}
			}
			
			if(isset($item_modified_meta_arr)){
				foreach($item_modified_meta_arr as $meta){
					if($meta->itemid==$notification->targetid){
						$notification->modified_type=$meta->action;
						$notification->modified_datetime=$meta->modified_datetime;
						break;
					}
				}
			}
			
		}
		else if($notification->action=="replyTopic" || $notification->action=="replyYourTopic"){
			if($notification->lastcommentpage==0 || $notification->lastcommentpage==""){
				$notification->start=0;
			}
			else{
				$notification->start=$notification->lastcommentpage;
			}
		}
	

		return $notification;
	
	 }
	 
	 
	 function handle_notification_array($notificationarr,$itemsdata_arr,$item_modified_meta_arr,$new=false){
	 	$finalresults=Array();	
		foreach ($notificationarr as $u){
			$result=handle_notification_data($u,$itemsdata_arr,$item_modified_meta_arr);	
			$result->new=$new;
	 		array_push($finalresults,$result);
	 	}
		return $finalresults;
	 }
	
	
	function handle_facilities($facilities){
		$facilitiesdict;
		foreach($facilities as $pair){
			if(!isset($facilitiesdict[$pair->main])) $facilitiesdict[$pair->main]=Array();
			array_push($facilitiesdict[$pair->main],ucwords($pair->sub));
		}
		return $facilitiesdict;
	}
		
	function handle_propertylist($propertylist){
		if(($key = array_search("House", $propertylist)) !== false) {
			    unset($propertylist[$key]);
			}
		array_splice($propertylist, 0, 0, "House");
		return $propertylist;
	}
	
	function handle_propertylist_with_id($propertylist_with_id){
		
			
		$id="";
		$x=-1;
		foreach($propertylist_with_id as $property){
			$x++;	
			if(strtolower($property->word)=="house"){
				$id=$property->id;
				break;
			}
			
		}
		
		$out = array_splice($propertylist_with_id, $x, 1);
   		array_splice($propertylist_with_id, 0, 0, $out);
		return $propertylist_with_id;
	}
	
	
	function handle_agent_replies_thread($threads,$comments){
			
		foreach($threads as $thread){
			$arr = Array();
			foreach($comments as $comment){
				if($comment->thread_id==$thread->id){
					array_push($arr,$comment);
				}
			}	
			$thread->comments = $arr;
		}
		return $threads;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
?>