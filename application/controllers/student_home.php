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

	public function view_all_exam_schedule()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('student_model');
			$exam_list = $this->student_model->get_exam_list();
			$stud_id = $this->student_model->get_student_id($acct_id);

	 		$page_view_content["view_dir"] = "exam/student_exam";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["exam_list"] = $exam_list;
	 		$page_view_content["stud_id"] = $stud_id;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function check_exam_password()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_sched_id = $this->uri->segment(3, 0);
			$exam_title = $this->uri->segment(4, 0);
			$this->load->helper('inflector');
			$exam_title = humanize($exam_title);
			$stud_id = $this->uri->segment(5, 0);

			$this->load->model('student_model');
			$check_student_in_exam = $this->student_model->check_student_exam($stud_id, $exam_sched_id);
			
			if($check_student_in_exam)
			{
	 			$page_view_content["view_dir"] = "exam/already_attempt";
	 		}
	 		else
	 		{
	 			$page_view_content["view_dir"] = "exam/check";
	 		}
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["exam_title"] = $exam_title;
	 		$page_view_content["stud_id"] = $stud_id;
	 		$page_view_content["exam_sched_id"] = $exam_sched_id;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
	public function take_exam()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_sched_id = $this->uri->segment(3, 0);
			$stud_id = $this->uri->segment(4, 0);
			$exam_pass = $this->input->post('password');

			$this->load->model('student_model');
			$check_pass = $this->student_model->check_exam_password($exam_pass);

			if($check_pass)
			{
				$this->load->model('generate_exam_model');
				$exam_questions =  $this->generate_exam_model->get_view_exam_questionnaire($exam_sched_id);
				$exam_choices = $this->generate_exam_model->get_view_exam_answers();

		 		$page_view_content["view_dir"] = "exam/take_exam";
		 		$page_view_content["logged_in"] = $session_login;
		 		$page_view_content["stud_id"] = $stud_id;
		 		$page_view_content["exam_sched_id"] = $exam_sched_id;
		 		$page_view_content["exam_questions"] = $exam_questions;
		 		$page_view_content["exam_choices"] = $exam_choices;
		 		$this->load->view("includes/template",$page_view_content);
	 		}
	 		else
	 		{
	 			redirect('student_home/view_all_exam_schedule', 'refresh');
	 		}
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function submit_exam_answers()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_sched_id = $this->uri->segment(3, 0);
			$stud_id = $this->uri->segment(4, 0);

			$this->load->model('generate_exam_model');
			$exam_questions =  $this->generate_exam_model->get_view_exam_questionnaire($exam_sched_id);

			for($x=0;$x<count($exam_questions);$x++)
			{
				$quest_id = $exam_questions[$x]['questionnaire_id'];
				$answer_id = $this->input->post($quest_id);

				if(isset($answer_id))
				{
					$this->load->model('student_model');
					$this->student_model->submit_exam_answers($stud_id, $exam_sched_id, $answer_id);
				}
			}
			
	 		redirect('student_home/view_all_exam_schedule', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}