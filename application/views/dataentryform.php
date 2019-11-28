<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery-1.5.1.min.js"></script>
<script language="javascript" src="<?php echo base_url();?>js/ajax_post.js"></script>
<title>RPD Data Entry Portal</title>
<link href="<?php echo base_url();?>mystyle/home.css" rel="stylesheet" type="text/css" />
</head>

<body onload="initbody()">

<div id="divwrapper">

    <div id="dvtop"><?php $this->load->view('home/top'); ?></div>
    <div id="dvleft">
	<?php if (isset($uid))
	{ ?>
    	<?php $this->load->view('home/leftsecure'); ?> 
	<?php }
	else{
	$this->load->view('home/left'); 
	}
	?>
	 </div>
    <div id="dvcontent_dataentry">
			
			<?php  (isset($content))?$this->load->view($content) : $this->load->view('home/defcontent') ; ?> 
	</div>
    <br id="clear"/>
    
   
</div>
</body>
</html>

