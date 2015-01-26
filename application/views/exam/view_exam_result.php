<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home/view_all_exam_schedule" class="btn btn-sm btn-info fa fa-reply" title='Back to Generate Exam'></a>
			<h3 class="panel-title fa fa-files-o col-sm-offset-5"> EXAM RESULT</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-5 col-md-offset-1">
				<div class="table table-responsive">
					<table class="table">
						<tr>
							<?php if($student_exam_result != NULL){ ?>
							<td><b>EXAM TITLE</b></td>
							<td>
								<?php

									echo $exam_view_details[0]['title_exam'];
								?>
							</td>
						</tr>
						<tr>
							<td><b>PERIOD</b></td>
							<td>
								<?php
									echo $exam_view_details[0]['label'];
								?>
							</td>
						</tr>
						<tr>
							<td><b>SUBJECT</b></td>
							<td>
								<?php
									echo $exam_view_details[0]['subject_label'];
								?>
							</td>
						</tr>
						<tr>
							<td><b>PASSWORD</b></td>
							<td>
								<?php
									echo $exam_view_details[0]['exam_password'];
								?>
							</td>
						</tr>
						<tr>
							<td><b>SCORE</b></td>
							<td>
								<?php
									echo $student_correct[0]['correct'];
								?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-1">
				<form class="form-horizontal">
					<?php
						$counter = 0;
						$c_counter = 0;

						for($x=0;$x<count($student_exam_result);$x++)
						{
							$question_id = $student_exam_result[$x]['questionnaire_id'];
							$questions = $student_exam_result[$x]['question'];
							$stud_ans = $student_exam_result[$x]['label'];
					?>
					<div class="list-group">
						
						<label>
							<?php

								if($questions != NULL)
								{
									$counter += 1;

									echo $counter.". &nbsp&nbsp";
									echo $questions;
									echo "&nbsp ANSWER: <font color=blue>".$stud_ans." </font>";	
								}
								else
								{
									$counter = $counter; 
								} 
							?>
						</label>
							<?php
							for($y=0;$y<count($exam_view_answers);$y++)
							{
								$quest_id = $exam_view_answers[$y]['questionnaire_id'];
								if($question_id == $quest_id)
								{
									$c_counter += 1;
									$choices = $exam_view_answers[$y]['choices'];
									$correct_ans = $exam_view_answers[$y]['correct'];
									$choice_id = $exam_view_answers[$y]['answer_id'];

					echo "<ul style='list-style-type:none'>";
						echo "<li>";
										if($c_counter == 1)
										{
											if($correct_ans == 1)
											{

												echo "a. <b>".$choices." <font color=green>correct answer</font></b>";
											}else{
												echo "a. ".$choices."</font>";
											}
										}
										else if($c_counter == 2)
										{
											if($correct_ans == 1)
											{
												echo "b. <font color=green><b>".$choices."</b></font>";
											}else{
												echo "b. ".$choices;
											}
										}
										else if($c_counter == 3)
										{
											if($correct_ans == 1)
											{
												echo "c. <font color=green><b>".$choices."</b></font>";
											}else{
												echo "c. ".$choices;
											}
										}
										else if($c_counter == 4)
										{
											if($correct_ans == 1)
											{
												echo "d. <font color=green><b>".$choices."</b></font>";
											}else{
												echo "d. ".$choices;
											}
											$c_counter = 0;
										}
								}//end of if($question_id == $quest_id)
							echo "</li>";
						echo "</ul>";
						}//2nd for loop closing bracket 
					
					echo "</div>";
				 }// 1st for loop closing bracket 
				}
				else
				{
					echo "NO EXAM GENERATED";
				}?>
				</form>
			</div>
		</div>
	</div>
</div>