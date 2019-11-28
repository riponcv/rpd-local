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
</head>
<body>
<div class="container">
	<!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <h4><a href="<?php echo site_url('oadmin'); ?>">Dashboard</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>ISS Entry
                    <small>Date</small>
                    <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New Date</a></div>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Entry Date</th>
                        <th>Entry Start Date</th>
                        <th>Entry End Date</th>
                        <th>Certificate End Date</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit ISS Entry Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ID</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_id_edit" id="issdate_id_edit" class="form-control" placeholder="ID" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Entry Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_entry_edit" id="issdate_entry_edit" class="datetimepicker form-control" placeholder="Entry Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Start Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_sdate_edit" id="issdate_sdate_edit" class="datetimepickerOt form-control" placeholder="Start Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">End Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_endate_edit" id="issdate_endate_edit" class="datetimepickerOt form-control" placeholder="End Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Certificate End Date</label>
                            <div class="col-md-10">
                              <input type="text" name="issdate_cerendate_edit" id="issdate_cerendate_edit" class="datetimepickerOt form-control" placeholder="Certificate End Date">
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
                    <input type="hidden" name="issdate_id_delete" id="issdate_id_delete" class="form-control">
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
  format:'d-M-Y',
  inline:false
});

jQuery('.datetimepickerOt').datetimepicker({
  format:'Y-m-d',
  inline:false
});

    $(document).ready(function(){
        show_product(); //call function show all product

        $('#mydata').dataTable();

        //function show all product
        function show_product(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('oadmin/issdate_data'); ?>',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+data[i].id+'</td>'+
                                '<td>'+data[i].ISSEntryDate+'</td>'+
                                '<td>'+data[i].stDate+'</td>'+
                                '<td>'+data[i].endDate+'</td>'+
                                '<td>'+data[i].CerendDate+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-issdate_id="'+data[i].id+'" data-issdate_entry="'+data[i].ISSEntryDate+'" data-issdate_start="'+data[i].stDate+'" data-issdate_edate="'+data[i].endDate+'" data-issdate_cerendate="'+data[i].CerendDate+'">Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-issdate_id="'+data[i].id+'">Delete</a>'+
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
                url  : "<?php echo site_url('oadmin/issdate_save'); ?>",
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
                    show_product();
                }
            });
            return false;
            }
            else {
                alert("Plrase Select Entry Date");
            }

        });

        //get data for update record
        $('#show_data').on('click','.item_edit',function(){
            var issdate_id_val = $(this).data('issdate_id');
            var issdate_entry_val = $(this).data('issdate_entry');
            var issdate_start_val        = $(this).data('issdate_start');
            var issdate_edate_val        = $(this).data('issdate_edate');
            var issdate_cerendate_val        = $(this).data('issdate_cerendate');

            $('#Modal_Edit').modal('show');
            $('[name="issdate_id_edit"]').val(issdate_id_val);
            $('[name="issdate_entry_edit"]').val(issdate_entry_val);
            $('[name="issdate_sdate_edit"]').val(issdate_start_val);
            $('[name="issdate_endate_edit"]').val(issdate_edate_val);
            $('[name="issdate_cerendate_edit"]').val(issdate_cerendate_val);
        });

        //update record to database
         $('#btn_update').on('click',function(){
            var issdate_id_edit_Val         = $('#issdate_id_edit').val();
            var issdate_entry_edit_Val      = $('#issdate_entry_edit').val();
            var issdate_sdate_edit_Val      = $('#issdate_sdate_edit').val();
            var issdate_endate_edit_Val     = $('#issdate_endate_edit').val();
            var issdate_cerendate_edit_Val  = $('#issdate_cerendate_edit').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('oadmin/issdate_update'); ?>",
                dataType : "JSON",
                data : {
                    issdate_id_edit_Val:issdate_id_edit_Val,
                    issdate_entry_edit_Val:issdate_entry_edit_Val,
                    issdate_sdate_edit_Val:issdate_sdate_edit_Val,
                    issdate_endate_edit_Val:issdate_endate_edit_Val,
                    issdate_cerendate_edit_Val:issdate_cerendate_edit_Val},
                success: function(data){
                    $('[name="issdate_id_edit"]').val("");
                    $('[name="issdate_entry_edit"]').val("");
                    $('[name="issdate_sdate_edit"]').val("");
                    $('[name="issdate_endate_edit"]').val("");
                    $('[name="issdate_cerendate_edit"]').val("");
                    $('#Modal_Edit').modal('hide');
                    show_product();
                }
            });
            return false;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var issdate_id_val = $(this).data('issdate_id');

            $('#Modal_Delete').modal('show');
            $('[name="issdate_id_delete"]').val(issdate_id_val);
        });

        //delete record to database
         $('#btn_delete').on('click',function(){
            var issdate_id_delete_val = $('#issdate_id_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('oadmin/issdate_delete'); ?>",
                dataType : "JSON",
                data : {issdate_id_delete_val:issdate_id_delete_val},
                success: function(data){
                    $('[name="issdate_id_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    show_product();
                }
            });
            return false;
        });

    });

</script>
</body>
</html>