<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$prog_id = $this->session->userdata('prog_id');
			$student_id = $this->session->userdata('student_id');

			$this->load->model('election_officer_model');
			$this->load->model('candidate_model');
			$this->load->model('voter_model');
			$this->load->model('timer_model');

			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);
			$is_administrator = $this->election_officer_model->check_if_admin($acct_id);
			$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
			$voter_registration = $this->candidate_model->check_voter_registration($acct_id);
			$account = $this->voter_model->get_account_profile($student_id);
			$election_countdown = $this->timer_model->get_election_countdown();

			$this->load->model('election_model');
			$elect_sched = $this->election_model->get_election_schedule();

			$page_view_content["is_change_password"] = FALSE;
			$page_view_content["logged_in"] = TRUE;	
			$page_view_content["is_election_officer"] = FALSE;
			$page_view_content["is_registered_voter"] = FALSE;
			$page_view_content["is_commissioner"] = FALSE;
			$page_view_content["page_view_data"] =  $account;
			$page_view_content["prog_id"] =  $prog_id;
			$page_view_content["elect_sched"] =  $elect_sched;
			$page_view_content["election_countdown"] = $election_countdown;
			$page_view_content["page_view_dir"] = "home/profile";

			if($is_election_officer != null)
			{
				$page_view_content["is_election_officer"] = TRUE;
			}

			if($is_commissioner != null)
			{
				$page_view_content["is_commissioner"] = TRUE;
			}
			
			if($voter_registration!=NULL)
			{
				$page_view_content['is_registered_voter'] = TRUE;
			}
			else
			{
				if($is_administrator)
				{
					$this->election_officer_model->add_admin_to_elect_officer($acct_id);
					$this->election_officer_model->add_admin_to_election_voter($acct_id);
					$page_view_content["is_election_officer"] = TRUE;
					$page_view_content["page_view_dir"] = "home/profile";
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
}
