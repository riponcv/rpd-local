<!DOCTYPE HTML>
<html lang="en-US">
<head>
</head>
<body>
<h1> <?php echo is_array($empbyoffid) ? 'Employee List' : 'Empty Employee List' ;?></h1>
    
 <?php
if ($this->session->flashdata('success'))
{ 
    echo "<div class='success'>";
    echo '<font color="green" size="+3" style="font-weight:bold">'.$this->session->flashdata('success').'</font>';
    echo "</div>";
}
?>

<?php if(is_array($empbyoffid)) foreach($empbyoffid as $rw) {?>
<a href="<?php echo base_url().'index.php/rpd/edit_empinfo/'.$rw['ei_id']; ?>">
<div style="float:left; padding-left:inherit; height:210px; width:250px">
<img src = "<?php echo base_url().'uploads/'.$rw['ei_img_url']; ?>"  height="150px" width="150px"/>
<?php echo '<br>Name: '.$rw['ei_name']; 
echo '<br>Mobile: '.$rw['ei_mob']; 
?>
</div>
</a>
<?php } ?>

</body>
</html>