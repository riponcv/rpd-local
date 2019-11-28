<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CDMS Report </title>

<!--Required Admin Branch JS Code--> 
<script type="text/javascript">
    jQuery(document).ready( function() {
        $("#search_div_by_text").keyup(function(){
			var searchText=jQuery('#search_div_by_text').val();
		 	jQuery.ajax({
				url: "<?php echo base_url();?>index.php/rpd/search_div_by_text",
				type: "POST",
				data: 'searchText='+searchText,
				success: function(response) {
					if(response != '')
					{
						jQuery('#result_show').html('');
						jQuery('#result_show').html(response);
					}
				  }
				});
		}); 
	});
	       
</script>


</head>

<body>
<?php

echo '<h2 style="font-size:15px;text-align:center; font-weight:bolder;color:#3311FF"> CDMS for Division Report</h2>';
    echo form_open('rpd/dms_div_report_all');
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	?>
	<td>
	Search Division
	</td>
	<td>
	<input type="text"  name="search_div_by_text" id="search_div_by_text" />
	</td>
	
	<?php
	echo "<td>";
	echo "Year for Report";
	echo "</td>";
	echo "<td>";
	echo '<select name="date_year">';
	foreach($records3 as $row)
	{
	
      echo '<option value="'.$row->dp_yr.'">'.$row->dp_yr.'</option>';

	}
	echo '</select>';
	echo "</td>";
	
	
	echo "<td>";
	echo "Month for Report";
	echo "</td>";
	
	  echo "<td>";
	  echo '<select name="date_mon">';
	  echo '<option value="1">';echo 01; echo'</option>';
	  echo '<option value="2">';echo 02; echo'</option>';
	  echo '<option value="3">';echo 03; echo'</option>';
	  echo '<option value="4">';echo 04; echo'</option>';
	  echo '<option value="5">';echo 05; echo'</option>';
	  echo '<option value="6">';echo 06; echo'</option>';
	  echo '<option value="7">';echo 07; echo'</option>';
	  echo '<option value="8">';echo 8; echo'</option>';
	  echo '<option value="9">';echo 9; echo'</option>';
	  echo '<option value="10">';echo 10; echo'</option>';
	  echo '<option value="11">';echo 11; echo'</option>';
	  echo '<option value="12">';echo 12; echo'</option>';
	  echo '</select>';
	  echo "</td>";
	
	echo "</tr>";
	?>
	<tr id="result_show">
	</tr>
	<?php
	echo "<tr>";
	echo "<td>".form_submit('actionbtn', 'View Report')."</td>";
	echo "</tr>";
	echo "</table>";
	echo form_close();
?>
</body>
</html>
