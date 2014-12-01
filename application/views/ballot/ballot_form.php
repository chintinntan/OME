<div id="container_1">Online Ballot</div>
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

<?php

	$tb = array(	'table'		=>	'<table>',
					'table_'	=>	'</table>',
					'tr'		=>	'<tr>',
					'tr_'		=>	'</tr>',
					'th'		=>	'<th>',
					'th_'		=>	'</th>',
					'td'		=>	'<td>',
					'td_'		=>	'</td>'
				);

	$this->load->helper('form');

	$form_attributes = array('name'	=> 'candidates');

	echo form_open('ballot/submit_vote',$form_attributes);
	echo '<table id="ballot">';
	echo $tb['tr'];
	echo '<th colspan=3>SSG Executive Position</th>';
	echo $tb['tr_'];

	for($x=0;$x<count($position_ssg);$x++)
	{
		if($page_view_data == NULL)
		{
			echo $tb['tr'];
			echo '<td id="position_header"><b>'.$position_ssg[$x]['pos_name'].'</b></td>';
			echo $tb['td'].'No Candidate'.$tb['td_'];
			echo $tb['tr_'];
		}
		else
		{
			echo $tb['tr'];
			echo '<td colspan=3 id="position_header"><b>'.$position_ssg[$x]['pos_name'].'</b></td>';
			echo $tb['tr_'];
		
			$candidate_ctr = 0;

			for($y=0;$y<count($page_view_data);$y++)
			{

				if($page_view_data[$y]['pos_id'] == $position_ssg[$x]['pos_id'])
				{
						
					$candidate_ctr += 1;
					$candidate_id = $page_view_data[$y]['elect_cand_id'];
					$radio_name = $position_ssg[$x]['pos_id'];
					$candidate = $page_view_data[$y]['acct_fname']." ".$page_view_data[$y]['acct_lname'];
					$party = $page_view_data[$y]['party_name'];

					echo $tb['tr'];
					echo '<td>'.form_radio($radio_name, $candidate_id, '', '').$tb['td_'];
					echo '<td>'.'<img src="http://www3.uic.edu.ph/images/100x102/'.$page_view_data[$y]['acct_username'].'.jpg" width=100>'.$tb['td_'];
					echo $tb['td'];
					echo 'Name: <b>'.$candidate.'</b><br>Party: '.$party;
					echo $tb['td_'];
					echo $tb['tr_'];
					
				}
			}

			if($candidate_ctr == 0)
			{
				echo '<tr><td colspan=3>No Candidate</td></tr>';
			}
		}
	}
	
	echo $tb['tr'];
	echo '<th colspan=3>Program Level Position</th>';
	echo $tb['tr_'];

	for($z=0;$z<count($position_program);$z++)
	{
		if($program_candidates == NULL)
		{
			echo $tb['tr'];
			echo '<td id="position_header" colspan=3><b>'.$position_program[$z]['pos_name'].'</b></td></tr><tr>';
			echo '<td colspan=3>No Candidate</td>';
			echo $tb['tr_'];
		}
		else
		{
			echo $tb['tr'];
			

			if($position_program[$z]['pos_name'] == 'Program Representative')
			{
				echo '<td colspan=3 id="position_header"><b>'.$position_program[$z]['pos_name'].' (Please Select 3 Program Representatives)</b></td>';
			}
			else
			{
				echo '<td colspan=3 id="position_header"><b>'.$position_program[$z]['pos_name'].'</b></td>';
			}
			
			echo $tb['tr_'];
		
			$candidate_ctr = 0;

				for($i=0;$i<count($program_candidates);$i++)
				{

					if($program_candidates[$i]['pos_id'] == $position_program[$z]['pos_id'])
					{	
						$candidate_ctr += 1;
						$candidate_id = $program_candidates[$i]['elect_cand_id'];
						$radio_name = $position_program[$z]['pos_id'];
						$candidate = $program_candidates[$i]['acct_fname']." ".$program_candidates[$i]['acct_lname'];
						$party = $program_candidates[$i]['party_name'];

						$checkbox = array(
											'name'    => 'program_rep[]',
											// 'id'      => $radio_name,
											'id'      => 'program_rep',
											'value'   => $candidate_id,
											);
				        // 'checked' => set_checkbox('program_rep', $candidate_id, FALSE)

						echo $tb['tr'];
						if($position_program[$z]['pos_id'] == 18)
						{
							echo '<td>'.form_checkbox($checkbox).$tb['td_'];
						}
						else
						{
							echo '<td>'.form_radio($radio_name, $candidate_id, '', '').$tb['td_'];
							echo form_hidden('program_rep', 'FALSE');
						}
						echo '<td>'.'<img src="http://www3.uic.edu.ph/images/100x102/'.$program_candidates[$i]['acct_username'].'.jpg">'.$tb['td_'];
						echo $tb['td'];
						echo 'Name: <b>'.$candidate.'</b><br>Party: '.$party;
						echo $tb['td_'];
						echo $tb['tr_'];
					}
				}
			

			if($candidate_ctr == 0)
			{
				echo '<tr><td colspan=3>No Candidate</td></tr>';
			}
		}
	}

	if($page_view_data != NULL)
	{
		echo $tb['tr'];
		echo '<td colspan=3>'.form_submit('name','Vote').'</td>';
		echo $tb['tr_'];
	}

	echo $tb['table_'];
	echo form_close();

	echo '</div>';
	echo '</div>';
?>

</div>