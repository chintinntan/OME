<?php
	class Position_model extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	       	$this->load->model('mysql_database_model');
	    }

		public function get_list_of_position($div_id)
		{
			$sql = 'CALL get_position_list('.$div_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function get_division()
		{
			$sql = 'CALL get_division()';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}

		public function update_candidate_position($pos_id, $elect_cand_id)
		{
			$sql = 'CALL update_candidate_position('.$pos_id.', '.$elect_cand_id.')';
			$sQuery = $this->db->query($sql);
			$this->db->close();
				
			return $sQuery->result_array();
		}
	}

?>