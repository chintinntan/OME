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
			$this->load->helper('inflector');
			$subj_name = humanize($subj_name);
			$subj_id = $this->uri->segment(4, 0);
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$this->load->model('question_bank_model');
			$questions = $this->question_bank_model->get_questions($subj_id);

			$page_view_content["view_dir"] = "question_bank/all_questionnaire";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["subj_id"] = $subj_id;
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
			$question_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$this->load->helper('inflector');
			$subj_name = humanize($subj_name);
			$subj_id = $this->uri->segment(5, 0);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();
			$this->load->model('question_bank_model');
			$period = $this->question_bank_model->get_period();
			$question = $this->question_bank_model->get_question_input($question_id);

			$page_view_content["view_dir"] = "question_bank/update";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["dropdown_period"] = $period;
			$page_view_content["question"] = $question;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["subj_id"] = $subj_id;
			$page_view_content["question_id"] = $question_id;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function update_question()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$question_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$subj_id = $this->uri->segment(5, 0);

			$grading_period = $this->input->post('selected_grading_period');
			$questionnaire = $this->input->post('questionnaire');

			$this->load->model('question_bank_model');
			$this->question_bank_model->update_question($question_id, $grading_period, $questionnaire);

			redirect("/question_bank/questionnaire/".$subj_name."/".$subj_id."",'refresh');
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
			$question_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$this->load->helper('inflector');
			$subj_name = humanize($subj_name);
			$subj_id = $this->uri->segment(5, 0);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$this->load->model('question_bank_model');
			$question = $this->question_bank_model->get_question_input($question_id);

			$page_view_content["view_dir"] = "choices/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["subj_id"] = $subj_id;
			$page_view_content["question"] = $question;
			$page_view_content["question_id"] = $question_id;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function add_choices()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$question_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$this->load->helper('inflector');
			$subj_id = $this->uri->segment(5, 0);

			$check1 = $this->input->post('check1');
			$check2 = $this->input->post('check2');
			$check3 = $this->input->post('check3');
			$check4 = $this->input->post('check4');
			$choice1 = $this->input->post('choice1');
			$choice2 = $this->input->post('choice2');
			$choice3 = $this->input->post('choice3');
			$choice4 = $this->input->post('choice4');

			$this->load->model('question_bank_model');
			$chck_def_val = 0;
			
			if($check1)
			{
				$this->question_bank_model->add_choice($question_id, $choice1, $check1);
				$this->question_bank_model->add_choice($question_id, $choice2, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice3, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice4, $chck_def_val);
			}
			else if($check2)
			{
				$this->question_bank_model->add_choice($question_id, $choice1, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice2, $check2);
				$this->question_bank_model->add_choice($question_id, $choice3, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice4, $chck_def_val);
			}
			else if($check3)
			{
				$this->question_bank_model->add_choice($question_id, $choice1, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice2, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice3, $check3);
				$this->question_bank_model->add_choice($question_id, $choice4, $chck_def_val);
			}
			else if($check4)
			{
				$this->question_bank_model->add_choice($question_id, $choice1, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice2, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice3, $chck_def_val);
				$this->question_bank_model->add_choice($question_id, $choice4, $check4);
			}
						
			redirect("/question_bank/questionnaire/".$subj_name."/".$subj_id."",'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function choices_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{	
			$question_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$this->load->helper('inflector');
			$subj_name = humanize($subj_name);
			$subj_id = $this->uri->segment(5, 0);

			$this->load->model('question_bank_model');
			$choices = $this->question_bank_model->get_choices($question_id);
			$question = $this->question_bank_model->get_question_input($question_id);

			$page_view_content["view_dir"] = "choices/update";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["choices"] = $choices;
			$page_view_content["question"] = $question;
			$page_view_content["question_id"] = $question_id;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["subj_id"] = $subj_id;
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
			$choice_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$this->load->helper('inflector');
			$subj_id = $this->uri->segment(5, 0);
			$question_id = $this->uri->segment(6, 0);

			$this->load->model('question_bank_model');
			$choice_detail = $this->question_bank_model->get_choice_details($choice_id);

			$page_view_content["view_dir"] = "choices/update";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["choice_detail"] = $choice_detail;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["subj_id"] = $subj_id;
			$page_view_content["choice_id"] = $choice_id;
			$page_view_content["question_id"] = $question_id;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function update_choice()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$choice_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$subj_id = $this->uri->segment(5, 0);
			$question_id = $this->uri->segment(6, 0);

			$new_choice = $this->input->post('new_choice');
			$check = $this->input->post('check');

			$this->load->model('question_bank_model');

			if($check)
			{
				$choice_with_check = $this->question_bank_model->get_choice_with_check($question_id);
				$this->question_bank_model->update_correct($choice_with_check[0]['answer_id']);
				$this->question_bank_model->update_choice_with_check($choice_id, $new_choice, $check);	
			}
			else
			{
				$this->question_bank_model->update_choice($choice_id, $new_choice);
			}

			redirect("/question_bank/choices_page/".$question_id."/".$subj_name."/".$subj_id."",'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function question_bank_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{	
			$choice_id = $this->uri->segment(3, 0);
			$subj_name = $this->uri->segment(4, 0);
			$this->load->helper('inflector');
			$subj_id = $this->uri->segment(5, 0);
			$question_id = $this->uri->segment(6, 0);

			$this->load->model('question_bank_model');
			$choice_detail = $this->question_bank_model->get_choice_details($choice_id);

			$page_view_content["view_dir"] = "question_bank/view_all_question_bank";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["choice_detail"] = $choice_detail;
			$page_view_content["subj_name"] = $subj_name;
			$page_view_content["subj_id"] = $subj_id;
			$page_view_content["choice_id"] = $choice_id;
			$page_view_content["question_id"] = $question_id;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}
}