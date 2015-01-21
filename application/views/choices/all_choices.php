<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>question_bank/questionnaire" class="col-sm-1"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title fa fa-file"> ALL CHOICES</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<tr>
					<td><b>Question:  </b></td>
					<td><?php echo $question[0]['question']; ?></td>
				</tr>
			</div>
				<div class="col-md-6 col-md-offset-3">
					<div class="table table-responsive">
						<br>
						<table class="table">
							<thead>
								<tr>
									<td><b>CHOICES</b></td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php
									for($x=0;$x<count($choices);$x++)
									{
										$questionnaire_id = $choices[$x]['questionnaire_id'];
										$choice_id = $choices[$x]['answer_id'];
										$choice = $choices[$x]['label'];
										$correct_ans = $choices[$x]['correct'];
								?>
								<tr>
									<td>
										<?php
											if($correct_ans == 1)
											{
												echo $choice."&nbsp&nbsp&nbsp<font color=green>correct answer</font>";
											}
											else
											{
												echo $choice;
											}
										?>
									</td>
									<td><?php echo "<a href=".base_url()."question_bank/update_choices_page/".$choice_id."/".underscore($subj_name)."/".$subj_id."/".$question_id." class='btn btn-sm btn-default'> Edit";?></a></td>
								</tr>
								<?php } ?>
							</tbody>	
						</table>
					</div>
				</div>
		</div>
	</div>
</div>