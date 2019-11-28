<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<!--Required Admin Branch JS Code--> 
<script type="text/javascript">
    jQuery(document).ready( function() {
        $("#search_zone_by_text").keyup(function(){
			var searchText=jQuery('#search_zone_by_text').val();
		 	jQuery.ajax({
				url: "<?php echo base_url();?>index.php/rpd/search_zone_by_text",
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

	echo '<h2 style="font-size:15px;text-align:center; font-weight:bolder;color:#3311FF"> OMIS Area Summary Report</h2>';
    echo form_open('rpd/omis_zn_report_interface_all_summ');
  	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	
	?>
	<td>
	Search Area Name
	</td>
	<td>
	<input type="text"  name="search_zone_by_text" id="search_zone_by_text" />
	</td>
	
	<?php
	echo "<td>";
	echo "Date for Report";
	echo "</td>";
	echo "<td>";
	echo '<select name="datdate">';
	foreach($records3 as $row)
	{
	
      echo '<option value="'.$row->om_dat_date.'">'.$row->om_dat_date.'</option>';

	}
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

