<?php

class Ajax_post extends Controller {

  function Ajax_post()
  {
    parent::Controller();  
    $this->load->helper(array('url'));
  }
  
  function index()
  {
    echo 'ABC';
    //$this->load->view('ajax_post');
  }
  
  function post_action()
  {
  
    if(($_POST['username'] == "") || ($_POST['password'] == ""))
    {
      $message = "Please fill up blank fields";
      $bg_color = "#FFEBE8";
    
    }elseif(($_POST['username'] != "myusername") || ($_POST['password'] != "mypassword")){
      $message = "Username and password do not match.";
      $bg_color = "#FFEBE8";
      
    }else{
      $message = "Username and password matched.";
      $bg_color = "#FFA";
    }
    
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $output;
  }
}

?>

