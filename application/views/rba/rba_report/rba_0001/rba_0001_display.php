<style>
.part-a-area h2 {
    text-align: left;
}
.part-a-area table {
    width: 90%;
}
.part-b-area table {
    width: 90%;
}
.result-area {
    text-align: center;
}

.result-area p {
    background-color: #ddd;
    width: 90%;
    margin-top: 25px;
    font-size: 24px;
    padding: 5px;
    font-weight: 700;
}
.part-a-area h4 {
    background-color: #ddd;
    width: 90%;
    padding: 5px;
}
.part-b-area h4 {
    background-color: #ddd;
    width: 90%;
    padding: 5px;
}
.result-area table {width: 90%;}
.rba-b-result-area p {
    background-color: #ddd;
    margin-top: 20px;
    padding: 5px;
    width: 90%;
}

.rba-b-result-area table {
    width: 90%;
}
.rba-b-result-area p {
    background-color: #ddd;
    margin-top: 20px;
    padding: 5px;
    width: 90%;
}
.rba-a-result-area p {
    background-color: #ddd;
    margin-top: 10px;
    padding: 5px;
    font-size: 20px;
    width: 90%;
}
</style>
<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
</table>
<br/><br/><br/>
<table align="center">
  <tr>
    <td align="center" style="font-size:20px;">Risk Based Audit Report</td>
  </tr>
  <tr>
  <?php $month_array=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >For the Month of 
      <?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?> To
      <?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?> 
    </td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<br />
<?php
$src_dsa = base_url().'index.php/report/misd_0021';
$src_dsaback = base_url().'index.php/report/misd_0020';
$src_pl = base_url().'index.php/report/misd_0003';
$src_omis = base_url().'index.php/rpd/omis_reportindex.php';
$src_iss = base_url().'index.php/iss/iss_reportindex.php';
// echo anchor($src_dsa,'Affairs','target="_blank"');
// echo anchor($src_dsaback,'Affairs Back Page','target="_blank"');
// echo anchor($src_omis,'OMIS','target="_blank"');
// echo anchor($src_iss,'ISS','target="_blank"');
?>

