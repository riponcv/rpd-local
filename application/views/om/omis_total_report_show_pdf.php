<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>
<body>
<p>
  <?php
 
    	
		/*echo "<table align=\"center\">"; 
		 echo "<tr>";
		 echo "<th style='font-size:32px;'>";
		 echo "Janata Bank Limited";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:16px;'>";
		 echo "Summary Overview MIS Report";
		 echo "</th>";
		 echo "</tr>";
		 echo "</table>";
		 
	echo "</table>";
	echo "<table align=\"center\">"; 
	echo "<tr>";
	echo "<th align='right' style='font-size:12px;'>"."Branch Code:"."</th>";
	
	echo "<th align='left' style='font-size:12px;'>".$data_br."</th>";
	echo "<th style='font-size:12px;'>"."Branch Name:"."</th>";
	echo "<th style='font-size:12px;'>".$txt_office_name."</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th align='right' style='font-size:12px;'>"."Report of:"."</th>";
	echo "<th style='font-size:12px;'>".$date1."</th>";
	echo "<th align='right' style='font-size:12px;'>"."Date:"."</th>";
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
		 echo "Summary Overview MIS Report";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:11px;'>"."Report as on  ".$date1. "  "."Printed on  ".$month." ".$day.", ".$year."</th>";
		 echo "</tr>";
		 
		 echo "<tr>";
	     echo "<th style='font-size:11px;'>".$txt_office_name."Branch  ".$data_br."</th>";
	     echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:12px;'>";
		 echo "Janata Bank Limited";
		 echo "</th>";
		 echo "</tr>";
		 echo "</table>";
		 
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left'>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Amount "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."No.of A/C "."<strong>"."</td>";
	echo "</tr>";
	$data_ac = array();
	$data_amt = array();
	$ac_count=0;
	$amt_count=0;
	
	foreach($rec as $row3)
	{
	 $data_ac[$ac_count]= $row3->dd_ac;
	 $data_amt[$ac_count]= $row3->dd_amt;
	 $ac_count=$ac_count+1;
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
	$AA_i=0;
	foreach($rec as $row5)
	{
	 $AA_A=$row5->dd_pt_id;
	 //$AA_A=substr($AA_A,0,1);
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
	 $AA[$AA_i++]=$AA_A;
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

	 $i=0;
	 $count=1;
	 $z=1;
	 $last=0;
	 $total_count=0;
	 $jjj=0;
	 foreach($records1 as $row6)
	{

	echo "<tr>";
	echo "<td align='center'>".$z ."</td>";
	echo "<td>".$row6->om_id_des."</td>";
	echo "<td align='right'>"."<strong>".number_format($amt_total[$jjj],2)."<strong>"."</td>";
	echo "<td align='right'>"."<strong>".number_format($ac_total[$jjj])."<strong>"."</td>";
	echo "</tr>";
	$jjj++;
	$z++;
	}
	echo "</table>";
?>

</body>
</html>

