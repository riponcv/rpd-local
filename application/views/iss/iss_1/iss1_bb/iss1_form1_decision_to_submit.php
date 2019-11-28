<?php

    $attribute='';
    if(isset($login_office_status) && $login_office_status ==4)
    {
        $attribute='disabled="disabled"';
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-1 Decesion Data to BB Entry</th></tr></table>";
   	?>

	<?php
    if(isset($login_office_status) && $login_office_status ==4)
    {
		echo form_open('');
    }
    else
    {
        echo form_open('iss/iss1_bb_form_details_save','id="iss1_bb_decesion_entry_form"');
    }


	if(isset($iss2_form_details_info) && count($iss2_form_details_info)>1){
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
	printf("Report as on:%s",isset($entry_date) ? $entry_date:'');
	echo "<input type='hidden' name='iss1_report_date' id='coa_id' size='30' value='".$entry_date."' >";
	echo "</td>";
	echo "</tr>";

	echo "</table>";

	echo "<table style='width: 885px;'  border=\"1\" align=\"center\">";
	echo "<tr style='font-weight:700; background-color: #b5bcbb;'>";

	echo "<td>";
	echo "SL.";
	echo "</td>";

	echo "<td style='width: 105px; text-align:center'>";
	echo "SUPERVISION COA ID";
	echo "</td>";

	echo "<td style='text-align:center'>";
	echo "COA DESCRIPTION";
	echo "</td>";

	echo "<td style='text-align:center'>";
	echo "Figure Indication";
	echo "</td>";

	echo "<td style='text-align:center'>";
	echo "<span style='font-size:10px'>ISS Form-2 Branch Data <br>{$entry_date}<br>(Amount in BDT)</span>";
	echo "<br>";
	if(isset($count_all) && $count_all>1){ 
		echo "Branch Completed ";
		$miss_br = (count($result_miss))?count($result_miss):'0';
		$count_all_br = isset($count_all) ? $count_all : '0';
		$comp_br = ( $count_all_br - $miss_br );
		echo isset( $comp_br) ? $comp_br : 0;
		echo '/'; 
		echo isset($count_all)?$count_all:'0';
	}
	echo "</td>";
	if(isset($iss1_dept_details_info) && count($iss1_dept_details_info)>1){
		echo "<td style=' text-align:center'>";
		echo "<span style='font-size:10px'>ISS Form-1 Department Data </br>(Amount in BDT)</span>";
		echo "</td>";
	}

	if(isset($iss1_bb_submit_details_info) && count($iss1_bb_submit_details_info)>1){
		echo "<td style=' text-align:center'>";
		echo "<span style='font-size:10px'>ISS Form-1 Submitted to Bangladesh Bank Data </br>(Amount in BDT)</span>";
		echo "</td>";
	}
	
	echo "<td style=' text-align:center'>";
	echo "<span style='font-size:10px'>ISS Form-1 Submitted to BB Decesion Data </br>(Amount in BDT)</span>";
	echo "</td>";
	
	echo "</tr>";
	$con = 1; $bon = 0;
	foreach($iss2_form_details_info as $singleIssVal)
	{
		echo "<tr>";
		echo "<td>";
		echo isset($con) ? $con:'';
		echo "</td>";

		echo "<td style='text-align:center'>";
		echo isset($singleIssVal->SUPERVISION_COA_ID) ? $singleIssVal->SUPERVISION_COA_ID:'';
		echo "<input type='hidden' name='coa_1_bb_id[]' id='coa_id' size='30' value='".$singleIssVal->SUPERVISION_COA_ID."' >";
		echo "</td>";

		echo "<td style='text-align:left'>";
		echo isset($singleIssVal->cust_coa_desc) ? $singleIssVal->cust_coa_desc:'';
		echo "</td>";
		echo "<td style='text-align:left'>";
		echo isset($singleIssVal->Figure_indication) ? $singleIssVal->Figure_indication:'';
		echo "</td>";

		echo "<td style='text-align: right; font-weight:700'>";
		echo isset($singleIssVal->AMOUNT_BDT) ? $singleIssVal->AMOUNT_BDT:'';
		echo "</td>";
		if(isset($iss1_dept_details_info) && count($iss1_dept_details_info)>1){
			echo "<td style='text-align: right; font-weight:700'>";
			foreach($iss1_dept_details_info as $deptsingleVal){
				if( $deptsingleVal->sup_coa_id == $singleIssVal->SUPERVISION_COA_ID ){
					echo isset($deptsingleVal->amt) ? $deptsingleVal->amt:'';
				}
			}
			echo "</td>";
		}
		if(isset($iss1_bb_submit_details_info) && count($iss1_bb_submit_details_info)>1){
			foreach($iss1_bb_submit_details_info as $bbsingleVal){
			if( $bbsingleVal->SUPERVISION_COA_ID == $singleIssVal->SUPERVISION_COA_ID ){
				echo "<td style='text-align: right; font-weight:700'>";
				echo isset($bbsingleVal->AMOUNT_BDT) ? $bbsingleVal->AMOUNT_BDT:'';
				echo "</td>";
				}
			}
		}
		
		$temp_decision_data = '';
		if(isset($iss1_bb_decesion_info) && count($iss1_bb_decesion_info)>1){
			foreach($iss1_bb_decesion_info as $desision_data){
				if($singleIssVal->SUPERVISION_COA_ID == $desision_data->sup_coa_id)
				{
					$temp_decision_data = $desision_data->bb_amount;
					break;
				} else{
					$temp_decision_data = '';
				}
			}
		}
		echo "<td style='text-align: right; font-weight:700'>";
		echo "<input type='text' name='amount_iss1_bb_bdt[]' value='".$temp_decision_data."' id='amt_dt' size='16' style='background-color: #EEEEEE;color:black;font-size: 18px; height: 50px; font-weight:700' >";
		echo "</td>";

		echo "</tr>";
		$con++;
		$bon++;
	}
echo "</table>";


	?>
	<input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
	<?php
	echo "<table>";
	echo "<tr>";
	echo "<td COLSPAN='2'>";
    ?>

	<input type="button" name="fetch_iss_data" id="fetch_iss_data" value="Submit" style="background-color: #FF9900;" onclick="jQuery('#iss1_bb_decesion_entry_form').submit();"/>
	<?php
	echo "</td></tr>";
	echo "</table>";
    ?><?php echo form_close();

	} else
	{
		echo "<table>";
		echo "<tr style='text-align:center;' >";
		echo "<td>";
			echo "No Report Found";
		echo "</td>";
		echo "<tr>";
		echo "</table>";
	}
    ?>
	<br />
