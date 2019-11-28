<style>
table#t1 td{margin:0;padding:0;border:1px solid;padding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid;padding:0px;}
</style>

<table align="center" style="margin-top: -40px;">
  <tr>
    <td align="center" style="font-size:24px;">Comparative Deposit Status</td>
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
<table style="margin-left: 878px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" style="border-collapse:collapse;" id="t1" align="center">
<tr>
<th style="width: 35px;">SL</th>
<th style="width: 230px;"><?php echo isset($list_title)?$list_title:'Office'; ?></th>
<th style="width: 85px;">Total</th>
<th style="width: 85px;">Type</th>
<th style="width: 70px;">FDR</th>
<th style="width: 70px;">Scheme</th>
<th style="width: 70px;">CD</th>
<th style="width: 70px;">SB</th>
<th style="width: 70px;">SND</th>
<th style="width: 70px;">S/Deposit</th>
<th style="width: 70px;">Others</th>
<th style="width: 85px;">Total</th>
<th style="background-color:#D0D0D0;width: 130px;">%</th>
<th style="width: 130px;">% As on <?php echo date('d/m/y',strtotime($pre_week_date)); ?></th>
</tr>

<?php
$cd_t=0;
$snd_t=0;
$sb_t=0;
$fdr_t=0;
$scheme_t=0;
$sd_t=0;
$other_t=0;
$hc_t=0;
$lc_t=0;
$total_t=0;

$cd_t_preweek=0;
$snd_t_preweek=0;
$sb_t_preweek=0;
$fdr_t_preweek=0;
$scheme_t_preweek=0;
$sd_t_preweek=0;
$other_t_preweek=0;
$hc_t_preweek=0;
$lc_t_preweek=0;
$total_t_preweek=0;
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
$hc_t=$hc_t+$row['report_val']['total_hc'];
$lc_t=$lc_t+$row['report_val']['total_lc'];
$total_t=$total_t+$row['report_val']['total'];

$cd_t_preweek=$cd_t_preweek+$row['report_val']['cd_preweek'];
$snd_t_preweek=$snd_t_preweek+$row['report_val']['snd_preweek'];
$sb_t_preweek=$sb_t_preweek+$row['report_val']['sb_preweek'];
$fdr_t_preweek=$fdr_t_preweek+$row['report_val']['fdr_preweek'];
$scheme_t_preweek=$scheme_t_preweek+$row['report_val']['scheme_preweek'];
$sd_t_preweek=$sd_t_preweek+$row['report_val']['sd_preweek'];
$other_t_preweek=$other_t_preweek+$row['report_val']['other_preweek'];
$hc_t_preweek=$hc_t_preweek+$row['report_val']['total_hc_preweek'];
$lc_t_preweek=$lc_t_preweek+$row['report_val']['total_lc_preweek'];
$total_t_preweek=$total_t_preweek+$row['report_val']['total_preweek'];

?>

