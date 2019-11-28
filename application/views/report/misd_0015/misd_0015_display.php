<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Range-wise Business Indicator</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>

<?php
$title_text='';

if($report_click_btn==1){$title_text_real='Deposit';}
if($report_click_btn==7){$title_text_real='HCD';}
if($report_click_btn==8){$title_text_real='LCD';}
if($report_click_btn==9){$title_text_real='HCD(%)';}
if($report_click_btn==10){$title_text_real='LCD(%)';}
if($report_click_btn==11){$title_text_real='ADR including LYA';}
if($report_click_btn==13){$title_text_real='ADR excluding LYA';}
if($report_click_btn==2){$title_text_real='Advance';}
if($report_click_btn==3){$title_text_real='PL';}
if($report_click_btn==4){$title_text_real='UC';}
if($report_click_btn==5){$title_text_real='CL';}
if($report_click_btn==6){$title_text_real='CL(%) excluding stuff loan';}
if($report_click_btn==12){$title_text_real='CL% including stuff loan';}

if($range1==''){$title_text=" (Below $range2) ";  }
if($range2==''){$title_text=" (Above $range1) ";  }
if($range1 != '' && $range2 != ''){$title_text="($range1-$range2)";}
?>

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Range-wise Business Indicator<br/><?php echo $title_text_real; ?> <?php echo $title_text; ?></td>
  </tr>
  <tr>
    <td align="center">Report of : <?php echo isset($report_of_date)?$report_of_date:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><td>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></td></tr><?php } ?>
</table>
<?php
if(isset($result_array) && !empty($result_array))
{
?>
<table border="1" align="right" style="margin-top: -115px;">
  <tr>
    <td width="50">Report</td>
    <td width="50"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="100">Printing Date </td>
    <td width="120"><?php echo date('d/m/y'); ?></td>
  </tr>
  <tr>
    <td width="100">Source </td>
    <td width="180">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>

<br /><br />
<table border="1">
    <tr>
    <th>SL</th>
    <th>Brcode</th>
    <th>Branch Name</th>
    <th>Grade</th>
    <th>Area Office</th>
    <th>Division</th>
    <th><?php echo $title_text_real; ?></th>
    </tr> 
    
    <?php foreach($result_array as $key=>$row){ ?> 
    <tr>
    <td align="center"><?php echo ($key+1); ?></td>
    <td align="center"><?php echo isset($row['dd_jo_code'])?$row['dd_jo_code']:''; ?></td>
    <td align="left"><?php echo isset($row['dd_jo_code'])?$row['branchname']:''; ?></td>
    <td align="left"><?php echo isset($row['dd_jo_code'])?$row['gradesname']:''; ?></td>
    <td align="left"><?php echo isset($row['dd_jo_code'])?$row['znname']:''; ?></td>
    <td align="left"><?php echo isset($row['dd_jo_code'])?$row['dvname']:''; ?></td>
    <td align="right"><?php echo isset($row['dd_jo_code'])?round($row['value'],2):''; ?></td>
    </tr>
    <?php } ?> 
       
</table>
<br/>
<?php 

    echo form_open('report/misd_0015_report_details/1');
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
