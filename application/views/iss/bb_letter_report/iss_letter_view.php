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
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS letter Information Monitoring System</th></tr></table>";

    echo form_open_multipart('iss/', 'id="iss_letter_view"'); ?>
	
    <table border="1" style="margin-top: 50px;" id="search_form_table">
     <tr>
		<td style="height:30px; text-align:center"><?php echo anchor('iss/iss_bb_letter_report_view', 'Branch Letter Information Entry'); ?></td> 
	</tr>
	<tr>
		<td style="height:30px; text-align:center"><?php echo anchor('iss/iss_bb_letter_report_search_view', 'Branch Letter Search'); ?></td>
	</tr>
	 
    </table>
   <?php echo form_close(); ?>
    
 