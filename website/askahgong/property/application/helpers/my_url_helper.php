<?php
	function current_full_url()
	{
	    $CI =& get_instance();
	
	    $url = $CI->uri->uri_string();
	    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
	}


	function url($type, $anchor=""){
		
		$return_url="";
		
		switch($type){
			
			case "about_feature":
				$return_url = "about/title/features";
				break;
			case "discussion":
				$return_url = "discussion/listing";
				break;
			case "settings":
				$return_url = "settings";
				break;
			case "newpost":
				$return_url = "posting/newpost";
				break;
			case "about_introduction":
				$return_url = "about/title/introduction";	
				break;
			case "about_website":
				$return_url = "about/title/website";
				break;
			case "about_sms":
				$return_url = "about/title/sms";
				break;
		}
		
		
		if($anchor!="") $return_url.=$anchor;
		
		return $return_url;
	}
	

?>