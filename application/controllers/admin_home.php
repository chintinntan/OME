<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{	
			$id_number 	= $this->session->userdata('acct_id_number');
			$acct_lname = $this->session->userdata('acct_lname');
			$acct_fname = $this->session->userdata('acct_fname');
			$acct_mname = $this->session->userdata('acct_mname');
			$username 	= $this->session->userdata('username');
			$acct_type  = $this->session->userdata('acct_type');

			$page_view_content["view_dir"] = "home_page";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["id_num"] = $id_number;
			$page_view_content["acct_lname"] = $acct_lname;
			$page_view_content["acct_fname"] = $acct_fname;
			$page_view_content["acct_mname"] = $acct_mname;
			$page_view_content["username"] = $username;
			$page_view_content["acct_type"] = $acct_type;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function human_resource()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "admin/human_resource";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function create_human_resource()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('human_resource_model');
			$dropdown_acct_type = $this->human_resource_model->get_dropdown_acct_type();	

			$page_view_content["view_dir"] = "accounts/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["dropdown_acct_type"] = $dropdown_acct_type;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	//  public function teacher_assign()
	// {
	// 	if($session_login = $this->session->userdata('logged_in'))
	// 	{
	// 		$page_view_content["view_dir"] = "admin/teacher_assign";
	// 		$page_view_content["logged_in"] = $session_login;
	// 		$this->load->view("includes/template",$page_view_content);
	// 	}
	// 	else
	// 	{
	// 		redirect('/login', 'refresh');
	// 	}
	// }

	// public function create_teacher_assign()
	// {
	// 	if($session_login = $this->session->userdata('logged_in'))
	// 	{
	// 		$page_view_content["view_dir"] = "admin/assign_course_section";
	// 		$page_view_content["logged_in"] = $session_login;
	// 		$this->load->view("includes/template",$page_view_content);
	// 	}
	// 	else
	// 	{
	// 		redirect('/login', 'refresh');
	// 	}
	// }

	// public function add_student()
	// {
	// 	if($session_login = $this->session->userdata('logged_in'))
	// 	{
	// 		$page_view_content["view_dir"] = "admin/assign_student";
	// 		$page_view_content["logged_in"] = $session_login;
	// 		$this->load->view("includes/template",$page_view_content);
	// 	}
	// 	else
	// 	{
	// 		redirect('/login', 'refresh');
	// 	}
	// }

	// public function section()
	// {
	// 	if($session_login = $this->session->userdata('logged_in'))
	// 	{
	// 		$page_view_content["view_dir"] = "admin/section";
	// 		$page_view_content["logged_in"] = $session_login;
	// 		$this->load->view("includes/template",$page_view_content);
	// 	}
	// 	else
	// 	{
	// 		redirect('/login', 'refresh');
	// 	}
	// }

	// public function create_section()
	// {
	// 	if($this->session->userdata('logged_in'))
	// 	{
	// 		$page_view_content["view_dir"] = "section/create";
	// 		$page_view_content["logged_in"] = $session_login;
	// 		$this->load->view("includes/template",$page_view_content);
	// 	}
	// 	else
	// 	{
	// 		redirect('/login', 'refresh');
	// 	}
	// }

	// public function update_section()
	// {
	// 	if($this->session->userdata('logged_in'))
	// 	{
	// 		$page_view_content["view_dir"] = "section/update";
	// 		$page_view_content["logged_in"] = $session_login;
	// 		$this->load->view("includes/template",$page_view_content);
	// 	}
	// 	else
	// 	{
	// 		redirect('/login', 'refresh');
	// 	}
	// }
	
}
