<div class="container">
<?php

$attribute = '';
?>

    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicEditForm', 'id'=>'lms_basic_search_info_form');
        echo form_open_multipart('lms/lms_basic_single_edit_view', $attributesForm);
    ?>
    <div class="header-info text-center">
    <h4>LAWSUIT EDIT INFORMATION</h4>
    </div>
    <table class="search_tbl">
        <tr>
            <td><label for="tracNo">Trac No.</label></td>
            <td>
            <div class="form-group">
            <select name="tracNoE" class="choseSelect tracNoC" id="tracNo" style="">
                <option value="">Select Tracking No.</option>
                <?php 
                    foreach($lmstracNos as $lmstracNo)
                    {
                         $coselect='';
                ?>
                <option value="<?php echo isset($lmstracNo->lb_tran_no)?$lmstracNo->lb_tran_no:''; ?>" <?php echo isset($coselect)?$coselect:''; ?> ><?php echo isset($lmstracNo->lb_tran_no)?$lmstracNo->lb_tran_no :''; ?></option>
                <?php } ?>   
            </select>
            </div>
            </td>
            
            <td><label for="caseNoS">Case Number</label></td>
            <td>
            <div class="form-group">
                <input type="text" class="form-control" name="caseNoNS" id="caseNoS" value="" placeholder="Case Number">
            </div>
            </td>
            <td>
                <input type="button" class="btn btnSave" value="Search" <?php echo $attribute; ?> style="background-color: #bb33ff; padding: 0px 18px;" onclick="lms_edit_all_info_view_search(this.value)"/>            
            </td>                    
        </tr>
    </table>
    </fieldset>
    <?php echo form_close(); ?>
    <?php if(isset($lmseditDatas) && !empty($lmseditDatas)) { ?>
    <table class="table table-sm table-borderless">
        <thead>
            <tr>
                <th>Action</th>
                <th>Account Name</th>
                <th>A/C No.</th>
                <th>Outstanding</th>
                <th>Suit Value</th>
                <th>Case No.</th>
                <th>Court Type</th>
                <th>Case category</th>
            </tr>
        </thead>
        <?php foreach($lmseditDatas as $lmseditData) {?>
            <tr>
                <td><?php 
                    echo anchor('lms/lms_basic_single_edit_view/'.$lmseditData->lb_tran_no, 'Edit', 'title="Edit"');
                ?>
                </td>
                
                <td><?php echo isset($lmseditData->lb_loan_ac_name)?$lmseditData->lb_loan_ac_name:''; ?></td>
                <td><?php echo isset($lmseditData->lb_loan_ac_no)?$lmseditData->lb_loan_ac_no:''; ?></td>
                <td><?php echo isset($lmseditData->lb_outstanding)?$lmseditData->lb_outstanding:''; ?></td>
                <td><?php echo isset($lmseditData->lb_claim_amt)?$lmseditData->lb_claim_amt:''; ?></td>
                <td><?php echo isset($lmseditData->lb_case_no)?$lmseditData->lb_case_no:''; ?></td>
                <td><?php echo isset($lmseditData->lmct_ct_desc_l3)?$lmseditData->lmct_ct_desc_l3:''; ?></td>
                <td><?php echo isset($lmseditData->lmcc_cc_desc_l3)?$lmseditData->lmcc_cc_desc_l3:''; ?></td>
            </tr>
        <?php } ?>
    </table>
    </div>    
    <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php } ?>
   
    
</div>
