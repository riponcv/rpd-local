<?php
//   echo "<pre>";
//   print_r($iss_2_0007_data);
//  die();
?>
<table  align="right">
<tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table><br/><br/>

<style>
#scrolly{
    width: 120%;
    height: 550px;
    overflow: auto;
}

table tr {
  text-align: center;
}
.bg_ddd{background-color:#ddd}
.bg_c_ddd{background-color:#ddd; color:red}

#scrolly table#fixedTop tr:nth-child(1), #scrolly table#fixedTop tr:nth-child(2) {
  font-weight: 700;
}
#scrolly table#fixedTop tr:nth-child(3) td:nth-child(34){}
</style>	

<?php
  
   if(isset($iss_2_0007_data) && count($iss_2_0007_data)>0)  { ?>

    <table  align="center">
    <tr align="center"><th>ISS Form-2 and CL 12 Items Report (ISS and CL)</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>

	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
    <?php
	echo "<div id='scrolly'>";
	echo "<div class='container'>";
    echo "<table id='fixedTop' border=\"1\" align=\"center\">"; ?>
	<thead>
	<tr>
		<td colspan='5'><strong>Branch Information</td>
		<td colspan='3'>Standard Loan</td>
		<td colspan='3'>SMA Loan</td>
		<td colspan='3'>Substandard(SS) Loan</td>
		<td colspan='3'>Doubtful Loan(DF) Loan</td>
		<td colspan='3'>Bad Loan (BL)</td>
		<td colspan='3'>Loan Outstanding</td>
		<td colspan='3'>Base for Provision</td>
		<td colspan='3'>Provision Required</td>
		<td colspan='3'>Interest Suspense Against Loan</td>
		<td colspan='3'>Micro-Credit Outstanding</td>
		<td colspan='3'>Staff Loan</td>		
		<td colspan='3'>SME Loan Outstanding</td>		
	</tr>
    <?php
	
	echo "<tr>";
		echo "<td>"."SL. No "."</td>";
		echo "<td>"."Division "."</td>";
		echo "<td>"."Area "."</td>";
		echo "<td>"."Branch Name "."</td>";
		echo "<td>"."Branch Code (BB)"."</td>";
		
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";

		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";

		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";

		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
		echo "<td>"."ISS"."</td>";
		echo "<td>"."CL"."</td>";
		echo "<td class='bg_ddd'>"."Status"."</td>";
	echo "</tr>";	
		$co=1;
		foreach($iss_2_0007_data as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$co."</td>";
			echo "<td align='center'>".$row1->dvname."</td>";
			echo "<td align='center'>".$row1->znname."</td>";
			echo "<td align='center'>".$row1->branchname."</td>";
			echo "<td align='center'>".$row1->BRANCH_ID."</td>";
			echo "<td align='right'>".number_format($row1->Standard_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->Standard_CL, 2)."</td>";
			if($row1->standardLoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->standardLoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->standardLoan_Check."</td>";
			}
			
			echo "<td align='right'>".number_format($row1->SMA_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->SMA_CL, 2)."</td>";
			if($row1->SMALoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->SMALoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->SMALoan_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->SS_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->SS_CL, 2)."</td>";
			
			if($row1->SSLoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->SSLoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->SSLoan_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->DF_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->DF_CL, 2)."</td>";
			
			if($row1->DFLoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->DFLoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->DFLoan_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->BL_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->BL_CL, 2)."</td>";
			
			if($row1->BLLoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->BLLoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->BLLoan_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->totalLoanOutstanding_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->totalLoanOutstanding_CL, 2)."</td>";
			
			if($row1->totalLoanOutstanding_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->totalLoanOutstanding_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->totalLoanOutstanding_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->Base_for_prov_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->Base_for_prov_CL, 2)."</td>";
			
			if($row1->Base_for_pro_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->Base_for_pro_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->Base_for_pro_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->prov_Req_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->prov_Req_CL, 2)."</td>";
			
			if($row1->provReq_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->provReq_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->provReq_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->Int_Susp_Loan_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->Int_Susp_Loan_CL, 2)."</td>";
			
			if($row1->intSuspLoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->intSuspLoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->intSuspLoan_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->microcredit_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->Microcredit_CL, 2)."</td>";
			
			if($row1->microcredit_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->microcredit_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->microcredit_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->staffloan_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->staffLoan_CL, 2)."</td>";
			
			if($row1->staffLoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->staffLoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->staffLoan_Check."</td>";
			}
			echo "<td align='right'>".number_format($row1->SME_ISS, 2)."</td>";
			echo "<td align='right'>".number_format($row1->SME_CL, 2)."</td>";
			
			if($row1->SMELoan_Check=="Mismatch"){
			echo "<td align='center' class='bg_c_ddd'>".$row1->SMELoan_Check."</td>";
			}else{
				echo "<td align='center' class='bg_ddd'>".$row1->SMELoan_Check."</td>";
			}
			echo "</tr>";
			$co++;
		}
	echo "</div>";	
	echo form_open('iss/iss_2_007_report_details/1', 'id="iss_2_007_form"');

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
    	//echo "<td align='center' COLSPAN='20'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
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
