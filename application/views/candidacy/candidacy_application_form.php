<div id="container_1">Candidacy Application Form</div>
<div id="container_2">

<?php
	$url = 'http://www3.uic.edu.ph/images/100x102/'.$student_id.'.jpg';

	for($x=0;$x<count($page_view_data);$x++)
	{
		$options [$page_view_data[$x]['div_id']] = $page_view_data[$x]['div_name'];
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
	echo '<div id="container_9">';
	echo "Please select options below before filing of candidacy.";
	echo form_open('apply_candidacy/select_position');
	echo form_dropdown('division', $options);
	echo form_submit('mysubmit', 'Submit Option!');
	echo form_close();
	echo '</div>';
	echo '</div>';

?>

</div>