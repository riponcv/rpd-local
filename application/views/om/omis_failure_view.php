<table border="2">
	<tr>
		<th colspan="2" BGCOLOR="red" style="font-weight: bold;text-align: center; font-size:25px">Failure Report</th>
	</tr>
	<tr>
		<td colspan="2"  width="500px" style="font-size:medium;font-style: italic;text-align: justify;color:red;font-weight:bold;">
		SORRY, OMIS Data for <?php echo isset($entry_date)?$entry_date:''; ?> is not saved because currently logged-in user's specification is as follows-
        </td>
	</tr>
	<tr><td>Office ID</td><td><?php echo $offid;?></td></tr>
	<tr><td>Office Name</td><td><?php echo $txt_office_name;?></td></tr>
	<tr><td>User Name</td><td><?php echo $uid;?></td></tr>
	<tr>
		<td colspan="2"  width="500px" style="font-size:medium;font-style: italic;text-align: justify;color:green;font-weight:bold;">
		Please login as a branch user to submit OMIS data.
        </td>
	</tr>
 
</table>
