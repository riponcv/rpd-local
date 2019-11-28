    <?php 
    $attribute='';
    if(isset($enable_status) && $enable_status !=1)
    {
        $attribute='disabled="disabled"';
    }
				
	if(isset($enable_status) && $enable_status ==1)
    {
     echo form_open('tms/tms_target_entry','id="id_tms_entry_form"');   
    }
    else
    {
        echo form_open('');
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Target Setting Form</th></tr></table>";

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
   	
    if(isset($enable_status) && $enable_status !=1)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to fill up this form.</td></tr></table>';   
    }
    echo "<br/>";
       
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Select Year Of Target";
	echo "</td>";
	echo "<td>";
	
	echo '<select id="target_year" name="target_year" '.$attribute.'>';
    echo '<option value="">Select Year</option>';
	foreach($records3 as $row)
	{
		$select='';
		if(isset($_POST['target_year']) && $_POST['target_year']==$row->tms_yr)
		{
			$select="selected='selected'";
		}
	  echo '<option value="'.$row->tms_yr.'" '.$select.'>'.$row->tms_yr.'</option>';

	}
	echo '</select>';
	echo "</td>";		
	echo "</tr>";
	echo "</table>";
    echo "<br/>";
    
    if(!empty($own_br_arr))
    {
   	    echo "<table  border=\"1\" align=\"center\">"; 
    	echo "<tr>";
    	echo "<td>";
    	echo "Select Branch";
    	echo "</td>";
    	echo "<td>";
    	
    	echo '<select id="target_branch" name="target_branch" '.$attribute.'>';
        echo '<option value="">Select Branch</option>';
    	foreach($own_br_arr as $row)
    	{
    		$select='';
    		if(isset($_POST['target_branch']) && $_POST['target_branch']==$row->brcode)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$row->brcode.'" '.$select.'>'.$row->branchname.'('.$row->brcode.')'.'</option>';
    
    	}
    	echo '</select>';
    	echo "</td>";		
    	echo "</tr>";
    	echo "</table>";
        echo "<br/>";
    }

    
	
    echo "<table border=\"1\" align=\"center\">"; 	
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' width='300'>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Product "."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "</tr>";

	$BB_i=0;
	foreach($records1 as $row5)
	{
	 $BB_B=$row5->tms_group_code;
	 $BB[$BB_i++]=$BB_B;
	}
	 $count=1;
	 $z=0;
	 $last=0;
	 $total_count=0;
     
	foreach($records2 as $row1)
	{
	   $co=0;
	    while($BB[$z]==$row1->tms_group_code)
			{
			 if($last>0)
				{
					echo "<tr>";
					echo "<td>"." "."</td>";
					echo "<td>"." "."</td>";
					echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
                    
					echo '<td>'.'<input type="text" '.$attribute.' name="totalamt[]"  value="'.set_value('totalamt[]').'" id="totalamt"  readonly="readonly" size="20"/>'.'</td>';
					echo "</tr>";
				 }
				$last++;
				$z++;
				if(!isset($BB[$z])){$BB[$z]=0;}
			}
			  $total_count++;
              	  
			  echo "<tr>";
			  echo "<td align='center'>".$count."</td>"; 
			  $A=$row1->tms_subgroup_code;
			  echo "<input type='hidden' name='tms_subgroup_code[]' size='15' value='$A'/>";
			  echo "<td align='left'>".$row1->tms_group_text."</td>";
			  echo "<td align='left'>".$row1->tms_subgroup_text."</td>";
              
              //set value
			  
              echo '<td>'.'<input '.$attribute.' type="text" id="amount_'.$total_count.'" onblur="if(jQuery(this).css(\'background-color\') === \'rgb(255, 102, 0)\'){checkAttrColor('.$total_count.')}"  name="amount[]"  onKeyUp="displayTMSText()" value="'.set_value('amount[]').'" size="20"/>'.'</td>';
			$co++;
		    $count++;
		   echo "</tr>";
		
	
	 }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
    
	echo '<td>'.'<input '.$attribute.' type="text" name="totalamt[]" id="totalamt"   value="'.set_value('totalamt[]').'" readonly="readonly" size="20"/>'.'</td>';
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td><input type='button' id='tms_submit_btn' value='Submit' onclick='control_tms_form(this.value)'  $attribute /></td>";
	echo "<td>".form_reset('myClear', 'Clear',$attribute)."</td>";
	echo "</tr>";
	
	echo "</table>";
	echo form_close();
	?>    