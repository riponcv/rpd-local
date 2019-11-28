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
  
   if(isset($records3) && count($records3)>0)
   {
	?>
    <table  align="center">
    <tr align="center"><th>Weekly Position Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date)?$report_of_date:''; ?></th></tr>
    <?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
    <?php
    
    echo "<table border=\"1\" align=\"center\">";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' width='300'>"."<strong>"."HEADS OF ACCOUNTS "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Accounts "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Telg. Code "."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "</tr>";
	$data_amt = array();
	$amt_count=0;
	foreach($records3 as $row3)
	{
	 $data_amt[$amt_count]= $row3->weekly_amt;
	 $amt_count++;
	}
	$account=0;
	$amt_sum=0;
	$amt_total=array();
	$AA=array();
	$BB=array();
	$dd_pt_id_ary=array();
	$AA_i=0;
	foreach($records3 as $row5)
	{
	 $AA_A=$row5->weekly_prod_subgroup_code;
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
	
	
	$amt_sum_total=0;
	
	$data_amt_total = array();
	
	for($jj=0;$jj<$AA_A_i;$jj++)
	{
	  for($ii=0;$ii<$AA_i;$ii++)
	  {
	   if($pt_id_A[$jj]==$dd_pt_id_ary[$ii])
	   {
		$amt_sum_total=$amt_sum_total+$data_amt[$ii];
		$account++;
	   }
	 }
	  $data_amt_total[$jj]=$amt_sum_total;
	  $amt_sum_total=0;
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
		$amt_sum=$amt_sum+$data_amt[$ii];
		$account++;
	   }
	 }
	  $amt_total[$jj]=$amt_sum;
	  $amt_sum=0;
	}
	
	/////////////////Weekly Total/////////////////
	$dep_total_ex_bp=0;
	$weekly_dep=0;
    $weekly_dep_fc=0;
	$weekly_adp=0;
	$weekly_cash=0;
    
    //start dep_total_ex_bp calculation
	for($i=0;$i<=18;$i++)
	{
		if(isset($data_amt_total[$i]) && $data_amt_total[$i]!='')
		{
			$dep_total_ex_bp=$dep_total_ex_bp+$data_amt_total[$i];
		}
	}
    //end dep_total_ex_bp calculation
    
	//start dep_total calculation
    for($i=19;$i<=21;$i++)
	{
		if(isset($data_amt_total[$i]) && $data_amt_total[$i] !='')
		{
			$weekly_dep=$weekly_dep+$data_amt_total[$i];
		}
	}
	$weekly_dep=$weekly_dep+$dep_total_ex_bp;
    //end dep_total calculation
    
	//start deposit_foreign_currency calculation
    for($i=14;$i<=16;$i++)
	{
		if(isset($data_amt_total[$i]) && $data_amt_total[$i] !='')
		{
			$weekly_dep_fc=$weekly_dep_fc+$data_amt_total[$i];
		}
	}
    
    //end deposit_foreign_currency calculation
    		
	//start adv_total calculation
    for($i=32;$i<=40;$i++)
	{
		if(isset($data_amt_total[$i]) && $data_amt_total[$i] !='')
		{
			$weekly_adp=$weekly_adp+$data_amt_total[$i];
		}
	}
    //end adv_total calculation	
    
    //start cash_in_hand_total calculation
	for($i=41;$i<=51;$i++)
	{
		if(isset($data_amt[$i]) && $data_amt_total[$i] !='')
		{
			$weekly_cash=$weekly_cash+$data_amt_total[$i];
		}
	}
    //start cash_in_hand_total calculation
    	
	/////////////////Weekly Total/////////////////
    
    
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
		echo "<td align='left'>".$row1->weekly_position_subgroup_telg_."</td>";
					
		$set_value=0;
		if(isset($data_amt_total[$co]) && $data_amt_total[$co] !='')
		{
			$set_value=$data_amt_total[$co];
		}
		
		echo '<td>'.number_format($set_value,2).'</td>';
		$co++;
		$count++;
		echo "</tr>";
		
		if($count==20)
		{
			echo "<td colspan='4'>"."<strong>"."Total Deposits (Exclude B/P) [1-19]"."<strong>"."</td>";
			echo '<td>'.'<strong>'.number_format($dep_total_ex_bp,2).'<strong>'.'</td>';
		}
		if($count==23)
		{
			echo "<td colspan='4'>"."<strong>"."Total Deposit (Including BP) [1-22]"."<strong>"."</td>";
			echo '<td>'.'<strong>'.number_format($weekly_dep,2).'<strong>'.'</td>';
			
			echo "<tr>";
			echo "<td colspan='4'>"."<strong>"."OMIS Total Deposit (Including BP)"."<strong>"."</td>";
			$set_value=0;
			if(isset($omis_value['deposit'])&&($omis_value['deposit'])!='')
			{
				$set_value=$omis_value['deposit'];
			}
			echo '<td>'.'<strong>'.number_format($set_value,2).'<strong>'.'</td>';
			echo "</tr>";
		}
		if($count==32)
		{
            echo "<td colspan='3'>"."<strong>"."Deposit in Foreign Currency (Excluding NFCD) [15-17]"."<strong>"."</td>";
            echo "<td><strong>YY</strong></td>";
			echo '<td>'.'<strong>'.number_format($weekly_dep_fc,2).'<strong>'.'</td>';
		}
        
		if($count==42)
		{
			echo "<td colspan='2'>"."<strong>"."Total Advances in Bangladesh [33-41]"."<strong>"."</td>";
			echo "<td><strong>(iv) Total Advances</strong></td>";
			echo "<td><strong>CC</strong></td>";
			echo '<td>'.'<strong>'.number_format($weekly_adp,2).'<strong>'.'</td>';
			$set_value=0;
			if(isset($omis_value['advance'])&&($omis_value['advance'])!='')
			{
				$set_value=$omis_value['advance'];
			}
			echo "<tr>";
			echo "<td colspan='4'>"."<strong>"."OMIS Total Advance"."<strong>"."</td>";
			echo '<td>'.'<strong>'.number_format($set_value,2).'<strong>'.'</td>';
			echo "</tr>";
		}
		
		if($count==53)
		{
			echo "<td colspan='3'>"."<strong>"."Total Cash-in-Hand [42-52]"."<strong>"."</td>";
			echo "<td><strong>PP</strong></td>";
			echo '<td>'.'<strong>'.number_format($weekly_cash,2).'<strong>'.'</td>';
			$set_value=0;
			if(isset($omis_value['cashin_hand'])&&($omis_value['cashin_hand'])!='')
			{
				$set_value=$omis_value['cashin_hand'];
			}
			echo "<tr>";
			echo "<td colspan='4'>"."<strong>"."OMIS Cash in Hand"."<strong>"."</td>";
			echo '<td>'.'<strong>'.number_format($set_value,2).'<strong>'.'</td>';
			echo "</tr>";
		}
    }
	echo form_open('weekly_position/weekly_report_details/1');
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
    	echo "<td align='center' COLSPAN='4'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
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
