<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CIBTA Statement</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">CIBTA Statement</td>
  </tr>
  <tr>
  <?php $month_array=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >For the Month of <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
if(isset($result_array['report_val']) && !empty($result_array['report_val']))
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
<table border="1">
<tr>
<th>Last Date Of Inter-branch Reconciliation Completed</th>
<th>No of debit entry</th>
<th>Debit Amount</th>
<th>No of credit entry</th>
<th>Credit Amount</th>
</tr>
<tr>
<td align="center"><?php echo isset($result_array['report_val']['reconcompleted'])?date('d-M-Y',strtotime($result_array['report_val']['reconcompleted'])):''; ?></td>
<td align="right"><?php echo isset($result_array['report_val']['TotalDrEntry'])?$result_array['report_val']['TotalDrEntry']:''; ?></td>
<td align="right"><?php echo isset($result_array['report_val']['DrAmount'])?$result_array['report_val']['DrAmount']:''; ?></td>
<td align="right"><?php echo isset($result_array['report_val']['TotalCrEntry'])?$result_array['report_val']['TotalCrEntry']:''; ?></td>
<td align="right"><?php echo isset($result_array['report_val']['CrAmount'])?$result_array['report_val']['CrAmount']:''; ?></td>
</tr>
</table>
<br/>
<?php 

    echo form_open('report/misd_0035_report_details/1');
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
