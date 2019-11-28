<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Iss extends CI_Controller {
    function __construct()
     {
        // Call the Controller constructor
        parent::__construct();
		$this->load->helper(array('url','mediatutorialpdf'));
		$this->load->database();

		 if(!is_user())
		 {
		  	redirect(base_url(),'refresh');
		 }
     }

     public function index($id)
	 {
	 	if(isset($id) && $id>0)
		{
			$this->session->set_userdata('menu_access_id',$id);
		}

		$this->load->model('mymodel');

		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$id);
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['uid']= $this->session->userdata('some_name1');
		$data['module_name']='Integrated Supervision System';
		//quick link
        $this->session->set_userdata('quick_link', '8');
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}

	function iss_2_guide_line_view()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

      	//login office
        $this->load->model('issmymodel');
		//$office_id=$this->session->userdata('some_office');
		$data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
       	if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}
        $data['content']=('iss/iss_guide_line');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	function iss_2_guide_line_view_details()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

      	//login office
        $this->load->model('issmymodel');
		$office_id = $this->session->userdata('some_office');
		//$data['off_id'] = ;
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
       	if($query_9data = $this->issmymodel->iss_2_generated_9item_data($_POST['iss_guideline_br_id'], $_POST['fetched_date_9item']))
		{
			$data['query_9item_data'] = $query_9data;
		}

        $data['content']=('iss/iss_guide_line _details');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	function iqa_details_view()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

      	//login office
        $this->load->model('issmymodel');
		$data['off_id'] = $office_id = $this->session->userdata('some_office');
		$data['pfo'] = $this->session->userdata('some_uid');
		
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
       	
		
        $data['content']=('iss/iqa_details');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	
	function iqa_details_save()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

      	//login office
        $this->load->model('issmymodel');
		$data['off_id'] = $office_id = $this->session->userdata('some_office');
		$data['pfo'] = $this->session->userdata('some_uid');

		$status = $this->issmymodel->save_iss_iqa_info($office_id);
		
        if($status=='success')
		{
		   $this->session->set_flashdata('success_iqa','Thanks for your Question or Opinion. We would contact with you if need.');
		   redirect('iss/iqa_details_view','refresh');
		}
		else
		{
		   $this->session->set_flashdata('error_iqa','Please filled a Message Box.');
		   redirect('iss/iqa_details_view','refresh');
		}
	}
	
	function iqa_user_details()
	{
         if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

      	//login office
        $this->load->model('issmymodel');
		
       	$data['iqa_user_query'] = '';
		if($iqa_user_data = $this->issmymodel->iss_iqa_user_details_data())
		{
			$data['iqa_user_query'] = $iqa_user_data;
		}
		
        $data['content']=('iss/iqa_user_details');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	
	function iss_2_entry_view()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id=$this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
        //fetch required data start
		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}
        $data['content']=('iss/iss_2_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	function iss_form_2_entry()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$office_id = $this->session->userdata('some_office');
        $this->load->model('issmymodel');
		$check_status=0;

		if(isset($_POST['fetched_date']) && $_POST['fetched_date'] !='')
		{
			//$iss_data_exists = $this->issmymodel->get_branch_iss_report($office_id,$_POST['fetched_date']);
			//if(empty($iss_data_exists))
			{
				$file_no=$this->session->userdata('some_uid');
				$off_id=$this->session->userdata('some_office');
				$url_u_portal="http://115.127.114.71/cl/selection.aspx?file=$file_no&brcd=$off_id";

				header('Location: '.$url_u_portal, true, 301);
				exit;
			}
			//else
			{
				//$this->session->set_flashdata('error_wp','ISS data already exists for selected date: '.$_POST['fetched_date'].' . If you want to edit data,please go to ISS DATA EDIT menu. ');
				$check_status=5;
			}
		}
		else
		{
			$this->session->set_flashdata('error_wp','Please select date. ');
			$check_status=1;
		}

		//Now set action

		if($check_status==1)
		{
			redirect('iss/iss_2_entry_view','refresh');
		}
	}

    public function iss_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');

        //login office
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
           // $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
		   $data['login_office_status'] = $this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
            //$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
			$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/iss_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id = $this->session->userdata('some_office');

			if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>1 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
			{
				if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
				{
				   $report_of_office_id = $_POST['iss_report_office_id'];
				}
			}
			$data['office_id_check'] = $report_of_office_id;
			if($query_date = $this->issmymodel->iss_get_cer_date($_POST['report_of_date']))
			{
				$data['query_date_val'] = $query_date;
			}
           	$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);

			//echo $login_status; die();
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status($report_of_office_id);
			}
			else
			{
				$data['login_office_status'] = $this->issmymodel->get_login_office_status(0);
			}

			//report_selector check here Branch or Area/div/head office............
			/*
			If Area/Division/Whole
			*/

			if(isset($login_status) && $login_status == 4)
			{
				if($this->issmymodel->iss_get_date())
				{
					$query_alldate = $this->issmymodel->iss_get_date();
				}
				$pre_date_key = ''; $pre_date_value = '';
				foreach($query_alldate as $key => $arr)
				{
					if($_POST['report_of_date'] == $arr->ISSEntryDate)
					{
						$prev_date = $query_alldate[$key+1]->ISSEntryDate;
					}
				}
				$data['pre_report_of_date'] = $prev_date;

				$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
		        $data['certificate_exist'] = $this->issmymodel->fetch_iss_certificate_exist($office_id,$_POST['report_of_date']);
				$ret='';
				if(count($data['certificate_exist']>1))
				{
					$ret = isset($data['certificate_exist'][0]->certified_br_ar_div_code);
				}
				if($ret == $office_id)
				{
					$this->session->set_userdata('certified','1');
					$data['data_exist'] = $this->issmymodel->fetch_iss_cer_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
					$data['records3'] = $this->issmymodel->fetch_iss_cer_data_details($branch_id_array_for_report,$_POST['report_of_date']);

					if(date('Y', strtotime($prev_date)) !=2015)
					{
						$data['records3_predata'] = $this->issmymodel->fetch_iss_cer_data_details($branch_id_array_for_report,$prev_date);
					}
				}
				else
				{
					$this->session->set_userdata('certified','0');
					$data['data_exist'] = $this->issmymodel->fetch_iss_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
					$data['records3'] = $this->issmymodel->fetch_iss_data_details($branch_id_array_for_report,$_POST['report_of_date']);
					if(date('Y', strtotime($prev_date)) !=2015)
					{
						$data['records3_predata'] = $this->issmymodel->fetch_iss_data_details($branch_id_array_for_report,$prev_date);
					}
				}
			}
			else
			{
				$data['result_array'] = array();

				if(isset($login_status) && $login_status !=4 && $login_status !=1)
				{
					$data['certificate_exist'] = $this->issmymodel->fetch_iss_certificate_exist($report_of_office_id,$_POST['report_of_date']);
					$data['certificate_data'] = $this->issmymodel->fetch_iss_certificate_data($branch_id_array_for_report,$_POST['report_of_date']);
					$data['cer_completed_vs_total'] = $this->issmymodel->fetch_iss_cer_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);

					if((count($data['certificate_exist'])>0))
					{
						if((count($data['certificate_data'])>0))
						{
							if($data['cer_completed_vs_total']['total']==$data['cer_completed_vs_total']['completed'])
							{
								$data['exist_data'] = $this->issmymodel->fetch_iss_certificate_exist_single($report_of_office_id,$_POST['report_of_date']);

								$cc=0;
								foreach($data['exist_data'] as $test)
								{
									$cer_datapol[$cc++] = $test->certified_br_ar_div_code;
								}
								if(in_array($report_of_office_id,$cer_datapol))
								{
									$this->session->set_userdata('certified','1');
								}
								else
								{
									$this->session->set_userdata('certified','0');
								}
								$data['data_exist'] = $this->issmymodel->fetch_iss_cer_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
								if(isset($login_status) && $login_status ==1)
								{
									$data['records3'] = $this->issmymodel->fetch_iss_whole_cer_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								}
								else
								{
									if(isset($login_status) && $login_status !=1)
									{
										$data['records3'] = $this->issmymodel->fetch_iss_cer_data_details($branch_id_array_for_report,$_POST['report_of_date']);
									}
								}

								$result_array = $this->issmymodel->fetch_iss_cer_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
							}
							else
							{
								$this->session->set_userdata('certified','0');
								$data['data_exist'] = $this->issmymodel->fetch_iss_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
								if(isset($login_status) && $login_status ==1)
								{
									$data['records3'] = $this->issmymodel->fetch_iss_whole_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								}
								else
								{
									if(isset($login_status) && $login_status !=1)
									{
										$data['records3'] = $this->issmymodel->fetch_iss_data_details($branch_id_array_for_report,$_POST['report_of_date']);
									}
								}
								$result_array = $this->issmymodel->fetch_iss_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
								$data['completed_vs_total'] = $this->issmymodel->fetch_iss_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
							}
						}
						else
						{
							$this->session->set_userdata('certified','0');

							$data['data_exist'] = $this->issmymodel->fetch_iss_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
							if(isset($login_status) && $login_status ==1)
								{
									$data['records3'] = $this->issmymodel->fetch_iss_whole_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								}
								else
								{
									if(isset($login_status) && $login_status !=1)
									{
										$data['records3'] = $this->issmymodel->fetch_iss_data_details($branch_id_array_for_report,$_POST['report_of_date']);
									}
								}
							$result_array = $this->issmymodel->fetch_iss_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
							$data['completed_vs_total'] = $this->issmymodel->fetch_iss_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
						}
					}
					else
					{

						if((count($data['certificate_data'])>0))
						{

							$data['completed_vs_total'] = $this->issmymodel->fetch_iss_cer_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
							if($data['completed_vs_total']['total']==$data['completed_vs_total']['completed'])
							{
								$this->session->set_userdata('certified','1');
								$data['data_exist'] = $this->issmymodel->fetch_iss_cer_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
								
								if(isset($login_status) && $login_status ==1)
								{
									$data['records3'] = $this->issmymodel->fetch_iss_whole_cer_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								}
								else
								{
									if(isset($login_status) && $login_status !=1)
									{
										$data['records3'] = $this->issmymodel->fetch_iss_cer_data_details($branch_id_array_for_report,$_POST['report_of_date']);
									}
								}
								$result_array = $this->issmymodel->fetch_iss_cer_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
								$data['completed_vs_total'] = $this->issmymodel->fetch_iss_cer_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
							}
							else
							{
								$this->session->set_userdata('certified','0');
								$data['data_exist'] = $this->issmymodel->fetch_iss_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
								//
								if(isset($login_status) && $login_status ==1)
								{
									$data['records3'] = $this->issmymodel->fetch_iss_whole_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								}
								else
								{
									if(isset($login_status) && $login_status !=1)
									{
										$data['records3'] = $this->issmymodel->fetch_iss_data_details($branch_id_array_for_report,$_POST['report_of_date']);
									}
								}
								$result_array = $this->issmymodel->fetch_iss_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
								$data['completed_vs_total'] = $this->issmymodel->fetch_iss_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
							}

						}
						else
						{
							$this->session->set_userdata('certified','0');
							$data['data_exist'] = $this->issmymodel->fetch_iss_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
							//
								if(isset($login_status) && $login_status ==1)
								{
									$data['records3'] = $this->issmymodel->fetch_iss_whole_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								}
								else
								{
									if(isset($login_status) && $login_status !=1)
									{
										$data['records3'] = $this->issmymodel->fetch_iss_data_details($branch_id_array_for_report,$_POST['report_of_date']);
									}

								}
							$result_array = $this->issmymodel->fetch_iss_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
							$data['completed_vs_total'] = $this->issmymodel->fetch_iss_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
							$data['certificate_data'] = 0;
						}

					}
				}
				else
				{
					if(isset($login_status) && $login_status==1)
					{
						if(date('Y', strtotime($_POST['report_of_date']))==2016)
						{
							//echo "2016";
							$raw_whole='';
							$certificate_whole='';
							$data['whole_branch_raw'] = $this->issmymodel->fetch_whole_branch_raw_data($_POST['report_of_date']);
							$data['whole_branch_final'] = $this->issmymodel->fetch_whole_branch_final_data($_POST['report_of_date']);
							$data['whole_branch_certificate'] = $this->issmymodel->fetch_whole_branch_certificate_data($_POST['report_of_date']);

							$data['certificate_data'] = $this->issmymodel->fetch_iss_certificate_data($branch_id_array_for_report,$_POST['report_of_date']);

							foreach($data['whole_branch_raw'] as $totalrawbr)
							{
								$raw_whole = $totalrawbr->total_raw_br;
								$data['whole_raw'] = $totalrawbr->total_raw_br;
							}
							foreach($data['whole_branch_final'] as $totalfinalbr)
							{
								$final_whole = $totalfinalbr->total_final_br;
								$data['whole_final'] = $totalfinalbr->total_final_br;
							}
							foreach($data['whole_branch_certificate'] as $totalcerbr)
							{
								$certificate_whole = $totalcerbr->total_cer_br;
								$data['whole_certificate'] = $totalcerbr->total_cer_br;
							}

							if((isset($raw_whole)&&$raw_whole)==(isset($certificate_whole)&&$certificate_whole))
							{
								$data['records3'] = $this->issmymodel->fetch_iss_data_whole_branch($raw_whole,$certificate_whole,$_POST['report_of_date']);
								$data['data_exist'] = $this->issmymodel->fetch_iss_data_whole_branch($raw_whole,$certificate_whole,$_POST['report_of_date']);
								$this->session->set_userdata('certified','1');
							}
							else
							{
								$data['records3'] = $this->issmymodel->fetch_iss_data_whole_branch($raw_whole,$certificate_whole,$_POST['report_of_date']);
								$data['data_exist'] = $this->issmymodel->fetch_iss_data_whole_branch($raw_whole,$certificate_whole,$_POST['report_of_date']);
								$this->session->set_userdata('certified','0');
							}
						}
						else
						{
							$data['completed_vs_total'] = $this->issmymodel->fetch_iss_cer_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
							if($data['completed_vs_total']['total']==$data['completed_vs_total']['completed'])
							{
								$this->session->set_userdata('certified','1');
								$data['data_exist'] = $this->issmymodel->fetch_iss_cer_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
								//
								if(isset($login_status) && $login_status ==1)
								{
									$data['records3'] = $this->issmymodel->fetch_iss_whole_cer_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								}

								//$data['records3'] = $this->issmymodel->fetch_iss_cer_data_details($branch_id_array_for_report,$_POST['report_of_date']);
								//$result_array = $this->issmymodel->fetch_iss_cer_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
								//$data['completed_vs_total'] = $this->issmymodel->fetch_iss_cer_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
							}

							$data['data_exist'] = $this->issmymodel->fetch_iss_data_exist($branch_id_array_for_report,$_POST['report_of_date']);
							$data['records3'] = $this->issmymodel->fetch_iss_whole_data_details($branch_id_array_for_report,$_POST['report_of_date']);
						}
					}

				}
			}
			//Now prepare option
            if($_POST['report_click_btn']==1)//view report
			{
				if($query = $this->issmymodel->get_iss_group($_POST['report_of_date']))
				{
					$data['records1'] = $query;
				}
			}

            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
				if(isset($login_status) && $login_status !=4 && $login_status !=1)
				{
					$result_array = $this->issmymodel->fetch_iss_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
					/*Add start*/
					$data['cer_area_list'] = $this->issmymodel->fetch_iss_cer_area_list($branch_id_array_for_report,$_POST['report_of_date']);
					//$data['cer_division_list'] = $this->issmymodel->fetch_iss_cer_division_list($branch_id_array_for_report,$_POST['report_of_date']);
					$data['cer_division_list'] = $this->issmymodel->fetch_iss_cer_division_list($_POST['report_of_date']);
					/*Add end*/
					$data['report_office_code'] = $report_of_office_id;
					if(isset($result_array) && count($result_array)>0)
					{
						foreach($result_array as $row)
						{
							if($_POST['report_click_btn']==2 && $row['status']==0)
							{
							  $data['result_array'][]=$row;
							  $data['status'] = $row['status'];
							}
							if($_POST['report_click_btn']==3 && $row['status']==1)
							{
							  $data['result_array'][]=$row;
							  $data['status'] = $row['status'];
							}
						}
					}

					$data['count_all']=count($branch_id_array_for_report);
					$data['count_missing_completed']=count($data['result_array']);
					if($_POST['report_click_btn']==2)
					{
						$data['sign']='Missing';
					}
					if($_POST['report_click_btn']==3)
					{
						$data['sign']='Completed';
					}
				}
				if(isset($login_status) && $login_status ==1)
				{
						$result_array = $this->issmymodel->fetch_iss_missing_completed_whole_br($_POST['report_of_date']);
						/*Add start*/
						$data['cer_area_list'] = $this->issmymodel->fetch_iss_cer_area_list($branch_id_array_for_report,$_POST['report_of_date']);
						//$data['cer_division_list'] = $this->issmymodel->fetch_iss_cer_division_list($branch_id_array_for_report,$_POST['report_of_date']);
						$data['cer_division_list'] = $this->issmymodel->fetch_iss_cer_division_list($_POST['report_of_date']);
						/*Add end*/

						$data['report_office_code'] = $report_of_office_id;
						$data['count_all']=count($branch_id_array_for_report);

						if(isset($result_array) && count($result_array)>0)
						{
							foreach($result_array as $row)
							{
								if($_POST['report_click_btn']==2 && $row->status==0)
								{
								  $data['result_array'][]=$row;
								  $data['status'] = $row->status;
								}
								if($_POST['report_click_btn']==3 && $row->status==1)
								{
								  $data['result_array'][]=$row;
								  $data['status'] = $row->status;
								}
							}
							if($_POST['report_click_btn']==2)
							{
								$data['sign']='Missing';
							}
							if($_POST['report_click_btn']==3)
							{
								$data['sign']='Completed';
							}
						}
				}
			}

            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
            $data['report_click_btn']=$_POST['report_click_btn'];
            $data['report_of_date']=$_POST['report_of_date'];
			$data['report_option_selector']=$_POST['report_option_selector'];
			$data['login_office_status']= $login_status;

            $data['report_of_office'] = $this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
            if($download==1)
            {
				ini_set('memory_limit', '512M');
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                  $pdf_content = $this->load->view('iss/iss_report_display_pdf', $data, true);
				  generate_pdf($pdf_content, $pdf_filename,true);
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                   if($_POST['report_click_btn']==2){$pdf_filename='iss_form_2_missing_list_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';}
                   if($_POST['report_click_btn']==3){$pdf_filename='iss_form_2_completed_list_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';}
                   $pdf_content = $this->load->view('iss/iss_missing_completed_display_pdf', $data, true);
				   generate_pdf_landscape($pdf_content, $pdf_filename,true);
                }

            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/iss_report_display');
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('iss/iss_missing_completed_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_reportindex.php','refresh');
        }
    }

	function iss_2_certificate_data_save()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        $this->load->model('issmymodel');
		$login_status = $this->input->post('login_office_status');
		$office_id=$this->session->userdata('some_office');
		//$login_status=$this->issmymodel->get_login_office_status($office_id);

		if($login_status==4)
		{
			$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($office_id);
			if($this->issmymodel->exist_iss_cer($office_id,$_POST['report_date_send']))
			{
				$this->load->model('issmymodel');
				$this->issmymodel->delete_iss_cer($office_id,$_POST['report_date_send']);
				$status = $this->issmymodel->save_iss_certificate($office_id,$_POST['report_date_send']);
			}
			else
			{
				$status = $this->issmymodel->save_iss_certificate($office_id,$_POST['report_date_send']);
			}
			if($this->issmymodel->delete_iss_cer_data($office_id,$_POST['report_date_send']))
			{
				$this->issmymodel->delete_iss_data($office_id,$_POST['report_date_send']);
				$status = $this->issmymodel->save_iss_certified_data($office_id,$_POST['report_date_send']);
			}
			else
			{
				$status = $this->issmymodel->save_iss_certified_data($office_id,$_POST['report_date_send']);
			}
			if($status=='success')
			{
			   $this->session->set_flashdata('success_wp','ISS Certificate have been saved successfully');
			   redirect('iss/iss_report','refresh');
			}
			else
			{
				   redirect('iss/iss_report','refresh');
			}

		}
        else
		{

			if($login_status != 4)
			{
				if($this->issmymodel->exist_iss_cer($office_id,$_POST['report_date_send']))
				{
					$this->load->model('issmymodel');
					$this->issmymodel->delete_iss_cer($office_id,$_POST['report_date_send']);
					$status = $this->issmymodel->save_iss_certificate($office_id,$_POST['report_date_send']);
				}
				else
				{
					$status = $this->issmymodel->save_iss_certificate($office_id,$_POST['report_date_send']);
				}
			}
			if($status=='success')
			{
			   $this->session->set_flashdata('success_wp','ISS Certificate have been saved successfully');
			   redirect('iss/iss_report','refresh');
			}
			else
			{
			   redirect('iss/iss_report','refresh');
			}
		}

    }

	/** 
	 * ISS Form-2 customized report start
	*/

	public function iss2_cust_comp_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

			 $this->load->model('issmymodel');

        //login office
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}
//iss2_cust_report_view
        $data['content']=('iss/iss_2_cust_report/iss2_cust_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss2_cust_comp_report_details($download=0)
    {
		if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

	    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id=$this->session->userdata('some_office');

            if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
            {
               $report_of_office_id = $_POST['iss_report_office_id'];
            }
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);

			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);
			$date_1='';
			$date_2='';

			if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}
			if(isset($_POST['report_of_date2'])){$date_2=$_POST['report_of_date2'];}
			if($date_1 !='' && $date_2 !='')
			{
				if(strtotime($date_1)>strtotime($date_2))
				{
					$temp=$date_1;
					$date_1=$date_2;
					$date_2=$temp;
				}
			}
			else
			{
				if($date_1 != '' && $date_2 != ''){$date_1=$date_1;$date_2=$date_2;}
			}
			if(isset($login_status) && $login_status == 4 && $login_status !=1)
			{
				$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
			}
			else
			{
				$office_id=$report_of_office_id;
			}
			//$data['certificate_exist1'] = $this->issmymodel->fetch_iss_certificate_exist($office_id,$date_1);
			//$data['certificate_exist2'] = $this->issmymodel->fetch_iss_certificate_exist($office_id,$date_2);
			if(isset($login_status) && $login_status !=1)
			{
				$data['iss_2_comp_data'] = $this->issmymodel->fetch_iss_2_cust_comp_data($branch_id_array_for_report,$date_1,$date_2);
			}

			if(isset($login_status) && $login_status != 4 && $login_status !=1)
			{
				$data['iss_2_comp_no_days_exced_cash_data'] = $this->issmymodel->fetch_iss_2_comp_no_cash_execd_data($branch_id_array_for_report,$date_1,$date_2);
			}
			if(isset($login_status) && $login_status == 1)
			{
				$data['iss_2_comp_data'] = $this->issmymodel->fetch_iss_2_cust_whole_br_comp_data($date_1,$date_2);
				$data['iss_2_whole_br_raw'] = $this->issmymodel->fetch_iss_2_whole_br_list_raw($date_1,$date_2);
				$data['whole_br_list'] = $this->issmymodel->fetch_iss_whole_br_list();
			}

			$data['result_array']=array();

            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              if(isset($result_array) && count($result_array)>0)
              {
                foreach($result_array as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }

                }
              }

              $data['count_all']=count($branch_id_array_for_report);
              $data['count_missing_completed']=count($data['result_array']);
              if($_POST['report_click_btn']==2)
              {
                $data['sign']='Missing';
              }
              if($_POST['report_click_btn']==3)
              {
                $data['sign']='Completed';
              }
          }

            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }

            $data['report_click_btn']=$_POST['report_click_btn'];
            $data['report_of_date1']=$date_1;
            $data['report_of_date2']=$date_2;
			$data['report_option_selector']=$_POST['report_option_selector'];

            $data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

            $data['fig_indication']= '';
			if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
			{
			$data['fig_indication']= $_POST['fig_indication_post'];
			}

			$data['fig_indication_p']= '';
			if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
			{
			$data['fig_indication_p']= $_POST['fig_indication_post_p'];
			}

			if(isset($_POST['actionbtn']))
			{
				$data['action_btn']= $_POST['actionbtn'];
			} else {
				$data['action_btn']= '';
			}


			/////////////////////////////////////////////////////
            if($download==1)
            {
				 if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
				{
					$data['content']=('iss/iss_2_cust_report/iss2_cust_comparision_report_display');
					 $data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//pdf
				{
					ini_set('memory_limit', '512M');
					$pdf_filename='';
					$pdf_content='';
					$pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/iss_2_cust_report/iss2_cust_comparision_report_display_pdf', $data, true);
					generate_pdf($pdf_content, $pdf_filename,true);
				}

            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/iss_2_cust_report/iss2_cust_comparision_report_display');
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('iss/iss_missing_completed_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_comparision_reportindex.php','refresh');
        }
    }
	/**
	 * ISS Form-2 customized report end
	 */
	/////////////////////////// ISS comparision report start/////////////////////////////////
	public function iss_comparision_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

			 $this->load->model('issmymodel');

        //login office
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/report/iss_comparision_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_comparision_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

	    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id=$this->session->userdata('some_office');

            if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
            {
               $report_of_office_id = $_POST['iss_report_office_id'];
            }
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);

			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);
			$date_1='';
			$date_2='';

			if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}
			if(isset($_POST['report_of_date2'])){$date_2=$_POST['report_of_date2'];}
			if($date_1 !='' && $date_2 !='')
			{
				if(strtotime($date_1)>strtotime($date_2))
				{
					$temp=$date_1;
					$date_1=$date_2;
					$date_2=$temp;
				}
			}
			else
			{
				if($date_1 != '' && $date_2 != ''){$date_1=$date_1;$date_2=$date_2;}
			}
			if(isset($login_status) && $login_status == 4 && $login_status !=1)
			{
				$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
			}
			else
			{
				$office_id=$report_of_office_id;
			}
			$data['certificate_exist1'] = $this->issmymodel->fetch_iss_certificate_exist($office_id,$date_1);
			$data['certificate_exist2'] = $this->issmymodel->fetch_iss_certificate_exist($office_id,$date_2);
			if(isset($login_status) && $login_status !=1)
			{
				$data['iss_2_comp_data'] = $this->issmymodel->fetch_iss_2_comp_data($branch_id_array_for_report,$date_1,$date_2);
			}

			if(isset($login_status) && $login_status != 4 && $login_status !=1)
			{
				$data['iss_2_comp_no_days_exced_cash_data'] = $this->issmymodel->fetch_iss_2_comp_no_cash_execd_data($branch_id_array_for_report,$date_1,$date_2);
			}
			if(isset($login_status) && $login_status == 1)
			{
				$data['iss_2_comp_data'] = $this->issmymodel->fetch_iss_2_whole_br_comp_data($date_1,$date_2);
				$data['iss_2_whole_br_raw'] = $this->issmymodel->fetch_iss_2_whole_br_list_raw($date_1,$date_2);
				$data['whole_br_list'] = $this->issmymodel->fetch_iss_whole_br_list();
			}

			$data['result_array']=array();

            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              if(isset($result_array) && count($result_array)>0)
              {
                foreach($result_array as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }

                }
              }

              $data['count_all']=count($branch_id_array_for_report);
              $data['count_missing_completed']=count($data['result_array']);
              if($_POST['report_click_btn']==2)
              {
                $data['sign']='Missing';
              }
              if($_POST['report_click_btn']==3)
              {
                $data['sign']='Completed';
              }
          }

            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }

            $data['report_click_btn']=$_POST['report_click_btn'];
            $data['report_of_date1']=$date_1;
            $data['report_of_date2']=$date_2;
			$data['report_option_selector']=$_POST['report_option_selector'];

            $data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

            $data['fig_indication']= '';
			if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
			{
			$data['fig_indication']= $_POST['fig_indication_post'];
			}

			$data['fig_indication_p']= '';
			if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
			{
			$data['fig_indication_p']= $_POST['fig_indication_post_p'];
			}

			if(isset($_POST['actionbtn']))
			{
				$data['action_btn']= $_POST['actionbtn'];
			} else {
				$data['action_btn']= '';
			}


			/////////////////////////////////////////////////////
            if($download==1)
            {
				 if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
				{
					$data['content']=('iss/report/iss_comparision_report_display');
					 $data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//pdf
				{
					ini_set('memory_limit', '512M');
					$pdf_filename='';
					$pdf_content='';
					$pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss_comparision_report_display_pdf', $data, true);
					generate_pdf($pdf_content, $pdf_filename,true);
				}

            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/report/iss_comparision_report_display');
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('iss/iss_missing_completed_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_comparision_reportindex.php','refresh');
        }
    }
