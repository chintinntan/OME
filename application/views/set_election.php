<div id="legend" align="center">
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

<div id="election_list" align="center">
    <fieldset align="left">
        <legend><h1>Election List</h1></legend>
            <?php
                for($x=0;$x<count($school_year);$x++)
                {
                    $elect_id = $school_year[$x]->elect_id;
                    $sy = $school_year[$x]->school_year;
                    $status = $school_year[$x]->status;
                    
                    if($status == 0)
                    {
                        echo "<b>School Year: </b>".$sy."  <a href=activate_election?id=$elect_id>Activate</a>";
                        echo "<br />";
                    }
                    if($status == 1)
                    {
                        echo "<b>School Year: </b>".$sy."  Activated";
                        echo "<br />";
                    }
                }
                
                echo form_open('election/add_sy');
                echo form_input('school_year', '', 'placeholder="School Year (Year-Year)"');
                echo form_submit('submit', 'Add');
                //echo "<a href=add_election>Add Election</a>";
                
            ?>
    </fieldset>
</div>