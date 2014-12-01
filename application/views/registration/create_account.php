<div id="container_22">
<div id="container_17">Voters Registration Form</div>
<div id="container_18">Proceed to the CEA office for account activation after completing the registration process.</div>

<?php
	$this->load->helper('form');

	for($x=0;$x<count($program_list);$x++)
	{
		$options[$program_list[$x]['prog_id']] = $program_list[$x]['prog_name'];
	}

	echo form_open('create_account/profiling');
	echo '<div id="container_19">Please select your program</div>';
	echo '<div id="container_16">'.form_dropdown('program', $options,'').'</div>';
	echo '<div id="container_19">'.form_submit('mysubmit', 'Submit','class="login"').'</div>';
	echo form_close();
	
	echo '<div id="container_20"><a href="'.base_url('index.php').'">Click here to Login</a></div>';
?>
</div>
<div id="container_21">Commission on Elections and Appointments</div>
<div id="container_21">University of the Immaculate Conceptions, Davao City, Philippines</div>
