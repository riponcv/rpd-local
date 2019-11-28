
<?php  if (isset($menuArray)) { ?> 


<ul id="leftmenu">
<li ><?php echo anchor('rpd/home', 'HOME'); ?></li>
<?php foreach($menuArray as $rw){ ?>
<?PHP IF($rw->cIsPermitted==1  &&  $this->session->userdata('u_level')=='10') CONTINUE; ?>
<li><?php echo $rw->cMnu_Instance_ID==1 ?  anchor_popup( $rw->cMnu_Called_Obj, $rw->cMnu_Des,array()): anchor( $rw->cMnu_Called_Obj, $rw->cMnu_Des); ?></li>
<?php } ?>
<li><img src="<?php echo base_url();?>img/pulselin.gif" width="175" height="20" /> </li>

<!--Quick link start--->
<?php 
$quick_link=$this->session->userdata('quick_link');
if(isset($quick_link) && $quick_link>0)
{
    if($quick_link=='1')//cdms portal
    {
       ?><li><?php echo anchor('rpd/omis/2', 'OMIS');?></li><li><?php echo anchor('tms/index/3', 'TMS');?></li><li><?php echo anchor('report/index/4', 'REPORT');?></li><li><?php echo anchor('vsm/index/6', 'VSM');?></li><li><?php echo anchor('weekly_position/index/5', 'Weekly Position');?></li><li><?php echo anchor('rei/index/7', 'REI');?></li><li><?php echo anchor('rei/index/8', 'ISS');?></li><?php 
    }
    if($quick_link=='2')//omis portal
    {
       ?><li><?php echo anchor('rpd/dms/1', 'CDMS');?></li><li><?php echo anchor('tms/index/3', 'TMS');?></li><li><?php echo anchor('report/index/4', 'REPORT');?></li><li><?php echo anchor('vsm/index/6', 'VSM');?></li><li><?php echo anchor('weekly_position/index/5', 'Weekly Position');?></li><li><?php echo anchor('rei/index/7', 'REI');?></li><li><?php echo anchor('iss/index/8', 'ISS');?></li><?php 
    }
    if($quick_link=='3')//tms portal
    {
       ?><li><?php echo anchor('rpd/dms/1', 'CDMS');?></li><li><?php echo anchor('rpd/omis/2', 'OMIS');?></li><li><?php echo anchor('report/index/4', 'REPORT');?></li><li><?php echo anchor('vsm/index/6', 'VSM');?></li><li><?php echo anchor('weekly_position/index/5', 'Weekly Position');?></li><li><?php echo anchor('rei/index/7', 'REI');?></li><li><?php echo anchor('iss/index/8', 'ISS');?></li><?php
    }
    if($quick_link=='4')//report portal
    {
       ?><li><?php echo anchor('rpd/dms/1', 'CDMS');?></li><li><?php echo anchor('rpd/omis/2', 'OMIS');?></li><li><?php echo anchor('tms/index/3', 'TMS');?></li><li><?php echo anchor('vsm/index/6', 'VSM');?></li><li><?php echo anchor('weekly_position/index/5', 'Weekly Position');?></li><li><?php echo anchor('rei/index/7', 'REI');?></li><li><?php echo anchor('iss/index/8', 'ISS');?></li><?php 
    }
	if($quick_link=='5')//weekly position portal
    {
       ?><li><?php echo anchor('rpd/dms/1', 'CDMS');?></li><li><?php echo anchor('rpd/omis/2', 'OMIS');?></li><li><?php echo anchor('tms/index/3', 'TMS');?></li><li><?php echo anchor('vsm/index/6', 'VSM');?></li><li><?php echo anchor('report/index/4', 'REPORT');?></li><li><?php echo anchor('rei/index/7', 'REI');?></li><li><?php echo anchor('iss/index/8', 'ISS');?></li><?php 
    }
	if($quick_link=='6')//vsm portal
    {
       ?><li><?php echo anchor('rpd/dms/1', 'CDMS');?></li><li><?php echo anchor('rpd/omis/2', 'OMIS');?></li><li><?php echo anchor('tms/index/3', 'TMS');?><li><?php echo anchor('report/index/4', 'REPORT');?></li><li><?php echo anchor('weekly_position/index/5', 'Weekly Position');?></li><li><?php echo anchor('rei/index/7', 'REI');?></li><li><?php echo anchor('iss/index/8', 'ISS');?></li><?php 
    }
	if($quick_link=='7')//rei portal
    {
       ?><li><?php echo anchor('rpd/dms/1', 'CDMS');?></li><li><?php echo anchor('rpd/omis/2', 'OMIS');?></li><li><?php echo anchor('tms/index/3', 'TMS');?><li><?php echo anchor('report/index/4', 'REPORT');?></li><li><?php echo anchor('weekly_position/index/5', 'Weekly Position');?></li><li><?php echo anchor('vsm/index/6', 'VSM');?></li><li><?php echo anchor('iss/index/8', 'ISS');?></li><?php 
    }
	if($quick_link=='8')//iss portal
    {
       ?><li><?php echo anchor('rpd/dms/1', 'CDMS');?></li><li><?php echo anchor('rpd/omis/2', 'OMIS');?></li><li><?php echo anchor('tms/index/3', 'TMS');?><li><?php echo anchor('report/index/4', 'REPORT');?></li><li><?php echo anchor('weekly_position/index/5', 'Weekly Position');?></li><li><?php echo anchor('vsm/index/6', 'VSM');?></li><li><?php echo anchor('rei/index/7', 'REI');?></li><?php 
    }
}
?>

<!--Quick link end--->

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