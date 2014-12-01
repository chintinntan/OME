<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_candidacy_form extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->load->helper('file');
			$this->load->helper('download');

			$data = file_get_contents("../ems/downloads/Application_Letter.docx");
			$file_name = "Application_Letter.docx";

			force_download($file_name, $data);\

			redirect('/apply_candidacy', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}	
	}

	public function download_coc()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->load->helper('file');
			$this->load->helper('download');

			$data = file_get_contents("../ems/downloads/FRM_CertOfCandidacy2013.docx");
			$file_name = "CertificateOfCandidacy.docx";

			force_download($file_name, $data);\

			redirect('/apply_candidacy', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function download_osad_cert()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->load->helper('file');
			$this->load->helper('download');

			$data = file_get_contents("../ems/downloads/FRM_goodMoralC_OSAD2013.docx");
			$file_name = "OSADCertification.docx";

			force_download($file_name, $data);\

			redirect('/apply_candidacy', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function download_dean_cert()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->load->helper('file');
			$this->load->helper('download');

			$data = file_get_contents("../ems/downloads/FRM_goodMoralC_Dean2013.docx");
			$file_name = "DeanCertification.docx";

			force_download($file_name, $data);\

			redirect('/apply_candidacy', 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}	
}
