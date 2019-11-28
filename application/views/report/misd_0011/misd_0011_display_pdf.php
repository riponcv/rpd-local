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
    <td align="center" style="font-size:18px;">Continuous Developing Branch Position</td>
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
<br/>

<?php

$upto_five_loss=0;
$upto_four_loss=0;
$upto_three_loss=0;
$upto_two_loss=0;
$upto_one_loss=0;

$upto_five_marginal=0;
$upto_four_marginal=0;
$upto_three_marginal=0;
$upto_two_marginal=0;
$upto_one_marginal=0;
?>

<?php foreach($result_array as $key=>$row)
{
    if(isset($row['status_index']) && $row['status_index']==1 && isset($row['status_value']))
    {
        if($row['status_value']==5){$upto_five_loss++;}
        if($row['status_value']==4){$upto_four_loss++;}
        if($row['status_value']==3){$upto_three_loss++;}
        if($row['status_value']==2){$upto_two_loss++;}
        if($row['status_value']==1){$upto_one_loss++;}
    }
    if(isset($row['status_index']) && $row['status_index']==2 && isset($row['status_value']))
    {
        if($row['status_value']==5){$upto_five_marginal++;}
        if($row['status_value']==4){$upto_four_marginal++;}
        if($row['status_value']==3){$upto_three_marginal++;}
        if($row['status_value']==2){$upto_two_marginal++;}
        if($row['status_value']==1){$upto_one_marginal++;}  
    }

}
?>

<table border="1" align="center" style="border-collapse:collapse;" id="t1">

<tr>
<td align="center">Indicator</td>
<?php for ($m=5; $m>=1; $m--){ ?>
<?php  
$year_text_start='Up to ';
$year_text_end=' years';
if($m==1)
{
 $year_text_start='';
 $year_text_end=' year';   
}
?>
 <td align="center" width="100px"><?php echo $year_text_start.$m.$year_text_end; ?></td>
 <?php } ?>
</tr>

<tr>
<td align="left">No Of Loss Branch</td>
<td align="center" style="font-size:xx-large"><?php echo $upto_five_loss; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_four_loss; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_three_loss; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_two_loss; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_one_loss; ?></td>
</tr>

<tr>
<td align="left">No Of Marginal Profit Branch</td>
<td align="center" style="font-size:xx-large"><?php echo $upto_five_marginal; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_four_marginal; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_three_marginal; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_two_marginal; ?></td>
<td align="center" style="font-size:xx-large"><?php echo $upto_one_marginal; ?></td>
</tr>

</table>

<br/>
<?php 
}
?>