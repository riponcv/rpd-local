
<div class="user_info_header">
<h2>Informasia of Table</h2>
</div>

<div class="user_info">
	<table>
	<?
	foreach($user_info as $key=>$value){
	?>
	<tr><td><?=ucwords($key)?></td><td>:<?=$value?></td></tr>
	<?
	}
	?>
	</table>
	</div>
	<div class="pdf_download">
	 <?=$link_download?>
	 </div>
