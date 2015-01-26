<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
	}

	private function validate_input()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('id_number','<b>ID NUMBER</b>','trim|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('username', '<b>USERNAME</b>', 'trim|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', '<b>PASSWORD</b>', 'trim|matches[password2]|min_length[5]');
		$this->form_validation->set_rules('password2', '<b>CONFIRM PASSWORD</b>', 'trim');
		$this->form_validation->set_rules('firstname','<b>FIRSTNAME</b>','trim|min_length[2]|xss_clean');
		$this->form_validation->set_rules('middlename','<b>MIDDLENAME</b>','trim|xss_clean');
		$this->form_validation->set_rules('lastname','<b>LASTNAME</b>','trim|xss_clean|min_length[2]');

	}

	public function create_new_account()
	{
	

		$this->validate_input();

		if($this->form_validation->run()){
		
		
		
			if($session_login = $this->session->userdata('logged_in'))
			{
			$id_num	 	 = $this->input->post('id_number');
			$acct_type	 = $this->input->post('acct_type');
			$username	 = $this->input->post('username');
			$password 	 = $this->input->post('password');
			$password2	 = $this->input->post('password2');
			$fname 		 = strtoupper($this->input->post('firstname'));
			$mname 		 = strtoupper($this->input->post('middlename'));
			$lname 		 = strtoupper($this->input->post('lastname'));

		
				$this->load->model('account_model');
				$check = $this->account_model->check_acct_dup($id_num);

				if($check == NULL)
				{
					$this->account_model->add_new_account($acct_type, $id_num, $username, $password, $lname, $fname, $mname);
					$this->session->set_flashdata('notification', 'This account successfully registered.');
					$this->session->set_flashdata('alert', 'success');
				}
				else
				{
					$this->session->set_flashdata('notification', 'Account ID number already exists!');
					$this->session->set_flashdata('alert', 'success');
				}

			redirect('/admin_home/create_human_resource', 'refresh');
			}
				else
			{
			redirect('/login', 'refresh');
			}
	}
		

		
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('human_resource_model');
			$dropdown_acct_type = $this->human_resource_model->get_dropdown_acct_type();	
			
			$page_view_content["view_dir"] = "accounts/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["dropdown_acct_type"] = $dropdown_acct_type;
			$this->load->view("includes/template",$page_view_content);
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
		$this->validate_input();
		if($this->form_validation->run()){
		if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id	 = $this->uri->segment(3, 0);
			$id_num	 	 = $this->input->post('id_number');
			$acct_type	 = $this->input->post('acct_type');
			$username	 = $this->input->post('username');
			$password 	 = $this->input->post('password');
			$password2	 = $this->input->post('password2');
			$fname 		 = strtoupper($this->input->post('firstname'));
			$mname 		 = strtoupper($this->input->post('middlename'));
			$lname 		 = strtoupper($this->input->post('lastname'));
			$acct_status = $this->input->post('acct_status');
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
}
