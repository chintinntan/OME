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

	public function update_account_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id =  $this->uri->segment(3, 0);

			$this->load->model('human_resource_model');
			$dropdown_acct_type = $this->human_resource_model->get_dropdown_acct_type();
			$acct_details = $this->human_resource_model->get_update_details($acct_id);

			$page_view_content["view_dir"] = "accounts/update";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["dropdown_acct_type"] = $dropdown_acct_type;
			$page_view_content["acct_details"] = $acct_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function update_account()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id	 = $this->uri->segment(3, 0);
			$id_num	 	 = $this->input->post('id_number');
			$acct_type	 = $this->input->post('acct_type');
			$username	 = $this->input->post('username');
			$password 	 = $this->input->post('password');
			$password2	 = $this->input->post('password2');
			$fname 		 = $this->input->post('firstname');
			$mname 		 = $this->input->post('middlename');
			$lname 		 = $this->input->post('lastname');
			$acct_status = $this->input->post('status');
			if($password == $password2)
			{
				$this->load->model('account_model');
				$this->account_model->update_account($acct_id, $acct_type, $id_num, $username, $password, $lname, $fname, $mname, $acct_status);
			}
			else
			{
				redirect('/admin_home/human_resource', 'refresh');
			}

			redirect('/admin_home/human_resource', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
