<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>

<body>
<p>
  <?php
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Office Name:";
	echo "<td>";
	echo "<td>".$txt_office_name."<td>";
	echo "</tr>";
	echo "</table>";
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";

	echo "<td>"."<strong>"."Ser. No "."<strong>"."</td>";
	echo "<td>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td>"."<strong>"."Product "."<strong>"."</td>";
	echo "<td>"."<strong>"."Amount "."<strong>"."</td>";
	echo "<td>"."<strong>"."No.of A/C "."<strong>"."</td>";
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
	foreach($records3 as $row5)
	{
	 $AA_A=$row5->dd_pt_id;
	 $AA_A=substr($AA_A,0,1);
	 $AA[$AA_i++]=$AA_A;
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
	    $ac_sum=$ac_sum+$data_ac[$account];
		$amt_sum=$amt_sum+$data_amt[$account];
		$account++;
	   }
	  }
	 
	  $ac_total[$jj]=$ac_sum;
	  $amt_total[$jj]=$amt_sum;
	   $ac_sum=0;
	   $amt_sum=0;
	}
	
	/*
	for($jj=0;$jj<7;$jj++)
	{
	  echo $ac_total[$jj];
	  echo "</br>";
	  echo $amt_total[$jj];
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
				{
					echo "<tr>";
					echo "<td>"." "."</td>";
	     			echo "<td>"." "."</td>";
					echo "<td>"."<strong>"."Total "."<strong>"."</td>";
					echo "<td>"."<strong>".$amt_total[$jjj]."<strong>"."</td>";
					echo "<td>"."<strong>".$amt_total[$jjj]."<strong>"."</td>";
					echo "</tr>";
					$jjj++;
				 }
				$last++;
				$z++;
			}
			 $total_count++;	   
			  echo "<tr>";
			  echo "<td>".$count."</td>"; 
			  $A=$row1->pt_id;
			  echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
			  echo "<td>".$row1->om_id_des."</td>";
			  echo "<td>".$row1->pt_short_name."</td>";
			  echo '<td>'.$data_amt[$i].'</td>';
			  echo '<td>'.$data_ac[$i].'</td>';
			 
			$co++;
		    $count++;
			$i++;
		   echo "</tr>";
	 }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>"."<strong>"."Total "."<strong>"."</td>";
	echo "<td>"."<strong>".$amt_total[$jjj]."<strong>"."</td>";
	echo "<td>"."<strong>".$amt_total[$jjj]."<strong>"."</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>". $link_download."</td>";
	echo "</tr>";
			
	echo "</table>";
	
?>
</p>
<p>&nbsp;</p>
</body>
</html>
