<style type="text/css">
html { 
margin-left: 15px;
margin-bottom: 5px;
}
table tr {
  text-align: center;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>	
    <table  align="center">
    <tr align="center"><th>ISS Form-2 CIBTA Cross Report(ISS and OMIS)</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>

	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
	
	<?php
	if(isset($iss_2_0003_data) && !empty($iss_2_0003_data))
	{
	?>
    <table border="1" style="border-collapse:collapse;" id="t1">
	<tr>
		<td colspan='5'><strong>Branch Information</strong></td>
		<td><strong>ISS</strong></td>
		<td><strong>OMIS</strong></td>
		<td style='background-color:#ddd'><strong>Status</strong></td>
		<td><strong>ISS</strong></td>
		<td><strong>OMIS</strong></td>
		<td style='background-color:#ddd'><strong>Status</strong></td>

		<td><strong>ISS</strong></td>
		<td><strong>OMIS</strong></td>
		<td style='background-color:#ddd'><strong>Status</strong></td>
		<td><strong>ISS</strong></td>
		<td><strong>OMIS</strong></td>
		<td style='background-color:#ddd'><strong>Status</strong></td>

		<td><strong>ISS</strong></td>
		<td><strong>OMIS</strong></td>
		<td style='background-color:#ddd'><strong>Status</strong></td>
	</tr>
	<?php
		echo "<tr>";
		echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Division "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Area "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Branch Name "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Branch Code (JBL) "."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."Unreconciled Debit Entries No"."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."Unreconciled Debit Entries No"."<strong>"."</td>";
		echo "<td align='left' style='background-color:#ddd'>"."<strong>"."Unreconciled Debit Entries No"."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."Unreconciled Dr Entries Amount"."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."Unreconciled Dr Entries Amount"."<strong>"."</td>";
		echo "<td align='left' style='background-color:#ddd'>"."<strong>"."Unreconciled Dr Entries Amount"."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."Unreconciled Credit Entries No"."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."Unreconciled Credit Entries No"."<strong>"."</td>";	
		echo "<td align='left' style='background-color:#ddd'>"."<strong>"."Unreconciled Credit Entries No"."<strong>"."</td>";	
		echo "<td align='left' >"."<strong>"."Unreconciled Credit Entries Amount"."<strong>"."</td>";	
		echo "<td align='left' >"."<strong>"."Unreconciled Credit Entries Amount"."<strong>"."</td>";	
		echo "<td align='left' style='background-color:#ddd'>"."<strong>"."Unreconciled Credit Entries Amount"."<strong>"."</td>";	
		echo "<td align='left' >"."<strong>"."Last Reconciliation Date"."<strong>"."</td>";	
		echo "<td align='left' >"."<strong>"."Last Reconciliation Date"."<strong>"."</td>";	
		echo "<td align='left' style='background-color:#ddd'>"."<strong>"."Last Reconciliation Date"."<strong>"."</td>";	
		echo "</tr>";

	$co=1;
	foreach($iss_2_0003_data as $row1)
	{
		echo "<tr>";
			echo "<td align='center'>".$co."</td>";
			echo "<td align='center'>".$row1->dvname."</td>";
			echo "<td align='center'>".$row1->znname."</td>";
			echo "<td align='center'>".$row1->branchname."</td>";
			echo "<td align='center'>".$row1->brcode."</td>";
			echo "<td align='center'>".$row1->Unreconciled_Dr_EntriesNo_ISS."</td>";
			echo "<td align='center'>".$row1->DrNo_OMIS."</td>";
			if($row1->Unreconciled_Dr_EntriesNo_chk=="Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".$row1->Unreconciled_Dr_EntriesNo_chk."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd'>".$row1->Unreconciled_Dr_EntriesNo_chk."</td>";
			}
			echo "<td align='center'>".$row1->Unreconciled_Dr_EntriesAmt_ISS."</td>";
			echo "<td align='center'>".$row1->DrAmt_OMIS."</td>";
			if($row1->Unreconciled_Dr_EntriesAmt_chk=="Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".$row1->Unreconciled_Dr_EntriesAmt_chk."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".$row1->Unreconciled_Dr_EntriesAmt_chk."</td>";
			}
			echo "<td align='center'>".$row1->Unreconciled_Cr_EntriesNo_ISS."</td>";
			echo "<td align='center'>".$row1->CrNo_OMIS."</td>";
			if($row1->Unreconciled_Cr_EntriesNo_chk=="Mismatch"){
				echo "<td align='center' style='background-color:#ddd; color:red'>".$row1->Unreconciled_Cr_EntriesNo_chk."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd'>".$row1->Unreconciled_Cr_EntriesNo_chk."</td>";
			}
			echo "<td align='center'>".$row1->Unreconciled_Cr_EntriesAmt_ISS."</td>";
			echo "<td align='center'>".$row1->CrAmt_OMIS."</td>";
			if($row1->Unreconciled_Cr_EntriesAmt_chk=="Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".$row1->Unreconciled_Cr_EntriesAmt_chk."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd'>".$row1->Unreconciled_Cr_EntriesAmt_chk."</td>";
			}
			echo "<td align='center'>".$row1->Last_Reconciliation_Date_ISS."</td>";
			echo "<td align='center'>".$row1->lastReconcileCompletedDate_OMI."</td>";
			if($row1->LAST_reconcompleted_Check=="Mismatch"){
				echo "<td align='center' style='background-color:#ddd; color:red'>".$row1->LAST_reconcompleted_Check."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd'>".$row1->LAST_reconcompleted_Check."</td>";
			}
			echo "</tr>";
			$co++;
		}
?>
</table>
<?php
}
?>