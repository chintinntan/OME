<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-sm-5"></span>
			<h3 class="panel-title fa fa-database"> QUESTION BANK</h3>
		</div>
		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>QUESTION</th>
							<th>INDEX RANGE</th>
							<th>DIFFICULTY</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$ctr = 0;

						for($x=0;$x<count($question_bank);$x++)
						{
							$ctr +=1;
							$name_of_quest = $question_bank[$x]['question'];
							$kuder_result = $question_bank[$x]['gpa'];
					?>
						<tr>
							<td><?php echo $ctr; ?></td>
							<td><?php echo $name_of_quest; ?></td>
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
					</tbody>
				   <?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>