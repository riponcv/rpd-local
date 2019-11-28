<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rpd extends CI_Controller {

	var $muid='';
	var $muname='';
	var $mentdt='';
	//var auth_arr=array();
	
	 function __construct()
     {
	 
	         // Call the Controller constructor
         parent::__construct();
		 $this->load->helper('url');
		$this->load->helper(array('url','mediatutorialpdf'));
		$this->load->database();
		$data['home'] = strtolower(__CLASS__).'/';
	      $this->load->vars($data);

		 
		 if(!is_user())
		 {
		  	redirect(base_url(),'refresh');
		 }
     }
	
	public function index()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
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
		// To display of Left menu	
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	
	//HOME
	
	function home()
	{
		$data['content']='home/logout';
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$this->load->model('mymodel');
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




		$data['mainmenuArray']=  $this->mymodel->get_Data_Sql_Str('Select cMnu_ID, cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=0 AND cIsPermitted=1' );
		$this->load->view('home',$data);
	}
    	
	function omis_view_form()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
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
         //load instruction
        //$data['instruction'] = $this->mymodel->get_instruction(2,'2015-10-01');
                
		//start get EditMode data
		
		$office_id=$this->session->userdata('some_office');
		$login_status=$this->mymodel->get_login_office_status($office_id);
		
		if($login_status==4)
		{
		$data['rec']=array();			
		if($query4 = $this->mymodel->get_edit_mode_data($office_id))
			{
				$data['rec'] = $query4;
			}
		}
		
		//End get EditMode data
        
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $data_br=array();
			$data_ar=array();
			$data_div=array();
			$i=0;
			$OFF_ID=$this->session->userdata('some_office');
			$this->load->model('mymodel');
			$q1=$this->mymodel->get_Data_vw_jb_br_div();
		   
		     foreach ($q1 as $row)
		     {
		   		$data_br[$i]= $row->jbbrcode;
				$data_ar[$i]= $row->ZoneCode;
				$data_div[$i]= $row->jbdivisioncode;
				$i++;
		     }
		   $flag="Z";
		  for($a=0;$a<$i;$a++)
		  {
		    if($data_br[$a]==$OFF_ID)
			{
			 $flag="B";
			 break;
			 }
			else if($data_ar[$a]==$OFF_ID)
			{
			$flag="A";
			break;
			}
			else if($data_div[$a]==$OFF_ID)
			{
			  $flag="A";
			  break;
			}
					
		  }
		 
		  
		 if($flag=="B")
		 {
		  $data['content']=('om/omis_view');
		  $data['uid']= $this->session->userdata('some_name1');
		  $data['txt_office_name']= $this->session->userdata('some_name2');
		  $data['dat_entry_date']= $this->session->userdata('some_name3');
		  $data['logout']='home/logout';
		  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
			}
		else if($flag=="A")
		{
		$data['content']=('om/omis_view_inac');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
			 
			}
			
		else if($flag=="Z")
		{
		 $data['content']=('om/omis_view_inac');
		 $data['uid']= $this->session->userdata('some_name1');
		 $data['txt_office_name']= $this->session->userdata('some_name2');
		 $data['dat_entry_date']= $this->session->userdata('some_name3');
		 $data['logout']='home/logout';
		 $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
		}
///////////////////////////////////OMIS WORK///////////////////////////////////////////////////////////////////////		
		
		
		
	}
	
///////////////////////////////GRAPH WORK HERE/////////////////////////////////////////////	
	function _data()
	{
	 $this->load->model('mymodel');
	 if($query = $this->mymodel->om_graph_date())
		{
			//$dat[] = $query;
		}
		if($query1 = $this->mymodel->om_graph_prod_id_dep())
		{
			//$data['records2'] = $query1;
		}
		
		if($query2 = $this->mymodel->om_graph_prod_id_adv())
		{
			//$data['records2'] = $query1;
		}
		
		
		if($query_graph = $this->mymodel->om_graph_data_dep())
		{
			//$data['records3'] = $query_graph;
		}
			$dat=array();
			$amt_dep=array();
			$amt_sum=0;
			foreach($query as $datte)
			{
			  foreach($query1 as $prid)
			  {
			  foreach($query_graph as $grap)
			    {
				 if(($datte->om_dat_date==$grap->dd_end_dt)&&($prid->pt_id==$grap->dd_pt_id))
				 {
					$amt_sum=$amt_sum+$grap->dd_amt;
				 }
				}
			  }
			  $amt_dep[]=$amt_sum;
			  $amt_sum=0;
			}
			
		
		if($query_adv = $this->mymodel->om_graph_data_adv())
		{
			
		}
		    $amt_adv=array();
			$adv_sum=0;
			foreach($query as $datte)
			{
			  foreach($query2 as $prid2)
			  {
			  foreach($query_adv as $adv)
			    {
				 if(($datte->om_dat_date==$adv->dd_end_dt)&&($prid2->pt_id==$adv->dd_pt_id))
				 {
					$adv_sum=$adv_sum+$adv->dd_amt;
				 }
				}
			  }
			  $amt_adv[]=$adv_sum;
			  $adv_sum=0;
			}
			foreach($query as $datte)
			{
			  $dat[]=substr($datte->om_dat_date,0,11);
			}
		$data['popul']['data'] =$amt_dep;
		$data['popul']['name'] = 'Deposit';
		
        $data['users']['data'] =$amt_adv;
		$data['users']['name'] = 'Advance';
		$data['axis']['categories'] =$dat;
		return $data;
	}
	
	function _ar_data()
	{
		$data = $this->_data();
		foreach ($data['popul']['data'] as $key => $val)
		{
			$output[] = (object)array(
				'Deposit' 		=> $val,
				'Advance'	=> $data['users']['data'][$key],
				'contries'		=> $data['axis']['categories'][$key]
			);
		}
		return $output;
	}
	function omis_graph_test($test=2)
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
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
            $data_br=array();
			$data_ar=array();
			$data_div=array();
			$i=0;
			$OFF_ID=$this->session->userdata('some_office');
			$this->load->model('mymodel');
			$q1=$this->mymodel->get_Data_vw_jb_br_div();
		    foreach ($q1 as $row)
		     {
		   		$data_br[$i]= $row->jbbrcode;
				$data_ar[$i]= $row->ZoneCode;
				$data_div[$i]= $row->jbdivisioncode;
				$i++;
		     }
		   $flag="Z";
		  for($a=0;$a<$i;$a++)
		  {
		    if($data_br[$a]==$OFF_ID)
			{
			 $flag="B";
			 break;
			 }
			else if($data_ar[$a]==$OFF_ID)
			{
			$flag="A";
			break;
			}
			else if($data_div[$a]==$OFF_ID)
			{
			  $flag="A";
			  break;
			}
		
		  }
		 if($flag=="B")
		 {
		  $data['content']=('omis_graph/omis_graph_form');
		  $data['uid']= $this->session->userdata('some_name1');
		  $data['txt_office_name']= $this->session->userdata('some_name2');
		  $data['dat_entry_date']= $this->session->userdata('some_name3');
		  $data['logout']='home/logout';
		  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
			}
		else if($flag=="A")
		{
		$data['content']=('omis_graph/omis_graph_form');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
			 
			}
		else if($flag=="Z")
		{
			if(($test==1))
			{
			    $result = $this->_ar_data();
				$dat1['x_labels'] 	= 'contries'; 
				$dat1['series'] 	= array('Deposit', 'Advance'); 
				$dat1['data']		= $result;
				$this->load->library('highcharts');
				$this->highcharts->set_title('Deposit and Advance Figure');
				$this->highcharts->set_axis_titles('', 'Amount in Billions');
				$this->highcharts->from_result($dat1)->add(); // first graph: add() register the graph
				$data['charts'] = $this->highcharts->render();
				
				 $data['content']=('omis_graph/omis_graph_form');
				 
				 $data['uid']= $this->session->userdata('some_name1');
				 $data['txt_office_name']= $this->session->userdata('some_name2');
				 $data['dat_entry_date']= $this->session->userdata('some_name3');
				 $data['logout']='home/logout';
				 $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				 $data['param']=$test;
				$this->load->view('home',$data);
			}
			else if($test==2)
			{
				$graph_data = $this->_data();
				$this->load->library('highcharts');
				$this->highcharts
				->initialize('chart_template') 	
				->push_xAxis($graph_data['axis']) 
				->set_serie($graph_data['popul']) 
				->set_serie($graph_data['users'],'Advance');
				$this->highcharts->set_title('Deposit and Advance Figure');
				$this->highcharts->set_axis_titles('.', 'Amount in Billions');
				$data['charts'] = $this->highcharts->render();
				$data['content']=('omis_graph/omis_graph_form');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$data['param']=$test;
				$this->load->view('home',$data);
			}
		}
	}
