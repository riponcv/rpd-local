<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<p>
  <?php
  echo form_open('rpd/admin_insert_data');
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "dd /mm /yy (format)";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>".form_submit('actionbtn', 'Insert Data')."</td>";
	echo "</tr>";
	echo "</table>";
    echo form_close();
?>
</p>

<p>&nbsp;</p>
</body>
</html>