///////////////////////////ISS comparision report end/////////////////////////////////


/////////////////////////// ISS Form-2 item wise report start/////////////////////////////////
	public function iss_form_2_itemwise_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');

        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

		if($query_iss_2_item = $this->issmymodel->iss_foem2_get_item_date())
		{
			$data['form2_iss_item'] = $query_iss_2_item;
		}

        $data['content']=('iss/report/iss_form_2_itemwise_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_form_2_itemwise_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {

			if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
			{
				$this->load->model('issmymodel');
				$report_of_office_id=$this->session->userdata('some_office');

				if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
				{
				   $report_of_office_id = $_POST['iss_report_office_id'];
				}
				$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
				if(isset($report_of_office_id) && $report_of_office_id>0)
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
				}
				else
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
				}
				$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);
				/////////////////////////////////////////////////////////////////////////////////////
					$date_1='';
					$date_2='';

					if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}
					if(isset($_POST['report_of_date2'])){$date_2=$_POST['report_of_date2'];}

					if($date_1 !='' && $date_2 !='')
					{
						if(strtotime($date_1)>strtotime($date_2))
						{
							$temp=$date_1;
							$date_1=$date_2;
							$date_2=$temp;
						}
					}
					else
					{
						if($date_1 != '' && $date_2 != ''){$date_1=$date_1;$date_2=$date_2;}
					}

					//$report_of_iss2_item_val = $_POST['report_of_iss2_item'];
					$chkbox = $_POST['report_of_iss2_item'];

					foreach($chkbox as $a => $b)
					{
						if( $chkbox[$a] != ' ')
						{
							$report_of_iss2_item_val = $chkbox[$a];
						}
					}

					if(isset($login_status) && $login_status == 4 && $login_status !=1)
					{
						$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
					}
					else
					{
						$office_id=$report_of_office_id;
					}
					$data['certificate_exist1'] = $this->issmymodel->fetch_iss_certificate_exist($office_id,$date_1);
					$data['certificate_exist2'] = $this->issmymodel->fetch_iss_certificate_exist($office_id,$date_2);
					$data['iss_2_item_data'] = $this->issmymodel->fetch_iss_2_item_wise_data($branch_id_array_for_report,$date_1,$date_2,$report_of_iss2_item_val);
					if(isset($login_status) && $login_status == 1)
					{
						$data['iss_2_item_data'] = $this->issmymodel->fetch_iss_2_whole_br_item_data($date_1,$date_2,$report_of_iss2_item_val);
						$data['iss_2_whole_br_raw'] = $this->issmymodel->fetch_iss_2_whole_br_list_raw($date_1,$date_2);
						$data['whole_br_list'] = $this->issmymodel->fetch_iss_whole_br_list();
					}

				/////////////////////////////////////////////////////////////////////////////////////
				$data['result_array']=array();
				if(!empty($_POST))
				{
					foreach($_POST as $key=>$val)
					{
						$data['previous_value'][$key]=$val;
					}
				}

				$data['report_click_btn'] = $_POST['report_click_btn'];
				$data['report_of_date1']=$date_1;
				$data['report_of_date2']=$date_2;
				$data['report_option_selector']=$_POST['report_option_selector'];

				$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

				$data['fig_indication']= '';
					if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
					{
					$data['fig_indication']= $_POST['fig_indication_post'];
					}

					$data['fig_indication_p']= '';
					if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
					{
					$data['fig_indication_p']= $_POST['fig_indication_post_p'];
					}

					if(isset($_POST['actionbtn']))
					{
					$data['action_btn']= $_POST['actionbtn'];
					} else {
					$data['action_btn']= '';
					}


				/////////////////////////////////////////////////////
				if($download==1)
				{
					  ini_set('memory_limit', '512M');
					 $pdf_filename='';
					 $pdf_content='';
					 if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
					{
					 $data['content']=('iss/report/iss_form_2_itemwise_report_display');
					 $data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
					}
					if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//pdf
					{
					 $pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					  $pdf_content = $this->load->view('iss/report/iss_form_2_itemwise_report_display_pdf', $data, true);
					  generate_pdf($pdf_content, $pdf_filename,true);
					}

				}
				else
				{
					if($_POST['report_click_btn']==1)//view report
					{
					 $data['content']=('iss/report/iss_form_2_itemwise_report_display');
					}
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
			}
			if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 2)
			{

				$this->load->model('issmymodel');
				$report_of_office_id=$this->session->userdata('some_office');

				if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
				{
				   $report_of_office_id = $_POST['iss_report_office_id'];
				}

				$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);

				if(isset($report_of_office_id) && $report_of_office_id>0)
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
				}
				else
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
				}
				$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);

				ini_set('memory_limit', '1024M');
				$this->load->model('issmymodel');

				$date1 = '';
				$date2 = '';

				$date_1 = '';
				$date_2 = '';

				if(isset($_POST['report_of_date1'])){ $date_1=$_POST['report_of_date1']; }
				if(isset($_POST['report_of_date2'])){ $date_2=$_POST['report_of_date2']; }

				if( $date_1 !='' && $date_2 !='' )
				{
					$dt1 = $date_1;
					$dt2 = $date_2;
					if(strtotime($dt1)>strtotime($dt2))
					{
						$date2 = $dt1;
						$date1 = $dt2;
					}
					else
					{
						$date1 = $dt1;
						$date2 = $dt2;
					}

				}

				if($_POST['report_click_btn']==2)//graph
				{

					$chkbox = $_POST['report_of_iss2_item'];

					foreach($chkbox as $a => $b)
					{
						if( $chkbox[$a] != ' ')
						{
							$coid_array[] = $chkbox[$a];
						}
					}

					$date_array = $this->issmymodel->fetch_graph_date_str($date1, $date2);
					$iss_item_name1 = '';

					if($iss_item_1 = $this->issmymodel->fetch_graph_date($branch_id_array_for_report, $date_array, $coid_array ))
					{
						$data['form2_iss_item_data'] = $iss_item_1;
					}

					$data['fig_indication']= '';
					if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
					{
					$data['fig_indication']= $_POST['fig_indication_post'];
					}

					$data['fig_indication_p']= '';
					if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
					{
					$data['fig_indication_p']= $_POST['fig_indication_post_p'];
					}

					if(isset($_POST['actionbtn']))
					{
					$data['action_btn']= $_POST['actionbtn'];
					} else {
					$data['action_btn']= '';
					}


					$mon = 0;
					if(!empty($_POST))
					{
						foreach($_POST as $key=>$val)
						{
							$data['previous_value'][$key] = $val;
						}
					}
					if( $download == 1 )
					{
						$data['content']=('iss/report/iss_graph/iss_2_graph_display.php');

						$data['link_str']='See Bar Graph';
						$data['graph_title']='Line Graph';
						$data['link_param']=0;

						$data['uid']= $this->session->userdata('some_name1');
						$data['txt_office_name']= $this->session->userdata('some_name2');
						$data['dat_entry_date']= $this->session->userdata('some_name3');
						$data['logout']='home/logout';
						$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
						$this->load->view('home',$data);
					}
					else {
						$data['content']=('iss/report/iss_graph/iss_2_graph_display.php');

						$data['link_str']='See Line Graph';
						$data['graph_title']='Bar Graph';
						$data['link_param']=1;

						$data['uid']= $this->session->userdata('some_name1');
						$data['txt_office_name']= $this->session->userdata('some_name2');
						$data['dat_entry_date']= $this->session->userdata('some_name3');
						$data['logout']='home/logout';
						$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
						$this->load->view('home',$data);
					}
				}
				else
				{
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
			}
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_form_2_itemwise_reportindex.php','refresh');
        }
    }
