<?php
	class Class_record_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function add_new_class($teacher_acct_id, $section, $course, $semester, $school_year, $subject_id)
	    {
	    	$sql = "CALL add_new_class('".$teacher_acct_id."','".$section."','".$course."', '".$semester."', '".$school_year."', '".$subject_id."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function add_new_student($course, $stud_acct_id, $year_lvl)
	    {
	    	$sql = "CALL add_new_student('".$course."','".$stud_acct_id."','".$year_lvl."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }
 		
 		public function update_stud_data($course, $stud_id, $year_lvl)
	    {
	    	$sql = "CALL update_stud_data('".$course."','".$stud_id."','".$year_lvl."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_assign_details($teacher_acct_id, $class_record_id)
	    {
	    	$sql = "CALL get_assign_details('".$teacher_acct_id."','".$class_record_id."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->result_array();
	    }

	    public function add_new_record($stud_id, $class_record_id)
	    {
	    	$sql = "CALL add_new_record('".$stud_id."','".$class_record_id."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_subject_class($class_record_id)
	    {
	    	$sql = "CALL get_subject_class('".$class_record_id."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->result_array();
	    }

	    public function remove_student($stud_id)
	    {
	    	$sql = "CALL remove_student('".$stud_id."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function register_student($stud_id, $class_record_id)
	    {
	    	$sql = "CALL register_student('".$stud_id."','".$class_record_id."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function select_stud_details($stud_id)
	    {
	    	$sql = "CALL select_stud_details('".$stud_id."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->result_array(1);
	    }
	}
?>