<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidacy extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->view('candidacy/candidacy_application_form');
	}

	public function select_position()
	{
		echo 'Please select desired position.<br>';

		$division = $this->input->post('division');
		//echo $division.'<br>';

		$this->load->model('position_model');
		$position['list'] = $this->position_model->get_list_of_position($division);
		
		$this->load->helper('form');
		$this->load->view('candidacy/position_list_form',$position);

	}

	public function update_position()
	{
		if($this->session->userdata('logged_in'))
		{	
			$elect_cand_id = $this->input->post('elect_cand_id');
			$pos_id = $this->input->post('position');

			if($pos_id)
			{
				$this->load->model('position_model');
				$this->position_model->update_candidate_position($pos_id, $elect_cand_id);
			}
			redirect('/ssg_applicant_list','refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */