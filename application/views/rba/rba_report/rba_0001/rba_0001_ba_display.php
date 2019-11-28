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
      <th rowspan="2">data Source</th>
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
        <td>1</td>
        <td><?php echo isset($result_array['part_b_a_info']['observation_deposit'])?$result_array['part_b_a_info']['observation_deposit']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['whole_deposit'])?number_format($result_array['part_b_a_info']['whole_deposit'], 2):''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_deposit'])?number_format($result_array['part_b_a_info']['br_deposit'], 2):''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_ttl_deposit_omis'])?$result_array['part_b_a_info']['br_cont_ttl_deposit_omis']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_deposit_obtained_mark'])?$result_array['part_b_a_info']['br_cont_deposit_obtained_mark']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_deposit_allMark'])?$result_array['part_b_a_info']['br_cont_deposit_allMark']:''; ?></td>
        <td>data Source</td>
    </tr>
    <tr>
        <td>2</td>
        <td><?php echo isset($result_array['part_b_a_info']['observation_noac'])?$result_array['part_b_a_info']['observation_noac']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['whole_br_no_ac_OMIS'])?number_format($result_array['part_b_a_info']['whole_br_no_ac_OMIS']):''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_no_ac_OMIS'])?number_format($result_array['part_b_a_info']['br_no_ac_OMIS']):''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_no_ac_deposit_omis'])?$result_array['part_b_a_info']['br_cont_no_ac_deposit_omis']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_noac_deposit_obtained_mark'])?$result_array['part_b_a_info']['br_cont_noac_deposit_obtained_mark']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_no_ac_deposit_allMark'])?$result_array['part_b_a_info']['br_cont_no_ac_deposit_allMark']:''; ?></td>
        <td>data Source</td>
    </tr>
    <tr>
        <td>3</td>
        <td><?php echo isset($result_array['part_b_a_info']['observation_highcost'])?$result_array['part_b_a_info']['observation_highcost']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['whole_high_deposit'])?number_format($result_array['part_b_a_info']['whole_high_deposit'], 2):''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_high_deposit'])?number_format($result_array['part_b_a_info']['br_high_deposit'], 2):''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_ttl_high_deposit_omis'])?$result_array['part_b_a_info']['br_cont_ttl_high_deposit_omis']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_high_deposit_obtained_mark'])?$result_array['part_b_a_info']['br_cont_high_deposit_obtained_mark']:''; ?></td>
        <td><?php echo isset($result_array['part_b_a_info']['br_cont_high_deposit_allMark'])?$result_array['part_b_a_info']['br_cont_high_deposit_allMark']:''; ?></td>
        <td>data Source</td>
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
          <?php 
            $part_b_a_total_alloc_score = ($result_array['part_b_a_info']['br_cont_deposit_allMark']+
            $result_array['part_b_a_info']['br_cont_no_ac_deposit_allMark']+
            $result_array['part_b_a_info']['br_cont_high_deposit_allMark']);
            echo number_format($part_b_a_total_alloc_score);
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