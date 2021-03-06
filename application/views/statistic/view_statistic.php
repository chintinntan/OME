<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-md-5"></span>
			<h3 class="panel-title">STATISTIC</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open("teacher_home/update_difficulty/".$exam_sched_id."",'');?>
			
				<div class="table table-responsive">
					<div class="col-md-4">
						<table class="table">
							<thead>
								<?php
									echo "<tr>";
										echo "<td></td>";
										echo "<td></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b><font color=blue>Students <i class='fa fa-arrow-right'></i> <i class='fa fa-arrow-right'></i> <i class='fa fa-arrow-right'></i></font> = Number of Student take exam</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>TOTAL pq = Total summation of pq</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>TOTAL C.A.S. = Total correct answer of students</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>TOTAL C.A.Q. = Total correct answer of questions</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td></td>";
										echo "<td></td>";
									echo "</tr>";
								?>
							</thead>
						</table>
					</div>
					<div class="col-md-5">
						<table class="table">
							<thead>
								<?php
									echo "<tr>";
										echo "<td></td>";
										echo "<td></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>KR20 = Kuder and Richarson Formula 20</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>p = number of people in the exam who answered the question</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>q = number of people in the sample who didn't answer question.</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>VARP = variance of the total scores of all the people taking the test</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td></td>";
										echo "<td></td>";
									echo "</tr>";
								?>
							</thead>
						</table>
					</div>
					<div class="col-md-3">
						<table class="table">
							<thead>
								<?php
									echo "<tr>";
										echo "<td></td>";
										echo "<td></td>";
									echo "<tr>";
										echo "<td><b>Q = Questionnaire</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>k = Number of questions</b></td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td></td>";
										echo "<td></td>";
									echo "</tr>";
								?>
							</thead>
						</table>
					</div>
				</div>
				<div class="col-md-12">
					<div class="table table-responsive">
						<table class="table table-hover table-bordered">
							<?php
								$ctr = 0;
								$c_ctr = 0;
								// $total_q = 0;

								for($z=0;$z<count($total_stud);$z++)
								{
									$c_ctr +=1;
								
									if($z == 0)
									{
										echo "<th><font color=blue><center> STUDENTS <i class='fa fa-arrow-right'></i> <i class='fa fa-arrow-right'></i> <i class='fa fa-arrow-right'></i></center></font></th>";
									}
									// echo "<th><font color=blue><center> ".$c_ctr."</center></font></th>";
									echo "<th><font color=blue>&nbsp".$total_stud[$z]['last_name'].", ".$total_stud[$z]['first_name']."&nbsp&nbsp</font></th>";
								}
								echo "<th><center> Total C.A.Q. </center></th>";
								
								for($x=0;$x<count($no_of_quest);$x++)
								{
									$ctr +=1;
									$quest_id = $no_of_quest[$x]['questionnaire_id'];
									$question = $no_of_quest[$x]['question'];

									echo "<tr>";
										// echo "<th><font color=red><center><b> Q - ".$ctr."</b></center></font></th>";
									echo "<th><font color=red><center><b>".$question."</b></center></font></th>";
									$total_q = 0;
									for($i=0;$i<count($stud_correct_ans);$i++)
									{
										$ques_id = $stud_correct_ans[$i]['questionnaire_id'];
										$student_id = $stud_correct_ans[$i]['student_id'];
										$correct_ans = $stud_correct_ans[$i]['correct'];
											
										for($y=0;$y<count($total_stud);$y++)
										{
											$stud_id = $total_stud[$y]['student_id'];
												
												if($quest_id == $ques_id)
												{
													if($student_id == $stud_id)
													{	
														echo "<td><center> ".$correct_ans."</center></td>";

															// if($correct_ans == 1)
															// {
															// 	$total_q +=1;
															// 	if(count($total_stud) == $i)
															// 	{
															// 		$total_q = 0+2;
															// 	}
															// }
													}
												}
											}
										}

										for($m=0;$m<count($total_correct_of_question);$m++)
										{
											$total_q = $total_correct_of_question[$m]['total_correct_answer'];
											$total_questionnaire_id = $total_correct_of_question[$m]['questionnaire_id'];
												
											if($total_questionnaire_id == $quest_id)
											{
												echo "<td><font color=red><center><b>".$total_q."</b></center></font></td>"; 
											}
										}
											
										echo "</tr>";
								}
							
								for($v=0;$v<count($total_stud_correct);$v++)
								{
								
									$total_s = $total_stud_correct[$v]['total_correct_answer'];
						
									if($v == 0)
									{
										echo "<th><center> Total Correct Answer of Students </center></th>";
									}
									echo "<th><font color=blue><center>".$total_s."</center></font></th>";
								}
								echo "<th><font color=green><center><b>".$all_total_correct[0]['total_correct_answer']."</center></b></font></th>";
								// echo "<td>".$vari`ance."</td>";
							?>
						</table>
					</div>
				</div>

				<div class="col-md-6">
					<div class="table table-responsive">
						<table class="table table-bordered table-hover">
							<?php
								$ctr = 0;

								for($e=0;$e<4;$e++)
								{	
									if($e == 0)
									{
										echo "<th></th>";
									}
									else if($e == 1)
									{
										echo "<th><font color=green><center> p </center></font></th>";
									}
									else if($e == 2)
									{
										echo "<th><font color=blue><center> q </center></font></th>";
									}
									else if($e == 3)
									{
										echo "<th><font color=red><center> pq </center></font></th>";
									}
								}

								for($b=0;$b<count($no_of_quest);$b++)
								{
									$ctr +=1;
									$quest_id = $no_of_quest[$b]['questionnaire_id'];

									echo "<tr>";
										echo "<th><center><b>Q-".$ctr."</b></center></th>";
										$total_q = 0;
										
										for($c=0;$c<count($stud_correct_ans);$c++)
										{
											$ques_id = $stud_correct_ans[$c]['questionnaire_id'];
											$student_id = $stud_correct_ans[$c]['student_id'];
											$correct_ans = $stud_correct_ans[$c]['correct'];
						
											for($d=0;$d<count($total_stud);$d++)
											{
												$stud_id = $total_stud[$d]['student_id'];
							
												if($quest_id == $ques_id)
												{
													if($student_id == $stud_id)
													{	
														if($correct_ans == 1)
														{
															$total_q +=1;
										
															if(count($total_stud) == $i)
															{
																$total_q += 1;
															}
														}
													}
												}
											}
										}

										$p = $total_q / count($total_stud);//No. of people in the sample who answered the questions correctly
										echo "<td><font color=green><b>".$p."</b></font></td>";

										$data_input_questionnaire_id=array(
											'name'=>'hidden_question_id',
											'class'=>'hidden',
											'value'=>$quest_id
										);
										echo form_input($data_input_questionnaire_id);

										$q = 1-$p;//No. of people in the sample who didn't answer the question correctly
										echo "<td><font color=blue><b>".$q."</b></font></td>";

										$pq = $p*$q;//Product of the p and q
										echo "<td><font color=red><b>".$pq."</b></font></td>";

										if(!isset($sum_pq)) $sum_pq=0;
											$sum_pq += $pq;

									echo "</tr>";
								}
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td><font color=red><b>".$sum_pq."</b></font></td>";
							?>
						</table>	
					</div>
				</div>

				<div class="col-md-4">
					<table class="table table-bordered table-hover">
						<?php
							$sum = 0;

							for($i=0;$i<count($total_stud_correct);$i++)
							{
								$sum += $total_stud_correct[$i]['total_correct_answer'];
							}
							
							$sample_size = count($total_stud_correct);

							$mean = $sum / $sample_size;//AVG Solution
							$sos = 0;

							for($x=0;$x<count($total_stud_correct);$x++)
							{
								$scores = $total_stud_correct[$x]['total_correct_answer'];

								$score = ($total_stud_correct[$x]['total_correct_answer']-$mean);

								$sum = pow($score, 2);
								$sos += $sum;	
							}

							$variance = $sos / $sample_size;// end of solving";

							//table
							echo "<tr>";
								echo "<td><font color=blue><b>k</b></font></td>";
								echo "<td><b>".count($no_of_quest)."</b></td>";
							echo "</tr>";

							echo "<tr>";
								echo "<td><font color=blue><b>Summation OF pq</b></font></td>";
								echo "<td><b>".$sum_pq."</b></td>";
							echo "</tr>";

							echo "<tr>";
								echo "<td><font color=blue><b>VARP</b></font></td>";
								echo "<td><b>".$variance."</b></td>";
							echo "</tr>";

							$kr_20 = (($sample_size/($sample_size-1))*(1-$sum_pq/$variance));
							echo "<tr>";
								echo "<td><font color=blue><b>KR20</b></font></td>";
								echo "<td><b>".$kr_20."</b></td>";
							echo "</tr>";

							$data_input_kr_20=array(
								'name'=>'kr_20',
								'class'=>'hidden',
								'value'=>$kr_20
							);
							echo form_input($data_input_kr_20);

							if($kr_20 > 0.90)
							{
								echo "<tr>";
									echo "<td><font color=blue><b>Result Message</b></font></td>";
									echo "<td><font color=green><b>EXAM RELIABILITY IS EXCELLENT</b></font></td>";
								echo "</tr>";
							}
							else if($kr_20 >=.81 && $kr_20 <= 0.90)
							{
								echo "<tr>";
									echo "<td><font color=blue><b>Result Message</b></font></td>";
									echo "<td><font color=green><b>EXAM RELIABILITY IS VERY GOOD FOR CLASSROOM TEST </b></font></td>";
								echo "</tr>";
							}
							else if($kr_20 >=0.71 && $kr_20 <= 0.80)
							{
								echo "<tr>";
									echo "<td><font color=blue><b>Result Message</b></font></td>";
									echo "<td><font color=green><b>EXAM RELIABILITY IS GOOD FOR CLASSROOM TEST</b></font></td>";
								echo "</tr>";
							}
							else if($kr_20 >= 0.61 && $kr_20 <=0.70)
							{
								echo "<tr>";
									echo "<td><font color=blue><b>Result Message</b></font></td>";
									echo "<td><font color=red><b>EXAM RELIABILITY IS SOMEWHAT LOW</b></font></td>";
								echo "</tr>";
							}
							else if($kr_20 >= 0.51 && $kr_20 <= 0.60)
							{	
								echo "<tr>";
									echo "<td><font color=blue><b>Result Message</b></font></td>";
									echo "<td><font color=red><b>EXAM RELIABILITY IS SUGGESTS NEED FOR REVISION OF TEST</b></font></td>";
								echo "</tr>";
							}
							else if($kr_20 <= 0.5 && $kr_20>=0)
							{	
								echo "<tr>";
									echo "<td><font color=blue><b>Result Message</b></font></td>";
									echo "<td><font color=red><b>EXAM IS NON RELIABLE</b></font></td>";
								echo "</tr>";
							}
														
							if($check_kr20 == NULL)
							{	
								echo "<tr>";
									echo "<td></td>";
									echo "<td><input class='btn btn-default form-control' type='submit' value='SUBMIT RESULT'></td>";
								echo "</tr>";
							}
						?>
					</table>
				</div>	
			<?php echo form_close();?>
		</div>
	</div>
</div>




