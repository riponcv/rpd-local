<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

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
		$data['module_name']='Report Section ';
        
        //quick link
        $this->session->set_userdata('quick_link','4'); 
		
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}
	    public function view_report($cat_id=0)
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
        
        //fetch all_report or all report_cat_erp
        $data['all_reports']=$this->mymodel->fetch_report_module_option($cat_id);
        
        if($cat_id>0)
        {
          $data['content']=('report/report_form_view');   
        }
        else
        {
          $data['content']=('report/report_form_view_erp'); 
        }
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
        
    
    function fetch_br_ao_do_report()
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
                  $response .='<input type="radio" id="br_ao_do" name="report_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
                }
                else
                {
                 $response .='<input type="radio" id="br_ao_do" name="report_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'<br/>';   
                }
            }
            $response .='</td>';
          }  
        }
        
        echo $response;
        exit();
    }
    
    //report misd_0001 start 
    public function misd_0001()
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
        
        $data['content']=('report/misd_0001/misd_0001_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0001_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              //->1
              $last_day_date=$this->mymodel->fetch_calculated_date($_POST['report_of_year'],$_POST['report_of_month'],1);
              $data['result_array']['last_day_year']=$this->mymodel->fetch_omis_sum_data($branch_id_array_for_report,$last_day_date);
              
              //->2
              $data['result_array']['target']=$this->mymodel->fetch_target($branch_id_array_for_report,$_POST['report_of_year']);
              //->3
              $data['result_array']['proportional_target']=$this->mymodel->fetch_proportional_target($data['result_array']['target'],$_POST['report_of_month'],$data['result_array']['last_day_year'],$_POST['report_of_year']);
              
              //->4
              $present_month_last_date=$this->mymodel->fetch_calculated_date($_POST['report_of_year'],$_POST['report_of_month'],2);
              $data['result_array']['present_acheivement']=$this->mymodel->fetch_omis_sum_data($branch_id_array_for_report,$present_month_last_date);
              
              //->5
              $data['result_array']['acheivement_percentage']=$this->mymodel->fetch_acheivement_percentage($data['result_array']['proportional_target'],$data['result_array']['present_acheivement']);
              
              //->6
              $pre_yr_date=$this->mymodel->fetch_calculated_date($_POST['report_of_year'],$_POST['report_of_month'],3);
              $data['result_array']['pre_yr_status']=$this->mymodel->fetch_omis_sum_data($branch_id_array_for_report,$pre_yr_date);
              
              //->7
              $data['result_array']['fetch_dif_pre_present']=$this->mymodel->fetch_dif_pre_present($data['result_array']['pre_yr_status'],$data['result_array']['present_acheivement']);
              
              //->8
              $data['result_array']['remarks']=$this->mymodel->fetch_remarks($data['result_array']['acheivement_percentage'],$data['result_array']['present_acheivement'],$_POST['report_of_year']);

              
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
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0001');

            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='performance_report_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0001/misd_0001_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0001/misd_0001_display');      
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
            redirect(base_url().'index.php/report/misd_0001index.php','refresh');
        }
        
    }
    //report misd_0001 start

    //report misd_0002 start 
    public function misd_0002()
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
        
        
        //get date
        $data['records3']=array();
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('report/misd_0002/misd_0002_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0002_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array']['deposit_mix']=$this->mymodel->fetch_deposit_mix_data($branch_id_array_for_report,$_POST['report_of_date']);              
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0002');
            $data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='deposit_mix_report_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0002/misd_0002_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0002/misd_0002_display');      
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
            redirect(base_url().'index.php/report/misd_0002index.php','refresh');
        }
        
    }
    //report misd_0002 end

    //report misd_0003 start 
    public function misd_0003()
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
        
        $data['content']=('report/misd_0003/misd_0003_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0003_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection

$tbl_name='PL'.$_POST['report_of_month'].$_POST['report_of_year'];
$Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
if($Q->num_rows()>0)
{
            $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            if(isset($data['result_array']) && count($data['result_array'])>0)
            {
                foreach($data['result_array'] as $key=>$row)
                {
                  $office_id_to_sum=array();
                  $report_option_id=$_POST['report_option_selector'];
                  $unique_id=$row['office_id'];
                  $selector=0;
                  
                    if($report_option_id==1)//my office
                    {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                    }
                    else if($report_option_id==2)//branch
                    {
                        $selector=2;
				$data['list_title']='Branch';  
                    }
                    else if($report_option_id==3)//area
                    {
                        $selector=2;
	                  $data['list_title']='Branch';
                    }
                    else if($report_option_id==4)//divisional
                    {
                        $selector=3;
				$data['list_title']='Area Office'; 
                    }
                    
                    else if($report_option_id==6)//divisional corp
                    {
                        $selector=3;
				$data['list_title']='Corporate Branch';
                    }
                    
                    else if($report_option_id==5)//whole bank
                    {
                        $selector=4;
				$data['list_title']='Division';   
                    }
                  $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                  $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0003_cal_data($office_id_to_sum,$_POST['report_of_year'],$_POST['report_of_month']);  
                }
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0003');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='pl_report_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0003/misd_0003_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0003/misd_0003_display');      
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
            redirect(base_url().'index.php/report/misd_0003index.php','refresh');
        }
        
    }
    //report misd_0003 end



    //report misd_0004 start 
    public function misd_0004()
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
        
        $data['content']=('report/misd_0004/misd_0004_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0004_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array']['a']=$this->mymodel->fetch_a_data($branch_id_array_for_report,$_POST['report_of_year']);              
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0004');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='progressive_report_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0004/misd_0004_display_pdf', $data, true);
                //generate_pdf_landscape($pdf_content, $pdf_filename,true);
				generate_pdf($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0004/misd_0004_display');      
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
            redirect(base_url().'index.php/report/misd_0004index.php','refresh');
        }
        
    }
    //report misd_0004 end


 //report misd_0005 start 
    public function misd_0005()
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
        
        $data['content']=('report/misd_0005/misd_0005_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0005_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            
                if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                      $office_id_to_sum=array();
                      $report_option_id=$_POST['report_option_selector'];
                      $unique_id=$row['office_id'];
                      $selector=0;
                      
                        if($report_option_id==1)//my office
                        {
                            $status=$this->mymodel->get_login_office_status($report_of_office_id);
                            if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                            if($status==3){$selector=2;$data['list_title']='Branch';}//area
                            if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                            if($status==1){$selector=4;$data['list_title']='Division'; }//whole bank  
                        }
                        else if($report_option_id==2)//branch
                        {
                            $selector=2;
							$data['list_title']='Branch';							
                        }
                        else if($report_option_id==3)//area
                        {
                            $selector=2;
							$data['list_title']='Branch';
                        }
                        else if($report_option_id==4)//divisional
                        {
                            $selector=3; 
							$data['list_title']='Area Office'; 
                        }
                        
                        else if($report_option_id==6)//divisional corp
                        {
                            $selector=3;
							$data['list_title']='Corporate Branch';
                        }
                        
                        else if($report_option_id==5)//whole bank
                        {
                            $selector=4;   
							$data['list_title']='Division';   
                        }
                      $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                      $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0005_cal_data($office_id_to_sum,$_POST['report_of_year'],$_POST['report_of_month']);  
                    }
                }
                
                //echo "<pre>";
                //print_r($data['result_array']);
                //die();
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0005');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='monthly_business_position_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0005/misd_0005_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0005/misd_0005_display');      
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
            redirect(base_url().'index.php/report/misd_0003index.php','refresh');
        }
        
    }
    //report misd_0005 end
	
    // report misd_0006 start
	public function misd_0006()
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
        $data['records3']=array();
        if($query3 = $this->mymodel->get_om__report_date())
        {
            $data['records3'] = $query3;
        }
        
        $data['content']=('report/misd_0006/misd_0006_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0006_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            //get all office under selection
               $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);

               if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                      $office_id_to_sum=array();
                      $report_option_id=$_POST['report_option_selector'];
                      $unique_id=$row['office_id'];
                      $selector=0;
                      
                        if($report_option_id==1)//my office
                        {
                            $status=$this->mymodel->get_login_office_status($report_of_office_id);
                            if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                            if($status==3){$selector=2;$data['list_title']='Branch';}//area
                            if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                            if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                        }
                        else if($report_option_id==2)//branch
                        {
                            $selector=2;  
							$data['list_title']='Branch';  
                        }
                        else if($report_option_id==3)//area
                        {
                            $selector=2;
							$data['list_title']='Branch';
                        }
                        else if($report_option_id==4)//divisional
                        {
                            $selector=3; 
							$data['list_title']='Area Office'; 
                        }
                        
                        else if($report_option_id==6)//divisional corp
                        {
                            $selector=3;
							$data['list_title']='Corporate Branch';
                        }
                        
                        else if($report_option_id==5)//whole bank
                        {
                            $selector=4;   
							$data['list_title']='Division';   
                        }
                      $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                      $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0006_cal_data($office_id_to_sum,$_POST['report_of_date']);  
                      
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0006');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='asset_liability_'.$report_of_office_id.'_'.$_POST['report_of_date'].'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0006/misd_0006_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0006/misd_0006_display');      
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
            redirect(base_url().'index.php/report/misd_0005index.php','refresh');
        }
        
    }
	//report misd_0006 end BY RIPON
	
	
    //report misd_0007 start 
    public function misd_0007()
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
        
        
        $data['records3']=array();
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('report/misd_0007/misd_0007_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0007_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            
                if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                  $office_id_to_sum=array();
                  $report_option_id=$_POST['report_option_selector'];
                  $unique_id=$row['office_id'];
                  $selector=0;
                  
                    if($report_option_id==1)//my office
                    {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                    }
                    else if($report_option_id==2)//branch
                    {
                        $selector=2;
				$data['list_title']='Branch';  
                    }
                    else if($report_option_id==3)//area
                    {
                        $selector=2;
	                  $data['list_title']='Branch';
                    }
                    else if($report_option_id==4)//divisional
                    {
                        $selector=3;
				$data['list_title']='Area Office'; 
                    }
                    
                    else if($report_option_id==6)//divisional corp
                    {
                        $selector=3;
				$data['list_title']='Corporate Branch';
                    }
                    
                    else if($report_option_id==5)//whole bank
                    {
                        $selector=4;
				$data['list_title']='Division';   
                    }
                  $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                      $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0007_cal_data($office_id_to_sum,$_POST['report_of_date']);  
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0007');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='individual_deposit_status_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0007/misd_0007_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0007/misd_0007_display');      
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
            redirect(base_url().'index.php/report/misd_0007index.php','refresh');
        }
        
    }
    //report misd_0007 end
    
    
      //report misd_0008 start 
    public function misd_0008()
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
        
        
        //get date
        $data['records3']=array();
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('report/misd_0008/misd_0008_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0008_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array']['cl_advance']=$this->mymodel->fetch_cl_advance_data($branch_id_array_for_report,$_POST['report_of_date']);              
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0008');
            $data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='cl_advance_report_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0008/misd_0008_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0008/misd_0008_display');      
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
            redirect(base_url().'index.php/report/misd_0008index.php','refresh');
        }
        
    }
    //report misd_0008 end
	

	 //report misd_0009 start 
    public function misd_0009()
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
        
        $data['content']=('report/misd_0009/misd_0009_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0009_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array']=$this->mymodel->yearly_position_data($branch_id_array_for_report);              
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
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0009');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='yearly_position_'.$report_of_office_id.'.pdf';
                $pdf_content = $this->load->view('report/misd_0009/misd_0009_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0009/misd_0009_display');      
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
            redirect(base_url().'index.php/report/misd_0009index.php','refresh');
        }
        
    }
    //report misd_0009 end
	
	 //report misd_0010 start 
    public function misd_0010()
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
        
        $data['content']=('report/misd_0010/misd_0010_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0010_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            if($_POST['report_click_btn']>0)//view report
            {
                $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
                //Now prepare report data
                $data['result_array']=array();
                /*for ($m=1; $m<=12; $m++) 
                {
                    $data['result_array'][$m-1]['month_name']=date('M', mktime(0,0,0,$m));
                    $data['result_array'][$m-1]['month_val']=($m<10)?'0'.$m:$m;
                }*/
				for ($m=1; $m<=12; $m++) 
                {
                    
                    if($_POST['report_option_selector']==5)
                    {
                        if($m%3==0)
                        {
                            $data['result_array'][$m-1]['month_name']=date('M', mktime(0,0,0,$m));
                            $data['result_array'][$m-1]['month_val']=($m<10)?'0'.$m:$m;
                        }
                    }
                    else
                    {
                        $data['result_array'][$m-1]['month_name']=date('M', mktime(0,0,0,$m));
                        $data['result_array'][$m-1]['month_val']=($m<10)?'0'.$m:$m;
                    }
                }
                
                if(count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$val)
                    {
                        $tbl_name='PL'.$val['month_val'].$_POST['report_of_year'];
                        $Q =  $this->db->query("SELECT name FROM sys.views where name='$tbl_name' ");
                        if($Q->num_rows()>0)
                        {
                          $data['result_array'][$key]['report_val']=array();
                          $loss_br_count=0;
                          $marginal_br_count=0;
                          foreach($branch_id_array_for_report as $row)
                          {
                            $pl_info_array=$this->mymodel->fetch_developing_branch($row['jbbrcode'],$_POST['report_of_year'],$val['month_val']);
                            if(!empty($pl_info_array))
                            {
                                if(isset($pl_info_array['pl']) && $pl_info_array['pl']<0)//loss br
                                {
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['br_code']=$row['jbbrcode'];
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['br_name']=$row['BRANCH_NAME'];
								  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['zn_code']=$row['ZoneCode'];
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['zn_name']=$row['ZoneName'];
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['dv_code']=$row['jbdivisioncode'];
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['dv_name']=$row['DivisionName'];
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['income']=$pl_info_array['income'];
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['expen']=$pl_info_array['expen'];
                                  $data['result_array'][$key]['report_val']['loss_br'][$loss_br_count]['pl']=$pl_info_array['pl'];
                                  $loss_br_count++;  
                                }
                                if(isset($pl_info_array['pl']) && $pl_info_array['pl']>=0 && $pl_info_array['pl']<500000)//marginal br
                                {
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['br_code']=$row['jbbrcode'];
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['br_name']=$row['BRANCH_NAME'];
								  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['zn_code']=$row['ZoneCode'];
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['zn_name']=$row['ZoneName'];
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['dv_code']=$row['jbdivisioncode'];
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['dv_name']=$row['DivisionName'];
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['income']=$pl_info_array['income'];
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['expen']=$pl_info_array['expen'];
                                  $data['result_array'][$key]['report_val']['marginal_br'][$marginal_br_count]['pl']=$pl_info_array['pl'];
                                  $marginal_br_count++;  
                                }
                            }
                          }  
                        } 
                    }
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0010');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='developing_br_position_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0010/misd_0010_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0010/misd_0010_display');      
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
            redirect(base_url().'index.php/report/misd_0010index.php','refresh');
        }
        
    }
    
    function misd_0010_report_details_list($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_val']) && isset($_POST['ptr_str']) && $_POST['ptr_str'] !='')
        {               
            $this->load->model('mymodel');
            //set value for data
            $data['ptr_str']=$_POST['ptr_str'];
			$data['report_option_selector']=$_POST['report_option_selector'];
            $data['ptr_val']=json_decode(base64_decode($_POST['report_val']));
            
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0010');
            if($_POST['ptr_str'] !='')
            {
                $exp_arr=explode('#',$_POST['ptr_str']);
                if(!empty($exp_arr))
                {
                 $data['command_office']=$exp_arr[4];
                 $data['report_of_office']=$exp_arr[3];  
                 $data['report_of_year']=$exp_arr[2];
                 $data['report_of_month']=$exp_arr[1];
                 if($exp_arr[0] !='' && $exp_arr[0]=='loss_br'){$data['title']='List Of Loss Branch';}
                 if($exp_arr[0] !='' && $exp_arr[0]=='marginal_br'){$data['title']='List Of Marginal Profit Branch';}
                }
            }
            
            //first save data for pdf
            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
            
            if($download==1)
            {
                $pdf_filename='developing_br_position_list_'.$data['report_of_office'].'_'.$data['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0010/misd_0010_display_pdf_list', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0010/misd_0010_display_list');      
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
            redirect(base_url().'index.php/report/misd_0010index.php','refresh');
        }
        
    }
    //report misd_0010 end
	
	//report misd_0011 start 
    public function misd_0011()
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
        
        $data['content']=('report/misd_0011/misd_0011_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0011_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            if($_POST['report_click_btn']>0)//view report
            {
                $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
                //Now prepare report data
                $data['result_array']=array();
                if(count($branch_id_array_for_report)>0)
                {
                      foreach($branch_id_array_for_report as $key=>$row)
                      {
                        $data['result_array'][$key]['br_code']=$row['jbbrcode'];
                        $data['result_array'][$key]['br_name']=$row['BRANCH_NAME'];
                        $data['result_array'][$key]['zn_code']=$row['ZoneCode'];
                        $data['result_array'][$key]['zn_name']=$row['ZoneName'];
                        $data['result_array'][$key]['dv_code']=$row['jbdivisioncode'];
                        $data['result_array'][$key]['dv_name']=$row['DivisionName'];
                        $data['result_array'][$key]['status_index']=0;
                        $data['result_array'][$key]['status_value']=0;
                        
                        $pl_details=$this->mymodel->fetch_developing_branch_continuous($row['jbbrcode']);
                        if(!empty($pl_details))
                        {
                            if(isset($pl_details['details_fig']) && !empty($pl_details['details_fig']))
                            {
                             $data['result_array'][$key]['con_pl_info']=$pl_details['details_fig'];   
                            }
                            if(isset($pl_details['status_index']))
                            {
                              $data['result_array'][$key]['status_index']=$pl_details['status_index'];  
                            }
                            if(isset($pl_details['status_value']))
                            {
                             $data['result_array'][$key]['status_value']=$pl_details['status_value'];   
                            }
                        }
                      } 
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
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0011');
            $data['report_option_selector']=$_POST['report_option_selector'];
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='continuous_developing_br_position_'.$report_of_office_id.'.pdf';
                $pdf_content = $this->load->view('report/misd_0011/misd_0011_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0011/misd_0011_display');      
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
            redirect(base_url().'index.php/report/misd_0011index.php','refresh');
        }
        
    }
    
    function misd_0011_report_details_list($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_val']) && isset($_POST['ptr_str']) && $_POST['ptr_str'] !='')
        {               
            $this->load->model('mymodel');
            //set value for data
            $data['ptr_str']=$_POST['ptr_str'];
            $data['ptr_val']=json_decode(base64_decode($_POST['report_val']));
            $data['report_option_selector']=$_POST['report_option_selector'];
            
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0011');
            if($_POST['ptr_str'] !='')
            {
                $exp_arr=explode('#',$_POST['ptr_str']);
                if(!empty($exp_arr))
                {
                 $data['command_office']=$exp_arr[3];
                 $data['report_of_office']=$exp_arr[2];  
                 $data['upto_value']=$exp_arr[1];

                 if($exp_arr[0] !='' && $exp_arr[0]=='loss_br'){$data['title']='List Of Loss Branch';}
                 if($exp_arr[0] !='' && $exp_arr[0]=='marginal_br'){$data['title']='List Of Marginal Profit Branch';}
                }
            }

            //first save data for pdf
            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
            
            if($download==1)
            {
                $pdf_filename='continuous_developing_br_position_list_'.$data['report_of_office'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0011/misd_0011_display_pdf_list', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0011/misd_0011_display_list');      
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
            redirect(base_url().'index.php/report/misd_0011index.php','refresh');
        }
        
    }
    //report misd_0011 end
	
	
	//report misd_0012 start 
    public function misd_0012()
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
        
        $data['content']=('report/misd_0012/misd_0012_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0012_report_details($download=0)
    {
        
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            if($_POST['report_click_btn']>0)//view report
            {
              $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
              $data['result_array']=$this->mymodel->fetch_month_indicator_train($branch_id_array_for_report,$_POST['report_of_year']);              
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_option_selector']=$_POST['report_option_selector'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0012');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1)
            {
                
                if($_POST['report_click_btn']==1)
                {
                 $pdf_filename='monthly_bussiness_trend_cummulative_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                 $pdf_content = $this->load->view('report/misd_0012/misd_0012_display_pdf', $data, true);    
                }
                if($_POST['report_click_btn']==2)
                {
                  $pdf_filename='monthly_bussiness_trend_analysis_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                  $pdf_content = $this->load->view('report/misd_0012/misd_0012_display_analysis_pdf', $data, true);   
                }

                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                if($_POST['report_click_btn']==1)
                {
                 $data['content']=('report/misd_0012/misd_0012_display');     
                }
                if($_POST['report_click_btn']==2)
                {
                  $data['content']=('report/misd_0012/misd_0012_display_analysis');    
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
            redirect(base_url().'index.php/report/misd_0012index.php','refresh');
        }
        
    }
    //End MISD_0012
    
    
    //report misd_0013 end	    
        public function misd_0013()
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
        $data['records3']=array();
        if($query3 = $this->mymodel->get_om__report_date())
        {
            $data['records3'] = $query3;
        }
        
        $data['content']=('report/misd_0013/misd_0013_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0013_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            
            $key=0;
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0013_cal_data($branch_id_array_for_report,$_POST['report_of_date']);              
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0013');
            $data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='weekly_foreign_exchange_pos_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0013/misd_0013_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0013/misd_0013_display');      
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
            redirect(base_url().'index.php/report/misd_0013index.php','refresh');
        }
        
    }
//report misd_0013 end BY RIPON


 //MISD-0014 Start
    public function misd_0014()
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
        
        $data['content']=('report/misd_0014/misd_0014_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0014_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
            $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            if(isset($data['result_array']) && count($data['result_array'])>0)
            {
                foreach($data['result_array'] as $key=>$row)
                {
                    $office_id_to_sum=array();
                    $report_option_id=$_POST['report_option_selector'];
                    $unique_id=$row['office_id'];
                    $selector=0;
                  
                    if($report_option_id==1)//my office
                    {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                    }
                    else if($report_option_id==2)//branch
                    {
                        $selector=2;
                        $data['list_title']='Branch';  
                    }
                    else if($report_option_id==3)//area
                    {
                        $selector=2;
                      $data['list_title']='Branch';
                    }
                    else if($report_option_id==4)//divisional
                    {
                        $selector=3;
                        $data['list_title']='Area Office'; 
                    }
                    
                    else if($report_option_id==6)//divisional corp
                    {
                        $selector=3;
                        $data['list_title']='Corporate Branch';
                    }
                    
                    else if($report_option_id==5)//whole bank
                    {
                        $selector=4;
                        $data['list_title']='Division';   
                    }
                  $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                  $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0014_cal_data($office_id_to_sum);  
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
            $data['report_option_selector']=$_POST['report_option_selector']; 
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0014');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='branch_specification_'.$report_of_office_id.'pdf';
                $pdf_content = $this->load->view('report/misd_0014/misd_0014_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0014/misd_0014_display');      
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
            redirect(base_url().'index.php/report/misd_0014index.php','refresh');
        }
        
    }
    
    function misd_0014_report_details_list($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_val']) && isset($_POST['ptr_str']) && $_POST['ptr_str'] !='')
        {               
            $this->load->model('mymodel');
            //set value for data
            $data['ptr_str']=$_POST['ptr_str'];
            $data['report_option_selector']=$_POST['report_option_selector'];
            
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0014');
            if($_POST['ptr_str'] !='')
            {
                $exp_arr=explode('#',$_POST['ptr_str']);
                if(!empty($exp_arr))
                {
                 $arr_key=$exp_arr[1];  
                 $showing_str=$exp_arr[0];
                }
                
                $ptr_val_arr=json_decode(base64_decode($_POST['report_val']));
                $data['ptr_val']=$ptr_val_arr[$arr_key]->report_val->$showing_str;
                
                $data['report_of_office']=$this->mymodel->fetch_report_of_office($ptr_val_arr[$arr_key]->office_id,($data['report_option_selector']-1));
                $data['report_details']=$this->mymodel->fetch_report_details('MISD-0014');
                
                $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
                $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
                if ($pos1 === false && $pos2 ===false)
                {
                    $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                    $data['command_office']=$this->mymodel->fetch_command_office($ptr_val_arr[$arr_key]->office_id,($data['report_option_selector']-1),$pos);
                }
                
                if($showing_str !='' && $showing_str=='cor1'){$data['title']='List Of Branch(Corporate-1)';}
                if($showing_str !='' && $showing_str=='cor2'){$data['title']='List Of Branch(Corporate-2)';}
                if($showing_str !='' && $showing_str=='grade1'){$data['title']='List Of Branch(Grade-1)';}
                if($showing_str !='' && $showing_str=='grade2'){$data['title']='List Of Branch(Grade-2)';}
                if($showing_str !='' && $showing_str=='grade3'){$data['title']='List Of Branch(Grade-3)';}
                if($showing_str !='' && $showing_str=='grade4'){$data['title']='List Of Branch(Grade-4)';}
                if($showing_str !='' && $showing_str=='urban'){$data['title']='List Of Urban Branch(Urban)';}
                if($showing_str !='' && $showing_str=='rural'){$data['title']='List Of Rural Branch(Rural)';}
            }

            //first save data for pdf
            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
            
            if($download==1)
            {
                $pdf_filename='branch_specification_list_'.$data['report_of_office'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0014/misd_0014_display_pdf_list', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0014/misd_0014_display_list');      
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
            redirect(base_url().'index.php/report/misd_0014index.php','refresh');
        }
        
    }
    //MISD-0014 End
	
	
     //report misd_0015 start 
    public function misd_0015()
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
        
        
        //get date
        $data['records3']=array();
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('report/misd_0015/misd_0015_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0015_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            
            //ini_set('memory_limit', '-1');
			ini_set('memory_limit', '512M');
			
			$this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array']=$this->mymodel->fetch_range_data($branch_id_array_for_report,$_POST['report_of_date'],$_POST['report_click_btn'],$_POST['range1'],$_POST['range2']);              
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['range1']=$_POST['range1'];
            $data['range2']=$_POST['range2'];
            
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0015');
            $data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1)
            {
                $pdf_filename='range-wise_report_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0015/misd_0015_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0015/misd_0015_display');      
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
            redirect(base_url().'index.php/report/misd_0015index.php','refresh');
        }
        
    }
    //report misd_0015 end
	
	
	//report misd_0016 start
    public function misd_0016($num=0)
	 {
         
        if ($this->session->userdata('some_name1')=='')
        {
                 redirect(base_url(),'refresh');
        }
		
		$this->load->model('mymodel');

        $data=array();
        
        //set session value
		$this->session->unset_userdata('history_file_no');
        if(isset($_POST['actionbtn']) && $_POST['actionbtn']=='Search')
        {
            if(isset($_POST['search_by_designation']) && $_POST['search_by_designation'] !='')//search_by_designation
            {
               $this->session->set_userdata('search_by_designation',$_POST['search_by_designation']);
            }
            
            if(isset($_POST['search_by_off_code']) && $_POST['search_by_off_code'] !='')//search_by_office
            {
               $this->session->set_userdata('search_by_off_code',$_POST['search_by_off_code']);
            }

            if(isset($_POST['search_by_name']) && $_POST['search_by_name'] !='')//search_by_name
            {
                $this->session->set_userdata('search_by_name',$_POST['search_by_name']);
            } 
            
            if(isset($_POST['history_date_from']) && $_POST['history_date_from'] !='')//search by date from
            {
               $this->session->set_userdata('history_date_from',$_POST['history_date_from']);
            }

            if(isset($_POST['history_date_to']) && $_POST['history_date_to'] !='')//search by date to
            {
               $this->session->set_userdata('history_date_to',$_POST['history_date_to']);
            }
        }
        elseif(isset($_POST['actionbtn']) && $_POST['actionbtn']=='Reset')
        {
            $this->session->unset_userdata('search_by_designation');
            $this->session->unset_userdata('search_by_off_code');
            $this->session->unset_userdata('search_by_name');
            $this->session->unset_userdata('history_date_from');
            $this->session->unset_userdata('history_date_to');
        }
        
        //user data
		$data['report_details']=$this->mymodel->fetch_report_details('MISD-0016');
        $data['all_user_total'] = $this->mymodel->fetch_user_history_data(0,0,1);
        
        $data['current_page']=($num>0)?$num:'1';
        $data['per_page'] = 10;
       
        if($num>0)
        {
            $num=($num-1)*$data['per_page'];
        }
        $data['all_user']=$this->mymodel->fetch_user_history_data($num,$data['per_page'],0);
        
        if($num>0)
        {
            $data['show_record_from']=$num;  
        }
        else
        {
            $data['show_record_from']=1;
        }
        $data['show_record_to']=$num+$data['per_page'];
        
        if($data['all_user_total']>0)
        {
            if(($data['all_user_total']<$data['per_page']) || ($data['all_user_total']<$num+$data['per_page']))
            {
                $data['show_record_to']=$data['all_user_total']; 
            }
            $data['total_page']=ceil($data['all_user_total']/$data['per_page']);
        }
        else
        {
            $data['show_record_from']=0;
            $data['show_record_to']=0;
            $data['total_page']=0;
        }
        
        $data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
        $data['off_code_dropdown']=$this->mymodel->get_off_code_dropdown();
        $data['content']=('report/misd_0016/misd_0016_display');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
        
        
     public function misd_0016_specific($num=0)
	 {
         
        if ($this->session->userdata('some_name1')=='')
        {
             redirect(base_url(),'refresh');
        }
		
		$this->load->model('mymodel');
		
		$data=array();
        if(isset($_POST['specific_history_show']) && $_POST['specific_history_show']==1)
        {
           if(isset($_POST['file_no']))
			{
				$this->session->set_userdata('history_file_no',$_POST['file_no']);
				$this->session->unset_userdata('history_date_from_specific');
				$this->session->unset_userdata('history_date_to_specific');
			  
			}
        }
		
         $data['user_all_info']= $this->mymodel->fetch_user_all_info();
         
        //set session value
        if(isset($_POST['actionbtn']) && $_POST['actionbtn']=='Search')
        {
            if(isset($_POST['history_date_from_specific']) && $_POST['history_date_from_specific'] !='')//search_by_date_from
            {
               $this->session->set_userdata('history_date_from_specific',$_POST['history_date_from_specific']);
            }

            if(isset($_POST['history_date_to_specific']) && $_POST['history_date_to_specific'] !='')//search_by_date_to
            {
               $this->session->set_userdata('history_date_to_specific',$_POST['history_date_to_specific']);
            }
        }
        elseif(isset($_POST['actionbtn']) && $_POST['actionbtn']=='Reset')
        {
            $this->session->unset_userdata('history_date_from_specific');
            $this->session->unset_userdata('history_date_to_specific');
        }

		$data['report_details']=$this->mymodel->fetch_report_details('MISD-0016');
        $data['all_user_total'] = $this->mymodel->fetch_user_history_data_specific(0,0,1);
        $data['current_page']=($num>0)?$num:'1';
        $data['per_page'] = 10;

        if($num>0)
        {
            $num=($num-1)*$data['per_page'];
        }
        $data['all_user']=$this->mymodel->fetch_user_history_data_specific($num,$data['per_page'],0);
        
        if($num>0)
        {
            $data['show_record_from']=$num;  
        }
        else
        {
            $data['show_record_from']=1;
        }
        $data['show_record_to']=$num+$data['per_page'];
        
        if($data['all_user_total']>0)
        {
            if(($data['all_user_total']<$data['per_page']) || ($data['all_user_total']<$num+$data['per_page']))
            {
                $data['show_record_to']=$data['all_user_total']; 
            }
            $data['total_page']=ceil($data['all_user_total']/$data['per_page']);
        }
        else
        {
            $data['show_record_from']=0;
            $data['show_record_to']=0;
            $data['total_page']=0;
        }
        $data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
        $data['content']=('report/misd_0016/misd_0016_display_specifiq');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
        
        
	//report misd_0016 end
	
	//report misd_0017 start 
    public function misd_0017()
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
       	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        $data['content']=('report/misd_0017/misd_0017_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0017_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
			$data=array();
		//$tbl_name='PL'.$_POST['report_of_date'];
		//$Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
		//if($Q->num_rows()>0)
		{
            $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            if(isset($data['result_array']) && count($data['result_array'])>0)
            {
                foreach($data['result_array'] as $key=>$row)
                {
                  $office_id_to_sum=array();
                  $report_option_id=$_POST['report_option_selector'];
                  $unique_id=$row['office_id'];
                  $selector=0;
                  
                    if($report_option_id==1)//my office
                    {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                    }
                    else if($report_option_id==2)//branch
                    {
                        $selector=2;
				$data['list_title']='Branch';  
                    }
                    else if($report_option_id==3)//area
                    {
                        $selector=2;
	                  $data['list_title']='Branch';
                    }
                    else if($report_option_id==4)//divisional
                    {
                        $selector=3;
				$data['list_title']='Area Office'; 
                    }
                    
                    else if($report_option_id==6)//divisional corp
                    {
                        $selector=3;
				$data['list_title']='Corporate Branch';
                    }
                    
                    else if($report_option_id==5)//whole bank
                    {
                        $selector=4;
				$data['list_title']='Division';   
                    }
                  $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                  $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0017_cal_data($office_id_to_sum,$_POST['report_of_date']);  
                }
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
            $data['report_of_date']=$_POST['report_of_date'];
            //$data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0017');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='Recovery_report_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0017/misd_0017_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0017/misd_0017_display');      
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
            redirect(base_url().'index.php/report/misd_0017index.php','refresh');
        }
        
    }
    //report misd_0017 end
//report misd_0018 start 
    public function misd_0018()
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
       	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        $data['content']=('report/misd_0018/misd_0018_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
     function misd_0018_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0 && $_POST['report_of_date_one'] !='' & $_POST['report_of_date_two'] !='')//view report
            {
			//first date manage as 1st & 2nd point
			$date1=$_POST['report_of_date_one'];
			$date2=$_POST['report_of_date_two'];
			if(strtotime($_POST['report_of_date_one'])>strtotime($_POST['report_of_date_two']))
			{
			$date1=$_POST['report_of_date_two'];
			$date2=$_POST['report_of_date_one'];
			}
			
             $data['result_array']['first_date']=$this->mymodel->fetch_misd_0018_cal_data_1($branch_id_array_for_report,$date1);
			 $data['result_array']['second_date']=$this->mymodel->fetch_misd_0018_cal_data_2($branch_id_array_for_report,$date2);	
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
            $data['report_of_date_one']=$date1;
			$data['report_of_date_two']=$date2;
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0018');
            $data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date_one']);
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='Recovery_report_two_'.$report_of_office_id.'_'.$_POST['report_of_date_one'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0018/misd_0018_display_pdf', $data, true);
                //generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				//generate_pdf($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0018/misd_0018_display');      
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
            redirect(base_url().'index.php/report/misd_0018index.php','refresh');
        }
        
    }

    //report misd_0018 end
	
	        //report misd_0019 start 
    public function misd_0019()
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
        
        
        $data['records3']=array();
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('report/misd_0019/misd_0019_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0019_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
                $data['pre_week_date']=$this->mymodel->get_preweek_date($_POST['report_of_date']);
                
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            
                if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                  $office_id_to_sum=array();
                  $report_option_id=$_POST['report_option_selector'];
                  $unique_id=$row['office_id'];
                  $selector=0;
                  
                    if($report_option_id==1)//my office
                    {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                    }
                    else if($report_option_id==2)//branch
                    {
                        $selector=2;
				$data['list_title']='Branch';  
                    }
                    else if($report_option_id==3)//area
                    {
                        $selector=2;
	                  $data['list_title']='Branch';
                    }
                    else if($report_option_id==4)//divisional
                    {
                        $selector=3;
				$data['list_title']='Area Office'; 
                    }
                    
                    else if($report_option_id==6)//divisional corp
                    {
                        $selector=3;
				$data['list_title']='Corporate Branch';
                    }
                    
                    else if($report_option_id==5)//whole bank
                    {
                        $selector=4;
				        $data['list_title']='Division';   
                    }
                      $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                      $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0019_cal_data($office_id_to_sum,$_POST['report_of_date'],$data['pre_week_date']);  
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0019');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }

            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='comparative_deposit_status_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0019/misd_0019_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0019/misd_0019_display');      
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
            redirect(base_url().'index.php/report/misd_0019index.php','refresh');
        }
        
    }
    //report misd_0019 end
	
	     //report misd_0020 start 
    public function misd_0020()
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
        
        $data['content']=('report/misd_0020/misd_0020_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0020_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
           
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
                $tbl_name='backpage'.$_POST['report_of_month'].$_POST['report_of_year'];
                $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
                if($Q->num_rows()>0)
                {
                    $data['result_array']=$this->mymodel->fetch_affairs_backpage_data($branch_id_array_for_report,$tbl_name);
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
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0020');

            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='affairs_backpage_statement_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0020/misd_0020_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0020/misd_0020_display');      
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
            redirect(base_url().'index.php/report/misd_0020index.php','refresh');
        }
        
    }
    //report misd_0020 end
	
	
	//report misd_0021 start 
    public function misd_0021()
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
        
        $data['content']=('report/misd_0021/misd_0021_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0021_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
           
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
                $tbl_name='DSA'.$_POST['report_of_month'].$_POST['report_of_year'];
                $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
                if($Q->num_rows()>0)
                {
                    $data['result_array_liabilities']=$this->mymodel->fetch_statement_of_affairs_data($branch_id_array_for_report,$tbl_name,1);//liabilities
                    $data['result_array_assets']=$this->mymodel->fetch_statement_of_affairs_data($branch_id_array_for_report,$tbl_name,2);//assets
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
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0021');

            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='statement_of_affairs_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0021/misd_0021_display_pdf', $data, true);
				//$pdf_content = $this->load->view('report/misd_0021/test', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,TRUE);
            }
            else
            {
                $data['content']=('report/misd_0021/misd_0021_display');      
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
            redirect(base_url().'index.php/report/misd_0021index.php','refresh');
        }
        
    }
    //report misd_0021 end
    
	//report misd_0022 start 
    public function misd_0022()
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
        
        
        $data['records3']=array();
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('report/misd_0022/misd_0022_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0022_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
			//get all office under selection
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            
                if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                  $office_id_to_sum=array();
                  $report_option_id=$_POST['report_option_selector'];
                  $unique_id=$row['office_id'];
                  $selector=0;
                  
                    if($report_option_id==1)//my office
                    {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                    }
                    else if($report_option_id==2)//branch
                    {
                        $selector=2;
				        $data['list_title']='Branch';  
                    }
                    else if($report_option_id==3)//area
                    {
                        $selector=2;
	                    $data['list_title']='Branch';
                    }
                    else if($report_option_id==4)//divisional
                    {
                        $selector=3;
				        $data['list_title']='Area Office'; 
                    }
                    
                    else if($report_option_id==6)//divisional corp
                    {
                        $selector=3;
				        $data['list_title']='Corporate Branch';
                    }
                    
                    else if($report_option_id==5)//whole bank
                    {
                        $selector=4;
				        $data['list_title']='Division';   
                    }
                     $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                     $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0022_cal_data($office_id_to_sum,$_POST['report_of_year'],$_POST['report_click_btn']);
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0022');
			
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1)
            {
                $pdf_filename='business_indicator_monitoring_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0022/misd_0022_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0022/misd_0022_display');      
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
            redirect(base_url().'index.php/report/misd_0022index.php','refresh');
        }
        
    }
    //report misd_0022 end
	
	     //report misd_0023 start 
    public function misd_0023()
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
        
        $data['content']=('report/misd_0023/misd_0023_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0023_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   

            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              //->1
              $last_day_of_selected_month=$this->mymodel->fetch_calculated_date($_POST['report_of_year'],$_POST['report_of_month'],2);
            
              for($i=1;$i<12;$i++)
              { 
                $data['result_array'][$i]=$this->mymodel->fetch_range_wise_ADR_data($branch_id_array_for_report,$last_day_of_selected_month,$i);
                
                $text='';
                if($i==1){$text='0 to 10%';}
                elseif($i==11){$text='100% and above';}
                else
				{
					$st=((($i-1)*10)+1); 
					$end=((($i-1)*10)+10);
					if($i==10)
					{
						$end=(((($i-1)*10)+10)-1);
					}
					$text="$st to $end%";
				}
                $data['result_array'][$i]['range_text']=$text;
              }
			  $data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$last_day_of_selected_month);
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
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0023');

            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='range-wise_ADR_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0023/misd_0023_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0023/misd_0023_display');      
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
            redirect(base_url().'index.php/report/misd_0001index.php','refresh');
        }
        
    }
    //report misd_0023 start
	
	//report misd_0032 start 
    public function misd_0032()
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
        
        $data['content']=('report/misd_0032/misd_0032_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0032_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
				if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                      $office_id_to_sum=array();
                      $report_option_id=$_POST['report_option_selector'];
                      $unique_id=$row['office_id'];
                      $selector=0;
                      
                        if($report_option_id==1)//my office
                        {
                            $status=$this->mymodel->get_login_office_status($report_of_office_id);
                            if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                            if($status==3){$selector=2;$data['list_title']='Branch';}//area
                            if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                            if($status==1){$selector=4;$data['list_title']='Division'; }//whole bank  
                        }
                        else if($report_option_id==2)//branch
                        {
                            $selector=2;
							$data['list_title']='Branch';							
                        }
                        else if($report_option_id==3)//area
                        {
                            $selector=2;
							$data['list_title']='Branch';
                        }
                        else if($report_option_id==4)//divisional
                        {
                            $selector=3; 
							$data['list_title']='Area Office'; 
                        }
                        
                        else if($report_option_id==6)//divisional corp
                        {
                            $selector=3;
							$data['list_title']='Corporate Branch';
                        }
                        
                        else if($report_option_id==5)//whole bank
                        {
                            $selector=4;   
							$data['list_title']='Division';   
                        }
                      $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                      $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0032_cal_data($office_id_to_sum,$_POST['report_of_year'],$_POST['report_of_month']);  
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0032');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='cl1_report_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0032/misd_0032_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0032/misd_0032_display');      
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
            redirect(base_url().'index.php/report/misd_0032index.php','refresh');
        }
        
    }
    //report misd_0032 end
    
