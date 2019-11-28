



$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();

    
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });
    
    
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){ 
	    var edit=0;
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" id="edit_'+edit++ +'" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
                
    });
    
 
});


            ///////////////////////////////////////////////    Court type //////////////////////////////////////////////////////////
            
  function court_type_delete_action(court_id)
   {
    if(court_id>0)
     {    
        if(confirm("Do you want to delete this court type? [Court ID : "+court_id+"]"))
    	{       
                var url =  "lms_court_type_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=3&court_id='+court_id,
                      success: function (response) {
                        if(response ==1)
                        {
                            //jQuery(this).parents("tr").remove();
                            //jQuery(".add-new").removeAttr("disabled");
                            jQuery("#tr_id_"+court_id).remove();
                            jQuery(".add-new").removeAttr("disabled");
                            alert("Court type deleted successfully.");
                           
                        }
                        else
                        {
                           alert("Court type not deleted."); 
                        }
                      }
                });	
    	}
    }
    else
    {
        if(confirm("Do you want to delete this row?"))
        {
            jQuery("#tr_id_0").remove();
            jQuery(".add-new").removeAttr("disabled");   
        }
    }  
 }

function court_type_add_field()
 {    
    $('[data-toggle="tooltip"]').tooltip();
	//var actions = $("table td:last-child").html(); 
    
    var actions = '<td style="text-align: center;">' +
    							'<a class="add" title="Add" onclick="add_court_type_action()" data-toggle="tooltip"> <i class="material-icons">&#xE03B;</i></a>' +
                                '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
                                '<a class="delete" title="Delete" data-toggle="tooltip" onclick="court_type_delete_action(0)"><i class="material-icons">&#xE872;</i></a>' +
                            '</td>';
    
    jQuery("#add_new_btn").attr("disabled", "disabled");
	var index = $("table tbody tr:last-child").index();

    
        var row = '<tr id="tr_id_0">' +
            '<td><input type="text" class="form-control" name="lmct_l1" id="lmct_l1"></td>'+
            '<td><input type="text" class="form-control" name="lmct_desc1" id="lmct_desc1"></td>'+
            '<td><input type="text" class="form-control" name="lmct_l2" id="lmct_l2"></td>'+
            '<td><input type="text" class="form-control" name="lmct_desc2" id="lmct_desc2"></td>'+
            '<td><input type="text" class="form-control" name="lmct_l3" id="lmct_l3"></td>' +
            '<td><input type="text" class="form-control" name="lmct_desc3" id="lmct_desc3"></td>' + actions +
        '</tr>';
    
	$("#data_tbl").append(row);		
	$("table tbody tr").eq(index +1).find(".add, .edit").toggle();
    $('[data-toggle="tooltip"]').tooltip();
    
    var elmnt = document.getElementById("data_tbl");
    elmnt.scrollIntoView(false);
    
  }

 function add_court_type_action()
  {   
    var lmct_l1=jQuery("#lmct_l1").val();
    var lmct_l2=jQuery("#lmct_l2").val();
    var lmct_l3=jQuery("#lmct_l3").val();
    
    var lmct_desc1=jQuery("#lmct_desc1").val();
    var lmct_desc2=jQuery("#lmct_desc2").val();
    var lmct_desc3=jQuery("#lmct_desc3").val();
   
    
    if(lmct_l1>0)
     {   
        if(confirm("Do you want to add this court type?"))
    	{       
                var url =  "lms_court_type_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=1&lmct_l1='+lmct_l1+'&lmct_desc1="'+lmct_desc1+'"&lmct_l2="'+lmct_l2+'"&lmct_desc2="'+lmct_desc2+'"&lmct_l3="'+lmct_l3+'"&lmct_desc3="'+lmct_desc3+'"',
                     
                      success: function (response) {
                        if(response>1)
                        {        alert(response);              
                           jQuery("#tr_id_0").find(".delete").attr('onclick','court_type_delete_action('+response+')');
                           jQuery("#tr_id_0").prop("id","tr_id_"+response);
                           jQuery("#add_new_btn").attr("disabled", "disabled");
                           jQuery("#add_new_btn").removeAttr("disabled");
                          
                           var elmnt = document.getElementById("data_tbl");
                           elmnt.scrollIntoView(true);
                           alert('Court type added successfully.');
                        }
                        else
                        {alert(response); 
                           alert("Court type not added."); 
                        }
                      }
                });	
    	}
    }

 }

 function edit_court_type_action(court_id)
  {
    var update_court_id=court_id;
    var lmct_l1=jQuery("#edit_0").val();
    var lmct_l2=jQuery("#edit_2").val();
    var lmct_l3=jQuery("#edit_4").val();
    var lmct_desc1=jQuery("#edit_1").val();
    var lmct_desc2=jQuery("#edit_3").val();
    var lmct_desc3=jQuery("#edit_5").val();
    
   if(court_id>0)
    {    // alert(lmct_l1+"="+lmct_l2+"="+lmct_l3+"="+lmct_desc1+"="+lmct_desc2+"="+lmct_desc3);
        if(confirm("Do you want to update this data?"))
    	{       
                var url =  "lms_court_type_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=2&court_id='+update_court_id+'&lmct_l1="'+lmct_l1+'"&lmct_desc1="'+lmct_desc1+'"&lmct_l2="'+lmct_l2+'"&lmct_desc2="'+lmct_desc2+'"&lmct_l3="'+lmct_l3+'"&lmct_desc3="'+lmct_desc3+'"',
                      success: function (response) { 
                        if(response ==1)
                        {                           
                            $("#data_tbl").parents("tr").find(".add, .edit").toggle();
	                    	$(".add-new").attr("disabled", "disabled");
                            alert('Data Updated successfully.');
                           
                        }
                        else
                        {
                           alert("Data not Updated."); 
                        }
                      }
                });	
    	}
    }

  }


