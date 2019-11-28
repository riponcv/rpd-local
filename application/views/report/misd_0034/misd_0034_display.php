<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Type-wise Deposit(SBS-2) Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Type-wise Deposit(SBS-2) Report</td>
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
<table style="margin-right: -820px;"><tr><td>Amount in Taka</td></tr></table>
<br/>
<table border="1">
	<tr style="font-weight:bold">
		<td align="center" width="20" style="font-size:16px; ">SL</td>
       <td align="center" width="30" style="font-size:16px; ">Deposit Type Code</td>
	   <td align="center" width="200" style="font-size:16px; ">Deposit Type</td>
	   <td align="center" width="80" style="font-size:16px; ">Amount</td>
	   <td align="center" width="45" style="font-size:16px; ">%</td>
	</tr>
	
	
	<?php 
	 $grand_total=0;
	foreach($result_array['report_val'] as $key=>$row) 
	{ 
	$grand_total=$grand_total+$row['amount'];
	}
	foreach($result_array['report_val'] as $key=>$row) 
	{
	?>
		<?php
		 if($row['amount']>0)
		{
		?>
	<tr>
		<td align="center"><?php echo ($key+1); ?></td>		
        <td align="left"><?php echo isset($row['type'])?$row['type']:''; ?></td>
		<td align="left"><?php echo isset($row['type_description'])?$row['type_description']:''; ?></td>
		<td align="right"><?php echo isset($row['amount'])?round($row['amount'],2):'-'; ?></td>
		<td align="right"><?php echo isset($grand_total)?round($row['amount']*100/$grand_total,2):'-'; ?></td>
		
	</tr>
		<?php 
		}
		?>
	<?php
	}
	?>
	<tr style="font-size:16px; font-weight:bold;background-color:#D0D0D0;">
		<td align="center" colspan='3'>Total</td>
		<td align="right" ><?php echo isset($grand_total)?round($grand_total,2):'-'; ?></td>
		<td align="right" ><?php echo isset($grand_total)?round($grand_total*100/$grand_total,2):'-'; ?></td>
	</tr>
</table>

<?php 

    echo form_open('report/misd_0034_report_details/1');
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
