<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-md-5"></span>
			<h3 class="panel-title">EXAM LIST</h3>
		</div>
		<div class="panel-body">
			<div>
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No.1</th>
								<th>Subject</th>
								<th>Exam Title</th>
								<th>Date</th>
								<th>OPTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$counter = 0;
								for($x=0;$x<count($exam_list);$x++)
								{
									$exam_sched_id = $exam_list[$x]['exam_schedule_id'];
									$subj = $exam_list[$x]['subject_label'];
									$exam_title = $exam_list[$x]['title_exam'];
									$exam_date = $exam_list[$x]['exam_date'];
									$counter += 1; 
							?>
									<tr>
										<td><?php echo $counter; ?></td>
										<td><?php echo $subj; ?></td>
										<td><?php echo $exam_title; ?></td>
										<td><?php echo $exam_date; ?></td>
										<td><?php echo "<a href=".base_url()."student_home/check_exam_password/".$exam_sched_id."/".$exam_title." class='btn btn-sm btn-default'> TAKE EXAM";?></a></td>
									</tr>
						  <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>