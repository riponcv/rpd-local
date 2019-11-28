<style type="text/css">
html { 
margin-left: 15px;
margin-bottom: 5px;
}
</style>

<?php

if(isset($result_array) && !empty($result_array))
{

?> 
<table  align="center" >
<tr align="center"><th>Core Deposit Monitoring System Report</th></tr>
<tr align="center"><th><?php echo $report_of_office; ?></th></tr>
<?php $month_array=array('01'=>'JANUARY','02'=>'FEBRUARY','03'=>'MARCH','04'=>'APRIL','05'=>'MAY','06'=>'JUNE','07'=>'JULY','08'=>'AUGUST','09'=>'SEPTEMBER','10'=>'OCTOBER','11'=>'NOVEMBER','12'=>'DECEMBER'); ?>
<tr align="center"><th>Report of: <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:''; echo ', '.$report_of_year; ?></th></tr>
<?php if(isset($result_array['completed_vs_total']['total']) && $result_array['completed_vs_total']['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($result_array['completed_vs_total']['completed'])?$result_array['completed_vs_total']['completed']:'0'; echo '/'; echo isset($result_array['completed_vs_total']['total'])?$result_array['completed_vs_total']['total']:'0'; ?></th></tr><?php } ?>
</table>

<br />

<table id="my_table_CDMS" BORDER=2 CELLPADDING=6.28 style="width: 100px;">
<tr>
    <th ROWSPAN=2 BGCOLOR="">No of Employee</th>
    <th ROWSPAN=2 BGCOLOR="">A/C Type</th>
	<th colspan=4 BGCOLOR="">Amount</th>
	<th colspan=4 BGCOLOR="">Account</th>
 </tr>
 
<tr BGCOLOR="">
    <td >Target(Yearly)</td> <td >Target(Proportion)</td> 
	<td>Acheived</td> <td>Acheivement(%)</td> 
	<td>Target(Yearly)</td> <td>Target(Proportion)</td> 
	<td>Acheived</td> <td>Acheivement(%)</td> 
 </tr>
 
 <?php 
 if(isset($records) && count($records)>0)
{
    $count=1;
    foreach($records as $row)
    {
      if($count==1)
      {
        ?>
        <tr style="text-align: right;"><th rowspan="6" style="text-align: center;"><?php echo number_format($result_array['target']['total_emp'],0); ?></th><th style="text-align: center;"><?php echo $records[0]->pt_short_name; ?></th><td rowspan="5"></td><td rowspan="5"></td>
 	      <td><?php echo number_format($result_array[101]['dp_amt'],0); ?></td><td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td><td><?php echo $result_array[101]['dp_ac']; ?></td><td rowspan="5"></td></tr>
        <?php
      }
      
      if($count==2)
      {
        ?>
            <tr style="text-align: right;"><th style="text-align: center;"><?php echo $records[1]->pt_short_name; ?></th><td><?php echo number_format($result_array[105]['dp_amt'],0); ?></td><td><?php echo $result_array[105]['dp_ac']; ?></td></tr>
        <?php
      }
      
      if($count==3)
      {
        ?>
            <tr style="text-align: right;"> <th style="text-align: center;"><?php echo $records[2]->pt_short_name; ?></th><td><?php echo number_format($result_array[109]['dp_amt'],0); ?></td><td><?php echo $result_array[109]['dp_ac']; ?></td></tr>
        <?php
      }
      
      if($count==4)
      {
        ?>
            <tr style="text-align: right;"><th style="text-align: center;"><?php echo $records[3]->pt_short_name; ?></th><td><?php echo number_format($result_array[113]['dp_amt'],0); ?></td><td><?php echo $result_array[113]['dp_ac']; ?></td></tr>
        <?php
      }
      
      if($count==5)
      {
        ?>
            <tr style="text-align: right;"><th style="text-align: center;"><?php echo $records[4]->pt_short_name; ?></th><td><?php echo number_format($result_array[117]['dp_amt'],0); ?></td><td><?php echo $result_array[117]['dp_ac']; ?></td></tr>
        <?php
      }
      $count++;  
    }
    ?>
    <tr bgcolor="" style="text-align: right;">
    <th style="text-align: center;">Total</th>
    <td><?php echo number_format(round($result_array['target']['total_target_amt'],0),0); ?></td>
    <td><?php echo number_format(round($result_array['target']['proposional_target_amt'],0),0); ?></td>
    <td><?php echo number_format(round($result_array['total']['dp_amt'],2),0); ?></td>
    <td><?php echo round($result_array['acheivement']['ach_dp_amt'],2); ?></td>
    <td><?php echo round($result_array['target']['total_target_ac'],0); ?></td>
    <td><?php echo round($result_array['target']['proposional_target_ac'],0); ?></td>
    <td><?php echo round($result_array['total']['dp_ac'],0); ?></td>
    <td><?php echo round($result_array['acheivement']['ach_dp_ac'],2); ?></td>
    </tr>
    <?php
}
 ?>
</table>


<div style="position:relative;float:left;padding-top: 10px;" >
<table border="2" cellpadding="4">
<tr BGCOLOR=""><th colspan="3">Acheivement</th></tr>
<tr><td style="font-weight: bold;text-align: center;">Amount</td><td style="font-weight: bold;text-align: center;"><?php echo $result_array['my_acheivement_grade']['amt']['grade_value']; ?></td>
<td style="float: left;font-size:smaller;font-style: italic;"><?php echo $result_array['my_acheivement_grade']['amt']['grade_text']; ?></td></tr>
<tr><td style="font-weight: bold;text-align: center;">Account</td><td style="font-weight: bold;text-align: center;"><?php echo $result_array['my_acheivement_grade']['ac']['grade_value']; ?></td>
<td style="float: left;font-size:smaller;font-style: italic;"><?php echo $result_array['my_acheivement_grade']['ac']['grade_text']; ?></td></tr>
</table>
</div>

<div style="position:relative;float:left;padding-top: 10px;">
<table border="2" cellpadding="4">
<tr BGCOLOR=""><th colspan="11">Yearly Target</th></tr>
<tr><th colspan="3">Designation</th>
<?php 
foreach($records_target as $row)
{
    ?><th><?php echo isset($row->Dsg_File_No_Prefix)?$row->Dsg_File_No_Prefix:''; ?></th><?php
}
?>
</tr>
<tr><th colspan="3">Target No. of Account</th>
<?php
foreach($records_target as $row)
{
    ?><th><?php echo isset($row->Dsg_Target_ac)?$row->Dsg_Target_ac:''; ?></th><?php
}
?>
</tr>

<tr><th colspan="3">Target Amount in Lac</th>
<?php
foreach($records_target as $row)
{
    ?><th><?php echo isset($row->Dsg_Target_Amt)?$row->Dsg_Target_Amt:''; ?></th><?php
}
?>
</tr>
</table>
</div>

<div style="position:relative;float:right;padding-top: -133px;left: 600px;" >
<table border="2" cellpadding="4">
<tr BGCOLOR=""><th colspan="6">Acheivement Grade</th></tr>
<tr style="text-align: center;">
<?php 

if(isset($result_array['acheivement_grade']) && count($result_array['acheivement_grade'])>0)
{
    foreach($result_array['acheivement_grade'] as $key=>$val)
    {
        ?><th><?php echo $val['grade_id']; ?></th><?php
    }
}

?>
</tr>
<tr style="text-align: center;">
<?php 

if(isset($result_array['acheivement_grade']) && count($result_array['acheivement_grade'])>0)
{
    foreach($result_array['acheivement_grade'] as $key=>$val)
    {
        ?><th><?php echo $val['grade_range']; ?></th><?php
    }
}

?>
</tr>
<tr style="text-align: center;">
    <?php 
       
        if(isset($result_array['acheivement_grade']) && count($result_array['acheivement_grade'])>0)
        {
            foreach($result_array['acheivement_grade'] as $key=>$val)
            {
                ?><th><?php echo $val['grade_value']; ?></th><?php
            }
        }
        
    ?>
</tr>
</table>
</div>
<?php 
    }
?>