////////////////////////////////////////////////////////////// Case Category   /////////////////////////////////////////////////////

function case_cat_delete(case_id)
{
    if(case_id>0)
    {    
        if(confirm("Do you want to delete this case category? [Court ID : "+case_id+"]"))
    	{       
                var url =  "lms_case_cat_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=3&case_id='+case_id,
                      success: function (response) {
                        if(response ==1)
                        {
                            //jQuery(this).parents("tr").remove();
                            //jQuery(".add-new").removeAttr("disabled");
                            jQuery("#tr_id_"+case_id).remove();
                            jQuery(".add-new").removeAttr("disabled");
                            alert("Case Category deleted successfully.");
                           
                        }
                        else
                        {  
                           alert("Case Category not deleted."); 
                        }
                      }
                });	
    	}
    }
    else
    {
        if(confirm("Do you want to delete this row?"))
        {
            jQuery("#tr_id_0").remove();
            jQuery(".add-new").removeAttr("disabled");   
        }
    }  
 }


function case_cat_add_field()

{    

    $('[data-toggle="tooltip"]').tooltip();
	//var actions = $("table td:last-child").html(); 
    
    var actions = '<td style="text-align: center;">' +
    							'<a class="add" title="Add" onclick="add_case_cat_action()" data-toggle="tooltip"> <i class="material-icons">&#xE03B;</i></a>' +
                                '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
                                '<a class="delete" title="Delete" data-toggle="tooltip" onclick="case_cat_delete(0)"><i class="material-icons">&#xE872;</i></a>' +
                            '</td>';
    
    jQuery("#add_new_btn").attr("disabled", "disabled");
	var index = $("table tbody tr:last-child").index();

    
        var row = '<tr id="tr_id_0">' +
            '<td><input type="text" class="form-control" name="lmcc_l1" id="lmcc_l1"></td>'+
            '<td><input type="text" class="form-control" name="lmcc_desc1" id="lmcc_desc1"></td>'+
            '<td><input type="text" class="form-control" name="lmcc_l2" id="lmcc_l2"></td>'+
            '<td><input type="text" class="form-control" name="lmcc_desc2" id="lmcc_desc2"></td>'+
            '<td><input type="text" class="form-control" name="lmcc_l3" id="lmcc_l3"></td>' +
            '<td><input type="text" class="form-control" name="lmcc_desc3" id="lmcc_desc3"></td>' + actions +
        '</tr>';
                           
        $("#data_tbl").append(row);		
    	$("table tbody tr").eq(index +1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
        var elmnt = document.getElementById("data_tbl");
        elmnt.scrollIntoView(false);
        
}

 function add_case_cat_action()
{   
    var lmcc_l1=jQuery("#lmcc_l1").val();
    var lmcc_desc1=jQuery("#lmcc_desc1").val();
    var lmcc_l2=jQuery("#lmcc_l2").val();
    var lmcc_desc2=jQuery("#lmcc_desc2").val();
    var lmcc_l3=jQuery("#lmcc_l3").val();
    var lmcc_desc3=jQuery("#lmcc_desc3").val();
   
   if(lmcc_l1>0)
    {
        //alert(lmcc_l1+"="+lmcc_l2+"="+lmcc_l3+"="+lmcc_desc1+"="+lmcc_desc2+"="+lmcc_desc3);
        if(confirm("Do you want to add this case category?"))
    	{       
                var url =  "lms_case_cat_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=1&lmcc_l1='+lmcc_l1+'&lmcc_desc1="'+lmcc_desc1+'"&lmcc_l2="'+lmcc_l2+'"&lmcc_desc2="'+lmcc_desc2+'"&lmcc_l3="'+lmcc_l3+'"&lmcc_desc3="'+lmcc_desc3+'"',
                     
                      success: function (response) {
                        if(response>1)
                        {                      
                           jQuery("#tr_id_0").find(".delete").attr('onclick','case_cat_delete('+response+')');
                           jQuery("#tr_id_0").prop("id","tr_id_"+response);
                           jQuery("#add_new_btn").attr("disabled", "disabled");
                           jQuery("#add_new_btn").removeAttr("disabled");
                        
                           var elmnt = document.getElementById("data_tbl");
                           elmnt.scrollIntoView(true);
                           alert('Case category added successfully.');
                        }
                        else
                        {   
                           alert("Case category not added."); 
                        }
                      }
                });	
    	}
    }

}

