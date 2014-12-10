<?php
	class Class_record_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function add_new_class($teacher_acct_id, $section, $course)
	    {
	    	$sql = "CALL add_new_class('".$teacher_acct_id."','".$section."','".$course."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    } 
	}
?>