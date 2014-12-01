<div id="legend" align="center">
<?php
    echo "<ul>";
    echo    "<li><a href=set_election>Set Election</a></li>";
    echo    "<li><a href=set_party>Add Party</a></li>";
    echo    "<li><a href=election_schedule>Election Schedule</a></li>";
    echo    "<li><a href=>Election Result</a></li>";
    echo    "<li><a href=search_record>Search Voter</a></li>";
    echo "</ul>";
?>
</div>

<div id="acct_info" align="center">
<fieldset align="left">
    <legend align="left">ADMINISTRATOR  </legend>
    <?php
    if(isset($_SESSION['message']))
    {
        if($_SESSION['message'] == 1)
        {
            for($x=0;$x<count($account);$x++)
            {
                $acct_lName = $account[$x]->acct_lname;
                $acct_fName = $account[$x]->acct_fname;
                $acct_mName = $account[$x]->acct_mname;
                    
                echo "<b>Name: </b>".$acct_fName." ".$acct_mName." ".$acct_lName;
                echo "<br />";
                echo "<b>Date: </b>".date("Y-m-d");
                echo "<br /><br />";
                
                echo "<a href=index>Logout</a>";
            }
            unset($_SESSION['message']);
        }
    }
    ?>
</fieldset>
</div>