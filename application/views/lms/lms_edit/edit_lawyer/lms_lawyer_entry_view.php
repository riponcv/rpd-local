<div class="container">
<?php
$attribute = '';
?>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicLawerEditForm', 'id'=>'lms_basic_search_lawyer_form_view');
        echo form_open_multipart('lms/lms_lawyer_entry_details_view', $attributesForm);
    ?>
    <div class="header-info text-center">
        <h4>Search for Edit Lawyer Information </h4>
    </div>
        
    <table class="search_tbl">
        
        <tr>
            <td><label for="tracNo">Tracking No.</label></td>
            <td>
            <div class="form-group">
            <select name="tracNLE" class="choseSelect tracNoC" id="tracNo" style="">
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
            <td><div class="form-group"><label for="caseNoS">Case No.</label></div></td>
            <td>
            <div class="form-group">
                <input type="text" class="form-control" name="caseNoSN" id="caseNoS" value="" placeholder="Case Number">
            </div>
            </td>
            <td>
            <div class="form-group">
                <input type="button" class="btn btnSave saveBtn" value="Search" <?php echo $attribute; ?> onclick="lms_lawyer_view_search(this.value)"/>            
            </div>
            </td>                    
        </tr>
    </table>
    <?php if(isset($lmseditDatas) && !empty($lmseditDatas)) { ?>
    <div class="header-info text-center">
        <h5>Or Click the following any one for editing.<h5>
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
        <?php foreach($lmseditDatas as $lmseditData) {?>
            <tr>
                <td><?php 
                    echo anchor('lms/lms_lawyer_entry_details_view/'.$lmseditData->lb_tran_no, $lmseditData->lb_tran_no, 'title="Edit"');
                ?>
                </td>
                <td><?php echo isset($lmseditData->lb_loan_ac_name)?$lmseditData->lb_loan_ac_name:''; ?></td>
                <td><?php echo isset($lmseditData->lb_loan_ac_no)?$lmseditData->lb_loan_ac_no:''; ?></td>
                <td align="right"><?php echo isset($lmseditData->lb_outstanding)?number_format($lmseditData->lb_outstanding, 2):''; ?></td>
                <td align="right"><?php echo isset($lmseditData->lb_suitValue_amt)?number_format($lmseditData->lb_suitValue_amt, 2):''; ?></td>
                <td><?php echo isset($lmseditData->lb_case_no)?$lmseditData->lb_case_no:''; ?></td>
                <td><?php echo isset($lmseditData->lmct_ct_desc_l3)?$lmseditData->lmct_ct_desc_l3:''; ?></td>
                <td><?php echo isset($lmseditData->lmcc_cc_desc_l3)?$lmseditData->lmcc_cc_desc_l3:''; ?></td>
            </tr>
        <?php } ?>
    </table>
    </div>    
    <?php echo form_close(); ?>
    <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php } ?>
</div>
