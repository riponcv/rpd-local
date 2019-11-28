<head>
<style type="text/css">
html { 
margin-left: 25px;
margin-bottom: 5px;
}
   
</style>
<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>
</head>
<table align="center">
 
  <tr>
    <td align="center" style="font-size:18px;">Foreign Exchange Business Position Weekly</td>
  </tr>
  <tr>
  <?php $month_array=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >Report of: <?php echo isset($report_of_date)?$report_of_date:''; ?> <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>

<table border="1" align="right" style="border-collapse:collapse;margin-top: -90px;"  id="t1"  >
  <tr>
    <td width="80">Report</td>
    <td width="175"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="80">Printing Date </td>
    <td width="175"><?php echo date("d/m/Y"); ?></td>
  </tr>
  <tr>
    <td width="80">Source </td>
    <td width="175">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>
<br />
 <?php
		$totldbpregamt=array();
		$totldbpregper=array();
		$totldbpregac=array();
		$totldbpoveramt=array();
		$totldbpoverper=array();
		$totldbpoverac=array();
		$totldbpregoveramt=array();
		$totldbpregoverac=array();
		
		$templdbpregamt=0;
		$tempdbpregper=0;
		$tempdbpregac=0;
		$tempdbpoveramt=0;
		$tempdbpoverper=0;
		$tempdbpoverac=0;
		$tempdbpregoveramt=0;
		$tempdbpregoverac=0;
		 foreach($result_array as $key=>$row) 
		  {
			for($i=0;$i<6;$i++)
			{  
				if(isset($row['report_val'][$i]['ldbpregamt']))
				{
					$templdbpregamt=$templdbpregamt+$row['report_val'][$i]['ldbpregamt'];
				}
				if(isset($row['report_val'][$i]['ldbpregper']))
				{
					$tempdbpregper=$tempdbpregper+$row['report_val'][$i]['ldbpregper'];
				}
				else
				{
					$tempdbpregper=$tempdbpregper+0;
				}
				
				$tempdbpregac=$tempdbpregac+$row['report_val'][$i]['ldbpregac'];
				$tempdbpoveramt=$tempdbpoveramt+$row['report_val'][$i]['ldbpoveramt'];
				if(isset($row['report_val'][$i]['ldbpoverper']))
				{
					$tempdbpoverper=$tempdbpoverper+$row['report_val'][$i]['ldbpoverper'];
				}
				else
				{
					$tempdbpoverper=$tempdbpoverper+0;
				}
				
				if(isset($row['report_val'][$i]['ldbpoverac']))
				{
					$tempdbpoverac=$tempdbpoverac+$row['report_val'][$i]['ldbpoverac'];
				}
				if(isset($row['report_val'][$i]['ldbpregoveramt']))
				{
					$tempdbpregoveramt=$tempdbpregoveramt+$row['report_val'][$i]['ldbpregoveramt'];
				}
				if(isset($row['report_val'][$i]['ldbpregoverac']))
				{
					$tempdbpregoverac=$tempdbpregoverac+$row['report_val'][$i]['ldbpregoverac'];
				}
			}
			$totldbpregamt[$key]=$templdbpregamt;
			$totldbpregper[$key]=$tempdbpregper;
			$totldbpregac[$key]=$tempdbpregac;
			$totldbpoveramt[$key]=$tempdbpoveramt;
			$totldbpoverper[$key]=$tempdbpoverper;
			$totldbpoverac[$key]=$tempdbpoverac;
			$totldbpregoveramt[$key]=$tempdbpregoveramt;
			$totldbpregoverac[$key]=$tempdbpregoverac;
			
			$templdbpregamt=0;
			$tempdbpregper=0;
			$tempdbpregac=0;
			$tempdbpoveramt=0;
			$tempdbpoverper=0;
			$tempdbpoverac=0;
			$tempdbpregoveramt=0;
			$tempdbpregoverac=0;
		  }
		  if($totldbpregoveramt[$key]>0)
			{
				$amt_total=(($totldbpregamt[$key]/$totldbpregoveramt[$key])*100);
			}
			else
			{
				$amt_total=0;
			}
			if($totldbpregoveramt[$key]>0)
			{
				$amtover_total=(($totldbpoveramt[$key]/$totldbpregoveramt[$key])*100);
			}	
			else
			{
				$amtover_total=0;
			}
			
		
		 
	 ?>  
	 
