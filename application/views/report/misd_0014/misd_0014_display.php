<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Branch Specification Report</title>
</head>

<body>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
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

<!--form for list-->
<?php 
echo form_open('report/misd_0014_report_details_list',"id='showBrList_specification'");
?>
<input type="hidden" name="report_val" value="<?php echo base64_encode(json_encode($result_array));; ?>"/>
<input type="hidden" name="ptr_str" id="ptr_str" value=""/>
<input type="hidden" name="report_option_selector" value="<?php echo $report_option_selector; ?>"/>
<input type="hidden" name="range1_opndate" value="<?php echo isset($range1)?$range1:''; ?>"/>
<input type="hidden" name="range2_opndate" value="<?php echo isset($range2)?$range2:''; ?>"/>
<?php
echo form_close();
?>
<!--form for list-->


<table border="1" align="right" style="margin-top: -80px;">
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

<br/>

    <table border="1">
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
        
        
        <?php 
        $cor1_total=0;
        if(isset($row['report_val']['cor1']) && count($row['report_val']['cor1'])>0)
        {
           $cor1_total=count($row['report_val']['cor1']); 
        }
        if($cor1_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."cor1#".$key."'"; ?>)"><?php echo $cor1_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $cor1_total; ?></td><?php 
        }
        ?>
        
        
        <?php 
        $cor2_total=0;
        if(isset($row['report_val']['cor2']) && count($row['report_val']['cor2'])>0)
        {
           $cor2_total=count($row['report_val']['cor2']); 
        }
        if($cor2_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."cor2#".$key."'"; ?>)"><?php echo $cor2_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $cor2_total; ?></td><?php 
        }
        ?>
        
        
        <?php 
        $grade1_total=0;
        if(isset($row['report_val']['grade1']) && count($row['report_val']['grade1'])>0)
        {
           $grade1_total=count($row['report_val']['grade1']); 
        }
        if($grade1_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."grade1#".$key."'"; ?>)"><?php echo $grade1_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $grade1_total; ?></td><?php 
        }
        ?>
        
        
        <?php 
        $grade2_total=0;
        if(isset($row['report_val']['grade2']) && count($row['report_val']['grade2'])>0)
        {
           $grade2_total=count($row['report_val']['grade2']); 
        }
        if($grade2_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."grade2#".$key."'"; ?>)"><?php echo $grade2_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $grade2_total; ?></td><?php 
        }
        ?>
        
        
        <?php 
        $grade3_total=0;
        if(isset($row['report_val']['grade3']) && count($row['report_val']['grade3'])>0)
        {
           $grade3_total=count($row['report_val']['grade3']); 
        }
        if($grade3_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."grade3#".$key."'"; ?>)"><?php echo $grade3_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $grade3_total; ?></td><?php 
        }
        ?>
        
        
        <?php 
        $grade4_total=0;
        if(isset($row['report_val']['grade4']) && count($row['report_val']['grade4'])>0)
        {
           $grade4_total=count($row['report_val']['grade4']); 
        }
        if($grade4_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."grade4#".$key."'"; ?>)"><?php echo $grade4_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $grade4_total; ?></td><?php 
        }
        ?>
        
        
        <?php 
        $urban_total=0;
        if(isset($row['report_val']['urban']) && count($row['report_val']['urban'])>0)
        {
           $urban_total=count($row['report_val']['urban']); 
        }
        if($urban_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."urban#".$key."'"; ?>)"><?php echo $urban_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $urban_total; ?></td><?php 
        }
        ?>
        
        <?php 
        $rural_total=0;
        if(isset($row['report_val']['rural']) && count($row['report_val']['rural'])>0)
        {
           $rural_total=count($row['report_val']['rural']); 
        }
        if($rural_total>0)
        {
            ?><td align="center" style="font-size:larger"><a title="Click to see list" href="javascript:void(0)" onclick="showBrList_specification(<?php echo "'"."rural#".$key."'"; ?>)"><?php echo $rural_total; ?></a></td><?php
        }
        else
        {
           ?><td align="center" style="font-size:larger"><?php echo $rural_total; ?></td><?php 
        }
        ?>
        
        
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

    echo form_open('report/misd_0014_report_details/1');
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
