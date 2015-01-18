<div class="col-sm-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."class_record/view_all_student/".$this->uri->segment(3, 0)."/".$this->uri->segment(4, 0)."/".$this->uri->segment(5, 0)." class='col-md-1'> BACK";?></a>
			<span class="col-md-4"></span>
			<h3 class="panel-title"> Student Details</h3>
		</div>

		<div class="panel-body">
			
			<div class="col-md-5 col-md-offset-3">
				<div class="table table-reponsive">
					<table class="table">
						<tr>
							<td>Name</td>
							<td>name of student</td>
						</tr>
						<tr>
							<td>Course and Section</td>
							<td>course and section of student</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" class="btn col-sm-6"></td>
						</tr>
					</table>
				</div>	
			</div>
			
		</div>
	</div>
</div>