<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lms extends CI_Controller {
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
        
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        $data['pfo'] = $this->session->userdata('some_uid');    
        $this->lmsmodel->lms_office_location($data['off_id'], $data['pfo']);

        //$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$id);
        $data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$id.' order by cMnu_ID');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['uid']= $this->session->userdata('some_name1');
        $data['module_name']='Lawsuit Information Management System';
        $this->session->set_userdata('quick_link', '20');
        $data['content']='home/logout';
        $this->load->view('homeLms',$data);
	 }		
function lms_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
	
	$data['content']=('lms/lms_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('homeLms',$data);
}	 	

// function lms_basic_entry_view()
// {
// 	if ($this->session->userdata('some_name1')=='')
// 	{
// 		redirect(base_url(),'refresh');
// 	}
// 	$this->load->model('lmsmodel');
// 	$data['off_id'] = $office_id = $this->session->userdata('some_office');
// 	$data['pfo'] = $this->session->userdata('some_uid');
//     $login_status = $this->lmsmodel->get_login_office_status($office_id);
//     $data['login_status'] = $login_status;

//     $data['lms_district'] = '';
//     if($q_lms_district = $this->lmsmodel->lms_district_data())
//     {
//         $data['lms_district'] = $q_lms_district;
//     }
//     $data['lms_thana'] = '';
//     if($q_lms_thana = $this->lmsmodel->lms_thana_data())
//     {
//         $data['lms_thana'] = $q_lms_thana;
//     }
    
//     if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
//     {
//         $data['lms_court_locs'] = $q_lms_court_loc;
//     }
//     if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
//     {
//         $data['lms_lawer_infos'] = $q_lms_lawyer;
//     }
//     if($q_lms_getTranNo = $this->lmsmodel->lms_lb_tran_no_generate($data['off_id']))
//     {
//         $data['lb_tran_no_generate'] = $q_lms_getTranNo;
//     }
    
//     $data['lmscourts'] = '';
//     if($lmscourts = $this->lmsmodel->lms_court_type_data1())
//     {
//         $data['lmscourts'] = $lmscourts;
//     }
//     $data['lmscasecategories'] = '';
//     if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
//     {
//         $data['lmscasecategories'] = $lmscasecategories;
//     }
//     $data['subject_issue'] = '';
//     if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
//     {
//         $data['subjectissue'] = $subject_issue;
//     }

//     $data['categorytest'] = '';
//     if($categorytest = $this->lmsmodel->lms_case_category_data_test())
//     {
//         $data['categorytest'] = $categorytest;
//     }

// 	$data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form');
// 	$data['uid']= $this->session->userdata('some_name1');
// 	$data['txt_office_name']= $this->session->userdata('some_name2');
// 	$data['dat_entry_date']= $this->session->userdata('some_name3');
// 	$data['logout']='home/logout';
// 	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
// 	$this->load->view('homeLms',$data);
// }	 	

function lms_basic_entry_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $login_status = $this->lmsmodel->get_login_office_status($office_id);
    $data['login_status'] = $login_status;


	$data['content']=('lms/lms_basic_entry_view/lms_basic_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}	 	

function lms_basic_entry_maker()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $login_status = $this->lmsmodel->get_login_office_status($office_id);
    $data['login_status'] = $login_status;

    $data['lms_district'] = '';
    if($q_lms_district = $this->lmsmodel->lms_district_data())
    {
        $data['lms_district'] = $q_lms_district;
    }
    $data['lms_thana'] = '';
    if($q_lms_thana = $this->lmsmodel->lms_thana_data())
    {
        $data['lms_thana'] = $q_lms_thana;
    }
    
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    if($q_lms_getTranNo = $this->lmsmodel->lms_lb_tran_no_generate($data['off_id']))
    {
        $data['lb_tran_no_generate'] = $q_lms_getTranNo;
    }
    
    $data['lmscourts'] = '';
    if($lmscourts = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lmscourts'] = $lmscourts;
    }
    $data['lmscasecategories'] = '';
    if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
    {
        $data['lmscasecategories'] = $lmscasecategories;
    }
    $data['subject_issue'] = '';
    if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
    {
        $data['subjectissue'] = $subject_issue;
    }

    $data['categorytest'] = '';
    if($categorytest = $this->lmsmodel->lms_case_category_data_test())
    {
        $data['categorytest'] = $categorytest;
    }

	$data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form_mker');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}	 	

function lms_basic_entry_maker_previous()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $login_status = $this->lmsmodel->get_login_office_status($office_id);
    $data['login_status'] = $login_status;

    $data['lms_district'] = '';
    if($q_lms_district = $this->lmsmodel->lms_district_data())
    {
        $data['lms_district'] = $q_lms_district;
    }
    $data['lms_thana'] = '';
    if($q_lms_thana = $this->lmsmodel->lms_thana_data())
    {
        $data['lms_thana'] = $q_lms_thana;
    }
    
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    if($q_lms_getTranNo = $this->lmsmodel->lms_lb_tran_no_generate($data['off_id']))
    {
        $data['lb_tran_no_generate'] = $q_lms_getTranNo;
    }
    
    $data['lmscourts'] = '';
    if($lmscourts = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lmscourts'] = $lmscourts;
    }
    $data['lmscasecategories'] = '';
    if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
    {
        $data['lmscasecategories'] = $lmscasecategories;
    }
    $data['subject_issue'] = '';
    if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
    {
        $data['subjectissue'] = $subject_issue;
    }

    $data['categorytest'] = '';
    if($categorytest = $this->lmsmodel->lms_case_category_data_test())
    {
        $data['categorytest'] = $categorytest;
    }

    /** preview start */
    $data['districtN'] = $this->input->post('districtN');
    $data['thanaN'] = $this->input->post('thanaN');
    
        $data['trackingNo'] = $this->input->post('tranNoN');
        $data['court_type'] = $this->input->post('courtTypeN');
        $data['category_id'] = $this->input->post('caseCategoryN');
        $data['caseNoN'] = $this->input->post('caseNoN');
        $data['caseFileStatusN'] = $this->input->post('caseFileStatusN');
        $data['filingDateN'] = $this->input->post('filingDateN');
        $data['locationOfCourtN'] = $this->input->post('locationOfCourtN');
        $data['sensitivityN'] = $this->input->post('sensitivityN');
        $data['suitValueAmtN'] = $this->input->post('suitValueAmtN');
        $data['recoAmtN'] = $this->input->post('recoAmtN');
        $data['outstandingN'] = $this->input->post('outstandingN');
        $data['loanACNoN'] = $this->input->post('loanACNoN');
        $data['loanACNameN'] = $this->input->post('loanACNameN');
        $data['bMobileNoN'] = $this->input->post('bMobileNoN');
        $data['bNIDN'] = $this->input->post('bNIDN');

        $data['ACHolderAddN'] = $this->input->post('ACHolderAddN');
        $data['trackingTranNoN'] = $this->input->post('trackingTranNoN');
        $data['unClassduewritN'] = $this->input->post('unClassduewritN');
        $data['subjectIssueN'] = $this->input->post('subjectIssueN');
        $data['subjectFactChoose'] = $this->input->post('subjectFactChoose');
        $data['plComPetNameN'] = $this->input->post('plComPetNameN');
        $data['defAccResNameN'] = $this->input->post('defAccResNameN');
        $data['primarysecSanN'] = $this->input->post('primarysecSanN');
        $data['primarysecSTN'] = $this->input->post('primarysecSTN');
        $data['primarysecPN'] = $this->input->post('primarysecPN');
        $data['collSecSanN'] = $this->input->post('collSecSanN');
        $data['collSecSTN'] = $this->input->post('collSecSTN');
        $data['collSecPN'] = $this->input->post('collSecPN');
        $data['descCollSecN'] = $this->input->post('descCollSecN');
        $data['remarksN'] = $this->input->post('remarksN');
        $data['fileMaintOffBIDN'] = $this->input->post('fileMaintOffBIDN');
        
        $lawerDb = ' '; 
        $data['lawerDb'] = $this->input->post('lawyerInfoNW');;
        $data['some_office'] = $this->input->post('some_office');
        $data['report_report_office_id'] = $this->input->post('report_report_office_id');

	$data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form_previous_mker');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}	 	

function lms_basic_entry_mker_preview_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $login_status = $this->lmsmodel->get_login_office_status($office_id);
    $data['login_status'] = $login_status;

    $data['lms_district'] = '';
    if($q_lms_district = $this->lmsmodel->lms_district_data())
    {
        $data['lms_district'] = $q_lms_district;
    }
    $data['lms_thana'] = '';
    if($q_lms_thana = $this->lmsmodel->lms_thana_data())
    {
        $data['lms_thana'] = $q_lms_thana;
    }
    
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    if($q_lms_getTranNo = $this->lmsmodel->lms_lb_tran_no_generate($data['off_id']))
    {
        $data['lb_tran_no_generate'] = $q_lms_getTranNo;
    }
    
    $data['lmscourts'] = '';
    if($lmscourts = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lmscourts'] = $lmscourts;
    }
    $data['lmscasecategories'] = '';
    if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
    {
        $data['lmscasecategories'] = $lmscasecategories;
    }
    $data['subject_issue'] = '';
    if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
    {
        $data['subjectissue'] = $subject_issue;
    }

    $data['categorytest'] = '';
    if($categorytest = $this->lmsmodel->lms_case_category_data_test())
    {
        $data['categorytest'] = $categorytest;
    }

    /** preview start */
    $data['districtN'] = $this->input->post('districtN');
    $data['thanaN'] = $this->input->post('thanaN');
    
    
    $data['trackingNo'] = $this->input->post('tranNoN');
        $data['court_type'] = $this->input->post('courtTypeN');
        $data['category_id'] = $this->input->post('caseCategoryN');
        $data['caseNoN'] = $this->input->post('caseNoN');
        $data['caseFileStatusN'] = $this->input->post('caseFileStatusN');
        $data['filingDateN'] = $this->input->post('filingDateN');
        $data['locationOfCourtN'] = $this->input->post('locationOfCourtN');
        $data['sensitivityN'] = $this->input->post('sensitivityN');
        $data['suitValueAmtN'] = $this->input->post('suitValueAmtN');
        $data['recoAmtN'] = $this->input->post('recoAmtN');
        $data['outstandingN'] = $this->input->post('outstandingN');
        $data['loanACNoN'] = $this->input->post('loanACNoN');
        $data['loanACNameN'] = $this->input->post('loanACNameN');
        $data['bMobileNoN'] = $this->input->post('bMobileNoN');
        $data['bNIDN'] = $this->input->post('bNIDN');

        $data['ACHolderAddN'] = $this->input->post('ACHolderAddN');
        $data['trackingTranNoN'] = $this->input->post('trackingTranNoN');
        $data['unClassduewritN'] = $this->input->post('unClassduewritN');
        $data['subjectIssueN'] = $this->input->post('subjectIssueN');
        $data['subjectFactChoose'] = $this->input->post('subjectFactChoose');
        $data['plComPetNameN'] = $this->input->post('plComPetNameN');
        $data['defAccResNameN'] = $this->input->post('defAccResNameN');
        $data['primarysecSanN'] = $this->input->post('primarysecSanN');
        $data['primarysecSTN'] = $this->input->post('primarysecSTN');
        $data['primarysecPN'] = $this->input->post('primarysecPN');
        $data['collSecSanN'] = $this->input->post('collSecSanN');
        $data['collSecSTN'] = $this->input->post('collSecSTN');
        $data['collSecPN'] = $this->input->post('collSecPN');
        $data['descCollSecN'] = $this->input->post('descCollSecN');
        $data['remarksN'] = $this->input->post('remarksN');
        $data['fileMaintOffBIDN'] = $this->input->post('fileMaintOffBIDN');
        
        $lawerDb = ' ';
        if(isset($_POST['lawyerInfoN']) && !is_null($_POST['lawyerInfoN'])){
            $lawerC = count($_POST['lawyerInfoN']);
            for($i=0; $i<$lawerC; $i++){
                if($i==($lawerC-1)){
                    $lawerDb.= $_POST['lawyerInfoN'][$i];  
                }else{
                    $lawerDb.= $_POST['lawyerInfoN'][$i].", ";
                }   
            }
        }
        $data['lawerDb'] = $lawerDb;
        $data['some_office'] = $this->input->post('some_office');
        $data['report_report_office_id'] = $this->input->post('report_report_office_id');

    /**
     *  preview end 
     */

	$data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form_preview_mker');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}	 	

function lms_basic_entry_preview_mker_action(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $tmpBtn = $this->input->post('mkerPrvBtn');
    
    if(isset($tmpBtn) && $tmpBtn == 'Previous'){
        $this->lms_basic_entry_maker_previous();
    }else{
        if(isset($tmpBtn) && $tmpBtn == 'Save'){
            $this->lms_basic_entry_mker_prv_details_save();
        }
    }
}

function lms_basic_entry_mker_prv_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->library('session'); 
    $this->load->helper('url'); 

    $this->load->model('lmsmodel');
    if($this->lmsmodel->lms_basic_mker_prv_info_save()){
        $saveTranNoMker = $this->input->post('tranNoN');
        $this->session->set_flashdata('succlmsbasicMkerInfo', $saveTranNoMker); 
    }
    redirect('lms/lms_basic_entry_maker');
}

