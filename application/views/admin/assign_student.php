<div class="col-md-10">
	<div class="panel panel-warning">
		
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."class_record/view_class_assign/".$this->uri->segment(3, 0)." class='btn btn-xs btn-info' title='Back All Class Record'><i class='fa fa-reply'></i>";?></a>
			
			<h3 class="panel-title fa fa-clipboard col-sm-offset-5"> CLASS RECORD</h3>
		</div>
		
		<div class="panel-body">
			<div class="col-md-6">
				
			
			<div class="table table-responsive">
				<?php
					$class_record_id = $view_assign_details[0]['class_record_id'];
					$lname 	 = $view_assign_details[0]['lname'];
					$fname 	 = $view_assign_details[0]['fname'];
					$mname 	 = $view_assign_details[0]['mname'];
					$course  = $view_assign_details[0]['course'];
					$section = $view_assign_details[0]['section'];
					$sy		 = $view_assign_details[0]['school_year'];
					$sem 	 = $view_assign_details[0]['semester'];
					$subject_label 	 = $view_assign_details[0]['subject_label'];
				?>
				<table class="table table-hover">
				<thead>
					<tr>
						<th>TEACHER</th>
						<th><?php echo $lname.", ".$fname." ".$mname;?></th>
					</tr>
					<tr>
						<th>Course & Section</th>
						<th><?php echo "&nbsp".$course."-".$section;?></th>
					</tr>
					<tr>
						<th>Subject</th>
						<th><?php echo "&nbsp".$subject_label;?></th>
					</tr>
					<tr>
						<th>SY</th>
						<th>
							<?php 
								echo $sy;
								echo $sem."- SEMESTER";?>
						</th>
					</tr>
					<tr>
						<th></th>
						<th>
							<?php 
								echo "<a href=".base_url()."class_record/view_all_student/".$this->uri->segment(3, 0)."/".$this->uri->segment(4, 0)."/".$class_record_id." class='btn btn-sm btn-danger fa fa-plus-square'> ADD STUDENT";?></a>
						</th>
					</tr>
				</thead>	
				</table>
				
			</div>
			</div>
			<div class="panel col-md-8 col-md-offset-2">
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name of Student</th>
								<th>Course</th>
								<th></th>
							</tr>
						</thead>
						<?php

							for($x=0;$x<count($student_list);$x++)
							{	
								$stud_id = $student_list[$x]['stud_id'];
								$course = $student_list[$x]['course_label'];
								$lname = $student_list[$x]['last_name'];
								$fname = $student_list[$x]['first_name'];
								$mname = $student_list[$x]['middle_name'];
						?>
						<tbody>
							<tr>
								<td><?php echo $lname.", ".$fname." ".$mname ?></td>
								<td><?php echo $course?></td>
								<td><?php echo "<a href=".base_url()."class_record/remove_student/".$stud_id." class='fa fa-times btn btn-xs btn-primary' title='Remove Student this Class'> ";?></a></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
			
		</div>

	</div>
</div>