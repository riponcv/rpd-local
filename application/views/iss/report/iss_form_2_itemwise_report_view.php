   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_iss_2_form(report_option_selector);
        }
    });

	function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[2].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[2].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}
		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];

				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}

			}
			}catch(e) {
				alert(e);
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
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System Comparision Report</th></tr></table>";
    echo "</table>";

    echo form_open('iss/iss_form_2_itemwise_report_details','id="iss_item_search_form"');
	echo '<div id="report_option_div" style="margin-top:50px;">';
    echo '<font style="color:brown;font-weight: bold;">ISS Form 2 Itemwise Report For: </font>';
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
			 <h3 style="color: green;">FILL FORM FOR ISS FORM-2 ITEM WISE REPORT</h3>
		</th>
		<td>
			<INPUT type="button" style="font-size:12px; background-color:#1DBFAF; color: #fff; height:35px; border:none" value="Add New Item" onclick="addRow('search_form_table_n')" /></td>
			<td><INPUT type="button" style="font-size:12px; background-color:#DC143C; color: #fff; height:35px; border:none" value="Delete Item" onclick="deleteRow('search_form_table_n')" /></td>
		</tr>
		<tr>
			<td></td>
			<td>ISS Form-2 Item Of</td>
			<td COLSPAN="">
				<?php
					echo '<select name="report_of_iss2_item[]" id="report_of_iss2_item" style="width:555px;height:35px;font-size:18px">';
					echo '<option value=" ">Select ISS Form-2 Item</option>';
					foreach($form2_iss_item as $row_iss2item)
					{
						$select='';
						if(isset($_POST['report_of_iss2_item']) && $_POST['report_of_iss2_item']==$row_iss2item->SUPERVISION_COA_ID)
						{
							$select="selected='selected'";
						}
					  echo '<option value="'.$row_iss2item->SUPERVISION_COA_ID.'" '.$select.'>'.'('.$row_iss2item->SL.') '.$row_iss2item->COA_DESCRIPTION.'</option>';

					}
					echo '</select>';
				?>
			</td>
		</tr>
		<tr>
			<td><INPUT type="checkbox" name="chk"/></td>
			<td>ISS Form-2 Item Of <span style="color:red">Graph</span></td>
			<td COLSPAN="">
				<?php
					echo '<select name="report_of_iss2_item[]" id="report_of_iss2_item" style="width:555px;height:35px;font-size:18px">';
					echo '<option value=" ">Select ISS Form-2 Item</option>';
					foreach($form2_iss_item as $row_iss2item)
					{
						$select='';
						if(isset($_POST['report_of_iss2_item']) && $_POST['report_of_iss2_item']==$row_iss2item->SUPERVISION_COA_ID)
						{
							$select="selected='selected'";
						}
					  echo '<option value="'.$row_iss2item->SUPERVISION_COA_ID.'" '.$select.'>'.'('.$row_iss2item->SL.') '.$row_iss2item->COA_DESCRIPTION.'</option>';

					}
					echo '</select>';
				?>
			</td>
		</tr>
	</table>
	<table border="1" style="display: none;" id="search_form_table_iss2_1">
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
			<td>and/to</td>
			<td>
			<?php
				echo '<select name="report_of_date2" id="report_of_date2" style="height:35px;font-size:18px">';
				echo '<option value="">Select Date</option>';
				foreach($records3 as $row)
				{
					$select='';
					if(isset($_POST['report_of_date2']) && $_POST['report_of_date2']==$row->ISSEntryDate)
					{
						$select="selected='selected'";
					}
				  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';

				}
				echo '</select>';
				?>
			</td>
		</tr>
	 </table>
     <table border="1" style="display: none;" id="search_form_table_iss2_2">
		<tr id="report_of_br_ao_do_div_box">
			<td>Search Required Office</td>
			<td  COLSPAN="6"><input type="text" name="search_text" id="search_text" value="" size="65px" style="height:30px;font-size:18px" onkeyup="fetch_br_ao_do_iss_2_item(this.value)"/></td>
		</tr>

		<tr id="report_of_br_ao_do_div_msg">
			<td COLSPAN="6"><h6 style="color: red;">Type on search box to get desired office </h6></td>
		</tr>

		<tr id="report_of_br_ao_do_div">
			<td COLSPAN="6">
			<input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_iss_2_item(this.value)"/>
			<input type="button" name="comparion_graph" id="comparion_graph" value="Graph" style="background-color: #FF9900;" onclick="check_search_form_iss_2_item(this.value)"/>
			</td>
		</tr>

    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <!--<input type="hidden" name="report_of_iss2_item[]" id="report_of_iss2_item" value="0" />-->
    <?php echo '</form>'; ?>

