<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

		
		$this->load->view("includes/header");
		$this->load->view("welcome_message");
		$this->load->view("includes/footer");
	}
}
