<?php
	class Generate_exam_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function create_exam($acct_id, $exam_date, $exam_title, $grading_period, $subject, $pass)
	    {
	    	$sql = "CALL create_exam('".$acct_id."','".$exam_date."','".$exam_title."','".$grading_period."','".$subject."','".$pass."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	     public function get_exam_schedule($acct_id)
	    {
	    	$sql = "CALL get_exam_schedule('".$acct_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_exam_title_date($exam_id)
	    {
	    	$sql = "CALL get_exam_title_date('".$exam_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function update_exam($exam_id, $exam_date, $exam_title, $grading_period, $subject, $pass)
	    {
	    	$sql = "CALL update_exam('".$exam_id."','".$exam_date."','".$exam_title."','".$grading_period."','".$subject."','".$pass."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function get_exam_details($exam_id)
	    {
	    	$sql = "CALL get_exam_details('".$exam_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function get_exam_questions($subj_id, $period_id, $hard_items, $easy_items)
	    {
	    	$sql = "CALL get_exam_questions('".$subj_id."','".$period_id."','".$hard_items."','".$easy_items."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function create_exam_questionnaire($acct_id, $exam_date, $exam_title, $grading_period, $subject)
	    {
	    	$sql = "CALL create_exam('".$acct_id."','".$exam_date."','".$exam_title."','".$grading_period."','".$subject."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function submit_exam_details($exam_id, $question_id, $subj_id)
	    {
	    	$sql = "CALL submit_exam_details('".$exam_id."','".$question_id."','".$subj_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	    public function get_questions_from_exam($exam_id)
	    {
	    	$sql = "CALL get_questions_from_exam('".$exam_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function check_dup_id($quest_id, $exam_id)
	    {
	    	$sql = "CALL check_dup_id('".$quest_id."','".$exam_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function get_view_exam_details($exam_id)
	    {
	    	$sql = "CALL get_view_exam_details('".$exam_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function get_view_exam_questionnaire($exam_id)
	    {
	    	$sql = "CALL get_view_exam_questionnaire('".$exam_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_view_exam_answers()
	    {
	    	$sql = "CALL get_view_exam_answers()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }
	}
?>