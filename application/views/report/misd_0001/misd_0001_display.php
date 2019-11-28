<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly Performance Display</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Monthly Performance Report</td>
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
if(isset($result_array) && !empty($result_array))
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
<table style="margin-right: -775px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1">
	<tr>
		<td rowspan="2" align="center" width="40">Sl</td>
		<td rowspan="2" width="250" align="center">Indicator</td>
		<td align="center">Achievement of</td>
		<td align="center">Target of</td>
		<td colspan="3" align="center">Proportionate of <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td rowspan="2" width="50" align="center">Achievement upto <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td rowspan="2" width="100" align="center" align="center">Difference of Achievement between <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> and <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td rowspan="2" align="center" width="350">Remarks  </td>
	</tr>
	<tr>
		<td align="center"><?php echo isset($report_of_year)?($report_of_year-1):''; ?></td>
		<td align="center"><?php echo isset($report_of_year)?($report_of_year):''; ?></td>
		<td align="center">Target</td>
		<td align="center" width="100">Achievement Amount</td>
		<td align="center">Achievement %</td>
	</tr>
	<tr>
		<td align="center">1</td>
		<td align="center">2</td>
		<td align="center">3</td>
		<td align="center">4</td>
		<td align="center">5</td>
		<td align="center">6</td>
		<td align="center">7</td>
		<td align="center">8</td>
		<td align="center">9</td>
		<td align="center">10</td>
	</tr>
	<tr>
		<td align="center">1</td>
		<td align="left">Deposit</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['deposit'])?round($result_array['last_day_year']['deposit']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['deposit'])?round($result_array['target']['deposit']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['deposit'])?round($result_array['proportional_target']['deposit']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['deposit'])?round($result_array['present_acheivement']['deposit']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['deposit'])?round($result_array['acheivement_percentage']['deposit'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['deposit'])?round($result_array['pre_yr_status']['deposit']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['deposit'])?round($result_array['fetch_dif_pre_present']['deposit']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['deposit'])?$result_array['remarks']['deposit']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">2</td>
		<td align="left">Advance</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['advance'])?round($result_array['last_day_year']['advance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['advance'])?round($result_array['target']['advance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['advance'])?round($result_array['proportional_target']['advance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['advance'])?round($result_array['present_acheivement']['advance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['advance'])?round($result_array['acheivement_percentage']['advance'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['advance'])?round($result_array['pre_yr_status']['advance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['advance'])?round($result_array['fetch_dif_pre_present']['advance']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['advance'])?$result_array['remarks']['advance']:'-'; ?></td>
	</tr>

	<tr>
		<td align="center">3</td>
		<td align="left">CL Amount</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['CL_amount'])?round($result_array['last_day_year']['CL_amount']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['CL_amount'])?round($result_array['target']['CL_amount']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['CL_amount'])?round($result_array['proportional_target']['CL_amount']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['CL_amount'])?round($result_array['present_acheivement']['CL_amount']/10000000,2):'-'; ?></td>
		<td align="right">-</td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['CL_amount'])?round($result_array['pre_yr_status']['CL_amount']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['CL_amount'])?round($result_array['fetch_dif_pre_present']['CL_amount']/10000000,2):'-'; ?></td>
		<td align="left">-</td>
	</tr>

	<tr>
		<td align="center">4</td>
		<td align="left">CL %</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['CL_%'])?round($result_array['last_day_year']['CL_%'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['CL_%'])?round($result_array['target']['CL_%'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['CL_%'])?round($result_array['proportional_target']['CL_%'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['CL_%'])?round($result_array['present_acheivement']['CL_%'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['CL_%'])?round($result_array['acheivement_percentage']['CL_%'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['CL_%'])?round($result_array['pre_yr_status']['CL_%'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['CL_%'])?round($result_array['fetch_dif_pre_present']['CL_%'],2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['CL_%'])?$result_array['remarks']['CL_%']:'-'; ?></td>
	</tr>

	<tr>
		<td align="center">5</td>
		<td align="left">CL Recovery (Cash)</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['CL_recovery_cash'])?round($result_array['last_day_year']['CL_recovery_cash']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['CL_recovery_cash'])?round($result_array['target']['CL_recovery_cash']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['CL_recovery_cash'])?round($result_array['proportional_target']['CL_recovery_cash']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['CL_recovery_cash'])?round($result_array['present_acheivement']['CL_recovery_cash']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['CL_recovery_cash'])?round($result_array['acheivement_percentage']['CL_recovery_cash'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['CL_recovery_cash'])?round($result_array['pre_yr_status']['CL_recovery_cash']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['CL_recovery_cash'])?round($result_array['fetch_dif_pre_present']['CL_recovery_cash']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['CL_recovery_cash'])?$result_array['remarks']['CL_recovery_cash']:''; ?></td>
	</tr>
	<tr>
		<td align="center">6</td>
		<td align="left">CL Reduction(Reschedule)</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['CL_reduction_reschedule'])?round($result_array['last_day_year']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['CL_reduction_reschedule'])?round($result_array['target']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['CL_reduction_reschedule'])?round($result_array['proportional_target']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['CL_reduction_reschedule'])?round($result_array['present_acheivement']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['CL_reduction_reschedule'])?round($result_array['acheivement_percentage']['CL_reduction_reschedule'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['CL_reduction_reschedule'])?round($result_array['pre_yr_status']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['CL_reduction_reschedule'])?round($result_array['fetch_dif_pre_present']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['CL_reduction_reschedule'])?$result_array['remarks']['CL_reduction_reschedule']:''; ?></td>
	</tr>
	<tr>
		<td align="center">7</td>
		<td align="left">CL Reduction(Interest Waiver)</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['CL_reduction_interest_waiver'])?round($result_array['last_day_year']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['CL_reduction_interest_waiver'])?round($result_array['target']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['CL_reduction_interest_waiver'])?round($result_array['proportional_target']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['CL_reduction_interest_waiver'])?round($result_array['present_acheivement']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['CL_reduction_interest_waiver'])?round($result_array['acheivement_percentage']['CL_reduction_interest_waiver'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['CL_reduction_interest_waiver'])?round($result_array['pre_yr_status']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['CL_reduction_interest_waiver'])?round($result_array['fetch_dif_pre_present']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['CL_reduction_interest_waiver'])?$result_array['remarks']['CL_reduction_interest_waiver']:''; ?></td>
	</tr>
	<tr>
		<td align="center">8</td>
		<td align="left">CL Reduction(Write Off)</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['CL_reduction_write_off'])?round($result_array['last_day_year']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['CL_reduction_write_off'])?round($result_array['target']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['CL_reduction_write_off'])?round($result_array['proportional_target']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['CL_reduction_write_off'])?round($result_array['present_acheivement']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['CL_reduction_write_off'])?round($result_array['acheivement_percentage']['CL_reduction_write_off'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['CL_reduction_write_off'])?round($result_array['pre_yr_status']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['CL_reduction_write_off'])?round($result_array['fetch_dif_pre_present']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['CL_reduction_write_off'])?$result_array['remarks']['CL_reduction_write_off']:''; ?></td>
	</tr>
	<tr>
		<td align="center"></td>
		<td align="left">Total CL Recovery(5+6+7+8)</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['CL_recovery_total'])?round($result_array['last_day_year']['CL_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['CL_recovery_total'])?round($result_array['target']['CL_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['CL_recovery_total'])?round($result_array['proportional_target']['CL_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['CL_recovery_total'])?round($result_array['present_acheivement']['CL_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['CL_recovery_total'])?round($result_array['acheivement_percentage']['CL_recovery_total'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['CL_recovery_total'])?round($result_array['pre_yr_status']['CL_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['CL_recovery_total'])?round($result_array['fetch_dif_pre_present']['CL_recovery_total']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['CL_recovery_total'])?$result_array['remarks']['CL_recovery_total']:''; ?></td>
	</tr>
	<tr>
		<td align="center">9</td>
		<td align="left">Cash Recovery(Write Off)</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['cash_recovery_write_off'])?round($result_array['last_day_year']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['cash_recovery_write_off'])?round($result_array['target']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['cash_recovery_write_off'])?round($result_array['proportional_target']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['cash_recovery_write_off'])?round($result_array['present_acheivement']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['cash_recovery_write_off'])?round($result_array['acheivement_percentage']['cash_recovery_write_off'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['cash_recovery_write_off'])?round($result_array['pre_yr_status']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['cash_recovery_write_off'])?round($result_array['fetch_dif_pre_present']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['cash_recovery_write_off'])?$result_array['remarks']['cash_recovery_write_off']:''; ?></td>
	</tr>
	<tr>
		<td align="center"></td>
		<td align="left">Total Cash Recovery(5+9)</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['cash_recovery_total'])?round($result_array['last_day_year']['cash_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['cash_recovery_total'])?round($result_array['target']['cash_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['cash_recovery_total'])?round($result_array['proportional_target']['cash_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['cash_recovery_total'])?round($result_array['present_acheivement']['cash_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['cash_recovery_total'])?round($result_array['acheivement_percentage']['cash_recovery_total'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['cash_recovery_total'])?round($result_array['pre_yr_status']['cash_recovery_total']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['cash_recovery_total'])?round($result_array['fetch_dif_pre_present']['cash_recovery_total']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['cash_recovery_total'])?$result_array['remarks']['cash_recovery_total']:''; ?></td>
	</tr>
	<tr>
		<td align="center">10</td>
		<td align="left">Export</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['export'])?round($result_array['last_day_year']['export']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['export'])?round($result_array['target']['export']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['export'])?round($result_array['proportional_target']['export']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['export'])?round($result_array['present_acheivement']['export']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['export'])?round($result_array['acheivement_percentage']['export'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['export'])?round($result_array['pre_yr_status']['export']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['export'])?round($result_array['fetch_dif_pre_present']['export']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['export'])?$result_array['remarks']['export']:''; ?></td>
	</tr>
	<tr>
		<td align="center">11</td>
		<td align="left">Import</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['import'])?round($result_array['last_day_year']['import']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['import'])?round($result_array['target']['import']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['import'])?round($result_array['proportional_target']['import']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['import'])?round($result_array['present_acheivement']['import']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['import'])?round($result_array['acheivement_percentage']['import'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['import'])?round($result_array['pre_yr_status']['import']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['import'])?round($result_array['fetch_dif_pre_present']['import']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['import'])?$result_array['remarks']['import']:''; ?></td>
	</tr>
	<tr>
		<td align="center">12</td>
		<td align="left">Foreign Remittance</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['foreign_remittance'])?round($result_array['last_day_year']['foreign_remittance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['foreign_remittance'])?round($result_array['target']['foreign_remittance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['foreign_remittance'])?round($result_array['proportional_target']['foreign_remittance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['foreign_remittance'])?round($result_array['present_acheivement']['foreign_remittance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['foreign_remittance'])?round($result_array['acheivement_percentage']['foreign_remittance'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['foreign_remittance'])?round($result_array['pre_yr_status']['foreign_remittance']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['foreign_remittance'])?round($result_array['fetch_dif_pre_present']['foreign_remittance']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['foreign_remittance'])?$result_array['remarks']['foreign_remittance']:''; ?></td>
	</tr>
	<tr>
		<td align="center">13</td>
		<td align="left">Non Interest Income</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['non_intt_income'])?round($result_array['last_day_year']['non_intt_income']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['non_intt_income'])?round($result_array['target']['non_intt_income']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['non_intt_income'])?round($result_array['proportional_target']['non_intt_income']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['non_intt_income'])?round($result_array['present_acheivement']['non_intt_income']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['non_intt_income'])?round($result_array['acheivement_percentage']['non_intt_income'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['non_intt_income'])?round($result_array['pre_yr_status']['non_intt_income']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['non_intt_income'])?round($result_array['fetch_dif_pre_present']['non_intt_income']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['non_intt_income'])?$result_array['remarks']['non_intt_income']:''; ?></td>
	</tr>
	<tr>
		<td align="center">14</td>
		<td align="left">Profit/Loss</td>
		<td align="right"><?php echo isset($result_array['last_day_year']['pl'])?round($result_array['last_day_year']['pl']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['target']['pl'])?round($result_array['target']['pl']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['proportional_target']['pl'])?round($result_array['proportional_target']['pl']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['present_acheivement']['pl'])?round($result_array['present_acheivement']['pl']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['acheivement_percentage']['pl'])?round($result_array['acheivement_percentage']['pl'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['pre_yr_status']['pl'])?round($result_array['pre_yr_status']['pl']/10000000,2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['fetch_dif_pre_present']['pl'])?round($result_array['fetch_dif_pre_present']['pl']/10000000,2):'-'; ?></td>
		<td align="left"><?php echo isset($result_array['remarks']['pl'])?$result_array['remarks']['pl']:''; ?></td>
	</tr>

</table>
<br/>
<?php 

    echo form_open('report/misd_0001_report_details/1');
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
