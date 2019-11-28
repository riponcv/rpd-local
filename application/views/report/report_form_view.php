
<?php 
echo "<table align =center id=\"tbldesgTarget\"><tr><th>Report Section</th></tr></table>";
echo "</table>";  
?>

<br/><br/>

<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">Back</a></th></tr>
</table>
<br/><br/>
	
<table border="2">
	<tr>
		<th colspan="7" BGCOLOR="#99CCFF" style="font-weight: bold;text-align: center;">Available Report</th>
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
		<th>Sl</th>
        <th>Report ID</th>
		<th width="250px">Report Title</th>
        <th width="90px">Data Source</th>
		<th>Frequency</th>
        <th>Content</th>
        <th>Description</th>
	</tr>
    
    <?php 
    if(isset($all_reports) && !empty($all_reports))
    {
        $count=1;
        foreach($all_reports as $row)
        {
            ?>
       	<tr style="text-align:center">
		<td><?php echo $count; ?></td>
		<td><?php echo $row->report_id; ?></td>
		
        		<?php
		if($row->report_is_base==0)
		{
		?>
		<td align="left"><a href="<?php echo base_url().'index.php/report/'.$row->report_function ?>"><?php echo $row->report_title; ?></a></td>
		<?php
		}
		else
		{
		?>
		<td align="left"><a href="<?php echo base_url().'index.php/'.$row->report_function ?>"><?php echo $row->report_title; ?></a></td>
		<?php
		}
		?>
		
		
        <td style="font-size:smaller;text-align: left;"><?php echo isset($row->report_data_source)?$row->report_data_source:''; ?></td>
		<td style="font-size:smaller;text-align: left;"><?php echo isset($row->report_frequency)?$row->report_frequency:''; ?></td>
        <td style="font-size:smaller;text-align: left;"><?php echo isset($row->report_content)?$row->report_content:''; ?></td>
        <td style="font-size:smaller;text-align: left;"><?php echo isset($row->report_despription)?$row->report_despription:''; ?></td>
	   </tr>
            <?php
        $count++;
        }
    }
    else
    {
        ?>
        <tr style="text-align:center">
        <td colspan="7" style="font-weight: bold;color: red;">Sorry, no report found for this module. Development running.</td>
        </tr>
        <?php
    }
    ?>
</table>

    
 