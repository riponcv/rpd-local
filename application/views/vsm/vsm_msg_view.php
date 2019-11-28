<table border="1" style="margin-top: 75px;">
<tr style="font-size: large;font-weight: bold;">
<?php 
$content_style='';
if(isset($msg_type) && $msg_type==1){$content_style='style="color: green;"';}
if(isset($msg_type) && $msg_type==2){$content_style='style="color: red;"';}
?>
<td <?php echo $content_style; ?>><?php echo isset($msg_content)?$msg_content:''; ?></td>
</tr>
</table>