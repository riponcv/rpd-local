<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>
<body>
<!--First Title of Report-->
<table align="center">
<tr><th style="font-size: larger;">Weekly Position Report</th></tr>
<tr><th><?php echo $report_of_office; ?></th></tr>
<tr><th>Report Of : <?php echo isset($report_of_date)?$report_of_date:''; ?></th></tr>
<?php if(isset($count_all) && $count_all>1){ ?>
    <tr align="center">
        <th>
            <?php echo isset($sign)?$sign:'Count'; ?>: 
            <?php echo isset($count_missing_completed)?$count_missing_completed:'0'; 
            echo '/'; 
            echo isset($count_all)?$count_all:'0'; ?>
        </th>
    </tr>
<?php } ?>
<?php 
$style='';
$text='';
if(isset($report_click_btn) && $report_click_btn==2)
{
    $style='style="background-color: red;"';
    $text='Missing Branch List';
}
if(isset($report_click_btn) && $report_click_btn==3)
{
    $style='style="background-color: green;"';
    $text='Completed Branch  List';
}
?>
<tr <?php echo $style; ?>><th><?php echo $text; ?></th></tr>
</table>
<br /><br />

<!--End of Title-->
<?php

    if(isset($result_array) && count($result_array)>0)
    {
        echo "<table border=\"1\" align=\"center\">"; 	
        echo "<tr>";
    	echo "<td align='center' style='background-color:olive'>"."<strong>"."Serial No"."<strong>"."</td>";
        echo "<td align='center' style='background-color:olive'>"."<strong>"."Division"."<strong>"."</td>";
        echo "<td align='center' style='background-color:olive'>"."<strong>"."Area"."<strong>"."</td>";
        echo "<td align='center' style='background-color:olive'>"."<strong>"."Branch"."<strong>"."</td>";
		echo "<td align='center' style='background-color:olive'>"."<strong>"."Branch Code (BB)"."<strong>"."</td>";
        echo "<td align='center' width='200' style='background-color:olive'>"."<strong>"."Office Phone"."<strong>"."</td>";
		echo "<td align='center' width='200' style='background-color:olive'>"."<strong>"."Verified Status"."<strong>"."</td>";
		if(isset($status) && $status == 1)
		{
			echo "<td align='center' style='background-color:olive' colspan='2' width='200'>"."<strong>"."Action"."<strong>"."</td>";
		}
    	echo "</tr>";
        $count=1;
		$cc=0;
		$dd=0;
		foreach($certificate_data as $cer_data)
		{
			$cer_datapol[$cc++] = $cer_data->certified_br_ar_div_code;
			
		}
        foreach($result_array as $row)
        {
            echo "<tr>";
        	echo "<td align='center'>"."<strong>".$count."<strong>"."</td>";
        	echo "<td align='left'>"."<strong>".$row['dvname']."<strong>"."</td>";
            echo "<td align='left'>"."<strong>".$row['znname']."<strong>"."</td>";
            echo "<td align='left'>"."<strong>".$row['branchname']."(".$row['brcode'].")"."<strong>"."</td>";
			echo "<td align='left'>"."<strong>".$row['bbbrcode']."<strong>"."</td>";
        	echo "<td align='left'>"."<strong>".$row['OfficePhone']."<strong>"."</td>";
			$bbbcode6 ='12'.$row['bbbrcode'];
			if(in_array($bbbcode6, $cer_datapol))
			{
				echo "<td align='left' style='color:green;'>"."<strong>"."Verified"."<strong>"."</td>";
			}
			else
			{
				echo "<td align='left'  style='color:Red;'>"."<strong>"."Not Verified"."<strong>"."</td>";
			}
			if(isset($status) && $status == 1)
			{
				?><td><input type='button' name='view_report' value='View Report' onclick="check_individual_report('<?php echo "1#".$row['brcode'];?>')"/> || <input type='button' name='save_as_pdf' value='Save As PDF' onclick="check_individual_report('<?php echo "2#".$row['brcode'];?>')"/></td><?php	
			}
        	echo "</tr>";
            $count++;
        }
    }
    
    else
    {
        echo "<table border=\"1\" align=\"center\">"; 	
        echo "<tr>";
        if(isset($report_click_btn) && $report_click_btn==2)
        {
            echo "<td align='center' style='background-color:green'>"."<strong>All branch have submitted data successfully.<strong>"."</td>";
        }
        if(isset($report_click_btn) && $report_click_btn==3)
        {
            echo "<td align='center' style='background-color:red'>"."<strong>Any single branch have not submitted data yet.<strong>"."</td>";     
        }
        echo "</tr>";
    	echo "</table>"; 
    }
?>
</body>
</html>

