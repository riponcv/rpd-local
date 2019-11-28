function doit_onkeypress(val){
    $("#myModal").modal('show');
}

function showRow(row){
    var x=row.cells;
    var mol = parseFloat(x[5].innerHTML);
    document.getElementById("trackingTranNo").value = x[1].innerHTML;
    document.getElementById("outstanding").value = parseFloat(x[5].innerHTML);
    document.getElementById("loanACNo").value = (x[6].innerHTML);
    document.getElementById("loanACName").value = (x[7].innerHTML);
    document.getElementById("ACHolderAdd").value = (x[8].innerHTML);
    document.getElementById("primarySecurity").value = (x[9].innerHTML);
    document.getElementById("collSecuSanction").value = (x[10].innerHTML);
    document.getElementById("collSecTimeSuit").value = (x[11].innerHTML);
    document.getElementById("descCollSec").value = (x[12].innerHTML);

    $('#myModal').modal('hide');
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    $('#mydata').dataTable();
    $("#data_tbl").dataTable();
  });
  
$(".choseSelect").chosen();

$(window).scroll(function(){
    if ($(window).scrollTop() >= 300) {
        $('.pos-fixed').addClass('fixed-header');
        $('.pos-fixed').addClass('visible-title');
    }
    else {
        $('.pos-fixed').removeClass('fixed-header');
        $('.pos-fixed').removeClass('visible-title');
    }
});

var myElements = document.querySelectorAll(".chosen-container"); 
for (var i = 0; i < myElements.length; i++) {
	myElements[i].style.width = "250px";
}
function get_lawyer_value(e){
    var value = e.options[e.selectedIndex].value;
    var txtValue = e.options[e.selectedIndex].text;

    if(0 != value){
        var addDiv = document.createElement('div');
        addDiv.className = 'row lawyerborder';
        addDiv.innerHTML =
        '<input type="hidden" name="lawyerInfoN[]" value="'+value+'" />\
        <label>'+value+'</label>\
        <label> '+txtValue+' </label>\
        <input type="button" value="remove" onclick="removeRow(this)">';
        document.getElementById('addHere').appendChild(addDiv);
    }
}
function removeRow(input) {
    document.getElementById('addHere').removeChild(input.parentNode);
}

function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
   
}


function validateTextSelect(fieldV, flagV=0, txtID='', errID='', validateType='', isDigit=0 ){
    var fieldV = fieldV;
    var flagV= flagV;
    var txtID = txtID;
    var errID = errID;
    var seleMsg = validateType;
    var digitChk = isDigit;
    
    if(flagV==0){
        if(fieldV == "") {
            printError(errID, `Please enter ${seleMsg}`);
            document.getElementById(txtID).focus() ;
            return true;
        } else {
            if(digitChk==1){
                if(!isNaN(fieldV)){
                    document.getElementById(txtID).style.backgroundColor = "white";
                    document.getElementById(txtID).style.color = "black";
                    printError(errID, "");
                    return false;
                }else{
                    document.getElementById(txtID).style.backgroundColor = "red";
                    document.getElementById(txtID).style.color = "white";
                    printError(errID, "Please enter valid digit");
                    return true;
                }
            }else{
                document.getElementById(txtID).style.backgroundColor = "white";
                document.getElementById(txtID).style.color = "black";
                printError(errID, "");
                return false;
            }
        }
    }else{
        
        if(flagV==1){
            if(fieldV == 0) {
                printError(errID, `Please select ${seleMsg}`);
                var div = document.getElementById(errID);
                div.focus();
                return true;
            } else {
                printError(errID, "");
                return false;
            }
        }
    }
}

