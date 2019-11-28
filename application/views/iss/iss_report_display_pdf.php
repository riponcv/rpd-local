<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document
<style>
table {margin:0;padding:0;}
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
</title>
</head>
<body>
<p>
	<?php
	
	$data_amt = array();
	$amt_count=0;
	$dd_pt_id_ary=array();
	$AA_i=0;
	$ISLAMIC_CONVENTIONAL_INDICATOR;
	$bankid;
	$branch_id;
	$v_data =array();
	$min_date_interbranch = array();
	$no_of_days_cash_exced = array();
	
	$amt_sum_total=0;
	$data_amt_total = array();
	$cob = 0;
	
	foreach($records3 as $row3)
	{
		$bankid = $row3->BANK_ID;
		$branch_id = $row3->BRANCH_ID;
		$data_amt[$amt_count] = $row3->AMOUNT_BDT;
		$dd_pt_id_ary[$amt_count] = $row3->SUPERVISION_COA_ID;
		$ISLAMIC_CONVENTIONAL_INDICATOR = $row3->ISLAMIC_CONVENTIONAL_INDICATOR;
		if($row3->SUPERVISION_COA_ID == 1010310 && $row3->AMOUNT_BDT > 0 &&strlen($row3->AMOUNT_BDT) <=8)
		{
			$min_date_interbranch[$amt_count] = $row3->AMOUNT_BDT;
		}
		else if($row3->SUPERVISION_COA_ID == 1011665)
		{
			{
				$no_of_days_cash_exced[$amt_count] = number_format($row3->AMOUNT_BDT,0,'.','');
			}
		}
		$v_data[$amt_count] = $row3->Data_Validation;
		$amt_count++;	
	}
	
	//if(isset($report_option_selector) && $report_option_selector != 2)
	if(isset($login_office_status) && $login_office_status != 4)
	{
		foreach($records1 as $row5)
		{
		  for($ii=0;$ii<$amt_count;$ii++)
		  {
		   if($row5->SUPERVISION_COA_ID == $dd_pt_id_ary[$ii] && $row5->SUPERVISION_COA_ID != 1010310 )
		   {
				$amt_sum_total=$amt_sum_total + $data_amt[$ii];
			}
			if($row5->SUPERVISION_COA_ID == 1010310 && count($min_date_interbranch)>0)
			{
				$amt_sum_total = min($min_date_interbranch);
			}
			if($row5->SUPERVISION_COA_ID == 1011665)
			{
				$amt_sum_total = max($no_of_days_cash_exced);
			}
		}
		  $data_amt_total[$cob] = $amt_sum_total;
		  $amt_sum_total=0;
		  $cob++;
		}
	}
	$cob1=0;
	//if(isset($report_option_selector) && $report_option_selector == 2)
	if(isset($login_office_status) && $login_office_status == 4)
	{
		foreach($records3 as $row3)
	    {
		  $data_amt_total[$cob1] = $data_amt[$amt_count] = $row3->AMOUNT_BDT;
		  $cob1++;
		}
	}
	
		$iss_cer = $this->session->userdata('certified');
		if(isset($login_office_status) && $login_office_status != 4)
		{
		 
			if(isset($iss_cer) && $iss_cer == 1)
			{
				
			if(count($certificate_exist)>0)
				{
					 ?>
						<div style="background-color: green;color: #fff;width: 450px;padding:1px;"><h3 style="margin-left:50px;">This Report is certified.</h3></div>
					<?php	
				}
				else
				{
					?>
					<div style="background-color: red;color: #fff;width: 450px;padding:1px;"><h3>This Report is not certified!!!</h3></div>
					<?php	
				}
			}
			else
			{
				?>
				<div style="background-color: red;color: #fff;width: 450px;padding:1px;"><h3>This Report is not certified!!!</h3></div>
				<?php	
			}
		}
		if(isset($login_office_status) && $login_office_status == 4)
		{
			if($iss_cer ==4)
			{
				 ?>
						<div style="background-color: green;color: #fff;width: 450px;padding:1px;"><h3 style="margin-left:50px;">This Report is certified.</h3></div>
					<?php	
			}
			else
			{
				?>
				<div style="background-color: red;color: #fff;width: 450px;padding:1px;"><h3 style="margin-left:50px;">This Report is not certified!!!</h3></div>
				<?php	
			}
		}
	?>
     <table  align="center">
		<tr align="center"><th>ISS Report</th></tr>
		<tr align="center"><th><?php echo $report_of_office; ?></th></tr>
		<tr align="center"><th>Report of: <?php echo isset($report_of_date)?$report_of_date:''; ?></th></tr>
		<tr align="left"><th>Bank ID: <?php echo isset($bankid)?$bankid:''; ?> Branch Code(BB): <?php echo isset($branch_id)?$branch_id:''; ?></th></tr>
		<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
	<?php
    
    echo "<table border=\"1\" align=\"center\" id=\"t1\">";
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left'>"."<strong>"."SUPERVISION COA ID "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."INDICATOR"."<strong>"."</td>";
	if(isset($login_office_status) && $login_office_status == 4)
	{
		echo "<td align='centers'>"."<strong>"."Data Format"."<strong>"."</td>";
	}
	echo "</tr>";
		
	if(isset($login_office_status) && $login_office_status == 4)
	{
		$co=0;
		foreach($records1 as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$row1->SL."</td>"; 
			$A=$row1->SUPERVISION_COA_ID;
			echo "<input type='hidden' name='SUPERVISION_COA_ID[]' size='15' value='$A'/>";
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
			if($v_data[$co] !='Valid')
			{
				echo '<td align="right">'.$data_amt_total[$co].'</td>';
			}
			else if($row1->COA_ID_VALUE==2)		
			{
				echo '<td align="right">'.number_format($data_amt_total[$co], 0, '.', '').'</td>';
			}
			else 
			{
				echo '<td align="right">'.number_format($data_amt_total[$co],2).'</td>';
			}
			echo "<td align='left'>".$ISLAMIC_CONVENTIONAL_INDICATOR."</td>";
			if($v_data[$co] !='Valid')
			{
				echo "<td align='centers' style='color:red'>"."Wrong Format"."<strong>"."</td>";
			}
			echo "</tr>";
			$co++;
		}
	}
	
	if(isset($login_office_status) && $login_office_status != 4)
	{
		$co=0;
		foreach($records1 as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$row1->SL."</td>"; 
			$A=$row1->SUPERVISION_COA_ID;
			echo "<input type='hidden' name='SUPERVISION_COA_ID[]' size='15' value='$A'/>";
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
			$set_value=0;
			if(isset($data_amt_total[$co]) && $data_amt_total[$co] !='' && $row1->SUPERVISION_COA_ID != 1010310 && $row1->SUPERVISION_COA_ID != 1010300 && 
			$row1->SUPERVISION_COA_ID != 1010305 && $row1->SUPERVISION_COA_ID != 1010400 && $row1->SUPERVISION_COA_ID != 1010410)
			{
				$set_value = $data_amt_total[$co];
			}
			if($row1->SUPERVISION_COA_ID != 1010310 && $row1->SUPERVISION_COA_ID != 1010300 && 
			$row1->SUPERVISION_COA_ID != 1010305 && $row1->SUPERVISION_COA_ID != 1010400 && $row1->SUPERVISION_COA_ID != 1010410)
			{
				echo '<td align="right">'.number_format($set_value,2).'</td>';
			}
			if($row1->SUPERVISION_COA_ID == 1010310 || $row1->SUPERVISION_COA_ID == 1010300 || 
			$row1->SUPERVISION_COA_ID == 1010305 || $row1->SUPERVISION_COA_ID == 1010400 || $row1->SUPERVISION_COA_ID == 1010410)
			{
				echo '<td align="right">'.number_format($data_amt_total[$co], 0, '.', '').'</td>';
			}
			if($row1->SUPERVISION_COA_ID == 1010310 && isset($login_office_status) && $login_office_status != 4){	
			echo "<td align='left'>"."Lowest dated of your region" ."</td>";
			}
			
			echo "</tr>";
			$co++;
		}
	}
   	echo "</table>";
?>
</p>

</html>
