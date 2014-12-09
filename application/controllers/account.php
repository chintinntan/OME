<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	public function create_new_account()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$id_num	 	 = $this->input->post('id_number');
			$acct_type	 = $this->input->post('acct_type');
			$username	 = $this->input->post('username');
			$password 	 = $this->input->post('password');
			$password2	 = $this->input->post('password2');
			$fname 		 = $this->input->post('firstname');
			$mname 		 = $this->input->post('middlename');
			$lname 		 = $this->input->post('lastname');

			if($password == $password2)
			{
				$this->load->model('account_model');
				$this->account_model->add_new_account($acct_type, $id_num, $username, $password, $lname, $fname, $mname);
			}
			else
			{
				redirect('/admin_home/create_human_resource', 'refresh');
			}

			redirect('/admin_home/create_human_resource', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
