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
	//echo "<pre>";
	//print_r($iss_4_data);
	//die();
	?>
  <?php 
		
	$uid = $this->session->userdata('some_uid');
	$office_id = $this->session->userdata('some_office');
  	?>
		
	
    <?php if(isset($iss_3_item_data) && !empty($iss_3_item_data) ) { ?>
	<?php 
			$branch_id = '';
		foreach( $iss_3_item_data as $single_iss3_item ) { 
			$branch_id = $single_iss3_item->BRANCH_ID;
		}?>
	<table  align="center">
		<tr align="center"><th>ISS Form-3 (T_PS_M_FI_ACCEPTANCE_HO) Report</th></tr>
		<tr align="center"><th><?php echo isset($report_of_office)?$report_of_office:''; echo "-"; echo isset($branch_id)?$branch_id:''; ?></th></tr>
		<tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
	</table>
	
	<table border=\"1\" align=\"center\">
			<tr>
				<td align='left' style=""><strong>WITH BANK ID</strong></td>
				<td align='left' style=""><strong>VALUE OF ACCEPTANCE ISSUED AMOUNT</strong></td>
				<td align='left' style=""><strong>VALUE OF ISSUED ACCEPTANCE MATURED</strong></td>
				<td align='left' style=""><strong>VALUE OF RECEIVED ACCEPTANCE</strong></td>
				<td align='left' style=""><strong>PURCHASED AMOUNT OF RECEIVED ACCEPTANCE</strong></td>
				<td align='left' style=""><strong>MATURED OF RECEIVED ACCEPTANCE</strong></td>
				<td align='left' style=""><strong>Bank ID2</strong></td>
				<td align='left' style=""><strong>FI NAME</strong></td>
			</tr>
			<?php foreach( $iss_3_item_data as $single_iss3_item ) { ?>
			<tr>
				<td align='center' style=""><strong><?php echo $single_iss3_item->WITH_BANK_ID; ?></strong></td>
				<td align='right' style=""><strong><?php echo $single_iss3_item->VALUE_OF_ACCEPTANCE_ISSUED_AMO; ?></strong></td>
				<td align='right' style=""><strong><?php echo $single_iss3_item->VALUE_OF_ISSUED_ACCEPTANCE_MAT; ?></strong></td>
				<td align='right' style=""><strong><?php echo $single_iss3_item->VALUE_OF_RECEIVED_ACCEPTANCE; ?></strong></td>
				<td align='right' style=""><strong><?php echo $single_iss3_item->PURCHASED_AMOUNT_OF_RECEIVED_A; ?></strong></td>
				<td align='right' style=""><strong><?php echo $single_iss3_item->MATURED_OF_RECEIVED_ACCEPTANCE; ?></strong></td>
				<td align='center' style=""><strong><?php echo $single_iss3_item->Bank_ID2; ?></strong></td>
				<td align='left' style=""><strong><?php echo $single_iss3_item->FI_NAME; ?></strong></td>
			</tr>
			<?php } ?> 
	</table>
	<?php } else { ?>
		<div style="background:red;color:#fff;width:50%;"><h3>No Report found.</h3></div>
	<?php } ?>
</body>
</html>
