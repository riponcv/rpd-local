    <?php 
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
				
	if(isset($login_office_status) && $login_office_status ==4)
    {
     echo form_open('rei/rei_data_entry','id="id_rei_entry_form"');   
    }
    else
    {
        echo form_open('');
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Real Estate Index Data Entry Form</th></tr></table>";

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
   	
    if(isset($login_office_status) && $login_office_status !=4)
    {
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to fill up this form. Only branch\'s users are allowed to submit data.</td></tr></table>';   
    }
    echo "<br/>";
    
    ?>
    <table border="1" width="730px">
    <tr bgcolor="#99CCFF">
    <th align="center">General Instruction</th>
    </tr>
    
    <tr>
    <td>
    *Eligible collateral as defined by BRPD Circular 14/2012.
    </td>
    </tr>
    
    <tr>
    <td>
    **Market value and forced sales value must be valued by professional valuation firm or by a specialized engineer as per the instructions given in BRPD Circular 14/2012.
    </td>
    </tr>
    
    <tr>
    <td>
    ***<br /><span style="font-weight: bold;">For fully constructed buildings:</span> Use the aggregate floor space of the building as size of the collateral and ignore size of the land. <br/><span style="font-weight: bold;">For lands without any building or with non completed building:</span> Use total land area as the size of the collateral. Convert land size from khata or Decimal formate to square feet format(1 decimal=435.6 square feet).
    </td>
    </tr>
    
    <tr>
    <td>
    ****Market Value as mentioned in the loan sanction letter or loan renewal letter.
    </td>
    </tr>
    
    </table> 
    <br />
    <br />
    <?php
       
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Select Year";
	echo "</td>";
	echo "<td>";
	
	echo '<select id="rei_year" name="rei_year" '.$attribute.'>';
    echo '<option value="">Select Year</option>';
	foreach($records3 as $row)
	{
		$select='';
		if(isset($_POST['rei_year']) && $_POST['rei_year']==$row->rei_yr)
		{
			$select="selected='selected'";
		}
	  echo '<option value="'.$row->rei_yr.'" '.$select.'>'.$row->rei_yr.'</option>';

	}
	echo '</select>';
	echo "</td>";		
	echo "</tr>";
	echo "</table>";
    echo "<br/>";

    echo "<table border=\"1\" align=\"center\">"; 	
	echo "<tr>";
	echo "<td align='center'>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='center' width='300'>"."<strong>"."Group "."<strong>"."</td>";
	echo "<td align='center' >"."<strong>"."Subgroup "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Value"."<strong>"."</td>";
	echo "</tr>";

	$BB_i=0;
	foreach($records1 as $row5)
	{
	 $BB_B=$row5->rei_group_code;
	 $BB[$BB_i++]=$BB_B;
	}
	 $sl=1;
     $count=1;
	 $z=0;
	 $last=0;
	 $total_count=0;
     
	foreach($records2 as $row1)
	{
	   $co=0;
	    while($BB[$z]==$row1->rei_group_code)
			{
			 if($last>0)
				{
					echo "<tr>";
					echo "<td align='left' colspan='3'>"."<strong>"."Total "."<strong>"."</td>";
                    
					echo '<td>'.'<input style="text-align: right;" type="text" '.$attribute.' name="totalamt[]"  value="'.set_value('totalamt[]').'" id="totalamt"  readonly="readonly" size="20"/>'.'</td>';
					echo "</tr>";
				 }
				$last++;
				$z++;
				if(!isset($BB[$z])){$BB[$z]=0;}
			}
			  $total_count++;
              	  
			  echo "<tr>";
              if($count>0 && $count<25)
              {
                  if($count%4==1)
                  {
                    echo "<td align='center' rowspan='4'>".$sl."</td>";
                    $sl++;
                  }
              }
              if($count>24 && $count<35)
              {
                  if($count%2==1)
                  {
                    echo "<td align='center' rowspan='2'>".$sl."</td>";
                    $sl++;
                  }
              }
               
			  $A=$row1->rei_subgroup_code;
			  echo "<input type='hidden' name='rei_subgroup_code[]' size='15' value='$A'/>";
              
              if($count>0 && $count<25)
              {
                  if($count%4==1)
                  {
                    echo "<td align='left' rowspan='4'>".$row1->rei_group_text."</td>";
                  }
              }
              if($count>24 && $count<35)
              {
                  if($count%2==1)
                  {
                    echo "<td align='left' rowspan='2'>".$row1->rei_group_text."</td>";
                  }
              }
              
			  echo "<td align='left'>".$row1->rei_subgroup_text."</td>";
              
              //set value
			  
              echo '<td>'.'<input '.$attribute.' style="text-align: right;" type="text" id="amount_'.$total_count.'" onblur="if(jQuery(this).css(\'background-color\') === \'rgb(255, 102, 0)\'){checkAttrColor('.$total_count.')}"  name="amount[]"  onKeyUp="displayREIText()" value="'.set_value('amount[]').'" size="20"/>'.'</td>';
			$co++;
		    $count++;
		   echo "</tr>";
		
	
	 }
	echo "<tr>";
	echo "<td align='left' colspan='3'>"."<strong>"."Total "."<strong>"."</td>";
    
	echo '<td>'.'<input '.$attribute.' type="text"  style="text-align: right;" name="totalamt[]" id="totalamt"   value="'.set_value('totalamt[]').'" readonly="readonly" size="20"/>'.'</td>';
	echo "</tr>";
	
	echo "<tr>";
	echo "<td align='center' colspan='4'><input type='button' id='rei_submit_btn' value='Submit' onclick='control_rei_form(this.value)'  $attribute />      ".form_reset('myClear', 'Clear',$attribute)."</td>";
	echo "</tr>";
	
	echo "</table>";
    ?>
    <input type="hidden" name="rei_branch" value="<?php echo isset($office_code)?$office_code:'0'; ?>"/>
    <?php
	echo form_close();
	?>
      