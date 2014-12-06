<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
public function __construct(){
		parent::__construct();
		//$this->logged_in();
		
		
	}
	public function index()
	{

		/*
		$this->load->view("includes/header");
		$this->load->view("welcome_message");
		$this->load->view("includes/footer");
		
		tor kana sya ang final code. icheck ang template akong gi dungagan
		gi check niya kung naka logged in ba. kung true kya i load niya ang nav
		*/

		$page_view_content["view_dir"] = "welcome_message";
		$page_view_content["is_logged_in"] = FALSE;
		$this->load->view("includes/template",$page_view_content);
	}
	public function validation(){

		$page_view_content["view_dir"] = "accounts/create";		
		$this->load->view("includes/template",$page_view_content);
	}
}
