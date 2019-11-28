<style>

</style>
<div class="container">

<?php
if($this->session->flashdata('error_lb_EbasicInfo'))
{
    echo "<div id='flashdata'>";
    echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('error_lb_EbasicInfo').'</font>'; 
    echo "</div>";
}
$attribute = '';
?>
<script>
var firstLevel = new Array;  
var secondLevel = new Array;  
var thirdLevel = new Array;  
async function getCourt(){
    try{
       const result = await fetch('<?php echo base_url(); ?>/index.php/lms/lms_court_type_view_apiindex.php');
        const data = await result.json();
        return data;
    }
    catch(error){
        console.log(error);
    }    
}

getCourt().then(data =>{
    for (let value of Object.values(data)) {
        firstLevel[value.lmct_ct_id_l1] = value.lmct_ct_desc_l1;
        secondLevel[value.lmct_ct_id_l2] = value.lmct_ct_desc_l2;
        thirdLevel[value.lmct_ct_id_l3] = value.lmct_ct_desc_l3;
    }
});
window.onload = function() {
    select_first_initial();
    document.getElementById("firstList").selectedIndex = (document.getElementById("txtValue").value).toString().charAt(0);

    document.getElementById("secondList").options.length=0;
    document.getElementById("secondList").options[0] = new Option('--Select--', '0');
    var i =1;
    secondLevel.map((val, key)=>{
        if ((document.getElementById("firstList").selectedIndex) == (key).toString().charAt(0)){
            if(val != '' && key !=''){
                document.getElementById("secondList").options[i++] = new Option((val), key);
            }   
        }
    }); 
    document.getElementById("secondList").selectedIndex = parseInt((document.getElementById("txtValue").value).toString().substr(1, 2));
    if((document.getElementById("firstList").selectedIndex) == 3){
        document.getElementById("secondList").selectedIndex = (document.getElementById("txtValue").value).toString().charAt(1);
        
        document.getElementById("thirdList").options.length=0;
        document.getElementById("thirdList").options[0] = new Option('--Select--', '0');
        i=1;
        var lost2 = ((document.getElementById("secondList").options[document.getElementById("secondList").selectedIndex].value));
        if(lost2 =="31" || lost2 == "32"){    
            thirdLevel.map((val, key)=>{
                if (lost2 == (key).toString().substr(0, 2)){
                    if(val != '' && key !=''){
                        document.getElementById("thirdList").options[i++] = new Option((val), key);
                    }   
                }
            });  
        }
        document.getElementById("thirdList").selectedIndex = parseInt((document.getElementById("txtValue").value).toString().substr(2, 2));
    }
}

function select_first_initial(){
    var list1 = document.getElementById('firstList');
    list1.options.length=0;
    list1.options[0] = new Option('--Select--', '0');
    var i=1;
    firstLevel.map((val, key)=>{
        if(val != '' && key !=''){
            list1.options[i++] = new Option((val), key);
        }   
    });  
}
function court_type_3(){
    document.getElementById("txtValue").value = document.getElementById("thirdList").value;
}
function court_type_2_select(){
    court_type_2();
}
function court_type_1_select(){
    court_type_1();
}
function court_type_2(){
    var list2 = document.getElementById("secondList");
    var list3 = document.getElementById("thirdList");   
    var list1SelectedValue2 = list2.options[list2.selectedIndex].value;
    list3.options.length=0;
    list3.options[0] = new Option('--Select--', '0');
    var i=1;
    if(list1SelectedValue2 =="31" || list1SelectedValue2 == "32"){    
        thirdLevel.map((val, key)=>{
            if (list1SelectedValue2 == (key).toString().substring(0,2)){
                if(val != '' && key !=''){
                    list3.options[i++] = new Option((val), key);
                }   
            }
        });  
    }
    document.getElementById("txtValue").value = list2.value;
}

