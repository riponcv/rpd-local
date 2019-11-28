<style type="text/css">
html { 
margin-left: 25px;
margin-bottom: 5px;
}
</style>


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
<table border="1" align="right" style="border-collapse: collapse;margin-top: -60px;" id="t1">
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
<br/>
<br/>
<table border="1" align="center" style="border-collapse: collapse;" id="t1">
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
}
?>