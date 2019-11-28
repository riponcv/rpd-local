<?php
	$if_ac_zero_array=array('121','301','3001','3301','4201','4501','4505','4801','5101');
?>

<p>
   	<?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>OMIS Data Editing Form</th></tr></table>"; 
	
    echo form_open('rpd/omis_data_insert');
    
    echo '<input type="hidden" name="datdate"  value="'.$selected_date.'" />';
	
    echo "<br/><div id='flashdata'>";
    echo '<font style="background-color:yellow;font-weight: bold;color: green;">Data For '.$selected_date.' To Edit</font>'; 
	echo "</div><br/>";


	echo "<table  align=\"center\">"; 
	echo "</table>";
	echo "<div id='error'>";
    echo validation_errors(); 
	echo "</div>";
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td align='center'>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='center' width='300'>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td align='center' >"."<strong>"."Product "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
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
	$ac_sum=0.0;
	$amt_sum=0.0;
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
	    (float)$ac_sum=$ac_sum+(float)$data_ac[$ii];
		(float)$amt_sum=$amt_sum+(float)$data_amt[$ii];
		$account++;
	   }
	  }
	 
	  $ac_total[$jj]=(float)$ac_sum;
	  $amt_total[$jj]=(float)$amt_sum;
	   $ac_sum=0;
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
	    while($BB[$z]==$row1->pt_pg_id)
			{
			 if($last>0)
				{
					echo "<tr>";
					echo "<td>"." "."</td>";
					echo "<td>"." "."</td>";
					echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
                    
					echo '<td>'.'<input type="text" name="totalamt[]" id="totalamt"  readonly="readonly" size="20" value="'.$amt_total[$jjj].'"/>'.'</td>';
					echo '<td>'.'<input type="text" name="totalac[]" id="totalac" readonly="readonly" size="20" value="'.$ac_total[$jjj].'"/>'.'</td>';
					echo "</tr>";
                    $jjj++;
				 }
				$last++;
				$z++;
				if(!isset($BB[$z])){$BB[$z]=0;}
			}
                //jack
              if(!isset($data_amt_total[$i])){$data_amt_total[$i]=0;}
              if(!isset($data_ac_total[$i])){$data_ac_total[$i]=0;}
              //jack
			  $total_count++;
              	  
			  echo "<tr>";
			  echo "<td align='center'>".$count."</td>"; 
			  $A=$row1->pt_id;
			  echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
			  echo "<td align='left'>".$row1->om_id_des."</td>";
			  echo "<td align='left'>".$row1->pt_short_name."</td>";
              
              //set value
              if(set_value('amount[]'))
              {
                $amount=set_value('amount[]');
              }
              else
              {
                $amount=$data_amt_total[$i];
              }
              
              if(set_value('ac[]'))
              {
                $ac=set_value('ac[]');
              }
              else
              {
                $ac=$data_ac_total[$i];
              }
			  
              
$read_only_ac='';				
if(in_array($row1->pt_id,$if_ac_zero_array)){$ac=0;$read_only_ac="readonly='readonly'";}

echo '<td>'.'<input type="text" name="amount[]"  onKeyUp="displayOmisText()" value="'.$amount.'" size="20"/>'.'</td>';
			  echo '<td>'.'<input '.$read_only_ac.'  type="text" name="ac[]" onKeyUp="displayOmisText()" value="'.$ac.'" size="20"/>'.'</td>';
			$co++;
		    $count++;
			$i=$i+1;//++;
		   echo "</tr>";
		
	
	 }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
    
	echo '<td>'.'<input type="text" name="totalamt[]" id="totalamt"   value="'.$amt_total[$jjj].'" readonly="readonly" size="20"/>'.'</td>';
	echo '<td>'.'<input type="text" name="totalac[]" id="totalac" value="'.$ac_total[$jjj].'" readonly="readonly" size="20"/>'.'</td>';
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td >".form_submit('actionbtn', 'Save Changes')."</td>";
	echo "<td>".form_reset('myClear', 'Set Previous Value')."</td>";
	echo "</tr>";
	
	echo "</table>";
	echo form_close();
	?>
 
 