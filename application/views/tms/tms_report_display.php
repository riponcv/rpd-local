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
    <tr align="center"><th>Target Monitoring System Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_year)?$report_of_year:''; ?></th></tr>
    <?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
    <?php
    
    echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td  align='left' width='300'>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td align='left'>"."<strong>"."Product "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Amount in Taka "."<strong>"."</td>";
	echo "</tr>";
	$data_amt = array();
	$amt_count=0;
	foreach($records3 as $row3)
	{
	 $data_amt[$amt_count]= $row3->tms_data_amt;
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
	 $AA_A=$row5->tms_data_sg_code;
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
	 $pt_id_A[$AA_A_i]=$row8->tms_subgroup_code;
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
	 $BB_B=$row5->tms_group_code;
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
	
	 $jjj=0;
	 $i=0;
	 $count=1;
	 $z=0;
	 $last=0;
	 $total_count=0;
	foreach($records2 as $row1)
	{
	   $co=0;
	    while($BB[$z]==$row1->tms_group_code)
			{
			 if($last>0)
				{
					echo "<tr>";
					echo "<td>"." "."</td>";
					echo "<td>"." "."</td>";
					echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
					echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($amt_total[$jjj],2)."<strong>"."</td>";
					echo "</tr>";
					$jjj++;
				 }
				$last++;
				$z=$z+1;
				if(!isset($BB[$z])){$BB[$z]=0;}
			}
            //jack
              if(!isset($data_amt[$i])){$data_amt[$i]=0;}
              //jack
              
			$total_count++;	   
			echo "<tr>";
			echo "<td style='font-size:15px;'>".$count."</td>"; 
			$A=$row1->tms_subgroup_code;
			echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
			echo "<td style='font-size:15px;' align='left'>".$row1->tms_group_text."</td>";
			echo "<td style='font-size:15px;' align='left'>".$row1->tms_subgroup_text."</td>";
			echo '<td align="right" style="font-size:15px;">'.number_format($data_amt_total[$i],2).'</td>';
			$co++;
		    $count++;
			$i++;
	        echo "</tr>";
    }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td style='font-size:15px;' align='left'>"."<strong>"."Total "."<strong>"."</td>";
	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($amt_total[$jjj],2)."<strong>"."</td>";
	echo "</tr>";
    echo form_open('tms/tms_report_details/1');
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