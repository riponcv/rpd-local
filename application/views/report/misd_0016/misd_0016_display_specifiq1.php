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
<table  align="right">
    <tr align="right"><th><a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url();?>index.php/report/misd_0016'">Back to all user history</a></th></tr>
</table>
<br/><br/><br/><br/>

<table align="center">
   <?php if(isset($user_all_info) && !empty($user_all_info)){ ?> 
    <?php 
	if(isset($user_all_info['ui_PFile_No']) && $user_all_info['ui_PFile_No']=='MD-01')
	{
	$user_all_info['Dsg_Desc']='CEO & MD';
	}
	?>
    <tr><td align="center" style="font-size:25px; font-weight: bold"><?php echo isset($report_details->report_title)?$report_details->report_title.' Report':'OMIS User Login History Report'; ?></td></tr>
        <tr><td align="center">of</td></tr>
        <tr><td align="center"><?php echo isset($user_all_info['ui_Full_Name'])?$user_all_info['ui_Full_Name']:''; ?>(<?php echo isset($user_all_info['Dsg_Desc'])?$user_all_info['Dsg_Desc']:''; ?>)</td></tr> 
        <tr><td align="center"><?php echo isset($user_all_info['office_name'])?$user_all_info['office_name']:''; ?>(<?php echo isset($user_all_info['ui_Posting_Office_Code'])?$user_all_info['ui_Posting_Office_Code']:''; ?>)</td></tr>
		<tr><td align="center"><?php echo isset($all_user_total)?'Total Login: '.$all_user_total:''; ?></td></tr>
    <?php }?>
</table>
<br/>
<br/>
<br/>
<?php
if(isset($all_user))
{
?>
<table border="1" align="right" style="margin-top: -185px;">
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
<table border="1" width="895px">
    <tr>
        <tr><th colspan="5" BGCOLOR="#509EEE" style="font-weight: bold;text-align: center;">Search History By Date Range</th></tr>
    </tr>
     <?php echo form_open('report/misd_0016_specific');?>
    <tr>
        <td><strong>From:</strong></td>
		<?php 
		$from=$this->session->userdata('history_date_from_specific'); 
		if($from !=''){$history_date_from_specific=$from;}
		?>
		<td><input type="text" readonly="readonly" name="history_date_from_specific" id="datepicker" size="15" style="background-color: #FFFFCC ;" value="<?php echo isset($history_date_from_specific)?$history_date_from_specific:'01-Jan-1900'; ?>"/></td> 
        <td><strong> To:</strong></td>
        <?php 
		$to=$this->session->userdata('history_date_to_specific'); 
		if($to !=''){$history_date_to_specific=$to;}
		?>
        <td><input type="text" readonly="readonly" name="history_date_to_specific" id="datepicker1" size="15" style="background-color: #FFFFCC ;" value="<?php echo isset($history_date_to_specific)?$history_date_to_specific:date('d-M-Y'); ?>"/></td>
        <td>
            <?php
            $attribute='id="btn_"';
            $attribute='style="background-color: #96C52C; height=40px" ';
		   echo form_submit('actionbtn', 'Search',$attribute);
		   echo form_submit('actionbtn', 'Reset',$attribute);
           ?>
        </td>
    </tr>
    <?php echo form_close(); ?>
</table>

<table border="1" width="895px">
<tr><th colspan="6" BGCOLOR="#509EEE" style="font-weight: bold;text-align: center;">Login History of <?php echo isset($user_all_info['ui_Full_Name'])?$user_all_info['ui_Full_Name']:''; ?></th></tr>    
    <tr>
    <th>Login Time</th>
    <th>Logout Time</th>
    </tr> 
    <?php if(count($all_user)>0){ ?> 
    <?php foreach($all_user as $key=>$row){ ?> 
    <tr>
    <td align="center"><?php echo isset($row['login_time'])?$row['login_time']:''; ?></td>
    <td align="center"><?php 
    if(isset($row['logout_time']) && $row['logout_time']!='1900-01-01 00:00:00')
    {
         echo isset($row['logout_time'])?$row['logout_time']:'';
       
    }
    else
    {
       echo "--"; 
    }
     ?></td>
    </tr>
    <?php } ?> 
<?php }else{ ?> 
<tr><td align="center" style="background-color:red" colspan="3"><strong>No User Found</strong></td></tr>
<?php } ?> 
</table>

<!-- Pagging -->
<div class="pagging">
<div class="left">Showing <?php echo isset($show_record_from)?$show_record_from:''; ?>-<?php echo isset($show_record_to)?$show_record_to:''; ?> of <?php echo isset($all_user_total)?$all_user_total:''; ?></div>
<?php if(isset($total_page) && $total_page>1) {?>
<div class="right">
        <a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url();?>index.php/report/misd_0016_specific'">First</a>
<a href="javascript:void(0)" onclick="controlPagination_all_history_user(<?php echo $total_page.','.$current_page; ?>,'back')" >Previous</a>
<?php $iflast=$total_page-1; ?>
<span>Page <?php echo isset($current_page)?$current_page:''; ?> Of <?php echo isset($total_page)?$total_page:''; ?></span>
        <a href="javascript:void(0)" onclick="controlPagination_all_history_user(<?php echo $total_page.','.$current_page; ?>,'front')">Next</a>
<a href="javascript:void(0)" onclick="controlPagination_all_history_user(<?php echo $total_page.','.$iflast; ?>,'front')">Last</a>
</div>
<?php } ?>
</div>
<!-- End Pagging -->


<br/>
<?php } ?>
<br/>
</body>
</html>
