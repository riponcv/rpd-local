
<?php 
echo "<table align =center id=\"tbldesgTarget\"><tr><th>Report Section</th></tr></table>";
echo "</table>";  
?>

<br/><br/>
	
<table border="2">
	<tr>
		<th colspan="7" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center;">Report Module</th>
	</tr>
	<tr>
		<td colspan="7"  width="500px" style="font-size:medium;font-style: italic;text-align: justify;">
        Report section contains various reports on different aspects with necessary time frequencies. Not only the 
        major indicators but also the root level positions, items, products, mixes, comparisons, graphs, charts 
        are available covering individual branch  as well as the controlling offices, units etc. As such there are
         many a reports available here to accommodate utmost information facilities within moments for any kind of
          purpose any manager or officer or executive may feel to render.
        
        <br/>Every individual report indicates five separate viewing options like branch, area, division, divisional 
        corporate and whole bank report. These options are viewable according to authentication level. To get your desired report, 
        just click on that report title.
        </td>
	</tr>
	<tr>
		<th>SL</th>
		<th width="150px">Report Module</th>
        <th width="700px">Module Description</th>
	</tr>
    
    <?php 
    if(isset($all_reports) && !empty($all_reports))
    {
        foreach($all_reports as $row)
        {
    ?>
       	<tr style="text-align:center">
		<td><?php echo isset($row->report_cat_sl)?$row->report_cat_sl:''; ?></td>
        <td><a href="<?php echo 'view_report/'.$row->report_cat_id ?>"><?php echo $row->report_cat_title; ?></a></td>
        <td style="text-align: left;font-size: small;"><?php echo isset($row->report_cat_desc)?$row->report_cat_desc:''; ?></td>
	   </tr>
    <?php
        }
    }
    ?>
</table>

    
 