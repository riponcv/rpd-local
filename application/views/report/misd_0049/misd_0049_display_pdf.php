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
    <td align="center" style="font-size:18px;">Productivity Analysis (Per Branch)</td>
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
<br/><br />
<table style="margin-left: 878px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" style="border-collapse:collapse;" id="t1" align="center" width="800px">

<tr>
<th colspan="14" style="font-size:medium;font-style: italic;text-align: justify;">Source: [2,3]=>CIS, [4,5,7,8,9,10,11]=>Affairs, [12,13,14]=>OMIS, [6]=>CL</th>
</tr>

<tr>
<th rowspan="2">SL</th>
<th rowspan="2"><?php echo isset($list_title)?$list_title:'Office'; ?></th>
<th rowspan="2">Total Branch</th>
<th colspan="11">Per Branch</th>
</tr>

<tr>
<th>Deposit(with BP)</th>
<th>Loan and Advances</th>
<th>Classified Loan and Advances</th>
<th>Interest Income</th>
<th>Interest Expense</th>
<th>Total Revenue</th>
<th>Total Expense</th>
<th>Operating Profit</th>
<th>Import</th>
<th>Export</th>
<th>Foreign Remittance</th>
</tr>

<tr>
<th>1</th>
<th>2</th>
<th>3</th>
<th>4</th>
<th>5</th>
<th>6</th>
<th>7</th>
<th>8</th>
<th>9</th>
<th>10</th>
<th>11</th>
<th>12</th>
<th>13</th>
<th>14</th>
</tr>

<?php 
$total_br=0;
$total_dp=0;
$total_adv=0;
$total_cl_amt=0;
$total_int_income=0;
$total_int_expense=0;
$total_revenue=0;
$total_expenditure=0;
$total_op_pl=0;
$total_import=0;
$total_export=0;
$total_fr=0;

foreach($result_array as $key=>$row)
{ 
  
  if(isset($row['no_of_branch'])){$total_br=$total_br+$row['no_of_branch'];}
  if(isset($row['report_val']['dp'])){$total_dp=$total_dp+$row['report_val']['dp'];}
  if(isset($row['report_val']['adv'])){$total_adv=$total_adv+$row['report_val']['adv'];}
  if(isset($row['report_val']['ClAmount'])){$total_cl_amt=$total_cl_amt+$row['report_val']['ClAmount'];}
  if(isset($row['report_val']['int_income'])){$total_int_income=$total_int_income+$row['report_val']['int_income'];}
  if(isset($row['report_val']['int_expense'])){$total_int_expense=$total_int_expense+$row['report_val']['int_expense'];}
  if(isset($row['report_val']['income'])){$total_revenue=$total_revenue+$row['report_val']['income'];}
  if(isset($row['report_val']['expenditure'])){$total_expenditure=$total_expenditure+$row['report_val']['expenditure'];}
  if(isset($row['report_val']['pl'])){$total_op_pl=$total_op_pl+$row['report_val']['pl'];}
  if(isset($row['report_val']['import'])){$total_import=$total_import+$row['report_val']['import'];}
  if(isset($row['report_val']['export'])){$total_export=$total_export+$row['report_val']['export'];}
  if(isset($row['report_val']['foreign_remittance'])){$total_fr=$total_fr+$row['report_val']['foreign_remittance'];}  
?>

<?php
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['dp'])){$dp=round($row['report_val']['dp']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['adv'])){$adv=round($row['report_val']['adv']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['ClAmount'])){$ClAmount=round($row['report_val']['ClAmount']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['int_income'])){$int_income=round($row['report_val']['int_income']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['int_expense'])){$int_expense=round($row['report_val']['int_expense']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['income'])){$income=round($row['report_val']['income']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['expenditure'])){$expenditure=round($row['report_val']['expenditure']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['pl'])){$pl=round($row['report_val']['pl']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['import'])){$import=round($row['report_val']['import']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['export'])){$export=round($row['report_val']['export']/($row['no_of_branch']*10000000),2);}
if(isset($row['no_of_branch']) && $row['no_of_branch']>0 && isset($row['report_val']['foreign_remittance'])){$foreign_remittance=round($row['report_val']['foreign_remittance']/($row['no_of_branch']*10000000),2);}
?>

<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:'-'; ?></td>
<td align="right"><?php echo isset($row['no_of_branch'])?$row['no_of_branch']:'-'; ?></td>
<td align="right"><?php echo isset($dp)?$dp:'-'; ?></td>
<td align="right"><?php echo isset($adv)?$adv:'-'; ?></td>
<td align="right"><?php echo isset($ClAmount)?$ClAmount:'-'; ?></td>
<td align="right"><?php echo isset($int_income)?$int_income:'-'; ?></td>
<td align="right"><?php echo isset($int_expense)?$int_expense:'-'; ?></td>
<td align="right"><?php echo isset($income)?$income:'-'; ?></td>
<td align="right"><?php echo isset($expenditure)?$expenditure:'-'; ?></td>
<td align="right"><?php echo isset($pl)?$pl:'-'; ?></td>
<td align="right"><?php echo isset($import)?$import:'-'; ?></td>
<td align="right"><?php echo isset($export)?$export:'-'; ?></td>
<td align="right"><?php echo isset($foreign_remittance)?$foreign_remittance:'-'; ?></td>


</tr>
<?php } ?>

<tr>
<th colspan="2">Total</th>
<th align="right"><?php echo isset($total_br)?$total_br:'-'; ?></th>
<?php
if(isset($total_br) && $total_br>0 && isset($total_dp)){$total_dp_per=round($total_dp/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_adv)){$total_adv_per=round($total_adv/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_cl_amt)){$total_cl_amt_per=round($total_cl_amt/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_int_income)){$total_int_income_per=round($total_int_income/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_int_expense)){$total_int_expense_per=round($total_int_expense/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_revenue)){$total_revenue_per=round($total_revenue/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_expenditure)){$total_expenditure_per=round($total_expenditure/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_op_pl)){$total_op_pl_per=round($total_op_pl/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_import)){$total_import_per=round($total_import/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_export)){$total_export_per=round($total_export/($total_br*10000000),2);}
if(isset($total_br) && $total_br>0 && isset($total_fr)){$total_fr_per=round($total_fr/($total_br*10000000),2);}
?>
<th align="right"><?php echo isset($total_dp_per)?$total_dp_per:'-'; ?></th>
<th align="right"><?php echo isset($total_adv_per)?$total_adv_per:'-'; ?></th>
<th align="right"><?php echo isset($total_cl_amt_per)?$total_cl_amt_per:'-'; ?></th>
<th align="right"><?php echo isset($total_int_income_per)?$total_int_income_per:'-'; ?></th>
<th align="right"><?php echo isset($total_int_expense_per)?$total_int_expense_per:'-'; ?></th>
<th align="right"><?php echo isset($total_revenue_per)?$total_revenue_per:'-'; ?></th>
<th align="right"><?php echo isset($total_expenditure_per)?$total_expenditure_per:'-'; ?></th>
<th align="right"><?php echo isset($total_op_pl_per)?$total_op_pl_per:'-'; ?></th>
<th align="right"><?php echo isset($total_import_per)?$total_import_per:'-'; ?></th>
<th align="right"><?php echo isset($total_export_per)?$total_export_per:'-'; ?></th>
<th align="right"><?php echo isset($total_fr_per)?$total_fr_per:'-'; ?></th>
</tr>
</table>
<br/>
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