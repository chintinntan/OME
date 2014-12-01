<?php
	class Program_model extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model('mysql_database_model');
	    }

	    public function get_program_list()
	    {
	    	$sql = "CALL get_program_list()";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	    public function get_course_list($program_id)
	    {
	    	$sql = "CALL get_course_list(".$program_id.")";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	 }
?>