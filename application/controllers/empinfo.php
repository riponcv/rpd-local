<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empinfo extends CI_Controller {

	public function index()
	{
		$data['isde']='dvcontent_dataentry';
		$data['content']='empinfo';
		$data['logout']='home/logout';
		
		$this->load->view('home',$data);
		/*
		$data['content']=('dms/deposit_view');
		$data['title']="Core Deposit Monitoring System Form";
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$this->load->view('home',$data);
		*/
		
	}
	
	public function create()
	{
		
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
		{
			$this->form_validation->set_rules('ei_name', 'Employee Full Name', 'required');
			$this->form_validation->set_rules('ei_dsg_code', 'Employee Designation', 'required');
			$this->form_validation->set_rules('ei_file_no', 'File No.', 'required|mix_alpha_numeric_only');
			$this->form_validation->set_rules('ei_mob', 'Mobile', 'required');
			$this->form_validation->set_rules('ei_education', 'Education', 'required');
			$this->form_validation->set_rules('ei_subject', 'Subject', 'required');
			
			$this->form_validation->set_rules('ei_jo_code', 'Posting at', 'required');
			$this->form_validation->set_rules('ei_dob', 'Date of Birth', 'required');
			$this->form_validation->set_rules('ei_doj_bank', 'Date of Joined Bank', 'required');
			$this->form_validation->set_rules('ei_doj_br', 'Date of Joined Present Place', 'required');
						
			$this->form_validation->set_rules('ei_target_ac', 'Target A/c', 'required|numeric');
			$this->form_validation->set_rules('ei_target_amgt', 'Target Amount', 'required|numeric');
			$this->form_validation->set_rules('ei_pa_no', 'PA No', 'required|numeric');
			
			
			if ($this->form_validation->run() == FALSE)
			{				
				$this->session->set_flashdata('post_value', $_POST);
				$this->session->set_flashdata('errors', validation_errors());
				redirect('rpd/empinfo');
			}
			else
			{
			
				if(isset($_FILES['photo']) && $_FILES['photo']['error']==0)
				{
					
					$this->load->library('upload');
					
					$config['upload_path'] =   'uploads/';
					$config['allowed_types'] = '*';
					$config['max_size']	= '1000000';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['file_name']  = time().'_'.$_POST['ei_file_no'];
			
					$this->upload->initialize($config);
			
					if ( ! $this->upload->do_upload('photo'))
					{
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('errors', $error);
						redirect('rpd/empinfo');
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						
						$uploaded_image_path='';
						if(isset($data) && !empty($data))
						{
							$uploaded_image_path=$data['upload_data']['file_name'];
						}
			
						$this->load->model('empinfomodel');
						$this->empinfomodel->empinfo_insert($uploaded_image_path);
						
						$this->session->set_flashdata('success', 'Employee Information have been saved successfully.');
						redirect('empinfo/empview');
					}
				}
				else
				{
						$this->session->set_flashdata('errors', 'Please Select a photo.');
						redirect('rpd/empinfo');
				}
			
			}
		}
	
	}
	
	//edit emp_info
	public function edit_empinfo_save($id=0)
	{
				
		if(isset($_POST['submit']) && $_POST['submit']=='Submit')
		{
			$this->form_validation->set_rules('ei_name', 'Employee Full Name', 'required');
			$this->form_validation->set_rules('ei_dsg_code', 'Employee Designation', 'required');
			$this->form_validation->set_rules('ei_file_no', 'File No.', 'required|mix_alpha_numeric_only');
			$this->form_validation->set_rules('ei_mob', 'Mobile', 'required');
			$this->form_validation->set_rules('ei_education', 'Education', 'required');
			$this->form_validation->set_rules('ei_subject', 'Subject', 'required');
			
			$this->form_validation->set_rules('ei_jo_code', 'Posting at', 'required');
			$this->form_validation->set_rules('ei_dob', 'Date of Birth', 'required');
			$this->form_validation->set_rules('ei_doj_bank', 'Date of Joined Bank', 'required');
			$this->form_validation->set_rules('ei_doj_br', 'Date of Joined Present Place', 'required');
						
			$this->form_validation->set_rules('ei_target_ac', 'Target A/c', 'required|numeric');
			$this->form_validation->set_rules('ei_target_amgt', 'Target Amount', 'required|numeric');
			$this->form_validation->set_rules('ei_pa_no', 'PA No', 'required|numeric');
			
			
			if ($this->form_validation->run() == FALSE)
			{				
				$this->session->set_flashdata('post_value', $_POST);
				$this->session->set_flashdata('errors', validation_errors());
				redirect('rpd/edit_empinfo/'.$id);
			}
			else
			{
			
				if(isset($_FILES['photo']) && $_FILES['photo']['error']==0)
				{
					
					$this->load->library('upload');
					
					$config['upload_path'] =   'uploads/';
					$config['allowed_types'] = '*';
					$config['max_size']	= '1000000';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['file_name']  = time().'_'.$_POST['ei_file_no'];
			
					$this->upload->initialize($config);
			
					if ( ! $this->upload->do_upload('photo'))
					{
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('errors', $error);
						redirect('rpd/edit_empinfo/'.$id);
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						if(isset($data) && !empty($data))
						{
							$uploaded_image_path=$data['upload_data']['file_name'];
						}
					}
				}
				else
				{
						$uploaded_image_path='';
				}	
				$this->load->model('empinfomodel');
				$this->empinfomodel->empinfo_edit($id,$uploaded_image_path);
				
				$this->session->set_flashdata('success', 'Employee Information have been updated successfully.');
				redirect('empinfo/empview');
			
			}
		}
	}
	
	
	
	public function empview()
	{
        /*
		$this->load->library('clsempinfo',array('ei_file_no' => 'agm-0846'));
		echo $this->clsempinfo->ei_name;
		echo $this->clsempinfo->retname();
		*/
		if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		
		$this->load->model('mymodel');
		$id=0;
		$menu_access_id=$this->session->userdata('menu_access_id');
		if(isset($menu_access_id) && $menu_access_id>0)
		{
				$id=$menu_access_id;
		}
			
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$id);
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['uid']= $this->session->userdata('some_name1');
		$data['module_name']='Deposit Monitoring System '; 
		
		$data['content']='dms/empbyoffice';
		
		$this->load->model('Empinfomodel');
		$data['empbyoffid']=$this->Empinfomodel->empinfo_get_by_office($this->session->userdata('some_office'));
		
		$this->load->view('home',$data);
		
		
	}
	
	public function test()
	{
		/*
		$this->load->library('clsempinfo',array('ei_file_no' => 'agm-0846'));
		echo $this->clsempinfo->ei_name;
		echo $this->clsempinfo->retname();
		*/
		
		
		$this->load->model('Empinfomodel');
		$this->Empinfomodel->empinfo_get('agm-0846');
		echo $this->Empinfomodel->ei_name;
		
	}
	
	
}