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
    <td align="center" style="font-size:18px;">Yearly Position</td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
if(isset($result_array) && !empty($result_array))
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

<br/>
<table style="margin-left: 708px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" style="border-collapse:collapse;" id="t1">
<tr>
<td align="center">SL</td>
<td align="center" width="135px">End Of</td>
<td align="center">Deposit</td>
<td align="center">Advance</td>
<td align="center">CL Amount</td>
<td align="center">CL(%)</td>
<td align="center">CL Recovery Cash</td>
<td align="center">CL Reduction Reschedule</td>
<td align="center">CL Reduction Interest Waiver</td>
<td align="center">CL Reduction Write Off</td>
<td align="center">Cash Recovery Write Off</td>
<td align="center">Export</td>
<td align="center">Import</td>
<td align="center">Foreign Remittance</td>
<td align="center">Non Intt. Income</td>
<td align="center">PL</td>
</tr>

<?php foreach($result_array as $key=>$row) { ?>
<?php 
$present_yr_txt='';
if(count($result_array)==$key+1){$present_yr_txt='('.date("j F", strtotime($row['date'])).')';}

//CL(%)
$CL_percentage='';
if(isset($row['data']['advance']) && $row['data']['advance']>0 && isset($row['data']['CL_amount']) && isset($row['data']['stuff_loan']))
{
$CL_percentage=($row['data']['CL_amount']*100)/($row['data']['advance']-$row['data']['stuff_loan']);
}

?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['year'])?$row['year'].$present_yr_txt:''; ?></td>
<td align="right"><?php echo isset($row['data']['deposit'])?round($row['data']['deposit']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['advance'])?round($row['data']['advance']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['CL_amount'])?round($row['data']['CL_amount']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($CL_percentage)?round($CL_percentage,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['CL_recovery_cash'])?round($row['data']['CL_recovery_cash']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['CL_reduction_reschedule'])?round($row['data']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['CL_reduction_interest_waiver'])?round($row['data']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['CL_reduction_write_off'])?round($row['data']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['cash_recovery_write_off'])?round($row['data']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['export'])?round($row['data']['export']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['import'])?round($row['data']['import']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['foreign_remittance'])?round($row['data']['foreign_remittance']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['non_intt_income'])?round($row['data']['non_intt_income']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['data']['pl'])?round($row['data']['pl']/10000000,2):'-'; ?></td>
</tr>

<?php } ?>

</table>
<br/>
<?php 
}
?>