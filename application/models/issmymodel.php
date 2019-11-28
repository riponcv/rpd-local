<?php
class Issmymodel extends CI_Model {

    var $title   = '';
     var $content = '';
     var $date    = '';

    function __construct()
     {
         // Call the Model constructor
         parent::__construct();
     }

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

		$query = $this->db->query($qstr);

        return $query;
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

    //////////////HERE
    function get_om__report_data_dist_cons($DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_omis_data_tbl_name($DATE);

        $query =  $this->db->query("SELECT DISTINCT(dd_jo_code) FROM $tbl_name where dd_end_dt='$DATE'");
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

function get_designation_dropdown_iss()
	{
		$data=array();
		$data['']='Select Designation';

		$query =  $this->db->query("SELECT Dsg_Code,Dsg_Desc FROM DMS_Designation where Dsg_Code not in ('0001', '0002')");

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


	function mydata_get($m,$y,$brcd)
	{
		$query =  $this->db->query("SELECT * FROM dms_deposit where dp_onth=".$m." And dp_yr=".$y." and dp_jo_code=".$brcd);

		return $query->result();
	}

	function dms_data_del($m,$y,$brcd)
	{
		$query =  $this->db->query("Delete FROM dms_deposit where dp_onth=".$m." And dp_yr=".$y." and dp_jo_code=".$brcd);

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

    function fetch_br_ao_do($br_ao_do=0,$br_ao_do_str='')
    {
        $select='';
        $like_str='';
        if($br_ao_do==2)
        {
            $select=' jbbrcode,BRANCH_NAME ';
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


	function fetch_branch_array_for_report_module($office_id=0,$report_option_id=0)
    {
        $data=array();
        $condition=" WHERE jbbrcode NOT IN(0931,0932,0933,0934,9999)";
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

        $Q =  $this->db->query("SELECT jbbrcode,BRANCH_NAME FROM vw_jb_div_zn_br  $condition");

        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          }
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

	function fetch_br_ao_do_iss($br_ao_do=0,$br_ao_do_str='')
    {
        $select='';
        $like_str='';
        if($br_ao_do==2)
        {
            $select=' brcode,bbbrcode,branchname ';
            $like_str=' branchname ';
        }

        if($br_ao_do==3)
        {

			$select=' zncode,znname ';
            $like_str=' znname ';

        }

        if($br_ao_do==4)
        {

			$select=' jbdvcode,dvname ';
            $like_str=' dvname ';

        }
        if($br_ao_do==6)
        {
			$select=' jbdvcode,dvname ';
            $like_str=' dvname ';
        }
        $data=array();
        $Q =  $this->db->query("SELECT DISTINCT $select FROM allinformation WHERE $like_str LIKE '$br_ao_do_str%'");
		if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          }
        }
        return $data;
    }

	function fetch_branch_array_for_report_iss($office_id=0,$report_option_id=0)
    {
        $data=array();
        $condition=" WHERE brcode NOT IN(0931,0932,0933,0934,9999)";
        if($report_option_id==1)
        {
          //$status=$this->get_login_office_status($office_id);
		  $status = $this->issmymodel->get_login_office_status_iss($office_id);
          if($status==4){$condition=" WHERE brcode='$office_id' ";}
          if($status==3){$condition=" WHERE zncode='$office_id' ";}
          if($status==2){$condition=" WHERE jbdvcode='$office_id' ";}
        }
        else if($report_option_id==2)
        {
          $condition=" WHERE brcode='$office_id' ";
        }
        else if($report_option_id==3)
        {
           $condition=" WHERE zncode='$office_id' ";
        }
        else if($report_option_id==4)
        {
           $condition=" WHERE jbdvcode='$office_id' ";
        }

        else if($report_option_id==6)
        {
           $condition=" WHERE jbdvcode='$office_id' AND znname LIKE '%CORP%' AND branchname LIKE '%CORP%'";
        }

		$Q =  $this->db->query("SELECT '12'+bbbrcode as bbbrcode, bbbrcode as bbrcode, branchname,zncode,znname,jbdvcode,dvname FROM allinformation $condition  ORDER BY jbdvcode,zncode,bbbrcode" );

        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          }
        }
        return $data;
    }

	function fetch_iss_data_details($branch_id_array_for_report=array(),$report_of_date='')
    {

		/*New code here start*/
       $table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($report_of_date));
		if($ch_year<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}
		/*New code here end*/
        $count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_data_tbl_name($report_of_date);
		 $data = array();
		 $legacy_db = $this->load->database('dbcomm', true);
		 if($legacy_db->table_exists($tbl_name) == FALSE)
		 {
			return $data;
		 }
		 else
		 {
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			 $legacy_db = $this->load->database('dbcomm', true);
			$Q =  $legacy_db->query("select a.SL,a.SUPERVISION_COA_ID,a.COA_DESCRIPTION, b.BANK_ID, b.BRANCH_ID, b.AMOUNT_BDT,
									b.ISLAMIC_CONVENTIONAL_INDICATOR, a.Figure_indication,a.COA_ID_VALUE, b.Data_Validation from
									(select SL,SUPERVISION_COA_ID,COA_DESCRIPTION, Figure_indication,COA_ID_VALUE from $table_name_new_old_template ) as   a left join
									(SELECT BANK_ID, BRANCH_ID, SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT, ISLAMIC_CONVENTIONAL_INDICATOR,
									(case when isnumeric(AMOUNT_BDT)=0 then 'Invalid' else 'Valid' end) as Data_Validation
									FROM $tbl_name
									where DATE='$report_of_date' and BRANCH_ID IN $IN_con) as b
									on a.SUPERVISION_COA_ID = b.SUPERVISION_COA_ID
									order by a.sl");
			  return $Q->result();
		 }

    }

	function fetch_iss_whole_data_details($branch_id_array_for_report=array(),$report_of_date='')
    {

		/*New code here start*/
       $table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($report_of_date));
		if($ch_year<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}
		/*New code here end*/
        $count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_data_tbl_name($report_of_date);
		 $data = array();
		 $legacy_db = $this->load->database('dbcomm', true);
		 if($legacy_db->table_exists($tbl_name) == FALSE)
		 {
			return $data;
		 }
		 else
		 {
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			$legacy_db = $this->load->database('dbcomm', true);
			$Q =  $legacy_db->query("select  x.*, y.* from $table_name_new_old_template x left join
										 ( (SELECT
										  [SUPERVISION_COA_ID],
										  sum(case when isnumeric([AMOUNT_BDT])=1  then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
										  FROM $tbl_name
										  where  [SUPERVISION_COA_ID] !='1010310'
										  group by [SUPERVISION_COA_ID])
										  union
										  (SELECT
										  [SUPERVISION_COA_ID],
										  min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
										  FROM $tbl_name
										  where [SUPERVISION_COA_ID] ='1010310'
										  group by [SUPERVISION_COA_ID]))
										  y
										  on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID
										  order by x.SL");

			  return $Q->result();
		 }

	}
	
	function fetch_iss2_cust_data_details($branch_id_array_for_report=array(),$report_of_date='')
    {

		/*New code here start*/
       $table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($report_of_date));
		if($ch_year<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}
		/*New code here end*/
        $count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_data_tbl_name($report_of_date);
		 $data = array();
		 $legacy_db = $this->load->database('dbcomm', true);
		 if($legacy_db->table_exists($tbl_name) == FALSE)
		 {
			return $data;
		 }
		 else
		 {
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			 $legacy_db = $this->load->database('dbcomm', true);
			$Q =  $legacy_db->query("select a.SL,a.SUPERVISION_COA_ID,a.COA_DESCRIPTION, b.BANK_ID, b.BRANCH_ID, b.AMOUNT_BDT,
									b.ISLAMIC_CONVENTIONAL_INDICATOR, a.Figure_indication,a.COA_ID_VALUE, b.Data_Validation from
									(select SL,SUPERVISION_COA_ID,COA_DESCRIPTION, Figure_indication,COA_ID_VALUE from $table_name_new_old_template ) as   a left join
									(SELECT BANK_ID, BRANCH_ID, SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT, ISLAMIC_CONVENTIONAL_INDICATOR,
									(case when isnumeric(AMOUNT_BDT)=0 then 'Invalid' else 'Valid' end) as Data_Validation
									FROM $tbl_name
									where DATE='$report_of_date' and BRANCH_ID IN $IN_con) as b
									on a.SUPERVISION_COA_ID = b.SUPERVISION_COA_ID
									order by a.sl");
			  return $Q->result();
		 }

	}
	
	function get_iss_data_tbl_name($date='')
	{

		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
			if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='T_PS_M_FI_MONITOR_BR_'.$tbl_arr[1].$tbl_arr[0];
            }
        }
        return $tbl_name;
	}

	function fetch_iss_data_details_completed_vs_total($branch_id_array_for_report=array(),$report_of_date='')
    {

        $tbl_name=$this->get_iss_data_tbl_name($report_of_date);
        $count_in_branch=count($branch_id_array_for_report);
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['bbbrcode'];
				 $IN_con.="'".$brcode."'";
               // $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $data=array();
        $data['total']=$count_in_branch;
        $data['completed']=0;

		$legacy_db = $this->load->database('dbcomm', true);
        $Q =  $legacy_db->query("SELECT DISTINCT(BRANCH_ID) FROM $tbl_name WHERE DATE = '$report_of_date' AND  BRANCH_ID IN $IN_con");

		if($Q->num_rows()>0)
        {
            $data['completed']=$Q->num_rows();
        }

        return $data;
	}
	
	function fetch_iss_missing_completed($branch_id_array_for_report=array(),$report_of_date='')
    {
   		$tbl_name = $this->get_iss_data_tbl_name($report_of_date);
        $count_in_branch = count($branch_id_array_for_report);
		$data=array();
        $select=" bbbrcode,brcode,branchname,jbdvcode,dvname,zncode,znname,gradecode,OfficePhone,Address ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode = $val['bbrcode'];
                $IN_con.="'".$brcode."'";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $Q =  $this->db->query("SELECT $select FROM allinformation WHERE brcode not in('0931','0932','0933','0934') and bbbrcode IN $IN_con ORDER BY dvname,znname,branchname");
		$legacy_db = $this->load->database('dbcomm', true);
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;

            if(isset($val['bbbrcode']))
            {
               $brcode = '12'.$val['bbbrcode'];
               $Q1 =  $legacy_db->query("SELECT * FROM $tbl_name WHERE BRANCH_ID = '$brcode' AND DATE = '$report_of_date'");
			  if($Q1->num_rows()>0)
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

	function get_login_office_status_iss($office_id=0)
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
        else if($key=='ZoneCode')
        {
           $office_status=3;
        }
        else if($key=='jbdivisioncode')
        {
           $office_status=2;
        }
        else
        {
           $office_status=1;
        }
		return $office_status;
    }

	function fetch_report_of_office_iss($office_id=0,$report_option_id=0)
    {
        $report_of_office='';
        $condition='';
        $select='';
        $sign='';
		$sign_code='';


        if($report_option_id==1)
        {
          $status=$this->get_login_office_status_iss($office_id);
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

	function get_iss_group($report_of_date='')
    {

		/*New code here start*/
			$table_name_new_old_template = '';
			$ch_year = date('Y', strtotime($report_of_date));
			if($ch_year<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year>=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
		/*New code here end*/
		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("select * from $table_name_new_old_template order by SL asc");
		return $query->result();
    }
	function iss_get_date()
	{
		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT convert(char(12),ISSEntryDate, 107) ISSEntryDate,
        									convert(char(12), stDate, 107) stDate,
        									convert(char(12), endDate, 107) endDate,
        									convert(char(12), CerendDate, 107) ISSCerendDate
        									from ISSEntryDate order by id desc");
	    return $query->result();
	}
	function iss_get_deptt_date()
	{
		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT convert(char(12),ISSEntryDate, 107) ISSEntryDate,
        									convert(char(12), stDate, 107) stDate,
        									convert(char(12), endDate, 107) endDate,
        									convert(char(12), CerendDate, 107) ISSCerendDate
        									from ISSEntryDate_dep order by id desc");
	    return $query->result();
	}

	function iss_get_check_deptt_date( $args_date = '' )
	{
		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT convert(char(12),ISSEntryDate, 107) ISSEntryDate,
        									convert(char(12), stDate, 107) stDate,
        									convert(char(12), endDate, 107) endDate,
        									convert(char(12), CerendDate, 107) ISSCerendDate
        									from ISSEntryDate_dep
        									where ISSEntryDate = '$args_date' order by id desc");
	    return $query->result();
	}

	function iss_get_cer_date($para='')
	{
		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT convert(char(12),ISSEntryDate,107) ISSEntryDate, convert(char(12),CerendDate,107) ISSCerendDate from ISSEntryDate where ISSEntryDate='$para' order by id desc");
	    return $query->result();
	}

	function get_branch_iss_report($office_id=0,$iss_date=0)
    {
		 $data=array();
		 $tbl_name = $this->get_iss_data_tbl_name($iss_date);
		 $legacy_db = $this->load->database('dbcomm', true);
		 if($legacy_db->table_exists($tbl_name) == FALSE)
		 {
			return $data;
		 }
		 else
		 {
			$bbbrcode = '12'.$bbbrcode = $this->get_bb_brcode($office_id);
			$legacy_db = $this->load->database('dbcomm', true);
			$Q =  $legacy_db->query("SELECT * FROM $tbl_name WHERE BRANCH_ID='".$bbbrcode."' AND DATE='".$iss_date."'");
			return $Q->result();
		 }
    }
	function get_bb_brcode($office_id)
    {
		$query = $this->db->query("select bbbrcode from allinformation where brcode = $office_id");

		foreach($query->result_array() as $row)
		{
			$data = $row['bbbrcode'];
		}

		return $data;
    }

	function fetch_iss_data_exist($branch_id_array_for_report=array(),$report_of_date='')
    {

        $count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_data_tbl_name($report_of_date);
        $legacy_db = $this->load->database('dbcomm', true);

		if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			return 0;
		}
		else
		{
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			 $legacy_db = $this->load->database('dbcomm', true);

			$Q =  $legacy_db->query("select BANK_ID, BRANCH_ID, AMOUNT_BDT,
									ISLAMIC_CONVENTIONAL_INDICATOR from $tbl_name
									where DATE='$report_of_date' AND BRANCH_ID IN $IN_con");


		   return $Q->result();
		}

    }
	//////////////////////////New Whole Branch start/////////////////////////////////

/*-----------------------------------------------whole bank report testing here start*/
	function fetch_whole_branch_raw_data($report_of_date='')
    {

      		//$table_name_new_old_template = '';
			$ch_year = date('Y', strtotime($report_of_date));
			$table_name_new_old_template = '';
			if($ch_year<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year>=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
			$table_name_year = date('Y', strtotime($report_of_date));
			$table_name_whole_raw = 'TOTAL_BRANCH_RAW_'.$table_name_year;
			$legacy_db = $this->load->database('dbcomm', true);

			$Q =  $legacy_db->query("select * from $table_name_whole_raw where basedate='$report_of_date'");

		   return $Q->result();
    }
	function fetch_whole_branch_final_data($report_of_date='')
    {

      		//$table_name_new_old_template = '';
			$ch_year = date('Y', strtotime($report_of_date));
			$table_name_new_old_template = '';
			if($ch_year<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year>=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
			$table_name_year = date('Y', strtotime($report_of_date));
			$table_name_whole_raw = 'TOTAL_BRANCH_Final_'.$table_name_year;
			$legacy_db = $this->load->database('dbcomm', true);

			$Q =  $legacy_db->query("select * from $table_name_whole_raw where basedate='$report_of_date'");

		   return $Q->result();
    }
	function fetch_whole_branch_certificate_data($report_of_date='')
    {
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($report_of_date));
		if($ch_year<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}
		$table_name_year = date('Y', strtotime($report_of_date));
		$table_name_whole_raw = 'TOTAL_BRANCH_Ceritficate_'.$table_name_year;
		$legacy_db = $this->load->database('dbcomm', true);

		$Q =  $legacy_db->query("select * from $table_name_whole_raw where basedate='$report_of_date'");
		return $Q->result();
    }

	function fetch_iss_data_whole_branch($raw_data='',$certificate_data='',$report_of_date='')
    {

      		$table_name_new_old_template = '';
			$table_name_whole_raw = '';
			$ch_year = date('Y', strtotime($report_of_date));
			if($ch_year<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year>=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
			if(($raw_data)==($certificate_data))
			{

				$table_name_whole_raw='';
				$table_name_year = date('Y', strtotime($report_of_date));
				$table_name_whole_final = 'sum_iss_2_final_'.$table_name_year;

				$legacy_db = $this->load->database('dbcomm', true);
				$Q =  $legacy_db->query("select a.* from $table_name_whole_final a, $table_name_new_old_template b
										where a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID AND a.report_date='$report_of_date' order by b.SL");
			}
			if(($raw_data)!=($certificate_data))
			{

				$table_name_whole_raw='';
				$table_name_year = date('Y', strtotime($report_of_date));
				$table_name_whole_raw = 'sum_iss_2_raw_'.$table_name_year;

				$legacy_db = $this->load->database('dbcomm', true);
				$Q =  $legacy_db->query("select a.* from $table_name_whole_raw a, $table_name_new_old_template b
										where a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID AND a.report_date='$report_of_date' order by b.SL");
			}
			   return $Q->result();
    }
	function fetch_iss_missing_completed_whole_br($report_of_date='')
    {

		$data=array();
		$ch_year = date('Y', strtotime($report_of_date));
		$ch_monthe = date('m', strtotime($report_of_date));

		$table_name_year = date('Y', strtotime($report_of_date));
		$whole_branch_status_iss = 'whole_branch_status_iss_2_'.$ch_monthe.$ch_year;

		$legacy_db = $this->load->database('dbcomm', true);
		 if($legacy_db->table_exists($whole_branch_status_iss) == FALSE)
		 {
			 return $data;
		 }
		else
		{
			$Q =  $legacy_db->query("select * from $whole_branch_status_iss where report_date='$report_of_date' order by dvname");
			return $Q->result();
		}

    }
/*-----------------------------------------------whole bank report testing here end*/
/*Add start*/
	function fetch_iss_cer_area_list($certificate_data='',$report_of_date='')
    {
	    $tbl_name = $this->get_iss_cer_tbl_name_to_insert($report_of_date);
		$legacy_db = $this->load->database('dbcomm', true);
		$Q =  $legacy_db->query("select certified_br_ar_div_code from $tbl_name where LEN(certified_br_ar_div_code)=4 AND LEFT(certified_br_ar_div_code,1)=5");

		return $Q->result();
    }
	function fetch_iss_cer_division_list($report_of_date='')
    {
	    $tbl_name = $this->get_iss_cer_tbl_name_to_insert($report_of_date);
		$legacy_db = $this->load->database('dbcomm', true);
		$Q =  $legacy_db->query("select certified_br_ar_div_code from $tbl_name where LEN(certified_br_ar_div_code)=4 AND LEFT(certified_br_ar_div_code,1)=7");

		return $Q->result();
    }
	/*Add end*/
	//////////////////////////New Whole Branch start/////////////////////////////////
	//////////////////////////Certificate       Related//////////////////
	function get_iss_cer_tbl_name_to_insert($date='')
	{

		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='certificate_'.$tbl_arr[1].'_'.$tbl_arr[0];
            }
        }

        return $tbl_name;

	}

	function generate_iss_certificate_new_tbl($DATE='')
	{

        //data table extract from date
        $tbl_name=$this->get_iss_cer_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        //create table if not exist
        if( $legacy_db->table_exists($tbl_name) == FALSE)
        {
             $query = "CREATE TABLE $tbl_name
                    (
                        id int NOT NULL PRIMARY KEY IDENTITY,
                        basedate smalldatetime,
                        iss_form int,
                        certified_br_ar_div_code int,
                        is_br_ar_div_certificate int,
                        br_ar_div__user_id varchar(100),
                        br_ar_div__head_name varchar(100),
                        br_ar_div__head_designation varchar(100),
						certificate_date smalldatetime,
						br_ar_div__officer_name_1 varchar(100),
						br_ar_div__officer_name_2 varchar(100),
						br_ar_div__officer_name_3 varchar(100),
						br_ar_div__officer_designation_1 varchar(100),
						br_ar_div__officer_designation_2 varchar(100),
						br_ar_div__officer_designation_3 varchar(100)
                    );";

            $legacy_db->query($query);
        }

	}

	function exist_iss_cer($OFF_ID,$DATE)
	{
       //data table extract from date
        $tbl_name=$this->get_iss_cer_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);
		$ret_value;
        //create table if not exist
        if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			$ret_value =0;
		}
		else
		{
			$query =  $legacy_db->query("SELECT * FROM $tbl_name where certified_br_ar_div_code = $OFF_ID AND basedate = '$DATE' ");

			if ($query->num_rows() > 0){$ret_value =1;}
			else
			{$ret_value =0;}
		}
		return $ret_value;
	}

	function delete_iss_cer($OFF_ID,$DATE)
	{

		//data table extract from date
        $tbl_name=$this->get_iss_cer_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);
        $legacy_db->query("delete from $tbl_name where certified_br_ar_div_code = $OFF_ID AND basedate='$DATE'");

	}

	function save_iss_certificate($office_id=0,$DATE='')
    {
	    $status='error';
		$tbl_name = $this->get_iss_cer_tbl_name_to_insert($DATE);

		//echo $tbl_name;
		//die('test');
		$legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			$this->generate_iss_certificate_new_tbl($DATE);

			$option_selector = $this->session->userdata('report_option_selector');
			$office_check = $this->session->userdata('report_office_check');

			$office_status = $this->session->userdata('login_office_status');

			$uid = $this->session->userdata('some_uid');
			$iss_form = $this->session->userdata('iss_from');
			$iss_cer_sb_dt = date("Y-m-d");
			if (isset($_POST['cer_check']))
			 {
				$office_cer = 1;
			 }
			 else
			 {
				$office_cer = 0;
			 }

			//if($office_status == 4 && $option_selector == 1) {$office_check
			if($office_status == 4) {

				$br_officer_name = $this->input->post('br_concern_officer_name');
				$br_office_head = $this->input->post('br_head_name');
				$br_office_desig = $this->input->post('br_concern_officer_designation');
				$br_head_desig = $this->input->post('br_head_designation');

				$data = array(
						'basedate'	    => $_POST['report_date_send'],
						'iss_form'	=> $iss_form,
						'certified_br_ar_div_code' 	=>  $office_id,
						'is_br_ar_div_certificate' 	    => $office_cer,
						'br_ar_div__user_id'	=> $uid,
						'br_ar_div__head_name'	    => $br_office_head,
						'br_ar_div__head_designation'	    => $br_head_desig,
						'certificate_date'	    => $iss_cer_sb_dt,
						'br_ar_div__officer_name_1'	    => $br_officer_name,
						'br_ar_div__officer_name_2'	    => 0,
						'br_ar_div__officer_name_3'	    => 0,
						'br_ar_div__officer_designation_1'	    => $br_office_desig,
						'br_ar_div__officer_designation_2'	    => 0,
						'br_ar_div__officer_designation_3'	    => 0
					);
			}
			else {
				//if($office_status != 4 && $option_selector == 1) {
				if($office_status != 4) {

					$bad_officer_name_1 = $this->input->post('concern_officer_name_1');
					$bad_officer_name_2 = $this->input->post('concern_officer_name_2');
					$bad_officer_name_3 = $this->input->post('concern_officer_name_3');
					$bad_office_head = $this->input->post('ro_dv_head_name');
					$bad_office_desig_1 = $this->input->post('concern_officer_desig_1');
					$bad_office_desig_2 = $this->input->post('concern_officer_desig_2');
					$bad_office_desig_3 = $this->input->post('concern_officer_desig_3');
					$bad_head_desig = $this->input->post('ro_dv_head_designation');

					$data = array(
							'basedate'	    => $_POST['report_date_send'],
							'iss_form'	=> $iss_form,
							'certified_br_ar_div_code' 	=>  $office_id,
							'is_br_ar_div_certificate' 	    => $office_cer,
							'br_ar_div__user_id'	=> $uid,
							'br_ar_div__head_name'	    => $bad_office_head,
							'br_ar_div__head_designation'	    => $bad_head_desig,
							'certificate_date'	    => $iss_cer_sb_dt,
							'br_ar_div__officer_name_1'	    => $bad_officer_name_1,
							'br_ar_div__officer_name_2'	    => $bad_officer_name_2,
							'br_ar_div__officer_name_3'	    => $bad_officer_name_3,
							'br_ar_div__officer_designation_1'	    => $bad_office_desig_1,
							'br_ar_div__officer_designation_2'	    => $bad_office_desig_2,
							'br_ar_div__officer_designation_3'	    => $bad_office_desig_3
						);
				}
			}

			if($this->issmymodel->add_iss_certificate($data,$_POST['report_date_send'])==1)
			{
				$status='success';
			}
		}
		else
		{

			$option_selector = $this->input->post('report_option_selector');
			$office_status = $this->input->post('login_office_status');

			$uid = $this->session->userdata('some_uid');
			$iss_form = $this->session->userdata('iss_from');
			$iss_cer_sb_dt = date("Y-m-d");
			if (isset($_POST['cer_check']))
			 {
				$office_cer = 1;
			 }
			 else
			 {
				$office_cer = 0;
			 }

			//if($office_status == 4 && $option_selector == 1) {
			if($office_status == 4) {

				$br_officer_name = $this->input->post('br_concern_officer_name');
				$br_office_head = $this->input->post('br_head_name');
				$br_office_desig = $this->input->post('br_concern_officer_designation');
				$br_head_desig = $this->input->post('br_head_designation');

				$data = array(
						'basedate'	    => $_POST['report_date_send'],
						'iss_form'	=> $iss_form,
						'certified_br_ar_div_code' 	=>  $office_id,
						'is_br_ar_div_certificate' 	    => $office_cer,
						'br_ar_div__user_id'	=> $uid,
						'br_ar_div__head_name'	    => $br_office_head,
						'br_ar_div__head_designation'	    => $br_head_desig,
						'certificate_date'	    => $iss_cer_sb_dt,
						'br_ar_div__officer_name_1'	    => $br_officer_name,
						'br_ar_div__officer_name_2'	    => 0,
						'br_ar_div__officer_name_3'	    => 0,
						'br_ar_div__officer_designation_1'	    => $br_office_desig,
						'br_ar_div__officer_designation_2'	    => 0,
						'br_ar_div__officer_designation_3'	    => 0
					);
			}
			else {
				//if($office_status != 4 && $option_selector == 1) {
				if($office_status != 4) {

					$bad_officer_name_1 = $this->input->post('concern_officer_name_1');
					$bad_officer_name_2 = $this->input->post('concern_officer_name_2');
					$bad_officer_name_3 = $this->input->post('concern_officer_name_3');
					$bad_office_head = $this->input->post('ro_dv_head_name');
					$bad_office_desig_1 = $this->input->post('concern_officer_desig_1');
					$bad_office_desig_2 = $this->input->post('concern_officer_desig_2');
					$bad_office_desig_3 = $this->input->post('concern_officer_desig_3');
					$bad_head_desig = $this->input->post('ro_dv_head_designation');

					$data = array(
							'basedate'	    => $_POST['report_date_send'],
							'iss_form'	=> $iss_form,
							'certified_br_ar_div_code' 	=>  $office_id,
							'is_br_ar_div_certificate' 	    => $office_cer,
							'br_ar_div__user_id'	=> $uid,
							'br_ar_div__head_name'	    => $bad_office_head,
							'br_ar_div__head_designation'	    => $bad_head_desig,
							'certificate_date'	    => $iss_cer_sb_dt,
							'br_ar_div__officer_name_1'	    => $bad_officer_name_1,
							'br_ar_div__officer_name_2'	    => $bad_officer_name_2,
							'br_ar_div__officer_name_3'	    => $bad_officer_name_3,
							'br_ar_div__officer_designation_1'	    => $bad_office_desig_1,
							'br_ar_div__officer_designation_2'	    => $bad_office_desig_2,
							'br_ar_div__officer_designation_3'	    => $bad_office_desig_3
						);
				}
			}

			if($this->issmymodel->add_iss_certificate($data,$_POST['report_date_send'])==1)
			{
				$status='success';
			}
		}
        return $status;

    }

	function add_iss_certificate($data,$DATE)
	{
        //data table extract from date
        $tbl_name = $this->get_iss_cer_tbl_name_to_insert($DATE);

		//now insert data
		$legacy_db = $this->load->database('dbcomm', true);
        if($legacy_db->insert($tbl_name, $data))
		{
			return 1;
		}
		else
		{
		return 0;
		}

	}

	function get_iss_cer_data_tbl_name_to_insert($date='')
	{

		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
			if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='T_PS_M_FI_MONITOR_BR_FINAL_'.$tbl_arr[1].$tbl_arr[0];
            }
        }
        return $tbl_name;
	}

	function generate_iss_certified_data_new_tbl($DATE='')
	{

        //data table extract from date
        $tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        //create table if not exist
        if( $legacy_db->table_exists($tbl_name) == FALSE)
        {
             $query = "CREATE TABLE $tbl_name
                    (
                        id int NOT NULL PRIMARY KEY IDENTITY,
                        DATE smalldatetime,
                        BANK_ID int,
                        BRANCH_ID int,
                        SUPERVISION_COA_ID int,
                        COA_DESCRIPTION varchar(150),
                        AMOUNT_BDT numeric(20, 2),
						ISLAMIC_CONVENTIONAL_INDICATOR varchar(50),
						iss_uid varchar(50),
                    );";

            $legacy_db->query($query);
        }

	}

