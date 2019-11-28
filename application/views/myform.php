<html>
<head>
<title>My Form</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('form/cr'); ?>

<h5>Username</h5>
<input type="text" name="ui_PFile_No" value="" size="50" />

<h5>Password</h5>
<input type="text" name="ui_Pwd" value="" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="passconf" value="" size="50" />

<h5>Email Address</h5>
<input type="text" name="ui_Email" value="" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>

