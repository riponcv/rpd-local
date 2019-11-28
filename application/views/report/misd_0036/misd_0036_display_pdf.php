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
    <td align="center" style="font-size:18px;">One crore and above loan & advance</td>
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
<?php if(isset($result_array['report_val']) && !empty($result_array['report_val'])) { ?>
    <tr>
    <td align="center" ><?php echo "(TOTAL : ".count($result_array['report_val'])." )"; ?></td>
    </tr>
<?php } ?>
</table>
<?php
if(isset($result_array['report_val']) && !empty($result_array['report_val']))
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
<tr>
<th>SL</th>
<th>Borrower Name</th>
<th>Business Activity</th>
<th>Branch Name</th>
<th>Area Office</th>
<th>Divisional Office</th>
<th>Grade</th>
<th>Advance Limit</th>
</tr>
<?php foreach($result_array['report_val'] as $key=>$row){ ?>
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="left"><?php echo isset($row['BORROWER_NAME'])?$row['BORROWER_NAME']:''; ?></td>
<td align="left"><?php echo isset($row['BUSINESS_ACTIVITY'])?$row['BUSINESS_ACTIVITY']:''; ?></td>
<td align="left"><?php echo isset($row['branchname'])?$row['branchname']:''; ?></td>
<td align="center"><?php echo isset($row['gradesname'])?$row['gradesname']:''; ?></td>
<td align="left"><?php echo isset($row['znname'])?$row['znname']:''; ?></td>
<td align="left"><?php echo isset($row['dvname'])?$row['dvname']:''; ?></td>
<td align="right"><?php echo isset($row['ADVANCE_LIMIT'])?$row['ADVANCE_LIMIT']:''; ?></td>
</tr>
<?php } ?>
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