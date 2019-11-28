 
 <?php
//  echo $report_of_month1;
//  echo $report_of_year1;

//  echo $report_of_month2;
//  echo $report_of_year2;
function date_to_month($month=0, $year=0){
  $day= '';
  if($month == 4 || $month == 6 || $month == 9 || $month == 11 ){
      $day = '30';
  }
  if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
      $day = '31';
  }
  if($month == 2){
      if((date('L', mktime(0, 0, 0, 1, 1, $year))==1)){
          $day = '29';
      }else{
          $day = '28';
      }
  }
  return $day;
}

 $yearPre = '';
 $monthPre = '';
 $dayPre = '';
 
 if($report_of_month1 == 1){
    $yearPre = ($report_of_year1-1);
    $monthPre = 12;
    $dayPre = date_to_month($report_of_month1, $report_of_year1);
 }else{
  $yearPre = ($report_of_year1);
  $monthPre = ($report_of_month1-1);
  $dayPre = date_to_month($monthPre, $report_of_year1);
 }

 //echo $dayPre."-".$monthPre."-".$yearPre;
 ?>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:20px;">Periodic Report</td>
  </tr>
  <tr>
  <?php $month_array=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >From <?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?>, <?php echo isset($report_of_year1)?$report_of_year1:'';?> 
    To
    <?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?>, <?php echo isset($report_of_year2)?$report_of_year2:'';?>
    </td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
// if(isset($result_array) && !empty($result_array))
// {

 // echo "<pre>";
 // print_r($result_array);
?>

<br />
<table align="right"><tr><td>Amount in BDT</td></tr></table>
<br/>
<table border="1">
	<tr>
		<th rowspan="2">Suit Type</th>
    <th colspan="2">Undisposed-off Suit <br>as on <?php echo $dayPre.".". $monthPre.".".$yearPre?></th>
    <th colspan="2">Suit Filing <br> 
      <?php 
        $betDay1 = ''; 
        $betDay1 = date_to_month($report_of_month1, $report_of_year1);

        $betDay2 = ''; 
        $betDay2 = date_to_month($report_of_month2, $report_of_year2);
      ?>
      (<?php echo "1".".".$report_of_month1.".".$report_of_year1; ?> To 
      <?php echo $betDay2.".".$report_of_month2.".".$report_of_year2; ?>) 
    </th>
    <th colspan="2">Suit Disposed-off <br>
    
     (<?php echo "1".".".$report_of_month1.".".$report_of_year1; ?> To 
      <?php echo $betDay2.".".$report_of_month2.".".$report_of_year2; ?>) 
    </th>
    <th colspan="2">Undisposed-off Suit as on 
    <?php echo $betDay2.".".$report_of_month2.".".$report_of_year2; ?>
    </th>
	</tr>
  <tr>
    <td>No</td>
    <td>Amount</td>
    <td>No</td>
    <td>Amount</td>
    <td>No</td>
    <td>Amount</td>
    <td>No</td>
    <td>Amount</td>
  </tr>
    <?php 
    //echo count
    //echo $result_array[0]['Subject'];
    $bDuNoTotal = 0;
    $bDuAmtTotal = 0;
    $betDSFNoTotal = 0;
    $betDSFAmtTotal = 0;
    $betuDSFNoTotal = 0;
    $betuDSFAmtTotal = 0;
    $asOnuDSFNoTotal = 0;
    $asOnuDSFAmtTotal = 0;
    foreach($result_array as $Frow){ 
      $bDuNoTotal = $bDuNoTotal+$Frow['bDuNo'];

      $bDuAmtTotal = $bDuAmtTotal+$Frow['bDuAmt'];
      $betDSFNoTotal = $betDSFNoTotal+$Frow['betDSFNo'];
      $betDSFAmtTotal = $betDSFAmtTotal+$Frow['betDSFAmt'];
      $betuDSFNoTotal = $betuDSFNoTotal+$Frow['betuDSFNo'];
      $betuDSFAmtTotal = $betuDSFAmtTotal+$Frow['betuDSFAmt'];
      $asOnuDSFNoTotal = $asOnuDSFNoTotal+$Frow['asOnuDSFNo'];
      $asOnuDSFAmtTotal = $asOnuDSFAmtTotal+$Frow['asOnuDSFAmt'];
      ?>
  <tr style="text-align:center">
    
      <?php if($Frow['Subject'] == 1) {?>
        <td>Artha Rin Suit</td>
      <?php } ?>
      <?php if($Frow['Subject'] == 2) {?>
        <td>Writ Petition</td>
      <?php } ?>
      <?php if($Frow['Subject'] == 3) {?>
        <td>Appeal and Review Suit</td>
      <?php } ?>
      <?php if($Frow['Subject'] == 4) {?>
        <td>Insolvance</td>
      <?php } ?>
      <?php if($Frow['Subject'] == 5) {?>
        <td>Adminsstrtaive</td>
      <?php } ?>
      <?php if($Frow['Subject'] == 6) {?>
        <td>Misc. Suit</td>
      <?php } ?>
      <?php if($Frow['Subject'] == 8) {?>
        <td>PDR</td>
      <?php } ?>
      <?php if($Frow['Subject'] == 9) {?>
        <td>Other Suit</td>
      <?php } ?>
      <td><?php echo $Frow['bDuNo']; ?></td>
        <td><?php echo $Frow['bDuAmt']; ?></td>
        <td><?php echo $Frow['betDSFNo']; ?></td>
        <td><?php echo $Frow['betDSFAmt']; ?></td>
        <td><?php echo $Frow['betuDSFNo']; ?></td>
        <td><?php echo $Frow['betuDSFAmt']; ?></td>
        <td><?php echo $Frow['asOnuDSFNo']; ?></td>
        <td><?php echo $Frow['asOnuDSFAmt']; ?></td>
  </tr>
  <?php } ?>
  
  <!-- <tr>
    <td>Writ Petiton</td> 
  </tr>
  <tr>
    <td>Appeal and Review Suit</td>
    
  </tr>
  
  <tr>
    <td>Insolvance Suit</td>
    
  </tr>
  <tr>
    <td>Administrative Suit</td>
    
  </tr>
  <tr>
    <td>Civil Suit</td>
    
  </tr>
  <tr>
    <td>Misc. Suit</td>
    
  </tr>
  <tr>
    <td>PDR Act</td>
    
  </tr>
  <tr>
    <td>Other Suit</td>
    
  </tr> -->
  <tr style="background-color:#ddd; text-align:center">
    <td>Total</td>
    <td><?php echo $bDuNoTotal; ?></td>
    <td><?php echo $bDuAmtTotal; ?></td>
    <td><?php echo $betDSFNoTotal; ?></td>
    <td><?php echo $betDSFAmtTotal; ?></td>
    <td><?php echo $betuDSFNoTotal; ?></td>
    <td><?php echo $betuDSFAmtTotal; ?></td>
    <td><?php echo $asOnuDSFNoTotal; ?></td>
    <td><?php echo $asOnuDSFAmtTotal; ?></td>

  </tr>
</table>
<?php 

    echo form_open('report/misd_0004_report_details/1');
    if(isset($previous_value) && !empty($previous_value))
    {
        foreach($previous_value as $key=>$val)
        {
            ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
            <?php
        }
    }
	echo form_close();  
    
    // }else{
    //     echo "<table border=\"1\" align=\"center\">"; 	
    //       echo "<tr>";
    //         echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
    //       echo "</tr>";
    // 	  echo "</table>";
    // }

?>
