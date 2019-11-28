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
    <tr align="center"><th>ISS Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>

	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
	
	<?php
	if(isset($iss_2_0002_data) && !empty($iss_2_0002_data))
	{
	?>
	<table border="1" style="border-collapse:collapse;" id="t1">
	<tr>
		<td style="background-color:white; font-weight: 700" class="fixed freeze" rowspan='2' >SL. No.</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze" rowspan='2' >Branch Name</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze_vertical" rowspan='2' ><span style="font-size:12px">Br. Code</span><br> (BB)</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze_vertical" rowspan='2' >Area Name</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze_vertical" rowspan='2' >Division Name</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='4'>Total Deposit</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='3'>No of Deposit A/C</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='4'>Total Loan Outstanding</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='3'>No of Loan A/C</td>
	</tr>
	<tr>
		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Affairs</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>

		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>


		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Affairs</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>

		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>
	</tr>
	<?php

	$co=1;
	foreach($iss_2_0002_data as $row1)
	{
		echo "<tr class='tr_shaded'>";
			echo "<td class='fixed freeze_horizontal' align='center'>".$co."</td>";
			echo "<td class='fixed freeze_horizontal' align='left'>";
				echo branch_name_resize($row1->brcode, $row1->branchname);
			echo "</td>";
			echo "<td align='center'>".$row1->brcode."</td>";
			echo "<td align='left'>";
				echo area_name_resize($row1->brcode, $row1->znname);
			echo "</td>";
			echo "<td align='left'>";
			if($row1->bbbrcode=='0888'){ echo "JBCB";}	else{ echo $row1->dvname; }
			echo "</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Deposit_ISS) ? $row1->Total_Deposit_ISS: 0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Deposit_affair) ? $row1->Total_Deposit_affair : 0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Deposit_OMIS) ? $row1->Total_Deposit_OMIS : 0), 2)."</td>";
			if($row1->Deposit_check=="Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->Deposit_check) ? $row1->Deposit_check : '')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->Deposit_check) ? $row1->Deposit_check : '')."</td>";
			}

			echo "<td align='right'>".number_format(isset($row1->No_of_Deposit_ACC_ISS) ? $row1->No_of_Deposit_ACC_ISS:0)."</td>";
			echo "<td align='right'>".number_format(isset($row1->Number_of_Deposit_OMIS)?$row1->Number_of_Deposit_OMIS:0)."</td>";
			if($row1->No_of_Deposit_ac_check == "Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->No_of_Deposit_ac_check)?$row1->No_of_Deposit_ac_check:'')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->No_of_Deposit_ac_check)?$row1->No_of_Deposit_ac_check:'')."</td>";
			}

			echo "<td align='right'>".number_format((isset($row1->Total_Loan_Outstanding_ISS)?$row1->Total_Loan_Outstanding_ISS:0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Loan_Outstanding_Affairs)?$row1->Total_Loan_Outstanding_Affairs:0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Loan_Outstanding_OMIS)?$row1->Total_Loan_Outstanding_OMIS:0), 2)."</td>";
			if($row1->Loan_Outstanding_check=="Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->Loan_Outstanding_check)? $row1->Loan_Outstanding_check:'')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->Loan_Outstanding_check)? $row1->Loan_Outstanding_check:'')."</td>";
			}

			echo "<td align='right'>".number_format(isset($row1->No_of_Loan_ACC_ISS) ? $row1->No_of_Loan_ACC_ISS : 0)."</td>";
			echo "<td align='right'>".number_format(isset($row1->No_of_Loan_Acc_OMIS)?$row1->No_of_Loan_Acc_OMIS:0)."</td>";
			if($row1->No_of_loan_ac_check == "Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->No_of_loan_ac_check)?$row1->No_of_loan_ac_check:'')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->No_of_loan_ac_check)?$row1->No_of_loan_ac_check:'')."</td>";
			}

			echo "</tr>";
		$co++;
	}
?>
</table>
<?php
}
?>