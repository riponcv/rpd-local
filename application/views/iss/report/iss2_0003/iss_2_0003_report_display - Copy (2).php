<table  align="right">
<tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table><br/><br/>

<style>

#scrolly{
    width: 120%;
	height: 550px;
    overflow: auto;
}

table.scroll {
    /* width: 100%; */ /* Optional */
    /* border-collapse: collapse; */
    border-spacing: 0;
    border: 2px solid black;
}

table.scroll tbody,
table.scroll thead { display: block; }

thead tr th { 
    height: 30px;
    line-height: 30px;
    /* text-align: left; */
}

table.scroll tbody {
    height: 100px;
    overflow-y: auto;
    overflow-x: hidden;
}

tbody { border-top: 2px solid black; }

tbody td, thead th {
    /* width: 20%; */ /* Optional */
    border-right: 1px solid black;
    /* white-space: nowrap; */
}

tbody td:last-child, thead th:last-child {
    border-right: none;
}
</style>	

<script>
// Change the selector if needed
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize(); // Trigger resize handler
</script>

<?php
  
   if(isset($iss_2_0003_data) && count($iss_2_0003_data)>0)  { ?>

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
	echo "<div id='scrolly'>";
    echo "<table  class='scroll' border=\"1\" align=\"center\">"; ?>
	<thead>
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
	echo "</thead>";
	echo "<tbody>";
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
		echo "</tbody>";
	echo form_open('iss/iss_2_003_report_details/1', 'id="iss_2_003_form"');

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
		echo "</div>";	
   	    echo "<tr>";
        $attribute='style="background-color: #FF9900;"';
    	echo "<td align='center' COLSPAN='20'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";

		echo "</table>"; 
		
		?>
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
