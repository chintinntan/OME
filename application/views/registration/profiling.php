<div id="container_22">
<div id="container_17">Voters Registration Form</div>
<div id="container_18">Proceed to the CEA office for account activation after completing the registration process.</div>

<?php
	$this->load->helper('form');
	
	for($x=0;$x<count($courses);$x++)
	{
		$options[$courses[$x]['course_id']] = $courses[$x]['course_name'];
	}

	$attributes = array(	
						'username'		=>	array(
								              'name'        => 'username',
								              'value'       => set_value('username'),
								              'class'		=> 'login'
		            						),

						'acct_password'	=>	array(
								              'name'        => 'acct_password',
								              'value'       => set_value('acct_password'),
								              'class'		=> 'login'
		            						),

						'first_name'	=>	array(
								              'name'        => 'first_name',
								              'value'       => set_value('first_name'),
								              'class'		=> 'login'
		            						),

						'middle_name'	=>	array(
								              'name'        => 'middle_name',
								              'value'       => set_value('middle_name'),
								              'class'		=> 'login'
		            						),

						'last_name'		=>	array(
								              'name'        => 'last_name',
								              'value'       => set_value('last_name'),
								              'class'		=> 'login'
		            						),

						'email_address'	=>	array(
								              'name'        => 'email_address',
								              'value'       => set_value('email_address'),
								              'class'		=> 'login'
		            						)
					);

	echo form_open('create_account/register_account');
	
	echo '<div id="container_19">Course</div>';
	echo '<div id="container_16">'.form_dropdown('course', $options, set_value('course'))."</div>";

	echo '<div id="container_19">ID Number</div>';
	echo '<div id="container_16">'.form_input($attributes['username'])."</div>";
	echo '<div id="container_23">'.form_error('username').'</div>';

	echo '<div id="container_19">Password</div>';
	echo '<div id="container_16">'.form_password($attributes['acct_password']).'</div>';
	echo '<div id="container_23">'.form_error('acct_password')."</div>";

	echo '<div id="container_19">First Name</div>';
	echo '<div id="container_16">'.form_input($attributes['first_name']).'</div>';
	echo '<div id="container_23">'.form_error('first_name')."</div>";

	echo '<div id="container_19">Middle Name</div>';
	echo '<div id="container_16">'.form_input($attributes['middle_name']).'</div>';
	echo '<div id="container_23">'.form_error('middle_name')."</div>";

	echo '<div id="container_19">Last Name</div>';
	echo '<div id="container_16">'.form_input($attributes['last_name']).'</div>';
	echo '<div id="container_23">'.form_error('last_name')."</div>";

	echo '<div id="container_19">Email Address</div>';
	echo '<div id="container_16">'.form_input($attributes['email_address']).'</div>';
	echo '<div id="container_23">'.form_error('email_address')."</div>";
	
	echo '<div id="container_16">'.form_submit('submit', 'Create Account').'</div>';
	echo form_close();

	echo '<div id="container_20"><a href="'.base_url('index.php').'">Click here to Login</a></div>';
?>
</div>
<div id="container_21">Commission on Elections and Appointments</div>
<div id="container_21">University of the Immaculate Conceptions, Davao City, Philippines</div>



