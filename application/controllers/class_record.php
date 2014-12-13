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
			$subject_id = $this->input->post('subject');
			$semester = $this->input->post('semester');
			$school_year = $this->input->post('school_year');

			$this->load->model('class_record_model');
			$this->class_record_model->add_new_class($teacher_acct_id, $section, $course, $semester, $school_year, $subject_id);
	 		// $this->view_class_record($section, $course, $subject_id, $semester, $school_year);
	 		redirect('/teacher_home/teacher_assign', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function view_class_record($section, $course, $subject_id, $semester, $school_year)
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$teacher_acct_id =  $this->uri->segment(3, 0);
	 		$this->load->model('teacher_model');
	 		$teacher_details = $this->teacher_model->get_teacher_name($teacher_acct_id);
	 		$course_name = $this->teacher_model->get_course_name($course);
	 		$section_name = $this->teacher_model->get_section_name($section);

	 		$page_view_content["course"] = $course;
	 		$page_view_content["section"] = $section;
	 		$page_view_content["subject_id"] = $subject_id;
	 		$page_view_content["semester"] = $semester;
	 		$page_view_content["school_year"] = $school_year;

	 		$this->load->model('student_model');
			$student_list = $this->student_model->get_student_list();

	 		$page_view_content["view_dir"] = "admin/assign_student";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["teacher_details"] = $teacher_details;
	 		$page_view_content["student_list"] = $student_list;
	 		$page_view_content["course_name"] = $course_name;
	 		$page_view_content["section_name"] = $section_name;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function add_new_student()
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$stud_acct_id =  $this->uri->segment(3, 0);
	 		$year_lvl = $this->input->post('yr_lvl');
	 		$course = $this->input->post('course');

	 		$this->load->model('class_record_model');
	 		$this->class_record_model->add_new_student($course, $stud_acct_id, $year_lvl);

	 		redirect('/student_home', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function update_stud_data()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$stud_id = $this->uri->segment(3, 0);
			$year_lvl = $this->input->post('yr_lvl');
	 		$course = $this->input->post('course');

			$this->load->model('class_record_model');
			$this->class_record_model->update_stud_data($course, $stud_id, $year_lvl);

			redirect('/student_home', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function add_new_record()
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$stud_id =  $this->uri->segment(3, 0);

	 		$this->load->model('class_record_model');
	 		$this->class_record_model->add_new_record($stud_id);

	 		redirect('/student_home', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}