<?php
	class Ballot_model extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model('mysql_database_model');
	    }

	    public function insert_vote($cand_id, $acct_id, $voter_prog_id)
	    {
	    	$sql = "CALL insert_vote(".$cand_id.",".$acct_id.",".$voter_prog_id.")";
	    	$sQuery = $this->db->query($sql);
	    	$this->db->close();

	    	return $sQuery->result_array();
	    }
	 }
?>