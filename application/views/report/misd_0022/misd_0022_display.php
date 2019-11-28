<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly Business Trend Cumulative Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<?php
$title_text='';

if($report_click_btn==1){$title_text_real='Low Cost Deposit';}
if($report_click_btn==2){$title_text_real='High Cost Deposit';}
if($report_click_btn==3){$title_text_real='Total Deposit';}
if($report_click_btn==4){$title_text_real='Total Advance';}
if($report_click_btn==5){$title_text_real='CL Amount';}
if($report_click_btn==6){$title_text_real='P/L Statement';}
if($report_click_btn==7){$title_text_real='Low Cost Deposit %';}
if($report_click_btn==8){$title_text_real='High Cost Deposit %';}
if($report_click_btn==9){$title_text_real='CL %';}
?>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Business Indicator Monitoring<br/><?php echo $title_text_real; ?> <?php echo $title_text; ?></td>
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
<br />
<?php if($report_click_btn==1||$report_click_btn==2||$report_click_btn==3||$report_click_btn==4||$report_click_btn==5||$report_click_btn==6){ ?>
<table align="right"><tr><td>Amount in Crore</td></tr></table>
<?php } ?>
<br />
<br />


<table border="1">
<tr>
<td><strong>Sl. No</strong></td>
<td align="center"  style="font-weight: bold;"><?php echo isset($list_title)?$list_title:'Office'; ?>/Month</td>
<?php foreach($result_array[0]['report_val'] as $key=>$row) { ?>
<td align="center" style="font-weight: bold;"  width="200px"><?php echo $row['month_name']; ?></td>
 <?php   }?>
</tr>
<?php 
$count=0;
$total[0]=0;
$total[1]=0;
$total[2]=0;
$total[3]=0;
$total[4]=0;
$total[5]=0;
$total[6]=0;
$total[7]=0;
$total[8]=0;
$total[9]=0;
$total[10]=0;
$total[11]=0;
$total[12]=0;
foreach($result_array as $key=>$row) 
{ 
$count++;
?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:'-'; ?></td>
<?php for($i=0;$i<=12;$i++) {
if(isset($row['report_val'][$i]['deposit']) && $row['report_val'][$i]['deposit']>0)
{
	$total[$i]=$total[$i]+$row['report_val'][$i]['deposit'];
}
?>
<td align="right"><?php echo isset($row['report_val'][$i]['deposit'])?round($row['report_val'][$i]['deposit'],2):'-'; ?></td>
<?php }?>
</tr>
<?php 
} ?>
<tr style="font-weight: bold;background-color:gray;">
<td colspan="2">Total</td>
<?php for($i=0;$i<=12;$i++) {?>
<td align="right">
<?php
$total_text=''; 
if($report_click_btn==7 || $report_click_btn==8 || $report_click_btn==9)
{
	if(isset($total[$i]))
	{
		$total_text=$total[$i]/$count;
	}
}
else
{
	if(isset($total[$i]))
	{
		$total_text=$total[$i];
	}
}
echo isset($total_text)?round($total_text,2):'-'; 
?>
</td>
<?php }?>
</tr>
</table>
<br/>
<?php 

    echo form_open('report/misd_0022_report_details/1');
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
