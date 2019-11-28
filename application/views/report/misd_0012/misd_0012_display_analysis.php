<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly Business Trend Analysis Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Monthly Business Trend Analysis Report</td>
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
if(isset($result_array) && !empty($result_array))
{
?>
<table border="1" align="right" style="margin-top: -80px;">
  <tr>
    <td width="80">Report</td>
    <td width="175"><?php echo isset($report_details->report_id)?$report_details->report_id."B":''; ?></td>
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

<table style="margin-right: -872px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1">

<tr>
<td align="center"  style="font-weight: bold;">Indicator/Month</td>
<?php 
$total_arr=array();
for ($m=0; $m<=12; $m++){ 
    $txtR='';
    if(isset($result_array[$m]['current_month']) && $result_array[$m]['current_month']==1 && isset($result_array[$m]['lcd']))
    {
        $txtRR=explode(' ',$result_array[$m]['month_date']);
        $txtR="($txtRR[0])";
        $total_arr=$result_array[$m];;
    }
    
    //pre text
    $preTxt='';
    if($m==0)
    {
        $preTxt='P ';
    }
    
    
     
?>
<td align="center" style="font-weight: bold;"><?php echo $preTxt.$result_array[$m]['month_name'].$txtR; ?></td>
 <?php } ?>
 
 <?php if(!empty($total_arr)) { ?>
 <td align="center" style="font-weight: bold;"><?php echo 'P '.$total_arr['month_name']; ?></td>
 <?php } ?>
</tr>

<!--Deposit start-->
<tr>
<td>Low Cost Deposit</td>
<td align="right"><?php echo isset($result_array[0]['lcd'])?round($result_array[0]['lcd'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['lcd'])?round(($result_array[1]['lcd']-$result_array[0]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['lcd'])?round(($result_array[2]['lcd']-$result_array[1]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['lcd'])?round(($result_array[3]['lcd']-$result_array[2]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['lcd'])?round(($result_array[4]['lcd']-$result_array[3]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['lcd'])?round(($result_array[5]['lcd']-$result_array[4]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['lcd'])?round(($result_array[6]['lcd']-$result_array[5]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['lcd'])?round(($result_array[7]['lcd']-$result_array[6]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['lcd'])?round(($result_array[8]['lcd']-$result_array[7]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['lcd'])?round(($result_array[9]['lcd']-$result_array[8]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['lcd'])?round(($result_array[10]['lcd']-$result_array[9]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['lcd'])?round(($result_array[11]['lcd']-$result_array[10]['lcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['lcd'])?round(($result_array[12]['lcd']-$result_array[11]['lcd']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['lcd'])?round($total_arr['lcd'],2):''; ?></td>
 <?php } ?>

</tr>

<tr>
<td>High Cost Deposit</td>
<td align="right"><?php echo isset($result_array[0]['hcd'])?round($result_array[0]['hcd'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['hcd'])?round(($result_array[1]['hcd']-$result_array[0]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['hcd'])?round(($result_array[2]['hcd']-$result_array[1]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['hcd'])?round(($result_array[3]['hcd']-$result_array[2]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['hcd'])?round(($result_array[4]['hcd']-$result_array[3]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['hcd'])?round(($result_array[5]['hcd']-$result_array[4]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['hcd'])?round(($result_array[6]['hcd']-$result_array[5]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['hcd'])?round(($result_array[7]['hcd']-$result_array[6]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['hcd'])?round(($result_array[8]['hcd']-$result_array[7]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['hcd'])?round(($result_array[9]['hcd']-$result_array[8]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['hcd'])?round(($result_array[10]['hcd']-$result_array[9]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['hcd'])?round(($result_array[11]['hcd']-$result_array[10]['hcd']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['hcd'])?round(($result_array[12]['hcd']-$result_array[11]['hcd']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['hcd'])?round($total_arr['hcd'],2):''; ?></td>
 <?php } ?>

</tr>

<tr>
<td>Total Deposit</td>
<td align="right"><?php echo isset($result_array[0]['total_deposit'])?round($result_array[0]['total_deposit'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['total_deposit'])?round(($result_array[1]['total_deposit']-$result_array[0]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['total_deposit'])?round(($result_array[2]['total_deposit']-$result_array[1]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['total_deposit'])?round(($result_array[3]['total_deposit']-$result_array[2]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['total_deposit'])?round(($result_array[4]['total_deposit']-$result_array[3]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['total_deposit'])?round(($result_array[5]['total_deposit']-$result_array[4]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['total_deposit'])?round(($result_array[6]['total_deposit']-$result_array[5]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['total_deposit'])?round(($result_array[7]['total_deposit']-$result_array[6]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['total_deposit'])?round(($result_array[8]['total_deposit']-$result_array[7]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['total_deposit'])?round(($result_array[9]['total_deposit']-$result_array[8]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['total_deposit'])?round(($result_array[10]['total_deposit']-$result_array[9]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['total_deposit'])?round(($result_array[11]['total_deposit']-$result_array[10]['total_deposit']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['total_deposit'])?round(($result_array[12]['total_deposit']-$result_array[11]['total_deposit']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['total_deposit'])?round($total_arr['total_deposit'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--Deposit End-->


<!--Advance start-->

<tr>
<td>Loan & Advance</td>
<td align="right"><?php echo isset($result_array[0]['advance'])?round($result_array[0]['advance'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['advance'])?round(($result_array[1]['advance']-$result_array[0]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['advance'])?round(($result_array[2]['advance']-$result_array[1]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['advance'])?round(($result_array[3]['advance']-$result_array[2]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['advance'])?round(($result_array[4]['advance']-$result_array[3]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['advance'])?round(($result_array[5]['advance']-$result_array[4]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['advance'])?round(($result_array[6]['advance']-$result_array[5]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['advance'])?round(($result_array[7]['advance']-$result_array[6]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['advance'])?round(($result_array[8]['advance']-$result_array[7]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['advance'])?round(($result_array[9]['advance']-$result_array[8]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['advance'])?round(($result_array[10]['advance']-$result_array[9]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['advance'])?round(($result_array[11]['advance']-$result_array[10]['advance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['advance'])?round(($result_array[12]['advance']-$result_array[11]['advance']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['advance'])?round($total_arr['advance'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--Advance End-->

<!--CL start-->
<tr>
<td>Standard</td>
<td align="right"><?php echo isset($result_array[0]['standard'])?round($result_array[0]['standard'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['standard'])?round(($result_array[1]['standard']-$result_array[0]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['standard'])?round(($result_array[2]['standard']-$result_array[1]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['standard'])?round(($result_array[3]['standard']-$result_array[2]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['standard'])?round(($result_array[4]['standard']-$result_array[3]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['standard'])?round(($result_array[5]['standard']-$result_array[4]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['standard'])?round(($result_array[6]['standard']-$result_array[5]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['standard'])?round(($result_array[7]['standard']-$result_array[6]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['standard'])?round(($result_array[8]['standard']-$result_array[7]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['standard'])?round(($result_array[9]['standard']-$result_array[8]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['standard'])?round(($result_array[10]['standard']-$result_array[9]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['standard'])?round(($result_array[11]['standard']-$result_array[10]['standard']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['standard'])?round(($result_array[12]['standard']-$result_array[11]['standard']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['standard'])?round($total_arr['standard'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>SMA</td>
<td align="right"><?php echo isset($result_array[0]['sma'])?round($result_array[0]['sma'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['sma'])?round(($result_array[1]['sma']-$result_array[0]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['sma'])?round(($result_array[2]['sma']-$result_array[1]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['sma'])?round(($result_array[3]['sma']-$result_array[2]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['sma'])?round(($result_array[4]['sma']-$result_array[3]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['sma'])?round(($result_array[5]['sma']-$result_array[4]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['sma'])?round(($result_array[6]['sma']-$result_array[5]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['sma'])?round(($result_array[7]['sma']-$result_array[6]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['sma'])?round(($result_array[8]['sma']-$result_array[7]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['sma'])?round(($result_array[9]['sma']-$result_array[8]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['sma'])?round(($result_array[10]['sma']-$result_array[9]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['sma'])?round(($result_array[11]['sma']-$result_array[10]['sma']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['sma'])?round(($result_array[12]['sma']-$result_array[11]['sma']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['sma'])?round($total_arr['sma'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>Total UC</td>
<td align="right"><?php echo isset($result_array[0]['uc'])?round($result_array[0]['uc'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['uc'])?round(($result_array[1]['uc']-$result_array[0]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['uc'])?round(($result_array[2]['uc']-$result_array[1]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['uc'])?round(($result_array[3]['uc']-$result_array[2]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['uc'])?round(($result_array[4]['uc']-$result_array[3]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['uc'])?round(($result_array[5]['uc']-$result_array[4]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['uc'])?round(($result_array[6]['uc']-$result_array[5]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['uc'])?round(($result_array[7]['uc']-$result_array[6]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['uc'])?round(($result_array[8]['uc']-$result_array[7]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['uc'])?round(($result_array[9]['uc']-$result_array[8]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['uc'])?round(($result_array[10]['uc']-$result_array[9]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['uc'])?round(($result_array[11]['uc']-$result_array[10]['uc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['uc'])?round(($result_array[12]['uc']-$result_array[11]['uc']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['uc'])?round($total_arr['uc'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>SS</td>
<td align="right"><?php echo isset($result_array[0]['ss'])?round($result_array[0]['ss'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['ss'])?round(($result_array[1]['ss']-$result_array[0]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['ss'])?round(($result_array[2]['ss']-$result_array[1]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['ss'])?round(($result_array[3]['ss']-$result_array[2]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['ss'])?round(($result_array[4]['ss']-$result_array[3]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['ss'])?round(($result_array[5]['ss']-$result_array[4]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['ss'])?round(($result_array[6]['ss']-$result_array[5]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['ss'])?round(($result_array[7]['ss']-$result_array[6]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['ss'])?round(($result_array[8]['ss']-$result_array[7]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['ss'])?round(($result_array[9]['ss']-$result_array[8]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['ss'])?round(($result_array[10]['ss']-$result_array[9]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['ss'])?round(($result_array[11]['ss']-$result_array[10]['ss']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['ss'])?round(($result_array[12]['ss']-$result_array[11]['ss']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['ss'])?round($total_arr['ss'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>DF</td>
<td align="right"><?php echo isset($result_array[0]['df'])?round($result_array[0]['df'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['df'])?round(($result_array[1]['df']-$result_array[0]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['df'])?round(($result_array[2]['df']-$result_array[1]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['df'])?round(($result_array[3]['df']-$result_array[2]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['df'])?round(($result_array[4]['df']-$result_array[3]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['df'])?round(($result_array[5]['df']-$result_array[4]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['df'])?round(($result_array[6]['df']-$result_array[5]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['df'])?round(($result_array[7]['df']-$result_array[6]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['df'])?round(($result_array[8]['df']-$result_array[7]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['df'])?round(($result_array[9]['df']-$result_array[8]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['df'])?round(($result_array[10]['df']-$result_array[9]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['df'])?round(($result_array[11]['df']-$result_array[10]['df']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['df'])?round(($result_array[12]['df']-$result_array[11]['df']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['df'])?round($total_arr['df'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>BL</td>
<td align="right"><?php echo isset($result_array[0]['bl'])?round($result_array[0]['bl'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['bl'])?round(($result_array[1]['bl']-$result_array[0]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['bl'])?round(($result_array[2]['bl']-$result_array[1]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['bl'])?round(($result_array[3]['bl']-$result_array[2]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['bl'])?round(($result_array[4]['bl']-$result_array[3]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['bl'])?round(($result_array[5]['bl']-$result_array[4]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['bl'])?round(($result_array[6]['bl']-$result_array[5]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['bl'])?round(($result_array[7]['bl']-$result_array[6]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['bl'])?round(($result_array[8]['bl']-$result_array[7]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['bl'])?round(($result_array[9]['bl']-$result_array[8]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['bl'])?round(($result_array[10]['bl']-$result_array[9]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['bl'])?round(($result_array[11]['bl']-$result_array[10]['bl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['bl'])?round(($result_array[12]['bl']-$result_array[11]['bl']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['bl'])?round($total_arr['bl'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>Total CL</td>
<td align="right"><?php echo isset($result_array[0]['cl'])?round($result_array[0]['cl'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['cl'])?round(($result_array[1]['cl']-$result_array[0]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['cl'])?round(($result_array[2]['cl']-$result_array[1]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['cl'])?round(($result_array[3]['cl']-$result_array[2]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['cl'])?round(($result_array[4]['cl']-$result_array[3]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['cl'])?round(($result_array[5]['cl']-$result_array[4]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['cl'])?round(($result_array[6]['cl']-$result_array[5]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['cl'])?round(($result_array[7]['cl']-$result_array[6]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['cl'])?round(($result_array[8]['cl']-$result_array[7]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['cl'])?round(($result_array[9]['cl']-$result_array[8]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['cl'])?round(($result_array[10]['cl']-$result_array[9]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['cl'])?round(($result_array[11]['cl']-$result_array[10]['cl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['cl'])?round(($result_array[12]['cl']-$result_array[11]['cl']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['cl'])?round($total_arr['cl'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--CL End-->

<!--CL Recovery start-->
<tr>
<td>Cash Recovery:CL</td>
<td align="right"><?php echo isset($result_array[0]['cl_recovery_1'])?round($result_array[0]['cl_recovery_1'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['cl_recovery_1'])?round(($result_array[1]['cl_recovery_1']-$result_array[0]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['cl_recovery_1'])?round(($result_array[2]['cl_recovery_1']-$result_array[1]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['cl_recovery_1'])?round(($result_array[3]['cl_recovery_1']-$result_array[2]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['cl_recovery_1'])?round(($result_array[4]['cl_recovery_1']-$result_array[3]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['cl_recovery_1'])?round(($result_array[5]['cl_recovery_1']-$result_array[4]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['cl_recovery_1'])?round(($result_array[6]['cl_recovery_1']-$result_array[5]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['cl_recovery_1'])?round(($result_array[7]['cl_recovery_1']-$result_array[6]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['cl_recovery_1'])?round(($result_array[8]['cl_recovery_1']-$result_array[7]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['cl_recovery_1'])?round(($result_array[9]['cl_recovery_1']-$result_array[8]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['cl_recovery_1'])?round(($result_array[10]['cl_recovery_1']-$result_array[9]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['cl_recovery_1'])?round(($result_array[11]['cl_recovery_1']-$result_array[10]['cl_recovery_1']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['cl_recovery_1'])?round(($result_array[12]['cl_recovery_1']-$result_array[11]['cl_recovery_1']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['cl_recovery_1'])?round($total_arr['cl_recovery_1'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>CL Reduction</td>
<td align="right"><?php echo isset($result_array[0]['cl_reduction'])?round($result_array[0]['cl_reduction'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['cl_reduction'])?round(($result_array[1]['cl_reduction']-$result_array[0]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['cl_reduction'])?round(($result_array[2]['cl_reduction']-$result_array[1]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['cl_reduction'])?round(($result_array[3]['cl_reduction']-$result_array[2]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['cl_reduction'])?round(($result_array[4]['cl_reduction']-$result_array[3]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['cl_reduction'])?round(($result_array[5]['cl_reduction']-$result_array[4]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['cl_reduction'])?round(($result_array[6]['cl_reduction']-$result_array[5]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['cl_reduction'])?round(($result_array[7]['cl_reduction']-$result_array[6]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['cl_reduction'])?round(($result_array[8]['cl_reduction']-$result_array[7]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['cl_reduction'])?round(($result_array[9]['cl_reduction']-$result_array[8]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['cl_reduction'])?round(($result_array[10]['cl_reduction']-$result_array[9]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['cl_reduction'])?round(($result_array[11]['cl_reduction']-$result_array[10]['cl_reduction']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['cl_reduction'])?round(($result_array[12]['cl_reduction']-$result_array[11]['cl_reduction']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['cl_reduction'])?round($total_arr['cl_reduction'],2):''; ?></td>
 <?php } ?>
 
</tr>

<tr>
<td>Total Recovery:CL</td>
<td align="right"><?php echo isset($result_array[0]['total_cl_recovery'])?round($result_array[0]['total_cl_recovery'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['total_cl_recovery'])?round(($result_array[1]['total_cl_recovery']-$result_array[0]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['total_cl_recovery'])?round(($result_array[2]['total_cl_recovery']-$result_array[1]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['total_cl_recovery'])?round(($result_array[3]['total_cl_recovery']-$result_array[2]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['total_cl_recovery'])?round(($result_array[4]['total_cl_recovery']-$result_array[3]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['total_cl_recovery'])?round(($result_array[5]['total_cl_recovery']-$result_array[4]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['total_cl_recovery'])?round(($result_array[6]['total_cl_recovery']-$result_array[5]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['total_cl_recovery'])?round(($result_array[7]['total_cl_recovery']-$result_array[6]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['total_cl_recovery'])?round(($result_array[8]['total_cl_recovery']-$result_array[7]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['total_cl_recovery'])?round(($result_array[9]['total_cl_recovery']-$result_array[8]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['total_cl_recovery'])?round(($result_array[10]['total_cl_recovery']-$result_array[9]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['total_cl_recovery'])?round(($result_array[11]['total_cl_recovery']-$result_array[10]['total_cl_recovery']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['total_cl_recovery'])?round(($result_array[12]['total_cl_recovery']-$result_array[11]['total_cl_recovery']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['total_cl_recovery'])?round($total_arr['total_cl_recovery'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--CL Recovery End-->

<!--Cash Recovery(Write Off) start-->
<tr>
<td >Cash Recovery:WO</td>
<td align="right"><?php echo isset($result_array[0]['cash_recovery_wr'])?round($result_array[0]['cash_recovery_wr'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['cash_recovery_wr'])?round(($result_array[1]['cash_recovery_wr']-$result_array[0]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['cash_recovery_wr'])?round(($result_array[2]['cash_recovery_wr']-$result_array[1]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['cash_recovery_wr'])?round(($result_array[3]['cash_recovery_wr']-$result_array[2]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['cash_recovery_wr'])?round(($result_array[4]['cash_recovery_wr']-$result_array[3]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['cash_recovery_wr'])?round(($result_array[5]['cash_recovery_wr']-$result_array[4]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['cash_recovery_wr'])?round(($result_array[6]['cash_recovery_wr']-$result_array[5]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['cash_recovery_wr'])?round(($result_array[7]['cash_recovery_wr']-$result_array[6]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['cash_recovery_wr'])?round(($result_array[8]['cash_recovery_wr']-$result_array[7]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['cash_recovery_wr'])?round(($result_array[9]['cash_recovery_wr']-$result_array[8]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['cash_recovery_wr'])?round(($result_array[10]['cash_recovery_wr']-$result_array[9]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['cash_recovery_wr'])?round(($result_array[11]['cash_recovery_wr']-$result_array[10]['cash_recovery_wr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['cash_recovery_wr'])?round(($result_array[12]['cash_recovery_wr']-$result_array[11]['cash_recovery_wr']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['cash_recovery_wr'])?round($total_arr['cash_recovery_wr'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--Cash Recovery(Write Off) End-->

<!--Foreign remittance start-->
<tr>
<td >Foreign Remittance</td>
<td align="right"><?php echo isset($result_array[0]['foreign_remittance'])?round($result_array[0]['foreign_remittance'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['foreign_remittance'])?round(($result_array[1]['foreign_remittance']-$result_array[0]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['foreign_remittance'])?round(($result_array[2]['foreign_remittance']-$result_array[1]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['foreign_remittance'])?round(($result_array[3]['foreign_remittance']-$result_array[2]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['foreign_remittance'])?round(($result_array[4]['foreign_remittance']-$result_array[3]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['foreign_remittance'])?round(($result_array[5]['foreign_remittance']-$result_array[4]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['foreign_remittance'])?round(($result_array[6]['foreign_remittance']-$result_array[5]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['foreign_remittance'])?round(($result_array[7]['foreign_remittance']-$result_array[6]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['foreign_remittance'])?round(($result_array[8]['foreign_remittance']-$result_array[7]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['foreign_remittance'])?round(($result_array[9]['foreign_remittance']-$result_array[8]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['foreign_remittance'])?round(($result_array[10]['foreign_remittance']-$result_array[9]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['foreign_remittance'])?round(($result_array[11]['foreign_remittance']-$result_array[10]['foreign_remittance']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['foreign_remittance'])?round(($result_array[12]['foreign_remittance']-$result_array[11]['foreign_remittance']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['foreign_remittance'])?round($total_arr['foreign_remittance'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--Foreign remittance End-->

<!--Non intt. start-->
<tr>
<td >Non Intt. Income</td>
<td align="right"><?php echo isset($result_array[0]['non_intt_income'])?round($result_array[0]['non_intt_income'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['non_intt_income'])?round(($result_array[1]['non_intt_income']-$result_array[0]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['non_intt_income'])?round(($result_array[2]['non_intt_income']-$result_array[1]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['non_intt_income'])?round(($result_array[3]['non_intt_income']-$result_array[2]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['non_intt_income'])?round(($result_array[4]['non_intt_income']-$result_array[3]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['non_intt_income'])?round(($result_array[5]['non_intt_income']-$result_array[4]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['non_intt_income'])?round(($result_array[6]['non_intt_income']-$result_array[5]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['non_intt_income'])?round(($result_array[7]['non_intt_income']-$result_array[6]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['non_intt_income'])?round(($result_array[8]['non_intt_income']-$result_array[7]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['non_intt_income'])?round(($result_array[9]['non_intt_income']-$result_array[8]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['non_intt_income'])?round(($result_array[10]['non_intt_income']-$result_array[9]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['non_intt_income'])?round(($result_array[11]['non_intt_income']-$result_array[10]['non_intt_income']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['non_intt_income'])?round(($result_array[12]['non_intt_income']-$result_array[11]['non_intt_income']),2):''; ?></td>


 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['non_intt_income'])?round($total_arr['non_intt_income'],2):''; ?></td>
 <?php } ?>
 
 </tr>

<!--Non intt. End-->

<!--Export start-->
<tr>
<td >Export</td>
<td align="right"><?php echo isset($result_array[0]['export'])?round($result_array[0]['export'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['export'])?round(($result_array[1]['export']-$result_array[0]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['export'])?round(($result_array[2]['export']-$result_array[1]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['export'])?round(($result_array[3]['export']-$result_array[2]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['export'])?round(($result_array[4]['export']-$result_array[3]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['export'])?round(($result_array[5]['export']-$result_array[4]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['export'])?round(($result_array[6]['export']-$result_array[5]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['export'])?round(($result_array[7]['export']-$result_array[6]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['export'])?round(($result_array[8]['export']-$result_array[7]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['export'])?round(($result_array[9]['export']-$result_array[8]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['export'])?round(($result_array[10]['export']-$result_array[9]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['export'])?round(($result_array[11]['export']-$result_array[10]['export']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['export'])?round(($result_array[12]['export']-$result_array[11]['export']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['export'])?round($total_arr['export'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--Export End-->

<!--Import start-->
<tr>
<td >Import</td>
<td align="right"><?php echo isset($result_array[0]['import'])?round($result_array[0]['import'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['import'])?round(($result_array[1]['import']-$result_array[0]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['import'])?round(($result_array[2]['import']-$result_array[1]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['import'])?round(($result_array[3]['import']-$result_array[2]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['import'])?round(($result_array[4]['import']-$result_array[3]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['import'])?round(($result_array[5]['import']-$result_array[4]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['import'])?round(($result_array[6]['import']-$result_array[5]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['import'])?round(($result_array[7]['import']-$result_array[6]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['import'])?round(($result_array[8]['import']-$result_array[7]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['import'])?round(($result_array[9]['import']-$result_array[8]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['import'])?round(($result_array[10]['import']-$result_array[9]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['import'])?round(($result_array[11]['import']-$result_array[10]['import']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['import'])?round(($result_array[12]['import']-$result_array[11]['import']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['import'])?round($total_arr['import'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--Import End-->

<!--PL start-->
<tr>
<td >PL</td>
<td align="right"><?php echo isset($result_array[0]['pl'])?round($result_array[0]['pl'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['pl'])?round(($result_array[1]['pl']-$result_array[0]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['pl'])?round(($result_array[2]['pl']-$result_array[1]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['pl'])?round(($result_array[3]['pl']-$result_array[2]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['pl'])?round(($result_array[4]['pl']-$result_array[3]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['pl'])?round(($result_array[5]['pl']-$result_array[4]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['pl'])?round(($result_array[6]['pl']-$result_array[5]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['pl'])?round(($result_array[7]['pl']-$result_array[6]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['pl'])?round(($result_array[8]['pl']-$result_array[7]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['pl'])?round(($result_array[9]['pl']-$result_array[8]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['pl'])?round(($result_array[10]['pl']-$result_array[9]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['pl'])?round(($result_array[11]['pl']-$result_array[10]['pl']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['pl'])?round(($result_array[12]['pl']-$result_array[11]['pl']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['pl'])?round($total_arr['pl'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--PL End-->

<!--SME start-->
<tr>
<td >SME Loan</td>
<td align="right"><?php echo isset($result_array[0]['sme'])?round($result_array[0]['sme'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['sme'])?round(($result_array[1]['sme']-$result_array[0]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['sme'])?round(($result_array[2]['sme']-$result_array[1]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['sme'])?round(($result_array[3]['sme']-$result_array[2]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['sme'])?round(($result_array[4]['sme']-$result_array[3]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['sme'])?round(($result_array[5]['sme']-$result_array[4]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['sme'])?round(($result_array[6]['sme']-$result_array[5]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['sme'])?round(($result_array[7]['sme']-$result_array[6]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['sme'])?round(($result_array[8]['sme']-$result_array[7]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['sme'])?round(($result_array[9]['sme']-$result_array[8]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['sme'])?round(($result_array[10]['sme']-$result_array[9]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['sme'])?round(($result_array[11]['sme']-$result_array[10]['sme']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['sme'])?round(($result_array[12]['sme']-$result_array[11]['sme']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['sme'])?round($total_arr['sme'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--SME End-->

<!--LDBP start-->
<tr>
<td >LDBP</td>
<td align="right"><?php echo isset($result_array[0]['ldbp'])?round($result_array[0]['ldbp'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['ldbp'])?round(($result_array[1]['ldbp']-$result_array[0]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['ldbp'])?round(($result_array[2]['ldbp']-$result_array[1]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['ldbp'])?round(($result_array[3]['ldbp']-$result_array[2]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['ldbp'])?round(($result_array[4]['ldbp']-$result_array[3]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['ldbp'])?round(($result_array[5]['ldbp']-$result_array[4]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['ldbp'])?round(($result_array[6]['ldbp']-$result_array[5]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['ldbp'])?round(($result_array[7]['ldbp']-$result_array[6]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['ldbp'])?round(($result_array[8]['ldbp']-$result_array[7]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['ldbp'])?round(($result_array[9]['ldbp']-$result_array[8]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['ldbp'])?round(($result_array[10]['ldbp']-$result_array[9]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['ldbp'])?round(($result_array[11]['ldbp']-$result_array[10]['ldbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['ldbp'])?round(($result_array[12]['ldbp']-$result_array[11]['ldbp']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['ldbp'])?round($total_arr['ldbp'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--LDBP End-->

<!--FDBP start-->
<tr>
<td >FDBP</td>
<td align="right"><?php echo isset($result_array[0]['fdbp'])?round($result_array[0]['fdbp'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['fdbp'])?round(($result_array[1]['fdbp']-$result_array[0]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['fdbp'])?round(($result_array[2]['fdbp']-$result_array[1]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['fdbp'])?round(($result_array[3]['fdbp']-$result_array[2]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['fdbp'])?round(($result_array[4]['fdbp']-$result_array[3]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['fdbp'])?round(($result_array[5]['fdbp']-$result_array[4]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['fdbp'])?round(($result_array[6]['fdbp']-$result_array[5]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['fdbp'])?round(($result_array[7]['fdbp']-$result_array[6]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['fdbp'])?round(($result_array[8]['fdbp']-$result_array[7]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['fdbp'])?round(($result_array[9]['fdbp']-$result_array[8]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['fdbp'])?round(($result_array[10]['fdbp']-$result_array[9]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['fdbp'])?round(($result_array[11]['fdbp']-$result_array[10]['fdbp']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['fdbp'])?round(($result_array[12]['fdbp']-$result_array[11]['fdbp']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['fdbp'])?round($total_arr['fdbp'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--FDBP End-->

<!--LTR start-->
<tr>
<td >LTR</td>
<td align="right"><?php echo isset($result_array[0]['ltr'])?round($result_array[0]['ltr'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['ltr'])?round(($result_array[1]['ltr']-$result_array[0]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['ltr'])?round(($result_array[2]['ltr']-$result_array[1]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['ltr'])?round(($result_array[3]['ltr']-$result_array[2]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['ltr'])?round(($result_array[4]['ltr']-$result_array[3]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['ltr'])?round(($result_array[5]['ltr']-$result_array[4]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['ltr'])?round(($result_array[6]['ltr']-$result_array[5]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['ltr'])?round(($result_array[7]['ltr']-$result_array[6]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['ltr'])?round(($result_array[8]['ltr']-$result_array[7]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['ltr'])?round(($result_array[9]['ltr']-$result_array[8]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['ltr'])?round(($result_array[10]['ltr']-$result_array[9]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['ltr'])?round(($result_array[11]['ltr']-$result_array[10]['ltr']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['ltr'])?round(($result_array[12]['ltr']-$result_array[11]['ltr']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['ltr'])?round($total_arr['ltr'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--LTR End-->

<!--PAD start-->
<tr>
<td >PAD</td>
<td align="right"><?php echo isset($result_array[0]['pad'])?round($result_array[0]['pad'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['pad'])?round(($result_array[1]['pad']-$result_array[0]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['pad'])?round(($result_array[2]['pad']-$result_array[1]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['pad'])?round(($result_array[3]['pad']-$result_array[2]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['pad'])?round(($result_array[4]['pad']-$result_array[3]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['pad'])?round(($result_array[5]['pad']-$result_array[4]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['pad'])?round(($result_array[6]['pad']-$result_array[5]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['pad'])?round(($result_array[7]['pad']-$result_array[6]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['pad'])?round(($result_array[8]['pad']-$result_array[7]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['pad'])?round(($result_array[9]['pad']-$result_array[8]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['pad'])?round(($result_array[10]['pad']-$result_array[9]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['pad'])?round(($result_array[11]['pad']-$result_array[10]['pad']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['pad'])?round(($result_array[12]['pad']-$result_array[11]['pad']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['pad'])?round($total_arr['pad'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--PAD End-->

<!--LIM start-->
<tr>
<td >LIM</td>
<td align="right"><?php echo isset($result_array[0]['lim'])?round($result_array[0]['lim'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['lim'])?round(($result_array[1]['lim']-$result_array[0]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['lim'])?round(($result_array[2]['lim']-$result_array[1]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['lim'])?round(($result_array[3]['lim']-$result_array[2]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['lim'])?round(($result_array[4]['lim']-$result_array[3]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['lim'])?round(($result_array[5]['lim']-$result_array[4]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['lim'])?round(($result_array[6]['lim']-$result_array[5]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['lim'])?round(($result_array[7]['lim']-$result_array[6]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['lim'])?round(($result_array[8]['lim']-$result_array[7]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['lim'])?round(($result_array[9]['lim']-$result_array[8]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['lim'])?round(($result_array[10]['lim']-$result_array[9]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['lim'])?round(($result_array[11]['lim']-$result_array[10]['lim']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['lim'])?round(($result_array[12]['lim']-$result_array[11]['lim']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['lim'])?round($total_arr['lim'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--LIM End-->

<!--PC start-->
<tr>
<td >PC</td>
<td align="right"><?php echo isset($result_array[0]['pc'])?round($result_array[0]['pc'],2):''; ?></td>
<td align="right"><?php echo isset($result_array[1]['pc'])?round(($result_array[1]['pc']-$result_array[0]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[2]['pc'])?round(($result_array[2]['pc']-$result_array[1]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[3]['pc'])?round(($result_array[3]['pc']-$result_array[2]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[4]['pc'])?round(($result_array[4]['pc']-$result_array[3]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[5]['pc'])?round(($result_array[5]['pc']-$result_array[4]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[6]['pc'])?round(($result_array[6]['pc']-$result_array[5]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[7]['pc'])?round(($result_array[7]['pc']-$result_array[6]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[8]['pc'])?round(($result_array[8]['pc']-$result_array[7]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[9]['pc'])?round(($result_array[9]['pc']-$result_array[8]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[10]['pc'])?round(($result_array[10]['pc']-$result_array[9]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[11]['pc'])?round(($result_array[11]['pc']-$result_array[10]['pc']),2):''; ?></td>
<td align="right"><?php echo isset($result_array[12]['pc'])?round(($result_array[12]['pc']-$result_array[11]['pc']),2):''; ?></td>

 <?php if(!empty($total_arr)) { ?>
 <td align="right"><?php echo isset($total_arr['pc'])?round($total_arr['pc'],2):''; ?></td>
 <?php } ?>
 
</tr>

<!--PC End-->



</table>
<br/>
<?php 

    echo form_open('report/misd_0012_report_details/1');
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
