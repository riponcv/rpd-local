
   	<?php 
    
    $attribute='';
    if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }
				
	if(isset($login_office_status) && $login_office_status ==4)
    {
     echo form_open('rei/rei_target_edit_save','id="id_rei_edit_form"');   
    }
    else
    {
        echo form_open('');
    }

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Real Estate Index Data Editing Form</th></tr></table>";

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
        echo '<table align=center><tr><td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to fill up this form. Only branch\'s users are allowed to edit.</td></tr></table>';   
    }
    echo "<br/>";
       
    echo '<input type="hidden" id="rei_year" name="rei_year"  value="'.$rei_year.'" />';
    echo '<input type="hidden" id="rei_branch" name="rei_branch"  value="'.$rei_branch.'" />';
	
    echo "<div id='flashdata'>";
    echo '<font style="background-color:yellow;font-weight: bold;color: green;">Data for branch- '.$rei_branch.' of year-'.$rei_year.' To Edit</font>'; 
	echo "</div><br/>";
    
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
    
	
    echo "<table border=\"1\" align=\"center\">"; 	
	echo "<tr>";
	echo "<td align='center'>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='center' width='300'>"."<strong>"."Group "."<strong>"."</td>";
	echo "<td align='center' >"."<strong>"."Subgroup "."<strong>"."</td>";
	echo "<td align='center'>"."<strong>"."Value"."<strong>"."</td>";
	echo "</tr>";
     
	$data_amt = array();
	$amt_count=0;

	foreach($rec as $row3)
	{
	 $data_amt[$amt_count]= $row3->rei_data_amt;
	 $amt_count=$amt_count+1;
	 }
	$amt_sum=0.0;
	$amt_total=array();
	$AA=array();
	$BB=array();
	$AA_i=0;
    $account=0;
	foreach($rec as $row5)
	{
	 $AA_A=$row5->rei_data_sg_code;
	$dd_pt_id_ary[$AA_i]=$AA_A;
	 
 	if(strlen($AA_A)==3)
	 {
	 $AA_A=substr($AA_A,0,1);
	 }
	 else if (strlen($AA_A)==4)
       {
	  $AA_A=substr($AA_A,0,2);
	 }	 
	 $AA[$AA_i++]=$AA_A;
	}

    $AA_A_i=0;
	$pt_id_A=array();
	foreach($records2 as $row8)
	{
	 $pt_id_A[$AA_A_i]=$row8->rei_subgroup_code;
	 $AA_A_i++;
	}
	$amt_sum_total=0;
	
	$data_amt_total = array();
	
	for($jj=0;$jj<$AA_A_i;$jj++)
	{
	  for($ii=0;$ii<$AA_i;$ii++)
	  {
	   if($pt_id_A[$jj]==$dd_pt_id_ary[$ii])
	   {
		$amt_sum_total=$amt_sum_total+$data_amt[$ii];
		$account++;
	   }
	 }
	  $data_amt_total[$jj]=$amt_sum_total;
	  $amt_sum_total=0;
	}





	$BB_i=0;
	foreach($records1 as $row5)
	{
	 $BB_B=$row5->rei_group_code;
	 $BB[$BB_i++]=$BB_B;
	}
		
	for($jj=0;$jj<$BB_i;$jj++)
	{
	  for($ii=0;$ii<$AA_i;$ii++)
	  {
	   if($BB[$jj]==$AA[$ii])
	   {
		(float)$amt_sum=$amt_sum+(float)$data_amt[$ii];
		$account++;
	   }
	  }
	 
	  $amt_total[$jj]=(float)$amt_sum;
	   $amt_sum=0;
	}

	 $sl=1;
     $jjj=0;
	 $i=0;
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

					echo '<td>'.'<input style="text-align: right;" type="text" '.$attribute.' name="totalamt[]" id="totalamt"  readonly="readonly" size="20" value="'.$amt_total[$jjj].'"/>'.'</td>';
					echo "</tr>";
                    $jjj++;
				 }
				$last++;
				$z++;
				if(!isset($BB[$z])){$BB[$z]=0;}
			}
                //jack
              if(!isset($data_amt_total[$i])){$data_amt_total[$i]=0;}
              //jack
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
			  
              echo '<td>'.'<input type="text" style="text-align: right;" name="amount[]" id="amount_'.$total_count.'" onblur="if(jQuery(this).css(\'background-color\') === \'rgb(255, 102, 0)\'){checkAttrColor('.$total_count.')}"  onKeyUp="displayREIText()" value="'.$data_amt_total[$i].'" size="20"/>'.'</td>';
			$co++;
		    $count++;
			$i=$i+1;//++;
		   echo "</tr>";
		
	
	 }
	echo "<tr>";
    echo "<td align='left' colspan='3'>"."<strong>"."Total "."<strong>"."</td>";
	echo '<td>'.'<input type="text" style="text-align: right;" name="totalamt[]" id="totalamt"   value="'.$amt_total[$jjj].'" readonly="readonly" size="20"/>'.'</td>';
	echo "</tr>";
	
	echo "<tr>";
	echo "<td align='center' colspan='4'><input type='button' id='rei_submit_btn' value='Save Changes' onclick='control_rei_form(this.value)'  $attribute />   ".form_reset('myClear', 'Set Previous Value',$attribute)."</td>";
	echo "</tr>";
	
	echo "</table>";
	echo form_close();
	?>
 