<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deposit advance</title>
<style>
.font_size{font-size: 18px; font-weight: bold;border: 1px solid black;}
.under_ {border-bottom: 2px solid black;font-size: 17px;text-align: center;}
.top_ {font-size: 25px;font-weight: bold;text-align: center;}
.date_ {font-size: 25px;margin-bottom: 8px;margin-top: -25px;text-align: center;}
.table2 {margin-left: 40px;}
.tab_4 {border: 1px solid black;margin-left: -495px;}
.tab_5{border: 1px solid black;
margin-left: 375px;
margin-top: -84px;
margin-bottom: 30px;}
.td_4 {font-weight: bold; padding: 4px 15px;}
.left_ {text-align: left;} 
._diff {}


table,th,td
{
border-collapse:collapse;
}

</style>
</head>

<body>
    
<div class="another_view" align="right">
    <a href="javascript:history.back();">View Another Report</a>
</div>
<br />
<br />
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
    <td width="175"><?php echo date("d/m/Y"); ?></td>
  </tr>
  <tr>
    <td width="80">Source </td>
    <td width="175">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>

<br />
<table style="margin-right: -700px;"><tr><td>Amount in Crore</td></tr></table>

<!--Deposit + Advance-->
<table border="1" align="center">
 <tr style="font-weight:bold;">
  <td rowspan="2">Name of Loan</td>
 <td colspan="3" align="center">Regular</td> 
 <td colspan="3" align="center">Overdue</td> 
 <th rowspan="2">Total Amt</th>
 <th rowspan="2" >Total A/C</th>
 </tr>
 <tr style="font-weight:bold">
 <td align="center">Amount</td>
 <td align="center">%</td>
 <td align="center">A/C</td>
 
 <td align="center">Amount</td>
 <td align="center" >%</td>
 <td align="center">A/C</td>
 </tr>
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
				if(isset($row['report_val'][$i]['ldbpregac']))
				{
					$tempdbpregac=$tempdbpregac+$row['report_val'][$i]['ldbpregac'];
				}
				else
				{
					$tempdbpregac=$tempdbpregac+0;
				}
				if(isset($row['report_val'][$i]['ldbpoveramt']))
				{
					$tempdbpoveramt=$tempdbpoveramt+$row['report_val'][$i]['ldbpoveramt'];
				}
				else
				{
					$tempdbpoveramt=$tempdbpoveramt+0;
				}
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
		
		
       <?php 
	foreach($result_array as $key=>$row) { 	?>
	   	<tr align="right">
	
	<?php
	 	for($i=0;$i<6;$i++)
		{
	   ?> 
		<?php if($i>0) { ?> <tr><?php } ?>
		
		<td align="left" width="100"><?php echo isset($row['report_val'][$i]['nameloan'])?($row['report_val'][$i]['nameloan']):'-'; ?></td>
		<td align="right" width="100"><?php echo isset($row['report_val'][$i]['ldbpregamt'])?round($row['report_val'][$i]['ldbpregamt'],2):'0'; ?></td>
		<td align="right" width="60"><?php echo isset($row['report_val'][$i]['ldbpregper'])?round($row['report_val'][$i]['ldbpregper'],2):'0'; ?></td>
		<td align="right" width="65"><?php echo isset($row['report_val'][$i]['ldbpregac'])?round($row['report_val'][$i]['ldbpregac'],2):'0'; ?></td>
		<td align="right" width="100"><?php echo isset($row['report_val'][$i]['ldbpoveramt'])?round($row['report_val'][$i]['ldbpoveramt'],2):'0'; ?></td>
		<td align="right" width="60"><?php echo isset($row['report_val'][$i]['ldbpoverper'])?round($row['report_val'][$i]['ldbpoverper'],2):'0'; ?></td>
		<td align="right" width="65"><?php echo isset($row['report_val'][$i]['ldbpoverac'])?round($row['report_val'][$i]['ldbpoverac'],2):'0'; ?></td>
		<td align="right" width="100"><?php echo isset($row['report_val'][$i]['ldbpregoveramt'])?round($row['report_val'][$i]['ldbpregoveramt'],2):'0'; ?></td>
		<td align="right" width="100"><?php echo isset($row['report_val'][$i]['ldbpregoverac'])?round($row['report_val'][$i]['ldbpregoverac'],2):'0'; ?></td>
		
		<?php if($i==0) { ?> </tr><?php } ?>
		<?php if($i>0) { ?> </tr><?php } ?>
         
		 <?php } ?>
		 
		 	
		 <tr>
		 <td style="font-weight: bold">Total</td>
		<td align="right" style="font-weight: bold"><?php echo isset($totldbpregamt[$key])?round($totldbpregamt[$key],2):'-'; ?></td>
		<td align="right" style="font-weight: bold">
		<?php 
			//echo isset($totldbpregper[$key])?round($totldbpregper[$key],2):'-'; 
		//	if(isset($amt_total))
			{
				//$amt_total=((($totldbpregper[$key])*100/$totldbpregoveramt[$key]));
			//	echo $amt_total;
			}
			echo isset($amt_total)?round($amt_total,2):'0';
			//echo "000";
		?>
		</td>
		<td align="right" style="font-weight: bold"><?php echo isset($totldbpregac[$key])?round($totldbpregac[$key],2):'-'; ?></td>
		<td align="right" style="font-weight: bold"><?php echo isset($totldbpoveramt[$key])?round($totldbpoveramt[$key],2):'-'; ?></td>
		<td align="right" style="font-weight: bold"><?php echo isset($amtover_total)?round($amtover_total,2):'-'; ?></td>
		<td align="right" style="font-weight: bold"><?php echo isset($totldbpoverac[$key])?round($totldbpoverac[$key],2):'-'; ?></td>
		<td align="right" style="font-weight: bold"><?php echo isset($totldbpregoveramt[$key])?round($totldbpregoveramt[$key],2):'-'; ?></td>
		<td align="right" style="font-weight: bold"><?php echo isset($totldbpregoverac[$key])?round($totldbpregoverac[$key],2):'-'; ?></td>
       </tr>
        <?php } ?>
 </table>

<?php 

    echo form_open('report/misd_0013_report_details/1');
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
</body>
</html>
