<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_login = $this->session->userdata('logged_in');

			$page_view_content["view_dir"] = "home_page";
			$page_view_content["logged_in"] = $session_login;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function human_resource()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_login = $this->session->userdata('logged_in');

			$page_view_content["view_dir"] = "accounts/create";
			$page_view_content["logged_in"] = $session_login;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
