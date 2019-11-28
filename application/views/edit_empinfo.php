<style type="text/css">
	.prevImage {
        width: 160px;
        height: 160px;
    }
  #view_image {
    FILTER: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)
  } 
</style>

<script type="text/javascript">	
function handleFiles(files) { 
  for (var i = 0; i < files.length; i++) {  
    var file = files[i];  
    var imageType = /image.*/;  
      
    if (!file.type.match(imageType)) {  
      continue;  
    }  
      
    var img = document.createElement("img");  
    img.classList.add("prevImage");  
    img.file = file;  
	
	document.getElementById('view_image').innerHTML='';
	document.getElementById('view_image').appendChild(img);

    var reader = new FileReader();  
    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);  
    reader.readAsDataURL(file);  
  }  
}
function readURL(imgFile)
{    
    if(imgFile !='')
	{
		document.getElementById('view_image').src = '';
	}
	var newPreview = document.getElementById("view_image");
    newPreview.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgFile.value;
    newPreview.style.width = "160px";
    newPreview.style.height = "160px";
}	
</script>

<div align="center">

   <?php
    if ($this->session->flashdata('errors'))
	{ 
		echo "<div class='error'>";
		echo '<font color="red">'.$this->session->flashdata('errors').'</font>';
		echo "</div>";
    }
    ?>
    
     <?php
    if ($this->session->flashdata('success'))
	{ 
		echo "<div class='success'>";
		echo '<font color="green" size="+3" style="font-weight:bold">'.$this->session->flashdata('success').'</font>';
		echo "</div>";
    }
    ?>
    
    <?php
    if ($this->session->flashdata('post_value'))
	{ 
		$post=$this->session->flashdata('post_value');
    }
    ?>


<?php
  echo form_open_multipart('empinfo/edit_empinfo_save/'.$employee_data['ei_id']);?>
   <table width="100%" width="500" style="border:1px solid #345688;padding:0;margin:0;">
  <tr>
  <td>

 <table style="text-align:right" border="0" align=center>  
 <tr>
 </tr>
  <tr>
    <td width="232">Full Name</td>
    <td width="3">:</td>
    <td width="144"><input type="text" name="ei_name" id="ei_name" value="<?php echo isset($post['ei_name'])?$post['ei_name']:$employee_data['ei_name']; ?>"></td>
  </tr>
  <tr>
    <td>Designation</td>
    <td>:</td>
    <td>
      <?php $attribute="id='ei_dsg_code'"; ?>
      <?php 
	  $selected_designation='';
	  if(isset($post['ei_dsg_code']))
	  {
	  	$selected_designation=$post['ei_dsg_code'];
	  }
	  else
	  {
	  	 $selected_designation=$employee_data['ei_dsg_code'];
	  } 
	  ?>
      <?php echo form_dropdown('ei_dsg_code',$designation_dropdown,$selected_designation,$attribute) ?> 
      
    </td>
  </tr>
  <tr>
    <td>File No.</td>
    <td>:</td>
    <td><input type="text" name="ei_file_no" id="ei_file_no" value="<?php echo isset($post['ei_file_no'])?$post['ei_file_no']:$employee_data['ei_file_no']; ?>"></td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td>:</td>
    <td><input type="text" name="ei_mob" id="ei_mob" value="<?php echo isset($post['ei_mob'])?$post['ei_mob']:$employee_data['ei_mob']; ?>"></td>
  </tr>
  <tr>
    <td>Education</td>
    <td>:</td>
    <td><input type="text" name="ei_education" id="ei_education" value="<?php echo isset($post['ei_education'])?$post['ei_education']:$employee_data['ei_education']; ?>"></td>
  </tr>
  <tr>
    <td>Subject</td>
    <td>:</td>
    <td><input type="text" name="ei_subject" id="ei_subject" value="<?php echo isset($post['ei_subject'])?$post['ei_subject']:$employee_data['ei_subject']; ?>"></td>
  </tr>
  <tr>
    <td>Posting at</td>
    <td>:</td>
    <td><input type="text" name="ei_jo_code" id="ei_jo_code" value="<?php echo isset($posting_at)?$posting_at:''; ?>" readonly="readonly"></td>
  </tr>
  <tr>
    <td>Date of Birth</td>
    <td>:</td>
    <td><input type="text" name="ei_dob" id="datepicker" value="<?php echo isset($post['ei_dob'])?$post['ei_dob']:$employee_data['ei_dob']; ?>"></td>
  </tr>
  <tr>
    <td>Date of Joined Bank</td>
    <td>:</td>
    <td><input type="text" name="ei_doj_bank" id="datepicker1" value="<?php echo isset($post['ei_doj_bank'])?$post['ei_doj_bank']:$employee_data['ei_doj_bank']; ?>"></td>
  </tr>
  <tr>
    <td>Date of Joined Present Place</td>
    <td>:</td>
    <td><input type="text" name="ei_doj_br" id="datepicker2" value="<?php echo isset($post['ei_doj_br'])?$post['ei_doj_br']:$employee_data['ei_doj_br']; ?>"></td>
  </tr>
  <tr>
    <td>Target A/c</td>
    <td>:</td>
    <td><input type="text" name="ei_target_ac" id="ei_target_ac" value="<?php echo isset($post['ei_target_ac'])?$post['ei_target_ac']:$employee_data['ei_target_ac']; ?>"></td>
  </tr>
  <tr>
    <td>Target Amount</td>
    <td>:</td>
    <td><input type="text" name="ei_target_amgt" id="ei_target_amgt" value="<?php echo isset($post['ei_target_amgt'])?$post['ei_target_amgt']:$employee_data['ei_target_amgt']; ?>"></td>
  </tr>
  <tr>
    <td>PA No.</td>
    <td>:</td>
    <td><input type="text" name="ei_pa_no" id="ei_pa_no" value="<?php echo isset($post['ei_pa_no'])?$post['ei_pa_no']:$employee_data['ei_pa_no']; ?>"></td>
  </tr>
  <tr>
     <td  align="center" colspan="3" >
     <input type="submit" name="submit" id="submit" value="Submit">
     <input type="button" name="cancel" id="cancel" value="Cancel" onclick="window.location.href = '<?php echo base_url().'index.php/empinfo/empview' ?>';">
     </td>
  </tr>
  </table>
  <td>
  <table>
  <tr><td width="160" height="160" style="border:1px solid #345688;padding:0;margin:0;" id="view_image">
  <img src="<?php echo base_url()?>uploads/<?php echo $employee_data['ei_img_url']; ?>" width="160" height="160" class="prevImage"  id="prevImage"/>
  </td></tr>
  <tr><td>  <input type="file" id="input_file_id" name="photo" onchange="if(jQuery.browser.msie){readURL(this)}else{handleFiles(this.files)}"></td></tr>
  </table></td>
  </dt>
 </tr>
  </table>
</form>

 </div> 