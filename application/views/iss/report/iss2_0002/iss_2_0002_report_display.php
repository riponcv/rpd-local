<?php
// echo "<pre>";
// print_r($iss_2_0002_data);
// die();
?>
<style>
table {
  table-layout: fixed;
  border-spacing: 0px;
}

td, th {
  padding-left: 5px;
  padding-right: 5px;
}

.tr_shaded:nth-child(even) {
  background: #e0e0e0;
}

.tr_shaded:nth-child(odd) {
  background: #ffffff;
}

.scrolly_table {
  white-space: nowrap;
  overflow: auto;
}

.fixed.freeze {
  z-index: 10;
  position: relative;
}

.fixed.freeze_vertical {
  z-index: 5;
  position: relative;
}

.fixed.freeze_horizontal {
  z-index: 1;
  position: relative;
}

.bg_ddd{background-color:#ddd}
.bg_c_ddd{background-color:#ddd; color:red}
.txt_style_td_full {
	background-color:white; font-weight: 700; text-align:center
}
</style>	

<table  align="right">
<tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table><br/><br/>
	
<?php
  
   if(isset($iss_2_0002_data) && count($iss_2_0002_data)>0)  { ?>

    <table  align="center">
    <tr align="center"><th>ISS Form-2 Cross Report(ISS, OMIS and Affairs)</th></tr>
    <tr align="center"><th><?php echo $report_of_office; ?></th></tr>
    <tr align="center"><th>Report of: <?php echo isset($report_of_date1)?$report_of_date1:''; ?></th></tr>
	<?php if(isset($login_office_status) && $login_office_status == 4) { ?>
		<tr align="left"><th>Bank ID: <?php echo 12; ?> Branch Code(BB): <?php echo isset($branch_id_bb)?$branch_id_bb:''; ?></th></tr>
	<?php } ?>

	<?php if(isset($completed_vs_total['total']) && $completed_vs_total['total']>1){ ?><tr align="center"><th>Reporting: <?php echo isset($completed_vs_total['completed'])?$completed_vs_total['completed']:'0'; echo '/'; echo isset($completed_vs_total['total'])?$completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
    </table>
	<div id="scrolling_table_2" class="scrolly_table scrolling_table_2" style="width:120%; max-height:550px">
	<table border="1">
	<tr>
		<td style="background-color:white; font-weight: 700" class="fixed freeze" rowspan='2' >SL. No.</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze" rowspan='2' >Branch Name (Phone No.)</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze_vertical" rowspan='2' ><span style="font-size:12px">Br. Code</span><br> (BB)</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze_vertical" rowspan='2' >Area Name</td>
		<td style="background-color:white; font-weight: 700" class="fixed freeze_vertical" rowspan='2' >Division Name</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='4'>Total Deposit</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='3'>No of Deposit A/C</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='4'>Total Loan Outstanding</td>
		<td class="txt_style_td_full fixed freeze_vertical" colspan='3'>No of Loan A/C</td>
	</tr>
	<tr>
		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Affairs</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>

		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>


		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Affairs</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>

		<td class="txt_style_td_full fixed freeze_vertical">ISS</td>
		<td class="txt_style_td_full fixed freeze_vertical">OMIS</td>
		<td class="txt_style_td_full fixed freeze_vertical">Status</td>
	</tr>
    <?php

		$co=1;
		foreach($iss_2_0002_data as $row1)
		{
			echo "<tr class='tr_shaded'>";
			echo "<td class='fixed freeze_horizontal' align='center'>".$co."</td>";
			echo "<td class='fixed freeze_horizontal' align='left'>";
				echo branch_name_resize($row1->brcode, $row1->branchname);
				echo $row1->OfficePhone;
			echo "</td>";
			echo "<td align='center'>".$row1->brcode."</td>";
			echo "<td align='left'>";
				echo area_name_resize($row1->brcode, $row1->znname);
			echo "</td>";
			echo "<td align='left'>";
			if($row1->bbbrcode=='0888'){ echo "JBCB";}	else{ echo $row1->dvname; }
			echo "</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Deposit_ISS) ? $row1->Total_Deposit_ISS: 0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Deposit_affair) ? $row1->Total_Deposit_affair : 0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Deposit_OMIS) ? $row1->Total_Deposit_OMIS : 0), 2)."</td>";
			if($row1->Deposit_check=="Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->Deposit_check) ? $row1->Deposit_check : '')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->Deposit_check) ? $row1->Deposit_check : '')."</td>";
			}

			echo "<td align='right'>".number_format(isset($row1->No_of_Deposit_ACC_ISS) ? $row1->No_of_Deposit_ACC_ISS:0)."</td>";
			echo "<td align='right'>".number_format(isset($row1->Number_of_Deposit_OMIS)?$row1->Number_of_Deposit_OMIS:0)."</td>";
			if($row1->No_of_Deposit_ac_check == "Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->No_of_Deposit_ac_check)?$row1->No_of_Deposit_ac_check:'')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->No_of_Deposit_ac_check)?$row1->No_of_Deposit_ac_check:'')."</td>";
			}

			echo "<td align='right'>".number_format((isset($row1->Total_Loan_Outstanding_ISS)?$row1->Total_Loan_Outstanding_ISS:0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Loan_Outstanding_Affairs)?$row1->Total_Loan_Outstanding_Affairs:0), 2)."</td>";
			echo "<td align='right'>".number_format((isset($row1->Total_Loan_Outstanding_OMIS)?$row1->Total_Loan_Outstanding_OMIS:0), 2)."</td>";
			if($row1->Loan_Outstanding_check=="Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->Loan_Outstanding_check)? $row1->Loan_Outstanding_check:'')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->Loan_Outstanding_check)? $row1->Loan_Outstanding_check:'')."</td>";
			}

			echo "<td align='right'>".number_format(isset($row1->No_of_Loan_ACC_ISS) ? $row1->No_of_Loan_ACC_ISS : 0)."</td>";
			echo "<td align='right'>".number_format(isset($row1->No_of_Loan_Acc_OMIS)?$row1->No_of_Loan_Acc_OMIS:0)."</td>";
			if($row1->No_of_loan_ac_check == "Mismatch"){
			echo "<td align='center' style='background-color:#ddd; color:red'>".(isset($row1->No_of_loan_ac_check)?$row1->No_of_loan_ac_check:'')."</td>";
			}else{
				echo "<td align='center' style='background-color:#ddd;'>".(isset($row1->No_of_loan_ac_check)?$row1->No_of_loan_ac_check:'')."</td>";
			}

			echo "</tr>";
			$co++;
		}
	echo form_open('iss/iss_2_002_report_details/1', 'id="iss_2_002_form"');

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

   	    echo "<tr>";
        //$attribute='style="background-color: #FF9900;"';
    	//echo "<td align='center' COLSPAN='13'>".form_submit('actionbtn', 'Save AS PDF',$attribute)."</td>";
    	echo "</tr>";
		echo "</table>"; 
		echo "</div>";	
		?>

<input type="hidden" name="pdf_btn_inst" id="pdf_btn_inst" value="0" />
<input type="hidden" name="fig_indication_post" id="fig_indication_post" value="<?php echo isset($fig_indication) ? $fig_indication: ' '; ?>"/>
    <?php
    	echo form_close();
    }
    else
    {
        echo "<table border=\"1\" align=\"center\">";
        echo "<tr>";
    	echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
        echo "</tr>";
    	echo "</table>";
	}
	function branch_name_resize($brCode = 0, $brName = ''){
		$branchName = '';
		if($brCode == '0980'){
			$branchName = 'CHT. V&A SCIENCE UNIVERSITY';
		}else if($brCode == '0900'){
			$branchName = 'UGC. BHABAN';
		}else if($brCode == '0903'){
			$branchName = 'BOU CAMPUS';
		}else if($brCode == '0975'){
			$branchName = 'BD IKHU GOBESHONA INST.';
		}else if($brCode == '0148'){
			$branchName = 'REB CORP.';
		}else if($brCode == '0521'){
			$branchName = 'RAJANI GANDHA CORP.';
		}else if($brCode == '0745'){
			$branchName = 'FOREIGN EXCH.CORP. (SYLHET)';
		}
		 else{
			$branchName = $brName;
		}
		return $branchName;
	}	
	
	function area_name_resize($brCode = 0, $areaName = ''){
		$areaNameRet = '';
		if($brCode == '0749'){
			$areaNameRet = 'FOR. EXCH.CORP. (CTG)';
		}else if($brCode == '0216'){
			$areaNameRet = 'SADHARAN BIMA CORP.';
		}else if($brCode == '0118'){
			$areaNameRet = 'DU CAMPUS CORP.';
		}else if($brCode == '0423'){
			$areaNameRet = 'FOR. EXCH.CORP. (DHK)';
		}else if($brCode == '0904'){
			$areaNameRet = 'KAMAL ATATURK CORP. ';
		}else if($brCode == '0888'){
			$areaNameRet = 'JBCB CORP.';
		}else if($brCode == '0520'){
			$areaNameRet = 'UTTARA MODEL TOWN';
		}else if($brCode == '0066'){
			$areaNameRet = 'BANGABANDHU ROAD';
		}
		 else{
			$areaNameRet = $areaName;
		}
		return $areaNameRet;
	}		
?>

<script>
function freeze_pane_listener(what_is_this, table_class) {
  return function() {
    var i;
    var translate_y = "translate(0," + what_is_this.scrollTop + "px)";
    var translate_x = "translate(" + what_is_this.scrollLeft + "px,0px)";
    var translate_xy = "translate(" + what_is_this.scrollLeft + "px," + what_is_this.scrollTop + "px)";
    
    var fixed_vertical_elts = document.getElementsByClassName(table_class + " freeze_vertical");
    var fixed_horizontal_elts = document.getElementsByClassName(table_class + " freeze_horizontal");
    var fixed_both_elts = document.getElementsByClassName(table_class + " freeze");
    for (i = 0; i < fixed_horizontal_elts.length; i++) {
      fixed_horizontal_elts[i].style.webkitTransform = translate_x;
      fixed_horizontal_elts[i].style.transform = translate_x;
    }

    for (i = 0; i < fixed_vertical_elts.length; i++) {
       fixed_vertical_elts[i].style.webkitTransform = translate_y;
       fixed_vertical_elts[i].style.transform = translate_y;
    }

    for (i = 0; i < fixed_both_elts.length; i++) {
       fixed_both_elts[i].style.webkitTransform = translate_xy;
       fixed_both_elts[i].style.transform = translate_xy;
    }
  }
}

function even_odd_color(i) {
  if (i % 2 == 0) {
    return "#e0e0e0";
  } else {
    return "#ffffff";
  }
}

function parent_id(wanted_node_name, elt) {
  var wanted_parent = parent_elt(wanted_node_name, elt);
  
  if ((wanted_parent == undefined) || (wanted_parent.nodeName == null)) {
    return "";
  } else {
    return wanted_parent.id;
  }
}

function parent_elt(wanted_node_name, elt) {
  var this_parent = elt.parentElement;
  if ((this_parent == undefined) || (this_parent.nodeName == null)) {
    return null;
  } else if (this_parent.nodeName == wanted_node_name) {
    return this_parent;
  } else {
    return parent_elt(wanted_node_name, this_parent);
  }
}

var i, parent_div_id, parent_tr, table_i, scroll_div;
var scrolling_table_div_ids = ["scrolling_table_2"];
var scrolling_table_tr_counters = [];
for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scrolling_table_tr_counters.push(0);
}
var fixed_elements = document.getElementsByClassName("fixed");
for (i = 0; i < fixed_elements.length; i++) {
  fixed_elements[i].className += " " + parent_id("DIV", fixed_elements[i]);
}
var fixed_horizontal_elements = document.getElementsByClassName("freeze_horizontal");
for (i = 0; i < fixed_horizontal_elements.length; i++) {
  parent_div_id = parent_id("DIV", fixed_horizontal_elements[i]);
  table_i = scrolling_table_div_ids.indexOf(parent_div_id);
  
  if (table_i >= 0) {
    parent_tr = parent_elt("TR", fixed_horizontal_elements[i]);
    
    if (parent_tr.className.match("tr_shaded")) {
      fixed_horizontal_elements[i].style.backgroundColor = even_odd_color(scrolling_table_tr_counters[table_i]);
      scrolling_table_tr_counters[table_i]++;
    }
  }
}

for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scroll_div = document.getElementById(scrolling_table_div_ids[i]);
  scroll_div.addEventListener("scroll", freeze_pane_listener(scroll_div, scrolling_table_div_ids[i]));
}
</script>