//////////////////////////////////////GRAPH//////////////////////////
	
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
			case 'Submit':
   	    	$this->omis_data_insert();
			echo $action;
 			break;
 			case 'Edit':
			$this->update_res();
			break;
    	} 	
		
	}
	
	//total check start
    /*
    function check_total_loan_advance_amt($loan_adv_total,$loan_cl_total)
    {
        if ($loan_adv_total != $loan_cl_total)
        {
            $this->form_validation->set_message('check_total_loan_advance_amt', ' Total Loan and Advance Outstanding Amount='.$loan_adv_total.' & Total Loan Classification Amount='.$loan_cl_total.' (These two amount\'s total should be equal).');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function check_total_loan_advance_ac($loan_adv_total,$loan_cl_total)
    {
        if ($loan_adv_total != $loan_cl_total)
        {
            $this->form_validation->set_message('check_total_loan_advance_ac', ' Total Loan and Advance Outstanding Account='.$loan_adv_total.' & Total Loan Classification Account='.$loan_cl_total.' (These two account\'s total should be equal).');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }*/
    
    //total check end
	
	
	
	function omis_data_insert()
	{  
	   $this->load->helper(array('form', 'url'));
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('amount[]', 'All amount', 'required|numeric');
	   $this->form_validation->set_rules('ac[]', 'All No. of Account', 'required|numeric');
	   
	   //total check start
       //$loan_cl_total_amt=$_POST['totalamt'][6];
       //$this->form_validation->set_rules('totalamt[2]', 'totalamt[2]', 'callback_check_total_loan_advance_amt['.$loan_cl_total_amt.']');
       //$loan_cl_total_ac=$_POST['totalac'][6];
       //$this->form_validation->set_rules('totalac[2]', 'totalac[2]', 'callback_check_total_loan_advance_ac['.$loan_cl_total_ac.']');
	   //total check end
	   
	   if ($this->form_validation->run() == FALSE )
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
			if($query = $this->mymodel->get_records())
			{
				$data['records1'] = $query;
			}

		//start get EditMode data
		
		$office_id=$this->session->userdata('some_office');
		$login_status=$this->mymodel->get_login_office_status($office_id);
		
		if($login_status==4)
		{
		$data['rec']=array();			
        if($query4 = $this->mymodel->get_edit_mode_data($office_id))
			{
				$data['rec'] = $query4;
			}
		}
		
		//End get EditMode data	
			
			$this->load->model('mymodel');		
			$data['content']=('om/omis_view');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$amount=$this->input->post('amount');
			$ac=$this->input->post('ac');
							
				$data['amt']= $amount;
				$data['ac']= $ac;	
				
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());	
			$this->load->view('home',$data);
			}
			else
			{
			
			$this->load->model('mymodel');
			$OFF_ID= $this->session->userdata('some_office');
			$login_status=$this->mymodel->get_login_office_status($OFF_ID);
			$DATE=$this->input->post('datdate');
		
				if($login_status==4)
				{
					$amount=$this->input->post('amount');
					$ac=$this->input->post('ac');
									
					$PT_CODE=$this->input->post('pt_id');
					$UID= $this->session->userdata('some_uid');
					$date = $this->session->userdata('some_name3');
					$d = date_parse_from_format("d-M-Y", $date);
					$mon= $d["month"];
					$year= $d["year"];
					$day=$d["day"];
					
												
					
					$this->mymodel->generate_new_tbl($DATE);
					if($this->mymodel->delete_omis_data($OFF_ID,$DATE))
					{
						$this->load->model('mymodel');
						$this->mymodel->delete_omis($OFF_ID,$DATE);
						$c=0;
						foreach($amount as $amountVal)
						{
							$data = array(
							'dd_day'=> $day,
							'dd_onth'=> $mon,
							'dd_yr'=> $year,
							'dd_jo_code'=>$OFF_ID,
							'dd_pt_id'=>$PT_CODE[$c],
							'dd_amt' => (float)$amountVal,
							'dd_ac' => $ac[$c],
							'dd_uid'=> $UID,
							'dd_end_dt'=>$DATE
							);
							
						$this->load->model('mymodel');
						$this->mymodel->add_omis_data($data,$DATE);
						$c++;
						}
									
						$this->load->helper(array('form', 'url'));
						$this->load->library('form_validation');
						//$data['content']='om/omis_success';
						//$data['uid']= $this->session->userdata('some_name1');
						//$data['txt_office_name']= $this->session->userdata('some_name2');
						//$data['dat_entry_date']= $this->session->userdata('some_name3');
						//$this->load->view('dataentryform',$data);
					$this->load->model('mymodel');
					$data['entry_dat']=$DATE;
					$data['offid']=$OFF_ID;
					$data['content']='om/omis_success';
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
					
					}
					else
					{
						$c=0;
						foreach($amount as $amountVal)
						{
							$data = array(
							'dd_day'=> $day,
							'dd_onth'=> $mon,
							'dd_yr'=> $year,
							'dd_jo_code'=>$OFF_ID,
							'dd_pt_id'=>$PT_CODE[$c],
							'dd_amt' => (float)$amountVal,
							'dd_ac' => $ac[$c],
							'dd_uid'=> $UID,
							'dd_end_dt'=>$DATE
							);
							
						$this->load->model('mymodel');
						$this->mymodel->add_omis_data($data,$DATE);
						$c++;
						}
						$this->load->helper(array('form', 'url'));
						$this->load->library('form_validation');
					   // $data['content']='om/omis_success';
						//$data['uid']= $this->session->userdata('some_name1');
						//$data['txt_office_name']= $this->session->userdata('some_name2');
						//$data['dat_entry_date']= $this->session->userdata('some_name3');
						//$this->load->view('dataentryform',$data);
						
						
					
					$this->load->model('mymodel');
					$data['entry_dat']=$DATE;	
					$data['offid']=$OFF_ID;
					$data['content']='om/omis_success';
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
					
					}
				}
				else
				{
					$data['entry_dat']=$DATE;
					$data['offid']=$OFF_ID;
					$data['content']='om/omis_failure_view';
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}
			}
		
	}
	
	function omis_report_interface()
	{
			$data_br=array();
			$data_ar=array();
			$data_div=array();
			$i=0;
			$OFF_ID=$this->session->userdata('some_office');
			$this->load->model('mymodel');
			$q1=$this->mymodel->get_Data_vw_jb_br_div();
		   
		     foreach ($q1 as $row)
		     {
		   		$data_br[$i]= $row->jbbrcode;
				$data_ar[$i]= $row->ZoneCode;
				$data_div[$i]= $row->jbdivisioncode;
				$i++;
		     }
		   $flag="Z";
		  for($a=0;$a<$i;$a++)
		  {
		    if($data_br[$a]==$OFF_ID)
			{
			 $flag="B";
			 break;
			 }
			else if($data_ar[$a]==$OFF_ID)
			{
			$flag="A";
			break;
			}
			else if($data_div[$a]==$OFF_ID)
			{
			  $flag="D";
			  break;
			}
			
		  }
		  
			 if($flag=="B")
			 {
			$this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_formB');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			}
			else if($flag=="D")
			{
			$this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_formD');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			 
			}
			else if($flag=="A")
			{
			$this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_formA');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			}
			else if($flag=="Z")
			{
			 $this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_form');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			}
	}
	
	function omis_report_show_form_cons($download_pdf='')
	{
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 
	 $today_date= $this->session->userdata('some_name3');
		 $data['var_today'] = $today_date;
		 $pdf_filename='whole bank'.$DATE.'.pdf';
	  
	    $this->load->model('mymodel');
		
		if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
		if($query_br = $this->mymodel->get_total_br_name())
		{
			$data['br_name'] = $query_br;
		}
		
	   	if($query = $this->mymodel->get_records())
		{
			$data['records1'] = $query;
		}
		
		if($query1 = $this->mymodel->get_records2())
		{
			$data['records2'] = $query1;
		}
       // function get_om__report_data_dist_cons($DATE)
        if($query4 = $this->mymodel->get_om__report_data_dist_cons($DATE))
		{
		  $data['allbr'] = $query4;
		}		
		  
		if($query3 = $this->mymodel->get_om__report_data_detail_cons($DATE))
		
		{
			$data['records3'] = $query3;
			
			
			
				$user_info = $this->load->view('om/omis_report_show_cons_pdf', $data, true);
				if($download_pdf == TRUE)
				{
				   generate_pdf($user_info, $pdf_filename,true);
				}
			   else
			   {
				$data['content']=('om/omis_report_show_cons');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			   }	
			
		}
		else
		{
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
 
		}
		
	   
	}
	function omis_report_show_form_cons_summ($download_pdf='')
	{
	//$pdf_filename = 'user_info'.'.pdf';
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 
	 $today_date= $this->session->userdata('some_name3');
		 $data['var_today'] = $today_date;
		 $pdf_filename='whole bank'.$DATE.'.pdf';
	  
	    $this->load->model('mymodel');
		if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
		if($query_br = $this->mymodel->get_total_br_name())
		{
			$data['br_name'] = $query_br;
		}
		
	   	if($query = $this->mymodel->get_records())
		{
			$data['records1'] = $query;
		}
		
		if($query1 = $this->mymodel->get_records2())
		{
			$data['records2'] = $query1;
		}
        
        if($query4 = $this->mymodel->get_om__report_data_dist_cons($DATE))
		{
		  $data['allbr'] = $query4;
		}	

		if($query3 = $this->mymodel->get_om__report_data_detail_cons($DATE))
		
		{
			$data['records3'] = $query3;
			
			
			
				$user_info = $this->load->view('om/omis_report_show_cons_pdf_summ', $data, true);
				if($download_pdf == TRUE)
				{
				   generate_pdf($user_info, $pdf_filename,true);
				}
			   else
			   {
				$data['content']=('om/omis_report_show_cons_summ');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			   }	
			
		}
		else
		{
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
 
		}
		
	   
	}
	function omis_report_show_form($download_pdf='')
	{
		// $pdf_filename = 'user_info'.'.pdf';
		 $DATE=$this->input->post('datdate');
		 $data['date1'] = $DATE;
		 $OFF_ID= $this->session->userdata('some_office');
		 $data['var_off'] = $OFF_ID;
		 $pdf_filename=$OFF_ID.$DATE.'.pdf';
		 $today_date= $this->session->userdata('some_name3');
		 $data['var_today'] = $today_date;
		 $this->load->model('mymodel');
		 if($query = $this->mymodel->get_records())
		{
			$data['records1'] = $query;
		}
		if($query1 = $this->mymodel->get_records2())
		{
			$data['records2'] = $query1;
		}
		if($query3 = $this->mymodel->get_om__report_data_detail($DATE,$OFF_ID))
		{
			$data['rec'] = $query3;//->result();
			
			
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$user_info = $this->load->view('om/omis_report_show_pdf', $data, true);
				if($download_pdf == TRUE)
				{
				 generate_pdf($user_info, $pdf_filename,true);
				}
				else
				{
					$data['content']=('om/omis_report_show');
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}	
		}
		
		else
		{
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
 
		}
		
		
	}
	
	function omis_report_form_con()
	{
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons');
		
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	
	
	function omis_report_interface_summary()
	{
	        $data_br=array();
			$data_ar=array();
			$data_div=array();
			$i=0;
			$OFF_ID=$this->session->userdata('some_office');
			$this->load->model('mymodel');
			$q1=$this->mymodel->get_Data_vw_jb_br_div();
		   
		     foreach ($q1 as $row)
		     {
		   		$data_br[$i]= $row->jbbrcode;
				$data_ar[$i]= $row->ZoneCode;
				$data_div[$i]= $row->jbdivisioncode;
				$i++;
		     }
		   $flag="Z";
		  for($a=0;$a<$i;$a++)
		  {
		    if($data_br[$a]==$OFF_ID)
			{
			 $flag="B";
			 break;
			 }
			else if($data_ar[$a]==$OFF_ID)
			{
			$flag="A";
			break;
			}
			else if($data_div[$a]==$OFF_ID)
			{
			  $flag="D";
			  break;
			}
			//selse
			{
			 //$flag="Z";
			 //break;
			}
		  }
		 
		  
			 if($flag=="B")
			 {
			 $this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_form_summB');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			}
			else if($flag=="D")
			{
			$this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_form_summD');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			 
			}
			else if($flag=="A")
			{
			$this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_form_summA');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			}
			else if($flag=="Z")
			{
			 $this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_form_summ');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			}
			
	
	/*
			$this->load->model('mymodel');
			$data['content']=('omis/omis_report_interface_form_summ');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
			*/
	}
	
	
	function omis_total_report_form()
	{
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		$data['content']=('om/omis_total_report');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	function omis_total_report_show_form($download_pdf='')
	{
	      
		 //$pdf_filename = 'user_info'.'.pdf';
		 $today_date= $this->session->userdata('some_name3');
		 $data['var_today'] = $today_date;
		 $DATE=$this->input->post('datdate');
		 $data['date1'] = $DATE;
		 $OFF_ID= $this->session->userdata('some_office');
		 $data['data_br'] = $OFF_ID;
		 $pdf_filename=$OFF_ID.$DATE.'.pdf';
		 
		 $this->load->model('mymodel');
		 if($query = $this->mymodel->get_records())
		{
			$data['records1'] = $query;
		}
		if($query1 = $this->mymodel->get_records2())
		{
			$data['records2'] = $query1;
		}
		if($query3 = $this->mymodel->get_om__report_data_detail($DATE,$OFF_ID))
		{
			$data['rec'] = $query3;//->result();
			
			
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$user_info = $this->load->view('om/omis_total_report_show_pdf', $data, true);
				if($download_pdf == TRUE)
				{
				 generate_pdf($user_info, $pdf_filename,true);
				}
				else
				{
					$data['content']=('om/omis_total_report_show');
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}	
		}
		
		else
		{
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
 
		}
		
		
	}
	
	function omis_br_report_interface_all_summ($download_pdf='')
	{
	 //$pdf_filename = 'user_info'.'.pdf';
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('branch_for_report');
	 $OFF_ID2=$OFF_ID1;
	 //$OFF_ID=(int)$OFF_ID1;
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename=$OFF_ID2.$DATE.'.pdf';
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	        $data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
	 }
	 else
	 {
		   if($query55 = $this->mymodel->get_records_br_name($OFF_ID2))
		   {
			 $data['br_name'] = $query55;
			}
			if($query = $this->mymodel->get_records())
			{
				$data['records1'] = $query;
			}
			if($query1 = $this->mymodel->get_records2())
			{
				$data['records2'] = $query1;
			}
			if($query3 = $this->mymodel->get_om__report_data_detail($DATE,$OFF_ID2))
			{
				$data['rec'] = $query3;//->result();
				$user_info = $this->load->view('ombr/omis_br_report_interface_pdf_summ', $data, true);
				if($download_pdf == TRUE)
				{
				 generate_pdf($user_info, $pdf_filename,true);
				}
				else
				{
				 
					$data['content']=('ombr/omis_br_report_interface_all_summ');
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}	
			}
			
			else
			{
			
				$data['content']=('om/omis_not_found');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
		 
			}
			 }
	
}		
	
	
	function omis_br_report_interface_all($download_pdf='')
	{
	 //$pdf_filename = 'user_info'.'.pdf';
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('branch_for_report');
	 $OFF_ID2=$OFF_ID1;
	 //$OFF_ID=(int)$OFF_ID1;
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename=$OFF_ID2.$DATE.'.pdf';
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	        $data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
	 }
	 else
	 {
	   if($query55 = $this->mymodel->get_records_br_name($OFF_ID2))
	   {
		 $data['br_name'] = $query55;
	    }
		if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
		
		if($query = $this->mymodel->get_records())
	    {
		  $data['records1'] = $query;
	    }
		if($query1 = $this->mymodel->get_records2())
	    {
		  $data['records2'] = $query1;
	     }
			 if($query3 = $this->mymodel->get_om__report_data_detail($DATE,$OFF_ID2))
			{
				$data['rec'] = $query3;//->result();
				$user_info = $this->load->view('ombr/omis_br_report_interface_pdf', $data, true);
				if($download_pdf == TRUE)
				{
				 generate_pdf($user_info, $pdf_filename,true);
				}
				else
				{
				 
					$data['content']=('ombr/omis_br_report_interface_all');
					$data['uid']= $this->session->userdata('some_name1');
					$data['txt_office_name']= $this->session->userdata('some_name2');
					$data['dat_entry_date']= $this->session->userdata('some_name3');
					$data['logout']='home/logout';
					$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
					$this->load->view('home',$data);
				}	
			}
	
		else
		{
		
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
	 
		}
	 }
	
}

function omis_choice_interface()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	 // echo "Branch";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  //echo "Area";
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	// echo "Divisional";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}
	
	
	function omis_choice_interfaceA()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	 // echo "Branch";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  //echo "Area";
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	// echo "Divisional";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}
	
	
	function omis_choice_interfaceB()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	 // echo "Branch";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  //echo "Area";
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	// echo "Divisional";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}

function omis_choice_interfaceD()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	 // echo "Branch";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  //echo "Area";
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	// echo "Divisional";
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}
	
	
	function omis_choice_interface_summ()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons_summ');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}
	
	function omis_choice_interface_summA()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons_summ');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}
	
	function omis_choice_interface_summB()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons_summ');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}
	
	
	function omis_choice_interface_summD()
	{
	 $my_action = $this->input->post('actionbtn');
     if ($my_action == 'Branch Report') 
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('ombr/omis_br_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
     }
	 else if($my_action == 'Area Report')
	 {
	  
	  $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omzn/omis_zn_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else if($my_action == 'Divisional Report')
	 {
	
	 $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
	  $data['content']=('omdiv/omis_div_report_interface_summ');
	  $data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 }
	 else
	 {
	  //echo "All";
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
		
		$data['content']=('om/omis_report_cons_summ');
		$data['uid']= $this->session->userdata('some_name1');
	  $data['txt_office_name']= $this->session->userdata('some_name2');
	  $data['dat_entry_date']= $this->session->userdata('some_name3');
	  $data['logout']='home/logout';
	  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
	  $this->load->view('home',$data);
	 
	 }
	}
	
	
	
	
	function omis_div_report_interface_all($download_pdf='')
	{
	
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('div_for_report');
	 $OFF_ID2=$OFF_ID1;
	 
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename='division'.$OFF_ID2.$DATE.'.pdf';
	
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	    $data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
	 }
	 else
	 {
	 $this->load->model('mymodel');
	if($query55 = $this->mymodel->get_records_div_name($OFF_ID2))
	{
		$data['br_name'] = $query55;
	}
	  
	  
		 if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
	 if($query = $this->mymodel->get_records())
	{
		$data['records1'] = $query;
	}
	if($query1 = $this->mymodel->get_records2())
	{
		$data['records2'] = $query1;
	}
	
	if($query_br = $this->mymodel->get_br_div($OFF_ID2))
	{
		$data['branch_count'] = $query_br;
	}
	 //function get_om_report_dist_div($DATE, $b_br)
     if($query6 = $this->mymodel->get_om_report_dist_div($DATE, $OFF_ID2))
	 {
	   $data['divdist'] = $query6;
     }
	
	if($query5 = $this->mymodel->get_om_report_admin_div($DATE, $OFF_ID2))
	 {
		$data['records3']=$query5;
		$user_info = $this->load->view('omdiv/omis_diiv_interface_all_pdf', $data, true);
			if($download_pdf == TRUE)
			{
			 generate_pdf($user_info, $pdf_filename,true);
			}
			else
			{
				$data['content']=('omdiv/omis_div_interface_all');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}	

	}
	else
	{
		$data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
 
	}
	 }
	
			

	}
	
	function omis_div_report_interface_all_summ($download_pdf='')
	{
	 //$pdf_filename = 'user_info'.'.pdf';
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('div_for_report');
	 $OFF_ID2=$OFF_ID1;
	 //$OFF_ID=(int)$OFF_ID1;
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename='division'.$OFF_ID2.$DATE.'.pdf';
	// echo $OFF_ID2;
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	     $data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	 }
	 else
	 {
	     $this->load->model('mymodel');
	    if($query55 = $this->mymodel->get_records_div_name($OFF_ID2))
	{
		$data['br_name'] = $query55;
	}
	if($query_br = $this->mymodel->get_br_div($OFF_ID2))
	{
		$data['branch_count'] = $query_br;
	}
	if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
		
	
	 if($query = $this->mymodel->get_records())
	{
		$data['records1'] = $query;
	}
	if($query1 = $this->mymodel->get_records2())
	{
		$data['records2'] = $query1;
	}
	
	if($query6 = $this->mymodel->get_om_report_dist_div($DATE, $OFF_ID2))
	 {
	   $data['divdist'] = $query6;
     }

	if($query5 = $this->mymodel->get_om_report_admin_div($DATE, $OFF_ID2))
	 {
		$data['records3']=$query5;
		
		
			//$data['link_download']=$link_download;
			//omis_admin_div_report_show_form
			//$data['txt_office_name']= $this->session->userdata('some_name2');
			$user_info = $this->load->view('omdiv/omis_diiv_interface_all_pdf_summ', $data, true);
			if($download_pdf == TRUE)
			{
			 generate_pdf($user_info, $pdf_filename,true);
			}
			else
			{
				$data['content']=('omdiv/omis_div_interface_all_summ');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}	

	}
	else
	{
		$data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
 
	}
	 }
	 
	}
	
	/*function omis_zn_report_interface_all($download_pdf='')
	{
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('zone_for_report');
	 $OFF_ID2=$OFF_ID1;
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename='Area'.$OFF_ID2.$DATE.'.pdf';
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	    $data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	 }
	 else
	 {
	 if($query55 = $this->mymodel->get_records_zn_name($OFF_ID2))
	{
		$data['br_name'] = $query55;
	}
	if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
		
	 if($query = $this->mymodel->get_records())
	{
		$data['records1'] = $query;
	}
	if($query1 = $this->mymodel->get_records2())
	{
		$data['records2'] = $query1;
	}
    if($query6 = $this->mymodel->get_om_report_dist_zone($DATE, $OFF_ID2))
        {
	      $data['distarea']=$query6;
        }
        
	
	if($query5 = $this->mymodel->get_om_report_admin_zone($DATE, $OFF_ID2))
	 {
		$data['records3']=$query5;
		$user_info = $this->load->view('omzn/omis_zn_interface_all_pdf', $data, true);
        
		if($download_pdf == TRUE)
		{
		 generate_pdf($user_info, $pdf_filename,true);
		}
		else
		{
			$data['content']=('omzn/omis_zn_interface_all');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
		}	

	}
	else
	{
		$data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
 
	}
	 }
	 
			

	}*/


		function omis_zn_report_interface_all($download_pdf='')
	{
     
     $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('zone_for_report');
	 $OFF_ID2=$OFF_ID1;
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename='Area'.$OFF_ID2.$DATE.'.pdf';
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	    $data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	 }
	 else
	 {
    	 if($query55 = $this->mymodel->get_records_zn_name($OFF_ID2))
    	{
    		$data['br_name'] = $query55;
    	}
    	if($query_prod = $this->mymodel->get_product_type())
    		{
    			$data['prod_type'] = $query_prod;
    		}
    		
    	 if($query = $this->mymodel->get_records())
    	{
    		$data['records1'] = $query;
    	}
    	if($query1 = $this->mymodel->get_records2())
    	{
    		$data['records2'] = $query1;
    	}
        if($query6 = $this->mymodel->get_om_report_dist_zone($DATE, $OFF_ID2))
            {
    	      $data['distarea']=$query6;
            }
            
       //jack            
       if(isset($_POST['actionbtn']) && ($_POST['actionbtn']=='Missing List' || $_POST['actionbtn']=='Completed List'))
       {
            //first save data for pdf
            if(!empty($_POST))
            {
                foreach($_POST as $key=>$val)
                {
                    $data['previous_value'][$key]=$val;
                }
            }
            $data['report_click_btn']=$_POST['actionbtn']; 
            $data['report_of_date']=$DATE;
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($OFF_ID2,3);
           
           
           $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($OFF_ID2,3); 
           
            $result_array_temp=$this->mymodel->fetch_omis_missing_completed($branch_id_array_for_report,$DATE);
              if(isset($result_array_temp) && count($result_array_temp)>0)
              {
                $data['result_array']=array();
                foreach($result_array_temp as $row)
                {
                    if($_POST['actionbtn']=='Missing List' && $row['status']==0)
                    {
                      $data['result_array'][]=$row;  
                    }
                    if($_POST['actionbtn']=='Completed List' && $row['status']==1)
                    {
                      $data['result_array'][]=$row;  
                    }
                }
              } 
            //now load view
            
           if($download_pdf==1)
            {
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['actionbtn']=='Missing List'){$pdf_filename='omis_missing_list_'.$OFF_ID2.'_'.$DATE.'.pdf';}
                 if($_POST['actionbtn']=='Completed List'){$pdf_filename='omis_completed_list_'.$OFF_ID2.'_'.$DATE.'.pdf';}
                 $pdf_content = $this->load->view('omis/omis_missing_completed_display_pdf', $data, true); 
                generate_pdf($pdf_content, $pdf_filename,true);
            }
            else
            {
                $data['content']=('omis/omis_missing_completed_display'); 
                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data); 
            }
       }
       else
       {
          	if($query5 = $this->mymodel->get_om_report_admin_zone($DATE, $OFF_ID2))
        	 {
        		$data['records3']=$query5;
        		$user_info = $this->load->view('omzn/omis_zn_interface_all_pdf', $data, true);
                
        		if($download_pdf == TRUE)
        		{
        		 generate_pdf($user_info, $pdf_filename,true);
        		}
        		else
        		{
        			$data['content']=('omzn/omis_zn_interface_all');
        			$data['uid']= $this->session->userdata('some_name1');
        			$data['txt_office_name']= $this->session->userdata('some_name2');
        			$data['dat_entry_date']= $this->session->userdata('some_name3');
        			$data['logout']='home/logout';
        			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        			$this->load->view('home',$data);
        		}	
        
        	}
        	else
        	{
        		$data['content']=('om/omis_not_found');
        		$data['uid']= $this->session->userdata('some_name1');
        		$data['txt_office_name']= $this->session->userdata('some_name2');
        		$data['dat_entry_date']= $this->session->userdata('some_name3');
        		$data['logout']='home/logout';
        		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        		$this->load->view('home',$data);
         
        	} 
        }
        
        // //jack   
 
	 }
	 
	}
	
	function omis_zn_report_interface_all_summ($download_pdf='')
	{
	 //$pdf_filename = 'user_info'.'.pdf';
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('zone_for_report');
	 $OFF_ID2=$OFF_ID1;
	 //$OFF_ID=(int)$OFF_ID1;
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename='Area'.$OFF_ID2.$DATE.'.pdf';
	// echo $OFF_ID2;
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	    $data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	 }
	 else
	 {
	      if($query55 = $this->mymodel->get_records_zn_name($OFF_ID2))
	{
		$data['br_name'] = $query55;
	}
	
	if($query55 = $this->mymodel->get_records_zn_name($OFF_ID2))
	{
		$data['br_name'] = $query55;
	}
	if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
		
	 if($query = $this->mymodel->get_records())
	{
		$data['records1'] = $query;
	}
	if($query1 = $this->mymodel->get_records2())
	{
		$data['records2'] = $query1;
	}
	if($query6 = $this->mymodel->get_om_report_dist_zone($DATE, $OFF_ID2))
        {
	      $data['distarea']=$query6;
        }
    
	if($query5 = $this->mymodel->get_om_report_admin_zone($DATE, $OFF_ID2))
	 {
		$data['records3']=$query5;
		$user_info = $this->load->view('omzn/omis_zn_interface_all_pdf_summ', $data, true);
		if($download_pdf == TRUE)
		{
		 generate_pdf($user_info, $pdf_filename,true);
		}
		else
		{
			$data['content']=('omzn/omis_zn_interface_all_summ');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
		}	

	}
	else
	{
		$data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
 
	}
	 }
	 
			

	}
	
	function omis_report_form()
	{
       $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
                
		$data['content']=('om/omis_report');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	
	function admin_insert()
	{
	       $data['content']=('abc/a');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$this->load->view('home',$data);
	}
	function admin_insert_data()
	{
	   $this->load->model('mymodel');
	   $this->mymodel->add_admin_data();
	   
	}
	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////
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
	
	/* MAIN DATA INSERT PROGRAM0*/
	
	function insert()
	{  
	/****************** validation Check ***************************************/
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$a=$_POST['upmonth'];
        $this->form_validation->set_rules('upmonth', 'upmonth', 'required|exact_length[2]|numeric|greater_than[0]|less_than[13]');
		$this->form_validation->set_rules('desig[]', 'No. of Employee', 'required|numeric');
		$this->form_validation->set_rules('ac[]', 'All No of Account', 'required|numeric');
		$this->form_validation->set_rules('amt[]', 'All Amoount', 'required|numeric');
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
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$data['logout']='home/logout';
			$data['content']='dms/deposit_view';
			$this->load->view('dataentryform',$data);
		}
		else
		{		
			$date = $this->session->userdata('some_name3');
			$d = date_parse_from_format("d-M-Y", $date);
			$Month=$this->input->post('upmonth');
			$Year= $this->input->post('year');
			$Office_Id=$this->session->userdata('some_office');
			$Prod_tye=$this->input->post('prod_type');
			$amount=$this->input->post('amt');
			$ac=$this->input->post('ac');
			$UID= $this->session->userdata('some_uid');
			$END_DT=date("d-M-Y"); // $this->session->userdata('some_name3');	
			/// Do here Deleting Job
			$this->load->model('mymodel');
			$this->mymodel->dms_data_del($Month,$Year,$Office_Id);
			$this->mymodel->emp_lenght_data_del($Month,$Year,$Office_Id);
			
			$c=0;
			foreach($amount as $amountVal)
			{
			$data = array(
				'dp_onth'=>$Month,
				'dp_yr'=>$Year,
				'dp_jo_code'=> $Office_Id,	
				'dp_pt_id'=> $Prod_tye[$c],
				'dp_Ac' => $ac[$c],		
				'dp_amt' => (float)$amountVal,
				'dp_uid'=> $UID,
				'dp_end_dt'=> $END_DT
				);
			$c++;
			$this->mymodel->add_deposit($data);
			}
			/******** dms_ems_length** data Entry**///////////////
				$noemp=$this->input->post('desig');
				$dsg_Id=$this->input->post('desig_id');
				/// Do here Deleting Job
				$c=0;
				foreach($noemp as $noEmp){
				$data = array(
					'el_off_id'=> $Office_Id,
					'el_dsg_id'=> $dsg_Id[$c],
					'el_no_emp'=> $noEmp,
					'el_yr'=> $Year,
					'el_mon'=> $Month
					);
				$this->mymodel->add_dms_emp_length($data);
				$c++;
			}
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$data['monn']=$Month;
			$data['yrr']=$Year;
			$data['offid']=$Office_Id;
			
			$data['content']='dms/deposit_success';
			$data['uid']= $this->session->userdata('some_name1');
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$data['logout']='home/logout';
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$this->load->view('dataentryform',$data);
		}

	}
	////////////////////////////////////////////
	/////CDMIIS REPORT
	//////////////////////////////////////////////
	function dms_br_report_form()
	{
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->dms__report_date())
		{
			$data['records3'] = $query3;
		}
		$data['content']=('dmsbr/dms_br_report_interface');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	
	
	function dms_br_report_all($download_pdf='')
	{
	     
	 $OFF_ID= $this->session->userdata('some_office');
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $year=$this->input->post('date_year');
	 $data['date1yr'] = $year;
	 $mon=$this->input->post('date_mon');
	 $data['date1mon'] = $mon;
	 $data['data_br'] = $OFF_ID;
	 $pdf_filename=$OFF_ID.$year.'.pdf';
	 
	 $data['txt_office_name']= $this->session->userdata('some_name2');
	 
	 $this->load->model('mymodel');
	 if($query_prod = $this->mymodel->product_type())
	 {
	 	$data['dms_prod'] = $query_prod;
	 }
	 if($query_emp = $this->mymodel->get_target())
	 {
		$data['records_emp'] = $query_emp;
	 }
	 
	 if($query_tar = $this->mymodel->get_target())
	 {
		$data['records_target'] = $query_tar;
	 }
	 
	 if($query_emp_list = $this->mymodel->get_emp_list($year,$mon,$OFF_ID))
	 {
		$data['records_emp_list'] = $query_emp_list;
	 }
	 if($query3 = $this->mymodel->dms__report_data_detail($year,$mon,$OFF_ID))
	 {
	   	$data['dms_data'] = $query3;
		$user_info = $this->load->view('dmsbr/dms_br_report_pdf', $data, true);
		if($download_pdf == TRUE)
		{
		
	  	  generate_pdf($user_info, $pdf_filename,true);
		
		}
		else
			{
			  $data['content']=('dmsbr/dms_br_report');
			  $data['uid']= $this->session->userdata('some_name1');
			  $data['txt_office_name']= $this->session->userdata('some_name2');
			  $data['dat_entry_date']= $this->session->userdata('some_name3');
			  $data['logout']='home/logout';
			  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			  $this->load->view('home',$data);
			}	
		}
		else
		{
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
 
		 }

       }
	
	/*
	function omis_div_report_interface_all($download_pdf='')
	{
	
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $DATE=$this->input->post('datdate');
	 $data['date1'] = $DATE;
	 $OFF_ID1=$this->input->post('div_for_report');
	 $OFF_ID2=$OFF_ID1;
	 
	 $data['data_br'] = $OFF_ID2;
	 $pdf_filename='division'.$OFF_ID2.$DATE.'.pdf';
	
	 $this->load->model('mymodel');
	 if($OFF_ID2=="")
	 {
	    $data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
	 }
	 else
	 {
	 $this->load->model('mymodel');
	if($query55 = $this->mymodel->get_records_div_name($OFF_ID2))
	{
		$data['br_name'] = $query55;
	}
	  
	  
		 if($query_prod = $this->mymodel->get_product_type())
		{
			$data['prod_type'] = $query_prod;
		}
	 if($query = $this->mymodel->get_records())
	{
		$data['records1'] = $query;
	}
	if($query1 = $this->mymodel->get_records2())
	{
		$data['records2'] = $query1;
	}
	
	if($query_br = $this->mymodel->get_br_div($OFF_ID2))
	{
		$data['branch_count'] = $query_br;
	}
	
	
	if($query5 = $this->mymodel->get_om_report_admin_div($DATE, $OFF_ID2))
	 {
		$data['records3']=$query5;
		$user_info = $this->load->view('omdiv/omis_diiv_interface_all_pdf', $data, true);
			if($download_pdf == TRUE)
			{
			 generate_pdf($user_info, $pdf_filename,true);
			}
			else
			{
				$data['content']=('omdiv/omis_div_interface_all');
				$data['uid']= $this->session->userdata('some_name1');
				$data['txt_office_name']= $this->session->userdata('some_name2');
				$data['dat_entry_date']= $this->session->userdata('some_name3');
				$data['logout']='home/logout';
				$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
				$this->load->view('home',$data);
			}	

	}
	else
	{
		$data['content']=('om/omis_not_found');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
 
	}
	 }
	}
	*/
    
	function dms_div_report_form()
	{
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->dms__report_date())
		{
			$data['records3'] = $query3;
		}
		$data['content']=('dmsdiv/dms_div_report_interface');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	
	function dms_div_report_all($download_pdf='')
	{
	     
	 //$OFF_ID= $this->session->userdata('some_office');
	 $OFF_ID=$this->input->post('div_for_report');
	 //echo $OFF_ID;
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $year=$this->input->post('date_year');
	 $data['date1yr'] = $year;
	 $mon=$this->input->post('date_mon');
	 $data['date1mon'] = $mon;
	 $data['data_br'] = $OFF_ID;
	 $pdf_filename=$OFF_ID.$year.'.pdf';
	 
	 $data['txt_office_name']= $this->session->userdata('some_name2');
	 
	 $this->load->model('mymodel');
	 if($query_prod = $this->mymodel->product_type())
	 {
	 	$data['dms_prod'] = $query_prod;
	 }
	 
	  if($query5 = $this->mymodel->get_br_zn_div_name())
	 {
		$data['record_name']=$query5;
	 }	
		
		
	if($query33 = $this->mymodel->dms_div_report_data_branch($year,$mon,$OFF_ID))
	{
	  $data['dms_branch'] = $query33;
	}
		
	 if($query_emp_list = $this->mymodel->get_emp_list_div($year,$mon,$OFF_ID))
	 {
		$data['records_emp_list'] = $query_emp_list;
	 }
	 if($query_tar = $this->mymodel->get_target())
	 {
		$data['records_target'] = $query_tar;
	 }
		
	 if($query3 = $this->mymodel->dms_div_report_data_detail($year,$mon,$OFF_ID))
	 {
	   	$data['dms_data'] = $query3;
		$user_info = $this->load->view('dmsdiv/dms_div_report_pdf', $data, true);
		if($download_pdf == TRUE)
		{
		
	  	  generate_pdf($user_info, $pdf_filename,true);
		
		}
		else
			{
			  $data['content']=('dmsdiv/dms_div_report');
			  $data['uid']= $this->session->userdata('some_name1');
			  $data['txt_office_name']= $this->session->userdata('some_name2');
			  $data['dat_entry_date']= $this->session->userdata('some_name3');
			  $data['logout']='home/logout';
			  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			  $this->load->view('home',$data);
			}	
		}
		else
		{
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
 
		 }

       }
	
	
	
	
	function dms_zn_report_form()
	{
	   $this->load->model('mymodel');
	   	if($query3 = $this->mymodel->dms__report_date())
		{
			$data['records3'] = $query3;
		}
		$data['content']=('dmszn/dms_zn_report_interface');
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
	}
	
	function dms_zn_report_all($download_pdf='')
	{
	     
	 //$OFF_ID= $this->session->userdata('some_office');
	 $OFF_ID=$this->input->post('zone_for_report');
	 echo $OFF_ID;
	 $today_date= $this->session->userdata('some_name3');
	 $data['var_today'] = $today_date;
	 $year=$this->input->post('date_year');
	 $data['date1yr'] = $year;
	 $mon=$this->input->post('date_mon');
	 $data['date1mon'] = $mon;
	 $data['data_br'] = $OFF_ID;
	 $pdf_filename=$OFF_ID.$year.'.pdf';
	 
	 $data['txt_office_name']= $this->session->userdata('some_name2');
	 
	 $this->load->model('mymodel');
	 if($query_prod = $this->mymodel->product_type())
	 {
	 	$data['dms_prod'] = $query_prod;
	 }
	 
	  if($query5 = $this->mymodel->get_br_zn_div_name())
	 {
		$data['record_name']=$query5;
	 }	
		
		
	if($query33 = $this->mymodel->dms_div_report_data_branch($year,$mon,$OFF_ID))
	{
	  $data['dms_branch'] = $query33;
	}
		
	 if($query_emp_list = $this->mymodel->get_emp_list_div($year,$mon,$OFF_ID))
	 {
		$data['records_emp_list'] = $query_emp_list;
	 }
	 if($query_tar = $this->mymodel->get_target())
	{
		$data['records_target'] = $query_tar;
	}
		
	 if($query3 = $this->mymodel->dms_div_report_data_detail($year,$mon,$OFF_ID))
	 {
	   	$data['dms_data'] = $query3;
		$user_info = $this->load->view('dmszn/dms_div_report_pdf', $data, true);
		if($download_pdf == TRUE)
		{
		
	  	  generate_pdf($user_info, $pdf_filename,true);
		
		}
		else
			{
			  $data['content']=('dmszn/dms_div_report');
			  $data['uid']= $this->session->userdata('some_name1');
			  $data['txt_office_name']= $this->session->userdata('some_name2');
			  $data['dat_entry_date']= $this->session->userdata('some_name3');
			  $data['logout']='home/logout';
			  $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			  $this->load->view('home',$data);
			}	
		}
		else
		{
			$data['content']=('om/omis_not_found');
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
			$data['logout']='home/logout';
			$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
			$this->load->view('home',$data);
 
		 }

       }


	////////////////////////////////////////////
	
	function datashow($tblname='vw_br')
	{
		if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		$this->load->library('table','form_validation');
		 $this->load->model('mymodel');
		
		$data['rw']= $this->mymodel->get_Data($tblname);
		// $data['rw']= $this->mymodel->get_Data_Sql_Str1('Select * from '.$tblname);
				
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
	
	function mydatashow()
	{
		if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		$this->load->library('table','form_validation');
		 $this->load->model('mymodel');
			
			$date = $this->session->userdata('some_name3');
			$d = date_parse_from_format("d-M-Y", $date);
			$Month= $d["month"];
			$Year= $d["year"];
		
		//$data['rw']= $this->mymodel->get_Data($tblname);
		 $data['rw']= $this->mymodel->get_Data_Sql_Str1("Select * from vw_mydata where ltrim(rtrim(dp_jo_code))='".$this->session->userdata('some_office')."' and dp_onth=".$Month." and dp_yr=".$Year." and ltrim(rtrim(dp_uid))='".$this->session->userdata('some_uid')."'");
				
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
		if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
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
		 $config['base_url'] ='http://203.76.102.169:8033/rpd/index.php/rpd/datashow';
		 //$config['base_url'] ='http://172.17.21.21/rpd/index.php/rpd/datashow';
		 $config['total_rows'] = 200;
		 $config['per_page'] = 20; 
		$this->pagination->initialize($config); 
		echo $this->pagination->create_links();
	}
	
	function empinfo()
	{
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
				
		$data['isde']='dvcontent_dataentry';
		$data['content']='empinfo';
		$data['logout']='home/logout';
		
		$data['posting_at']='';
		$some_office=$this->session->userdata('some_office');
		if(isset($some_office) && $some_office!='')
		{
				$data['posting_at']=$some_office;
		}
		$this->load->model('mymodel');
		$data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);
		
	}
	
	public function edit_empinfo($id=0)
	{
		if($id>0)
		{
			if ($this->session->userdata('some_name1')=='')
			{
				 redirect(base_url(),'refresh');
			}
			
			$data['uid']= $this->session->userdata('some_name1');
			$data['txt_office_name']= $this->session->userdata('some_name2');
			$data['dat_entry_date']= $this->session->userdata('some_name3');
					
			$data['isde']='dvcontent_dataentry';
			$data['content']='edit_empinfo';
			$data['logout']='home/logout';
			
			//set posting_at
			$data['posting_at']='';
			$some_office=$this->session->userdata('some_office');
			if(isset($some_office) && $some_office!='')
			{
					$data['posting_at']=$some_office;
			}
			
			//get designation 
			$this->load->model('mymodel');
			$data['designation_dropdown']=$this->mymodel->get_designation_dropdown();
		
		// To display of Left menu	
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		
			//get data for employee
			$data['employee_data']=$this->mymodel->get_employee_data($id);
			
			$this->load->view('home',$data);
		
		}
		else
		{
			
		}
	}
	
	 //Deposit Monitoring system main function
 	public function dms($id)
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
		$data['module_name']='Core Deposit Monitoring System '; 
        
        //quick link
        $this->session->set_userdata('quick_link','1');
		
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}
	
	//Deposit Monitoring system main function
 	public function omis($id)
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
		$data['module_name']='Overview MIS Data Entry ';
        
        $this->session->set_userdata('quick_link','2');  
		
		$data['content']='home/logout';
		$this->load->view('home',$data);
	}
	
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
	
	/* Form Validation Callback function */
	
	function check_dup_data($m)
	{
		$query =  $this->db->query("SELECT *
										FROM dms_deposit where dp_onth=".$_POST['upmonth']." AND dp_yr=".$m." AND dp_jo_code='".$this->session->userdata('some_office')."'");        
           
		if($query->num_rows >0)
		{
			$this->form_validation->set_message('check_dup_data', 'This Month Data Already Submitted');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
	function mytst()
	{
		//echo '01-sep-2012<br>';
		
		// $test = new DateTime('01-sep-2012');
		 
		 $date = "13-mar-2012";
		$d = date_parse_from_format("d-M-Y", $date);
		echo $d["year"];
		
		die();
		//echo  date("m",$test);
		 $this->load->model('mymodel');
		 if($query = $this->mymodel->mydata_get(8,20,9035))
		{
			//$data['records_target'] = $query;
			echo "sucd3ss";
		}
		
		die();
		
		$date = "13-mar-2012";
		$d = date_parse_from_format("Y-MM-d", $date);
		echo $d["month"];
		 
		 $d=getdate();
		 //print_r($d);
				 
		 echo date("d-M-Y");  
		 
		 //print_r(date_parse('01-sep-2012'));
		
		 
		
		//echo date('y' ,$test);
		//echo  $test;
		
		
		//echo date_format($test, 'Y-m-d');
		
				
	}
	
	function mydata_show()
	{
	/*
			$date = $this->session->userdata('some_name3');
			$d = date_parse_from_format("d-M-Y", $date);
			$Month= $d["month"];
			$Year= $d["year"];
			$br= $this->session->userdata('some_office');
			
		
		 $this->load->model('mymodel');
		 if($query = $this->mymodel->mydata_get($Month,$Year,$br))
		{
			$data['my_data'] = $query;
			echo '<pre>';
			print_r($query);
		}
		*/
		if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
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
		
		$date = $this->session->userdata('some_name3');
		$d = date_parse_from_format("d-M-Y", $date);
		$Month= $d["month"];
		$Year= $d["year"];
		$br= $this->session->userdata('some_office');
     
	    if($query = $this->mymodel->mydata_get($Month,$Year,$br))
		{
			$data['my_data'] = $query;
			//echo '<pre>';
			//print_r($query);
		}
		
		
		$data['content']=('dms/deposit_view');
		$data['title']="Core Deposit Monitoring System Form";
		$data['uid']= $this->session->userdata('some_name1');
		$data['txt_office_name']= $this->session->userdata('some_name2');
		$data['dat_entry_date']= $this->session->userdata('some_name3');
		$data['logout']='home/logout';
		// To display of Left menu	
		$data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
		$this->load->view('home',$data);

			
	}
	
	
	
	function search_branch_by_text()
	{
		$result_arr=array();
		if(isset($_POST['searchText']))
        {
             $this->load->model('mymodel');
			$result_arr=$this->mymodel->search_branch_by_text($_POST['searchText']);   
        }
		
		$html='';
		if(isset($result_arr) && count($result_arr)>0)
		{
			foreach($result_arr as $row=>$val)
            {  
			    $temp=$val['BRANCH_NAME'];
				$html .='<tr><td><input type="radio" name="branch_for_report" value="'.$val['jbbrcode'].'">'.$temp.'</td></tr>'.'<tr><td><input type="hidden" name="branch_name" value="'.$temp.'"></td></tr>';
				 ;
			}
		}
		else
		{
			$html .='<tr><td>No Branch Found</td></tr>';
		}
		echo $html;
        exit();
	}
	
	function search_zone_by_text()
	{
		$result_arr=array();
		if(isset($_POST['searchText']))
        {
             $this->load->model('mymodel');
			$result_arr=$this->mymodel->search_zone_by_text($_POST['searchText']);   
        }
		
		$html='';
		if(isset($result_arr) && count($result_arr)>0)
		{
			foreach($result_arr as $row=>$val)
            {
			$html .='<tr><td><input type="radio" name="zone_for_report" value="'.$val['ZoneCode'].'">'.$val['ZoneName'].'</td></tr>';
			}
		}
		else
		{
			$html .='<tr><td>No Zone Found</td></tr>';
		}
		echo $html;
        exit();
	}
	function search_div_by_text()
	{
		$result_arr=array();
		if(isset($_POST['searchText']))
        {
             $this->load->model('mymodel');
			$result_arr=$this->mymodel->search_div_by_text($_POST['searchText']);   
        }
		
		$html='';
		if(isset($result_arr) && count($result_arr)>0)
		{
			foreach($result_arr as $row=>$val)
            {
			$html .='<tr><td><input type="radio" name="div_for_report" value="'.$val['jbdivisioncode'].'">'.$val['DivisionName'].'</td></tr>';
			}
		}
		else
		{
			$html .='<tr><td>No Division Found</td></tr>';
		}
		echo $html;
        exit();
	}


	function omis_data_edit()
    {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        $this->load->model('mymodel');
        //login office
        $office_id=$this->session->userdata('some_office');
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status($office_id);   
        }
        else
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status(0);
        }
        

  		if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        if(isset($_POST['datdate_edit']) && $_POST['datdate_edit'] !='')
        {
            if($query = $this->mymodel->get_records())
    		{
    			$data['records1'] = $query;
    		}
            
    		if($query1 = $this->mymodel->get_records2())
    		{
    			$data['records2'] = $query1;
    		}
            
           if($query3 = $this->mymodel->get_om__report_data_detail($_POST['datdate_edit'],$office_id))
    		{
    			$data['rec'] = $query3;//->result();                
                $data['selected_date']=$_POST['datdate_edit'];
                $data['content']=('ombr/omis_data_edit_with_data');	
    		}
    		
    		else
    		{
                $this->session->set_flashdata('error','No Data Found For '.$_POST['datdate_edit'].' To Edit');
                $this->session->set_flashdata('selected_date',$_POST['datdate_edit']);
                redirect(base_url().'index.php/rpd/omis_data_editindex.php','refresh');
    		}
        }
        else
        {
          $data['content']=('ombr/omis_data_edit_view');  
        }

        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
    	
    }


    //omis report---zakariya---start
    
    public function omis_report()
	 {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		$this->load->model('mymodel');
        //login office
        $office_id=$this->session->userdata('some_office');
        
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status($office_id);   
        }
        else
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status(0);
        }
        
        
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('omis_report/omis_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function fetch_br_ao_do_omis()
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
            $response .='<td COLSPAN="2"><h6 style="color: olive;">';
            foreach($br_ao_do_array as $key=>$val)
            {
                if($_POST['br_ao_do']==6)
                {
                  $response .='<input type="radio" id="br_ao_do" name="omis_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
                }
                else
                {
                 $response .='<input type="radio" id="br_ao_do" name="omis_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'<br/>';   
                }
            }
            $response .='</td>';
          }  
        }
        
        echo $response;
        
        
        exit();
    }
    
    function omis_report_details($download=0)
    {        
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['omis_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['omis_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare option
            if($_POST['report_click_btn']==1 || $_POST['report_click_btn']==4)//view report
            {
              	 if($query = $this->mymodel->get_records())
            	{
            		$data['records1'] = $query;
            	}
            	if($query1 = $this->mymodel->get_records2())
            	{
            		$data['records2'] = $query1;
            	}
              //$data['records3']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$_POST['report_of_date']);
			  $data['records3']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$_POST['report_of_date'],$_POST['report_click_btn']);
              $data['completed_vs_total']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$_POST['report_of_date']);
                
            }
            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              $result_array_temp=$this->mymodel->fetch_omis_missing_completed($branch_id_array_for_report,$_POST['report_of_date']);
              if(isset($result_array_temp) && count($result_array_temp)>0)
              {
                $data['result_array']=array();
                foreach($result_array_temp as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;  
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;  
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
            $data['report_of_date']=$_POST['report_of_date'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            
            if($download==1)
            {
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='omis_report_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                  $pdf_content = $this->load->view('omis_report/omis_report_display_pdf', $data, true);  
                }
                if($_POST['report_click_btn']==4)//view report
                {
                  $pdf_filename='omis_summary_report_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';
                  $pdf_content = $this->load->view('omis_report/omis_summary_report_display_pdf', $data, true);  
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                   if($_POST['report_click_btn']==2){$pdf_filename='omis_missing_list_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';}
                   if($_POST['report_click_btn']==3){$pdf_filename='omis_completed_list_'.$report_of_office_id.'_'.$_POST['report_of_date'].'.pdf';}
                   $pdf_content = $this->load->view('omis_report/omis_missing_completed_display_pdf', $data, true); 
                }
                generate_pdf($pdf_content, $pdf_filename,true);
            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('omis_report/omis_report_display');   
                }
                if($_POST['report_click_btn']==4)//view report
                {
                  $data['content']=('omis_report/omis_summary_report_display');  
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('omis_report/omis_missing_completed_display'); 
                }

                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data); 
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/rpd/omis_reportindex.php','refresh');
        }
        
    }
    
    //omis report---zakariya---end


