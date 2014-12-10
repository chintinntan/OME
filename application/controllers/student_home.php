<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
	 		$page_view_content["view_dir"] = "admin/student";
	 		$page_view_content["logged_in"] = $session_login;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function add_student()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
	 		$page_view_content["view_dir"] = "student/create";
	 		$page_view_content["logged_in"] = $session_login;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

}