<div class="container">
  <div class="row">
    <div class="col-lg">
      
    <div class="part-a-area">
      <h4>Part-A Branch (<?php echo isset($report_of_office)?$report_of_office:''; ?>
      <?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?> To
      <?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?>) 
      </h4>
      <?php
      function level_of_risk_part_a($award_score = 0){
        $level_risk = '';
        if($award_score==0){return "Low Risk";}
        if($award_score !=''){
          if($award_score>=70){
            $level_risk = 'Extremely High Risk';
          }else if($award_score>=60 && $award_score<70){
            $level_risk = 'High Risk';
          }else if($award_score>=40 && $award_score<60){
            $level_risk = 'Medium Risk';
          }else{
            if($award_score<40){
              $level_risk = 'Low Risk';
            }
          }
        }
        return $level_risk; 
      }
      ?>
      <table border="1">
          <tr>
          <?php 
          $part_a_a_total_alloc_score = ($result_array['part_a_a_info']['current_dep_all_mark']+
          $result_array['part_a_a_info']['saving_dep_all_mark']+
          $result_array['part_a_a_info']['sundry_dep_all_mark']+
          $result_array['part_a_a_info']['fixed_dep_all_mark']+
          $result_array['part_a_a_info']['scheme_dep_all_mark']+
          $result_array['part_a_a_info']['no_ac_dep_all_mark']);
          ?>
            <th colspan="8">A. Deposit <br> (Total Allotted Marks:<?php echo isset($part_a_a_total_alloc_score)?$part_a_a_total_alloc_score:''; ?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>data Source</th>
          </tr>
            <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_a_info']['observation_cd'])?$result_array['part_a_a_info']['observation_cd']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['pre_current_deposit'])?$result_array['part_a_a_info']['pre_current_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['next_current_deposit'])?$result_array['part_a_a_info']['next_current_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['growth_current_dep'])?$result_array['part_a_a_info']['growth_current_dep']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['current_dep_obtained_mark'])?$result_array['part_a_a_info']['current_dep_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['current_dep_all_mark'])?$result_array['part_a_a_info']['current_dep_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_a_info']['observation_sb'])?$result_array['part_a_a_info']['observation_sb']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['pre_saving_deposit'])?$result_array['part_a_a_info']['pre_saving_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['next_saving_deposit'])?$result_array['part_a_a_info']['next_saving_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['growth_saving_dep'])?$result_array['part_a_a_info']['growth_saving_dep']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['saving_dep_obtained_mark'])?$result_array['part_a_a_info']['saving_dep_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['saving_dep_all_mark'])?$result_array['part_a_a_info']['saving_dep_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>3</td>
              <td><?php echo isset($result_array['part_a_a_info']['observation_sundryD'])?$result_array['part_a_a_info']['observation_sundryD']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['pre_sundry_deposit'])?$result_array['part_a_a_info']['pre_sundry_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['next_sundry_deposit'])?$result_array['part_a_a_info']['next_sundry_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['growth_sundry_dep'])?$result_array['part_a_a_info']['growth_sundry_dep']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['sundry_dep_obtained_mark'])?$result_array['part_a_a_info']['sundry_dep_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['sundry_dep_all_mark'])?$result_array['part_a_a_info']['sundry_dep_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>4</td>
              <td><?php echo isset($result_array['part_a_a_info']['observation_fdr'])?$result_array['part_a_a_info']['observation_fdr']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['pre_fixed_deposit'])?$result_array['part_a_a_info']['pre_fixed_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['next_fixed_deposit'])?$result_array['part_a_a_info']['next_fixed_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['growth_fixed_dep'])?$result_array['part_a_a_info']['growth_fixed_dep']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['fixed_dep_obtained_mark'])?$result_array['part_a_a_info']['fixed_dep_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['fixed_dep_all_mark'])?$result_array['part_a_a_info']['fixed_dep_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>5</td>
              <td><?php echo isset($result_array['part_a_a_info']['observation_schemeD'])?$result_array['part_a_a_info']['observation_schemeD']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['pre_scheme_deposit'])?$result_array['part_a_a_info']['pre_scheme_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['next_scheme_deposit'])?$result_array['part_a_a_info']['next_scheme_deposit']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['growth_scheme_dep'])?$result_array['part_a_a_info']['growth_scheme_dep']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['scheme_dep_obtained_mark'])?$result_array['part_a_a_info']['scheme_dep_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['scheme_dep_all_mark'])?$result_array['part_a_a_info']['scheme_dep_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>6</td>
              <td><?php echo isset($result_array['part_a_a_info']['observation_noD'])?$result_array['part_a_a_info']['observation_noD']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['pre_no_ac_OMIS'])?$result_array['part_a_a_info']['pre_no_ac_OMIS']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['next_no_ac_OMIS'])?$result_array['part_a_a_info']['next_no_ac_OMIS']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['growth_no_ac_dep'])?$result_array['part_a_a_info']['growth_no_ac_dep']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['no_ac_dep_obtained_mark'])?$result_array['part_a_a_info']['no_ac_dep_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_a_info']['no_ac_dep_all_mark'])?$result_array['part_a_a_info']['no_ac_dep_all_mark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_a_total_obtain_score = ($result_array['part_a_a_info']['current_dep_obtained_mark']+
                        $result_array['part_a_a_info']['saving_dep_obtained_mark']+
                        $result_array['part_a_a_info']['sundry_dep_obtained_mark']+
                        $result_array['part_a_a_info']['fixed_dep_obtained_mark']+
                        $result_array['part_a_a_info']['scheme_dep_obtained_mark']+
                        $result_array['part_a_a_info']['no_ac_dep_obtained_mark']);
                      echo $part_a_a_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php 
                  echo $part_a_a_total_alloc_score;
                ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_aa = ($part_a_a_total_obtain_score*100/$part_a_a_total_alloc_score);
                  echo number_format($obt_per_aa,2);
                  
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Deposit Sector</td>
              <td colspan="6" align="center">
                <?php 
                  $obt_per_aa = ($part_a_a_total_obtain_score*100/$part_a_a_total_alloc_score);
                  echo level_of_risk_part_a($obt_per_aa);            
                ?>
              </td>
          </tr>
      </table>
        <table border="1">
          <tr>
          <?php
            $part_a_b_total_alloc_score = ($result_array['part_a_b_info']['part_a_b_sect_one']['ltr_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['ecc_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['fdbp_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['ldbp_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['ibp_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['lim_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['pad_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['pc_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['demand_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['rural_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['cc_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['gen_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['staff_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['sod_loan_all_mark']+
            $result_array['part_a_b_info']['part_a_b_sect_one']['other_loan_all_mark']); 
          ?>
            <th colspan="8">B. Loan & Advances (including Foreign Exchange)<br>
            (Total Allotted Marks:<?php echo isset($part_a_b_total_alloc_score)?$part_a_b_total_alloc_score:'';?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>data Source</th>
          </tr>
            <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_ltr'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_ltr']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_ltr_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_ltr_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_ltr_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_ltr_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_ltr_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_ltr_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ltr_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ltr_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ltr_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ltr_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_ecc'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_ecc']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_ecc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_ecc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_ecc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_ecc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_ecc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_ecc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ecc_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ecc_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ecc_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ecc_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>3</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_fdbp'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_fdbp']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_fdbp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_fdbp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_fdbp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_fdbp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_fdbp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_fdbp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['fdbp_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['fdbp_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['fdbp_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['fdbp_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>4</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_ldbp'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_ldbp']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_ldbp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_ldbp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_ldbp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_ldbp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_ldbp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_ldbp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ldbp_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ldbp_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ldbp_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ldbp_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>5</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_ibp'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_ibp']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_ibp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_ibp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_ibp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_ibp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_ibp_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_ibp_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ibp_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ibp_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['ibp_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['ibp_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>6</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_lim'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_lim']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_lim_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_lim_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_lim_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_lim_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_lim_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_lim_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['lim_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['lim_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['lim_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['lim_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>7</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_pad'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_pad']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_pad_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_pad_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_pad_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_pad_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_pad_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_pad_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pad_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pad_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pad_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pad_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>8</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_pc'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_pc']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_pc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_pc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_pc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_pc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_pc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_pc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pc_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pc_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pc_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pc_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>9</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_demand'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_demand']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_demand_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_demand_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_demand_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_demand_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_demand_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_demand_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['demand_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['demand_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['demand_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['demand_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>10</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_rural'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_rural']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_rural_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_rural_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_rural_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_rural_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_rural_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_rural_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['rural_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['rural_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['rural_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['rural_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>11</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_other_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_other_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_other_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_other_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_other_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_other_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_other_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_other_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['other_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['other_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['other_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['other_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>12</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_pc'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_pc']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_cc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_cc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_cc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_cc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_cc_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_cc_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['cc_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['cc_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['cc_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['cc_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>13</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_gen'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_gen']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_gen_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_gen_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_gen_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_gen_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_gen_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_gen_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['gen_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['gen_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['gen_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['gen_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>14</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_staff'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_staff']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_staff_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_staff_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_staff_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_staff_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_staff_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_staff_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['staff_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['staff_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['staff_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['staff_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>15</td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['observation_sod'])?$result_array['part_a_b_info']['part_a_b_sect_one']['observation_sod']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['pre_sod_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['pre_sod_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['next_sod_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['next_sod_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['grth_sod_loan'])?$result_array['part_a_b_info']['part_a_b_sect_one']['grth_sod_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['sod_loan_obtained_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['sod_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_b_info']['part_a_b_sect_one']['sod_loan_all_mark'])?$result_array['part_a_b_info']['part_a_b_sect_one']['sod_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_b_total_obtain_score = ($result_array['part_a_b_info']['part_a_b_sect_one']['ltr_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['ecc_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['fdbp_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['ldbp_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['ibp_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['lim_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['pad_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['pc_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['demand_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['rural_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['cc_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['gen_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['staff_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['sod_loan_obtained_mark']+
                        $result_array['part_a_b_info']['part_a_b_sect_one']['other_loan_obtained_mark']);
                      echo $part_a_b_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php echo $part_a_b_total_alloc_score; ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>In Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_ab = ($part_a_b_total_obtain_score*100/$part_a_b_total_alloc_score);
                  echo number_format($obt_per_ab,2);
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Loan & Advances</td>
              <td colspan="6" align="center">
                <?php 
                  //$obt_per_ab = ($part_a_b_total_obtain_score*100/$part_a_b_total_alloc_score);
                  echo level_of_risk_part_a($obt_per_ab);            
                ?>
              </td>
          </tr>
        </table>

        <table border="1">
          <tr>
            <?php 
            $part_a_c_total_alloc_score = ($result_array['part_a_c_info']['ss_loan_all_mark']+
            $result_array['part_a_c_info']['df_loan_all_mark']+
            $result_array['part_a_c_info']['bl_loan_all_mark']); 
            ?>
            <th colspan="8">C. Loan Classificcation <br> (Total Allotted Marks:<?php echo isset($part_a_c_total_alloc_score)?$part_a_c_total_alloc_score:''; ?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>Data Source</th>
          </tr>
            <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_c_info']['observation_ss'])?$result_array['part_a_c_info']['observation_ss']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['pre_ss_omis'])?$result_array['part_a_c_info']['pre_ss_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['next_ss_omis'])?$result_array['part_a_c_info']['next_ss_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['growth_ss_loan'])?$result_array['part_a_c_info']['growth_ss_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['ss_loan_obtained_mark'])?$result_array['part_a_c_info']['ss_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['ss_loan_all_mark'])?$result_array['part_a_c_info']['ss_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_c_info']['observation_df'])?$result_array['part_a_c_info']['observation_df']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['pre_df_omis'])?$result_array['part_a_c_info']['pre_df_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['next_df_omis'])?$result_array['part_a_c_info']['next_df_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['growth_df_loan'])?$result_array['part_a_c_info']['growth_df_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['df_loan_obtained_mark'])?$result_array['part_a_c_info']['df_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['df_loan_all_mark'])?$result_array['part_a_c_info']['df_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>3</td>
              <td><?php echo isset($result_array['part_a_c_info']['observation_bl'])?$result_array['part_a_c_info']['observation_df']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['pre_bl_omis'])?$result_array['part_a_c_info']['pre_bl_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['next_bl_omis'])?$result_array['part_a_c_info']['next_bl_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['growth_bl_loan'])?$result_array['part_a_c_info']['growth_bl_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['bl_loan_obtained_mark'])?$result_array['part_a_c_info']['bl_loan_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_c_info']['bl_loan_all_mark'])?$result_array['part_a_c_info']['bl_loan_all_mark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_c_total_obtain_score = ($result_array['part_a_c_info']['ss_loan_obtained_mark']+
                        $result_array['part_a_c_info']['df_loan_obtained_mark']+
                        $result_array['part_a_c_info']['bl_loan_obtained_mark']);
                      echo $part_a_c_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php echo $part_a_c_total_alloc_score; ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_ac = ($part_a_c_total_obtain_score*100/$part_a_c_total_alloc_score);
                  echo number_format($obt_per_ac, 2);
                  
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Deposit Sector</td>
              <td colspan="6" align="center">
                <?php 
                  //$obt_per_ac = ($part_a_a_total_obtain_score*100/$part_a_a_total_alloc_score);
                  echo level_of_risk_part_a($obt_per_ac);            
                ?>
              </td>
          </tr>
      </table>
      <table border="1">
          <tr>
          <?php 
                  $part_a_d_total_alloc_score = ($result_array['part_a_d_info']['writtOff_all_mark']+
                  $result_array['part_a_d_info']['resched_all_mark']);
                ?>
            <th colspan="8">D. Recovery & CL Reduction from NON Performing Accounts (NPA's)<br> (Total Allotted Marks:<?php echo isset($part_a_d_total_alloc_score)?$part_a_d_total_alloc_score:''; ?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>Data Source</th>
          </tr>
            <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_d_info']['observation_writtOff'])?$result_array['part_a_d_info']['observation_writtOff']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['pre_writtOff_omis'])?$result_array['part_a_d_info']['pre_writtOff_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['next_writtOff_omis'])?$result_array['part_a_d_info']['next_writtOff_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['growth_writtOff_loan'])?$result_array['part_a_d_info']['growth_writtOff_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['writtOff_obtained_mark'])?$result_array['part_a_d_info']['writtOff_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['writtOff_all_mark'])?$result_array['part_a_d_info']['writtOff_all_mark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_d_info']['observation_resched'])?$result_array['part_a_d_info']['observation_resched']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['pre_resched_omis'])?$result_array['part_a_d_info']['pre_resched_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['next_resched_omis'])?$result_array['part_a_d_info']['next_resched_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['growth_resched_loan'])?$result_array['part_a_d_info']['growth_resched_loan']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['resched_obtained_mark'])?$result_array['part_a_d_info']['resched_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_d_info']['resched_all_mark'])?$result_array['part_a_d_info']['resched_all_mark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          
          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_d_total_obtain_score = ($result_array['part_a_d_info']['writtOff_obtained_mark']+
                        $result_array['part_a_d_info']['resched_obtained_mark']);
                      echo $part_a_d_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php echo $part_a_d_total_alloc_score; ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_ad = ($part_a_d_total_obtain_score*100/$part_a_d_total_alloc_score);
                  echo number_format($obt_per_ad, 2);
                  
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Deposit Sector</td>
              <td colspan="6" align="center">
                <?php 
                  //$obt_per_ad = ($part_a_a_total_obtain_score*100/$part_a_a_total_alloc_score);
                  echo level_of_risk_part_a($obt_per_ad);            
                ?>
              </td>
          </tr>
      </table>
        
        <table border="1">
          <tr>
          <?php  $part_a_e_total_alloc_score = ($result_array['part_a_e_info']['po_liab_all_mark']+
                        $result_array['part_a_e_info']['instSus_liab_all_mark']+
                        $result_array['part_a_e_info']['accruedExpforOther_liab_all_ma']+
                        $result_array['part_a_e_info']['instPayacaccInstFRD_liab_all_m']+
                        $result_array['part_a_e_info']['grth_OIBTCR_liab_all_mark']); ?>
            <th colspan="8">E. Bills Payable & Other Liabilities <br> (Total Allotted Marks:<?php echo isset($part_a_e_total_alloc_score)?$part_a_e_total_alloc_score:''; ?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>Data Source</th>
          </tr>
          
            <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_e_info']['observation_po'])?$result_array['part_a_e_info']['observation_po']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['pre_po_liab'])?$result_array['part_a_e_info']['pre_po_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['next_po_liab'])?$result_array['part_a_e_info']['next_po_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['grth_po_liab'])?$result_array['part_a_e_info']['grth_po_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['po_liab_obtained_mark'])?$result_array['part_a_e_info']['po_liab_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['po_liab_all_mark'])?$result_array['part_a_e_info']['po_liab_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_e_info']['observation_instSus'])?$result_array['part_a_e_info']['observation_instSus']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['pre_instSus_liab'])?$result_array['part_a_e_info']['pre_instSus_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['next_instSus_liab'])?$result_array['part_a_e_info']['next_instSus_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['grth_instSus_liab'])?$result_array['part_a_e_info']['grth_instSus_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['instSus_liab_obtained_mark'])?$result_array['part_a_e_info']['instSus_liab_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['instSus_liab_all_mark'])?$result_array['part_a_e_info']['instSus_liab_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>3</td>
              <td><?php echo isset($result_array['part_a_e_info']['observation_accruedExpfor'])?$result_array['part_a_e_info']['observation_accruedExpfor']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['pre_accruedExpforOther_liab'])?$result_array['part_a_e_info']['pre_accruedExpforOther_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['next_accruedExpforOther_liab'])?$result_array['part_a_e_info']['next_accruedExpforOther_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['grth_accruedExpforOther_liab'])?$result_array['part_a_e_info']['grth_accruedExpforOther_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['accruedExpfor_liab_obtained_mark'])?$result_array['part_a_e_info']['accruedExpfor_liab_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['accruedExpforOther_liab_all_ma'])?$result_array['part_a_e_info']['accruedExpforOther_liab_all_ma']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>4</td>
              <td><?php echo isset($result_array['part_a_e_info']['observation_instPayacaccInstFRD'])?$result_array['part_a_e_info']['observation_instPayacaccInstFRD']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['pre_instPayacaccInstFRD_liab'])?$result_array['part_a_e_info']['pre_instPayacaccInstFRD_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['next_instPayacaccInstFRD_liab'])?$result_array['part_a_e_info']['next_instPayacaccInstFRD_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['grth_instPayacaccInstFRD_liab'])?$result_array['part_a_e_info']['grth_instPayacaccInstFRD_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['instPayacaccInstFRD_liab_obtained_mark'])?$result_array['part_a_e_info']['instPayacaccInstFRD_liab_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['instPayacaccInstFRD_liab_all_m'])?$result_array['part_a_e_info']['instPayacaccInstFRD_liab_all_m']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>5</td>
              <td><?php echo isset($result_array['part_a_e_info']['observation_OIBTCR'])?$result_array['part_a_e_info']['observation_OIBTCR']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['pre_OIBTCR_liab'])?$result_array['part_a_e_info']['pre_OIBTCR_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['next_OIBTCR_liab'])?$result_array['part_a_e_info']['next_OIBTCR_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['grth_OIBTCR_liab'])?$result_array['part_a_e_info']['grth_OIBTCR_liab']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['OIBTCR_liab_obtained_mark'])?$result_array['part_a_e_info']['OIBTCR_liab_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_e_info']['grth_OIBTCR_liab_all_mark'])?$result_array['part_a_e_info']['grth_OIBTCR_liab_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          
          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_e_total_obtain_score = ($result_array['part_a_e_info']['po_liab_obtained_mark']+
                        $result_array['part_a_e_info']['instSus_liab_obtained_mark']+
                        $result_array['part_a_e_info']['accruedExpfor_liab_obtained_mark']+
                        $result_array['part_a_e_info']['instPayacaccInstFRD_liab_obtained_mark']+
                        $result_array['part_a_e_info']['OIBTCR_liab_obtained_mark']);
                      echo $part_a_e_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php  echo $part_a_e_total_alloc_score; ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_ae = ($part_a_e_total_obtain_score*100/$part_a_e_total_alloc_score);
                  echo number_format($obt_per_ae, 2);
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Deposit Sector</td>
              <td colspan="6" align="center">
                <?php 
                  $obt_per_ae = ($part_a_e_total_obtain_score*100/$part_a_e_total_alloc_score);
                  echo level_of_risk_part_a($obt_per_ae);            
                ?>
              </td>
          </tr>
        </table>
        <table border="1">
          <tr>
          <?php 
                  $part_a_f_total_alloc_score = ($result_array['part_a_f_info']['protested_all_mark']+
                  $result_array['part_a_f_info']['armypension_all_mark']+
                  $result_array['part_a_f_info']['other_all_mark']+
                  $result_array['part_a_f_info']['remittance_all_mark']+
                  $result_array['part_a_f_info']['OIBTDR_all_mark']+
                  $result_array['part_a_f_info']['ADVDEPSTSHPB_all_mark']+
                  $result_array['part_a_f_info']['sundryDeb_all_mark']+$result_array['part_a_f_info']['ADVDEPSTSHPB_all_mark']);
                ?>
            <th colspan="8">F. Cash & Other Assets <br> (Total Allotted Marks:<?php echo isset($part_a_f_total_alloc_score)?$part_a_f_total_alloc_score:''; ?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>Data Source</th>
          </tr>
          
            <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_protested'])?$result_array['part_a_f_info']['observation_protested']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_protested'])?$result_array['part_a_f_info']['pre_protested']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_protested'])?$result_array['part_a_f_info']['next_protested']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_protested'])?$result_array['part_a_f_info']['grth_protested']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['protested_obtained_mark'])?$result_array['part_a_f_info']['protested_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['protested_all_mark'])?$result_array['part_a_f_info']['protested_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsaback,'Affairs Back Page','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_armypension'])?$result_array['part_a_f_info']['observation_armypension']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_armypension'])?$result_array['part_a_f_info']['pre_armypension']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_armypension'])?$result_array['part_a_f_info']['next_armypension']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_armypension'])?$result_array['part_a_f_info']['grth_armypension']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['armypension_obtained_mark'])?$result_array['part_a_f_info']['armypension_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['armypension_all_mark'])?$result_array['part_a_f_info']['armypension_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsaback,'Affairs Back Page','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>3</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_other'])?$result_array['part_a_f_info']['observation_other']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_other'])?$result_array['part_a_f_info']['pre_other']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_other'])?$result_array['part_a_f_info']['next_other']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_other'])?$result_array['part_a_f_info']['grth_other']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['other_obtained_mark'])?$result_array['part_a_f_info']['other_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['other_all_mark'])?$result_array['part_a_f_info']['other_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsaback,'Affairs Back Page','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>4</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_sundryDeb'])?$result_array['part_a_f_info']['observation_sundryDeb']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_sundryDeb'])?$result_array['part_a_f_info']['pre_sundryDeb']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_sundryDeb'])?$result_array['part_a_f_info']['next_sundryDeb']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_sundryDeb'])?$result_array['part_a_f_info']['grth_sundryDeb']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['sundryDeb_obtained_mark'])?$result_array['part_a_f_info']['sundryDeb_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['sundryDeb_all_mark'])?$result_array['part_a_f_info']['sundryDeb_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsaback,'Affairs Back Page','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>5</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_remittance'])?$result_array['part_a_f_info']['observation_remittance']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_remittance_omis'])?$result_array['part_a_f_info']['pre_remittance_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_remittance_omis'])?$result_array['part_a_f_info']['next_remittance_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_remittance'])?$result_array['part_a_f_info']['grth_remittance']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['remittance_obtained_mark'])?$result_array['part_a_f_info']['remittance_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['remittance_all_mark'])?$result_array['part_a_f_info']['remittance_all_mark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>6</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_susOther'])?$result_array['part_a_f_info']['observation_susOther']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_susOther'])?$result_array['part_a_f_info']['pre_susOther']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_susOther'])?$result_array['part_a_f_info']['next_susOther']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_susOther'])?$result_array['part_a_f_info']['grth_susOther']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['susOther_obtained_mark'])?$result_array['part_a_f_info']['susOther_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['remittance_all_mark'])?$result_array['part_a_f_info']['remittance_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsaback,'Affairs Back Page','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>7</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_OIBTDR'])?$result_array['part_a_f_info']['observation_OIBTDR']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_OIBTDR'])?$result_array['part_a_f_info']['pre_OIBTDR']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_OIBTDR'])?$result_array['part_a_f_info']['next_OIBTDR']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_OIBTDR'])?$result_array['part_a_f_info']['grth_OIBTDR']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['OIBTDR_obtained_mark'])?$result_array['part_a_f_info']['OIBTDR_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['OIBTDR_all_mark'])?$result_array['part_a_f_info']['OIBTDR_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>8</td>
              <td><?php echo isset($result_array['part_a_f_info']['observation_ADVDEPSTSHPB'])?$result_array['part_a_f_info']['observation_ADVDEPSTSHPB']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['pre_ADVDEPSTSHPB'])?$result_array['part_a_f_info']['pre_ADVDEPSTSHPB']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['next_ADVDEPSTSHPB'])?$result_array['part_a_f_info']['next_ADVDEPSTSHPB']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['grth_ADVDEPSTSHPB'])?$result_array['part_a_f_info']['grth_ADVDEPSTSHPB']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['ADVDEPSTSHPB_obtained_mark'])?$result_array['part_a_f_info']['ADVDEPSTSHPB_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_f_info']['ADVDEPSTSHPB_all_mark'])?$result_array['part_a_f_info']['ADVDEPSTSHPB_all_mark']:''; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_f_total_obtain_score = ($result_array['part_a_f_info']['protested_obtained_mark']+
                        $result_array['part_a_f_info']['armypension_obtained_mark']+
                        $result_array['part_a_f_info']['other_obtained_mark']+
                        $result_array['part_a_f_info']['remittance_obtained_mark']+
                        $result_array['part_a_f_info']['OIBTDR_obtained_mark']+
                        $result_array['part_a_f_info']['ADVDEPSTSHPB_obtained_mark']+
                        $result_array['part_a_f_info']['sundryDeb_obtained_mark']+
                        $result_array['part_a_f_info']['susOther_obtained_mark']);
                      echo $part_a_f_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php echo $part_a_f_total_alloc_score; ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_af = ($part_a_f_total_obtain_score*100/$part_a_f_total_alloc_score);
                  echo number_format($obt_per_af, 2);
                  
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Cash & Other Assets</td>
              <td colspan="6" align="center">
                <?php 
                  //$obt_per_af = ($part_a_f_total_obtain_score*100/$part_a_f_total_alloc_score);
                  echo level_of_risk_part_a($obt_per_af);            
                ?>
              </td>
          </tr>
        </table>

        <table border="1">
          <tr>
          <?php 
                  $part_a_g_total_alloc_score = ($result_array['part_a_g_info']['regular_audit_obj_allMark']+
                  $result_array['part_a_g_info']['other_audit_obj_allMark']+
                  $result_array['part_a_g_info']['regular_audit_compl_allMark']+
                  $result_array['part_a_g_info']['other_audit_compl_allMark']);
                  
                ?>
            <th colspan="8">G. Audit Objections & Lack of Compliances <br> (Total Allotted Marks:<?php echo isset($part_a_g_total_alloc_score)?$part_a_g_total_alloc_score:''; ?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>Data Source</th>
          </tr>
          
            <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_g_info']['observation_regular_audit_obj'])?$result_array['part_a_g_info']['observation_regular_audit_obj']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['pre_regular_audit_obj_omis'])?$result_array['part_a_g_info']['pre_regular_audit_obj_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['next_regular_audit_obj_omis'])?$result_array['part_a_g_info']['next_regular_audit_obj_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['grth_regular_audit_obj_omis'])?$result_array['part_a_g_info']['grth_regular_audit_obj_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['regular_audit_obj_obtained_mark'])?$result_array['part_a_g_info']['regular_audit_obj_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['regular_audit_obj_allMark'])?$result_array['part_a_g_info']['regular_audit_obj_allMark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_g_info']['observation_other_audit_obj'])?$result_array['part_a_g_info']['observation_other_audit_obj']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['pre_other_audit_obj_omis'])?$result_array['part_a_g_info']['pre_other_audit_obj_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['next_other_audit_obj_omis'])?$result_array['part_a_g_info']['next_other_audit_obj_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['grth_other_audit_obj_omis'])?$result_array['part_a_g_info']['grth_other_audit_obj_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['other_audit_obj_obtained_mark'])?$result_array['part_a_g_info']['other_audit_obj_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['other_audit_obj_allMark'])?$result_array['part_a_g_info']['other_audit_obj_allMark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>3</td>
              <td><?php echo isset($result_array['part_a_g_info']['observation_regular_audit_compliance'])?$result_array['part_a_g_info']['observation_regular_audit_compliance']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['pre_reg_audit_compl_omis'])?$result_array['part_a_g_info']['pre_reg_audit_compl_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['next_reg_audit_compl_omis'])?$result_array['part_a_g_info']['next_reg_audit_compl_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['grth_regular_audit_obj_complia'])?$result_array['part_a_g_info']['grth_regular_audit_obj_complia']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['regular_audit_compliance_obtained_mark'])?$result_array['part_a_g_info']['regular_audit_compliance_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['regular_audit_compl_allMark'])?$result_array['part_a_g_info']['regular_audit_compl_allMark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td>4</td>
              <td><?php echo isset($result_array['part_a_g_info']['observation_other_audit_compliance'])?$result_array['part_a_g_info']['observation_other_audit_compliance']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['pre_ot_audit_compl_omis'])?$result_array['part_a_g_info']['pre_ot_audit_compl_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['next_ot_audit_compl_omis'])?$result_array['part_a_g_info']['next_ot_audit_compl_omis']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['grth_other_audit_obj_complianc'])?$result_array['part_a_g_info']['grth_other_audit_obj_complianc']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['other_audit_compliance_obtained_mark'])?$result_array['part_a_g_info']['other_audit_compliance_obtained_mark']:''; ?></td>
              <td><?php echo isset($result_array['part_a_g_info']['other_audit_compl_allMark'])?$result_array['part_a_g_info']['other_audit_compl_allMark']:''; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>
          
          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_g_total_obtain_score = ($result_array['part_a_g_info']['regular_audit_obj_obtained_mark']+
                        $result_array['part_a_g_info']['other_audit_obj_obtained_mark']+
                        $result_array['part_a_g_info']['regular_audit_compliance_obtained_mark']+
                        $result_array['part_a_g_info']['other_audit_compliance_obtained_mark']);
                      echo $part_a_g_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php  echo $part_a_g_total_alloc_score; ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_ag = ($part_a_g_total_obtain_score*100/$part_a_g_total_alloc_score);
                  echo number_format($obt_per_ag, 2);
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Audit Objections & Compliances </td>
              <td colspan="6" align="center">
                <?php 
                  //$obt_per_ag = ($part_a_g_total_obtain_score*100/$part_a_g_total_alloc_score);
                  echo level_of_risk_part_a($obt_per_ag);            
                ?>
              </td>
          </tr>
        </table>
          
        <table border="1">
          <tr>
          <?php 
                  $part_a_h_total_alloc_score = ($result_array['part_a_h_info']['amtofsuit_omis_allMark']+
                  $result_array['part_a_h_info']['prov_loanAd_allMark']+$result_array['part_a_h_info']['exsscashlimit_iss_allMark']);
                  
                ?>
            <th colspan="8">H. Others <br> (Total Allotted Marks:<?php echo isset($part_a_h_total_alloc_score)?$part_a_h_total_alloc_score:''; ?>)</th>
          </tr>
          <tr>
            <th>SL No.</th>
            <th>Ovservations</th>
            <th>Previous <br><?php echo isset($month_array[$report_of_month1])?$month_array[$report_of_month1]:'';?> <?php echo isset($report_of_year1)?$report_of_year1:'';?></th>
            <th>Present <br><?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
            <th>Growth <br> Rate in <br> %</th>
            <th>Awarded <br> Score</th>
            <th>Allocated <br>Mark</th>
            <th>Data Source</th>
          </tr>
          
          <tr>
              <td>1</td>
              <td><?php echo isset($result_array['part_a_h_info']['observation_amtofsuit'])?$result_array['part_a_h_info']['observation_amtofsuit']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['preamtofsuit_omis'])?$result_array['part_a_h_info']['preamtofsuit_omis']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['nextamtofsuit_omis'])?$result_array['part_a_h_info']['nextamtofsuit_omis']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['grth_amtofsuit_omis'])?$result_array['part_a_h_info']['grth_amtofsuit_omis']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['amtofsuit_obtained_mark'])?$result_array['part_a_h_info']['amtofsuit_obtained_mark']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['amtofsuit_omis_allMark'])?$result_array['part_a_h_info']['amtofsuit_omis_allMark']:'-'; ?></td>
              <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
          </tr>

          <tr>
              <td>2</td>
              <td><?php echo isset($result_array['part_a_h_info']['observation_prov_loanAd'])?$result_array['part_a_h_info']['observation_prov_loanAd']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['pre_prov_loanAd_aff'])?$result_array['part_a_h_info']['pre_prov_loanAd_aff']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['next_prov_loanAd_aff'])?$result_array['part_a_h_info']['next_prov_loanAd_aff']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['grth_prov_loanAd_aff'])?$result_array['part_a_h_info']['grth_prov_loanAd_aff']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['prov_loanAd_obtained_mark'])?$result_array['part_a_h_info']['prov_loanAd_obtained_mark']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['prov_loanAd_allMark'])?$result_array['part_a_h_info']['prov_loanAd_allMark']:'-'; ?></td>
              <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
          </tr>

            <tr>
              <td>3</td>
              <td><?php echo isset($result_array['part_a_h_info']['observation_exsscashlimit'])?$result_array['part_a_h_info']['observation_exsscashlimit']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['preexsscash_limit_iss'])?$result_array['part_a_h_info']['preexsscash_limit_iss']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['nextexsscashlimit_iss'])?$result_array['part_a_h_info']['nextexsscashlimit_iss']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['grth_exsscashlimit_iss'])?$result_array['part_a_h_info']['grth_exsscashlimit_iss']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['exsscashlimit_obtained_mark'])?$result_array['part_a_h_info']['exsscashlimit_obtained_mark']:'-'; ?></td>
              <td><?php echo isset($result_array['part_a_h_info']['exsscashlimit_iss_allMark'])?$result_array['part_a_h_info']['exsscashlimit_iss_allMark']:'-'; ?></td>
              <td><?php echo anchor($src_iss,'ISS','target="_blank"'); ?></td>
          </tr>
          <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $part_a_h_total_obtain_score = ($result_array['part_a_h_info']['amtofsuit_obtained_mark']+
                  $result_array['part_a_h_info']['prov_loanAd_obtained_mark']+
                  $result_array['part_a_h_info']['exsscashlimit_obtained_mark']);
                      echo $part_a_h_total_obtain_score;  
                ?>
              </td>
              <td>
                <?php  echo $part_a_h_total_alloc_score; ?>
              </td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td>Percentage</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <?php 
                  $obt_per_ah = ($part_a_h_total_obtain_score*100/$part_a_h_total_alloc_score);
                  echo number_format($obt_per_ah, 2);
                ?>
              </td>
              <td>100</td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2">Level of Risk for Others </td>
              <td colspan="6" align="center">
                <?php 
                  echo level_of_risk_part_a($obt_per_ah);            
                ?>
              </td>
          </tr>
        </table>
        <div class="rba-a-result-area">
          <p>Branch Performance (Deviation with Year to Year):</p><br>
          <?php $part_a_total_allMark = ($part_a_a_total_alloc_score+$part_a_b_total_alloc_score+
            $part_a_c_total_alloc_score+$part_a_d_total_alloc_score+
              $part_a_e_total_alloc_score+$part_a_f_total_alloc_score+
              $part_a_g_total_alloc_score+$part_a_h_total_alloc_score); ?>
          <table border ="1">     
            <tr>
                <th>SL No.</th>
                <th>Title</th>
                <th colspan="2">Awarded Score</th>
                <th>Allotted marks</th>
            </tr>
            <tr>
              <th></th>
              <th></th>
              <th>Previous </th>
              <th>Present </th>
              <th></th>
            </tr>
            <tr>
              <th></th>
              <th></th>
              <th><?php echo isset($report_of_year1)?$report_of_year1:''; ?></th>
              <th><?php echo isset($report_of_year2)?$report_of_year2:''; ?></th>
              <th></th>
            </tr>
            <tr>
              <th>A.</th>
              <th align="left">Deposit (<?php echo number_format((($part_a_a_total_alloc_score*100)/$part_a_total_allMark), 2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_a_total_obtain_score)?$part_a_a_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_a_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th>B.</th>
              <th align="left">Loans & Advances  (<?php echo number_format((($part_a_b_total_alloc_score*100)/$part_a_total_allMark), 2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_b_total_obtain_score)?$part_a_b_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_b_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th>C.</th>
              <th align="left">Loan Classification   (<?php echo number_format((($part_a_c_total_alloc_score*100)/$part_a_total_allMark),2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_c_total_obtain_score)?$part_a_c_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_c_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th>D.</th>
              <th align="left">Recovery from Non Performing Accounts(NPA's)(<?php echo number_format((($part_a_d_total_alloc_score*100)/$part_a_total_allMark),2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_d_total_obtain_score)?$part_a_d_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_d_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th>E.</th>
              <th align="left">Bills Payable & Other Liabilities (<?php echo number_format((($part_a_e_total_alloc_score*100)/$part_a_total_allMark), 2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_e_total_obtain_score)?$part_a_e_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_e_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th>F.</th>
              <th align="left">Cash & Other Assets (<?php echo number_format((($part_a_f_total_alloc_score*100)/$part_a_total_allMark), 2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_f_total_obtain_score)?$part_a_f_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_f_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th>G.</th>
              <th align="left">Audit Objection & Compliance (<?php echo number_format((($part_a_g_total_alloc_score*100)/$part_a_total_allMark), 2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_g_total_obtain_score)?$part_a_g_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_g_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th>H.</th>
              <th align="left">Others (<?php echo number_format((($part_a_h_total_alloc_score*100)/$part_a_total_allMark), 2); ?>%)</th>
              <th></th>
              <th><?php echo isset($part_a_h_total_obtain_score)?$part_a_h_total_obtain_score:''; ?></th>
              <th><?php echo $part_a_h_total_alloc_score; ?></th>
            </tr>
            <tr>
              <th></th>
              <th align="left">Total (100%)</th>
              <th></th>
              <th><?php 
                $part_a_total_obtain = ($part_a_a_total_obtain_score+$part_a_b_total_obtain_score+
                $part_a_c_total_obtain_score+$part_a_d_total_obtain_score+$part_a_e_total_obtain_score+
                $part_a_f_total_obtain_score+$part_a_g_total_obtain_score+$part_a_h_total_obtain_score);
                echo $part_a_total_obtain;
              ?></th>
              <th><?php echo $part_a_total_allMark; ?></th>
            </tr>
            
            <tr>
              <th></th>
              <th align="left">Percentage & Level of Risk: </th>
              <th></th>
              <th colspan="2"><?php  
              $part_a_obtain_total = $part_a_total_obtain*70/$part_a_total_allMark;
                echo number_format($part_a_obtain_total*100/300, 2);
                echo "%".", ";
                echo level_of_risk_part_ba($part_a_obtain_total*100/300);
              ?></th>
            </tr>
            <tr>
              <th></th>
              <th align="left">Total Allocated Marks for Branch</th>
              <th></th>
              <th><?php  
                $part_a_res = $part_a_total_obtain*30/$part_a_total_allMark;
                echo $part_a_res;
              ?></th>
              <th>30</th>
            </tr> 
          </table>
          </div>  
        </div>

        <div class="part-b-area">
        <h4>Part-B Branch (<?php echo isset($report_of_office)?$report_of_office:''; ?>,
          Comparing with whole bank-
          <?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?> <?php echo isset($report_of_year2)?$report_of_year2:'';?>) 
        </h4>
            <?php
            function level_of_risk_part_ba($award_score = 0){
              $level_risk = '';
              if($award_score==0){return "Low Risk";}
              if($award_score !=''){
                if($award_score>=70){
                  $level_risk = 'Extremely High Risk';
                }else if($award_score>=60 && $award_score<70){
                  $level_risk = 'High Risk';
                }else if($award_score>=40 && $award_score<60){
                  $level_risk = 'Medium Risk';
                }else{
                  if($award_score<=40){
                    $level_risk = 'Low Risk';
                  }
                }
              }
              return $level_risk; 
            }
          ?>
            <table border="1">
              <tr>
                <th colspan="8">A. Deposit <br> (Total Allocated Marks:  <?php 
                      $part_b_a_total_alloc_score = ($result_array['part_b_a_info']['br_cont_deposit_allMark']+
                      $result_array['part_b_a_info']['br_cont_no_ac_deposit_allMark']+
                      $result_array['part_b_a_info']['br_cont_high_deposit_allMark']);
                      echo number_format($part_b_a_total_alloc_score);
                    ?>)</th>
              </tr>
              <tr>
                
                <th colspan="2" rowspan="2">Ovservations</th>
                <th colspan="2">Amount in Taka</th>
                <th rowspan="2">Branch <br> Contribution <br> (%)</th>     
                <th rowspan="2">Awarded <br> Score</th>
                <th rowspan="2">Allocated <br>Mark</th>
                <th rowspan="2">Data Source</th>
              </tr>
              <tr>     
                <th>Whole bank</th>
                <th>Branch</th>
              </tr>
              <tr>
                  <th colspan="2"></th>
                  <th colspan="2" style="text-align:center">Prsent-<?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
              
                <tr>
                  <td>1</td>
                  <td><?php echo isset($result_array['part_b_a_info']['observation_deposit'])?$result_array['part_b_a_info']['observation_deposit']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['whole_deposit'])?number_format($result_array['part_b_a_info']['whole_deposit'], 2):''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_deposit'])?number_format($result_array['part_b_a_info']['br_deposit'], 2):''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_ttl_deposit_omis'])?$result_array['part_b_a_info']['br_cont_ttl_deposit_omis']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_deposit_obtained_mark'])?$result_array['part_b_a_info']['br_cont_deposit_obtained_mark']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_deposit_allMark'])?$result_array['part_b_a_info']['br_cont_deposit_allMark']:''; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>2</td>
                  <td><?php echo isset($result_array['part_b_a_info']['observation_noac'])?$result_array['part_b_a_info']['observation_noac']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['whole_br_no_ac_OMIS'])?number_format($result_array['part_b_a_info']['whole_br_no_ac_OMIS']):''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_no_ac_OMIS'])?number_format($result_array['part_b_a_info']['br_no_ac_OMIS']):''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_no_ac_deposit_omis'])?$result_array['part_b_a_info']['br_cont_no_ac_deposit_omis']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_noac_deposit_obtained_mark'])?$result_array['part_b_a_info']['br_cont_noac_deposit_obtained_mark']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_no_ac_deposit_allMark'])?$result_array['part_b_a_info']['br_cont_no_ac_deposit_allMark']:''; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>3</td>
                  <td><?php echo isset($result_array['part_b_a_info']['observation_highcost'])?$result_array['part_b_a_info']['observation_highcost']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['whole_high_deposit'])?number_format($result_array['part_b_a_info']['whole_high_deposit'], 2):''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_high_deposit'])?number_format($result_array['part_b_a_info']['br_high_deposit'], 2):''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_ttl_high_deposit_omis'])?$result_array['part_b_a_info']['br_cont_ttl_high_deposit_omis']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_high_deposit_obtained_mark'])?$result_array['part_b_a_info']['br_cont_high_deposit_obtained_mark']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_a_info']['br_cont_high_deposit_allMark'])?$result_array['part_b_a_info']['br_cont_high_deposit_allMark']:''; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td></td>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $part_b_a_total_obtain_score = ($result_array['part_b_a_info']['br_cont_deposit_obtained_mark']+
                            $result_array['part_b_a_info']['br_cont_noac_deposit_obtained_mark']+
                            $result_array['part_b_a_info']['br_cont_high_deposit_obtained_mark']);
                          echo number_format($part_b_a_total_obtain_score);  
                    ?>
                  </td>
                  <td>
                    <?php echo number_format($part_b_a_total_alloc_score); ?>
                  </td>
                  <td></td>
              </tr>

              <tr>
                  <td></td>
                  <td>Percentage</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $obt_per_ab = ($part_b_a_total_obtain_score*100/$part_b_a_total_alloc_score);
                      echo number_format($obt_per_ab, 2);
                    ?>
                  </td>
                  <td>100</td>
                  <td></td>
              </tr>
              <tr>
                  <td colspan="2">Level of Risk for Deposit Sector</td>
                  <td colspan="6" align="center">
                    <?php 
                      echo level_of_risk_part_ba($obt_per_ab);            
                    ?>
                  </td>
              </tr>
            </table>

            <table border="1">
              <tr>
                <th colspan="8">B. Loans & Advances <br> (Total Allocated Marks:  <?php 
                      $part_b_b_total_alloc_score = ($result_array['part_b_b_info']['loanAdvance_allMark']+
                      $result_array['part_b_b_info']['loanACNo_allMark']+$result_array['part_b_b_info']['conDemTermLoan_allMark']+
                      $result_array['part_b_b_info']['agriLoan_allMark']+$result_array['part_b_b_info']['otherLoan_allMark']+
                      $result_array['part_b_b_info']['clLoan_allMark']+$result_array['part_b_b_info']['timeBarredLoan_allMark']+
                      $result_array['part_b_b_info']['instsuspenseac_allMark']+$result_array['part_b_b_info']['rescheduleLoan_allMark']+
                      $result_array['part_b_b_info']['interestwaivefrmloan_allMark']+$result_array['part_b_b_info']['suitundesposedoff_allMark']+
                      $result_array['part_b_b_info']['nosuitundesposedoff_allMark']+$result_array['part_b_b_info']['loanAdvRwriteoff_allMark']+
                      $result_array['part_b_b_info']['provision_allMark']+$result_array['part_b_b_info']['br_cont_wtiteoffloan_allMark']);
                      echo number_format($part_b_b_total_alloc_score);
                    ?>)</th>
              </tr>
              <tr>
                
                <th colspan="2" rowspan="2">Ovservations</th>
                <th colspan="2">Amount in Taka</th>
                <th rowspan="2">Branch <br> Contribution <br> (%)</th>     
                <th rowspan="2">Awarded <br> Score</th>
                <th rowspan="2">Allocated <br>Mark</th>
                <th rowspan="2">Data Source</th>
              </tr>
              <tr>     
                <th>Whole bank</th>
                <th>Branch</th>
              </tr>
              <tr>
                  <th colspan="2"></th>
                  <th colspan="2" style="text-align:center">Prsent-<?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
              
                <tr>
                  <td>i)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_loanAdvance'])?$result_array['part_b_b_info']['observation_loanAdvance']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_loanAdavnce_omis'])?number_format($result_array['part_b_b_info']['whole_br_loanAdavnce_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_loanAdavnce_omis'])?number_format($result_array['part_b_b_info']['br_loanAdavnce_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_loanAdvance_omis'])?$result_array['part_b_b_info']['br_cont_loanAdvance_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['loanAdvance_obtained_mark'])?$result_array['part_b_b_info']['loanAdvance_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['loanAdvance_allMark'])?$result_array['part_b_b_info']['loanAdvance_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>ii)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_loanACNo'])?$result_array['part_b_b_info']['observation_loanACNo']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_loanACNo_omis'])?number_format($result_array['part_b_b_info']['whole_br_loanACNo_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_loanACNo_omis'])?number_format($result_array['part_b_b_info']['br_loanACNo_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_loanACNo_omis'])?$result_array['part_b_b_info']['br_cont_loanACNo_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['loanACNo_obtained_mark'])?$result_array['part_b_b_info']['loanACNo_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['loanACNo_allMark'])?$result_array['part_b_b_info']['loanACNo_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iii)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_conDemTermLoan'])?$result_array['part_b_b_info']['observation_conDemTermLoan']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_conDemTermLoan_omis'])?number_format($result_array['part_b_b_info']['whole_br_conDemTermLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_conDemTermLoan_omis'])?number_format($result_array['part_b_b_info']['br_conDemTermLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_conDemTermLoan_omis'])?$result_array['part_b_b_info']['br_cont_conDemTermLoan_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['conDemTermLoan_obtained_mark'])?$result_array['part_b_b_info']['conDemTermLoan_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['conDemTermLoan_allMark'])?$result_array['part_b_b_info']['conDemTermLoan_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iv)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_agriLoan'])?$result_array['part_b_b_info']['observation_agriLoan']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_agriLoan_omis'])?number_format($result_array['part_b_b_info']['whole_br_agriLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_agriLoan_omis'])?number_format($result_array['part_b_b_info']['br_agriLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_agriLoan_omis'])?$result_array['part_b_b_info']['br_cont_agriLoan_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['agriLoan_obtained_mark'])?$result_array['part_b_b_info']['agriLoan_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['agriLoan_allMark'])?$result_array['part_b_b_info']['agriLoan_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>v)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_otherLoan'])?$result_array['part_b_b_info']['observation_otherLoan']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_otherLoan_omis'])?number_format($result_array['part_b_b_info']['whole_br_otherLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_otherLoan_omis'])?number_format($result_array['part_b_b_info']['br_otherLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_otherLoan_omis'])?$result_array['part_b_b_info']['br_cont_otherLoan_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['otherLoan_obtained_mark'])?$result_array['part_b_b_info']['otherLoan_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['otherLoan_allMark'])?$result_array['part_b_b_info']['otherLoan_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>vi)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_clLoan'])?$result_array['part_b_b_info']['observation_clLoan']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_clLoan_omis'])?number_format($result_array['part_b_b_info']['whole_br_clLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_clLoan_omis'])?number_format($result_array['part_b_b_info']['br_clLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_clLoan_omis'])?$result_array['part_b_b_info']['br_cont_clLoan_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['clLoan_obtained_mark'])?$result_array['part_b_b_info']['clLoan_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['clLoan_allMark'])?$result_array['part_b_b_info']['clLoan_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>vii)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_timeBarredLoan'])?$result_array['part_b_b_info']['observation_timeBarredLoan']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_timeBarredLoan_omis'])?number_format($result_array['part_b_b_info']['whole_br_timeBarredLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_timeBarredLoan_omis'])?number_format($result_array['part_b_b_info']['br_timeBarredLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_timeBarredLoan_omis'])?$result_array['part_b_b_info']['br_cont_timeBarredLoan_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['timeBarredLoan_obtained_mark'])?$result_array['part_b_b_info']['timeBarredLoan_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['timeBarredLoan_allMark'])?$result_array['part_b_b_info']['timeBarredLoan_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>viii)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_instsuspenseac'])?$result_array['part_b_b_info']['observation_instsuspenseac']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_instsuspenseac_aff'])?number_format($result_array['part_b_b_info']['whole_br_instsuspenseac_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_instsuspenseac_aff'])?number_format($result_array['part_b_b_info']['br_instsuspenseac_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_instsuspenseac_aff'])?$result_array['part_b_b_info']['br_cont_instsuspenseac_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['instsuspenseac_obtained_mark'])?$result_array['part_b_b_info']['instsuspenseac_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['instsuspenseac_allMark'])?$result_array['part_b_b_info']['instsuspenseac_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>ix)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_rescheduleLoan'])?$result_array['part_b_b_info']['observation_rescheduleLoan']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_rescheduleLoan_omis'])?number_format($result_array['part_b_b_info']['whole_br_rescheduleLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_rescheduleLoan_omis'])?number_format($result_array['part_b_b_info']['br_rescheduleLoan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_rescheduleLoan_omis'])?$result_array['part_b_b_info']['br_cont_rescheduleLoan_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['rescheduleLoan_obtained_mark'])?$result_array['part_b_b_info']['rescheduleLoan_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['rescheduleLoan_allMark'])?$result_array['part_b_b_info']['rescheduleLoan_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>x)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_interestwaivefrmloan'])?$result_array['part_b_b_info']['observation_interestwaivefrmloan']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_instwvefrmloan_omis'])?number_format($result_array['part_b_b_info']['whole_br_instwvefrmloan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_interestwaivefrmloan_omis'])?number_format($result_array['part_b_b_info']['br_interestwaivefrmloan_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_instwavfrmloan_omis'])?$result_array['part_b_b_info']['br_cont_instwavfrmloan_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['interestwaivefrmloan_obtained_mark'])?$result_array['part_b_b_info']['interestwaivefrmloan_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['interestwaivefrmloan_allMark'])?$result_array['part_b_b_info']['interestwaivefrmloan_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>xi)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_wtiteoffloan'])?$result_array['part_b_b_info']['observation_wtiteoffloan']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_wtiteoffloan_iss'])?number_format($result_array['part_b_b_info']['whole_br_wtiteoffloan_iss'], 2):''; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_wtiteoffloan_iss'])?number_format($result_array['part_b_b_info']['br_wtiteoffloan_iss'], 2):''; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_wtiteoffloan_iss'])?$result_array['part_b_b_info']['br_cont_wtiteoffloan_iss']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['wtiteoffloan_obtained_mark'])?$result_array['part_b_b_info']['wtiteoffloan_obtained_mark']:''; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_wtiteoffloan_allMark'])?$result_array['part_b_b_info']['br_cont_wtiteoffloan_allMark']:''; ?></td>
                  <td><?php echo anchor($src_iss,'ISS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>xii)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_suitundesposedoff'])?$result_array['part_b_b_info']['observation_suitundesposedoff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_suitundesoff_omis'])?number_format($result_array['part_b_b_info']['whole_br_suitundesoff_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_suitundesposedoff_omis'])?number_format($result_array['part_b_b_info']['br_suitundesposedoff_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_suitundesposedoff_omis'])?$result_array['part_b_b_info']['br_cont_suitundesposedoff_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['suitundesposedoff_obtained_mark'])?$result_array['part_b_b_info']['suitundesposedoff_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['suitundesposedoff_allMark'])?$result_array['part_b_b_info']['suitundesposedoff_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>xiii)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_nosuitundesposedoff'])?$result_array['part_b_b_info']['observation_nosuitundesposedoff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_nosuitundesposedoff_omis'])?number_format($result_array['part_b_b_info']['whole_br_nosuitundesposedoff_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_nosuitundesposedoff_omis'])?number_format($result_array['part_b_b_info']['br_nosuitundesposedoff_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_nosuitundesposedoff_omis'])?$result_array['part_b_b_info']['br_cont_nosuitundesposedoff_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['nosuitundesposedoff_obtained_mark'])?$result_array['part_b_b_info']['nosuitundesposedoff_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['nosuitundesposedoff_allMark'])?$result_array['part_b_b_info']['nosuitundesposedoff_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>xiv)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_loanAdvRwriteoff'])?$result_array['part_b_b_info']['observation_loanAdvRwriteoff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_loanAdvRwriteoff_omis'])?number_format($result_array['part_b_b_info']['whole_br_loanAdvRwriteoff_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_loanAdvRwriteoff_omis'])?number_format($result_array['part_b_b_info']['br_loanAdvRwriteoff_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_loanAdvRwriteoff_omis'])?$result_array['part_b_b_info']['br_cont_loanAdvRwriteoff_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['loanAdvRwriteoff_obtained_mark'])?$result_array['part_b_b_info']['loanAdvRwriteoff_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['loanAdvRwriteoff_allMark'])?$result_array['part_b_b_info']['loanAdvRwriteoff_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>xv)</td>
                  <td><?php echo isset($result_array['part_b_b_info']['observation_provision'])?$result_array['part_b_b_info']['observation_provision']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['whole_br_provision_aff'])?number_format($result_array['part_b_b_info']['whole_br_provision_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_provision_aff'])?number_format($result_array['part_b_b_info']['br_provision_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['br_cont_provision_aff'])?$result_array['part_b_b_info']['br_cont_provision_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['provision_obtained_mark'])?$result_array['part_b_b_info']['provision_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_b_info']['provision_allMark'])?$result_array['part_b_b_info']['provision_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td></td>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $part_b_b_total_obtain_score = ($result_array['part_b_b_info']['loanAdvance_obtained_mark']+
                      $result_array['part_b_b_info']['loanACNo_obtained_mark']+$result_array['part_b_b_info']['conDemTermLoan_obtained_mark']+
                      $result_array['part_b_b_info']['agriLoan_obtained_mark']+$result_array['part_b_b_info']['otherLoan_obtained_mark']+
                      $result_array['part_b_b_info']['clLoan_obtained_mark']+$result_array['part_b_b_info']['timeBarredLoan_obtained_mark']+
                      $result_array['part_b_b_info']['instsuspenseac_obtained_mark']+$result_array['part_b_b_info']['rescheduleLoan_obtained_mark']+
                      $result_array['part_b_b_info']['interestwaivefrmloan_obtained_mark']+$result_array['part_b_b_info']['suitundesposedoff_obtained_mark']+
                      $result_array['part_b_b_info']['nosuitundesposedoff_obtained_mark']+$result_array['part_b_b_info']['loanAdvRwriteoff_obtained_mark']+
                      $result_array['part_b_b_info']['provision_obtained_mark']+$result_array['part_b_b_info']['wtiteoffloan_obtained_mark']);
                          echo number_format($part_b_b_total_obtain_score);  
                    ?>
                  </td>
                  <td>
                    <?php echo number_format($part_b_b_total_alloc_score); ?>
                  </td>
                  <td></td>
              </tr>

              <tr>
                  <td></td>
                  <td>Percentage</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $obt_per_bb = ($part_b_b_total_obtain_score*100/$part_b_b_total_alloc_score);
                      echo number_format($obt_per_bb, 2);
                    ?>
                  </td>
                  <td>100</td>
                  <td></td>
              </tr>
              <tr>
                  <td colspan="2">Level of Risk for Loans & Advances</td>
                  <td colspan="6" align="center">
                    <?php 
                      echo level_of_risk_part_ba($obt_per_bb);            
                    ?>
                  </td>
              </tr>
            </table>
            <table border="1">
              <tr>
                <th colspan="8">C. Bills Payable & Other Liabilities <br> (Total Allocated Marks:  <?php 
                      $part_b_c_total_alloc_score = ($result_array['part_b_c_info']['billpotL_allMark']+$result_array['part_b_c_info']['cashHand_allMark']+
                      $result_array['part_b_c_info']['remitt_allMark']+$result_array['part_b_c_info']['suspenseAmt_allMark']+
                      $result_array['part_b_c_info']['protestedBill_allMark']+$result_array['part_b_c_info']['armypension_allMark']+
                      $result_array['part_b_c_info']['sundryAssetOt_allMark']);
                      echo number_format($part_b_c_total_alloc_score);
                    ?>)</th>
              </tr>
              <tr>
                
                <th colspan="2" rowspan="2">Ovservations</th>
                <th colspan="2">Amount in Taka</th>
                <th rowspan="2">Branch <br> Contribution <br> (%)</th>     
                <th rowspan="2">Awarded <br> Score</th>
                <th rowspan="2">Allocated <br>Mark</th>
                <th rowspan="2">Data Source</th>
              </tr>
              <tr>     
                <th>Whole bank</th>
                <th>Branch</th>
              </tr>
              <tr>
                  <th colspan="2"></th>
                  <th colspan="2">Prsent-<?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
              
                <tr>
                  <td>i)</td>
                  <td><?php echo isset($result_array['part_b_c_info']['observation_billpotL'])?$result_array['part_b_c_info']['observation_billpotL']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['whole_br_billpotL_aff'])?number_format($result_array['part_b_c_info']['whole_br_billpotL_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_billpotL_aff'])?number_format($result_array['part_b_c_info']['br_billpotL_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cont_billpotL_aff'])?$result_array['part_b_c_info']['br_cont_billpotL_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['billpotL_obtained_mark'])?$result_array['part_b_c_info']['billpotL_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['billpotL_allMark'])?$result_array['part_b_c_info']['billpotL_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>ii)</td>
                  <td><?php echo isset($result_array['part_b_c_info']['observation_cashhand'])?$result_array['part_b_c_info']['observation_cashhand']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['whole_br_cashHand_aff'])?number_format($result_array['part_b_c_info']['whole_br_cashHand_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cashHand_aff'])?number_format($result_array['part_b_c_info']['br_cashHand_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cont_cashhand_aff'])?$result_array['part_b_c_info']['br_cont_cashhand_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['cashhand_obtained_mark'])?$result_array['part_b_c_info']['cashhand_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['cashHand_allMark'])?$result_array['part_b_c_info']['cashHand_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iii)</td>
                  <td><?php echo isset($result_array['part_b_c_info']['observation_remit'])?$result_array['part_b_c_info']['observation_remit']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['whole_br_remitt_omis'])?number_format($result_array['part_b_c_info']['whole_br_remitt_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_remitt_omis'])?number_format($result_array['part_b_c_info']['br_remitt_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cont_remitt_omis'])?$result_array['part_b_c_info']['br_cont_remitt_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['remit_obtained_mark'])?$result_array['part_b_c_info']['remit_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['remitt_allMark'])?$result_array['part_b_c_info']['remitt_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iv)</td>
                  <td><?php echo isset($result_array['part_b_c_info']['observation_suspenseAmt'])?$result_array['part_b_c_info']['observation_suspenseAmt']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['whole_br_suspenseAmt_aff'])?number_format($result_array['part_b_c_info']['whole_br_suspenseAmt_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_suspenseAmt_aff'])?number_format($result_array['part_b_c_info']['br_suspenseAmt_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cont_suspenseAmt_aff'])?$result_array['part_b_c_info']['br_cont_suspenseAmt_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['suspenseAmt_obtained_mark'])?$result_array['part_b_c_info']['suspenseAmt_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['suspenseAmt_allMark'])?$result_array['part_b_c_info']['suspenseAmt_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>v)</td>
                  <td><?php echo isset($result_array['part_b_c_info']['observation_protestedBill'])?$result_array['part_b_c_info']['observation_protestedBill']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['whole_br_protestedBill_aff'])?number_format($result_array['part_b_c_info']['whole_br_protestedBill_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_protestedBill_aff'])?number_format($result_array['part_b_c_info']['br_protestedBill_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cont_protestedBill_aff'])?$result_array['part_b_c_info']['br_cont_protestedBill_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['protestedBill_obtained_mark'])?$result_array['part_b_c_info']['protestedBill_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['protestedBill_allMark'])?$result_array['part_b_c_info']['protestedBill_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsaback,'Affairs Back Page','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>vi)</td>
                  <td><?php echo isset($result_array['part_b_c_info']['observation_armypension'])?$result_array['part_b_c_info']['observation_armypension']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['whole_br_armypension_aff'])?number_format($result_array['part_b_c_info']['whole_br_armypension_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_armypension_aff'])?number_format($result_array['part_b_c_info']['br_armypension_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cont_armypension_aff'])?$result_array['part_b_c_info']['br_cont_armypension_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['armypension_obtained_mark'])?$result_array['part_b_c_info']['armypension_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['armypension_allMark'])?$result_array['part_b_c_info']['armypension_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsaback,'Affairs Back Page','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>vii)</td>
                  <td><?php echo isset($result_array['part_b_c_info']['observation_sundryAssetOt'])?$result_array['part_b_c_info']['observation_sundryAssetOt']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['whole_br_sundryAssetOt_aff'])?number_format($result_array['part_b_c_info']['whole_br_sundryAssetOt_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_sundryAssetOt_aff'])?number_format($result_array['part_b_c_info']['br_sundryAssetOt_aff'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['br_cont_sundryAssetOt_aff'])?$result_array['part_b_c_info']['br_cont_sundryAssetOt_aff']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['sundryAssetOt_obtained_mark'])?$result_array['part_b_c_info']['sundryAssetOt_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_c_info']['sundryAssetOt_allMark'])?$result_array['part_b_c_info']['sundryAssetOt_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_dsa,'Affairs','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td></td>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $part_b_c_total_obtain_score = ($result_array['part_b_c_info']['billpotL_obtained_mark']+$result_array['part_b_c_info']['cashhand_obtained_mark']+
                      $result_array['part_b_c_info']['remit_obtained_mark']+$result_array['part_b_c_info']['suspenseAmt_obtained_mark']+
                      $result_array['part_b_c_info']['protestedBill_obtained_mark']+$result_array['part_b_c_info']['armypension_obtained_mark']+
                      $result_array['part_b_c_info']['sundryAssetOt_obtained_mark']);
                          echo number_format($part_b_c_total_obtain_score);  
                    ?>
                  </td>
                  <td>
                    <?php echo number_format($part_b_c_total_alloc_score); ?>
                  </td>
                  <td></td>
              </tr>

              <tr>
                  <td></td>
                  <td>Percentage</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $obt_per_bc = ($part_b_c_total_obtain_score*100/$part_b_c_total_alloc_score);
                      echo number_format($obt_per_bc, 2);
                    ?>
                  </td>
                  <td>100</td>
                  <td></td>
              </tr>
              <tr>
                  <td colspan="2">Level of Risk for Bills Payable & Other Liabilities</td>
                  <td colspan="6" align="center">
                    <?php 
                      echo level_of_risk_part_ba($obt_per_bc);            
                    ?>
                  </td>
              </tr>
            </table>

            <table border="1">
              <tr>
                <th colspan="8">D. Loans & Advances-Foreign Exchange & International Trade <br> (Total Allocated Marks:  <?php 
                      $part_b_d_total_alloc_score = ($result_array['part_b_d_info']['import_amt_allMark']+
                      $result_array['part_b_d_info']['import_ac_allMark']+$result_array['part_b_d_info']['export_amt_allMark']+
                      $result_array['part_b_d_info']['export_ac_allMark']);
                      echo number_format($part_b_d_total_alloc_score);
                    ?>)</th>
              </tr>
              <tr>
                
                <th colspan="2" rowspan="2">Ovservations</th>
                <th colspan="2">Amount in Taka</th>
                <th rowspan="2">Branch <br> Contribution <br> (%)</th>     
                <th rowspan="2">Awarded <br> Score</th>
                <th rowspan="2">Allocated <br>Mark</th>
                <th rowspan="2">Data Source</th>
              </tr>
              <tr>     
                <th>Whole bank</th>
                <th>Branch</th>
              </tr>
              <tr>
                  <th colspan="2"></th>
                  <th colspan="2">Prsent-<?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
              
                <tr>
                  <td>i)</td>
                  <td><?php echo isset($result_array['part_b_d_info']['observation_importAmt'])?$result_array['part_b_d_info']['observation_importAmt']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['whole_br_import_amt_omis'])?number_format($result_array['part_b_d_info']['whole_br_import_amt_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_import_amt_omis'])?number_format($result_array['part_b_d_info']['br_import_amt_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_cont_import_amt_omis'])?$result_array['part_b_d_info']['br_cont_import_amt_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['import_amt_obtained_mark'])?$result_array['part_b_d_info']['import_amt_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['import_amt_allMark'])?$result_array['part_b_d_info']['import_amt_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>ii)</td>
                  <td><?php echo isset($result_array['part_b_d_info']['observation_importAc'])?$result_array['part_b_d_info']['observation_importAc']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['whole_br_import_ac_omis'])?number_format($result_array['part_b_d_info']['whole_br_import_ac_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_import_ac_omis'])?number_format($result_array['part_b_d_info']['br_import_ac_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_cont_import_ac_omis'])?$result_array['part_b_d_info']['br_cont_import_ac_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['import_ac_obtained_mark'])?$result_array['part_b_d_info']['import_ac_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['import_ac_allMark'])?$result_array['part_b_d_info']['import_ac_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iii)</td>
                  <td><?php echo isset($result_array['part_b_d_info']['observation_exportAmt'])?$result_array['part_b_d_info']['observation_exportAmt']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['whole_br_export_amt_omis'])?number_format($result_array['part_b_d_info']['whole_br_export_amt_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_export_amt_omis'])?number_format($result_array['part_b_d_info']['br_export_amt_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_cont_export_amt_omis'])?$result_array['part_b_d_info']['br_cont_export_amt_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['export_amt_obtained_mark'])?$result_array['part_b_d_info']['export_amt_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['export_amt_allMark'])?$result_array['part_b_d_info']['export_amt_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iv)</td>
                  <td><?php echo isset($result_array['part_b_d_info']['observation_exportAc'])?$result_array['part_b_d_info']['observation_exportAc']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['whole_br_export_ac_omis'])?number_format($result_array['part_b_d_info']['whole_br_export_ac_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_export_ac_omis'])?number_format($result_array['part_b_d_info']['br_export_ac_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['br_cont_export_ac_omis'])?$result_array['part_b_d_info']['br_cont_export_ac_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['export_ac_obtained_mark'])?$result_array['part_b_d_info']['export_ac_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_d_info']['export_ac_allMark'])?$result_array['part_b_d_info']['export_ac_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td></td>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $part_b_d_total_obtain_score = ($result_array['part_b_d_info']['import_amt_obtained_mark']+
                      $result_array['part_b_d_info']['import_ac_obtained_mark']+$result_array['part_b_d_info']['export_amt_obtained_mark']+
                      $result_array['part_b_d_info']['export_ac_obtained_mark']);
                          echo number_format($part_b_d_total_obtain_score);  
                    ?>
                  </td>
                  <td>
                    <?php echo number_format($part_b_d_total_alloc_score); ?>
                  </td>
                  <td></td>
              </tr>

              <tr>
                  <td></td>
                  <td>Percentage</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $obt_per_bd = ($part_b_d_total_obtain_score*100/$part_b_d_total_alloc_score);
                      echo number_format($obt_per_bd, 2);
                    ?>
                  </td>
                  <td>100</td>
                  <td></td>
              </tr>
              <tr>
                  <td colspan="2">Level of Risk for Loans & Advances-Foreign Exchange & International Trade</td>
                  <td colspan="6" align="center">
                    <?php 
                      echo level_of_risk_part_ba($obt_per_bd);    
                    ?>
                  </td>
              </tr>
            </table>

            <table border="1">
              <tr>
                <th colspan="8">E. Audit/Inspection Objections & Compliances <br> (Total Allocated Marks:  <?php 
                      $part_b_e_total_alloc_score = ($result_array['part_b_e_info']['unCompAud_int_allMark']+
                      $result_array['part_b_e_info']['CompAud_int_allMark']+$result_array['part_b_e_info']['unCompAud_ot_allMark']+
                      $result_array['part_b_e_info']['CompAud_ot_allMark']);
                      echo number_format($part_b_e_total_alloc_score);
                    ?>)</th>
              </tr>
              <tr>
                
                <th colspan="2" rowspan="2">Ovservations</th>
                <th colspan="2">Amount in Taka</th>
                <th rowspan="2">Branch <br> Contribution <br> (%)</th>     
                <th rowspan="2">Awarded <br> Score</th>
                <th rowspan="2">Allocated <br>Mark</th>
                <th rowspan="2">Data Source</th>
              </tr>
              <tr>     
                <th>Whole bank</th>
                <th>Branch</th>
              </tr>
              <tr>
                  <th colspan="2"></th>
                  <th colspan="2">Prsent-<?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
              
              <tr>
                  <td>i)</td>
                  <td><?php echo isset($result_array['part_b_e_info']['observation_unCompAud_int'])?$result_array['part_b_e_info']['observation_unCompAud_int']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['whole_br_unCompAud_internal_omis'])?number_format($result_array['part_b_e_info']['whole_br_unCompAud_internal_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_unCompAud_internal_omis'])?number_format($result_array['part_b_e_info']['br_unCompAud_internal_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_cont_unCompAud_int_omis'])?$result_array['part_b_e_info']['br_cont_unCompAud_int_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['unCompAud_int_obtained_mark'])?$result_array['part_b_e_info']['unCompAud_int_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['unCompAud_int_allMark'])?$result_array['part_b_e_info']['unCompAud_int_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>ii)</td>
                  <td><?php echo isset($result_array['part_b_e_info']['observation_CompAud_int'])?$result_array['part_b_e_info']['observation_CompAud_int']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['whole_br_CompAud_internal_omis'])?number_format($result_array['part_b_e_info']['whole_br_CompAud_internal_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_CompAud_internal_omis'])?number_format($result_array['part_b_e_info']['br_CompAud_internal_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_cont_CompAud_int_omis'])?$result_array['part_b_e_info']['br_cont_CompAud_int_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['CompAud_int_obtained_mark'])?$result_array['part_b_e_info']['CompAud_int_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['CompAud_int_allMark'])?$result_array['part_b_e_info']['CompAud_int_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iii )</td>
                  <td><?php echo isset($result_array['part_b_e_info']['observation_unCompAud_ot'])?$result_array['part_b_e_info']['observation_unCompAud_ot']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['whole_br_unCompAud_other_omis'])?number_format($result_array['part_b_e_info']['whole_br_unCompAud_other_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_unCompAud_other_omis'])?number_format($result_array['part_b_e_info']['br_unCompAud_other_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_cont_unCompAud_ot_omis'])?$result_array['part_b_e_info']['br_cont_unCompAud_ot_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['unCompAud_ot_obtained_mark'])?$result_array['part_b_e_info']['unCompAud_ot_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['unCompAud_ot_allMark'])?$result_array['part_b_e_info']['unCompAud_ot_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iv)</td>
                  <td><?php echo isset($result_array['part_b_e_info']['observation_CompAud_ot'])?$result_array['part_b_e_info']['observation_CompAud_ot']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['whole_br_CompAud_other_omis'])?number_format($result_array['part_b_e_info']['whole_br_CompAud_other_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_CompAud_other_omis'])?number_format($result_array['part_b_e_info']['br_CompAud_other_omis'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['br_cont_CompAud_ot_omis'])?$result_array['part_b_e_info']['br_cont_CompAud_ot_omis']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['CompAud_ot_obtained_mark'])?$result_array['part_b_e_info']['CompAud_ot_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_e_info']['CompAud_ot_allMark'])?$result_array['part_b_e_info']['CompAud_ot_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_omis,'OMIS','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td></td>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $part_b_e_total_obtain_score = ($result_array['part_b_e_info']['unCompAud_int_obtained_mark']+
                      $result_array['part_b_e_info']['CompAud_int_obtained_mark']+$result_array['part_b_e_info']['unCompAud_ot_obtained_mark']+
                      $result_array['part_b_e_info']['CompAud_ot_obtained_mark']);
                          echo number_format($part_b_e_total_obtain_score);  
                    ?>
                  </td>
                  <td>
                    <?php 
                    
                      echo number_format($part_b_e_total_alloc_score);
                    ?>
                  </td>
                  <td></td>
              </tr>

              <tr>
                  <td></td>
                  <td>Percentage</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $obt_per_be = ($part_b_e_total_obtain_score*100/$part_b_e_total_alloc_score);
                      echo number_format($obt_per_be, 2);
                    ?>
                  </td>
                  <td>100</td>
                  <td></td>
              </tr>
              <tr>
                  <td colspan="2">Level of Risk for Loans & Advances-Foreign Exchange & International Trade</td>
                  <td colspan="6" align="center">
                    <?php 
                      echo level_of_risk_part_ba($obt_per_be);    
                    ?>
                  </td>
              </tr>
            </table>  

            <table border="1">
              <tr>
                <th colspan="8">F. Others <br> (Total Allocated Marks:  <?php 
                      $part_b_f_total_alloc_score = ($result_array['part_b_f_info']['intIncome_allMark']+
                      $result_array['part_b_f_info']['otherIncome_allMark']+$result_array['part_b_f_info']['expenditure_allMark']+
                      $result_array['part_b_f_info']['pl_allMark']);
                      echo number_format($part_b_f_total_alloc_score);
                    ?>)</th>
              </tr>
              <tr>
                
                <th colspan="2" rowspan="2">Ovservations</th>
                <th colspan="2">Amount in Taka</th>
                <th rowspan="2">Branch <br> Contribution <br> (%)</th>     
                <th rowspan="2">Awarded <br> Score</th>
                <th rowspan="2">Allocated <br>Mark</th>
                <th rowspan="2">Data Source</th>
              </tr>
              <tr>     
                <th>Whole bank</th>
                <th>Branch</th>
              </tr>
              <tr>
                  <th colspan="2"></th>
                  <th colspan="2">Prsent-<?php echo isset($report_of_year2)?$report_of_year2:'';?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
              
              <tr>
                  <td>i)</td>
                  <td><?php echo isset($result_array['part_b_f_info']['observation_intIncome'])?$result_array['part_b_f_info']['observation_intIncome']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['whole_br_intIncome_pl'])?number_format($result_array['part_b_f_info']['whole_br_intIncome_pl'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['br_intIncome_pl'])?number_format($result_array['part_b_f_info']['br_intIncome_pl'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['br_cont_intIncome_pl'])?$result_array['part_b_f_info']['br_cont_intIncome_pl']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['intIncome_obtained_mark'])?$result_array['part_b_f_info']['intIncome_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['intIncome_allMark'])?$result_array['part_b_f_info']['intIncome_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_pl,'PL','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>ii)</td>
                  <td><?php echo isset($result_array['part_b_f_info']['observation_otherIncome'])?$result_array['part_b_f_info']['observation_otherIncome']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['whole_br_otherIncome_pl'])?number_format($result_array['part_b_f_info']['whole_br_otherIncome_pl'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['br_otherIncome_pl'])?number_format($result_array['part_b_f_info']['br_otherIncome_pl'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['br_cont_otherIncome_pl'])?$result_array['part_b_f_info']['br_cont_otherIncome_pl']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['otherIncome_obtained_mark'])?$result_array['part_b_f_info']['otherIncome_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['otherIncome_allMark'])?$result_array['part_b_f_info']['otherIncome_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_pl,'PL','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iii)</td>
                  <td><?php echo isset($result_array['part_b_f_info']['observation_expenditure'])?$result_array['part_b_f_info']['observation_expenditure']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['whole_br_expenditure_pl'])?number_format($result_array['part_b_f_info']['whole_br_expenditure_pl'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['br_expenditure_pl'])?number_format($result_array['part_b_f_info']['br_expenditure_pl'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['br_cont_expenditure_pl'])?$result_array['part_b_f_info']['br_cont_expenditure_pl']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['expenditure_obtained_mark'])?$result_array['part_b_f_info']['expenditure_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['expenditure_allMark'])?$result_array['part_b_f_info']['expenditure_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_pl,'PL','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td>iv)</td>
                  <td><?php echo isset($result_array['part_b_f_info']['observation_pl'])?$result_array['part_b_f_info']['observation_pl']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['pl_whole_br'])?number_format($result_array['part_b_f_info']['pl_whole_br'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['pl_br'])?number_format($result_array['part_b_f_info']['pl_br'], 2):'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['br_con_pl'])?$result_array['part_b_f_info']['br_con_pl']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['pl_obtained_mark'])?$result_array['part_b_f_info']['pl_obtained_mark']:'-'; ?></td>
                  <td><?php echo isset($result_array['part_b_f_info']['pl_allMark'])?$result_array['part_b_f_info']['pl_allMark']:'-'; ?></td>
                  <td><?php echo anchor($src_pl,'PL','target="_blank"'); ?></td>
              </tr>
              <tr>
                  <td></td>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $part_b_f_total_obtain_score = ($result_array['part_b_f_info']['intIncome_obtained_mark']+
                      $result_array['part_b_f_info']['otherIncome_obtained_mark']+$result_array['part_b_f_info']['expenditure_obtained_mark']+
                      $result_array['part_b_f_info']['pl_obtained_mark']);
                          echo number_format($part_b_f_total_obtain_score);  
                    ?>
                  </td>
                  <td>
                    <?php 
                    
                      echo number_format($part_b_f_total_alloc_score);
                    ?>
                  </td>
                  <td></td>
              </tr>

              <tr>
                  <td></td>
                  <td>Percentage</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <?php 
                      $obt_per_bf = ($part_b_f_total_obtain_score*100/$part_b_f_total_alloc_score);
                      echo number_format($obt_per_bf, 2);
                    ?>
                  </td>
                  <td>100</td>
                  <td></td>
              </tr>
              <tr>
                  <td colspan="2">Level of Risk for Others</td>
                  <td colspan="6" align="center">
                    <?php 
                      echo level_of_risk_part_ba($obt_per_bf);    
                    ?>
                  </td>
              </tr>
            </table>  
            
          </div>

          <div class="rba-b-result-area">
              <p>At a glance: (Comparing branch contribution with whole bank exposure)</p>
              <?php $part_b_total_allMark = ($part_b_a_total_alloc_score+$part_b_b_total_alloc_score+
            $part_b_c_total_alloc_score+$part_b_d_total_alloc_score+$part_b_e_total_alloc_score+
            $part_b_f_total_alloc_score); ?>
              <table border ="1">     
                <tr>
                    <th>SL No.</th>
                    <th>Title</th>
                    <th colspan="2">Awarded Score</th>
                    <th>Allotted marks</th>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th>Previous Year</th>
                  <th>Present Year</th>
                  <th></th>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th><?php echo isset($report_of_year1)?$report_of_year1:''; ?></th>
                  <th><?php echo isset($report_of_year2)?$report_of_year2:''; ?></th>
                  <th></th>
                </tr>
                <tr>
                  <th>A.</th>
                  <th align="left">Deposit (<?php echo number_format((($part_b_a_total_alloc_score*100)/$part_b_total_allMark), 2); ?>%)</th>
                  <th></th>
                  <th><?php echo isset($part_b_a_total_obtain_score)?$part_b_a_total_obtain_score:''; ?></th>
                  <th>30</th>
                </tr>
                <tr>
                  <th>B.</th>
                  <th align="left">Loans & Advances  (<?php echo number_format((($part_b_b_total_alloc_score*100)/$part_b_total_allMark), 2); ?>%)</th>
                  <th></th>
                  <th><?php echo isset($part_b_b_total_obtain_score)?$part_b_b_total_obtain_score:''; ?></th>
                  <th>30</th>
                </tr>
                <tr>
                  <th>C.</th>
                  <th align="left">Bills Payable & Other Liabilities   (<?php echo number_format((($part_b_c_total_alloc_score*100)/$part_b_total_allMark),2); ?>%)</th>
                  <th></th>
                  <th><?php echo isset($part_b_c_total_obtain_score)?$part_b_c_total_obtain_score:''; ?></th>
                  <th>30</th>
                </tr>
                <tr>
                  <th>D.</th>
                  <th align="left">Loans & Advances-Foreign Exchange & International Trade  (<?php echo number_format((($part_b_d_total_alloc_score*100)/$part_b_total_allMark),2); ?>%)</th>
                  <th></th>
                  <th><?php echo isset($part_b_d_total_obtain_score)?$part_b_d_total_obtain_score:''; ?></th>
                  <th>30</th>
                </tr>
                <tr>
                  <th>E.</th>
                  <th align="left">Audit/Inspection Objections & Compliances (<?php echo number_format((($part_b_e_total_alloc_score*100)/$part_b_total_allMark),2); ?>%)</th>
                  <th></th>
                  <th><?php echo isset($part_b_e_total_obtain_score)?$part_b_e_total_obtain_score:''; ?></th>
                  <th>30</th>
                </tr>
                <tr>
                  <th>F.</th>
                  <th align="left">Others (<?php echo number_format((($part_b_f_total_alloc_score*100)/$part_b_total_allMark), 2); ?>%)</th>
                  <th></th>
                  <th><?php echo isset($part_b_f_total_obtain_score)?$part_b_f_total_obtain_score:''; ?></th>
                  <th>30</th>
                </tr>
                <tr>
                  <th></th>
                  <th align="left">Total (100%)</th>
                  <th></th>
                  <th><?php 
                    $part_b_total_obtain = ($part_b_a_total_obtain_score+$part_b_b_total_obtain_score+
                    $part_b_c_total_obtain_score+$part_b_d_total_obtain_score+$part_b_e_total_obtain_score+
                    $part_b_f_total_obtain_score);
                    echo $part_b_total_obtain;
                  ?></th>
                  <th><?php echo $part_b_total_allMark; ?></th>
                </tr>
                <tr>
                  <th></th>
                  <th align="left">Total Score with in Allocated Marks</th>
                  <th></th>
                  <th><?php  
                    $part_b_obtain_total = $part_b_total_obtain*70/$part_b_total_allMark;
                    echo number_format($part_b_obtain_total, 2);
                  ?></th>
                  <th>70</th>
                </tr>
                <tr>
                  <th></th>
                  <th align="left">In Percentage</th>
                  <th></th>
                  <th><?php  
                    $part_b_res = $part_b_obtain_total*100/70; 
                    echo number_format($part_b_res, 2);
                  ?></th>
                  <th>100</th>
                </tr>

                <tr>
                  <td></td>
                  <td align="left">Level of Risk for Comparing Branch with whole bank.</td>
                  <td></td>
                  <td colspan="2"><?php  
                    echo level_of_risk_part_ba($part_b_obtain_total*100/70);
                  ?></td>
                </tr>

              </table>
          </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg">
        <div class="result-area">
          <p>Final Result: The composite risk of the branch for the -<?php echo isset($month_array[$report_of_month2])?$month_array[$report_of_month2]:'';?>, <?php echo isset($report_of_year2)?$report_of_year2:''; ?></p>
          <table border="1">
            <tr>
              <th>Sl No.</th>
              <th></th>
              <th>Achieved Marks</th>
              <th>Allotted Marks</th>
            </tr>
            <tr>
              <td>01.</td>
              <td style=" text-align: left">Br. Performance (Year to Year)</td>
              <td><?php echo isset($part_a_total_obtain)?$part_a_total_obtain:''; ?></td>
              <td><?php echo isset($part_a_total_allMark)?$part_a_total_allMark:''; ?></td>
            </tr>
            <tr>
              <td>02.</td>
              <td style=" text-align: left">Br. Performance with Whole Bank</td>
              <td><?php echo isset($part_b_obtain_total)?number_format($part_b_obtain_total,2):''; ?></td>
              <td><?php echo isset($part_b_total_allMark)?$part_b_total_allMark:''; ?></td>
            </tr>
            <tr>
              <td>03.</td>
              <td style=" text-align: left">Total</td>
              <td><?php 
                echo ceil($part_a_total_obtain+$part_b_obtain_total);
              ?></td>
              <td><?php 
              echo ($part_a_total_allMark+$part_b_total_allMark); 
              ?></td>
            </tr>
            <tr>
              <td>04.</td>
              <td style=" text-align: left">Br. Performance</td>
              <td><?php 
                echo number_format($part_a_res, 2);
              ?></td>
              <td>30</td>
            </tr>
            <tr>
              <td>05.</td>
              <td style=" text-align: left">Br. Performance with Whole Bank</td>
              <td><?php 
                echo number_format($part_b_res, 2);
              ?></td>
              <td>70</td>
            </tr>
            <tr>
              <td>06.</td>
              <td style=" text-align: left">Total/Percentage</td>
              <td><?php 
                echo (ceil($part_a_res+$part_b_res));
              ?></td>
              <td>100</td>
            </tr>
            <tr style="background-color: #ddd;">
              <td>07.</td>
              <td style=" text-align: left">Composite Level of Risk</td>
              <td colspan="2" style="font-weight:700"><?php 
                echo level_of_risk_part_ba(ceil($part_a_res+$part_b_res));
              ?></td>
            </tr>
          </table>
        </div>      
    </div>
  </div>
</div>

<?php 
    echo form_open('rba/rba_0001_report_details/1');
    if(isset($previous_value) && !empty($previous_value))
    {
        foreach($previous_value as $key=>$val)
        {
            ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>"/>
            <?php
        }
    }
    ?>
    <br>
  <table align="left">
    <tr>
      <td>
      <?php
        $attribute='style="background-color: #FF9900;"';
        //echo form_submit('actionbtn', 'Save AS PDF',$attribute);
        echo form_close();  
        ?>
        </td>
      </tr>
  </table>
    <?php
//  }
    // else
    // {
    //     echo "<table border=\"1\" align=\"center\">"; 	
    //     echo "<tr>";
    // 	echo "<td align='center' style='background-color:red'>"."<strong>"."No Report Found For-".$report_of_office."<strong>"."</td>";
    //     echo "</tr>";
    // 	echo "</table>";
    // }

?>
