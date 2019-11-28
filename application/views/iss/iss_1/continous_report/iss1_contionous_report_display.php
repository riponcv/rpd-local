<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>


</head>
<body>

    <table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
    </table><br/><br/>

  <?php
  	$fig_ind_desc = 'Actual';
	if(isset($fig_indication) && $fig_indication == 1) { $fig_ind_desc = 'Actual';}
	if(isset($fig_indication) && $fig_indication == 2) { $fig_ind_desc = 'Lac';}
	if(isset($fig_indication) && $fig_indication == 3) { $fig_ind_desc = 'Crore';}

	$checked_1 = ''; $checked_2 = ''; $checked_3 = '';
 if(isset($fig_indication) && $fig_indication == 1 || $fig_indication == ''){ $checked_1 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 2){ $checked_2 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 3){ $checked_3 = "checked='checked'"; }


   if(isset($iss_1_item_data) && count($iss_1_item_data)>0)
   {
	?>

    <table  align="center">
		<tr align="center"><th>ISS Form-1(T_PS_M_FI_MONITOR_HO) Year wise  Report</th></tr>
		<tr align="center"><th><?php echo isset($report_of_office)?$report_of_office:''; ?></th></tr>
		<tr align="center"><th>Reporting year: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
    </table>
    <div class="box">
    <?php
    echo "<table border=\"1\" align=\"center\">"; ?>

	<tr>
		<td colspan="6" style="border: 0;">Amount in BDT of
		<input type="radio" name="amt_fig" id="act_val" onclick="check_fig_indication_iss1_con_rep(this.value)" <?php  echo isset($checked_1) ? $checked_1: ' ';?> value="1"> Actual
  		<input type="radio" name="amt_fig" id="lac_val" onclick="check_fig_indication_iss1_con_rep(this.value)" <?php echo isset($checked_2) ? $checked_2: ' '; ?> value="2"> Lac
  		<input type="radio" name="amt_fig" id="crr_val" onclick="check_fig_indication_iss1_con_rep(this.value)" <?php echo isset($checked_3) ? $checked_3: ' '; ?> value="3"> Crore</td>
	</tr>

    <?php
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
				echo "<td>"."<div style='height:50px;border: 1px solid black; text-align:center'><strong><span style='text-align:center'>AMOUNT in $fig_ind_desc <br></span><span style='font-size:12px;text-align:center'> ($tmp_date)</span></strong></div>";
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



echo form_open('iss/iss_form_1_continous_report_details/1', 'id="iss_form_1_continous_report__form"');
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
        $attribute='style="background-color: #FF9900;" onclick="check_iss_form1_con_rep_pdf(this.value)"';
    	//echo "<td align='center' COLSPAN='7'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";

    	echo "</table>";
echo "</div>";
    	?>

<input type="hidden" name="pdf_btn_inst" id="pdf_btn_inst" value="0" />
<input type="hidden" name="fig_indication_post" id="fig_indication_post" value="<?php echo isset($fig_indication) ? $fig_indication: ' '; ?>"/>


    	<?php
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
</body>
</html>
