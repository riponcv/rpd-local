<div align="center">
<h1> Welcome</h1>
<h3><?php echo $msg; ?></h3>
<div id="after_registration"><h2><font color="maroon"><a>Do you want to continue?</a></font></h2>
 <?php echo form_open('auth_user/loged_out');?>
 <input type="submit" name="submit" value="Yes" />
 <?php echo form_close(); ?>
</div>
</div>