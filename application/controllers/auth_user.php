<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_user extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(!is_user())
		 {
			redirect(base_url(),'refresh');
		 }
	}

 	function fetch_login_property()
  	{
    		$response='';
    		if(isset($_POST['identity']))
    		{
        		$this->load->model('mymodel');
        		$response=$this->mymodel->fetch_login_property($_POST['identity']);
    		}
    
    		echo $response;
    		exit();
  	}
	
	public function reg_me()
	{
        $this->load->model('mymodel');
		$data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
		//$data['content']='dms/user_view';
        $data['option']='reg_me';
        $data['content']=$this->load->view('dms/user_view',$data,TRUE);
		$this->load->view('home',$data);
	}
	
	
	function create()
	{  
	  
       $this->load->model('mymodel');
       if(isset($_POST['submit']) &&($_POST['submit']=='Yes'))
       {
          redirect(base_url(),'refresh');
        }
        
       if(isset($_POST['back']) &&($_POST['back']=='Back'))
       {
        redirect(base_url(),'refresh');
       } 
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		//$this->form_validation->set_rules('pfno', 'Personal File No.', 'required');
		$this->form_validation->set_rules('pfno', 'Personal File No.', 'required|callback_personal_file_check|mix_alpha_numeric_only');
		$this->form_validation->set_rules('pocode', 'Posting Code', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required'); 
		$this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email'); 
 	    $this->form_validation->set_rules('conf_password', 'confirm password', 'required'); 
		$this->form_validation->set_rules('pocode', 'posting code', 'required|callback_posting_code_check'); 
	
		if ($this->form_validation->run() == FALSE)
	    {   
	        
            /*$this->session->set_flashdata('post_value',$_POST);
            $value=$this->session->flashdata('post_value');
            die($value);    */        
	       /* $data['content']='dms/user_view';
			$this->load->view('home',$data);*/
    		$data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
    		//$data['content']='dms/user_view';
            $data['option']='reg_me';
            $data['content']=$this->load->view('dms/user_view',$data,TRUE);
    		$this->load->view('home',$data);
			
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
			'ui_PFile_No'=> $this->input->post('pfno'),
			'ui_Full_Name'=> $this->input->post('fullname'),
			'ui_Mobile_No'=> $this->input->post('mobileno'),
			'ui_Posting_Office_Code'=> $this->input->post('pocode'),
			'ui_Office_HeadYN'=> $Officehead,
			'ui_Control_Off_YN' => $Controloffice,
			'ui_Pwd' =>$this->input->post('password'),
			'ui_Createddate' =>$this->input->post('createdate'),
			'ui_LastProfileUpdateDate' =>$this->input->post('ui_LastProfileUpdateDate'),
			'ui_Email' =>$this->input->post('email'),
			'ui_stat' =>$this->input->post('status'),
			'ui_dob' =>$this->input->post('dob'),
			'ui_level' =>'10',
			'ui_Pwd_Link' =>$this->input->post('pwdlink'),
            'ui_isPermit' =>'0'
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
	
	public function logedin_form()
	 {
	 
        $this->form_validation->set_rules('pfno', 'Personal File Name', 'required');
		$this->form_validation->set_rules('txt_Password', 'Password', 'required');
		$this->form_validation->set_rules('txt_office_id', 'Office ID', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{				
            //for auto refresh
 		     $sess_uid= $this->session->userdata('some_name1');
		      $sess_name= $this->session->userdata('some_name2');
              if(isset($sess_uid) && isset($sess_name) && $sess_name !='' && $sess_name !='')
              {
                redirect('rpd/home');
              }
              //end auto refresh			

			$this->load->view('home');
		}
		else
		{
			$pf_no = $_POST['pfno'];
			$pass = $_POST['txt_Password'];
			$office_id = $_POST['txt_office_id'];
			   
			$this->load->model('mymodel');
			   
			if($query = $this->mymodel->check_user($pf_no,$pass,$office_id,&$ab))
			{
				$data['content']='home/logout';
				//$data['logout']='home/logout';
				$this->session->set_userdata('u_level',$ab);
				
				$this->session->set_userdata('some_name1', $_POST['txt_your_name']);
				$this->session->set_userdata('some_name2', $_POST['txt_office_name']);
				//$this->session->set_userdata('some_name3', $_POST['dat_entry_date']);
				$this->session->set_userdata('some_name3', date('d-M-Y'));
				
				$this->session->set_userdata('some_uid',$_POST['pfno']);
				$this->session->set_userdata('some_office', $_POST['txt_office_id']);	
			
			
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['mainmenuArray']=  $this->mymodel->get_Data_Sql_Str('Select cMnu_ID, cMnu_Called_Obj,cMnu_Des, cIsPermitted from App_Menu where cMnu_Par_ID=0 AND cIsPermitted=1' );
				//set marquee_items
                $office_id=$this->session->userdata('some_office');
                $login_office_status=$this->mymodel->get_login_office_status($office_id);
                if($login_office_status != 4)
                {
                    $data['is_marquee_on']=1;
                    $data_marquee=array();
                    $data_marquee['date1']=$this->mymodel->get_marquee_date();
                    
              		$data_marquee['prod_type']=array();
                    if($query_prod = $this->mymodel->get_product_type())
            		{
            			$data_marquee['prod_type'] = $query_prod;
            		}
                    
            		$data_marquee['br_name']=array();
                    if($query_br = $this->mymodel->get_marquee_branch_all())
            		{
            			$data_marquee['br_name'] = $query_br;
            		}
                            		
            	   	$data_marquee['records1']=array();
                    if($query = $this->mymodel->get_records())
            		{
            			$data_marquee['records1'] = $query;
            		}
                    
                    $data_marquee['records2']=array();
            		if($query1 = $this->mymodel->get_records2())
            		{
            			$data_marquee['records2'] = $query1;
            		}
                    
                    $data_marquee['allbr']=array();
                    if($query4 = $this->mymodel->get_marquee_branch_completed($data_marquee['date1']))
            		{
            		  $data_marquee['allbr'] = $query4;
            		}
                    
                    $data_marquee['records3']=array();
            		if($query3 = $this->mymodel->get_marquee_data($data_marquee['date1']))
            		
            		{
            			$data_marquee['records3'] = $query3;
                    }
                    $data['marquee_item'] = $this->load->view('home/marquee_item',$data_marquee,true); 
                }
                //end marquee item
				
				//insert in history table--start
				$last_history_id=$this->mymodel->history_tbl_mgt(0);
				if($last_history_id>0)
				{
					$this->session->set_userdata('last_history_id', $last_history_id);
				}
				//insert in history table--end
   

				$this->load->view('home',$data);
		}
		
		else
		{
		 	$is_permit=$this->mymodel->check_is_permit($pf_no,$pass,$office_id,&$ab);
            
            if($is_permit==0)
            {
             $data['error']= "Your account is not activated yet. Contact with MISD!";   
            }
            else
            {
              $data['error']= "Please correct information to login. Try Again!";  
            }
            
		 	$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
		    $this->load->view('home',$data);
		}
    }				
 }
	
	function password_forget()
	{
		$data['content']='dms/password_forget_view';
		$this->load->view('home',$data);
	}
	function get_password()
	{
		if(isset($_POST['actionbtn']))
		{
			$this->form_validation->set_rules('pfno', 'Personal File No', 'required');
			$this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
			$this->form_validation->set_rules('pocode', 'Branch Code', 'required|numeric');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{				
				$this->session->set_flashdata('post_value_forget_password', $_POST);
				$this->session->set_flashdata('errors_forget_password', validation_errors());
				redirect('auth_user/password_forget');
			}
			else
			{
				$this->load->model('mymodel');
				//$password_info=$this->mymodel->get_password($_POST['pfno'],$_POST['email']);
				$password_info=$this->mymodel->get_password($_POST['pfno'],$_POST['email'],$_POST['pocode'],$_POST['dob']);
				if(!empty($password_info))
				{
					$to=$password_info['ui_Email'];
					$from='rps@janatabank-bd.com';
					$msg="Your password is:".$password_info['ui_Pwd'];
					
					//send mail
					$this->load->library('email');
					/*
					$config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					
					$this->email->initialize($config);*/

					$this->email->from($from, 'RPSD Janata Bank');
					$this->email->to($to);
					//$this->email->cc('another@another-example.com');
					//$this->email->bcc('them@their-example.com');
					
					$this->email->subject('Your password info');
					$this->email->message($msg);
					
					if($this->email->send())
					{
						$this->session->set_flashdata('info_forget_password', 'An Email is sent to your email account. Please check mail');
						redirect('auth_user/password_forget');
					}
					else
					{
						$this->session->set_flashdata('info_forget_password', 'Fail to retrive password');
						redirect('auth_user/password_forget');
					}
				}
				else
				{
					$this->session->set_flashdata('info_forget_password', 'Please give valid info to get password');
					redirect('auth_user/password_forget');
				}
			}
		}
		else
		{
				redirect(base_url());
		}
	
	}
	
	function under_con()
	{
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		
		$data['isde']='dvcontent_dataentry';
		$data['content']='under_con';
		$data['logout']='home/logout';
		
		$this->load->view('home',$data);
	}
	
	function profile_setting_form()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        //fetch data
        $this->load->model('mymodel');
        $data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
        $data['user_info']=$this->mymodel->fetch_user_details_info();
        
        $data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		
		$data['isde']='dvcontent_dataentry';
		$data['content']='profile_setting_form';
		$data['logout']='home/logout';
		
		$this->load->view('home',$data);
	}
    
   	function profile_setting_save($ui_code=0)
	{  
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        
        if(isset($_POST) && !empty($_POST))
        {
            $this->load->model('mymodel');
            
    		$this->load->helper(array('form', 'url'));
    		$this->load->library('form_validation');
    
            $this->form_validation->set_rules('designation', 'Designation', 'required');
            $this->form_validation->set_rules('fullname', 'Full Name', 'required');  
            $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email'); 
    		$this->form_validation->set_rules('password', 'Password', 'required|matches[conf_password]'); 
     	    $this->form_validation->set_rules('conf_password', 'confirm password', 'required'); 
            
    		if(isset($_POST['pfno']) && isset($_POST['exist_pfno']) && $_POST['exist_pfno']!=$_POST['pfno'])
            {
                $this->form_validation->set_rules('pfno', 'Personal File No.', 'required|callback_personal_file_check|mix_alpha_numeric_only');   
            }
            $this->form_validation->set_rules('pocode', 'posting code', 'required|callback_posting_code_check'); 
    	
    		if ($this->form_validation->run() == FALSE)
    	    {   
                //fetch data
                $this->load->model('mymodel');
                $data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
                $data['user_info']=$this->mymodel->fetch_user_details_info();
                
                $data['uid']= $this->session->userdata('some_name1');
        		$data['txt_office_name']= $this->session->userdata('some_name2');
        		$data['dat_entry_date']= $this->session->userdata('some_name3');
        		$data['logout']='home/logout';
        		
        		$data['isde']='dvcontent_dataentry';
        		$data['content']='profile_setting_form';
        		$data['logout']='home/logout';
        		
        		$this->load->view('home',$data);
    			
    		}
    		else
    		{	
  			    $status_code=$this->mymodel->profile_setting_save($ui_code);
                
                if($status_code==1)
                {
                    $this->session->sess_destroy();
                    
                    $data['msg']='';
      			    if(isset($_POST['pocode']) && isset($_POST['exist_pocode']) && $_POST['exist_pocode']==$_POST['pocode'])
                    {
                       $data['msg']='Your Profile has been saved successfully. For proper access, you have to login.';   
                    }
                    else
                    {
                       $data['msg']='Your Profile has been saved successfully. <br/>For proper access, you have to activate your new office account.<br/>Please contact with MISD,Head Office.'; 
                    }
                      
                    $data['content']='profile_setting_success';
        			$data['logout']='home/logout';
        			$this->load->view('home',$data);
                }
                else
                {
                    $this->session->set_flashdata('status_profile_setting','Your Profile has not been saved.');
                    //fetch data
                    $this->load->model('mymodel');
                    $data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
                    $data['user_info']=$this->mymodel->fetch_user_details_info();
                    
                    $data['uid']= $this->session->userdata('some_name1');
            		$data['txt_office_name']= $this->session->userdata('some_name2');
            		$data['dat_entry_date']= $this->session->userdata('some_name3');
            		$data['logout']='home/logout';
            		
            		$data['isde']='dvcontent_dataentry';
            		$data['content']='profile_setting_form';
            		$data['logout']='home/logout';
            		
            		$this->load->view('home',$data);
                }
    		} 
        }
        else
        {
            redirect(base_url().'index.php/rpd/home','refresh');
        }
	}
	
	
	function loged_out()
	{
		//update in history table--start
		$this->load->model('mymodel');
		$this->mymodel->history_tbl_mgt(1);
		//update in history table--end
		
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');	
	}
	//personal_file_check
	function personal_file_check($m)
	{
	  $query =  $this->db->query("SELECT * FROM DMS_UserInfo where ui_PFile_No='".$m."'");        
           
		if($query->num_rows==0)
		{
			
			return true;
		}
		else
		{
		$this->form_validation->set_message('personal_file_check', 'This %s has already registered. ');
			return false;
		}
	}
	
	function posting_code_check($m)
	{
	  $query =  $this->db->query("SELECT * FROM [VW_Jb_off] where [Office code]='".$m."'");        
           
		if($query->num_rows==0)
		{
			$this->form_validation->set_message('posting_code_check', 'This %s is not available.');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
	//upload portal server temporary
	   	function upload_portal_server()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        
        $data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		
		$data['isde']='dvcontent_dataentry';
		$data['content']='upload_portal_server';
		$data['logout']='home/logout';
		
		$this->load->view('home',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */