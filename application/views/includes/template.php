<?php
	
	if($logged_in)
	{
		$data['title']='University of the Immaculate Conception';
	}
	else
	{
		$data['title']='Login';
	}
	$this->load->view('includes/header',$data);

	if(!isset($view_data))
	{
		$view_data = NULL;
	}
	
	if($logged_in)
	{
		if(!isset($acct_type))
		{
			$acct_type = NULL;
		}

		$acct_type = $this->session->userdata('acct_type');

		if($acct_type == 'ADMIN')
		{
			$this->load->view('includes/left_nav');	
		}
		else if($acct_type == 'TEACHER')
		{
			$this->load->view('includes/teacher_left_nav');		
		}
		else if($acct_type == 'STUDENT')
		{
			$this->load->view('includes/student_left_nav');	
		}
	}

	$this->load->view($view_dir, $view_data);	
	$this->load->view('includes/footer'); 

?>
