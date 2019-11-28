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
    <td align="center" style="font-size:18px;">Range Wise ADR</td>
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
  <?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
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
<br/><br/><br/>
<table style="margin-left: 560px;"><tr><td>Amount in Crore</td></tr></table>
<table align="center" border="1" id="t1">
	<tr>
        <th rowspan="2">Range of ADR</th>
        <th colspan="4">With SHBL and STAgMc</th>
        <th colspan="4">Without SHBL and STAgMc</th>
	</tr>
	<tr>
        <th>No of branch</th>
        <th>%</th>
        <th>Total Loan</th>
        <th>%</th>
        <th>No of branch</th>
        <th>%</th>
        <th>Total Loan</th>
        <th>%</th>
	</tr>
    
    <?php
    $grand_total_br_withLCA=0;
    $grand_total_advance_withLCA=0;
    $grand_total_br_withLCA_per=0;
    $grand_total_advance_withLCA_per=0;
    
    $grand_total_br_withoutLCA=0;
    $grand_total_advance_withoutLCA=0;
    $grand_total_br_withoutLCA_per=0;
    $grand_total_advance_withoutLCA_per=0;
    ?>
    
    <?php foreach($result_array as $key=>$row)
    {
    $grand_total_br_withLCA=$grand_total_br_withLCA+$row['total_br_withLCA'];
    $grand_total_advance_withLCA=$grand_total_advance_withLCA+$row['total_advance_withLCA'];
    $grand_total_br_withLCA_per=$grand_total_br_withLCA_per+$row['per_total_br_withLCA'];
    $grand_total_advance_withLCA_per=$grand_total_advance_withLCA_per+$row['per_total_advance_withLCA'];
    
    $grand_total_br_withoutLCA=$grand_total_br_withoutLCA+$row['total_br_withoutLCA'];
    $grand_total_advance_withoutLCA=$grand_total_advance_withoutLCA+$row['total_advance_withoutLCA'];
    $grand_total_br_withoutLCA_per=$grand_total_br_withoutLCA_per+$row['per_total_br_withoutLCA'];
    $grand_total_advance_withoutLCA_per=$grand_total_advance_withoutLCA_per+$row['per_total_advance_withoutLCA'];
    ?>
    <tr>
    <td align="left"><?php echo isset($row['range_text'])?$row['range_text']:''; ?></td>
    <td align="right"><?php echo isset($row['total_br_withLCA'])?$row['total_br_withLCA']:''; ?></td>
    <td align="right"><?php echo isset($row['per_total_br_withLCA'])?round($row['per_total_br_withLCA'],2):''; ?></td>
    <td align="right"><?php echo isset($row['total_advance_withLCA'])?round($row['total_advance_withLCA']/10000000,2):''; ?></td>
    <td align="right"><?php echo isset($row['per_total_advance_withLCA'])?round($row['per_total_advance_withLCA'],2):''; ?></td>
    <td align="right"><?php echo isset($row['total_br_withoutLCA'])?$row['total_br_withoutLCA']:''; ?></td>
    <td align="right"><?php echo isset($row['per_total_br_withoutLCA'])?round($row['per_total_br_withoutLCA'],2):''; ?></td>
    <td align="right"><?php echo isset($row['total_advance_withoutLCA'])?round($row['total_advance_withoutLCA']/10000000,2):''; ?></td>
    <td align="right"><?php echo isset($row['per_total_advance_withoutLCA'])?round($row['per_total_advance_withoutLCA'],2):''; ?></td>
    </tr>
    <?php } ?>
    <tr style="font-weight: bold;">
    <td align="left"><?php echo 'Total'; ?></td>
    <td align="right"><?php echo $grand_total_br_withLCA; ?></td>
    <td align="right"><?php echo round($grand_total_br_withLCA_per,2); ?></td>
    <td align="right"><?php echo round($grand_total_advance_withLCA/10000000,2); ?></td>
    <td align="right"><?php echo round($grand_total_advance_withLCA_per,2); ?></td>
    <td align="right"><?php echo $grand_total_br_withoutLCA; ?></td>
    <td align="right"><?php echo round($grand_total_br_withoutLCA_per,2); ?></td>
    <td align="right"><?php echo round($grand_total_advance_withoutLCA/10000000,2); ?></td>
    <td align="right"><?php echo round($grand_total_advance_withoutLCA_per,2); ?></td>
    </tr>
</table>
<br/>
<?php 
}
?>