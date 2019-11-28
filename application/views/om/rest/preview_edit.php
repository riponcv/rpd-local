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
	echo form_open('rpd/omis_data_insert');
	
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Entry Date";
	echo "</td>";
	echo $dddd;
	echo "Hello!";
	if(isset($dddd))
	{
	  echo "<td>"."<input type='text' name='datdate' value='123' size='10'/>"."</td>";
	}
	else
	{
	echo "<td>"."<input type='text' name='datdate' value='00' size='10'/>"."</td>";
	}
	
	echo "<td>";
	echo "dd/mm/yy (format)";
	echo "</td>";
	
	echo "</tr>";
	echo "</table>";
	echo "<table  align=\"center\">"; 
	echo "</table>";
	
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>"."Ser. No "."</td>";
	echo "<td>"."Product Category "."</td>";
	echo "<td>"."Product "."</td>";
	echo "<td>"."Amount "."</td>";
	echo "<td>"."No.of A/C "."</td>";
	echo "</tr>";
	
	$c=1;
	$co=1;
	foreach($records2 as $row1)
	{
		  echo "<tr>";
		  echo "<td>".$co."</td>"; 
		    $A=$row1->pt_id;
		  echo "<input type='hidden' name='pt_id[$c]' size='15' value='$A'/>";
		  echo "<td>".$row1->om_id_des."</td>";
		  echo "<td>".$row1->pt_short_name."</td>";
		  $A=$amt[$c];
		  echo "<td><input type='text' name='amount[$c]' size='15' value='$A'/></td>";
		  $C=$ac[$c];
		  echo "<td><input type='text' name='ac[$c]' size='10' value='$C'/></td>";
		  echo "</tr>";
		  $c++;
		  $co++;
	 }
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	//echo "<td>"." "."</td>";
	echo "<td>".form_submit('actionbtn', 'Submit')."</td>";
	echo "</tr>";
	echo "</table>";
	echo form_close();
	?>
     
		
</body>
</html>	