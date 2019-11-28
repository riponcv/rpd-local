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
    <td align="center" style="font-size:18px;">Category-wise Deposit Status Report</td>
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
<table style="margin-left: 878px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" style="border-collapse:collapse;" id="t1">
<tr>
<th>SL</th>
<th><?php echo isset($list_title)?$list_title:'Office'; ?></th>
<th>CD</th>
<th>SND</th>
<th>SB</th>
<th>FDR</th>
<th>Scheme</th>
<th>Sundry</th>
<th>Other</th>
<th>Total</th>
<th>CD(%)</th>
<th>SND(%)</th>
<th>SB(%)</th>
<th>FDR(%)</th>
<th>Scheme(%)</th>
<th>Sundry(%)</th>
<th>Other(%)</th>
</tr>

<?php
$cd_t=0;
$snd_t=0;
$sb_t=0;
$fdr_t=0;
$scheme_t=0;
$sd_t=0;
$other_t=0;
$total_t=0;
?>


<?php foreach($result_array as $key=>$row) { ?>

<?php
$cd_t=$cd_t+$row['report_val']['cd'];
$snd_t=$snd_t+$row['report_val']['snd'];
$sb_t=$sb_t+$row['report_val']['sb'];
$fdr_t=$fdr_t+$row['report_val']['fdr'];
$scheme_t=$scheme_t+$row['report_val']['scheme'];
$sd_t=$sd_t+$row['report_val']['sd'];
$other_t=$other_t+$row['report_val']['other'];
$total_t=$total_t+$row['report_val']['total'];
?>

<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
<td align="right"><?php echo isset($row['report_val']['cd'])?round($row['report_val']['cd'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['snd'])?round($row['report_val']['snd'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['sb'])?round($row['report_val']['sb'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['fdr'])?round($row['report_val']['fdr'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['scheme'])?round($row['report_val']['scheme'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['sd'])?round($row['report_val']['sd'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['other'])?round($row['report_val']['other'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['total'])?round($row['report_val']['total'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['cd_p'])?round($row['report_val']['cd_p'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['snd_p'])?round($row['report_val']['snd_p'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['sb_p'])?round($row['report_val']['sb_p'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['fdr_p'])?round($row['report_val']['fdr_p'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['scheme_p'])?round($row['report_val']['scheme_p'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['sd_p'])?round($row['report_val']['sd_p'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['other_p'])?round($row['report_val']['other_p'],1):'-'; ?></td>
</tr>

<?php } ?>

<?php
if(isset($total_t) && $total_t>0)
{
$cd_t_p=($cd_t/$total_t)*100;
$snd_t_p=($snd_t/$total_t)*100;
$sb_t_p=($sb_t/$total_t)*100;
$fdr_t_p=($fdr_t/$total_t)*100;
$scheme_t_p=($scheme_t/$total_t)*100;
$sd_t_p=($sd_t/$total_t)*100;
$other_t_p=($other_t/$total_t)*100;
}
?>

<tr style="font-weight: bold;">
<td align="left" colspan="2">Total</td>
<td align="right"><?php echo isset($cd_t)?round($cd_t,2):'-'; ?></td>
<td align="right"><?php echo isset($snd_t)?round($snd_t,2):'-'; ?></td>
<td align="right"><?php echo isset($sb_t)?round($sb_t,2):'-'; ?></td>
<td align="right"><?php echo isset($fdr_t)?round($fdr_t,2):'-'; ?></td>
<td align="right"><?php echo isset($scheme_t)?round($scheme_t,2):'-'; ?></td>
<td align="right"><?php echo isset($sd_t)?round($sd_t,2):'-'; ?></td>
<td align="right"><?php echo isset($other_t)?round($other_t,2):'-'; ?></td>
<td align="right"><?php echo isset($total_t)?round($total_t,2):'-'; ?></td>
<td align="right"><?php echo isset($cd_t_p)?round($cd_t_p,2):'-'; ?></td>
<td align="right"><?php echo isset($snd_t_p)?round($snd_t_p,2):'-'; ?></td>
<td align="right"><?php echo isset($sb_t_p)?round($sb_t_p,2):'-'; ?></td>
<td align="right"><?php echo isset($fdr_t_p)?round($fdr_t_p,2):'-'; ?></td>
<td align="right"><?php echo isset($scheme_t_p)?round($scheme_t_p,2):'-'; ?></td>
<td align="right"><?php echo isset($sd_t_p)?round($sd_t_p,2):'-'; ?></td>
<td align="right"><?php echo isset($other_t_p)?round($other_t_p,1):'-'; ?></td>
</tr>

</table>
<br/>
<?php 
}
?>