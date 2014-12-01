<h1>Search Student</h1>

<fieldset>
    <?php
        echo form_open('registration/search_record');    
        
        echo form_input('searched_record', set_value('', ''), 'placeholder="Enter ID Number"');
        echo form_submit('submit', 'Search');
        echo "<a href='login'>Logout</a>";
    ?>
</fieldset>

<fieldset>
<div id="record_lastname">
<?php
    if(isset($_SESSION['message']))
    {
        if($_SESSION['message'] == 1)
        {
            
            for($x=0;$x<count($searched_record);$x++)
            {
                $acct_id = $searched_record[$x]->acct_id;
                $acct_lName = $searched_record[$x]->acct_lname;
                $acct_fName = $searched_record[$x]->acct_fname;
                $acct_mName = $searched_record[$x]->acct_mname;
                $course = $searched_record[$x]->course_id;
                
                echo "<b><a href=search_record?id=$acct_id>".$acct_lName.", "
                .$acct_fName." ".$acct_mName."</a></b><br /> ".$course."<br /><br />";
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
