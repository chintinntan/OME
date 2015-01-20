<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher_home extends CI_Controller 
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

			$this->load->model('teacher_model');
			$subjects = $this->teacher_model->get_subject_details();
			$sections = $this->teacher_model->get_section_details();

			$page_view_content["view_dir"] = "teacher/student_list";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["dropdown_subject"] = $subjects;
			$page_view_content["dropdown_section"] = $sections;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function search_class_student()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subject_selected = $this->input->post('subject_selected');
			$section_selected = $this->input->post('section_selected');

			$this->load->model('teacher_model');
			$class_record_list = $this->teacher_model->get_class_record_list($subject_selected, $section_selected);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "teacher/class_student";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["class_record_list"] = $class_record_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function generate_exam_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subject_selected = $this->input->post('subject_selected');
			$section_selected = $this->input->post('section_selected');

			$this->load->model('teacher_model');
			$class_record_list = $this->teacher_model->get_class_record_list($subject_selected, $section_selected);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "teacher/generate_exam";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["class_record_list"] = $class_record_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function exam_create_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subject_selected = $this->input->post('subject_selected');
			$section_selected = $this->input->post('section_selected');

			$this->load->model('teacher_model');
			$class_record_list = $this->teacher_model->get_class_record_list($subject_selected, $section_selected);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "exam/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["class_record_list"] = $class_record_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function exam_update_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subject_selected = $this->input->post('subject_selected');
			$section_selected = $this->input->post('section_selected');

			$this->load->model('teacher_model');
			$class_record_list = $this->teacher_model->get_class_record_list($subject_selected, $section_selected);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "exam/update";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["class_record_list"] = $class_record_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}