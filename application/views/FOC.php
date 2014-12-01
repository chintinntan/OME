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

<h1>Party List</h1>

<fieldset>
<div id="party_list">
<?php
    
    echo "<table border=1>";
    echo "<th>Party Name</th>";
    echo "<th>School Year</th>";
    for($x=0;$x<count($party);$x++)
        {
            $party_id = $party[$x]->party_id;
            $sy = $party[$x]->school_year;
            $party_name = $party[$x]->party_name;
            echo "<tr>";
                echo "<td>".$party_name."</td>";
                echo "<td>".$sy."</td>";
                //echo "<td> <a href=?id=$party_id>View Members</a></td>";
            echo "</tr>";
        }
    echo "</table>";
?>
</div>
</fieldset>

<div id="set_party">
    <?php
        echo "<br /><br />";
        echo form_open('election/add_party');
        echo form_input('school_year', '', 'placeholder="School Year (Year-Year)"');
        echo "<br />";
        echo form_input('party_name', '', 'placeholder="Party Name"');
        echo form_submit('submit', 'Add');
    ?>
</div>