<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="#" class="btn btn-xs btn-info fa fa-reply" title='Back'></a>
			
			<h3 class="panel-title col-sm-offset-5 fa fa-file-text-o">ALL NEW QUESTION</h3>
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
								for($x=0;$x<count($new_question);$x++)
								{
									$question_id = $new_question[$x]['questionnaire_id'];
									$question = $new_question[$x]['question'];
									$counter ++;
							?>
							<tr>
								<td><?php echo $counter ?></td>
								<td><?php echo $question; ?></td>
								<td><?php echo "<a href=".base_url()."teacher_home/add_new_question/".$exam_id."/".$subj_id."/".$grading_period_id."/".$question_id."/".$total_no_of_items." class='btn btn-sm btn-default'> ADD NEW QUESTION";?></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>