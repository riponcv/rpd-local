<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:20px;">
    <?php echo isset($caseDesc[0]->lmcc_cc_desc_l3)?$caseDesc[0]->lmcc_cc_desc_l3:''; ?> Case Information</td>
  </tr>
  <tr>
  <?php $month_array=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >For the Month of <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
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
?>

<br />
<table style="margin-left: 90%;"><tr><td>Amount in BDT</td></tr></table>
<table border="1">
	<tr>
		<th>Sl No.</th>
		<th>Name of Branch</th>
		<th>Name of Borrower/Petitioner</th>
		<th>Case/Suit No.</th>
		<th>Filing Date</th>

		<th>Involved Amount</th>
		<th>Name of Court</th>
    <th>Cause of Filing Case/Suit</th>
    <th>Conducting Lawyer's Name</th>
    <th>Present Position of Case/ Suit</th>
	</tr>
	<?php $sl=1; foreach($result_array as $row){
    if(isset($lmsdisDatas) && !empty($lmsdisDatas)){
      foreach ($lmsdisDatas as $key => $lmsdisData) {
        if($row['lb_tran_no'] !== $lmsdisData->lbdis_tran_no){
    ?>
    
	<tr>
		<td><?php echo $sl++; ?></td>
		<td><?php echo isset($row['branchname'])?$row['branchname']:''; //echo $row['lb_tran_no'];?></td>
    <td><?php echo isset($row['lb_loan_ac_name'])?$row['lb_loan_ac_name']:''; ?></td>
    <td><?php echo isset($row['lb_case_no'])?$row['lb_case_no']:''; ?></td>
    <td><?php echo date('d/m/Y', strtotime($row['lb_filing_date'])); ?></td>
    <td align="right"><?php echo isset($row['lb_suitValue_amt'])?number_format($row['lb_suitValue_amt'], 2):''; ?></td>
    <td>
      <?php 
        if(isset($lmscourts) && !empty($lmscourts)){
          foreach($lmscourts as $lmscourt){
            if($row['lb_court_type'] === $lmscourt->lmct_ct_id_l3){
              echo isset($lmscourt->lmct_ct_desc_l3)?$lmscourt->lmct_ct_desc_l3:'';
            }
          }
        }
      ?>
    </td>
    <td><?php echo isset($row['lb_issue'])?$row['lb_issue']:''; ?></td>
    
    <td>
    <?php if($report_of_case !="5101"){ ?>
      <?php 
          $lawyerIdArr = explode(',', $row['lb_lawyer_id']);
          $dataLaws = $this->lmsmodel->lms_lawer_data($lawyerIdArr);
      ?> 
        <table  class="" border="1">
          <tr>
              <th>Lawyer Name</th>
              <th>Lawyer Position</th>
          <tr>
          <?php 
              foreach($dataLaws as $lawAll){ ?>
                  <tr>
                      <td><?php echo isset($lawAll->lml_lawer_name)?$lawAll->lml_lawer_name:'';?></td>
                      <td><?php echo isset($lawAll->lml_lawer_advPosition)?$lawAll->lml_lawer_advPosition:'';?></td>
                  </tr>
          <?php  } ?>
        </table> 
        <?php }?>
    </td>
    
    <td>
      <?php
        if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
          foreach($lmsppDatahas as $lmsppData){
            if($row['lb_tran_no'] === $lmsppData->lbpp_tran_no){
              echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:'';
            }
          }
        }
      ?>
    </td>
	</tr>
  <?php }}
    } }?>
</table>


<br/>
<?php 

    echo form_open('report/lms_0002_report_details/1');
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
    
    }
    else
    {
        echo "<table border=\"1\" align=\"center\">"; 	
        echo "<tr>";
    	echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
        echo "</tr>";
    	echo "</table>";
    }
?>
<br/>
</body>
</html>
