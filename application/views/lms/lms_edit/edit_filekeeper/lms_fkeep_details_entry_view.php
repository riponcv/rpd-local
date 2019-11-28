<div class="container">
<?php
//echo count($lmseditDatas);
// echo "<pre>";
// print_r($lmspkDatas);
// echo "</pre>";
$attribute = '';
?>
<div class="header-info text-center">
    <h4>Update File Keeper</h4>
</div>

    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicEditpkdetailsForm', 'id'=>'lms_search_fk_details_info_form');
        echo form_open_multipart('lms/lms_pk_edit_details_save', $attributesForm);
    ?>
    <?php if(isset($lmspkDatas) && !empty($lmspkDatas)) { ?>
    <table class="">
    <input type="hidden" class="form-control" name="brCTN" value="<?php echo isset($lmspkDatas[0]->br_code)?$lmspkDatas[0]->br_code:''; ?>" />
        <tr>
            <td><div class="form-group ta-r"><label for="tracNoEPK">Tracking No.</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="tracNoEPKN" value="<?php echo isset($lmspkDatas[0]->tran_no)?$lmspkDatas[0]->tran_no:''; ?>" id="tracNoEPK" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="caseNoPK">Case Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoPKN" value="<?php echo isset($lmspkDatas[0]->case_no)?$lmspkDatas[0]->case_no:''; ?>" id="caseNoPK" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="loanacNoPK">Loan A/C Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="loanacNoPKN" value="<?php echo isset($lmspkDatas[0]->loan_ac_no)?$lmspkDatas[0]->loan_ac_no:''; ?>" id="loanacNoPK" readonly />
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="filingDateEPK">Filing Date</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="date" class="form-control dim" value="<?php echo date('Y-m-d', strtotime(isset($lmspkDatas[0]->filing_date)?$lmspkDatas[0]->filing_date:'')); ?>" id="filingDateEPK" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="acNamePK">A/C Name</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="acNamePKN" value="<?php echo isset($lmspkDatas[0]->loan_ac_name)?$lmspkDatas[0]->loan_ac_name:''; ?>" id="acNamePK" style="width:100%" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r"><label for="DatefkE">Date</label></div></td>
            <td>
                <div class="form-group ml-5">
                    <input type="date" class="form-control" name="DatefkEN" value="" id="DatefkE" />
                    <div class="error" id="DatefkEID" tabindex="-1"></div>
                </div>
            </td>
        </tr>
        <tr>
        <td>
        <div class="form-group ta-r">
            <label for="fileMaintOffBIDE"><span  class="fontSize12" style="font-weight:700">File Maintenance Officer Bank ID</span></label>
        </div>
        </td>
        <td>
            <div class="form-group ml-5">
            <input type="text" class="form-control" name="fileMaintOffBIDEN" id="fileMaintOffBIDE" placeholder="Officer Bank ID">
            <div class="error" id="fileMaintOffBIDEEID" tabindex="-1"></div>
            </div>
        </td>
        </div>
        <td>
        <div class="form-group ta-r">
            <label for="fileMaintOffNameE"><span class="fontSize12" style="font-weight:700">File Maintenance Officer Name</span></label>
        </div>   
        </td>
        <td>
        <div class="form-group ml-5">
            <input type="text" class="form-control" name="fileMaintOffNameEN" id="fileMaintOffNameE" placeholder="Officer Name">
        </div>
        </td>
        </div>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarkfkE">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" value="" name="remarkfkEN" id="remarkfkE" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <div class="form-group  ml-5 mt-20">
                <input type="button" class="btn btnSave" value="Save Changes" <?php echo $attribute; ?> onclick="lms_file_keeper_details_submit(this.value)"/>            
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
<?php if(isset($lmsallData) && !empty($lmsallData)){ ?>
    <div class="previous-content-area">
        <h4>Information of File keeper</h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Date <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Bank Id</th>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php if(isset($lmspkDatashas) && !empty($lmspkDatashas)){ ?>
            <?php foreach($lmspkDatashas as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->lfk_tran_no)?$hasVal->lfk_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->lfk_case_no)?$hasVal->lfk_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lfk_fk_date)?$hasVal->lfk_fk_date:'')); ?>
                </td>
                <td><?php echo isset($hasVal->lfk_fk_bid)?$hasVal->lfk_fk_bid:''; ?></td>
                </td>
                <td><?php echo isset($hasVal->lfk_fk_name)?$hasVal->lfk_fk_name:''; ?></td>
                <td><?php echo isset($hasVal->lfk_lawRemarks)?$hasVal->lfk_lawRemarks:''; ?></td>
            </tr>
            <?php }?>
            <?php }?>
            <?php if(isset($lmsallData) && !empty($lmsallData)){ ?>
                <tr>
                    <td align="right"><?php echo isset($lmsallData[0]->lb_tran_no)?$lmsallData[0]->lb_tran_no:''; ?></td>
                    <td><?php echo isset($lmsallData[0]->lb_case_no)?$lmsallData[0]->lb_case_no:''; ?></td>
                    <td>
                        <?php echo date('d/m/Y', strtotime(isset($lmsallData[0]->lb_filing_date)?$lmsallData[0]->lb_filing_date:'')); ?>
                    </td>
                    </td>
                    <td><?php echo isset($lmsallData[0]->lb_file_officer_bid)?$lmsallData[0]->lb_file_officer_bid:''; ?></td>
                    <td><?php echo isset($lmsallData[0]->lb_file_officer_name)?$lmsallData[0]->lb_file_officer_name:''; ?></td>
                    <td><?php echo isset($lmsallData[0]->lb_remarks)?$lmsallData[0]->lb_remarks:''; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>