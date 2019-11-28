<?php 

echo $_POST;
die();
		
		
	 $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
		if(isset($login_office_status) && $login_office_status ==4)
		{
		 echo form_open('weekly_position/weekly_position_entry_form','id="id_weekly_position_entry_form"');   
		}
    else
    {
        echo form_open('');
    }
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Weekly Position</th></tr></table>";
    if(validation_errors())
    {
       	echo "<div id='error'>".validation_errors()."</div>";     
    }    
    if($this->session->flashdata('success'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success').'</font>'; 
    	echo "</div>";
    }
   	if($this->session->flashdata('notice'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: brown;">'.$this->session->flashdata('notice').'</font>'; 
    	echo "</div>";
    }
   	if($this->session->flashdata('error'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: red;">'.$this->session->flashdata('error').'</font>'; 
    	echo "</div>";
    }
    echo "<br/>";
    if($login_office_status !=4)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to fill up this form.</td></tr></table>';   
    }
	$set_value=0;
	if(isset($weekly_date))
	{
		$set_value=$weekly_date;
		echo "<p  style='color:#6A8CE9;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;'>"."Statement of position for Week ended Date: ".$set_value."</p>";
	}
	echo "<input type='hidden' name='weekly_date' id='weekly_date' value='$set_value'/>";

	if(isset($omis_date_exist))
	{
		$omis_date_exist=$omis_date_exist;
		
	}
	echo "<input type='hidden' name='omis_date_exist' id='omis_date_exist' value='$omis_date_exist'/>";
	////////////////Total Here////////

		$dep_total_ex_bp=0;
		$dep_total=0;
        $deposit_foreign_currency=0;
		$adv_total=0;
		$cashhand_total=0;
        
		//start dep_total_ex_bp calculation
        for($i=0;$i<=18;$i++)
		{
			if(isset($rec[$i]->weekly_amt) && $rec[$i]->weekly_amt !='')
			{
				$dep_total_ex_bp=$dep_total_ex_bp+$rec[$i]->weekly_amt;
			}
		}
        
        //end dep_total_ex_bp calculation

		//start dep_total calculation
        for($i=19;$i<=21;$i++)
		{
			if(isset($rec[$i]->weekly_amt) && $rec[$i]->weekly_amt !='')
			{
				$dep_total=$dep_total+$rec[$i]->weekly_amt;
			}
		}
		$dep_total=$dep_total+$dep_total_ex_bp;
        
        //end dep_total calculation
        
		//start deposit_foreign_currency calculation
        for($i=14;$i<=16;$i++)
		{
			if(isset($rec[$i]->weekly_amt) && $rec[$i]->weekly_amt !='')
			{
				$deposit_foreign_currency=$deposit_foreign_currency+$rec[$i]->weekly_amt;
			}
		}
        
        //end deposit_foreign_currency calculation		
		
		//start adv_total calculation
        for($i=32;$i<=40;$i++)
		{
			if(isset($rec[$i]->weekly_amt) && $rec[$i]->weekly_amt !='')
			{
				$adv_total=$adv_total+$rec[$i]->weekly_amt;
			}
		}	
        //end adv_total calculation
        
        //start cash_in_hand_total calculation
		for($i=41;$i<=51;$i++)
		{
			if(isset($rec[$i]->weekly_amt) && $rec[$i]->weekly_amt !='')
			{
				$cashhand_total=$cashhand_total+$rec[$i]->weekly_amt;
			}
		}	
        //end cash_in_hand_total calculation	
        
	////////////////Total Here////////
    
    
   	echo "<table border=\"1\" align=\"center\">";
	echo "<td width='20'>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' width='200'>"."<strong>"."HEADS OF ACCOUNTS "."<strong>"."</td>";
	echo "<td align='left' width='250'>"."<strong>"."Accounts "."<strong>"."</td>";
	echo "<td align='left' width='20'>"."<strong>"."Telg. Code "."<strong>"."</td>";
	echo "<td align='centers' width='80'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "</tr>";
	 $count=1;
	 $z=0;
	 $last=0;
	 $total_count=0;
	 $co=0;
	 
	foreach($records2 as $row1)
	{
		$total_count++;
	    echo "<tr>";
		echo "<td align='center'>".$count."</td>"; 
		$A=$row1->weekly_position_subgroup_code;
		echo "<input type='hidden' name='weekly_position_subgroup_code[]' size='15' value='$A'/>";
		echo "<td align='left'>".$row1->weekly_position_group_text."</td>";
		echo "<td align='left'>".$row1->weekly_position_subgroup_text."</td>";
		echo "<td align='left'>".$row1->weekly_position_subgroup_telg_."</td>";
        
        //set value
		$set_value=0;
		if(isset($rec[$co]->weekly_amt) && $rec[$co]->weekly_amt !='')
		{
			if($rec[$co]->weekly_amt==0)
			{
			$set_value=round($rec[$co]->weekly_amt,0);
			}
			else
			{
				$set_value=$rec[$co]->weekly_amt;
			}
		}
		
		echo '<td>'.'<input '.$attribute.' type="text" id="amount_'.$total_count.'" onblur="if(jQuery(this).css(\'background-color\') === \'rgb(255, 102, 0)\'){checkAttrColor('.$total_count.')}"  
						onKeyUp="displayweeklyText()" name="amount[]" value="'.$set_value.'" size="20" />'.'</td>';
		$co++;
		$count++;
		echo "</tr>";
		
		if($count==20)
		{
			echo "<td colspan='4'>"."<strong>"."Total Deposits (Exclude B/P) [1-19]"."<strong>"."</td>";
			echo '<td>'.'<input style="background-color:gray" type="text" name="total_amt_deposit_weekly_ex_bp" value="'.$dep_total_ex_bp.'" id="total_amt_deposit_weekly_ex_bp"  readonly="readonly" size="20"  />'.'</td>';
		}
		
		if($count==23)
		{
			echo "<td colspan='4'>"."<strong>"."Total Deposit (Including BP) [1-22]"."<strong>"."</td>";
			echo '<td>'.'<input style="background-color:gray" type="text" name="total_amt_deposit_weekly" value="'.$dep_total.'" id="total_amt_deposit_weekly"  readonly="readonly" size="20"  />'.'</td>';
			
			echo "<tr>";
			echo "<td colspan='4'>"."<strong>"."OMIS Total Deposit (Including BP)"."<strong>"."</td>";
			$set_value=0;
			if(isset($omis_value['deposit'])&&($omis_value['deposit'])!='')
			{
				$set_value=$omis_value['deposit'];
			}
			echo '<td>'.'<input style="background-color:gray" type="text" name="total_amt_deposit_omis" value="'.$set_value.'" id="total_amt_deposit_omis"  readonly="readonly" size="20"  />'.'</td>';
			echo "</tr>";
		}
        
		if($count==32)
		{
            echo "<td colspan='3'>"."<strong>"."Deposit in Foreign Currency (Excluding NFCD) [15-17]"."<strong>"."</td>";
            echo "<td><strong>YY</strong></td>";
			echo '<td>'.'<input style="background-color:gray" type="text" name="deposit_foreign_currency" value="'.$deposit_foreign_currency.'" id="deposit_foreign_currency"  readonly="readonly" size="20"  />'.'</td>';
		}
        
		if($count==42)
		{
			echo "<td colspan='2'>"."<strong>"."Total Advances in Bangladesh [33-41]"."<strong>"."</td>";
			echo "<td><strong>(iv) Total Advances</strong></td>";
			echo "<td><strong>CC</strong></td>";
			echo '<td>'.'<input style="background-color:gray" type="text" name="total_amt_advance_weekly" value="'.$adv_total.'" id="total_amt_advance_weekly"  readonly="readonly" size="20" />'.'</td>';
			$set_value=0;
			if(isset($omis_value['advance'])&&($omis_value['advance'])!='')
			{
				$set_value=$omis_value['advance'];
			}
			echo "<tr>";
			echo "<td colspan='4'>"."<strong>"."OMIS Total Advance"."<strong>"."</td>";
			echo '<td>'.'<input style="background-color:gray" type="text" name="total_amt_advance_omis" value="'.$set_value.'" id="total_amt_advance_omis"  readonly="readonly" size="20"  />'.'</td>';
			echo "</tr>";
		}
		if($count==53)
		{
			echo "<td colspan='3'>"."<strong>"."Total Cash-in-Hand [42-52]"."<strong>"."</td>";
			echo "<td><strong>PP</strong></td>";
			echo '<td>'.'<input style="background-color:gray" type="text" name="total_amt_cash_weekly" value="'.$cashhand_total.'" id="total_amt_cash_weekly"  readonly="readonly" size="20" />'.'</td>';
			$set_value=0;
			if(isset($omis_value['cashin_hand'])&&($omis_value['cashin_hand'])!='')
			{
				$set_value=$omis_value['cashin_hand'];
			}
			echo "<tr>";
			echo "<td colspan='4'>"."<strong>"."OMIS Cash in Hand"."<strong>"."</td>";
			echo '<td>'.'<input style="background-color:gray" type="text" name="total_amt_cash_omis" value="'.$set_value.'" id="total_amt_cash_omis"  readonly="readonly" size="20"  />'.'</td>';
			echo "</tr>";
		}
	 }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td><input type='button' id='weekly_position_submit_btn' value='Submit' onclick='control_weekly_position_form(this.value)'  $attribute /></td>";
	echo "<td>".form_reset('myClear', 'Clear',$attribute)."</td>";
	echo "</tr>";
	echo "</table>";
	echo form_close();
	?>