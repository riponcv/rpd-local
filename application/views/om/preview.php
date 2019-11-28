<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>untitled</title>
	<style type="text/css" media="screen">
		label {display: block;}
	</style>
	
	
</head>
<body>
    
	<?php 
	echo form_open('rpd/record3');
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Entry Date";
	echo "</td>";
	//foreach($dddd as $row)
	
	//echo $dddd;
	if(isset($dddd))
	{
	  echo "<td>"."<input type='text' name='datdate' value='$dddd' disabled='disabled' size='10'/>"."</td>";
	}
	else
	{
	echo "<td>"."<input type='text' name='datdate' value='00' disabled='disabled' size='10'/>"."</td>";
	}
	
	
	echo "<td>";
	echo "dd/mm/yy";
	echo "</td>";
	
	echo "</tr>";
	echo "</table>";
	echo "<table  align=\"center\">"; 
	echo "</table>";
	
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>"."Ser. No "."</td>";
	echo "<td>"."Product Category "."</td>";
	//echo "<td>"."Code "."</td>";
	echo "<td>"."Product "."</td>";
	echo "<td>"."Amount "."</td>";
	echo "<td>"."No.of A/C "."</td>";
	echo "</tr>";
	/*
	$c=0;
	foreach($records2 as $row1)
	{
		  echo "<tr>";
		  echo "<td>".$c."</td>"; 
		    $A=$row1->pt_id;
		  echo "<input type='hidden' name='pt_id[$c]' size='15' value='$A'/>";
		  echo "<td>".$row1->om_id_des."</td>";
		
		  echo "<td>".$row1->pt_short_name."</td>";
		  echo "<td>$amt[$c]</td>";
		  $AM=$amt[$c];
		  echo "<input type='hidden' name='amount[$c]' size='15' value='$AM'/>";
		  echo "<td>$ac[$c]</td>";
		  $C=$ac[$c];
		  echo "<input type='hidden' name='ac[$c]' size='10' value='$C'/>";
		  echo "</tr>";
		  $c++;
	 }
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	
	
	echo "<td>".form_submit('actionbtn', 'Submit')."</td>";
	echo "<td>".form_submit('actionbtn', 'Edit')."</td>";
	echo "</tr>";
	
	echo "</table>";
	echo form_close();
	*/
	$c=0;
	$tol=0;
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
					echo "<td>"."Total "."</td>";
					echo '<td>'.$amtotal[$tol].'</td>';
					//echo '<td>'.'<input type="text" name="totalamt[]" id="totalamt" value="'.$AMT.'" disabled="disabled" size="15"/>'.'</td>';
					//echo '<td>'.'<input type="text" name="totalac[]" id="totalac"  disabled="disabled" size="8"/>'.'</td>';
					echo '<td>'.$actotal[$tol].'</td>';
					echo "</tr>";
				// echo '<td>'.'<input type="text" name="amount_c[]"  size="15"/>'.'</td>';
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
			  echo "<td>$amt[$c]</td>";
		  $AM=$amt[$c];
		  echo "<input type='hidden' name='amount[$c]' size='15' value='$AM'/>";
		  echo "<td>$ac[$c]</td>";
		  $C=$ac[$c];
		  echo "<input type='hidden' name='ac[$c]' size='10' value='$C'/>";
			$co++;
		    $count++;
		   echo "</tr>";
		
	
	 }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>"."Total "."</td>";
	//$AMT=$amtotal[$tol];
	//echo '<td>'.'<input type="text" name="totalamt[]" id="totalamt"  value="$AMT" disabled="disabled" size="15"/>'.'</td>';
	echo '<td>'.$amtotal[$tol].'</td>';
	echo '<td>'.$actotal[$tol].'</td>';
	//echo '<td>'.'<input type="text" name="totalac[]" id="totalac"  disabled="disabled" size="8"/>'.'</td>';
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>".form_submit('actionbtn', 'Submit')."</td>";
	echo "<td>".form_submit('actionbtn', 'Edit')."</td>";
	echo "</tr>";
	
	echo "</table>";
	echo form_close();
	?>

	
	?>
     
		
</body>
</html>	