<div class="container">
<?php

$attribute = '';
$totaRec= 0;
if(isset($lmsRecDatashas) && !empty($lmsRecDatashas)){
    foreach($lmsRecDatashas as $hasVal) {
        $totaRec = $totaRec+$hasVal->lbrec_reco_amt; 
    }
}
?>
<div class="header-info text-center">
    <h4>Recovery Details </h4>
</div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicRecdetailsForm', 'id'=>'lms_basic_recDetails_info_form');
        echo form_open_multipart('lms/lms_recovery_details_save', $attributesForm);
    ?>
   
    <?php if(isset($lmsRecDatas) && !empty($lmsRecDatas)) { ?>
    <table>
    <input type="hidden" name="brCodeRecN" value="<?php echo isset($lmsRecDatas[0]->br_code)?$lmsRecDatas[0]->br_code:''; ?>" id="">
        <tr>
            <td>
                <div class="form-group ta-r"><label for="tracNo">Tracking No. </label></div>
            </td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="tracNoRN" value="<?php echo isset($lmsRecDatas[0]->tran_no)?$lmsRecDatas[0]->tran_no:''; ?>" id="tracNo" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td>
            <div class="form-group ta-r"><label for="caseNoR">Case Number</label></div>
            </td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoRN" value="<?php echo isset($lmsRecDatas[0]->case_no)?$lmsRecDatas[0]->case_no:''; ?>" id="caseNoR" readonly />
            </div>
            </td>
            <td>
            <div class="form-group ta-r"><label for="loanacNopp">Loan A/C Number</label></div>
            </td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($lmsRecDatas[0]->loan_ac_no)?$lmsRecDatas[0]->loan_ac_no:''; ?>" id="loanacNopp" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="acNamePP">A/C Name</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($lmsRecDatas[0]->loan_ac_name)?$lmsRecDatas[0]->loan_ac_name:''; ?>" id="acNamePP" style="width:100%" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="totalRecAmtR">Recovery Amount</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($totaRec)?number_format($totaRec, 2):''; ?>" id="totalRecAmtR" readonly />
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="outstandingR">Outstanding</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($lmsRecDatas[0]->outstanding)?$lmsRecDatas[0]->outstanding:''; ?>" id="outstandingR" readonly/>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="recDateR">Recovery Date</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="date" class="form-control" name="recDateRN" value="" id="recDateR" />
                <div class="error" id="recDateREID" tabindex="-1"></div>
            </div>
            </td>
            <td><div class="form-group"><span>(mm/dd/yyyy)</span></div></td>
        </tr>
        
        <tr>
            <td><div class="form-group ta-r"><label for="modOfRecID">Mode of Recovery</label></div></td>
            <td>
                <div class="form-group ml-5">
                    <select name="modOfRecN" class="form-control modOfRec" id="modOfRecID">
                        <option value="0">Select mode of Recovery</option>
                        <?php foreach($lmscomponentsDatas as $Data){ ?>
                        <option value="<?php echo $Data->lc_recModeId_id; ?>"><?php echo $Data->lc_recModeDesc; ?></option>
                        <?php } ?>
                    </select>
                    <div class="error" id="modOfRecEID" tabindex="-1"></div>
                </div>
            </td>
            <td><div class="form-group ta-r"><label for="recAmtR">Recovery Amount</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="number" class="form-control" name="recAmtRN" value="" id="recAmtR" required>
                <div class="error" id="recAmtREID" tabindex="-1"></div>           
            </div>
            </td>
        </tr>
        
        <tr>
            <td><div class="form-group ta-r"><label for="remarksR">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" value="" name="remarksRN" id="remarksR" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <div class="form-group ml-5 mt-20">
            <input type="button" class="btn btnSave" value="Save" <?php echo $attribute; ?> onclick="lms_recovery_details_view_search(this.value)"/>            
        
            <input type="reset" class="btn btnSave" value="Reset" <?php echo $attribute; ?>/>            
            </div>
        </td>             
        </tr>
    </table>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php } ?>
    <?php echo form_close(); ?> 
</div>
<?php if(isset($lmsRecDatashas) && !empty($lmsRecDatashas)){ ?>
    <div class="previous-content-area">
        <h4>Previous Information of Recovery</h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Recovery Date <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Recovery Amount</th>
                <th style="text-align:center">Mode of Recovery</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php foreach($lmsRecDatashas as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->lbrec_tran_no)?$hasVal->lbrec_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->lbrec_case_no)?$hasVal->lbrec_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lbrec_rec_date)?$hasVal->lbrec_rec_date:'')); ?>
                </td>
                <td align="right"><?php echo isset($hasVal->lbrec_reco_amt)?number_format($hasVal->lbrec_reco_amt, 2):''; ?></td>
                <td><?php echo isset($hasVal->lc_recModeDesc)?$hasVal->lc_recModeDesc:''; ?></td>
                <td><?php echo isset($hasVal->lbrec_remarks)?$hasVal->lbrec_remarks:''; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
<?php } ?>