	function delete_iss_cer_data($OFF_ID,$DATE)
	{
        //data table extract from date
        $tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			return false;
		}
		else
		{
			$query =  $legacy_db->query("SELECT * FROM $tbl_name where BRANCH_ID = $OFF_ID AND DATE = '$DATE'");
			 //return $query->result();
			 if ($query->num_rows() > 0){return true;}
			 else
			 {return  false;}
		}

	}

	function delete_iss_data($OFF_ID,$DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);
        $legacy_db->query("delete from $tbl_name where BRANCH_ID = '$OFF_ID' AND DATE = '$DATE'");
	}

	function save_iss_certified_data($office_id=0,$DATE='')
    {
	    $status='error';

        $tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($DATE);
		$legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			 $this->generate_iss_certified_data_new_tbl($DATE);
		}
        {
			$amount = $this->input->post('amount');
			$date = $this->input->post('report_date_send');
			$bank_id = $this->input->post('bank_id_send');
			$branch_id_bal = $this->input->post('branch_id_bal');
			$COA_ID = $this->input->post('COA_ID');
			$COA_DESC = $this->input->post('COA_DESC');
			$ISLAMIC_CONVENTIONAL = $this->input->post('ISLAMIC_CONVENTIONAL');
			$UID= $this->session->userdata('some_uid');
			$c=0;
			foreach($amount as $amountVal)
			{
				$amountVal=round($amountVal,2);
				$data = array(
						'DATE' => $date,
						'BANK_ID' => $bank_id,
						'BRANCH_ID'  => $branch_id_bal,
						'SUPERVISION_COA_ID' => $COA_ID[$c],
						'COA_DESCRIPTION' => $COA_DESC[$c],
						'AMOUNT_BDT' => $amountVal,
						'ISLAMIC_CONVENTIONAL_INDICATOR' => $ISLAMIC_CONVENTIONAL,
						'iss_uid' => $UID
					);
					if($this->issmymodel->add_iss_certified_data($data,$date)==1)
					{
						$status='success';
					}
					$c++;
			}
        }
        return $status;
    }

	function add_iss_certified_data($data,$DATE)
	{
        //data table extract from date
        $tbl_name = $this->get_iss_cer_data_tbl_name_to_insert($DATE);

		//now insert data
		$legacy_db = $this->load->database('dbcomm', true);
        if($legacy_db->insert($tbl_name, $data))
		{
			return 1;
		}
		else
		{
		return 0;
		}

	}

	function fetch_iss_missing_completed_final($branch_id_array_for_report=array(),$report_of_date='')
    {
   		$tbl_name = $this->get_iss_cer_data_tbl_name_to_insert($report_of_date);
        $count_in_branch = count($branch_id_array_for_report);

		$data=array();
        $select=" bbbrcode,brcode,branchname,dvname,znname,OfficePhone,Address ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode = $val['bbrcode'];
                //$IN_con .="$brcode";
				 $IN_con.="'".$brcode."'";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $Q =  $this->db->query("SELECT $select FROM allinformation WHERE bbbrcode IN $IN_con ORDER BY dvname,znname,branchname");
      	$legacy_db = $this->load->database('dbcomm', true);

        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;

            if(isset($val['bbbrcode']))
            {
               $brcode = '12'.$val['bbbrcode'];
               $Q1 =  $legacy_db->query("SELECT * FROM $tbl_name WHERE BRANCH_ID = '$brcode' AND DATE = '$report_of_date'");

			   if($Q1->num_rows()>0)
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

	function fetch_iss_cer_data_details_completed_vs_total($branch_id_array_for_report=array(),$report_of_date='')
    {
        $tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($report_of_date);
        $count_in_branch=count($branch_id_array_for_report);

        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode=$val['bbbrcode'];
				 $IN_con.="'".$brcode."'";
               // $IN_con .="$brcode";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $data=array();
        $data['total']=$count_in_branch;
        $data['completed']=0;

		$legacy_db = $this->load->database('dbcomm', true);
        $Q =  $legacy_db->query("SELECT DISTINCT(BRANCH_ID) FROM $tbl_name WHERE DATE = '$report_of_date' AND  BRANCH_ID IN $IN_con");

		if($Q->num_rows()>0)
        {
            $data['completed']=$Q->num_rows();
        }
        return $data;
    }

	function fetch_iss_certificate_exist($branch_id_for_report=0,$report_of_date='')
    {
		$data=array();
        $tbl_name = $this->get_iss_cer_tbl_name_to_insert($report_of_date);

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			// $this->generate_iss_certified_data_new_tbl($DATE);
			return 0;
		}
		else
		{
			$Q =  $legacy_db->query("select * from $tbl_name where basedate='$report_of_date' and certified_br_ar_div_code = '$branch_id_for_report'");

			if($Q->num_rows()>0)
			{
			   //$data['completed']=$Q->num_rows();
			   $data = $Q->result();
			}
		   return $Q->result();
		}
    }

	function fetch_iss_certificate_exist_single($branch_id_for_report=0,$report_of_date='')
    {
		$data=array();
        $tbl_name = $this->get_iss_cer_tbl_name_to_insert($report_of_date);

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			return 0;
		}
		else
		{
			$Q =  $legacy_db->query("select * from $tbl_name where certified_br_ar_div_code = $branch_id_for_report");

			if($Q->num_rows()>0)
			{
			   $data = $Q->result();
			}
		   return $Q->result();
		}

    }
	function fetch_iss_certificate_data($branch_id_array_for_report,$report_of_date='')
    {
		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_cer_tbl_name_to_insert($report_of_date);
		 $data = array();
		 $legacy_db = $this->load->database('dbcomm', true);
		 if($legacy_db->table_exists($tbl_name) == FALSE)
		 {
			return $data;
		 }
		else
		{
			$select="*";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			 $legacy_db = $this->load->database('dbcomm', true);
			$Q =  $legacy_db->query("select * from $tbl_name where certified_br_ar_div_code IN $IN_con AND basedate='$report_of_date'");

			if($Q->num_rows()>0)
			{
			   $data = $Q->result();
			}
		     return $Q->result();
		}
    }
	function fetch_iss_cer_data_details($branch_id_array_for_report=array(),$report_of_date='')
    {
	    /*New code here start*/
        	$table_name_new_old_template = '';
			$ch_year = date('Y', strtotime($report_of_date));
			if($ch_year<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year>=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
		/*New code here end*/

		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($report_of_date);
		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			// $this->generate_iss_certified_data_new_tbl($DATE);
			return 0;
		}
		else
		{
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			$Q =  $legacy_db->query("select a.SL,a.SUPERVISION_COA_ID,a.COA_DESCRIPTION, a.Figure_indication,a.COA_ID_VALUE, b.BANK_ID, b.BRANCH_ID, b.AMOUNT_BDT,
									b.ISLAMIC_CONVENTIONAL_INDICATOR, b.Data_Validation from
									(select SL,SUPERVISION_COA_ID,COA_DESCRIPTION,Figure_indication,COA_ID_VALUE from $table_name_new_old_template ) as   a left join
									(SELECT BANK_ID, BRANCH_ID, SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT , ISLAMIC_CONVENTIONAL_INDICATOR,
									(case when isnumeric(AMOUNT_BDT)=0 then 'Invalid' else 'Valid' end) as Data_Validation
									FROM $tbl_name where DATE='$report_of_date' and BRANCH_ID IN $IN_con) as b
									 on a.SUPERVISION_COA_ID = b.SUPERVISION_COA_ID order by a.sl");

			  return $Q->result();
		}
    }

	function fetch_iss_whole_cer_data_details($branch_id_array_for_report=array(),$report_of_date='')
    {
	    /*New code here start*/
        	$table_name_new_old_template = '';
			$ch_year = date('Y', strtotime($report_of_date));
			if($ch_year<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year>=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
		/*New code here end*/

		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($report_of_date);
		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			// $this->generate_iss_certified_data_new_tbl($DATE);
			return 0;
		}
		else
		{
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			$Q =  $legacy_db->query("select  x.*, y.* from $table_name_new_old_template x left join
											 ( (SELECT
											  [SUPERVISION_COA_ID],
											  sum(case when isnumeric([AMOUNT_BDT])=1  then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											  FROM $tbl_name
											  where  [SUPERVISION_COA_ID] !='1010310'
											  group by [SUPERVISION_COA_ID])
											  union
											  (SELECT
											  [SUPERVISION_COA_ID],
											  min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											  FROM $tbl_name
											  where [SUPERVISION_COA_ID] ='1010310'
											  group by [SUPERVISION_COA_ID]))
											  y
											  on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID --and
											  order by x.SL");
			  return $Q->result();
		}
    }

	function fetch_iss_cer_data_exist($branch_id_array_for_report=array(),$report_of_date='')
    {

        $count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($report_of_date);
        $legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			// $this->generate_iss_certified_data_new_tbl($DATE);
			return 0;
		}
		else
		{
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			 $legacy_db = $this->load->database('dbcomm', true);

			$Q =  $legacy_db->query("select BANK_ID, BRANCH_ID, AMOUNT_BDT,
									ISLAMIC_CONVENTIONAL_INDICATOR from $tbl_name
									where BRANCH_ID IN $IN_con");

			 return $Q->result();
		}
    }

	function fetch_iss_cer_missing_completed($branch_id_array_for_report=array(),$report_of_date='')
    {
   		$tbl_name = $this->get_iss_cer_data_tbl_name_to_insert($report_of_date);
        $count_in_branch = count($branch_id_array_for_report);

		$data=array();
        $select=" bbbrcode,brcode,branchname,dvname,znname,OfficePhone,Address ";
        $IN_con='';
        if($count_in_branch>0)
        {
            $IN_con="(";
            foreach($branch_id_array_for_report as $key=>$val)
            {
                $brcode = $val['bbrcode'];
                //$IN_con .="$brcode";
				 $IN_con.="'".$brcode."'";
                if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
            }
            $IN_con .=")";
        }

        $Q =  $this->db->query("SELECT $select FROM allinformation WHERE bbbrcode IN $IN_con ORDER BY dvname,znname,branchname");

		$legacy_db = $this->load->database('dbcomm', true);

        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $key=>$val)
          {
            $data[$key]=$val;

            if(isset($val['bbbrcode']))
            {
               $brcode = '12'.$val['bbbrcode'];
               $Q1 =  $legacy_db->query("SELECT * FROM $tbl_name WHERE BRANCH_ID = '$brcode' AND DATE = '$report_of_date'");

			   if($Q1->num_rows()>0)
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

	//ISS Comparision Report start here/////////////
	function fetch_iss_comp_cer_data_details($branch_id_array_for_report=array(),$report_of_date='')
    {


		/*New code here start*/
       $table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($report_of_date));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}
		/*New code here end*/
		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name=$this->get_iss_cer_data_tbl_name_to_insert($report_of_date);
		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name) == FALSE)
		{
			// $this->generate_iss_certified_data_new_tbl($DATE);
			return 0;
		}
		else
		{
			$select=" DATE, BANK_ID, BRANCH_ID,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT ";
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			$Q =  $legacy_db->query("select a.SL,a.SUPERVISION_COA_ID,a.COA_DESCRIPTION, b.BANK_ID, b.BRANCH_ID, b.AMOUNT_BDT,
									b.ISLAMIC_CONVENTIONAL_INDICATOR, a.Figure_indication,a.COA_ID_VALUE, b.Data_Validation from
									(select SL,SUPERVISION_COA_ID,COA_DESCRIPTION from, Figure_indication,COA_ID_VALUE $table_name_new_old_template ) as   a left join
									(SELECT BANK_ID, BRANCH_ID, SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT , ISLAMIC_CONVENTIONAL_INDICATOR,
									(case when isnumeric(AMOUNT_BDT)=0 then 'Invalid' else 'Valid' end) as Data_Validation
									FROM $tbl_name
									where DATE='$report_of_date' and BRANCH_ID IN $IN_con) as b
									on a.SUPERVISION_COA_ID = b.SUPERVISION_COA_ID
									order by a.sl");
			  return $Q->result();
		}
    }

	function get_premonth_date($current_date='')
    {

        $data=array();
		$legacy_db = $this->load->database('dbcomm', true);
        $Q =  $legacy_db->query("select ISSEntryDate FROM ISSEntryDate WHERE ISSEntryDate <= CONVERT(datetime, '$current_date', 103)
ORDER BY id DESC");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $data[] = $row;
          }
        }
        $return_date='';
        if(count($data)>0){$return_date=$data[1]['ISSEntryDate'];}
        return $return_date;
    }
	//ISS Comparision Report end here/////////////

/*------------------------ISS Form-2 query start here----------------------------------------*/
	function process_iss_2_whole_branch_status($current_date='')
    {

        $data=array();
		$time=strtotime($current_date);
		$month=date("F",strtotime($current_date));
		$year=date("Y",strtotime($current_date));

		$dateValue = strtotime($current_date);

		$yr = date("Y", strtotime($current_date));
		$mon = date("m", strtotime($current_date));
		$date = date("d", strtotime($current_date));

		$MON = date("M", strtotime($current_date));

		$table_name_new_old_template = '';
		if($yr<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($yr>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}
		//echo $yr.'='.$mon.'='.$date;
		//echo $current_date;

		/*whole branch table status start*/
		$table_name_whole_branch_status_iss_2_date=$date.'-'.$MON.'-'.$yr;
		$table_name_whole_branch_status_iss_2 = 'whole_branch_status_iss_2_'.$mon.$yr;
		//echo 'table_name_whole_branch_status_iss_2_date='.$table_name_whole_branch_status_iss_2_date;
		//echo '</br>'.'table_name_whole_branch_status_iss_2='.$table_name_whole_branch_status_iss_2;

		/*whole branch table status end*/
		//$Q =  $this->db->query("SELECT dd_amt FROM $tbl_name WHERE dd_end_dt='$report_of_date' AND dd_jo_code IN $IN_con AND dd_pt_id IN $dd_pt_id_con ");
		$legacy_db = $this->load->database('dbcomm', true);
		if($legacy_db->table_exists($table_name_whole_branch_status_iss_2) == FALSE)
		{
			$Q_status=  $legacy_db->query("SELECT '$table_name_whole_branch_status_iss_2_date' as 'report_date', '12'+bbbrcode as 'bbrcode', bbbrcode,brcode,branchname,jbdvcode,dvname,zncode,znname,OfficePhone,Address,gradecode, '0' as 'status', '0' as 'is_certificate'
									into $table_name_whole_branch_status_iss_2 FROM allinformation
									where brcode not in('0931','0932','0933','0934','9999') ORDER BY dvname,znname,branchname");
		}
		else
		{

			$Q_tbl_drop =  $legacy_db->query("drop table $table_name_whole_branch_status_iss_2");
			$Q_status =  $legacy_db->query("SELECT '$table_name_whole_branch_status_iss_2_date' as 'report_date', '12'+bbbrcode as 'bbrcode', bbbrcode,brcode,branchname,jbdvcode,dvname,zncode,znname,OfficePhone,Address,gradecode, '0' as 'status', '0' as 'is_certificate'
									into $table_name_whole_branch_status_iss_2 FROM allinformation
									where brcode not in('0931','0932','0933','0934','9999') ORDER BY dvname,znname,branchname");


		}

/*------------------------Raw data process start--------------------*/
		$table_iss_data='T_PS_M_FI_MONITOR_BR_'.$mon.$yr;
		//echo '</br>'.'table_iss_data='.$table_iss_data;

		$legacy_db = $this->load->database('dbcomm', true);
		if($legacy_db->table_exists($table_iss_data) == TRUE)
		{
			$Q_iss_data =  $legacy_db->query("Select distinct(BRANCH_ID) as 'key_branch' from $table_iss_data");
			$Q_iss_status =  $legacy_db->query("Select * from $table_name_whole_branch_status_iss_2");
			foreach($Q_iss_status->result_array() as $row_status)
			{

				foreach($Q_iss_data->result_array() as $row_data)
				{
					if($row_status['bbrcode']==$row_data['key_branch'])
					{
						$temp_bbrcode=$row_status['bbrcode'];
						$Q_iss_temp1 =  $legacy_db->query("update $table_name_whole_branch_status_iss_2 set status=1 where bbrcode=$temp_bbrcode");
					}
				}
			}
		}
/*------------------------Raw data process end--------------------*/
/*------------------------Final data process start--------------------*/
		$table_final_iss_data = 'T_PS_M_FI_MONITOR_BR_FINAL_'.$mon.$yr;
		//echo '</br>'.'table_final_iss_data='.$table_final_iss_data;
		$legacy_db = $this->load->database('dbcomm', true);
		if($legacy_db->table_exists($table_final_iss_data) == TRUE)
		{
			$Q_iss_final_data =  $legacy_db->query("Select distinct(BRANCH_ID) as 'key_branch' from $table_final_iss_data");
			$Q_iss_status =  $legacy_db->query("Select * from $table_name_whole_branch_status_iss_2");
			foreach($Q_iss_status->result_array() as $row_status)
			{

				foreach($Q_iss_final_data->result_array() as $row_final_data)
				{
					if($row_status['bbrcode']==$row_final_data['key_branch'])
					{
						$temp_bbrcode=$row_status['bbrcode'];
						$Q_iss_temp1 =  $legacy_db->query("update $table_name_whole_branch_status_iss_2 set is_certificate=1 where bbrcode=$temp_bbrcode");
					}
				}
			}
		}
/*------------------------Final data process end---------------------------------------*/
/*------------------------Sum Total branch raw data start------------------------------*/
$table_sum_raw_data='sum_iss_2_raw_'.$yr;
//echo '</br>'.'table_sum_raw_data='.$table_sum_raw_data;

$legacy_db = $this->load->database('dbcomm', true);
if($legacy_db->table_exists($table_sum_raw_data) == TRUE)
{
	$Q_iss_2_raw_data_dlt = $legacy_db->query("DELETE FROM $table_sum_raw_data where report_date='$table_name_whole_branch_status_iss_2_date'");

	/*26/10/2016 start*/
	$Q_iss_2_raw_data_insrt =  $legacy_db->query("insert into $table_sum_raw_data (report_date,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT)
												(
												select '$table_name_whole_branch_status_iss_2_date', y.SUPERVISION_COA_ID,x.COA_DESCRIPTION,y.AMOUNT_BDT from $table_name_new_old_template x left join
												( (SELECT
												[SUPERVISION_COA_ID],
												sum(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
												FROM $table_iss_data
												where [SUPERVISION_COA_ID] not in('1010310','1011665')
												group by [SUPERVISION_COA_ID])
												union
												(SELECT
												[SUPERVISION_COA_ID],
												min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
												FROM $table_iss_data
												where [SUPERVISION_COA_ID] ='1010310' group by [SUPERVISION_COA_ID])
												union
												(SELECT [SUPERVISION_COA_ID], max(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
												FROM $table_iss_data where [SUPERVISION_COA_ID] ='1011665' group by [SUPERVISION_COA_ID])
												) y on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID)");
/*26/10/2016 end*/

}
else
{
	$Q_iss_2_raw_data_crt =  $legacy_db->query("select '$table_name_whole_branch_status_iss_2_date' as 'report_date', y.SUPERVISION_COA_ID, x.COA_DESCRIPTION, y.AMOUNT_BDT into $table_sum_raw_data from   $table_name_new_old_template x left join
											( (SELECT
											[SUPERVISION_COA_ID],
											sum(case when isnumeric([AMOUNT_BDT])=1  then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $table_iss_data
											where  [SUPERVISION_COA_ID] not in('1010310','1011665')
											group by [SUPERVISION_COA_ID])
											union
											(SELECT
											[SUPERVISION_COA_ID],
											min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $table_iss_data
											where [SUPERVISION_COA_ID] ='1010310'
											group by [SUPERVISION_COA_ID]) union
											(SELECT
											[SUPERVISION_COA_ID],
											max(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $table_iss_data
											where [SUPERVISION_COA_ID] ='1011665'
											group by [SUPERVISION_COA_ID])
											)
											y
											on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID
											order by x.SL");
}
/*--------------------------------Sum Total branch raw data end------------------------------*/

/*--------------------------------insert sum of whole branch start---------------------------*/
		$table_whole_branch_raw='TOTAL_BRANCH_RAW_'.$yr;
		//echo '</br>'.'table_whole_branch_raw='.$table_whole_branch_raw;
		if($legacy_db->table_exists($table_whole_branch_raw) == TRUE)
		{
			$Q_iss_2_whole_br_dlt = $legacy_db->query("DELETE FROM $table_whole_branch_raw where basedate='$table_name_whole_branch_status_iss_2_date'");

			$Q_iss_2_whole_br_crt =  $legacy_db->query("insert into $table_whole_branch_raw(basedate,total_raw_br)(
														select Distinct '$table_name_whole_branch_status_iss_2_date' as 'basedate', count(distinct(BRANCH_ID)) as 'total_raw_br'
														from $table_iss_data)");

		}
		else
		{
			$Q_iss_2_whole_br_insrt =  $legacy_db->query("select '$table_name_whole_branch_status_iss_2_date' as 'basedate', count(distinct(BRANCH_ID)) as 'total_raw_br'
														into $table_whole_branch_raw from $table_iss_data");
		}
/*--------------------------------insert sum of whole branch end---------------------------------*/

/*--------------------------------Sum Total branch final data start------------------------------*/
$table_iss_data_final='T_PS_M_FI_MONITOR_BR_FINAL_'.$mon.$yr;
$table_sum_final_data='sum_iss_2_final_'.$yr;
//echo '</br>'.'table_sum_final_data='.$table_sum_final_data;
//echo '</br>'.'table_iss_data_final='.$table_iss_data_final;
$legacy_db = $this->load->database('dbcomm', true);
if($legacy_db->table_exists($table_sum_final_data) == TRUE)
{
	$Q_iss_2_final_data_dlt = $legacy_db->query("DELETE FROM $table_sum_final_data where report_date='$table_name_whole_branch_status_iss_2_date'");


	$Q_iss_2_final_data_insrt =  $legacy_db->query("insert into $table_sum_final_data (report_date,SUPERVISION_COA_ID,COA_DESCRIPTION,AMOUNT_BDT)
												(
												select '$table_name_whole_branch_status_iss_2_date', y.SUPERVISION_COA_ID,x.COA_DESCRIPTION,y.AMOUNT_BDT from   $table_name_new_old_template x left join
												( (SELECT
												[SUPERVISION_COA_ID],
												sum(case when isnumeric([AMOUNT_BDT])=1  then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
												FROM $table_iss_data_final
												where  [SUPERVISION_COA_ID] not in('1010310','1011665')
												group by [SUPERVISION_COA_ID])
												union
												(SELECT
												[SUPERVISION_COA_ID],
												min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
												FROM $table_iss_data_final
												where [SUPERVISION_COA_ID] ='1010310'
												group by [SUPERVISION_COA_ID])union
												(SELECT
												[SUPERVISION_COA_ID],
												max(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
												FROM $table_iss_data_final
												where [SUPERVISION_COA_ID] ='1011665'
												group by [SUPERVISION_COA_ID])
												)
												y
												on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID)
												");
}
else
{


	$Q_iss_2_final_data_crt =  $legacy_db->query("select '$table_name_whole_branch_status_iss_2_date' as 'report_date', y.SUPERVISION_COA_ID, x.COA_DESCRIPTION, y.AMOUNT_BDT into $table_sum_final_data from   $table_name_new_old_template x left join
											( (SELECT
											[SUPERVISION_COA_ID],
											sum(case when isnumeric([AMOUNT_BDT])=1  then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $table_iss_data_final
											where  [SUPERVISION_COA_ID] not in('1010310','1011665')
											group by [SUPERVISION_COA_ID])
											union
											(SELECT
											[SUPERVISION_COA_ID],
											min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $table_iss_data_final
											where [SUPERVISION_COA_ID] ='1010310'
											group by [SUPERVISION_COA_ID]) union
											(SELECT
											[SUPERVISION_COA_ID],
											max(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $table_iss_data_final
											where [SUPERVISION_COA_ID] ='1011665'
											group by [SUPERVISION_COA_ID])
											)
											y
											on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID
											order by x.SL");
}

	//die('raw data');
/*---------------------------------------Sum Total branch final data end------------------------------*/
/*--------------------------------------Insert sum final of whole branch start---------------------------*/
		$table_whole_branch_final='TOTAL_BRANCH_Final_'.$yr;
		//echo '</br>'.'table_whole_branch_final='.$table_whole_branch_final;
		if($legacy_db->table_exists($table_whole_branch_final) == TRUE)
		{
			$Q_iss_2_whole_br_dlt = $legacy_db->query("DELETE FROM $table_whole_branch_final where basedate='$table_name_whole_branch_status_iss_2_date'");

			$Q_iss_2_whole_br_crt =  $legacy_db->query("insert into $table_whole_branch_final(basedate,total_final_br)(
															select Distinct '$table_name_whole_branch_status_iss_2_date' as 'basedate', count(distinct(BRANCH_ID)) as 'total_final_br'
															from $table_iss_data_final)");

		}
		else
		{
			$Q_iss_2_whole_br_insrt =  $legacy_db->query("select '$table_name_whole_branch_status_iss_2_date' as 'basedate', count(distinct(BRANCH_ID)) as 'total_final_br'
															into $table_whole_branch_final from $table_iss_data_final");
		}
/*--------------------------------------Insert sum final of whole branch end---------------------------*/

/*--------------------------------------Insert sum Certificate of whole branch start---------------------------*/
		$table_whole_branch_certificate='TOTAL_BRANCH_Ceritficate_'.$yr;
		//echo '</br>'.'table_whole_branch_certificate='.$table_whole_branch_certificate;
		$table_whole_certificate_branch='certificate_'.$mon."_".$yr;
		//echo '</br>'.'table_whole_certificate_branch='.$table_whole_certificate_branch;
		if($legacy_db->table_exists($table_whole_branch_certificate) == TRUE)
		{
			$Q_iss_2_whole_br_dlt = $legacy_db->query("DELETE FROM $table_whole_branch_certificate where basedate='$table_name_whole_branch_status_iss_2_date'");

			$Q_iss_2_whole_br_crt =  $legacy_db->query("insert into $table_whole_branch_certificate(basedate,total_cer_br)(
														select Distinct '$table_name_whole_branch_status_iss_2_date' as 'basedate', count(certified_br_ar_div_code) as total_cer_br
														from $table_whole_certificate_branch where LEN(certified_br_ar_div_code)=6)");
		}
		else
		{
			$Q_iss_2_whole_br_insrt =  $legacy_db->query("select '$table_name_whole_branch_status_iss_2_date' as 'basedate', count(certified_br_ar_div_code) as 'total_cer_br'
															into $table_whole_branch_certificate from $table_whole_certificate_branch where LEN(certified_br_ar_div_code)=6");
		}
/*--------------------------------------Insert sum Certificate of whole branch end---------------------------*/

		return true;

    }
/*------------------------ISS Form-2 query end here----------------------------------------*/
/*-------------------------ISS Form-2 comparision start------------------------------------*/
	function fetch_iss_2_comp_data($branch_id_array_for_report=array(),$report_of_date1='',$report_of_date2='')
    {
		$table_name_new_old_template = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		//if($ch_year1==$ch_year2)
		{
			if($ch_year1<=2015 && $ch_year2<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year1 >=2016 || $ch_year2 >=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
		}

		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1=$this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2=$this->get_iss_data_tbl_name($report_of_date2);
		
		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
	$iss_2_comp =  $legacy_db->query("BEGIN TRANSACTION SET NUMERIC_ROUNDABORT OFF select b.sl,b.COA_ID_VALUE, b.COA_DESCRIPTION,b.[SUPERVISION_COA_ID],
									sum(convert(money,b.AMOUNT_BDT)) as 'next_date',
									sum(convert(money,b.AMOUNT_BDT2)) as 'pre_date',
									sum(convert(money, b.AMOUNT_BDT2))-sum(convert(money, b.AMOUNT_BDT)) as Diff,
									(case when  sum(convert(money, b.AMOUNT_BDT))=0 and sum(convert(money, b.AMOUNT_BDT2))=0 then 0
									when sum(convert(money, b.AMOUNT_BDT))=0  then 100
									else
									(sum(convert(money, b.AMOUNT_BDT2))-sum(convert(money, b.AMOUNT_BDT)))*100 /sum(convert(money, b.AMOUNT_BDT))
									end) as 'diff_per'
									from Db_DP_Collection_mgr..allinformation a inner join
									(
									select m.SL,m.COA_ID_VALUE, x.BRANCH_ID, x.[SUPERVISION_COA_ID] ,
									x.COA_DESCRIPTION ,x.AMOUNT_BDT as AMOUNT_BDT,y.AMOUNT_BDT as AMOUNT_BDT2
									from [db_mis_ISS].[dbo].[$table_name_new_old_template] m left join [db_mis_ISS].[dbo].[$tbl_name1] x on
									m.SUPERVISION_COA_ID =x.SUPERVISION_COA_ID left join [db_mis_ISS].[dbo].[$tbl_name2] y
									on x.BRANCH_ID = y.BRANCH_ID and m.SUPERVISION_COA_ID =y.SUPERVISION_COA_ID ) b on '12'+bbbrcode=branch_id
									where BRANCH_ID in $IN_con
									group by  b.sl,b.COA_ID_VALUE, b.COA_DESCRIPTION,b.[SUPERVISION_COA_ID]
									order by b.sl");
									
			return $iss_2_comp->result();

		}
	}

	/**
	 * Customized report start
	 * */
	function fetch_iss_2_cust_comp_data($branch_id_array_for_report=array(),$report_of_date1='',$report_of_date2='')
    {
		$table_name_new_old_template = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		//if($ch_year1==$ch_year2)
		{
			if($ch_year1<=2015 && $ch_year2<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
			}
			else
			{
				if($ch_year1 >=2016 || $ch_year2 >=2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
				}
			}
		}

		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1=$this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2=$this->get_iss_data_tbl_name($report_of_date2);
		
		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
	$iss_2_comp =  $legacy_db->query("BEGIN TRANSACTION SET NUMERIC_ROUNDABORT OFF select b.sl,b.COA_ID_VALUE, b.COA_DESCRIPTION,b.[SUPERVISION_COA_ID], b.cust_coa_desc,
									sum(convert(money,b.AMOUNT_BDT)) as 'next_date',
									sum(convert(money,b.AMOUNT_BDT2)) as 'pre_date',
									sum(convert(money, b.AMOUNT_BDT2))-sum(convert(money, b.AMOUNT_BDT)) as Diff,
									(case when  sum(convert(money, b.AMOUNT_BDT))=0 and sum(convert(money, b.AMOUNT_BDT2))=0 then 0
									when sum(convert(money, b.AMOUNT_BDT))=0  then 100
									else
									(sum(convert(money, b.AMOUNT_BDT2))-sum(convert(money, b.AMOUNT_BDT)))*100 /sum(convert(money, b.AMOUNT_BDT))
									end) as 'diff_per'
									from Db_DP_Collection_mgr..allinformation a inner join
									(
									select m.SL,m.COA_ID_VALUE, x.BRANCH_ID, x.[SUPERVISION_COA_ID] ,
									x.COA_DESCRIPTION ,x.AMOUNT_BDT as AMOUNT_BDT,y.AMOUNT_BDT as AMOUNT_BDT2, m.cust_coa_desc, m.cust_coa_desc_show
									from [db_mis_ISS].[dbo].[$table_name_new_old_template] m left join [db_mis_ISS].[dbo].[$tbl_name1] x on
									m.SUPERVISION_COA_ID =x.SUPERVISION_COA_ID left join [db_mis_ISS].[dbo].[$tbl_name2] y
									on x.BRANCH_ID = y.BRANCH_ID and m.SUPERVISION_COA_ID =y.SUPERVISION_COA_ID ) b on '12'+bbbrcode=branch_id and b.cust_coa_desc_show =1
									where BRANCH_ID in $IN_con
									group by  b.sl,b.COA_ID_VALUE, b.COA_DESCRIPTION,b.[SUPERVISION_COA_ID], b.cust_coa_desc
									order by b.sl");								
									
			return $iss_2_comp->result();

		}
	}

	function fetch_iss_2_cust_whole_br_comp_data($report_of_date1='',$report_of_date2='')
	{

		$table_name_new_old_template = '';
		$tbl_name = '';
		$tbl_name1 = '';
		$tbl_name2 = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1 == $ch_year2)
		{

			if($ch_year1==$ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='sum_iss_2_raw_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name='sum_iss_2_raw_'.$ch_year1;
					}
				}
			}

			$legacy_db = $this->load->database('dbcomm', true);
			if( $legacy_db->table_exists($tbl_name) == FALSE)
			{
				return 0;
			}
			else
			{
		$iss_2_whole_comp =  $legacy_db->query("select x.sl, x.COA_ID_VALUE,  x.cust_coa_desc, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, x.AMOUNT_BDT1,y.AMOUNT_BDT2, 
(y.AMOUNT_BDT2-x.AMOUNT_BDT1) as 'Diff', (case when convert(money, x.AMOUNT_BDT1)=0 then 0 
when convert(money, y.AMOUNT_BDT2)=0 then 100 
else ((convert(money, y.AMOUNT_BDT2)-convert(money, x.AMOUNT_BDT1))*100/convert(money, y.AMOUNT_BDT2)) end) as 'diff_per' 
from (select b.sl, b.COA_ID_VALUE, b.cust_coa_desc, b.cust_coa_desc_show, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT as AMOUNT_BDT1 
from [dbo].[$tbl_name] a, $table_name_new_old_template b where a.report_date='$report_of_date1' 
AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) x, (select b.sl, b.COA_ID_VALUE, a.SUPERVISION_COA_ID, 
a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2 from [dbo].[$tbl_name] a, $table_name_new_old_template b 
where a.report_date='$report_of_date2' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID AND b.cust_coa_desc_show=1) y 
where x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID order by x.sl");

echo "select x.sl, x.COA_ID_VALUE,  x.cust_coa_desc, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, x.AMOUNT_BDT1,y.AMOUNT_BDT2, 
(y.AMOUNT_BDT2-x.AMOUNT_BDT1) as 'Diff', (case when convert(money, x.AMOUNT_BDT1)=0 then 0 
when convert(money, y.AMOUNT_BDT2)=0 then 100 
else ((convert(money, y.AMOUNT_BDT2)-convert(money, x.AMOUNT_BDT1))*100/convert(money, y.AMOUNT_BDT2)) end) as 'diff_per' 
from (select b.sl, b.COA_ID_VALUE, b.cust_coa_desc, b.cust_coa_desc_show, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT as AMOUNT_BDT1 
from [dbo].[$tbl_name] a, $table_name_new_old_template b where a.report_date='$report_of_date1' 
AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) x, (select b.sl, b.COA_ID_VALUE, a.SUPERVISION_COA_ID, 
a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2 from [dbo].[$tbl_name] a, $table_name_new_old_template b 
where a.report_date='$report_of_date2' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID AND b.cust_coa_desc_show=1) y 
where x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID order by x.sl";
die();


				return $iss_2_whole_comp->result();
			}

		}
		else
		{
			if($ch_year1 != $ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='sum_iss_2_raw_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016 || $ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name1 = 'sum_iss_2_raw_'.$ch_year1;
						$tbl_name2 = 'sum_iss_2_raw_'.$ch_year2;
					}
				}


				$legacy_db = $this->load->database('dbcomm', true);
				if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
				{
					return 0;
				}
				else
				{
					$iss_2_whole_comp =  $legacy_db->query("select x.sl, x.COA_ID_VALUE,  x.cust_coa_desc, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, x.AMOUNT_BDT1,y.AMOUNT_BDT2,
					(y.AMOUNT_BDT2-x.AMOUNT_BDT1) as 'Diff',
					(case
					when convert(money, x.AMOUNT_BDT1)=0 then 0
					when convert(money, y.AMOUNT_BDT2)=0 then 100
					else ((convert(money, y.AMOUNT_BDT2)-convert(money, x.AMOUNT_BDT1))*100/convert(money, y.AMOUNT_BDT2)) end) as 'diff_per'
					from
					(select b.sl,
					b.COA_ID_VALUE, b.cust_coa_desc, b.cust_coa_desc_show, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT
					as AMOUNT_BDT1 from [dbo].[$tbl_name1] a, $table_name_new_old_template b where a.report_date='$report_of_date1'
					AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) x,
					(select b.sl,
					b.COA_ID_VALUE, a.SUPERVISION_COA_ID,
					a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2 from [dbo].[$tbl_name2] a, $table_name_new_old_template b
					where a.report_date='$report_of_date2' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID  AND b.cust_coa_desc_show=1) y
					where x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID order by x.sl");	

					return $iss_2_whole_comp->result();
				}
			}
		}
	}
	/**
	 * Customized report end 
	 * */
	/*26/10/2016 add start*/
	function fetch_iss_2_comp_no_cash_execd_data($branch_id_array_for_report=array(),$report_of_date1='',$report_of_date2='')
    {

		$table_name_new_old_template = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1==$ch_year2)
		{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
					}
			}
		}
		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1=$this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2=$this->get_iss_data_tbl_name($report_of_date2);

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}

		$iss_2_comp =  $legacy_db->query("BEGIN TRANSACTION SET NUMERIC_ROUNDABORT OFF select b.sl,b.COA_ID_VALUE, b.COA_DESCRIPTION,b.[SUPERVISION_COA_ID],
						max(case when isnumeric(b.AMOUNT_BDT)=1 then convert(money, b.AMOUNT_BDT) else 0 end) as 'next_date_noexcee',
						max(case when isnumeric(b.AMOUNT_BDT2)=1 then convert(money, b.AMOUNT_BDT2) else 0 end) as 'pre_date_noexcee'
						from Db_DP_Collection_mgr..allinformation a
						inner join ( select m.SL,m.COA_ID_VALUE, x.BRANCH_ID, x.[SUPERVISION_COA_ID] , x.COA_DESCRIPTION ,x.AMOUNT_BDT as
						AMOUNT_BDT,y.AMOUNT_BDT as AMOUNT_BDT2 from [db_mis_ISS].[dbo].[$table_name_new_old_template] m left join
						[db_mis_ISS].[dbo].[$tbl_name1] x on m.SUPERVISION_COA_ID =x.SUPERVISION_COA_ID left join
						[db_mis_ISS].[dbo].[$tbl_name2] y on x.BRANCH_ID = y.BRANCH_ID and m.SUPERVISION_COA_ID
						=y.SUPERVISION_COA_ID ) b on '12'+bbbrcode=branch_id where SUPERVISION_COA_ID='1011665' AND BRANCH_ID in $IN_con group by b.sl,b.COA_ID_VALUE,
						b.COA_DESCRIPTION,b.[SUPERVISION_COA_ID] order by b.sl");

				return $iss_2_comp->result();

		}
	}
	/*26/10/2016 add end*/
	function fetch_iss_2_whole_br_comp_data($report_of_date1='',$report_of_date2='')
	{

		$table_name_new_old_template = '';
		$tbl_name = '';
		$tbl_name1 = '';
		$tbl_name2 = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1 == $ch_year2)
		{

			if($ch_year1==$ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='sum_iss_2_raw_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name='sum_iss_2_raw_'.$ch_year1;
					}
				}
			}

			$legacy_db = $this->load->database('dbcomm', true);
			if( $legacy_db->table_exists($tbl_name) == FALSE)
			{
				return 0;
			}
			else
			{
				$iss_2_whole_comp =  $legacy_db->query("select x.sl, x.COA_ID_VALUE, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, x.AMOUNT_BDT1,y.AMOUNT_BDT2,
				(y.AMOUNT_BDT2-x.AMOUNT_BDT1) as 'Diff',
				(case
				when convert(money, x.AMOUNT_BDT1)=0 then 0
				when convert(money, y.AMOUNT_BDT2)=0 then 100
				else ((convert(money, y.AMOUNT_BDT2)-convert(money, x.AMOUNT_BDT1))*100/convert(money, y.AMOUNT_BDT2)) end) as 'diff_per'
				from
				(select b.sl,
				b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT
				as AMOUNT_BDT1 from [dbo].[$tbl_name] a, $table_name_new_old_template b where a.report_date='$report_of_date1'
				AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) x,
				(select b.sl,
				b.COA_ID_VALUE, a.SUPERVISION_COA_ID,
				a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2 from [dbo].[$tbl_name] a, $table_name_new_old_template b
				where a.report_date='$report_of_date2' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) y
				where x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID order by x.sl");

				
				return $iss_2_whole_comp->result();
			}

		}
		else
		{
			if($ch_year1 != $ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='sum_iss_2_raw_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name1 = 'sum_iss_2_raw_'.$ch_year1;
						$tbl_name2 = 'sum_iss_2_raw_'.$ch_year2;
					}
				}


				$legacy_db = $this->load->database('dbcomm', true);
				if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
				{
					return 0;
				}
				else
				{
					$iss_2_whole_comp =  $legacy_db->query("select x.sl, x.COA_ID_VALUE, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, x.AMOUNT_BDT1,y.AMOUNT_BDT2,
					(y.AMOUNT_BDT2-x.AMOUNT_BDT1) as 'Diff',
					(case
					when convert(money, x.AMOUNT_BDT1)=0 then 0
					when convert(money, y.AMOUNT_BDT2)=0 then 100
					else ((convert(money, y.AMOUNT_BDT2)-convert(money, x.AMOUNT_BDT1))*100/convert(money, y.AMOUNT_BDT2)) end) as 'diff_per'
					from
					(select b.sl,
					b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT
					as AMOUNT_BDT1 from [dbo].[$tbl_name1] a, $table_name_new_old_template b where a.report_date='$report_of_date1'
					AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) x,
					(select b.sl,
					b.COA_ID_VALUE, a.SUPERVISION_COA_ID,
					a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2 from [dbo].[$tbl_name2] a, $table_name_new_old_template b
					where a.report_date='$report_of_date2' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) y
					where x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID order by x.sl");

					return $iss_2_whole_comp->result();
				}
			}
		}
	}
	
	function fetch_iss_2_whole_br_list_raw($report_of_date1='',$report_of_date2='')
	{
		$table_name_new_old_template = '';
		$tbl_name='';
		$tbl_name1 = '';
		$tbl_name2 = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));

		if($ch_year1==$ch_year2)
		{
			if($ch_year1<=2015 && $ch_year2<=2015)
			{
				$table_name_new_old_template = 'ISS2_Serial';
				$tbl_name='TOTAL_BRANCH_RAW_'.$ch_year1;
			}
			else
			{
				if($ch_year1 >= 2016 || $ch_year2 >= 2016)
				{
					$table_name_new_old_template = 'ISS2_Serial_2016';
					$tbl_name='TOTAL_BRANCH_RAW_'.$ch_year1;
				}
			}
			$tbl_name1 = $tbl_name;
			$tbl_name2 =  $tbl_name;
			$legacy_db = $this->load->database('dbcomm', true);
			if( $legacy_db->table_exists($tbl_name) == FALSE)
			{
				return false;
			}
			else
			{
				$iss_2_whole_comp =  $legacy_db->query("select x.first_br, y.second_br  from (select total_raw_br as 'first_br' from $tbl_name1 a
														where basedate='$report_of_date1') x, (select total_raw_br as 'second_br' from $tbl_name2
														where basedate='$report_of_date2') y");

				return $iss_2_whole_comp->result();
			}
		}
		else
		{
			if($ch_year1 != $ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='TOTAL_BRANCH_RAW_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name1='TOTAL_BRANCH_RAW_'.$ch_year1;
						$tbl_name2='TOTAL_BRANCH_RAW_'.$ch_year2;
					}
				}
				$legacy_db = $this->load->database('dbcomm', true);
				if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
				{
					return false;
				}
				else
				{
					$iss_2_whole_comp =  $legacy_db->query("select x.first_br, y.second_br  from (select total_raw_br as 'first_br' from $tbl_name1 a
															where basedate='$report_of_date1') x, (select total_raw_br as 'second_br' from $tbl_name2
															where basedate='$report_of_date2') y");

					return $iss_2_whole_comp->result();
				}
			}
		}
    }
	function fetch_iss_whole_br_list()
    {
		$legacy_db = $this->load->database('dbcomm', true);
		$Q =  $legacy_db->query("select * from allinformation where brcode not in (9999,0931,0932,0933,0934)");

		return $Q->result();
    }
/*-------------------------ISS Form-2 comparision end------------------------------------*/
/*-------------------------ISS Form-1 item wise start------------------------------------*/
function iss_form_1_get_item_date()
{
	$legacy_db = $this->load->database('dbcomm', true);
	$query =  $legacy_db->query("SELECT * FROM ISS1_Serial_2016");
	return $query->result();
}
/*-------------------------ISS Form-1 item wise start------------------------------------*/
/*-------------------------ISS Form-2 item wise start------------------------------------*/
function iss_foem2_get_item_date()
{
	$legacy_db = $this->load->database('dbcomm', true);
	$query =  $legacy_db->query("SELECT * FROM ISS2_Serial_2016 order by SL");
	return $query->result();
}


function fetch_iss_2_item_wise_data($branch_id_array_for_report=array(),$report_of_date1='',$report_of_date2='', $iss_form_2_item=0)
{
		$table_name_new_old_template = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1==$ch_year2)
		{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
					}
			}
		}
		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1=$this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2=$this->get_iss_data_tbl_name($report_of_date2);

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
	$iss_2_comp =  $legacy_db->query("select b.SL,b.COA_ID_VALUE,b.SUPERVISION_COA_ID,a.dvname, a.znname, a.branchname,a.OfficePhone,b.BRANCH_ID,b.COA_DESCRIPTION, b.[2016 2nd] as 'pre_date', b.[2016 1st]
			as 'next_date', b.Diff,b.[diff_per] as 'diff_per' from db_mis_ISS..allinformation a inner join
			(select z.SL,z.COA_ID_VALUE,x.BRANCH_ID, x.[SUPERVISION_COA_ID] ,x.COA_DESCRIPTION ,x.AMOUNT_BDT as [2016 1st], y.AMOUNT_BDT
			as [2016 2nd], convert(money, isnull(y.AMOUNT_BDT,0))-convert(money, isnull(x.AMOUNT_BDT,0)) as Diff,
			(case when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0))=0 then 0
				  when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0)) > 0 then 100
				  when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0))< 0 then -100
			else
				  cast(((convert(numeric, isnull(y.AMOUNT_BDT,0))-convert(numeric, isnull(x.AMOUNT_BDT,0))) /convert(numeric, isnull(x.AMOUNT_BDT,0))*100) as DECIMAL(18,4))
			 end) as [diff_per] FROM $tbl_name1 x left join $tbl_name2 y
			on x.BRANCH_ID = y.BRANCH_ID and x.SUPERVISION_COA_ID =y.SUPERVISION_COA_ID left join $table_name_new_old_template z
			on z.SUPERVISION_COA_ID = x.SUPERVISION_COA_ID ) b on '12'+bbbrcode=branch_id and [SUPERVISION_COA_ID] = $iss_form_2_item and branch_id in
			$IN_con");

			return $iss_2_comp->result();

		}
}
	function fetch_iss_2_whole_br_item_data($report_of_date1 = '',$report_of_date2 = '',$iss_form_2_item = 0)
	{
		//$table_name_new_old_template = '';
		//$tbl_name='';
		//$ch_year1 = date('Y', strtotime($report_of_date1));
		//$ch_year2 = date('Y', strtotime($report_of_date2));
		$table_name_new_old_template = '';
		$tbl_name = '';
		$tbl_name1 = '';
		$tbl_name2 = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1==$ch_year2)
		{
			if($ch_year1==$ch_year2)
			{
					if($ch_year1<=2015 && $ch_year2<=2015)
					{
						$table_name_new_old_template = 'ISS2_Serial';
						$tbl_name='sum_iss_2_raw_'.$ch_year1;
					}
					else
					{
						if($ch_year1>=2016||$ch_year2>=2016)
						{
							$table_name_new_old_template = 'ISS2_Serial_2016';
							$tbl_name='sum_iss_2_raw_'.$ch_year1;
						}
				}
			}
			$legacy_db = $this->load->database('dbcomm', true);
			if( $legacy_db->table_exists($tbl_name) == FALSE)
			{
				return 0;
			}
			else
			{
				//SET NUMERIC_ROUNDABORT OFF
				$iss_2_whole_comp =  $legacy_db->query("select x.sl,x.COA_ID_VALUE,x.SUPERVISION_COA_ID,x.COA_DESCRIPTION,y.AMOUNT_BDT2,x.AMOUNT_BDT1, (y.AMOUNT_BDT2-x.AMOUNT_BDT1) as Diff,
				case when  x.AMOUNT_BDT1=0 and  y.AMOUNT_BDT2=0 then 0
					 when  x.AMOUNT_BDT1=0 and  y.AMOUNT_BDT2>0 then 100
					 when  x.AMOUNT_BDT1=0 and  y.AMOUNT_BDT2<0 then -100
				else
				cast((((y.AMOUNT_BDT2-x.AMOUNT_BDT1)/x.AMOUNT_BDT1)*100)  as DECIMAL(18,4))end
				as 'diff_per' from (select b.sl,b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT as AMOUNT_BDT1
				from [dbo].[$tbl_name] a, $table_name_new_old_template b where a.report_date='$report_of_date1' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID and
				b.SUPERVISION_COA_ID=$iss_form_2_item) x, (select b.sl, b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2
				from [dbo].[$tbl_name] a, $table_name_new_old_template b where a.report_date='$report_of_date2 ' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID
				and b.SUPERVISION_COA_ID = $iss_form_2_item) y");

				return $iss_2_whole_comp->result();
			}
		}
		else
		{
			if($ch_year1 != $ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='sum_iss_2_raw_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name1 = 'sum_iss_2_raw_'.$ch_year1;
						$tbl_name2 = 'sum_iss_2_raw_'.$ch_year2;
					}
					$legacy_db = $this->load->database('dbcomm', true);
					if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
					{
						return 0;
					}
					else
					{
						//SET NUMERIC_ROUNDABORT OFF
						$iss_2_whole_comp =  $legacy_db->query("select x.sl,x.COA_ID_VALUE,x.SUPERVISION_COA_ID,x.COA_DESCRIPTION,y.AMOUNT_BDT2,x.AMOUNT_BDT1, (y.AMOUNT_BDT2-x.AMOUNT_BDT1) as Diff,
						case when  x.AMOUNT_BDT1=0 and  y.AMOUNT_BDT2=0 then 0
							 when  x.AMOUNT_BDT1=0 and  y.AMOUNT_BDT2>0 then 100
							 when  x.AMOUNT_BDT1=0 and  y.AMOUNT_BDT2<0 then -100
						else
						cast((((y.AMOUNT_BDT2-x.AMOUNT_BDT1)/x.AMOUNT_BDT1)*100)  as DECIMAL(18,4))end
						as 'diff_per' from (select b.sl,b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT as AMOUNT_BDT1
						from [dbo].[$tbl_name1] a, $table_name_new_old_template b where a.report_date='$report_of_date1' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID and
						b.SUPERVISION_COA_ID=$iss_form_2_item) x, (select b.sl, b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2
						from [dbo].[$tbl_name2] a, $table_name_new_old_template b where a.report_date='$report_of_date2 ' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID
						and b.SUPERVISION_COA_ID = $iss_form_2_item) y");

						return $iss_2_whole_comp->result();
					}
				}
			}
		}
    }
	/*function fetch_iss_2_whole_br_comp_data($report_of_date1='',$report_of_date2='')
	{

		$table_name_new_old_template = '';
		$tbl_name = '';
		$tbl_name1 = '';
		$tbl_name2 = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1 == $ch_year2)
		{

			if($ch_year1==$ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='sum_iss_2_raw_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name='sum_iss_2_raw_'.$ch_year1;
					}
				}
			}

			$legacy_db = $this->load->database('dbcomm', true);
			if( $legacy_db->table_exists($tbl_name) == FALSE)
			{
				return 0;
			}
			else
			{
				$iss_2_whole_comp =  $legacy_db->query("select x.sl, x.COA_ID_VALUE, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, x.AMOUNT_BDT1,y.AMOUNT_BDT2,
				(y.AMOUNT_BDT2-x.AMOUNT_BDT1) as 'Diff',
				(case
				when convert(money, x.AMOUNT_BDT1)=0 then 0
				when convert(money, y.AMOUNT_BDT2)=0 then 100
				else ((convert(money, y.AMOUNT_BDT2)-convert(money, x.AMOUNT_BDT1))*100/convert(money, y.AMOUNT_BDT2)) end) as 'diff_per'
				from
				(select b.sl,
				b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT
				as AMOUNT_BDT1 from [dbo].[$tbl_name] a, $table_name_new_old_template b where a.report_date='$report_of_date1'
				AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) x,
				(select b.sl,
				b.COA_ID_VALUE, a.SUPERVISION_COA_ID,
				a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2 from [dbo].[$tbl_name] a, $table_name_new_old_template b
				where a.report_date='$report_of_date2' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) y
				where x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID order by x.sl");
				return $iss_2_whole_comp->result();
			}

		}
		else
		{
			if($ch_year1 != $ch_year2)
			{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
					$tbl_name='sum_iss_2_raw_'.$ch_year1;
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
						$tbl_name1 = 'sum_iss_2_raw_'.$ch_year1;
						$tbl_name2 = 'sum_iss_2_raw_'.$ch_year2;
					}
				}


				$legacy_db = $this->load->database('dbcomm', true);
				if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
				{
					return 0;
				}
				else
				{
					$iss_2_whole_comp =  $legacy_db->query("select x.sl, x.COA_ID_VALUE, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, x.AMOUNT_BDT1,y.AMOUNT_BDT2,
					(y.AMOUNT_BDT2-x.AMOUNT_BDT1) as 'Diff',
					(case
					when convert(money, x.AMOUNT_BDT1)=0 then 0
					when convert(money, y.AMOUNT_BDT2)=0 then 100
					else ((convert(money, y.AMOUNT_BDT2)-convert(money, x.AMOUNT_BDT1))*100/convert(money, y.AMOUNT_BDT2)) end) as 'diff_per'
					from
					(select b.sl,
					b.COA_ID_VALUE, a.SUPERVISION_COA_ID,a.COA_DESCRIPTION,a.AMOUNT_BDT
					as AMOUNT_BDT1 from [dbo].[$tbl_name1] a, $table_name_new_old_template b where a.report_date='$report_of_date1'
					AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) x,
					(select b.sl,
					b.COA_ID_VALUE, a.SUPERVISION_COA_ID,
					a.COA_DESCRIPTION, a.AMOUNT_BDT as AMOUNT_BDT2 from [dbo].[$tbl_name2] a, $table_name_new_old_template b
					where a.report_date='$report_of_date2' AND a.SUPERVISION_COA_ID=b.SUPERVISION_COA_ID) y
					where x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID order by x.sl");

					return $iss_2_whole_comp->result();
				}
			}
		}
    }*/

