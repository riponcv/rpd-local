<?php
//   echo "<pre>";
//   print_r($iss_2_0008_data);
//  die();
?>
<table  align="right">
<tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table><br/><br/>

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
<?php
  
   if(isset($iss_2_0008_data) && count($iss_2_0008_data)>0)  { ?>

    <table  align="center">
    <tr align="center"><th>ISS Form-2 to PL Items Indication Report</th></tr>
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
				<td style="background-color:white; font-weight: 700" class="fixed freeze" rowspan='' >SL. No.</td>
				<td class="txt_style_td_full fixed freeze_vertical" colspan=''>PL Head Name</td>
				<td class="txt_style_td_full fixed freeze_vertical" colspan=''>Indication to ISS</td>
				<td class="txt_style_td_full fixed freeze_vertical" colspan=''>Amount</td>
		</tr>

    <?php
		$co=1;
		foreach($iss_2_0008_data as $row1)
		{
			echo "<tr class='tr_shaded'>";
			echo "<td class='fixed freeze_horizontal' align='center'>".$co."</td>";
			echo "<td align='left'>".$row1->Sub_Head_Name."</td>";
			echo "<td align='left'>".$row1->Indication."</td>";
			echo "<td align='right'>".number_format($row1->amount, 2)."</td>";
			echo "</tr>";
			$co++;
		}
	echo "</table>"; 
	echo "</div>";

	/*echo form_open('iss/iss_2_008_report_details/1', 'id="iss_2_008_form"');

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
    	echo form_close();*/
    }
    else
    {
        echo "<table border=\"1\" align=\"center\">";
        echo "<tr>";
    	echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
        echo "</tr>";
    	echo "</table>";
	}
	
?>

<script>
function freeze_pane_listener(what_is_this, table_class) {
  // Wrapping a function so that the listener can be defined
  // in a loop over a set of scrolling table id's.
  // Cf. http://stackoverflow.com/questions/750486/javascript-closure-inside-loops-simple-practical-example
  
  return function() {
    var i;
    var translate_y = "translate(0," + what_is_this.scrollTop + "px)";
    var translate_x = "translate(" + what_is_this.scrollLeft + "px,0px)";
    var translate_xy = "translate(" + what_is_this.scrollLeft + "px," + what_is_this.scrollTop + "px)";
    
    var fixed_vertical_elts = document.getElementsByClassName(table_class + " freeze_vertical");
    var fixed_horizontal_elts = document.getElementsByClassName(table_class + " freeze_horizontal");
    var fixed_both_elts = document.getElementsByClassName(table_class + " freeze");
    
    // The webkitTransforms are for a set of ancient smartphones/browsers,
    // one of which I have, so I code it for myself:
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
  // Function to work up the DOM until it reaches
  // an element of type wanted_node_name, and return
  // that element's id.
  
  var wanted_parent = parent_elt(wanted_node_name, elt);
  
  if ((wanted_parent == undefined) || (wanted_parent.nodeName == null)) {
    // Sad trombone noise.
    return "";
  } else {
    return wanted_parent.id;
  }
}

function parent_elt(wanted_node_name, elt) {
  // Function to work up the DOM until it reaches 
  // an element of type wanted_node_name, and return
  // that element.
  
  var this_parent = elt.parentElement;
  if ((this_parent == undefined) || (this_parent.nodeName == null)) {
    // Sad trombone noise.
    return null;
  } else if (this_parent.nodeName == wanted_node_name) {
    // Found it:
    return this_parent;
  } else {
    // Recurse:
    return parent_elt(wanted_node_name, this_parent);
  }
}

var i, parent_div_id, parent_tr, table_i, scroll_div;
//var scrolling_table_div_ids = ["scrolling_table_1", "scrolling_table_2"];
var scrolling_table_div_ids = ["scrolling_table_2"];

// This array will let us keep track of even/odd rows:
var scrolling_table_tr_counters = [];
for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scrolling_table_tr_counters.push(0);
}

// Append the parent div id to the class of each frozen element:
var fixed_elements = document.getElementsByClassName("fixed");
for (i = 0; i < fixed_elements.length; i++) {
  fixed_elements[i].className += " " + parent_id("DIV", fixed_elements[i]);
}

// Set background colours of row headers, alternating according to 
// even_odd_color(), which should have the same values as those
// defined in the CSS for the tr_shaded class.
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

// Add event listeners.
for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scroll_div = document.getElementById(scrolling_table_div_ids[i]);
  scroll_div.addEventListener("scroll", freeze_pane_listener(scroll_div, scrolling_table_div_ids[i]));
}
</script>

