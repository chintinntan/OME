<?php
	class Candidate_model extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model('mysql_database_model');
	    }

		public function check_existing_candidacy($account_id)
		{
			$sql = 'SELECT pos_id,pos_name,order_no FROM position 
					WHERE div_id ='. $division .' ORDER BY order_no ASC';
			
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function check_voter_registration($acct_id)
		{
			$sql = 'CALL check_voter_registration('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);
		}

		public function check_candidacy_application($acct_id)
		{
			$sql = 'CALL check_candidacy_application('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);	
		}

		public function get_ssg_candidate_list()
		{
			$sql = 'CALL get_ssg_candidate_list()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_program_candidate_list($program_id)
		{
			$sql = 'CALL get_program_candidate_list('.$program_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_position_list($div_id)
		{
			$sql = 'CALL get_position_list('.$div_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_current_election()
		{
			$sql = 'CALL get_current_election()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);
		}

		public function add_candidacy_application($acct_id,$pos_id)
		{
			$current_election= $this->get_current_election();

			$sql = 'CALL add_candidacy_application('.$acct_id.','.$pos_id.','.$current_election['elect_id'].')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
		}

		public function delete_candidate($elect_cand_id)
		{
			$sql = 'CALL delete_candidate('.$elect_cand_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
		}
	}

?>