/*-------------------------ISS Form-2 continous report start------------------------------------*/
function iss_continous_report_get_date()
{
	$legacy_db = $this->load->database('dbcomm', true);
	/*$query =  $legacy_db->query("select distinct(YEAR(ISSEntryDate)) as ISS_Year from ISSEntryDate order by ISS_Year desc");*/
	$query =  $legacy_db->query("select distinct(YEAR(convert(datetime, ISSEntryDate, 105))) as ISS_Year from ISSEntryDate order by ISS_Year desc");
	return $query->result();
}
function fetch_iss_2_continous_data($branch_id_array_for_report=array(),$report_of_year='')
{
		$table_name_new_old_template = '';

		if($report_of_year<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($report_of_year >= 2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}

		$legacy_db = $this->load->database('dbcomm', true);
		if($report_of_year !='')
		{
			$query_year =  $legacy_db->query("select ISSEntryDate from ISSEntryDate where YEAR(ISSEntryDate)='$report_of_year'");
		}

		$data_total_info = array();
		if($query_year->num_rows()>0)
        {
			$ci = 0;
			foreach($query_year->result_array() as $row)
			{
				$tbl_name='';
				$converted_date = date('Y-m-d', strtotime($row['ISSEntryDate']));
				$tbl_arr=explode('-',$converted_date);
				if(!empty($tbl_arr))
				{
					$tbl_name = '';
					$tbl_name = 'T_PS_M_FI_MONITOR_BR_'.$tbl_arr[1].$tbl_arr[0];
					$count_in_branch=count($branch_id_array_for_report);

					$legacy_db = $this->load->database('dbcomm', true);
					if( $legacy_db->table_exists($tbl_name) == TRUE)
					{
						$IN_con='';
		    			if($count_in_branch>0)
						{
							$IN_con="(";
							foreach($branch_id_array_for_report as $key=>$val)
							{
								$brcode = $val['bbbrcode'];
								$IN_con.="'".$brcode."'";
								if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
							}
							$IN_con .=")";
						}

						$iss_2_comp =  $legacy_db->query("select x.COA_ID_VALUE,x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, y.AMOUNT_BDT, y.report_date
											from   $table_name_new_old_template x left join
											(
											(SELECT
											[DATE] as 'report_date', [SUPERVISION_COA_ID],
											sum(case when isnumeric([AMOUNT_BDT])=1  then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where  [SUPERVISION_COA_ID] not in('1010310','1011665')  and BRANCH_ID in $IN_con
											group by [SUPERVISION_COA_ID], [DATE])
											union
											(SELECT
											[DATE] as 'report_date', [SUPERVISION_COA_ID],
											min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where [SUPERVISION_COA_ID] ='1010310'  and BRANCH_ID in $IN_con
											group by [SUPERVISION_COA_ID], [DATE])
											union
											(SELECT
											[DATE] as 'report_date', [SUPERVISION_COA_ID],
											max(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where [SUPERVISION_COA_ID] ='1011665'  and BRANCH_ID in $IN_con
											group by [SUPERVISION_COA_ID], [DATE])
											) y
											on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID
											order by x.SL");
						$data_total_info[$ci++] = $iss_2_comp->result();

					}
				}
			}
        }
	return 	$data_total_info;
}

function fetch_iss_2_whole_br_continous_data($report_of_year = '')
{
	$table_name_new_old_template = '';

	if($report_of_year<=2015)
	{
		$table_name_new_old_template = 'ISS2_Serial';
	}
	else
	{
		if($report_of_year >= 2016)
		{
			$table_name_new_old_template = 'ISS2_Serial_2016';
		}
	}

		$legacy_db = $this->load->database('dbcomm', true);
		if($report_of_year !='')
		{
			$query_year =  $legacy_db->query("select ISSEntryDate from ISSEntryDate where YEAR(ISSEntryDate)='$report_of_year'");
		}

		$data_total_info = array();
		if($query_year->num_rows()>0)
        {
			$ci = 0;
			foreach($query_year->result_array() as $row)
			{
				$tmp_date = $row['ISSEntryDate'];
				$tbl_name='';
				$converted_date = date('Y-m-d', strtotime($row['ISSEntryDate']));
				$tbl_arr=explode('-',$converted_date);
				if(!empty($tbl_arr))
				{
					$tbl_name = '';
					$tbl_name = 'sum_iss_2_raw_'.$tbl_arr[0];

					$legacy_db = $this->load->database('dbcomm', true);
					if( $legacy_db->table_exists($tbl_name) == TRUE)
					{
						$iss_2_comp =  $legacy_db->query("select x.COA_ID_VALUE,x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, y.AMOUNT_BDT, y.report_date
											from   $table_name_new_old_template x left join
											(
											(SELECT
											report_date, [SUPERVISION_COA_ID],
											sum(case when isnumeric([AMOUNT_BDT])=1  then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where  [SUPERVISION_COA_ID] not in('1010310','1011665') and report_date='$tmp_date'
											group by [SUPERVISION_COA_ID], report_date)
											union
											(SELECT
											report_date, [SUPERVISION_COA_ID],
											min(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where [SUPERVISION_COA_ID] ='1010310'  and report_date='$tmp_date'
											group by [SUPERVISION_COA_ID], report_date)
											union
											(SELECT
											report_date, [SUPERVISION_COA_ID],
											max(case when isnumeric([AMOUNT_BDT])=1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where [SUPERVISION_COA_ID] ='1011665' and report_date='$tmp_date'
											group by [SUPERVISION_COA_ID], report_date)
											) y
											on x.SUPERVISION_COA_ID=y.SUPERVISION_COA_ID
											order by x.SL");
						$data_total_info[$ci++] = $iss_2_comp->result();

					}
				}
			}
        }
	return 	$data_total_info;
}
/*
function fetch_iss_2_continous_data($branch_id_array_for_report=array(),$report_of_year='')
{
		$table_name_new_old_template = '';

		if($report_of_year<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($report_of_year >= 2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}

		$legacy_db = $this->load->database('dbcomm', true);
		if($report_of_year !='')
		{
			$query_year =  $legacy_db->query("select ISSEntryDate from ISSEntryDate where YEAR(ISSEntryDate)='$report_of_year'");
		}

		if($query_year->num_rows()>0)
        {
          foreach($query_year->result_array() as $row)
          {
			$tbl_name='';
			$converted_date = date('Y-m-d', strtotime($row['ISSEntryDate']));
			$tbl_arr=explode('-',$converted_date);
			if(!empty($tbl_arr))
			{
				$tbl_name = '';
				$tbl_name = 'T_PS_M_FI_MONITOR_BR_'.$tbl_arr[1].$tbl_arr[0];
			}
			echo $tbl_name."=="."</br>";
          }
        }

		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1=$this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2=$this->get_iss_data_tbl_name($report_of_date2);

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
		$iss_2_comp =  $legacy_db->query("select b.SL,b.COA_ID_VALUE,b.SUPERVISION_COA_ID,a.dvname, a.znname, a.branchname,a.OfficePhone,b.BRANCH_ID,b.COA_DESCRIPTION, b.[2016 2nd] as 'pre_date', b.[2016 1st]
			as 'next_date', b.Diff,b.[diff_per] as 'diff_per' from db_mis_ISS..allinformation a inner join
			(select z.SL,z.COA_ID_VALUE,x.BRANCH_ID, x.[SUPERVISION_COA_ID] ,x.COA_DESCRIPTION ,x.AMOUNT_BDT as [2016 1st], y.AMOUNT_BDT
			as [2016 2nd], convert(money, isnull(y.AMOUNT_BDT,0))-convert(money, isnull(x.AMOUNT_BDT,0)) as Diff,
			(case when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0))=0 then 0
				  when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0)) > 0 then 100
				  when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0))< 0 then -100
			else
				  cast(((convert(numeric, isnull(y.AMOUNT_BDT,0))-convert(numeric, isnull(x.AMOUNT_BDT,0))) /convert(numeric, isnull(x.AMOUNT_BDT,0))*100) as DECIMAL(18,4))
			 end) as [diff_per] FROM $tbl_name1 x left join $tbl_name2 y
			on x.BRANCH_ID = y.BRANCH_ID and x.SUPERVISION_COA_ID =y.SUPERVISION_COA_ID left join $table_name_new_old_template z
			on z.SUPERVISION_COA_ID = x.SUPERVISION_COA_ID ) b on '12'+bbbrcode=branch_id and [SUPERVISION_COA_ID] = $iss_form_2_item and branch_id in
			$IN_con");

				return $iss_2_comp->result();

		}
}
*/

/*-------------------------ISS Form-2 continous report end------------------------------------*/

/*-------------------------ISS Form-2 continous report end------------------------------------*/
/*-------------------------ISS Form-2 comparision end-------------------------------------------*/
##################################################################################################
/*BB letter start*/

/*************Basic Function Start*************/
    public function general_insert($tbl_name='',$data=array())
    {

	   $return=0;
        if($tbl_name!='')
        {
           if(!empty($data))
           {
            $count=1;
            $key_index='';
            $key_val='';
            foreach($data as $key=>$row)
            {
              $n='';
              $key_exp=explode('_',$key);
			  if(isset($key_exp[1]) && $key_exp[1]=='mban')
              {
                $n='N';
              }
              $key_index .=$key;
              $key_val .="$n'$row'";
              if($count<count($data))
              {
                $key_index .=',';
                $key_val .=',';
              }
              $count++;

            }
	        if($key_index !='' && $key_val !='')
            {
				$legacy_db = $this->load->database('dbcomm', true);
			    $query="INSERT INTO $tbl_name ($key_index) VALUES($key_val)";
                $return=$legacy_db->query($query);
            }
           }
        }
        return $return;
    }


function bb_iss_letter_save()
{
	$data = array(
		'dbbrcodejb' => $this->input->post('iss_report_office_id'),
		'iss2item' => $this->input->post('report_of_iss2_item'),
		'dbbrletterdateans' => $this->input->post('br_letter_date'),
		'dbbrletterstatusans_mban' => $this->input->post('brletterstatus_bangla')
	);
	$legacy_db = $this->load->database('dbcomm', true);
	if($this->general_insert('tbl_bb_letter_info',$data))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function iss_letter_info_details($letter_info='')
{
	$legacy_db = $this->load->database('dbcomm', true);
	$query =  $legacy_db->query("SELECT db_sl, dbbrcodejb as 'brcode', b.COA_DESCRIPTION as iss2item,
						dbbrletterdateans as db_br_letter_date_ans,
						CONVERT(VARCHAR(MAX),CONVERT(VARBINARY(MAX),dbbrletterstatusans_mban)) AS 'br_letter_summary'
						FROM dbo.tbl_bb_letter_info a, ISS2_Serial_2016 b
						where dbbrcodejb = '$letter_info' and a.iss2item = b.SUPERVISION_COA_ID");
	return $query->result();
}

function branch_details_info($br_code = '')
{

	$legacy_db = $this->load->database('dbcomm', true);
	$query =  $legacy_db->query("SELECT * FROM dbo.allinformation where brcode= '$br_code'");
	return $query->result();
}

function br_letter_del_info($id_param = '')
{
	$legacy_db = $this->load->database('dbcomm', true);
	if($legacy_db->query("delete from tbl_bb_letter_info where db_sl = $id_param"))
	{
		return true;
	}
	else
	{
		return false;
	}
}
/*
Db create
db_sl int
dbbrcodejb varchar(50)
iss2item varchar(50)
dbbrletterdateans smalldatetime
dbbrletterstatusans_mban nvarchar(MAX)

table name
tbl_bb_letter_info
*/
/*Br letter end*/
/*-------------------------ISS Form-2 continous report end------------------------------------*/

/*--------------------------ISS Form-1 start -------------------------------------*/
	function iss1_data_dept_cer($OFF_ID,$DATE)
	{
        //data table extract from date
        $tbl_name = $this->get_iss1_dept_cer_data_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);

        $query =  $legacy_db->query("SELECT * FROM $tbl_name where ho_dept_code = $OFF_ID AND ho_dept_cer_rep_date = '$DATE' ORDER BY sl");
		return $query->result();
	}
	function exist_iss1_dept_cer($OFF_ID,$DATE)
	{
        //data table extract from date
        $tbl_name = $this->get_iss1_dept_cer_data_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);

        $query =  $legacy_db->query("SELECT * FROM $tbl_name where ho_dept_code = $OFF_ID AND ho_dept_cer_rep_date = '$DATE' ORDER BY sl");
         //return $query->result();
		 if ($query->num_rows() > 0){return true;}
		 else
		 {return  false;}
	}
	function iss1_dept_cer_insert_fun()
	{
		$status_cer = 'error';
		$iss1_report_date_val = $this->input->post('iss1_report_date');
		$iss1_dept_code_val = $this->input->post('iss1_dept_code');

		$iss_rel_off_name1_val = $this->input->post('iss_rel_off_name1');
		$iss_rel_off_name2_val = $this->input->post('iss_rel_off_name2');
		$iss_rel_off_name3_val = $this->input->post('iss_rel_off_name3');
		$iss_rel_off_name4_val = $this->input->post('iss_rel_off_name4');

		$iss_rel_off_desig1_val = $this->input->post('iss_rel_off_desig1');
		$iss_rel_off_desig2_val = $this->input->post('iss_rel_off_desig2');
		$iss_rel_off_desig3_val = $this->input->post('iss_rel_off_desig3');
		$iss_rel_off_desig4_val = $this->input->post('iss_rel_off_desig4');

		$this->generate_iss1_dept_cer_new_tbl($iss1_report_date_val);
		if($this->exist_iss1_dept_cer($iss1_dept_code_val, $iss1_report_date_val))
		{
			$data_cer = $this->iss1_data_dept_cer($iss1_dept_code_val, $iss1_report_date_val);

			$iss_rel_off_name1_val_db = ''; $iss_rel_off_name2_val_db = ''; $iss_rel_off_name3_val_db = ''; $iss_rel_off_name4_val_db = '';
			$iss_rel_off_desig1_val_db = ''; $iss_rel_off_desig2_val_db = ''; $iss_rel_off_desig3_val_db = ''; $iss_rel_off_desig4_val_db = '';
			$date1_db = ''; $date2_db = ''; $date3_db = ''; $date4_db = '';
			$UID1_db = ''; $UID2_db = ''; $UID3_db = ''; $UID4_db = '';
			foreach($data_cer as $singleCer)
			{
				$iss_rel_off_name1_val_db = $singleCer->dept_off1_name;
				$iss_rel_off_name2_val_db = $singleCer->dept_off2_name;
				$iss_rel_off_name3_val_db = $singleCer->dept_off3_name;
				$iss_rel_off_name4_val_db = $singleCer->dept_off4_name;

				$iss_rel_off_desig1_val_db = $singleCer->dept_off1_dsg;
				$iss_rel_off_desig2_val_db = $singleCer->dept_off2_dsg;
				$iss_rel_off_desig3_val_db = $singleCer->dept_off3_dsg;
				$iss_rel_off_desig4_val_db = $singleCer->dept_off4_dsg;

				$date1_db = $singleCer->dept_off1_cer_enty_date;
				$date2_db = $singleCer->dept_off2_cer_enty_date;
				$date3_db = $singleCer->dept_off3_cer_enty_date;
				$date4_db = $singleCer->dept_off4_cer_enty_date;

				$UID1_db = $singleCer->dept_off1_cer_enty_uid;;
				$UID2_db = $singleCer->dept_off2_cer_enty_uid;;
				$UID3_db = $singleCer->dept_off3_cer_enty_uid;;
				$UID4_db = $singleCer->dept_off4_cer_enty_uid;;

				if($iss_rel_off_name1_val !='' && $iss_rel_off_desig1_val !=''){
					$iss_rel_off_name1_val_db = $iss_rel_off_name1_val;
					$iss_rel_off_desig1_val_db = $iss_rel_off_desig1_val;
					$date1_db = date('m/d/Y h:i:s a', time());
					$UID1_db = $this->session->userdata('some_uid');
				}
				if($iss_rel_off_name2_val !='' && $iss_rel_off_desig2_val !=''){
					$iss_rel_off_name2_val_db = $iss_rel_off_name2_val;
					$iss_rel_off_desig2_val_db = $iss_rel_off_desig2_val;
					$date2_db = date('m/d/Y h:i:s a', time());
					$UID2_db = $this->session->userdata('some_uid');
				}
				if($iss_rel_off_name3_val !='' && $iss_rel_off_desig3_val !=''){
					$iss_rel_off_name3_val_db = $iss_rel_off_name3_val;
					$iss_rel_off_desig3_val_db = $iss_rel_off_desig3_val;
					$date3_db = date('m/d/Y h:i:s a', time());
					$UID3_db = $this->session->userdata('some_uid');
				}
				if($iss_rel_off_name4_val !='' && $iss_rel_off_desig4_val !=''){
					$iss_rel_off_name4_val_db = $iss_rel_off_name4_val;
					$iss_rel_off_desig4_val_db = $iss_rel_off_desig4_val;
					$date4_db = date('m/d/Y h:i:s a', time());
					$UID4_db = $this->session->userdata('some_uid');
				}
			}

			$this->delete_iss1_dept_cer($iss1_dept_code_val, $iss1_report_date_val);

			$data = array(
				'ho_dept_cer_rep_date' => $iss1_report_date_val,
				'ho_dept_code' => $iss1_dept_code_val,
				'dept_off1_name' => $iss_rel_off_name1_val_db,
				'dept_off1_dsg' => $iss_rel_off_desig1_val,
				'dept_off1_cer_enty_date' => $date1_db,
				'dept_off1_cer_enty_uid' => $UID1_db,
				'dept_off2_name' => $iss_rel_off_name2_val_db,
				'dept_off2_dsg' => $iss_rel_off_desig2_val,
				'dept_off2_cer_enty_date' => $date2_db,
				'dept_off2_cer_enty_uid' => $UID2_db,
				'dept_off3_name' => $iss_rel_off_name3_val_db,
				'dept_off3_dsg' => $iss_rel_off_desig3_val,
				'dept_off3_cer_enty_date' => $date3_db,
				'dept_off3_cer_enty_uid' => $UID3_db,
				'dept_off4_name' => $iss_rel_off_name4_val_db,
				'dept_off4_dsg' => $iss_rel_off_desig4_val,
				'dept_off4_cer_enty_date' => $date4_db,
				'dept_off4_cer_enty_uid' => $UID4_db
			);
			if($this->add_iss1_dept_cer_data($data, $iss1_report_date_val) ==1)
			{
				$status='success';
			}
		}
		else
		{
			$date1 = ''; $date2 = ''; $date3 = ''; $date4= '';
			$UID1 = ''; $UID2 = ''; $UID3 = ''; $UID4 = '';
			if($iss_rel_off_name1_val !='' && $iss_rel_off_desig1_val !=''){
				$date1 = date('m/d/Y h:i:s a', time());
				$UID1 = $this->session->userdata('some_uid');
			}
			if($iss_rel_off_name2_val !='' && $iss_rel_off_desig2_val !=''){
				$date2 = date('m/d/Y h:i:s a', time());
				$UID2 = $this->session->userdata('some_uid');
			}
			if($iss_rel_off_name3_val !='' && $iss_rel_off_desig3_val !=''){
				$date3 = date('m/d/Y h:i:s a', time());
				$UID3 = $this->session->userdata('some_uid');
			}
			if($iss_rel_off_name4_val !='' && $iss_rel_off_desig4_val !=''){
				$date4 = date('m/d/Y h:i:s a', time());
				$UID4 = $this->session->userdata('some_uid');
			}
			$data = array(
				'ho_dept_cer_rep_date' => $iss1_report_date_val,
				'ho_dept_code' => $iss1_dept_code_val,
				'dept_off1_name' => $iss_rel_off_name1_val,
				'dept_off1_dsg' => $iss_rel_off_desig1_val,
				'dept_off1_cer_enty_date' => $date1,
				'dept_off1_cer_enty_uid' => $UID1,
				'dept_off2_name' => $iss_rel_off_name2_val,
				'dept_off2_dsg' => $iss_rel_off_desig2_val,
				'dept_off2_cer_enty_date' => $date2,
				'dept_off2_cer_enty_uid' => $UID2,
				'dept_off3_name' => $iss_rel_off_name3_val,
				'dept_off3_dsg' => $iss_rel_off_desig3_val,
				'dept_off3_cer_enty_date' => $date3,
				'dept_off3_cer_enty_uid' => $UID3,
				'dept_off4_name' => $iss_rel_off_name4_val,
				'dept_off4_dsg' => $iss_rel_off_desig4_val,
				'dept_off4_cer_enty_date' => $date4,
				'dept_off4_cer_enty_uid' => $UID4
			);
			if($this->add_iss1_dept_cer_data($data, $iss1_report_date_val) ==1)
			{
				$status='success_cer';
			}
		}
		return $status;
	}
	function add_iss1_dept_cer_data($data, $DATE)
	{
        //data table extract from date
        $tbl_name = $this->get_iss1_dept_cer_data_tbl_name_to_insert($DATE);
        //echo $DATE; die('naserr');
		$legacy_db = $this->load->database('dbcomm', true);
        //now insert data
       if($legacy_db->insert($tbl_name, $data))
		{
			return 1;
		}
		else
		{
		return 0;
		}
	}
	function delete_iss1_dept_cer($OFF_ID,$DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_iss1_dept_cer_data_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        $legacy_db->query("delete from $tbl_name where ho_dept_code = $OFF_ID AND ho_dept_cer_rep_date='$DATE'");

	}
	function generate_iss1_dept_cer_new_tbl($DATE='')
	{

        //data table extract from date
        $tbl_name = $this->get_iss1_dept_cer_data_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        //create table if not exist
        if( $legacy_db->table_exists($tbl_name) == FALSE)
        {
             $query = "CREATE TABLE $tbl_name
                    (
                        sl int NOT NULL PRIMARY KEY IDENTITY,
                        ho_dept_cer_rep_date smalldatetime,
                        ho_dept_code int,
                        dept_off1_name varchar(150),
                        dept_off1_dsg varchar(20),
                        dept_off1_cer_enty_date smalldatetime,
                        dept_off1_cer_enty_uid varchar(50),
                        dept_off2_name varchar(150),
                        dept_off2_dsg varchar(20),
                        dept_off2_cer_enty_date smalldatetime,
                        dept_off2_cer_enty_uid varchar(50),
                        dept_off3_name varchar(150),
                        dept_off3_dsg varchar(20),
                        dept_off3_cer_enty_date smalldatetime,
                        dept_off3_cer_enty_uid varchar(50),
                        dept_off4_name varchar(150),
                        dept_off4_dsg varchar(20),
                        dept_off4_cer_enty_date smalldatetime,
                        dept_off4_cer_enty_uid varchar(50)
                    );";


            $this->db->query($query);
        }
	}
	function get_iss1_dept_cer_data_tbl_name_to_insert($date='')
	{

		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='db_iss1_certificate'.'_'.$tbl_arr[0];
            }
        }

        return $tbl_name;

	}
	function iss1_data_insert_fun()
	{
		$status='error';
		$iss1_report_date_val = $this->input->post('iss1_report_date');

		$amount_iss1_bdt_val = $this->input->post('amount_iss1_bdt');
		$iss1_dept_code_val = $this->input->post('iss1_dept_code');
		$coa_1_id_val = $this->input->post('coa_1_id');
		$UID = $this->session->userdata('some_uid');

			$this->generate_iss1_new_tbl($iss1_report_date_val);
			if($this->delete_iss1_data($iss1_dept_code_val, $iss1_report_date_val))
			{
				$this->delete_iss1($iss1_dept_code_val, $iss1_report_date_val);

				$c=0;
				foreach($amount_iss1_bdt_val as $amountVal)
				{
					$data = array(
					'iss_dept_rep_date' => $iss1_report_date_val,
					'sup_coa_id' => $coa_1_id_val[$c],
					'ho_dept_code' => $iss1_dept_code_val,
					'dept_amount' => (float)$amountVal,
					'dept_uid' => $UID,
					'dept_entry_date' => date('m/d/Y h:i:s a', time())
					);
					if($this->add_iss1_data($data,$iss1_report_date_val) ==1)
					{
						$status='success';
					}
					$c++;
				}
			}
			else
			{
				$c=0;
				foreach($amount_iss1_bdt_val as $amountVal)
				{
					$data = array(
					'iss_dept_rep_date' => $iss1_report_date_val,
					'sup_coa_id' => $coa_1_id_val[$c],
					'ho_dept_code' => $iss1_dept_code_val,
					'dept_amount' => (float)$amountVal,
					'dept_uid' => $UID,
					'dept_entry_date' => date('m/d/Y h:i:s a', time())
					);
					$iss1_report_date_val = $this->input->post('iss1_report_date');

					if($this->add_iss1_data($data,$iss1_report_date_val)==1)
					{
						$status='success';
					}
					$c++;
				}
			}
		return $status;
	}
	function add_iss1_data($data, $DATE)
	{
        //data table extract from date
        $tbl_name = $this->get_iss1_data_tbl_name_to_insert($DATE);
        //echo $DATE; die('naserr');
		$legacy_db = $this->load->database('dbcomm', true);
        //now insert data
       if($legacy_db->insert($tbl_name, $data))
		{
			return 1;
		}
		else
		{
		return 0;
		}
	}

	function generate_iss1_new_tbl($DATE='')
	{

        //data table extract from date
        $tbl_name = $this->get_iss1_data_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        //create table if not exist
        if( $legacy_db->table_exists($tbl_name) == FALSE)
        {
             $query = "CREATE TABLE $tbl_name
                    (
                        sl int NOT NULL PRIMARY KEY IDENTITY,
                        iss_dept_rep_date datetime,
                        sup_coa_id int,
                        ho_dept_code int,
                        dept_amount numeric(20, 2),
                        dept_uid varchar(20),
                        dept_entry_date datetime
                    );";
			//$this->db->query($query);
			$legacy_db->query($query);
        }

	}
	function get_iss1_data_tbl_name_to_insert($date='')
	{

		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='db_iss1_dept_data'.'_'.$tbl_arr[0];
            }
        }

        return $tbl_name;

	}
	function delete_iss1_data($OFF_ID,$DATE)
	{
        //data table extract from date
        $tbl_name=$this->get_iss1_data_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);

        $query =  $legacy_db->query("SELECT * FROM $tbl_name where ho_dept_code=$OFF_ID AND iss_dept_rep_date='$DATE' ORDER BY sl");
         //return $query->result();
		 if ($query->num_rows() > 0){return true;}
		 else
		 {return  false;}
	}
	function delete_iss1($OFF_ID,$DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_iss1_data_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        $legacy_db->query("delete from $tbl_name where ho_dept_code = $OFF_ID AND iss_dept_rep_date='$DATE'");

	}

	function iss_get_deptt()
	{
		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT distinct(office_code), office_name from ho_dept_iss1_mapping where Dep_status=1  order by office_code asc");
	    return $query->result();
	}

	function iss_1_info_get($dept_info='')
	{
		$legacy_db = $this->load->database('dbcomm', true);
        //$query =  $legacy_db->query("SELECT * from ho_dept_iss1_mapping where office_code = $dept_info");
        $query =  $legacy_db->query("SELECT a.office_code, a.office_name, a.iss_coa_mapping, a.dep_status,
        	                         b.COA_DESCRIPTION, b.cust_coa_desc, b.Figure_indication,b.COA_ID_VALUE
        	                         from ho_dept_iss1_mapping a, ISS1_Serial_2016 b
                                     where a.iss_coa_mapping=b.SUPERVISION_COA_ID AND a.Office_code = '$dept_info'
                                     AND a.dep_status=1 order by b.SL");
	    return $query->result();
	}


	function iss1_item_dept_info_get($dept_info='')
	{
		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT a.office_code, a.office_name, a.iss_coa_mapping, a.dep_status,
        	                         b.COA_DESCRIPTION, b.cust_coa_desc, b.Figure_indication,b.COA_ID_VALUE
        	                         from ho_dept_iss1_mapping a, ISS1_Serial_2016 b
                                     where a.iss_coa_mapping=b.SUPERVISION_COA_ID AND a.Office_code = '$dept_info'
                                     AND a.dep_status=1 order by b.SL");

	    return $query->result();
	}

	function iss_1_sector($date_val = '')
	{
		$ch_year = date('Y', strtotime($date_val));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($date_val));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS1_Serial';
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS1_Serial_2016';
			}
		}

		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT * from $table_name_new_old_template ");
	    return $query->result();
	}
	function iss_2_sector($date_val = '')
	{
		$ch_year = date('Y', strtotime($date_val));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($date_val));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}

		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT * from $table_name_new_old_template ");
	    return $query->result();
	}

	function iss_2_whole_br_data($date_val = '')
	{
		$tbl_name = $this->get_iss_data_tbl_name($date_val);
		$return_val = '';
		$legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE){
			$return_val = '';
		} else {
			$query =  $legacy_db->query("select a.*, 
			case   when convert( varchar(50),br.AMOUNT_BDT) is NULL then 'N/A' 
				   when COA_ID_VALUE=2  then convert( varchar(50),convert(int,br.AMOUNT_BDT)) 
					else convert( varchar(50),br.AMOUNT_BDT)
			end  as AMOUNT_BDT
			from ISS1_Serial_2016 a left join
			(select SUPERVISION_COA_ID,COA_DESCRIPTION,
			case when SUPERVISION_COA_ID='1010310' then min(isnull(convert(money,AMOUNT_BDT),0)) else
			sum(isnull(convert(money,AMOUNT_BDT),0)) 
			 end  as AMOUNT_BDT
			from [dbo].[$tbl_name]
			group by SUPERVISION_COA_ID,COA_DESCRIPTION
			) br on a.SUPERVISION_COA_ID = br.SUPERVISION_COA_ID order by a.sl");
			$return_val =  $query->result();
		}

	    return 	$return_val;
	}

	function iss1_deptwise_info_get($sel_date = '', $sel_deptt = '')
	{
		$tbl_name = $this->get_iss1_data_tbl_name_to_insert($sel_date);
		$legacy_db = $this->load->database('dbcomm', true);
		$return_val = '';
		if( $legacy_db->table_exists($tbl_name) == FALSE){
			$return_val = '';
		} else {
			$query =  $legacy_db->query("SELECT * from $tbl_name where iss_dept_rep_date = '$sel_date' AND ho_dept_code = $sel_deptt");
			$return_val =  $query->result();
		}


		return $return_val;
	}
	function iss1_deptwise_cer_info_get($sel_date = '', $sel_deptt = '')
	{
		$tbl_name = $this->get_iss1_dept_cer_data_tbl_name_to_insert($sel_date);
		$legacy_db = $this->load->database('dbcomm', true);

		$return_val = '';
		if( $legacy_db->table_exists($tbl_name) == FALSE){
			$return_val = '';
		} else {
			$query =  $legacy_db->query("SELECT * from $tbl_name where ho_dept_cer_rep_date = '$sel_date' AND ho_dept_code = $sel_deptt");
			$return_val =  $query->result();
		}


	    return $return_val;
	}

	function get_designation_dropdown_dept()
	{
		$data = array();
		$data[''] = 'Select Designation';

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
	function iss1_form_details_info($date_val = '')
	{
		$ch_year = date('Y', strtotime($date_val));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($date_val));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
			$tbl_name='sum_iss_2_raw_'.$ch_year;
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
				$tbl_name='sum_iss_2_raw_'.$ch_year;
			}
		}

		$legacy_db = $this->load->database('dbcomm', true);
        $query =  $legacy_db->query("SELECT * from $table_name_new_old_template");
	    return $query->result();
	}
	function get_iss1_bb_data_tbl_name($date='')
	{
		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='T_PS_M_FI_MONITOR_HO_'.$tbl_arr[1].$tbl_arr[0];
            }
        }
        return $tbl_name;
	}
	/*--20-02-2017--start*/
	function iss1_details_info_get($sel_date = '', $prev_date='')
	{

		$ch_year = date('Y', strtotime($sel_date));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($sel_date));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS1_Serial';
			$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS1_Serial_2016';
				$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
			}
		}

		$tbl_name = $this->get_iss1_data_tbl_name_to_insert($sel_date);
		$tbl_name_bb = $this->get_iss1_bb_data_tbl_name_to_insert($sel_date);

		$tbl_name_iss1_curr = $this->get_iss1_bb_data_tbl_name($sel_date);
		$tbl_name_iss1_prev = $this->get_iss1_bb_data_tbl_name($prev_date);

		$legacy_db = $this->load->database('dbcomm', true);
		$query1_db =  $legacy_db->query("set NUMERIC_ROUNDABORT OFF");
		/*$query1_db =  $legacy_db->query("select a.*, isnull(br.AMOUNT_BDT, 0) as Br_data,
						isnull(bb_pre.AMOUNT_BDT, 0) as 'bb_pre_amt',
						isnull(bb_curr.AMOUNT_BDT, 0) as 'bb_curr_amt',
						convert(money, isnull(bb_curr.AMOUNT_BDT,0)) - convert(money,isnull( bb_pre.AMOUNT_BDT,0)) as Diff,
						( case
						when convert(money, isnull(bb_pre.AMOUNT_BDT, 0))=0 and convert(money, isnull(bb_curr.AMOUNT_BDT, 0)) = 0 then 0
						when convert(money, isnull(bb_pre.AMOUNT_BDT, 0))=0 and convert(money, isnull(bb_curr.AMOUNT_BDT, 0)) > 0 then 100
						when convert(money, isnull(bb_pre.AMOUNT_BDT, 0))=0 and convert(money, isnull(bb_curr.AMOUNT_BDT, 0)) < 0 then -100
						else
						((convert(money, isnull(bb_curr.AMOUNT_BDT, 0))-convert(money, isnull(bb_pre.AMOUNT_BDT, 0)))*100 /
						((convert(money, isnull(bb_pre.AMOUNT_BDT,0)))))
						end) as 'diff_percentage'
						from $table_name_new_old_template a left join
						(select * from $tbl_name_br where report_date='$sel_date') br
						on a.SUPERVISION_COA_ID = br.SUPERVISION_COA_ID left join
						(select * from $tbl_name_iss1_prev where DATE='$prev_date') bb_pre on
						a.SUPERVISION_COA_ID = bb_pre.SUPERVISION_COA_ID left join
						(select * from $tbl_name_iss1_curr where DATE='$sel_date') bb_curr on
						a.SUPERVISION_COA_ID = bb_curr.SUPERVISION_COA_ID
						order by a.sl
						");*/
					$query1_db =  $legacy_db->query("select a.*, isnull(br.AMOUNT_BDT, 0) as Br_data, isnull(bb_pre.AMOUNT_BDT, 0) as 'bb_pre_amt',
			isnull(bb_curr.AMOUNT_BDT, 0) as 'bb_curr_amt', convert(money, isnull(bb_curr.AMOUNT_BDT,0)) -
			convert(money,isnull( bb_pre.AMOUNT_BDT,0)) as Diff, ( case when convert(money, isnull(bb_pre.AMOUNT_BDT, 0))=0 and
			convert(money, isnull(bb_curr.AMOUNT_BDT, 0)) = 0 then 0 when convert(money, isnull(bb_pre.AMOUNT_BDT, 0))=0 and
			convert(money, isnull(bb_curr.AMOUNT_BDT, 0)) > 0 then 100 when convert(money, isnull(bb_pre.AMOUNT_BDT, 0))=0 and
			convert(money, isnull(bb_curr.AMOUNT_BDT, 0)) < 0 then -100 else ((convert(money, isnull(bb_curr.AMOUNT_BDT, 0))-
			convert(money, isnull(bb_pre.AMOUNT_BDT, 0)))*100 / ((convert(money, isnull(bb_pre.AMOUNT_BDT,0))))) end) as 'diff_percentage'
			from $table_name_new_old_template a left join (select * from $tbl_name_br where report_date='$sel_date') br
			on a.SUPERVISION_COA_ID = br.SUPERVISION_COA_ID left join (select * from $tbl_name_iss1_prev
			where DATE='$prev_date') bb_pre on a.SUPERVISION_COA_ID = bb_pre.[SUPERVISION_ COA_ID] left join
			(select * from $tbl_name_iss1_curr where [DATE]='$sel_date') bb_curr on a.SUPERVISION_COA_ID = bb_curr.SUPERVISION_COA_ID
			order by a.sl");
	    return $query1_db->result();
	}
	/*--20-02-2017--end*/
	function iss1_bb_data_insert_fun()
	{
		$status='error';
		$iss1_report_date_val = $this->input->post('iss1_report_date');

		$amount_iss1_bb_bdt_val = $this->input->post('amount_iss1_bb_bdt');
		//$iss1_dept_code_val = $this->input->post('iss1_dept_code');
		$iss1_dept_code_val = $report_of_office_id = $this->session->userdata('some_office');
		$coa_1_bb_id_val = $this->input->post('coa_1_bb_id');
		$UID = $this->session->userdata('some_uid');

			$this->generate_iss1_bb_new_tbl($iss1_report_date_val);
			if($this->delete_iss1_bb_data($iss1_dept_code_val, $iss1_report_date_val))
			{
				$this->delete_iss1_bb($iss1_dept_code_val, $iss1_report_date_val);

				$c=0;
				foreach($amount_iss1_bb_bdt_val as $amountVal)
				{
					$data = array(
					'iss_bb_rep_date' => $iss1_report_date_val,
					'sup_coa_id' => $coa_1_bb_id_val[$c],
					'ho_bb_code' => $iss1_dept_code_val,
					'bb_amount' => (float)$amountVal,
					'bb_uid' => $UID,
					'bb_entry_date' => date('m/d/Y h:i:s a', time())
					);
					if($this->add_iss1_bb_data($data,$iss1_report_date_val) ==1)
					{
						$status='success';
					}
					$c++;
				}
			}
			else
			{
				$c=0;
				foreach($amount_iss1_bb_bdt_val as $amountVal)
				{
					$data = array(
					'iss_bb_rep_date' => $iss1_report_date_val,
					'sup_coa_id' => $coa_1_bb_id_val[$c],
					'ho_bb_code' => $iss1_dept_code_val,
					'bb_amount' => (float)$amountVal,
					'bb_uid' => $UID,
					'bb_entry_date' => date('m/d/Y h:i:s a', time())
					);
					if($this->add_iss1_bb_data($data,$iss1_report_date_val) ==1)
					{
						$status='success';
					}
					$c++;
				}
			}
		return $status;
	}
	function add_iss1_bb_data($data, $DATE)
	{
        //data table extract from date
        $tbl_name = $this->get_iss1_bb_data_tbl_name_to_insert($DATE);
        //echo $DATE; die('naserr');
		$legacy_db = $this->load->database('dbcomm', true);
        //now insert data
       if($legacy_db->insert($tbl_name, $data))
		{
			return 1;
		}
		else
		{
		return 0;
		}
	}
	function generate_iss1_bb_new_tbl($DATE='')
	{

        //data table extract from date
        $tbl_name = $this->get_iss1_bb_data_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        //create table if not exist
        if( $legacy_db->table_exists($tbl_name) == FALSE)
        {
             $query = "CREATE TABLE $tbl_name
                    (
                        sl int NOT NULL PRIMARY KEY IDENTITY,
                        iss_bb_rep_date datetime,
                        sup_coa_id int,
                        ho_bb_code int,
                        bb_amount numeric(20, 2),
                        bb_uid varchar(20),
                        bb_entry_date datetime
                    )";


            $this->db->query($query);
        }

	}
	function get_iss1_bb_data_tbl_name_to_insert($date='')
	{

		$tbl_name='';
        if($date !='')
        {
            $converted_date = date('Y-m-d', strtotime($date));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='db_iss1_bb_data'.'_'.$tbl_arr[0];
            }
        }

        return $tbl_name;

	}
	function delete_iss1_bb_data($OFF_ID,$DATE)
	{
        //data table extract from date
        $tbl_name=$this->get_iss1_bb_data_tbl_name_to_insert($DATE);
        $legacy_db = $this->load->database('dbcomm', true);

        $query =  $legacy_db->query("SELECT * FROM $tbl_name where ho_bb_code = $OFF_ID AND iss_bb_rep_date='$DATE' ORDER BY sl");
         //return $query->result();
		 if ($query->num_rows() > 0){return true;}
		 else
		 {return  false;}
	}
	function delete_iss1_bb($OFF_ID,$DATE)
	{
		//data table extract from date
        $tbl_name=$this->get_iss1_bb_data_tbl_name_to_insert($DATE);

		$legacy_db = $this->load->database('dbcomm', true);
        $legacy_db->query("delete from $tbl_name where ho_bb_code = $OFF_ID AND iss_bb_rep_date='$DATE'");

	}

