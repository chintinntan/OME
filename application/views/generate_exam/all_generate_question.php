<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="#" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
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
							<td><b>No. OF ITEM</b></td>
							<td>
								<?php 
									echo $total_no_of_items;
								?>
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td></td>
						</tr>

						</table>	
					</div>
					<table class="table">
						
						<thead>
							<tr>
								<th>No.</th>
								<th>Question</th>
								<th>PERIOD</th>
								<th>AVG</th>
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

								echo form_open("teacher_home/submit_exam_details/".$exam_id."/".$subj_id."/".$total_no_of_items."/".$grading_period_id."/".$hard_items."/".$easy_items."",'form-horizontal');
							?>
						</th>	
							<tr>
							<?php 
									$data_hidden=array(
										'name'=>'hidden_question_id',
										'class'=>'hidden',
										'value'=>$question_id);
									echo form_input($data_hidden);?>
									<td><?php echo $counter; ?></td>
									<td><?php echo $question; ?></td>
									<td><?php echo $grading_period; ?></td>
									<td><?php echo $kuder_result; ?></td>
									<td>
										<?php
											if($kuder_result == NULL)
											{
												echo "New Question";
											}	
											else if($kuder_result >= 0.50)
											{
												echo "Easy";
											}
											else if($kuder_result < 0.50)
											{
												echo "Hard";
											}
										?>
									</td>
							</tr>
							<?php 
								}  
							?>
							
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