<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
public function __construct(){
		parent::__construct();
		//$this->logged_in();
		
		
	}
	public function index()
	{
		$page_view_content["view_dir"] = "welcome_message";
		/*$page_view_content["is_logged_in"] = FALSE;*/
		$this->load->view("includes/template",$page_view_content);
	}
	public function validation(){

		$page_view_content["view_dir"] = "accounts/create";
			
			$this->load->view("includes/template",$page_view_content);
/*<<<<<<< HEAD======

		$page_view_content["view_dir"] = "accounts/create";		
		$this->load->view("includes/template",$page_view_content);
>>>>>>> fc864dc044eabd8291272b5bc0dff79f0d879259*/
	}
}
