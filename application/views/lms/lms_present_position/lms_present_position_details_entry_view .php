<script>
// async function getCasePP(){
//     try{
//        const result = await fetch('<?php echo base_url(); ?>index.php/lms/lms_case_pp_view_apiindex.php');
//         const datac = await result.json();
//         return datac;
//     }
//     catch(error){
//         console.log(error);
//     }    
// }
// getCasePP().then(datac =>{
//     for (let value of Object.values(datac)) {
//         firstPP[value.lmpp_pp_id_l1] = value.lmpp_pp_desc_l1;
//         secondPP[value.lmpp_pp_id_l2] = value.lmpp_pp_desc_l2;
//     }
// });
var firstPP = new Array;  
var secondPP = new Array; 

<?php
if(isset($lmscasepps) && !empty($lmscasepps)){
    foreach($lmscasepps as $casepp){?>
        firstPP[<?php echo $casepp->lmpp_pp_id_l1; ?>] = "<?php echo $casepp->lmpp_pp_desc_l1; ?>";
        secondPP[<?php echo $casepp->lmpp_pp_id_l2; ?>] = "<?php echo $casepp->lmpp_pp_desc_l2; ?>";
    <?php    
    }    
}
?>

window.onload = function() {
    select_first_initial();
    document.getElementById('secondListcasePP').style.display = "none";
}

function select_first_initial(){
    var list1 = document.getElementById('firstListcasePP');
    list1.options.length=0;
    list1.options[0] = new Option('--Select--', '0');
    var i=1;
    firstPP.map((val, key)=>{
        if(val != '' && key !=''){
            list1.options[i++] = new Option((val), key);
        }   
    });  
}

function first_casepp_select(){
    var list1 = document.getElementById('firstListcasePP');
    var list2 = document.getElementById("secondListcasePP");
    var list1SelectedValue = list1.options[list1.selectedIndex].value;
    if(list1SelectedValue == 0){
        list2.style.display = "none";
    }else{
        list2.style.display = "block";
    }
        list2.options.length=0;
        list2.options[0] = new Option('--Select--', '0');
    var i =1;
    secondPP.map((val, key)=>{
        if (list1SelectedValue == (key).toString().substr(0, 2)){
            if(val != '' && key !=''){
                list2.options[i++] = new Option((val), key);
            }   
        }
    });          
}

</script>
<div class="container">
<?php
$attribute = '';
?>
    <div class="header-info text-center">
       <h4>Present Position Details </h4>
    </div>
    <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicppdetailsForm', 'id'=>'lms_basic_search_pp_info_form');
        echo form_open_multipart('lms/lms_pp_details_save', $attributesForm);
    ?>
    <?php if(isset($lmsppDatas) && !empty($lmsppDatas)) { ?>
    <table class="">
        <input type="hidden" name="brCodeppN" value="<?php echo isset($lmsppDatas[0]->br_code)?$lmsppDatas[0]->br_code:''; ?>" id="">
        <tr>
            <td><div class="form-group ta-r"><label for="tracNo">Tracking No.</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="tracNoPPN" value="<?php echo isset($lmsppDatas[0]->tran_no)?$lmsppDatas[0]->tran_no:''; ?>" class="" id="" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="caseNoPP">Case Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="caseNoPPN" value="<?php echo isset($lmsppDatas[0]->case_no)?$lmsppDatas[0]->case_no:''; ?>" class="" id="caseNoPP" readonly />
            </div>
            </td>
            <td><div class="form-group ta-r"><label for="loanacNopp">Loan A/C Number</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="loanacNoppN" value="<?php echo isset($lmsppDatas[0]->loan_ac_no)?$lmsppDatas[0]->loan_ac_no:''; ?>" class="" id="loanacNopp" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r"><label for="firstListcasePP">Case Title</label></div>
            </td>
            <td>
                <div class="form-group ml-5">
                <select class="courtT form-control"  id='firstListcasePP' name='firstListcasePPN' onChange="first_casepp_select()">
                </select>
                <div class="error" id="casePPfirstListEID" tabindex="-1"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="acNamePP">A/C Name</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control dim" name="acNamePPN" value="<?php echo isset($lmsppDatas[0]->loan_ac_name)?$lmsppDatas[0]->loan_ac_name:''; ?>" class="" id="acNamePP" style="width:100%" readonly />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="dateOfPPP">Date of Present Position</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="date" class="form-control" name="dateOfPPPN" value="" id="dateOfPPP" />
                <div class="error" id="ppfilingDateEID" tabindex="-1"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group ta-r">
                    <label for="presPPP">Present Position Status</label>
                </div>
            </td>
            <td>
                <div class="form-group ml-5">   
                    <select class="courtT form-control"  id='secondListcasePP' name='secondListcasePPN'></select>
                    <div class="error" id="casePPsecondListEID" tabindex="-1"></div>
                </div>
            </td>
        </tr>
        
        <tr>
            <td><div class="form-group ta-r"><label for="folowupPP">Follow-up Date</label></div></td>
            <td>
            <div class="form-group ml-5">
                <input type="date" class="form-control" name="folowupPPN" value="" class="" id="folowupPP" />
            </div>
            </td>
        </tr>
        <tr>
            <td><div class="form-group ta-r"><label for="remarksPP">Remarks</label></div></td>
            <td colspan="3">
            <div class="form-group ml-5">
                <input type="text" class="form-control" name="remarksPPN" value="" class="" id="remarksPP" style="width:100%" />
            </div>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <div class="form-group  ml-5 mt-20">
                <input type="button" class="btn btnSave" value="Save" <?php echo $attribute; ?>  onclick="check_lms_pp_details(this.value)"/>            
        
                <input type="reset" class="btn btnSave" value="Reset" <?php echo $attribute; ?>/>            
            </div>
        </td>             
        </tr>
    </table>
    <?php } else {?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php }?>
    <?php echo form_close(); ?> 
    
</div>
<?php if(isset($lmsppDatashas) && !empty($lmsppDatashas)){?>
    <div class="previous-content-area">
        <h4>Previous Information of Present Position</h4>
        <table border="1">
            <tr>
                <th>Tracking No.</th>
                <th>Case No</th>
                <th>Date of Position <br><span>(dd/mm/yyyy)</span></th>
                <th>Case Position Status</th>
                <th>Case/Suit Follow-up Date <br><span>(dd/mm/yyyy)</span></th>
                <th>Remarks</th>
            </tr>
            <?php foreach($lmsppDatashas as $hasVal) {?>
            <tr>
                <td><?php echo isset($hasVal->lbpp_tran_no)?$hasVal->lbpp_tran_no:''; ?></td>
                <td><?php echo isset($hasVal->lbpp_case_no)?$hasVal->lbpp_case_no:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lbpp_date_of_position)?$hasVal->lbpp_date_of_position:'')); ?>
                </td>
                <td><?php echo isset($hasVal->lbpp_present_position)?$hasVal->lmpp_pp_desc_l2:''; ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime(isset($hasVal->lbpp_followup_date)?$hasVal->lbpp_followup_date:'')); ?>
                </td>
                <td><?php echo isset($hasVal->lbpp_remarks)?$hasVal->lbpp_remarks:''; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
<?php } ?>