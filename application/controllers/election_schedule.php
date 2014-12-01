<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Election_schedule extends CI_Controller 
{
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$student_id = $this->session->userdata('student_id');
			$page_view_content["is_election_officer"] = FALSE;
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			$this->load->model('timer_model');
			$election_countdown = $this->timer_model->get_election_countdown();

			if($is_election_officer != null)
			{
				$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
				$page_view_content["is_commissioner"] = FALSE;
				if($is_commissioner != null)
				{
					$page_view_content["is_commissioner"] = TRUE;
				}

				$this->load->model('election_model');
				$election = $this->election_model->get_election();
				$election_schedule = $this->election_model->get_election_schedule();

				$page_view_content["page_view_dir"] = "election/election_schedule";
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["page_view_data"] = $election;
				$page_view_content["election_schedule"] = $election_schedule;
				$page_view_content["election_countdown"] = $election_countdown;
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

	public function activate_election_schedule()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$elect_id = $this->uri->segment(3, 0);

				if($elect_id)
				{
					$this->load->model('election_model');
					$this->election_model->set_elect_sched_status_to_zero();
					$this->election_model->activate_elect_sched($elect_id);
				}

				redirect('/add_election', 'refresh');
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

	public function deactivate_election_schedule()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$elect_id = $this->uri->segment(3, 0);

				if($elect_id)
				{
					$this->load->model('election_model');
					$this->election_model->set_elect_sched_status_to_zero();
				}

				redirect('/add_election', 'refresh');
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
}
