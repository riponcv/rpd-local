<table width="100%" id="top">
  <tr>
    <td width="28%" ><?php if(isset($uid)) {echo 'User Name :'.$uid; } else {echo ''; } ?> </td>
    <td width="9%" rowspan="2" align="right"><img src="<?php echo base_url();?>img/logo.jpg"  width="90" height="66"></td>
    <td width="31%"><h1 style="font-size:35px;text-align:center; font-weight:bolder;color:#0066FF"> Janata Bank Limited </h1></td>
    <td width="32%" align="left" ><div id="todaydt"> </div> </td>
  </tr>
  <tr>
    <td ><?php if(isset($txt_office_name)) {echo 'Office Name :'.$txt_office_name;}  else {echo '';} ?> </td>
   
    <td align="center">Head Office Management Information System Department </td>
    <td><?php if(isset($uid)) {echo 'Entry Date :'.$dat_entry_date; } else { '';} ?> </td>
  </tr>
  
 
</table>
