<style>
.basic_info_content {
    background-color: powderblue;
    padding: 0px 15px;
}
</style>
<div class="container">
<?php
// print_r($lms_master_data_view);

?>
<h4>MASTER DATA ENTRY</h4>
    <div class="basic_info_content">
    
        <?php
           $this->load->view('lms/lms_master_data_entry/menu');
         ?>  
    
    <form action="" method="post">
    <fieldset class="border p-2">
        <div class="row">
            <table class="table table-sm table-borderless" id="search_form_table_n">
                <tbody>
                                        
                    
                   
                  <!--  <div class="form-group">
                        <td><label for="caseCategory">Master Data Category</label></td>
                        <td>
                            <select name="masterdatacatN" class="choseSelect caseCategoryC" id="caseCategory">
                            <option value="0">Select Master Data Category</option>
                            <?php 
                                foreach($lms_master_data_view as $lms_master_data_view)
                                {
                                    $cCselect='';
                                    if(isset($_POST['masterdatacatN']) && $_POST['masterdatacatN']==$lms_master_data_view->mast_cat_id)
                                    {
                                        $cCselect="selected='selected'";
                                    }
                            ?>
                                <option value="<?php echo isset($lms_master_data_view->mast_cat_id)?$lms_master_data_view->mast_cat_id:''; ?>" <?php echo isset($cCselect)?$cCselect:''; ?> >
                                <?php echo isset($lms_master_data_view->mast_cat_name)?$lms_master_data_view->mast_cat_name:''; ?>
                                </option>
                            <?php } ?>*>
                            </select>
                        </td> 
                    </div>
                   -->
                  
                   
                                     
                                
                </tbody>
            </table>
        </div>
        </fieldset>
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <!--<td><button type="submit" class="btn">Submit</button></td>-->
                    
                    </tr>  
            </tbody>
        </table>
    </form>
    
    
    
    
    </div>
</div>
