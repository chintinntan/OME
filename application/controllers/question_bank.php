<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question_bank extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id 	= $this->session->userdata('acct_id');
			$this->load->model('question_bank_model');
			$teacher_subjects = $this->question_bank_model->get_teacher_subjects($acct_id);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "teacher/question_bank";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["teacher_subjects"] = $teacher_subjects;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function questionnaire()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subj_name = $this->uri->segment(3, 0);
			$subj_id = $this->uri->segment(4, 0);
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$this->load->model('question_bank_model');
			$questions = $this->question_bank_model->get_questions($subj_id);

			$page_view_content["view_dir"] = "question_bank/all_questionnaire";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["questions"] = $questions;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function create_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subj_name = $this->uri->segment(3, 0);
			$subj_id = $this->uri->segment(4, 0);
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();
			$this->load->model('question_bank_model');
			$period = $this->question_bank_model->get_period();

			$page_view_content["view_dir"] = "question_bank/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["subj_id"] = $subj_id;
			$page_view_content["dropdown_period"] = $period;
			$page_view_content["acct_details"] = $acct_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function add_question()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subj_name = $this->uri->segment(3, 0);
			$subj_id = $this->uri->segment(4, 0);
			$grading_period = $this->input->post('selected_grading_period');
			$questionnaire = $this->input->post('questionnaire');

			$this->load->model('question_bank_model');
			$period = $this->question_bank_model->add_question($subj_id, $grading_period, $questionnaire);

			redirect("/question_bank/questionnaire/".$subj_name."/".$subj_id."",'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function update_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "question_bank/update";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function add_choices_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "choices/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function update_choices_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "choices/update";
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