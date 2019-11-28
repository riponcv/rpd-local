<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Real Estate Index
<style>
table {margin:0;padding:0;}
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
</title>
</head>
<body>
<p>
  
    <table  align="center">
    <tr align="center"><th>Real Estate Index Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_year)?$report_of_year:''; ?></th></tr>
    <?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
    <br /><br />
  <?php
    echo "<table align=\"center\" id=\"t1\">"; 
	echo "<tr>";
	echo "<td align='center'>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Group "."<strong>"."</td>";
	echo "<td align='center' width='200'>"."<strong>"."Subgroup "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Value"."<strong>"."</td>";
	echo "</tr>";
	$data_amt = array();
	$amt_count=0;
	foreach($records3 as $row3)
	{
	 $data_amt[$amt_count]= $row3->rei_data_amt;
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
	 $AA_A=$row5->rei_data_sg_code;
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
	 $pt_id_A[$AA_A_i]=$row8->rei_subgroup_code;
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
	 $BB_B=$row5->rei_group_code;
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
	
	 $sl=1;
     $jjj=0;
	 $i=0;
	 $count=1;
	 $z=0;
	 $last=0;
	 $total_count=0;
	foreach($records2 as $row1)
	{
	   $co=0;
	    while($BB[$z]==$row1->rei_group_code)
			{
			 if($last>0)
				{
					echo "<tr>";
					echo "<td align='left' colspan='3'>"."<strong>"."Total "."<strong>"."</td>";
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
			if($count>0 && $count<25)
              {
                  if($count%4==1)
                  {
                    echo "<td style='font-size:15px;' rowspan='4' align='center'>".$sl."</td>";
                    $sl++;
                  }
              }
              if($count>24 && $count<35)
              {
                  if($count%2==1)
                  {
                    echo "<td style='font-size:15px;' rowspan='2' align='center'>".$sl."</td>";
                    $sl++;
                  }
              }
			$A=$row1->rei_subgroup_code;
			echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
            if($count>0 && $count<25)
              {
                  if($count%4==1)
                  {
                    echo "<td style='font-size:15px;' align='left' rowspan='4'>".$row1->rei_group_text."</td>";
                  }
              }
              if($count>24 && $count<35)
              {
                  if($count%2==1)
                  {
                    echo "<td style='font-size:15px;' align='left' rowspan='2'>".$row1->rei_group_text."</td>";
                  }
              }
			echo "<td style='font-size:15px;' align='left'>".$row1->rei_subgroup_text."</td>";
			echo '<td align="right" style="font-size:15px;">'.number_format($data_amt_total[$i],2).'</td>';
			$co++;
		    $count++;
			$i++;
	        echo "</tr>";
    }
	echo "<tr>";
	echo "<td style='font-size:15px;' colspan='3'>"."<strong>"."Total "."<strong>"."</td>";
	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($amt_total[$jjj],2)."<strong>"."</td>";
	echo "</tr>";
	echo "</table>";
?>
</p>


</html>
