<style type="text/css">
html {
margin-left: 15px;
margin-bottom: 5px;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
    <table  align="center">
    <tr align="center"><th>ISS Form-2 Comparision Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>

    <?php
		$fig_ind_desc = 'Actual';
		if(isset($fig_indication) && $fig_indication == 1) { $fig_ind_desc = 'Actual';}
		if(isset($fig_indication) && $fig_indication == 2) { $fig_ind_desc = 'Lac';}
		if(isset($fig_indication) && $fig_indication == 3) { $fig_ind_desc = 'Crore';}
	?>

	<?php
		$pre_date='';
		$next_date='';
		if(isset($login_office_status) && $login_office_status==1)
		{
			foreach($iss_2_whole_br_raw as $row_whole_br){$pre_date=$row_whole_br->first_br;$next_date=$row_whole_br->second_br;} ?>
			<tr align="center"><th>Reporting: <?php echo isset($pre_date)?$pre_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>
	<?php } ?>

	<tr align="center"><th>Report of: <?php echo isset($report_of_date2)?$report_of_date2:''; ?></th></tr>
	<?php
		if(isset($login_office_status) && $login_office_status==1)
		{?>
			<tr align="center"><th>Reporting: <?php echo isset($next_date)?$next_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>
	<?php } ?>

	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>
	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>

	<?php
	if(isset($iss_2_comp_data) && !empty($iss_2_comp_data))
	{
		$next_date_noexcee_val=0;
	$pre_date_noexcee_val=0;
	if(isset($iss_2_comp_no_days_exced_cash_data) && count($iss_2_comp_no_days_exced_cash_data)>0)
	{
		foreach($iss_2_comp_no_days_exced_cash_data as $row_noexcess){
		$next_date_noexcee_val=$row_noexcess->next_date_noexcee;$pre_date_noexcee_val=$row_noexcess->pre_date_noexcee;
		}
	}
	?>
    <?php

    //echo "<table border=\"1\" align=\"center\">";
	?>
	<table border="1" style="border-collapse:collapse;" id="t1">
	<?php
 ?>

	<?php
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' style='font-size:9px'>"."<strong>"."SUPERVISION COA ID"."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
	echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount in $fig_ind_desc "."</br>"." ($report_of_date1)"."<strong>"."</td>";
	echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount in $fig_ind_desc "."</br>"." ($report_of_date2)"."<strong>"."</td>";
	echo "<td align='center' style='font-size:9px'>"."<strong>"."Diff "."</br>"." (Amount in $fig_ind_desc ($report_of_date2) -Amount in $fig_ind_desc ($report_of_date1))"."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Diff(%)"."<strong>"."</td>";
	echo "</tr>";

	if(isset($login_office_status) && $login_office_status != 1)
	{
		$co=0;
		foreach($iss_2_comp_data as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$row1->sl."</td>";
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";

			if($row1->COA_ID_VALUE==2)
			{
				if($row1->SUPERVISION_COA_ID=='1010310')
				{
					echo "<td align='right'>".number_format($row1->next_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 0, '.', '')."</td>";
					echo "<td align='right'>"."0"."</td>";
					echo "<td align='right'>"."0"."</td>";
				}
				else if($login_office_status !=4 && $row1->SUPERVISION_COA_ID=='1011665')
				{
					echo "<td align='right'>".number_format($next_date_noexcee_val, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($pre_date_noexcee_val, 0, '.', '')."</td>";
					echo "<td align='right'>"."0"."</td>";
					echo "<td align='right'>"."0"."</td>";
				}
				else
				{
					echo "<td align='right'>".number_format($row1->next_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->Diff, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->diff_per, 2)."</td>";

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
					echo "<td align='right'>".number_format($row1->next_date, 2)."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 2)."</td>";
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
		foreach($iss_2_comp_data as $row1)
		{
			echo "<tr>";
				echo "<td align='center'>".$row1->sl."</td>";
				echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
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
						echo "<td align='right'>".number_format($row1->diff_per, 2)."</td>";
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
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT1,2)."</td>";
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT2,2)."</td>";
						echo "<td align='right'>".number_format($row1->Diff, 2)."</td>";
						echo "<td align='right'>".number_format($row1->diff_per, 2)."</td>";
					}

				}

			echo "</tr>";
		}
	}
?>
</table>
<?php
}
?>