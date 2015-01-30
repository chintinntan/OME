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

	    public function update_questionnaire_difficulty($total_q, $ques_id)
	    {
	    	$sql = "CALL update_questionnaire_difficulty('".$total_q."','".$ques_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function update_kr($kr, $exam_sched_id)
	    {
	    	$sql = "CALL update_kr('".$kr."','".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_total_correct_of_question($exam_sched_id)
	    {
	    	$sql = "CALL get_total_correct_of_question('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_quest_id($exam_sched_id)
	    {
	    	$sql = "CALL get_quest_id('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function check_statistic($exam_sched_id)
	    {
	    	$sql = "CALL check_statistic('".$exam_sched_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }
	}
?>