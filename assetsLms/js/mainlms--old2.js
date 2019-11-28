
$(".choseSelect").chosen();

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
        <input type="button" value="-" onclick="removeRow(this)">';
        document.getElementById('addHere').appendChild(addDiv);
    }
}
function removeRow(input) {
    document.getElementById('addHere').removeChild(input.parentNode);
}

function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
   
}


function validateTextSelect(fieldV, flagV=0, txtID='', errID='', validateType='' ){
    var fieldV = fieldV;
    var flagV= flagV;
    var txtID = txtID;
    var errID = errID;
    var seleMsg = validateType;
    
    if(flagV==0){
        if(fieldV == "") {
            printError(errID, `Please enter ${seleMsg}`);
            document.getElementById(txtID).focus() ;
            return true;
        } else {
            printError(errID, "");
            return false;
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
        var courtTypeNV = document.lmsBasicForm.courtTypeN.value;
        var caseTypeNV = document.lmsBasicForm.caseTypeN.value;
        var caseCategoryNV = document.lmsBasicForm.caseCategoryN.value;
        var caseFileStatusNV = document.lmsBasicForm.caseFileStatusN.value;
        var filingDateNV = document.lmsBasicForm.filingDateN.value;
        var locOfCourtNV = document.lmsBasicForm.locationOfCourtN.value;
        var locOfCourtNV = document.lmsBasicForm.locationOfCourtN.value;
        var claimAmountNV = document.lmsBasicForm.claimAmountN.value;
        var outstandingNV = document.lmsBasicForm.outstandingN.value;
        var loanACNameNV = document.lmsBasicForm.loanACNameN.value;
        var ACHolderAddNV = document.lmsBasicForm.ACHolderAddN.value;
        var fileMaintOffBIDNV = document.lmsBasicForm.fileMaintOffBIDN.value;
        
        var caseNoNErr = courtTypeNErr = caseTypeNErr = caseCategoryNErr = caseFileStatusNErr = true;
        var fileMaintOffBIDNErr = ACHolderAddNErr = loanACNameNErr = outstandingNErr = filingDateNErr = locOfCourtNErr = claimAmountNErr = true;
        
        caseNoNErr = validateTextSelect(caseNoV, 0, "caseNo", "caseNoNID", "case no");
        courtTypeNErr = validateTextSelect(courtTypeNV, 1, "courtTypeN", "courtTypeID", "court type");
        caseTypeNErr = validateTextSelect(caseTypeNV, 1, "caseTypeN", "caseTypeID", "case type");
        caseCategoryNErr = validateTextSelect(caseCategoryNV, 1, "caseCategoryN", "caseCategoryEID", "case category");
        caseFileStatusNErr = validateTextSelect(caseFileStatusNV, 1, "caseFileStatusN", "scaseFileStatusEID", "case file status ");
        filingDateNErr = validateTextSelect(filingDateNV, 0, "filingDate", "filingDateEID", "Filing date");
        locOfCourtNErr = validateTextSelect(locOfCourtNV, 1, "locationOfCourtN", "locOfCourtEID", "location of court");
        claimAmountNErr = validateTextSelect(claimAmountNV, 0, "claimAmount", "claimAmountEID", "claim amount");
        outstandingNErr = validateTextSelect(outstandingNV, 0, "outstanding", "outstandingEID", "outstanding");
        loanACNameNErr = validateTextSelect(loanACNameNV, 0, "loanACName", "loanACNameEID", "loan a/c name");
        ACHolderAddNErr = validateTextSelect(ACHolderAddNV, 0, "ACHolderAdd", "ACHolderAddEID", "a/c holder address");
        fileMaintOffBIDNErr = validateTextSelect(fileMaintOffBIDNV, 0, "fileMaintOffBID", "fileMaintOffBIDEID", "File Maintenance Officer BID");


        if((fileMaintOffBIDNErr||ACHolderAddNErr||loanACNameNErr||outstandingNErr||caseNoNErr ||courtTypeNErr||caseTypeNErr ||caseCategoryNErr||caseFileStatusNErr||filingDateNErr||locOfCourtNErr||claimAmountNErr) == true) {
            return false;
         } else {
            //Check non digit 
            // var claimAmtdigChk = false;
            // if(isNaN(claimAmountNV) && typeof claimAmountNV === "number"){
            //     claimAmtdigChk = true;
            // }else{
            //     document.getElementById("claimAmount").style.backgroundColor = "red";
            //     document.getElementById("claimAmount").style.color = "white";
            // }
            //return false;
            document.lmsBasicForm.submit();
         }
    }
 }