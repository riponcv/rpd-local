<?php class Userinfo extends CI_Controller{    
 function __construct()
 {        
 	parent::__construct();   
	
 }    
 
 public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		
		$this->load->view('desig');
	}
	
	function user_full_name_get()
  {
    if(($_POST['pfno'] == ""))
    {
      $message = "Please fill up your personal file number";
    
    }
	$query = $this->db->query("SELECT ui_Full_Name FROM DMS_UserInfo Where ltrim(rtrim(ui_PFile_No))='".$_POST['pfno']."'");
 
		

	if($query->num_rows()>0)
	{
		foreach( $query->result_array() as $row )
		{
			
      		$message = $row['ui_Full_Name'];
    	}	
	}
	else
	{
       $message = 'This personal file number does not exists';
    }
    
    $bg_color = "#FFA";
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $message;
  }
  
  
  function user_full_name_get_uri()
  {
  
    if(($this->uri->segment(3) == ""))
    {
      $message = "Please fill up your personal file number";
    
    }
	$query = $this->db->query("SELECT ui_Full_Name FROM DMS_UserInfo Where ltrim(rtrim(ui_PFile_No))='".$this->uri->segment(3)."'");
 
		

	if($query->num_rows()>0)
	{
		foreach( $query->result_array() as $row )
		{
			
      		$message = $row['ui_Full_Name'];
    	}	
	}
	else
	{
       $message = 'This personal file number does not exists';
    }
    
    $bg_color = "#FFA";
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $message;
  }
  
  function office_name_get()
  {
    if(($this->uri->segment(3) == ""))
    {
      $message = "Please fill up your personal file number";
    
    }
	
	$DB1 = $this->load->database('dbcomm', TRUE);
	
	$query = $DB1->query("SELECT jo_Name FROM jb_offices Where ltrim(rtrim(jo_jb_code))='".$this->uri->segment(3)."'");
 
		

	if($query->num_rows()>0)
	{
		foreach( $query->result_array() as $row )
		{
			
      		$message = $row['jo_Name'];
    	}	
		
		$DB1->close();
	}
	else
	{
       $message = 'This personal file number does not exists';
    }
    
    $bg_color = "#FFA";
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $message;
  }
  
  
  
  	public function test_uname()
	{
		 if(($_POST['pfno'] == ""))
    {
      $message = "Please fill up blank fieldsrrr";
      $bg_color = "#FFEBE8";
	}
		$query = $this->db->query("SELECT ui_Full_Name FROM DMS_UserInfo Where ltrim(rtrim(ui_PFile_No))='".$_POST['pfno']."'");
 
		

	if($query->num_rows()>0)
	{
		foreach( $query->result_array() as $row )
		{
			
      		$message = $row['ui_Full_Name'];
    	}	
	}
	else
	{
       $message = 'This personal file number does not exists';
    }
   
    $bg_color = "#FFA";
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $message;
  }
  
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
	
	
	$query = $this->db->query("SELECT ui_Full_Name FROM DMS_UserInfo Where ltrim(rtrim(ui_PFile_No))='".$_POST['pfno']."'");

	if($query->num_rows()>0)
	{
		foreach( $query->result_array() as $row )
		{
			
      		$message = $row['ui_Full_Name'];
    	}	
	}
    
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $output;
  }
    
}