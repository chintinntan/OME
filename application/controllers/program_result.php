<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program_result extends CI_Controller 
{
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$student_id = $this->session->userdata('student_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);
			$page_view_content["is_election_officer"] = FALSE;

			$this->load->model('election_model');
			$elect_sched = $this->election_model->get_election_schedule();
			$prog_id = $this->session->userdata('prog_id');
			$page_view_content["prog_id"] =  $prog_id;
			$page_view_content["elect_sched"] =  $elect_sched;


			$this->load->model('timer_model');
			$election_countdown = $this->timer_model->get_election_countdown();

			if($is_election_officer != null)
			{
				$page_view_content["is_election_officer"] = TRUE;
			}

			$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
			$page_view_content["is_commissioner"] = FALSE;
			if($is_commissioner != null)
			{
				$page_view_content["is_commissioner"] = TRUE;
			}

			$page_view_content["page_view_dir"] = "results/program_list";
			$page_view_content["logged_in"] = TRUE;	
			$page_view_content["student_id"] = $student_id;
			$page_view_content["election_countdown"] = $election_countdown;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function view_program_result()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$student_id = $this->session->userdata('student_id');
			$page_view_content["is_election_officer"] = FALSE;
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			$this->load->model('election_model');
			$elect_sched = $this->election_model->get_election_schedule();
			$prog_id = $this->session->userdata('prog_id');
			$page_view_content["prog_id"] =  $prog_id;
			$page_view_content["elect_sched"] =  $elect_sched;


			$this->load->model('timer_model');
			$election_countdown = $this->timer_model->get_election_countdown();

			if($is_election_officer != null)
			{
				$page_view_content["is_election_officer"] = TRUE;
			}

			$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
			$page_view_content["is_commissioner"] = FALSE;
			if($is_commissioner != null)
			{
				$page_view_content["is_commissioner"] = TRUE;
			}
			
			$this->load->model('voter_model');
			$this->load->model('results_model');

			$prog_id = $this->uri->segment(3, 0);
			$results = $this->results_model->get_program_result($prog_id);

			$page_view_content["page_view_dir"] = "results/program_result_view";
			$page_view_content["logged_in"] = TRUE;
			$page_view_content["page_view_data"] = $results;
			$page_view_content["student_id"] = $student_id;
			$page_view_content["election_countdown"] = $election_countdown;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
