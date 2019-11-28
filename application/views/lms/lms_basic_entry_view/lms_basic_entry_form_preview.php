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
var dist_id = new Array;

var thana_id_dt = new Array;
var thana_name = new Array;
<?php
if(isset($lms_thana) && !empty($lms_thana)){
    foreach($lms_thana as $lms_th){ ?>
    dist_id[<?php echo (int)$lms_th->dtcode; ?>] = "<?php echo $lms_th->dtname; ?>"; 
    thana_name[<?php echo (int)$lms_th->thcode; ?>] = "<?php echo (int)$lms_th->dtcode."#".$lms_th->thname; ?>"; 
    <?php   
    }
}
?>


function district_initial(){
    var districtV = document.getElementById("district");
        
    districtV.options.length=0;
    districtV.options[0] = new Option('--Select--', '0');
    let i =1;

    dist_id.map((val, key)=>{
        if(val != '' && key !=''){
            districtV.options[i++] = new Option((val), key);
        }  
    });
}

function thana_select(str=''){
    var districtV = document.getElementById("district");
    var distV = districtV.options[districtV.selectedIndex].value;    
    var secondListV = document.getElementById("secondList");
    var secondV = secondListV.options[secondListV.selectedIndex].value;
    let unConThV = document.getElementsByClassName('unConTh')[0];

if(secondV == "52"){
    unConThV.style.display= "block";
}else{
    unConThV.style.display= "none";
}
    var thanaV = document.getElementById("thana");
    thanaV.options.length=0;
    thanaV.options[0] = new Option('--Select Upazilla--', '0');
    let j =1;
    thana_name.map((val, key)=>{
        if(val != '' && key !=''){
            var array = val.split("#");
            if(array[0] == distV){
                var arrayT = val.split("#");
                thanaV.options[j++] = new Option((arrayT[1]), key);
            }
            
        }  
    });
}
var lm_id = new Array;
var lm_name = new Array;
var lm_ctloc = new Array;
<?php
if(isset($lms_lawer_infos) && !empty($lms_lawer_infos)){
    foreach($lms_lawer_infos as $lms_lawer_info){?>
        lm_id[<?php echo $lms_lawer_info->lml_lawer_id; ?>] = "<?php echo $lms_lawer_info->lml_lawer_name; ?>";
        lm_ctloc[<?php echo $lms_lawer_info->lml_lawer_id; ?>] = "<?php echo $lms_lawer_info->lml_court_loc.$lms_lawer_info->lml_lawer_name. " ( " . $lms_lawer_info->lml_lawer_advPosition. " )"; ?>";
    <?php    
    }    
}
?>

function lawyer_select_court(){
    var firstListV = document.getElementById("firstList");
    var lawyerInfoWV = document.getElementById("lawyerInfoA");
    var courtList = firstListV.options[firstListV.selectedIndex].value;
    
    lawyerInfoWV.options.length=0;
    lawyerInfoWV.options[0] = new Option('--Select--', '0');
    let i =1;
    
    lm_ctloc.map((val, key)=>{
            if (courtList == (val).toString().charAt(0)){
                if(val != '' && key !=''){
                    let val1 = val.substr(1, val.length)
                    lawyerInfoWV.options[i++] = new Option((val1), key);
                }  
        }
    });
}

