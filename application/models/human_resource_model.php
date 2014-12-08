<?php
	class Human_resource_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function get_dropdown_acct_type()
	    {
	    	$sql = "CALL get_dropdown_acct_type()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }
	}

?>