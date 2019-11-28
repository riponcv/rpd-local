<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Developing Branch Position</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">Back</a></th></tr>
</table>
<br/><br/><br/>
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
<table border="1" align="center">
 <tr align="center">
 <td>SL</td>
 <td width="270px">Branch</td>
 <?php if($report_option_selector !=3){ ?>
 <td width="150px">Zone</td>
 <td width="150px">Division</td>
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
<td align="right"><?php echo isset($row->pl)?round($row->pl,2):'-'; ?></td>
</tr>
<?php } ?>
</table>
<br/>
<?php 

    echo form_open('report/misd_0010_report_details_list/1');
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
