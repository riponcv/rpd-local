<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly New Loan Statement</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Monthly New Loan Statement<br />(Loan above BDT &#2547;50000&#47;-)</td>
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

<table border="1" align="center">
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
    
    echo form_open('report/misd_0046_report_details/1');
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
