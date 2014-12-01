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

<?php
    echo form_open('add_election/add_election_sched');
    echo form_input('school_year', '', 'placeholder="SY (Year-Year)"');
    echo '<br>';
    echo form_input('start_date', '', 'placeholder="Start(2014-02-26 7:30:00)"');
    echo '&nbsp&nbsp-&nbsp&nbsp';
    echo form_input('end_date', '', 'placeholder="End(2014-02-26 17:30:00)"');
    echo form_submit('submit', 'Add');
    echo '<br><br>';
?>

<table>
		<tr>
			<th>Election ID</th>
			<th>School Year</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
			<th>Option</th>
			<th>Activate Election Schedule</th>
			<th>Status</th>
		</tr>
		<?php
			$ctr = 0;

			for($x=0;$x<count($page_view_data);$x++)
			{

				echo '<tr>';
				echo '<td>'.$page_view_data[$x]['elect_id'].'</td>';
				echo '<td>'.$page_view_data[$x]['school_year'].'</td>';
				echo '<td>'.$page_view_data[$x]['start_date'].'</td>';
				echo '<td>'.$page_view_data[$x]['end_date'].'</td>';
				echo '<td>'.$page_view_data[$x]['status'].'</td>';
				echo "<td>";
				if($page_view_data[$x]['status'] == 1)
				{
					echo "Activated";
				}
				else
				{
					echo "</a><a href=add_election/activate_election/".$page_view_data[$x]['elect_id'].">Activate</a>";
				}	
				echo "</a>&nbsp|&nbsp<a href=add_election/delete_election/".$page_view_data[$x]['elect_id'].">Delete</a>";
				echo "</a>&nbsp|&nbsp<a href=add_election/edit_election/".$page_view_data[$x]['elect_id'].">Edit</a></td>";
				echo "<td></a><a href=election_schedule/activate_election_schedule/".$page_view_data[$x]['elect_id'].">Activate</a>";
				echo "</a>&nbsp|&nbsp<a href=election_schedule/deactivate_election_schedule/".$page_view_data[$x]['elect_id'].">Deactivate</a></td>";
				echo '<td>'.$page_view_data[$x]['elect_schedule_status'].'</td>';
			}
		echo '</div>';
		echo '</div>';
		?>
	</table>	
</div>