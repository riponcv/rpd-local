<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assetsq/css/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assetsq/css/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assetsq/css/dataTables.bootstrap4.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assetsq/css/jquery.datetimepicker.min.css'?>">

    <style>
table.dataTable tbody th, table.dataTable tbody td {
    padding: 0px 0px;
}
.dash-inline ul {
    margin: 0;
    padding: 0;
    list-style: none;
}
.dash-inline ul li {
    display: inline-block;
    padding: 5px 22px;
}
.dash-inline a{
    text-decoration: none;
}
.dash-inline .ref-btn {

    background: #969696;
    color: #fff;
    padding: 2px 21px;
    border-radius: 5px;
}
    </style>
</head>
<body>
<div class="container">
	<!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 dash-inline">
            <ul>
                <li><h4><a href="<?php echo site_url('oadmin'); ?>">Dashboard</a></h4></li>
                <li><h4><a class="ref-btn" href="">Refresh</a></h4></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>User Information System
                    <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New User</a></div>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>SL</th>
                        <!--<th>code</th>-->
                        <th>Desig Code</th>
                        <th>PFile No</th>
                        <th>Full Name</th>
                        <th>Mobile No</th>
                        <th>Office Code</th>
                        <th>Pwd</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
            </table>
        </div>
    </div>
</div>

		<!-- MODAL ADD -->
            <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add ISS Entry Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ID</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_id" id="issdate_id" class="form-control" placeholder="ID">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Entry Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_entry" id="issdate_entry" class="datetimepicker form-control" placeholder="Entry Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Start Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_sdate" id="issdate_sdate" class="datetimepickerOt form-control" placeholder="Start Date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">End Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_endate" id="issdate_endate" class="datetimepickerOt form-control" placeholder="End Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Certificate End Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_cerendate" id="issdate_cerendate" class="datetimepickerOt form-control" placeholder="Certificate End Date">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">User Code</label>
                            <div class="col-md-10">
                              <input type="text" name="ui_code_edit" id="ui_code_edit" class="form-control" placeholder="ID" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Designation Code</label>
                            <div class="col-md-10">
                                <select name="ui_Desig_Code_edit" id="ui_Desig_Code_edit" class="form-control">
                                    <option value="">Select Designation</option>
                                    <option value="0001">Deputy Managing Director</option>
                                    <option value="0002">General Manager</option>
                                    <option value="0003">Deputy General Manager</option>
                                    <option value="0004">Assistant General Manager</option>
                                    <option value="0005">Senior Principal Officer</option>
                                    <option value="0006">Principal Officer</option>
                                    <option value="0007">Senior Officer</option>
                                    <option value="0008">Officer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Personal File No.</label>
                            <div class="col-md-10">
                              <input type="text" name="ui_PFile_No_edit" id="ui_PFile_No_edit" class="form-control" placeholder="Personal File No">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                              <input type="text" name="ui_Full_Name_edit" id="ui_Full_Name_edit" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Mobile No.</label>
                            <div class="col-md-10">
                              <input type="text" name="ui_Mobile_No_edit" id="ui_Mobile_No_edit" class="form-control" placeholder="Mobile No.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Branch/Office Code</label>
                            <div class="col-md-10">
                              <input type="text" name="ui_Posting_Office_Code_edit" id="ui_Posting_Office_Code_edit" class="form-control" placeholder="Branch/Office Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                              <input type="text" name="ui_Email_edit" id="ui_Email_edit" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">DoB</label>
                            <div class="col-md-10">
                              <input type="text" name="ui_dob_edit" id="ui_dob_edit" class="datetimepicker form-control" placeholder="Date of Birth">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Status</label>
                            <div class="col-md-10">
                              <select name="ui_isPermit_edit" id="ui_isPermit_edit" class="form-control">
                                    <option value=" ">--select--</option>
                                    <option value="0">Un-Authenticated</option>
                                    <option value="1">Authenticated</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->

        <!--MODAL DELETE-->
         <form>
            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete ISS Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="user_id_delete" id="user_id_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->


