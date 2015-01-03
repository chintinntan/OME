<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="#" class="col-sm-1"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title"> ALL STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NAME</th>
							<th>COURSE</th>
							<th>OPTION</th>
						</tr>
					</thead>
					<?php

							for($x=0;$x<count($student_list);$x++)
							{
								$stud_id = $student_list[$x]['student_id'];
								$lname = $student_list[$x]['last_name'];
								$fname = $student_list[$x]['first_name'];
								$mname = $student_list[$x]['middle_name'];
								$course= $student_list[$x]['acronym'];
					?>
					<tbody>
						<tr>
							<td><?php echo $lname.", ".$fname." ".$mname ?></td>
							<td><?php echo $course;?></td>
							<td><a href="#">ADD</a></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>