<p>
   	<?php
    $attribute='';
    if(isset($login_office_status) && $login_office_status ==4)
    {
        $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-1 Data Entry Form System</th></tr></table>"; 
   	?>
	<ul style="display: inline;">
		<li style="	display: inline; list-style: outside none none; padding-right: 35px;"><?php echo anchor('iss/iss_1_report/', 'Deptt data entry'); ?></li>
		<li style="	display: inline; list-style: outside none none; padding-right: 35px;"><?php echo anchor('iss/iss1_dept_report/', 'Deptt report'); ?></li>
		<li style="	display: inline; list-style: outside none none; padding-right: 35px;"><?php echo anchor('iss/iss1_form_report_view/', 'ISS Form-1 report'); ?></li>
		
	</ul>
	<?php
    if(isset($login_office_status) && $login_office_status ==4)
    {
		echo form_open('');
    }
    else
    {
        echo form_open('iss/iss1_bb_form_details_save','id="iss1_bb_data_entry_form"');   
    }
    
    echo "<br/>";
   	if($this->session->flashdata('success_wp'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_wp').'</font>'; 
    	echo "</div>";
    }
    
   	if($this->session->flashdata('error_wp'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: red;">'.$this->session->flashdata('error_wp').'</font>'; 
    	echo "</div>";
        echo "<br/>";
    }
	
    if($login_office_status ==4)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to Fetch ISS Data.</td></tr></table>';
        echo "<br/>";   
    }
	
	//echo "<pre>";
	//print_r($iss1_form_details_info);
	//die();
		/*	$deptt_name_val = '';
		$deptt_code_val = '';
		$deptt_coa_code_val = '';
		foreach($iss_1_info_list as $singleDeptVal)
		{
			$deptt_name_val = $singleDeptVal->office_name;
			$deptt_code_val = $singleDeptVal->Office_code;
			$deptt_coa_code_val = $singleDeptVal->ISS_COA_MAPPING;
		}
		
	$pre_opt_sub_list = '';
	$dept_wise_code_coa = explode(',',$deptt_coa_code_val);
		*/
	/*$dept_data_coa = array();
	$dept_data_amt = array();
	$con = 0;
	foreach($iss1_form_details_info as $singleDeptt){
		$dept_data_coa[$con] = $singleDeptt->sup_coa_id;
		$dept_data_amt[$con] = $singleDeptt->amount;
		$con++;
	}*/
	//print_r($dept_data_coa);
	//die();
/*
	$dept_off1_name_val = '';
	$dept_off1_dsg_val = '';
	$dept_off1_cer_enty_date_val = '';
	$dept_off1_cer_enty_uid_val = '';
	$dept_off2_name_val = '';
	$dept_off2_dsg_val = '';
	$dept_off2_cer_enty_date_val = '';
	$dept_off2_cer_enty_uid_val = '';
	$dept_off3_name_val = '';
	$dept_off3_dsg_val = '';
	$dept_off3_cer_enty_date_val = '';
	$dept_off3_cer_enty_uid_val = '';
	$dept_off4_name_val = '';
	$dept_off4_dsg_val = '';
	$dept_off4_cer_enty_date_val = '';
	$dept_off4_cer_enty_uid_val = '';
	foreach($iss1_dept_cer_info as $singleDepCer){
		$dept_off1_name_val = $singleDepCer->dept_off1_name;
		$dept_off1_dsg_val = $singleDepCer->dept_off1_dsg;
		$dept_off1_cer_enty_date_val = $singleDepCer->dept_off1_cer_enty_date;
		
		$dept_off2_name_val = $singleDepCer->dept_off2_name;
		$dept_off2_dsg_val = $singleDepCer->dept_off2_dsg;
		$dept_off2_cer_enty_date_val = $singleDepCer->dept_off2_cer_enty_date;
		
		$dept_off3_name_val = $singleDepCer->dept_off3_name;
		$dept_off3_dsg_val = $singleDepCer->dept_off3_dsg;
		$dept_off3_cer_enty_date_val = $singleDepCer->dept_off3_cer_enty_date;
		
		$dept_off4_name_val = $singleDepCer->dept_off4_name;
		$dept_off4_dsg_val = $singleDepCer->dept_off4_dsg;
		$dept_off4_cer_enty_date_val = $singleDepCer->dept_off4_cer_enty_date;
		
	}
	*/
	
	echo "<table>"; 
	echo "<tr>";
	echo "<td style='font-weight:700'>";
	//echo "Department Name: ".$deptt_name_val;
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td style='font-weight:700'>";
	//echo "Department Code: ".$deptt_code_val;
	//echo "<input type='hidden' name='iss1_dept_code' id='coa_id' size='30' value='".$deptt_code_val."' >";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td style='font-weight:700'>";
	echo "Report as on: ".$entry_date;
	echo "<input type='hidden' name='iss1_report_date' id='coa_id' size='30' value='".$entry_date."' >";
	echo "</td>";
	echo "</tr>";
	
	echo "</table>"; 
		
	echo "<table style='width: 885px;'  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	
	echo "<td>";
	echo "SL.";
	echo "</td>";

	echo "<td style='width: 105px; text-align:center'>";
	echo "SUPERVISION _COA_ID";
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo "COA_DESCRIPTION";
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo "Figure Indication";
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo "<span style='font-size:10px'>ISS Form-2 Branch Data </br>(Amount in BDT)</span>";
	echo "</td>";
	
	echo "<td style=' text-align:center'>";
	echo "<span style='font-size:10px'>ISS Form-1 Department Data </br>(Amount in BDT)</span>";
	echo "</td>";
	
	echo "<td style=' text-align:center'>";
	echo "<span style='font-size:10px'>ISS Form-1 Bangladesh Bank Data </br>(Amount in BDT)</span>";
	echo "</td>";
	
	echo "</tr>";
	
	$con = 1; $bon = 0; 
	foreach($iss1_form_details_info as $singleIssVal)
	{
	
		echo "<tr>";
		echo "<td>";
		echo $con;
		echo "</td>";

		echo "<td style='text-align:center'>";
		echo $singleIssVal->SUPERVISION_COA_ID;
		echo "<input type='hidden' name='coa_1_bb_id[]' id='coa_id' size='30' value='".$singleIssVal->SUPERVISION_COA_ID."' >";
		echo "</td>";
		
		echo "<td style='text-align:left'>";
		echo $singleIssVal->COA_DESCRIPTION;
		echo "</td>";
		echo "<td style='text-align:left'>";
		echo $singleIssVal->Figure_indication;
		echo "</td>";
		
		echo "<td style='text-align: right; font-weight:700'>";
		echo $singleIssVal->Br_data;
		
		echo "</td>";
		
		echo "<td style='text-align: right; font-weight:700'>";
			echo $singleIssVal->deptt_data;
		echo "</td>";
		
		echo "<td style='text-align: right; font-weight:700'>";
			echo "<input type='text' name='amount_iss1_bb_bdt[]' value='".$singleIssVal->bb_amt."' id='amt_dt' size='16' style='background-color: #EEEEEE;color:black;font-size: 15px; height: 50px; font-weight:700' >";				
		echo "</td>";
						
		echo "</tr>";
		$con++;
		$bon++;
	}
	
	echo "</table>";
	
	/*	
	echo "<table style=''>";
		echo "<tr style='text-align:center;' >";
		echo "<td>";
			echo $dept_off1_name_val;
		echo "</td>";
		
		echo "<td>";
			echo $dept_off2_name_val;
		echo "</td>";
		
		echo "<td>";
			echo $dept_off3_name_val;
		echo "</td>";
		
		echo "<td>";
			echo $dept_off4_name_val;
		echo "</td>";
		echo "</tr>";
	
		echo "<tr style='text-align:center'>";
		echo "<td>";
			$attribute = "style='background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700'";		
			$selected_designation='';
			if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
			else
			{
				if(isset($dept_off1_dsg_val) && $dept_off1_dsg_val !=''){ $selected_designation = $dept_off1_dsg_val; }
			} 
			echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
		echo "</td>";
		
		echo "<td>";
			$selected_designation='';
			if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
			else
			{
				if(isset($dept_off2_dsg_val) && $dept_off2_dsg_val !=''){ $selected_designation = $dept_off2_dsg_val; }
			} 
			echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
		echo "</td>";
		
		echo "<td>";
			$selected_designation='';
			if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
			else
			{
				if(isset($dept_off3_dsg_val) && $dept_off3_dsg_val !=''){ $selected_designation = $dept_off3_dsg_val; }
			} 
			echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
		echo "</td>";
		
		echo "<td>";
			$selected_designation='';
			if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
			else
			{
				if(isset($dept_off3_dsg_val) && $dept_off3_dsg_val !=''){ $selected_designation = $dept_off3_dsg_val; }
			} 
			echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
		echo "</td>";
		echo "</td>";
		
		echo "</tr>";
		
		echo "<tr style='text-align:center'>";
		echo "<td>";
		$dayinpass1 = strtotime($dept_off1_cer_enty_date_val);
			echo "Date:".date('d/m/Y', $dayinpass1);
		echo "</td>";
		
		echo "<td>";
		$dayinpass2 = strtotime($dept_off2_cer_enty_date_val);
			echo "Date:".date('d/m/Y', $dayinpass2);
		echo "</td>";
		
		echo "<td>";
		$dayinpass3 = strtotime($dept_off3_cer_enty_date_val);
			echo "Date:".date('d/m/Y', $dayinpass3);
		echo "</td>";
		
		echo "<td>";
		$dayinpass4 = strtotime($dept_off4_cer_enty_date_val);
			echo "Date:".date('d/m/Y', $dayinpass4);
		echo "</td>";
		
		echo "</tr>";
	echo "</table>";
	
	echo "<table style=''  align=\"center\">";
		echo "<tr>"."<td>";
			echo $dept_off2_name_val;
		echo "</td>"."</tr>";
	
		echo "<tr>"."<td>";
			echo $dept_off2_dsg_val;
		echo "</td>"."</tr>";
		echo "<tr>"."<td>";
		$dayinpass2 = strtotime($dept_off2_cer_enty_date_val);
			echo "Date:".date('d/m/Y', $dayinpass2);
		echo "</td>"."</tr>";
	echo "</table>";
	
	echo "<table style=''  align=\"center\">";
		echo "<tr>"."<td>";
			echo $dept_off3_name_val;
		echo "</td>"."</tr>";
	
		echo "<tr>"."<td>";
			echo $dept_off3_dsg_val;
		echo "</td>"."</tr>";
		echo "<tr>"."<td>";
		$dayinpass3 = strtotime($dept_off3_cer_enty_date_val);
			echo "Date:".date('d/m/Y', $dayinpass3);
		echo "</td>"."</tr>";
	echo "</table>";
	
	echo "<table style=''  align=\"center\">";
		echo "<tr>"."<td>";
			echo $dept_off4_name_val;
		echo "</td>"."</tr>";
	
		echo "<tr>"."<td>";
			echo $dept_off4_dsg_val;
		echo "</td>"."</tr>";
		echo "<tr>"."<td>";
		$dayinpass4 = strtotime($dept_off4_cer_enty_date_val);
			echo "Date:".date('d/m/Y', $dayinpass4);
		echo "</td>"."</tr>";
	echo "</table>";
	*/
	/*
	echo "<table style='width: 885px;' border=\"1\" align=\"center\">";
	echo "<tr>";
		echo "<td>"."Related Officer/Ex. Name:"."</td>";
		echo "<td>"."<input type='text' name='iss_rel_off_name1' value=".$dept_off1_name_val." id='iss_rel_off_name1' size='30' style='background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700' >"."</td>";
		echo "<td>"."Related Officer/Ex. Designation:"."</td>";
		echo "<td>";
		$attribute = "style='background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700'";
		
		$selected_designation='';
		if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
		else
		{
			if(isset($dept_off1_dsg_val) && $dept_off1_dsg_val !=''){ $selected_designation = $dept_off1_dsg_val; }
		} 
	  echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,$attribute,'');
	  echo "</td>";
	echo "<tr>";
	
	echo "<tr>";
		echo "<td>"."Related Officer/Ex. Name:"."</td>";
		echo "<td>"."<input type='text' name='iss_rel_off_name2' value=".$dept_off2_name_val." id='iss_rel_off_name2' size='30' style='background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700' >"."</td>";
		echo "<td>"."Related Officer/Ex. Designation:"."</td>";
		echo "<td>";
		$selected_designation='';
		if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
		else
		{
			if(isset($dept_off2_dsg_val) && $dept_off2_dsg_val !=''){ $selected_designation = $dept_off2_dsg_val; }
		} 
	  echo form_dropdown('iss_rel_off_desig2',$designation_dropdown,$selected_designation,$attribute,'');
	  echo "</td>";
	echo "<tr>";
	
	echo "<tr>";
		echo "<td>"."Related Officer/Ex. Name:"."</td>";
		echo "<td>"."<input type='text' name='iss_rel_off_name3' value=".$dept_off3_name_val." id='iss_rel_off_name3' size='30' style='background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700' >"."</td>";
		echo "<td>"."Related Officer/Ex. Designation:"."</td>";
		echo "<td>";
		$selected_designation='';
		if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
		else
		{
			if(isset($dept_off3_dsg_val) && $dept_off3_dsg_val !=''){ $selected_designation = $dept_off3_dsg_val; }
		} 
	  echo form_dropdown('iss_rel_off_desig3',$designation_dropdown,$selected_designation,$attribute,'');
	  echo "</td>";
	echo "<tr>";
	

	echo "<tr>";
		echo "<td>"."Related Officer/Ex. Name:"."</td>";
		
		echo "<td>"."<input type='text' name='iss_rel_off_name4' value=".$dept_off4_name_val." id='iss_rel_off_name4' size='30' style='background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700' >"."</td>";
		echo "<td>"."Related Officer/Ex. Designation:"."</td>";
		echo "<td>";
		$selected_designation='';
		if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
		else
		{
			if(isset($dept_off4_dsg_val) && $dept_off4_dsg_val !=''){ $selected_designation = $dept_off4_dsg_val; }
		} 
	  echo form_dropdown('iss_rel_off_desig4',$designation_dropdown,$selected_designation,$attribute,'');
	  echo "</td>";
	echo "<tr>";
	
	echo "</table>";
	*/
		echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "</td>";
	?>
	<input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
	<?php
	echo "<td COLSPAN='2'>";
    ?><input type="button" name="fetch_iss_data" id="fetch_iss_data" value="Submit" style="width:200px;background-color: #FF9900;" <?php echo $attribute; ?> onclick="check_iss1_bb_data_entry_form(this.value)"/><?php
	echo "</td></tr>";
	echo "</table>";
    ?><?php echo form_close(); ?>
	<br />
 