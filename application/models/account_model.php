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
	}

?>