<script>
    window.onload = function() {
        let elm = document.getElementsByClassName('sickunCon')[0];
        let elm1 = document.getElementsByClassName('sickunCon')[1];
        let elm2 = document.getElementsByClassName('sickunCon')[2];
        elm.style.display= "none";
        elm1.style.display= "none";
        elm2.style.display= "none";
    }
    function inSick_type_select(insick_type = ''){
    let elm = document.getElementsByClassName('sickunCon')[0];
    let elm1 = document.getElementsByClassName('sickunCon')[1];
    let elm2 = document.getElementsByClassName('sickunCon')[2];
        if(insick_type == "1"){
            elm.style.display= "block";
            elm1.style.display= "block";
            elm2.style.display= "block";
        }else{
            elm.style.display= "none";
            elm1.style.display= "none";
            elm2.style.display= "none";
        }
    }
    

</script>
<style>
.form-group.widthfiftypx {
    width: 25px;
}
</style>
<div class="container">
<?php
$attribute = '';
?>
    <div class="header-info text-center">
       <h4>Written-Off details </h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicwrtOffdetailsForm', 'id'=>'lms_details_written_off_form');
        echo form_open_multipart('lms/lms_writeOff_details_save', $attributesForm);
    ?>
    <?php if(isset($lmswrittoffDatas) && !empty($lmswrittoffDatas)) { ?>
    <table>
    <input type="hidden" name="brCodewrtoffN" value="<?php echo isset($lmswrittoffDatas[0]->br_code)?$lmswrittoffDatas[0]->br_code:''; ?>" id="">
        <tr>
            <td><div class="form-group ta-r"><label for="tracNoWrOff">Trac No.</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="tracNoWrOffN" value="<?php echo isset($lmswrittoffDatas[0]->tran_no)?$lmswrittoffDatas[0]->tran_no:''; ?>" id="tracNoWrOff" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="caseNoWrOff">Case Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoWrOffN" value="<?php echo isset($lmswrittoffDatas[0]->case_no)?$lmswrittoffDatas[0]->case_no:''; ?>" id="caseNoWrOff" readonly/>
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="loanacNoWrOff">Loan A/C Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="loanacNoWrOffN" value="<?php echo isset($lmswrittoffDatas[0]->loan_ac_no)?$lmswrittoffDatas[0]->loan_ac_no:''; ?>" id="loanacNoWrOff" readonly/>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="acNameWrOff">A/C Name</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" value="<?php echo isset($lmswrittoffDatas[0]->loan_ac_name)?$lmswrittoffDatas[0]->loan_ac_name:''; ?>" id="acNameWrOff" style="width:100%" readonly/>
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="outstandingWrOff">Outstanding</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="outstandingWrOffN" value="<?php echo isset($lmswrittoffDatas[0]->outstanding)?$lmswrittoffDatas[0]->outstanding:''; ?>" id="outstandingWrOff" readonly/>
            </div>
            </td>
            <td>
                <div class="form-group widthfiftypx">
                <a href="#" data-toggle="tooltip" data-placement="right" title="Outstanding"><i class="fa fa-question-circle"></i></a>
                </div>
            </td>
        </tr>
        <tr>
        <td><div class="form-group ta-r"><label for="RecAmtWrOff">Recovery Amount</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="RecAmtWrOffN" value="<?php echo isset($lmswrittoffDatas[0]->total_rec)?$lmswrittoffDatas[0]->total_rec:''; ?>" id="RecAmtWrOff" />
            </div>
            </td>
            <td>
                <div class="form-group widthfiftypx">
                <a href="#" data-toggle="tooltip" data-placement="right" title="Recovery Amount"><i class="fa fa-question-circle"></i></a>
                </div>
            </td>
 
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r"><label for="DateWrOff">Written-Off Date</label></div></td>
            <td>
                <div class="form-group ml-5">
                    <input type="date" class="form-control" name="DateWrOffN" value="" id="DateWrOff" />
                    <div class="error" id="DateWrOffEID" tabindex="-1"></div>
                </div>
            </td>
            <td>
                <div class="form-group widthfiftypx">
                <a href="#" data-toggle="tooltip" data-placement="right" title="Written-off Date"><i class="fa fa-question-circle"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="WrOffAmt">Written-Off Amount</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control" value="" name="WrOffAmtN" id="WrOffAmt" />
                <div class="error" id="WrOffAmtEID" tabindex="-1"></div>
            </div>
            </td>
            <td>
                <div class="form-group widthfiftypx">
                <a href="#" data-toggle="tooltip" data-placement="right" title="Written-Off Amount"><i class="fa fa-question-circle"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class='form-group ta-r'>
                    <label for="isSick">Is Sick</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">
                    <select name="isSickN" id="isSick" class="form-control modOfRec" onclick="inSick_type_select(this.value)">
                        <option value="0">Select</option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group widthfiftypx">
                <a href="#" data-toggle="tooltip" data-placement="right" title="Is sick Industry"><i class="fa fa-question-circle"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r sickunCon"><label for="WrOffSickDesc">Condition for Sick</label></div></td>
            <td>
            <div class="form-group ml-5 sickunCon">
                <input type="text" class="form-control" value="" name="WrOffSickDescN" id="WrOffSickDesc" />
                <div class="error" id="WrOffSickDescEID" tabindex="-1"></div>
            </div>
            </td>
            <td>
                <div class="form-group widthfiftypx sickunCon">
                <a href="#" data-toggle="tooltip" data-placement="right" title="Cause for Sick"><i class="fa fa-question-circle"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarksWrOff">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" value="" name="remarksWrOffN" id="remarksWrOff" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <div class="form-group  ml-5 mt-20">
                <input type="button" class="btn btnSave" value="Save" <?php echo $attribute; ?> onclick="lms_written_off_details_submit(this.value)"/>            
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
<?php if(isset($lmswrittoffDatashas) && !empty($lmswrittoffDatashas)){ ?>
    <div class="previous-content-area">
        <h4>Previous Information of Written-Off</h4>
        <table border="1">
            <tr>
                <th style="text-align:center">Tracking No.</th>
                <th style="text-align:center">Case No</th>
                <th style="text-align:center">Written-Off Date <br><span style="font-size:12px">(dd/mm/yyyy)</span></th>
                <th style="text-align:center">Written-Off Amount</th>
                <th style="text-align:center">Remarks</th>
            </tr>
            <?php foreach($lmswrittoffDatashas as $hasVal) {?>
            <tr>
                <td align="right"><?php echo isset($hasVal->lbwro_tran_no)?$hasVal->lbwro_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->lbwro_case_no)?$hasVal->lbwro_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lbwro_wro_date)?$hasVal->lbwro_wro_date:'')); ?>
                </td>
                <td align="right"><?php echo isset($hasVal->lbwro_wro_amt)?number_format($hasVal->lbwro_wro_amt, 2):''; ?></td>
                <td><?php echo isset($hasVal->lbwro_remarks)?$hasVal->lbwro_remarks:''; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
<?php } ?>