<div id="container_1">Profile Information</div>
<div id="container_2">

<?php
	if($page_view_data)
	{
		$url = 'http://www3.uic.edu.ph/images/100x102/'.$page_view_data['acct_username'].'.jpg';	
		$account_status = 'INACTIVE';
	
		echo '<div id="container_3">';
		echo '<div id="container_5"><img src="'.$url.'" width=180></div>';
		echo '<div id="container_6">';
		echo '<ul>';

		if($is_registered_voter)
		{
			$account_status = 'ACTIVE';
		}

		echo '<li><a href="'.base_url('index.php/home').'">My Profile</a></li>';
		if(!$is_election_officer)
		{
			$time_status = $election_countdown['time_status'];
			$cur_time = $election_countdown['cur_time'];
			$end_time = $election_countdown['end_time'];
			$start_time = $election_countdown['start_time'];

			if($time_status > 0)
			{
				echo '<li><a href="'.base_url('index.php/apply_candidacy').'">Apply Candidacy</a></li>';
			}
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
				echo '<li><a href="'.base_url().'index.php/results/get_elected_officers">Elected Officers</a></li>';
			}
		}
		else
		{
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
				echo '<li><a href="'.base_url().'index.php/election_turnout">Election Statistics</a></li>';
				// echo '<li><a href="'.base_url().'index.php/results/get_elected_officers">Elected Officers</a></li>';
			}
			if($is_commissioner == FALSE)
			{
				echo '<li><a href="'.base_url().'index.php/ssg_applicant_list">Applicant List</a></li>'; 
				echo '<li><a href="'.base_url().'index.php/add_party">Add Party</a></li>';
				echo '<li><a href="'.base_url().'index.php/add_election">Add Election</a></li>';
				echo '<li><a href="'.base_url().'index.php/add_commissioner">Add Commissioner</a></li>';
				echo '<li><a href="'.base_url().'index.php/set_chairman">Set Chairman</a></li>';
			}
			echo '<li><a href="'.base_url().'index.php/voter_registration">Register Voter</a></li>'; 	
		}
		echo '</ul>';
		echo '</div>';
		echo '</div>';

		$name = $page_view_data['acct_fname'].' '.$page_view_data['acct_mname'].' '.$page_view_data['acct_lname'];

		echo '<div id="container_4">';
		echo '<div id="container_7">Name</div>';
		echo '<div id="container_8"><b>'.$name.'</b></div>';
		echo '<div id="container_7">Course</div>';
		echo '<div id="container_8">'.$page_view_data['course_name'].'</div>';
		echo '<div id="container_7">Program</div>';
		echo '<div id="container_8">'.$page_view_data['prog_name'].'</div>';
		echo '<div id="container_7">Email Address</div>';
		echo '<div id="container_8">'.$page_view_data['email_address'].'</div>';
		echo '<div id="container_7">Student ID </div>';
		echo '<div id="container_8">'.$page_view_data['acct_username'].'</div>';
		echo '<div id="container_7">Date Created</div>';
		echo '<div id="container_8">'.$page_view_data['date_created'].'</div>';
		echo '<div id="container_7">Account Status</div>';
		echo '<div id="container_8">'.$account_status.'</div>';
		echo '<div id="container_7">Election Countdown</div>';

		$time_status = $election_countdown['time_status'];
		$cur_time = $election_countdown['cur_time'];
		$end_time = $election_countdown['end_time'];

		if($time_status > 0)
		{
		echo '<div id="container_8"><div id="counter"><script>display()</script></div></div>';
		}
		else if($time_status <= 0 AND $cur_time <= $end_time)
		{
			echo '<div id="container_8"><div id="counter"><font color=green><b>BALLOT IS NOW ACCESSIBLE</b></font></div></div>';
		}
		else if($time_status <= 0 AND $cur_time > $end_time)
		{
			echo '<div id="container_8"><div id="counter"><font color=red><b>Election Closed</b></font></div></div>';
		}

		echo '<div id="container_7">';
		echo "<a href=voter_registration/change_password>Change Password</a>";
		echo '</div>';
		if($is_change_password == FALSE)
		{
			echo '<div id="container_8"><-- Click this link to change password</div>';
		}
		else
		{
			echo '<div id="container_8">';
			echo form_open('voter_registration/update_password');
		    echo form_input('new_password', '', 'placeholder="Enter new password"');
		    echo form_submit('submit', 'Change Password');
		    echo '</div>';
		}

		echo '</div>';
	}
	else
	{
		echo 'Record not found'; 
	}
?>
</div>