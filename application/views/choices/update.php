<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."question_bank/questionnaire/".$subj_name."/".$subj_id." class='btn btn-xs btn-info fa fa-reply' title='Back to Main'>";?></a>
			<h3 class="panel-title col-sm-offset-4">UPDATE CHOICE</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open("question_bank/update_choice/".$choice_id."/".$subj_name."/".$subj_id."/".$question_id."",'form-horizontal');?>
			<div class="col-md-6 col-md-offset-3">
				<div class="table table-responsive">
					<table class="table">
						<tr>
							<th>Set as Correct Answer
									<br>
									<?php
										$data_input_checkbox_a=array(
											'name'=>'check',
											'id'=>'option_check',
											'value'=>1
											
										);
										echo form_checkbox($data_input_checkbox_a);
									?>
							</th>
							<th>
								<?php
										$data_input_choice_a=array(
											'name'=>'new_choice',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 1',
											'required'=>'',
											'value'=> $choice_detail[0]['label'],
											'rows'=>'2'
										); 	
										echo form_textarea($data_input_choice_a);
									?>
							</th>
						</tr>
						<tr>
							<th></th>
							<th><input type="submit" value="SUBMIT" class="btn btn-sm btn-default pull-right"></th>
						</tr>
					</table>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>