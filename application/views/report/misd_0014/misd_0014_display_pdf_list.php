<style type="text/css">
html { 
margin-left: 5px;
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
    <td align="center" style="font-size:18px;"><?php echo isset($title)?$title:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
if(isset($ptr_val) && !empty($ptr_val))
{
?>

<table border="1" align="right" style="border: thin;margin-top: -80px;border-collapse: collapse;" id="t1">
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

<br />
<table border="1" align="center" id="t1" style="border-collapse: collapse;">
 <tr align="center">
 <td>SL</td>
 <td>Branch Code</td>
 <td>Branch Name</td>
 <td>Opening Date</td>
 <td>Address</td>
 <td>Phone</td>
 </tr>
 
<?php foreach($ptr_val as $key=>$row){ ?> 
<tr>
<td align="center"><?php echo ($key+1); ?></td>
<td align="center"><?php echo isset($row->brcode)?$row->brcode:''; ?></td>
<td align="left"><?php echo isset($row->branchname)?$row->branchname:''; ?></td>
<td align="left"><?php echo isset($row->Opndate)?date('d-M-Y',strtotime($row->Opndate)):''; ?></td>
<td align="left"><?php echo isset($row->Address)?$row->Address:''; ?></td>
<td align="left"><?php echo isset($row->OfficePhone)?$row->OfficePhone:''; ?></td>
</tr>

<?php } ?>

</table>
<br/>
<?php 
}
?>