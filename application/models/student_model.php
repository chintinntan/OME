<?php
	class Student_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function get_student_details()
	    {
	    	$sql = "CALL get_student_details()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function get_student_name($stud_acct_id)
	    {
	    	$sql = "CALL get_student_name('".$stud_acct_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	     public function get_student_list()
	    {
	    	$sql = "CALL get_student_list()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function get_stud_update_data($stud_id)
	    {
	    	$sql = "CALL get_stud_update_data('".$stud_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function get_exam_list()
	    {
	    	$sql = "CALL get_exam_list()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function check_exam_password($exam_pass)
	    {
	    	$sql = "CALL check_exam_password('".$exam_pass."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);	
	    }

	    public function submit_exam_answers($stud_id, $exam_sched_id, $answer_id)
	    {
	    	$sql = "CALL submit_exam_answers('".$stud_id."','".$exam_sched_id."','".$answer_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();	
	    }

	    public function check_student_exam($stud_id, $exam_sched_id)
	    {
	    	$sql = "CALL check_student_exam('".$stud_id."','".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->result_array(1);	
	    }
	}
?>