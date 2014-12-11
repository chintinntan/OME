<div class="col-md-9">
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="col-sm-2"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-clipboard"> CLASS RECORD</h3>
		</div>
		
		<div class="panel-body">
	
			<div class="panel">
				<?php
					$lname 	 = $teacher_details[0]['last_name'];
					$fname 	 = $teacher_details[0]['first_name'];
					$mname 	 = $teacher_details[0]['middle_name'];
					$course  = $course_name[0]['acronym'];
					$section = $section_name[0]['label'];
				?>
				<label class="label-control">Teacher:</label><?php echo "&nbsp".$lname.", ".$fname." ".$mname;?>
				<br>
				<label class="label-control">Course and Section:</label><?php echo "&nbsp".$course."-".$section;?>
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
						<?php
							$class_rec_data = array(
								'course' => $course,
								'section' => $section,
								'subj_id' => $subject_id,
								'semester' => $semester,
								'school_year' => $school_year);

							for($x=0;$x<count($student_list);$x++)
							{
								$stud_id = $student_list[$x]['student_id'];
								$lname = $student_list[$x]['last_name'];
								$fname = $student_list[$x]['first_name'];
								$mname = $student_list[$x]['middle_name'];
						?>
						<tbody>
							<tr>
								<td><?php echo $lname.", ".$fname." ".$mname ?></td>
								<td></td>
								<td><?php echo "<a href=".base_url()."class_record/add_new_record/".$stud_id." class='fa fa-pencil btn btn-xs btn-primary'> ADD";?></a></td>
							</tr>
						</tbody>
						<?php } ?>
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
								<td><a href="#">REMOVE</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>