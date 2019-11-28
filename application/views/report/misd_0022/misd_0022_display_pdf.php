<style type="text/css">
html { 
margin-top: 5px;
margin-left: 5px;
margin-bottom: 0px;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
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
<table border="1" align="right" style="border: thin;margin-top: -80px;border-collapse:collapse;" id="t1">
  <tr>
    <td width="65">Report</td>
    <td width="175"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
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
<br />
<?php if($report_click_btn==1||$report_click_btn==2||$report_click_btn==3||$report_click_btn==4||$report_click_btn==5||$report_click_btn==6){ ?>
<table align="right"><tr><td>Amount in Crore</td></tr></table>
<?php } ?>
<br />
<br />
<table border="1"  align="center" style="border-collapse:collapse;" id="t1">
<tr>
<td><strong>Sl. No</strong></td>
<td align="center"  style="font-weight: bold;" width="70"><?php echo isset($list_title)?$list_title:'Office'; ?>/Month</td>
<?php foreach($result_array[0]['report_val'] as $key=>$row) { ?>
<td align="center" style="font-weight: bold;"  width="45"><?php echo $row['month_name']; ?></td>
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

<?php 
}
?>