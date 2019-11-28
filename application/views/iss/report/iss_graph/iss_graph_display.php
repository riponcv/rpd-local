<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ISS Graph Form</title>
<script src="<?php echo base_url();?>js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/highcharts.js"></script>
	
	<style type="text/css">
	.under_cons p {font-size:48px; color:#FF0000}
	.btn_line {}
	
    .btn_line ul{list-style-type:none;margin:0;padding:0;padding-top:6px;padding-bottom:6px;}
    
    .btn_line li{display:block;margin:40px 0;text-decoration:none}
    
    .btn_line #btn_:link, .btn_line #btn_{ position: relative;
        font-weight:bold;background-color:#98bf21;text-align:center;padding:15px;text-decoration:none;text-transform:uppercase;}
    .btn_line #btn_:hover,.btn_line #btn_:active{ position: relative;
        background-color:#7A991A;}
    
    .btn_line #btn1_:link, .btn_line #btn1_{
        			    position: relative;
        			    float:left;
                            font-weight:bold;
                            color:#FFFFFF;
                            background-color:#98bf21;
                            text-align:center;
                            padding:15px;
                            text-decoration:none;
                            text-transform:uppercase;
                }
    .btn_line #btn_1:hover,.btn_line #btn1_{ position: relative;
        float:left;background-color:#7A991A;}
    
    .btn_line img#arrow_img{position:relative; float:left; padding-top:10px;left:30px;}

	</style>
</head>
<body>

    <table  align="right">
    <?php if(isset($link_param) && $link_param==1){ ?>
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
    <?php } ?>
    <?php if(isset($link_param) && $link_param==0){ ?>
    <tr align="center"><th><a href="javascript:history.go(-2);">View Another Report</a></th></tr>
    <?php } ?>
    </table>

    <table  align="center">
    <tr align="center"><th>ISS Graph</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center">
    <th>
    <?php if(isset($report_of_date3) && $report_of_date3 !=''){ ?>
    ISS Graph Of: <?php echo isset($report_of_date1)?$report_of_date1:''; echo '  to  '; echo isset($report_of_date3)?$report_of_date3:''; ?>
    <?php }else{ ?>
    ISS Graph Of: <?php echo isset($report_of_date1)?$report_of_date1:''; echo '  to  '; echo isset($report_of_date2)?$report_of_date2:''; ?>
    <?php } ?>
    </th>
    </tr>
    </table>
    <br /><br />
	
	<?php
	
	?>
	<div id="g_render"  class="left">
	<?php if (isset($charts)) 
	{
	echo $charts;
	echo '<div class="btn_line">';
	echo "<ul>";
    echo "<li>";
    ?>
	<div style="Position:relative; margin: 0 auto; text-align: center; width:448px; height:auto;">
    <?php
	
    $attribute='id="btn_"';
    $attribute1='id="btn1_"';
    echo form_open('iss/iss_form_2_itemwise_report_details/'.$link_param);
    if(isset($previous_value) && !empty($previous_value))
    {
        foreach($previous_value as $key=>$val)
        {
            if()
			?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
            <?php
        }
    }
    echo form_button('title_button', $graph_title,$attribute1);
    echo '<img src="'.base_url().'/img/single_arrow2.png" id="arrow_img">';
    echo form_submit('actionbtn', $link_str, $attribute);
    echo form_close(); ?>
    </div>
  <?php  
    echo "</li>";
    echo "</ul>";
    echo '</div>';

	} 
		else {	
	?>
	<div class="under_cons">
	  <p>
	   No Data Found
       </p>
	</div>
	<?php }?>
</div>
</body>
</html>
