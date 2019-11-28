<?php
class Lmsmodel extends CI_Model {
 
    var $title   = '';
     var $content = '';
     var $date    = '';
 
    function __construct()
     {
         parent::__construct();
     }
    
	public function get_Data($qstr)
	{
		$query = $this->db->get($qstr);
		
        return $query;
	}
	
	public function get_Data_Sql_Str($qstr)
	{
		$query = $this->db->query($qstr);
		
        return $query->result();
	}
	
	/*
     * LMS start
    */

    function lms_office_location($off_id=0, $user_id=0)
    {
        date_default_timezone_set("Asia/Dhaka");
        $lms_use_date = date("Y-m-d h:i:s");
        $this->db->query("INSERT INTO [db_mis_LMS].[dbo].[lms_user_info] (lms_office_id, lms_user_id, lms_user_date, lms_user_show)
        VALUES ('$off_id', '$user_id', '$lms_use_date', 1)");
    }
    function lms_user_info_data()
    {
        $userInfo =  $this->db->query("select a.lms_office_id, a.lms_user_id, b.office_name, a.lms_user_date
        from [db_mis_LMS].[dbo].[lms_user_info] a,
        [Db_DP_Collection_mgr].[dbo].[VW_Jb_off] b
        WHERE a.lms_office_id = b.[Office code] order by a.lms_user_data_id");
        return $userInfo->result();
    }
    
    function lms_case_pp_status_data()
    {
        $ccs_type =  $this->db->query("select * FROM [db_mis_LMS].[dbo].[lms_master_case_pp_info] where lmpp_pp_status=1 order by lmpp_data_id");
        return $ccs_type->result();
    }
    function lms_expense_type_data()
    {
        $ccs_type =  $this->db->query("select * FROM [db_mis_LMS].[dbo].[lms_master_exp_type_info] where lmet_et_status = 1 order by lmet_data_id");
        return $ccs_type->result();
    }
    function lms_disposal_nature_data()
    {
        $ccs_type =  $this->db->query("select * FROM [db_mis_LMS].[dbo].[lms_master_dis_nature_info] where lmdn_dn_status = 1 order by lmdn_data_id");
        return $ccs_type->result();
    }

    function lms_thana_data()
    {
        $thana_type =  $this->db->query("select * from [db_mis_LMS].[dbo].[dist_thana] where dtcode not in('0066') order by dtcode");
        return $thana_type->result();
    }
    function lms_district_data()
    {
        $district_type =  $this->db->query("select * from [db_jb_cis].[dbo].[District] where dtcode not in('0066') order by dtcode");
        return $district_type->result();
    }
    function lms_court_location_data()
    {
        $court_loc_type =  $this->db->query("select DISTINCT(dtcode), dtname from [Db_DP_Collection_mgr].[dbo].[allinformation] where dtcode not in('0066') order by dtcode");
        return $court_loc_type->result();
    }    
    function lms_allbasicInfo_get($brCode=0){
                
        $lmsallbasic =  $this->db->query("SELECT a.*, b.branchname
                                        FROM [db_mis_LMS].[dbo].[lms_basic_details_info] a,
                                        [Db_DP_Collection_mgr].[dbo].[allinformation] b
                                        where a.lb_br_code = b.brcode AND a.lb_br_code='$brCode'");                      
            return $lmsallbasic->result();  
    }

    function lms_lawer_data($lawyerPara = array())
    {
         if(!empty($lawyerPara)){
            $cLaw = 1;
            $inC = "where lml_lawer_id in (";
            foreach($lawyerPara as $sin){
                $inC.=" '".$sin."'";
                if(count($lawyerPara) != $cLaw){
                    $inC.=",";
                }
                $cLaw++;
            }
            $inC.= ")";
         }else{
            $inC = "";
         }
         
        $lawers =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_master_lawyer_info] $inC");
        return $lawers->result();
    }  

    function lms_lb_tran_no_generate($br = '')
    {   
        $lb_tranno =  $this->db->query("select top 1 lb_tran_no FROM [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_br_code='$br' order by lb_tran_no desc");
        $brCode = $br;   
        $tranNoFinal = '';
        if($lb_tranno->num_rows()>0){
            $dataT = $lb_tranno->result();
            $tranNo = $dataT[0]->lb_tran_no;
            $tranSub = substr($tranNo, 12);
            $tranSub++;
            $afterTranSub = substr($tranNo, 0, 12);
            $tranNoFinal = $afterTranSub.$tranSub;
        }else{
            $time = strtotime(date("Y/m/d"));
            $numberPart = "110001";
            $tranNoFinal = $brCode.date("Y", $time).date("m", $time).date("d", $time).$numberPart;
        }
        return $tranNoFinal;
    }    
    function lms_basic_mker_prv_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $filingDate = $this->input->post('filingDateN');
        $insertDate = date("Y-m-d h:i:s");
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
        
        
        
        if($this->input->post('locationOfCourtN') == 0 || $this->input->post('locationOfCourtN') == ''){
            if($this->input->post('CTsecondListN') == '51'){
                $locCourt = $this->input->post('CTsecondListN')."#".$this->input->post('districtN');    
            }else{
                if($this->input->post('CTsecondListN') == '52'){
                    $locCourt = $this->input->post('CTsecondListN')."#".$this->input->post('districtN')."#".$this->input->post('thanaN');
                }
            }
            if($this->input->post('courtTypeN') == '51'){
                $locCourt = $this->input->post('courtTypeN')."#".$this->input->post('districtN');    
            }else{
                if($this->input->post('courtTypeN') == '52'){
                    $locCourt = $this->input->post('courtTypeN')."#".$this->input->post('districtN')."#".$this->input->post('thanaN');
                }
            }
            
        }else{
            $locCourt = $this->input->post('locationOfCourtN');
        }
        
        if($this->input->post('recoAmtN') ==''){
            $recAmtV = 0;
        }else{
            $recAmtV = $this->input->post('recoAmtN');
        }
        if($this->input->post('unClassduewritN') ==''){
            $unClassduewritNV = 0;
        }else{
            $unClassduewritNV = $this->input->post('unClassduewritN');
        }
        if($this->input->post('primarysecSanN') ==''){
            $primarysecSanNV = 0;
        }else{
            $primarysecSanNV = $this->input->post('primarysecSanN');
        }

        if($this->input->post('primarysecSTN') ==''){
            $primarysecSTNV = 0;
        }else{
            $primarysecSTNV = $this->input->post('primarysecSTN');
        }

        if($this->input->post('primarysecPN') ==''){
            $primarysecPNV = 0;
        }else{
            $primarysecPNV = $this->input->post('primarysecPN');
        }

        if($this->input->post('collSecSanN') ==''){
            $collSecSanNV = 0;
        }else{
            $collSecSanNV = $this->input->post('collSecSanN');
        }
        if($this->input->post('collSecSTN') ==''){
            $collSecSTNV = 0;
        }else{
            $collSecSTNV = $this->input->post('collSecSTN');
        }

        if($this->input->post('collSecPN') ==''){
            $collSecPNV = 0;
        }else{
            $collSecPNV = $this->input->post('collSecPN');
        }

        $data = array(
            'lb_tran_no'	    => $this->input->post('tranNoN'),
            'lb_court_type' 	=>  $this->input->post('courtTypeN'),
            'lb_category_id'	=> $this->input->post('caseCategoryN'),
            'lb_case_no'	=> $this->input->post('caseNoN'),
            'lb_suit_file_status'	    => $this->input->post('caseFileStatusN'),
            'lb_filing_date'	    => $this->input->post('filingDateN'),
            'lb_loc_court_id'	    => $locCourt,
            'lb_sensitivity'	    => $this->input->post('sensitivityN'),
            'lb_suitValue_amt'	    => $this->input->post('suitValueAmtN'),
            'lb_reco_amt'	    => $recAmtV,
            'lb_outstanding'	    => $this->input->post('outstandingN'),
            'lb_loan_ac_no'	    => $this->input->post('loanACNoN'),
            'lb_loan_ac_mno'	    => $this->input->post('bMobileNoN'),
            'lb_loan_ac_nid'	    => $this->input->post('bNIDN'),
            'lb_loan_ac_name'	    => $this->input->post('loanACNameN'),
            'lb_acholder_addres'	    => $this->input->post('ACHolderAddN'),
            'lb_tran_no_other'	    => $this->input->post('trackingTranNoN'),
            'lb_uc_amt_duesuit'	    => $unClassduewritNV,
            'lb_issue'	    => $this->input->post('subjectIssueN'),
            'lb_issue_writ'	    => $this->input->post('subjectFactChoose'),
            'lb_pl_co_pe_name'	    => $this->input->post('plComPetNameN'),
            'lb_de_ac_re_name'	    => $this->input->post('defAccResNameN'),
            'lb_primary_secSan'	    => $primarysecSanNV,
            'lb_primary_secST'	    => $primarysecSTNV,
            'lb_primary_secP'	    => $primarysecPNV,
            'lb_coll_secSan'	    => $collSecSanNV,
            'lb_coll_secST'	    => $collSecSTNV,
            'lb_coll_secP'	    => $collSecPNV,
            'lb_desc_coll_sec'	    => $this->input->post('descCollSecN'),
            'lb_remarks'	    => $this->input->post('remarksN'),
            'lb_file_off_bid'	    => $this->input->post('fileMaintOffBIDN'),
            'lb_lawyer_id'	    => $lawerDb,
            'lb_br_code'	    => $this->session->userdata('some_office'),
            'lb_data_entry_date'	    => $insertDate,
            'lb_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'lb_show_status'	    => 1,
            'lb_brcode_fho'	    => $this->input->post('report_report_office_id'),
            'lb_auth_bid'	    => $this->input->post('authMBIDN')
        );

        //$lb_tbl_name=$this->get_lms_lb_table_insert();
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert("lms_basic_details_info", $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_basic_chker_prv_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $filingDate = $this->input->post('filingDateN');
        $insertDate = date("Y-m-d h:i:s");
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
        
        if($this->input->post('locationOfCourtN') ==0){
            if($this->input->post('CTsecondListN') == '51'){
                $locCourt = $this->input->post('CTsecondListN')."#".$this->input->post('districtN');    
            }else{
                if($this->input->post('CTsecondListN') == '52'){
                    $locCourt = $this->input->post('CTsecondListN')."#".$this->input->post('districtN')."#".$this->input->post('thanaN');
                }
            }
        }else{
            $locCourt = $this->input->post('locationOfCourtN');
        }

        if($this->input->post('recoAmtN') ==''){
            $recAmtV = 0;
        }else{
            $recAmtV = $this->input->post('recoAmtN');
        }
        if($this->input->post('unClassduewritN') ==''){
            $unClassduewritNV = 0;
        }else{
            $unClassduewritNV = $this->input->post('unClassduewritN');
        }
        if($this->input->post('primarysecSanN') ==''){
            $primarysecSanNV = 0;
        }else{
            $primarysecSanNV = $this->input->post('primarysecSanN');
        }

        if($this->input->post('primarysecSTN') ==''){
            $primarysecSTNV = 0;
        }else{
            $primarysecSTNV = $this->input->post('primarysecSTN');
        }

        if($this->input->post('primarysecPN') ==''){
            $primarysecPNV = 0;
        }else{
            $primarysecPNV = $this->input->post('primarysecPN');
        }

        if($this->input->post('collSecSanN') ==''){
            $collSecSanNV = 0;
        }else{
            $collSecSanNV = $this->input->post('collSecSanN');
        }
        if($this->input->post('collSecSTN') ==''){
            $collSecSTNV = 0;
        }else{
            $collSecSTNV = $this->input->post('collSecSTN');
        }

        if($this->input->post('collSecPN') ==''){
            $collSecPNV = 0;
        }else{
            $collSecPNV = $this->input->post('collSecPN');
        }

        $data = array(
            'lb_tran_no'	    => $this->input->post('tranNoN'),
            'lb_court_type' 	=>  $this->input->post('courtTypeN'),
            'lb_category_id'	=> $this->input->post('caseCategoryN'),
            'lb_case_no'	=> $this->input->post('caseNoN'),
            'lb_suit_file_status'	    => $this->input->post('caseFileStatusN'),
            'lb_filing_date'	    => $this->input->post('filingDateN'),
            'lb_loc_court_id'	    => $locCourt,
            'lb_sensitivity'	    => $this->input->post('sensitivityN'),
            'lb_suitValue_amt'	    => $this->input->post('suitValueAmtN'),
            'lb_reco_amt'	    => $recAmtV,
            'lb_outstanding'	    => $this->input->post('outstandingN'),
            'lb_loan_ac_no'	    => $this->input->post('loanACNoN'),
            'lb_loan_ac_mno'	    => $this->input->post('bMobileNoN'),
            'lb_loan_ac_nid'	    => $this->input->post('bNIDN'),
            'lb_loan_ac_name'	    => $this->input->post('loanACNameN'),
            'lb_acholder_addres'	    => $this->input->post('ACHolderAddN'),
            'lb_tran_no_other'	    => $this->input->post('trackingTranNoN'),
            'lb_uc_amt_duesuit'	    => $unClassduewritNV,
            'lb_issue'	    => $this->input->post('subjectIssueN'),
            'lb_issue_writ'	    => $this->input->post('subjectFactChoose'),
            'lb_pl_co_pe_name'	    => $this->input->post('plComPetNameN'),
            'lb_de_ac_re_name'	    => $this->input->post('defAccResNameN'),
            'lb_primary_secSan'	    => $primarysecSanNV,
            'lb_primary_secST'	    => $primarysecSTNV,
            'lb_primary_secP'	    => $primarysecPNV,
            'lb_coll_secSan'	    => $collSecSanNV,
            'lb_coll_secST'	    => $collSecSTNV,
            'lb_coll_secP'	    => $collSecPNV,
            'lb_desc_coll_sec'	    => $this->input->post('descCollSecN'),
            'lb_remarks'	    => $this->input->post('remarksN'),
            'lb_file_off_bid'	    => $this->input->post('fileMaintOffBIDN'),
            'lb_lawyer_id'	    => $lawerDb,
            'lb_br_code'	    => $this->session->userdata('some_office'),
            'lb_data_entry_date'	    => $insertDate,
            'lb_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'lb_show_status'	    => 1,
            'lb_brcode_fho'	    => $this->input->post('report_report_office_id'),
        );

        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert("lms_basic_details_info", $data)){
            $TrackingId = $this->input->post('tranNoN');
            $this->db->query("update [db_mis_LMS].[dbo].[lms_basic_details_info_tmp] SET lb_mk_chker=1 where lb_tran_no='$TrackingId'");
            return 1;
		}else{
		return 0;
		}
    }

    function lms_basic_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $filingDate = $this->input->post('filingDateN');
        $insertDate = date("Y-m-d h:i:s");
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
        
        if($this->input->post('locationOfCourtN') ==0){
            if($this->input->post('CTsecondListN') == '51'){
                $locCourt = $this->input->post('CTsecondListN')."#".$this->input->post('districtN');    
            }else{
                if($this->input->post('CTsecondListN') == '52'){
                    $locCourt = $this->input->post('CTsecondListN')."#".$this->input->post('districtN')."#".$this->input->post('thanaN');
                }
            }
        }else{
            $locCourt = $this->input->post('locationOfCourtN');
        }

        if($this->input->post('recoAmtN') ==''){
            $recAmtV = 0;
        }else{
            $recAmtV = $this->input->post('recoAmtN');
        }
        if($this->input->post('unClassduewritN') ==''){
            $unClassduewritNV = 0;
        }else{
            $unClassduewritNV = $this->input->post('unClassduewritN');
        }
        if($this->input->post('primarysecSanN') ==''){
            $primarysecSanNV = 0;
        }else{
            $primarysecSanNV = $this->input->post('primarysecSanN');
        }

        if($this->input->post('primarysecSTN') ==''){
            $primarysecSTNV = 0;
        }else{
            $primarysecSTNV = $this->input->post('primarysecSTN');
        }

        if($this->input->post('primarysecPN') ==''){
            $primarysecPNV = 0;
        }else{
            $primarysecPNV = $this->input->post('primarysecPN');
        }

        if($this->input->post('collSecSanN') ==''){
            $collSecSanNV = 0;
        }else{
            $collSecSanNV = $this->input->post('collSecSanN');
        }
        if($this->input->post('collSecSTN') ==''){
            $collSecSTNV = 0;
        }else{
            $collSecSTNV = $this->input->post('collSecSTN');
        }

        if($this->input->post('collSecPN') ==''){
            $collSecPNV = 0;
        }else{
            $collSecPNV = $this->input->post('collSecPN');
        }

        $data = array(
            'lb_tran_no'	    => $this->input->post('tranNoN'),
            'lb_court_type' 	=>  $this->input->post('courtTypeN'),
            'lb_category_id'	=> $this->input->post('caseCategoryN'),
            'lb_case_no'	=> $this->input->post('caseNoN'),
            'lb_suit_file_status'	    => $this->input->post('caseFileStatusN'),
            'lb_filing_date'	    => $this->input->post('filingDateN'),
            'lb_loc_court_id'	    => $locCourt,
            'lb_sensitivity'	    => $this->input->post('sensitivityN'),
            'lb_suitValue_amt'	    => $this->input->post('suitValueAmtN'),
            'lb_reco_amt'	    => $recAmtV,
            'lb_outstanding'	    => $this->input->post('outstandingN'),
            'lb_loan_ac_no'	    => $this->input->post('loanACNoN'),
            'lb_loan_ac_name'	    => $this->input->post('loanACNameN'),
            'lb_acholder_addres'	    => $this->input->post('ACHolderAddN'),
            'lb_tran_no_other'	    => $this->input->post('trackingTranNoN'),
            'lb_uc_amt_duesuit'	    => $unClassduewritNV,
            'lb_issue'	    => $this->input->post('subjectIssueN'),
            'lb_issue_writ'	    => $this->input->post('subjectFactChoose'),
            'lb_pl_co_pe_name'	    => $this->input->post('plComPetNameN'),
            'lb_de_ac_re_name'	    => $this->input->post('defAccResNameN'),
            'lb_primary_secSan'	    => $primarysecSanNV,
            'lb_primary_secST'	    => $primarysecSTNV,
            'lb_primary_secP'	    => $primarysecPNV,
            'lb_coll_secSan'	    => $collSecSanNV,
            'lb_coll_secST'	    => $collSecSTNV,
            'lb_coll_secP'	    => $collSecPNV,
            'lb_desc_coll_sec'	    => $this->input->post('descCollSecN'),
            'lb_remarks'	    => $this->input->post('remarksN'),
            'lb_file_off_bid'	    => $this->input->post('fileMaintOffBIDN'),
            'lb_lawyer_id'	    => $lawerDb,
            'lb_br_code'	    => $this->session->userdata('some_office'),
            'lb_data_entry_date'	    => $insertDate,
            'lb_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'lb_show_status'	    => 1,
            'lb_brcode_fho'	    => $this->input->post('report_report_office_id')
        );

        $lb_tbl_name=$this->get_lms_lb_table_insert();
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }
    function get_lms_lb_table_insert(){
        $lb_tbl_name = 'lms_basic_details_info';
        $legacy_db = $this->load->database('dblms', true);
        if( $legacy_db->table_exists($lb_tbl_name) == FALSE)
        {
            $query = "CREATE TABLE $lb_tbl_name
                    (
                        lb_data_id INT NOT NULL IDENTITY(1, 1),
                        lb_tran_no VARCHAR(20) NOT NULL,
                        lb_case_no VARCHAR(20) NOT NULL,
                        lb_court_type INT NOT NULL,
                        lb_case_type VARCHAR(50) NOT NULL,
                        lb_category_id INT NOT NULL,
                        lb_filing_date datetime NOT NULL,
                        lb_suit_file_status INT NOT NULL,
                        lb_loc_court_id INT NOT NULL,
                        lb_sensitivity INT NOT NULL,
                        lb_claim_amt numeric(18, 0),
                        lb_reco_amt numeric(18, 0),
                        lb_outstanding numeric(18, 0) NOT NULL,
                        lb_loan_ac_no VARCHAR(50),
                        lb_loan_ac_name VARCHAR(256),
                        lb_acholder_addres VARCHAR(256),
                        lb_tran_no_other VARCHAR(256),
                        lb_unclassfied_amt_duesuit numeric(18, 0),
                        lb_issue VARCHAR(256),
                        lb_pl_co_pe_name VARCHAR(256),
                        lb_de_ac_re_name VARCHAR(256),
                        lb_file_officer_bid VARCHAR(10),
                        lb_file_officer_name VARCHAR(256) NOT NULL,
                        lb_primary_security numeric(18, 0),
                        lb_coll_sec_sanction numeric(18, 0),
                        lb_coll_sec_timeofsuit numeric(18, 0),
                        lb_desc_coll_security VARCHAR(256),
                        lb_remarks VARCHAR(256),
                        lb_lawyer_id VARCHAR(MAX),
                        lb_br_code VARCHAR(10) NOT NULL,
                        lb_data_entry_date datetime NOT NULL,
                        lb_data_sb_uid VARCHAR(20) NOT NULL,
                        lb_show_status INT NOT NULL,
                        PRIMARY KEY (lb_tran_no)
                    )";

            $legacy_db->query($query);                  
        }       
        return $lb_tbl_name;
    }
    function lms_tracNo_view_data_br($brCode= '')
    {
        $IN_bcon="where lb_br_code = '$brCode'";
        
        $lmstracNoq =  $this->db->query("select lb_data_id, lb_tran_no from [db_mis_LMS].[dbo].[lms_basic_details_info] $IN_bcon");
        return $lmstracNoq->result();
    } 
    function lms_tracNo_view_data($branch_id_array_for_report=array())
    {
        
        $IN_bcon='';
        $count_in_branch=count($branch_id_array_for_report);
        if($count_in_branch>0)
        {
            $IN_bcon="where lb_br_code IN (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_bcon .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_bcon .=",";}
            }
            $IN_bcon .=")";
        }

