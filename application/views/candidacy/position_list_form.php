<div id="container_1">Candidacy Application Form</div>
<div id="container_2">

<?php

	$url = 'http://www3.uic.edu.ph/images/100x102/'.$student_id.'.jpg';

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
	$this->load->helper('form');
	echo 'Please select desired position.<br>';
	echo form_open('apply_candidacy/submit_application');
	for($x=0;$x<count($page_view_data);$x++)
	{
		$position[$x]['name'] = 'position';
		$position[$x]['id'] = 'position';
		$position[$x]['value'] = $page_view_data[$x]['pos_id'];
		$position[$x]['checked'] = 'checked';

		echo form_radio($position[$x]) . $page_view_data[$x]['pos_name'] . '<br>';
	}
	echo form_submit('mysubmit', 'Submit Application');
	echo form_close();
	echo '</div>';
	echo '</div>';
?>

</div>
