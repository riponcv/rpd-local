
<h3 align="center" style="color:#000066"><?php echo 'Assalamualaikum, '.$uid.' ';?> <br /> </h3> Welcome to the portal of <br /> <h2  style="text-align:center; font-weight:bolder;color:#990066"><?php echo isset($module_name) ? $module_name : ' Management Information System Department ' ; ?></h2>


<?php  if (!isset($module_name)) {?> 


<ul id="leftmenu"  style="width:300px">
<?php foreach($mainmenuArray as $rw){ ?>
<li><?php echo anchor( $rw->cMnu_Called_Obj.'/'.$rw->cMnu_ID, $rw->cMnu_Des); ?></li>
<?php
} ?>

<?php
$office_id = $this->session->userdata('some_office');
$uid = $this->session->userdata('some_uid');

// if((rtrim(ltrim($office_id)) == '0512' && rtrim(ltrim($uid)) == 'Test-0512') || (rtrim(ltrim($office_id)) == '9024' && rtrim(ltrim($uid)) == 'AGM-1124') || (rtrim(ltrim($office_id)) == '9024' && rtrim(ltrim($uid)) == 'po-5362')){
//     echo anchor('lms/lms/20', 'LAWSUIT MANAGEMENT SYSTEM (LMS)');
// }
?>
<li><img src="<?php echo base_url();?>img/pulselin.gif"  width="300" height="20"> </li>

<?php
//Upload Portal Server
$file_no=$this->session->userdata('some_uid');
$off_id=$this->session->userdata('some_office');
$url_u_portal="http://203.76.102.169/cl/selection.aspx?file=$file_no&brcd=$off_id";
$attr_u_portal="target='_blank'";
?>

<li><?php echo anchor($url_u_portal, 'Upload Portal Server',$attr_u_portal); ?> </li>

<?php
/*
$url_csr="http://www.janatabank-bd.com/csr/csr.html";
$attr_csr="target='_blank'";*/
?>
<!--<li><?php echo anchor($url_csr, 'CSR',$attr_csr); ?> </li>-->

<?php
/*
$url_ws="http://203.76.102.169:8033/janatabank/";
$attr_ws="target='_blank'";
*/
?>
<!--<li><?php echo anchor($url_csr, 'UPCOMING WEBSITE',$attr_ws); ?> </li>-->


<?php

$url_cas="http://203.76.102.164:8080/survey?file=$file_no&brcd=$off_id";
$attr_cas="target='_blank'";

?>
<?php echo anchor($url_cas, 'COMMAND AREA SURVEY',$attr_cas); ?> </li>


<li><?php echo anchor('auth_user/profile_setting_form', 'Profile Setting'); ?> </li>
<li><?php echo anchor('rpd/help', 'Download Related Circular/Guideline'); ?> </li>
<li><?php echo anchor('auth_user/loged_out', 'Logout');?></li>
</ul>

<?php

}
else
{
?>

<ul id="leftmenu">
</ul>
<?php
}
?>
