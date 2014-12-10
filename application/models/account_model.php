<?php
	class Account_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function add_new_account($acct_type, $id_num, $username, $password, $lname, $fname, $mname)
	    {
	    	$sql = "CALL add_new_account('".$acct_type."','".$id_num."','".$username."','".$password."','".$lname."','".$fname."','".$mname."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    } 

	    public function get_account_details()
	    {
	    	$sql = "CALL get_account_details()";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }

	     public function update_account($acct_id, $acct_type, $id_num, $username, $password, $lname, $fname, $mname, $acct_status)
	    {
	    	$sql = "CALL update_account('".$acct_id."','".$acct_type."','".$id_num."','".$username."','".$password."','".$lname."','".$fname."','".$mname."','".$acct_status."')";

			$sQuery = $this->db->query($sql);
			$this->db->close();
	    } 
	}
?>