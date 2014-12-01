<?php
	class Chairman_model extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model('mysql_database_model');
	    }

	    public function get_ssg_applicants()
	    {
	    	$sql = 'CALL get_ssg_applicants()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function update_ssg_applicant_status($candidate_id, $new_status)
	    {
	    	$sql = 'CALL update_ssg_applicant_status('.$candidate_id.','.$new_status.')';
			$this->db->query($sql);
			$this->db->close();
	    }

	    public function get_ssg_applicants_by_status($status)
	    {
	    	$sql = 'CALL get_ssg_applicants_by_status('.$status.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
	    }

	    public function get_ssg_applicants_without_party()
	    {
	    	$sql = 'CALL get_ssg_applicants_without_party()';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	    public function get_ssg_applicant_name_position($candidate_id)
	    {
	    	$sql = 'CALL get_ssg_applicant_name_position('.$candidate_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	    public function search_commissioner_acct_id($student_id)
	    {
	    	$sql = 'CALL search_commissioner_acct_id('.$student_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array(1);
	    }

	    public function add_new_commissioner($commissioner_acct_id)
	    {
	    	$sql = "CALL add_new_commissioner('".$commissioner_acct_id."')";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }

	    public function get_commissioner()
	    {
	    	$sql = 'CALL get_commissioner()';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	    public function delete_commissioner($acct_id)
	    {
	    	$sql = 'CALL delete_commissioner('.$acct_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }

	    public function get_chairman()
	    {
	    	$sql = 'CALL get_chairman()';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }

	    public function set_as_chairman($acct_id)
	    {
	    	$sql = 'CALL update_acct_type_id('.$acct_id.')';
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();
	    }
	 }
?>