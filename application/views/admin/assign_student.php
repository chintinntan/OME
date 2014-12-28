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
					$class_record_id = $view_assign_details[0]['class_record_id'];
					$lname 	 = $view_assign_details[0]['lname'];
					$fname 	 = $view_assign_details[0]['fname'];
					$mname 	 = $view_assign_details[0]['mname'];
					$course  = $view_assign_details[0]['course'];
					$section = $view_assign_details[0]['section'];
				?>
				<label class="label-control">Teacher:</label><?php echo "&nbsp".$lname.", ".$fname." ".$mname;?>
				<a href="<?php echo base_url();?>class_record/view_all_student" class="pull-right">View ALL STUDENT</a>
				<br>
				<label class="label-control">Course and Section:</label><?php echo "&nbsp".$course."-".$section;?>
			</div>

			<!--<div class="panel col-md-6">
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
								$stud_id = $student_list[$x]['student_id'];
								$lname = $student_list[$x]['last_name'];
								$fname = $student_list[$x]['first_name'];
								$mname = $student_list[$x]['middle_name'];
						?>
						<tbody>
							<tr>
								<td><?php echo $lname.", ".$fname." ".$mname ?></td>
								<td></td>
								<td><?php echo "<a href=".base_url()."class_record/add_new_record/".$stud_id."/".$class_record_id." class='fa fa-pencil btn btn-xs btn-primary'> ADD";?></a></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</div>
			</div>-->
		
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