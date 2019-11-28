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
  if($this->session->flashdata('success_wp'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_wp').'</font>'; 
    	echo "</div>";
    }
		
	$uid = $this->session->userdata('some_uid');
	$office_id = $this->session->userdata('some_office');
	
		
	if(isset($login_office_status) && $login_office_status == 4)
	{
		 $bank_id_s = ''; $branch_id_bb_s = '';
		if(isset($iss_4_data) && !empty($iss_4_data) ) {
			foreach( $iss_4_data as $single_iss4_item_s ) {
				$branch_id_bb_s = $single_iss4_item_s->BRANCH_ID;
				$bank_id_s = $single_iss4_item_s->BANK_ID;
			}	
		}
	}
	$ad_br_list  = array('120373','120083','120570','120794','120407','121149','120079','120307','121129','120911',
					  '120139','120371','120396','120101','120749','120347','120356','120400','120544','120361',
					  '120052','120556','120714','120426','120450','121086','120362','120816','120389','120933',
					  '120383','120172','120414','120754','120421','120542','120401','120384','120358','120095',
					  '120368','120339','120427','120051','120364','120399','120299','120068','120793','120691',
					  '120109','120437','120442','120167','120944','120444');
  	?>
		
	<table  align="center">
    <tr align="center"><th>ISS Form-4 (T_PS_M_FI_ACCEPTANCE_BR) Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date)?$report_of_date:''; ?></th></tr>
	<?php
	if(isset($login_office_status) && $login_office_status == 4)
	{
	?>
	<tr align="left"><th>Bank ID: <?php echo isset($bank_id_s)?$bank_id_s:''; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php
	}
	?>
	<?php if(isset($login_office_status) && $login_office_status != 4 && $login_office_status !=1) {?>    
	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>    
	<?php if(isset($cer_completed_vs_total['total']) && $cer_completed_vs_total['total']>1){ ?><tr align="center"><th>
	Certificate Reporting: <?php echo isset($cer_completed_vs_total['completed'])?$cer_completed_vs_total['completed']:'0'; echo '/'; echo isset($cer_completed_vs_total['total'])?$cer_completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
	<?php } ?>
	
	<?php if(isset($login_office_status) && $login_office_status ==1) {?>    
	
	<?php if(isset($whole_raw) && $whole_raw>1){ ?><tr align="center"><th>Reporting: <?php echo isset($whole_raw)? $whole_raw:'0'; echo '/'; echo isset($whole_raw)?$whole_raw:'0'; ?></th></tr><?php } ?>    
	<?php if(isset($whole_certificate) && $whole_certificate>1){ ?><tr align="center"><th>
	Certificate Reporting: <?php echo isset($whole_certificate)?$whole_certificate:'0'; echo '/'; echo isset($whole_raw)?$whole_raw:'0'; ?></th></tr><?php } ?>
	<?php } ?>
	</table>
    <?php if(isset($iss_4_data) && !empty($iss_4_data) ) { ?>
    
    <?php
		$V_acc_iss_amt_sum =0 ;
		$V_iss_acc_mat_sum =0 ;
		$V_rec_acc_sum =0 ;
		$P_amt_rec_acc_sum =0 ;
		$Mat_rec_acc_sum =0 ;
	?>
	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<?php if (in_array( $branch_id_bb, $ad_br_list)){  ?>
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
			<?php foreach( $iss_4_data as $single_iss4_item ) { ?>
			<tr>
				<td align='center' style=""><strong><?php echo $single_iss4_item->WITH_BANK_ID; ?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->V_acc_iss_amt, 2); 
					$V_acc_iss_amt_sum = $V_acc_iss_amt_sum + $single_iss4_item->V_acc_iss_amt; ?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->V_iss_acc_mat, 2); 
					$V_iss_acc_mat_sum = $V_iss_acc_mat_sum + $single_iss4_item->V_iss_acc_mat;
				?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->V_rec_acc, 2); 
					$V_rec_acc_sum = $V_rec_acc_sum + $single_iss4_item->V_rec_acc;
				?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->P_amt_rec_acc, 2); 
					$P_amt_rec_acc_sum = $P_amt_rec_acc_sum + $single_iss4_item->P_amt_rec_acc;
				?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->Mat_rec_acc, 2); 
					$Mat_rec_acc_sum = $Mat_rec_acc_sum + $single_iss4_item->Mat_rec_acc;
				?></strong></td>
				<td align='center' style=""><strong><?php echo $single_iss4_item->Bank_ID2; ?></strong></td>
				<td align='left' style=""><strong><?php echo $single_iss4_item->FI_NAME; ?></strong></td>
				
			</tr>
		<?php } ?> 
			<tr>
				<td align='left' style="background: #8c8c8c"><strong>Total</strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($V_acc_iss_amt_sum) ? number_format($V_acc_iss_amt_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($V_iss_acc_mat_sum) ? number_format($V_iss_acc_mat_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($V_rec_acc_sum) ? number_format($V_rec_acc_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($P_amt_rec_acc_sum) ? number_format($P_amt_rec_acc_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($Mat_rec_acc_sum) ? number_format($Mat_rec_acc_sum, 2) :'0'; ?></strong></td>
				
			</tr>
		</table>
		<?php } else {
			?>
			<div style="background:red;color:#fff;width:50%;"><h3>This report only for AD Branch.</h3></div>
		<?php } ?>
		<?php } ?>
		
	
	<?php
	if(isset($login_office_status) && $login_office_status != 4 && $login_office_status !=1)
	{
		?>
		<div style="background:red;color:#fff;width:50%;"><h3>No Report found.</h3></div>
		<?php
	}
	if(isset($login_office_status) && $login_office_status ==1) { ?>
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
			<?php foreach( $iss_4_data as $single_iss4_item ) { ?>
			<tr>
				<td align='center' style=""><strong><?php echo $single_iss4_item->WITH_BANK_ID; ?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->V_acc_iss_amt, 2); 
				$V_acc_iss_amt_sum = $V_acc_iss_amt_sum + $single_iss4_item->V_acc_iss_amt;
				?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->V_iss_acc_mat, 2); 
					$V_iss_acc_mat_sum = $V_iss_acc_mat_sum + $single_iss4_item->V_iss_acc_mat;
				?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->V_rec_acc, 2); 
					$V_rec_acc_sum = $V_rec_acc_sum + $single_iss4_item->V_rec_acc;
				?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->P_amt_rec_acc, 2); 
					$P_amt_rec_acc_sum = $P_amt_rec_acc_sum + $single_iss4_item->P_amt_rec_acc;
				?></strong></td>
				<td align='right' style=""><strong><?php echo number_format($single_iss4_item->Mat_rec_acc, 2); 
					$Mat_rec_acc_sum = $Mat_rec_acc_sum + $single_iss4_item->Mat_rec_acc;
				?></strong></td>
				<td align='center' style=""><strong><?php echo $single_iss4_item->Bank_ID2; ?></strong></td>
				<td align='left' style=""><strong><?php echo $single_iss4_item->FI_NAME; ?></strong></td>
				
			</tr>
			<?php } ?>
			<tr>
				<td align='left' style="background: #8c8c8c"><strong>Total</strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($V_acc_iss_amt_sum) ? number_format($V_acc_iss_amt_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($V_iss_acc_mat_sum) ? number_format($V_iss_acc_mat_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($V_rec_acc_sum) ? number_format($V_rec_acc_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($P_amt_rec_acc_sum) ? number_format($P_amt_rec_acc_sum, 2) :'0'; ?></strong></td>
				<td align='right' style="background: #8c8c8c"><strong><?php echo isset($Mat_rec_acc_sum) ? number_format($Mat_rec_acc_sum, 2) :'0'; ?></strong></td>
				<td align='left' style=""><strong></strong></td>
				<td align='left' style=""><strong></strong></td>
			</tr>			
		</table>
	<?php } ?>
	<?php } else { ?>
		<div style="background:red;color:#fff;width:50%;"><h3>No Report found.</h3></div>
	<?php } ?>
</body>
</html>