///////////////////////////ISS Form-2 item wiae and Graph report end/////////////////////////////////

///////////////////////////ISS Abnormal increase decrease start/////////////////////////////////
	public function iss_abn_inr_dec_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

			 $this->load->model('issmymodel');

        //login office
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/report/abn_incr_dec/iss_abn_incr_dec_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_abn_inr_dec_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

	    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id=$this->session->userdata('some_office');

            if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
            {
               $report_of_office_id = $_POST['iss_report_office_id'];
            }
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);

			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status'] = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);
			$date_1='';
			if(isset($_POST['report_of_date1'])){$date_1 = $_POST['report_of_date1'];}

			if(isset($login_status) && $login_status == 4 && $login_status !=1)
			{
				$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
			}
			else
			{
				$office_id=$report_of_office_id;
			}
			if($this->issmymodel->iss_get_date())
			{
				$query_alldate = $this->issmymodel->iss_get_date();
			}
			$pre_date_key = ''; $pre_date_value = '';
			foreach($query_alldate as $key => $arr)
			{
				if($_POST['report_of_date1'] == $arr->ISSEntryDate)
				{
					$prev_date = $query_alldate[$key+1]->ISSEntryDate;
				}
			}
			$data['pre_report_of_date'] = $prev_date;
			$data['iss_2_abn_incrdecr_data'] = $this->issmymodel->fetch_iss_2_abn_incr_decr_data( $branch_id_array_for_report, $date_1, $prev_date );

			if(isset($login_status) && $login_status != 4 && $login_status !=1)
			{
				$data['iss_2_comp_no_days_exced_cash_data'] = $this->issmymodel->fetch_iss_2_comp_no_cash_execd_data($branch_id_array_for_report,$date_1,$prev_date);
			}
			if(isset($login_status) && $login_status == 1)
			{
				$data['iss_2_comp_data'] = $this->issmymodel->fetch_iss_2_whole_br_comp_data($date_1,$prev_date);
				$data['iss_2_whole_br_raw'] = $this->issmymodel->fetch_iss_2_whole_br_list_raw($date_1,$prev_date);
				$data['whole_br_list'] = $this->issmymodel->fetch_iss_whole_br_list();
			}

			$data['result_array']=array();

            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              if(isset($result_array) && count($result_array)>0)
              {
                foreach($result_array as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }

                }
              }

              $data['count_all']=count($branch_id_array_for_report);
              $data['count_missing_completed']=count($data['result_array']);
              if($_POST['report_click_btn']==2)
              {
                $data['sign']='Missing';
              }
              if($_POST['report_click_btn']==3)
              {
                $data['sign']='Completed';
              }
          }

            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
			$data['login_office_status'] = $login_status;
            $data['report_click_btn'] = $_POST['report_click_btn'];
            $data['report_of_date1'] = $prev_date;
            $data['report_of_date2'] = $date_1;
			$data['report_option_selector'] = $_POST['report_option_selector'];

            $data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

             $data['fig_indication']= '';
			if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
			{
			$data['fig_indication']= $_POST['fig_indication_post'];
			}

			$data['fig_indication_p']= '';
			if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
			{
			$data['fig_indication_p']= $_POST['fig_indication_post_p'];
			}

			if(isset($_POST['actionbtn']))
			{
				$data['action_btn']= $_POST['actionbtn'];
			} else {
				$data['action_btn']= '';
			}

			/////////////////////////////////////////////////////
            if($download==1)
            {
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
				{
					$data['content']=('iss/report/abn_incr_dec/iss_abn_incr_dec_report_display');
					$data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);

				}
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//view report
				{
					ini_set('memory_limit', '512M');
	                 $pdf_filename='';
	                 $pdf_content='';
	                 if($_POST['report_click_btn']==1)//view report
	                {
	                  $pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
	                  $pdf_content = $this->load->view('iss/report/abn_incr_dec/iss_abn_incr_dec__report_display_pdf', $data, true);
					  generate_pdf($pdf_content, $pdf_filename,true);
	                }
				}

            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/report/abn_incr_dec/iss_abn_incr_dec_report_display');
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('iss/report/abn_incr_dec/iss_missing_completed_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_abn_inr_dec_reportindex.php','refresh');
        }
    }
