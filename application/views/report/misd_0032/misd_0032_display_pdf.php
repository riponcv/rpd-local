<style type="text/css">
html { 
margin-left: 0px;
margin-bottom: 5px;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">CL1 Report</td>
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
<br />
<table align="right"><tr><td>Amount in Lac</td></tr></table>
<br/>
<br/>
<table border="1" style="border-collapse:collapse;" id="t1" align="center">
	<tr style="font-weight:bold">
		<td align="center" width="18">SL</td>
        <td align="center" width="165px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>
		<td align="center" width="57">Standard</td>
		<td align="center" width="57">SMA</td>
		<td align="center" width="57">Total UCL</td>
		<td align="center" width="57">SS</td>
		<td align="center" width="57">DF</td>
		<td align="center" width="57">BL</td>
		<td align="center" width="57">Total CL</td>
		<td align="center" width="57">Total Loan(Without staff and others)</td>
		<td align="center" width="57">Staff and Others Loan</td>
		<td align="center" width="57">Grand Total Loan</td>
		<td align="center" width="57">CL%</td>
	</tr>
	
	<tr style="font-weight:bold">
		<td align="center" >1</td>
        <td align="center" >2</td>
		<td align="center" >3</td>
		<td align="center" >4</td>
		<td align="center" >5=(3+4)</td>
		<td align="center" >6</td>
		<td align="center" >7</td>
		<td align="center" >8</td>
		<td align="center" >9=(6+7+8)</td>
		<td align="center" >10=(5+9)</td>
		<td align="center" >11</td>
		<td align="center" >12=(10+11)</td>
		<td align="center" >13=((9*100)/10)</td>
	</tr>
	
	<?php
	 $total_standard=0;
	 $total_sma=0;
	 $total_ucl_total=0;
	 $total_ss=0;
	 $total_df=0;
	 $total_bl=0;
	 $total_cl_total=0;
	 $total_loan_total=0;
	 $total_staff_and_others=0;
	 $total_grand_total=0;
	
	?>
	<?php foreach($result_array as $key=>$row) 
{ 
	 $total_standard=$total_standard+$row['report_val']['standard'];
	 $total_sma=$total_sma+$row['report_val']['sma'];
	 $total_ucl_total=$total_ucl_total+$row['report_val']['total_ucl'];
	 $total_ss=$total_ss+$row['report_val']['SS'];
	 $total_df=$total_df+$row['report_val']['DF'];
	 $total_bl=$total_bl+$row['report_val']['BL'];
	 $total_cl_total=$total_cl_total+$row['report_val']['total_cl'];
	 $total_loan_total=$total_loan_total+$row['report_val']['total_loan'];
	 
	  $total_staff_and_others=$total_staff_and_others+$row['report_val']['staff_and_others'];
	  $total_grand_total=$total_grand_total+$row['report_val']['grand_total'];
?>
	<tr>
		<td align="center"><?php echo ($key+1); ?></td>		
        <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['standard'])?round(($row['report_val']['standard']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['sma'])?round(($row['report_val']['sma']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['total_ucl'])?round(($row['report_val']['total_ucl']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['SS'])?round(($row['report_val']['SS']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['DF'])?round(($row['report_val']['DF']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['BL'])?round(($row['report_val']['BL']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['total_cl'])?round(($row['report_val']['total_cl']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['total_loan'])?round(($row['report_val']['total_loan']),2):'-'; ?></td>
		
		<td align="right"><?php echo isset($row['report_val']['staff_and_others'])?round(($row['report_val']['staff_and_others']),2):'-'; ?></td>
		
		<td align="right"><?php echo isset($row['report_val']['grand_total'])?round(($row['report_val']['grand_total']),2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['cl_percentage'])?round(($row['report_val']['cl_percentage']),2):'-'; ?></td>
	</tr>
	<?php
	}
	?>
	<tr style="background-color:#D0D0D0;font-weight:bold" height='40px'>
	     <td align="center" colspan="2"><?php echo "Total"; ?></td>	
		 <td align="right"><?php echo isset($total_standard)?round($total_standard,2):''; ?></td>
		 <td align="right"><?php echo isset($total_sma)?round($total_sma,2):''; ?></td>
		 <td align="right"><?php echo isset($total_ucl_total)?round($total_ucl_total,2):''; ?></td>
		 <td align="right"><?php echo isset($total_ss)?round($total_ss,2):''; ?></td>
		 <td align="right"><?php echo isset($total_df)?round($total_df,2):''; ?></td>
		 <td align="right"><?php echo isset($total_bl)?round($total_bl,2):''; ?></td>
		 <td align="right"><?php echo isset($total_cl_total)?round($total_cl_total,2):''; ?></td>
		 <td align="right"><?php echo isset($total_loan_total)?round($total_loan_total,2):''; ?></td>
		 <td align="right"><?php echo isset($total_staff_and_others)?round($total_staff_and_others,2):''; ?></td>
		 <td align="right"><?php echo isset($total_grand_total)?round($total_grand_total,2):''; ?></td>
		 <td align="right">
		 <?php 
		 if(isset($total_loan_total) && $total_loan_total>0)
		 {
		 echo round(($total_cl_total*100)/($total_loan_total),2); 
		 }
		 else
		 {
		 echo '-';
		 }
		 ?>
		 </td>
	</tr>
</table>
<?php 
}
?>