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
		<tr align="center"><th>ISS Report(T_PS_M_FI_MONITOR_HO)</th></tr>
		<tr align="center"><th><?php echo isset($report_of_office)?$report_of_office:''; ?></th></tr>
		<tr align="center"><th>Reporting year: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
    </table>
<?php

$fig_ind_desc = 'Actual';
	if(isset($fig_indication) && $fig_indication == 1) { $fig_ind_desc = 'Actual';}
	if(isset($fig_indication) && $fig_indication == 2) { $fig_ind_desc = 'Lac';}
	if(isset($fig_indication) && $fig_indication == 3) { $fig_ind_desc = 'Crore';}

    echo "<table border=\"1\" align=\"center\">";

	//if(isset($login_office_status) && $login_office_status == 1)
	{
		echo "<tr>";
		$ser_no = 1;
		$tmp_date = '';
		for($ii=0; $ii<count($iss_1_item_data); $ii++)
		{
			if($ii ==0)
			{
				echo "<td>"."<div style='height:50px; border: 1px solid black'><strong><span style='text-align:center'>SL </span></strong></div>";
				foreach($iss_1_item_data[$ii] as $fows){
					echo '<table>';
						echo "<tr>";
							echo "<td><div style='height:40px; border: 1px solid black; width:30px'>".$ser_no."</div></td>";
						echo "</tr>";
					echo '</table>';
					$ser_no++;
				}
				echo "</td>";

				echo "<td>"."<div style='height:50px; border: 1px solid black'><strong><span style='text-align:center'>SUPERVISION<br/> COA ID</span></strong></div>";
				foreach($iss_1_item_data[$ii] as $fows){
					echo '<table>';
						echo "<tr>";
							echo "<td><div style='height:40px; border: 1px solid black;width: 100px'>".$fows->SUPERVISION_COA_ID."</div></td>";
						echo "</tr>";
					echo '</table>';
				}
				echo "</td>";

				echo "<td>"."<div style='height:50px; border: 1px solid black'><strong><span style='text-align:center'>COA DESCRIPTION</span></strong></div>";
				foreach($iss_1_item_data[$ii] as $fows){
					echo '<table>';
						echo "<tr>";
							echo "<td><div style='height:40px; border: 1px solid black;width: 300px'>".$fows->COA_DESCRIPTION."</div></td>";
						echo "</tr>";
					echo '</table>';
				}
				echo "</td>";
			}
			foreach($iss_1_item_data[$ii] as $fows){
				$tmp_date = $fows->DATE;
			}
			if($tmp_date !='')
			{
				echo "<td>"."<div style='height:50px;border: 1px solid black; text-align:center'><strong><span style='text-align:center'>AMOUNT in $fig_ind_desc</span><span style='font-size:12px;text-align:center'> ($tmp_date)</span></strong></div>";
				foreach($iss_1_item_data[$ii] as $fows)
				{
					echo '<table>';
						echo "<tr>";
							if($fows->COA_ID_VALUE == 2)
							{
								echo "<td align='right'> <div style='height:40px; border: 1px solid black; width:140px'>".number_format($fows->AMOUNT_BDT, 0, '.','')."</div></td>";
							}
							else
							{
								if(isset($fig_indication) && $fig_indication == 3)
								{
									$temp_amt1 = $fows->AMOUNT_BDT/10000000;
									echo "<td align='right'> <div style='height:40px; border: 1px solid black; width:140px'>".number_format($temp_amt1, 2)."</div></td>";
								}
								elseif (isset($fig_indication) && $fig_indication == 2)
								{
									$temp_amt1 = $fows->AMOUNT_BDT/100000;
									echo "<td align='right'> <div style='height:40px; border: 1px solid black; width:140px'>".number_format($temp_amt1, 2)."</div></td>";
								}
								else
								{
									echo "<td align='right'> <div style='height:40px; border: 1px solid black; width:140px'>".number_format($fows->AMOUNT_BDT, 2)."</div></td>";
								}

							}
						echo "</tr>";
					echo '</table>';
				}
			}

			echo "</td>";
		}
	echo "</tr>";
	}
	echo "</table>";
?>