///////////////////////////ISS Abnormal increase decrease end/////////////////////////////////

///////////////////////////ISS Form-4 report start/////////////////////////////////
	public function iss_form_4_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/iss_4/iss_4_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_form_4_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

	    if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id=$this->session->userdata('some_office');

            if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
            {
               $report_of_office_id = $_POST['iss_report_office_id'];
            }
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);

			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);

			if(isset($login_status) && $login_status == 4 && $login_status !=1)
			{
				$data['branch_id_bb'] = $office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
			}
			else
			{
				$office_id = $report_of_office_id;
			}

			$data['iss_4_data'] = $this->issmymodel->fetch_iss_4_data_branch($branch_id_array_for_report, $_POST['report_of_date']);

			if(isset($login_status) && $login_status == 1)
			{
				$data['iss_4_data'] = $this->issmymodel->fetch_iss_4_data_head_off( $branch_id_array_for_report,  $_POST['report_of_date']);
				//$data['iss_2_whole_br_raw'] = $this->issmymodel->fetch_iss_2_whole_br_list_raw($date_1,$date_2);
				//$data['whole_br_list'] = $this->issmymodel->fetch_iss_whole_br_list();
			}

			$data['result_array']=array();

            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              if(isset($result_array) && count($result_array)>0)
              {
                foreach($result_array as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }

                }
              }

              $data['count_all']=count($branch_id_array_for_report);
              $data['count_missing_completed']=count($data['result_array']);
              if($_POST['report_click_btn']==2)
              {
                $data['sign']='Missing';
              }
              if($_POST['report_click_btn']==3)
              {
                $data['sign']='Completed';
              }
          }

            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }

            $data['report_click_btn']=$_POST['report_click_btn'];
            $data['report_of_date']= $_POST['report_of_date'];

			$data['report_option_selector']=$_POST['report_option_selector'];
            $data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);
            if($download==1)
            {
				ini_set('memory_limit', '512M');
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
                  $pdf_content = $this->load->view('iss/report/iss_comparision_report_display_pdf', $data, true);
				  generate_pdf($pdf_content, $pdf_filename,true);
                }
            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/iss_4/iss_4_report_display');
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('iss/iss_missing_completed_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_form_4_reportindex.php','refresh');
        }
    }
///////////////////////////ISS Form-4 report end/////////////////////////////////

/////////////////////////// ISS Form-2 continous report start/////////////////////////////////
	public function iss_form_2_continous_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');
        //login office
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_continous_report_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/report/continous_report/iss_contionous_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_form_2_continous_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id=$this->session->userdata('some_office');

            if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
            {
               $report_of_office_id = $_POST['iss_report_office_id'];
            }
            $login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);

			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id = $report_of_office_id;
				}
				if(isset($login_status) && $login_status !=1)
				{
					$data['iss_2_item_data'] = $this->issmymodel->fetch_iss_2_continous_data($branch_id_array_for_report,$_POST['report_of_date_con_year']);
				}
				if(isset($login_status) && $login_status == 1)
				{
					$data['iss_2_item_data'] = $this->issmymodel->fetch_iss_2_whole_br_continous_data($_POST['report_of_date_con_year']);
				}

			$data['result_array']=array();

            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
			  if(isset($result_array) && count($result_array)>0)
              {
                foreach($result_array as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;
					  $data['status'] = $row['status'];
                    }
                }
              }

              $data['count_all']=count($branch_id_array_for_report);
              $data['count_missing_completed']=count($data['result_array']);
              if($_POST['report_click_btn']==2)
              {
                $data['sign']='Missing';
              }
              if($_POST['report_click_btn']==3)
              {
                $data['sign']='Completed';
              }
          }

            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }

            $data['report_click_btn']=$_POST['report_click_btn'];
            $data['report_of_date1']=$_POST['report_of_date_con_year'];
			$data['report_option_selector']=$_POST['report_option_selector'];

            $data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

            $data['fig_indication']= '';
			if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
			{
			$data['fig_indication']= $_POST['fig_indication_post'];
			}

			$data['fig_indication_p']= '';
			if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
			{
			$data['fig_indication_p']= $_POST['fig_indication_post_p'];
			}

			/////////////////////////////////////////////////////
            if($download==1)
            {
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
				{
					$data['content']=('iss/report/continous_report/iss_contionous_report_display');
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//pdf
				{
					ini_set('memory_limit', '512M');
	                $pdf_filename='';
	                $pdf_content='';
	                if($_POST['report_click_btn']==1)//view report
	                {
	                  $pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date_con_year'].'.pdf';
	                  $pdf_content = $this->load->view('iss/report/continous_report/iss_contionous_report_display_pdf', $data, true);
					  generate_pdf($pdf_content, $pdf_filename,true);
	                }
				}
            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/report/continous_report/iss_contionous_report_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_form_2_continous_reportindex.php','refresh');
        }
    }
///////////////////////////ISS Form-2 continous report end/////////////////////////////////

	/*---------------- ISS Form-2 end---------------------------------------------*/
	function iss_2_report_certificate()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id=$this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
        //fetch required data start
		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}
        $data['content']=('iss/iss_2_cer_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
/*#######################################################################################*/
/*---------------------------- ISS Admin panel start------------------------------------*/
/*#######################################################################################*/
	function iss_admin_panel()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
		   $data['login_office_status'] = $this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
			$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/admin-iss/iss_admin_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

	function iss_form_2_process_data_detail()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

        $data['off_id'] = $office_id = $this->session->userdata('some_office');
		$this->load->model('issmymodel');
		if($this->issmymodel->process_iss_2_whole_branch_status($_POST['fetched_date']))
		{
			$this->session->set_flashdata('success_iss_process','ISS Processed Completed');
		}


        $data['content']=('iss/admin-iss/iss_admin_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

	function iss_admin_entry_date_form()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
		   $data['login_office_status'] = $this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
			$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}
		if($query_issdate = $this->issmymodel->iss_get_admin_date())
		{
			$data['query_issadmindate'] = $query_issdate;
		}

        $data['content']=('iss/admin-iss/iss_admin_date_enty_form');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

/*CRUD test start*/
	function entry_product_form(){
        //$this->load->view('product_view');
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
		   $data['login_office_status'] = $this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
			$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}
		if($query_issdate = $this->issmymodel->iss_get_admin_date())
		{
			$data['query_issadmindate'] = $query_issdate;
		}

        $data['content']=('iss/admin-iss/product/product_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
    }

    function product_data(){
    	$this->load->model('issmymodel');
        $data=$this->issmymodel->product_list();
        echo json_encode($data);
    }

    function save(){
    	$this->load->model('issmymodel');
        $data=$this->issmymodel->save_product();
        echo json_encode($data);
    }

    function update(){
    	$this->load->model('issmymodel');
        $data=$this->issmymodel->update_product();
        echo json_encode($data);
    }

    function delete(){
    	$this->load->model('issmymodel');
        $data=$this->issmymodel->delete_product();
        echo json_encode($data);
    }
/*CRUD test end*/
/*#######################################################################################*/
/*---------------------------- ISS Admin panel end------------------------------------*/
/*#######################################################################################*/


/*#######################################################################################*/
/*------------------------ ISS Form-1 start---------------------------------------------*/
/*#######################################################################################*/

	/*--16/06/2017--*/
	function iss1_con()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');

		$data['office_id'] = $office_id= $this->session->userdata('some_office');
		if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
        }
		if($query3 = $this->issmymodel->iss_get_deptt_date())
		{
			$data['records3'] = $query3;
		}
		if($query_dept = $this->issmymodel->iss_get_deptt())
		{
			$data['dept_list'] = $query_dept;
		}
		$data['u_office_code'] = $this->session->userdata('some_office');

        $data['content']=('iss/iss_1/iss1_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	/*****### Department wise ISS Form-1 start #####*****/
	//date-25-09-2018
	function iss_1_deptt_entry_con()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$office_id = $this->session->userdata('some_office');
        $this->load->model('issmymodel');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status' ]= $this->issmymodel->get_login_office_status(0);
        }
		$data['office_id'] = $office_id;

		if($query3 = $this->issmymodel->iss_get_deptt_date())
		{
			$data['records3'] = $query3;
		}
		if($query_dept = $this->issmymodel->iss_get_deptt())
		{
			$data['dept_list'] = $query_dept;
		}

        $data['content']=('iss/iss_1/iss_1_deptt_entry_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

	function iss_1_deptt_enrty_date_check()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$check_date = $this->input->post('fetched_date');
		$this->load->model('issmymodel');
		if($query_date = $this->issmymodel->iss_get_check_deptt_date($check_date))
		{
			$data['query_date_val'] = $query_date;
		}

		$startDate = '';
		$enDate = '';
		foreach ($data['query_date_val'] as $key => $value) {
			$startDate = $value->stDate;
			$enDate = $value->endDate;;
		}

		if( strtotime(date("Y-m-d")) >=strtotime($startDate) && strtotime(date("Y-m-d")) <= strtotime($enDate)){
			$this->iss_1_entry_view_details();
		} else {
			$this->session->set_flashdata('notsuccess_deptt_view','Data Submission Cut off Date is over');
	  		 redirect('iss/iss_1_deptt_entry_con','refresh');
		}
    }

	function iss_1_entry_view_details()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id = $this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }

		if($query_iss1_item_dept_info = $this->issmymodel->iss1_item_dept_info_get($_POST['iss_deptt_code']))
		{
			$data['iss1_item_dep_info_list'] = $query_iss1_item_dept_info;
		}
		if($query_iss_1_sector = $this->issmymodel->iss_1_sector($_POST['fetched_date']))
		{
			$data['iss_1_sector'] = $query_iss_1_sector;
		}
		if($query_iss_2_sector = $this->issmymodel->iss_2_sector($_POST['fetched_date']))
		{
			$data['iss_2_sector'] = $query_iss_2_sector;
		}
		$data['iss_2_whole_data'] = '';
		if($query_iss_2_whole_br_data = $this->issmymodel->iss_2_whole_br_data($_POST['fetched_date']))
		{
			$data['iss_2_whole_data'] = $query_iss_2_whole_br_data;
		}
		$data['iss1_deptwise_info'] = '';
		if($query_iss1_deptwise_info = $this->issmymodel->iss1_deptwise_info_get($_POST['fetched_date'], $_POST['iss_deptt_code']))
		{
			$data['iss1_deptwise_info'] = $query_iss1_deptwise_info;
		}
		$data['iss1_dept_cer_info'] = '';
		if($query_iss1_dept_cer_info = $this->issmymodel->iss1_deptwise_cer_info_get($_POST['fetched_date'], $_POST['iss_deptt_code']))
		{
			$data['iss1_dept_cer_info'] = $query_iss1_dept_cer_info;
		}
		$data['designation_dropdown']=$this->issmymodel->get_designation_dropdown_iss();
		$data['entry_date']=$_POST['fetched_date'];
		$data['deptt_code_entry']=$_POST['iss_deptt_code'];
			
		//strat
		$data['deptt_ui_code'] = $office_id;
		if($query_date = $this->issmymodel->iss_get_check_deptt_date($this->input->post('fetched_date')))
		{
			$data['query_date_val'] = $query_date;
		}
		//end
	
		$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($_POST['iss_deptt_code'], 1);
		$data['count_all']=count($branch_id_array_for_report);	
		$data['result_miss'] = $this->issmymodel->fetch_iss_ho_br_missing($_POST['fetched_date']);
	
	    $data['content']=('iss/iss_1/iss_1_entry_view_form');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

	function iss_1_data_save()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$report_of_office_id = $this->session->userdata('some_office');
		$this->load->model('issmymodel');
		$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
		if($login_status == 1)
		{
			$status = $this->issmymodel->iss1_dept_cer_insert_fun();
			$status = $this->issmymodel->iss1_data_insert_fun();
			if($status=='success')
            {
               $this->session->set_flashdata('success_iss1','Department data have been saved successfully');
	  		   redirect('iss/iss_1_deptt_entry_con','refresh');
            }
			else
			{
				$this->session->set_flashdata('error_iss1','Department data have not been saved successfully');
	  		    redirect('iss/iss_1_deptt_entry_con','refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('error_iss1_2','You are not right person to submit this data.');
			redirect('iss/iss_1_deptt_entry_con','refresh');
		}
    }

	function iss1_dept_report()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
		if($query3 = $this->issmymodel->iss_get_deptt_date())
		{
			$data['records3'] = $query3;
		}
		if($query_dept = $this->issmymodel->iss_get_deptt())
		{
			$data['dept_list'] = $query_dept;
		}

        $data['content']=('iss/iss_1/iss1_dept_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	function iss1_dept_report_view($download = 0)
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id=$this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
        if($query_iss1_item_dept_info = $this->issmymodel->iss1_item_dept_info_get($_POST['fetched_deptt']))
		{
			$data['iss_1_info_list'] = $query_iss1_item_dept_info;
		}

		if($query_iss_1_sector = $this->issmymodel->iss_1_sector($_POST['fetched_date']))
		{
			$data['iss_1_sector'] = $query_iss_1_sector;
		}
		if($query_iss_2_sector = $this->issmymodel->iss_2_sector($_POST['fetched_date']))
		{
			$data['iss_2_sector'] = $query_iss_2_sector;
		}
		$data['iss_2_whole_data'] = '';
		if($query_iss_2_whole_br_data = $this->issmymodel->iss_2_whole_br_data($_POST['fetched_date']))
		{
			$data['iss_2_whole_data'] = $query_iss_2_whole_br_data;
		}
		$data['iss1_deptwise_info'] = '';
		if($query_iss1_deptwise_info = $this->issmymodel->iss1_deptwise_info_get($_POST['fetched_date'], $_POST['fetched_deptt']))
		{
			$data['iss1_deptwise_info'] = $query_iss1_deptwise_info;
		}

		$data['iss1_dept_cer_info']= '';
		if($query_iss1_dept_cer_info = $this->issmymodel->iss1_deptwise_cer_info_get($_POST['fetched_date'], $_POST['fetched_deptt']))
		{
			$data['iss1_dept_cer_info'] = $query_iss1_dept_cer_info;
		}
		$data['designation_dropdown']=$this->issmymodel->get_designation_dropdown();


		$data['entry_date']=$_POST['fetched_date'];
		$data['deptt_code_entry']=$_POST['fetched_deptt'];
		

		//start
		$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($_POST['fetched_deptt'], 1);
		$data['count_all']=count($branch_id_array_for_report);	
		$data['result_miss'] = $this->issmymodel->fetch_iss_ho_br_missing($_POST['fetched_date']);
		
		//end
		 if($download==1)
		{
			ini_set('memory_limit', '512M');
			 $pdf_filename='';
			 $pdf_content='';
			// if($_POST['report_click_btn']==1)//view report
			{
			  $pdf_filename='Iss_from_2_'.$office_id.'_'.$_POST['fetched_date'].'.pdf';
			  $pdf_content = $this->load->view('iss/iss_1/iss1_dept_report_details_form_pdf', $data, true);
			  generate_pdf($pdf_content, $pdf_filename,true);
			}

		}
		else {
				$data['content']=('iss/iss_1/iss1_dept_report_details_form');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
		}
	}
	/*start*/
	function iss1_bb_form_report_view()
	{
      if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
        if($query3 = $this->issmymodel->iss_get_deptt_date())
		{
			$data['records3'] = $query3;
		}


        $data['content']=('iss/iss_1/iss1_bb/iss1_bb_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

	function iss1_bb_form_details()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id=$this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }

		$data['iss2_form_details_info'] = '';
		//if($query_iss2_form_details_info = $this->issmymodel->iss2_br_details_info_get($_POST['fetched_date']))
		if($query_iss2_form_details_info = $this->issmymodel->iss_2_whole_br_data($_POST['fetched_date']))
		{
			$data['iss2_form_details_info'] = $query_iss2_form_details_info;
		}

		$data['iss1_deptt_details_info'] = '';
		if($query_iss1_dept_details_info = $this->issmymodel->iss1_deptt_details_info_get($_POST['fetched_date']))
		{
			$data['iss1_dept_details_info'] = $query_iss1_dept_details_info;
		}
		$data['iss1_bb_submit_details_info'] = '';
		if($query_iss1_bb_submit_details_info = $this->issmymodel->iss1_bb_sub_details_info_get($_POST['fetched_date']))
		{
			$data['iss1_bb_submit_details_info'] = $query_iss1_bb_submit_details_info;
		}

		$data['entry_date']=$_POST['fetched_date'];
		$data['deptt_code_val']=$office_id;


$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($office_id, 1);
$data['count_all']=count($branch_id_array_for_report);	
$data['result_miss'] = $this->issmymodel->fetch_iss_ho_br_missing($_POST['fetched_date']);

        $data['content']=('iss/iss_1/iss1_bb/iss1_bb_form1_report_details');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

/*BB to decision submit start*/	
function iss1_bb_decesion_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	$this->load->model('issmymodel');

	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_deptt_date())
	{
		$data['records3'] = $query3;
	}
	$data['content']=('iss/iss_1/iss1_bb/iss1_bb_view_decesion');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

	function iss1_bb_decesion_details()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id=$this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }

		$data['iss2_form_details_info'] = '';
		//if($query_iss2_form_details_info = $this->issmymodel->iss2_br_details_info_get($_POST['fetched_date']))
		if($query_iss2_form_details_info = $this->issmymodel->iss_2_whole_br_data($_POST['fetched_date']))
		{
			$data['iss2_form_details_info'] = $query_iss2_form_details_info;
		}

		$data['iss1_deptt_details_info'] = '';
		if($query_iss1_dept_details_info = $this->issmymodel->iss1_deptt_details_info_get($_POST['fetched_date']))
		{
			$data['iss1_dept_details_info'] = $query_iss1_dept_details_info;
		}
		$data['iss1_bb_submit_details_info'] = '';
		if($query_iss1_bb_submit_details_info = $this->issmymodel->iss1_bb_sub_details_info_get($_POST['fetched_date']))
		{
			$data['iss1_bb_submit_details_info'] = $query_iss1_bb_submit_details_info;
		}

		$data['iss1_bb_decesion_info'] = '';
		if($query_iss1_bb_decesion_info = $this->issmymodel->iss1_bb_decesion_info_get($_POST['fetched_date']))
		{
			$data['iss1_bb_decesion_info'] = $query_iss1_bb_decesion_info;
		}

		$data['entry_date']=$_POST['fetched_date'];
		$data['deptt_code_val']=$office_id;

		
