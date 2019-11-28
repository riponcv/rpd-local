<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<p>

    <table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
    </table><br/><br/>
	<?php
	$fig_ind_desc = 'Actual';
	if(isset($fig_indication) && $fig_indication == 1) { $fig_ind_desc = 'Actual';}
	if(isset($fig_indication) && $fig_indication == 2) { $fig_ind_desc = 'Lac';}
	if(isset($fig_indication) && $fig_indication == 3) { $fig_ind_desc = 'Crore';}
	?>

  <?php
  	//echo $login_office_status;
    //echo $fig_indication;
   	//echo "<pre>";
	//print_r($iss_2_item_data);
	//die();
   if(isset($iss_2_item_data) && count($iss_2_item_data)>0)  { ?>

    <table  align="center">
    <tr align="center"><th>ISS Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
	<?php
		$pre_date='';
		$next_date='';
		if(isset($login_office_status) && $login_office_status==1)
		{
			foreach($iss_2_whole_br_raw as $row_whole_br){$pre_date=$row_whole_br->first_br;$next_date=$row_whole_br->second_br;} ?>
			<tr align="center"><th>Report of: <?php echo isset($pre_date)?$pre_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>
	<?php } ?>

	<tr align="center"><th>Report of: <?php echo isset($report_of_date2)?$report_of_date2:''; ?></th></tr>
	<?php
		if(isset($login_office_status) && $login_office_status==1)
		{?>
			<tr align="center"><th>Report of: <?php echo isset($next_date)?$next_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>
	<?php } ?>

	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>

	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
  <?php
 $checked_1 = ''; $checked_2 = ''; $checked_3 = '';
 if(isset($fig_indication) && $fig_indication == 1 || $fig_indication == ''){ $checked_1 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 2){ $checked_2 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 3){ $checked_3 = "checked='checked'"; }
?>
    <?php

    echo "<table border=\"1\" align=\"center\">"; ?>
		<tr>
			<td colspan="6" style="border: 0;">Amount in BDT of
		    <input type="radio" name="amt_fig" id="act_val" onclick="check_fig_indication_iss2_item(this.value)" <?php  echo isset($checked_1) ? $checked_1: ' ';?> value="1"> Actual
  			<input type="radio" name="amt_fig" id="lac_val" onclick="check_fig_indication_iss2_item(this.value)" <?php echo isset($checked_2) ? $checked_2: ' '; ?> value="2"> Lac
  			<input type="radio" name="amt_fig" id="crr_val" onclick="check_fig_indication_iss2_item(this.value)" <?php echo isset($checked_3) ? $checked_3: ' '; ?> value="3"> Crore</td>
		</tr>
    <?php
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";

	if(isset($login_office_status) && $login_office_status != 1)
	{
		echo "<td align='left'>"."<strong>"."Division "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Area "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Branch Name "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Branch Code(BB) "."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
		echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date1)"."<strong>"."</td>";
		echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date2)"."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Diff</br>(Amount($report_of_date2) - Amount($report_of_date1))"."<strong>"."</td>";
		echo "<td align='center' style='font-size:8px'>"."<strong>"."Diff(%)</br>((Amount($report_of_date2) - Amount($report_of_date1))/Amount($report_of_date1))*100"."<strong>"."</td>";

		echo "</tr>";

		$co=1;
		foreach($iss_2_item_data as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$co."</td>";
			echo "<td align='center'>".$row1->dvname."</td>";
			echo "<td align='center'>".$row1->znname."</td>";
			echo "<td align='center'>".$row1->branchname."</td>";
			echo "<td align='center'>".$row1->BRANCH_ID."</td>";
			echo "<td align='center'>".$row1->COA_DESCRIPTION."</td>";

			if($row1->COA_ID_VALUE==2)
			{
				if($row1->SUPERVISION_COA_ID=='1010310' || $row1->SUPERVISION_COA_ID=='1011665')
				{
					echo "<td align='right'>".number_format($row1->next_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 0, '.', '')."</td>";
					echo "<td align='right'>"."0"."</td>";
					echo "<td align='right'>"."0"."</td>";
				}
				else
				{
					echo "<td align='right'>".number_format($row1->next_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->Diff, 0, '.', '')."</td>";
					echo "<td align='right'>".$row1->diff_per."</td>";

				}

			}
			else
			{
				if(isset($fig_indication) && $fig_indication == 3)
				{
					$temp_amt1 = $row1->next_date/10000000;
					$temp_amt2 = $row1->pre_date/10000000;
					echo "<td align='right'>".number_format($temp_amt1, 2)."</td>";
					echo "<td align='right'>".number_format($temp_amt2, 2)."</td>";
					$temp_amt3 = $row1->Diff / 10000000;
					$temp_amt4 = $row1->diff_per;
					echo "<td align='right'>".number_format($temp_amt3, 2)."</td>";
					echo "<td align='right'>".number_format($temp_amt4, 2)."</td>";
					}
					elseif (isset($fig_indication) && $fig_indication == 2)
					{
						$temp_amt1 = $row1->next_date/100000;
						$temp_amt2 = $row1->pre_date/100000;
						echo "<td align='right'>".number_format($temp_amt1, 2)."</td>";
						echo "<td align='right'>".number_format($temp_amt2, 2)."</td>";
						$temp_amt3 = $row1->Diff / 100000;
						$temp_amt4 = $row1->diff_per;
						echo "<td align='right'>".number_format($temp_amt3, 2)."</td>";
						echo "<td align='right'>".number_format($temp_amt4, 2)."</td>";
					}
					else
					{
						echo "<td align='right'>".number_format($row1->next_date,2)."</td>";
						echo "<td align='right'>".number_format($row1->pre_date,2)."</td>";
						echo "<td align='right'>".number_format($row1->Diff, 2)."</td>";
						echo "<td align='right'>".number_format($row1->diff_per, 2)."</td>";
					}
			}
			echo "</tr>";
			$co++;
		}
	}
	if(isset($login_office_status) && $login_office_status == 1)
	{
		echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date1)"."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date2)"."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Diff</br>(Amount($report_of_date2) - Amount($report_of_date1))"."<strong>"."</td>";
		echo "<td align='center' style='font-size:8px'>"."<strong>"."Diff(%)</br>((Amount($report_of_date2) - Amount($report_of_date1)) / ((Amount($report_of_date1))))*100"."<strong>"."</td>";

		echo "</tr>";
		foreach($iss_2_item_data as $row1)
		{
			echo "<tr>";
				echo "<td align='center'>".$row1->sl."</td>";
				echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";

				if($row1->COA_ID_VALUE == 2)
				{

					if($row1->SUPERVISION_COA_ID == '1010310' || $row1->SUPERVISION_COA_ID=='1011665')
					{
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT1, 0, '.', '')."</td>";
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT2, 0, '.', '')."</td>";
						echo "<td align='right'>"."0"."</td>";
						echo "<td align='right'>"."0"."</td>";
					}
					else
					{
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT1, 0, '.', '')."</td>";
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT2, 0, '.', '')."</td>";
						echo "<td align='right'>".number_format($row1->Diff, 0, '.', '')."</td>";
						echo "<td align='right'>".$row1->diff_per."</td>";
					}

				}
				else
				{

					if(isset($fig_indication) && $fig_indication == 3)
					{
						$temp_amt1 = $row1->AMOUNT_BDT1/10000000;
						$temp_amt2 = $row1->AMOUNT_BDT2/10000000;
					echo "<td align='right'>".number_format($temp_amt1, 2)."</td>";
					echo "<td align='right'>".number_format($temp_amt2, 2)."</td>";
					$temp_amt3 = $row1->Diff / 10000000;
					echo "<td align='right'>".number_format($temp_amt3, 2)."</td>";
					echo "<td align='right'>".number_format($row1->diff_per, 2)."</td>";
					}
					elseif (isset($fig_indication) && $fig_indication == 2)
					{
						$temp_amt1 = $row1->AMOUNT_BDT1/100000;
						$temp_amt2 = $row1->AMOUNT_BDT2/100000;
					echo "<td align='right'>".number_format($temp_amt1, 2)."</td>";
					echo "<td align='right'>".number_format($temp_amt2, 2)."</td>";
					$temp_amt3 = $row1->Diff/100000;
					echo "<td align='right'>".number_format($temp_amt3, 2)."</td>";
					echo "<td align='right'>".number_format($row1->diff_per, 2)."</td>";
					}
					else
					{
					echo "<td align='right'>".number_format($row1->AMOUNT_BDT1, 2)."</td>";
					echo "<td align='right'>".number_format($row1->AMOUNT_BDT2, 2)."</td>";
					echo "<td align='right'>".number_format(($row1->Diff, 2)."</td>";
					echo "<td align='right'>".number_format(($row1->diff_per, 2)."</td>";
					}
				}

			echo "</tr>";
		}
	}

	echo form_open('iss/iss_form_2_itemwise_report_details/1', 'id="iss_item_2_item_wise_form"');

	if(isset($previous_value) && !empty($previous_value))
		{
			foreach($previous_value as $key=>$val)
			{
				if(is_array($val))
				{
					foreach($val as $s_val)
					{
						?>
						<input type="hidden" name="<?php echo $key."[]"; ?>" value="<?php echo $s_val; ?>"/>
						<?php
					}
				}
				else {
				?>
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
				<?php
				}
			}
		}

   	    echo "<tr>";
        $attribute='style="background-color: #FF9900;"';
    	echo "<td align='center' COLSPAN='10'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";

    	echo "</table>"; ?>
<input type="hidden" name="pdf_btn_inst" id="pdf_btn_inst" value="0" />

<input type="hidden" name="fig_indication_post" id="fig_indication_post" value="<?php echo isset($fig_indication) ? $fig_indication: ' '; ?>"/>

    	<?php
    	echo form_close();

    }
    else
    {
        echo "<table border=\"1\" align=\"center\">";
        echo "<tr>";
    	echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
        echo "</tr>";
    	echo "</table>";
    }
?>
</p>
</body>
</html>
