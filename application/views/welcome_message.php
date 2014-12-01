<div id="container_15">		
	<div id="container_17">Login</div>
	<div id="container_18">Please enter your Student ID and password to access the election dashboard.</div>
	<form action="<?php echo base_url(); ?>index.php/login/check_login_details" method="post" accept-charset="utf-8">
		<div id="container_19">ID Number
			<?php
				if($access_is_invalid)
				{
					echo '<div id="container_24">Invalid username and password</div>';
				}
			?>
		</div>
		<div id="container_16"><input type="text" name="username" class="login" value="" id="username" required=""></div>
		<div id="container_19">Password</div>
		<div id="container_16"><input type="password" name="password" class="login" value="" id="password" required=""></div>
		<div id="container_19"><input type="submit" name="submit" value="Login"></div>
	</form>	
	<div id="container_20">
		<a href="<?php echo base_url('index.php/create_account') ?>">Click here to register</a>
		<br>
		<a href="<?php echo base_url('index.php/email') ?>">Forgot Password</a>
	</div>	
</div>
<div id="container_21">Commission on Elections and Appointments</div>
<div id="container_21">University of the Immaculate Conceptions, Davao City, Philippines</div>

