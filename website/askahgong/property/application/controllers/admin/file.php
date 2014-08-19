<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {

	function __construct()
	{
	    parent::__construct(); //you always have to call parent's constructor before ANYTHING
	
	 	
	}

	public function index()
	{
	
	}
	
	
	public function upload(){
		$this->load->helper("image_helper");
		$filetype=str_replace("image/","",$_FILES["uploadedfile"]["type"]);
		
		if (!file_exists('image/admin')) {
		    mkdir('image/admin', 0777, true);
		}
		
		
	    $image = new SimpleImage();
        $image->load($_FILES['uploadedfile']['tmp_name']);
		$newfilename="";
		while (true) {
			 $newfilename = uniqid('faq', true);
		     $newfilename =str_replace(".","t",$newfilename). '.'.$filetype;
			  if (!file_exists("image/admin/". $newfilename)) break;
		}
		
   		$image->save("image/admin/". $newfilename);
		echo "Success!!the file is in <br>image/admin/". $newfilename."<br> now";
	}
}	