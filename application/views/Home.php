<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"
<?php if(isset($marquee_item) && $marquee_item !='' && isset($is_marquee_on) && $is_marquee_on==1 && isset($content) && $content=='home/logout'){ ?>http-equiv="refresh" content="600"<?php  } ?>/>
<title>RPD Data Entry Portal</title>
<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo base_url();?>mystyle/smoothness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/home.css" rel="stylesheet" type="text/css" />
</head>
<body onload="initbody()">
<div id="divwrapper">
    <div id="dvtop"><?php (isset($vwtop))?$this->load->view($vwtop) : $this->load->view('home/top'); ?></div>
    <?php if(isset($marquee_item) && $marquee_item !='' && isset($is_marquee_on) && $is_marquee_on==1 && isset($content) && $content=='home/logout'){ ?>
    <?php echo $marquee_item; ?>
    <?php } ?>

	<div id="dvleft">
	<?php if (isset($uid)){  
		$this->load->view('home/leftsecure');  }
		else{
			$this->load->view('home/left');
		}
	?>
	</div>
     <div id="<?php echo isset($isde)? $isde : 'dvcontent' ;?>" align="center">

	 <?php //(isset($content))?$this->load->view($content) : $this->load->view('home/defcontent') ;  ?>
     <?php
     if(isset($option) && $option=='reg_me')
     {
        echo $content;
     }
     else
     {
        (isset($content))?$this->load->view($content) : $this->load->view('home/defcontent') ;
     }
     ?>
	 </div>
    <div id="dvright"><?php $this->load->view('home/right'); ?></div>
    <br id="clear"/>
    <div id="dvfooter"> <?php $this->load->view('home/footer'); ?> </div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/datasum.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/ajax_post.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assetsLms/js/mainrba.js"></script>
<script type="text/javascript">
    $(function() {
        $( "#datepicker" ).datepicker();
    });
</script>

</body>
</html>
