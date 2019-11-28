
<div class="container">
<?php

$attribute = '';
?>
    <div class="header-view-info text-center">
       <h4>Search for Single Case Wise Report</h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicSingleInfo', 'id'=>'lms_basic_single_info');
        echo form_open_multipart('lms/lms_0003_report_details', $attributesForm);
    ?>
    
    <table class="search_tbl">    
        <tr>
            <td><div class="form-group"><label for="tracNo">Tracking No.</label></div></td>
            <td>
            <div class="form-group">
            <select name="tracNoE" class="choseSelect tracNoC" id="tracNo" style="width:150px">
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
                <input type="text" class="form-control" name="caseNoppN" id="caseNopp" value="" placeholder="Case Number">
            </div>
            </td>
            <td>
            <div class="form-group">
                <input type="button" class="btn btnSave" value="Search" <?php echo $attribute; ?> onclick="lms_single_info_view_search(this.value)"/>            
            </div>
            </td>                    
        </tr>
    </table>
    
    <?php if(isset($lmseditDatas) && !empty($lmseditDatas)) { ?>
        <?php if($report_option_selector == 5) { $br_code = $lmseditDatas[0]->lb_br_code; ?>
    <input type="hidden" name="report_of_office_id" value="<?php echo isset($lmseditDatas[0]->lb_br_code)?$lmseditDatas[0]->lb_br_code:'';?>">
    <?php }else{ $br_code = $report_of_office_id; ?>
        <input type="hidden" name="report_of_office_id" value="<?php echo isset($report_of_office_id)?$report_of_office_id:'';?>">
    <?php }?>
    <input type="hidden" name="report_option_selector" value="<?php echo isset($report_option_selector)?$report_option_selector:'';?>">
<?php
$this->session->set_userdata('re_off_id', $br_code);
$this->session->set_userdata('re_selector', $report_option_selector);
?>
    <div class="header-info text-center ">
        <h5>Or Click the following any one Tracking No.<h5>
        <?php //print_r($lmseditData); 
        echo $lms_office_status;
        ?>
    </div>
    <table class="table table-bordered"  border="1" id="mydata">
        <thead>
            <tr>
                <th>Tracking No.</th>
                <?php if(isset($lms_office_status) && $lms_office_status != 4){ ?>
                <th>Branch Name</th>
                <?php } ?>
                <th>Account Name</th>
                <th>A/C No.</th>
                <th>Outstanding</th>
                <th>Suit Value</th>
                <th>Case No.</th>
                <th>Court Type</th>
                <th>Case category</th>
                <th>Disposal Information</th>
            </tr>
        </thead>
        <?php foreach($lmseditDatas as $lmseditData) {?>
            <tr>
                <td><?php 
                    echo anchor('lms/lms_0003_report_details/'.$lmseditData->lb_tran_no, $lmseditData->lb_tran_no, 'title="Edit"');
                ?>
                </td>
                <?php if(isset($lms_office_status) && $lms_office_status != 4){ ?>
                <td><?php echo isset($lmseditData->branchname)?$lmseditData->branchname:''; ?></td>
                <?php } ?>
                <td><?php echo isset($lmseditData->lb_loan_ac_name)?$lmseditData->lb_loan_ac_name:''; ?></td>
                <td><?php echo isset($lmseditData->lb_loan_ac_no)?$lmseditData->lb_loan_ac_no:''; ?></td>
                <td><?php echo isset($lmseditData->lb_outstanding)?number_format($lmseditData->lb_outstanding, 2):''; ?></td>
                <td><?php echo isset($lmseditData->lb_suitValue_amt)?number_format($lmseditData->lb_suitValue_amt, 2):''; ?></td>
                <td><?php echo isset($lmseditData->lb_case_no)?$lmseditData->lb_case_no:''; ?></td>
                <td><?php echo isset($lmseditData->lmct_ct_desc_l3)?$lmseditData->lmct_ct_desc_l3:''; ?></td>
                <td><?php echo isset($lmseditData->lmcc_cc_desc_l3)?$lmseditData->lmcc_cc_desc_l3:''; ?></td>
                <td>
                    <?php if(isset($lmsdisDatas) && !empty($lmsdisDatas)) { 
                        foreach($lmsdisDatas as $lmsdisDatasS)
                        if($lmsdisDatasS->lbdis_tran_no == $lmseditData->lb_tran_no){
                            echo isset($lmsdisDatasS->lbdis_cond_of_dis)?$lmsdisDatasS->lbdis_cond_of_dis:''; 
                        ?>
                    <?php } }?>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>    
    <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php } ?>
    <?php echo form_close(); ?>    
</div>
