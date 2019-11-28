   	<script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_misd_0043_report_form(report_option_selector);
        }
    })
    </script>
       
    <?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>CIBTA Originating Outstanding</th></tr></table>";
    echo "</table>";  

    ?>
    <table  align="right">
    <tr align="right"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>
    <?php
    echo form_open('report/misd_0043_report_details','id="misd_0043_search_form"');
	?>
   <table border="1" style="margin-top: 50px;" id="search_form_table">
    <tr>
    <th COLSPAN="3">
         <h3 style="color: green;">FILL FORM FOR REPORT</h3>
    </th>
    </tr>

    <tr id="report_of_year_div">
    <td>Report Of :</td>
    <td>
    <?php
        echo "Year";
        //$year_array=array('2013','2014');
		$this->load->helper('base');
        $year_array=get_common_year();
        echo '<select name="report_of_year" id="report_of_year">';
        echo '<option value="">Select</option>';
    	foreach($year_array as $key=>$val)
    	{
    		$select='';
    		if(isset($_POST['report_of_year']) && $_POST['report_of_year']==$val)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$val.'" '.$select.'>'.$val.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    <td>
    <?php
        echo "Month";
        $month_array=array('01'=>'JANUARY','02'=>'FEBRUARY','03'=>'MARCH','04'=>'APRIL','05'=>'MAY','06'=>'JUNE','07'=>'JULY','08'=>'AUGUST','09'=>'SEPTEMBER','10'=>'OCTOBER','11'=>'NOVEMBER','12'=>'DECEMBER');
        echo '<select name="report_of_month" id="report_of_month">';
        echo '<option value="">Select</option>';
    	foreach($month_array as $key=>$val)
    	{
    		$select='';
    		if(isset($_POST['report_of_month']) && $_POST['report_of_month']==$key)
    		{
    			$select="selected='selected'";
    		}
    	  echo '<option value="'.$key.'" '.$select.'>'.$val.'</option>';
    
    	}
    	echo '</select>';
        ?>
    </td>
    </tr>
    
        
    <tr>
    <td id="error_msg" style="font-weight: bold;color: red;display: none;" colspan="3">
    </td>
    </tr>
    
    <tr id="report_of_br_ao_do_div">
    <td COLSPAN="3">
    <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_misd_0043(this.value)"/>
    <!--<input type="button" name="save_report_as_pdf" id="save_report_as_pdf" value="Save Report As PDF" style="background-color: #FF9900;" onclick="check_search_form_misd_0043(this.value)"/>-->
    </td>
    </tr>
    
    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <?php echo '</form>'; ?>
    
 