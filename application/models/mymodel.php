<?php
class Mymodel extends CI_Model {
 
    var $title   = '';
     var $content = '';
     var $date    = '';
 
    function __construct()
     {
         // Call the Model constructor
         parent::__construct();
     }
     /*
     function get_last_ten_entries()
     {
         $query = $this->db->get('entries', 10);
         return $query->result();
     }
 
    function insert_entry()
     {
         $this->title   = $_POST['title']; // please read the below note
         $this->content = $_POST['content'];
         $this->date    = time();
 
        $this->db->insert('entries', $this);
     }
 
    function update_entry()
     {
         $this->title   = $_POST['title'];
         $this->content = $_POST['content'];
         $this->date    = time();
 
        $this->db->update('entries', $this, array('id' => $_POST['id']));
     }
     */
     function me()
     {
     	return "abcdefgh";
     }
	 
	 public function set_news()
	{
		$this->load->helper('url');
		
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		
		$data = array(
			'ID' => $this->input->post('title'),
			'Title' => $this->input->post('text'));
		
		return $this->db->insert('job_detail', $data);
	}
	
	 public function cr_user()
	{
		$this->load->helper('url');
		
		//$slug = url_title($this->input->post('title'), 'dash', TRUE);
		
		$data = array(
			'ui_PFile_No' => $this->input->post('ui_PFile_No'),
			'ui_Pwd' => $this->input->post('ui_Pwd'),
			'ui_Email' => $this->input->post('ui_Email')
			);
		
		return $this->db->insert('DMS_UserInfo', $data);
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
	
	public function get_Data_Sql_Str1($qstr)
	{
		//echo $qstr;
		//die('aa');
		$query = $this->db->query($qstr);
		
        return $query;
	}
	
	function get_target($target_year='')
	{
	 if($target_year==''){$target_year=date('Y');}
     $query =  $this->db->query("SELECT * FROM DMS_Designation where Dsg_Target_yr=$target_year");        
           
		return $query->result();
	}
	
	function add_record($data) 
	{
		$this->db->insert('dms_userinfo', $data);
		return;
	}
	
	function add_admin_data()
	{
	//delete from dms_product_type
//	DELETE FROM table_name
//WHERE some_column=some_value
	//$this->db->query("delete from DMS_UserInfo where ui_PFile_No='O-9487'"); 
	  return;       
	}
	
	function search_branch_by_text($search_text='')
	{
		$data=array();
		$query = $this->db->query("SELECT * FROM vw_jb_div_zn_br WHERE BRANCH_NAME LIKE '$search_text%'");
       
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		   		$data[]= $row;
		   }
		}
		return $data; 
	}
	
	function search_zone_by_text($search_text='')
	{
		$data=array();
		$query = $this->db->query("SELECT DISTINCT(ZoneCode),ZoneName FROM vw_jb_div_zn_br WHERE ZoneName LIKE '$search_text%'");
       
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		   		$data[]= $row;
		   }
		}
		return $data; 
	}
	
	function search_div_by_text($search_text='')
	{
		$data=array();
		$query = $this->db->query("SELECT DISTINCT(jbdivisioncode),DivisionName FROM vw_jb_div_zn_br WHERE DivisionName LIKE '$search_text%'");
       
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		   		$data[]= $row;
		   }
		}
		return $data; 
	}
	

/////GRAPH QUERY HERE/////////////	
	function om_graph_data_dep($year='')
	{
	
	if($year=='')
	{
		$year=date('Y');
	}
	
	$condition_yr_start=$year.'-01-01';
	$condition_yr1_end=$year.'-12-31';
	
	 $query_query =  $this->db->query("select dd_jo_code,dd_pt_id, dd_ac,dd_amt, dd_end_dt from Om_data_detail 
					where dd_end_dt IN (select om_dat_date from om_entry_date where om_dat_date>'$condition_yr_start'    	
	       AND om_dat_date<'$condition_yr1_end')
					AND dd_pt_id IN(select pt_id from dms_product_type where pt_pg_id =1)");       
		return $query_query->result();
	}
	
	function om_graph_data_adv($year='')
	{
	if($year=='')
	{
		$year=date('Y');
	}
	
	$condition_yr_start=$year.'-01-01';
	$condition_yr1_end=$year.'-12-31';
	
	 $query_query =  $this->db->query("select dd_jo_code,dd_pt_id, dd_ac,dd_amt, dd_end_dt from Om_data_detail 
					where dd_end_dt IN (select om_dat_date from om_entry_date where om_dat_date>'$condition_yr_start'    	
	       AND om_dat_date<'$condition_yr1_end')
					AND dd_pt_id IN(select pt_id from dms_product_type where pt_pg_id =6)");       
		return $query_query->result();
	}
	
	function om_graph_date($year='')
	{
	if($year=='')
	{
		$year=date('Y');
	}
	
	$condition_yr_start=$year.'-01-01';
	$condition_yr1_end=$year.'-12-31';

	 $query_query =  $this->db->query("select om_dat_date from om_entry_date where om_dat_date>'$condition_yr_start'    	
	       AND om_dat_date<'$condition_yr1_end' ORDER BY om_dat_date");       
	 return $query_query->result();
	}
	
	function om_graph_prod_id_dep()
	{
	 $query_query =  $this->db->query("select pt_id from dms_product_type where pt_pg_id =1");       
	 return $query_query->result();
	}
	
	function om_graph_prod_id_adv()
	{
	 $query_query =  $this->db->query("select pt_id from dms_product_type where pt_pg_id =6");       
	 return $query_query->result();
	}
	
	/////////////////////HERE

    //////////////HERE
    function get_om__report_data_dist_cons($DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $query =  $this->db->query("SELECT DISTINCT(dd_jo_code) FROM $tbl_name where dd_end_dt='$DATE'");        
		return $query->result();
	}
    
	function get_om__report_data_detail_cons($DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $query =  $this->db->query("SELECT * FROM $tbl_name where dd_end_dt='$DATE' ORDER BY dd_pt_id");        
		return $query->result();
	}
	function delete_omis_data($OFF_ID,$DATE)
	{
        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $query =  $this->db->query("SELECT * FROM $tbl_name where dd_jo_code=$OFF_ID AND dd_end_dt='$DATE' ORDER BY dd_pt_id");        
         //return $query->result();
		 if ($query->num_rows() > 0){return true;}
		 else
		 {return  false;}
	}
	
	function delete_omis($OFF_ID,$DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $this->db->query("delete from $tbl_name where dd_jo_code=$OFF_ID AND dd_end_dt='$DATE'");        
        
	}
	function get_om_date()
	{
	   $query =  $this->db->query("SELECT convert(char(12),om_dat_date,107) om_dat_date from om_entry_date where om_status=1 order by om_date_sl desc");
        return $query->result();
	}
    
    //added by zakariya
	
	function add_omis_data($data,$DATE) 
	{
        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name_to_insert($DATE);
        
        //now insert data
        $this->db->insert($tbl_name, $data);
		return;
	}
	function get_om__report_date()
	{
	
	//DISTINCT(jbdivisioncode)
	  // $query =  $this->db->query("SELECT om_dat_date from om_entry_date where om_status=1");
	  $query =  $this->db->query("select convert(char(12),om_dat_date,107) om_dat_date FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] order by om_date_sl desc");
	   
	   //$query =  $this->db->query("select DISTINCT(jbdivisioncode) FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date]");
 
		return $query->result();
	}
	
	
	function get_records_br_name($OFF_ID2)
   {
      $query =  $this->db->query("SELECT * FROM vw_jb_div_zn_br WHERE jbbrcode=$OFF_ID2");
 
		return $query->result();
   }
   function get_records_zn_name($OFF_ID2)
   {
      $query =  $this->db->query("SELECT * FROM vw_jb_div_zn_br WHERE ZoneCode=$OFF_ID2");
 
		return $query->result();
   }
   function get_records_div_name($OFF_ID2)
   {
      $query =  $this->db->query("SELECT * FROM vw_jb_div_zn_br WHERE jbdivisioncode=$OFF_ID2");
 
		return $query->result();
   }
   function get_om_report_admin_zone($DATE, $b_br)
	{
        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $query =  $this->db->query("SELECT * FROM $tbl_name where dd_jo_code IN (SELECT CONVERT(int, jbbrcode) FROM vw_jb_div_zn_br where ZoneCode='$b_br') AND dd_end_dt='$DATE' ORDER BY dd_pt_id");       
		return $query->result();
	}
	
    /////////////HERE  RIPON
    function get_om_report_dist_zone($DATE, $b_br)
	{
	    //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $query =  $this->db->query("SELECT DISTINCT(dd_jo_code) FROM $tbl_name where dd_jo_code IN (SELECT CONVERT(int, jbbrcode) FROM vw_jb_div_zn_br where ZoneCode='$b_br') AND dd_end_dt='$DATE'");       
		return $query->result();
	}


		
	
	/////////////////////HERE
    function get_om_report_dist_div($DATE, $b_br)
	{
	    //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $query =  $this->db->query("SELECT DISTINCT(dd_jo_code) FROM $tbl_name where dd_jo_code IN (SELECT CONVERT(int, jbbrcode) FROM vw_jb_div_zn_br where jbdivisioncode='$b_br') AND dd_end_dt='$DATE'");       
		return $query->result();
	}
    
    
	function get_om_report_admin_div($DATE, $b_br)
	{
        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        $query =  $this->db->query("SELECT * FROM $tbl_name where dd_jo_code IN (SELECT CONVERT(int, jbbrcode) FROM vw_jb_div_zn_br where jbdivisioncode='$b_br') AND dd_end_dt='$DATE' ORDER BY dd_pt_id");       
		return $query->result();
	}
	
	function get_br_div($b_br)
	{
	 $query =  $this->db->query("SELECT COUNT(jbbrcode) FROM vw_jb_div_zn_br where jbdivisioncode='$b_br'");       
		return $query->result();
	}
	
	function get_om__report_data_detail($DATE,$b_br)
	{
		//data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $query =  $this->db->query("SELECT * FROM $tbl_name where dd_jo_code='$b_br' AND dd_end_dt='$DATE' ORDER BY dd_pt_id");        //return $query;
		return $query->result();
	}
	
	//get_total_br_name()
	function get_total_br_name()
	{
		$query =  $this->db->query("SELECT * FROM vw_jb_div_zn_br");        //return $query;
		return $query->result();
	}
	
	function get_records()
	{
	   $query =  $this->db->query("SELECT * from om_prod_group order by om_id");
 
		return $query->result();
	}
	
	function get_product_type()
	{
	   $query =  $this->db->query("SELECT * from dms_product_type");
 
		return $query->result();
	}

	function get_records2()
	{
	   
		$query2 =  $this->db->query("SELECT p.pt_short_name, p.pt_pg_id, p.pt_id, d.om_id_des, d.om_id
										FROM dms_product_type p, om_prod_group d
										WHERE p.pt_pg_id = d.om_id 
                                        
										ORDER BY pt_id	
										");        
           
		return $query2->result();
		
		//SELECT p.pt_id, p.pt_pg_id, p.pt_short_name, d.om_id_des
				//FROM dms_product_type p, om_prod_group d
				//WHERE p.pt_pg_id = d.om_id AND pt_used_module=1100000 AND pt_used_module=0100000
				//ORDER BY pt_id"
	}
	
	
	
	
	function product_type()
	{
		$query =  $this->db->query("SELECT * FROM dms_product_type where pt_used_module=1100000");        
           
		return $query->result();
	}
	
	
	
	function add_deposit($data) 
	{
		$this->db->insert('dms_deposit', $data);
		//$this->db->delete('dms_deposit');
		return;
	}

function add_dms_emp_length($data) 
	{
		$this->db->insert('dms_emp_length', $data);
		return;
	}
/*function check_user($pf_no,$pass,$office_id,$u_level)
	{
		$query =  $this->db->query("SELECT *
										FROM DMS_UserInfo where ltrim(rtrim(ui_PFile_No))= '$pf_no' AND ltrim(rtrim(ui_Posting_Office_Code))= '$office_id' AND ltrim(rtrim(ui_Pwd))= '$pass'");        
        
		if($query->num_rows == 1)
		{
			$u_level_arr= $query->result();
			$u_level= $u_level_arr[0]->ui_level;
			return true;
		}
	}*/

    function check_user($pf_no,$pass,$office_id,$u_level)
	{
		$query =  $this->db->query("SELECT * FROM DMS_UserInfo where ltrim(rtrim(ui_PFile_No))= '$pf_no' AND ltrim(rtrim(ui_Posting_Office_Code))= '$office_id' AND ltrim(rtrim(ui_Pwd))= '$pass' AND ui_isPermit=1 ");        
        
		if($query->num_rows == 1)
		{
			$u_level_arr= $query->result();
			$u_level= $u_level_arr[0]->ui_level;
			return true;
		}
	}
    
    function check_is_permit($pf_no,$pass,$office_id,$u_level)
	{
		$is_permit=1;
        $query =  $this->db->query("SELECT ui_isPermit FROM DMS_UserInfo where ltrim(rtrim(ui_PFile_No))= '$pf_no' AND ltrim(rtrim(ui_Posting_Office_Code))= '$office_id' AND ltrim(rtrim(ui_Pwd))= '$pass' ");        
        
		if($query->num_rows == 1)
		{
            $user_info=$query->row_array();
            $is_permit=$user_info['ui_isPermit'];
		}
        
        return $is_permit;
	}
	
	function get_designation_dropdown()
	{
		$data=array();
		$data['']='Select Designation';
		
		$query =  $this->db->query("SELECT Dsg_Code,Dsg_Desc FROM DMS_Designation");
										
		if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data[$row['Dsg_Code']]=$row['Dsg_Desc'];
			}
		}
		return $data;
	}
	
	function get_off_code_dropdown()
	{
		$data=array();
		$data['']='Select Office';
		
		$query =  $this->db->query("SELECT [Office code] as office_code,office_name FROM VW_Jb_off ORDER BY office_name ");
										
		if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data[$row['office_code']]=$row['office_name'].'('.$row['office_code'].')';
			}
		}
		return $data;
	}
	
	function get_employee_data($id=0)
	{
		$data=array();
		
		$query =  $this->db->query("SELECT * FROM dms_emp WHERE ei_id=".$id);
										
		if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data=$row;
			}
		}
		return $data;
	}
	
	//forget password
	//function get_password($emp_file_no='',$email='')
	function get_password($emp_file_no='',$email='',$pocode='',$dob='')
	{
		$data=array();
		
		//$query =  $this->db->query("SELECT * FROM DMS_UserInfo WHERE ltrim(rtrim(ui_PFile_No))='".trim($emp_file_no)."' AND ltrim(rtrim(ui_Email))='".trim($email)."'");
		$query =  $this->db->query("SELECT * FROM DMS_UserInfo WHERE ltrim(rtrim(ui_PFile_No))='".trim($emp_file_no)."' AND ltrim(rtrim(ui_Email))='".trim($email)."'
		                            AND ltrim(rtrim(ui_Posting_Office_Code))='".trim($pocode)."' AND ui_dob='".$dob."'");
										
		if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data=$row;
			}
		}
		
		return $data;
	}
	