$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($office_id, 1);
$data['count_all']=count($branch_id_array_for_report);	
$data['result_miss'] = $this->issmymodel->fetch_iss_ho_br_missing($_POST['fetched_date']);

        $data['content']=('iss/iss_1/iss1_bb/iss1_form1_decision_to_submit');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

/*BB to decison submit end*/
/*Form-1 prepare data start*/
function iss1_bb_prepare_view()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	$this->load->model('issmymodel');

	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_deptt_date())
	{
		$data['records3'] = $query3;
	}
	$data['content']=('iss/iss_1/iss1_bb/iss1_bb_view_prepare');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

	function iss1_bb_prepare_details()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id=$this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
		$data['iss1_bb_submit_details_info'] = '';
		if($query_iss1_bb_submit_details_info = $this->issmymodel->iss1_bb_sub_details_info_get($_POST['fetched_date']))
		{
			$data['iss1_bb_submit_details_info'] = $query_iss1_bb_submit_details_info;
		}

		$data['iss1_bb_decesion_info'] = '';
		if($query_iss1_bb_decesion_info = $this->issmymodel->iss1_bb_decesion_info_get($_POST['fetched_date']))
		{
			$data['iss1_bb_decesion_info'] = $query_iss1_bb_decesion_info;
		}

		$data['entry_date']=$_POST['fetched_date'];
		$data['deptt_code_val']=$office_id;

        $data['content']=('iss/iss_1/iss1_bb/iss1_form1_prepare_data');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	function iss1_bb_form_details_save()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$report_of_office_id = $this->session->userdata('some_office');
		$this->load->model('issmymodel');
		$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
		if($login_status == 1)
		{
			//$status = $this->issmymodel->iss1_dept_cer_insert_fun();
			$status = $this->issmymodel->iss1_bb_data_insert_fun();
			if($status=='success')
            {
               $this->session->set_flashdata('success_iss1','ISS Form-1 data have been saved successfully');
	  		   redirect('iss/iss1_bb_decesion_view','refresh');
            }
			else
			{
				$this->session->set_flashdata('error_iss1','ISS Form-1 data have not been saved successfully');
	  		    redirect('iss/iss1_bb_decesion_view','refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('error_iss1_2','You are not right person to submit this data.');
			redirect('iss/iss1_bb_decesion_view','refresh');
		}
	}
	/*Form-1 prepare data end*/
    /*end*/

	/*****### END Department wise ISS Form-1 END#####*****/

	/*--20-02-2017--start*/
	function iss1_form_report_view()
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
        //fetch required data start
		if($query3 = $this->issmymodel->iss_get_deptt_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/iss_1/iss1_form_reprt_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	function iss1_form_report_details($download=0)
	{
       if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('issmymodel');
        //login office
        $office_id=$this->session->userdata('some_office');

        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }



		if($this->issmymodel->iss_get_date())
		{
			$query_alldate = $this->issmymodel->iss_get_date();
		}

		$prev_date = '';
		foreach($query_alldate as $key => $arr)
		{
			if($_POST['fetched_date'] == $arr->ISSEntryDate)
			{
				$prev_date = $query_alldate[$key+1]->ISSEntryDate;
			}
		}

		if($query_iss1_form_details_info = $this->issmymodel->iss1_details_info_get($_POST['fetched_date'], $prev_date))
		{
			$data['iss1_form_details_info'] = $query_iss1_form_details_info;
		}
		if(!empty($_POST))
		{
			foreach($_POST as $key=>$val)
			{
				$data['previous_value'][$key]=$val;
			}
		}

		$data['entry_date']= $_POST['fetched_date'];
		$data['prev_date']= $prev_date;

		 $data['fig_indication']= '';
			if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
			{
			$data['fig_indication']= $_POST['fig_indication_post'];
			}

			$data['fig_indication_p']= '';
			if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
			{
			$data['fig_indication_p']= $_POST['fig_indication_post_p'];
			}

			if(isset($_POST['actionbtn']))
			{
				$data['action_btn']= $_POST['actionbtn'];
			} else {
				$data['action_btn']= '';
			}

		if($download == 1)
		{
			if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
			{
				$data['content']=('iss/iss_1/iss1_form1_report_details');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
			if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//pdf
			{
				ini_set('memory_limit', '512M');
				 $pdf_filename='';
				 $pdf_content='';
				// if($_POST['report_click_btn']==1)//view report
				{
				  $pdf_filename='ISS_from_1_'.$office_id.'_'.$_POST['fetched_date'].'.pdf';
				  $pdf_content = $this->load->view('iss/iss_1/iss1_form1_report_details_pdf', $data, true);
				  generate_pdf_landscape($pdf_content, $pdf_filename,true);
				}
			}

		}
		else
		{
			$data['content']=('iss/iss_1/iss1_form1_report_details');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
		}

	}
	/*--20-02-2017--end*/


	/////////////////////////// ISS Form-1 continous report start--16/06/2017--/////////////////////////////////
	public function iss_form_1_continous_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');
        //login office
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_continous_report_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/iss_1/continous_report/iss1_contionous_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_form_1_continous_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id=$this->session->userdata('some_office');

			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}

			//if(isset($login_status) && $login_status == 1)
			{
				$data['iss_1_item_data'] = $this->issmymodel->fetch_iss_1_continous_data($_POST['report_of_date_con_year']);
			}

            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }

            $data['report_click_btn']=$_POST['report_click_btn'];
            $data['report_of_date1']=$_POST['report_of_date_con_year'];

            $data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,1);


            $data['fig_indication']= '';
			if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
			{
			$data['fig_indication']= $_POST['fig_indication_post'];
			}

			$data['fig_indication_p']= '';
			if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
			{
			$data['fig_indication_p']= $_POST['fig_indication_post_p'];
			}


			/////////////////////////////////////////////////////
            if($download ==1 )
            {
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
				{
	                $data['content']=('iss/iss_1/continous_report/iss1_contionous_report_display');
	                $data['uid']= $this->session->userdata('some_name1');
	                $data['txt_office_name']= $this->session->userdata('some_name2');
	                $data['dat_entry_date']= $this->session->userdata('some_name3');
	                $data['logout']='home/logout';
	                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	                $this->load->view('home',$data);
				}
				if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//pdf
				{
					ini_set('memory_limit', '512M');
	                $pdf_filename='';
	                $pdf_content='';
	                $pdf_filename='Iss_from_1_'.$report_of_office_id.'_'.$_POST['report_of_date_con_year'].'.pdf';
	                  $pdf_content = $this->load->view('iss/iss_1/continous_report/iss1_contionous_report_display_pdf', $data, true);
					  generate_pdf($pdf_content, $pdf_filename,true);
				}

            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/iss_1/continous_report/iss1_contionous_report_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_form_1_continous_reportindex.php','refresh');
        }
    }
	///////////////////////////ISS Form-1 continous report end --16/06/2017--/////////////////////////////////


