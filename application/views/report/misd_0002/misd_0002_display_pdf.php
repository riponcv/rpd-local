<style type="text/css">
html { 
margin-left: 25px;
margin-bottom: 5px;
}
</style>


<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>


<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Deposit Mix Report</td>
  </tr>
  <tr>
    <td align="center">Report of : <?php echo isset($report_of_date)?$report_of_date:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><td>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></td></tr><?php } ?>
</table>
<?php
if(isset($result_array) && !empty($result_array))
{
?>
<table border="1" align="right" style="border: thin;margin-top: -80px;border-collapse:collapse;" id="t1">
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
<br/>
<table style="margin-left: 705px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" align="center" style="border-collapse:collapse;" id="t1">
	<tr style="font-size: x-large;">
		<td align="center" width="300" colspan="4">High Cost Deposit</td>
		<td align="center" width="300" colspan="4">Low Cost Deposit</td>
	</tr>
	<tr>
		<td align="center">A/C Type</td>
		<td align="center">Amount</td>
        <td align="center">%</td>
        <td align="center" rowspan="7" style="font-size: xx-large;"><?php echo isset($result_array['deposit_mix']['high_cost_percentage'])?round($result_array['deposit_mix']['high_cost_percentage'],2).'%':'-'; ?></td>
        <td align="center">A/C Type</td>
		<td align="center">Amount</td>
        <td align="center">%</td>
        <td align="center" rowspan="7" style="font-size: xx-large;"><?php echo isset($result_array['deposit_mix']['low_cost_percentage'])?round($result_array['deposit_mix']['low_cost_percentage'],2).'%':'-'; ?></td>
	</tr>
    
   	<tr>
		<td align="left" rowspan="2">FDR</td>
		<td align="right" rowspan="2"><?php echo isset($result_array['deposit_mix']['FDR'])?round($result_array['deposit_mix']['FDR'],2):'-'; ?></td>
        <td align="right" rowspan="2"><?php echo isset($result_array['deposit_mix']['FDR_percentage'])?round($result_array['deposit_mix']['FDR_percentage'],2):'-'; ?></td>

        <td align="left">CD</td>
		<td align="right"><?php echo isset($result_array['deposit_mix']['CD'])?round($result_array['deposit_mix']['CD'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['deposit_mix']['CD_percentage'])?round($result_array['deposit_mix']['CD_percentage'],2):'-'; ?></td>
	</tr>
    
   	<tr>
        <td align="left">SB</td>
		<td align="right"><?php echo isset($result_array['deposit_mix']['SB'])?round($result_array['deposit_mix']['SB'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['deposit_mix']['SB_percentage'])?round($result_array['deposit_mix']['SB_percentage'],2):'-'; ?></td>
	</tr>
    
       	<tr>
		<td align="left" rowspan="2">Scheme</td>
		<td align="right" rowspan="2"><?php echo isset($result_array['deposit_mix']['scheme'])?round($result_array['deposit_mix']['scheme'],2):'-'; ?></td>
        <td align="right" rowspan="2"><?php echo isset($result_array['deposit_mix']['scheme_percentage'])?round($result_array['deposit_mix']['scheme_percentage'],2):'-'; ?></td>
        <td align="left">SND</td>
		<td align="right"><?php echo isset($result_array['deposit_mix']['SND'])?round($result_array['deposit_mix']['SND'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['deposit_mix']['SND_percentage'])?round($result_array['deposit_mix']['SND_percentage'],2):'-'; ?></td>
	</tr>
    
    
       	<tr>
        <td align="left">Sundry Deposit</td>
		<td align="right"><?php echo isset($result_array['deposit_mix']['sundry_deposit'])?round($result_array['deposit_mix']['sundry_deposit'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['deposit_mix']['sundry_deposit_percentage'])?round($result_array['deposit_mix']['sundry_deposit_percentage'],2):'-'; ?></td>
	</tr>
    
    
   	<tr>
		<td align="left" rowspan="2" >Total</td>
		<td align="right" rowspan="2" ><?php echo isset($result_array['deposit_mix']['high_cost_total'])?round($result_array['deposit_mix']['high_cost_total'],2):'-'; ?></td>
<td align="right" rowspan="2" ><?php echo isset($result_array['deposit_mix']['high_cost_percentage'])?round($result_array['deposit_mix']['high_cost_percentage'],2):'-'; ?></td>
        <td align="left">Other</td>
		<td align="right"><?php echo isset($result_array['deposit_mix']['other'])?round($result_array['deposit_mix']['other'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['deposit_mix']['other_percentage'])?round($result_array['deposit_mix']['other_percentage'],2):'-'; ?></td>
	</tr>
    
    
   	<tr>
        <td align="left" >Total</td>
		<td align="right" ><?php echo isset($result_array['deposit_mix']['low_cost_total'])?round($result_array['deposit_mix']['low_cost_total'],2):'-'; ?></td>
<td align="right" ><?php echo isset($result_array['deposit_mix']['low_cost_percentage'])?round($result_array['deposit_mix']['low_cost_percentage'],2):'-'; ?></td>
	</tr>
    
    
   	<tr align="center" style="font-size: larger;;">
        <td align="center" colspan="8">Grand Total (High Cost + Low Cost ) : <?php echo isset($result_array['deposit_mix']['grand_total'])?round($result_array['deposit_mix']['grand_total'],2):'-'; ?></td>
	</tr>
    
</table>
<br/>
<?php 
}
?>