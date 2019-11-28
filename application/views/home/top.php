

<div id="header" >
   <div class="left">
   			<?php if(isset($uid)) {echo 'User Name: '.$uid; } else {echo ''; } ?><br/>
   			<?php if(isset($txt_office_name)) {echo 'Office Name: '.$txt_office_name;}  else {echo '';} ?>
   </div>
   <div class="mid">
   			<img src="<?php echo base_url();?>img/logo_new.png"  width="90" height="66" style="padding-left:15px;">
            <h1 style="font-size:35px;text-align:Left; font-weight:bolder;color:#0066FF"> Janata Bank Limited </h1>
            <p style="color:#990066;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Management Information System Department </p>
   </div>
   <div class="right">
   			<?php if(isset($uid)) {echo 'Entry Date: '.$dat_entry_date; } else { '';} ?> 
   			<div id="todaydt"> </div> 
   </div>
</div>
<div id="clear"></div>