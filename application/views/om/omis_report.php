<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>OMIS Report </title>
</head>

<body>
<?php

	echo '<h2 style="font-size:15px;text-align:center; font-weight:bolder;color:#3311FF"> OMIS Report</h2>';
   echo form_open('rpd/omis_report_show_form');
  //echo form_open('rpd/delete_om_data');
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Date for Report";
	echo "</td>";
	echo "<td>";
	/*echo '<select name="datdate">';
	foreach($records3 as $row)
	{
	
      echo '<option value="'.$row->om_dat_date.'">'.$row->om_dat_date.'</option>';

	}
	echo '</select>';*/
    //jack
	echo '<select name="datdate" onchange="om_is_month_last_report(this)">';

	$pre_selected=0;
    foreach($records3 as $row)
	{
	
		$select='';
		if(isset($_POST['datdate']) && $_POST['datdate']==$row->om_dat_date)
		{
			$select="selected='selected'";
            $pre_selected=$row->om_is_month_last;
		}
        else
        {
            $selected_date=$this->session->userdata('last_month_date'); 
            if(isset($selected_date) && $selected_date==$row->om_dat_date)
            {
               $select="selected='selected'";
               $pre_selected=$row->om_is_month_last; 
            }
        }
        
      
	  echo '<option id="'.$row->om_is_month_last.'" value="'.$row->om_dat_date.'" '.$select.'>'.$row->om_dat_date.'</option>';
	  
	  
	  //echo '<option value="'.$row->om_dat_date.'" "'.set_select('datdate', "'.$row->om_dat_date.'" >'.$row->om_dat_date.'</option>';
	}
	echo '</select>';
    echo '<input type="hidden" name="pre_selected_date_decider" id="pre_selected_date_decider" value="'.$pre_selected.'" />';
    
    //jack
    
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>".form_submit('actionbtn', 'View Report')."</td>";
	echo "</tr>";
	echo "</table>";
	echo form_close();
?>
</body>
</html>
