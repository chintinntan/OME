<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Date Created 2014/01/03 */

class Ssg_applicant_list extends CI_Controller 
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

			$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
			$page_view_content["is_commissioner"] = FALSE;
			if($is_commissioner != null)
			{
				$page_view_content["is_commissioner"] = TRUE;
			}

			$this->load->model('election_model');
			$elect_sched = $this->election_model->get_election_schedule();
			$prog_id = $this->session->userdata('prog_id');
			$page_view_content["prog_id"] =  $prog_id;
			$page_view_content["elect_sched"] =  $elect_sched;

			if($is_election_officer != null)
			{
				$application_status = $this->input->post('applicant_status');
				$this->load->model('chairman_model');
				$this->load->model('party_model');

				if($application_status != NULL AND $application_status != 3 AND $application_status != 4)
				{
					$ssg_applicants = $this->chairman_model->get_ssg_applicants_by_status($application_status);	
					$page_view_content["page_view_data"] = $ssg_applicants;
					$page_view_content["student_id"] = $student_id;
					$page_view_content["page_view_dir"] = "candidates/list_of_approved_ssg_applicants";
				}
				else
				{
					$ssg_applicants = $this->chairman_model->get_ssg_applicants();
					$party = $this->party_model->get_party();
					$page_view_content["page_view_data"] = $ssg_applicants;
					$page_view_content["party"] = $party;
					$page_view_content["student_id"] = $student_id;
					$page_view_content["page_view_dir"] = "candidates/list_of_ssg_applicants";
				}

				$page_view_content["election_countdown"] = $election_countdown;
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

	public function update_status()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$candidate_id = $this->uri->segment(3, 0);
				$status = $this->uri->segment(4, 0);

				$this->load->model('chairman_model');
				$ssg_applicants = $this->chairman_model->update_ssg_applicant_status($candidate_id,$status);

				redirect('/ssg_applicant_list', 'refresh');
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

	public function display_approved_candidates()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			$this->load->model('election_model');
			$elect_sched = $this->election_model->get_election_schedule();
			$prog_id = $this->session->userdata('prog_id');
			$page_view_content["prog_id"] =  $prog_id;
			$page_view_content["elect_sched"] =  $elect_sched;

			if($is_election_officer != null)
			{
				$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
				$page_view_content["is_commissioner"] = FALSE;
				if($is_commissioner != null)
				{
					$page_view_content["is_commissioner"] = TRUE;
				}

				$this->load->model('chairman_model');
				$ssg_applicants = $this->chairman_model->get_ssg_applicants_by_status(1);
				
				$page_view_content["page_view_data"] = $ssg_applicants;
				$page_view_content["page_view_dir"] = "candidates/list_of_approved_ssg_applicants";
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

	public function set_party()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$candidate_id = $this->input->post('ecid');
				$party_id = $this->input->post('party');

				if($candidate_id != FALSE AND $party_id != FALSE AND $party_id != 'selected')
				{
					$this->load->model('party_model');
					$this->party_model->update_candidate_party($party_id, $candidate_id);			
				}
				redirect('/ssg_applicant_list','refresh');		
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

	public function delete_candidate()
	{
		if($this->session->userdata('logged_in'))
		{	
			$elect_cand_id =  $this->uri->segment(3, 0);

			if($elect_cand_id != FALSE)
			{
				$this->load->model('candidate_model');
				$this->candidate_model->delete_candidate($elect_cand_id);
			}
			redirect('/ssg_applicant_list','refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function change_position()
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

			$this->load->model('election_model');
			$elect_sched = $this->election_model->get_election_schedule();
			$prog_id = $this->session->userdata('prog_id');
			$page_view_content["prog_id"] =  $prog_id;
			$page_view_content["elect_sched"] =  $elect_sched;

			if($is_election_officer != null)
			{
				$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
				$page_view_content["is_commissioner"] = FALSE;
				if($is_commissioner != null)
				{
					$page_view_content["is_commissioner"] = TRUE;
				}

				$elect_cand_id = $this->uri->segment(3, 0);
				$this->load->model('position_model');

				$page_view_content["page_view_data"] = $this->position_model->get_division();
				$page_view_content["elect_cand_id"] = $elect_cand_id;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["page_view_dir"] = "candidates/change_position";
				$page_view_content["election_countdown"] = $election_countdown;

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

	public function select_position()
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
				
				$elect_cand_id = $this->input->post('elect_cand_id');
				$div_id = $this->input->post('division');
				$this->load->model('position_model');

				$page_view_content["page_view_data"] = $this->position_model->get_list_of_position($div_id);
				$page_view_content["elect_cand_id"] = $elect_cand_id;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["page_view_dir"] = "candidates/select_position";
				$page_view_content["election_countdown"] = $election_countdown;

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
}
