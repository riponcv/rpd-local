<style type="text/css">
html { 
margin-left: 15px;
margin-bottom: 5px;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Sector-wise Deposit(SBS-2) Report</td>
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
<table border="1" align="right" style="border: thin;margin-top: -90px;border-collapse:collapse;" id="t1">
  <tr>
    <td width="65">Report</td>
    <td width="140"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="65">Printing Date </td>
    <td width="140"><?php echo date('d/m/y'); ?></td>
  </tr>
  <tr>
    <td width="65">Source </td>
    <td width="140">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>
<br />
<table align="right"><tr><td>Amount in Taka</td></tr></table>
<br/>
<br/>
<table border="1" style="border-collapse:collapse;" id="t1" align="center">
	<tr style="font-weight:bold">
		<td align="center" width="20" style="font-size:16px; ">SL</td>
        <td align="center" width="30" style="font-size:16px; ">Sector Code</td>
	    <td align="center" width="200" style="font-size:16px; ">Sector Description</td>
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
			<td align="left"><?php echo isset($row['sector'])?$row['sector']:''; ?></td>
			<td align="left"><?php echo isset($row['sector_title'])?$row['sector_title']:''; ?></td>
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
}
?>