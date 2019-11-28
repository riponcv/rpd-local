<style type="text/css">
html { 
margin-left: 15px;
margin-bottom: 5px;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Affairs Back Page Statement</td>
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
<table border="1" align="right" style="border: thin;margin-top: -90px;border-collapse:collapse;" id="t1">
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
<table border="1" style="border-collapse:collapse;" id="t1" align="center">
<?php 
$j=1;
$p=1;
$total_amount=0;
?>
<?php for($i=0;$i<count($result_array);$i++)
{ 
$head_name=$result_array[$i]->sh_name;
$head_code=$result_array[$i]->sh_code; 

if($i>0)
{
    if($head_code != $result_array[$i-1]->sh_code)
    {
      ?>
      <tr>
      <th colspan="2" align="left"><?php echo 'Total'; ?></th>
      <th colspan="2" align="right"><?php echo $total_amount; ?></th>
      </tr>
      <?php
      $total_amount=0;  
    }
}

?>

<?php if($j==1)
{ 
if($i>0)
{
    if($head_code != $result_array[$i-1]->sh_code){

?>
<tr>
<th colspan="3" align="left" style="background-color: ;"><?php echo $head_name; ?></th>
</tr>
<?php 
$p=1;
} 

}
else
{
?>
<tr>
<th colspan="3" align="left"><?php echo $head_name; ?></th>
</tr>
<?php    
}
}
?>

<tr>
<td align="center" width="50px"><?php echo $p; ?></td>
<td align="left" width="300px"><?php echo $result_array[$i]->ssh_name; ?></td>
<td align="right" width="200px"><?php echo $result_array[$i]->amount; ?></td>
</tr>
<?php
 
$p++;
$total_amount=$total_amount+$result_array[$i]->amount;

if($i==(count($result_array)-1))
{
      ?>
      <tr>
      <th colspan="2" align="left"><?php echo 'Total'; ?></th>
      <th colspan="2" align="right"><?php echo $total_amount; ?></th>
      </tr>
      <?php 
}

} 
?>
</table>
<br/>
<?php 
}
?>