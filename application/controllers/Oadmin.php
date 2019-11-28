<?php
class Oadmin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		 if(!is_user())
		 {
		  	redirect(base_url(),'refresh');
		 }

		$this->load->model('product_model');
	}
	function index(){
		$this->load->view('oadmin/oadmin_view');
	}

	function product_data(){
		$data=$this->product_model->product_list();
		echo json_encode($data);
	}

	function save(){
		$data=$this->product_model->save_product();
		echo json_encode($data);
	}

	function update(){
		$data=$this->product_model->update_product();
		echo json_encode($data);
	}

	function delete(){
		$data=$this->product_model->delete_product();
		echo json_encode($data);
	}


	/*ISS date start*/
	function issdate_view(){
		$this->load->view('oadmin/issdate_view');
	}
	function issdate_data(){
		$data=$this->product_model->issdate_list();
		echo json_encode($data);
	}

	function issdate_save(){
		$data=$this->product_model->save_issdate();
		echo json_encode($data);
	}

	function issdate_update(){
		$data=$this->product_model->update_issdate();
		echo json_encode($data);
	}

	function issdate_delete(){
		$data=$this->product_model->delete_issdate();
		echo json_encode($data);
	}
	/*ISS date end*/

	/*User Section*/
	function user_view(){
		$this->load->view('oadmin/user_view');
	}
	function user_data(){
		$data=$this->product_model->user_list();
		echo json_encode($data);
	}

	function user_save(){
		$data=$this->product_model->save_user();
		echo json_encode($data);
	}

	function user_update(){
		$data=$this->product_model->update_user();
		echo json_encode($data);
	}

	function user_delete(){
		$data=$this->product_model->delete_user();
		echo json_encode($data);
	}
	/*END User Section*/

}