/*-------------------------ISS Form-1 continous report start /*--16/06/2017--------------------------------------*/
function fetch_iss_1_continous_data($report_of_year='')
{
		$table_name_new_old_template = '';

		if($report_of_year<=2015)
		{
			$table_name_new_old_template = 'ISS1_Serial';
		}
		else
		{
			if($report_of_year >= 2016)
			{
				$table_name_new_old_template = 'ISS1_Serial_2016';
			}
		}

		$legacy_db = $this->load->database('dbcomm', true);
		if($report_of_year !='')
		{
			$query_year =  $legacy_db->query("select ISSEntryDate from ISSEntryDate where YEAR(ISSEntryDate)='$report_of_year'");
		}

		$data_total_info = array();
		if($query_year->num_rows()>0)
        {
			$ci = 0;
			foreach($query_year->result_array() as $row)
			{
				$tbl_name='';
				$converted_date = date('Y-m-d', strtotime($row['ISSEntryDate']));
				$tbl_arr=explode('-',$converted_date);
				if(!empty($tbl_arr))
				{
					$tbl_name = '';
					$tbl_name = 'T_PS_M_FI_MONITOR_HO_'.$tbl_arr[1].$tbl_arr[0];

					$legacy_db = $this->load->database('dbcomm', true);
					if( $legacy_db->table_exists($tbl_name) == TRUE)
					{


						$iss_2_comp =  $legacy_db->query("select * from $table_name_new_old_template a,
														 $tbl_name b
														where b.SUPERVISION_COA_ID=a.SUPERVISION_COA_ID
														order by a.SL");
						$data_total_info[$ci++] = $iss_2_comp->result();

					}
				}
			}
        }
	return 	$data_total_info;
}

/*-------------------------ISS Form-1 continous report end /*--16/06/2017--------------------------------------*/

/*-------------------------ISS Form-3 report start /*--16/06/2017--------------------------------------*/
function fetch_iss_3_data($report_of_year='')
{
	$ch_year = date('Y', strtotime($report_of_year));
	$ch_mon = date('m', strtotime($report_of_year));
	$table_name_iss3 = 'T_PS_M_FI_ACCEPTANCE_HO_'.$ch_mon.$ch_year;
	$return_val = '';
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($table_name_iss3) == TRUE)
	{
		$iss_3_comp =  $legacy_db->query("SELECT DATE, BANK_ID, BRANCH_ID, WITH_BANK_ID,
			VALUE_OF_ACCEPTANCE_ISSUED_AMOUNT, VALUE_OF_ISSUED_ACCEPTANCE_MATURED, VALUE_OF_RECEIVED_ACCEPTANCE, PURCHASED_AMOUNT_OF_RECEIVED_ACCEPTANCE,
			MATURED_OF_RECEIVED_ACCEPTANCE, Bank_ID2, FI_NAME From [db_mis_ISS].[dbo].[$table_name_iss3]");

		$return_val = $iss_3_comp->result();
	}
	return 	$return_val;
}

/*--------------------------ISS Form-3 end /*--16/06/2017-----------------------------------------*/

/*--------------------------ISS form-2 graph start ---------------------------------------*/
    function fetch_graph_date_str($date1='',$date2='')
    {
		$date_array=array();
        $legacy_db = $this->load->database('dbcomm', true);
        $Q =  $legacy_db->query("SELECT convert(char(12),ISSEntryDate,107) ISSEntryDate, convert(char(12),CerendDate,107) ISSCerendDate from ISSEntryDate WHERE ISSEntryDate between convert(date,'$date1') and convert(date,'$date2') order by id asc");
        if($Q->num_rows()>0)
        {
          foreach($Q->result_array() as $row)
          {
            $date_array[] = $row['ISSEntryDate'];
          }
        }
        return $date_array;
    }
	function fetch_graph_date($branch_id_array_for_report=array(),$date_array=array(), $iss_item = array())
    {
	   if(count($date_array)>0)
	   {
		   $ci = 0;
			foreach($date_array as $date_Val)
		    {

			  $table_name_new_old_template = '';


				$table_name_new_old_template = 'ISS2_Serial_2016';

				$count_coitem = count($iss_item);
				$IN_coitem = '';
				if($count_coitem>0){
					$ii = 0;
					$IN_coitem="(";
					foreach($iss_item as $key=>$co_val){
						$IN_coitem.="'".$iss_item[$ii++]."'";
						if($count_coitem>1 && $key !=($count_coitem-1)) { $IN_coitem .= ",";}
					}
					$IN_coitem .= ") ";
				}

				$tbl_name='';
				$converted_date = date('Y-m-d', strtotime($date_Val));
				$tbl_arr=explode('-',$converted_date);
				if(!empty($tbl_arr))
				{
					$tbl_name = '';
					$tbl_name = 'T_PS_M_FI_MONITOR_BR_'.$tbl_arr[1].$tbl_arr[0];
					$count_in_branch=count($branch_id_array_for_report);

					$legacy_db = $this->load->database('dbcomm', true);
					if( $legacy_db->table_exists($tbl_name) == TRUE)
					{
						$IN_con='';
						if($count_in_branch>0)
						{
							$IN_con="(";
							foreach($branch_id_array_for_report as $key=>$val)
							{
								$brcode = $val['bbbrcode'];
								$IN_con.="'".$brcode."'";
								if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
							}
							$IN_con .=")";
						}

						$iss_2_comp =  $legacy_db->query("select x.COA_ID_VALUE, x.SUPERVISION_COA_ID, x.COA_DESCRIPTION, y.AMOUNT_BDT,
						                    y.report_date
											from   $table_name_new_old_template x left join
											(
											(SELECT
											[DATE] as 'report_date', [SUPERVISION_COA_ID],
											sum(
												case when isnumeric([AMOUNT_BDT])= 1
											then convert(money, [AMOUNT_BDT])
											else 0 end
											) as AMOUNT_BDT
											FROM $tbl_name
											where  [SUPERVISION_COA_ID] not in('1010310','1011665')  and BRANCH_ID in $IN_con
											group by [SUPERVISION_COA_ID], [DATE])
											union
											(SELECT
											[DATE] as 'report_date', [SUPERVISION_COA_ID],
											min(case when isnumeric([AMOUNT_BDT])= 1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where [SUPERVISION_COA_ID] = '1010310' and BRANCH_ID in $IN_con
											group by [SUPERVISION_COA_ID], [DATE])
											union
											(SELECT
											[DATE] as 'report_date', [SUPERVISION_COA_ID],
											max(case when isnumeric([AMOUNT_BDT]) = 1 then convert(money, [AMOUNT_BDT]) else 0 end) as AMOUNT_BDT
											FROM $tbl_name
											where [SUPERVISION_COA_ID] = '1011665'  and BRANCH_ID in $IN_con
											group by [SUPERVISION_COA_ID], [DATE])
											) y
											on x.SUPERVISION_COA_ID = y.SUPERVISION_COA_ID

											where x.[SUPERVISION_COA_ID] in $IN_coitem
											order by x.SL");


						$data_total_info[$ci++] = $iss_2_comp->result();

					}
				}

		   }
	   }

	return 	$data_total_info;
    }

/*--------------------------ISS form-2 graph end ---------------------------------------*/

/*--------#########ISS Form-4 Report start------------*/


function fetch_iss_4_data_branch($branch_id_array_for_report=array(), $report_of_date1 = '')
 {


		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($report_of_date1));
		$ch_mon = date('m', strtotime($report_of_date1));
		$table_name_iss4 = 'T_PS_M_FI_ACCEPTANCE_BR_'.$ch_mon.$ch_year;

		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1 = $this->get_iss_data_tbl_name($report_of_date1);
		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($table_name_iss4) == FALSE )
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			$iss_4_data =  $legacy_db->query("SELECT DATE, BANK_ID, BRANCH_ID, WITH_BANK_ID,
			VALUE_OF_ACCEPTANCE_ISSUED_AMOUNT as 'V_acc_iss_amt',
			VALUE_OF_ISSUED_ACCEPTANCE_MATURED as 'V_iss_acc_mat',
			VALUE_OF_RECEIVED_ACCEPTANCE as 'V_rec_acc',
			PURCHASED_AMOUNT_OF_RECEIVED_ACCEPTANCE as 'P_amt_rec_acc',
			MATURED_OF_RECEIVED_ACCEPTANCE as 'Mat_rec_acc',
			Bank_ID2, FI_NAME From [db_mis_ISS].[dbo].[$table_name_iss4] where BRANCH_ID in $IN_con ");
			return $iss_4_data->result();

		}
	}
	function fetch_iss_4_data_head_off($branch_id_array_for_report=array(), $report_of_date1 = '')
	{

		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($report_of_date1));
		$ch_mon = date('m', strtotime($report_of_date1));
		$table_name_iss4 = 'T_PS_M_FI_ACCEPTANCE_BR_'.$ch_mon.$ch_year;

		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1 = $this->get_iss_data_tbl_name($report_of_date1);
		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($table_name_iss4) == FALSE )
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
			$iss_4_data =  $legacy_db->query(" select '31-Jan-2016' as [DATE],'120391' as [branch_id],WITH_BANK_ID,
									 sum(convert(money,isnull(VALUE_OF_ACCEPTANCE_ISSUED_AMOUNT,0))) as V_acc_iss_amt,
									  sum(convert(money,isnull(VALUE_OF_ISSUED_ACCEPTANCE_MATURED,0))) as V_iss_acc_mat,
									  sum(convert(money,isnull(VALUE_OF_RECEIVED_ACCEPTANCE,0))) as V_rec_acc,
									  sum(convert(money,isnull(PURCHASED_AMOUNT_OF_RECEIVED_ACCEPTANCE,0))) as P_amt_rec_acc,
									  sum(convert(money,isnull(MATURED_OF_RECEIVED_ACCEPTANCE,0))) as 'Mat_rec_acc',
									  Bank_ID2, FI_NAME
									  from  [db_mis_ISS] .[dbo].[$table_name_iss4]
									  where BRANCH_ID in ('120373','120083','120570','120794','120407','121149','120079','120307','121129','120911',
					  '120139','120371','120396','120101','120749','120347','120356','120400','120544','120361',
					  '120052','120556','120714','120426','120450','121086','120362','120816','120389','120933',
					  '120383','120172','120414','120754','120421','120542','120401','120384','120358','120095',
					  '120368','120339','120427','120051','120364','120399','120299','120068','120793','120691',
					  '120109','120437','120442','120167','120944','120444')
									 and isnumeric(VALUE_OF_ACCEPTANCE_ISSUED_AMOUNT)=1
									 and isnumeric(VALUE_OF_ISSUED_ACCEPTANCE_MATURED)=1
									 and isnumeric(VALUE_OF_RECEIVED_ACCEPTANCE)=1
									 and isnumeric(PURCHASED_AMOUNT_OF_RECEIVED_ACCEPTANCE)=1
									 and isnumeric(MATURED_OF_RECEIVED_ACCEPTANCE)=1
									 group by WITH_BANK_ID, Bank_ID2, FI_NAME
									 order by convert(int,WITH_BANK_ID)  asc");
			return $iss_4_data->result();
		}
	}
