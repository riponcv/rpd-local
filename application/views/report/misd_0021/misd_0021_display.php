<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Statement of Affairs</title>
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<div id="printarea" style="width:800px">
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Statement of Affairs</td>
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
if((isset($result_array_liabilities) && !empty($result_array_liabilities)) || (isset($result_array_assets) && !empty($result_array_assets)))
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
<br />
<table border="1" align="center">
<tr>
<th>LIABILITIES</th>
<th>ASSETS</th>
</tr>

<tr valign="top">

<td>
<table border="1">
<?php 

$j=1;
$p=1;
$total_amount_l=0;
$total_amount_liabilities=0;
?>
<?php for($i=0;$i<count($result_array_liabilities);$i++)
{
$total_amount_liabilities=$total_amount_liabilities+$result_array_liabilities[$i]->amount;   
 
$Main_Head_Name=$result_array_liabilities[$i]->Main_Head_Name;
$Main_Head_Code=$result_array_liabilities[$i]->Main_Head_Code; 

if($i>0)
{
    if($Main_Head_Code != $result_array_liabilities[$i-1]->Main_Head_Code)
    {
      ?>
      <tr>
      <th colspan="2" align="left"><?php echo 'Total'; ?></th>
      <th colspan="2" align="right"><?php echo $total_amount_l; ?></th>
      </tr>
      <?php
      $total_amount_l=0;  
    }
}

?>

<?php if($j==1)
{ 
if($i>0)
{
    if($Main_Head_Code != $result_array_liabilities[$i-1]->Main_Head_Code){

?>
<tr>
<th colspan="3" align="left" style="background-color: ;"><?php echo $Main_Head_Name; ?></th>
</tr>
<?php 
$p=1;
} 

}
else
{
?>
<tr>
<th colspan="3" align="left"><?php echo $Main_Head_Name; ?></th>
</tr>
<?php    
}
}
?>

<tr>
<td align="center" width="50px"><?php echo $p; ?></td>
<td align="left" width="300px"><?php echo $result_array_liabilities[$i]->Sub_Head_Name; ?></td>
<td align="right" width="200px"><?php echo $result_array_liabilities[$i]->amount; ?></td>
</tr>
<?php
 
$p++;
$total_amount_l=$total_amount_l+$result_array_liabilities[$i]->amount;

if($i==(count($result_array_liabilities)-1))
{
      ?>
      <tr>
      <th colspan="2" align="left"><?php echo 'Total'; ?></th>
      <th colspan="2" align="right"><?php echo $total_amount_l; ?></th>
      </tr>
      <?php 
}

} 
?>
</table>
</td>

<td>
<table border="1">
<?php 
$jj=1;
$pp=1;
$total_amount_a=0;
$total_amount_assets=0;
?>
<?php for($ii=0;$ii<count($result_array_assets);$ii++)
{ 

$total_amount_assets=$total_amount_assets+$result_array_assets[$ii]->amount;   

$Main_Head_Name=$result_array_assets[$ii]->Main_Head_Name;
$Main_Head_Code=$result_array_assets[$ii]->Main_Head_Code; 

if($ii>0)
{
    if($Main_Head_Code != $result_array_assets[$ii-1]->Main_Head_Code)
    {
      ?>
      <tr>
      <th colspan="2" align="left"><?php echo 'Total'; ?></th>
      <th colspan="2" align="right"><?php echo $total_amount_a; ?></th>
      </tr>
      <?php
      $total_amount_a=0;  
    }
}

?>

<?php if($jj==1)
{ 
if($ii>0)
{
    if($Main_Head_Code != $result_array_assets[$ii-1]->Main_Head_Code){

?>
<tr>
<th colspan="3" align="left" style="background-color: ;"><?php echo $Main_Head_Name; ?></th>
</tr>
<?php 
$pp=1;
} 

}
else
{
?>
<tr>
<th colspan="3" align="left"><?php echo $Main_Head_Name; ?></th>
</tr>
<?php    
}
}
?>

<tr>
<td align="center" width="50px"><?php echo $pp; ?></td>
<td align="left" width="300px"><?php echo $result_array_assets[$ii]->Sub_Head_Name; ?></td>
<td align="right" width="200px"><?php echo $result_array_assets[$ii]->amount; ?></td>
</tr>
<?php
 
$pp++;
$total_amount_a=$total_amount_a+$result_array_assets[$ii]->amount;

if($ii==(count($result_array_assets)-1))
{
      ?>
      <tr>
      <th colspan="2" align="left"><?php echo 'Total'; ?></th>
      <th colspan="2" align="right"><?php echo $total_amount_a; ?></th>
      </tr>
      <?php 
}

} 
?>
</table>
</td>

</tr>
<tr>
<th align="right">TOTAL LIABILITIES =<?php echo isset($total_amount_liabilities)?$total_amount_liabilities:''; ?></th>
<th align="right">TOTAL ASSETS =<?php echo isset($total_amount_assets)?$total_amount_assets:''; ?></th>
</tr>
</table>

</div>
<br />
<?php 

    /*echo form_open('report/misd_0021_report_details/1');
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
	*/
	?>
	<input type="button" value="Print" onclick="printDiv('printarea')" style="background-color: #FF9900"/>
	<?php
    
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
