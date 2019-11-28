<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Affairs Back Page Statement</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
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
<table border="1" align="right" style="margin-top: -90px;">
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
<table border="1">
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

    echo form_open('report/misd_0020_report_details/1');
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
