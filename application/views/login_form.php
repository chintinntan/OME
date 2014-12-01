
	<?php
		$attributes = array( 'class' 	=> 'login', 
							 'id' 		=> 'myform',
							 'method' 	=> 'post'
						);

		$data["user"] = array(	'name'        => 'username',
					            'id'          => 'username',
					            // 'value'       => '1000837',
					            // 'maxlength'   => '100',
					            // 'size'        => '50',
					            // 'style'       => 'width:50%',
					            'placeholder'	=> 'ID Number',
					            'required'	=> ''
			            );

		$data["pass"] = array(	'name'        => 'password',
			              		'id'          => 'password',
					            // 'value'       => 'chua',
					            // 'maxlength'   => '100',
					            // 'size'        => '50',
					            // 'style'       => 'width:50%',
					            'placeholder'	=> 'Password',
					            'required'	=> ''
			            );

		$this->load->helper('form');
	    echo form_open('login/check_login_details');
	    echo form_input($data["user"]);
	    echo form_password($data["pass"]);
	    echo form_submit('submit', 'Login');
	    echo form_close();
  	?>

