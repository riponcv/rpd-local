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
//echo "<pre>";
//print_r($records3_predata);
//die();

//echo $report_of_date;

//die();
?>	
  <?php 
  if($this->session->flashdata('success_wp'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_wp').'</font>'; 
    	echo "</div>";
    }
		
	 $uid = $this->session->userdata('some_uid');
	 $office_id = $this->session->userdata('some_office');
  	//$query_date_val[0]->ISSCerendDate
	//print_r($query_date_val);
	/*echo date("Y-m-d")."<";
	
	echo $query_date_val[0]->ISSCerendDate;
	
	if( date("Y-m-d") < $query_date_val[0]->ISSCerendDate)
	{
		echo "Yes";
	}
	else
	{
		echo "No";
	}*/
	$is_check = 0;
	if(isset($office_id_check)!='' && isset($office_id)!='')
	{
		if(($office_id_check == $office_id))
		{
			$is_check = 1;
		}
	}
	$cer_date_chk = 0;
	if((date("Y-m-d") < $query_date_val[0]->ISSCerendDate))
	{
		$cer_date_chk = 1;
	}
	//echo $is_check;
		
	$login_office_status_post = '';
	$report_option_selector_post = '';
	$report_click_btn_post = '';
	$report_of_date_post = '';
	
	if(isset($login_office_status))
	{
		$login_office_status_post = $login_office_status;
	}
	if(isset($report_option_selector))
	{
		$report_option_selector_post = $report_option_selector;
	}
	if(isset($report_click_btn))
	{
		$report_click_btn_post = $report_click_btn;
	}
	if(isset($report_of_date))
	{
		$report_of_date_post = $report_of_date;
	}
		
	if(isset($report_option_selector) && isset($report_option_selector)==1)
	{
		if($cer_date_chk==1)
		{
			echo form_open('iss/iss_2_certificate_data_save','id="id_iss_certificate_form"');   		
		}
		else 
		{
			echo form_open(' ');   		
		}
		
	}
	else
	{
		if(isset($report_option_selector) && isset($report_option_selector)!=1)
		{
			echo form_open('iss/iss_report_details/1','id="id_iss_certificate_form"');   	
		}
	}
	   
   $iss_form = $this->session->userdata('iss_from');
   $iss_cer = $this->session->userdata('certified');
  
   if(isset($data_exist) && count($data_exist)>1)
   {
		$name_1 = '';
		$name_2 = '';
		$name_3 = '';
		$name = '';
		$desig_1 = '';
		$desig_2 = '';
		$desig_3 = '';
		$desig = '';
		$is_certified = 0;
		
			$name = '';
			$desig = '';
			if(isset($certificate_exist) && count($certificate_exist)>0)
			{
				if (is_array($certificate_exist) || is_object($certificate_exist))
				{
					foreach ($certificate_exist as $exist)
					{
						$is_certified = $exist->is_br_ar_div_certificate;	
						if($login_office_status ==4){
							$name_1 = $exist->br_ar_div__officer_name_1;	
							$name = $exist->br_ar_div__head_name;	
							//$desig_1 = $exist->br_ar_div__officer_designation_1;	
							$desig = $exist->br_ar_div__head_designation;	
						}
						else {
							if($login_office_status !=4){
								$name_1 = $exist->br_ar_div__officer_name_1;	
								$name_2 = $exist->br_ar_div__officer_name_2;	
								$name_3 = $exist->br_ar_div__officer_name_3;	
								$name = $exist->br_ar_div__head_name;	
								$desig_1 = $exist->br_ar_div__officer_designation_1;	
								$desig_2 = $exist->br_ar_div__officer_designation_2;	
								$desig_3 = $exist->br_ar_div__officer_designation_3;	
								$desig = $exist->br_ar_div__head_designation;	
							}
						}
					}
				}
			}
			
		$total_list= 0;
			$com_list = 0;
			if(isset($cer_completed_vs_total['completed']))
			{
				$com_list = isset($cer_completed_vs_total['completed'])?$cer_completed_vs_total['completed']:'0';
				echo "<input type='hidden' name='com_list' id='com_list' size='15' value='$com_list'/>";
			}
			if(isset($cer_completed_vs_total['total']))
			{
				$total_list = isset($cer_completed_vs_total['total'])?$cer_completed_vs_total['total']:'0';
				echo "<input type='hidden' name='total_list' id='total_list' size='15' value='$total_list'/>";
			}
			
		if(isset($iss_cer) && $iss_cer == 1)
		{
			 if($login_office_status ==4)
			 {
				if(isset($certificate_exist) && ($name !='') && ($desig !='') && ($name_1 !='') && ($desig_1 !='') && count($certificate_exist)>0)
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
				
				 if($login_office_status !=4 && $login_office_status !=1)
				 {
					if($com_list == $total_list)
					{
						if(isset($certificate_exist) && count($certificate_exist)>0 && ($name !='') && ($name_1 !='') && ($name_1 !='') && ($name_1 !='') && ($desig !='') && ($desig_1 !='') && ($desig_2 !='') && ($desig_3 !=''))
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
		 $no_of_days_cash_exced = array();
		 $v_data =array();
					
		
	if(isset($login_office_status) && $login_office_status != 1)
	{
		foreach($records3 as $row3)
		{
			$bank_id = $row3->BANK_ID;
			$branch_id = $row3->BRANCH_ID;
			$data_amt[$amt_count] = $row3->AMOUNT_BDT;
			$dd_pt_id_ary[$amt_count] = $row3->SUPERVISION_COA_ID;
			$ISLAMIC_CONVENTIONAL_INDICATOR = $row3->Figure_indication;
			
			if($row3->SUPERVISION_COA_ID == 1010310 && $row3->AMOUNT_BDT > 0 && (strlen($row3->AMOUNT_BDT) >= 8 || strlen($row3->AMOUNT_BDT)<11))
			{
				{
					$min_date_interbranch[$amt_count] = number_format($row3->AMOUNT_BDT,0,'.','');
				}
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
    <tr align="center"><th>ISS Form-2 (T_PS_M_FI_MONITOR_BR) Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date)?$report_of_date:''; ?></th></tr>
	<?php
	if(isset($login_office_status) && $login_office_status == 4)
	{
	?>
	<tr align="left"><th>Bank ID: <?php echo isset($bank_id)?$bank_id:''; ?> Branch Code(BB): <?php echo isset($branch_id)?$branch_id:''; ?></th></tr>
	<?php
	}
	?>
	<?php if(isset($login_office_status) && $login_office_status != 4 && $login_office_status !=1) {?>    
	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>    
	<?php if(isset($cer_completed_vs_total['total']) && $cer_completed_vs_total['total']>1){ ?><tr align="center"><th>
	Certificate Reporting: <?php echo isset($cer_completed_vs_total['completed'])?$cer_completed_vs_total['completed']:'0'; echo '/'; echo isset($cer_completed_vs_total['total'])?$cer_completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
	<?php } ?>
	
	<?php if(isset($login_office_status) && $login_office_status ==1) {?>    
	
	<?php if(isset($whole_raw) && $whole_raw>1){ ?><tr align="center"><th>Reporting: <?php echo isset($whole_raw)? $whole_raw:'0'; echo '/'; echo isset($whole_raw)?$whole_raw:'0'; ?></th></tr><?php } ?>    
	<?php if(isset($whole_certificate) && $whole_certificate>1){ ?><tr align="center"><th>
	Certificate Reporting: <?php echo isset($whole_certificate)?$whole_certificate:'0'; echo '/'; echo isset($whole_raw)?$whole_raw:'0'; ?></th></tr><?php } ?>
	<?php } ?>
	</table>
    <?php
    $check_month = 0;
	if(isset($report_of_date)){
		$unixtime = strtotime($report_of_date);
		$check_month = date('m', $unixtime);
	
	}
	/*------------Condition start------------------------------------------------------------------------------------*/			
	$accounting_year_con = array(1010527,1010590,1010591,1010595,1010652,1010653,1010654,1010655,1010725,1010730,
								 010740,1010610,1010880,1010930,1011000,1011005,1011071,1011073,1011076,1011078,
								 1011081,1011083,1011085,1011087,1011089,1011091,1011093,1011072,1011074,1011077,
								 1011079,1011082,1011084,1011086,1011088,1011090,1011092,1011094,1011050,1011055,
								 1011075,1011430,1011435,1011440,1011445); 	
	/*------------Condition end------------------------------------------------------------------------------------*/			
    echo "<table border=\"1\" align=\"center\" width:600 >";
	
	if(isset($login_office_status) && $login_office_status == 4)
	{
		echo "<tr>";
		echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."SUPERVISION COA ID "."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
		echo "<td align='centers'>"."<strong>"."Figure indication"."<strong>"."</td>";
		echo "<td align='centers'>"."<strong>"."Amount in Taka (".$pre_report_of_date.") "."<strong>"."</td>";
		echo "<td align='centers'>"."<strong>"."Amount in Taka (".$report_of_date.") "."<strong>"."</td>";
		echo "<td align='centers'>"."<strong>"."Data Format"."<strong>"."</td>";
	}
	echo "</tr>";
	$is_valid = 0;
	if(isset($login_office_status) && $login_office_status == 4)
	{
		
		
		$co = 0;
		foreach($records1 as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$row1->SL."</td>"; 
			$A = $row1->SUPERVISION_COA_ID;
			echo "<input type='hidden' name='COA_ID[]' size='15' value='$A'/>";
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
			echo "<input type='hidden' name='COA_DESC[]' size='15' value='$row1->COA_DESCRIPTION'/>";
			echo "<td align='left'>".$row1->Figure_indication."</td>";
			
			if(!empty($records3_predata)){
				
				if($records3_predata[$co]->COA_ID_VALUE == 2){
					echo '<td align="right">'.number_format($records3_predata[$co]->AMOUNT_BDT, 0, '.','').'</td>';		
				}
				else {
					echo '<td align="right">'.number_format($records3_predata[$co]->AMOUNT_BDT, 2).'</td>';		
				}
				
			}
			else {
				echo '<td align="right">0.00</td>';	
			}
			
			
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
			
			if($v_data[$co] !='Valid')
			{
				echo "<td align='centers' style='color:red'>"."Wrong Format"."<strong>"."</td>";
			}
			else {
				
				if($check_month != 01)
				{
					if(in_array($row1->SUPERVISION_COA_ID, $accounting_year_con) && in_array($records3_predata[$co]->SUPERVISION_COA_ID, $accounting_year_con))
					{
						if($records3_predata[$co]->AMOUNT_BDT > $data_amt_total[$co])
						{
							echo "<td align='centers' style='background:red'>"."Wrong"."<strong>"."</td>";
						}
					}
				}			
			}
			echo '<td>'.'<input type="hidden" id="amount_'.$co.'" name="amount[]" value="'.$data_amt_total[$co].'" size="20" />'.'</td>';
			echo "</tr>";
			$co++;
		}
	}
	
	if(isset($login_office_status) && $login_office_status != 4 && $login_office_status !=1)
	{
		echo "<tr>";
		echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."SUPERVISION COA ID "."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
		echo "<td align='centers'>"."<strong>"."Figure indication"."<strong>"."</td>";
		
		echo "<td align='centers'>"."<strong>"."Amount in Taka (".$report_of_date.") "."<strong>"."</td>";
		echo "<td align='centers'>"."<strong>"."Data Format"."<strong>"."</td>";
		echo "</tr>";
		$co=0;
		foreach($records1 as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$row1->SL."</td>"; 
			
			$coa_id = $row1->SUPERVISION_COA_ID;
			
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
			
			$set_amount =0;
			if($row1->COA_ID_VALUE==1)	
			{
				$set_amount = $data_amt_total[$co];
			}
			if($row1->COA_ID_VALUE==1)		
			{
				echo '<td align="right">'.number_format($set_amount,2).'</td>';
			}
			if($row1->COA_ID_VALUE==2)			
			{
				
				echo '<td align="right">'.number_format($data_amt_total[$co], 0, '.', '').'</td>';
				$set_amount = $data_amt_total[$co];
			}
			{
					if($row1->SUPERVISION_COA_ID == 1010310 && isset($login_office_status)>0 && ($login_office_status != 4)){	
					echo "<td align='left'>"."Lowest dated of your region" ."</td>";
				 }
				 else
				 {
					 echo "<td align='left'>".$row1->Figure_indication ."</td>";
				 }
			}
			
			echo '<input type="hidden" id="amount_'.$co.'" name="amount[]" value="'.$set_amount.'" size="20" />';
			
			echo "</tr>";
			$co++;
		}
	}
	if(isset($login_office_status) && $login_office_status ==1)
	{
		echo "<tr>";
		echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."SUPERVISION COA ID "."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
		//echo "<td align='centers'>"."<strong>"."Figure indication"."<strong>"."</td>";
	
		echo "<td align='centers'>"."<strong>"."Amount in Taka (".$report_of_date.") "."<strong>"."</td>";
		echo "<td align='centers'>"."<strong>"."Data Format"."<strong>"."</td>";
		echo "</tr>";
		$co=1;
		foreach($records3 as $row_1)
		{
			echo "<tr>";
			echo "<td align='center'>".$co."</td>"; 
			echo "<td align='right'>".$row_1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row_1->COA_DESCRIPTION."</td>";
			if($row_1->SUPERVISION_COA_ID != 1010300 && $row_1->SUPERVISION_COA_ID != 1010305 && $row_1->SUPERVISION_COA_ID != 1010310 && 
				$row_1->SUPERVISION_COA_ID != 1010274 && $row_1->SUPERVISION_COA_ID != 1010275 && $row_1->SUPERVISION_COA_ID != 1010276 &&
				$row_1->SUPERVISION_COA_ID != 1010277 && $row_1->SUPERVISION_COA_ID != 1010400 && $row_1->SUPERVISION_COA_ID != 1010410 &&
				$row_1->SUPERVISION_COA_ID != 1011665 && $row_1->SUPERVISION_COA_ID != 1011400 && $row_1->SUPERVISION_COA_ID != 1011410 &&
				$row_1->SUPERVISION_COA_ID != 1011425 && $row_1->SUPERVISION_COA_ID != 1011440 && $row_1->SUPERVISION_COA_ID != 1011450 &&
				$row_1->SUPERVISION_COA_ID != 1011455)
			{
				echo "<td align='right'>".number_format($row_1->AMOUNT_BDT,2)."</td>";
			}
			if($row_1->SUPERVISION_COA_ID == 1010300 || $row_1->SUPERVISION_COA_ID == 1010305 || $row_1->SUPERVISION_COA_ID == 1010310 || 
					$row_1->SUPERVISION_COA_ID == 1010274 || $row_1->SUPERVISION_COA_ID == 1010275 || $row_1->SUPERVISION_COA_ID == 1010276 ||
					$row_1->SUPERVISION_COA_ID == 1010277 || $row_1->SUPERVISION_COA_ID == 1010400 || $row_1->SUPERVISION_COA_ID == 1010410 ||
					$row_1->SUPERVISION_COA_ID == 1011665 || $row_1->SUPERVISION_COA_ID == 1011400 || $row_1->SUPERVISION_COA_ID == 1011410 ||
					$row_1->SUPERVISION_COA_ID == 1011425 || $row_1->SUPERVISION_COA_ID == 1011440 || $row_1->SUPERVISION_COA_ID == 1011450 ||
					$row_1->SUPERVISION_COA_ID == 1011455)
			{
				echo "<td align='right'>".number_format($row_1->AMOUNT_BDT, 0, '.', '')."</td>";
			}
			echo "</tr>";
			$co++;
		}
	}

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
			//echo "<td colspan='7' align='left'>";
			//echo "এই মর্মে প্রত্যয়ন করা যাইতেছে যে, ";
			//echo isset($report_of_date)?$report_of_date:'';
			//echo "তারিখের উপরিউক্ত আইএসএস তথ্যাদি সম্পূর্ণ নির্ভুল এবং এই তথ্য বাংলাদেশ ব্যাংকের পোর্টালে আপলোড করার পর কোন তথ্যে ভুল পাওয়া গেলে তার দায়-দায়িত্ব আমাদের উপর বর্তাবে।";
			?>
				<td colspan='7'>
					<div class="iss_cer_pos"><?php echo isset($report_of_date)?$report_of_date:''; ?></div>
					<img src="<?php echo base_url(); ?>/images/iss_cer.jpg" alt="">
				</td>
			<?php
			
			//echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td align='left'>";
			
			echo "<input type='checkbox' name='cer_check' id='cer_check' $attribute value=''>";
			echo "উপরোক্ত তথ্যাদি আমাদের জানা মতে সঠিক।";
			echo "</td>";
			echo "<td align='left'>";
			echo "</td>";
			echo "</tr>";
			
			
			$head = "Head";
			$concern_off = '';
			if(isset($login_office_status_post) && $login_office_status_post==4)
			{
				$concern_off = 'Concern ISS Officer';
				$head = "Manager";
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Name of ".$report_of_office." ".$concern_off;
				echo "</td>";	
				echo "<td align='left'>";
				echo "<input type='text' name='br_concern_officer_name' id='br_concern_officer_name' value='$name_1' placeholder='Name' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Designation";
				echo "</td>";
				
				echo "<td>";
				echo "<input type='text' name='br_concern_officer_designation' id='br_concern_officer_designation' value='$desig_1' placeholder='Designation' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";										
				
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Name of ".$report_of_office." ".$head;
				echo "</td>";	
				echo "<td align='left'>";
				echo "<input type='text' name='br_head_name' id='br_head_name' value='$name' placeholder='Name' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Designation";
				echo "</td>";
				
				echo "<td>";
				echo "<input type='text' name='br_head_designation' id='br_head_designation' value='$desig' placeholder='Designation' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
		
			}
			if(isset($login_office_status_post) && $login_office_status_post != 4)
			{
				$concern_off = 'Concern ISS Officer';
				//1
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Name of ".$report_of_office." ".$concern_off;
				echo "</td>";	
				echo "<td align='left'>";
				echo "<input type='text' name='concern_officer_name_1' id='concern_officer_name_1' value='$name_1' placeholder='Name' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Designation";
				echo "</td>";
				
				echo "<td>";
				echo "<input type='text' name='concern_officer_desig_1' id='concern_officer_desig_1' value='$desig_1' placeholder='Designation' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				//2
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Name of ".$report_of_office." ".$concern_off;
				echo "</td>";	
				echo "<td align='left'>";
				echo "<input type='text' name='concern_officer_name_2' id='concern_officer_name_2' value='$name_2' placeholder='Name' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Designation";
				echo "</td>";
				
				echo "<td>";
				echo "<input type='text' name='concern_officer_desig_2' id='concern_officer_desig_2' value='$desig_2' placeholder='Designation' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";	
				
				//3
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Name of ".$report_of_office." ".$concern_off;
				echo "</td>";	
				echo "<td align='left'>";
				echo "<input type='text' name='concern_officer_name_3' id='concern_officer_name_3' value='$name_3' placeholder='Name' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Designation";
				echo "</td>";
				
				echo "<td>";
				echo "<input type='text' name='concern_officer_desig_3' id='concern_officer_desig_3' value='$desig_3' placeholder='Designation' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				//head
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Name of ".$report_of_office." ".$head;
				echo "</td>";	
				echo "<td align='left'>";
				echo "<input type='text' name='ro_dv_head_name' id='ro_dv_head_name' value='$name' placeholder='Name' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td style='text-align:left;height:30px;background:#ffffff;font-size:16px;'>";
				echo "Designation";
				echo "</td>";
				
				echo "<td>";
				echo "<input type='text' name='ro_dv_head_designation' id='ro_dv_head_designation' value='$desig' placeholder='Designation' style='width:300px;height:30px;background:#eeeeee;font-size:16px;'>";
				echo "</td>";
				echo "</tr>";
			}
			echo "<tr>";
			$attribute1 = 'style="background-color: #FF9900;width:200px;height:30px;font-size:16px;"';
			
			if((isset($report_option_selector) && $report_option_selector ==1) || $is_check==1)
			{
				if($cer_date_chk == 1)
				{
					$attribute2 = 'style="background-color: #FF9900; width:300px;height:30px;font-size:16px;"';
					echo "<td><input type='button' id='iss_cer_submit_btn' value='Submit' onclick='certificate_iss_form(this.value)'  $attribute2 /></td>";	
				}
			}
			echo "</tr>";
			echo "</table>";
		}	
		
		if(isset($login_office_status) && $login_office_status != 4 && $login_office_status !=1)
		{
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
			
		}
	
	$bank_id_p=0;
	$branch_id_p=0;
	$ISLAMIC_CONVENTIONAL_INDICATOR_p=0;
	if(isset($bank_id)){$bank_id_p=$bank_id;}
	if(isset($branch_id)){$branch_id_p=$branch_id;}
	if(isset($ISLAMIC_CONVENTIONAL_INDICATOR)){$ISLAMIC_CONVENTIONAL_INDICATOR_p=$ISLAMIC_CONVENTIONAL_INDICATOR;}
	
	echo "<input type='hidden' name='bank_id_send' size='15' value='$bank_id_p'/>";
	echo "<input type='hidden' name='branch_id_bal' size='15' value='$branch_id_p'/>";
	echo "<input type='hidden' name='ISLAMIC_CONVENTIONAL' size='15' value='$ISLAMIC_CONVENTIONAL_INDICATOR_p'/>";
	
	echo "<input type='hidden' name='report_date_send' size='15' value='$report_of_date'/>";
	echo "<input type='hidden' name='valid_check' id='valid_check' size='15' value='$is_valid'/>";
	
	echo "<input type='hidden' name='report_option_selector' id='report_option_selector' size='15' value='$report_option_selector_post'/>";
	echo "<input type='hidden' name='login_office_status' id='login_office_status' size='15' value='$login_office_status_post'/>";
	echo "<input type='hidden' name='report_click_btn' id='report_click_btn' size='15' value='$report_click_btn_post'/>";
	echo "<input type='hidden' name='report_of_date' id='report_of_date' size='15' value='$report_of_date_post'/>";
	
	echo "<input type='hidden' name='report_office_check' id='report_office_check' size='15' value='$is_check'/>";
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
</body>
</html>