function location_of_court(str=''){
    var lawyerInfoWV = document.getElementById("lawyerInfoA");
    var firstListV = document.getElementById("firstList");
    var courtList = firstListV.options[firstListV.selectedIndex].value;
    
    
    lawyerInfoWV.options.length=0;
    lawyerInfoWV.options[0] = new Option('--Select--', '0');
    let i =1;
    if(courtList == "1"){
        lawyer_select_court();
    }else{
        if(str == "0015"){
            lawyerInfoWV.options.length=0;
            lawyerInfoWV.options[0] = new Option('--Select--', '0');
            let i =1;
            lm_ctloc.map((val, key)=>{
            if ("1" == (val).toString().charAt(0)){
                if(val != '' && key !=''){
                    let val1 = val.substr(1, val.length);
                    lawyerInfoWV.options[i++] = new Option((val1), key);
                }  
            }
            });
       }else{
            lawyerInfoWV.options.length=0;
            lawyerInfoWV.options[0] = new Option('--Select--', '0');
            let i =1;
            lm_ctloc.map((val, key)=>{
            if (str == (val).toString().substr(0, 4)){
                 if(val != '' && key !=''){
                     let val1 = val.substr(4, val.length);
                     lawyerInfoWV.options[i++] = new Option((val1), key);
                 }  
                }
            });
        }
    }
}

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

var firstCC = new Array;  
var secondCC = new Array;  
var thirdCC = new Array; 
<?php
if(isset($lmscasecategories) && !empty($lmscasecategories)){
    foreach($lmscasecategories as $casecategories){?>
        firstCC[<?php echo $casecategories->lmcc_cc_id_l1; ?>] = "<?php echo $casecategories->lmcc_cc_desc_l1; ?>";
        secondCC[<?php echo $casecategories->lmcc_cc_id_l2; ?>] = "<?php echo $casecategories->lmcc_cc_desc_l2; ?>";
        thirdCC[<?php echo $casecategories->lmcc_cc_id_l3; ?>] = "<?php echo $casecategories->lmcc_cc_desc_l3; ?>";
    <?php    
    }    
}
?>
var firstLevel = new Array;  
var secondLevel = new Array;  
var thirdLevel = new Array;   

<?php
if(isset($lmscourts) && !empty($lmscourts)){
    foreach($lmscourts as $court){?>
        firstLevel[<?php echo $court->lmct_ct_id_l1; ?>] = "<?php echo $court->lmct_ct_desc_l1; ?>";
        secondLevel[<?php echo $court->lmct_ct_id_l2; ?>] = "<?php echo $court->lmct_ct_desc_l2; ?>";
        thirdLevel[<?php echo $court->lmct_ct_id_l3; ?>] = "<?php echo $court->lmct_ct_desc_l3; ?>";
    <?php    
    }    
}
?>

console.log(firstLevel);

window.onload = function() {
    district_initial();
    select_first_initial();

    document.getElementById('secondList').style.display = "none";
    document.getElementById('thirdList').style.display = "none";
    document.getElementById('CC2ID').style.display = "none";
    
    let elm = document.getElementsByClassName('unCon')[0];
    let elm1 = document.getElementsByClassName('unCon')[1];
    elm.style.display= "none";
    elm1.style.display= "none";

    let unConBrF = document.getElementsByClassName('unConBr')[0];
    let unConBrS = document.getElementsByClassName('unConBr')[1];
    unConBrF.style.display= "none";
    unConBrS.style.display= "none";

    let unConDisV = document.getElementsByClassName('unConDis')[0];
    unConDisV.style.display= "none";
    let unConThV = document.getElementsByClassName('unConTh')[0];
    unConThV.style.display= "none";
}

function court_type_1_select(){
    court_type_1();

    lawyer_select_court()
}
function court_type_2_select(){
    court_type_2();
}
function court_type_3(){
    document.getElementById("txtValue").value = document.getElementById("thirdList").value;
}

function third_cc_select(){
    document.getElementById("txtCCValue").value = document.getElementById("thirdCCID").value;
}

function second_cc_select(){
    var ccSecondSelect = document.getElementById("secondCCID");
    var ccThirdSelect = document.getElementById("thirdCCID");   
    var listSelectedValue = ccSecondSelect.options[ccSecondSelect.selectedIndex].value;

    ccThirdSelect.options.length=0;
    ccThirdSelect.options[0] = new Option('--Select--', '0');
    let i =1;
    thirdCC.map((val, key)=>{
        if (listSelectedValue == "124" || listSelectedValue == "125" || listSelectedValue == "126" || listSelectedValue == "127"){
            if (listSelectedValue == (key).toString().substr(0, 3)){
                if(val != '' && key !=''){
                    ccThirdSelect.options[i++] = new Option((val), key);
                }   
            }
        }
    });    
    document.getElementById("txtCCValue").value = ccSecondSelect.value;   
}