<table align="right" style="margin-left:650px"><tr><td>Amount in Crore</td></tr></table>

<table border="1" align="center" style="border-collapse:collapse;" id="t1">
 <tr style="font-weight:bold">
  <td rowspan="2" height="25">Name of Loan</td>
 <td colspan="3" height="25" align="center">Regular</td> 
 <td colspan="3" height="25" align="center">Overdue</td> 
 <th rowspan="2" height="25">Total Amt</th>
 <th rowspan="2" height="25">Total A/C</th>
 </tr>
 <tr style="font-weight:bold">
 <td align="center" height="25">Amount</td>
 <td align="center" height="25">%</td>
 <td align="center" height="25">A/C</td>
 
 <td align="center" height="25">Amount</td>
 <td align="center" >%</td>
 <td align="center" height="25">A/C</td>
 </tr>
    <?php

	foreach($result_array as $key=>$row) { 	?>
	   	<tr align="right">
	
	<?php
	 	for($i=0;$i<6;$i++)
		{
	   ?> 
		<?php if($i>0) { ?> <tr><?php } ?>
		
		<td align="left" width="50" height="25"><?php echo isset($row['report_val'][$i]['nameloan'])?($row['report_val'][$i]['nameloan']):'-'; ?></td>
		<td align="right" width="70" height="25"><?php echo isset($row['report_val'][$i]['ldbpregamt'])?round($row['report_val'][$i]['ldbpregamt'],2):'0'; ?></td>
		<td align="right" width="60" height="25"><?php echo isset($row['report_val'][$i]['ldbpregper'])?round($row['report_val'][$i]['ldbpregper'],2):'0'; ?></td>
		<td align="right" width="60" height="25"><?php echo isset($row['report_val'][$i]['ldbpregac'])?round($row['report_val'][$i]['ldbpregac'],2):'0'; ?></td>
		<td align="right" width="70" height="25"><?php echo isset($row['report_val'][$i]['ldbpoveramt'])?round($row['report_val'][$i]['ldbpoveramt'],2):'0'; ?></td>
		<td align="right" width="60" height="25"><?php echo isset($row['report_val'][$i]['ldbpoverper'])?round($row['report_val'][$i]['ldbpoverper'],2):'0'; ?></td>
		<td align="right" width="60" height="25"><?php echo isset($row['report_val'][$i]['ldbpoverac'])?round($row['report_val'][$i]['ldbpoverac'],2):'0'; ?></td>
		<td align="right" width="70" height="25"><?php echo isset($row['report_val'][$i]['ldbpregoveramt'])?round($row['report_val'][$i]['ldbpregoveramt'],2):'0'; ?></td>
		<td align="right" width="60" height="25"><?php echo isset($row['report_val'][$i]['ldbpregoverac'])?round($row['report_val'][$i]['ldbpregoverac'],2):'0'; ?></td>

		<?php if($i==0) { ?> </tr><?php } ?>
		<?php if($i>0) { ?> </tr><?php } ?>
         
		 <?php } ?>
		 
		 	
		  <tr>
		 <td style="font-weight: bold" height="25">Total</td>
		<td align="right" height="25" style="font-weight: bold"><?php echo isset($totldbpregamt[$key])?round($totldbpregamt[$key],2):'-'; ?></td>
		<td align="right" height="25" style="font-weight: bold"> <?php echo isset($amt_total)?round($amt_total,2):'0'; ?></td>
		<td align="right" height="25" style="font-weight: bold"><?php echo isset($totldbpregac[$key])?round($totldbpregac[$key],2):'-'; ?></td>
		<td align="right" height="25" style="font-weight: bold"><?php echo isset($totldbpoveramt[$key])?round($totldbpoveramt[$key],2):'-'; ?></td>
		<td align="right" height="25" style="font-weight: bold"><?php echo isset($amtover_total)?round($amtover_total,2):'-'; ?></td>
		<td align="right" height="25" style="font-weight: bold"><?php echo isset($totldbpoverac[$key])?round($totldbpoverac[$key],2):'-'; ?></td>
		<td align="right" height="25" style="font-weight: bold"><?php echo isset($totldbpregoveramt[$key])?round($totldbpregoveramt[$key],2):'-'; ?></td>
		<td align="right" height="25" style="font-weight: bold"><?php echo isset($totldbpregoverac[$key])?round($totldbpregoverac[$key],2):'-'; ?></td>
       </tr>
        <?php } ?>
 </table>