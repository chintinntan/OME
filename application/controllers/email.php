<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}

	public function index()
	{	
		if($this->session->userdata('logged_in'))
		{
			redirect('/home', 'refresh');
		}
		else
		{
			$page_view_content['access_is_invalid'] = $this->session->flashdata('access_is_invalid');
			$page_view_content["page_view_dir"] = "reset_password/email_sender";
			$page_view_content["logged_in"] = FALSE;
			$this->load->view("includes/template",$page_view_content);
		}
	}

	public function send_email()
	{	
		$id_number = $this->input->post('username');
		$email_address = $this->input->post('email');
		$this->load->model('voter_model');
		$info = $this->voter_model->get_account_email($id_number, $email_address);
		

		if($info)
		{
			$password = $info['password'];
			$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => '465',
			'smtp_user' => 'uiccea@gmail.com',
			'smtp_pass' => 'uicelection2013',
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('uiccea@gmail.com', 'UIC COMELEC');
			$this->email->to($info['email_address']);

			$this->email->subject('Forgot Password');
			$this->email->message('Account username '.$id_number.' account password '.$password);

			if($this->email->send())
			{
				$page_view_content["page_view_dir"] = "reset_password/email_sent";
				$page_view_content["logged_in"] = FALSE;
				$this->load->view("includes/template",$page_view_content);
			}
			else
			{
				show_error($this->email->print_debugger());
			}
		}
		else
		{
			redirect('/email', 'refresh');
		}
	}
}
