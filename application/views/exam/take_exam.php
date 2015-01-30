<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-md-5"></span>
			<h3 class="panel-title">EXAMINATION</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open("student_home/submit_exam_answers/".$exam_sched_id."/".$stud_id."" ,'class="form-horizontal"');
				

				if($exam_questions != NULL)
				{	
					$counter = 0;
					for($x=0;$x<count($exam_questions);$x++)
					{
						$question_id = $exam_questions[$x]['questionnaire_id'];
						$questions = $exam_questions[$x]['question'];

						echo "<div class='list-group'>";
							if($questions != NULL)
							{
								$counter += 1;
								echo "<label>";
									echo $counter.". &nbsp&nbsp";
									echo $questions;
								echo "</label>";
							}
							else
							{
								$counter = $counter; 
							}

								for($y=0;$y<count($exam_choices);$y++)
								{
									$quest_id = $exam_choices[$y]['questionnaire_id'];
									
									if($question_id == $quest_id)
									{
										$choices = $exam_choices[$y]['choices'];
										$correct_ans = $exam_choices[$y]['correct'];
										$answer_id = $exam_choices[$y]['answer_id'];

										echo "<ul style='list-style-type:none'>";
											echo "<li>";
												
												$data_radio=array(
													'name'=>$quest_id,
													'value'=>$answer_id,
													'required' => ''
												);
												echo form_radio($data_radio);
												echo $choices;
												
										
									}//end of if($question_id == $quest_id)	
									echo "</li>";
									echo "</ul>";
								}//end of second for loop	
						echo "</div>";
					}//end of first for loop
				}
				else
				{
					echo "NO EXAM";
				}

				$data=array(
					'class'=>'btn btn-success',
					'value'=>'SUBMIT'
				);
				echo form_submit($data); 
				echo form_close();
			?>
		</div>
	</div>
</div>