function lms_basic_entry_checker_view($tranId='')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    $data['lmschkerData'] = '';
    if($lmschkerData = $this->lmsmodel->lms_basic_checker_view($tranId))
    {
        $data['lmschkerData'] = $lmschkerData;
    }

    $data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form_preview_checker');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_basic_entry_checker_view_details($tranId='')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
    $this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $login_status = $this->lmsmodel->get_login_office_status($office_id);
    $data['login_status'] = $login_status;
  
    $data['lmscourts'] = '';
    if($lmscourts = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lmscourts'] = $lmscourts;
    }
    $data['lmscasecategories'] = '';
    if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
    {
        $data['lmscasecategories'] = $lmscasecategories;
    }
    $data['subject_issue'] = '';
    if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
    {
        $data['subjectissue'] = $subject_issue;
    }

    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    
    $data['categorytest'] = '';
    if($categorytest = $this->lmsmodel->lms_case_category_data_test())
    {
        $data['categorytest'] = $categorytest;
    }

    $data['lmschkerData'] = '';
    if($lmschkerData = $this->lmsmodel->lms_basic_checker_view_details($tranId))
    {
        $data['lmschkerData'] = $lmschkerData;
    }

    $data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form_preview_checker_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}


function lms_basic_entry_preview_checker_action(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $tmpBtnC = $this->input->post('ChkerprvBtn');
    
    if(isset($tmpBtnC) && $tmpBtnC == 'Edit'){
        $this->lms_basic_entry_checker_previous();
    }else{
        if(isset($tmpBtnC) && $tmpBtnC == 'Save'){
            $this->lms_basic_entry_chker_prv_details_save();
        }
    }
}

function lms_basic_entry_checker_previous()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $login_status = $this->lmsmodel->get_login_office_status($office_id);
    $data['login_status'] = $login_status;

    $data['lms_district'] = '';
    if($q_lms_district = $this->lmsmodel->lms_district_data())
    {
        $data['lms_district'] = $q_lms_district;
    }
    $data['lms_thana'] = '';
    if($q_lms_thana = $this->lmsmodel->lms_thana_data())
    {
        $data['lms_thana'] = $q_lms_thana;
    }
    
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    if($q_lms_getTranNo = $this->lmsmodel->lms_lb_tran_no_generate($data['off_id']))
    {
        $data['lb_tran_no_generate'] = $q_lms_getTranNo;
    }
    
    $data['lmscourts'] = '';
    if($lmscourts = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lmscourts'] = $lmscourts;
    }
    $data['lmscasecategories'] = '';
    if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
    {
        $data['lmscasecategories'] = $lmscasecategories;
    }
    $data['subject_issue'] = '';
    if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
    {
        $data['subjectissue'] = $subject_issue;
    }

    $data['categorytest'] = '';
    if($categorytest = $this->lmsmodel->lms_case_category_data_test())
    {
        $data['categorytest'] = $categorytest;
    }

    /** preview start */

        $data['trackingNo'] = $this->input->post('tranNoN');
        $data['court_type'] = $this->input->post('courtTypeN');
        $data['category_id'] = $this->input->post('caseCategoryN');
        $data['caseNoN'] = $this->input->post('caseNoN');
        
        $data['caseFileStatusN'] = $this->input->post('caseFileStatusN');
        $data['filingDateN'] = $this->input->post('filingDateN');
        $data['locationOfCourtN'] = $this->input->post('locationOfCourtN');
        $data['sensitivityN'] = $this->input->post('sensitivityN');
        $data['suitValueAmtN'] = $this->input->post('suitValueAmtN');
        $data['recoAmtN'] = $this->input->post('recoAmtN');
        $data['outstandingN'] = $this->input->post('outstandingN');
        $data['loanACNoN'] = $this->input->post('loanACNoN');
        $data['loanACNameN'] = $this->input->post('loanACNameN');
        $data['bMobileNoN'] = $this->input->post('bMobileNoN');
        $data['bNIDN'] = $this->input->post('bNIDN');

        $data['ACHolderAddN'] = $this->input->post('ACHolderAddN');
        $data['trackingTranNoN'] = $this->input->post('trackingTranNoN');
        $data['unClassduewritN'] = $this->input->post('unClassduewritN');
        $data['subjectIssueN'] = $this->input->post('subjectIssueN');
        $data['subjectFactChoose'] = $this->input->post('subjectFactChoose');
        $data['plComPetNameN'] = $this->input->post('plComPetNameN');
        $data['defAccResNameN'] = $this->input->post('defAccResNameN');
        $data['primarysecSanN'] = $this->input->post('primarysecSanN');
        $data['primarysecSTN'] = $this->input->post('primarysecSTN');
        $data['primarysecPN'] = $this->input->post('primarysecPN');
        $data['collSecSanN'] = $this->input->post('collSecSanN');
        $data['collSecSTN'] = $this->input->post('collSecSTN');
        $data['collSecPN'] = $this->input->post('collSecPN');
        $data['descCollSecN'] = $this->input->post('descCollSecN');
        $data['remarksN'] = $this->input->post('remarksN');
        $data['fileMaintOffBIDN'] = $this->input->post('fileMaintOffBIDN');
        
        //$lawerDb = ' '; 
        $data['lawerDb'] = $this->input->post('lawyerInfoNW');;
        $data['some_office'] = $this->input->post('some_office');
        $data['report_report_office_id'] = $this->input->post('report_report_office_id');

	$data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form_previous_checker');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}	 	

