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
    <td align="center" style="font-size:18px;">Unit-wise Business Position</td>
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
<table border="1" style="border-collapse:collapse;" id="t1" align="center">
<tr>
<th>SL</th>
<th>Division</th>
<th>Area</th>
<th>Branch</th>
<th>HCD</th>
<th>LCD with BP</th>
<th>Total Deposit</th>
<th>HCD(%)</th>
<th>LCD(%)</th>
<th>Total Loans &#38; Advances</th>
<th>Operating Profit</th>
<th>ADR(%)</th>
<th>Amount of CL</th>
<th>CL(%)</th>
</tr>
<?php 
$total_hcd=0;
$total_lcd=0;
$total_dp=0;
$total_adv=0;
$total_pl=0;
$total_cl_amt=0;

foreach($result_array as $key=>$row)
{ 
if(isset($row['hcd']) && $row['hcd'] !=''){$total_hcd=$total_hcd+$row['hcd'];}
if(isset($row['lcd']) && $row['lcd'] !=''){$total_lcd=$total_lcd+$row['lcd'];}
if(isset($row['total_dp']) && $row['total_dp'] !=''){$total_dp=$total_dp+$row['total_dp'];}
if(isset($row['total_adv']) && $row['total_adv'] !=''){$total_adv=$total_adv+$row['total_adv'];}
if(isset($row['op_profit']) && $row['op_profit'] !=''){$total_pl=$total_pl+$row['op_profit'];}
if(isset($row['ClAmount']) && $row['ClAmount'] !=''){$total_cl_amt=$total_cl_amt+$row['ClAmount'];}     
?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['dvname'])?$row['dvname']:'-'; ?></td>
<td align="left"><?php echo isset($row['znname'])?$row['znname']:'-'; ?></td>
<td align="left"><?php echo isset($row['branchname'])?$row['branchname']:'-'; ?></td>
<td align="right"><?php echo isset($row['hcd'])?round($row['hcd']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['lcd'])?round($row['lcd']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['total_dp'])?round($row['total_dp']/10000000,2):'-'; ?></td>
<?php
if(isset($row['total_dp']) && $row['total_dp']>0 && isset($row['hcd']))
{
    $hcd_percentage=($row['hcd']*100)/$row['total_dp'];
}
?>
<?php
if(isset($row['total_dp']) && $row['total_dp']>0 && isset($row['lcd']))
{
    $lcd_percentage=($row['lcd']*100)/$row['total_dp'];
}
?>
<td align="right"><?php echo isset($hcd_percentage)?round($hcd_percentage,2):'-'; ?></td>
<td align="right"><?php echo isset($lcd_percentage)?round($lcd_percentage,2):'-'; ?></td>
<td align="right"><?php echo isset($row['total_adv'])?round($row['total_adv']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['op_profit'])?round($row['op_profit']/10000000,2):'-'; ?></td>
<?php
if(isset($row['total_dp']) && $row['total_dp']>0 && isset($row['total_adv']))
{
    $adr_percentage=($row['total_adv']*100)/$row['total_dp'];
}
?>
<td align="right"><?php echo isset($adr_percentage)?round($adr_percentage,2):'-'; ?></td>
<td align="right"><?php echo isset($row['ClAmount'])?round($row['ClAmount']/10000000,2):'-'; ?></td>
<?php
if(isset($row['total_adv']) && $row['total_adv']>0 && isset($row['ClAmount']))
{
    $cl_percentage=($row['ClAmount']*100)/$row['total_adv'];
}
?>
<td align="right"><?php echo isset($cl_percentage)?round($cl_percentage,2):'-'; ?></td>
</tr>
<?php } ?>


<tr style="font-weight: bold;">
<td align="center" colspan="4">Total</td>
<td align="right"><?php echo isset($total_hcd)?round($total_hcd/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($total_lcd)?round($total_lcd/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($total_dp)?round($total_dp/10000000,2):'-'; ?></td>
<?php
if(isset($total_dp) && $total_dp>0 && isset($total_hcd))
{
    $hcd_percentage_total=($total_hcd*100)/$total_dp;
}
?>
<?php
if(isset($total_dp) && $total_dp>0 && isset($total_lcd))
{
    $lcd_percentage_total=($total_lcd*100)/$total_dp;
}
?>
<td align="right"><?php echo isset($hcd_percentage_total)?round($hcd_percentage_total,2):'-'; ?></td>
<td align="right"><?php echo isset($lcd_percentage_total)?round($lcd_percentage_total,2):'-'; ?></td>
<td align="right"><?php echo isset($total_adv)?round($total_adv/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($total_pl)?round($total_pl/10000000,2):'-'; ?></td>


<?php
if(isset($total_dp) && $total_dp>0 && isset($total_adv))
{
    $adr_percentage_total=($total_adv*100)/$total_dp;
}
?>
<td align="right"><?php echo isset($adr_percentage_total)?round($adr_percentage_total,2):'-'; ?></td>
<td align="right"><?php echo isset($total_cl_amt)?round($total_cl_amt/10000000,2):'-'; ?></td>
<?php
if(isset($total_adv) && $total_adv>0 && isset($total_cl_amt))
{
    $cl_percentage_total=($total_cl_amt*100)/$total_adv;
}
?>
<td align="right"><?php echo isset($cl_percentage_total)?round($cl_percentage_total,2):'-'; ?></td>
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