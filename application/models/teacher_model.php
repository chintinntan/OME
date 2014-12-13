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

	    public function get_subject_details()
	    {
	    	$sql = "CALL get_subject_details()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function get_teacher_list()
	    {
	    	$sql = "CALL get_teacher_list()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

		public function get_teacher_name($teacher_acct_id)
	    {
	    	$sql = "CALL get_teacher_name('".$teacher_acct_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    } 

	    public function get_class_record($teacher_acct_id)
	    {
	    	$sql = "CALL get_class_record('".$teacher_acct_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }
	    
	    public function get_course_name($course)
	    {
	    	$sql = "CALL get_course_name('".$course."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    } 

	     public function get_section_name($section)
	    {
	    	$sql = "CALL get_section_name('".$section."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    } 
	}
?>