function lms_basic_entry_chker_preview_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $login_status = $this->lmsmodel->get_login_office_status($office_id);
    $data['login_status'] = $login_status;

    $data['lms_district'] = '';
    if($q_lms_district = $this->lmsmodel->lms_district_data())
    {
        $data['lms_district'] = $q_lms_district;
    }
    $data['lms_thana'] = '';
    if($q_lms_thana = $this->lmsmodel->lms_thana_data())
    {
        $data['lms_thana'] = $q_lms_thana;
    }
    
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    if($q_lms_getTranNo = $this->lmsmodel->lms_lb_tran_no_generate($data['off_id']))
    {
        $data['lb_tran_no_generate'] = $q_lms_getTranNo;
    }
    
    $data['lmscourts'] = '';
    if($lmscourts = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lmscourts'] = $lmscourts;
    }
    $data['lmscasecategories'] = '';
    if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
    {
        $data['lmscasecategories'] = $lmscasecategories;
    }
    $data['subject_issue'] = '';
    if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
    {
        $data['subjectissue'] = $subject_issue;
    }

    $data['categorytest'] = '';
    if($categorytest = $this->lmsmodel->lms_case_category_data_test())
    {
        $data['categorytest'] = $categorytest;
    }

    /** preview start */
        $data['trackingNo'] = $this->input->post('tranNoN');
        $data['court_type'] = $this->input->post('courtTypeN');
        $data['category_id'] = $this->input->post('caseCategoryN');
        $data['caseNoN'] = $this->input->post('caseNoN');
        $data['caseFileStatusN'] = $this->input->post('caseFileStatusN');
        $data['filingDateN'] = $this->input->post('filingDateN');
        $data['locationOfCourtN'] = $this->input->post('locationOfCourtN');
        $data['sensitivityN'] = $this->input->post('sensitivityN');
        $data['suitValueAmtN'] = $this->input->post('suitValueAmtN');
        $data['recoAmtN'] = $this->input->post('recoAmtN');
        $data['outstandingN'] = $this->input->post('outstandingN');
        $data['loanACNoN'] = $this->input->post('loanACNoN');
        $data['loanACNameN'] = $this->input->post('loanACNameN');
        $data['bMobileNoN'] = $this->input->post('bMobileNoN');
        $data['bNIDN'] = $this->input->post('bNIDN');

        $data['ACHolderAddN'] = $this->input->post('ACHolderAddN');
        $data['trackingTranNoN'] = $this->input->post('trackingTranNoN');
        $data['unClassduewritN'] = $this->input->post('unClassduewritN');
        $data['subjectIssueN'] = $this->input->post('subjectIssueN');
        $data['subjectFactChoose'] = $this->input->post('subjectFactChoose');
        $data['plComPetNameN'] = $this->input->post('plComPetNameN');
        $data['defAccResNameN'] = $this->input->post('defAccResNameN');
        $data['primarysecSanN'] = $this->input->post('primarysecSanN');
        $data['primarysecSTN'] = $this->input->post('primarysecSTN');
        $data['primarysecPN'] = $this->input->post('primarysecPN');
        $data['collSecSanN'] = $this->input->post('collSecSanN');
        $data['collSecSTN'] = $this->input->post('collSecSTN');
        $data['collSecPN'] = $this->input->post('collSecPN');
        $data['descCollSecN'] = $this->input->post('descCollSecN');
        $data['remarksN'] = $this->input->post('remarksN');
        $data['fileMaintOffBIDN'] = $this->input->post('fileMaintOffBIDN');
        
        $lawerDb = ' ';
        if(isset($_POST['lawyerInfoN']) && !is_null($_POST['lawyerInfoN'])){
            $lawerC = count($_POST['lawyerInfoN']);
            for($i=0; $i<$lawerC; $i++){
                if($i==($lawerC-1)){
                    $lawerDb.= $_POST['lawyerInfoN'][$i];  
                }else{
                    $lawerDb.= $_POST['lawyerInfoN'][$i].", ";
                }   
            }
        }
        $data['lawerDb'] = $lawerDb;
        $data['some_office'] = $this->input->post('some_office');
        $data['report_report_office_id'] = $this->input->post('report_report_office_id');

    /**
     *  preview end 
     */

	$data['content']=('lms/lms_basic_entry_view/lms_basic_entry_form_preview_chker');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_basic_entry_chker_prv_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->library('session'); 
    $this->load->helper('url'); 

    $this->load->model('lmsmodel');
    if($this->lmsmodel->lms_basic_chker_prv_info_save()){
        $saveTranNoMker = $this->input->post('tranNoN');
        $this->session->set_flashdata('succlmsbasicMkerInfo', $saveTranNoMker); 
    }
    redirect('lms/lms_basic_entry_view');
}

// function lms_basic_entry_details_save(){
//     if ($this->session->userdata('some_name1')=='')
// 	{
// 		redirect(base_url(),'refresh');
//     }
//     $this->load->library('session'); 
//     $this->load->helper('url'); 

//     $this->load->model('lmsmodel');
//     if($this->lmsmodel->lms_basic_info_save()){
//         $saveTranNo = $this->input->post('tranNoN');
//         $this->session->set_flashdata('succlmsbasicInfo', $saveTranNo); 
//     }
//     redirect('lms/lms_basic_entry_view');
// }

