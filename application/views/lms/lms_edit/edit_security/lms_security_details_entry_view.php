<div class="container">
<?php
$attribute = '';
?>
<div class="header-info text-center">
    <h4>Update Security Amount</h4>
</div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsSecEditdetailsForm', 'id'=>'lms_search_security_details_info_form');
        echo form_open_multipart('lms/lms_security_edit_details_save', $attributesForm);
    ?>
    <?php if(isset($lmsEditOusts) && !empty($lmsEditOusts)) { ?>
    <table>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="tracNoO">Tracking No.</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <input type="text" class="form-control dim" name="tracNoOEN" value="<?php echo isset($lmsEditOusts[0]->tran_no)?$lmsEditOusts[0]->tran_no:''; ?>" id="tracNoO" readonly />
                    <input type="hidden" name="ld_data_idE" value="<?php echo isset($lmsEditOusts[0]->lb_data_id)?$lmsEditOusts[0]->lb_data_id:''; ?>" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="caseNoOE">Case Number</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <input type="text" class="form-control dim" name="caseNoOEN" value="<?php echo isset($lmsEditOusts[0]->case_no)?$lmsEditOusts[0]->case_no:''; ?>" id="caseNoOE" readonly />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="loanacNoOE">Loan A/C Number</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <input type="text" class="form-control dim" name="loanacNoOEN" value="<?php echo isset($lmsEditOusts[0]->loan_ac_no)?$lmsEditOusts[0]->loan_ac_no:''; ?>" id="loanacNoOE" readonly />
                </div>
            </td>
            <td>
                <div class="form-group ta-r">
                    <label for="filingDateEO">Filing Date</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <input type="date" class="form-control dim" name="filingDateEON" value="<?php echo date('Y-m-d', strtotime(isset($lmsEditOusts[0]->filing_date)?$lmsEditOusts[0]->filing_date:'')); ?>" id="filingDateEO" readonly />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="acNameOE">A/C Name</label>
                </div>
            </td>    
            <td colspan="3">
                <div class="form-group ml-5">
                    <input type="text" class="form-control dim" name="acNameOEN" value="<?php echo isset($lmsEditOusts[0]->loan_ac_name)?$lmsEditOusts[0]->loan_ac_name:''; ?>" id="acNameOE" style="width:100%" readonly />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="claimAmtE">Suit Value</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <input type="number" class="form-control dim" value="<?php echo isset($lmsEditOusts[0]->claim_amt)?$lmsEditOusts[0]->claim_amt:''; ?>" class="" name="claimAmtEN" id="claimAmtE" />
                    <div class="error" id="claimAmtEEID"></div>
                </div>
            </td>
        </tr>
        
        <tr>
            <td>
                <div class="form-group ta-r"><label for="DateSecE">Date</label></div></td>
            <td>
                <div class="form-group ml-5">
                    <input type="date" class="form-control" name="DateSecEN" value="" id="DateSecE" />
                    <div class="error" id="DateSecEID" tabindex="-1"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="primarySecP">Primary Security value(Present)</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <input type="number" class="form-control" value="" class="" name="primarySecPN" id="primarySecP" />
                    <div class="error" id="primarySecPEID"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="collSecP">Collateral Security value(Present)</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <input type="number" class="form-control" value="" class="" name="collSecPN" id="collSecP" />
                    <div class="error" id="collSecPEID"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarksSecE">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" value="" name="remarksSecEN" id="remarksSecE" style="width:100%" autocomplete="off" />
                <div class="error" id="remarksSecEID"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div class="form-group  ml-5 mt-20">
                    <input type="button" class="btn btnSave" value="Save Changes" <?php echo $attribute; ?> onclick="lms_security_details_save(this.value)"/>            
                    <input type="reset" class="btn btnSave" value="Reset" <?php echo $attribute; ?> />            
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
<?php if(isset($lmsEditOustshasBasic) && !empty($lmsEditOustshasBasic)){ ?>
    <!-- <div class="previous-content-area">
        <h4>Previous Information of Security</h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Date <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Primary Security (Present)</th>
                <th style="text-align:center">Collateral Security (Present)</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php if(isset($lmsEditOustshas) && !empty($lmsEditOustshas)){ ?>
            <?php foreach($lmsEditOustshas as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->le_tran_no)?$hasVal->le_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->le_case_no)?$hasVal->le_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->le_Dateoutstanding)?$hasVal->le_Dateoutstanding:'')); ?>
                </td>
                <td align="right"><?php echo isset($hasVal->le_outstanding)?number_format($hasVal->le_outstanding, 2):''; ?></td>
                <td><?php echo isset($hasVal->le_outRemarks)?$hasVal->le_outRemarks:''; ?></td>
            </tr>
            <?php }?>
            <?php }?>
            <?php if(isset($lmsEditOustshasBasic) && !empty($lmsEditOustshasBasic)){ ?>
                <tr>
                    <td align="right"><?php echo isset($lmsEditOustshasBasic[0]->lb_tran_no)?$lmsEditOustshasBasic[0]->lb_tran_no:''; ?></td>
                    <td><?php echo isset($lmsEditOustshasBasic[0]->lb_case_no)?$lmsEditOustshasBasic[0]->lb_case_no:''; ?></td>
                    <td>
                        <?php echo date('d/m/Y', strtotime(isset($lmsEditOustshasBasic[0]->lb_filing_date)?$lmsEditOustshasBasic[0]->lb_filing_date:'')); ?>
                    </td>
                    <td align="right"><?php echo isset($lmsEditOustshasBasic[0]->lb_outstanding)?number_format($lmsEditOustshasBasic[0]->lb_outstanding, 2):''; ?></td>
                    <td><?php echo isset($lmsEditOustshasBasic[0]->lb_remarks)?$lmsEditOustshasBasic[0]->lb_remarks:''; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div> -->
<?php } ?>