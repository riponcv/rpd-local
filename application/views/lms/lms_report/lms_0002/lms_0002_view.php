   	
<script type="text/javascript">
var casecat1 = new Array;  
//var casecat2 = new Array;  
var casecat3 = new Array; 
<?php
if(isset($categorytest) && !empty($categorytest)){
    foreach($categorytest as $categorytestSin){?>
        casecat1[<?php echo $categorytestSin->lmcc_cc_id_l1; ?>] = "<?php echo $categorytestSin->lmcc_cc_desc_l1; ?>";
  //      casecat2[<?php //echo $categorytestSin->lmcc_cc_id_l2; ?>] = "<?php //secho $categorytestSin->lmcc_cc_desc_l2; ?>";
        casecat3[<?php echo $categorytestSin->lmcc_cc_id_l3; ?>] = "<?php echo $categorytestSin->lmcc_cc_desc_l3; ?>";
    <?php    
    }    
}
?>

window.onload = function() {
    var cc1V = document.getElementById("CC1ID");
    var cc2V = document.getElementById("CC2ID");

        cc1V.options.length=0;
        cc1V.options[0] = new Option('--Select Court--', '0');
        var i =1;
        casecat1.map((val, key)=>{
            if(val != '' && key !=''){
                cc1V.options[i++] = new Option((val), key);
            }   
        }); 

}
function cc1_select(){

    var cc1V = document.getElementById("CC1ID");
    var cc2V = document.getElementById("CC2ID");
    var cc1VSelectedValue = cc1V.options[cc1V.selectedIndex].value;
       
        cc2V.options.length=0;
        cc2V.options[0] = new Option('--Select Case--', '0');
        var i =1;
        casecat3.map((val, key)=>{
        if (cc1VSelectedValue == (key).toString().charAt(0)){
            if(val != '' && key !=''){
                cc2V.options[i++] = new Option((val), key);
            }   
            }
        }); 
}

    jQuery(document).ready(function() {
       var report_option_selector = jQuery('#report_option_selector').val();
       report_option_selector
       
        if(report_option_selector>0)
        {
            control_lms_0001_report_form(report_option_selector);
        }
       
   })   
</script>

<div class="container">   
    <?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Case Wise Report</th></tr></table>";
    echo "</table>";  

    ?>
    <table  align="right">
    <tr align="right"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>
    <?php
    echo form_open('lms/lms_0002_report_details','id="lms_0002_search_form"');
    
    echo '<div id="report_option_div" style="margin-top:50px; margin-left:27%">';
    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo '<font style="color:brown;font-weight: bold;">Case Wise Report For: </font>';
    echo '</td>';
    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']==$val)
	{
		$select = "selected='selected'";
	}
    
    $br_disable_status='';
    $ao_disable_status='';
    $do_disable_status='';
    
    if($login_office_status==4){$br_disable_status='disabled="disabled"';}
    if($login_office_status==3){$ao_disable_status='disabled="disabled"';}
    if($login_office_status==2){$do_disable_status='disabled="disabled"';}
    echo '<td>';
    echo '<select name="report_option_selector" id="report_option_selector" onchange="control_lms_0001_report_form(this.value)">';
    echo '<option value="0">Select option</option>';
    echo '<option value="1">My Office Report</option>';
    echo '<option value="2">Branch Report</option>';
    echo '<option value="3" '.$br_disable_status.'>Area Office Report</option>';
    echo '<option value="4" '.$br_disable_status.' '.$ao_disable_status.'>Divisional Office Report</option>';
    echo '<option value="5" '.$br_disable_status.' '.$ao_disable_status.' '.$do_disable_status.'>Whole Bank Report</option>';
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    echo '<table>';
    echo '</div>';
	?>
   
   <table border="1" style="margin-top: 50px; display:none" id="search_form_table">
    <tr>
    <th COLSPAN="3">
         <h3 style="color: green;">FILL FORM FOR REPORT</h3>
    </th>
    </tr>
    <tr>
        <td>Report Of</td>
        <td>Month
            <select name="report_of_month" id="report_of_month">
                <option value="">Select month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </td>
        <td>Year
            <select name="report_of_year" id="report_of_year">
                <option value="">Select year</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Select Case/Suit</td>
        <td colspan="">
            <select class="courtT form-control"  id='CC1ID' name='CC1N' onChange="cc1_select()"></select>
        </td>
        <td colspan="">
            <select class="courtT form-control"  id='CC2ID' name='report_of_case'></select>
        </td>
    </tr>
    <tr id="report_of_br_ao_do_div_box">
    <td>Search Required Office</td>
    <td COLSPAN="3"><input type="text" style="width:100%" name="search_text" id="search_text" value="" onkeyup="fetch_br_ao_do_report_lms(this.value)"/></td>
    </tr>
    
    <tr id="report_of_br_ao_do_div_msg">
        <td COLSPAN="3">
            <h6 style="color: red;">Type on search box to get desired office </h6>
        </td>
    </tr>
    </tr>
    <tr id="report_of_br_ao_do_div">
        <td COLSPAN="3">
            <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_lms_0002(this.value)"/>
        </td>
    </tr>
    </table> 

    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />

    <input type="hidden" name="off_id" id="off_id" value="<?php echo $off_id; ?>" />
    <?php echo '</form>'; ?>
</div>    
 