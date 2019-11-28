<style type="text/css">
html { 
margin-left: 15px;
margin-bottom: 5px;
}
</style>

<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>	
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
			<tr align="center"><th>Reporting: <?php echo isset($pre_date)?$pre_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>		
	<?php } ?>
        
	<tr align="center"><th>Report of: <?php echo isset($report_of_date2)?$report_of_date2:''; ?></th></tr>
	<?php 
		if(isset($login_office_status) && $login_office_status==1)
		{?>
			<tr align="center"><th>Reporting: <?php echo isset($next_date)?$next_date:''; ?>/<?php echo count($whole_br_list); ?></th></tr>		
	<?php } ?>
	
	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>
	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
	
	<?php
	if(isset($iss_2_item_data) && !empty($iss_2_item_data))
	{
	?>
    <table border="1" style="border-collapse:collapse;" id="t1">
	<?php
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
		
	if(isset($login_office_status) && $login_office_status != 1)
	{
		echo "<td align='left'>"."<strong>"."Division "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Area "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Branch Name "."<strong>"."</td>";
		echo "<td align='left'>"."<strong>"."Branch Code "."<strong>"."</td>";
		echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
		echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date1)"."<strong>"."</td>";
		echo "<td align='left' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date2)"."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Diff</br>(Amount($report_of_date2) - Amount($report_of_date1))"."<strong>"."</td>";
		echo "<td align='center' style='font-size:8px'>"."<strong>"."Diff(%)</br>((Amount($report_of_date2) - Amount($report_of_date1))/Amount($report_of_date1))*100"."<strong>"."</td>";
	
		echo "</tr>";
	
		$co=1;
		foreach($iss_2_item_data as $row1)
		{
			echo "<tr>";
			echo "<td align='center'>".$co."</td>"; 
			echo "<td align='center'>".$row1->dvname."</td>"; 
			echo "<td align='center'>".$row1->znname."</td>"; 
			echo "<td align='center'>".$row1->branchname."</td>"; 
			echo "<td align='center'>".$row1->BRANCH_ID."</td>"; 
			echo "<td align='center'>".$row1->COA_DESCRIPTION."</td>"; 
					
			if($row1->COA_ID_VALUE==2)
			{
				if($row1->SUPERVISION_COA_ID=='1010310')
				{
					echo "<td align='right'>".number_format($row1->next_date, 0, '.', '')."</td>";
					echo "<td align='right'>".number_format($row1->pre_date, 0, '.', '')."</td>";
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
		echo "<td align='left' >"."<strong>"."COA DESCRIPTION "."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date1)"."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Amount</br>($report_of_date2)"."<strong>"."</td>";
		echo "<td align='center' style='font-size:9px'>"."<strong>"."Diff</br>(Amount($report_of_date2) - Amount($report_of_date1))"."<strong>"."</td>";
		echo "<td align='center' style='font-size:8px'>"."<strong>"."Diff(%)</br>((Amount($report_of_date2) - Amount($report_of_date1)) / ((Amount($report_of_date1))))*100"."<strong>"."</td>";
	
	echo "</tr>";	
		foreach($iss_2_item_data as $row1)
		{
			echo "<tr>";
				echo "<td align='center'>".$row1->sl."</td>"; 
				echo "<td align='left'>".$row1->COA_DESCRIPTION."</td>";
				
				if($row1->COA_ID_VALUE == 2)
				{
					
					if($row1->SUPERVISION_COA_ID == '1010310')
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
?>
</table>
<?php
}
?>