/*--------#########ISS Form-4 Report end------------*/

/*-------------------------ISS Form-2 Abnormal Increase Decrease start------------------------------------*/
	function fetch_iss_2_abn_incr_decr_data( $branch_id_array_for_report=array(),$report_of_date1='', $report_of_date2='' )
    {

		$table_name_new_old_template = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1<=2015)
		{
			$table_name_new_old_template = 'ISS2_Serial';
		}
		else
		{
			if($ch_year1 >=2016 )
			{
				$table_name_new_old_template = 'ISS2_Serial_2016';
			}
		}
		$pass_param1 = 40;
		$pass_param2 = -30;
		$para_1 = $_POST['incrdecr_param1'];
		$para_2 = $_POST['incrdecr_param2'];

		if(isset($para_1) && $para_1 >0 && isset($para_2) && $para_2 < 0 )
		{
			$pass_param1 = $para_1;
			$pass_param2 = $para_2;
		}
		if(isset($para_1) && $para_1 >0 && isset($para_2) && $para_2 > 0 )
		{
			$pass_param1 = $para_1;
			$pass_param2 = -($para_2);
		}
		if(isset($para_1) && $para_1 <0 && isset($para_2) && $para_2 < 0 )
		{
			$pass_param1 = -($para_1);
			$pass_param2 = $para_2;
		}
		if(isset($para_1) && $para_1 <0 && isset($para_2) && $para_2 >0 )
		{
			$pass_param1 = $para_2;
			$pass_param2 = $para_1;
		}
		if(isset($para_1) && $para_1 > 0 && isset($para_2) && $para_2 == '' ){
			$pass_param1 = $para_1;
			$pass_param2 = -($para_1);
		}
		if(isset($para_2) && $para_2 > 0 && isset($para_1) && $para_1 == '' ){
			$pass_param1 = $para_2;
			$pass_param2 = -($para_2);
		}
		if(isset($para_1) && $para_1 < 0 && isset($para_2) && $para_2 == '' ){
			$pass_param1 = -($para_1);
			$pass_param2 = $para_1;
		}
		if(isset($para_2) && $para_2 < 0 && isset($para_1) && $para_1 == '' ){
			$pass_param1 = -($para_2);
			$pass_param2 = $para_2;
		}
		if(isset($para_2) && $para_2 == 0 && isset($para_1) && $para_1 == 0 ){
			$pass_param1 = 0;
			$pass_param2 = 0;
		}
		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1 = $this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2 = $this->get_iss_data_tbl_name($report_of_date2);
		$legacy_db = $this->load->database('dbcomm', true);

		if( $legacy_db->table_exists($tbl_name1) == FALSE || $legacy_db->table_exists($tbl_name2) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
	$iss_2_comp =  $legacy_db->query("set NUMERIC_ROUNDABORT OFF");
	$iss_2_comp =  $legacy_db->query("select p.* from (select SL, COA_ID_VALUE, A.dvname,a.jbdvcode, a.znname, a.zncode, a.brcode, a.bbbrcode, a.branchname, a.OfficePhone,
					COA_DESCRIPTION, b.[SUPERVISION_COA_ID], b.AMOUNT_BDT as diff_next, b.AMOUNT_BDT2 as diff_pre, b.Diff,
					b.[diff_per] as diff_per, (case when b.[diff_per]<$pass_param1 and b.[diff_per]>$pass_param2 then 'OK' else 'Abnormal Increasing/Decreasing' end) as
					[Data Validation] from db_mis_ISS..allinformation a inner join ( select m.SL, m.COA_ID_VALUE, x.BRANCH_ID, x.[SUPERVISION_COA_ID],
					x.COA_DESCRIPTION, isnull(x.AMOUNT_BDT,0) as AMOUNT_BDT, isnull(y.AMOUNT_BDT,0) as AMOUNT_BDT2,
					convert(money, isnull(x.AMOUNT_BDT,0)) - convert(money,isnull( y.AMOUNT_BDT,0)) as Diff,
					(case when convert(money, isnull(x.AMOUNT_BDT,0))=0 and
					convert(money, isnull(y.AMOUNT_BDT,0)) = 0 then 0 when convert(money, isnull(y.AMOUNT_BDT,0))=0 then 0
					else
					((convert(money, isnull(x.AMOUNT_BDT,0))-convert(money, isnull(y.AMOUNT_BDT,0)))*100 / ((convert(money, isnull(y.AMOUNT_BDT,0))))) end)
					as [diff_per] from [db_mis_ISS].[dbo].$table_name_new_old_template m left join
					[db_mis_ISS].[dbo].[$tbl_name1 ]  x
					on m.SUPERVISION_COA_ID =x.SUPERVISION_COA_ID and m.SUPERVISION_COA_ID not in ('1010273')  and isnumeric(x.AMOUNT_BDT)!=0
					left join [db_mis_ISS].[dbo].[$tbl_name2] y
					on x.BRANCH_ID = y.BRANCH_ID and m.SUPERVISION_COA_ID =y.SUPERVISION_COA_ID and  isnumeric(y.AMOUNT_BDT)!=0) b on '12'+bbbrcode=branch_id
					and  branch_id in $IN_con ) p where p.[Data Validation] = 'Abnormal Increasing/Decreasing'
					order by p.dvname,p.znname,p.branchname ");
		return $iss_2_comp->result();
		}
	}
/*-------------------------ISS Form-2 Abnormal Increase Decrease end------------------------------------*/
/*-------------------------ISS Form-2 9 item data start------------------------------------*/
function iss_2_generated_9item_data( $br_id = '', $item_date = '')
{
	//echo $br_id;
	$table_iss_item = '';
	$ch_year = date('Y', strtotime($item_date));
	$ch_month = date('m', strtotime($item_date));

	if( $ch_year != '' && $ch_month != '' )
	{
		$table_iss_item = 'DSA'.$ch_month.$ch_year;
	}
	//echo $table_iss_item;
	//die('iss model');
	$return_value = '';
	if( $this->db->table_exists($table_iss_item) == TRUE ){
		$query =  $this->db->query("select a.dvname,  a.znname, a.branchname,a.brcode,a.OfficePhone,a.bbbrcode ,SL,b.ps_coa,
		(case when b.Balance_Asset > b.Balance_Liability  then b.Balance_Asset else b.Balance_Liability end) as  [Total_Asset],
		(case when b.Balance_Asset > b.Balance_Liability  then b.Balance_Asset else b.Balance_Liability end) as  [Total_Liability],
		b.[Total Deposit] as 'Total_Deposit',b.[Total Loan Outstanding] as 'Total_Loan_Outstanding',
		(case when  b.General_Ledger_balance > 0  then b.General_Ledger_balance else 0 end) as  	[HOGL_Pos_bal],
		(case when  b.General_Ledger_balance <= 0  then abs(b.General_Ledger_balance) else 0 end) as  [HOGL_Neg_bal],
		b.[Total Other Asset] as 'Total_Other_Asset',b.[Total Other Liability] as 'Total_Other_Liability',b.[Total Fixed Asset] as 'Total_Fixed_Asset'
		from Db_DP_Collection_mgr..allinformation a inner join
		(select  '6' as SL,'1010200' as ps_coa, bcode ,
			   sum(Case WHEN left(sub_head,3)  in ('101','102','103','104','105','106','107')  THEN convert(numeric(18,2),isnull(amount,0))    ELSE 0 END) as Balance_Asset,
			   sum(Case WHEN left(sub_head,3)  in ('001','002','003','004','005') THEN convert(numeric(18,2),isnull(amount,0))   ELSE 0 END) as Balance_Liability,
			   sum(Case WHEN left(sub_head,3)  in ('002','003')  THEN convert(numeric(18,2),isnull(amount,0))    ELSE 0 END) as [Total Deposit],
			   convert(numeric(18,2),sum(Case WHEN sub_head  in ('11100','11200','11300','11400','11401','11600','11800') THEN convert(numeric(18,2),isnull(amount,0))   ELSE 0 END)-
				sum(Case WHEN sub_head  in ('00700','00800','00900','01000','01100','01200','01201','01400') THEN convert(numeric(18,2),isnull(amount,0))    ELSE 0 END))
			   as General_Ledger_balance,
			   sum(Case WHEN left(sub_head,3)  in ('104','105','106')  THEN convert(numeric(18,2),isnull(amount,0))    ELSE 0 END) as [Total Loan Outstanding],
			   sum(Case WHEN left(sub_head,3)  in ('107')and sub_head  not in ('10701','10702','10708')  THEN convert(numeric(18,2),isnull(amount,0))    ELSE 0 END) as [Total Other Asset] ,
			   sum(Case WHEN left(sub_head,3)  in ('005') THEN convert(numeric(18,2),isnull(amount,0))   ELSE 0 END) as [Total Other Liability],
			   sum(Case WHEN  sub_head  in ('10701','10702','10708')  THEN convert(numeric(18,2),isnull(amount,0))    ELSE 0 END) as [Total Fixed Asset]
		from Db_DP_Collection_mgr..$table_iss_item
		where bcode='$br_id' group by bcode)  b
		on a.brcode=b.bcode");
		$return_value = $query->result();
	}
	else {
		$return_value = '';
	}
	return $return_value;
}
/*-------------------------ISS Form-2 9 item data end------------------------------------*/
/*--------------------------ISS form-1 itemwise and graph start ---------------------------------------*/
function fetch_iss1_graph_data($date_array=array(), $iss_item = array())
{

   if(count($date_array)>0)
   {
	   $ci = 0;
		foreach($date_array as $date_Val)
	    {

		    $table_name_new_old_template = '';
			$table_name_new_old_template = 'ISS1_Serial_2016';

			$count_coitem = count($iss_item);
			$IN_coitem = '';
			if($count_coitem>0){
				$ii = 0;
				$IN_coitem="(";
				foreach($iss_item as $key=>$co_val){
					$IN_coitem.="'".$iss_item[$ii++]."'";
					if($count_coitem>1 && $key !=($count_coitem-1)) { $IN_coitem .= ",";}
				}
				$IN_coitem .= ") ";
		}

				$tbl_name='';
				$converted_date = date('Y-m-d', strtotime($date_Val));
				$tbl_arr=explode('-',$converted_date);

				if(!empty($tbl_arr))
				{
					$tbl_name = '';
					$tbl_name = 'T_PS_M_FI_MONITOR_HO_'.$tbl_arr[1].$tbl_arr[0];
					$legacy_db = $this->load->database('dbcomm', true);
					if( $legacy_db->table_exists($tbl_name) == TRUE)
					{

						$iss_1_comp =  $legacy_db->query("select a.DATE, b.COA_ID_VALUE, b.SUPERVISION_COA_ID, b.COA_DESCRIPTION, a.AMOUNT_BDT
							from
							[dbo].$tbl_name a,
							$table_name_new_old_template b
							where
							a.SUPERVISION_COA_ID = b.SUPERVISION_COA_ID and
							a.SUPERVISION_COA_ID in $IN_coitem
							order by b.SL");

						$data_total_info[$ci++] = $iss_1_comp->result();

					}
				}
		    }
	    }

	return 	$data_total_info;
}

/*--------------------------ISS form-1 itemwise and graph end ---------------------------------------*/

/*ISS_20001 start*/

function iss_foem2_get_iss2_0001_data()
{
	$legacy_db = $this->load->database('dbcomm', true);
	$query =  $legacy_db->query("select DISTINCT data_cat, data_cat_desc from [dbo].[ISS2_Serial_2016]");
	return $query->result();
}

function fetch_iss2_item_val($item_key=0)
{

    $data=array();

    $legacy_db = $this->load->database('dbcomm', true);
    $Q =  $legacy_db->query("select * from ISS2_Serial_2016 where data_cat=$item_key");
	if($Q->num_rows()>0)
    {
      foreach($Q->result_array() as $row)
      {
        $data[] = $row;
      }
    }
    return $data;
}

function fetch_iss_2_data_cat_item($branch_id_array_for_report=array(),$report_of_date1='',$report_of_date2='', $iss_form_2_item=array())
{
		$table_name_new_old_template = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($ch_year1==$ch_year2)
		{
				if($ch_year1<=2015 && $ch_year2<=2015)
				{
					$table_name_new_old_template = 'ISS2_Serial';
				}
				else
				{
					if($ch_year1>=2016||$ch_year2>=2016)
					{
						$table_name_new_old_template = 'ISS2_Serial_2016';
					}
			}
		}
		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1=$this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2=$this->get_iss_data_tbl_name($report_of_date2);

		$count_coitem = count($iss_form_2_item);
			$IN_coitem = '';
			if($count_coitem>0){
				$ii = 0;
				$IN_coitem="(";
				foreach($iss_form_2_item as $key=>$co_val){
					$IN_coitem.="'".$iss_form_2_item[$ii++]."'";
					if($count_coitem>1 && $key !=($count_coitem-1)) { $IN_coitem .= ",";}
				}
				$IN_coitem .= ") ";
			}

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
	$iss_2_comp =  $legacy_db->query("select b.SL,b.COA_ID_VALUE,b.SUPERVISION_COA_ID,a.dvname, a.znname, a.branchname,a.OfficePhone,b.BRANCH_ID,b.COA_DESCRIPTION, b.[2016 2nd] as 'pre_date', b.[2016 1st]
			as 'next_date', b.Diff,b.[diff_per] as 'diff_per' from db_mis_ISS..allinformation a inner join
			(select z.SL,z.COA_ID_VALUE,x.BRANCH_ID, x.[SUPERVISION_COA_ID] ,x.COA_DESCRIPTION ,x.AMOUNT_BDT as [2016 1st], y.AMOUNT_BDT
			as [2016 2nd], convert(money, isnull(y.AMOUNT_BDT,0))-convert(money, isnull(x.AMOUNT_BDT,0)) as Diff,
			(case when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0))=0 then 0
				  when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0)) > 0 then 100
				  when convert(money,isnull( x.AMOUNT_BDT,0))=0 and convert(money,isnull( y.AMOUNT_BDT,0))< 0 then -100
			else
				  cast(((convert(numeric, isnull(y.AMOUNT_BDT,0))-convert(numeric, isnull(x.AMOUNT_BDT,0))) /convert(numeric, isnull(x.AMOUNT_BDT,0))*100) as DECIMAL(18,4))
			 end) as [diff_per] FROM $tbl_name1 x left join $tbl_name2 y
			on x.BRANCH_ID = y.BRANCH_ID and x.SUPERVISION_COA_ID =y.SUPERVISION_COA_ID left join $table_name_new_old_template z
			on z.SUPERVISION_COA_ID = x.SUPERVISION_COA_ID ) b on '12'+bbbrcode=branch_id and [SUPERVISION_COA_ID] in $IN_coitem and branch_id in
			$IN_con order by a.branchname, b.SUPERVISION_COA_ID");

			return $iss_2_comp->result();

		}
}

function fetch_iss_2_data_cat_item_ar_do($branch_id_array_for_report=array(),$report_of_date1='',$report_of_date2='', $iss_form_2_item=array())
{
		$table_name_new_old_template = '';
		$ch_year1 = date('Y', strtotime($report_of_date1));
		$ch_year2 = date('Y', strtotime($report_of_date2));
		if($report_of_date1 !='' &&  $ch_year2 !='')
		{
			$table_name_new_old_template = 'ISS2_Serial_2016';
		}
		$count_in_branch=count($branch_id_array_for_report);
		$tbl_name1=$this->get_iss_data_tbl_name($report_of_date1);
		$tbl_name2=$this->get_iss_data_tbl_name($report_of_date2);

		$count_coitem = count($iss_form_2_item);
			$IN_coitem = '';
			if($count_coitem>0){
				$ii = 0;
				$IN_coitem="(";
				foreach($iss_form_2_item as $key=>$co_val){
					$IN_coitem.="'".$iss_form_2_item[$ii++]."'";
					if($count_coitem>1 && $key !=($count_coitem-1)) { $IN_coitem .= ",";}
				}
				$IN_coitem .= ") ";
			}

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE)
		{
			return 0;
		}
		else
		{
			$IN_con='';
			if($count_in_branch>0)
			{
				$IN_con="(";
				foreach($branch_id_array_for_report as $key=>$val)
				{
					$brcode = $val['bbbrcode'];
					$IN_con.="'".$brcode."'";
					if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
				}
				$IN_con .=")";
			}
		$iss_2_comp =  $legacy_db->query("BEGIN TRANSACTION SET NUMERIC_ROUNDABORT off
								select b.sl,b.COA_ID_VALUE, b.COA_DESCRIPTION,b.
								[SUPERVISION_COA_ID],
								sum(convert(numeric(18,2),b.AMOUNT_next)) as 'next_date',
								sum(convert(numeric(18,2),b.AMOUNT_pre)) as 'pre_date',
								sum(convert(numeric(18,2), b.AMOUNT_next))-sum(convert(numeric(18,2), b.AMOUNT_pre)) as Diff,
								(case
									when sum(convert(numeric(18,2), b.AMOUNT_pre))=0 and sum(convert(numeric(18,2), b.AMOUNT_next))=0 then 0
									when sum(convert(numeric(18,2), b.AMOUNT_pre))=0 then 100
								else
									(sum(convert(numeric(18,2), b.AMOUNT_next))-sum(convert(numeric(18,2), b.AMOUNT_pre)))*100 / sum(convert(numeric(18,2), b.AMOUNT_pre)) end) as 'diff_per'
								from db_mis_ISS..allinformation a inner join (
								select m.SL,m.COA_ID_VALUE, x.BRANCH_ID, x.[SUPERVISION_COA_ID] , x.COA_DESCRIPTION ,
								convert(numeric(18,2),isnull(x.AMOUNT_BDT,0)) as AMOUNT_next,
								convert(numeric(18,2),isnull(y.AMOUNT_BDT,0)) as AMOUNT_pre
								from [db_mis_ISS].[dbo].[$table_name_new_old_template] m left join
								[db_mis_ISS].[dbo].[$tbl_name2] x on m.SUPERVISION_COA_ID =x.SUPERVISION_COA_ID left join
								[db_mis_ISS].[dbo].[$tbl_name1] y on x.BRANCH_ID = y.BRANCH_ID and
								m.SUPERVISION_COA_ID =y.SUPERVISION_COA_ID ) b on '12'+bbbrcode=branch_id and [SUPERVISION_COA_ID] in $IN_coitem and branch_id in $IN_con
								group by b.sl,b.COA_ID_VALUE, b.COA_DESCRIPTION,b.[SUPERVISION_COA_ID] order by b.sl");
			return $iss_2_comp->result();

		}
}
/*ISS_2_0001 end*/

