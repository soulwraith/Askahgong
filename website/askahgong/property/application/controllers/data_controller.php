<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_controller extends MY_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	 	$this->load->model('property_model');
		
		$this->load->model('area_model');
		
		$this->load->model('result_item_model');
		
		$this->load->model('dictionary_model');
		
		$this->load->model('sms_model');
		
		$this->load->helper('itemdata_helper');
		
		$this->load->helper("image_helper");
	}

	public function index()
	{
	
		
	}
	
	public function check_area_is_not_support(){
		$keyword=$this->input->post("keyword");
		$this->area_model->get_count_area_not_support_by_keyword($keyword);
		commitTasks();
		GLOBAL $data;
		echo $data["count"];
	}
	
	
	public function get_area_by_query($maxarealevel){
		$query=$this->input->post("query");
		$query =  preg_replace('/\d+.*/', "", $query);
		$this->area_model->get_areas_by_query($query,$maxarealevel);
		$this->area_model->get_count_area_not_support_by_keyword($query);
		$this->area_model->get_area_level($query);
		commitTasks();
		GLOBAL $data;
		echo (json_encode($data["areas"])."||".$data["count"]."||".$data["area_level"]);	
	}
	
	public function get_area_by_id_and_level($id,$level){
		$results=strip_redundant($this->area_model->get_area_by_id_and_level($id,$level));
		echo (json_encode($results));
		
	}
	
	public function get_rude_word_list(){
		$results=$this->dictionary_model->get_rude_words();
		echo "Success, thanks exabytes!";
		//echo json_encode($results);
	}
	
	
	public function check_area_is_valid($area){
			
		
			
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$area.'&sensor=false';

		$data = @file_get_contents($url);
		
		$results=json_decode($data);
		
		$realarea=(urldecode($area));
		
		if(count($results->results)>0){
			$addr=$results->results[0]->formatted_address;
			if (stristr($addr, $realarea)) echo "yes";
			else echo "no";
		}
		else{
			echo "no";
		}
		
		
		
	}
	
	
	public function upload_file(){
			
	
		if (!file_exists('upload/')) {
		    mkdir('upload/', 0777, true);
		}
	
		$total= count($_FILES['file']['tmp_name']); 
		$filenamelist=array();
		for($x=0;$x<=$total-1;$x++){
			$filetype=explode("/",$_FILES["file"]["type"][$x]);
	
			if($filetype[1]=="jpeg") $filetype[1]="jpg";
			while (true) {
			 $filename = uniqid('temp', true);
			 $filename =str_replace(",","hoi",$filename);
			 $filename =str_replace(".","hei",$filename). '.jpg'; //force change to jpg
			 if (!file_exists("upload/" . $filename)) break;
			}
			//move_uploaded_file($_FILES["file"]["tmp_name"][$x],"upload/" . $filename);
			
			$image = new SimpleImage();
	        $image->load($_FILES['file']['tmp_name'][$x]);
			if($image->getWidth()>800){
				 $image->resizeToWidth(800);
			}
	       
			$image->save("upload/" . $filename);
			
			array_push($filenamelist,$filename);
		}
		
	
		echo implode(",",$filenamelist);
	

		
	}
	
	public function delete_file($path){
		$path=str_replace("%21%21","/",$path);
		unlink($path);

	}
	
	public function save_file(){
		try{
			
		$url=$_GET["url"];
		$filename=$_GET["filename"];
		$itemid=$_GET["itemid"];
		
		if (!file_exists('photo/'.$itemid)) {
		    mkdir('photo/'.$itemid, 0777, true);
		}

		$ch = curl_init($url);
		$fp = fopen('photo/'.$itemid.'/'.$filename, 'wb');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		
	
		
		}	
		catch (Exception $e)  
		{  
		 throw new Exception( 'Something really gone wrong', 0, $e);  
		} 
		
	}
	
	
	public function get_landmark($lat1,$lnt1,$lat2,$lnt2){
		$landmark_type=$this->input->post("landmark_type");
		$results=$this->area_model->get_landmark($lat1,$lnt1,$lat2,$lnt2,$landmark_type);
		echo (json_encode($results));
	}
	
	public function get_landmark_within($lat1,$lnt1,$range){
		$landmark_type=$this->input->post("landmark_type");
		$results=($this->area_model->get_landmark_within($lat1,$lnt1,$range));
		echo (json_encode($results));
	}
	
	public function get_nearest_landmark($lat1,$lnt1){
		$landmark_type=$this->input->post("landmark_type");
		$results=($this->area_model->get_nearest_landmark($lat1,$lnt1,$landmark_type));
		echo (json_encode($results));
	}
	
	public function sms_input(){
		$msg=stripcslashes($this->input->get('HTTP_MESSAGE',TRUE));
		$phone=$this->input->get('HTTP_MoBILE_NO', TRUE);
		$this->sms_model->insert_sms($msg,$phone);
		commitTasks();
	}
	
	

}	