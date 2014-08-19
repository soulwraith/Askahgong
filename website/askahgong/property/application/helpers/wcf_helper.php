<?php
	
  GLOBAL $accTasks;
  $accTasks=Array();
  GLOBAL $tasksCompletedCallBack;
  $tasksCompletedCallBack=Array();
  GLOBAL $data;
  $data;
  
  function commitTasks(){
  	GLOBAL $accTasks;
	
	if(count($accTasks)<=0){
		return;
	}
	
	
	$client = new SoapClient(DATA_ACCESS,array('cache_wsdl' => WSDL_CACHE_BOTH));

	
	$taskString=implode("(%separator2)",$accTasks);
	

    $params = array('taskString'=>$taskString);
	
	$webService = $client->CommitTasks($params);
	

	
	$wsResult = $webService->CommitTasksResult;
	
	
	$resultArr=explode("(%separator1)",$wsResult);
	
	
	GLOBAL $data;
	if(count($resultArr)>2){
		for ($i=0;$i<=count($resultArr)-1;$i++){
			if(strpos($resultArr[$i+1],"json") !== false){
				if(strpos($resultArr[$i+1],"single") !== false){
					$data[$resultArr[$i]]=strip_redundant_single_item(json_decode($resultArr[$i+2]));
				}
				else{
					$data[$resultArr[$i]]=strip_redundant(json_decode($resultArr[$i+2]));
				}
			}
			else if($resultArr[$i+1]=="array"){
				$data[$resultArr[$i]]=array_filter( explode("(%3)", $resultArr[$i+2]), 'strlen' );
			}
			else if($resultArr[$i+1]!="nonquery"){
				$data[$resultArr[$i]]=$resultArr[$i+2];
			}
			$i = $i+2;
		}
	}
	GLOBAL $tasksCompletedCallBack;
	foreach($tasksCompletedCallBack as $callback){
		$callback();
	}
	
  }
  
  
  
  function getResultInJsonDecodeArray($query)
  { 
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query);
    $webService = $client->GetResultInJSONForm($params);
    $wsResult = $webService->GetResultInJSONFormResult;
	
	 return strip_redundant(json_decode($wsResult));
  }
  
   function getResultInJsonDecodeArrayWithMemCached($query,$cachekey)
  { 
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query,'cacheKey'=>$cachekey);
    $webService = $client->GetResultInJSONFormMemCached($params);
    $wsResult = $webService->GetResultInJSONFormMemCachedResult;
	
	 return json_decode($wsResult);
  }
  
  function getResultInJsonDecodeArraySafe($query,$parameterarr)
  { 
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query,'parameterArray'=>$parameterarr);
    $webService = $client->GetResultInJSONFormSafe($params);
    $wsResult = $webService->GetResultInJSONFormSafeResult;
	return json_decode($wsResult);
  }
  
  
  
    function getResultInJsonDecodeArrayWithoutModify($query)
  { 
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query);
    $webService = $client->GetResultInJSONFormWithoutModify($params);
    $wsResult = $webService->GetResultInJSONFormWithoutModifyResult;
	
	 return strip_redundant(json_decode($wsResult));
  }
  

   function getExecuteScalar($query)
  { 
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query);
    $webService = $client->GetSingleResultInContentStringFormat($params);
    $wsResult = $webService->GetSingleResultInContentStringFormatResult;
    return $wsResult;

  }	
  
     function ExecuteScalarSafe($query,$parameterarr)
  { 
	$client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query,'parameterArray'=>$parameterarr);
    $webService = $client->ExecuteScalarSafe($params);
    $wsResult = $webService->ExecuteScalarSafeResult;
    return $wsResult;
  }	
  


  function getResultInJsonArray($query)
  {
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query);
    $webService = $client->GetResultInJSONForm($params);
    $wsResult = $webService->GetResultInJSONFormResult;
    return $wsResult;
  }
  
   function getResultInJsonArraySafe($query,$parameterarr)
  {
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query,'parameterArray'=>$parameterarr);
    $webService = $client->GetResultInJSONFormSafe($params);
    $wsResult = $webService->GetResultInJSONFormSafeResult;
    return $wsResult;
  } 
 

  
  function getResultOfSingleFieldInArray($query)
  {
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query);
    $webService = $client->GetSingleFieldResultsInContentStringFormat($params);
    $wsResult = $webService->GetSingleFieldResultsInContentStringFormatResult;
	$arr = array_filter( explode("(%3)", $wsResult), 'strlen' ); 
    return $arr;
  }
  
  
  function getUserRegistration($user, $password)
  {
    $client = new SoapClient(USER_RELATED);
    $params = array('userPhone'=>$user, 'desiredPassword' => $password);
    $searchresultservice = $client-> NewUserRegistration($params);
    return $client-> NewUserRegistrationResult;
  }

  function NewInsertEditWithContentString($user,$userphone,$posting, $item, $handleFileUrl)
  {
    $client = new SoapClient(NEW_ANALYSIS);
    $params = array('UserID'=>$user, 'UserPhone'=>$userphone, 'ContentString'=> $posting,'EditID'=> $item, 'handleFileUrl' => $handleFileUrl,'ProcessID'=> "");
    $webService = $client->NewInsertEditWithContentString($params);
    return $webService->NewInsertEditWithContentStringResult;
  }

  function ExecuteNonQuery($query)
  {
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query);
    $webService = $client->ExecuteNonQuery($params);
  }

  function ExecuteNonQuerySafe($query,$parameterarr)
  {
  	$client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query,'parameterArray'=>$parameterarr);
    $webService = $client->ExecuteNonQuerySafe($params);
  }

  function ExecuteNonQueryWithClearMemCached($query,$cachekey)
  {
    $client = new SoapClient(DATA_ACCESS);
    $params = array('Query'=>$query,'cacheKey'=>$cachekey);
    $webService = $client->ExecuteNonQueryAndClearMemCached($params);
  }



  function DeleteItem($itemid)
  {
  	$client = new SoapClient(DATA_ACCESS);
    $params = array('itemID'=>$itemid);
    $webService = $client->DeleteItem($params);
  }

	
  function NewSearchWithContentString($userid, $search)
  {
    $client = new SoapClient(NEW_ANALYSIS);
    $params = array('UserID'=>$userid, 'ContentString' => $search);
    $idstringservice = $client->NewSearchWithContentString($params);
    $returnid = $idstringservice->NewSearchWithContentStringResult;
	return $returnid;
  }
  
  function NewSearchWithItemID($userid,$itemid)
  {
  	$client = new SoapClient(NEW_ANALYSIS);
    $params = array('UserID'=>$userid, 'itemID' => $itemid);
    $idstringservice = $client->NewSearchWithItemID($params);
    $returnid = $idstringservice->NewSearchWithItemIDResult;
	return $returnid;
  }
  
  function NewRequestOfRecommendation($user)
  {
    $client = new SoapClient(NEW_ANALYSIS);
    $params = array('userID'=>$user);
    $webService = $client->NewRequestOfRecommendation($params);
    return $webService->NewRequestOfRecommendationResult;
  }
  
  function UserLogin($user, $countrycode, $password)
  {
  	//echo $user. $countrycode. $password;
    $client = new SoapClient(USER_RELATED);
    $params = array('userPhone'=>$user, 'countryCode'=>$countrycode, 'password'=>$password);
    $webService = $client->UserLogin($params);
    return $webService->UserLoginResult;
  }
  
  function NewUserRegistration($user, $countrycode, $password)
  {
  	//echo $user. $countrycode. $password;
    $client = new SoapClient(USER_RELATED);
    $params = array('userPhone'=>$user, 'countryCode'=>$countrycode, 'desiredPassword'=>$password);
    $webService = $client->NewUserRegistration($params);
    return $webService->NewUserRegistrationResult;
  }  
  
   function ChangePassword($userid, $password,$originalpassword)
  {
  	 
	$client = new SoapClient(USER_RELATED);
    $params = array('userID'=>$userid,'newPassword'=>$password,'originalPassword'=>$originalpassword);
    $webService = $client->ChangePassword($params);
    return $webService->ChangePasswordResult;
	
  } 

 
   
   function SortItems($processid,$type)
   {
  	$client = new SoapClient(DATA_ACCESS);
    $params = array('processID'=>$processid,'type'=>$type);
 	$client->SortItemByProcessID($params);   

   }

   function GetSimilarItems($itemid)
   {
    $client = new SoapClient(DATA_ACCESS);
    $params = array('id'=>$itemid);
    $webService = $client->GetSimilarItems($params);   
	return $webService->GetSimilarItemsResult;	 	
   }
	

   
   function ResetPassword($userphone,$countrycode,$email){
   		$client = new SoapClient(USER_RELATED);
   		$params = array('userPhone'=>$userphone,'countryCode'=>$countrycode,'email'=>$email);
   		$webService = $client->ResetPasswordByEmail($params);
    	return $webService->ResetPasswordByEmailResult;
   }
   
   function ResetPasswordMatchedToken($userid){
   		$client = new SoapClient(USER_RELATED);
   		$params = array('userID'=>$userid);
   		$webService = $client->ResetPassword($params);
    	return $webService->ResetPasswordResult;
   }
   
   
   function SendSMS($touserid,$message){
	   	$client = new SoapClient(DATA_ACCESS);
	    $params = array('toUserID'=>$touserid,'message'=>$message);
	    $client->SendSMS($params);   
   }
   
   function RoutinePing($userid){
	   	$client = new SoapClient(DATA_ACCESS);
	    $params = array('userID'=>$userid);
	    $webService=$client->RoutinePing($params);   
		return $webService->RoutinePingResult;
   }
   

   function InsertAndReturnResultInJsonDecodeArrayWithoutModifySafe($query,$return_query,$parameterarr){
   	$client = new SoapClient(DATA_ACCESS, array('cache_wsdl' => WSDL_CACHE_NONE));
    $params = array('Query'=>$query,'returnQuery'=>$return_query,'parameterArray'=>$parameterarr);
    $webService = $client->InsertAndReturnResultInJSONFormWithoutModifySafe($params);
    $wsResult = $webService->InsertAndReturnResultInJSONFormWithoutModifySafeResult;
	
	 return json_decode($wsResult);
   }
   
?>