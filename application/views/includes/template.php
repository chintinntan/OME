<?php 
	$this->load->view('includes/header');

	if(!isset($view_data))
	{
		$view_data = NULL;
	}

	if($is_logged_in == TRUE)
	{
		$this->load->view('includes/left_nav');		
	}

	$this->load->view($view_dir, $view_data);	
	$this->load->view('includes/footer'); 

?>
