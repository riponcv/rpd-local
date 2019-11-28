 
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:20px;">Suit Follow-up Position</td>
  </tr>
  <tr>
  <?php $month_array=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >From  
      <?php 
        echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?>, <?php echo isset($report_of_year1)?$report_of_year1:'';
      ?> 
      To
      <?php 
        echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?>, <?php echo isset($report_of_year2)?$report_of_year2:'';
      ?>
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
if(isset($result_array) && !empty($result_array))
{
  // echo "<pre>";
  // print_r($result_array);
?>
<br/>
<table border="1">
	<tr>
		<th rowspan="">SL</th>
    <th colspan="">Division</th>
    <th colspan="">Area</th>
    <th colspan="">Branch Nane</th>
    <th colspan="">Case No.</th>
    <th colspan="">Last Hearing/Follow-up Date</th>
    <th colspan="">Next Hearing/Follow-up Date</th>
    <th colspan="">Present Position of Suit</th>
    <th colspan="">Lawer Name-Cell No.</th>
	</tr>
  
  <?php $sl = 1;
    foreach($result_array as $data){ ?>
    <tr>
      <td><?php echo $sl++; ?></td>
      <td><?php echo $data['dvname']; ?></td>
      <td><?php echo $data['znname']; ?></td>
      <td><?php echo $data['branchname']; ?></td>
      <td><?php echo $data['lbpp_case_no']; ?></td>
      <td><?php 
          echo date('d/m/Y', strtotime($data['lbpp_date_of_position']));
      ?></td>
      <td>
        <?php 
            echo date('d/m/Y', strtotime($data['lbpp_followup_date']));
        ?>
      </td>
      <td><?php echo $data['lmpp_pp_desc_l2']; ?></td>
      <td>
        <?php 
            $lawyerIdArr = explode(',', $data['lb_lawyer_id']);
            $dataLaws = $this->lmsmodel->lms_lawer_data($lawyerIdArr);
        ?>
        <?php 
              foreach($dataLaws as $lawAll){ ?>
                  <?php echo isset($lawAll->lml_lawer_name)?$lawAll->lml_lawer_name:'';
                  echo "-";
                  echo isset($lawAll->lml_lawer_mobile)?$lawAll->lml_lawer_mobile:'';
                  echo ",";
                  echo "<br>";
                  ?>
          <?php  } ?>
        
      </td>
  </tr>
  <?php }?>
</table>
<?php 

    echo form_open('report/misd_0005_report_details/1');
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
    
    }else{
        echo "<table border=\"1\" align=\"center\">"; 	
          echo "<tr>";
            echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
          echo "</tr>";
    	  echo "</table>";
    }

?>