function mydata_get($m,$y,$brcd)
	{
		$query =  $this->db->query("SELECT *
										FROM dms_deposit where dp_onth=".$m." And dp_yr=".$y." and dp_jo_code=".$brcd);        
           
		return $query->result();
	}
	
	function dms_data_del($m,$y,$brcd)
	{
		$query =  $this->db->query("Delete
										FROM dms_deposit where dp_onth=".$m." And dp_yr=".$y." and dp_jo_code=".$brcd);        
           
		return $query;
	}
	
	function emp_lenght_data_del($m,$y,$brcd)
	{
		$this->db->delete('dms_emp_length', array('el_off_id' => $brcd, 'el_yr'=>$y,'el_mon'=>$m)); 
	}
	//////////////////////////////////////////////////////////
	///Deposit Report
	/////////////////////////////////////////////////////////
	function dms__report_date()
	{
	  $query =  $this->db->query("SELECT DISTINCT dp_yr from dms_deposit");
   	  return $query->result();
	}
	
	function dms__report_data_detail($year,$mon,$OFF_ID)
	{
	$query =  $this->db->query("SELECT * FROM dms_deposit where dp_onth='$mon' AND dp_yr='$year' AND dp_jo_code='$OFF_ID'");     //return $query;
	 return $query->result();
	}
	
	//get_emp_list()
	function get_emp_list($year,$mon,$OFF_ID)
	{
	$query =  $this->db->query("SELECT * FROM dms_emp_length where el_mon='$mon' AND el_yr='$year' AND el_off_id='$OFF_ID'");     //return $query;
	 return $query->result();
	}
	
	
	function get_emp_list_div($year,$mon,$OFF_ID)
	{
	 $query =  $this->db->query("SELECT * FROM dms_emp_length where el_off_id IN (SELECT jbbrcode FROM vw_jb_div_zn_br where jbdivisioncode='$OFF_ID') AND el_mon='$mon' AND el_yr='$year' ORDER BY el_off_id");       
		return $query->result();
	}
	
	
	
	function dms_div_report_data_detail($year,$mon,$OFF_ID)
	{
	 $query =  $this->db->query("SELECT * FROM dms_deposit where dp_jo_code IN (SELECT jbbrcode FROM vw_jb_div_zn_br where jbdivisioncode='$OFF_ID') AND dp_onth='$mon' AND dp_yr='$year' ORDER BY dp_jo_code");       
		return $query->result();
	}
	//dms_div_report_data_branch($year,$mon,$OFF_ID)
	function dms_div_report_data_branch($year,$mon,$OFF_ID)
	{
	 $query =  $this->db->query("SELECT DISTINCT(dp_jo_code) FROM dms_deposit where dp_jo_code IN (SELECT jbbrcode FROM vw_jb_div_zn_br where jbdivisioncode='$OFF_ID') AND dp_onth='$mon' AND dp_yr='$year' ORDER BY dp_jo_code");       
		return $query->result();
	}
	
	
	//get_br_zn_div_name()
	function get_br_zn_div_name()
	{
	 $query =  $this->db->query("SELECT * FROM vw_jb_div_zn_br");       
		return $query->result();
	}
	
	function get_Data_vw_jb_br_div()
	{
	 $q1 =  $this->db->query("Select * from vw_jb_div_zn_br");   
	 return $q1->result();
	}
    
    
    /////////////////////////TMS Zakariya START////////////////////////////////
    
    function get_target_entry_deatails($office_id=0)
    {
        $office_id=$this->session->userdata('some_office');
        
        $individual_br_arr=array();
        $query =  $this->db->query("SELECT brcode FROM allinformation WHERE brcode IN (0102,0888,9999) OR  brcode IN(SELECT distinct brcode FROM allinformation WHERE gradecode='01') ");
        
  		$check_ind='zncode';
        if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data=$row;
                if($row['brcode']==$office_id)
                {
                    $check_ind='brcode';
                }
			}
		}
        $query =  $this->db->query("select brcode,branchname from allinformation WHERE $check_ind='$office_id' ");     
		return $query->result();  
    }
	
	function get_tms_option()
    {
        $query =  $this->db->query("select sg.*,g.tms_group_text 
                                    from tms_subgroup as sg
                                    JOIN tms_group as g ON sg.tms_group_code=g.tms_group_code
                                    order by g.tms_group_order asc");       
		return $query->result(); 
    }
    
    function get_tms_group()
    {
        $query =  $this->db->query("select * from tms_group order by tms_group_order asc");       
		return $query->result(); 
    }
    
    function get_tms_year($status=1)
    {
        $where='';
        if($status==1){$where="where tms_yr_status='$status'";}
        $query =  $this->db->query("select tms_yr from tms_entry_year $where order by tms_yr_sl desc");       
		return $query->result(); 
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
    
    function save_tms_target_data()
    {
        $status='error';

	$office_id=$_POST['target_branch'];
                
        $previous_target_arr=$this->get_branch_tms_report($office_id,$_POST['target_year']);
        
        if(count($previous_target_arr)>0)
        {
            $status='notice';
        }
        else
        {
            $amount=$this->input->post('amount');
            $tms_subgroup_code=$this->input->post('tms_subgroup_code');
            $tms_data_uid=$this->session->userdata('some_uid');
            $tms_data_sb_dt=date('Y-m-d');
            $c=0;
			foreach($amount as $amountVal)
			{
                $data = array( 
                    'tms_data_yr'	    => $_POST['target_year'],
                    'tms_data_off_code'	=> $office_id,
                    'tms_data_sg_code' 	=> $tms_subgroup_code[$c],
        			'tms_data_uid' 	    => $tms_data_uid,
                    'tms_data_sb_dt'	=> $tms_data_sb_dt,
                    'tms_data_amt'	    => (float)$amountVal
        		);
				
                if($this->db->insert('tms_data_detail', $data))
                {
                    $status='success';
                }
    			$c++;
			}
            
        }
        
        return $status;
        		
    }
    
    function save_tms_target_edit_info($office_id=0)
    {
        $status='error';
        $previous_target_arr=$this->get_branch_tms_report($office_id,$_POST['target_year']);
        
        if(count($previous_target_arr)>0)
        {
            $tms_data_uid=$this->session->userdata('some_uid');
            $tms_data_sb_dt=date('Y-m-d');
            $c=0;
			foreach($previous_target_arr as $row)
			{
                $data_log = array( 
                    'tms_data_yr'	    => $row->tms_data_yr,
                    'tms_data_off_code'	=> $row->tms_data_off_code,
                    'tms_data_sg_code' 	=> $row->tms_data_sg_code,
        			'tms_data_uid' 	    => $row->tms_data_uid,
                    'tms_data_sb_dt'	=> $row->tms_data_sb_dt,
                    'tms_data_amt'	    => $row->tms_data_amt
        		);
				
                if($this->db->insert('tms_data_detail_log', $data_log))
                {
                    $status='pre_success';
                }
    			$c++;
			}
            
            if($status=='pre_success')
            {
                $this->db->where('tms_data_off_code',$office_id);
                $this->db->where('tms_data_yr',$_POST['target_year']);
                if($this->db->delete('tms_data_detail'))
                {
                    $amount=$this->input->post('amount');
                    $tms_subgroup_code=$this->input->post('tms_subgroup_code');
                    $tms_data_uid=$this->session->userdata('some_uid');
                    $tms_data_sb_dt=date('Y-m-d');
                    $c=0;
        			foreach($amount as $amountVal)
        			{
                        $data = array( 
                            'tms_data_yr'	    => $_POST['target_year'],
                            'tms_data_off_code'	=> $office_id,
                            'tms_data_sg_code' 	=> $tms_subgroup_code[$c],
                			'tms_data_uid' 	    => $tms_data_uid,
                            'tms_data_sb_dt'	=> $tms_data_sb_dt,
                            'tms_data_amt'	    => (float)$amountVal
                		);
        				
                        if($this->db->insert('tms_data_detail', $data))
                        {
                            $status='success';
                        }
            			$c++;
        			}  
                }
            }
        }
        
        return $status;
        		
    }
    
    
    function get_branch_tms_report($office_id=0,$target_year=0)
    {
        $Q =  $this->db->query("SELECT * FROM tms_data_detail WHERE tms_data_off_code=".$office_id." AND tms_data_yr=".$target_year." ");  
        return $Q->result();
    }
    
    function fetch_br_ao_do($br_ao_do=0, $br_ao_do_str='')
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
    
    function fetch_branch_array_for_report($office_id=0,$report_option_id=0)
    {
        $data=array();
        $condition=" WHERE jbbrcode NOT IN(0931,0932,0933,0934)";
        if($report_option_id==1)
        {
          $status=$this->get_login_office_status($office_id);
          if($status==4){$condition=" WHERE jbbrcode='$office_id' ";}
          if($status==3){$condition=" WHERE ZoneCode='$office_id' ";}
          if($status==2){$condition=" WHERE jbdivisioncode='$office_id' ";}  
        }
        else if($report_option_id==2)
        {
          $condition=" WHERE jbbrcode='$office_id' ";  
        }
        else if($report_option_id==3)
        {
           $condition=" WHERE ZoneCode='$office_id' ";  
        }
        else if($report_option_id==4)
        {
           $condition=" WHERE jbdivisioncode='$office_id' ";  
        }

        else if($report_option_id==6)
        {
           $condition=" WHERE jbdivisioncode='$office_id' AND ZoneName LIKE '%CORP%' AND BRANCH_NAME LIKE '%CORP%'";  
        }
        
        //$Q =  $this->db->query("SELECT jbbrcode,BRANCH_NAME FROM vw_jb_div_zn_br  $condition"); 
		$Q =  $this->db->query("SELECT jbbrcode,BRANCH_NAME,ZoneCode,ZoneName,jbdivisioncode,DivisionName FROM vw_jb_div_zn_br  $condition  ORDER BY jbdivisioncode,ZoneCode,jbbrcode" );
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }
	
	
	function fetch_branch_array_for_report_module($office_id=0, $report_option_id=0)
    {
     echo "=".$office_id."=".$report_option_id."<br>";
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
        
        //$Q =  $this->db->query("SELECT jbbrcode, BRANCH_NAME FROM vw_jb_div_zn_br  $condition"); 
        $Q =  $this->db->query("SELECT jbbrcode, BRANCH_NAME FROM vw_jb_div_zn_br WHERE jbbrcode NOT IN(0931, 0932, 0933, 0934) AND jbdivisioncode='7011'"); 
        //echo "SELECT jbbrcode, BRANCH_NAME FROM vw_jb_div_zn_br  $condition";
        print_r($Q->result_array());
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }
    
    function fetch_tms_data_details($branch_id_array_for_report=array(),$report_of_year='')
    {
        $count_in_branch=count($branch_id_array_for_report);
        
        $select=" * ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM tms_data_detail WHERE tms_data_yr='$report_of_year' AND tms_data_off_code IN $IN_con");      
        return $Q->result();
        
        
    }
    
    function fetch_tms_missing_completed($branch_id_array_for_report=array(),$report_of_year='')
    {
        
        $count_in_branch=count($branch_id_array_for_report);
        $data=array();
        $select=" [Br Code] as br_code,[Br Name] as br_name ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM VW_Br WHERE [Br Code] IN $IN_con"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;
            if(isset($val['br_code']))
            {
               $brcode=$val['br_code'];
               $Q =  $this->db->query("SELECT tms_data_id FROM tms_data_detail WHERE tms_data_off_code='$brcode' AND tms_data_yr='$report_of_year'");
               if($Q->num_rows()>0)
               {
                $data[$key]['status']=1;
               }
               else
               {
                $data[$key]['status']=0;
               }

               $QQ1 =  $this->db->query("SELECT * FROM allinformation WHERE brcode='$brcode' ");
               $data[$key]['office_phone']='';
               if($QQ1->num_rows()>0)
               {
                $p=$QQ1->result_array();
                $data[$key]['office_phone']=$p[0]['OfficePhone'];
               }
            }
          } 
        }
        
        return $data;
    }
    
    function fetch_tms_data_details_completed_vs_total($branch_id_array_for_report=array(),$report_of_year='')
    {
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $data=array();
        $data['total']=$count_in_branch;
        $data['completed']=0;
        $Q =  $this->db->query("SELECT DISTINCT(tms_data_off_code) FROM tms_data_detail WHERE tms_data_yr='$report_of_year' AND  tms_data_off_code IN $IN_con"); 
        if($Q->num_rows()>0)
        {
            $data['completed']=$Q->num_rows();
        }
        
        return $data;
    }
    
    function fetch_report_of_office($office_id=0,$report_option_id=0)
    {
        $report_of_office='';
        $condition='';
        $select='';
        $sign='';
$sign_code='';
        if($report_option_id==1)
        {
          $status=$this->get_login_office_status($office_id);
          if($status==4){$condition=" WHERE jbbrcode='$office_id' "; $select=" BRANCH_NAME ";$sign=" Branch";$sign_code='('.$office_id.')';}
          if($status==3){$condition=" WHERE ZoneCode='$office_id' "; $select=" ZoneName ";$sign=" Area Office";$sign_code='('.$office_id.')';}
          if($status==2){$condition=" WHERE jbdivisioncode='$office_id' "; $select=" DivisionName ";$sign=" Divisional Office";$sign_code='('.$office_id.')';}
          if($status==1){$report_of_office='Whole Bank';}   
        }
        else if($report_option_id==2)
        {
          $condition=" WHERE jbbrcode='$office_id' ";
          $select=" BRANCH_NAME "; 
          $sign=" Branch"; 
$sign_code='('.$office_id.')';
        }
        else if($report_option_id==3)
        {
           $condition=" WHERE ZoneCode='$office_id' "; 
           $select=" ZoneName "; 
           $sign=" Area Office";
$sign_code='('.$office_id.')';
        }
        else if($report_option_id==4)
        {
           $condition=" WHERE jbdivisioncode='$office_id' "; 
           $select=" DivisionName ";
           $sign=" Divisional Office"; 
$sign_code='('.$office_id.')';
        }
        else if($report_option_id==6)
        {
           $condition=" WHERE jbdivisioncode='$office_id' "; 
           $select=" DivisionName ";
           $sign=" Division Corporate"; 
$sign_code='('.$office_id.')';
        }
        else
        {
            $report_of_office='Whole Bank';
        }
        
        if($report_of_office != 'Whole Bank')
        {
            $Q =  $this->db->query("SELECT $select AS office_name FROM vw_jb_div_zn_br  $condition"); 
            
            if($Q->num_rows()>0)
            {
              foreach($Q->result_array() as $row)
              {
                $report_of_office = $row['office_name'];  
              } 
            } 
        }
        return $report_of_office.$sign.$sign_code;   
    }
	
	
	/////////////////////////TMS Zakariya END////////////////////////////////
    
    
    /*--omis start by zakariya---*/
    function fetch_omis_missing_completed($branch_id_array_for_report=array(),$report_of_date='')
    {
        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($report_of_date);
        
        $count_in_branch=count($branch_id_array_for_report);
        $data=array();
        $select=" [Br Code] as br_code,[Br Name] as br_name ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM VW_Br WHERE [Br Code] IN $IN_con"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;
            if(isset($val['br_code']))
            {
               $brcode=$val['br_code'];
               $Q =  $this->db->query("SELECT dd_id FROM $tbl_name WHERE dd_jo_code='$brcode' AND dd_end_dt='$report_of_date'");
               if($Q->num_rows()>0)
               {
                $data[$key]['status']=1;
               }
               else
               {
                $data[$key]['status']=0;
               }
			   $QQ1 =  $this->db->query("SELECT * FROM allinformation WHERE brcode='$brcode' ");
               $data[$key]['office_phone']='';
               if($QQ1->num_rows()>0)
               {
                $p=$QQ1->result_array();
                $data[$key]['office_phone']=$p[0]['OfficePhone'];
               }
            }
          } 
        }
        
        return $data;
    }
    
    function fetch_omis_data_details($branch_id_array_for_report=array(),$report_of_date='',$click_btn=0)
    {
        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($report_of_date);
        
        $count_in_branch=count($branch_id_array_for_report);
        //$data=array();
        $select=" * ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM $tbl_name WHERE dd_end_dt='$report_of_date' AND dd_jo_code IN $IN_con");      
		if($click_btn==1)
		{
			$Q =  $this->db->query("SELECT $select FROM $tbl_name WHERE dd_end_dt='$report_of_date' AND dd_jo_code IN $IN_con");      
		}
		if($click_btn==4)
		{
			$Q =  $this->db->query("SELECT $select FROM $tbl_name WHERE dd_end_dt='$report_of_date' AND dd_jo_code IN $IN_con AND dd_pt_id NOT IN(1801,1805)");      
		}
		
		
        return $Q->result();
        
        
    }
    
    function fetch_omis_data_details_completed_vs_total($branch_id_array_for_report=array(),$report_of_date='')
    {
        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($report_of_date);
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $data=array();
        $data['total']=$count_in_branch;
        $data['completed']=0;
        $Q =  $this->db->query("SELECT DISTINCT(dd_jo_code) FROM $tbl_name WHERE dd_end_dt='$report_of_date' AND  dd_jo_code IN $IN_con"); 
        if($Q->num_rows()>0)
        {
            $data['completed']=$Q->num_rows();
        }
        
        return $data;
    }
    
    /*-------omis end by zakariya-----*/

    /*---cdms report start by zakariya--*/
    
    function fetch_cdms_missing_completed($branch_id_array_for_report=array(),$report_of_year='',$report_of_month='')
    {
        $count_in_branch=count($branch_id_array_for_report);
        $data=array();
        $select=" [Br Code] as br_code,[Br Name] as br_name ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM VW_Br WHERE [Br Code] IN $IN_con"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;
            if(isset($val['br_code']))
            {
               $brcode=$val['br_code'];
               $Q =  $this->db->query("SELECT dp_id FROM dms_deposit WHERE dp_jo_code='$brcode' AND dp_yr='$report_of_year' AND dp_onth='$report_of_month'");
               if($Q->num_rows()>0)
               {
                $data[$key]['status']=1;
               }
               else
               {
                $data[$key]['status']=0;
               }
               $QQ1 =  $this->db->query("SELECT * FROM allinformation WHERE brcode='$brcode' ");
               $data[$key]['office_phone']='';
               if($QQ1->num_rows()>0)
               {
                $p=$QQ1->result_array();
                $data[$key]['office_phone']=$p[0]['OfficePhone'];
               }
            }
          } 
        }
        
        return $data;
    }
    
    function fetch_cdms_data_details($branch_id_array_for_report=array(),$report_of_year=0,$report_of_month=0)
    {
        $count_in_branch=count($branch_id_array_for_report);
        $data=array();
        $select=" dp_pt_id,dp_ac,dp_amt ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM dms_deposit WHERE dp_yr='$report_of_year' AND dp_onth='$report_of_month' AND dp_jo_code IN $IN_con"); 

        $data_temp=array();
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data_temp[] = $row;
          } 
        }        
        
        if(isset($data_temp) && count($data_temp)>0)
        {
           $data['101']['dp_ac']=0;
           $data['101']['dp_amt']=0;
           $data['105']['dp_ac']=0;
           $data['105']['dp_amt']=0;
           $data['109']['dp_ac']=0;
           $data['109']['dp_amt']=0;
           $data['113']['dp_ac']=0;
           $data['113']['dp_amt']=0;
           $data['117']['dp_ac']=0;
           $data['117']['dp_amt']=0;
           foreach($data_temp as $id=>$value)
           {
            if($value['dp_pt_id']==101)
            {
               $data['101']['dp_ac']=$data['101']['dp_ac']+$value['dp_ac'];
               $data['101']['dp_amt']=$data['101']['dp_amt']+$value['dp_amt'];
            }
            if($value['dp_pt_id']==105)
            {
               $data['105']['dp_ac']=$data['105']['dp_ac']+$value['dp_ac'];
               $data['105']['dp_amt']=$data['105']['dp_amt']+$value['dp_amt']; 
            }
            if($value['dp_pt_id']==109)
            {
               $data['109']['dp_ac']=$data['109']['dp_ac']+$value['dp_ac'];
               $data['109']['dp_amt']=$data['109']['dp_amt']+$value['dp_amt']; 
            }
            if($value['dp_pt_id']==113)
            {
               $data['113']['dp_ac']=$data['113']['dp_ac']+$value['dp_ac'];
               $data['113']['dp_amt']=$data['113']['dp_amt']+$value['dp_amt'];
            }
            if($value['dp_pt_id']==117)
            {
               $data['117']['dp_ac']=$data['117']['dp_ac']+$value['dp_ac'];
               $data['117']['dp_amt']=$data['117']['dp_amt']+$value['dp_amt']; 
            }
           }
           
           $data['total']['dp_ac']=$data['101']['dp_ac']+$data['105']['dp_ac']+$data['109']['dp_ac']+$data['113']['dp_ac']+$data['117']['dp_ac'];
           $data['total']['dp_amt']=$data['101']['dp_amt']+$data['105']['dp_amt']+$data['109']['dp_amt']+$data['113']['dp_amt']+$data['117']['dp_amt'];
           
           //get target details
           $data['target']=$this->fetch_cdms_target_details($branch_id_array_for_report,$report_of_year,$report_of_month);
           $data['acheivement']['ach_dp_ac']=($data['total']['dp_ac']*100)/$data['target']['proposional_target_ac'];  
           $data['acheivement']['ach_dp_amt']=($data['total']['dp_amt']*100)/$data['target']['proposional_target_amt'];
           
           //get grade details
            $data['acheivement_grade']=$this->fetch_cdms_grade_details();
            //get grade details
            $data['my_acheivement_grade']['amt']=$this->fetch_cdms_my_grade_details($data['acheivement']['ach_dp_amt']);
            $data['my_acheivement_grade']['ac']=$this->fetch_cdms_my_grade_details($data['acheivement']['ach_dp_ac']);
            
            //get completed vs total
            $data['completed_vs_total']['total']=$count_in_branch;
            $data['completed_vs_total']['completed']=0;
            $Q =  $this->db->query("SELECT DISTINCT(dp_jo_code) FROM dms_deposit WHERE dp_yr='$report_of_year' AND dp_onth='$report_of_month' AND dp_jo_code IN $IN_con"); 
            if($Q->num_rows()>0)
            {
                $data['completed_vs_total']['completed']=$Q->num_rows();
            }
                        
        }              
        return $data;
        
    }
    
    function fetch_cdms_target_details($branch_id_array_for_report=array(),$report_of_year=0,$report_of_month=0)
    {
        $count_in_branch=count($branch_id_array_for_report);
        $return_data=array();
        $select=" el_dsg_id,el_no_emp ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM dms_emp_length WHERE el_yr='$report_of_year' AND el_mon='$report_of_month' AND el_off_id IN $IN_con"); 
        $data_temp=array();
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data_temp[] = $row;
          } 
        }
        
        
        if(isset($data_temp) && count($data_temp)>0)
        {
           $data=array();
           $data['DMD']=0;
           $data['GM']=0;
           $data['DGM']=0;
           $data['AGM']=0;
           $data['FAGM']=0;
           $data['SEO']=0;
           $data['EO']=0;
           $data['AEO']=0;
           foreach($data_temp as $id=>$value)
           {
            if($value['el_dsg_id']=='DMD')
            {
               $data['DMD']=$data['DMD']+$value['el_no_emp'];
            }
            if($value['el_dsg_id']=='GM')
            {
                $data['GM']=$data['GM']+$value['el_no_emp'];
            }
            if($value['el_dsg_id']=='DGM')
            {
                $data['DGM']=$data['DGM']+$value['el_no_emp'];
            }
            if($value['el_dsg_id']=='AGM')
            {
                $data['AGM']=$data['AGM']+$value['el_no_emp'];
            }
            if($value['el_dsg_id']=='FAGM')
            {
                $data['FAGM']=$data['FAGM']+$value['el_no_emp'];
            }
            if($value['el_dsg_id']=='SEO')
            {
                $data['SEO']=$data['SEO']+$value['el_no_emp'];
            }
            if($value['el_dsg_id']=='EO')
            {
                $data['EO']=$data['EO']+$value['el_no_emp'];
            }
            if($value['el_dsg_id']=='AEO')
            {
                $data['AEO']=$data['AEO']+$value['el_no_emp'];
            }
           }
           
           $return_data['total_emp']=$data['DMD']+$data['GM']+$data['DGM']+$data['AGM']+$data['FAGM']+$data['SEO']+$data['EO']+$data['AEO'];
            /*
           $return_data['total_target_ac']=($data['DMD']*30)+($data['GM']*20)+($data['DGM']*20)+($data['AGM']*15)+($data['FAGM']*12)+($data['SEO']*10)+($data['EO']*10)+($data['AEO']*10);
           $return_data['total_target_amt']=(($data['DMD']*100)+($data['GM']*100)+($data['DGM']*50)+($data['AGM']*40)+($data['FAGM']*25)+($data['SEO']*15)+($data['EO']*10)+($data['AEO']*8))*100000;
           */
           //get target
           $targer_arr=$this->get_target($report_of_year);
           $return_data['total_target_ac']=($data['DMD']*$targer_arr[0]->Dsg_Target_ac)+($data['GM']*$targer_arr[1]->Dsg_Target_ac)+($data['DGM']*$targer_arr[2]->Dsg_Target_ac)+($data['AGM']*$targer_arr[3]->Dsg_Target_ac)+($data['FAGM']*$targer_arr[4]->Dsg_Target_ac)+($data['SEO']*$targer_arr[5]->Dsg_Target_ac)+($data['EO']*$targer_arr[6]->Dsg_Target_ac)+($data['AEO']*$targer_arr[7]->Dsg_Target_ac);
           $return_data['total_target_amt']=(($data['DMD']*$targer_arr[0]->Dsg_Target_Amt)+($data['GM']*$targer_arr[1]->Dsg_Target_Amt)+($data['DGM']*$targer_arr[2]->Dsg_Target_Amt)+($data['AGM']*$targer_arr[3]->Dsg_Target_Amt)+($data['FAGM']*$targer_arr[4]->Dsg_Target_Amt)+($data['SEO']*$targer_arr[5]->Dsg_Target_Amt)+($data['EO']*$targer_arr[6]->Dsg_Target_Amt)+($data['AEO']*$targer_arr[7]->Dsg_Target_Amt))*100000;
           
           $return_data['proposional_target_ac']=($return_data['total_target_ac']/12)*$report_of_month;
           $return_data['proposional_target_amt']=($return_data['total_target_amt']/12)*$report_of_month;
        }    
        return $return_data;
        
    }
    
    function fetch_cdms_grade_details()
    {
        $Q =  $this->db->query("SELECT * FROM cdms_acheivement_grade ORDER BY grade_id"); 
        $data=array();
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        
        return $data;
    }
    
    function fetch_cdms_my_grade_details($acheivement_percentage=0)
    {
        $Q =  $this->db->query("SELECT * FROM cdms_acheivement_grade"); 
        $data_temp=$this->fetch_cdms_grade_details();
        if($acheivement_percentage>100)
        {
            $data['grade_value']=$data_temp[0]['grade_value'];
            $data['grade_text']=$data_temp[0]['grade_text'];
        }
        if($acheivement_percentage>79 && $acheivement_percentage<101)
        {
            $data['grade_value']=$data_temp[1]['grade_value'];
            $data['grade_text']=$data_temp[1]['grade_text'];
        }
        if($acheivement_percentage>59 && $acheivement_percentage<80)
        {
            $data['grade_value']=$data_temp[2]['grade_value'];
            $data['grade_text']=$data_temp[2]['grade_text'];
        }
        if($acheivement_percentage>45 && $acheivement_percentage<59)
        {
            $data['grade_value']=$data_temp[3]['grade_value'];
            $data['grade_text']=$data_temp[3]['grade_text'];
        }
        if($acheivement_percentage>32 && $acheivement_percentage<46)
        {
            $data['grade_value']=$data_temp[4]['grade_value'];
            $data['grade_text']=$data_temp[4]['grade_text'];
        }
        if($acheivement_percentage<33)
        {
            $data['grade_value']=$data_temp[5]['grade_value'];
            $data['grade_text']=$data_temp[5]['grade_text'];
        }
        
        return $data;
    }
    /*
    function get_area_office_personnel($office_id=0)
    {
        $Q =  $this->db->query("SELECT TOP 1 * FROM DMS_UserInfo where  ui_Posting_Office_Code =$office_id AND (ui_PFile_No LIKE '%OC%' || ui_PFile_No LIKE '%OC%' || ui_PFile_No LIKE '%O%' || ui_PFile_No LIKE '%SO%'ui_PFile_No LIKE '%APG%' || ui_PFile_No LIKE '%SO%'ui_PFile_No LIKE '%AHME%' || ui_PFile_No LIKE '%SO%'ui_PFile_No LIKE '%EO%') "); 
        $data=array();
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        
        return $data;
    }*/
    
    /*---cdms report End by zakariya---*/

    /*-------CDMS_CO start by zakariya-----*/
    
        function fetch_br_ao_do_co($br_ao_do=0,$br_ao_do_str='')
    {
        $select='';
        $like_str='';
        if($br_ao_do==1)
        {
            $Q =  $this->db->query("SELECT [Office code] as office_code,office_name FROM VW_Jb_off WHERE office_name LIKE '$br_ao_do_str%' AND office_name NOT LIKE '%CORP%' AND [Office code]>4999 AND [Office code]<9999"); 
        }
        
        if($br_ao_do==2)
        {
            $Q =  $this->db->query("SELECT DISTINCT jbdivisioncode,DivisionName FROM vw_jb_div_zn_br WHERE DivisionName LIKE '$br_ao_do_str%'"); 
        }
        
        if($br_ao_do==3)
        {
            $Q =  $this->db->query("SELECT [Office code] as office_code,office_name FROM VW_Jb_off WHERE office_name LIKE '$br_ao_do_str%' AND office_name NOT LIKE '%CORP%' AND [Office code]>8999 AND [Office code]<9999");
        }
        
        $data=array();        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }
    
    function fetch_branch_array_for_report_co_cdms($office_id=0,$report_option_id=0)
    {
        $data=array();
        $condition='';
        if($report_option_id==1)
        {
           $Q =  $this->db->query("SELECT [Office code] as jbbrcode FROM VW_Jb_off WHERE [Office code]='$office_id'"); 
        }
        else if($report_option_id==2)
        {
           $Q =  $this->db->query("SELECT DISTINCT ZoneCode AS jbbrcode FROM vw_jb_div_zn_br WHERE jbdivisioncode='$office_id' AND ZoneName NOT LIKE '%CORP%'");  
        }
        else if($report_option_id==3)
        {
           $Q =  $this->db->query("SELECT [Office code] as jbbrcode FROM VW_Jb_off WHERE office_name NOT LIKE '%CORP%' AND [Office code]>8999 AND [Office code]<9999");  
        }
        else
        {
          $Q =  $this->db->query("SELECT [Office code] as jbbrcode FROM VW_Jb_off WHERE office_name NOT LIKE '%CORP%' AND [Office code]>4999 AND [Office code]<9999");  
        }
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        
        //division
        if($report_option_id==2)
        {
          $count=count($data);
          $data[$count]['jbbrcode']=$office_id;  
        }
        
        
        return $data; 
    }
    
    function fetch_report_of_office_co_cdms($office_id=0,$report_option_id=0)
    {
        $report_of_office='';
        $condition='';
        $select='';
	  $sign='';
        $sign_code='';
        if($report_option_id==1)
        {
            $Q =  $this->db->query("SELECT office_name FROM VW_Jb_off WHERE [Office code]='$office_id'"); 
            if($Q->num_rows()>0)
            {
              foreach($Q->result_array() as $row)
              {
                $report_of_office = $row['office_name'];  
              }
			if($office_id>5000 && $office_id<6000){$sign=' Area Office';}
			if($office_id>7000 && $office_id<8000){$sign=' Divisional Office';}
			if($office_id>8000 && $office_id<9000){$sign=' Office';}
 		  $sign_code='('.$office_id.')'; 
            }   
        }
        else if($report_option_id==2)
        {
        $Q =  $this->db->query("SELECT DivisionName AS office_name FROM vw_jb_div_zn_br where jbdivisioncode='$office_id'");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $report_of_office = $row['office_name'];  
          } 
	  	$sign='Divisional Office';
	        $sign_code='('.$office_id.')';
        } 
        }
        else if($report_option_id==3)
        {
           $report_of_office='Head Office';
	  	$sign='';
        	$sign_code='';
        }
        else
        {
            $report_of_office='Whole Bank';
	  	$sign='';
        	$sign_code='';
        }

        return $report_of_office.$sign.$sign_code;   
    }
    
    /*-------CDMS_CO end by zakariya-----*/

    function fetch_login_property($identity='')
    {
        $property='';
        $Q =  $this->db->query("SELECT U.ui_Full_Name,U.ui_Posting_Office_Code,O.office_name FROM DMS_UserInfo AS U JOIN  VW_Jb_off AS O ON U.ui_Posting_Office_Code=O.[Office code] WHERE ltrim(rtrim(U.ui_PFile_No))='".ltrim(rtrim($identity))."'");  
		
		if($Q->num_rows()>0)
        {
          $login_info=$Q->row_array();
          $property = $login_info['ui_Full_Name'].'#'.$login_info['ui_Posting_Office_Code'].'#'.$login_info['office_name'];
        }

        return $property;
    }

    // get marquee_date    
    function get_marquee_date()
    {
        $current_date=date("Y-m-d 0:0:0");
        
        $data=array();
        $Q =  $this->db->query("select om_dat_date FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] WHERE om_dat_date<'$current_date' ORDER BY om_dat_date DESC");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;  
          } 
        }
        $return_date=$current_date;
        if(count($data)>0){$return_date=$data[0]['om_dat_date'];}
        
        return $return_date;

    }
   	function get_marquee_branch_all()
	{
		$condition =' WHERE jbbrcode NOT IN(0931,0932,0933,0934)';
        $query =  $this->db->query("SELECT * FROM vw_jb_div_zn_br $condition");        //return $query;
		return $query->result();
	}
    function get_marquee_branch_completed($DATE)
	{
       //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $condition =' AND dd_jo_code NOT IN(0931,0932,0933,0934)';
        $query =  $this->db->query("SELECT DISTINCT(dd_jo_code) FROM $tbl_name where dd_end_dt='$DATE' $condition");   
		return $query->result();
	}
    
   	function get_marquee_data($DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);
        
        $condition =' AND dd_jo_code NOT IN(0931,0932,0933,0934)';
        $query =  $this->db->query("SELECT * FROM $tbl_name where dd_end_dt='$DATE' $condition");        
		return $query->result();
	}

//End marquee

	//start get EditMode data
	function get_edit_mode_data($office_id=0)
	{
		
		$current_date=date("Y-m-d 0:0:0");
        $Q =  $this->db->query("select om_dat_date FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] WHERE om_dat_date<'$current_date' ORDER BY om_dat_date DESC");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
			$DATE=$row['om_dat_date'];
            //data table extract from date
            $tbl_name=$this->get_omis_data_tbl_name($DATE);
			$query =  $this->db->query("SELECT * FROM $tbl_name where dd_end_dt='$DATE' AND dd_jo_code=$office_id ORDER BY dd_pt_id");
			if($query->num_rows()>0)
			{
				return $query->result();
			}
          } 
        }
     
	}
	
	//End get EditMode data
    
    
    
    ///GET OMIS DATA TABLE START
   	function get_omis_data_tbl_name($date='')
	{
		
		$tbl_name='omis_data_test';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='omis_data_'.$tbl_arr[0].'_'.$tbl_arr[1];
            }  
        }
        if( $this->db->table_exists($tbl_name) == FALSE ){$tbl_name='omis_data_test';}
        
        return $tbl_name;
     
	}
	function get_omis_data_tbl_name_to_insert($date='')
	{
		
		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='omis_data_'.$tbl_arr[0].'_'.$tbl_arr[1];
            }  
        }
        
        return $tbl_name;
     
	}
    
   	function generate_new_tbl($DATE='')
	{

        //data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name_to_insert($DATE);
        
        //create table if not exist
        if( $this->db->table_exists($tbl_name) == FALSE)
        {
             $query = "CREATE TABLE $tbl_name
                    (
                        dd_day int,
                        dd_onth int,
                        dd_yr int,
                        dd_jo_code varchar(6),
                        dd_pt_id int,
                        dd_ac int,
                        dd_amt numeric(20, 2),
                        dd_uid varchar(10),
                        dd_end_dt smalldatetime,
                        dd_id int NOT NULL PRIMARY KEY IDENTITY,
                    );";

            $this->db->query($query);
        }
     
	}
    
    //graph start
    function fetch_graph_date_str($date1='',$date2='')
    {
       $date_array=array();
        
       $Q =  $this->db->query("select om_dat_date FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] WHERE om_dat_date BETWEEN '$date1' AND '$date2' order by om_date_sl asc");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $date_array[]=$row;
          }
        } 
        return $date_array;
    }
    
    function fetch_graph_date($branch_id_array_for_report=array(),$date_array=array(),$pro_cat=0)
    {
        
        $data_array=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if(count($date_array)>0)
        {
            foreach($date_array as $row)
            {
                $date=$row['om_dat_date'];
                //data table extract from date
                $tbl_name=$this->get_omis_data_tbl_name($date);
                
          	     $query =  $this->db->query("select dd_jo_code,dd_pt_id, dd_ac,dd_amt, dd_end_dt from $tbl_name 
                            				where 
                                            dd_pt_id IN(select pt_id from dms_product_type where pt_pg_id =$pro_cat) 
                                            AND
                                            dd_end_dt='$date'
                                            AND
                                            dd_jo_code IN $IN_con 
                                            ");                                              
                 if($query->num_rows()>0)
                 {
                    foreach($query->result_array() as $row)
                      {
                        $data_array[]=$row;
                      }
                 }  
            }
        }
        
		return $data_array;   
    }
    
    //graph end
    
    
    ///GET OMIS DATA TABLE END


  
    //Start Report module
	function fetch_report_module_option($cat_id=0)
    {
        $tbl_name='';
        $col_condition='';
        $order_by='';
        if($cat_id>0)
        {
          $tbl_name='report_index_tbl';
          $col_condition="WHERE report_cat_id=$cat_id";
          $order_by='ORDER BY  report_is_base desc, order_id asc'; 
        }
        else
        {
          $tbl_name='erp_report_index';
          $col_condition='';
          $order_by='ORDER BY report_cat_sl';   
        }
        
        $query =  $this->db->query("SELECT * FROM $tbl_name $col_condition $order_by");
		if($query->num_rows()>0)
		{
			return $query->result();
		}
    }
    //End Report module
    
    //start performance-report option
    function fetch_calculated_date($year='',$month='',$sign=0)
    {
      $dateCal='';
      if($sign==1)
      {
        if($year !='')
        {
            $con_date=$year.'-01-01 00:00:00';
            $query =  $this->db->query("SELECT max(om_dat_date) as 'last_year_date' FROM om_entry_date where om_dat_date<'$con_date' ");
            $dateCalArr=$query->result();
            if(!empty($dateCalArr)){$dateCal=$dateCalArr[0]->last_year_date;}
        }
      }
      
      if($sign==2)
      {
        if($year !='' && $month !='')
        {
            //$con_date=$year.'-'.($month+1).'-01 00:00:00';
			if($month==12)
			{
			$con_date=($year+1).'-01-01 00:00:00';
			}
			else
			{
			$con_date=$year.'-'.($month+1).'-01 00:00:00';
			}
            $query =  $this->db->query("SELECT max(om_dat_date) as 'present_month_last_date' FROM om_entry_date where om_dat_date<'$con_date' ");
            $dateCalArr=$query->result();
            if(!empty($dateCalArr)){$dateCal=$dateCalArr[0]->present_month_last_date;}
        }
      }
      
      if($sign==3)
      {
        if($year !='' && $month !='')
        {
            //$con_date=($year-1).'-'.($month+1).'-01 00:00:00';
			if($month==12)
			{
			$con_date=$year.'-01-01 00:00:00';
			}
			else
			{
			$con_date=($year-1).'-'.($month+1).'-01 00:00:00';
			}
			
            $query =  $this->db->query("SELECT max(om_dat_date) as 'present_month_last_date' FROM om_entry_date where om_dat_date<'$con_date' ");
            $dateCalArr=$query->result();
            if(!empty($dateCalArr)){$dateCal=$dateCalArr[0]->present_month_last_date;}
        }
      }
      
      return $dateCal;  
    }
    
    function fetch_omis_sum_data($branch_id_array_for_report=array(),$date='')
    {
        $data_ret=array();
        
        if($date !='')
        {
          $data_ret['deposit']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101','105','109','113','117','121','125'));    
          
          $data_ret['advance']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601','605','609','613','617','621'));
		  //$advance_without_stuff=($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1801','1805','1809','1813','1817'))-$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('621')));    
		  $advance_without_stuff=($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601','605','609','613','617')));  
		  $data_ret['stuff_loan']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('621'));
          
          $data_ret['CL_amount']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1809','1813','1817'));
			$data_ret['CL_%']=0;
			if(isset($data_ret['advance']) && $data_ret['advance']>0)
			{
			//$data_ret['CL_%']=($data_ret['CL_amount']*100)/($data_ret['advance']-$data_ret['stuff_loan']);
			$data_ret['CL_%']=($data_ret['CL_amount']*100)/($advance_without_stuff);
			}
          
          $data_ret['CL_recovery_cash']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2101','2105','2109','2113','2117','2121'));
          $data_ret['CL_reduction_reschedule']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2401'));
          $data_ret['CL_reduction_interest_waiver']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2405'));
          $data_ret['CL_reduction_write_off']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2409'));
          $data_ret['CL_recovery_total']=$data_ret['CL_recovery_cash']+$data_ret['CL_reduction_reschedule']+$data_ret['CL_reduction_interest_waiver']+$data_ret['CL_reduction_write_off'];
          
          $data_ret['cash_recovery_write_off']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2125','2129'));
          $data_ret['cash_recovery_total']=$data_ret['CL_recovery_cash']+$data_ret['cash_recovery_write_off'];
          
          $data_ret['export']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6001'));
          $data_ret['import']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5701'));
          $data_ret['foreign_remittance']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('3001'));
          $data_ret['non_intt_income']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('3301'));
          $data_ret['pl']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5101'));
          
        }
        
        return $data_ret; 
        
    }
    
    function calculate_omis_terms_sum($branch_id_array_for_report=array(),$report_of_date='',$sub_group_code_array=array())
    {
        $ret_group_code_val=0;
        
        $tbl_name=$this->get_omis_data_tbl_name($report_of_date);

        $count_sub_group_code_array=count($sub_group_code_array);
        $dd_pt_id_con='';
        if($count_sub_group_code_array>0)
        {
            $dd_pt_id_con="(";
            foreach($sub_group_code_array as $key=>$val)
            {
                $dd_pt_id_con .="$val";
                if($count_sub_group_code_array>1 && $key != ($count_sub_group_code_array-1)){$dd_pt_id_con .=",";}
            }
            $dd_pt_id_con .=")";
        }
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT dd_amt FROM $tbl_name WHERE dd_end_dt='$report_of_date' AND dd_jo_code IN $IN_con AND dd_pt_id IN $dd_pt_id_con ");
        $data_arr=$Q->result();
        if(!empty($data_arr))
        {
           foreach($data_arr as $row) 
           {
            $ret_group_code_val +=$row->dd_amt;
           }
        }
        
              
        return $ret_group_code_val;
    }
    
    function fetch_target($branch_id_array_for_report=array(),$report_of_year='')
    {
        $data_ret=array();
        if($report_of_year !='' && !empty($branch_id_array_for_report))
        {
          $data_ret['deposit']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('101'));    
          
          $data_ret['advance']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('301'));
          
          $data_ret['CL_amount']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('601'));

