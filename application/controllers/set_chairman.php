<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_chairman extends CI_Controller {

	public function index()
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
				$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
				$page_view_content["is_commissioner"] = FALSE;
				if($is_commissioner != null)
				{
					$page_view_content["is_commissioner"] = TRUE;
				}
				
				$this->load->model('election_model');
				$election = $this->election_model->get_election();
				$this->load->model('chairman_model');
				$chairman_data = $this->chairman_model->get_chairman();

				$page_view_content["page_view_dir"] = "chairman/set_chairman";
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["page_view_data"] = $election;
				$page_view_content["chairman_data"] = $chairman_data;
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

	public function set_as_chairman()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id =  $this->uri->segment(3, 0);

			$this->load->model('chairman_model');
			$this->chairman_model->set_as_chairman($acct_id);
			
			redirect('/set_chairman','refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
