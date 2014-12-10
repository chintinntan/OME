<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Class_record extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function add_new_class()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$teacher_acct_id =  $this->uri->segment(3, 0);
	 		$section = $this->input->post('section');
			$course = $this->input->post('course');

			$this->load->model('class_record_model');
			$this->class_record_model->add_new_class($teacher_acct_id, $section, $course);

	 		$this->view_class_record($section, $course);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function view_class_record($section, $course)
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$teacher_acct_id =  $this->uri->segment(3, 0);
	 		$this->load->model('teacher_model');
	 		$teacher_details = $this->teacher_model->get_teacher_name($teacher_acct_id);
	 		$course_name = $this->teacher_model->get_course_name($course);
	 		$section_name = $this->teacher_model->get_section_name($section);

	 		$page_view_content["view_dir"] = "admin/assign_student";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["teacher_details"] = $teacher_details;
	 		$page_view_content["course_name"] = $course_name;
	 		$page_view_content["section_name"] = $section_name;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}