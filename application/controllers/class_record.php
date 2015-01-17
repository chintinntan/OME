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

	public function view_class_record()
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$teacher_acct_id =  $this->uri->segment(3, 0);
	 		$sec_id =  $this->uri->segment(4, 0);
	 		$class_record_id = $this->uri->segment(5,0);
	 		

	 		$this->load->model('class_record_model');
	 		$view_assign_details = $this->class_record_model->get_assign_details($teacher_acct_id, $sec_id);
			$student_list = $this->class_record_model->get_subject_class($class_record_id);

	 		$page_view_content["view_dir"] = "admin/assign_student";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["class_record_id"] = $class_record_id;
	 		$page_view_content["view_assign_details"] = $view_assign_details;
	 		$page_view_content["student_list"] = $student_list;
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
			$class_record_id =  $this->uri->segment(4, 0);

	 		$this->load->model('class_record_model');
	 		$this->class_record_model->add_new_record($stud_id, $class_record_id);

	 		redirect('/class_record/view_class_record', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function view_class_assign()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$teacher_acct_id =  $this->uri->segment(3, 0);
	 		$this->load->model('teacher_model');
	 		$teacher_details = $this->teacher_model->get_teacher_name($teacher_acct_id);
	 		$class_record = $this->teacher_model->get_class_record($teacher_acct_id);


			$page_view_content["view_dir"] = "admin/view_assign_class";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["teacher_details"] = $teacher_details;
			$page_view_content["class_record"] = $class_record;
			$page_view_content["teacher_acct_id"] = $teacher_acct_id;
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
			$class_record_id = $this->uri->segment(3, 0);
			$this->load->model('student_model');
			$student_list = $this->student_model->get_student_list();

			$page_view_content["view_dir"] = "student/all_student";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["class_record_id"] = $class_record_id;
			$page_view_content["student_list"] = $student_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function remove_student()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			
			$stud_id =  $this->uri->segment(3, 0);
	 		$this->load->model('class_record_model');
	 		$this->class_record_model->remove_student($stud_id);

	 		redirect('/teacher_home/teacher_assign', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function register_student()
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$stud_id =  $this->uri->segment(4, 0);
			$class_record_id =  $this->uri->segment(3, 0);

	 		$this->load->model('class_record_model');
	 		$this->class_record_model->register_student($stud_id, $class_record_id);

	 		redirect('/class_record/view_all_student/'.$class_record_id.'', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}