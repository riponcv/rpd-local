
<?php
$report_title='';
$total_row_colspan=0;
$unit_margin=0;
if(isset($report_click_btn) && $report_click_btn==1)
{
    $report_title='Deposits Distributed by Rates of Interest/Profit';
    $total_row_colspan=4;
    $unit_margin='-880px';
}
if(isset($report_click_btn) && $report_click_btn==2)
{
    $report_title='Advances Classified by Rates of Interest/Profit';
    $total_row_colspan=2;
    $unit_margin='-300px';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $report_title; ?></title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
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
    <td width="175">MISD JBL HO Dhaka</td>
  </tr>
</table>

<br />
<table style="margin-right:<?php echo $unit_margin; ?>;"><tr><td>Amount in unit taka</td></tr></table>
<table border="1">
<tr align="center">
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
<br/>
<?php 

    echo form_open('report/misd_0044_report_details/1');
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
