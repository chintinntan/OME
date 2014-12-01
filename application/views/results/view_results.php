<div id="container_1">SSG Election Results</div>
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
		if($is_election_officer == TRUE)
		{
			if($is_commissioner == FALSE)
			{
				echo '<li><a href="'.base_url().'index.php/ssg_applicant_list">Applicant List</a></li>'; 
				echo '<li><a href="'.base_url().'index.php/add_party">Add Party</a></li>';
				echo '<li><a href="'.base_url().'index.php/add_election">Add Election</a></li>';
				echo '<li><a href="'.base_url().'index.php/add_commissioner">Add Commissioner</a></li>';
			}
			echo '<li><a href="'.base_url().'index.php/voter_registration">Register Voter</a></li>';
		}

		echo '</ul>';
		echo '</div>';
		echo '</div>';

	echo '<div id="container_4">';
	echo '<div id="container_9">';
?>

	<table>
		<tr>
			<th>No</th>
			<th>Position</th>
			<th>Name</th>
			<th>ITE</th>
			<th>ABA</th>
			<th>Educ</th>
			<th>PharmChem</th>
			<th>NDHM</th>
			<th>Music</th>
			<th>LA</th>
			<th>Engr</th>
			<th>Nursing</th>
			<th>MLS</th>
			<th>Total</th>
		</tr>
		<?php
			$applicant_ctr = 0;

			for($x=0;$x<count($page_view_data);$x++)
			{
				$candidate_name = 	$page_view_data[$x]['acct_lname'].", ".
								$page_view_data[$x]['acct_fname']." ".
								$page_view_data[$x]['acct_mname'];
				$total = $page_view_data[$x]['ITE'] + $page_view_data[$x]['ABA'] + $page_view_data[$x]['Educ'] +
						 $page_view_data[$x]['PharmChem'] + $page_view_data[$x]['NDHM'] + $page_view_data[$x]['Music'] +
						 $page_view_data[$x]['LA'] + $page_view_data[$x]['Engr'] + $page_view_data[$x]['Nursing'] +
						 $page_view_data[$x]['MLS'];

				echo '<tr>';
				echo '<td>'.++$applicant_ctr.'</td>';
				echo '<td>'.$page_view_data[$x]['pos_name'].'</td>';
				
				if($page_view_data[$x]['acct_lname'] == NULL)
				{
					echo '<td>No Candidate</td>';
				}
				else
				{
					echo '<td>'.$candidate_name.'</td>';
				}
				echo '<td>'.$page_view_data[$x]['ITE'].'</td>';
				echo '<td>'.$page_view_data[$x]['ABA'].'</td>';
				echo '<td>'.$page_view_data[$x]['Educ'].'</td>';
				echo '<td>'.$page_view_data[$x]['PharmChem'].'</td>';
				echo '<td>'.$page_view_data[$x]['NDHM'].'</td>';
				echo '<td>'.$page_view_data[$x]['Music'].'</td>';
				echo '<td>'.$page_view_data[$x]['LA'].'</td>';
				echo '<td>'.$page_view_data[$x]['Engr'].'</td>';
				echo '<td>'.$page_view_data[$x]['Nursing'].'</td>';
				echo '<td>'.$page_view_data[$x]['MLS'].'</td>';
				echo '<td>'.$total.'</td>';
				echo '</tr>';
			}
		echo '</div>';
		echo '</div>';
		?>
	</table>	
</div>