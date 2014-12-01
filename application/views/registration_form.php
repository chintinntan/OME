
    <h1>Create an Account</h1>

        <fieldset>
    <div id="register">
    <?php
        $course[" "] = "Please Select a Course";
        echo form_open('registration/create_member');
        echo form_dropdown('course_id', $course, " ");
        echo "<br /><br />";
        echo form_input('acct_username', set_value('acct_username', ''), 'placeholder="ID Number"');
        echo form_password('acct_password', set_value('acct_password', ''), 'placeholder="Password"');
        echo form_input('acct_fname', set_value('acct_fname', ''), 'placeholder="First Name"');
        echo form_input('acct_mname', set_value('acct_mname', ''), 'placeholder="Middle Name"');
        echo form_input('acct_lname', set_value('acct_lname', ''), 'placeholder="Last Name"');
        echo form_input('email_address', set_value('email_address', ''), 'placeholder="Email Address"');
        echo form_submit('submit', 'Create Account');
        echo "<a href='index.php/registration/login'>Login</a>";
        echo validation_errors('<p class="error">');
    ?>
    </div>
</fieldset>

    