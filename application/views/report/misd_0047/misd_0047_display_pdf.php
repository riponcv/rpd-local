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
    <td align="center" style="font-size:18px;">Yearly New Loan Statement<br />(Loan above BDT 50000&#47;-)</td>
  </tr>
  	<tr>
	<td align="center" style="font-size:18px;">According to CIB</td>
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

<table border="1"  align="center" style="border-collapse:collapse;font_size:small;" id="t1">
<tr>
<td colspan="15" align="center"><strong>Month-Wise Number of New Loans and Total Limit Sanctioned for the year of <?php echo isset($report_of_year)?$report_of_year:'-'; ?> (Number of New Loans &#47; Total Limit Sanctioned)</strong></td>
</tr>
<tr>
<td><strong>Sl. No</strong></td>
<td align="center"  style="font-weight: bold;"><?php echo isset($list_title)?$list_title:'Office'; ?>/Month</td>
<?php foreach($result_array[0]['report_val'] as $key=>$row) { ?>
<td align="center" style="font-weight: bold;"><?php echo $row['month_name']; ?></td>
 <?php   }?>
 <td align="center" style="font-weight: bold;"><?php echo 'Total'; ?></td>
</tr>
<?php 

$total_no[0]=0;
$total_no[1]=0;
$total_no[2]=0;
$total_no[3]=0;
$total_no[4]=0;
$total_no[5]=0;
$total_no[6]=0;
$total_no[7]=0;
$total_no[8]=0;
$total_no[9]=0;
$total_no[10]=0;
$total_no[11]=0;
$total_no[12]=0;

$total_no_check[0]=0;
$total_no_check[1]=0;
$total_no_check[2]=0;
$total_no_check[3]=0;
$total_no_check[4]=0;
$total_no_check[5]=0;
$total_no_check[6]=0;
$total_no_check[7]=0;
$total_no_check[8]=0;
$total_no_check[9]=0;
$total_no_check[10]=0;
$total_no_check[11]=0;
$total_no_check[12]=0;

$total_limit[0]=0;
$total_limit[1]=0;
$total_limit[2]=0;
$total_limit[3]=0;
$total_limit[4]=0;
$total_limit[5]=0;
$total_limit[6]=0;
$total_limit[7]=0;
$total_limit[8]=0;
$total_limit[9]=0;
$total_limit[10]=0;
$total_limit[11]=0;
$total_limit[12]=0;

$total_limit_check[0]=0;
$total_limit_check[1]=0;
$total_limit_check[2]=0;
$total_limit_check[3]=0;
$total_limit_check[4]=0;
$total_limit_check[5]=0;
$total_limit_check[6]=0;
$total_limit_check[7]=0;
$total_limit_check[8]=0;
$total_limit_check[9]=0;
$total_limit_check[10]=0;
$total_limit_check[11]=0;
$total_limit_check[12]=0;

foreach($result_array as $key=>$row) 
{ 
?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:'-'; ?></td>
<?php 
$yearly_total_number=0;
$yearly_total_limit=0;

for($i=1;$i<=12;$i++) {
if(isset($row['report_val'][$i]['no_of_loan']))
{
	$total_no[$i]=$total_no[$i]+$row['report_val'][$i]['no_of_loan'];
    $total_no_check[$i]=1;
    $yearly_total_number=$yearly_total_number+$row['report_val'][$i]['no_of_loan'];
}

if(isset($row['report_val'][$i]['total_advance_limit']))
{
	$total_limit[$i]=$total_limit[$i]+$row['report_val'][$i]['total_advance_limit'];
    $total_limit_check[$i]=1;
    $yearly_total_limit=$yearly_total_limit+$row['report_val'][$i]['total_advance_limit'];
}
?>
<td align="right">
<?php echo isset($row['report_val'][$i]['no_of_loan'])?$row['report_val'][$i]['no_of_loan']:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($row['report_val'][$i]['total_advance_limit'])?number_format(round($row['report_val'][$i]['total_advance_limit'],0)):'-'; ?>
</td>
<?php }?>
<td align="right" style="font-weight: bolder;">
<?php echo isset($yearly_total_number)?$yearly_total_number:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($yearly_total_limit)?number_format(round($yearly_total_limit,0)):'-'; ?>
</td>

</tr>
<?php 
} ?>
<tr style="font-weight: bolder;">
<td colspan="2">Total</td>
<?php 
$yearly_grand_total_number=0;
$yearly_grand_total_limit=0;
for($i=1;$i<=12;$i++) 
{
if(isset($total_no[$i])){$yearly_grand_total_number=$yearly_grand_total_number+$total_no[$i];}
if(isset($total_limit[$i])){$yearly_grand_total_limit=$yearly_grand_total_limit+$total_limit[$i];}
?>
<td align="right">
<?php
if(isset($total_no_check[$i]) && $total_no_check[$i]==0)
{
    echo '-';
}
else
{
    echo isset($total_no[$i])?$total_no[$i]:'-';
}
?>
<hr align="right" width="80%" noshade="noshade" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php
if(isset($total_limit_check[$i]) && $total_limit_check[$i]==0)
{
    echo '-';
}
else
{
   echo isset($total_limit[$i])?number_format(round($total_limit[$i],0)):'-'; 
}
?>
</td>
<?php }?>
<td align="right" style="font-weight: bolder;">
<?php echo isset($yearly_grand_total_number)?$yearly_grand_total_number:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($yearly_grand_total_limit)?number_format(round($yearly_grand_total_limit,0)):'-'; ?>
</td>
</tr>
</table>



<?php 
}
?>