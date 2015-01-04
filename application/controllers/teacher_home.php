<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher_home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function teacher_assign()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$this->load->model('teacher_model');
	 		$teacher_list = $this->teacher_model->get_teacher_list();

	 		$page_view_content["view_dir"] = "admin/teacher_assign";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["teacher_list"] = $teacher_list;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function create_teacher_assign()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$teacher_acct_id =  $this->uri->segment(3, 0);
	 		$this->load->model('teacher_model');
			$course = $this->teacher_model->get_course_details();
			$section = $this->teacher_model->get_section_details();
			$subject = $this->teacher_model->get_subject_details();

	 		$page_view_content["view_dir"] = "admin/assign_course_section";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["course"] = $course;
	 		$page_view_content["section"] = $section;
	 		$page_view_content["subject"] = $subject;
	 		$page_view_content["teacher_acct_id"] = $teacher_acct_id;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function view_student_list()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "teacher/student_list";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}