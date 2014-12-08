<?php
	class Login_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
			$this->load->model('mysql_database_model');

	    }

	    public function check_user_login($username, $userpass)
	    {
	    	$sql = "CALL check_login_details('".$username."','".$userpass."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->row_array(1);	
	    }

	    public function get_acct_type($username, $userpass)
	    {
	    	$sql = "CALL get_acct_type('".$username."','".$userpass."')";
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();	
	    }
	}

?>