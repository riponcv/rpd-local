<?php

if($this->session->flashdata('succlmsbasicInfo'))
{
    echo "<div id='flashdata'>";
    echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.'Thanks for Submitted LMS Data and Transaction No. is: '.$this->session->flashdata('succlmsbasicInfo').'</font>'; 
    echo "</div>";
}
$attribute = '';
if((isset($login_status) && $login_status !=4)){
    if(isset($off_id) && $off_id != '9024'){
        $attribute ='disabled="disabled"';
    }
}
if((isset($login_status) && $login_status ==4 )||(isset($off_id) && $off_id =='9024')){
    
?>

    <div class="header-info text-center">
        <h4>LAWSUIT BASIC INFORMATION PREVIEW FOR CHECKER</h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicCheckerPrv', 'id'=>'lms_basic_entry_prv_chker_form');
        echo form_open('lms/lms_basic_entry_preview_checker_action', $attributesForm);
    ?>
        <div class="row">
            <table class="table table-borderless" id="search_form_table_n">
                <tbody>
                <tr>
                    <td><div class="form-group"></div></td>
                    <td>
                        <input type="hidden" name="tranNoN" class="form-control" id="tranNo" value="<?php echo isset($trackingNo)?$trackingNo:''; ?>" readonly placeholder="Tracking Number">
                    </td>
                    </div>
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="courtType">Court Type</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php 
                                $court_type = strval($court_type);
                                $cV_1 = '';
                                $cV_2 = '';
                                $cV_3 = '';
                                
                                $cDist = '';
                                $cUpa = '';
                                if($court_type[0] === strval(1) || $court_type[0] === strval(2) || $court_type[0] === strval(4) || $court_type[0] === strval(5)){
                                    foreach ($lmscourts as $court) {
                                        if($court_type[0] == $court->lmct_ct_id_l1){
                                            $cV_1 = $court->lmct_ct_desc_l1;
                                                if($court_type == $court->lmct_ct_id_l2){
                                                    $cV_2 = $court->lmct_ct_desc_l2;
                                                }   
                                        }
                                    }
                                    if($court_type[0] === strval(5)){
                                            if($court_type == '51'){
                                                foreach($lms_thana as $lms_th){ 
                                                    if((int)$lms_th->dtcode == intval(substr($locationOfCourtN, 3, 2))){
                                                        $cDist = $lms_th->dtname;;
                                                    }
                                                }
                                                
                                            }
                                            if($court_type == '52'){
                                                foreach($lms_thana as $lms_th){ 
                                                    if((int)$lms_th->dtcode == intval(substr($locationOfCourtN, 3, 2))){
                                                        $cDist = $lms_th->dtname;;
                                                    }
                                                    if((int)$lms_th->thcode == intval(substr($locationOfCourtN, 6, 3))){
                                                        $cUpa = $lms_th->thname;;
                                                    }
                                                }
                                            }
                                    }
                                }
                                if($court_type[0] === strval(3)){
                                    foreach ($lmscourts as $court) {
                                        if($court_type[0] == $court->lmct_ct_id_l1){
                                            $cV_1 = $court->lmct_ct_desc_l1;
                                            if(substr($court_type, 0, 2) == $court->lmct_ct_id_l2){
                                                $cV_2 = $court->lmct_ct_desc_l2;
                                                if($court_type == $court->lmct_ct_id_l3){
                                                    $cV_3 = $court->lmct_ct_desc_l3;
                                                }
                                            }
                                        }
                                    }
                                }
                            ?>
                            <?php echo isset($cV_1)?$cV_1:''; ?>
                        </div>
                        <input type="hidden" value="<?php echo isset($court_type)?$court_type:''; ?>" class="form-control" id="txtValue" name="courtTypeN" />
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($cV_2)?$cV_2:''; ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($cV_3)?$cV_3:''; ?>
                        </div>    
                    </td>
                </tr>
                <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <div class ="form-group unConDis ml-5">
                                <?php 
                                if(isset($cDist) && $cDist !=''){
                                    echo 'District : ';
                                    echo isset($cDist)?$cDist:''; 
                                }
                                ?>
                                <input type="hidden" value="<?php echo isset($cDist)?$cDist:''; ?>" class="form-control" id="district" name="districtN">
                            </div>
                        </td>
                        <td>
                            <div class ="form-group unConTh ml-5">
                                <?php 
                                    if(isset($cUpa) && $cUpa != ''){
                                        echo 'Upazilla : ';
                                        echo isset($cUpa)?$cUpa:''; 
                                    }
                                    
                                ?>
                                <input type="hidden" value="<?php echo isset($cUpa)?$cUpa:''; ?>" class="form-control" id="thana" name="thanaN">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <?php
                            $cCat1= '';
                            $cCat2= '';
                            $category_id = strval($category_id);
                            if(isset($categorytest) && !empty($categorytest)){
                                foreach($categorytest as $cc) {
                                    if(substr($category_id, 0, 2) === strval($cc->lmcc_cc_id_l2)){
                                        $cCat1 = $cc->lmcc_cc_desc_l2;
                                            if($category_id === strval($cc->lmcc_cc_id_l3)){
                                                $cCat2 = $cc->lmcc_cc_desc_l3;
                                            }   
                                    }
                                }
                            }        
                        ?>
                            <div class="form-group ta-r">
                                <label for="caseCategory">Case Category</label>
                            </div>
                        </td>   
                        <td>
                            <div class="form-group ml-5">
                                <?php echo isset($cCat1)?$cCat1:''; ?>
                            </div>
                            <input type="hidden" value="<?php echo isset($category_id)?$category_id:''; ?>" class="form-control" id="CCValue" name="caseCategoryN" />
                        </td>
                        <td>
                            <div class="form-group ml-5">
                                    <?php echo isset($cCat2)?$cCat2:''; ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                    <td><div class="form-group ta-r"><label for="caseNo">Suit/Case Number</label></div></td>
                    <td>
                    <div class="form-group ml-5">
                        <?php echo isset($caseNoN)?$caseNoN:''; ?>
                        <input type="hidden" class="form-control" value="<?php echo isset($caseNoN)?$caseNoN:'';?>" name="caseNoN" id="caseNo" >
                    </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                        <label for="scaseFileStatus">Suit/Case Filed By</label>
                        </div>
                        </td>
                        <td>
                        <div class="form-group ml-5">
                            <?php
                                
                                if(isset($caseFileStatusN) && $caseFileStatusN == 1)
                                {
                                    echo "Bank";
                                }
                                if(isset($caseFileStatusN) && $caseFileStatusN == 2){
                                    echo "Customer/Others";
                                }
                            ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($caseFileStatusN)?$caseFileStatusN:'';?>" name="caseFileStatusN" id="scaseFileStatus" >
                            </div>     
                        </td>
                </tr>
                <tr>       
                    <td>
                        <div class="form-group ta-r">
                            <label for="filingDate">Filing date</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($filingDateN)?$filingDateN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($filingDateN)?$filingDateN:''; ?>" name="filingDateN" id="filingDate" placeholder="Filing Date">
                        </div>
                    </td>
                    <?php 
                        if(strval($court_type[0]) !== strval(5)) {
                        ?>
                    <td>
                        <div class="form-group ta-r unConLocC">
                            <label for="locationOfCourt">Loction of Court</label>
                        </div>        
                    </td>
                    <td>
                        <div class="form-group ml-5 unConLocC">
                            <?php 
                                foreach($lms_court_locs as $lms_court_loc)
                                { 
                                    if(strval($locationOfCourtN) === strval($lms_court_loc->dtcode)){
                                        echo isset($lms_court_loc->dtname)?$lms_court_loc->dtname:'';
                                    }    
                                ?>
                            <?php } ?> 
                            <input type="hidden" class="form-control" value="<?php echo isset($locationOfCourtN)?$locationOfCourtN:''; ?>" name="locationOfCourtN" id="locationOfCourt">      
                        </div>
                    </td>
                    <?php } ?>                
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="sensitivity">Sensitivity</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php
                                
                                if(isset($sensitivityN) && $sensitivityN == 1)
                                {
                                    echo "High";
                                }
                                if(isset($sensitivityN) && $sensitivityN == 2){
                                    echo "Low";
                                }
                            ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($sensitivityN)?$sensitivityN:''; ?>" name="sensitivityN" id="sensitivity">      
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="suitValueAmt">Suit/Case Value</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($suitValueAmtN)?number_format($suitValueAmtN, 2):''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($suitValueAmtN)?$suitValueAmtN:''; ?>" name="suitValueAmtN" id="suitValueAmt">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="recoAmt"><span class="fontSize12 recoWid">Recovery Amount (After Filing Suit)</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php if(isset($recoAmtN) && $recoAmtN !=''){
                                echo isset($recoAmtN)?number_format($recoAmtN, 2):'';
                            } ?>
                            <input type="hidden" value="<?php if(isset($recoAmtN) && $recoAmtN !=''){ echo isset($recoAmtN)?$recoAmtN:'';}else{echo "0";} ?>" class="form-control" name="recoAmtN" id="recoAmt">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="outstanding">Loan A/C Outstanding</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($outstandingN)?number_format($outstandingN, 2):''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($outstandingN)?$outstandingN:''; ?>" name="outstandingN" id="outstanding">
                        </div>
                    </td>    
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="loanACNo">Loan A/C No</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($loanACNoN)?$loanACNoN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($loanACNoN)?$loanACNoN:''; ?>" name="loanACNoN" id="loanACNo">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="loanACName">Loan A/C Name</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($loanACNameN)?$loanACNameN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($loanACNameN)?$loanACNameN:''; ?>" name="loanACNameN" id="loanACName">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="bMobileNo">A/C Holder Mobile No.</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($bMobileNoN)?$bMobileNoN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($bMobileNoN)?$bMobileNoN:''; ?>" name="bMobileNoN" id="bMobileNo">
                        </div>
                    </td>  
                    <td>
                        <div class="form-group ta-r">
                            <label for="bNID">A/C Holder NID</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($bNIDN)?$bNIDN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($bNIDN)?$bNIDN:''; ?>" name="bNIDN" id="bNID">
                        </div>
                    </td>        
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="ACHolderAddress">A/C Holder Address</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($ACHolderAddN)?$ACHolderAddN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($ACHolderAddN)?$ACHolderAddN:''; ?>" name="ACHolderAddN" id="ACHolderAdd">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="trackingTranNo">Related Case No. (If)</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($trackingTranNoN)?$trackingTranNoN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($trackingTranNoN)?$trackingTranNoN:''; ?>" name="trackingTranNoN" id="trackingTranNo">
                        </div>
                    </td>               
                </tr>
                
                <tr>
                    <td>
                        <div class="form-group unCon ta-r">
                            <label for="unClassduewrit"><span  class="" style="">Unclassified Amount Due to Writ</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group unCon ml-5">
                        <?php echo isset($unClassduewritN)?$unClassduewritN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($unClassduewritN)?$unClassduewritN:''; ?>" name="unClassduewritN" id="unClassduewrit">
                        </div>
                    </td>
                    <td>
                        <div class="form-group unConBr ta-r">
                            <label for="unBrName"><span style="">Search Required Branch</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group unConBr ml-5">
                            <?php echo isset($report_report_office_id)?$report_report_office_id:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($report_report_office_id)?$report_report_office_id:''; ?>" name="unBrNameN" id="unBrName">
                        </div>
                    </td>
                </tr>
                <tr id="report_of_br_ao_do_div_msg"></tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="subjectIssue">Subject Fact/Issue</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <select name="subjectFactChoose" class="form-control subjectFactC" id="subjectFactChoose" style="display:none" onchange="select_subject_fact()">
                                <option value="0">Select</option>
                                <?php foreach($subjectissue as $val=>$fact){ ?>
                                    <option value="<?php echo $fact->sub_fact_issue_id; ?>"><?php echo $fact->sub_fact_issue_desc; ?></option>
                                <?php } ?>
                            </select>
                            <?php echo isset($subjectIssueN)?$subjectIssueN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($subjectIssueN)?$subjectIssueN:''; ?>" name="subjectIssueN" id="subjectIssue">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="plComPetName"><span  class="fontSize12" style="font-weight:700">Plaintiff/Complainant/Petitioner Name</span></label>
                        </div>
                    </td>        
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($plComPetNameN)?$plComPetNameN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($plComPetNameN)?$plComPetNameN:''; ?>" name="plComPetNameN" id="plComPetName">
                        </div>
                    </td>        
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="primarysecSan"><span class="fontSize12" style="">Primary Security value(Sanction)</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php 
                                if(isset($primarysecSanN) && $primarysecSanN !=''){
                                    echo isset($primarysecSanN)?number_format($primarysecSanN, 2):''; 
                                }
                            ?>
                            <input type="hidden" class="form-control" value="<?php if(isset($primarysecSanN) && $primarysecSanN !=''){echo isset($primarysecSanN)?$primarysecSanN:''; }else{echo "0";}?>" name="primarysecSanN" id="primarysecSan">
                        </div>  
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="defAccResName"><span  class="fontSize12" style="font-weight:700">Defendant/Accused/Respondent Name</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($defAccResNameN)?$defAccResNameN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($defAccResNameN)?$defAccResNameN:''; ?>" name="defAccResNameN" id="defAccResName">
                        </div>
                    </td>
                </tr>
                    
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="primarysecST"><span class="fontSize12" style="">Primary Security value(Suit Time)</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php
                                if(isset($primarysecSTN) && $primarysecSTN !=''){
                                    echo isset($primarysecSTN)?number_format($primarysecSTN, 2):''; 
                                } 
                            ?>
                            <input type="hidden" class="form-control" value="<?php if(isset($primarysecSTN) && $primarysecSTN !=''){echo isset($primarysecSTN)?$primarysecSTN:''; }else{echo "0";} ?>" name="primarysecSTN" id="primarysecST">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="primarysecP"><span class="fontSize12" style="">Primary Security value(Present)</span></label>
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ml-5">
                            <?php 
                                if(isset($primarysecPN) && $primarysecPN !=''){
                                    echo isset($primarysecPN)?number_format($primarysecPN, 2):''; 
                                }    
                            ?>
                            <input type="hidden" class="form-control" value="<?php if(isset($primarysecPN) && $primarysecPN !=''){echo isset($primarysecPN)?$primarysecPN:''; }else{echo "0";} ?>" name="primarysecPN" id="primarysecP">
                        </div>
                    </td>               
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="collSecSan"><span class="fontSize12" style="">Collateral Security value(Sanction)</span></label>
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ml-5">
                            <?php 
                                if(isset($collSecSanN) && $collSecSanN !=''){
                                    echo isset($collSecSanN)?number_format($collSecSanN, 2):''; 
                                }
                            ?>
                            <input type="hidden" class="form-control" value="<?php if(isset($collSecSanN) && $collSecSanN !=''){echo isset($collSecSanN)?$collSecSanN:''; }else{echo "0"; }?>" name="collSecSanN" id="collSecSan">
                        </div>
                    </td> 
                    <td>
                        <div class="form-group ta-r">
                            <label for="collSecST"><span class="fontSize12" style="">Collateral Security value(Suit Time)</span></label>
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ml-5">
                            <?php 
                                if(isset($collSecSTN) && $collSecSTN !=''){
                                    echo isset($collSecSTN)?number_format($collSecSTN, 2):''; 
                                }
                            ?>
                            <input type="hidden" class="form-control" value="<?php if(isset($collSecSTN) && $collSecSTN !=''){echo isset($collSecSTN)?$collSecSTN:''; }else{echo "0"; }?>" name="collSecSTN" id="collSecST">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="collSecP"><span class="fontSize12" style="">Collateral Security value(Present)</span></label>
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ml-5">
                            <?php 
                                if(isset($collSecPN) && $collSecPN !=''){
                                    echo isset($collSecPN)?number_format($collSecPN, 2):''; 
                                }            
                            ?>
                            <input type="hidden" class="form-control" value="<?php if(isset($collSecPN) && $collSecPN !=''){echo isset($collSecPN)?$collSecPN:''; }else{echo "0"; }?>" name="collSecPN" id="collSecP">
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ta-r">
                            <label for="fileMaintOffBID"><span class="fontSize12" style="">Manager/Dealing Officer Bank ID</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($fileMaintOffBIDN)?$fileMaintOffBIDN:''; ?>
                            <input type="hidden" class="form-control" value="<?php echo isset($fileMaintOffBIDN)?$fileMaintOffBIDN:''; ?>" name="fileMaintOffBIDN">
                        </div>
                    </td>
                </tr>
                    <tr>
                        <td>
                            <div class="form-group ta-r">
                                <label for="descCollSec">Collateral Security Description</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group ml-5">
                                <?php echo isset($descCollSecN)?$descCollSecN:''; ?>
                                <input type="hidden" class="form-control" value="<?php echo isset($descCollSecN)?$descCollSecN:''; ?>" name="descCollSecN" id="descCollSec">
                            </div>
                        </td>
                        <td>
                            <div class="form-group ta-r">
                                <label for="remarks">Remarks</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group ml-5">
                                <?php echo isset($remarksN)?$remarksN:''; ?>
                                <input type="hidden" class="form-control" value="<?php echo isset($remarksN)?$remarksN:''; ?>" name="remarksN" id="remarks">
                            </div>
                        </td>
                    </tr>
                    <tr>                        
                        
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group ta-r unConLaw">
                                <label for="lawyerInfoA">Lawyer Name</label>
                            </div>
                        </td>                 
                        <td colspan="2">
                            <div class="form-group ml-5 unConLaw">
                                <input type="hidden" class="form-control" value="<?php echo isset($lawerDb)?$lawerDb:''; ?>" name="lawyerInfoNW" id="lawyerInfoA">
                                <?php 
                                $lawIdArrEdit = explode(',', $lawerDb);
                                $dataLawerEditAll = $this->lmsmodel->lms_lawer_data($lawIdArrEdit);
                                ?>
                                <?php 
                                foreach($dataLawerEditAll as $lawAll){ ?>
                                    <tr>
                                        <td><?php //echo isset($lawAll->lml_data_id)?$lawAll->lml_data_id:'';?></td>
                                        <td><?php echo isset($lawAll->lml_lawer_name)?$lawAll->lml_lawer_name:'';?></td>
                                        <td><?php //echo isset($lawAll->lml_lawer_advPosition)?$lawAll->lml_lawer_advPosition:'';?></td>
                                    </tr>
                                <?php  } ?>
                            </div>    
                        </td>                
                    </tr>  
                    <tr>
                        <td>
                            <div class="form-group ta-r">
                                <label for="authenBy"><p style="font-size: 12px">Above all information is corrected by Manager/Dealing Officer</p></label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group ml-5">
                                <!-- <input type="text" class="form-control" value="" name="authenByN" id="authenBy"> -->
                                <input type="checkbox" id="authenBy" name="authenBy" value="1">
                            </div>
                        </td>
                       
                    </tr>                          
                </tbody>
            </table>
        </div>
        <table align="" class="btnTable">
            <tbody>
                <tr>  
                    <td></td>
                    <td></td>              
                    <td>
                        <input type="button" class="btnSave" name="prvBtnC" value="Edit" <?php echo $attribute; ?> onclick="check_lms_basic_checker_pvr_form(this.value)" >
                    </td>
                    <td>
                        <input type="button" class="btnSave" name="prvBtnC" value="Save" <?php echo $attribute; ?> onclick="check_lms_basic_checker_pvr_form(this.value)" >
                    </td>
                    <td>
                        <input type="hidden" id="ChkerprvBtnID" name="ChkerprvBtn" value=""  >            
                    </td>
                    
                </tr>  
            </tbody>
        </table>
    
    <?php } else {?>
          <div>
            <h4 style="color:red">You are not Authenticate to Access this Module</h4>
          </div>      
        <?php }?>
    <?php echo form_close(); ?>
</div>

