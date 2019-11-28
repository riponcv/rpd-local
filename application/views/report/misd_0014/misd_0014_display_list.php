<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Branch Specification Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">Back</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Branch Specification Report</td>
  </tr>
  
    <?php
      $open_date_title='';
      //if opening date range set range set
	  
        if(isset($previous_value['range1_opndate']) && isset($previous_value['range2_opndate']) && $previous_value['range1_opndate'] !='' && $previous_value['range2_opndate'] !='')
        {
          if($previous_value['range2_opndate']>$previous_value['range1_opndate'])
          {
			$date1 = new DateTime($previous_value['range1_opndate']);
			$date2 = new DateTime($previous_value['range2_opndate']);
			
			$range1=$date1->format('d-M-Y');
            $range2=$date2->format('d-M-Y');
          }
		  else
		  {
			$date1 = new DateTime($previous_value['range2_opndate']);
			$date2 = new DateTime($previous_value['range1_opndate']);
			
			$range1=$date1->format('d-M-Y');
            $range2=$date2->format('d-M-Y');
		  }
          $open_date_title=" Opening Date($range1 to $range2) ";  
        }
    ?>
    <?php if($open_date_title !='') { ?>
  <tr>
    <td align="center" style="font-size:18px;"><?php echo $open_date_title; ?></td>
  </tr>
  <?php } ?>
  
  <tr>
    <td align="center" style="font-size:18px;"><?php echo isset($title)?$title:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
if(isset($ptr_val) && !empty($ptr_val))
{
?>

<table border="1" align="right" style="margin-top: -80px;">
  <tr>
    <td width="80">Report</td>
    <td width="175"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="80">Printing Date </td>
    <td width="175"><?php echo date('d/m/y'); ?></td>
  </tr>
  <tr>
    <td width="80">Source </td>
    <td width="175">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>

<br />
<table border="1" align="center">
 <tr align="center">
 <td>SL</td>
 <td>Branch Code</td>
 <td>Branch Name</td>
 <td>Opening Date</td>
 <td>Address</td>
 <td>Phone</td>
 </tr>
 
<?php foreach($ptr_val as $key=>$row){ ?> 
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="center"><?php echo isset($row->brcode)?$row->brcode:''; ?></td>
<td align="left"><?php echo isset($row->branchname)?$row->branchname:''; ?></td>
<td align="left"><?php echo isset($row->Opndate)?date('d-M-Y',strtotime($row->Opndate)):''; ?></td>
<td align="left"><?php echo isset($row->Address)?$row->Address:''; ?></td>
<td align="left"><?php echo isset($row->OfficePhone)?$row->OfficePhone:''; ?></td>
</tr>

<?php } ?>

</table>
<br/>
<?php 

    echo form_open('report/misd_0014_report_details_list/1');
    if(isset($previous_value) && !empty($previous_value))
    {
        foreach($previous_value as $key=>$val)
        {
            ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
            <?php
        }
    }
    
    $attribute='style="background-color: #FF9900;"';
	echo form_submit('actionbtn', 'Save AS PDF',$attribute);
	echo form_close();  
    
    }
    else
    {
        echo "<table border=\"1\" align=\"center\">"; 	
        echo "<tr>";
    	echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
        echo "</tr>";
    	echo "</table>";
    }

?>
<br/>
</body>
</html>
