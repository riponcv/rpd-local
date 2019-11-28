<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>
<body>
<p>

    <table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
    </table><br/><br/>  

<!--First Title of Report-->
<table>
<tr><th style="font-size: larger;">Vault Security Management Report</th></tr>
<tr><th><?php echo $report_of_office; ?></th></tr>
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
    $text='Completed Branch List';
}
?>
<tr <?php echo $style; ?>><th><?php echo $text; ?></th></tr>
</table>

<!--End of Title-->
<?php

    if(isset($result_array) && count($result_array)>0)
    {
        echo "<table border=\"1\" align=\"center\">"; 	
        echo "<tr>";
    	echo "<td align='center' style='background-color:olive'>"."<strong>"."Serial No "."<strong>"."</td>";
        echo "<td align='center' style='background-color:olive'>"."<strong>"."Branch Code "."<strong>"."</td>";
    	echo "<td align='center' width='400' style='background-color:olive'>"."<strong>"."Branch Name "."<strong>"."</td>";
        /*echo "<td align='center' width='300' style='background-color:olive'>"."<strong>"."Officer Name "."<strong>"."</td>";
        echo "<td align='center' width='200' style='background-color:olive'>"."<strong>"."Officer Mobile No "."<strong>"."</td>";*/
        //echo "<td align='center' width='300' style='background-color:olive'>"."<strong>"."Email "."<strong>"."</td>";
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
        
        echo form_open('vsm/vsm_report_details/1');
        if(isset($previous_value) && !empty($previous_value))
        {
            foreach($previous_value as $key=>$val)
            {
                ?>
                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
                <?php
            }
        }
        
       	echo "<tr>";
        $attribute='style="background-color: #FF9900;"';
    	echo "<td align='center' COLSPAN='5'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";
    	
    	echo "</table>";
        
    	echo form_close();  
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