function edit_case_cat_action(case_cat_id)
{
    var case_id=case_cat_id;
    var lmcc_l1=jQuery("#edit_0").val();
    var lmcc_l2=jQuery("#edit_2").val();
    var lmcc_l3=jQuery("#edit_4").val();
    var lmcc_desc1=jQuery("#edit_1").val();
    var lmcc_desc2=jQuery("#edit_3").val();
    var lmcc_desc3=jQuery("#edit_5").val();
  
   if(case_id>0)
     
    {     
     
        if(confirm("Do you want to update this data?"))
    	{      // alert(lmcc_l1+"="+lmcc_l2+"="+lmcc_l3+"="+lmcc_desc1+"="+lmcc_desc2+"="+lmcc_desc3);
                var url =  "lms_case_cat_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=2&case_id='+case_id+'&lmcc_l1="'+lmcc_l1+'"&lmcc_desc1="'+lmcc_desc1+'"&lmcc_l2="'+lmcc_l2+'"&lmcc_desc2="'+lmcc_desc2+'"&lmcc_l3="'+lmcc_l3+'"&lmcc_desc3="'+lmcc_desc3+'"',
                      success: function (response) { 
                        if(response==1)
                        {                  
                             
                            $("#data_tbl").parents("tr").find(".add, .edit").toggle();
	                    	$(".add-new").attr("disabled", "disabled");
                            alert('Data Updated successfully.');
                           
                        }
                        else
                        {  
                           
                           alert("Data not Updated."); 
                        }
                      }
                });	
    	}
    }

}



////////////////////////////////////////////// Lawyer Information /////////////////////////////////////////////

function lawyer_info_delete(lw_id)
{
    if(lw_id>0)
    {    
        if(confirm("Do you want to delete this Lawyer? [Court ID : "+lw_id+"]"))
    	
                var url =  "lms_lawyer_info_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=3&case_id='+case_id,
                      success: function (response) {
                        if(response ==1)
                        {
                            //jQuery(this).parents("tr").remove();
                            //jQuery(".add-new").removeAttr("disabled");
                            jQuery("#tr_id_"+case_id).remove();
                            jQuery(".add-new").removeAttr("disabled");
                            alert("Lawyer Information deleted successfully.");
                           
                        }
                        else
                        {  
                           alert("Lawyer Information not deleted."); 
                        }
                      }
                });	
    	}
    }
   

function lawer_info_add_field()

