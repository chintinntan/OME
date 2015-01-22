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

	    public function get_question_input($question_id)
	    {
	    	$sql = "CALL get_question_input('".$question_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function update_question($question_id, $grading_period, $questionnaire)
	    {
	    	$sql = "CALL update_question('".$question_id."','".$grading_period."','".$questionnaire."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function add_choice($question_id, $choice1, $radio)
	    {
	    	$sql = "CALL add_choice('".$question_id."','".$choice1."','".$radio."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_choices($question_id)
	    {
	    	$sql = "CALL get_choices('".$question_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_choice_details($choice_id)
	    {
	    	$sql = "CALL get_choice_details('".$choice_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function update_choice($choice_id, $new_choice)
	    {
	    	$sql = "CALL update_choice('".$choice_id."','".$new_choice."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function update_choice_with_check($choice_id, $new_choice, $check)
	    {
	    	$sql = "CALL update_choice_with_check('".$choice_id."','".$new_choice."','".$check."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_choice_with_check($question_id)
	    {
	    	$sql = "CALL get_choice_with_check('".$question_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array(1);
	    }

	    public function update_correct($choice_with_check)
	    {
	    	$sql = "CALL update_correct('".$choice_with_check."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_new_questions($grading_period_id)
	    {
	    	$sql = "CALL get_new_questions('".$grading_period_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }
	}
?>