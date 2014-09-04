


<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">

<?php if(!contain_string($attrs,"no-responsive")):?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php endif?>

<?php if($active=="admin"):?>
	<meta name="robots" content="none">
	
<?php elseif(contain_string($attrs,"no-index")):?>	
	<meta name="robots" content="noindex, follow">
	
<?php else:?>	
	<meta name="robots" content="index, follow">
	
<?php endif?>	





<?php 
    $title;
	$keywords;
	$description;
	
	
	if(contain_string($attrs,"404")){
		$title = "Page Not Found";
		$description="";
	}
	else if(contain_string($attrs,"500")){
		$title = "Page Error";
		$description="";
	}
	else if($active=="admin"){
		$title = "Admin Page";
		$description="";
	}
	else if(starts_with(uri_string(), "search")){
		if(isset($_GET["action"]) && $_GET["action"]=="0"){
			$title = "Selling";
			$searchpdescription = "Selling";
		}
		else {
			$title = "Buying";
			$searchpdescription = "Buying";
		}	
		if(isset($_GET["itemname"]) && $_GET["itemname"] != "House"){
			$title .= " ".ucwords($_GET["itemname"]);
			$searchpdescription .= " ".ucwords($_GET["itemname"]);
		}
		else {
			$title .= " Property";
			$searchpdescription .= " Property";
		}
		if(isset($_GET["area"]) && $_GET["area"] != ""){
			$area_new = str_replace("@", ", ", $_GET["area"]);
			$title .= "@".$area_new;
			$searchpdescription .= "@".$area_new;
		}
		if(isset($_GET["feature"]) && $_GET["feature"] != ""){
			$searchpdescription .= ", with features: ".rtrim($_GET["feature"],",");
		}
		$description = "Free searching for &apos;".$searchpdescription."&apos; by Askahgong.com, an intelligent property listing site which provides service of buying and selling property in Johor Bahru, Malaysia.";
	}
	else if (starts_with(uri_string(), "user/login")){
		$title = "Login/Register";
		$description = "Welcome to our Askahgong.com community. Login/register with your phone number.";
	}
	else if (starts_with(uri_string(), "contact/agents")){
		if(isset($_GET["keyword"]) && $_GET["keyword"] != ""){
			$agentdescription = "Searching for &apos;".$_GET["keyword"]."&apos; by Askahgong.com. ";	
		}
		else {
			$agentdescription = "";
		}
		$title = "Find An Agent";
		$description = $agentdescription."Find/Search for a property agent or agency in Johor Bahru based on Askahgong.com reputation level.";
	}
	else if (starts_with(uri_string(), "contact/our_staffs")){
		$title = "Talk To Us";
		$description = "Talk to askahgong.com staffs for any question about our website.";
	}
	
	else if (starts_with(uri_string(), "discussion/listing/2")){
		$title = "Discussion - General";
		$description = "Communicate/interact/share your thoughts with others about latest properties news and updates";
	}
	else if (starts_with(uri_string(), "discussion/listing") || starts_with(uri_string(), "discussion/listing/1")){
		$title = "Discussion - Feedback";
		$description ="Share your opinion, suggestion or any feedback about Askahgong.com to us ";
	}
	
	else if (starts_with(uri_string(), "discussion/topic")){
		$title = $topic->topictitle;
	}
	
	else if (starts_with(uri_string(), "discussion/newtopic")){
		$title = "New Discussion Topic";
	}
	
	else if (starts_with(uri_string(), "user/resetpasswordtoken")){
		$title = "Password Reset";
	}
	
	else if (starts_with(uri_string(), "about/title")){
		$title = ucfirst($title);
		if ($title != "Introduction"){
			$title = "About ".ucfirst($title);
		}
	}
	else if (starts_with(uri_string(), "activity") || starts_with(uri_string(), "profile") || starts_with(uri_string(), "posting/view") || starts_with(uri_string(), "shortlist/view") || starts_with(uri_string(), "notification") || starts_with(uri_string(), "settings")){
		$breadcrumb_name;
		switch($dashboard_page){
		case "home":
			$breadcrumb_name="Activity";
		break;
		case "profile":
			$breadcrumb_name="Profile";
		break;
		case "posting":
			$breadcrumb_name="Posting";
		break;
		case "shortlist":
			$breadcrumb_name="Shortlist";
		break;
		case "notification":
			$breadcrumb_name="Notification";
		break;
		case "settings":
			$breadcrumb_name="Settings";
		break;
		
		}
		if($user->id==get_userid()){
			$title = "My ".$breadcrumb_name;
		}
		else {
			
			$title = cutofftext($user->username,10,"...")."'s ".$breadcrumb_name;
			if($user->role=="Agent"){
			$description = $user->username.", ".$user->role.", from '".$user->agency."', reputation level ".$user->level.", has posted total ".concat_if_plural("property posting","s",$user->postcount).".";
			}
			else {
			$description = $user->username.", ".$user->role.", reputation level ".$user->level.", has posted total ".concat_if_plural("property posting","s",$user->postcount).".";
			}	
				
		}	
	}
	else if (starts_with(uri_string(), "item/id/")) {
		if($item->type==0){
			$pricebudget="price";
		}
		else {
			$pricebudget="budget";
		}
		$title = $item->actiontext." ".$item->paddingnamewithareatoshow;
		if($user->role=="Agent"){
		$description = $user->username."'s posting: ".$item->actiontext." ".lcfirst($item->paddingnamewithareatoshow)." with ".$pricebudget." ".str_replace(" ","",$item->pricetoshow).". Post owner's details: ".$user->username.", ".lcfirst($user->role).", from '".$user->agency."'";
		}
		else {
		$description = $user->username."'s posting: ".$item->actiontext." ".lcfirst($item->paddingnamewithareatoshow)." with ".$pricebudget." ".str_replace(" ","",$item->pricetoshow).". Post owner's details: ".$user->username.", ".lcfirst($user->role);
			
			}	
		
	}
	
	else if(starts_with(uri_string(),"posting/newpost") || starts_with(uri_string(),"posting/edit")){
		if(isset($item->id)){
			$title = "Edit";
		}
		else{
			$title = "New";
		}	
		$title .=" Posting";
		
	}
	
	else if(starts_with(uri_string(),"contact/messaging")){
		
		$title ="Contacts - Messaging";
		
	}
	
	else if(starts_with(uri_string(),"redirect")){
		
		$title ="System Message";
		
	}
	
	else if(starts_with(uri_string(),"terms")){
		
		$title ="Terms/Conditions";
		
	}
	
	else if(starts_with(uri_string(),"pending_item/listing")){
		
		$title ="My Sales Lead";
		
	}
	
	else if(starts_with(uri_string(),"pending_item")){
		
		$title ="You Need An Agent";
		
	}
	
	else if(starts_with(uri_string(),"agent_comment")){
		
		if($user->id==get_userid()){
			$title = "My Review";
		}
		else {
			
			$title = $user->username."'s Review";
			$description = "The reviews of agent ".$user->username." in the Ask Ah Gong community";
				
		}	
		
	}
	
	
	
	
	else if (starts_with(uri_string(), "")) {
		$title = "Welcome To Askahgong.com";
		$description = "Intelligent Property Listing Site with a twist. For all who want to buy and sell properties in Malaysia, specifically Johor Bahru area. Check out all the features here.";
	}
?>	
	

<title><?=$title?> | Askahgong</title>
<?php if(isset($description)):?>
<meta name="description" content="<?=$description?>">
<?php endif?>


