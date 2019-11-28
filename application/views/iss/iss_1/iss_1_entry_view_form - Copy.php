<p>
   	<?php
    $attribute='';
    if(isset($login_office_status) && $login_office_status ==4)
    {
        $attribute='disabled="disabled"';
    }
    
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-1 Data Entry Form System </th></tr></table>"; 
   	?>
	<ul style="display: inline;">
		<li style="	display: inline; list-style: outside none none; padding-right: 35px;"><?php echo anchor('iss/iss_1_deptt_entry_con/', 'Department data entry system'); ?></li>
		<li style="	display: inline; list-style: outside none none; padding-right: 35px;"><?php echo anchor('iss/iss1_dept_report/', 'Department report'); ?></li>
		<li style="	display: inline; list-style: outside none none; padding-right: 35px;"><?php echo anchor('iss/iss1_form_report_view/', 'ISS Form-1 report'); ?></li>
		<?php if(isset($office_id) && $office_id==9035) { ?>
		<li style="	display: inline; list-style: outside none none; padding-right: 35px;"><?php echo anchor('iss/iss1_bb_form_report_view/', 'ISS Form-1 entry'); ?></li>
		<?php } ?>
	</ul>
	<?php
    if(isset($login_office_status) && $login_office_status ==4)
    {
		echo form_open('');
    }
    else
    {
        echo form_open('iss/iss_1_data_save','id="iss1_data_entry_form"');   
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
	
		$deptt_name_val = '';
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
		
	$dept_data_coa = array();
	$dept_data_amt = array();
	$con = 0;
	
	if(!empty($iss1_deptwise_info) && count($iss1_deptwise_info)>0)
	{
		foreach($iss1_deptwise_info as $singleDeptt){
			$dept_data_coa[$con] = $singleDeptt->sup_coa_id;
			$dept_data_amt[$con] = $singleDeptt->dept_amount;
			$con++;
		}
	}
	else
	{
		foreach($dept_wise_code_coa as $singleDepttcoa){
			$dept_data_coa[$con] = 0;
			$dept_data_amt[$con] = 0;	
			$con++;
		}
	}
	
	
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
	if(!empty($iss1_dept_cer_info) && count($iss1_dept_cer_info)>0){
			foreach($iss1_dept_cer_info as $singleDepCer){
			$dept_off1_name_val = $singleDepCer->dept_off1_name;
			$dept_off1_dsg_val = $singleDepCer->dept_off1_dsg;
			$dept_off2_name_val = $singleDepCer->dept_off2_name;
			$dept_off2_dsg_val = $singleDepCer->dept_off2_dsg;
			$dept_off3_name_val = $singleDepCer->dept_off3_name;
			$dept_off3_dsg_val = $singleDepCer->dept_off3_dsg;
			$dept_off4_name_val = $singleDepCer->dept_off4_name;
			$dept_off4_dsg_val = $singleDepCer->dept_off4_dsg;
		}
	}
	
	echo "<table>"; 
	echo "<tr>";
	echo "<td style='font-weight:700'>";
	echo "Department Name: ".$deptt_name_val;
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td style='font-weight:700'>";
	echo "Department Code: ".$deptt_code_val;
	echo "<input type='hidden' name='iss1_dept_code' id='coa_id' size='30' value='".$deptt_code_val."' >";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td style='font-weight:700'>";
	echo "Reporting Date: ".$entry_date;
	echo "<input type='hidden' name='iss1_report_date' id='coa_id' size='30' value='".$entry_date."' >";
	echo "</td>";
	echo "</tr>";
	echo "</table>"; 
		
	if( isset($dept_wise_code_coa) && count($dept_wise_code_coa)>1)
	{
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
	
	echo "<td style='width: 150px; text-align:center'>";
	echo "Amount in BDT";
	echo "</td>";
	
	echo "</tr>";
	
	echo "<pre>";

	$con = 1; $bon = 0;
	for($i=0; $i<count($dept_wise_code_coa); $i++)
	{
		foreach($iss_1_sector as $singleIssVal)
		{
			if($dept_wise_code_coa[$i] == $singleIssVal->SUPERVISION_COA_ID)
			{
				echo "<tr>";
				echo "<td>";
				echo $con;
				echo "</td>";

				echo "<td style='text-align:center'>";
				echo $singleIssVal->SUPERVISION_COA_ID;
				echo "<input type='hidden' name='coa_1_id[]' id='coa_id' size='30' value='".$singleIssVal->SUPERVISION_COA_ID."' >";
				echo "</td>";
				
				echo "<td style='text-align:left'>";
				echo $singleIssVal->COA_DESCRIPTION;
				echo "</td>";
				echo "<td style='text-align:left'>";
				echo $singleIssVal->Figure_indication;
				echo "</td>";
				
				echo "<td style='text-align: right; font-weight:700'>";
				$tmp_coa = ''; $tmp_amt= 0;
				foreach($iss_2_whole_data as $single_coa){
					if($singleIssVal->SUPERVISION_COA_ID==$single_coa->SUPERVISION_COA_ID) {
						$tmp_coa = $single_coa->SUPERVISION_COA_ID;
						$tmp_amt =$single_coa->AMOUNT_BDT;
					}
				}
				if($tmp_coa==$singleIssVal->SUPERVISION_COA_ID)
				{ echo isset($tmp_amt)?$tmp_amt:''; }
				else { echo "0.00";}
				echo "</td>";
				
				echo "<td>";
					echo "<input type='text' name='amount_iss1_bdt[]' value=".$dept_data_amt[$bon]." id='amt_dt' size='16' style='background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700' >";				
				echo "</td>";
								
				echo "</tr>";
				$con++;
				$bon++;
			}	
		}
	}		
	echo "</table>";
	

		echo "<table style='width: 885px;' border=\"1\" align=\"center\">";
		echo "<tr>";
		echo '<td>'.'Related Officer/Ex. Name:'.'</td>';
		echo '<td>'.'<input type="text" name="iss_rel_off_name1" value="'.$dept_off1_name_val.'" id="iss_rel_off_name1" size="30" style="background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700" >'.'</td>';
		echo '<td>'.'Related Officer/Ex. Designation:'.'</td>';
		echo "<td>";
		$attribute = 'style="background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700"';
		
		$selected_designation='';
		if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
		else
		{
			if(isset($dept_off1_dsg_val) && $dept_off1_dsg_val !=''){ $selected_designation = $dept_off1_dsg_val; }
		} 
		echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,$attribute,'');
		echo '</td>';
		echo '<tr>';
	
		echo '<tr>';
		echo '<td>'.'Related Officer/Ex. Name:'.'</td>';
		echo '<td>'.'<input type="text" name="iss_rel_off_name2" value="'.$dept_off2_name_val.'" id="iss_rel_off_name2" size="30" style="background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700" >'.'</td>';
		echo '<td>'.'Related Officer/Ex. Designation:'.'</td>';
		echo '<td>';
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
		echo '<td>'.'<input type="text" name="iss_rel_off_name3" value="'.$dept_off3_name_val.'" id="iss_rel_off_name3" size="30" style="background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700" >'.'</td>';
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
		
		echo '<td>'.'<input type="text" name="iss_rel_off_name4" value="'.$dept_off4_name_val.'" id="iss_rel_off_name4" size="30" style="background-color: #EEEEEE;color:black;font-size: 15px; height: 30px; font-weight:700" >'.'</td>';
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
		
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "</td>";
	?>
	<input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
	<?php
	echo "<td COLSPAN='2'>";
    ?><input type="button" name="fetch_iss_data" id="fetch_iss_data" value="Submit" style="width:200px;background-color: #FF9900;" <?php echo $attribute; ?> onclick="check_iss1_data_entry_form(this.value)"/><?php
	echo "</td></tr>";
	echo "</table>";
	}
	else {
		echo "<p style='background-color:yellow; color:#333; width: 600px'>This Department is not related to ISS Data submit.</p>";
	}
	echo form_close();
	?>
	<br />