<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CL1 Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
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
<table style="margin-right: -820px;"><tr><td>Amount in Lac</td></tr></table>
<br/>
<table border="1">
	<tr style="font-weight:bold">
		<td align="center" width="20" style="font-size:16px; ">SL</td>
        <td align="center" width="500" style="font-size:16px;"><?php echo isset($list_title)?$list_title:'Office'; ?></td>
		<td align="center" width="80" style="font-size:16px;">Standard</td>
		<td align="center" width="80" style="font-size:16px;">SMA</td>
		<td align="center" width="80" style="font-size:16px;">Total UCL</td>
		<td align="center" width="80" style="font-size:16px;">SS</td>
		<td align="center" width="80" style="font-size:16px;">DF</td>
		<td align="center" width="80" style="font-size:16px;">BL</td>
		<td align="center" width="80" style="font-size:16px;">Total CL</td>
		<td align="center" width="80" style="font-size:16px;">Total Loan(Without staff and others)</td>
		<td align="center" width="80" style="font-size:16px;">Staff and Others Loan</td>
		<td align="center" width="80" style="font-size:16px;">Grand Total Loan</td>
		<td align="center" width="150" style="font-size:16px;">CL%</td>
	</tr>
	<tr style="font-weight:bold">
		<td align="center" >1</td>
        <td align="center">2</td>
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
		<td align="left" >13=((9*100)/10)</td>
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

    echo form_open('report/misd_0032_report_details/1');
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
