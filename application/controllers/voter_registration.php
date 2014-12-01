<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voter_registration extends CI_Controller 
{
	 function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->pdf->fontpath = 'font/'; 	
	}

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
				
				$page_view_content['record_not_found'] = $this->session->flashdata('record_not_found');
				$page_view_content['is_not_numeric'] = $this->session->flashdata('is_not_numeric');
				$page_view_content["page_view_dir"] = "voter_registration/search_account";
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["student_id"] = $student_id;
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

	public function search_account()
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


			if($is_election_officer != null)
			{
				$student_id = $this->input->get('account');

				if($student_id)
				{
					if(is_numeric($student_id))
					{
						$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
						$page_view_content["is_commissioner"] = FALSE;
						if($is_commissioner != null)
						{
							$page_view_content["is_commissioner"] = TRUE;
						}

						$this->load->model('voter_model');
						$this->load->model('candidate_model');
						$account = $this->voter_model->get_account_profile($student_id);
		
						$page_view_content["logged_in"] = TRUE;
						$page_view_content["is_election_officer"] = TRUE;
						$page_view_content["page_view_dir"] = "voter_registration/display_account_details";
						$page_view_content['is_registered_voter'] = FALSE;
						$page_view_content["student_id"] = $student_id;

						if($account)
						{
							$page_view_content['is_registered_voter'] = $this->candidate_model->check_voter_registration($account['acct_id']);
							$page_view_content["page_view_data"] =  $account;
							$this->load->view("includes/template",$page_view_content);
						}
						else
						{
							$this->session->set_flashdata('record_not_found', TRUE);
							redirect('/voter_registration', 'refresh');
						}
					}
					else
					{
						$this->session->set_flashdata('is_not_numeric', TRUE);
						redirect('/voter_registration', 'refresh');
					}
				}
				else
				{
					redirect('/voter_registration','refresh');
				}
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

	public function register_account()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$acct_id = $this->uri->segment(3, 0);
				$this->load->model('voter_model');
				$this->voter_model->add_election_voter($acct_id);
				$account_username = $this->voter_model->get_account_username($acct_id);
				redirect('/voter_registration/search_account?account='.$account_username['acct_username'],'refresh');
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

	public function deactivate_account()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$acct_id = $this->uri->segment(3, 0);
				$this->load->model('voter_model');
				$this->voter_model->reset_vote($acct_id);
				$this->voter_model->delete_election_voter($acct_id);
				$account_username = $this->voter_model->get_account_username($acct_id);
				redirect('/voter_registration/search_account?account='.$account_username['acct_username'],'refresh');
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

	public function reset_password()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$acct_id = $this->uri->segment(3, 0);
				$this->load->model('voter_model');
				$this->voter_model->reset_password($acct_id);
				$account_username = $this->voter_model->get_account_username($acct_id);
				redirect('/voter_registration/search_account?account='.$account_username['acct_username'],'refresh');
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

	public function reset_vote()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('election_officer_model');
			$is_election_officer = $this->election_officer_model->check_if_election_officer($acct_id);

			if($is_election_officer != null)
			{
				$acct_id = $this->uri->segment(3, 0);
				$this->load->model('voter_model');
				$this->voter_model->reset_vote($acct_id);
				$account_username = $this->voter_model->get_account_username($acct_id);
				redirect('/voter_registration/search_account?account='.$account_username['acct_username'],'refresh');
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

	public function change_password()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
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
			$prog_id = $this->session->userdata('prog_id');
			$page_view_content["prog_id"] =  $prog_id;
			$page_view_content["elect_sched"] =  $elect_sched;


			$page_view_content["is_change_password"] = TRUE;
			$page_view_content["logged_in"] = TRUE;	
			$page_view_content["is_election_officer"] = FALSE;
			$page_view_content["is_registered_voter"] = FALSE;
			$page_view_content["is_commissioner"] = FALSE;
			$page_view_content["page_view_data"] =  $account;
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

	public function update_password()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
			$new_password = $this->input->post('new_password');

			if($new_password)
			{
				$this->load->model('voter_model');
				$this->voter_model->update_acct_password($new_password, $acct_id);
			}

			redirect('/home', 'refresh');	
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	 public function generate_pdf()
	{
		if($this->session->userdata('logged_in'))
		{	
			$acct_id = $this->session->userdata('acct_id');
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
				
				$acct_id = $this->uri->segment(3, 0);
				$this->load->helper('date');
			    $this->load->model('voter_model');
		        $result = $this->voter_model->get_pdf_details($acct_id);

				$page_view_content["page_view_dir"] = "voter_registration/PDF_view";
				$page_view_content["is_election_officer"] = TRUE;
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["result"] = $result;
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
