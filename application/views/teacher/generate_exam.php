<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/exam_create_page" class="col-sm-1">CREATE</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title"> GENERATE EXAMS</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-12">
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>EXAM TITLE</th>
								<th>SUBJECT NAME</th>
								<th>PERIOD</th>
								<th>DATE</th>
								<th>OPTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								for($x=0;$x<count($exam_sched_details);$x++)
								{
									$exam_id = $exam_sched_details[$x]['exam_schedule_id'];
									$title = $exam_sched_details[$x]['title_exam'];
									$subject = $exam_sched_details[$x]['subject_label'];
									$grading_period = $exam_sched_details[$x]['label'];
									$exam_date = $exam_sched_details[$x]['exam_date'];
							?>
							<tr>
								<td><?php echo $title; ?></td>
								<td><?php echo $subject; ?></td>
								<td><?php echo $grading_period; ?></td>
								<td><?php echo $exam_date; ?></td>
								<td>
									<?php echo "<a href=".base_url()."teacher_home/exam_update_page/".$exam_id." class='btn btn-sm btn-default'> UPDATE";?>
									<?php echo "<a href=".base_url()."teacher_home/generate_exam_questionnaire_page/".$exam_id." class='btn btn-sm btn-default'> GENERATE EXAM QUESTIONNAIRE";?>
									<?php echo "<a href=".base_url()."teacher_home/view_exam_details/".$exam_id." class='btn btn-sm btn-default'> VIEW";?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>