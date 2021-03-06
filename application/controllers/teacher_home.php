<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher_home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	private function validate_input()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', '<b>PASSWORD</b>', 'trim|matches[con_password]|min_length[5]');
	}

	public function index()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{	
			$id_number 	= $this->session->userdata('acct_id_number');
			$acct_lname = $this->session->userdata('acct_lname');
			$acct_fname = $this->session->userdata('acct_fname');
			$acct_mname = $this->session->userdata('acct_mname');
			$username 	= $this->session->userdata('username');
			$acct_type  = $this->session->userdata('acct_type');

			$page_view_content["view_dir"] = "home_page";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["id_num"] = $id_number;
			$page_view_content["acct_lname"] = $acct_lname;
			$page_view_content["acct_fname"] = $acct_fname;
			$page_view_content["acct_mname"] = $acct_mname;
			$page_view_content["username"] = $username;
			$page_view_content["acct_type"] = $acct_type;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function teacher_assign()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$this->load->model('teacher_model');
	 		$teacher_list = $this->teacher_model->get_teacher_list();

	 		$page_view_content["view_dir"] = "admin/teacher_assign";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["teacher_list"] = $teacher_list;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function create_teacher_assign()
	{
	 	if($session_login = $this->session->userdata('logged_in'))
	 	{
	 		$teacher_acct_id =  $this->uri->segment(3, 0);
	 		$this->load->model('teacher_model');
			$course = $this->teacher_model->get_course_details();
			$section = $this->teacher_model->get_section_details();
			$subject = $this->teacher_model->get_subject_details();

	 		$page_view_content["view_dir"] = "admin/assign_course_section";
	 		$page_view_content["logged_in"] = $session_login;
	 		$page_view_content["course"] = $course;
	 		$page_view_content["section"] = $section;
	 		$page_view_content["subject"] = $subject;
	 		$page_view_content["teacher_acct_id"] = $teacher_acct_id;
	 		$this->load->view("includes/template",$page_view_content);
	 	}
	 	else
	 	{
	 		redirect('/login', 'refresh');
	 	}
	}

	public function view_student_list()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$this->load->model('teacher_model');
			$subjects = $this->teacher_model->get_subject_details();
			$sections = $this->teacher_model->get_section_details();

			$page_view_content["view_dir"] = "teacher/student_list";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["dropdown_subject"] = $subjects;
			$page_view_content["dropdown_section"] = $sections;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function search_class_student()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subject_selected = $this->input->post('subject_selected');
			$section_selected = $this->input->post('section_selected');

			$this->load->model('teacher_model');
			$class_record_list = $this->teacher_model->get_class_record_list($subject_selected, $section_selected);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "teacher/class_student";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["class_record_list"] = $class_record_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function generate_exam_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('generate_exam_model');
			$exam_sched_details = $this->generate_exam_model->get_exam_schedule($acct_id);

			$page_view_content["view_dir"] = "teacher/generate_exam";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["exam_sched_details"] = $exam_sched_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function exam_create_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id = $this->session->userdata('acct_id');
			$this->load->model('teacher_model');
			$subjects = $this->teacher_model->get_teach_subject_details($acct_id);
			$grading_period = $this->teacher_model->get_period();

			$page_view_content["view_dir"] = "exam/create";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["dropdown_subjects"] = $subjects;
			$page_view_content["dropdown_period"] = $grading_period;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function create_exam()
	{

		$this->validate_input();

		if($this->form_validation->run())
		{

			if($session_login = $this->session->userdata('logged_in'))
			{
				$acct_id  = $this->session->userdata('acct_id');

				$exam_title = $this->input->post('exam_title');
				$exam_date = $this->input->post('date');
				$subject = $this->input->post('selected_subjects');
				$grading_period = $this->input->post('selected_grading_period');
				$pass = $this->input->post('password');

				$this->load->model('generate_exam_model');
				$subjects = $this->generate_exam_model->create_exam($acct_id, $exam_date, $exam_title, $grading_period, $subject, $pass);

				redirect("teacher_home/generate_exam_page",'refresh');
			}
			else
			{
				redirect('/login', 'refresh');
			}
		}
	}

	public function exam_update_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_id = $this->uri->segment(3, 0);
			$this->load->model('teacher_model');
			$subjects = $this->teacher_model->get_subject_details();
			$grading_period = $this->teacher_model->get_period();
			$this->load->model('generate_exam_model');
			$exam_title_date = $this->generate_exam_model->get_exam_title_date($exam_id);

			$page_view_content["view_dir"] = "exam/update";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["dropdown_subjects"] = $subjects;
			$page_view_content["dropdown_period"] = $grading_period;
			$page_view_content["exam_title_date"] = $exam_title_date;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function update_exam()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_id  = $this->uri->segment(3, 0);

			$exam_title = $this->input->post('exam_title');
			$exam_date = $this->input->post('date');
			$subject = $this->input->post('selected_subjects');
			$grading_period = $this->input->post('selected_grading_period');
			$pass = $this->input->post('password');
			$this->load->model('generate_exam_model');
			$subjects = $this->generate_exam_model->update_exam($exam_id, $exam_date, $exam_title, $grading_period, $subject,$pass);

			redirect("/teacher_home/generate_exam_page",'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function generate_exam_questionnaire_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_id = $this->uri->segment(3, 0);

			$this->load->model('generate_exam_model');
			$exam_details = $this->generate_exam_model->get_exam_details($exam_id);

			$page_view_content["view_dir"] = "generate_exam/set_generate_question";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["exam_details"] = $exam_details;
			$page_view_content["exam_id"] = $exam_id;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function all_generate_questionnaire_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_id = $this->uri->segment(3, 0);
			$subj_id = $this->uri->segment(4, 0);
			$grading_period_id = $this->uri->segment(5, 0);
			$very_hard_items = $this->input->post('item_qty_very_hard');
			$hard_items = $this->input->post('item_qty_hard');
			$optimum_items = $this->input->post('item_qty_optimum');
			$easy_items = $this->input->post('item_qty_easy');
			$very_easy_items = $this->input->post('item_qty_very_easy');
			
			if($this->uri->segment(6, 0) == NULL)
			{
				$total_no_of_items = $this->input->post('item_total_qty');
			}
			else
			{
				$total_no_of_items = $this->uri->segment(6, 0);
			}
			
			$this->load->model('generate_exam_model');
			$exam_details = $this->generate_exam_model->get_exam_details($exam_id);
			$period_id = $exam_details[0]['grading_period_id'];
			$exam_questions = $this->generate_exam_model->get_exam_questions($subj_id, $period_id, $very_hard_items, $hard_items,$optimum_items,$easy_items,$very_easy_items);

			if($exam_questions != NULL)
			{
				$page_view_content["view_dir"] = "generate_exam/all_generate_question";
				$page_view_content["logged_in"] = $session_login;
				$page_view_content["exam_id"] = $exam_id;
				$page_view_content["subj_id"] = $subj_id;
				$page_view_content["total_no_of_items"] = $total_no_of_items;
				$page_view_content["grading_period_id"] = $grading_period_id;
				$page_view_content["exam_details"] = $exam_details;
				$page_view_content["very_hard_items"] = $very_hard_items;
				$page_view_content["hard_items"] = $hard_items;
				$page_view_content["optimum_items"] = $optimum_items;
				$page_view_content["easy_items"] = $easy_items;
				$page_view_content["very_easy_items"] = $very_easy_items;
				$page_view_content["exam_questions"] = $exam_questions;
				$this->load->view("includes/template",$page_view_content);
			}
			else
			{
				redirect("/teacher_home/submit_exam_details/".$exam_id."/".$subj_id."/".$total_no_of_items."/".$grading_period_id."/".$hard_items."/".$easy_items."",'refresh');
			}
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function submit_exam_details()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$this->load->helper('string');

			$exam_id = $this->uri->segment(3, 0);
			$subj_id = $this->uri->segment(4, 0);
			$total_no_of_items = $this->uri->segment(5, 0);
			$grading_period_id = $this->uri->segment(6, 0);
			$very_hard_items = $this->uri->segment(7, 0);
			$hard_items = $this->uri->segment(8, 0);
			$optimum_items = $this->uri->segment(9,0);
			$easy_items = $this->uri->segment(10,0);
			$very_easy_items = $this->uri->segment(11,0);

			$this->load->model('generate_exam_model');
			$exam_questions = $this->generate_exam_model->get_exam_questions($subj_id, $grading_period_id, $very_hard_items, $hard_items,$optimum_items,$easy_items,$very_easy_items);
			$quest_id = $this->input->post('hidden_question_id');

			if($quest_id != NULL)
			{
				for($x=0;$x<count($quest_id);$x++)
				{
					$ques_id = $quest_id[$x];

					$check_id = $this->generate_exam_model->check_dup_id($ques_id, $exam_id);

					if($check_id == NULL)
					{
						$this->generate_exam_model->submit_exam_details($exam_id, $ques_id, $subj_id);
					}
				}
			}

			$exam_details = $this->generate_exam_model->get_exam_details($exam_id);
			$submitted_exam_details = $this->generate_exam_model->get_questions_from_exam($exam_id);

			$page_view_content["view_dir"] = "generate_exam/exam_details";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["exam_id"] = $exam_id;
			$page_view_content["subj_id"] = $subj_id;
			$page_view_content["grading_period_id"] = $grading_period_id;
			$page_view_content["exam_details"] = $exam_details;
			$page_view_content["total_no_of_items"] = $total_no_of_items;
			$page_view_content["submitted_exam_details"] = $submitted_exam_details;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function update_generate_exam_questionnaire_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$subject_selected = $this->input->post('subject_selected');
			$section_selected = $this->input->post('section_selected');

			$this->load->model('teacher_model');
			$class_record_list = $this->teacher_model->get_class_record_list($subject_selected, $section_selected);

			$this->load->model('account_model');
			$acct_details = $this->account_model->get_account_details();

			$page_view_content["view_dir"] = "generate_exam/update_set_generate_question";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["acct_details"] = $acct_details;
			$page_view_content["class_record_list"] = $class_record_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function view_statistic_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$acct_id = $this->session->userdata('acct_id');

			$this->load->model('statistics_model');
			$exam_list = $this->statistics_model->get_exams($acct_id);

			$page_view_content["view_dir"] = "statistic/view";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["exam_list"] = $exam_list;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
	public function view_statistic_result_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{	$acct_id = $this->session->userdata('acct_id');
			$exam_sched_id = $this->uri->segment(3, 0);
			$this->load->model('statistics_model');
			//$exam_list = $this->statistics_model->get_exams($acct_id);
			$exam_list = $this->statistics_model->check_statistic($exam_sched_id);
			$this->load->model('teacher_model');
			$total_stud = $this->teacher_model->total_students_who_take_exam($exam_sched_id);
			$no_of_quest = $this->teacher_model->count_number_of_questions($exam_sched_id);
			$stud_correct_ans = $this->teacher_model->students_correct_answer($exam_sched_id);
			$total_stud_correct = $this->teacher_model->get_total_correct_answer($exam_sched_id);
			$all_total_correct = $this->teacher_model->get_all_total_correct_answer($exam_sched_id);
			$total_correct_of_question = $this->statistics_model->get_total_correct_of_question($exam_sched_id);

			$test = $this->teacher_model->select_test();

			$page_view_content["view_dir"] = "statistic/view_statistic";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["total_stud"] = $total_stud;
			$page_view_content["no_of_quest"] = $no_of_quest;
			$page_view_content["total_correct_of_question"] = $total_correct_of_question;
			$page_view_content["check_kr20"] = $exam_list;
			$page_view_content["exam_sched_id"] = $exam_sched_id;
			$page_view_content["stud_correct_ans"] = $stud_correct_ans;
			$page_view_content["all_total_correct"] = $all_total_correct;
			$page_view_content["total_stud_correct"] = $total_stud_correct;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function view_new_question_page()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_id = $this->uri->segment(3, 0);
			$subj_id = $this->uri->segment(4, 0);
			$grading_period_id = $this->uri->segment(5, 0);
			$total_no_of_items = $this->uri->segment(6, 0);
			$this->load->model('question_bank_model');
			$new_question = $this->question_bank_model->get_new_questions($grading_period_id);

			$page_view_content["view_dir"] = "generate_exam/new_question";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["exam_id"] = $exam_id;
			$page_view_content["subj_id"] = $subj_id;
			$page_view_content["total_no_of_items"] = $total_no_of_items;
			$page_view_content["grading_period_id"] = $grading_period_id;
			$page_view_content["new_question"] = $new_question;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function add_new_question()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_id = $this->uri->segment(3, 0);
			$subj_id = $this->uri->segment(4, 0);
			$grading_period_id = $this->uri->segment(5, 0);
			$question_id = $this->uri->segment(6, 0);
			$total_no_of_items = $this->uri->segment(7, 0);

			$this->load->model('generate_exam_model');
			$check_id = $this->generate_exam_model->check_dup_id($question_id, $exam_id);

			if($check_id == NULL)
			{
				$this->generate_exam_model->submit_exam_details($exam_id, $question_id, $subj_id);
			}

			redirect("/teacher_home/submit_exam_details/".$exam_id."/".$subj_id."/".$total_no_of_items."/".$grading_period_id."",'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function view_exam_details()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_id = $this->uri->segment(3, 0);

			$this->load->model('generate_exam_model');
			$exam_view_details = $this->generate_exam_model->get_view_exam_details($exam_id);
			$exam_view_questions = $this->generate_exam_model->get_view_exam_questionnaire($exam_id);
			$exam_view_answers = $this->generate_exam_model->get_view_exam_answers($exam_id);

			$page_view_content["view_dir"] = "generate_exam/view_exam_details";
			$page_view_content["logged_in"] = $session_login;
			$page_view_content["exam_view_details"] = $exam_view_details;
			$page_view_content["exam_view_questions"] = $exam_view_questions;
			$page_view_content["exam_view_answers"] = $exam_view_answers;
			$this->load->view("includes/template",$page_view_content);
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}

	public function update_difficulty()
	{
		if($session_login = $this->session->userdata('logged_in'))
		{
			$exam_sched_id = $this->uri->segment(3, 0);
			$kr = $this->input->post('kr_20');

			$this->load->model('statistics_model');
			$exam_view_questions = $this->statistics_model->get_quest_id($exam_sched_id);
			$total_correct_of_question = $this->statistics_model->get_total_correct_of_question($exam_sched_id);

			for($x=0;$x<count($exam_view_questions);$x++)
			{	
				$ques_id = $exam_view_questions[$x]['questionnaire_id'];

				$correct_ans = $total_correct_of_question[$x]['total_correct_answer'];
				$total_q = $correct_ans / count($total_correct_of_question);

				if($ques_id)
				{
					$this->statistics_model->update_questionnaire_difficulty($total_q, $ques_id);
					$this->statistics_model->update_kr($kr, $exam_sched_id);
				}
			}

			redirect("/teacher_home/view_statistic_result_page/".$exam_sched_id."", 'refresh');
		}
		else
		{
			redirect('/login', 'refresh');
		}
	}
}