function check_lms_basic_form(str)
{
    if(str !='')
    {
        var caseNoV = document.lmsBasicForm.caseNoN.value;
        
        //var caseTypeNV = document.lmsBasicForm.caseTypeN.value;
       // var caseCategoryNV = document.lmsBasicForm.caseCategoryN.value;
        var caseFileStatusNV = document.lmsBasicForm.caseFileStatusN.value;
        var filingDateNV = document.lmsBasicForm.filingDateN.value;
        var locOfCourtNV = document.lmsBasicForm.locationOfCourtN.value;
        //var locOfCourtNV = document.lmsBasicForm.locationOfCourtN.value;
        var claimAmountNV = document.lmsBasicForm.suitValueAmtN.value;
        var outstandingNV = document.lmsBasicForm.outstandingN.value;
        var loanACNameNV = document.lmsBasicForm.loanACNameN.value;
        var ACHolderAddNV = document.lmsBasicForm.ACHolderAddN.value;
        var fileMaintOffBIDNV = document.lmsBasicForm.fileMaintOffBIDN.value;
    
        var CTfirstListNV = document.lmsBasicForm.CTfirstListN.value;
        var CTsecondListNV = document.lmsBasicForm.CTsecondListN.value;
        var CTthirdListNV = document.lmsBasicForm.CTthirdListN.value;

        
        // var firstCCNV = document.lmsBasicForm.firstCCN.value;
        // var secondCCNV = document.lmsBasicForm.secondCCN.value;
        // var thirdCNV = document.lmsBasicForm.thirdCN.value;

        var caseNoNErr = caseFileStatusNErr = true;
        var fileMaintOffBIDNErr = ACHolderAddNErr = loanACNameNErr = outstandingNErr = filingDateNErr = locOfCourtNErr = claimAmountNErr = true;
        var CTFirstErr = CTSecondErr = CTThirdErr = false;
        var firstCCErr = secondCCNErr = thirdCNErr = false;
        var unBrNameNErr = Br_Ar_Do_Err = false;

        caseNoNErr = validateTextSelect(caseNoV, 0, "caseNo", "caseNoEID", "case no", 0);
        //caseTypeNErr = validateTextSelect(caseTypeNV, 1, "caseType", "caseTypeEID", "case type", 0);
        //caseCategoryNErr = validateTextSelect(caseCategoryNV, 1, "caseCategoryN", "caseCategoryEID", "case category", 0);
        caseFileStatusNErr = validateTextSelect(caseFileStatusNV, 1, "caseFileStatusN", "scaseFileStatusEID", "case file status ", 0);
        filingDateNErr = validateTextSelect(filingDateNV, 0, "filingDate", "filingDateEID", "Filing date", 0);
        locOfCourtNErr = validateTextSelect(locOfCourtNV, 1, "locationOfCourtN", "locOfCourtEID", "location of court", 0);
        claimAmountNErr = validateTextSelect(claimAmountNV, 0, "suitValueAmt", "suitValueAmtEID", "Suit Value amount", 1);
        outstandingNErr = validateTextSelect(outstandingNV, 0, "outstanding", "outstandingEID", "outstanding", 1);
        loanACNameNErr = validateTextSelect(loanACNameNV, 0, "loanACName", "loanACNameEID", "loan a/c name", 0);
        ACHolderAddNErr = validateTextSelect(ACHolderAddNV, 0, "ACHolderAdd", "ACHolderAddEID", "a/c holder address", 0);
        fileMaintOffBIDNErr = validateTextSelect(fileMaintOffBIDNV, 0, "fileMaintOffBID", "fileMaintOffBIDEID", "File Maintenance Officer BID", 0);

        
        if(CTfirstListNV !=0 || CTfirstListNV !=""){
            CTFirstErr = validateTextSelect(CTfirstListNV, 1, "CTfirstListN", "CTfirstListEID", "court type", 0);
        }
        if(CTsecondListNV !=0 || CTsecondListNV !=""){
            CTSecondErr = validateTextSelect(CTsecondListNV, 1, "CTsecondListN", "CTsecondListEID", "court type", 0);
        }
        if(CTfirstListNV !=0 && (CTsecondListNV =="31" ||CTsecondListNV =="32")){
            CTThirdErr = validateTextSelect(CTthirdListNV, 1, "CTthirdListN", "CTthirdListEID", "court type", 0);
        }
        if(CTfirstListNV == 1){
            var unBrNameNV = document.lmsBasicForm.unBrNameN.value;
            unBrNameNErr = validateTextSelect(unBrNameNV, 0, "unBrName", "unBrNameEID", "Branch Name Field", 0);
            if(unBrNameNV !=""){
                if(jQuery("input[name='report_report_office_id']:checked").val()>0){
                    Br_Ar_Do_Err = false;   
                }else{
                    Br_Ar_Do_Err = true;
                    alert("Please select Branch");
                }
            }
        }

        if(CTfirstListNV != 0 && CTfirstListNV == 5){
            locOfCourtNErr = false;
        }
                
        // if(firstCCNV !=0 || firstCCNV !=""){
        //     firstCCErr = validateTextSelect(firstCCNV, 1, "firstCCID", "firstCCEID", "Case Category", 0);
        // }
        // if(secondCCNV !=0 || secondCCNV !=""){
        //     secondCCNErr = validateTextSelect(secondCCNV, 1, "secondCCID", "secondCCEID", "Case Category", 0);
        // }
        // if(thirdCNV !=0 && (secondCCNV =="124" || secondCCNV =="125" || secondCCNV =="126" || secondCCNV =="127")){
        //     thirdCNErr = validateTextSelect(thirdCNV, 1, "thirdCCID", "thirdCCEID", "Case Category", 0);
        // }

        if((fileMaintOffBIDNErr||ACHolderAddNErr||loanACNameNErr||outstandingNErr||caseNoNErr || caseFileStatusNErr||filingDateNErr||locOfCourtNErr||claimAmountNErr ||
            CTFirstErr || CTSecondErr || CTThirdErr || unBrNameNErr || Br_Ar_Do_Err) == true) {
            return false;
         } else {
            document.lmsBasicForm.submit();
         }
    }
}


