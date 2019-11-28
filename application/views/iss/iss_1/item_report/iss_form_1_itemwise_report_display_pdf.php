
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		table.tbl_act td {
		    border: 1px solid #ddd;
		}
	</style>
</head>
<body>
<?php
$array_v = json_decode(json_encode($form1_iss_item_data), True);
$M = 0 ;
$temp_date = '';
foreach ($array_v as $value) {
	$temp_date = $array_v[$M][0]['DATE'];
	$array_date[] = "$temp_date";
	$M++;
}

?>

<?php
echo form_open('iss/iss_form_1_itemwise_report_details/1','id="iss_item_1_dis_form"');
?>

  <?php if(isset($array_v) && count($array_v)>0)  { ?>
  	<?php
		$fig_ind_desc = 'Actual';
		if(isset($fig_indication) && $fig_indication == 1) { $fig_ind_desc = 'Actual';}
		if(isset($fig_indication) && $fig_indication == 2) { $fig_ind_desc = 'Lac';}
		if(isset($fig_indication) && $fig_indication == 3) { $fig_ind_desc = 'Crore';}
  	?>
  	<table align="center" style="">
		<tr align="center"><td><strong> ISS Form-1 (T_PS_M_FI_MONITOR_HO) Report</strong></td></tr>
		<tr align="center"><td> <strong>Item wise Report</strong></td></tr>
		<tr align="center"><td><strong>Head Office-120391</strong> </td></tr>
		<tr align="center"><td><strong>Reporting of <?php echo isset($report_of_date2)? $report_of_date2: ''; ?> to <?php echo isset($report_of_date1)? $report_of_date1: ''; ?> </strong> </td></tr>
  	</table>
<?php
 $checked_1 = ''; $checked_2 = ''; $checked_3 = '';
 if(isset($fig_indication) && $fig_indication == 1 || $fig_indication == ''){ $checked_1 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 2){ $checked_2 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 3){ $checked_3 = "checked='checked'"; }
?>
  	<br>
    <table border="1" class="tbl_act" style="">
    	<tr>
			<td style="font-weight: 700;">SL</td>
			<td  style="font-weight: 700;">COA DESCRIPTION</td>
			<?php foreach($array_date as $sin_date) {?>
				<td  style="font-weight: 700; font-size: 14px; text-align: center;">Amount in BDT (<?php echo isset($fig_ind_desc) ? $fig_ind_desc: ' '; ?>)  <br><?php echo  isset($sin_date) ? $sin_date: ' '; ?></td>
			<?php } ?>

    	</tr>
		<?php $sl_no =1; $N = 0; foreach($value as $naser) { ?>
			<tr>
				<td align="center"><?php echo $sl_no; ?></td>
				<td><?php echo $naser['COA_DESCRIPTION']; ?></td>
				<?php $BALL =0; foreach($array_v as $sin_date) { ?>
				<td align="right"><?php
					if($array_v[$BALL][$N]['COA_ID_VALUE'] != 2){
						if(isset($fig_indication) && $fig_indication == 3){
							$temp_amt = $array_v[$BALL][$N]['AMOUNT_BDT']/10000000;
							echo number_format($temp_amt, 2);
						}
						elseif (isset($fig_indication) && $fig_indication == 2){
							$temp_amt = $array_v[$BALL][$N]['AMOUNT_BDT']/100000;
							echo number_format($temp_amt, 2);
						}
						else
						{
							echo number_format($array_v[$BALL][$N]['AMOUNT_BDT'], 2);
						}
					}
					else {
						echo number_format($array_v[$BALL][$N]['AMOUNT_BDT'], 0, '.', '');
					}

					?></td>
				<?php $BALL++; } ?>
			</tr>
		<?php $N++; $sl_no++; } ?>

</table>

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