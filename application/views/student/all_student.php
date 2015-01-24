<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."class_record/view_class_record/".$teacher_id."/".$sec_id."/".$class_record_id." class='btn btn-xs btn-info fa fa-reply' title='Back to Class Record Details'>";?></a>
			<h3 class="panel-title col-sm-offset-5 fa fa-users"> ALL STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NAME</th>
							<th>COURSE</th>
							<th></th>
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
								$year_level= $student_list[$x]['year_level'];
					?>
					<tbody>
						<tr>
							<td><?php echo $lname.", ".$fname." ".$mname ?></td>
							<td><?php echo $year_level."-".$course;?></td>
							<td><?php echo "<a href=".base_url()."class_record/check_student_details/".$teacher_id."/".$sec_id."/".$class_record_id."/".$stud_id." class='btn btn-xs btn-danger fa fa-location-arrow' title='Select Student to Register the Class Record'>";?></a></td>
						</tr>
					</tbody>
						<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>