<script type="text/javascript">
function check_search_form_iss2_0002(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_date1').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_2_006_search_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_date1').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_2_006_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
</script>
	<style>
		table#search_form_table_iss2_1 {margin-left: -188px;}
		table#search_form_table_iss2_1 td {
			width: 170px;
		}
		table#search_form_table_iss2_1 select {
			width:  170px;
			border: none;
		}
		table#search_form_table_iss2_2 {
			margin-left: -188px;
			width: 707px;
		}
	</style>
   	<?php
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System(ISS) and PL 11 Items Cross Report</th></tr></table>";
    echo "</table>";

    echo form_open('iss/iss_2_006_report_details','id="iss_2_006_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px;">';
    echo '<font style="color:brown;font-weight: bold;">ISS Form-2 PL Cross Report For: </font>';
    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']==$val)
	{
		$select="selected='selected'";
	}
    //control option
    $br_disable_status='';
    $ao_disable_status='';
    $do_disable_status='';

    if($login_office_status==4){$br_disable_status='disabled="disabled"';}
    if($login_office_status==3){$ao_disable_status='disabled="disabled"';}
    if($login_office_status==2){$do_disable_status='disabled="disabled"';}

    echo '<select name="report_option_selector" id="report_option_selector" style="width: 480px; height:35px;font-size:18px" onchange="control_iss_form2_itemwise_report_form(this.value)">';
    echo '<option value="0">Select ISS report option</option>';
    echo '<option value="1">My Office Report</option>';
    echo '<option value="2">Branch Report</option>';
    echo '<option value="3" '.$br_disable_status.'>Area Office Report</option>';
    echo '<option value="4" '.$br_disable_status.' '.$ao_disable_status.'>Divisional Office Report</option>';
    echo '<option value="5" '.$br_disable_status.' '.$ao_disable_status.' '.$do_disable_status.'>Whole Bank Report</option>';
	echo '</select>';
    echo '</div>';
	?>

    <table border="1" style="margin-top: 50px;display: none;" id="search_form_table_n">
		<tr>
			<th COLSPAN="4">
			 <h3 style="color: green;">FILL FORM FOR ISS FORM-2 PL CROSS REPORT</h3>
		</th>
		
		</tr>
		
		<tr id="report_of_year_div">
			<td>Report Of Date</td>
			<td>
			<?php
				echo '<select name="report_of_date1" id="report_of_date1" style="height:35px;font-size:18px">';
				echo '<option value="">Select Date</option>';
				foreach($records3 as $row)
				{
					$select='';
					if(isset($_POST['report_of_date1']) && $_POST['report_of_date1']==$row->ISSEntryDate)
					{
						$select="selected='selected'";
					}
				  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';

				}
				echo '</select>';
				?>
			</td>
			
		</tr>

		<tr id="report_of_br_ao_do_div_box">
			<td>Search Required Office</td>
			<td  COLSPAN="6"><input type="text" name="search_text" id="search_text" value="" size="65px" style="height:30px;font-size:18px" onkeyup="fetch_br_ao_do_iss_2_item(this.value)"/></td>
		</tr>

		<tr id="report_of_br_ao_do_div_msg">
			<td COLSPAN="6"><h6 style="color: red;">Type on search box to get desired office </h6></td>
		</tr>

		<tr id="report_of_br_ao_do_div">
			<td COLSPAN="6">
			<input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_iss2_0002(this.value)"/>
			</td>
		</tr>		
	</table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>

