<?php
class Rbamodel extends CI_Model {
 
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
     * RBA start
    */
    
    
    // function lms_case_pp_status_data()
    // {
    //     $ccs_type =  $this->db->query("select * FROM [db_mis_LMS].[dbo].[lms_master_case_pp_info] where lmpp_pp_status=1 order by lmpp_data_id");
    //     return $ccs_type->result();
    // }

	
	
    /** RBA Report start*/
    function fetch_part_b_f_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            
            $next_pl = ''; 
            if($year1>$year2){
                $next_pl = 'PL'.$month1.$year1;
            }else{
                $next_pl = 'PL'.$month2.$year2;
            }
            $part_b_f =  $this->db->query("SELECT
            fw.whole_br_intIncome_pl, fb.br_intIncome_pl,
            case when fw.whole_br_intIncome_pl = 0 or fb.br_intIncome_pl =0 then NULL
                else CAST(((CAST(fb.br_intIncome_pl AS FLOAT)/fw.whole_br_intIncome_pl)*100) AS DECIMAL(10, 4))  end as 'br_cont_intIncome_pl', '10' as 'intIncome_allMark',
            fw.whole_br_otherIncome_pl, fb.br_otherIncome_pl,
            case when fw.whole_br_otherIncome_pl = 0 or fb.br_otherIncome_pl =0 then NULL
                else CAST(((CAST(fb.br_otherIncome_pl AS FLOAT)/fw.whole_br_otherIncome_pl)*100) AS DECIMAL(10, 4))  end as 'br_cont_otherIncome_pl', '5' as 'otherIncome_allMark',
            fw.whole_br_expenditure_pl, fb.br_expenditure_pl,
            case when fw.whole_br_expenditure_pl = 0 or fb.br_expenditure_pl =0 then NULL
                else CAST(((CAST(fb.br_expenditure_pl AS FLOAT)/fw.whole_br_expenditure_pl)*100) AS DECIMAL(10, 4))  end as 'br_cont_expenditure_pl', '10' as 'expenditure_allMark',
            ((fw.whole_br_intIncome_pl+fw.whole_br_otherIncome_pl)-fw.whole_br_expenditure_pl) as 'pl_whole_br',
            ((fb.br_intIncome_pl+fb.br_otherIncome_pl)-fb.br_expenditure_pl) as 'pl_br',
            case when ((fw.whole_br_intIncome_pl+fw.whole_br_otherIncome_pl)-fw.whole_br_expenditure_pl) = 0 or 
            ((fb.br_intIncome_pl+fb.br_otherIncome_pl)-fb.br_expenditure_pl) =0 then NULL	
            else CAST(((CAST(((fb.br_intIncome_pl+fb.br_otherIncome_pl)-fb.br_expenditure_pl) AS FLOAT)/((fw.whole_br_intIncome_pl+fw.whole_br_otherIncome_pl)-fw.whole_br_expenditure_pl))*100) AS DECIMAL(10, 4)) end as 'br_con_pl', '10' as 'pl_allMark'
            from
            (
                SELECT 
                SUM(CASE WHEN scode  IN ('20100') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_intIncome_pl',
                SUM(CASE WHEN scode  IN ('20600', '20402','20300','20401','20200', '20500', '20700', '20900', '21100', '20800', '21000', '21200') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_otherIncome_pl',
                SUM(CASE WHEN scode  IN ('30101', '30102', '30103', '30104', '30201', '30202', '30203', '30204', '30205', '30206', '30207',
            '30208', '30209', '30301', '30302', '30303', '30400', '30500', '30600', '30701', '30702', '30703', '30704', '30705',
            '30706', '30801', '30802', '30803', '30901', '30902', '30903', '30904', '30905', '30906', '30907', '30908', '30909',
            '30910', '31000', '31100', '31200', '31300', '31400', '31500', '31600', '31700', '31800','31900') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_expenditure_pl'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_pl] where bcode not in ('0931', '0932', '0933', '0934')
            ) fw, 
            (
                SELECT 
                SUM(CASE WHEN scode  IN ('20100') THEN convert(money, amount) ELSE NULL END) AS 'br_intIncome_pl',
                SUM(CASE WHEN scode  IN ('20600', '20402','20300','20401','20200', '20500', '20700', '20900', '21100', '20800', '21000', '21200') THEN convert(money, amount) ELSE NULL END) AS 'br_otherIncome_pl',
                SUM(CASE WHEN scode  IN ('30101', '30102', '30103', '30104', '30201', '30202', '30203', '30204', '30205', '30206', '30207',
            '30208', '30209', '30301', '30302', '30303', '30400', '30500', '30600', '30701', '30702', '30703', '30704', '30705',
            '30706', '30801', '30802', '30803', '30901', '30902', '30903', '30904', '30905', '30906', '30907', '30908', '30909',
            '30910', '31000', '31100', '31200', '31300', '31400', '31500', '31600', '31700', '31800','31900') THEN convert(money, amount) ELSE NULL END) AS 'br_expenditure_pl'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_pl]  where bcode='$office_id'
            ) fb");
            
            $data = array();
            $result_partbf = $part_b_f->result_array();
                  
            $data['observation_intIncome'] = "Total Interest Income";
            $data['whole_br_intIncome_pl'] = $result_partbf[0]['whole_br_intIncome_pl'];
            $data['br_intIncome_pl'] = $result_partbf[0]['br_intIncome_pl'];
            $data['br_cont_intIncome_pl'] = $result_partbf[0]['br_cont_intIncome_pl'];
            $data['intIncome_allMark'] = $result_partbf[0]['intIncome_allMark'];
            $data['intIncome_obtained_mark'] = $this->part_b_f_obtained_mark_($result_partbf[0]['br_cont_intIncome_pl'], $result_partbf[0]['intIncome_allMark']);
           
            $data['observation_otherIncome'] = "Total Other Income";
            $data['whole_br_otherIncome_pl'] = $result_partbf[0]['whole_br_otherIncome_pl'];
            $data['br_otherIncome_pl'] = $result_partbf[0]['br_otherIncome_pl'];
            $data['br_cont_otherIncome_pl'] = $result_partbf[0]['br_cont_otherIncome_pl'];
            $data['otherIncome_allMark'] = $result_partbf[0]['otherIncome_allMark'];
            $data['otherIncome_obtained_mark'] = $this->part_b_f_obtained_mark_($result_partbf[0]['br_cont_otherIncome_pl'], $result_partbf[0]['otherIncome_allMark']);
           
            $data['observation_expenditure'] = "Total Expenditure";
            $data['whole_br_expenditure_pl'] = $result_partbf[0]['whole_br_expenditure_pl'];
            $data['br_expenditure_pl'] = $result_partbf[0]['br_expenditure_pl'];
            $data['br_cont_expenditure_pl'] = $result_partbf[0]['br_cont_expenditure_pl'];
            $data['expenditure_allMark'] = $result_partbf[0]['expenditure_allMark'];
            $data['expenditure_obtained_mark'] = $this->part_b_f_obtained_mark_($result_partbf[0]['br_cont_expenditure_pl'], $result_partbf[0]['expenditure_allMark']);
           
            $data['observation_pl'] = "Net Profit/Loss";
            $data['pl_whole_br'] = $result_partbf[0]['pl_whole_br'];
            $data['pl_br'] = $result_partbf[0]['pl_br'];
            $data['br_con_pl'] = $result_partbf[0]['br_con_pl'];
            $data['pl_allMark'] = $result_partbf[0]['pl_allMark'];
            $data['pl_obtained_mark'] = $this->part_b_f_obtained_mark_($result_partbf[0]['br_con_pl'], $result_partbf[0]['pl_allMark']);
                                                                    
            return $data;
        }
    }
    function part_b_f_obtained_mark_($br_cont, $allocated_mark = 0){
        
        $obtained_mark = 0;
        if(!is_numeric($br_cont)){
            return 0;
        }else{
            if($br_cont >= 1){
                $obtained_mark = $allocated_mark;    
            }else if($br_cont >= .10 && $br_cont < 1){
                if($allocated_mark == 5){$obtained_mark = 4;}
                if($allocated_mark == 10){$obtained_mark = 8;}
                if($allocated_mark == 15){$obtained_mark = 12;}
                if($allocated_mark == 20){$obtained_mark = 16;}
            }else if($br_cont >= .01 && $br_cont < .1){
                if($allocated_mark == 5){$obtained_mark = 3;}
                if($allocated_mark == 10){$obtained_mark = 6;}
                if($allocated_mark == 15){$obtained_mark = 9;}
                if($allocated_mark == 20){$obtained_mark = 12;}
            }else if($br_cont >= 0 && $br_cont < .01){
                if($allocated_mark == 5){$obtained_mark = 2;}
                if($allocated_mark == 10){$obtained_mark = 4;}
                if($allocated_mark == 15){$obtained_mark = 6;}
                if($allocated_mark == 20){$obtained_mark = 8;}
            }else if($br_cont < 0){
                if($br_cont < 0){
                    if($allocated_mark == 5){$obtained_mark = 1;}
                    if($allocated_mark == 10){$obtained_mark = 2;}
                    if($allocated_mark == 15){$obtained_mark = 3;}
                    if($allocated_mark == 20){$obtained_mark = 4;}
                }
            }
            return $obtained_mark;
        }   
    }

    function fetch_part_b_e_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $yr2='';
            $mon2='';           
            $nextDsa = '';
            $next_omis = '';
            
            
            if($year1>$year2){
                $mon2 = $month1;
                $yr2 = $year1;
                $nextDsa = 'DSA'.$month1.$year1;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            
            }else{
                $mon2 = $month2;
                $yr2 = $year2;
                $nextDsa = 'DSA'.$month2.$year2;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
            }
            $part_b_e =  $this->db->query("SELECT 
            ew.whole_br_unComAd_int_omis, eb.br_unCompAud_internal_omis,
            case when ew.whole_br_unComAd_int_omis=0 or eb.br_unCompAud_internal_omis=0 then NULL
                else CAST(((CAST(eb.br_unCompAud_internal_omis AS FLOAT)/ew.whole_br_unComAd_int_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_unCompAud_int_omis', '15' as 'unCompAud_int_allMark',
            ew.whole_br_CompAud_internal_omis, eb.br_CompAud_internal_omis,
            case when ew.whole_br_CompAud_internal_omis=0 or eb.br_CompAud_internal_omis=0 then NULL
                else CAST(((CAST(eb.br_CompAud_internal_omis AS FLOAT)/ew.whole_br_CompAud_internal_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_CompAud_int_omis', '10' as 'CompAud_int_allMark',
            ew.whole_br_unCompAud_other_omis, eb.br_unCompAud_other_omis,
            case when ew.whole_br_unCompAud_other_omis=0 or eb.br_unCompAud_other_omis=0 then NULL
                else CAST(((CAST(eb.br_unCompAud_other_omis AS FLOAT)/ew.whole_br_unCompAud_other_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_unCompAud_ot_omis', '15' as 'unCompAud_ot_allMark',
            ew.whole_br_CompAud_other_omis, eb.br_CompAud_other_omis,
            case when ew.whole_br_CompAud_other_omis=0 or eb.br_CompAud_other_omis=0 then NULL
                else CAST(((CAST(eb.br_CompAud_other_omis AS FLOAT)/ew.whole_br_CompAud_other_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_CompAud_ot_omis', '10' as 'CompAud_ot_allMark'
            from 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN ('3609') THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_unComAd_int_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3909') THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_CompAud_internal_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3601', '3605', '3613') THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_unCompAud_other_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3901', '3905', '3913') THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_CompAud_other_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931, 0932, 0933, 0934)
            ) ew, 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN ('3609') THEN convert(money, dd_ac) ELSE NULL END) AS 'br_unCompAud_internal_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3909') THEN convert(money, dd_ac) ELSE NULL END) AS 'br_CompAud_internal_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3601', '3605', '3613') THEN convert(money, dd_ac) ELSE NULL END) AS 'br_unCompAud_other_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3901', '3905', '3913') THEN convert(money, dd_ac) ELSE NULL END) AS 'br_CompAud_other_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) AND dd_jo_code='$office_id'
            ) eb");
            
            $data = array();
            $result_partbe = $part_b_e->result_array();
                 
            $data['observation_unCompAud_int'] = "No. of Un-complied Audit & Inspection Objection-Internal";
            $data['whole_br_unComAd_int_omis'] = $result_partbe[0]['whole_br_unComAd_int_omis'];
            $data['br_unCompAud_internal_omis'] = $result_partbe[0]['br_unCompAud_internal_omis'];
            $data['br_cont_unCompAud_int_omis'] = $result_partbe[0]['br_cont_unCompAud_int_omis'];
            $data['unCompAud_int_allMark'] = $result_partbe[0]['unCompAud_int_allMark'];
            $data['unCompAud_int_obtained_mark'] = $this->part_b_e_obtained_mark_($result_partbe[0]['br_cont_unCompAud_int_omis'], $result_partbe[0]['unCompAud_int_allMark']);
           
            $data['observation_CompAud_int'] = "No. of complied Audit & Inspection Objections- Internal";
            $data['whole_br_CompAud_internal_omis'] = $result_partbe[0]['whole_br_CompAud_internal_omis'];
            $data['br_CompAud_internal_omis'] = $result_partbe[0]['br_CompAud_internal_omis'];
            $data['br_cont_CompAud_int_omis'] = $result_partbe[0]['br_cont_CompAud_int_omis'];
            $data['CompAud_int_allMark'] = $result_partbe[0]['CompAud_int_allMark'];
            $data['CompAud_int_obtained_mark'] = $this->part_b_e_obtained_mark_($result_partbe[0]['br_cont_CompAud_int_omis'], $result_partbe[0]['CompAud_int_allMark']);
           
            $data['observation_unCompAud_ot'] = "No. of Un-complied Audit & Inspection Objections- Others";
            $data['whole_br_unCompAud_other_omis'] = $result_partbe[0]['whole_br_unCompAud_other_omis'];
            $data['br_unCompAud_other_omis'] = $result_partbe[0]['br_unCompAud_other_omis'];
            $data['br_cont_unCompAud_ot_omis'] = $result_partbe[0]['br_cont_unCompAud_ot_omis'];
            $data['unCompAud_ot_allMark'] = $result_partbe[0]['unCompAud_ot_allMark'];
            $data['unCompAud_ot_obtained_mark'] = $this->part_b_e_obtained_mark_($result_partbe[0]['br_cont_unCompAud_ot_omis'], $result_partbe[0]['unCompAud_ot_allMark']);

            $data['observation_CompAud_ot'] = "No. of complied Audit & Inspection Objections- Others";
            $data['whole_br_CompAud_other_omis'] = $result_partbe[0]['whole_br_CompAud_other_omis'];
            $data['br_CompAud_other_omis'] = $result_partbe[0]['br_CompAud_other_omis'];
            $data['br_cont_CompAud_ot_omis'] = $result_partbe[0]['br_cont_CompAud_ot_omis'];
            $data['CompAud_ot_allMark'] = $result_partbe[0]['CompAud_ot_allMark'];
            $data['CompAud_ot_obtained_mark'] = $this->part_b_e_obtained_mark_($result_partbe[0]['br_cont_CompAud_ot_omis'], $result_partbe[0]['CompAud_ot_allMark']);
                                                        
            return $data;
        }
    }
    function part_b_e_obtained_mark_($br_cont, $allocated_mark = 0){
        
        $obtained_mark = 0;
        if(!is_numeric($br_cont)){
            return 0;
        }else{
            if($br_cont >= 1){
                $obtained_mark = $allocated_mark;    
            }else if($br_cont >= .10 && $br_cont < 1){
                if($allocated_mark == 5){$obtained_mark = 4;}
                if($allocated_mark == 10){$obtained_mark = 8;}
                if($allocated_mark == 15){$obtained_mark = 12;}
                if($allocated_mark == 20){$obtained_mark = 16;}
            }else if($br_cont >= .01 && $br_cont < .1){
                if($allocated_mark == 5){$obtained_mark = 3;}
                if($allocated_mark == 10){$obtained_mark = 6;}
                if($allocated_mark == 15){$obtained_mark = 9;}
                if($allocated_mark == 20){$obtained_mark = 12;}
            }else if($br_cont >= 0 && $br_cont < .01){
                if($allocated_mark == 5){$obtained_mark = 2;}
                if($allocated_mark == 10){$obtained_mark = 4;}
                if($allocated_mark == 15){$obtained_mark = 6;}
                if($allocated_mark == 20){$obtained_mark = 8;}
            }else if($br_cont < 0){
                if($br_cont < 0){
                    if($allocated_mark == 5){$obtained_mark = 1;}
                    if($allocated_mark == 10){$obtained_mark = 2;}
                    if($allocated_mark == 15){$obtained_mark = 3;}
                    if($allocated_mark == 20){$obtained_mark = 4;}
                }
            }
            return $obtained_mark;
        }   
    }

    function fetch_part_b_d_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $yr2='';
            $mon2='';           
            $nextDsa = '';
            $next_omis = '';
            $next_iss = '';
            $next_backAff = '';
            if($year1>$year2){
                $mon2 = $month1;
                $yr2 = $year1;
                $nextDsa = 'DSA'.$month1.$year1;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month1.$year1;
                $next_backAff = 'backpage'.$month1.$year1;
            }else{
                $mon2 = $month2;
                $yr2 = $year2;
                $nextDsa = 'DSA'.$month2.$year2;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month2.$year2;
                $next_backAff = 'backpage'.$month2.$year2;
            }
            $part_b_d =  $this->db->query("SELECT 
            dw.whole_br_import_amt_omis, db.br_import_amt_omis,
            case when dw.whole_br_import_amt_omis=0 or db.br_import_amt_omis=0 then NULL
                else CAST(((CAST(db.br_import_amt_omis AS FLOAT)/dw.whole_br_import_amt_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_import_amt_omis', '20' as 'import_amt_allMark',
            dw.whole_br_import_ac_omis, db.br_import_ac_omis,
            case when dw.whole_br_import_ac_omis=0 or db.br_import_ac_omis=0 then NULL
                else CAST(((CAST(db.br_import_ac_omis AS FLOAT)/dw.whole_br_import_ac_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_import_ac_omis', '5' as 'import_ac_allMark',
            dw.whole_br_export_amt_omis, db.br_export_amt_omis,
            case when dw.whole_br_export_amt_omis=0 or db.br_export_amt_omis=0 then NULL
                else CAST(((CAST(db.br_export_amt_omis AS FLOAT)/dw.whole_br_export_amt_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_export_amt_omis', '20' as 'export_amt_allMark',
            dw.whole_br_export_ac_omis, db.br_export_ac_omis,
            case when dw.whole_br_export_ac_omis=0 or db.br_export_ac_omis=0 then NULL
                else CAST(((CAST(db.br_export_ac_omis AS FLOAT)/dw.whole_br_export_ac_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_export_ac_omis', '5' as 'export_ac_allMark'
            from 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN ('5701') THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_import_amt_omis',
                SUM(CASE WHEN dd_pt_id  IN ('5701') THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_import_ac_omis',
                SUM(CASE WHEN dd_pt_id  IN ('6001') THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_export_amt_omis',
                SUM(CASE WHEN dd_pt_id  IN ('6001') THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_export_ac_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931, 0932, 0933, 0934)
            ) dw, 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN ('5701') THEN convert(money, dd_amt) ELSE NULL END) AS 'br_import_amt_omis',
                SUM(CASE WHEN dd_pt_id  IN ('5701') THEN convert(money, dd_ac) ELSE NULL END) AS 'br_import_ac_omis',
                SUM(CASE WHEN dd_pt_id  IN ('6001') THEN convert(money, dd_amt) ELSE NULL END) AS 'br_export_amt_omis',
                SUM(CASE WHEN dd_pt_id  IN ('6001') THEN convert(money, dd_ac) ELSE NULL END) AS 'br_export_ac_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931, 0932, 0933, 0934) AND dd_jo_code='$office_id'
            ) db");
            
            $data = array();
            $result_partbd = $part_b_d->result_array();
                        
            $data['observation_importAmt'] = "Outstanding amount of Foreign Trade-Import";
            $data['whole_br_import_amt_omis'] = $result_partbd[0]['whole_br_import_amt_omis'];
            $data['br_import_amt_omis'] = $result_partbd[0]['br_import_amt_omis'];
            $data['br_cont_import_amt_omis'] = $result_partbd[0]['br_cont_import_amt_omis'];
            $data['import_amt_allMark'] = $result_partbd[0]['import_amt_allMark'];
            $data['import_amt_obtained_mark'] = $this->part_b_d_obtained_mark_($result_partbd[0]['br_cont_import_amt_omis'], $result_partbd[0]['import_amt_allMark']);
           
            $data['observation_importAc'] = "No. of Borrowers-Foreign Trade-Import";
            $data['whole_br_import_ac_omis'] = $result_partbd[0]['whole_br_import_ac_omis'];
            $data['br_import_ac_omis'] = $result_partbd[0]['br_import_ac_omis'];
            $data['br_cont_import_ac_omis'] = $result_partbd[0]['br_cont_import_ac_omis'];
            $data['import_ac_allMark'] = $result_partbd[0]['import_ac_allMark'];
            $data['import_ac_obtained_mark'] = $this->part_b_d_obtained_mark_($result_partbd[0]['br_cont_import_ac_omis'], $result_partbd[0]['import_ac_allMark']);
            
            $data['observation_exportAmt'] = "Outstanding amount of Foreign Trade-export";
            $data['whole_br_export_amt_omis'] = $result_partbd[0]['whole_br_export_amt_omis'];
            $data['br_export_amt_omis'] = $result_partbd[0]['br_export_amt_omis'];
            $data['br_cont_export_amt_omis'] = $result_partbd[0]['br_cont_export_amt_omis'];
            $data['export_amt_allMark'] = $result_partbd[0]['export_amt_allMark'];
            $data['export_amt_obtained_mark'] = $this->part_b_d_obtained_mark_($result_partbd[0]['br_cont_export_amt_omis'], $result_partbd[0]['export_amt_allMark']);
             
            $data['observation_exportAc'] = "No. of Borrowers-Foreign Trade-Export";
            $data['whole_br_export_ac_omis'] = $result_partbd[0]['whole_br_export_ac_omis'];
            $data['br_export_ac_omis'] = $result_partbd[0]['br_export_ac_omis'];
            $data['br_cont_export_ac_omis'] = $result_partbd[0]['br_cont_export_ac_omis'];
            $data['export_ac_allMark'] = $result_partbd[0]['export_ac_allMark'];
            $data['export_ac_obtained_mark'] = $this->part_b_d_obtained_mark_($result_partbd[0]['br_cont_export_ac_omis'], $result_partbd[0]['export_ac_allMark']);
            
                                            
            return $data;
        }
    }
    function part_b_d_obtained_mark_($br_cont, $allocated_mark = 0){
        
        $obtained_mark = 0;
        if(!is_numeric($br_cont)){
            return 0;
        }else{
            if($br_cont >= .1){
                $obtained_mark = $allocated_mark;    
            }else if($br_cont >= .10 && $br_cont < .1){
                if($allocated_mark == 5){$obtained_mark = 4;}
                if($allocated_mark == 10){$obtained_mark = 8;}
                if($allocated_mark == 15){$obtained_mark = 12;}
                if($allocated_mark == 20){$obtained_mark = 16;}
            }else if($br_cont >= .001 && $br_cont < .01){
                if($allocated_mark == 5){$obtained_mark = 3;}
                if($allocated_mark == 10){$obtained_mark = 6;}
                if($allocated_mark == 15){$obtained_mark = 9;}
                if($allocated_mark == 20){$obtained_mark = 12;}
            }else if($br_cont >= 0 && $br_cont < .001){
                if($allocated_mark == 5){$obtained_mark = 2;}
                if($allocated_mark == 10){$obtained_mark = 4;}
                if($allocated_mark == 15){$obtained_mark = 6;}
                if($allocated_mark == 20){$obtained_mark = 8;}
            }else if($br_cont < 0){
                if($br_cont < 0){
                    if($allocated_mark == 5){$obtained_mark = 1;}
                    if($allocated_mark == 10){$obtained_mark = 2;}
                    if($allocated_mark == 15){$obtained_mark = 3;}
                    if($allocated_mark == 20){$obtained_mark = 4;}
                }
            }
            return $obtained_mark;
        }   
    }

    function fetch_part_b_c_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $yr2='';
            $mon2='';           
            $nextDsa = '';
            $next_omis = '';
            $next_iss = '';
            $next_backAff = '';
            if($year1>$year2){
                $mon2 = $month1;
                $yr2 = $year1;
                $nextDsa = 'DSA'.$month1.$year1;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month1.$year1;
                $next_backAff = 'backpage'.$month1.$year1;
            }else{
                $mon2 = $month2;
                $yr2 = $year2;
                $nextDsa = 'DSA'.$month2.$year2;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month2.$year2;
                $next_backAff = 'backpage'.$month2.$year2;
            }
            $part_b_c =  $this->db->query("SELECT 
            cwaff.whole_br_billpotL_aff, cbaff.br_billpotL_aff,
            case when cwaff.whole_br_billpotL_aff = 0 or  cbaff.br_billpotL_aff = 0 then NULL
	            else CAST(((CAST(cbaff.br_billpotL_aff AS FLOAT)/cwaff.whole_br_billpotL_aff)*100) AS DECIMAL(10, 4)) end as 'br_cont_billpotL_aff', '5' as 'billpotL_allMark',
            cwaff.whole_br_cashHand_aff, cbaff.br_cashHand_aff,
            case when cwaff.whole_br_cashHand_aff = 0 or  cbaff.br_cashHand_aff = 0 then NULL
                else CAST(((CAST(cbaff.br_cashHand_aff AS FLOAT)/cwaff.whole_br_cashHand_aff)*100) AS DECIMAL(10, 4)) end as 'br_cont_cashhand_aff', '5' as 'cashHand_allMark',
            cwomis.whole_br_remitt_omis, cbomis.br_remitt_omis,
            case when cwomis.whole_br_remitt_omis=0 or cbomis.br_remitt_omis=0 then NULL
                else CAST(((CAST(cbomis.br_remitt_omis AS FLOAT)/cwomis.whole_br_remitt_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_remitt_omis', '15' as 'remitt_allMark',
            cwaff.whole_br_suspenseAmt_aff, cbaff.br_suspenseAmt_aff,
            case when cwaff.whole_br_suspenseAmt_aff = 0 or  cbaff.br_suspenseAmt_aff = 0 then NULL
                else CAST(((CAST(cbaff.br_suspenseAmt_aff AS FLOAT)/cwaff.whole_br_suspenseAmt_aff)*100) AS DECIMAL(10, 4)) end as 'br_cont_suspenseAmt_aff', '15' as 'suspenseAmt_allMark',
            cwaffback.whole_br_protestedBill_aff, cbaffback.br_protestedBill_aff,
            case when cwaffback.whole_br_protestedBill_aff = 0 or  cbaffback.br_protestedBill_aff = 0 then NULL
                else CAST(((CAST(cbaffback.br_protestedBill_aff AS FLOAT)/cwaffback.whole_br_protestedBill_aff)*100) AS DECIMAL(10, 4)) end as 'br_cont_protestedBill_aff', '15' as 'protestedBill_allMark',
            cwaffback.whole_br_armypension_aff, cbaffback.br_armypension_aff,
            case when cwaffback.whole_br_armypension_aff = 0 or  cbaffback.br_armypension_aff = 0 then NULL
                else CAST(((CAST(cbaffback.br_armypension_aff AS FLOAT)/cwaffback.whole_br_armypension_aff)*100) AS DECIMAL(10, 4)) end as 'br_cont_armypension_aff', '5' as 'armypension_allMark',
            (cwaff.whole_br_sundryAsset_aff-(cwaffback.whole_br_protestedBill_aff+cwaffback.whole_br_armypension_aff)) AS 'whole_br_sundryAssetOt_aff', 
            (cbaff.br_sundryAsset_aff-(cbaffback.br_protestedBill_aff+cbaffback.br_armypension_aff)) AS 'br_sundryAssetOt_aff',
            case when (cwaff.whole_br_sundryAsset_aff-(cwaffback.whole_br_protestedBill_aff+cwaffback.whole_br_armypension_aff)) = 0 or  (cbaff.br_sundryAsset_aff-(cbaffback.br_protestedBill_aff+cbaffback.br_armypension_aff)) = 0 then NULL
                else CAST(((CAST((cbaff.br_sundryAsset_aff-(cbaffback.br_protestedBill_aff+cbaffback.br_armypension_aff)) AS FLOAT)/(cwaff.whole_br_sundryAsset_aff-(cwaffback.whole_br_protestedBill_aff+cwaffback.whole_br_armypension_aff)))*100) AS DECIMAL(10, 4)) end as 'br_cont_sundryAssetOt_aff', '5' as 'sundryAssetOt_allMark'
            from
            (
                SELECT 
                SUM(CASE WHEN sub_head  IN ('10102') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_cashHand_aff',
                SUM(CASE WHEN sub_head  IN ('10705') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_suspenseAmt_aff',
                SUM(CASE WHEN sub_head  IN ('10714') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_sundryAsset_aff',
                SUM(CASE WHEN sub_head  IN ('00501', '00502', '00503', '00504', '00505', '00506', '00507', '00508', '00509', '00510', 
	            '00511', '00512', '00513', '00514', '00515', '00516', '00517', '00518', '00519', '00520', '00521', '00522', '00523', 
	            '00524', '00525', '00526', '00527', '00301', '00302', '00303', '00304', '00305', '00306', '00307', '00308', '00309', '00310', 
	            '00311', '00312') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_billpotL_aff'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] where bcode not in (0931,0932,0933,0934)
            ) cwaff, 
            (
                SELECT 
                SUM(CASE WHEN sub_head  IN ('10102') THEN convert(money, amount) ELSE NULL END) AS 'br_cashHand_aff',
                SUM(CASE WHEN sub_head  IN ('10705') THEN convert(money, amount) ELSE NULL END) AS 'br_suspenseAmt_aff',
                SUM(CASE WHEN sub_head  IN ('10714') THEN convert(money, amount) ELSE NULL END) AS 'br_sundryAsset_aff',
                SUM(CASE WHEN sub_head  IN ('00501', '00502', '00503', '00504', '00505', '00506', '00507', '00508', '00509', '00510', 
	            '00511', '00512', '00513', '00514', '00515', '00516', '00517', '00518', '00519', '00520', '00521', '00522', '00523', 
	            '00524', '00525', '00526', '00527', '00301', '00302', '00303', '00304', '00305', '00306', '00307', '00308', '00309', '00310', 
	            '00311', '00312') THEN convert(money, amount) ELSE NULL END) AS 'br_billpotL_aff'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] where bcode='$office_id'
            ) cbaff, 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN ('3001') THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_remitt_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934)
            ) cwomis, 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN ('3001') THEN convert(money, dd_amt) ELSE NULL END) AS 'br_remitt_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) AND dd_jo_code='$office_id'
            ) cbomis,
            (
            SELECT 
                SUM(CASE WHEN scode  IN ('1071409') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_protestedBill_aff',
                SUM(CASE WHEN scode  IN ('1071418') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_armypension_aff'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_backAff] where bcode not in (0931,0932,0933,0934)
            ) cwaffback,
            (
            SELECT 
                SUM(CASE WHEN scode  IN ('1071409') THEN convert(money, amount) ELSE NULL END) AS 'br_protestedBill_aff',
                SUM(CASE WHEN scode  IN ('1071418') THEN convert(money, amount) ELSE NULL END) AS 'br_armypension_aff'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_backAff] where bcode='$office_id'
            ) cbaffback");
            
            $data = array();
            $result_partbc = $part_b_c->result_array();
            $data['observation_billpotL'] = "Total Amount of Outstanding";
            $data['whole_br_billpotL_aff'] = $result_partbc[0]['whole_br_billpotL_aff'];
            $data['br_billpotL_aff'] = $result_partbc[0]['br_billpotL_aff'];
            $data['br_cont_billpotL_aff'] = $result_partbc[0]['br_cont_billpotL_aff'];
            $data['billpotL_allMark'] = $result_partbc[0]['billpotL_allMark'];
            $data['billpotL_obtained_mark'] = $this->part_b_c_obtained_mark_($result_partbc[0]['br_cont_billpotL_aff'], $result_partbc[0]['billpotL_allMark']);
            
            $data['observation_cashhand'] = "Cash in hand";
            $data['whole_br_cashHand_aff'] = $result_partbc[0]['whole_br_cashHand_aff'];
            $data['br_cashHand_aff'] = $result_partbc[0]['br_cashHand_aff'];
            $data['br_cont_cashhand_aff'] = $result_partbc[0]['br_cont_cashhand_aff'];
            $data['cashHand_allMark'] = $result_partbc[0]['cashHand_allMark'];
            $data['cashhand_obtained_mark'] = $this->part_b_c_obtained_mark_($result_partbc[0]['br_cont_cashhand_aff'], $result_partbc[0]['cashHand_allMark']);

            $data['observation_remit'] = "Outstanding amount of Foreign Remittance";
            $data['whole_br_remitt_omis'] = $result_partbc[0]['whole_br_remitt_omis'];
            $data['br_remitt_omis'] = $result_partbc[0]['br_remitt_omis'];
            $data['br_cont_remitt_omis'] = $result_partbc[0]['br_cont_remitt_omis'];
            $data['remitt_allMark'] = $result_partbc[0]['remitt_allMark'];
            $data['remit_obtained_mark'] = $this->part_b_c_obtained_mark_($result_partbc[0]['br_cont_remitt_omis'], $result_partbc[0]['remitt_allMark']);

            $data['observation_suspenseAmt'] = "Outstanding amount of Suspense";
            $data['whole_br_suspenseAmt_aff'] = $result_partbc[0]['whole_br_suspenseAmt_aff'];
            $data['br_suspenseAmt_aff'] = $result_partbc[0]['br_suspenseAmt_aff'];
            $data['br_cont_suspenseAmt_aff'] = $result_partbc[0]['br_cont_suspenseAmt_aff'];
            $data['suspenseAmt_allMark'] = $result_partbc[0]['suspenseAmt_allMark'];
            $data['suspenseAmt_obtained_mark'] = $this->part_b_c_obtained_mark_($result_partbc[0]['br_cont_suspenseAmt_aff'], $result_partbc[0]['suspenseAmt_allMark']);

            $data['observation_protestedBill'] = "Sunry Assets A/C - Protested Bill";
            $data['whole_br_protestedBill_aff'] = $result_partbc[0]['whole_br_protestedBill_aff'];
            $data['br_protestedBill_aff'] = $result_partbc[0]['br_protestedBill_aff'];
            $data['br_cont_protestedBill_aff'] = $result_partbc[0]['br_cont_protestedBill_aff'];
            $data['protestedBill_allMark'] = $result_partbc[0]['protestedBill_allMark'];
            $data['protestedBill_obtained_mark'] = $this->part_b_c_obtained_mark_($result_partbc[0]['br_cont_protestedBill_aff'], $result_partbc[0]['protestedBill_allMark']);

            $data['observation_armypension'] = "Sunry Assets A/C - Army Pension";
            $data['whole_br_armypension_aff'] = $result_partbc[0]['whole_br_armypension_aff'];
            $data['br_armypension_aff'] = $result_partbc[0]['br_armypension_aff'];
            $data['br_cont_armypension_aff'] = $result_partbc[0]['br_cont_armypension_aff'];
            $data['armypension_allMark'] = $result_partbc[0]['armypension_allMark'];
            $data['armypension_obtained_mark'] = $this->part_b_c_obtained_mark_($result_partbc[0]['br_cont_armypension_aff'], $result_partbc[0]['armypension_allMark']);

            $data['observation_sundryAssetOt'] = "Sunry Assets A/C - others";
            $data['whole_br_sundryAssetOt_aff'] = $result_partbc[0]['whole_br_sundryAssetOt_aff'];
            $data['br_sundryAssetOt_aff'] = $result_partbc[0]['br_sundryAssetOt_aff'];
            $data['br_cont_sundryAssetOt_aff'] = $result_partbc[0]['br_cont_sundryAssetOt_aff'];
            $data['sundryAssetOt_allMark'] = $result_partbc[0]['sundryAssetOt_allMark'];
            $data['sundryAssetOt_obtained_mark'] = $this->part_b_c_obtained_mark_($result_partbc[0]['br_cont_sundryAssetOt_aff'], $result_partbc[0]['sundryAssetOt_allMark']);
            
                                  
            return $data;
        }
    }
    function part_b_c_obtained_mark_($br_cont, $allocated_mark = 0){
        
        $obtained_mark = 0;
        if(!is_numeric($br_cont)){
            return 0;
        }else{
            if($br_cont >= .50){
                $obtained_mark = $allocated_mark;    
            }else if($br_cont >= .15 && $br_cont < .5){
                if($allocated_mark == 5){$obtained_mark = 4;}
                if($allocated_mark == 10){$obtained_mark = 8;}
                if($allocated_mark == 15){$obtained_mark = 12;}
                if($allocated_mark == 20){$obtained_mark = 16;}
            }else if($br_cont >= .01 && $br_cont < .15){
                if($allocated_mark == 5){$obtained_mark = 3;}
                if($allocated_mark == 10){$obtained_mark = 6;}
                if($allocated_mark == 15){$obtained_mark = 9;}
                if($allocated_mark == 20){$obtained_mark = 12;}
            }else if($br_cont >= 0 && $br_cont < .01){
                if($allocated_mark == 5){$obtained_mark = 2;}
                if($allocated_mark == 10){$obtained_mark = 4;}
                if($allocated_mark == 15){$obtained_mark = 6;}
                if($allocated_mark == 20){$obtained_mark = 8;}
            }else if($br_cont < 0){
                if($br_cont < 0){
                    if($allocated_mark == 5){$obtained_mark = 1;}
                    if($allocated_mark == 10){$obtained_mark = 2;}
                    if($allocated_mark == 15){$obtained_mark = 3;}
                    if($allocated_mark == 20){$obtained_mark = 4;}
                }
            }
            return $obtained_mark;
        }   
    }

    function fetch_part_b_b_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $yr2='';
            $mon2='';           
            $nextDsa = '';
            $next_omis = '';
            $next_iss = '';
            if($year1>$year2){
                $mon2 = $month1;
                $yr2 = $year1;
                $nextDsa = 'DSA'.$month1.$year1;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month1.$year1;
            }else{
                $mon2 = $month2;
                $yr2 = $year2;
                $nextDsa = 'DSA'.$month2.$year2;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month2.$year2;
            }
            $part_b_b =  $this->db->query("SELECT 
            bwomis.whole_br_loanAdavnce_omis, bbomis.br_loanAdavnce_omis,
            case when bwomis.whole_br_loanAdavnce_omis = 0 or bbomis.br_loanAdavnce_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_loanAdavnce_omis AS FLOAT)/bwomis.whole_br_loanAdavnce_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_loanAdvance_omis', '20' as 'br_cont_loanAdvance_allMark',
            bwomis.whole_br_loanACNo_omis, bbomis.br_loanACNo_omis,
            case when bwomis.whole_br_loanACNo_omis = 0 or bbomis.br_loanACNo_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_loanACNo_omis AS FLOAT)/bwomis.whole_br_loanACNo_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_loanACNo_omis', '5' as 'br_cont_loanACNo_allMark',
            bwomis.whole_br_conDemTermLoan_omis, bbomis.br_conDemTermLoan_omis,
            case when bwomis.whole_br_conDemTermLoan_omis = 0 or bbomis.br_conDemTermLoan_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_conDemTermLoan_omis AS FLOAT)/bwomis.whole_br_conDemTermLoan_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_conDemTermLoan_omis', '15' as 'br_cont_conDemTermLoan_allMark',
            bwomis.whole_br_agriLoan_omis, bbomis.br_agriLoan_omis,
            case when bwomis.whole_br_agriLoan_omis = 0 or bbomis.br_agriLoan_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_agriLoan_omis AS FLOAT)/bwomis.whole_br_agriLoan_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_agriLoan_omis', '10' as 'br_cont_agriLoan_allMark',
            bwomis.whole_br_otherLoan_omis, bbomis.br_otherLoan_omis,
            case when bwomis.whole_br_otherLoan_omis = 0 or bbomis.br_otherLoan_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_otherLoan_omis AS FLOAT)/bwomis.whole_br_otherLoan_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_otherLoan_omis', '10' as 'br_cont_otherLoan_allMark',
            bwomis.whole_br_clLoan_omis, bbomis.br_clLoan_omis,
            case when bwomis.whole_br_clLoan_omis = 0 or bbomis.br_clLoan_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_clLoan_omis AS FLOAT)/bwomis.whole_br_clLoan_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_clLoan_omis', '20' as 'br_cont_clLoan_allMark',
            bwomis.whole_br_timeBarredLoan_omis, bbomis.br_timeBarredLoan_omis,
            case when bwomis.whole_br_timeBarredLoan_omis = 0 or bbomis.br_timeBarredLoan_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_timeBarredLoan_omis AS FLOAT)/bwomis.whole_br_timeBarredLoan_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_timeBarredLoan_omis', '15' as 'br_cont_timeBarredLoan_allMark',
            bwomis.whole_br_rescheduleLoan_omis, bbomis.br_rescheduleLoan_omis,
            case when bwomis.whole_br_rescheduleLoan_omis = 0 or bbomis.br_rescheduleLoan_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_rescheduleLoan_omis AS FLOAT)/bwomis.whole_br_rescheduleLoan_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_rescheduleLoan_omis', '10' as 'br_cont_rescheduleLoan_allMark',
            bwomis.whole_br_instwvefrmloan_omis, bbomis.br_interestwaivefrmloan_omis,
            case when bwomis.whole_br_instwvefrmloan_omis = 0 or bbomis.br_interestwaivefrmloan_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_interestwaivefrmloan_omis AS FLOAT)/bwomis.whole_br_instwvefrmloan_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_instwavfrmloan_omis', '5' as 'interestwaivefrmloan_allMark',
            bwomis.whole_br_suitundesoff_omis, bbomis.br_suitundesposedoff_omis,
            case when bwomis.whole_br_suitundesoff_omis = 0 or bbomis.br_suitundesposedoff_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_suitundesposedoff_omis AS FLOAT)/bwomis.whole_br_suitundesoff_omis)*100) AS DECIMAL(10, 4)) end as 'suitundesposedoff_omis', '10' as 'suitundesposedoff_allMark',
            bwomis.whole_br_nostundesoff_omis, bbomis.br_nosuitundesposedoff_omis,
            case when bwomis.whole_br_nostundesoff_omis = 0 or bbomis.br_nosuitundesposedoff_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_nosuitundesposedoff_omis AS FLOAT)/bwomis.whole_br_nostundesoff_omis)*100) AS DECIMAL(10, 4)) end as 'nosuitundesposedoff_omis', '5' as 'nosuitundesposedoff_allMark',
            bwomis.whole_br_loanAdvRwriteoff_omis, bbomis.br_loanAdvRwriteoff_omis,
            case when bwomis.whole_br_loanAdvRwriteoff_omis = 0 or bbomis.br_loanAdvRwriteoff_omis = 0 then NULL
                else CAST(((CAST(bbomis.br_loanAdvRwriteoff_omis AS FLOAT)/bwomis.whole_br_loanAdvRwriteoff_omis)*100) AS DECIMAL(10, 4)) end as 'br_cont_loanAdvRwriteoff_omis', '10' as 'loanAdvRwriteoff_allMark',
            bwiss.whole_br_wtiteoffloan_iss, bbiss.br_wtiteoffloan_iss,
            case when bwiss.whole_br_wtiteoffloan_iss = 0 or bbiss.br_wtiteoffloan_iss = 0 then NULL
                else (((bbiss.br_wtiteoffloan_iss)/bwiss.whole_br_wtiteoffloan_iss)*100) end as 'br_cont_wtiteoffloan_iss', '20' as 'br_cont_wtiteoffloan_allMark',
            bwaff.whole_br_instsuspenseac_aff, bbaff.br_instsuspenseac_aff,
            case when bwaff.whole_br_instsuspenseac_aff = 0 or bbaff.br_instsuspenseac_aff = 0 then NULL
                else CAST(((CAST(bbaff.br_instsuspenseac_aff AS FLOAT)/bwaff.whole_br_instsuspenseac_aff)*100) AS DECIMAL(10, 4)) end as 'br_cont_instsuspenseac_aff', '5' as 'br_cont_instsuspenseac_allMark',
            bwaff.whole_br_provision_aff, bbaff.br_provision_aff,
            case when bwaff.whole_br_provision_aff = 0 or bbaff.br_provision_aff = 0 then NULL
                else CAST(((CAST(bbaff.br_provision_aff AS FLOAT)/bwaff.whole_br_provision_aff)*100) AS DECIMAL(10, 4)) end as 'br_cont_provision_aff', '10' as 'provision_allMark'
            from
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN (601,605,609,613,617,621) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_loanAdavnce_omis',
                SUM(CASE WHEN dd_pt_id  IN (601,605,609,613,617,621) THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_loanACNo_omis',
                SUM(CASE WHEN dd_pt_id  IN (601,605,609) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_conDemTermLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (613) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_agriLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (617, 621) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_otherLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (1809, 1813, 1817) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_clLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (8101) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_timeBarredLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (2401) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_rescheduleLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (2405) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_instwvefrmloan_omis',
                SUM(CASE WHEN dd_pt_id  IN (8401, 8701) THEN convert(money, dd_amt) ELSE NULL END) AS 'whole_br_suitundesoff_omis',
                SUM(CASE WHEN dd_pt_id  IN (8401, 8701) THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_nostundesoff_omis',
                SUM(CASE WHEN dd_pt_id  IN (2409) THEN convert(money, dd_ac) ELSE NULL END) AS 'whole_br_loanAdvRwriteoff_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $year2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $month2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $year2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $month2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934)
            ) bwomis, 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN (601,605,609,613,617,621) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_loanAdavnce_omis',
                SUM(CASE WHEN dd_pt_id  IN (601,605,609,613,617,621) THEN convert(money, dd_ac) ELSE NULL END) AS 'br_loanACNo_omis',
                SUM(CASE WHEN dd_pt_id  IN (601,605,609) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_conDemTermLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (613) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_agriLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (617, 621) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_otherLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (1809, 1813, 1817) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_clLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (8101) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_timeBarredLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (2401) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_rescheduleLoan_omis',
                SUM(CASE WHEN dd_pt_id  IN (2405) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_interestwaivefrmloan_omis',
                SUM(CASE WHEN dd_pt_id  IN (8401, 8701) THEN convert(money, dd_amt) ELSE NULL END) AS 'br_suitundesposedoff_omis',
                SUM(CASE WHEN dd_pt_id  IN (8401, 8701) THEN convert(money, dd_ac) ELSE NULL END) AS 'br_nosuitundesposedoff_omis',
                SUM(CASE WHEN dd_pt_id  IN (2409) THEN convert(money, dd_ac) ELSE NULL END) AS 'br_loanAdvRwriteoff_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $year2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $month2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $year2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $month2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) AND dd_jo_code='$office_id'
            ) bbomis,
            (
            SELECT 
            SUM(CASE WHEN SUPERVISION_COA_ID IN ('1010586') THEN convert(money, AMOUNT_BDT) ELSE 0 END ) AS 'whole_br_wtiteoffloan_iss',
            SUM(CASE WHEN SUPERVISION_COA_ID IN ('1010460') THEN convert(money, AMOUNT_BDT) ELSE 0 END ) AS 'whole_br_provisionsReq_iss'
            FROM [db_mis_ISS].[dbo].[$next_iss]
            )bwiss,
            (
            SELECT SUM(CASE WHEN SUPERVISION_COA_ID IN ('1010586') THEN convert(money, AMOUNT_BDT) ELSE 0 END ) AS 'br_wtiteoffloan_iss',
            SUM(CASE WHEN SUPERVISION_COA_ID IN ('1010460') THEN convert(money, AMOUNT_BDT) ELSE 0 END ) AS 'br_provisionsReq_iss'
            FROM [db_mis_ISS].[dbo].[$next_iss] where BRANCH_ID = (SELECT '12'+bbbrcode FROM [Db_DP_Collection_mgr].[dbo].[allinformation] where brcode='$office_id')
            )bbiss,
            (
            SELECT 
            SUM(CASE WHEN sub_head  IN ('00507') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_instsuspenseac_aff',
            SUM(CASE WHEN sub_head  IN ('00501', '00502') THEN convert(money, amount) ELSE NULL END) AS 'whole_br_provision_aff'
            FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] where bcode not in (0931,0932,0933,0934)
            ) bwaff,
            (
            SELECT 
            SUM(CASE WHEN sub_head  IN ('00507') THEN convert(money, amount) ELSE NULL END) AS 'br_instsuspenseac_aff',
            SUM(CASE WHEN sub_head  IN ('00501', '00502') THEN convert(money, amount) ELSE NULL END) AS 'br_provision_aff'
            FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] where bcode = '$office_id' 
            )bbaff");
            
            $data = array();
            $result_partbb = $part_b_b->result_array();
            $data['observation_loanAdvance'] = "Amount of Loans & Advances";
            $data['whole_br_loanAdavnce_omis'] = $result_partbb[0]['whole_br_loanAdavnce_omis'];
            $data['br_loanAdavnce_omis'] = $result_partbb[0]['br_loanAdavnce_omis'];
            $data['br_cont_loanAdvance_omis'] = $result_partbb[0]['br_cont_loanAdvance_omis'];
            $data['loanAdvance_allMark'] = $result_partbb[0]['br_cont_loanAdvance_allMark'];
            $data['loanAdvance_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_loanAdvance_omis'], $result_partbb[0]['br_cont_loanAdvance_allMark']);
            
            $data['observation_loanACNo'] = "Number of Borrowers";
            $data['whole_br_loanACNo_omis'] = $result_partbb[0]['whole_br_loanACNo_omis'];
            $data['br_loanACNo_omis'] = $result_partbb[0]['br_loanACNo_omis'];
            $data['br_cont_loanACNo_omis'] = $result_partbb[0]['br_cont_loanACNo_omis'];
            $data['loanACNo_allMark'] = $result_partbb[0]['br_cont_loanACNo_allMark'];
            $data['loanACNo_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_loanACNo_omis'], $result_partbb[0]['br_cont_loanACNo_allMark']);

            $data['observation_conDemTermLoan'] = "Amount of Continuous, Demand & Term Loans & Advances";
            $data['whole_br_conDemTermLoan_omis'] = $result_partbb[0]['whole_br_conDemTermLoan_omis'];
            $data['br_conDemTermLoan_omis'] = $result_partbb[0]['br_conDemTermLoan_omis'];
            $data['br_cont_conDemTermLoan_omis'] = $result_partbb[0]['br_cont_conDemTermLoan_omis'];
            $data['conDemTermLoan_allMark'] = $result_partbb[0]['br_cont_conDemTermLoan_allMark'];
            $data['conDemTermLoan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_conDemTermLoan_omis'], $result_partbb[0]['br_cont_conDemTermLoan_allMark']);

            $data['observation_agriLoan'] = "Amount of Agriculture Loans & Advances";
            $data['whole_br_agriLoan_omis'] = $result_partbb[0]['whole_br_agriLoan_omis'];
            $data['br_agriLoan_omis'] = $result_partbb[0]['br_agriLoan_omis'];
            $data['br_cont_agriLoan_omis'] = $result_partbb[0]['br_cont_agriLoan_omis'];
            $data['agriLoan_allMark'] = $result_partbb[0]['br_cont_agriLoan_allMark'];
            $data['agriLoan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_agriLoan_omis'], $result_partbb[0]['br_cont_agriLoan_allMark']);

            $data['observation_otherLoan'] = "Amount of Others Loans & Advances";
            $data['whole_br_otherLoan_omis'] = $result_partbb[0]['whole_br_otherLoan_omis'];
            $data['br_otherLoan_omis'] = $result_partbb[0]['br_otherLoan_omis'];
            $data['br_cont_otherLoan_omis'] = $result_partbb[0]['br_cont_otherLoan_omis'];
            $data['otherLoan_allMark'] = $result_partbb[0]['br_cont_otherLoan_allMark'];
            $data['otherLoan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_otherLoan_omis'], $result_partbb[0]['br_cont_otherLoan_allMark']);

            $data['observation_clLoan'] = "Total Amount of Classified Loans & Advances";
            $data['whole_br_clLoan_omis'] = $result_partbb[0]['whole_br_clLoan_omis'];
            $data['br_clLoan_omis'] = $result_partbb[0]['br_clLoan_omis'];
            $data['br_cont_clLoan_omis'] = $result_partbb[0]['br_cont_clLoan_omis'];
            $data['clLoan_allMark'] = $result_partbb[0]['br_cont_clLoan_allMark'];
            $data['clLoan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_clLoan_omis'], $result_partbb[0]['br_cont_clLoan_allMark']);

            $data['observation_timeBarredLoan'] = "Amount of Time Barred Loans & Advances";
            $data['whole_br_timeBarredLoan_omis'] = $result_partbb[0]['whole_br_timeBarredLoan_omis'];
            $data['br_timeBarredLoan_omis'] = $result_partbb[0]['br_timeBarredLoan_omis'];
            $data['br_cont_timeBarredLoan_omis'] = $result_partbb[0]['br_cont_timeBarredLoan_omis'];
            $data['timeBarredLoan_allMark'] = $result_partbb[0]['br_cont_timeBarredLoan_allMark'];
            $data['timeBarredLoan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_timeBarredLoan_omis'], $result_partbb[0]['br_cont_timeBarredLoan_allMark']);

            $data['observation_instsuspenseac'] = "Amount of Interest Suspense";
            $data['whole_br_instsuspenseac_aff'] = $result_partbb[0]['whole_br_instsuspenseac_aff'];
            $data['br_instsuspenseac_aff'] = $result_partbb[0]['br_instsuspenseac_aff'];
            $data['br_cont_instsuspenseac_aff'] = $result_partbb[0]['br_cont_instsuspenseac_aff'];
            $data['instsuspenseac_allMark'] = $result_partbb[0]['br_cont_instsuspenseac_allMark'];
            $data['instsuspenseac_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_instsuspenseac_aff'], $result_partbb[0]['br_cont_instsuspenseac_allMark']);

            $data['observation_rescheduleLoan'] = "Amount of Re-Schedule Loans & Advances";
            $data['whole_br_rescheduleLoan_omis'] = $result_partbb[0]['whole_br_rescheduleLoan_omis'];
            $data['br_rescheduleLoan_omis'] = $result_partbb[0]['br_rescheduleLoan_omis'];
            $data['br_cont_rescheduleLoan_omis'] = $result_partbb[0]['br_cont_rescheduleLoan_omis'];
            $data['rescheduleLoan_allMark'] = $result_partbb[0]['br_cont_rescheduleLoan_allMark'];
            $data['rescheduleLoan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_rescheduleLoan_omis'], $result_partbb[0]['br_cont_rescheduleLoan_allMark']);

            $data['observation_interestwaivefrmloan'] = "Amount of Interest Waiver from Loans & Advances";
            $data['whole_br_instwvefrmloan_omis'] = $result_partbb[0]['whole_br_instwvefrmloan_omis'];
            $data['br_interestwaivefrmloan_omis'] = $result_partbb[0]['br_interestwaivefrmloan_omis'];
            $data['br_cont_instwavfrmloan_omis'] = $result_partbb[0]['br_cont_instwavfrmloan_omis'];
            $data['interestwaivefrmloan_allMark'] = $result_partbb[0]['interestwaivefrmloan_allMark'];
            $data['interestwaivefrmloan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_instwavfrmloan_omis'], $result_partbb[0]['interestwaivefrmloan_allMark']);

            $data['observation_wtiteoffloan'] = "Outstanding amount of Write off Loans & Advances";
            $data['whole_br_wtiteoffloan_iss'] = $result_partbb[0]['whole_br_wtiteoffloan_iss'];
            $data['br_wtiteoffloan_iss'] = $result_partbb[0]['br_wtiteoffloan_iss'];
            $data['br_cont_wtiteoffloan_iss'] = $result_partbb[0]['br_cont_wtiteoffloan_iss'];
            $data['br_cont_wtiteoffloan_allMark'] = $result_partbb[0]['br_cont_wtiteoffloan_allMark'];
            $data['wtiteoffloan_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_wtiteoffloan_iss'], $result_partbb[0]['br_cont_wtiteoffloan_allMark']);

            $data['observation_suitundesposedoff'] = "Amount of Suit/Cases Un-deposed off";
            $data['whole_br_suitundesoff_omis'] = $result_partbb[0]['whole_br_suitundesoff_omis'];
            $data['br_suitundesposedoff_omis'] = $result_partbb[0]['suitundesposedoff_omis'];
            $data['br_cont_suitundesposedoff_omis'] = $result_partbb[0]['suitundesposedoff_omis'];
            $data['suitundesposedoff_allMark'] = $result_partbb[0]['suitundesposedoff_allMark'];
            $data['suitundesposedoff_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['suitundesposedoff_omis'], $result_partbb[0]['suitundesposedoff_allMark']);
    
            $data['observation_nosuitundesposedoff'] = "Total No. of Suit/Cases Un-deposed off";
            $data['whole_br_nostundesoff_omis'] = $result_partbb[0]['whole_br_nostundesoff_omis'];
            $data['br_nosuitundesposedoff_omis'] = $result_partbb[0]['br_nosuitundesposedoff_omis'];
            $data['br_cont_nosuitundesposedoff_omis'] = $result_partbb[0]['suitundesposedoff_omis'];
            $data['nosuitundesposedoff_allMark'] = $result_partbb[0]['nosuitundesposedoff_allMark'];
            $data['nosuitundesposedoff_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['nosuitundesposedoff_omis'], $result_partbb[0]['nosuitundesposedoff_allMark']);

            $data['observation_loanAdvRwriteoff'] = "Recovery of Loans & Advances from Write Off";
            $data['whole_br_loanAdvRwriteoff_omis'] = $result_partbb[0]['whole_br_loanAdvRwriteoff_omis'];
            $data['br_loanAdvRwriteoff_omis'] = $result_partbb[0]['br_loanAdvRwriteoff_omis'];
            $data['br_cont_loanAdvRwriteoff_omis'] = $result_partbb[0]['br_cont_loanAdvRwriteoff_omis'];
            $data['loanAdvRwriteoff_allMark'] = $result_partbb[0]['loanAdvRwriteoff_allMark'];
            $data['loanAdvRwriteoff_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_loanAdvRwriteoff_omis'], $result_partbb[0]['loanAdvRwriteoff_allMark']);

            $data['observation_provision'] = "Provision for bad debts & Other Assets";
            $data['whole_br_provision_aff'] = $result_partbb[0]['whole_br_provision_aff'];
            $data['br_provision_aff'] = $result_partbb[0]['br_provision_aff'];
            $data['br_cont_provision_aff'] = $result_partbb[0]['br_cont_provision_aff'];
            $data['provision_allMark'] = $result_partbb[0]['provision_allMark'];
            $data['provision_obtained_mark'] = $this->part_b_b_obtained_mark_($result_partbb[0]['br_cont_provision_aff'], $result_partbb[0]['provision_allMark']);

                       
            return $data;
        }
    }
    function part_b_b_obtained_mark_($br_cont, $allocated_mark = 0){
        
        $obtained_mark = 0;
        if(!is_numeric($br_cont)){
            return 0;
        }else{
            if($br_cont >= .10){
                $obtained_mark = $allocated_mark;    
            }else if($br_cont >= .04 && $br_cont < .10){
                if($allocated_mark == 5){$obtained_mark = 4;}
                if($allocated_mark == 10){$obtained_mark = 8;}
                if($allocated_mark == 15){$obtained_mark = 12;}
                if($allocated_mark == 20){$obtained_mark = 16;}
            }else if($br_cont >= .005 && $br_cont < .04){
                if($allocated_mark == 5){$obtained_mark = 3;}
                if($allocated_mark == 10){$obtained_mark = 6;}
                if($allocated_mark == 15){$obtained_mark = 9;}
                if($allocated_mark == 20){$obtained_mark = 12;}
            }else if($br_cont >= 0 && $br_cont < .005){
                if($allocated_mark == 5){$obtained_mark = 2;}
                if($allocated_mark == 10){$obtained_mark = 4;}
                if($allocated_mark == 15){$obtained_mark = 6;}
                if($allocated_mark == 20){$obtained_mark = 8;}
            }else if($br_cont < 0){
                if($br_cont < 0){
                    if($allocated_mark == 5){$obtained_mark = 1;}
                    if($allocated_mark == 10){$obtained_mark = 2;}
                    if($allocated_mark == 15){$obtained_mark = 3;}
                    if($allocated_mark == 20){$obtained_mark = 4;}
                }
            }
            return $obtained_mark;
        }   
    }

    function fetch_part_b_a_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $yr2='';
            $mon2='';           
            $nextDsa = '';
            $next_omis = '';
            if($year1>$year2){
                $mon2 = $month1;
                $yr2 = $year1;
                $nextDsa = 'DSA'.$month1.$year1;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            }else{
                $mon2 = $month2;
                $yr2 = $year2;
                $nextDsa = 'DSA'.$month2.$year2;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
            }
            $part_b_a =  $this->db->query("SELECT 
            awaff.whole_deposit, abaff.br_deposit,
            case when awaff.whole_deposit = 0 or abaff.br_deposit = 0 then NULL
                else ((abaff.br_deposit/awaff.whole_deposit)*100) end as 'br_cont_ttl_deposit_omis', '10' as 'br_cont_deposit_allMark',
            awomis.whole_br_no_ac_OMIS, abomis.br_no_ac_OMIS,
            case when awomis.whole_br_no_ac_OMIS = 0 or abomis.br_no_ac_OMIS = 0 then NULL
                else ((abomis.br_no_ac_OMIS/awomis.whole_br_no_ac_OMIS)*100) end as 'br_cont_no_ac_deposit_omis', '5' as 'br_cont_no_ac_deposit_allMark',
            awaffb.whole_high_deposit, abaffb.br_high_deposit,
            case when awaffb.whole_high_deposit = 0 or abaffb.br_high_deposit = 0 then NULL
                else ((abaffb.br_high_deposit/awaffb.whole_high_deposit)*100) end as 'br_cont_ttl_high_deposit_omis', '15' as 'br_cont_high_deposit_allMark'
            from
            (
            SELECT 
            SUM(convert(money, amount)) AS 'whole_deposit' FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] 
            where LEFT(sub_head, 3)='002' AND bcode not in (0931, 0932, 0933, 0934)
            )awaff,
            (
            SELECT 
            SUM(convert(money, amount)) AS 'br_deposit' FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] 
            where LEFT(sub_head, 3)='002' AND bcode not in ('$office_id')
            )abaff,
            (
            SELECT
                SUM(CASE WHEN sub_head  IN ('00213', '00243', '00242', '00241', '00240', '00239', '00238', '00237', '00236', '00235', '00234',
                '00233', '00229', '00228', '00227', '00219', '00218', '00210') THEN convert(money, amount) ELSE 0 END) AS 'whole_high_deposit'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] 
            where bcode not in (0931, 0932, 0933, 0934)
            ) awaffb, 
            (
                SELECT 
                SUM(CASE WHEN sub_head  IN ('00213', '00243', '00242', '00241', '00240', '00239', '00238', '00237', '00236', '00235', '00234',
                '00233', '00229', '00228', '00227', '00219', '00218', '00210') THEN convert(money, amount) ELSE 0 END) AS 'br_high_deposit'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa]  where bcode='$office_id'
            ) abaffb, 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN (101,105,109,113,117,121,125,301) THEN convert(money, dd_ac) ELSE 0 END) AS 'whole_br_no_ac_OMIS'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934)
            ) awomis, 
            (
            SELECT 
                SUM(CASE WHEN dd_pt_id  IN (101,105,109,113,117,121,125,301) THEN convert(money, dd_ac) ELSE 0 END) AS 'br_no_ac_OMIS'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) AND dd_jo_code='$office_id'
            ) abomis");
            
            $data = array();
            $result_partba = $part_b_a->result_array();
            
            $data['observation_deposit'] = "Total Deposit";
            $data['whole_deposit'] = $result_partba[0]['whole_deposit'];
            $data['br_deposit'] = $result_partba[0]['br_deposit'];
            $data['br_cont_ttl_deposit_omis'] = $result_partba[0]['br_cont_ttl_deposit_omis'];
            $data['br_cont_deposit_allMark'] = $result_partba[0]['br_cont_deposit_allMark'];
            $data['br_cont_deposit_obtained_mark'] = $this->part_b_a_obtained_mark_from_br_cont($result_partba[0]['br_cont_ttl_deposit_omis'], $result_partba[0]['br_cont_deposit_allMark']);

            $data['observation_noac'] = "No. of Accounts";
            $data['whole_br_no_ac_OMIS'] = $result_partba[0]['whole_br_no_ac_OMIS'];
            $data['br_no_ac_OMIS'] = $result_partba[0]['br_no_ac_OMIS'];
            $data['br_cont_no_ac_deposit_omis'] = $result_partba[0]['br_cont_no_ac_deposit_omis'];
            $data['br_cont_no_ac_deposit_allMark'] = $result_partba[0]['br_cont_no_ac_deposit_allMark'];
            $data['br_cont_noac_deposit_obtained_mark'] = $this->part_b_a_obtained_mark_from_br_cont($result_partba[0]['br_cont_no_ac_deposit_omis'], $result_partba[0]['br_cont_no_ac_deposit_allMark']);

            $data['observation_highcost'] = "Amount of High Cost Deposit (FDR & schemes)";
            $data['whole_high_deposit'] = $result_partba[0]['whole_high_deposit'];
            $data['br_high_deposit'] = $result_partba[0]['br_high_deposit'];
            $data['br_cont_ttl_high_deposit_omis'] = $result_partba[0]['br_cont_ttl_high_deposit_omis'];
            $data['br_cont_high_deposit_allMark'] = $result_partba[0]['br_cont_high_deposit_allMark'];
            $data['br_cont_high_deposit_obtained_mark'] = $this->part_b_a_obtained_mark_from_br_cont($result_partba[0]['br_cont_ttl_high_deposit_omis'], $result_partba[0]['br_cont_high_deposit_allMark']);
                        
            return $data;
        }
    }
    function part_b_a_obtained_mark_from_br_cont($br_cont, $allocated_mark = 0){
        
        $obtained_mark = 0;
        if(!is_numeric($br_cont)){
            return 0;
        }else{
            if($br_cont >= .10){
                $obtained_mark = $allocated_mark;    
            }else if($br_cont >= .04 && $br_cont < .10){
                if($allocated_mark == 5){$obtained_mark = 4;}
                if($allocated_mark == 10){$obtained_mark = 8;}
                if($allocated_mark == 15){$obtained_mark = 12;}
                if($allocated_mark == 20){$obtained_mark = 16;}
            }else if($br_cont >= .005 && $br_cont < .04){
                if($allocated_mark == 5){$obtained_mark = 3;}
                if($allocated_mark == 10){$obtained_mark = 6;}
                if($allocated_mark == 15){$obtained_mark = 9;}
                if($allocated_mark == 20){$obtained_mark = 12;}
            }else if($br_cont >= 0 && $br_cont < .005){
                if($allocated_mark == 5){$obtained_mark = 2;}
                if($allocated_mark == 10){$obtained_mark = 4;}
                if($allocated_mark == 15){$obtained_mark = 6;}
                if($allocated_mark == 20){$obtained_mark = 8;}
            }else if($br_cont < 0){
                if($br_cont < 0){
                    if($allocated_mark == 5){$obtained_mark = 1;}
                    if($allocated_mark == 10){$obtained_mark = 2;}
                    if($allocated_mark == 15){$obtained_mark = 3;}
                    if($allocated_mark == 20){$obtained_mark = 4;}
                }
            }
            return $obtained_mark;
        }   
    }

    function fetch_part_a_h_data($office_id=0, $month1='', $year1='', $month2='', $year2='')
    {
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $preDsa = ''; $nextDsa = '';
            $pre_omis=''; $next_omis= '';
            $yr1='';$mon1=''; $yr2='';$mon2='';
            $pre_backpage = ''; $next_backpage = '';
            $pre_iss = ''; $next_iss = '';
            if($year1>$year2){
                $yr1 = $year2; $mon1 = $month2;
                $yr2=$year1;$mon2=$month1;
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;
                $pre_backpage = 'backpage'.$month2.$year2; 
                $next_backpage = 'backpage'.$month1.$year1;

                $pre_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
                $pre_iss = 'T_PS_M_FI_MONITOR_BR_'.$month2.$year2; 
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month1.$year1;
                
            }else{
                $yr1 = $year1; $mon1 = $month1;
                $yr2=$year2;$mon2=$month2;

                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;

                $pre_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
                $pre_backpage = 'backpage'.$month1.$year1; 
                $next_backpage = 'backpage'.$month2.$year2;
                $pre_iss = 'T_PS_M_FI_MONITOR_BR_'.$month1.$year1; 
                $next_iss = 'T_PS_M_FI_MONITOR_BR_'.$month2.$year2;
            }
            $part_a_h =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode,
            b.preamtofsuit_omis, c.nextamtofsuit_omis,
            case when b.preamtofsuit_omis = 0 or c.nextamtofsuit_omis = 0 then NULL
                else (((c.nextamtofsuit_omis - b.preamtofsuit_omis)/b.preamtofsuit_omis)*100) end as 'grth_amtofsuit_omis', '5' as 'amtofsuit_omis_allMark',
            d.preexsscash_limit_iss, e.nextexsscashlimit_iss,
            case when d.preexsscash_limit_iss = 0 or e.nextexsscashlimit_iss = 0 then NULL
                else (((e.nextexsscashlimit_iss - d.preexsscash_limit_iss)/d.preexsscash_limit_iss)*100) end as 'grth_exsscashlimit_iss', '5' as 'exsscashlimit_iss_allMark',
                f.pre_prov_loanAd_aff, g.next_prov_loanAd_aff,
                case when g.next_prov_loanAd_aff = 0 or f.pre_prov_loanAd_aff = 0 then NULL 
                else (((g.next_prov_loanAd_aff - f.pre_prov_loanAd_aff)/f.pre_prov_loanAd_aff)*100) end as 'grth_prov_loanAd_aff', 
                '5' as 'prov_loanAd_allMark'     
            FROM Db_DP_Collection_mgr..allinformation AS a
            JOIN (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN ('8401', '8701') THEN convert(money, dd_ac) ELSE 0 END) AS 'preamtofsuit_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$pre_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr1 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon1) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr1 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon1)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) b ON b.dd_jo_code=a.brcode
            JOIN (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN ('8401', '8701') THEN convert(money, dd_ac) ELSE 0 END) AS 'nextamtofsuit_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) c ON c.dd_jo_code=a.brcode
            JOIN (SELECT BRANCH_ID, 
                SUM(CASE WHEN SUPERVISION_COA_ID='1011667' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 END) AS 'preexsscash_limit_iss'
                FROM [db_mis_ISS].[dbo].[$pre_iss] GROUP BY BRANCH_ID 
            ) d ON '12'+a.bbbrcode = d.BRANCH_ID 
            JOIN (SELECT BRANCH_ID, 
                SUM(CASE WHEN SUPERVISION_COA_ID='1011667' THEN convert(numeric(18, 2), AMOUNT_BDT) ELSE 0 END) AS 'nextexsscashlimit_iss'
                FROM [db_mis_ISS].[dbo].[$next_iss] GROUP BY BRANCH_ID 
            ) e ON '12'+a.bbbrcode = e.BRANCH_ID
            JOIN
            (
            SELECT bcode,
            SUM(CASE WHEN sub_head  IN ('00501') THEN convert(money, amount) ELSE NULL END) AS 'pre_prov_loanAd_aff'
            FROM [Db_DP_Collection_mgr].[dbo].[$preDsa] GROUP BY bcode
            ) f ON a.brcode= f.bcode
            JOIN
            (
            SELECT bcode,
            SUM(CASE WHEN sub_head  IN ('00501') THEN convert(money, amount) ELSE NULL END) AS 'next_prov_loanAd_aff'
            FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] GROUP BY bcode
            ) g ON a.brcode= g.bcode 
            AND a.brcode in ('$office_id')
            order by a.dvname, a.branchname");
            
            $data = array();
            $result_parth = $part_a_h->result_array();

            $data['observation_amtofsuit'] = "Total amount of SUit";
            $data['preamtofsuit_omis'] = $result_parth[0]['preamtofsuit_omis'];
            $data['nextamtofsuit_omis'] = $result_parth[0]['nextamtofsuit_omis'];
            $data['grth_amtofsuit_omis'] = $result_parth[0]['grth_amtofsuit_omis'];
            $data['amtofsuit_omis_allMark'] = $result_parth[0]['amtofsuit_omis_allMark'];
            $data['amtofsuit_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parth[0]['grth_amtofsuit_omis'], $result_parth[0]['amtofsuit_omis_allMark']);

            $data['observation_prov_loanAd'] = "Provision for Loans & Advances";
            $data['pre_prov_loanAd_aff'] = $result_parth[0]['pre_prov_loanAd_aff'];
            $data['next_prov_loanAd_aff'] = $result_parth[0]['next_prov_loanAd_aff'];
            $data['grth_prov_loanAd_aff'] = $result_parth[0]['grth_prov_loanAd_aff'];
            $data['prov_loanAd_allMark'] = $result_parth[0]['prov_loanAd_allMark'];
            $data['prov_loanAd_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parth[0]['grth_prov_loanAd_aff'], $result_parth[0]['prov_loanAd_allMark']);
            
            $data['observation_exsscashlimit'] = "Excess of Cash over Cash Limit";
            $data['preexsscash_limit_iss'] = $result_parth[0]['preexsscash_limit_iss'];
            $data['nextexsscashlimit_iss'] = $result_parth[0]['nextexsscashlimit_iss'];
            $data['grth_exsscashlimit_iss'] = $result_parth[0]['grth_exsscashlimit_iss'];
            $data['exsscashlimit_iss_allMark'] = $result_parth[0]['exsscashlimit_iss_allMark'];
            $data['exsscashlimit_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parth[0]['grth_exsscashlimit_iss'], $result_parth[0]['exsscashlimit_iss_allMark']);
                       
            return $data;
        }
    }
    function fetch_part_a_g_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $preDsa = ''; $nextDsa = '';
            $pre_omis=''; $next_omis= '';
            $yr1='';$mon1=''; $yr2='';$mon2='';
            $pre_backpage = ''; $next_backpage = '';
            if($year1>$year2){
                $yr1 = $year2; $mon1 = $month2;
                $yr2=$year1;$mon2=$month1;
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;
                $pre_backpage = 'backpage'.$month2.$year2; 
                $next_backpage = 'backpage'.$month1.$year1;

                $pre_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            }else{
                $yr1 = $year1; $mon1 = $month1;
                $yr2=$year2;$mon2=$month2;

                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;

                $pre_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
                $pre_backpage = 'backpage'.$month1.$year1; 
                $next_backpage = 'backpage'.$month2.$year2;
            }

            $part_a_g =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode,
            b.pre_regular_audit_obj_omis, c.next_regular_audit_obj_omis,
            case when b.pre_regular_audit_obj_omis = 0 or c.next_regular_audit_obj_omis = 0 then NULL
                else (((c.next_regular_audit_obj_omis - b.pre_regular_audit_obj_omis)/b.pre_regular_audit_obj_omis)*100) end as 'grth_regular_audit_obj_omis',
            '10' as 'regular_audit_obj_allMark',
            b.pre_other_audit_obj_omis, c.next_other_audit_obj_omis,
            case when b.pre_other_audit_obj_omis = 0 or c.next_other_audit_obj_omis = 0 then NULL
                else (((c.next_other_audit_obj_omis - b.pre_other_audit_obj_omis)/b.pre_other_audit_obj_omis)*100) end as 'grth_other_audit_obj_omis',
            '5' as 'other_audit_obj_allMark',
            b.pre_reg_audit_compl_omis, c.next_reg_audit_compl_omis,
            case when b.pre_reg_audit_compl_omis = 0 or c.next_reg_audit_compl_omis = 0 then NULL
                else (((c.next_reg_audit_compl_omis - b.pre_reg_audit_compl_omis)/b.pre_reg_audit_compl_omis)*100) end as 'grth_regular_audit_obj_compliance_omis',
            '5' as 'regular_audit_compl_allMark',    
            b.pre_ot_audit_compl_omis, c.next_ot_audit_compl_omis,
            case when b.pre_ot_audit_compl_omis = 0 or c.next_ot_audit_compl_omis = 0 then NULL
                else (((c.next_ot_audit_compl_omis - b.pre_ot_audit_compl_omis)/b.pre_ot_audit_compl_omis)*100) end as 'grth_other_audit_obj_compliance_omis',
            '10' as 'other_audit_compl_allMark'
            FROM Db_DP_Collection_mgr..allinformation AS a
            JOIN (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN ('3609') THEN convert(money, dd_ac) ELSE NULL END) AS 'pre_regular_audit_obj_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3601', '3605', '3613') THEN convert(money, dd_ac) ELSE NULL END) AS 'pre_other_audit_obj_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3909') THEN convert(money, dd_ac) ELSE NULL END) AS 'pre_reg_audit_compl_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3901', '3905', '3913') THEN convert(money, dd_ac) ELSE NULL END) AS 'pre_ot_audit_compl_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$pre_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr1 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon1) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr1 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon1)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) b ON b.dd_jo_code=a.brcode
            JOIN (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN ('3609') THEN convert(money, dd_ac) ELSE NULL END) AS 'next_regular_audit_obj_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3601', '3605', '3613') THEN convert(money, dd_ac) ELSE NULL END) AS 'next_other_audit_obj_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3909') THEN convert(money, dd_ac) ELSE NULL END) AS 'next_reg_audit_compl_omis',
                SUM(CASE WHEN dd_pt_id  IN ('3901', '3905', '3913') THEN convert(money, dd_ac) ELSE NULL END) AS 'next_ot_audit_compl_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) c ON c.dd_jo_code=a.brcode
            AND a.brcode in ('$office_id')
            order by a.dvname, a.branchname");

            
            $data = array();
            $result_partg = $part_a_g->result_array();
           
            $data['observation_regular_audit_obj'] = "Regular Audit Objection";
            $data['pre_regular_audit_obj_omis'] = $result_partg[0]['pre_regular_audit_obj_omis'];
            $data['next_regular_audit_obj_omis'] = $result_partg[0]['next_regular_audit_obj_omis'];
            $data['grth_regular_audit_obj_omis'] = $result_partg[0]['grth_regular_audit_obj_omis'];
            $data['regular_audit_obj_allMark'] = $result_partg[0]['regular_audit_obj_allMark'];
            $data['regular_audit_obj_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_partg[0]['grth_regular_audit_obj_omis'], $result_partg[0]['regular_audit_obj_allMark']);
            
            
            $data['observation_other_audit_obj'] = "Others(Govt. Commercial Audit, BB Audit, External Audit/CA Firm Audit. etc)";
            $data['pre_other_audit_obj_omis'] = $result_partg[0]['pre_other_audit_obj_omis'];
            $data['next_other_audit_obj_omis'] = $result_partg[0]['next_other_audit_obj_omis'];
            $data['grth_other_audit_obj_omis'] = $result_partg[0]['grth_other_audit_obj_omis'];
            $data['other_audit_obj_allMark'] = $result_partg[0]['other_audit_obj_allMark'];
            $data['other_audit_obj_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_partg[0]['grth_other_audit_obj_omis'], $result_partg[0]['other_audit_obj_allMark']);

            $data['observation_regular_audit_compliance'] = "Compliance of Regular Audit Objections";
            $data['pre_reg_audit_compl_omis'] = $result_partg[0]['pre_reg_audit_compl_omis'];
            $data['next_reg_audit_compl_omis'] = $result_partg[0]['next_reg_audit_compl_omis'];
            $data['grth_regular_audit_obj_complia'] = $result_partg[0]['grth_regular_audit_obj_complia'];
            $data['regular_audit_compl_allMark'] = $result_partg[0]['regular_audit_compl_allMark'];
            $data['regular_audit_compliance_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_partg[0]['grth_regular_audit_obj_complia'], $result_partg[0]['regular_audit_compl_allMark']);

      
            $data['observation_other_audit_compliance'] = "Comliance of other Audit Objections(Govt. Commercial Audit, BB Audit, External Audit/CA Firm Audit. etc)";
            $data['pre_ot_audit_compl_omis'] = $result_partg[0]['pre_ot_audit_compl_omis'];
            $data['next_ot_audit_compl_omis'] = $result_partg[0]['next_ot_audit_compl_omis'];
            $data['grth_other_audit_obj_complianc'] = $result_partg[0]['grth_other_audit_obj_complianc'];
            $data['other_audit_compl_allMark'] = $result_partg[0]['other_audit_compl_allMark'];
            $data['other_audit_compliance_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_partg[0]['grth_other_audit_obj_complianc'], $result_partg[0]['other_audit_compl_allMark']);
                       
            return $data;
        }
    }

    function fetch_part_a_f_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $preDsa = ''; $nextDsa = '';
            $pre_omis=''; $next_omis= '';
            $yr1='';$mon1=''; $yr2='';$mon2='';
            $pre_backpage = ''; $next_backpage = '';
            if($year1>$year2){
                $yr1 = $year2; $mon1 = $month2;
                $yr2=$year1;$mon2=$month1;
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;
                $pre_backpage = 'backpage'.$month2.$year2; 
                $next_backpage = 'backpage'.$month1.$year1;

                $pre_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            }else{
                $yr1 = $year1; $mon1 = $month1;
                $yr2=$year2;$mon2=$month2;

                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;

                $pre_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
                $pre_backpage = 'backpage'.$month1.$year1; 
                $next_backpage = 'backpage'.$month2.$year2;
            }

            $part_a_f =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode,
            d.pre_protested, e.next_protested,
            case when d.pre_protested = 0 or e.next_protested = 0 then NULL
                else (((e.next_protested - d.pre_protested)/d.pre_protested)*100) end as 'grth_protested',
             '5' as 'protested_all_mark',   
            f.pre_remittance_omis, g.next_remittance_omis,
            case when f.pre_remittance_omis = 0 or g.next_remittance_omis = 0 then NULL
                else (((g.next_remittance_omis - f.pre_remittance_omis)/f.pre_remittance_omis)*100) end as 'grth_remittance',
            '5' as 'remittance_all_mark',
            d.pre_armypension, e.next_armypension,
            case when d.pre_armypension = 0 or e.next_armypension = 0 then NULL
                else (((e.next_armypension - d.pre_armypension)/d.pre_armypension)*100) end as 'grth_armypension',
            '5' as 'armypension_all_mark',    
            d.pre_other, e.next_other,
            case when d.pre_other = 0 or e.next_other = 0 then NULL
                else (((e.next_other - d.pre_other)/d.pre_other)*100) end as 'grth_other',
            '5' as 'other_all_mark',    
            b.pre_OIBTDR, c.next_OIBTDR,
            case when b.pre_OIBTDR = 0 or c.next_OIBTDR = 0 then NULL
                else (((c.next_OIBTDR - b.pre_OIBTDR)/b.pre_OIBTDR)*100) end as 'grth_OIBTDR',
            '10' as 'OIBTDR_all_mark',        
            b.pre_ADVDEPSTSHPB, c.next_ADVDEPSTSHPB,
            case when b.pre_ADVDEPSTSHPB = 0 or c.next_ADVDEPSTSHPB = 0 then NULL
                else (((c.next_ADVDEPSTSHPB - b.pre_ADVDEPSTSHPB)/b.pre_ADVDEPSTSHPB)*100) end as 'grth_ADVDEPSTSHPB',
            '5' as 'ADVDEPSTSHPB_all_mark',
            d.pre_sundryDeb, e.next_sundryDeb,
            case when d.pre_sundryDeb = 0 or e.next_sundryDeb = 0 then NULL
	        else (((e.next_sundryDeb - d.pre_sundryDeb)/d.pre_sundryDeb)*100) end as 'grth_sundryDeb', '5' as 'sundryDeb_all_mark',
	          d.pre_susOther, e.next_susOther,
             case when d.pre_susOther = 0 or e.next_susOther = 0 then NULL
	         else (((e.next_susOther - d.pre_susOther)/d.pre_susOther)*100) end as 'grth_susOther', '5' as 'susOther_all_mark'
            FROM Db_DP_Collection_mgr..allinformation AS a
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('11401') THEN convert(money, amount) ELSE 0 END) AS 'pre_OIBTDR',
                SUM(CASE WHEN sub_head  IN ('10703', '10704', '10706', '10707') THEN convert(money, amount) ELSE 0 END) AS 'pre_ADVDEPSTSHPB'
                FROM [Db_DP_Collection_mgr].[dbo].[$preDsa] 
                GROUP BY bcode
            ) b ON b.bcode=a.brcode 
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('11401') THEN convert(money, amount) ELSE 0 END) AS 'next_OIBTDR',
                SUM(CASE WHEN sub_head  IN ('10703', '10704', '10706', '10707') THEN convert(money, amount) ELSE 0 END) AS 'next_ADVDEPSTSHPB'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] 
                GROUP BY bcode
            ) c ON c.bcode=a.brcode 
            JOIN(
            SELECT bcode,
            SUM(CASE WHEN scode  IN ('1070518', '1070520', '1070522', '1070524', '1070502', '1070515', '1070516', '1070519', '1070521',
             '1070523', '1070509', '1070510', '1070511', '1070512', '1070513', '1070514', '1070503', '1070504',
             '1070505', '1070506', '1070507', '1070508') THEN convert(money, amount) ELSE 0 END) AS 'pre_susOther',
             SUM(CASE WHEN scode  IN ('1070501') THEN convert(money, amount) ELSE 0 END) AS 'pre_sundryDeb',
            SUM(CASE WHEN scode  IN ('1071409') THEN convert(money, amount) ELSE 0 END) AS 'pre_protested',
            SUM(CASE WHEN scode  IN ('1071418') THEN convert(money, amount) ELSE 0 END) AS 'pre_armypension',
            SUM(CASE WHEN scode  IN ('1071443', '1071444', '1071401', '1071402', '1071403', '1071404', '1071442', '1071441', '1071436',
            '1071437', '1071438', '1071439', '1071440', '1071426', '1071427', '1071428', '1071429', '1071417', '1071420', '1071421',
            '1071422', '1071423', '1071424', '1071411', '1071412', '1071413', '1071414', '1071415', '1071416', '1071405', '1071406',
            '1071407', '1071408', '1071410', '1071419', '1071430', '1071431', '1071432', '1071433', '1071434', '1071435', '1071425') THEN convert(money, amount) ELSE 0 END) AS 'pre_other'
            FROM [Db_DP_Collection_mgr].[dbo].[$pre_backpage] 
                GROUP BY bcode
            ) d ON d.bcode=a.brcode
            JOIN(
            SELECT bcode,
            SUM(CASE WHEN scode  IN ('1070518', '1070520', '1070522', '1070524', '1070502', '1070515', '1070516', '1070519', '1070521',
         '1070523', '1070509', '1070510', '1070511', '1070512', '1070513', '1070514', '1070503', '1070504',
         '1070505', '1070506', '1070507', '1070508') THEN convert(money, amount) ELSE 0 END) AS 'next_susOther',
          SUM(CASE WHEN scode  IN ('1070501') THEN convert(money, amount) ELSE 0 END) AS 'next_sundryDeb',
            SUM(CASE WHEN scode  IN ('1071409') THEN convert(money, amount) ELSE 0 END) AS 'next_protested',
            SUM(CASE WHEN scode  IN ('1071418') THEN convert(money, amount) ELSE 0 END) AS 'next_armypension',
            SUM(CASE WHEN scode  IN ('1071443', '1071444', '1071401', '1071402', '1071403', '1071404', '1071442', '1071441', '1071436',
            '1071437', '1071438', '1071439', '1071440', '1071426', '1071427', '1071428', '1071429', '1071417', '1071420', '1071421',
            '1071422', '1071423', '1071424', '1071411', '1071412', '1071413', '1071414', '1071415', '1071416', '1071405', '1071406',
            '1071407', '1071408', '1071410', '1071419', '1071430', '1071431', '1071432', '1071433', '1071434', '1071435', '1071425') THEN convert(money, amount) ELSE 0 END) AS 'next_other'
            FROM [Db_DP_Collection_mgr].[dbo].[$next_backpage] 
                GROUP BY bcode
            ) e ON e.bcode=a.brcode
            JOIN (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN ('3001') THEN convert(money, dd_amt) ELSE 0 END) AS 'pre_remittance_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$pre_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr1 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon1) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr1 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon1)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) f ON f.dd_jo_code=a.brcode
            JOIN (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN ('3001') THEN convert(money, dd_amt) ELSE 0 END) AS 'next_remittance_omis'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) g ON g.dd_jo_code=a.brcode
            AND a.brcode in ('$office_id')
            order by a.dvname, a.branchname");
            
            $data = array();
            $result_parta = $part_a_f->result_array();
            

            $data['observation_protested'] = "Protested Bill";
            $data['pre_protested'] = $result_parta[0]['pre_protested'];
            $data['next_protested'] = $result_parta[0]['next_protested'];
            $data['grth_protested'] = $result_parta[0]['grth_protested'];
            $data['protested_all_mark'] = $result_parta[0]['protested_all_mark'];
            $data['protested_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_protested'], $result_parta[0]['protested_all_mark']);

            $data['observation_armypension'] = "Army Pension";
            $data['pre_armypension'] = $result_parta[0]['pre_armypension'];
            $data['next_armypension'] = $result_parta[0]['next_armypension'];
            $data['grth_armypension'] = $result_parta[0]['grth_armypension'];
            $data['armypension_all_mark'] = $result_parta[0]['armypension_all_mark'];
            $data['armypension_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_armypension'], $result_parta[0]['armypension_all_mark']);

            $data['observation_other'] = "Others";
            $data['pre_other'] = $result_parta[0]['pre_other'];
            $data['next_other'] = $result_parta[0]['next_other'];
            $data['grth_other'] = $result_parta[0]['grth_other'];
            $data['other_all_mark'] = $result_parta[0]['other_all_mark'];
            $data['other_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_other'], $result_parta[0]['other_all_mark']);
           
            $data['observation_remittance'] = "Instant Cash & All Spot Cash (Foreign Remittance)";
            $data['pre_remittance_omis'] = $result_parta[0]['pre_remittance_omis'];
            $data['next_remittance_omis'] = $result_parta[0]['next_remittance_omis'];
            $data['grth_remittance'] = $result_parta[0]['grth_remittance'];
            $data['remittance_all_mark'] = $result_parta[0]['remittance_all_mark'];
            $data['remittance_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_remittance'], $result_parta[0]['remittance_all_mark']);

            $data['observation_sundryDeb'] = "Sundry debtors";
            $data['pre_sundryDeb'] = $result_parta[0]['pre_sundryDeb'];
            $data['next_sundryDeb'] = $result_parta[0]['next_sundryDeb'];
            $data['grth_sundryDeb'] = $result_parta[0]['grth_sundryDeb'];
            $data['sundryDeb_all_mark'] = $result_parta[0]['sundryDeb_all_mark'];
            $data['sundryDeb_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_sundryDeb'], $result_parta[0]['sundryDeb_all_mark']);

            $data['observation_susOther'] = "Others (Incentive, Bonus, Exgratia, Postage, Petty Cash etc.)";
            $data['pre_susOther'] = $result_parta[0]['pre_susOther'];
            $data['next_susOther'] = $result_parta[0]['next_susOther'];
            $data['grth_susOther'] = $result_parta[0]['grth_susOther'];
            $data['susOther_all_mark'] = $result_parta[0]['susOther_all_mark'];
            $data['susOther_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_susOther'], $result_parta[0]['susOther_all_mark']);

            $data['observation_OIBTDR'] = "Online Inter Br. Transaction (OIBT)-Dr";
            $data['pre_OIBTDR'] = $result_parta[0]['pre_OIBTDR'];
            $data['next_OIBTDR'] = $result_parta[0]['next_OIBTDR'];
            $data['grth_OIBTDR'] = $result_parta[0]['grth_OIBTDR'];
            $data['OIBTDR_all_mark'] = $result_parta[0]['OIBTDR_all_mark'];
            $data['OIBTDR_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_OIBTDR'], $result_parta[0]['OIBTDR_all_mark']);

            $data['observation_ADVDEPSTSHPB'] = "Advance Deposit, STock of Stationary, Stamps in hand & Prize bond.";
            $data['pre_ADVDEPSTSHPB'] = $result_parta[0]['pre_ADVDEPSTSHPB'];
            $data['next_ADVDEPSTSHPB'] = $result_parta[0]['next_ADVDEPSTSHPB'];
            $data['grth_ADVDEPSTSHPB'] = $result_parta[0]['grth_ADVDEPSTSHPB'];
            $data['ADVDEPSTSHPB_all_mark'] = $result_parta[0]['ADVDEPSTSHPB_all_mark'];
            $data['ADVDEPSTSHPB_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_ADVDEPSTSHPB'], $result_parta[0]['ADVDEPSTSHPB_all_mark']);

            
            return $data;
        }
    }

    function fetch_part_a_e_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $preDsa = ''; $nextDsa = '';
            $pre_omis=''; $next_omis= '';
            $yr1='';$mon1=''; $yr2='';$mon2='';
            if($year1>$year2){
                $yr1 = $year2; $mon1 = $month2;
                $yr2=$year1;$mon2=$month1;
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;

                $pre_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            }else{
                $yr1 = $year1; $mon1 = $month1;
                $yr2=$year2;$mon2=$month2;

                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;

                $pre_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
            }
            $part_a_e =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode,
            b.pre_po_liab, c.next_po_liab,
            case when b.pre_po_liab = 0 or c.next_po_liab = 0 then NULL
                else (((c.next_po_liab - b.pre_po_liab)/b.pre_po_liab)*100) end as 'grth_po_liab', '5' as 'po_liab_all_mark',
            b.pre_instSus_liab, c.next_instSus_liab,
            case when b.pre_instSus_liab = 0 or c.next_instSus_liab = 0 then NULL
                else (((c.next_instSus_liab - b.pre_instSus_liab)/b.pre_instSus_liab)*100) end as 'grth_instSus_liab', '5' as 'instSus_liab_all_mark',
            b.pre_accruedExpforOther_liab, c.next_accruedExpforOther_liab,
            case when b.pre_accruedExpforOther_liab = 0 or c.next_accruedExpforOther_liab = 0 then NULL
                else (((c.next_accruedExpforOther_liab - b.pre_accruedExpforOther_liab)/b.pre_accruedExpforOther_liab)*100) end as 'grth_accruedExpforOther_liab', '5' as 'accruedExpforOther_liab_all_ma',
            b.pre_instPayacaccInstFRD_liab, c.next_instPayacaccInstFRD_liab,
            case when b.pre_instPayacaccInstFRD_liab = 0 or c.next_instPayacaccInstFRD_liab = 0 then NULL
                else (((c.next_instPayacaccInstFRD_liab - b.pre_instPayacaccInstFRD_liab)/b.pre_instPayacaccInstFRD_liab)*100) end as 'grth_instPayacaccInstFRD_liab', '5' as 'instPayacaccInstFRD_liab_all_m',
            b.pre_OIBTCR_liab, c.next_OIBTCR_liab,
            case when b.pre_OIBTCR_liab = 0 or c.next_OIBTCR_liab = 0 then NULL
                else (((c.next_OIBTCR_liab - b.pre_OIBTCR_liab)/b.pre_OIBTCR_liab)*100) end as 'grth_OIBTCR_liab', '10' as 'grth_OIBTCR_liab_all_mark'
            FROM Db_DP_Collection_mgr..allinformation AS a
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('00301') THEN convert(money, amount) ELSE NULL END) AS 'pre_po_liab',
                SUM(CASE WHEN sub_head  IN ('00507') THEN convert(money, amount) ELSE NULL END) AS 'pre_instSus_liab',
                SUM(CASE WHEN sub_head  IN ('00525') THEN convert(money, amount) ELSE NULL END) AS 'pre_accruedExpforOther_liab',
                SUM(CASE WHEN sub_head  IN ('00524') THEN convert(money, amount) ELSE NULL END) AS 'pre_instPayacaccInstFRD_liab',
                SUM(CASE WHEN sub_head  IN ('01201') THEN convert(money, amount) ELSE NULL END) AS 'pre_OIBTCR_liab'
                FROM [Db_DP_Collection_mgr].[dbo].[$preDsa]  
                GROUP BY bcode
            ) b ON b.bcode=a.brcode 
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('00301') THEN convert(money, amount) ELSE NULL END) AS 'next_po_liab',
                SUM(CASE WHEN sub_head  IN ('00507') THEN convert(money, amount) ELSE NULL END) AS 'next_instSus_liab',
                SUM(CASE WHEN sub_head  IN ('00525') THEN convert(money, amount) ELSE NULL END) AS 'next_accruedExpforOther_liab',
                SUM(CASE WHEN sub_head  IN ('00524') THEN convert(money, amount) ELSE NULL END) AS 'next_instPayacaccInstFRD_liab',
                SUM(CASE WHEN sub_head  IN ('01201') THEN convert(money, amount) ELSE NULL END) AS 'next_OIBTCR_liab'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] 
                GROUP BY bcode
            ) c ON c.bcode=a.brcode 
            AND a.brcode in ('$office_id')
            order by a.dvname, a.branchname");
            
            $data = array();
            $result_parta = $part_a_e->result_array();
            
            $data['observation_po'] = "Pay order Liability(PO)";
            $data['pre_po_liab'] = $result_parta[0]['pre_po_liab'];
            $data['next_po_liab'] = $result_parta[0]['next_po_liab'];
            $data['grth_po_liab'] = $result_parta[0]['grth_po_liab'];
            $data['po_liab_all_mark'] = $result_parta[0]['po_liab_all_mark'];
            $data['po_liab_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_po_liab'], $result_parta[0]['po_liab_all_mark']);

            $data['observation_instSus'] = "Interest Suspense";
            $data['pre_instSus_liab'] = $result_parta[0]['pre_instSus_liab'];
            $data['next_instSus_liab'] = $result_parta[0]['next_instSus_liab'];
            $data['grth_instSus_liab'] = $result_parta[0]['grth_instSus_liab'];
            $data['instSus_liab_all_mark'] = $result_parta[0]['instSus_liab_all_mark'];
            $data['instSus_liab_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_instSus_liab'], $result_parta[0]['instSus_liab_all_mark']);

            $data['observation_accruedExpfor'] = "Accrued Expense for Others";
            $data['pre_accruedExpforOther_liab'] = $result_parta[0]['pre_accruedExpforOther_liab'];
            $data['next_accruedExpforOther_liab'] = $result_parta[0]['next_accruedExpforOther_liab'];
            $data['grth_accruedExpforOther_liab'] = $result_parta[0]['grth_accruedExpforOther_liab'];
            $data['accruedExpforOther_liab_all_ma'] = $result_parta[0]['accruedExpforOther_liab_all_ma'];
            $data['accruedExpfor_liab_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_accruedExpforOther_liab'], $result_parta[0]['accruedExpforOther_liab_all_ma']);
            
            $data['observation_instPayacaccInstFRD'] = "Interest Payable A/C- Accrued Interest on FDR & Deposit Schemes";
            $data['pre_instPayacaccInstFRD_liab'] = $result_parta[0]['pre_instPayacaccInstFRD_liab'];
            $data['next_instPayacaccInstFRD_liab'] = $result_parta[0]['next_instPayacaccInstFRD_liab'];
            $data['grth_instPayacaccInstFRD_liab'] = $result_parta[0]['grth_instPayacaccInstFRD_liab'];
            $data['instPayacaccInstFRD_liab_all_m'] = $result_parta[0]['instPayacaccInstFRD_liab_all_m'];
            $data['instPayacaccInstFRD_liab_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_instPayacaccInstFRD_liab'], $result_parta[0]['instPayacaccInstFRD_liab_all_m']);
            
            $data['observation_OIBTCR'] = "Online Inter Br. Transaction (OIBT)-Cr";
            $data['pre_OIBTCR_liab'] = $result_parta[0]['pre_OIBTCR_liab'];
            $data['next_OIBTCR_liab'] = $result_parta[0]['next_OIBTCR_liab'];
            $data['grth_OIBTCR_liab'] = $result_parta[0]['grth_OIBTCR_liab'];
            $data['grth_OIBTCR_liab_all_mark'] = $result_parta[0]['grth_OIBTCR_liab_all_mark'];
            $data['OIBTCR_liab_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_OIBTCR_liab'], $result_parta[0]['grth_OIBTCR_liab_all_mark']);
                
            return $data;
        }
    }
    function fetch_part_a_d_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $preDsa = ''; $nextDsa = '';
            $pre_omis=''; $next_omis= '';
            $yr1='';$mon1=''; $yr2='';$mon2='';
            if($year1>$year2){
                $yr1 = $year2; $mon1 = $month2;
                $yr2=$year1;$mon2=$month1;
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;

                $pre_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            }else{
                $yr1 = $year1; $mon1 = $month1;
                $yr2=$year2;$mon2=$month2;

                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;

                $pre_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
            }

        $part_a_d =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode, a.OfficePhone,
        b.pre_writtOff_omis, c.next_writtOff_omis,
        case when b.pre_writtOff_omis = 0 or c.next_writtOff_omis = 0 then NULL
            else (((c.next_writtOff_omis - b.pre_writtOff_omis)/b.pre_writtOff_omis)*100) end as 'growth_writtOff_loan',
        '5' as 'writtOff_all_mark',
        b.pre_resched_omis, c.next_resched_omis,
        case when b.pre_resched_omis = 0 or c.next_resched_omis = 0 then NULL
            else (((c.next_resched_omis - b.pre_resched_omis)/b.pre_resched_omis)*100) end as 'growth_resched_loan',
        '5' as 'resched_all_mark'
        FROM Db_DP_Collection_mgr..allinformation AS a
        JOIN (
        SELECT dd_jo_code, 
            SUM(CASE WHEN dd_pt_id  IN ('2409', '2701') THEN convert(money, dd_amt) ELSE NULL END) AS 'pre_writtOff_omis',
            SUM(CASE WHEN dd_pt_id  IN ('2401') THEN convert(money, dd_amt) ELSE NULL END) AS 'pre_resched_omis'
            FROM [Db_DP_Collection_mgr].[dbo].[$pre_omis]
            WHERE dd_end_dt = (select a.om_dat_date from 
            (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr1 and 
            SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon1) a 
            where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
            from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr1 and 
            SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon1)) 
            AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
        ) b ON b.dd_jo_code=a.brcode
        JOIN
        (
        SELECT dd_jo_code, 
            SUM(CASE WHEN dd_pt_id  IN ('2409', '2701') THEN convert(money, dd_amt) ELSE NULL END) AS 'next_writtOff_omis',
            SUM(CASE WHEN dd_pt_id  IN ('2401') THEN convert(money, dd_amt) ELSE NULL END) AS 'next_resched_omis'
            FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
            WHERE dd_end_dt = (select a.om_dat_date from 
            (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
            SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
            where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
            from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
            SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
            AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
        ) c ON c.dd_jo_code=a.brcode
        AND a.brcode in ('$office_id')
        order by a.dvname, a.branchname");
            
            $data = array();
            $result_parta = $part_a_d->result_array();  

            $data['observation_writtOff'] = "Write off Loan (Outstanding)";
            $data['pre_writtOff_omis'] = $result_parta[0]['pre_writtOff_omis'];
            $data['next_writtOff_omis'] = $result_parta[0]['next_writtOff_omis'];
            $data['growth_writtOff_loan'] = $result_parta[0]['growth_writtOff_loan'];
            $data['writtOff_all_mark'] = $result_parta[0]['writtOff_all_mark'];
            $data['writtOff_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_writtOff_loan'], $result_parta[0]['writtOff_all_mark']);

            $data['observation_resched'] = "Through Rescheduling";
            $data['pre_resched_omis'] = $result_parta[0]['pre_resched_omis'];
            $data['next_resched_omis'] = $result_parta[0]['next_resched_omis'];
            $data['growth_resched_loan'] = $result_parta[0]['growth_resched_loan'];
            $data['resched_all_mark'] = $result_parta[0]['resched_all_mark'];
            $data['resched_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_resched_loan'], $result_parta[0]['resched_all_mark']);

            return $data;
        }
    }
    function fetch_part_a_c_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            $preDsa = ''; $nextDsa = '';
            $pre_omis=''; $next_omis= '';
            $yr1='';$mon1=''; $yr2='';$mon2='';
            if($year1>$year2){
                $yr1 = $year2; $mon1 = $month2;
                $yr2=$year1;$mon2=$month1;
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;

                $pre_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            }else{
                $yr1 = $year1; $mon1 = $month1;
                $yr2=$year2;$mon2=$month2;

                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;

                $pre_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
            }

        $part_a_c =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode,
        b.pre_ss_omis, c.next_ss_omis,
        case when b.pre_ss_omis = 0 or c.next_ss_omis = 0 then NULL
            else (((c.next_ss_omis - b.pre_ss_omis)/b.pre_ss_omis)*100) end as 'growth_ss_loan',
            '5' as 'ss_loan_all_mark',
        b.pre_df_omis, c.next_df_omis,
        case when b.pre_df_omis = 0 or c.next_bl_omis = 0 then NULL
            else (((c.next_df_omis - b.pre_df_omis)/b.pre_df_omis)*100) end as 'growth_df_loan',
            '5' as 'df_loan_all_mark',
        b.pre_bl_omis, c.next_bl_omis,
        case when b.pre_bl_omis = 0 or c.next_bl_omis = 0 then NULL
            else (((c.next_bl_omis - b.pre_bl_omis)/b.pre_bl_omis)*100) end as 'growth_bl_loan',
            '10' as 'bl_loan_all_mark'
        FROM Db_DP_Collection_mgr..allinformation AS a
        JOIN (
        SELECT dd_jo_code, 
            SUM(CASE WHEN dd_pt_id  IN ('1809') THEN convert(money, dd_amt) ELSE NULL END) AS 'pre_ss_omis',
            SUM(CASE WHEN dd_pt_id  IN ('1813') THEN convert(money, dd_amt) ELSE NULL END) AS 'pre_df_omis',
            SUM(CASE WHEN dd_pt_id  IN ('1817') THEN convert(money, dd_amt) ELSE NULL END) AS 'pre_bl_omis'
            FROM [Db_DP_Collection_mgr].[dbo].[$pre_omis]
            WHERE dd_end_dt = (select a.om_dat_date from 
            (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr1 and 
            SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon1) a 
            where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
            from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr1 and 
            SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon1)) 
            AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
        ) b ON b.dd_jo_code=a.brcode
        JOIN
        (
        SELECT dd_jo_code, 
            SUM(CASE WHEN dd_pt_id  IN ('1809') THEN convert(money, dd_amt) ELSE NULL END) AS 'next_ss_omis',
            SUM(CASE WHEN dd_pt_id  IN ('1813') THEN convert(money, dd_amt) ELSE NULL END) AS 'next_df_omis',
            SUM(CASE WHEN dd_pt_id  IN ('1817') THEN convert(money, dd_amt) ELSE NULL END) AS 'next_bl_omis'
            FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
            WHERE dd_end_dt = (select a.om_dat_date from 
            (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10),om_dat_date, 112), 4)= $yr2 and 
            SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= $mon2) a 
            where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
            from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
            WHERE left(convert(varchar(10), om_dat_date, 112), 4) = $yr2 and 
            SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = $mon2)) 
            AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
        ) c ON c.dd_jo_code=a.brcode
        AND a.brcode in ('$office_id')
        order by a.dvname, a.branchname");
            
            $data = array();
            $result_parta = $part_a_c->result_array();          

            $data['observation_ss'] = "Sub Standard (SS)";
            $data['pre_ss_omis'] = $result_parta[0]['pre_ss_omis'];
            $data['next_ss_omis'] = $result_parta[0]['next_ss_omis'];
            $data['growth_ss_loan'] = $result_parta[0]['growth_ss_loan'];
            $data['ss_loan_all_mark'] = $result_parta[0]['ss_loan_all_mark'];
            $data['ss_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_ss_loan'], $result_parta[0]['ss_loan_all_mark']);

            $data['observation_df'] = "Doubtful(DF)";
            $data['pre_df_omis'] = $result_parta[0]['pre_df_omis'];
            $data['next_df_omis'] = $result_parta[0]['next_df_omis'];
            $data['growth_df_loan'] = $result_parta[0]['growth_df_loan'];
            $data['df_loan_all_mark'] = $result_parta[0]['df_loan_all_mark'];
            $data['df_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_df_loan'], $result_parta[0]['df_loan_all_mark']);

            $data['observation_bl'] = "Bad/Loss(BL)";
            $data['pre_bl_omis'] = $result_parta[0]['pre_bl_omis'];
            $data['next_bl_omis'] = $result_parta[0]['next_bl_omis'];
            $data['growth_bl_loan'] = $result_parta[0]['growth_bl_loan'];
            $data['bl_loan_all_mark'] = $result_parta[0]['bl_loan_all_mark'];
            $data['bl_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_bl_loan'], $result_parta[0]['bl_loan_all_mark']);
            
            return $data;
        }
    }

    function fetch_part_a_a_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            
            $tempy;
            $preDsa = '';
            $nextDsa = '';
            $pre_omis='';
            $next_omis= '';
            $yr1='';$mon1='';
            $yr2='';$mon2='';
            
            if($year1>$year2){
                $yr1 = $year2; $mon1 = $month2;
                $yr2=$year1;$mon2=$month1;
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;

                $pre_omis = 'omis_data_'.$year2.'_'.$month2;
                $next_omis = 'omis_data_'.$year1.'_'.$month1;
            }else{
                $yr1 = $year1; $mon1 = $month1;
                $yr2=$year2;$mon2=$month2;

                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;

                $pre_omis = 'omis_data_'.$year1.'_'.$month1;
                $next_omis = 'omis_data_'.$year2.'_'.$month2;
            }
 
        $part_a_b =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode, 
            b.pre_current_deposit, c.next_current_deposit,
            case when b.pre_current_deposit = 0 or c.next_current_deposit = 0 then NULL
                else (((c.next_current_deposit - b.pre_current_deposit)/b.pre_current_deposit)*100) end as 'growth_current_dep',
                '5' as 'current_dep_all_mark',
            b.pre_saving_deposit, c.next_saving_deposit,
            case when b.pre_saving_deposit = 0 or c.next_saving_deposit = 0 then NULL
                else (((c.next_saving_deposit - b.pre_saving_deposit)/b.pre_saving_deposit)*100) end as 'growth_saving_dep',
                '5' as 'saving_dep_all_mark',
            b.pre_sundry_deposit, c.next_sundry_deposit,
            case when b.pre_sundry_deposit = 0 or c.next_sundry_deposit = 0 then NULL
                else (((c.next_sundry_deposit - b.pre_sundry_deposit)/b.pre_sundry_deposit)*100) end as 'growth_sundry_dep',
                '5' as 'sundry_dep_all_mark',
            b.pre_fixed_deposit, c.next_fixed_deposit,
            case when b.pre_fixed_deposit = 0 or c.next_fixed_deposit = 0 then NULL
                else (((c.next_fixed_deposit - b.pre_fixed_deposit)/b.pre_fixed_deposit)*100) end as 'growth_fixed_dep',
                '5' as 'fixed_dep_all_mark',
            b.pre_scheme_deposit, c.next_scheme_deposit,
            case when b.pre_scheme_deposit = 0 or c.next_scheme_deposit = 0 then NULL
                else (((c.next_scheme_deposit - b.pre_scheme_deposit)/b.pre_scheme_deposit)*100) end as 'growth_scheme_dep',
                '5' as 'scheme_dep_all_mark',
            d.pre_no_ac_OMIS, e.next_no_ac_OMIS,
            case when d.pre_no_ac_OMIS = 0 or e.next_no_ac_OMIS = 0 then NULL
                else (((e.next_no_ac_OMIS - d.pre_no_ac_OMIS)/d.pre_no_ac_OMIS)*100) end as 'growth_no_ac_dep',
                '5' as 'no_ac_dep_all_mark'
            FROM Db_DP_Collection_mgr..allinformation AS a
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('00201', '00203') THEN convert(money, amount) ELSE NULL END) AS 'pre_current_deposit',
                SUM(CASE WHEN sub_head  IN ('00211') THEN convert(money, amount) ELSE NULL END) AS 'pre_saving_deposit',
                SUM(CASE WHEN sub_head  IN ('00204') THEN convert(money, amount) ELSE NULL END) AS 'pre_sundry_deposit',
                SUM(CASE WHEN sub_head  IN ('00213') THEN convert(money, amount) ELSE NULL END) AS 'pre_fixed_deposit',
                SUM(CASE WHEN sub_head  IN ('00243', '00242', '00241', '00240', '00239', '00238', '00237', '00236', '00235', '00234',
                '00233', '00229', '00228', '00227', '00219', '00218', '00210') THEN convert(money, amount) ELSE 0 END) AS 'pre_scheme_deposit'
                FROM [Db_DP_Collection_mgr].[dbo].[$preDsa] 
                GROUP BY bcode
            ) b ON b.bcode=a.brcode 
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('00201', '00203') THEN convert(money, amount) ELSE NULL END) AS 'next_current_deposit',
                SUM(CASE WHEN sub_head  IN ('00211') THEN convert(money, amount) ELSE NULL END) AS 'next_saving_deposit',
                SUM(CASE WHEN sub_head  IN ('00204') THEN convert(money, amount) ELSE NULL END) AS 'next_sundry_deposit',
                SUM(CASE WHEN sub_head  IN ('00213') THEN convert(money, amount) ELSE NULL END) AS 'next_fixed_deposit',
                SUM(CASE WHEN sub_head  IN ('00243', '00242', '00241', '00240', '00239', '00238', '00237', '00236', '00235', '00234',
                '00233', '00229', '00228', '00227', '00219', '00218', '00210') THEN convert(money, amount) ELSE 0 END) AS 'next_scheme_deposit'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] 
                GROUP BY bcode
            ) c ON c.bcode=a.brcode 
            JOIN
            (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN (101,105,109,113,117,121,125,301) THEN convert(money, dd_ac) ELSE NULL END) AS 'pre_no_ac_OMIS'
                FROM [Db_DP_Collection_mgr].[dbo].[$pre_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= 2018 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= 12) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = 2018 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = 12)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) d ON d.dd_jo_code=a.brcode
            JOIN
            (
            SELECT dd_jo_code, 
                SUM(CASE WHEN dd_pt_id  IN (101,105,109,113,117,121,125,301) THEN convert(money, dd_ac) ELSE 0 END) AS 'next_no_ac_OMIS'
                FROM [Db_DP_Collection_mgr].[dbo].[$next_omis]
                WHERE dd_end_dt = (select a.om_dat_date from 
                (select * from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10),om_dat_date, 112), 4)= 2019 and 
                SUBSTRING (convert(varchar(10),om_dat_date, 112),5, 2)= 06) a 
                where a.om_dat_date=(select max(convert(varchar(10), om_dat_date, 112)) 
                from [Db_DP_Collection_mgr].[dbo].[om_entry_date] 
                WHERE left(convert(varchar(10), om_dat_date, 112), 4) = 2019 and 
                SUBSTRING (convert(varchar(10), om_dat_date, 112), 5, 2) = 06)) 
                AND dd_jo_code NOT IN (0931,0932,0933,0934) GROUP BY dd_jo_code
            ) e ON e.dd_jo_code=a.brcode
            AND a.brcode in ('$office_id')
            order by a.dvname, a.branchname");
            
            $data = array();
            $result_parta = $part_a_b->result_array();         

            $data['observation_cd'] = "Deposit in Current Accounts";
            $data['pre_current_deposit'] = $result_parta[0]['pre_current_deposit'];
            $data['next_current_deposit'] = $result_parta[0]['next_current_deposit'];
            $data['growth_current_dep'] = $result_parta[0]['growth_current_dep'];
            $data['current_dep_all_mark'] = $result_parta[0]['current_dep_all_mark'];
            $data['current_dep_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_current_dep'], $result_parta[0]['current_dep_all_mark']);

            $data['observation_sb'] = "Desopit in Savings Accounts";
            $data['pre_saving_deposit'] = $result_parta[0]['pre_saving_deposit'];
            $data['next_saving_deposit'] = $result_parta[0]['next_saving_deposit'];
            $data['growth_saving_dep'] = $result_parta[0]['growth_saving_dep'];
            $data['saving_dep_all_mark'] = $result_parta[0]['saving_dep_all_mark'];
            $data['saving_dep_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_saving_dep'], $result_parta[0]['saving_dep_all_mark']);

            $data['observation_sundryD'] = "Sundry Desopit";
            $data['pre_sundry_deposit'] = $result_parta[0]['pre_sundry_deposit'];
            $data['next_sundry_deposit'] = $result_parta[0]['next_sundry_deposit'];
            $data['growth_sundry_dep'] = $result_parta[0]['growth_sundry_dep'];
            $data['sundry_dep_all_mark'] = $result_parta[0]['sundry_dep_all_mark'];
            $data['sundry_dep_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_sundry_dep'], $result_parta[0]['sundry_dep_all_mark']);

            $data['observation_fdr'] = "Fixed Desopit";
            $data['pre_fixed_deposit'] = $result_parta[0]['pre_fixed_deposit'];
            $data['next_fixed_deposit'] = $result_parta[0]['next_fixed_deposit'];
            $data['growth_fixed_dep'] = $result_parta[0]['growth_fixed_dep'];
            $data['fixed_dep_all_mark'] = $result_parta[0]['fixed_dep_all_mark'];
            $data['fixed_dep_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_fixed_dep'], $result_parta[0]['fixed_dep_all_mark']);

            $data['observation_schemeD'] = "Desopit in Schemes";
            $data['pre_scheme_deposit'] = $result_parta[0]['pre_scheme_deposit'];
            $data['next_scheme_deposit'] = $result_parta[0]['next_scheme_deposit'];
            $data['growth_scheme_dep'] = $result_parta[0]['growth_scheme_dep'];
            $data['scheme_dep_all_mark'] = $result_parta[0]['scheme_dep_all_mark'];
            $data['scheme_dep_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_scheme_dep'], $result_parta[0]['scheme_dep_all_mark']);

            $data['observation_noD'] = "No. of Total A/Cs in Deposit Sector";
            $data['pre_no_ac_OMIS'] = $result_parta[0]['pre_no_ac_OMIS'];
            $data['next_no_ac_OMIS'] = $result_parta[0]['next_no_ac_OMIS'];
            $data['growth_no_ac_dep'] = $result_parta[0]['growth_no_ac_dep'];
            $data['no_ac_dep_all_mark'] = $result_parta[0]['no_ac_dep_all_mark'];
            $data['no_ac_dep_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['growth_no_ac_dep'], $result_parta[0]['no_ac_dep_all_mark']);
            
            return $data;
        }
    }

    function fetch_part_a_b_data($office_id=0, $month1='', $year1='', $month2='', $year2=''){
        
        if($month1 != '' && $year1 !='' && $month2 !='' && $year2 !=''){
            
            $tempy;
            $preDsa = '';
            $nextDsa = '';
            if($year1>$year2){
                $preDsa = 'DSA'.$month2.$year2;
                $nextDsa = 'DSA'.$month1.$year1;
            }else{
                $preDsa = 'DSA'.$month1.$year1;
                $nextDsa = 'DSA'.$month2.$year2;
            }

            $part_a_b =  $this->db->query("SELECT a.dvname, a.znname, a.branchname, a.brcode,
            b.pre_ltr_loan, c.next_ltr_loan,
            case when b.pre_ltr_loan = 0 or c.next_ltr_loan=0 then NULL
                else (((c.next_ltr_loan - b.pre_ltr_loan)/b.pre_ltr_loan)*100) end as 'grth_ltr_loan', '10' as 'ltr_loan_all_mark',
            b.pre_ecc_loan, c.next_ecc_loan,
            case when b.pre_ecc_loan = 0 or c.next_ecc_loan = 0 then NULL
                else (((c.next_ecc_loan - b.pre_ecc_loan)/b.pre_ecc_loan)*100) end as 'grth_ecc_loan', '5' as 'ecc_loan_all_mark',
                b.pre_fdbp_loan, c.next_fdbp_loan,
            case when b.pre_fdbp_loan=0 or c.next_fdbp_loan = 0 then NULL
                else (((c.next_fdbp_loan - b.pre_fdbp_loan)/b.pre_fdbp_loan)*100) end as 'grth_fdbp_loan', '5' as 'fdbp_loan_all_mark',
            b.pre_ldbp_loan, c.next_ldbp_loan,
            case when b.pre_ldbp_loan=0 or c.next_ldbp_loan = 0 then NULL
                else (((c.next_ldbp_loan - b.pre_ldbp_loan)/b.pre_ldbp_loan)*100) end as 'grth_ldbp_loan', '5' as 'ldbp_loan_all_mark',
            b.pre_ibp_loan, c.next_ibp_loan,
            case when b.pre_ibp_loan=0 or c.next_ibp_loan = 0 then NULL
                else (((c.next_ibp_loan - b.pre_ibp_loan)/b.pre_ibp_loan)*100) end as 'grth_ibp_loan', '5' as 'ibp_loan_all_mark',
                b.pre_lim_loan, c.next_lim_loan, 
            case when b.pre_ibp_loan=0 or c.next_lim_loan = 0 then NULL
                else (((c.next_lim_loan - b.pre_lim_loan)/b.pre_lim_loan)*100) end as 'grth_lim_loan', '5' as 'lim_loan_all_mark',
                b.pre_pad_loan, c.next_pad_loan, 
            case when b.pre_pad_loan=0 or c.next_pad_loan = 0 then NULL
                else (((c.next_pad_loan - b.pre_pad_loan)/b.pre_pad_loan)*100) end as 'grth_pad_loan', '10' as 'pad_loan_all_mark',
                b.pre_pc_loan, c.next_pc_loan,
            case when b.pre_pc_loan=0 or c.next_pc_loan = 0 then NULL
                else (((c.next_pc_loan - b.pre_pc_loan)/b.pre_pc_loan)*100) end as 'grth_pc_loan', '5' as 'pc_loan_all_mark',
                b.pre_demand_loan, c.next_demand_loan,
            case when b.pre_demand_loan=0 or c.next_demand_loan = 0 then NULL
                else (((c.next_demand_loan - b.pre_demand_loan)/b.pre_demand_loan)*100) end as 'grth_demand_loan', '5' as 'demand_loan_all_mark',
                b.pre_rural_loan, c.next_rural_loan, 
            case when b.pre_rural_loan=0 or c.next_rural_loan = 0 then NULL
                else (((c.next_rural_loan - b.pre_rural_loan)/b.pre_rural_loan)*100) end as 'grth_rural_loan', '15' as 'rural_loan_all_mark',
                b.pre_cc_loan, c.next_cc_loan,
            case when b.pre_cc_loan=0 or c.next_cc_loan = 0 then NULL
                else (((c.next_cc_loan - b.pre_cc_loan)/b.pre_cc_loan)*100) end as 'grth_cc_loan', '20' as 'cc_loan_all_mark',
                b.pre_gen_loan, c.next_gen_loan,
            case when b.pre_gen_loan=0 or c.next_gen_loan = 0 then NULL
                else (((c.next_gen_loan - b.pre_gen_loan)/b.pre_gen_loan)*100) end as 'grth_gen_loan', '10' as 'gen_loan_all_mark',
                b.pre_staff_loan, c.next_staff_loan,
            case when b.pre_staff_loan=0 or c.next_staff_loan = 0 then NULL
                else (((c.next_staff_loan - b.pre_staff_loan)/b.pre_staff_loan)*100) end as 'grth_staff_loan', '10' as 'staff_loan_all_mark',
                b.pre_sod_loan, c.next_sod_loan,
            case when b.pre_sod_loan=0 or c.next_sod_loan = 0 then NULL
                else (((c.next_sod_loan - b.pre_sod_loan)/b.pre_sod_loan)*100) end as 'grth_sod_loan', '5' as 'sod_loan_all_mark',
                b.pre_other_loan, c.next_other_loan,
            case when b.pre_other_loan=0 or c.next_other_loan = 0 then NULL
	            else (((c.next_other_loan - b.pre_other_loan)/b.pre_other_loan)*100) end as 'grth_other_loan', '5' as 'other_loan_all_mark'
             FROM Db_DP_Collection_mgr..allinformation AS a
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('10408') THEN convert(money, amount) ELSE NULL END) AS 'pre_ltr_loan',
                SUM(CASE WHEN sub_head  IN ('10505') THEN convert(money, amount) ELSE NULL END) AS 'pre_ecc_loan',
                SUM(CASE WHEN sub_head  IN ('10608', '10612', '10613') THEN convert(money, amount) ELSE NULL END) AS 'pre_fdbp_loan',
                SUM(CASE WHEN sub_head  IN ('10614') THEN convert(money, amount) ELSE NULL END) AS 'pre_ldbp_loan',
                SUM(CASE WHEN sub_head  IN ('10602') THEN convert(money, amount) ELSE NULL END) AS 'pre_ibp_loan',
                SUM(CASE WHEN sub_head  IN ('10406') THEN convert(money, amount) ELSE NULL END) AS 'pre_lim_loan',
                SUM(CASE WHEN sub_head  IN ('10604', '10605', '10607', '10609', '10611', '10615', '10616') THEN convert(money, amount) ELSE 0 END) AS 'pre_pad_loan',
                SUM(CASE WHEN sub_head  IN ('10433', '10409') THEN convert(money, amount) ELSE NULL END) AS 'pre_pc_loan',
                SUM(CASE WHEN sub_head  IN ('10610', '10617') THEN convert(money, amount) ELSE NULL END) AS 'pre_demand_loan',
                SUM(CASE WHEN sub_head  IN ('10401') THEN convert(money, amount) ELSE NULL END) AS 'pre_rural_loan',
                SUM(CASE WHEN sub_head  IN ('10504') THEN convert(money, amount) ELSE NULL END) AS 'pre_cc_loan',
                SUM(CASE WHEN sub_head  IN ('10403', '10404') THEN convert(money, amount) ELSE NULL END) AS 'pre_gen_loan',
                SUM(CASE WHEN sub_head  IN ('10410', '10425', '10426', '10429') THEN convert(money, amount) ELSE NULL END) AS 'pre_staff_loan',
                SUM(CASE WHEN sub_head  IN ('10503') THEN convert(money, amount) ELSE NULL END) AS 'pre_sod_loan',
                SUM(CASE WHEN sub_head  IN ('10411', '10412', '10413', '10414', '10416', '10417', '10418', '10419', '10420',
                '10421', '10422', '10423', '10424', '10427') THEN convert(money, amount) ELSE NULL END) AS 'pre_other_loan'
                FROM [Db_DP_Collection_mgr].[dbo].[$preDsa]  
                GROUP BY bcode
            ) b ON b.bcode=a.brcode 
            JOIN(
                SELECT bcode,
                SUM(CASE WHEN sub_head  IN ('10408') THEN convert(money, amount) ELSE NULL END) AS 'next_ltr_loan',
                SUM(CASE WHEN sub_head  IN ('10505') THEN convert(money, amount) ELSE NULL END) AS 'next_ecc_loan',
                SUM(CASE WHEN sub_head  IN ('10608', '10612', '10613') THEN convert(money, amount) ELSE NULL END) AS 'next_fdbp_loan',
                SUM(CASE WHEN sub_head  IN ('10614') THEN convert(money, amount) ELSE NULL END) AS 'next_ldbp_loan',
                SUM(CASE WHEN sub_head  IN ('10602') THEN convert(money, amount) ELSE NULL END) AS 'next_ibp_loan',
                SUM(CASE WHEN sub_head  IN ('10406') THEN convert(money, amount) ELSE NULL END) AS 'next_lim_loan',
                SUM(CASE WHEN sub_head  IN ('10604', '10605', '10607', '10609', '10611', '10615', '10616') THEN convert(money, amount) ELSE NULL END) AS 'next_pad_loan',
                SUM(CASE WHEN sub_head  IN ('10433', '10409') THEN convert(money, amount) ELSE NULL END) AS 'next_pc_loan',
                SUM(CASE WHEN sub_head  IN ('10610', '10617') THEN convert(money, amount) ELSE NULL END) AS 'next_demand_loan',
                SUM(CASE WHEN sub_head  IN ('10401') THEN convert(money, amount) ELSE NULL END) AS 'next_rural_loan',
                SUM(CASE WHEN sub_head  IN ('10504') THEN convert(money, amount) ELSE NULL END) AS 'next_cc_loan',
                SUM(CASE WHEN sub_head  IN ('10403', '10404') THEN convert(money, amount) ELSE NULL END) AS 'next_gen_loan',
                SUM(CASE WHEN sub_head  IN ('10410', '10425', '10426', '10429') THEN convert(money, amount) ELSE NULL END) AS 'next_staff_loan',
                SUM(CASE WHEN sub_head  IN ('10503') THEN convert(money, amount) ELSE NULL END) AS 'next_sod_loan',
                SUM(CASE WHEN sub_head  IN ('10411', '10412', '10413', '10414', '10416', '10417', '10418', '10419', '10420',
                '10421', '10422', '10423', '10424', '10427') THEN convert(money, amount) ELSE NULL END) AS 'next_other_loan'
                FROM [Db_DP_Collection_mgr].[dbo].[$nextDsa] 
                GROUP BY bcode
            ) c ON c.bcode=a.brcode 
            AND a.brcode in ('$office_id')
            order by a.dvname, a.branchname");
            
            $data = array();
            $result_parta = $part_a_b->result_array();
            
            $data['part_a_b_sect_one']['observation_ltr'] = "Loan against Trust Receipts (LTR)";
            $data['part_a_b_sect_one']['pre_ltr_loan'] = $result_parta[0]['pre_ltr_loan'];
            $data['part_a_b_sect_one']['next_ltr_loan'] = $result_parta[0]['next_ltr_loan'];
            $data['part_a_b_sect_one']['grth_ltr_loan'] = $result_parta[0]['grth_ltr_loan'];
            $data['part_a_b_sect_one']['ltr_loan_all_mark'] = $result_parta[0]['ltr_loan_all_mark'];
            $data['part_a_b_sect_one']['ltr_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_ltr_loan'], $result_parta[0]['ltr_loan_all_mark']);
                
            $data['part_a_b_sect_one']['observation_ecc'] = "Loan against Export Cash Credit (ECC)";
            $data['part_a_b_sect_one']['pre_ecc_loan'] = $result_parta[0]['pre_ecc_loan'];
            $data['part_a_b_sect_one']['next_ecc_loan'] = $result_parta[0]['next_ecc_loan'];
            $data['part_a_b_sect_one']['grth_ecc_loan'] = $result_parta[0]['grth_ecc_loan'];
            $data['part_a_b_sect_one']['ecc_loan_all_mark'] = $result_parta[0]['ecc_loan_all_mark'];
            $data['part_a_b_sect_one']['ecc_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_ecc_loan'], $result_parta[0]['ecc_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_fdbp'] = "Loan against FDBP";
            $data['part_a_b_sect_one']['pre_fdbp_loan'] = $result_parta[0]['pre_fdbp_loan'];
            $data['part_a_b_sect_one']['next_fdbp_loan'] = $result_parta[0]['next_fdbp_loan'];
            $data['part_a_b_sect_one']['grth_fdbp_loan'] = $result_parta[0]['grth_fdbp_loan'];
            $data['part_a_b_sect_one']['fdbp_loan_all_mark'] = $result_parta[0]['fdbp_loan_all_mark'];
            $data['part_a_b_sect_one']['fdbp_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_fdbp_loan'], $result_parta[0]['fdbp_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_ldbp'] = "Loan against LDBP";
            $data['part_a_b_sect_one']['pre_ldbp_loan'] = $result_parta[0]['pre_ldbp_loan'];
            $data['part_a_b_sect_one']['next_ldbp_loan'] = $result_parta[0]['next_ldbp_loan'];
            $data['part_a_b_sect_one']['grth_ldbp_loan'] = $result_parta[0]['grth_ldbp_loan'];
            $data['part_a_b_sect_one']['ldbp_loan_all_mark'] = $result_parta[0]['ldbp_loan_all_mark'];
            $data['part_a_b_sect_one']['ldbp_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_ldbp_loan'], $result_parta[0]['ldbp_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_ibp'] = "Inland Bills Purchased(IBP)";
            $data['part_a_b_sect_one']['pre_ibp_loan'] = $result_parta[0]['pre_ibp_loan'];
            $data['part_a_b_sect_one']['next_ibp_loan'] = $result_parta[0]['next_ibp_loan'];
            $data['part_a_b_sect_one']['grth_ibp_loan'] = $result_parta[0]['grth_ibp_loan'];
            $data['part_a_b_sect_one']['ibp_loan_all_mark'] = $result_parta[0]['ibp_loan_all_mark'];
            $data['part_a_b_sect_one']['ibp_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_ibp_loan'], $result_parta[0]['ibp_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_lim'] = "LIM (Loan Against Import Merchandise)";
            $data['part_a_b_sect_one']['pre_lim_loan'] = $result_parta[0]['pre_lim_loan'];
            $data['part_a_b_sect_one']['next_lim_loan'] = $result_parta[0]['next_lim_loan'];
            $data['part_a_b_sect_one']['grth_lim_loan'] = $result_parta[0]['grth_lim_loan'];
            $data['part_a_b_sect_one']['lim_loan_all_mark'] = $result_parta[0]['lim_loan_all_mark'];
            $data['part_a_b_sect_one']['lim_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_lim_loan'], $result_parta[0]['lim_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_pad'] = "Loan against PAD";
            $data['part_a_b_sect_one']['pre_pad_loan'] = $result_parta[0]['pre_pad_loan'];
            $data['part_a_b_sect_one']['next_pad_loan'] = $result_parta[0]['next_pad_loan'];
            $data['part_a_b_sect_one']['grth_pad_loan'] = $result_parta[0]['grth_pad_loan'];
            $data['part_a_b_sect_one']['pad_loan_all_mark'] = $result_parta[0]['pad_loan_all_mark'];
            $data['part_a_b_sect_one']['pad_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_pad_loan'], $result_parta[0]['pad_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_pc'] = "Loan against Packing Credit (PC)";
            $data['part_a_b_sect_one']['pre_pc_loan'] = $result_parta[0]['pre_pc_loan'];
            $data['part_a_b_sect_one']['next_pc_loan'] = $result_parta[0]['next_pc_loan'];
            $data['part_a_b_sect_one']['grth_pc_loan'] = $result_parta[0]['grth_pc_loan'];
            $data['part_a_b_sect_one']['pc_loan_all_mark'] = $result_parta[0]['pc_loan_all_mark'];
            $data['part_a_b_sect_one']['pc_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_pc_loan'], $result_parta[0]['pc_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_demand'] = "Loan against Demand Loan";
            $data['part_a_b_sect_one']['pre_demand_loan'] = $result_parta[0]['pre_demand_loan'];
            $data['part_a_b_sect_one']['next_demand_loan'] = $result_parta[0]['next_demand_loan'];
            $data['part_a_b_sect_one']['grth_demand_loan'] = $result_parta[0]['grth_demand_loan'];
            $data['part_a_b_sect_one']['demand_loan_all_mark'] = $result_parta[0]['demand_loan_all_mark'];
            $data['part_a_b_sect_one']['demand_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_demand_loan'], $result_parta[0]['demand_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_rural'] = "Loan against-Rural Credit";
            $data['part_a_b_sect_one']['pre_rural_loan'] = $result_parta[0]['pre_rural_loan'];
            $data['part_a_b_sect_one']['next_rural_loan'] = $result_parta[0]['next_rural_loan'];
            $data['part_a_b_sect_one']['grth_rural_loan'] = $result_parta[0]['grth_rural_loan'];
            $data['part_a_b_sect_one']['rural_loan_all_mark'] = $result_parta[0]['rural_loan_all_mark'];
            $data['part_a_b_sect_one']['rural_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_rural_loan'], $result_parta[0]['rural_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_other_loan'] = "Others";
            $data['part_a_b_sect_one']['pre_other_loan'] = $result_parta[0]['pre_other_loan'];
            $data['part_a_b_sect_one']['next_other_loan'] = $result_parta[0]['next_other_loan'];
            $data['part_a_b_sect_one']['grth_other_loan'] = $result_parta[0]['grth_other_loan'];
            $data['part_a_b_sect_one']['other_loan_all_mark'] = $result_parta[0]['other_loan_all_mark'];
            $data['part_a_b_sect_one']['other_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_other_loan'], $result_parta[0]['other_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_cc'] = "Loan against CC";
            $data['part_a_b_sect_one']['pre_cc_loan'] = $result_parta[0]['pre_cc_loan'];
            $data['part_a_b_sect_one']['next_cc_loan'] = $result_parta[0]['next_cc_loan'];
            $data['part_a_b_sect_one']['grth_cc_loan'] = $result_parta[0]['grth_cc_loan'];
            $data['part_a_b_sect_one']['cc_loan_all_mark'] = $result_parta[0]['cc_loan_all_mark'];
            $data['part_a_b_sect_one']['cc_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_cc_loan'], $result_parta[0]['cc_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_gen'] = "Loan against General";
            $data['part_a_b_sect_one']['pre_gen_loan'] = $result_parta[0]['pre_gen_loan'];
            $data['part_a_b_sect_one']['next_gen_loan'] = $result_parta[0]['next_gen_loan'];
            $data['part_a_b_sect_one']['grth_gen_loan'] = $result_parta[0]['grth_gen_loan'];
            $data['part_a_b_sect_one']['gen_loan_all_mark'] = $result_parta[0]['gen_loan_all_mark'];
            $data['part_a_b_sect_one']['gen_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_gen_loan'], $result_parta[0]['gen_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_staff'] = "Loan against Staff Loan";
            $data['part_a_b_sect_one']['pre_staff_loan'] = $result_parta[0]['pre_staff_loan'];
            $data['part_a_b_sect_one']['next_staff_loan'] = $result_parta[0]['next_staff_loan'];
            $data['part_a_b_sect_one']['grth_staff_loan'] = $result_parta[0]['grth_staff_loan'];
            $data['part_a_b_sect_one']['staff_loan_all_mark'] = $result_parta[0]['staff_loan_all_mark'];
            $data['part_a_b_sect_one']['staff_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_staff_loan'], $result_parta[0]['staff_loan_all_mark']);

            $data['part_a_b_sect_one']['observation_sod'] = "Loan against Secure Overdraft (SOD)";
            $data['part_a_b_sect_one']['pre_sod_loan'] = $result_parta[0]['pre_sod_loan'];
            $data['part_a_b_sect_one']['next_sod_loan'] = $result_parta[0]['next_sod_loan'];
            $data['part_a_b_sect_one']['grth_sod_loan'] = $result_parta[0]['grth_sod_loan'];
            $data['part_a_b_sect_one']['sod_loan_all_mark'] = $result_parta[0]['sod_loan_all_mark'];
            $data['part_a_b_sect_one']['sod_loan_obtained_mark'] = $this->part_a_obtained_mark_from_growth_rate($result_parta[0]['grth_sod_loan'], $result_parta[0]['sod_loan_all_mark']);

            return $data;
        }
    }

    function part_a_obtained_mark_from_growth_rate($gworh_rate, $allocated_mark = 0){
        
        $obtained_mark = 0;
        if(!is_numeric($gworh_rate)){
            return 0;
        }else{
            if($gworh_rate >= 15){
                $obtained_mark = $allocated_mark;    
            }else if($gworh_rate >= 10 && $gworh_rate < 15){
                if($allocated_mark == 5){$obtained_mark = 4;}
                if($allocated_mark == 10){$obtained_mark = 8;}
                if($allocated_mark == 15){$obtained_mark = 12;}
                if($allocated_mark == 20){$obtained_mark = 16;}
            }else if($gworh_rate >= 5 && $gworh_rate < 10){
                if($allocated_mark == 5){$obtained_mark = 3;}
                if($allocated_mark == 10){$obtained_mark = 6;}
                if($allocated_mark == 15){$obtained_mark = 9;}
                if($allocated_mark == 20){$obtained_mark = 12;}
            }else if($gworh_rate >= 0 && $gworh_rate < 5){
                if($allocated_mark == 5){$obtained_mark = 2;}
                if($allocated_mark == 10){$obtained_mark = 4;}
                if($allocated_mark == 15){$obtained_mark = 6;}
                if($allocated_mark == 20){$obtained_mark = 8;}
            }else if($gworh_rate < 0){
                if($gworh_rate < 0){
                    if($allocated_mark == 5){$obtained_mark = 1;}
                    if($allocated_mark == 10){$obtained_mark = 2;}
                    if($allocated_mark == 15){$obtained_mark = 3;}
                    if($allocated_mark == 20){$obtained_mark = 4;}
                }
            }
            return $obtained_mark;
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
    /** RBA Report end*/
    /** 
     * RBA end
    */
}
?>