<?php
	class Election_model extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model('mysql_database_model');
	    }

	    public function get_election()
	    {
	    	$sql = 'CALL get_election()';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	    public function add_election($school_year, $start_date, $end_date)
	    {
	    	$sql = "CALL add_election('".$school_year."','".$start_date."','".$end_date."')";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }

	    public function check_duplicate($school_year)
	    {
	    	$sql = "CALL check_duplicate_election('".$school_year."')";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close(1);
	    }

	    public function activate_election($elect_id)
	    {
	    	$sql = 'CALL activate_election('.$elect_id.')';
			$this->db->query($sql);
			$this->db->close();
	    }

	    public function set_status_to_zero()
	    {
	    	$sql = 'CALL update_elect_status()';
			$this->db->query($sql);
			$this->db->close();
	    }

	    public function set_elect_sched_status_to_zero()
	    {
	    	$sql = 'CALL update_elect_sched_status()';
			$this->db->query($sql);
			$this->db->close();
	    }

	    public function activate_elect_sched($elect_id)
	    {
			$sql = 'CALL activate_election_schedule('.$elect_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }

	    public function delete_election($elect_id)
	    {
	    	$sql = 'CALL delete_election('.$elect_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }

	    public function get_election_data($elect_id)
	    {
	    	$sql = 'CALL get_election_data('.$elect_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array(1);
	    }

	    public function update_election_sched($school_year, $start_date, $end_date, $elect_id)
	    {
	    	$sql = "CALL update_election_sched('".$school_year."','".$start_date."','".$end_date."','".$elect_id."')";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }

	    public function get_election_schedule()
	    {
	    	$sql = 'CALL get_election_schedule()';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	     public function activate_election_schedule($elect_id)
	    {
	    	$sql = 'CALL activate_election_schedule('.$elect_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }
	 }
?>