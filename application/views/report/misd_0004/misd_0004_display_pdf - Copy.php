<style type="text/css">
html { 
margin-left: 25px;
margin-bottom: 5px;
}
</style>

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
<table border="1" align="right" style="border: thin;margin-top: -90px;" >
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
<table style="margin-left: 555px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" align="center">
 <tr>
 <th width="80px">Date</th>
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
<td align="left"><?php echo isset($date_)?$date_:'-'; ?></td>
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
}
?>