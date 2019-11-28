<div class="container">
<?php

$attribute = '';
?>
    <!-- <div class="header-view-info text-center">
       <h4>Search for Present Position</h4>
    </div> -->
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicppviewForm', 'id'=>'lms_basic_search_pp_info_form');
        echo form_open_multipart('lms/lms_pp_entry_details_view', $attributesForm);
    ?>
    <?php if(isset($lmschkerData) && !empty($lmschkerData)) { ?>
    <div class="header-info text-center">
        <h5>Or Click the following any one Tracking No.<h5>
    </div>
    <table class="table table-bordered" border="1" id="mydata">
        <thead>
            <tr>
                <th>Tracking No.</th>
                <th>Account Name</th>
                <th>A/C No.</th>
                <th>Outstanding</th>
                <th>Claim Amount</th>
                <th>Case No.</th>
                <th>Court Type</th>
                <th>Case category</th>
                
                
            </tr>
        </thead>
        <?php foreach($lmschkerData as $lmschker) {?>
            <tr>
                <td><?php 
                    echo anchor('lms/lms_basic_entry_checker_view_details/'.$lmschker->lb_tran_no, $lmschker->lb_tran_no, 'title="Edit"');
                ?>
                </td>
                <td><?php echo isset($lmschker->lb_loan_ac_name)?$lmschker->lb_loan_ac_name:''; ?></td>
                <td><?php echo isset($lmschker->lb_loan_ac_no)?$lmschker->lb_loan_ac_no:''; ?></td>
                <td align="right"><?php echo isset($lmschker->lb_outstanding)?number_format($lmschker->lb_outstanding, 2):''; ?></td>
                <td align="right"><?php echo isset($lmschker->lb_suitValue_amt)?number_format($lmschker->lb_suitValue_amt, 2):''; ?></td>
                <td><?php echo isset($lmschker->lb_case_no)?$lmschker->lb_case_no:''; ?></td>
                <td><?php //echo isset($lmschker->lmct_ct_desc_l3)?$lmschker->lmct_ct_desc_l3:''; ?></td>
                <td><?php //echo isset($lmschker->lmcc_cc_desc_l3)?$lmschker->lmcc_cc_desc_l3:''; ?></td>
               
            </tr>
        <?php } ?>
    </table>
    </div>    
    <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php } ?>
    <?php echo form_close(); ?>    
</div>
