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
    <td align="center" style="font-size:18px;">Monthly New Loan Statement<br />(Loan above BDT 50000&#47;-)</td>
  </tr>
  	<tr>
	<td align="center" style="font-size:18px;">According to CIB</td>
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
<table border="1" style="border-collapse:collapse;" id="t1" align="center" width="800px">
<tr>
<th>SL</th>
<th><?php echo isset($list_title)?$list_title:'Office'; ?></th>
<th>Number of new loan</th>
<th>Total Advance Limit</th>
</tr>

<?php 
$total_no_of_loan=0;
$total_total_advance_limit=0;
foreach($result_array as $key=>$row)
{ 
  if(isset($row['report_val']['no_of_loan']))
  {
   $total_no_of_loan=$total_no_of_loan+$row['report_val']['no_of_loan']; 
  } 
  if(isset($row['report_val']['total_advance_limit']))
  {
   $total_total_advance_limit=$total_total_advance_limit+$row['report_val']['total_advance_limit']; 
  }  
?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['no_of_loan'])?$row['report_val']['no_of_loan']:'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['total_advance_limit'])?$row['report_val']['total_advance_limit']:'-'; ?></td>
</tr>
<?php } ?>

<tr>
<th colspan="2">Total</th>
<th align="right"><?php echo isset($total_no_of_loan)?$total_no_of_loan:'-'; ?></th>
<th align="right"><?php echo isset($total_total_advance_limit)?$total_total_advance_limit:'-'; ?></th>
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