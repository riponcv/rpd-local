<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Performance Progress Report (PPR)</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Performance Progress Report (PPR)</td>
  </tr>
  <tr>
  <?php $month_array=array('03'=>'1st Quarter','06'=>'2nd Quarter','09'=>'3rd Quarter','12'=>'4th Quarter'); ?>
    <td align="center" >For <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
if(isset($result_array['report_val']) && !empty($result_array['report_val']) && ((isset($result_array['report_val']['DPCurrentMonthAchivement']) && $result_array['report_val']['DPCurrentMonthAchivement']>0)||(isset($result_array['report_val']['ADCurrentMonthAchivement']) && $result_array['report_val']['ADCurrentMonthAchivement']>0)))
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
    <td width="175">MISD JBL HO Dhaka</td>
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
		<td rowspan="2" width="100" align="center">Achievement upto <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td rowspan="2" width="150" align="center" align="center">Difference of Achievement between <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> and <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td rowspan="2" align="center" width="140">Remarks  </td>
	</tr>
	<tr>
		<td align="center"><?php echo isset($report_of_year)?($report_of_year-1):''; ?></td>
		<td align="center"><?php echo isset($report_of_year)?($report_of_year):''; ?></td>
		<td align="center">Target</td>
		<td align="center" width="100">Achievement</td>
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
		<td align="left">Deposit (With BP)</td>
		<td align="right"><?php echo isset($result_array['report_val']['DPLastYearAchivement'])?round($result_array['report_val']['DPLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['DPTargetCurrentYear'])?round($result_array['report_val']['DPTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['DPProportionateTarget'])?round($result_array['report_val']['DPProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['DPCurrentMonthAchivement'])?round($result_array['report_val']['DPCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['DPAchivementPercentage'])?round($result_array['report_val']['DPAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['DPPreviousYearSameMonthAchievement'])?round($result_array['report_val']['DPPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['DPPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['DPCurrentMonthAchivement']-$result_array['report_val']['DPPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['DPRemarks'])?$result_array['report_val']['DPRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">2</td>
		<td align="left">Advance</td>
        <td align="right"><?php echo isset($result_array['report_val']['ADLastYearAchivement'])?round($result_array['report_val']['ADLastYearAchivement'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['ADTargetCurrentYear'])?round($result_array['report_val']['ADTargetCurrentYear'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['ADProportionateTarget'])?round($result_array['report_val']['ADProportionateTarget'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['ADCurrentMonthAchivement'])?round($result_array['report_val']['ADCurrentMonthAchivement'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['ADAchivementPercentage'])?round($result_array['report_val']['ADAchivementPercentage'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['ADPreviousYearSameMonthAchievement'])?round($result_array['report_val']['ADPreviousYearSameMonthAchievement'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['ADPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['ADCurrentMonthAchivement']-$result_array['report_val']['ADPreviousYearSameMonthAchievement']),2):'-'; ?></td>
        <td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['ADRemarks'])?$result_array['report_val']['ADRemarks']:'-'; ?></td>
	</tr>

	<tr>
		<td align="center">3</td>
		<td align="left">CL Amount</td>
        <td align="right"><?php echo isset($result_array['report_val']['CLLastYearAchivement'])?round($result_array['report_val']['CLLastYearAchivement'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['CLTargetCurrentYear'])?round($result_array['report_val']['CLTargetCurrentYear'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['CLProportionateTarget'])?round($result_array['report_val']['CLProportionateTarget'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['CLCurrentMonthAchivement'])?round($result_array['report_val']['CLCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right">-</td>
        <td align="right"><?php echo isset($result_array['report_val']['CLPreviousYearSameMonthAchievement'])?round($result_array['report_val']['CLPreviousYearSameMonthAchievement'],2):'-'; ?></td>
        <td align="right"><?php echo isset($result_array['report_val']['CLPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['CLCurrentMonthAchivement']-$result_array['report_val']['CLPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;">-</td>
	</tr>

	<tr>
		<td align="center">4</td>
		<td align="left">CL %</td>
		<td align="right"><?php echo isset($result_array['report_val']['CL%LastYearAchivement'])?round($result_array['report_val']['CL%LastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['CL%TargetCurrentYear'])?round($result_array['report_val']['CL%TargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['CL%ProportionateTarget'])?round($result_array['report_val']['CL%ProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['CL%AchivementPercentage'])?round($result_array['report_val']['CL%AchivementPercentage'],2):'-'; ?></td>
		<td align="right">-</td>
		<td align="right"><?php echo isset($result_array['report_val']['CL%PreviousYearSameMonthAchievement'])?round($result_array['report_val']['CL%PreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right">-</td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['CL%Remarks'])?$result_array['report_val']['CL%Remarks']:'-'; ?></td>
	</tr>

	<tr>
		<td align="center">5</td>
		<td align="left">CL Recovery (Cash)</td>
		<td align="right"><?php echo isset($result_array['report_val']['RCLastYearAchivement'])?round($result_array['report_val']['RCLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RCTargetCurrentYear'])?round($result_array['report_val']['RCTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RCProportionateTarget'])?round($result_array['report_val']['RCProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RCCurrentMonthAchivement'])?round($result_array['report_val']['RCCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RCAchivementPercentage'])?round($result_array['report_val']['RCAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RCPreviousYearSameMonthAchievement'])?round($result_array['report_val']['RCPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RCPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['RCCurrentMonthAchivement']-$result_array['report_val']['RCPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['RCRemarks'])?$result_array['report_val']['RCRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">6</td>
		<td align="left">CL Reduction(Reschedule)</td>
		<td align="right"><?php echo isset($result_array['report_val']['RRLastYearAchivement'])?round($result_array['report_val']['RRLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RRTargetCurrentYear'])?round($result_array['report_val']['RRTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RRProportionateTarget'])?round($result_array['report_val']['RRProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RRCurrentMonthAchivement'])?round($result_array['report_val']['RRCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RRAchivementPercentage'])?round($result_array['report_val']['RRAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RRPreviousYearSameMonthAchievement'])?round($result_array['report_val']['RRPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RRPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['RRCurrentMonthAchivement']-$result_array['report_val']['RRPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['RRRemarks'])?$result_array['report_val']['RRRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">7</td>
		<td align="left">CL Reduction(Interest Waiver)</td>
        <td align="right"><?php echo isset($result_array['report_val']['RILastYearAchivement'])?round($result_array['report_val']['RILastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RITargetCurrentYear'])?round($result_array['report_val']['RITargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RIProportionateTarget'])?round($result_array['report_val']['RIProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RICurrentMonthAchivement'])?round($result_array['report_val']['RICurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RIAchivementPercentage'])?round($result_array['report_val']['RIAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RIPreviousYearSameMonthAchievement'])?round($result_array['report_val']['RIPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RIPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['RICurrentMonthAchivement']-$result_array['report_val']['RIPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['RIRemarks'])?$result_array['report_val']['RIRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">8</td>
		<td align="left">CL Reduction(Write Off)</td>
		<td align="right"><?php echo isset($result_array['report_val']['RWLastYearAchivement'])?round($result_array['report_val']['RWLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RWTargetCurrentYear'])?round($result_array['report_val']['RWTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RWProportionateTarget'])?round($result_array['report_val']['RWProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RWCurrentMonthAchivement'])?round($result_array['report_val']['RWCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RWAchivementPercentage'])?round($result_array['report_val']['RWAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RWPreviousYearSameMonthAchievement'])?round($result_array['report_val']['RWPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RWPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['RWCurrentMonthAchivement']-$result_array['report_val']['RWPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['RWRemarks'])?$result_array['report_val']['RWRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center"></td>
		<td align="left">Total CL Recovery(5+6+7+8)</td>
		<td align="right"><?php echo isset($result_array['report_val']['TCLRLastYearAchivement'])?round($result_array['report_val']['TCLRLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCLRTargetCurrentYear'])?round($result_array['report_val']['TCLRTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCLRProportionateTarget'])?round($result_array['report_val']['TCLRProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCLRCurrentMonthAchivement'])?round($result_array['report_val']['TCLRCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCLRAchivementPercentage'])?round($result_array['report_val']['TCLRAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCLRPreviousYearSameMonthAchievement'])?round($result_array['report_val']['TCLRPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCLRPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['TCLRCurrentMonthAchivement']-$result_array['report_val']['TCLRPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['TCLRRemarks'])?$result_array['report_val']['TCLRRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">9</td>
		<td align="left">Cash Recovery(Write Off)</td>
				<td align="right"><?php echo isset($result_array['report_val']['RFROMWLastYearAchivement'])?round($result_array['report_val']['RFROMWLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RFROMWTargetCurrentYear'])?round($result_array['report_val']['RFROMWTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RFROMWProportionateTarget'])?round($result_array['report_val']['RFROMWProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RFROMWCurrentMonthAchivement'])?round($result_array['report_val']['RFROMWCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RFROMWAchivementPercentage'])?round($result_array['report_val']['RFROMWAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RFROMWPreviousYearSameMonthAchievement'])?round($result_array['report_val']['RFROMWPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['RFROMWPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['RFROMWCurrentMonthAchivement']-$result_array['report_val']['RFROMWPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['RFROMWRemarks'])?$result_array['report_val']['RFROMWRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center"></td>
		<td align="left">Total Cash Recovery(5+9)</td>
		<td align="right"><?php echo isset($result_array['report_val']['TCashRLastYearAchivement'])?round($result_array['report_val']['TCashRLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCashRTargetCurrentYear'])?round($result_array['report_val']['TCashRTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCashRProportionateTarget'])?round($result_array['report_val']['TCashRProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCashRCurrentMonthAchivement'])?round($result_array['report_val']['TCashRCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCashRAchivementPercentage'])?round($result_array['report_val']['TCashRAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCashRPreviousYearSameMonthAchievement'])?round($result_array['report_val']['TCashRPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['TCashRPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['TCashRCurrentMonthAchivement']-$result_array['report_val']['TCashRPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['TCashRRemarks'])?$result_array['report_val']['TCashRRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">10</td>
		<td align="left">Export</td>
		<td align="right"><?php echo isset($result_array['report_val']['EXLastYearAchivement'])?round($result_array['report_val']['EXLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['EXTargetCurrentYear'])?round($result_array['report_val']['EXTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['EXProportionateTarget'])?round($result_array['report_val']['EXProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['EXCurrentMonthAchivement'])?round($result_array['report_val']['EXCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['EXAchivementPercentage'])?round($result_array['report_val']['EXAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['EXPreviousYearSameMonthAchievement'])?round($result_array['report_val']['EXPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['EXPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['EXCurrentMonthAchivement']-$result_array['report_val']['EXPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['EXRemarks'])?$result_array['report_val']['EXRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">11</td>
		<td align="left">Import</td>
		<td align="right"><?php echo isset($result_array['report_val']['IMLastYearAchivement'])?round($result_array['report_val']['IMLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['IMTargetCurrentYear'])?round($result_array['report_val']['IMTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['IMProportionateTarget'])?round($result_array['report_val']['IMProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['IMCurrentMonthAchivement'])?round($result_array['report_val']['IMCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['IMAchivementPercentage'])?round($result_array['report_val']['IMAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['IMPreviousYearSameMonthAchievement'])?round($result_array['report_val']['IMPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['IMPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['IMCurrentMonthAchivement']-$result_array['report_val']['IMPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['IMRemarks'])?$result_array['report_val']['IMRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">12</td>
		<td align="left">Foreign Remittance</td>
		<td align="right"><?php echo isset($result_array['report_val']['FRLastYearAchivement'])?round($result_array['report_val']['FRLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['FRTargetCurrentYear'])?round($result_array['report_val']['FRTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['FRProportionateTarget'])?round($result_array['report_val']['FRProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['FRCurrentMonthAchivement'])?round($result_array['report_val']['FRCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['FRAchivementPercentage'])?round($result_array['report_val']['FRAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['FRPreviousYearSameMonthAchievement'])?round($result_array['report_val']['FRPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['FRPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['FRCurrentMonthAchivement']-$result_array['report_val']['FRPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['FRRemarks'])?$result_array['report_val']['FRRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">13</td>
		<td align="left">Non Interest Income</td>
		<td align="right"><?php echo isset($result_array['report_val']['NILastYearAchivement'])?round($result_array['report_val']['NILastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['NITargetCurrentYear'])?round($result_array['report_val']['NITargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['NIProportionateTarget'])?round($result_array['report_val']['NIProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['NICurrentMonthAchivement'])?round($result_array['report_val']['NICurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['NIAchivementPercentage'])?round($result_array['report_val']['NIAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['NIPreviousYearSameMonthAchievement'])?round($result_array['report_val']['NIPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['NIPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['NICurrentMonthAchivement']-$result_array['report_val']['NIPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['NIRemarks'])?$result_array['report_val']['NIRemarks']:'-'; ?></td>
	</tr>
	<tr>
		<td align="center">14</td>
		<td align="left">Profit/Loss</td>
		<td align="right"><?php echo isset($result_array['report_val']['PLLastYearAchivement'])?round($result_array['report_val']['PLLastYearAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['PLTargetCurrentYear'])?round($result_array['report_val']['PLTargetCurrentYear'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['PLProportionateTarget'])?round($result_array['report_val']['PLProportionateTarget'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['PLCurrentMonthAchivement'])?round($result_array['report_val']['PLCurrentMonthAchivement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['PLAchivementPercentage'])?round($result_array['report_val']['PLAchivementPercentage'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['PLPreviousYearSameMonthAchievement'])?round($result_array['report_val']['PLPreviousYearSameMonthAchievement'],2):'-'; ?></td>
		<td align="right"><?php echo isset($result_array['report_val']['PLPreviousYearSameMonthAchievement'])?round(($result_array['report_val']['PLCurrentMonthAchivement']-$result_array['report_val']['PLPreviousYearSameMonthAchievement']),2):'-'; ?></td>
		<td align="left" style="text-indent: 30px;"><?php echo isset($result_array['report_val']['PLRemarks'])?$result_array['report_val']['PLRemarks']:'-'; ?></td>
	</tr>

</table>
<br/>
<?php 

    echo form_open('report/misd_0037_report_details/1');
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
