<div id="container_1">Add Election</div>
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

<table>
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th>Course</th>
			<th>Election ID</th>
			<th>School Year</th>
			<th>Account Type</th>
			<th>Option</th>
		</tr>
		<?php
			$ctr = 0;

			for($x=0;$x<count($chairman_data);$x++)
			{
				$acct_id =  $chairman_data[$x]['acct_id'];
				$name = $chairman_data[$x]['acct_fname'].' '.
						$chairman_data[$x]['acct_mname'].' '.
						$chairman_data[$x]['acct_lname'];

				echo '<tr>';
				echo '<td>'.++$ctr.'</td>';
				echo '<td>'.$name.'</td>';
				echo '<td>'.$chairman_data[$x]['course_name'].'</td>';
				echo '<td>'.$chairman_data[$x]['elect_id'].'</td>';
				echo '<td>'.$chairman_data[$x]['school_year'].'</td>';
				echo '<td>'.$chairman_data[$x]['acct_type_name'].'</td>';

				echo '<td>';	
				echo "<a href=set_chairman/set_as_chairman/".$acct_id.">Set as Chairman</a>";
				echo '</td>';
			}
		echo '</div>';
		echo '</div>';
		?>
	</table>	
</div>