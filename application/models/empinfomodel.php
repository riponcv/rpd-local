<?php
class Empinfomodel extends CI_Model {
	var $ei_id ='';
	var $ei_file_no ='';
	var $ei_pa_no ='';
	var $ei_name ='';
	var $ei_mob ='';
	var $ei_education ='';
	var $ei_subject ='';
	var $ei_jo_code ='';
	var $ei_doj_br ='';
	var $ei_doj_bank ='';
	var $ei_dob ='';
	var $ei_last_login_dt ='';
	var $ei_target_ac ='';
	var $ei_target_amgt ='';
	
	 function empinfo_get($pfno)
	 {
	 	 $query = $this->db->query("SELECT * FROM DMS_emp Where ltrim(rtrim(ei_file_no))='".$pfno."'");
	 	
		if($query->num_rows()>0)
		{
			foreach( $query->result_array() as $row )
			{
				    $this->ei_id = $row['ei_id'];
				    $this->ei_file_no = $row['ei_file_no'];
					$this->ei_pa_no = $row['ei_pa_no'];
					$this->ei_name = $row['ei_name'];
					$this->ei_mob = $row['ei_mob'];
					$this->ei_education = $row['ei_education'];
					$this->ei_subject = $row['ei_subject'];
					$this->ei_jo_code = $row['ei_jo_code'];
					$this->ei_doj_br = $row['ei_doj_br'];
					$this->ei_doj_bank = $row['ei_doj_bank'];
					$this->ei_dob = $row['ei_dob'];
					$this->ei_last_login_dt = $row['ei_last_login_dt'];
					$this->ei_target_ac = $row['ei_target_ac'];
					$this->ei_target_amgt = $row['ei_target_amgt'];
			}	
		}
	
	 }
	 
	 function empinfo_insert($uploaded_image_path='')
	 {
	 $data = array(
	 		 		
				    'ei_file_no'=>$this->input->post('ei_file_no'),
					'ei_dsg_code'=>$this->input->post('ei_dsg_code'),
					'ei_pa_no'=>$this->input->post('ei_pa_no'),
					'ei_name'=>$this->input->post('ei_name'),
					'ei_mob'=>$this->input->post('ei_mob'),
					'ei_education'=>$this->input->post('ei_education'),
					'ei_subject'=>$this->input->post('ei_subject'),
					'ei_jo_code'=>$this->input->post('ei_jo_code'),
					'ei_doj_br'=>$this->input->post('ei_doj_br'),
					'ei_doj_bank'=>$this->input->post('ei_doj_bank'),
					'ei_dob'=>$this->input->post('ei_dob'),
					'ei_last_login_dt'=>$this->input->post('ei_last_login_dt'),
					'ei_target_ac'=>(int)$this->input->post('ei_target_ac'),
					'ei_img_url'=>$uploaded_image_path,
					'ei_target_amgt'=>(float)$this->input->post('ei_target_amgt')
				);
				 
	 	$this->db->insert('dms_emp', $data);
	 }
	 
	 function empinfo_edit($id=0,$uploaded_image_path='')
	 {
		 if($uploaded_image_path=='')
		 {
			 $data = array(
					
					'ei_file_no'=>$this->input->post('ei_file_no'),
					'ei_dsg_code'=>$this->input->post('ei_dsg_code'),
					'ei_pa_no'=>$this->input->post('ei_pa_no'),
					'ei_name'=>$this->input->post('ei_name'),
					'ei_mob'=>$this->input->post('ei_mob'),
					'ei_education'=>$this->input->post('ei_education'),
					'ei_subject'=>$this->input->post('ei_subject'),
					'ei_jo_code'=>$this->input->post('ei_jo_code'),
					'ei_doj_br'=>$this->input->post('ei_doj_br'),
					'ei_doj_bank'=>$this->input->post('ei_doj_bank'),
					'ei_dob'=>$this->input->post('ei_dob'),
					'ei_last_login_dt'=>$this->input->post('ei_last_login_dt'),
					'ei_target_ac'=>(int)$this->input->post('ei_target_ac'),
					'ei_target_amgt'=>(float)$this->input->post('ei_target_amgt')
				);
		 }
		 else
		 {
			 $data = array(
					
					'ei_file_no'=>$this->input->post('ei_file_no'),
					'ei_dsg_code'=>$this->input->post('ei_dsg_code'),
					'ei_pa_no'=>$this->input->post('ei_pa_no'),
					'ei_name'=>$this->input->post('ei_name'),
					'ei_mob'=>$this->input->post('ei_mob'),
					'ei_education'=>$this->input->post('ei_education'),
					'ei_subject'=>$this->input->post('ei_subject'),
					'ei_jo_code'=>$this->input->post('ei_jo_code'),
					'ei_doj_br'=>$this->input->post('ei_doj_br'),
					'ei_doj_bank'=>$this->input->post('ei_doj_bank'),
					'ei_dob'=>$this->input->post('ei_dob'),
					'ei_last_login_dt'=>$this->input->post('ei_last_login_dt'),
					'ei_target_ac'=>(int)$this->input->post('ei_target_ac'),
					'ei_img_url'=>$uploaded_image_path,
					'ei_target_amgt'=>(float)$this->input->post('ei_target_amgt')
				);
		 }
		$this->db->where('ei_id', $id);
		$this->db->update('dms_emp', $data);
	 }
	 
	 function empinfo_get_by_office($ei_jo_code='')
	 {
	 	 $query = $this->db->query("SELECT * FROM DMS_emp Where ltrim(rtrim(ei_jo_code))='".$ei_jo_code."'");
	 	
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return 'Data not Found';
		}
	
	 }
}
