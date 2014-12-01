<?php
    class Registration extends CI_Controller
    {
        
        function __construct()
		{
			parent::__construct();
			$this->load->library('pdf');
			$this->pdf->fontpath = 'font/'; 	
		}


        public function index()
        {
            $this->load->model('registration_model');
	    	$course['course'] = $this->registration_model->select_course();
	    
		    for ($x=0;$x<count($course['course']);$x++)
		    {
				$selectedCourse[$course['course'][$x]->course_id] = $course['course'][$x]->course_name;
		    }

		    $course['course'] = $selectedCourse;
	        $this->load->helper('date');    
	        $this->load->view('includes/header');
		    $this->load->view('registration_form', $course);
		    $this->load->view('includes/footer');
		}
        		        
        public function login()
        {
            $this->load->view('includes/header');
		    $this->load->view('login_form');
		    $this->load->view('includes/footer');
		}
        
        
        public function validate_credentials()
		{
		    $this->load->model('registration_model');
		    $query = $this->registration_model->validate();
		    
		    if ($query) 
		    {
				$data = array('acct_username' => $this->input->post('acct_username'),
			    			  'is_logged_in' => TRUE);
				$this->session->set_userdata($data);
		        $this->load->view('includes/header');
	            $this->load->view('search_record');
	            $this->load->view('includes/footer');
		    }
		    else
		    {
				$this->login();
		    }
		}
        
        public function sign_up_successful()
		{	    
		    $this->load->view('includes/header');
		    $this->load->view('registration_successful');
		    $this->load->view('includes/footer');
		}
        
        public function create_member()
		{
	    	$this->load->model('registration_model');
	    	$validate_name = $this->registration_model->validate_name();
	    	$this->load->library('form_validation');
	    
		    $this->form_validation->set_rules('course_id', 'Course', 'required');
		    $this->form_validation->set_rules('acct_username', 'ID Number', 'trim|required|numeric|is_unique[account.acct_username]|min_length[7]|max_length[7]');
		    $this->form_validation->set_rules('acct_password', 'Password', 'trim|required||min_length[4]');
		    $this->form_validation->set_rules('acct_fname', 'First Name', 'trim|required|');
		    $this->form_validation->set_rules('acct_mname', 'Middle Name', 'trim|required|');
		    $this->form_validation->set_rules('acct_lname', 'Last Name', 'trim|required|');
		    $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_unique[account.email_address]');
	    
	    	if ($this->form_validation->run() == FALSE)
	    	{
				$this->index();
	    	}
	    	else
		    {
				if (!$validate_name)
				{
				    $this->load->model('registration_model');
				    if ($query = $this->registration_model->create_member())
				    {
				        $this->sign_up_successful();
				    }

				    else
				    {
						$this->index();    
				    }
				}
				else
				{
				    $this->load->view('includes/header');
				    $this->load->view('registration_failed');
				    $this->load->view('includes/footer');
				}
		    }
	
        }
        
        public function search_record()
        {
            $this->load->model('registration_model');
            $by_id= $this->registration_model->select_registered_voter_by_id();
	    	$by_lastname = $this->registration_model->select_registered_voter_by_lastname();
	    	
	    	if ($by_id)
		    {
				$record['searched_record'] = $this->registration_model->select_registered_voter_by_id();
				$_SESSION['message'] = 1;
				$this->load->view('includes/header');
				$this->load->view('search_record', $record);
				$this->load->view('includes/footer');
		    }
		    
		    else
		    {
				$record['searched_record'] = $this->registration_model->select_registered_voter_by_lastname();
				$_SESSION['message'] = 1;	
				$this->load->view('includes/header');
				$this->load->view('search_record_lastname', $record);
				$this->load->view('includes/footer');
		    }    
        }
        
        public function confirm_voter_registration()
		{
		    $this->load->model('registration_model');
		    $this->registration_model->confirm_voter_registration();
	        $record['searched_record'] = $this->registration_model->select_registered_voter_by_id();
		    $_SESSION['message'] = 1;
		    $this->load->view('includes/header');
            $this->load->view('search_record', $record);	            
            $this->load->view('includes/footer');
		}
	                
        public function generate_pdf()
		{
			$this->load->helper('date');
		    $this->load->model('registration_model');
	        $result['result'] = $this->registration_model->print_login_info();       

	        $this->load->view('includes/header');
		    $this->load->view('PDF_view', $result);
		    $this->load->view('includes/footer');
		}
	    
    }