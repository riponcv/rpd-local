<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Drs extends CI_Controller {
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
		$data['module_name']='Department Reporting System';
		//quick link
        $this->session->set_userdata('quick_link','10');
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}


/**
 * Drs start
 */

function drs_9030_view_ctrler()
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

	$data['content']=('drs/drs_9030/drs_9030_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function drs_903001_entry_ctrler()
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
		$data['login_office_status' ] = $this->issmymodel->get_login_office_status(0);
	}
	
	
	if($query3 = $this->issmymodel->iss_get_deptt_date())
	{
		$data['records3'] = $query3;
	}
	$data['office_id'] = $office_id;

	$data['content']=('drs/drs_9030/drs_903001_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function drs_903001_data_save_ctrler()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$report_of_office_id = $this->session->userdata('some_office');
	$this->load->model('issmymodel');
	$date_param = $this->input->post('report_of_date');
	$login_status = $this->issmymodel->get_login_office_status_iss($report_of_office_id);
	if($login_status == 4)
	{
		$status = $this->issmymodel->drs903001_data_insert_fun($date_param);
		if($status=='success')
		{
			$this->session->set_flashdata('success_iss1','Department data have been saved successfully');
			redirect('iss/drs_903001_entry_ctrler','refresh');
		}
		else
		{
			$this->session->set_flashdata('error_iss1','Department data have not been saved successfully');
			redirect('iss/drs_903001_entry_ctrler','refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('error_iss1_2','You are not right person to submit this data.');
		redirect('iss/drs_9030_view_ctrler','refresh');
	}
}

function drs_90300102_report_ctrler()
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
	if($query_prod = $this->issmymodel->drs_get_90300102_product( ))
	{
		$data['drs_90300102_list'] = $query_prod;
	}

	$data['content']=('drs/drs_9030/drs_90300102_report_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}
/** 9032 start */
function drs_9032_view_ctrler()
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
	$data['drs903201_info'] = $this->issmymodel->drs903201_get_info($office_id);


	$data['content']=('drs/drs_9032/drs_9032_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function drs_903201_entry_ctrler()
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
		$data['login_office_status' ] = $this->issmymodel->get_login_office_status(0);
	}
	if($query3 = $this->issmymodel->iss_get_deptt_date())
	{
		$data['records3'] = $query3;
	}
	$data['office_id'] = $office_id;

	$data['content']=('drs/drs_9032/drs_903201_entry_view');
	$data['uid']= $this->session->userdata('some_name1');
	$data['txt_office_name']= $this->session->userdata('some_name2');
	$data['dat_entry_date']= $this->session->userdata('some_name3');
	$data['logout']='home/logout';
	$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	$this->load->view('home',$data);
}

function drs_903201_data_save_ctrler()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$report_of_office_id = $this->session->userdata('some_office');
	$this->load->model('issmymodel');
	$date_param = $this->input->post('drs903201_date');
	$login_status = $this->issmymodel->get_login_office_status($report_of_office_id);
	
	if($login_status == 4)
	{
		$status = $this->issmymodel->drs903201_data_insert_fun($date_param);
		if($status=='success')
		{
			$this->session->set_flashdata('success_iss1','Department data have been saved successfully');
			redirect('drs/drs_9032_view_ctrler','refresh');
		}
		else
		{
			$this->session->set_flashdata('error_iss1','Department data have not been saved successfully');
			redirect('drs/drs_9032_view_ctrler','refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('error_iss1_2','You are not right person to submit this data.');
		redirect('drs/drs_9032_view_ctrler','refresh');
	}
}

function drs_903201_edit_data_ctrler($idParam = '')
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}
	$report_of_office_id = $this->session->userdata('some_office');
	$this->load->model('issmymodel');
	$data['login_office_status' ] = $login_status = $this->issmymodel->get_login_office_status($report_of_office_id);
	if($query3 = $this->issmymodel->iss_get_deptt_date())
	{
		$data['records3'] = $query3;
	}
	if($login_status == 4)
	{
		$data['drs903201_edit_data'] = $this->issmymodel->drs903201_get_edit_data_fun($idParam);
		$data['content']=('drs/drs_9032/drs_903201_entry_edit_view');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->issmymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	else
	{
		$this->session->set_flashdata('error_iss1_2','You are not right person to submit this data.');
		redirect('drs/drs_9032_view_ctrler','refresh');
	}
}

function drs_903201_data_edit_save_ctrler()
{
	if ($this->session->userdata('some_name1')=='')
	{
			redirect(base_url(),'refresh');
	}

	$report_of_office_id = $this->session->userdata('some_office');
	$this->load->model('issmymodel');
	$date_param = $this->input->post('drs903201_date');
	$login_status = $this->issmymodel->get_login_office_status($report_of_office_id);
	
	if($login_status == 4)
	{
		$status = $this->issmymodel->drs903201_data_edit_fun($date_param);
		if($status=='success')
		{
			$this->session->set_flashdata('success_iss1','Department data have been saved successfully');
			redirect('drs/drs_9032_view_ctrler','refresh');
		}
		else
		{
			$this->session->set_flashdata('error_iss1','Department data have not been saved successfully');
			redirect('drs/drs_9032_view_ctrler','refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('error_iss1_2','You are not right person to submit this data.');
		redirect('drs/drs_9032_view_ctrler','refresh');
	}
}
/** 9032 end */
/**
 * DRS end
*/

/*----------------Basic function start-------------------------*/
function fetch_br_ao_do_drs()
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
/*----------------Basic function end-------------------------*/

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