<div class="col-md-9">
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">CLASS RECORD</h3>
		</div>
		
		<div class="panel-body">
	
			<div class="panel">
				<label class="label-control">Teacher:</label><?php echo "Teacher fullname";?>
				<br>
				<label class="label-control">Course and Section:</label><?php echo "Course and Section via acronym";?>
			</div>

			<div class="panel col-md-6">
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name of Student</th>
								<th>Course</th>
								<th>Option</th>
							</tr>
						</thead>
							
						<tbody>
							<tr>
								<td>list of all student</td>
								<td></td>
								<td><a href="#">Add</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		
			<div class="panel col-md-6">
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name of Student</th>
								<th>Course</th>
								<th>Option</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>list of student enrolled</td>
								<td>Course</td>
								<td><a href="#">Remove</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>