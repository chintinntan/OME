<?php
	class Timer_model extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model('mysql_database_model');
	    }

	    public function get_election_countdown()
	    {
	    	$sql = "CALL get_election_countdown()";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->row_array(1);
	    }
	 }
?>