<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{	
	public function index()
	{		
		if($this->session->userdata('logged_in'))
		{
			redirect('/home', 'refresh');
		}
		else
		{
			$page_view_content['access_is_invalid'] = $this->session->flashdata('access_is_invalid');
			$page_view_content["page_view_dir"] = "welcome_message";
			$page_view_content["logged_in"] = FALSE;
			$this->load->view("includes/template",$page_view_content);
		}		
	}

	public function check_login_details()
	{
		$username = $this->input->post('username');
		$userpass = $this->input->post('password');


		if($username AND $userpass)
		{
			$this->load->model('voter_model');
			$list = $this->voter_model->check_voter_login($username, $userpass);		

			if($list != null)
			{
				$newdata = array(
							   'acct_id'	=> $list['acct_id'],
							   'acct_lname'	=> $list['acct_lname'],
							   'acct_fname'	=> $list['acct_fname'],
							   'course_id'	=> $list['course_id'],
							   'student_id'	=> $list['acct_username'],
							   'prog_id'    => $list['prog_id'],
							   'logged_in'	=>	TRUE
				               );

				$this->session->set_userdata($newdata);

				$logs = array(
							'session_id' => $this->session->userdata('session_id'),
							'ip_address' => $this->session->userdata('ip_address'),
							'user_agent' => $this->session->userdata('user_agent'),
							'last_activity' => $this->session->userdata('last_activity'),
							'acct_id'    => $list['acct_id']
							 );
				
				// $this->voter_model->insert_logs($logs);

				redirect('/home', 'refresh');
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