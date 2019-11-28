<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CIBTA Statement</title>
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<div id="printarea" style="width:800px">
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">CIBTA Originating Outstanding</td>
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
<table border="1" align="right" style="margin-top: -90px;">
  <tr>
    <td width="80">Report</td>
    <td width="175"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="80">Printing Date </td>
    <td width="175"><?php echo date('d/m/y'); ?></td>
  </tr>
  <tr>
    <td width="80">Source </td>
    <td width="175">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>

<br />
<table border="1">
<tr>
<td colspan="8" style="font-size:medium;font-style: italic;text-align: justify;">***Please Contact with Responding Branch &#38 Reconcilation Department for settlement of unreconciled items.</td>
</tr>
<tr>
<th>SL</th>
<th>Org Br Code</th>
<th>Org Date</th>
<th>Res Br Code</th>
<th>Advice No</th>
<th>Tr Type Code</th>
<th>Dr Amount</th>
<th>Cr Amount</th>
</tr>
<?php 
$total_dr=0;
$total_cr=0;
$count_dr=0;
$count_cr=0;
foreach($result_array as $key=>$row) 
{
    if($row['Dr_amt']>0)
    {
      $total_dr=$total_dr+$row['Dr_amt'];
      $count_dr++;  
    }
    if($row['Cr_Amt']>0)
    {
      $total_cr=$total_cr+$row['Cr_Amt'];
      $count_cr++;  
    }
?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="center"><?php echo isset($row['Org_Br_Code'])?$row['Org_Br_Code']:''; ?></td>
<td align="center"><?php echo isset($row['Org_date'])?$row['Org_date']:''; ?></td>
<td align="center"><?php echo isset($row['Res_Br_Code'])?$row['Res_Br_Code']:''; ?></td>
<td align="center"><?php echo isset($row['Ad_no'])?$row['Ad_no']:''; ?></td>
<td align="center"><?php echo isset($row['Tr_Type_Code'])?$row['Tr_Type_Code']:''; ?></td>
<td align="right"><?php echo isset($row['Dr_amt'])?round($row['Dr_amt'],2):''; ?></td>
<td align="right"><?php echo isset($row['Cr_Amt'])?round($row['Cr_Amt'],2):''; ?></td>
</tr>
<?php 
}
?>
<tr bgcolor="gray">
<td colspan="6" style="font-weight: bold;">Total</td>
<td style="font-weight: bold;" align="right"><?php echo isset($total_dr)?round($total_dr,2):''; ?></td>
<td style="font-weight: bold;" align="right"><?php echo isset($total_cr)?round($total_cr,2):''; ?></td>
</tr>
<tr bgcolor="gray">
<td colspan="8" style="font-weight: bold;" align="center">Total Debit Entry: <?php echo $count_dr; ?>   &#38   Total Credit Entry: <?php echo $count_cr; ?></td>
</tr>
<?php 
?>
</table>
</div>
<br/>
<?php 
	/*
    echo form_open('report/misd_0043_report_details/1');
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
	echo form_close();  */
	
		?>
	<input type="button" value="Print" onclick="printDiv('printarea')" style="background-color: #FF9900"/>
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
<br/>
</body>
</html>