//now cl% calculate

        $Q =  $this->db->query("SELECT * from cl_target_tbl where cl_target_yr='$report_of_year'");
        $data_temp=$Q->row_array();
        if(!empty($data_temp))
        {
		$data_ret['CL_%']=$data_temp['cl_target_percentage'];
        }

          
          $data_ret['CL_recovery_cash']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('901'));
          $data_ret['CL_reduction_reschedule']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('905'));
          $data_ret['CL_reduction_interest_waiver']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('909'));
          $data_ret['CL_reduction_write_off']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('913'));
          $data_ret['CL_recovery_total']=$data_ret['CL_recovery_cash']+$data_ret['CL_reduction_reschedule']+$data_ret['CL_reduction_interest_waiver']+$data_ret['CL_reduction_write_off'];
          
          $data_ret['cash_recovery_write_off']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('1201'));
          $data_ret['cash_recovery_total']=$data_ret['CL_recovery_cash']+$data_ret['cash_recovery_write_off'];
          
          $data_ret['export']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('1501'));
          $data_ret['import']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('1801'));
          $data_ret['foreign_remittance']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('2101'));
          $data_ret['non_intt_income']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('2401'));
          $data_ret['pl']=$this->calculate_tms_terms_sum($branch_id_array_for_report,$report_of_year,array('2701'));
          
        }
        
        return $data_ret; 
        
    }
    
    function calculate_tms_terms_sum($branch_id_array_for_report=array(),$report_of_year='',$sub_group_code_array=array())
    {
        $ret_group_code_val=0;

        $count_sub_group_code_array=count($sub_group_code_array);
        $tms_data_sg_code_con='';
        if($count_sub_group_code_array>0)
        {
            $tms_data_sg_code_con="(";
            foreach($sub_group_code_array as $key=>$val)
            {
                $tms_data_sg_code_con .="$val";
                if($count_sub_group_code_array>1 && $key != ($count_sub_group_code_array-1)){$tms_data_sg_code_con .=",";}
            }
            $tms_data_sg_code_con .=")";
        }
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT tms_data_amt FROM tms_data_detail WHERE tms_data_yr='$report_of_year' AND tms_data_off_code IN $IN_con AND tms_data_sg_code IN $tms_data_sg_code_con ");
        $data_arr=$Q->result();
        if(!empty($data_arr))
        {
           foreach($data_arr as $row) 
           {
            $ret_group_code_val +=$row->tms_data_amt;
           }
        }
        
              
        return $ret_group_code_val;
    }
    


    function fetch_proportional_target($target_array=array(),$report_of_month='',$last_acheivement=array())
    {
        $proportional_target=array();
        if(!empty($target_array) && $report_of_month !='' && !empty($last_acheivement))
        {
                  $proportional_target['deposit']=0;
                  $proportional_target['advance']=0;
                  if($target_array['deposit']>0){$proportional_target['deposit']=((($target_array['deposit']-$last_acheivement['deposit'])*$report_of_month/12)+$last_acheivement['deposit']);}      
                  if($target_array['advance']>0){$proportional_target['advance']=((($target_array['advance']-$last_acheivement['advance'])*$report_of_month/12)+$last_acheivement['advance']);}
                  
                  $proportional_target['CL_amount']=$target_array['CL_amount']*$report_of_month/12;
                  
                  //$proportional_target['CL_%']=$target_array['CL_amount']*$report_of_month/12;
                  
                  $proportional_target['CL_recovery_cash']=$target_array['CL_recovery_cash']*$report_of_month/12;
                  $proportional_target['CL_reduction_reschedule']=$target_array['CL_reduction_reschedule']*$report_of_month/12;
                  $proportional_target['CL_reduction_interest_waiver']=$target_array['CL_reduction_interest_waiver']*$report_of_month/12;
                  $proportional_target['CL_reduction_write_off']=$target_array['CL_reduction_write_off']*$report_of_month/12;
                  $proportional_target['CL_recovery_total']=$target_array['CL_recovery_total']*$report_of_month/12;
                  $proportional_target['cash_recovery_write_off']=$target_array['cash_recovery_write_off']*$report_of_month/12;
                  $proportional_target['cash_recovery_total']=$target_array['cash_recovery_total']*$report_of_month/12;
                  $proportional_target['export']=$target_array['export']*$report_of_month/12;
                  $proportional_target['import']=$target_array['import']*$report_of_month/12;
                  $proportional_target['foreign_remittance']=$target_array['foreign_remittance']*$report_of_month/12;
                  $proportional_target['non_intt_income']=$target_array['non_intt_income']*$report_of_month/12;
                  $proportional_target['pl']=$target_array['pl']*$report_of_month/12; 

	//now cl% calculate

      /*  $Q =  $this->db->query("SELECT * from cl_target_tbl where cl_target_yr='$report_of_year'");
        $data_temp=$Q->row_array();
        if(!empty($data_temp))
        {
		$proportional_target['CL_%']=$data_temp['cl_target_percentage'];
        }*/

        }
        return $proportional_target;
    }
    
 function fetch_acheivement_percentage($proportion_target_array=array(),$present_acheivement_array='')
    {
        $acheivement_percentage=array();
        if(!empty($proportion_target_array) && !empty($present_acheivement_array))
        {
              $acheivement_percentage['deposit']=0;
              if($proportion_target_array['deposit']>0){$acheivement_percentage['deposit']=$present_acheivement_array['deposit']*100/$proportion_target_array['deposit'];}
              
              $acheivement_percentage['advance']=0;
              if($proportion_target_array['advance']>0){$acheivement_percentage['advance']=$present_acheivement_array['advance']*100/$proportion_target_array['advance'];}
              
              $acheivement_percentage['CL_amount']=0;
              if($proportion_target_array['CL_amount']>0){$acheivement_percentage['CL_amount']=$present_acheivement_array['CL_amount']*100/$proportion_target_array['CL_amount'];}
              
              //$acheivement_percentage['CL_%']=0;
              //if($proportion_target_array['CL_%']>0){$acheivement_percentage['CL_amount']=$present_acheivement_array['CL_amount']*100/$proportion_target_array['CL_amount'];}
              
              $acheivement_percentage['CL_recovery_cash']=0;
              if($proportion_target_array['CL_recovery_cash']>0){$acheivement_percentage['CL_recovery_cash']=$present_acheivement_array['CL_recovery_cash']*100/$proportion_target_array['CL_recovery_cash'];}
              
              $acheivement_percentage['CL_reduction_reschedule']=0;
              if($proportion_target_array['CL_reduction_reschedule']>0){$acheivement_percentage['CL_reduction_reschedule']=$present_acheivement_array['CL_reduction_reschedule']*100/$proportion_target_array['CL_reduction_reschedule'];}
              
              $acheivement_percentage['CL_reduction_interest_waiver']=0;
              if($proportion_target_array['CL_reduction_interest_waiver']>0){$acheivement_percentage['CL_reduction_interest_waiver']=$present_acheivement_array['CL_reduction_interest_waiver']*100/$proportion_target_array['CL_reduction_interest_waiver'];}
              
              $acheivement_percentage['CL_reduction_write_off']=0;
              if($proportion_target_array['CL_reduction_write_off']>0){$acheivement_percentage['CL_reduction_write_off']=$present_acheivement_array['CL_reduction_write_off']*100/$proportion_target_array['CL_reduction_write_off'];}
              
              $acheivement_percentage['CL_recovery_total']=0;
              if($proportion_target_array['CL_recovery_total']>0){$acheivement_percentage['CL_recovery_total']=$present_acheivement_array['CL_recovery_total']*100/$proportion_target_array['CL_recovery_total'];}
              
              $acheivement_percentage['cash_recovery_write_off']=0;
              if($proportion_target_array['cash_recovery_write_off']>0){$acheivement_percentage['cash_recovery_write_off']=$present_acheivement_array['cash_recovery_write_off']*100/$proportion_target_array['cash_recovery_write_off'];}
              
              $acheivement_percentage['cash_recovery_total']=0;
              if($proportion_target_array['cash_recovery_total']>0){$acheivement_percentage['cash_recovery_total']=$present_acheivement_array['cash_recovery_total']*100/$proportion_target_array['cash_recovery_total'];}
              
              $acheivement_percentage['export']=0;
              if($proportion_target_array['export']>0){$acheivement_percentage['export']=$present_acheivement_array['export']*100/$proportion_target_array['export'];}
              
              $acheivement_percentage['import']=0;
              if($proportion_target_array['import']>0){$acheivement_percentage['import']=$present_acheivement_array['import']*100/$proportion_target_array['import'];}
              
              $acheivement_percentage['foreign_remittance']=0;
              if($proportion_target_array['foreign_remittance']>0){$acheivement_percentage['foreign_remittance']=$present_acheivement_array['foreign_remittance']*100/$proportion_target_array['foreign_remittance'];}
              
              $acheivement_percentage['non_intt_income']=0;
              if($proportion_target_array['non_intt_income']>0){$acheivement_percentage['non_intt_income']=$present_acheivement_array['non_intt_income']*100/$proportion_target_array['non_intt_income'];}
              
              $acheivement_percentage['pl']=0;
              if($proportion_target_array['pl']>0){$acheivement_percentage['pl']=$present_acheivement_array['pl']*100/$proportion_target_array['pl'];}

        }
        return $acheivement_percentage;  
    }

    
    function fetch_dif_pre_present($pre_array=array(),$present_array=array())
    {
        $dif=array();
        if(!empty($pre_array) && !empty($present_array))
        {
          $dif['deposit']=$present_array['deposit']-$pre_array['deposit'];    
          $dif['advance']=$present_array['advance']-$pre_array['advance'];
          $dif['CL_amount']=$present_array['CL_amount']-$pre_array['CL_amount'];
          $dif['CL_%']=$present_array['CL_%']-$pre_array['CL_%'];
          $dif['CL_recovery_cash']=$present_array['CL_recovery_cash']-$pre_array['CL_recovery_cash'];
          $dif['CL_reduction_reschedule']=$present_array['CL_reduction_reschedule']-$pre_array['CL_reduction_reschedule'];
          $dif['CL_reduction_interest_waiver']=$present_array['CL_reduction_interest_waiver']-$pre_array['CL_reduction_interest_waiver'];
          $dif['CL_reduction_write_off']=$present_array['CL_reduction_write_off']-$pre_array['CL_reduction_write_off'];
          $dif['CL_recovery_total']=$present_array['CL_recovery_total']-$pre_array['CL_recovery_total'];
          $dif['cash_recovery_write_off']=$present_array['cash_recovery_write_off']-$pre_array['cash_recovery_write_off'];
          $dif['cash_recovery_total']=$present_array['cash_recovery_total']-$pre_array['cash_recovery_total'];
          $dif['export']=$present_array['export']-$pre_array['export'];
          $dif['import']=$present_array['import']-$pre_array['import'];
          $dif['foreign_remittance']=$present_array['foreign_remittance']-$pre_array['foreign_remittance'];
          $dif['non_intt_income']=$present_array['non_intt_income']-$pre_array['non_intt_income'];
          $dif['pl']=$present_array['pl']-$pre_array['pl'];
        }
        return $dif;  
    }
    
    function fetch_remarks($present_ach_percentage=array(),$present_array=array(),$report_of_year='')
    {
        $remarks=array();
        
        $Q =  $this->db->query("SELECT * FROM performance_remarks_tbl");
        $remarks_tbl_content=$Q->result();
        
        if(!empty($present_ach_percentage))
        {
          $remarks['deposit']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['deposit']); 
          $remarks['advance']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['advance']);
          
/*          
$remarks['CL_amount']='';
          if($present_array['advance']>0)
          {
           $temp_percentage=($present_array['CL_amount']*100)/$present_array['advance'];
		$remarks['CL_amount']='CL is '.round($temp_percentage,2).'%';

          }*/

//now cl% calculate

        $Q =  $this->db->query("SELECT * from cl_target_tbl where cl_target_yr='$report_of_year'");
        $data_temp=$Q->row_array();
        if(!empty($data_temp) && isset($present_array['advance']) && $present_array['advance']>0)
        {
           $ach_cl_per=($present_array['CL_amount']*100)/$present_array['advance'];
if(isset($data_temp['cl_target_percentage']) && $ach_cl_per<$data_temp['cl_target_percentage']){$remarks['CL_%']='Excellent';}
if(isset($data_temp['cl_target_percentage']) && $ach_cl_per==$data_temp['cl_target_percentage']){$remarks['CL_%']='Good';}
if(isset($data_temp['cl_target_percentage']) && $ach_cl_per>$data_temp['cl_target_percentage']){$remarks['CL_%']='Bad';}
if(isset($data_temp['cl_target_percentage']) && $ach_cl_per>=(2*$data_temp['cl_target_percentage'])){$remarks['CL_%']='Very Bad';}		
        }
          
          $remarks['CL_recovery_cash']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['CL_recovery_cash']);
          $remarks['CL_reduction_reschedule']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['CL_reduction_reschedule']);
          $remarks['CL_reduction_interest_waiver']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['CL_reduction_interest_waiver']);
          $remarks['CL_reduction_write_off']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['CL_reduction_write_off']);
          $remarks['CL_recovery_total']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['CL_recovery_total']);
          $remarks['cash_recovery_write_off']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['cash_recovery_write_off']);
          $remarks['cash_recovery_total']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['cash_recovery_total']);
          $remarks['export']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['export']);
          $remarks['import']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['import']);
          $remarks['foreign_remittance']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['foreign_remittance']);
          $remarks['non_intt_income']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['non_intt_income']);
          $remarks['pl']=$this->calculate_remarks($remarks_tbl_content,$present_ach_percentage['pl']);
        }
        
        return $remarks;  
    }
    
    function calculate_remarks($remarks_tbl_content=array(),$value=0)
    {
       $remarks_text='';
        
        if(!empty($remarks_tbl_content))
        {
            $value=round($value);
            foreach($remarks_tbl_content as $row)
            {
                if($row->lower_range !='' && $row->upper_range !='')
                {
                    if($value>=$row->lower_range && $value<=$row->upper_range)
                    {
                        $remarks_text=$row->remarks_text;
                    }
                }
                if($row->lower_range =='' && $row->upper_range !='')
                {
                    if($value<=$row->upper_range)
                    {
                        $remarks_text=$row->remarks_text;
                    } 
                }
                if($row->lower_range !='' && $row->upper_range =='')
                {
                    if($value>=$row->lower_range)
                    {
                        $remarks_text=$row->remarks_text;
                    } 
                }
            }
        }
       
       return $remarks_text; 
    }
    
    function fetch_report_details($report_id='')
    {
        $report_details=array();
        
        $Q =  $this->db->query("SELECT * FROM report_index_tbl WHERE report_id='$report_id' ");
        if($Q->num_rows()>0)
        {
           $temp_array=$Q->result();
           $report_details= $temp_array[0];
        }
        return $report_details;  
    }
	
	function fetch_office_info_by_id($off_id='')
    {
        $data=array();
        
        $Q =  $this->db->query("SELECT * FROM allinformation WHERE brcode='$off_id' ");
        if($Q->num_rows()>0)
        {
           $temp_array=$Q->result();
		   $data=$temp_array[0];
        }
        return $data;  
    }
    
    function fetch_command_office($office_id=0,$report_option_id=0,$ifcorp='')
    {
        $command_office='';
        $condition='';
        $select='';
        $sign='';
        if($report_option_id==1)
        {
          $status=$this->get_login_office_status($office_id);
          if($status==4){$condition=" WHERE jbbrcode='$office_id' "; $select=" ZoneName ";$sign=" Area Office";}
          if($status==3){$condition=" WHERE ZoneCode='$office_id' "; $select=" DivisionName ";$sign=" Divisional Office";}
        }
        else if($report_option_id==2)
        {
          $condition=" WHERE jbbrcode='$office_id' ";
          $select=" ZoneName "; 
          $sign=" Area Office"; 
        }
        else if($report_option_id==3)
        {
           $condition=" WHERE ZoneCode='$office_id' "; 
           $select=" DivisionName "; 
           $sign=" Divisional Office";
        }


        //if corporate1
		$off_info=$this->fetch_office_info_by_id($office_id);
		$gradecode=0;
		if(!empty($off_info))
		{
			$gradecode=$off_info->gradecode;
		}
		
        if($ifcorp !==false && $gradecode!='02')
        {
           $condition=" WHERE (jbbrcode='$office_id' OR ZoneCode='$office_id') "; 
           $select=" DivisionName "; 
           $sign=" Divisional Office"; 
        }

        
        if($select != '')
        {
            $Q =  $this->db->query("SELECT $select AS office_name FROM vw_jb_div_zn_br  $condition"); 
            
            if($Q->num_rows()>0)
            {
              foreach($Q->result_array() as $row)
              {
                $command_office = $row['office_name'];  
              } 
            } 
        }

$retVal='';
if($sign !='' && $command_office !='')
{
	$retVal=$sign.' : '.$command_office;
}
        return $retVal;   
    }
    
    //end performance-report option

//profile setting start
    function fetch_user_details_info()
    {
        $data=array();
        $user_name= $this->session->userdata('some_name1');
        $file_no= $this->session->userdata('some_uid');
        $off_code= $this->session->userdata('some_office');

        $Q =  $this->db->query("SELECT * FROM DMS_UserInfo WHERE ltrim(rtrim(ui_PFile_No))='$file_no' AND ltrim(rtrim(ui_Posting_Office_Code))='$off_code' AND ltrim(rtrim(ui_Full_Name))='$user_name' ");
   
        if($Q->num_rows()>0)
        {
            $data = $Q->row_array();   
        } 
        return $data;
    }
    
    function profile_setting_save($ui_code=0)
    {
         $status=0;
         $Officehead=0;
		 if($this->input->post('officehead')=="on")
		 {
			$Officehead=1;
		 }
		 
		 $Controloffice=0;
		 if($this->input->post('controloffice')=="on")
		 {
			 $Controloffice=1;
		 }
         
         //check posting office
         $is_permit=1;
         if($this->input->post('pocode')!=$this->input->post('exist_pocode'))
         {
           $is_permit=0; 
         }
		
		$data = array(
		'ui_Desig_Code'=>$this->input->post('designation'),
		'ui_PFile_No'=> $this->input->post('pfno'),
		'ui_Full_Name'=> $this->input->post('fullname'),
		'ui_Mobile_No'=> $this->input->post('mobileno'),
		'ui_Posting_Office_Code'=> $this->input->post('pocode'),
		'ui_Office_HeadYN'=> $Officehead,
		'ui_Control_Off_YN' => $Controloffice,
		'ui_Pwd' =>$this->input->post('password'),
		'ui_Email' =>$this->input->post('email'),
		'ui_dob' =>$this->input->post('dob'),
		'ui_LastProfileUpdateDate' =>$this->input->post('ui_LastProfileUpdateDate'),
        'ui_isPermit' =>$is_permit
		);
        
        $this->db->where('ui_code',$ui_code);
        if($this->db->update('DMS_UserInfo',$data))
        {
            $status=1;
        }
        
        return $status;
    }
    //profile setting end

//misd_0002 start
        function fetch_deposit_mix_data($branch_id_array_for_report=array(),$date='')
    {
        $data_ret=array();
        
        if($date !='')
        {
          $data_ret['CD']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101'))/10000000;    
          
          $data_ret['SND']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('105'))/10000000;
          
          $data_ret['SB']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('109'))/10000000;
          
          $data_ret['FDR']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('113'))/10000000;
          
          $data_ret['scheme']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('117'))/10000000;
          
          $data_ret['sundry_deposit']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('121'))/10000000;
          
          $data_ret['other']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('125'))/10000000;
          
          $data_ret['low_cost_total']=$data_ret['CD']+$data_ret['SND']+$data_ret['SB']+$data_ret['sundry_deposit']+$data_ret['other'];
          
          $data_ret['high_cost_total']=$data_ret['FDR']+$data_ret['scheme'];
          
          $data_ret['grand_total']=$data_ret['high_cost_total']+$data_ret['low_cost_total'];
          
if(isset($data_ret['grand_total']) && $data_ret['grand_total']>0)
{
$data_ret['high_cost_percentage']=($data_ret['high_cost_total']*100)/$data_ret['grand_total'];
          $data_ret['low_cost_percentage']=($data_ret['low_cost_total']*100)/$data_ret['grand_total'];

          $data_ret['CD_percentage']=($data_ret['CD']*100)/$data_ret['grand_total'];
          $data_ret['SND_percentage']=($data_ret['SND']*100)/$data_ret['grand_total'];
          $data_ret['SB_percentage']=($data_ret['SB']*100)/$data_ret['grand_total'];
          $data_ret['FDR_percentage']=($data_ret['FDR']*100)/$data_ret['grand_total'];
          $data_ret['scheme_percentage']=($data_ret['scheme']*100)/$data_ret['grand_total'];
          $data_ret['sundry_deposit_percentage']=($data_ret['sundry_deposit']*100)/$data_ret['grand_total'];
          $data_ret['other_percentage']=($data_ret['other']*100)/$data_ret['grand_total'];

}
          
          
        }
        
        return $data_ret; 
        
    }
    //misd_0002 end

    //misd_0003 start
    function fetch_all_office_array($office_id=0,$report_option_id=0)
    {
        $data=array();
        $select='';
        $condition='';
        if($report_option_id==1)//my office
        {
          $status=$this->get_login_office_status($office_id);
          if($status==4){$condition=" WHERE jbbrcode='$office_id' ";$select=" distinct jbbrcode as office_id,BRANCH_NAME as office_name ";}//branch
          if($status==3){$condition=" WHERE ZoneCode='$office_id' ";$select=" distinct jbbrcode as office_id,BRANCH_NAME as office_name ";}//area
          if($status==2){$condition=" WHERE jbdivisioncode='$office_id' ";$select=" distinct ZoneCode as office_id,ZoneName as office_name ";}//division
          if($status==1){$condition=" ";$select=" distinct jbdivisioncode as office_id,DivisionName as office_name "; }//whole bank  
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
           $condition=" WHERE jbdivisioncode not in ('7014', '7011') ";
           $select=" distinct jbdivisioncode as office_id,DivisionName as office_name ";    
        }
        
        $Q =  $this->db->query("SELECT $select FROM vw_jb_div_zn_br  $condition"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }
    
    function fetch_misd_0003_cal_data($branch_id_array_for_report=array(),$report_of_year='',$report_of_month='')
    {
        $data_ret=array();
        
        if($report_of_year !='' && $report_of_month !='')
        { 
          //income
          $income_code_array=array();
          $Q =  $this->db->query("SELECT mcode,scode FROM affairhead WHERE left(mcode,1)=2 ");
          if(count($Q->result())>0)
          {
            foreach($Q->result() as $key=>$row)
            {
                if($row->mcode==201){$income_code_array['int_rec_l_a'][]=$row->scode;}
                else if($row->mcode==203){$income_code_array['com'][]=$row->scode;}
                else if($row->mcode==204){$income_code_array['ex_bro'][]=$row->scode;}
                else if($row->mcode==206){$income_code_array['invest'][]=$row->scode;}
                else{$income_code_array['other'][]=$row->scode;}
            }
          }
          
          $data_ret['income']['int_rec_l_a']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$income_code_array['int_rec_l_a'])/10000000;
          $data_ret['income']['com']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$income_code_array['com'])/10000000;
          $data_ret['income']['ex_bro']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$income_code_array['ex_bro'])/10000000;
          $data_ret['income']['invest']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$income_code_array['invest'])/10000000;
          $data_ret['income']['other']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$income_code_array['other'])/10000000;
          
          $data_ret['income']['total']=$data_ret['income']['other']+$data_ret['income']['invest']+$data_ret['income']['ex_bro']+$data_ret['income']['com']+$data_ret['income']['int_rec_l_a'];
          
          //expenditure
          $expenditure_code_array=array();
          $Q =  $this->db->query("SELECT mcode,scode FROM affairhead WHERE left(mcode,1)=3 ");
          if(count($Q->result())>0)
          {
            foreach($Q->result() as $key=>$row)
            {
                if($row->mcode==301 && $row->scode==30101){$expenditure_code_array['int_paid_dep'][]=$row->scode;}
                else if($row->mcode==301 && $row->scode==30102){$expenditure_code_array['int_paid_borr'][]=$row->scode;}
                else if($row->mcode==302 && ($row->scode==30201 || $row->scode==30204)){$expenditure_code_array['sal_allow'][]=$row->scode;}
                else if($row->mcode==303 && $row->scode==30301){$expenditure_code_array['rent_tax_insu'][]=$row->scode;}
                else{$expenditure_code_array['other'][]=$row->scode;}
            }
          }
          
          $data_ret['expenditure']['int_paid_dep']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$expenditure_code_array['int_paid_dep'])/10000000;
          $data_ret['expenditure']['int_paid_borr']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$expenditure_code_array['int_paid_borr'])/10000000;
          $data_ret['expenditure']['sal_allow']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$expenditure_code_array['sal_allow'])/10000000;
          $data_ret['expenditure']['rent_tax_insu']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$expenditure_code_array['rent_tax_insu'])/10000000;
          $data_ret['expenditure']['other']=$this->calculate_affairs_terms_sum($branch_id_array_for_report,$report_of_year,$report_of_month,$expenditure_code_array['other'])/10000000;
          
          $data_ret['expenditure']['total']=$data_ret['expenditure']['other']+$data_ret['expenditure']['rent_tax_insu']+$data_ret['expenditure']['sal_allow']+$data_ret['expenditure']['int_paid_borr']+$data_ret['expenditure']['int_paid_dep'];
          
          
          $data_ret['profit']=$data_ret['income']['total']-$data_ret['expenditure']['total'];
                        
        }
        
        return $data_ret; 
    }
    
    
    function calculate_affairs_terms_sum($branch_id_array_for_report=array(),$report_of_year,$report_of_month,$sub_group_code_array=array())
    {
        $ret_group_code_val=0;
        
        $tbl_name='PL'.$report_of_month.$report_of_year;

        $count_sub_group_code_array=count($sub_group_code_array);
        $scode_con='';
        if($count_sub_group_code_array>0)
        {
            $scode_con="(";
            foreach($sub_group_code_array as $key=>$val)
            {
                $scode_con .="$val";
                if($count_sub_group_code_array>1 && $key != ($count_sub_group_code_array-1)){$scode_con .=",";}
            }
            $scode_con .=")";
        }
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if(substr($report_of_month,0,1)==0){$report_of_month=substr($report_of_month,-1);}
        
        $Q =  $this->db->query("SELECT amount FROM $tbl_name WHERE Myear='$report_of_year' AND Mmonth='$report_of_month' AND bcode IN $IN_con AND scode IN $scode_con ");
        $data_arr=$Q->result();
        if(!empty($data_arr))
        {
           foreach($data_arr as $row) 
           {
            $ret_group_code_val +=$row->amount;
           }
        }
        
              
        return $ret_group_code_val;
    }
    //misd_0003 end

 //misd_0004 start
    function fetch_a_data($branch_id_array_for_report=array(),$year='')
    {
        $data_ret=array();
        
        if($year !='')
        {
          //get all date
          
        $Q =  $this->db->query("select om_dat_date from om_entry_date where om_dat_date like '%$year%' order by om_date_sl asc");
        $selected_yr_arr=$Q->result();
        if(count($selected_yr_arr)>0)
        {
            foreach($selected_yr_arr as $key=>$row)
            {
                $date=$row->om_dat_date;
                $data_ret[$key]['date_cal']=$date;
                
                $total_deposit_hc=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('113','117'))/10000000;
                $total_deposit_lc=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101','105','109','121','125'))/10000000;
                $total_deposit=$total_deposit_hc+$total_deposit_lc;
                $total_advance=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601','605','609','613','617','621'))/10000000;

                if($total_deposit>0 && isset($total_advance))
                {
                    $data_ret[$key]['lcr']=($total_deposit_lc*100)/$total_deposit;
                    $data_ret[$key]['hcr']=($total_deposit_hc*100)/$total_deposit;
                    $data_ret[$key]['adr']=($total_advance/$total_deposit)*100;
                    $data_ret[$key]['adr']=($total_advance/$total_deposit)*100;
                    
                    $data_ret[$key]['lc']=$total_deposit_lc;
                    $data_ret[$key]['hc']=$total_deposit_hc;
                    $data_ret[$key]['total_deposit']=$total_deposit;
                    $data_ret[$key]['total_advance']=$total_advance;   
                }
            }
        }
                  
        }
        
        return $data_ret; 
        
    }
    //misd_0004 end

 //misd_0005 start
    function fetch_misd_0005_cal_data($branch_id_array_for_report=array(),$report_of_year='',$report_of_month='')
    {
        $data_ret=array();
        
        if($report_of_year !='' && $report_of_month !='')
        { 
          
          //->1
          $last_day_date=$this->mymodel->fetch_calculated_date($report_of_year,$report_of_month,1);
          $data_ret['last_day_year']=$this->mymodel->fetch_omis_sum_data($branch_id_array_for_report,$last_day_date);
          
          //->2
          $data_ret['target']=$this->mymodel->fetch_target($branch_id_array_for_report,$report_of_year);
          //->3
          $data_ret['proportional_target']=$this->mymodel->fetch_proportional_target($data_ret['target'],$report_of_month,$data_ret['last_day_year'],$report_of_year);
          
          //->4
          $present_month_last_date=$this->mymodel->fetch_calculated_date($report_of_year,$report_of_month,2);
          $data_ret['present_acheivement']=$this->mymodel->fetch_omis_sum_data($branch_id_array_for_report,$present_month_last_date);
          
          //->5
          $data_ret['acheivement_percentage']=$this->mymodel->fetch_acheivement_percentage($data_ret['proportional_target'],$data_ret['present_acheivement']);
          
          //->6
          $pre_yr_date=$this->mymodel->fetch_calculated_date($report_of_year,$report_of_month,3);
          $data_ret['pre_yr_status']=$this->mymodel->fetch_omis_sum_data($branch_id_array_for_report,$pre_yr_date);
                        
        }
        
        return $data_ret; 
    }
    //misd_0005 end

