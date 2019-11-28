
         
         <?php
           $this->load->view('lms/lms_master_data_entry/menu');
         ?>
          
          <link rel="stylesheet" href="<?php echo base_url().'/assetsLms/css/admin/'?>dataTables.bootstrap4.css"/>
          <link rel="stylesheet" href="<?php echo base_url().'/assetsLms/css/admin/'?>jquery.dataTables.css"/>
            
         <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Disposal Nature</h2></div>
                    <div class="col-sm-4">
                        <button type="button" id="add_new_btn" class="btn btn-info add-new" onclick="disp_nature_add_field();"><i class="fa fa-plus"></i> Add New</button>
                        <!--<button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>-->
                    </div>
                </div>
            </div>
            
            
            <table class="table table-bordered" id="data_tbl">
                <thead>
                    <tr>
                        <th style="text-align: center;"width="15%" >Disposal_id</th>
                        <th style="text-align: center;" width="40%">Disposal description</th>
                        <th style="text-align: center;"  width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    if(!empty($view_info))
                    {
                       foreach($view_info as $row)
                     {
                      ?>                        
                      <tr id="tr_id_<?php echo $row['lmdn_data_id']; ?>">
                            <td style="text-align: center;"><?php echo $row['lmdn_dn_id']; ?></td> 
                            <td style="text-align: left;"><?php echo $row['lmdn_dn_desc']; ?></td>  
                            <td style="text-align: center;">
    							<a class="add" title="Add" data-toggle="tooltip" onclick="edit_disposal_nature_action(<?php echo $row['lmdn_data_id']; ?>)"> <i class="material-icons">&#xE03B;</i></a>
                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a class="delete" title="Delete" data-toggle="tooltip" onclick="disposal_nature_delete(<?php echo $row['lmdn_data_id']; echo ","; echo $row['lmdn_dn_id']; ?>)"><i class="material-icons">&#xE872;</i></a>
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
                    
                   
                    <script src="<?php echo base_url().'assetsLms/js/admin/'?>jquery.dataTables.js"></script>
                    <script src="<?php echo base_url().'assetsLms/js/admin/'?>dataTables.bootstrap4.js"></script>
                    
                    
                   <script type="text/javascript">
                                          
                         $(document).ready(function(){
                                  $("#data_tbl").dataTable();
                                   });
                                   
                   </script> 
                    
                </div>
                
                
            </div>    
  