        $lmstracNoq =  $this->db->query("select lb_data_id, lb_tran_no from [db_mis_LMS].[dbo].[lms_basic_details_info] $IN_bcon");
        return $lmstracNoq->result();
    } 

    function lms_basic_checker_view($tracNo='')
    {
        
        // $inCon = '';
        // if($tracNo !=''){
        //     $inCon.= " AND a.lb_tran_no='$tracNo'";
        // }
        // if($caseNoNS !=''){
        //     $inCon.= " AND a.lb_case_no='$caseNoNS'";
        // }

        $lmschkerinfo =  $this->db->query("SELECT * FROM [db_mis_LMS].[dbo].[lms_basic_details_info_tmp]  where lb_mk_chker = 0");
        return $lmschkerinfo->result();
    } 

    function lms_basic_checker_view_details($tracNo='')
    {
        
        // $inCon = '';
        // if($tracNo !=''){
        //     $inCon.= " AND a.lb_tran_no='$tracNo'";
        // }
        // if($caseNoNS !=''){
        //     $inCon.= " AND a.lb_case_no='$caseNoNS'";
        // }

        $lmschkerinfo =  $this->db->query("SELECT * FROM [db_mis_LMS].[dbo].[lms_basic_details_info_tmp]  where lb_tran_no = '$tracNo' AND lb_mk_chker = 0");
        
        return $lmschkerinfo->result();
    } 

    function lms_all_info_edit_view_data($num=0, $offset=0, $is_total=0, $brCode = '')
    {
        
        $lmseditinfo =  $this->db->query("select a.lb_data_id, a.lb_tran_no, a.lb_loan_ac_name, a.lb_outstanding, a.lb_suitValue_amt, 
        a.lb_case_no, a.lb_court_type, a.lb_loan_ac_no, b.lmct_ct_desc_l3, c.lmcc_cc_id_l3, c.lmcc_cc_desc_l3 
        from [db_mis_LMS].[dbo].[lms_basic_details_info] a, 
        [db_mis_LMS].[dbo].[lms_master_court_type_info] b,
        [db_mis_LMS].[dbo].[lms_master_case_category_info] c
        where a.lb_court_type = b.lmct_ct_id_l3 AND a.lb_category_id = c.lmcc_cc_id_l3
        AND a.lb_br_code='$brCode' order by a.lb_data_id");
        return $lmseditinfo->result();
        if($is_total==1)
        {
            $total_rows=0;
            $Q =  $this->db->query("select a.lb_data_id, a.lb_tran_no, a.lb_loan_ac_name, a.lb_outstanding, a.lb_suitValue_amt, 
            a.lb_case_no, a.lb_court_type, a.lb_loan_ac_no, b.lmct_ct_desc_l3, c.lmcc_cc_id_l3, c.lmcc_cc_desc_l3 
            from [db_mis_LMS].[dbo].[lms_basic_details_info] a, 
            [db_mis_LMS].[dbo].[lms_master_court_type_info] b,
            [db_mis_LMS].[dbo].[lms_master_case_category_info] c
            where a.lb_court_type = b.lmct_ct_id_l3 AND a.lb_category_id = c.lmcc_cc_id_l3
            AND a.lb_br_code='$brCode' order by a.lb_data_id");
            $total_rows=$Q->num_rows();
            return $total_rows;
        }
        else
        {
            $data_ret=array(); 
            $Q =  $this->db->query("select a.lb_data_id, a.lb_tran_no, a.lb_loan_ac_name, a.lb_outstanding, a.lb_suitValue_amt, 
            a.lb_case_no, a.lb_court_type, a.lb_loan_ac_no, b.lmct_ct_desc_l3, c.lmcc_cc_id_l3, c.lmcc_cc_desc_l3 
            from [db_mis_LMS].[dbo].[lms_basic_details_info] a, 
            [db_mis_LMS].[dbo].[lms_master_court_type_info] b,
            [db_mis_LMS].[dbo].[lms_master_case_category_info] c
            where a.lb_court_type = b.lmct_ct_id_l3 AND a.lb_category_id = c.lmcc_cc_id_l3
            AND a.lb_br_code='$brCode' order by a.lb_data_id");                   
            if($Q->num_rows()>0)
            {
                $count=0;
                foreach($Q->result_array() as $key=>$row)
                {
                
                    if($key >= $num && $count < $offset)
                {
                    $data_ret[]=$row; 
                    $count++;
                }
                }  
            } 
            
            return $data_ret;
        }
    }   

    function lms_edit_view_data($tracNo='', $caseNoNS='', $brCode = '')
    {
        
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND a.lb_tran_no='$tracNo'";
        }
        if($caseNoNS !=''){
            $inCon.= " AND a.lb_case_no='$caseNoNS'";
        }

        $lmseditinfo =  $this->db->query("select a.lb_data_id, a.lb_tran_no, a.lb_loan_ac_name, a.lb_outstanding, a.lb_suitValue_amt, 
        a.lb_case_no, a.lb_court_type, a.lb_loan_ac_no, b.lmct_ct_desc_l3, c.lmcc_cc_id_l3, c.lmcc_cc_desc_l3 
        from [db_mis_LMS].[dbo].[lms_basic_details_info] a, 
        [db_mis_LMS].[dbo].[lms_master_court_type_info] b,
        [db_mis_LMS].[dbo].[lms_master_case_category_info1] c
        where a.lb_court_type = b.lmct_ct_id_l3 AND a.lb_category_id = c.lmcc_cc_id_l3
        AND a.lb_br_code='$brCode' $inCon order by a.lb_data_id");
        return $lmseditinfo->result();
    } 

    function lms_present_position_data($tracNo='', $caseNoPP='', $brCode = ''){
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lb_case_no='$caseNoPP'";
        }
        
        $lmsPP =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_case_no as 'case_no', lb_br_code as 'br_code',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_br_code='$brCode' $inCon");  
            return $lmsPP->result();  
    }
    function lms_present_position_data_has($tracNo='', $caseNoPP='', $brCode = ''){
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lbpp_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lbpp_case_no='$caseNoPP'";
        }

        $lmsPP =  $this->db->query("select a.lbpp_br_code, a.lbpp_case_no, a.lbpp_data_entry_date, a.lbpp_date_of_position, a.lbpp_followup_date,
        a.lbpp_present_position, a.lbpp_tran_no, a.lbpp_remarks, b.lmpp_pp_desc_l2 
        from [db_mis_LMS].[dbo].[lms_basic_present_position_info] a,
            [db_mis_LMS].[dbo].[lms_master_case_pp_info] b
            where a.lbpp_present_position = b.lmpp_pp_id_l2 AND
            a.lbpp_br_code='$brCode' $inCon AND a.lmpp_show_status=1 order by a.lbpp_data_id desc");  
            return $lmsPP->result();  
    }
    function lms_search_all_tracking_data($tracNo=''){
        if($tracNo != ''){
            $lmsFTr =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_tran_no in ('$tracNo')");
            $temp_tr = "";
            if($lmsFTr->num_rows()>0){
                $tr_ids = $lmsFTr->result_array();
                $temp_tr = $tr_ids[0]['lb_tran_no_other'];
                $IN_Tr = '';
                
                if($temp_tr == " "){
                    $lmsSTr =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_tran_no_other in ('$tracNo')");
                    if($lmsSTr->num_rows()>0){
                        $tr_sids = $lmsSTr->result_array();
                        $IN_Tr.= '(';   
                        $IN_Tr.= "$tracNo, ";
                        foreach($tr_sids as $key=>$tr_sid){
                            $IN_Tr.=$tr_sid['lb_tran_no'];
                            if((count($tr_sids)-1) != $key){
                                $IN_Tr.= ', ';    
                            }
                        }
                        $IN_Tr.= ')';
                    }else{
                        $IN_Tr.= '(';   
                        $IN_Tr.= "$tracNo";
                        $IN_Tr.= ')';
                    }
                }else{
                    $lmsSTr =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_tran_no_other in ('$temp_tr')");
                    if($lmsSTr->num_rows()>0){
                        $tr_sids = $lmsSTr->result_array();
                        $IN_Tr.= '(';   
                        $IN_Tr.= "$temp_tr, ";
                        foreach($tr_sids as $key=>$tr_sid){
                            $IN_Tr.=$tr_sid['lb_tran_no'];
                            if((count($tr_sids)-1) != $key){
                                $IN_Tr.= ', ';    
                            }
                        }
                        $IN_Tr.= ')';
                    }
                }
            }
        }
        return $IN_Tr;
    }

    function lms_present_position_datas($tracNo='', $caseNoPP='', $brCode = ''){    

        $lmsPP =  $this->db->query("select a.lbpp_br_code, a.lbpp_case_no, a.lbpp_data_entry_date, a.lbpp_date_of_position, a.lbpp_followup_date,
        a.lbpp_present_position, a.lbpp_tran_no, a.lbpp_remarks, b.lmpp_pp_desc_l2 
        from [db_mis_LMS].[dbo].[lms_basic_present_position_info] a,
            [db_mis_LMS].[dbo].[lms_master_case_pp_info] b
            where a.lbpp_present_position = b.lmpp_pp_id_l2 AND lbpp_tran_no in $tracNo 
             AND a.lmpp_show_status=1 order by a.lbpp_data_id desc");  
    
            return $lmsPP->result();  
    }
    function lms_present_position_datas_withBr($branch_id_array_for_report=array()){    
        
        $count_in_branch = count($branch_id_array_for_report);    
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con=" (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $lmsPP =  $this->db->query("select a.lbpp_tran_no, a.lbpp_br_code, a.lbpp_case_no, a.lbpp_data_entry_date, a.lbpp_date_of_position, a.lbpp_followup_date,
        a.lbpp_present_position, a.lbpp_tran_no, a.lbpp_remarks, b.lmpp_pp_desc_l2 
        from [db_mis_LMS].[dbo].[lms_basic_present_position_info] a,
            [db_mis_LMS].[dbo].[lms_master_case_pp_info] b
            where a.lbpp_present_position = b.lmpp_pp_id_l2 AND lbpp_br_code in $IN_con
             AND a.lmpp_show_status=1 order by a.lbpp_data_id desc");  
    
            return $lmsPP->result();  
    }

    function lms_case_pp_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
        
        $data = array(
            'lbpp_tran_no'	    => $this->input->post('tracNoPPN'),
            'lbpp_case_no'	=> $this->input->post('caseNoPPN'),
            'lbpp_br_code'	=> $this->input->post('brCodeppN'),
            'lbpp_data_entry_date'	    => $insertDate,
            'lbpp_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'lbpp_date_of_position' 	=>  $this->input->post('dateOfPPPN'),
            'lbpp_present_position' 	    => $this->input->post('secondListcasePPN'),
            'lbpp_followup_date'	=> $this->input->post('folowupPPN'),
            'lbpp_remarks'	=> $this->input->post('remarksPPN'),
            'lmpp_show_status'	    => 1
        );


        $lb_tbl_name = 'lms_basic_present_position_info';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }
    function lms_recovery_details_data_has($tracNo='', $caseNoPP='', $brCode = '')
    {

        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lbrec_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lbrec_case_no='$caseNoPP'";
        }
        
        $lmsRec =  $this->db->query("select 
        a.lbrec_br_code, a.lbrec_case_no, a.lbrec_tran_no, a.lbrec_rec_date, a.lbrec_reco_amt, b.lc_recModeId_id,
        b.lc_recModeDesc, a.lbrec_remarks
        from [db_mis_LMS].[dbo].[lms_basic_recovery_info] a,
        [db_mis_LMS].[dbo].[lms_components] b
        where a.lbrec_mode_recovery = b.lc_recModeId_id AND
        lbrec_br_code='$brCode' $inCon");  
            return $lmsRec->result();  
    }
    function lms_recovery_details_data($tracNo='', $caseNoPP='', $brCode = '')
    {

        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lb_case_no='$caseNoPP'";
        }
        
        $lmsRec =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_case_no as 'case_no', lb_br_code as 'br_code', lb_reco_amt as 'reco_amt',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_br_code='$brCode' $inCon");  
            return $lmsRec->result();  
    }

    function lms_recovery_details_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
        
        $data = array(
            'lbrec_tran_no'	    => $this->input->post('tracNoRN'),
            'lbrec_case_no'	=> $this->input->post('caseNoRN'),
            'lbrec_br_code'	=> $this->input->post('brCodeRecN'),
            'lbrec_data_sb_uid'	=> $this->session->userdata('some_uid'),
            'lbrec_data_entry_date'	    => $insertDate,
            'lbrec_rec_date'	    => $this->input->post('recDateRN'),
            'lbrec_mode_recovery' 	=>  $this->input->post('modOfRecN'),
            'lbrec_reco_amt' 	    => $this->input->post('recAmtRN'),
            'lbrec_remarks'	=> $this->input->post('remarksRN'),
            'lbrec_show_status'	=> 1,
        );

        $lb_tbl_name = 'lms_basic_recovery_info';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_expense_details_data_has($tracNo='', $caseNoPP='', $brCode = '')
    {

        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lbexp_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lbexp_case_no='$caseNoPP'";
        }
        
        $lmsRec =  $this->db->query("select a.lbexp_case_no, a.lbexp_tran_no, a.lbexp_data_entry_date, a.lbexp_exp_date, a.lbexp_exp_amt,
        b.lmet_et_id, b.lmet_et_desc, a.lbexp_remarks
        from [db_mis_LMS].[dbo].[lms_basic_expense_info] a,
        [db_mis_LMS].[dbo].[lms_master_exp_type_info] b
        where a.lbexp_exp_type_id = b.lmet_et_id AND
        a.lbexp_br_code='$brCode' $inCon order by a.lbexp_data_id desc");  
            return $lmsRec->result();  
    }

    function lms_expense_details_data($tracNo='', $caseNoPP='', $brCode = '')
    {

        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lb_case_no='$caseNoPP'";
        }
        
        $lmsRec =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_case_no as 'case_no', lb_br_code as 'br_code', lb_reco_amt as 'reco_amt',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_br_code='$brCode' $inCon");  
            return $lmsRec->result();  
    }

    function lms_expense_details_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
        
        $data = array(
            'lbexp_tran_no'	    => $this->input->post('tracNoExpN'),
            'lbexp_case_no'	=> $this->input->post('caseNoExpN'),
            'lbexp_br_code'	=> $this->input->post('brCodeExpN'),
            'lbexp_data_sb_uid'	=> $this->session->userdata('some_uid'),
            'lbexp_data_entry_date'	    => $insertDate,
            'lbexp_exp_date'	    => $this->input->post('expDateExpN'),
            'lbexp_exp_type_id' 	=>  $this->input->post('expTypeExpN'),
            'lbexp_exp_amt' 	    => $this->input->post('expAmtExpN'),
            'lbexp_remarks'	=> $this->input->post('remarksExpN'),
            'lbexp_show_status'	=> 1,
        );


        $lb_tbl_name = 'lms_basic_expense_info';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_writtenOff_details_data($tracNo='', $caseNoPP='', $brCode = '')
    {
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND a.lb_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND a.lb_case_no='$caseNoPP'";
        }
        
        $lmsRec =  $this->db->query("select a.lb_data_id, a.lb_tran_no as 'tran_no', a.lb_case_no as 'case_no', 
         a.lb_br_code as 'br_code', a.lb_reco_amt as 'reco_amt', a.lb_loan_ac_no as 'loan_ac_no', 
         a.lb_loan_ac_name as 'loan_ac_name', a.lb_outstanding as 'outstanding', a.lb_suitValue_amt as 'claim_amt', 
         a.lb_filing_date as 'filing_date', a.lb_reco_amt as total_rec from 
         (select lb_data_id, lb_tran_no, lb_br_code, lb_case_no, lb_loan_ac_no, lb_loan_ac_name, 
         lb_outstanding, lb_suitValue_amt, lb_filing_date, lb_reco_amt from [db_mis_LMS].[dbo].[lms_basic_details_info]) a 
         where a.lb_br_code='$brCode' $inCon"); 
        return $lmsRec->result();  
    }
    function lms_writtenOff_details_data_has($tracNo='', $caseNoPP='', $brCode = '')
    {

        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lbwro_tran_no ='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lbwro_case_no ='$caseNoPP'";
        }
    
        $lmsRec =  $this->db->query("select *
            from [db_mis_LMS].[dbo].[lms_basic_writeOff_info]
            where lbwro_br_code='$brCode' $inCon order by lbwro_data_id desc");  
            return $lmsRec->result();  
    }

    function lms_wrtiteOff_details_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
        
        $data = array(
            'lbwro_tran_no'	    => $this->input->post('tracNoWrOffN'),
            'lbwro_case_no'	=> $this->input->post('caseNoWrOffN'),
            'lbwro_br_code'	=> $this->input->post('brCodewrtoffN'),
            'lbwro_data_sb_uid'	=> $this->session->userdata('some_uid'),
            'lbwro_data_entry_date'	    => $insertDate,
            'lbwro_wro_date'	    => $this->input->post('DateWrOffN'),
            'lbwro_wro_amt' 	=>  $this->input->post('WrOffAmtN'),
            'lbwro_is_sick' 	=>  $this->input->post('isSickN'),
            'lbwro_sick_desc' 	=>  $this->input->post('WrOffSickDescN'),
            'lbwro_remarks' 	    => $this->input->post('remarksWrOffN'),
            'lbwro_show_status'	=> 1,
        );


        $lb_tbl_name = 'lms_basic_writeOff_info';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }
    function lms_disposal_details_data_withBr($branch_id_array_for_report=array())
    {

        $count_in_branch = count($branch_id_array_for_report);    
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con=" (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $lmsdis =  $this->db->query("select a.lbdis_tran_no, a.lbdis_case_no, a.lbdis_br_code, a.lbdis_date, a.lbdis_dis_amt, a.lbdis_dis_status,
        a.lbdis_dis_in_favorof, a.lbdis_cond_of_dis, a.lbdis_remarks, b.lmdn_dn_id, b.lmdn_dn_desc 
        from [db_mis_LMS].[dbo].[lms_basic_disposal_info] a,
        [db_mis_LMS].[dbo].[lms_master_dis_nature_info] b
        where a.lbdis_dis_nature = b.lmdn_dn_id AND a.lbdis_br_code in $IN_con
		AND a.lbdis_show_status=1
        order by a.lbdis_data_id desc");  
        return $lmsdis->result();  
    }
    function lms_disposal_details_data($tracNo='', $caseNoPP='', $brCode = '')
    {

        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND lb_case_no='$caseNoPP'";
        }
    
        $lmsRec =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_case_no as 'case_no', lb_br_code as 'br_code', lb_reco_amt as 'reco_amt',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_br_code='$brCode' $inCon");  
            return $lmsRec->result();  
    }

    function lms_disposal_details_data_has($tracNo='', $caseNoPP='', $brCode = '')
    {
        if($brCode == 0){
            $br_Con = '';
        }else{
            $br_Con = "AND a.lbdis_br_code='$brCode'";
        }
        
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND a.lbdis_tran_no = '$tracNo'";
        }
        if($caseNoPP !=''){
            $inCon.= " AND a.lbdis_case_no = '$caseNoPP'";
        }
    
        $lmsRec =  $this->db->query("select a.lbdis_tran_no, a.lbdis_case_no, a.lbdis_date, a.lbdis_dis_amt, a.lbdis_dis_status,
        a.lbdis_dis_in_favorof, a.lbdis_cond_of_dis, a.lbdis_remarks, b.lmdn_dn_id, b.lmdn_dn_desc 
        from [db_mis_LMS].[dbo].[lms_basic_disposal_info] a,
        [db_mis_LMS].[dbo].[lms_master_dis_nature_info] b
        where a.lbdis_dis_nature = b.lmdn_dn_id $br_Con $inCon AND a.lbdis_show_status=1
        order by a.lbdis_data_id desc");  
        return $lmsRec->result();  
    }
    function lms_disposal_details_checks($tracNo='')
    {
        
        $inCon = '';
        if($tracNo !=''){
            $inCon.= "a.lbdis_tran_no in $tracNo AND";
        }

        
        $lmsRec =  $this->db->query("select a.lbdis_tran_no, a.lbdis_case_no, a.lbdis_date, a.lbdis_dis_amt, a.lbdis_dis_status,
        a.lbdis_dis_in_favorof, a.lbdis_cond_of_dis, a.lbdis_remarks, b.lmdn_dn_id, b.lmdn_dn_desc 
        from [db_mis_LMS].[dbo].[lms_basic_disposal_info] a,
        [db_mis_LMS].[dbo].[lms_master_dis_nature_info] b
        where $inCon a.lbdis_dis_nature=b.lmdn_dn_id AND 
        a.lbdis_show_status=1
        order by a.lbdis_data_id desc");
        
        return $lmsRec->result();  
    }
    function lms_disposal_details_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
        
        $data = array(
            'lbdis_tran_no'	    => $this->input->post('tracNoDisposalN'),
            'lbdis_case_no'	=> $this->input->post('caseNoDisposalN'),
            'lbdis_br_code'	=> $this->input->post('brCodedisposalN'),
            'lbdis_data_sb_uid'	=> $this->session->userdata('some_uid'),
            'lbdis_data_entry_date'	    => $insertDate,
            'lbdis_date'	    => $this->input->post('disDateDisposalN'),
            'lbdis_dis_amt' 	=>  $this->input->post('disAmtDisposalN'),
            'lbdis_dis_status' 	    => $this->input->post('disStatusDisposalN'),
            'lbdis_dis_nature' 	    => $this->input->post('disnatureDisposalN'),
            'lbdis_dis_in_favorof' 	    => $this->input->post('inFavorOfDisposalN'),
            'lbdis_cond_of_dis' 	    => $this->input->post('conDisDisposalN'),
            'lbdis_remarks' 	    => $this->input->post('remarksDisposalN'),
            'lbdis_show_status'	=> 1
        );

        $lb_tbl_name = 'lms_basic_disposal_info';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_components_data()
    {
        
        $lmsCom =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_components]");  
        return $lmsCom->result();  
    }

    function lms_single_edit_view_data($tracN = '', $brCode = '')
    {
        $lmsSeditinfo =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_tran_no = '$tracN' AND lb_br_code=$brCode");
        
        return $lmsSeditinfo->result();
    } 

    function lms_basic_edited_info_save()
    {
        date_default_timezone_set("Asia/Dhaka");
        $filingDate = $this->input->post('filingDateN');
        $insertDate = date("Y-m-d h:i:s");
        $lawerDb = '';
        $lawerC = count($_POST['lawyerInfoN']);
        for($i=0; $i<$lawerC; $i++){
            if($i==($lawerC-1)){
                $lawerDb.= $_POST['lawyerInfoN'][$i];  
            }else{
                $lawerDb.= $_POST['lawyerInfoN'][$i].", ";
            }   
        }
        $data_where = array(
            'lb_data_id'	    => $this->input->post('lb_data_idE'),
            'lb_tran_no'	    => $this->input->post('tranNoN'),
        );
        $data = array(
            'lb_case_no'	=> $this->input->post('caseNoN'),
            'lb_court_type' 	=>  $this->input->post('courtTypeN'),
            'lb_case_type' 	    => $this->input->post('caseTypeN'),
            'lb_category_id'	=> $this->input->post('caseCategoryN'),
            'lb_filing_date'	    => $this->input->post('filingDateN'),
            'lb_suit_file_status'	    => $this->input->post('caseFileStatusN'),
            'lb_loc_court_id'	    => $this->input->post('locationOfCourtN'),
            'lb_sensitivity'	    => $this->input->post('sensitivityN'),
            'lb_claim_amt'	    => $this->input->post('claimAmountN'),
            'lb_reco_amt'	    => $this->input->post('recoAmtN'),
            'lb_outstanding'	    => $this->input->post('outstandingN'),
            'lb_loan_ac_no'	    => $this->input->post('loanACNoN'),
            'lb_loan_ac_name'	    => $this->input->post('loanACNameN'),
            'lb_acholder_addres'	    => $this->input->post('ACHolderAddN'),
            'lb_tran_no_other'	    => $this->input->post('trackingTranNoN'),
            'lb_unclassfied_amt_duesuit'	    => $this->input->post('unClassduewritN'),
            'lb_issue'	    => $this->input->post('subjectIssueN'),
            'lb_pl_co_pe_name'	    => $this->input->post('plComPetNameN'),
            'lb_de_ac_re_name'	    => $this->input->post('defAccResNameN'),
            'lb_file_officer_bid'	    => $this->input->post('fileMaintOffBIDN'),
            'lb_file_officer_name'	    => $this->input->post('fileMaintOffNameN'),
            'lb_primary_security'	    => $this->input->post('primarySecurityN'),
            'lb_coll_sec_sanction'	    => $this->input->post('collSecuSanctionN'),
            'lb_coll_sec_timeofsuit'	    => $this->input->post('collSecTimeSuitN'),
            'lb_desc_coll_security'	    => $this->input->post('descCollSecN'),
            'lb_remarks'	    => $this->input->post('remarksN'),
            'lb_lawyer_id'	    => $lawerDb,
            //'lb_br_code'	    => $this->session->userdata('some_office'),
            'lb_data_entry_date'	    => $insertDate,
            'lb_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'lb_show_status'	    => 1
        );
        $lb_tbl_name = $this->get_lms_lb_table_insert();
        $legacy_db = $this->load->database('dblms', true);
        $legacy_db->where($data_where);
        $result = $legacy_db->update($lb_tbl_name, $data);
        if($result){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_edit_outstanding_data($tracNo='', $caseNoPara = '', $brCode = '')
    {
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND a.lb_tran_no='$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND a.lb_case_no='$caseNoPara'";
        }
            
         $lmsRec =  $this->db->query("select a.lb_data_id, a.lb_tran_no as 'tran_no', a.lb_case_no as 'case_no', 
         a.lb_br_code as 'br_code', a.lb_reco_amt as 'reco_amt', a.lb_loan_ac_no as 'loan_ac_no', 
         a.lb_loan_ac_name as 'loan_ac_name', a.lb_outstanding as 'outstanding', a.lb_suitValue_amt as 'claim_amt', 
         a.lb_filing_date as 'filing_date', a.lb_reco_amt+b.lbrec_reco_amt as total_rec from 
         (select lb_data_id, lb_tran_no, lb_br_code, lb_case_no, lb_loan_ac_no, lb_loan_ac_name, 
         lb_outstanding, lb_suitValue_amt, lb_filing_date, lb_reco_amt from [db_mis_LMS].[dbo].[lms_basic_details_info]) a 
         inner join (select lbrec_tran_no,lbrec_case_no,sum(lbrec_reco_amt) lbrec_reco_amt 
         from [db_mis_LMS].[dbo].[lms_basic_recovery_info] group by lbrec_tran_no,lbrec_case_no ) b on a.lb_tran_no =b.lbrec_tran_no 
         and a.lb_case_no = b.lbrec_case_no where a.lb_br_code='$brCode' $inCon"); 
        
        if($lmsRec->num_rows()>0){
            return $lmsRec->result(); 
        }else{
                $lmseditouststanding =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name', lb_case_no as 'case_no',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code', lb_reco_amt as 'total_rec'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_tran_no='$tracNo' AND lb_br_code='$brCode'");  
            return $lmseditouststanding->result();
        }
    }

    function lms_edit_outstanding_data_has($tracNo='', $caseNoPara = '', $brCode = ''){
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND le_tran_no='$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND le_case_no='$caseNoPara'";
        }
    
         $lmsRec =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_edit_outstanding] 
         where le_br_code='$brCode' $inCon"); 
        return $lmsRec->result();
    }
    function lms_edit_all_data_has_basic($tracNo='', $caseNoPara = '', $brCode = ''){
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND lb_case_no='$caseNoPara'";
        }
    
         $lmsRec =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_basic_details_info] 
         where lb_br_code='$brCode' $inCon"); 
        return $lmsRec->result();
    }

    function lms_edit_all_law_data_has_basic($tracNo='', $caseNoPara = '', $brCode = ''){
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND lb_case_no='$caseNoPara'";
        }
    
         $lmsRec =  $this->db->query("select lb_tran_no, lb_case_no, lb_br_code, lb_lawyer_id, lb_filing_date, lb_remarks from [db_mis_LMS].[dbo].[lms_basic_details_info] 
         where lb_br_code='$brCode' $inCon"); 
        return $lmsRec->result();
    }

    function lms_os_edited_info_save_models()
    {
        date_default_timezone_set("Asia/Dhaka");
        $filingDate = $this->input->post('filingDateN');
        $insertDate = date("Y-m-d h:i:s");
        
        $le_claim_amt = $this->input->post('osdAmtEN');
        $le_outstanding= $this->input->post('claimAmtEN');
        $le_reco_amt = $this->input->post('recAmtEN');
        if(isset($le_reco_amt) && $le_reco_amt ==''){
            $le_reco_amt = 0;
        }
        if(isset($le_claim_amt) && $le_claim_amt ==''){
            $le_claim_amt = 0;
        }
        if(isset($le_outstanding) && $le_outstanding ==''){
            $le_outstanding = 0;
        }

        $data = array(
            'lb_data_id'  => $this->input->post('ld_data_idE'),
            'le_tran_no'	    => $this->input->post('tracNoOEN'),
            'le_case_no'	=> $this->input->post('caseNoOEN'),
            'le_br_code'	    => $this->session->userdata('some_office'),
            'le_data_entry_date'	    => $insertDate,
            'le_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'le_claim_amt' 	=>  $this->input->post('claimAmtEN'),
            'le_outstanding' 	    => $this->input->post('osdAmtEN'),
            'le_Dateoutstanding' 	    => $this->input->post('DateoutstandingEN'),
            'le_outRemarks' 	    => $this->input->post('remarksOutEN'),
            'le_show_status'	    => 1
        );
        $lb_tbl_name = 'lms_edit_outstanding';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_security_edited_info_save_models()
    {
        date_default_timezone_set("Asia/Dhaka");
        $filingDate = $this->input->post('filingDateN');
        $insertDate = date("Y-m-d h:i:s");
        
        $le_claim_amt = $this->input->post('osdAmtEN');
        $le_outstanding= $this->input->post('claimAmtEN');
        
        
        if(isset($le_claim_amt) && $le_claim_amt ==''){
            $le_claim_amt = 0;
        }
        if(isset($le_outstanding) && $le_outstanding ==''){
            $le_outstanding = 0;
        }

        $data = array(
            'lb_data_id'  => $this->input->post('ld_data_idE'),
            'ls_tran_no'	    => $this->input->post('tracNoOEN'),
            'ls_case_no'	=> $this->input->post('caseNoOEN'),
            'ls_br_code'	    => $this->session->userdata('some_office'),
            'ls_data_entry_date'	    => $insertDate,
            'ls_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'ls_claim_amt' 	=>  $le_claim_amt,
            'ls_sec_date' 	    => $this->input->post('DateSecEN'),
            'ls_prim_sec_p_amt' 	    => $this->input->post('primarySecPN'),
            'ls_coll_sec_p_amt' 	    => $this->input->post('collSecPN'),
            'ls_outRemarks' 	    => $this->input->post('remarksSecEN'),
            'ls_show_status'	    => 1
        );
        $lb_tbl_name = 'lms_edit_security';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_edit_lawyerinfo_data($tracNo='', $brCode = '')
    {
        
        $editData = $this->db->query("select * from [db_mis_LMS].[dbo].[lms_edit_lawyerinfo] where le_tran_no='$tracNo' AND le_br_code='$brCode'");
        
        if($editData->num_rows()>0){
            $lmseditouststanding =  $this->db->query("select a.lb_data_id, 
            a.lb_tran_no as 'tran_no', a.lb_outstanding, 
            a.lb_suitValue_amt, a.lb_case_no as 'case_no', a.lb_loan_ac_no as 'loan_ac_no', a.lb_loan_ac_name as
            'loan_ac_name', a.lb_br_code as 'br_code', 
            a.lb_filing_date as 'filing_date', a.lb_data_sb_uid, b.le_lawyer_id as 'lawyer_id'            
            from [db_mis_LMS].[dbo].[lms_basic_details_info] a,
            [db_mis_LMS].[dbo].[lms_edit_lawyerinfo] b
            where a.lb_tran_no = b.le_tran_no AND a.lb_br_code=b.le_br_code 
            AND a.lb_tran_no='$tracNo' AND a.lb_br_code='$brCode'
            order by CONVERT(datetime, b.le_data_entry_date ) desc");
            return $lmseditouststanding->result();
        }else{
            $lmseditouststanding =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code', lb_lawyer_id as 'lawyer_id'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_tran_no='$tracNo' AND lb_br_code='$brCode'");  
            return $lmseditouststanding->result();  
        }
    }
    function lms_edit_lawyerinfo_data_all($tracNo='', $brCode = '')
    {
        
        $editData = $this->db->query("select * from [db_mis_LMS].[dbo].[lms_edit_lawyerinfo] where le_tran_no='$tracNo' AND le_br_code='$brCode' order by le_data_id desc");
        return $editData->result();  
       
    }

    function lms_lawyers_edited_info_save_model()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
               
        $lawerDb = '';
        $lawerC = count($_POST['lawyerInfoN']);
        for($i=0; $i<$lawerC; $i++){
            if($i==($lawerC-1)){
                $lawerDb.= $_POST['lawyerInfoN'][$i];  
            }else{
                $lawerDb.= $_POST['lawyerInfoN'][$i].", ";
            }   
        }
        
        $data = array(
            'lb_data_id'  => $this->input->post('ld_data_idE'),
            'le_tran_no'	    => $this->input->post('tracNoELN'),
            'le_case_no'	=> $this->input->post('caseNoELN'),
            'le_br_code'	    => $this->session->userdata('some_office'),
            'le_data_entry_date'	    => $insertDate,
            'le_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'le_law'	    => $this->input->post('DatelawyerEN'),
            'le_lawRemarks'	    => $this->input->post('remarkslawyerEN'),
            'le_lawyer_id' 	=>  $lawerDb,
            'le_show_status' 	    => 1
        );
        $lb_tbl_name = 'lms_edit_lawyerinfo';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_edit_cast_type_data($tracNo='', $caseNoPara = '', $brCode = '')
    {
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND lb_case_no='$caseNoPara'";
        }
    
        $lmsRec =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_case_no as 'case_no', lb_br_code as 'br_code', lb_reco_amt as 'reco_amt',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name', lb_case_type as 'case_type',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_br_code='$brCode' $inCon");  
            return $lmsRec->result();      
    }  
    
    function lms_edit_cast_type_data_has($tracNo='', $caseNoPara = '', $brCode = '')
    {
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lct_tran_no ='$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND lct_case_no ='$caseNoPara'";
        }
    
        $lmsRec =  $this->db->query("select * 
            from [db_mis_LMS].[dbo].[lms_edit_caseType]
            where lct_br_code='$brCode' $inCon order by lct_data_id desc");  
            return $lmsRec->result();      
    }  
    
    function lms_caseType_edited_info_save_model()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
        
        $data = array(
            'lct_tran_no'  => $this->input->post('tracNoECTN'),
            'lct_case_no'	    => $this->input->post('caseNoECTN'),
            'lct_br_code'	=> $this->input->post('brCTN'),
            'lct_data_entry_date'	    => $insertDate,
            'lct_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'lct_date' 	=>  $this->input->post('DatecasetypeingEN'),
            'lct_case_type' 	=>  $this->input->post('caseTypeECTN'),
            'lct_ctRemarks' 	=>  $this->input->post('remarkscasetypeEN'),
            'lct_show_status'	    => 1
        );
        $lb_tbl_name = 'lms_edit_caseType';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_edit_file_keeper_data($tracNo='', $caseNoPara = '', $brCode = '')
    {
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lb_tran_no='$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND lb_case_no='$caseNoPara'";
        }
    
        $lmsRec =  $this->db->query("select lb_data_id, lb_tran_no as 'tran_no',
            lb_case_no as 'case_no', lb_br_code as 'br_code', lb_reco_amt as 'reco_amt',
            lb_loan_ac_no as 'loan_ac_no', lb_loan_ac_name as 'loan_ac_name', lb_case_type as 'case_type',
            lb_outstanding as 'outstanding', lb_suitValue_amt as 'claim_amt', lb_filing_date as 'filing_date',
            lb_case_no as 'case_no', lb_br_code as 'br_code'
            from [db_mis_LMS].[dbo].[lms_basic_details_info]
            where lb_br_code='$brCode' $inCon");  
            return $lmsRec->result();      
    }  

    function lms_edit_file_keeper_data_has($tracNo='', $caseNoPara = '', $brCode = '')
    {
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND lfk_tran_no = '$tracNo'";
        }
        if($caseNoPara !=''){
            $inCon.= " AND lfk_case_no = '$caseNoPara'";
        }
    
        $lmsRec =  $this->db->query("select *
            from [db_mis_LMS].[dbo].[lms_edit_fk]
            where lfk_br_code='$brCode' $inCon");  
            return $lmsRec->result();      
    }  

    function lms_pk_edited_info_save_model()
    {
        date_default_timezone_set("Asia/Dhaka");
        $insertDate = date("Y-m-d h:i:s");
        
        $data = array(
            'lfk_tran_no'  => $this->input->post('tracNoEPKN'),
            'lfk_case_no'	    => $this->input->post('caseNoPKN'),
            'lfk_br_code'	=> $this->input->post('brCTN'),
            'lfk_data_entry_date'	    => $insertDate,
            'lfk_data_sb_uid'	    => $this->session->userdata('some_uid'),
            'lfk_fk_date' 	=>  $this->input->post('DatefkEN'),
            'lfk_fk_bid' 	=>  $this->input->post('fileMaintOffBIDEN'),
            'lfk_fk_name' 	=>  $this->input->post('fileMaintOffNameEN'),
            'lfk_lawRemarks' 	=>  $this->input->post('remarkfkEN'),
            'lfk_show_status'	    => 1
        );
        $lb_tbl_name = 'lms_edit_fk';
        $legacy_db = $this->load->database('dblms', true);
        if($legacy_db->insert($lb_tbl_name, $data)){
			return 1;
		}else{
		return 0;
		}
    }

    function lms_court_type_data1()
    {
        $court_type =  $this->db->query("select * FROM [db_mis_LMS].[dbo].[lms_master_court_type_info] where lmct_ct_status=1 order by lmct_data_id");
        return $court_type->result();
    }
    function lms_case_category_data1()
    {
        $case_type =  $this->db->query("select * FROM [db_mis_LMS].[dbo].[lms_master_case_category_info] where lmcc_ct_status =1 order by lmcc_data_id");
        return $case_type->result();
    }
    function lms_subject_issue_data()
    {
        $subject_issue =  $this->db->query("select lc_data_id, sub_fact_issue_id, sub_fact_issue_desc FROM [db_mis_LMS].[dbo].[lms_components1] where sub_fact_issue_status =1 order by lc_data_id");
        return $subject_issue->result();
    }


    function lms_case_category_data_test()
    {
        $case_type =  $this->db->query("select * FROM [db_mis_LMS].[dbo].[lms_master_case_category_info1] where lmcc_ct_status =1 order by lmcc_data_id");
        return $case_type->result();
    }

    /** LMS Report start*/

    function fetch_all_office_array_lms($office_id=0, $report_option_id=0)
    {
        
        $data=array();
        $select='';
        $condition='';
        if($report_option_id==1)//my office
        {
          $status = $this->get_login_office_status($office_id);
          
          if($status==4){$condition=" WHERE jbbrcode='$office_id' ";$select=" distinct jbbrcode as office_id,BRANCH_NAME as office_name ";}//branch
          if($status==3){$condition=" WHERE ZoneCode='$office_id' ";$select=" distinct jbbrcode as office_id,BRANCH_NAME as office_name ";}//area
          if($status==2){$condition=" WHERE jbdivisioncode='$office_id' ";$select=" distinct ZoneCode as office_id,ZoneName as office_name ";}//division
          if($status==1){$condition=" WHERE jbdivisioncode not in ('7014')  "; $select=" distinct jbdivisioncode as office_id,DivisionName as office_name "; }//whole bank  
          
        }
        else if($report_option_id==2)//branch
        {
          $condition=" WHERE jbbrcode='$office_id' ";
          $select=" distinct jbbrcode as office_id,BRANCH_NAME as office_name ";   
        }
        else if($report_option_id==3)//area
        {
           $condition=" WHERE ZoneCode='$office_id' ";
           $select=" distinct jbbrcode as office_id,BRANCH_NAME as office_name ";  
        }
        else if($report_option_id==4)//divisional
        {
           $condition=" WHERE jbdivisioncode='$office_id' ";
           $select=" distinct ZoneCode as office_id,ZoneName as office_name ";  
        }

        else if($report_option_id==6)//divisional corp
        {
           $condition=" WHERE jbdivisioncode='$office_id' AND ZoneName LIKE '%CORP%' AND BRANCH_NAME LIKE '%CORP%'";
           $select=" distinct ZoneCode as office_id,ZoneName as office_name ";  
        }
        
        else if($report_option_id==5)//whole bank
        {
           $condition=" WHERE jbdivisioncode not in ('7014') ";
           $select=" distinct jbdivisioncode as office_id, DivisionName as office_name ";    
        }
        
        $Q =  $this->db->query("SELECT $select FROM [db_mis_LMS].[dbo].[vw_jb_div_zn_br]  $condition"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }
    function fetch_branch_array_for_report_module_lms($office_id=0, $report_option_id=0)
    {
        $data=array();
        $condition=" WHERE jbbrcode NOT IN(0931, 0932, 0933, 0934)";
        if($report_option_id==1)
        {
          $status=$this->get_login_office_status($office_id);
          if($status==4){$condition .=" AND jbbrcode='$office_id' ";}
          if($status==3){$condition .=" AND ZoneCode='$office_id' ";}
          if($status==2){$condition .=" AND jbdivisioncode='$office_id' ";}  
        }
        else if($report_option_id==2)
        {
          $condition .=" AND jbbrcode='$office_id' ";  
        }
        else if($report_option_id==3)
        {
           $condition .=" AND ZoneCode='$office_id' ";  
        }
        else if($report_option_id==4)
        {
           $condition .=" AND jbdivisioncode='$office_id' ";  
        }

        else if($report_option_id==6)
        {
           $condition .=" AND jbdivisioncode='$office_id' AND ZoneName LIKE '%CORP%' AND BRANCH_NAME LIKE '%CORP%'";  
        }
        
        $Q =  $this->db->query("SELECT jbbrcode, BRANCH_NAME FROM [db_mis_LMS].[dbo].[vw_jb_div_zn_br] $condition"); 
               
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }
    function fetch_lms_0001_data($branch_id_array_for_report=array(), $click_btn=0, $month = 0, $year=0){
    
        $day = '';
        $date_param = '';
        if($month == 4 || $month == 6 || $month == 9 || $month == 11 ){
            $day = '30';
        }
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            $day = '31';
        }
        if($month == 2){
            if((date('L', mktime(0, 0, 0, 1, 1, $year))==1)){
                $day = '29';
            }else{
                $day = '28';
            }
        }
        $date_param = $year."-".$month."-".$day;

        $count_in_branch = count($branch_id_array_for_report);
        
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con=" AND lb_br_code in (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        
        $rep_001 =  $this->db->query("select 
        writ_suitNo = COUNT(CASE  WHEN lb_category_id in ('1501', '1502', '1503', '1504', '1505', '1506', '1507', '1508', '1509', '1510') THEN lb_tran_no end),
        writ_suitAmt = CAST(sum(CASE  WHEN lb_category_id in ('1501', '1502', '1503', '1504', '1505', '1506', '1507', '1508', '1509', '1510') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        artha_suitNo = COUNT(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_tran_no end),
        artha_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        cetrificate_suitNo = COUNT(CASE  WHEN lb_category_id in ('5101') THEN lb_tran_no end),
        cetrificate_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('5101') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        insolvance_suitNo = COUNT(CASE  WHEN lb_category_id in ('3107') THEN lb_tran_no end),
        insolvance_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3107') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        money_suitNo = COUNT(CASE WHEN lb_category_id in ('3102') THEN lb_tran_no end),
        money_suitAmt = CAST(sum(CASE WHEN lb_category_id in ('3102') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        other_suitNo = COUNT(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2201', '2202', '2203', '2204', '2205', '2401', '2402', '1101', '1102', '1103', '1104', '1105',
        '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', '1304',
        '1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319',
        '1401', '1402', '1403', '1404', '1405', '1406', '1407', '1408', '1409', '1410', '1411', '1412', '1413', '1414', '1415',
        '1416', '1417', '1418', '1419', '1420', '1421', '1422', '1423', '1424', '1425', '3101', '3103', '3109', '3110',
        '3111', '3112', '3113', '3114', '3115', '3116', '3117', '3118', '3119', '3120', '3121', '3122', '3123', '3124', '3125',
        '4101', '4102', '4103', '4104', '4105', '4106', '4107') THEN lb_tran_no end),
        other_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2201', '2202', '2203', '2204', '2205', '2401', '2402', '1101', '1102', '1103', '1104', '1105',
        '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', '1304',
        '1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319',
        '1401', '1402', '1403', '1404', '1405', '1406', '1407', '1408', '1409', '1410', '1411', '1412', '1413', '1414', '1415',
        '1416', '1417', '1418', '1419', '1420', '1421', '1422', '1423', '1424', '1425', '3101', '3103', '3109', '3110',
        '3111', '3112', '3113', '3114', '3115', '3116', '3117', '3118', '3119', '3120', '3121', '3122', '3123', '3124', '3125',
        '4101', '4102', '4103', '4104', '4105', '4106', '4107') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2))
        from [db_mis_LMS].[dbo].[lms_basic_details_info]
        where lb_filing_date <= convert(datetime, '$date_param', 121) $IN_con 
        and lb_tran_no not in (select lbdis_tran_no from [db_mis_LMS].[dbo].[lms_basic_disposal_info] )");
       
        return $rep_001->row_array();

    }

    function fetch_lms_0002_data($branch_id_array_for_report=array(), $click_btn=0, $month = 0, $year=0, $case=0){           
    
        $day = '';
        $date_param = '';
        if($month == 4 || $month == 6 || $month == 9 || $month == 11 ){
            $day = '30';
        }
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            $day = '31';
        }
        if($month == 2){
            if((date('L', mktime(0, 0, 0, 1, 1, $year))==1)){
                $day = '29';
            }else{
                $day = '28';
            }
        }
        $date_param = $year."-".$month."-".$day;
        
        
        $case_con = '';
        $case_con.= "('$case')";
        $count_in_branch = count($branch_id_array_for_report);    
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con=" (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $rep_002 =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode, b.lb_tran_no, b.lb_case_no, b.lb_court_type, b.lb_category_id, 
        b.lb_filing_date, b.lb_issue, b.lb_issue_writ, b.lb_loan_ac_name, b.lb_suitValue_amt, b.lb_lawyer_id, b.lb_brcode_fho
        FROM [Db_DP_Collection_mgr].[dbo].[allinformation] AS a JOIN( 
        select * from [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_category_id in $case_con
        ) b ON b.lb_brcode_fho=a.brcode OR b.lb_br_code = a.brcode 
        where
        lb_filing_date <= convert(datetime, '$date_param', 121)
        AND a.brcode in $IN_con AND b.lb_tran_no not in (select lbdis_tran_no from [db_mis_LMS].[dbo].[lms_basic_disposal_info])");
               
        return $rep_002->result_array();

    }

    function date_to_month($month=0, $year=0){
        $day= '';
        if($month == 4 || $month == 6 || $month == 9 || $month == 11 ){
            $day = '30';
        }
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            $day = '31';
        }
        if($month == 2){
            if((date('L', mktime(0, 0, 0, 1, 1, $year))==1)){
                $day = '29';
            }else{
                $day = '28';
            }
        }
        return $day;
    }
    function fetch_lms_0005_data($branch_id_array_for_report=array(), $click_btn=0, $month1 = 0, $year1=0, $month2 = 0, $year2=0){           
    
        $day1 = '';
        $date_param1 = '';

        $day2 = '';
        $date_param2 = '';
        
        $day1 = $this->date_to_month($month1, $year1);
        $date_param1 = $year1."-".$month1."-".$day1;

        $day2 = $this->date_to_month($month2, $year2);
        $date_param2 = $year2."-".$month2."-".$day2;
        
        $date_para = '';
        $date_para = "b.lbpp_followup_date >= convert(datetime, '$date_param1', 121) 
		AND b.lbpp_followup_date <= convert(datetime, '$date_param2', 121)";
        
        $count_in_branch = count($branch_id_array_for_report);    
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con=" (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $rep_005 =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode, b.lbpp_tran_no, b.lbpp_case_no, b.lbpp_date_of_position,
        b.lbpp_followup_date, b.lbpp_present_position, c.lmpp_pp_desc_l2, d.lb_lawyer_id
        FROM [Db_DP_Collection_mgr].[dbo].[allinformation] a 
        JOIN
        ( 
            select * from [db_mis_LMS].[dbo].[lms_basic_present_position_info] 
        ) b ON b.lbpp_br_code = a.brcode 
        JOIN(
            select * from [db_mis_LMS].[dbo].[lms_master_case_pp_info] 
        ) c ON c.lmpp_pp_id_l2 = b.lbpp_present_position
        JOIN(
        select * from [db_mis_LMS].[dbo].[lms_basic_details_info]
        ) d ON d.lb_tran_no = b.lbpp_tran_no 
        where $date_para
        AND a.brcode in $IN_con AND b.lbpp_br_code not in 
        (select lbdis_tran_no from [db_mis_LMS].[dbo].[lms_basic_disposal_info])");
               
        return $rep_005->result_array();

    }

    function fetch_lms_0004_data($branch_id_array_for_report=array(), $click_btn=0, $month1 = 0, $year1=0, $month2 = 0, $year2=0){           
    
        $day1 = '';
        $date_param1 = '';

        $day2 = '';
        $date_param2 = '';
        
        $day1 = $this->date_to_month($month1, $year1);
        $date_param1_pre = $year1."-".$month1."-"."1";
        $date_param1_next = $year1."-".$month1."-".$day1;

        $day2 = $this->date_to_month($month2, $year2);
        $date_param2_pre = $year2."-".$month2."-"."1";
        $date_param2_next = $year2."-".$month2."-".$day2;

        
        $yearPre = '';
        $monthPre = '';
        $dayPre = '';
        $preDate = '';
        if($month1 == 1){
            $yearPre = ($year1-1);
            $monthPre = 12;
            $dayPre = $this->date_to_month($month1, $year1);
        }else{
        $yearPre = ($year1);
        $monthPre = ($month1-1);
        $dayPre = $this->date_to_month($monthPre, $year1);
        }
        $preDate = $yearPre."-".$monthPre."-".$dayPre;

        $count_in_branch = count($branch_id_array_for_report);    
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con=" (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        
        $rep_004 =  $this->db->query("select  a.Subject,
        [bDuNo] = count(case when --b.lb_filing_date >= convert(datetime, '2018-01-01', 121) AND 
                               b.lb_filing_date <= convert(datetime, '$preDate', 121) 
                           then isnull(b.Subject,0) end),
    [bDuAmt]=sum(case when  --b.lb_filing_date >= convert(datetime, '2018-01-01', 121) AND
                                 b.lb_filing_date <= convert(datetime, '$preDate', 121)  
                           then isnull(b.lb_suitValue_amt,0) else 0 end),
    [betDSFNo]=count(case when  a.lb_filing_date >= convert(datetime, '$date_param1_pre', 121)
                                 AND a.lb_filing_date <= convert(datetime, '$date_param2_next', 121) 
                           then isnull(a.Subject,0) end),
    [betDSFAmt]=sum(case when  a.lb_filing_date >= convert(datetime, '$date_param1_pre', 121)
                                 AND a.lb_filing_date <= convert(datetime, '$date_param2_next', 121)  
                           then isnull(a.lb_suitValue_amt,0) else 0 end),
   [betuDSFNo]=count(case when  a.lb_filing_date >= convert(datetime, '$date_param1_pre', 121)
                                 AND a.lb_filing_date <= convert(datetime, '$date_param2_next', 121) and b.lb_tran_no is null
                           then isnull(a.Subject,0) end),
   [betuDSFAmt]=sum(case when  a.lb_filing_date >= convert(datetime, '$date_param1_pre', 121)
                                 AND a.lb_filing_date <= convert(datetime, '$date_param2_next', 121)  and b.lb_tran_no is null
                           then isnull(a.lb_suitValue_amt,0) else 0 end),
   [asOnuDSFNo]=count(case when  b.lb_filing_date >= convert(datetime, '$date_param1_pre', 121)
                                 AND b.lb_filing_date <= convert(datetime, '$date_param2_next', 121) 
                           then isnull(b.Subject,0) end),
    [asOnuDSFAmt]=sum(case when  b.lb_filing_date >= convert(datetime, '$date_param1_pre', 121)
                                 AND b.lb_filing_date <= convert(datetime, '$date_param2_next', 121)  
                           then isnull(b.lb_suitValue_amt,0) else 0 end)					    				    
from 
(SELECT *, case when lb_category_id in ('3104', '3105', '3106')  then '1' --'Artho Rin Suit'
                    when lb_category_id in ('1501', '1502', '1503')  then '2' --'Writ Petition'
                    when lb_category_id in ('2101', '2102', '2103', '2104', '2203', '2204', '2205', '1101', '1102', '1103', '1104', '1105', '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', '1304','1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319')  then '3' --'Appeal and Review Suit'
                    when lb_category_id in ('3107')  then '4' --'Insolvance'
                    when lb_court_type in ('401', '402', '408')  then '5' --'Adminsstrtaive'
                    when lb_category_id in ('3119', '3112', '3125')  then '6' --'Misc. Suit'
                    when lb_category_id in ('3108', '5101')  then '8' --'PDR'
                    when lb_category_id in ('3101','3102','3103','3108','3109','3110','3111','3114','3115')  then 'Civil Suit'
                        else '9' --'Other Suit'
              end  as Subject  		               
                     FROM [db_mis_LMS].[dbo].[lms_basic_details_info]) a 						  
       left  join 		  
   (SELECT  *, case when lb_category_id in ('3104', '3105', '3106')  then '1' --'Artho Rin Suit'
                    when lb_category_id in ('1501', '1502', '1503')  then '2' --'Writ Petition'
                    when lb_category_id in ('2101', '2102', '2103', '2104', '2203', '2204', '2205', '1101', '1102', '1103', '1104', '1105', '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', '1304','1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319')  then '3' --'Appeal and Review Suit'
                    when lb_category_id in ('3107')  then '4' --'Insolvance'
                    when lb_court_type in ('401', '402', '408')  then '5' --'Adminsstrtaive'
                    when lb_category_id in ('3119', '3112', '3125')  then '6' --'Misc. Suit'
                    when lb_category_id in ('3108', '5101')  then '8' --'PDR'
                    when lb_category_id in ('3101','3102','3103','3108','3109','3110','3111','3114','3115')  then 'Civil Suit'
                        else '9' --'Other Suit'
              end  as Subject  		               
                     FROM [db_mis_LMS].[dbo].[lms_basic_details_info] where lb_tran_no not in (
                       SELECT lbdis_tran_no FROM [db_mis_LMS].[dbo].[lms_basic_disposal_info])
                       ) b 
                       on a.lb_tran_no=b.lb_tran_no 
                       AND a.lb_br_code in $IN_con
               group by a.Subject");
        return $rep_004->result_array();

    }
    function fetch_lms_0006_data($branch_id_array_for_report=array(), $click_btn=0, $month = 0, $year=0){
    
        $day = '';
        $date_param = '';
        if($month == 4 || $month == 6 || $month == 9 || $month == 11 ){
            $day = '30';
        }
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            $day = '31';
        }
        if($month == 2){
            if((date('L', mktime(0, 0, 0, 1, 1, $year))==1)){
                $day = '29';
            }else{
                $day = '28';
            }
        }
        $date_param = $year."-".$month."-".$day;

        $count_in_branch = count($branch_id_array_for_report);
        
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con=" AND lb_br_code in (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        
        $rep_006 =  $this->db->query("select 
        artha_suitNo = COUNT(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_tran_no end),
        artha_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        writ_suitNo = COUNT(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_tran_no end),
        writ_suitAmt = CAST(sum(CASE  WHEN lb_category_id in ('1501', '1502', '1503', '1504', '1505', '1506', '1507', '1508', '1509', '1510') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        appeal_review_suitNo = COUNT(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2203', '2204', '2205', '1101', '1102', 
		'1103', '1104', '1105', '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', 
		'1304','1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319') THEN lb_tran_no end),
        appeal_review_suitAmt = CAST(sum(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2203', '2204', '2205', '1101', '1102', 
		'1103', '1104', '1105', '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', 
		'1304','1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        insolvance_suitNo = COUNT(CASE  WHEN lb_category_id in ('3107') THEN lb_tran_no end),
        insolvance_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3107') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        administrative_suitNo = COUNT(CASE  WHEN lb_court_type in ('401', '402', '408') THEN lb_tran_no end),
        administrative_suitAmt=CAST(sum(CASE  WHEN lb_court_type in ('401', '402', '408') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        civil_suitNo = COUNT(CASE  WHEN lb_category_id in ('3101','3102','3103','3108','3109','3110','3111','3114','3115') THEN lb_tran_no end),
        civil_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3101','3102','3103','3108','3109','3110','3111','3114','3115') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        misc_suitNo = COUNT(CASE  WHEN lb_category_id in ('3119', '3112', '3125') THEN lb_tran_no end),
        misc_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3119', '3112', '3125') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        pdr_suitNo = COUNT(CASE  WHEN lb_category_id in ('5101') THEN lb_tran_no end),
        pdr_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('5101') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),

        other_suitNo = COUNT(CASE  WHEN lb_category_id in ('2201', '2202', '2401', '2402', 
        '1401', '1402', '1403', '1404', '1405', '1406', '1407', '1408', '1409', '1410', '1411', '1412', '1413', '1414', '1415',
        '1416', '1417', '1418', '1419', '1420', '1421', '1422', '1423', '1424', '1425', '3113', 
		'3116', '3117', '3118', '3120', '3121', '3122', '3123', '3124',
        '4101', '4102', '4103', '4104', '4105', '4106', '4107') THEN lb_tran_no end),
        other_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2201', '2202', '2203', '2204', '2205', '2401', '2402', '1101', '1102', '1103', '1104', '1105',
        '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', '1304',
        '1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319',
        '1401', '1402', '1403', '1404', '1405', '1406', '1407', '1408', '1409', '1410', '1411', '1412', '1413', '1414', '1415',
        '1416', '1417', '1418', '1419', '1420', '1421', '1422', '1423', '1424', '1425', '3101', '3103', '3109', '3110',
        '3111', '3112', '3113', '3114', '3115', '3116', '3117', '3118', '3119', '3120', '3121', '3122', '3123', '3124', '3125',
        '4101', '4102', '4103', '4104', '4105', '4106', '4107') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2))
        from [db_mis_LMS].[dbo].[lms_basic_details_info]
        where lb_filing_date <= convert(datetime, '$date_param', 121) $IN_con 
        and lb_tran_no not in (select lbdis_tran_no from [db_mis_LMS].[dbo].[lms_basic_disposal_info] )");

        echo "select 
        artha_suitNo = COUNT(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_tran_no end),
        artha_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        writ_suitNo = COUNT(CASE  WHEN lb_category_id in ('3104', '3105', '3106') THEN lb_tran_no end),
        writ_suitAmt = CAST(sum(CASE  WHEN lb_category_id in ('1501', '1502', '1503', '1504', '1505', '1506', '1507', '1508', '1509', '1510') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        appeal_review_suitNo = COUNT(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2203', '2204', '2205', '1101', '1102', 
		'1103', '1104', '1105', '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', 
		'1304','1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319') THEN lb_tran_no end),
        appeal_review_suitAmt = CAST(sum(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2203', '2204', '2205', '1101', '1102', 
		'1103', '1104', '1105', '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', 
		'1304','1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        insolvance_suitNo = COUNT(CASE  WHEN lb_category_id in ('3107') THEN lb_tran_no end),
        insolvance_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3107') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        administrative_suitNo = COUNT(CASE  WHEN lb_court_type in ('401', '402', '408') THEN lb_tran_no end),
        administrative_suitAmt=CAST(sum(CASE  WHEN lb_court_type in ('401', '402', '408') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        civil_suitNo = COUNT(CASE  WHEN lb_category_id in ('3101','3102','3103','3108','3109','3110','3111','3114','3115') THEN lb_tran_no end),
        civil_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3101','3102','3103','3108','3109','3110','3111','3114','3115') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        misc_suitNo = COUNT(CASE  WHEN lb_category_id in ('3119', '3112', '3125') THEN lb_tran_no end),
        misc_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('3119', '3112', '3125') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),
        pdr_suitNo = COUNT(CASE  WHEN lb_category_id in ('5101') THEN lb_tran_no end),
        pdr_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('5101') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2)),

        other_suitNo = COUNT(CASE  WHEN lb_category_id in ('2201', '2202', '2401', '2402', 
        '1401', '1402', '1403', '1404', '1405', '1406', '1407', '1408', '1409', '1410', '1411', '1412', '1413', '1414', '1415',
        '1416', '1417', '1418', '1419', '1420', '1421', '1422', '1423', '1424', '1425', '3113', 
		'3116', '3117', '3118', '3120', '3121', '3122', '3123', '3124',
        '4101', '4102', '4103', '4104', '4105', '4106', '4107') THEN lb_tran_no end),
        other_suitAmt=CAST(sum(CASE  WHEN lb_category_id in ('2101', '2102', '2103', '2104', '2201', '2202', '2203', '2204', '2205', '2401', '2402', '1101', '1102', '1103', '1104', '1105',
        '1106', '1107', '1108', '1109', '1201', '1202', '1203', '1204', '1205', '1206', '1207', '1301', '1302', '1303', '1304',
        '1305', '1306', '1307', '1308', '1309', '1310', '1311', '1312', '1313', '1314', '1315', '1316', '1317', '1318', '1319',
        '1401', '1402', '1403', '1404', '1405', '1406', '1407', '1408', '1409', '1410', '1411', '1412', '1413', '1414', '1415',
        '1416', '1417', '1418', '1419', '1420', '1421', '1422', '1423', '1424', '1425', '3101', '3103', '3109', '3110',
        '3111', '3112', '3113', '3114', '3115', '3116', '3117', '3118', '3119', '3120', '3121', '3122', '3123', '3124', '3125',
        '4101', '4102', '4103', '4104', '4105', '4106', '4107') THEN lb_suitValue_amt else 0 end) AS NUMERIC(18, 2))
        from [db_mis_LMS].[dbo].[lms_basic_details_info]
        where lb_filing_date <= convert(datetime, '$date_param', 121) $IN_con 
        and lb_tran_no not in (select lbdis_tran_no from [db_mis_LMS].[dbo].[lms_basic_disposal_info] )";
        die();
       
        return $rep_006->row_array();

    }

    function lms_single_view_data($tracNo='', $caseNoNS='', $branch_id_array_for_report = array())
    {
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_bcon='';
        if($count_in_branch>0)
        {
            $IN_bcon="AND a.lb_br_code IN (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_bcon .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_bcon .=",";}
            }
            $IN_bcon .=")";
        }
        $inCon = '';
        if($tracNo !=''){
            $inCon.= " AND a.lb_tran_no='$tracNo'";
        }
        if($caseNoNS !=''){
            $inCon.= " AND a.lb_case_no='$caseNoNS'";
        }
 
        $lmseditinfo =  $this->db->query("select d.branchname, a.*, b.lmct_ct_desc_l3, c.lmcc_cc_id_l3, c.lmcc_cc_desc_l3 
        from [db_mis_LMS].[dbo].[lms_basic_details_info] a, 
        [db_mis_LMS].[dbo].[lms_master_court_type_info] b,
        [db_mis_LMS].[dbo].[lms_master_case_category_info1] c,
        [Db_DP_Collection_mgr].[dbo].[allinformation] d
        where a.lb_court_type = b.lmct_ct_id_l3 AND a.lb_category_id = c.lmcc_cc_id_l3 AND
        a.lb_br_code = d.brcode
        $IN_bcon $inCon order by a.lb_data_id");

        return $lmseditinfo->result();
    }
    
    function lms_single_view_other_data($tracNo='', $caseNoNS='', $branch_id_array_for_report = array())
    {
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_bcon='';
        if($count_in_branch>0)
        {
            $IN_bcon="AND a.lb_br_code IN (";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_bcon .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_bcon .=",";}
            }
            $IN_bcon .=")";
        }

        $inCon = '';
        if($tracNo !=''){
            $inCon.= "lb_tran_no_other='$tracNo'";
        }
        
 
        $lmseditinfo =  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_basic_details_info] 
        where $inCon");
        if(count($lmseditinfo->result())>0){
            return $lmseditinfo->result();
        }else{
            return false;
        }
        
    }

    function get_login_office_status($office_id=0)
    {
        $office_status=0;
        $key='';
        $Q =  $this->db->query("SELECT * FROM vw_jb_div_zn_br where jbdivisioncode=".$office_id." OR ZoneCode=".$office_id." OR jbbrcode=".$office_id." ");  
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $key = array_search($office_id, $row);
          } 
        }

        if($key=='jbbrcode')
        {
            $office_status=4;
        }
        elseif($key=='ZoneCode')
        {
           $office_status=3; 
        }
        elseif($key=='jbdivisioncode')
        {
           $office_status=2; 
        }
        else
        {
           $office_status=1; 
        }
		
		$file_no=$this->session->userdata('some_uid');
		if(strtoupper(substr($file_no,0,4))=='DMD-' || strtoupper(substr($file_no,0,3))=='GM-' || strtoupper(substr($file_no,0,4))=='DGM-'){$office_status=1;}
		return $office_status;
    }

    function fetch_br_ao_do_lb($br_ao_do=0, $br_ao_do_str='')
    {
        $select='';
        $like_str='';
        if($br_ao_do==2)
        {
            $select=' jbbrcode, BRANCH_NAME ';
            $like_str=' BRANCH_NAME ';
        }
        
        if($br_ao_do==3)
        {
            $select=' ZoneCode,ZoneName ';
            $like_str=' ZoneName ';
        }
        
        if($br_ao_do==4)
        {
            $select=' jbdivisioncode,DivisionName ';
            $like_str=' DivisionName ';
        }
        if($br_ao_do==6)
        {
            $select=' jbdivisioncode,DivisionName ';
            $like_str=' DivisionName ';
        }
        
        $data=array();
        $Q =  $this->db->query("SELECT DISTINCT $select FROM vw_jb_div_zn_br WHERE $like_str LIKE '$br_ao_do_str%'"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }

    function fetch_br_ao_do_lms($br_ao_do=0, $br_ao_do_str='', $off_id=0, $office_status=0)
    {
        $select='';
        $like_str='';
        $office_id='';
        if($br_ao_do==2)
        {
            $select=' jbbrcode, BRANCH_NAME ';
            $like_str=' BRANCH_NAME ';
            if($office_status == 4){$office_id=' jbbrcode ';}
            if($office_status ==3){$office_id=' ZoneCode ';}
            if($office_status ==2){$office_id=' jbdivisioncode ';}
        }
        
        if($br_ao_do==3)
        {
            $select=' ZoneCode, ZoneName ';
            $like_str=' ZoneName ';
            if($office_status ==3){$office_id=' ZoneCode ';}
            if($office_status ==2){$office_id=' jbdivisioncode ';}
        }
        
        if($br_ao_do==4)
        {
            $select=' jbdivisioncode, DivisionName ';
            $like_str=' DivisionName ';
            if($office_status ==2){$office_id=' jbdivisioncode ';}
        }
        $data=array();
        if($office_status == 1){
            $Q =  $this->db->query("SELECT DISTINCT $select FROM vw_jb_div_zn_br WHERE $like_str LIKE '$br_ao_do_str%'"); 
        }else{
            $Q =  $this->db->query("SELECT DISTINCT $select FROM vw_jb_div_zn_br WHERE $like_str LIKE '$br_ao_do_str%' AND $office_id='$off_id'"); 
        }
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }

/*-------------------------------------------- sohag ---------------------------------------------------------------------------------*/  
function lms_master_data()
{
    $master_data_cat=  $this->db->query("select * from [db_mis_LMS].[dbo].[lms_master_court_type_info]  order by lmct_data_id");
    return $master_data_cat->result();
    
}


function master_data_view_info($menu_id=0)
{
    
   
    if($menu_id==6)
    {
       $qr='select * from [db_mis_LMS].[dbo].[lms_master_dis_nature_info]  order by lmdn_dn_id';
    }
    
    else if($menu_id==5)
    {
       $qr='select * from [db_mis_LMS].[dbo].[lms_master_exp_type_info]  order by lmet_et_id';  
    }
    else if($menu_id==4)
    {
       $qr='select * from [db_mis_LMS].[dbo].[lms_master_case_pp_info]  order by lmpp_data_id';  
    }
    else if($menu_id==3)
    {
       $qr='select * from [db_mis_LMS].[dbo].[lms_master_lawyer_info]  order by lml_lawyer_id';  
    }
    else if($menu_id==2)
    {
       $qr='select * from [db_mis_LMS].[dbo].[lms_master_case_category_info]  order by lmcc_data_id';  
    }
    else if($menu_id==1)
    {
       $qr='select * from [db_mis_LMS].[dbo].[lms_master_court_type_info]  order by lmct_data_id';  
    }
    
    $data= $this->db->query($qr);
    
    return $data->result_array();        
    
    
}

function lms_court_type_db_delete($court_id=0)
{   
    $status=0;
    if($court_id>0)
    {
        
        $this->db->query("delete from [db_mis_LMS].[dbo].[lms_master_court_type_info]  where lmct_data_id=$court_id");
        $status=1;
    }
    return $status;                  
}
    
function lms_court_type_db_add($lmct_l1=0,$lmct_desc1='',$lmct_l2=0,$lmct_desc2='',$lmct_l3=0,$lmct_desc3='')
{
   $status=0;
    if($lmct_l1>0)
    {
        $this->db->query("insert into [db_mis_LMS].[dbo].[lms_master_court_type_info] values ($lmct_l1,$lmct_desc1,$lmct_l2,$lmct_desc2,$lmct_l3,$lmct_desc3,1)");
        
         $Q = $this->db->query("select MAX(lmct_data_id) as id FROM [db_mis_LMS].[dbo].[lms_master_court_type_info]");
      
        if($Q->num_rows()>0)
            {
             $res= $Q->result();    
            }  
    
        $status=$res[0]->id;
                
    }
   return $status; 
}
   
function lms_court_type_db_update($lmct_l1=0,$lmct_desc1='',$lmct_l2=0,$lmct_desc2='',$lmct_l3=0,$lmct_desc3='',$court_id=0)
{
    
  $status=0;
    if($court_id>0)
    {
        $this->db->query("update [db_mis_LMS].[dbo].[lms_master_court_type_info] set lmct_ct_id_l1=$lmct_l1,lmct_ct_desc_l1=$lmct_desc1,lmct_ct_id_l2=$lmct_l2,lmct_ct_desc_l2=$lmct_desc2,lmct_ct_id_l3=$lmct_l3,lmct_ct_desc_l3=$lmct_desc3,lmct_ct_status=1 where lmct_data_id=$court_id");
        $status=1;
    }
    return $status; 
}

///// case category add//////

function lms_case_cat_db_add($lmcc_l1=0,$lmcc_desc1='',$lmcc_l2=0,$lmcc_desc2='',$lmcc_l3=0,$lmcc_desc3='')
{
   $status=0;
    if($lmcc_l1>0)
    {
        $this->db->query("insert into [db_mis_LMS].[dbo].[lms_master_case_category_info] values ($lmcc_l1,$lmcc_desc1,$lmcc_l2,$lmcc_desc2,$lmcc_l3,$lmcc_desc3,1)");
        
         $Q = $this->db->query("select MAX(lmcc_data_id) as id FROM [db_mis_LMS].[dbo].[lms_master_case_category_info]");
      
        if($Q->num_rows()>0)
            {
             $res= $Q->result();    
            }  
    
        $status=$res[0]->id;
                
    }
   return $status; 
}

function lms_case_cat_db_delete($cse_id=0)
{
  $status=0;
    if($cse_id>0)
    {
        
        $this->db->query("delete from [db_mis_LMS].[dbo].[lms_master_case_category_info]  where lmcc_data_id=$cse_id");
        $status=1;
    }
    return $status;  
}


function lms_case_cat_db_update($lmcc_l1=0,$lmcc_desc1='',$lmcc_l2=0,$lmcc_desc2='',$lmcc_l3=0,$lmcc_desc3='',$case_id=0)
{
    
  $status=0;
    if($case_id>0)
    {
        $this->db->query("update [db_mis_LMS].[dbo].[lms_master_case_category_info] set lmcc_cc_id_l1=$lmcc_l1,lmcc_cc_desc_l1=$lmcc_desc1,lmcc_cc_id_l2=$lmcc_l2,lmcc_cc_desc_l2=$lmcc_desc2,lmcc_cc_id_l3=$lmcc_l3,lmcc_cc_desc_l3=$lmcc_desc3,lmcc_ct_status=1 where lmcc_data_id=$case_id");
        $status=1;
    }
    return $status; 
}
///////////// lawyer information/////////

function lms_lawyer_info_db_add($lw_id=0,$lw_name='',$lw_mob=0,$lw_dist='',$lw_div='',$lw_pos='',$lw_pos_id=0)
{
   $status=0;
    if($lw_id>0)
    {
        $this->db->query("insert into [db_mis_LMS].[dbo].[lms_master_lawyer_info] values ($lw_id,$lw_name,$lw_mob,$lw_dist,$lw_div,$lw_pos,$lw_pos_id,'',1)");
        
         $Q = $this->db->query("select MAX(lml_lawyer_id) as id FROM [db_mis_LMS].[dbo].[lms_master_lawyer_info]");
      
        if($Q->num_rows()>0)
            {
             $res= $Q->result();    
            }  
    
        $status=$res[0]->id;
                
    }
   return $status;  
}


function lms_lawyer_info_db_update($lawyer_pev_id=0,$lw_id=0,$lw_name='',$lw_mob=0,$lw_dist='',$lw_div='',$lw_pos='',$lw_pos_id=0)
{
 $status=0;
    if($lw_id>0)
    {
        $this->db->query("update [db_mis_LMS].[dbo].[lms_master_lawyer_info] set lml_lawyer_id=$lw_id,lml_lawyer_name=$lw_name,lml_lawyer_mobile=$lw_mob,lml_lawyer_district=$lw_dist,lml_lawyer_division=$lw_div,lml_lawyer_advPosition=$lw_pos,lml_lawyer_advPosID=$lw_pos_id,lml_lawyer_appoint_date='',lml_show_status=1 where lml_lawyer_id=$lawyer_pev_id");
        $status=1;
        
    }
    return $status;    
    
}


function lms_lawyer_info_db_delete($lawyer_id=0)
{
    $status=0;
    if($lawyer_id>0)
    {
        
        $this->db->query("delete from [db_mis_LMS].[dbo].[lms_master_lawyer_info]  where lml_lawyer_id=$lawyer_id");
        $status=1;
    }
    return $status;
}

//////////////////////////// Current Status  ////////////////////

function lms_current_status_db_add($cr_st_id=0,$cr_st_desc='',$cr_st_id_2=0,$cr_st_desc_2='')
{
   $status=0;
    if($cr_st_id>0)
    {
        $this->db->query("insert into [db_mis_LMS].[dbo].[lms_master_case_pp_info] values ($cr_st_id,$cr_st_desc,$cr_st_id_2,$cr_st_desc_2,1)");
        
         $Q = $this->db->query("select MAX(lmpp_pp_id_l1) as id FROM [db_mis_LMS].[dbo].[lms_master_case_pp_info]");
      
        if($Q->num_rows()>0)
            {
             $res= $Q->result();    
            }  
    
        $status=$res[0]->id;
                
    }
   return $status;  
}

function lms_current_status_db_delete($lmpp_pp_id_l2=0)
{
  $status=0;
    if($lmpp_pp_id_l2>0)
    {
        
        $this->db->query("delete from [db_mis_LMS].[dbo].[lms_master_case_pp_info]  where lmpp_pp_id_l2=$lmpp_pp_id_l2");
        $status=1;
    }
    return $status;  
    
}


function lms_current_status_db_update($lmpp_pp_id_l2=0,$cr_st_id=0,$cr_st_desc='',$cr_st_id_2=0,$cr_st_desc_2='')
{
   $status=0;
    if($lmpp_pp_id_l2>0)
    {
        $this->db->query("update [db_mis_LMS].[dbo].[lms_master_case_pp_info] set lmpp_pp_id_l1=$cr_st_id,lmpp_pp_desc_l1=$cr_st_desc,lmpp_pp_id_l2=$cr_st_id_2,lmpp_pp_desc_l2=$cr_st_desc_2,lmpp_pp_status=1 where lmpp_data_id=$lmpp_pp_id_l2");
        $status=1;
        
    }
    return $status;  
    
}

/////////////////////////// Expense Info //////////////////////

function lms_expense_type_db_add($exp_typ_id=0,$exp_typ_desc='')
{
    $status=0;
    if($exp_typ_id>0)
    {
        $this->db->query("insert into [db_mis_LMS].[dbo].[lms_master_exp_type_info] values ($exp_typ_id,$exp_typ_desc,1)");
        
         $Q = $this->db->query("select MAX(lmet_et_id) as id FROM [db_mis_LMS].[dbo].[lms_master_exp_type_info]");
      
        if($Q->num_rows()>0)
            {
             $res= $Q->result();    
            }  
    
        $status=$res[0]->id;
                
    }
   return $status;  
    
}

function lms_expense_type_db_update($lmt_data_id=0,$lmt_et_id=0,$lmt_et_desc='')
{
    $status=0;
    if($lmt_data_id>0)
    {
        $this->db->query("update [db_mis_LMS].[dbo].[lms_master_exp_type_info] set lmet_et_id=$lmt_et_id,lmet_et_desc=$lmt_et_desc,lmet_et_status=1 where lmet_data_id=$lmt_data_id");
        $status=1;
        
    }
    return $status;  
    
}

function lms_expense_type_db_delete($inc_id=0)
{
  $status=0;
    if($inc_id>0)
    {
        
        $this->db->query("delete from [db_mis_LMS].[dbo].[lms_master_exp_type_info]  where lmet_data_id=$inc_id");
        $status=1;
    }
    return $status;   
}

function lms_disposal_nature_db_add($disp_nat_id=0,$disp_nat_desc='')
{
    $status=0;
    if($disp_nat_id>0)
    {
        $this->db->query("insert into [db_mis_LMS].[dbo].[lms_master_dis_nature_info] values ($disp_nat_id,$disp_nat_desc,1)");
        
         $Q = $this->db->query("select MAX(lmdn_data_id) as id FROM [db_mis_LMS].[dbo].[lms_master_dis_nature_info]");
      
        if($Q->num_rows()>0)
            {
             $res= $Q->result();    
            }  
    
        $status=$res[0]->id;
                
    }
   return $status;  
    
}


function lms_disposal_nature_db_update($lmt_data_id=0,$lmt_disp_id=0,$lmt_disp_desc='')
{
    $status=0;
    if($lmt_data_id>0)
    {
        $this->db->query("update [db_mis_LMS].[dbo].[lms_master_dis_nature_info] set lmdn_dn_id=$lmt_disp_id,lmdn_dn_desc=$lmt_disp_desc,lmdn_dn_status=1 where lmdn_data_id=$lmt_data_id");
        $status=1;
        
    }
    return $status;  
}


function lms_disposal_nature_db_delete($inc_id=0)
{
    $status=0;
    if($inc_id>0)
    {
        
        $this->db->query("delete from [db_mis_LMS].[dbo].[lms_master_dis_nature_info]  where lmdn_data_id=$inc_id");
        $status=1;
    }
    return $status; 
    
}  
/*---------------------------------------------sohag end -----------------------------------------------------------------------------*/


    /** LMS Report end*/
    /** 
     * LMS end
    */

    // function lms_tost_data(){
    //     $legacy_db = $this->load->database('dblms', true);
        
    //     $Q =  $legacy_db->query("select MAX(lmct_data_id) as id from [dbo].[lms_master_court_type_info]"); 
        
    //     if($Q->num_rows>0){
    //         $res = $Q->result();
    //     }
    //     echo $res[0]->id;
    //     die();
    // }
}
?>