{    

    $('[data-toggle="tooltip"]').tooltip();
	//var actions = $("table td:last-child").html(); 
    
    var actions = '<td style="text-align: center;">' +
    							'<a class="add" title="Add" onclick="add_lawyer_info_action()" data-toggle="tooltip"> <i class="material-icons">&#xE03B;</i></a>' +
                                '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
                                '<a class="delete" title="Delete" data-toggle="tooltip" onclick="case_cat_delete(0)"><i class="material-icons">&#xE872;</i></a>' +
                            '</td>';
    
    jQuery("#add_new_btn").attr("disabled", "disabled");
	var index = $("table tbody tr:last-child").index();

    
        var row = '<tr id="tr_id_0">' +
            '<td><input type="text" class="form-control" name="lw_id" id="lw_id"></td>'+
            '<td><input type="text" class="form-control" name="lw_name" id="lw_name"></td>'+
            '<td><input type="text" class="form-control" name="lw_mob" id="lw_mob"></td>'+
            '<td><input type="text" class="form-control" name="lw_dist" id="lw_dist"></td>'+
            '<td><input type="text" class="form-control" name="lw_div" id="lw_div"></td>' +
            '<td><input type="text" class="form-control" name="lw_pos" id="lw_pos"></td>' +
            '<td><input type="text" class="form-control" name="lw_pos_id" id="lw_pos_id"></td>' + actions +
        '</tr>';
                           
        $("#data_tbl").append(row);		
    	$("table tbody tr").eq(index +1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
        var elmnt = document.getElementById("data_tbl");
        elmnt.scrollIntoView(false);
        
}



function add_lawyer_info_action()
{   
    var lw_id=jQuery("#lw_id").val();
    var lw_name=jQuery("#lw_name").val();
    var lw_mob=jQuery("#lw_mob").val();
    var lw_dist=jQuery("#lw_dist").val();
    var lw_div=jQuery("#lw_div").val();
    var lw_pos=jQuery("#lw_pos").val();
    var lw_pos_id=jQuery("#lw_pos_id").val();
    //alert(lw_id+'='+lw_name+'='+lw_mob+'='+lw_dist+'='+lw_div+'='+lw_pos+'='+lw_pos_id);
   if(lw_id>0)
    {
        //alert(lmcc_l1+"="+lmcc_l2+"="+lmcc_l3+"="+lmcc_desc1+"="+lmcc_desc2+"="+lmcc_desc3);
        if(confirm("Do you want to add this Lawyer Information?"))
    	{       
                var url =  "lms_lawyer_info_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=1&lw_id='+lw_id+'&lw_name="'+lw_name+'"&lw_mob="'+lw_mob+'"&lw_dist="'+lw_dist+'"&lw_div="'+lw_div+'"&lw_pos="'+lw_pos+'"&lw_pos_id="'+lw_pos_id+'"',
                     
                      success: function (response) {
                        if(response>1)
                        {                      
                           jQuery("#tr_id_0").find(".delete").attr('onclick','lawyer_info_delete('+response+')');
                           jQuery("#tr_id_0").prop("id","tr_id_"+response);
                           jQuery("#add_new_btn").attr("disabled", "disabled");
                           jQuery("#add_new_btn").removeAttr("disabled");
                        
                           var elmnt = document.getElementById("data_tbl");
                           elmnt.scrollIntoView(true);
                           alert('Lawyer Information added successfully.');
                        }
                        else
                        {   
                           alert("Lawyer Information not added."); 
                        }
                      }
                });	
    	}
    }

}

function edit_lawyer_info_action(lml_lawyer_id)
{
    var lawyer_pev_id=lml_lawyer_id;
    var lw_id=jQuery("#edit_0").val();
    var lw_name=jQuery("#edit_1").val();
    var lw_mob=jQuery("#edit_2").val();
    var lw_dist=jQuery("#edit_3").val();
    var lw_div=jQuery("#edit_4").val();
    var lw_pos=jQuery("#edit_5").val();
    var lw_pos_id=jQuery("#edit_6").val();
    
    //alert(lawyer_pev_id+'='+lw_id+'='+lw_name+'='+lw_mob+'='+lw_dist+'='+lw_div+'='+lw_pos+'='+lw_pos_id); 
   if(lw_id>0)
     
    {     
     
        if(confirm("Do you want to update this data?"))
    	{    
                var url =  "lms_lawyer_info_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=2&lawyer_pev_id='+lawyer_pev_id+'&lw_id='+lw_id+'&lw_name="'+lw_name+'"&lw_mob="'+lw_mob+'"&lw_dist="'+lw_dist+'"&lw_div="'+lw_div+'"&lw_pos="'+lw_pos+'"&lw_pos_id="'+lw_pos_id+'"',
                      success: function (response) { 
                        if(response==1)
                        {                                               
                            $("#data_tbl").parents("tr").find(".add, .edit").toggle();
	                    	$(".add-new").attr("disabled", "disabled");
                            alert('Data Updated successfully.');
                           
                        }
                        else
                        {  
                           
                           alert("Data not Updated."); 
                        }
                      }
                });	
    	}
    }

}

