<?php 
	$this->load->view('includes/header');

	if(!isset($view_data))
	{
		$view_data = NULL;
	}

	if($logged_in)
	{
		$this->load->view('includes/left_nav');		
	}

	$this->load->view($view_dir, $view_data);	
	$this->load->view('includes/footer'); 

?>
