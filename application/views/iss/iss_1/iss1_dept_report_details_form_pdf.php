<?php
    $attribute='';
    if(isset($login_office_status) && $login_office_status ==4)
    {
        $attribute='disabled="disabled"';
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-1 Data Entry Form System</th></tr></table>";
   	?>
<?php
	$deptt_name_val = '';
	$deptt_code_val = '';
	$deptt_coa_code_val = '';
	foreach($iss_1_info_list as $singleDeptVal){
		$deptt_name_val = $singleDeptVal->office_name;
		$deptt_code_val = $singleDeptVal->office_code;
	}

	$pre_opt_sub_list = '';
	$dept_wise_code_coa = explode(',',$deptt_coa_code_val);

	$dept_data_coa = array();
	$dept_data_amt = array();
	$con = 0;

	if(isset($iss1_deptwise_info) && count($iss1_deptwise_info)>0){
		foreach($iss1_deptwise_info as $singleDeptt){
			$dept_data_coa[$con] = $singleDeptt->sup_coa_id;
			$dept_data_amt[$con] = $singleDeptt->dept_amount;
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
	if(isset($iss1_dept_cer_info) && count($iss1_dept_cer_info)>0){
	foreach($iss1_dept_cer_info as $singleDepCer){
		$dept_off1_name_val = $singleDepCer->dept_off1_name;
		$dept_off1_dsg_val = $singleDepCer->dept_off1_dsg;
		$dept_off1_cer_enty_date_val = $singleDepCer->dept_off1_cer_enty_date;
		//$dept_off1_cer_enty_uid_val = $singleDepCer->dept_off1_cer_enty_uid;
		$dept_off2_name_val = $singleDepCer->dept_off2_name;
		$dept_off2_dsg_val = $singleDepCer->dept_off2_dsg;
		$dept_off2_cer_enty_date_val = $singleDepCer->dept_off2_cer_enty_date;
		//$dept_off2_cer_enty_uid_val = $singleDepCer->dept_off2_cer_enty_uid;
		$dept_off3_name_val = $singleDepCer->dept_off3_name;
		$dept_off3_dsg_val = $singleDepCer->dept_off3_dsg;
		$dept_off3_cer_enty_date_val = $singleDepCer->dept_off3_cer_enty_date;
		//$dept_off3_cer_enty_uid_val = $singleDepCer->dept_off3_cer_enty_uid;
		$dept_off4_name_val = $singleDepCer->dept_off4_name;
		$dept_off4_dsg_val = $singleDepCer->dept_off4_dsg;
		$dept_off4_cer_enty_date_val = $singleDepCer->dept_off4_cer_enty_date;
		//$dept_off4_cer_enty_uid_val = $singleDepCer->dept_off4_cer_enty_uid;
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

echo "<table style='width: 885px;'  border=\"1\" align=\"center\">";
	echo "<tr>";
		echo "<td>";
		echo "SL.";
		echo "</td>";

		echo "<td style='width: 105px; text-align:center; font-weight:700'>";
		echo "SUPERVISION _COA_ID";
		echo "</td>";

		echo "<td style='text-align:center; font-weight:700'>";
		echo "COA_DESCRIPTION";
		echo "</td>";

		echo "<td style='text-align:center; font-weight:700'>";
		echo "Figure Indication";
		echo "</td>";
		echo "<td style='text-align:center;font-weight:700'>";
		echo "<span style='font-size:12px'>ISS Form-2 Branch Data </br>(Amount in BDT)</span>";
		echo "</td>";
		echo "<td style='width: 150px; text-align:center; font-weight:700'>";
		echo "<span style='font-size:12px'>ISS Form-1 Department Data </br>(Amount in BDT)</span>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
		echo "1";
		echo "</td>";
		echo "<td style='width: 105px; text-align:center; font-weight:700'>";
		echo "2";
		echo "</td>";
		echo "<td style='text-align:center; font-weight:700'>";
		echo "3";
		echo "</td>";
		echo "<td style='text-align:center; font-weight:700'>";
		echo "4";
		echo "</td>";
		echo "<td style='text-align:center;font-weight:700'>";
		echo "5";
		echo "</td>";

		echo "<td style='width: 150px; text-align:center; font-weight:700'>";
		echo "6";
		echo "</td>";

		echo "<td style='width: 150px; text-align:center; font-weight:700'>";
		echo "(5-6)";
		echo "</td>";
	echo "</tr>";

$con = 1; $bon = 0;
foreach ($iss_1_info_list as $sin_Value) {
	echo "<tr>";
		echo "<td>".$con."</td>";
		//echo $con;
		echo "</td>";
		echo "<td>";
		echo $sin_Value->iss_coa_mapping;
		echo "</td>";
		echo "<td>";
		echo $sin_Value->cust_coa_desc;
		echo "</td>";
		echo "<td>";
		echo $sin_Value->Figure_indication;
		echo "</td>";

		echo "<td style='font-weight:700'>";
			$tmp_coa = ''; $tmp_amt= 0;
			if( isset($iss_2_whole_data) && count($iss_2_whole_data)>1 ){
				foreach($iss_2_whole_data as $single_coa){
					if( $sin_Value->iss_coa_mapping == $single_coa->SUPERVISION_COA_ID ) {
						$tmp_coa = $single_coa->SUPERVISION_COA_ID;
						$tmp_amt =$single_coa->AMOUNT_BDT;
					}
				}
			}
			if($tmp_coa == $sin_Value->iss_coa_mapping){
				echo isset($tmp_amt)?$tmp_amt:'';
			}
			else { echo "0.00";}
		echo "</td >";
		echo "<td style='font-weight:700'>";
				echo isset($dept_data_amt[$bon])?$dept_data_amt[$bon]:' ';
		echo "</td>";
		echo "<td style='font-weight:700'>";
				echo ($tmp_amt - $dept_data_amt[$bon]);
		echo "</td>";
	echo "<tr>";
		$con++;
}
echo "</table>";

	echo "<table style='width: 885px;'>";
		echo "<tr style='text-align:center;' >";
		echo "<td>";
			echo '<div class="inputName">';
				echo isset($dept_off1_name_val)?$dept_off1_name_val:'';
			echo '</div>';
		echo "</td>";

		echo "<td>";
			echo '<div class="inputName">';
			echo isset($dept_off2_name_val)?$dept_off2_name_val:'';
			echo '</div>';
		echo "</td>";

		echo "<td>";
		echo '<div class="inputName">';
			echo isset($dept_off3_name_val)?$dept_off3_name_val:'';
			echo '</div>';
		echo "</td>";

		echo "<td>";
		echo '<div class="inputName">';
			echo isset($dept_off4_name_val)?$dept_off4_name_val:'';
			echo '</div>';
		echo "</td>";
		echo "</tr>";

		echo "<tr style='text-align:center'>";
		if(isset($dept_off1_dsg_val) && $dept_off1_dsg_val !=''){
		echo "<td>";
			$attribute = "style=''";
			$selected_designation='';
			if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
			else
			{
				if(isset($dept_off1_dsg_val) && $dept_off1_dsg_val !=''){ $selected_designation = $dept_off1_dsg_val; }
			}
			echo '<div class="selectParent">';
			echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
			echo '</div>';
		echo "</td>";
		}
		if(isset($dept_off2_dsg_val) && $dept_off2_dsg_val !=''){
		echo "<td>";
			$selected_designation='';
			if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
			else
			{
				if(isset($dept_off2_dsg_val) && $dept_off2_dsg_val !=''){ $selected_designation = $dept_off2_dsg_val; }
			}
			echo '<div class="selectParent">';
			echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
			echo '</div>';

		echo "</td>";
		}
		if(isset($dept_off3_dsg_val) && $dept_off3_dsg_val !=''){
			echo "<td>";
				$selected_designation='';
				if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
				else
				{
					if(isset($dept_off3_dsg_val) && $dept_off3_dsg_val !=''){ $selected_designation = $dept_off3_dsg_val; }
				}
				echo '<div class="selectParent">';
				echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
				echo '</div>';

			echo "</td>";
		}
		if(isset($dept_off4_dsg_val) && $dept_off4_dsg_val !=''){
			echo "<td>";
			$selected_designation='';
			if(isset($_POST['designation'])){ $selected_designation=$_POST['designation'];}
			else
			{
				if(isset($dept_off4_dsg_val) && $dept_off4_dsg_val !=''){ $selected_designation = $dept_off4_dsg_val; }
			}
			echo '<div class="selectParent">';
			echo form_dropdown('iss_rel_off_desig1',$designation_dropdown,$selected_designation,'disabled','');
			echo '</div>';
			echo "</td>";
		}

		echo "</tr>";

		echo "<tr style='text-align:center'>";
		echo "<td>";
		$dayinpass1 = strtotime($dept_off1_cer_enty_date_val);
			if(isset($dayinpass1) && date('d/m/Y', $dayinpass1) !='01/01/1970'){
				echo "Date:".date('d/m/Y', $dayinpass1);
			}

		echo "</td>";

		echo "<td>";
		$dayinpass2 = strtotime($dept_off2_cer_enty_date_val);
		if(isset($dayinpass2) && date('d/m/Y', $dayinpass2) !='01/01/1970'){
				echo "Date:".date('d/m/Y', $dayinpass2);
			}
		echo "</td>";

		echo "<td>";
		$dayinpass3 = strtotime($dept_off3_cer_enty_date_val);
		if(isset($dayinpass3) && date('d/m/Y', $dayinpass3) !='01/01/1970'){
				echo "Date:".date('d/m/Y', $dayinpass3);
			}
		echo "</td>";

		echo "<td>";
		$dayinpass4 = strtotime($dept_off4_cer_enty_date_val);
		if(isset($dayinpass4) && date('d/m/Y', $dayinpass4) !='01/01/1970'){
				echo "Date:".date('d/m/Y', $dayinpass4);
			}
		echo "</td>";

		echo "</tr>";
	echo "</table>";
	?>
	<input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
	<?php

echo "<br>";
echo "<br>";
echo "<br>";
?>
<div style="font-family:my-font">
<?php
echo "মwinvRyj Bmjvg";
?>
</div>
<?php echo form_close(); ?>
	<br />
