<?php
	class MySQL_database_model extends CI_Model
	{

		function __construct()
	    {
	        parent::__construct();
				    	
	    	$config['hostname'] = "localhost";
			$config['username'] = "root";
			$config['password'] = "";
			$config['database'] = "election";
			$config['dbdriver'] = "mysql";
			$config['dbprefix'] = "";
			$config['pconnect'] = FALSE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = "";
			$config['char_set'] = "utf8";
			$config['dbcollat'] = "utf8_general_ci";

			$this->load->database($config);	
	    }
	}

?>