<?php
    class election extends CI_Controller
    {

        /**
         * 
         * Created by Chin Tinn Tan
         * Date 2013/10/20
         *
         */

        /*----------------------------------------LOGIN------------------------------------------*/
        public function index()
        {
            $this->load->view('includes/header');
	    $this->load->view('election_login');
	    $this->load->view('includes/footer');
	}
        
        public function validate_credentials()
	{
	    $this->load->model('election_model');
	    $query = $this->election_model->validate();
	    
	    if($query) // if result is true
	    {
		$data = array(
		    'acct_username' => $this->input->post('acct_username'),
		    'is_logged_in' => TRUE
		);
		$this->session->set_userdata($data);
                // loads account info
                $this->load->model('election_model');
                $account['account'] = $this->election_model->select_account();
                $_SESSION['message'] = 1;
                
                $this->load->view('includes/header');
                $this->load->view('admin_view', $account);
                $this->load->view('includes/footer');
	    }
	    else
	    {
		$this->index();
	    }
	}
        
        /*-------------------------------SET AND ACTIVATE ELECTION----------------------------------*/
        public function set_election()
        {
            $this->load->model('election_model');
            $sy_list['school_year'] = $this->election_model->select_sy();
            
            $this->load->view('includes/header');
            $this->load->view('set_election', $sy_list);
            $this->load->view('includes/footer');
        }
        
        public function activate_election()
        {
            $this->load->model('election_model');
            $sy_list['school_year'] = $this->election_model->activate_election();
            
            $this->set_election();
        }
        /*----------------------------------ADD SCHOOL YEAR AND PARTY---------------------------------*/
        public function add_sy()
        {
            $this->load->model('election_model');
            $this->election_model->add_sy();
            
            $this->set_election();
        }
        
        public function set_party()
        {
            $this->load->model('election_model');
            $party_list['party'] = $this->election_model->select_party();
            
            $this->load->view('includes/header');
            $this->load->view('foc', $party_list);
            $this->load->view('includes/footer');
        }
        
        public function add_party()
        {
            $this->load->model('election_model');
            $this->election_model->add_party();
            
            $this->set_party();
        }
        
        public function election_schedule()
        {
            $this->load->view('includes/header');
            $this->load->view('election_schedule');
            $this->load->view('includes/footer');
        }
        /*---------------------------------------SEARCH RECORD---------------------------------*/
        public function search_record()
        {
            $this->load->model('election_model');
            $by_id= $this->election_model->select_registered_voter_by_id();
	    $by_lastname = $this->election_model->select_registered_voter_by_lastname();
	    if($by_id)
	    {
		$record['searched_record'] = $this->election_model->select_registered_voter_by_id();
		$_SESSION['message'] = 1;
		
		$this->load->view('includes/header');
		$this->load->view('admin_search_record', $record);
		$this->load->view('includes/footer');
	    }
	    else
	    {
		$record['searched_record'] = $this->election_model->select_registered_voter_by_lastname();
		$_SESSION['message'] = 1;
		
		$this->load->view('includes/header');
		$this->load->view('admin_search_lastname', $record);
		$this->load->view('includes/footer');
	    }
        }
    }