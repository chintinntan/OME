<div class="col-md-10">
	<div class="panel panel-default">
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
									echo $item_no;
								?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><a href="#" class="btn btn-sm btn-default">SUBMIT</a></td>
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
								<th>KR20</th>
								<th>DIFFICULTY</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$counter = 0;
								for($x=0;$x<count($exam_questions);$x++)
								{
									$counter += 1;
									$question = $exam_questions[$x]['question'];
									$grading_period = $exam_questions[$x]['label'];
									$kuder_result = $exam_questions[$x]['question_difficulty'];
							?>
							<tr>
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
										else if($kuder_result >= 0.90)
										{
											echo "Easy";
										}
										else if($kuder_result < 0.90)
										{
											echo "Hard";
										}
									?>
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