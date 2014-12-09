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
			$page_view_content["view_dir"] = "home_page";
			$page_view_content["logged_in"] = $session_login;
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
			$page_view_content["view_dir"] = "admin/human_resource";
			$page_view_content["logged_in"] = $session_login;
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

	public function update_human_resource()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$page_view_content["view_dir"] = "accounts/update";
			$page_view_content["logged_in"] = $session_login;
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
