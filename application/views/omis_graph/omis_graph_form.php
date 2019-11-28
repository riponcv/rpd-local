<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Omis Graph Form</title>
<script src="<?php echo base_url();?>js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/highcharts.js"></script>
	
	<style type="text/css">
	.under_cons p {font-size:48px; color:#FF0000}
	.btn_line {}
	
.btn_line ul{list-style-type:none;margin:0;padding:0;padding-top:6px;padding-bottom:6px;}

.btn_line li{display:block;margin:40px 0;text-decoration:none}
.btn_line a:link, .btn_line a:visited{font-weight:bold;color:#FFFFFF;background-color:#98bf21;text-align:center;padding:15px;text-decoration:none;text-transform:uppercase;}
.btn_line a:hover,.btn_line a:active{background-color:#7A991A;}

	</style>
</head>
<body>
<?php echo form_open(); ?>


<div id="g_render"  class="left">
	<?php if (isset($charts)) 
	{
	echo $charts;
	echo '<div class="btn_line">';
	echo "<ul>";
echo "<li>";
 
if ($param==1){
echo anchor('http://203.76.102.169:8033/rpd/index.php/rpd/omis_graph_test/2', 'Bar Graph');
}
if ($param==2){
echo anchor('http://203.76.102.169:8033/rpd/index.php/rpd/omis_graph_test/1', 'Line Graph');
echo '</div>';
}

echo "</li>";
echo "</ul>";

	} 
		else{	
	?>
	<div class="under_cons">
	  <p>
	   ..Under Construction.
       </p>
	</div>
	<?php }?>
</div>
<div class="btn_line">
<?php 
?>
</div>
<?php echo form_close(); ?>
</body>
</html>
