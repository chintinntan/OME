<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_commissioner extends CI_Controller {

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
				$commissioner_data = $this->chairman_model->get_commissioner();

				$page_view_content["page_view_dir"] = "commissioner/add_commissioner";
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["page_view_data"] = $election;
				$page_view_content["commissioner_data"] = $commissioner_data;
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

	public function add_new_commissioner()
	{
		if($this->session->userdata('logged_in'))
		{	
			$student_id = $this->input->post('student_id');

			$this->load->model('chairman_model');
			$commissioner_acct_id = $this->chairman_model->search_commissioner_acct_id($student_id);
			
			$this->chairman_model->add_new_commissioner($commissioner_acct_id[0]['acct_id']);

			redirect('/add_commissioner','refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function delete_commissioner()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id =  $this->uri->segment(3, 0);

			$this->load->model('chairman_model');
			$this->chairman_model->delete_commissioner($acct_id);
			
			redirect('/add_commissioner','refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
