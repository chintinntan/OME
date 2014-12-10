<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
		{
	 		$page_view_content["view_dir"] = "admin/section";
	 		$page_view_content["logged_in"] = $session_login;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function create_section()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$page_view_content["view_dir"] = "section/create";
	 		$page_view_content["logged_in"] = $session_login;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function update_section()
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$page_view_content["view_dir"] = "section/update";
	 		$page_view_content["logged_in"] = $session_login;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}