function check_lms_basic_mker_pvr_form(str){
    if(str !=''){
        document.getElementById("mkerPrvBtnID").value = str;
        let authMBIDV = document.lmsBasicMkerPrv.authMBID.value;
        if(str == 'Previous'){
            document.lmsBasicMkerPrv.submit();
        }else{
            if(authMBIDV ==''){
                alert("Please Fill Manager/Dealing Officer BID!");
            }else{
                document.lmsBasicMkerPrv.submit();
            }
        }
    }else{
        return false;
    }
}

function lms_basic_mker_auth_check(str){
    if(document.getElementById("authenBy").checked == true){
        let FMDID = document.lmsBasicMkerPrv.fileMaintOffBIDN.value;
        document.getElementById("authMBID").value = FMDID;
    }else{
        document.getElementById("authMBID").value = "";
    }
    
}

function check_lms_basic_form_previous_mker(str){
    if(str !=''){
        document.lmsBasicFormMkerPrv.submit();
    }else{
        return false;
    }
}

function check_lms_basic_checker_pvr_form(str){
    //alert(str);
    if(str !=''){
        if(document.getElementById("authenBy").checked == true){
            document.getElementById("ChkerprvBtnID").value = str;
            document.lmsBasicCheckerPrv.submit();
        }else{
            alert("Please Fill The Form Correctly");
            return false;
        }
    }else{
        return false;
    }
}

