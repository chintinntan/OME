<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="col-sm-2"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-list-ul"> ALL CLASS RECORD</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				<br>
				<label class="control-label">TEACHER NAME:</label>
				<?php echo $teacher_details[0]['lname'].", ".$teacher_details[0]['fname']." ".$teacher_details[0]['mname'];?>
				<table class="table">
					<thead>
						<tr>
							<th>SUBJECT</th>
							<th>COURSE</th>
							<th>SECTION</th>
							<th>OPTION</th>
						</tr>
					</thead>
					<?php
						$teacher_acct_id = $teacher_details[0]['acct_id'];
						for($x=0;$x<count($class_record);$x++)
						{
							$course = $class_record[$x]['course'];
							$section = $class_record[$x]['section'];
							$subject = $class_record[$x]['subject_label'];
							$sec_id = $class_record[$x]['sec_id'];
					?>
					<tbody>
						<tr>
							<td><?php echo $subject ?></td>
							<td><?php echo $course ?></td>
							<td><?php echo $section ?></td>
							<td><?php echo "<a href=".base_url()."class_record/view_class_record/".$teacher_acct_id."/".$sec_id." class='fa fa-eye btn btn-xs btn-primary'> VIEW CLASS RECORD";?></a></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>