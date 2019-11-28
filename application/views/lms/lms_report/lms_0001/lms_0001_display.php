 
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:20px;">Summary Report</td>
  </tr>
  <tr>
  <?php $month_array=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >Up to <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?>, <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
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

<br />
<table align="right"><tr><td>Amount in BDT</td></tr></table>
<br/>
<table border="1">
	<tr>
		<th rowspan="2">Sl No.</th>
		<th style="text-align:center" rowspan="2"><?php echo isset($list_title)?$list_title:'Office'; ?></th>
		<th style="text-align:center" colspan="2">Writ Cases</th>
		<th style="text-align:center" colspan="2">Artha Rin Suit</th>
		<th style="text-align:center" colspan="2">Insolvancy Suit</th>
		<th style="text-align:center" colspan="2">Money Suit</th>
    <th style="text-align:center" colspan="2">Certificate Case</th>
    <th style="text-align:center" colspan="2">Other Suit</th>
		<th style="text-align:center" colspan="2">Total</th>
	</tr>
  
	<tr>
		<th>Number</th>
		<th>Amount</th>
		<th>Number</th>
		<th>Amount</th>
		<th>Number</th>
		<th>Amount</th>
		<th>Number</th>
		<th>Amount</th>
    <th>Number</th>
		<th>Amount</th>
    <th>Number</th>
		<th>Amount</th>
		<th>Number</th>
		<th>Amount</th>
	</tr>
  <?php 
    $total_writ_suitNo = 0;
    $total_writ_suitAmt = 0;
    $total_artha_suitNo = 0;
    $total_artha_suitAmt = 0;
    $total_insolvance_suitNo = 0;
    $total_insolvance_suitAmt = 0;
    $total_money_suitNo = 0;
    $total_money_suitAmt = 0;
    $total_cetrificate_suitNo = 0;
    $total_cetrificate_suitAmt = 0;
    $total_other_suitNo = 0;
    $total_other_suitAmt = 0;
    $total_no = 0;
    $total_amt = 0;
    foreach($result_array as $key=>$row) {
      $total_writ_suitNo = $total_writ_suitNo + $row['report_val']['writ_suitNo'];
      $total_writ_suitAmt = $total_writ_suitAmt + $row['report_val']['writ_suitAmt'];
      $total_artha_suitNo = $total_artha_suitNo + $row['report_val']['artha_suitNo'];
      $total_artha_suitAmt = $total_artha_suitAmt + $row['report_val']['artha_suitAmt'];
      $total_insolvance_suitNo = $total_insolvance_suitNo + $row['report_val']['insolvance_suitNo'];
      $total_insolvance_suitAmt = $total_insolvance_suitAmt + $row['report_val']['insolvance_suitAmt'];
      $total_money_suitNo = $total_money_suitNo + $row['report_val']['money_suitNo'];
      $total_money_suitAmt = $total_money_suitAmt + $row['report_val']['money_suitAmt'];
      $total_cetrificate_suitNo = $total_cetrificate_suitNo + $row['report_val']['cetrificate_suitNo'];
      $total_cetrificate_suitAmt = $total_cetrificate_suitAmt + $row['report_val']['cetrificate_suitAmt'];
      $total_other_suitNo = $total_other_suitNo + $row['report_val']['other_suitNo'];
      $total_other_suitAmt = $total_other_suitAmt + $row['report_val']['other_suitAmt'];

      $total_no = $total_no + $row['report_val']['writ_suitNo']+$row['report_val']['artha_suitNo']+$row['report_val']['cetrificate_suitNo']+$row['report_val']['insolvance_suitNo']+$row['report_val']['money_suitNo']+$row['report_val']['other_suitNo'];
      $total_amt = $total_amt + $row['report_val']['writ_suitAmt']+$row['report_val']['artha_suitAmt']+$row['report_val']['cetrificate_suitAmt']+$row['report_val']['insolvance_suitAmt']+$row['report_val']['money_suitAmt']+$row['report_val']['other_suitAmt'];
    ?>
    
	<tr>
		<td><?php echo ($key+1); ?></td>
		<td align="center"><?php echo isset($row['office_name'])?$row['office_name']:'-'; ?></td>
    <td align="right"><?php echo isset($row['report_val']['writ_suitNo'])?$row['report_val']['writ_suitNo']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['writ_suitAmt'])?number_format($row['report_val']['writ_suitAmt'], 2):''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['artha_suitNo'])?$row['report_val']['artha_suitNo']:''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['artha_suitAmt'])?number_format($row['report_val']['artha_suitAmt'], 2):''; ?></td>
    
    <td align="right"><?php echo isset($row['report_val']['insolvance_suitNo'])?$row['report_val']['insolvance_suitNo']:''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['insolvance_suitAmt'])?number_format($row['report_val']['insolvance_suitAmt'], 2):''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['money_suitNo'])?$row['report_val']['money_suitNo']:''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['money_suitAmt'])?number_format($row['report_val']['money_suitAmt'], 2):''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['cetrificate_suitNo'])?$row['report_val']['cetrificate_suitNo']:''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['cetrificate_suitAmt'])?number_format($row['report_val']['cetrificate_suitAmt'], 2):''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['other_suitNo'])?$row['report_val']['other_suitNo']:''; ?></td>
    <td align="right"><?php echo isset($row['report_val']['other_suitAmt'])?number_format($row['report_val']['other_suitAmt'], 2):''; ?></td>
    <td align="right"><?php 
        echo ($row['report_val']['writ_suitNo']+$row['report_val']['artha_suitNo']+$row['report_val']['cetrificate_suitNo']+$row['report_val']['insolvance_suitNo']+$row['report_val']['money_suitNo']+$row['report_val']['other_suitNo']); 
      ?></td>
		<td align="right">
    <?php 
        echo number_format(($row['report_val']['writ_suitAmt']+$row['report_val']['artha_suitAmt']+$row['report_val']['cetrificate_suitAmt']+$row['report_val']['insolvance_suitAmt']+$row['report_val']['money_suitAmt']+$row['report_val']['other_suitAmt']), 2); 
      ?>
    </td>
	</tr>
  <?php } ?>
  <tr style="background-color: #ddd; font-weight:700; text-align:right">
      <td colspan="2">Total</td>
      <td><?php echo isset($total_writ_suitNo)?$total_writ_suitNo:''; ?></td>
      <td><?php echo isset($total_writ_suitAmt)?number_format($total_writ_suitAmt, 2):''; ?></td>
      <td><?php echo isset($total_artha_suitNo )?$total_artha_suitNo :''; ?></td>
      <td><?php echo isset($total_artha_suitAmt)?number_format($total_artha_suitAmt, 2):''; ?></td>
      <td><?php echo isset($total_insolvance_suitNo )?$total_insolvance_suitNo :''; ?></td>
      <td><?php echo isset($total_insolvance_suitAmt)?number_format($total_insolvance_suitAmt, 2):''; ?></td>
      <td><?php echo isset($total_money_suitNo )?$total_money_suitNo :''; ?></td>
      <td><?php echo isset($total_money_suitAmt)?number_format($total_money_suitAmt, 2):''; ?></td>
      <td><?php echo isset($total_cetrificate_suitNo )?$total_cetrificate_suitNo :''; ?></td>
      <td><?php echo isset($total_cetrificate_suitAmt)?number_format($total_cetrificate_suitAmt, 2):''; ?></td>
      <td><?php echo isset($total_other_suitNo )?$total_other_suitNo :''; ?></td>
      <td><?php echo isset($total_other_suitAmt)?number_format($total_other_suitAmt, 2):''; ?></td>

      <td><?php echo isset($total_no )?$total_no :''; ?></td>
      <td><?php echo isset($total_amt)?number_format($total_amt, 2):''; ?></td>


  </tr>
</table>
<?php 

    echo form_open('report/misd_0001_report_details/1');
    if(isset($previous_value) && !empty($previous_value))
    {
        foreach($previous_value as $key=>$val)
        {
            ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
            <?php
        }
    }
    
    //$attribute='style="background-color: #FF9900;"';
	//echo form_submit('actionbtn', 'Save AS PDF',$attribute);
	echo form_close();  
    
    }else{
        echo "<table border=\"1\" align=\"center\">"; 	
          echo "<tr>";
            echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
          echo "</tr>";
    	  echo "</table>";
    }

?>
