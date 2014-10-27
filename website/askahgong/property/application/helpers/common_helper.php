<?php
	
	//url segment = orignal segment count + 1(for paging)
	function generate_pagination($site_url,$url_segment_count,$total_rows,$limit,$suffix="",$class=""){
		
		$CI =& get_instance();
		
		$CI->load->library('pagination');
		$config['base_url']   = site_url($site_url);
		$config['suffix'] = $suffix;
		$config['first_url'] = $config['base_url'].$config['suffix'];
		$config['last_link'] = FALSE;
		$config['first_link'] = FALSE;
		$config['anchor_class'] = 'class="icons '.$class.'"';
		$config['uri_segment'] = $url_segment_count;
		$config['cur_tag_open'] = '<div class="current-page icons">';
		$config['cur_tag_close'] = '</div>';
		$config['total_rows'] = $total_rows;
		$config['per_page']   = $limit;
		
		$CI->pagination->initialize($config);
		
		
		return $CI->pagination->create_links();
	}
	
	function push_task($name,$type,$sql,$arr){
		GLOBAL $accTasks;
		array_push($accTasks,$name);
		array_push($accTasks,$type);
		array_push($accTasks,$sql);
		array_push($accTasks,implode("(%separator1)",$arr));
	}
	
	function get_userid(){
		$CI =& get_instance();
		$userid=$CI->session->userdata('userid');
		if(!isset($userid) || $userid=="") $userid=0;
		return $userid;
	}
	
	function is_agent($user){
		if($user->original_role=="Agent"){
			return true;
		}
		else{
			return false;
		}
	}
	
	function is_verified_agent($user){
		if(($user->role=="Agent" || $user->role=="Part Time Agent") && ($user->verified_agent=="1")){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function is_legal_agent($user){
		if(($user->role=="Agent") && ($user->verified_agent=="1")){
			return true;
		}
		else{
			return false;
		}
	}
	
	function get_start_pagination_by_row_number($rownumber,$limit){
		$start=0;	
		if($rownumber!=""){
			$start=floor($rownumber/$limit);
			$start=$start*$limit;
		}
		return $start;
	}
	
	
	function ago($time,$show_ago=true,$extraspace=false)
{
	if($time==""){
		return "-";
	}
	date_default_timezone_set('Asia/Singapore');
	$time = strtotime($time);
    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
	
	$returnvalue="";
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        if(!$extraspace){
        	 $returnvalue= $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'')." ago";
        }
		else{
			 $returnvalue= $numberOfUnits.' &nbsp;'.$text.(($numberOfUnits>1)?'s':'')." ago";
		}
       
		break;
    }
	if($returnvalue==""){
		$returnvalue = "less than a minute ago";
	}
	
	if(!$show_ago){
		$returnvalue=str_replace(" ago","",$returnvalue);
	}
	
	return $returnvalue;
}

	function get_current_datetime(){
			date_default_timezone_set('Asia/Singapore');
			 return date('Y-m-d H:i:s');
	}

	function try_convert_to_24_hr($input){
		if (strpos($input,'AM') !== false || strpos($input,'PM') !== false) {
		   $arr=explode(" ",$input);
			$time=date("H:i:s", strtotime($arr[1].$arr[2]));
			return $arr[0]." ".$time;
		}
		else{
			return $input;
		}
	}
	
	function convert_content_string_to_html($contentstring){
		$contentstring=str_replace("(%1)",(":"),$contentstring);
		$contentstring=str_replace("(%2)",(","),$contentstring);
		$contentstring=str_replace("(%3)",("<br>"),$contentstring);
		return $contentstring;
	}
	
	function convert_date_to_asia_format($inputdate){
		return date('d/m/Y g:i A',strtotime($inputdate));
	}
	
	function convert_int_month_to_text($month){
		switch($month){
			
			case 1:
				return "January";
			break;
			case 2:
				return "February";
			break;	
			case 3:
				return "March";
			break;	
			case 4:
				return "April";
			break;	
			case 5:
				return "May";
			break;	
			case 6:
				return "June";
			break;	
			case 7:
				return "July";
			break;	
			case 8:
				return "August";
			break;	
			case 9:
				return "September";
			break;	
			case 10:
				return "October";
			break;	
			case 11:
				return "November";
			break;	
			case 12:
				return "December";
			break;	

			
		}
	}

	function convert_item_to_post_data($item){
		
	}
	
	 function convert_post_data_to_item(){
		
			$CI =& get_instance();
			$item= new stdClass();;
			$item->id=null;
			$item->type=$CI->input->post('action');
			$item->name=$CI->input->post('itemname');
			$pricemin=$CI->input->post('pricemin');
			$pricemax=$CI->input->post('pricemax');
			$pricemin=str_replace(",","",$pricemin);
			$pricemax=str_replace(",","",$pricemax);
			
			if($pricemin!="" && $pricemax!=""){
				if($item->type==0){
					$item->price=$pricemin;
				}
				else{
					$item->price=$pricemax;
				}
			}
			else if($pricemin=="" && $pricemax!=""){
				$item->price=$pricemax;
			}
			else if($pricemin!="" && $pricemax==""){
				$item->price=$pricemin;
			}
			else{
				$item->price="";
			}
			
			
			$item->bedroom=$CI->input->post('bedroom');
			$item->bathroom=$CI->input->post('bathroom');
			$item->builtup=$CI->input->post('builtup');
			$item->builtup=str_replace(",","",$item->builtup);
			$item->land_area=$CI->input->post('land_area');
			$item->land_area=str_replace(",","",$item->land_area);
			$item->land_area_width=$CI->input->post('land_area_width');
			$item->land_area_width=str_replace(",","",$item->land_area_width);
			$item->land_area_height=$CI->input->post('land_area_height');
			$item->land_area_height=str_replace(",","",$item->land_area_height);
			$item->feature=$CI->input->post('feature');
			$item->areaname=$CI->input->post('area');
			$item->areaidlevelstring=$CI->input->post('areaidlvl');
			$areacoordinates=$CI->input->post('areacoordinates');
			if(isset($areacoordinates) && $areacoordinates!=false){
				$areacoor_arr=explode(",",$areacoordinates);
				$latitudearr=Array();
				$longitudearr=Array();
				foreach($areacoor_arr as $coor){
					$coor_arr=explode("@",$coor);
					
					array_push($latitudearr,$coor_arr[0]);
					array_push($longitudearr,$coor_arr[1]);
				}
				
				$item->latitude=implode(",", $latitudearr);
				$item->longitude=implode(",", $longitudearr);
			}
			return $item;
	}

	 function convert_post_data_to_content_string($item=null,$edit_id=0){
		
			$CI =& get_instance();
		
			if($CI->input->post('action')!="") $action=$CI->input->post('action');
			else if (isset($_GET['action'])) $action=$_GET['action'];
			else if(isset($item)) $action=$item->type;
			else $action="1";
			$post = " action(%1) " . $action;
			$post .= "(%3)";
			
			if($CI->input->post('itemname')) $itemname=$CI->input->post('itemname');
			else if (isset($_GET['itemname'])) $itemname=$_GET['itemname'];
			else if(isset($item)) $itemname=$item->name;
			else $itemname="house";
			$post .= " name(%1) " . $itemname;
			$post .= "(%3)";
			
			if($CI->input->post('area')) $area=$CI->input->post('area');
			elseif($CI->input->post('area')) $area=$CI->input->post('area');
			elseif(isset($_GET['area'])) $area=$_GET['area'];
			else if(isset($item)) $area=$item->areaname;
			else $area="";
			$post .= " area(%1) " . str_replace(",","(%2)",$area);
			$post .= "(%3)";
			
			if($CI->input->post('area_unknown')) $area_unknown=$CI->input->post('area_unknown');
			else $area_unknown="";
			$post .= " area_unknown(%1) " . str_replace(",","(%2)",$area_unknown);
			$post .= "(%3)";
			
			
			
			if($CI->input->post('feature')) $feature=$CI->input->post('feature');
			else if (isset($_GET['feature'])) $feature=$_GET['feature'];
			else if(isset($item)) $feature=$item->feature.",@loose";
			else $feature="";
			$post .= " feature(%1) " . str_replace(",","(%2)",$feature);
			$post .= "(%3)";


			if($CI->input->post('feature_unknown')) $feature_unknown=$CI->input->post('feature_unknown');
			else $feature_unknown="";
			$post .= " feature_unknown(%1) " . str_replace(",","(%2)",$feature_unknown);
			$post .= "(%3)";
			
			
			if($CI->input->post('price')) $price=$CI->input->post('price');
			else if (isset($_GET['price']))  $price=$_GET['price'];
			else if(isset($item)) {		//ahgong item price rule,sell mean u want sell at least the price,buy mean at most
				if($item->type==0) {$pricemin=$item->price-($item->price*15/100); $price=0; }
				else {$pricemax=$item->price+($item->price*15/100);$price=0;}
				
			}
			else $price=0;
			
			if($CI->input->post('pricemin')) $pricemin=$CI->input->post('pricemin');
			else if (isset($_GET['pricemin'])) $pricemin=$_GET['pricemin'];
			else if(!isset($pricemin)) $pricemin=0;
			
			if($CI->input->post('pricemax')) $pricemax=$CI->input->post('pricemax');
			else if (isset($_GET['pricemax'])) $pricemax=$_GET['pricemax'];
			else if(!isset($pricemax)) $pricemax=0;
		
				if($price!=0){
					$post .= " price(%1) " . $price;
					$post .= "(%3)";
				}
				
				if($pricemin!=0){
					$post .= " pricemin(%1) " . $pricemin;
					$post .= "(%3)";
				}
				
				if($pricemax!=0){
					$post .= " pricemax(%1) " . $pricemax;
					$post .= "(%3)";
				}
			
			
			
			
			if($CI->input->post('builtup')) $size=$CI->input->post('builtup');
			else if (isset($_GET['builtup'])) $size=$_GET['builtup'];
			else if(isset($item)) $size=$item->builtup;
			else $size="";
			$post .= " builtup(%1) " . $size;
			$post .= "(%3)";
			
			if($CI->input->post('land_area')) $land_area=$CI->input->post('land_area');
			else if (isset($_GET['land_area'])) $land_area=$_GET['land_area'];
			else if(isset($item)) $land_area=$item->land_area;
			else $land_area="";
			$post .= " land_area(%1) " . $land_area;
			$post .= "(%3)";
			
			if($CI->input->post('land_area_width')) $land_area_width=$CI->input->post('land_area_width');
			else if (isset($_GET['land_area_width'])) $land_area_width=$_GET['land_area_width'];
			else if(isset($item)) $land_area_width=$item->land_area_width;
			else $land_area_width="";
			
			if($CI->input->post('land_area_height')) $land_area_height=$CI->input->post('land_area_height');
			else if (isset($_GET['land_area_height'])) $land_area_height=$_GET['land_area_height'];
			else if(isset($item)) $land_area_height=$item->land_area_height;
			else $land_area_height="";
			
			$land_area_text = "";
			if(!empty($land_area_width) && !empty($land_area_height)){
				$land_area_text = $land_area_width." X ".$land_area_height;
			}
			$post .= " land_area_text(%1) " . $land_area_text;
			$post .= "(%3)";
			
			if($CI->input->post('bedroom')) $bedroom=$CI->input->post('bedroom');
			else if (isset($_GET['bedroom'])) $bedroom=$_GET['bedroom'];
			else if(isset($item)) $bedroom=$item->bedroom;
			else $bedroom="";
			$post .= " bedroom(%1) " . $bedroom;
			$post .= "(%3)";
			
			if($CI->input->post('bathroom')) $bathroom=$CI->input->post('bathroom');
			else if (isset($_GET['bathroom'])) $bathroom=$_GET['bathroom'];
			else if(isset($item)) $bathroom=$item->bathroom;
			else $bathroom="";
			$post .= " bathroom(%1) " . $bathroom;
			$post .= "(%3)";
			
						
			if($CI->input->post('description')) $description=$CI->input->post('description');	
			else $description="";		
			$post .= " description(%1) " . nl2br($description);
			$post .= "(%3)";
			
			$moved_marker=$CI->input->post('moved_marker');	
			if($moved_marker!=""){
				$post .= " moved_marker(%1) " . $moved_marker;
				$post .= "(%3)";
			}
			
			$files=$CI->input->post('real_file_name');	
			if($files==""){
				if(dir_contains_children("photo/".$edit_id)){
					$files = "HAS_FILE";
				}
			}
			if($files!=""){
				$post .= " files(%1) " . $files;
				$post .= "(%3)";
			}
			
			


			if($CI->input->post('coordinates')) {
				$coordinates=$CI->input->post('coordinates');	
				$latlnt=explode(",",$coordinates);
				$post .= " latitude(%1) " . $latlnt[0];
				$post .= "(%3)";	
				$post .= " longitude(%1) " . $latlnt[1];
				$post .= "(%3)";
			}
			
			
			
			return $post;
	}
 
 	function is_empty_default($input,$default="-"){
 		if($input==""){
 			return $default;
 		}
		else{
			return $input;
		}
 	}
	
	function is_empty_default_email($input,$default="-"){
		if($input==""){
 			return $default;
 		}
		else{
			return "<a href='mailto:".$input."'>".$input."</a>";
		}
	}
 	
	function contain_string($input,$check){
		if(preg_match('['.$check.']', $input)){
			return true;
		}
		else{
			return false;
		}
	}
 	 
	 
	function cutofftext($text, $length = 100, $ending = '...', $exact = true, $considerHtml = true) {
		 if ($considerHtml) {
		  // if the plain text is shorter than the maximum length, return the whole text
		  if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
		   return $text;
		  }
		
		  // splits all html-tags to scanable lines
		  preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		
		  $total_length = strlen($ending);
		  $open_tags = array();
		  $truncate = '';
		
		  foreach ($lines as $line_matchings) {
		   // if there is any html-tag in this line, handle it and add it (uncounted) to the output
		   if (!empty($line_matchings[1])) {
		    // if it’s an “empty element” with or without xhtml-conform closing slash (f.e.)
		    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
		    // do nothing
		    // if tag is a closing tag (f.e.)
		    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
		     // delete tag from $open_tags list
		     $pos = array_search($tag_matchings[1], $open_tags);
		     if ($pos !== false) {
		      unset($open_tags[$pos]);
		     }
		     // if tag is an opening tag (f.e. )
		    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
		     // add tag to the beginning of $open_tags list
		     array_unshift($open_tags, strtolower($tag_matchings[1]));
		    }
		    // add html-tag to $truncate’d text
		    $truncate .= $line_matchings[1];
		   }
		
		   // calculate the length of the plain text part of the line; handle entities as one character
		   $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
		   if ($total_length+$content_length > $length) {
		    // the number of characters which are left
		    $left = $length - $total_length;
		    $entities_length = 0;
		    // search for html entities
		    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
		     // calculate the real length of all entities in the legal range
		     foreach ($entities[0] as $entity) {
		      if ($entity[1]+1-$entities_length <= $left) {
		       $left--;
		       $entities_length += strlen($entity[0]);
		      } else {
		       // no more characters left
		       break;
		      }
		     }
		    }
		    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
		    // maximum lenght is reached, so get off the loop
		    break;
		   } else {
		    $truncate .= $line_matchings[2];
		    $total_length += $content_length;
		   }
		
		   // if the maximum length is reached, get off the loop
		   if($total_length >= $length) {
		    break;
		   }
		  }
		 } else {
		  if (strlen($text) <= $length) {
		   return $text;
		  } else {
		   $truncate = substr($text, 0, $length - strlen($ending));
		  }
		 }
		
		 // if the words shouldn't be cut in the middle...
		 if (!$exact) {
		  // ...search the last occurance of a space...
		  $spacepos = strrpos($truncate, ' ');
		  if (isset($spacepos)) {
		   // ...and cut the text in this position
		   $truncate = substr($truncate, 0, $spacepos);
		  }
		 }
		
		 // add the defined ending to the text
		 $truncate .= $ending;
		
		 if($considerHtml) {
		  // close all unclosed html-tags
		  foreach ($open_tags as $tag) {
		   $truncate .= '';
		  }
		 }
		
		return $truncate;
		
	} 
	 
	 
 	
 	 function uppercase_firstchar($inputtext){
 	 	return ucfirst(strtolower($inputtext));
		 	
 	 }
	
	function linkify($text){
		 $text= preg_replace("/(^|[\n ])([\w]*?)([\w]*?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" target='blank'>$3</a>", $text);  
        $text= preg_replace("/(^|[\n ])([\w]*?)((www)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" target='blank'>$3</a>", $text);
                $text= preg_replace("/(^|[\n ])([\w]*?)((ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"ftp://$3\">$3</a>", $text);  
        $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);  
        return($text);  
		
	}	
	
	
		
	
	function convert_arr_to_string_seperated_by_comma($arr){
		$string="";	
		if (count($arr)==0){
			return "";
		}
		foreach($arr as $item){
			$string.=$item.",";
		}
		return substr($string,0,-1);
	}
	
	function convert_pic_to_jpg($file){
		if(strpos($file, ".jpg")){
			return $file;
		}
		else if(strpos($file, ".png")){
			$image = imagecreatefrompng($file);
		}
		else if(strpos($file, ".gif")){
			$image = imagecreatefromgif($file);
		}
		else if(strpos($file, ".bmp")){
			$image = imagecreatefromwbmp($file);
		}
		
	    imagejpeg($image, $outputFile, 0);
	    imagedestroy($image);
		return $outputFile;
	}
	
	function handle_file($itemid){
		if(!is_dir('photo/'.$itemid)){
			mkdir('photo/'.$itemid, 0771);
		} 
		$CI =& get_instance();
		if($CI->input->post('real_file_name')){
			$filename=$CI->input->post('real_file_name');	
			$filenamearr=explode(",",$filename);
			foreach($filenamearr as $file){
				if($file!=""){
					
					$filetype=explode(".",$file);
					if($filetype[1]=="jpeg") $filetype[1]="jpg";	
					while (true) {
						 $newfilename = uniqid('pic', true);
					     $newfilename =str_replace(".","t",$newfilename). '.'.$filetype[1];
						  if (!file_exists("photo/".$itemid."/" . $newfilename)) break;
					}
					copy("upload/" .$file,"photo/".$itemid."/" . $newfilename);			
				
				}			
			
			}

			
			
		} 
	}
	
	
	function dir_contains_children($dir) {
	    $result = false;
		if(!is_dir($dir)){
			return $result;
		}
	    if($dh = opendir($dir)) {
	        while(!$result && ($file = readdir($dh)) !== false) {
	            $result = $file !== "." && $file !== "..";
	        }
	
	        closedir($dh);
	    }
	
	    return $result;
	}
	
	function getDirectoryList ($directory) 
	  {
	
	    // create an array to hold directory list
	    $results = array();
	
	    // create a handler for the directory
	    $handler = opendir($directory);
	
	    // open directory and walk through the filenames
	    while ($file = readdir($handler)) {
	
	      // if file isn't this directory or its parent, add it to the results
	      if ($file != "." && $file != "..") {
	        $results[] = $file;
	      }
	
	    }
	
	    // tidy up: close the handler
	    closedir($handler);
	
	    // done!
	    return $results;
	
	  }

	function populate_features(){
		$CI =& get_instance();
		$featureslist= $CI->property_model->get_features();
		$result="<script type='text/javascript'>";
		$result.="var featuredata = [];";
	
		 $i=1;
		foreach($featureslist as $feature){
			$result.="featuredata.push({value:".$i.",name:'".$feature."'});";
			$i++;
		}
		$result.="</script>";
		return $result;
	}

	function populate_areadata(){
	
	
		
		$CI =& get_instance();
		$areadata= $CI->area_model->get_area_and_latlnt();
		

		
		$result="<script type='text/javascript'>";
		$result.="var areadata = [];";
		
		foreach($areadata as $x){
			foreach($x as $each){
				$result.='areadata.push({id:"'.$each->mProps->id.'",residence:"'.$each->mProps->residence.'",street:"'.$each->mProps->street.'",area:"'.$each->mProps->area.'",town:"'.$each->mProps->town.'",district:"'.$each->mProps->district.'",state:"'.$each->mProps->state.'",country:"'.$each->mProps->country.'",latitude:"'.$each->mProps->latitude.'",longitude:"'.$each->mProps->longitude.'"});';
				//$result.='arealatlng.push({id:"'.$each->mProps->id.'",latitude:"'.$each->mProps->latitude.'",longitude:"'.$each->mProps->longitude.'"});';							
				}
		}
		
		

		
		$result.="</script>";
		return $result;
		
	
		
		/*
			$result="<script type='text/javascript'>";
							$result.="var areadata = [];var arealatlng=[];";
							$result.='areadata.push({residence:"abc ville",street:"jalan mas",area:"taman ros",town:"ulu tiram",district:"johor bahru",state:"johor",country:"malaysia"});';
							//$result.='areadata.push({value:"asdsa",name:"sadsda"});';
							$result.="</script>";
							return $result;*/
		
		
		
	}

	function check_picture_valid($path){
	
		
		if (file_exists($path)) {
		    echo $path."?lastmod=".date('Format String');
		} else {
		    echo "image/usernoimage.png";
		}
	}

	function concat_if_plural($fixedtext,$concattext,$number,$includenumber=true,$deletecount=0){
		if ($deletecount>0 && $number>1)	
		$fixedtext=substr($fixedtext,0,-$deletecount);
			
		if($includenumber){
			if($number==""){
			return "0 ".$fixedtext;
			}
			else if($number>1){
				return $number." ".$fixedtext.$concattext;
			}
			else if($number<=1){
				return $number." ".$fixedtext;
			}
		}	
		else{
			if($number==""){
			return $fixedtext;
			}
			else if($number>1){
				return $fixedtext.$concattext;
			}
			else if($number<=1){
				return $fixedtext;
			}
		}
		
	}
	
	function changeifme($deftext,$totext,$meornot){
		if ($meornot==get_userid())
			return $totext;
		else 
			return $deftext;
		
			
		}
		
		

	
	function abb_number($var)
{
    if(($var/10000000000)>1)
    {
        $retVal=round($var/10000000000,0).'B';
    }
    else if(($var/1000000)>1)
    {
        $retVal=round($var/1000000,0).'M';
    }
    else if(($var/1000)>1)
    {
        $retVal=round($var/1000,0).'K';
    }
    else
    {
        $retVal=$var;
    }
    return $retVal;
}

	function strip_redundant($jsonarr){
		if(is_numeric($jsonarr)){
			return $jsonarr;
		}
		$resultlist=Array();
		
		
			
		foreach($jsonarr->result as $e){
			foreach($e as $final){
				array_push($resultlist,$final);
			}
			
		}
	
		return $resultlist;
	}
	
	function strip_redundant_single_item($jsonarr){
		if(is_numeric($jsonarr) || !isset($jsonarr)){
			return $jsonarr;
		}
		$result="";	
		foreach($jsonarr->result as $e){
			foreach($e as $final){
				$result=$final;
			}
			
		}
		return $result;
	}
	

	function explode_remove_empty($delimiter,$text){
		return array_filter( explode($delimiter,$text), 'strlen' ); 
	}

	function get_user_profile_pic($userid,$no_imagepath="image/usernoimage.png"){
		$path='photo/profile/'.$userid.'.png';
		if (file_exists($path)) {
		    return $path."?lastmod=".date('Format String');
		} else {
		    return $no_imagepath;
		}
	
	}
	
	function moveElement(&$array, $a, $b) {
	    $out = array_splice($array, $a, 1);
	    array_splice($array, $b, 0, $out);
	}
	
	function get_username($userid){
		$CI =& get_instance();
		if($userid=="") return "";
		$CI->load->model('user_model');
		$username=$CI->user_model->get_username_by_userid($userid);
		return $username;
		
	}
	
	function get_coordinates_by_areaid($areaid){
		$CI =& get_instance();
		$CI->load->model('area_model');
		$coordinates=strip_redundant_single_item($CI->area_model->get_coordinates_by_areaid($areaid));
		return $coordinates;
	}

	function get_assets($type){
		if($type==0){			//developing
			$assets='<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
					<link type="text/css" href="css/global.css" rel="stylesheet" media="screen" />
					<link href="css/jquery.pnotify.default.css" media="all" rel="stylesheet" type="text/css" />
					<link href="css/jquery.mCustomScrollbar.css"  media="all" rel="stylesheet" type="text/css" />
					<script src="javascript/jquery-1.10.2.min.js" type="text/javascript"></script>	
					<script src="javascript/jquery.scrollTo-min.js" type="text/javascript"></script>
					<script src="javascript/pubnub_related.js" type="text/javascript"></script>	
					<script src="javascript/global.js" type="text/javascript"></script>	
					<script src="javascript/bootstrap.min.js" type="text/javascript"></script>
					<script src="javascript/bootbox.min.js" type="text/javascript"></script>		
					<script src="javascript/zcustom-controls.js" type="text/javascript"></script>	
					<script src="javascript/jquery.equalheights.js" type="text/javascript"></script>	
					<script src="javascript/bootstrapx-clickover.js" type="text/javascript"></script>	
					<script type="text/javascript" src="javascript/plupload.full.js"></script>
					<script src="javascript/gmap3.js" type="text/javascript"></script>
					<script src="javascript/soundmanager2.js" type="text/javascript"></script>
					<script type="text/javascript" src="javascript/xjquery.pnotify.js"></script>
					<script type="text/javascript" src="javascript/jquery-scrolltofixed-min.js"></script>
					<script type="text/javascript" src="javascript/jquery.easing.1.3.js"></script>
					<script type="text/javascript" src="javascript/jquery.mousewheel.min.js"></script>
					<script type="text/javascript" src="javascript/jquery.mCustomScrollbar.js"></script>';
					
					
		}
		else{					//production
			$assets='<link type="text/css" href="css/all.css" rel="stylesheet" media="screen" />
					 <script type="text/javascript" src="javascript/all.js"></script>';		
			
		}
		
		echo $assets;
		
	}
	
	function handle_features($data){
		$featuresdict;
		$subfeaturedict;
		
		$list = $data["FEATURES_tenure"];
		foreach($list as $item){
			$subfeaturedict[strtolower($item->word)]=$item->word;
		}
		$featuresdict["Tenure"]=$subfeaturedict;
		
		$subfeaturedict=Array();
		
		$list = $data["FEATURES_others"];
		foreach($list as $item){
			$subfeaturedict[strtolower($item->word)]=$item->word;
		}
		
		$list = $data["FEATURES_unittype"];
		foreach($list as $item){
			$subfeaturedict[strtolower($item->word)]=$item->word;
		}

		$featuresdict["Feature"]=$subfeaturedict;
		
		$subfeaturedict=Array();
		$list = $data["FEATURES_storey"];
		foreach($list as $item){
			$subfeaturedict[strtolower($item->word)]=preg_replace("/[^0-9,.]/", "", $item->word);
		}
		$featuresdict["Storey"]=$subfeaturedict;
		
		
		$subfeaturedict=Array();
		
		$list = $data["FEATURES_facility"];
		for($i=0;$i<=count($list)-1;$i++){
			if(strtolower($list[$i]->word)=="security" && $i!=1){
				moveElement($list,$i,1);
				$i=0;
			}
			if(strtolower($list[$i]->word)=="entertainment" && $i!=0){
				moveElement($list,$i,0);
				$i=0;
			}
			if(strtolower($list[$i]->word)=="social recreational facilities" && $i!=2){
				$list[$i]->word = "Social/Recreational Facilities";
				moveElement($list,$i,2);
				$i=0;
			}
			
		}
		
		
		foreach($list as $item){
			$subfeaturedict[str_replace("/"," ",strtolower($item->word))]=$item->word;
		}
		$featuresdict["Facility"]=$subfeaturedict;
		

		
		return $featuresdict;
	}

	function get_item_fulldata_by_id($itemid,$userid){
		$CI =& get_instance();
		$results=handle_item_array($CI->result_item_model->get_single_item_full_data($itemid,$userid));
		return $results[0];
	}
	
	function replace_first($search,$replace,$subject){
		$pos = strpos($subject,$search);
		if ($pos !== false) {
		    $newstring = substr_replace($subject,$replace,$pos,strlen($search));
		}
		return $newstring;
	}

	function replace_last($search,$replace,$subject){
		$pos = strrpos($subject,$search);
		if ($pos !== false) {
		    $newstring = substr_replace($subject,$replace,$pos,strlen($search));
		}
		return $newstring;
	}
	
	function starts_with($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}
	
	function ends_with($haystack, $needle)
	{
	    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
	
	
	function generate_username_control($userid,$username="",$showing_pic=false,
										$user_status="unknown",$limit_count=999,$no_link=false,$new_tab=false,$possesive=false){
		$CI =& get_instance();
		
		if($userid==0) return "Anonymous";
		
		$control=null;
		$control["showing_userid"]=$userid;
		$control["showing_username"]=$username;
		$control["showing_pic"]=$showing_pic;
		
		if($user_status=="unknown"){
			$control["user_status"]="unknown";
		}
		else if($user_status){
			$control["user_status"]="online";
		} 
		else{
			$control["user_status"]="offline";	
		}
		
		$control["limit_count"]=$limit_count;
		$control["no_link"]=$no_link;
		$control["new_tab"]=$new_tab;
		$control["possesive"]=$possesive;
		$CI->load->view("user_controls/username_control",$control);
		
		
	}
	
	function deleteDirectory($dir) {
	    if (!file_exists($dir)) {
	        return true;
	    }
	
	    if (!is_dir($dir)) {
	        return unlink($dir);
	    }
	
	    foreach (scandir($dir) as $item) {
	        if ($item == '.' || $item == '..') {
	            continue;
	        }
	
	        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
	            return false;
	        }
	
	    }
	
	    return rmdir($dir);
	}
											
										
	function generate_item_thumbnail($itemid){
		$filearr=array();
		$base='photo/'.$itemid.'/';
		
		if(is_dir($base)){
			$filearr=scandir($base);
		}
		
		if (!file_exists($base."thumb")) {
		    mkdir($base."thumb", 0777, true);
		}
		
		$image = new SimpleImage();
		
		foreach($filearr as $file){
			if(!is_dir($base.$file) && !file_exists($base."thumb/".$file)){
				$image->load($base.$file);
				if($image->getWidth()>70){
					 $image->resizeToWidth(70);
				}
		       	
				$image->save($base."thumb/".$file);
			}
			
			
		}

	}
	
	function delete_item_thumbnail($itemid){
		$base='photo/'.$itemid.'/';
		if (file_exists($base."thumb")) {
			deleteDirectory($base."thumb");
		}
	}
	
	
	function watermark_item_photos($itemid,$user){
		$filearr=array();
		$base='photo/'.$itemid.'/';
		
		if(is_dir($base)){
			$filearr=scandir($base);
		}
		
		
		foreach($filearr as $file){
			if(!is_dir($base.$file)){
				$img = $base.$file;
				watermark_image($img,$user->username."\n".$user->phone,$img);
			}
			
			
		}
		delete_item_thumbnail($itemid);
	}
	
	
	
	function watermark_image($SourceFile, $WaterMarkText , $DestinationFile) {
	   list($width, $height) = getimagesize($SourceFile);
	   $image_p = imagecreatetruecolor($width, $height);
	   
	   $ext = explode(".",$SourceFile);
	   
	   switch (end($ext))
		{
		    case 'jpeg': case 'jpg':
		        $image = imagecreatefromjpeg($SourceFile);
		    break;
		    case 'gif':
		        $image = imagecreatefromgif($SourceFile);
		    break;
		    case 'png':
		        $image = imagecreatefrompng($SourceFile);
		    break;
		    default:
		       $image = imagecreatefromjpeg($SourceFile);
		}
	   
	   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height); 
	   $opacity = 70;
	   $black = imagecolorallocatealpha($image_p, 255, 255, 255, 127 * (100 - $opacity) / 100);
	   
	  
	   
	   $font = '../property/font/arialbd.ttf';
	   $font_size = 50; 
	   $textDim = imagettfbbox($font_size, 0, $font, $WaterMarkText);
		$textX = $textDim[2] - $textDim[0];
		$textY = $textDim[7] - $textDim[1];
		$text_posX = ($width / 2) - ($textX / 2);
		$text_posY = ($height / 2) - ($textY / 2);
	   imagealphablending($image_p, true);
	   imagettftext($image_p, $font_size, 0, $text_posX, $text_posY - $font_size, $black, $font, $WaterMarkText);
	   if ($DestinationFile<>'') {
	   	
		 $ext = explode(".",$DestinationFile);
	   
		   switch (end($ext))
			{
			    case 'jpeg': case 'jpg':
			        imagejpeg ($image_p, $DestinationFile, 70); 
			    break;
			    case 'gif':
			        imagegif ($image_p, $DestinationFile); 
			    break;
			    case 'png':
			       imagepng ($image_p, $DestinationFile, 9); 
			    break;
			    default:
			      imagejpeg ($image_p, $DestinationFile, 70); 
			}
		
		
	      
	   };
	   imagedestroy($image); 
	   imagedestroy($image_p); 
	};
	
	
	
	
?>