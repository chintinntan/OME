<?php
	class Teacher_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function get_course_details()
	    {
	    	$sql = "CALL get_course_details()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	     public function get_section_details()
	    {
	    	$sql = "CALL get_section_details()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }
	}
?>