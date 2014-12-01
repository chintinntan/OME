<div id="legend" align="center">
<?php
    echo "<ul>";
    echo    "<li><a href=>Home</a></li>";
    echo    "<li><a href=set_election>Set Election</a></li>";
    echo    "<li><a href=>FOC</a></li>";
    echo    "<li><a href=>Election Schedule</a></li>";
    echo    "<li><a href=>Election Result</a></li>";
    echo    "<li><a href=>Search Voter</a></li>";
    echo "</ul>";
?>
</div>

<div id="add_election">
    <h1>School Year</h1>
    <?php
        echo form_open('election/add_election');
        echo form_input('school_year', '', 'placeholder="Enter School Year"');
        echo form_submit('submit', 'Add');
        if($_SESSION['message'] == 1)
        {
            echo "<meta http-equiv='refresh' content='2' >";
            unset($_SESSION['message']);
        }
    ?>
</div>