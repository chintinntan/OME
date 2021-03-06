<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-sm-5"></span>
			<h3 class="panel-title">ALL QUESTIONNAIRE GENERATE</h3>
		</div>
		<div class="panel-body">
			
			<div class="">
				<div class="table table-responsive">
					<div class="col-md-5">
						<table class="table">
						<tr>
							<td><b>EXAM TITLE</b></td>
							<td>
								<?php 
									echo $exam_details[0]['title_exam'];
								?>
							</td>
						</tr>
						<tr>
							<td><b>SUBJECT</b></td>
							<td>
								<?php
									echo $exam_details[0]['subject_label'];
								?>
							</td>
						</tr>
						<tr>
							<td><b>Generate total items</b></td>
							<td>
								<?php 
									echo count($exam_questions);
								?>
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td></td>
						</tr>

						</table>	
					</div>
					<table class="table table-hover">
						
						<thead>
							<tr>
								<th>No.</th>
								<th>Question</th>
								<th>PERIOD</th>
								<th>INDEX RANGE</th>
								<th>DIFFICULTY</th>
							</tr>
						</thead>
						<tbody>

							<?php
								$counter = 0;
								for($x=0;$x<count($exam_questions);$x++)
								{
									$counter += 1;
									
										$question_id = $exam_questions[$x]['questionnaire_id'];
										$question = $exam_questions[$x]['question'];
										$grading_period = $exam_questions[$x]['label'];
										$kuder_result = $exam_questions[$x]['gpa'];

								echo form_open("teacher_home/submit_exam_details/".$exam_id."/".$subj_id."/".$total_no_of_items."/".$grading_period_id."/".$very_hard_items."/".$hard_items."/".$optimum_items."/".$easy_items."/".$very_easy_items."/",'form-horizontal');
							?>
						</th>	
							<tr>
							<?php 
									$data_hidden=array(
										'name'=>'hidden_question_id[]',
										'class'=>'hidden',
										'value'=>$question_id);
									echo form_input($data_hidden);?>

									<td><?php echo $counter; ?></td>
									<td><?php echo $question; ?></td>
									<td><?php echo $grading_period; ?></td>
									<td><center><?php echo $kuder_result; ?></center></td>
									<td>
										<?php
											if($kuder_result == NULL)
											{
												echo "New Question";
											}	
											else if($kuder_result >= 0.85 && $kuder_result <= 1.00)
											{
												echo "Very Easy";
											}
											else if($kuder_result >= 0.70 && $kuder_result <= 0.84)
											{
												echo "Easy";
											}
											else if($kuder_result >= 0.30 && $kuder_result <= 0.69)
											{
												echo "Optimum";
											}
											else if($kuder_result >= 0.15 && $kuder_result <= 0.29)
											{
												echo "Hard";
											}
											else if($kuder_result >= 0.00 && $kuder_result <= 0.14)
											{
												echo "Very Hard";
											}
										?>
									</td>
							</tr>
							<?php 
								}  
							?>

							 <?php //$data_hidden=array(
							// 			'name'=>'hidden_question_id',
							// 			'class'=>'hidden',
							// 			'value'=>$question_id);
							// 		echo form_input($data_hidden);?>
							
						</tbody>
						<?php 
									$data=array(
											'value'=>'SUBMIT',
											'class'=>'btn btn-sm btn-success pull-right'
										);
								echo form_submit($data);?>
					</table>
					<?php echo form_close();?>
				</div>
			</div>
						
		</div>
	</div>
</div>