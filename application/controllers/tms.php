<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tms extends CI_Controller {

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
		$data['module_name']='Target Monitoring System '; 
		
        //quick link
        $this->session->set_userdata('quick_link','3');
		
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}
	
	
	function tms_target_entry()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('mymodel');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('target_year','Year Of Target', 'required');
        $this->form_validation->set_rules('target_branch','Branch Of Target', 'required');
        $this->form_validation->set_rules('amount[]', 'All amount', 'required|numeric');
        
        //fetch required data end
       	if ($this->form_validation->run() == true)
		{    
		
            $status=$this->mymodel->save_tms_target_data();
            if($status=='success')
            {
               $this->session->set_flashdata('success','Target have beed saved successfully');
	  		   redirect('tms/tms_target_entry','refresh');
            }
            else
            {
               if($status=='notice')
               {
                 $this->session->set_flashdata('notice','Target already exists for selected years and selected branch. You can edit from EDIT module.');
               }
               else
               {
                  $this->session->set_flashdata('error','Target have not beed saved');
               }
               
	  		   redirect('tms/tms_target_entry','refresh'); 
            }
		}
      	else
       {
            $data['own_br_arr']=$this->mymodel->get_target_entry_deatails();
            $data['enable_status']=0;
            if(!empty($data['own_br_arr']))
            {
              $data['enable_status']=1; 
            }
            
            //fetch required data start
            if($query1 = $this->mymodel->get_tms_option())
    		{
    			$data['records2'] = $query1;
    		}
    		if($query3 = $this->mymodel->get_tms_year())
    		{
    			$data['records3'] = $query3;
    		}
    		if($query = $this->mymodel->get_tms_group())
    		{
    			$data['records1'] = $query;
    		}
            
            $data['content']=('tms/tms_set_target_view');
            $data['uid']= $this->session->userdata('some_name1');
            $data['txt_office_name']= $this->session->userdata('some_name2');
            $data['dat_entry_date']= $this->session->userdata('some_name3');
            $data['logout']='home/logout';
            $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
            $this->load->view('home',$data);
    	}  
	}
    
    public function tms_report()
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
        
        
  		if($query3 = $this->mymodel->get_tms_year(0))
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('tms/tms_report_view');
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
            $response .='<td COLSPAN="2"><h6 style="color: olive;">';
            foreach($br_ao_do_array as $key=>$val)
            {
                if($_POST['br_ao_do']==6)
                {
                  $response .='<input type="radio" id="br_ao_do" name="tms_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
                }
                else
                {
                 $response .='<input type="radio" id="br_ao_do" name="tms_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'<br/>';   
                }
            }
            $response .='</td>';
          }  
        }
        
        echo $response;
        
        
        exit();
    }
    
    
    function tms_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['tms_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['tms_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare option
            if($_POST['report_click_btn']==1)//view report
            {
                if($query1 = $this->mymodel->get_tms_option())
        		{
        			$data['records2'] = $query1;
        		}
        		if($query = $this->mymodel->get_tms_group())
        		{
        			$data['records1'] = $query;
        		}
              $data['records3']=$this->mymodel->fetch_tms_data_details($branch_id_array_for_report,$_POST['report_of_year']);
              $data['completed_vs_total']=$this->mymodel->fetch_tms_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_year']);  
            }
            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              $result_array_temp=$this->mymodel->fetch_tms_missing_completed($branch_id_array_for_report,$_POST['report_of_year']);
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            
            
            if($download==1)
            {
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='tms_report_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                  $pdf_content = $this->load->view('tms/tms_report_display_pdf', $data, true);  
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                   if($_POST['report_click_btn']==2){$pdf_filename='tms_missing_list_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';}
                   if($_POST['report_click_btn']==3){$pdf_filename='tms_completed_list_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';}
                   $pdf_content = $this->load->view('tms/tms_missing_completed_display_pdf', $data, true); 
                }
                generate_pdf($pdf_content, $pdf_filename,true);
            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('tms/tms_report_display');   
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('tms/tms_missing_completed_display'); 
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
            redirect(base_url().'index.php/tms/tms_reportindex.php','refresh');
        }
        
    }
    
    
    //edit target
   	function tms_target_edit()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('mymodel');
        
        $data['own_br_arr']=$this->mymodel->get_target_entry_deatails();
        $data['enable_status']=0;
        if(!empty($data['own_br_arr']))
        {
          $data['enable_status']=1; 
        }
        
        //fetch required data start
		if($query3 = $this->mymodel->get_tms_year(0))
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('tms/tms_data_edit_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    
   	function tms_target_edit_save()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('mymodel');
        
        if(isset($_POST['selected_year']) && $_POST['selected_year'] !='' && isset($_POST['selected_branch']) && $_POST['selected_branch'] !='')
        {
            $data['own_br_arr']=$this->mymodel->get_target_entry_deatails();
            $data['enable_status']=0;
            if(!empty($data['own_br_arr']))
            {
              $data['enable_status']=1; 
            }
            
            //fetch required data start
            if($query1 = $this->mymodel->get_tms_option())
    		{
    			$data['records2'] = $query1;
    		}
    		if($query3 = $this->mymodel->get_tms_year(0))
    		{
    			$data['records3'] = $query3;
    		}
    		if($query = $this->mymodel->get_tms_group())
    		{
    			$data['records1'] = $query;
    		}
    		$data['rec']=array();			
            if($query4 = $this->mymodel->get_branch_tms_report($_POST['selected_branch'],$_POST['selected_year']))
			{
				$data['rec'] = $query4;
			}
            
            if(empty($data['rec']))
            {
                $this->session->set_flashdata('error','No target found for branch- '.$_POST['selected_branch'].' of year-'.$_POST['selected_year']);       
        	  	redirect('tms/tms_target_edit','refresh');  
            }
            else
            {
                $data['target_year']=$_POST['selected_year'];
                $data['target_branch']=$_POST['selected_branch'];
                $data['content']=('tms/tms_data_edit_view_with_data');
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
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('target_year','Year Of Target', 'required');
            $this->form_validation->set_rules('target_branch','Branch Of Target', 'required');
            $this->form_validation->set_rules('amount[]', 'All amount', 'required|numeric');
            
           	if ($this->form_validation->run() == true)
    		{    
    		
                $status=$this->mymodel->save_tms_target_edit_info($_POST['target_branch']);
                if($status=='success')
                {
                   $this->session->set_flashdata('success','Target have beed edited successfully');
    	  		   redirect('tms/tms_target_edit','refresh');
                }
                else
                {
                    $this->session->set_flashdata('error','Target have not beed edited');
                   
    	  		   redirect('tms/tms_target_edit','refresh'); 
                }
    		}
          	else
           {
                $data['own_br_arr']=$this->mymodel->get_target_entry_deatails();
                $data['enable_status']=0;
                if(!empty($data['own_br_arr']))
                {
                  $data['enable_status']=1; 
                }
                
                //fetch required data start
                if($query1 = $this->mymodel->get_tms_option())
        		{
        			$data['records2'] = $query1;
        		}
        		if($query3 = $this->mymodel->get_tms_year(0))
        		{
        			$data['records3'] = $query3;
        		}
        		if($query = $this->mymodel->get_tms_group())
        		{
        			$data['records1'] = $query;
        		}
                
        		$data['rec']=array();			
                if($query4 = $this->mymodel->get_branch_tms_report($_POST['target_branch'],$_POST['target_year']))
    			{
    				$data['rec'] = $query4;
    			}
                
                $data['target_year']=$_POST['target_year'];
                $data['content']=('tms/tms_data_edit_view_with_data');
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
        	}
        }
	}
	
	
	
 //agg report start 
    public function agg_tms_report()
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
        
        
  		if($query3 = $this->mymodel->get_tms_year(0))
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('tms/agg_tms_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function agg_tms_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['tms_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['tms_report_office_id']; 
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
                      $data['result_array'][$key]['report_val']=$this->mymodel->fetch_target($office_id_to_sum,$_POST['report_of_year']);  
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
            
            $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
            $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
            if ($pos1 === false && $pos2 ===false)
            {
                $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
                $data['command_office']=$this->mymodel->fetch_command_office($report_of_office_id,$_POST['report_option_selector'],$pos);
            }
            
            if($download==1 || $_POST['report_click_btn']==2)
            {
                $pdf_filename='agg_tms_report_'.$report_of_office_id.'_'.$_POST['report_of_year'].'.pdf';
                $pdf_content = $this->load->view('tms/agg_tms_report_display_pdf', $data, true);
                generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('tms/agg_tms_report_display');      
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
            redirect(base_url().'index.php/tms/agg_tms_reportindex.php','refresh');
        }
        
    }
    //agg report end
    
    
    //TMS END
        
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