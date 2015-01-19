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
							   'acct_id'		=> $details['account_id'],
							   'acct_id_number'	=> $details['id_number'],
							   'username'		=> $details['acct_username'],
							   'acct_lname'		=> $details['last_name'],
							   'acct_fname'		=> $details['first_name'],
							   'acct_mname'		=> $details['middle_name'],
							   'acct_type'		=> $details['acct_type'],
							   'logged_in'		=>	TRUE
				               );

				$this->session->set_userdata($useable_data);

				$acct_type = $this->login_model->get_acct_type($username, $userpass);

				if($acct_type[0]['account_type_id'] == 1)
				{
					redirect('/admin_home', 'refresh');
				}
				else if($acct_type[0]['account_type_id'] == 2)
				{
					redirect('/teacher_home', 'refresh');
				}
				else if($acct_type[0]['account_type_id'] == 3)
				{
					redirect('/student_home/student_account', 'refresh');
				}	
			}
			else
			{
				$this->session->set_flashdata('notification', 'This account is not registered.');
				$this->session->set_flashdata('alert', 'success');
				redirect('/login', 'refresh');
			}
		}
		else
		{
			redirect('/login', 'refresh');	
		}
	}
}
