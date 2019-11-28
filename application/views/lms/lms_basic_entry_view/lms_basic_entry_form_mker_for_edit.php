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
<script>

var firstCTLevel = new Array;  
var secondCTLevel = new Array;  
var thirdCTLevel = new Array;   

<?php
if(isset($lmscourts) && !empty($lmscourts)){
    foreach($lmscourts as $court){?>
        firstCTLevel[<?php echo $court->lmct_ct_id_l1; ?>] = "<?php echo $court->lmct_ct_desc_l1; ?>";
        secondCTLevel[<?php echo $court->lmct_ct_id_l2; ?>] = "<?php echo $court->lmct_ct_desc_l2; ?>";
        thirdCTLevel[<?php echo $court->lmct_ct_id_l3; ?>] = "<?php echo $court->lmct_ct_desc_l3; ?>";
    <?php    
    }    
}
?>


var casecat1 = new Array;  
var casecat2 = new Array;  
var casecat3 = new Array; 
<?php
if(isset($categorytest) && !empty($categorytest)){
    foreach($categorytest as $categorytestSin){?>
        casecat1[<?php echo $categorytestSin->lmcc_cc_id_l1; ?>] = "<?php echo $categorytestSin->lmcc_cc_desc_l1; ?>";
        casecat2[<?php echo $categorytestSin->lmcc_cc_id_l2; ?>] = "<?php echo $categorytestSin->lmcc_cc_desc_l2; ?>";
        casecat3[<?php echo $categorytestSin->lmcc_cc_id_l3; ?>] = "<?php echo $categorytestSin->lmcc_cc_desc_l3; ?>";
    <?php    
    }    
}
?>

window.onload = function() {
    select_first_initial()
}


function select_first_initial(){
    var firstCTV = document.getElementById('firstCT');
    firstCTV.options.length=0;
    firstCTV.options[0] = new Option('--Select--', '0');
    var i=1;
    firstCTLevel.map((val, key)=>{
        if(val != '' && key !=''){
            firstCTV.options[i++] = new Option((val), key);
        }   
    });  

    var secondCTV = document.getElementById("secondCT");
    var thirdCTV = document.getElementById("thirdCT"); 
    secondCTV.style.display = "none";
    thirdCTV.style.display = "none";
}

function court_type_1_select(){
    var firstCTV = document.getElementById('firstCT');
    var secondCTV = document.getElementById("secondCT");
    var thirdCTV = document.getElementById("thirdCT");   

    var firstCTVsv = firstCTV.options[firstCTV.selectedIndex].value;
    

    if(firstCTVsv == 0){
        secondCTV.style.display = "none";
        thirdCTV.style.display = "none";
        }else{
            secondCTV.style.display = "block";
            if(typeof thirdCTV.options[thirdCTV.selectedIndex] != undefined){
                thirdCTV.style.display = "none";
            }
    }

    secondCTV.options.length=0;
    secondCTV.options[0] = new Option('--Select--', '0');
    let i =1;
    secondCTLevel.map((val, key)=>{
        if (firstCTVsv == (key).toString().charAt(0)){
            if(val != '' && key !=''){
                secondCTV.options[i++] = new Option((val), key);
            }   
        }
    });
}

function court_type_2_select(){
    var firstCTV = document.getElementById('firstCT');
    var secondCTV = document.getElementById("secondCT");
    var thirdCTV = document.getElementById("thirdCT"); 

    var secondCTVsv = secondCTV.options[secondCTV.selectedIndex].value;

    if(secondCTVsv == 0){
        thirdCTV.style.display = "none";
    }
    
    let i=1;
    thirdCTLevel.map((val, key)=>{
        if (secondCTVsv.length != (key.toString()).length){
            if (secondCTVsv == (key).toString().substring(0, 4)){
                if(val != ' ' && key !=' '){
                    if(i==1){
                        thirdCTV.style.display = "block";
                        thirdCTV.options.length=0;
                        thirdCTV.options[0] = new Option('--Select--', '0');
                    }
                    thirdCTV.options[i++] = new Option((val), key);
                }   
            }
        }else{
            thirdCTV.style.display = "none";
        }
    });
}