//misd_0006 start BY RIPON
    function fetch_misd_0006_cal_data($branch_id_array_for_report=array(),$report_of_date='')
    {
        $data_ret=array();
        
        if($report_of_date !='')// && $report_of_month !='')
        { 
          
          //->1
          $last_day_date=$this->mymodel->fetch_calculated_date_0006($_POST['report_of_date'],1);
          $data_ret['last_day_year']=$this->mymodel->fetch_omis_sum_data_0006($branch_id_array_for_report,$last_day_date);
          
         $data_ret['pre_yr_status']=$this->mymodel->fetch_omis_sum_data_0006($branch_id_array_for_report,$_POST['report_of_date']);
                        
        }
        
        return $data_ret; 
    }
	
	
   function fetch_omis_sum_data_0006($branch_id_array_for_report=array(),$date='')
    {
        $data_ret=array();
        
        if($date !='')
        {
          $data_ret['deposit']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101','105','109','113','117','121','125'));    
          
          $data_ret['advance']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601','605','609','613','617','621'));
         
        }
        
        return $data_ret; 
        
    }
	function fetch_calculated_date_0006($date='',$sign=0)
    {
      $dateCal='';
	  $year = date('Y',strtotime($date));
	  if($sign==1)
      {
        if($year !='')
        {
            $con_date=$year.'-01-01 00:00:00';
            $query =  $this->db->query("SELECT max(om_dat_date) as 'last_year_date' FROM om_entry_date where om_dat_date<'$con_date' ");
            $dateCalArr=$query->result();
            if(!empty($dateCalArr)){$dateCal=$dateCalArr[0]->last_year_date;}
        }
      }
          
      return $dateCal;  
    }

    //misd_0006 end BY RIPON
	
	
	//misd_0007 start
    function fetch_misd_0007_cal_data($branch_id_array_for_report=array(),$date='')
    {
        $data_ret=array();
        
        if($date !='')
        {
            $data_ret['cd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101'))/10000000;
            $data_ret['snd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('105'))/10000000;
            $data_ret['sb']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('109'))/10000000;
            $data_ret['fdr']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('113'))/10000000;
            $data_ret['scheme']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('117'))/10000000;
            $data_ret['sd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('121'))/10000000;
            $data_ret['other']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('125'))/10000000;
            
            $data_ret['total']=$data_ret['cd']+$data_ret['snd']+$data_ret['sb']+$data_ret['fdr']+$data_ret['scheme']+$data_ret['sd']+$data_ret['other'];
            
            
            if($data_ret['total']>0)
            {
                $data_ret['cd_p']=($data_ret['cd']/$data_ret['total'])*100;
                $data_ret['snd_p']=($data_ret['snd']/$data_ret['total'])*100;
                $data_ret['sb_p']=($data_ret['sb']/$data_ret['total'])*100;
                $data_ret['fdr_p']=($data_ret['fdr']/$data_ret['total'])*100;
                $data_ret['scheme_p']=($data_ret['scheme']/$data_ret['total'])*100;
                $data_ret['sd_p']=($data_ret['sd']/$data_ret['total'])*100;
                $data_ret['other_p']=($data_ret['other']/$data_ret['total'])*100;   
            }
                  
        }
        
        return $data_ret; 
    }
    //misd_0007 end
    
    
    //misd_0008 start
    function fetch_cl_advance_data($branch_id_array_for_report=array(),$date='')
    {
        $data_ret=array();
        
        if($date !='')
        {
          $data_ret['standard']=($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1801'))-$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('621')))/10000000;    
          
          $data_ret['sma']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1805'))/10000000;
          
          $data_ret['ss']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1809'))/10000000;
          
          $data_ret['df']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1813'))/10000000;
          
          $data_ret['bl']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1817'))/10000000;
          
          $data_ret['uc']=$data_ret['standard']+$data_ret['sma'];
          
          $data_ret['cl']=$data_ret['ss']+$data_ret['df']+$data_ret['bl'];
          
          $data_ret['grand_total']=$data_ret['uc']+$data_ret['cl'];
          
          if($data_ret['grand_total']>0)
          {
              $data_ret['standard_p']=($data_ret['standard']/$data_ret['grand_total'])*100;    
          
              $data_ret['sma_p']=($data_ret['sma']/$data_ret['grand_total'])*100;
              
              $data_ret['ss_p']=($data_ret['ss']/$data_ret['grand_total'])*100;
              
              $data_ret['df_p']=($data_ret['df']/$data_ret['grand_total'])*100;
              
              $data_ret['bl_p']=($data_ret['bl']/$data_ret['grand_total'])*100;
              
              $data_ret['uc_p']=($data_ret['uc']/$data_ret['grand_total'])*100;
              
              $data_ret['cl_p']=($data_ret['cl']/$data_ret['grand_total'])*100;
          }

          
        }
        
        return $data_ret; 
        
    }
    //misd_0008 end
	
	//misd_0009 start
    function yearly_position_data($branch_id_array_for_report=array())
    {
        $data_ret=array();
        
        if(!empty($branch_id_array_for_report))
        {
          //get all date
          
        $Q =  $this->db->query("select distinct year(om_dat_date) as year from om_entry_date");
        $selected_yr_arr=$Q->result_array();
        
        if(count($selected_yr_arr)>0)
        {
            foreach($selected_yr_arr as $key=>$row)
            {
                $data_ret[$key]['year']=$row['year'];
                $data_ret[$key]['date']=$this->mymodel->fetch_calculated_date($data_ret[$key]['year']+1,'',1);
                $data_ret[$key]['data']=$this->mymodel->fetch_omis_sum_data($branch_id_array_for_report,$data_ret[$key]['date']);
            }
        }
                  
        }
        
        return $data_ret; 
        
    }
    //misd_0009 end
	
	//start misd_0010
     function fetch_developing_branch($off_id=0,$report_of_year='',$report_of_month='')
    {
        $data_ret=array();
        
        if($report_of_year !='' && $report_of_month !='')
        { 
          $tbl_name='PL'.$report_of_month.$report_of_year;
          
          //income
          $Q =  $this->db->query("SELECT sum(amount) as income FROM $tbl_name WHERE left(scode,1)=2 and bcode=$off_id");
          if(count($Q->result())>0)
          {
            foreach($Q->result() as $row)
            {
             $data_ret['income']=$row->income;   
            }
          }
          //expenditure
           $Q =  $this->db->query("SELECT sum(amount) as expen FROM $tbl_name WHERE left(scode,1)=3 and bcode=$off_id");
           if(count($Q->result())>0)
          {
            foreach($Q->result() as $row)
            {
             $data_ret['expen']=$row->expen;   
            }
          }
          //pl
          if(isset($data_ret['income']) && isset($data_ret['expen']))
          {
           $data_ret['pl']=$data_ret['income']-$data_ret['expen']; 
          }
                        
        }
        return $data_ret; 
    }
    
    //end misd_0010
	
	
    //start misd_0011
     function fetch_developing_branch_continuous($off_id=0)
    {
        $data_ret=array();
        
        if($off_id>0)
        { 
          
          $start=date('Y')-1;
          $end=date('Y')-5;
          
          
          
          for($i=$start;$i>=$end;$i--)
          {
            $tbl_name='PL12'.$i;
            $Q =  $this->db->query("SELECT name FROM sys.views where name='$tbl_name' ");
            if($Q->num_rows()>0)
            {
                //income
                  $Q =  $this->db->query("SELECT sum(amount) as income FROM $tbl_name WHERE left(scode,1)=2 and bcode=$off_id");
                  if(count($Q->result())>0)
                  {
                    foreach($Q->result() as $row)
                    {
                     $data_ret['details_fig'][$i]['income']=$row->income;   
                    }
                  }
                  //expenditure
                   $Q =  $this->db->query("SELECT sum(amount) as expen FROM $tbl_name WHERE left(scode,1)=3 and bcode=$off_id");
                   if(count($Q->result())>0)
                  {
                    foreach($Q->result() as $row)
                    {
                     $data_ret['details_fig'][$i]['expen']=$row->expen;   
                    }
                  }
                  //pl
                  if(isset($data_ret['details_fig'][$i]['income']) && isset($data_ret['details_fig'][$i]['expen']))
                  {
                    $data_ret['details_fig'][$i]['pl']=$data_ret['details_fig'][$i]['income']-$data_ret['details_fig'][$i]['expen'];
                    
                    //now calculate
                    if($i==$start){$status_index=0;$count=0;}
                    if($data_ret['details_fig'][$i]['pl']<0)
                    {
                        if($i==$start){$status_index=1;$count++;$ptrVal=$i;}
                        $diff=0;
                        if(isset($ptrVal)){$diff=$ptrVal-$i;}
                        if($status_index==1 && $diff==1){$count++;$ptrVal=$i;}
                    }
                    if($data_ret['details_fig'][$i]['pl']>=0 && $data_ret['details_fig'][$i]['pl']<500000)
                    {
                        if($i==$start){$status_index=2;$count++;$ptrVal=$i;}
                        $diff=0;
                        if(isset($ptrVal)){$diff=$ptrVal-$i;}
                        if($status_index==2 && $diff==1){$count++;$ptrVal=$i;}
                    } 
                    
                     
                  }
                  
                  //calculate status
				  if(isset($status_index)){$data_ret['status_index']=$status_index;}
                  if(isset($count)){$data_ret['status_value']=$count; }
                  
            }
          }                      
        }
        return $data_ret; 
    }
    
    //end misd_0011
	
	
	//start misd_0012
     function fetch_month_indicator_train($branch_id_array_for_report=array(),$report_of_year='')
    {
        $data_ret=array();
        
        if($report_of_year !='')
        { 
            //calculate date array
            
            $keep_tr='';
            for ($m=0; $m<=12; $m++) 
            {
                    $yesrTxt="$report_of_year";
                                        
                    $conVal=$report_of_year.'-'.($m+1).'-01';
                    $conStr="WHERE om_dat_date<'$conVal'";
                    
                    if($m==0)
                    {
                        $yesrTxt_yr=$report_of_year-1;
                        $yesrTxt="$yesrTxt_yr";
                        $conStr="WHERE om_dat_date<'$report_of_year'";
                    }
                    if($m==12)
                    {
                        $conVal=($report_of_year+1).'-01-01';
                        $conStr="WHERE om_dat_date<'$conVal'";
                    }
                    if($m>0)
					{
						$data_ret[$m]['month_name']=date('M', mktime(0,0,0,$m,$m))."/".substr($yesrTxt,2);
					}
					else
					{
						$data_ret[$m]['month_name']=date('M', mktime(0,0,0,$m))."/".substr($yesrTxt,2);
					}
                    //$data_ret[$m]['month_name']=date('M', mktime(0,0,0,$m))."/".substr($yesrTxt,2);
					
                    if(date('M', mktime(0,0,0,$m))==date('M'))
                    {
                     $data_ret[$m]['current_month']=1;   
                    }
                    
                    $Q =  $this->db->query("SELECT MAX(om_dat_date) as 'cal_date' FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] $conStr");
                    
			
                    if($Q->num_rows()>0)
                    {
                        $date='';
                        $cal_date_arr=$Q->row_array();
                        $date = $cal_date_arr['cal_date'];  
                        $data_ret[$m]['month_date'] = $date;
                        
                        if($date !='' && $date!=$keep_tr)
                        {
                          //deposit
                          $data_ret[$m]['hcd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('113','117'))/10000000;
                          $data_ret[$m]['lcd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101','105','109','121','125'))/10000000;
                          $data_ret[$m]['total_deposit']=$data_ret[$m]['hcd']+$data_ret[$m]['lcd'];    
                          
                          //advance
                          /*
                          $data_ret[$m]['continuous']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601'))/10000000;
                          $data_ret[$m]['demand']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('605'))/10000000;
                          $data_ret[$m]['term']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('609'))/10000000;
                          $data_ret[$m]['ag']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('613'))/10000000;
                          $data_ret[$m]['adv_other']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('617'))/10000000;
                          $data_ret[$m]['stuff_loan']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('621'))/10000000;
                          $data_ret[$m]['total_advance']=$data_ret[$m]['continuous']+$data_ret[$m]['demand']+$data_ret[$m]['term']+$data_ret[$m]['ag']+$data_ret[$m]['adv_other']+$data_ret[$m]['stuff_loan'];
                          */
                          $data_ret[$m]['advance']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601','605','609','613','617','621'))/10000000;
                          
                          //loan classification
                          $data_ret[$m]['standard']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1801'))/10000000;    
                          $data_ret[$m]['sma']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1805'))/10000000;
                          $data_ret[$m]['ss']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1809'))/10000000;
                          $data_ret[$m]['df']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1813'))/10000000;
                          $data_ret[$m]['bl']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1817'))/10000000;
                          $data_ret[$m]['uc']=$data_ret[$m]['standard']+$data_ret[$m]['sma'];
                          $data_ret[$m]['cl']=$data_ret[$m]['ss']+$data_ret[$m]['df']+$data_ret[$m]['bl'];
                          $data_ret[$m]['total_cl']=$data_ret[$m]['cl']+$data_ret[$m]['uc'];
                          
                          //cl recovery
                          /*
                          $data_ret[$m]['cl_recovery_1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2101','2105','2109','2113','2117','2121'))/10000000;
                          $data_ret[$m]['cl_recovery_2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2401'))/10000000;
                          $data_ret[$m]['cl_recovery_3']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2405'))/10000000;
                          $data_ret[$m]['cl_recovery_4']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2409'))/10000000;
                          $data_ret[$m]['total_cl_recovery']=$data_ret[$m]['cl_recovery_1']+$data_ret[$m]['cl_recovery_2']+$data_ret[$m]['cl_recovery_3']+$data_ret[$m]['cl_recovery_4'];
                          */
                          $data_ret[$m]['cl_recovery_1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2101','2105','2109','2113','2117','2121'))/10000000;
                          $data_ret[$m]['cl_reduction']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2401','2405',2409))/10000000;
                          $data_ret[$m]['total_cl_recovery']=$data_ret[$m]['cl_recovery_1']+$data_ret[$m]['cl_reduction'];
                          
                          //cash recovery
                          $data_ret[$m]['cash_recovery_wr']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('2125','2129'))/10000000;

                          //SME Loan
                          /*
                          $data_ret[$m]['continuous_sme']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5401'))/10000000;
                          $data_ret[$m]['demand_sme']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5405'))/10000000;
                          $data_ret[$m]['term_sme']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5409'))/10000000;
                          $data_ret[$m]['total_sme']=$data_ret[$m]['continuous_sme']+$data_ret[$m]['demand_sme']+$data_ret[$m]['term_sme'];
                          */
                          $data_ret[$m]['sme']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5401','5405','5409'))/10000000;

                          $data_ret[$m]['export']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6001'))/10000000;
                          $data_ret[$m]['import']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5701'))/10000000;
                          $data_ret[$m]['foreign_remittance']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('3001'))/10000000;
                          $data_ret[$m]['non_intt_income']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('3301'))/10000000;
                          $data_ret[$m]['pl']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5101'))/10000000;
                          
                          //dlbp
                          /*
                          $data_ret[$m]['ldbp_reg']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6301'))/10000000;
                          $data_ret[$m]['ldbp_over']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6305'))/10000000;
                          $data_ret[$m]['total_ldpb']=$data_ret[$m]['ldbp_reg']+$data_ret[$m]['ldbp_over'];
                          */
                          $data_ret[$m]['ldbp']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6301','6305'))/10000000;
                          
                          //fdbp
                          /*
                          $data_ret[$m]['fdbp_reg']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6601'))/10000000;
                          $data_ret[$m]['fdbp_over']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6605'))/10000000;
                          $data_ret[$m]['total_fdpb']=$data_ret[$m]['fdbp_reg']+$data_ret[$m]['fdbp_over'];
                          */
                          $data_ret[$m]['fdbp']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6601','6605'))/10000000;
                          
                          //ltr
                          /*
                          $data_ret[$m]['ltr_reg']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7201'))/10000000;
                          $data_ret[$m]['ltr_over']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7205'))/10000000;
                          $data_ret[$m]['total_ltr']=$data_ret[$m]['ltr_reg']+$data_ret[$m]['ltr_over'];
                          */
                          $data_ret[$m]['ltr']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7201','7205'))/10000000;
                          
                          //pad
                          /*
                          $data_ret[$m]['pad_reg']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7501'))/10000000;
                          $data_ret[$m]['pad_over']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7505'))/10000000;
                          $data_ret[$m]['total_pad']=$data_ret[$m]['pad_reg']+$data_ret[$m]['pad_over'];
                          */
                          $data_ret[$m]['pad']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7501','7505'))/10000000;
                          
                          //lim
                          /*
                          $data_ret[$m]['lim_reg']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7801'))/10000000;
                          $data_ret[$m]['lim_over']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7805'))/10000000;
                          $data_ret[$m]['total_lim']=$data_ret[$m]['lim_reg']+$data_ret[$m]['lim_over'];
                          */
                          $data_ret[$m]['lim']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('7801','7805'))/10000000;
						  
						  //pc
                          
                          /*
                          $data_ret[$m]['pc_reg']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6901'))/10000000;
                          $data_ret[$m]['pc_over']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6905'))/10000000;
                          $data_ret[$m]['total_pc']=$data_ret[$m]['pc_reg']+$data_ret[$m]['pc_over'];
                          */
                          
                          $data_ret[$m]['pc']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('6901','6905'))/10000000;
						  
                          
                        }
                        $keep_tr=$date;
                    }
            }
                        
        }
        return $data_ret; 
    }
    
    //end misd_0012

//misd_0013 start BY RIPON
    function fetch_misd_0013_cal_data($branch_id_array_for_report=array(),$date='')
    {
       $data_ret=array();

       $fir=array(6301,6601,6901,7501,7201,7801);
       $sec=array(6305,6605,6905,7505,7205,7805);
       $loannam=array('LDBP','FDBP','PC','PAD','LTR','LIM');
       $i=0;
       foreach($fir as $r=>$v)
       {
            $data_ret[$r]['nameloan']=$loannam[$i];
            $data_ret[$r]['ldbpregamt']=$ldbpregamt=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array($v))/10000000;
            $data_ret[$r]['ldbpregac']=$ldbpregac=$this->calculate_omis_terms_noac($branch_id_array_for_report,$date,array($v));
            $data_ret[$r]['ldbpoveramt']=$ldbpoveramt=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array($sec[$i]))/10000000;
            $data_ret[$r]['ldbpoverac']=$ldbpoverac=$this->calculate_omis_terms_noac($branch_id_array_for_report,$date,array($sec[$i]));
            $data_ret[$r]['ldbpregoveramt']=$ldbptotal_reg_over_amt=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array($v,$sec[$i]))/10000000;
            $data_ret[$r]['ldbpregoverac']=$ldbptotal_reg_over_ac=$this->calculate_omis_terms_noac($branch_id_array_for_report,$date,array($v,$sec[$i]));
            if($ldbptotal_reg_over_amt>0)
             {
                $data_ret[$r]['ldbpregper']=(($ldbpregamt*100)/$ldbptotal_reg_over_amt);
                $data_ret[$r]['ldbpoverper']=(($ldbpoveramt*100)/$ldbptotal_reg_over_amt);   
             }
             $i++;
         }
         $data_ret[$i]['nameloan']='Total';
         return $data_ret;  
    }
	
	function calculate_omis_terms_noac($branch_id_array_for_report=array(),$report_of_date='',$sub_group_code_array=array())
    {
        $ret_group_code_val=0;
        
        $tbl_name=$this->get_omis_data_tbl_name($report_of_date);

        $count_sub_group_code_array=count($sub_group_code_array);
        $dd_pt_id_con='';
        if($count_sub_group_code_array>0)
        {
            $dd_pt_id_con="(";
            foreach($sub_group_code_array as $key=>$val)
            {
                $dd_pt_id_con .="$val";
                if($count_sub_group_code_array>1 && $key != ($count_sub_group_code_array-1)){$dd_pt_id_con .=",";}
            }
            $dd_pt_id_con .=")";
        }
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT dd_ac FROM $tbl_name WHERE dd_end_dt='$report_of_date' AND dd_jo_code IN $IN_con AND dd_pt_id IN $dd_pt_id_con ");
        $data_arr=$Q->result();
        if(!empty($data_arr))
        {
           foreach($data_arr as $row) 
           {
            $ret_group_code_val +=$row->dd_ac;
           }
        }
        
        return $ret_group_code_val;
    }

   //misd_0013 end
   
   
   //misd_0014 start
    function fetch_misd_0014_cal_data($branch_id_array_for_report=array())
    {
        $data_ret=array();
        
        if(!empty($branch_id_array_for_report))
        { 
            $count_in_branch=count($branch_id_array_for_report);
            $IN_con='';
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
            
            //if opening date range set range set
            $open_date_con='';
            if(isset($_POST['range1_opndate']) && isset($_POST['range2_opndate']) && $_POST['range1_opndate'] !='' && $_POST['range2_opndate'] !='')
            {
              $range1=$_POST['range1_opndate'];
              $range2=$_POST['range2_opndate'];
              if($_POST['range1_opndate']>$_POST['range2_opndate'])
              {
                $range1=$_POST['range2_opndate'];
                $range2=$_POST['range1_opndate'];
              }
              $open_date_con=" AND Opndate BETWEEN '$range1' AND '$range2' ";  
            }
            
            $Q =  $this->db->query("SELECT * FROM allinformation WHERE brcode IN $IN_con $open_date_con");
            
            //declaration
            $data_ret['urban']=array();
            $data_ret['rural']=array();
            $data_ret['cor1']=array();
            $data_ret['cor2']=array();
            $data_ret['grade1']=array();
            $data_ret['grade2']=array();
            $data_ret['grade3']=array();
            $data_ret['grade4']=array();
			
            if($Q->num_rows()>0)
            {
                
                foreach($Q->result_array() as $row)
                {
                  //urban
                  if($row['urcode']==1)
                  {
                    $data_ret['urban'][]=$row;  
                  }
                  //rural
                  if($row['urcode']==2)
                  {
                    $data_ret['rural'][]=$row;  
                  }
                  
                  //cor-1
                  if($row['gradecode']==1)
                  {
                    $data_ret['cor1'][]=$row;  
                  }
                  //cor-2
                  if($row['gradecode']==2)
                  {
                    $data_ret['cor2'][]=$row;  
                  }
                  //grade-1
                  if($row['gradecode']==3)
                  {
                    $data_ret['grade1'][]=$row;  
                  }
                  //grade-2
                  if($row['gradecode']==4)
                  {
                    $data_ret['grade2'][]=$row;  
                  }
                  //grade-3
                  if($row['gradecode']==5)
                  {
                    $data_ret['grade3'][]=$row;  
                  }
                  //grade-4
                  if($row['gradecode']==6)
                  {
                    $data_ret['grade4'][]=$row;   
                  }
                }
            }           
        }
        
        return $data_ret; 
    }
    //misd_0014 end
	
    //misd_0015 start
    function fetch_range_data($branch_id_array_for_report=array(),$date='',$report_click_btn=0,$range1='',$range2='')
    {   
        $data_ret=array();
        if($date !='' && ($range1 !='' || $range2 !='') && count($branch_id_array_for_report)>0 && $report_click_btn>0)
        {
            //get table name
            $tbl_name=$this->get_omis_data_tbl_name($date);
            
            //filter branch
            $count_in_branch=count($branch_id_array_for_report);
            $IN_con='';
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
            //set different indicator
            if($report_click_btn==1){$filter_indicator='101,105,109,113,117,121,125';}//dp
            if($report_click_btn==7){$filter_indicator='113,117';}//hcd
            if($report_click_btn==8){$filter_indicator='101,105,109,121,125';}//lcd
            if($report_click_btn==2){$filter_indicator='601,605,609,613,617,621';}//adv
            if($report_click_btn==3){$filter_indicator='5101';}//pl
            if($report_click_btn==4){$filter_indicator='1801,1805';}//uc
            if($report_click_btn==5){$filter_indicator='1809,1813,1817';}//cl
            //report_click_btn==9....HCD%
            //report_click_btn==10....LCD%
            //report_click_btn==11....ADR
            
           if($report_click_btn==6)//cl%
           {
     			if($range1=='')
    			{
    				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)-sum(CASE  WHEN A.dd_pt_id IN ('621') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))<$range2	 ";  
    			}
                if($range2=='')
    			{
    				$filter_con_cl=" AND 
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)-sum(CASE  WHEN A.dd_pt_id IN ('621') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))>$range1  ";  
    			}
                if($range1 != '' && $range2 != '')
    			{
    				$filter_con_cl=" AND 
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)-sum(CASE  WHEN A.dd_pt_id IN ('621') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))>$range1 
    						AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)-sum(CASE  WHEN A.dd_pt_id IN ('621') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))<$range2	 ";  
    			}
    			  
    		  $Q =  $this->db->query("SELECT A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname,value= 
    								CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    								CAST((sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)-sum(CASE  WHEN A.dd_pt_id IN ('621') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2))
                          FROM $tbl_name A ,
                          allinformation B
                          where 
    					  A.dd_jo_code=B.brcode 
    					  AND A.dd_end_dt='$date'
    					  AND A.dd_jo_code IN $IN_con  
                          group by A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname
                          HAVING (sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)-sum(CASE  WHEN A.dd_pt_id IN ('621') THEN A.dd_amt else 0 end))>0
    						$filter_con_cl
    					order by value desc
    					");
           }
		   elseif($report_click_btn==12)//cl% including stuff
           {
     			if($range1=='')
    			{
					$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						NULLIF(CAST((sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)),0))<$range2	 ";    
    			}
                if($range2=='')
    			{
					$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						NULLIF(CAST((sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)),0))>$range1	 ";    
    			}
                if($range1 != '' && $range2 != '')
    			{
    				$filter_con_cl=" AND 
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						NULLIF(CAST(sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)),0))>$range1 
    						AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						NULLIF(CAST(sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)),0))<$range2	 ";  
    			}
    			  
    		  $Q =  $this->db->query("SELECT A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname,value= 
    								CAST(sum(CASE  WHEN A.dd_pt_id IN ('1809','1813','1817') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/NULLIF(CAST(sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)),0)
                          FROM $tbl_name A ,
                          allinformation B
                          where 
    					  A.dd_jo_code=B.brcode 
    					  AND A.dd_end_dt='$date'
    					  AND A.dd_jo_code IN $IN_con  
                          group by A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname
                          HAVING (sum (CASE  WHEN A.dd_pt_id IN ('1801','1805','1809','1813','1817') THEN A.dd_amt else 0 end))!=0
    						$filter_con_cl
    					order by value desc
    					");
           }
           elseif($report_click_btn==9)//hcd%
           {
     			if($range1=='')
    			{
    				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('113','117') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))<$range2	 ";    
    			}
                if($range2=='')
    			{
    				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('113','117') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))>$range1	 ";    
    			}
                if($range1 != '' && $range2 != '')
    			{
    				$filter_con_cl=" AND 
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('113','117') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))>$range1 
    						AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('113','117') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))<$range2	 ";  
    			}
    			  
    		  $Q =  $this->db->query("SELECT A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname,value= 
    								CAST(sum(CASE  WHEN A.dd_pt_id IN ('113','117') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    								CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2))
                          FROM $tbl_name A ,
                          allinformation B
                          where 
    					  A.dd_jo_code=B.brcode 
    					  AND A.dd_end_dt='$date'
    					  AND A.dd_jo_code IN $IN_con  
                          group by A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname
                          HAVING (sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end))!=0
    						$filter_con_cl
    					order by value desc
    					");
           }
           elseif($report_click_btn==10)//lcd%
           {
     			if($range1=='')
    			{                          
      				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('101','105','109','121','125') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))<$range2	 ";  
    			}
                if($range2=='')
    			{
      				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('101','105','109','121','125') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))>$range1	 ";    
    			}
                if($range1 != '' && $range2 != '')
    			{
    				$filter_con_cl=" AND 
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('101','105','109','121','125') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))>$range1 
    						AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('101','105','109','121','125') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))<$range2	 ";  
    			}
    			  
    		  $Q =  $this->db->query("SELECT A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname,value= 
    								CAST(sum(CASE  WHEN A.dd_pt_id IN ('101','105','109','121','125') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    								CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2))
                          FROM $tbl_name A ,
                          allinformation B
                          where 
    					  A.dd_jo_code=B.brcode 
    					  AND A.dd_end_dt='$date'
    					  AND A.dd_jo_code IN $IN_con  
                          group by A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname
                          HAVING (sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end))!=0
    						$filter_con_cl
    					order by value asc
    					");
           }
           elseif($report_click_btn==11)//adr including LYA
           {
     			if($range1=='')
    			{           
      				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','613','617','621') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))<$range2	 ";  
    			}
                if($range2=='')
    			{
      				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','613','617','621') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))>$range1	 ";    
    			}
                if($range1 != '' && $range2 != '')
    			{
    				$filter_con_cl=" AND 
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','613','617','621') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))>$range1 
    						AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','613','617','621') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))<$range2	 ";  
    			}
    			  
    		  $Q =  $this->db->query("SELECT A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname,value= 
    								CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','613','617','621') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    								CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2))
                          FROM $tbl_name A ,
                          allinformation B
                          where 
    					  A.dd_jo_code=B.brcode 
    					  AND A.dd_end_dt='$date'
    					  AND A.dd_jo_code IN $IN_con  
                          group by A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname
                          HAVING (sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end))!=0
    						$filter_con_cl
    					order by value desc
    					");
           }
		   elseif($report_click_btn==13)//adr excluding LYA
           {
     			if($range1=='')
    			{           
      				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','617') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))<$range2	 ";  
    			}
                if($range2=='')
    			{
      				$filter_con_cl=" AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','617') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST((sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end)) AS NUMERIC(18,2)))>$range1	 ";    
    			}
                if($range1 != '' && $range2 != '')
    			{
    				$filter_con_cl=" AND 
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','617') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))>$range1 
    						AND
    						(CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','617') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    						CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2)))<$range2	 ";  
    			}
    			  
    		  $Q =  $this->db->query("SELECT A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname,value= 
    								CAST(sum(CASE  WHEN A.dd_pt_id IN ('601','605','609','617') THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/
    								CAST(sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2))
                          FROM $tbl_name A ,
                          allinformation B
                          where 
    					  A.dd_jo_code=B.brcode 
    					  AND A.dd_end_dt='$date'
    					  AND A.dd_jo_code IN $IN_con  
                          group by A.dd_jo_code,B.branchname,B.znname,B.dvname,B.gradesname
                          HAVING (sum (CASE  WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end))!=0
    						$filter_con_cl
    					order by value desc
    					");
           }
           else
           {
                if($range1==''){$filter_con=" SUM(x.dd_amt)<$range2 ";  }
				if($range2==''){$filter_con=" SUM(x.dd_amt)>$range1 ";  }
				if($range1 != '' && $range2 != ''){$filter_con=" SUM(x.dd_amt)>=$range1 AND SUM(x.dd_amt)<=$range2";  }
			   
			   $Q =  $this->db->query("SELECT x.dd_jo_code,SUM(x.dd_amt) as value,y.branchname,y.znname,y.dvname,y.gradesname 
                            FROM $tbl_name AS x 
                            JOIN allinformation as y ON x.dd_jo_code=y.brcode
                            WHERE 
                            x.dd_pt_id IN($filter_indicator) 
                            AND x.dd_jo_code IN $IN_con 
                            AND x.dd_end_dt='$date'
                            GROUP BY x.dd_jo_code,y.branchname,y.znname,y.dvname,y.gradesname
                            HAVING($filter_con)
                            ORDER BY value desc");
           }
                                    
            if($Q->num_rows()>0)
            {
              foreach($Q->result_array() as $row)
              {
                $data_ret[]=$row;
              }  
            }
        }
        
        return $data_ret; 
        
    }
    //misd_0015 end
	
	
	//insert in history table--start
	function history_tbl_mgt($sign=1)
	{
		$last_insert_id=0;
		$file_no='';
		$off_code=0;
		$login_time='';
		
		if($sign==0)
		{
			//process data 
			$file_no=$this->session->userdata('some_uid');
			$login_time = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 6 hour'));
			if($file_no !='' && $login_time !='')
			{
			 $data = array(
				'file_no' => $file_no,
				'login_time' => $login_time,
				'logout_time' => ""
				);
				
				if($this->db->insert('user_history_tbl', $data))
				{
					$last_insert_id=$this->db->insert_id();
				}
				
			}
			
			return $last_insert_id;
		}
		else
		{
		 $last_id=0;
		 if($sign==1)
		 {
			$logout_time = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 6 hour'));
			$last_id=$this->session->userdata('last_history_id');
			if($last_id>0)
			{
				$data = array(
				'logout_time' => $logout_time
				);
				$this->db->where('history_id', $last_id);
				$this->db->update('user_history_tbl', $data);
			}
		 }
		}
		
	}
	//insert in history table--end
   
	//misd_0016 start
	function fetch_user_history_data($num=0,$offset=0,$is_total=0)
        {
                
                $where='';
                //set where condition
                $search_by_designation=$this->session->userdata('search_by_designation');
                if(isset($search_by_designation) && $search_by_designation !='')//search_by_designation
                {
                    $where .=" AND DMS_Designation.Dsg_Code=$search_by_designation "; 
                }
                
                //set where condition
                $search_by_off_code=$this->session->userdata('search_by_off_code');
                if(isset($search_by_off_code) && $search_by_off_code !='')//search_by_office
                {
                    $where .=" AND DMS_UserInfo.ui_Posting_Office_Code=$search_by_off_code "; 
                }

                $search_by_name=$this->session->userdata('search_by_name');
                if(isset($search_by_name) && $search_by_name !='')//search_by_name
                {
                    $where .=" AND DMS_UserInfo.ui_Full_Name LIKE '%$search_by_name%' "; 
                }
                
                //search by date
                $history_date_from=$this->session->userdata('history_date_from');
        		$history_date_to=$this->session->userdata('history_date_to');
        		
        		if(isset($history_date_from) && $history_date_from !='' && isset($history_date_to) && $history_date_to !='')//search_by_date range
        		{
        			$history_date_from=date('Y-m-d',strtotime($history_date_from)).' 00:00:00';
                    $history_date_to=date('Y-m-d',strtotime($history_date_to)).' 23:59:59';
                    $where .=" AND  user_history_tbl.login_time BETWEEN '$history_date_from' AND '$history_date_to' ";
        		} 
                
                if($is_total==1)
                {
                    $total_rows=0;
                    $Q =  $this->db->query("select distinct user_history_tbl.*,DMS_UserInfo.ui_Full_Name,DMS_Designation.Dsg_Desc,DMS_Designation.Dsg_Code,VW_Jb_off.office_name
                            from user_history_tbl 
                            inner join DMS_UserInfo on user_history_tbl.file_no=DMS_UserInfo.ui_PFile_No
                            inner join DMS_Designation on DMS_UserInfo.ui_Desig_Code=DMS_Designation.Dsg_Code
                            inner join VW_Jb_off on DMS_UserInfo.ui_Posting_Office_Code=VW_Jb_off.[Office code]
                            where 
                            user_history_tbl.history_id in
                            (
                            SELECT MAX(history_id) as 'history id' from user_history_tbl 
                            where file_no in (SELECT distinct file_no from user_history_tbl)
                            group by file_no
                            )
                            $where
                            order by DMS_Designation.Dsg_Code asc
                            ");
                    $total_rows=$Q->num_rows();
                    return $total_rows;
                }
                else
                {
                    $data_ret=array(); 
                    $Q =  $this->db->query("select distinct user_history_tbl.*,DMS_UserInfo.ui_Full_Name,DMS_Designation.Dsg_Desc,DMS_Designation.Dsg_Code,VW_Jb_off.office_name
                                            from user_history_tbl 
                                            inner join DMS_UserInfo on user_history_tbl.file_no=DMS_UserInfo.ui_PFile_No
                                            inner join DMS_Designation on DMS_UserInfo.ui_Desig_Code=DMS_Designation.Dsg_Code
                                            inner join VW_Jb_off on DMS_UserInfo.ui_Posting_Office_Code=VW_Jb_off.[Office code]
                                            where 
                                            user_history_tbl.history_id in
                                            (
                                            SELECT MAX(history_id) as 'history id' from user_history_tbl 
                                            where file_no in (SELECT distinct file_no from user_history_tbl)
                                            group by file_no
                                            )
                                            $where
                                            order by DMS_Designation.Dsg_Code asc
                                            ");                   
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
        
       function fetch_user_history_data_specific($num=0,$offset=0,$is_total=0)
       {
           $data_ret=array(); 
           $file_no=$this->session->userdata('history_file_no');

		$where='';
		//set where condition
		$history_date_from_specific=$this->session->userdata('history_date_from_specific');
		$history_date_to_specific=$this->session->userdata('history_date_to_specific');
		
		if(isset($history_date_from_specific) && $history_date_from_specific !='' && isset($history_date_to_specific) && $history_date_to_specific !='')//search_by_date range
		{
            $history_date_from_specific=date('Y-m-d',strtotime($history_date_from_specific)).' 00:00:00';
            $history_date_to_specific=date('Y-m-d',strtotime($history_date_to_specific)).' 23:59:59';
            
            $where=" AND login_time BETWEEN '$history_date_from_specific' AND '$history_date_to_specific' ";
		}
		elseif(isset($history_date_from_specific) && $history_date_from_specific !='' && ((!isset($history_date_to_specific))||(isset($history_date_to_specific) && $history_date_to_specific =='')))
		{
			$history_date_from_specific=date('Y-m-d',strtotime($history_date_from_specific)).' 00:00:00';
            $where=" AND login_time>='$history_date_from_specific' ";
		}
		elseif(isset($history_date_to_specific) && $history_date_to_specific !='' && ((!isset($history_date_from_specific))||(isset($history_date_from_specific) && $history_date_from_specific =='')))
		{
			$history_date_to_specific=date('Y-m-d',strtotime($history_date_to_specific)).' 23:59:59';
            $where=" AND login_time<='$history_date_to_specific' ";
		}
		else
		{
			$where='';
		}
		
         if($is_total==1)
         {
                 $Q =  $this->db->query("select * from user_history_tbl where file_no='$file_no' $where");
                 $total_rows=$Q->num_rows();
                 return $total_rows;
            
         }
         else
         {
               $Q =  $this->db->query("select * from user_history_tbl where file_no='$file_no' $where");
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
          }
		  return $data_ret;
           
       }
       
       function fetch_user_all_info()
       {
           $data_ret=array(); 
           
          $file_no=$this->session->userdata('history_file_no');
           $Q =  $this->db->query("select distinct a.*,c.office_name,b.Dsg_Desc  
                                    from DMS_UserInfo a, DMS_Designation b, VW_Jb_off c
                                    where a.ui_PFile_No='$file_no' AND b.Dsg_Code=a.ui_Desig_Code AND a.ui_Posting_Office_Code=c.[Office code] 
                                    ");
									
           if($Q->num_rows()>0)
		   {
			 $data_ret=$Q->row_array();
			} 		
           return $data_ret;
       }
   	//misd_0016 start end

//misd_0017 start here
   function fetch_misd_0017_cal_data($branch_id_array_for_report=array(),$report_of_date='')
    {
        $data_ret=array();
        
        if($report_of_date !='')
        { 
          $data_ret['recovery']['dp_resch_p']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2101))/10000000;
          $data_ret['recovery']['dp_resch_i']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2105))/10000000;
          $data_ret['recovery']['total_resch']=$data_ret['recovery']['dp_resch_p']+$data_ret['recovery']['dp_resch_i'];
		  $data_ret['recovery']['dp_iw_p']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2109))/10000000;
          $data_ret['recovery']['dp_iw_i']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2113))/10000000;
          $data_ret['recovery']['total_iw']=$data_ret['recovery']['dp_iw_p']+$data_ret['recovery']['dp_iw_i'];
		  $data_ret['recovery']['other_p']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2117))/10000000;
		  $data_ret['recovery']['other_i']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2121))/10000000;
          $data_ret['recovery']['total_other']=$data_ret['recovery']['other_p']+$data_ret['recovery']['other_i'];
		  
          $data_ret['recovery']['recovery_total']=$data_ret['recovery']['total_resch']+$data_ret['recovery']['total_iw']+$data_ret['recovery']['total_other'];
		  
          $data_ret['reduction']['resc']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2401))/10000000;
          $data_ret['reduction']['iw']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2405))/10000000;
          $data_ret['reduction']['wo']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2409))/10000000;
          
		  $data_ret['reduction']['red_total']=$data_ret['reduction']['resc']+$data_ret['reduction']['iw']+$data_ret['reduction']['wo'];
		  
		  $data_ret['rec_red']['rec_red_total']=$data_ret['recovery']['recovery_total']+$data_ret['reduction']['red_total'];
                        
        }
        
        return $data_ret; 
    }
