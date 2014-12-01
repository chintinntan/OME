<?php 
	$this->load->view('includes/header');

	if(!isset($page_view_data))
	{
		$page_view_data = NULL;
	}

	if($logged_in)
	{
		$this->load->view('includes/nav',$is_election_officer);		
	}
	
	$this->load->view($page_view_dir, $page_view_data);	
	$this->load->view('includes/footer'); 
?>
