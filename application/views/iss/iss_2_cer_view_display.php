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
  echo form_open('iss/iss_2_certificate_data_save','id="id_iss_certificate_form"');   
    if(isset($_POST['login_office_status']) && isset($_POST['login_office_status'])>0)
	{
		$login_office_status = $_POST['login_office_status'];
	}
	 
   $uid = $this->session->userdata('some_uid');
   $office_id = $this->session->userdata('some_office');
   $iss_form = $this->session->userdata('iss_from');
   $iss_cer = $this->session->userdata('certified');
   if(isset($data_exist) && count($data_exist)>1)
   {
		$name = '';
		$desig = '';
		$is_certified = 0;
		if(isset($iss_cer) && $iss_cer == 1)
		{
			$total_list= 0;
			$com_list = 0;
			if(isset($completed_vs_total['completed']))
			{
				$com_list = isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0';
				echo "<input type='hidden' name='com_list' id='com_list' size='15' value='$com_list'/>";
			}
			if(isset($completed_vs_total['total']))
			{
				$total_list = isset($completed_vs_total['total'])?$completed_vs_total['total']:'0';
				echo "<input type='hidden' name='total_list' id='total_list' size='15' value='$total_list'/>";
			}
			 if($login_office_status ==4)
			 {
				if(isset($certificate_exist) && count($certificate_exist)>0)
				{
					 ?>
					<div style="background-color: green;color: #fff;height: 50px;padding: 1px;width: 450px;"><h3>This Report is certified.</h3></div>
					<?php	
				}
				 else
				{
					?>
					<div style="background-color: red;color: #fff;height: 50px;padding: 1px;width: 450px;"><h3>This Report is not certified!!!</h3></div>
					<?php	
				}
			 }
				
				 if($login_office_status !=4)
				 {
					if($com_list == $total_list)
					{
						if(isset($certificate_exist) && count($certificate_exist)>0)
						{
							 ?>
							<div style="background-color: green;color: #fff;height: 50px;padding: 1px;width: 450px;"><h3>This Report is certified.</h3></div>
							<?php	
						}
						 else
						{
							?>
							<div style="background-color: red;color: #fff;height: 50px;padding: 1px;width: 450px;"><h3>This Report is not certified!!!</h3></div>
							<?php	
						}
					
					}
					else
					{
						?>
						<div style="background-color: red;color: #fff;height: 50px;padding: 1px;width: 450px;"><h3>This Report is not certified!!!</h3></div>
						<?php	
					}
				 }
				if(isset($certificate_exist) && count($certificate_exist)>0)
				{
					if (is_array($certificate_exist) || is_object($certificate_exist))
					{
						foreach ($certificate_exist as $exist)
						{
							$name = $exist->br_ar_div__head_name;	
						    $is_certified = $exist->is_br_ar_div_certificate;	
						    $desig = $exist->br_ar_div__head_designation;	
						}
					}
				}
		}
		if($iss_cer == 0)
		{
			?>
			<div style="background-color: red;color: #fff;height: 50px;padding: 1px;width: 450px;"><h3>This Report is not certified!!!</h3></div>
			<?php	
		}
		if($is_certified ==1)
		 {
			$attribute = "checked = 'checked'";
		 } 
	    else
		 {
			if($is_certified ==0)
			{
				$attribute = '';
			}
		 }
		 $data_amt = array();
		 $bank_id;
		$branch_id;
		$amt_count = 0;
		$dd_pt_id_ary = array();
		$AA_i=0;
		$ISLAMIC_CONVENTIONAL_INDICATOR;
		$min_date_interbranch = array();
		$v_data =array();
	
	foreach($records3 as $row3)
	{
		
		$bank_id = $row3->BANK_ID;
		$branch_id = $row3->BRANCH_ID;
		$data_amt[$amt_count] = $row3->AMOUNT_BDT;
		$dd_pt_id_ary[$amt_count] = $row3->SUPERVISION_COA_ID;
		$ISLAMIC_CONVENTIONAL_INDICATOR = $row3->ISLAMIC_CONVENTIONAL_INDICATOR;
		
		if($row3->SUPERVISION_COA_ID == 1010310 && $row3->AMOUNT_BDT > 0 && (strlen($row3->AMOUNT_BDT) >= 8 || strlen($row3->AMOUNT_BDT)<11))
		{
			if(strpos($row3->AMOUNT_BDT,'.')== true && strlen($row3->AMOUNT_BDT) == 11)
			$min_date_interbranch[$amt_count] = $row3->AMOUNT_BDT;
		}
		$v_data[$amt_count] = $row3->Data_Validation;
		$amt_count++;
	}
	
	$amt_sum_total=0;
	$data_amt_total = array();
	$cob = 0;
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
		   }
		  $data_amt_total[$cob] = $amt_sum_total;
		  $amt_sum_total=0;
		  $cob++;
		}
	}
	
	
	$cob1=0;
	if(isset($login_office_status) && $login_office_status == 4)
	{
		foreach($records3 as $row3)
	    {
		  $data_amt_total[$cob1] = $row3->AMOUNT_BDT;
		  $cob1++;
		}
	}
	
	?>
    <table  align="center">
    <tr align="center"><th>ISS Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date)?$report_of_date:''; ?></th></tr>
	<tr align="left"><th>Bank ID: <?php echo isset($bank_id)?$bank_id:''; ?> Branch Code(BB): <?php echo isset($branch_id)?$branch_id:''; ?></th></tr>
    <?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>
	Certificate Reporting: 
	<?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    
	</table>
    <?php
     
    echo "<table border=\"1\" align=\"center\">";
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
	$is_valid = 0;
	if(isset($login_office_status) && $login_office_status == 4)
	{
		$co=0;
		foreach($records1 as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$row1->SL."</td>"; 
			$A = $row1->SUPERVISION_COA_ID;
			echo "<input type='hidden' name='COA_ID[]' size='15' value='$A'/>";
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
			echo "<input type='hidden' name='COA_DESC[]' size='15' value='$row1->COA_DESCRIPTION'/>";
			if($v_data[$co] !='Valid')
			{
				echo '<td align="right">'.$data_amt_total[$co].'</td>';
			}
			else if($row1->SUPERVISION_COA_ID == 1010310 || $row1->SUPERVISION_COA_ID == 1010300 || 
			$row1->SUPERVISION_COA_ID == 1010305 || $row1->SUPERVISION_COA_ID == 1010400 || $row1->SUPERVISION_COA_ID == 1010410)
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
			echo '<td>'.'<input type="hidden" id="amount_'.$co.'" name="amount[]" value="'.$data_amt_total[$co].'" size="20" />'.'</td>';
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
			
			$coa_id = $row1->SUPERVISION_COA_ID;
			//echo "<input type='hidden' name='COA_ID[]' size='15' value='$coa_id'/>";
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
			//echo "<input type='hidden' name='COA_DESC[]' size='15' value='$row1->COA_DESCRIPTION'/>";
			$set_amount =0;
			if(isset($data_amt_total[$co]) && $data_amt_total[$co] !='' && $row1->SUPERVISION_COA_ID != 1010310 && $row1->SUPERVISION_COA_ID != 1010300 && 
			$row1->SUPERVISION_COA_ID != 1010305 && $row1->SUPERVISION_COA_ID != 1010400 && $row1->SUPERVISION_COA_ID != 1010410)
			{
				$set_amount = $data_amt_total[$co];
			}
			if($row1->SUPERVISION_COA_ID != 1010310 && $row1->SUPERVISION_COA_ID != 1010300 && 
			$row1->SUPERVISION_COA_ID != 1010305 && $row1->SUPERVISION_COA_ID != 1010400 && $row1->SUPERVISION_COA_ID != 1010410)
			{
				echo '<td align="right">'.number_format($set_amount,2).'</td>';
			}
			if($row1->SUPERVISION_COA_ID == 1010310 || $row1->SUPERVISION_COA_ID == 1010300 || 
			$row1->SUPERVISION_COA_ID == 1010305 || $row1->SUPERVISION_COA_ID == 1010400 || $row1->SUPERVISION_COA_ID == 1010410)
			{
				echo '<td align="right">'.$data_amt_total[$co].'</td>';
				$set_amount = $data_amt_total[$co];
			}
			//if($login_office_status == 4){
				//echo "<td align='left'>".$ISLAMIC_CONVENTIONAL_INDICATOR."</td>";
			//}
			//else 
			{
					if($row1->SUPERVISION_COA_ID == 1010310 && isset($login_office_status)>0 && ($login_office_status != 4)){	
					echo "<td align='left'>"."Lowest dated of your region" ."</td>";
				 }
			}
			
			echo '<td>'.'<input type="hidden" id="amount_'.$co.'" name="amount[]" value="'.$set_amount.'" size="20" />'.'</td>';
			
			echo "</tr>";
			$co++;
		}
	}
	//$co=0;
	
	if(isset($login_office_status) && $login_office_status !=1)
	{
		echo "</table>";
		echo "<table style='background:#ffe5e5'>";	
		echo "<tr>";
		echo "<td colspan='7' align='center'>";
		echo "প্রত্যয়ন পত্র";
		echo "</td>";
		echo "</tr>";	
		echo "<tr>";
		echo "<td colspan='7' align='left'>";
		echo "এই মর্মে প্রত্যয়ন করা যাইতেছে যে, ";
		echo isset($report_of_date)?$report_of_date:'';
		echo "তারিখের উপরিউক্ত আইএসএস তথ্যাদি সম্পূর্ণ নির্ভুল এবং এই তথ্য বাংলাদেশ ব্যাংকের পোর্টালে আপলোড করার পর কোন তথ্যে ভুল পাওয়া গেলে তার দায়-দায়িত্ব আমাদের উপর বর্তাবে।";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align='left'>";
		
		echo "<input type='checkbox' name='cer_check' id='cer_check' $attribute value=''>";
		echo "উপরোক্ত তথ্যাদি আমাদের জানা মতে সঠিক।";
		echo "</td>";
		echo "<td align='left'>";
		
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
		$head = "Head";
		if(isset($login_office_status) && $login_office_status ==4)
		{
			$head = "Manager";
		}
		echo "Name of ".$report_of_office." ".$head;
		echo "</td>";
		
		echo "<td align='left'>";
		echo "<input type='text' name='head_name' id='head_name' value='$name' placeholder='Name' style='width:300px;height:30px;background:#808080;font-size:16px;'>";
		echo "</td>";
		echo "</tr>";
	   
	   echo "<tr>";
		echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
		echo "Designation";
		echo "</td>";
		
		echo "<td>";
		echo "<input type='text' name='designation' id='designation' value='$desig' placeholder='Designation' style='width:300px;height:30px;background:#808080;font-size:16px;'>";
		echo "</td>";
		
		echo "</tr>";
		
		echo "<tr>";
		echo "<td></td>";
		echo "</td>";
			$attribute='style="background-color: #FF9900; width:300px;height:30px;font-size:16px;"';
			echo "<td><input type='button' id='iss_cer_submit_btn' value='Submit' onclick='certificate_iss_form(this.value)'  $attribute /></td>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	
	
	} 	
	$check= 0;
	foreach($records1 as $row1)
	{
		if($v_data[$check] !='Valid')
		{
			$is_valid =1;
			break;
		}
		$check++;
	}
	echo "<input type='hidden' name='bank_id_send' size='15' value='$bank_id'/>";
	echo "<input type='hidden' name='branch_id_bal' size='15' value='$branch_id'/>";
	echo "<input type='hidden' name='report_date_send' size='15' value='$report_of_date'/>";
	echo "<input type='hidden' name='ISLAMIC_CONVENTIONAL' size='15' value='$ISLAMIC_CONVENTIONAL_INDICATOR'/>";
	echo "<input type='hidden' name='valid_check' id='valid_check' size='15' value='$is_valid'/>";
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
    
   echo form_close(); 
?>
</p>

<p>&nbsp;</p>
</body>
</html>
