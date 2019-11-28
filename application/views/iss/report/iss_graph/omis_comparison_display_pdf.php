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
  
    <table  align="center">
    <tr align="center"><th>OMIS Comparison</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center">
    <th>
    OMIS Comparison of: 
    <?php 
    echo isset($report_of_date1)?$report_of_date1:''; 
    echo isset($report_of_date2)?' - '.$report_of_date2:''; 
    echo isset($report_of_date3)?' - '.$report_of_date3:''; 
    ?>
    </th>
    </tr>
    <?php if(isset($completed_vs_total_date1['total'])){ ?><tr align="center"><th>Reporting on (<?php echo isset($report_of_date1)?$report_of_date1:''; ?>): <?php echo isset($completed_vs_total_date1['completed'])?$completed_vs_total_date1['completed']:'0'; echo '/'; echo isset($completed_vs_total_date1['total'])?$completed_vs_total_date1['total']:'0'; ?></th></tr><?php } ?>
    <?php if(isset($completed_vs_total_date2['total'])){ ?><tr align="center"><th>Reporting on (<?php echo isset($report_of_date2)?$report_of_date2:''; ?>): <?php echo isset($completed_vs_total_date2['completed'])?$completed_vs_total_date2['completed']:'0'; echo '/'; echo isset($completed_vs_total_date2['total'])?$completed_vs_total_date2['total']:'0'; ?></th></tr><?php } ?>
    <?php if(isset($completed_vs_total_date3['total'])){ ?><tr align="center"><th>Reporting on (<?php echo isset($report_of_date3)?$report_of_date3:''; ?>): <?php echo isset($completed_vs_total_date3['completed'])?$completed_vs_total_date3['completed']:'0'; echo '/'; echo isset($completed_vs_total_date3['total'])?$completed_vs_total_date3['total']:'0'; ?></th></tr><?php } ?>
    </table>
  <?php
    echo "<table align=\"center\" id=\"t1\">"; 
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td  align='left'>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td align='left'>"."<strong>"."Product "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Amount (".$report_of_date1.")"."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."No.of A/C (".$report_of_date1.")"."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Amount (".$report_of_date2.")"."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."No.of A/C (".$report_of_date2.")"."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Difference (Amount)"."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Difference (A/C)"."<strong>"."</td>";
	if((isset($records3_date3) && count($records3_date3)>0))
    {
     	echo "<td align='center'>"."<strong>"."Amount (".$report_of_date3.")"."<strong>"."</td>";
    	echo "<td align='center'>"."<strong>"."No.of A/C (".$report_of_date3.")"."<strong>"."</td>";
    	echo "<td align='center'>"."<strong>"."Difference (Amount)"."<strong>"."</td>";
    	echo "<td align='center'>"."<strong>"."Difference (A/C)"."<strong>"."</td>";   
    }
    echo "</tr>";
    ///date1 data Calculation Start
	$data_ac = array();
	$data_amt = array();
	$ac_count=0;
	$amt_count=0;
	foreach($records3_date1 as $row3)
	{
	 $data_ac[$ac_count]= $row3->dd_ac;
	 $data_amt[$ac_count]= $row3->dd_amt;
	 $ac_count++;
	}
	$account=0;
	$ac_sum=0;
	$amt_sum=0;
	$ac_i=1;
	$ac_amt=0;
	$ac_total=array();
	$amt_total=array();
	$AA=array();
	$BB=array();
	$dd_pt_id_ary=array();
	$AA_i=0;
	foreach($records3_date1 as $row5)
	{
	 $AA_A=$row5->dd_pt_id;
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
	 $pt_id_A[$AA_A_i]=$row8->pt_id;
	 $AA_A_i++;
	}
	
	
	$ac_sum_total=0;
	$amt_sum_total=0;
	
	$data_ac_total = array();
	$data_amt_total = array();
	
	for($jj=0;$jj<$AA_A_i;$jj++)
	{
	  for($ii=0;$ii<$AA_i;$ii++)
	  {
	   if($pt_id_A[$jj]==$dd_pt_id_ary[$ii])
	   {
	    $ac_sum_total=$ac_sum_total+$data_ac[$ii];
		$amt_sum_total=$amt_sum_total+$data_amt[$ii];
		$account++;
	   }
	 }
	  $data_ac_total[$jj]=$ac_sum_total;
	  $data_amt_total[$jj]=$amt_sum_total;
	  $ac_sum_total=0;
	  $amt_sum_total=0;
	}
	
	
	$BB_i=0;
	foreach($records1 as $row5)
	{
	 $BB_B=$row5->om_id;
	 $BB[$BB_i++]=$BB_B;
	}
	
	for($jj=0;$jj<$BB_i;$jj++)
	{
	  for($ii=0;$ii<$AA_i;$ii++)
	  {
	   if($BB[$jj]==$AA[$ii])
	   {
	    $ac_sum=$ac_sum+$data_ac[$ii];
		$amt_sum=$amt_sum+$data_amt[$ii];
		$account++;
	   }
	 }
	  $ac_total[$jj]=$ac_sum;
	  $amt_total[$jj]=$amt_sum;
	  $ac_sum=0;
	  $amt_sum=0;
	}
    
    ///date1 data Calculation End
    
    
    
    ///date2 data Calculation Start
	$data_ac2 = array();
	$data_amt2 = array();
	$ac_count2=0;
	$amt_count2=0;
	foreach($records3_date2 as $row3)
	{
	 $data_ac2[$ac_count2]= $row3->dd_ac;
	 $data_amt2[$ac_count2]= $row3->dd_amt;
	 $ac_count2++;
	}
	$account2=0;
	$ac_sum2=0;
	$amt_sum2=0;
	$ac_i2=1;
	$ac_amt2=0;
	$ac_total2=array();
	$amt_total2=array();
	$AA2=array();
	$BB2=array();
	$dd_pt_id_ary2=array();
	$AA_i2=0;
	foreach($records3_date2 as $row5)
	{
	 $AA_A2=$row5->dd_pt_id;
	 $dd_pt_id_ary2[$AA_i2]=$AA_A2;
	 //$AA_A=substr($AA_A,0,1);
       if(strlen($AA_A2)==3)
	 {
	 $AA_A2=substr($AA_A2,0,1);
	 }
	 else if (strlen($AA_A2)==4)
       {
	  $AA_A2=substr($AA_A2,0,2);
	 }
	 $AA2[$AA_i2]=$AA_A2;
	 $AA_i2++;
	}
	
	$AA_A_i2=0;
	$pt_id_A2=array();
	foreach($records2 as $row8)
	{
	 $pt_id_A2[$AA_A_i2]=$row8->pt_id;
	 $AA_A_i2++;
	}
	
	
	$ac_sum_total2=0;
	$amt_sum_total2=0;
	
	$data_ac_total2 = array();
	$data_amt_total2 = array();
	
	for($jj=0;$jj<$AA_A_i2;$jj++)
	{
	  for($ii=0;$ii<$AA_i2;$ii++)
	  {
	   if($pt_id_A2[$jj]==$dd_pt_id_ary2[$ii])
	   {
	    $ac_sum_total2=$ac_sum_total2+$data_ac2[$ii];
		$amt_sum_total2=$amt_sum_total2+$data_amt2[$ii];
		$account2++;
	   }
	 }
	  $data_ac_total2[$jj]=$ac_sum_total2;
	  $data_amt_total2[$jj]=$amt_sum_total2;
	  $ac_sum_total2=0;
	  $amt_sum_total2=0;
	}
	
	
	$BB_i2=0;
	foreach($records1 as $row5)
	{
	 $BB_B2=$row5->om_id;
	 $BB2[$BB_i2++]=$BB_B2;
	}
	
	for($jj=0;$jj<$BB_i2;$jj++)
	{
	  for($ii=0;$ii<$AA_i2;$ii++)
	  {
	   if($BB2[$jj]==$AA2[$ii])
	   {
	    $ac_sum2=$ac_sum2+$data_ac2[$ii];
		$amt_sum2=$amt_sum2+$data_amt2[$ii];
		$account++;
	   }
	 }
	  $ac_total2[$jj]=$ac_sum2;
	  $amt_total2[$jj]=$amt_sum2;
	  $ac_sum2=0;
	  $amt_sum2=0;
	}
    
    ///date2 data Calculation end
    
    ///date3 data Calculation Start
    if((isset($records3_date3) && count($records3_date3)>0))
    {
            
    	$data_ac3 = array();
    	$data_amt3 = array();
    	$ac_count3=0;
    	$amt_count3=0;
    	foreach($records3_date3 as $row3)
    	{
    	 $data_ac3[$ac_count3]= $row3->dd_ac;
    	 $data_amt3[$ac_count3]= $row3->dd_amt;
    	 $ac_count3++;
    	}
    	$account3=0;
    	$ac_sum3=0;
    	$amt_sum3=0;
    	$ac_i3=1;
    	$ac_amt3=0;
    	$ac_total3=array();
    	$amt_total3=array();
    	$AA3=array();
    	$BB3=array();
    	$dd_pt_id_ary3=array();
    	$AA_i3=0;
    	foreach($records3_date3 as $row5)
    	{
    	 $AA_A3=$row5->dd_pt_id;
    	 $dd_pt_id_ary3[$AA_i3]=$AA_A3;
    	 //$AA_A=substr($AA_A,0,1);
           if(strlen($AA_A3)==3)
    	 {
    	 $AA_A3=substr($AA_A3,0,1);
    	 }
    	 else if (strlen($AA_A3)==4)
           {
    	  $AA_A3=substr($AA_A3,0,2);
    	 }
    	 $AA3[$AA_i3]=$AA_A3;
    	 $AA_i3++;
    	}
    	
    	$AA_A_i3=0;
    	$pt_id_A3=array();
    	foreach($records2 as $row8)
    	{
    	 $pt_id_A3[$AA_A_i3]=$row8->pt_id;
    	 $AA_A_i3++;
    	}
    	
    	
    	$ac_sum_total3=0;
    	$amt_sum_total3=0;
    	
    	$data_ac_total3 = array();
    	$data_amt_total3 = array();
    	
    	for($jj=0;$jj<$AA_A_i3;$jj++)
    	{
    	  for($ii=0;$ii<$AA_i3;$ii++)
    	  {
    	   if($pt_id_A3[$jj]==$dd_pt_id_ary3[$ii])
    	   {
    	    $ac_sum_total3=$ac_sum_total3+$data_ac3[$ii];
    		$amt_sum_total3=$amt_sum_total3+$data_amt3[$ii];
    		$account3++;
    	   }
    	 }
    	  $data_ac_total3[$jj]=$ac_sum_total3;
    	  $data_amt_total3[$jj]=$amt_sum_total3;
    	  $ac_sum_total3=0;
    	  $amt_sum_total3=0;
    	}
    	
    	
    	$BB_i3=0;
    	foreach($records1 as $row5)
    	{
    	 $BB_B3=$row5->om_id;
    	 $BB3[$BB_i3++]=$BB_B3;
    	}
    	
    	for($jj=0;$jj<$BB_i3;$jj++)
    	{
    	  for($ii=0;$ii<$AA_i3;$ii++)
    	  {
    	   if($BB3[$jj]==$AA3[$ii])
    	   {
    	    $ac_sum3=$ac_sum3+$data_ac3[$ii];
    		$amt_sum3=$amt_sum3+$data_amt3[$ii];
    		$account++;
    	   }
    	 }
    	  $ac_total3[$jj]=$ac_sum3;
    	  $amt_total3[$jj]=$amt_sum3;
    	  $ac_sum3=0;
    	  $amt_sum3=0;
    	}
    
    }
    ///date3 data Calculation end
    
	
	 $jjj=0;
	 $i=0;
	 $count=1;
	 $z=0;
	 $last=0;
	 $total_count=0;
	foreach($records2 as $row1)
	{
	   $co=0;
	    while($BB[$z]==$row1->pt_pg_id)
			{
			 if($last>0)
				{
					echo "<tr>";
					echo "<td>"." "."</td>";
					echo "<td>"." "."</td>";
					echo "<td style='font-size:12px;'>"."<strong>"."Total "."<strong>"."</td>";
					echo "<td align='right' style='font-size:12px;'>"."<strong>".number_format($amt_total[$jjj],2)."<strong>"."</td>";
					echo "<td align='right' style='font-size:12px;'>"."<strong>".number_format($ac_total[$jjj])."<strong>"."</td>";
                    
                    //new added
                    echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($amt_total2[$jjj],2)."<strong>"."</td>";
					echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($ac_total2[$jjj])."<strong>"."</td>";
                    
                    echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($amt_total2[$jjj]-$amt_total[$jjj]),2)."<strong>"."</td>";
					echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($ac_total2[$jjj]-$ac_total[$jjj]))."<strong>"."</td>";
                    
                    if((isset($records3_date3) && count($records3_date3)>0))
                    {
                    echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($amt_total3[$jjj],2)."<strong>"."</td>";
					echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($ac_total3[$jjj])."<strong>"."</td>";
                    
                    echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($amt_total3[$jjj]-$amt_total2[$jjj]),2)."<strong>"."</td>";
					echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($ac_total3[$jjj]-$ac_total2[$jjj]))."<strong>"."</td>";  
                    }
                    
					echo "</tr>";
					$jjj++;
				 }
				$last++;
				$z=$z+1;
				if(!isset($BB[$z])){$BB[$z]=0;}
			}
            
            //jack
              if(!isset($data_amt[$i])){$data_amt[$i]=0;}
              if(!isset($data_ac[$i])){$data_ac[$i]=0;}
              
              //new added
              if(!isset($data_amt2[$i])){$data_amt2[$i]=0;}
              if(!isset($data_ac2[$i])){$data_ac2[$i]=0;}
              
              if((isset($records3_date3) && count($records3_date3)>0))
              {
                if(!isset($data_amt3[$i])){$data_amt3[$i]=0;}
                if(!isset($data_ac3[$i])){$data_ac3[$i]=0;}
              }
              
              //jack
              
			$total_count++;	   
			echo "<tr>";
			echo "<td align='center' style='font-size:12px;'>".$count."</td>"; 
			$A=$row1->pt_id;
			echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
			echo "<td style='font-size:12px;'>".$row1->om_id_des."</td>";
			echo "<td style='font-size:12px;'>".$row1->pt_short_name."</td>";
			echo '<td align="right" style="font-size:12px;">'.number_format($data_amt_total[$i],2).'</td>';
			echo '<td align="right" style="font-size:12px;">'.number_format($data_ac_total[$i]).'</td>';
            
            //new added
			echo '<td align="right" style="font-size:15px;">'.number_format($data_amt_total2[$i],2).'</td>';
			echo '<td align="right" style="font-size:15px;">'.number_format($data_ac_total2[$i]).'</td>';
            
			echo '<td align="right" style="font-size:15px;">'.number_format(($data_amt_total2[$i]-$data_amt_total[$i]),2).'</td>';
			echo '<td align="right" style="font-size:15px;">'.number_format(($data_ac_total2[$i]-$data_ac_total[$i])).'</td>';
            
            if((isset($records3_date3) && count($records3_date3)>0))
            {
                echo '<td align="right" style="font-size:15px;">'.number_format($data_amt_total3[$i],2).'</td>';
    			echo '<td align="right" style="font-size:15px;">'.number_format($data_ac_total3[$i]).'</td>';
                
    			echo '<td align="right" style="font-size:15px;">'.number_format(($data_amt_total3[$i]-$data_amt_total2[$i]),2).'</td>';
    			echo '<td align="right" style="font-size:15px;">'.number_format(($data_ac_total3[$i]-$data_ac_total2[$i])).'</td>';  
            }
            
			$co++;
		    $count++;
			$i++;
	        echo "</tr>";
    }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td style='font-size:12px;'>"."<strong>"."Total "."<strong>"."</td>";
	echo "<td align='right' style='font-size:12px;'>"."<strong>".number_format($amt_total[$jjj],2)."<strong>"."</td>";
	echo "<td align='right' style='font-size:12px;'>"."<strong>".number_format($ac_total[$jjj])."<strong>"."</td>";
    
    //new added
   	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($amt_total2[$jjj],2)."<strong>"."</td>";
	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($ac_total2[$jjj])."<strong>"."</td>";
    
   	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($amt_total2[$jjj]-$amt_total[$jjj]),2)."<strong>"."</td>";
	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($ac_total2[$jjj]-$ac_total[$jjj]))."<strong>"."</td>";
 
    if((isset($records3_date3) && count($records3_date3)>0))
    {
   	    echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($amt_total3[$jjj],2)."<strong>"."</td>";
    	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format($ac_total3[$jjj])."<strong>"."</td>";
        
       	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($amt_total3[$jjj]-$amt_total2[$jjj]),2)."<strong>"."</td>";
    	echo "<td align='right' style='font-size:15px;'>"."<strong>".number_format(($ac_total3[$jjj]-$ac_total2[$jjj]))."<strong>"."</td>";   
    }
    
    
	echo "</tr>";
	echo "</table>";
?>
</p>


</html>
