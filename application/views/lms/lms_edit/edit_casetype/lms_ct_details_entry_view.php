<div class="container">
<?php
//echo count($lmseditDatas);
// echo "<pre>";
// print_r($lmscasetypeDatas);
// echo "</pre>";
$attribute = '';
?>
<div class="header-info text-center">
    <h4>Edit Case Type</h4>
</div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicCTdetailsEditForm', 'id'=>'lms_search_ct_details_info_form');
        echo form_open_multipart('lms/lms_caseType_edit_details_save', $attributesForm);
    ?>
    <?php if(isset($lmscasetypeDatas) && !empty($lmscasetypeDatas)) { ?>
    <table>
    <input type="hidden" class="form-control" name="brCTN" value="<?php echo isset($lmscasetypeDatas[0]->br_code)?$lmscasetypeDatas[0]->br_code:''; ?>" />
        <tr>
            <td><div class="form-group ta-r"><label for="tracNoECT">Tracking No.</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="tracNoECTN" value="<?php echo isset($lmscasetypeDatas[0]->tran_no)?$lmscasetypeDatas[0]->tran_no:''; ?>" id="tracNoECT" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="caseNoECT">Case Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoECTN" value="<?php echo isset($lmscasetypeDatas[0]->case_no)?$lmscasetypeDatas[0]->case_no:''; ?>" id="caseNoECT" readonly />
            </div>
            </td>
            
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="loanacNoECT">Loan A/C Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="loanacNoECTN" value="<?php echo isset($lmscasetypeDatas[0]->loan_ac_no)?$lmscasetypeDatas[0]->loan_ac_no:''; ?>" id="loanacNoECT" readonly />
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="filingDateECT">Filing Date</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="date" class="form-control dim" value="<?php echo date('Y-m-d', strtotime(isset($lmspkDatas[0]->filing_date)?$lmspkDatas[0]->filing_date:'')); ?>" id="filingDateECT" readonly/>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="acNameECT">A/C Name</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="acNameECTN" value="<?php echo isset($lmscasetypeDatas[0]->loan_ac_name)?$lmscasetypeDatas[0]->loan_ac_name:''; ?>" id="acNameECT" style="width:100%" readonly/>
            </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r"><label for="DatecasetypeingE">Date</label></div></td>
            <td>
                <div class="form-group ml-5">
                    <input type="date" class="form-control" name="DatecasetypeingEN" value="" id="DatecasetypeingE" />
                    <div class="error" id="DatecasetypeingEID" tabindex="-1"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="caseTypeECT">Case Type</label></div></td>
            <td>
            <div class="form-group ml-5">
                <select name="caseTypeECTN" class="choseSelect caseTypeC" id="caseTypeECT">
                    <?php
                        $cTselect1='';
                        $cTselect2='';
                        if(isset($lmscasetypeDatas[0]->case_type) && $lmscasetypeDatas[0]->case_type == 1)
                        {
                            $cTselect1="selected='selected'";
                        }else if(isset($lmscasetypeDatas[0]->case_type) && $lmscasetypeDatas[0]->case_type == 2){
                            $cTselect2="selected='selected'";
                        }else{
                            $cTselect1='';
                            $cTselect2='';
                        }
                    ?>
                    <option value="0">Select Case Type</option>
                    <option value="1" <?php echo isset($cTselect1)?$cTselect1:'';?>>New</option>
                    <option value="2" <?php echo isset($cTselect2)?$cTselect2:'';?>>Revived</option>
                </select>
                <div class="error" id="caseTypeECTEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarkscasetypeE">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" value="" name="remarkscasetypeEN" id="remarkscasetypeE" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <div class="form-group  ml-5 mt-20">
                <input type="button" class="btn btnSave" value="Save Changes" <?php echo $attribute; ?> onclick="lms_case_type_details_submit(this.value)"/>            
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
        <h4>Previous Information of Case Type</h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Date <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Case Type</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php if(isset($lmscasetypeDatashas) && !empty($lmscasetypeDatashas)){ ?>
            <?php foreach($lmscasetypeDatashas as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->lct_tran_no)?$hasVal->lct_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->lct_case_no)?$hasVal->lct_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lct_date)?$hasVal->lct_date:'')); ?>
                </td>
                <td align="right">
                    <?php 
                        if(isset($hasVal->lct_case_type) && $hasVal->lct_case_type == 1){
                            echo "New";
                        }else{
                            echo "Revived";
                        }
                    ?>
                </td>
                <td><?php echo isset($hasVal->lct_ctRemarks)?$hasVal->lct_ctRemarks:''; ?></td>
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
                    <td align="right">
                        <?php 
                            if(isset($lmsallData[0]->lb_case_type) && $lmsallData[0]->lb_case_type == 1){
                                echo "New";
                            }else{
                                echo "Revived";
                            }
                        ?>
                    </td>
                    <td><?php echo isset($lmsallData[0]->lb_remarks)?$lmsallData[0]->lb_remarks:''; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>