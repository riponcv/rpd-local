<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
        //die('test');
        $this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','ajax'));
		
		$data['vwtop']='home/topinit';
		$this->load->view('home',$data);
	}
	function create1()
	{
		$this->load->model('mymodel');
		echo $this->mymodel->me();
		$this->load->view('create');
	}
	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create a news item';
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			//$this->load->view('templates/header', $data);	
			$this->load->view('create');
			//$this->load->view('templates/footer');
			
		}
		else
		{
			$this->load->model('mymodel','', TRUE);
			$this->mymodel->set_news();
			echo "success:"; 
			//$this->load->view('news/success');
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */