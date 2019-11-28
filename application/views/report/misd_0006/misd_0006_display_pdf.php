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
    <td align="center" style="font-size:18px;">Assets Liability Management Report</td>
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
<table border="1" align="right" style="border:thin; margin-top: -90px;border-collapse:collapse;" id="t1">
  <tr>
    <td width="80">Report</td>
    <td width="175"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="80">Printing Date </td>
    <td width="175"><?php echo date("d/m/Y"); ?></td>
  </tr>
  <tr>
    <td width="80">Source </td>
    <td width="175">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>
<table style="margin-left: 850px;"><tr><td>Amount in Crore</td></tr></table>

<!--Deposit + Advance-->
<table border="1" style="border-collapse:collapse;" id="t1">
	<tr>
		<td rowspan="2" align="center" width="20" style="font-size:20px">SL</td>
		
        <td rowspan="2" align="center" width="200" style="font-size:20px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>

		<td colspan="3" align="center" style="font-size:20px">Deposit</td>
		<td colspan="3" align="center" style="font-size:20px">Advance</td>
		<td colspan="2" align="center" style="font-size:20px">Ratio</td>
		<td rowspan="2" align="center" width="150" style="font-size:22px">Remarks</td>
	</tr>
	   <tr>
		<td align="center">As on 31.12.<?php $year = date('Y',strtotime($report_of_date)); echo isset($report_of_date)?($year-1):'';?></td>
        <td align="center">As on <?php  ?><?php $st_d=date('d.m.Y', strtotime($report_of_date)); echo isset($report_of_date)?($st_d):'';?></td>
		<td align="center" class="_diff">Difference (Increase/Decrease)</td>
        
		<td align="center">As on 31.12.<?php $year = date('Y',strtotime($report_of_date)); echo isset($report_of_date)?($year-1):'';?></td>
        <td align="center">As on <?php $st_d=date('d.m.Y', strtotime($report_of_date)); echo isset($report_of_date)?$st_d:''; ?></td>
		<td align="center" class="_diff">Difference (Increase/Decrease)</td>
		<td align="center">As on 31.12.<?php $year = date('Y',strtotime($report_of_date)); echo isset($report_of_date)?($year-1):'';?></td>
		<td align="center">As on <?php $st_d=date('d.m.Y', strtotime($report_of_date)); echo isset($report_of_date)?$st_d:''; ?></td>
		</tr>
        <?php 
        $total_dp_last_yr_dt=0;
        $total_dp_last_yr_mon_dt=0;
                
        $total_ad_last_yr_dt=0;
        $total_ad_last_yr_mon_dt=0;
        
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
          
        $total_ad_last_yr_dt=$total_ad_last_yr_dt+$row['report_val']['last_day_year']['advance'];
        $total_ad_last_yr_mon_dt=$total_ad_last_yr_mon_dt+$row['report_val']['pre_yr_status']['advance'];
    
        ?>
		<td align="center"><?php echo ($key+1); ?></td>		
        <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['last_day_year']['deposit'])?round(($row['report_val']['last_day_year']['deposit']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['deposit'])?round(($row['report_val']['pre_yr_status']['deposit']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['deposit'])?round(((($row['report_val']['pre_yr_status']['deposit'])-($row['report_val']['last_day_year']['deposit']))/10000000),2):'-'; ?></td>
		
		<td align="right"><?php echo isset($row['report_val']['last_day_year']['advance'])?round(($row['report_val']['last_day_year']['advance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['advance'])?round(($row['report_val']['pre_yr_status']['advance']/10000000),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['pre_yr_status']['advance'])?round(((($row['report_val']['pre_yr_status']['advance'])-($row['report_val']['last_day_year']['advance']))/10000000),2):'-'; ?></td>
		
		<td align="right"><?php echo isset($row['report_val']['last_day_year']['advance'])?round((((($row['report_val']['last_day_year']['advance'])/($row['report_val']['last_day_year']['deposit']))*100)),2):'-'; echo "%";?></td>
		<td align="right"><?php if(($row['report_val']['pre_yr_status']['deposit'])>1){echo isset($row['report_val']['pre_yr_status']['deposit'])?round((((($row['report_val']['pre_yr_status']['advance'])/($row['report_val']['pre_yr_status']['deposit']))*100)),2):'-';echo "%"; } ?></td>
		<td align="right"><?php echo "--"; ?></td>
		</tr>
        <?php } ?>
        
        <tr style="font-weight: bold;">
    		<td align="right" colspan="2">Total=</td>
    		<td align="right"><?php echo isset($total_dp_last_yr_dt)?round(($total_dp_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_last_yr_mon_dt)?round(($total_dp_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_last_yr_mon_dt)?round(((($total_dp_last_yr_mon_dt)-($total_dp_last_yr_dt))/10000000),2):'-'; ?></td>
    		
    		<td align="right"><?php echo isset($total_ad_last_yr_dt)?round(($total_ad_last_yr_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_ad_last_yr_mon_dt)?round(($total_ad_last_yr_mon_dt/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_last_yr_mon_dt)?round(((($total_ad_last_yr_mon_dt)-($total_ad_last_yr_dt))/10000000),2):'-'; ?></td>
    		<td align="right"><?php echo isset($total_dp_last_yr_mon_dt)?round(((($total_ad_last_yr_dt)/($total_dp_last_yr_dt))*100),2):'-'; echo "%";?></td>
    		<td align="right"><?php if($total_dp_last_yr_mon_dt>1){echo isset($total_dp_last_yr_mon_dt)?round(((($total_ad_last_yr_mon_dt)/($total_dp_last_yr_mon_dt))*100),2):'-'; echo "%"; } ?></td>
    		<td align="right"><?php //echo isset($total_ad_acheivement_percentage)?round(($total_ad_acheivement_percentage/($key+1)),2):'-'; ?></td>
        </tr>
 </table>
<br/>
<table style="border:thin">
	<tr>
		<td>Deposit Increased on</td>
		<td style="font-weight: bold;padding: 8px"><?php $st_d=date('d.m.Y', strtotime($report_of_date)); echo isset($report_of_date)?$st_d:''; ?></td>
		<td style="font-weight: bold;padding: 8px"><?php echo isset($total_dp_last_yr_mon_dt)?round(((($total_dp_last_yr_mon_dt)-($total_dp_last_yr_dt))/10000000),2):'-'; ?>  Crore</td>
	</tr>
	<tr>
     <td>Advance Increased on</td>
     <td style="font-weight: bold;padding: 8px"><?php $st_d=date('d.m.Y', strtotime($report_of_date)); echo isset($report_of_date)?$st_d:''; ?></td>
	<td style="font-weight: bold;padding: 8px"><?php echo isset($total_dp_last_yr_mon_dt)?round(((($total_ad_last_yr_mon_dt)-($total_ad_last_yr_dt))/10000000),2):'-'; ?>   Crore</td>
	</tr>	
</table>
<table style="border:thin;margin-left: 495px;margin-top: -80px;">
	<tr>
		<td>Advance/Deposit Ratio As on</td>
		<td style="font-weight: bold;padding: 8px">31.12.<?php $year = date('Y',strtotime($report_of_date)); echo isset($report_of_date)?($year-1):'';?></td>
		<td style="font-weight: bold;padding: 8px"><?php echo isset($total_dp_last_yr_mon_dt)?round(((($total_ad_last_yr_dt)/($total_dp_last_yr_dt))*100),2):'-'; echo "%";?></td>
	</tr>
	<tr>
     <td>Advance/Deposit Ratio As on</td>
     <td style="font-weight: bold;padding: 8px"><?php $st_d=date('d.m.Y', strtotime($report_of_date)); echo isset($report_of_date)?$st_d:''; ?></td>
	<td style="font-weight: bold;padding: 8px"><?php if($total_dp_last_yr_mon_dt>1){echo isset($total_dp_last_yr_mon_dt)?round(((($total_ad_last_yr_mon_dt)/($total_dp_last_yr_mon_dt))*100),2):'-'; echo "%"; } ?></td>
	</tr>	
</table>
<?php 

    echo form_open('report/misd_0006_report_details/1');
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