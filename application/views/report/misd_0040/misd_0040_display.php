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
    </table>
	<br/><br/>
  
  <?php 
  
   if(isset($records3_1) && count($records3_1)>0)
   {
	?>
    <table  align="center">
    <tr align="center"><th>Weekly Position Comparison Report</th></tr>
     <tr align="center"><th><?php echo isset($report_of_office)?$report_of_office:''; ?></th></tr>
	<tr><th><?php echo isset($command_office)?$command_office:''; ?></th></tr>
    <tr align="center"><th>Weekly Position Comparison of: <?php echo isset($report_of_date1)?$report_of_date1:'';  echo ' and '; echo isset($report_of_date2)?$report_of_date2:'';?></th></tr>
	<?php if(isset($completed_vs_total_1['total']) && $completed_vs_total_1['total']>1){ ?>
	<tr align="center"><th>Reporting on: (<?php echo isset($report_of_date1)?$report_of_date1:''; echo "): "; echo isset($completed_vs_total_2['completed'])?$completed_vs_total_1['completed']:'0'; echo '/'; echo isset($completed_vs_total_1['total'])?$completed_vs_total_1['total']:'0'; ?></th></tr>
	<?php } ?>
    
	<?php if(isset($completed_vs_total_2['total']) && $completed_vs_total_2['total']>1){ ?>
	<tr align="center"><th>Reporting on: (<?php echo isset($report_of_date2)?$report_of_date2:''; echo "): "; echo isset($completed_vs_total_2['completed'])?$completed_vs_total_2['completed']:'0'; echo '/'; echo isset($completed_vs_total_2['total'])?$completed_vs_total_2['total']:'0'; ?></th></tr>
	<?php } ?>
	
	</table>
    <br />
	
	<table border="1" align="right" style="margin-top: -90px;">
	  <tr>
		<td width="80">Report</td>
		<td width="175"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
	  </tr>
	  <tr>
		<td width="80">Printing Date </td>
		<td width="175"><?php echo date('d/m/y'); ?></td>
	  </tr>
	  <tr>
		<td width="80">Source </td>
		<td width="175">MISD RPD JBL HO Dhaka</td>
	  </tr>
	</table>
	<br />
    <?php
    echo "<table border=\"1\" align=\"center\">";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' width='300'>"."<strong>"."HEADS OF ACCOUNTS "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Accounts "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Telg. Code "."<strong>"."</td>";
	//echo "<td align='centers'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Amount in Taka (".$report_of_date1.")"."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Amount in Taka (".$report_of_date2.")"."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Difference Amount"."<strong>"."</td>";
	echo "</tr>";
	//First Date calulation start	
	$data_amt_1 = array();
	$amt_count_1=0;
	$account_1=0;
	$amt_sum_1=0;
	$amt_total_1=array();
	$AA=array();
	$BB=array();
	$dd_pt_id_ary=array();
	$AA_i=0;
	$amt_sum_total_1=0;
		
		$data_amt_total_1 = array();
	if((isset($records3_1) && count($records3_1)>0))
	{
		foreach($records3_1 as $row3_1)
		{
		 $data_amt_1[$amt_count_1]= $row3_1->weekly_amt;
		 $amt_count_1++;
		}
		
		foreach($records3_1 as $row5_1)
		{
		 $AA_A=$row5_1->weekly_prod_subgroup_code;
		 $dd_pt_id_ary[$AA_i]=$AA_A;
		 //$AA_A=substr($AA_A,0,1);
		   if(strlen($AA_A)==3)
		 {
		 $AA_A=substr($AA_A,0,1);
		 }
		 else if (strlen($AA_A)==4)
		   {
		  $AA_A=substr($AA_A,0,2);
		 }
		 $AA[$AA_i]=$AA_A;
		 $AA_i++;
		}
		
		$AA_A_i=0;
		$pt_id_A=array();
		foreach($records2 as $row8)
		{
		 $pt_id_A[$AA_A_i]=$row8->weekly_position_subgroup_code;
		 $AA_A_i++;
		}
		
		for($jj=0;$jj<$AA_A_i;$jj++)
		{
		  for($ii=0;$ii<$AA_i;$ii++)
		  {
		   if($pt_id_A[$jj]==$dd_pt_id_ary[$ii])
		   {
			$amt_sum_total_1=$amt_sum_total_1+$data_amt_1[$ii];
			$account_1++;
		   }
		 }
		  $data_amt_total_1[$jj]=$amt_sum_total_1;
		  $amt_sum_total_1=0;
		}
		$BB_i=0;
		foreach($records1 as $row5)
		{
		 $BB_B=$row5->weekly_position_group_code;
		 $BB[$BB_i++]=$BB_B;
		}
		
		for($jj=0;$jj<$BB_i;$jj++)
		{
		  for($ii=0;$ii<$AA_i;$ii++)
		  {
		   if($BB[$jj]==$AA[$ii])
		   {
			$amt_sum_1=$amt_sum_1+$data_amt_1[$ii];
			$account_1++;
		   }
		 }
		  $amt_total_1[$jj]=$amt_sum_1;
		  $amt_sum_1=0;
		}
	
	}
	
	
	/////////////////Weekly Total/////////////////
	$dep_total_ex_bp_1=0;
	$weekly_dep_1=0;
    $weekly_dep_fc_1=0;
	$weekly_adp_1=0;
	$weekly_cash_1=0;
    
    //start dep_total_ex_bp calculation
	for($i=0;$i<=18;$i++)
	{
		if(isset($data_amt_total_1[$i]) && $data_amt_total_1[$i]!='')
		{
			$dep_total_ex_bp_1=$dep_total_ex_bp_1+$data_amt_total_1[$i];
		}
	}
    //end dep_total_ex_bp calculation
    
	//start dep_total calculation
    for($i=19;$i<=21;$i++)
	{
		if(isset($data_amt_total_1[$i]) && $data_amt_total_1[$i] !='')
		{
			$weekly_dep_1=$weekly_dep_1+$data_amt_total_1[$i];
		}
	}
	$weekly_dep_1=$weekly_dep_1+$dep_total_ex_bp_1;
    //end dep_total calculation
    
	//start deposit_foreign_currency calculation
    for($i=14;$i<=16;$i++)
	{
		if(isset($data_amt_total_1[$i]) && $data_amt_total_1[$i] !='')
		{
			$weekly_dep_fc_1=$weekly_dep_fc_1+$data_amt_total_1[$i];
		}
	}
    
    //end deposit_foreign_currency calculation
    		
	//start adv_total calculation
    for($i=32;$i<=40;$i++)
	{
		if(isset($data_amt_total_1[$i]) && $data_amt_total_1[$i] !='')
		{
			$weekly_adp_1=$weekly_adp_1+$data_amt_total_1[$i];
		}
	}
    //end adv_total calculation	
    
    //start cash_in_hand_total calculation
	for($i=41;$i<=51;$i++)
	{
		if(isset($data_amt_1[$i]) && $data_amt_total_1[$i] !='')
		{
			$weekly_cash_1=$weekly_cash_1+$data_amt_total_1[$i];
		}
	}
    //start cash_in_hand_total calculation
    	
	/////////////////Weekly Total/////////////////
    
    //First Date calulation end	
	
	//Second Date calulation start	
	$data_amt_2 = array();
	$amt_count_2=0;
	$account_2=0;
		$amt_sum_2=0;
		$amt_total_2=array();
		$AA=array();
		$BB=array();
		$dd_pt_id_ary=array();
		$AA_i=0;
	$amt_sum_total_2=0;
		$data_amt_total_2 = array();
		
	if((isset($records3_2) && count($records3_2)>0))
	{
		foreach($records3_2 as $row3_2)
		{
		 $data_amt_2[$amt_count_2]= $row3_2->weekly_amt;
		 $amt_count_2++;
		}
		
		foreach($records3_2 as $row5_2)
		{
		 $AA_A=$row5_2->weekly_prod_subgroup_code;
		 $dd_pt_id_ary[$AA_i]=$AA_A;
		 //$AA_A=substr($AA_A,0,1);
		   if(strlen($AA_A)==3)
		 {
		 $AA_A=substr($AA_A,0,1);
		 }
		 else if (strlen($AA_A)==4)
		   {
		  $AA_A=substr($AA_A,0,2);
		 }
		 $AA[$AA_i]=$AA_A;
		 $AA_i++;
		}
		
		$AA_A_i=0;
		$pt_id_A=array();
		foreach($records2 as $row8)
		{
		 $pt_id_A[$AA_A_i]=$row8->weekly_position_subgroup_code;
		 $AA_A_i++;
		}
		
		for($jj=0;$jj<$AA_A_i;$jj++)
		{
		  for($ii=0;$ii<$AA_i;$ii++)
		  {
		   if($pt_id_A[$jj]==$dd_pt_id_ary[$ii])
		   {
			$amt_sum_total_2=$amt_sum_total_2+$data_amt_2[$ii];
			$account_2++;
		   }
		 }
		  $data_amt_total_2[$jj]=$amt_sum_total_2;
		  $amt_sum_total_2=0;
		}
		$BB_i=0;
		foreach($records1 as $row5)
		{
		 $BB_B=$row5->weekly_position_group_code;
		 $BB[$BB_i++]=$BB_B;
		}
		
		for($jj=0;$jj<$BB_i;$jj++)
		{
		  for($ii=0;$ii<$AA_i;$ii++)
		  {
		   if($BB[$jj]==$AA[$ii])
		   {
			$amt_sum_2=$amt_sum_2+$data_amt_2[$ii];
			$account_2++;
		   }
		 }
		  $amt_total_2[$jj]=$amt_sum_2;
		  $amt_sum_2=0;
		}
	}
	
	
	/////////////////Weekly Total/////////////////
	$dep_total_ex_bp_2=0;
	$weekly_dep_2=0;
    $weekly_dep_fc_2=0;
	$weekly_adp_2=0;
	$weekly_cash_2=0;
    
    //start dep_total_ex_bp calculation
	for($i=0;$i<=18;$i++)
	{
		if(isset($data_amt_total_2[$i]) && $data_amt_total_2[$i]!='')
		{
			$dep_total_ex_bp_2=$dep_total_ex_bp_2+$data_amt_total_2[$i];
		}
	}
    //end dep_total_ex_bp calculation
    
	//start dep_total calculation
    for($i=19;$i<=21;$i++)
	{
		if(isset($data_amt_total_2[$i]) && $data_amt_total_2[$i] !='')
		{
			$weekly_dep_2=$weekly_dep_2+$data_amt_total_2[$i];
		}
	}
	$weekly_dep_2=$weekly_dep_2+$dep_total_ex_bp_2;
    //end dep_total calculation
    
	//start deposit_foreign_currency calculation
    for($i=14;$i<=16;$i++)
	{
		if(isset($data_amt_total_2[$i]) && $data_amt_total_2[$i] !='')
		{
			$weekly_dep_fc_2=$weekly_dep_fc_2+$data_amt_total_2[$i];
		}
	}
    
    //end deposit_foreign_currency calculation
    		
	//start adv_total calculation
    for($i=32;$i<=40;$i++)
	{
		if(isset($data_amt_total_2[$i]) && $data_amt_total_2[$i] !='')
		{
			$weekly_adp_2=$weekly_adp_2+$data_amt_total_2[$i];
		}
	}
    //end adv_total calculation	
    
    //start cash_in_hand_total calculation
	for($i=41;$i<=51;$i++)
	{
		if(isset($data_amt_2[$i]) && $data_amt_total_2[$i] !='')
		{
			$weekly_cash_2=$weekly_cash_2+$data_amt_total_2[$i];
		}
	}
    //start cash_in_hand_total calculation
    	
	/////////////////Weekly Total/////////////////
   // echo "";
   //print_r($data_amt_total_2);	
	//die();
    //Second Date calulation end	
	$count=1;
	$total_count=0;
	$co=0;
	foreach($records2 as $row1)
	{
		$total_count++;
	    echo "<tr>";
		echo "<td align='center'>".$count."</td>"; 
		$A=$row1->weekly_position_subgroup_code;
		echo "<input type='hidden' name='weekly_position_subgroup_code[]' size='15' value='$A'/>";
		echo "<td align='left'>".$row1->weekly_position_group_text."</td>";
		echo "<td align='left'>".$row1->weekly_position_subgroup_text."</td>";
		echo "<td align='left'>".$row1->weekly_position_subgroup_telg_code."</td>";
					
		
		if((isset($data_amt_total_1) && count($data_amt_total_1)>0)){
			echo '<td align="left">';
			echo number_format($data_amt_total_1[$co],2);
			echo '</td>';	
		}else
		{
			echo '<td align="center">';
			echo "-";
			echo '</td>';	
			
		}
		
		if((isset($data_amt_total_2) && count($data_amt_total_2)>0)){
			echo '<td align="left">';
			echo number_format($data_amt_total_2[$co],2);
			echo '</td>';	
		}else
		{
			echo '<td align="center">';
			echo "-";
			echo '</td>';	
		}
		if((isset($data_amt_total_1) && count($data_amt_total_1)>0)&&(isset($data_amt_total_2) && count($data_amt_total_2)>0)){
		
     		echo '<td align="left">';
			echo '<strong>'.number_format(($data_amt_total_2[$co] -$data_amt_total_1[$co]),2).'</strong>';
			echo '</td>';	
		}else {
		 echo '<td align="center">';
			echo "-";
			echo '</td>';	
		}
		
		$co++;
		$count++;
		echo "</tr>";
		
		if($count==20)
		{
			echo '<tr>';
			echo "<td colspan='4'>"."<strong>"."Total Deposits (Exclude B/P) [1-19]"."<strong>"."</td>";
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($dep_total_ex_bp_1,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			if((isset($data_amt_total_2) && count($data_amt_total_2)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($dep_total_ex_bp_2,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)&&(isset($data_amt_total_2) && count($data_amt_total_2)>0)){
				echo '<td align="left">';
				echo '<strong>'.number_format(($dep_total_ex_bp_2-$dep_total_ex_bp_1),2).'</strong>';
				echo '</td>';
			}else {
				 echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			echo '</tr>';
		}
		if($count==23)
		{
			echo '<tr>';
			echo "<td colspan='4'>"."<strong>"."Total Deposit (Including BP) [1-22]"."<strong>"."</td>";
			
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_dep_1,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			if((isset($data_amt_total_2) && count($data_amt_total_2)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_dep_2,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)&&(isset($data_amt_total_2) && count($data_amt_total_2)>0)){
				echo '<td align="left">';
				echo '<strong>'.number_format(($weekly_dep_2-$weekly_dep_1),2).'</strong>';
				echo '</td>';
			}else {
				 echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			echo '</tr>';
		}
		if($count==32)
		{
            echo '<tr>';
			echo "<td colspan='3'>"."<strong>"."Deposit in Foreign Currency (Excluding NFCD) [15-17]"."<strong>"."</td>";
            echo "<td><strong>YY</strong></td>";
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_dep_fc_1,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			if((isset($data_amt_total_2) && count($data_amt_total_2)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_dep_fc_2,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)&&(isset($data_amt_total_2) && count($data_amt_total_2)>0)){
				echo '<td align="left">';
				echo '<strong>'.number_format(($weekly_dep_fc_2-$weekly_dep_fc_1),2).'</strong>';
				echo '</td>';
			}else {
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			echo '</tr>';
		}
        
		if($count==42)
		{
			echo '<tr>';
			echo "<td colspan='2'>"."<strong>"."Total Advances in Bangladesh [33-41]"."<strong>"."</td>";
			echo "<td><strong>(iv) Total Advances</strong></td>";
			echo "<td><strong>CC</strong></td>";
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_adp_1,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			if((isset($data_amt_total_2) && count($data_amt_total_2)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_adp_2,2).'</strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
		
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)&&(isset($data_amt_total_2) && count($data_amt_total_2)>0)){
				echo '<td align="left">';
				echo '<strong>'.number_format(($weekly_adp_2-$weekly_adp_1),2).'</strong>';
				echo '</td>';
			}else {
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			echo '</tr>';
		}
		
		if($count==53)
		{
			echo '<tr>';
			echo "<td colspan='3'>"."<strong>"."Total Cash-in-Hand [42-52]"."<strong>"."</td>";
			echo "<td><strong>PP</strong></td>";
			
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_cash_1,2).'<strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
		
			if((isset($data_amt_total_2) && count($data_amt_total_2)>0)){
			echo '<td align="left">';
			echo '<strong>'.number_format($weekly_cash_2,2).'<strong>';
			echo '</td>';
			}else
			{
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
		
			if((isset($data_amt_total_1) && count($data_amt_total_1)>0)&&(isset($data_amt_total_2) && count($data_amt_total_2)>0)){
				echo '<td align="left">';
				echo '<strong>'.number_format(($weekly_cash_2-$weekly_cash_1),2).'<strong>';
				echo '</td>';
			}else {
				echo '<td align="center">';
				echo "-";
				echo '</td>';	
			}
			echo '</tr>';
		}
    }
	echo form_open('report/misd_0040_report_details/1');
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
        $attribute='style="background-color: #FF9900;"';
    	echo "<td align='center' COLSPAN='7'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";
    	
    	echo "</table>";
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

<p>&nbsp;</p>
</body>
</html>
