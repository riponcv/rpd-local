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
  <!--<table  align="right" border="1">
	<tr><td><strong>As per BRPD <br/>Circular letter</strong></td><td><strong>3</strong></td></tr>
	<tr><td><strong>Date</strong></td><td><strong>27.01.2014</strong></td></tr>
	</table>-->
  
  <?php 
   if(isset($vsm_data_detail) && !empty($vsm_data_detail))
   {
	?>
    <table  align="center">
    <tr align="center"><th>Vault Security Management Report</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
	<tr align="center"><th><?php echo isset($command_office)?$command_office:''; ?></th></tr>
    </table>
    
    <?php
    echo '<table border="1">';
    $last_sub_dt='';
    if(isset($vsm_data_detail['vsm_data_sb_dt']) && $vsm_data_detail['vsm_data_sb_dt'] !='')
    {
        $last_sub_dt=date("d-M-Y", strtotime($vsm_data_detail['vsm_data_sb_dt']));
    }
    echo '<tr style="font-weight: bold;">';
    echo '<td>Last Submission Date : '.$last_sub_dt.'</td>';
    echo '</tr>'; 
	echo '</table><br/>';
    ?>
    
        <table border="2" width="800" align="center">
        
        <!-- Structural Security Start -->
    	<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Structural Security</th></tr>
    	
        <tr>
        <td>1.1</td>
        <td>Steel frame has been given around vault space</td>
        <?php
        $steel_frame_YN='';
        if(isset($vsm_data_detail['steel_frame_YN']))
        {
           if($vsm_data_detail['steel_frame_YN']==''){$steel_frame_YN='Not mentioned';}
           elseif($vsm_data_detail['steel_frame_YN']=='1'){$steel_frame_YN='Yes';}
           else{$steel_frame_YN='NO';} 
        }
        ?>
        <td colspan="2" style="text-align: center;"><?php echo $steel_frame_YN; ?></td>
        </tr>
        
    	<tr>
        <td>1.2</td>
        <td>Security tested door has been established</td>
		<?php
        $security_door_YN='';
        if(isset($vsm_data_detail['security_door_YN']))
        {
           if($vsm_data_detail['security_door_YN']==''){$security_door_YN='Not mentioned';}
           elseif($vsm_data_detail['security_door_YN']=='1'){$security_door_YN='Yes';}
           else{$security_door_YN='NO';} 
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $security_door_YN; ?></td>
        </tr>
        
    	<tr>
        <td>1.3</td>
        <td>Floor, roof and surrounding wall of vault room constructed as per instruction circular No. 44, Date: 01.03.2009 which was ensured by certificate of Govt./Bank civil engineer</td>
        <?php
        $security_FRW_YN='';
        if(isset($vsm_data_detail['security_FRW_YN']))
        {
           if($vsm_data_detail['security_FRW_YN']==''){$security_FRW_YN='Not mentioned';}
           elseif($vsm_data_detail['security_FRW_YN']=='1'){$security_FRW_YN='Yes';}
           else{$security_FRW_YN='NO';} 
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $security_FRW_YN; ?></td>
        </tr>
        
       	<tr>
        <td>1.4</td>
        <td>Position of branch in the building</td>
        <?php
        $vault_room_position='Not mentioned';
        if(isset($vsm_data_detail['vault_room_position']))
        {
           if($vsm_data_detail['vault_room_position']=='0'){$vault_room_position='Ground floor';}
           if($vsm_data_detail['vault_room_position']=='1'){$vault_room_position='1st floor';}
           if($vsm_data_detail['vault_room_position']=='2'){$vault_room_position='2nd floor';}
           if($vsm_data_detail['vault_room_position']=='3'){$vault_room_position='3rd floor';}
           if($vsm_data_detail['vault_room_position']=='4'){$vault_room_position='4th floor';}
           if($vsm_data_detail['vault_room_position']=='5'){$vault_room_position='5th floor';}
           if($vsm_data_detail['vault_room_position']=='6'){$vault_room_position='Above 5th floor';}
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $vault_room_position; ?></td>
        </tr>
        
       	<tr>
        <td>1.5</td>
        <td>Structural position of the branch building</td>
        <?php
        $building_position='Not mentioned';
        if(isset($vsm_data_detail['building_position']))
        {
           if($vsm_data_detail['building_position']=='1'){$building_position='Pucca';}
           if($vsm_data_detail['building_position']=='2'){$building_position='Semi-pucca';}
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $building_position; ?></td>
        </tr>
        
       	<tr>
        <td>1.6</td>
        <td>Year of construction of the building</td>
        <?php
        $construction_year='Not mentioned';
        if(isset($vsm_data_detail['construction_year']) && $vsm_data_detail['construction_year'] !=''){$construction_year=$vsm_data_detail['construction_year'];}
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $construction_year; ?></td>
        </tr>
       	
        <tr>
        <td>1.7</td>
        <td>Age of  iron safe</td>
        <?php
        $iron_safe_age='Not mentioned';
        if(isset($vsm_data_detail['iron_safe_age']) && $vsm_data_detail['iron_safe_age'] !=''){$iron_safe_age=$vsm_data_detail['iron_safe_age'];}
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $iron_safe_age; ?></td>
        </tr>
        
        <tr>
        <td>1.8</td>
        <td>Present physical condition of iron safe</td>
        <?php
        $iron_safe_present_condition='Not mentioned';
        if(isset($vsm_data_detail['iron_safe_present_condition']))
        {
           if($vsm_data_detail['iron_safe_present_condition']=='1'){$iron_safe_present_condition='Bad';}
           if($vsm_data_detail['iron_safe_present_condition']=='2'){$iron_safe_present_condition='Medium';}
           if($vsm_data_detail['iron_safe_present_condition']=='3'){$iron_safe_present_condition='Good';}
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $iron_safe_present_condition; ?></td>
        </tr>
        
       	<tr>
        <td>1.9</td>
        <td>Approval of the building plan from proper authority</td>
        <?php
        $building_plan_approval_YN='';
        if(isset($vsm_data_detail['building_plan_approval_YN']))
        {
           if($vsm_data_detail['building_plan_approval_YN']==''){$building_plan_approval_YN='Not mentioned';}
           elseif($vsm_data_detail['building_plan_approval_YN']=='1'){$building_plan_approval_YN='Yes';}
           else{$building_plan_approval_YN='NO';} 
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $building_plan_approval_YN; ?></td>
        </tr>
        
        <tr>
        <td>1.10</td>
        <td>Surrounding of the branch</td>
        <?php
        $branch_surrounding='Not mentioned';
        if(isset($vsm_data_detail['branch_surrounding']))
        {
           if($vsm_data_detail['branch_surrounding']=='1'){$branch_surrounding='Market';}
           if($vsm_data_detail['branch_surrounding']=='2'){$branch_surrounding='Residence';}
           if($vsm_data_detail['branch_surrounding']=='3'){$branch_surrounding='Workshop';}
           if($vsm_data_detail['branch_surrounding']=='4'){$branch_surrounding='Hotel';}
           if($vsm_data_detail['branch_surrounding']=='5'){$branch_surrounding='Office';}
           if($vsm_data_detail['branch_surrounding']=='6'){$branch_surrounding='Others';}
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $branch_surrounding; ?></td>
        </tr>
        
       	<tr>
        <td>1.11</td>
        <td>Windows of the branch building situated above man height in case of ground floor</td>
        <?php
        $window_position_YN='';
        if(isset($vsm_data_detail['window_position_YN']))
        {
           if($vsm_data_detail['window_position_YN']==''){$window_position_YN='Not mentioned';}
           elseif($vsm_data_detail['window_position_YN']=='1'){$window_position_YN='Yes';}
           else{$window_position_YN='NO';} 
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $window_position_YN; ?></td>
        </tr>
        
       	<tr>
        <td>1.12</td>
        <td>Are there layers in windows for protective measure keeping adequate facility for light and wind flow?</td>
        <?php
        $window_layer_YN='';
        if(isset($vsm_data_detail['building_plan_approval_YN']))
        {
           if($vsm_data_detail['window_layer_YN']==''){$window_layer_YN='Not mentioned';}
           elseif($vsm_data_detail['window_layer_YN']=='1'){$window_layer_YN='Yes';}
           else{$building_plan_approval_YN='NO';} 
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $window_layer_YN; ?></td>
        </tr>
        
        <tr>
        <td>1.13</td>
        <td>Width of the road adjacent to branch building  could be mention in feet</td>
        <?php
        $distance_adjacent_road='Not mentioned';
        if(isset($vsm_data_detail['distance_adjacent_road']) && $vsm_data_detail['distance_adjacent_road'] !=''){$distance_adjacent_road=$vsm_data_detail['distance_adjacent_road'];}
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $distance_adjacent_road; ?></td>
        </tr>
        
       	<tr>
        <td>1.14</td>
        <td>Is there any high voltage transformer/electric substation / gridline etc adjacent to branch building?</td>
        <?php
        $high_voltage_object_YN='';
        if(isset($vsm_data_detail['high_voltage_object_YN']))
        {
           if($vsm_data_detail['high_voltage_object_YN']==''){$high_voltage_object_YN='Not mentioned';}
           elseif($vsm_data_detail['high_voltage_object_YN']=='1'){$high_voltage_object_YN='Yes';}
           else{$high_voltage_object_YN='NO';} 
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $high_voltage_object_YN; ?></td>
        </tr>
        
        <tr>
        <td>1.15</td>
        <td>Is there any other material in the vault  room like ledger, stationary etc. except locker?</td>
        <?php
        $other_materials='Not mentioned';
        if(isset($vsm_data_detail['other_materials']))
        {
           if($vsm_data_detail['other_materials']=='0'){$other_materials='No material except locker';}
           if($vsm_data_detail['other_materials']=='1'){$other_materials='Ledger';}
           if($vsm_data_detail['other_materials']=='2'){$other_materials='Stationary';}
           if($vsm_data_detail['other_materials']=='3'){$other_materials='Others';}
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $other_materials; ?></td>
        </tr>
		
		        <tr>
			<td>1.16</td>
			<td>Number of repairs of key, vault and chapdoor</td>
			<?php
				$repair_no='Not Mentioned';
				if(isset($vsm_data_detail['repair_no']) && $vsm_data_detail['repair_no'] !='')
				{
				   $repair_no=$vsm_data_detail['repair_no']; 
				}
				
			?>
            
			<td style="text-align: center;" colspan="2"><?php echo $repair_no; ?></td>
			</td>
		</tr>
        <tr>
			<td>1.17</td>
			<td>Area of branch premises(Square feet)</td>
			<?php
				$premises_area='Not Mentioned';
				if(isset($vsm_data_detail['premises_area']) && $vsm_data_detail['premises_area'] !='')
				{
				   $premises_area=$vsm_data_detail['premises_area']; 
				}
				
			?>
            
			<td style="text-align: center;" colspan="2"><?php echo $premises_area; ?></td>
			</td>
		</tr>
        <tr>
			<td>1.18</td>
			<td>Total rent of branch premises(if rented) per month</td>
			<?php
				$total_premises_rent='Not Mentioned';
				if(isset($vsm_data_detail['total_premises_rent']) && $vsm_data_detail['total_premises_rent'] !='')
				{
				   $total_premises_rent=$vsm_data_detail['total_premises_rent']; 
				}
				
			?>
            
			<td style="text-align: center;" colspan="2"><?php echo $total_premises_rent; ?></td>
			</td>
		</tr>
        
        <tr>
            <td>1.19</td>
            <td>Duration of last agreement of rent of branch premises</td>
            <td width="100" colspan="2">
            <?php
            $rent_agreement_dt_from='Not Mentioned';
            if(isset($vsm_data_detail['rent_agreement_dt_from']))
            {
               if($vsm_data_detail['rent_agreement_dt_from']=='' || $vsm_data_detail['rent_agreement_dt_from']=='1900-01-01 00:00:00')
               {
                $rent_agreement_dt_from='Not mentioned';
               }
               else
               {
                $rent_agreement_dt_from=date('d M, Y',strtotime($vsm_data_detail['rent_agreement_dt_from']));
               } 
            }
    		?>
            <?php
            $rent_agreement_dt_to='Not Mentioned';
            if(isset($vsm_data_detail['rent_agreement_dt_to']))
            {
               if($vsm_data_detail['rent_agreement_dt_to']=='' || $vsm_data_detail['rent_agreement_dt_to']=='1900-01-01 00:00:00')
               {
                $rent_agreement_dt_to='Not mentioned';
               }
               else
               {
                $rent_agreement_dt_to=date('d M, Y',strtotime($vsm_data_detail['rent_agreement_dt_to']));
               } 
            }
    		?>
            From : <?php echo $rent_agreement_dt_from; ?>
            
            &nbsp&nbsp&nbsp&nbsp To : <?php echo $rent_agreement_dt_to; ?>
            </td>
        </tr>
		
        <!-- Structural Security End -->
		
		<!-- Technological Security Start -->
    	<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Technological  Security</th></tr>
    	
        <tr>
        <td>2.1</td>
		<td>CCTV has been established in vault room which is active for 24 hours</td>
		<?php
        $CCTV_YN='';
        if(isset($vsm_data_detail['CCTV_YN']))
        {
           if($vsm_data_detail['CCTV_YN']==''){$CCTV_YN='Not mentioned';}
           elseif($vsm_data_detail['CCTV_YN']=='1'){$CCTV_YN='Yes';}
           else{$CCTV_YN='NO';} 
        }
		?>
		<td colspan="2" style="text-align: center;"><?php echo $CCTV_YN; ?></td>
		</tr>
        
    	<tr>
        <td>2.2</td>
		<td>Security alarm has been set in vault room which is active for 24 hours</td>
		<?php
        $security_alarm_YN='';
        if(isset($vsm_data_detail['security_alarm_YN']))
        {
           if($vsm_data_detail['security_alarm_YN']==''){$security_alarm_YN='Not mentioned';}
           elseif($vsm_data_detail['security_alarm_YN']=='1'){$security_alarm_YN='Yes';}
           else{$security_alarm_YN='NO';} 
        }
		?>
		<td colspan="2" style="text-align: center;"><?php echo $security_alarm_YN; ?></td>
		</tr>
        
    	<tr>
        <td>2.3</td>
		<td>Automated information system has been established with OC(Controlling Police Station), 3(three) Key holders of the Branch, Manager, Area Head, Divisional Head, DGM (Estate Department, GBD and MISD), Chief Security Officer(HO)</td>
		<?php
        $automated_IS_YN='';
        if(isset($vsm_data_detail['automated_IS_YN']))
        {
           if($vsm_data_detail['automated_IS_YN']==''){$automated_IS_YN='Not mentioned';}
           elseif($vsm_data_detail['automated_IS_YN']=='1'){$automated_IS_YN='Yes';}
           else{$automated_IS_YN='NO';} 
        }
		?>
		<td colspan="2" style="text-align: center;"><?php echo $automated_IS_YN; ?></td>
		</tr>
        
    	<tr>
        <td>2.4</td>
		<td>Automatic fire extinguisher has been set in vault room which is active for 24 hours</td>
		<?php
        $automatic_fireEX_YN='';
        if(isset($vsm_data_detail['automatic_fireEX_YN']))
        {
           if($vsm_data_detail['automatic_fireEX_YN']==''){$automatic_fireEX_YN='Not mentioned';}
           elseif($vsm_data_detail['automatic_fireEX_YN']=='1'){$automatic_fireEX_YN='Yes';}
           else{$automatic_fireEX_YN='NO';} 
        }
        
		?>
		<td colspan="2" style="text-align: center;"><?php echo $automatic_fireEX_YN; ?></td>
		</tr>
        
       	<tr>
        <td>2.5</td>
		<td>Last drill date of all the employee of the branch regarding fire fighting</td>
        <?php
        $last_drill_dt='';
        if(isset($vsm_data_detail['last_drill_dt']))
        {
           if($vsm_data_detail['last_drill_dt']=='' || $vsm_data_detail['last_drill_dt']=='1900-01-01 00:00:00')
           {
            $last_drill_dt='Not mentioned';
           }
           else
           {
            $last_drill_dt=date('d M, Y',strtotime($vsm_data_detail['last_drill_dt']));
           } 
        }
		?>
		<td colspan="2" style="text-align: center;"><?php echo $last_drill_dt; ?></td>
		</tr>
        
       	<tr>
        <td>2.6</td>
		<td>The expiry date of fire extinguishers</td>
        <?php
        $fireEx_expiry_dt='';
        if(isset($vsm_data_detail['fireEx_expiry_dt']))
        {
           if($vsm_data_detail['fireEx_expiry_dt']=='' || $vsm_data_detail['fireEx_expiry_dt']=='1900-01-01 00:00:00')
           {
            $fireEx_expiry_dt='Not mentioned';
           }
           else
           {
            $fireEx_expiry_dt=date('d M, Y',strtotime($vsm_data_detail['fireEx_expiry_dt']));
           } 
        }
		?>
		<td colspan="2" style="text-align: center;"><?php echo $fireEx_expiry_dt; ?></td>
		</tr>
        
       	<tr>
        <td>2.7</td>
		<td>CCTV has been established in adjacent ATM booth which is active for 24 hours</td>
		<?php
        $atm_cctv_YN='';
        if(isset($vsm_data_detail['atm_cctv_YN']))
        {
           if($vsm_data_detail['atm_cctv_YN']==''){$atm_cctv_YN='Not mentioned';}
           elseif($vsm_data_detail['atm_cctv_YN']=='1'){$atm_cctv_YN='Yes';}
           else{$atm_cctv_YN='NO';} 
        }
        
		?>
		<td colspan="2" style="text-align: center;"><?php echo $atm_cctv_YN; ?></td>
		</tr>
        
       	<tr>
        <td>2.8</td>
		<td>The security of ATM booth has been ensured</td>
		<?php
        $atm_security_YN='';
        if(isset($vsm_data_detail['atm_security_YN']))
        {
           if($vsm_data_detail['atm_security_YN']==''){$atm_security_YN='Not mentioned';}
           elseif($vsm_data_detail['atm_security_YN']=='1'){$atm_security_YN='Yes';}
           else{$atm_security_YN='NO';} 
        }
        
		?>
		<td colspan="2" style="text-align: center;"><?php echo $atm_security_YN; ?></td>
		</tr>
        
		<!-- Technological Security End -->
        
    	<!-- Bima Security Start -->
    	<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Bima Security</th></tr>
    	
        <tr>
			<td>3.1</td>
            <td>Insurance up to cash-in-safe limit(full amount of cash kept in vault) has been done as on </td>
            <?php
            $insurance_dt='';
            if(isset($vsm_data_detail['insurance_dt']))
            {
               if($vsm_data_detail['insurance_dt']=='' || $vsm_data_detail['insurance_dt']=='1900-01-01 00:00:00')
               {
                $insurance_dt='Not mentioned';
               }
               else
               {
                $insurance_dt=date('d M, Y',strtotime($vsm_data_detail['insurance_dt']));
               } 
            }
    		?>
            
			<td style="text-align: center;" colspan="2"><?php echo $insurance_dt; ?></td>
		</tr>
        
    	<tr>
			<td>3.2</td>
            <td>Expiry date of insurance policy is </td>
            <?php
            $insurance_exp_dt='';
            if(isset($vsm_data_detail['insurance_exp_dt']))
            {
               if($vsm_data_detail['insurance_exp_dt']=='' || $vsm_data_detail['insurance_exp_dt']=='1900-01-01 00:00:00')
               {
                $insurance_exp_dt='Not mentioned';
               }
               else
               {
                $insurance_exp_dt=date('d M, Y',strtotime($vsm_data_detail['insurance_exp_dt']));
               } 
            }
    		?>
            
			<td style="text-align: center;" colspan="2"><?php echo $insurance_exp_dt; ?></td>
		</tr>
    	<!-- Bima Security End -->
    	
		<!-- Cash Related Information Start -->
    	<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Cash Related Information </th></tr>
    	<!--
        <tr>
			<td>4.1</td>
			<td>Cash in hand at the end of transaction of the last day of the month</td>
			<?php
				$cash_in_hand='Not Mentioned';
				if(isset($vsm_data_detail['cash_in_hand']) && $vsm_data_detail['cash_in_hand'] !='')
				{
				   $cash_in_hand=$vsm_data_detail['cash_in_hand']; 
				}
				
			?>
            
			<td style="text-align: center;" colspan="2"><?php echo $cash_in_hand; ?></td>
			</td-->
        
    	<tr>
		<td>4.1</td>
		<td>Cash-in-Safe limit</td>
		<?php
				$cash_safe_limit='Not Mentioned';
				if(isset($vsm_data_detail['cash_safe_limit']) && $vsm_data_detail['cash_safe_limit'] !='')
				{
				   $cash_safe_limit=$vsm_data_detail['cash_safe_limit']; 
				}
				
			?>
		<td style="text-align: center;" colspan="2"><?php echo $cash_safe_limit; ?></td>
		</tr>
        
		<tr>
		<td>4.2</td>
		<td>Cash-in-Counter limit</td>
		<?php
				$cash_counter_limit='Not Mentioned';
				if(isset($vsm_data_detail['cash_counter_limit']) && $vsm_data_detail['cash_counter_limit'] !='')
				{
				   $cash_counter_limit=$vsm_data_detail['cash_counter_limit']; 
				}
				
			?>
		<td style="text-align: center;" colspan="2"><?php echo $cash_counter_limit; ?></td>
		</tr>
        
		<tr>
		<td>4.3</td>
		<td>Cash-in-Transit limit</td>
		<?php
				$cash_transit_limit='Not Mentioned';
				if(isset($vsm_data_detail['cash_transit_limit']) && $vsm_data_detail['cash_transit_limit'] !='')
				{
				   $cash_transit_limit=$vsm_data_detail['cash_transit_limit']; 
				}
				
			?>
		<td style="text-align: center;" colspan="2"><?php echo $cash_transit_limit; ?></td>
		</tr>
        
    	<tr>
		<td>4.4</td>
		<td>Name and designation of approval authority of the cash-in safe limit</td>
        <?php
				$approval_authority_name='Not Mentioned';
				if(isset($vsm_data_detail['approval_authority_name']) && $vsm_data_detail['approval_authority_name'] !='')
				{
				   $approval_authority_name=$vsm_data_detail['approval_authority_name']; 
				}
				
		?>
        <?php
				$approval_authority_dsg_full='Not Mentioned';
				if(isset($vsm_data_detail['approval_authority_dsg_full']) && $vsm_data_detail['approval_authority_dsg_full'] !='')
				{
				   $approval_authority_dsg_full=$vsm_data_detail['approval_authority_dsg_full']; 
				}
				
		?>
        <td style="text-align: left;" colspan="2"><?php echo $approval_authority_name.', '.$approval_authority_dsg_full; ?></td>
        </tr>
        
    	<tr>
		<td>4.5</td>
		<td>Number of mutilated note in hand</td>
		<?php
                //1 tk note
                $mutilated_note_1_number=0;
                $mutilated_note_1_amount=0;
				if(isset($vsm_data_detail['mutilated_note_1']) && $vsm_data_detail['mutilated_note_1'] !='')
				{
				   $mutilated_note_1_number=$vsm_data_detail['mutilated_note_1'];
                   $mutilated_note_1_amount=$mutilated_note_1_number*1; 
				}
                
                //2 tk note
                $mutilated_note_2_number=0;
                $mutilated_note_2_amount=0;
				if(isset($vsm_data_detail['mutilated_note_2']) && $vsm_data_detail['mutilated_note_2'] !='')
				{
				   $mutilated_note_2_number=$vsm_data_detail['mutilated_note_2'];
                   $mutilated_note_2_amount=$mutilated_note_2_number*2; 
				}
                //5 tk note
                $mutilated_note_5_number=0;
                $mutilated_note_5_amount=0;
				if(isset($vsm_data_detail['mutilated_note_5']) && $vsm_data_detail['mutilated_note_5'] !='')
				{
				   $mutilated_note_5_number=$vsm_data_detail['mutilated_note_5'];
                   $mutilated_note_5_amount=$mutilated_note_5_number*5; 
				}
                //10 tk note
                $mutilated_note_10_number=0;
                $mutilated_note_10_amount=0;
				if(isset($vsm_data_detail['mutilated_note_10']) && $vsm_data_detail['mutilated_note_10'] !='')
				{
				   $mutilated_note_10_number=$vsm_data_detail['mutilated_note_10'];
                   $mutilated_note_10_amount=$mutilated_note_10_number*10; 
				}
                //20 tk note
                $mutilated_note_20_number=0;
                $mutilated_note_20_amount=0;
				if(isset($vsm_data_detail['mutilated_note_20']) && $vsm_data_detail['mutilated_note_20'] !='')
				{
				   $mutilated_note_20_number=$vsm_data_detail['mutilated_note_20'];
                   $mutilated_note_20_amount=$mutilated_note_20_number*20; 
				}
                //50 tk note
                $mutilated_note_50_number=0;
                $mutilated_note_50_amount=0;
				if(isset($vsm_data_detail['mutilated_note_50']) && $vsm_data_detail['mutilated_note_50'] !='')
				{
				   $mutilated_note_50_number=$vsm_data_detail['mutilated_note_50'];
                   $mutilated_note_50_amount=$mutilated_note_50_number*50; 
				}
                //100 tk note
                $mutilated_note_100_number=0;
                $mutilated_note_100_amount=0;
				if(isset($vsm_data_detail['mutilated_note_100']) && $vsm_data_detail['mutilated_note_100'] !='')
				{
				   $mutilated_note_100_number=$vsm_data_detail['mutilated_note_100'];
                   $mutilated_note_100_amount=$mutilated_note_100_number*100; 
				}
                //500 tk note
                $mutilated_note_500_number=0;
                $mutilated_note_500_amount=0;
				if(isset($vsm_data_detail['mutilated_note_500']) && $vsm_data_detail['mutilated_note_500'] !='')
				{
				   $mutilated_note_500_number=$vsm_data_detail['mutilated_note_500'];
                   $mutilated_note_500_amount=$mutilated_note_500_number*500; 
				}
                
                //1000 tk note
                $mutilated_note_1000_number=0;
                $mutilated_note_1000_amount=0;
				if(isset($vsm_data_detail['mutilated_note_1000']) && $vsm_data_detail['mutilated_note_1000'] !='')
				{
				   $mutilated_note_1000_number=$vsm_data_detail['mutilated_note_1000'];
                   $mutilated_note_1000_amount=$mutilated_note_1000_number*1000; 
				}
                
                $total_number=$mutilated_note_1_number+$mutilated_note_2_number+$mutilated_note_5_number+$mutilated_note_10_number+$mutilated_note_20_number+$mutilated_note_50_number+$mutilated_note_100_number+$mutilated_note_500_number+$mutilated_note_1000_number;
                $total_amount=$mutilated_note_1_amount+$mutilated_note_2_amount+$mutilated_note_5_amount+$mutilated_note_10_amount+$mutilated_note_20_amount+$mutilated_note_50_amount+$mutilated_note_100_amount+$mutilated_note_500_amount+$mutilated_note_1000_amount;
				
		?>
        <td colspan="2" align="center">
        <table border="1">
        <tr align="center"><td>Note</td><td>Number</td><td>Amount</td></tr>
        <tr><td align="center">1</td><td align="right"><?php echo $mutilated_note_1_number; ?></td><td align="right"><?php echo $mutilated_note_1_amount; ?></td></tr>
        <tr><td align="center">2</td><td align="right"><?php echo $mutilated_note_2_number; ?></td><td align="right"><?php echo $mutilated_note_2_amount; ?></td></tr>
        <tr><td align="center">5</td><td align="right"><?php echo $mutilated_note_5_number; ?></td><td align="right"><?php echo $mutilated_note_5_amount; ?></td></tr>
        <tr><td align="center">10</td><td align="right"><?php echo $mutilated_note_10_number; ?></td><td align="right"><?php echo $mutilated_note_10_amount; ?></td></tr>
        <tr><td align="center">20</td><td align="right"><?php echo $mutilated_note_20_number; ?></td><td align="right"><?php echo $mutilated_note_20_amount; ?></td></tr>
        <tr><td align="center">50</td><td align="right"><?php echo $mutilated_note_50_number; ?></td><td align="right"><?php echo $mutilated_note_50_amount; ?></td></tr>
        <tr><td align="center">100</td><td align="right"><?php echo $mutilated_note_100_number; ?></td><td align="right"><?php echo $mutilated_note_100_amount; ?></td></tr>
        <tr><td align="center">500</td><td align="right"><?php echo $mutilated_note_500_number; ?></td><td align="right"><?php echo $mutilated_note_500_amount; ?></td></tr>
        <tr><td align="center">1000</td><td align="right"><?php echo $mutilated_note_1000_number; ?></td><td align="right"><?php echo $mutilated_note_1000_amount; ?></td></tr>
        <tr><td align="center">Total</td><td align="right"><?php echo $total_number; ?></td><td align="right"><?php echo $total_amount; ?></td></tr>
        </table>
        </td>
		</tr>
        
        <tr>
        <td>4.6</td>
        <td>Cash of the branch is carried in</td>
        <?php
        $cash_carried='Not mentioned';
        if(isset($vsm_data_detail['cash_carried']))
        {
           if($vsm_data_detail['cash_carried']=='1'){$cash_carried='Still Box';}
           if($vsm_data_detail['cash_carried']=='2'){$cash_carried='Gunny Bag';}
           if($vsm_data_detail['cash_carried']=='3'){$cash_carried='Open Hand';}
           if($vsm_data_detail['cash_carried']=='4'){$cash_carried='Others';}
        }
        ?>
		<td colspan="2" style="text-align: center;"><?php echo $cash_carried; ?></td>
        </tr>
        
       	<tr>
        <td>4.7</td>
		<td>Is there cash outside iron safe?</td>
		<?php
        $cash_outside_YN='';
        if(isset($vsm_data_detail['cash_outside_YN']))
        {
           if($vsm_data_detail['cash_outside_YN']==''){$cash_outside_YN='Not mentioned';}
           elseif($vsm_data_detail['cash_outside_YN']=='1'){$cash_outside_YN='Yes';}
           else{$cash_outside_YN='NO';} 
        }
        
		?>
		<td colspan="2" style="text-align: center;"><?php echo $cash_outside_YN; ?></td>
		</tr>
        
    	<!-- Cash Related Information End -->
        
    	<!--Vault Audit Information Start-->
		<tr><th colspan="4"  style="font-weight: bold;text-align: center; font-size:18px">Vault Audit Information </th></tr>
    	<tr>
		<td colspan="4">Total security system of the branch including cash and vault security system has been checked up as on and ensured by</td>
		</tr>
        
    	<tr>
		<td>5.1</td>
		<td>By respective Area office</td>
        <?php
        $VS_checked_AO_date='';
        if(isset($vsm_data_detail['VS_checked_AO_date']))
        {
           if($vsm_data_detail['VS_checked_AO_date']=='' || $vsm_data_detail['VS_checked_AO_date']=='1900-01-01 00:00:00')
           {
            $VS_checked_AO_date='Not mentioned';
           }
           else
           {
            $VS_checked_AO_date=date('d M, Y',strtotime($vsm_data_detail['VS_checked_AO_date']));
           } 
        }
		?>
        <td align="center"><?php echo $VS_checked_AO_date; ?></td>
		<?php
			$VS_checked_AO_name='Not Mentioned';
			if(isset($vsm_data_detail['VS_checked_AO_name']) && $vsm_data_detail['VS_checked_AO_name'] !='')
			{
			   $VS_checked_AO_name=$vsm_data_detail['VS_checked_AO_name']; 
			}
			
		?>
        <?php
				$VS_checked_AO_dsg='Not Mentioned';
				if(isset($vsm_data_detail['VS_checked_AO_dsg_full']) && $vsm_data_detail['VS_checked_AO_dsg_full'] !='')
				{
				   $VS_checked_AO_dsg=$vsm_data_detail['VS_checked_AO_dsg_full']; 
				}
				
		?>
		<td style="text-align: left;"><?php echo $VS_checked_AO_name.','.$VS_checked_AO_dsg; ?></td>
		</tr>
        
    	<tr>
		<td>5.2</td>
		<td>By respective Divisional office</td>
        <?php
        $VS_checked_DO_date='';
        if(isset($vsm_data_detail['VS_checked_DO_date']))
        {
           if($vsm_data_detail['VS_checked_DO_date']=='' || $vsm_data_detail['VS_checked_DO_date']=='1900-01-01 00:00:00')
           {
            $VS_checked_DO_date='Not mentioned';
           }
           else
           {
            $VS_checked_DO_date=date('d M, Y',strtotime($vsm_data_detail['VS_checked_DO_date']));
           } 
        }
		?>
        <td align="center"><?php echo $VS_checked_DO_date; ?></td>
		<?php
			$VS_checked_DO_name='Not Mentioned';
			if(isset($vsm_data_detail['VS_checked_DO_name']) && $vsm_data_detail['VS_checked_DO_name'] !='')
			{
			   $VS_checked_DO_name=$vsm_data_detail['VS_checked_DO_name']; 
			}
			
		?>
        <?php
				$VS_checked_DO_dsg='Not Mentioned';
				if(isset($vsm_data_detail['VS_checked_DO_dsg_full']) && $vsm_data_detail['VS_checked_DO_dsg_full'] !='')
				{
				   $VS_checked_DO_dsg=$vsm_data_detail['VS_checked_DO_dsg_full']; 
				}
				
		?>
		<td style="text-align: left;"><?php echo $VS_checked_DO_name.','.$VS_checked_DO_dsg; ?></td>
		</tr>
    	<tr>
		<td>5.3</td>
		<td>By respective department of Head office</td>
        <?php
        $VS_checked_HO_date='';
        if(isset($vsm_data_detail['VS_checked_HO_date']))
        {
           if($vsm_data_detail['VS_checked_HO_date']=='' || $vsm_data_detail['VS_checked_HO_date']=='1900-01-01 00:00:00')
           {
            $VS_checked_HO_date='Not mentioned';
           }
           else
           {
            $VS_checked_HO_date=date('d M, Y',strtotime($vsm_data_detail['VS_checked_HO_date']));
           } 
        }
		?>
        <td align="center"><?php echo $VS_checked_HO_date; ?></td>
		<?php
			$VS_checked_HO_name='Not Mentioned';
			if(isset($vsm_data_detail['VS_checked_HO_name']) && $vsm_data_detail['VS_checked_HO_name'] !='')
			{
			   $VS_checked_HO_name=$vsm_data_detail['VS_checked_HO_name']; 
			}
			
		?>
        <?php
				$VS_checked_HO_dsg='Not Mentioned';
				if(isset($vsm_data_detail['VS_checked_HO_dsg_full']) && $vsm_data_detail['VS_checked_HO_dsg_full'] !='')
				{
				   $VS_checked_HO_dsg=$vsm_data_detail['VS_checked_HO_dsg_full']; 
				}
				
		?>
        
		<td style="text-align: left;"><?php echo $VS_checked_HO_name.','.$VS_checked_HO_dsg; ?></td>
		</tr>
    	<tr>
		<td>5.4</td>
        <td>By Bangladesh Bank</td>
        <?php
        $VS_checked_BB_date='';
        if(isset($vsm_data_detail['VS_checked_BB_date']))
        {
           if($vsm_data_detail['VS_checked_BB_date']=='' || $vsm_data_detail['VS_checked_BB_date']=='1900-01-01 00:00:00')
           {
            $VS_checked_BB_date='Not mentioned';
           }
           else
           {
            $VS_checked_BB_date=date('d M, Y',strtotime($vsm_data_detail['VS_checked_BB_date']));
           } 
        }
		?>
        <td align="center"><?php echo $VS_checked_BB_date; ?></td>
		<?php
			$VS_checked_BB_name='Not Mentioned';
			if(isset($vsm_data_detail['VS_checked_BB_name']) && $vsm_data_detail['VS_checked_BB_name'] !='')
			{
			   $VS_checked_BB_name=$vsm_data_detail['VS_checked_BB_name']; 
			}
			
		?>
        <?php
				$VS_checked_BB_dsg='Not Mentioned';
				if(isset($vsm_data_detail['VS_checked_BB_dsg_full']) && $vsm_data_detail['VS_checked_BB_dsg_full'] !='')
				{
				   $VS_checked_BB_dsg=$vsm_data_detail['VS_checked_BB_dsg_full']; 
				}
				
		?>
		<td style="text-align: left;"><?php echo $VS_checked_BB_name.','.$VS_checked_BB_dsg; ?></td>
		</tr>
    	<tr>
		<td>5.5</td>
        <td>By Commercial Audit/Other office</td>
        <?php
        $VS_checked_CO_date='';
        if(isset($vsm_data_detail['VS_checked_CO_date']))
        {
           if($vsm_data_detail['VS_checked_CO_date']=='' || $vsm_data_detail['VS_checked_CO_date']=='1900-01-01 00:00:00')
           {
            $VS_checked_CO_date='Not mentioned';
           }
           else
           {
            $VS_checked_CO_date=date('d M, Y',strtotime($vsm_data_detail['VS_checked_CO_date']));
           } 
        }
		?>
        <td align="center" width="100px"><?php echo $VS_checked_CO_date; ?></td>
		<?php
			$VS_checked_CO_name='Not Mentioned';
			if(isset($vsm_data_detail['VS_checked_CO_name']) && $vsm_data_detail['VS_checked_CO_name'] !='')
			{
			   $VS_checked_CO_name=$vsm_data_detail['VS_checked_CO_name']; 
			}
			
		?>
        <?php
				$VS_checked_CO_dsg='Not Mentioned';
				if(isset($vsm_data_detail['VS_checked_CO_dsg_full']) && $vsm_data_detail['VS_checked_CO_dsg_full'] !='')
				{
				   $VS_checked_CO_dsg=$vsm_data_detail['VS_checked_CO_dsg_full']; 
				}
				
		?>
		<td style="text-align: left;" width="200px"><?php echo $VS_checked_CO_name.','.$VS_checked_CO_dsg; ?></td>
		</tr>
    	<!--Vault Audit Information End-->
		
		</table>
	
	<!--approval msg start-->
	<?php
	       //Head of branch checking
            $approved_head_of_branch_name='Not Mentioned';
			if(isset($vsm_data_detail['approved_head_of_branch_name']) && $vsm_data_detail['approved_head_of_branch_name'] !='')
			{
			   $approved_head_of_branch_name=$vsm_data_detail['approved_head_of_branch_name']; 
			}
			$approved_head_of_branch_dsg='Not Mentioned';
			if(isset($vsm_data_detail['approved_head_of_branch_dsg_full']) && $vsm_data_detail['approved_head_of_branch_dsg_full'] !='')
			{
			   $approved_head_of_branch_dsg=$vsm_data_detail['approved_head_of_branch_dsg_full']; 
			}
            
            //Manager checking
            $approved_manager_name='Not Mentioned';
			if(isset($vsm_data_detail['approved_manager_name']) && $vsm_data_detail['approved_manager_name'] !='')
			{
			   $approved_manager_name=$vsm_data_detail['approved_manager_name']; 
			}
			$approved_manager_dsg='Not Mentioned';
			if(isset($vsm_data_detail['approved_manager_dsg_full']) && $vsm_data_detail['approved_manager_dsg_full'] !='')
			{
			   $approved_manager_dsg=$vsm_data_detail['approved_manager_dsg_full']; 
			}
            
			//Asst manager checking
            $approved_asst_manager_name='Not Mentioned';
			if(isset($vsm_data_detail['approved_asst_manager_name']) && $vsm_data_detail['approved_asst_manager_name'] !='')
			{
			   $approved_asst_manager_name=$vsm_data_detail['approved_asst_manager_name']; 
			}
			$approved_asst_manager_dsg='Not Mentioned';
			if(isset($vsm_data_detail['approved_asst_manager_dsg_full']) && $vsm_data_detail['approved_asst_manager_dsg_full'] !='')
			{
			   $approved_asst_manager_dsg=$vsm_data_detail['approved_asst_manager_dsg_full']; 
			}
            
			//Cashier checking
            $approved_cashier_name='Not Mentioned';
			if(isset($vsm_data_detail['approved_cashier_name']) && $vsm_data_detail['approved_cashier_name'] !='')
			{
			   $approved_cashier_name=$vsm_data_detail['approved_cashier_name']; 
			}
			$approved_cashier_dsg='Not Mentioned';
			if(isset($vsm_data_detail['approved_cashier_dsg_full']) && $vsm_data_detail['approved_cashier_dsg_full'] !='')
			{
			   $approved_cashier_dsg=$vsm_data_detail['approved_cashier_dsg_full']; 
			}
			
	?>
	<br/>
	<table border="0" align="center" width="800">
	<tr>
		<td  colspan="4">The above information is checked and approved by us.</td>
	</tr>
	<tr align="center" height="40px">
		<td  width="200px"></td>
		<td  width="200px"></td>
		<td  width="200px"></td>
		<td  width="200px"></td>
	</tr>
	<tr align="center">
		<td><?php echo $approved_cashier_name.', '.$approved_cashier_dsg; ?></td>
        <td><?php echo $approved_asst_manager_name.', '.$approved_asst_manager_dsg; ?></td>
		<td><?php echo $approved_manager_name.', '.$approved_manager_dsg; ?></td>
        <td><?php echo $approved_head_of_branch_name.', '.$approved_head_of_branch_dsg; ?></td>
	</tr>
	<tr align="center">
        <td>Cashier</td>
		<td>Assistant Manager</td>
        <td>Manager</td>
		<td>Head of branch</td>
	</tr>
    
	</table>
	<!--approval msg end-->	
	<br/>
        

    <?php
    echo form_open('vsm/vsm_report_details/1');
    if(isset($previous_value) && !empty($previous_value))
    {
        foreach($previous_value as $key=>$val)
        {
            ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
            <?php
        }
    }
        
    echo "<br/><table><tr>";
    $attribute='style="background-color: #FF9900;"';
	echo "<td align='center' COLSPAN='4'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
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

<p>&nbsp;</p>
</body>
</html>
