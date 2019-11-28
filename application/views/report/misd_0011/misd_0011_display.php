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

<!--form for list-->
<?php 
echo form_open('report/misd_0011_report_details_list',"id='showDevelopingBrList_continuous'");
?>
<input type="hidden" name="report_val" value="<?php echo base64_encode(json_encode($result_array));; ?>"/>
<input type="hidden" name="ptr_str" id="ptr_str" value=""/>
<input type="hidden" name="report_option_selector" value="<?php echo $report_option_selector; ?>"/>
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

<table border="1">

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

<?php if($upto_five_loss>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."loss_br#5#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_five_loss; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_five_loss; ?></td>
<?php }?>

<?php if($upto_four_loss>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."loss_br#4#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_four_loss; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_four_loss; ?></td>
<?php }?>

<?php if($upto_three_loss>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."loss_br#3#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_three_loss; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_three_loss; ?></td>
<?php }?>

<?php if($upto_two_loss>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."loss_br#2#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_two_loss; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_two_loss; ?></td>
<?php }?>

<?php if($upto_one_loss>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."loss_br#1#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_one_loss; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_one_loss; ?></td>
<?php }?>

</tr>

<tr>
<td align="left">No Of Marginal Profit Branch</td>

<?php if($upto_five_marginal>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."marginal_br#5#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_five_marginal; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_five_marginal; ?></td>
<?php }?>

<?php if($upto_four_marginal>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."marginal_br#4#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_four_marginal; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_four_marginal; ?></td>
<?php }?>

<?php if($upto_three_marginal>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."marginal_br#3#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_three_marginal; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_three_marginal; ?></td>
<?php }?>

<?php if($upto_two_marginal>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."marginal_br#2#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_two_marginal; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_two_marginal; ?></td>
<?php }?>

<?php if($upto_one_marginal>0) { ?>
<td align="center" style="font-size:xx-large"><a title="Click to see list" href="javascript:void(0)" onclick="showDevelopingBrList_continuous(<?php echo "'"."marginal_br#1#".$report_of_office."#".$command_office."'"; ?>)"><?php echo $upto_one_marginal; ?></a></td>
<?php }else{ ?>
<td align="center" style="font-size:xx-large"><?php echo $upto_one_marginal; ?></td>
<?php }?>

</tr>

</table>
<br/>
<?php 

    echo form_open('report/misd_0011_report_details/1');
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
