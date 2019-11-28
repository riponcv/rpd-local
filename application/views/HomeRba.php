<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php if(isset($marquee_item) && $marquee_item !='' && isset($is_marquee_on) && $is_marquee_on==1 && isset($content) && $content=='home/logout'){ ?>http-equiv="refresh" content="600"<?php  } ?>
<title>RPD Data Entry Portal</title>
<link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>assetsLms/img/favicon.png"/>
<link rel="stylesheet" href="<?php echo base_url();?>assetsLms/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo base_url();?>mystyle/home.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assetsLms/css/lmscss.css" rel="stylesheet" type="text/css" />

</head>
<body>
<header class="">
	<div class="ulockd-header-middle">
  		<div class="container">
  			<div class="row">
  				<div class="col-xs-12 col-sm-5 col-md-5">
					<div class="ulockd-contact-info text-left">
						
						<div class="ulockd-info">
							<h4><?php if(isset($uid)) {echo 'User Name :'.$uid; } else {echo ''; } ?></h4>
							<h4><?php if(isset($txt_office_name)) {echo 'Office Name :'.$txt_office_name;}  else {echo '';} ?></h4>
						</div>
					</div>
  				</div>
  				<div class="col-xs-12 col-sm-4 col-md-4">
  					<div class="logo-hmddl text-center">
						<h2>Janata Bank Limited</h2>
						<p>Management Information System Department</p>
						
  					</div>  					
  				</div>
  				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="ulockd-ohour-info text-right">
						<div class="ulockd-info">
							<h3><?php if(isset($uid)) {echo 'Entry Date :'.$dat_entry_date; } else { '';} ?></h3>
						</div>
					</div>
  				</div>
  			</div>
			
  		</div>
</div>	
		<div class="pos-fixed">
			<div class="container">
				<div class="row dropdown-area">
					
						<div class="dropdown">
                  <?php echo anchor('rpd/home', 'Home', array('class' => 'dropbtn')); ?>
						</div>
				
                  <div class="dropdown">                
                     <?php echo anchor('rba/rba_report_0001', 'RBA Report', array('class' => 'dropbtn')); ?>
                  </div>

                   <div class="dropdown">
                     <button class="dropbtn">Other Link</button>
                        <div class="dropdown-content">
                           <?php echo anchor('rpd/omis/2', 'OMIS'); ?>
                           <?php echo anchor('tms/index/3', 'TMS'); ?>
                           <?php echo anchor('report/index/4', 'REPORT'); ?>
                           <?php echo anchor('weekly_position/index/5', 'Weekly Position'); ?>
                           <?php echo anchor('rei/index/8', 'ISS'); ?>
                        </div>
                  </div>
                  
						<div class="dropdown">
                     <?php echo anchor('auth_user/loged_out', 'Log-Out', array('class' => 'dropbtn')); ?>
						</div>
				</div>
			</div>	
		</div>
</header>
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
<?php $this->load->view('home/footerLms'); ?>
<script src="<?php echo base_url();?>assetsLms/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assetsLms/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assetsLms/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assetsLms/js/mainrba.js"></script>
</body>
</html>                            