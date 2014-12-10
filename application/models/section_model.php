<?php
	class Section_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function add_new_section($section_acronym)
	    {
	    	$sql = "CALL add_new_section('".$section_acronym."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }

	    public function get_section_data()
	    {
	    	$sql = "CALL get_section_data()";
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->result_array();	
	    }

	    public function get_sec_update_data($section_id)
	    {
	    	$sql = "CALL get_sec_update_data('".$section_id."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();

			return $sQuery->result_array();	
	    }

	    public function update_section($section_id, $sec_name)
	    {
	    	$sql = "CALL update_section('".$section_id."', '".$sec_name."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
	    }
	}
?>