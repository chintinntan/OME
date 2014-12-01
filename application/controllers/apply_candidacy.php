<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apply_candidacy extends CI_Controller 
{
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$student_id = $this->session->userdata('student_id');

			$this->load->model('candidate_model');
			$this->load->model('election_officer_model');
			
			$candidacy = $this->candidate_model->check_candidacy_application($acct_id);
			$voter_registration = $this->candidate_model->check_voter_registration($acct_id);
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			$this->load->model('timer_model');
			$election_countdown = $this->timer_model->get_election_countdown();

			$page_view_content["logged_in"] = TRUE;	
			$page_view_content["student_id"] = $student_id;
			$page_view_content["is_election_officer"] = FALSE;
			$page_view_content["election_countdown"] = $election_countdown;

			if($is_election_officer != null)
			{
				$page_view_content["is_election_officer"] = TRUE;
			}
			
			if($candidacy!=NULL)
			{
				$page_view_content["page_view_data"] = 	$candidacy;
				$page_view_content["page_view_dir"] = "candidacy/candidacy_application_table";
			}
			else
			{
				if($voter_registration!=NULL)
				{
					$this->load->model('position_model');
					$page_view_content["page_view_data"] = $this->position_model->get_division();
					$page_view_content["page_view_dir"] = "candidacy/candidacy_application_form";
				}
				else
				{
					$page_view_content["page_view_dir"] = "error_message/message_1";
				}
			}

			$this->load->view("includes/template",$page_view_content);		
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function select_position()
	{
		if($this->session->userdata('logged_in'))
		{	
			$division = $this->input->post('division');
			$acct_id = $this->session->userdata('acct_id');
			$student_id = $this->session->userdata('student_id');

			$this->load->model('position_model');
			$this->load->model('election_officer_model');

			$this->load->model('timer_model');
			$election_countdown = $this->timer_model->get_election_countdown();
			
			$page_view_content["is_election_officer"] = FALSE;
			$page_view_content["student_id"] = $student_id;
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$page_view_content["is_election_officer"] = TRUE;
			}
			
			if($division)
			{
				$page_view_content["logged_in"] = TRUE;	
				$page_view_content["page_view_dir"] = "candidacy/position_list_form";
				$page_view_content["election_countdown"] = $election_countdown;
				$page_view_content["page_view_data"] = $this->position_model->get_list_of_position($division);
				$this->load->view("includes/template",$page_view_content);		
			}
			else
			{
				redirect('/apply_candidacy', 'refresh');
			}
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function submit_application()
	{
		if($this->session->userdata('logged_in'))
		{	
			$account_id = $this->session->userdata('acct_id');
			$position = $this->input->post('position');
			
			if($account_id != FALSE AND $position != FALSE)
			{
				$this->load->model('candidate_model');
				$this->candidate_model->add_candidacy_application($account_id,$position);
			}
			
			redirect('/apply_candidacy', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}
}