//cdms report---zakariya---start
    
    public function cdms_report()
	 {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		$this->load->model('mymodel');
        //login office
        $office_id=$this->session->userdata('some_office');
        
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status($office_id);   
        }
        else
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status(0);
        }
        
        $data['content']=('cdms/cdms_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function fetch_br_ao_do()
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
            $response .='<td COLSPAN="2"><h6 style="color: olive;">';
            foreach($br_ao_do_array as $key=>$val)
            {
                if($_POST['br_ao_do']==6)
                {
                  $response .='<input type="radio" id="br_ao_do" name="cdms_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
                }
                else
                {
                 $response .='<input type="radio" id="br_ao_do" name="cdms_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'<br/>';   
                }
            }
            $response .='</td>';
          }  
        }
        
        echo $response;
        
        
        exit();
    }
    
    function cdms_report_details($download=0)
    {        
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['cdms_report_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['cdms_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare option
            if($_POST['report_click_btn']==1)//view report
            {
          		if($query = $this->mymodel->product_type())
        		{
        			$data['records'] = $query;
        		}
                
        		if($query = $this->mymodel->get_target($_POST['report_of_year']))
        		{
        			$data['records_target'] = $query;
        		}
              $data['result_array']=$this->mymodel->fetch_cdms_data_details($branch_id_array_for_report,$_POST['report_of_year'],$_POST['report_of_month']);
                
            }
            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              $result_array_temp=$this->mymodel->fetch_cdms_missing_completed($branch_id_array_for_report,$_POST['report_of_year'],$_POST['report_of_month']);
              if(isset($result_array_temp) && count($result_array_temp)>0)
              {
                $data['result_array']=array();
                foreach($result_array_temp as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;  
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;  
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            
            if($download==1)
            {
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='cdms_report_'.$report_of_office_id.'_'.$_POST['report_of_year'].'-'.$_POST['report_of_month'].'.pdf';
                  $pdf_content = $this->load->view('cdms/cdms_report_display_pdf', $data, true);  
                  generate_pdf_landscape($pdf_content, $pdf_filename,true);
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                   if($_POST['report_click_btn']==2){$pdf_filename='cdms_missing_list_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';}
                   if($_POST['report_click_btn']==3){$pdf_filename='cdms_completed_list_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';}
                   $pdf_content = $this->load->view('cdms/cdms_missing_completed_display_pdf', $data, true); 
                   generate_pdf($pdf_content, $pdf_filename,true);
                }
            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('cdms/cdms_report_display');   
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('cdms/cdms_missing_completed_display'); 
                }

                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data); 
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/rpd/cdms_reportindex.php','refresh');
        }
        
    }
    
    //cdms report---zakariya---end


    //co_cdms report---zakariya---start
    
    public function co_cdms_report()
	 {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        
        //login office
        $this->load->model('mymodel');
        $office_id=$this->session->userdata('some_office');
        
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status($office_id);   
        }
        else
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status(0);
        }
		
		$this->load->model('mymodel');        
        $data['content']=('co_cdms/co_cdms_report_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function fetch_br_ao_do_co()
    {
        $response='';
        if(isset($_POST['br_ao_do']) && $_POST['br_ao_do'] !='' && isset($_POST['br_ao_do_str']) && $_POST['br_ao_do_str'] !='')
        {
           $this->load->model('mymodel');
           $br_ao_do_array=$this->mymodel->fetch_br_ao_do_co($_POST['br_ao_do'],$_POST['br_ao_do_str']);
          
            if($_POST['br_ao_do']==1 || $_POST['br_ao_do']==3)
            {
                $index_name='office_name';
                $index_val='office_code';
            }
            if($_POST['br_ao_do']==2)
            {
                $index_name='DivisionName';
                $index_val='jbdivisioncode';
            }
          
          if(count($br_ao_do_array)>0)
          {
            $response .='<td COLSPAN="2"><h6 style="color: olive;">';
            foreach($br_ao_do_array as $key=>$val)
            {
                if($_POST['br_ao_do']==6)
                {
                  $response .='<input type="radio" id="br_ao_do" name="co_cdms_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].' Divisional Corp<br/>';  
                }
                else
                {
                 $response .='<input type="radio" id="br_ao_do" name="co_cdms_report_office_id" value="'.$val[$index_val].'">'.$val[$index_name].'<br/>';   
                }
            }
            $response .='</td>';
          }  
        }
        
        echo $response;
        
        
        exit();
    }
    
    function co_cdms_report_details($download=0)
    {        
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            $this->load->model('mymodel');
            
            $report_of_office_id=0;
            if(isset($_POST['co_cdms_report_office_id']) && $_POST['co_cdms_report_office_id']>1)
            {
               $report_of_office_id=$_POST['co_cdms_report_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report_co_cdms($report_of_office_id,$_POST['report_option_selector']);
            
            //Now prepare option
            if($_POST['report_click_btn']==1)//view report
            {
          		if($query = $this->mymodel->product_type())
        		{
        			$data['records'] = $query;
        		}
                
        		if($query = $this->mymodel->get_target($_POST['report_of_year']))
        		{
        			$data['records_target'] = $query;
        		}
                
              $data['result_array']=$this->mymodel->fetch_cdms_data_details($branch_id_array_for_report,$_POST['report_of_year'],$_POST['report_of_month']);
                
            }
            if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
            {
              $result_array_temp=$this->mymodel->fetch_cdms_missing_completed($branch_id_array_for_report,$_POST['report_of_year'],$_POST['report_of_month']);
              if(isset($result_array_temp) && count($result_array_temp)>0)
              {
                $data['result_array']=array();
                foreach($result_array_temp as $row)
                {
                    if($_POST['report_click_btn']==2 && $row['status']==0)
                    {
                      $data['result_array'][]=$row;  
                    }
                    if($_POST['report_click_btn']==3 && $row['status']==1)
                    {
                      $data['result_array'][]=$row;  
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
            $data['report_of_year']=$_POST['report_of_year'];
            $data['report_of_month']=$_POST['report_of_month'];
            $data['report_of_office']=$this->mymodel->fetch_report_of_office_co_cdms($report_of_office_id,$_POST['report_option_selector']);
            
            if($download==1)
            {
                 $pdf_filename='';
                 $pdf_content='';
                 if($_POST['report_click_btn']==1)//view report
                {
                  $pdf_filename='co_cdms_report_'.$report_of_office_id.'_'.$_POST['report_of_year'].'-'.$_POST['report_of_month'].'.pdf';
                  $pdf_content = $this->load->view('co_cdms/co_cdms_report_display_pdf', $data, true);  
                  generate_pdf_landscape($pdf_content, $pdf_filename,true);
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                   if($_POST['report_click_btn']==2){$pdf_filename='co_cdms_missing_list_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';}
                   if($_POST['report_click_btn']==3){$pdf_filename='co_cdms_completed_list_'.$report_of_office_id.'_'.$_POST['report_of_year'].'_'.$_POST['report_of_month'].'.pdf';}
                   $pdf_content = $this->load->view('co_cdms/co_cdms_missing_completed_display_pdf', $data, true); 
                   generate_pdf($pdf_content, $pdf_filename,true);
                }
            }
            else
            {
                if($_POST['report_click_btn']==1)//view report
                {
                 $data['content']=('co_cdms/co_cdms_report_display');   
                }
                if($_POST['report_click_btn']==2 || $_POST['report_click_btn']==3 )//missing list && Completed list
                {
                  $data['content']=('co_cdms/co_cdms_missing_completed_display'); 
                }

                $data['uid']= $this->session->userdata('some_name1');
                $data['txt_office_name']= $this->session->userdata('some_name2');
                $data['dat_entry_date']= $this->session->userdata('some_name3');
                $data['logout']='home/logout';
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data); 
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/rpd/co_cdms_reportindex.php','refresh');
        }
        
    }
    
    //co_cdms report---zakariya---end

//help--user guide & guide line
	
	    public function help()
	 {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		$this->load->model('mymodel');
        $data['content']=('omis_help');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}

	public function help_download_option($filename='')
	 {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		$this->load->helper('download');
		
		$filepath=base_url().'pdf/'.$filename;
		$data = file_get_contents("$filepath"); // Read the file's contents
		$name = $filename;
		
		force_download($name, $data); 
	}
	
	///help end
    
    
    
    //COMPARISION & GRAPH---zakariya---start
	
	public function omis_com_graph()
	 {
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
		
		$this->load->model('mymodel');
        //login office
        $office_id=$this->session->userdata('some_office');
        
        if(isset($office_id) && $office_id>0)
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status($office_id);   
        }
        else
        {
            $data['login_office_status']=$this->mymodel->get_login_office_status(0);
        }
        
        
   	   	if($query3 = $this->mymodel->get_om__report_date())
		{
			$data['records3'] = $query3;
		}
        
        $data['content']=('comparison_graph/omis_com_graph_view');
        $data['uid']= $this->session->userdata('some_name1');
        $data['txt_office_name']= $this->session->userdata('some_name2');
        $data['dat_entry_date']= $this->session->userdata('some_name3');
        $data['logout']='home/logout';
        $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
        $this->load->view('home',$data);
	}
    
    function fetch_br_ao_do_omis_com_graph()
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
    
    function omis_com_graph_details($download=0)
    {        
        if ($this->session->userdata('some_name1')=='')
		{
			 redirect(base_url(),'refresh');
		}
        if(isset($_POST['report_option_selector']) && $_POST['report_option_selector']>0 && isset($_POST['report_click_btn']) && $_POST['report_click_btn']>0)
        {   
            
            ini_set('memory_limit', '1024M');
            $this->load->model('mymodel');
            $report_of_office_id=$this->session->userdata('some_office');
            
            if(isset($_POST['omis_com_graph_office_id']) && $_POST['report_option_selector']>1)//OWN REPORT
            {
               $report_of_office_id=$_POST['omis_com_graph_office_id']; 
            }
            
            $branch_id_array_for_report=$this->mymodel->fetch_branch_array_for_report($report_of_office_id,$_POST['report_option_selector']);
            
            $date1='';
            $date2='';
            $date3='';
            
            $date_1='';
            $date_2='';
            $date_3='';
            
            if(isset($_POST['report_of_date1'])){$date_1=$_POST['report_of_date1'];}
            if(isset($_POST['report_of_date2'])){$date_2=$_POST['report_of_date2'];}
            if(isset($_POST['report_of_date3'])){$date_3=$_POST['report_of_date3'];}
            
            if($date_1 !='' && $date_2 !='' && $date_3 !='')
            {
                $dt1=$date_1;
                $dt2=$date_2;
                $dt3=$date_3;
                
                if(strtotime($dt1)>strtotime($dt2) && strtotime($dt1)>strtotime($dt3))
                {
                    $date3=$dt1;
                    if(strtotime($dt2)>strtotime($dt3))
                    {
                       $date2=$dt2;
                       $date1=$dt3; 
                    }
                    else
                    {
                       $date2=$dt3;
                       $date1=$dt2; 
                    }
                    
                }
                if(strtotime($dt2)>strtotime($dt1) && strtotime($dt2)>strtotime($dt3))
                {
                    $date3=$dt2;
                    if(strtotime($dt1)>strtotime($dt3))
                    {
                       $date2=$dt1;
                       $date1=$dt3; 
                    }
                    else
                    {
                       $date2=$dt3;
                       $date1=$dt1; 
                    }
                    
                }
                if(strtotime($dt3)>strtotime($dt1) && strtotime($dt3)>strtotime($dt2))
                {
                    $date3=$dt3;
                    if(strtotime($dt1)>strtotime($dt2))
                    {
                       $date2=$dt1;
                       $date1=$dt2; 
                    }
                    else
                    {
                       $date2=$dt2;
                       $date1=$dt1; 
                    }
                    
                }
            }
            else
            {
                if($date_1 == ''){$dt1=$date_2;$dt2=$date_3;}
                if($date_2 == ''){$dt1=$date_1;$dt2=$date_3;}
                if($date_3 == ''){$dt1=$date_1;$dt2=$date_2;}
                
                $date1=$dt1;
                $date2=$dt2;
                if(strtotime($date1)>strtotime($date2))
               {
                $temp=$date1;
                $date1=$date2;
                $date2=$temp;
               } 
            }
            
            //Now prepare option
            if($_POST['report_click_btn']==1)//comparison
            {
              	 if($query = $this->mymodel->get_records())
            	{
            		$data['records1'] = $query;
            	}
            	if($query1 = $this->mymodel->get_records2())
            	{
            		$data['records2'] = $query1;
            	}
                
              if($date3 !='')
              {
                $data['records3_date3']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$date3);
                $data['completed_vs_total_date3']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$date3); 
              } 
              
              if($date2 !='')
              {
                $data['records3_date2']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$date2);
                $data['completed_vs_total_date2']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$date2); 
              } 
              
              if($date1 !='')
              {
                $data['records3_date1']=$this->mymodel->fetch_omis_data_details($branch_id_array_for_report,$date1);
                $data['completed_vs_total_date1']=$this->mymodel->fetch_omis_data_details_completed_vs_total($branch_id_array_for_report,$date1); 
              } 
            }
            
            if($_POST['report_click_btn']==2)//graph
            {
                 $query1 = $this->mymodel->om_graph_prod_id_dep();
                 $query2 = $this->mymodel->om_graph_prod_id_adv();
              
                  //fetch date
                  if($date3 =='')
                  {
                    $date_array=$this->mymodel->fetch_graph_date_str($date1,$date2);
                  }
                  else
                  {
                    $date_array=$this->mymodel->fetch_graph_date_str($date1,$date3);
                  }
                  
                   
                  //fetch deposit data
                  $deposit_data_array=$this->mymodel->fetch_graph_date($branch_id_array_for_report,$date_array,1);
                  
                  //now prepare deposit data
         			$dat=array();
        			$amt_dep=array();
        			$amt_sum=0;
        			foreach($date_array as $datte)
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
        			} 
                  
                  // fetch advance data
                  $advance_data_array=$this->mymodel->fetch_graph_date($branch_id_array_for_report,$date_array,6); 
                  
                  //now prepare advance data
         		    $amt_adv=array();
        			$adv_sum=0;
        			foreach($date_array as $datte)
        			{
        			  foreach($query2 as $prid2)
        			  {
        			  foreach($advance_data_array as $adv)
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
                    
                //further process
    	       foreach($date_array as $datte)
    			{
    			  $dat[]=substr($datte['om_dat_date'],0,11);
    			}
        		$data_['popul']['data'] =$amt_dep;
        		$data_['popul']['name'] = 'Deposit';
        		
                $data_['users']['data'] =$amt_adv;
        		$data_['users']['name'] = 'Advance';
        		$data_['axis']['categories'] =$dat;
                
        		foreach ($data_['popul']['data'] as $key => $val)
        		{
        			$output[] = (object)array(
        				'Deposit' 		=> $val,
        				'Advance'	=> $data_['users']['data'][$key],
        				'contries'		=> $data_['axis']['categories'][$key]
        			);
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
            
            $data['report_of_office']=$this->mymodel->fetch_report_of_office($report_of_office_id,$_POST['report_option_selector']);
            
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
					 $this->highcharts->set_axis_titles('.', 'Deposit & Advance');
        			 $data['charts'] = $this->highcharts->render();
        			 $data['content']=('comparison_graph/omis_graph_display');
                     $data['param']=$download;
                     //conversion str
                    $data['link_str']='See Line Graph';
                    $data['graph_title']='Bar Graph';
                    $data['link_param']=0;
                     
                    $data['uid']= $this->session->userdata('some_name1');
                    $data['txt_office_name']= $this->session->userdata('some_name2');
                    $data['dat_entry_date']= $this->session->userdata('some_name3');
                    $data['logout']='home/logout';
                    $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
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
                $data['menuArray']= $this->mymodel->get_Data_Sql_Str("Select cMnu_Instance_ID,cMnu_Called_Obj,cMnu_Des,cIsPermitted from App_Menu where cMnu_Par_ID=".$this->parent_id_get());
                $this->load->view('home',$data); 
            }
        }
        else
        {
            $this->session->set_flashdata('notice','Please Fill Up The Search Form Appropriately.');
            redirect(base_url().'index.php/rpd/omis_reportindex.php','refresh');
        }
    }
	
	//End Comparison & graph
    
    //omis report---zakariya---end
    



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */