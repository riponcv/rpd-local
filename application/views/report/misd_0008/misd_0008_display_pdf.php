<style type="text/css">
html { 
margin-left: 25px;
margin-bottom: 5px;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Consolidated Classified Loan Position</td>
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
<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><td>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></td></tr><?php } ?>
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
<br/>
<table style="margin-left: 800px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" align="center" style="border-collapse:collapse;" id="t1">
	<tr style="font-size: x-large;">
		<td align="center" width="400" colspan="4">Unclassified Loan</td>
		<td align="center" width="400" colspan="4">Classified Loan</td>
	</tr>
	<tr>
		<td align="center" width="120px">Type</td>
		<td align="center" width="80px">Amount</td>
        <td align="center" width="50px">%</td>
        <td align="center" rowspan="5" style="font-size: xx-large;" width="160px"><?php echo isset($result_array['cl_advance']['uc_p'])?round($result_array['cl_advance']['uc_p'],2).'%':'-'; ?></td>
        <td align="center" width="120px">Type</td>
		<td align="center" width="80px">Amount</td>
        <td align="center" width="50px">%</td>
        <td align="center" rowspan="5" style="font-size: xx-large;" width="160px"><?php echo isset($result_array['cl_advance']['cl_p'])?round($result_array['cl_advance']['cl_p'],2).'%':'-'; ?></td>
	</tr>
    
   	<tr>
		<td align="left" rowspan="2">Standard <br />(Without stuff loan)</td>
		<td align="right" rowspan="2"><?php echo isset($result_array['cl_advance']['standard'])?round($result_array['cl_advance']['standard'],2):'-'; ?></td>
        <td align="right" rowspan="2"><?php echo isset($result_array['cl_advance']['standard_p'])?round($result_array['cl_advance']['standard_p'],2):'-'; ?></td>

        <td align="left" >SS</td>
		<td align="right" ><?php echo isset($result_array['cl_advance']['ss'])?round($result_array['cl_advance']['ss'],2):'-'; ?></td>
        <td align="right" ><?php echo isset($result_array['cl_advance']['ss_p'])?round($result_array['cl_advance']['ss_p'],2):'-'; ?></td>
	</tr>
   	<tr>
        <td align="left" >DF</td>
		<td align="right" ><?php echo isset($result_array['cl_advance']['df'])?round($result_array['cl_advance']['df'],2):'-'; ?></td>
        <td align="right" ><?php echo isset($result_array['cl_advance']['df_p'])?round($result_array['cl_advance']['df_p'],2):'-'; ?></td>
	</tr>

	<tr>
		<td align="left" >SMA</td>
		<td align="right" ><?php echo isset($result_array['cl_advance']['sma'])?round($result_array['cl_advance']['sma'],2):'-'; ?></td>
        <td align="right" ><?php echo isset($result_array['cl_advance']['sma_p'])?round($result_array['cl_advance']['sma_p'],2):'-'; ?></td>
        <td align="left" >BL</td>
		<td align="right" ><?php echo isset($result_array['cl_advance']['bl'])?round($result_array['cl_advance']['bl'],2):'-'; ?></td>
        <td align="right" ><?php echo isset($result_array['cl_advance']['bl_p'])?round($result_array['cl_advance']['bl_p'],2):'-'; ?></td>
	</tr>
    
    
   	<tr>
		<td align="left"  >Total</td>
		<td align="right"  ><?php echo isset($result_array['cl_advance']['uc'])?round($result_array['cl_advance']['uc'],2):'-'; ?></td>
        <td align="right"  ><?php echo isset($result_array['cl_advance']['uc_p'])?round($result_array['cl_advance']['uc_p'],2):'-'; ?></td>
		<td align="left"  >Total</td>
		<td align="right"  ><?php echo isset($result_array['cl_advance']['cl'])?round($result_array['cl_advance']['cl'],2):'-'; ?></td>
        <td align="right"  ><?php echo isset($result_array['cl_advance']['cl_p'])?round($result_array['cl_advance']['cl_p'],2):'-'; ?></td>
	</tr>
    
    
   	<tr align="center" style="font-size: larger;;">
        <td align="center" colspan="8">Total Advance (UC + CL ) : <?php echo isset($result_array['cl_advance']['grand_total'])?round($result_array['cl_advance']['grand_total'],2):'-'; ?></td>
	</tr>
    
</table>
<br/>
<?php 
}
?>