<div align="center">
<h1> Welcome</h1>
<?php echo $ui_Full_Name;?>
<h3> Your Registration has been Completed</h3>
<div id="after_registration"><h2><font color="maroon"><a>Do you want to continue?</a></font></h2>
 <?php echo form_open('auth_user/create');?>
 <input type="submit" name="submit" value="Yes" />
 <?php echo form_close(); ?>
</div>
</div>