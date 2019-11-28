<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>

<?php
$report_title='';
$total_row_colspan=0;
$unit_margin=0;
if(isset($report_click_btn) && $report_click_btn==1)
{
    $report_title='Deposits Distributed by Rates of Interest/Profit';
    $total_row_colspan=4;
    $unit_margin='675px';
}
if(isset($report_click_btn) && $report_click_btn==2)
{
    $report_title='Advances Classified by Rates of Interest/Profit';
    $total_row_colspan=2;
    $unit_margin='430px';
}
?>

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;"><?php echo $report_title; ?></td>
  </tr>
  <tr>
  <?php $month_array=array('03'=>'1st Quarter','06'=>'2nd Quarter','09'=>'3rd Quarter','12'=>'4th Quarter'); ?>
    <td align="center" >For <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
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
<table border="1" align="right" style="border: thin;margin-top: -85px;border-collapse:collapse;" id="t1">
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

<table style="margin-left:<?php echo $unit_margin; ?>;"><tr><td>Amount in unit taka</td></tr></table>
<table border="1" style="border-collapse:collapse;" id="t1" align="center">
<tr>
<th>SL</th>
<?php if(isset($report_click_btn) && $report_click_btn==1){ ?>
<th>Types of Deposits Code</th>
<th>Description</th>
<?php } ?>
<th>Rate of Interest/Profit</th>
<th>Account</th>
<th>Outstanding Amount</th>
</tr>
<?php
$total_ac=0;
$total_amt=0;
foreach($result_array as $key=>$row)
{
    $total_ac=$total_ac+$row['ac'];
    $total_amt=$total_amt+$row['amt'];
    ?>
    <tr>
    <td align="center"><?php echo $key+1; ?></td>
    <?php if(isset($report_click_btn) && $report_click_btn==1){ ?>
    <td align="center"><?php echo isset($row['type'])?$row['type']:''; ?></td>
    <td align="left"><?php echo isset($row['depotypedesc'])?$row['depotypedesc']:''; ?></td>
    <?php } ?>
    <td align="right"><?php echo isset($row['interest'])?round($row['interest'],2):''; ?></td>
    <td align="right"><?php echo isset($row['ac'])?round($row['ac'],2):''; ?></td>
    <td align="right"><?php echo isset($row['amt'])?round($row['amt'],2):''; ?></td>
    </tr>
    <?php
}

?>
<tr style="font-weight: bold;">
<td align="center" colspan="<?php echo $total_row_colspan; ?>">Total</td>
<td align="right"><?php echo isset($total_ac)?round($total_ac,2):''; ?></td>
<td align="right"><?php echo isset($total_amt)?round($total_amt,2):''; ?></td>
</tr>

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