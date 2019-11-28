<?php
    $attribute='';
    if(isset($login_office_status) && $login_office_status ==4)
    {
        $attribute='disabled="disabled"';
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Form-1 Prepare Data for BB</th></tr></table>";
   	?>

	<?php

	if(isset($iss1_bb_decesion_info) && count($iss1_bb_decesion_info)>1){
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
	echo "ISS Form-1 Prepare Data";
	echo "</td>";
    
    if(isset($iss1_bb_submit_details_info) && count($iss1_bb_submit_details_info)>1){
		echo "<td style=' text-align:center'>";
		echo "<span style='font-size:10px; color:green'>ISS Form-1 Submitted to Bangladesh Bank Data </br>(Amount in BDT)</span>";
		echo "</td>";
    }
	
	echo "</tr>";
	$con = 1; $bon = 0;
	foreach($iss1_bb_decesion_info as $singleIssVal)
	{
		echo "<tr>";
		echo "<td>";
		echo isset($con) ? $con:'';
		echo "</td>";

		echo "<td style='text-align:center'>";
		echo isset($singleIssVal->sup_coa_id) ? $singleIssVal->sup_coa_id:'';
		echo "<input type='hidden' name='coa_1_bb_id[]' id='coa_id' size='30' value='".$singleIssVal->sup_coa_id."' >";
		echo "</td>";

		echo "<td style='text-align:left'>";
		echo isset($singleIssVal->cust_coa_desc) ? $singleIssVal->cust_coa_desc:'';
		echo "</td>";
		
		echo "<td style='text-align: right; font-weight:700'>";
		echo isset($singleIssVal->bb_amount) ? $singleIssVal->bb_amount:'';
        echo "</td>";
        
        if(isset($iss1_bb_submit_details_info) && count($iss1_bb_submit_details_info)>1){
			foreach($iss1_bb_submit_details_info as $bbsingleVal){
			if( $bbsingleVal->SUPERVISION_COA_ID == $singleIssVal->SUPERVISION_COA_ID ){
				echo "<td style='text-align: right; font-weight:700; color:green'>";
				echo isset($bbsingleVal->AMOUNT_BDT) ? $bbsingleVal->AMOUNT_BDT:'';
				echo "</td>";
				}
			}
        }
        
		echo "</tr>";
		$con++;
		$bon++;
	}
echo "</table>";


	?>
	<input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
	<?php 
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