//misd_0017 end here
//misd_0018 start here

   function fetch_misd_0018_cal_data_1($branch_id_array_for_report=array(),$report_of_date='')
    {
        $data_ret=array();
        
        if($report_of_date !='')
        { 
          $data_ret['dp_resch_p_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2101))/10000000;
          $data_ret['dp_resch_i_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2105))/10000000;
          $data_ret['total_resch_date1']=$data_ret['dp_resch_p_date1']+$data_ret['dp_resch_i_date1'];
		  $data_ret['dp_iw_p_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2109))/10000000;
          $data_ret['dp_iw_i_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2113))/10000000;
          $data_ret['total_iw_date1']=$data_ret['dp_iw_p_date1']+$data_ret['dp_iw_i_date1'];
		  $data_ret['other_p_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2117))/10000000;
		  $data_ret['other_i_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2121))/10000000;
          $data_ret['total_other_date1']=$data_ret['other_p_date1']+$data_ret['other_i_date1'];
		  
          $data_ret['recovery_total_date1']=$data_ret['total_resch_date1']+$data_ret['total_iw_date1']+$data_ret['total_other_date1'];
		  
          $data_ret['resc_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2401))/10000000;
          $data_ret['iw_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2405))/10000000;
          $data_ret['wo_date1']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2409))/10000000;
          
		  $data_ret['red_total_date1']=$data_ret['resc_date1']+$data_ret['iw_date1']+$data_ret['wo_date1'];
		  
		  $data_ret['rec_red_total_date1']=$data_ret['recovery_total_date1']+$data_ret['red_total_date1'];
                        
        }
        
        return $data_ret; 
    }
	function fetch_misd_0018_cal_data_2($branch_id_array_for_report=array(),$report_of_date='')
    {
        $data_ret=array();
        
        if($report_of_date !='')
        { 
          $data_ret['dp_resch_p_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2101))/10000000;
          $data_ret['dp_resch_i_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2105))/10000000;
          $data_ret['total_resch_date2']=$data_ret['dp_resch_p_date2']+$data_ret['dp_resch_i_date2'];
		  $data_ret['dp_iw_p_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2109))/10000000;
          $data_ret['dp_iw_i_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2113))/10000000;
          $data_ret['total_iw_date2']=$data_ret['dp_iw_p_date2']+$data_ret['dp_iw_i_date2'];
		  $data_ret['other_p_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2117))/10000000;
		  $data_ret['other_i_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2121))/10000000;
          $data_ret['total_other_date2']=$data_ret['other_p_date2']+$data_ret['other_i_date2'];
		  
          $data_ret['recovery_total_date2']=$data_ret['total_resch_date2']+$data_ret['total_iw_date2']+$data_ret['total_other_date2'];
		  
          $data_ret['resc_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2401))/10000000;
          $data_ret['iw_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2405))/10000000;
          $data_ret['wo_date2']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$report_of_date,array(2409))/10000000;
          
		  $data_ret['red_total_date2']=$data_ret['resc_date2']+$data_ret['iw_date2']+$data_ret['wo_date2'];
		  
		  $data_ret['rec_red_total_date2']=$data_ret['recovery_total_date2']+$data_ret['red_total_date2'];
                        
        }
        
        return $data_ret; 
    }
//misd_0018 end here

    //misd_0019 start
    function fetch_misd_0019_cal_data($branch_id_array_for_report=array(),$date='',$pre_week_date='')
    {
        $data_ret=array();
        
        if($date !='')
        {
            $data_ret['cd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101'))/10000000;
            $data_ret['snd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('105'))/10000000;
            $data_ret['sb']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('109'))/10000000;
            $data_ret['fdr']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('113'))/10000000;
            $data_ret['scheme']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('117'))/10000000;
            $data_ret['sd']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('121'))/10000000;
            $data_ret['other']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('125'))/10000000;
            
            //total(hc)
            $data_ret['total_hc']=$data_ret['fdr']+$data_ret['scheme'];
            //total(lc)
            $data_ret['total_lc']=$data_ret['cd']+$data_ret['snd']+$data_ret['sb']+$data_ret['sd']+$data_ret['other'];
            //total(hc+lc)
            $data_ret['total']=$data_ret['cd']+$data_ret['snd']+$data_ret['sb']+$data_ret['fdr']+$data_ret['scheme']+$data_ret['sd']+$data_ret['other'];
            
            
            if($data_ret['total']>0)
            {
                $data_ret['hc_p']=($data_ret['total_hc']/$data_ret['total'])*100;
                $data_ret['lc_p']=($data_ret['total_lc']/$data_ret['total'])*100;  
            }
                  
        }
        
        if($pre_week_date !='')
        {
            $data_ret['cd_preweek']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$pre_week_date,array('101'))/10000000;
            $data_ret['snd_preweek']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$pre_week_date,array('105'))/10000000;
            $data_ret['sb_preweek']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$pre_week_date,array('109'))/10000000;
            $data_ret['fdr_preweek']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$pre_week_date,array('113'))/10000000;
            $data_ret['scheme_preweek']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$pre_week_date,array('117'))/10000000;
            $data_ret['sd_preweek']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$pre_week_date,array('121'))/10000000;
            $data_ret['other_preweek']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$pre_week_date,array('125'))/10000000;
            
            //total(hc)
            $data_ret['total_hc_preweek']=$data_ret['fdr_preweek']+$data_ret['scheme_preweek'];
            //total(lc)
            $data_ret['total_lc_preweek']=$data_ret['cd_preweek']+$data_ret['snd_preweek']+$data_ret['sb_preweek']+$data_ret['sd_preweek']+$data_ret['other_preweek'];
            //total(hc+lc)
            $data_ret['total_preweek']=$data_ret['cd_preweek']+$data_ret['snd_preweek']+$data_ret['sb_preweek']+$data_ret['fdr_preweek']+$data_ret['scheme_preweek']+$data_ret['sd_preweek']+$data_ret['other_preweek'];
            
            
            if($data_ret['total_preweek']>0)
            {
                $data_ret['hc_p_preweek']=($data_ret['total_hc_preweek']/$data_ret['total_preweek'])*100;
                $data_ret['lc_p_preweek']=($data_ret['total_lc_preweek']/$data_ret['total_preweek'])*100;  
            }
                  
        }
        
        return $data_ret; 
    }
    
    // get preweek_date    
    function get_preweek_date($current_date='')
    {
        
        $data=array();
        $Q =  $this->db->query("select om_dat_date FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] WHERE om_dat_date<'$current_date' ORDER BY om_dat_date DESC");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;  
          } 
        }
        $return_date='';
        if(count($data)>0){$return_date=$data[0]['om_dat_date'];}
        
        return $return_date;

    }
    //misd_0019 end
	
	
	//misd_0020 start
    function fetch_affairs_backpage_data($branch_id_array_for_report=array(),$tbl_name='')
    {
        $data_ret=array();
        if($tbl_name !='')
        {   
            $count_in_branch=count($branch_id_array_for_report);
            //$data=array();
            $select=" a.sh_name,a.ssh_name,b.amount ";
            $IN_con='';
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
            $Q =  $this->db->query("SELECT b.scode,a.sh_code,a.ssh_code,a.sh_name,a.ssh_name,sum(b.amount) as amount FROM backpagecode a, $tbl_name b WHERE a.ssh_code=b.scode AND b.bcode IN $IN_con group by b.scode,a.sh_code,a.ssh_code,a.sh_name,a.ssh_name");      
            $data_ret=$Q->result(); 
        }
        
        return $data_ret; 
        
    }
    //misd_0020 end
	
	//misd_0021 start
    function fetch_statement_of_affairs_data($branch_id_array_for_report=array(),$tbl_name='',$ac=0)
    {
        $data_ret=array();
        if($tbl_name !='')
        {   
            //GL_Line set
            $str_gl_line='';
            
            if($ac==1){$str_gl_line=" AND LEFT(sub_head,1)=0 ";}//liabilities
            if($ac==2){$str_gl_line=" AND LEFT(sub_head,1)=1 ";}//assets
            
            $count_in_branch=count($branch_id_array_for_report);
            $IN_con='';
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
                                    
           $Q =$this->db->query("SELECT DISTINCT a.GL_Line,a.Main_Head_Code,a.Main_Head_Name,a.Sub_Head_Code,a.Sub_Head_Name,b.amount AS amount  
                                FROM (SELECT 
                                LEFT(sub_head,5) AS sub_head,SUM(amount) AS amount 
                                FROM $tbl_name 
                                WHERE 
                                bcode IN $IN_con AND LEFT(sub_head,1) NOT IN ('5') 
                                $str_gl_line 
                                GROUP BY LEFT(sub_head,5)) AS b
                                JOIN DSACODE AS a
                                ON b.sub_head=a.Sub_Head_Code
                                ORDER BY a.Main_Head_Code"
                                );                               
            $data_ret=$Q->result(); 
        }
        return $data_ret; 
        
    }
    //misd_0021 end
