<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SessionData{
    var $CI;

    function __construct(){
        $this->CI =& get_instance();
		
    }

    function initializeData() {
          // This function will run after the constructor for the controller is ran
          // Set any initial values here
		  /*$this->CI->load->helper('url');	
		  if (!isset($this->CI->session))
			{
				$this->CI->load->library('session');
			}
          if(!$this->CI->session->userdata('username')){    //this is line 13
            redirect('/');
          }*/
		   // $this->CI->session->set_userdata(array('hook' => $_SERVER['php_self']));    
            $CI =& get_instance();
			//echo $CI->uri->segment(1);
			//echo $this->CI->session->userdata("logged_in2");
			
			$allowed_host = array('172.25.5.28','localhost:8085','localhost:8080','localhost','192.168.3.212:85','192.168.3.209','localhost:8085', '160.202.144.144:3994','192.168.3.209:85', '160.202.144.144:3994','lmstest.bracbank.com');	
			if (!isset($_SERVER['HTTP_HOST']) || !in_array($_SERVER['HTTP_HOST'], $allowed_host)) 
			{
				die('<pre>Sorry! This is an unauthorized attempted (008).</pre>');
			}
		

			foreach($_GET as $key=>$val)
			{				
				//if(preg_match("#[\\~\\`\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\<\\>\\-\\+\\=\\{\\}\\[\\]\\|\\:\\;\\&lt;\\&gt;\\.\\?\\/\\\\\\\\]+#", $val)){
				//	redirect('/e404');
				//}
				//if(preg_match("#[]+#", $key)){
				//	echo $key;
				//	exit;
					//redirect('/e404');
				//}
			}
			
			if ($CI->uri->segment(1) == 'home' || $CI->uri->segment(1) == 'cornjob') return; 

			
            if(!$this->CI->session->userdata['ast_user']['login_status']) {
                $this->CI->load->helper('url');	  
				     
               		redirect('home', 'location');
            }            
         // die('end');
    }
	
}
?>