//report misd_0033 start 
    public function misd_0033()
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
        
        $data['content']=('report/misd_0033/misd_0033_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0033_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
				if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
					{
					   $report_of_office_id=$_POST['report_report_office_id']; 
					}
					
					$branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
					
					//Now prepare report data
					$data['result_array']=array();
					if($_POST['report_click_btn']>0)//view report
					{
					  $data['result_array']['report_val']=$this->mymodel->fetch_misd_0033_cal_data($branch_id_array_for_report,$_POST['report_of_year'],$_POST['report_of_month']);              
					}
                }
                
              // echo "<pre>";
                //print_r($data['result_array']['report_val']);
               // die();
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0033');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='sbs2_sector_report_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0033/misd_0033_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0033/misd_0033_display');      
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
            redirect(base_url().'index.php/report/misd_0033index.php','refresh');
        }
        
    }
    //report misd_0033 end

	
	
	//report misd_0034 start 
    public function misd_0034()
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
        
        $data['content']=('report/misd_0034/misd_0034_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0034_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

            //get all office under selection
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
				if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
					{
					   $report_of_office_id=$_POST['report_report_office_id']; 
					}
					
					$branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
					
					//Now prepare report data
					$data['result_array']=array();
					if($_POST['report_click_btn']>0)//view report
					{
					  $data['result_array']['report_val']=$this->mymodel->fetch_misd_0034_cal_data($branch_id_array_for_report,$_POST['report_of_year'],$_POST['report_of_month']);              
					}
                }
                
              // echo "<pre>";
                //print_r($data['result_array']['report_val']);
               // die();
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0034');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='sbs2_deposit_type_report_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0034/misd_0034_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0034/misd_0034_display');      
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
            redirect(base_url().'index.php/report/misd_0034index.php','refresh');
        }
        
    }
    //report misd_0034 end
	
	    //report misd_0035 start 
    public function misd_0035()
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
        
        $data['last_cibta_view_name']=$this->mymodel->get_last_cibta_view_name();
		$data['content']=('report/misd_0035/misd_0035_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0035_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');

            $tbl_name='CIBTABR'.$_POST['report_of_month'].$_POST['report_of_year'];
            $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
            if($Q->num_rows()>0)
            {
                $data['result_array']['report_val']=$this->mymodel->fetch_misd_0035_cal_data($report_of_office_id,$tbl_name);
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,2);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0035');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,2,$pos);
            }
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='CIBTA_statement_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0035/misd_0035_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0035/misd_0035_display');      
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
            redirect(base_url().'index.php/report/misd_0035index.php','refresh');
        }
        
    }
    //report misd_0035
	
	    //report misd_0036 start 
    public function misd_0036()
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
        
        $data['content']=('report/misd_0036/misd_0036_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0036_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            ini_set('memory_limit', '512M');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            
            $tbl_name='CIB'.$_POST['report_of_month'].$_POST['report_of_year'];
            $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
            if($Q->num_rows()>0)
            {
                $data['result_array']['report_val']=$this->mymodel->fetch_cib_data($branch_id_array_for_report,$tbl_name);
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0036');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='large_loan_statement_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0036/misd_0036_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0036/misd_0036_display');      
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
            redirect(base_url().'index.php/report/misd_0036index.php','refresh');
        }
        
    }
    //report misd_0036 end
	
	    //report misd_0037 start 
    public function misd_0037()
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
        
        $data['content']=('report/misd_0037/misd_0037_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0037_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            
            $tbl_name='JbPerEva'.$_POST['report_of_year'];
            if( $this->db->table_exists($tbl_name) == TRUE)
            {
              $data['result_array']['report_val']=$this->mymodel->fetch_ppr_data($branch_id_array_for_report,$tbl_name,$_POST['report_of_month']);  
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0037');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                
                if( ($this->db->table_exists($tbl_name) == TRUE ) && (isset($data['result_array']['report_val']['DPCurrentMonthAchivement']) && $data['result_array']['report_val']['DPCurrentMonthAchivement']>0))
                {  
                    define("DOMPDF_ENABLE_REMOTE", true);
                    $pdf_filename='ppr_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                    $pdf_content = $this->load->view('report/misd_0037/misd_0037_display_pdf', $data, true);
                    generate_pdf_landscape_legal($pdf_content, $pdf_filename,true); 
                }
                else
                {
                    $this->session->set_flashdata('notice','No Report Found for selected quarter.');
                    redirect(base_url().'index.php/report/misd_0037index.php','refresh');                 
                }
            }
            else
            {
                $data['content']=('report/misd_0037/misd_0037_display');      
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
            redirect(base_url().'index.php/report/misd_0037index.php','refresh');
        }
        
    }
    //report misd_0037 end
	
	    //report misd_0038 start 
    public function misd_0038()
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
        
        $data['content']=('report/misd_0038/misd_0038_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0038_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }

                $tbl_name='JbPerEva'.$_POST['report_of_year'];
                if( $this->db->table_exists($tbl_name) == TRUE)
                {
                    //get all office under selection
                    $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
                
                    if(isset($data['result_array']) && count($data['result_array'])>0)
                    {
                        foreach($data['result_array'] as $key=>$row)
                        {
                          $office_id_to_sum=array();
                          $report_option_id=$_POST['report_option_selector'];
                          $unique_id=$row['office_id'];
                          $selector=0;
                          
                            if($report_option_id==1)//my office
                            {
                                $status=$this->mymodel->get_login_office_status($report_of_office_id);
                                if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                                if($status==3){$selector=2;$data['list_title']='Branch';}//area
                                if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                                if($status==1){$selector=4;$data['list_title']='Division'; }//whole bank  
                            }
                            else if($report_option_id==2)//branch
                            {
                                $selector=2;
    							$data['list_title']='Branch';							
                            }
                            else if($report_option_id==3)//area
                            {
                                $selector=2;
    							$data['list_title']='Branch';
                            }
                            else if($report_option_id==4)//divisional
                            {
                                $selector=3; 
    							$data['list_title']='Area Office'; 
                            }
                            
                            else if($report_option_id==6)//divisional corp
                            {
                                $selector=3;
    							$data['list_title']='Corporate Branch';
                            }
                            
                            else if($report_option_id==5)//whole bank
                            {
                                $selector=4;   
    							$data['list_title']='Division';   
                            }
                          $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                          $data['result_array'][$key]['report_val']=$this->mymodel->fetch_3348_data($office_id_to_sum,$tbl_name,$_POST['report_of_month']);  
                        }
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0038');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                
                if( ($this->db->table_exists($tbl_name) == TRUE ) && (isset($data['result_array'][0]['report_val']['DPCurrentMonthAchivement']) && $data['result_array'][0]['report_val']['DPCurrentMonthAchivement']>0))
                {  
                    define("DOMPDF_ENABLE_REMOTE", true);
                    $pdf_filename='monthly_business_position_'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                    $pdf_content = $this->load->view('report/misd_0038/misd_0038_display_pdf', $data, true);
                    generate_pdf_landscape_legal($pdf_content, $pdf_filename,true); 
                }
                else
                {
                    $this->session->set_flashdata('notice','No Report Found for selected month.');
                    redirect(base_url().'index.php/report/misd_0038index.php','refresh');                 
                }
                
            }
            else
            {
                $data['content']=('report/misd_0038/misd_0038_display');      
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
            redirect(base_url().'index.php/report/misd_0038index.php','refresh');
        }
        
    }
    //report misd_0038 end
	
	    //report misd_0041 start 
    public function misd_0041()
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
        
        
        //get weekly date
        $data['wp_date']=$this->mymodel->weekly_position_date();
        $data['wp_group']=$this->mymodel->get_wp_group_subgroup_option(1);
        $data['wp_subgroup']=$this->mymodel->get_wp_group_subgroup_option(2);
        
        $data['content']=('report/misd_0041/misd_0041_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0041_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array']=$this->mymodel->get_wp_head_single_account_details_report($branch_id_array_for_report,$_POST);              
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0041');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                ini_set('memory_limit', '512M');
                $pdf_filename='wp_head_single_ac_report_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0041/misd_0041_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0041/misd_0041_display');      
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
            redirect(base_url().'index.php/report/misd_0041index.php','refresh');
        }
        
    }
    //report misd_0041 end

 //report misd_0040 start 
    public function misd_0040()
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
         $data['records3']=array();
   	   	if($query3 = $this->mymodel->weekly_position_date())
		{
			$data['records3'] = $query3;
		}
		
        //$data['last_cibta_view_name']=$this->mymodel->get_last_cl2_name();
		$data['content']=('report/misd_0040/misd_0040_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0040_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
       
	   if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            $date1=$_POST['report_of_date1'];
            $date2=$_POST['report_of_date2'];
          
		   if(strtotime($date1)>strtotime($date2))
           {
            $temp=$date1;
            $date1=$date2;
            $date2=$temp;
           }
		   $data['report_of_date1']=$date1;
           $data['report_of_date2']=$date2;
          
		  if(isset($_POST['weekly_report_office_id']) && $_POST['weekly_report_office_id']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['weekly_report_office_id']; 
            }
            
			if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
			{
			   $report_of_office_id=$_POST['report_report_office_id']; 
			}
			
			$branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
			
            //Now prepare option
            if($_POST['report_click_btn']>0)//view report
            {
                if($query1 = $this->mymodel->get_weekly_position_option())
				{
					$data['records2'] = $query1;
				}
				
				if($query = $this->mymodel->get_weekly_group())
				{
					$data['records1'] = $query;
				}
			  
			  $data['records3_1']=$this->mymodel->fetch_weekly_pos_data_details($branch_id_array_for_report,$date1);
			  $data['records3_2']=$this->mymodel->fetch_weekly_pos_data_details($branch_id_array_for_report,$date2);
			  $data['completed_vs_total_1']=$this->mymodel->fetch_weekly_data_details_completed_vs_total($branch_id_array_for_report,$date1);  
			  $data['completed_vs_total_2']=$this->mymodel->fetch_weekly_data_details_completed_vs_total($branch_id_array_for_report,$date2);  
			}
				
		    if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
			
            $data['report_click_btn']=$_POST['report_click_btn']; 
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
          
			$data['report_details']=$this->mymodel->fetch_report_details('MISD-0040');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
			
			if($download==1 || $_POST['report_click_btn']==2)
            {
				
				if((isset($data['records3_1']) && count($data['records3_1'])>0) || (isset($data['records3_2']) && count($data['records3_2'])>0))
                {  
                    
                    $pdf_filename='Weekly_position_comp_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'_'.$_POST['report_of_date2'].'.pdf';
					$pdf_content = $this->load->view('report/misd_0040/misd_0040_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
                }
                else
                {
                    $this->session->set_flashdata('notice','No Report Found for selected date.');
                    redirect(base_url().'index.php/report/misd_0040index.php','refresh');                 
                }
				
            }
            else
            {
                $data['content']=('report/misd_0040/misd_0040_display');      
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
            redirect(base_url().'index.php/report/misd_0040index.php','refresh');
        }
        
    }
    // report misd_0040 end
	
	//report misd_0042 start 
    public function misd_0042()
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
        
        
        //get weekly date
        $data['wp_date']=$this->mymodel->weekly_position_date();
        $data['wp_group']=$this->mymodel->get_wp_group_subgroup_option(1);
        $data['wp_subgroup']=$this->mymodel->get_wp_group_subgroup_option(2);
        
        $data['content']=('report/misd_0042/misd_0042_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0042_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            if(strtotime($_POST['report_of_date1'])>strtotime($_POST['report_of_date2']))
            {
                $temp=$_POST['report_of_date1'];
                $_POST['report_of_date1']=$_POST['report_of_date2'];
                $_POST['report_of_date2']=$temp;
            }
            //Now prepare report data
            $data['result_array']=array();
            if($_POST['report_click_btn']>0)//view report
            {
              $data['result_array']=$this->mymodel->get_wp_head_single_account_comparisn_report($branch_id_array_for_report,$_POST);              
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
            $data['report_of_date1']=$_POST['report_of_date1'];
            $data['report_of_date2']=$_POST['report_of_date2'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0042');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                ini_set('memory_limit', '512M');
                $pdf_filename='wp_head_single_ac_report_'.$report_of_office_id.'.pdf';
                $pdf_content = $this->load->view('report/misd_0042/misd_0042_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0042/misd_0042_display');      
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
            redirect(base_url().'index.php/report/misd_0042index.php','refresh');
        }
        
    }
    //report misd_0042 end
	
	    //report misd_0043 start 
    public function misd_0043()
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
        
        $data['content']=('report/misd_0043/misd_0043_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0043_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');

            //date and proc exist check
            $date_str='';
            if(isset($_POST['report_of_year']) && $_POST['report_of_year'] && isset($_POST['report_of_month']) && $_POST['report_of_month'])
            {
               $date_str=$_POST['report_of_year']."-".$_POST['report_of_month']."-"."01"; 
            }
            $Q=$this->db->query("SELECT 1 FROM sys.procedures WHERE Name = 'CIBTADetail'");
            if($Q->num_rows()>0 && $date_str !='')
            {
                $proc_name='CIBTADetail';
                $data['result_array']=$this->mymodel->fetch_misd_0043_cal_data($report_of_office_id,$proc_name,$date_str);
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,2);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0043');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,2,$pos);
            }
            if($download==1 || $_POST['report_click_btn']==2)
            {
                ini_set('memory_limit', '512M');
                $pdf_filename='CIBTA_originating_outstanding'.$report_of_office_id.'_'.$_POST['report_of_month'].'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0043/misd_0043_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0043/misd_0043_display');      
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
            redirect(base_url().'index.php/report/misd_0043index.php','refresh');
        }
        
    }
    //report misd_0043 end
	
	    //report misd_0044 start 
    public function misd_0044()
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
        
        $data['content']=('report/misd_0044/misd_0044_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0044_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare report data
            $data['result_array']=array();
            
            $tbl_name='';
            if($_POST['report_click_btn']==1 && $_POST['report_of_year'] !='' && $_POST['report_of_month'] !='')
            {
              $tbl_name='BSDPST'.$_POST['report_of_month'].$_POST['report_of_year'];  
            }
            if($_POST['report_click_btn']==2 && $_POST['report_of_year'] !='' && $_POST['report_of_month'] !='')
            {
              $tbl_name='BSADVNC'.$_POST['report_of_month'].$_POST['report_of_year'];   
            }
            
            $Q=$this->db->query("SELECT 1 FROM sys.views WHERE Name = '$tbl_name'");
            if($Q->num_rows()>0)
            {
              $data['result_array']=$this->mymodel->fetch_misd_0044_data($branch_id_array_for_report,$_POST['report_click_btn'],$tbl_name);  
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0044');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1)
            {
                
                $pdf_filename='interest_rate_spread_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0044/misd_0044_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0044/misd_0044_display');      
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
            redirect(base_url().'index.php/report/misd_0044index.php','refresh');
        }
        
    }
    //report misd_0044 end
	
	//MISD-0045 START
    
    public function misd_0045()
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
        
        
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('report/misd_0045/misd_0045_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0045_report_details($download=0)
    {        
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            $date1='';
            $date2='';
            
            if(isset($_POST['report_of_date1'])){$date1=$_POST['report_of_date1'];}
            if(isset($_POST['report_of_date2'])){$date2=$_POST['report_of_date2'];}
            if($date1 !='' && $date2 !='')
            {
                
                if(strtotime($date1)>strtotime($date2))
                {
                   $date1=$_POST['report_of_date2'];
                   $date2=$_POST['report_of_date1'];
                }
            }
            
            //now fetch date array
            $date_array=$this->mymodel->fetch_graph_date_str($date1,$date2);
            
            //now fetch required bussiness data
            $cal_amt_array=$this->mymodel->fetch_graph_analysis_data($branch_id_array_for_report,$date_array,$_POST['report_click_btn']); 
            
            //set dynamic options
            $title='';
            $series='';
			$color='';
            if($_POST['report_click_btn']==1)//deposit
            {
              $title='Deposit Figure';  
              $series='Deposit';
			  $color='green';
            }
            if($_POST['report_click_btn']==2)//HCD
            {
              $title='High Cost Deposit Figure';  
              $series='HCD';
			  $color='green';
            }
            if($_POST['report_click_btn']==3)//HCD%
            {
              $title='High Cost Deposit(%)';  
              $series='HCD(%)';
			  $color='green';
            }
            if($_POST['report_click_btn']==4)//LCD
            {
              $title='Low Cost Deposit Figure';  
              $series='LCD';
			  $color='green';
            }
            if($_POST['report_click_btn']==5)//LCD%
            {
              $title='Low Cost Deposit(%)';  
              $series='LCD(%)';
			  $color='green';
            }
            if($_POST['report_click_btn']==6)//Advance
            {
              $title='Advance Figure';  
              $series='Advance';
			  $color='red';
            }
            if($_POST['report_click_btn']==7)//ADR including LYA
            {
              $title='Advance-Deposit Ratio (including LYA)';  
              $series='ADR including LYA';
			  $color='green';
            }
			if($_POST['report_click_btn']==12)//ADR excluding LYA
            {
              $title='Advance-Deposit Ratio (excluding LYA)';  
              $series='ADR excluding LYA';
			  $color='green';
            }
            if($_POST['report_click_btn']==8)//PL
            {
              $title='PL Figure';  
              $series='PL';
			  $color='green';
            }
            if($_POST['report_click_btn']==9)//UC
            {
              $title='UC Figure (Without stuff)';  
              $series='UC';
			  $color='red';
            }
            if($_POST['report_click_btn']==10)//CL
            {
              $title='CL Figure';  
              $series='CL';
			  $color='red';
            }
            if($_POST['report_click_btn']==11)//CL%
            {
              $title='CL Percentage (Without stuff)';  
              $series='CL(%)';
			  $color='red';
            }
                      
          
            foreach($date_array as $datte)
            {
                $dat[]=substr($datte['om_dat_date'],0,11);
            }
            
      		$data_['popul']['data'] =$cal_amt_array;
    		$data_['popul']['name'] = $series;
			$data_['popul']['color'] = $color;
    		
            $data_['axis']['categories'] =$dat;
            
    		foreach ($data_['popul']['data'] as $key => $val)
    		{
    			$output[] = (object)array(
    				$series 		=> $val,
    				'contries'		=> $data_['axis']['categories'][$key]
    			);
    		}
            
            //check unit of graph 
            /*
            $y_axix_unit='Amount in Billions';
            if(isset($data_['popul']['data']) && MAX($data_['popul']['data'])<1000000000)
            {
                $y_axix_unit='Amount in Millions';
            } 
            */

            
            //first save data for bar graph
            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
            $data['report_click_btn']=$_POST['report_click_btn']; 
            $data['report_of_date1']=$date1;
            $data['report_of_date2']=$date2;
            
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0045');

            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1)
            {
                    $graph_data = $data_;                              
                    $this->load->library('highcharts');
                    $this->highcharts
                    ->initialize('chart_template') 	
                    ->push_xAxis($graph_data['axis']) 
                    ->set_serie($graph_data['popul']);
                    //->set_serie($graph_data['users'],'Advance');
                    $this->highcharts->set_title($title);
                    //$this->highcharts->set_axis_titles('.', $y_axix_unit);
					$this->highcharts->set_axis_titles('.', $series);
                    $data['charts'] = $this->highcharts->render();
                    $data['content']=('report/misd_0045/misd_0045_display');  
                    $data['param']=$download;
                     //conversion str
                    $data['link_str']='See Line Graph';
                    $data['graph_title']='Bar Graph';
                    $data['link_param']=0;
                     
                    $data['uid']= $this->session->userdata('some_name1');
                    $data['txt_office_name']= $this->session->userdata('some_name2');
                    $data['dat_entry_date']= $this->session->userdata('some_name3');
                    $data['logout']='home/logout';
                    $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                    $this->load->view('home',$data); 
                
            }
            else
            { 
                $result = $output;
				$dat1['x_labels'] 	= 'contries'; 
				$dat1['series'] 	= array($series); 
				$dat1['data']		= $result;
				$this->load->library('highcharts');
				$this->highcharts->set_title($title);
				//$this->highcharts->set_axis_titles('', $y_axix_unit);
				$this->highcharts->set_axis_titles('', $series);
				$this->highcharts->from_result($dat1)->add(); // first graph: add() register the graph
				$data['charts'] = $this->highcharts->render();
                $data['content']=('report/misd_0045/misd_0045_display');  
                $data['param']=$download;
                //conversion str
                $data['link_str']='See Bar Graph';
                $data['graph_title']='Line Graph';
                $data['link_param']=1;  
                

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
            redirect(base_url().'index.php/report/misd_0045index.php','refresh');
        }
        
    }
    
    //MISD-0045 END
	
