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
    <td align="center" style="font-size:18px;">Developing Branch Position</td>
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

<?php foreach($result_array as $key=>$row){ ?> 

<?php
if(isset($row['report_val']))
{
    if(isset($row['report_val']['loss_br']))
    {
      ${'no_loss_br_'.$key}=count($row['report_val']['loss_br']);  
    }
    else
    {
      ${'no_loss_br_'.$key}=0;  
    }
    if(isset($row['report_val']['marginal_br']))
    {
      ${'no_marginal_br_'.$key}=count($row['report_val']['marginal_br']);  
    }
    else
    {
       ${'no_marginal_br_'.$key}=0; 
    }
}
else
{
    ${'no_loss_br_'.$key}='';
    ${'no_marginal_br_'.$key}='';
}
}
?>

<table border="1" align="center" style="border-collapse:collapse;" id="t1">

<tr>
<td align="center">Month</td>
<?php for ($m=1; $m<=12; $m++){ ?>

<?php 
if($previous_value['report_option_selector']==5)
{
    if($m%3==0)
    {
        ?><td align="center" width="50px"><?php echo date('M', mktime(0,0,0,$m,$m)); ?></td><?php
    }
}
else
{
    ?><td align="center" width="50px"><?php echo date('M', mktime(0,0,0,$m,$m)); ?></td><?php
}
?>

 <?php } ?>
</tr>

<tr>
<td align="left">No Of Loss Branch</td>
<?php for ($m=0; $m<12; $m++){ ?>
<?php
if($previous_value['report_option_selector']==5)
{
 if(($m+1)%3==0)
 {
    ?><td align="center" style="font-size:xx-large"><?php echo ${'no_loss_br_'.$m}; ?></td><?php
 }   
}
else
{
  ?><td align="center" style="font-size:xx-large"><?php echo ${'no_loss_br_'.$m}; ?></td><?php  
}
?> 
 
 <?php } ?>
</tr>

<tr>
<td align="left">No Of Marginal Profit Branch</td>
<?php for ($m=0; $m<12; $m++){ ?>
<?php 
if($previous_value['report_option_selector']==5)
{
   if(($m+1)%3==0)
   {
    ?><td align="center" style="font-size:xx-large"><?php echo ${'no_marginal_br_'.$m}; ?></td><?php
   } 
}
else
{
    ?><td align="center" style="font-size:xx-large"><?php echo ${'no_marginal_br_'.$m}; ?></td><?php
}
?>
 
 <?php } ?>
</tr>

</table>

<br/>
<?php 
}
?>