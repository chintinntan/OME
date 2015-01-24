<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-md-5"></span>
			<h3 class="panel-title">EXAM DETAILS</h3>
		</div>
		<div class="panel-body">
			<div>
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
							<td><?php echo "<a href=".base_url()."teacher_home/view_new_question_page/".$exam_id."/".$subj_id."/".$grading_period_id."/".$total_no_of_items." class='btn btn-sm btn-default'> ADD NEW QUESTION";?></a></td>
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
								<th>QUESTION</th>
								<th>PERIOD</th>
								<th>KR20</th>
								<th>DIFFICULTY</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($submitted_exam_details != NULL)
							{
								$counter = 0;
								for($x=0;$x<count($submitted_exam_details);$x++)
								{
									$question = $submitted_exam_details[$x]['question'];
									$grading_period = $submitted_exam_details[$x]['label'];
									$kuder_result = $submitted_exam_details[$x]['question_difficulty'];
									$counter += 1;
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
							<?php 
								}
							}
							else
							{
								echo "<td>-</td>";
								echo "<td>NO OLD QUESTIONS</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
							} 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>