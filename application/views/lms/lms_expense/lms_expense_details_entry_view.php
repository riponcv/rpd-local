<div class="container">
<?php

$attribute = '';
?>
    <div class="header-info text-center">
       <h4>Expense Details </h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicExpdetailsForm', 'id'=>'lms_basic_details_expnse_info_form');
        echo form_open_multipart('lms/lms_expense_details_save', $attributesForm);
    ?>
    
    <?php if(isset($lmsExpDatas) && !empty($lmsExpDatas)) { ?>
    <table>
    <input type="hidden" name="brCodeExpN" value="<?php echo isset($lmsExpDatas[0]->br_code)?$lmsExpDatas[0]->br_code:''; ?>" id="">
        <tr>
            <td><div class="form-group ta-r"><label for="tracNoExp">Tracking No.</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="tracNoExpN" value="<?php echo isset($lmsExpDatas[0]->tran_no)?$lmsExpDatas[0]->tran_no:''; ?>" id="tracNoExp" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><label for="caseNoExp ta-r">Case Number</label></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoExpN" value="<?php echo isset($lmsExpDatas[0]->case_no)?$lmsExpDatas[0]->case_no:''; ?>" id="caseNoExp" readonly />
            </div>
            </td>
            <td><label for="loanacNoExp ta-r">Loan A/C Number</label></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="loanacNoExpN" value="<?php echo isset($lmsExpDatas[0]->loan_ac_no)?$lmsExpDatas[0]->loan_ac_no:''; ?>" id="loanacNoExp" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><label for="acNameExp ta-r">A/C Name</label></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="acNameExpN" value="<?php echo isset($lmsExpDatas[0]->loan_ac_name)?$lmsExpDatas[0]->loan_ac_name:''; ?>" id="acNameExp" style="width:100%" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="expDateExp">Date of Expense</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="date" class="form-control" name="expDateExpN" value="" id="expDateExp" />
                <div class="error" id="expDateExpEID" tabindex="-1"></div>
            </div>
            </td>
            <td><div class="form-group"><span>(mm/dd/yyyy)</span></div></td>
        </tr>
        
        <tr>
            <td><div class="form-group ta-r"><label for="expTypeExp">Expense Type</label></div></td>
            <td>
            <div class="form-group ml-5">
                <select name="expTypeExpN" class="choseSelect" id="expTypeExp" style="">
                <option value="">Select Expense Type</option>
                <?php 
                    foreach($lms_exp_types as $lms_exp_type)
                    {
                         $coselect='';
                ?>
                <option value="<?php echo isset($lms_exp_type->lmet_et_id)?$lms_exp_type->lmet_et_id:''; ?>" <?php echo isset($coselect)?$coselect:''; ?> ><?php echo isset($lms_exp_type->lmet_et_desc)?$lms_exp_type->lmet_et_desc :''; ?></option>
                <?php } ?>   
            </select>
            <div class="error" id="expTypeExpEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="expAmtExp">Expense Amount</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="number" class="form-control" name="expAmtExpN" value="" id="expAmtExp" />
                <div class="error" id="expAmtExpEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarksExp">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" name="remarksExpN" value="" id="remarksExp" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <div class="form-group  ml-5 mt-20">
            <input type="button" class="btn btnSave" value="Save" <?php echo $attribute; ?> onclick="lms_expense_details_view_search(this.value)"/>            
            <input type="reset" class="btn btnSave" value="Reset" <?php echo $attribute; ?>  />            
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
<?php if(isset($lmsExpDatashas) && !empty($lmsExpDatashas)){ ?>
    <div class="previous-content-area">
        <h4>Expense Information </h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Date of Expense <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Expense Amount</th>
                <th style="text-align:center">Expense Amount</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php foreach($lmsExpDatashas as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->lbexp_tran_no)?$hasVal->lbexp_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->lbexp_case_no)?$hasVal->lbexp_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lbexp_exp_date)?$hasVal->lbexp_exp_date:'')); ?>
                </td>
                <td align="right"><?php echo isset($hasVal->lbexp_exp_amt)?number_format($hasVal->lbexp_exp_amt, 2):''; ?></td>
                <td><?php echo isset($hasVal->lmet_et_desc)?$hasVal->lmet_et_desc:''; ?></td>
                <td><?php echo isset($hasVal->lbexp_remarks)?$hasVal->lbexp_remarks:''; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
<?php } ?>