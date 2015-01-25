<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-sm-5"></span>
			<h3 class="panel-title fa fa-database"> QUESTION BANK</h3>
		</div>
		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>QUESTION</th>
							<th>AVG</th>
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
							$avg = $question_bank[$x]['gpa'];
					?>
						<tr>
							<td><?php echo $ctr; ?></td>
							<td><?php echo $name_of_quest; ?></td>
							<td><?php echo $avg."%"; ?></td>
							<td>
								<?php 
									if($avg>50)
									{
										echo "EASY";
									}
									else
									{
										echo "HARD";	
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