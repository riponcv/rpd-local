<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Head Account/Single Account Comparisn Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
    <?php 
    
    $report_title='Head Account/Single Account Comparisn Report';
    $report_type_name='Head Account/Single Account Name';
    $report_type_text='';
    if(isset($previous_value['head_account_radio']) && $previous_value['head_account_radio']==1)
    {
        $report_title='Head Account Report';
        $report_type_name='Head Name :  ';
        $report_type_text=$previous_value['head_text'];
    }
    if(isset($previous_value['head_account_radio']) && $previous_value['head_account_radio']==2)
    {
        $report_title='Single Account Report';
        $report_type_name='Account Name :  ';
        $report_type_text=$previous_value['single_text'];
    }
    ?>
  <tr>
    <td align="center" style="font-size:18px;"><?php echo isset($report_title)?$report_title:''; ?></td>
  </tr>
  <tr>
    <td align="center">Comparisn of : <?php echo isset($report_of_date1)?$report_of_date1:''; ?><?php echo " and "; ?> <?php echo isset($report_of_date2)?$report_of_date2:''; ?></td>
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
<table border="1" align="right" style="margin-top: -80px;">
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

<table border="1" width="1000px">
<tr>
<th colspan="7"><?php echo isset($report_type_name)?$report_type_name:''; ?><?php echo isset($report_type_text)?$report_type_text:''; ?></th>
</tr>
<tr>
<th width="40px">SL</th>
<th width="150px">Division</th>
<th width="150px">Area</th>
<th width="250px">Branch</th>
<th width="150px">Amount as on <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th>
<th width="150px">Amount as on <?php echo isset($report_of_date2)?$report_of_date2:''; ?></th>
<th width="100px">Difference</th>
</tr>
<?php 
$total_amt1=0;
$total_amt2=0;
$total_diff=0;
foreach($result_array as $key=>$row)
{ 
?>
<tr>
<td align="center" width=""><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['dvname'])?$row['dvname']:''; ?></td>
<td align="left"><?php echo isset($row['znname'])?$row['znname']:''; ?></td>
<td align="left"><?php echo isset($row['branchname'])?$row['branchname']:''; ?></td>
<?php
$weekly_amt1='NA';
if(isset($row['weekly_amt1']) && $row['weekly_amt1']==0)
{
    $weekly_amt1=0;
}
if(isset($row['weekly_amt1']) && $row['weekly_amt1']>0)
{
    $weekly_amt1=$row['weekly_amt1'];
}

if($weekly_amt1 !='NA')
{
  $total_amt1=$total_amt1+$weekly_amt1; 
}

?>
<td align="right"><?php echo isset($weekly_amt1)?$weekly_amt1:''; ?></td>

<?php
$weekly_amt2='NA';
if(isset($row['weekly_amt2']) && $row['weekly_amt2']==0)
{
    $weekly_amt2=0;
}
if(isset($row['weekly_amt2']) && $row['weekly_amt2']>0)
{
    $weekly_amt2=$row['weekly_amt2'];
}

if($weekly_amt2 !='NA')
{
  $total_amt2=$total_amt2+$weekly_amt2; 
}

?>
<td align="right"><?php echo isset($weekly_amt2)?$weekly_amt2:''; ?></td>

<?php
$diff='NA';
if(isset($row['diff']) && $row['diff']==0)
{
    $diff=0;
}
if(isset($row['diff']) && $row['diff']>0)
{
    $diff=$row['diff'];
}
if(isset($row['diff']) && $row['diff']<0)
{
    $diff=$row['diff'];
}

if($diff !='NA')
{
  $total_diff=$total_diff+$diff; 
}

?>
<td align="right"><?php echo isset($diff)?$diff:''; ?></td>

</tr>
<?php } ?>

<tr style="background: gray;">
<td colspan="4" align="left" style="font-weight: bolder;">TOTAL</td>
<td align="right" style="font-weight: bolder;"><?php echo isset($total_amt1)?round($total_amt1,2):''; ?></td>
<td align="right" style="font-weight: bolder;"><?php echo isset($total_amt2)?round($total_amt2,2):''; ?></td>
<td align="right" style="font-weight: bolder;"><?php echo isset($total_diff)?round($total_diff,2):''; ?></td>
</tr>

</table>
<br/>
<?php 

    echo form_open('report/misd_0042_report_details/1');
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
