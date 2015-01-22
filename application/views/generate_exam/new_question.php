<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="#" class="col-sm-1">BACK</a>
			<span class="col-md-4"></span>
			<h3 class="panel-title">ALL NEW QUESTION</h3>
		</div>
		<div class="panel-body">
			<div>
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No.</th>
								<th>QUESTION</th>
								<th>OPTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$counter = 0;
								for($x=0;$$x<count($new_question);$x++)
								{
									$question_id = $new_question[$x]['questionnaire_id'];
									$question = $new_question[$x]['question'];
									$counter ++;
							?>
							<tr>
								<td>$counter</td>
								<td><?php echo $question; ?></td>
								<td><a href="#"> ADD QUESTION</a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>