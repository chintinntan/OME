<div class="col-md-10">
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="col-sm-2"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-clipboard"> CLASS RECORD</h3>
		</div>
		
		<div class="panel-body">
	
			<div class="panel">
				<?php
					$class_record_id = $view_assign_details[0]['class_record_id'];
					$lname 	 = $view_assign_details[0]['lname'];
					$fname 	 = $view_assign_details[0]['fname'];
					$mname 	 = $view_assign_details[0]['mname'];
					$course  = $view_assign_details[0]['course'];
					$section = $view_assign_details[0]['section'];
					$sy		 = $view_assign_details[0]['school_year'];
					$sem 	 = $view_assign_details[0]['semester'];
				?>
				<label class="label-control">Teacher: <?php echo $lname.", ".$fname." ".$mname;?></label>
				<?php echo "<a href=".base_url()."class_record/view_all_student/".$this->uri->segment(3, 0)."/".$this->uri->segment(4, 0)."/".$class_record_id." class='pull-right'> ADD STUDENT";?></a>
				<br>
				<label class="label-control">Course & Section:<?php echo "&nbsp".$course."-".$section;?></label>
				<br>
				<label class="label-control"><?php echo $sem."- SEMESTER";?></label>
				
				<label class="label-control"><?php echo $sy;?></label>
			</div>

			<div class="panel col-md-8 col-md-offset-2">
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
								<td><?php echo "<a href=".base_url()."class_record/remove_student/".$stud_id." class='fa fa-pencil btn btn-xs btn-primary'> REMOVE";?></a></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
			
		</div>

	</div>
</div>