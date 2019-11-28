<div class="container">
<?php

$attribute = '';
?>
<div class="header-info text-center">
    <h4>Edit Lawyer Information</h4>
</div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmslawyerdetailsEditLawForm', 'id'=>'lms_search_lawyer_details_info_form');
        echo form_open_multipart('lms/lms_lawyers_edit_details_save', $attributesForm);
    ?>
    <?php if(isset($lmsEditlaws) && !empty($lmsEditlaws)) { ?>
    <table>
    <input type="hidden" name="ld_data_idE" value="<?php echo isset($lmsEditlaws[0]->lb_data_id)?$lmsEditlaws[0]->lb_data_id:''; ?>" />
        <tr>
            <td><div class="form-group ta-r"><label for="tracNoEL">Tracking No.</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($lmsEditlaws[0]->tran_no)?$lmsEditlaws[0]->tran_no:'';?>" name="tracNoELN" id="tracNoEL" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="caseNoEL">Case Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoELN" value="<?php echo isset($lmsEditlaws[0]->case_no)?$lmsEditlaws[0]->case_no:'';?>" id="caseNoEL" readonly />
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="loanacNoEL">Loan A/C Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($lmsEditlaws[0]->loan_ac_no)?$lmsEditlaws[0]->loan_ac_no:'';?>" name="loanacNoELN" id="loanacNoEL" readonly />
            </div>
            </td>
        </tr>
     
        <tr>
            <td><div class="form-group ta-r"><label for="acNameEL">A/C Name</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($lmsEditlaws[0]->loan_ac_name)?$lmsEditlaws[0]->loan_ac_name:'';?>" name="acNameELN" id="acNameEL" style="width:100%" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r"><label for="DatelawyerE">Date</label></div></td>
            <td>
                <div class="form-group ml-5">
                    <input type="date" class="form-control" name="DatelawyerEN" value="" id="DatelawyerE" />
                    <div class="error" id="DatelawyerEID" tabindex="-1"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarkslawyerE">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" value="" name="remarkslawyerEN" id="remarkslawyerE" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
            <td>
            <div class="form-group ta-r">
                <label for="lawyerInfo">Lawyer Name</label>
            </div>
            </td>
            <td>          
            <div class="form-group ml-5">                 
            <select name="lawyerInfoEN" class="choseSelect" id="lawyerInfo" onchange="get_lawyer_value(this)">
                <option value="0">Select </option>
                <?php 
                    foreach($lms_lawer_infos as $lms_lawer_info)
                    {
                ?>
                <option value="<?php echo isset($lms_lawer_info->lml_lawer_id)?$lms_lawer_info->lml_lawer_id:''; ?>"><?php echo isset($lms_lawer_info->lml_lawer_name)?$lms_lawer_info->lml_lawer_name:''; ?></option>
                <?php } ?>   
            </select>
            </td>
            </div>
        </tr> 

        <tr>
            <td>
            <?php 
                $lawyerIdArr = explode(',', $lmsEditlaws[0]->lawyer_id);
                $dataLaws = $this->lmsmodel->lms_lawer_data($lawyerIdArr);
            ?>
            </td>       
            <td colspan="2">
                <div id="addHere">
                <?php if(!empty($dataLaws) && count($dataLaws)>0){ 
                    foreach($dataLaws as $lawerS){
                    ?>
                    <div class="row lawyerborder">
                        <?php ?>
                        <input type="hidden" name="lawyerInfoN[]" value="<?php echo $lawerS->lml_lawer_id; ?>">        
                        <label><?php echo $lawerS->lml_lawer_id; ?></label><label> <?php echo $lawerS->lml_lawer_name; ?> </label><input type="button" value="remove" onclick="removeRow(this)">
                    </div>
                    <?php } }?>
                </div>
            </td>      
        </tr>  
        <tr>
            <td></td>
            <td>
                <div class="form-group  ml-5 mt-20">
                    <input type="button" class="btn btnSave saveBtn" value="Save Changes" <?php echo $attribute; ?> onclick="lms_lawyer_details_save(this.value)"/>            
                    <input type="reset" class="btn btnSave saveBtn" value="Reset" <?php echo $attribute; ?> />            
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
<?php

//print_r($lmsEditlawhasBasic);
//echo $lmsEditlawhasBasic[0]->lb_lawyer_id;
$lawIdArrBasic = explode(',', $lmsEditlawhasBasic[0]->lb_lawyer_id);
$dataLawerIdBasic = $this->lmsmodel->lms_lawer_data($lawIdArrBasic);
// echo "<pre>";
// print_r($lmsEditlawsAll);
// die();
// foreach($lmsEditlawsAll as $single){
//     echo $single->le_lawyer_id;
// }
?>
<?php if(isset($lmsEditlawhasBasic) && !empty($lmsEditlawhasBasic)){ ?>
    <div class="previous-content-area">
        <h4>Information of Lawyer Information</h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Date <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Lawer Info</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php if(isset($lmsEditlawsAll) && !empty($lmsEditlawsAll)){ ?>
            <?php foreach($lmsEditlawsAll as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->le_tran_no)?$hasVal->le_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->le_case_no)?$hasVal->le_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->le_data_entry_date)?$hasVal->le_data_entry_date:'')); ?>
                </td>
                <td align="right">
                <?php 
                    $lawIdArrEdit = explode(',', $hasVal->le_lawyer_id);
                    $dataLawerEditAll = $this->lmsmodel->lms_lawer_data($lawIdArrEdit);
                ?>
                    <table>
                        <tr>
                            <th>Lawyer ID</th>
                            <th>Lawyer Name</th>
                            <th>Lawyer Position</th>
                        <tr>
                        <?php 
                            foreach($dataLawerEditAll as $lawAll){ ?>
                                <tr>
                                    <td><?php echo isset($lawAll->lml_data_id)?$lawAll->lml_data_id:'';?></td>
                                    <td><?php echo isset($lawAll->lml_lawer_name)?$lawAll->lml_lawer_name:'';?></td>
                                    <td><?php echo isset($lawAll->lml_lawer_advPosition)?$lawAll->lml_lawer_advPosition:'';?></td>
                                </tr>
                          <?php  }
                        ?>
                    </table>
                </td>
                <td><?php echo isset($hasVal->le_lawRemarks)?$hasVal->le_lawRemarks:''; ?></td>
            </tr>
            <?php }?>
            <?php }?>
            <?php if(isset($lmsEditlawhasBasic) && !empty($lmsEditlawhasBasic)){ ?>
                <tr>
                    <td align="right"><?php echo isset($lmsEditlawhasBasic[0]->lb_tran_no)?$lmsEditlawhasBasic[0]->lb_tran_no:''; ?></td>
                    <td><?php echo isset($lmsEditlawhasBasic[0]->lb_case_no)?$lmsEditlawhasBasic[0]->lb_case_no:''; ?></td>
                    <td>
                        <?php echo date('d/m/Y', strtotime(isset($lmsEditlawhasBasic[0]->lb_filing_date)?$lmsEditlawhasBasic[0]->lb_filing_date:'')); ?>
                    </td>
                    <td align="">
                        <table>
                        <tr>
                            <th>Lawyer ID</th>
                            <th>Lawyer Name</th>
                            <th>Lawyer Position</th>
                        <tr>
                        <?php 
                            foreach($dataLawerIdBasic as $lawBasic){ ?>
                                <tr>
                                    <td><?php echo isset($lawBasic->lml_data_id)?$lawBasic->lml_data_id:'';?></td>
                                    <td><?php echo isset($lawBasic->lml_lawer_name)?$lawBasic->lml_lawer_name:'';?></td>
                                    <td><?php echo isset($lawBasic->lml_lawer_advPosition)?$lawBasic->lml_lawer_advPosition:'';?></td>
                                </tr>
                          <?php  }
                        ?>
                        </table>
                    </td>
                    <td><?php echo isset($lmsEditlawhasBasic[0]->lb_remarks)?$lmsEditlawhasBasic[0]->lb_remarks:''; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>