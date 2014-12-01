<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_applicant_party extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->load->model('chairman_model');
			$party = $this->chairman_model->get_ssg_applicants_without_party();

			$page_view_content["page_view_dir"] = "party/set_applicant_party";
			$page_view_content["logged_in"] = TRUE;	
			$page_view_content["page_view_data"] = $party;
			$this->load->view("includes/template",$page_view_content);	
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function set_party()
	{

		if($this->session->userdata('logged_in'))
		{	

			$candidate_id = $this->uri->segment(3, 0);

			$this->load->model('chairman_model');
			$this->load->model('party_model');
			
			$ssg_applicant = $this->chairman_model->get_ssg_applicant_name_position($candidate_id);
			$party = $this->party_model->get_party();

			$page_view_content["page_view_dir"] = "party/update_party";
			$page_view_content["logged_in"] = TRUE;
			$page_view_content["party"] = $party;
			$page_view_content["page_view_data"] = $ssg_applicant;
			$this->load->view("includes/template",$page_view_content);	
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function update_party()
	{
		if($this->session->userdata('logged_in'))
		{	
			$candidate_id = $this->input->post('candidate_id');
			$party_id = $this->input->post('party_id');

			if($candidate_id != FALSE AND $party_id != FALSE)
			{
				$this->load->model('party_model');
				$this->party_model->update_candidate_party($party_id, $candidate_id);			
			}
			redirect('/set_applicant_party','refresh');			
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
