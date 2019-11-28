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
    <td align="center" style="font-size:18px;">Recovery Report</td>
  </tr>
  <tr>
  
    <td align="center" >Report of: <?php echo isset($report_of_date)?$report_of_date:''; ?> </td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
   <tr>
    <td align="center" ><?php echo '(From Jan 01, '.date('Y',strtotime($report_of_date)).' to '.$report_of_date.')'; ?></td>
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
		<td rowspan="3" align="center">SL</td>
		<td rowspan="3" align="center"><?php echo isset($list_title)?$list_title:'Office'; ?></td>
		<td colspan="10" align="center">Cash Recovery</td>
		<td colspan="4" rowspan="2" align="center">Reduction</td>
		<td rowspan="3" align="center">Total Cash Recovery and Reduction</td>
	</tr>
	<tr>
		<td colspan="3" align="center">DP for Recovery</td>
		<td colspan="3" align="center">IW for Recovery</td>
		<td colspan="3" align="center">Other for Recovery</td>
		<td rowspan="2" align="center">Total Recovery</td>
	</tr>
	<tr>
		<td>Principal</td>
		<td>Interest</td>
		<td>Total</td>
		
		<td>Principal</td>
		<td>Interest</td>
		<td>Total</td>
		
		<td>Principal</td>
		<td>Interest</td>
		<td>Total</td>
		
		<td>Re-schedule</td>
		<td>Interest Waiver</td>
		<td>Write Off</td>
		<td>Total Reduction</td>
	</tr>
        <?php 
        //total calculation
        $dp_resch_p=0;
        $dp_resch_i=0;
        $total_resch=0;
		$dp_iw_p=0;
        $dp_iw_i=0;
        $total_iw=0;
		$other_p=0;
        $other_i=0;
        $total_other=0;
		
        $total_rec=0;
        $resc=0;
        $iw=0;
        
        $wo=0;
		$total=0;
		$rec_red_total=0;
        ?>
        <?php foreach($result_array as $key=>$row) { ?>
		<tr>
        <?php 
        //total calculation
        $dp_resch_p=$dp_resch_p+$row['report_val']['recovery']['dp_resch_p'];
        $dp_resch_i=$dp_resch_i+$row['report_val']['recovery']['dp_resch_i'];
        $total_resch=$total_resch+$row['report_val']['recovery']['total_resch'];
		
		$dp_iw_p=$dp_iw_p+$row['report_val']['recovery']['dp_iw_p'];
        $dp_iw_i=$dp_iw_i+$row['report_val']['recovery']['dp_iw_i'];
        $total_iw=$total_iw+$row['report_val']['recovery']['total_iw'];
		
		$other_p=$other_p+$row['report_val']['recovery']['other_p'];
        $other_i=$other_i+$row['report_val']['recovery']['other_i'];
        $total_other=$total_other+$row['report_val']['recovery']['total_other'];
        
		$total_rec=$total_rec+$row['report_val']['recovery']['recovery_total'];
        
		$resc=$resc+$row['report_val']['reduction']['resc'];
		$iw=$iw+$row['report_val']['reduction']['iw'];
		$wo=$wo+$row['report_val']['reduction']['wo'];
		
		$total=$total+$row['report_val']['reduction']['red_total'];
		$rec_red_total=$rec_red_total+$row['report_val']['rec_red']['rec_red_total'];

		
        ?>
		<td align="center"><?php echo ($key+1); ?></td>		
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['dp_resch_p'])?round($row['report_val']['recovery']['dp_resch_p'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['dp_resch_i'])?round($row['report_val']['recovery']['dp_resch_i'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['total_resch'])?round($row['report_val']['recovery']['total_resch'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['dp_iw_p'])?round($row['report_val']['recovery']['dp_iw_p'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['dp_iw_i'])?round($row['report_val']['recovery']['dp_iw_i'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['total_iw'])?round($row['report_val']['recovery']['total_iw'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['other_p'])?round($row['report_val']['recovery']['other_p'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['other_i'])?round($row['report_val']['recovery']['other_i'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['total_other'])?round($row['report_val']['recovery']['total_other'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['recovery']['recovery_total'])?round($row['report_val']['recovery']['recovery_total'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['reduction']['resc'])?round($row['report_val']['reduction']['resc'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['reduction']['iw'])?round($row['report_val']['reduction']['iw'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['reduction']['wo'])?round($row['report_val']['reduction']['wo'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['reduction']['red_total'])?round($row['report_val']['reduction']['red_total'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['rec_red']['rec_red_total'])?round($row['report_val']['rec_red']['rec_red_total'],2):'-'; ?></td>
		</tr>
        <?php } ?>
        
        <tr style="font-weight: bold;">
    		<td align="left" colspan="2">Total</td>
    		<td align="right"><?php echo round($dp_resch_p,2); ?></td>
    		<td align="right"><?php echo round($dp_resch_i,2); ?></td>
    		<td align="right"><?php echo round($total_resch,2); ?></td>
			<td align="right"><?php echo round($dp_iw_p,2); ?></td>
    		<td align="right"><?php echo round($dp_iw_i,2); ?></td>
    		<td align="right"><?php echo round($total_iw,2); ?></td>
			<td align="right"><?php echo round($other_p,2); ?></td>
			<td align="right"><?php echo round($other_i,2); ?></td>
    		<td align="right"><?php echo round($total_other,2); ?></td>
    		<td align="right"><?php echo round($total_rec,2); ?></td>
    		<td align="right"><?php echo round($resc,2); ?></td>
    		<td align="right"><?php echo round($iw,2); ?></td>
    		<td align="right"><?php echo round($wo,2); ?></td>
			<td align="right"><?php echo round($total,2); ?></td>
			<td align="right"><?php echo round($rec_red_total,2); ?></td>
        </tr>
</table>

<br/>
<?php 
}
?>