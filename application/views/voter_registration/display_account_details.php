<div id="container_1">Voter Registration</div>
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
			echo '<li><a href="'.base_url('index.php/voter_registration/deactivate_account/'.$page_view_data['acct_id']).'">Deactivate</a></li>';
		}
		else
		{
			echo '<li><a href="'.base_url('index.php/voter_registration/register_account/'.$page_view_data['acct_id']).'">Activate Account</a></li>';
		}

		echo '<li><a href="'.base_url('index.php/voter_registration/reset_password/'.$page_view_data['acct_id']).'">Reset Password</a></li>';
		echo '<li><a href="'.base_url('index.php/voter_registration/reset_vote/'.$page_view_data['acct_id']).'">Reset Vote</a></li>';
		echo '<li><a href="'.base_url('index.php/voter_registration/generate_pdf/'.$page_view_data['acct_id']).'">Print Details</a></li>';
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
		echo '</div>';
	}
	else
	{
		echo 'Record not found'; 
	}
?>
</div>