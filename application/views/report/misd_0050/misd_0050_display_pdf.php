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
    <td align="center" style="font-size:18px;">Range Wise New Loan Statement<br />(Loan above BDT 50000&#47;-)</td>
  </tr>
    	<tr>
	<td align="center" style="font-size:18px;">According to CIB</td>
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
<table border="1" align="right" style="border: thin;margin-top: -90px;border-collapse:collapse;font_size:small;" id="t1">
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
<br/><br />
<table border="1" style="border-collapse:collapse;" id="t1" align="center" width="800px">
<tr>
<th rowspan="2">SL</th>
<th rowspan="2" colspan="2"><?php echo isset($list_title)?$list_title:'Office'; ?></th>
<th colspan="6">No. of branch within the range of new loan disbursed</th>
</tr>

<tr>
<th>Upto 0</th>
<th>1-5</th>
<th>6-15</th>
<th>16-30</th>
<th>31-50</th>
<th>50+</th>
</tr>

<?php
$one_u_total=0;
$one_r_total=0;
$one_t_total=0;

$two_u_total=0;
$two_r_total=0;
$two_t_total=0;

$three_u_total=0;
$three_r_total=0;
$three_t_total=0;

$four_u_total=0;
$four_r_total=0;
$four_t_total=0;

$five_u_total=0;
$five_r_total=0;
$five_t_total=0;

$six_u_total=0;
$six_r_total=0;
$six_t_total=0;
 
foreach($result_array as $key=>$row) 
{

if(isset($row['report_val']['up_to_zero_u']) && $row['report_val']['up_to_zero_u']>0){$one_u_total=$one_u_total+$row['report_val']['up_to_zero_u'];}
if(isset($row['report_val']['up_to_zero_r']) && $row['report_val']['up_to_zero_r']>0){$one_r_total=$one_r_total+$row['report_val']['up_to_zero_r'];}
if(isset($row['report_val']['up_to_zero_t']) && $row['report_val']['up_to_zero_t']>0){$one_t_total=$one_t_total+$row['report_val']['up_to_zero_t'];}

if(isset($row['report_val']['1_to_5_u']) && $row['report_val']['1_to_5_u']>0){$two_u_total=$two_u_total+$row['report_val']['1_to_5_u'];}
if(isset($row['report_val']['1_to_5_r']) && $row['report_val']['1_to_5_r']>0){$two_r_total=$two_r_total+$row['report_val']['1_to_5_r'];}
if(isset($row['report_val']['1_to_5_t']) && $row['report_val']['1_to_5_t']>0){$two_t_total=$two_t_total+$row['report_val']['1_to_5_t'];}

if(isset($row['report_val']['6_to_15_u']) && $row['report_val']['6_to_15_u']>0){$three_u_total=$three_u_total+$row['report_val']['6_to_15_u'];}
if(isset($row['report_val']['6_to_15_r']) && $row['report_val']['6_to_15_r']>0){$three_r_total=$three_r_total+$row['report_val']['6_to_15_r'];}
if(isset($row['report_val']['6_to_15_t']) && $row['report_val']['6_to_15_t']>0){$three_t_total=$three_t_total+$row['report_val']['6_to_15_t'];}

if(isset($row['report_val']['16_to_30_u']) && $row['report_val']['16_to_30_u']>0){$four_u_total=$four_u_total+$row['report_val']['16_to_30_u'];}
if(isset($row['report_val']['16_to_30_r']) && $row['report_val']['16_to_30_r']>0){$four_r_total=$four_r_total+$row['report_val']['16_to_30_r'];}
if(isset($row['report_val']['16_to_30_t']) && $row['report_val']['16_to_30_t']>0){$four_t_total=$four_t_total+$row['report_val']['16_to_30_t'];}

if(isset($row['report_val']['31_to_50_u']) && $row['report_val']['31_to_50_u']>0){$five_u_total=$five_u_total+$row['report_val']['31_to_50_u'];}
if(isset($row['report_val']['31_to_50_r']) && $row['report_val']['31_to_50_r']>0){$five_r_total=$five_r_total+$row['report_val']['31_to_50_r'];}
if(isset($row['report_val']['31_to_50_t']) && $row['report_val']['31_to_50_t']>0){$five_t_total=$five_t_total+$row['report_val']['31_to_50_t'];}

if(isset($row['report_val']['50_plus_u']) && $row['report_val']['50_plus_u']>0){$six_u_total=$six_u_total+$row['report_val']['50_plus_u'];}
if(isset($row['report_val']['50_plus_r']) && $row['report_val']['50_plus_r']>0){$five_r_total=$six_r_total+$row['report_val']['50_plus_r'];}
if(isset($row['report_val']['50_plus_t']) && $row['report_val']['50_plus_t']>0){$six_t_total=$six_t_total+$row['report_val']['50_plus_t'];}
    
?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left" width="200px"><?php echo isset($row['office_name'])?$row['office_name']:'-'; ?></td>
<td align="center" width="100px">
Urban | Rural
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
Total
</td>

<td align="center" width="80px">
<?php echo isset($row['report_val']['up_to_zero_u'])?$row['report_val']['up_to_zero_u']:'-'; ?> | <?php echo isset($row['report_val']['up_to_zero_r'])?$row['report_val']['up_to_zero_r']:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($row['report_val']['up_to_zero_t'])?$row['report_val']['up_to_zero_t']:'-'; ?>
</td>

<td align="center" width="80px">
<?php echo isset($row['report_val']['1_to_5_u'])?$row['report_val']['1_to_5_u']:'-'; ?> | <?php echo isset($row['report_val']['1_to_5_r'])?$row['report_val']['1_to_5_r']:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($row['report_val']['1_to_5_t'])?$row['report_val']['1_to_5_t']:'-'; ?>
</td>

<td align="center" width="80px">
<?php echo isset($row['report_val']['6_to_15_u'])?$row['report_val']['6_to_15_u']:'-'; ?> | <?php echo isset($row['report_val']['6_to_15_r'])?$row['report_val']['6_to_15_r']:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($row['report_val']['6_to_15_t'])?$row['report_val']['6_to_15_t']:'-'; ?>
</td>

<td align="center" width="80px">
<?php echo isset($row['report_val']['16_to_30_u'])?$row['report_val']['16_to_30_u']:'-'; ?> | <?php echo isset($row['report_val']['16_to_30_r'])?$row['report_val']['16_to_30_r']:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($row['report_val']['16_to_30_t'])?$row['report_val']['16_to_30_t']:'-'; ?>
</td>

<td align="center" width="80px">
<?php echo isset($row['report_val']['31_to_50_u'])?$row['report_val']['31_to_50_u']:'-'; ?> | <?php echo isset($row['report_val']['31_to_50_r'])?$row['report_val']['31_to_50_r']:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($row['report_val']['31_to_50_t'])?$row['report_val']['31_to_50_t']:'-'; ?>
</td>

<td align="center" width="80px">
<?php echo isset($row['report_val']['50_plus_u'])?$row['report_val']['50_plus_u']:'-'; ?> | <?php echo isset($row['report_val']['50_plus_r'])?$row['report_val']['50_plus_r']:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($row['report_val']['50_plus_t'])?$row['report_val']['50_plus_t']:'-'; ?>
</td>

</tr>
<?php    
}
?>
<tr>
<th colspan="2">Total</th>
<th align="center" width="100px">
Urban | Rural
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
Total
</th>

<th align="center" width="80px">
<?php echo isset($one_u_total)?$one_u_total:'-'; ?> | <?php echo isset($one_r_total)?$one_r_total:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($one_t_total)?$one_t_total:'-'; ?>
</th>

<th align="center" width="80px">
<?php echo isset($two_u_total)?$two_u_total:'-'; ?> | <?php echo isset($two_r_total)?$two_r_total:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($two_t_total)?$two_t_total:'-'; ?>
</th>

<th align="center" width="80px">
<?php echo isset($three_u_total)?$three_u_total:'-'; ?> | <?php echo isset($three_r_total)?$three_r_total:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($three_t_total)?$three_t_total:'-'; ?>
</th>

<th align="center" width="80px">
<?php echo isset($four_u_total)?$four_u_total:'-'; ?> | <?php echo isset($four_r_total)?$four_r_total:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($four_t_total)?$four_t_total:'-'; ?>
</th>

<th align="center" width="80px">
<?php echo isset($five_u_total)?$five_u_total:'-'; ?> | <?php echo isset($five_r_total)?$five_r_total:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($five_t_total)?$five_t_total:'-'; ?>
</th>

<th align="center" width="80px">
<?php echo isset($six_u_total)?$six_u_total:'-'; ?> | <?php echo isset($six_r_total)?$six_r_total:'-'; ?>
<hr width="80%" noshade="noshade" align="right" style='background-color:#D0D0D0;border-width:0;color:#D0D0D0;height:1px;line-height:0;'/>
<?php echo isset($six_t_total)?$six_t_total:'-'; ?>
</th>

</tr>
</table>
<br/>
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