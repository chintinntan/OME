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
			$this->load->model('student_model');
			$student_list = $this->student_model->get_student_list();

	 		$page_view_content["view_dir"] = "admin/student";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["student_list"] = $student_list;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}	 	
	}

	public function student_account()
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

	public function view_all_student()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('student_model');
			$student_details = $this->student_model->get_student_details();

	 		$page_view_content["view_dir"] = "student/select";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["student_details"] = $student_details;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function select_student()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$stud_acct_id = $this->uri->segment(3, 0);

			$this->load->model('teacher_model');
			$dropdown_course = $this->teacher_model->get_course_details();
			$this->load->model('student_model');
			$student_name = $this->student_model->get_student_name($stud_acct_id);
			

	 		$page_view_content["view_dir"] = "student/create";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["student_name"] = $student_name;
	 		$page_view_content["dropdown_course"] = $dropdown_course;
	 		$page_view_content["stud_acct_id"] = $stud_acct_id;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function update_student_page()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$stud_id = $this->uri->segment(3, 0);
			$this->load->model('student_model');
			$stud_update_data = $this->student_model->get_stud_update_data($stud_id);
			$this->load->model('teacher_model');
			$dropdown_course = $this->teacher_model->get_course_details();

	 		$page_view_content["view_dir"] = "student/update";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["dropdown_course"] = $dropdown_course;
	 		$page_view_content["stud_update_data"] = $stud_update_data;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}