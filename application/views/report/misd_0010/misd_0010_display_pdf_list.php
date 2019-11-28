<style type="text/css">
html { 
margin-left: 25px;
margin-bottom: 5px;
}
</style>
<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;"><?php echo isset($title)?$title:''; ?></td>
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
if(isset($ptr_val) && !empty($ptr_val))
{
?>

<table border="1" align="right" style="border: thin;margin-top: -80px; border-collapse:collapse;" id="t1">
  <tr>
    <td width="65">Report</td>
    <td width="140"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
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
<table border="1" align="center" style="border-collapse:collapse;" id="t1">
 <tr align="center">
 <td>SL</td>
 <td>Branch</td>
 <?php if($report_option_selector !=3){ ?>
 <td>Zone</td>
 <td>Division</td>
 <?php } ?>
 <td>Income</td>
 <td>Expenditure</td>
 <td>PL</td>
 </tr>
 
 <?php 
if($title=='List Of Loss Branch'){$syntax='loss_br';}
if($title=='List Of Marginal Profit Branch'){$syntax='marginal_br';} 
  
if(isset($report_option_selector) && $report_option_selector==5)
{
$str_p=$report_of_month-1;
$selected_array= $ptr_val->$str_p->report_val->$syntax;
}
else
{
$selected_array= $ptr_val[$report_of_month-1]->report_val->$syntax;
}  
 ?>
 
<?php foreach($selected_array as $key=>$row){ ?> 


<tr>
<td align="center"><?php echo $key+1; ?></td>
<td align="left"><?php echo isset($row->br_name)?$row->br_name:'-'; ?></td>
<?php if($report_option_selector !=3){ ?>
<td align="left"><?php echo isset($row->zn_name)?$row->zn_name:'-'; ?></td>
<td align="left"><?php echo isset($row->dv_name)?$row->dv_name:'-'; ?></td>
<?php } ?>
<td align="right"><?php echo isset($row->income)?round($row->income,2):'-'; ?></td>
<td align="right"><?php echo isset($row->expen)?round($row->expen,2):'-'; ?></td>
<td align="right"><?php echo isset($row->pl)?round($row->pl,2):'-'; ?></td
</tr>
<?php } ?>
</table>
<br/>
<?php 
}
?>