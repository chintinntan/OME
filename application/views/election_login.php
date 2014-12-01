<div id="login_form">
  <h1>Login</h1>
  
  <?php
    echo form_open('election/validate_credentials');
    echo form_input('acct_username', '', 'placeholder="Username"');
    echo form_password('acct_password', '', 'placeholder="Password"');
    echo form_submit('submit', 'Login');
  ?>
</div>