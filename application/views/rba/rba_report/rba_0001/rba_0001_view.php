<style>
div#report_option_div {
    margin-left: 320px;
}
</style>

<script type="text/javascript">
    jQuery(document).ready(function() {
       var report_option_selector = jQuery('#report_option_selector').val();
       report_option_selector
       
        if(report_option_selector>0)
        {
            control_rba_0001_report_form(report_option_selector);
        }
       
   });
</script>

<div class="container">   
    <?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Branch Wise RBA Report</th></tr></table>";
    echo "</table>";  
    ?>
    
    <?php
    echo form_open('rba/rba_0001_report_details','id="rba_0001_search_form"');?>   
    <div id="report_option_div" style="margin-top:50px">
    <?php
    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo '<font style="color:brown;font-weight: bold;">RBA Report For: </font>';
    echo '</td>';
    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']==$val)
	{
		$select = "selected='selected'";
	}
    echo '<td>';
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_rba_0001_report_form(this.value)">';
    echo '<option value="0">Select option</option>';
    if($login_office_status == 4){
        echo '<option value="1">My Office Report</option>';
    }
    echo '<option value="2">Branch Report</option>';
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    echo '<table>';
    
	?>

   <table border="1" style="margin-top: 50px; display:none" id="search_form_table">
    <tr>
    <th COLSPAN="6">
         <h3 style="color: green; text-align:center">FILL FORM FOR REPORT</h3>
    </th>
    </tr>
    <tr>
        <td>Report Of</td>
        <td>Month
            <select name="report_of_month1" id="report_of_month1">
                <option value="">Select month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">APril</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </td>
		
        <td>Year
            <select name="report_of_year1" id="report_of_year1">
                <option value="">Select year</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
            </select>
        </td>
		<td>to</td>
		<td>Month
            <select name="report_of_month2" id="report_of_month2">
                <option value="">Select month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">APril</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </td>
		
        <td>Year
            <select name="report_of_year2" id="report_of_year2">
                <option value="">Select year</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
            </select>
        </td>
    </tr>
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td COLSPAN="8"><input type="text" style="width:100%" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_report_rba(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
        <td COLSPAN="6">
            <h6 style="color: red;">Type on search box to get desired office </h6>
        </td>
    </tr>
    </tr>
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="8">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_rba_0001(this.value)"/>
    <!-- <input type="button" name="save_report_as_pdf" id="save_report_as_pdf" value="Save Report As PDF" style="background-color: #FF9900;" onclick="check_search_form_misd_0001(this.value)"/> -->
    </td>
    
    </tr>
    </table> 
</div>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />

    <input type="hidden" name="off_id" id="off_id" value="<?php echo $off_id; ?>" />
    <?php echo '</form>'; ?>
</div>    
 