<script type="text/javascript" src="<?php echo base_url().'assetsq/js/jquery-3.2.1.js'?>"></script>

<script type="text/javascript" src="<?php echo base_url().'assetsq/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assetsq/js/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assetsq/js/dataTables.bootstrap4.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assetsq/js/jquery.datetimepicker.full.min.js'?>"></script>

<script type="text/javascript">
jQuery('.datetimepicker').datetimepicker({
  format:'Y-m-d',
  inline:false
});

jQuery('.datetimepickerOt').datetimepicker({
  format:'Y-m-d',
  inline:false
});

    $(document).ready(function(){
        show_user(); //call function show all product

        $('#mydata').dataTable();

        //function show all product
        function show_user(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('oadmin/user_data'); ?>',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                //'<td>'+data[i].ui_code+'</td>'+
                                '<td>'+data[i].ui_Desig_Code+'</td>'+
                                '<td>'+data[i].ui_PFile_No+'</td>'+
                                '<td>'+data[i].ui_Full_Name+'</td>'+
                                '<td>'+data[i].ui_Mobile_No+'</td>'+
                                '<td>'+data[i].ui_Posting_Office_Code+'</td>'+
                                '<td>'+data[i].ui_Pwd+'</td>'+
                                '<td>'+data[i].ui_Email+'</td>'+
                                '<td>'+data[i].ui_dob+'</td>'+
                                '<td>'+data[i].ui_isPermit+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm user_item_edit" data-user_desig_code="'+data[i].ui_Desig_Code+'" data-user_pfile_no="'+data[i].ui_PFile_No+'" data-user_full_name="'+data[i].ui_Full_Name+'" data-user_mobile_no="'+data[i].ui_Mobile_No+'" data-user_posting_office_code="'+data[i].ui_Posting_Office_Code+'" data-user_pwd="'+data[i].ui_Pwd+'" data-user_email="'+data[i].ui_Email+'" data-user_dob="'+data[i].ui_dob+'" data-user_ispermit="'+data[i].ui_isPermit+'" data-user_code="'+data[i].ui_code+'">Edit</a>'+
                                    ' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-user_code="'+data[i].ui_code+'">Delete</a>'+
                                '</td>'+
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }

        //Save product
        $('#btn_save').on('click',function(){
            var issdate_id_val        = $('#issdate_id').val();
            var issdate_entry_val     = $('#issdate_entry').val();
            var issdate_sdate_val     = $('#issdate_sdate').val();
            var issdate_endate_val    = $('#issdate_endate').val();
            var issdate_cerendate_val = $('#issdate_cerendate').val();

            if(issdate_entry_val != "" && issdate_sdate_val != "" && issdate_endate_val != "" && issdate_cerendate_val != ""){
                 $.ajax({
                type : "POST",
                url  : "<?php echo site_url('oadmin/user_save'); ?>",
                dataType : "JSON",
                data : {
                        issdate_id_val:issdate_id_val ,
                        issdate_entry_val:issdate_entry_val,
                        issdate_sdate_val:issdate_sdate_val,
                        issdate_endate_val:issdate_endate_val,
                        issdate_cerendate_val:issdate_cerendate_val},
                success: function(data){
                    $('[name="issdate_id"]').val("");
                    $('[name="issdate_entry"]').val("");
                    $('[name="issdate_sdate"]').val("");
                    $('[name="issdate_endate"]').val("");
                    $('[name="issdate_cerendate"]').val("");
                    $('#Modal_Add').modal('hide');
                    show_user();
                }
            });
            return false;
            }
            else {
                alert("Plrase Select Entry Date");
            }

        });

        //get data for update record
        $('#show_data').on('click','.user_item_edit',function(){
            var ui_code_val = $(this).data('user_code');
            var user_desig_code_val   = $(this).data('user_desig_code');
            var ui_PFile_No_val        = $(this).data('user_pfile_no');
            var ui_Full_Name_val        = $(this).data('user_full_name');
            var ui_Mobile_No_val        = $(this).data('user_mobile_no');
            var ui_Posting_Office_Code_val        = $(this).data('user_posting_office_code');
            var ui_Email_val        = $(this).data('user_email');
            var ui_dob_val        = $(this).data('user_dob');
            var ui_isPermit_val        = $(this).data('user_ispermit');


            $('#Modal_Edit').modal('show');
            $('[name="ui_code_edit"]').val(ui_code_val);
            $('[name="ui_Desig_Code_edit"]').val(user_desig_code_val);
            $('[name="ui_PFile_No_edit"]').val(ui_PFile_No_val);
            $('[name="ui_Full_Name_edit"]').val(ui_Full_Name_val);
            $('[name="ui_Mobile_No_edit"]').val(ui_Mobile_No_val);
            $('[name="ui_Posting_Office_Code_edit"]').val(ui_Posting_Office_Code_val);
            $('[name="ui_Email_edit"]').val(ui_Email_val);
            $('[name="ui_dob_edit"]').val(ui_dob_val);
            $('[name="ui_isPermit_edit"]').val(ui_isPermit_val);
        });

        //update record to database
         $('#btn_update').on('click',function(){
            var ui_code_edit_val         = $('#ui_code_edit').val();
            var ui_desig_code_edit_val      = $('#ui_Desig_Code_edit').val();
            var ui_pfile_no_edit_val      = $('#ui_PFile_No_edit').val();
            var ui_full_name_edit_val     = $('#ui_Full_Name_edit').val();
            var ui_mobile_no_edit_val  = $('#ui_Mobile_No_edit').val();
            var ui_office_code_edit_val  = $('#ui_Posting_Office_Code_edit').val();
            var ui_email_edit_val  = $('#ui_Email_edit').val();
            var ui_dob_edit_val  = $('#ui_dob_edit').val();
            var ui_ispermit_edit_val  = $('#ui_isPermit_edit').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('oadmin/user_update'); ?>",
                dataType : "JSON",
                data : {
                    ui_code_edit_val:ui_code_edit_val,
                    ui_desig_code_edit_val:ui_desig_code_edit_val,
                    ui_pfile_no_edit_val:ui_pfile_no_edit_val,
                    ui_full_name_edit_val:ui_full_name_edit_val,
                    ui_mobile_no_edit_val:ui_mobile_no_edit_val,
                    ui_office_code_edit_val:ui_office_code_edit_val,
                    ui_email_edit_val:ui_email_edit_val,
                    ui_dob_edit_val:ui_dob_edit_val,
                    ui_ispermit_edit_val:ui_ispermit_edit_val },
                success: function(data){
                    $('[name="ui_code_edit"]').val("");
                    $('[name="ui_Desig_Code_edit"]').val("");
                    $('[name="ui_PFile_No_edit"]').val("");
                    $('[name="ui_Full_Name_edit"]').val("");
                    $('[name="ui_Mobile_No_edit"]').val("");
                    $('[name="ui_Posting_Office_Code_edit"]').val("");
                    $('[name="ui_Email_edit"]').val("");
                    $('[name="ui_dob_edit"]').val("");
                    $('[name="ui_isPermit_edit"]').val("");
                    $('#Modal_Edit').modal('hide');
                    show_user();
                }
            });
            return false;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var user_code_val = $(this).data('user_code');

            $('#Modal_Delete').modal('show');
            $('[name="user_id_delete"]').val(user_code_val);
        });

        //delete record to database
         $('#btn_delete').on('click',function(){
            var user_id_delete_val = $('#user_id_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('oadmin/user_delete'); ?>",
                dataType : "JSON",
                data : {user_id_delete_val:user_id_delete_val},
                success: function(data){
                    $('[name="user_id_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    show_user();
                }
            });
            return false;
        });

    });

</script>
</body>
</html>