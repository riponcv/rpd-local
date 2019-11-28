<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Continuous Developing Branch Position</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">Back</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
  <?php
  $title_ad_text='';  
  if(isset($upto_value))
  {
    if($upto_value==1){$title_ad_text="($upto_value year)";}
    else{$title_ad_text="(Upto $upto_value years)";}
  }
  ?>
    <td align="center" style="font-size:18px;"><?php echo isset($title)?$title.$title_ad_text:''; ?></td>
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
<table align="center"><tr><td>Amount in Lac</td></tr></table>
<table border="1" align="center">
 <tr align="center">
 <td rowspan="2">SL</td>
 <td rowspan="2">Branch</td>
 <?php if($report_option_selector !=3) { ?>
 <td rowspan="2">Zone</td>
 <td rowspan="2">Division</td>
 <?php } ?>
 <?php for($i=1;$i<=$upto_value;$i++){ $year=date('Y')-$i; ?>
 <td colspan="3"><?php echo $year; ?></td>
 <?php } ?>
 </tr>
 
 <tr align="center">
 <?php for($i=1;$i<=$upto_value;$i++){?>
 <td>Income</td>
 <td>Expend</td>
 <td>PL</td>
 <?php } ?>
 </tr>


 <?php 
if($title=='List Of Loss Branch'){$status_index=1;}
if($title=='List Of Marginal Profit Branch'){$status_index=2;}
 ?>
<?php $count=0; ?> 
<?php foreach($ptr_val as $key=>$row){ ?>

<?php if($row->status_index==$status_index && $row->status_value==$upto_value) { ?>
<?php $count++; ?> 
<tr>
<td align="center"><?php echo $count; ?></td>
<td align="left"><?php echo isset($row->br_name)?$row->br_name:'-'; ?></td>
<?php if($report_option_selector !=3) { ?>
<td align="left"><?php echo isset($row->zn_name)?$row->zn_name:'-'; ?></td>
<td align="left"><?php echo isset($row->dv_name)?$row->dv_name:'-'; ?></td>
<?php } ?>
<?php  
if(isset($row->con_pl_info) && !empty($row->con_pl_info))
{
    $count_str=1;
  foreach($row->con_pl_info as $a=>$b)
  {
    if($count_str<=$upto_value){
    ?>
        <td align="right"><?php echo isset($b->income)?round($b->income/100000,2):'-'; ?></td>
        <td align="right"><?php echo isset($b->expen)?round($b->expen/100000,2):'-'; ?></td>
        <td align="right"><?php echo isset($b->pl)?round($b->pl/100000,2):'-'; ?></td>  
    <?php
    $count_str++;
    }
  }  
}
?>
</tr>

<?php } ?>

<?php } ?>

</table>
<br/>
<?php 

    echo form_open('report/misd_0011_report_details_list/1');
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
