<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forms extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->pdf->fontpath = 'font/'; 	
	}

	public function index()
	{
		$this->load->view('forms/application_letter');	
	}

	public function coc_form()
	{
		$this->load->view('forms/certificate_of_candidacy');
	}	

	public function osad_certification()
	{
		$this->load->view('forms/osad_certification');
	}

	public function dean_certification()
	{
		$this->load->view('forms/dean_certification');	
	}
}
