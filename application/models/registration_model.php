<?php
    class Registration_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('mysql_database_model');
        }
        
        public function select_course()
        {
            $query = $this->db->query("SELECT course_id, course_name FROM course ORDER BY course_name");
            if($query->num_rows != 0)
            {
                $course = $query->result();  
            }
            return $course;
        }
        
        public function select_registered_voter_by_id()
        {
            $id = $this->input->get('id');
            $searched_record = $this->input->post('searched_record');
            
            $query = $this->db->query("SELECT a.acct_id, a.acct_username, a.acct_password, a.acct_fname, a.acct_mname, a.acct_lname,
                a.email_address, (SELECT course_name FROM course WHERE course_id = a.course_id) as course_id, a.acct_status,
                a.reg_status, a.time_date_log, (SELECT acct_type_name FROM account_type WHERE acct_type_id = a.acct_type_id) as
                acct_type_id FROM account a WHERE a.acct_username LIKE '".$searched_record."'  OR a.acct_id LIKE '".$id."'
                ORDER BY a.acct_username");
            if($query->num_rows() != 0)
            {
                $registered_voter = $query->result();
                return $registered_voter;
            }
        }
        
        public function select_registered_voter_by_lastname()
        {
            $id = $this->input->get('id');
            $searched_record = $this->input->post('searched_record');
            
            $query = $this->db->query("SELECT a.acct_id, a.acct_username, a.acct_password, a.acct_fname, a.acct_mname, a.acct_lname,
                a.email_address, (SELECT course_name FROM course WHERE course_id = a.course_id) as course_id, a.acct_status,
                a.reg_status, a.time_date_log, (SELECT acct_type_name FROM account_type WHERE acct_type_id = a.acct_type_id) as
                acct_type_id FROM account a WHERE a.acct_id LIKE '".$id."' OR a.acct_lname LIKE '".$searched_record."'
                ORDER BY a.acct_lname");
            if($query->num_rows() != 0)
            {
                $registered_voter = $query->result();
                return $registered_voter;
            }
        }
        
        public function create_member()
        {
            $timezone = 'Asia/Manila';
            date_default_timezone_set($timezone);       //A PHP function used in overiding default timezone from the PHP.ini 
                                                        //List of PHP supported timezone is found from this link
                                                        //Url: http://www.php.net/manual/en/timezones.php
            
            $new_member_insert_data = array(
              'course_id' => $this->input->post('course_id'),
              'acct_username' => $this->input->post('acct_username'),
              'acct_password' => $this->input->post('acct_password'),
              'acct_fname' => $this->input->post('acct_fname'),
              'acct_mname' => $this->input->post('acct_mname'),
              'acct_lname' => $this->input->post('acct_lname'),
              'email_address' => $this->input->post('email_address'),
              'acct_type_id' => 1,
              'time_date_log' => date("Y-m-d H:i:s", time()));
            
            $insert = $this->db->insert('account', $new_member_insert_data);
            return $insert;
        }
        
        public function validate()
        {
            $this->db->where('acct_username', $this->input->post('acct_username'));
            $this->db->where('acct_password', $this->input->post('acct_password'));
            
            $query = $this->db->get('account_admin');
            
            if($query->num_rows == 1)
            {
                return true;
            }
        }
        
        public function validate_name()
        {
            $this->db->where('acct_fname', $this->input->post('acct_fname'));
            $this->db->where('acct_mname', $this->input->post('acct_mname'));
            $this->db->where('acct_lname', $this->input->post('acct_lname'));
            
            $query = $this->db->get('account');
            
            if($query->num_rows != 0)
            {
                $result = $query->result();
                return $result;
            }
        }
        
        public function confirm_voter_registration()
        {
            $id = $this->input->get('id');
            $data = array('reg_status' => 1);
            $this->db->where('acct_id', $id);
            $this->db->update('account', $data);
        }
        
        public function print_login_info()
        {
            $acct_id = $this->input->get('id');
            $query = $this->db->query("SELECT a.acct_username, a.acct_password, a.acct_fName, a.acct_mName, a.acct_lName,
                                      (SELECT course_name FROM course WHERE course_id = a.course_id) as course_id
                                       FROM account a WHERE a.acct_id='".$acct_id."'");
            
            if($query->num_rows == 1)
            {
                $result = $query->result();
                return $result;
            }
            
        }
    }
?>