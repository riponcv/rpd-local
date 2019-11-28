
<p>

<?php 
// start load instruction
    ?>
    <?php if(isset($instruction) && $instruction !=''){ ?>
    <table border="1" bgcolor="#E0E0E0">
    <tr style="color: red;"><th><?php echo $instruction; ?></th></tr>
    </table>
    <br/>
    <?php } ?>
   
<table align=center> 
 <tr>
 <td style="color:#FF0000;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">You are not allowed to fill this form.</td>
 </tr>
 </table>
   	<?php 

	echo form_open('');
	//echo form_open('rpd/delete_om_data');
	
	echo "<table  border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>";
	echo "Data As On Date";
	echo "</td>";
	echo "<td>";
	
	

	//echo "window.location.href=\''.base_url().'index.php/rpd/omis_view_form/this.value\'";
	echo '<select name="datdate" disabled="disabled">';
	echo '<option value="">Select Date</option>';

	$pre_selected=0;
    foreach($records3 as $row)
	{
	
		$select='';
		if(isset($_POST['datdate']))
		{
			$select="selected='selected'";
		}
        
      
	  echo '<option value="'.$row->om_dat_date.'" '.$select.'>'.$row->om_dat_date.'</option>';

	}
	echo '</select>';
    echo '<input type="hidden" name="pre_selected_date_decider" id="pre_selected_date_decider" value="'.$pre_selected.'" />';
	echo "</td>";
		
	echo "</tr>";
	echo "</table>";


	echo "<table  align=\"center\">"; 
	echo "</table>";
	echo "<div id='error'>";
    echo validation_errors(); 
	echo "</div>";
	echo "<table border=\"1\" align=\"center\">"; 
	echo "<tr>";
	echo "<td>"."<strong>"."SL. No "."<strong>"."</td>";
	echo "<td align='left' width='300'>"."<strong>"."Product Category "."<strong>"."</td>";
	echo "<td align='left' >"."<strong>"."Product "."<strong>"."</td>";
	echo "<td align='centers'>"."<strong>"."Amount in Taka"."<strong>"."</td>";
	echo "<td>"."<strong>"."No.of A/C "."<strong>"."</td>";
	echo "</tr>";
	
	$BB_i=0;
	foreach($records1 as $row5)
	{
	 $BB_B=$row5->om_id;
	 $BB[$BB_i++]=$BB_B;
	}
	
	 $count=1;
	 $z=0;
	 $last=0;
	 $total_count=0;
     $r=0;
	 $s=0;
	foreach($records2 as $row1)
	{
	   $co=0;
	    while($BB[$z]==$row1->pt_pg_id)
			{
			 if($last>0)
				{
					echo "<tr>";
					echo "<td>"." "."</td>";
					if($r==0)
					{
					echo "<td align='left' style='background-color:#A3FF85; color:blue;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;'>"."<strong>"."Must be equal to affairs figure"."</strong>"."</td>";
					$r++;
					}
					else if($s==0)
					{
					 echo "<td align='left' style='background-color:#A3FF85; color:blue; font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;'>"."<strong>"."Must be equal to affairs figure"."</strong>"."</td>";
					$s++;
					}
					else if ($row1->om_id==6)
					{
					 echo "<td align='left' style='background-color:#A3FF85; color:blue; font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;'>"."<strong>"."Must be equal to affairs figure"."</strong>"."</td>";
					}
					else
					{
					echo "<td>"."  "."</td>";
					}
					echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
					echo '<td>'.'<input type="text" name="totalamt[]" id="totalamt"  readonly="readonly" size="15"/>'.'</td>';
					echo '<td>'.'<input type="text" name="totalac[]" id="totalac" readonly="readonly" size="8"/>'.'</td>';
					echo "</tr>";
				// echo '<td>'.'<input type="text" name="amount_c[]"  size="15"/>'.'</td>';
				 }
				$last++;
				$z++;
				if(!isset($BB[$z])){$BB[$z]=0;}
			}
			$total_count++;	   
			  echo "<tr>";
			  echo "<td align='center'>".$count."</td>"; 
			  $A=$row1->pt_id;
			  echo "<input type='hidden' name='pt_id[]' size='15' value='$A'/>";
			  echo "<td align='left'>".$row1->om_id_des."</td>";
			  echo "<td align='left'>".$row1->pt_short_name."</td>";
			  echo '<td>'.'<input disabled="disabled" type="text" name="amount[]"  onKeyUp="displayOmisText()" value="'.set_value('amount[]').'" size="15"/>'.'</td>';
			  
			  
			  
			  echo '<td>'.'<input disabled="disabled" type="text" name="ac[]" onKeyUp="displayOmisText()" value="'.set_value('ac[]').'" size="8"/>'.'</td>';
			$co++;
		    $count++;
		   echo "</tr>";
		
	
	 }
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td align='left'>"."<strong>"."Total "."<strong>"."</td>";
	echo '<td>'.'<input type="text" name="totalamt[]" id="totalamt"   value="'.set_value('totalamt[]').'" readonly="readonly" size="15"/>'.'</td>';
	echo '<td>'.'<input type="text" name="totalac[]" id="totalac" value="'.set_value('totalac[]').'" readonly="readonly" size="8"/>'.'</td>';
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";
	echo "<td>"." "."</td>";

$attribute='disabled="disabled"';

	//echo "<td >"."Submit"."</td>";
	echo "<td>".form_submit('submit', 'Submit',$attribute)."</td>";
	echo "<td>".form_reset('myClear', 'Clear',$attribute)."</td>";
	echo "</tr>";
	
	echo "</table>";
	echo form_close();
	?>
 
 