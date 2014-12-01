<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Router extends CI_Controller {
	
	public function index()
	{

		
		if($this->session->userdata('logged_in'))
		{
			redirect('/home', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');	
		}		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */