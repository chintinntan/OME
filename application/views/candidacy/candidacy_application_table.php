<div id="container_1">Candidacy Application</div>
<div id="container_2">

<?php

	$url = 'http://www3.uic.edu.ph/images/100x102/'.$page_view_data['acct_username'].'.jpg';
	$name = $page_view_data['fname'].' '.$page_view_data['mname'].' '.$page_view_data['lname'];

	if($page_view_data['party_name'] == NULL)
	{
		$party = 'Not Available';
	}
	else
	{
		$party = $page_view_data['party_name'];
	}

	if($page_view_data['status'] == 0)
	{
		$status = 'Pending';
	}
	elseif ($page_view_data['status'] == 1) 
	{
		$status = 'Approved';
	}
	elseif ($page_view_data['status'] == 2) 
	{
		$status = 'Rejected';
	}
	else
	{
		$status = 'See UIC COMELEC';
	}

	echo '<div id="container_3">';
	echo '<div id="container_5"><img src="'.$url.'" width=180></div>';
	echo '<div id="container_6">';
	echo '<ul>';

	echo '<li><a href="'.base_url('index.php/home').'">My Profile</a></li>';
	if(!$is_election_officer)
	{
		echo '<li><a href="'.base_url('index.php/apply_candidacy').'">Apply Candidacy</a></li>';
	}
	
	if($election_countdown['day'] < 0)
	{
		echo '<li><a href="'.base_url('index.php/ballot').'">Vote Candidates</a></li>';
	}
	
	echo '</ul>';
	echo '</div>';
	echo '</div>';

	echo '<div id="container_4">';
	echo '<div id="container_7">Name</div>';
	echo '<div id="container_8"><b>'.$name.'</b></div>';
	echo '<div id="container_7">Position Applied</div>';
	echo '<div id="container_8">'.$page_view_data['position'].'</div>';
	echo '<div id="container_7">Division</div>';
	echo '<div id="container_8">'.$page_view_data['division'].'</div>';
	echo '<div id="container_7">Date Applied</div>';
	echo '<div id="container_8">'.$page_view_data['log'].'</div>';
	echo '<div id="container_7">Party</div>';
	echo '<div id="container_8">'.$party.'</div>';
	echo '<div id="container_7">Status</div>';
	echo '<div id="container_8">'.$status.'</div>';
	


	if($page_view_data['status'] != 2)
	{
		echo '<div id="container_14">';
		echo 'Please download the forms provided below and fill in all the required details. Submit the accomplished 
			  forms to the office of Commission on Elections and Appointments (CEA) on or before February 5 2014.';
		echo '<ul>';
		echo '<li><a href="'.base_url().'index.php/download_candidacy_form">Application Letter</a></li>';
		echo '<li><a href="'.base_url().'index.php/download_candidacy_form/download_coc">Certificate of Candidacy</a></li>';
		echo '<li><a href="'.base_url().'index.php/download_candidacy_form/download_osad_cert">OSAD Certification</a></li>';
		echo '<li><a href="'.base_url().'index.php/download_candidacy_form/download_dean_cert">Dean Certification</a></li>';
		echo '</ul>';
		echo '</div>';
	}
	echo '</div>';
	// echo '<pre>';
	// print_r($page_view_data);
	// echo '</pre>';
?>

</div>
