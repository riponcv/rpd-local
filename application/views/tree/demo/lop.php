<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>jQuery treeview</title>

<link rel="stylesheet" href="<?php echo base_url().'js/lib/jquery.treeview.css'; ?>" />
<link rel="stylesheet" href="<?php echo base_url().'js/lib/red-treeview.css'; ?>" />
<link rel="stylesheet" href="<?php echo base_url().'js/lib/screen.css'; ?>" />


<script src="<?php echo base_url().'js/lib/jquery.js'; ?>" type="text/javascript"></script>

<script src="<?php echo base_url().'js/lib/jquery.cookie.js'; ?>" type="text/javascript"></script>

<script src="<?php echo base_url().'js/lib/jquery.treeview.js'; ?>" type="text/javascript"></script>

<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
		
	</script>
</head>
<body>
<div id="main"><a href="?#"></a>
<div id="sidetree">
<div class="treeheader">&nbsp;</div>
<div id="sidetreecontrol"><a href="?#">Collapse All</a> | <a href="?#">Expand All</a></div>
<?php

     $j=0;
	 $j_br=0;
	 $j_div=0;
	 $j_div_name=0;
	 $j_zncode=0;
	 $j_brcode=0;
	 $j_brname=0;
	 $j_brcode_in=0;
	 $j_zncode_in=0;
	 $j_znname=0;
	 $arr_zncode_in=array();
	 $arr_brcode_in=array();
	 $arr_divcode=array();
	 $arr_divname=array();
	 $arr_zncode=array();
	 $arr_znname=array();
	 $arr_brcode=array();
	 $arr_brname=array();
	 
        foreach($dat_brcode_in as $key)
		{
		  $arr_brcode_in[$j_brcode_in++]=$key;
		}
		
		foreach($dat_brcode as $key)
		{
		  $arr_brcode[$j_brcode++]=$key;
		}
		
		foreach($dat_brname as $key)
		{
		  $arr_brname[$j_brname++]=$key;
		}
		
		foreach($dat_zncode_in as $key)
		{
		  $arr_zncode_in[$j_zncode_in++]=$key;
		}
		
        foreach($dat_zncode as $key)
		{
		  $arr_zncode[$j_zncode++]=$key;
		}
		
		foreach($dat_znname as $key)
		{
		  $arr_znname[$j_znname++]=$key;
		}
		
		foreach($dat_divcode as $key)
		{
		  $arr_divcode[$j_div++]=$key;
		}
		
		foreach($dat_divname as $key)
		{
		  $arr_divname[$j_div_name++]=$key;
		}

 
?>
<ul id="tree">
	<li><?php echo "<strong>"; echo anchor(base_url().'index.php/rpd/omis_report_form_con', 'Janata Bank Ltd.'); echo "</strong>"; 
		$m_div=0;
	    $m_zn=0;
		$m_br=0;
		$i_co=0;
    	/*
				
		for($a=0;$a<$j_zncode_in;$a++)
		{
		  echo "Division:".$arr_divname[$a];
		  for($b=0;$b<$arr_zncode_in[$a];$b++)
		  {
		  echo "Zone:".$arr_znname[$m_zn++];
		  
		  for($i=0;$i<$arr_brcode_in[$i_co];$i++)
		 {
		  
		   echo "Branch:".$arr_brname[$m_br++];
		  
		 }
		 $i_co++;
		echo "</br>";
		  }
	   }
	   }*/
		 echo "<ul>";
			 echo "<li>"; //echo "Janata Bank Ltd.";
			   for($a=0;$a<$j_zncode_in;$a++)
			   {
			    echo "<li>";
				echo anchor(base_url().'index.php/rpd/omis_report_div_form_admin/'.$arr_divcode[$m_div], "Division:".$arr_divname[$m_div]);
		//		echo "Division:".$arr_divname[$a];
				$m_div++;
				echo "<ul>";
				 for($b=0;$b<$arr_zncode_in[$a];$b++)
				 {
				  echo "<li>";
				  echo anchor(base_url().'index.php/rpd/omis_report_zone_form_admin/'.$arr_zncode[$m_zn], "Zone:".$arr_znname[$m_zn]);
				 // echo "Zone:".$arr_znname[$m_zn];
				  $m_zn++;
				   echo "<ul>";
				   for($i=0;$i<$arr_brcode_in[$i_co];$i++)
				   {
				    echo "<li>";
					//echo "Branch:".$arr_brname[$m_br++];
					echo anchor(base_url().'index.php/rpd/omis_report_branch_form_admin/'.$arr_brcode[$m_br], "Branch:".$arr_brname[$m_br]);
					//$data['abc']=$arr_brname[$m_br];
					//$a=$arr_brname[$m_br];
					//echo "<input type='hidden' name='treea' size='15' value='$a'/>";
					$m_br++;
				    //echo $branch[$iii];
				    echo "</li>";  
				   }
				   $i_co++;
				  echo "</ul>"; 
				  echo "</li>";  
				 }
				echo "</ul>";
				echo "</li>"; 
			 
			   }
			 ?>
			 </li>
         </ul>
	 </li>
</ul>
	</div>
</div>

</body>
</html>
