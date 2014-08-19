<?php

	function show_custom500($ex){ // error page logic
        header("HTTP/1.1 500 Internal Server Error");
		
		$CI =& get_instance();
		
        // First, assign the CodeIgniter object to a variable
        GLOBAL $data;
		$data["type"]="error";
		$data["reserved"]="500";
		$data['attrs'] = "no-banner 500";
		$CI->load->view('obj_header', $data);
   		$CI->load->view("page_redirect", $data);
		$CI->load->view('obj_footer', $data);
		
		if (defined('ENVIRONMENT'))
		{
			switch (ENVIRONMENT)
			{
				case 'development':
					echo "<div>".$ex->getMessage()."</div>";
				break;
			
			}
		}

				
		
		
		log_message('error', "\n".$ex->getMessage());
		
    }
	
	
	function show_custom404(){ // error page logic
        header("HTTP/1.1 404 Not Found");
		
		$CI =& get_instance();
		
        // First, assign the CodeIgniter object to a variable
        GLOBAL $data;
		$data["type"]="error";
		$data["reserved"]="404";
		$data['attrs'] = "no-banner 404";
	
		$CI->load->view('obj_header', $data);
   		$CI->load->view("page_redirect", $data);
	
   		$CI->load->view('obj_footer', $data);
    }
	
	
?>