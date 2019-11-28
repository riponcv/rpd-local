<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Developing Branch Position</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
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

<!--form for list-->
<?php 
echo form_open('report/misd_0010_report_details_list',"id='showDevelopingBrList'");
?>
<input type="hidden" name="report_val" value="<?php echo base64_encode(json_encode($result_array));; ?>"/>
<input type="hidden" name="ptr_str" id="ptr_str" value=""/>
<input type="hidden" name="report_option_selector" id="report_option_selector" value="<?php echo $previous_value['report_option_selector']; ?>"/>
<?php
echo form_close();
?>
<!--form for list-->


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

<?php foreach($result_array as $key=>$row){ ?> 

<?php

${'onclick_month_'.$key}=$row['month_val'];

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

<table border="1">

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
    ?><td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList(<?php echo "'"."loss_br#".${'onclick_month_'.$m}."#".$report_of_year."#".$report_of_office."#".$command_office."'"; ?>)"><?php echo ${'no_loss_br_'.$m}; ?></a></td><?php
 }   
}
else
{
  ?><td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList(<?php echo "'"."loss_br#".${'onclick_month_'.$m}."#".$report_of_year."#".$report_of_office."#".$command_office."'"; ?>)"><?php echo ${'no_loss_br_'.$m}; ?></a></td><?php  
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
    ?><td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList(<?php echo "'"."marginal_br#".${'onclick_month_'.$m}."#".$report_of_year."#".$report_of_office."#".$command_office."'"; ?>)"><?php echo ${'no_marginal_br_'.$m}; ?></a></td><?php
   } 
}
else
{
    ?><td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList(<?php echo "'"."marginal_br#".${'onclick_month_'.$m}."#".$report_of_year."#".$report_of_office."#".$command_office."'"; ?>)"><?php echo ${'no_marginal_br_'.$m}; ?></a></td><?php
}
?>
 
 <?php } ?>
</tr>

</table>
<br/>
<?php 

    echo form_open('report/misd_0010_report_details/1');
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