function court_type_1(){
    var list1 = document.getElementById('firstList');
    var list2 = document.getElementById("secondList");
   var list3 = document.getElementById("thirdList");   
    var list1SelectedValue = list1.options[list1.selectedIndex].value;

    list2.options.length=0;
    list2.options[0] = new Option('--Select--', '0');
    var i =1;
    secondLevel.map((val, key)=>{
        if (list1SelectedValue == (key).toString().charAt(0)){
            if(val != '' && key !=''){
                list2.options[i++] = new Option((val), key);
            }   
        }
    });    
    list3.options.length=0;
    list3.options[0] = new Option('--Select--', '0');        
}

</script>

<div class="header-info text-center">
    <h4>LAWSUIT BASIC INFORMATION EDIT</h4>
</div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicEditForm', 'id'=>'lms_basic_edit_form');
        echo form_open('lms/lms_basic_entry_edit_details_save', $attributesForm);
    ?>
    <?php if(isset($lmsSeditDatas) && !empty($lmsSeditDatas)) { ?>    
        <div class="row">
            <table class="table table-sm table-borderless" id="search_form_table_n">
                <tbody>
                    <tr>
                        <div class="form-group">
                        <td><label for="tranNo">Trac. No</label></td>
                        <td>
                            <input type="text" name="tranNoN" class="form-control" id="tranNo" value="<?php echo isset($lmsSeditDatas[0]->lb_tran_no)?$lmsSeditDatas[0]->lb_tran_no:''; ?>" readonly placeholder="Tracking Number">
                            <input type="hidden" name="lb_data_idE" value="<?php echo isset($lmsSeditDatas[0]->lb_data_id)?$lmsSeditDatas[0]->lb_data_id:''; ?>" >
                            
                        </td>
                        </div>
                        <div class="form-group">
                        <td><label for="caseNo">Case Number</label></td>
                        <td>
                            <input type="text" class="form-control" name="caseNoN" id="caseNo" value="<?php echo isset($lmsSeditDatas[0]->lb_case_no)?$lmsSeditDatas[0]->lb_case_no:''; ?>" placeholder="Case Number">
                            <div class="error" id="caseNoNID"></div>
                        </td>
                        </div>
                    </tr>  
                    <tr>
                         <td>
                        <div class="form-group">
                        <label for="courtType">Court Type</label>
                        </div>
                        </td>
                        <td>
                            <select class="courtT form-control"  id='firstList' name='CTfirstListN' onChange="court_type_1()">
                            </select>
                            <div class="error" id="CTfirstListEID" tabindex="-1"></div>
                        <input type="hidden" value="<?php echo $lmsSeditDatas[0]->lb_court_type?>" class="form-control" id="txtValue" name="courtTypeN" />
                        </td>
                        <td>
                            <select class="courtT form-control"  id='secondList' name='CTsecondListN' onChange="court_type_2()">
                            </select>
                            <div class="error" id="CTsecondListEID" tabindex="-1"></div>
                        </td>
                        <td>
                            <select class="courtT form-control"  id='thirdList' name='CTthirdListN' onChange="court_type_3()">
                            </select>
                            <div class="error" id="CTthirdListEID" tabindex="-1"></div>
                        </td>
                    </tr>
                     <tr> 
                        <div class="form-group">
                        <td><label for="caseType">Case Type</label></td>
                        <td colspan="">
                            <select name="caseTypeN" class="choseSelect caseTypeC" id="caseType">
                                <?php
                                    $cTselect1='';
                                    $cTselect2='';
                                    if(isset($_POST['caseTypeN']) && $_POST['caseTypeN']== 1)
                                    {
                                        $cTselect1="selected='selected'";
                                    }else if(isset($_POST['caseTypeN']) && $_POST['caseTypeN']== 2){
                                        $cTselect2="selected='selected'";
                                    }else{
                                        $cTselect1='';
                                        $cTselect2='';
                                    }
                                ?>
                                <option value="0">Select Case Type</option>
                                <option <?php if($lmsSeditDatas[0]->lb_case_type==1){echo "selected"; }?> value="1" <?php echo isset($cTselect1)?$cTselect1:'';?>>New</option>
                                <option <?php if($lmsSeditDatas[0]->lb_case_type==2){echo "selected"; }?> value="2" <?php echo isset($cTselect2)?$cTselect2:'';?>>Revived</option>
                            </select>
                            <div class="error" id="caseTypeID" tabindex="-1"></div>
                        </td>
                        </div>
                    </tr>
                    
                    <tr>
                    <div class="form-group">
                        <td><label for="caseCategory">Case Category</label></td>
                        <td>
                            <select name="caseCategoryN" class="choseSelect caseCategoryC" id="caseCategory">
                            <option value="0">Select Case Category</option>
                            <?php 
                                foreach($lms_case_types as $lms_case_type)
                                {
                                    $cCselect='';
                                    if(isset($_POST['caseCategoryN']) && $_POST['caseCategoryN']==$lms_case_type->lmcc_cc_id)
                                    {
                                        $cCselect="selected='selected'";
                                    }
                            ?>
                                <option <?php if($lms_case_type->lmcc_cc_id == $lmsSeditDatas[0]->lb_category_id){echo "selected"; } ?> value="<?php echo isset($lms_case_type->lmcc_cc_id)?$lms_case_type->lmcc_cc_id:''; ?>" <?php echo isset($cCselect)?$cCselect:''; ?> >
                                <?php echo isset($lms_case_type->lmcc_cc_desc)?$lms_case_type->lmcc_cc_desc:''; ?>
                                </option>
                            <?php } ?>
                            </select>
                            <div class="error" id="caseCategoryEID" tabindex="-1"></div>
                        </td> 
                    </div>   
                    <div class="form-group">
                        <td><label for="scaseFileStatus">By Suit/Case File Status</label></td>
                        <td>
                            <select name="caseFileStatusN" class="choseSelect caseFileStatusC" id="scaseFileStatus">
                            <?php
                                $cFselect1='';
                                $cFselect2='';
                                if(isset($_POST['caseFileStatusN']) && $_POST['caseFileStatusN']== 1)
                                {
                                    $cFselect1="selected='selected'";
                                }else if(isset($_POST['caseFileStatusN']) && $_POST['caseFileStatusN']== 2){
                                    $cFselect2="selected='selected'";
                                }else{
                                    $cFselect1='';
                                    $cFselect2='';
                                }
                            ?>
                                <option value="0">Select</option>        
                                <option <?php if($lmsSeditDatas[0]->lb_suit_file_status == 1){echo "selected"; } ?> value="1" <?php echo isset($cFselect1)?$cFselect1:'';?>>the Bank</option>        
                                <option <?php if($lmsSeditDatas[0]->lb_suit_file_status == 2){echo "selected"; } ?> value="2" <?php echo isset($cFselect2)?$cFselect2:'';?>>the Party</option>        
                            </select>
                            <div class="error" id="scaseFileStatusEID" tabindex="-1"></div>
                        </td>
                    </div>        
                    </tr>
                    
                    <tr>
                        <div class="form-group">
                        <td><label for="filingDate">Filing date</label></td>
                        <td>
                            <input type="date" class="form-control" name="filingDateN" id="filingDate" value="<?php echo date('Y-m-d', strtotime(isset($lmsSeditDatas[0]->lb_filing_date)?$lmsSeditDatas[0]->lb_filing_date:'')); ?>" placeholder="Filing Date">
                            <div class="error" id="filingDateEID" tabindex="-1"></div>
                        </td>
                        </div>
                        <div class="form-group">
                        <td><label for="locationOfCourt">Loction of Court</label></td>
                        <td>
                            <select name="locationOfCourtN" class="choseSelect" id="locationOfCourt">
                            <option value="0">Select Court Location</option>
                            <?php 
                                foreach($lms_court_locs as $lms_court_loc)
                                {
                                    $select='';
                                    if(isset($_POST['locationOfCourtN']) && $_POST['locationOfCourtN']==$lms_court_loc->dtcode)
                                    {
                                        $select="selected='selected'";
                                    }
                            ?>
                                <option <?php if($lmsSeditDatas[0]->lb_loc_court_id == $lms_court_loc->dtcode){echo "selected"; } ?> value="<?php echo isset($lms_court_loc->dtcode)?$lms_court_loc->dtcode:''; ?>" <?php echo isset($select)?$select:''; ?> >
                                <?php echo isset($lms_court_loc->dtname)?$lms_court_loc->dtname:''; ?>
                                </option>
                            <?php } ?>      
                            </select>
                            <div class="error" id="locOfCourtEID" tabindex="-1"></div>
                        </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="sensitivity">Sensitivity</label></td>
                        <td>
                            <select name="sensitivityN" class="choseSelect sensitivityC" id="sensitivity">
                            <?php
                                $cSselect1='';
                                $cSselect2='';
                                if(isset($_POST['sensitivityN']) && $_POST['sensitivityN']== 1)
                                {
                                    $cSselect1="selected='selected'";
                                }else if(isset($_POST['sensitivityN']) && $_POST['sensitivityN']== 2){
                                    $cSselect2="selected='selected'";
                                }else{
                                    $cSselect1='';
                                    $cSselect2='';
                                }
                            ?>
                                <option value="0">Select</option>        
                                <option <?php if($lmsSeditDatas[0]->lb_sensitivity == 1){echo "selected"; }?> value="1" <?php echo isset($cSselect1)?$cSselect1:'';?>>Yes</option>        
                                <option <?php if($lmsSeditDatas[0]->lb_sensitivity == 2){echo "selected"; }?> value="2" <?php echo isset($cSselect2)?$cSselect2:'';?>>No</option>        
                            </select>
                        </td>
                        </div>
                        <div class="form-group">
                        <td><label for="claimAmount">Claim Amount</label></td>
                        <td>
                            <input type="text" class="form-control" name="claimAmountN" id="claimAmount" value="<?php echo isset($lmsSeditDatas[0]->lb_claim_amt)?$lmsSeditDatas[0]->lb_claim_amt:''; ?>" placeholder="Claim Amount">
                            <div class="error" id="claimAmountEID" tabindex="-1"></div>
                        </td>
                        </div>
                    </tr>
                    <tr>
                        
                        <div class="form-group">
                        <td><label for="recoAmt">Reco. Amt.(During the Suit)</label></td>
                        <td><input type="text" class="form-control" name="recoAmtN" id="recoAmt" value="<?php echo isset($lmsSeditDatas[0]->lb_reco_amt)?$lmsSeditDatas[0]->lb_reco_amt:''; ?>" placeholder="Reco. Amt."></td>
                        </div>
                        <div class="form-group">
                        <td><label for="outstanding">Outstanding</label></td>
                        <td>
                            <input type="text" class="form-control" name="outstandingN" id="outstanding" value="<?php echo isset($lmsSeditDatas[0]->lb_outstanding)?$lmsSeditDatas[0]->lb_outstanding:''; ?>" placeholder="Outstanding">
                            <div class="error" id="outstandingEID" tabindex="-1"></div>
                        </td>    
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="loanACNo">Loan A/C No</label></td>
                        <td><input type="text" class="form-control" name="loanACNoN" id="loanACNo" value="<?php echo isset($lmsSeditDatas[0]->lb_loan_ac_no)?$lmsSeditDatas[0]->lb_loan_ac_no:''; ?>" placeholder="Loan A/C No"></td>
                        </div>
                        <div class="form-group">
                        <td><label for="loanACName">A/C Name</label></td>
                        <td>
                            <input type="text" class="form-control" name="loanACNameN" id="loanACName" value="<?php echo isset($lmsSeditDatas[0]->lb_loan_ac_name)?$lmsSeditDatas[0]->lb_loan_ac_name:''; ?>" placeholder="Loan A/C Name">
                            <div class="error" id="loanACNameEID" tabindex="-1"></div>
                        </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="ACHolderAddress">A/C Holder Address</label></td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="ACHolderAddN" id="ACHolderAdd" value="<?php echo isset($lmsSeditDatas[0]->lb_acholder_addres)?$lmsSeditDatas[0]->lb_acholder_addres:''; ?>" style="width:98%" placeholder="A/C Holder Address">
                            <div class="error" id="ACHolderAddEID" tabindex="-1"></div>
                        </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="trackingTranNo">Tracking Tran No.</label></td>
                        <td><input type="text" class="form-control" name="trackingTranNoN" id="trackingTranNo" value="<?php echo isset($lmsSeditDatas[0]->lb_tran_no_other)?$lmsSeditDatas[0]->lb_tran_no_other:''; ?>" placeholder="Tracking Tran No."></td>
                        </div>
                        <div class="form-group">
                        <td><label for="unClassduewrit"><span  class="fontSize12" style="font-weight:700">Unclassified Amount Due to Writ</span></label></td>
                        <td>
                            <input type="text" class="form-control" name="unClassduewritN" id="unClassduewrit" value="<?php echo isset($lmsSeditDatas[0]->lb_unclassfied_amt_duesuit)?$lmsSeditDatas[0]->lb_unclassfied_amt_duesuit:''; ?>" placeholder="Unclassified Amount Due to Writ">
                        </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="subjectIssue">Subject Fatc/Issue</label></td>
                        <td>
                            <input type="text" class="form-control" name="subjectIssueN" id="subjectIssue" value="<?php echo isset($lmsSeditDatas[0]->lb_issue)?$lmsSeditDatas[0]->lb_issue:''; ?>" placeholder="Subject Fatc/Issue">
                        </td>
                        <td colspan=""><label for="plComPetName"><span  class="fontSize12" style="font-weight:700">Plaintiff/Complainant/Petitioner Name</span></label></td>        
                        <td colspan="">
                            <input type="text" class="form-control" name="plComPetNameN" id="plComPetName" value="<?php echo isset($lmsSeditDatas[0]->lb_pl_co_pe_name)?$lmsSeditDatas[0]->lb_pl_co_pe_name:''; ?>" placeholder="Plaintiff/Complainant/Petitioner Name">
                        </td>        
                        </div>
                    </tr>

                    <tr>
                        

                        <div class="form-group">
                        <td><label for="defAccResName"><span  class="fontSize12" style="font-weight:700">Defendant/Accused/Respondent Name</span></label></td>
                        <td colspan="">
                            <input type="text" class="form-control" name="defAccResNameN" id="defAccResName" value="<?php echo isset($lmsSeditDatas[0]->lb_de_ac_re_name)?$lmsSeditDatas[0]->lb_de_ac_re_name:''; ?>" placeholder="Defendant/Accused/Respondent Name">
                        </td>
                        </div>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="fileMaintOffBID"><span  class="fontSize12" style="font-weight:700">File Maintenance Officer Bank ID</span></label></td>
                        <td>
                            <input type="text" class="form-control" name="fileMaintOffBIDN" id="fileMaintOffBID" value="<?php echo isset($lmsSeditDatas[0]->lb_file_officer_bid)?$lmsSeditDatas[0]->lb_file_officer_bid:''; ?>" placeholder="File Maintenance Officer Bank ID">
                            <div class="error" id="fileMaintOffBIDEID" tabindex="-1"></div>
                        </td>
                        </div>
                        <div class="form-group">
                        <td><label for="fileMaintOffName"><span class="fontSize12" style="font-weight:700">File Maintenance Officer Name</span></label></td>
                        <td colspan="">
                            <input type="text" class="form-control" name="fileMaintOffNameN" id="fileMaintOffName" value="<?php echo isset($lmsSeditDatas[0]->lb_file_officer_name)?$lmsSeditDatas[0]->lb_file_officer_name:''; ?>" placeholder="File Maintenance Officer Name">
                        </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="primarySecurity">Primary Security</label></td>
                        <td>
                            <input type="text" class="form-control" name="primarySecurityN" id="primarySecurity" value="<?php echo isset($lmsSeditDatas[0]->lb_primary_security)?$lmsSeditDatas[0]->lb_primary_security:''; ?>" placeholder="Primary Security">
                        </td>
                        </div>
                        <div class="form-group">
                        <td><label for="collSecuSanction">Coll. Security (Sanction)</label></td>
                        <td>
                            <input type="text" class="form-control" name="collSecuSanctionN" id="collSecuSanction" value="<?php echo isset($lmsSeditDatas[0]->lb_coll_sec_sanction)?$lmsSeditDatas[0]->lb_coll_sec_sanction:''; ?>" placeholder="Coll. Security(Sanction)">
                        </td>
                        </div>
                        
                    </tr>
                    <tr>
                    <div class="form-group">
                    <td><label for="collSecTimeSuit">Coll. Sec.(Time of Suit)</label></td>
                    <td>
                        <input type="text" class="form-control" name="collSecTimeSuitN" id="collSecTimeSuit" value="<?php echo isset($lmsSeditDatas[0]->lb_coll_sec_timeofsuit)?$lmsSeditDatas[0]->lb_coll_sec_timeofsuit:''; ?>" placeholder="Coll. Sec.(Time of Suit)">
                    </td>   
                    </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="descCollSec">Desc. of Coll. Sec.</label></td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="descCollSecN" id="descCollSec" value="<?php echo isset($lmsSeditDatas[0]->lb_desc_coll_security)?$lmsSeditDatas[0]->lb_desc_coll_security:''; ?>" style="width:98%" placeholder="Description of Collateral Security">
                        </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td><label for="remarks">Remarks</label></td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="remarksN" id="remarks" value="<?php echo isset($lmsSeditDatas[0]->lb_remarks)?$lmsSeditDatas[0]->lb_remarks:''; ?>" style="width:98%" placeholder="Remarks">
                        </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                        <td>
                            <label for="lawyerInfo">Lawyer Name</label>
                        </td>
                        <td>                           
                    <select name="lawyerInfoN" class="choseSelect" id="lawyerInfo" onchange="get_lawyer_value(this)">
                        <option value="0">Select </option>
                        <?php 
                            foreach($lms_lawer_infos as $lms_lawer_info)
                            {
                        ?>
                            <option value="<?php echo isset($lms_lawer_info->ui_code)?$lms_lawer_info->ui_code:''; ?>"><?php echo isset($lms_lawer_info->ui_Full_Name)?$lms_lawer_info->ui_Full_Name:''; ?></option>
                         <?php } ?>   
                        </select>
                        </td>
                        </div>
                    </tr>    
                    <tr>
                         <td></td>       
                        <td colspan="2">
                            <div id="addHere">
                            <?php if(!empty($q_lms_lawyerName) && count($q_lms_lawyerName)>1){ 
                                foreach($q_lms_lawyerName as $lawerS){
                                ?>
                                <div class="row lawyerborder">
                                    <?php ?>
                                    <input type="hidden" name="lawyerInfoN[]" value="<?php echo $lawerS->lml_lawer_id; ?>">        
                                    <label><?php echo $lawerS->lml_lawer_id; ?></label><label> <?php echo $lawerS->lml_lawer_name; ?> </label><input type="button" value="-" onclick="removeRow(this)">
                                </div>
                                <?php } }?>
                            </div>
                        </td>      
                    </tr>         
                </tbody>
            </table>
        </div>
        <table>
            <tbody>
                <tr>
                   
                    <td>
                    <input type="button" class="btn btnSave" value="Save Changes" <?php echo $attribute; ?> style="background-color: #d4723d;
    padding: 0px 18px;" onclick="check_lms_basic_edit_form(this.value)" >
                    </td>
                    
                </tr>  
            </tbody>
        </table>
    </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php } ?>
    <?php echo form_close(); ?>
    
</div>
