<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Bootstrap Table with Add and Delete Row Feature</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    body {
        color: #404E67;
        background: #F5F7FA;
		font-family: 'Open Sans', sans-serif;
	}
	.table-wrapper {
		width: 700px;
		margin: 30px auto;
        background: #fff;
        padding: 20px;	
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
		height: 30px;
		font-weight: bold;
		font-size: 12px;
		text-shadow: none;
		min-width: 100px;
		border-radius: 50px;
		line-height: 13px;
    }
	.table-title .add-new i {
		margin-right: 4px;
	}
    table.table {
        table-layout: fixed;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
		cursor: pointer;
        display: inline-block;
        margin: 0 5px;
		min-width: 24px;
    }    
	table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table td a.add i {
        font-size: 24px;
    	margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
	table.table .form-control.error {
		border-color: #f50000;
	}
	table.table td .add {
		display: none;
	}
</style>
<script type="text/javascript">
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
            '<td><input type="text" class="form-control" name="court_type_id" id="court_type_id"></td>' +
            '<td><input type="text" class="form-control" name="court_type_name" id="court_type_name"></td>' + actions +
        '</tr>';
    
	$("#data_tbl").append(row);		
	$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
    $('[data-toggle="tooltip"]').tooltip();
    
    var elmnt = document.getElementById("data_tbl");
    elmnt.scrollIntoView(false);
    
}

 function add_court_type_action()
{   
    var court_id=jQuery("#court_type_id").val();
    var court_type_name=jQuery("#court_type_name").val();    
    
    if(court_id>0)
    {     
        if(confirm("Do you want to add this court type?"))
    	{       
                var url =  "lms_court_type_db_actionindex.php";
                jQuery.ajax({
                      url: url,
                      type: 'post',
                      data: 'action=1&court_id='+court_id+'&court_type_name="'+court_type_name+'"',
                      success: function (response) { 
                        if(response ==1)
                        {                           
                           jQuery("#tr_id_0").find(".delete").attr('onclick','court_type_delete_action('+court_id+')');
                           jQuery("#tr_id_0").prop("id","tr_id_"+court_id);
                           jQuery("#add_new_btn").attr("disabled", "disabled");
                           jQuery("#add_new_btn").removeAttr("disabled");
                           
                           var elmnt = document.getElementById("data_tbl");
                           elmnt.scrollIntoView(true);
                           
                           alert('Court type added successfully.');
                           
                        }
                        else
                        {
                           alert("Court type not added."); 
                        }
                      }
                });	
    	}
    }

}

</script>
</head>

<!--https://www.tutorialrepublic.com/codelab.php?topic=bootstrap&file=table-with-add-and-delete-row-feature-->
<body>
       
    
     
   
            
            
         <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Court Type</h2></div>
                    <div class="col-sm-4">
                        <button type="button" id="add_new_btn" class="btn btn-info add-new" onclick="court_type_add_field();"><i class="fa fa-plus"></i> Add New</button>
                        <!--<button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>-->
                    </div>
                </div>
            </div>
            
            
            <table class="table table-bordered" id="data_tbl">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="20%">Court Type No.</th>
                        <th style="text-align: center;">Court Type Name</th>
                        
                        <th style="text-align: center;"  width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    if(!empty($lms_court_types_data))
                    {
                       foreach($lms_court_types_data as $row)
                     {
                      ?>                        
                      <tr id="tr_id_<?php echo $row['lmct_ct_id']; ?>">
                            <td style="text-align: center;"><?php echo $row['lmct_ct_id']; ?></td> 
                            <td style="text-align: left;"><?php echo $row['lmct_ct_desc']; ?></td>  
                    
                            <td style="text-align: center;">
    							<a class="add" title="Add" data-toggle="tooltip"> <i class="material-icons">&#xE03B;</i></a>
                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a class="delete" title="Delete" data-toggle="tooltip" onclick="court_type_delete_action(<?php echo $row['lmct_ct_id']; ?>)"><i class="material-icons">&#xE872;</i></a>
                            </td>
                           
                        </tr>
                    
                   <?php
                   }}
                   else
                   {
                    ?><tr> <td>Currently no court type is added....</td>  </tr> 
                    <?php 
                    } 
                    ?>

                        </tbody>
                        
                    </table>
                </div>
            </div>    
      
</body>
</html>     