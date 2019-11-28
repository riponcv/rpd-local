
   	<?php 
    
    $attribute='';
    if(isset($enable_status) && $enable_status !=1)
    {
        $attribute='disabled="disabled"';
    }
				
	if(isset($enable_status) && $enable_status ==1)
    {
     echo form_open('tms/tms_target_edit_save','id="id_tms_edit_form"');   
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
       
    echo '<input type="hidden" id="target_year" name="target_year"  value="'.$target_year.'" />';
    echo '<input type="hidden" id="target_branch" name="target_branch"  value="'.$target_branch.'" />';
	
    echo "<div id='flashdata'>";
    echo '<font style="background-color:yellow;font-weight: bold;color: green;">Target for branch- '.$target_branch.' of year-'.$target_year.' To Edit</font>'; 
	echo "</div><br/>";
    
	
    echo "<table border=\"1\" align=\"center\">"; 	
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' width='300'>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Product "."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "</tr>";
     
	$data_amt = array();
	$amt_count=0;

	foreach($rec as $row3)
	{
	 $data_amt[$amt_count]= $row3->tms_data_amt;
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
	 $AA_A=$row5->tms_data_sg_code;
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
	 $pt_id_A[$AA_A_i]=$row8->tms_subgroup_code;
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
	 $BB_B=$row5->tms_group_code;
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

	 $jjj=0;
	 $i=0;
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

					echo '<td>'.'<input type="text" '.$attribute.' name="totalamt[]" id="totalamt"  readonly="readonly" size="20" value="'.$amt_total[$jjj].'"/>'.'</td>';
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
			  echo "<td align='center'>".$count."</td>"; 
			  $A=$row1->tms_subgroup_code;
			  echo "<input type='hidden' name='tms_subgroup_code[]' size='15' value='$A'/>";
			  echo "<td align='left'>".$row1->tms_group_text."</td>";
			  echo "<td align='left'>".$row1->tms_subgroup_text."</td>";
			  
              echo '<td>'.'<input type="text" name="amount[]" id="amount_'.$total_count.'" onblur="if(jQuery(this).css(\'background-color\') === \'rgb(255, 102, 0)\'){checkAttrColor('.$total_count.')}"  onKeyUp="displayTMSText()" value="'.$data_amt_total[$i].'" size="20"/>'.'</td>';
			$co++;
		    $count++;
			$i=$i+1;//++;
		   echo "</tr>";
		
	
	 }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
    //echo $totalamt;
	echo '<td>'.'<input type="text" name="totalamt[]" id="totalamt"   value="'.$amt_total[$jjj].'" readonly="readonly" size="20"/>'.'</td>';
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td><input type='button' id='tms_submit_btn' value='Save Changes' onclick='control_tms_form(this.value)'  $attribute /></td>";
	echo "<td>".form_reset('myClear', 'Set Previous Value',$attribute)."</td>";
	echo "</tr>";
	
	echo "</table>";
	echo form_close();
	?>
 