	<table  align="center">
    <tr align="center"><th>ISS Form-1 (T_PS_M_FI_MONITOR_HO) Report</th></tr>
    <tr align="center"><th><?php echo "Head Office-120391"; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($entry_date)?$entry_date:''; ?></th></tr>
	</table>
	<?php
		$fig_ind_desc = 'Actual';
		if(isset($fig_indication) && $fig_indication == 1) { $fig_ind_desc = 'Actual';}
		if(isset($fig_indication) && $fig_indication == 2) { $fig_ind_desc = 'Lac';}
		if(isset($fig_indication) && $fig_indication == 3) { $fig_ind_desc = 'Crore';}
	?>

	<?php
   	if(isset($iss1_form_details_info) && !empty($iss1_form_details_info))
	{
    echo "<table style='width: 885px;'  border=\"1\" align=\"center\">";
	echo "<tr>";

	echo "<td>";
	echo "SL.";
	echo "</td>";

	echo "<td style='text-align:center; font-weight: 700'>";
	echo "SUPERVISION COA ID";
	echo "</td>";

	echo "<td style='text-align:center;  font-weight: 700'>";
	echo "COA DESCRIPTION";
	echo "</td>";

	echo "<td style='text-align:center;  font-weight: 700'>";
	echo "Figure Indication";
	echo "</td>";

	echo "<td style='text-align:center;  font-weight: 700'>";
	echo "<span style='font-size:10px'>ISS Form-2 </br> Branch Data </br>(Amount in $fig_ind_desc)</br></span>";
	echo "<span style='font-size:10px'>(".$entry_date.")</span>";
	echo "</td>";

	echo "<td style='width: 150px; text-align:center; font-weight: 700'>";
	echo "<span style='font-size:10px'>ISS Form-1 </br> submitted Data </br>(Amount in $fig_ind_desc)</br></span>";
	echo "<span style='font-size:10px'>(".$prev_date.")</span>";
	echo "</td>";
	echo "<td style='width: 150px; text-align:center; font-weight: 700'>";
	echo "<span style='font-size:10px'>ISS Form-1 </br> submitted Data </br>(Amount in $fig_ind_desc)</br></span>";
	echo "<span style='font-size:10px'>(".$entry_date.")</span>";
	echo "</td>";

	echo "<td style=' text-align:center; font-weight: 700'>";
	echo "<span style='font-size:10px'>ISS Form-1 Diff </br>(Amount in $fig_ind_desc)</span>";
	echo "</td>";
	echo "<td style=' text-align:center; font-weight: 700'>";
	echo "<span style='font-size:10px'>ISS Form-1 Diff in percentage (%) </span>";
	echo "</td>";

	echo "</tr>";

	echo "<tr>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "1";
	echo "</td>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "2";
	echo "</td>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "3";
	echo "</td>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "4";
	echo "</td>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "5";
	echo "</td>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "6";
	echo "</td>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "7";
	echo "</td>";

	echo "<td style='text-align:center; font-size:11px'>";
	echo "8 = (7-6)";
	echo "</td>";

	echo "<td style='text-align:left; font-size:11px'>";
	echo "9= ((8/6) * 100)";
	echo "</td>";

	echo "</tr>";

	$con = 1; $bon = 0;
	foreach($iss1_form_details_info as $singleIssVal)
	{
		$checked_1 = ''; $checked_2 = ''; $checked_3 = '';
 if(isset($fig_indication) && $fig_indication == 1 || $fig_indication == ''){ $checked_1 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 2){ $checked_2 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 3){ $checked_3 = "checked='checked'"; }
	?>
		<tr>
		<td colspan="6" style="border: 0;">Amount in BDT of
		<input type="radio" name="amt_fig" id="act_val" onclick="check_fig_indication_iss1_rep(this.value)" <?php  echo isset($checked_1) ? $checked_1: ' ';?> value="1"> Actual
  		<input type="radio" name="amt_fig" id="lac_val" onclick="check_fig_indication_iss1_rep(this.value)" <?php echo isset($checked_2) ? $checked_2: ' '; ?> value="2"> Lac
  		<input type="radio" name="amt_fig" id="crr_val" onclick="check_fig_indication_iss1_rep(this.value)" <?php echo isset($checked_3) ? $checked_3: ' '; ?> value="3"> Crore</td>
	</tr>


	<?php
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

		echo "<td style='text-align: right;'>";
		if($singleIssVal->status == 2)
		{
			echo "N/A";
		}
		else
		{
			if($singleIssVal->COA_ID_VALUE == 2)
			{
				echo number_format($singleIssVal->Br_data, 0, '.','');
			}
			else
			{
				if(isset($fig_indication) && $fig_indication == 3)
				{
					$temp_amt1 = $singleIssVal->Br_data/10000000;
					echo number_format($temp_amt1, 2);

				}
				elseif (isset($fig_indication) && $fig_indication == 2)
				{
					$temp_amt1 = $singleIssVal->Br_data/100000;
					echo number_format($temp_amt1, 2);
				}
				else
				{
					echo number_format($singleIssVal->Br_data, 2);
				}
				//echo number_format($singleIssVal->Br_data, 2);
			}
		}

		echo "</td>";

		echo "<td style='text-align: right;'>";
			if($singleIssVal->COA_ID_VALUE == 2)
			{
				echo number_format($singleIssVal->bb_pre_amt, 0, '.','');
			}
			else
			{
				if(isset($fig_indication) && $fig_indication == 3)
				{
					$temp_amt1 = $singleIssVal->bb_pre_amt/10000000;
					echo number_format($temp_amt1, 2);

				}
				elseif (isset($fig_indication) && $fig_indication == 2)
				{
					$temp_amt1 = $singleIssVal->bb_pre_amt/100000;
					echo number_format($temp_amt1, 2);
				}
				else
				{
					echo number_format($singleIssVal->bb_pre_amt, 2);
				}
				//echo number_format($singleIssVal->bb_pre_amt, 2);
			}
		echo "</td>";

		echo "<td style='text-align: right; font-weight:700'>";
		if($singleIssVal->COA_ID_VALUE == 2)
		{
			echo number_format($singleIssVal->bb_curr_amt, 0, '.','');
		}
		else
		{
			if(isset($fig_indication) && $fig_indication == 3)
			{
				$temp_amt1 = $singleIssVal->bb_curr_amt/10000000;
				echo number_format($temp_amt1, 2);

			}
			elseif (isset($fig_indication) && $fig_indication == 2)
			{
				$temp_amt1 = $singleIssVal->bb_curr_amt/100000;
				echo number_format($temp_amt1, 2);
			}
			else
			{
				echo number_format($singleIssVal->bb_curr_amt, 2);
			}
			//echo number_format($singleIssVal->bb_curr_amt, 2);
		}
		echo "</td>";
		echo "<td style='text-align: right;'>";
		if($singleIssVal->COA_ID_VALUE == 2)
		{
			if($singleIssVal->SUPERVISION_COA_ID == 1010310 || $singleIssVal->SUPERVISION_COA_ID == 1010325){
				echo "0";
			}
			else
			{
				echo number_format($singleIssVal->Diff, 0, '.','');
			}

		}
		else
		{
			if(isset($fig_indication) && $fig_indication == 3)
			{
				$temp_amt1 = $singleIssVal->Diff/10000000;
				echo number_format($temp_amt1, 2);

			}
			elseif (isset($fig_indication) && $fig_indication == 2)
			{
				$temp_amt1 = $singleIssVal->Diff/100000;
				echo number_format($temp_amt1, 2);
			}
			else
			{
				echo number_format($singleIssVal->Diff, 2);
			}
			//echo number_format($singleIssVal->Diff, 2);
		}
		echo "</td>";
		echo "<td style='text-align: right;'>";
		if($singleIssVal->COA_ID_VALUE == 2)
		{
			if($singleIssVal->SUPERVISION_COA_ID == 1010310 || $singleIssVal->SUPERVISION_COA_ID == 1010325)
			{
				echo "0";
			}
			else
			{
				echo number_format($singleIssVal->diff_percentage, 0, '.','');
			}
		}
		else
		{
			echo number_format($singleIssVal->diff_percentage, 2);
		}
		echo "</td>";

		echo "</tr>";
		$con++;
		$bon++;
	}
	echo "</table>";
	echo form_open('iss/iss1_form_report_details/1', 'id="iss_item_1_form"');
    if(isset($previous_value) && !empty($previous_value))
    {
        foreach($previous_value as $key=>$val)
        {
            ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
            <?php
        }
    }

   	    echo "<tr>";
        $attribute='style="background-color: #FF9900;" onclick="check_iss_form1_rep_pdf(this.value)"';
    	echo "<td align='center' COLSPAN='7'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";

    	echo "</table>"; ?>


<input type="hidden" name="pdf_btn_inst" id="pdf_btn_inst" value="0" />
<input type="hidden" name="fig_indication_post" id="fig_indication_post" value="<?php echo isset($fig_indication) ? $fig_indication: ' '; ?>"/>


<input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />

    	<?php
    	echo form_close();

	}
	else {
		echo "<span style='background: red; color:white'>Report not found</span>";
	}
	?>
