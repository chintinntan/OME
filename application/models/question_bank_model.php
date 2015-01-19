<?php
	class Question_bank_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	     public function get_teacher_subjects($acct_id)
	    {
	    	$sql = "CALL get_teacher_subjects('".$acct_id."')";
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

	    public function add_question($subj_id, $grading_period, $questionnaire)
	    {
	    	$sql = "CALL add_question('".$subj_id."','".$grading_period."','".$questionnaire."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_questions($subj_id)
	    {
	    	$sql = "CALL get_questions('".$subj_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }
	}
?>