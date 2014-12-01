<?php
	$page_view_data[0]['acct_username'] = '1000837';
	$page_view_data[0]['acct_fname'] = 'ERIKA';
	$page_view_data[0]['acct_mname'] = 'MURIEL';
	$page_view_data[0]['acct_lname'] = 'CHUA';
	$page_view_data[0]['email_address'] = 'erika@gmail.com';
?>

<div id="content_header">Student Profile</div>

<div id="body">
	<?php
		
		$acct_username = $page_view_data[0]['acct_username'];
		$acct_name = $page_view_data[0]['acct_fname']." ".
				     $page_view_data[0]['acct_mname']." ".
				     $page_view_data[0]['acct_lname'];

		echo '<table border=0>';

			echo '<tr>';
				//echo '<td rowspan=4><img src="'.base_url('css/images/default.jpg').'" width="150"></td>';
				echo '<td rowspan=4><img src="http://www3.uic.edu.ph/images/100x102/'.$page_view_data[0]['acct_username'].'.jpg" width="100"></td>';
				echo '<td>ID Number </td>';
				echo '<td>'.$page_view_data[0]['acct_username'].'</td>';
			echo '</tr>';
			echo '<tr>';
				// echo '<td><a href="'.base_url().'index.php/apply_candidacy">Apply for Candidacy</a></td>';
				echo '<td>Name </td>';
				echo '<td>'.$acct_name.'</td>';
			echo '</tr>';
			echo '<tr>';
				// echo '<td><a href="'.base_url().'index.php/ballot">Ballot</a></td>';
				echo '<td>Course </td>';
				echo '<td>Bachelor of Science in Information Technology</td>';
			echo '</tr>';
			echo '<tr>';
				// echo '<td><a href="'.base_url().'index.php/ballot">Ballot</a></td>';
				echo '<td>Department </td>';
				echo '<td>Accountancy and Business Administration Program</td>';
			echo '</tr>';
			echo '<tr>';
				// echo '<td><a href="'.base_url().'index.php/ssg_applicant_list">Applicant List</a></td>';
				echo '<td>Email Address </td>';
				echo '<td>'.$page_view_data[0]['email_address'].'</td>';
			echo '</tr>';
			echo '</tr>';
			echo '<tr>';
			echo '<td><a href="'.base_url().'index.php/apply_candidacy">Apply Candidacy</a></td>';
			echo '</tr>';
			echo '</tr>';
			echo '<tr>';
				echo '<td><a href="'.base_url().'index.php/ballot">Vote Candidate</a></td>';
			echo '</tr>';
		echo '</table>';
	?>
</div>