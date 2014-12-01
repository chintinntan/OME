<?php
	class Voter_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function check_voter_login($username, $userpass)
	    {
	    	$sql = "CALL check_login_details('".$username."','".$userpass."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);	
	    }

		public function get_voter_statistics()
		{
			$sql = 'CALL course_voters_statistics()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_population()
		{
			$sql = 'CALL population()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_voters()
		{
			$sql = 'CALL voters()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_program_statistics()
		{
			$sql = 'CALL voter_statistics_per_program()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_voter_prog_id($acct_id)
		{
			$sql = 'CALL get_voter_prog_id('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_election_voter_id($acct_id)
		{
			$sql = 'CALL get_election_voter_id('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function check_voter_if_voted($acct_id)
		{
			$sql = 'CALL check_voter_if_voted('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_voted_candidates_by_voter($acct_id)
		{
			$sql = 'CALL get_voted_candidates_by_voter('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function add_account($account)
		{
			$sql = "CALL add_account('".$account['username']."',
									 '".$account['password']."',
									 '".$account['lastname']."',
									 '".$account['firstname']."',
									 '".$account['middlename']."',
									 '".$account['email_address']."',
									 ".$account['course_id'].')';

			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_account_profile($student_id)
		{
			$sql = 'CALL get_account_profile('.$student_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);
		}

		public function add_election_voter($account_id)
		{
			$sql = 'CALL add_election_voter('.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}

		public function delete_election_voter($account_id)
		{
			$sql = 'CALL delete_election_voter('.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}

		public function get_account_username($account_id)
		{
			$sql = "CALL get_account_username('".$account_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}

		public function insert_logs($logs)
		{
			$sql = 'CALL insert_logs("'.$logs['session_id'].'",
									 "'.$logs['ip_address'].'",
									 "'.$logs['user_agent'].'",
									 "'.$logs['last_activity'].'",
									 "'.$logs['acct_id'].'"
					)';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
		}

		public function update_time_logout($session_id)
		{
			$sql = 'CALL update_time_logout("'.$session_id.'")';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function reset_password($account_id)
		{
			$sql = 'CALL reset_password('.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}

		public function get_account_email($id_number, $email)
		{
			$sql = 'CALL get_account_email("'.$id_number.'","'.$email.'")';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}

		public function reset_vote($account_id)
		{
			$sql = 'CALL reset_vote('.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}

		public function update_acct_password($new_password, $account_id)
		{
			$sql = 'CALL update_acct_password('.$new_password.','.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}

		public function get_pdf_details($account_id)
		{
			$sql = 'CALL get_pdf_print_details('.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
		}
	}

?>