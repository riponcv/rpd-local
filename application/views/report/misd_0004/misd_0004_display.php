<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>A Display</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Progressive Deposit Mix & ADR Report</td>
  </tr>
  <tr>
    <td align="center">Report of : <?php echo isset($report_of_year)?$report_of_year:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
if(isset($result_array['a']) && !empty($result_array['a']))
{
?>
<table border="1" align="right" style="margin-top: -90px;">
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
<table style="margin-right: -575px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" align="center">
 <tr>
 <th>Date</th>
 <th>HC Deposit</th>
 <th>LC Deposit</th>
 <th>Total Deposit</th>
 <th>HCD(%)</th>
 <th>LCD(%)</th>
 <th>Total Advance</th>
 <th>ADR</th>
 </tr>
<?php foreach($result_array['a'] as $key=>$row){ ?> 

<?php 
$date_exp=explode(' ',$row['date_cal']); 
$date_=$date_exp[0];
?>

<tr align="right">
<td><?php echo isset($date_)?$date_:'-'; ?></td>
<td><?php echo isset($row['hc'])?round($row['hc'],2):'-'; ?></td>
<td><?php echo isset($row['lc'])?round($row['lc'],2):'-'; ?></td>
<td><?php echo isset($row['total_deposit'])?round($row['total_deposit'],2):'-'; ?></td>
<td><?php echo isset($row['hcr'])?round($row['hcr'],2):'-'; ?></td>
<td><?php echo isset($row['lcr'])?round($row['lcr'],2):'-'; ?></td>
<td><?php echo isset($row['total_advance'])?round($row['total_advance'],2):'-'; ?></td>
<td><?php echo isset($row['adr'])?round($row['adr'],2):'-'; ?></td>  
</tr>
<?php } ?>
</table>
<br/>
<?php 

    echo form_open('report/misd_0004_report_details/1');
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
