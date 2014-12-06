<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
public function __construct(){
		parent::__construct();
		//$this->logged_in();
		
		
	}
	public function index()
	{

		
		$this->load->view("includes/header");
		$this->load->view("welcome_message");
		$this->load->view("includes/footer");
	}
	public function validation(){
		$page_view_content["view_dir"] = "admin/assign_module";
			
			$this->load->view("includes/template",$page_view_content);
	}
}
