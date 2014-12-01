<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_election extends CI_Controller {

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

				$page_view_content["page_view_dir"] = "election/add_election";
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["page_view_data"] = $election;
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

	public function add_election_sched()
	{
		if($this->session->userdata('logged_in'))
		{	
			$school_year = $this->input->post('school_year');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');

			$this->load->model('election_model');
			$duplicate = $this->election_model->check_duplicate($school_year);

			if($duplicate)
			{
				redirect('/add_election','refresh');
			}
			else
			{
				$this->election_model->add_election($school_year, $start_date, $end_date);
				redirect('/add_election','refresh');
			}
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function activate_election()
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
					$this->election_model->set_status_to_zero();
					$this->election_model->activate_election($elect_id);
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

	public function delete_election()
	{
		if($this->session->userdata('logged_in'))
		{	
			$elect_id =  $this->uri->segment(3, 0);

			$this->load->model('election_model');
			$this->election_model->delete_election($elect_id);
			
			redirect('/add_election','refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function edit_election()
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
				$elect_id =  $this->uri->segment(3, 0);
				$election = $this->election_model->get_election_data($elect_id);

				$page_view_content["page_view_dir"] = "election/edit_election";
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["page_view_data"] = $election;
				$page_view_content["elect_id"] = $elect_id;
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

	public function update_election_sched()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$elect_id = $this->input->post('elect_id');
				$school_year = $this->input->post('school_year');
				$start_date = $this->input->post('start_date');
				$end_date = $this->input->post('end_date');

				if($elect_id)
				{
					$this->load->model('election_model');
					$this->election_model->update_election_sched($school_year, $start_date, $end_date, $elect_id);
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
