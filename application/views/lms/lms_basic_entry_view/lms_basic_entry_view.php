<style>
.basic_info_content_view {
    height: 600px;
}

.basic-view-content ul {
    text-decoration: none;list-style: none;
    margin-top: 100px;
}

.basic-view-content ul li {
    margin-top: 11px;
    margin-left: 250px;
    text-transform: uppercase;
}
</style>
<?php

    if($this->session->flashdata('succlmsbasicMkerInfo'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.'Thanks for Submitted LMS Data and Transaction No. is: '.$this->session->flashdata('succlmsbasicMkerInfo').'</font>'; 
        echo "</div>";
    }
    $attribute = '';
    if((isset($login_status) && $login_status !=4)){
        if(isset($off_id) && $off_id != '9024'){
            $attribute ='disabled="disabled"';
        }
    }
    if((isset($login_status) && $login_status == 4 )||(isset($off_id) && $off_id =='9024')){
    
?>

    <div class="basic_info_content_view">
        <?php 
            $attributesForm = array('name' => 'lmsBasicView', 'id'=>'lms_basic_entry_view');
           // echo form_open('', $attributesForm);
        ?>
            <div class="row">
                <div class="col-lg">
                    <div class="basic-view-content">
                        <ul>
                            <li>
                                <?php
                                    $myClass = array('class' => 'top_parent');
                                    echo anchor('lms/lms_basic_entry_maker', 'Basic Entry', $myClass);
                                ?>
                            </li>
                            <li>
                                <?php
                                    $myClass = array('class' => 'top_parent');
                                    echo anchor('lms/lms_basic_entry_checker_view', 'Authenticate By', $myClass);
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>   
        <?php //echo form_close(); ?>
    </div>
<?php } ?>