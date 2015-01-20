<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>question_bank/questionnaire/.$question_id./.$subj_name./.subj_id" class="col-sm-1"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title fa fa-file"> CREATE CHOICES</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<tr>
					<td><b>Question: </b></td>
					<td><?php echo $question[0]['question']; ?></td>
				</tr>
			</div>
			<?php echo form_open("question_bank/add_choices/".$question_id."/".$subj_name."/".$subj_id."",'form-horizontal');?>
				<div class="col-md-6 col-md-offset-3">
					<div class="table table-responsive">
						<br>
						 <table class="table">
							<tr>
								<td>CHOICE A
									<br>
									<?php
										$data_input_checkbox_a=array(
											'name'=>'check1',
											'id'=>'option_check_1',
											'value'=>1
											
										);
										echo form_checkbox($data_input_checkbox_a);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_a=array(
											'name'=>'choice1',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 1',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_a);
									?>
								</td>
							</tr>

							<tr>
								<td>CHOICE B
									<br>
									<?php
										$data_input_checkbox_b=array(
											'name'=>'check2',
											'id'=>'option_check2',
											'value'=>1
											
										);
										echo form_checkbox($data_input_checkbox_b);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_b=array(
											'name'=>'choice2',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 2',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_b);
									?>
								</td>
							</tr>
							<tr>
								<td>CHOICE C
									<br>
									<?php
										$data_input_checkbox_c=array(
											'name'=>'check3',
											'id'=>'option_check3',
											'value'=>1
											
										);
										echo form_checkbox($data_input_checkbox_c);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_c=array(
											'name'=>'choice3',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 3',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_c);
									?>
								</td>
							</tr>
							<tr>
								<td>CHOICE D
									<br>
									<?php
										$data_input_checkbox_d=array(
											'name'=>'check4',
											'id'=>'option_check4',
											'value'=>1
											
										);
										echo form_checkbox($data_input_checkbox_d);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_d=array(
											'name'=>'choice4',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 4',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_d);
									?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" class="btn btn-default pull-right" value="SUBMIT"></td>
							</tr>
						</table> 
					</div>
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>