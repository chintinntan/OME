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

	     public function get_class_record_list($subj_id, $sec_id)
	    {
	    	$sql = "CALL get_class_record_list('".$subj_id."','".$sec_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_period()
	    {
	    	$sql = "CALL get_period()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	     public function total_students_who_take_exam($exam_sched_id)
	    {
	    	$sql = "CALL total_students_who_take_exam('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    } 

	    public function count_number_of_questions($exam_sched_id)
	    {
	    	$sql = "CALL count_number_of_questions('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function students_correct_answer($exam_sched_id)
	    {
	    	$sql = "CALL students_correct_answer('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_total_correct_answer($exam_sched_id)
	    {
	    	$sql = "CALL get_total_correct_answer('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_all_total_correct_answer($exam_sched_id)
	    {
	    	$sql = "CALL get_all_total_correct_answer('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function select_test()
	    {
	    	$sql = "CALL select_test()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }
	}
?>