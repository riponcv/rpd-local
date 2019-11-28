          
          
          <?php
           $this->load->view('lms/lms_master_data_entry/menu');
          ?>
    
           <link rel="stylesheet" href="<?php echo base_url().'/assetsLms/css/admin/'?>dataTables.bootstrap4.css"/>
           <link rel="stylesheet" href="<?php echo base_url().'/assetsLms/css/admin/'?>jquery.dataTables.css"/>
    
   
            
            
         <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Case Category</h2></div>
                    <div class="col-sm-4">
                        <button type="button" id="add_new_btn" class="btn btn-info add-new" onclick="case_cat_add_field();"><i class="fa fa-plus"></i> Add New</button>
                        <!--<button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>-->
                    </div>
                </div>
            </div>
            
            
            <table class="table table-bordered" id="data_tbl">
                <thead>
                    <tr>
                        <th style="text-align: center;"width="8%" >L1.</th>
                        <th style="text-align: center;" width="25%">L1 Desc.</th>
                        <th style="text-align: center;" width="8%" >L2.</th>
                        <th style="text-align: center;" width="20%">Desc 2.</th>
                        <th style="text-align: center;" width="7%">L3.</th>
                        <th style="text-align: center;" width="30%">Desc L3</th>
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
                      <tr id="tr_id_<?php echo $row['lmcc_data_id']; ?>">
                            <td style="text-align: center;"><?php echo $row['lmcc_cc_id_l1']; ?></td> 
                            <td style="text-align: left;"><?php echo $row['lmcc_cc_desc_l1']; ?></td>  
                            <td style="text-align: left;"><?php echo $row['lmcc_cc_id_l2']; ?></td> 
                            <td style="text-align: left;"><?php echo $row['lmcc_cc_desc_l2']; ?></td> 
                            <td style="text-align: left;"><?php echo $row['lmcc_cc_id_l3']; ?></td> 
                            <td style="text-align: left;"><?php echo $row['lmcc_cc_desc_l3']; ?></td> 
                            <input type="hidden" name="hidden" id="hidden" value="<?php echo $row['lmcc_data_id']?>"/>
                            <td style="text-align: center;">
    							<a class="add" title="Add" data-toggle="tooltip" onclick="edit_case_cat_action(<?php echo $row['lmcc_data_id']; ?>)"> <i class="material-icons">&#xE03B;</i></a>
                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a class="delete" title="Delete" data-toggle="tooltip" onclick="case_cat_delete(<?php echo $row['lmcc_data_id']; ?>)"><i class="material-icons">&#xE872;</i></a>
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
  