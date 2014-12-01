<div id="container_1">Applicant List</div>
<div id="container_2">
<?php
	
	$url = 'http://www3.uic.edu.ph/images/100x102/'.$student_id.'.jpg';

		echo '<div id="container_3">';
		echo '<div id="container_5"><img src="'.$url.'" width=180></div>';
		echo '<div id="container_6">';
		echo '<ul>';

		echo '<li><a href="'.base_url('index.php/home').'">My Profile</a></li>';
		
		$time_status = $election_countdown['time_status'];
		$cur_time = $election_countdown['cur_time'];
		$end_time = $election_countdown['end_time'];

		if($time_status <= 0 AND $cur_time <= $end_time)
		{
			if($elect_sched[0]['cur_time'] >= '2014-03-18 07:30:00')
				{
					if($elect_sched[0]['cur_time'] <= '2014-03-18 12:00:00')
					{
						echo '<li><a href="'.base_url('index.php/ballot').'">Vote Candidates</a></li>';
					}
					else if($elect_sched[0]['prog_id'] == $prog_id AND $elect_sched[0]['cur_time'] >= $elect_sched[0]['start_date'] AND $elect_sched[0]['cur_time'] <= $elect_sched[0]['end_date'])
					{
						echo '<li><a href="'.base_url('index.php/ballot').'">Vote Candidates</a></li>';
					}
				}
			echo '<li><a href="'.base_url().'index.php/results">SSG Election Results</a></li>';
			echo '<li><a href="'.base_url().'index.php/program_result">Program Election Results</a></li>';
			echo '<li><a href="'.base_url().'index.php/voter_statistics">Voter Statistics</a></li>';
		}
		if($is_commissioner == FALSE)
		{
			echo '<li><a href="'.base_url().'index.php/ssg_applicant_list">Applicant List</a></li>'; 
			echo '<li><a href="'.base_url().'index.php/add_party">Add Party</a></li>';
			echo '<li><a href="'.base_url().'index.php/add_election">Add Election</a></li>';
			echo '<li><a href="'.base_url().'index.php/add_commissioner">Add Commissioner</a></li>';
		}
		echo '<li><a href="'.base_url().'index.php/voter_registration">Register Voter</a></li>';
		
		echo '</ul>';
		echo '</div>';
		echo '</div>';

	echo '<div id="container_4">';
	echo '<div id="container_9">';
?>

<?php
	$options = array(	0	=>	'Pending Applicants',
                  		1	=>	'Approved Applicants',
                  		2	=> 	'Rejected Applicants',
                  		3 	=>	'All Applicants',
                  		4	=>	'Please select application status'
                	);

	$attributes = array( 	'class' 	=> 'login', 
							'id' 		=> 'myform',
							'method' 	=> 'post'
					);

	$this->load->helper('url');
	$this->load->helper('form');

	echo form_open('ssg_applicant_list',$attributes);
	echo form_dropdown('applicant_status', $options, 4);
	echo form_submit('mysubmit', 'Search');
	echo form_close();

	// echo '<pre>';
	// print_r($page_view_data);
	// echo '</pre>';
?>


<table>
	<tr>
		<th>No</th>
		<th>Name</th>
		<th>Position</th>
		<th>Status</th>
		<th>Options</th>
	</tr>

	<?php
		$applicant_ctr = 0;

		for($x=0;$x<count($page_view_data);$x++)
		{
			$candidate_name = 	$page_view_data[$x]['acct_lname'].", ".
								$page_view_data[$x]['acct_fname']." ".
								$page_view_data[$x]['acct_mname'];
			echo '<tr>';
			echo '<td>'.++$applicant_ctr.'</td>';
			echo '<td>'.$candidate_name.'</td>';	
			echo '<td>'.$page_view_data[$x]['pos_name'].'</td>';


			if($page_view_data[$x]['status'] == 0)
			{
				$status = 'Pending';
			}	
			elseif ($page_view_data[$x]['status'] == 1) 
			{
				$status = 'Approved';
			}
			elseif ($page_view_data[$x]['status'] == 2) 
			{
				$status = 'Rejected';
			}
			else
			{
				$status = 'Review Application';
			}

			echo '<td>'.$status.'</td>';	

			if($page_view_data[$x]['status'] == 0)
			{
				$option1 = 'Approve';
				$option2 = 'Reject';
				$status1 = 1;
				$status2 = 2;
			}	
			elseif ($page_view_data[$x]['status'] == 1) 
			{
				$option1 = 'Revert';
				$option2 = 'Reject';
				$status1 = 0;
				$status2 = 2;
			}
			elseif ($page_view_data[$x]['status'] == 2) 
			{
				$option1 = 'Revert';
				$option2 = 'Approve';
				$status1 = 0;
				$status2 = 1;
			}
			else
			{
				$status = 'Review Application';
			}

			$candidate_id = $page_view_data[$x]['elect_cand_id'];
			$url1 = site_url('ssg_applicant_list/update_status/'.$candidate_id.'/'.$status1);
			$url2 = site_url('ssg_applicant_list/update_status/'.$candidate_id.'/'.$status2);

			echo '<td><a href="'.$url1.'">'.$option1.'</a> <a href="'.$url2.'">'.$option2.'</a></td>';	
			echo '</tr>';
		}

		echo '</div>';
		echo '</div>';
	?>
	
</table>

</div>