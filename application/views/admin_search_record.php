<div>
<?php
    echo "<ul>";
    echo    "<li><a href=set_election>Set Election</a></li>";
    echo    "<li><a href=set_party>Add Party</a></li>";
    echo    "<li><a href=>Election Schedule</a></li>";
    echo    "<li><a href=>Election Result</a></li>";
    echo    "<li><a href=search_record>Search Voter</a></li>";
    echo "</ul>";
?>
</div>

<h1>Search Student</h1>

<fieldset>
    <?php
        echo form_open('election/search_record');    
        
        echo form_input('searched_record', set_value('', ''), 'placeholder="Enter ID Number or Last Name"');
        echo form_submit('submit', 'Search');
        //echo "<a href='login'>Logout</a>";
    ?>
</fieldset>

<fieldset>
<div id="record_id">
<?php
    if(isset($_SESSION['message']))
    {
        if($_SESSION['message'] == 1)
        {
            for($x=0;$x<count($searched_record);$x++)
            {
                $acct_id = $searched_record[$x]->acct_id;
                $acct_username = $searched_record[$x]->acct_username;
                $acct_lName = $searched_record[$x]->acct_lname;
                $acct_fName = $searched_record[$x]->acct_fname;
                $acct_mName = $searched_record[$x]->acct_mname;
                $email_address = $searched_record[$x]->email_address;
                $course = $searched_record[$x]->course_id;
                $acct_status = $searched_record[$x]->acct_status;
                $reg_status = $searched_record[$x]->reg_status;
                $time_date_log = $searched_record[$x]->time_date_log;
                $acct_type_id = $searched_record[$x]->acct_type_id;
                
                if($acct_status == 1)
                    $status = "Active";
                else
                    $status = "Inactive";
                if($reg_status == 1)
                    $reg_stat = "Confirmed";
                else
                    $reg_stat = "Unconfirmed";
                    
                    echo "<table border=1>";
                    echo "<tr>";
                    echo "<td>ID Number </td>";
                    echo "<td>".$acct_username.     "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Last Name </td>";
                    echo "<td>".$acct_lName.        "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>First Name </td>";
                    echo "<td>".$acct_fName.        "</td>";
                    echo "</td>";
                    echo "<tr>";
                    echo "<td>Middle Name </td>";
                    echo "<td>".$acct_mName.        "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Course </td>";
                    echo "<td>".$course.            "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Email </td>";
                    echo "<td>".$email_address.     "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>TIme and Date Registered </td>";
                    echo "<td>".$time_date_log.     "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Account Type </td>";
                    echo "<td>".$acct_type_id.      "</td>";
                    
                    if($reg_stat == "Confirmed")
                    {
                        echo "</tr>";
                        echo "<td>Account Status: </td>";
                        echo "<td>".$reg_stat."</td>";
                        echo "<tr>";
                    echo "</tr>";
                    }
                    else
                    {
                        echo "</tr>";
                        echo "<td>Account Status </td>";
                        echo "<td><a href=confirm_voter_registration?id=$acct_id>Confirm</a></td>";
                        echo "<tr>";
                    }
                    
                    echo "<tr><td colspan=2><a href=generate_pdf?id=$acct_id>Print Access Details</a></td></tr>";
                    echo "</table>";
            }

            unset($_SESSION['message']);
        }
    }else
    {
        echo "No Record Found";
    }
    
?>
</div>
</fieldset>