function lawyer_info_delete(lawyer_id,lml_data_id)
{
    if(lawyer_id>0)
    {    
        if(confirm("Do you want to delete this case category? [Court ID : "+lawyer_id+"]"))
    	{       
                var url =  "lms_lawyer_info_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=3&lawyer_id='+lawyer_id,
                      success: function (response) {
                        if(response ==1)
                        {
                            //jQuery(this).parents("tr").remove();
                            //jQuery(".add-new").removeAttr("disabled");
                            jQuery("#tr_id_"+lml_data_id).remove();
                            jQuery(".add-new").removeAttr("disabled");
                            alert("Lawyer Information type deleted successfully.");
                           
                        }
                        else
                        {  
                           alert("Lawyer Information type not deleted."); 
                        }
                      }
                });	
    	}
    }
    else
    {
        if(confirm("Do you want to delete this row?"))
        {
            jQuery("#tr_id_0").remove();
            jQuery(".add-new").removeAttr("disabled");   
        }
    }  
 }


////////////////////////////////////////////// current status /////////////////////////////////////////////




function current_status_add_field()

{    

    $('[data-toggle="tooltip"]').tooltip();
	//var actions = $("table td:last-child").html(); 
    
    var actions = '<td style="text-align: center;">' +
    							'<a class="add" title="Add" onclick="add_current_status_action()" data-toggle="tooltip"> <i class="material-icons">&#xE03B;</i></a>' +
                                '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
                                '<a class="delete" title="Delete" data-toggle="tooltip" onclick="case_cat_delete(0)"><i class="material-icons">&#xE872;</i></a>' +
                            '</td>';
    
    jQuery("#add_new_btn").attr("disabled", "disabled");
	var index = $("table tbody tr:last-child").index();

    
        var row = '<tr id="tr_id_0">' +
            '<td><input type="text" class="form-control" name="cr_st_id" id="cr_st_id"></td>'+
            '<td><input type="text" class="form-control" name="cr_st_desc" id="cr_st_desc"></td>'+
            '<td><input type="text" class="form-control" name="cr_st_id_2" id="cr_st_id_2"></td>'+
            '<td><input type="text" class="form-control" name="cr_st_desc_2" id="cr_st_desc_2"></td>'+ actions +
        '</tr>';
                           
        $("#data_tbl").append(row);		
    	$("table tbody tr").eq(index +1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
        var elmnt = document.getElementById("data_tbl");
        elmnt.scrollIntoView(false);
        
}



function add_current_status_action()
{   
    var cr_st_id=jQuery("#cr_st_id").val();
    var cr_st_desc=jQuery("#cr_st_desc").val();
    var cr_st_id_2=jQuery("#cr_st_id_2").val();
    var cr_st_desc_2=jQuery("#cr_st_desc_2").val();
    
    
    //alert(lw_id+'='+lw_name+'='+lw_mob+'='+lw_dist+'='+lw_div+'='+lw_pos+'='+lw_pos_id);
   if(cr_st_id>0)
    {
        //alert(lmcc_l1+"="+lmcc_l2+"="+lmcc_l3+"="+lmcc_desc1+"="+lmcc_desc2+"="+lmcc_desc3);
        if(confirm("Do you want to add this Lawyer Information?"))
    	{       
                var url =  "lms_current_status_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=1&cr_st_id='+cr_st_id+'&cr_st_desc="'+cr_st_desc+'"&cr_st_id_2="'+cr_st_id_2+'"&cr_st_desc_2="'+cr_st_desc_2+'"',
                     
                      success: function (response) {
                        if(response>1)
                        {                      
                           jQuery("#tr_id_0").find(".delete").attr('onclick','current_status_delete('+response+')');
                           jQuery("#tr_id_0").prop("id","tr_id_"+response);
                           jQuery("#add_new_btn").attr("disabled", "disabled");
                           jQuery("#add_new_btn").removeAttr("disabled");
                        
                           var elmnt = document.getElementById("data_tbl");
                           elmnt.scrollIntoView(true);
                           alert('Current Status added successfully.');
                        }
                        else
                        {   
                           alert("Current Status not added."); 
                        }
                      }
                });	
    	}
    }

}

