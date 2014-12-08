<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$page_view_content["view_dir"] = "welcome_message";
		$page_view_content["logged_in"] = FALSE;
		$this->load->view("includes/template",$page_view_content);
	}
	public function validation()
	{
		$username = $this->input->post('username');
		$userpass = $this->input->post('password');

		if($username AND $userpass)
		{
			$this->load->model('login_model');
			$details = $this->login_model->check_user_login($username, $userpass);	

			if($details != null)
			{
				$useable_data = array(
							   'acct_id'	=> $details['account_id'],
							   'acct_lname'	=> $details['last_name'],
							   'acct_fname'	=> $details['first_name'],
							   'logged_in'	=>	TRUE
				               );

				$this->session->set_userdata($useable_data);
				$session_login = $this->session->userdata('logged_in');

				$page_view_content["view_dir"] = "accounts/create";
				$page_view_content["logged_in"] = $session_login;
				$this->load->view("includes/template",$page_view_content);
				//redirect('accounts/create', 'refresh');
			}
			else
			{
				redirect('/login', 'refresh');
			}
		}
		else
		{
			redirect('/login', 'refresh');	
		}
	}

}
