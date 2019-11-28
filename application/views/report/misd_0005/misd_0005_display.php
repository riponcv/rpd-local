<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PL Statement</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Monthly Business Position Report</td>
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
<table style="margin-right: -872px;"><tr><td>Amount in Crore</td></tr></table>

<!--Deposit + Advance-->
<table border="1">
	<tr>
		<td rowspan="2" align="center" width="200" style="font-size:22px">SL</td>
		
        <td rowspan="2" align="center" width="200" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

		<td colspan="6" align="center" style="font-size:22px">Deposit</td>
		<td colspan="6" align="center" style="font-size:22px">Advance</td>
	</tr>
	   <tr>
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
        
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
		</tr>
        <?php 
        //total calculation
        $total_dp_last_yr_dt=0;
        $total_dp_last_yr_mon_dt=0;
        $total_dp_target=0;
        $total_dp_this_yr=0;
        
        $total_ad_last_yr_dt=0;
        $total_ad_last_yr_mon_dt=0;
        $total_ad_target=0;
        $total_ad_this_yr=0;
        
        ?>
        <?php foreach($result_array as $key=>$row) 
{ 
if(empty($row['report_val']['proportional_target']))
{
$row['report_val']['proportional_target']['deposit']=0;
$row['report_val']['proportional_target']['advance']=0;
}

if(empty($row['report_val']['acheivement_percentage']))
{
$row['report_val']['acheivement_percentage']['deposit']=0;
$row['report_val']['acheivement_percentage']['advance']=0;
}

?>
		<tr>
        <?php 
        //total calculation
        $total_dp_last_yr_dt=$total_dp_last_yr_dt+$row['report_val']['last_day_year']['deposit'];
        $total_dp_last_yr_mon_dt=$total_dp_last_yr_mon_dt+$row['report_val']['pre_yr_status']['deposit'];
        $total_dp_target=$total_dp_target+$row['report_val']['target']['deposit'];
        $total_dp_this_yr=$total_dp_this_yr+$row['report_val']['present_acheivement']['deposit'];
        
        $total_ad_last_yr_dt=$total_ad_last_yr_dt+$row['report_val']['last_day_year']['advance'];
        $total_ad_last_yr_mon_dt=$total_ad_last_yr_mon_dt+$row['report_val']['pre_yr_status']['advance'];
        $total_ad_target=$total_ad_target+$row['report_val']['target']['advance'];
        $total_ad_this_yr=$total_ad_this_yr+$row['report_val']['present_acheivement']['advance'];
        
        ?>
		<td align="center"><?php echo ($key+1); ?></td>		
        <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['last_day_year']['deposit'])?round(($row['report_val']['last_day_year']['deposit']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['deposit'])?round(($row['report_val']['pre_yr_status']['deposit']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['deposit'])?round(($row['report_val']['target']['deposit']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['deposit'])?round(($row['report_val']['proportional_target']['deposit']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['deposit'])?round(($row['report_val']['present_acheivement']['deposit']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['deposit'])?round($row['report_val']['acheivement_percentage']['deposit'],2):'-'; ?></td>

		<td align="right"><?php echo isset($row['report_val']['last_day_year']['advance'])?round(($row['report_val']['last_day_year']['advance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['advance'])?round(($row['report_val']['pre_yr_status']['advance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['advance'])?round(($row['report_val']['target']['advance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['advance'])?round(($row['report_val']['proportional_target']['advance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['advance'])?round(($row['report_val']['present_acheivement']['advance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['advance'])?round($row['report_val']['acheivement_percentage']['advance'],2):'-'; ?></td>
		</tr>
        <?php } ?>
        
        <?php

	$total_dp_pro_target=0;
	$total_ad_pro_target=0;
        if($total_dp_target>0){$total_dp_pro_target=(($total_dp_target-$total_dp_last_yr_dt)*($report_of_month/12))+$total_dp_last_yr_dt;}
        if($total_ad_target>0){$total_ad_pro_target=(($total_ad_target-$total_ad_last_yr_dt)*($report_of_month/12))+$total_ad_last_yr_dt;}

 
        $total_dp_acheivement_percentage=0;
        $total_ad_acheivement_percentage=0;
        if($total_dp_pro_target>0){$total_dp_acheivement_percentage=($total_dp_this_yr*100)/$total_dp_pro_target;}
        if($total_ad_pro_target>0){$total_ad_acheivement_percentage=($total_ad_this_yr*100)/$total_ad_pro_target;}
        ?>
        
        <tr style="font-weight: bold;">
    		<td align="left" colspan="2">Total</td>
    		<td align="right"><?php echo isset($total_dp_last_yr_dt)?round(($total_dp_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_last_yr_mon_dt)?round(($total_dp_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_target)?round(($total_dp_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_pro_target)?round(($total_dp_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_this_yr)?round(($total_dp_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_acheivement_percentage)?round($total_dp_acheivement_percentage,2):'-'; ?></td>
            
    		<td align="right"><?php echo isset($total_ad_last_yr_dt)?round(($total_ad_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_ad_last_yr_mon_dt)?round(($total_ad_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_ad_target)?round(($total_ad_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_ad_pro_target)?round(($total_ad_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_ad_this_yr)?round(($total_ad_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_ad_acheivement_percentage)?round($total_ad_acheivement_percentage,2):'-'; ?></td>
        </tr>
        
        

</table>
<br/>

<!--CL Recovery + F. Remitance-->
<table border="1">
	<tr>
		<td rowspan="2" align="center" width="200" style="font-size:22px">SL</td>
		
        <td rowspan="2" align="center" width="200" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

		<td colspan="6" align="center" style="font-size:22px">CL Recovery(Cash)</td>
		<td colspan="6" align="center" style="font-size:22px">Foreign Remittance</td>
	</tr>
	   <tr>
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
        
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
		</tr>
        <?php 
        //total calculation
        $total_CL_recovery_cash_last_yr_dt=0;
        $total_CL_recovery_cash_last_yr_mon_dt=0;
        $total_CL_recovery_cash_target=0;
        $total_CL_recovery_cash_pro_target=0;
        $total_CL_recovery_cash_this_yr=0;
        
        $total_foreign_remittance_last_yr_dt=0;
        $total_foreign_remittance_last_yr_mon_dt=0;
        $total_foreign_remittance_target=0;
        $total_foreign_remittance_pro_target=0;
        $total_foreign_remittance_this_yr=0;
        
        ?>
        <?php foreach($result_array as $key=>$row) 

{ 
if(empty($row['report_val']['proportional_target']))
{
$row['report_val']['proportional_target']['foreign_remittance']=0;
$row['report_val']['proportional_target']['CL_recovery_cash']=0;
}

if(empty($row['report_val']['acheivement_percentage']))
{
$row['report_val']['acheivement_percentage']['foreign_remittance']=0;
$row['report_val']['acheivement_percentage']['CL_recovery_cash']=0;
}

?>
		<tr>
        <?php 
        //total calculation
        $total_CL_recovery_cash_last_yr_dt=$total_CL_recovery_cash_last_yr_dt+$row['report_val']['last_day_year']['CL_recovery_cash'];
        $total_CL_recovery_cash_last_yr_mon_dt=$total_CL_recovery_cash_last_yr_mon_dt+$row['report_val']['pre_yr_status']['CL_recovery_cash'];
        $total_CL_recovery_cash_target=$total_CL_recovery_cash_target+$row['report_val']['target']['CL_recovery_cash'];
        $total_CL_recovery_cash_pro_target=$total_CL_recovery_cash_pro_target+$row['report_val']['proportional_target']['CL_recovery_cash'];
        $total_CL_recovery_cash_this_yr=$total_CL_recovery_cash_this_yr+$row['report_val']['present_acheivement']['CL_recovery_cash'];
        
        $total_foreign_remittance_last_yr_dt=$total_foreign_remittance_last_yr_dt+$row['report_val']['last_day_year']['foreign_remittance'];
        $total_foreign_remittance_last_yr_mon_dt=$total_foreign_remittance_last_yr_mon_dt+$row['report_val']['pre_yr_status']['foreign_remittance'];
        $total_foreign_remittance_target=$total_foreign_remittance_target+$row['report_val']['target']['foreign_remittance'];
        $total_foreign_remittance_pro_target=$total_foreign_remittance_pro_target+$row['report_val']['proportional_target']['foreign_remittance'];
        $total_foreign_remittance_this_yr=$total_foreign_remittance_this_yr+$row['report_val']['present_acheivement']['foreign_remittance'];
        
        ?>
		<td align="center"><?php echo ($key+1); ?></td>		
        <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['last_day_year']['CL_recovery_cash'])?round(($row['report_val']['last_day_year']['CL_recovery_cash']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['CL_recovery_cash'])?round(($row['report_val']['pre_yr_status']['CL_recovery_cash']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['CL_recovery_cash'])?round(($row['report_val']['target']['CL_recovery_cash']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['CL_recovery_cash'])?round(($row['report_val']['proportional_target']['CL_recovery_cash']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['CL_recovery_cash'])?round(($row['report_val']['present_acheivement']['CL_recovery_cash']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['CL_recovery_cash'])?round($row['report_val']['acheivement_percentage']['CL_recovery_cash'],2):'-'; ?></td>

		<td align="right"><?php echo isset($row['report_val']['last_day_year']['foreign_remittance'])?round(($row['report_val']['last_day_year']['foreign_remittance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['foreign_remittance'])?round(($row['report_val']['pre_yr_status']['foreign_remittance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['foreign_remittance'])?round(($row['report_val']['target']['foreign_remittance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['foreign_remittance'])?round(($row['report_val']['proportional_target']['foreign_remittance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['foreign_remittance'])?round(($row['report_val']['present_acheivement']['foreign_remittance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['foreign_remittance'])?round($row['report_val']['acheivement_percentage']['foreign_remittance'],2):'-'; ?></td>
		</tr>
        <?php } ?>
        
        <?php 
        $total_CL_recovery_cash_acheivement_percentage=0;
        $total_foreign_remittance_acheivement_percentage=0;
        if($total_dp_pro_target>0){$total_CL_recovery_cash_acheivement_percentage=($total_CL_recovery_cash_this_yr*100)/$total_CL_recovery_cash_pro_target;}
        if($total_foreign_remittance_pro_target>0){$total_foreign_remittance_acheivement_percentage=($total_foreign_remittance_this_yr*100)/$total_foreign_remittance_pro_target;}
        ?>
        
        <tr style="font-weight: bold;">
    		<td align="left" colspan="2">Total</td>
    		<td align="right"><?php echo isset($total_CL_recovery_cash_last_yr_dt)?round(($total_CL_recovery_cash_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_CL_recovery_cash_last_yr_mon_dt)?round(($total_CL_recovery_cash_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_CL_recovery_cash_target)?round(($total_CL_recovery_cash_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_CL_recovery_cash_pro_target)?round(($total_CL_recovery_cash_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_CL_recovery_cash_this_yr)?round(($total_CL_recovery_cash_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_CL_recovery_cash_acheivement_percentage)?round($total_CL_recovery_cash_acheivement_percentage,2):'-'; ?></td>
            
    		<td align="right"><?php echo isset($total_foreign_remittance_last_yr_dt)?round(($total_foreign_remittance_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_foreign_remittance_last_yr_mon_dt)?round(($total_foreign_remittance_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_foreign_remittance_target)?round(($total_foreign_remittance_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_foreign_remittance_pro_target)?round(($total_foreign_remittance_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_foreign_remittance_this_yr)?round(($total_foreign_remittance_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_foreign_remittance_acheivement_percentage)?round($total_foreign_remittance_acheivement_percentage,2):'-'; ?></td>
        </tr>
        
        

</table>
<br/>

<!--Export + Import-->
<table border="1">
	<tr>
		<td rowspan="2" align="center" width="200" style="font-size:22px">SL</td>
		
        <td rowspan="2" align="center" width="200" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

		<td colspan="6" align="center" style="font-size:22px">Export</td>
		<td colspan="6" align="center" style="font-size:22px">Import</td>
	</tr>
	   <tr>
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
        
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
		</tr>
        <?php 
        //total calculation
        $total_export_last_yr_dt=0;
        $total_export_last_yr_mon_dt=0;
        $total_export_target=0;
        $total_export_pro_target=0;
        $total_export_this_yr=0;
        
        $total_import_last_yr_dt=0;
        $total_import_last_yr_mon_dt=0;
        $total_import_target=0;
        $total_import_pro_target=0;
        $total_import_this_yr=0;
        
        ?>
        <?php foreach($result_array as $key=>$row) 
{ 
if(empty($row['report_val']['proportional_target']))
{
$row['report_val']['proportional_target']['export']=0;
$row['report_val']['proportional_target']['import']=0;
}

if(empty($row['report_val']['acheivement_percentage']))
{
$row['report_val']['acheivement_percentage']['export']=0;
$row['report_val']['acheivement_percentage']['import']=0;
}

?>
		<tr>
        <?php 
        //total calculation
        $total_export_last_yr_dt=$total_export_last_yr_dt+$row['report_val']['last_day_year']['export'];
        $total_export_last_yr_mon_dt=$total_export_last_yr_mon_dt+$row['report_val']['pre_yr_status']['export'];
        $total_export_target=$total_export_target+$row['report_val']['target']['export'];
        $total_export_pro_target=$total_export_pro_target+$row['report_val']['proportional_target']['export'];
        $total_export_this_yr=$total_export_this_yr+$row['report_val']['present_acheivement']['export'];
        
        $total_import_last_yr_dt=$total_import_last_yr_dt+$row['report_val']['last_day_year']['import'];
        $total_import_last_yr_mon_dt=$total_import_last_yr_mon_dt+$row['report_val']['pre_yr_status']['import'];
        $total_import_target=$total_import_target+$row['report_val']['target']['import'];
        $total_import_pro_target=$total_import_pro_target+$row['report_val']['proportional_target']['import'];
        $total_import_this_yr=$total_import_this_yr+$row['report_val']['present_acheivement']['import'];
        
        ?>
		<td align="center"><?php echo ($key+1); ?></td>		
        <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['last_day_year']['export'])?round(($row['report_val']['last_day_year']['export']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['export'])?round(($row['report_val']['pre_yr_status']['export']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['export'])?round(($row['report_val']['target']['export']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['export'])?round(($row['report_val']['proportional_target']['export']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['export'])?round(($row['report_val']['present_acheivement']['export']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['export'])?round($row['report_val']['acheivement_percentage']['export'],2):'-'; ?></td>

		<td align="right"><?php echo isset($row['report_val']['last_day_year']['import'])?round(($row['report_val']['last_day_year']['import']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['import'])?round(($row['report_val']['pre_yr_status']['import']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['import'])?round(($row['report_val']['target']['import']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['import'])?round(($row['report_val']['proportional_target']['import']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['import'])?round(($row['report_val']['present_acheivement']['import']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['import'])?round($row['report_val']['acheivement_percentage']['import'],2):'-'; ?></td>
		</tr>
        <?php } ?>
        
        <?php 
        $total_export_acheivement_percentage=0;
        $total_import_acheivement_percentage=0;
        if($total_export_pro_target>0){$total_export_acheivement_percentage=($total_export_this_yr*100)/$total_export_pro_target;}
        if($total_import_pro_target>0){$total_import_acheivement_percentage=($total_import_this_yr*100)/$total_import_pro_target;}
        ?>
        
        <tr style="font-weight: bold;">
    		<td align="left" colspan="2">Total</td>
    		<td align="right"><?php echo isset($total_export_last_yr_dt)?round(($total_export_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_export_last_yr_mon_dt)?round(($total_export_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_export_target)?round(($total_export_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_export_pro_target)?round(($total_export_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_export_this_yr)?round(($total_export_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_export_acheivement_percentage)?round($total_export_acheivement_percentage,2):'-'; ?></td>
            
    		<td align="right"><?php echo isset($total_import_last_yr_dt)?round(($total_import_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_import_last_yr_mon_dt)?round(($total_import_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_import_target)?round(($total_import_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_import_pro_target)?round(($total_import_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_import_this_yr)?round(($total_import_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_import_acheivement_percentage)?round($total_import_acheivement_percentage,2):'-'; ?></td>
        </tr>
        
        

</table>
<br/>

<!--Non Intt. Income + PL-->
<table border="1">
	<tr>
		<td rowspan="2" align="center" width="200" style="font-size:22px">SL</td>
		
        <td rowspan="2" align="center" width="200" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

		<td colspan="6" align="center" style="font-size:22px">Non-Interest Income</td>
		<td colspan="6" align="center" style="font-size:22px">Profit</td>
	</tr>
	   <tr>
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
        
		<td align="center">Balance as on 31-12-<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
        <td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?($report_of_year-1):'';?></td>
		<td align="center">Target for <?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Proportionate Target</td>
		<td align="center">Balance as on <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>'<?php echo isset($report_of_year)?$report_of_year:'';?></td>
		<td align="center">Ach(%)</td>
		</tr>
        <?php 
        //total calculation
        $total_non_intt_income_last_yr_dt=0;
        $total_non_intt_income_last_yr_mon_dt=0;
        $total_non_intt_income_target=0;
        $total_non_intt_income_pro_target=0;
        $total_non_intt_income_this_yr=0;
        
        $total_pl_last_yr_dt=0;
        $total_pl_last_yr_mon_dt=0;
        $total_pl_target=0;
        $total_pl_pro_target=0;
        $total_pl_this_yr=0;
        
        ?>
        <?php foreach($result_array as $key=>$row) 
{ 
if(empty($row['report_val']['proportional_target']))
{
$row['report_val']['proportional_target']['pl']=0;
$row['report_val']['proportional_target']['non_intt_income']=0;
}

if(empty($row['report_val']['acheivement_percentage']))
{
$row['report_val']['acheivement_percentage']['pl']=0;
$row['report_val']['acheivement_percentage']['non_intt_income']=0;
}
?>
		<tr>
        <?php 
        //total calculation
        $total_non_intt_income_last_yr_dt=$total_non_intt_income_last_yr_dt+$row['report_val']['last_day_year']['non_intt_income'];
        $total_non_intt_income_last_yr_mon_dt=$total_non_intt_income_last_yr_mon_dt+$row['report_val']['pre_yr_status']['non_intt_income'];
        $total_non_intt_income_target=$total_non_intt_income_target+$row['report_val']['target']['non_intt_income'];
        $total_non_intt_income_pro_target=$total_non_intt_income_pro_target+$row['report_val']['proportional_target']['non_intt_income'];
        $total_non_intt_income_this_yr=$total_non_intt_income_this_yr+$row['report_val']['present_acheivement']['non_intt_income'];
        
        $total_pl_last_yr_dt=$total_pl_last_yr_dt+$row['report_val']['last_day_year']['pl'];
        $total_pl_last_yr_mon_dt=$total_pl_last_yr_mon_dt+$row['report_val']['pre_yr_status']['pl'];
        $total_pl_target=$total_pl_target+$row['report_val']['target']['pl'];
        $total_pl_pro_target=$total_pl_pro_target+$row['report_val']['proportional_target']['pl'];
        $total_pl_this_yr=$total_pl_this_yr+$row['report_val']['present_acheivement']['pl'];
        
        ?>
		<td align="center"><?php echo ($key+1); ?></td>		
        <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['last_day_year']['non_intt_income'])?round(($row['report_val']['last_day_year']['non_intt_income']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['non_intt_income'])?round(($row['report_val']['pre_yr_status']['non_intt_income']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['non_intt_income'])?round(($row['report_val']['target']['non_intt_income']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['non_intt_income'])?round(($row['report_val']['proportional_target']['non_intt_income']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['non_intt_income'])?round(($row['report_val']['present_acheivement']['non_intt_income']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['non_intt_income'])?round($row['report_val']['acheivement_percentage']['non_intt_income'],2):'-'; ?></td>

		<td align="right"><?php echo isset($row['report_val']['last_day_year']['pl'])?round(($row['report_val']['last_day_year']['pl']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['pl'])?round(($row['report_val']['pre_yr_status']['pl']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['target']['pl'])?round(($row['report_val']['target']['pl']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['proportional_target']['pl'])?round(($row['report_val']['proportional_target']['pl']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['present_acheivement']['pl'])?round(($row['report_val']['present_acheivement']['pl']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['acheivement_percentage']['pl'])?round($row['report_val']['acheivement_percentage']['pl'],2):'-'; ?></td>
		</tr>
        <?php } ?>
        
        <?php 
        $total_non_intt_income_acheivement_percentage=0;
        $total_pl_acheivement_percentage=0;
        if($total_non_intt_income_pro_target>0){$total_non_intt_income_acheivement_percentage=($total_non_intt_income_this_yr*100)/$total_non_intt_income_pro_target;}
        if($total_pl_pro_target>0){$total_pl_acheivement_percentage=($total_pl_this_yr*100)/$total_pl_pro_target;}
        ?>
        
        <tr style="font-weight: bold;">
    		<td align="left" colspan="2">Total</td>
    		<td align="right"><?php echo isset($total_non_intt_income_last_yr_dt)?round(($total_non_intt_income_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_non_intt_income_last_yr_mon_dt)?round(($total_non_intt_income_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_non_intt_income_target)?round(($total_non_intt_income_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_non_intt_income_pro_target)?round(($total_non_intt_income_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_non_intt_income_this_yr)?round(($total_non_intt_income_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_non_intt_income_acheivement_percentage)?round($total_non_intt_income_acheivement_percentage,2):'-'; ?></td>
            
    		<td align="right"><?php echo isset($total_pl_last_yr_dt)?round(($total_pl_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_pl_last_yr_mon_dt)?round(($total_pl_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_pl_target)?round(($total_pl_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_pl_pro_target)?round(($total_pl_pro_target/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_pl_this_yr)?round(($total_pl_this_yr/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_pl_acheivement_percentage)?round($total_pl_acheivement_percentage,2):'-'; ?></td>
        </tr>
        
        

</table>
<br/>
<?php 

    echo form_open('report/misd_0005_report_details/1');
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
