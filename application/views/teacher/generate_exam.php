<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/exam_create_page" title='Create Generate Exam' class="fa fa-pencil-square btn-sm btn btn-info"></a>
			<h3 class="panel-title col-sm-offset-5 fa fa-cog"> GENERATE EXAMS</h3>
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
								<th></th>
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
									$kr20 = $exam_sched_details[$x]['kr20'];
							?>
							<tr>
								<td><?php echo $title; ?></td>
								<td><?php echo $subject; ?></td>
								<td><?php echo $grading_period; ?></td>
								<td>
									<?php 
										$source = $exam_date; 
										$date=new DateTime($source); 
										echo $date->format("F d, Y"); 
									?>
								</td>
								<td>
									
									<?php
										if($kr20==0){
											echo "<a href=".base_url()."teacher_home/exam_update_page/".$exam_id." title='Update Generate Exam' class='fa fa-pencil-square-o btn btn-sm btn-danger'>";
											echo "<a href=".base_url()."teacher_home/generate_exam_questionnaire_page/".$exam_id." title='Generate Exam Questionnaire' class='fa fa-recycle btn btn-sm btn-success'>";
										}else{

										} 
										
									?>
									<?php echo "<a href=".base_url()."teacher_home/view_exam_details/".$exam_id." title='View Exam Details' class='fa fa-sitemap btn btn-sm btn-primary'>";?>
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