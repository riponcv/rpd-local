
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
        
        //var courtTypeNV = document.lmsBasicForm.courtTypeN.value;
        var CTfirstListNV = document.lmsBasicForm.CTfirstListN.value;
        var CTsecondListNV = document.lmsBasicForm.CTsecondListN.value;
        var CTthirdListNV = document.lmsBasicForm.CTthirdListN.value;

        var caseNoNErr = caseTypeNErr = caseCategoryNErr = caseFileStatusNErr = true;
        var fileMaintOffBIDNErr = ACHolderAddNErr = loanACNameNErr = outstandingNErr = filingDateNErr = locOfCourtNErr = claimAmountNErr = true;
        var CTFirstErr = CTSecondErr = CTThirdErr = false;

        caseNoNErr = validateTextSelect(caseNoV, 0, "caseNo", "caseNoNID", "case no", 0);
        
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

        //courtTypeNErr = validateTextSelect(courtTypeNV, 1, "courtTypeN", "courtTypeID", "court type", 0);
        if(CTfirstListNV !=0 || CTfirstListNV !=""){
            CTFirstErr = validateTextSelect(CTfirstListNV, 1, "CTfirstListN", "CTfirstListEID", "court type", 0);
        }
        if(CTsecondListNV !=0 || CTsecondListNV !=""){
            CTSecondErr = validateTextSelect(CTsecondListNV, 1, "CTsecondListN", "CTsecondListEID", "court type", 0);
        }
        if(CTfirstListNV !=0 && (CTsecondListNV =="31" ||CTsecondListNV =="32")){
            CTThirdErr = validateTextSelect(CTthirdListNV, 1, "CTthirdListN", "CTthirdListEID", "court type", 0);
        }
        
        if((fileMaintOffBIDNErr||ACHolderAddNErr||loanACNameNErr||outstandingNErr||caseNoNErr ||caseTypeNErr ||caseCategoryNErr||caseFileStatusNErr||filingDateNErr||locOfCourtNErr||claimAmountNErr ||
            CTFirstErr || CTSecondErr || CTThirdErr) == true) {
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

function lms_recovery_view_search(btn_click)
{
		if(btn_click =='Search')
		{
			$("#lms_basic_search_rec_info_form").submit();	
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
			//$("#lms_basic_search_os_form_view").submit();	
		}
}	
function lms_lawyer_view_search(btn_click)
{
    if(btn_click =='Search')
    {
        var tracNo = $("#tracNo").val();
        if(tracNo != ""){
            $("#lms_basic_search_lawyer_form_view").submit();	
        }else{
            alert("Please Select Tracking No.");
        }
    }
}

function lms_ct_view_search(btn_click)
{
    if(btn_click =='Search')
    {
        var tracNo = $("#tracNoCT").val();
        if(tracNo != ""){
            $("#lms_basic_search_ct_form_view").submit();	
        }else{
            alert("Please Select Tracking No.");
        }
        
    }
}
function lms_fk_view_search(btn_click)
{
    if(btn_click =='Search')
    {
        var tracNo = $("#tracNoFK").val();
        if(tracNo != ""){
            $("#lms_basic_search_fk_form_view").submit();	
        }else{
            alert("Please Select Tracking No.");
        }
        
    }
}

function select_subject_fact(){
    var subjectFactV = document.getElementById("subjectFactChoose");
    if(subjectFactV.value == 11){
        document.getElementById("subjectIssue").value= "";
        document.getElementById("subjectIssue").type= "text";
    }else{
        document.getElementById("subjectIssue").value = subjectFactV.value;
        document.getElementById("subjectIssue").type= "hidden";
    }
}
/** LMS report start */
//misd_0001 start
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
            jQuery('#misd_0001_search_form').submit();
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
            jQuery('#misd_0001_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

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

/** LMS report end */