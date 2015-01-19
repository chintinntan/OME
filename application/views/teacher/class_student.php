<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."teacher_home/view_student_list class='col-sm-1'> BACK";?></a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">CLASS RECORD LIST</h3>
		</div>
		<?php if($class_record_list != NULL)
			  { 
		?>
		<div class="panel-body">
			<div class="col-md-5">
				<div class="table table-responsive">
					<table class="table">
						<tr>
							<th>SUBJECT</th>
							<td><?php echo $class_record_list[0]['subject_label'] ?></td>
						</tr>
						<tr>
							<th>SECTION</th>
							<td><?php echo $class_record_list[0]['label'] ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="table table-responsive col-md-8">
				<table class="table">
					<thead>
						<tr>
							<th>NAME</th>
							<th>COURSE-YEAR</th>
						</tr>
					</thead>
					<?php 
						for($x=0;$x<count($class_record_list);$x++)
						{
							$lname = $class_record_list[$x]['last_name'];
							$fname = $class_record_list[$x]['first_name'];
							$mname = $class_record_list[$x]['middle_name'];
							$course = $class_record_list[$x]['acronym'];
							$year_lvl = $class_record_list[$x]['year_level'];
							$subject = $class_record_list[$x]['subject_label'];
							$section = $class_record_list[$x]['label'];
					?>
							<tbody>
								<tr>
									<td><?php echo $fname." ".$mname." ".$lname ?></td>
									<td><?php echo $course."-".$year_lvl ?></td>
								</tr>
							</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
		<?php } 
			else{
		?>
		<div class="panel-body">
			<div class="col-md-5">
				<div class="table table-responsive">
					<table class="table">
						<tr>
							<th>SUBJECT</th>
							<td>NO RECORD</td>
						</tr>
						<tr>
							<th>SECTION</th>
							<td>NO RECORD</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="table table-responsive col-md-8">
				<table class="table">
					<thead>
						<tr>
							<th>NAME</th>
							<th>COURSE-YEAR</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>NO RECORD</td>
							<td>NO RECORD</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php } ?>
	</div>
</div>