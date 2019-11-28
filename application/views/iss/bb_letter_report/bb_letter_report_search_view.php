   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_iss_form(report_option_selector);
        }
    })
    </script>

   	<?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System Letter Information System</th></tr></table>";
    echo "</table>";  

    echo form_open_multipart('iss/iss_bb_letter_display_form', 'id="iss_bb_letter_search_form"'); ?>
	<table><tr><td style="height:30px; text-align:center"><?php echo anchor('iss/iss_bb_letter_report_view', 'Branch Letter Information Entry'); ?></td></tr></table>
	
    <table border="1" style="margin-top: 50px;" id="search_form_table">
 	<tr >
		<td colspan="3" style="text-align:center"> <?php
		if($this->session->flashdata('success_br'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_br').'</font>'; 
    	echo "</div>";
    }
		?></td>
    </tr>
	
	<tr id="report_of_br_ao_do_div_msg">
		<td COLSPAN="2"><h6 style="color: red;text-align:center">Type on search box to get desired office </h6></td>
    </tr>
	
    <tr>
    <td>Search Required Office</td>
		<td><input type="text" name="search_text" id="search_text" value="" placeholder="Input here Branch name" onkeyup="fetch_br_ao_do_iss_2_bb_letter(this.value)" style="width:555px;height:35px;font-size:18px"/></td>
	</tr>
       
    <tr id="report_of_br_ao_do_div"> 
    <td COLSPAN="3">
    <input type="button" name="view_report" id="view_report" value="Search" style="background-color: #FF9900;" onclick="check_search_form_iss_bb_display_letter(this.value)"/>
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
   <?php echo form_close(); ?>
    
 