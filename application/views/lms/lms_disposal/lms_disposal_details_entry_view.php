<div class="container">
<?php
// echo "<pre>";
// print_r($lmsdisposalDatashas);
$attribute = '';
?>
    <div class="header-info text-center">
       <h4>Disposal details </h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicDisposaldetailsForm', 'id'=>'lms_details_disposal_info_form');
        echo form_open_multipart('lms/lms_disposal_details_save', $attributesForm);
    ?>
    <?php if(isset($lmsdisposalDatas) && !empty($lmsdisposalDatas)) { ?>
    <table class="">
    <input type="hidden" name="brCodedisposalN" value="<?php echo isset($lmsdisposalDatas[0]->br_code)?$lmsdisposalDatas[0]->br_code:''; ?>" id="">
        <tr>
            <td>
                <div class="form-group ta-r">    
                    <label for="tracNoDisposal">Tracking No.</label></td>
                </div>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="tracNoDisposalN" value="<?php echo isset($lmsdisposalDatas[0]->tran_no)?$lmsdisposalDatas[0]->tran_no:''; ?>" id="tracNoDisposal" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">    
                    <label for="caseNoDisposal">Case Number</label>
                </div>    
            </td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoDisposalN" value="<?php echo isset($lmsdisposalDatas[0]->case_no)?$lmsdisposalDatas[0]->case_no:''; ?>" id="caseNoDisposal" readonly />
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="loanacNoDisposal">Loan A/C Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="loanacNoDisposalN" value="<?php echo isset($lmsdisposalDatas[0]->loan_ac_no)?$lmsdisposalDatas[0]->loan_ac_no:''; ?>" id="loanacNoDisposal" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="acNameDisposal">Loan A/C Name</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="acNameDisposalN" value="<?php echo isset($lmsdisposalDatas[0]->loan_ac_name)?$lmsdisposalDatas[0]->loan_ac_name:''; ?>" id="acNameDisposal" style="width:100%" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="disDateDisposal">Disposal Date</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="date" class="form-control" name="disDateDisposalN" value="" id="disDateDisposal" />
                <div class="error" id="disDateDisposalEID" tabindex="-1"></div>
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="disAmtDisposal">Disposal Amount</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="number" class="form-control" name="disAmtDisposalN" value="" id="disAmtDisposal" />
                <div class="error" id="disAmtDisposalEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        
        <tr>
            <td><div class="form-group ta-r"><label for="disStatusDisposal">Disposal Status</label></div></td>
            <td>
            <div class="form-group ml-5">
                <select name="disStatusDisposalN" class="choseSelect" id="disStatusDisposal" >
                <option value="">Select Disposal Status</option>
                <option value="1">Court</option>
                <option value="2">Outside Court</option>
            </select>
            <div class="error" id="disStatusDisposalEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="disnatureDisposal">Disposal Nature</label></div></td>
            <td>
            <div class="form-group ml-5">
                <select name="disnatureDisposalN" class="choseSelect" id="disnatureDisposal">
                    <option value="">Select Disposal Nature</option>
                    <?php 
                        foreach($lms_dis_natures as $lms_dis_nature)
                        {
                            $coselect='';
                    ?>
                    <option value="<?php echo isset($lms_dis_nature->lmdn_dn_id)?$lms_dis_nature->lmdn_dn_id:''; ?>" <?php echo isset($coselect)?$coselect:''; ?> ><?php echo isset($lms_dis_nature->lmdn_dn_desc)?$lms_dis_nature->lmdn_dn_desc :''; ?></option>
                    <?php } ?>   
                </select>
                <div class="error" id="disnatureDisposalEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="inFavorOfDisposal">In Favour Of</label></div></td>
            <td>
            <div class="form-group ml-5">
                <select name="inFavorOfDisposalN" class="choseSelect" id="inFavorOfDisposal">
                    <option value="">Select </option>
                    <option value="1">Bank</option>
                    <option value="2">Party</option>
                </select>
                <div class="error" id="inFavorOfDisposalEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        <!-- <tr>
            <td><label for="judgeName">Judge Name</label></td>
            <td>
            <div class="form-group">
            <input type="text" class="form-control" value="" class="" id="judgeName" placeholder="Judge Name" />
            </div>
            </td>
        </tr> -->
        <tr>
            <td><div class="form-group ta-r"><label for="conDisDisposal">Condition of Disposal</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" name="conDisDisposalN" value="" id="conDisDisposal" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarksDisposal">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" name="remarksDisposalN" value="" id="remarksDisposal" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <div class="form-group  ml-5 mt-20">
                <input type="button" class="btn btnSave" value="Save" <?php echo $attribute; ?> onclick="lms_disposal_details_submit(this.value)"/>            
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
<?php if(isset($lmsdisposalDatashas) && !empty($lmsdisposalDatashas)){ ?>
    <div class="previous-content-area">
        <h4>Previous Information of Disposal</h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Disposal Date <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Disposal Amount</th>
                <th style="text-align:center">Disposal Status</th>
                <th style="text-align:center">Disposal Nature</th>
                <th style="text-align:center">In Fabour</th>
                <th style="text-align:center">Disposal Condition</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php foreach($lmsdisposalDatashas as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->lbdis_tran_no)?$hasVal->lbdis_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->lbdis_case_no)?$hasVal->lbdis_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lbdis_date)?$hasVal->lbdis_date:'')); ?>
                </td>
                <td align="right"><?php echo isset($hasVal->lbdis_dis_amt)?number_format($hasVal->lbdis_dis_amt, 2):''; ?></td>
                <td>
                    <?php //echo isset($hasVal->lbdis_dis_status)?$hasVal->lbdis_dis_status:''; 
                        if(isset($hasVal->lbdis_dis_status) && $hasVal->lbdis_dis_status == 1){
                            echo "Court";
                        }else{
                            echo "Outside Court";
                        }
                    ?>
                </td>
                <td><?php echo isset($hasVal->lmdn_dn_desc)?$hasVal->lmdn_dn_desc:''; ?></td>

                <td>
                    <?php //echo isset($hasVal->lbdis_dis_in_favorof)?$hasVal->lbdis_dis_in_favorof:''; 
                        if(isset($hasVal->lbdis_dis_in_favorof) && $hasVal->lbdis_dis_in_favorof ==1 ){
                            echo "Bank";
                        }else{
                            echo "Party";
                        }
                    ?>
                </td>
                <td><?php echo isset($hasVal->lbdis_cond_of_dis)?$hasVal->lbdis_cond_of_dis:''; ?></td>
                <td><?php echo isset($hasVal->lbdis_remarks)?$hasVal->lbdis_remarks:''; ?></td>
                
            </tr>
            <?php }?>
        </table>
    </div>
<?php } ?>