function lms_edit_all_info_view_search(btn_click)
{
    if(btn_click =='Search')
    {
        let tracNoSNV = document.lmsBasicEditForm.tracNoE.value;
        let caseNoSNV = document.lmsBasicEditForm.caseNoNS.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicEditForm.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
}	


function check_lms_basic_edit_form(str)
{
    if(str !='')
    {
        var caseNoV = document.lmsBasicEditForm.caseNoN.value;
        var courtTypeNV = document.lmsBasicEditForm.courtTypeN.value;
        var caseTypeNV = document.lmsBasicEditForm.caseTypeN.value;
        var caseCategoryNV = document.lmsBasicEditForm.caseCategoryN.value;
        var caseFileStatusNV = document.lmsBasicEditForm.caseFileStatusN.value;
        var filingDateNV = document.lmsBasicEditForm.filingDateN.value;
        var locOfCourtNV = document.lmsBasicEditForm.locationOfCourtN.value;
        var locOfCourtNV = document.lmsBasicEditForm.locationOfCourtN.value;
        var claimAmountNV = document.lmsBasicEditForm.claimAmountN.value;
        var outstandingNV = document.lmsBasicEditForm.outstandingN.value;
        var loanACNameNV = document.lmsBasicEditForm.loanACNameN.value;
        var ACHolderAddNV = document.lmsBasicEditForm.ACHolderAddN.value;
        var fileMaintOffBIDNV = document.lmsBasicEditForm.fileMaintOffBIDN.value;
        
        var caseNoNErr = courtTypeNErr = caseTypeNErr = caseCategoryNErr = caseFileStatusNErr = true;
        var fileMaintOffBIDNErr = ACHolderAddNErr = loanACNameNErr = outstandingNErr = filingDateNErr = locOfCourtNErr = claimAmountNErr = true;
        
        caseNoNErr = validateTextSelect(caseNoV, 0, "caseNo", "caseNoNID", "case no", 0);
        courtTypeNErr = validateTextSelect(courtTypeNV, 1, "courtTypeN", "courtTypeID", "court type", 0);
        caseTypeNErr = validateTextSelect(caseTypeNV, 1, "caseTypeN", "caseTypeID", "case type", 0);
        caseCategoryNErr = validateTextSelect(caseCategoryNV, 1, "caseCategoryN", "caseCategoryEID", "case category", 0);
        caseFileStatusNErr = validateTextSelect(caseFileStatusNV, 1, "caseFileStatusN", "scaseFileStatusEID", "case file status ", 0);
        filingDateNErr = validateTextSelect(filingDateNV, 0, "filingDate", "filingDateEID", "Filing date", 0);
        locOfCourtNErr = validateTextSelect(locOfCourtNV, 1, "locationOfCourtN", "locOfCourtEID", "location of court", 0);
        claimAmountNErr = validateTextSelect(claimAmountNV, 0, "claimAmount", "claimAmountEID", "claim amount", 1);
        outstandingNErr = validateTextSelect(outstandingNV, 0, "outstanding", "outstandingEID", "outstanding", 1);
        loanACNameNErr = validateTextSelect(loanACNameNV, 0, "loanACName", "loanACNameEID", "loan a/c name", 0);
        ACHolderAddNErr = validateTextSelect(ACHolderAddNV, 0, "ACHolderAdd", "ACHolderAddEID", "a/c holder address", 0);
        fileMaintOffBIDNErr = validateTextSelect(fileMaintOffBIDNV, 0, "fileMaintOffBID", "fileMaintOffBIDEID", "File Maintenance Officer BID", 0);

        if((fileMaintOffBIDNErr||ACHolderAddNErr||loanACNameNErr||outstandingNErr||caseNoNErr ||courtTypeNErr||caseTypeNErr ||caseCategoryNErr||caseFileStatusNErr||filingDateNErr||locOfCourtNErr||claimAmountNErr) == true) {
            return false;
         } else {
            document.lmsBasicEditForm.submit();
         }
    }
}

function check_lms_pp_details(str)
{
    if(str !='')
    {
        var ppFirstListV = document.lmsBasicppdetailsForm.firstListcasePPN.value;
        var ppSecondListV = document.lmsBasicppdetailsForm.secondListcasePPN.value;
        var ppfilingDateNV = document.lmsBasicppdetailsForm.dateOfPPPN.value;
        var ppFirstListErr = ppSecondListErr = filingDateNErr = true;
  
        ppFirstListErr = validateTextSelect(ppFirstListV, 1, "firstListcasePP", "casePPfirstListEID", "case no", 0);
        ppSecondListErr = validateTextSelect(ppSecondListV, 1, "secondListcasePP", "casePPsecondListEID", "court type", 0);
        filingDateNErr = validateTextSelect(ppfilingDateNV, 0, "dateOfPPP", "ppfilingDateEID", "present position date", 0);

        if((ppFirstListErr || ppSecondListErr || filingDateNErr) == true) {
            return false;
         } else {
            document.lmsBasicppdetailsForm.submit();
         }
    }
 }

function lms_pp_info_view_search(btn_click)
{
    if(btn_click =='Search')
    {
        let tracNoSNV = document.lmsBasicppviewForm.tracNoE.value;
        let caseNoSNV = document.lmsBasicppviewForm.caseNoppN.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicppviewForm.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
}	

function lms_recovery_view_search(btn_click)
{
		if(btn_click =='Search')
		{
			$("#lms_basic_search_rec_info_form").submit();	
		}
}	

function lms_recovery_details_view_search(btn_click)
{
		if(btn_click =='Save')
		{
            let recDateRNV = document.lmsBasicRecdetailsForm.recDateRN.value;
            let modOfRecNV = document.lmsBasicRecdetailsForm.modOfRecN.value;
            let recAmtRNV = document.lmsBasicRecdetailsForm.recAmtRN.value;
            var recDateRNErr = modOfRecNErr = recAmtRNErr =  true;

            recDateRNErr = validateTextSelect(recDateRNV, 0, "recDateR", "recDateREID", "Recovery date", 0);
            modOfRecNErr = validateTextSelect(modOfRecNV, 1, "modOfRecID", "modOfRecEID", "Mode of Recovery", 0);
            recAmtRNErr = validateTextSelect(recAmtRNV, 0, "recAmtR", "recAmtREID", "Recovery amount", 0);
            
            if((recDateRNErr || modOfRecNErr || recAmtRNErr) == true){
                return false;	
            }else{
                document.lmsBasicRecdetailsForm.submit();
            }
		}
}

function lms_expense_details_view_search(btn_click)
{
		if(btn_click =='Save')
		{
            let expDateExpNV = document.lmsBasicExpdetailsForm.expDateExpN.value;
            let expTypeExpNV = document.lmsBasicExpdetailsForm.expTypeExpN.value;
            let expAmtExpNV = document.lmsBasicExpdetailsForm.expAmtExpN.value;

            var expDateExpNErr = expTypeExpNErr = expAmtExpNErr =  true;

            expDateExpNErr = validateTextSelect(expDateExpNV, 0, "expDateExp", "expDateExpEID", "Date of Expense", 0);
            expTypeExpNErr = validateTextSelect(expTypeExpNV, 1, "expTypeExp", "expTypeExpEID", "Mode of Recovery", 0);
            expAmtExpNErr = validateTextSelect(expAmtExpNV, 0, "expAmtExp", "expAmtExpEID", "Expense Amount", 0);
            
            if((expDateExpNErr || expTypeExpNErr || expAmtExpNErr) == true){
                return false;	
            }else{
                document.lmsBasicExpdetailsForm.submit();
            }
		}
}
function lms_written_off_view_search(btn_click)
{
    if(btn_click =='Search')
    {
        let tracNoSNV = document.lmsBasicWrittenoffForm.tracNoSN.value;
        let caseNoSNV = document.lmsBasicWrittenoffForm.caseNoSN.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicWrittenoffForm.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
}	

function lms_written_off_details_submit(btn_click)
{
		if(btn_click =='Save')
		{
            let DateWrOffNV = document.lmsBasicwrtOffdetailsForm.DateWrOffN.value;
            let WrOffAmtNV = document.lmsBasicwrtOffdetailsForm.WrOffAmtN.value;
            
            var DateWrOffNErr = WrOffAmtNErr =  true;

            DateWrOffNErr = validateTextSelect(DateWrOffNV, 0, "DateWrOff", "DateWrOffEID", "Written-Off Date ", 0);
            WrOffAmtNErr = validateTextSelect(WrOffAmtNV, 0, "WrOffAmt", "WrOffAmtEID", "Written-Off Amount", 0);
            
            if((DateWrOffNErr || WrOffAmtNErr) == true){
                return false;	
            }else{
                document.lmsBasicwrtOffdetailsForm.submit();
            }
		}
}
function lms_disposal_view_search(btn_click)
{
    if(btn_click =='Search'){
        let tracNoSNV = document.lmsBasicDisposalForm.tracNoSN.value;
        let caseNoSNV = document.lmsBasicDisposalForm.caseNoSN.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicDisposalForm.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
}	

function lms_disposal_details_submit(btn_click)
{
    if(btn_click =='Save')
    {
        let disDateDisposalNV = document.lmsBasicDisposaldetailsForm.disDateDisposalN.value;
        let disAmtDisposalNV = document.lmsBasicDisposaldetailsForm.disAmtDisposalN.value;
        let disStatusDisposalNV = document.lmsBasicDisposaldetailsForm.disStatusDisposalN.value;
        let disnatureDisposalNV = document.lmsBasicDisposaldetailsForm.disnatureDisposalN.value;
        let inFavorOfDisposalNV = document.lmsBasicDisposaldetailsForm.inFavorOfDisposalN.value;
            
        var disDateNErr = disAmtNErr = disStatusNErr = disnatureNErr = inFavorOfNErr =  true;

        disDateNErr = validateTextSelect(disDateDisposalNV, 0, "disDateDisposal", "disDateDisposalEID", "Disposal Date ", 0);
        disAmtNErr = validateTextSelect(disAmtDisposalNV, 0, "disAmtDisposal", "disAmtDisposalEID", "Disposal Amount ", 0);
        disStatusNErr = validateTextSelect(disStatusDisposalNV, 1, "disStatusDisposal", "disStatusDisposalEID", "Disposal status ", 0);
        disnatureNErr = validateTextSelect(disnatureDisposalNV, 1, "disnatureDisposal", "disnatureDisposalEID", "Disposal nature ", 0);
        inFavorOfNErr = validateTextSelect(inFavorOfDisposalNV, 1, "inFavorOfDisposal", "inFavorOfDisposalEID", "Disposal In Favoure of ", 0);
        
        if((disDateNErr || disAmtNErr || disStatusNErr || disnatureNErr || inFavorOfNErr) == true){
            return false;	
        }else{
            document.lmsBasicDisposaldetailsForm.submit();
        }
    }
}

function lms_expense_view_search(btn_click)
{
		if(btn_click =='Search')
		{
			$("#lms_basic_search_expense_info_form").submit();	
		}
}	
function lms_os_view_search(btn_click)
{
		if(btn_click =='Search')
		{
            var tracNo = $("#tracNoOE").val();
            if(tracNo != ""){
                $("#lms_basic_search_os_form_view").submit();	
            }else{
                alert("Please Select Tracking No.");
            }
		}
}	
function lms_os_details_save(str){
    if(str =='Save Changes'){
        let DateoutstandingENN = document.lmsOsEditdetailsForm.DateoutstandingEN.value;
        let osdAmtENV = document.lmsOsEditdetailsForm.osdAmtEN.value;
        var DateOutErr = osdAmtErr = true;
        osdAmtErr = validateTextSelect(osdAmtENV, 0, "oustatsndAmtE", "osAmtEEID", "Outstanding Amount ", 0);
        DateOutErr = validateTextSelect(DateoutstandingENN, 0, "DateoutstandingE", "DateoutstandingEID", "Date ", 0);
        if((DateOutErr || osdAmtErr) == true){
            return false;
        }else{
            document.lmsOsEditdetailsForm.submit();
        }
    }
}
function lms_lawyer_view_search(btn_click)
{
    if(btn_click =='Search'){
        let tracNoSNV = document.lmsBasicLawerEditForm.tracNLE.value;
        let caseNoSNV = document.lmsBasicLawerEditForm.caseNoSN.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicLawerEditForm.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
}
function lms_lawyer_details_save(str){
    if(str =='Save Changes'){
        let DatelawyerENV = document.lmslawyerdetailsEditLawForm.DatelawyerEN.value;                         
        
        var DatelawyerErr = lawyerInfoErr = true;
        DatelawyerErr = validateTextSelect(DatelawyerENV, 0, "DatelawyerE", "DatelawyerEID", "Date ", 0);
        
        if((DatelawyerErr) == true){
            return false;
        }else{
            document.lmslawyerdetailsEditLawForm.submit();
        }
    }
}
function lms_ct_view_search(btn_click)
{
    if(btn_click =='Search'){
        let tracNoSNV = document.lmsBasicaseTypeEditForm.tracNoE.value;
        let caseNoSNV = document.lmsBasicaseTypeEditForm.caseNoSN.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicaseTypeEditForm.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
}

function lms_case_type_details_submit(btn_click)
{
    
    if(btn_click =='Save Changes')
    {
        let DatecasetypeingENV = document.lmsBasicCTdetailsEditForm.DatecasetypeingEN.value;             
        let caseTypeECTNV = document.lmsBasicCTdetailsEditForm.caseTypeECTN.value;             
        var caseTypeECTNErr = DatecasetypeingErr =  true;
    
        DatecasetypeingErr = validateTextSelect(DatecasetypeingENV, 0, "DatecasetypeingE", "DatecasetypeingEID", "Date ", 0);
        caseTypeECTNErr = validateTextSelect(caseTypeECTNV, 1, "caseTypeECT", "caseTypeECTEID", "Case Type ", 0);
                
        if((caseTypeECTNErr || DatecasetypeingErr) == true){
            return false;	
        }else{
            document.lmsBasicCTdetailsEditForm.submit();
        }
    }
}

function lms_fk_view_search(btn_click)
{
    if(btn_click =='Search'){
        let tracNoSNV = document.lmsBasicEditpkForm.tracNoE.value;
        let caseNoSNV = document.lmsBasicEditpkForm.caseNoSN.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicEditpkForm.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
}

function lms_file_keeper_details_submit(btn_click)
{   
    if(btn_click =='Save Changes')
    {
        let DatefkENV = document.lmsBasicEditpkdetailsForm.DatefkEN.value;             
        let fileMaintOffBIDENV = document.lmsBasicEditpkdetailsForm.fileMaintOffBIDEN.value;             
        var fileMaintOffBIDENErr = DatefkErr = true;
        DatefkErr = validateTextSelect(DatefkENV, 0, "DatefkE", "DatefkEID", "Date ", 0);
        fileMaintOffBIDENErr = validateTextSelect(fileMaintOffBIDENV, 0, "fileMaintOffBIDE", "fileMaintOffBIDEEID", "Bank ID ", 0);
                
        if((fileMaintOffBIDENErr || DatefkErr) == true){
            return false;	
        }else{
            document.lmsBasicEditpkdetailsForm.submit();
        }
    }
}

function select_subject_fact(){
    var subjectFactV = document.getElementById("subjectFactChoose");
    if(subjectFactV.value == 1112){
        document.getElementById("subjectIssue").style.display = "block";
    }else{
        document.getElementById("subjectIssue").style.display = "none";
    }
}
/** LMS report start */
//0001 start
function control_lms_0001_report_form(ptr)
{
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');
        }
    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
}

function check_search_form_lms_0001(str)
{
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0001_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0001_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
}
function check_search_form_lms_0002(str)
{
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_case = jQuery('#report_of_case').val();
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            if(report_case !=''){
                jQuery('#lms_0002_search_form').submit();
            }else{
                alert('Select Case');
            }
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();
        var report_case = jQuery('#report_of_case').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='' && report_case !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0002_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
}

function tracking_search(brCode){
    if(brCode !='')
    {
        var br_ao_do = 2;
        var url =  "fetch_lms_basic_tcacking_infoindex.php";
         jQuery.ajax({
               url: url,
               type: 'post',
               data: 'br_ao_do='+brCode,
               success: function (response) {
                 if(response !='')
                 {
                     jQuery('#search_tracking_no_info').html(response);
                 }
                 else
                 {
                    jQuery('#search_tracking_no_info').html('<td COLSPAN=""><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                 }
               }
         });
    }
    else
    {
        jQuery('#search_tracking_no_info').html('<td></td><td></td><td></td><td id="report_of_br_ao_do_div_msg_s" COLSPAN=""><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }
function fetch_br_ao_do_lms_btracking(str_val)
{
    if(str_val !='')
    {
        var br_ao_do = 2;
        var url =  "fetch_br_ao_do_lms_basic_tindex.php";
         jQuery.ajax({
               url: url,
               type: 'post',
               data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
               success: function (response) {
                 if(response !='')
                 {
                     jQuery('#report_of_br_ao_do_div_msg_t').html(response);
                 }
                 else
                 {
                    jQuery('#report_of_br_ao_do_div_msg_t').html('<td COLSPAN=""><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                 }
               }
         });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg_t').html('<td></td><td></td><td></td><td id="report_of_br_ao_do_div_msg_s" COLSPAN=""><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
}
function fetch_br_ao_do_lms_b(str_val)
{
    if(str_val !='')
    {
       var br_ao_do = 2;
       var url =  "fetch_br_ao_do_lms_basicindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN=""><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td></td><td></td><td></td><td id="report_of_br_ao_do_div_msg_s" COLSPAN=""><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
}
//fetch_br_ao_do_report_lms
function fetch_br_ao_do_report_lms(str_val)
 {
    if(str_val !='')
    {
       
       var br_ao_do = jQuery('#report_option_selector').val();
       var off_id = jQuery('#off_id').val();
       var office_status = jQuery('#login_office_status').val();
       
       var url =  "fetch_br_ao_do_lms_reportindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val+'&off_id='+off_id+'&office_status='+office_status,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }
 //misd_0001 end

//misd_0003 start

function lms_single_info_view_search(btn_click)
{
    if(btn_click =='Search')
    {
        let tracNoSNV = document.lmsBasicSingleInfo.tracNoE.value;
        let caseNoSNV = document.lmsBasicSingleInfo.caseNoppN.value;
        
        if(tracNoSNV != "" || caseNoSNV !="" ){
            document.lmsBasicSingleInfo.submit();
        }else{
            alert("Please Fill the form of any one.");
        }
    }
    // if(btn_click =='Search')
    // {
    //     document.lmsBasicppviewForm.submit();
    // }
}	


function control_lms_0003_report_form(ptr)
{

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
}

function check_search_form_lms_0003(str)
{
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      ///alert(report_option_selector);
      if(report_option_selector==1 || report_option_selector==5)
      {
        //var report_year=jQuery('#report_of_year').val();
        //var report_month=jQuery('#report_of_month').val();
        //if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0003_search_form').submit();
        }
        // else
        // {
        //     if(report_year =='')
        //     {
        //         alert('Select Year Of Report.');
        //     }
        //     else
        //     {
        //       alert('Select Month Of Report.');
        //     }
        // }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        //var report_year=jQuery('#report_of_year').val();
        //var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0003_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //0003 end

 //0004 start
 function control_lms_0004_report_form(ptr)
 {
     jQuery('#search_text').val('');
     jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="5"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
     if(ptr>0)
     {
         jQuery('#search_form_table').show('slow');
         if(ptr==1 || ptr==5 || ptr==7)
         {
           jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
         }
         else
         {
             jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');
         }
     }
     else
     {
       jQuery('#search_form_table').hide('slow');
     }
 }
 
function check_search_form_lms_0004(str)
{
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year1=jQuery('#report_of_year1').val();
        var report_month1=jQuery('#report_of_month1').val();
        if(report_year1 !='' && report_month1 !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0004_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year1=jQuery('#report_of_year1').val();
        var report_month1=jQuery('#report_of_month1').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year1 !='' && br_ao_do_text !='' && report_month1 !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0004_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
}
/** LIMS 0004 end */
/** LIMS 0005 start */
function control_lms_0005_report_form(ptr)
{
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="5"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');
        }
    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
}

function check_search_form_lms_0005(str)
{
   if(str !='')
   {
     var report_option_selector = jQuery('#report_option_selector').val();
     if(report_option_selector==1 || report_option_selector==5)
     {
       var report_year1 = jQuery('#report_of_year1').val();
       var report_month1 = jQuery('#report_of_month1').val();
       if(report_year1 !='' && report_month1 !='')
       {
           var report_click_btn=0;
           if(str=='View Report'){report_click_btn=1;}
           if(str=='Save Report As PDF'){report_click_btn=2;}
           jQuery('#report_click_btn').val(report_click_btn);
           jQuery('#lms_0005_search_form').submit();
       }
       else
       {
           if(report_year1 =='')
           {
               alert('Select Year Of Report.');
           }
           else
           {
             alert('Select Month Of Report.');
           }
       }
     }
     else
     {
       var br_ao_do=0;
       if(jQuery("input[name='report_report_office_id']:checked").val()>0)
       {
           br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
       }
       var report_year1=jQuery('#report_of_year1').val();
       var report_month1=jQuery('#report_of_month1').val();
       var br_ao_do_text=jQuery('#search_text').val();

       if(br_ao_do !='0' && report_year1 !='' && br_ao_do_text !='' && report_month1 !='')
       {
           var report_click_btn=0;
           if(str=='View Report'){report_click_btn=1;}
           if(str=='Save Report As PDF'){report_click_btn=2;}
           jQuery('#report_click_btn').val(report_click_btn);
           jQuery('#lms_0005_search_form').submit();
       }
       else
       {
           alert('First Fill The Search Form Properly.');
       }
     }
   }
}
/** LIMS 0005 end */

//0006 start
function control_lms_0006_report_form(ptr)
{
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');
        }
    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
}

function check_search_form_lms_0006(str)
{
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0006_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#lms_0006_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
}
//0006 end
/** LMS report end */