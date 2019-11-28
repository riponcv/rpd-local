<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
table {margin:0;padding:0;}
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
</head>
<body>
<p>
  <?php
   
   $br_count=0;
   foreach($records3 as $row3)
	{
	 $br_count=$br_count+1;
	}
	$prod_count=0;
	foreach($prod_type as $row_prod)
	{
	 $prod_count=$prod_count+1;
	}
	$BRANCH=($br_count/$prod_count);
	
	$br_total=0;
	foreach($br_name as $row_br)
	{
	 $br_total=$br_total+1;
	}
	//$prod_count=0;
	//echo "TOTAL BRANCH:".$BRANCH;
   
	     /*
		 echo "<table align=\"center\">"; 
		 echo "<tr>";
		 echo "<th style='font-size:32px;'>";
		 echo "Overview MIS Report";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:18px;'>";
		 echo "Consolidate of all Branch";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:14px;'>";
		 echo "Number of Reporting Branch:"."(".$BRANCH."/".$br_total.")";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:12px;'>";
		 echo "Janata Bank Limited";
		 echo "</th>";
		 echo "</tr>";
		 echo "</table>";
		$date11=substr($date1,0,11); 
	echo "<table align=\"center\" >"; 
	echo "<tr>";
	echo "<th align='right' style='font-size:12px;'>"."Report of:"."</th>";
	echo "<th style='font-size:12px;'>".$date11."</th>";
	echo "<th align='right' style='font-size:12px;'>"."    Printing Date:"."</th>";
	echo "<th align='left' style='font-size:12px;'>".$var_today."</th>";
	echo "</tr>";
	echo "</table>";
	*/
	
	
	$d = date_parse_from_format("YY-MM-dd", $var_today);
	$year= $d["year"];
	$month=substr($var_today,3,3);
	$day=substr($var_today,0,2);
	
         echo "<table align=\"center\">"; 
		 echo "<tr>";
		 echo "<th style='font-size:15px;'>";
		 echo "Overview MIS Report";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:11px;'>"."Report as on  ".$date1. "  "."Printed on  ".$month." ".$day.", ".$year."</th>";
		 echo "</tr>";
		 
		 echo "<tr>";
		 echo "<th style='font-size:11px;'>";
		 echo "Consolidated of all Branch";
		 echo "</th>";
		 echo "</tr>";
		 
		 echo "<tr>";
		 echo "<th style='font-size:11px;'>";
		 echo "Number of Reporting Branch ".count($allbr)."/".count($br_name);
		 echo "</th>";
		 echo "</tr>";
		 //echo "<tr>";
	     //echo "<th style='font-size:12px;'>".$var_br_name."Division Office  ".$data_br."</th>";
	     //echo "</tr>";
		echo "<tr>";
		echo "<th style='font-size:12px;'>";
		echo "Janata Bank Limited";
		echo "</th>";
		echo "</tr>";
		 echo "</table>";
		 
		 
	echo "<table  align=\"center\" id=\"t1\">"; 
	echo "<tr>";
	echo "<th style='font-size:12px;'>"."<strong>"."SL. No "."<strong>"."</th>";
	echo "<th align='left' width='150' style='font-size:12px;'>"."<strong>"."Product Category "."<strong>"."</th>";
	echo "<th align='left' style='font-size:12px;'>"."<strong>"."Product "."<strong>"."</th>";
	echo "<th align='center' style='font-size:12px;'>"."<strong>"."Amount "."<strong>"."</th>";
	echo "<th align='center' style='font-size:12px;'>"."<strong>"."No.of A/C "."<strong>"."</th>";
	echo "</tr>";
	$data_ac = array();
	$data_amt = array();
	$ac_count=0;
	$amt_count=0;
	foreach($records3 as $row3)
	{
	 $data_ac[$ac_count]= $row3->dd_ac;
	 $data_amt[$ac_count]= $row3->dd_amt;
	 $ac_count++;
	}
	/*
	$L=1;
	for($ii=0;$ii<$ac_count;$ii++)
	{
	 echo $L.".";
	 echo $data_ac[$ii]."\n";
	 echo "</br>";
	 $L++;
	}
	*/
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
	foreach($records3 as $row5)
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
	/*
	$L=1;
	for($ii=0;$ii<$AA_i;$ii++)
	{
	 echo $L.".";
	 echo $dd_pt_id_ary[$ii];
	 echo "</br>";
	 $L++;
	}
	*/
	/*
	$L=1;
	for($ii=0;$ii<$AA_i;$ii++)
	{
	 echo $L.".";
	 echo $AA[$ii]."\n";
	 echo "</br>";
	 $L++;
	}
	*/
	$AA_A_i=0;
	$pt_id_A=array();
	foreach($records2 as $row8)
	{
	 $pt_id_A[$AA_A_i]=$row8->pt_id;
	 $AA_A_i++;
	}
	/*
	$L=1;
	for($ii=0;$ii<$AA_A_i;$ii++)
	{
	 echo $L.".";
	 echo $pt_id_A[$ii];
	 echo "</br>";
	 $L++;
	}
	*/
	
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
	/*
	$L=1;
	for($ii=0;$ii<$jj;$ii++)
	{
	 echo $L.".";
	 echo $data_amt_total[$ii];
	 echo "</br>";
	 $L++;
	}
	*/
	
	$BB_i=0;
	foreach($records1 as $row5)
	{
	 $BB_B=$row5->om_id;
	 $BB[$BB_i++]=$BB_B;
	}
	/*
	$L=1;
	for($ii=0;$ii<$BB_i;$ii++)
	{
	 echo $L.".";
	 echo $BB[$ii]."\n";
	 echo "</br>";
	 $L++;
	}
	*/
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
	/*
	$L=1;
	for($ii=0;$ii<$jj;$ii++)
	{
	 echo $L.".";
	 echo $ac_total[$ii];
	 echo "</br>";
	 $L++;
	}
	*/
	 $jjj=0;
	 $i=0;
	 $count=1;
	 $z=1;
	 $last=0;
	 $total_count=0;
	foreach($records2 as $row1)
	{
	   $co=0;
	    while($z==$row1->pt_pg_id)
			{
			 if($last>0)
				{//number_format($data_ac_total[$i])
					echo "<tr>";
					echo "<td>"." "."</td>";
					echo "<td>"." "."</td>";
					echo "<td style='font-size:12px;'>"."<strong>"."Total "."<strong>"."</td>";
					echo "<td align='right' style='font-size:12px;'>"."<strong>".number_format($amt_total[$jjj],2)."<strong>"."</td>";
					echo "<td align='right' style='font-size:12px;'>"."<strong>".number_format($ac_total[$jjj])."<strong>"."</td>";
					echo "</tr>";
					$jjj++;
				 }
				$last++;
				$z++;
			}
            
            //jack
              if(!isset($data_amt[$i])){$data_amt[$i]=0;}
              if(!isset($data_ac[$i])){$data_ac[$i]=0;}
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
	echo "</tr>";
	echo "</table>";
	
?>
</body>
</html>
