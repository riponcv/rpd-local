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
    <td align="center"><img width="90" height="66" src="<?php echo base_url().'img/logo_new.png' ?>" /></td>
  </tr>
  <tr>
    <td align="center" style="font-size:25px;">Janata Bank Limited</td>
  </tr>
  
  <tr>
    <td align="center" style="font-size:20px;">Management Information System Department</td>
  </tr>
  <tr>
    <td align="center" >Report of</td>
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
<table border="1" align="right" style="border: thin;margin-top: -105px;border-collapse:collapse;" id="t1">
  <tr>
    <td width="65">Report Name</td>
    <td width="140"><?php echo isset($report_details->report_title)?$report_details->report_title:''; ?></td>
  </tr>
  <tr>
    <td width="65">Frequency</td>
      <?php $month_array=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td width="140"><?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?></td>
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
<!--Deposit + Advance-->
<table align="center" border="1" style="border-collapse:collapse;" id="t1">
    <tr>
        <td rowspan="2" align="center" style="font-size:22px">SL</td>
        
        <td rowspan="2" align="center" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>
        
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
    $total_DPLastYearAchivement=0;
    $total_DPPreviousYearSameMonthAchievement=0;
    $total_DPTargetCurrentYear=0;
    $total_DPProportionateTarget=0;
    $total_DPCurrentMonthAchivement=0;
    
    $total_ADLastYearAchivement=0;
    $total_ADPreviousYearSameMonthAchievement=0;
    $total_ADTargetCurrentYear=0;
    $total_ADProportionateTarget=0;
    $total_ADCurrentMonthAchivement=0;
    
    ?>
    <?php foreach($result_array as $key=>$row) 
    { 
        
    ?>
    	<tr>
            <?php 
            //total calculation
            $total_DPLastYearAchivement=$total_DPLastYearAchivement+$row['report_val']['DPLastYearAchivement'];
            $total_DPPreviousYearSameMonthAchievement=$total_DPPreviousYearSameMonthAchievement+$row['report_val']['DPPreviousYearSameMonthAchievement'];
            $total_DPTargetCurrentYear=$total_DPTargetCurrentYear+$row['report_val']['DPTargetCurrentYear'];
            $total_DPProportionateTarget=$total_DPProportionateTarget+$row['report_val']['DPProportionateTarget'];
            $total_DPCurrentMonthAchivement=$total_DPCurrentMonthAchivement+$row['report_val']['DPCurrentMonthAchivement'];
            
            $total_ADLastYearAchivement=$total_ADLastYearAchivement+$row['report_val']['ADLastYearAchivement'];
            $total_ADPreviousYearSameMonthAchievement=$total_ADPreviousYearSameMonthAchievement+$row['report_val']['ADPreviousYearSameMonthAchievement'];
            $total_ADTargetCurrentYear=$total_ADTargetCurrentYear+$row['report_val']['ADTargetCurrentYear'];
            $total_ADProportionateTarget=$total_ADProportionateTarget+$row['report_val']['ADProportionateTarget'];
            $total_ADCurrentMonthAchivement=$total_ADCurrentMonthAchivement+$row['report_val']['ADCurrentMonthAchivement'];
            
            ?>
        	<td align="center"><?php echo ($key+1); ?></td>		
            <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['DPLastYearAchivement'])?round($row['report_val']['DPLastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['DPPreviousYearSameMonthAchievement'])?round($row['report_val']['DPPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['DPTargetCurrentYear'])?round($row['report_val']['DPTargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['DPProportionateTarget'])?round($row['report_val']['DPProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['DPCurrentMonthAchivement'])?round($row['report_val']['DPCurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['DPProportionateTarget']) && $row['report_val']['DPProportionateTarget']>0){echo round((($row['report_val']['DPCurrentMonthAchivement']*100)/$row['report_val']['DPProportionateTarget']),2);} else{ echo "-"; } ?></td>
        
        	<td align="right"><?php echo isset($row['report_val']['ADLastYearAchivement'])?round($row['report_val']['ADLastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['ADPreviousYearSameMonthAchievement'])?round($row['report_val']['ADPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['ADTargetCurrentYear'])?round($row['report_val']['ADTargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['ADProportionateTarget'])?round($row['report_val']['ADProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['ADCurrentMonthAchivement'])?round($row['report_val']['ADCurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['ADProportionateTarget']) && $row['report_val']['ADProportionateTarget']>0){echo round((($row['report_val']['ADCurrentMonthAchivement']*100)/$row['report_val']['ADProportionateTarget']),2);} else{ echo "-"; } ?></td>
    	</tr>
    <?php } ?>
        
    <tr style="font-weight: bold;">
		<td align="left" colspan="2">Total</td>
        
		<td align="right"><?php echo isset($total_DPLastYearAchivement)?round($total_DPLastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_DPPreviousYearSameMonthAchievement)?round($total_DPPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_DPTargetCurrentYear)?round($total_DPTargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_DPProportionateTarget)?round($total_DPProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_DPCurrentMonthAchivement)?round($total_DPCurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_DPProportionateTarget) && $total_DPProportionateTarget>0){echo round((($total_DPCurrentMonthAchivement*100)/$total_DPProportionateTarget),2);} else{ echo "-"; } ?></td>
        
		<td align="right"><?php echo isset($total_ADLastYearAchivement)?round($total_ADLastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_ADPreviousYearSameMonthAchievement)?round($total_ADPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_ADTargetCurrentYear)?round($total_ADTargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_ADProportionateTarget)?round($total_ADProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_ADCurrentMonthAchivement)?round($total_ADCurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_ADProportionateTarget) && $total_ADProportionateTarget>0){echo round((($total_ADCurrentMonthAchivement*100)/$total_ADProportionateTarget),2);} else{ echo "-"; } ?></td>
    </tr>
        
        

</table>
<br/>

<!--CL Recovery + F. Remitance-->
<table align="center" border="1" style="page-break-before: always;border-collapse:collapse;" id="t1">
	<tr>
		<td rowspan="2" align="center" style="font-size:22px">SL</td>
		
        <td rowspan="2" align="center" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

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
    $total_RCLastYearAchivement=0;
    $total_RCPreviousYearSameMonthAchievement=0;
    $total_RCTargetCurrentYear=0;
    $total_RCProportionateTarget=0;
    $total_RCCurrentMonthAchivement=0;
    
    $total_FRLastYearAchivement=0;
    $total_FRPreviousYearSameMonthAchievement=0;
    $total_FRTargetCurrentYear=0;
    $total_FRProportionateTarget=0;
    $total_FRCurrentMonthAchivement=0;
    
    ?>
    <?php foreach($result_array as $key=>$row) 
    { 
        
    ?>
    	<tr>
            <?php 
            //total calculation
            $total_RCLastYearAchivement=$total_RCLastYearAchivement+$row['report_val']['RCLastYearAchivement'];
            $total_RCPreviousYearSameMonthAchievement=$total_RCPreviousYearSameMonthAchievement+$row['report_val']['RCPreviousYearSameMonthAchievement'];
            $total_RCTargetCurrentYear=$total_RCTargetCurrentYear+$row['report_val']['RCTargetCurrentYear'];
            $total_RCProportionateTarget=$total_RCProportionateTarget+$row['report_val']['RCProportionateTarget'];
            $total_RCCurrentMonthAchivement=$total_RCCurrentMonthAchivement+$row['report_val']['RCCurrentMonthAchivement'];
            
            $total_FRLastYearAchivement=$total_FRLastYearAchivement+$row['report_val']['FRLastYearAchivement'];
            $total_FRPreviousYearSameMonthAchievement=$total_FRPreviousYearSameMonthAchievement+$row['report_val']['FRPreviousYearSameMonthAchievement'];
            $total_FRTargetCurrentYear=$total_FRTargetCurrentYear+$row['report_val']['FRTargetCurrentYear'];
            $total_FRProportionateTarget=$total_FRProportionateTarget+$row['report_val']['FRProportionateTarget'];
            $total_FRCurrentMonthAchivement=$total_FRCurrentMonthAchivement+$row['report_val']['FRCurrentMonthAchivement'];
            
            ?>
        	<td align="center"><?php echo ($key+1); ?></td>		
            <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['RCLastYearAchivement'])?round($row['report_val']['RCLastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['RCPreviousYearSameMonthAchievement'])?round($row['report_val']['RCPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['RCTargetCurrentYear'])?round($row['report_val']['RCTargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['RCProportionateTarget'])?round($row['report_val']['RCProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['RCCurrentMonthAchivement'])?round($row['report_val']['RCCurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['RCProportionateTarget']) && $row['report_val']['RCProportionateTarget']>0){echo round((($row['report_val']['RCCurrentMonthAchivement']*100)/$row['report_val']['RCProportionateTarget']),2);} else{ echo "-"; } ?></td>
        
        	<td align="right"><?php echo isset($row['report_val']['FRLastYearAchivement'])?round($row['report_val']['FRLastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['FRPreviousYearSameMonthAchievement'])?round($row['report_val']['FRPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['FRTargetCurrentYear'])?round($row['report_val']['FRTargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['FRProportionateTarget'])?round($row['report_val']['FRProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['FRCurrentMonthAchivement'])?round($row['report_val']['FRCurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['FRProportionateTarget']) && $row['report_val']['FRProportionateTarget']>0){echo round((($row['report_val']['FRCurrentMonthAchivement']*100)/$row['report_val']['FRProportionateTarget']),2);} else{ echo "-"; } ?></td>
    	</tr>
    <?php } ?>
        
    <tr style="font-weight: bold;">
		<td align="left" colspan="2">Total</td>
        
		<td align="right"><?php echo isset($total_RCLastYearAchivement)?round($total_RCLastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_RCPreviousYearSameMonthAchievement)?round($total_RCPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_RCTargetCurrentYear)?round($total_RCTargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_RCProportionateTarget)?round($total_RCProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_RCCurrentMonthAchivement)?round($total_RCCurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_RCProportionateTarget) && $total_RCProportionateTarget>0){echo round((($total_RCCurrentMonthAchivement*100)/$total_RCProportionateTarget),2);} else{ echo "-"; } ?></td>
        
		<td align="right"><?php echo isset($total_FRLastYearAchivement)?round($total_FRLastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_FRPreviousYearSameMonthAchievement)?round($total_FRPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_FRTargetCurrentYear)?round($total_FRTargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_FRProportionateTarget)?round($total_FRProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_FRCurrentMonthAchivement)?round($total_FRCurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_FRProportionateTarget) && $total_FRProportionateTarget>0){echo round((($total_FRCurrentMonthAchivement*100)/$total_FRProportionateTarget),2);} else{ echo "-"; } ?></td>
    </tr>
        
        

</table>
<br/>

<!--Export + Import-->
<table align="center" border="1" style="page-break-before: always;border-collapse:collapse;" id="t1">
	<tr>
		<td rowspan="2" align="center" style="font-size:22px">SL</td>
		
        <td rowspan="2" align="center" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

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
    $total_EXLastYearAchivement=0;
    $total_EXPreviousYearSameMonthAchievement=0;
    $total_EXTargetCurrentYear=0;
    $total_EXProportionateTarget=0;
    $total_EXCurrentMonthAchivement=0;
    
    $total_IMLastYearAchivement=0;
    $total_IMPreviousYearSameMonthAchievement=0;
    $total_IMTargetCurrentYear=0;
    $total_IMProportionateTarget=0;
    $total_IMCurrentMonthAchivement=0;
    
    ?>
    <?php foreach($result_array as $key=>$row) 
    { 
        
    ?>
    	<tr>
            <?php 
            //total calculation
            $total_EXLastYearAchivement=$total_EXLastYearAchivement+$row['report_val']['EXLastYearAchivement'];
            $total_EXPreviousYearSameMonthAchievement=$total_EXPreviousYearSameMonthAchievement+$row['report_val']['EXPreviousYearSameMonthAchievement'];
            $total_EXTargetCurrentYear=$total_EXTargetCurrentYear+$row['report_val']['EXTargetCurrentYear'];
            $total_EXProportionateTarget=$total_EXProportionateTarget+$row['report_val']['EXProportionateTarget'];
            $total_EXCurrentMonthAchivement=$total_EXCurrentMonthAchivement+$row['report_val']['EXCurrentMonthAchivement'];
            
            $total_IMLastYearAchivement=$total_IMLastYearAchivement+$row['report_val']['IMLastYearAchivement'];
            $total_IMPreviousYearSameMonthAchievement=$total_IMPreviousYearSameMonthAchievement+$row['report_val']['IMPreviousYearSameMonthAchievement'];
            $total_IMTargetCurrentYear=$total_IMTargetCurrentYear+$row['report_val']['IMTargetCurrentYear'];
            $total_IMProportionateTarget=$total_IMProportionateTarget+$row['report_val']['IMProportionateTarget'];
            $total_IMCurrentMonthAchivement=$total_IMCurrentMonthAchivement+$row['report_val']['IMCurrentMonthAchivement'];
            
            ?>
        	<td align="center"><?php echo ($key+1); ?></td>		
            <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['EXLastYearAchivement'])?round($row['report_val']['EXLastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['EXPreviousYearSameMonthAchievement'])?round($row['report_val']['EXPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['EXTargetCurrentYear'])?round($row['report_val']['EXTargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['EXProportionateTarget'])?round($row['report_val']['EXProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['EXCurrentMonthAchivement'])?round($row['report_val']['EXCurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['EXProportionateTarget']) && $row['report_val']['EXProportionateTarget']>0){echo round((($row['report_val']['EXCurrentMonthAchivement']*100)/$row['report_val']['EXProportionateTarget']),2);} else{ echo "-"; } ?></td>
        
        	<td align="right"><?php echo isset($row['report_val']['IMLastYearAchivement'])?round($row['report_val']['IMLastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['IMPreviousYearSameMonthAchievement'])?round($row['report_val']['IMPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['IMTargetCurrentYear'])?round($row['report_val']['IMTargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['IMProportionateTarget'])?round($row['report_val']['IMProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['IMCurrentMonthAchivement'])?round($row['report_val']['IMCurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['IMProportionateTarget']) && $row['report_val']['IMProportionateTarget']>0){echo round((($row['report_val']['IMCurrentMonthAchivement']*100)/$row['report_val']['IMProportionateTarget']),2);} else{ echo "-"; } ?></td>
    	</tr>
    <?php } ?>
        
    <tr style="font-weight: bold;">
		<td align="left" colspan="2">Total</td>
        
		<td align="right"><?php echo isset($total_EXLastYearAchivement)?round($total_EXLastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_EXPreviousYearSameMonthAchievement)?round($total_EXPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_EXTargetCurrentYear)?round($total_EXTargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_EXProportionateTarget)?round($total_EXProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_EXCurrentMonthAchivement)?round($total_EXCurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_EXProportionateTarget) && $total_EXProportionateTarget>0){echo round((($total_EXCurrentMonthAchivement*100)/$total_EXProportionateTarget),2);} else{ echo "-"; } ?></td>
        
		<td align="right"><?php echo isset($total_IMLastYearAchivement)?round($total_IMLastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_IMPreviousYearSameMonthAchievement)?round($total_IMPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_IMTargetCurrentYear)?round($total_IMTargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_IMProportionateTarget)?round($total_IMProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_IMCurrentMonthAchivement)?round($total_IMCurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_IMProportionateTarget) && $total_IMProportionateTarget>0){echo round((($total_IMCurrentMonthAchivement*100)/$total_IMProportionateTarget),2);} else{ echo "-"; } ?></td>
    </tr>
        
        

</table>
<br/>

<!--Non Intt. Income + PL-->
<table align="center" border="1" style="page-break-before: always;border-collapse:collapse;" id="t1">
	<tr>
		<td rowspan="2" align="center" style="font-size:22px">SL</td>
		
        <td rowspan="2" align="center" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

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
    $total_NILastYearAchivement=0;
    $total_NIPreviousYearSameMonthAchievement=0;
    $total_NITargetCurrentYear=0;
    $total_NIProportionateTarget=0;
    $total_NICurrentMonthAchivement=0;
    
    $total_PLLastYearAchivement=0;
    $total_PLPreviousYearSameMonthAchievement=0;
    $total_PLTargetCurrentYear=0;
    $total_PLProportionateTarget=0;
    $total_PLCurrentMonthAchivement=0;
    
    ?>
    <?php foreach($result_array as $key=>$row) 
    { 
        
    ?>
    	<tr>
            <?php 
            //total calculation
            $total_NILastYearAchivement=$total_NILastYearAchivement+$row['report_val']['NILastYearAchivement'];
            $total_NIPreviousYearSameMonthAchievement=$total_NIPreviousYearSameMonthAchievement+$row['report_val']['NIPreviousYearSameMonthAchievement'];
            $total_NITargetCurrentYear=$total_NITargetCurrentYear+$row['report_val']['NITargetCurrentYear'];
            $total_NIProportionateTarget=$total_NIProportionateTarget+$row['report_val']['NIProportionateTarget'];
            $total_NICurrentMonthAchivement=$total_NICurrentMonthAchivement+$row['report_val']['NICurrentMonthAchivement'];
            
            $total_PLLastYearAchivement=$total_PLLastYearAchivement+$row['report_val']['PLLastYearAchivement'];
            $total_PLPreviousYearSameMonthAchievement=$total_PLPreviousYearSameMonthAchievement+$row['report_val']['PLPreviousYearSameMonthAchievement'];
            $total_PLTargetCurrentYear=$total_PLTargetCurrentYear+$row['report_val']['PLTargetCurrentYear'];
            $total_PLProportionateTarget=$total_PLProportionateTarget+$row['report_val']['PLProportionateTarget'];
            $total_PLCurrentMonthAchivement=$total_PLCurrentMonthAchivement+$row['report_val']['PLCurrentMonthAchivement'];
            
            ?>
        	<td align="center"><?php echo ($key+1); ?></td>		
            <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['NILastYearAchivement'])?round($row['report_val']['NILastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['NIPreviousYearSameMonthAchievement'])?round($row['report_val']['NIPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['NITargetCurrentYear'])?round($row['report_val']['NITargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['NIProportionateTarget'])?round($row['report_val']['NIProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['NICurrentMonthAchivement'])?round($row['report_val']['NICurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['NIProportionateTarget']) && $row['report_val']['NIProportionateTarget']>0){echo round((($row['report_val']['NICurrentMonthAchivement']*100)/$row['report_val']['NIProportionateTarget']),2);} else{ echo "-"; } ?></td>
        
        	<td align="right"><?php echo isset($row['report_val']['PLLastYearAchivement'])?round($row['report_val']['PLLastYearAchivement'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['PLPreviousYearSameMonthAchievement'])?round($row['report_val']['PLPreviousYearSameMonthAchievement'],2):'-'; ?></td>
            <td align="right"><?php echo isset($row['report_val']['PLTargetCurrentYear'])?round($row['report_val']['PLTargetCurrentYear'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['PLProportionateTarget'])?round($row['report_val']['PLProportionateTarget'],2):'-'; ?></td>
        	<td align="right"><?php echo isset($row['report_val']['PLCurrentMonthAchivement'])?round($row['report_val']['PLCurrentMonthAchivement'],2):'-'; ?></td>
        	<td align="right"><?php if(isset($row['report_val']['PLProportionateTarget']) && $row['report_val']['PLProportionateTarget']>0){echo round((($row['report_val']['PLCurrentMonthAchivement']*100)/$row['report_val']['PLProportionateTarget']),2);} else{ echo "-"; } ?></td>
    	</tr>
    <?php } ?>
        
    <tr style="font-weight: bold;">
		<td align="left" colspan="2">Total</td>
        
		<td align="right"><?php echo isset($total_NILastYearAchivement)?round($total_NILastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_NIPreviousYearSameMonthAchievement)?round($total_NIPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_NITargetCurrentYear)?round($total_NITargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_NIProportionateTarget)?round($total_NIProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_NICurrentMonthAchivement)?round($total_NICurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_NIProportionateTarget) && $total_NIProportionateTarget>0){echo round((($total_NICurrentMonthAchivement*100)/$total_NIProportionateTarget),2);} else{ echo "-"; } ?></td>
        
		<td align="right"><?php echo isset($total_PLLastYearAchivement)?round($total_PLLastYearAchivement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_PLPreviousYearSameMonthAchievement)?round($total_PLPreviousYearSameMonthAchievement,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_PLTargetCurrentYear)?round($total_PLTargetCurrentYear,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_PLProportionateTarget)?round($total_PLProportionateTarget,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_PLCurrentMonthAchivement)?round($total_PLCurrentMonthAchivement,2):'-'; ?></td>
        <td align="right"><?php if(isset($total_PLProportionateTarget) && $total_PLProportionateTarget>0){echo round((($total_PLCurrentMonthAchivement*100)/$total_PLProportionateTarget),2);} else{ echo "-"; } ?></td>
    </tr>
        
        

</table>
<br /><br /><br />
<table align="left">
<tr><td>Reference:</td></tr>
<tr><td>Instruction Circular No</td><td>-</td><td>**********</td></tr>
<tr><td>Circular Date</td><td>-</td><td>**********</td></tr>
</table>
<table align="right">
<tr><td align="center">Deputy General Manager</td></tr>
<tr><td align="center">Management Information System Department</td></tr>
</table>
<br /><br /><br /><br />
<?php if(isset($command_office) && $command_office !=''){}else{echo "<br/>";} ?>
<table align="center">
<tr><td align="center">N.B: This is a system generated statement and requires no manual signature.</td></tr>
</table>
<?php 
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
