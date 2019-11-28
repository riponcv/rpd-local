<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Test Data</title>
</head>
<body>
<?php
	/*	
	$j=0;
	foreach($testdiv as $rowdiv)
	{
	   $b=$rowdiv->jbdivisioncode;
	    echo "Divisional Code:".$b;
		foreach($testzn as $rowzn)
		{
		  $b_br=$rowzn->ZoneCode;
		  echo "ZoneCode:".$b_br;
		  $i=0;
		  foreach($testbr as $rowbr)
		  {
	 	   echo "Branch Code:::".$rowbr->jbbrcode;
	  	   echo "</br>";
 	  	   $i++;
		   $j++;
	 	   }
 		  echo "Total Branch:::::".$i; 
    	  echo "</br>";
		 }
  	} 
 echo $j;
 */

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
		
		$m_zn=0;
		$m_br=0;
		$i_co=0;
		
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
	  // echo $m_br;
	  //echo $m_zn;
	//	echo "</br>";
		//echo $i_co;
		/*
		for($i=0;$i<$j_zncode_in; $i++)
		{
		 
		 for($j=0;$j<$arr_zncode_in[$i];$j++)
		 {
		  echo "ZoneCode:".$arr_zncode[$m_zn];
		  echo "  ";
		  //echo "</br>";
		  $m_zn++;
		   for($l=0;$l<$j_brcode;$l++)
		   {
		     for($n=0;$n<$arr_zncode_in[$l];$n++)
			 {
		     echo "Branch Code:".$arr_brcode[$m_br];
		     echo "";
		       $m_br++;
			 }
		  echo "</br>";
		   }
		  
		  }
		  echo "</br>";
		}
		*/
		
?>
</body>
</html>
