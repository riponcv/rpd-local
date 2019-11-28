<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo isset($report_details->report_title)?$report_details->report_title:'OMIS User Login History Report'; ?></title>
<style>
.pagging { height:20px; padding:8px 10px; line-height:19px; color:#949494; }
.pagging a{ background:url(<?php echo base_url(); ?>/images/pagging.gif) repeat-x 0 0; height:20px; float:left; padding:0 8px; border:solid 1px #d5d5d5; text-decoration: none; color:#949494; margin-left:5px;  }
.pagging a:hover { border-color:#8c3521; background:#ba4c32; color:#fff; }
.pagging span{ float:left; margin-left:5px; padding-top:2px; }

.small-field, .button, .pagging a { -moz-border-radius:3px; -webkit-border-radius:3px; }
.left, .alignleft { float:left; display:inline; }
.right, .alignright { float:right; display:inline; }

.btn_ {}
</style>

</head>

<body>
<br/><br/><br/><br/>

<!--form for specific-->
<?php echo form_open('report/misd_0016_specific','id="misd_0016_specific_form"');  ?>
<input type="hidden" name="specific_history_show" id="specific_history_show" value="0" />
<input type="hidden" name="file_no" id="file_no" value="" />
<?php echo form_close(); ?>
<!--form for specific-->

<table align="center">
    <tr><td style="font-size: 20px"><?php echo isset($report_details->report_title)?$report_details->report_title.' Report':'User Login History Report'; ?></td> </tr>
</table>
<br/>
<br/>
<br/>
<?php
if(isset($all_user))
{
?>
<table border="1" align="right" style="margin-top: -115px;">
  <tr>
    <td width="50">Report</td>
    <td width="50"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="100">Printing Date </td>
    <td width="120"><?php echo date('d/m/y'); ?></td>
  </tr>
  <tr>
    <td width="100">Source </td>
    <td width="180">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>
<table border="1" aligh="center">
    
</table>
<table border="1" width="1000px">
    <tr>
        <tr><th colspan="4" BGCOLOR="#509EEE" style="font-weight: bold;text-align: center;">Search User</th></tr>
    </tr>
     <?php echo form_open('report/misd_0016');?>
    <tr>
        <td><strong>Search By Designation:</strong></td>
	
    <td>
      <?php 
      
	  $selected_designation='';
      $search_by_designation=$this->session->userdata('search_by_designation');
	  if(isset($search_by_designation))
	  {
	  	$selected_designation=$search_by_designation;
	  } 
	  ?>
      <?php echo form_dropdown('search_by_designation',$designation_dropdown,$selected_designation,'') ?>
      </td> 
   
   <td><strong>Search By Office:</strong></td>
	
    <td>
      <?php 
      
	  $selected_off_code='';
      $search_by_off_code=$this->session->userdata('search_by_off_code');
	  if(isset($search_by_off_code))
	  {
	  	$selected_off_code=$search_by_off_code;
	  } 
	  ?>
      <?php echo form_dropdown('search_by_off_code',$off_code_dropdown,$selected_off_code,'') ?>
      </td> 
    </tr>
    <tr>
        <td><strong>From:</strong></td>
		<?php 
		$from=$this->session->userdata('history_date_from'); 
		if($from !=''){$history_date_from=$from;}
		?>
		<td><input type="text" readonly="readonly" name="history_date_from" id="datepicker" size="15" style="background-color: #FFFFCC ;" value="<?php echo isset($history_date_from)?$history_date_from:'01-Jan-1900'; ?>"/></td> 
        <td><strong> To:</strong></td>
        <?php 
		$to=$this->session->userdata('history_date_to'); 
		if($to !=''){$history_date_to=$to;}
		?>
        <td><input type="text" readonly="readonly" name="history_date_to" id="datepicker1" size="15" style="background-color: #FFFFCC ;" value="<?php echo isset($history_date_to)?$history_date_to:date('d-M-Y'); ?>"/></td>
    </tr>
    
        
    <tr>
        <td><strong>Search By Name:</strong></td>
        <?php $search_by_name=$this->session->userdata('search_by_name'); ?>
        <td><input type="text" size="30" name="search_by_name" value="<?php echo isset($search_by_name)?$search_by_name:'' ?>"/></td>
        
        <td colspan="2" align="center">
            <?php
            $attribute='id="btn_"';
            $attribute='style="background-color: #96C52C; height=40px" ';
		    echo form_submit('actionbtn', 'Search',$attribute);
            echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
            echo form_submit('actionbtn', 'Reset',$attribute);
           ?>
        </td>
            

    </tr>
    
    
    <?php echo form_close(); ?>
</table>

<!-- Pagging -->
<br />
<div class="pagging">
<div class="left">Showing <?php echo isset($show_record_from)?$show_record_from:''; ?>-<?php echo isset($show_record_to)?$show_record_to:''; ?> of <?php echo isset($all_user_total)?$all_user_total:''; ?></div>
<?php if(isset($total_page) && $total_page>1) {?>
<div class="right">
        <a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url();?>index.php/report/misd_0016'">First</a>
<a href="javascript:void(0)" onclick="controlPagination_all_history(<?php echo $total_page.','.$current_page; ?>,'back')" >Previous</a>
<?php $iflast=$total_page-1; ?>
<span>Page <?php echo isset($current_page)?$current_page:''; ?> Of <?php echo isset($total_page)?$total_page:''; ?></span>
        <a href="javascript:void(0)" onclick="controlPagination_all_history(<?php echo $total_page.','.$current_page; ?>,'front')">Next</a>
<a href="javascript:void(0)" onclick="controlPagination_all_history(<?php echo $total_page.','.$iflast; ?>,'front')">Last</a>
</div>
<?php } ?>
</div>
<!-- End Pagging -->

<table border="1" width="1000px">
<tr><th colspan="6" BGCOLOR="#509EEE" style="font-weight: bold;text-align: center;">User with last login and logout time</th></tr>    
    <tr>
    <th>File No</th>
    <th>User Name</th>
    <th>Designation</th>
    <th>Office Name</th>
    <th>Last Login Time</th>
    <th>Last Logout Time</th>
    </tr> 
    <?php if(count($all_user)>0){ ?> 
    <?php foreach($all_user as $key=>$row){ ?> 
    <tr>
    <td align="center"><?php echo isset($row['file_no'])?$row['file_no']:''; ?></td>
    <?php $file_no_str="'".$row['file_no']."'"; ?>
    <td align="left"><a href="javascript:void(0)" onclick="show_specific_user_history(<?php echo $file_no_str; ?>)"><?php echo isset($row['ui_Full_Name'])?$row['ui_Full_Name']:''; ?></a></td>
    <td align="left"><?php echo isset($row['Dsg_Desc'])?$row['Dsg_Desc']:''; ?></td>
    <td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
    <td align="left"><?php echo isset($row['login_time'])?$row['login_time']:''; ?></td>
    <?php 
	if(isset($row['logout_time']) && $row['logout_time']!='1900-01-01 00:00:00')
    {
         ?> <td align="left"> <?php echo isset($row['logout_time'])?$row['logout_time']:''; ?> </td> <?php
       
    }
    else
    {
      ?> <td align="center"> <?php echo '--'; ?> </td> <?php
    }
     ?>
    </tr>
    <?php } ?> 
<?php }else{ ?> 
<tr><td align="center" style="background-color:red" colspan='6'><strong>No User Found</strong></td></tr>
<?php } ?> 
</table>

<?php } ?>
<br/>
</body>
</html>
