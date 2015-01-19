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
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "teacher/question_bank";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
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
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "question_bank/all_questionnaire";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
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
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "question_bank/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$this->load->view("includes/template",$page_view_content);
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
}