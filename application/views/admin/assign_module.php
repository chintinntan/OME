<div class="col-md-10">
<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">ASSIGN SECTION and COURSE</h3></div>
	<div class="panel-body">
	<br>
		<div class="panel col-sm-4 col-sm-offset-4">
			<div class="panel-body">
				<?php 
				$option_section=array('0'=>'--Select SECTION--'); 
				$option_course=array('0'=>'--Select COURSE--');
				echo form_dropdown('section',$option_section,'','class="form-control"'); 
				echo "<br>";
				echo form_dropdown('course',$option_course,'','class="form-control"');
				echo "<input type='submit' class='btn btn-primary pull-right'>"
				?>
			</div>
		</div>
	</div>
</div>
</div>