<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-md-5"></span>
			<h3 class="panel-title">STATISTIC</h3>
		</div>
		<div class="panel-body">
			<div>
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
							echo "<td><b>Stud = Student</b></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Q = Question</b></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>TOTAL C.A.S. = Total correct answer of student</b></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>TOTAL C.A.Q. = Total correct answer of question</b></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td></td>";
							echo "<td></td>";
						echo "</tr>";
						?>
					</thead>
					</table>
					</div>
					
					<table border=1>
						<?php
							$ctr = 0;
							$c_ctr = 0;
							// $total_q = 0;

							for($z=0;$z<count($total_stud);$z++)
							{
								$c_ctr +=1;
								
								if($z == 0)
								{
									echo "<th></th>";
								}
								echo "<th><font color=blue>&nbsp Stud ".$c_ctr."&nbsp&nbsp</font></th>";
							}
								echo "<th>&nbsp TOTAL C.A.Q. &nbsp&nbsp</th>";

							for($x=0;$x<count($no_of_quest);$x++)
							{
								$ctr +=1;
								$quest_id = $no_of_quest[$x]['questionnaire_id'];

								echo "<tr>";
									echo "<th><font color=red><b>&nbsp Q- &nbsp&nbsp".$ctr."&nbsp</b></font></th>";
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
														echo "<td>".$correct_ans."</td>";

														if($correct_ans == 1)
														{
															$total_q +=1;
															if(count($total_stud) == $i)
															{
																$total_q = 0+2;
															}
														}
													}
												}
											}
										}

										echo "<td><font color=red><b>".$total_q."</b></font></td>"; 
								echo "</tr>";
							}
							
							for($v=0;$v<count($total_stud_correct);$v++)
							{
								$total_s = $total_stud_correct[$v]['total_correct_answer'];
								
								if($v == 0)
								{
									echo "<th>&nbsp TOTAL C.A.S. &nbsp</th>";
								}
									echo "<th><font color=blue>".$total_s."</font></th>";
							}
							echo "<th><font color=blue><b>".$all_total_correct[0]['total_correct_answer']."</b></font></th>";
							// echo "<td>".$variance."</td>";
						 ?>
					</table>
				</div>
			</div>
			<table border=1>
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
				echo "<th><font color=green>&nbsp P &nbsp</font></th>";
			}
			else if($e == 2)
			{
				echo "<th><font color=blue>&nbsp Q &nbsp</font></th>";
			}
			else if($e == 3)
			{
				echo "<th><font color=red>&nbsp PQ &nbsp</font></th>";
			}
		}

		for($b=0;$b<count($no_of_quest);$b++)
		{
			$ctr +=1;
			$quest_id = $no_of_quest[$b]['questionnaire_id'];

			echo "<tr>";
				echo "<th><b>&nbsp Q-".$ctr."&nbsp</b></th>";
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
											$total_q = 0+2;
										}
									}
								}
							}
						}
					}

					$p = $total_q / count($total_stud);//No. of people in the sample who answered the questions correctly
					echo "<td><font color=green><b>".$p."</b></font></td>";

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
		echo "<td><b>TOTAL</b></td>";
		echo "<td><font color=red><b>".$sum_pq."</b></font></td>";
	?>
</table>

<!-- Start of Solving the variance -->
<table border=1 colspan=2>
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
			echo "<td><font color=blue>k</font></td>";
			echo "<td>".round($sample_size, 4)."</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td><font color=blue>Summation of pq</font></td>";
			echo "<td>".round($sum_pq, 4)."</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td><font color=blue>Variance</font></td>";
			echo "<td>".round($variance, 4)."</td>";
		echo "</tr>";

		$kr_20 = (($sample_size/($sample_size-1))*((1-$sum_pq)/$variance));
		echo "<tr>";
			echo "<td><font color=blue>KR20</font></td>";
			echo "<td>".round($kr_20, 4)."</td>";
		echo "</tr>";

		if($kr_20 > 0.9)
		{
			echo "<font color=green>Exam is Reliable</font>";
		}
		else if($kr_20 <= 0.9)
		{
			echo "<font color=red>EXAM IS NOT RELIABLE</font>";
		}
	?>
</table>

<a href="#" class="btn btn-default col-sm-offset-4"> SUBMIT RESULT</a>
		</div>
	</div>
</div>




