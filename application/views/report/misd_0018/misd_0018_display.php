<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Recovery Report 2</title>

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
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Point to Point Recovery Report</td>
  </tr>
  <tr><td align="center" >Report of</td></tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
    <tr>
   <td align="center" >1st point: <?php echo isset($report_of_date_one)?$report_of_date_one:''; echo " & 2nd point: "; echo isset($report_of_date_two)?$report_of_date_two:'';?> </td>
 </tr>
  <tr>
    <td align="center" ><?php// echo '(From Jan 01, '.date('Y',strtotime($report_of_date)).' to '.$report_of_date.')'; ?></td>
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
<table style="margin-right: -740px;;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" style="border-collapse:collapse;" id="t1">
	<tr>
		<td rowspan="2" align="center">SL</td>
		<td rowspan="2" colspan="2" align="center">Indicator</td>
		<td colspan="3" align="center"><?php echo isset($report_of_date_one)?$report_of_date_one:'';?></td>
		<td colspan="3" align="center"><?php echo isset($report_of_date_two)?$report_of_date_two:'';?></td>
		<td colspan="3" align="center"><?php echo "Difference(2nd point-1st point)";?></td>
	</tr>
	<tr>
		<td align="center"> Principal </td>
		<td align="center"> Interest </td>
		<td align="center"> Total </td>
		<td align="center"> Principal </td>
		<td align="center"> Interest </td>
		<td align="center"> Total </td>
		<td align="center">Principal</td>
		<td align="center">Interest</td>
		<td align="center">Total</td>
	</tr>
	
        <?php foreach($result_array as $key=>$row) { 
		 
		    if(isset($row['dp_resch_p_date1']))
			{
				$dp_resch_p_date1 =$row['dp_resch_p_date1'];
			}
			if(isset($row['dp_resch_i_date1']))
			{
				$dp_resch_i_date1 =$row['dp_resch_i_date1'];
			}
            
            if(isset($row['total_resch_date1']))
			{
				$total_resch_date1 =$row['total_resch_date1'];
			}
			
            if(isset($row['dp_iw_p_date1']))
			{
				$dp_iw_p_date1 =$row['dp_iw_p_date1'];
			}
			
            if(isset($row['dp_iw_i_date1']))
			{
				$dp_iw_i_date1 =$row['dp_iw_i_date1'];
			}
			
            if(isset($row['total_iw_date1']))
			{
				$total_iw_date1 =$row['total_iw_date1'];
			}
			
            if(isset($row['other_p_date1']))
			{
				$other_p_date1 =$row['other_p_date1'];
			}
			
            if(isset($row['other_i_date1']))
			{
				$other_i_date1 =$row['other_i_date1'];
			}
			
            if(isset($row['total_other_date1']))
			{
				$total_other_date1 =$row['total_other_date1'];
			}
			
            if(isset($row['recovery_total_date1']))
			{
				$recovery_total_date1 =$row['recovery_total_date1'];
			}
			
            if(isset($row['resc_date1']))
			{
				$resc_date1 =$row['resc_date1'];
			}
			
            if(isset($row['iw_date1']))
			{
				$iw_date1 =$row['iw_date1'];
			}
			
            if(isset($row['wo_date1']))
			{
				$wo_date1 =$row['wo_date1'];
			}
			
            if(isset($row['red_total_date1']))
			{
				$red_total_date1 =$row['red_total_date1'];
			}
			
            if(isset($row['rec_red_total_date1']))
			{
				$rec_red_total_date1 =$row['rec_red_total_date1'];
			}
			
            if(isset($row['dp_resch_p_date2']))
			{
				$dp_resch_p_date2 =$row['dp_resch_p_date2'];
			}
			if(isset($row['dp_resch_i_date2']))
			{
				$dp_resch_i_date2 =$row['dp_resch_i_date2'];
			}
			if(isset($row['total_resch_date2']))
			{
				$total_resch_date2 =$row['total_resch_date2'];
			}	
            if(isset($row['total_iw_date2']))
			{
				$dp_iw_p_date2 =$row['total_iw_date2'];
			}
            if(isset($row['dp_iw_i_date2']))
			{
				$dp_iw_i_date2 =$row['dp_iw_i_date2'];
			}
            if(isset($row['total_iw_date2']))
			{
				$total_iw_date2 =$row['total_iw_date2'];
			}
            
            if(isset($row['other_p_date2']))
			{
				$other_p_date2 =$row['other_p_date2'];
			}
			
            if(isset($row['other_i_date2']))
			{
				$other_i_date2 =$row['other_i_date2'];
			}
			
            if(isset($row['total_other_date2']))
			{
				$total_other_date2 =$row['total_other_date2'];
			}
			
            if(isset($row['recovery_total_date2']))
			{
				$recovery_total_date2 =$row['recovery_total_date2'];
			}
			
            if(isset($row['resc_date2']))
			{
				$resc_date2 =$row['resc_date2'];
			}
			
            if(isset($row['iw_date2']))
			{
				$iw_date2 =$row['iw_date2'];
			}
			
            if(isset($row['wo_date2']))
			{
				$wo_date2 =$row['wo_date2'];
			}
			
            if(isset($row['red_total_date2']))
			{
				$red_total_date2 =$row['red_total_date2'];
			}
			
            if(isset($row['rec_red_total_date2']))
			{
				$rec_red_total_date2 =$row['rec_red_total_date2'];
			}
			
		}
		?>
		<tr>
		<td>1</td>	
		<td rowspan="4" style="vertical-align:middle" align="center">Cash Recovery</td>
		<td>DP for Recovery</td>
		<td align="right"><?php echo isset($dp_resch_p_date1)?round($dp_resch_p_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($dp_resch_i_date1)?round($dp_resch_i_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_resch_date1)?round($total_resch_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($dp_resch_p_date2)?round($dp_resch_p_date2,2):'-'; ?></td>
		<td align="right"><?php echo isset($dp_resch_i_date2)?round($dp_resch_i_date2,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_resch_date2)?round($total_resch_date2,2):'-'; ?></td>
		
		<td align="right"><?php if(isset($dp_resch_p_date1)&& isset($dp_resch_p_date2)){echo round(($dp_resch_p_date2-$dp_resch_p_date1),2);}else{echo '-';}?></td>
		<td align="right"><?php if(isset($dp_resch_i_date1)&& isset($dp_resch_i_date2)){echo round(($dp_resch_i_date2-$dp_resch_i_date1),2);}else{echo '-';}?></td>
		<td align="right"><?php if(isset($total_resch_date1)&& isset($total_resch_date2)){echo round(($total_resch_date2-$total_resch_date1),2);}else{echo '-';}?></td>
		
		</tr>
	<tr>
		<td>2</td>
		<td>IW for Recovery</td>
		<td align="right"><?php echo isset($dp_iw_p_date1)?round($dp_iw_p_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($dp_iw_i_date1)?round($dp_iw_i_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_iw_date1)?round($total_iw_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($dp_iw_p_date2)?round($dp_iw_p_date2,2):'-'; ?></td>
		<td align="right"><?php echo isset($dp_iw_i_date2)?round($dp_iw_i_date2,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_iw_date2)?round($total_iw_date2,2):'-'; ?></td>
		<td align="right"><?php if(isset($dp_iw_p_date1)&& isset($dp_resch_p_date2)){echo round(($dp_iw_p_date2-$dp_iw_p_date1),2);}else{echo '-';}?></td>
		<td align="right"><?php if(isset($dp_iw_i_date1)&& isset($dp_iw_i_date2)){echo round(($dp_iw_i_date2-$dp_iw_i_date1),2);}else{echo '-';}?></td>
		<td align="right"><?php if(isset($total_iw_date1)&& isset($total_iw_date2)){echo round(($total_iw_date2-$total_iw_date1),2);}else{echo '-';}?></tr>
	<tr>
		<td>3</td>
		<td>Other for Recovery</td>	
		<td align="right"><?php echo isset($other_p_date1)?round($other_p_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($other_i_date1)?round($other_i_date1,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_other_date1)?round($total_other_date1,2):'-'; ?></td>
		
		<td align="right"><?php echo isset($other_p_date2)?round($other_p_date2,2):'-'; ?></td>
		<td align="right"><?php echo isset($other_i_date2)?round($other_i_date2,2):'-'; ?></td>
		<td align="right"><?php echo isset($total_other_date2)?round($total_other_date2,2):'-'; ?></td>
		
		<td align="right"><?php if(isset($other_p_date1)&& isset($other_p_date2)){echo round(($other_p_date2-$other_p_date1),2);}else{echo '-';}?></td>
		<td align="right"><?php if(isset($other_i_date1)&& isset($other_i_date2)){echo round(($other_i_date2-$other_i_date1),2);}else{echo '-';}?></td>
		<td align="right"><?php if(isset($total_other_date1)&& isset($total_other_date2)){echo round(($total_other_date2-$total_other_date1),2);}else{echo '-';}?></td>
	</tr>
	<tr>
		<td>4=1+2+3</td>
		<td>Total Cash Recovery</td>	
		<td colspan="3" align="right"><?php echo isset($recovery_total_date1)?round($recovery_total_date1,2):'-'; ?></td>
		<td colspan="3" align="right"><?php echo isset($recovery_total_date2)?round($recovery_total_date2,2):'-'; ?></td>
		<td colspan="3"  align="right"><?php if(isset($recovery_total_date1)&& isset($recovery_total_date2)){echo round(($recovery_total_date2-$recovery_total_date1),2);}else{echo '-';}?></td>
	</tr>	
	<tr>
		<td>5</td>
		<td rowspan="4" align="center">Reduction</td>
		<td>Re-schedule</td>
		<td colspan="3" align="right"><?php echo isset($resc_date1)?round($resc_date1,2):'-'; ?></td>	
		<td colspan="3" align="right"><?php echo isset($resc_date2)?round($resc_date2,2):'-'; ?></td>	
		<td colspan="3"  align="right"><?php if(isset($resc_date1)&& isset($resc_date2)){echo round(($resc_date2-$resc_date1),2);}else{echo '-';}?></td>
	</tr>
	<tr>
		<td>6</td>
		<td>Interest Waiver</td>
		<td colspan="3" align="right"><?php echo isset($iw_date1)?round($iw_date1,2):'-'; ?></td>	
		<td colspan="3" align="right"><?php echo isset($iw_date2)?round($iw_date2,2):'-'; ?></td>	
		<td colspan="3"  align="right"><?php if(isset($iw_date1)&& isset($iw_date2)){echo round(($iw_date2-$iw_date1),2);}else{echo '-';}?></td>
	</tr>
	<tr>
		<td>7</td>
		<td>Write Off</td>
		<td colspan="3" align="right"><?php echo isset($wo_date1)?round($wo_date1,2):'-'; ?></td>	
		<td colspan="3" align="right"><?php echo isset($wo_date2)?round($wo_date2,2):'-'; ?></td>	
		<td colspan="3"  align="right"><?php if(isset($wo_date1)&& isset($wo_date2)){echo round(($wo_date2-$wo_date1),2);}else{echo '-';}?></td>
	</tr>
	<tr>
		<td>8=5+6+7</td>
		<td>Total Reduction</td>
		<td colspan="3" align="right"><?php echo isset($red_total_date1)?round($red_total_date1,2):'-'; ?></td>	
		<td colspan="3" align="right"><?php echo isset($red_total_date2)?round($red_total_date2,2):'-'; ?></td>	
		<td colspan="3"  align="right"><?php if(isset($red_total_date1)&& isset($red_total_date2)){echo round(($red_total_date2-$red_total_date1),2);}else{echo '-';}?></td>	
	</tr>
		
		<tr>
		<td>9=4+8</td>
		<td align="center">-</td>
		<td>Total Cash Recovery and Reduction</td>	
		<td colspan="3" align="right"><?php echo isset($rec_red_total_date1)?round($rec_red_total_date1,2):'-'; ?></td>
		<td colspan="3" align="right"><?php echo isset($rec_red_total_date2)?round($rec_red_total_date2,2):'-'; ?></td>
	    <td colspan="3"  align="right"><?php if(isset($rec_red_total_date1)&& isset($rec_red_total_date2)){echo round(($rec_red_total_date2-$rec_red_total_date1),2);}else{echo '-';}?></td>	
	</tr>   
		
        <?php //} ?>
        
       
</table>
<br/>
<?php 

    echo form_open('report/misd_0018_report_details/1');
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
