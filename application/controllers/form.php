<?php

class Form extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('ui_PFile_No', 'Username', 'required');
		$this->form_validation->set_rules('ui_Pwd', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('ui_Email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myform');
		}
		else
		{
			$this->load->view('formsuccess');
		}
	}
	
	
	function cr()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('ui_PFile_No', 'Username', 'required');
		$this->form_validation->set_rules('ui_Pwd', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('ui_Email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myform');
		}
		else
		{
			$this->load->model('mymodel','', TRUE);
			$this->mymodel->cr_user();
			$this->load->view('formsuccess');
		}
	}


}
?>