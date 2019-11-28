<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php if(isset($marquee_item) && $marquee_item !='' && isset($is_marquee_on) && $is_marquee_on==1 && isset($content) && $content=='home/logout'){ ?>http-equiv="refresh" content="600"<?php  } ?>
<title>RPD Data Entry Portal</title>
<link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>assetsLms/img/favicon.png"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsLms/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>assetsLms/css/jquery.dataTables.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsLms/css/dataTables.bootstrap4.css">

<link href="<?php echo base_url();?>mystyle/home.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assetsLms/css/lmscss.css" rel="stylesheet" type="text/css" />

</head>
<body>
<header>
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
				<div class="col-lg">
					<div class="dropdown">
                  		<?php echo anchor('rpd/home', 'Home', array('class' => 'dropbtn')); ?>
					</div>
					<?php if(isset($off_id) && ($off_id == '9024' || $off_id == '9025')){ ?>
					<div class="dropdown">
						<button class="dropbtn">Master Data</button>
						<div class="dropdown-content">
							<a href=" <?php echo base_url().'index.php/lms/master_data_view?p=1'?>"><span>Court Type</span></a>
							<a href="<?php echo base_url().'index.php/lms/master_data_view?p=2'?>"><span>Case Category</span></a>
							<a href="<?php echo base_url().'index.php/lms/master_data_view?p=3'?>"><span>Lawyer Information</span></a>
							<a href="<?php echo base_url().'index.php/lms/master_data_view?p=4'?>"><span>Current Status</span></a>
							<a href="<?php echo base_url().'index.php/lms/master_data_view?p=5'?>"><span>Expense Type</span></a>
							<a href="<?php echo base_url().'index.php/lms/master_data_view?p=6'?>"><span>Disposal Nature</span></a>

							<a href="<?php echo base_url().'index.php/lms/lms_user_view'?>"><span>User Information</span></a>
						</div>
					</div>
					<?php } ?>
					<div class="dropdown">
						<button class="dropbtn">Entry</button>
						<div class="dropdown-content">
							<?php echo anchor('lms/lms_basic_entry_maker', 'LMS Basic Entry'); ?>
							<?php echo anchor('lms/lms_present_posotion_entry_view', 'LMS Present Position Entry'); ?>
							<?php echo anchor('lms/lms_recovery_entry_view', 'LMS Recovery Entry'); ?>
							<?php echo anchor('lms/lms_expense_entry_view', 'LMS Expense Entry'); ?>
							<?php echo anchor('lms/lms_writeoff_entry_view', 'LMS Write Off Entry'); ?>
							<?php echo anchor('lms/lms_disposal_entry_view', 'LMS Disposal Entry'); ?>
							<?php //echo anchor('lms/get_api', 'LMS Get Api'); ?>
						</div>
					</div>
					<div class="dropdown">
						<button class="dropbtn">Edit</button>
						<div class="dropdown-content">
							<?php echo anchor('lms/lms_os_edit_view', 'Outstanding Edit'); ?>
							<?php echo anchor('lms/lms_lawyer_edit_view', 'Lawyer Edit'); ?>
							<?php echo anchor('lms/lms_security_edit_view', 'Security Amount Edit'); ?>
							<?php echo anchor('lms/lms_fkeep_edit_view', 'File Keeper Edit'); ?>
						</div>
					</div>
					<div class="dropdown">
						<button class="dropbtn">Report</button>
						<div class="dropdown-content">
							<?php echo anchor('lms/lms_0001', 'Summary Report-1'); ?>
							<?php //echo anchor('lms/lms_0004', 'Summary Report-2'); ?>
							<?php echo anchor('lms/lms_0004', 'Periodic Report'); ?>
							<?php echo anchor('lms/lms_0002', 'Case Wise Report'); ?>
							<?php echo anchor('lms/lms_0003', 'Single Case Wise Details Report'); ?>
						</div>
					</div>
					<div class="dropdown">
						<?php echo anchor('lms/lms_0005', 'Follow-up', array('class' => 'dropbtn')); ?>
					</div>
					<div class="dropdown">
						<?php echo anchor('lms/lms_guideline', 'Guideline', array('class' => 'dropbtn')); ?>
					</div>
					<div class="dropdown">
						<?php echo anchor('lms/lms_contactInfo', 'Contact Info', array('class' => 'dropbtn')); ?>
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
						<?php echo anchor('auth_user/loged_out', 'Log out', array('class' => 'dropbtn')); ?>
					</div>
				</div>
			</div>	
		</div>
	</div>	
</header>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php
				if(isset($option) && $option=='reg_me'){
					echo $content;
				}else{
					(isset($content))?$this->load->view($content) : $this->load->view('home/defcontent') ;
				}
			?>
		</div>
	</div>
</div>

<?php $this->load->view('home/footerLms'); ?>

<script src="<?php echo base_url();?>assetsLms/js/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assetsLms/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>assetsLms/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assetsLms/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assetsLms/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assetsLms/js/dataTables.bootstrap4.js"></script>


<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/ajax_post.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assetsLms/js/mainlms.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assetsLms/js/app-test.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assetsLms/js/mainrba.js"></script>
</body>
</html>                            