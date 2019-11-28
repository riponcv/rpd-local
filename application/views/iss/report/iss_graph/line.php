  <?php 

$array_v = json_decode(json_encode($form2_iss_item_data), True);

$M = 0 ;
$temp_date = '';
foreach ($array_v as $value) {
	$temp_date = $array_v[$M][0]['report_date']; 
	$array_date[] = "'$temp_date'"; 
	foreach($value as $sinv)
	{
		$array_amt[] = $sinv['AMOUNT_BDT'];
		$array_date[] = $sinv['AMOUNT_BDT'];
		$bal_sin = count($sinv);
	}
	$bal_value = count($value);
	$M++;
}?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
				 ['Month', 
							<?php for($aa=0; $aa < $bal_value; $aa++ )
							{
								echo "'";
								echo $array_v[0][$aa]['COA_DESCRIPTION'];
								echo "'";
								if($aa != ($bal_value-1)){echo ", ";}
							} ?>],
						<?php $ast_count = 1; 
						$ast_count_initia = 0; 
						foreach($array_date as $ast)
						{
							if($ast_count_initia++ == 0){echo "[";}
							echo isset($ast) ? $ast:0;
							if($ast_count != $bal_value+1 ){echo ", ";}
							if($ast_count == $bal_value+1 )
							{
								echo "]"; 
								if( count($array_date) != $ast_count_initia && $ast_count == $bal_value+1){ echo ", "; }
								$ast_count = 0;
								if( count($array_date) != $ast_count_initia){ echo "["; }
							}
							$ast_count++;	
						} ?>]);

        var options = {
			title: 'ISS Form 2 item graph',
			vAxis: {title: 'Amount in BDT'},
			hAxis: {title: 'Reporting date'},
			curveType: 'function',
			legend: { position: 'right' }
        };

       
      }
    </script>
	
	<style type="text/css">
	
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
    .btn_line #btn_1:hover,.btn_line #btn1_{ 
		position: relative;	
        margin-left: 160px;
		background-color:#7A991A;
	}
    .btn_line {
		margin-bottom: 10px;
	}
    .btn_line img#arrow_img{position:relative; float:left; padding-top:10px;left:30px;}
	
	</style>


    <div id="curve_chart" style="width: 900px; height: 500px"></div>
	<div class="btn_line">
	<?php
		$attribute='id="btn_"';
		$attribute1='id="btn1_"';
		echo form_open('iss/iss_form_2_itemwise_report_details/'.$link_param);
		
		echo form_button('title_button', $graph_title,$attribute1);
		echo '<img src="'.base_url().'/img/single_arrow2.png" id="arrow_img">';
		echo form_submit('actionbtn', $link_str, $attribute);
		
		if(isset($previous_value) && !empty($previous_value))
		{
			foreach($previous_value as $key=>$val)
			{
				?>
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
				<?php
			}
		}
		
		echo form_close(); 
	?>
	</div>

