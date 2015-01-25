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
								<th>Teacher Name</th>
								<th>Subject</th>
								<th>Exam Title</th>
								<th>Date</th>
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
									$first_name = $exam_list[$x]['first_name'];
									$last_name = $exam_list[$x]['last_name'];
									$middle_name = $exam_list[$x]['middle_name'];
									$counter += 1; 
							?>
									<tr>
										<td><?php echo $counter; ?></td>
										<td><?php echo $last_name.", ".$first_name." ".$middle_name;?></td>
										<td><?php echo $subj; ?></td>
										<td><?php echo $exam_title; ?></td>
										<td><?php echo $exam_date; ?></td>
										<?php $this->load->helper('inflector') ?>
										<td><?php echo "<a href=".base_url()."student_home/check_exam_password/".$exam_sched_id."/".underscore($exam_title)."/".$stud_id[0]['student_id']." class='btn btn-sm btn-default'> TAKE EXAM";?></a></td>
									</tr>
						  <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>