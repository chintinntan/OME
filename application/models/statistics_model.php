<?php
	class Statistics_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	     public function get_exams($acct_id)
	    {
	    	$sql = "CALL get_exams('".$acct_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }
	}
?>