<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ballot extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{	
			/*
			 * This code segment will check if the user is an 
			 * election officer
			 */
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

			$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
			$page_view_content["is_commissioner"] = FALSE;
			if($is_commissioner != null)
			{
				$page_view_content["is_commissioner"] = TRUE;
			}

			if($is_election_officer != null)
			{
				$page_view_content["is_election_officer"] = TRUE;
			}
			/*
			 * Election officer checker ends here
			 */

			$course = $this->session->userdata('course_id');

			$this->load->model('candidate_model');
			$voter_registration = $this->candidate_model->check_voter_registration($acct_id);

			$this->load->model('voter_model');
			$voter_id = $this->voter_model->get_election_voter_id($acct_id);
			$check_voter = $this->voter_model->check_voter_if_voted($voter_id[0]['elect_voter_id']);
			$voter_prog_id = $this->voter_model->get_voter_prog_id($acct_id);
			
			
			if($voter_registration!=NULL)
			{
				if($check_voter)
				{	
					$ip_address_list = array(
											'192.168.201',
											'192.168.202',
											'192.168.203',
											'192.168.204',
											'192.168.106',
											'127.0.0.1'
											);

					$ip_add = array('ip_address' => $this->session->userdata('ip_address'));
					$current_ip = substr($ip_add['ip_address'],0, 11);
					$voting_station = 0;

					for($x=0;$x<count($ip_address_list);$x++)
					{
						if($current_ip == $ip_address_list[$x])
						{
							$voting_station = 1;
						}
					}

					if($voting_station == 1)
					{
						for($i=0;$i<count($check_voter);$i++)
						{
							if($check_voter[$i]['elect_voter_id'] == $voter_id[0]['elect_voter_id'])
							{
								$page_view_content["page_view_dir"] = "ballot/show_ballot";
								$page_view_content["page_view_data"] = $this->voter_model->get_voted_candidates_by_voter($voter_id[0]['elect_voter_id']);
							}
						}
					}
					else
					{
						$page_view_content["page_view_dir"] = "ballot/ballot_restriction";
						$page_view_content["election_countdown"] = $election_countdown;
					}
				}
				else
				{
					$ip_address_list = array(
											'192.168.201',
											'192.168.202',
											'192.168.203',
											'192.168.204',
											'192.168.106',
											'127.0.0.1'
											);

					$ip_add = array('ip_address' => $this->session->userdata('ip_address'));
					$current_ip = substr($ip_add['ip_address'],0, 11);
					$voting_station = 0;

					for($x=0;$x<count($ip_address_list);$x++)
					{
						if($current_ip == $ip_address_list[$x])
						{
							$voting_station = 1;
						}
					}

					if($voting_station == 1)
					{
						$page_view_content["page_view_dir"] = "ballot/ballot_form";			
						$page_view_content["page_view_data"] = $this->candidate_model->get_ssg_candidate_list();
						$page_view_content["program_candidates"] = $this->candidate_model->get_program_candidate_list($voter_prog_id[0]['prog_id']);
						$page_view_content["position_ssg"] = $this->candidate_model->get_position_list(1);
						$page_view_content["position_program"] = $this->candidate_model->get_position_list(2);
						$page_view_content["election_countdown"] = $election_countdown;
					}
					else
					{
						$page_view_content["page_view_dir"] = "ballot/ballot_restriction";
					}
				}
			}
			else
			{
				$page_view_content["page_view_dir"] = "error_message/message_1";
			}
			
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

	public function submit_vote()
	{
		if($this->session->userdata('logged_in'))
		{	

			/*
			 * This code segment will check if the user is an 
			 * election officer
			 */
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

			$is_commissioner = $this->election_officer_model->check_if_commissioner($acct_id);
			$page_view_content["is_commissioner"] = FALSE;
			if($is_commissioner != null)
			{
				$page_view_content["is_commissioner"] = TRUE;
			}

			if($is_election_officer != null)
			{
				$page_view_content["is_election_officer"] = TRUE;
			}
			/*
			 * Election officer checker ends here
			 */
			$program_rep = $this->input->post('program_rep');

			if(count($program_rep) > 3)
			{
				$page_view_content["page_view_dir"] = "ballot/program_rep_restriction";
				$page_view_content["logged_in"] = TRUE;
				$page_view_content["student_id"] = $student_id;
				$page_view_content["election_countdown"] = $election_countdown;	
				$this->load->view("includes/template",$page_view_content);
			}
			else
			{
				$this->load->model('voter_model');
				$voter_prog_id = $this->voter_model->get_voter_prog_id($acct_id);
				$voter_id = $this->voter_model->get_election_voter_id($acct_id); 

				$this->load->model('candidate_model');
				$position_id = $this->candidate_model->get_position_list(1);

				for($x=0;$x<count($position_id);$x++)
				{
					$pos_id = $position_id[$x]['pos_id'];
					$elect_cand_id = $this->input->post($pos_id);

					if($elect_cand_id)
					{
						$this->load->model('ballot_model');
						$this->ballot_model->insert_vote($elect_cand_id, $voter_id[0]['elect_voter_id'], $voter_prog_id[0]['prog_id']);
					}
				}

				
				$position_id = $this->candidate_model->get_position_list(2);
				for($x=0;$x<count($position_id);$x++)
				{
					$pos_id = $position_id[$x]['pos_id'];
					$elect_cand_id = $this->input->post($pos_id);

					if($elect_cand_id != NULL)
					{
						$this->load->model('ballot_model');
						$this->ballot_model->insert_vote($elect_cand_id, $voter_id[0]['elect_voter_id'], $voter_prog_id[0]['prog_id']);
					}
				}

				$program_rep = $this->input->post('program_rep');
				if($program_rep != "FALSE")
				{
					if($elect_cand_id == NULL AND isset($program_rep))
					{
						$program_rep = $this->input->post('program_rep');

						for($x=0;$x<count($program_rep);$x++)
						{
							$elect_cand_id = $program_rep[$x];
							$this->load->model('ballot_model');
							$this->ballot_model->insert_vote($elect_cand_id, $voter_id[0]['elect_voter_id'], $voter_prog_id[0]['prog_id']);
						}
					}
				}

					$page_view_content["page_view_dir"] = "ballot/successful_vote";
					$page_view_content["student_id"] = $student_id;
					$page_view_content["election_countdown"] = $election_countdown;	
					$page_view_content["logged_in"] = TRUE;
					$this->load->view("includes/template",$page_view_content);
			}
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}
