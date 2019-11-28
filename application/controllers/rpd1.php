<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rpd extends CI_Controller {
	var $sessid='';
	var $muid='';
	var $muname='';
	var $mentdt='';
	
	public function index()
	{
		if ($this->session->userdata('some_name1')=='')
		{
			//echo $this->session->userdata('some_name2');
			 redirect(base_url(),'refresh');
		}
		//else
		//{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->load->model('mymodel');
		if($query = $this->mymodel->product_type())
		{
			$data['records'] = $query;
		}
		
		if($query = $this->mymodel->get_target())
		{
			$data['records_target'] = $query;
		}
		
		$data['content']=('dms/deposit_view');
		$data['title']="Core Deposit Monitoring System Form";
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$this->load->view('home',$data);
	}
	
	function omis_vie1()
	{
		echo 'adfdfd';
		}
	
	function omis_view_form()
	{
	/*
		if ($this->session->userdata('some_name1')=='')
		{
			//echo $this->session->userdata('some_name2');
			 redirect(base_url(),'refresh');
		}
		*/
	    $this->load->model('mymodel');
	    if($query = $this->mymodel->get_records())
		{
			$data['records1'] = $query;
		}
		
		if($query1 = $this->mymodel->get_records2())
		{
			$data['records2'] = $query1;
		}
		if($query3 = $this->mymodel->get_om_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_view');
		
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$this->load->view('home',$data);
		}
	}
	
	function record2()
	{
	   $this->preview();
 	}
	
	function preview()
	{
	   $this->load->helper(array('form', 'url'));
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('amount[]', 'All amount', 'required');
	   $this->form_validation->set_rules('ac[]', 'All No. of Account', 'required');
	   if ($this->form_validation->run() == FALSE)
	    {
			 $this->load->model('mymodel');
			 if($query1 = $this->mymodel->get_records2())
			{
				$data['records2'] = $query1;
			}
			if($query3 = $this->mymodel->get_om_date())
			{
				$data['records3'] = $query3;
			}	
			
			
			$data['content']=('om/omis_view');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$amount=$this->input->post('amount');
				$ac=$this->input->post('ac');
				$data['amt']= $amount;
				$data['ac']= $ac;	
				
			$this->load->view('home',$data);
			
		}
		
		else
		{
			 $this->load->model('mymodel');
			 if($query1 = $this->mymodel->get_records2())
			{
				$data['records2'] = $query1;
			}
			/*$amount=$this->input->post('amount');
			$ac=$this->input->post('ac');
			$DATE=$this->input->post('datdate');
			$data['dddd']= $DATE;
			$data['amt']= $amount;
			$data['ac']= $ac;	
			$data['content']=('om/preview');
			$this->load->view('om/preview',$data);
	        */
			
		
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$amount=$this->input->post('amount');
		$ac=$this->input->post('ac');
		$DATE=$this->input->post('datdate');
		echo $DATE;
			$data['dddd']= $DATE;
			$data['amt']= $amount;
			$data['ac']= $ac;	
			$data['content']=('om/preview');
		$this->load->view('home',$data);
		}
	}
	
	function record3()
	{
	 	$action = $this->input->get_post("actionbtn");
		switch($action)
		{
			//echo $action;		
 			case 'Submit':
   	    	$this->omis_data_insert();
			echo $action;
 			break;
 			case 'Edit':
			$this->update_res();
			break;
    	} 	
		
	}
	
	function omis_data_insert()
	{  
	$this->load->helper(array('form', 'url'));
		$amount=$this->input->post('amount');
		$ac=$this->input->post('ac');
		$DATE=$this->input->post('datdate');
		$OFF_ID= $this->session->userdata('some_office');
		$PT_CODE=$this->input->post('pt_id');
			
			$c=0;
			foreach($amount as $amountVal)
			{
				$data = array(
				'dd_jo_code'=>$OFF_ID,
				'dd_pt_id'=>$PT_CODE[$c],
				'dd_amt' => (float)$amountVal,
				'dd_ac' => $ac[$c],
				'dd_end_dt'=>$DATE
				);
			$this->load->model('mymodel');
			$this->mymodel->add_omis_data($data);
			$c++;
			}
			$this->load->view('om/omis_success');
		
	}
	
	function update_res()
	{
	$this->load->model('mymodel');
	if($query1 = $this->mymodel->get_records2())
		{
			$data['records2'] = $query1;
		}
		if($query3 = $this->mymodel->get_om_date())
		{
			$data['records3'] = $query3;
		}
	
		$data['content']=('om/preview_edit');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$amount=$this->input->post('amount');
		$ac=$this->input->post('ac');
		$DATE=$this->input->post('datdate');
		echo $DATE;
			$data['dddd']= $DATE;
			$data['amt']= $amount;
			$data['ac']= $ac;	
		$this->load->view('home',$data);
	}
	
	
	
	function reg_me()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['content']='dms/user_view';
		
		$this->load->view('dataentryform',$data);
	}
	
	
	function create()
	{  
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('pfno', 'Personal File No.', 'required');
		$this->form_validation->set_rules('pocode', 'Posting Code', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required'); 
		
		if ($this->form_validation->run() == FALSE)
	    {
			$data['content']='dms/user_view';
			$this->load->view('dataentryform',$data);
			
		}
		else
		{	
			 $Officehead=0;
			 if($this->input->post('officehead')=="on")
			 {
				$Officehead=1;
			 }
			 
			 $Controloffice=0;
			 if($this->input->post('controloffice')=="on")
			 {
				 $Controloffice=1;
			 }
			
			$data = array(
			'ui_Desig_Code'=>$this->input->post('designation'),
			'ui_code'=> $this->input->post('code'),
			'ui_PFile_No'=> $this->input->post('pfno'),
			'ui_Full_Name'=> $this->input->post('fullname'),
			'ui_Mobile_No'=> $this->input->post('mobileno'),
			'ui_Posting_Office_Code'=> $this->input->post('pocode'),
			'ui_Office_HeadYN'=> $Officehead,
			'ui_Control_Off_YN' => $Controloffice,
			'ui_Pwd' =>$this->input->post('password'),
			'ui_Createddate' =>$this->input->post('createdate'),
			'ui_Last_Login_date' =>$this->input->post('lastlogdate'),
			'ui_Email' =>$this->input->post('email'),
			'ui_stat' =>$this->input->post('status'),
			'ui_dob' =>$this->input->post('dob'),
			'ui_level' =>$this->input->post('level'),
			'ui_Pwd_Link' =>$this->input->post('pwdlink')
			);
					
			$this->load->model('mymodel');
			$this->mymodel->add_record($data);
			
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$data['content']='login_created';
			
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$this->load->view('home',$data);
			//$this->load->view('login_created.php',$data);
		}
	}
	
	function insert()
	{  
	    
		/****************** validation Check ***************************************/
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('upmonth', 'upmonth', 'required|exact_length[2]|numeric|greater_than[0]|less_than[13]');
		$this->form_validation->set_rules('year', 'year', 'required|exact_length[4]|numeric');
		//$this->form_validation->set_rules('officeId', 'Office Code', 'required|numeric');
		$this->form_validation->set_rules('desig[]', 'No. of Employee', 'required|numeric');
		$this->form_validation->set_rules('ac[]', 'All No of Account', 'required|numeric');
		$this->form_validation->set_rules('amt[]', 'All Amoount', 'required|numeric');
		//$this->form_validation->set_rules('password', 'Password', 'required'); desig[]
		
		if ($this->form_validation->run() == FALSE)
	    {   
			$data['err']='aa';
			$this->load->model('mymodel');
			if($query = $this->mymodel->get_target())
			{
				$data['records_target'] = $query;
			}
			
			if($query = $this->mymodel->product_type())
			{
				$data['records'] = $query;
			}
			
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			
			$data['logout']='home/logout';
			$data['content']='dms/deposit_view';
			$this->load->view('dataentryform',$data);
			
			
		}
		else
		{		
			$Month=$this->input->post('upmonth');
			$Year=$this->input->post('year');
			//$Office_Id=$this->input->post('officeId');
			$Office_Id=$this->session->userdata('some_office');
			$Prod_tye=$this->input->post('prod_type');
			$amount=$this->input->post('amt');
			$ac=$this->input->post('ac');
			//$UID= $_POST['pfno'];
			$UID= $this->session->userdata('some_uid');
			$END_DT= $this->session->userdata('some_name3');	
			$c=0;
			foreach($amount as $amountVal)
			{
			$data = array(
				'dp_day'=>1,
				'dp_onth'=> $Month,
				'dp_yr'=> $Year,
				'dp_jo_code'=> $Office_Id,	
				'dp_pt_id'=> $Prod_tye[$c],
				'dp_Ac' => $ac[$c],		
				'dp_amt' => (float)$amountVal,
				'dp_uid'=> $UID,
				'dp_end_dt'=> $END_DT
				);
			$c++;
			$this->load->model('mymodel');
			$this->mymodel->add_deposit($data);
			}
			/******** dms_ems_length** data Entry**///////////////
			
				//$Month=$this->input->post('upmonth');
				//$Year=$this->input->post('year');
				//$Office_Id=$this->input->post('officeId');
				$noemp=$this->input->post('desig');
				$dsg_Id=$this->input->post('desig_id');
				$c=0;
				foreach($noemp as $noEmp){
				$data = array(
					'el_off_id'=> $Office_Id,
					'el_dsg_id'=> $dsg_Id[$c],
					'el_no_emp'=> $noEmp,
					'el_yr'=> $Year,
					'el_mon'=> $Month,
					'el_day'=>1
					);
				
				$this->load->model('mymodel');
				$this->mymodel->add_dms_emp_length($data);
				$c++;
				
			}
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$data['content']='dms/deposit_success';
			
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			
				
			
			//$this->load->view('dms/deposit_success');
			$this->load->view('dataentryform',$data);
		}

	}
	
	
	function logedin_form()
	 {
	 	//$this->load->helper(array('form', 'url'));
		//$this->load->library('form_validation');
		//$this->load->library('session');
		$sessid = $this->session->userdata('session_id');
		
		$this->form_validation->set_rules('pfno', 'Personal File Name', 'required');
		$this->form_validation->set_rules('txt_Password', 'Password', 'required');
		$this->form_validation->set_rules('txt_office_id', 'Office ID', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('home');
		}
		else
		{
			$pf_no = $_POST['pfno'];
			$pass = $_POST['txt_Password'];
			$office_id = $_POST['txt_office_id'];
			   
			$this->load->model('mymodel');
			   
			if($query = $this->mymodel->check_user($pf_no,$pass,$office_id))
			{
				$data['content']='home/logout';
				//$data['logout']='home/logout';
			
				$this->session->set_userdata('some_name1', $_POST['txt_your_name']);
				$this->session->set_userdata('some_name2', $_POST['txt_office_name']);
				$this->session->set_userdata('some_name3', $_POST['dat_entry_date']);
				
				$this->session->set_userdata('some_uid',$_POST['pfno']);
				$this->session->set_userdata('some_office', $_POST['txt_office_id']);	
			
			
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				
				$data['mainmenuArray']=  $this->mymodel->get_Data_Sql_Str('Select cMnu_ID, cMnu_Called_Obj,cMnu_Des from App_Menu where cMnu_Par_ID=0' );
				//$this->session->set_userdata('menu_parent_id',$mainmenuArray->cMnu_ID);	
				
				
				$this->load->view('home',$data);
		}
		
		else
		{
		 $data['error']= "Please correct information for login. try Again!";
		 	$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
		 $this->load->view('home',$data);
		}
    }		
	
		
		
		
 }
 
 //Deposit Monitoring system main function
 	public function dms($id)
	 {
	 	$this->load->helper(array('form', 'url'));
		
		$this->load->model('mymodel');
			
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des from App_Menu where cMnu_Par_ID=".$id);
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['uid']= $this->session->userdata('some_name1');
		$data['module_name']='Deposit Monitoring System '; 
		
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}
	
	//Deposit Monitoring system main function
 	public function omis($id)
	 {
	 	$this->load->helper(array('form', 'url'));
		
		$this->load->model('mymodel');
			
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des from App_Menu where cMnu_Par_ID=".$id);
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['uid']= $this->session->userdata('some_name1');
		$data['module_name']='Overview MIS Data Entry '; 
		
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}

	
	function datashow($tblname='vw_br')
	{
		$this->load->library('table','form_validation');
		 $this->load->model('mymodel');
		 $data['rw']= $this->mymodel->get_Data($tblname);
		 
				
		//$data['content']=('dms/deposit_view');
		$data['content']='datashow';
		
		$data['title']="Core Deposit Monitoring System Form";
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		
		$data['isde']='dvcontent_dataentry';
		
		$this->load->view('home',$data);
				 
		 //$this->load->view('datashow',$data);
	}
	
	function datashow_window($tblname='vw_br')
	{
		$this->load->library('table','form_validation');
		 $this->load->model('mymodel');
		 $data['rw']= $this->mymodel->get_Data($tblname);
		 
				
		//$data['content']=('dms/deposit_view');
		$data['content']='datashow';
		
		$data['title']="Core Deposit Monitoring System Form";
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		
		$data['isde']='dvcontent_dataentry';
		
		//$this->load->view('home',$data);
				 
		 $this->load->view('datashow',$data);
	}
	
	function datashow_page($tblname)
	{
		 $this->load->library('pagination');

		 //$config['base_url'] = 'http://example.com/index.php/test/page/';
		 $config['base_url'] ='http://203.76.102.169:8080/rpd/index.php/rpd/datashow';
		 $config['total_rows'] = 200;
		 $config['per_page'] = 20; 

		$this->pagination->initialize($config); 

		echo $this->pagination->create_links();
	}
	function empinfo()
	{
		
		//$data['content']=('dms/deposit_view');
		//$data['title']="Core Deposit Monitoring System Form";
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		//$this->load->view('home',$data);
		
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['isde']='dvcontent_dataentry';
		$data['content']='empinfo';
		$data['logout']='home/logout';
		
		$this->load->view('home',$data);
		
	}
	function under_con()
	{
		//$data['content']=('dms/deposit_view');
		//$data['title']="Core Deposit Monitoring System Form";
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		//$this->load->view('home',$data);
		
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['isde']='dvcontent_dataentry';
		$data['content']='under_con';
		$data['logout']='home/logout';
		
		$this->load->view('home',$data);
	}
	
	function loged_out()
	{
	/*
		$this->session->set_userdata('some_name1', $_POST['txt_your_name']);
				$this->session->set_userdata('some_name2', $_POST['txt_office_name']);
				$this->session->set_userdata('some_name3', $_POST['dat_entry_date']);
				
				$this->session->set_userdata('some_uid',$_POST['pfno']);
				$this->session->set_userdata('some_office', $_POST['txt_office_id']);	
				*/
		//$this->session->unset_userdata('some_name1');
		$this->session->sess_destroy();
		 redirect(base_url(),'refresh');
		
		
		
		//echo $this->session->userdata('session_id');
		//echo $this->sessid;
		/*
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','ajax'));
		
		$data['vwtop']='home/topinit';
		
		$this->load->view('home',$data);
		*/
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */