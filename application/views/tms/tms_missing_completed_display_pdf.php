<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>
<body>
<p>

<!--First Title of Report-->
<table align="center">
<tr><th style="font-size: larger;">Target Monitoring System Report</th></tr>
<tr><th><?php echo $report_of_office; ?></th></tr>
<tr><th>Report Of : <?php echo isset($report_of_year)?$report_of_year:''; ?></th></tr>
<?php if(isset($count_all) && $count_all>1){ ?><tr align="center"><th><?php echo isset($sign)?$sign:'Count'; ?>: <?php echo isset($count_missing_completed)?$count_missing_completed:'0'; echo '/'; echo isset($count_all)?$count_all:'0'; ?></th></tr><?php } ?>
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
    	echo "<td align='center' style='background-color:olive'>"."<strong>"."Serial No "."<strong>"."</td>";
        echo "<td align='center' style='background-color:olive'>"."<strong>"."Branch Code "."<strong>"."</td>";
    	echo "<td align='center' width='200' style='background-color:olive'>"."<strong>"."Branch Name "."<strong>"."</td>";
        /*echo "<td align='center' width='300' style='background-color:olive'>"."<strong>"."Officer Name "."<strong>"."</td>";
        echo "<td align='center' width='200' style='background-color:olive'>"."<strong>"."Officer Mobile No "."<strong>"."</td>";*/
        //echo "<td align='center' width='100' style='background-color:olive'>"."<strong>"."Email "."<strong>"."</td>";
        echo "<td align='center' width='200' style='background-color:olive'>"."<strong>"."Office Phone "."<strong>"."</td>";
    	echo "</tr>";
        $count=1;
        foreach($result_array as $row)
        {
            echo "<tr>";
        	echo "<td align='center'>"."<strong>".$count."<strong>"."</td>";
        	echo "<td align='center'>"."<strong>".$row['br_code']."<strong>"."</td>";
        	echo "<td align='left'>"."<strong>".$row['br_name']."<strong>"."</td>";
            /*echo "<td align='left'>"."<strong>".$row['username']."<strong>"."</td>";
            echo "<td align='center'>"."<strong>".$row['contact']."<strong>"."</td>";*/
            //echo "<td align='left'>"."<strong>".$row['email']."<strong>"."</td>";
            echo "<td align='center'>"."<strong>".$row['office_phone']."<strong>"."</td>";
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