/*ISS admin Panel start*/
function iss_get_admin_date()
{
	$legacy_db = $this->load->database('dbcomm', true);
    $query =  $legacy_db->query("SELECT * from ISSEntryDate order by id asc");
    return $query->result();
}
/*ISS admin Panel end*/

/*ISS Form-1 Department data start*/
	function iss2_br_details_info_get($para_date='')
	{

		$ch_year = date('Y', strtotime($para_date));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($para_date));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS1_Serial';
			$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS1_Serial_2016';
				$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
			}
		}

		$tbl_name = $this->get_iss1_data_tbl_name_to_insert($para_date);
		$tbl_name_bb = $this->get_iss1_bb_data_tbl_name_to_insert($para_date);

		$tbl_name_iss1_curr = $this->get_iss1_bb_data_tbl_name($para_date);
		$tbl_name_iss1_prev = $this->get_iss1_bb_data_tbl_name($para_date);

		$return_val = '';
		$legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name_br) == FALSE){
			$return_val = '';
		} else {
			/*$query1_db =  $legacy_db->query("select a.*, isnull(br.AMOUNT_BDT, 0) as Br_data
				   from $table_name_new_old_template a left join
				   (select * from $tbl_name_br where report_date='$para_date') br
				   on a.SUPERVISION_COA_ID = br.SUPERVISION_COA_ID order by a.sl");*/
		$query1_db =  $legacy_db->query("select a.*, 
				   case   when convert( varchar(50),br.AMOUNT_BDT) is NULL then 'N/A' 
						  when COA_ID_VALUE=2  then convert( varchar(50),convert(int,br.AMOUNT_BDT)) 
						  else convert( varchar(50),br.AMOUNT_BDT)
				   end  as Br_data
				   from $table_name_new_old_template a left join
				   (select * from $tbl_name_br where report_date='$para_date') br
				   on a.SUPERVISION_COA_ID = br.SUPERVISION_COA_ID order by a.sl
				   ");	   
			$return_val =  $query1_db->result();
		}
	    return 	$return_val;

	}

	function iss1_deptt_details_info_get($para_date='')
	{

		$ch_year = date('Y', strtotime($para_date));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($para_date));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS1_Serial';
			$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS1_Serial_2016';
				$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
			}
		}

		$tbl_name = $this->get_iss1_data_tbl_name_to_insert($para_date);

		$return_val = '';
		$legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE){
			$return_val = '';
		} else {
			$query1_db =  $legacy_db->query("select b.sup_coa_id, sum(b.dept_amount) as amt
			from db_mis_ISS..$table_name_new_old_template a,
			$tbl_name b
			where b.iss_dept_rep_date='$para_date' AND a.SUPERVISION_COA_ID=b.sup_coa_id
			group by b.sup_coa_id");
			$return_val =  $query1_db->result();
		}
	    return 	$return_val;

	}

	function iss1_bb_sub_details_info_get($para_date = '')
	{

		$ch_year = date('Y', strtotime($para_date));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($para_date));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS1_Serial';
			$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS1_Serial_2016';
				$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
			}
		}
		$tbl_name = $this->get_iss1_bb_data_tbl_name($para_date);

	    $return_val = '';
		$legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE){
			$return_val = '';
		} else {
			/*$query1_db =  $legacy_db->query("select a.SL, a.COA_DESCRIPTION, a.SUPERVISION_COA_ID, a.cust_coa_desc, a.COA_ID_VALUE, b.AMOUNT_BDT
			 from db_mis_ISS..$table_name_new_old_template a,
			$tbl_name b where
			a.SUPERVISION_COA_ID=b.[SUPERVISION_COA_ID] AND
			b.[DATE]='$para_date'
			order by SL");*/
			$query1_db =  $legacy_db->query("select a.SL, 
			a.COA_DESCRIPTION, a.SUPERVISION_COA_ID, a.cust_coa_desc, a.COA_ID_VALUE, 
			case when COA_ID_VALUE=2  then convert( varchar(50), convert(int,convert(money, b.AMOUNT_BDT))) 
				 else convert( varchar(50),b.AMOUNT_BDT)
			end as AMOUNT_BDT
			from db_mis_ISS..$table_name_new_old_template a,
			$tbl_name b where
			a.SUPERVISION_COA_ID=b.[SUPERVISION_COA_ID] AND
			b.[DATE]='$para_date'
			order by SL");
			$return_val =  $query1_db->result();
		}
	    return 	$return_val;
	}

	function iss1_bb_decesion_info_get($para_date = '')
	{

		$ch_year = date('Y', strtotime($para_date));
		$table_name_new_old_template = '';
		$ch_year = date('Y', strtotime($para_date));
		if($ch_year <=2015)
		{
			$table_name_new_old_template = 'ISS1_Serial';
			$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
		}
		else
		{
			if($ch_year>=2016)
			{
				$table_name_new_old_template = 'ISS1_Serial_2016';
				$tbl_name_br ='sum_iss_2_raw_'.$ch_year;
			}
		}
		//$tbl_name = $this->get_iss1_bb_data_tbl_name($para_date);
		$tbl_name = $this->get_iss1_bb_data_tbl_name_to_insert($para_date);
		
	    $return_val = '';
		$legacy_db = $this->load->database('dbcomm', true);
		if( $legacy_db->table_exists($tbl_name) == FALSE){
			$return_val = '';
		} else {
			$query1_db =  $legacy_db->query("select a.SL, a.COA_DESCRIPTION, a.SUPERVISION_COA_ID, a.cust_coa_desc, a.COA_ID_VALUE, 
			b.sup_coa_id, b.bb_amount
			from db_mis_ISS..$table_name_new_old_template a,
			$tbl_name b where
			a.SUPERVISION_COA_ID=b.sup_coa_id AND
			b.iss_bb_rep_date='$para_date'
			order by a.SL");
			$return_val =  $query1_db->result();
		}
	    return 	$return_val;
	}

	function fetch_iss_ho_br_missing($para_date = '')
	{

		$data=array();
		$table_name = $this->get_iss_data_tbl_name($para_date);
		$legacy_db = $this->load->database('dbcomm', true);
		 if($legacy_db->table_exists($table_name) == FALSE)
		 {
			 return $data;
		 }
		else
		{
			$Q =  $legacy_db->query("select brcode, branchname, dvname, zncode, znname 
			from [dbo].[allinformation] 
			where brcode not in ('9999', '0931', '0932', '0933', '0934') AND 
			'12'+bbbrcode not in 
			(select distinct BRANCH_ID from  [dbo].[$table_name])");
			return $Q->result();
		}
	}

/*ISS Form-1 Department data end*/
//--------------------------------------------------------///ISS end ---------------------------------///

	function iss_entry_date_list()
	{
		$tbl_name1="ISSEntryDate";

		$legacy_db = $this->load->database('dbcomm', true);
        if( $legacy_db->table_exists($tbl_name1) == FALSE)
		{
			return 0;
		}
		else
		{
			$iss_entry_date =  $legacy_db->query("SELECT * FROM ISSEntryDate");
			return $iss_entry_date->result();
		}
	}

/*****### Department wise ISS Form-1 start#####******/

/*****### END Department wise ISS Form-1 END#####*****/

/**
 * DRS model start 
 */

function drs_get_90300102_product( $prod_param1 = 903001, $prod_param2 = 903002 )
{
	$legacy_db = $this->load->database('dbcomm', true);
	$query =  $legacy_db->query("select prodGroupCode, prodGroupNameEn, prodCode, prodNameEn 
								from drs_9030 where 
								prodGroupCode='$prod_param1' OR prodGroupCode='$prod_param2'");
	return $query->result();
}

/**
 * DRS model end
*/

/*IQA start*/
function save_iss_iqa_info()
{
	$data = array(
		'iqa_user_id' => $this->session->userdata('some_uid'),
		'iqa_office_code' => $this->session->userdata('some_office'),
		'iqa_date' => date("Y/m/d H:i:s"),
		'iqa_info' => $this->input->post('iqa_info_details', true),
		'iqa_status' => 1
	);
	$ball = $this->input->post('iqa_info_details', true);
	$legacy_db = $this->load->database('dbcomm', true);
	
	if($legacy_db->insert('iqa_info_tbl', $data) && strlen($ball)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function iss_iqa_user_details_data( )
{
	$legacy_db = $this->load->database('dbcomm', true);
	$query =  $legacy_db->query("select a.iqa_office_code,c.office_name, a.iqa_user_id, b.ui_Full_Name, 
									b.ui_Mobile_No, a.iqa_date 
									from 
									[db_mis_ISS]..iqa_info_tbl a,
									[Db_DP_Collection_mgr]..DMS_UserInfo b, 
									[Db_DP_Collection_mgr]..VW_Jb_off c
									where a.iqa_user_id=b.ui_PFile_No AND a.iqa_office_code=b.ui_Posting_Office_Code 
									AND a.iqa_office_code=c.[Office code]
									order by a.iqa_id desc
									");
	return $query->result();
	//a.iqa_info_tbl
}
/*IQA end*/


///////////////////////////iss2_0002 report end/////////////////////////////////
function fetch_iss2_0002_data($branch_id_array_for_report=array(),$report_of_date1='')
{
	$iss_table_template = '';
	$iss_table_template = 'ISS2_Serial_2016';
	$omis_year = date('Y', strtotime($report_of_date1));
	$omis_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_omis = 'omis_data_'.$omis_year.'_'.$omis_month;
	$tbl_affairs = 'DSA'.$omis_month.$omis_year;
	
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}

	$cross_data =  $legacy_db->query("
	SELECT 
	a.dvname, a.znname, a.branchname, a.brcode, a.bbbrcode, a.OfficePhone, 
	b.Deposit_ISS AS 'Total_Deposit_ISS', c.Deposit_affairs AS 'Total_Deposit_affair', 
	d.Deposit_OMIS AS 'Total_Deposit_OMIS',
	(CASE WHEN abs(b.Deposit_ISS - c.Deposit_affairs)<1 AND abs(c.Deposit_affairs - d.Deposit_OMIS)<1 AND abs(b.Deposit_ISS - d.Deposit_OMIS)<1 
	then 'OK' else 'Mismatch' end) as 'Deposit_check', 
	b.Loan_Outstanding_ISS AS 'Total_Loan_Outstanding_ISS', 
	c.Loan_Outstanding_aff AS 'Total_Loan_Outstanding_Affairs', 
	d.Total_Loan_Outstanding AS 'Total_Loan_Outstanding_OMIS', 
	(CASE WHEN abs(b.Loan_Outstanding_ISS - c.Loan_Outstanding_aff)<1 AND abs(c.Loan_Outstanding_aff - d.Total_Loan_Outstanding)<1 AND abs(b.Loan_Outstanding_ISS - 
	d.Total_Loan_Outstanding)<1 then 'OK' else 'Mismatch' end) as 'Loan_Outstanding_check',
	b.No_of_Deposit_ACC_ISS AS 'No_of_Deposit_ACC_ISS', 
	d.Number_of_Deposit_OMIS AS 'Number_of_Deposit_OMIS',
	(CASE WHEN b.No_of_Deposit_ACC_ISS != d.Number_of_Deposit_OMIS THEN 'Mismatch' ELSE 'Ok' end) AS 'No_of_Deposit_ac_check', 
	b.No_of_Loan_ACC_ISS AS 'No_of_Loan_ACC_ISS', 
	d.No_of_Loan_Acc_OMIS AS 'No_of_Loan_Acc_OMIS',
	(CASE WHEN b.No_of_Loan_ACC_ISS != d.No_of_Loan_Acc_OMIS THEN 'Mismatch' ELSE 'Ok' end) AS 'No_of_loan_ac_check'
	FROM [Db_DP_Collection_mgr].[dbo].[allinformation] AS a 
	JOIN (SELECT BRANCH_ID, 
	SUM(CASE WHEN SUPERVISION_COA_ID='1010215' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 END) AS 'Deposit_ISS', 
	SUM(CASE WHEN SUPERVISION_COA_ID='1010274' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 END) AS  'No_of_Deposit_ACC_ISS',
	SUM(CASE WHEN SUPERVISION_COA_ID='1010400' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 END) AS  'No_of_Loan_ACC_ISS',
	SUM(CASE WHEN SUPERVISION_COA_ID='1010405' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 END) AS 'Loan_Outstanding_ISS' 
	FROM [db_mis_ISS].[dbo].[$tbl_iss] GROUP BY BRANCH_ID ) b ON '12'+a.bbbrcode = b.BRANCH_ID 
	JOIN (SELECT bcode, 
	sum(CASE WHEN LEFT(sub_head, 3) IN ('002','003') THEN amount ELSE 0 END) AS 'Deposit_affairs', 
	sum(CASE WHEN LEFT(sub_head, 3) IN ('104','105','106') THEN amount ELSE 0 END) AS 'Loan_Outstanding_aff' 
	FROM [Db_DP_Collection_mgr].[dbo].[$tbl_affairs] 
	GROUP BY bcode) c ON c.bcode=a.brcode 
	JOIN ( SELECT dd_jo_code, 
	SUM(CASE WHEN dd_pt_id IN (101, 105, 109, 113, 117, 121, 125, 301) THEN dd_amt ELSE 0 END) AS 'Deposit_OMIS', 
	SUM(CASE WHEN dd_pt_id  IN (101,105,109,113,117,121,125,301)  THEN dd_ac   ELSE 0 END) AS 'Number_of_Deposit_OMIS',
	SUM(CASE WHEN dd_pt_id IN (601, 605, 609, 613, 617, 621) THEN dd_amt ELSE 0 END) AS 'Total_Loan_Outstanding', 
	SUM(CASE WHEN dd_pt_id  IN (601, 605, 609, 613, 617, 621) THEN dd_ac ELSE 0 END) AS 'No_of_Loan_Acc_OMIS'
	FROM [Db_DP_Collection_mgr].[dbo].[$tbl_omis] 
	WHERE dd_end_dt = ( select a.om_dat_date from 
	(select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
	WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $omis_year and 
	SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $omis_month) a 
	where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
	from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
	WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $omis_year and 
	SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $omis_month) ) AND 
	dd_jo_code NOT IN (0931,0932,0933,0934) AND dd_jo_code in $IN_con 
	GROUP BY dd_jo_code) d ON d.dd_jo_code=a.brcode");
	return $cross_data->result();
	
	}
}
///////////////////////////iss2_0002 report end/////////////////////////////////

///////////////////////////iss2_0003 report end/////////////////////////////////
function fetch_iss2_0003_data($branch_id_array_for_report=array(),$report_of_date1='')
{
	$iss_table_template = '';
	$iss_table_template = 'ISS2_Serial_2016';
	$omis_year = date('Y', strtotime($report_of_date1));
	$omis_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_omis = 'CIBTABR'.$omis_month.$omis_year.'A';
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}
	//SET NUMERIC_ROUNDABORT OFF 
	$cross_data =  $legacy_db->query("select a.dvname, a.znname, a.branchname, a.brcode, a.bbbrcode, a.OfficePhone, 
	b.Unreconciled_Dr_EntriesNo_ISS AS 'Unreconciled_Dr_EntriesNo_ISS', c.DrNo_OMIS, 
	(CASE WHEN b.Unreconciled_Dr_EntriesNo_ISS != c.DrNo_OMIS THEN 'Mismatch' ELSE 'OK' end) AS 'Unreconciled_Dr_EntriesNo_chk', 
	b.Unreconciled_Dr_EntriesAmt_ISS AS 'Unreconciled_Dr_EntriesAmt_ISS', C.DrAmt_OMIS, 
	(CASE WHEN abs(b.Unreconciled_Dr_EntriesAmt_ISS - C.DrAmt_OMIS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Unreconciled_Dr_EntriesAmt_chk', 
	b.Unreconciled_Cr_EntriesNo_ISS AS 'Unreconciled_Cr_EntriesNo_ISS', C.CrNo_OMIS, 
	(CASE WHEN b.Unreconciled_Cr_EntriesNo_ISS != C.CrNo_OMIS THEN 'Mismatch' ELSE 'OK' end) AS 'Unreconciled_Cr_EntriesNo_chk', 
	b.Unreconciled_Cr_EntriesAmt_ISS AS 'Unreconciled_Cr_EntriesAmt_ISS', C.CrAmt_OMIS, 
	(CASE WHEN abs(b.Unreconciled_Cr_EntriesAmt_ISS - C.CrAmt_OMIS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Unreconciled_Cr_EntriesAmt_chk', 
	convert(varchar(18), b.Last_Reconciliation_Date_ISS, 112) AS 'Last_Reconciliation_Date_ISS', 
	convert(varchar(18), c.lastReconcileCompletedDate_OMIS, 112) AS 'lastReconcileCompletedDate_OMIS', 
	(CASE WHEN convert(varchar(18), b.Last_Reconciliation_Date_ISS, 112) != convert(varchar(18), c.lastReconcileCompletedDate_OMIS, 112) 
	THEN 'Mismatch' ELSE 'OK' end) AS 'LAST_reconcompleted_Check' 
	from Db_DP_Collection_mgr..allinformation a left join 
	(select BRANCH_ID, 
	sum(CASE WHEN SUPERVISION_COA_ID = '1010300' THEN convert(money, AMOUNT_BDT) ELSE 0 end) AS 'Unreconciled_Dr_EntriesNo_ISS', 
	sum(CASE WHEN SUPERVISION_COA_ID = '1010301' THEN convert(money, AMOUNT_BDT) ELSE 0 end) AS 'Unreconciled_Dr_EntriesAmt_ISS', 
	sum(CASE WHEN SUPERVISION_COA_ID = '1010305' THEN convert(money, AMOUNT_BDT) ELSE 0 end) AS 'Unreconciled_Cr_EntriesNo_ISS', 
	sum(CASE WHEN SUPERVISION_COA_ID = '1010306' THEN convert(money, AMOUNT_BDT) ELSE 0 end) AS 'Unreconciled_Cr_EntriesAmt_ISS', 
	sum(CASE WHEN SUPERVISION_COA_ID = '1010310' THEN AMOUNT_BDT ELSE 0 end) AS 'Last_Reconciliation_Date_ISS' 
	from [db_mis_ISS].[dbo].[$tbl_iss] group by BRANCH_ID) b on '12'+a.bbbrcode=b.BRANCH_ID join (SELECT [BrCode], 
	TotalDrEntry as 'DrNo_OMIS', DrAmount as 'DrAmt_OMIS', TotalCrEntry as 'CrNo_OMIS', [CrAmount] as 'CrAmt_OMIS', 
	reconcompleted as 'lastReconcileCompletedDate_OMIS', [LastReconcileDate] 
	FROM [Db_DP_Collection_mgr].[dbo].[$tbl_omis]) c 
	on a.brcode=c.BrCode AND a.brcode in $IN_con order by a.dvname, a.znname, a.branchname");
	
	return $cross_data->result();
	
	}
}
///////////////////////////iss2_0003 report end/////////////////////////////////

///////////////////////////iss2_0004 report end/////////////////////////////////
function fetch_iss2_0004_data($branch_id_array_for_report=array(),$report_of_date1='')
{
	$iss_table_template = '';
	$iss_table_template = 'ISS2_Serial_2016';
	$omis_year = date('Y', strtotime($report_of_date1));
	$omis_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_affairs = 'DSA'.$omis_month.$omis_year;
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}
	//SET NUMERIC_ROUNDABORT OFF 
	$cross_data =  $legacy_db->query("select 
	b.dvname,  b.znname, b.branchname, b.OfficePhone, '12'+b.bbbrcode AS 'BR_Code_BB',
	b.Total_ASset_Affairs, a.Total_ASset_ISS, b.Total_Liability_Affairs, a.Total_Liability_ISS,
	(CASE WHEN abs(b.Total_ASset_Affairs - a.Total_Asset_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Asset_liability_check',
	b.Total_Deposit_Affairs,a.Total_Deposit_ISS,
	(CASE WHEN abs(b.Total_Deposit_Affairs - a.Total_Deposit_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Deposit_check',
	b.Total_Loan_Outstanding_Affairs, a.Total_Loan_Outstanding_ISS,
	(CASE WHEN abs(b.Total_Loan_Outstanding_Affairs - a.Total_Loan_Outstanding_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Loan_check',
	b.HOGLPositiveB_Affairs, a.HOGLPositiveB_ISS,
	(CASE WHEN abs(b.HOGLPositiveB_Affairs - a.HOGLPositiveB_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'HOGLPositiveB_check',
	b.HOGLNegativeB_Affairs, a.HOGLNBalance_ISS,
	(CASE WHEN abs(b.HOGLNegativeB_Affairs - a.HOGLNBalance_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'HOGLNBalance_ISS_check',
	b.Other_Asset_Affairs, a.Total_Other_ASset_ISS,
	(CASE WHEN abs(b.Other_Asset_Affairs - a.Total_Other_ASset_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Other_Asset_check',
	b.Other_Liability_Affairs, a.Total_Other_Liability_ISS,
	(CASE WHEN abs(b.Other_Liability_Affairs - a.Total_Other_Liability_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Other_Liability_check',
	b.Fixed_ASset_Affairs, a.Total_Fixed_Asset_ISS,
	(CASE WHEN abs(b.Fixed_ASset_Affairs - a.Total_Fixed_Asset_ISS)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Fixed_Asset_check',
	a.Off_Balance_Sheet_Exposure_ISS, b.contra_Affairs,
	b.AcceptanceEndorsement_Affairs, b.LG_Affairs, b.Irrevocable_LC_Affairs, b.Bills_Collection_Affairs,
	(CASE WHEN abs(a.Off_Balance_Sheet_Exposure_ISS - b.contra_Affairs)<1 THEN 'OK' ELSE 'Mismatch' end) AS 'Off_balance_vs_contra_check'
	from 
	(select BRANCH_ID,
	sum(CASE WHEN SUPERVISION_COA_ID = '1010200' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Total_Asset_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010210' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Total_Liability_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010215' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Total_Deposit_ISS' ,
	sum(CASE WHEN SUPERVISION_COA_ID = '1010405' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Total_Loan_Outstanding_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010208' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'HOGLPositiveB_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010235' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'HOGLNBalance_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010205' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Total_Other_ASset_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010220' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Total_Other_Liability_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010201' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Total_Fixed_Asset_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010221' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Suspense_Account_ISS',
	sum(CASE WHEN SUPERVISION_COA_ID = '1010291' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 end) AS 'Off_Balance_Sheet_Exposure_ISS'
	from [db_mis_ISS].[dbo].[$tbl_iss] group by BRANCH_ID) a
	inner join
	(
	select 
	b.dvname,b.jbdvcode,b.zncode, b.znname, b.branchname, b.brcode,b.OfficePhone, b.bbbrcode,
	(b.Balance_Asset + b.[Expenditure_Income_positive] + b.[Head Office General Ledger Positive Balance-Affairs]) AS 'Total_ASset_Affairs',
	b.Balance_Liability + b.[Expenditure_Income_negative] + b.[Head Office General Ledger Negative Balance-Affairs] AS 'Total_Liability_Affairs',
	b.[Total Deposit] AS 'Total_Deposit_Affairs', b.[Total Loan Outstanding] AS 'Total_Loan_Outstanding_Affairs', 
	[Head Office General Ledger Positive Balance-Affairs] AS 'HOGLPositiveB_Affairs', [Head Office General Ledger Negative Balance-Affairs] AS 'HOGLNegativeB_Affairs',
	b.[Total Other ASset-Affairs] AS 'Other_Asset_Affairs', b.[Total Other Liability-Affairs] AS 'Other_Liability_Affairs', 
	b.[Total Fixed ASset-Affairs] AS 'Fixed_ASset_Affairs', b.[contra] AS 'contra_Affairs', b.[Acceptance and Endorsement] AS 'AcceptanceEndorsement_Affairs', 
	b.[Letters of Guarantee] AS 'LG_Affairs', b.[Irrevocable Letters of Credit] AS 'Irrevocable_LC_Affairs', b.[Bills for Collection] AS 'Bills_Collection_Affairs'
	from 
	(select a.dvname, a.jbdvcode, a.zncode, a.znname, a.branchname, a.brcode, a.OfficePhone, a.bbbrcode,
	b.Balance_Asset,
	b.Balance_Liability,
	b.[Total Deposit],b.[Total Loan Outstanding],
	(CASE WHEN b.Expenditure_Income > 0 THEN b.Expenditure_Income ELSE 0 end) AS [Expenditure_Income_positive],
	(CASE WHEN b.Expenditure_Income <= 0 THEN abs(b.Expenditure_Income) ELSE 0 end) AS  [Expenditure_Income_negative],
	(CASE WHEN b.General_Ledger_balance > 0 THEN b.General_Ledger_balance ELSE 0 end) AS [Head Office General Ledger Positive Balance-Affairs],
	(CASE WHEN b.General_Ledger_balance <= 0  THEN abs(b.General_Ledger_balance) ELSE 0 end) AS [Head Office General Ledger Negative Balance-Affairs],
	b.[Total Other ASset] AS [Total Other ASset-Affairs], b.[Total Other Liability] AS [Total Other Liability-Affairs], b.[Total Fixed ASset] AS [Total Fixed ASset-Affairs],
	b.[contra], b.[Acceptance and Endorsement], b.[Letters of Guarantee], b.[Irrevocable Letters of Credit], b.[Bills for Collection]
	from [Db_DP_Collection_mgr].[dbo].[allinformation] a inner join
	(select bcode,
	sum(CASE WHEN left(sub_head, 3) in ('101', '102', '103', '104', '105', '106', '107') THEN amount ELSE 0 END) AS Balance_Asset,
	sum(CASE WHEN left(sub_head, 3) in ('001', '002', '003', '004', '005') THEN amount ELSE 0 END) AS Balance_Liability,
	convert(numeric(18, 2), sum(CASE WHEN sub_head in ('11500') THEN amount ELSE 0 END) - sum(CASE WHEN sub_head in ('01300') THEN amount ELSE 0 END)) AS Expenditure_Income,
	sum(CASE WHEN left(sub_head, 3) in ('002', '003') THEN amount ELSE 0 END) AS [Total Deposit],       
	convert(numeric(18, 2), sum(CASE WHEN sub_head in ('11100', '11200', '11300', '11400', '11401', '11600', '11800') THEN amount ELSE 0 END)-
	 sum(CASE WHEN sub_head in ('00700', '00800', '00900', '01000', '01100', '01200', '01201', '01400') THEN amount ELSE 0 END)) 
	AS General_Ledger_balance,
	sum(CASE WHEN left(sub_head, 3) in ('104', '105', '106') THEN amount ELSE 0 END)AS [Total Loan Outstanding],
	sum(CASE WHEN left(sub_head, 3) in ('107') and sub_head not in ('10701', '10702', '10708') THEN amount ELSE 0 END) AS [Total Other ASset],
	sum(CASE WHEN left(sub_head, 3) in ('005') THEN amount ELSE 0 END) AS [Total Other Liability],
	sum(CASE WHEN sub_head in ('10701', '10702', '10708') THEN amount ELSE 0 END)AS [Total Fixed ASset],
	sum(CASE WHEN left(sub_head, 3) in ('108') THEN amount  ELSE 0 END) AS [Contra],
	sum(CASE WHEN sub_head in ('10813') THEN amount ELSE 0 END) AS [Acceptance and Endorsement],
	sum(CASE WHEN sub_head in ('10803') THEN amount ELSE 0 END) AS [Letters of Guarantee],
	sum(CASE WHEN sub_head in ('10804', '10805', '10806', '10807', '10808', '10809', '10811', '10812', '10815', '10816', '10817', '10818', '10819') THEN amount ELSE 0 END) AS[Irrevocable Letters of Credit],
	sum(CASE WHEN sub_head in ('10801', '10802', '10810', '10820', '10821', '10822', '10823', '10824') THEN amount ELSE 0 END) AS[Bills for Collection]     
	from [Db_DP_Collection_mgr].[dbo].[$tbl_affairs]
	group by bcode) b on a.brcode=b.bcode AND a.brcode in $IN_con) b ) b 
	on a.BRANCH_ID = '12'+b.bbbrcode  
	order by b.dvname, b.znname, b.branchname");	

	return $cross_data->result();
	
	}
}
///////////////////////////iss2_0004 report end/////////////////////////////////


///////////////////////////iss2_0005 report start/////////////////////////////////
function fetch_iss2_0005_data($branch_id_array_for_report=array(),$report_of_date1='')
{
	$omis_year = date('Y', strtotime($report_of_date1));
	$omis_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_affairs = 'DSA'.$omis_month.$omis_year;
	$tbl_backpage = 'backpage'.$omis_month.$omis_year;
	
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}
	//SET NUMERIC_ROUNDABORT OFF 
	$cross_data =  $legacy_db->query("
    SELECT 
	a.dvname, a.znname, a.branchname, a.brcode,
	a.bbbrcode, a.OfficePhone, b.[Accrued Income_ISS] AS 'accruedIncome_ISS',
	d.[S/A-Intt.Rec. A/c Accrued Intt] AS 'SA_InttRecACAccruedIntt_Affairs',
	(CASE WHEN abs(b.[Accrued Income_ISS]- d.[S/A-Intt.Rec. A/c Accrued Intt])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'AccruedIncome_check',
	b.[Suspense Account_ISS] AS 'SuspenseAccount_ISS',
	c.[Suspense Account_Affairs] AS 'SuspenseAccount_Affairs',
	(CASE WHEN abs(b.[Suspense Account_ISS]- c.[Suspense Account_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'SuspenseAccount_check',
	b.[Total amount of Protested Bill_ISS] AS 'ProtestedBill_ISS',
	d.[Protested Bill_Affairs] AS 'ProtestedBill_Affairs',
	(CASE WHEN abs(b.[Total amount of Protested Bill_ISS]- d.[Protested Bill_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'ProtestedBill_check',
	b.[Stationary & Stamp_ISS] AS 'StationaryAndStamp_ISS',
	c.[Stationary & Stamp_Affairs] AS 'StationaryAndStamp_Affairs',
	(CASE WHEN abs(b.[Stationary & Stamp_ISS]- c.[Stationary & Stamp_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'StationaryAndStamp_check',
	b.[Current Deposit_ISS] AS 'CurrentDeposit_ISS',
	c.[Current Deposit_Affairs] AS 'CurrentDeposit_Affairs',
	(CASE WHEN abs(b.[Current Deposit_ISS]- c.[Current Deposit_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'CurrentDeposit_check',
	b.[Total Savings Deposit_ISS] AS 'SavingsDeposit_ISS',
	c.[Saving Deposit_Affairs] AS 'SavingDeposit_Affairs',
	(CASE WHEN abs(b.[Total Savings Deposit_ISS]- c.[Saving Deposit_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'SavingDeposit_check',
	b.[Total STD_ISS] AS 'STD_ISS',
	c.[Total STD_Affairs] AS 'STD_Affairs',
	(CASE WHEN abs(b.[Total STD_ISS]- c.[Total STD_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'STD_check',
	b.[Total Term Deposit_ISS] AS 'TermDeposit_ISS',
	c.[Total Term Deposit_Affairs] AS 'TermDeposit_Affairs',
	(CASE WHEN abs(b.[Total Term Deposit_ISS]- c.[Total Term Deposit_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'TermDeposit_check',
	b.[Sundry Deposit_ISS] AS 'SundryDeposit_ISS',
	c.[Sundry Deposit_Affairs] AS 'SundryDeposit_Affairs',
	(CASE WHEN abs(b.[Sundry Deposit_ISS]- c.[Sundry Deposit_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'SundryDeposit_check',
	b.[Local DD, TT, MT & PO Payable_ISS] AS 'LocalDDTTMTPOPayable_ISS',
	c.[Local DD, TT, MT & PO Payable_Affairs] AS 'LocalDDTTMTPOPayable_Affairs',
	(CASE WHEN abs(b.[Local DD, TT, MT & PO Payable_ISS]- c.[Local DD, TT, MT & PO Payable_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'LocalDDTTMTPOPayable_check',
	b.[Margin Deposit_ISS] AS 'MarginDeposit_ISS',
	d.[Margin Deposit_Affairs] AS 'MarginDeposit_Affairs',
	(CASE WHEN abs(b.[Margin Deposit_ISS]- d.[Margin Deposit_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'Margindeposit_check',
	b.[Total OD/SOD Loan_ISS] AS 'OD_SOD_Loan_ISS',
	c.[OD/SOD Loan_Affairs] AS 'OD_SOD_Loan_Affairs',
	(CASE WHEN abs(b.[Total OD/SOD Loan_ISS]- c.[OD/SOD Loan_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'OD_SOD_Loan_Affairs_check',
	b.[Total PC/PSC_ISS] AS 'PC_PSC_ISS',
	c.[PC/PSC Loan_Affairs] AS 'PC_PSC_Loan_Affairs',
	(CASE WHEN abs(b.[Total PC/PSC_ISS]- c.[PC/PSC Loan_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'PC_PSC_Loan_check',
	b.[Total ECC_ISS] AS 'ECC_ISS',
	c.[ECC Loan_Affairs] AS 'ECC_Loan_Affairs',
	(CASE WHEN abs(b.[Total ECC_ISS]- c.[ECC Loan_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'ECC_Loan_check',
	b.[PAD (General)_ISS] AS 'PAD_General_ISS',
	c.[Total PAD (General)_Affairs] AS 'PAD_General_Affairs',
	(CASE WHEN abs(b.[PAD (General)_ISS]- c.[Total PAD (General)_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'PAD_General_check',
	b.[PAD (EDF)_ISS] AS 'PAD_EDF_ISS',
	c.[PAD (EDF)_Affairs] AS 'PAD_EDF_Affairs',
	(CASE WHEN abs(b.[PAD (EDF)_ISS]- c.[PAD (EDF)_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'PAD_EDF_check',
	b.[LTR/MPI)_ISS] AS 'LTR_MPI_ISS',
	c.[LTR/MPI)_Affairs] AS 'LTR_MPI_Affairs',
	(CASE WHEN abs(b.[LTR/MPI)_ISS]- c.[LTR/MPI)_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'LTR_MPI_check',
	b.LIM_ISS,
	c.LIM_Affairs,
	(CASE WHEN abs(b.LIM_ISS- c.LIM_Affairs)<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'LIM_check',
	b.[IBP/LDBP_ISS] AS 'IBP_LDBP_ISS',
	c.[IBP/LDBP_Affairs] AS 'IBP_LDBP_Affairs',
	(CASE WHEN abs(b.[IBP/LDBP_ISS]-c.[IBP/LDBP_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'IBP_LDBP_check',
	b.FDBP_ISS,
	c.FDBP_Affairs,
	(CASE WHEN abs(b.FDBP_ISS-c.FDBP_Affairs)<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'FDBP_check',
	b.[Total Loan Against Credit Cards_ISS] AS 'LoanAgainstCreditCards_ISS',
	c.[Credit Card_Affairs] AS 'LoanAgainstCreditCards_Affairs',
	(CASE WHEN abs(b.[Total Loan Against Credit Cards_ISS]-c.[Credit Card_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'LoanAgainstCreditCards_check',
	b.[Temporary Over Draft(TOD) Outstanding_ISS] AS 'TOD_Outstanding_ISS',
	c.TOD_Affairs AS 'TOD_Outstanding_Affairs',
	(CASE WHEN abs(b.[Temporary Over Draft(TOD) Outstanding_ISS]-c.TOD_Affairs)<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'TOD_Outstanding_check',
	b.[Total TOD Against Cash Incentive_ISS] AS 'TODAgainstCashIncentive_ISS',
	c.[Loan Agt.Cash Subsidy/Cash Asstt_Affairs] AS 'TODAgainstCashIncentive_Affairs',
	(CASE WHEN abs(b.[Total TOD Against Cash Incentive_ISS]-c.[Loan Agt.Cash Subsidy/Cash Asstt_Affairs])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'TODAgainstCashIncentive_check',
	b.[Yearly Deposit Target] AS 'Deposit_Target_ISS', 
	e.deposit_tgt_tms,
	(CASE WHEN abs(b.[Yearly Deposit Target]-e.deposit_tgt_tms)<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'Deposit_Target_check',
	b.[Yearly Loan Target] AS 'Adavnce_Target_ISS',
	e.advance_tgt_tms,
	(CASE WHEN abs(b.[Yearly Loan Target]-e.advance_tgt_tms)<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'Advanced_Target_check' 
	FROM Db_DP_Collection_mgr..allinformation AS a 
	JOIN
	(
	SELECT 
	BRANCH_ID,
	SUM(CASE WHEN SUPERVISION_COA_ID='1010221' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Suspense Account_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010209' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Accrued Income_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010222' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total amount of Protested Bill_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010223' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Stationary & Stamp_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010265' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Current Deposit_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010266' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Savings Deposit_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010267' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total STD_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010268' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Term Deposit_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010270' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Margin Deposit_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010271' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Sundry Deposit_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010280' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Local DD, TT, MT & PO Payable_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010480' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total OD/SOD Loan_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010505' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total PC/PSC_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010510' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total ECC_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010500' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [PAD (General)_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010615' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [PAD (EDF)_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010490' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [LTR/MPI)_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010495' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [LIM_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010530' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [IBP/LDBP_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010535' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [FDBP_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010517' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Loan Against Credit Cards_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010565' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Temporary Over Draft(TOD) Outstanding_ISS],
	SUM(case when SUPERVISION_COA_ID='1010566' then convert(numeric(18,2),AMOUNT_BDT) else 0 end) as  [Total TOD Against Cash Incentive_ISS],
	SUM(case when SUPERVISION_COA_ID='1010218' then convert(numeric(18,2),AMOUNT_BDT) else 0 end) as  [Yearly Deposit Target],
	SUM(case when SUPERVISION_COA_ID='1010406' then convert(numeric(18,2),AMOUNT_BDT) else 0 end) as  [Yearly Loan Target]
	FROM db_mis_ISS.dbo.$tbl_iss 
	GROUP BY BRANCH_ID
	) b ON '12'+a.bbbrcode=b.BRANCH_ID
	JOIN
	(
	SELECT   
	bcode,
	SUM(CASE WHEN LEFT(sub_head,5)  IN ('10705')  THEN convert(money,amount)   ELSE 0 END) AS [Suspense Account_Affairs],
	SUM(CASE WHEN sub_head  IN ('10703','10704')  THEN convert(money,amount)   ELSE 0 END) AS [Stationary & Stamp_Affairs],
	SUM(CASE WHEN sub_head  IN ('00201','00202','00203','00205','00206','00207','00208','00209')  THEN convert(money,amount)   ELSE 0 END) AS [Current Deposit_Affairs],
	SUM(CASE WHEN sub_head  IN ('00210','00211','00214','00235','00217','00224')  THEN convert(money,amount)   ELSE 0 END) AS [Saving Deposit_Affairs],
	SUM(CASE WHEN sub_head  IN ('00212','00215','00216')  THEN convert(money,amount)   ELSE 0 END) AS [Total STD_Affairs],
	SUM(CASE WHEN sub_head  IN ('00213')  THEN convert(money,amount)   ELSE 0 END) AS [Total Term Deposit_Affairs],
	SUM(CASE WHEN sub_head  IN ('00204')  THEN convert(money,amount)   ELSE 0 END) AS [Sundry Deposit_Affairs],
	SUM(CASE WHEN sub_head  IN ('00301','00303','00304','00305')  THEN convert(money,amount)   ELSE 0 END) AS [Local DD, TT, MT & PO Payable_Affairs],
	SUM(CASE WHEN sub_head  IN ('10501','10503','10503','10503','10503')  THEN convert(money,amount)   ELSE 0 END) AS [OD/SOD Loan_Affairs],
	SUM(CASE WHEN sub_head  IN ('10409')  THEN convert(money,amount)   ELSE 0 END) AS [PC/PSC Loan_Affairs],
	SUM(CASE WHEN sub_head  IN ('10505')  THEN convert(money,amount)   ELSE 0 END) AS [ECC Loan_Affairs],
	SUM(CASE WHEN sub_head  IN ('10604','10605','10607','10609','10611','10615')  THEN convert(money,amount)   ELSE 0 END) AS [Total PAD (General)_Affairs],
	SUM(CASE WHEN sub_head  IN ('10616')  THEN convert(money,amount)   ELSE 0 END) AS [PAD (EDF)_Affairs],
	SUM(CASE WHEN sub_head  IN ('10408')  THEN convert(money,amount)   ELSE 0 END) AS [LTR/MPI)_Affairs],
	SUM(CASE WHEN sub_head  IN ('10406')  THEN convert(money,amount)   ELSE 0 END) AS [LIM_Affairs],
	SUM(CASE WHEN sub_head  IN ('10602','10614')  THEN convert(money,amount)   ELSE 0 END) AS [IBP/LDBP_Affairs],
	SUM(CASE WHEN sub_head  IN ('10606','10608','10612','10613')  THEN convert(money,amount)   ELSE 0 END) AS [FDBP_Affairs],
	SUM(CASE WHEN sub_head  IN ('10422')  THEN convert(money,amount)   ELSE 0 END) AS [Credit Card_Affairs],
	SUM(CASE WHEN sub_head  IN ('10502')  THEN convert(money,amount)   ELSE 0 END) AS [TOD_Affairs],
	SUM(CASE WHEN sub_head  IN ('10424')  THEN convert(money,amount)   ELSE 0 END) AS [Loan Agt.Cash Subsidy/Cash Asstt_Affairs]
	FROM [Db_DP_Collection_mgr].[dbo].[$tbl_affairs] 
	GROUP BY bcode
	) c ON c.bcode=a.brcode
	JOIN
	(
	SELECT   
	bcode,
	SUM(CASE WHEN [scode]  IN ('1071444')  THEN convert(money,amount)   ELSE 0 END) AS [S/A-Intt.Rec. A/c Accrued Intt],
	SUM(CASE WHEN [scode]  IN ('1071409')  THEN convert(money,amount)   ELSE 0 END) AS [Protested Bill_Affairs],
	SUM(CASE WHEN [scode]  IN ('0020409','0020410','0020411' ,'0020412','0020407','0020404','0020406','0020405','0020408')  THEN convert(money,amount)   ELSE 0 END) AS [Margin Deposit_Affairs]
	FROM [Db_DP_Collection_mgr].[dbo].[$tbl_backpage]
	GROUP BY bcode 
	) d ON d.bcode=a.brcode 
	JOIN(
		select tms_data_off_code,
		SUM(CASE WHEN tms_data_sg_code  IN ('101') THEN convert(money, tms_data_amt) ELSE 0 END) AS [deposit_tgt_tms],
		SUM(CASE WHEN tms_data_sg_code  IN ('301') THEN convert(money, tms_data_amt) ELSE 0 END) AS [advance_tgt_tms]
		from [Db_DP_Collection_mgr].[dbo].[tms_data_detail] where tms_data_yr=$omis_year
		group by tms_data_off_code
		) e ON e.tms_data_off_code=a.brcode AND a.brcode in $IN_con
	order by a.dvname, a.branchname");	

	
	return $cross_data->result();
	
	}
}
///////////////////////////iss2_0005 report end/////////////////////////////////

///////////////////////////iss2_0006 report start/////////////////////////////////
function fetch_iss2_0006_data($branch_id_array_for_report=array(),$report_of_date1='')
{
	$omis_year = date('Y', strtotime($report_of_date1));
	$omis_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_pl = 'PL'.$omis_month.$omis_year;
	
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}
	//SET NUMERIC_ROUNDABORT OFF 
	$cross_data =  $legacy_db->query(" 
	SELECT a.dvname, a.znname, a.branchname, a.brcode,
	a.bbbrcode, a.OfficePhone, b.[Total Income_ISS] AS 'TotalIncome_ISS',
	c.[Total Income_PL] AS 'TotalIncome_PL',
	(CASE WHEN abs(b.[Total Income_ISS]- c.[Total Income_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'TotalIncome_check',
	b.[Total Interest Income_ISS] AS 'Interest_Income_ISS',
	c.[Total Interst Income_PL] AS 'Interst_Income_PL',
	(CASE WHEN abs(b.[Total Interest Income_ISS]- c.[Total Interst Income_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'interestIncome_check',
	b.[Non Interest Income_ISS] AS 'nonInterestIncome_ISS',
	c.[Non Interest Income_PL] AS 'nonInterestIncome_PL',
	(CASE WHEN abs(b.[Non Interest Income_ISS]- c.[Non Interest Income_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'nonInterestIncome_check',
	b.[Net Interest Income_ISS] AS 'netInttIncome_ISS',
	c.[Total Interst Income_PL]-c.[Interest Expense_PL] AS 'netInttIncome_PL',
	(CASE WHEN abs(b.[Net Interest Income_ISS]- (c.[Total Interst Income_PL]-c.[Interest Expense_PL]))<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'netInttIncome_check',
	b.[Gross Profit(+/-)_ISS] AS 'grossProfitPosNeg_ISS',
	c.[Total Income_PL]-c.[Total Expense_PL] AS  'grossProfitPosNeg_PL',
	(CASE WHEN abs(b.[Gross Profit(+/-)_ISS]- (c.[Total Income_PL]-c.[Total Expense_PL]))<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'grossProfitPosNeg_check',
	b.[Total Interest Expenses_ISS] AS 'interestExpenses_ISS',
	c.[Interest Expense_PL] AS 'interestExpense_PL',
	(CASE WHEN abs(b.[Total Interest Expenses_ISS]- c.[Interest Expense_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'interestExpenses_check',
	b.[Total Operating Expenditure_ISS] AS 'operatingExpenditure_ISS',
	c.[Total Operating Expense_PL] AS 'operatingExpense_PL',
	(CASE WHEN abs(b.[Total Operating Expenditure_ISS]- c.[Total Operating Expense_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'operatingExpenditure_check',
	b.[Administrative Cost_ISS] AS 'administrativeCost_ISS',
	c.[Administrative Cost1_PL]+c.[Administrative Cost2_PL] AS 'administrativeCost_PL',
	(CASE WHEN abs(b.[Administrative Cost_ISS]- (c.[Administrative Cost1_PL]+c.[Administrative Cost2_PL]))<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'administrativeCost_check',
	b.[Office Maintenance Expenses_ISS] AS 'officeMaintenanceExp_ISS',
	c.[Office Maintenaance Ex_PL] AS 'officeMaintenanceExp_PL',
	(CASE WHEN abs(b.[Office Maintenance Expenses_ISS]- c.[Office Maintenaance Ex_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'officeMaintenanceExp_check',
	b.[Branch Renovation Cost_ISS] AS 'branchRenovationCost_ISS',
	c.[Branch Renovation Cost_PL] AS 'branchRenovationCost_PL',
	(CASE WHEN abs(b.[Branch Renovation Cost_ISS]- c.[Branch Renovation Cost_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'branchRenovationCost_check',
	b.[Total Business Development Expenses_ISS] AS 'businessDevelopmentExp_ISS',
	c.[Business Development Expenses_PL] AS 'businessDevelopmentExp_PL',
	(CASE WHEN abs(b.[Total Business Development Expenses_ISS]- c.[Business Development Expenses_PL])<2 THEN 'Ok' ELSE 'Mismatch' END)  AS 'businessDevelopmentExp_check',

	b.[Total Operating Expenditure_ISS]-(b.[Administrative Cost_ISS]+b.[Office Maintenance Expenses_ISS]+b.[Branch Renovation Cost_ISS]+b.[Total Business Development Expenses_ISS]) AS 'Other_expenditure_ISS',
	c.[Total Operating Expense_PL]-(c.[Administrative Cost1_PL]+c.[Administrative Cost2_PL]+c.[Office Maintenaance Ex_PL]+c.[Branch Renovation Cost_PL]+c.[Business Development Expenses_PL]) AS 'Other_expenditure_PL',
	(CASE WHEN abs((b.[Total Operating Expenditure_ISS]-(b.[Administrative Cost_ISS]+b.[Office Maintenance Expenses_ISS]+b.[Branch Renovation Cost_ISS]+b.[Total Business Development Expenses_ISS])) -
	(c.[Total Operating Expense_PL]-(c.[Administrative Cost1_PL]+c.[Administrative Cost2_PL]+c.[Office Maintenaance Ex_PL]+c.[Branch Renovation Cost_PL]+c.[Business Development Expenses_PL]))) <2 
	THEN 'Ok' ELSE 'Mismatch' END)  AS 'Other_Expenditure_check'

	FROM Db_DP_Collection_mgr..allinformation AS a 
	JOIN
	(
	SELECT 
	BRANCH_ID,
	SUM(CASE WHEN SUPERVISION_COA_ID='1011105' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Income_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011110' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Interest Income_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011115' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Non Interest Income_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011118' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Net Interest Income_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011100' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Gross Profit(+/-)_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011122' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Interest Expenses_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011120' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Operating Expenditure_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011121' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Administrative Cost_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011125' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Other Expenditure_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011144' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Office Maintenance Expenses_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011124' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Branch Renovation Cost_ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1011130' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Business Development Expenses_ISS]
	FROM db_mis_ISS.dbo.$tbl_iss 
	GROUP BY BRANCH_ID
	) b ON '12'+a.bbbrcode=b.BRANCH_ID
	JOIN
	(
	SELECT   
	bcode,
	SUM(CASE WHEN LEFT(scode,3) IN ('201','202','203','204','205','206','207','208','209','210','210','211','212') THEN convert(money, amount) ELSE 0 END) AS [Total Income_PL],
	SUM(CASE WHEN LEFT(scode,3) IN ('201','209','210')  THEN convert(money, amount) ELSE 0 END) AS [Total Interst Income_PL],
	SUM(CASE WHEN LEFT(scode,3) IN ('202','203','204','205','206','207','208','210','211','212') THEN convert(money, amount) ELSE 0 END) AS [Non Interest Income_PL],
	SUM(CASE WHEN LEFT(scode,3) IN ('301','310','311') THEN convert(money, amount) ELSE 0 END) AS [Interest Expense_PL],
	SUM(CASE WHEN LEFT(scode,3) IN ('301','302','303','304','305','306','307','308','309','310','311','312','313','314','315','316','317','318','319') THEN convert(money, amount) ELSE 0 END) AS [Total Expense_PL],
	SUM(CASE WHEN LEFT(scode,3) IN ('302','303','304','305','306','307','308','309','312','313','314','315','316','317','318','319') THEN convert(money, amount) ELSE 0 END) AS [Total Operating Expense_PL],
	SUM(CASE WHEN LEFT(scode,3) IN ('302','313') THEN convert(money, amount) ELSE 0 END) AS [Administrative Cost1_PL],
	SUM(CASE WHEN LEFT(scode,5) IN ('30909','30910','30600') THEN convert(money, amount) ELSE 0 END) AS [Administrative Cost2_PL],
	SUM(CASE WHEN LEFT(scode,5) IN ('30301','30302','30303','30500','30801','30802','30803','30400','31200','31400','31500') THEN convert(money, amount) ELSE 0 END) AS [Office Maintenaance Ex_PL],
	SUM(CASE WHEN scode IN ('30703', '30701') THEN convert(money, amount) ELSE 0 END) AS [Branch Renovation Cost_PL],
	SUM(CASE WHEN scode IN ('30908') THEN convert(money, amount) ELSE 0 END) AS [Business Development Expenses_PL]
	FROM Db_DP_Collection_mgr.dbo.$tbl_pl 
	GROUP BY bcode
	) c ON c.bcode=a.brcode AND a.brcode in $IN_con
	order by a.dvname, a.branchname");	
	
	return $cross_data->result();
	
	}
}
///////////////////////////iss2_0006 report end/////////////////////////////////

///////////////////////////iss2_0007 report start/////////////////////////////////
function fetch_iss2_0007_data($branch_id_array_for_report=array(), $report_of_date1='')
{
	$cl_year = date('Y', strtotime($report_of_date1));
	$cl_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_cl1 = 'cl1_misd';
	
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}
		
	//SET NUMERIC_ROUNDABORT OFF 
	$cross_data =  $legacy_db->query("select x.dvname, x.znname, x.branchname, x.OfficePhone, y.BRANCH_ID, 
	y.Standard_CL,
	y.Standard_ISS,
	(CASE WHEN abs(y.Standard_CL-y.Standard_ISS)<9 THEN 'Ok' ELSE 'Mismatch' end) AS 'standardLoan_Check',
	y.SMA_CL,
	y.SMA_ISS,
	(CASE WHEN abs(y.SMA_CL- y.SMA_ISS)<9 THEN 'Ok' ELSE 'Mismatch' end) AS 'SMALoan_Check',
	y.SS_CL,
	y.SS_ISS,
	(CASE WHEN abs(y.SS_CL- y.SS_ISS )<9 THEN 'Ok' ELSE 'Mismatch' end) AS 'SSLoan_Check',
	y.DF_CL,
	y.DF_ISS,
	(CASE WHEN abs(y.DF_CL- y.DF_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'DFLoan_Check',
	y.BL_CL,
	y.BL_ISS,
	(CASE WHEN abs(y.BL_CL- y.BL_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'BLLoan_Check',
	y.Standard_CL+y.SMA_CL+y.SS_CL+y.DF_CL+y.BL_CL AS 'totalLoanOutstanding_CL',
	y.Total_loan_ISS AS 'totalLoanOutstanding_ISS',
	(CASE WHEN abs((y.Standard_CL+y.SMA_CL+y.SS_CL+y.DF_CL+y.BL_CL)- y.Total_loan_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'totalLoanOutstanding_Check',
	y.Base_for_prov_CL,
	y.Base_for_prov_ISS,
	(CASE WHEN abs(y.Base_for_prov_CL- y.Base_for_prov_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'Base_for_pro_Check',
	y.prov_Req_CL,
	y.prov_Req_ISS,
	(CASE WHEN abs(y.prov_Req_CL- y.prov_Req_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'provReq_Check',
	y.Int_Susp_Loan_CL,
	y.Int_Susp_Loan_ISS,
	(CASE WHEN abs(y.Int_Susp_Loan_CL- y.Int_Susp_Loan_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'intSuspLoan_Check',
	y.Microcredit_CL,
	y.microcredit_ISS,
	(CASE WHEN abs(y.Microcredit_CL- y.microcredit_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'microcredit_Check',
	y.Staff_CL AS 'staffLoan_CL',
	y.staffloan_ISS,
	(CASE WHEN abs(y.Staff_CL- y.staffloan_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'staffLoan_Check',
	isnull(y.SME_CL,0) SME_CL,
	y.SME_ISS,  
	(CASE WHEN abs(y.SME_CL- y.SME_ISS) <9 THEN 'Ok' ELSE 'Mismatch' end) AS 'SMELoan_Check'
	FROM 
	(
	 SELECT   
	dvname, znname, brcode, bbbrcode, branchname, [Address], OfficePhone   
	FROM [db_mis_ISS].[dbo].[allinformation] WHERE brcode not in (0931, 0932, 0933, 0934, 9999)
	AND brcode in $IN_con) 
	x left join
	(
	SELECT 
	a.BRANCH_ID, isnull(b.SME_CL,0) SME_CL, b.Standard_CL, b.SMA_CL,b.SS_CL,
	b.DF_CL, b.BL_CL, b.Base_for_prov_CL, b.prov_Req_CL, b.Int_Susp_Loan_CL ,
	a.SME_ISS,a.Standard_ISS,a.SMA_ISS, a.SS_ISS, a.DF_ISS, a.BL_ISS,
	a.Int_Susp_Loan_ISS, a.Base_for_prov_ISS, a.prov_Req_ISS, a.Total_loan_ISS,
	b.Microcredit_CL, a.microcredit_ISS, b.Staff_CL, a.staffloan_ISS 
	FROM (SELECT 
	[BRANCH_ID],
	sum(CASE WHEN SUPERVISION_COA_ID ='1010545' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as SME_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010420' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as Standard_ISS,   
	sum(CASE WHEN SUPERVISION_COA_ID ='1010425' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as SMA_ISS, 
	sum(CASE WHEN SUPERVISION_COA_ID ='1010430' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as SS_ISS, 
	sum(CASE WHEN SUPERVISION_COA_ID ='1010435' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as DF_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010440' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as BL_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010450' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as Int_Susp_Loan_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010455' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as Base_for_prov_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010460' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as prov_Req_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010405' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as Total_loan_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010518' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as microcredit_ISS,
	sum(CASE WHEN SUPERVISION_COA_ID ='1010520' THEN  convert(money,[AMOUNT_BDT]) ELSE 0 END) as staffloan_ISS
	FROM [db_mis_ISS].[dbo].[$tbl_iss] 
	group by [BRANCH_ID]
	) a  left join		  
	(SELECT 
	[bbbrcode],
	SUM(case when scode IN(11, 21, 31) then [ucstand]+[ucsma]+[c_ss]+[c_df]+[c_bl] else 0 end) as SME_CL,
	SUM([ucstand]) as Standard_CL,
	SUM([ucsma]) as SMA_CL,
	SUM([c_ss]) as SS_CL,
	SUM([c_df]) as DF_CL,
	SUM([c_bl]) as BL_CL,
	SUM([p_sma]+[p_ss]+[p_df]+[p_bl]) as Base_for_prov_CL, 
	SUM([p_req])  as prov_Req_CL,
	SUM([is_ucs]+[is_sma]+[is_class]) as Int_Susp_Loan_CL,
	SUM(case when scode IN(42) then [ucstand]+[ucsma]+[c_ss]+[c_df]+[c_bl] else 0 end)  as Microcredit_CL,
	SUM(case when scode IN(61) then [ucstand]+[ucsma]+[c_ss]+[c_df]+[c_bl] else 0 end)  as Staff_CL
	FROM [branchinfo].[dbo].[$tbl_cl1] where myear =$cl_year and mmonth=$cl_month 
	group by [bbbrcode] ) b
	on a.BRANCH_ID='12'+b.bbbrcode
	) y
	on '12'+x.bbbrcode= y.BRANCH_ID 
	order by x.dvname, x.znname, x.branchname");	

	return $cross_data->result();
	
	}
}
///////////////////////////iss2_0007 report end/////////////////////////////////

///////////////////////////iss2_0008 report start/////////////////////////////////
function fetch_iss2_0008_data($branch_id_array_for_report=array(), $report_of_date1='')
{
	$pl_year = date('Y', strtotime($report_of_date1));
	$pl_month = date('m', strtotime($report_of_date1));
	$tbl_pl = 'PL'.$pl_month.$pl_year;
	
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	
	$IN_con='';
	if($count_in_branch>0)
	{
		$IN_con="(";
		foreach($branch_id_array_for_report as $key=>$val)
		{
			$brcode = $val['jbbrcode'];
			$IN_con.="'".$brcode."'";
			if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
		}
		$IN_con .=")";
	}
		
	//SET NUMERIC_ROUNDABORT OFF 
	$cross_data =  $legacy_db->query("
	select y.scode, y.Sub_Head_Code, y.Sub_Head_Name, y.Indication, sum(y.amount) as amount from
		(SELECT dvname, znname, branchname, brcode, bbbrcode, OfficePhone
	FROM Db_DP_Collection_mgr..allinformation) x
	JOIN
	(	
	select a.bcode, a.scode, b.Sub_head_code, b.sub_head_name, a.amount, a.Indication
	  from 
		(Select bcode, scode, SUM(convert(numeric(18,2), amount)) amount, 
		CASE
		   WHEN LEFT(scode, 3) IN ('201', '209', '210') THEN 'INTEREST INCOME' 
		   WHEN LEFT(scode, 3) IN ('202', '203', '204', '205', '206', '207', '208', '210', '211', '212') THEN 'NON-INTEREST INCOME'
		   WHEN LEFT(scode, 3) IN ('301', '310', '311') THEN 'INTEREST EXPENSE' 	 
		   WHEN LEFT(scode, 5) IN ('30201', '30202', '30203', '30204', '30205', '30206', '30207', '30208', '30209', '31300', '30909', '30910', '30600') THEN 'ADMINISTRATIVE_COST' 
		   WHEN LEFT(scode, 5) IN ('30301', '30302', '30303', '30500', '30801', '30802', '30803', '30400', '31200', '31400', '31500') THEN 'OFFICE MAINTENANCE EXPENSE'
		   WHEN LEFT(scode, 5) IN ('30703', '30701', '30702') THEN 'BRANCH RENOVATION COST'
		   WHEN LEFT(scode, 5) IN ('30908') THEN 'BUSINESS DEVELOPMENT EXPENSES'
		   else 'OTHER EXPENDITURE' 
	   end  
		AS Indication
	FROM Db_DP_Collection_mgr..$tbl_pl
	group by bcode,scode
	having bcode in $IN_con ) AS a
		JOIN 
		(select distinct Sub_head_code, sub_head_name from Db_DP_Collection_mgr..DSACODE) b 
		 ON a.scode=b.Sub_Head_Code  and a.bcode in $IN_con
		)  y
	on x.brcode=y.bcode
	group by y.scode, y.Sub_Head_Code, y.Sub_Head_Name, y.Indication
	order by y.Sub_Head_Code");	

	return $cross_data->result();
}
///////////////////////////iss2_0008 report end/////////////////////////////////

///////////////////////////iss2_0009 report start/////////////////////////////////
function fetch_iss2_0009_data($branch_id_array_for_report=array(), $report_of_date1='')
{
	$omis_year = date('Y', strtotime($report_of_date1));
	$omis_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_omis = 'omis_data_'.$omis_year.'_'.$omis_month;
	
	
	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}
		
	//SET NUMERIC_ROUNDABORT OFF 
	$cross9_data =  $legacy_db->query("
	SELECT 
	a.dvname, a.znname, a.branchname, a.brcode, a.bbbrcode, b.BRANCH_ID, a.OfficePhone, 
	b.[Total Standard Loan-ISS] AS 'Standard_Loan_ISS', d.[Total Standard Loan-OMIS] AS 'Standard_Loan_OMIS',
	(CASE WHEN abs(b.[Total Standard Loan-ISS]- d.[Total Standard Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Standard_Loan_check',
	b.[Total SMA Loan-ISS] AS 'SMA_Loan_ISS', d.[Total SMA Loan-OMIS] AS 'SMA_Loan_OMIS',
	(CASE WHEN abs(b.[Total SMA Loan-ISS]- d.[Total SMA Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'SMA_Loan_check',
	b.[Total Substandard Loan-ISS] AS 'Substandard_Loan_ISS', d.[Total Substandard Loan-OMIS] AS 'Substandard_Loan_OMIS',
	(CASE WHEN abs(b.[Total Substandard Loan-ISS]- d.[Total Substandard Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Substandard_Loan_check',
	b.[Total Doubtful Loan-ISS] AS 'Doubtful_Loan_ISS', d.[Total Doubtful Loan-OMIS] AS 'Doubtful_Loan_OMIS',
	(CASE WHEN abs(b.[Total Doubtful Loan-ISS]- d.[Total Doubtful Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Doubtful_Loan_check',
	b.[Total Bad Loan-ISS] AS 'Bad_Loan_ISS', d.[Total Bad Loan-OMIS] AS 'Bad_Loan_OMIS',
	(CASE WHEN abs(b.[Total Bad Loan-ISS]- d.[Total Bad Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Bad_Loan_check',
	b.[Total Loan Outstanding-ISS] AS 'Total_Loan_Outstanding_ISS', d.[Total Loan Outstanding-OMIS] AS 'Total_Loan_Outstanding_OMIS',
	(CASE WHEN abs(b.[Total Loan Outstanding-ISS]- d.[Total Loan Outstanding-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Total_Loan_Outstanding_check',
	b.[Total Interest Suspense Balance-ISS] AS 'Total_Int_Sus_Balance_ISS', d.[Total Interest Suspense Balance-OMIS] AS 'Total_Int_Sus_Balance_OMIS',
	(CASE WHEN abs(b.[Total Interest Suspense Balance-ISS]- d.[Total Interest Suspense Balance-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Intt_Sus_Balance_check',
	b.[Total Staff Loan-ISS] AS 'Staff_Loan_ISS', d.[Total Staff Loan-OMIS] AS 'Staff_Loan_OMIS',
	(CASE WHEN abs(b.[Total Staff Loan-ISS]- d.[Total Staff Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Staff_Loan_check',
	b.[Total SME Loan Outstanding-ISS] AS 'SME_Loan_Outstanding_ISS', d.[Total SME Loan Outstanding-OMIS] AS 'SME_Loan_Outstanding_OMIS',
	(CASE WHEN abs(b.[Total SME Loan Outstanding-ISS]- d.[Total SME Loan Outstanding-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'SME_Loan_check',
	b.[Total Term Loan-ISS] AS 'Term_Loan_ISS', d.[Total Term Loan-OMIS] AS 'Term_Loan_OMIS',
	(CASE WHEN abs(b.[Total Term Loan-ISS]- d.[Total Term Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'Term_Loan_check',
	b.[Total Loan Outstanding against FDBP-ISS] AS 'Loan_Outst_against_FDBP_ISS', d.[FDBP Loan-OMIS] AS 'Loan_Outst_against_FDBP_OMIS',
	(CASE WHEN abs(b.[Total Loan Outstanding against FDBP-ISS]- d.[FDBP Loan-OMIS])>2 THEN 'Mismatch' ELSE 'OK' end) AS 'FDBP_OMIS_check'
	FROM Db_DP_Collection_mgr..allinformation AS a 
	JOIN
	(
	SELECT 
	BRANCH_ID,
	SUM(CASE WHEN SUPERVISION_COA_ID='1010420' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Standard Loan-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010425' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total SMA Loan-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010430' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Substandard Loan-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010435' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Doubtful Loan-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010440' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Bad Loan-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010405' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Loan Outstanding-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010540' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Interest Suspense Balance-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010520' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Staff Loan-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010545' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total SME Loan Outstanding-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010485' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Term Loan-ISS],
	SUM(CASE WHEN SUPERVISION_COA_ID='1010535' THEN convert(numeric(18,2),AMOUNT_BDT) ELSE 0 END) AS  [Total Loan Outstanding against FDBP-ISS]
	FROM db_mis_ISS.dbo.$tbl_iss 
	GROUP BY BRANCH_ID
	) b ON '12'+a.bbbrcode=b.BRANCH_ID
	JOIN
	(
	SELECT   
	dd_jo_code,
	SUM(CASE WHEN dd_pt_id  IN ('1801')  THEN dd_amt   ELSE 0 END) AS [Total Standard Loan-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('1805')  THEN dd_amt   ELSE 0 END) AS [Total SMA Loan-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('1809')  THEN dd_amt   ELSE 0 END) AS [Total Substandard Loan-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('1813')  THEN dd_amt   ELSE 0 END) AS [Total Doubtful Loan-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('1817')  THEN dd_amt   ELSE 0 END) AS [Total Bad Loan-OMIS],    
	SUM(CASE WHEN dd_pt_id  IN ('1801','1805','1809','1813','1817')  THEN dd_amt   ELSE 0 END) AS [Total Loan Outstanding-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('901')  THEN dd_amt   ELSE 0 END) AS [Total Interest Suspense Balance-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('621')  THEN dd_amt   ELSE 0 END) AS [Total Staff Loan-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('5401','5405','5409')  THEN dd_amt   ELSE 0 END) AS [Total SME Loan Outstanding-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('609')  THEN dd_amt   ELSE 0 END) AS [Total Term Loan-OMIS],
	SUM(CASE WHEN dd_pt_id  IN ('6601','6605')  THEN dd_amt   ELSE 0 END) AS [FDBP Loan-OMIS]
	FROM Db_DP_Collection_mgr..$tbl_omis 
	WHERE
	dd_end_dt=(select a.om_dat_date from 
	(select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
	WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $omis_year and 
	SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $omis_month) a 
	where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
	from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
	WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $omis_year and 
	SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $omis_month))
	AND dd_jo_code NOT IN (0931,0932,0933,0934) AND dd_jo_code in $IN_con
	GROUP BY dd_jo_code ) d ON d.dd_jo_code=a.brcode");	

	return $cross9_data->result();
	
	}
}
///////////////////////////iss2_0009 report end/////////////////////////////////

///////////////////////////iss2_0010 report start/////////////////////////////////
function fetch_iss2_0010_data($branch_id_array_for_report=array(), $report_of_date1='')
{
	$omis_year = date('Y', strtotime($report_of_date1));
	$omis_month = date('m', strtotime($report_of_date1));
	
	$tbl_iss = $this->get_iss_data_tbl_name($report_of_date1);
	$tbl_omis = 'omis_data_'.$omis_year.'_'.$omis_month;
	
	$bbCl2 = 'BBCL2_'.$omis_month.'_'.$omis_year; //BBCL2_06_2019
	$bbCl3 = 'BBCL3_'.$omis_month.'_'.$omis_year; //BBCL3_06_2019
	$bbCl4 = 'BBCL4_'.$omis_month.'_'.$omis_year; //BBCL4_06_2019

	$count_in_branch=count($branch_id_array_for_report);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_iss) == FALSE)
	{
		return 0;
	}
	else
	{
		$IN_con='';
		if($count_in_branch>0)
		{
			$IN_con="(";
			foreach($branch_id_array_for_report as $key=>$val)
			{
				$brcode = $val['jbbrcode'];
				$IN_con.="'".$brcode."'";
				if($count_in_branch>1 && $key != ($count_in_branch-1)){$IN_con .=",";}
			}
			$IN_con .=")";
		}
	//SET NUMERIC_ROUNDABORT OFF 
	$cross10_data =  $legacy_db->query("select a.dvname, a.znname, a.branchname, a.brcode, a.bbbrcode, a.OfficePhone, 
	b.[SME Loan Outstanding_june19] AS SME_ISS,
	isnull(cl2.CL2_SME, 0) + isnull(cl3.CL3_SME, 0) + isnull(cl4.CL4_SME, 0) SME_OLCL, sme_omis.[SME_OMIS],
	(CASE WHEN b.[SME Loan Outstanding_june19] != (isnull(cl2.CL2_SME, 0) + isnull(cl3.CL3_SME, 0) + isnull(cl4.CL4_SME, 0))
	OR (isnull(cl2.CL2_SME, 0) + isnull(cl3.CL3_SME, 0) + isnull(cl4.CL4_SME, 0)) != sme_omis.[SME_OMIS] 
	OR sme_omis.[SME_OMIS] != b.[SME Loan Outstanding_june19] THEN 'Mismatch' ELSE 'Ok' end) AS 'SME_Check'
	from Db_DP_Collection_mgr..allinformation a left join
	(select BRANCH_ID,
	sum(case when SUPERVISION_COA_ID='1010545' then convert(numeric(18, 2), AMOUNT_BDT) else 0 end) as [SME Loan Outstanding_june19]
	from db_mis_ISS.dbo.$tbl_iss group by BRANCH_ID) b on '12'+a.bbbrcode=b.BRANCH_ID
	left join
	(SELECT brcd, sum(isnull(standard_amount,0)+isnull(sma_amount,0)+isnull(ss_amount,0)+isnull(df_amount,0)+isnull(bl_amount,0)) as CL2_SME       
	  FROM [db_mis_CL].[dbo].[$bbCl2] where [cat_loan]='100' group by brcd) cl2
	  on a.[bbbrcode]=cl2.brcd
	  left join  
	  (SELECT brcd, sum(isnull(standard_amount,0)+isnull(sma_amount,0)+isnull(ss_amount,0)+isnull(df_amount,0)+isnull(bl_amount,0)) as CL3_SME      
	  FROM [db_mis_CL].[dbo].[$bbCl3] where [cat_loan]='200' group by brcd) cl3
	  on a.[bbbrcode]=cl3.brcd
	left join  
	  (SELECT brcd, sum(isnull(standard_amount,0)+isnull(sma_amount,0)+isnull(ss_amount,0)+isnull(df_amount,0)+isnull(bl_amount,0))  as CL4_SME     
	  FROM [db_mis_CL].[dbo].[$bbCl4] where [cat_loan]='300' group by brcd) cl4
	  on a.[bbbrcode]=cl4.brcd 
	LEFT JOIN
	(
	SELECT dd_jo_code,
	SUM(CASE WHEN dd_pt_id IN ('5401','5405','5409') THEN dd_amt ELSE 0 END) AS [SME_OMIS]
	FROM [Db_DP_Collection_mgr].[dbo].[$tbl_omis]
	WHERE dd_end_dt= (select a.om_dat_date from 
	(select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
	WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $omis_year and 
	SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $omis_month) a 
	where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
	from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
	WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $omis_year and 
	SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $omis_month))
	AND dd_jo_code NOT IN (0931, 0932, 0933, 0934)
	GROUP BY dd_jo_code ) sme_omis ON sme_omis.dd_jo_code = a.brcode  
	where a.brcode in $IN_con order by a.dvname, a.znname, a.branchname");

	return $cross10_data->result();
	
	}
}
///////////////////////////iss2_0010 report end/////////////////////////////////

/*DRS Start */
function drs903001_data_insert_fun($DATE='')
{
	$status='error';
	
	$tbl_name = $this->get_drs_903001_data_tbl_name_to_insert($DATE);
	
	echo $tbl_name;
	die();
	
	if( $this->table_exists($tbl_name) == FALSE)
	{
			$this->get_drs_903001_data_tbl_name_to_insert($DATE);
	}

	$data = array(
		'drs_903001_rpDate' =>$this->input->post('drs_90300106'),
		'drs_903001_brcode' =>'0512',
		'drs_903001_1_1_val' => $this->input->post('drs_903001_1_1'),
		'drs_903001_1_2_val' => $this->input->post('drs_903001_1_2'),
		'drs_903001_2_1_val' => $this->input->post('drs_903001_2_1'),
		'drs_903001_2_2_val' => $this->input->post('drs_903001_2_2'),
		'drs_903001_2_3_val' => $this->input->post('drs_903001_2_3'),
		'drs_903001_2_4_val' => $this->input->post('drs_903001_2_4'),
		'drs_90300103_val' => $this->input->post('drs_90300103'),
		'drs_90300104_val' => $this->input->post('drs_90300104'),
		'drs_90300105_val' => $this->input->post('drs_90300105'),
		'drs_90300106_val' => $this->input->post('drs_90300106'),
		'drs_90300107_val' => $this->input->post('drs_90300107'),
		'drs_90300108_val' => $this->input->post('drs_90300108'),
		'drs_90300109_val' => $this->input->post('drs_90300109'),
		'drs_90300110_val' => $this->input->post('drs_90300110'),
		'drs_90300111_val' => $this->input->post('drs_90300111'),
		'drs_90300112_val' => $this->input->post('drs_90300112'),
		'drs_90300113_val' => $this->input->post('drs_90300113'),
		'drs_90300114_val' => $this->input->post('drs_90300114'),
		'drs_90300115_val' => $this->input->post('drs_90300115'),
		'drs_90300116_val' => $this->input->post('drs_90300116'),
		'drs_90300117_val' => $this->input->post('drs_90300117'),
		'drs_90300118_val' => $this->input->post('drs_90300118'),
		'drs_90300119_val' => $this->input->post('drs_90300119'),
		'drs_90300120_val' => $this->input->post('drs_90300120'),
		'drs_90300121_val' => $this->input->post('drs_90300121'),
		'drs_90300122_val' => $this->input->post('drs_90300122'),
		'drs_90300123_val' => $this->input->post('drs_90300123'),
		'drs_90300124_val' => $this->input->post('drs_90300124'),
		'drs_90300125_val' => $this->input->post('drs_90300125'),
		'drs_90300126_val' => $this->input->post('drs_90300126'),
		'drs_90300127_val' => $this->input->post('drs_90300127'),
		'drs_90300128_val' => $this->input->post('drs_90300128'),
		'drs_90300129_val' => $this->input->post('drs_90300129'),
		'drs_90300130_val' => $this->input->post('drs_90300130'),
		'drs_90300131_val' => $this->input->post('drs_90300131'),
		'drs_90300132_val' => $this->input->post('drs_90300132'),
		'drs_90300133_val' => $this->input->post('drs_90300133'),
		'drs_903001_uid'   => $this->session->userdata('some_uid'),
		'drs_903001_submitDate' => date('m/d/Y h:i:s a', time())
	);
	if($this->add_drs903001_data($data, $iss1_report_date_val) ==1)
	{
		$status='success';
	}
	return $status;
}

function add_drs903001_data($data, $DATE)
{
	$tbl_name = $this->get_drs_903001_data_tbl_name_to_insert($DATE);	
	if($this->insert($tbl_name, $data))
	{
		return 1;
	}
	else
	{
		return 0;
	}

}
function get_drs_903001_data_tbl_name_to_insert($date = '')
{
	$tbl_name = '';
	if($date !='')
	{
		$converted_date = date('Y-m-d', strtotime($date));
		$tbl_arr=explode('-',$converted_date);
		if(!empty($tbl_arr))
		{
			$tbl_name='';
			$tbl_name='drs903001_'.$tbl_arr[0];
		}
	}
	return $tbl_name;
}

function generate_drs903001_new_tbl($DATE='')
{				
		$tbl_name='';
        if($DATE !='')
        {
            $converted_date = date('Y-m-d', strtotime($DATE));
            $tbl_arr=explode('-',$converted_date);
            if(!empty($tbl_arr))
            {
                $tbl_name='';
                $tbl_name='drs903001_'.$tbl_arr[0];
            }
        }
//$query =  $this->db->query("SELECT DISTINCT(dd_jo_code) FROM $tbl_name where dd_end_dt='$DATE'");
//if($this->db->table_exists($tbl_name_omis) == TRUE)
//$legacy_db = $this->load->database('dbcomm', true);
        //create table if not exist
        if( $this->db->table_exists($tbl_name) == FALSE)
        {
			$query = "CREATE TABLE $tbl_name (
				sl int NOT NULL PRIMARY KEY IDENTITY,
				drs_903001_rpDate smalldatetime,
				drs_903001_brcode varchar(10),
				drs_90300101_val varchar(MAX),
				drs_90300102_val varchar(MAX),
				drs_90300103_val varchar(150),
				drs_90300104_val numeric(18, 0),
				drs_90300105_val numeric(18, 0),
				drs_90300106_val smalldatetime,
				drs_90300107_val varchar(150),
				drs_90300108_val numeric(18, 0),
				drs_90300109_val varchar(100),
				drs_90300110_val numeric(18, 0),
				drs_90300111_val numeric(18, 0),
				drs_90300112_val numeric(18, 0),
				drs_90300113_val numeric(18, 0),
				drs_90300114_val numeric(18, 0),
				drs_90300115_val numeric(18, 0),
				drs_90300116_val numeric(18, 0),
				drs_90300117_val numeric(18, 0),
				drs_90300118_val numeric(18, 0),
				drs_90300119_val int,
				drs_90300120_val numeric(18, 0),
				drs_90300121_val int,
				drs_90300122_val numeric(18, 0),
				drs_90300123_val varchar(MAX),
				drs_90300124_val varchar(MAX),
				drs_90300125_val varchar(MAX),
				drs_90300126_val numeric(18, 0),
				drs_90300127_val numeric(18, 0),
				drs_90300128_val varchar(MAX),
				drs_90300129_val numeric(18, 0),
				drs_90300130_val numeric(18, 0),
				drs_90300131_val numeric(18, 0),
				drs_90300132_val varchar(MAX),
				drs_903001_uid varchar(50),
				drs_903001_submitDate smalldatetime
			);";
            $this->db->query($query);
        }
	}

function drs903201_get_info($branch_id='')
{
	$tbl_name = '';
	$DATE = date("Y/m/d");
	$tbl_name = $this->get_drs_903201_data_tbl_name_to_insert($DATE);		
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_name) == FALSE){
		return null;
	}else{
		$drs903201_data =  $legacy_db->query("select * from [dbo].[$tbl_name] where drs90320101brCode='$branch_id'");	
		return $drs903201_data->result();
	}			
}	

function drs903201_get_edit_data_fun($id='')
{
	$tbl_name = '';
	$DATE = date("Y/m/d");
	$tbl_name = $this->get_drs_903201_data_tbl_name_to_insert($DATE);		
	$legacy_db = $this->load->database('dbcomm', true);
	if($legacy_db->table_exists($tbl_name) == FALSE){
		return null;
	}else{
		$drs903201_edit_data =  $legacy_db->query("select * from [dbo].[$tbl_name] where sl='$id'");	
		return $drs903201_edit_data->result();
	}	
}	

function drs903201_data_insert_fun($DATE='')
{
	$status='error';
	$tbl_name = $this->get_drs_903201_data_tbl_name_to_insert($DATE);
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_name) == FALSE)
	{
			$this->generate_drs903201_new_tbl($DATE);
	}
	
	$data = array(
		'drs90320101brCode' =>$this->session->userdata('some_office'), //1
		'drs90320102brptDt' =>$DATE,	//2						
		'drs90320103' => $this->input->post('drs_90320103'),	//3
		'drs90320104' => $this->input->post('drs_90320104'),	//4
		'drs90320105' => $this->input->post('drs_90320105'),	//5
		'drs90320106' => $this->input->post('drs_90320106'),	//6
		'drs90320107' => $this->input->post('drs_90320107'),	//7
		'drs90320108' => $this->input->post('drs_90320108'),	//8
		'drs90320109' => $this->input->post('drs_90320109'),	//9
		'drs90320110' => $this->input->post('drs_90320110'),	//10
		'drs90320111' => $this->input->post('drs_90320111'),	//11
		'drs90320112' => $this->input->post('drs_90320112'),	//12
		'drs90320113' => $this->input->post('drs_90320113'),	//13
		'drs90320114' => $this->input->post('drs_90320114'),	//14
		'drs90320115' => $this->input->post('drs_90320115'),	//15
		'drs90320116' => $this->input->post('drs_90320116'),	//16
		'drs90320117' => $this->input->post('drs_90320117'),	//17
		'drs90320118' => $this->input->post('drs_90320118'),	//18
		'drs90320119' => $this->input->post('drs_90320119'),	//19
		'drs90320120' => $this->input->post('drs_90320120'),	//20
		'drs90320121' => $this->input->post('drs_90320121'),	//21
		'drs90320122' => $this->input->post('drs_90320122'),	//22
		'drs90320123' => $this->input->post('drs_90320123'),	//23
		'drs90320124' => $this->input->post('drs_90320124'),	//24
		'drs90320125' => $this->input->post('drs_90320125'),	//25
		'drs90320126' => $this->input->post('drs_90320126'),	//26
		'drs90320127' => $this->input->post('drs_90320127'),	//27
		'drs90320128' => $this->input->post('drs_90320128'),	//28
		'drs90320129' => $this->input->post('drs_90320129'),	//29
		'drs90320130' => $this->input->post('drs_90320130'),	//30
		'drs90320131' => $this->input->post('drs_90320131'),	//31
		'drs90320132' => $this->input->post('drs_90320132'),	//32
		'drs90320133' => $this->input->post('drs_90320133'),	//33
		'drs90320134' => $this->input->post('drs_90320134'),	//34
		'drs90320135' => $this->input->post('drs_90320135'),	//35
		'drs90320136' => $this->input->post('drs_90320136'),	//36
		'drs90320137' => $this->input->post('drs_90320137'),	//37
		'drs90320138' => $this->input->post('drs_90320138'),	//38
		'drs90320139' => $this->input->post('drs_90320139'),	//39
		'drs90320140' => $this->input->post('drs_90320140'),	//40
		'drs90320141' => $this->input->post('drs_90320141'),	//41
		'drs90320142' => $this->input->post('drs_90320142'),	//42
		'drs90320143' => $this->input->post('drs_90320143'),	//43
		'drs90320144' => $this->input->post('drs_90320144'),	//44
		'drs90320145' => $this->input->post('drs_90320145'),	//45
		'drs90320146' => $this->input->post('drs_90320146'),	//46
		'drs90320147' => $this->input->post('drs_90320147'),	//47
		'drs90320148' => $this->input->post('drs_90320148'),	//48
		'drs90320149' => $this->input->post('drs_90320149'),	//49
		'drs90320150entDt' => date('m/d/Y h:i:s a', time()),	//50
		'drs90320151uid'   => $this->session->userdata('some_uid'),	//51
		'drs90320152pSt' => 1,	//52
		'drs90320153pubSt' => 1	//53
	);
	if($this->add_drs903201_data($data, $DATE) ==1)
	{
		$status='success';
	}
	return $status;
}			
function add_drs903201_data($data, $DATE)
{
	$tbl_name = $this->get_drs_903201_data_tbl_name_to_insert($DATE);
	$legacy_db = $this->load->database('dbcomm', true);
	if($legacy_db->insert($tbl_name, $data))	{
		return 1;
	}else {
		return 0;
	}
}

function drs903201_data_edit_fun($DATE=''){

	$data = array(
		'drs90320101brCode' =>$this->session->userdata('some_office'), //1
		'drs90320102brptDt' =>$DATE,	//2						
		'drs90320103' => $this->input->post('drs_90320103'),	//3
		'drs90320104' => $this->input->post('drs_90320104'),	//4
		'drs90320105' => $this->input->post('drs_90320105'),	//5
		'drs90320106' => $this->input->post('drs_90320106'),	//6
		'drs90320107' => $this->input->post('drs_90320107'),	//7
		'drs90320108' => $this->input->post('drs_90320108'),	//8
		'drs90320109' => $this->input->post('drs_90320109'),	//9
		'drs90320110' => $this->input->post('drs_90320110'),	//10
		'drs90320111' => $this->input->post('drs_90320111'),	//11
		'drs90320112' => $this->input->post('drs_90320112'),	//12
		'drs90320113' => $this->input->post('drs_90320113'),	//13
		'drs90320114' => $this->input->post('drs_90320114'),	//14
		'drs90320115' => $this->input->post('drs_90320115'),	//15
		'drs90320116' => $this->input->post('drs_90320116'),	//16
		'drs90320117' => $this->input->post('drs_90320117'),	//17
		'drs90320118' => $this->input->post('drs_90320118'),	//18
		'drs90320119' => $this->input->post('drs_90320119'),	//19
		'drs90320120' => $this->input->post('drs_90320120'),	//20
		'drs90320121' => $this->input->post('drs_90320121'),	//21
		'drs90320122' => $this->input->post('drs_90320122'),	//22
		'drs90320123' => $this->input->post('drs_90320123'),	//23
		'drs90320124' => $this->input->post('drs_90320124'),	//24
		'drs90320125' => $this->input->post('drs_90320125'),	//25
		'drs90320126' => $this->input->post('drs_90320126'),	//26
		'drs90320127' => $this->input->post('drs_90320127'),	//27
		'drs90320128' => $this->input->post('drs_90320128'),	//28
		'drs90320129' => $this->input->post('drs_90320129'),	//29
		'drs90320130' => $this->input->post('drs_90320130'),	//30
		'drs90320131' => $this->input->post('drs_90320131'),	//31
		'drs90320132' => $this->input->post('drs_90320132'),	//32
		'drs90320133' => $this->input->post('drs_90320133'),	//33
		'drs90320134' => $this->input->post('drs_90320134'),	//34
		'drs90320135' => $this->input->post('drs_90320135'),	//35
		'drs90320136' => $this->input->post('drs_90320136'),	//36
		'drs90320137' => $this->input->post('drs_90320137'),	//37
		'drs90320138' => $this->input->post('drs_90320138'),	//38
		'drs90320139' => $this->input->post('drs_90320139'),	//39
		'drs90320140' => $this->input->post('drs_90320140'),	//40
		'drs90320141' => $this->input->post('drs_90320141'),	//41
		'drs90320142' => $this->input->post('drs_90320142'),	//42
		'drs90320143' => $this->input->post('drs_90320143'),	//43
		'drs90320144' => $this->input->post('drs_90320144'),	//44
		'drs90320145' => $this->input->post('drs_90320145'),	//45
		'drs90320146' => $this->input->post('drs_90320146'),	//46
		'drs90320147' => $this->input->post('drs_90320147'),	//47
		'drs90320148' => $this->input->post('drs_90320148'),	//48
		'drs90320149' => $this->input->post('drs_90320149'),	//49
		'drs90320150entDt' => date('m/d/Y h:i:s a', time()),	//50
		'drs90320151uid'   => $this->session->userdata('some_uid'),	//51
		'drs90320152pSt' => 1,	//52
		'drs90320153pubSt' => 1	//53
	);

	$id = $this->input->post('slEdit');
	$status='error';
	$tbl_name = $this->get_drs_903201_data_tbl_name_to_insert($DATE);
	$legacy_db = $this->load->database('dbcomm', true);
	if($legacy_db->update($tbl_name, $data, array('sl' => $id))){
		return 1;
	}else {
		return 0;
	}
}

function get_drs_903201_data_tbl_name_to_insert($date = '')
{
	$tbl_name = '';
	if($date !='')
	{
		$converted_date = date('Y-m-d', strtotime($date));
		$tbl_arr=explode('-',$converted_date);
		if(!empty($tbl_arr))
		{
			$tbl_name='';
			$tbl_name='drs903201_'.$tbl_arr[0];
		}
	}
	return $tbl_name;
}

function generate_drs903201_new_tbl($DATE='')
{	
    if($DATE !='')
	{
		$tbl_name = $this->get_drs_903201_data_tbl_name_to_insert($DATE);
	}
	$legacy_db = $this->load->database('dbcomm', true);
	if( $legacy_db->table_exists($tbl_name) == FALSE)
	{
		$query = "CREATE TABLE $tbl_name (
			sl int NOT NULL PRIMARY KEY IDENTITY,
			drs90320101brCode varchar(20),
			drs90320102brptDt smalldatetime,
			drs90320103 varchar(MAX),
			drs90320104 varchar(MAX),
			drs90320105 varchar(MAX),
			drs90320106 varchar(MAX),
			drs90320107 varchar(20),
			drs90320108 varchar(20),
			drs90320109 varchar(20),
			drs90320110 numeric(18, 2),
			drs90320111 numeric(18, 2),
			drs90320112 smalldatetime,
			drs90320113 numeric(18, 2),
			drs90320114 numeric(18, 2),
			drs90320115 numeric(18, 2),
			drs90320116 numeric(18, 2),
			drs90320117 numeric(18, 2),
			drs90320118 numeric(18, 2),
			drs90320119 numeric(18, 2),
			drs90320120 numeric(18, 2),
			drs90320121 numeric(18, 2),
			drs90320122 numeric(18, 2),
			drs90320123 numeric(18, 2),
			drs90320124 numeric(18, 2),
			drs90320125 numeric(18, 2),
			drs90320126 numeric(18, 2),
			drs90320127 numeric(18, 2),
			drs90320128 numeric(18, 2),
			drs90320129 numeric(18, 2),
			drs90320130 numeric(18, 2),
			drs90320131 varchar(MAX),
			drs90320132 smalldatetime,
			drs90320133 numeric(18, 2),
			drs90320134 varchar(MAX),
			drs90320135 varchar(20),
			drs90320136 varchar(MAX),
			drs90320137 numeric(18, 2),
			drs90320138 varchar(MAX),
			drs90320139 numeric(18, 2),
			drs90320140 varchar(50),
			drs90320141 smalldatetime,
			drs90320142 numeric(18, 2),
			drs90320143 varchar(50),
			drs90320144 smalldatetime,
			drs90320145 numeric(18, 2),
			drs90320146 varchar(50),
			drs90320147 numeric(18, 2),
			drs90320148 varchar(MAX),
			drs90320149 varchar(MAX),
			drs90320150entDt smalldatetime,
			drs90320151uid varchar(20),
			drs90320152pSt varchar(10),
			drs90320153pubSt varchar(10),
		);";
		$this->db->query($query);
	}
}
/*DRS END */

}
?>