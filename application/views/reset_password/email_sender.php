<div id="container_15">		
	<div id="container_17">Reset Password</div>
	<div id="container_18">Please enter your Student ID and Email address to request password reset.</div>
	<form action="<?php echo base_url(); ?>index.php/email/send_email" method="post" accept-charset="utf-8">
		<div id="container_19">ID Number
			<?php
				if($access_is_invalid)
				{
					echo '<div id="container_24">Email not registered.</div>';
				}
			?>
		</div>
		<div id="container_16"><input type="text" name="username" class="login" value="" id="username" required=""></div>
		<div id="container_19">Email Address</div>
		<div id="container_16"><input type="text" name="email" class="login" value="" id="email" required=""></div>
		<div id="container_19"><input type="submit" name="submit" value="Submit"></div>
	</form>	
	<div id="container_20">
		<a href="<?php echo base_url('index.php/login') ?>">Back to Login</a>
	</div>	
</div>
<div id="container_21">Commission on Elections and Appointments</div>
<div id="container_21">University of the Immaculate Conceptions, Davao City, Philippines</div>