//start misd_0022  
 
   	function fetch_misd_0022_cal_data($branch_id_array_for_report=array(),$report_of_year='',$report_click_btn=0)
    {
        $data_ret=array();
		$filter_indicator='';    
		
		
        if($report_of_year !='')
        { 
			if($report_click_btn==1){$filter_indicator='101,105,109,121,125';}//lcd
			if($report_click_btn==2){$filter_indicator='113,117';}//hcd
			if($report_click_btn==3){$filter_indicator='101,105,109,113,117,121,125';}//Deposit
			if($report_click_btn==4){$filter_indicator='601,605,609,613,617,621';}//Advance
			if($report_click_btn==5){$filter_indicator='1809,1813,1817';}//CL Amount
			if($report_click_btn==6){$filter_indicator='5101';}//PL
			if($report_click_btn==7){$filter_indicator='101,105,109,121,125';}//lcd%
			if($report_click_btn==8){$filter_indicator='113,117';}//hcd%
			if($report_click_btn==9){$filter_indicator='1809,1813,1817';}//CL%
			//
			
			$keep_tr='';
            for ($m=0; $m<=12; $m++) 
            {
                    $yesrTxt="$report_of_year";
                                        
                    $conVal=$report_of_year.'-'.($m+1).'-01';
                    $conStr="WHERE om_dat_date<'$conVal'";
                    
                    if($m==0)
                    {
                        $yesrTxt_yr=$report_of_year-1;
                        $yesrTxt="$yesrTxt_yr";
                        $conStr="WHERE om_dat_date<'$report_of_year'";
                    }
                    if($m==12)
                    {
                        $conVal=($report_of_year+1).'-01-01';
                        $conStr="WHERE om_dat_date<'$conVal'";
                    }
                    
                    //$data_ret[$m]['month_name']=date('M', mktime(0,0,0,$m))."/".substr($yesrTxt,2);
					$data_ret[$m]['month_name']=date('M',strtotime("2000-$m-01"))."/".substr($yesrTxt,2);
                    if(date('M', mktime(0,0,0,$m))==date('M'))
                    {
                     $data_ret[$m]['current_month']=1;   
                    }
                    
                    $Q =  $this->db->query("SELECT MAX(om_dat_date) as 'cal_date' FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] $conStr");
                    
                    if($Q->num_rows()>0)
                    {
                        $date='';
                        $cal_date_arr=$Q->row_array();
                        $date = $cal_date_arr['cal_date'];  
                        $data_ret[$m]['month_date'] = $date;
                        
                        if($date !='' && $date!=$keep_tr)
                        {
                          //deposit
                          $data_ret[$m]['deposit']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array($filter_indicator))/10000000;
                          $data_ret[$m]['total_deposit']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101','105','109','113','117','121','125'))/10000000;                  
                        }
						if($report_click_btn==7||$report_click_btn==8)
						{
							if(isset($data_ret[$m]['total_deposit']) && $data_ret[$m]['total_deposit']>0)
							{
								$data_ret[$m]['deposit']=($data_ret[$m]['deposit']/$data_ret[$m]['total_deposit'])*100;
							}
							else
							{
								$data_ret[$m]['deposit']=0;
							}
							
						}
						if($report_click_btn==9)
						{
							$data_ret[$m]['total_cl']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1801','1805','1809','1813','1817'))/10000000;                  
							$data_ret[$m]['total_stfloan']=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('621'))/10000000;                  
							$data_ret[$m]['_cl']=$data_ret[$m]['total_cl']-$data_ret[$m]['total_stfloan'];
							if(isset($data_ret[$m]['_cl']) && $data_ret[$m]['_cl']>0 && isset($data_ret[$m]['deposit']))
							{
								$data_ret[$m]['deposit']=($data_ret[$m]['deposit']/$data_ret[$m]['_cl'])*100;
							}
							else
							{
								$data_ret[$m]['deposit']=0;
							}
						}
						$keep_tr=$date;
                    }
					
            }
                        
        }
		
        return $data_ret; 
    }
    //end misd_0022
	
	
 //VSM Start
    
    function save_vsm_data($office_id=0)
    {
        $status='error';
        if($office_id>0)
        {
            $vsm_data_sb_dt=date('Y-m-d');
            $vsm_data_uid=$this->session->userdata('some_uid');
            $data = array( 
                'vsm_data_off_code'	            => $office_id,
     			'vsm_data_sb_dt' 	            => $vsm_data_sb_dt,
                'vsm_data_uid'	                => $vsm_data_uid,             
                'steel_frame_YN'	            => isset($_POST['steel_frame_YN'])?$_POST['steel_frame_YN']:'',
                'security_door_YN' 	            => isset($_POST['security_door_YN'])?$_POST['security_door_YN']:'',
                'security_FRW_YN'	            => isset($_POST['security_FRW_YN'])?$_POST['security_FRW_YN']:'',
                'vault_room_position'	        => $_POST['vault_room_position'],
                'building_position'	            => $_POST['building_position'],
                'construction_year'	            => $_POST['construction_year'],
                'iron_safe_age'	                => $_POST['iron_safe_age'],
                'iron_safe_present_condition'	=> $_POST['iron_safe_present_condition'],
                'building_plan_approval_YN'	    => isset($_POST['building_plan_approval_YN'])?$_POST['building_plan_approval_YN']:'',
                'branch_surrounding'	        => $_POST['branch_surrounding'],
                'window_position_YN'	        => isset($_POST['window_position_YN'])?$_POST['window_position_YN']:'',
                'window_layer_YN'	            => isset($_POST['window_layer_YN'])?$_POST['window_layer_YN']:'',
                'distance_adjacent_road'	    => $_POST['distance_adjacent_road'],
                'high_voltage_object_YN'	    => isset($_POST['high_voltage_object_YN'])?$_POST['high_voltage_object_YN']:'',
                'other_materials'	            => $_POST['other_materials'],     
                'repair_no'	                    => $_POST['repair_no'],
                'premises_area'	                => $_POST['premises_area'],
                'total_premises_rent'	        => $_POST['total_premises_rent'],
                'rent_agreement_dt_from'	    => $_POST['rent_agreement_dt_from'],
                'rent_agreement_dt_to'	        => $_POST['rent_agreement_dt_to'],   				
                'CCTV_YN' 	                    => isset($_POST['CCTV_YN'])?$_POST['CCTV_YN']:'',
                'security_alarm_YN'	            => isset($_POST['security_alarm_YN'])?$_POST['security_alarm_YN']:'',
                'automated_IS_YN' 	            => isset($_POST['automated_IS_YN'])?$_POST['automated_IS_YN']:'',
                'automatic_fireEX_YN'	        => isset($_POST['automatic_fireEX_YN'])?$_POST['automatic_fireEX_YN']:'',
                'last_drill_dt'	                => $_POST['last_drill_dt'],
                'fireEx_expiry_dt'	            => $_POST['fireEx_expiry_dt'],
                'atm_cctv_YN'	                => isset($_POST['atm_cctv_YN'])?$_POST['atm_cctv_YN']:'',
                'atm_security_YN'	            => isset($_POST['atm_security_YN'])?$_POST['atm_security_YN']:'',                
                'insurance_dt'	                => $_POST['insurance_dt'],
                'insurance_exp_dt' 	            => $_POST['insurance_exp_dt'],                
                'cash_safe_limit'	            => $_POST['cash_safe_limit'],
				'cash_counter_limit'	        => $_POST['cash_counter_limit'],
				'cash_transit_limit'	        => $_POST['cash_transit_limit'],
                'approval_authority_name'	    => $_POST['approval_authority_name'],
                'approval_authority_dsg'	    => $_POST['approval_authority_dsg'],
                'mutilated_note_1' 	            => $_POST['mutilated_note_1'],
				'mutilated_note_2' 	            => $_POST['mutilated_note_2'],
                'mutilated_note_5' 	            => $_POST['mutilated_note_5'],
                'mutilated_note_10' 	        => $_POST['mutilated_note_10'],
                'mutilated_note_20' 	        => $_POST['mutilated_note_20'],
                'mutilated_note_50' 	        => $_POST['mutilated_note_50'],
                'mutilated_note_100' 	        => $_POST['mutilated_note_100'],
                'mutilated_note_500' 	        => $_POST['mutilated_note_500'],
                'mutilated_note_1000' 	        => $_POST['mutilated_note_1000'],
                'cash_carried' 	                => $_POST['cash_carried'],
                'cash_outside_YN'	            => isset($_POST['cash_outside_YN'])?$_POST['cash_outside_YN']:'',                
    			'VS_checked_AO_date' 	        => $_POST['VS_checked_AO_date'],
                'VS_checked_AO_name'	        => $_POST['VS_checked_AO_name'],
                'VS_checked_AO_dsg'	            => $_POST['VS_checked_AO_dsg'],
                'VS_checked_DO_date' 	        => $_POST['VS_checked_DO_date'],
                'VS_checked_DO_name'	        => $_POST['VS_checked_DO_name'],
                'VS_checked_DO_dsg'	            => $_POST['VS_checked_DO_dsg'],
                'VS_checked_HO_date'	        => $_POST['VS_checked_HO_date'],
                'VS_checked_HO_name'	        => $_POST['VS_checked_HO_name'],
                'VS_checked_HO_dsg'	            => $_POST['VS_checked_HO_dsg'],
                'VS_checked_BB_date' 	        => $_POST['VS_checked_BB_date'],
    			'VS_checked_BB_name' 	        => $_POST['VS_checked_BB_name'],
                'VS_checked_BB_dsg'	            => $_POST['VS_checked_BB_dsg'],
                'VS_checked_CO_date'	        => $_POST['VS_checked_CO_date'],
                'VS_checked_CO_name'	        => $_POST['VS_checked_CO_name'],
                'VS_checked_CO_dsg'	            => $_POST['VS_checked_CO_dsg'],                
                'approved_head_of_branch_name'	=> $_POST['approved_head_of_branch_name'],
                'approved_head_of_branch_dsg'	=> $_POST['approved_head_of_branch_dsg'],
                'approved_manager_name'	        => $_POST['approved_manager_name'],
                'approved_manager_dsg'	        => $_POST['approved_manager_dsg'],
                'approved_asst_manager_name'	=> $_POST['approved_asst_manager_name'],
                'approved_asst_manager_dsg'	    => $_POST['approved_asst_manager_dsg'],
                'approved_cashier_name'	        => $_POST['approved_cashier_name'],
                'approved_cashier_dsg'	        => $_POST['approved_cashier_dsg']
    		);
        }

        if(isset($_POST['IU']) && $_POST['IU']=='I')
        {
            if($this->db->insert('vsm_data_detail', $data))
            {
                $status='success';
            }  
        }
        
        if(isset($_POST['IU']) && $_POST['IU']=='U')
        {
            $sign=$this->save_vsm_data_history($office_id);
            if($sign==1)
            {
                if($this->db->delete('vsm_data_detail', array('vsm_data_off_code' => $office_id)))
                {
                    if($this->db->insert('vsm_data_detail', $data))
                    {
                        $status='success';
                    }   
                }   
            }
        }
        
        return $status;
        		
    }
    
    
    function save_vsm_data_history($office_id=0)
    {
        $status=0;
        if($office_id>0)
        {
            $pre_data_array=$this->get_branch_vsm_report($office_id);
            if(!empty($pre_data_array))
            {
                $history_data_array = array( 
                    'vsm_data_off_code'	            => $pre_data_array['vsm_data_off_code'],
         			'vsm_data_sb_dt' 	            => $pre_data_array['vsm_data_sb_dt'],
                    'vsm_data_uid'	                => $pre_data_array['vsm_data_uid'],            
                    'steel_frame_YN'	            => $pre_data_array['steel_frame_YN'],
                    'security_door_YN' 	            => $pre_data_array['security_door_YN'],
                    'security_FRW_YN'	            => $pre_data_array['security_FRW_YN'],
                    'vault_room_position'	        => $pre_data_array['vault_room_position'],
                    'building_position'	            => $pre_data_array['building_position'],
                    'construction_year'	            => $pre_data_array['construction_year'],
                    'iron_safe_age'	                => $pre_data_array['iron_safe_age'],
                    'iron_safe_present_condition'	=> $pre_data_array['iron_safe_present_condition'],
                    'building_plan_approval_YN'	    => $pre_data_array['building_plan_approval_YN'],
                    'branch_surrounding'	        => $pre_data_array['branch_surrounding'],
                    'window_position_YN'	        => $pre_data_array['window_position_YN'],
                    'window_layer_YN'	            => $pre_data_array['window_layer_YN'],
                    'distance_adjacent_road'	    => $pre_data_array['distance_adjacent_road'],
                    'high_voltage_object_YN'	    => $pre_data_array['high_voltage_object_YN'],
                    'other_materials'	            => $pre_data_array['other_materials'],  
                    'repair_no'	                    => $pre_data_array['repair_no'],
                    'premises_area'	                => $pre_data_array['premises_area'],
                    'total_premises_rent'	        => $pre_data_array['total_premises_rent'],
                    'rent_agreement_dt_from'	    => $pre_data_array['rent_agreement_dt_from'],
                    'rent_agreement_dt_to'	        => $pre_data_array['rent_agreement_dt_to'],  					
                    'CCTV_YN' 	                    => $pre_data_array['CCTV_YN'],
                    'security_alarm_YN'	            => $pre_data_array['security_alarm_YN'],
                    'automated_IS_YN' 	            => $pre_data_array['automated_IS_YN'],
                    'automatic_fireEX_YN'	        => $pre_data_array['automatic_fireEX_YN'],
                    'last_drill_dt'	                => $pre_data_array['last_drill_dt'],
                    'fireEx_expiry_dt'	            => $pre_data_array['fireEx_expiry_dt'],
                    'atm_cctv_YN'	                => $pre_data_array['atm_cctv_YN'],
                    'atm_security_YN'	            => $pre_data_array['atm_security_YN'],                
                    'insurance_dt'	                => $pre_data_array['insurance_dt'],
                    'insurance_exp_dt' 	            => $pre_data_array['insurance_exp_dt'],                
                    'cash_safe_limit'	            => $pre_data_array['cash_safe_limit'],
    				'cash_counter_limit'	        => $pre_data_array['cash_counter_limit'],
    				'cash_transit_limit'	        => $pre_data_array['cash_transit_limit'],
                    'approval_authority_name'	    => $pre_data_array['approval_authority_name'],
                    'approval_authority_dsg'	    => $pre_data_array['approval_authority_dsg'],
                    'mutilated_note_1' 	            => $pre_data_array['mutilated_note_1'],
    				'mutilated_note_2' 	            => $pre_data_array['mutilated_note_2'],
                    'mutilated_note_5' 	            => $pre_data_array['mutilated_note_5'],
                    'mutilated_note_10' 	        => $pre_data_array['mutilated_note_10'],
                    'mutilated_note_20' 	        => $pre_data_array['mutilated_note_20'],
                    'mutilated_note_50' 	        => $pre_data_array['mutilated_note_50'],
                    'mutilated_note_100' 	        => $pre_data_array['mutilated_note_100'],
                    'mutilated_note_500' 	        => $pre_data_array['mutilated_note_500'],
                    'mutilated_note_1000' 	        => $pre_data_array['mutilated_note_1000'],
                    'cash_carried' 	                => $pre_data_array['cash_carried'],
                    'cash_outside_YN'	            => $pre_data_array['cash_outside_YN'],                
        			'VS_checked_AO_date' 	        => $pre_data_array['VS_checked_AO_date'],
                    'VS_checked_AO_name'	        => $pre_data_array['VS_checked_AO_name'],
                    'VS_checked_AO_dsg'	            => $pre_data_array['VS_checked_AO_dsg'],
                    'VS_checked_DO_date' 	        => $pre_data_array['VS_checked_DO_date'],
                    'VS_checked_DO_name'	        => $pre_data_array['VS_checked_DO_name'],
                    'VS_checked_DO_dsg'	            => $pre_data_array['VS_checked_DO_dsg'],
                    'VS_checked_HO_date'	        => $pre_data_array['VS_checked_HO_date'],
                    'VS_checked_HO_name'	        => $pre_data_array['VS_checked_HO_name'],
                    'VS_checked_HO_dsg'	            => $pre_data_array['VS_checked_HO_dsg'],
                    'VS_checked_BB_date' 	        => $pre_data_array['VS_checked_BB_date'],
        			'VS_checked_BB_name' 	        => $pre_data_array['VS_checked_BB_name'],
                    'VS_checked_BB_dsg'	            => $pre_data_array['VS_checked_BB_dsg'],
                    'VS_checked_CO_date'	        => $pre_data_array['VS_checked_CO_date'],
                    'VS_checked_CO_name'	        => $pre_data_array['VS_checked_CO_name'],
                    'VS_checked_CO_dsg'	            => $pre_data_array['VS_checked_CO_dsg'],                
                    'approved_head_of_branch_name'	=> $pre_data_array['approved_head_of_branch_name'],
                    'approved_head_of_branch_dsg'	=> $pre_data_array['approved_head_of_branch_dsg'],
                    'approved_manager_name'	        => $pre_data_array['approved_manager_name'],
                    'approved_manager_dsg'	        => $pre_data_array['approved_manager_dsg'],
                    'approved_asst_manager_name'	=> $pre_data_array['approved_asst_manager_name'],
                    'approved_asst_manager_dsg'	    => $pre_data_array['approved_asst_manager_dsg'],
                    'approved_cashier_name'	        => $pre_data_array['approved_cashier_name'],
                    'approved_cashier_dsg'	        => $pre_data_array['approved_cashier_dsg']
        		);
                
                if($this->db->insert('vsm_data_detail_history', $history_data_array))
                {
                    $status=1;
                }  
            }

        }
        
        return $status;        		
    }
    
    function get_branch_vsm_report($office_id=0)
    {
        $data_ret=array();
        $Q =  $this->db->query("SELECT * FROM vsm_data_detail WHERE vsm_data_off_code=".$office_id."  ");  
        
        $data_ret=$Q->row_array();
        if(!empty($data_ret))
        {
            $data_ret['approval_authority_dsg_full']='';
            $data_ret['VS_checked_AO_dsg_full']='';
            $data_ret['VS_checked_DO_dsg_full']='';
            $data_ret['VS_checked_HO_dsg_full']='';
            $data_ret['VS_checked_BB_dsg_full']='';
            $data_ret['VS_checked_CO_dsg_full']='';
            $data_ret['approved_head_of_branch_dsg_full']='';
			$data_ret['approved_manager_dsg_full']='';
            $data_ret['approved_asst_manager_dsg_full']='';
            $data_ret['approved_cashier_dsg_full']='';
            
            if(isset($data_ret['approval_authority_dsg']) && $data_ret['approval_authority_dsg']>0){$data_ret['approval_authority_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['approval_authority_dsg'],0);}
            if(isset($data_ret['VS_checked_AO_dsg']) && $data_ret['VS_checked_AO_dsg']>0){$data_ret['VS_checked_AO_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['VS_checked_AO_dsg'],0);}
            if(isset($data_ret['VS_checked_DO_dsg']) && $data_ret['VS_checked_DO_dsg']>0){$data_ret['VS_checked_DO_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['VS_checked_DO_dsg'],0);}
            if(isset($data_ret['VS_checked_HO_dsg']) && $data_ret['VS_checked_HO_dsg']>0){$data_ret['VS_checked_HO_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['VS_checked_HO_dsg'],0);}
            if(isset($data_ret['VS_checked_BB_dsg']) && $data_ret['VS_checked_BB_dsg']>0){$data_ret['VS_checked_BB_dsg_full']=$this->get_dsg_details_by_code('dsg_BB',$data_ret['VS_checked_BB_dsg'],0);}
            if(isset($data_ret['VS_checked_CO_dsg']) && $data_ret['VS_checked_CO_dsg']>0){$data_ret['VS_checked_CO_dsg_full']=$this->get_dsg_details_by_code('dsg_CO',$data_ret['VS_checked_CO_dsg'],0);}
            if(isset($data_ret['approved_head_of_branch_dsg']) && $data_ret['approved_head_of_branch_dsg']>0){$data_ret['approved_head_of_branch_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['approved_head_of_branch_dsg'],0);}
			if(isset($data_ret['approved_manager_dsg']) && $data_ret['approved_manager_dsg']>0){$data_ret['approved_manager_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['approved_manager_dsg'],0);}
			if(isset($data_ret['approved_asst_manager_dsg']) && $data_ret['approved_asst_manager_dsg']>0){$data_ret['approved_asst_manager_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['approved_asst_manager_dsg'],0);}
            if(isset($data_ret['approved_cashier_dsg']) && $data_ret['approved_cashier_dsg']>0){$data_ret['approved_cashier_dsg_full']=$this->get_dsg_details_by_code('DMS_Designation',$data_ret['approved_cashier_dsg'],0);}
        }
        return $data_ret;
    }
    
    function get_dsg_details_by_code($tbl_name='',$dsg_code='',$return_ptr=0)
    {
        $dsg_str='';
        if($tbl_name !='')
        {
            $select='';
            if($return_ptr=='0'){$select='Dsg_SHort';}
            if($return_ptr=='1'){$select='Dsg_Desc';}
            
            if($select !='')
            {
              $Q =  $this->db->query("select DISTINCT $select from $tbl_name WHERE Dsg_Code=".$dsg_code." "); 
                $data_temp=$Q->row_array();
                if(!empty($data_temp))
                {
                   if($return_ptr=='0')
                   {
                        if(isset($data_temp['Dsg_SHort']) && $data_temp['Dsg_SHort'] !='')
                        {
                          $dsg_str=$data_temp['Dsg_SHort'];  
                        }
                   }
                   if($return_ptr=='1')
                   {
                        if(isset($data_temp['Dsg_Desc']) && $data_temp['Dsg_Desc'] !='')
                        {
                          $dsg_str=$data_temp['Dsg_Desc'];  
                        }
                   } 
                } 
            }
        }
        
        return $dsg_str;
    }
    
    function fetch_vsm_missing_completed($branch_id_array_for_report=array())
    {
        
        $count_in_branch=count($branch_id_array_for_report);
        $data=array();
        $select=" [Br Code] as br_code,[Br Name] as br_name ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM VW_Br WHERE [Br Code] IN $IN_con"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;
            if(isset($val['br_code']))
            {
               $brcode=$val['br_code'];
               $Q =  $this->db->query("SELECT * FROM vsm_data_detail WHERE vsm_data_off_code=".$brcode." ");
               if($Q->num_rows()>0)
               {
                $data[$key]['status']=1;
               }
               else
               {
                $data[$key]['status']=0;
               }
               $QQ1 =  $this->db->query("SELECT * FROM allinformation WHERE brcode='$brcode' ");
               $data[$key]['office_phone']='';
               if($QQ1->num_rows()>0)
               {
                $p=$QQ1->result_array();
                $data[$key]['office_phone']=$p[0]['OfficePhone'];
               }
            }
          } 
        }
        
        return $data;
    }
	
	function get_jb_designation_dropdown()
	{
		$data=array();
		$data['']='Select Designation';
		
		$query =  $this->db->query("SELECT Dsg_Code,Dsg_SHort FROM DMS_Designation");
										
		if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data[$row['Dsg_Code']]=$row['Dsg_SHort'];
			}
		}
		return $data;
	}
    
   	function get_BB_designation_dropdown()
	{
		$data=array();
		$data['']='Select Designation';
		
		$query =  $this->db->query("SELECT dsg_code,dsg_short FROM dsg_BB");
										
		if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data[$row['dsg_code']]=$row['dsg_short'];
			}
		}
		return $data;
	}
    
   	function get_CO_designation_dropdown()
	{
		$data=array();
		$data['']='Select Designation';
		
		$query =  $this->db->query("SELECT dsg_code,dsg_short FROM dsg_CO");
										
		if($query->num_rows > 0)
		{
			foreach($query->result_array() as $key=>$row)
			{
				$data[$row['dsg_code']]=$row['dsg_short'];
			}
		}
		return $data;
	}
	
	function fetch_branch_array_for_report_vsm($office_id=0,$report_option_id=0)
    {
        $data=array();
        $condition=" WHERE jbbrcode NOT IN(0931,0932,0933,0934,9999)";
        if($report_option_id==1)
        {
          $status=$this->get_login_office_status($office_id);
          if($status==4){$condition=" WHERE jbbrcode='$office_id' ";}
          if($status==3){$condition=" WHERE ZoneCode='$office_id' ";}
          if($status==2){$condition=" WHERE jbdivisioncode='$office_id' ";}  
        }
        else if($report_option_id==2)
        {
          $condition=" WHERE jbbrcode='$office_id' ";  
        }
        else if($report_option_id==3)
        {
           $condition=" WHERE ZoneCode='$office_id' ";  
        }
        else if($report_option_id==4)
        {
           $condition=" WHERE jbdivisioncode='$office_id' ";  
        }

        else if($report_option_id==6)
        {
           $condition=" WHERE jbdivisioncode='$office_id' AND ZoneName LIKE '%CORP%' AND BRANCH_NAME LIKE '%CORP%'";  
        }
        
        //$Q =  $this->db->query("SELECT jbbrcode,BRANCH_NAME FROM vw_jb_div_zn_br  $condition"); 
		$Q =  $this->db->query("SELECT jbbrcode,BRANCH_NAME,ZoneCode,ZoneName,jbdivisioncode,DivisionName FROM vw_jb_div_zn_br  $condition  ORDER BY jbdivisioncode,ZoneCode,jbbrcode" );
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          } 
        }
        return $data; 
    }
    
    //VSM END
	
	
	
	//////////////////////////WEEKLY POSITION START/////////////////
 function get_weekly_position_option()
    {
			$query =  $this->db->query("select a.*,b.*
									from weekly_position_group as a,weekly_position_subgroup as b
									where a.weekly_position_group_code=b.weekly_position_group_code
									order by b.weekly_position_group_code,b.weekly_position_subgroup_code");									
									
		return $query->result(); 
    }
	
	function weekly_position_date($status=0)
	{
	  $where='';
	  if($status==1){
	   $where=' where date_status=1 ';
	  }
	   $query =  $this->db->query("SELECT convert(char(12),weekly_date,107) weekly_date 
								   from weekly_position_date_entry 
								   $where order by date_sl desc");
        return $query->result();
	}
	function get_weekly_group()
    {
        $query =  $this->db->query("select * from weekly_position_group order by weekly_position_group_order asc");       
		return $query->result(); 
    }
    
	function save_weekly_position_data($office_id=0)
    {
	    $status='error';
                
        $previous_weekly_pos_arr=$this->get_branch_weekly_pos_report($office_id,$_POST['weekly_date']);
        
        if(count($previous_weekly_pos_arr)>0)
        {
            $status='notice';
        }
        else
        {
				
				
				$amount=$this->input->post('amount');
				$weekly_subgroup_code=$this->input->post('weekly_position_subgroup_code');
				$weekly_data_uid=$this->session->userdata('some_uid');
				$OFF_ID= $this->session->userdata('some_office');
				$UID= $this->session->userdata('some_uid');
				$weekly_data_sb_dt=date('Y-m-d');
				$c=0;
				foreach($amount as $amountVal)
				{
					$amountVal=round($amountVal,2);
					$data = array( 
							'weekly_br_code'	    => $OFF_ID,
							'weekly_prod_subgroup_code'	=> $weekly_subgroup_code[$c],
							'weekly_position_date' 	=> $_POST['weekly_date'],
							'weekly_amt' 	    => (float)$amountVal,
							'weekly_uid'	=> $UID,
							'weekly_data_date'	    => $weekly_data_sb_dt
						);
						
						if($this->mymodel->add_weekly_position_data($data,$_POST['weekly_date'])==1)
						{
							$status='success';
						}
						$c++;           
				}
        }
		
        return $status;
	        		
    }
	function add_weekly_position_data($data,$DATE) 
	{
        //data table extract from date
        $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($DATE);
        
        //now insert data
        if($this->db->insert($tbl_name, $data))
		{
			return 1;
		}
		else
		{
		return 0;
		}
		
	}
	function edit_weekly_position_data($office_id,$DATE) 
	{
	    $status='error';
                
        //delete data first
        $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($DATE);
		$this->db->where('weekly_br_code',$office_id);
		$this->db->where('weekly_position_date',$DATE);
		if($this->db->delete($tbl_name))//delete success
		{
			$amount=$this->input->post('amount');
			$weekly_subgroup_code=$this->input->post('weekly_position_subgroup_code');
			$weekly_data_uid=$this->session->userdata('some_uid');
			$OFF_ID= $this->session->userdata('some_office');
			$UID= $this->session->userdata('some_uid');
			$weekly_data_sb_dt=date('Y-m-d');
			$c=0;
			foreach($amount as $amountVal)
			{
				$amountVal=round($amountVal,2);
				$data = array( 
						'weekly_br_code'	    => $office_id,
						'weekly_prod_subgroup_code'	=> $weekly_subgroup_code[$c],
						'weekly_position_date' 	=> $_POST['weekly_date'],
						'weekly_amt' 	    => (float)$amountVal,
						'weekly_uid'	=> $UID,
						'weekly_data_date'	    => $weekly_data_sb_dt
					);
					
					if($this->mymodel->add_weekly_position_data($data,$_POST['weekly_date'])==1)
					{
						$status='success';
					}
					$c++;           
				}
		}
		
        return $status;
		
	}
	function get_branch_weekly_pos_report($office_id=0,$weekly_date=0)
    {
		 $data=array();
		 $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($weekly_date);
		 if($this->db->table_exists($tbl_name) == FALSE)
		 {
			return $data;
		 }
		 else
		 {
			 $Q =  $this->db->query("SELECT * FROM $tbl_name WHERE weekly_br_code='".$office_id."' AND weekly_position_date='".$weekly_date."' order by weekly_prod_subgroup_code ");  
			 return $Q->result();
		 }
    }
	function generate_weekly_position_new_tbl($DATE='')
	{

        //data table extract from date
        $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($DATE);
        
        //create table if not exist
        if( $this->db->table_exists($tbl_name) == FALSE)
        {
             $query = "CREATE TABLE $tbl_name
                    (
                        sl_no int NOT NULL PRIMARY KEY IDENTITY,
                        weekly_br_code char(4),
                        weekly_prod_subgroup_code int,
                        weekly_position_date smalldatetime,
                        weekly_amt numeric(20, 2),
                        weekly_uid varchar(10),
                        weekly_data_date smalldatetime,
                    );";

            $this->db->query($query);
        }
     
	}
	function get_weekly_position_data_tbl_name_to_insert($date='')
	{
		
		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='weekly_data_'.$tbl_arr[0].'_'.$tbl_arr[1];
            }  
        }
        
        return $tbl_name;
     
	}
	
	function delete_weekly_data($OFF_ID,$DATE)
	{
        //data table extract from date
        $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($DATE);
        
        $query =  $this->db->query("SELECT * FROM $tbl_name where weekly_br_code=$OFF_ID AND weekly_position_date='$DATE' ORDER BY weekly_prod_subgroup_code");        
         //return $query->result();
		 if ($query->num_rows() > 0){return true;}
		 else
		 {return  false;}
	}
	
	function delete_weekly($OFF_ID,$DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($DATE);
        
        $this->db->query("delete from $tbl_name where weekly_br_code=$OFF_ID AND weekly_position_date='$DATE'");        
        
	}
	
	function get_edit_mode_weekly_data($office_id=0)
	{
		
		$data_ret=array();
		$current_date=date("Y-m-d 0:0:0");
        $Q =  $this->db->query("select weekly_date FROM [Db_DP_Collection_mgr].[dbo].[weekly_position_date_entry] WHERE weekly_date<'$current_date' ORDER BY weekly_date DESC");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
			$DATE=$row['weekly_date'];
            //data table extract from date
            $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($DATE);
			if($this->db->table_exists($tbl_name) == TRUE)
			{
				$query =  $this->db->query("SELECT * FROM $tbl_name where weekly_position_date='$DATE' AND weekly_br_code=$office_id ORDER BY weekly_prod_subgroup_code");
				if($query->num_rows()>0)
				{
					return $query->result();
				}
			}
          } 
        }
		
		return $data_ret;
     
	}
	
	function get_omis_date_exists($fetch_date)
	{
		$status=0;
		$Q =  $this->db->query("select om_dat_date FROM [Db_DP_Collection_mgr].[dbo].[om_entry_date] WHERE om_dat_date='$fetch_date' ");
		if($Q->num_rows()>0)
		{
			$status=1;
			
		}
		
		return $status;
	
	}
	
	function get_omis_data_exists($branch_id=0,$fetch_date='')
	{
		$tbl_name=$this->get_omis_data_tbl_name($fetch_date);
		$query =  $this->db->query("SELECT * FROM $tbl_name where dd_end_dt='$fetch_date' AND dd_jo_code=$branch_id ");
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	}
	
	function fetch_omis_dep_adv_cash_data($branch_id=array(),$date='')
    {
        $data_ret=array();
		
		if($date !='')
        {
          $data_ret['deposit']=$this->calculate_omis_terms_sum($branch_id,$date,array('101','105','109','113','117','121','125','301'));         
          $data_ret['advance']=$this->calculate_omis_terms_sum($branch_id,$date,array('601','605','609','613','617','621'));
		  $data_ret['cashin_hand']=$this->calculate_omis_terms_sum($branch_id,$date,array('4201'));
        }
		
		return $data_ret; 
        
    }
	function fetch_weekly_pos_data_details($branch_id_array_for_report=array(),$report_of_date='')
    {
        $count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($report_of_date);
        
        $select=" * ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM $tbl_name WHERE weekly_position_date='$report_of_date' AND weekly_br_code IN $IN_con");      
        return $Q->result();
        
        
    }
function fetch_weekly_data_details_completed_vs_total($branch_id_array_for_report=array(),$report_of_date='')
    {
        $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($report_of_date);
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $data=array();
        $data['total']=$count_in_branch;
        $data['completed']=0;
        $Q =  $this->db->query("SELECT DISTINCT(weekly_br_code) FROM $tbl_name WHERE weekly_position_date='$report_of_date' AND  weekly_br_code IN $IN_con"); 
        if($Q->num_rows()>0)
        {
            $data['completed']=$Q->num_rows();
        }
        
        return $data;
    }
  
 function fetch_weekly_pos_missing_completed($branch_id_array_for_report=array(),$report_of_date='')
    {
        
		$tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($report_of_date);
        $count_in_branch=count($branch_id_array_for_report);
		$data=array();
        $select=" brcode,branchname,dvname,znname,OfficePhone,Address ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM allinformation WHERE brcode IN $IN_con ORDER BY dvname,znname,branchname"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;
            if(isset($val['brcode']))
            {
               $brcode=$val['brcode'];
               $Q =  $this->db->query("SELECT sl_no FROM $tbl_name WHERE weekly_br_code='$brcode' AND weekly_position_date='$report_of_date'");
               if($Q->num_rows()>0)
               {
                $data[$key]['status']=1;
               }
               else
               {
                $data[$key]['status']=0;
               }
            }
          } 
        }
        return $data;
    }
  function fetch_calculated_branch_id_array_for_report($branch_id_array_for_report=array(),$records3=array())
	{
		$data_ret=array();
		if(count($branch_id_array_for_report)>0)
		{
			foreach($branch_id_array_for_report as $key=>$row)
			{
				foreach ($records3 as $key => $val) {
					if ($val->weekly_br_code === $row['jbbrcode']) {
					   $data_ret[]=$row;
					   break;
					}
				}
				
			}
		}
		
		return $data_ret;
		
	}

//////////////////////////WEEKLY POSITION END//////////////////


    //misd_0023 start
    function fetch_range_wise_ADR_data($branch_id_array_for_report=array(),$date='',$i='')
    {   
		
		$data_ret=array();
        if($date !='' && count($branch_id_array_for_report)>0 && $i !='')
        {
            //get table name
            $tbl_name=$this->get_omis_data_tbl_name($date);
            
            //filter branch
            $count_in_branch=count($branch_id_array_for_report);
            $IN_con='';
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
            
            //condition applied
            $range_condition='';
            if($i==1){$range_condition="AND xx.ADR>=0 AND xx.ADR<11";}
            elseif($i==11){$range_condition="AND xx.ADR>=100";}
            else
			{ 
				$st=((($i-1)*10)+1); 
				$end=(((($i-1)*10)+10)+1);
				if($i==10)
				{
					$end=((($i-1)*10)+10);
				}
				$range_condition="AND xx.ADR>=$st AND xx.ADR<$end";
			} 
		$Q =  $this->db->query("set NUMERIC_ROUNDABORT OFF");
		  $Q =  $this->db->query(" select  
                                    sum(case when xx.tag='x' $range_condition then xx.Advance else 0 end) as 'total_advance_withLCA',
                                    (((CAST(sum(case when xx.tag='x' $range_condition then xx.Advance else 0 end) AS NUMERIC(18,2)))*100)/CAST(sum(case when xx.tag='x' then xx.Advance else 0 end) AS NUMERIC(18,2))) as 'per_total_advance_withLCA',
                                    sum(case when xx.tag='x' $range_condition then 1 else 0 end) as 'total_br_withLCA',
                                    ((CAST(sum(case when xx.tag='x' $range_condition then 1 else 0 end) AS NUMERIC(18,2))*100)/CAST(sum(case when xx.tag='x' then 1 else 0 end) AS NUMERIC(18,2))) as 'per_total_br_withLCA',
                                    sum(case when xx.tag='y' $range_condition then xx.Advance else 0 end) as 'total_advance_withoutLCA',
                                    ((CAST(sum(case when xx.tag='y' $range_condition then xx.Advance else 0 end) AS NUMERIC(18,2))*100)/CAST(sum(case when xx.tag='y' then xx.Advance else 0 end) AS NUMERIC(18,2))) as 'per_total_advance_withoutLCA',
                                    sum(case when xx.tag='y' $range_condition then 1 else 0 end) as 'total_br_withoutLCA',
                                    ((CAST(sum(case when xx.tag='y' $range_condition then 1 else 0 end) AS NUMERIC(18,2))*100)/CAST(sum(case when xx.tag='y' then 1 else 0 end) AS NUMERIC(18,2))) as 'per_total_br_withoutLCA'
                                    from
                                    ( 
                                        (
                                            SELECT 'x' as tag,A.dd_jo_code as 'office_code',
                                        	Advance= CAST(sum(CASE WHEN A.dd_pt_id IN (601,605,609,613,617,621) THEN A.dd_amt else 0 end) AS NUMERIC(18,2)) 
                                        	,
                                        	ADR= CAST(sum(CASE WHEN A.dd_pt_id IN (601,605,609,613,617,621) THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/ CAST(sum (CASE WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2))
                                        	FROM Db_DP_Collection_mgr.dbo.$tbl_name A , Db_DP_Collection_mgr.dbo.allinformation B 
                                        	where 
                                        	A.dd_jo_code=B.brcode 
                                        	AND A.dd_end_dt='$date'
                                        	group by A.dd_jo_code
                                        	HAVING (sum (CASE WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end))!=0
                                        ) 
                                    	union all
                                    	(	
                                            SELECT 'y' as tag,A.dd_jo_code as 'office_code',
                                        	Advance= CAST(sum(CASE WHEN A.dd_pt_id IN (601,605,609,617) THEN A.dd_amt else 0 end) AS NUMERIC(18,2)) 
                                        	,
                                        	ADR= CAST(sum(CASE WHEN A.dd_pt_id IN (601,605,609,617) THEN A.dd_amt else 0 end)*100 AS NUMERIC(18,2))/ CAST(sum (CASE WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end) AS NUMERIC(18,2))
                                        	FROM Db_DP_Collection_mgr.dbo.$tbl_name A , Db_DP_Collection_mgr.dbo.allinformation B 
                                        	where 
                                        	A.dd_jo_code=B.brcode 
                                        	AND A.dd_end_dt='$date' 
                                        	group by A.dd_jo_code
                                        	HAVING (sum (CASE WHEN A.dd_pt_id IN ('101','105','109','113','117','121','125') THEN A.dd_amt else 0 end))!=0 
                                        ) 
                                   	) 
                                    xx
                                    WHERE xx.office_code IN $IN_con
    		                      ");

           
            if($Q->num_rows()>0)
            {
              foreach($Q->result_array() as $row)
              {
                $data_ret=$row;
              }  
            }
        }
        
        return $data_ret; 
        
    }
    //misd_0023 end


//misd_0032 start 
function fetch_misd_0032_cal_data($branch_id_array_for_report=array(),$report_of_year='',$report_of_month='')
{
	$data_ret=array();
	if(count($branch_id_array_for_report)>0 && $report_of_month !='' && $report_of_year!='')
    {
                       
            //filter branch
            $count_in_branch=count($branch_id_array_for_report);
            $IN_con='';
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
	
	 	 $Q =  $this->db->query("SELECT 
								standard= CAST(SUM(CASE WHEN [scode] NOT IN('61','71','81','91') THEN STANDARD else 0 end) AS NUMERIC(18,2))/100000,
								sma= CAST(SUM(CASE WHEN [scode] NOT IN('61','71','81','91') THEN SMA else 0 end) AS NUMERIC(18,2))/100000,
								total_ucl= CAST(SUM((CASE WHEN [scode] NOT IN('61','71','81','91') THEN STANDARD else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN SMA else 0 end)) AS NUMERIC(18,2))/100000,
								SS= CAST(SUM(CASE WHEN [scode] NOT IN('61','71','81','91') THEN SS else 0 end) AS NUMERIC(18,2))/100000,
								DF= CAST(SUM(CASE WHEN [scode] NOT IN('61','71','81','91') THEN DF else 0 end) AS NUMERIC(18,2))/100000,
								BL= CAST(SUM(CASE WHEN [scode] NOT IN('61','71','81','91') THEN BL else 0 end) AS NUMERIC(18,2))/100000,
								total_cl= CAST(SUM((CASE WHEN [scode] NOT IN('61','71','81','91') THEN SS else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN DF else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN BL else 0 end)) AS NUMERIC(18,2))/100000,
								total_loan= CAST(SUM((CASE WHEN [scode] NOT IN('61','71','81','91') THEN STANDARD else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN SMA else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN SS else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN DF else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN BL else 0 end)) AS NUMERIC(18,2))/100000,
								staff_and_others= CAST(SUM(CASE WHEN [scode] IN ('51','61','71','81','91') THEN STANDARD else 0 end) AS NUMERIC(18,2))/100000,
								grand_total= CAST(sum(STANDARD+SMA+SS+DF+BL)AS NUMERIC(18,2))/100000 ,
								cl_percentage= (CAST(sum((CASE WHEN [scode] NOT IN('61','71','81','91') THEN SS else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN DF else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN BL else 0 end))*100 AS NUMERIC(18,2)))/(CAST(sum((CASE WHEN [scode] NOT IN('61','71','81','91') THEN STANDARD else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN SMA else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN SS else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN DF else 0 end)+(CASE WHEN [scode] NOT IN('61','71','81','91') THEN BL else 0 end)) AS NUMERIC(18,2))) 
								FROM [Db_DP_Collection_mgr].[dbo].[CL1]
								WHERE  
								REPORTING_MONTH=$report_of_month AND REPORTING_YEAR=$report_of_year AND 
								JB_BR_CODE IN $IN_con ");
		if($Q->num_rows()>0)
		{
		  foreach($Q->result_array() as $row)
		  {
			$data_ret=$row;
		  }  
		}					
								
								
								
	}
	
	return $data_ret; 
	
}
//misd_0032 end

//misd_0033 start 
function fetch_misd_0033_cal_data($branch_id_array_for_report=array(),$report_of_year='',$report_of_month='')
{
	$data_ret=array();
	$tbl_name='';
	if($report_of_year!='' && $report_of_month!='')
	{
		$tbl_name="bsdpst".$report_of_month.$report_of_year;
	}
	$Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
	if($Q->num_rows()>0)
	{
		if(count($branch_id_array_for_report)>0 && $report_of_month !='' && $report_of_year!='')
		{
						   
				//filter branch
				$count_in_branch=count($branch_id_array_for_report);
				$IN_con='';
				if($count_in_branch>0)
				{
					$IN_con="(";
					foreach($branch_id_array_for_report as $key=>$val)
					{
						$brcode=$val['jbbrcode'];
						$IN_con .="$brcode";
						if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
					}
					$IN_con .=")";
				}
			
			
				$Q =  $this->db->query("select a.sector as 'sector',b.sector_description as 'sector_title', SUM(a.amount) as 'amount' 
											from 
											$tbl_name a,
											SBSsectorcode b 
											where 
											a.sector=b.sector_code
											and
											jb_br_code IN $IN_con 
											group by a.sector, b.sector_description, a.sector
											order by a.sector asc");

				if($Q->num_rows()>0)
				{
				  $data_ret=$Q->result_array();
				}			
		}
	 	 						
	
	}
	else
	{
		$data_ret='';
	}
	return $data_ret; 
	
}
//misd_0033 end

//misd_0034 start 
function fetch_misd_0034_cal_data($branch_id_array_for_report=array(),$report_of_year='',$report_of_month='')
{
	$data_ret=array();
	$tbl_name='';
	if($report_of_year!='' && $report_of_month!='')
	{
		$tbl_name="bsdpst".$report_of_month.$report_of_year;
	}
	if($report_of_year!='' && $report_of_month!='')
	{
		$tbl_name="bsdpst".$report_of_month.$report_of_year;
	}
	$Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
	if($Q->num_rows()>0)
	{
			if(count($branch_id_array_for_report)>0 && $report_of_month !='' && $report_of_year!='')
		{
						   
				//filter branch
				$count_in_branch=count($branch_id_array_for_report);
				$IN_con='';
				if($count_in_branch>0)
				{
					$IN_con="(";
					foreach($branch_id_array_for_report as $key=>$val)
					{
						$brcode=$val['jbbrcode'];
						$IN_con .="$brcode";
						if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
					}
					$IN_con .=")";
				}
		
			 $Q =  $this->db->query("select a.[type] as 'type',b.depotypedesc as 'type_description',sum(a.amount) as 'amount' 
									from 
									$tbl_name a,
									SBSdeposittypecode b 
									where 
									a.[type]=b.depotypecode
									and
									jb_br_code IN $IN_con 
									group by a.[type],b.depotypedesc,a.[type]  
									order by a.[type] asc
									");

			if($Q->num_rows()>0)
			{
			  $data_ret=$Q->result_array();
			}									
		}
	}
	else
	{
		$data_ret='';
	}
	

	
	return $data_ret; 
	
}
//misd_0034 end

//misd_0035 start
function fetch_misd_0035_cal_data($report_of_office_id=0,$tbl_name='')
{
	$data_ret=array();
	if($tbl_name !='' && $report_of_office_id>0)
	{                           
	   $Q =$this->db->query("SELECT * FROM $tbl_name WHERE BrCode=$report_of_office_id");                               
		$data_ret=$Q->row_array(); 
	}
	return $data_ret; 
	
}
    function get_last_cibta_view_name()
    {
        $last_cibta_view_name='';
        $Q =$this->db->query("SELECT TOP(1) [name]  
                              FROM sys.views 
                              WHERE 
                              name LIKE 'CIBTABR%' AND LEFT(name,7)='CIBTABR' 
                              ORDER BY RIGHT(name,4) DESC,SUBSTRING(name,8,2) DESC ");  
        if($Q->num_rows()>0)
        {
            $last_view_arr=$Q->row_array();
            if(isset($last_view_arr['name']) && $last_view_arr['name'] !='')
            {
                $last_cibta_view_name=$last_view_arr['name'];
            }
        }
        return $last_cibta_view_name; 
    }
//misd_0035 end

    //start misd_0036
    function fetch_cib_data($branch_id_array_for_report=array(),$tbl_name='')
    {
        
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if($tbl_name !='' && $count_in_branch>0)
        {                           
           $Q =$this->db->query("SELECT CIB.*,INFO.branchname,INFO.gradesname,INFO.znname,INFO.dvname FROM $tbl_name AS CIB JOIN Db_DP_Collection_mgr..allinformation AS INFO ON CIB.jb_br_code=INFO.brcode WHERE CIB.ADVANCE_LIMIT>=10000000 AND CIB.jb_br_code IN $IN_con ORDER BY CIB.ADVANCE_LIMIT desc");                               
           $data_ret=$Q->result_array(); 
        }
        return $data_ret; 
    }
    //end misd_0036 
	
	    //start misd_0037
    function fetch_ppr_data($branch_id_array_for_report=array(),$tbl_name='',$month=0)
    {
        
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if($tbl_name !='' && $count_in_branch>0 && $month>0)
        {                           
           $fields = $this->db->list_fields("$tbl_name");
           if(count($fields)>0)
           {
            $select_option='';
            $out_field_arr=array('mYear','mMonth','BrCode','BBBrCode','Status1','Status2','Status3','Status4','ProcessUser','ProcessDate','Remarks');
            foreach($fields as $key=>$val)
            {
               if (!in_array($val, $out_field_arr)) 
               {
                   $select_option .=" SUM($val)/10000000 AS $val ";  
                   if($key !=(count($fields)-1))
                   {
                    $select_option .=',';
                   }
               }
            }
            $select_option=substr($select_option, 0, -1);
           }
           if(isset($select_option) && $select_option !='')
           {
               $this->db->query("SET NUMERIC_ROUNDABORT OFF");
			   $Q =$this->db->query("SELECT $select_option FROM $tbl_name WHERE mMonth=$month AND BrCode IN $IN_con");  
               if($Q->num_rows()>0)
               {
                $data_ret=$Q->row_array();
                
                //Now Calculate acheivement_percentage & remarks
                if(((isset($data_ret['DPCurrentMonthAchivement']) && $data_ret['DPCurrentMonthAchivement']>0)||(isset($data_ret['ADCurrentMonthAchivement']) && $data_ret['ADCurrentMonthAchivement']>0)))
                {
                  //Total CL Recovery
                  $data_ret['TCLRLastYearAchivement']=($data_ret['RCLastYearAchivement']+$data_ret['RRLastYearAchivement']+$data_ret['RILastYearAchivement']+$data_ret['RWLastYearAchivement']);
                  $data_ret['TCLRTargetCurrentYear']=($data_ret['RCTargetCurrentYear']+$data_ret['RRTargetCurrentYear']+$data_ret['RITargetCurrentYear']+$data_ret['RWTargetCurrentYear']);
                  $data_ret['TCLRCurrentMonthAchivement']=($data_ret['RCCurrentMonthAchivement']+$data_ret['RRCurrentMonthAchivement']+$data_ret['RICurrentMonthAchivement']+$data_ret['RWCurrentMonthAchivement']);
                  $data_ret['TCLRPreviousYearSameMonthAchievement']=($data_ret['RCPreviousYearSameMonthAchievement']+$data_ret['RRPreviousYearSameMonthAchievement']+$data_ret['RIPreviousYearSameMonthAchievement']+$data_ret['RWPreviousYearSameMonthAchievement']);
                  $data_ret['TCLRProportionateTarget']=($data_ret['RCProportionateTarget']+$data_ret['RRProportionateTarget']+$data_ret['RIProportionateTarget']+$data_ret['RWProportionateTarget']);
                  
                  //Total Cash Recovery
                  $data_ret['TCashRLastYearAchivement']=($data_ret['RCLastYearAchivement']+$data_ret['RFROMWLastYearAchivement']);
                  $data_ret['TCashRTargetCurrentYear']=($data_ret['RCTargetCurrentYear']+$data_ret['RFROMWTargetCurrentYear']);
                  $data_ret['TCashRCurrentMonthAchivement']=($data_ret['RCCurrentMonthAchivement']+$data_ret['RFROMWCurrentMonthAchivement']);
                  $data_ret['TCashRPreviousYearSameMonthAchievement']=($data_ret['RCPreviousYearSameMonthAchievement']+$data_ret['RFROMWPreviousYearSameMonthAchievement']);
                  $data_ret['TCashRProportionateTarget']=($data_ret['RCProportionateTarget']+$data_ret['RFROMWProportionateTarget']);  
                  
                  
                  $Q =  $this->db->query("SELECT * FROM performance_remarks_tbl");
                  $remarks_tbl_content=$Q->result();
                  
                  $sign_array=array('DP','AD','PL','IM','EX','NI','FR','RC','RR','RW','RI','RFROMW','TCLR','TCashR'); 
                  foreach($sign_array as $key=>$val)
                    {
                        $AchivementPercentageKey=$val.'AchivementPercentage';
                        $RemarksKey=$val.'Remarks';
                        $data_ret[$AchivementPercentageKey]='';
                        $data_ret[$RemarksKey]='';
                        
                        $ProportionateTargetKey=$val.'ProportionateTarget';
                        $CurrentMonthAchivementKey=$val.'CurrentMonthAchivement';
                        if(isset($data_ret[$ProportionateTargetKey]) && $data_ret[$ProportionateTargetKey]>0 && isset($data_ret[$CurrentMonthAchivementKey]) && $data_ret[$CurrentMonthAchivementKey]>0)
                        {
                           $data_ret[$AchivementPercentageKey]=($data_ret[$CurrentMonthAchivementKey]*100)/$data_ret[$ProportionateTargetKey];
                           if($data_ret[$AchivementPercentageKey] !='')
                           {
                            $data_ret[$RemarksKey]=$this->calculate_remarks($remarks_tbl_content,$data_ret[$AchivementPercentageKey]);
                           } 
                        }
                    }
                    
                    //calculation of CL%
                    $data_ret['CL%TargetCurrentYear']=9;
                    $data_ret['CL%ProportionateTarget']=9;
                    if(isset($data_ret['CLTotalAdvanceLastyear']) && $data_ret['CLTotalAdvanceLastyear']>0 && isset($data_ret['CLLastYearAchivement']) && $data_ret['CLLastYearAchivement']>0)
                    {
                       $data_ret['CL%LastYearAchivement']=($data_ret['CLLastYearAchivement']*100)/$data_ret['CLTotalAdvanceLastyear']; 
                    }
                    if(isset($data_ret['CLTotalAdvanceCurrentMonth']) && $data_ret['CLTotalAdvanceCurrentMonth']>0 && isset($data_ret['CLCurrentMonthAchivement']) && $data_ret['CLCurrentMonthAchivement']>0)
                    {
                       $data_ret['CL%AchivementPercentage']=($data_ret['CLCurrentMonthAchivement']*100)/$data_ret['CLTotalAdvanceCurrentMonth']; 
                    }
                    if(isset($data_ret['CLTotalAdvancePreviousyearMonth']) && $data_ret['CLTotalAdvancePreviousyearMonth']>0 && isset($data_ret['CLPreviousYearSameMonthAchievement']) && $data_ret['CLPreviousYearSameMonthAchievement']>0)
                    {
                       $data_ret['CL%PreviousYearSameMonthAchievement']=($data_ret['CLPreviousYearSameMonthAchievement']*100)/$data_ret['CLTotalAdvancePreviousyearMonth']; 
                    }
                    
                    if(isset($data_ret['CL%AchivementPercentage']) && $data_ret['CL%AchivementPercentage'] !='')
                    {
                        if($data_ret['CL%AchivementPercentage']<$data_ret['CL%ProportionateTarget']){$data_ret['CL%Remarks']='Excellent';}
                        if($data_ret['CL%AchivementPercentage']==$data_ret['CL%ProportionateTarget']){$data_ret['CL%Remarks']='Good';}
                        if($data_ret['CL%AchivementPercentage']>$data_ret['CL%ProportionateTarget']){$data_ret['CL%Remarks']='Bad';}
                        if($data_ret['CL%AchivementPercentage']>=(2*$data_ret['CL%ProportionateTarget'])){$data_ret['CL%Remarks']='Very Bad';}
                    }
                }
               }                              
           } 
        }
        return $data_ret; 
    }
    //end misd_0037 
	
	    //misd_0038 start
    function fetch_3348_data($branch_id_array_for_report=array(),$tbl_name='',$month=0)
    {
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if($tbl_name !='' && $count_in_branch>0 && $month>0)
        {                           
           $fields = $this->db->list_fields("$tbl_name");
           if(count($fields)>0)
           {
            $select_option='';
            $out_field_arr=array('mYear','mMonth','BrCode','BBBrCode','Status1','Status2','Status3','Status4','ProcessUser','ProcessDate','Remarks');
            foreach($fields as $key=>$val)
            {
               if (!in_array($val, $out_field_arr)) 
               {
                   $select_option .=" SUM($val)/10000000 AS $val ";  
                   if($key !=(count($fields)-1))
                   {
                    $select_option .=',';
                   }
               }
            }
            $select_option=substr($select_option, 0, -1);
           }
           if(isset($select_option) && $select_option !='')
           {
               $this->db->query("SET NUMERIC_ROUNDABORT OFF");
			   $Q =$this->db->query("SELECT $select_option FROM $tbl_name WHERE mMonth=$month AND BrCode IN $IN_con");  
               if($Q->num_rows()>0)
               {
                $data_ret=$Q->row_array();
                
                //Now Calculate acheivement_percentage & remarks
                if(((isset($data_ret['DPCurrentMonthAchivement']) && $data_ret['DPCurrentMonthAchivement']>0)||(isset($data_ret['ADCurrentMonthAchivement']) && $data_ret['ADCurrentMonthAchivement']>0)))
                {
                  //Total CL Recovery
                  $data_ret['TCLRLastYearAchivement']=($data_ret['RCLastYearAchivement']+$data_ret['RRLastYearAchivement']+$data_ret['RILastYearAchivement']+$data_ret['RWLastYearAchivement']);
                  $data_ret['TCLRTargetCurrentYear']=($data_ret['RCTargetCurrentYear']+$data_ret['RRTargetCurrentYear']+$data_ret['RITargetCurrentYear']+$data_ret['RWTargetCurrentYear']);
                  $data_ret['TCLRCurrentMonthAchivement']=($data_ret['RCCurrentMonthAchivement']+$data_ret['RRCurrentMonthAchivement']+$data_ret['RICurrentMonthAchivement']+$data_ret['RWCurrentMonthAchivement']);
                  $data_ret['TCLRPreviousYearSameMonthAchievement']=($data_ret['RCPreviousYearSameMonthAchievement']+$data_ret['RRPreviousYearSameMonthAchievement']+$data_ret['RIPreviousYearSameMonthAchievement']+$data_ret['RWPreviousYearSameMonthAchievement']);
                  $data_ret['TCLRProportionateTarget']=($data_ret['RCProportionateTarget']+$data_ret['RRProportionateTarget']+$data_ret['RIProportionateTarget']+$data_ret['RWProportionateTarget']);
                  
                  //Total Cash Recovery
                  $data_ret['TCashRLastYearAchivement']=($data_ret['RCLastYearAchivement']+$data_ret['RFROMWLastYearAchivement']);
                  $data_ret['TCashRTargetCurrentYear']=($data_ret['RCTargetCurrentYear']+$data_ret['RFROMWTargetCurrentYear']);
                  $data_ret['TCashRCurrentMonthAchivement']=($data_ret['RCCurrentMonthAchivement']+$data_ret['RFROMWCurrentMonthAchivement']);
                  $data_ret['TCashRPreviousYearSameMonthAchievement']=($data_ret['RCPreviousYearSameMonthAchievement']+$data_ret['RFROMWPreviousYearSameMonthAchievement']);
                  $data_ret['TCashRProportionateTarget']=($data_ret['RCProportionateTarget']+$data_ret['RFROMWProportionateTarget']);  
                  
                  
                  $Q =  $this->db->query("SELECT * FROM performance_remarks_tbl");
                  $remarks_tbl_content=$Q->result();
                  
                  $sign_array=array('DP','AD','PL','IM','EX','NI','FR','RC','RR','RW','RI','RFROMW','TCLR','TCashR'); 
                  foreach($sign_array as $key=>$val)
                    {
                        $AchivementPercentageKey=$val.'AchivementPercentage';
                        $RemarksKey=$val.'Remarks';
                        $data_ret[$AchivementPercentageKey]='';
                        $data_ret[$RemarksKey]='';
                        
                        $ProportionateTargetKey=$val.'ProportionateTarget';
                        $CurrentMonthAchivementKey=$val.'CurrentMonthAchivement';
                        if(isset($data_ret[$ProportionateTargetKey]) && $data_ret[$ProportionateTargetKey]>0 && isset($data_ret[$CurrentMonthAchivementKey]) && $data_ret[$CurrentMonthAchivementKey]>0)
                        {
                           $data_ret[$AchivementPercentageKey]=($data_ret[$CurrentMonthAchivementKey]*100)/$data_ret[$ProportionateTargetKey];
                           if($data_ret[$AchivementPercentageKey] !='')
                           {
                            $data_ret[$RemarksKey]=$this->calculate_remarks($remarks_tbl_content,$data_ret[$AchivementPercentageKey]);
                           } 
                        }
                    }
                    
                    //calculation of CL%
                    $data_ret['CL%TargetCurrentYear']=9;
                    $data_ret['CL%ProportionateTarget']=9;
                    if(isset($data_ret['CLTotalAdvanceLastyear']) && $data_ret['CLTotalAdvanceLastyear']>0 && isset($data_ret['CLLastYearAchivement']) && $data_ret['CLLastYearAchivement']>0)
                    {
                       $data_ret['CL%LastYearAchivement']=($data_ret['CLLastYearAchivement']*100)/$data_ret['CLTotalAdvanceLastyear']; 
                    }
                    if(isset($data_ret['CLTotalAdvanceCurrentMonth']) && $data_ret['CLTotalAdvanceCurrentMonth']>0 && isset($data_ret['CLCurrentMonthAchivement']) && $data_ret['CLCurrentMonthAchivement']>0)
                    {
                       $data_ret['CL%AchivementPercentage']=($data_ret['CLCurrentMonthAchivement']*100)/$data_ret['CLTotalAdvanceCurrentMonth']; 
                    }
                    if(isset($data_ret['CLTotalAdvancePreviousyearMonth']) && $data_ret['CLTotalAdvancePreviousyearMonth']>0 && isset($data_ret['CLPreviousYearSameMonthAchievement']) && $data_ret['CLPreviousYearSameMonthAchievement']>0)
                    {
                       $data_ret['CL%PreviousYearSameMonthAchievement']=($data_ret['CLPreviousYearSameMonthAchievement']*100)/$data_ret['CLTotalAdvancePreviousyearMonth']; 
                    }
                    
                    if(isset($data_ret['CL%AchivementPercentage']) && $data_ret['CL%AchivementPercentage'] !='')
                    {
                        if($data_ret['CL%AchivementPercentage']<$data_ret['CL%ProportionateTarget']){$data_ret['CL%Remarks']='Excellent';}
                        if($data_ret['CL%AchivementPercentage']==$data_ret['CL%ProportionateTarget']){$data_ret['CL%Remarks']='Good';}
                        if($data_ret['CL%AchivementPercentage']>$data_ret['CL%ProportionateTarget']){$data_ret['CL%Remarks']='Bad';}
                        if($data_ret['CL%AchivementPercentage']>=(2*$data_ret['CL%ProportionateTarget'])){$data_ret['CL%Remarks']='Very Bad';}
                    }
                }
               }                              
           } 
        }
        return $data_ret; 
    }
    //misd_0038 end
	
	//start misd-0041////

function get_wp_group_subgroup_option($find_option=0)
{
        $data=array();
        if($find_option>0)
        {
          $tbl_name='';
          $order_by='';
          if($find_option==1)
          {
            $tbl_name='weekly_position_group';
            $order_by='weekly_position_group_order';
          }
          if($find_option==2)
          {
            $tbl_name='weekly_position_subgroup';
            $order_by='weekly_position_subgroup_code';
          }
          $query =  $this->db->query("SELECT * FROM $tbl_name ORDER BY $order_by ASC");       
		  $data=$query->result(); 
        }
        
        return $data;

}

    function get_wp_head_single_account_details_report($branch_id_array_for_report=array(),$post_array=array())
    {		
        $data=array();
        if(!empty($branch_id_array_for_report) && !empty($post_array))
        {  
           $tbl_name='';
           if(isset($post_array['report_of_date']) && $post_array['report_of_date'] !='')
           {
            $report_of_date=$post_array['report_of_date'];
            $tbl_name=$this->get_weekly_position_data_tbl_name_to_insert($report_of_date);
           }
           
            $count_in_branch=count($branch_id_array_for_report);
            $IN_con='';
            $select=" X.dvname,X.znname,X.branchname,Y.weekly_amt ";
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
            
            //subgroup condition
            $subgroup_condition=" weekly_prod_subgroup_code=0 ";
            if(isset($post_array['head_account_radio']) && $post_array['head_account_radio']==1)//head account
            {
              if(isset($post_array['head_account']) && $post_array['head_account'] !='')
              {
                if($post_array['head_account']==1){$subgroup_condition=" weekly_prod_subgroup_code IN(101,104,107,110,113,116,119,122,125) ";}
                if($post_array['head_account']==3){$subgroup_condition=" weekly_prod_subgroup_code IN(301,304,307,310,313,316,319,322,325) ";}
                if($post_array['head_account']==9){$subgroup_condition=" weekly_prod_subgroup_code IN(901,904,907) ";}
                if($post_array['head_account']==12){$subgroup_condition=" weekly_prod_subgroup_code IN(1201) ";}
                if($post_array['head_account']==15){$subgroup_condition=" weekly_prod_subgroup_code IN(1501,1504) ";}
                if($post_array['head_account']==18){$subgroup_condition=" weekly_prod_subgroup_code IN(1801,1804,1807,1810) ";}
                if($post_array['head_account']==21){$subgroup_condition=" weekly_prod_subgroup_code IN(2101) ";}
                if($post_array['head_account']==24){$subgroup_condition=" weekly_prod_subgroup_code IN(2401) ";}
                if($post_array['head_account']==30){$subgroup_condition=" weekly_prod_subgroup_code IN(3001) ";}
                if($post_array['head_account']==33){$subgroup_condition=" weekly_prod_subgroup_code IN(3301,3304,3307,3310,3313,3316,3319,3322,3325) ";}
                if($post_array['head_account']==36){$subgroup_condition=" weekly_prod_subgroup_code IN(3601,3604,3607,3610,3613,3616,3619,3622,3625,3628,3631) ";}
                if($post_array['head_account']==42){$subgroup_condition=" weekly_prod_subgroup_code IN(4201) ";}
                if($post_array['head_account']==45){$subgroup_condition=" weekly_prod_subgroup_code IN(4501,4504) ";}
              } 
            }
            if(isset($post_array['head_account_radio']) && $post_array['head_account_radio']==2)//single account
            {
              if(isset($post_array['single_account']) && $post_array['single_account'] !='')
              {
                $single_account=$post_array['single_account'];
                $subgroup_condition=" weekly_prod_subgroup_code=$single_account ";
              }  
            }
            
            //final query            
            if($tbl_name !='' && $IN_con !='')
            {
                $Q =  $this->db->query("SELECT 
                                        $select 
                                        FROM allinformation AS X 
                                        LEFT JOIN
                                        ( 
                                            SELECT weekly_br_code,SUM(weekly_amt) AS weekly_amt 
                                            FROM $tbl_name 
                                            WHERE 
                                            weekly_position_date='$report_of_date' 
                                            AND 
                                            $subgroup_condition
                                            GROUP BY weekly_br_code
                                        ) AS Y 
                                        ON X.brcode=Y.weekly_br_code 
                                        WHERE X.brcode IN $IN_con 
                                        ORDER BY X.dvname,X.znname,X.branchname"); 
                if($Q->num_rows()>0)
                {
                    $data=$Q->result_array();
                }
            } 
        }
        return $data;
    }

//end misd-0041////

//start misd-0042////

    function get_wp_head_single_account_comparisn_report($branch_id_array_for_report=array(),$post_array=array())
    {		
        $data=array();
        if(!empty($branch_id_array_for_report) && !empty($post_array))
        {  
           $tbl_name1='';
           if(isset($post_array['report_of_date1']) && $post_array['report_of_date1'] !='')
           {
            $report_of_date1=$post_array['report_of_date1'];
            $tbl_name1=$this->get_weekly_position_data_tbl_name_to_insert($report_of_date1);
           }
           
           $tbl_name2='';
           if(isset($post_array['report_of_date2']) && $post_array['report_of_date2'] !='')
           {
            $report_of_date2=$post_array['report_of_date2'];
            $tbl_name2=$this->get_weekly_position_data_tbl_name_to_insert($report_of_date2);
           }
           
            $count_in_branch=count($branch_id_array_for_report);
            $IN_con='';
            $select=" X.dvname,X.znname,X.branchname,Y.weekly_amt1,Z.weekly_amt2,Z.weekly_amt2-Y.weekly_amt1 AS diff ";
            if($count_in_branch>0)
            {
                $IN_con="(";
                foreach($branch_id_array_for_report as $key=>$val)
                {
                    $brcode=$val['jbbrcode'];
                    $IN_con .="$brcode";
                    if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
                }
                $IN_con .=")";
            }
            
            //subgroup condition
            $subgroup_condition=" weekly_prod_subgroup_code=0 ";
            if(isset($post_array['head_account_radio']) && $post_array['head_account_radio']==1)//head account
            {
              if(isset($post_array['head_account']) && $post_array['head_account'] !='')
              {
                if($post_array['head_account']==1){$subgroup_condition=" weekly_prod_subgroup_code IN(101,104,107,110,113,116,119,122,125) ";}
                if($post_array['head_account']==3){$subgroup_condition=" weekly_prod_subgroup_code IN(301,304,307,310,313,316,319,322,325) ";}
                if($post_array['head_account']==9){$subgroup_condition=" weekly_prod_subgroup_code IN(901,904,907) ";}
                if($post_array['head_account']==12){$subgroup_condition=" weekly_prod_subgroup_code IN(1201) ";}
                if($post_array['head_account']==15){$subgroup_condition=" weekly_prod_subgroup_code IN(1501,1504) ";}
                if($post_array['head_account']==18){$subgroup_condition=" weekly_prod_subgroup_code IN(1801,1804,1807,1810) ";}
                if($post_array['head_account']==21){$subgroup_condition=" weekly_prod_subgroup_code IN(2101) ";}
                if($post_array['head_account']==24){$subgroup_condition=" weekly_prod_subgroup_code IN(2401) ";}
                if($post_array['head_account']==30){$subgroup_condition=" weekly_prod_subgroup_code IN(3001) ";}
                if($post_array['head_account']==33){$subgroup_condition=" weekly_prod_subgroup_code IN(3301,3304,3307,3310,3313,3316,3319,3322,3325) ";}
                if($post_array['head_account']==36){$subgroup_condition=" weekly_prod_subgroup_code IN(3601,3604,3607,3610,3613,3616,3619,3622,3625,3628,3631) ";}
                if($post_array['head_account']==42){$subgroup_condition=" weekly_prod_subgroup_code IN(4201) ";}
                if($post_array['head_account']==45){$subgroup_condition=" weekly_prod_subgroup_code IN(4501,4504) ";}
              }  
            }
            if(isset($post_array['head_account_radio']) && $post_array['head_account_radio']==2)//single account
            {
              if(isset($post_array['single_account']) && $post_array['single_account'] !='')
              {
                $single_account=$post_array['single_account'];
                $subgroup_condition=" weekly_prod_subgroup_code=$single_account ";
              }  
            }
            
            //final query            
            if($tbl_name1 !='' && $IN_con !='' && $tbl_name2 !='')
            {
                $Q =  $this->db->query("SELECT 
                                        $select 
                                        FROM allinformation AS X 
                                        LEFT JOIN
                                        ( 
                                            SELECT weekly_br_code,SUM(weekly_amt) AS weekly_amt1 
                                            FROM $tbl_name1 
                                            WHERE 
                                            weekly_position_date='$report_of_date1' 
                                            AND 
                                            $subgroup_condition
                                            GROUP BY weekly_br_code
                                        ) AS Y 
                                        ON X.brcode=Y.weekly_br_code
                                        LEFT JOIN
                                        ( 
                                            SELECT weekly_br_code,SUM(weekly_amt) AS weekly_amt2 
                                            FROM $tbl_name2
                                            WHERE 
                                            weekly_position_date='$report_of_date2' 
                                            AND 
                                            $subgroup_condition
                                            GROUP BY weekly_br_code
                                        ) AS Z 
                                        ON X.brcode=Z.weekly_br_code  
                                        WHERE X.brcode IN $IN_con 
                                        ORDER BY X.dvname,X.znname,X.branchname"); 
                if($Q->num_rows()>0)
                {
                    $data=$Q->result_array();
                }
            } 
        }
        return $data;
    }

//end misd-0042////

//misd_0043 start

function fetch_misd_0043_cal_data($report_of_office_id=0,$proc_name='',$date_str='')
{
    $data_ret=array();
    if($proc_name !='' && $report_of_office_id>0 && $date_str !='')
    {                           
        $serverName = "MISD_LIVE\MSSQLSERVER2008";
        $connectionInfo = array(
        'Database' => 'Db_DP_Collection_mgr',
        'UID' => 'sa',
        'PWD' => '786@m!s-r!t');
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if($conn) 
        {
            $query = "$proc_name '$report_of_office_id','$date_str'";
            $result1 = sqlsrv_query($conn, $query);
            $count=0;
            if($result1)
            {
				while ($result2 = sqlsrv_fetch_array($result1))
                {
                  if(isset($result2['Debit Amount']) && isset($result2['Credit Amount']) && ($result2['Debit Amount']>0  || $result2['Credit Amount']>0))
				  {
					  $data_ret[$count]['Org_Br_Code']=$result2['Originating Branch Code'];
					  $data_ret[$count]['Org_date']='';
					  $data_ret[$count]['Org_date']=$result2['Originating Date']->format('Y-m-d');
					  $data_ret[$count]['Res_Br_Code']=$result2['Responding Branch Code'];
					  $data_ret[$count]['Ad_no']=$result2['Advice No'];
					  $data_ret[$count]['Tr_Type_Code']=$result2['Transaction Type Code'];
					  $data_ret[$count]['Dr_amt']=$result2['Debit Amount'];
					  $data_ret[$count]['Cr_Amt']=$result2['Credit Amount'];
					  $count++;
				  }
                }   
            }
        }                  
    }
    return $data_ret;
}
//misd_0043 end
	
// start load instruction
function get_instruction($mod_id=0,$dt='')
{
    $ret_ins='';
    if($mod_id>0 && $dt !='')
    {
      $Q =  $this->db->query("SELECT * FROM erp_instruction WHERE mod_id=$mod_id AND status=1 AND instruction_dt='$dt' "); 
    if($Q->num_rows()==1)
    {
        $res=$Q->row_array();
        if(isset($res['instruction']))
        {
            $ret_ins=$res['instruction'];
        }
    } 
    }
    return $ret_ins;
}
// end load instruction

/////////////////////////REI Zakariya START////////////////////////////////
    function get_rei_option()
    {
        $query =  $this->db->query("select sg.*,g.rei_group_text 
                                    from rei_subgroup as sg
                                    JOIN rei_group as g ON sg.rei_group_code=g.rei_group_code
                                    order by g.rei_group_order asc");       
		return $query->result(); 
    }
    
    function get_rei_group()
    {
        $query =  $this->db->query("select * from rei_group order by rei_group_order asc");       
		return $query->result(); 
    }
    
    function get_rei_year($status=1)
    {
        $where='';
        if($status==1){$where="where rei_yr_status='$status'";}
        $query =  $this->db->query("select rei_yr from rei_entry_year $where order by rei_yr_sl desc");       
		return $query->result(); 
    }
    function save_rei_data()
    {
        $status='error';
                
        $office_id=$_POST['rei_branch'];
        $previous_data_arr=$this->get_branch_rei_report($office_id,$_POST['rei_year']);
        
        if(count($previous_data_arr)>0)
        {
            $status='notice';
        }
        else
        {
            $amount=$this->input->post('amount');
            $rei_subgroup_code=$this->input->post('rei_subgroup_code');
            $rei_data_uid=$this->session->userdata('some_uid');
            $rei_data_sb_dt=date('Y-m-d');
            $c=0;
			foreach($amount as $amountVal)
			{
                $data = array( 
                    'rei_data_yr'	    => $_POST['rei_year'],
                    'rei_data_off_code'	=> $office_id,
                    'rei_data_sg_code' 	=> $rei_subgroup_code[$c],
        			'rei_data_uid' 	    => $rei_data_uid,
                    'rei_data_sb_dt'	=> $rei_data_sb_dt,
                    'rei_data_amt'	    => (float)$amountVal
        		);
				
                if($this->db->insert('rei_data_detail', $data))
                {
                    $status='success';
                }
    			$c++;
			}
            
        }
        
        return $status;
        		
    }
    
    function save_rei_edit_info($office_id=0)
    {
        $status='error';
        $previous_data_arr=$this->get_branch_rei_report($office_id,$_POST['rei_year']);
        
        if(count($previous_data_arr)>0)
        {
            $rei_data_uid=$this->session->userdata('some_uid');
            $rei_data_sb_dt=date('Y-m-d');
            $c=0;
			foreach($previous_data_arr as $row)
			{
                $data_log = array( 
                    'rei_data_yr'	    => $row->rei_data_yr,
                    'rei_data_off_code'	=> $row->rei_data_off_code,
                    'rei_data_sg_code' 	=> $row->rei_data_sg_code,
        			'rei_data_uid' 	    => $row->rei_data_uid,
                    'rei_data_sb_dt'	=> $row->rei_data_sb_dt,
                    'rei_data_amt'	    => $row->rei_data_amt
        		);
				
                if($this->db->insert('rei_data_detail_log', $data_log))
                {
                    $status='pre_success';
                }
    			$c++;
			}
            
            if($status=='pre_success')
            {
                $this->db->where('rei_data_off_code',$office_id);
                $this->db->where('rei_data_yr',$_POST['rei_year']);
                if($this->db->delete('rei_data_detail'))
                {
                    $amount=$this->input->post('amount');
                    $rei_subgroup_code=$this->input->post('rei_subgroup_code');
                    $rei_data_uid=$this->session->userdata('some_uid');
                    $rei_data_sb_dt=date('Y-m-d');
                    $c=0;
        			foreach($amount as $amountVal)
        			{
                        $data = array( 
                            'rei_data_yr'	    => $_POST['rei_year'],
                            'rei_data_off_code'	=> $office_id,
                            'rei_data_sg_code' 	=> $rei_subgroup_code[$c],
                			'rei_data_uid' 	    => $rei_data_uid,
                            'rei_data_sb_dt'	=> $rei_data_sb_dt,
                            'rei_data_amt'	    => (float)$amountVal
                		);
        				
                        if($this->db->insert('rei_data_detail', $data))
                        {
                            $status='success';
                        }
            			$c++;
        			}  
                }
            }
        }
        
        return $status;
        		
    }
    
    
    function get_branch_rei_report($office_id=0,$rei_year=0)
    {
        $Q =  $this->db->query("SELECT * FROM rei_data_detail WHERE rei_data_off_code=".$office_id." AND rei_data_yr=".$rei_year." ");  
        return $Q->result();
    }
    
    function fetch_rei_data_details($branch_id_array_for_report=array(),$report_of_year='')
    {
        $count_in_branch=count($branch_id_array_for_report);
        
        $select=" * ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM rei_data_detail WHERE rei_data_yr='$report_of_year' AND rei_data_off_code IN $IN_con");      
        return $Q->result();
        
        
    }
    
    function fetch_rei_missing_completed($branch_id_array_for_report=array(),$report_of_year='')
    {
        
        $count_in_branch=count($branch_id_array_for_report);
        $data=array();
        $select=" [Br Code] as br_code,[Br Name] as br_name ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $Q =  $this->db->query("SELECT $select FROM VW_Br WHERE [Br Code] IN $IN_con"); 
        
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;
            if(isset($val['br_code']))
            {
               $brcode=$val['br_code'];
               $Q =  $this->db->query("SELECT rei_data_id FROM rei_data_detail WHERE rei_data_off_code='$brcode' AND rei_data_yr='$report_of_year'");
               if($Q->num_rows()>0)
               {
                $data[$key]['status']=1;
               }
               else
               {
                $data[$key]['status']=0;
               }
               $QQ1 =  $this->db->query("SELECT * FROM allinformation WHERE brcode='$brcode' ");
               $data[$key]['office_phone']='';
               if($QQ1->num_rows()>0)
               {
                $p=$QQ1->result_array();
                $data[$key]['office_phone']=$p[0]['OfficePhone'];
               }
            }
          } 
        }
        
        return $data;
    }
    
    function fetch_rei_data_details_completed_vs_total($branch_id_array_for_report=array(),$report_of_year='')
    {
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        $data=array();
        $data['total']=$count_in_branch;
        $data['completed']=0;
        $Q =  $this->db->query("SELECT DISTINCT(rei_data_off_code) FROM rei_data_detail WHERE rei_data_yr='$report_of_year' AND  rei_data_off_code IN $IN_con"); 
        if($Q->num_rows()>0)
        {
            $data['completed']=$Q->num_rows();
        }
        
        return $data;
    }	
	/////////////////////////REI Zakariya END////////////////////////////////
	
	    //start misd_0044
    function fetch_misd_0044_data($branch_id_array_for_report=array(),$report_click_btn=0,$tbl_name='')
    {
        
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if($report_click_btn>0 && $count_in_branch>0 && $tbl_name !='')
        {                           
           if($report_click_btn==1)
           {
            $Q =$this->db->query("
                                SELECT tbl1.interest,tbl1.type,tbl2.depotypedesc,SUM(tbl1.amount) AS amt,SUM(tbl1.account) AS ac 
                                FROM $tbl_name AS tbl1
                                JOIN SBSdeposittypecode AS tbl2 ON tbl1.type=tbl2.depotypecode
                                WHERE tbl1.jb_br_code IN $IN_con
                                GROUP BY tbl1.interest,tbl1.type,tbl2.depotypedesc 
                                ORDER BY tbl1.interest,tbl1.type"
                                );
           }
           if($report_click_btn==2)
           {
            $Q =$this->db->query("
                    SELECT interest,SUM(amount) AS amt,SUM(account) AS ac 
                    FROM $tbl_name
                    WHERE jb_br_code IN $IN_con
                    GROUP BY interest 
                    ORDER BY interest"
                    );
           }
                                          
           $data_ret=$Q->result_array(); 
        }
        return $data_ret; 
    }
    //end misd_0044
	
	//start misd_0045
    function fetch_graph_analysis_data($branch_id_array_for_report=array(),$date_array=array(),$click_btn=0)
    {
        
        $data_array=array();
        $count_in_branch=count($branch_id_array_for_report);    
            
        if(count($date_array)>0 && $click_btn>0 && $count_in_branch>0)
        {
            foreach($date_array as $row)
            {
                 $date=$row['om_dat_date'];
                 $value=0;
                 if($click_btn==1) //deposit 
                 {
                    $value=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101,105,109,113,117,121,125')); 
                 } 
                 if($click_btn==2) //hcd 
                 {
                       $value=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('113,117')); 
                 }
                 if($click_btn==3) //hcd% 
                 {
                       $dp=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101,105,109,113,117,121,125'));
                       if($dp>0)
                       {
                        $value=round(($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('113,117'))*100)/$dp,2);
                       } 
                 }
                  if($click_btn==4) //lcd 
                 {
                       $value=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101,105,109,121,125')); 
                 }
                 if($click_btn==5) //lcd% 
                 {
                       $dp=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101,105,109,113,117,121,125'));
                       if($dp>0)
                       {
                        $value=round(($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101,105,109,121,125'))*100)/$dp,2);
                       } 
                        
                 }
                 if($click_btn==6) //advance 
                 {
                       $value=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601,605,609,613,617,621')); 
                 }  
                 if($click_btn==7) //adr including LYA
                 {
                       $dp=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101,105,109,113,117,121,125'));
                       if($dp>0)
                       {
                        $value=round(($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601,605,609,613,617,621'))*100)/$dp,2);
                       }  
                 }
				 if($click_btn==12) //adr excluding LYA
                 {
                       $dp=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('101,105,109,113,117,121,125'));
                       if($dp>0)
                       {
                        $value=round(($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('601,605,609,617'))*100)/$dp,2);
                       }  
                 }
                 if($click_btn==8) //pl 
                 {
                       $value=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('5101')); 
                 }
                 if($click_btn==9) //uc 
                 {
                       $value=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1801,1805'))-$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('621')); 
                 }
                 if($click_btn==10) //cl 
                 {
                       $value=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1809,1813,1817')); 
                 }
                 if($click_btn==11) //cl%
                 {
                       $uc_cl=$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1801,1805,1809,1813,1817'))-$this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('621'));
                       if($uc_cl>0)
                       {
                        $value=round(($this->calculate_omis_terms_sum($branch_id_array_for_report,$date,array('1809,1813,1817'))*100)/$uc_cl,2);
                       }  
                 }
                      
                 
                 //now set calculated value                                                                                     
                 if(isset($value))
                 {
                    $data_array[]=$value;
                 }
            }
        }
		return $data_array;   
    }
    //end misd_0045
	
	//start misd_0046
    function fetch_misd_0046_data($branch_id_array_for_report=array(),$tbl_name='',$year='',$month='',$click_btn=0)
    {
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if($tbl_name !='' && $count_in_branch>0 && $year !='' && $month !='' && $click_btn>0)
        {                           
                                          
                                
           if($click_btn==1)
            {
              $Q =$this->db->query("   SELECT 
                                        COUNT(*) AS 'no_of_loan', SUM(ADVANCE_LIMIT) AS 'total_advance_limit' 
                                        FROM $tbl_name 
                                        WHERE 
                                        YEAR(DISBURSEMENT_DATE)='$year' 
                                        AND 
                                        MONTH(DISBURSEMENT_DATE)='$month'
                                        AND
                                        jb_br_code IN $IN_con
										AND ADVANCE_LIMIT>50000										
                                    ");
              $data_ret=$Q->row_array();   
            }
            if($click_btn==2)
            {
              $Q =$this->db->query("SELECT CIB.*,INFO.branchname,INFO.gradesname,INFO.znname,INFO.dvname FROM $tbl_name AS CIB JOIN Db_DP_Collection_mgr..allinformation AS INFO ON CIB.jb_br_code=INFO.brcode WHERE YEAR(DISBURSEMENT_DATE)='$year' AND MONTH(DISBURSEMENT_DATE)='$month' AND CIB.jb_br_code IN $IN_con AND CIB.ADVANCE_LIMIT>50000 ORDER BY INFO.dvname ASC,INFO.znname ASC,INFO.branchname ASC,CIB.ADVANCE_LIMIT DESC");
              $data_ret=$Q->result_array();   
            }
        }
        return $data_ret; 
    }
    //end misd_0046 
	
	    //start misd_0047 
 
   	function fetch_misd_0047_cal_data($branch_id_array_for_report=array(),$report_of_year='')
    {
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }   
		
        if($report_of_year !='' && $count_in_branch>0)
        { 
			
			$keep_tr='';
            $tbl_name='';
            for ($m=1; $m<=12; $m++) 
            {
                
                
                $data_ret[$m]['month_name']=date('M', strtotime("2000-$m-01"))."/".substr($report_of_year,2);
                /*
                $data_ret[$m]['month_name']=date('M', mktime(0,0,0,$m))."/".substr($report_of_year,2);
                if(date('M', mktime(0,0,0,$m))==date('M'))
                {
                 $data_ret[$m]['current_month']=1;   
                }*/
                
                $tbl_str='';
                if($m<10){$tbl_str='0';}
                $tbl_name='CIB'.$tbl_str.$m.$report_of_year;
                $Q=$this->db->query("SELECT name FROM sys.views where name='$tbl_name'");
                if($Q->num_rows()>0)
                {
                  $Q =$this->db->query("   SELECT 
                        COUNT(*) AS 'no_of_loan', SUM(ADVANCE_LIMIT) AS 'total_advance_limit' 
                        FROM $tbl_name 
                        WHERE 
                        YEAR(DISBURSEMENT_DATE)='$report_of_year' 
                        AND 
                        MONTH(DISBURSEMENT_DATE)='$m'
                        AND
                        jb_br_code IN $IN_con
						AND ADVANCE_LIMIT>50000
                    ");
                    
                    if($Q->num_rows()>0)
                    {
                        $temp_dat=$Q->row_array();
                        if(isset($temp_dat['no_of_loan']))
                        {
                          $data_ret[$m]['no_of_loan']= $temp_dat['no_of_loan']; 
                        }
                        else
                        {
                         $data_ret[$m]['no_of_loan']=0;   
                        }
                        
                        if(isset($temp_dat['total_advance_limit']))
                        {
                          $data_ret[$m]['total_advance_limit']= $temp_dat['total_advance_limit']; 
                        }
                        else
                        {
                         $data_ret[$m]['total_advance_limit']=0;   
                        }
                    }   
                }		
            }
                        
        }
		
        return $data_ret; 
    }
    //end misd_0047
	
	    //start misd_0048
    function fetch_misd_0048_data($branch_id_array_for_report=array(),$tbl_name_affair='',$tbl_name_pl='',$month='',$year='')
    {
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if($tbl_name_affair !='' && $tbl_name_pl!='' && $count_in_branch>0 && $year !='' && $month !='')
        {                           
            $query="SELECT 
                    info.dvname,
                    info.znname,
                    info.brcode,
                    info.branchname,
                    info.gradesname,
                    tbl_1.hcd,
                    tbl_1.lcd,
                    tbl_1.total_dp,
                    tbl_1.total_adv,
                    tbl_3.op_profit,
                    tbl_2.ClAmount 
                    FROM Db_DP_Collection_mgr.dbo.allinformation AS info
                    LEFT JOIN
                    (
                    SELECT 
                    bcode,
                    hcd=CAST(sum(CASE  WHEN left(sub_head,5)in ('00213','00219','00237','00238','00239','00240','00218','00227','00228','00229','00230','00233','00234','00235','00236','00220','00221','00222','00223','00225','00226','00231','00232') THEN amount else 0 end) AS NUMERIC(18,2)), 
                    lcd=CAST(sum(CASE  WHEN LEFT(sub_head,3) in ('003') or left(sub_head,5)in ('00201','00212','00211','00204','00202','00203','00205','00206','00207','00208','00209','00210','00214','00215','00216','00217','00224') THEN amount else 0 end) AS NUMERIC(18,2)),
                    total_dp=CAST(sum(CASE  WHEN left(sub_head,3)in ('002','003') THEN amount else 0 end) AS NUMERIC(18,2)),
                    total_adv=CAST(sum(CASE  WHEN left(sub_head,3)in ('104','105','106') THEN amount else 0 end) AS NUMERIC(18,2)),
                    op_profit=CAST(sum(CASE  WHEN left(sub_head,1)in ('2') THEN amount else 0 end) AS NUMERIC(18,2))-CAST(sum(CASE  WHEN left(sub_head,1)in ('3') THEN amount else 0 end) AS NUMERIC(18,2))
                    FROM Db_DP_Collection_mgr.dbo.$tbl_name_affair
                    GROUP BY bcode
                    ) AS tbl_1 ON info.brcode=tbl_1.bcode
                    LEFT JOIN
                    (
                    SELECT 
                    JB_BR_CODE, SUM(SS+DF+BL) AS ClAmount 
                    FROM Db_DP_Collection_mgr.dbo.CL1
                    WHERE REPORTING_MONTH=$month AND REPORTING_YEAR=$year
                    GROUP BY JB_BR_CODE
                    ) AS tbl_2 ON info.brcode=tbl_2.JB_BR_CODE
					LEFT JOIN
					(
					SELECT 
                    bcode, 
					op_profit=CAST(sum(CASE  WHEN left(scode,1)in ('2') THEN amount else 0 end) AS NUMERIC(18,2))-CAST(sum(CASE  WHEN left(scode,1)in ('3') THEN amount else 0 end) AS NUMERIC(18,2)) 
                    FROM Db_DP_Collection_mgr.dbo.$tbl_name_pl
                    WHERE Mmonth=$month AND Myear=$year
                    GROUP BY bcode
					) AS tbl_3 ON info.brcode=tbl_3.bcode
                    WHERE info.brcode IN $IN_con 
                    ORDER BY info.dvname,info.znname,info.branchname
                    ";


            $this->db->query("SET NUMERIC_ROUNDABORT OFF");
            $Q = $this->db->query($query);
            if($Q->num_rows()>0)
            {
             $data_ret=$Q->result_array();    
            }
        }
        return $data_ret; 
    }
    //end misd_0048 
	
	    //start misd_0049
    function fetch_misd_0049_data($branch_id_array_for_report=array(),$year='',$month='',$click_btn=0)
    {
        $data_ret=array();
        $affair=array();
        $pl=array();
        $cl=array();
        $omis=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }
        
        if($count_in_branch>0 && $year !='' && $month !='' && $click_btn>0)
        {                           
                                          
           //get affairs data
            $tbl_name_affair='DSA'.$month.$year;
            $Q_affair_sys=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_affair'");
            if($Q_affair_sys->num_rows()>0)
            {
                $Q_affair_data =$this->db->query("SELECT 
                                                    dp=CAST(sum(CASE  WHEN left(sub_head,3)in ('002','003') THEN amount else 0 end) AS NUMERIC(18,2)),
                                                    adv=CAST(sum(CASE  WHEN left(sub_head,3)in ('104','105','106') THEN amount else 0 end) AS NUMERIC(18,2))
                                                    FROM Db_DP_Collection_mgr.dbo.$tbl_name_affair
                                                    WHERE bcode IN $IN_con");
                if($Q_affair_data->num_rows()>0)
                {
                    $affair=$Q_affair_data->row_array();    
                }  
            }  
            
            //get pl data
            $tbl_name_pl='PL'.$month.$year;
            $Q_pl_sys=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_pl'");
            if($Q_pl_sys->num_rows()>0)
            {
                $Q_pl_data =$this->db->query("SELECT 
                                                int_income=CAST(sum(CASE  WHEN left(scode,3)in ('201') THEN amount else 0 end) AS NUMERIC(18,2)),
                                                int_expense=CAST(sum(CASE  WHEN left(scode,3)in ('301') THEN amount else 0 end) AS NUMERIC(18,2)),
                                                income=CAST(sum(CASE  WHEN left(scode,1)in ('2') THEN amount else 0 end) AS NUMERIC(18,2)),
                                                expenditure=CAST(sum(CASE  WHEN left(scode,1)in ('3') THEN amount else 0 end) AS NUMERIC(18,2)),
                                                pl=CAST(sum(CASE  WHEN left(scode,1)in ('2') THEN amount else 0 end) AS NUMERIC(18,2))-CAST(sum(CASE  WHEN left(scode,1)in ('3') THEN amount else 0 end) AS NUMERIC(18,2))
                                                FROM Db_DP_Collection_mgr.dbo.$tbl_name_pl
                                                WHERE Mmonth=$month AND Myear=$year
                                                AND bcode IN $IN_con
                                                ");
                if($Q_pl_data->num_rows()>0)
                {
                    $pl=$Q_pl_data->row_array();  
                }  
            } 
            
            
            //get cl data
            $tbl_name_cl='CL1';
            $Q_cl_sys=$this->db->query("SELECT name FROM sys.views where name='$tbl_name_cl'");
            if($Q_cl_sys->num_rows()>0)
            {
                $Q=$this->db->query("SELECT * 
                                    FROM Db_DP_Collection_mgr.dbo.$tbl_name_cl
                                    WHERE REPORTING_MONTH=$month AND REPORTING_YEAR=$year
                                    AND JB_BR_CODE IN $IN_con");
                                    
                if($Q->num_rows()>0)
                {
                    $Q_cl_data =$this->db->query("SELECT 
                                SUM(SS+DF+BL) AS ClAmount 
                                FROM Db_DP_Collection_mgr.dbo.$tbl_name_cl
                                WHERE REPORTING_MONTH=$month AND REPORTING_YEAR=$year
                                AND JB_BR_CODE IN $IN_con");
                    if($Q_cl_data->num_rows()>0)
                    {
                        $cl=$Q_cl_data->row_array();   
                    }  
                }                                    
            } 
            
            //get omis data
            $tbl_name_omis='omis_data_'.$year.'_'.$month;
            if($this->db->table_exists($tbl_name_omis) == TRUE)
            {
                //get last date of selected month
                $selected_month_last_date=$this->mymodel->fetch_calculated_date($year,$month,2);
                if($selected_month_last_date !='')
                {
                     $Q_affair_omis =$this->db->query("SELECT 
                                        import=CAST(sum(CASE  WHEN dd_pt_id='5701' THEN dd_amt else 0 end) AS NUMERIC(18,2)),
                                        export=CAST(sum(CASE  WHEN dd_pt_id='6001' THEN dd_amt else 0 end) AS NUMERIC(18,2)),
                                        foreign_remittance=CAST(sum(CASE  WHEN dd_pt_id='3001' THEN dd_amt else 0 end) AS NUMERIC(18,2))
                                        FROM Db_DP_Collection_mgr.dbo.$tbl_name_omis
                                        WHERE dd_end_dt='$selected_month_last_date'
                                        AND dd_jo_code IN $IN_con ");
                    if($Q_affair_omis->num_rows()>0)
                    {
                        $omis=$Q_affair_omis->row_array();    
                    }    
                } 
            }  
                               
        }
        $data_ret=array_merge($affair,$pl,$cl,$omis);
        
        return $data_ret; 
    }
    //end misd_0049 
	
	    //start misd_0050
    function fetch_misd_0050_data($branch_id_array_for_report=array(),$tbl_name='',$year='',$month='',$click_btn=0)
    {
        $data_ret=array();
        
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['jbbrcode'];
                $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }   
		
        if($tbl_name !='' && $count_in_branch>0 && $year !='' && $month !='' && $click_btn>0)
        { 
          $query =" SELECT 
                    'up_to_zero_u'=SUM(CASE WHEN (tbl_2.urcode=1 AND tbl_2.no_new_loan=0) THEN 1 ELSE 0 END),
                    'up_to_zero_r'=SUM(CASE WHEN (tbl_2.urcode=2 AND tbl_2.no_new_loan=0) THEN 1 ELSE 0 END),
                    'up_to_zero_t'=SUM(CASE WHEN (tbl_2.no_new_loan=0) THEN 1 ELSE 0 END),
                    
                    '1_to_5_u'=SUM(CASE WHEN (tbl_2.urcode=1 AND tbl_2.no_new_loan>0 AND tbl_2.no_new_loan<6) THEN 1 ELSE 0 END),
                    '1_to_5_r'=SUM(CASE WHEN (tbl_2.urcode=2 AND tbl_2.no_new_loan>0 AND no_new_loan<6) THEN 1 ELSE 0 END),
                    '1_to_5_t'=SUM(CASE WHEN (tbl_2.no_new_loan>0 AND tbl_2.no_new_loan<6) THEN 1 ELSE 0 END),
                    
                    '6_to_15_u'=SUM(CASE WHEN (tbl_2.urcode=1 AND tbl_2.no_new_loan>5 AND tbl_2.no_new_loan<16) THEN 1 ELSE 0 END),
                    '6_to_15_r'=SUM(CASE WHEN (tbl_2.urcode=2 AND tbl_2.no_new_loan>5 AND no_new_loan<16) THEN 1 ELSE 0 END),
                    '6_to_15_t'=SUM(CASE WHEN (tbl_2.no_new_loan>5 AND tbl_2.no_new_loan<16) THEN 1 ELSE 0 END),
                    
                    '16_to_30_u'=SUM(CASE WHEN (tbl_2.urcode=1 AND tbl_2.no_new_loan>15 AND tbl_2.no_new_loan<31) THEN 1 ELSE 0 END),
                    '16_to_30_r'=SUM(CASE WHEN (tbl_2.urcode=2 AND tbl_2.no_new_loan>15 AND tbl_2.no_new_loan<31) THEN 1 ELSE 0 END),
                    '16_to_30_t'=SUM(CASE WHEN (tbl_2.no_new_loan>15 AND tbl_2.no_new_loan<31) THEN 1 ELSE 0 END),
                    
                    '31_to_50_u'=SUM(CASE WHEN (tbl_2.urcode=1 AND tbl_2.no_new_loan>30 AND tbl_2.no_new_loan<51) THEN 1 ELSE 0 END),
                    '31_to_50_r'=SUM(CASE WHEN (tbl_2.urcode=2 AND tbl_2.no_new_loan>30 AND tbl_2.no_new_loan<51) THEN 1 ELSE 0 END),
                    '31_to_50_t'=SUM(CASE WHEN (tbl_2.no_new_loan>30 AND tbl_2.no_new_loan<51) THEN 1 ELSE 0 END),
                    
                    '50_plus_u'=SUM(CASE WHEN (tbl_2.urcode=1 AND tbl_2.no_new_loan>50) THEN 1 ELSE 0 END),
                    '50_plus_r'=SUM(CASE WHEN (tbl_2.urcode=2 AND tbl_2.no_new_loan>50) THEN 1 ELSE 0 END),
                    '50_plus_t'=SUM(CASE WHEN (tbl_2.no_new_loan>50) THEN 1 ELSE 0 END)
                    
                    FROM
                    (
                    	SELECT info.brcode,info.branchname,info.urcode, ISNULL(tbl_1.no_of_loan,0) AS no_new_loan 
                    	FROM Db_DP_Collection_mgr.dbo.allinformation AS info 
                    	LEFT JOIN
                    	(
                    		SELECT 
                    		jb_br_code,COUNT(*) AS no_of_loan
                    		FROM Db_DP_Collection_mgr.dbo.$tbl_name 
                    		WHERE 
                    		YEAR(DISBURSEMENT_DATE)='$year' 
                    		AND 
                    		MONTH(DISBURSEMENT_DATE)='$month'
                    		AND
                    		ADVANCE_LIMIT>50000
                    		GROUP BY jb_br_code
                    	) AS tbl_1 ON info.brcode=tbl_1.jb_br_code
                        WHERE info.brcode IN $IN_con
                        AND info.brcode NOT IN (0931,0932,0933,0934)
                    ) AS tbl_2 ";  
           
            $this->db->query("SET NUMERIC_ROUNDABORT OFF");
            $Q = $this->db->query($query);
            if($Q->num_rows()>0)
            {
             $data_ret=$Q->row_array();    
            }        
        }
        return $data_ret; 
    }
    //end misd_0050 


}
?>