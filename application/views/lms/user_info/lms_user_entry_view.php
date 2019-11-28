<?php
$attribute = '';
// echo "<pre>";
// print_r($lmsUser);
// die();
?>

<div class="container">
   <div class="basic_info_content">
    <?php 
        $attributesForm = array('name' => 'lmsBasicEditForm', 'id'=>'');
        echo form_open_multipart('lms/', $attributesForm);
    ?>
    
        <div class="header-info text-center">
            <h4>Search for Edit Outstanding </h4>
        </div>
    <?php if(isset($lmsUser) && !empty($lmsUser)) { ?>
    
    <table class="table table-bordered" border="1" id="mydata">
        <thead>
            <tr>
                <th>Office Code</th>
                <th>Office Name</th>
                <th>File No</th>
                <th>Module Access Date</th>
            </tr>
        </thead>
        <?php foreach($lmsUser as $user) { ?>
            <tr>
                <td><?php echo isset($user->lms_office_id)?$user->lms_office_id:''; ?></td>
                <td><?php echo isset($user->office_name)?$user->office_name:''; ?></td>
                <td><?php echo isset($user->lms_user_id)?$user->lms_user_id:''; ?></td>
                <td><?php echo date('d/m/Y', strtotime(isset($user->lms_user_date)?$user->lms_user_date:'')); ?></td>
            </tr>
        <?php } ?>
    </table>
    </div> 
    <?php echo form_close(); ?>
    <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
            No Record found.
        </div>
    <?php } ?>
</div>