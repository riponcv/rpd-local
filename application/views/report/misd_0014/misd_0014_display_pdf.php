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

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">Branch Specification Report</td>
  </tr>
  
    <?php
      $open_date_title='';
      //if opening date range set range set
	  
        if(isset($previous_value['range1_opndate']) && isset($previous_value['range2_opndate']) && $previous_value['range1_opndate'] !='' && $previous_value['range2_opndate'] !='')
        {
          if($previous_value['range2_opndate']>$previous_value['range1_opndate'])
          {
			$date1 = new DateTime($previous_value['range1_opndate']);
			$date2 = new DateTime($previous_value['range2_opndate']);
			
			$range1=$date1->format('d-M-Y');
            $range2=$date2->format('d-M-Y');
          }
		  else
		  {
			$date1 = new DateTime($previous_value['range2_opndate']);
			$date2 = new DateTime($previous_value['range1_opndate']);
			
			$range1=$date1->format('d-M-Y');
            $range2=$date2->format('d-M-Y');
		  }
          $open_date_title=" Opening Date($range1 to $range2) ";  
        }
    ?>
    <?php if($open_date_title !='') { ?>
  <tr>
    <td align="center" style="font-size:18px;"><?php echo $open_date_title; ?></td>
  </tr>
  <?php } ?>
  
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
<table align="right" id="t1" style="border-collapse: collapse;margin-top: -80px;">
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


    <table id="t1" style="border-collapse: collapse;" align="center">
	<tr>
		<td align="center" style="font-size:22px"><?php echo 'SL'; ?></td>
        <td align="center" width="200" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>
		<td align="center" style="font-size:22px">Corporate-1</td>
		<td align="center" style="font-size:22px">Corporate-2</td>
		<td align="center" style="font-size:22px">Grade-1</td>
        <td align="center" style="font-size:22px">Grade-2</td>
        <td align="center" style="font-size:22px">Grade-3</td>
        <td align="center" style="font-size:22px">Grade-4</td>
        <td align="center" style="font-size:22px">Urban</td>
        <td align="center" style="font-size:22px">Rural</td>
	</tr>
    
    <?php
        $cor1_gTotal=0;
        $cor2_gTotal=0;
        $grade1_gTotal=0;
        $grade2_gTotal=0;
        $grade3_gTotal=0;
        $grade4_gTotal=0;
        $urban_gTotal=0;
        $rural_gTotal=0;
    ?>
    
        <?php foreach($result_array as $key=>$row) { ?>
		<tr>
        <?php 
        //total calculation
        
        $cor1_gTotal=$cor1_gTotal+count($row['report_val']['cor1']);
        $cor2_gTotal=$cor2_gTotal+count($row['report_val']['cor2']);
        $grade1_gTotal=$grade1_gTotal+count($row['report_val']['grade1']);
        $grade2_gTotal=$grade2_gTotal+count($row['report_val']['grade2']);
        $grade3_gTotal=$grade3_gTotal+count($row['report_val']['grade3']);
        $grade4_gTotal=$grade4_gTotal+count($row['report_val']['grade4']);
        $urban_gTotal=$urban_gTotal+count($row['report_val']['urban']);
        $rural_gTotal=$rural_gTotal+count($row['report_val']['rural']);
        
        ?>
        <td align="left"><?php echo ($key+1); ?></td>
		<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['cor1'])?count($row['report_val']['cor1']):'0'; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['cor2'])?count($row['report_val']['cor2']):'0'; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['grade1'])?count($row['report_val']['grade1']):'0'; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['grade2'])?count($row['report_val']['grade2']):'0'; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['grade3'])?count($row['report_val']['grade3']):'0'; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['grade4'])?count($row['report_val']['grade4']):'0'; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['urban'])?count($row['report_val']['urban']):'0'; ?></td>
        <td align="center" style="font-size:larger"><?php echo isset($row['report_val']['rural'])?count($row['report_val']['rural']):'0'; ?></td>
		</tr>
        <?php } ?>
        
        <tr style="font-weight: bold;">
    		<td align="left" colspan="2">Total</td>
    		<td align="center"><?php echo $cor1_gTotal; ?></td>
    		<td align="center"><?php echo $cor2_gTotal; ?></td>
    		<td align="center"><?php echo $grade1_gTotal; ?></td>
    		<td align="center"><?php echo $grade2_gTotal; ?></td>
    		<td align="center"><?php echo $grade3_gTotal; ?></td>
    		<td align="center"><?php echo $grade4_gTotal; ?></td>
    		<td align="center"><?php echo $urban_gTotal; ?></td>
    		<td align="center"><?php echo $rural_gTotal; ?></td>
        </tr>
        
        

</table>

<br/>
<?php 
}
?>