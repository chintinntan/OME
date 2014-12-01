<?php
	class Election_officer_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
	    	$this->load->model('mysql_database_model');
	    }

	    public function check_if_election_officer($acct_id)
	    {	
	    	$sql = 'CALL check_if_election_officer('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);
	    }

	    public function check_if_admin($acct_id)
	    {
			$sql = 'CALL check_if_admin('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);
	    }

	    public function check_if_commissioner($acct_id)
	    {
	    	$sql = 'CALL check_if_commissioner('.$acct_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);
	    }

	    public function add_admin_to_election_voter($account_id)
	    {
	    	$sql = 'CALL add_admin_to_election_voter('.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
	    }

	    public function add_admin_to_elect_officer($account_id)
	    {
	    	$sql = 'CALL add_admin_to_elect_officer('.$account_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->row_array(1);
	    }
	}

?>