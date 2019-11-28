<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>
<body>
<p>
  <?php
  echo form_open('rpd/dms_div_report_all/true');
  $date_yr=$date1yr;
  echo "<input type='hidden' name='date_year' size='15' value='$date_yr'/>";
  $date_mon=$date1mon;
  echo "<input type='hidden' name='date_mon' size='15' value='$date_mon'/>";
  $var_br=$data_br;
  echo "<input type='hidden' name='div_for_report' size='15' value='$var_br'/>";
  
	$d = date_parse_from_format("YY-MM-dd", $var_today);
	$year= $d["year"];
	$month=substr($var_today,3,3);
	$day=substr($var_today,0,2);
	
	
	
	
	
	$branch=array();
	$p=0;
	foreach($dms_branch as $rr)
	{
	  $branch[$p++]=$rr->dp_jo_code;
	  
	}
	
	
         echo "<table align=\"center\">"; 
		 echo "<tr>";
		 echo "<th align='center' style='font-size:18px;'>";
		 echo "CDMS Report";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:14px;' align='center'>"."Report as on Year ".$date1yr." Month  ".$date1mon."</th>";
		 //echo "<th width='10'>"; echo "</th>";
		 echo "</tr>";
		 //echo "<tr>";
		 //echo "<th style='font-size:14px;' >"."Printed on  ".$month." ".$day.", ".$year."</th>";
		// echo "</tr>";
		 
		 echo "<tr>";
	     echo "<th align='center' style='font-size:12px;'>";
		 echo "Khulna Division  ".$data_br;;
		 echo "</th>";
	     echo "</tr>";
		 
		 echo "<tr>";
	     echo "<th align='center' style='font-size:12px;'>";
		 echo "Number of Reporting Branch  ".$p;
		 echo "</th>";
		
		 
	     echo "</tr>";
		 
		 //echo "<tr>";
		 //echo "<th style='font-size:12px;'>";
		 //echo "Janata Bank Limited";
		 //echo "</th>";
		 //echo "</tr>";
		 echo "</table>";
		 
	
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Area Name "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Branch Name "."<strong>"."</td>";
	//echo "<td align='left' width='150'>"."<strong>"."A/C Type "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Target No.of A/C "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Target Amount in Taka"."<strong>"."</td>";
	
	echo "<td align='center'>"."<strong>"."Achieve No.of A/C "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Achieve Amount in Taka"."<strong>"."</td>";
	
	echo "<td align='center'>"."<strong>"."% of No.of A/C "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."% of Amount in Taka"."<strong>"."</td>";

	echo "</tr>";
	
	$branch=array();
	$p=0;
	foreach($dms_branch as $rr)
	{
	  $branch[$p++]=$rr->dp_jo_code;
	  
	}
	
   $list=array();
   $br_tag=array();
   $ii=0;
   foreach($records_emp_list as $row_list)
   {
     
	  $list[$ii]=$row_list->el_no_emp;
	  $br_tag[$ii]=$row_list->el_off_id;
	  $ii++;
   }
   for($j=0;$j<$ii;$j++)
   {
   // echo $br_tag[$j];
	//echo $list[$j];
	//echo "</br>";
   }
 
   $tar_ac=array();
   $tar_amt=array();
   $ac_n=0;
   foreach($records_target as $row_tar)
   {
     $tar_ac[$ac_n]=$row_tar->Dsg_Target_ac;
	 $tar_amt[$ac_n]=$row_tar->Dsg_Target_Amt;
	 $ac_n++;
	  //echo $row_tar->Dsg_Target_ac;
	  //echo "</br>";
   }
   
  $tar_ac_total=array();
  $tar_ac_n=0;
  $tar_amt_total=array();
  $tar_amt_n=0;
  $u=0;
  $uu=0;
  for($kk=0;$kk<$p;$kk++)
  {
   for($kkk=0;$kkk<$ii;$kkk++)
   {
   //echo $branch[$kk];
   //echo $br_tag[$kkk];
   //echo "</br>";
    if($branch[$kk]==$br_tag[$kkk])
	{
	 //echo $list[$u];
	// echo $tar_ac[$uu];
	// echo "</br>";
	 $tar_ac_n=$tar_ac_n+$tar_ac[$uu]*$list[$u];
	 $tar_amt_n=$tar_ac_n+$tar_amt[$uu]*$list[$u];
	  $u++;
	  $uu++;
	}
   }
   $tar_ac_total[$kk]=$tar_ac_n;
   $tar_amt_total[$kk]=$tar_amt_n;
   $tar_ac_n=0;
   $tar_amt_n=0;
   $uu=0;
  }
  
  
  for($a=0;$a<$kk;$a++)
  {
   //echo $tar_ac_total[$a];
   //echo $tar_amt_total[$a];
   //echo "</br>";
  }
	
	


	
	$zone=array();
	$bran=array();
	$zonebran=0;
	$o=0;
	$branch_i=array();
	$zone_i=array();
	$branch_code_i=array();
	
	foreach($record_name as $tt)
	{
	 $branch_i[$o]=$tt->BRANCH_NAME;
	 $zone_i[$o]=$tt->ZoneName;
	 $branch_code_i[$o]= $tt->jbbrcode;
	 $o++;
	}
	for($ll=0;$ll<$p;$ll++)
	{
	 for($lll=0;$lll<$o;$lll++)
	 {
	  if($branch[$ll]==$branch_code_i[$lll])
	  {
	     $zone[$zonebran]= $zone_i[$lll];
		 $bran[$zonebran]= $branch_i[$lll];
		// $o++;
		 $zonebran++;
	  }
	 }
	}
	
	//echo "Something Here Branch Zone--";
	//echo "</br>";
	for($ii=0;$ii<$zonebran;$ii++)
	{
	// echo $zone[$ii];
	// echo $bran[$ii];
	// echo "</br>";
	}
	
	//die();
	$data_ac = array();
	$data_amt = array();
	
	/////////////////////////////////////////////////////
	
	$br_data=array();
	$br_i=0;
	foreach($dms_data as $row)
	{
	 $br_data[$br_i]=$row->dp_jo_code;
	 $br_i++;
	}
	//echo "BBBBBB--";
	//echo "</br>";
	for($i=0;$i<$br_i;$i++)
	{
	 //echo $br_data[$i];
	 //echo "</br>";
	}
	//echo "</br>";
	$i=0;
	foreach($dms_data as $row)
	{
	 $data_ac[$i]=$row->dp_ac;
	 $data_amt[$i]=$row->dp_amt;
	 $i++;
	}
	
	for($k=0;$k<$i;$k++)
	{
	// echo $data_ac[$k];
	// echo "</br>";
	}
	//echo "EEEEEEEEEE".$br_i;
	//echo "</br>";
	
	$data_ac_total = array();
	$data_amt_total = array();
	$total=0;
	$aaa=0;
	$total_ac=0;
	$total_amt=0;
	for($m=0;$m<$p;$m++)
	{
	  for($mm=0;$mm<$br_i;$mm++)
	  {
	    if($branch[$m]==$br_data[$mm])
	   {
	     $total_ac=$total_ac+$data_ac[$total];
		 $total_amt=$total_amt+$data_amt[$total];
		 $total++;
	   }
	   
	  }
	  $data_ac_total[$m]=$total_ac;
	  $data_amt_total[$m]=$total_amt;
	  $total_ac=0;
	  $total_amt=0;
	}
	for($y=0;$y<$m;$y++)
	{
	 //echo $data_ac_total[$y];
	// echo $data_amt_total[$y];
	// echo "</br>";
	}
	
	$ac_total=0;
	$amt_total=0;
	$tar_ac=0;
	$tar_amt=0;
	for($m=0;$m<$y;$m++)
	{
	 $ac_total=$ac_total+$data_ac_total[$m];
	 $amt_total=$amt_total+$data_amt_total[$m];
	 
	 $tar_ac=$tar_ac+$tar_ac_total[$m];
	 $tar_amt=$tar_amt+$tar_amt_total[$m];
	}
	//echo $ac_total;
	//echo $amt_total;
	//echo $m;
	//die();
	$short_name=array();
	$s_n=0;
	foreach($dms_prod as $row1)
	{
	 $short_name[$s_n++]=$row1->pt_short_name;
	}
	
	$count=1;
	$show=0;
	//foreach($dms_branch as $rr)
	//foreach($dms_prod as $row1)
	//$tar_ac_total[$a]
	
	for($t=0;$t<$y;$t++)
	{
		echo "<tr>";
		echo "<td align='center'>".$count."</td>"; 
		//$A=$row1->pt_id;
		//echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
		//echo "<td align='left'>".$row1->om_id_des."</td>";
		//echo "<td align='left'>".$short_name[$t].   "</td>";
		
		echo '<td align="left">'.$zone[$t].'</td>';
		echo '<td align="left">'.$bran[$t].'</td>';
		
		echo '<td align="right">'.$tar_ac_total[$t].'</td>';
		echo '<td align="right">'.$tar_amt_total[$t].'</td>';

		echo '<td align="right">'.$data_ac_total[$t].'</td>';
		echo '<td align="right">'.$data_amt_total[$t].'</td>';
		
		echo '<td align="right">'.(($data_ac_total[$t]*100)/$tar_ac_total[$t]).'</td>';
		echo '<td align="right">'.(($data_amt_total[$t]*100)/$tar_amt_total[$t]).'</td>';
		
		$count++;
		$show++;
		echo "</tr>";
	 }
	echo "<tr>";
	echo "<td align='center'>"."<strong>".$count."<strong>"."</td>";
	echo "<td align='left'>"."<strong>"."  "."<strong>"."</td>"; 
	echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
	echo "<td align='right'>"."<strong>".$tar_ac."<strong>"."</td>"; 
	echo "<td align='right'>"."<strong>".$tar_amt."<strong>"."</td>"; 
	
	echo "<td align='right'>"."<strong>".$ac_total."<strong>"."</td>";
	echo "<td align='right'>"."<strong>".$amt_total."<strong>"."</td>";
	echo "</tr>";
	echo "</table>";
	echo "<table align='center'>";
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>".form_submit('actionbtn', 'SAVE AS PDF')."</td>";
	echo "</tr>";
	echo "</table>";
	echo form_close();
?>
</body>
</html>

