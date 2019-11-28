<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Aggregate Target Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Aggregate Target Report</td>
  </tr>
  <tr>
        <td align="center">Report of : <?php echo isset($report_of_year)?$report_of_year:''; ?></td>
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
<table style="margin-right: -872px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1">
<tr>
<th>SL</th>
<th><?php echo isset($list_title)?$list_title:'Office'; ?></th>
<th>Deposit</th>
<th>Advance</th>
<th>CL Amount</th>
<th>CL Recovery Cash</th>
<th>CL Reduction Reschedule</th>
<th>CL Reduction Interest Waiver</th>
<th>CL Reduction Write Off</th>
<th>Cash Recovery Write Off</th>
<th>Export</th>
<th>Import</th>
<th>Foreign Remittance</th>
<th>Non Intt. Income</th>
<th>PL</th>
</tr>

<?php
$deposit_t=0;
$advance_t=0;
$CL_amount_t=0;
$CL_recovery_cash_t=0;
$CL_reduction_reschedule_t=0;
$CL_reduction_interest_waiver_t=0;
$CL_reduction_write_off_t=0;
$cash_recovery_write_off_t=0;
$export_t=0;
$import_t=0;
$foreign_remittance_t=0;
$non_intt_income_t=0;
$pl_t=0;
?>


<?php foreach($result_array as $key=>$row) { ?>

<?php
$deposit_t=$deposit_t+$row['report_val']['deposit'];
$advance_t=$advance_t+$row['report_val']['advance'];
$CL_amount_t=$CL_amount_t+$row['report_val']['CL_amount'];
$CL_recovery_cash_t=$CL_recovery_cash_t+$row['report_val']['CL_recovery_cash'];
$CL_reduction_reschedule_t=$CL_reduction_reschedule_t+$row['report_val']['CL_reduction_reschedule'];
$CL_reduction_interest_waiver_t=$CL_reduction_interest_waiver_t+$row['report_val']['CL_reduction_interest_waiver'];
$CL_reduction_write_off_t=$CL_reduction_write_off_t+$row['report_val']['CL_reduction_write_off'];
$cash_recovery_write_off_t=$cash_recovery_write_off_t+$row['report_val']['cash_recovery_write_off'];
$export_t=$export_t+$row['report_val']['export'];
$import_t=$import_t+$row['report_val']['import'];
$foreign_remittance_t=$foreign_remittance_t+$row['report_val']['foreign_remittance'];
$non_intt_income_t=$non_intt_income_t+$row['report_val']['non_intt_income'];
$pl_t=$pl_t+$row['report_val']['pl'];
?>

<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
<td align="right"><?php echo isset($row['report_val']['deposit'])?round($row['report_val']['deposit']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['advance'])?round($row['report_val']['advance']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['CL_amount'])?round($row['report_val']['CL_amount']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['CL_recovery_cash'])?round($row['report_val']['CL_recovery_cash']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['CL_reduction_reschedule'])?round($row['report_val']['CL_reduction_reschedule']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['CL_reduction_interest_waiver'])?round($row['report_val']['CL_reduction_interest_waiver']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['CL_reduction_write_off'])?round($row['report_val']['CL_reduction_write_off']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['cash_recovery_write_off'])?round($row['report_val']['cash_recovery_write_off']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['export'])?round($row['report_val']['export']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['import'])?round($row['report_val']['import']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['foreign_remittance'])?round($row['report_val']['foreign_remittance']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['non_intt_income'])?round($row['report_val']['non_intt_income']/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($row['report_val']['pl'])?round($row['report_val']['pl']/10000000,2):'-'; ?></td>
</tr>

<?php } ?>

<tr style="font-weight: bold;">
<td align="left" colspan="2">Total</td>
<td align="right"><?php echo isset($deposit_t)?round($deposit_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($advance_t)?round($advance_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($CL_amount_t)?round($CL_amount_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($CL_recovery_cash_t)?round($CL_recovery_cash_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($CL_reduction_reschedule_t)?round($CL_reduction_reschedule_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($CL_reduction_interest_waiver_t)?round($CL_reduction_interest_waiver_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($CL_reduction_write_off_t)?round($CL_reduction_write_off_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($cash_recovery_write_off_t)?round($cash_recovery_write_off_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($export_t)?round($export_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($import_t)?round($import_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($foreign_remittance_t)?round($foreign_remittance_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($non_intt_income_t)?round($non_intt_income_t/10000000,2):'-'; ?></td>
<td align="right"><?php echo isset($pl_t)?round($pl_t/10000000,2):'-'; ?></td>
</tr>

</table>
<br/>
<?php 

    echo form_open('tms/agg_tms_report_details/1');
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
</body>
</html>