function edit_current_status_action(lmpp_pp_id_l2)
{
    var lmpp_pp_id_l2=lmpp_pp_id_l2;
    var cr_st_id=jQuery("#edit_0").val();
    var cr_st_desc=jQuery("#edit_1").val();
    var cr_st_id_2=jQuery("#edit_2").val();
    var cr_st_desc_2=jQuery("#edit_3").val();
  
   // alert(lmpp_pp_id_l2+'='+cr_st_id+'='+cr_st_desc+'='+cr_st_id_2+'='+cr_st_desc_2); 
   if(lmpp_pp_id_l2>0)
     
    {     
     
        if(confirm("Do you want to update this data?"))
    	{    
                var url =  "lms_current_status_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=2&lmpp_pp_id_l2='+lmpp_pp_id_l2+'&cr_st_id_2='+cr_st_id_2+'&cr_st_desc="'+cr_st_desc+'"&cr_st_id='+cr_st_id+'&cr_st_desc_2="'+cr_st_desc_2+'"',
                      success: function (response) { 
                        if(response==1)
                        {                                               
                            
                            $("#data_tbl").parents("tr").find(".add, .edit").toggle();
	                    	$(".add-new").attr("disabled", "disabled");
                            alert('Data Updated successfully.');                           
                        }
                        else
                        {  
                           
                           alert("Data not Updated."); 
                        }
                      }
                });	
    	}
    }

}

function current_status_delete(lmpp_pp_id_l2,lmpp_data_id)
{
    if(lmpp_pp_id_l2>0)
    {    
        if(confirm("Do you want to delete this Current Status? [Status ID : "+lmpp_pp_id_l2+"]"))
    	
                var url =  "lms_current_status_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=3&lmpp_pp_id_l2='+lmpp_pp_id_l2,
                      success: function (response) {
                        if(response ==1)
                        {
                            //jQuery(this).parents("tr").remove();
                            //jQuery(".add-new").removeAttr("disabled");
                            jQuery("#tr_id_"+lmpp_data_id).remove();
                            jQuery(".add-new").removeAttr("disabled");
                            alert("Current Status deleted successfully.");
                           
                        }
                        else
                        {  
                           alert("Current Status not deleted."); 
                        }
                      }
                });	
    }
    else
    {
        if(confirm("Do you want to delete this row?"))
        {
            jQuery("#tr_id_0").remove();
            jQuery(".add-new").removeAttr("disabled");   
        }
    }  
 }


///////////////////////////////////////// Expense Type     ///////////////////////////////

function expense_type_add_field()

