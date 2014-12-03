<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

		$view_content["view_dir"] = "admin_home/admin_homepage";
		$this->load->view("includes/template",$view_content);
	}
}
