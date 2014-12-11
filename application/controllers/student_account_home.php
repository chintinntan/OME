<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_account_home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
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
}
