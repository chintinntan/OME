<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_account extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mysql_database_model');	
	}

	public function index()
	{
		$this->load->model('program_model');
		$page_view_content["program_list"] = $this->program_model->get_program_list();
		$page_view_content["page_view_dir"] = "registration/create_account";
		$page_view_content["logged_in"] = FALSE;	
		$this->load->view("includes/template",$page_view_content);		
	}

	public function profiling()
	{
		if($this->input->post('program'))
		{
			$program = array('program_id' => $this->input->post('program'));	
			$this->session->set_userdata($program);	
			$program_id = $this->session->userdata('program_id');		
		}
		else
		{
			$program_id = $this->session->userdata('program_id');		
		}

		if($program_id)
		{
			$this->load->model('program_model');
			$page_view_content['courses'] = $this->program_model->get_course_list($program_id); 
			$page_view_content["page_view_dir"] = "registration/profiling";
			$page_view_content["logged_in"] = FALSE;	
			$this->load->view("includes/template",$page_view_content);			
		}
		else
		{
			redirect(base_url('index.php/create_account'),'refresh');
		}
	}

	public function register_account()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('course', 'Course', 'required');
	    $this->form_validation->set_rules('username', 'ID Number', 'trim|required|numeric|is_unique[account.acct_username]|min_length[7]|max_length[7]');
	    $this->form_validation->set_rules('acct_password', 'Password', 'trim|required|min_length[4]');
	    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
	    $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|required');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
	    $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_unique[account.email_address]');
    
    	if ($this->form_validation->run() == FALSE)
    	{
			$this->profiling();
    	}
    	else
    	{
    		$account['username'] = $this->input->post('username');
			$account['password'] = $this->input->post('acct_password');
			$account['lastname'] = $this->input->post('last_name');
			$account['firstname'] = $this->input->post('first_name');
			$account['middlename'] = $this->input->post('middle_name');
			$account['email_address'] = $this->input->post('email_address');
			$account['course_id'] = $this->input->post('course');

    		$this->load->model('voter_model');
    		$registration_status = $this->voter_model->add_account($account);

    		$this->session->sess_destroy();
			redirect(base_url('index.php/login'), 'refresh');
    	}
	}
}