{    

    $('[data-toggle="tooltip"]').tooltip();
	//var actions = $("table td:last-child").html(); 
    
    var actions = '<td style="text-align: center;">' +
    							'<a class="add" title="Add" onclick="add_expense_type_action()" data-toggle="tooltip"> <i class="material-icons">&#xE03B;</i></a>' +
                                '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
                                '<a class="delete" title="Delete" data-toggle="tooltip" onclick="case_cat_delete(0)"><i class="material-icons">&#xE872;</i></a>' +
                            '</td>';
    
    jQuery("#add_new_btn").attr("disabled", "disabled");
	var index = $("table tbody tr:last-child").index();

    
        var row = '<tr id="tr_id_0">' +
            '<td><input type="text" class="form-control" name="exp_typ_id" id="exp_typ_id"></td>'+
            '<td><input type="text" class="form-control" name="exp_typ_desc" id="exp_typ_desc"></td>'+actions +
        '</tr>';
                           
        $("#data_tbl").append(row);		
    	$("table tbody tr").eq(index +1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
        var elmnt = document.getElementById("data_tbl");
        elmnt.scrollIntoView(false);
        
}



function add_expense_type_action()
{   
    var exp_typ_id=jQuery("#exp_typ_id").val();
    var exp_typ_desc=jQuery("#exp_typ_desc").val();
    
    //alert(lw_id+'='+lw_name+'='+lw_mob+'='+lw_dist+'='+lw_div+'='+lw_pos+'='+lw_pos_id);
   if(exp_typ_id>0)
    {
        //alert(lmcc_l1+"="+lmcc_l2+"="+lmcc_l3+"="+lmcc_desc1+"="+lmcc_desc2+"="+lmcc_desc3);
        if(confirm("Do you want to add this Expense Type?"))
    	{       
                var url =  "lms_expense_type_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=1&exp_typ_id='+exp_typ_id+'&exp_typ_desc="'+exp_typ_desc+'"',
                     
                      success: function (response) {
                        if(response>1)
                        {                      
                           jQuery("#tr_id_0").find(".delete").attr('onclick','expense_type_delete('+response+')');
                           jQuery("#tr_id_0").prop("id","tr_id_"+response);
                           jQuery("#add_new_btn").attr("disabled", "disabled");
                           jQuery("#add_new_btn").removeAttr("disabled");
                        
                           var elmnt = document.getElementById("data_tbl");
                           elmnt.scrollIntoView(true);
                           alert('Expense type added successfully.');
                        }
                        else
                        {   
                           alert("Expense type not added."); 
                        }
                      }
                });	
    	}
    }

}


  function edit_expense_type_action(lmet_data_id)
{
    var lmt_data_id=lmet_data_id;
    var lmt_et_id=jQuery("#edit_0").val();
    var lmt_et_desc=jQuery("#edit_1").val();
  
  
   // alert(lmpp_pp_id_l2+'='+cr_st_id+'='+cr_st_desc+'='+cr_st_id_2+'='+cr_st_desc_2); 
   if(lmt_data_id>0)
     
    {     
     
        if(confirm("Do you want to update this data?"))
    	{    
                var url =  "lms_expense_type_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=2&lmt_data_id='+lmt_data_id+'&lmt_et_id='+lmt_et_id+'&lmt_et_desc="'+lmt_et_desc+'"',
                      success: function (response) { 
                        if(response==1)
                        {                                               
                            
                            $("#data_tbl").parents("tr").find(".add, .edit").toggle();
	                    	$(".add-new").attr("disabled", "disabled");
                            alert('Data Updated successfully.');                           
                        }
                        else
                        {  
                           
                           alert("Data not Updated."); 
                        }
                      }
                });	
    	}
    }

}

  function expense_type_delete(inc_id,data_id)
    {
        if(inc_id>0)
        {    
            if(confirm("Do you want to delete this expense type? [Status ID : "+data_id+"]"))
        	
                    var url =  "lms_expense_type_db_actionindex.php";
                    jQuery.ajax({
                          url: url,
                          type: 'post',
                          data: 'action=3&inc_id='+inc_id,
                          success: function (response) {
                            if(response ==1)
                            {
                                //jQuery(this).parents("tr").remove();
                                //jQuery(".add-new").removeAttr("disabled");
                                jQuery("#tr_id_"+inc_id).remove();
                                jQuery(".add-new").removeAttr("disabled");
                                alert("Expense Type deleted successfully.");
                               
                            }
                            else
                            {  
                               alert("Expense Type not deleted."); 
                            }
                          }
                    });	
        }
        else
        {
            if(confirm("Do you want to delete this row?"))
            {
                jQuery("#tr_id_0").remove();
                jQuery(".add-new").removeAttr("disabled");   
            }
        }  
     }
     
     ////////////  disposal nature   ////////////////
     
  function disp_nature_add_field()

    {    
    
        $('[data-toggle="tooltip"]').tooltip();
    	//var actions = $("table td:last-child").html(); 
        
        var actions = '<td style="text-align: center;">' +
        							'<a class="add" title="Add" onclick="add_disp_nature_action()" data-toggle="tooltip"> <i class="material-icons">&#xE03B;</i></a>' +
                                    '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
                                    '<a class="delete" title="Delete" data-toggle="tooltip" onclick="case_cat_delete(0)"><i class="material-icons">&#xE872;</i></a>' +
                                '</td>';
        
            jQuery("#add_new_btn").attr("disabled", "disabled");
        	var index = $("table tbody tr:last-child").index();
    
        
            var row = '<tr id="tr_id_0">' +
                '<td><input type="text" class="form-control" name="disp_nat_id" id="disp_nat_id"></td>'+
                '<td><input type="text" class="form-control" name="disp_nat_desc" id="disp_nat_desc"></td>'+actions +
            '</tr>';
                               
            $("#data_tbl").append(row);		
        	$("table tbody tr").eq(index +1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();
            var elmnt = document.getElementById("data_tbl");
            elmnt.scrollIntoView(false);
            
    }
     
  function add_disp_nature_action()
  {
    var disp_nat_id=jQuery("#disp_nat_id").val();
    var disp_nat_desc=jQuery("#disp_nat_desc").val();
    
    //alert(lw_id+'='+lw_name+'='+lw_mob+'='+lw_dist+'='+lw_div+'='+lw_pos+'='+lw_pos_id);
   if(disp_nat_id>0)
    {
        //alert(lmcc_l1+"="+lmcc_l2+"="+lmcc_l3+"="+lmcc_desc1+"="+lmcc_desc2+"="+lmcc_desc3);
        if(confirm("Do you want to add this Disposal Nature?"))
    	{       
                var url =  "lms_disposal_nature_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=1&disp_nat_id='+disp_nat_id+'&disp_nat_desc="'+disp_nat_desc+'"',
                     
                      success: function (response) {
                        if(response>1)
                        {                      
                           jQuery("#tr_id_0").find(".delete").attr('onclick','disposal_nature_delete('+response+')');
                           jQuery("#tr_id_0").prop("id","tr_id_"+response);
                           jQuery("#add_new_btn").attr("disabled", "disabled");
                           jQuery("#add_new_btn").removeAttr("disabled");
                        
                           var elmnt = document.getElementById("data_tbl");
                           elmnt.scrollIntoView(true);
                           alert('Disposal nature added successfully.');
                        }
                        else
                        {   
                           alert("Disposal nature not added."); 
                        }
                      }
                });	
    	}
    }
    
  }   
  
  function edit_disposal_nature_action(lmet_data_id)
{
    var lmt_data_id=lmet_data_id;
    var lmt_disp_id=jQuery("#edit_0").val();
    var lmt_disp_desc=jQuery("#edit_1").val();
  
  
    //alert(lmt_data_id+'='+lmt_disp_id+'='+lmt_disp_desc); 
   if(lmt_data_id>0)
     
    {     
     
        if(confirm("Do you want to update this data?"))
    	{    
                var url =  "lms_disposal_nature_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=2&lmt_data_id='+lmt_data_id+'&lmt_disp_id='+lmt_disp_id+'&lmt_disp_desc="'+lmt_disp_desc+'"',
                      success: function (response) { 
                        if(response==1)
                        {                                               
                            
                            $("#data_tbl").parents("tr").find(".add, .edit").toggle();
	                    	$(".add-new").attr("disabled", "disabled");
                            alert('Data Updated successfully.');                           
                        }
                        else
                        {  
                           
                           alert("Data not Updated."); 
                        }
                      }
                });	
    	}
    }

}
  
  
    function disposal_nature_delete(inc_id,data_id)
    {
        if(inc_id>0)
        {    
            if(confirm("Do you want to delete this expense type? [Status ID : "+data_id+"]"))
        	
                    var url =  "lms_disposal_nature_db_actionindex.php";
                    jQuery.ajax({
                          url: url,
                          type: 'post',
                          data: 'action=3&inc_id='+inc_id,
                          success: function (response) {
                            if(response ==1)
                            {
                                //jQuery(this).parents("tr").remove();
                                //jQuery(".add-new").removeAttr("disabled");
                                jQuery("#tr_id_"+inc_id).remove();
                                jQuery(".add-new").removeAttr("disabled");
                                alert("Expense Type deleted successfully.");
                               
                            }
                            else
                            {  
                               alert("Expense Type not deleted."); 
                            }
                          }
                    });	
        }
        else
        {
            if(confirm("Do you want to delete this row?"))
            {
                jQuery("#tr_id_0").remove();
                jQuery(".add-new").removeAttr("disabled");   
            }
        }  
     }


 