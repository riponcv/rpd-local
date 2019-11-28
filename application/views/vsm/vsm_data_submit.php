
   	<?php 
    
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
				
	if(isset($login_office_status) && $login_office_status ==4)
    {
     echo form_open('vsm/vsm_data_submit','id="id_vsm_data_submit_form"');   
    }
    else
    {
        echo form_open('');
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>VSM DATA FORM</th></tr></table>";

    if(validation_errors())
    {
       	echo "<div id='error'>".validation_errors()."</div>";     
    }    

    
    if(isset($login_office_status) && $login_office_status !=4)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to Submit VSM Data.</td></tr></table>';
        echo "<br/>";   
    }
    
    echo '<div id="form_fill_warning_div" style="display:none">';
    echo '<font style="background-color:yellow;font-weight: bold;color: red;"><span id="form_fill_warning_span"></span></font>'; 
	echo "</div>";
    
    echo "<br/>";

	
    echo '<table border="1">';
    $last_sub_dt='No data submitted yet';
    $IU='I';
    if(isset($rec['vsm_data_sb_dt']) && $rec['vsm_data_sb_dt'] !='')
    {
        $last_sub_dt=date("d-M-Y", strtotime($rec['vsm_data_sb_dt']));
        $IU='U';
    }
    echo '<tr style="font-weight: bold;">';
    echo '<td>Last Submission Date : '.$last_sub_dt.'</td>';
    echo '</tr>'; 
	echo '</table><br/>';
    
    ?>
    
    <input type="hidden" name="IU" value="<?php echo $IU; ?>"/>
    <table border="2" width="700" align="center">
    
    <!-- Structural Security Start -->
    	<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Structural Security</th></tr>
    	
        <tr>
            <td>1.1</td>
            <td>Steel frame has been given around vault space</td><td width="100">Yes<input type="radio" name="steel_frame_YN" value="1" id="steel_frame_YN" <?php if(isset($rec['steel_frame_YN']) && $rec['steel_frame_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="steel_frame_YN" value="0" id="steel_frame_YN" <?php if(isset($rec['steel_frame_YN']) && $rec['steel_frame_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
    	<tr>
            <td>1.2</td>
            <td>Security tested door has been established</td><td width="100">Yes<input type="radio" name="security_door_YN" value="1" id="security_door_YN" <?php if(isset($rec['security_door_YN']) && $rec['security_door_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="security_door_YN" value="0" id="security_door_YN" <?php if(isset($rec['security_door_YN']) && $rec['security_door_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
    	<tr>
            <td>1.3</td>
            <td>Floor, roof and surrounding wall of vault room constructed as per instruction circular No. 44, Date: 01.03.2009 which was ensured by certificate of Govt./Bank civil engineer</td><td width="100">Yes<input type="radio" name="security_FRW_YN" value="1" id="security_FRW_YN" <?php if(isset($rec['security_FRW_YN']) && $rec['security_FRW_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="security_FRW_YN" value="0" id="security_FRW_YN" <?php if(isset($rec['security_FRW_YN']) && $rec['security_FRW_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
        <tr>
            <td>1.4</td>
            <td>Floor of branch in the building (In case of more than one floor, select starting point)</td>
            <td width="100" colspan="2">
            <select name="vault_room_position" id="vault_room_position">
            <option value="">Select Position</option>
            <option value="0" <?php if(isset($rec['vault_room_position']) && $rec['vault_room_position']=='0'){echo "selected='selected'";} ?>>Ground floor</option>
            <option value="1" <?php if(isset($rec['vault_room_position']) && $rec['vault_room_position']=='1'){echo "selected='selected'";} ?>>1st floor</option>
            <option value="2" <?php if(isset($rec['vault_room_position']) && $rec['vault_room_position']=='2'){echo "selected='selected'";} ?>>2nd floor</option>
            <option value="3" <?php if(isset($rec['vault_room_position']) && $rec['vault_room_position']=='3'){echo "selected='selected'";} ?>>3rd floor</option>
            <option value="4" <?php if(isset($rec['vault_room_position']) && $rec['vault_room_position']=='4'){echo "selected='selected'";} ?>>4th floor</option>
            <option value="5" <?php if(isset($rec['vault_room_position']) && $rec['vault_room_position']=='5'){echo "selected='selected'";} ?>>5th floor</option>
            <option value="6" <?php if(isset($rec['vault_room_position']) && $rec['vault_room_position']=='6'){echo "selected='selected'";} ?>>Above 5th floor</option>
            </select>
            </td>
        </tr>
        
        <tr>
            <td>1.5</td>
            <td>Structural position of the branch building (pucca/semi-pucca)</td>
            <td width="100" colspan="2">
            <select name="building_position" id="building_position">
            <option value="">Select Position</option>
            <option value="1" <?php if(isset($rec['building_position']) && $rec['building_position']=='1'){echo "selected='selected'";} ?>>Pucca</option>
            <option value="2" <?php if(isset($rec['building_position']) && $rec['building_position']=='2'){echo "selected='selected'";} ?>>Semi-pucca</option>
            </select>
            </td>
        </tr>
        
        <tr>
            <td>1.6</td>
            <td>Year of construction of the building</td>
            <td width="100" colspan="2">
            <select name="construction_year" id="construction_year">
            <?php $years_arr = range(date('Y'), 1800); ?>
            <option value="">Select year of construction</option>
            <?php
            if(isset($years_arr) && count($years_arr)>0)
            {
                foreach($years_arr as $key=>$row)
                {
                    ?><option value="<?php echo $row; ?>" <?php if(isset($rec['construction_year']) && $rec['construction_year']==$row){echo "selected='selected'";} ?>><?php echo $row; ?></option><?php
                }
            }
            ?>
            </select>
            </td>
        </tr>
        
        <tr>
            <td>1.7</td>
            <td>Age of  iron safe</td>
            <td width="100" colspan="2">
            <select name="iron_safe_age" id="iron_safe_age">
            <option value="">Select iron safe age</option>
            <?php
            for($i=0;$i<=100;$i++)
            {
                ?><option value="<?php echo $i; ?>" <?php if(isset($rec['iron_safe_age']) && $rec['iron_safe_age']==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option><?php
            }
            ?>
            </select>
            </td>
        </tr>
        
        <tr>
            <td>1.8</td>
            <td>Present physical condition of iron safe</td>
            <td width="100" colspan="2">
            <select name="iron_safe_present_condition" id="iron_safe_present_condition">
            <option value="">Select present condition</option>
            <option value="1" <?php if(isset($rec['iron_safe_present_condition']) && $rec['iron_safe_present_condition']=='1'){echo "selected='selected'";} ?>>Bad</option>
            <option value="2" <?php if(isset($rec['iron_safe_present_condition']) && $rec['iron_safe_present_condition']=='2'){echo "selected='selected'";} ?>>Medium</option>
            <option value="3" <?php if(isset($rec['iron_safe_present_condition']) && $rec['iron_safe_present_condition']=='3'){echo "selected='selected'";} ?>>Good</option>
            </select>
            </td>
        </tr>
        
        <tr>
            <td>1.9</td>
            <td>Approval of the building plan from proper authority</td><td width="100">Yes<input type="radio" name="building_plan_approval_YN" value="1" id="building_plan_approval_YN" <?php if(isset($rec['building_plan_approval_YN']) && $rec['building_plan_approval_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="building_plan_approval_YN" value="0" id="building_plan_approval_YN" <?php if(isset($rec['building_plan_approval_YN']) && $rec['building_plan_approval_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
        <tr>
            <td>1.10</td>
            <td>Surrounding of the branch</td>
            <td width="100" colspan="2">
            <select name="branch_surrounding" id="branch_surrounding">
            <option value="">Select branch surrounding</option>
            <option value="1" <?php if(isset($rec['branch_surrounding']) && $rec['branch_surrounding']=='1'){echo "selected='selected'";} ?>>Market</option>
            <option value="2" <?php if(isset($rec['branch_surrounding']) && $rec['branch_surrounding']=='2'){echo "selected='selected'";} ?>>Residence</option>
            <option value="3" <?php if(isset($rec['branch_surrounding']) && $rec['branch_surrounding']=='3'){echo "selected='selected'";} ?>>Workshop</option>
            <option value="4" <?php if(isset($rec['branch_surrounding']) && $rec['branch_surrounding']=='4'){echo "selected='selected'";} ?>>Hotel</option>
            <option value="5" <?php if(isset($rec['branch_surrounding']) && $rec['branch_surrounding']=='5'){echo "selected='selected'";} ?>>Office</option>
            <option value="6" <?php if(isset($rec['branch_surrounding']) && $rec['branch_surrounding']=='6'){echo "selected='selected'";} ?>>Others</option>
            </select>
            </td>
        </tr>
        
        <tr>
            <td>1.11</td>
            <td>Windows of the branch building situated above man height in case of ground floor</td><td width="100">Yes<input type="radio" name="window_position_YN" value="1" id="window_position_YN" <?php if(isset($rec['window_position_YN']) && $rec['window_position_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="window_position_YN" value="0" id="window_position_YN" <?php if(isset($rec['window_position_YN']) && $rec['window_position_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
        <tr>
            <td>1.12</td>
            <td>Are there layers in windows for protective measure keeping adequate facility for light and wind flow?</td><td width="100">Yes<input type="radio" name="window_layer_YN" value="1" id="window_layer_YN" <?php if(isset($rec['window_layer_YN']) && $rec['window_layer_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="window_layer_YN" value="0" id="window_layer_YN" <?php if(isset($rec['window_layer_YN']) && $rec['window_layer_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
        <tr>
            <td>1.13</td>
            <td>Width of the road adjacent to branch building  could be mention in feet</td><td width="100" colspan="2"><input type="text" name="distance_adjacent_road" id="distance_adjacent_road" value="<?php echo isset($rec['distance_adjacent_road'])?$rec['distance_adjacent_road']:''; ?>"></td>
        </tr>
        
        <tr>
            <td>1.14</td>
            <td>Is there any high voltage transformer/electric substation / gridline etc adjacent to branch building?</td><td width="100">Yes<input type="radio" name="high_voltage_object_YN" value="1" id="high_voltage_object_YN" <?php if(isset($rec['high_voltage_object_YN']) && $rec['high_voltage_object_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="high_voltage_object_YN" value="0" id="high_voltage_object_YN" <?php if(isset($rec['high_voltage_object_YN']) && $rec['high_voltage_object_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
        <tr>
            <td>1.15</td>
            <td>Is there any other material in the vault  room like ledger, stationary etc. except locker?</td>
            <td width="100" colspan="2">
            <select name="other_materials" id="other_materials">
            <option value="">Select other materials</option>
            <option value="0" <?php if(isset($rec['other_materials']) && $rec['other_materials']=='0'){echo "selected='selected'";} ?>>No material except locker</option>
            <option value="1" <?php if(isset($rec['other_materials']) && $rec['other_materials']=='1'){echo "selected='selected'";} ?>>Ledger</option>
            <option value="2" <?php if(isset($rec['other_materials']) && $rec['other_materials']=='2'){echo "selected='selected'";} ?>>Stationary</option>
            <option value="3" <?php if(isset($rec['other_materials']) && $rec['other_materials']=='3'){echo "selected='selected'";} ?>>Others</option>
            </select>
            </td>
        </tr>
		
		        
       	<tr>
            <td>1.16</td>
            <td>Number of repairs of key, vault and chapdoor</td><td width="100"><input type="text" placeholder="Number of repairs" name="repair_no" id="repair_no" value="<?php if(isset($rec['repair_no']) && $rec['repair_no']!=''){ echo $rec['repair_no']; } ?>"></td>
        </tr>
       	<tr>
            <td>1.17</td>
            <td>Area of branch premises(Square feet)</td><td width="100"><input type="text" placeholder="Area of branch" name="premises_area" id="premises_area" value="<?php if(isset($rec['premises_area']) && $rec['premises_area']!=''){ echo $rec['premises_area']; } ?>"></td>
        </tr>
       	<tr>
            <td>1.18</td>
            <td>Total rent of branch premises(if rented) per month</td><td width="100"><input type="text" placeholder="Total amount of rent" name="total_premises_rent" id="total_premises_rent" value="<?php if(isset($rec['total_premises_rent']) && $rec['total_premises_rent']!=''){ echo $rec['total_premises_rent']; } ?>"></td>
        </tr>
        <tr>
            <td>1.19</td>
            <td>Duration of last agreement of rent of branch premises</td>
            <td width="100" colspan="2">
            From : <input type="text" name="rent_agreement_dt_from" Placeholder="Agreement from" id="datepicker9" readonly="readonly" value="<?php if(isset($rec['rent_agreement_dt_from']) && $rec['rent_agreement_dt_from']!='' && $rec['rent_agreement_dt_from']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['rent_agreement_dt_from'])); } ?>">
            
            To : <input type="text" name="rent_agreement_dt_to" Placeholder="Agreement to" id="datepicker10" readonly="readonly" value="<?php if(isset($rec['rent_agreement_dt_to']) && $rec['rent_agreement_dt_to']!='' && $rec['rent_agreement_dt_to']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['rent_agreement_dt_to'])); } ?>">
            </td>
        </tr>
        
     <!-- Structural Security End -->
    
    
    <!-- Technological Security End -->
   	    <tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Technological  Security</th></tr>
    	
        <tr>
            <td>2.1</td>
            <td>CCTV has been established in vault room which is active for 24 hours</td><td width="100">Yes<input type="radio" name="CCTV_YN" value="1" id="CCTV_YN" <?php if(isset($rec['CCTV_YN']) && $rec['CCTV_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="CCTV_YN" value="0" id="CCTV_YN" <?php if(isset($rec['CCTV_YN']) && $rec['CCTV_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
    	
        <tr>
            <td>2.2</td>
            <td>Security alarm has been set in vault room which is active for 24 hours</td><td width="100">Yes<input type="radio" name="security_alarm_YN" value="1" id="security_alarm_YN" <?php if(isset($rec['security_alarm_YN']) && $rec['security_alarm_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="security_alarm_YN" value="0" id="security_alarm_YN" <?php if(isset($rec['security_alarm_YN']) && $rec['security_alarm_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
    	
        <tr>
            <td>2.3</td>
            <td>Automated information system has been established with OC(Controlling Police Station), 3(three) Key holders of the Branch, Manager, Area Head, Divisional Head, DGM (Estate Department, GBD and MISD), Chief Security Officer(HO)</td><td width="100">Yes<input type="radio" name="automated_IS_YN" value="1" id="automated_IS_YN" <?php if(isset($rec['automated_IS_YN']) && $rec['automated_IS_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="automated_IS_YN" value="0" id="automated_IS_YN" <?php if(isset($rec['automated_IS_YN']) && $rec['automated_IS_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
    	
        <tr>
            <td>2.4</td>
            <td>Automatic fire extinguisher has been set in vault room which is active for 24 hours</td><td width="100">Yes<input type="radio" name="automatic_fireEX_YN" value="1" id="automatic_fireEX_YN" <?php if(isset($rec['automatic_fireEX_YN']) && $rec['automatic_fireEX_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="automatic_fireEX_YN" value="0" id="automatic_fireEX_YN" <?php if(isset($rec['automatic_fireEX_YN']) && $rec['automatic_fireEX_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
        <tr>
            <td>2.5</td>
            <td>Last drill date of all the employee of the branch regarding fire fighting</td><td width="100"><input type="text" name="last_drill_dt" Placeholder="Last drill Date" id="datepicker7" readonly="readonly" value="<?php if(isset($rec['last_drill_dt']) && $rec['last_drill_dt']!='' && $rec['last_drill_dt']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['last_drill_dt'])); } ?>"></td>
        </tr>
        
        <tr>
            <td>2.6</td>
            <td>The expiry date of fire extinguishers</td><td width="100"><input type="text" name="fireEx_expiry_dt" Placeholder="Expiry Date" id="datepicker8" readonly="readonly" value="<?php if(isset($rec['fireEx_expiry_dt']) && $rec['fireEx_expiry_dt']!='' && $rec['fireEx_expiry_dt']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['fireEx_expiry_dt'])); } ?>"></td>
        </tr>
        
        <tr>
        <td>2.7</td>
            <td>CCTV has been established in adjacent ATM booth which is active for 24 hours</td><td width="100">Yes<input type="radio" name="atm_cctv_YN" value="1" id="atm_cctv_YN" <?php if(isset($rec['atm_cctv_YN']) && $rec['atm_cctv_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="atm_cctv_YN" value="0" id="atm_cctv_YN" <?php if(isset($rec['atm_cctv_YN']) && $rec['atm_cctv_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
        
        <tr>
            <td>2.8</td>
            <td>The security of ATM booth has been ensured</td><td width="100">Yes<input type="radio" name="atm_security_YN" value="1" id="atm_security_YN" <?php if(isset($rec['atm_security_YN']) && $rec['atm_security_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="atm_security_YN" value="0" id="atm_security_YN" <?php if(isset($rec['atm_security_YN']) && $rec['atm_security_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>
    
    <!-- Technological Security End -->

    
    <!-- Bima Security Start -->
    	
    	<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Bima Security</th></tr>
    	
        <tr>
            <td>3.1</td>
            <td>Insurance up to cash-in-safe limit(full amount of cash kept in vault) has been done as on </td><td width="100"><input type="text" name="insurance_dt" Placeholder="Insurance Date" id="datepicker" readonly="readonly" value="<?php if(isset($rec['insurance_dt']) && $rec['insurance_dt']!='' && $rec['insurance_dt']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['insurance_dt'])); } ?>"></td>
        </tr>
        
    	<tr>
            <td>3.2</td>
            <td>Expiry date of insurance policy is </td><td width="100"><input type="text" name="insurance_exp_dt" id="datepicker1"  Placeholder="Insurance Expiry Date" readonly="readonly" value="<?php if(isset($rec['insurance_exp_dt']) && $rec['insurance_exp_dt']!='' && $rec['insurance_exp_dt']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['insurance_exp_dt'])); } ?>"></td>
        </tr>
    	
    <!-- Bima Security End -->
    
    <!-- Cash Related Information Start -->
    	<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Cash Related Information </th></tr>
        
    	<tr>
            <td>4.1</td>
            <td>Cash-in-Safe limit</td><td width="100"><input type="text" placeholder="Amount" name="cash_safe_limit" id="cash_safe_limit" value="<?php if(isset($rec['cash_safe_limit']) && $rec['cash_safe_limit']!=''){ echo $rec['cash_safe_limit']; } ?>"></td>
        </tr>
        
		<tr>
            <td>4.2</td>
            <td>Cash-on-Counter limit</td><td width="100"><input type="text" placeholder="Amount" name="cash_counter_limit" id="cash_counter_limit" value="<?php if(isset($rec['cash_counter_limit']) && $rec['cash_counter_limit']!=''){ echo $rec['cash_counter_limit']; } ?>"></td>
        </tr>
        
		<tr>
            <td>4.3</td>
            <td>Cash-in-Transit limit</td><td width="100"><input type="text" placeholder="Amount" name="cash_transit_limit" id="cash_transit_limit" value="<?php if(isset($rec['cash_transit_limit']) && $rec['cash_transit_limit']!=''){ echo $rec['cash_transit_limit']; } ?>"></td>
        </tr>
        
    	<tr>
            <td>4.4</td>
            <td>Name and designation of approval authority of the cash-in safe limit</td>
            <td width="100"><input type="text" placeholder="Name" name="approval_authority_name" id="approval_authority_name" value="<?php if(isset($rec['approval_authority_name']) && $rec['approval_authority_name']!=''){ echo $rec['approval_authority_name']; } ?>"></td>
            <td width="100">
            <?php 
        	  $selected_designation='';
        	  if(isset($_POST['approval_authority_dsg']))
        	  {
        	  	$selected_designation=$_POST['approval_authority_dsg'];
        	  }
              else
              {
               if(isset($rec['approval_authority_dsg']) && $rec['approval_authority_dsg'] !='')
               {
                $selected_designation=$rec['approval_authority_dsg'];
               } 
              } 
        	  ?>
              <?php echo form_dropdown('approval_authority_dsg',$designation_dropdown,$selected_designation,'') ?>
            </td>
        </tr>
        
    	<tr>
            <td>4.5</td>
            <td>Number of mutilated note in hand</td>
            <td>
            <input type="text" placeholder="Number of 1 TK Note" name="mutilated_note_1" id="mutilated_note_1" value="<?php if(isset($rec['mutilated_note_1']) && $rec['mutilated_note_1']!=''){ echo $rec['mutilated_note_1']; } ?>">
            <input type="text" placeholder="Number of 2 TK Note" name="mutilated_note_2" id="mutilated_note_2" value="<?php if(isset($rec['mutilated_note_2']) && $rec['mutilated_note_2']!=''){ echo $rec['mutilated_note_2']; } ?>">
            <input type="text" placeholder="Number of 5 TK Note" name="mutilated_note_5" id="mutilated_note_5" value="<?php if(isset($rec['mutilated_note_5']) && $rec['mutilated_note_5']!=''){ echo $rec['mutilated_note_5']; } ?>">
            <input type="text" placeholder="Number of 10 TK Note" name="mutilated_note_10" id="mutilated_note_10" value="<?php if(isset($rec['mutilated_note_10']) && $rec['mutilated_note_10']!=''){ echo $rec['mutilated_note_10']; } ?>">
            <input type="text" placeholder="Number of 20 TK Note" name="mutilated_note_20" id="mutilated_note_20" value="<?php if(isset($rec['mutilated_note_20']) && $rec['mutilated_note_20']!=''){ echo $rec['mutilated_note_20']; } ?>">
            <input type="text" placeholder="Number of 50 TK Note" name="mutilated_note_50" id="mutilated_note_50" value="<?php if(isset($rec['mutilated_note_50']) && $rec['mutilated_note_50']!=''){ echo $rec['mutilated_note_50']; } ?>">
            <input type="text" placeholder="Number of 100 TK Note" name="mutilated_note_100" id="mutilated_note_100" value="<?php if(isset($rec['mutilated_note_100']) && $rec['mutilated_note_100']!=''){ echo $rec['mutilated_note_100']; } ?>">
            <input type="text" placeholder="Number of 500 TK Note" name="mutilated_note_500" id="mutilated_note_500" value="<?php if(isset($rec['mutilated_note_500']) && $rec['mutilated_note_500']!=''){ echo $rec['mutilated_note_500']; } ?>">
            <input type="text" placeholder="Number of 1000 TK Note" name="mutilated_note_1000" id="mutilated_note_1000" value="<?php if(isset($rec['mutilated_note_1000']) && $rec['mutilated_note_1000']!=''){ echo $rec['mutilated_note_1000']; } ?>">
            </td>
        </tr>
        
        <tr>
            <td>4.6</td>
            <td>Cash of the branch is carried in</td>
            <td width="100" colspan="2">
            <select name="cash_carried" id="cash_carried">
            <option value="">Select</option>
            <option value="1" <?php if(isset($rec['cash_carried']) && $rec['cash_carried']=='1'){echo "selected='selected'";} ?>>Still Box</option>
            <option value="2" <?php if(isset($rec['cash_carried']) && $rec['cash_carried']=='2'){echo "selected='selected'";} ?>>Gunny Bag</option>
            <option value="3" <?php if(isset($rec['cash_carried']) && $rec['cash_carried']=='3'){echo "selected='selected'";} ?>>Open Hand</option>
            <option value="4" <?php if(isset($rec['cash_carried']) && $rec['cash_carried']=='4'){echo "selected='selected'";} ?>>Others</option>
            </select>
            </td>
        </tr>
        
        <tr>
            <td>4.7</td>
            <td>Is there cash outside iron safe?</td><td width="100">Yes<input type="radio" name="cash_outside_YN" value="1" id="cash_outside_YN" <?php if(isset($rec['cash_outside_YN']) && $rec['cash_outside_YN']=='1'){ echo 'checked="true"'; } ?>></td><td width="100">No<input type="radio" name="cash_outside_YN" value="0" id="cash_outside_YN" <?php if(isset($rec['cash_outside_YN']) && $rec['cash_outside_YN']=='0'){ echo 'checked="true"'; } ?>></td>
        </tr>    
   
    <!-- Cash Related Information End -->	
    

    	
        <!--Vault Audit Information Start-->
        <?php $selected_designation=''; ?>
		<tr><th colspan="4" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center; font-size:18px">Vault Audit Information</th></tr>
    	
        <tr><td colspan="4">Total security system of the branch including cash and vault  security system has been checked up as on and ensured by</td></tr>
    	
        <?php
        $selected_designation_AO='';
        $selected_designation_DO='';
        $selected_designation_HO='';
        $selected_designation_BB='';
        $selected_designation_CO='';
        if(isset($rec['VS_checked_AO_dsg']) && $rec['VS_checked_AO_dsg'] !=''){$selected_designation_AO=$rec['VS_checked_AO_dsg'];}
        if(isset($rec['VS_checked_DO_dsg']) && $rec['VS_checked_DO_dsg'] !=''){$selected_designation_DO=$rec['VS_checked_DO_dsg'];}
        if(isset($rec['VS_checked_HO_dsg']) && $rec['VS_checked_HO_dsg'] !=''){$selected_designation_HO=$rec['VS_checked_HO_dsg'];}
        if(isset($rec['VS_checked_BB_dsg']) && $rec['VS_checked_BB_dsg'] !=''){$selected_designation_BB=$rec['VS_checked_BB_dsg'];}
        if(isset($rec['VS_checked_CO_dsg']) && $rec['VS_checked_CO_dsg'] !=''){$selected_designation_CO=$rec['VS_checked_CO_dsg'];}
        ?>
        
    	<tr><td>5.1</td><td>By respective Area office</td><td width="100"><input type="text" placeholder="Date" name="VS_checked_AO_date" id="datepicker2" readonly="readonly" value="<?php if(isset($rec['VS_checked_AO_date']) && $rec['VS_checked_AO_date']!='' && $rec['VS_checked_AO_date']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['VS_checked_AO_date'])); } ?>"></td><td width="100"><input type="text" placeholder="Name" name="VS_checked_AO_name" id="VS_checked_AO_name" style="width: 215px;" value="<?php if(isset($rec['VS_checked_AO_name']) && $rec['VS_checked_AO_name']!=''){ echo $rec['VS_checked_AO_name']; } ?>"><?php echo form_dropdown('VS_checked_AO_dsg',$designation_dropdown,$selected_designation_AO,'') ?></td></tr>
    	<tr><td>5.2</td><td>By respective Divisional office</td><td width="100"><input type="text" placeholder="Date" name="VS_checked_DO_date" id="datepicker3" readonly="readonly" value="<?php if(isset($rec['VS_checked_DO_date']) && $rec['VS_checked_DO_date']!='' && $rec['VS_checked_DO_date']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['VS_checked_DO_date'])); } ?>"></td><td width="100"><input type="text" placeholder="Name" name="VS_checked_DO_name" id="VS_checked_DO_name" style="width: 215px;" value="<?php if(isset($rec['VS_checked_DO_name']) && $rec['VS_checked_DO_name']!=''){ echo $rec['VS_checked_DO_name']; } ?>"><?php echo form_dropdown('VS_checked_DO_dsg',$designation_dropdown,$selected_designation_DO,'') ?></td></tr>
    	<tr><td>5.3</td><td>By respective department of Head office</td><td width="100"><input type="text" placeholder="Date" name="VS_checked_HO_date" id="datepicker4" readonly="readonly" value="<?php if(isset($rec['VS_checked_HO_date']) && $rec['VS_checked_HO_date']!='' && $rec['VS_checked_HO_date']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['VS_checked_HO_date'])); } ?>"></td><td width="100"><input type="text" placeholder="Name" name="VS_checked_HO_name" id="VS_checked_HO_name" style="width: 215px;" value="<?php if(isset($rec['VS_checked_HO_name']) && $rec['VS_checked_HO_name']!=''){ echo $rec['VS_checked_HO_name']; } ?>"><?php echo form_dropdown('VS_checked_HO_dsg',$designation_dropdown,$selected_designation_HO,'') ?></td></tr>
    	<tr><td>5.4</td><td>By Bangladesh Bank</td><td width="100"><input type="text" placeholder="Date" name="VS_checked_BB_date" id="datepicker5" readonly="readonly" value="<?php if(isset($rec['VS_checked_BB_date']) && $rec['VS_checked_BB_date']!='' && $rec['VS_checked_BB_date']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['VS_checked_BB_date'])); } ?>"></td><td width="100"><input type="text" placeholder="Name" name="VS_checked_BB_name" id="VS_checked_BB_name" style="width: 215px;" value="<?php if(isset($rec['VS_checked_BB_name']) && $rec['VS_checked_BB_name']!=''){ echo $rec['VS_checked_BB_name']; } ?>"><?php echo form_dropdown('VS_checked_BB_dsg',$designation_dropdown_BB,$selected_designation_BB,'') ?></td></tr>
    	<tr><td>5.5</td><td>By Commercial Audit/Other office</td><td width="100"><input type="text" placeholder="Date" name="VS_checked_CO_date" id="datepicker6" readonly="readonly" value="<?php if(isset($rec['VS_checked_CO_date']) && $rec['VS_checked_CO_date']!='' && $rec['VS_checked_CO_date']!='1900-01-01 00:00:00'){ echo date('d-M-Y',strtotime($rec['VS_checked_CO_date'])); } ?>"></td><td width="100"><input type="text" placeholder="Name" name="VS_checked_CO_name" id="VS_checked_CO_name" style="width: 215px;" value="<?php if(isset($rec['VS_checked_CO_name']) && $rec['VS_checked_CO_name']!=''){ echo $rec['VS_checked_CO_name']; } ?>"><?php echo form_dropdown('VS_checked_CO_dsg',$designation_dropdown_CO,$selected_designation_CO,'') ?></td></tr>
    	<!--Vault Audit Information End-->
    </table>
	<br/>
	<table border="1">
	<tr><td colspan="3">The above information is checked and approved by-</td></tr>
    
	<tr>
	<td>Head of branch</td>
	<?php
	$id_head_of_branch_dsg="id='approved_head_of_branch_dsg'";
    $selected_designation_head_of_branch='';
    if(isset($rec['approved_head_of_branch_dsg']) && $rec['approved_head_of_branch_dsg'] !=''){$selected_designation_head_of_branch=$rec['approved_head_of_branch_dsg'];}
	?>
	<td><input type="text" placeholder="Name" name="approved_head_of_branch_name" id="approved_head_of_branch_name" style="width: 215px;" value="<?php if(isset($rec['approved_head_of_branch_name']) && $rec['approved_head_of_branch_name']!=''){ echo $rec['approved_head_of_branch_name']; } ?>"><?php echo form_dropdown('approved_head_of_branch_dsg',$designation_dropdown,$selected_designation_head_of_branch,$id_head_of_branch_dsg) ?></td>
	</tr>
    
    <tr>
	<td>Manager</td>
	<?php
	$id_manager_dsg="id='approved_manager_dsg'";
    $selected_designation_manager='';
    if(isset($rec['approved_manager_dsg']) && $rec['approved_manager_dsg'] !=''){$selected_designation_manager=$rec['approved_manager_dsg'];}
	?>
	<td><input type="text" placeholder="Name" name="approved_manager_name" id="approved_manager_name" style="width: 215px;" value="<?php if(isset($rec['approved_manager_name']) && $rec['approved_manager_name']!=''){ echo $rec['approved_manager_name']; } ?>"><?php echo form_dropdown('approved_manager_dsg',$designation_dropdown,$selected_designation_manager,$id_manager_dsg) ?></td>
	</tr>
	
	<tr>
	<td>Assistant Manager</td>
	<?php
	$id_asst_manager_dsg="id='approved_asst_manager_dsg'";
    $selected_designation_asst_manager='';
    if(isset($rec['approved_asst_manager_dsg']) && $rec['approved_asst_manager_dsg'] !=''){$selected_designation_asst_manager=$rec['approved_asst_manager_dsg'];}
	?>
	<td><input type="text" placeholder="Name" name="approved_asst_manager_name" id="approved_asst_manager_name" style="width: 215px;" value="<?php if(isset($rec['approved_asst_manager_name']) && $rec['approved_asst_manager_name']!=''){ echo $rec['approved_asst_manager_name']; } ?>"><?php echo form_dropdown('approved_asst_manager_dsg',$designation_dropdown,$selected_designation_asst_manager,$id_asst_manager_dsg) ?></td>
	</tr>
    
   	<tr>
	<td>Cashier</td>
	<?php
	$id_cashier_dsg="id='approved_cashier_dsg'";
    $selected_designation_cashier='';
    if(isset($rec['approved_cashier_dsg']) && $rec['approved_cashier_dsg'] !=''){$selected_designation_cashier=$rec['approved_cashier_dsg'];}
	?>
	<td><input type="text" placeholder="Name" name="approved_cashier_name" id="approved_cashier_name" style="width: 215px;" value="<?php if(isset($rec['approved_cashier_name']) && $rec['approved_cashier_name']!=''){ echo $rec['approved_cashier_name']; } ?>"><?php echo form_dropdown('approved_cashier_dsg',$designation_dropdown,$selected_designation_cashier,$id_cashier_dsg) ?></td>
	</tr>
    
	</table>
	<br/>
    <table align="center">
    	<tr align="center">
            <td>
            <input type="hidden" name="form_specification" value="1"/>
            <input type='button' name="vsm_data_submit_btn" id='vsm_data_submit_btn' value='Submit' <?php echo $attribute; ?> onclick='control_vsm_form(this.value)'  />
            </td>
        </tr>
    </table>
    
    <?php
	echo form_close();
	?>
 