/////////////////////////// ISS Form-1 item wise report start/////////////////////////////////
	public function iss_form_1_itemwise_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');

        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

		if($query_iss_1_item = $this->issmymodel->iss_form_1_get_item_date())
		{
			$data['form1_iss_item'] = $query_iss_1_item;
		}

        $data['content']=('iss/iss_1/item_report/iss_form_1_itemwise_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_form_1_itemwise_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {

			if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
			{
				$this->load->model('issmymodel');
				$report_of_office_id=$this->session->userdata('some_office');

				if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
				{
				   $report_of_office_id = $_POST['iss_report_office_id'];
				}
				$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
				if(isset($report_of_office_id) && $report_of_office_id>0)
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
				}
				else
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
				}

				$date1 = '';
				$date2 = '';

				$date_1 = '';
				$date_2 = '';

				if(isset($_POST['report_of_date1'])){ $date_1=$_POST['report_of_date1']; }
				if(isset($_POST['report_of_date2'])){ $date_2=$_POST['report_of_date2']; }

				if( $date_1 !='' && $date_2 !='' )
				{
					$dt1 = $date_1;
					$dt2 = $date_2;
					if(strtotime($dt1)>strtotime($dt2))
					{
						$date2 = $dt1;
						$date1 = $dt2;
					}
					else
					{
						$date1 = $dt1;
						$date2 = $dt2;
					}
				}
					$chkbox = $_POST['report_of_iss1_item'];

					foreach($chkbox as $a => $b)
					{
						if( $chkbox[$a] != ' ')
						{
							$coid_array[] = $chkbox[$a];
						}
					}

					$date_array = $this->issmymodel->fetch_graph_date_str($date1, $date2);

					$iss_item_name1 = '';

					if($iss_item_1 = $this->issmymodel->fetch_iss1_graph_data($date_array, $coid_array ))
					{
						$data['form1_iss_item_data'] = $iss_item_1;
					}

					if(!empty($_POST))
					{
						foreach($_POST as $key=>$val)
						{
							$data['previous_value'][$key] = $val;
						}
					}

				$data['fig_indication']= '';
				if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
				{
					$data['fig_indication']= $_POST['fig_indication_post'];
				}

				$data['report_click_btn'] = $_POST['report_click_btn'];
				$data['report_of_date1']=$date_1;
				$data['report_of_date2']=$date_2;

				/////////////////////////////////////////////////////
				if($download==1)
				{
					if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
					{
					 $data['content']=('iss/iss_1/item_report/iss_form_1_itemwise_report_display');
					}
					if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//view report
					{
					 $pdf_filename='Iss_from_1_'.$report_of_office_id.'_'.$_POST['pdf_btn_inst'].'.pdf';
                  $pdf_content = $this->load->view('iss/iss_1/item_report/iss_form_1_itemwise_report_display_pdf', $data, true);
				  generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
					}
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);

				}
				else
				{
					if($_POST['report_click_btn']==1)//view report
					{
					 $data['content']=('iss/iss_1/item_report/iss_form_1_itemwise_report_display');
					}
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
			}
			if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 2)
			{
				$this->load->model('issmymodel');
				$report_of_office_id=$this->session->userdata('some_office');

				if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
				{
				   $report_of_office_id = $_POST['iss_report_office_id'];
				}

				$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);

				if(isset($report_of_office_id) && $report_of_office_id>0)
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
				}
				else
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
				}
				ini_set('memory_limit', '1024M');
				$this->load->model('issmymodel');

				$date1 = '';
				$date2 = '';

				$date_1 = '';
				$date_2 = '';

				if(isset($_POST['report_of_date1'])){ $date_1=$_POST['report_of_date1']; }
				if(isset($_POST['report_of_date2'])){ $date_2=$_POST['report_of_date2']; }

				if( $date_1 !='' && $date_2 !='' )
				{
					$dt1 = $date_1;
					$dt2 = $date_2;
					if(strtotime($dt1)>strtotime($dt2))
					{
						$date2 = $dt1;
						$date1 = $dt2;
					}
					else
					{
						$date1 = $dt1;
						$date2 = $dt2;
					}
				}
				if($_POST['report_click_btn']==2)//graph
				{
					$chkbox = $_POST['report_of_iss1_item'];
					foreach($chkbox as $a => $b)
					{
						if( $chkbox[$a] != ' ')
						{
							$coid_array[] = $chkbox[$a];
						}
					}

					$date_array = $this->issmymodel->fetch_graph_date_str($date1, $date2);

					$iss_item_name1 = '';

					if($iss_item_1 = $this->issmymodel->fetch_iss1_graph_data($date_array, $coid_array ))
					{
						$data['form1_iss_item_data'] = $iss_item_1;
					}

					if(!empty($_POST))
					{
						foreach($_POST as $key=>$val)
						{
							$data['previous_value'][$key] = $val;
						}
					}

				$data['fig_indication']= '';
				if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
				{
					$data['fig_indication']= $_POST['fig_indication_post'];
				}

				$data['fig_indication_p']= '';
				if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
				{
					$data['fig_indication_p']= $_POST['fig_indication_post_p'];
				}


				$data['report_click_btn'] = $_POST['report_click_btn'];
				$data['report_of_date1']=$date_1;
				$data['report_of_date2']=$date_2;

				if(isset($_POST['actionbtn']))
				{
					$data['action_btn']= $_POST['actionbtn'];
				} else {
					$data['action_btn']= '';
				}

				if( $download == 1 )
				{
					$data['content']=('iss/iss_1/item_report/iss_1_graph_display.php');

					$data['link_str']='See Bar Graph';
					$data['graph_title']='Line Graph';
					$data['link_param']=0;

					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
				else
				{
					$data['content']=('iss/iss_1/item_report/iss_1_graph_display.php');

					$data['link_str']='See Line Graph';
					$data['graph_title']='Bar Graph';
					$data['link_param']=1;

					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
			}
			else
			{

				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
			}
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_form_1_itemwise_reportindex.php','refresh');
        }
    }
///////////////////////////ISS Form-1 item wiae and Graph report end/////////////////////////////////
/*#######################################################################################*/
/*------------------------ ISS Form-1 end---------------------------------------------*/
/*#######################################################################################*/

///////////////////////////ISS Form-4 report start --16/06/2017--/////////////////////////////////
	public function iss_form_3_report()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

        $data['content']=('iss/iss_3/iss_3_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_form_3_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {
			$this->load->model('issmymodel');
            $report_of_office_id=$this->session->userdata('some_office');

			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$data['iss_3_item_data'] = $this->issmymodel->fetch_iss_3_data($_POST['report_of_date_iss3']);

           if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }

            $data['report_click_btn']=$_POST['report_click_btn'];
            $data['report_of_date1']=$_POST['report_of_date_iss3'];
			/*$data['report_option_selector']=$_POST['report_option_selector'];*/

            $data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,1);
			/////////////////////////////////////////////////////
            if($download ==1 )
            {
				ini_set('memory_limit', '512M');
                $pdf_filename='';
                $pdf_content='';
                if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='Iss_from_1_'.$report_of_office_id.'_'.$_POST['report_of_date_iss3'].'.pdf';
                  $pdf_content = $this->load->view('iss/iss_3/iss_3_report_display_pdf', $data, true);
				  generate_pdf($pdf_content, $pdf_filename,true);
                }

            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('iss/iss_3/iss_3_report_display');
                }
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data);
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_form_3_reportindex.php','refresh');
        }
    }
///////////////////////////ISS Form-3 report end --16/06/2017--/////////////////////////////////