</script>
    <div class="header-info text-center">
        <h4>LAWSUIT BASIC INFORMATION</h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicForm', 'id'=>'lms_basic_entry_form');
        echo form_open('lms/lms_basic_entry_mker_preview_view', $attributesForm);
    ?>
        <div class="row">
            <table class="table table-borderless" id="search_form_table_n">
                <tbody>
                <tr>
                    <td><div class="form-group"></div></td>
                    <td>
                        <input type="hidden" name="tranNoN" class="form-control" id="tranNo" value="<?php echo isset($lb_tran_no_generate)?$lb_tran_no_generate:''; ?>" readonly placeholder="Tracking Number">
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
                            <select class="courtT form-control"  id='firstCT' name='firstCTN' onChange="court_type_1_select()">
                            </select>
                            <div class="error" id="CTfirstListEID" tabindex="-1"></div>
                        </div>
                        <input type="hidden" value="" class="form-control" id="txtValue" name="courtTypeN" />
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <select class="courtT form-control"  id='secondCT' name='secondCTN' onChange="court_type_2_select()">
                            </select>
                            <div class="error" id="CTsecondListEID" tabindex="-1"></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <select class="courtT form-control"  id='thirdCT' name='thirdCTN'>
                            </select>
                            <div class="error" id="CTthirdListEID" tabindex="-1"></div>
                        </div>    
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <div class ="form-group unConDis ml-5">
                            <select class="courtT form-control"  id='district' name='districtN' onChange="thana_select(this.value)"></select>
                        </div>
                    </td>
                    <td>
                        <div class ="form-group unConTh ml-5">
                            <select class="courtT form-control"  id='thana' name='thanaN' onChange=""></select>
                        </div>
                    </td>
                </tr>
                    <!-- case category test start -->
                    <tr>
                        <td>
                            <div class="form-group ta-r">
                                <label for="caseCategory">Case Category</label>
                            </div>
                        </td>   
                        <td>
                            <div class="form-group ml-5">
                                <select class="courtT form-control"  id='firstCC' name='firstCCN' onChange="cc1_select()">
                                </select>
                                <div class="error" id="CC1EID" tabindex="-1"></div>
                            </div>
                            <input type="hidden" value="0" class="form-control" id="CCValue" name="caseCategoryN" />
                        </td>
                        <td>
                            <div class="form-group ml-5">
                                <select class="courtT form-control"  id='secondCC' name='secondCCN' onChange="cc2_select()">
                                </select>
                                <div class="error" id="CC2EID" tabindex="-1"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                    <td><div class="form-group ta-r"><label for="caseNo">Suit/Case Number</label></div></td>
                    <td>
                    <div class="form-group ml-5">
                        <input type="text" class="form-control" name="caseNoN" id="caseNo" placeholder="" autocomplete="off" required>
                        <div class="error" id="caseNoEID"></div>
                    </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                        <label for="scaseFileStatus">Suit/Case Filed By</label>
                        </div>
                        </td>
                        <td>
                        <div class="form-group ml-5">
                            <select name="caseFileStatusN" class="courtT caseFileStatusC" id="scaseFileStatus">
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
                                <option value="1" <?php echo isset($cFselect1)?$cFselect1:'';?>>Bank</option>        
                                <option value="2" <?php echo isset($cFselect2)?$cFselect2:'';?>>Customer/Others</option>        
                            </select>
                            <div class="error" id="scaseFileStatusEID" tabindex="-1"></div>
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
                        <input type="date" class="form-control" name="filingDateN" id="filingDate" placeholder="Filing Date">
                        <div class="error" id="filingDateEID" tabindex="-1"></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r unConLocC">
                            <label for="locationOfCourt">Loction of Court</label>
                        </div>        
                    </td>
                    <td>
                        <div class="form-group ml-5 unConLocC">
                            <select name="locationOfCourtN" class="choseSelect" id="locationOfCourt" onchange="location_of_court(this.value)">
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
                                <option value="<?php echo isset($lms_court_loc->dtcode)?$lms_court_loc->dtcode:''; ?>" <?php echo isset($select)?$select:''; ?> >
                                <?php echo isset($lms_court_loc->dtname)?$lms_court_loc->dtname:''; ?>
                                </option>
                            <?php } ?>      
                            </select>
                            <div class="error" id="locOfCourtEID" tabindex="-1"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group ta-r unConSen">
                            <label for="sensitivity">Sensitivity</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5 unConSen">
                            <select name="sensitivityN" class="courtT sensitivityC" id="sensitivity">
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
                                <option value="1" <?php echo isset($cSselect1)?$cSselect1:'';?>>High</option>        
                                <option value="2" <?php echo isset($cSselect2)?$cSselect2:'';?>>Low</option>        
                            </select>
                            </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="suitValueAmt">Suit/Case Value</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <input type="number" class="form-control" name="suitValueAmtN" id="suitValueAmt" placeholder=""  autocomplete="off">
                            <div class="error" id="suitValueAmtEID" tabindex="-1"></div>
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
                            <input type="number" class="form-control" name="recoAmtN" id="recoAmt" placeholder=""  autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="outstanding">Loan A/C Outstanding</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <input type="number" class="form-control" name="outstandingN" id="outstanding" placeholder=""  autocomplete="off">
                            <div class="error" id="outstandingEID" tabindex="-1"></div>
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
                            <input type="text" class="form-control" name="loanACNoN" id="loanACNo" placeholder=""  autocomplete="off">
                            <div class="error" id="loanACNoEID" tabindex="-1"></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="loanACName">Loan A/C Name</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <input type="text" class="form-control" name="loanACNameN" id="loanACName" placeholder=""  autocomplete="off">
                            <div class="error" id="loanACNameEID" tabindex="-1"></div>
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
                            <input type="text" class="form-control" name="bMobileNoN" id="bMobileNo" placeholder=""  autocomplete="off">
                            <div class="error" id="bMobileNoEID" tabindex="-1"></div>
                        </div>
                    </td>  
                    <td>
                        <div class="form-group ta-r">
                            <label for="bNID">A/C Holder NID</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <input type="text" class="form-control" name="bNIDN" id="bNID" placeholder=""  autocomplete="off">
                            <div class="error" id="bNIDEID" tabindex="-1"></div>
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
                            <textarea name="ACHolderAddN" class="form-control" id="ACHolderAdd" cols="28" rows="2"></textarea>
                            <div class="error" id="ACHolderAddEID" tabindex="-1"></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="trackingTranNo">Related Case No. (If)</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <input type="text" class="form-control" name="trackingTranNoN" id="trackingTranNo" onclick="doit_onkeypress(event)" placeholder=""  autocomplete="off">
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
                            <input type="number" class="form-control" name="unClassduewritN" id="unClassduewrit" placeholder=""  autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group unConBr ta-r">
                            <label for="unBrName"><span style="">Search Required Branch</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group unConBr ml-5">
                            <input type="text" class="form-control" name="unBrNameN" id="unBrName" onkeyup="fetch_br_ao_do_lms_b(this.value)" autocomplete="off" placeholder="Type Branch Name">
                            <div class="error" id="unBrNameEID" tabindex="-1"></div>
                        </div>
                    </td>
                </tr>
                <tr id="report_of_br_ao_do_div_msg"></tr>
                <tr>
                    <td>
                        <div class="form-group ta-r">
                            <label for="subjectIssue">Issue/Fact of Suit</label>
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
                            <input type="text" class="form-control" name="subjectIssueN" id="subjectIssue" placeholder="">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="plComPetName"><span  class="fontSize12" style="font-weight:700">Plaintiff/Complainant/Petitioner Name</span></label>
                        </div>
                    </td>        
                    <td>
                        <div class="form-group ml-5">
                            <input type="text" class="form-control" name="plComPetNameN" id="plComPetName" placeholder=""  autocomplete="off">
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
                            <input type="number" class="form-control" name="primarysecSanN" id="primarysecSan" placeholder=""  autocomplete="off">
                        </div>  
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="defAccResName"><span  class="fontSize12" style="font-weight:700">Defendant/Accused/Respondent Name</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                        <input type="text" class="form-control" name="defAccResNameN" id="defAccResName" placeholder=""  autocomplete="off">
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
                        <input type="number" class="form-control" name="primarysecSTN" id="primarysecST" placeholder=""  autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                            <label for="primarysecP"><span class="fontSize12" style="">Primary Security value(Present)</span></label>
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ml-5">
                        <input type="number" class="form-control" name="primarysecPN" id="primarysecP" placeholder=""  autocomplete="off">
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
                        <input type="number" class="form-control" name="collSecSanN" id="collSecSan" placeholder=""  autocomplete="off">
                        </div>
                    </td> 
                    <td>
                        <div class="form-group ta-r">
                            <label for="collSecST"><span class="fontSize12" style="">Collateral Security value(Suit Time)</span></label>
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ml-5">
                        <input type="number" class="form-control" name="collSecSTN" id="collSecST" placeholder=""  autocomplete="off">
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
                        <input type="number" class="form-control" name="collSecPN" id="collSecP" placeholder=""  autocomplete="off">
                        </div>
                    </td>      
                    <td>
                        <div class="form-group ta-r">
                            <label for="fileMaintOffBID"><span class="fontSize12" style="">Manager/Dealing Officer Bank ID</span></label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                        <input type="text" class="form-control" name="fileMaintOffBIDN" id="fileMaintOffBID" placeholder="">
                        <div class="error" id="fileMaintOffBIDEID" tabindex="-1"></div>
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
                            <textarea name="descCollSecN" class="form-control" id="descCollSec" cols="28" rows="3"></textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form-group ta-r">
                                <label for="remarks">Remarks</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group ml-5">
                            <textarea name="remarksN" class="form-control" id="remarks" cols="28" rows="3"></textarea>
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
                                <select name="lawyerInfoNW" class="lawyerInfoN" id="lawyerInfoA" onchange="get_lawyer_value(this)"></select>          
                            </div>    
                        </td>                
                    </tr>
                    <tr>
                        <td></td>       
                        <td colspan="2">
                            <div id="addHere"></div>
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
                    <td><input type="button" class="btnSave" value="Next" <?php echo $attribute; ?> style="" onclick="check_lms_basic_form(this.value)" ></td>
                    <td><button type="reset" class="btnSave" <?php echo $attribute; ?>>Clear</button></td>
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

<div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tracking Number List</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                <div class="modal-body-br-area">
                    <h2>Branch Search Area</h2>
                        <table>
                            <tr>
                                <td>
                                    <div class="form-group unConBr ta-r">
                                        <label for="unBrName"><span  class="" style="">Search Required Branch</span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group unConBr ml-5">
                                        <input type="text" class="form-control" name="unBrNameN" id="unBrName" onkeyup="fetch_br_ao_do_lms_btracking(this.value)" autocomplete="off" placeholder="Type Branch Name">
                                        <div class="error" id="unBrNameEID" tabindex="-1"></div>
                                    </div>
                                </td>
                            </tr>
                            </tr>
                            <tr id="report_of_br_ao_do_div_msg_t"></tr>
                        </table>
                        
                    <hr>
                </div>
                <table border="1" id="tblMain" style="cursor: pointer;" id="mydata">
                    <tr id="search_tracking_no_info"></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>