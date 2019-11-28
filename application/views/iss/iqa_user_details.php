<h2>User Message</h2>
<?php if(isset($iqa_user_query) && count($iqa_user_query)>1){ ?>
<table border="1">
	<tr>
		<th>
		SL No.
		</th>
		<th>Office/ Branch Code<br>
		Office/Branch Name<br>
		P File No.<br>
		User Name<br>
		Mobile Name<br>
		Date
		</th>
	</tr>
	<?php 
		$count_no = 1;
	foreach($iqa_user_query as $singleUser) { ?>
		<tr>
			<td align="center"><?php echo $count_no; ?></td>
			<td>
			<?php echo isset($singleUser->iqa_office_code)?$singleUser->iqa_office_code:''; ?><br>
			<?php echo isset($singleUser->office_name)?$singleUser->office_name:''; ?><br>
			<?php echo isset($singleUser->iqa_user_id)?$singleUser->iqa_user_id:''; ?><br>
			<?php echo isset($singleUser->ui_Full_Name)?$singleUser->ui_Full_Name:''; ?><br>
			<?php echo isset($singleUser->ui_Mobile_No)?$singleUser->ui_Mobile_No:''; ?><br>
			<?php 
			$format_date = date("Y-m-d", strtotime($singleUser->iqa_date));
			echo $format_date;
			?></td>
		</tr>
	<?php $count_no++; } ?>
</table>
<?php } ?>