/*#######################################################################################*/
/*------------------------ ISS Letter information system report start  ------------------*/
/*#######################################################################################*/
	public function br_letter()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');
        $data['content']=('iss/bb_letter_report/iss_letter_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

	public function iss_bb_letter_report_view()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query_iss_2_item = $this->issmymodel->iss_foem2_get_item_date())
		{
			$data['form2_iss_item'] = $query_iss_2_item;
		}
        $data['content']=('iss/bb_letter_report/bb_letter_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_bb_letter_report_save($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');

		$iss_report_office_id_val = $_POST['iss_report_office_id'];

		if($iss_report_office_id_val != '')
		{
			$this->issmymodel->bb_iss_letter_save();
			$this->session->set_flashdata('success_br','Letter Information have been saved successfully');
			redirect('iss/iss_bb_letter_report_view','refresh');
		}
		else
		{
			redirect('iss/iss_bb_letter_report_view','refresh');
		}
    }
	public function iss_bb_letter_report_search_view()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');
        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query_iss_2_item = $this->issmymodel->iss_foem2_get_item_date())
		{
			$data['form2_iss_item'] = $query_iss_2_item;
		}
        $data['content']=('iss/bb_letter_report/bb_letter_report_search_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
	function iss_bb_letter_display_form($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');

		$iss_report_office_id_val = $_POST['iss_report_office_id'];
		$data['br_code'] = $_POST['iss_report_office_id'];

		if($query_iss_letter_info = $this->issmymodel->iss_letter_info_details($_POST['iss_report_office_id']))
		{
			$data['iss_leter_info'] = $query_iss_letter_info;
		}

		if($query_br_info = $this->issmymodel->branch_details_info($_POST['iss_report_office_id']))
		{
			$data['br_info'] = $query_br_info;
		}
		$data['content']=('iss/bb_letter_report/bb_letter_report_search_display');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
    }
	function bb_letter_info_delete($sl_id=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('issmymodel');
		if($sl_id != 0)
		{
			if($this->issmymodel->br_letter_del_info($sl_id))
			{
				$this->session->set_flashdata('success_br','Letter Information delete successfully');
				redirect('iss/iss_bb_letter_report_search_view','refresh');
			}
			else
			{
				$this->session->set_flashdata('error_br','Letter Information has not delete successfully');
				redirect('iss/iss_bb_letter_report_search_view','refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('success_br','Letter Information has not delete successfully');
			redirect('iss/iss_bb_letter_report_search_view','refresh');
		}
    }
/*#######################################################################################*/
/*---------------------------- ISS Letter information system report end  ------------------------*/
/*#######################################################################################*/
//ISS END

/*----------------Basic function start-------------------------*/
function fetch_br_ao_do_iss()
    {
        $response='';
        if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='')
        {
           $this->load->model('issmymodel');
           $br_ao_do_array = $this->issmymodel->fetch_br_ao_do_iss($_POST['br_ao_do'],$_POST['br_ao_do_str']);

            if($_POST['br_ao_do']==2)
            {
                $index_name='branchname';
                $index_val='brcode';
                //$index_val='bbbrcode';
            }

            if($_POST['br_ao_do']==3)
            {
                $index_name='znname';
                $index_val='zncode';

            }

            if($_POST['br_ao_do']==4)
            {
                $index_name='dvname';
                $index_val='jbdvcode';

            }

			if($_POST['br_ao_do']==6)
            {
                $index_name='dvname';
                $index_val='jbdvcode';

            }

          if(count($br_ao_do_array)>0)
          {
            $response .='<td COLSPAN="2"><h6 style="color: olive;">';
            foreach($br_ao_do_array as $key=>$val)
            {
                if($_POST['br_ao_do']==6)
                {
                  $response .='<input type="radio" id="br_ao_do" name="iss_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';
                }
                else
                {
					$response .='<input type="radio" id="br_ao_do" name="iss_report_office_id" value="'.$val[$index_val].'">'.'<label for="radio3" style="display:inline">'.$val[$index_name].'</label>'.'<br/>';
                }
            }
            $response .='</td>';
          }
        }
        echo $response;
        exit();
    }
/*#######################**********ISS Graph start **#########################################*/
public function iss_graph_view()
 {
	if ($this->session->userdata('some_name1')=='')
	{
		 redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');
	//login office
	$office_id=$this->session->userdata('some_office');

	if(isset($office_id) && $office_id>0)
	{
		//$data['login_office_status']=$this->mymodel->get_login_office_status($office_id);
		$data['login_office_status'] = $this->issmymodel->get_login_office_status_iss($office_id);
	}
	else
	{
		//$data['login_office_status']=$this->mymodel->get_login_office_status(0);
		$data['login_office_status'] = $this->issmymodel->get_login_office_status_iss(0);

	}


	//if($query3 = $this->mymodel->get_om__report_date())
		if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss_graph/iss_com_graph_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}
function iss_com_graph_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
		 redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{

		ini_set('memory_limit', '1024M');
		$this->load->model('issmymodel');
		$report_of_office_id=$this->session->userdata('some_office');

		if(isset($_POST['omis_com_graph_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
		{
		   $report_of_office_id=$_POST['omis_com_graph_office_id'];
		}

		//$branch_id_array_for_report=$this->issmymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
		$branch_id_array_for_report=$this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);

		$date1='';
		$date2='';
		$date3='';

		$date_1='';
		$date_2='';
		$date_3='';

		if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}
		if(isset($_POST['report_of_date2'])){$date_2=$_POST['report_of_date2'];}
		//if(isset($_POST['report_of_date3'])){$date_3=$_POST['report_of_date3'];}


		//if($date_1 !='' && $date_2 !='' && $date_3 !='')
		//echo $date_1."=".$date_2;
		if( $date_1 !='' && $date_2 !='' )
		{
			$dt1 = $date_1;
			$dt2 = $date_2;
			//$dt3=$date_3;

			//if(strtotime($dt1)>strtotime($dt2) && strtotime($dt1)>strtotime($dt3))

			//if(strtotime($dt2)>strtotime($dt1) && strtotime($dt2)>strtotime($dt3))
			if(strtotime($dt1)>strtotime($dt2))
			{
				$date2 = $dt1;
				$date1 = $dt2;

			}
			else
			{
				$date1 = $dt1;
				$date2 = $dt2;
			}

		}
		//echo $date1."=".$date2;
		//die();
		//Now prepare option
		/*if($_POST['report_click_btn']==1)//comparison
		{
			 if($query = $this->mymodel->get_records())
			{
				$data['records1'] = $query;
			}
			if($query1 = $this->mymodel->get_records2())
			{
				$data['records2'] = $query1;
			}

		  /*if($date3 !='')
		  {
			$data['records3_date3']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$date3);
			$data['completed_vs_total_date3']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$date3);
		  } */

		 /* if($date2 !='')
		  {
			$data['records3_date2']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$date2);
			$data['completed_vs_total_date2']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$date2);
		  }

		  if($date1 !='')
		  {
			$data['records3_date1']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$date1);
			$data['completed_vs_total_date1']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$date1);
		  }
		}*/

		if($_POST['report_click_btn']==2)//graph
		{
			// $query1 = $this->issmymodel->om_graph_prod_id_dep();
			 //$query2 = $this->issmymodel->om_graph_prod_id_adv();

			  //fetch date
			 // if($date3 =='')
			 // {
				//echo $date1;
				$date_array = $this->issmymodel->fetch_graph_date_str($date1, $date2);
			  //}
			  //else
			 // {
				//$date_array=$this->mymodel->fetch_graph_date_str($date1, $date3);
			 // }
			 // echo "Hello--bal";
			 // echo "<pre>";
			 //print_r($date_array);
			// die();
			$iss_advance_para = 1010405;
			$iss_item_name1 = '';
			  //fetch advance data advance_data_array
			  $advance_data_array=$this->issmymodel->fetch_graph_date($branch_id_array_for_report, $date_array, $iss_advance_para );
			   foreach($advance_data_array as $adpVal)
			   {
				   foreach($adpVal as $singlePara1Val)
				   {
					  $amt_adv[] = $singlePara1Val->AMOUNT_BDT;
					  $iss_item_name1 = $singlePara1Val->COA_DESCRIPTION;
				   }
			   }
			  // echo "<pre>";
			  //echo $iss_item_name1;
			  // print_r($advance_data_array);
			  // print_r($amt_dep);
			  // die();
			  //now prepare deposit data
				//$dat=array();
				//$amt_dep=array();
				//$amt_sum=0;
				/*foreach($date_array as $datte)
				{
				  foreach($query1 as $prid)
				  {
				  foreach($deposit_data_array as $grap)
					{
					 if(($datte['om_dat_date']==$grap['dd_end_dt'])&&($prid->pt_id==$grap['dd_pt_id']))
					 {
						$amt_sum=$amt_sum+$grap['dd_amt'];
					 }
					}
				  }
				  $amt_dep[]=$amt_sum;
				  $amt_sum=0;
				} */

			  // fetch advance data
			  $iss_deposit_para = 1010215;
			  $iss_item_name2 = '';
			  $deposit_data_array=$this->issmymodel->fetch_graph_date($branch_id_array_for_report, $date_array, $iss_deposit_para );
			   foreach($deposit_data_array as $depVal)
			   {
				   foreach($depVal as $singlePara2Val)
				   {
					  $amt_dep[] = $singlePara2Val->AMOUNT_BDT;
					  $iss_item_name1 = $singlePara1Val->COA_DESCRIPTION;
				   }
			   }
			  // print_r($amt_dep);
			   //die();
			  //$deposit_data_array=$this->mymodel->fetch_graph_date($branch_id_array_for_report,$date_array,6);

			  //now prepare advance data
				/*$amt_adv=array();
				$adv_sum=0;
				foreach($date_array as $datte)
				{
				  foreach($query2 as $prid2)
				  {
				  foreach($deposit_data_array as $adv)
					{
					 if(($datte['om_dat_date']==$adv['dd_end_dt'])&&($prid2->pt_id==$adv['dd_pt_id']))
					 {
						$adv_sum=$adv_sum+$adv['dd_amt'];
					 }
					}
				  }
				  $amt_adv[]=$adv_sum;
				  $adv_sum=0;
				}
				*/
				//print_r($date_array); die();
			//further process
		   //foreach($date_array as $datte)
			{
			  //$dat[]=substr($datte['om_dat_date'],0,11);
			 // $dat[] = $datte;
			}

			//print_r($dat);
			//die();
			$data_['popul']['data'] =$amt_dep;
			$data_['popul']['name'] = $iss_item_name1;
			//$data_['popul']['name'] = 'Deposit';

			$data_['users']['data'] =$amt_adv;
			$data_['users']['name'] = $iss_item_name2;
			//$data_['users']['name'] = 'Advance';
			//$data_['axis']['categories'] =$dat;
			$data_['axis']['categories'] =$date_array;

			foreach ($data_['popul']['data'] as $key => $val)
			{
				$output[] = (object)array(
					'Deposit' 		=> $val,
					'Advance'	=> $data_['users']['data'][$key],
					'contries'		=> $data_['axis']['categories'][$key]
				);
				/*$output[] = (object)array(
					'Deposit_RR' 		=> $val,
					'Advance_RR'	=> $data_['users']['data'][$key],
					'contries'		=> $data_['axis']['categories'][$key]
				);*/
			}

			//check unit of graph
		   /* $y_axix_unit='Amount in Billions';

			if(isset($data_['popul']['data']) && MAX($data_['popul']['data'])<1000000000 && isset($data_['users']['data']) && MAX($data_['users']['data'])<1000000000)
			{
				$y_axix_unit='Amount in Millions';
			}   */
		}
		//Now load view

		//first save data for pdf
		if(!empty($_POST))
		{
			foreach($_POST as $key=>$val)
			{
				$data['previous_value'][$key]=$val;
			}
		}
		$data['report_click_btn']=$_POST['report_click_btn'];
		$data['report_of_date1']=$date1;
		$data['report_of_date2']=$date2;
		if(isset($date3) && $date3 !='')
		{
		  $data['report_of_date3']=$date3;
		}

		//$data['report_of_office']=$this->issmymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
		$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);


		if($download==1)
		{
			 $pdf_filename='';
			 $pdf_content='';
			 if($_POST['report_click_btn']==1)//download comparison
			{
			  $pdf_filename='omis_comparison_'.$report_of_office_id.'.pdf';
			  $pdf_content = $this->load->view('comparison_graph/omis_comparison_display_pdf', $data, true);
			  if($date3=='')
			  {
			   generate_pdf($pdf_content, $pdf_filename,true);
			  }
			  else
			  {
				generate_pdf_landscape($pdf_content, $pdf_filename,true);
			  }

			}
			if($_POST['report_click_btn']==2)//download graph
			{
					$graph_data = $data_;
					$this->load->library('highcharts');
					$this->highcharts
				   ->initialize('chart_template')
				  ->push_xAxis($graph_data['axis'])
				  ->set_serie($graph_data['popul'])
				  ->set_serie($graph_data['users'],'Advance');
				  $this->highcharts->set_title('Deposit and Advance Figure');
				 //$this->highcharts->set_axis_titles('.', $y_axix_unit);
				 $this->highcharts->set_axis_titles('.', 'Deposit & Advance');
				 $data['charts'] = $this->highcharts->render();
				 //$data['content']=('comparison_graph/omis_graph_display');
				 $data['content']=('iss/report/iss_graph/iss_graph_display');

				 $data['param']=$download;
				 //conversion str
				$data['link_str']='See Line Graph';
				$data['graph_title']='Bar Graph';
				$data['link_param']=0;

				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		else
		{
			if($_POST['report_click_btn']==1)//display comparison
			{
				$data['content']=('comparison_graph/omis_comparison_display');
			}
			if($_POST['report_click_btn']==2)//display graph
			{

				$result = $output;
				$dat1['x_labels'] 	= 'contries';
				$dat1['series'] 	= array('Deposit', 'Advance');
				$dat1['data']		= $result;
				$this->load->library('highcharts');
				$this->highcharts->set_title('Deposit and Advance Figure');
				//$this->highcharts->set_axis_titles('', $y_axix_unit);
				$this->highcharts->set_axis_titles('', 'Deposit & Advance');
				$this->highcharts->from_result($dat1)->add(); // first graph: add() register the graph
				$data['charts'] = $this->highcharts->render();
				$data['content']=('comparison_graph/omis_graph_display');
				$data['param']=$download;
				//conversion str
				$data['link_str']='See Bar Graph';
				$data['graph_title']='Line Graph';
				$data['link_param']=1;
			}

			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
		}
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/rpd/omis_reportindex.php','refresh');
	}
}
function fetch_br_ao_do_iss_com_graph()
    {
        $response='';
        if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='')
        {
           $this->load->model('mymodel');
           $br_ao_do_array=$this->mymodel->fetch_br_ao_do($_POST['br_ao_do'],$_POST['br_ao_do_str']);

            if($_POST['br_ao_do']==2)
            {
                $index_name='BRANCH_NAME';
                $index_val='jbbrcode';
            }

            if($_POST['br_ao_do']==3)
            {
                $index_name='ZoneName';
                $index_val='ZoneCode';
            }

            if($_POST['br_ao_do']==4)
            {
                $index_name='DivisionName';
                $index_val='jbdivisioncode';
            }

            if($_POST['br_ao_do']==6)
            {
                $index_name='DivisionName';
                $index_val='jbdivisioncode';
            }

          if(count($br_ao_do_array)>0)
          {
            $response .='<td COLSPAN="6"><h6 style="color: olive;">';
            foreach($br_ao_do_array as $key=>$val)
            {
                if($_POST['br_ao_do']==6)
                {
                  $response .='<input type="radio" id="br_ao_do" name="omis_com_graph_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';
                }
                else
                {
                 $response .='<input type="radio" id="br_ao_do" name="omis_com_graph_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'<br/>';
                }
            }
            $response .='</td>';
          }
        }

        echo $response;


        exit();
    }
/*#######################**********ISS Graph end **#########################################**/
///////////////////////////iss2_0001 report start/////////////////////////////////


function fetch_iss2_item()
{
	$response='';
    if(isset($_POST['key_val_pre']) && $_POST['key_val_pre'] !=' ')
    {
        $this->load->model('issmymodel');
        $br_ao_do_array = $this->issmymodel->fetch_iss2_item_val($_POST['key_val_pre']);
        if(count($br_ao_do_array)>0)
        {

            $response .='<td COLSPAN="2">';
            $response .='<div class="iss2_border_1"><input type="checkbox" id="toggle" value="select" onClick="do_this()" /><label for="radio3" style="display:inline">'.'Select/Deselect All'.'</label> </div>'.'<br/>';
            foreach($br_ao_do_array as $key=>$val)
            {
				$response .='<div class="iss2_border"><input type="checkbox" value="'.$val['SUPERVISION_COA_ID'].'" name="iss2chk[]"/> '.'<label for="radio3" style="display:inline">'.$val['COA_DESCRIPTION'].'</label></div>'.'<br/>';
            }
            $response .='</td>';
        }
    }
    echo $response;
    exit();
}
	public function iss_2_001_report()
	{
         if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');

        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

		if($query_iss_2_item = $this->issmymodel->iss_foem2_get_iss2_0001_data())
		{
			$data['form2_iss_item'] = $query_iss_2_item;
		}

        $data['content']=('iss/report/iss2_0001/iss_2_0001_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

    function iss_2_001_report_details($download=0)
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {

			if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
			{
				$this->load->model('issmymodel');
				$report_of_office_id=$this->session->userdata('some_office');

				if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
				{
				   $report_of_office_id = $_POST['iss_report_office_id'];
				}
				$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
				if(isset($report_of_office_id) && $report_of_office_id>0)
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
				}
				else
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
				}
				$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_iss($report_of_office_id,$_POST['report_option_selector']);
				/////////////////////////////////////////////////////////////////////////////////////
					$date_1='';
					$date_2='';

					if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}
					if(isset($_POST['report_of_date2'])){$date_2=$_POST['report_of_date2'];}

					if($date_1 !='' && $date_2 !='')
					{
						if(strtotime($date_1)>strtotime($date_2))
						{
							$temp=$date_1;
							$date_1=$date_2;
							$date_2=$temp;
						}
					}
					else
					{
						if($date_1 != '' && $date_2 != ''){$date_1=$date_1;$date_2=$date_2;}
					}

					$coid_array= array();

					$chkbox = $_POST['iss2chk'];

					foreach($chkbox as $a => $b)
					{
						if( $chkbox[$a] != ' ')
						{
							$coid_array[] = $chkbox[$a];
						}
					}

					if(isset($login_status) && $login_status == 4 && $login_status !=1)
					{
						$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
					}
					else
					{
						$office_id=$report_of_office_id;
					}

					if(isset($login_status) && $login_status == 4){
					$data['iss_2_item_data'] = $this->issmymodel->fetch_iss_2_data_cat_item($branch_id_array_for_report,$date_1,$date_2,$coid_array);
					}
					if(isset($login_status) && $login_status != 4)
					{
						$data['iss_2_item_data'] = $this->issmymodel->fetch_iss_2_data_cat_item_ar_do($branch_id_array_for_report,$date_1,$date_2,$coid_array);

					}
					if(isset($login_status) && $login_status != 4 && $login_status !=1)
					{
						$data['iss_2_comp_no_days_exced_cash_data'] = $this->issmymodel->fetch_iss_2_comp_no_cash_execd_data($branch_id_array_for_report,$date_1,$date_2);
					}
					if(isset($login_status) && $login_status == 1)
					{
						//$data['iss_2_item_data'] = $this->issmymodel->fetch_iss_2_whole_br_data_cat($date_1,$date_2,$coid_array);
						$data['iss_2_whole_br_raw'] = $this->issmymodel->fetch_iss_2_whole_br_list_raw($date_1,$date_2);
						$data['whole_br_list'] = $this->issmymodel->fetch_iss_whole_br_list();
					}


/////////////////////////////////////////////////////////////////////////////////////
				$data['result_array']=array();
				if(!empty($_POST))
				{
					foreach($_POST as $key=>$val)
					{
						$data['previous_value'][$key]=$val;
					}
				}

				$data['report_click_btn'] = $_POST['report_click_btn'];
				$data['report_of_date1']=$date_1;
				$data['report_of_date2']=$date_2;
				$data['report_option_selector']=$_POST['report_option_selector'];

				$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

				$data['fig_indication']= '';
					if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
					{
					$data['fig_indication']= $_POST['fig_indication_post'];
					}

					$data['fig_indication_p']= '';
					if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
					{
					$data['fig_indication_p']= $_POST['fig_indication_post_p'];
					}

					if(isset($_POST['actionbtn']))
					{
					$data['action_btn']= $_POST['actionbtn'];
					} else {
					$data['action_btn']= '';
					}


				/////////////////////////////////////////////////////
				if($download==1)
				{
					  ini_set('memory_limit', '512M');
					 $pdf_filename='';
					 $pdf_content='';
					 if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==0)//view report
					{
					 $data['content']=('iss/report/iss2_0001/iss_2_0001_report_display');
					 $data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
					}
					if($_POST['report_click_btn']==1 && $_POST['pdf_btn_inst']==1)//pdf
					{
					 $pdf_filename='Iss_from_2_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					  $pdf_content = $this->load->view('iss/report/iss2_0001/iss_2_0001_report_display_pdf', $data, true);
					  generate_pdf($pdf_content, $pdf_filename,true);
					}

				}
				else
				{
					if($_POST['report_click_btn']==1)//view report
					{
					 $data['content']=('iss/report/iss2_0001/iss_2_0001_report_display');
					}
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
			}
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_2_001_reportindex.php','refresh');
        }
    }
///////////////////////////iss2_0001 report end/////////////////////////////////

public function iss_2_catalog_report()
{
	if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');

        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

		if($query_iss_2_item = $this->issmymodel->iss_foem2_get_item_date())
		{
			$data['form2_iss_item'] = $query_iss_2_item;
		}

        $data['content']=('iss/report/iss_form_2_report_catalog_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);

}

///////////////////////////iss2_0002 report start/////////////////////////////////
public function iss_2_002_report()
{
	if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}

		$this->load->model('issmymodel');

        $data['off_id'] = $office_id = $this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
        }
        else
        {
            $data['login_office_status']=$this->issmymodel->get_login_office_status(0);
        }
  		if($query3 = $this->issmymodel->iss_get_date())
		{
			$data['records3'] = $query3;
		}

		if($query_iss_2_item = $this->issmymodel->iss_foem2_get_item_date())
		{
			$data['form2_iss_item'] = $query_iss_2_item;
		}

        $data['content']=('iss/report/iss2_0002/iss_2_0002_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);

}

function iss_2_002_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {

			if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
			{
				$this->load->model('issmymodel');
				$report_of_office_id=$this->session->userdata('some_office');

				if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
				{
				   $report_of_office_id = $_POST['iss_report_office_id'];
				}
				$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
				if(isset($report_of_office_id) && $report_of_office_id>0)
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
				}
				else
				{
					$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
				}
				$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
				/////////////////////////////////////////////////////////////////////////////////////
					$date_1='';
					if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

					if(isset($login_status) && $login_status == 4 && $login_status !=1)
					{
						$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
					}
					else
					{
						$office_id=$report_of_office_id;
					}
					$data['iss_2_0002_data'] = $this->issmymodel->fetch_iss2_0002_data($branch_id_array_for_report,$date_1);
					
			/////////////////////////////////////////////////////////////////////////////////////
				$data['result_array']=array();
				if(!empty($_POST))
				{
					foreach($_POST as $key=>$val)
					{
						$data['previous_value'][$key]=$val;
					}
				}

				$data['report_click_btn'] = $_POST['report_click_btn'];
				$data['report_of_date1']=$date_1;
				
				$data['report_option_selector']=$_POST['report_option_selector'];

				$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

				$data['fig_indication']= '';
					if(isset($_POST['fig_indication_post']) && $_POST['fig_indication_post'] !='')
					{
					$data['fig_indication']= $_POST['fig_indication_post'];
					}

					$data['fig_indication_p']= '';
					if(isset($_POST['fig_indication_post_p']) && $_POST['fig_indication_post_p'] !='')
					{
					$data['fig_indication_p']= $_POST['fig_indication_post_p'];
					}

					if(isset($_POST['actionbtn']))
					{
					$data['action_btn']= $_POST['actionbtn'];
					} else {
					$data['action_btn']= '';
					}

				/////////////////////////////////////////////////////
				if($download==1)
				{
					  ini_set('memory_limit', '512M');
					 $pdf_filename='';
					 $pdf_content='';
					 
					if($_POST['report_click_btn']==1)//pdf
					{
					 $pdf_filename='ISS_from_2_cross_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					  $pdf_content = $this->load->view('iss/report/iss2_0002/iss_2_0002_report_display_pdf', $data, true);
					  generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
					}

				}
				else
				{
					if($_POST['report_click_btn']==1)//view report
					{
					 $data['content']=('iss/report/iss2_0002/iss_2_0002_report_display');
					}
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
			}
			
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/iss/iss_2_002_reportindex.php','refresh');
        }
}
///////////////////////////iss2_0002 report end/////////////////////////////////

