
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
            document.lmsBasicForm.submit();
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

 function lms_info_view_search(btn_click)
{
		if(btn_click =='Search')
		{
			$("#lms_basic_search_info_form").submit();	
		}
}	