//report misd_0046 start 
    public function misd_0046()
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
        
        $data['content']=('report/misd_0046/misd_0046_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0046_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            ini_set('memory_limit', '512M');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            //Now prepare report data
            $data['result_array']=array();
            
            $tbl_name='CIB'.$_POST['report_of_month'].$_POST['report_of_year'];
            $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
            if($Q->num_rows()>0)
            {
                
                if($_POST['report_click_btn']==1)
                {
                    $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
                    if(isset($data['result_array']) && count($data['result_array'])>0)
                    {
                        foreach($data['result_array'] as $key=>$row)
                        {
                          $office_id_to_sum=array();
                          $report_option_id=$_POST['report_option_selector'];
                          $unique_id=$row['office_id'];
                          $selector=0;
                      
                        if($report_option_id==1)//my office
                        {
                            $status=$this->mymodel->get_login_office_status($report_of_office_id);
                            if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                            if($status==3){$selector=2;$data['list_title']='Branch';}//area
                            if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                            if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                        }
                        else if($report_option_id==2)//branch
                        {
                            $selector=2;
    				$data['list_title']='Branch';  
                        }
                        else if($report_option_id==3)//area
                        {
                            $selector=2;
    	                  $data['list_title']='Branch';
                        }
                        else if($report_option_id==4)//divisional
                        {
                            $selector=3;
    				$data['list_title']='Area Office'; 
                        }
                        
                        else if($report_option_id==6)//divisional corp
                        {
                            $selector=3;
    				$data['list_title']='Corporate Branch';
                        }
                        
                        else if($report_option_id==5)//whole bank
                        {
                            $selector=4;
    				        $data['list_title']='Division';   
                        }
                          $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                          $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0046_data($office_id_to_sum,$tbl_name,$_POST['report_of_year'],$_POST['report_of_month'],$_POST['report_click_btn']);  
                        }
                    }
                  }
                    
                if($_POST['report_click_btn']==2)
                {
                  $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
                  $data['result_array']['report_val']=$this->mymodel->fetch_misd_0046_data($branch_id_array_for_report,$tbl_name,$_POST['report_of_year'],$_POST['report_of_month'],$_POST['report_click_btn']);  
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0046');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1)
            {
                
                if($_POST['report_click_btn']==1)
                {
                    $pdf_filename='new_loan_statement_summary_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                    $pdf_content = $this->load->view('report/misd_0046/misd_0046_display_summary_pdf', $data, true);
                    generate_pdf_landscape($pdf_content, $pdf_filename,true);
                }
                if($_POST['report_click_btn']==2)
                {
                    ini_set('memory_limit', '512M');
					$pdf_filename='new_loan_statement_detail_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                    $pdf_content = $this->load->view('report/misd_0046/misd_0046_display_detail_pdf', $data, true);  
                    generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);   
                }  
                
                
            }
            else
            {
                if($_POST['report_click_btn']==1)
                {
                    $data['content']=('report/misd_0046/misd_0046_display_summary');
                }
                if($_POST['report_click_btn']==2)
                {
                    $data['content']=('report/misd_0046/misd_0046_display_detail');      
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
            redirect(base_url().'index.php/report/misd_0046index.php','refresh');
        }
        
    }
    //report misd_0046 end
	
	//report misd_0047 start 
    public function misd_0047()
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
        
        $data['content']=('report/misd_0047/misd_0047_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0047_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
			//get all office under selection
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
            
                if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                        $office_id_to_sum=array();
                        $report_option_id=$_POST['report_option_selector'];
                        $unique_id=$row['office_id'];
                        $selector=0;
                        
                        if($report_option_id==1)//my office
                        {
                            $status=$this->mymodel->get_login_office_status($report_of_office_id);
                            if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                            if($status==3){$selector=2;$data['list_title']='Branch';}//area
                            if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                            if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                        }
                        else if($report_option_id==2)//branch
                        {
                            $selector=2;
                            $data['list_title']='Branch';  
                        }
                        else if($report_option_id==3)//area
                        {
                            $selector=2;
                            $data['list_title']='Branch';
                        }
                        else if($report_option_id==4)//divisional
                        {
                            $selector=3;
                            $data['list_title']='Area Office'; 
                        }
                        
                        else if($report_option_id==6)//divisional corp
                        {
                            $selector=3;
                            $data['list_title']='Corporate Branch';
                        }
                        
                        else if($report_option_id==5)//whole bank
                        {
                            $selector=4;
                            $data['list_title']='Division';   
                        }
                        
                        $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                        $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0047_cal_data($office_id_to_sum,$_POST['report_of_year']);
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0047');
			
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='yearly_new_loan_statement_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0047/misd_0047_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0047/misd_0047_display');      
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
            redirect(base_url().'index.php/report/misd_0047index.php','refresh');
        }
        
    }
    //report misd_0047 end
	
	
	    //report misd_0048 start 
    public function misd_0048()
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
        
        $data['content']=('report/misd_0048/misd_0048_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0048_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            ini_set('memory_limit', '512M');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            //Now prepare report data
            $data['result_array']=array();
            
            $tbl_name_affair='DSA'.$_POST['report_of_month'].$_POST['report_of_year'];
			$tbl_name_pl='PL'.$_POST['report_of_month'].$_POST['report_of_year'];
            $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_affair'");
			$QQ=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_pl'");
			if($Q->num_rows()>0 && $QQ->num_rows()>0)
            {
                
                $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
                $data['result_array']=$this->mymodel->fetch_misd_0048_data($branch_id_array_for_report,$tbl_name_affair,$tbl_name_pl,$_POST['report_of_month'],$_POST['report_of_year']);

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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0048');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='unit_wise_business_position_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                $pdf_content = $this->load->view('report/misd_0048/misd_0048_display_pdf', $data, true);
                generate_pdf_landscape($pdf_content, $pdf_filename,true);
                
                
            }
            else
            {
                $data['content']=('report/misd_0048/misd_0048_display');    
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
            redirect(base_url().'index.php/report/misd_0048index.php','refresh');
        }
        
    }
    //report misd_0048 end
	
	
	//report misd_0049 start 
    public function misd_0049()
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
        
        $data['content']=('report/misd_0049/misd_0049_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0049_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            ini_set('memory_limit', '512M');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            //Now prepare report data
            $data['result_array']=array();
            
            
            //checking option for view or table
            $select_option_status=0;
            
            $month=$_POST['report_of_month'];
            $year=$_POST['report_of_year'];
            
            $tbl_name_affair='DSA'.$month.$year;
            $Q_affair_sys=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_affair'");
            if($Q_affair_sys->num_rows()>0){$select_option_status=1;}
            
            $tbl_name_pl='PL'.$month.$year;
            $Q_pl_sys=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_pl'");
            if($Q_pl_sys->num_rows()>0){$select_option_status=1;}
            
            $tbl_name_cl='CL1';
            $Q_cl_sys=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_cl'");
            if($Q_cl_sys->num_rows()>0){$select_option_status=1;}
            
            $tbl_name_omis='omis_data_'.$year.'_'.$month;
            if($this->db->table_exists($tbl_name_omis) == TRUE){$select_option_status=1;}
            
            if($select_option_status==1)
            {
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
                if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                        $office_id_to_sum=array();
                        $report_option_id=$_POST['report_option_selector'];
                        $unique_id=$row['office_id'];
                        $selector=0;
                        
                        if($report_option_id==1)//my office
                        {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                        }
                        else if($report_option_id==2)//branch
                        {
                        $selector=2;
                        $data['list_title']='Branch';  
                        }
                        else if($report_option_id==3)//area
                        {
                        $selector=2;
                        $data['list_title']='Branch';
                        }
                        else if($report_option_id==4)//divisional
                        {
                        $selector=3;
                        $data['list_title']='Area Office'; 
                        }
                        
                        else if($report_option_id==6)//divisional corp
                        {
                        $selector=3;
                        $data['list_title']='Corporate Branch';
                        }
                        
                        else if($report_option_id==5)//whole bank
                        {
                        $selector=4;
                        $data['list_title']='Division';   
                        }
                        $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                        
                        $data['result_array'][$key]['no_of_branch']=count($office_id_to_sum);
                        //get data
                        $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0049_data($office_id_to_sum,$year,$month,$_POST['report_click_btn']);  
                    }
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0049');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                    $pdf_filename='productivity_analysis_per_branch_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                    $pdf_content = $this->load->view('report/misd_0049/misd_0049_display_pdf', $data, true);
                    generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0049/misd_0049_display');  
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
            redirect(base_url().'index.php/report/misd_0049index.php','refresh');
        }
        
    }
    //report misd_0049 end
    
	
	    //report misd_0050 start 
    public function misd_0050()
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
        
        $data['content']=('report/misd_0050/misd_0050_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function misd_0050_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            ini_set('memory_limit', '512M');
            
            if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['report_report_office_id']; 
            }
            
            //Now prepare report data
            $data['result_array']=array();
            
            
            //checking option for view or table
            $tbl_name='CIB'.$_POST['report_of_month'].$_POST['report_of_year'];
            $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
            if($Q->num_rows()>0)
            {
                $data['result_array']=$this->mymodel->fetch_all_office_array($report_of_office_id,$_POST['report_option_selector']);
                if(isset($data['result_array']) && count($data['result_array'])>0)
                {
                    foreach($data['result_array'] as $key=>$row)
                    {
                        $office_id_to_sum=array();
                        $report_option_id=$_POST['report_option_selector'];
                        $unique_id=$row['office_id'];
                        $selector=0;
                        
                        if($report_option_id==1)//my office
                        {
                        $status=$this->mymodel->get_login_office_status($report_of_office_id);
                        if($status==4){$selector=2;$data['list_title']='Branch';}//branch
                        if($status==3){$selector=2;$data['list_title']='Branch';}//area
                        if($status==2){$selector=3;$data['list_title']='Area Office';}//division
                        if($status==1){$selector=4; $data['list_title']='Division';}//whole bank  
                        }
                        else if($report_option_id==2)//branch
                        {
                        $selector=2;
                        $data['list_title']='Branch';  
                        }
                        else if($report_option_id==3)//area
                        {
                        $selector=2;
                        $data['list_title']='Branch';
                        }
                        else if($report_option_id==4)//divisional
                        {
                        $selector=3;
                        $data['list_title']='Area Office'; 
                        }
                        
                        else if($report_option_id==6)//divisional corp
                        {
                        $selector=3;
                        $data['list_title']='Corporate Branch';
                        }
                        
                        else if($report_option_id==5)//whole bank
                        {
                        $selector=4;
                        $data['list_title']='Division';   
                        }
                        $office_id_to_sum=$this->mymodel->fetch_branch_array_for_report_module($unique_id,$selector);
                        
                        $data['result_array'][$key]['no_of_branch']=count($office_id_to_sum);
                        //get data
                        $data['result_array'][$key]['report_val']=$this->mymodel->fetch_misd_0050_data($office_id_to_sum,$tbl_name,$_POST['report_of_year'],$_POST['report_of_month'],$_POST['report_click_btn']);  
                    }
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            $data['report_details']=$this->mymodel->fetch_report_details('MISD-0050');
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1)
            {
                    $pdf_filename='range_wise_new_loan_statement_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';
                    $pdf_content = $this->load->view('report/misd_0050/misd_0050_display_pdf', $data, true);
                    generate_pdf_landscape($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('report/misd_0050/misd_0050_display');  
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
            redirect(base_url().'index.php/report/misd_0050index.php','refresh');
        }
        
    }
    //report misd_0050 end

    
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