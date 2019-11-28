<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rba extends CI_Controller {
    function __construct()
	{
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
			$this->session->set_userdata('menu_access_id', $id);
		}
		$this->load->model('lmsmodel');
		$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$id.' order by cMnu_ID');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['uid']= $this->session->userdata('some_name1');
		$data['module_name']='Risk Based Audit';
		$this->session->set_userdata('quick_link', '25');
		$data['content']='home/logout';
		$this->load->view('HomeRba',$data);
	 }		
 	
function rba_report_0001()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('rbamodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    if(isset($office_id) && $office_id>0)
    {
        $data['login_office_status']=$this->rbamodel->get_login_office_status($office_id);   
    }
    else
    {
        $data['login_office_status']=$this->rbamodel->get_login_office_status(0);
    }
	
	$data['content']=('rba/rba_report/rba_0001/rba_0001_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	//$data['logout']='home/logout';
	//$data['menuArray']= $this->rbamodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('HomeRba',$data);
}

function rba_0001_report_details($download=0)
{
    if ($this->session->userdata('some_name1')=='')
    {
            redirect(base_url(),'refresh');
    }

    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
    {   
        $this->load->model('mymodel');
        $report_of_office_id = $this->session->userdata('some_office');
        
        if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
        {
            $report_of_office_id=$_POST['report_report_office_id']; 
        }
        
        $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
        
        $this->load->model('rbamodel');
        $data['result_array']=array();
        $year1 ='';$year2='';
        $mon1=''; $mon2='';
        if($_POST['report_of_year1']>$_POST['report_of_year2']){
            $year1 = $_POST['report_of_year2'];
            $year2 = $_POST['report_of_year1'];

            $mon1 = $_POST['report_of_month2'];
            $mon2 = $_POST['report_of_month1'];
        }else{
            $year1 = $_POST['report_of_year1'];
            $year2 = $_POST['report_of_year2'];

            $mon1 = $_POST['report_of_month1'];
            $mon2 = $_POST['report_of_month2'];
        }
        // if($_POST['report_of_month1']>$_POST['report_of_month2']){
        //     $mon1 = $_POST['report_of_month2'];
        //     $mon2 = $_POST['report_of_month1'];
        // }else{
        //     $mon1 = $_POST['report_of_month1'];
        //     $mon2 = $_POST['report_of_month2'];
        // }

        // $tbl_name='DSA'.$mon2.$year2;
        // $preDsa = 'DSA'.$month1.$year1;
        // $nextDsa = 'DSA'.$month2.$year2;

        // $pre_omis = 'omis_data_'.$year1.'_'.$month1;
        // $next_omis = 'omis_data_'.$year2.'_'.$month2;

        // $Q =  $this->db->query("SELECT name FROM sys.views where name='$tbl_name' ");
        // if($Q->num_rows()>0)
        // {
        //     echo "Yes";
        // }
        // die();


        if($_POST['report_click_btn']>0)
        {
            $data['result_array']['part_a_a_info'] = $this->rbamodel->fetch_part_a_a_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_a_b_info'] = $this->rbamodel->fetch_part_a_b_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_a_c_info'] = $this->rbamodel->fetch_part_a_c_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_a_d_info'] = $this->rbamodel->fetch_part_a_d_data($report_of_office_id, $mon1, $year1, $mon2, $year2);              
            $data['result_array']['part_a_e_info'] = $this->rbamodel->fetch_part_a_e_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_a_f_info'] = $this->rbamodel->fetch_part_a_f_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_a_g_info'] = $this->rbamodel->fetch_part_a_g_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_a_h_info'] = $this->rbamodel->fetch_part_a_h_data($report_of_office_id, $mon1, $year1, $mon2, $year2);

            $data['result_array']['part_b_a_info'] = $this->rbamodel->fetch_part_b_a_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_b_b_info'] = $this->rbamodel->fetch_part_b_b_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_b_c_info'] = $this->rbamodel->fetch_part_b_c_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_b_d_info'] = $this->rbamodel->fetch_part_b_d_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_b_e_info'] = $this->rbamodel->fetch_part_b_e_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
            $data['result_array']['part_b_f_info'] = $this->rbamodel->fetch_part_b_f_data($report_of_office_id, $mon1, $year1, $mon2, $year2);
        }

        if(!empty($_POST))
        {
            foreach($_POST as $key=>$val)
            {
                $data['previous_value'][$key]=$val;
            }
        }
        $data['report_click_btn'] = $_POST['report_click_btn']; 
        $data['report_of_month1'] = $mon1;
        $data['report_of_year1'] = $year1;
		$data['report_of_month2'] = $mon2;
        $data['report_of_year2'] = $year2;
        $data['report_of_office'] = $this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
        $data['report_details'] = $this->mymodel->fetch_report_details('RBA-0001');
               
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
            $pdf_content = $this->load->view('rba/rba_report/rba_0001/lms_0001_display_pdf', $data, true);
            generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
        }
        else
        {
            $data['content']=('rba/rba_report/rba_0001/rba_0001_display');      
            $data['uid']= $this->session->userdata('some_name1');
            $data['txt_office_name']= $this->session->userdata('some_name2');
            $data['dat_entry_date']= $this->session->userdata('some_name3');
            $data['logout']='home/logout';
            $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
            $this->load->view('HomeRba',$data); 
        }
    }
    else
    {
        $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
        redirect(base_url().'index.php/lms/lms_0001index.php','refresh');
    }
    
}
//report rba_0001 end

//fetch_br_ao_do_rba_report
function fetch_br_ao_do_rba_report()
{
    $response='';
    if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='' && isset($_POST['office_status']) && $_POST['office_status'] !='')
    {
        $this->load->model('lmsmodel');
        $br_ao_do_array=$this->lmsmodel->fetch_br_ao_do_lms($_POST['br_ao_do'], $_POST['br_ao_do_str'], $_POST['off_id'], $_POST['office_status']);
        
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
        $response .='<td COLSPAN="8">';
        foreach($br_ao_do_array as $key=>$val)
        {
            if($_POST['br_ao_do']==6)
            {
                $response .='<h6 style="color: olive;"><input type="radio" id="br_ao_do" name="report_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
            }
            else
            {
                $response .='<h6 style="color: olive;"><input type="radio" id="br_ao_do" name="report_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'</h6><br/>';   
            }
        }
        $response .='</td>';
        }  
    }
    
    echo $response;
    exit();
}
 /**
 * Lms Report end 
 * */
/*----------------Basic function start-------------------------*/
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
/*----------------Basic function end-------------------------*/
}