<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="btn btn-xs btn-info" title='Back to Assign Teacher'><i class="fa fa-reply"></i> </a>
			<h3 class="panel-title fa fa-list-ul col-sm-offset-5"> ALL CLASS RECORD</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				
				<tr>
					<td><label class="control-label">TEACHER NAME: </label></td>
					<td><?php echo $teacher_details[0]['lname'].", ".$teacher_details[0]['fname']." ".$teacher_details[0]['mname'];?></td>
				</tr>
				
				
				<table class="table">
					<thead>
						<tr>
							<th>SUBJECT</th>
							<th>COURSE</th>
							<th>SECTION</th>
							<th></th>
						</tr>
					</thead>
					<?php
						$teacher_acct_id = $teacher_details[0]['acct_id'];
						for($x=0;$x<count($class_record);$x++)
						{
							$course = $class_record[$x]['course'];
							$section = $class_record[$x]['section'];
							$subject_id = $class_record[$x]['subject_id'];
							$subject = $class_record[$x]['subject_label'];
							$sec_id = $class_record[$x]['sec_id'];
							$course_id = $class_record[$x]['course_id'];
							$class_record_id= $class_record[$x]['class_record_id'];

					?>
					<tbody>
						<tr>
							<td><?php echo $subject ?></td>
							<td><?php echo $course ?></td>
							<td><?php echo $section ?></td>
							<td><?php echo "<a href=".base_url()."class_record/view_class_record/".$teacher_acct_id."/".$sec_id."/".$class_record_id." class='fa fa-eye btn btn-xs btn-danger' title='View Class Record Details'>";?></a></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>