///////////////////////////iss2_0003 report start/////////////////////////////////
public function iss_2_003_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0003/iss_2_0003_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_003_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{

		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
		{
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				$data['iss_2_0003_data'] = $this->issmymodel->fetch_iss2_0003_data($branch_id_array_for_report,$date_1);
				
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_cibta_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0003/iss_2_0003_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}

			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0003/iss_2_0003_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_003_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0003 report end/////////////////////////////////

///////////////////////////iss2_0004 report start/////////////////////////////////
public function iss_2_004_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0004/iss_2_0004_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_004_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{

		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
		{
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				$data['iss_2_0004_data'] = $this->issmymodel->fetch_iss2_0004_data($branch_id_array_for_report, $date_1);
				
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_10items_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0004/iss_2_0004_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}
			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0004/iss_2_0004_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_004_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0004 report end/////////////////////////////////

///////////////////////////iss2_0005 report start/////////////////////////////////
public function iss_2_005_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0005/iss_2_0005_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_005_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{

		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
		{
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				
				
				/* SERVER
				$data['iss_2_0005_data']=array();
				$report_year = date('Y', strtotime($date_1));
				$report_month = date('m', strtotime($date_1));
				$tbl_backpage ='backpage'.$report_year.$report_month;
				$tbl_affairs ='DSA'.$report_month.$report_year;
				$Q_affairs = $this->db->query("SELECT name FROM sys.views where name='$tbl_affairs'");
				$Q_backpage = $this->db->query("SELECT name FROM sys.views where name='$tbl_backpage'");
				if($Q_affairs->num_rows()>0 && $Q_backpage->num_rows()>0)
				{
					$data['iss_2_0005_data'] = $this->issmymodel->fetch_iss2_0005_data($branch_id_array_for_report, $date_1);
				}*/
				$data['iss_2_0005_data'] = $this->issmymodel->fetch_iss2_0005_data($branch_id_array_for_report, $date_1);
				
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_23items_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0005/iss_2_0005_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}
			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0005/iss_2_0005_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_005_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0005 report end/////////////////////////////////

///////////////////////////iss2_0006 report start/////////////////////////////////
public function iss_2_006_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0006/iss_2_0006_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_006_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{

		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
		{
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				
				
				/* SERVER
				$data['iss_2_0005_data']=array();
				$report_year = date('Y', strtotime($date_1));
				$report_month = date('m', strtotime($date_1));
				$tbl_backpage ='backpage'.$report_year.$report_month;
				$tbl_affairs ='DSA'.$report_month.$report_year;
				$Q_affairs = $this->db->query("SELECT name FROM sys.views where name='$tbl_affairs'");
				$Q_backpage = $this->db->query("SELECT name FROM sys.views where name='$tbl_backpage'");
				if($Q_affairs->num_rows()>0 && $Q_backpage->num_rows()>0)
				{
					$data['iss_2_0005_data'] = $this->issmymodel->fetch_iss2_0005_data($branch_id_array_for_report, $date_1);
				}*/
				$data['iss_2_0006_data'] = $this->issmymodel->fetch_iss2_0006_data($branch_id_array_for_report, $date_1);
				
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_23items_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0006/iss_2_0006_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}
			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0006/iss_2_0006_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_006_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0006 report end/////////////////////////////////

///////////////////////////iss2_0007 report start/////////////////////////////////
public function iss_2_007_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0007/iss_2_0007_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_007_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{
		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
		{
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				
				
				/* SERVER
				$data['iss_2_0007_data']=array();
				$report_year = date('Y', strtotime($date_1));
				$report_month = date('m', strtotime($date_1));
				$tbl_backpage ='backpage'.$report_year.$report_month;
				$tbl_affairs ='DSA'.$report_month.$report_year;
				$Q_affairs = $this->db->query("SELECT name FROM sys.views where name='$tbl_affairs'");
				$Q_backpage = $this->db->query("SELECT name FROM sys.views where name='$tbl_backpage'");
				if($Q_affairs->num_rows()>0 && $Q_backpage->num_rows()>0)
				{
					$data['iss_2_0007_data'] = $this->issmymodel->fetch_iss2_0005_data($branch_id_array_for_report, $date_1);
				}*/
				$data['iss_2_0007_data'] = $this->issmymodel->fetch_iss2_0007_data($branch_id_array_for_report, $date_1);
				
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_23items_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0007/iss_2_0007_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}
			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0007/iss_2_0007_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_007_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0007 report end/////////////////////////////////

///////////////////////////iss2_0008 report start/////////////////////////////////
public function iss_2_008_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0008/iss_2_0008_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_008_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{
		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
		{
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss(0);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				
				
				/* SERVER
				$data['iss_2_0007_data']=array();
				$report_year = date('Y', strtotime($date_1));
				$report_month = date('m', strtotime($date_1));
				$tbl_backpage ='backpage'.$report_year.$report_month;
				$tbl_affairs ='DSA'.$report_month.$report_year;
				$Q_affairs = $this->db->query("SELECT name FROM sys.views where name='$tbl_affairs'");
				$Q_backpage = $this->db->query("SELECT name FROM sys.views where name='$tbl_backpage'");
				if($Q_affairs->num_rows()>0 && $Q_backpage->num_rows()>0)
				{
					$data['iss_2_0007_data'] = $this->issmymodel->fetch_iss2_0005_data($branch_id_array_for_report, $date_1);
				}*/
				$data['iss_2_0008_data'] = $this->issmymodel->fetch_iss2_0008_data($branch_id_array_for_report, $date_1);
				// echo "<pre>";
				// print_r($data['iss_2_0008_data']);
				// die();
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id, $_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_23items_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0008/iss_2_0008_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}
			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0008/iss_2_0008_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_008_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0008 report end/////////////////////////////////

///////////////////////////iss2_0009 report start/////////////////////////////////
function iss_2_009_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0009/iss_2_0009_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_009_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{
		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] == 1)
		{
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				
			$data['iss_2_0009_data'] = $this->issmymodel->fetch_iss2_0009_data($branch_id_array_for_report, $date_1);
				
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_clitems_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0009/iss_2_0009_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}
			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0009/iss_2_0009_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_009_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0009 report end/////////////////////////////////

///////////////////////////iss2_0010 report start/////////////////////////////////
function iss_2_010_report()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$this->load->model('issmymodel');

	$data['off_id'] = $office_id = $this->session->userdata('some_office');
	if(isset($office_id) && $office_id>0)
	{
		$data['login_office_status'] = $this->issmymodel->get_login_office_status($office_id);
	}
	else
	{
		$data['login_office_status']=$this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_date())
	{
		$data['records3'] = $query3;
	}

	$data['content']=('iss/report/iss2_0010/iss_2_0010_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function iss_2_010_report_details($download=0)
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
	{
		if(isset($_POST['report_click_btn']) && $_POST['report_click_btn'] > 0)
		{
			
			$this->load->model('issmymodel');
			$report_of_office_id=$this->session->userdata('some_office');

			if(isset($_POST['iss_report_office_id']) && $_POST['iss_report_office_id']>=1)//OWN REPORT
			{
				$report_of_office_id = $_POST['iss_report_office_id'];
			}
			$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
			if(isset($report_of_office_id) && $report_of_office_id>0)
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			else
			{
				$data['login_office_status']=$this->issmymodel->get_login_office_status_iss($report_of_office_id);
			}
			$branch_id_array_for_report = $this->issmymodel->fetch_branch_array_for_report_module($report_of_office_id,$_POST['report_option_selector']);
			/////////////////////////////////////////////////////////////////////////////////////
				$date_1='';
				if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}

				if(isset($login_status) && $login_status == 4 && $login_status !=1)
				{
					$data['branch_id_bb']=$office_id = '12'.$office_id = $this->issmymodel->get_bb_brcode($report_of_office_id);
				}
				else
				{
					$office_id=$report_of_office_id;
				}
				
			$data['iss_2_0010_data'] = $this->issmymodel->fetch_iss2_0010_data($branch_id_array_for_report, $date_1);
		
			
		/////////////////////////////////////////////////////////////////////////////////////
			$data['result_array']=array();
			if(!empty($_POST))
			{
				foreach($_POST as $key=>$val)
				{
					$data['previous_value'][$key]=$val;
				}
			}

			$data['report_click_btn'] = $_POST['report_click_btn'];
			$data['report_of_date1']=$date_1;
			
			$data['report_option_selector']=$_POST['report_option_selector'];

			$data['report_of_office']=$this->issmymodel->fetch_report_of_office_iss($report_of_office_id,$_POST['report_option_selector']);

			/////////////////////////////////////////////////////
			if($download==1)
			{
				ini_set('memory_limit', '512M');
				$pdf_filename='';
				$pdf_content=''; 
				if($_POST['report_click_btn']==1)//pdf
				{
					$pdf_filename='ISS_from_2_clitems_'.$report_of_office_id.'_'.$_POST['report_of_date1'].'.pdf';
					$pdf_content = $this->load->view('iss/report/iss2_0010/iss_2_0010_report_display_pdf', $data, true);
					generate_pdf_landscape_legal($pdf_content, $pdf_filename,true);
				}
			}
			else
			{
				if($_POST['report_click_btn']==1)//view report
				{
					$data['content']=('iss/report/iss2_0010/iss_2_0010_report_display');
				}
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}
		}
		
	}
	else
	{
		$this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
		redirect(base_url().'index.php/iss/iss_2_010_reportindex.php','refresh');
	}
}
///////////////////////////iss2_0010 report end/////////////////////////////////

function parent_id_get()
{
	$id=0;
	$menu_access_id=$this->session->userdata('menu_access_id');
	if(isset($menu_access_id) && $menu_access_id>0)
	{
		$id=$menu_access_id;
	}
	return $id;
}
/*----------------Basic function end-------------------------*/
}