<tr>
<td align="center" rowspan="2"><?php echo ($key+1); ?></td>
<td align="left" rowspan="2"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
<td align="right" rowspan="2"><?php echo isset($row['report_val']['total'])?number_format($row['report_val']['total'],2):'-'; ?></td>
<td align="center">HC</td>
<td align="right"><?php echo isset($row['report_val']['fdr'])?number_format($row['report_val']['fdr'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['scheme'])?number_format($row['report_val']['scheme'],2):'-'; ?></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"><?php echo isset($row['report_val']['total_hc'])?number_format($row['report_val']['total_hc'],2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($row['report_val']['hc_p'])?number_format($row['report_val']['hc_p'],2).'%':'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['hc_p_preweek'])?number_format($row['report_val']['hc_p_preweek'],2).'%':'-'; ?></td>
</tr>

<tr>
<td align="center">LC</td>
<td align="right"></td>
<td align="right"></td>
<td align="right"><?php echo isset($row['report_val']['cd'])?number_format($row['report_val']['cd'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['sb'])?number_format($row['report_val']['sb'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['snd'])?number_format($row['report_val']['snd'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['sd'])?number_format($row['report_val']['sd'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['other'])?number_format($row['report_val']['other'],2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['total_lc'])?number_format($row['report_val']['total_lc'],2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($row['report_val']['lc_p'])?number_format($row['report_val']['lc_p'],2).'%':'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['lc_p_preweek'])?number_format($row['report_val']['lc_p_preweek'],2).'%':'-'; ?></td>
</tr>

<?php } ?>

<!--Total current week start -->
<?php 
if($total_t>0)
{
 $hc_t_p=($hc_t*100)/$total_t;  
 $lc_t_p=($lc_t*100)/$total_t; 
}
?>
<tr>
<td align="center" rowspan="2" colspan="2" style="background-color:#D0D0D0;">Total As on <?php echo date('d/m/y',strtotime($report_of_date)); ?></td>
<td align="right" rowspan="2" style="background-color:#D0D0D0;"><?php echo isset($total_t)?number_format($total_t,2):'-'; ?></td>
<td align="center" style="background-color:#D0D0D0;">HC</td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($fdr_t)?number_format($fdr_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($scheme_t)?number_format($scheme_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"></td>
<td align="right" style="background-color:#D0D0D0;"></td>
<td align="right" style="background-color:#D0D0D0;"></td>
<td align="right" style="background-color:#D0D0D0;"></td>
<td align="right" style="background-color:#D0D0D0;"></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($hc_t)?number_format($hc_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($hc_t_p)?number_format($hc_t_p,2).'%':'-'; ?></td>
<td align="right"></td>
</tr>

<tr>
<td align="center" style="background-color:#D0D0D0;">LC</td>
<td align="right" style="background-color:#D0D0D0;"></td>
<td align="right" style="background-color:#D0D0D0;"></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($cd_t)?number_format($cd_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($sb_t)?number_format($sb_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($snd_t)?number_format($snd_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($sd_t)?number_format($sd_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($other_t)?number_format($other_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($lc_t)?number_format($lc_t,2):'-'; ?></td>
<td align="right" style="background-color:#D0D0D0;"><?php echo isset($lc_t_p)?number_format($lc_t_p,2).'%':'-'; ?></td>
<td align="right"></td>
</tr>

<!--Total current week end -->

<!--Total preweek week start -->
<?php 
if($total_t_preweek>0)
{
 $hc_t_p_preweek=($hc_t_preweek*100)/$total_t_preweek;  
 $lc_t_p_preweek=($lc_t_preweek*100)/$total_t_preweek; 
}
?>

<tr>
<td align="center" rowspan="2" colspan="2">Total As on <?php echo date('d/m/y',strtotime($pre_week_date)); ?></td>
<td align="right" rowspan="2" ><?php echo isset($total_t_preweek)?number_format($total_t_preweek,2):'-'; ?></td>
<td align="center">HC</td>
<td align="right"><?php echo isset($fdr_t_preweek)?number_format($fdr_t_preweek,2):'-'; ?></td>
<td align="right"><?php echo isset($scheme_t_preweek)?number_format($scheme_t_preweek,2):'-'; ?></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"><?php echo isset($hc_t_preweek)?number_format($hc_t_preweek,2):'-'; ?></td>
<td align="right"></td>
<td align="right"><?php echo isset($hc_t_p_preweek)?number_format($hc_t_p_preweek,2).'%':'-'; ?></td>
</tr>

<tr>
<td align="center">LC</td>
<td align="right"></td>
<td align="right"></td>
<td align="right"><?php echo isset($cd_t_preweek)?number_format($cd_t_preweek,2):'-'; ?></td>
<td align="right"><?php echo isset($sb_t_preweek)?number_format($sb_t_preweek,2):'-'; ?></td>
<td align="right"><?php echo isset($snd_t_preweek)?number_format($snd_t_preweek,2):'-'; ?></td>
<td align="right"><?php echo isset($sd_t_preweek)?number_format($sd_t_preweek,2):'-'; ?></td>
<td align="right"><?php echo isset($other_t_preweek)?number_format($other_t_preweek,2):'-'; ?></td>
<td align="right"><?php echo isset($lc_t_preweek)?number_format($lc_t_preweek,2):'-'; ?></td>
<td align="right"></td>
<td align="right"><?php echo isset($lc_t_p_preweek)?number_format($lc_t_p_preweek,2).'%':'-'; ?></td>
</tr>
<!--Total preweek week end -->

</table>
<br/>
<?php 
}
?>