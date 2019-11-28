<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<p>

    <table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
    </table><br/><br/>  
  
  
  <?php 
    //echo $login_office_status;
	//echo "<pre>";
	//print_r($iss_2_comp_no_days_exced_cash_data);
	//die();
   if(isset($iss_2_comp_data) && count($iss_2_comp_data)>0)
   {
	
	$next_date_noexcee_val=0;
	$pre_date_noexcee_val=0;
	if(isset($iss_2_comp_no_days_exced_cash_data) && count($iss_2_comp_no_days_exced_cash_data)>0)
	{
		foreach($iss_2_comp_no_days_exced_cash_data as $row_noexcess){
		$next_date_noexcee_val=$row_noexcess->next_date_noexcee;$pre_date_noexcee_val=$row_noexcess->pre_date_noexcee;
		}	
	}	
	
	?>
	
    <table  align="center">
    <tr align="center"><th>ISS Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
	<?php 
		$pre_date='';
		$next_date='';
		if(isset($login_office_status) && $login_office_status==1)
		{
			foreach($iss_2_whole_br_raw as $row_whole_br){$pre_date=$row_whole_br->first_br;$next_date=$row_whole_br->second_br;} ?>
			<tr align="center"><th>Report of: <?php echo isset($pre_date)?$pre_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>		
	<?php } ?>
        
	<tr align="center"><th>Report of: <?php echo isset($report_of_date2)?$report_of_date2:''; ?></th></tr>
	<?php 
		if(isset($login_office_status) && $login_office_status==1)
		{?>
			<tr align="center"><th>Report of: <?php echo isset($next_date)?$next_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>		
	<?php } ?>
	
	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>
	
	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
    <?php
		
    echo "<table border=\"1\" align=\"center\">";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left'>"."<strong>"."SUPERVISION COA ID "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
	echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount($report_of_date1)"."<strong>"."</td>";
	echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount($report_of_date2)"."<strong>"."</td>";
	echo "<td align='center' style='font-size:9px'>"."<strong>"."Diff</br>(Amount($report_of_date2) - Amount($report_of_date1))"."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Diff(%)"."<strong>"."</td>";
	
	echo "</tr>";
		
	if(isset($login_office_status) && $login_office_status != 1)
	{
		$co=0;
		foreach($iss_2_comp_data as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$row1->sl."</td>"; 
			echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
			echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
			
			if($row1->COA_ID_VALUE==2)
			{
				if($row1->SUPERVISION_COA_ID=='1010310')
				{
					echo "<td align='right'>".number_format($row1->next_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 0, '.', '')."</td>";
					echo "<td align='right'>"."0"."</td>";
					echo "<td align='right'>"."0"."</td>";
				}
				else if($login_office_status !=4 && $row1->SUPERVISION_COA_ID=='1011665')
				{
					echo "<td align='right'>".number_format($next_date_noexcee_val, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($pre_date_noexcee_val, 0, '.', '')."</td>";
					echo "<td align='right'>"."0"."</td>";
					echo "<td align='right'>"."0"."</td>";
				}
				else
				{
					echo "<td align='right'>".number_format($row1->next_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->Diff, 0, '.', '')."</td>";
					echo "<td align='right'>".$row1->diff_per."</td>";
					
				}
				
			}
			else
			{
				echo "<td align='right'>".number_format($row1->next_date,2)."</td>";
				echo "<td align='right'>".number_format($row1->pre_date,2)."</td>";
				echo "<td align='right'>".$row1->Diff."</td>";
				echo "<td align='right'>".$row1->diff_per."</td>";//diff_per
			}
			echo "</tr>";
			$co++;
		}
	}
	if(isset($login_office_status) && $login_office_status == 1)
	{
			
		foreach($iss_2_comp_data as $row1)
		{
			echo "<tr>";
				echo "<td align='center'>".$row1->sl."</td>"; 
				echo "<td align='right'>".$row1->SUPERVISION_COA_ID."</td>";
				echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
				
				if($row1->COA_ID_VALUE == 2)
				{
					
					if($row1->SUPERVISION_COA_ID == '1010310' || $row1->SUPERVISION_COA_ID=='1011665')
					{
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT1, 0, '.', '')."</td>";
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT2, 0, '.', '')."</td>";
						echo "<td align='right'>"."0"."</td>";
						echo "<td align='right'>"."0"."</td>";
					}
					else
					{
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT1, 0, '.', '')."</td>";
						echo "<td align='right'>".number_format($row1->AMOUNT_BDT2, 0, '.', '')."</td>";
						echo "<td align='right'>".number_format($row1->Diff, 0, '.', '')."</td>";
						echo "<td align='right'>".$row1->diff_per."</td>";	
					}
					
				}
				else
				{
					echo "<td align='right'>".number_format($row1->AMOUNT_BDT1,2)."</td>";
					echo "<td align='right'>".number_format($row1->AMOUNT_BDT2,2)."</td>";
					echo "<td align='right'>".$row1->Diff."</td>";
					echo "<td align='right'>".$row1->diff_per."</td>";
				}
				
			echo "</tr>";
		}
	}
	
	echo form_open('iss/iss_comparision_report_details/1');
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
    	echo "<td align='center' COLSPAN='7'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";
    	
    	echo "</table>";
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
</p>
</body>
</html>
