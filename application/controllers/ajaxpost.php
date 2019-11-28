<?php class Ajaxpost extends  CI_Controller {

   function __construct()
        {
             parent::__construct();
             // Your own constructor code
			 $this->load->helper(array('url'));
        }
 
	  
  function index()
  {
   
    $this->load->view('ajax_post');
  }
  
  function post_action()
  {
  
    if(($_POST['username'] == "") || ($_POST['password'] == ""))
    {
      $message = "Please fill up blank fieldsrrr";
      $bg_color = "#FFEBE8";
    
    }elseif(($_POST['username'] != "myusername") || ($_POST['password'] != "mypassword")){
      $message = "Username and password do not match.";
      $bg_color = "#FFEBE8";
      
    }else{
      $message = "Username and password matched.rrrr";
      $bg_color = "#FFA";
    }
    
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $output;
  }
  
  //by me
  function post_action_me()
  {
  
    if(($_POST['pfno'] == ""))
    {
      $message = "Please fill up blank fieldsrrr";
      $bg_color = "#FFEBE8";
    
    }elseif(($_POST['pfno'] != "mypf")){
      $message = "Username and password do not match.";
      $bg_color = "#FFEBE8";
      
    }else{
      $message = "Username and password matched.rrrr";
      $bg_color = "#FFA";
    }
    
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $output;
  }
  
}


