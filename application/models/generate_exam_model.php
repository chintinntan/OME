<?php
	class Generate_exam_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function create_exam($acct_id, $exam_date, $exam_title, $grading_period, $subject)
	    {
	    	$sql = "CALL create_exam('".$acct_id."','".$exam_date."','".$exam_title."','".$grading_period."','".$subject."')";
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

	    public function update_exam($exam_id, $exam_date, $exam_title, $grading_period, $subject)
	    {
	    	$sql = "CALL update_exam('".$exam_id."','".$exam_date."','".$exam_title."','".$grading_period."','".$subject."')";
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
	}
?>