function first_cc_select(){
    var ccFirstSelect = document.getElementById('firstCCID');
    var ccSecondSelect = document.getElementById("secondCCID");
    var ccThirdSelect = document.getElementById("thirdCCID");   
    var ccFirstSelectedValue = ccFirstSelect.options[ccFirstSelect.selectedIndex].value;

    ccSecondSelect.options.length=0;
    ccSecondSelect.options[0] = new Option('--Select--', '0');
    var i =1;
    secondCC.map((val, key)=>{
        if (ccFirstSelectedValue == (key).toString().charAt(0)){
            if(val != '' && key !=''){
                ccSecondSelect.options[i++] = new Option((val), key);
            }   
        }
    });    
    ccThirdSelect.options.length=0;
    ccThirdSelect.options[0] = new Option('--Select--', '0');     
}
function select_first_cc_initial(){
    var ccFirstSelect = document.getElementById('firstCCID');
    ccFirstSelect.options.length=0;
    ccFirstSelect.options[0] = new Option('--Select--', '0');
    var i=1;
    firstCC.map((val, key)=>{
        if(val != '' && key !=''){
            ccFirstSelect.options[i++] = new Option((val), key);
        }   
    });  
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

function court_type_2(){
    var cc1V = document.getElementById("CC1ID");
    var cc2V = document.getElementById("CC2ID");

    var list2 = document.getElementById("secondList");
    var list3 = document.getElementById("thirdList");   
    var list1SelectedValue2 = list2.options[list2.selectedIndex].value;
    
    let unConDisV = document.getElementsByClassName('unConDis')[0];
    let unConThV = document.getElementsByClassName('unConTh')[0];
    
    list3.options.length=0;
    list3.options[0] = new Option('--Select--', '0');
    var i=1;
    if(list1SelectedValue2 =="31" || list1SelectedValue2 == "32"){    
        if(list1SelectedValue2 == 0){
            list3.style.display = "none";
        }else{
            list3.style.display = "block";
        }
        thirdLevel.map((val, key)=>{
            if (list1SelectedValue2 == (key).toString().substring(0, 2)){
                if(val != '' && key !=''){
                    list3.options[i++] = new Option((val), key);
                }   
            }
        });  
    }else{
        list3.style.display = "none";
    }

    var j=1;
    if(list1SelectedValue2 =="11" || list1SelectedValue2 == "12"){    
        cc1V.options.length=0;
        cc1V.options[0] = new Option('--Select--', '0');

        cc2V.options.length=0;
        cc2V.options[0] = new Option('--Select--', '0');
        
        if(list1SelectedValue2 == 0){
            cc1V.style.display = "none";
        }else{
            cc1V.style.display = "block";
        }
        casecat2.map((val, key)=>{
            if (list1SelectedValue2.substr(1, 1) == (key).toString().charAt(0)){
                if(val != '' && key !=''){
                    cc1V.options[i++] = new Option((val), key);
                }   
            }
        });  
    }

    if(list1SelectedValue2 =="51" || list1SelectedValue2 == "52"){    
        unConDisV.style.display = "block";
    }else{
        unConDisV.style.display = "none";
        unConThV.style.display = "none";
    }
    if(list1SelectedValue2 =="0"){   
        cc1V.options.length=0;
        cc1V.options[0] = new Option('--Select--', '0');

        cc2V.options.length=0;
        cc2V.options[0] = new Option('--Select--', '0');
    }
    document.getElementById("txtValue").value = list2.value;
}

function court_type_1(){
    var list1 = document.getElementById('firstList');
    var list2 = document.getElementById("secondList");
    var list3 = document.getElementById("thirdList");   

    var cc1V = document.getElementById("CC1ID");
    var cc2V = document.getElementById("CC2ID");    

    var list1SelectedValue = list1.options[list1.selectedIndex].value;

    if(list1SelectedValue == 0){
        list2.style.display = "none";
        list3.style.display = "none";

    }else{
        list2.style.display = "block";
    }

    let unConBrF = document.getElementsByClassName('unConBr')[0];
    let unConBrS = document.getElementsByClassName('unConBr')[1];
    
    if(list1SelectedValue == "1"){
        unConBrF.style.display= "block";
        unConBrS.style.display= "block";
        var element = document.getElementById("report_of_br_ao_do_div_msg_s");
        if(typeof(element) != 'undefined' && element != null){
            document.getElementById('report_of_br_ao_do_div_msg_s').style.display = "block";
        }
    }else{
        unConBrF.style.display= "none";
        unConBrS.style.display= "none";
        var element = document.getElementById("report_of_br_ao_do_div_msg_s");
        if(typeof(element) != 'undefined' && element != null){
            document.getElementById('report_of_br_ao_do_div_msg_s').style.display = "none";
        }
        
    }

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
    
    var seletedList = (parseInt(list1SelectedValue)+1);

    if(list1SelectedValue == 2 || list1SelectedValue == 3 || list1SelectedValue == 5){
        
        cc1V.style.display = "block";
        cc1V.options.length=0;
        cc1V.options[0] = new Option('--Select--', '0');

        cc2V.options.length=0;
        cc2V.options[0] = new Option('--Select--', '0');

        var i =1;
        casecat2.map((val, key)=>{
            if (seletedList.toString() == (key).toString().charAt(0)){
                if(val != '' && key !=''){
                    cc1V.options[i++] = new Option((val), key);
                }   
            }
        });  
        if(list1SelectedValue == 5){
            document.getElementById("CC2ID").style.display = "none";
            var i =1;
            casecat2.map((val, key)=>{
                if (list1SelectedValue.toString() == (key).toString().charAt(0)){
                    if(val != '' && key !=''){
                        cc1V.options[i++] = new Option((val), key);
                    }   
                }
            });
        }

    }else{
        cc1V.options.length=0;
        cc1V.options[0] = new Option('--Select--', '0');   

        cc2V.options.length=0;
        cc2V.options[0] = new Option('--Select--', '0');  
    }

    let unConLawL = document.getElementsByClassName('unConLaw')[0];
    let unConLawN = document.getElementsByClassName('unConLaw')[1];

    let unConLocCL = document.getElementsByClassName('unConLocC')[0];
    let unConLocCN = document.getElementsByClassName('unConLocC')[1];

    let unConDisV = document.getElementsByClassName('unConDis')[0];
    let unConThV = document.getElementsByClassName('unConTh')[0];
    if(list1SelectedValue == 0 || list1SelectedValue == 1 || list1SelectedValue == 2 || list1SelectedValue == 3 || list1SelectedValue == 4){
        unConDisV.style.display = "none";
        unConThV.style.display = "none";
    }

    if(list1SelectedValue == 5){
        unConLawL.style.display = "none";
        unConLawN.style.display = "none";

        unConLocCL.style.display = "none";
        unConLocCN.style.display = "none";
    }else{
        unConLawL.style.display = "block";
        unConLawN.style.display = "block";

        unConLocCL.style.display = "block";
        unConLocCN.style.display = "block";
    }
}

function cc1_select(){
    var cc1V = document.getElementById("CC1ID");
    var cc2V = document.getElementById("CC2ID");
    var cc1VSelectedValue = cc1V.options[cc1V.selectedIndex].value;

    if (cc1VSelectedValue != '5101'){
        cc2V.options.length=0;
        cc2V.options[0] = new Option('--Select--', '0');
        var i =1;
        casecat3.map((val, key)=>{
        if ((cc1VSelectedValue) == (key).toString().substr(0, 2)){
            if(val != '' && key !=''){
                cc2V.options[i++] = new Option((val), key);
            }   
            }
        }); 
    }
    
    
    var subjectIssueV = document.getElementById("subjectIssue");
    var subjectFactChooseV = document.getElementById("subjectFactChoose");
    if(cc1VSelectedValue == "15"){
        subjectIssueV.style.display = "none";
        subjectFactChooseV.style.display = "block";
    }else{
        subjectIssueV.style.display = "block";
        subjectFactChooseV.style.display = "none";
    }
    document.getElementById("CCValue").value = cc1V.value;

    var CC2IDV = document.getElementById("CC2ID");
    if(cc1VSelectedValue == "0" || cc1VSelectedValue == "5101"){
        CC2IDV.style.display = "none";
    }else{
        CC2IDV.style.display = "block";
    }
    
    case_type_unclassified(cc1VSelectedValue);
}

function cc2_select(){
    document.getElementById("CCValue").value = document.getElementById("CC2ID").value;
}

function case_type_unclassified(case_type = ''){
    let elm = document.getElementsByClassName('unCon')[0];
    let elm1 = document.getElementsByClassName('unCon')[1];
    
    if(case_type == "15"){
        elm.style.display= "block";
        elm1.style.display= "block";
    }else{
        elm.style.display= "none";
        elm1.style.display= "none";
    }
}
</script>


    <div class="header-info text-center">
        <h4>LAWSUIT BASIC INFORMATION PREVIEW</h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicForm', 'id'=>'lms_basic_entry_form');
        echo form_open('lms/lms_basic_entry_preview_view', $attributesForm);
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
                            //echo $court_type;
                             //echo $court_type[1]; 
                             //echo "<pre>";
                             //print_r($lmscourts);
                            ?>
                            <?php 
                                // $court_l1 = '';
                                // $court_l2 = '';
                                // $fall_1= '';
                                // foreach($lmscourts as $court){ 
                                //     if(strval($court_type[0]) === strval($court->lmct_ct_id_l1)){
                                //         $court_l1 = $court->lmct_ct_desc_l1;
                                //         $fall_1 = strval($court->lmct_ct_id_l2);
                                //     }
                                
                                //     if(count($fall_1)>0){
                                //         if(strval($court_type[1]) === $fall_1[1]){
                                //             $court_l2 = $court->lmct_ct_desc_l2;
                                            
                                //         }
                                //     }
                                     
                                // } 

                                //$court_type = '51';
                                $court_type = strval($court_type);
                                $cV_1 = '';
                                $cV_2 = '';
                                $cV_3 = '';
                                //echo "<pre>";
                                //print_r($lms_thana);
                                $locationOfCourtN = '51#58';
                                //echo substr($locationOfCourtN, 6, 3);
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
                                        //if(substr($locationOfCourtN, 0, 2) == $court_type){
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
                                                //$cUpa = intval(substr($locationOfCourtN, 6, 3));
                                            }
                                        //}
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
                                
                                //echo $cV_1;
                                //echo $cV_2;
                                //echo $cV_3;
                                //echo $cDist;
                            ?>
                            <?php echo isset($cV_1)?$cV_1:''; ?>
                            <!-- <select class="courtT form-control"  id='firstList' name='CTfirstListN' onChange="court_type_1_select()"></select>
                            <div class="error" id="CTfirstListEID" tabindex="-1"></div> -->
                            
                        </div>
                        
                        <!-- <input type="hidden" value="" class="form-control" id="txtValue" name="courtTypeN" /> -->
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($cV_2)?$cV_2:''; ?>
                            <!-- <select class="courtT form-control"  id='secondList' name='CTsecondListN' onChange="court_type_2_select()"></select>
                            <div class="error" id="CTsecondListEID" tabindex="-1"></div> -->
                        </div>
                    </td>
                    <td>
                        <div class="form-group ml-5">
                            <?php echo isset($cV_3)?$cV_3:''; ?>
                            <!-- <select class="courtT form-control"  id='thirdList' name='CTthirdListN' onChange="court_type_3()"></select>
                            <div class="error" id="CTthirdListEID" tabindex="-1"></div> -->
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
                                <!-- <select class="courtT form-control"  id='district' name='districtN' onChange="thana_select(this.value)"></select> -->
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
                                <!-- <select class="courtT form-control"  id='thana' name='thanaN' onChange=""></select> -->
                            </div>
                        </td>
                    </tr>
                    <!-- case category test start -->
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
                                <?php //echo $category_id; 
                                    echo isset($cCat1)?$cCat1:'';
                                ?>
                                <!-- <select class="courtT form-control"  id='CC1ID' name='CC1N' onChange="cc1_select()"></select>
                                <div class="error" id="CC1EID" tabindex="-1"></div> -->
                            </div>
                            <input type="hidden" value="0" class="form-control" id="CCValue" name="caseCategoryN" />
                        </td>
                        <td>
                            <div class="form-group ml-5">
                                    <?php echo isset($cCat2)?$cCat2:''; ?>
                                <!-- <select class="courtT form-control"  id='CC2ID' name='CC2N' onChange="cc2_select()"></select>
                                <div class="error" id="CC2EID" tabindex="-1"></div> -->
                            </div>
                        </td>
                    </tr>

                    <tr>
                    <td><div class="form-group ta-r"><label for="caseNo">Suit/Case Number</label></div></td>
                    <td>
                    <div class="form-group ml-5">
                        <?php echo isset($caseNoN)?$caseNoN:''; ?>
                        <!-- <input type="text" class="form-control" name="caseNoN" id="caseNo" placeholder="" autocomplete="off" required>
                        <div class="error" id="caseNoEID"></div> -->
                    </div>
                    </td>
                    <td>
                        <div class="form-group ta-r">
                        <label for="scaseFileStatus">Suit/Case Filed By</label>
                        </div>
                        </td>
                        <td>
                        <div class="form-group ml-5">
                            <?php //echo isset($caseFileStatusN)?$caseFileStatusN:''; ?>
                            <?php
                                
                                if(isset($caseFileStatusN) && $caseFileStatusN == 1)
                                {
                                    echo "Bank";
                                }
                                if(isset($caseFileStatusN) && $caseFileStatusN == 2){
                                    echo "Customer/Others";
                                }
                            ?>
                            <!-- <select name="caseFileStatusN" class="courtT caseFileStatusC" id="scaseFileStatus">
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
                            <div class="error" id="scaseFileStatusEID" tabindex="-1"></div> -->
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
                            <!-- <input type="date" class="form-control" name="filingDateN" id="filingDate" placeholder="Filing Date">
                            <div class="error" id="filingDateEID" tabindex="-1"></div> -->
                        </div>
                    </td>
                    <?php if($court_type[0] !== strval(5)) {?>
                    <td>
                        <div class="form-group ta-r unConLocC">
                            <label for="locationOfCourt">Loction of Court</label>
                        </div>        
                    </td>
                    <td>
                        <div class="form-group ml-5 unConLocC">
                            <?php //echo isset($locationOfCourtN)?$locationOfCourtN:''; ?>
                            <!-- <select name="locationOfCourtN" class="choseSelect" id="locationOfCourt" onchange="location_of_court(this.value)">
                            </select>
                            <div class="error" id="locOfCourtEID" tabindex="-1"></div> -->
                            <?php 
                                foreach($lms_court_locs as $lms_court_loc)
                                { 
                                    if($locationOfCourtN == $lms_court_loc->dtcode){
                                        echo isset($lms_court_loc->dtname)?$lms_court_loc->dtname:'';
                                    }    
                                ?>
                            <?php } ?>       
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
                            <?php //echo isset($sensitivityN)?$sensitivityN:''; ?>
                            <?php
                                
                                if(isset($sensitivityN) && $sensitivityN == 1)
                                {
                                    echo "High";
                                }
                                if(isset($sensitivityN) && $sensitivityN == 2){
                                    echo "Low";
                                }
                            ?>
                            <!-- <select name="sensitivityN" class="courtT sensitivityC" id="sensitivity">
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
                            </select> -->
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
                            <!-- <input type="number" class="form-control" name="suitValueAmtN" id="suitValueAmt" placeholder=""  autocomplete="off">
                            <div class="error" id="suitValueAmtEID" tabindex="-1"></div> -->
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
                            <!-- <input type="number" class="form-control" name="recoAmtN" id="recoAmt" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="outstandingN" id="outstanding" placeholder=""  autocomplete="off">
                            <div class="error" id="outstandingEID" tabindex="-1"></div> -->
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
                            <!-- <input type="text" class="form-control" name="loanACNoN" id="loanACNo" placeholder=""  autocomplete="off">
                            <div class="error" id="loanACNoEID" tabindex="-1"></div> -->
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
                            <!-- <input type="text" class="form-control" name="loanACNameN" id="loanACName" placeholder=""  autocomplete="off">
                            <div class="error" id="loanACNameEID" tabindex="-1"></div> -->
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
                            <!-- <input type="text" class="form-control" name="bMobileNoN" id="bMobileNo" placeholder=""  autocomplete="off">
                            <div class="error" id="bMobileNoEID" tabindex="-1"></div> -->
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
                            <!-- <input type="text" class="form-control" name="bNIDN" id="bNID" placeholder=""  autocomplete="off">
                            <div class="error" id="bNIDEID" tabindex="-1"></div> -->
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
                            <!-- <textarea name="ACHolderAddN" class="form-control" id="ACHolderAdd" cols="28" rows="2"></textarea>
                            <div class="error" id="ACHolderAddEID" tabindex="-1"></div> -->
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
                            <!-- <input type="text" class="form-control" name="trackingTranNoN" id="trackingTranNo" onclick="doit_onkeypress(event)" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="unClassduewritN" id="unClassduewrit" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="text" class="form-control" name="unBrNameN" id="unBrName" onkeyup="fetch_br_ao_do_lms_b(this.value)" autocomplete="off" placeholder="Type Branch Name">
                            <div class="error" id="unBrNameEID" tabindex="-1"></div> -->
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
                            <!-- <input type="text" class="form-control" name="subjectIssueN" id="subjectIssue" placeholder=""> -->
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
                            <!-- <input type="text" class="form-control" name="plComPetNameN" id="plComPetName" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="primarysecSanN" id="primarysecSan" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="text" class="form-control" name="defAccResNameN" id="defAccResName" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="primarysecSTN" id="primarysecST" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="primarysecPN" id="primarysecP" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="collSecSanN" id="collSecSan" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="collSecSTN" id="collSecST" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="number" class="form-control" name="collSecPN" id="collSecP" placeholder=""  autocomplete="off"> -->
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
                            <!-- <input type="text" class="form-control" name="fileMaintOffBIDN" id="fileMaintOffBID" placeholder="">
                            <div class="error" id="fileMaintOffBIDEID" tabindex="-1"></div> -->
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
                                <!-- <textarea name="descCollSecN" class="form-control" id="descCollSec" cols="28" rows="3"></textarea> -->
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
                                <!-- <textarea name="remarksN" class="form-control" id="remarks" cols="28" rows="3"></textarea> -->
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
                                <?php //echo isset($lawerDb)?$lawerDb:''; 
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
                                <!-- <select name="lawyerInfoNW" class="lawyerInfoN" id="lawyerInfoA" onchange="get_lawyer_value(this)"></select>           -->
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
                    <td><button type="button" class="btnSave" <?php echo $attribute; ?>>Previous</button></td>
                    <td>
                        <input type="button" class="btnSave" value="Save" <?php echo $attribute; ?> style="" onclick="check_lms_basic_form(this.value)" >
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