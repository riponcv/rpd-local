<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>
<body>
<p>
  <?php
  echo form_open('rpd/dms_br_report_all/true');
  $date_yr=$date1yr;
  echo "<input type='hidden' name='date_year' size='15' value='$date_yr'/>";
  $date_mon=$date1mon;
  echo "<input type='hidden' name='date_mon' size='15' value='$date_mon'/>";
  $var_br=$data_br;
  echo "<input type='hidden' name='branch_for_report' size='15' value='$var_br'/>";
  
	$d = date_parse_from_format("YY-MM-dd", $var_today);
	$year= $d["year"];
	$month=substr($var_today,3,3);
	$day=substr($var_today,0,2);
	     echo "<table align=\"center\">"; 
		 echo "<tr>";
		 echo "<th align='center' style='font-size:18px;'>";
		 echo "CDMS Report";
		 echo "</th>";
		 echo "</tr>";
		 echo "<tr>";
		 echo "<th style='font-size:14px;' align='center'>"."Report as on Year ".$date1yr." Month  ".$date1mon."</th>";
		 echo "</tr>";
		 echo "<tr>";
	     echo "<th align='center' style='font-size:12px;'>".$txt_office_name."Branch  ".$var_br."</th>";
	     echo "</tr>";
		 
		 echo "<tr>";
	     echo "<th align='center' style='font-size:12px;'>";
		 echo "No. of Employee";
		 echo "</th>";
	     echo "</tr>";
		 
		 echo "</table>";
	?>	 
	
	<?php 
	$count=0;
   $tar_ac=array();
   $tar_amt=array();
   $ac_n=0;
   foreach($records_target as $row_tar)
   {
     $tar_ac[$ac_n]=$row_tar->Dsg_Target_ac;
	 $tar_amt[$ac_n]=$row_tar->Dsg_Target_Amt;
	 $ac_n++;
	 
   }
   $list=array();
   $tar_list=array();
   $list_deg=array();
   $ii=0;
   $iii=0;
   foreach($records_emp_list as $row_list)
   {
     $tar_list[$iii++]=$row_list->el_no_emp;
     if($row_list->el_no_emp>0)
	 {
	  $list[$ii]=$row_list->el_no_emp;
	  $list_deg[$ii]=$row_list->el_dsg_id;
	  $ii++;
	 }
   }
   
   $tar_account=0;
   $tar_amount=0;
   for($R=0;$R<$ac_n;$R++)
   {
     $tar_account=$tar_account+$tar_list[$R]*$tar_ac[$R];
	 $tar_amount=$tar_amount+$tar_list[$R]*$tar_amt[$R];
   }
   for($j=0;$j<$ii;$j++)
   {
    echo $list_deg[$j];
  ?>
	
<td><input type="text" name="desig" id="row_emp" size="2" readonly="readonly" value="<?php echo $list[$j]; ?>"/></td>
	<?php
	
   }
	foreach($records_emp as $row_emp)
	{?>
    <th><?php //echo $row_emp->Dsg_File_No_Prefix; ?></th>
    <td><input type="hidden"  onKeyUp="displayTargetAmt()"  name="desig[]" id="<?php echo $row_emp->Dsg_File_No_Prefix; ?>"size="2" value="<?php echo set_value('desig[]'); ?>"/></td>
  	<input type="hidden" name="desig_id[]" value= "<?php echo $row_emp->Dsg_File_No_Prefix; ?>"size="5" />
	<input type="hidden" name="amtount[]" value= "<?php echo $row_emp->Dsg_Target_Amt; ?>"size="5" />
	<input type="hidden" name="noac[]"  value= "<?php echo $row_emp->Dsg_Target_ac; ?>" size="5" />
	<?php $count++;
	}?>
	<?php
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' width='150'>"."<strong>"."A/C Type "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."No.of A/C "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "</tr>";
	$data_ac = array();
	$data_amt = array();
	$i=0;
	foreach($dms_data as $row)
	{
	 $data_ac[$i]=$row->dp_ac;
	 $data_amt[$i]=$row->dp_amt;
	 $i++;
	}
	$ac_total=0;
	$amt_total=0;
	for($m=0;$m<$i;$m++)
	{
	 $ac_total=$ac_total+$data_ac[$m];
	 $amt_total=$amt_total+$data_amt[$m];
	}
	$count=1;
	$show=0;
	 foreach($dms_prod as $row1)
	{
	    echo "<tr>";
		echo "<td align='center'>".$count."</td>"; 
		$A=$row1->pt_id;
		echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
		echo "<td align='left'>".$row1->pt_short_name.   "</td>";
		echo '<td align="right">'.$tar_ac[$show].'</td>';
		echo '<td align="right">'.$tar_amt[$show].'</td>';
		$count++;
		$show++;
		echo "</tr>";
	 }
	echo "<tr>";
	echo "<td align='center'>"."<strong>".$count."<strong>"."</td>"; 
	echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
	echo "<td align='right'>"."<strong>".$ac_total."<strong>"."</td>";
	echo "<td align='right'>"."<strong>".$amt_total."<strong>"."</td>";
	echo "</tr>";
	echo "</table>";
	echo "<table border=\"1\" align='center'>";
	echo "<tr>";
    echo "<td>";
	echo "Target no.of A/C";
	echo "</td>";
	
	echo "<td>";
	echo "Target amount in Taka";
	echo "</td>";
	
	echo "<td>";
	echo "Achieve no.of A/C";
	echo "</td>";
    
	echo "<td>";
	echo "Achieve amount in Taka";
	echo "</td>";

	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo $tar_account;
	echo "</td>";

    echo "<td>";
	echo $tar_amount;
	echo "</td>";
	
	echo "<td>";
	echo $ac_total;
	echo "</td>";
	
	echo "<td>";
	echo $amt_total;
	echo "</td>";
	
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

