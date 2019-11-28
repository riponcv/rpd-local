<?php class Designation extends CI_Controller{    
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
    
 public function get_all_desig()
 {         
 	$query = $this->db->get('DMS_Designation');        
    if($query->num_rows > 0)
    	{            
        	$header = false;           
            $output_string = "";            
            $output_string .=  "<table border='1'>\n";            
            foreach ($query->result() as $row)
            	{               
                	 $output_string .= "<tr>\n";
                     $output_string .= "<th>".$row->Dsg_SHort."</th>\n";               
                     $output_string .= "</tr>\n";
                 }
                 
                 $output_string .= "</table>\n";
          }
     
     else
     {
           $output_string = "There are no results";       
     }
           echo json_encode($output_string);    
		   // echo $output_string;    
	 } 
     
 }
?>