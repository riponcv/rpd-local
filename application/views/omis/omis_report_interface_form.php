<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php

	echo '<h2 style="font-size:15px;text-align:center; font-weight:bolder;color:#3311FF"> OMIS Report</h2>';
 echo form_open('rpd/omis_choice_interface');
  echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>".form_submit('actionbtn', 'Branch Report')."</td>";
	echo "<td>".form_submit('actionbtn', 'Area Report')."</td>";
	echo "<td>".form_submit('actionbtn', 'Divisional Report')."</td>";
	echo "<td>".form_submit('actionbtn', 'Whole Bank Report')."</td>";
	echo "</tr>";
	echo "</table>";
	echo form_close();
?>
</body>
</html>