function lms_basic_edit_view($num=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    
    $data['all_user_total'] = $this->lmsmodel->lms_all_info_edit_view_data(0, 0, 1, $office_id);
    $data['current_page']=($num>0)?$num:'1';
    $data['per_page'] = 10;
       
        if($num>0)
        {
            $num=($num-1)*$data['per_page'];
        }
    //     $data['all_user']=$this->mymodel->fetch_user_history_data($num,$data['per_page'], 0);
           $data['lmseditDatas']=$this->lmsmodel->lms_all_info_edit_view_data($num,$data['per_page'], 0, $data['off_id']);
        
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
            $data['total_page'] = ceil(count($data['all_user_total']) / $data['per_page']);
        }
        else
        {
            $data['show_record_from']=0;
            $data['show_record_to']=0;
            $data['total_page']=0;
        }
    //echo $data['all_user_total'];
    // $data['lmseditDatas'] = '';
    // if($lmseditData = $this->lmsmodel->lms_all_info_edit_view_data($data['off_id']))
    // {
    //     $data['lmseditDatas'] = $lmseditData;
    // }
    
	$data['content']=('lms/lms_basic_entry_view/lms_basic_edit_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}	 	
function lms_basic_single_edit_view($trac_param = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $data['lms_court_types'] = '';
    if($q_lms_court_type = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lms_court_types'] = $q_lms_court_type;
    }
	
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    $caseNoPP = '';
    if(isset($trac_param) && $trac_param == ''){
        $tracPara = $this->input->post('tracNoE');
        $caseNoPP = $this->input->post('caseNoNS');
    }else{
        $tracPara = $trac_param;
    }

    $data['lmsSeditDatas'] = '';
    $lawyerIdArr = array();
    if($lmsSeditData = $this->lmsmodel->lms_single_edit_view_data($tracPara, $data['off_id']))
    {
        $data['lmsSeditDatas'] = $lmsSeditData;
        $lawyerIdArr = explode(',', $lmsSeditData[0]->lb_lawyer_id);
        $data['q_lms_lawyerName'] = $this->lmsmodel->lms_lawer_data($lawyerIdArr);
    }    

	$data['content']=('lms/lms_basic_entry_view/lms_basic_single_edit_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}	 	

function lms_basic_entry_edit_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
    $this->load->model('lmsmodel');
    if($this->lmsmodel->lms_basic_edited_info_save()){
        $this->session->set_flashdata('error_lb_EbasicInfo', 'Succfully Changes Data '); 
    }
    
    redirect('lms/lms_basic_edit_view');
}

function lms_present_posotion_entry_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoNS');
        
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }

    $data['lmsdisDatas'] = '';
    if($lmsdisDatas = $this->lmsmodel->lms_disposal_details_data_has($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmsdisDatas'] = $lmsdisDatas;
    }
    
	$data['content']=('lms/lms_present_position/lms_present_position_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_pp_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    $caseNoPP = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoE');
        $caseNoPP = $this->input->post('caseNoppN');
    }else{
        $tracPara = $tracNo;
    }
    $data['lmsppDatas'] = '';
    if($lmsppDatas = $this->lmsmodel->lms_present_position_data($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsppDatas'] = $lmsppDatas;
    }
    $data['lmsppDatashas'] = '';
    if($lmsppDatashas = $this->lmsmodel->lms_present_position_data_has($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsppDatashas'] = $lmsppDatashas;
    }

    $data['lmscasepps'] = '';
    if($lmscasepps = $this->lmsmodel->lms_case_pp_status_data())
    {
        $data['lmscasepps'] = $lmscasepps;
    }

	$data['content']=('lms/lms_present_position/lms_present_position_details_entry_view ');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_pp_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    
    if($this->lmsmodel->lms_case_pp_info_save()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }   
    redirect('lms/lms_present_posotion_entry_view');
}

function lms_recovery_entry_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoNS');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
    $data['lmsdisDatas'] = '';
    if($lmsdisDatas = $this->lmsmodel->lms_disposal_details_data_has($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmsdisDatas'] = $lmsdisDatas;
    }
	$data['content']=('lms/lms_recovery/lms_recovery_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_recovery_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    $caseNoPP = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoE');
        $caseNoPP = $this->input->post('caseNoppN');
    }else{
        $tracPara = $tracNo;
    }

    $data['lmsRecDatas'] = '';
    if($lmsRecDatas = $this->lmsmodel->lms_recovery_details_data($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsRecDatas'] = $lmsRecDatas;
    }

    $data['lmsRecDatashas'] = '';
    if($lmsRecDatashas = $this->lmsmodel->lms_recovery_details_data_has($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsRecDatashas'] = $lmsRecDatashas;
    }

    $data['lmscomponentsDatas'] = '';
    if($lmscomponentsDatas = $this->lmsmodel->lms_components_data())
    {
        $data['lmscomponentsDatas'] = $lmscomponentsDatas;
    }

	$data['content']=('lms/lms_recovery/lms_recovery_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_recovery_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    if($this->lmsmodel->lms_recovery_details_info_save()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }   
    redirect('lms/lms_recovery_entry_view');
}

function lms_expense_entry_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoNS');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
    

	$data['content']=('lms/lms_expense/lms_expense_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_expense_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
	if($q_lms_exp_type = $this->lmsmodel->lms_expense_type_data())
    {
        $data['lms_exp_types'] = $q_lms_exp_type;
    }

    $caseNoPP = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoE');
        $caseNoPP = $this->input->post('caseNoppN');
    }else{
        $tracPara = $tracNo;
    }

    $data['lmsExpDatas'] = '';
    if($lmsExpDatas = $this->lmsmodel->lms_expense_details_data($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsExpDatas'] = $lmsExpDatas;
    }
    $data['lmsExpDatashas'] = '';
    if($lmsExpDatashas = $this->lmsmodel->lms_expense_details_data_has($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsExpDatashas'] = $lmsExpDatashas;
    }

	$data['content']=('lms/lms_expense/lms_expense_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}
function lms_expense_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    

    if($this->lmsmodel->lms_expense_details_info_save()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }   
    redirect('lms/lms_expense_entry_view');
}

function lms_writeoff_entry_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoNS');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
    $data['lmsdisDatas'] = '';
    if($lmsdisDatas = $this->lmsmodel->lms_disposal_details_data_has($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmsdisDatas'] = $lmsdisDatas;
    }
	$data['content']=('lms/lms_write_off/lms_writeoff_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_writeoff_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    $caseNoPara = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoSN');
        $caseNoPara = $this->input->post('caseNoSN');
    }else{
        $tracPara = $tracNo;
    }

    $data['lmswrittoffDatas'] = '';
    if($lmswrittoffDatas = $this->lmsmodel->lms_writtenOff_details_data($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmswrittoffDatas'] = $lmswrittoffDatas;
    }
    $data['lmswrittoffDatashas'] = '';
    if($lmswrittoffDatashas = $this->lmsmodel->lms_writtenOff_details_data_has($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmswrittoffDatashas'] = $lmswrittoffDatashas;
    }

	$data['content']=('lms/lms_write_off/lms_writeoff_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_writeOff_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    

    if($this->lmsmodel->lms_wrtiteOff_details_info_save()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }   
    redirect('lms/lms_writeoff_entry_view');
}

function lms_disposal_entry_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoNS');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
	
	$data['content']=('lms/lms_disposal/lms_disposal_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_disposal_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
	if($q_lms_dis_nature = $this->lmsmodel->lms_disposal_nature_data())
    {
        $data['lms_dis_natures'] = $q_lms_dis_nature;
    }

    $caseNoPara = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoSN');
        $caseNoPara = $this->input->post('caseNoSN');
    }else{
        $tracPara = $tracNo;
    }
    $data['lmsdisposalDatas'] = '';
    if($lmsdisposalDatas = $this->lmsmodel->lms_disposal_details_data($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsdisposalDatas'] = $lmsdisposalDatas;
    }
    $data['lmsdisposalDatashas'] = '';
    if($lmsdisposalDatashas = $this->lmsmodel->lms_disposal_details_data_has($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsdisposalDatashas'] = $lmsdisposalDatashas;
    }

	$data['content']=('lms/lms_disposal/lms_disposal_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}
function lms_disposal_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($this->lmsmodel->lms_disposal_details_info_save()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }   
    redirect('lms/lms_disposal_entry_view');
}

function lms_os_edit_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoSN');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
	$data['lmscasepps'] = '';
    if($lmscasepps = $this->lmsmodel->lms_case_pp_status_data())
    {
        $data['lmscasepps'] = $lmscasepps;
    }

	$data['content']=('lms/lms_edit/edit_outstadning/lms_os_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_os_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    $tracNoOEN = $this->input->post('tracNoOEN');
    
    $caseNoPara = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoSN');
        $caseNoPara = $this->input->post('caseNoSN');
    }else{
        $tracPara = $tracNo;
    }
    $data['lmsEditOusts'] = '';
    if($lmsEditOust = $this->lmsmodel->lms_edit_outstanding_data($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOusts'] = $lmsEditOust;
    }
    $data['lmsEditOustshas'] = '';
    if($lmsEditOustshas = $this->lmsmodel->lms_edit_outstanding_data_has($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOustshas'] = $lmsEditOustshas;
    }
    $data['lmsEditOustshasBasic'] = '';
    if($lmsEditOustshasBasic = $this->lmsmodel->lms_edit_all_data_has_basic($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOustshasBasic'] = $lmsEditOustshasBasic;
    }

	$data['content']=('lms/lms_edit/edit_outstadning/lms_os_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_os_edit_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    
    if($this->lmsmodel->lms_os_edited_info_save_models()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }
    
    redirect('lms/lms_os_edit_view');
}


/** Sanction start */
function lms_security_edit_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
    
    $this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoSN');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
	$data['lmscasepps'] = '';
    if($lmscasepps = $this->lmsmodel->lms_case_pp_status_data())
    {
        $data['lmscasepps'] = $lmscasepps;
    }

	$data['content']=('lms/lms_edit/edit_security/lms_security_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_security_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    $tracNoOEN = $this->input->post('tracNoOEN');
    
    $caseNoPara = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoSN');
        $caseNoPara = $this->input->post('caseNoSN');
    }else{
        $tracPara = $tracNo;
    }
    $data['lmsEditOusts'] = '';
    if($lmsEditOust = $this->lmsmodel->lms_edit_outstanding_data($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOusts'] = $lmsEditOust;
    }
    $data['lmsEditOustshas'] = '';
    if($lmsEditOustshas = $this->lmsmodel->lms_edit_outstanding_data_has($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOustshas'] = $lmsEditOustshas;
    }
    $data['lmsEditOustshasBasic'] = '';
    if($lmsEditOustshasBasic = $this->lmsmodel->lms_edit_all_data_has_basic($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOustshasBasic'] = $lmsEditOustshasBasic;
    }

	$data['content']=('lms/lms_edit/edit_security/lms_security_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_security_edit_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    
    if($this->lmsmodel->lms_security_edited_info_save_models()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }
    
    redirect('lms/lms_security_edit_view');
}

/**Sanction End */
function lms_lawyer_edit_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoNS');
        
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
    
    
	$data['content']=('lms/lms_edit/edit_lawyer/lms_lawyer_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_lawyer_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    $caseNoPara = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNLE');
        $caseNoPara = $this->input->post('caseNoSN');
    }else{
        $tracPara = $tracNo;
    }
    $data['lmsEditOusts'] = '';
    if($lmsEditOust = $this->lmsmodel->lms_edit_outstanding_data($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOusts'] = $lmsEditOust;
    }
	
	if($q_lms_lawyer = $this->lmsmodel->lms_lawer_data())
    {
        $data['lms_lawer_infos'] = $q_lms_lawyer;
    }
    $data['lmsEditlaws'] = '';
    if($lmsEditlaws = $this->lmsmodel->lms_edit_lawyerinfo_data($tracPara, $data['off_id']))
    {
        $data['lmsEditlaws'] = $lmsEditlaws;
    }
    
    $data['lmsEditlawhasBasic'] = '';
    if($lmsEditlawhasBasic = $this->lmsmodel->lms_edit_all_law_data_has_basic($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditlawhasBasic'] = $lmsEditlawhasBasic;
    }
    $data['lmsEditlawsAll'] = '';
    if($lmsEditlawsAll = $this->lmsmodel->lms_edit_lawyerinfo_data_all($tracPara, $data['off_id']))
    {
        $data['lmsEditlawsAll'] = $lmsEditlawsAll;
    }
    

	$data['content']=('lms/lms_edit/edit_lawyer/lms_lawyer_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_lawyers_edit_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    
    if($this->lmsmodel->lms_lawyers_edited_info_save_model()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }
    
    redirect('lms/lms_lawyer_edit_view');
}

function lms_fkeep_edit_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	// $this->load->model('lmsmodel');
	// $data['off_id'] = $office_id = $this->session->userdata('some_office');
    // $data['pfo'] = $this->session->userdata('some_uid');
    // if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data($data['off_id']))
    // {
    //     $data['lmstracNos'] = $lmstracNos;
    // }
    
    // $tracNo = $this->input->post('tracNoE');
    // $caseNoNS = $this->input->post('caseNoNS');
    
    // $data['lmseditDatas'] = '';
    // if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    // {
    //     $data['lmseditDatas'] = $lmseditData;
    // }
    $this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data_br($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoSN');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
	$data['lmscasepps'] = '';
    if($lmscasepps = $this->lmsmodel->lms_case_pp_status_data())
    {
        $data['lmscasepps'] = $lmscasepps;
    }
	
	$data['content']=('lms/lms_edit/edit_filekeeper/lms_fkeep_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_fkeep_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
    $this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    $tracNoOEN = $this->input->post('tracNoOEN');
    
    $caseNoPara = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoSN');
        $caseNoPara = $this->input->post('caseNoSN');
    }else{
        $tracPara = $tracNo;
    }
    $data['lmsEditOusts'] = '';
    if($lmsEditOust = $this->lmsmodel->lms_edit_outstanding_data($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOusts'] = $lmsEditOust;
    }
    $data['lmsEditOustshas'] = '';
    if($lmsEditOustshas = $this->lmsmodel->lms_edit_outstanding_data_has($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOustshas'] = $lmsEditOustshas;
    }
    $data['lmsEditOustshasBasic'] = '';
    if($lmsEditOustshasBasic = $this->lmsmodel->lms_edit_all_data_has_basic($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsEditOustshasBasic'] = $lmsEditOustshasBasic;
    }
	
	$data['content']=('lms/lms_edit/edit_filekeeper/lms_fkeep_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_pk_edit_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    
    if($this->lmsmodel->lms_pk_edited_info_save_model()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }    
    redirect('lms/lms_fkeep_edit_view');
}

function lms_ct_edit_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data($data['off_id']))
    {
        $data['lmstracNos'] = $lmstracNos;
    }
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }
    $tracNo = $this->input->post('tracNoE');
    $caseNoNS = $this->input->post('caseNoNS');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_edit_view_data($tracNo, $caseNoNS, $data['off_id']))
    {
        $data['lmseditDatas'] = $lmseditData;
    }
	
	$data['content']=('lms/lms_edit/edit_casetype/lms_ct_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_ct_entry_details_view($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
	$caseNoPara = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNLE');
        $caseNoPara = $this->input->post('caseNoSN');
    }else{
        $tracPara = $tracNo;
    }

    $data['lmscasetypeDatas'] = '';
    if($lmscasetypeDatas = $this->lmsmodel->lms_edit_cast_type_data($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmscasetypeDatas'] = $lmscasetypeDatas;
    }
    $data['lmscasetypeDatashas'] = '';
    if($lmscasetypeDatashas = $this->lmsmodel->lms_edit_cast_type_data_has($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmscasetypeDatashas'] = $lmscasetypeDatashas;
    }
    
    $data['lmsallData'] = '';
    if($lmsallData = $this->lmsmodel->lms_edit_all_data_has_basic($tracPara, $caseNoPara, $data['off_id']))
    {
        $data['lmsallData'] = $lmsallData;
    }

	$data['content']=('lms/lms_edit/edit_casetype/lms_ct_details_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_caseType_edit_details_save(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
    }
    $this->load->model('lmsmodel');
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    
    if($this->lmsmodel->lms_caseType_edited_info_save_model()){
        $this->session->set_flashdata('error_lb_osInfo', 'Succfully Changes Data '); 
    }
    
    redirect('lms/lms_ct_edit_view');
}


function lms_user_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');

    if($lmsUser = $this->lmsmodel->lms_user_info_data())
    {
        $data['lmsUser'] = $lmsUser;
    }
    
	$data['content']=('lms/user_info/lms_user_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

/**
 * Lms Report Start 
 * */
//report lms_0001 start 
function lms_0001()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    if(isset($office_id) && $office_id>0)
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status($office_id);   
    }
    else
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status(0);
    }
	
	$data['content']=('lms/lms_report/lms_0001/lms_0001_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_0001_report_details($download=0)
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
            $report_of_office_id = $_POST['report_report_office_id']; 
        }
        
        $this->load->model('lmsmodel');
        $data['result_array'] = $this->lmsmodel->fetch_all_office_array_lms($report_of_office_id, $_POST['report_option_selector']);
        
        if(isset($data['result_array']) && count($data['result_array'])>0)
        {
            foreach($data['result_array'] as $key=>$row)
            {
                $office_id_to_sum = array();
                $report_option_id = $_POST['report_option_selector'];
                $unique_id = $row['office_id'];
                $selector=0;
                if($report_option_id==1)//my office
                {
                $status = $this->mymodel->get_login_office_status($report_of_office_id);
           
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

                $office_id_to_sum = $this->lmsmodel->fetch_branch_array_for_report_module_lms($unique_id, $selector);
                $data['result_array'][$key]['no_of_branch']=count($office_id_to_sum);
                //get data
                $data['result_array'][$key]['report_val'] = $this->lmsmodel->fetch_lms_0001_data($office_id_to_sum, $_POST['report_click_btn'], $_POST['report_of_month'], $_POST['report_of_year']);  
            }
        }
        
        if(!empty($_POST))
        {
            foreach($_POST as $key=>$val)
            {
                $data['previous_value'][$key]=$val;
            }
        }
        $data['report_click_btn'] = $_POST['report_click_btn']; 
        $data['report_of_month'] = $_POST['report_of_month'];
        $data['report_of_year'] = $_POST['report_of_year'];
        $data['report_of_office'] = $this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
        //$data['report_details']=$this->mymodel->fetch_report_details('MISD-0002');
        //$data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
        
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
            $pdf_content = $this->load->view('lms/lms_report/lms_0001/lms_0001_display_pdf', $data, true);
            generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
        }
        else
        {
            $data['content']=('lms/lms_report/lms_0001/lms_0001_display');      
            $data['uid']= $this->session->userdata('some_name1');
            $data['txt_office_name']= $this->session->userdata('some_name2');
            $data['dat_entry_date']= $this->session->userdata('some_name3');
            $data['logout']='home/logout';
            $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
            $this->load->view('homeLms',$data); 
        }
    }
    else
    {
        $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
        redirect(base_url().'index.php/lms/lms_0001index.php','refresh');
    }
    
}
//report lms_0001 end

//report lms_0002 start 
function lms_0002()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    if(isset($office_id) && $office_id>0)
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status($office_id);   
    }
    else
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status(0);
    }
    
    $data['categorytest'] = '';
    if($categorytest = $this->lmsmodel->lms_case_category_data_test())
    {
        $data['categorytest'] = $categorytest;
    }
    
	$data['content']=('lms/lms_report/lms_0002/lms_0002_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_0002_report_details($download=0)
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
        
        $branch_id_array_for_report = $this->mymodel->fetch_branch_array_for_report($report_of_office_id, $_POST['report_option_selector']);
        
        $this->load->model('lmsmodel');
        $data['result_array']=array();
         if($_POST['report_click_btn']>0)
         {
            $data['result_array'] = $this->lmsmodel->fetch_lms_0002_data($branch_id_array_for_report, $_POST['report_click_btn'], $_POST['report_of_month'], $_POST['report_of_year'], $_POST['report_of_case']);

            if(isset($_POST['report_of_case']) && $_POST['report_of_case'] != 0){
                $case_id = $_POST['report_of_case'];
                $data['caseDesc'] = $this->lmsmodel->get_Data_Sql_Str("select lmcc_cc_desc_l3 from [db_mis_LMS].[dbo].[lms_master_case_category_info1] where lmcc_cc_id_l3='$case_id'");
            }
            
            $data['lmsppDatahas'] = '';
            if($lmsppDatahas = $this->lmsmodel->lms_present_position_datas_withBr($branch_id_array_for_report))
            {
                $data['lmsppDatahas'] = $lmsppDatahas;
            }
            $data['lmscourts'] = '';
            if($lmscourts = $this->lmsmodel->lms_court_type_data1())
            {
                $data['lmscourts'] = $lmscourts;
            }
            $data['lmsdisDatas'] = '';
            if($lmsdisDatas = $this->lmsmodel->lms_disposal_details_data_withBr($branch_id_array_for_report))
            {
                $data['lmsdisDatas'] = $lmsdisDatas;
            }
         }
         
        if(!empty($_POST))
        {
            foreach($_POST as $key=>$val)
            {
                $data['previous_value'][$key]=$val;
            }
        }
        $data['report_of_case']=$_POST['report_of_case']; 
        $data['report_click_btn']=$_POST['report_click_btn']; 
        $data['report_of_month']=$_POST['report_of_month'];
        $data['report_of_year']=$_POST['report_of_year'];
        $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
        //$data['report_details']=$this->mymodel->fetch_report_details('MISD-0002');
        //$data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
        
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
            $pdf_content = $this->load->view('lms/lms_report/lms_0002/lms_0002_display_pdf', $data, true);
            generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
        }
        else
        {
            $data['content']=('lms/lms_report/lms_0002/lms_0002_display');      
            $data['uid']= $this->session->userdata('some_name1');
            $data['txt_office_name']= $this->session->userdata('some_name2');
            $data['dat_entry_date']= $this->session->userdata('some_name3');
            $data['logout']='home/logout';
            $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
            $this->load->view('homeLms',$data); 
        }
    }
    else
    {
        $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
        redirect(base_url().'index.php/lms/lms_0002index.php','refresh');
    }
    
}
//report lms_0002 end

//report lms_0003 start 
function lms_0003()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    if(isset($office_id) && $office_id>0)
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status($office_id);   
    }
    else
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status(0);
    }
	
	$data['content']=('lms/lms_report/lms_0003/lms_0003_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_0003_report_view($download=0)
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
    
    $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    $report_of_office_id=$this->session->userdata('some_office');
    
    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0){
        if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
        {
            $report_of_office_id = $_POST['report_report_office_id']; 
        }
        $this->load->model('mymodel');
        if($_POST['report_click_btn']>0)//view report
        {
            $data['report_of_office_id'] = $report_of_office_id;
            $data['report_option_selector'] = $_POST['report_option_selector'];
            $this->load->model('lmsmodel');
            $offstatus = $this->lmsmodel->get_login_office_status($report_of_office_id);
           
            $data['lms_office_status'] = $this->lmsmodel->get_login_office_status($report_of_office_id);
            if($_POST['report_option_selector']==1 && ($offstatus ==1 || $offstatus==4)){
                $branch_id_array_for_report = array(array('jbbrcode'=>$report_of_office_id));
            }else{
                $branch_id_array_for_report = $this->mymodel->fetch_branch_array_for_report($report_of_office_id, $_POST['report_option_selector']);
            }
       
            if($lmstracNos = $this->lmsmodel->lms_tracNo_view_data($branch_id_array_for_report))
            {
                $data['lmstracNos'] = $lmstracNos;
            }
            if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
            {
                $data['lms_court_locs'] = $q_lms_court_loc;
            }
            $tracNo = $this->input->post('tracNoE');
            $caseNoNS = $this->input->post('caseNoNS');
                
            $data['lmseditDatas'] = '';
            if($lmseditData = $this->lmsmodel->lms_single_view_data($tracNo, $caseNoNS, $branch_id_array_for_report))
            {
                $data['lmseditDatas'] = $lmseditData;
            }
            $data['lmsdisDatas'] = '';
            if($lmsdisDatas = $this->lmsmodel->lms_disposal_details_data_has($tracNo, $caseNoNS, 0))
            {
                $data['lmsdisDatas'] = $lmsdisDatas;
            }
        }
    }
    
	$data['content']=('lms/lms_report/lms_0003/lms_0003_display');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}
function lms_0003_report_details($tracNo = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$off_id = $data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    if($q_lms_court_loc = $this->lmsmodel->lms_court_location_data())
    {
        $data['lms_court_locs'] = $q_lms_court_loc;
    }

    $caseNoPP = '';
    if(isset($tracNo) && $tracNo == ''){
        $tracPara = $this->input->post('tracNoE');
        $caseNoPP = $this->input->post('caseNoppN');
    }else{
        $tracPara = $tracNo;
    }
    $ffId=array();
    $offstatus = $this->lmsmodel->get_login_office_status($data['off_id']);
    
    if($offstatus == 1){
        $trIND = $this->lmsmodel->get_Data_Sql_Str("select * 
        from [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_tran_no_other =(select lb_tran_no_other 
        from [db_mis_LMS].[dbo].[lms_basic_details_info] 
        where lb_br_code='$off_id' AND lb_tran_no='$tracPara')");
    }
    if(!empty($trIND)){
        $tracParaLD = $trIND[0]->lb_tran_no_other;
        //$tracParaLD = $trIND[0]->lb_tran_no;
    }else{
        $tracParaLD = $tracPara;
    }
    
    $data['lmssingleDatas'] = '';
    if($lmssingleDatas = $this->lmsmodel->lms_single_view_data($tracParaLD, $caseNoPP, $ffId))
    {
        $data['lmssingleDatas'] = $lmssingleDatas;
    }
    

    $data['lmsOtherDatas'] = '';
    if($lmsOtherDatas = $this->lmsmodel->lms_single_view_other_data($tracParaLD, $caseNoPP, $ffId))
    {
        $data['lmsOtherDatas'] = $lmsOtherDatas;
    }
    
    $data['subject_issue'] = '';
    if($subject_issue = $this->lmsmodel->lms_subject_issue_data())
    {
        $data['subjectissue'] = $subject_issue;
    }

    $searched_trackNo = $this->lmsmodel->lms_search_all_tracking_data($tracPara);

    $data['lmsppDatahas'] = '';
    if($lmsppDatahas = $this->lmsmodel->lms_present_position_datas($searched_trackNo, $caseNoPP, $data['off_id']))
    {
        $data['lmsppDatahas'] = $lmsppDatahas;
    }
    $data['lmsdisDatahas'] = '';
    if($lmsdisDatahas = $this->lmsmodel->lms_disposal_details_checks($searched_trackNo))
    {
        $data['lmsdisDatahas'] = $lmsdisDatahas;
    }

    $data['lmsRecDatashas'] = '';
    if($lmsRecDatashas = $this->lmsmodel->lms_recovery_details_data_has($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsRecDatashas'] = $lmsRecDatashas;
    }
    $data['lmsExpDatashas'] = '';
    if($lmsExpDatashas = $this->lmsmodel->lms_expense_details_data_has($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsExpDatashas'] = $lmsExpDatashas;
    }
    $data['lmswrittoffDatashas'] = '';
    if($lmswrittoffDatashas = $this->lmsmodel->lms_writtenOff_details_data_has($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmswrittoffDatashas'] = $lmswrittoffDatashas;
    }
    $data['lmsdisposalDatashas'] = '';
    if($lmsdisposalDatashas = $this->lmsmodel->lms_disposal_details_data_has($tracPara, $caseNoPP, $data['off_id']))
    {
        $data['lmsdisposalDatashas'] = $lmsdisposalDatashas;
    }
    $off_id = $this->session->userdata('re_off_id');
    $off_selector = $this->session->userdata('re_selector');
    
    $this->load->model('mymodel');
    $data['report_of_office'] = $this->mymodel->fetch_report_of_office($off_id, $off_selector);
    
    if($offstatus == 4 ){
        $data['report_branch'] = $this->lmsmodel->get_Data_Sql_Str("select branchname from [Db_DP_Collection_mgr].[dbo].[allinformation] where brcode='$off_id'");
    }else{
        if(!empty($data['lmssingleDatas'])){
            $report_branchC = $data['lmssingleDatas'][0]->lb_br_code;
            $data['report_branch'] = $this->lmsmodel->get_Data_Sql_Str("select branchname from [Db_DP_Collection_mgr].[dbo].[allinformation] where brcode='$report_branchC'");
        }else{
            $data['report_branch'] = '';
        }
    }
    $pos1 = strpos($data['report_of_office'], 'LOCAL OFFICE');
    $pos2 = strpos($data['report_of_office'], 'JANATA BHABAN CORP');
    if ($pos1 === false && $pos2 ===false)
    {
        $pos = strpos($data['report_of_office'], 'CORP');  //if corporate
        $data['command_office']=$this->mymodel->fetch_command_office($off_id, $off_selector, $pos);
    }

	$data['content']=('lms/lms_report/lms_0003/lms_0003_display_details');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}
//report lms_0003 end

//report lms_0004 start 
function lms_0004()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    if(isset($office_id) && $office_id>0)
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status($office_id);   
    }
    else
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status(0);
    }
	
	$data['content']=('lms/lms_report/lms_0004/lms_0004_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_0004_report_details($download=0)
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
            $report_of_office_id = $_POST['report_report_office_id']; 
        }
        
        $this->load->model('mymodel');
        $report_of_office_id=$this->session->userdata('some_office');
        
        if(isset($_POST['report_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
        {
            $report_of_office_id = $_POST['report_report_office_id']; 
        }
        
        $branch_id_array_for_report = $this->mymodel->fetch_branch_array_for_report($report_of_office_id, $_POST['report_option_selector']);
        $this->load->model('lmsmodel');
        $office_id_to_sum = $this->lmsmodel->fetch_branch_array_for_report_module_lms($report_of_office_id, $_POST['report_option_selector']);
        
        $this->load->model('lmsmodel');
        $data['result_array']=array();
        if($_POST['report_click_btn']>0)
        {
        
            $data['result_array'] = $this->lmsmodel->fetch_lms_0004_data($office_id_to_sum, $_POST['report_click_btn'], $_POST['report_of_month1'], $_POST['report_of_year1'], $_POST['report_of_month2'], $_POST['report_of_year2']);
        
        }
        
        if(!empty($_POST))
        {
            foreach($_POST as $key=>$val)
            {
                $data['previous_value'][$key]=$val;
            }
        }
        $data['report_click_btn'] = $_POST['report_click_btn']; 
        $data['report_of_month1'] = $_POST['report_of_month1'];
        $data['report_of_year1'] = $_POST['report_of_year1'];

        $data['report_of_month2'] = $_POST['report_of_month2'];
        $data['report_of_year2'] = $_POST['report_of_year2'];
        $data['report_of_office'] = $this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
        
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
            $pdf_content = $this->load->view('lms/lms_report/lms_0004/lms_0004_display_pdf', $data, true);
            generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
        }
        else
        {
            $data['content']=('lms/lms_report/lms_0004/lms_0004_display');      
            $data['uid']= $this->session->userdata('some_name1');
            $data['txt_office_name']= $this->session->userdata('some_name2');
            $data['dat_entry_date']= $this->session->userdata('some_name3');
            $data['logout']='home/logout';
            $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
            $this->load->view('homeLms',$data); 
        }
    }
    else
    {
        $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
        redirect(base_url().'index.php/lms/lms_0004index.php','refresh');
    }
    
}
//report lms_0004 end

//report lms_0005 start 
function lms_0005()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    if(isset($office_id) && $office_id>0)
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status($office_id);   
    }
    else
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status(0);
    }
	
	$data['content']=('lms/lms_report/lms_0005/lms_0005_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_0005_report_details($download=0)
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
            $report_of_office_id = $_POST['report_report_office_id']; 
        }
        
        $branch_id_array_for_report = $this->mymodel->fetch_branch_array_for_report($report_of_office_id, $_POST['report_option_selector']);
        

        $this->load->model('lmsmodel');
        $data['result_array']=array();
        if($_POST['report_click_btn']>0)
        {
        
            $data['result_array'] = $this->lmsmodel->fetch_lms_0005_data($branch_id_array_for_report, $_POST['report_click_btn'], $_POST['report_of_month1'], $_POST['report_of_year1'], $_POST['report_of_month2'], $_POST['report_of_year2']);
        
        }
        
        if(!empty($_POST))
        {
            foreach($_POST as $key=>$val)
            {
                $data['previous_value'][$key]=$val;
            }
        }
        $data['report_click_btn'] = $_POST['report_click_btn']; 
        $data['report_of_month1'] = $_POST['report_of_month1'];
        $data['report_of_year1'] = $_POST['report_of_year1'];

        $data['report_of_month2'] = $_POST['report_of_month2'];
        $data['report_of_year2'] = $_POST['report_of_year2'];
        $data['report_of_office'] = $this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
        
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
            $pdf_content = $this->load->view('lms/lms_report/lms_0005/lms_0005_display_pdf', $data, true);
            generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
        }
        else
        {
            $data['content']=('lms/lms_report/lms_0005/lms_0005_display');      
            $data['uid']= $this->session->userdata('some_name1');
            $data['txt_office_name']= $this->session->userdata('some_name2');
            $data['dat_entry_date']= $this->session->userdata('some_name3');
            $data['logout']='home/logout';
            $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
            $this->load->view('homeLms',$data); 
        }
    }
    else
    {
        $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
        redirect(base_url().'index.php/lms/lms_0005index.php','refresh');
    }
    
}
//report lms_0005 end

//report lms_0006 start 
function lms_0006()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    if(isset($office_id) && $office_id>0)
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status($office_id);   
    }
    else
    {
        $data['login_office_status']=$this->lmsmodel->get_login_office_status(0);
    }
	
	$data['content']=('lms/lms_report/lms_0006/lms_0006_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
	$this->load->view('homeLms',$data);
}

function lms_0006_report_details($download=0)
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
            $report_of_office_id = $_POST['report_report_office_id']; 
        }
        
        $this->load->model('lmsmodel');
        $data['result_array'] = $this->lmsmodel->fetch_all_office_array_lms($report_of_office_id, $_POST['report_option_selector']);
        
        if(isset($data['result_array']) && count($data['result_array'])>0)
        {
            foreach($data['result_array'] as $key=>$row)
            {
                $office_id_to_sum = array();
                $report_option_id = $_POST['report_option_selector'];
                $unique_id = $row['office_id'];
                $selector=0;
                if($report_option_id==1)//my office
                {
                $status = $this->mymodel->get_login_office_status($report_of_office_id);
           
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

                $office_id_to_sum = $this->lmsmodel->fetch_branch_array_for_report_module_lms($unique_id, $selector);
                $data['result_array'][$key]['no_of_branch']=count($office_id_to_sum);
                //get data
                $data['result_array'][$key]['report_val'] = $this->lmsmodel->fetch_lms_0006_data($office_id_to_sum, $_POST['report_click_btn'], $_POST['report_of_month'], $_POST['report_of_year']);  
            }
        }
        
        if(!empty($_POST))
        {
            foreach($_POST as $key=>$val)
            {
                $data['previous_value'][$key]=$val;
            }
        }
        $data['report_click_btn'] = $_POST['report_click_btn']; 
        $data['report_of_month'] = $_POST['report_of_month'];
        $data['report_of_year'] = $_POST['report_of_year'];
        $data['report_of_office'] = $this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
        //$data['report_details']=$this->mymodel->fetch_report_details('MISD-0002');
        //$data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
        
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
            $pdf_content = $this->load->view('lms/lms_report/lms_0006/lms_0006_display_pdf', $data, true);
            generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
        }
        else
        {
            $data['content']=('lms/lms_report/lms_0006/lms_0006_display');      
            $data['uid']= $this->session->userdata('some_name1');
            $data['txt_office_name']= $this->session->userdata('some_name2');
            $data['dat_entry_date']= $this->session->userdata('some_name3');
            $data['logout']='home/logout';
            $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get().' order by cMnu_ID');
            $this->load->view('homeLms',$data); 
        }
    }
    else
    {
        $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
        redirect(base_url().'index.php/lms/lms_0006index.php','refresh');
    }
    
}
//report lms_0006 end


function lms_guideline()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
	
	$data['content']=('lms/lms_guideline');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	//$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('homeLms',$data);
}

function lms_contactInfo()
{
	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
	
	$data['content']=('lms/lms_contact_info');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	//$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('homeLms',$data);
}

/*--------------------------------------------------------- sohag ------------------------------------------ */
function lms_master_data()
{  
    	if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
    $data['lms_court_types'] = '';
    if($q_lms_master_data_type = $this->lmsmodel->lms_master_data())
    {
        $data['lms_master_data_view'] = $q_lms_master_data_type;
    }
       
	$data['content']=('lms/lms_master_data_entry/lms_master_data_entry_form');
    
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('homeLms',$data);
  }

  public function master_data_view()
  {
    
    $menu_id=$_GET['p'];
    
    if($menu_id>0)
    {
        $this->load->model('lmsmodel');
    	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    	$data['pfo'] = $this->session->userdata('some_uid');
        $data['lms_expense_type_info'] = '';  
        
        $data['view_info']='';
      
      if($menu_id==6)
      {
        if($view_info= $this->lmsmodel->master_data_view_info($menu_id))
        
          {
            $data['view_info'] = $view_info;
            $data['content']=('lms/lms_master_data_entry/disposal_nature_view');
          }
      
      }
      
      else if($menu_id==5)
      {
        if($view_info= $this->lmsmodel->master_data_view_info($menu_id))
        
          {
            $data['view_info'] = $view_info;
            $data['content']=('lms/lms_master_data_entry/expense_type_view');
          }
      }
      
      else if($menu_id==4)
      {
        if($view_info= $this->lmsmodel->master_data_view_info($menu_id))
        
          {
            $data['view_info'] = $view_info;
            $data['content']=('lms/lms_master_data_entry/current_status_view');
          }
      }
      
      else if($menu_id==3)
      {
        if($view_info= $this->lmsmodel->master_data_view_info($menu_id))
        
          {
            $data['view_info'] = $view_info;
            $data['content']=('lms/lms_master_data_entry/lawer_info_view');
          }
      }
         
     else if($menu_id==2)
      {
        if($view_info= $this->lmsmodel->master_data_view_info($menu_id))
        
          {
            $data['view_info'] = $view_info;
            $data['content']=('lms/lms_master_data_entry/case_cat_view');
          }
      } 
      
      else
      {
        if($view_info= $this->lmsmodel->master_data_view_info($menu_id))
        
          {
            $data['view_info'] = $view_info;
            // echo "<pre>";
            // print_r($data['view_info']);
            $data['content']=('lms/lms_master_data_entry/court_type_view');
          }
      } 
      
    $data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('homeLms',$data);
      
       
            
    }
    
    
    
  }



public function lms_court_type_db_action()
{       
        $response=0;
        if(isset($_POST['action']) && $_POST['action']>0)
        {   
            $this->load->model('lmsmodel');
            $action=$_POST['action'];
            
            //delete action
            if($action==3)
            { 
                $court_id=$_POST['court_id'];
                $response = $this->lmsmodel->lms_court_type_db_delete($court_id);
                
            }
            
            if($action==1)
            { 
                //$court_id=$_POST['court_id'];
              // $court_type_name=$_POST['court_type_name'];
                
                $lmct_l1=$_POST['lmct_l1'];
                $lmct_l2=$_POST['lmct_l2'];
                $lmct_l3=$_POST['lmct_l3'];
                $lmct_desc1=$_POST['lmct_desc1'];
                $lmct_desc2=$_POST['lmct_desc2'];
                $lmct_desc3=$_POST['lmct_desc3'];
                                
                $response = $this->lmsmodel->lms_court_type_db_add($lmct_l1,$lmct_desc1,$lmct_l2,$lmct_desc2,$lmct_l3,$lmct_desc3); 
                
            }
            
            if($action==2)
            { 
                $court_id=$_POST['court_id'];
                                
                $lmct_l1=$_POST['lmct_l1'];
                $lmct_l2=$_POST['lmct_l2'];
                $lmct_l3=$_POST['lmct_l3'];
                $lmct_desc1=$_POST['lmct_desc1'];
                $lmct_desc2=$_POST['lmct_desc2'];
                $lmct_desc3=$_POST['lmct_desc3'];
                
                $response = $this->lmsmodel->lms_court_type_db_update($lmct_l1,$lmct_desc1,$lmct_l2,$lmct_desc2,$lmct_l3,$lmct_desc3,$court_id); 
                
            }
            
        }
        
        echo $response;
        exit();
        
}

function lms_case_cat_db_action()
{
     $response=0;
        if(isset($_POST['action']) && $_POST['action']>0)
        {   
            $this->load->model('lmsmodel');
            $action=$_POST['action'];
            
            //delete action
           
            
            if($action==1)
            { 
                //$court_id=$_POST['court_id'];
              // $court_type_name=$_POST['court_type_name'];
                
                $lmcc_l1=$_POST['lmcc_l1'];
                $lmcc_l2=$_POST['lmcc_l2'];
                $lmcc_l3=$_POST['lmcc_l3'];
                $lmcc_desc1=$_POST['lmcc_desc1'];
                $lmcc_desc2=$_POST['lmcc_desc2'];
                $lmcc_desc3=$_POST['lmcc_desc3'];
                                
                $response = $this->lmsmodel->lms_case_cat_db_add($lmcc_l1,$lmcc_desc1,$lmcc_l2,$lmcc_desc2,$lmcc_l3,$lmcc_desc3); 
                
            }
            
            if($action==2)
            { 
                $case_id=$_POST['case_id'];
                $lmcc_l1=$_POST['lmcc_l1'];
                $lmcc_l2=$_POST['lmcc_l2'];
                $lmcc_l3=$_POST['lmcc_l3'];
                $lmcc_desc1=$_POST['lmcc_desc1'];
                $lmcc_desc2=$_POST['lmcc_desc2'];
                $lmcc_desc3=$_POST['lmcc_desc3'];
                
                $response = $this->lmsmodel->lms_case_cat_db_update($lmcc_l1,$lmcc_desc1,$lmcc_l2,$lmcc_desc2,$lmcc_l3,$lmcc_desc3,$case_id); 
                
            }
            
            
            if($action==3)
            { 
                $cse_id=$_POST['case_id'];
                $response = $this->lmsmodel->lms_case_cat_db_delete($cse_id);
                
            }
            
        }
        
        echo $response;
        exit();
    
}


function lms_lawyer_info_db_action()
{
     $response=0;
        if(isset($_POST['action']) && $_POST['action']>0)
        {   
            $this->load->model('lmsmodel');
            $action=$_POST['action'];
            
            //delete action
           
            
            if($action==1)
            { 
                //$court_id=$_POST['court_id'];
              // $court_type_name=$_POST['court_type_name'];
                
                $lw_id=$_POST['lw_id'];
                $lw_name=$_POST['lw_name'];
                $lw_mob=$_POST['lw_mob'];
                $lw_dist=$_POST['lw_dist'];
                $lw_div=$_POST['lw_div'];
                $lw_pos=$_POST['lw_pos'];
                $lw_pos_id=$_POST['lw_pos_id'];
                
                            
                $response = $this->lmsmodel->lms_lawyer_info_db_add($lw_id,$lw_name,$lw_mob,$lw_dist,$lw_div,$lw_pos,$lw_pos_id); 
                
            }
            
            if($action==2)
            { 

                $lawyer_pev_id=$_POST['lawyer_pev_id'];
                $lw_id=$_POST['lw_id'];
                $lw_name=$_POST['lw_name'];
                $lw_mob=$_POST['lw_mob'];
                $lw_dist=$_POST['lw_dist'];
                $lw_div=$_POST['lw_div'];
                $lw_pos=$_POST['lw_pos'];
                $lw_pos_id=$_POST['lw_pos_id'];
                
                $response = $this->lmsmodel->lms_lawyer_info_db_update($lawyer_pev_id,$lw_id,$lw_name,$lw_mob,$lw_dist,$lw_div,$lw_pos,$lw_pos_id);
                 
                
            }
            
            
            if($action==3)
            { 
                $lawyer_id=$_POST['lawyer_id'];
                $response = $this->lmsmodel->lms_lawyer_info_db_delete($lawyer_id);
                
            }
            
        }
        
        echo $response;
        exit();
    
}


  public function lms_current_status_db_action()
  {
    $response=0;
        if(isset($_POST['action']) && $_POST['action']>0)
        {   
            $this->load->model('lmsmodel');
            $action=$_POST['action'];
            
            //delete action
           
            
            if($action==1)
            { 
                //$court_id=$_POST['court_id'];
              // $court_type_name=$_POST['court_type_name'];
                
               $cr_st_id= $_POST['cr_st_id'];
               $cr_st_desc=$_POST['cr_st_desc'];
               $cr_st_id_2=$_POST['cr_st_id_2'];
               $cr_st_desc_2=$_POST['cr_st_desc_2']; 
                          
                $response = $this->lmsmodel->lms_current_status_db_add($cr_st_id,$cr_st_desc,$cr_st_id_2,$cr_st_desc_2); 
                
            }
            
            if($action==2)
            { 

               
                $lmpp_pp_id_l2=$_POST['lmpp_pp_id_l2'];
                $cr_st_id=$_POST['cr_st_id'];
                $cr_st_desc=$_POST['cr_st_desc'];
                $cr_st_id_2=$_POST['cr_st_id_2'];
                $cr_st_desc_2=$_POST['cr_st_desc_2'];
               
                $response = $this->lmsmodel->lms_current_status_db_update($lmpp_pp_id_l2,$cr_st_id,$cr_st_desc,$cr_st_id_2,$cr_st_desc_2);
                
            }
            
            
            if($action==3)
            { 
                $lmpp_pp_id_l2=$_POST['lmpp_pp_id_l2'];
                $response = $this->lmsmodel->lms_current_status_db_delete($lmpp_pp_id_l2);
                
            }
            
        }
        
        echo $response;
        exit();
    
  }



public function lms_expense_type_db_action()
{       
        $response=0;
        if(isset($_POST['action']) && $_POST['action']>0)
        {   
            $this->load->model('lmsmodel');
            $action=$_POST['action'];
            
            //delete action
            if($action==3)
            { 
                $inc_id=$_POST['inc_id'];
                $response = $this->lmsmodel->lms_expense_type_db_delete($inc_id);
                
            }
            
            if($action==1)
            { 
                //$court_id=$_POST['court_id'];
              // $court_type_name=$_POST['court_type_name'];
                
                $exp_typ_id=$_POST['exp_typ_id'];
                $exp_typ_desc=$_POST['exp_typ_desc'];
                                
                $response = $this->lmsmodel->lms_expense_type_db_add($exp_typ_id,$exp_typ_desc); 
                
            }
            
            if($action==2)
            { 
                $lmt_data_id=$_POST['lmt_data_id'];
                                
                $lmt_et_id=$_POST['lmt_et_id'];
                $lmt_et_desc=$_POST['lmt_et_desc'];
           
                
                $response = $this->lmsmodel->lms_expense_type_db_update($lmt_data_id,$lmt_et_id,$lmt_et_desc); 
                
            }
            
        }
        
        echo $response;
        exit();
        
}


 
   public function lms_disposal_nature_db_action()
   {
     $response=0;
        if(isset($_POST['action']) && $_POST['action']>0)
        {   
            $this->load->model('lmsmodel');
            $action=$_POST['action'];
            
            //delete action
            if($action==3)
            { 
                $inc_id=$_POST['inc_id'];
                $response = $this->lmsmodel->lms_disposal_nature_db_delete($inc_id);
                
            }
            
            if($action==1)
            { 
                //$court_id=$_POST['court_id'];
              // $court_type_name=$_POST['court_type_name'];
                
                $disp_nat_id=$_POST['disp_nat_id'];
                $disp_nat_desc=$_POST['disp_nat_desc'];
                                
                $response = $this->lmsmodel->lms_disposal_nature_db_add($disp_nat_id,$disp_nat_desc); 
                
            }
            
            if($action==2)
            { 
                $lmt_data_id=$_POST['lmt_data_id'];
                                
                $lmt_disp_id=$_POST['lmt_disp_id'];
                $lmt_disp_desc=$_POST['lmt_disp_desc'];
           
                
                $response = $this->lmsmodel->lms_disposal_nature_db_update($lmt_data_id,$lmt_disp_id,$lmt_disp_desc); 
                
            }
            
        }
        echo $response;
        exit();
   }

/*-----------------------------------------sohag end --------------------------------------------------------------- */

function fetch_lms_basic_tcacking_info(){
    $response = '';   
    if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !=''){
        $this->load->model('lmsmodel');
        $allbasicInfo = $this->lmsmodel->lms_allbasicInfo_get($_POST['br_ao_do']);
        if(count($allbasicInfo)>0){
            $slNo= 1;    
            $response .='<tr>';
            $response .='<td>'.'SL No.'.'</td>';
            $response .='<td>'.'Tracking No.'.'</td>';
            $response .='<td>'.'Case No.'.'</td>';
            $response .='<td>'.'Branch Name'.'</td>';
            $response .='<td>'.'Suit Value'.'</td>';
            $response .='<td>'.'Outstanding'.'</td>';
            $response .='</tr>';
            foreach($allbasicInfo as $allbasic){
                $response .='<tr onclick="javascript:showRow(this);">';
                $response .='<td>'.$slNo++.'</td>';
                $response .='<td>'.$allbasic->lb_tran_no.'</td>';
                $response .='<td>'.$allbasic->lb_case_no.'</td>';
                $response .='<td>'.$allbasic->branchname.'</td>';
                $response .='<td>'.$allbasic->lb_suitValue_amt.'</td>';
                $response .='<td>'.$allbasic->lb_outstanding.'</td>';
                $response .='<td style="display: none;">'.$allbasic->lb_loan_ac_no.'</td>';
                $response .='<td style="display: none;">'.$allbasic->lb_loan_ac_name.'</td>';
                $response .='<td style="display: none;">'.$allbasic->lb_acholder_addres.'</td>';
                $response .='<td style="display: none;">'.$allbasic->lb_primary_secSan.'</td>';
                $response .='<td style="display: none;">'.$allbasic->lb_primary_secST.'</td>';
                $response .='<td style="display: none;">'.$allbasic->lb_coll_secST.'</td>';
                $response .='<td style="display: none;">'.$allbasic->lb_desc_coll_sec.'</td>';
                $response .='</tr>';    
            }
        }
    }
    echo $response;
    exit();
}

