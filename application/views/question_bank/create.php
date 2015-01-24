<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."question_bank/questionnaire/".$this->uri->segment(3,0)."/".$this->uri->segment(4,0)." class='btn btn-xs btn-info fa fa-reply' title='Back To List of Questionnaire'>";?></a>
			<h3 class="panel-title fa fa-file col-sm-offset-5"> CREATE QUESTION</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<?php echo form_open("question_bank/add_question/".$subj_name."/".$subj_id."",'class="form-horizontal"');?>
					<div class="table table-responsive">
						<table class="table">
							<tr>
								<td>PERIOD</td>
								<td>
									<?php
										for($x=0;$x<count($dropdown_period);$x++)
										{		
											$subject_option [$dropdown_period[$x]['grading_period_id']] = $dropdown_period[$x]['label'];
										}
										echo form_dropdown('selected_grading_period',$subject_option,'','class="form-control"'); 
									?>
								</td>
							</tr>
							<tr>
								<td>Question</td>
								<td>
									<?php
										$data_input_questionnaire=array(
											'name'=>'questionnaire',
											'class'=>'form-control',
											'placeholder'=>'QUESTIONNAIRE INPUT',
											'required'=>'',
											'rows'=>'5'
										); 
										echo form_textarea($data_input_questionnaire);
									?>
								</td>
							</tr>

							<tr>
								<td></td>
								<td><input type="submit" class="btn col-sm-offset-10"></td>
							</tr>
						</table>
					</div>
				<?php echo form_close();?>
			</div>		
		</div>
	</div>
</div>