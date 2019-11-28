  <?php
  $array_id_show=array('1','6','18','21','24','27','57','60','30','33','36','39');
  $array_id_show_acc=array('1','6','36','39');
  $array_sub_division=array('21'=>'Standard (UC)','22'=>'SMA   (UC)','23'=>'SS','24'=>'DF','25'=>'BL');

  $report_date='';
  if(isset($date1) && $date1 !='')
  {
   $date_arr=explode(' ',$date1); 
   if(isset($date_arr[0]))
   {
	 $report_date_arr=explode('-',$date_arr[0]); 
   }
   if(isset($report_date_arr[2]) && isset($report_date_arr[1]) && isset($report_date_arr[0]))
   {
	$report_date=$report_date_arr[2].'.'.$report_date_arr[1].'.'.$report_date_arr[0];   
   }
  }
  
  $br_count=0;
   foreach($records3 as $row3)
	{
	 $br_count=$br_count+1;
	}
	$prod_count=0;
	foreach($prod_type as $row_prod)
	{
	 $prod_count=$prod_count+1;
	}
	$BRANCH=($br_count/$prod_count);
	
	$br_total=0;
	foreach($br_name as $row_br)
	{
	 $br_total=$br_total+1;
	}
     echo "<marquee bgcolor=\"#FFCCFF\" scrollamount=\"2\" behavior=\"alternate\" onmouseover=\"jQuery(this).attr('scrollamount','0');\" onmouseout=\"jQuery(this).attr('scrollamount','2');\"><table align=\"center\" >"; 
     echo "<tr>";
     echo "<th style='font-size:30px;'>";
     echo "OMIS as on ".$report_date.str_repeat('&nbsp;',4).'Branch: '.count($allbr).'/'.count($br_name).str_repeat('&nbsp;',4).'Amt in crore(No of a/c)';
     echo "</th></tr>";
     echo "</table></marquee>";
		 
	echo "<marquee scrollamount=\"3\" bgcolor=\"#99CCFF\" onmouseover=\"jQuery(this).attr('scrollamount','0');\" onmouseout=\"jQuery(this).attr('scrollamount','3');\"><table align=\"center\">"; 
	$data_ac = array();
	$data_amt = array();
	$ac_count=0;
	$amt_count=0;
	foreach($records3 as $row3)
	{
	 $data_ac[$ac_count]= $row3->dd_ac;
	 $data_amt[$ac_count]= $row3->dd_amt;
	 $ac_count++;
	}
	
	$account=0;
	$ac_sum=0;
	$amt_sum=0;
	$ac_i=1;
	$ac_amt=0;
	$ac_total=array();
	$amt_total=array();
	$AA=array();
	$BB=array();
	$dd_pt_id_ary=array();
	$AA_i=0;
	foreach($records3 as $row5)
	{
	 $AA_A=$row5->dd_pt_id;
	 $dd_pt_id_ary[$AA_i]=$AA_A;
	 //$AA_A=substr($AA_A,0,1);
if(strlen($AA_A)==3)
	 {
	 $AA_A=substr($AA_A,0,1);
	 }
	 else if (strlen($AA_A)==4)
       {
	  $AA_A=substr($AA_A,0,2);
	 }	 
	 $AA[$AA_i]=$AA_A;
	 $AA_i++;
	}
	
	$AA_A_i=0;
	$pt_id_A=array();
	foreach($records2 as $row8)
	{
	 $pt_id_A[$AA_A_i]=$row8->pt_id;
	 $AA_A_i++;
	}
	
	
	$ac_sum_total=0;
	$amt_sum_total=0;
	
	$data_ac_total = array();
	$data_amt_total = array();
	
	for($jj=0;$jj<$AA_A_i;$jj++)
	{
	  for($ii=0;$ii<$AA_i;$ii++)
	  {
	   if($pt_id_A[$jj]==$dd_pt_id_ary[$ii])
	   {
	    $ac_sum_total=$ac_sum_total+$data_ac[$ii];
		$amt_sum_total=$amt_sum_total+$data_amt[$ii];
		$account++;
	   }
	 }
	  $data_ac_total[$jj]=$ac_sum_total;
	  $data_amt_total[$jj]=$amt_sum_total;
	  $ac_sum_total=0;
	  $amt_sum_total=0;
	}

    $loan_text='';
    foreach($array_sub_division as $key=>$val)
    {
$amount_loan=$data_amt_total[$key]/10000000;        
$loan_text .=$val.': '.number_format($amount_loan,2).'('.number_format($data_ac_total[$key],0).')';
        $loan_text .=str_repeat('&nbsp;',7);
    }
	
	
	$BB_i=0;
	foreach($records1 as $row5)
	{
	 $BB_B=$row5->om_id;
	 $BB[$BB_i++]=$BB_B;
	}
	
	for($jj=0;$jj<$BB_i;$jj++)
	{
	  for($ii=0;$ii<$AA_i;$ii++)
	  {
	   if($BB[$jj]==$AA[$ii])
	   {
	    $ac_sum=$ac_sum+$data_ac[$ii];
		$amt_sum=$amt_sum+$data_amt[$ii];
		$account++;
	   }
	 }
	  $ac_total[$jj]=$ac_sum;
	  $amt_total[$jj]=$amt_sum;
	  $ac_sum=0;
	  $amt_sum=0;
	}
	
	 $jjj=0;
	 $i=0;
	 $z=1;
	 $last=0;
	 $total_count=0;
     
    $marquee_text='';
	foreach($records1 as $row1)
	{
            if(in_array($row1->om_id,$array_id_show))
            {
                $amount_=$amt_total[$jjj]/10000000;
			if($row1->om_id=='18')
                {
                  $marquee_text .=$loan_text;  
                }
                else
                {
                    $marquee_text .=$row1->om_id_des.': '.number_format($amount_,2);
                    if(in_array($row1->om_id,$array_id_show_acc))
                    {
                        $marquee_text .='('.number_format($ac_total[$jjj],0).')';   
                    }   
                }
                $marquee_text .=str_repeat('&nbsp;',7);    
            }          
            $jjj++;
    }
    
    echo "<tr><th style='font-size:30px;'>".$marquee_text."</th></tr>";
    echo "</table></marquee>";
?>