function fetch_br_ao_do_lms_basic_t()
{
    $response='';
    if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='')
    {
        $this->load->model('lmsmodel');
        $br_ao_do_array=$this->lmsmodel->fetch_br_ao_do_lb($_POST['br_ao_do'], $_POST['br_ao_do_str']);
        
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
        $response .='<td></td><td id="report_of_br_ao_do_div_msg_t" COLSPAN=""><h6 style="color: olive;">';
        foreach($br_ao_do_array as $key=>$val)
        {
            if($_POST['br_ao_do']==6)
            {
                $response .='<input type="radio" id="br_ao_do" name="report_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
            }
            else
            {
                $response .='<input type="radio" id="br_ao_do" name="report_report_office_id" value="'.$val[$index_val].'" onclick="tracking_search(this.value)">'.$val[$index_name].'<br/>';   
            }
        }
        $response .='</td>';
        }  
    }
    
    echo $response;
    exit();
}

function fetch_br_ao_do_lms_basic()
{
    $response='';
    if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='')
    {
        $this->load->model('lmsmodel');
        $br_ao_do_array=$this->lmsmodel->fetch_br_ao_do_lb($_POST['br_ao_do'],$_POST['br_ao_do_str']);
        
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
        $response .='<td></td><td></td><td></td><td id="report_of_br_ao_do_div_msg_s" COLSPAN=""><h6 style="color: olive;">';
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

//fetch_br_ao_do_lms_report
function fetch_br_ao_do_lms_report()
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
        $response .='<td COLSPAN="5">';
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


function get_api(){
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	$data['pfo'] = $this->session->userdata('some_uid');
	
	$data['content']=('lms/lms_basic_entry_view/api_get');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->lmsmodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('homeLms',$data);
}
/** Api area start */
function lms_court_type_view_api()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    $data['lmseditDatas'] = '';
    if($lmseditData = $this->lmsmodel->lms_court_type_data1())
    {
        $data['lmseditDatas'] = $lmseditData;
    }
    header("Content-type:application/json"); 
    echo json_encode($lmseditData);
}

function lms_case_category_view_api()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    $data['lmscasecategories'] = '';
    if($lmscasecategories = $this->lmsmodel->lms_case_category_data1())
    {
        $data['lmscasecategories'] = $lmscasecategories;
    }
    header("Content-type:application/json"); 
    echo json_encode($lmscasecategories);
}

function lms_case_pp_view_api()
{
    if ($this->session->userdata('some_name1')=='')
	{
		redirect(base_url(),'refresh');
	}
	$this->load->model('lmsmodel');
	$data['off_id'] = $office_id = $this->session->userdata('some_office');
    $data['pfo'] = $this->session->userdata('some_uid');
    
    $data['lmscasepps'] = '';
    if($lmscasepps = $this->lmsmodel->lms_case_pp_status_data())
    {
        $data['lmscasepps'] = $lmscasepps;
    }
    header("Content-type:application/json"); 
    echo json_encode($lmscasepps);
}
/** Api area end */

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