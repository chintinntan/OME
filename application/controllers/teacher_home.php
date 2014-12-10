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
	 		$page_view_content["view_dir"] = "admin/teacher_assign";
	 		$page_view_content["logged_in"] = $session_login;
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
	 		$this->load->model('teacher_model');
			$course = $this->teacher_model->get_course_details();
			$section = $this->teacher_model->get_section_details();

	 		$page_view_content["view_dir"] = "admin/assign_course_section";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["course"] = $course;
	 		$page_view_content["section"] = $section;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}