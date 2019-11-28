<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vsm extends CI_Controller {

    function __construct()
     {
	 
	         // Call the Controller constructor
         parent::__construct();
		 $this->load->helper(array('url','mediatutorialpdf'));
		$this->load->database();
		 
		 if(!is_user())
		 {
		  	redirect(base_url(),'refresh');
		 }
     }
     
     public function index($id)
	 {
	 	if(isset($id) && $id>0)
		{
			$this->session->set_userdata('menu_access_id',$id);
		}
		
		$this->load->model('mymodel');
			
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$id);
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['uid']= $this->session->userdata('some_name1');
		$data['module_name']='Vault Security Management'; 
		
        //quick link
        $this->session->set_userdata('quick_link','6');
		
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}
    
   	function vsm_data_submit($sign=0)
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('mymodel');
        $office_id=$this->session->userdata('some_office');
        $login_office_status=$this->mymodel->get_login_office_status($office_id);
        
        if($sign==1)
        {
            
            if($login_office_status ==4)
            {
                //fetch required data start
        		$data['rec']=array();			
                if($query4 = $this->mymodel->get_branch_vsm_report($office_id))
    			{
    				$data['rec'] = $query4;
    			}
                
                $data['designation_dropdown']=$this->mymodel->get_jb_designation_dropdown();
                $data['designation_dropdown_BB']=$this->mymodel->get_BB_designation_dropdown();
                $data['designation_dropdown_CO']=$this->mymodel->get_CO_designation_dropdown();
                $data['login_office_status']=$login_office_status;
                
                $data['content']=('vsm/vsm_data_submit');
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);  
                 
            }
            else
            {
                $data['msg_content']="You are not allowed to submit VSM data. Only branch user can submit data of respective branch.";
                $data['msg_type']=2;
                $data['content']=('vsm/vsm_msg_view');
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);  
            }
        }
        else
        {
            //fetch required data end
           	if (isset($_POST['form_specification']) && $_POST['form_specification']=='1')
    		{                
                $status=$this->mymodel->save_vsm_data($office_id);
                if($status=='success')
                {
                    $data['msg_content']="VSM Data has been saved successfully.";
                    $data['msg_type']=1;
                }
                if($status=='error')
                {
                    $data['msg_content']="VSM Data has not been saved.";
                    $data['msg_type']=2;
                }
                   
                $data['content']=('vsm/vsm_msg_view');
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data); 
                
    		}
          	else
            {      
                redirect('vsm/vsm_data_submit/1','refresh'); 
        	} 
        }
	}

    
    public function vsm_report()
	 {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		$this->load->model('mymodel');
        //login office
        $office_id=$this->session->userdata('some_office');
        
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status($office_id);   
        }
        else
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status(0);
        }
        
        $data['content']=('vsm/vsm_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function fetch_br_ao_do()
    {
        $response='';
        if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='')
        {
           $this->load->model('mymodel');
           $br_ao_do_array=$this->mymodel->fetch_br_ao_do($_POST['br_ao_do'],$_POST['br_ao_do_str']);
          
            if($_POST['br_ao_do']==2)
            {
                $index_name='BRANCH_NAME';
                $index_val='jbbrcode';
            }
            
            if($_POST['br_ao_do']==3)
            {
                $index_name='ZoneName';
                $index_val='ZoneCode';
            }
            
            if($_POST['br_ao_do']==4)
            {
                $index_name='DivisionName';
                $index_val='jbdivisioncode';
            }
			
			if($_POST['br_ao_do']==6)
            {
                $index_name='DivisionName';
                $index_val='jbdivisioncode';
            }
          
          if(count($br_ao_do_array)>0)
          {
            $response .='<td COLSPAN="4"><h6 style="color: olive;">';
            foreach($br_ao_do_array as $key=>$val)
            {
                if($_POST['br_ao_do']==6)
                {
                  $response .='<input type="radio" id="br_ao_do" name="vsm_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
                }
                else
                {
                 $response .='<input type="radio" id="br_ao_do" name="vsm_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'<br/>';   
                }
            }
            $response .='</td>';
          }  
        }
        
        echo $response;
        
        
        exit();
    }
    
    
    function vsm_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['vsm_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['vsm_report_office_id']; 
            }
            
            
            
            //Now prepare option
            if($_POST['report_click_btn']==1)//view report
            {
              $data['vsm_data_detail']=$this->mymodel->get_branch_vsm_report($report_of_office_id);  
            }
            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
             $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report_vsm($report_of_office_id,$_POST['report_option_selector']);
              $result_array_temp=$this->mymodel->fetch_vsm_missing_completed($branch_id_array_for_report);
              if(isset($result_array_temp) && count($result_array_temp)>0)
              {
                $data['result_array']=array();
                foreach($result_array_temp as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;  
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;  
                    }
                }
              }
              
              $data['count_all']=count($branch_id_array_for_report);
              $data['count_missing_completed']=count($data['result_array']);
              if($_POST['report_click_btn']==2)
              {
                $data['sign']='Missing'; 
              }
              if($_POST['report_click_btn']==3)
              {
                $data['sign']='Completed'; 
              }
              
                
            }
            //Now load view
            
            //first save data for pdf
            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
            $data['report_click_btn']=$_POST['report_click_btn']; 
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
			
			if($download==1)
            {
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='vsm_report_'.$report_of_office_id.'.pdf';
                  $pdf_content = $this->load->view('vsm/vsm_report_display_pdf', $data, true);  
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                   if($_POST['report_click_btn']==2){$pdf_filename='vsm_missing_list_'.$report_of_office_id.'.pdf';}
                   if($_POST['report_click_btn']==3){$pdf_filename='vsm_completed_list_'.$report_of_office_id.'.pdf';}
                   $pdf_content = $this->load->view('vsm/vsm_missing_completed_display_pdf', $data, true); 
                }
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('vsm/vsm_report_display');   
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('vsm/vsm_missing_completed_display'); 
                }
                
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data); 
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/vsm/vsm_reportindex.php','refresh');
        }
        
    }
        
   	function parent_id_get()
	{
		$id=0;
		$menu_access_id=$this->session->userdata('menu_access_id');
		if(isset($menu_access_id) && $menu_access_id>0)
		{
			$id=$menu_access_id;
		}
		
		return $id;
	}
	
}