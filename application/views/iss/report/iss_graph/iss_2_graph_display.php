<?php
$array_v = json_decode(json_encode($form2_iss_item_data), True);
$M = 0 ;
$temp_date = '';
/*foreach ($array_v as $value) {
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
}*/
foreach ($array_v as $value) {
	$temp_date = $array_v[$M][0]['report_date'];
	$array_date[] = "'$temp_date'";
	foreach($value as $sinv)
	{
		if($sinv['COA_ID_VALUE'] !=2)
		{
			if(isset($fig_indication) && $fig_indication == 3)
			{
				$array_amt[] = $sinv['AMOUNT_BDT']/10000000;
				$array_date[] = $sinv['AMOUNT_BDT']/10000000;
			}
			elseif (isset($fig_indication) && $fig_indication == 2){
				$array_amt[] = $sinv['AMOUNT_BDT']/100000;
				$array_date[] = $sinv['AMOUNT_BDT']/100000;
			}
			else
			{
				$array_amt[] = $sinv['AMOUNT_BDT'];
				$array_date[] = $sinv['AMOUNT_BDT'];
			}
		}
		else
		{
			$array_amt[] = $sinv['AMOUNT_BDT'];
			$array_date[] = $sinv['AMOUNT_BDT'];
		}

		$bal_sin = count($sinv);
	}
	$bal_value = count($value);
	$M++;
}
$checked_1 = ''; $checked_2 = ''; $checked_3 = '';
 if(isset($fig_indication) && $fig_indication == 1 || $fig_indication == ''){ $checked_1 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 2){ $checked_2 = "checked='checked'"; }
 if(isset($fig_indication) && $fig_indication == 3){ $checked_3 = "checked='checked'"; }
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
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

<?php if($link_param == 1) { ?>
    	var options = {
    		<?php if(isset($fig_indication) && $fig_indication==3) { ?>
    			vAxis: {title: 'Amount in BDT(Crore)'},
    		<?php } ?>
    		<?php if(isset($fig_indication) && $fig_indication==2) {?>
    			vAxis: {title: 'Amount in BDT(Lac)'},
    		<?php } ?>
    		<?php if(isset($fig_indication) && $fig_indication==1 || $fig_indication=='') { ?>
    			vAxis: {title: 'Amount in BDT(Actual)'},
    		<?php } ?>
    			hAxis: {title: 'Reporting date'},
    			seriesType: 'bars',
    			series: {<?php echo $bal_value;?>: {type: 'line'}}
    		};
	var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
	<?php } ?>
	<?php if($link_param == 0){ ?>
	var options = {
		      <?php if(isset($fig_indication) && $fig_indication==3) {?>
		      vAxis: {title: 'Amount in BDT(Crore)'},
		      <?php } ?>
		      <?php if(isset($fig_indication) && $fig_indication==2) {?>
		      vAxis: {title: 'Amount in BDT(Lac)'},
		      <?php } ?>
		      <?php if(isset($fig_indication) && $fig_indication==1  || $fig_indication=='') {?>
		      vAxis: {title: 'Amount in BDT(Actual)'},
		      <?php } ?>
			hAxis: {title: 'Reporting date'},
			curveType: 'function',
			legend: { position: 'right' }
        };
		 var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
	<?php } ?>

  }
    </script>

	<style type="text/css">
	.btn_line ul {
		list-style-type:none;
		margin:0;
		padding:0;
		padding-top:6px;
		padding-bottom:6px;
	}

    .btn_line li {
		display:block;
		margin:40px 0;
		text-decoration:none
	}
    .btn_line #btn_:link, .btn_line #btn_{
		position: relative;
        font-weight:bold;
		background-color:#98bf21;
		text-align:center;
		padding:15px;
		text-decoration:none;
		text-transform:uppercase;
		margin-left: -300px;
		}
    .btn_line #btn_:hover,.btn_line #btn_:active{
		position: relative;
        background-color:#7A991A;
	}
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
		background-color:#7A991A;
		margin-left: 160px
		}

    .btn_line img#arrow_img {
		position:relative;
		float:left;
		padding-top:10px;left:30px;
	}
.btn_line {


}
div#chart_div {

}
	</style>


<table align="" class="right_align" style="margin-left: 550px; margin-top: 0px; display: block;">
		<tr align="">
			<td>Amount in BDT of</td>

		    <td><input type="radio" name="amt_fig" id="act_val" onclick="check_fig_indication_gr_iss2(this.value)" <?php  echo isset($checked_1) ? $checked_1: ' ';?> value="1"> Actual</td>
  			<td><input type="radio" name="amt_fig" id="lac_val" onclick="check_fig_indication_gr_iss2(this.value)" <?php echo isset($checked_2) ? $checked_2: ' '; ?> value="2"> Lac</td>
  			<td><input type="radio" name="amt_fig" id="crr_val" onclick="check_fig_indication_gr_iss2(this.value)" <?php echo isset($checked_3) ? $checked_3: ' '; ?> value="3"> Crore</td>
		</tr>
  	</table>

    <div id="chart_div"  style="width: 900px; height: 500px;"></div>
	<div class="btn_line">


	<?php

if($link_param==1)
	{
		if($fig_indication != $fig_indication_p)
		{
			$link_param = 0;

		}
	}
	else
	{
		if($fig_indication != $fig_indication_p)
		{
			$link_param = 1;

		}
	}

		$attribute='id="btn_"';
		$attribute1='id="btn1_"';
		echo form_open('iss/iss_form_2_itemwise_report_details/'.$link_param, 'id="iss_item_2_dis_gr_form"');
		if(isset($previous_value) && !empty($previous_value))
		{
			foreach($previous_value as $key=>$val)
			{
				if(is_array($val))
				{
					foreach($val as $s_val)
					{
						?>
						<input type="hidden" name="<?php echo $key."[]"; ?>" value="<?php echo $s_val; ?>"/>
						<?php
					}
				}
				else {
				?>
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
				<?php
				}
			}
		}
		echo form_button('title_button', $graph_title,$attribute1);
		echo '<img src="'.base_url().'/img/single_arrow2.png" id="arrow_img">';
		echo form_submit('actionbtn', $link_str, $attribute);
?>
		<input type="hidden" name="fig_indication_post" id="fig_indication_post" value="<?php echo isset($fig_indication) ? $fig_indication: ' '; ?>"/>

<input type="hidden" name="fig_indication_post_p" id="fig_indication_post_p" value="<?php echo isset($fig_indication) ? $fig_indication: ' '; ?>"/>

<?php echo form_close(); ?>
	</div>
