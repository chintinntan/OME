<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function add_enrollment()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$page_view_content["view_dir"] = "admin/assign_student";
	 		$page_view_content["logged_in"] = $session_login;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}