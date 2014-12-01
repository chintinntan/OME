<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Election_turnout extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$acct_id = $this->session->userdata('acct_id');
			$page_view_content["is_election_officer"] = FALSE;
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$this->load->model('voter_model');
				$page_view_content["page_view_dir"] = "voter/voter_population";
				$page_view_content["page_view_data"] = $this->voter_model->get_population();
				$page_view_content["voters"] = $this->voter_model->get_voters();
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;		
				$this->load->view("includes/template",$page_view_content);
			}
			else
			{
				redirect('/home', 'refresh');	
			}
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function registration_form()
	{
		$page_view_content["page_view_dir"] = "registration_form";		
		$this->load->view("includes/template",$page_view_content);	
	}
}
