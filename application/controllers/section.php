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
			$this->load->model('section_model');
			$section_data = $this->section_model->get_section_data();

	 		$page_view_content["view_dir"] = "admin/section";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["section_data"] = $section_data;
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

	public function add_new_section()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$section_acronym = strtoupper($this->input->post('section_acronym'));

	 		$this->load->model('section_model');
	 		$this->section_model->add_new_section($section_acronym);

	 		redirect('/section', 'refresh');
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function update_section_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$section_id = $this->uri->segment(3, 0);

	 		$this->load->model('section_model');
	 		$sec_update_data = $this->section_model->get_sec_update_data($section_id);

	 		$page_view_content["view_dir"] = "section/update";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["sec_update_data"] = $sec_update_data;
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
	 		$section_id = $this->uri->segment(3, 0);
	 		$sec_name = strtoupper($this->input->post('section_acronym'));

	 		$this->load->model('section_model');
	 		$sec_update_data = $this->section_model->update_section($section_id, $sec_name);

	 		redirect('/section', 'refresh');	
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}
}